<?php
  if($status_inspection == 'draft'){
    $is_required = 'required';
  }
?>
<style>
  [data-tooltip] {
    position: relative;
    z-index: 2;
    cursor: pointer;
  }

  /* Hide the tooltip content by default */
  [data-tooltip]:before,
  [data-tooltip]:after {
    visibility: hidden;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: progid: DXImageTransform.Microsoft.Alpha(Opacity=0);
    opacity: 0;
    pointer-events: none;
  }

  /* Position tooltip above the element */
  [data-tooltip]:before {
    position: absolute;
    bottom: 150%;
    left: 50%;
    margin-bottom: 5px;
    margin-left: -80px;
    padding: 7px;
    width: 160px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    background-color: #000;
    background-color: hsla(0, 0%, 20%, 0.9);
    color: #fff;
    content: attr(data-tooltip);
    text-align: center;
    font-size: 14px;
    line-height: 1.2;
  }

  /* Triangle hack to make tooltip look like a speech bubble */
  [data-tooltip]:after {
    position: absolute;
    bottom: 150%;
    left: 50%;
    margin-left: -5px;
    width: 0;
    border-top: 5px solid #000;
    border-top: 5px solid hsla(0, 0%, 20%, 0.9);
    border-right: 5px solid transparent;
    border-left: 5px solid transparent;
    content: " ";
    font-size: 0;
    line-height: 0;
  }

  /* Show tooltip content on hover */
  [data-tooltip]:hover:before,
  [data-tooltip]:hover:after {
    visibility: visible;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
    filter: progid: DXImageTransform.Microsoft.Alpha(Opacity=100);
    opacity: 1;
  }

  .badge-approved_comment {
    color: #ffffff;
    background-color: #2c7008;
  }

  .badge-pending_client {
    color: #ffffff;
    background-color: #b80762;
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
    <div class="col-md-12">

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
                    <?php // test_var($post, 1) 
                    ?>
                    <div class="col-6">
                      <div class="form-group row">
                        <label class="col-md-4 col-lg-3 col-form-label ">Project ID</label>
                        <div class="col-xl">
                          <?php
                            $selected_project = @$post['project'];
                            if($selected_project == ''){
                              $selected_project = $this->user_cookie[10];
                            }
                          ?>
                          <select class="form-control" name="project" required onchange="find_deck_by_project(this)">
                            <option value="">---</option>
                              <?php foreach ($project_list as $key => $value) : ?>
                                <?php if (in_array($value['id'], $this->user_cookie[13])) { ?>
                                  <option onclick="save_project()" value="<?php echo $value['id'] ?>" <?php echo (@$selected_project == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                                <?php } ?>
                              <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-6">
                      <div class="form-group row">
                        <label class="col-md-4 col-lg-3 col-form-label ">Type Of Module</label>
                        <div class="col-xl">
                          <select class="form-control" name="type_of_module" <?= $is_required ?>>
                            <option value="">---</option>
                            <?php foreach ($type_of_module_list as $key => $value) : ?>
                              <option value="<?php echo $value['id'] ?>" <?php echo (@$post['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['name'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">

                    <div class="col-6">
                      <div class="form-group row">
                        <label class="col-md-4 col-lg-3 col-form-label ">Module</label>
                        <div class="col-xl">
                          <select class="form-control" name="module" <?= $is_required ?>>
                            <option value="">---</option>
                            <?php foreach ($module_list as $key => $value) : ?>
                              <option value="<?php echo $value['mod_id'] ?>" data-chained="<?php echo $value['project_id'] ?>" <?php echo (@$post['module'] == $value['mod_id'] ? 'selected' : '') ?>><?php echo $value['mod_desc'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-6">
                      <div class="form-group row">
                        <label class="col-md-4 col-lg-3 col-form-label ">Company </label>
                        <div class="col-xl">
                          <?php
                            $selected_company = @$post['company_id'];
                            // if($selected_company == ''){
                            //   $selected_company = $this->user_cookie[11];
                            // }
                          ?>
                          <select class="form-control select2" name="company_id" <?= $is_required ?>>
                            <option value=''>~ Choose ~ <?= $selected_company ?></option>
                            <?php foreach ($company_list as $key => $value) { ?>
                              <option value='<?= $value['id_company'] ?>' <?= ($value['id_company'] == $selected_company ? "selected" : "") ?>>
                                <?= $value['company_name'] ?>
                              </option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group row">
                        <label class="col-md-4 col-lg-3 col-form-label ">Discipline</label>
                        <div class="col-xl">
                          <select class="form-control" name="discipline" <?= $is_required ?>>
                            <option value="">---</option>
                            <?php foreach ($discipline_list as $key => $value) : ?>
                              <option value="<?php echo $value['id'] ?>" <?php echo (@$post['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-6">
                      <div class="form-group row">
                        <label class="col-md-4 col-lg-3 col-form-label ">IRN Type</label>
                        <div class="col-xl">
                          <select class="select2 form-control" name="irn_type" <?= $is_required ?>>
                            <option value="">---</option>
                            <option value="1" <?= $post['irn_type'] == 1 ? 'selected' : '' ?>>Installation</option>
                            <option value="2" <?= $post['irn_type'] == 2 ? 'selected' : '' ?>>Blasting & Painting</option>
                            <option value="3" <?= $post['irn_type'] == 3 ? 'selected' : '' ?>>Galvanized</option>
                            <option value="4" <?= $post['irn_type'] == 4 ? 'selected' : '' ?>>Erection</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-6">
                      <div class="form-group row">
                        <label class="col-md-4 col-lg-3 col-form-label "><?php if ($status_inspection == 'rfi_list') { ?>Status Inspection<?php } ?></label>
                        <div class="col-xl">
                          <?php if ($status_inspection == 'rfi_list') { ?>
                            <select name='status_inspection_filter' class='form-control'>
                              <option value='All' <?= @$post['status_inspection_filter'] == 'All' ? "selected" : null ?>>All</option>
                              <option value='5' <?= @$post['status_inspection_filter'] == '5' ? "selected" : null ?>>Pending By Client</option>
                              <option value='7' <?= @$post['status_inspection_filter'] == '7' ? "selected" : null ?>>Approved By Client</option>
                              <option value='9' <?= @$post['status_inspection_filter'] == '9' ? "selected" : null ?>>Approved & Released By Client</option>
                              <option value='11' <?= @$post['status_inspection_filter'] == '11' ? "selected" : null ?>>Re-Offer By Client</option>
                              <option value='6' <?= @$post['status_inspection_filter'] == '6' ? "selected" : null ?>>Rejected By Client</option>
                            </select>
                          <?php } ?>
                        </div>
                      </div>
                    </div>

                    <div class="col-6 <?= $selected_project == 21 ? null : 'd-none' ?>" id="div_deck">
                      <div class="form-group row">
                        <label class="col-md-4 col-lg-3 col-form-label">Deck Elevation / Service Line</label>
                        <div class="col-xl">
                          <select class="form-control" name="deck_elevation" id="deck_change" onchange='autofilter(this);' <?= $selected_project == 21 ? $is_required : '' ?>>
                            <option value="">---</option>
                            <?php foreach ($deck_elevation_list as $key => $value) { ?>
                              <option value="<?= $value['id']; ?>" <?= ($value['id'] == @$post['deck_elevation'] ? "selected" : "") ?>><?= $value['name']; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>


                  <div class="row">
                    <div class="col-6">
                      <div class="form-group row">
                        <label class="col-md-4 col-lg-3 col-form-label "> </label>
                        <div class="col-xl">

                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group row">
                        <label class="col-md-4 col-lg-3 col-form-label "> </label>
                        <div class="col-xl">

                        </div>
                      </div>
                    </div>
                  </div>


                  <div class="row">
                    <div class="col-6">
                      <div class="form-group row">

                      </div>
                    </div>

                    <div class="col-6">
                      <div class="form-group row">

                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-12 text-right">
                      <button class="mt-2 btn btn-sm btn-flat btn-info"><i class="fas fa-search"></i> Search</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0"><?php echo $meta_title ?></h6>
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
          <div class="container-fluid">

            <form action='<?php echo base_url(); ?>irn/submit_multiple_draft' method='POST'>

              <?php
              if (
                $status_inspection == "draft" &&
                (isset($post["discipline"]) && !empty($post["discipline"])) &&
                (isset($post["company_id"]) && !empty($post["company_id"])) &&
                (isset($post["module"]) && !empty($post["module"])) &&
                (isset($post["type_of_module"]) && !empty($post["type_of_module"])) &&
                (isset($post["irn_type"]) && !empty($post["irn_type"]))
              ) { ?>

                <div class="row">
                  <div class="col-6">
                    <div class="form-group row">
                      <label class="col-md-4 col-lg-3 col-form-label ">Manual Report Number</label>
                      <div class="col-xl">
                        <input type='number' name='report_number_manual' class='form-control' placeholder='Type IRN Report Number Manually' required>
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group row">
                      <label class="col-md-4 col-lg-3 col-form-label "></label>
                      <div class="col-xl">

                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-12 text-left">
                    <div class="form-group row">
                      <!-- <label class="col-md-4 col-lg-3 col-form-label "></label> -->
                      <div class="col-xl">
                        <table>
                          <tr>
                            <td width="15%" class="font-weight-bold">Next Report Number</td>
                            <td>: </td>
                            <td>&nbsp;
                              <?php echo $next_report_no; ?>
                            </td>
                          </tr>
                          <tr>
                            <td class="font-weight-bold">Latest Report Number</td>
                            <td>: </td>
                            <td>&nbsp;
                              <?php echo $highest_report_no; ?>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="3">
                              <hr>
                            </td>
                          </tr>
                          <tr>
                            <td style="vertical-align: text-top !important;" class="font-weight-bold">Missing Report Number</td>
                            <td style="vertical-align: text-top !important;">: </td>
                            <td style="vertical-align: text-top !important;">&nbsp;
                              <?php foreach ($missing_report_no as $key => $value) {
                                echo "<u>" . str_pad(substr($value, -6), 6, '0', STR_PAD_LEFT) . "</u><b>,  </b>";
                              } ?>
                            </td>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group row">
                      <label class="col-md-4 col-lg-3 col-form-label "></label>
                      <div class="col-xl">
                      </div>
                    </div>
                  </div>
                </div>
              <?php } ?>

              <table class="table table-hover text-center dataTable" width="100%">
                <thead class="bg-gray-table">
                  <tr>
                    <?php if ($status_inspection == "draft") { ?>
                      <th>#</th>
                    <?php } ?>
                    <th>Report Number</th>
                    <th>IRN Type</th>
                    <th>IRN Name / Remarks</th>
                    <th>Discipline</th>
                    <?= $selected_project == 21 ? "<th>Deck Elevation / Service Line</th>" : "" ?>
                    <th>Module</th>
                    <th>Type Of Module</th>
                    <th>Company</th>
                    <th>Submission Date</th>  
                    <th>Status Document</th>
                    <th>Status Inspection</th>
                    <th width="300px !important;">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1;
                  foreach ($irn_list as $key => $value) {
                  ?>
                    <tr>
                      <?php if ($status_inspection == "draft") { ?>
                        <td>
                          <input type='checkbox' class='form-control' name='submit_multiple[]' value='<?= $value['submission_id'] ?>'>
                          <input type='hidden' class='form-control' name='project[]' value='<?= $value['project'] ?>'>
                          <input type='hidden' class='form-control' name='discipline[]' value='<?= $value['discipline'] ?>'>
                          <input type='hidden' class='form-control' name='module[]' value='<?= $value['module'] ?>'>
                          <input type='hidden' class='form-control' name='type_of_module[]' value='<?= $value['type_of_module'] ?>'>
                          <input type='hidden' class='form-control' name='company_id[]' value='<?= $value['company_id'] ?>'>
                          <input type='hidden' class='form-control' name='irn_type[]' value='<?= $value['irn_type'] ?>'>
                          <input type='hidden' class='form-control' name='deck_elevation[]' value='<?= $value['deck_elevation'] ?>'>
                        </td>
                      <?php }
                      if ($value['project'] == 21) { ?>
                        <td><?=
                            (isset($value['report_number']) ? $master_report_number[$value['project']][$value['company_id']][$value['discipline']][$value['type_of_module']][$value['deck_elevation']][$value['irn_type']]["irn_report"] . $value['report_number'] : "Draft-" . $value['submission_id'])
                            ?></td>
                      <?php } else { ?>
                        <td><?=
                            (isset($value['report_number']) ? $master_report_number[$value['project']][$value['company_id']][$value['discipline']][$value['type_of_module']][$value['irn_type']]["irn_report"] . $value['report_number'] : "Draft-" . $value['submission_id'])
                            ?></td>
                      <?php } ?>
                      <?php
                      // test_var($value['report_number'], 1);
                      // test_var($master_report_number[$value['project']], 1) 
                      ?>
                      <td>
                        <?php
                        if ($value['irn_type'] == 1) {
                          echo "Installation";
                        } elseif ($value['irn_type'] == 2) {
                          echo "Blasting & Painting";
                        } elseif ($value['irn_type'] == 3) {
                          echo "Galvanized";
                        } elseif ($value['irn_type'] == 4) {
                          echo "Erection";
                        }
                        ?>
                      </td>

                      <td style='width:200px !important;' <?php if ($this->permission_cookie['157'] == 1) { ?> contenteditable='true' onfocus="edit_data_irn(this)" onblur="change_desc_document_func('<?= $value['submission_id'] ?>', this)" <?php } ?>>
                        <?php echo (isset($value['irn_description']) ? $value['irn_description'] : "-"); ?>
                      </td>

                      <td><?php echo $discipline_name[$value['discipline']]; ?></td>
                      <?php if ($value['project'] == 21) { ?>
                        <td><?php echo $deck_elevation_list[$value['deck_elevation']]['name']; ?></td>
                      <?php  } ?>
                      <td><?php echo $module_code[$value['module']]; ?></td>
                      <td><?php if (isset($type_of_module_name[$value['type_of_module']])) {
                            echo $type_of_module_name[$value['type_of_module']];
                          } else {
                            echo "-";
                          } ?></td>
                      <td><?= isset($company_name[$value['company_id']]) ? $company_name[$value['company_id']] : "-" ?></td>
                      <td>
                        <?php if ($value['status_inspection'] != 1 and $value['status_inspection'] != 0) { ?>
                          <?= date("d F y H:i:s", strtotime($value['submission_date'])) ?>
                        <?php } else { ?>
                          -
                        <?php } ?>
                      </td>
                      <td>
                        <?php if ($value['status_inspection'] != 1) { ?>
                          <?php
                          if ($value['status_document'] == '1') {
                            echo '<span id="status_document_' . $value['submission_id'] . '" class="badge badge-success">Completed</span>';
                          } else if ($value['status_document'] == '2') {
                            if ($value['status_inspection'] == 7) {
                              echo '<span id="status_document_' . $value['submission_id'] . '" class="badge badge-success">Completed</span>';
                            } else {
                              echo '<span  id="status_document_' . $value['submission_id'] . '" class="badge badge-danger">Not Completed</span>';
                            }
                          } else if ($value['status_document'] == '3') {
                            echo '<span id="status_document_' . $value['submission_id'] . '" class="badge badge-light">Not Available</span>';
                          }
                          ?>

                          <?php if (isset($value['status_document_by']) && $value['status_document'] == 1) { ?>
                            <br />
                            <span style='font-size:9px;'>
                              <?= isset($user_list[$value['status_document_by']]) ? $user_list[$value['status_document_by']] : null ?>
                              <br />
                              <?= $value['status_document_date'] ?></span>
                          <?php } ?>

                          <?php if ($this->user_cookie[7] != 8) { ?>
                            <br /><br />
                            <select name='change_status_document' id='change_status_document_<?= $value['submission_id'] ?>' onchange="change_status_document_func('<?= $value['submission_id'] ?>')">
                              <option value='1' <?= $value['status_document'] == "1" ? "selected" : null ?>>Completed</option>
                              <option value='2' <?= $value['status_document'] == "2" ? "selected" : null ?>>Not Completed</option>
                              <option value='3' <?= $value['status_document'] == "3" ? "selected" : null ?>>Not Available</option>
                            </select>
                          <?php } ?>

                        <?php } else { ?>

                          -

                        <?php } ?>
                      </td>
                      <td>
                        <?php if ($value['status_inspection'] == 0) { ?>
                          <span class="badge badge-primary">Draft</span>
                        <?php } else if ($value['status_inspection'] == 1) { ?>
                          <span class="badge badge-primary">Pending QC SMOE</span>
                        <?php } else if ($value['status_inspection'] == 2) { ?>
                          <span class="badge badge-danger">Rejected QC SMOE</span>
                        <?php } else if ($value['status_inspection'] == 3) { ?>
                          <span class="badge badge-success">Approved By QC</span>
                        <?php } else if ($value['status_inspection'] == 4) { ?>
                          <span class="badge badge-primary">Pending Process By QC</span>
                        <?php } else if ($value['status_inspection'] == 5) { ?>
                          <span class="badge badge-pending_client">Pending By Client</span>
                        <?php } else if ($value['status_inspection'] == 6) { ?>
                          <span class="badge badge-danger">Reject By Client</span>
                        <?php } else if ($value['status_inspection'] == 7) { ?>
                          <?php if ($value['project'] == 20) { ?>
                            <span class="badge badge-primary">Pending Review</span>
                          <?php } else { ?>
                            <span class="badge badge-success">Approved By Client</span>
                          <?php } ?>
                        <?php } else if ($value['status_inspection'] == 8) { ?>
                          <span class="badge badge-info">Requested For Update</span>
                        <?php } else if ($value['status_inspection'] == 9) { ?>
                          <span class="badge badge-approved_comment">Approve & Release With Comment</span>
                        <?php } else if ($value['status_inspection'] == 10) { ?>
                          <span class="badge badge-info">Postponed</span>
                        <?php } else if ($value['status_inspection'] == 11) { ?>
                          <span class="badge badge-warning">Re-Offer</span>
                        <?php } else if ($value['status_inspection'] == 12) { ?>
                          <span class="badge badge-secondary">Void</span>
                        <?php } else if ($value['status_inspection'] == 13) { ?>
                          <span class="badge badge-success">Reviewed By Employer</span>
                        <?php } ?>
                      </td>



                      <td style='width:200px !impontant;'>

                        <?php $array_edit_irn = array(161, 1000362, 1000492, 1001247, 1000311, 1001214, 1000471, 1001564, 1001596, 1000392, 1000256, 1001422, 1000391, 1000913, 1000432, 1000746); ?>


                        <div class="btn-group-horizontal">


                          <?php if ($value['status_inspection'] == 0) { ?>

                            <a title='Remove Draft' onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-success&#34;>&nbsp;Remove&nbsp;</b> this?', this, event)" href='<?php echo  base_url(); ?>irn/remove_draft/<?php echo strtr($this->encryption->encrypt($value['submission_id']), '+=/', '.-~'); ?>'>
                              <span class='btn btn-warning'><i class="far fa-trash-alt"></i></span>
                            </a>


                            <?php if ($category_irn == 0) { ?>
                              <a href='<?php echo  base_url(); ?>irn/create_new_irn/<?php echo strtr($this->encryption->encrypt($value['submission_id']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt(0), '+=/', '.-~'); ?>'>
                                <span class='btn btn-secondary'><i class="far fa-file-alt"></i></span>
                              </a>

                              <a href='<?php echo  base_url(); ?>irn/show_irn_detail/<?php echo strtr($this->encryption->encrypt($value['submission_id']), '+=/', '.-~'); ?>'>
                                <span class='btn btn-danger'><i class="fas fa-file-pdf"></i> RFI</span>
                              </a>

                            <?php } else { ?>

                              <?php if ($value['is_itr'] != 1) { ?>

                                <a href='<?php echo  base_url(); ?>irn/create_new_irn_material/<?php echo strtr($this->encryption->encrypt($value['submission_id']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt(1), '+=/', '.-~'); ?>'>
                                  <span class='btn btn-secondary'><i class="far fa-file-alt"></i></span>
                                </a>

                              <?php } else { ?>

                                <a href='<?php echo  base_url(); ?>irn/create_new_irn_material_itr/<?php echo strtr($this->encryption->encrypt($value['submission_id']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt(1), '+=/', '.-~'); ?>'>
                                  <span class='btn btn-secondary'><i class="far fa-file-alt"></i></span>
                                </a>

                              <?php } ?>

                              <a href='<?php echo  base_url(); ?>irn/show_irn_detail_material/<?php echo strtr($this->encryption->encrypt($value['submission_id']), '+=/', '.-~'); ?>'>
                                <span class='btn btn-danger'><i class="fas fa-file-pdf"></i></span>
                              </a>

                            <?php } ?>

                          <?php } else { ?>
                            <?php if ($category_irn == 0) { ?>



                              <?php if ($this->permission_cookie[204] == 1) { ?>

                                <?php if ($value['status_inspection'] == 1) { ?>
                                  <button type='button' onclick="sweetalert('confirm_remarks', 'Are you sure to <b class=&#34;text-success&#34;>&nbsp;Cancel&nbsp;</b> this?', this, event, 'return_to_draft')" title='Return to Draft' data-report_number="<?php echo $value['report_number'] ?>" data-project="<?php echo $value['project'] ?>" data-discipline="<?php echo $value['discipline'] ?>" data-submission_id="<?php echo $value['submission_id'] ?>" class='btn btn-warning'><i class="fas fa-undo"></i></button>
                                <?php } else if ($value['status_inspection'] == 5) { ?>
                                  <button type='button' onclick="sweetalert('confirm_remarks', 'Are you sure to <b class=&#34;text-success&#34;>&nbsp;Cancel&nbsp;</b> this?', this, event, 'return_to_qc')" title='Return to QC Inspection' data-report_number="<?php echo $value['report_number'] ?>" data-project="<?php echo $value['project'] ?>" data-discipline="<?php echo $value['discipline'] ?>" data-submission_id="<?php echo $value['submission_id'] ?>" class='btn btn-warning'><i class="fas fa-undo"></i></button>
                                <?php } ?>

                                <?php if ($this->permission_cookie[129] == 1 && @!in_array($value['status_inspection'], array("7"))) { ?>
                                  <a title='Update IRN Details' href='<?php echo  base_url(); ?>irn/create_new_irn/<?php echo strtr($this->encryption->encrypt($value['submission_id']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt(0), '+=/', '.-~'); ?>'>
                                    <span class='btn btn-info'><i class="fas fa-edit"></i></span>
                                  </a>
                                <?php } ?>

                              <?php } ?>

                              <a href='<?php echo  base_url(); ?>irn/show_irn_detail/<?php echo strtr($this->encryption->encrypt($value['submission_id']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt("report_no"), '+=/', '.-~'); ?>'>
                                <span class='btn btn-secondary'><i class="far fa-file-alt"></i></span>
                              </a>

                              <a href='<?php echo  base_url(); ?>irn/show_irn_detail/<?php echo strtr($this->encryption->encrypt($value['submission_id']), '+=/', '.-~'); ?>'>
                                <span class='btn btn-danger'><i class="fas fa-file-pdf"></i> RFI</span>
                              </a>

                              <!-- <a href='<?php echo  base_url(); ?>irn/show_irn_detail_wtr/<?php echo strtr($this->encryption->encrypt($value['submission_id']), '+=/', '.-~'); ?>'>
                              <span class='btn btn-danger'><i class="fas fa-file-pdf"></i> MWTR</span>
                          </a>  -->

                            <?php } else { ?>

                              <?php if ($this->permission_cookie[204] == 1) { ?>

                                <?php if ($value['status_inspection'] == 1) { ?>
                                  <button type='button' onclick="sweetalert('confirm_remarks', 'Are you sure to <b class=&#34;text-success&#34;>&nbsp;Cancel&nbsp;</b> this?', this, event, 'return_to_draft')" title='Return to Draft' data-report_number="<?php echo $value['report_number'] ?>" data-project="<?php echo $value['project'] ?>" data-discipline="<?php echo $value['discipline'] ?>" data-submission_id="<?php echo $value['submission_id'] ?>" class='btn btn-warning'><i class="fas fa-undo"></i></button>
                                <?php } else if ($value['status_inspection'] == 5) { ?>
                                  <button type='button' onclick="sweetalert('confirm_remarks', 'Are you sure to <b class=&#34;text-success&#34;>&nbsp;Cancel&nbsp;</b> this?', this, event, 'return_to_qc')" title='Return to QC Inspection' data-report_number="<?php echo $value['report_number'] ?>" data-project="<?php echo $value['project'] ?>" data-discipline="<?php echo $value['discipline'] ?>" data-submission_id="<?php echo $value['submission_id'] ?>" class='btn btn-warning'><i class="fas fa-undo"></i></button>
                                <?php } ?>

                                <?php if ($this->permission_cookie[129] == 1 && @!in_array($value['status_inspection'], array("7"))) { ?>
                                  <?php if ($value['is_itr'] != 1) { ?>
                                    <a title='Update IRN Details' href='<?php echo  base_url(); ?>irn/create_new_irn_material/<?php echo strtr($this->encryption->encrypt($value['submission_id']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt(1), '+=/', '.-~'); ?>'>
                                      <span class='btn btn-info'><i class="fas fa-edit"></i></span>
                                    </a>
                                  <?php } else { ?>
                                    <a title='Update IRN Details' href='<?php echo  base_url(); ?>irn/create_new_irn_material_itr/<?php echo strtr($this->encryption->encrypt($value['submission_id']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt(1), '+=/', '.-~'); ?>'>
                                      <span class='btn btn-info'><i class="fas fa-edit"></i></span>
                                    </a>
                                  <?php } ?>
                                <?php } ?>

                              <?php } ?>

                              <a title='IRN Details' href='<?php echo  base_url(); ?>irn/show_irn_detail_material/<?php echo strtr($this->encryption->encrypt($value['submission_id']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt("report_no"), '+=/', '.-~'); ?>'>
                                <span class='btn btn-secondary'><i class="far fa-file-alt"></i></span>
                              </a>

                              <a title='Export to PDF' href='<?php echo  base_url(); ?>irn/show_irn_detail_material/<?php echo strtr($this->encryption->encrypt($value['submission_id']), '+=/', '.-~'); ?>'>
                                <span class='btn btn-danger'><i class="fas fa-file-pdf"></i></span>
                              </a>

                            <?php }   ?>
                          <?php } ?>
                          <?php if ($this->permission_cookie[129] == 1 && $value['status_inspection'] == 3) { ?>
                            <a title='Transmit to Client' onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-success&#34;>&nbsp;Transmit&nbsp;</b> this?', this, event)" href='<?php echo  base_url(); ?>irn/process_transmittal_irn_client/<?php echo strtr($this->encryption->encrypt($value['submission_id']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($category_irn), '+=/', '.-~'); ?>'>
                              <span class='btn btn-warning'><i class="fas fa-share"></i></span>
                            </a>
                          <?php } ?>

                          <?php if ($this->permission_cookie[129] == 1 && in_array($value['status_inspection'], array("11", "10", "6"))) { ?>
                            <a title='Re-Transmit to Client' onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-success&#34;>&nbsp;Re-Transmit&nbsp;</b> this?', this, event)" href='<?php echo  base_url(); ?>irn/process_transmittal_irn_client/<?php echo strtr($this->encryption->encrypt($value['submission_id']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($category_irn), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt("resubmit"), '+=/', '.-~'); ?>'>
                              <span class='btn btn-warning'><i class="fas fa-share"></i></span>
                            </a>
                          <?php } ?>
                        </div>
                      </td>

                    </tr>
                  <?php $no++;
                  } ?>
                </tbody>
              </table>
              <?php if ($status_inspection == "draft" && isset($post["discipline"]) && isset($post["company_id"]) && isset($post["module"]) && isset($post["type_of_module"])) { ?>
                <br />
                <button type='submit' class='btn btn-primary'> <i class="fas fa-paper-plane"></i> Submit</button>
              <?php  } ?>
            </form>


          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<script type="text/javascript">
  $('.dataTable').DataTable({
    order: [1, "asc"],
  })
</script>

<script>
  function return_to_draft(btn, remarks) {
    console.log(btn);
    $.ajax({
      url: "<?php echo base_url() ?>irn/reset_report_number",
      data: {
        report_number: $(btn).data("report_number"),
        project: $(btn).data("project"),
        discipline: $(btn).data("discipline"),
        submission_id: $(btn).data("submission_id"),
        remarks: remarks,
      },
      type: 'post',
      success: function(data) {
        if (data.includes('Error') == true) {
          sweetalert("error", data);
        } else {
          sweetalert("success", "Return Data Success!");
          location.reload();
        }
      }
    });
  }

  function return_to_qc(btn, remarks) {
    console.log(btn);
    $.ajax({
      url: "<?php echo base_url() ?>irn/reset_client_inspection",
      data: {
        report_number: $(btn).data("report_number"),
        project: $(btn).data("project"),
        discipline: $(btn).data("discipline"),
        submission_id: $(btn).data("submission_id"),
        remarks: remarks,
      },
      type: 'post',
      success: function(data) {
        if (data.includes('Error') == true) {
          sweetalert("error", data);
        } else {
          sweetalert("success", "Return Data Success!");
          location.reload();
        }
      }
    });
  }

  var description_first;

  function edit_data_irn(input) {
    description_first = $(input)[0].innerText
  }

  function change_desc_document_func(submission_id, ini) {
    var valu = $(ini)[0].innerText

    if (valu != description_first) {
      $.ajax({
        url: "<?php echo base_url() ?>irn/change_name_document",
        data: {
          submission_id: submission_id,
          irn_description: valu
        },
        type: 'post',
        success: function(data) {
          if (data.includes('Error') == true) {
            sweetalert("error", data);
          } else {
            sweetalert("success", "Description Updated!");
          }
        }
      });
    }
  }

  function change_status_document_func(submission_id) {
    var status_document = $('#change_status_document_' + submission_id).find(":selected").val();
    $.ajax({
      url: "<?php echo base_url() ?>irn/change_status_document",
      data: {
        submission_id: submission_id,
        status_document: status_document
      },
      type: 'post',
      success: function(data) {
        if (data.includes('Error') == true) {
          sweetalert("error", data);
        } else {
          // sweetalert("success", "Change Status Document Success!"); 

          var current_status = $('#status_document_' + submission_id).text();

          if (status_document == '1') {
            var button_vi = "badge-success";
            var text_vi = "Completed";
          } else if (status_document == '2') {
            var button_vi = "badge-danger";
            var text_vi = "Not Completed";
          } else if (status_document == '3') {
            var button_vi = "badge-light";
            var text_vi = "Not Available";
          }

          console.log(current_status);

          if (current_status == 'Completed') {
            $('#status_document_' + submission_id).removeClass('badge-success').addClass(button_vi);
            $('#status_document_' + submission_id).text(text_vi);
          } else if (current_status == 'Not Completed') {
            $('#status_document_' + submission_id).removeClass('badge-danger').addClass(button_vi);
            $('#status_document_' + submission_id).text(text_vi);
          } else if (current_status == 'Not Available') {
            $('#status_document_' + submission_id).removeClass('badge-light').addClass(button_vi);
            $('#status_document_' + submission_id).text(text_vi);
          }


          // location.reload();
        }
      }
    });
  }

  function find_deck_by_project(select) {
    var project_id = $(select).val()
    if (project_id != 21) {
      $("#deck_change").removeAttr('required');
      $("#div_deck").addClass('d-none');
    } else {
      $("#div_deck").removeClass('d-none');
      $("#deck_change").attr('required', true);
    }
  }
</script>

<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.chained.min.js"></script>
<script>
  $("select[name=module]").chained("select[name=project]");
</script>