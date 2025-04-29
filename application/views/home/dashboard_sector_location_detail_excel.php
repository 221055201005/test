<?php
  error_reporting(0);
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=Dashboard Sector (".date("Y-m-d H:i:s").").xls");
?>
<table border="1">
  <thead>
    <tr>
      <th>Drawing GA/AS</th>
      <th>Drawing WM</th>
      <th>Joint No.</th>
      <th>Grid</th>
      <th>Column</th>
      <?php if($get['type'] == 'fabrication'): ?>
        <th>Fitup Status</th>
        <th>Visual Status</th>
      <?php elseif($get['type'] == 'ndt'): ?>
        <th>RT Status</th>
        <th>MT Status</th>
        <th>UT Status</th>
      <?php endif; ?>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($joint_list as $key => $value): ?>
      <?php
        $status_final = 0;
        if($get['type'] == 'fabrication'){
          if(!in_array(@$status_list[$key]['visual'], [0, 1, 2, 4, 6, 8, 12])){
            $status_final = 1;
          }
        }
        elseif($get['type'] == 'ndt'){

        }
      ?>
      <tr>
        <td><?= $value['drawing_no'] ?></td>
        <td><?= $value['drawing_wm'] ?></td>
        <td><?= $value['joint_no'] ?></td>
        <td><?= $value['grid_row'] ?></td>
        <td><?= $value['grid_column'] ?></td>
        <?php if($get['type'] == 'fabrication'): ?>
          <td>
            <?php if(@$status_list[$key]['fitup'] == "0"): ?>
              Ready to Submit RFI
            <?php elseif(@$status_list[$key]['fitup'] == 1): ?>
              Pending Approval QC
            <?php elseif(@$status_list[$key]['fitup'] == 2): ?>
              Rejected by QC
            <?php elseif(@$status_list[$key]['fitup'] == 3): ?>
              Approved by QC
            <?php elseif(@$status_list[$key]['fitup'] == 4): ?>
              Pending by QC
            <?php elseif(@$status_list[$key]['fitup'] == 5): ?>
              Pending Approval Client
            <?php elseif(@$status_list[$key]['fitup'] == 6): ?>
              Rejected by Client
            <?php elseif(@$status_list[$key]['fitup'] == 7): ?>
              Approved by Client
            <?php elseif(@$status_list[$key]['fitup'] == 8): ?>
              Request for Update
            <?php elseif(@$status_list[$key]['fitup'] == 9): ?>
              Client RFI - Accepted with Comment
            <?php elseif(@$status_list[$key]['fitup'] == 10): ?>
              Client RFI - Postponed
            <?php elseif(@$status_list[$key]['fitup'] == 11): ?>
              Client RFI - Re-Offer
            <?php elseif(@$status_list[$key]['fitup'] == 12): ?>
              Void
            <?php else: ?>
              Not Ready
            <?php endif; ?>
          </td>
          <td>
            <?php if(@$status_list[$key]['visual'] == "0"): ?>
              Ready to Submit RFI
            <?php elseif(@$status_list[$key]['visual'] == 1): ?>
              Pending Approval QC
            <?php elseif(@$status_list[$key]['visual'] == 2): ?>
              Rejected by QC
            <?php elseif(@$status_list[$key]['visual'] == 3): ?>
              Approved by QC
            <?php elseif(@$status_list[$key]['visual'] == 4): ?>
              Pending by QC
            <?php elseif(@$status_list[$key]['visual'] == 5): ?>
              Pending Approval Client
            <?php elseif(@$status_list[$key]['visual'] == 6): ?>
              Rejected by Client
            <?php elseif(@$status_list[$key]['visual'] == 7): ?>
              Approved by Client
            <?php elseif(@$status_list[$key]['visual'] == 8): ?>
              Request for Update
            <?php elseif(@$status_list[$key]['visual'] == 9): ?>
              Client RFI - Accepted with Comment
            <?php elseif(@$status_list[$key]['visual'] == 10): ?>
              Client RFI - Postponed
            <?php elseif(@$status_list[$key]['visual'] == 11): ?>
              Client RFI - Re-Offer
            <?php elseif(@$status_list[$key]['visual'] == 12): ?>
              Void
            <?php else: ?>
              Not Ready
            <?php endif; ?>
          </td>
        <?php elseif($get['type'] == 'ndt'): ?>
          <td>
            <?php if(@$status_list[$key]['1'] == ''): ?>
              <?php $status_final += 1; ?>
              -
            <?php elseif(@$status_list[$key]['1'] == '-1'): ?>
              Not Requested Yet
            <?php elseif(@$status_list[$key]['1'] == '0'): ?>
              Pending
            <?php elseif(@$status_list[$key]['1'] == '2'): ?>
              Reject
            <?php elseif(@$status_list[$key]['1'] == '3'): ?>
              <?php $status_final += 1; ?>
              Approved
            <?php endif; ?>
          </td>
          <td>
            <?php if(@$status_list[$key]['2'] == ''): ?>
              <?php $status_final += 1; ?>
              -
            <?php elseif(@$status_list[$key]['2'] == '-1'): ?>
              Not Requested Yet
            <?php elseif(@$status_list[$key]['2'] == '0'): ?>
              Pending
            <?php elseif(@$status_list[$key]['2'] == '2'): ?>
              Reject
            <?php elseif(@$status_list[$key]['2'] == '3'): ?>
              <?php $status_final += 1; ?>
              Approved
            <?php endif; ?>
          </td>
          <td>
            <?php if(@$status_list[$key]['3'] == ''): ?>
              <?php $status_final += 1; ?>
              -
            <?php elseif(@$status_list[$key]['3'] == '-1'): ?>
              Not Requested Yet
            <?php elseif(@$status_list[$key]['3'] == '0'): ?>
              Pending
            <?php elseif(@$status_list[$key]['3'] == '2'): ?>
              Reject
            <?php elseif(@$status_list[$key]['3'] == '3'): ?>
              <?php $status_final += 1; ?>
              Approved
            <?php endif; ?>
          </td>
          <?php $status_final = $status_final/3; ?>
        <?php endif; ?>
        <td>
          <?php if(@$status_final == 1): ?>
            Complete
          <?php else: ?>
            In Progress
          <?php endif; ?>
        </td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>