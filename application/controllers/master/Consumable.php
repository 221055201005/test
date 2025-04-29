<?php 

  class Consumable extends CI_Controller {

    public function __construct()
    {
      parent::__construct();
      $this->load->helper('browser');
      $this->load->helper('cookies');
      $data_cookies = helper_cookies(@$this->input->get('user'));

      $this->load->model('general_mod');
      $this->load->model('master/consumable_mod', 'm_consumable_mod');

      $this->user_cookie 		  	= $data_cookies['data_user'];
      $this->permission_cookie  = $data_cookies['data_permission'];

      $this->ftp        = ftp_config_syn();
      $this->user_id    = $this->user_cookie[0];
      $this->timestamp  = date('Y-m-d H:i:s');
    }

    public function index() {
      redirect('consumable/consumable_list');
    }

    public function consumable_list() {
      
      $where['status_delete']   = 1;
      $order_by                 = "id ASC";
      $data['list']             = $this->m_consumable_mod->consumable_list($where, $order_by);
      unset($where);

      if($data['list']) {
        foreach($data['list'] as $value) {
          $list_id_main[]       = $value['id'];
          $list_user_id[]       = $value['created_by'];
        }

        $where[implode_where("id_master", $list_id_main)] = null;
        $detail_list            = $this->m_consumable_mod->consumable_list_detail($where);
        unset($where);

        foreach($detail_list as $value) {
          $data['detail'][$value['id_master']][]  = $value;
          $list_id_wps[]        = $value['id_wps'];
        }

        $where[implode_where("id_wps", $list_id_wps)] = null;
        $wps_list               = $this->general_mod->master_wps_new($where);
        unset($where);
        foreach($wps_list as $value) {
          $data['wps'][$value['id_wps']]  = $value;
        }

        $where[implode_where("id_user", $list_user_id)] = null;
        $select                 = "id_user, full_name";
        $user_list              = $this->general_mod->portal_user_db_list($where, null, $select);
        unset($where);
        foreach($user_list as $value) {
          $data['user'][$value['id_user']]  = $value;
        }
      }

      $project_list             = $this->general_mod->project();
      foreach($project_list as $value) {
        $data['project'][$value['id']]  = $value;
      }

      $data['meta_title']       = 'Consumable List';
      $data['subview']          = "master/consumable/consumable_list";
      $data['user_permission']  = $this->permission_cookie;
      $data['user_cookie']      = $this->user_cookie;
  
      $this->load->view('index', $data);
    }

    public function create_new_consumable() {
      $where['status']          = 1;
      $data['project_list']     = $this->general_mod->project($where);
      unset($where);

      $data['wps_list']         = $this->general_mod->master_wps_new();
      $data['meta_title']       = 'Create new Consumable';
      $data['subview']          = "master/consumable/create_new_consumable";
      $data['user_permission']  = $this->permission_cookie;
      $data['user_cookie']      = $this->user_cookie;
  
      $this->load->view('index', $data);
    }

    public function autocomplete_lot_no() {
      $term                   = $this->input->post('term');
      $output                 = [];
      if($term) {
        $where["heat_or_series_no ILIKE '%$term%'"] = null;
        $where["category"]      = "CM";
        $where["mrir_id != 0"]  = null;

        $order_by             = "heat_or_series_no ASC";
        $limit                = 10;
        $datadb               = $this->m_consumable_mod->lot_no_list($where, $order_by, $limit);
        unset($where);

        if($datadb) {
          foreach($datadb as $value) {
            $output[]         = $value['heat_or_series_no'];
          } 
        } else {
          $output[]           = "Lot No. Not Found !";
        }

      }

      echo json_encode($output);

    }

    public function validate_lot_no() {
      $lot_no               = $this->input->post('lot_no');
      $output               = [];

      $where["category"]            = "CM";
      $where["mrir_id != 0"]        = null;
      $where["heat_or_series_no"]   = $lot_no;
      $datadb                       = $this->m_consumable_mod->qcs_material_list($where);
      unset($where);

      if($datadb) {

        $where['id']                = $datadb[0]['brand'];
        $brand_list                 = $this->m_consumable_mod->master_wh_brand($where);
        unset($where);

        $brand_name                 = $brand_list[0]['brand_name'];

        $where['id']                = $datadb[0]['catalog_id'];
        $catalog_list               = $this->m_consumable_mod-> material_consumable_list($where);
        unset($where);

        $brand_trade                = $catalog_list[0]['material'].' - '.$catalog_list[0]['spesification'];

        $output                     = [
          'success'                 => true,
          'brand_trade'             => $brand_trade,
          'brand_name'              => $brand_name,
          'size'                    => $catalog_list[0]['size']
        ];

      } else {
        $output                     = [
          'success'                 => false,
          'message'                 => "Lot No. Not Found !"
        ];
      }

      echo json_encode($output);

    }

    public function submit_consumable() {
      $project_id                   = $this->input->post('project_id');
      $lot_no                       = $this->input->post('lot_no');
      $brand_trade_name             = $this->input->post('brand_trade_name');
      $manufacturer                 = $this->input->post('manufacturer');
      $diameter                     = $this->input->post('diameter');
      $id_wps                       = $this->input->post('id_wps');


      if(!$lot_no) {
        $this->session->set_flashdata('error','No Data to Proceed');
        return redirect($_SERVER['HTTP_REFERER']);
      }

      foreach ($lot_no as $key => $value) {
        $form_data                  = [
          'project_id'              => $project_id[$key],
          'lot_no'                  => $value,
          'brand_trade_name'        => $brand_trade_name[$key],
          'manufacturer'            => $manufacturer[$key],
          'diameter'                => $diameter[$key],
          'created_by'              => $this->user_id,
          'created_date'            => $this->timestamp
        ];

        $id_main                    = $this->m_consumable_mod->insert_consumable_lot_no($form_data);
        unset($form_data);

        if(isset($id_wps[$key])) {
          foreach($id_wps[$key] as $v) {
            $form_data              = [
              'id_master'           => $id_main,
              'id_wps'              => $v,
              'created_by'          => $this->user_id,
              'created_date'        => $this->timestamp
            ];

            $this->m_consumable_mod->insert_consumable_lot_no_detail($form_data);
            unset($form_data);
          }
        }
      }

      $this->session->set_flashdata('success','Success Create Data Consumable Lot Number Register');
      redirect('master/consumable/consumable_list');
    }

  }

?>