<style>
  .width_custom_class {
    min-width: 100px !important;
  }

  .width_custom_process {
    min-width: 150px !important;
  }

  .width_custom_f_pos_number {
    min-width: 50px !important;
  }

  .width_custom_pos_dia_thk_range {
    min-width: 150px !important;
  }

  .width_custom_backing_range {
    min-width: 500px !important;
  }

  th,
  td {
    vertical-align: middle !important;
  }
</style>
<style>
  a[aria-expanded=true] .fa-angle-double-down {
   display: none;
  }

  a[aria-expanded=false] .fa-angle-double-up {
    display: none;
  }
</style>
<div id="content" class="container-fluid">

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
           <a class="btn btn-primary" data-toggle="collapse" href="#collapseButton" role="button" aria-expanded="false" aria-controls="collapseButton">Filter &nbsp; <i class="fas fa-angle-double-down"></i><i class="fas fa-angle-double-up"></i></a>
        </div>
        <div class="collapse <?= $this->input->post() ? 'show' : '' ?>" id="collapseButton"> 
	        <div class="card-body bg-white overflow-auto">
	          <form action="" method="POST">
	            <div class="row">
	              <div class="col-6">
	                <div class="form-group row">
	                  <label class="col-md-4 col-lg-3 col-form-label ">Project ID</label>
	                  <div class="col-xl">
	                    <select class="form-control select2" name="project">
	                      <option value="">---</option>
	                      <?php foreach ($project_lists as $key => $value) : ?>
	                        <option value="<?php echo $value['id'] ?>" <?php echo (@$post['project'] == $value['id'] ? 'selected' : ($this->user_cookie[10] == $value['id'] ? 'selected' : '')) ?>><?php echo $value['project_name'] ?></option>
	                      <?php endforeach; ?>
	                    </select>
	                  </div>
	                </div>
	              </div>

	              <div class="col-6">
	                <div class="form-group row">
	                  <label class="col-md-4 col-lg-3 col-form-label ">Company</label>
	                  <div class="col-xl">

	                    <select class="form-control select2" name="company">
	                      <option value="">---</option>
	                      <?php foreach ($company_list as $key => $value) : ?>
	                        <option value="<?php echo $value['id_company'] ?>" <?php echo (@$post['company'] == $value['id_company'] ? 'selected' : '') ?>><?php echo $value['company_name'] ?></option>
	                      <?php endforeach; ?>
	                    </select>
	                  </div>
	                </div>
	              </div>
	            </div>

	            <div class="row">
	              <div class="col-12 text-right">
	                <button id='button_search' class="mt-2 btn btn-sm btn-flat btn-info"><i class="fas fa-search"></i> Search</button>
	              </div>
	            </div>
	          </form>
	        </div>
	      </div>
      </div>
    </div>
  </div>

  <div class="card shadow my-3 rounded-0">
    <div class="card-header">
      <h6 class="m-0"><?php echo $meta_title ?></h6>
    </div>

    <div class="card-body bg-white">

      <?php if ($this->permission_cookie[108] == '1') { ?>
        <a href="<?php echo base_url() ?>master/bonder/bonder_new" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Add New</a>
      <?php } ?>

      <?php if ($this->permission_cookie[107] == '1') { ?>
        <br>
        <br>
        <div class="overflow-auto">
          <table class="table text-center dataTable">
            <thead class="bg-gray-table">
              <tr>
                <th>No</th>
                <th>Bonder Code</th>
                <!-- <th>Client Code</th> -->
                <th>Company</th>
                <th>Project</th>

                <th>Bonder Badge</th>
                <th>Bonder Name</th>

                <th>Discipline</th>
                <th>Process</th>
                <th>Certificate</th>
                <th>Validity Start Date</th>
                <th>Validity End Date</th>
                <th>Status</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($bonder_list as $key => $value) : ?>
                <?php
                $bank_data = $bankdata_data_id[$value["id_bank_data"]];
                ?>
                <tr>
                  <td><?php echo $no ?></td>
                  <td><?php echo $value["bonder_id"] ?></td>
                  <!-- <td><?php echo $value["rwe_code"] ?></td> -->
                  <td><?php echo $company_list[$value["id_company"]]['company_name']; ?></td>
                  <td><?php echo $project[$value["project_id"]]['project_name'] ?></td>

                  <td><?php echo $bank_data["badge_id"] ?></td>
                  <td><?php echo $bank_data["nama"] ?></td>

                  <td><?php echo $discipline_list[$value["discipline"]]['discipline_name'] ?></td>
                  <td><?php echo $process[$value["process_id"]] ?></td>
                  <td>
                    <?php if (isset($att[$value['id']])) : ?>
                      <div class="bg-white">
                        <table class="table table-sm text-center table-bordered">
                          <thead class="bg-success">
                            <th>Certificate</th>
                            <th>Description</th>
                          </thead>
                          <tbody>
                            <?php foreach ($att[$value['id']] as $v) : ?>
                              <?php

                              $enc_att  = encrypt($v['attachment_name']);
                              $enc_path = encrypt("/PCMS/pcms_v2/bonder_attachment");
                              $url_att  = site_url('irn/open_file/' . $enc_att . '/' . $enc_path);

                              ?>
                              <tr>
                                <td><a href="<?= $url_att ?>" target="_blank" class="btn btn-sm btn-success"><i class="fas fa-paperclip"></i></a></td>
                                <td><?= $v['description'] ?></td>
                              </tr>
                            <?php endforeach; ?>
                          </tbody>
                        </table>
                      </div>
                    <?php else : ?>
                      -
                    <?php endif; ?>
                  </td>

                  <td><?php echo $value["vsd"] ?></td>
                  <td><?php echo $value["ved"] ?></td>

                  <td><?php echo $value["status"] == 1 ? 'Active' : 'In-Active' ?></td>
                  <td>
                    <a href="<?php echo base_url() ?>master/bonder/bonder_update/<?php echo strtr($this->encryption->encrypt($value["id"]), '+=/', '.-~') ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Update</a>
                  </td>
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
<script>
  $('.dataTable').DataTable({
    "order": [],
  });

  $(".select2").select2({

    allowClear: true,
    tokenSeparators: [', ', ' '],
  })
</script>