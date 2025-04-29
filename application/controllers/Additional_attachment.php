<?php

class Additional_attachment extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('browser');
    $this->load->helper('cookies');
    $data_cookies = helper_cookies(@$this->input->get('user'));

    $this->load->model('home_mod');
    $this->load->model('general_mod');
    $this->load->model('additional_attachment_mod');

    $this->user_cookie          = $data_cookies['data_user'];
    $this->permission_cookie    = $data_cookies['data_permission'];
    $this->sidebar              = "additional_attachment/sidebar";
    $this->ftp                  = ftp_config_syn();
    $this->user_id              = $this->user_cookie[0];
    $this->timestamp            = date('Y-m-d H:i:s');
  }

  public function index()
  {
    redirect('additional_attachment/additional_attachment_list');
  }

  public function additional_attachment_list()
  {

    $get = $this->input->get();
    // test_var($get);
    $data['get']                = $get;
    $data['master_deck']        = $this->general_mod->deck_elevation(["id IN (5, 6, 7, 8, 9, 10)" => NULL]);

    $data['master_attachment']  = $this->additional_attachment_mod->master_attachment_list();
    $data['subview']            = "additional_attachment/additional_attachment_list";
    $data['meta_title']         = "Additional Attachment List";
    $data['serverside']         = "additional_attachment/additional_attachment_list_serverside";
    $data['user_permission']    = $this->permission_cookie;
    $data['sidebar']            = $this->sidebar;
    $data['user_cookie']        = $this->user_cookie;

    $this->load->view('index', $data);
  }

  public function additional_attachment_list_serverside()
  {
    error_reporting(0);

    $data               = [];

    $post = $this->input->post();

    if ($post['id_type'] != '') {
      $where_l["id_type"] = $post['id_type'];
    }
    if ($post['deck_elevation'] != '') {
      $where_l["deck_elevation"] = $post['deck_elevation'];
    }

    $datadb = $this->general_mod->deck_elevation();
    foreach ($datadb as $key => $value) {
      $master_deck[$value['id']] = $value;
    }


    $datadb  = $this->additional_attachment_mod->master_attachment_list();
    foreach ($datadb as $key => $value) {
      $master_att[$value['id']] = $value['categories_desc'];
    }

    $where_l["status_delete"] = 1;
    $list  = $this->additional_attachment_mod->serverside_additional_attachment($where_l);

    if ($list) {

      $list_user_id = array_column($list, 'created_by');
      $whereuser[implode_where("id_user", $list_user_id)] = null;
      $datadb = $this->general_mod->portal_user_db_list($whereuser);
      foreach ($datadb as $key => $value) {
        $username[$value['id_user']] = $value['full_name'];
      }
    }
    // test_var($list);
    foreach ($list as $value) {

      $file  = encrypt($value['attachment_name']);
      $url   = encrypt("");
      $url_2 = encrypt("#$%PCMS#$%pcms_v2#$%additional_attachment#$%");

      $row    = [];

      $row[]  = $master_att[$value['id_type']];
      $row[]  = $master_deck[$value['deck_elevation']]['name'];
      $row[]  = $value['original_name'];
      $row[]  = $value['ecodoc_no'];
      $row[]  = $value['book_volume'];
      $row[]  = $username[$value['created_by']];
      $row[]  = $value['created_date'];
      $row[]  = "
        <div class='btn btn-group btn-sm'>
          <button class='btn btn-danger' onclick='removeAttachment(" . $value['id'] . ")'><i class='fas fa-trash'></i></button>
          <a class='btn btn-success' target='_blank' href='" . base_url("additional_attachment/open_atc/") . $file . '/' . $file . '/' . $url . '/' . $url_2 . "'><i class='fas fa-download'></i></a>
        </div>
      ";

      $data[]  = $row;
    }

    $result  = [
      "draw"                  => $_POST['draw'],
      "recordsTotal"          => $this->additional_attachment_mod->count_serverside_additional_attachment_all($where_l),
      "recordsFiltered"       => $this->additional_attachment_mod->count_serverside_additional_attachment_filtered($where_l),
      "data"                  => $data
    ];

    echo json_encode($result);
  }

  public function open_atc($attachment, $file_name, $location, $location_2)
  {
    open_atc_synologi(decrypt($attachment), decrypt($file_name), decrypt($location), decrypt($location_2));
  }

  public function removeAttachment()
  {
    $id = $this->input->post('id');

    $where["id"] = $id;

    $set["status_delete"] = 0;
    $set["deleted_by"]    = $this->user_cookie[0];
    $set["deleted_date"]  = DATE("Y-m-d H:i:s");
    $this->additional_attachment_mod->update_attachment($set, $where);
  }

  public function upload_additional_attachment()
  {

    $where['status_delete']     = 1;
    $data['deck_list']          = $this->general_mod->deck_elevation($where);
    unset($where);
    $data['master_attachment']  = $this->additional_attachment_mod->master_attachment_list();

    $data['subview']          = "additional_attachment/upload_additional_attachment";
    $data['meta_title']       = "Upload Additional Attachment";
    $data['user_permission']  = $this->permission_cookie;
    $data['sidebar']          = $this->sidebar;
    $data['user_cookie']      = $this->user_cookie;

    $this->load->view('index', $data);
  }

  public function proceed_upload()
  {
    $id_type                  = $this->input->post('id_type');
    $deck_elevation           = $this->input->post('deck_elevation');
    $ecodoc_no                = $this->input->post('ecodoc_no');
    $book_volume              = $this->input->post('book_volume');

    require_once APPPATH . 'third_party/Net/SFTP.php';

    $ftp                      = $this->ftp;
    $sftp = new Net_SFTP($ftp['hostname']);
    if (!$sftp->login($ftp['username'], $ftp['password'])) {
      $this->session->set_flashdata('error', 'Cannot Connect to SFTP Server');
      return redirect($_SERVER['HTTP_REFERER']);
    }

    $destination_source         = "/PCMS/pcms_v2/additional_attachment/";

    if (isset($_FILES['attachment'])) {
      foreach ($_FILES['attachment']['name'] as $key => $value) {
        $filename           = uniqid() . '_' . $value;
        $filepath           = 'upload/';

        move_uploaded_file($_FILES['attachment']['tmp_name'][$key], $filepath . $filename);
        $source                   = $filepath . $filename;
        $destination              = $destination_source . $filename;

        $sftp->put($destination, $source, NET_SFTP_LOCAL_FILE);
        // @unlink($source);

        $form_data                = [
          'id_type'               => $id_type,
          'original_name'         => $value,
          'attachment_name'       => $filename,
          'deck_elevation'        => intval($deck_elevation),
          'ecodoc_no'             => $ecodoc_no,
          'book_volume'           => $book_volume,
          'created_by'            => $this->user_id,
          'created_date'          => $this->timestamp
        ];

        $this->additional_attachment_mod->insert_attachment($form_data);
        unset($form_data);
      }
    }

    $this->session->set_flashdata('success', 'Success Insert Data');
    redirect('additional_attachment/additional_attachment_list');
  }
  public function find_unused_folder()
  {
    include APPPATH . 'third_party/Net/SFTP.php';
    $sftp = new Net_SFTP(getenv('FTP_SINOLOGI_HOST'));
    $sftp->login(getenv('FTP_SINOLOGI_USER'), getenv('FTP_SINOLOGI_PASS'));

    $suspicious = [];
    $broken = [];
    $directory = '/PCMS/referal_welder/file'; // DIUBAH SESUAI DIRECTORY YG DIGUNAKAN

    $arr_dir  = $sftp->rawlist($directory);
    // test_var($arr_dir);
    foreach ($arr_dir as $key => $value) {
      if (!in_array($key, ['.', '..'])) {
        $ext = explode(".", $key)[1];
        if (!in_array($ext, [
          '.', '..',
          'pdf', 'img', 'png', 'jpg', 'jpeg', 'xlsx', 'xls', 'nwd', 'pptx', 'mp4', 'jfif', 'webp', 'txt', 'eml', 'mp3',
          'PDF', 'IMG', 'PNG', 'JPG', 'JPEG', 'XLSX', 'XLS', 'NWD', 'PPTX', 'MP4', 'JFIF', 'WEBP', 'TXT', 'EML', 'MP3',
          // LIST EXTENSION YG BOLEH ADA DISERVER, DITAMBAHKAN BILA KURANG
        ])) {
          $suspicious[] = $directory . "/" . $key;
        }
        if ($value["size"] == 0) {
          $broken[] = $directory . "/" . $key;
        }
      }
    }
  }
}

