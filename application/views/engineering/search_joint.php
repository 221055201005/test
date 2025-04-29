<div id="content" class="container-fluid">
  <div class="row">
    <div class="col-md-5">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <form action="" method="GET">
            <div class="row">
              <div class="col-md">
                <div class="form-group row">
                  <div class="col-md">
                    <input type="text" class="form-control autocomplete_wm" name="drawing_wm" placeholder="Type Drawing WM" value="<?php echo @$get['drawing_wm'] ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md">
                    <input type="text" class="form-control autocomplete_spool_no" name="spool_no" placeholder="Type Spool No" value="<?php echo @$get['spool_no'] ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md">
                    <input type='text' name="joint_no" class="form-control autopiecemark" onfocus="autopiecemark(this);" onblur="search_piecemark(this);" placeholder="Type Joint" value="<?php echo @$get['joint_no'] ?>" required>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-auto">
                    <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-search"></i> Search</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <?php if (@$joint['joint_no'] != '') : ?>
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0"><?php echo $joint['joint_no'] ?></h6>
          </div>
          <div class="card-body bg-white overflow-auto">
            <div class="row">
              <div class="col-md">
                <table border="0">
                  <tr>
                    <td class="font-weight-bold">Drawing No</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo $joint['drawing_no'] ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Drawing WM</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo $joint['drawing_wm'] ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Joint No</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo $joint['joint_no'] ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">GA/AS Reference#1</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo $joint['ref_1'] ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Piecemark#1</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo $joint['pos_1'] ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">GA/AS Reference#2</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo $joint['ref_2'] ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Piecemark#2</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo $joint['pos_2'] ?></td>
                  </tr>
                  <!-- Additional -->
                  <tr>
                    <td class="font-weight-bold">Project</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo $project_list[$joint['project']]['project_name'] ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Discipline</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo $discipline_list[$joint['discipline']]['discipline_name'] ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Module</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo $module_list[$joint['module']]['mod_desc'] ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Type of Module</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo $type_of_module_list[$joint['type_of_module']]['name'] ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Company</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo $company_list[$joint['company_id']]['company_name'] ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Status Internal</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo $joint['status_internal'] == 0 ? 'External' : 'Internal'  ?></td>
                  </tr>
                  <!-- end -->
                  <tr>
                    <td class="font-weight-bold">Deck Elevation / Service Line </td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo $deck_elevation_list[$joint['deck_elevation']]['code'] ?> - <?php echo $deck_elevation_list[$joint['deck_elevation']]['name'] ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Desc Assy.</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo $desc_assy_list[$joint['description_assy']]['code'] ?> - <?php echo $desc_assy_list[$joint['description_assy']]['name'] ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Spool No</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo $joint['spool_no'] ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Row</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo $joint['grid_row'] ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Column</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo $joint['grid_column'] ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Sector</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo @$sector_list[$joint['grid_row'] . $joint['grid_column']] ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Is Bondstrand</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo ($joint['is_bondstrand'] == '1' ? 'Yes' : 'No') ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">History Revision</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><a href="#" onclick="open_history_log(<?php echo $joint['id'] ?>)">Open History</a></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">More Info</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><a target="_blank" href="<?= base_url() ?>engineering/joint_list?status=<?= ($joint['workpack_id'] == '' ? 'outstanding' : 'submitted') ?>&submit=search&drawing_no=<?= $joint['drawing_no'] ?>">Go to Detail</a></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>
    <div class="col-md">
      <?php if (@$joint['joint_no'] != '') : ?>
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0">Results</h6>
          </div>
          <div class="card-body bg-white overflow-auto">
            <ul class="nav nav-pills nav-fill" id="pills-tab" role="tablist">
              <li class="nav-item" role="presentation">
                <a class="rounded-0 nav-link active" id="pills-piecemark-tab" data-toggle="pill" href="#pills-piecemark" role="tab" aria-controls="pills-piecemark" aria-selected="true">
                  Piecemark
                  <?php
                  echo "&nbsp;";
                  if (count($piecemark_list) > 0) {
                    echo "<span class='badge badge-dark badge-pill'>" . count($piecemark_list) . "</span>";
                  } else {
                    echo "<span class='badge badge-light badge-pill'>0</span>";
                  }
                  ?>
                </a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="rounded-0 nav-link" id="pills-workpack-tab" data-toggle="pill" href="#pills-workpack" role="tab" aria-controls="pills-workpack" aria-selected="false">
                  Workpack
                  <?php
                  echo "&nbsp;";
                  if (count($workpack_list) > 0) {
                    echo "<span class='badge badge-dark badge-pill'>" . count($workpack_list) . "</span>";
                  } else {
                    echo "<span class='badge badge-light badge-pill'>0</span>";
                  }
                  ?>
                </a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="rounded-0 nav-link" id="pills-material-tab" data-toggle="pill" href="#pills-material" role="tab" aria-controls="pills-material" aria-selected="false">
                  Material
                  <?php
                  echo "&nbsp;";
                  $num = 0;
                  foreach ($piecemark_list as $piecemark) {
                    $num += count($material_list[$piecemark['id']]);
                  }
                  if ($num > 0) {
                    echo "<span class='badge badge-dark badge-pill'>" . $num . "</span>";
                  } else {
                    echo "<span class='badge badge-light badge-pill'>0</span>";
                  }
                  ?>
                </a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="rounded-0 nav-link" id="pills-fitup-tab" data-toggle="pill" href="#pills-fitup" role="tab" aria-controls="pills-fitup" aria-selected="false">
                  Fit Up
                  <?php
                  echo "&nbsp;";
                  if (count($fitup_list) > 0) {
                    echo "<span class='badge badge-dark badge-pill'>" . count($fitup_list) . "</span>";
                  } else {
                    echo "<span class='badge badge-light badge-pill'>0</span>";
                  }
                  ?>
                </a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="rounded-0 nav-link" id="pills-visual-tab" data-toggle="pill" href="#pills-visual" role="tab" aria-controls="pills-visual" aria-selected="false">
                  Visual
                  <?php
                  echo "&nbsp;";
                  if (count($visual_list) > 0) {
                    echo "<span class='badge badge-dark badge-pill'>" . count($visual_list) . "</span>";
                  } else {
                    echo "<span class='badge badge-light badge-pill'>0</span>";
                  }
                  ?>
                </a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="rounded-0 nav-link" id="pills-ndt-tab" data-toggle="pill" href="#pills-ndt" role="tab" aria-controls="pills-ndt" aria-selected="false">
                  NDT
                  <?php
                  echo "&nbsp;";
                  if (count($ndt_list_all) + count($ndt_list_atc) > 0) {
                    echo "<span class='badge badge-dark badge-pill'>" . (count($ndt_list_all) + count($ndt_list_atc)) . "</span>";
                  } else {
                    echo "<span class='badge badge-light badge-pill'>0</span>";
                  }
                  ?>
                </a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="rounded-0 nav-link" id="pills-bondstrand-tab" data-toggle="pill" href="#pills-bondstrand" role="tab" aria-controls="pills-bondstrand" aria-selected="false">
                  Bondstrand
                  <?php
                  echo "&nbsp;";
                  if (count($bondstrand_list) > 0) {
                    echo "<span class='badge badge-dark badge-pill'>" . count($bondstrand_list) . "</span>";
                  } else {
                    echo "<span class='badge badge-light badge-pill'>0</span>";
                  }
                  ?>
                </a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="rounded-0 nav-link" id="pills-irn-tab" data-toggle="pill" href="#pills-irn" role="tab" aria-controls="pills-irn" aria-selected="false">
                  IRN
                  <?php
                  echo "&nbsp;";
                  if (count($irn_list) > 0) {
                    echo "<span class='badge badge-dark badge-pill'>" . count($irn_list) . "</span>";
                  } else {
                    echo "<span class='badge badge-light badge-pill'>0</span>";
                  }
                  ?>
                </a>
              </li>
            </ul>
            <div class="tab-content overflow-auto" id="pills-tabContent" style="max-height: 60vh;">
              <div class="tab-pane fade show active" id="pills-piecemark" role="tabpanel" aria-labelledby="pills-piecemark-tab">
                <?php foreach ($piecemark_list as $key => $value) : ?>
                  <hr>
                  <table border="0">
                    <tr>
                      <td class="font-weight-bold">Drawing GA</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?php echo $value['drawing_ga'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Drawing AS</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?php echo $value['drawing_as'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Drawing SP</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?php echo $value['drawing_sp'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Drawing CP</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?php echo $value['drawing_cp'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Drawing CL</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?php echo $value['drawing_cl'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Part ID</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?php echo $value['part_id'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Deck Elevation / Service Line </td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?php echo $deck_elevation_list[$value['deck_elevation']]['code'] ?> - <?php echo $deck_elevation_list[$value['deck_elevation']]['name'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Search</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><a target="_blank" href="<?= base_url() ?>engineering/search_piecemark?part_id=<?= $value['part_id'] ?>">Go to Search Piecemark</a></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">More Info</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><a target="_blank" href="<?= base_url() ?>engineering/piecemark_list?status=<?= ($value['workpack_id'] == '' ? 'outstanding' : 'submitted') ?>&submit=search&drawing_ga=<?= $value['drawing_ga'] ?>&drawing_as=<?= $value['drawing_as'] ?>">Go to Detail</a></td>
                    </tr>
                  </table>
                <?php endforeach; ?>
              </div>
              <div class="tab-pane fade" id="pills-workpack" role="tabpanel" aria-labelledby="pills-workpack-tab">
                <?php foreach ($workpack_list as $key => $value) : ?>
                  <hr>
                  <table border="0">
                    <tr>
                      <td class="font-weight-bold">Workpack No.</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?= $value[0]['workpack_no'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Drawing No.</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?= $value[0]['drawing_no'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Test Pack No.</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?= $value[0]['test_pack_no'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Phase</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?= $value[0]['phase'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Company</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?= @$company_list[$value[0]['company_id']]['company_name'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Progress FU</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?= $value[1]['progress_fu'] ?>%</td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Progress VT</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?= $value[1]['progress_vt'] ?>%</td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Status</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td>
                        <?php if ($value[1]['status'] == 3) : ?>
                          <span class="badge badge-danger">Returned</span>
                        <?php elseif ($value[1]['status'] == 4) : ?>
                          <span class="badge badge-dark">Void</span>
                        <?php elseif ($value[1]['progress_fu'] == 100 && $value[1]['progress_vt'] == 100) : ?>
                          <span class="badge badge-success">Complete</span>
                        <?php elseif ($value[0]['status'] == 0) : ?>
                          <span class="badge badge-dark">Not Issued</span>
                        <?php else : ?>
                          <span class="badge badge-warning">Outstanding</span>
                        <?php endif; ?>
                      </td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Remarks</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?= $value[1]['remarks'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">More Info</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><a target="_blank" href="<?= base_url() ?>planning/workpack_detail/<?= strtr($this->encryption->encrypt($value[0]['id']), '+=/', '.-~') ?>">Go to Detail</a></td>
                    </tr>
                  </table>
                <?php endforeach; ?>
              </div>
              <div class="tab-pane fade" id="pills-material" role="tabpanel" aria-labelledby="pills-material-tab">
                <?php foreach ($piecemark_list as $piecemark) : ?>
                  <?php
                  foreach ($material_list[$piecemark['id']] as $key => $value) :
                    $report_enc = strtr($this->encryption->encrypt(@$value['report_number']), '+=/', '.-~');
                    $project_id_enc = strtr($this->encryption->encrypt(@$value['project_code']), '+=/', '.-~');
                    $discipline_enc = strtr($this->encryption->encrypt(@$value['discipline']), '+=/', '.-~');
                    $type_of_module_enc = strtr($this->encryption->encrypt(@$value['type_of_module']), '+=/', '.-~');
                    $module_enc = strtr($this->encryption->encrypt(@$value['module']), '+=/', '.-~');
                    $report_no_rev_enc = strtr($this->encryption->encrypt(@$value['report_no_rev']), '+=/', '.-~');
                    $submission_id_enc = strtr($this->encryption->encrypt(@$value['submission_id']), '+=/', '.-~');
                    $drawing_no_enc = strtr($this->encryption->encrypt(@$value['drawing_no']), '+=/', '.-~');
                    $enc_dec_el = encrypt($piecemark['deck_elevation']);
                    if (@$value['report_number'] ==  '' && @$value['submission_id'] ==  '') {
                      $link_more = base_url() . 'material_verification/production_rfi/';
                    } elseif (@$value['report_number'] ==  '') {
                      $link_more = base_url() . 'material_verification/detail_inspection_rfi/' . $submission_id_enc;
                    } else {
                      if (in_array($value['project_code'], project_by_deck())) {
                        $link_more = base_url() . 'material_verification/detail_client_rfi/' . $project_id_enc . '/' . $discipline_enc . '/' . $type_of_module_enc . '/' . $module_enc . '/' . $report_enc . '/' . $report_no_rev_enc . '/' . 'null' . '/' . $drawing_no_enc . '/' . $enc_dec_el;
                      } else {
                        $link_more = base_url() . 'material_verification/detail_client_rfi/' . $project_id_enc . '/' . $discipline_enc . '/' . $type_of_module_enc . '/' . $module_enc . '/' . $report_enc . '/' . $report_no_rev_enc . '/' . 'null' . '/' . $drawing_no_enc;
                      }
                    }
                  ?>
                    <hr>
                    <table border="0">
                      <tr>
                        <td class="font-weight-bold">Drawing No</td>
                        <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                        <td><?= $value['drawing_no'] ?></td>
                      </tr>
                      <tr>
                        <td class="font-weight-bold">Piecemark</td>
                        <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                        <td><?= $piecemark['part_id'] ?></td>
                      </tr>
                      <tr>
                        <td class="font-weight-bold">Submission ID</td>
                        <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                        <td><?= $value['submission_id'] ?></td>
                      </tr>
                      <tr>
                        <td class="font-weight-bold">Report No.</td>
                        <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                        <td><?= $value['report_number'] ?></td>
                      </tr>
                      <tr>
                        <td class="font-weight-bold">Piecemark</td>
                        <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                        <td><?= $piecemark['part_id'] ?></td>
                      </tr>
                      <tr>
                        <td class="font-weight-bold">Status</td>
                        <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                        <td>
                          <?php if (@$value['status_inspection'] == "0") : ?>
                            <span class="badge badge-pill badge-primary">Ready to Submit RFI</span>
                          <?php elseif (@$value['status_inspection'] == 1) : ?>
                            <span class="badge badge-pill badge-info">SMOE QC RFI - Pending Approval</span>
                          <?php elseif (@$value['status_inspection'] == 2) : ?>
                            <span class="badge badge-pill badge-danger">SMOE QC RFI - Rejected</span>
                          <?php elseif (@$value['status_inspection'] == 3) : ?>
                            <span class="badge badge-pill badge-success">SMOE QC RFI - Approved</span>
                          <?php elseif (@$value['status_inspection'] == 4) : ?>
                            <span class="badge badge-pill badge-secondary">SMOE QC RFI - Pending</span>
                          <?php elseif (@$value['status_inspection'] == 5) : ?>
                            <span class="badge badge-pill bg-purple text-white">Client RFI - Pending Approval</span>
                          <?php elseif (@$value['status_inspection'] == 6) : ?>
                            <span class="badge badge-pill badge-danger">Client RFI - Rejected</span>
                          <?php elseif (@$value['status_inspection'] == 7) : ?>
                            <span class="badge badge-pill bg-teal text-white">Client RFI - Approved</span>
                          <?php elseif (@$value['status_inspection'] == 8) : ?>
                            <span class="badge badge-pill badge-warning">Request for Update</span>
                          <?php elseif (@$value['status_inspection'] == 9) : ?>
                            <span class="badge badge-pill bg-orange text-white">Client RFI - Accepted with Comment</span>
                          <?php elseif (@$value['status_inspection'] == 10) : ?>
                            <span class="badge badge-pill bg-orange text-white">Client RFI - Postponed</span>
                          <?php elseif (@$value['status_inspection'] == 11) : ?>
                            <span class="badge badge-pill bg-orange text-white">Client RFI - Re-Offer</span>
                          <?php elseif (@$value['status_inspection'] == 12) : ?>
                            <span class="badge badge-pill badge-dark">Void</span>
                          <?php else : ?>
                            <span class="badge badge-pill badge-dark">Not Ready</span>
                          <?php endif; ?>
                        </td>
                      </tr>
                      <tr>
                        <td class="font-weight-bold">Remarks</td>
                        <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                        <td><?= $value['rejected_remarks'] ?></td>
                      </tr>
                      <tr>
                        <td class="font-weight-bold">More Info</td>
                        <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                        <td><a target="_blank" href="<?= $link_more ?>">Go to Detail</a></td>
                      </tr>
                    </table>
                  <?php endforeach; ?>
                <?php endforeach; ?>
              </div>
              <div class="tab-pane fade" id="pills-fitup" role="tabpanel" aria-labelledby="pills-fitup-tab">
                <?php
                foreach ($fitup_list as $value) :
                  $report_number_fi_enc = strtr($this->encryption->encrypt($value['report_number']), '+=/', '.-~');
                  $project_enc = strtr($this->encryption->encrypt($value['project_code']), '+=/', '.-~');
                  $discipline_enc = strtr($this->encryption->encrypt($value['discipline']), '+=/', '.-~');
                  $type_of_module_enc = strtr($this->encryption->encrypt($value['type_of_module']), '+=/', '.-~');
                  $module_enc = strtr($this->encryption->encrypt($value['module']), '+=/', '.-~');
                  $company_id_enc = strtr($this->encryption->encrypt($joint['company_id']), '+=/', '.-~');
                  $status_inspection_enc = strtr($this->encryption->encrypt($value['status_inspection']), '+=/', '.-~');
                  $enc_dec_el = encrypt($joint['deck_elevation']);
                  $postpone_reoffer_no_enc = strtr($this->encryption->encrypt($value['postpone_reoffer_no']), '+=/', '.-~');
                  if (@$value['report_number'] ==  '' && @$value['submission_id'] ==  '') {
                    $link_more = base_url() . 'fitup/joint_list';
                  } elseif ($value['report_number'] == '') {
                    $link_more = base_url('fitup/joint_inspection_list/') . strtr($this->encryption->encrypt($value['submission_id']), '+=/', '.-~') . "/" . strtr($this->encryption->encrypt("xx"), '+=/', '.-~') . "/" . strtr($this->encryption->encrypt("xx"), '+=/', '.-~') . "/" . strtr($this->encryption->encrypt("search_data"), '+=/', '.-~');
                  } else {
                    if (in_array($value['project_code'], project_by_deck())) {
                      $link_more = base_url('fitup/client_inspection/') . $project_enc . '/' . $discipline_enc . '/' . $module_enc . '/' . $type_of_module_enc . '/' . $report_number_fi_enc . '/' . $company_id_enc . '/' . $status_inspection_enc . '/' . $enc_dec_el . '/' . $postpone_reoffer_no_enc;
                    } else {
                      $link_more = base_url('fitup/client_inspection/') . $project_enc . '/' . $discipline_enc . '/' . $module_enc . '/' . $type_of_module_enc . '/' . $report_number_fi_enc . '/' . $company_id_enc . '/' . $status_inspection_enc . '/' . $postpone_reoffer_no_enc;
                    }
                  }
                ?>
                  <hr>
                  <table border="0">
                    <tr>
                      <td class="font-weight-bold">Drawing No</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?= $value['drawing_no'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Submission ID</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?= $value['submission_id'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Report No.</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?= $value['report_number'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Joint No.</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?= $joint['joint_no'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Piecemark#1</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?= $joint['pos_1'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Piecemark#2</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?= $joint['pos_2'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Status</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td>
                        <?php if (@$value['status_inspection'] == "0") : ?>
                          <?php if (@$value['status_surveyor'] == 3) : ?>
                            <span class="badge badge-pill badge-primary">Ready to Submit RFI</span>
                          <?php else : ?>
                            <span class="badge badge-pill badge-dark"><?= $surveyor_status_list[$value['status_surveyor']]['description'] ?></span>
                          <?php endif; ?>
                        <?php elseif (@$value['status_inspection'] == 1) : ?>
                          <span class="badge badge-pill badge-info">SMOE QC RFI - Pending Approval</span>
                        <?php elseif (@$value['status_inspection'] == 2) : ?>
                          <span class="badge badge-pill badge-danger">SMOE QC RFI - Rejected</span>
                        <?php elseif (@$value['status_inspection'] == 3) : ?>
                          <span class="badge badge-pill badge-success">SMOE QC RFI - Approved</span>
                        <?php elseif (@$value['status_inspection'] == 4) : ?>
                          <span class="badge badge-pill badge-secondary">SMOE QC RFI - Pending</span>
                        <?php elseif (@$value['status_inspection'] == 5) : ?>
                          <span class="badge badge-pill bg-purple text-white">Client RFI - Pending Approval</span>
                        <?php elseif (@$value['status_inspection'] == 6) : ?>
                          <span class="badge badge-pill badge-danger">Client RFI - Rejected</span>
                        <?php elseif (@$value['status_inspection'] == 7) : ?>
                          <span class="badge badge-pill bg-teal text-white">Client RFI - Approved</span>
                        <?php elseif (@$value['status_inspection'] == 8) : ?>
                          <span class="badge badge-pill badge-warning">Request for Update</span>
                        <?php elseif (@$value['status_inspection'] == 9) : ?>
                          <span class="badge badge-pill bg-orange text-white">Client RFI - Accepted with Comment</span>
                        <?php elseif (@$value['status_inspection'] == 10) : ?>
                          <span class="badge badge-pill bg-orange text-white">Client RFI - Postponed</span>
                        <?php elseif (@$value['status_inspection'] == 11) : ?>
                          <span class="badge badge-pill bg-orange text-white">Client RFI - Re-Offer</span>
                        <?php elseif (@$value['status_inspection'] == 12) : ?>
                          <span class="badge badge-pill badge-dark">Void</span>
                        <?php else : ?>
                          <span class="badge badge-pill badge-dark">Not Ready</span>
                        <?php endif; ?>
                      </td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Remarks</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?= $value['rejected_remarks'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">More Info</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><a target="_blank" href="<?= $link_more ?>">Go to Detail</a></td>
                    </tr>
                  </table>
                <?php endforeach; ?>
              </div>
              <div class="tab-pane fade" id="pills-visual" role="tabpanel" aria-labelledby="pills-visual-tab">
                <?php
                foreach ($visual_list as $value) :
                  $enc_dec_el = $joint['deck_elevation'];
                  if (@$value['report_number'] ==  '' && @$value['submission_id'] ==  '') {
                    $link_more = base_url() . 'visual/visual_list';
                  } elseif ($value['report_number'] == '') {
                    $link_more = base_url('visual/detail_inspection/') . $value['submission_id'] . '/dc/' . $value['drawing_no'] . '/' . $value['postpone_reoffer_no'];
                  } else {
                    if (in_array($value['project_code'], project_by_deck())) {
                      $link_more = base_url('visual/detail_inspection/') . $value['report_number'] . '/client/' . $value['drawing_no'] . '/NULL/' . $value['postpone_reoffer_no'] . '/' . $enc_dec_el;
                    } else {
                      $link_more = base_url('visual/detail_inspection/') . $value['report_number'] . '/client/' . $value['drawing_no'] . '/NULL/' . $value['postpone_reoffer_no'];
                    }
                  }
                ?>
                  <hr>
                  <table border="0">
                    <tr>
                      <td class="font-weight-bold">Drawing No</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?= $value['drawing_no'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Submission ID</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?= $value['submission_id'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Report No.</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?= $value['report_number'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Joint No.</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?= $joint['joint_no'] ?><?= $value['revision_category'] ?><?= $value['revision'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Piecemark#1</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?= $joint['pos_1'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Piecemark#2</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?= $joint['pos_2'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Status</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td>
                        <?php if (@$value['status_inspection'] == "0") : ?>
                          <?php if (@$value['status_surveyor'] == 3) : ?>
                            <span class="badge badge-pill badge-primary">Ready to Submit RFI</span>
                          <?php else : ?>
                            <span class="badge badge-pill badge-dark"><?= $surveyor_status_list[$value['status_surveyor']]['description'] ?></span>
                          <?php endif; ?>
                        <?php elseif (@$value['status_inspection'] == 1) : ?>
                          <span class="badge badge-pill badge-info">SMOE QC RFI - Pending Approval</span>
                        <?php elseif (@$value['status_inspection'] == 2) : ?>
                          <span class="badge badge-pill badge-danger">SMOE QC RFI - Rejected</span>
                        <?php elseif (@$value['status_inspection'] == 3) : ?>
                          <span class="badge badge-pill badge-success">SMOE QC RFI - Approved</span>
                        <?php elseif (@$value['status_inspection'] == 4) : ?>
                          <span class="badge badge-pill badge-secondary">SMOE QC RFI - Pending</span>
                        <?php elseif (@$value['status_inspection'] == 5) : ?>
                          <span class="badge badge-pill bg-purple text-white">Client RFI - Pending Approval</span>
                        <?php elseif (@$value['status_inspection'] == 6) : ?>
                          <span class="badge badge-pill badge-danger">Client RFI - Rejected</span>
                        <?php elseif (@$value['status_inspection'] == 7) : ?>
                          <span class="badge badge-pill bg-teal text-white">Client RFI - Approved</span>
                        <?php elseif (@$value['status_inspection'] == 8) : ?>
                          <span class="badge badge-pill badge-warning">Request for Update</span>
                        <?php elseif (@$value['status_inspection'] == 9) : ?>
                          <span class="badge badge-pill bg-orange text-white">Client RFI - Accepted with Comment</span>
                        <?php elseif (@$value['status_inspection'] == 10) : ?>
                          <span class="badge badge-pill bg-orange text-white">Client RFI - Postponed</span>
                        <?php elseif (@$value['status_inspection'] == 11) : ?>
                          <span class="badge badge-pill bg-orange text-white">Client RFI - Re-Offer</span>
                        <?php elseif (@$value['status_inspection'] == 12) : ?>
                          <span class="badge badge-pill badge-dark">Void</span>
                        <?php else : ?>
                          <span class="badge badge-pill badge-dark">Not Ready</span>
                        <?php endif; ?>
                      </td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Remarks</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?= $value['rejected_remarks'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">More Info</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><a target="_blank" href="<?= $link_more ?>">Go to Detail</a></td>
                    </tr>
                  </table>
                <?php endforeach; ?>
              </div>
              <div class="tab-pane fade" id="pills-ndt" role="tabpanel" aria-labelledby="pills-ndt-tab">
                <?php
                foreach ($ndt_list_all as $value) :
                  $enc_uniq_id_report     = encrypt($value['submission_id']);
                  $link_more = site_url("ndt_live/ndt_detail_" . strtolower($ndt_type_list[$value['ndt_type']]['ndt_initial']) . "/" . $enc_uniq_id_report);
                  $initial_enc = encrypt($ndt_type[$value['ndt_type']]['ndt_initial']);

                  if ($value['submission_id'] == '') {
                    $link_more = site_url("ndt_live/joint_list/" . $initial_enc . '?drawing_no=' . $joint['drawing_no']);
                  }

                ?>
                  <hr>
                  <table border="0">
                    <tr>
                      <td class="font-weight-bold">NDT Type</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?= $ndt_type_list[$value['ndt_type']]['ndt_description'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Report No.</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?= $value['report_number'] ?></td>
                    </tr>
                    <!-- <tr>
                      <td class="font-weight-bold">RFI No.</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?= str_pad($value['visual_transmittal_no'], 4, "0", STR_PAD_LEFT); ?></td>
                    </tr> -->
                    <tr>
                      <td class="font-weight-bold">Joint No.</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?= $joint['joint_no'] ?><?= $value['revision_category'] ?><?= $value['revision'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Status</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td>
                        <?php
                        $status_list[0]             = [
                          'text'                    => "Submited",
                          'color'                   => "primary"
                        ];
                        $status_list[1]             = [
                          'text'                    => "Pending by QC (SEATRIUM)",
                          'color'                   => "warning"
                        ];
                        $status_list[2]             = [
                          'text'                    => "Rejected by QC (SEATRIUM)",
                          'color'                   => "danger"
                        ];
                        $status_list[3]             = [
                          'text'                    => "Approved by QC (SEATRIUM)",
                          'color'                   => "success"
                        ];
                        $status_list[13]             = [
                          'text'                    => "Pending by QC (SUBCONT)",
                          'color'                   => "warning"
                        ];
                        $status_list[14]             = [
                          'text'                    => "Rejected by QC (SUBCONT)",
                          'color'                   => "danger"
                        ];
                        $status_list[15]             = [
                          'text'                    => "Approved by QC (SUBCONT)",
                          'color'                   => "success"
                        ];
                        $status_list[4]             = [
                          'text'                    => "Pending by Client",
                          'color'                   => "warning"
                        ];
                        $status_list[5]             = [
                          'text'                    => "Pending by Client",
                          'color'                   => "warning"
                        ];
                        $status_list[6]             = [
                          'text'                    => "Rejected by Client",
                          'color'                   => "danger"
                        ];
                        $status_list[7]             = [
                          'text'                    => "Approved by Client",
                          'color'                   => "success"
                        ];
                        $status_list[8]             = [
                          'text'                    => "Re-Offer Client",
                          'color'                   => "warning"
                        ];
                        $status_list[9]             = [
                          'text'                    => "Not Active",
                          'color'                   => "secondary"
                        ];
                        $status_list[12]             = [
                          'text'                    => "Void",
                          'color'                   => "dark"
                        ];

                        if ($value['submission_id'] == '') {
                          $status_list[0]             = [
                            'text'                    => "Pending Vendor Submission",
                            'color'                   => "primary"
                          ];
                        }

                        ?>
                        <span class="badge badge-pill badge-<?= $status_list[$value['status_inspection']]['color'] ?>"><?= $status_list[$value['status_inspection']]['text'] ?></span>
                      </td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">More Info</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><a target="_blank" href="<?= $link_more ?>">Go to Detail</a></td>
                    </tr>
                  </table>
                <?php endforeach; ?>

                <?php
                foreach ($ndt_list_atc as $value) :
                  $enc_uniq_id_report     = encrypt($value['submission_id']);
                  $initial_enc = encrypt($ndt_type[$value['ndt_type']]['ndt_initial']);
                  $initial = $ndt_type[$value['ndt_type']]['ndt_initial'];
                  $link_more = site_url("ndt_live/ndt_detail_atc" . "/" . $enc_uniq_id_report . '/' . $ndt_arr[$initial]);

                  if ($value['submission_id'] == '') {
                    $link_more = site_url("ndt_live/joint_list/" . $initial_enc . '?drawing_no=' . $joint['drawing_no']);
                  }

                ?>
                  <hr>
                  <table border="0">
                    <tr>
                      <td class="font-weight-bold">NDT Type</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?= $ndt_type_list[$value['ndt_type']]['ndt_description'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Report No.</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?= $value['report_number'] ?></td>
                    </tr>
                    <!-- <tr>
                      <td class="font-weight-bold">RFI No.</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?= str_pad($value['visual_transmittal_no'], 4, "0", STR_PAD_LEFT); ?></td>
                    </tr> -->
                    <tr>
                      <td class="font-weight-bold">Joint No.</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?= $joint['joint_no'] ?><?= $value['revision_category'] ?><?= $value['revision'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Status</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td>
                        <?php
                        $status_list[0]             = [
                          'text'                    => "Submited",
                          'color'                   => "primary"
                        ];
                        $status_list[1]             = [
                          'text'                    => "Pending by QC (SEATRIUM)",
                          'color'                   => "warning"
                        ];
                        $status_list[2]             = [
                          'text'                    => "Rejected by QC (SEATRIUM)",
                          'color'                   => "danger"
                        ];
                        $status_list[3]             = [
                          'text'                    => "Approved by QC (SEATRIUM)",
                          'color'                   => "success"
                        ];
                        $status_list[13]             = [
                          'text'                    => "Pending by QC (SUBCONT)",
                          'color'                   => "warning"
                        ];
                        $status_list[14]             = [
                          'text'                    => "Rejected by QC (SUBCONT)",
                          'color'                   => "danger"
                        ];
                        $status_list[15]             = [
                          'text'                    => "Approved by QC (SUBCONT)",
                          'color'                   => "success"
                        ];
                        $status_list[4]             = [
                          'text'                    => "Pending by Client",
                          'color'                   => "warning"
                        ];
                        $status_list[5]             = [
                          'text'                    => "Pending by Client",
                          'color'                   => "warning"
                        ];
                        $status_list[6]             = [
                          'text'                    => "Rejected by Client",
                          'color'                   => "danger"
                        ];
                        $status_list[7]             = [
                          'text'                    => "Approved by Client",
                          'color'                   => "success"
                        ];
                        $status_list[8]             = [
                          'text'                    => "Re-Offer Client",
                          'color'                   => "warning"
                        ];
                        $status_list[9]             = [
                          'text'                    => "Not Active",
                          'color'                   => "secondary"
                        ];
                        $status_list[12]             = [
                          'text'                    => "Void",
                          'color'                   => "dark"
                        ];

                        if ($value['submission_id'] == '') {
                          $status_list[0]             = [
                            'text'                    => "Pending Vendor Submission",
                            'color'                   => "primary"
                          ];
                        }

                        ?>
                        <span class="badge badge-pill badge-<?= $status_list[$value['status_inspection']]['color'] ?>"><?= $status_list[$value['status_inspection']]['text'] ?></span>
                      </td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">More Info</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><a target="_blank" href="<?= $link_more ?>">Go to Detail</a></td>
                    </tr>
                  </table>
                <?php endforeach; ?>
              </div>
              <div class="tab-pane fade" id="pills-bondstrand" role="tabpanel" aria-labelledby="pills-bondstrand-tab">
                <?php
                foreach ($bondstrand_list as $value) :
                  $report_number_fi_enc = strtr($this->encryption->encrypt($value['report_number']), '+=/', '.-~');
                  $project_enc = strtr($this->encryption->encrypt($value['project_code']), '+=/', '.-~');
                  $discipline_enc = strtr($this->encryption->encrypt($value['discipline']), '+=/', '.-~');
                  $type_of_module_enc = strtr($this->encryption->encrypt($value['type_of_module']), '+=/', '.-~');
                  $module_enc = strtr($this->encryption->encrypt($value['module']), '+=/', '.-~');
                  $company_id_enc = strtr($this->encryption->encrypt($company_workpack_list[$value['id_workpack']]), '+=/', '.-~');
                  $status_inspection_enc = strtr($this->encryption->encrypt($value['status_inspection']), '+=/', '.-~');
                  if (@$value['report_number'] ==  '' && @$value['submission_id'] ==  '') {
                    $link_more = base_url() . 'bondstrand/joint_list';
                  } elseif ($value['report_number'] == '') {
                    $link_more = base_url('bondstrand/detail_inspection_list/') . strtr($this->encryption->encrypt($value['submission_id']), '+=/', '.-~') . "/" . strtr($this->encryption->encrypt("submission"), '+=/', '.-~') . "/submission/" . strtr($this->encryption->encrypt($value['revision_status_inspection']), '+=/', '.-~');
                  } else {
                    $link_more = base_url('bondstrand/detail_summary_list/') . $value['report_number'];
                  }
                ?>
                  <hr>
                  <table border="0">
                    <tr>
                      <td class="font-weight-bold">Drawing No</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?= $value['drawing_no'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Submission ID</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?= $value['submission_id'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Report No.</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?= $value['report_number'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Joint No.</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?= $joint['joint_no'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Piecemark#1</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?= $joint['pos_1'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Piecemark#2</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?= $joint['pos_2'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Status</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td>
                        <?php if (@$value['status_inspection'] == "0") : ?>
                          <?php if (@$value['status_surveyor'] == 3) : ?>
                            <span class="badge badge-pill badge-primary">Ready to Submit RFI</span>
                          <?php else : ?>
                            <span class="badge badge-pill badge-dark"><?= $surveyor_status_list[$value['status_surveyor']]['description'] ?></span>
                          <?php endif; ?>
                        <?php elseif (@$value['status_inspection'] == 1) : ?>
                          <span class="badge badge-pill badge-info">SMOE QC RFI - Pending Approval</span>
                        <?php elseif (@$value['status_inspection'] == 2) : ?>
                          <span class="badge badge-pill badge-danger">SMOE QC RFI - Rejected</span>
                        <?php elseif (@$value['status_inspection'] == 3) : ?>
                          <span class="badge badge-pill badge-success">SMOE QC RFI - Approved</span>
                        <?php elseif (@$value['status_inspection'] == 4) : ?>
                          <span class="badge badge-pill badge-secondary">SMOE QC RFI - Pending</span>
                        <?php elseif (@$value['status_inspection'] == 5) : ?>
                          <span class="badge badge-pill bg-purple text-white">Client RFI - Pending Approval</span>
                        <?php elseif (@$value['status_inspection'] == 6) : ?>
                          <span class="badge badge-pill badge-danger">Client RFI - Rejected</span>
                        <?php elseif (@$value['status_inspection'] == 7) : ?>
                          <span class="badge badge-pill bg-teal text-white">Client RFI - Approved</span>
                        <?php elseif (@$value['status_inspection'] == 8) : ?>
                          <span class="badge badge-pill badge-warning">Request for Update</span>
                        <?php elseif (@$value['status_inspection'] == 9) : ?>
                          <span class="badge badge-pill bg-orange text-white">Client RFI - Accepted with Comment</span>
                        <?php elseif (@$value['status_inspection'] == 10) : ?>
                          <span class="badge badge-pill bg-orange text-white">Client RFI - Postponed</span>
                        <?php elseif (@$value['status_inspection'] == 11) : ?>
                          <span class="badge badge-pill bg-orange text-white">Client RFI - Re-Offer</span>
                        <?php elseif (@$value['status_inspection'] == 12) : ?>
                          <span class="badge badge-pill badge-dark">Void</span>
                        <?php else : ?>
                          <span class="badge badge-pill badge-dark">Not Ready</span>
                        <?php endif; ?>
                      </td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Remarks</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?= $value['rejected_remarks'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">More Info</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><a target="_blank" href="<?= $link_more ?>">Go to Detail</a></td>
                    </tr>
                  </table>
                <?php endforeach; ?>
              </div>
              <div class="tab-pane fade" id="pills-irn" role="tabpanel" aria-labelledby="pills-irn-tab">
                <?php
                foreach ($irn_list as $value) :
                  $link_more = base_url() . 'irn/show_irn_detail/' . strtr($this->encryption->encrypt($value['submission_id']), '+=/', '.-~') . '/' . strtr($this->encryption->encrypt($value['report_number']), '+=/', '.-~');
                ?>
                  <hr>
                  <table border="0">
                    <tr>
                      <td class="font-weight-bold">Submission ID</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td>Draft-<?= $value['submission_id'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Report No.</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?= $value['report_number'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Status</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td>
                        <?php if (@$value['status_inspection'] == "0") : ?>
                          <span class="badge badge-pill badge-primary">Draft</span>
                        <?php elseif (@$value['status_inspection'] == 1) : ?>
                          <span class="badge badge-pill badge-info">SMOE QC RFI - Pending Approval</span>
                        <?php elseif (@$value['status_inspection'] == 2) : ?>
                          <span class="badge badge-pill badge-danger">SMOE QC RFI - Rejected</span>
                        <?php elseif (@$value['status_inspection'] == 3) : ?>
                          <span class="badge badge-pill badge-success">SMOE QC RFI - Approved</span>
                        <?php elseif (@$value['status_inspection'] == 4) : ?>
                          <span class="badge badge-pill badge-secondary">SMOE QC RFI - Pending</span>
                        <?php elseif (@$value['status_inspection'] == 5) : ?>
                          <span class="badge badge-pill bg-purple text-white">Client RFI - Pending Approval</span>
                        <?php elseif (@$value['status_inspection'] == 6) : ?>
                          <span class="badge badge-pill badge-danger">Client RFI - Rejected</span>
                        <?php elseif (@$value['status_inspection'] == 7) : ?>
                          <span class="badge badge-pill bg-teal text-white">Client RFI - Approved</span>
                        <?php elseif (@$value['status_inspection'] == 8) : ?>
                          <span class="badge badge-pill badge-warning">Request for Update</span>
                        <?php elseif (@$value['status_inspection'] == 9) : ?>
                          <span class="badge badge-pill bg-orange text-white">Client RFI - Accepted with Comment</span>
                        <?php elseif (@$value['status_inspection'] == 10) : ?>
                          <span class="badge badge-pill bg-orange text-white">Client RFI - Postponed</span>
                        <?php elseif (@$value['status_inspection'] == 11) : ?>
                          <span class="badge badge-pill bg-orange text-white">Client RFI - Re-Offer</span>
                        <?php elseif (@$value['status_inspection'] == 12) : ?>
                          <span class="badge badge-pill badge-dark">Void</span>
                        <?php else : ?>
                          <span class="badge badge-pill badge-dark">Not Ready</span>
                        <?php endif; ?>
                      </td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">More Info</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><a target="_blank" href="<?= $link_more ?>">Go to Detail</a></td>
                    </tr>
                  </table>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </div>
      <?php elseif (@$get['joint_no'] != '') : ?>
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0">Results</h6>
          </div>
          <div class="card-body bg-white overflow-auto">
            Joint Not Found
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

</div><!-- ini div dari sidebar yang class wrapper -->

<div class="modal fade" id="history_log" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">History Log</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function autopiecemark(input) {
    $("input[name=joint_no]").autocomplete({
      source: function(request, response) {
        var drawing_wm = $('input[name=drawing_wm]').val()
        var spool_no = $('input[name=spool_no]').val()
        $.ajax({
          url: "<?php echo base_url() ?>engineering/autocomplete_joint",
          type: "post",
          dataType: "json",
          data: {
            term: request.term,
            drawing_wm: drawing_wm,
            spool_no: spool_no,
          },
          success: function(data) {
            response(data);
          }
        });
      }
    });
  }

  $(".autocomplete_doc, .autocomplete_wm").autocomplete({
    source: function(request, response) {
      var project_id = $("#project_id option:selected").val();
      var drawing_type;
      if ($(this.element).hasClass("autocomplete_doc")) {
        drawing_type = 1; //ga or as
      } else if ($(this.element).hasClass("autocomplete_wm")) {
        drawing_type = 2;
      }
      $.ajax({
        url: "<?php echo base_url() ?>engineering/autocomplete_drawing",
        dataType: "json",
        data: {
          term: request.term,
          drawing_type: drawing_type,
          project_id: project_id,
        },
        success: function(data) {
          response(data);
        }
      });
    }
  });

  $(".autocomplete_spool_no").autocomplete({
    source: function(request, response) {
      $.ajax({
        url: "<?php echo base_url() ?>engineering/autocomplete_spool_no",
        dataType: "json",
        data: {
          term: request.term,
        },
        success: function(data) {
          response(data);
        }
      });
    }
  });

  function open_history_log(id) {
    $('#history_log').modal('show');
    $('#history_log .modal-body').html('<div class="text-center"><div class="spinner-border text-success" role="status"><span class="sr-only">Loading...</span></div></div>');
    $.ajax({
      url: "<?php echo base_url() ?>engineering/get_table_history_log",
      type: "POST",
      data: {
        id_template: id,
        module: 2,
      },
      success: function(data) {
        $('#history_log .modal-body').html(data);
      }
    });
  }

  function search_piecemark(input) {
    // if($(input).val() != ''){
    //   $(input).closest('form').submit();
    // }
  }
</script>

<script>
  function return_joint_overall(btn) {
    var id_fitup = $(btn).data("id_fitup");
    var id_visual = $(btn).data("id_visual");
    var joint_no = $(btn).data("id_joint");
    var type_fabrication = $(btn).data("fabrication");
    var status_inspection = $(btn).data("status_inspection");

    $.ajax({
      url: "<?php echo base_url() ?>engineering/delete_joint_overall_reset_progress",
      data: {
        id_fitup: id_fitup,
        id_visual: id_visual,
        id_joint: joint_no,
        type_fabrication: type_fabrication,
        status_inspection: status_inspection,
      },
      type: 'post',
      success: function(data) {
        if (data.includes('Error')) {
          sweetalert("error", data);
        } else {
          sweetalert("success", "Joint is void!");

          setTimeout(() => {
            location.reload()
          }, 1000);
        }
      },
      error: function(xhr, status, error) {
        sweetalert("error", "An error occurred: " + error);
      }
    });
  }
</script>