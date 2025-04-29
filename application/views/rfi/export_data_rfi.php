<?php 

error_reporting(0);
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Export_RFI_Register_".date('YmdHis').".xls");
header("Pragma: no-cache");
header("Expires: 0");

?>

<style>
  table td {
    vertical-align: middle !important;
  }
</style>
<table border="1" style="width: 100%; border-collapse: collapse;">
<tr>
  <td style="background-color: #4c874f; color: white;"><center><strong>Project</strong></center></td>
  <td style="background-color: #4c874f; color: white;"><center><strong>RFI No</strong></center></td>
  <td style="background-color: #4c874f; color: white;"><center><strong>Revision No</strong></center></td>
  <td style="background-color: #4c874f; color: white;"><center><strong>Deck Elevation / Service Line</strong></center></td>
  <td style="background-color: #4c874f; color: white;"><center><strong>Process</strong></center></td>
  <td style="background-color: #4c874f; color: white;"><center><strong>Drawing No</strong></center></td>
  <td style="background-color: #4c874f; color: white;"><center><strong>Inspector Name</strong></center></td>
  <td style="background-color: #4c874f; color: white;"><center><strong>Inspection Location</strong></center></td>
  <td style="background-color: #4c874f; color: white;"><center><strong>Inspection Date Time</strong></center></td>
  <td style="background-color: #4c874f; color: white;"><center><strong>Total Item</strong></center></td>
  <td style="background-color: #4c874f; color: white;"><center><strong>Status</strong></center></td>
  <td style="background-color: #4c874f; color: white;"><center><strong>Reject History</strong></center></td>
  <td style="background-color: #4c874f; color: white;"><center><strong>Inspection Authority</strong></center></td>
  <td style="background-color: #4c874f; color: white;"><center><strong>Reviewed / Approval Client By</strong></center></td>
</tr>
<?php foreach ($summary_mv_list as $key => $value): ?>
<?php 
  $total_item_per_report_mv  = count($total_detail_mv[$value['report_number']]);
