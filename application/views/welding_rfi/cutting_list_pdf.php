<?php 
  error_reporting(0)
?>

<style>
table {
  border-collapse: collapse;
  width: 100%;
  text-align: center;
}

td {
  word-wrap: break-word !important;
  vertical-align: middle !important;
}

.td_color {
  background-color: #b8cce4;
}

.content {
  font-size: 10px;
}

a {
  color :blue;
}

</style>
<title><?= $title ?></title>
<table border="1">
  <tr>
    <td class="td_color content">No</td>
    <td class="td_color content">Material</td>
    <td class="td_color content">Heat <br> Number</td>
    <td class="td_color content">Thickness <br> (mm)</td>
    <td class="td_color content">Dimension <br> Length x Width <br> (mm)</td>
    <td class="td_color content">Sketch Bevel <br> Preparation</td>
    <td class="td_color content">Angle Bevel</td>
    <td class="td_color content">QTY</td>
    <td class="td_color content">Sketch Of Joint</td>
    <td class="td_color content" style="width: 200px">Remark</td>
  </tr>
  <?php $no = 1; foreach ($cutting_list as $key => $value): ?>
  <tr>
    <td class="content"><?= $no++ ?></td>
    <td class="content"><?= $value['material_grade'] ?></td>
    <td class="content"><?= $value['heat_number'] ?></td>
    <td class="content"><?= $value['thickness'] ?></td>
    <td class="td_color content"><?= $value['dimension'] ?></td>
    <td class="td_color content" style="width: 130px">
      <?php if (isset($attachment[$value['id']]['1'])): ?>
      <?php foreach ($attachment[$value['id']]['1'] as $v): ?>
      <?php
          $mime = mime_content_type($v['temp_file']); 
        ?>
      <?php if (strpos($mime, 'image') !== false): ?>
      <img style="width:auto; height: auto" src="<?= $v['temp_file'] ?>">
      <?php else: ?>
      <a target="_blank" href="https://www.smoebatam.com/pcms_v2_photo/fab_img/<?= $v['attachment_name'] ?>">Attachment</a>
      <?php endif; ?>
      <br>
      <?php endforeach; ?>
      <?php else: ?>
      <?= '' ?>
      <?php endif; ?>
    </td>
    <td class="td_color content"><?= $value['angle_bevel'] ?></td>
    <td class="content"><?= $value['qty'] ?></td>
    <td class="content"  style="width: 130px">
      <?php if (isset($attachment[$value['id']]['2'])): ?>
      <?php foreach ($attachment[$value['id']]['2'] as $v): ?>
      <?php
          $mime = mime_content_type($v['temp_file']); 
        ?>
      <?php if (strpos($mime, 'image') !== false): ?>
        <img style="width:auto; height: auto" src="<?= $v['temp_file'] ?>">
      <?php else: ?>
      <a target="_blank" href="https://www.smoebatam.com/pcms_v2_photo/fab_img/<?= $v['attachment_name'] ?>">Attachment</a>
      <?php endif; ?>
      <br>
      <?php endforeach; ?>
      <?php else: ?>
      <?= '' ?>
      <?php endif; ?>
    </td>
    <td class="content"><?= $value['remarks'] ?></td>
  </tr>
  <?php endforeach; ?>
</table>