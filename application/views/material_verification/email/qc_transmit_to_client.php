<?php 
     $arr_inspection_auth      = array();

    if($inspect_auth) {

      $list_inspection_authority = explode(";", $inspect_auth);
      if($list_inspection_authority[0] == 1) {
        $arr_inspection_auth[0] = "Hold Point";
      }

      if($list_inspection_authority[1] == 1) {
        $arr_inspection_auth[1] = "Witness";
      }

      if($list_inspection_authority[2] == 1) {
        $arr_inspection_auth[2] = "Monitoring";
      }

      if($list_inspection_authority[3] == 1) {
        $arr_inspection_auth[3] = "Review";
      } 

      $inspection_authority = implode("/", $arr_inspection_auth);

    } else {
      $inspection_authority = '-';
    }

     
  ?>

  <html>
    <body>
      <p>Dear All,</b></p>
      <p>The following Email contain <?= $auth_content ?> for Material Verification Progress.</p>
      <p><b>Employer Inspection Authority : <u><?= $inspection_authority ?></u></b></p>
      <p>Please see the attachment below :</p>
      <p>
      <table style='border-collapse:collapse;border: 1px solid #cccccc;padding:10px;'>
        <tr style='padding:20px !important;'>
          <td>
            <table style='padding:20px !important;'>
              <tr style='font-weight:bold;'>
                <td>RFI No</td>
                <td>:</td>
                <td><?= $rfi_no ?></td>
              </tr>
              <tr>
                <td>Report No</td>
                <td>:</td>
                <td><?= $report_no ?></td>
              </tr>
              <tr>
                <td>Activity Date</td>
                <td>:</td>
                <td><?= $inspect_date ?></td>
              </tr>
              <tr>
                <td>Activity Time</td>
                <td>:</td>
                <td><?= $inspect_time ?></td>
              </tr>
              <tr>
                <td>Location</td>
                <td>:</td>
                <td><?= $inspect_location ?></td>
              </tr>
              <tr>
                <td>Public Address</td>
                <td>:</td>
                <td style="padding:20px;"><a href='<?= $approval_link_public ?>' style='padding:10px;border-radius: 5px;background-color:#000a9c;color:#ffffff;'>Link</a></td>
              </tr>
              <tr>
                <td>SMOE Network Address</td>
                <td>:</td>
                <td style="padding:20px;"><a href='<?= $approval_link_smoe ?>' style='padding:10px;border-radius: 5px;background-color:#000a9c;color:#ffffff;'>Link</a></td>
              </tr>
            </table>
          </td>                     
        </tr>
      </table>
      
      </p>
      
      <p>Regards,<br/>PT. SMOE Portal<br>(Auto Reminder System)</p>
      <br/>
      <p><b>This is a system generated Email. <br/> Please do not reply to this email address. <br>SMOE-IT Dev-Notif-000038
</b></p>
    </body>
  </html>