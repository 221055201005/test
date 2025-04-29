<?php 

  class Form extends CI_Controller {
  
    public function __construct()
    {
      parent::__construct();
      $this->load->helper('browser');
      $this->load->helper('cookies');
      $data_cookies = helper_cookies(@$this->input->get('user'));

      $this->load->model('general_mod');
      $this->load->model('master/form_mod', 'm_form_mod');

      $this->user_cookie 		  	= $data_cookies['data_user'];
      $this->permission_cookie  = $data_cookies['data_permission'];

      $this->ftp        = ftp_config_syn();
      $this->user_id    = $this->user_cookie[0];
      $this->timestamp  = date('Y-m-d H:i:s');
    }

    public function index() {
      redirect('master/form/register_list');
    }

    public function register_list() {
      if($this->permission_cookie[0] != 1) {
        $where['detail.project_id']   = $this->user_cookie[10];
      }
      $where['main.status_delete']    = 1;
      $where['detail.status_delete']  = 1;
			$where['detail.project_id in ('.join(',', $this->user_cookie[13]).')']   = NULL;
      $order_by                 = "form_no ASC, revision_no ASC";
      $data['list']             = $this->m_form_mod->form_register_join($where, $order_by);
      unset($where);

      $project_list             = $this->general_mod->project();
      foreach($project_list as $value) {
        $data['project_list'][$value['id']] = $value;
      }

      $data['meta_title']       = "Form Register List";
      $data['subview']          = "master/form/register_list";
      $data['user_permission']  = $this->permission_cookie;
      $data['user_cookie']      = $this->user_cookie;

      $this->load->view('index', $data);
    }
    

  }

?>