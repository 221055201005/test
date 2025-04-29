<?php foreach ($data_piecemark as $key => $value) : ?>

  <?php

$ga_ready   = true;
$as_ready   = true;
$sp_ready   = true;

$alert_drawing = false;

if ($value['drawing_ga']) {
  if (!isset($shop_drawing[$value['drawing_ga']])) {
    $ga_ready   = false;
  }
}

if ($value['drawing_as']) {
  if (!isset($shop_drawing[$value['drawing_as']])) {
    $as_ready   = false;
  }
}

if ($value['drawing_sp']) {
  if (!isset($shop_drawing[$value['drawing_sp']])) {
    $sp_ready   = false;
  }
}

if (!$ga_ready || !$as_ready || !$sp_ready) {
  $alert_drawing = true;
}

?>

<tr class="<?= $alert_drawing ? 'warning-message' : '' ?>">
  <td class="text-nowrap">
    <?php if (!$alert_drawing) : ?>
      <input type="checkbox" class="check" name="id[<?= $key ?>]" value="<?= $value['id_material'] ?>" style="width:20px; height:20px;" <?= $submission_id ? '' : 'disabled' ?>>
    <?php endif; ?>

    <input type="hidden" name="status_inspection[<?= $key ?>]" value="<?= $value['status_inspection'] ?>">
  </td>
  <td class="text-nowrap"><?= $project[$value['project']] ?></td>

  <td class="text-nowrap"><?= $value['workpack_no'] ?></td>
  <td class="text-nowrap"><?= $value['submission_id'] ?></td>
  <td class="text-nowrap"><?= $value['drawing_ga'] ?>
    <!-- Rev. <?= $value['rev_ga'] ?> -->
  </td>
  <td class="text-nowrap">
    <?php if ($value['drawing_as']) : ?>
      <?= $value['drawing_as'] ?>
      <!-- Rev. <?= $value['rev_as'] ?> -->
    <?php endif; ?>
  </td>
  <td class="text-nowrap"><?= $value['drawing_sp'] ?>
    <!-- Rev. <?= $value['rev_sp'] ?> -->
  </td>
  <td>
    <select name="rev_drawing_sp[<?= $key ?>]" class="select2 editable" style="width:100%" disabled>
      <?php if (isset($rev_sp[$value['drawing_sp']])) : ?>
        <?php foreach ($rev_sp[$value['drawing_sp']] as $v) : ?>
          <option value="<?= $v ?>"><?= $v ?></option>
        <?php endforeach; ?>
      <?php endif; ?>
    </select>
  </td>
  <td class="text-nowrap"><?= $discipline_name[$value['discipline']] ?></td>
  <td class="text-nowrap"><?= $module_name[$value['module']] ?></td>
  <td class="text-nowrap"><?= $module_type_name[$value['type_of_module']] ?></td>
  <td class="text-nowrap"><?= $value['part_id'] ?></td>
  <td class="text-nowrap"><?= $value['thickness'] ?></td>
  <td class="text-nowrap"><?= $grade[$value['grade']] ?></td>
  <td class="text-nowrap">
    <input type="text" name="unique_no[<?= $key ?>]" class="form-control <?= $value['status_inspection'] == 6 ? 'editable' : '' ?>" placeholder="Unique Number" value="<?= $detail_mis[$value['id_mis']]['unique_no'] ?>" onfocus="autocomplete_unique(this, '<?= $value['workpack_no'] ?>', <?= $value['grade'] ?>, <?= $value['id_workpack'] ?>)" onblur="validate_unique_no(this, '<?= $value['workpack_no'] ?>', <?= $value['grade'] ?>, <?= $value['id_workpack'] ?>)" disabled>

    <input type="hidden" name="id_mis[<?= $key ?>]" value="<?= $value['id_mis'] ?>" class="id_mis">

    <input type="hidden" name="id_piecemark[<?= $key ?>]" value="<?= $value['id_piecemark'] ?>" class="id_mis">
    <div class="invalid-feedback"></div>
  </td>
  <!-- <td class="text-nowrap"><input type="text" class="form-control heat_no"
    placeholder="Heat Number"
    value="<?= $detail_mis[$value['id_mis']]['heat_or_series_no'] ?>" disabled></td>
<td class="text-nowrap">

  <?php if (isset($mis_piping[$value['id_mis']])) : ?>
  <input type="text" class="form-control material_description"
    placeholder="Material Description"
    value="<?= $material_piping[$detail_mis[$value['id_mis']]['catalog_id']]['item_name'] ?>"
    disabled>

  <?php else : ?>
  <input type="text" class="form-control material_description"
    placeholder="Material Description"
    value="<?= $detail_mis[$value['id_mis']]['catalog_category'] ?>" disabled>

  <?php endif; ?>

</td>
<td class="text-nowrap"><input type="text" class="form-control mrir" placeholder="MRIR Number"
    value="<?= explode('/', $detail_mis[$value['id_mis']]['report_no'])[1] ?>" disabled></td> -->
  <td class="text-nowrap"><?= $user[$value['inspection_by']]['full_name'] ?></td>
  <td class="text-nowrap"><?= $value['inspection_datetime'] ?></td>
  <td class="text-nowrap">
    <?php if ($value['area_v2']) : ?>
      <?= $area_v2[$value['area_v2']]['name'] ?>
    <?php else : ?>
      <?= $area[$value['area']]['area_name'] ?>
    <?php endif; ?>

  </td>

  <td>
    <?php if (isset($location_v2[$value['location_v2']])) : ?>
      <?= $location_v2[$value['location_v2']]['name'] ?>
    <?php else : ?>
      -
    <?php endif; ?>
  </td>

  <td>
    <?php if (isset($point_v2[$value['point_v2']])) : ?>
      <?= $point_v2[$value['point_v2']]['name'] ?>
    <?php else : ?>
      -
    <?php endif; ?>
  </td>

  <td class="text-nowrap"><?= $value['inspection_remarks'] ?></td>
  <td class="text-nowrap">
    <?php if ($value['status_inspection'] == 3) : ?>
      <span class="badge badge-info badge-pill">Ready to Transmit</span>
    <?php elseif ($value['status_inspection'] == 6) : ?>
      <span class="badge badge-danger badge-pill">Rejected</span>
    <?php elseif ($value['status_inspection'] == 7) : ?>
      <span class="badge badge-success badge-pill">Accepted By Client</span>
    <?php elseif ($value['status_inspection'] == 9) : ?>
      <span class="badge badge-primary badge-pill">Accepted And Released With Comment</span>
    <?php elseif ($value['status_inspection'] == 10) : ?>
      <span class="badge badge-info badge-pill">Postponed</span>
    <?php elseif ($value['status_inspection'] == 11) : ?>
      <span class="badge badge-warning badge-pill">Re-Offer</span>
    <?php endif; ?>
  </td>
  <td style="min-width: 15rem !important;">
    <?= $value['rejected_client_remarks'] ?>
  </td>
  <td class="text-nowrap">
    <?php if ($alert_drawing) : ?>

      <?php if (!$ga_ready) : ?>
        Drawing GA Still Not Issued For Construction
      <?php endif; ?>

      <?php if (!$as_ready) : ?>
        Drawing AS Still Not Issued For Construction
      <?php endif; ?>

      <?php if (!$sp_ready) : ?>
        Drawing SP Still Not Issued For Construction
      <?php endif; ?>

    <?php endif; ?>
  </td>
</tr>
<?php endforeach; ?>