<?php 

  $list = $itr_list[0];

?>

<form action="<?= site_url('itr/proceed_transmit_ndt') ?>" method="post">
<input type="hidden" name="project_code" value="<?= $list['project_code'] ?>">
<input type="hidden" name="discipline" value="<?= $list['discipline'] ?>">
<input type="hidden" name="module" value="<?= $list['module'] ?>">
<input type="hidden" name="type_of_module" value="<?= $list['type_of_module'] ?>">
<input type="hidden" name="transmittal_uniqid" value="<?= $list['transmittal_uniqid'] ?>">
  <div class="row">


  <div class="col-md-12">
    <div class="form-group">
      <label for="" class="text-muted"> ITR Report Number</label>
      <input type="text"  class="form-control" value="<?= $report_no_format[$list['project_code']][$list['discipline']][$list['module']][$list['type_of_module']]['itr_no'] ?>-<?= $list['report_number'] ?>" disabled>
    </div>
  </div>

  <div class="col-md-12">
    <div class="form-group">
      <label for="" class="text-muted"> NDT Method</label>
      <select name="ndt_type" class="select2" style="width:100%" required>
        <option value="">---</option>
        <?php foreach ($ndt_method as $key => $value): ?> 
         <option value="<?= $value['id'] ?>"> <?= $value['ndt_description'] ?> (<?= $value['ndt_initial'] ?>)</option>
         <?php endforeach; ?>
      </select>
    </div>
  </div>

  <div class="col-md-12">
    <div class="form-group">
      <label for="" class="text-muted"> NDT Vendor</label>
      <select name="vendor_id" class="select2" style="width:100%" required>
        <option value="">---</option>
        <?php foreach ($company_list as $key => $value): ?> 
         <option value="<?= $value['id_company'] ?>"><?= $value['company_name'] ?></option>
         <?php endforeach; ?>
      </select>
    </div>
  </div>

  <div class="col-md-12">
    <hr>
    <table class="table dataTableX table-hover text-center table-responsive" width="100%">
      <thead class="bg-info text-white">
        <th>No</th>
        <th>Piece Mark / Tag No</th>
        <th>Unique No</th>
        <th>Spec / Grade</th>
        <th>Heat No</th>
        <th>Length</th>
        <th>Thickness</th>
        <th>Sch</th>
        <th>Profile</th>
      </thead>
      <tbody>
      <?php $no = 1;
        $total_already_in_client = 0;
        foreach ($itr_list as $key => $value) : ?>
          <tr>
            <td>
              <input type="checkbox" class="form-control" name="id[]" value="<?= $value['id_itr'] ?>">
              <input type="hidden" name="id_piecemark[]" value="<?= $value['id_piecemark'] ?>">
              <input type="hidden" name="id_itr" value="<?= $value['id_itr'] ?>">
            </td>
            <td>
              <?= $value['part_id'] ?>
            </td>

            <td><?= $detail_mis[$value['id_mis']]['unique_no'] ?></td>
            <td><?= $grade[$value['grade']] ?></td>
            <td><?= $detail_mis[$value['id_mis']]['heat_or_series_no'] ?></td>
            <td><?= $value['length'] ?></td>
            <td><?= $value['thickness'] ?></td>
            <td><?= $value['sch'] ?></td>
            <td><?= $value['profile'] ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <div class="col-md-12 text-right">
    <hr>
    <button data-dismiss="modal"  class="btn btn-danger"><i class="fas fa-times"></i> Close</button>
    <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Transmit</button>
  </div>
  </div>
</form>

<script>

  $('.select2').select2({
    theme : 'bootstrap'
  })
  $("form").on('submit', function() {
    $('button[type="submit"]').attr('disabled', true)
  })
</script>