<?php  
  error_reporting(0);
    // test_var($postmail);
  $legend_inspection_auth = explode(';', $postmail['legend_inspection_auth']);

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

Dear All,
<br>
<br>
<b>Mr/Ms. <?= $this->user_cookie[1] ?>,</b>
<br>
<br>
Has been Transmited <b>Visual - Report No <?= $reno_view ?></b> for <?= $text_invi ?> Visual Inspection Progress
<br>
  <b>Employer Inspection Authority : <?= implode('/ ', $inspection_authority) ?></b>
<br>
<br>
Please refer to link Address on below :
<br>
<br>
<table>
  <tr>
    <td>Inspection Document</td>
    <td>:</td>
    <td> Link ( <a href="<?= $pdf_link ?>">PDF Print Out</a> )</td>
  </tr>
  <tr>
    <td>Portal Link</td>
    <td>:</td>
    <td> Link ( <a href="<?php echo getenv('LINK_SERVER') ?>"><?php echo getenv('LINK_SERVER') ?></a> )</td>
  </tr>
  <tr>
    <td>Internet Browser</td>
    <td>:</td>
    <td> Google Chrome</td>
  </tr>
</table>
<br>
<table border="1" style="width: 100%; border-collapse : collapse">
  <tr>
    <td><strong><center>Inspector Name</center></strong></td>
    <td><strong><center>Invitation Date</center></strong></td>
    <td><strong><center>Invitation Time</center></strong></td>
    <td><strong><center>Location</center></strong></td>
  </tr>
  <tr>
    <td><center><?= $inspector_name ?></center></td>
    <td><center><?= $post['inspect_date'] ?></center></td>
    <td><center><?= $post['inspect_time'] ?></center></td>
    <td><center><?= $inspect_location ?></center></td>
  </tr>
</table>

Regards,
<br>
SMOE Portal
<br>
(Auto Reminder System)
<br>
<br>

<b>This email auto generated by system.</b>
<br>
<b>Please do not reply to this email address.</b>
<br>
    <b>SMOE-IT Dev-Notif-000024</b>