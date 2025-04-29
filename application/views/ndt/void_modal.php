<form action="<?= site_url('ndt/request_to_void_v2') ?>" method="post">
  <div class="row">

    <div class="col-md-12">
      <div class="row">

        <div class="col-md-2">
          <label class="label" style="text-align: left !important"><b>Request By :</b></label>
        </div>
        <div class="col">
          <input style="max-width: 160px !important" type="text" name="request_by" class="form-control" value="<?= $this->user_cookie[1] ?>" readonly>
        </div>

        <div class="col-12"><br></div>

        <div class="col-md-2">
          <label class="label" style="text-align: left !important"><b>Request Date :</b></label>
        </div>
        <div class="col">
          <input style="max-width: 160px !important" type="text" name="request_void_date" class="form-control" value="<?= DATE('Y-m-d H:i:s') ?>" readonly>
        </div>

      </div>
    </div>
    
    <div class="col-md-12">
      <br>
      <label class="label" style="text-align: left !important"><b>Reason :</b></label>
      <textarea class="form-control" name="request_void_reason" required=""></textarea>
    </div>

    <div class="col-md-12 mt-2">
      <table class="table dataTable">
        <thead>
          <tr class="bg-green-smoe text-white">
            <th></th>
            <th>Joint No.</th>
            <th>Drawing No.</th>
            <th>Weld Map No.</th>
            <th>Visual Report No.</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($list as $key => $value) { ?>
          <tr>
            <input type="hidden" name="visual_transmittal_no" value="<?= $value['visual_transmittal_no'] ?>">
            <input type="hidden" name="discipline" value="<?= $value['discipline'] ?>">
            <input type="hidden" name="module" value="<?= $value['module'] ?>">
            <input type="hidden" name="type_of_module" value="<?= $value['type_of_module'] ?>">
            <input type="hidden" name="ndt_type" value="<?= $value['ndt_type'] ?>">

            <td>
              <?php if($value['result']==2){ ?>
                <span class="btn btn-warning" title="Can't Void due to Joint NDT Reject!">
                  <i class="fas fa-info-circle"></i>
                </span>
              <?php } else { ?>
                <?php if($value['validator_auth']!=1 AND ($value['irn_status_inspection']!=7 OR $value['irn_status_inspection']!=9)){ ?>
                  <input type="checkbox" name="check[]" value="<?= $value['id_ndt'] ?>">
                <?php } else { ?>
                  <span class="badge badge-warning">
                    <i class="fas fa-times"></i>
                     IRN Approved
                  </span>
                <?php } ?>
              <?php } ?>
            </td>
            <td><?= $value['joint_no'].$value['revision_category'].$value['revision'] ?></td>
            <td><?= $value['drawing_no'] ?></td>
            <td><?= $value['drawing_wm'] ?></td>
            <td><?= $value['report_number'] ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <div class="col-md-12 text-right">
      <hr>
      <button class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
      <button type="submit" class="btn btn-warning"><i class="fas fa-paper-plane"></i> Request Void</button>
    </div>
  </div>
</form>

<script>
  $('.select2').select2({
    theme : 'bootstrap'
  })
  $(document).ready(function() {
    $('form').on('submit', function() {
      $('button[type=submit]').attr('disabled', true)
    })
    // $('.dataTableX').DataTable({
    //   order: [],
    // })
  })
</script>