<?php  
  error_reporting(0);
  $legend_inspection_auth = explode(';', $bnp_detail['itp']);

  if($legend_inspection_auth) {
    $inspection_authority = [];
    if(in_array(1, $legend_inspection_auth)) {
      $inspection_authority[] = 'Hold Point ';
    }

    if(in_array(2, $legend_inspection_auth)) {
      $inspection_authority[] = 'Witness ';
    }

    if(in_array(3, $legend_inspection_auth)) {
      $inspection_authority[] = 'Monitoring ';
    }

    if(in_array(4, $legend_inspection_auth)) {
      $inspection_authority[] = 'Review ';
    } 

  } else {
    $inspection_authority = '-';
  }
?>
<html>
  <style type="text/css">
    /* CSS */
    .button-9 {
      appearance: button;
      backface-visibility: hidden;
      background-color: #405cf5;
      border-radius: 6px;
      border-width: 0;
      box-shadow: rgba(50, 50, 93, .1) 0 0 0 1px inset,rgba(50, 50, 93, .1) 0 2px 5px 0,rgba(0, 0, 0, .07) 0 1px 1px 0;
      box-sizing: border-box;
      color: #fff;
      cursor: pointer;
      font-family: -apple-system,system-ui,"Segoe UI",Roboto,"Helvetica Neue",Ubuntu,sans-serif;
      font-size: 100%;
      height: 44px;
      line-height: 1.15;
      margin: 12px 0 0;
      outline: none;
      overflow: hidden;
      padding: 0 25px;
      position: relative;
      text-align: center;
      text-transform: none;
      transform: translateZ(0);
      transition: all .2s,box-shadow .08s ease-in;
      user-select: none;
      -webkit-user-select: none;
      touch-action: manipulation;
      width: 100%;
    }

    .button-9:disabled {
      cursor: default;
    }

    .button-9:focus {
      box-shadow: rgba(50, 50, 93, .1) 0 0 0 1px inset, rgba(50, 50, 93, .2) 0 6px 15px 0, rgba(0, 0, 0, .1) 0 2px 2px 0, rgba(50, 151, 211, .3) 0 0 0 4px;
    }
  </style>
  <body>
    <p>Dear All,</b></p>
    <p>The following Email contain Notification Activity for <?= $activity_desc[$main['id_activity']] ?>.</p>
    <p><b>Employer Inspection Authority : <u><?= implode('/', $inspection_authority).'('.$activity_desc[$main['id_activity']].')' ?></u></b></p>
    <p>Please see the attachment below :</p>
    <p>
    <table style='border-collapse:collapse;border: 1px solid #cccccc;padding:10px;'>
      <tr style='padding:20px !important;'>
        <td>
          <table style='padding:20px !important;'>
            <tr style='font-weight:bold;'>
              <td>RFI No</td>
              <td>:</td>
              <td><?= $report_number ?></td>
            </tr>
            <tr>
              <td>Coating System</td>
              <td>:</td>
              <td><?= $show_paint_system_name[$main['id_paint_system']]['name'] ?></td>
            </tr>
            <tr>
              <td>Inspection Date</td>
              <td>:</td>
              <td><?= DATE('d F, Y', strtotime($main['inspection_date'])).' - '.DATE('d F, Y', strtotime($main['inspection_date_to'])) ?></td>
            </tr>
            <tr>
              <td>Inspection Time</td>
              <td>:</td>
              <td><?= $bnp_detail['expected_time'] ?></td>
            </tr>
            <tr>
              <td>Inspection Location</td>
              <td>:</td>
              <td><?= $area_v2_list[$main['area']]['name'].', '.$location_v2_list[$main['location']]['name'].($main['point'] ? ', '.$point[$main['point']] : '') ?></td>
            </tr>
            <tr>
              <td>Public Address</td>
              <td>:</td>
              <td>
                <a  class='button-9' href='<?php echo getenv('LINK_PCMSV2_OUTSIDE') ?>/planning_bnp/pdf_rfi_potrain/<?= $main['transmittal_uniqid'] ?>'>Link</a>
              </td>
            </tr>
            <tr>
              <td>SMOE Network Address</td>
              <td>:</td>
              <td>
                <a  class='button-9' href="<?= base_url('planning_bnp/pdf_rfi_potrain/').$main['transmittal_uniqid'] ?>">Link</a>
              </td>
            </tr>
          </table>
        </td>                     
      </tr>
    </table>
    
    </p>
    
    <p>Regards,<br/>PT. SMOE Portal<br>(Auto Reminder System)</p>
    <br/>
    <p><b>This is a system generated Email. <br/> Please do not reply to this email address.</b></p>
    <br>
    <b>SMOE-IT Dev-Notif-000024</b>
  </body>
</html>