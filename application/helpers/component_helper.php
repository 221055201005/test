<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function ch_button_shortcut_search_joint_welder($method, $drawing_wm, $report_no, $joint_no) {
  $CI =& get_instance();
  if($CI->permission_cookie[210] == 1){
    $link = base_url().'ndt_live/search_joint_welder/'.encrypt($method).'?drawing_wm='.$drawing_wm.'&report_no='.$report_no.'&joint_no='.urlencode($joint_no);
    $elem = "<a href='$link' class='btn btn-sm btn-flat btn-block btn-info' title='Update Welder' target='_blank'><i class='fas fa-users'></i></a>";
  }
  return @$elem;
}  

// END ADDED BY IQBAL
?>