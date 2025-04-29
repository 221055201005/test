<style type="text/css">
.nav-link {
  color: #000;
}

.nav-pills .nav-link.active,
.nav-pills .show>.nav-link {
  color: #007bff;
  background: #fff;
  border-bottom: 2px solid #007bff;
  border-radius: 0px;


}

.middle {
  vertical-align: middle !important;
}

.input_width {
  width: 200px !important
}


</style>
<div id="content" class="container-fluid">

  <div class="card shadow my-3 rounded-0">
    <div class="card-header">
      <h6 class="m-0"><?php echo $meta_title ?></h6>
    </div>

    <div class="card-body bg-white">

      <ul class="nav nav-pills border-bottom border-gray" id="pills-tab" role="tablist">
        <?php if($this->permission_cookie[72] == '1'){ ?>
        <li class="nav-item">
          <a class="nav-link active" data-toggle="pill" href="#pills-rfi">RFI</a>
        </li>
        <?php } ?>

        <?php if($this->permission_cookie[81] == '1'){ ?>
            <?php if($this->user_cookie[7] == 8){ ?>
              <?php if($total_cutting > 0){ ?>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="pill" href="#pills-cutting">Cutting List</a>
                </li>
              <?php } ?>
            <?php } else { ?>
              <li class="nav-item">
                  <a class="nav-link" data-toggle="pill" href="#pills-cutting">Cutting List</a>
              </li>
            <?php } ?>
        <?php } ?>

        <?php if($this->permission_cookie[87] == '1'){ ?>
          <?php if($this->user_cookie[7] == 8){ ?>
            <?php if($total_fitup > 0){ ?>
              <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#pills-fitup">Fit Up</a>
              </li>
             <?php } ?>  
          <?php } else { ?>
              <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#pills-fitup">Fit Up</a>
              </li>
          <?php } ?>  
        <?php } ?>

        <?php if($this->permission_cookie[92] == '1'){ ?>
            <?php if($this->user_cookie[7] == 8){ ?>
              <?php if($total_visual > 0){ ?>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="pill" href="#pills-visual">Visual Testing</a>
                </li>
              <?php } ?>
            <?php } else { ?> 
              <li class="nav-item">
                  <a class="nav-link" data-toggle="pill" href="#pills-visual">Visual Testing</a>
                </li>
            <?php } ?>   
        <?php } ?>

        <?php if($this->permission_cookie[97] == '1'){ ?>
            <?php if($this->user_cookie[7] == 8){ ?>
              <?php if($total_mechanichal > 0){ ?>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="pill" href="#pills-mechanical">Mechanical</a>
                </li>
              <?php } ?>
            <?php } else { ?> 
              <li class="nav-item">
                  <a class="nav-link" data-toggle="pill" href="#pills-mechanical">Mechanical</a>
              </li>
            <?php } ?>  
        <?php } ?>

        <?php if($this->permission_cookie[102] == '1'){ ?>
          <?php if($this->user_cookie[7] == 8){ ?>
            <?php if($total_ndt > 0){ ?>
              <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#pills-nde">NDE</a>
              </li>
            <?php } ?>
          <?php } else { ?> 
              <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#pills-nde">NDE</a>
              </li>
          <?php } ?>  
        <?php } ?>

      </ul>
      <div class="tab-content pt-4">
        <div class="tab-pane fade show active" id="pills-rfi">
          <form action="<?php echo base_url() ?>welding_rfi/rfi_update_process" method="POST">
            <input type="hidden" name="id" value="<?php echo $rfi["id"] ?>">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Project</label>
                  <div class="col-md">
                    <select class="form-control project" name="project" required>
                      <option value="">---</option>
                      <?php foreach ($project_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>"
                        <?php echo ($rfi["project"] == $value["id"] ? "selected" : "") ?>>
                        <?php echo $value['project_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Category</label>
                  <div class="col-md">
                    <select class="form-control type_of_module" name="category" required>
                      <option value="">---</option>
                      <option value="WPQT" <?php echo ($rfi["category"] == "WPQT" ? "selected" : "") ?>>WPQT</option>
                      <option value="WQT" <?php echo ($rfi["category"] == "WQT" ? "selected" : "") ?>>WQT</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Discipline</label>
                  <div class="col-md">
                    <select class="form-control" name="discipline" required>
                      <option value="">---</option>
                      <?php foreach ($discipline_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo ($rfi["discipline"] == $value["id"] ? "selected" : "") ?>><?php echo $value['discipline_name'] ?></option>
                      <?php endforeach; ?>
                    </select> 
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Document Ref</label>
                  <div class="col-md">
                    <input type="text" class="form-control" name="document_ref" value="<?php echo $rfi["document_ref"] ?>" required>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">RFI No.</label>
                  <div class="col-md">
                    <input type="text" class="form-control" name="rfi_no" value="<?php echo $rfi["rfi_no"] ?>" required>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Type of Inspection</label>
                  <div class="col-md">
                    <input type="text" class="form-control" name="type_of_inspection"
                      value="<?php echo $rfi["type_of_inspection"] ?>" required>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Contractor</label>
                  <div class="col-md">
                    <input type="text" class="form-control" name="contractor" value="<?php echo $rfi["contractor"] ?>"
                      required>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Location</label>
                  <div class="col-md">
                    <input type="text" class="form-control" name="location" value="<?php echo $rfi["location"] ?>"
                      required>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Submitted Date</label>
                  <div class="col-md">
                    <input type="date" class="form-control" name="submit_date" value="<?php echo $rfi["submit_date"] ?>"
                      required>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Inspection Date</label>
                  <div class="col-md">
                    <input type="date" class="form-control" name="inspection_date"
                      value="<?php echo $rfi["inspection_date"] ?>" required>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Remarks</label>
                  <div class="col-md">
                    <textarea class="form-control" name="remarks" rows="3"><?php echo $rfi["remarks"] ?></textarea>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
              </div>
            </div>
            <div class="row">
              <div class="col-12 text-right">
                <?php if($this->permission_cookie[74] == '1'){ ?>
                  <?php if($this->user_cookie[7] != 8): ?>
                  <button type="submit" class="btn btn-success"><i class="fas fa-edit"></i> Update</button>
                  <?php endif; ?>
                <?php } ?>
              </div>
            </div>
          </form>
          <br>
          <br>
          <br>
          <form action="<?php echo base_url() ?>welding_rfi/rfi_detail_update_process" method="POST">
            <input type="hidden" name="id" value="<?php echo $rfi["id"] ?>">
            <div class="overflow-auto">
              <table id="tbl_rfi_detail" class="table table-hover text-center">
                <thead class="bg-info text-white">
                  <tr>
                    <th>Item / Tag Number</th>
                    <th>Item / Tag Description</th>
                    <th>PWPS</th>
                    <th>Expected Time</th>
                    <th>ITP Intervention to Employer</th>
                    <th>Inspection Execution Result</th>
                    <?php if($this->user_cookie[7] != 8){ ?>
                    <th><button type='button' class="btn btn-sm btn-primary" onclick="add_row_rfi()"><i class="fas fa-plus"></i></button></th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($detail_list as $key => $value): ?>
                  <tr>
                    <td>
                      <input type='text' class='form-control' required name='tag_no[]' value='<?php echo $value["tag_no"] ?>'>
                      <input type="hidden" name="id_detail[]" value="<?php echo $value["id"] ?>">
                    </td>
                    <td>
                      <input type='text' class='form-control' required name='tag_description[]' value='<?php echo $value["tag_description"] ?>'>
                    </td>
                    <td>
                      <input type='text' class='form-control' required name='pwps[]' value='<?php echo $value["pwps"] ?>'>
                    </td>
                    <td>
                      <input type='text' class='form-control' required name='expected_time[]' value='<?php echo $value["expected_time"] ?>'>
                    </td>
                    <td>
                      <input type='text' class='form-control' required name='itp[]' value='<?php echo $value["itp"] ?>'>
                    </td>
                    <td>
                      <input type='text' class='form-control' required name='result[]' value='<?php echo $value["result"] ?>'>
                    </td>
                    <?php if($this->user_cookie[7] != 8){ ?>
                      <td>
                        <button type='button' class='btn btn-danger' onclick='delete_data_rfi_detail(this, "<?php echo $value["id"] ?>")'>
                          <i class='fas fa-trash-alt'></i>
                        </button>
                      </td>
                    <?php } ?>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
              <div class="text-right">
                <br>

                <?php if($this->permission_cookie[76] == '1'){ ?>
                  <a target="_blank" href="<?= site_url('welding_rfi/rfi_pdf/'.strtr($this->encryption->encrypt($rfi['id']), '+=/', '.-~')) ?>" class="btn btn-dark"><i class="fas fa-file-pdf"></i> RFI</a>
                <?php } ?>

                <?php if($this->permission_cookie[74] == '1'){ ?>
                  <?php if($this->user_cookie[7] != 8): ?>
                    <button type="submit" class="btn btn-success"><i class="fas fa-edit"></i> Update</button>
                  <?php endif; ?>
                <?php } ?>

                <?php if($this->permission_cookie[77] == '1'){ ?>
                  <?php if(($rfi["status"] == 0 || $rfi["status"] == 2) && $this->user_cookie[7] != 8): ?>
                    <a href="<?= site_url('welding_rfi/rfi_submit_process/'.strtr($this->encryption->encrypt($rfi['id']), '+=/', '.-~')) ?>" class="btn btn-primary"><i class="fas fa-check"></i> Submit to Inspector</a>
                  <?php endif; ?>
                <?php } ?>

                <?php if($rfi["status"] == 1 && $this->user_cookie[7] != 8): ?>
                  <?php if($this->permission_cookie[79] == '1'){ ?>
                    <a href="<?= site_url('welding_rfi/rfi_approve_process/'.strtr($this->encryption->encrypt($rfi['id']), '+=/', '.-~')) ?>/3" class="btn btn-success" onclick="return confirm('Are you sure?')"><i class="fas fa-check"></i> Approve</a> 
                  <?php } ?>
                <?php elseif($rfi["client_status"] == 1 && $this->user_cookie[7] == 8): ?> 
                  <?php if($this->permission_cookie[80] == '1'){ ?>
                    <a href="<?= site_url('welding_rfi/client_rfi_approve_process/'.strtr($this->encryption->encrypt($rfi['id']), '+=/', '.-~')) ?>/3/<?php echo strtr($this->encryption->encrypt($rfi["project"]), '+=/', '.-~') ?>/<?php echo strtr($this->encryption->encrypt($rfi["category"]), '+=/', '.-~') ?>/<?php echo strtr($this->encryption->encrypt($rfi["rfi_no"]), '+=/', '.-~') ?>" class="btn btn-success" onclick="return confirm('Are you sure?')"><i class="fas fa-check"></i> Approve</a>
                  <?php } ?>
                <?php endif; ?>

              </div>
            </div>
          </form>
        </div>

        <!-- Cutting List -->

        <div class="tab-pane fade" id="pills-cutting">

                <h6>Cutting list Attachment</h6>
                  
                  <?php if($this->user_cookie[7] != 8): ?>
                  <form action="<?php echo base_url() ?>welding_rfi/rfi_attachment_new_process" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $rfi["id"] ?>">
                    <input type="hidden" name="category" value="3">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Description</label>
                          <div class="col-md">
                            <input type="text" class="form-control" name="description" required>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Upload File</label>
                          <div class="col-md">
                            <div class="custom-file">
                              <input type="file" name="file" class="custom-file-input" required>
                              <label class="custom-file-label">Choose file</label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12 text-right">
                        <button class="btn btn-success">Upload</button>
                      </div>
                    </div>
                  </form>
                  <br>
                  <br>
                  <?php endif; ?>
                  
                  
                  <div class="overflow-auto">
                    <table class="table table-hover text-center dataTable">
                      <thead class="bg-info text-white">
                        <tr>
                          <th>Description</th>
                          <th>Upload Date</th>
                          <th>Attachment</th>
                          <?php if($this->user_cookie[7] != 8){ ?>
                          <th></th>
                          <?php } ?>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($rfi_attachment_list as $key => $value): ?>
                          <?php if($value["category"] == 3): ?>
                          <tr>
                            <td><?php echo $value["description"] ?></td>
                            <td><?php echo date("Y-m-d",strtotime($value["create_date"])); ?></td>
                            <!-- <td><a href="<?php echo base_url_ftp() ?>upload/welding/<?php echo $value["attachment"] ?>" class="btn btn-sm btn-dark"><i class="fas fa-file-pdf"></i></a></td> -->
                            <td><a href="<?php echo base_url() . 'welding_rfi/open_file_atc/' . $value['attachment'] . '/' . $value['attachment'] ?>" target="_blank" class="btn btn-sm btn-flat btn-dark"><i class="fas fa-file-alt"></i></a></td>  
                            
                            <?php if($this->user_cookie[7] != 8){ ?>
                              <td><a href="<?php echo base_url() ?>welding_rfi/rfi_attachment_delete_process/<?php echo strtr($this->encryption->encrypt($value["id"]), '+=/', '.-~') ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a></td>
                            <?php } ?>

                          </tr>
                          <?php endif; ?>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="text-right mt-3">
                    <?php if($this->user_cookie[7] != 8){ ?>
                    <button type="button" onclick="send_invitation_email('<?php echo strtr($this->encryption->encrypt($rfi_id_list), '+=/', '.-~') ?>','<?php echo strtr($this->encryption->encrypt($rfi_no_list), '+=/', '.-~') ?>','<?php echo strtr($this->encryption->encrypt('Cutting List'), '+=/', '.-~') ?>','<?php echo strtr($this->encryption->encrypt($rfi_category), '+=/', '.-~') ?>')" class="btn btn-danger"><i class="fas fa-envelope-square"></i> Invitation Email</button>
                      <?php } ?>
                  </div>

        </div>
        
        <!-- Cutting List -->    

        <!-- Fit-Up Inspection List -->             

        <div class="tab-pane fade" id="pills-fitup">
              
                <h6>Fit-Up Attachment</h6>
                  
                  <?php if($this->user_cookie[7] != 8): ?>
                  <form action="<?php echo base_url() ?>welding_rfi/rfi_attachment_new_process" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $rfi["id"] ?>">
                    <input type="hidden" name="category" value="4">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Description</label>
                          <div class="col-md">
                            <input type="text" class="form-control" name="description" required>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Upload File</label>
                          <div class="col-md">
                            <div class="custom-file">
                              <input type="file" name="file" class="custom-file-input" required>
                              <label class="custom-file-label">Choose file</label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12 text-right">
                        <button class="btn btn-success">Upload</button>
                      </div>
                    </div>
                  </form>
                  <br>
                  <br>
                  <?php endif; ?>
                  
                  
                  <div class="overflow-auto">
                    <table class="table table-hover text-center dataTable">
                      <thead class="bg-info text-white">
                        <tr>
                          <th>Description</th>
                          <th>Upload Date</th>
                          <th>Attachment</th>
                           <?php if($this->user_cookie[7] != 8){ ?>
                          <th></th>
                          <?php } ?>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($rfi_attachment_list as $key => $value): ?>
                          <?php if($value["category"] == 4): ?>
                          <tr>
                            <td><?php echo $value["description"] ?></td>
                            <td><?php echo date("Y-m-d",strtotime($value["create_date"])); ?></td>

                            <!-- <td><a href="<?php echo base_url_ftp() ?>upload/welding/<?php echo $value["attachment"] ?>" class="btn btn-sm btn-dark"><i class="fas fa-file-pdf"></i></a></td> -->

                            <td><a href="<?php echo base_url() . 'welding_rfi/open_file_atc/' . $value['attachment'] . '/' . $value['attachment'] ?>" target="_blank" class="btn btn-sm btn-flat btn-dark"><i class="fas fa-file-alt"></i></a></td>
                            
                            <?php if($this->user_cookie[7] != 8){ ?>
                              <td><a href="<?php echo base_url() ?>welding_rfi/rfi_attachment_delete_process/<?php echo strtr($this->encryption->encrypt($value["id"]), '+=/', '.-~') ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a></td>
                            <?php } ?>

                          </tr>
                          <?php endif; ?>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="text-right mt-3">
                    <?php if($this->user_cookie[7] != 8){ ?>
                    <button type="button" onclick="send_invitation_email('<?php echo strtr($this->encryption->encrypt($rfi_id_list), '+=/', '.-~') ?>','<?php echo strtr($this->encryption->encrypt($rfi_no_list), '+=/', '.-~') ?>','<?php echo strtr($this->encryption->encrypt('Fitup Inspection'), '+=/', '.-~') ?>','<?php echo strtr($this->encryption->encrypt($rfi_category), '+=/', '.-~') ?>')" class="btn btn-danger"><i class="fas fa-envelope-square"></i> Invitation Email</button>
                      <?php } ?>
                  </div>
        </div>
        <!-- Fit-Up Inspection List -->

        <!-- Visual Inspection List -->
        <div class="tab-pane fade" id="pills-visual">
              
        <h6>Visual Attachment</h6>
                  
                  <?php if($this->user_cookie[7] != 8): ?>
                  <form action="<?php echo base_url() ?>welding_rfi/rfi_attachment_new_process" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $rfi["id"] ?>">
                    <input type="hidden" name="category" value="5">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Description</label>
                          <div class="col-md">
                            <input type="text" class="form-control" name="description" required>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Upload File</label>
                          <div class="col-md">
                            <div class="custom-file">
                              <input type="file" name="file" class="custom-file-input" required>
                              <label class="custom-file-label">Choose file</label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12 text-right">
                        <button class="btn btn-success">Upload</button>
                      </div>
                    </div>
                  </form>
                  <br>
                  <br>
                  <?php endif; ?>
                  
                  
                  <div class="overflow-auto">
                    <table class="table table-hover text-center dataTable">
                      <thead class="bg-info text-white">
                        <tr>
                          <th>Description</th>
                          <th>Upload Date</th>
                          <th>Attachment</th>
                          <?php if($this->user_cookie[7] != 8){ ?>
                          <th></th>
                          <?php } ?>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($rfi_attachment_list as $key => $value): ?>
                          <?php if($value["category"] == 5): ?>
                          <tr>
                            <td><?php echo $value["description"] ?></td>
                            <td><?php echo date("Y-m-d",strtotime($value["create_date"])); ?></td>

                            <!-- <td><a href="<?php echo base_url_ftp() ?>upload/welding/<?php echo $value["attachment"] ?>" class="btn btn-sm btn-dark"><i class="fas fa-file-pdf"></i></a></td> -->

                            <td><a href="<?php echo base_url() . 'welding_rfi/open_file_atc/' . $value['attachment'] . '/' . $value['attachment'] ?>" target="_blank" class="btn btn-sm btn-flat btn-dark"><i class="fas fa-file-alt"></i></a></td>
                            
                            <?php if($this->user_cookie[7] != 8){ ?>
                              <td><a href="<?php echo base_url() ?>welding_rfi/rfi_attachment_delete_process/<?php echo strtr($this->encryption->encrypt($value["id"]), '+=/', '.-~') ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a></td>
                            <?php } ?>

                          </tr>
                          <?php endif; ?>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="text-right mt-3">
                    <?php if($this->user_cookie[7] != 8){ ?>
                    <button type="button" onclick="send_invitation_email('<?php echo strtr($this->encryption->encrypt($rfi_id_list), '+=/', '.-~') ?>','<?php echo strtr($this->encryption->encrypt($rfi_no_list), '+=/', '.-~') ?>','<?php echo strtr($this->encryption->encrypt('Visual Inspection'), '+=/', '.-~') ?>','<?php echo strtr($this->encryption->encrypt($rfi_category), '+=/', '.-~') ?>')" class="btn btn-danger"><i class="fas fa-envelope-square"></i> Invitation Email</button>
                      <?php } ?>
                  </div>

        </div>
        <!-- Visual Inspection List -->

        <!-- Mechanical List -->                  
        <div class="tab-pane fade" id="pills-mechanical">
          <h6>Mechanical Attachment</h6>
          
          <?php if($this->user_cookie[7] != 8): ?>
          <form action="<?php echo base_url() ?>welding_rfi/rfi_attachment_new_process" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $rfi["id"] ?>">
            <input type="hidden" name="category" value="1">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Description</label>
                  <div class="col-md">
                    <input type="text" class="form-control" name="description" required>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Upload File</label>
                  <div class="col-md">
                    <div class="custom-file">
                      <input type="file" name="file" class="custom-file-input" required>
                      <label class="custom-file-label">Choose file</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 text-right">
                <button class="btn btn-success">Upload</button>
              </div>
            </div>
          </form>
          <br>
          <br>
          <?php endif; ?>
          
          
          <div class="overflow-auto">
            <table class="table table-hover text-center dataTable">
              <thead class="bg-info text-white">
                <tr>
                  <th>Description</th>
                  <th>Upload Date</th>
                  <th>Attachment</th>
                  <?php if($this->user_cookie[7] != 8){ ?>
                          <th></th>
                          <?php } ?>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($rfi_attachment_list as $key => $value): ?>
                  <?php if($value["category"] == 1): ?>
                  <tr>
                    <td><?php echo $value["description"] ?></td>
                    <td><?php echo date("Y-m-d",strtotime($value["create_date"])); ?></td>
                    
                    <!-- <td><a href="<?php echo base_url_ftp() ?>upload/welding/<?php echo $value["attachment"] ?>" class="btn btn-sm btn-dark"><i class="fas fa-file-pdf"></i></a></td> -->

                    <td><a href="<?php echo base_url() . 'welding_rfi/open_file_atc/' . $value['attachment'] . '/' . $value['attachment'] ?>" target="_blank" class="btn btn-sm btn-flat btn-dark"><i class="fas fa-file-alt"></i></a></td>
                    
                    <?php if($this->user_cookie[7] != 8){ ?>
                              <td><a href="<?php echo base_url() ?>welding_rfi/rfi_attachment_delete_process/<?php echo strtr($this->encryption->encrypt($value["id"]), '+=/', '.-~') ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a></td>
                            <?php } ?>
                  </tr>
                  <?php endif; ?>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <div class="text-right mt-3">
             <?php if($this->user_cookie[7] != 8){ ?>
            <button type="button" onclick="send_invitation_email('<?php echo strtr($this->encryption->encrypt($rfi_id_list), '+=/', '.-~') ?>','<?php echo strtr($this->encryption->encrypt($rfi_no_list), '+=/', '.-~') ?>','<?php echo strtr($this->encryption->encrypt('Mechanical Inspection'), '+=/', '.-~') ?>','<?php echo strtr($this->encryption->encrypt($rfi_category), '+=/', '.-~') ?>')" class="btn btn-danger"><i class="fas fa-envelope-square"></i> Invitation Email</button>
              <?php } ?>
          </div>
        </div>
        <!-- Mechanical List -->  

        <!-- NDT List -->  

        <div class="tab-pane fade" id="pills-nde">
          <h6>NDE Attachment</h6>
          
          <?php if($this->user_cookie[7] != 8): ?>
          <form action="<?php echo base_url() ?>welding_rfi/rfi_attachment_new_process" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $rfi["id"] ?>">
            <input type="hidden" name="category" value="2">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Description</label>
                  <div class="col-md">
                    <input type="text" class="form-control" name="description" required>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Upload File</label>
                  <div class="col-md">
                    <div class="custom-file">
                      <input type="file" name="file" class="custom-file-input" required>
                      <label class="custom-file-label">Choose file</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 text-right">
                <button class="btn btn-success">Upload</button>
              </div>
            </div>
          </form>
          <br>
          <br>
          <?php endif; ?>
          
          <div class="overflow-auto">
            <table class="table table-hover text-center dataTable">
              <thead class="bg-info text-white">
                <tr>
                  <th>Description</th>
                  <th>Upload Date</th>
                  <th>Attachment</th>
                  <?php if($this->user_cookie[7] != 8){ ?>
                          <th></th>
                          <?php } ?>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($rfi_attachment_list as $key => $value): ?>
                  <?php if($value["category"] == 2): ?>
                  <tr>
                    <td><?php echo $value["description"] ?></td>
                    <td><?php echo date("Y-m-d",strtotime($value["create_date"])) ?></td>

                    <!-- <td><a href="<?php echo base_url_ftp() ?>upload/welding/<?php echo $value["attachment"] ?>" class="btn btn-sm btn-dark"><i class="fas fa-file-pdf"></i></a></td> -->

                    <td><a href="<?php echo base_url() . 'welding_rfi/open_file_atc/' . $value['attachment'] . '/' . $value['attachment'] ?>" target="_blank" class="btn btn-sm btn-flat btn-dark"><i class="fas fa-file-alt"></i></a></td>
                    
                    <?php if($this->user_cookie[7] != 8){ ?>
                              <td><a href="<?php echo base_url() ?>welding_rfi/rfi_attachment_delete_process/<?php echo strtr($this->encryption->encrypt($value["id"]), '+=/', '.-~') ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a></td>
                            <?php } ?>
                  </tr>
                  <?php endif; ?>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <div class="text-right mt-3">
            <?php if($this->user_cookie[7] != 8){ ?>
          <button type="button" onclick="send_invitation_email('<?php echo strtr($this->encryption->encrypt($rfi_id_list), '+=/', '.-~') ?>','<?php echo strtr($this->encryption->encrypt($rfi_no_list), '+=/', '.-~') ?>','<?php echo strtr($this->encryption->encrypt('NDE Inspection'), '+=/', '.-~') ?>','<?php echo strtr($this->encryption->encrypt($rfi_category), '+=/', '.-~') ?>')" class="btn btn-danger"><i class="fas fa-envelope-square"></i> Invitation Email</button>
            <?php } ?>
          </div>
        </div>
         <!-- NDT List -->  

      </div>
    </div>
  </div>
 

</div>
</div>
<script>
$(document).ready(function() {
  $('form').on('submit', function() {
    $('button[type=submit]').attr('disabled', true)
  })
})

function add_row_rfi() {
  var table;
  table = "<tr>" +
    "<td><input type='text' class='form-control' required name='tag_no[]'><input type='hidden' name='id_detail[]'></td>" +
    "<td><input type='text' class='form-control' required name='tag_description[]'></td>" +
    "<td><input type='text' class='form-control' required name='pwps[]'></td>" +
    "<td><input type='text' class='form-control' required name='expected_time[]'></td>" +
    "<td><input type='text' class='form-control' required name='itp[]'></td>" +
    "<td><input type='text' class='form-control' required name='result[]'></td>" +
    "<td><button type='button' class='btn btn-danger' onclick='delete_row_rfi_detail(this)'><i class='fas fa-trash-alt'></i></button></td>" +
    "<tr>";
  $("#tbl_rfi_detail tbody").append(table);
}

function delete_row_rfi_detail(btn) {
  $(btn).closest("tr").remove();
}

function delete_data_rfi_detail(btn, id) {
  if (confirm("Are you sure to delete this?") == true) {
    console.log("test");
    $.ajax({
      url: "<?= site_url('welding_rfi/rfi_detail_delete_process') ?>",
      type: "POST",
      data: {
        id: id
      },
      // dataType: "JSON",
      success: function(res) {
        $(btn).closest("tr").remove();
      }
    })
  }
}


function autocomplete_heat_number(input, index) {
  $(input).autocomplete({
    source: "<?php echo base_url(); ?>welding_rfi/autocomplete_heat_no/",
    autoFocus: true,
    classes: {
      "ui-autocomplete": "highlight"
    }
  });
}

function detail_heat_no(input, index) {
  var heat_or_series_no = $(input).val()
  var div_certification = $(input).closest('tr').find('.certificate_list')

  $.ajax({
    url: "<?= site_url('welding_rfi/detail_heat_no') ?>",
    type: "POST",
    data: {
      heat_or_series_no: heat_or_series_no
    },
    dataType: "JSON",
    success: function(data) {
      var certification_list = []
      if (data.success) {
        $(input).closest('tr').find(`input[name="material_grade[${index}]"]`).val(data.material_grade)
        $(input).closest('tr').find(`input[name="qty[${index}]"]`).val(data.qty)
        $(input).closest('tr').find(`input[name="thickness[${index}]"]`).val(data.thk)


        data.certification_list.map((v, i) => {
          certification_list.push(`
          <a target="_blank" href="https://www.smoebatam.com/warehouse_ori/file/mrir/cm/${v.document_file}">Certificate</a>
          <br>
          `)
        })

        // div_certification.html(certification_list)

      } else {
        // div_certification.empty()
      }
    }
  })
}

function add_row_attachment_1(input, index) {
  var table = $(input).closest('tbody')
  var html = `<tr>
                <td>
                <input type="hidden" name="id_attachment_1[${index}][]" value="new_row">
                  <div class="custom-file text-left">
                    <input type="file" onclick="delete_attachment(this)" onchange="change_label(this)" class="custom-file-input input_width" name="attachment_1[${index}][]"
                      id="customFile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                  </div>
                </td>
                <td><button type="button" class="btn btn-danger btn-sm" onclick="delete_attachment_row_1(this, ${index})"><i
                      class="fas fa-trash-alt"></i></button></td>
              </tr>`
  table.append(html)
}

function delete_attachment_row_1(input, index) {
  $(input).closest('tr').remove()
}

function add_row_attachment_2(input, index) {
  var table = $(input).closest('tbody')
  var html = `<tr>
                <td>
                  <input type="hidden" name="id_attachment_2[${index}][]" value="new_row">
                  <div class="custom-file text-left">
                    <input type="file" onclick="delete_attachment(this)" onchange="change_label(this)" class="custom-file-input input_width" name="attachment_2[${index}][]"
                      id="customFile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                  </div>
                </td>
                <td><button type="button" class="btn btn-danger  btn-sm" onclick="delete_attachment_row_2(this, ${index})"><i
                      class="fas fa-trash-alt"></i></button></td>
              </tr>`
  table.append(html)
}

function delete_attachment_row_2(input, index) {
  $(input).closest('tr').remove()
}

function delete_attachment(input) {
  $(input).val('')
}

function change_label(input) {
  var value = $(input).val()
  var label = $(input).closest('.custom-file').find('label')
  var split = value.split('\\')

  label.text(split[split.length - 1])


}

var start_row = "0";

function add_row(input) {
  var html_data = `
    <tr>
    <td>
    <input type="hidden" name="id[${start_row}]" value="new_row">
    <input type="text" name="heat_number[${start_row}]" class="form-control input_width_half"
          oninput="autocomplete_heat_number(this, ${start_row})" onblur="detail_heat_no(this, ${start_row})" required>
          <div class="certificate_list text-left">
          </div>
      </td>
      <td>
        <input type="text" name="material_grade[${start_row}]" class="form-control input_width_half">
      </td>
      <td><input type="text" name="thickness[${start_row}]" class="form-control input_width_half"></td>
      <td><input type="text" name="dimension[${start_row}]" class="form-control input_width_half"></td>
      <td class="bg-white">
        <table class="table table-borderless">
          <tbody>
            <tr>
              <td>
              <input type="hidden" name="id_attachment_1[${start_row}][]" value="new_row">
                <div class="custom-file text-left">
                  <input type="file" onclick="delete_attachment(this)" onchange="change_label(this)" class="custom-file-input input_width" name="attachment_1[${start_row}][]"
                    id="customFile">
                  <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
              </td>
              <td><button type="button" class="btn btn-primary btn-sm"
                  onclick="add_row_attachment_1(this, ${start_row})"><i
                    class="fas fa-plus-circle"></i></button></td>
            </tr>
          </tbody>
        </table>
      </td>
      <td><input type="text" name="angle_bevel[${start_row}]" class="form-control input_width_half"></td>
      <td><input type="text" name="qty[${start_row}]" class="form-control input_width_half"></td>
      <td class="bg-white">
        <table class="table table-borderless">
          <tbody>
            <tr>
              <td>
              <input type="hidden" name="id_attachment_2[${start_row}][]" value="new_row">
                <div class="custom-file text-left">
                  <input type="file" onclick="delete_attachment(this)" onchange="change_label(this)" class="custom-file-input input_width" name="attachment_2[${start_row}][]"
                    id="customFile">
                  <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
              </td>
              <td><button type="button" class="btn btn-primary btn-sm"
                  onclick="add_row_attachment_2(this, ${start_row})"><i
                    class="fas fa-plus-circle"></i></button></td>
            </tr>
          </tbody>
        </table>
        </td>
        <td><textarea name="remarks[${start_row}]" class="form-control input_width_half"></textarea></td>
        <td><button type="button" class="btn btn-danger" onclick="delete_row(this)"><i class="fas fa-trash-alt"></i></button></td>
    </tr>
    `
  start_row++
  $("#table_list").append(html_data)
}

function delete_row(btn) {
  $(btn).closest('tr').remove()
}

function delete_detail_cutting(btn, id) {
  Swal.fire({
    type : "warning",
    title : `<span class="text-danger">DELETE</span>`,
    html : `<i>Deleted Data Cannot Be Returned</i>`,
    showCancelButton: true
  }).then((res) => {
    if(res.value) {
      $.ajax({
        url : "<?= site_url('welding_rfi/delete_detail_cutting') ?>",
        type : "POST",
        data : {
          id : id
        },
        dataType : "JSON",
        success: function(data) {
          if(data.success) {
            Swal.fire({
              type : "success",
              title : "SUCCESS",
              text : "Success Delete Data",
              timer : 1000
            })

            $(btn).closest('tr').remove()

          }
        }
      })
    }
  })
}

function delete_detail_attachment(btn , id) {
  Swal.fire({
    type : "warning",
    title : `<span class="text-danger">DELETE</span>`,
    html : `<i>Deleted Data Cannot Be Returned</i>`,
    showCancelButton: true
  }).then((res) => {
    if(res.value) {
      $.ajax({
        url : "<?= site_url('welding_rfi/delete_detail_attachment') ?>",
        type : "POST",
        data : {
          id : id
        },
        dataType : "JSON",
        success: function(data) {
          if(data.success) {
            Swal.fire({
              type : "success",
              title : "SUCCESS",
              text : "Success Delete Data",
              timer : 1000
            })

            $(btn).closest('tr').remove()

          }
        }
      })
    }
  })
}


function send_invitation_email(id_RFI,Rfi_Number,process_send,category_type) {
  Swal.fire({
    type : "warning",
    title : `<span class="text-danger">Send Invitation to Client</span>`,
    html : `<i>You will send email invitation for this RFI to client, Are you sure..?</i>`,
    showCancelButton: true
  }).then((res) => {
    if(res.value) {
      $.ajax({
        url : "<?= site_url('we_dept/invitation_RFI/') ?>"+id_RFI+"/"+Rfi_Number+"/"+process_send+"/"+category_type,
        success: function(data) {
         

            Swal.fire({
              type : "success",
              title : "SUCCESS",
              text : "Success Send Invitation Email..!",
            })

         
        }
      })
    }
  })
}
</script>

<script type="text/javascript">
  $('.dataTable').DataTable({
    "lengthChange": false,
    "order": []
  });
</script>