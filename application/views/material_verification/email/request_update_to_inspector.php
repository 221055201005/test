<html>

<body>
  <p>Dear Mr/Ms. <strong><?= $inspector_fullname ?></strong>,</p>

  <p>Mr/Ms. <?= $requestor ?> has been submitting request update for PCMS - Material Verification which has been
    approved by you.</p>
  <p>Please refer to the following link address to approve or reject this request :</p>
  <p>
  <table>
    <tr>
      <td>Submission Id</td>
      <td>:</td>
      <td><strong><?= $submission_id ?></strong></td>

    </tr>
    <tr>
      <td>Request Reason</td>
      <td>:</td>
      <td><?= $purpose ?></td>

    </tr>

    <tr>
      <td>Approval Pages</td>
      <td>:</td>
      <td><a href="<?= $links_docs ?>" target='_blank'><b>Link</b></a></td>

    </tr>
    <tr>
      <td>Internet Browser</td>
      <td>:</td>
      <td>Google Chrome</td>
    </tr>
  </table>
  </p>

  <p>Regards,<br />SMOE Portal<br>(Auto Reminder System)</p>
  <p><b>This email auto generated by system. <br /> Please do not reply to this email address. <br>SMOE-IT Dev-Notif-000042
</b></p>
</body>

</html>