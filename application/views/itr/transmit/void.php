<?php 
  $list = $itr_list[0];
  $ndt = $itr_ndt[0];
  // test_var($ndt);
?>

<form action="<?= site_url('itr/request_void_ndt') ?>" method="post">
<input type="hidden" name="ndt_rfi_no" value="<?= $ndt['ndt_rfi_no'] ?>">
<input type="hidden" name="ndt_type" value="<?= $ndt['ndt_type'] ?>">
<input type="hidden" name="discipline" value="<?= $list['discipline'] ?>">
<input type="hidden" name="module" value="<?= $list['module'] ?>">
<input type="hidden" name="type_of_module" value="<?= $list['type_of_module'] ?>">
  <div class="row">


  <div class="col-md-12">
    <div class="form-group">
      <label for="" class="text-muted"> NDT RFI No.</label>
      <input type="text"  class="form-control" value="<?= $ndt['ndt_rfi_no'] ?>" disabled>
    </div>
  </div>

  <div class="col-md-12">
    <div class="form-group">
      <label for="" class="text-muted"> Reason</label>
      <textarea class="form-control" name="request_reason"></textarea>
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
    <button type="submit" class="btn btn-success"><i class="fas fa-eye-slash"></i> Void</button>
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