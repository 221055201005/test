<?php 
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename = Report Multiple GA.xls");
  header("Pragma: no-cache");
  header("Expires: 0");
?>

<!DOCTYPE html>
<html>
<head> 
</head>
<body>
  <table class="table-body" width='100%' border="1" style="text-align: center;border-collapse: collapse !important; margin-left: -25px;">
    <thead>
      <tr>
        <th style="vertical-align: middle !important;"><center>No</center></th>
        <th style="vertical-align: middle !important;"><center>Report No</center></th>
        <th style="vertical-align: middle !important;"><center>Discipline</center></th>
        <th style="vertical-align: middle !important;"><center>Drawing No</center></th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1;
        foreach ($beda as $key => $value) { ?>
          <tr>
            <td style="vertical-align: middle !important;"><center><?= $no++ ?></center></td>
            <td style="vertical-align: middle !important;"><center>'<?= $key ?></center></td>
            <td style="vertical-align: middle !important;"><center><?= "PIPING" ?></center></td>
            <td style="vertical-align: middle !important;"><center>
             <?php foreach ($value as $v): ?> 
              <?= implode("<br>", $v) ?>
              <?php endforeach; ?>
            </center></td>
          </tr>
        <?php } ?>
      </tbody>  
  </table>
</body>
</html>