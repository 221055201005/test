<div id="content" class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <h4 class="card-title"><i class="fas fa-search"></i> Filter</h4>
          <hr>
          <form action="" method="POST">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-xl-3 col-form-label text-muted">WPS Company</label>
                  <div class="col-xl">
                    <select class="select2" style="width:100%" name="company_id">
                      <option value="">---</option>
                      <?php foreach ($company_list as $key => $value) : ?>
                        <option value="<?= $value['id_company'] ?>" <?= $this->input->post('company_id') == $value['id_company'] ? 'selected' : '' ?>><?= $value['company_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-xl-3 col-form-label text-muted">WPS Project</label>
                  <div class="col-xl">
                    <select class="select2" style="width:100%" name="project_id">
                      <option value="">---</option>
                      <?php foreach ($master_project as $key => $value) : ?>
                        <?php if (in_array($value['id'], $this->user_cookie[13])) : ?>
                          <option value="<?= $value['id'] ?>" <?= $this->input->post('project_id') == $value['id'] ? 'selected' : '' ?>><?= $value['project_name'] ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-xl-3 col-form-label text-muted">Discipline</label>
                  <div class="col-xl">
                    <select class="select2" name="discipline">
                      <option value="">---</option>
                      <?php foreach ($discipline_list as $key => $value) : ?>
                        <option value="<?= $value['id'] ?>" <?= $this->input->post('discipline') == $value['id'] ? 'selected' : '' ?>><?php echo $value['discipline_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-md-12 text-right">
                <hr>
                <button id='button_search' type="submit" name="submit" value="search" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="col-md-12">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>

        <div class="card-body bg-white">
          <?php if ($this->permission_cookie[113] == '1') { ?>
            <a href="<?php echo base_url() ?>master/wps/wps_new" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Add New</a>
          <?php } ?>
          <?php if ($this->permission_cookie[116] == '1') { ?>
            <a href="<?php echo base_url() ?>master/wps/wps_list/excel" class="btn btn-sm btn-success"><i class="far fa-file-excel"></i> Download Register</a>
          <?php } ?>
          <?php if (in_array(21, $this->user_cookie[13])) { ?>
            <a href="<?php echo base_url() ?>master/wps/wps_import" class="btn btn-sm btn-warning"><i class="fas fa-cloud-upload-alt"></i> Import Register</a>
          <?php } ?>
          <?php if ($this->permission_cookie[112] == '1') { ?>
            <br><br>
            <div class="overflow-auto">
              <table class="table table-hover text-center dataTable">
                <thead class="bg-gray-table">
                  <tr>
                    <th>No</th>
                    <th>WPS no</th>
                    <th>WPS Company</th>
                    <th>WPS Project</th>
                    <th>WPS Revision</th>
                    <th>Discipline</th>
                    <th>Process</th>
                    <th>Material Grade</th>
                    <th>Thickness Range (mm)</th>
                    <th>Diameter Range (mm)</th>
                    <th>Type Of Joint</th>
                    <th>Remarks</th>
                    <?php if ($this->permission_cookie[115] == '1') { ?>
                      <th>Attachment</th>
                    <?php } ?>
                    <th>Status</th>
                    <?php if ($this->permission_cookie[109] == '1') { ?>
                      <th></th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1;
                  foreach ($wps_list as $key => $value) : ?>
                    <tr>
                      <td><?php echo $no ?></td>
                      <td><?php echo $value["wps_no"] ?></td>
                      <td><?php echo $company_list[$value["company_id"]]['company_name'] ?></td>
                      <td><?php echo $master_project[$value["project_id"]]['project_name'] ?></td>
                      <td><?php echo $value["wps_revision"] ?></td>
                      <td><?php echo @$discipline_list[$value["discipline"]]["discipline_name"] ?></td>
                      <td>
                        <?php foreach ($wps_detail_list[$value["id_wps"]] as $process) {
                          echo $master_welder_process[$process['id_weld_process']] . "</br>";
                        } ?></td>
                      <td>
                        <?php foreach ($wps_detail_list[$value["id_wps"]] as $material_grade) {
                          echo @$material_grade_list[$material_grade["material_grade"]]["material_grade"] . "</br>";
                        } ?></td>
                      <td>
                        <?php foreach ($wps_detail_list[$value["id_wps"]] as $thickness) {
                          echo $thickness['thickness'] . "</br>";
                        } ?></td>
                      <td>
                        <?php foreach ($wps_detail_list[$value["id_wps"]] as $diameter) {
                          echo $diameter['diameter'] . "</br>";
                        } ?></td>
                      <td>
                        <?php foreach ($wps_detail_list[$value["id_wps"]] as $type_of_joint) {
                          echo @$joint_type_list[$type_of_joint['type_of_joint']]["joint_type_code"] . "</br>";
                        } ?></td>
                      <td><?php echo $value["remarks"] ?></td>
                      <?php if ($this->permission_cookie[115] == '1') { ?>
                        <td>
                          <?php if (isset($value["attachment"])) { ?>
                            <?php
                            $enc_redline = strtr($this->encryption->encrypt($value["attachment"]), '+=/', '.-~');
                            $enc_path   = strtr($this->encryption->encrypt('/PCMS/pcms_v2/wps_attachment/'), '+=/', '.-~');
                            ?>
                            <a target='_blank' href='<?= site_url('irn/open_file/' . $enc_redline . '/' . $enc_path) ?>'><span class='btn btn-primary'><i class="fas fa-images"></i></span></a>
                            <br />
                          <?php } else { ?>
                            -
                          <?php } ?>
                        </td>
                      <?php } ?>
                      <td>
                        <?php if ($value["status_wps"] == 1) : ?>
                          <span class="badge badge-success">Actived</span>
                        <?php else : ?>
                          <span class="badge badge-danger">Non-Actived</span>
                        <?php endif; ?>
                      </td>
                      <?php if ($this->permission_cookie[109] == '1') { ?>
                        <td>
                          <a href="<?php echo base_url() ?>master/wps/wps_update_pages/<?php echo strtr($this->encryption->encrypt($value["id_wps"]), '+=/', '.-~') ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                          <button type="button" class="btn btn-danger" onclick="delete_wps_list(this, <?php echo $value['id_wps']; ?>)"><i class="fas fa-trash"></i></button>
                        </td>
                      <?php } ?>
                    </tr>
                  <?php $no++;
                  endforeach; ?>
                </tbody>
              </table>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $('.dataTable').DataTable({
    "order": []
  });

  function delete_wps_list(btn, id_wps) {
    Swal.fire({
      type: "warning",
      title: `Are you sure to <b class=text-danger>&nbsp;Delete&nbsp;</b> this?`,
      html: `<p>You won't be able to revert this!</p>`,
      showCancelButton: true
    }).then((res) => {
      if (res.value) {
        $.ajax({
          url: "<?= site_url('master/wps/delete_wps_list') ?>",
          type: "POST",
          data: {
            id_wps: id_wps
          },
          dataType: "JSON",
          success: function(data) {
            if (data.success) {
              Swal.fire({
                type: "success",
                title: "Success",
                text: "Success Delete Data",
                timer: 1000
              })

              $(btn).closest('tr').remove()

            } else {
              Swal.fire({
                type: "error",
                title: "Something Wrong",
                text: "WPS Already Submitted",
                timer: 1000
              })
            }
          }
        })
      }
    })
  }
</script>