?> 
 <tr>
  <td><center><?= $project[$value['project_code']]['project_name'] ?></center></td>
  <td><center><?= $report_no_list['mv_no'][$value['project_code']][$value['discipline']][$value['module']][$value['type_of_module']]."-".$value['report_number'] ?></center></td>
  <td><center><?= $value['report_no_rev'] ?></center></td>
  <td><center><?= $deck[$wp_mv[$value['id_workpack']]['deck_elevation']]['name'] ?></center></td>
  <td><center> Material Verification </center></td>
  <td><center><?= $value['drawing_no'] ?></center></td>
  <td><center><?= isset($user[$value['inspector_id']]['full_name']) ? $user[$value['inspector_id']]['full_name'] : '-' ?></center></td>
  <td><center>

    <?php 

      $area_mv = '';

      if($value['area_v2']) {
        $area_mv .= $area_v2[$value['area_v2']]['name'];

        if($value['location_v2']) {
          $area_mv .= ', '.$location_v2[$value['location_v2']]['name'];

          if($value['point_v2']) {
            $area_mv .= ', '.$point_v2[$value['point_v2']]['name'];
          }

        }

      } else {
        $area_mv = $area[$value['location_inspect']]['area_name'];
      }
    
    ?>
    
  
  <?= $area_mv ?></center></td>
  <td><center><?= $value['time_inspect'] ?></center></td>
  <td><center><?= $value['total_item'] ?></center></td>
  <td>
    <center>
      <?php 

        $total_item_mv  = $value['total_item'];
        $status_rfi_mv  = '';

        if($value['total_pending_smoe'] > 0) {
          $status_rfi_mv = 'Pending Approval QC SMOE';
        } elseif($value['total_pending_smoe'] == 0) {

          if($value['total_rejected_smoe'] > 0) {
            $status_rfi_mv = 'Rejected By QC SMOE';
          } elseif($total_item_mv == $value['total_approved_smoe']) {
            $status_rfi_mv  = "Approved By QC SMOE";
          } elseif($value['total_hold_smoe'] > 0) {
            $status_rfi_mv  = "Hold By QC SMOE";
          } elseif($value['total_pending_client'] > 0) {
            $status_rfi_mv  = "Pending Approval Client";
          } elseif($value['total_pending_client'] == 0) {


            if($value['total_rejected_client'] > 0) {
              $status_rfi_mv  = "Rejected By Client";
            } elseif($total_item_mv == $value['total_approved_client']) {
              $status_rfi_mv   = "Accepted By Client";

              if($value['status_invitation'] == 1) {
                $status_rfi_mv   = "Reviewed By Client";
              }
            } elseif($value['total_approve_comment'] > 0) {
              $status_rfi_mv = "Accepted And Released With Comments";
            } elseif($value['total_postponed'] > 0) {
              $status_rfi_mv = "Postponed By Client";
            } elseif($value['total_reoffer'] > 0) {
              $status_rfi_mv = "Re-Offer By Client";
            } elseif($value['total_void'] == $total_item_mv) {
              $status_rfi_mv = "Void";
            }

          }

        }
      
      ?>

      <?= $status_rfi_mv ?>
    </center>
  </td>
  <td>
    <?php if (isset($comment_mv[$value['report_number']])): ?> 
     <ul>
       <?php foreach ($comment_mv[$value['report_number']] as $v): ?> 
        <li><strong>Reject By</strong> : <?= $user[$v['created_by']]['full_name'] ?> | <strong>Reject Comment</strong> : <?= $v['reject_remarks'] ?> | <strong>Reject Date</strong> : <?= $v['created_date'] ?> | <strong>Reject Item</strong> : Piecemark <?= $piecemark_item[$v['id_piecemark']]['part_id'] ?></li>
        <hr>
        <?php endforeach; ?>
     </ul>
     <?php endif; ?>
  </td>
  <td>
    <?php 
      $legend_ins  = explode(";", $value['legend_inspection_auth']);
    ?>

    <?= $legend_ins[0] == 1 ? 'Hold Point /' : '' ?>
    <?= $legend_ins[1] == 1 ? 'Witness /' : '' ?>
    <?= $legend_ins[2] == 1 ? 'Monitoring /' : '' ?>
    <?= $legend_ins[3] == 1 ? 'Review' : '' ?>

  </td>
  <td>
    <center><?= isset($user[$value['inspection_client_by']]) ? $user[$value['inspection_client_by']]['full_name'] : '-' ?></center>
  </td>
 </tr>
 <?php endforeach; ?>

  <?php foreach ($summary_ft_list as $key => $value): ?>
  <?php 
    
    $total_item_per_report_ft  = count($total_detail_ft[$value['report_number']]);
    
  ?> 
 <tr>
  <td><center><?= $project[$value['project_code']]['project_name'] ?></center></td>
  <td><center><?= $report_no_list['fitup_report'][$value['project_code']][$value['discipline']][$value['module']][$value['type_of_module']].$value['report_number'] ?></center></td>
  <td><center><?= $value['postpone_reoffer_no'] ?></center></td>
  <td><center><?= $deck[$wp_ft[$value['id_workpack']]['deck_elevation']]['name'] ?></center></td>

  <td><center> Fitup </center></td>
  <td><center><?= $value['drawing_no'] ?></center></td>
  <td><center><?= $user[$value['inspector_id']]['full_name'] ?></center></td>
  <td><center>
    
  <?php 

      $area_ft = '';

      if($value['area_v2']) {
        $area_ft .= $area_v2[$value['area_v2']]['name'];

        if($value['location_v2']) {
          $area_ft .= ', '.$location_v2[$value['location_v2']]['name'];

          if($value['point_v2']) {
            $area_ft .= ', '.$point_v2[$value['point_v2']]['name'];
          }

        }

      } else {
        $area_ft = $area[$value['location_inspect']]['area_name'];
      }
    
    ?>

  <?= $area_ft ?></center></td>
  <td><center><?= $value['time_inspect'] ?></center></td>
  <td><center><?= $value['total_item'] ?></center></td>
  <td>
  <center>
      <?php 

        $total_item_ft  = $value['total_item'];
        $status_rfi_ft  = '';

        if($value['total_pending_smoe'] > 0) {
          $status_rfi_ft = 'Pending Approval QC SMOE';
        } elseif($value['total_pending_smoe'] == 0) {

          if($value['total_rejected_smoe'] > 0) {
            $status_rfi_ft = 'Rejected By QC SMOE';
          } elseif($total_item_ft == $value['total_approved_smoe']) {
            $status_rfi_ft  = "Approved By QC SMOE";
          } elseif($value['total_hold_smoe'] > 0) {
            $status_rfi_ft  = "Hold By QC SMOE";
          } elseif($value['total_pending_client'] > 0) {
            $status_rfi_ft  = "Pending Approval Client";
          } elseif($value['total_pending_client'] == 0) {


            if($value['total_rejected_client'] > 0) {
              $status_rfi_ft  = "Rejected By Client";
            } elseif($total_item_ft == $value['total_approved_client']) {
              $status_rfi_ft   = "Accepted By Client";

              if($value['status_invitation'] == 1) {
                $status_rfi_ft   = "Reviewed By Client";
              }

            } elseif($value['total_approve_comment'] > 0) {
              $status_rfi_ft = "Accepted And Released With Comments";
            } elseif($value['total_postponed'] > 0) {
              $status_rfi_ft = "Postponed By Client";
            } elseif($value['total_reoffer'] > 0) {
              $status_rfi_ft = "Re-Offer By Client";
            } elseif($value['total_void'] == $total_item_ft) {
              $status_rfi_ft = "Void";
            }

          }

        }
      
      ?>

      <?= $status_rfi_ft ?>
    </center>
  </td>
  <td>
    <?php if (isset($comment_fitup[$value['report_number']])): ?> 
     <ul>
       <?php foreach ($comment_fitup[$value['report_number']] as $v): ?> 
        <li><strong>Reject By</strong> : <?= $user[$v['created_by']]['full_name'] ?> | <strong>Reject Comment</strong> : <?= $v['reject_remarks'] ?> | <strong>Reject Date</strong> : <?= $v['created_date'] ?> | <strong>Reject Item</strong> : Joint <?= $joint_item[$v['id_joint']]['joint_no'] ?></li>
        <hr>
        <?php endforeach; ?>
     </ul>
     <?php endif; ?>
  </td>
  <td>
    <?php 
      $legend_ins  = explode(";", $value['legend_inspection_auth']);
    ?>

    <?= $legend_ins[0] == 1 ? 'Hold Point /' : '' ?>
    <?= $legend_ins[1] == 1 ? 'Witness /' : '' ?>
    <?= $legend_ins[2] == 1 ? 'Monitoring /' : '' ?>
    <?= $legend_ins[3] == 1 ? 'Review' : '' ?>

  </td>
  <td>
    <center><?= isset($user[$value['inspection_client_by']]) ? $user[$value['inspection_client_by']]['full_name'] : '-' ?></center>
  </td>
 </tr>
 <?php endforeach; ?>

 <?php foreach ($summary_vs_list as $key => $value): ?>
  <?php 
    
    $total_item_per_report_vs  = count($total_detail_vs[$value['report_number']]);
    
  ?> 
 <tr>
  <td><center><?= $project[$value['project_code']]['project_name'] ?></center></td>
  <td><center><?= $report_no_list['visual_rfi'][$value['project_code']][$value['discipline']][$value['module']][$value['type_of_module']].$value['report_number'] ?></center></td>
  <td><center><?= $value['postpone_reoffer_no'] ?></center></td>
  <td><center><?= $deck[$wp_vs[$value['id_workpack']]['deck_elevation']]['name'] ?></center></td>
  <td><center> Visual </center></td>
  <td><center><?= $value['drawing_no'] ?></center></td>
  <td><center><?= $user[$value['inspector_id']]['full_name'] ?></center></td>
  <td><center>
  
  <?php 

      $area_vs = '';

      if($value['area_v2']) {
        $area_vs .= $area_v2[$value['area_v2']]['name'];

        if($value['location_v2']) {
          $area_vs .= ', '.$location_v2[$value['location_v2']]['name'];

          if($value['point_v2']) {
            $area_vs .= ', '.$point_v2[$value['point_v2']]['name'];
          }

        }

      } else {
        $area_vs = $area[$value['location_inspect']]['area_name'];
      }
    
    ?>

  <?= $area_vs ?></center></td>
  <td><center><?= $value['time_inspect'] ?></center></td>
  <td><center><?= $value['total_item'] ?></center></td>
  <td>
  <center>
      <?php 

        $total_item_vs  = $value['total_item'];
        $status_rfi_vs  = '';

        if($value['total_pending_smoe'] > 0) {
          $status_rfi_vs = 'Pending Approval QC SMOE';
        } elseif($value['total_pending_smoe'] == 0) {

          if($value['total_rejected_smoe'] > 0) {
            $status_rfi_vs = 'Rejected By QC SMOE';
          } elseif($total_item_vs == $value['total_approved_smoe']) {
            $status_rfi_vs  = "Approved By QC SMOE";
          } elseif($value['total_hold_smoe'] > 0) {
            $status_rfi_vs  = "Hold By QC SMOE";
          } elseif($value['total_pending_client'] > 0) {
            $status_rfi_vs  = "Pending Approval Client";
          } elseif($value['total_pending_client'] == 0) {


            if($value['total_rejected_client'] > 0) {
              $status_rfi_vs  = "Rejected By Client";
            } elseif($total_item_vs == $value['total_approved_client']) {

              $status_rfi_vs   = "Accepted By Client";

              if($value['status_invitation'] == 1) {
                $status_rfi_vs   = "Reviewed By Client";
              }

            } elseif($value['total_approve_comment'] > 0) {
              $status_rfi_vs = "Accepted And Released With Comments";
            } elseif($value['total_postponed'] > 0) {
              $status_rfi_vs = "Postponed By Client";
            } elseif($value['total_reoffer'] > 0) {
              $status_rfi_vs = "Re-Offer By Client";
            } elseif($value['total_void'] == $total_item_vs) {
              $status_rfi_vs = "Void";
            }

          }

        }
      
      ?>

      <?= $status_rfi_vs ?>
    </center>
  </td>
  <td>
    <?php if (isset($comment_visual[$value['report_number']])): ?> 
     <ul>
       <?php foreach ($comment_visual[$value['report_number']] as $v): ?> 
        <li><strong>Reject By</strong> : <?= $user[$v['created_by']]['full_name'] ?> | <strong>Reject Comment</strong> : <?= $v['client_remarks'] ?> | <strong>Reject Date</strong> : <?= $v['created_date'] ?> | <strong>Reject Item</strong> : Joint <?= $joint_item[$v['id_joint']]['joint_no'] ?></li>
        <hr>
        <?php endforeach; ?>
     </ul>
     <?php endif; ?>
  </td>
  <td>
    <?php 
    $legend_inspection_auth = explode(';', $value['legend_inspection_auth']);

    if($post['legend_inspection_auth'] || $legend_inspection_auth) {
      $inspection_authority = [];
      if(in_array(1, $post['legend_inspection_auth']) OR in_array(1, $legend_inspection_auth)) {
        $inspection_authority[] = 'Hold Point ';
      }
  
      if(in_array(2, $post['legend_inspection_auth']) OR in_array(2, $legend_inspection_auth)) {
        $inspection_authority[] = 'Witness ';
      }
  
      if(in_array(3, $post['legend_inspection_auth']) OR in_array(3, $legend_inspection_auth)) {
        $inspection_authority[] = 'Monitoring ';
      }
  
      if(in_array(4, $post['legend_inspection_auth']) OR in_array(4, $legend_inspection_auth)) {
        $inspection_authority[] = 'Review ';
      } 
  
    } else {
      $inspection_authority = '-';
    }

   
    ?>
     <?= implode('/', $inspection_authority) ?>
  </td>
  <td>
    <center><?= isset($user[$value['inspection_client_by']]) ? $user[$value['inspection_client_by']]['full_name'] : '-' ?></center>
  </td>
 </tr>
 <?php endforeach; ?>
 
</table>