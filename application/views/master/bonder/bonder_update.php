<style>
  th,
  td {
    vertical-align: middle !important;
  }
</style>
<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="card-title m-0">Update Bonder</h6>
            <?php //test_var($detail, 1) 
            ?>
            <?php //test_var($bankdata, 1) 
            ?>
          </div>
          <div class="card-body bg-white">
            <form action="<?= site_url('master/bonder/proceed_update_bonder') ?>" enctype="multipart/form-data"  method="post">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label text-muted"> Employee</label>
                    <div class="col-xl">
                      <input type="text" name="" class="form-control" disabled value="<?= $bankdata['badge_id'] . ' - ' . $bankdata['nama'] ?>">
                      <input type="hidden" name="id" value="<?= $detail['id'] ?>">

                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label text-muted"> Bonder ID</label>
                    <div class="col-xl">
                      <input type="text" name="bonder_id" class="form-control" required value="<?= $detail['bonder_id'] ?>">
                    </div>
                  </div>
                </div>
                <!-- <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label text-muted"> Client Code</label>
                    <div class="col-xl">
                      <input type="text" name="rwe_code" class="form-control" required value="<?= $detail['rwe_code'] ?>">
                    </div>
                  </div>
                </div> -->
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label text-muted"> Company</label>
                    <div class="col-xl">
                      <select class="form-control select2" name="company">
                        <option value="">---</option>
                        <?php foreach ($company_list as $key => $value) { ?>
                          <option value="<?= $value['id_company'] ?>" <?= $value['id_company'] == $detail['id_company'] ? 'selected' : '' ?>><?= $value['company_name'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label text-muted"> Project</label>
                    <div class="col-xl">
                      <select class="form-control select2" name="project">
                        <option value="">---</option>
                        <?php foreach ($project_list as $key => $value) { ?>
                          <option value="<?= $value['id'] ?>" <?= $value['id'] == $detail['project_id'] ? 'selected' : '' ?>><?= $value['project_name'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label text-muted"> Discipline</label>
                    <div class="col-xl">
                      <select class="form-control select2" name="discipline">
                        <option value="">---</option>
                        <?php foreach ($discipline_list as $key => $value) { ?>
                          <option value="<?= $value['id'] ?>" <?= $value['id'] == $detail['discipline'] ? 'selected' : '' ?>><?= $value['discipline_name'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label text-muted"> Process</label>
                    <div class="col-xl">
                      <select class="form-control select2" name="process">
                        <option value="">---</option>
                        <?php foreach ($master_bonding_process as $key => $value) { ?>
                          <option value="<?= $value['id'] ?>" <?= $value['id'] == $detail['process_id'] ? 'selected' : '' ?>><?= $value['name'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label text-muted"> VSD</label>
                    <div class="col-xl">
                      <input type="date" name="vsd" class="form-control" required value="<?= $detail['vsd'] ?>">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label text-muted"> VED</label>
                    <div class="col-xl">
                      <input type="date" name="ved" class="form-control" required value="<?= $detail['ved'] ?>">
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <hr>
                  <h6 class="card-title"> <i><strong>Certificate File</strong></i></h6>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="table-responsive overflow-auto">
                        <table class="table table-bordered table-sm text-center">
                          <thead class="bg-green-smoe text-white">
                            <th>Certificate File</th>
                            <th>Description</th>
                            <th><button type="button" class="btn btn-success btn-sm" onclick="add_row(this)"><i class="fas fa-plus"></i></button></th>
                          </thead>
                          <tbody id="row_att">
                            <?php foreach ($att_list as $key => $value) : ?>
                              <?php

                              $enc_att  = encrypt($value['attachment_name']);
                              $enc_path = encrypt('/PCMS/pcms_v2/bonder_attachment');
                              $url_att  = site_url('irn/open_file/' . $enc_att . '/' . $enc_path);



                              ?>
                              <tr>
                                <td>
                                  <input type="hidden" name="id_att[]" value="<?= $value['id'] ?>">
                                  <a href="<?= $url_att ?>" target="_blank" class="btn btn-success btn-sm"><i class="fas fa-paperclip"></i></a>
                                </td>
                                <td><textarea name="description[]" class="form-control inputable"> <?= $value['description'] ?></textarea></td>
                                <td><button type="button" class="btn btn-danger btn-sm" onclick="delete_data(this, '<?= encrypt($value['id']) ?>')"><i class="fas fa-trash-alt"></i></button></td>
                              </tr>
                            <?php endforeach; ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <hr>
                  <div class="float-right">
                    <a href="<?= site_url('master/class_data/class_list') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                    <?php if ($this->permission_cookie[0] == 1) : ?>
                      <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Update</button>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<script>
  $('form').on('submit', function() {
    $('button[type=submit]').attr('disabled', true)
  })

  function add_row(btn) {
    let html = `
      <tr>
        <td>
        <input type="hidden" name="id_att[]" value="0">
        <input type="file" name="attachment[]" accept="application/pdf" class="inputable" required></td>
        <td><textarea name="description[]" class="form-control inputable"></textarea></td>
        <td><button type="button" class="btn btn-danger btn-sm" onclick="delete_row(this)"><i class="fas fa-minus"></i></button></td>
      </tr>
    `
    $("#row_att").append(html)
  }

  function delete_row(btn) {
    $(btn).closest('tr').remove()
  }


  function delete_data(btn, id_enc) {

    Swal.fire({
      type: "warning",
      title: "DELETE",
      text: "Are You Sure to Delete This Attachment ? ",
      showCancelButton: true
    }).then((res) => {
      if (res.value) {
        $.ajax({
          url: "<?= site_url('master/bonder/delete_attachment') ?>",
          type: "POST",
          data: {
            id_enc: id_enc
          },
          dataType: "JSON",
          success: (data) => {
            if (data.success) {
              Swal.fire({
                type: "success",
                title: "Data Has Been Deleted !!",
                timer: 1000
              })

              $(btn).closest('tr').remove()
            }
          }
        })
      }
    })

  }
</script>