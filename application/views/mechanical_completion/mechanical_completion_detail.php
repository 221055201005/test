<?php
$get = $this->input->get();
?>
<div id="content" class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white">
          <form method="POST" action="<?php echo base_url() ?>mechanical_completion/mechanical_completion_edit_process/<?php echo $id_enc ?>">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Project</label>
                  <div class="col-xl">
                    <select class="form-control" name="project" id='project_id' <?= $mc['status'] == 9 ? 'readonly' : '' ?>>
                      <option value="">---</option>
                      <?php foreach ($project_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo ($mc['project'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Module</label>
                  <div class="col-xl">
                    <select class="form-control" name="module" <?= $mc['status'] == 9 ? 'readonly' : '' ?>>
                      <option value="">---</option>
                      <?php foreach ($module_list as $key => $value) : ?>
                        <option value="<?php echo $value['mod_id'] ?>" data-chained="<?php echo $value['project_id'] ?>" <?php echo ($mc['module'] == $value['mod_id'] ? 'selected' : '') ?>><?php echo $value['mod_desc'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Type Of Module</label>
                  <div class="col-xl">
                    <select class="form-control" name="type_of_module" <?= $mc['status'] == 9 ? 'readonly' : '' ?>>
                      <option value="">---</option>
                      <?php foreach ($type_of_module_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo ($mc['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code'] . " - " . $value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Discipline</label>
                  <div class="col-xl">
                    <select class="form-control" name="discipline" <?= $mc['status'] == 9 ? 'readonly' : '' ?>>
                      <option value="">---</option>
                      <?php foreach ($discipline_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo ($mc['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Event ID No</label>
                  <div class="col-xl">
                    <input <?= $mc['status'] == 9 ? 'readonly' : '' ?> type="number" class="form-control" name="event_id_no" value="<?php echo $mc['event_id_no'] ?>">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Cert ID</label>
                  <div class="col-xl">
                    <input <?= $mc['status'] == 9 ? 'readonly' : '' ?> type="text" class="form-control" name="cert_id" value="<?php echo $mc['cert_id'] ?>">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Cert Description</label>
                  <div class="col-xl">
                    <input <?= $mc['status'] == 9 ? 'readonly' : '' ?> type="text" class="form-control" name="cert_description" value="<?php echo $mc['cert_description'] ?>">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Tag No</label>
                  <div class="col-xl">
                    <input <?= $mc['status'] == 9 ? 'readonly' : '' ?> type="text" class="form-control" name="tag_no" value="<?php echo $mc['tag_no'] ?>">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">System</label>
                  <div class="col-xl">
                    <input <?= $mc['status'] == 9 ? 'readonly' : '' ?> type="text" class="form-control" name="system" value="<?php echo $mc['system'] ?>">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">SubSystem</label>
                  <div class="col-xl">
                    <input <?= $mc['status'] == 9 ? 'readonly' : '' ?> type="text" class="form-control" name="subsystem" value="<?php echo $mc['subsystem'] ?>">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Description</label>
                  <div class="col-xl">
                    <input <?= $mc['status'] == 9 ? 'readonly' : '' ?> type="text" class="form-control" name="description" value="<?php echo $mc['description'] ?>">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Site</label>
                  <div class="col-xl">
                    <input <?= $mc['status'] == 9 ? 'readonly' : '' ?> type="text" class="form-control" name="site" value="<?php echo $mc['site'] ?>">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Target Date</label>
                  <div class="col-xl">
                    <input <?= $mc['status'] == 9 ? 'readonly' : '' ?> type="date" class="form-control" name="target_date" value="<?php echo $mc['target_date'] ?>">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Subsystem Description</label>
                  <div class="col-xl">
                    <input <?= $mc['status'] == 9 ? 'readonly' : '' ?> type="text" class="form-control" name="subsystem_description" value="<?php echo $mc['subsystem_description'] ?>">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Revision No</label>
                  <div class="col-xl">
                    <input <?= $mc['status'] == 9 ? 'readonly' : '' ?> type="text" class="form-control" name="rev_no" value="<?php echo $mc['rev_no'] ?>">
                  </div>
                </div>
              </div>
              <?php if ($this->permission_cookie[140] == 1) : ?>
                <div class="col-md-12 text-right <?= $mc['status'] == 9 ? 'd-none' : '' ?>">
                  <button class="mt-2 btn btn-sm btn-info" name="submit" value="search"><i class="fas fa-edit"></i> Update</button>
                </div>
              <?php endif; ?>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <?php if ($this->permission_cookie[141] == 1) : ?>
    <div class="row">
      <div class="col">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <div class="row">
              <div class="col-sm">
                <h6 class="m-0">Document Register</h6>
              </div>
              <div class="col-sm-auto">
                <a class="btn btn-sm btn-secondary" data-toggle="collapse" href="#collapse_document_register" role="button" aria-expanded="false" aria-controls="collapse_document_register">
                  <i class="fas fa-angle-double-down"></i> Show
                </a>
              </div>
            </div>
          </div>
          <div class="card-body bg-white collapse <?= (count($mc_document_register_list) == 0 ? 'show' : '') ?>" id="collapse_document_register">
            <?php if ($this->permission_cookie[142] == 1) : ?>
              <form method="POST" action="<?php echo base_url() ?>mechanical_completion/mechanical_completion_document_register_new_process/<?php echo $id_enc ?>">
                <div class="row <?= $mc['status'] == 9 ? 'd-none' : '' ?>">
                  <div class="col-md-8">
                    <div class="form-group row">
                      <div class="col-xl">
                        <select class="form-control select2-multiple-tags" name="name[]" multiple required>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <button class="mt-2 btn btn-sm btn-success" type="submit"><i class="fas fa-plus"></i> Add New</button>
                  </div>
                </div>
              </form>
              <br>
              <hr>
              <br>
            <?php endif; ?>
            <table class="table table-bordered text-center dataTable">
              <thead class="bg-gray-table">
                <tr>
                  <th>Name</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($mc_document_register_list as $key => $value) : ?>
                  <tr>
                    <td>
                      <form method="POST" action="<?php echo base_url() ?>mechanical_completion/mechanical_completion_document_register_edit_process/<?php echo strtr($this->encryption->encrypt($value['id']), '+=/', '.-~') ?>">
                        <div class="input-group">
                          <input type='text' class='form-control text-center' value="<?php echo $value['name'] ?>" name='name' required <?= $mc['status'] == 9 ? 'readonly' : '' ?>>
                          <div class="input-group-append">
                            <?php if ($this->permission_cookie[143] == 1) : ?>
                              <button class="btn btn-sm btn-info <?= $mc['status'] == 9 ? 'd-none' : '' ?>" type="submit" onclick="sweetalert('confirm', 'Are you sure?', this, event)"><i class="fas fa-edit"></i> Update</button>
                            <?php endif; ?>
                          </div>
                        </div>
                      </form>
                    </td>
                    <td>
                      <?php if ($this->permission_cookie[144] == 1) : ?>
                        <a href="<?php echo base_url("mechanical_completion/mechanical_completion_document_register_delete_process/" . strtr($this->encryption->encrypt($value['id']), '+=/', '.-~')) ?>" class="btn btn-sm btn-danger <?= $mc['status'] == 9 ? 'd-none' : '' ?>" onclick="sweetalert('confirm', 'Are you sure?', this, event)"><i class="fas fa-trash"></i> Delete</a>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <?php if (count($mc_document_register_list) > 0) : ?>
    <div class="row">
      <div class="col">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0">Attachments</h6>
          </div>
          <div class="card-body bg-white">
            <ul class="nav nav-pills nav-fill border-bottom" id="pills-tab" role="tablist">
              <?php
              $num = 0;
              foreach ($mc_document_register_list as $mc_document_register) :
                $name_pill = preg_replace('/\s+/', '-', strtolower($mc_document_register['name']));
                $num++;
              ?>
                <li class="nav-item" role="presentation">
                  <a class="rounded-0 nav-link <?= ($num == 1 ? 'active' : '') ?>" id="pills-<?= $name_pill ?>-tab" data-toggle="pill" href="#pills-<?= $name_pill ?>" role="tab" aria-controls="pills-<?= $name_pill ?>" aria-selected="true"><?= $mc_document_register['name'] ?><?php if (@$mc_attachment_count[$mc_document_register['id']] + 0 > 0) : ?>&nbsp;<span class='badge badge-dark badge-pill'><i class="fas fa-check"></i></span><?php endif; ?></a>
                </li>
              <?php endforeach; ?>
            </ul>
            <br>
            <div class="tab-content overflow-auto" id="pills-tabContent">
              <?php
              $num = 0;
              foreach ($mc_document_register_list as $mc_document_register) :
                $name_pill = preg_replace('/\s+/', '-', strtolower($mc_document_register['name']));
                $num++;
              ?>
                <div class="tab-pane fade <?= ($num == 1 ? 'show active' : '') ?>" id="pills-<?= $name_pill ?>" role="tabpanel" aria-labelledby="pills-<?= $name_pill ?>-tab">
                  <?php if ($this->permission_cookie[146] == 1) : ?>
                    <form method="POST" action="<?php echo base_url() ?>mechanical_completion/mechanical_completion_attachment_new_process/<?php echo $id_enc ?>" enctype="multipart/form-data">
                      <input type="hidden" name="id_mc" value="<?php echo strtr($this->encryption->encrypt($mc['id']), '+=/', '.-~') ?>">
                      <input type="hidden" name="id_mc_doc_reg" value="<?php echo strtr($this->encryption->encrypt($mc_document_register['id']), '+=/', '.-~') ?>">
                      <div class="row <?= $mc['status'] == 9 ? 'd-none' : '' ?>">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Attachment <?= $mc_document_register['name'] ?></label>
                            <div class="col-xl">
                              <div class="custom-file">
                                <input type="file" name="attachment_file" class="custom-file-input" required>
                                <label id="label_cp" class="custom-file-label">Choose file</label>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Remarks</label>
                            <div class="col-xl">
                              <textarea name="remarks" class="form-control"></textarea>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12 text-right">
                          <button class="mt-2 btn btn-sm btn-info" name="submit" value="search"><i class="fas fa-upload"></i> Upload</button>
                        </div>
                      </div>
                    </form>
                  <?php endif; ?>
                  <br>
                  <hr>
                  <br>
                  <table class="table table-bordered text-center dataTable">
                    <thead class="bg-gray-table">
                      <tr>
                        <th>Document Register</th>
                        <th>Upload By</th>
                        <th>Upload Date</th>
                        <th>Attachment</th>
                        <th>Remarks</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($mc_attachment_list as $key => $value) : ?>
                        <?php if ($value['id_mc_doc_reg'] == $mc_document_register['id']) : ?>
                          <tr>
                            <td><?= $mc_document_register_list[$value['id_mc_doc_reg']]['name'] ?></td>
                            <td><?= @$user_list[$value['created_by']] ?></td>
                            <td><?= $value['created_date'] ?></td>
                            <td>
                              <a href="<?php echo base_url() . 'mechanical_completion/open_mechanical_completion_atc/' . $value['attachment'] . '/' . $mc_document_register['name'] ?>" target="_blank" class="btn btn-sm btn-dark"><i class="fas fa-file-alt"></i></a>
                            </td>
                            <td><?= $value['remarks'] ?></td>
                            <td>
                              <?php if ($value['created_by'] == $this->user_cookie[0] || $this->permission_cookie[154] == 1) : ?>
                                <a href="<?php echo base_url("mechanical_completion/mechanical_completion_attachment_delete_process/" . strtr($this->encryption->encrypt($value['id']), '+=/', '.-~')) ?>" class="btn btn-sm btn-danger <?= $mc['status'] == 9 ? 'd-none' : '' ?>" onclick="sweetalert('confirm', 'Are you sure?', this, event)"><i class="fas fa-trash"></i> Delete</a>
                              <?php endif; ?>
                            </td>
                          </tr>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              <?php endforeach; ?>
            </div>

          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">RFI</h6>
        </div>
        <div class="card-body bg-white">
          <form id="form_rfi" method="POST" action="<?php echo base_url() ?>mechanical_completion/mechanical_completion_rfi_new_process/<?php echo $id_enc ?>" enctype="multipart/form-data">
            <input type="hidden" name="id_mc" value="<?php echo strtr($this->encryption->encrypt($mc['id']), '+=/', '.-~') ?>">
            <div class="row <?= $mc['status'] == 9 ? 'd-none' : '' ?>">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">RFI No</label>
                  <div class="col-xl">
                    <input type="text" class="form-control" name="rfi_no" value="" required>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">RFI Category</label>
                  <div class="col-xl">
                    <select class="form-control" name="rfi_category">
                      <option value="PMT">PMT</option>
                      <option value="QC" <?= $mc['status']==7 ? 'disabled' : '' ?>>QC</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">RFI Status</label>
                  <div class="col-xl">
                    <select class="form-control" name="rfi_status">
                      <option value="1" data-chained="PMT">Submit to QC</option>
                      <!-- <option value="3" data-chained="PMT">Approve QC</option> -->
                      <option value="5" data-chained="QC">Submit to Client</option>
                      <!-- <option value="7" data-chained="QC">Approve Client</option> -->
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">RFI Attachment</label>
                  <div class="col-xl">
                    <div class="custom-file">
                      <input type="file" name="attachment_file" class="custom-file-input" required>
                      <label id="label_cp" class="custom-file-label">Choose file</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Remarks</label>
                  <div class="col-xl">
                    <textarea name="remarks" class="form-control"></textarea>
                  </div>
                </div>
              </div>
              <div class="col-md-12 text-right">
                <?php if ($this->permission_cookie[150] == 1 || $this->permission_cookie[151] == 1) : ?>
                  <button class="mt-2 btn btn-sm btn-info" name="submit" value="create"><i class="fas fa-plus"></i> Create</button>
                <?php endif; ?>
              </div>
            </div>
          </form>
          <br>
          <div class="overflow-auto">
            <table class="table table-bordered text-center dataTable">
              <thead class="bg-gray-table">
                <tr>
                  <th>RFI No.</th>
                  <th>Category</th>
                  <th>Status</th>
                  <th>Attachment</th>
                  <th>Remarks</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $no = 1;
                  $submit_to_qc = 0;
                  foreach ($mc_rfi_list as $key => $value){ ?>
                  <?php
                    if ($value['rfi_status'] == 7) {
                      $complete = 1;
                    }

										if($value['rfi_status'] == 1 && $value['inspector_id'] == ''){
											$submit_to_qc = 1;
										}
                  ?>
                  <tr>
                    <td name='rfi_no'><?= $value['rfi_no'] ?></td>
                    <td name='rfi_category'><?= $value['rfi_category'] ?></td>
                    <td>
                      <?php
                      if ($value['rfi_status'] == 1) {
                        echo '<span class="badge badge-pill badge-warning">Submit to QC</span>';
                      }
                      elseif($value['rfi_status'] == 2){
                        echo '<span class="badge badge-pill badge-danger">Rejected by QC</span>';
                      }
                      elseif($value['rfi_status'] == 3){
                        echo '<span class="badge badge-pill badge-success">Approved by QC</span>';
                      } elseif ($value['rfi_status'] == 5) {
                        echo '<span class="badge badge-pill badge-warning">Submit to Client</span>';
                      } elseif ($value['rfi_status'] == 6) {
                        echo '<span class="badge badge-pill badge-danger">Rejected by Client</span>';
                      } elseif ($value['rfi_status'] == 7) {
                        echo '<span class="badge badge-pill badge-success">Approved by Client</span>';
                      } elseif ($value['rfi_status'] == 8) {
                        echo '<span class="badge badge-pill badge-success">Approved by Client with Comment</span>';
                      }
                    ?>
                    <span name='rfi_status' class="d-none"><?= $value['rfi_status'] ?></span>
                  </td>
                  <td>
                    <a href="<?php echo base_url() . 'mechanical_completion/open_mechanical_completion_atc/' . $value['attachment'] . '/' . str_replace("&","",$value['rfi_no']) ?>" target="_blank" class="btn btn-sm btn-dark"><i class="fas fa-file-alt"></i></a>
                  </td>
                  <td name='remarks'><?= $value['remarks'] ?></td>
                  <td>
                    <?php if($value['resubmit_status']==0 AND COUNT($mc_rfi_list)==$no){ ?>
                    <?php //if($value['resubmit_status']==0){ ?>
                      <a href="<?php echo base_url() . 'mechanical_completion/mechanical_completion_rfi/' . strtr($this->encryption->encrypt($value['id']), '+=/', '.-~') ?>" target="_blank" class="btn btn-sm btn-warning <?= $mc['status']==9 ? 'd-none' : '' ?> <?= $value['rfi_status']==2 ? 'd-none' : '' ?>"><i class="fas fa-edit"></i> Edit</a>
                    <?php } ?>

                    <?php if($value['rfi_status'] == 2){ ?>
                      <?php if($value['resubmit_status']==1){ ?>
                        <span class="badge badge-info"> Resubmit to <b><?= $value['rfi_no'] ?></b></span>
                      <?php } else { ?>
                        <button class="btn btn-info" onclick="resubmit_modal(this, '<?= $value['id'] ?>', '<?= $value['rfi_no'] ?>')"><i class="fas fa-plus"></i> Re-Submit</button>
                      <?php } ?>
                    <?php } ?>
                    <?php if($value['rfi_status'] == 5){ ?>
                      <?php if($value['status_invitation']==0){ ?>
                        <button class="btn btn-danger" onclick="send_invitation_modal(this, '<?= $value['id'] ?>', '<?= $value['rfi_no'] ?>')"><i class="fas fa-envelope"></i> Transmittal</button>
                      <?php } ?>
                    <?php } ?>

                    <?php if($value['rfi_status']==6 AND $mc['status']==8 AND $value['resubmit_status']==0){ ?>
                      <button class="btn btn-info" onclick="resubmit_modal(this, '<?= $value['id'] ?>', '<?= $value['rfi_no'] ?>')"><i class="fas fa-plus"></i> Re-Submit PMT</button>
                    <?php } ?>
                  </td>
                </tr>
              <?php $no++; } ?>
              </tbody>
            </table>
          </div>
          <br>
          <div class="modal fade" id="modal_qc" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalLabel"></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                </div>
              </div>
            </div>
          </div>
          <div class="text-right">
            <?php if($mc['submit_qc_by'] == '' OR ($submit_to_qc == 1)): ?>
              <script>
                function send_invitation_modal_qc(event, id, rfi_no) {
                  let url = "<?= site_url('mechanical_completion/send_invitation_modal_qc/') ?>"+id

                  $("#modal_qc").modal({
                    show : true,
                    keyboard : false,
                    backdrop : "static"
                  }).find('.modal-body').load(url)
                  $('.modal-title').html(`Submit to QC`)
                  $('.modal-dialog').addClass('modal-lg')
                }
              </script>
              <?php
                $id_mc_enc = strtr($this->encryption->encrypt($mc['id']), '+=/', '.-~');
              ?>
              <button class="btn btn-sm btn-success" onclick="send_invitation_modal_qc(this, '<?= $id_mc_enc ?>', '')"><i class="fas fa-check"></i> Submit to QC</button>

              <!-- <a class="btn btn-sm btn-success" href="<?= base_url() ?>mechanical_completion/submit_to_qc/<?= strtr($this->encryption->encrypt($mc['id']), '+=/', '.-~') ?>" onclick="sweetalert('confirm', 'Are you sure?', this, event)"><i class="fas fa-check"></i> Submit to QC</a> -->
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- <div class="row <?= (in_array($mc['status'], [9, 10, 11])) ? '' : 'd-none' ?>">
    <div class="col">
      <div class="card shadow my-3 rounded-0">

        <div class="card-body bg-white">
          <form id="complete_rfi" method="POST" action="<?= base_url('mechanical_completion/mechanical_completion_complete_process') ?>" enctype="multipart/form-data">
            <input type="hidden" name="id_mc" value="<?php echo strtr($this->encryption->encrypt($mc['id']), '+=/', '.-~') ?>">
            <div class="row">
              <div class="col-md-12 text-right"> 
                <button type="submit" class="btn btn-success" name="complete" value="5" onclick="sweetalert('confirm', '<strong>Complete</strong>', this, event, null);"><i class="fas fa-check"></i> Complete</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div> -->

  <!-- <div class="row <?= (in_array($mc['status'], [5])) ? '' : 'd-none' ?>">
    <div class="col">
      <div class="card shadow my-3 rounded-0">

        <div class="card-body bg-white">
          <form id="complete_rfi" method="POST" action="<?= base_url('mechanical_completion/mechanical_completion_upload_pims_process') ?>" enctype="multipart/form-data">
            <input type="hidden" name="id_mc" value="<?php echo strtr($this->encryption->encrypt($mc['id']), '+=/', '.-~') ?>">
            <div class="row">
              <div class="col-md-12 text-right"> 
                <button type="submit" class="btn btn-success" name="complete" value="5" onclick="sweetalert('confirm', '<strong>Upload to PIMS?</strong>', this, event, null);"><i class="fas fa-check"></i> Upload to PIMS</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div> -->

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">

        <div class="card-body bg-white">
          <?php if($this->permission_cookie[155] == 1): ?>
            <a href="<?php echo base_url() ?>mechanical_completion/mechanical_completion_reset_progress_process/<?php echo $id_enc ?>" class="btn btn-sm btn-danger" onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-danger&#34;>&nbsp;Reset&nbsp;</b>?', this, event)">Reset Progress RFi</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

</div>
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>
</div><!-- ini div dari sidebar yang class wrapper -->
<script>
  function send_invitation_modal(event, id, rfi_no) {
    let url = "<?= site_url('mechanical_completion/send_invitation_modal/') ?>" + id

    $("#modal").modal({
      show: true,
      keyboard: false,
      backdrop: "static"
    }).find('.modal-body').load(url)
    $('.modal-title').html(`Transmittal - ${rfi_no}`)
    $('.modal-dialog').addClass('modal-lg')
  }

  function resubmit_modal(event, id, rfi_no) {
    let url = "<?= site_url('mechanical_completion/resubmit_modal/') ?>"+id

    $("#modal").modal({
      show : true,
      keyboard : false,
      backdrop : "static"
    }).find('.modal-body').load(url)
    $('.modal-title').html(`Re-Submit - ${rfi_no}`)
    $('.modal-dialog').addClass('modal-lg')
  }

  $("select[name=module]").chained("select[name=project]");

  $("select[name=module]").chained("select[name=project]");
  $("select[name=rfi_status]").chained("select[name=rfi_category]");

  $('.dataTable').DataTable({
    order: [],
  });

  $('.select2-multiple-tags').select2({
    tags: true,
    multiple: true,
    placeholder: 'Document Name'
  })
</script>