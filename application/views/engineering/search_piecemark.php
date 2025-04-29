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
                    <input type='text' name="part_id" class="form-control autopiecemark" onfocus="autopiecemark(this);" onblur="search_piecemark(this);" placeholder="Type Piecemark" value="<?php echo @$get['part_id'] ?>" required>
                  </div>
                  <div class="col-md-auto">
                  <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-search"></i> Search</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <?php if(@$piecemark['part_id'] != ''): ?>
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0"><?php echo $piecemark['part_id'] ?></h6>
          </div>
          <div class="card-body bg-white overflow-auto">
            <div class="row">
              <div class="col-md">
                <table border="0">
                  <tr>
                    <td class="font-weight-bold">Drawing GA</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo $piecemark['drawing_ga'] ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Drawing AS</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo $piecemark['drawing_as'] ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Drawing SP</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo $piecemark['drawing_sp'] ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Drawing CP</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo $piecemark['drawing_cp'] ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Drawing CL</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo $piecemark['drawing_cl'] ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Part ID</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo $piecemark['part_id'] ?></td>
                  </tr>
                  <!-- Additional -->
                  <tr>
                    <td class="font-weight-bold">Project</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo $project_list[$piecemark['project']]['project_name'] ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Discipline</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo $discipline_list[$piecemark['discipline']]['discipline_name'] ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Module</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo $module_list[$piecemark['module']]['mod_desc'] ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Type of Module</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo $type_of_module_list[$piecemark['type_of_module']]['name'] ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Company</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo $company_list[$piecemark['company_id']]['company_name'] ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Status Internal</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo $piecemark['status_internal'] == 0 ? 'External' : 'Internal'  ?></td>
                  </tr>
                  <!-- end -->
                  <tr>
                    <td class="font-weight-bold">Deck Elevation / Service Line </td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo $deck_elevation_list[$piecemark['deck_elevation']]['code'] ?> - <?php echo $deck_elevation_list[$piecemark['deck_elevation']]['name'] ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Desc Assy.</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo $desc_assy_list[$piecemark['description_assy']]['code'] ?> - <?php echo $desc_assy_list[$piecemark['description_assy']]['name'] ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">Is ITR</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><?php echo ($piecemark['is_itr'] == '1' ? 'Yes' : 'No') ?></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">History Revision</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><a href="#" onclick="open_history_log(<?php echo $piecemark['id'] ?>)">Open History</a></td>
                  </tr>
                  <tr>
                    <td class="font-weight-bold">More Info</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td><a target="_blank" href="<?= base_url() ?>engineering/piecemark_list?status=<?= ($piecemark['workpack_id'] == '' ? 'outstanding' : 'submitted') ?>&submit=search&drawing_ga=<?= $piecemark['drawing_ga'] ?>&drawing_as=<?= $piecemark['drawing_as'] ?>">Go to Detail</a></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>
    <div class="col-md">
      <?php if(@$piecemark['part_id'] != ''): ?>
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0">Results</h6>
          </div>
          <div class="card-body bg-white overflow-auto">
            <ul class="nav nav-pills nav-fill" id="pills-tab" role="tablist">
              <li class="nav-item" role="presentation">
                <a class="rounded-0 nav-link active" id="pills-joint-tab" data-toggle="pill" href="#pills-joint" role="tab" aria-controls="pills-joint" aria-selected="true">
                  Joint
                  <?php
                    echo "&nbsp;";
                    if(count($joint_list) > 0){
                      echo "<span class='badge badge-dark badge-pill'>".count($joint_list)."</span>";
                    }
                    else{
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
                    if(count($workpack_list) > 0){
                      echo "<span class='badge badge-dark badge-pill'>".count($workpack_list)."</span>";
                    }
                    else{
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
                    if(count($material_list) > 0){
                      echo "<span class='badge badge-dark badge-pill'>".count($material_list)."</span>";
                    }
                    else{
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
                    $num = 0;
                    foreach ($joint_list as $joint) {
                      $num += count($fitup_list[$joint['id']]);
                    }
                    if($num > 0){
                      echo "<span class='badge badge-dark badge-pill'>".$num."</span>";
                    }
                    else{
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
                    $num = 0;
                    foreach ($joint_list as $joint) {
                      $num += count($visual_list[$joint['id']]);
                    }
                    if($num > 0){
                      echo "<span class='badge badge-dark badge-pill'>".$num."</span>";
                    }
                    else{
                      echo "<span class='badge badge-light badge-pill'>0</span>";
                    }
                  ?>
                </a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="rounded-0 nav-link" id="pills-itr-tab" data-toggle="pill" href="#pills-itr" role="tab" aria-controls="pills-itr" aria-selected="false">
                  ITR
                  <?php
                    echo "&nbsp;";
                    if(count($itr_list) > 0){
                      echo "<span class='badge badge-dark badge-pill'>".count($itr_list)."</span>";
                    }
                    else{
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
                    $num = 0;
                    foreach ($joint_list as $joint) {
                      $num += count($bondstrand_list[$joint['id']]);
                    }
                    if($num > 0){
                      echo "<span class='badge badge-dark badge-pill'>".$num."</span>";
                    }
                    else{
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
                    if(count($irn_list) > 0){
                      echo "<span class='badge badge-dark badge-pill'>".count($irn_list)."</span>";
                    }
                    else{
                      echo "<span class='badge badge-light badge-pill'>0</span>";
                    }
                  ?>
                </a>
              </li>
            </ul>
            <div class="tab-content overflow-auto" id="pills-tabContent" style="max-height: 60vh;">
              <div class="tab-pane fade show active" id="pills-joint" role="tabpanel" aria-labelledby="pills-joint-tab">
                <?php foreach ($joint_list as $key => $value): ?>
                  <hr>
                  <table border="0">
                    <tr>
                      <td class="font-weight-bold">Drawing No.</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?= $value['drawing_no'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Drawing WM</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?= $value['drawing_wm'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Joint No.</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?= $value['joint_no'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Piecemark#1</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?= $value['pos_1'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Piecemark#2</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><?= $value['pos_2'] ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Search</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><a target="_blank" href="<?= base_url() ?>engineering/search_joint?drawing_wm=<?= $value['drawing_wm'] ?>&joint_no=<?= $value['joint_no'] ?>">Go to Search Joint</a></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">More Info</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td><a target="_blank" href="<?= base_url() ?>engineering/joint_list?status=<?= ($value['workpack_id'] == '' ? 'outstanding' : 'submitted') ?>&submit=search&drawing_no=<?= $value['drawing_no'] ?>">Go to Detail</a></td>
                    </tr>
                  </table>
                <?php endforeach; ?>
              </div>
              <div class="tab-pane fade" id="pills-workpack" role="tabpanel" aria-labelledby="pills-workpack-tab">
                <?php foreach ($workpack_list as $key => $value): ?>
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
                      <td class="font-weight-bold">Progress</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td>
                        <?php 
                          if($value[0]['phase'] == 'PF'){
                            echo $value[1]['progress_mv'].'%';
                          }
                          elseif($value[0]['phase'] == 'ITR'){
                            echo $value[1]['progress_itr'].'%';
                          }
                        ?>
                      </td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Status</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td>
                        <?php if($value[1]['status'] == 3): ?>
                          <span class="badge badge-danger">Returned</span>
                        <?php elseif($value[1]['status'] == 4): ?>
                          <span class="badge badge-dark">Void</span>
                        <?php elseif($value[0]['phase'] == 'PF' && $value[1]['progress_mv'] == 100): ?>
                          <span class="badge badge-success">Complete</span>
                        <?php elseif($value[0]['phase'] == 'ITR' && $value[1]['progress_itr'] == 100): ?>
                          <span class="badge badge-success">Complete</span>
                        <?php elseif($value[0]['status'] == 0): ?>
                          <span class="badge badge-dark">Not Issued</span>
                        <?php else: ?>
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
                <?php 
                  foreach ($material_list as $key => $value): 
                    $report_enc = strtr($this->encryption->encrypt(@$value['report_number']), '+=/', '.-~');
                    $project_id_enc = strtr($this->encryption->encrypt(@$value['project_code']), '+=/', '.-~');
                    $discipline_enc = strtr($this->encryption->encrypt(@$value['discipline']), '+=/', '.-~');
                    $type_of_module_enc = strtr($this->encryption->encrypt(@$value['type_of_module']), '+=/', '.-~');
                    $module_enc = strtr($this->encryption->encrypt(@$value['module']), '+=/', '.-~');
                    $report_no_rev_enc = strtr($this->encryption->encrypt(@$value['report_no_rev']), '+=/', '.-~');
                    $submission_id_enc = strtr($this->encryption->encrypt(@$value['submission_id']), '+=/', '.-~');
                    $drawing_no_enc = strtr($this->encryption->encrypt(@$value['drawing_no']), '+=/', '.-~');
                    $deck_enc = encrypt($piecemark['deck_elevation']);

                    if(@$value['report_number'] ==  '' && @$value['submission_id'] ==  ''){
                      $link_more = base_url().'material_verification/production_rfi/';
                    }
                    elseif(@$value['report_number'] ==  ''){
                      $link_more = base_url().'material_verification/detail_inspection_rfi/'.$submission_id_enc;
                    }
                    else{

                      if(in_array($value['project_code'], project_by_deck())) {
                        $link_more = base_url().'material_verification/detail_client_rfi/'.$project_id_enc.'/'.$discipline_enc.'/'.$type_of_module_enc.'/'.$module_enc.'/'.$report_enc.'/'.$report_no_rev_enc.'/'.'null'.'/'.$drawing_no_enc.'/'.$deck_enc;

                      } else {
                        $link_more = base_url().'material_verification/detail_client_rfi/'.$project_id_enc.'/'.$discipline_enc.'/'.$type_of_module_enc.'/'.$module_enc.'/'.$report_enc.'/'.$report_no_rev_enc.'/'.'null'.'/'.$drawing_no_enc;
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
                      <td class="font-weight-bold">Status</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td>
                      <?php if(@$value['status_inspection'] == "0"): ?>
                        <span class="badge badge-pill badge-primary">Ready to Submit RFI</span>
                      <?php elseif(@$value['status_inspection'] == 1): ?>
                        <span class="badge badge-pill badge-info">SMOE QC RFI - Pending Approval</span>
                      <?php elseif(@$value['status_inspection'] == 2): ?>
                        <span class="badge badge-pill badge-danger">SMOE QC RFI - Rejected</span>
                      <?php elseif(@$value['status_inspection'] == 3): ?>
                        <span class="badge badge-pill badge-success">SMOE QC RFI - Approved</span>
                      <?php elseif(@$value['status_inspection'] == 4): ?>
                        <span class="badge badge-pill badge-secondary">SMOE QC RFI - Pending</span>
                      <?php elseif(@$value['status_inspection'] == 5): ?>
                        <span class="badge badge-pill bg-purple text-white">Client RFI - Pending Approval</span>
                      <?php elseif(@$value['status_inspection'] == 6): ?>
                        <span class="badge badge-pill badge-danger">Client RFI - Rejected</span>
                      <?php elseif(@$value['status_inspection'] == 7): ?>
                        <span class="badge badge-pill bg-teal text-white">Client RFI - Approved</span>
                      <?php elseif(@$value['status_inspection'] == 8): ?>
                        <span class="badge badge-pill badge-warning">Request for Update</span>
                      <?php elseif(@$value['status_inspection'] == 9): ?>
                        <span class="badge badge-pill bg-orange text-white">Client RFI - Accepted with Comment</span>
                      <?php elseif(@$value['status_inspection'] == 10): ?>
                        <span class="badge badge-pill bg-orange text-white">Client RFI - Postponed</span>
                      <?php elseif(@$value['status_inspection'] == 11): ?>
                        <span class="badge badge-pill bg-orange text-white">Client RFI - Re-Offer</span>
                      <?php elseif(@$value['status_inspection'] == 12): ?>
                        <span class="badge badge-pill badge-dark">Void</span>
                      <?php else: ?>
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
              <div class="tab-pane fade" id="pills-fitup" role="tabpanel" aria-labelledby="pills-fitup-tab">
                <?php foreach ($joint_list as $joint): ?>
                  <?php 
                    foreach ($fitup_list[$joint['id']] as $value): 
                      $report_number_fi_enc = strtr($this->encryption->encrypt($value['report_number']), '+=/', '.-~');
                      $project_enc = strtr($this->encryption->encrypt($value['project_code']), '+=/', '.-~');
                      $discipline_enc = strtr($this->encryption->encrypt($value['discipline']), '+=/', '.-~');
                      $type_of_module_enc = strtr($this->encryption->encrypt($value['type_of_module']), '+=/', '.-~');
                      $module_enc = strtr($this->encryption->encrypt($value['module']), '+=/', '.-~');
                      $company_id_enc = strtr($this->encryption->encrypt($company_workpack_list[$value['id_workpack']]), '+=/', '.-~');
                      $deck_enc   = encrypt($joint['deck_elevation']);
                      $enc_status = encrypt($value['status_inspection']);
                      if(@$value['report_number'] ==  '' && @$value['submission_id'] ==  ''){
                        $link_more = base_url().'fitup/joint_list';
                      }
                      elseif($value['report_number'] == ''){
                        $link_more = base_url('fitup/joint_inspection_list/').strtr($this->encryption->encrypt($value['submission_id']), '+=/', '.-~');
                      }
                      else{
                        if(in_array($value['project_code'], project_by_deck())) {
                          $link_more = base_url('fitup/client_inspection/').$project_enc.'/'.$discipline_enc.'/'.$module_enc.'/'.$type_of_module_enc.'/'.$report_number_fi_enc.'/'.$company_id_enc.'/'.encrypt(null).'/'.$deck_enc;

                        } else {
                          $link_more = base_url('fitup/client_inspection/').$project_enc.'/'.$discipline_enc.'/'.$module_enc.'/'.$type_of_module_enc.'/'.$report_number_fi_enc.'/'.$company_id_enc;
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
                        <?php if(@$value['status_inspection'] == "0"): ?>
                          <span class="badge badge-pill badge-primary">Ready to Submit RFI</span>
                        <?php elseif(@$value['status_inspection'] == 1): ?>
                          <span class="badge badge-pill badge-info">SMOE QC RFI - Pending Approval</span>
                        <?php elseif(@$value['status_inspection'] == 2): ?>
                          <span class="badge badge-pill badge-danger">SMOE QC RFI - Rejected</span>
                        <?php elseif(@$value['status_inspection'] == 3): ?>
                          <span class="badge badge-pill badge-success">SMOE QC RFI - Approved</span>
                        <?php elseif(@$value['status_inspection'] == 4): ?>
                          <span class="badge badge-pill badge-secondary">SMOE QC RFI - Pending</span>
                        <?php elseif(@$value['status_inspection'] == 5): ?>
                          <span class="badge badge-pill bg-purple text-white">Client RFI - Pending Approval</span>
                        <?php elseif(@$value['status_inspection'] == 6): ?>
                          <span class="badge badge-pill badge-danger">Client RFI - Rejected</span>
                        <?php elseif(@$value['status_inspection'] == 7): ?>
                          <span class="badge badge-pill bg-teal text-white">Client RFI - Approved</span>
                        <?php elseif(@$value['status_inspection'] == 8): ?>
                          <span class="badge badge-pill badge-warning">Request for Update</span>
                        <?php elseif(@$value['status_inspection'] == 9): ?>
                          <span class="badge badge-pill bg-orange text-white">Client RFI - Accepted with Comment</span>
                        <?php elseif(@$value['status_inspection'] == 10): ?>
                          <span class="badge badge-pill bg-orange text-white">Client RFI - Postponed</span>
                        <?php elseif(@$value['status_inspection'] == 11): ?>
                          <span class="badge badge-pill bg-orange text-white">Client RFI - Re-Offer</span>
                        <?php elseif(@$value['status_inspection'] == 12): ?>
                          <span class="badge badge-pill badge-dark">Void</span>
                        <?php else: ?>
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
                <?php endforeach; ?>
              </div>
              <div class="tab-pane fade" id="pills-visual" role="tabpanel" aria-labelledby="pills-visual-tab">
                <?php foreach ($joint_list as $joint): ?>
                  <?php 
                    foreach ($visual_list[$joint['id']] as $value): 
                      $deck_el_enc = $joint['deck_elevation'];
                      if(@$value['report_number'] ==  '' && @$value['submission_id'] ==  ''){
                        $link_more = base_url().'visual/visual_list';
                      }

                      elseif($value['report_number'] == ''){
                        $link_more = base_url('visual/detail_inspection/').$value['submission_id'].'/dc/'.$value['drawing_no'].'/'.$value['postpone_reoffer_no'];
                      }
                      else{
                        if(in_array($value['project_code'], project_by_deck())) {
                          $link_more = base_url('visual/detail_inspection/').$value['report_number'].'/client/'.$value['drawing_no'].'/NULL/'.$value['postpone_reoffer_no'].'/'.$deck_el_enc;

                        } else {
                          $link_more = base_url('visual/detail_inspection/').$value['report_number'].'/client/'.$value['drawing_no'].'/NULL/'.$value['postpone_reoffer_no'];
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
                        <?php if(@$value['status_inspection'] == "0"): ?>
                          <span class="badge badge-pill badge-primary">Ready to Submit RFI</span>
                        <?php elseif(@$value['status_inspection'] == 1): ?>
                          <span class="badge badge-pill badge-info">SMOE QC RFI - Pending Approval</span>
                        <?php elseif(@$value['status_inspection'] == 2): ?>
                          <span class="badge badge-pill badge-danger">SMOE QC RFI - Rejected</span>
                        <?php elseif(@$value['status_inspection'] == 3): ?>
                          <span class="badge badge-pill badge-success">SMOE QC RFI - Approved</span>
                        <?php elseif(@$value['status_inspection'] == 4): ?>
                          <span class="badge badge-pill badge-secondary">SMOE QC RFI - Pending</span>
                        <?php elseif(@$value['status_inspection'] == 5): ?>
                          <span class="badge badge-pill bg-purple text-white">Client RFI - Pending Approval</span>
                        <?php elseif(@$value['status_inspection'] == 6): ?>
                          <span class="badge badge-pill badge-danger">Client RFI - Rejected</span>
                        <?php elseif(@$value['status_inspection'] == 7): ?>
                          <span class="badge badge-pill bg-teal text-white">Client RFI - Approved</span>
                        <?php elseif(@$value['status_inspection'] == 8): ?>
                          <span class="badge badge-pill badge-warning">Request for Update</span>
                        <?php elseif(@$value['status_inspection'] == 9): ?>
                          <span class="badge badge-pill bg-orange text-white">Client RFI - Accepted with Comment</span>
                        <?php elseif(@$value['status_inspection'] == 10): ?>
                          <span class="badge badge-pill bg-orange text-white">Client RFI - Postponed</span>
                        <?php elseif(@$value['status_inspection'] == 11): ?>
                          <span class="badge badge-pill bg-orange text-white">Client RFI - Re-Offer</span>
                        <?php elseif(@$value['status_inspection'] == 12): ?>
                          <span class="badge badge-pill badge-dark">Void</span>
                        <?php else: ?>
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
                <?php endforeach; ?>
              </div>
              <div class="tab-pane fade" id="pills-itr" role="tabpanel" aria-labelledby="pills-itr-tab">
                <?php 
                  foreach ($itr_list as $key => $value): 
                    $report_enc = strtr($this->encryption->encrypt(@$value['report_number']), '+=/', '.-~');
                    $project_id_enc = strtr($this->encryption->encrypt(@$value['project_code']), '+=/', '.-~');
                    $discipline_enc = strtr($this->encryption->encrypt(@$value['discipline']), '+=/', '.-~');
                    $type_of_module_enc = strtr($this->encryption->encrypt(@$value['type_of_module']), '+=/', '.-~');
                    $module_enc = strtr($this->encryption->encrypt(@$value['module']), '+=/', '.-~');
                    $report_no_rev_enc = strtr($this->encryption->encrypt(@$value['report_no_rev']), '+=/', '.-~');
                    $submission_id_enc = strtr($this->encryption->encrypt(@$value['submission_id']), '+=/', '.-~');
                    $drawing_no_enc = strtr($this->encryption->encrypt(@$value['drawing_no']), '+=/', '.-~');
                    if(@$value['report_number'] ==  ''){
                      $link_more = base_url().'itr/detail_inspection_list/'.$submission_id_enc;
                    }
                    else{
                      $link_more = base_url().'itr/detail_itr_summary/'.$project_id_enc.'/'.$discipline_enc.'/'.$type_of_module_enc.'/'.$module_enc.'/'.$report_enc.'/'.$report_no_rev_enc.'/'.'null'.'/'.$drawing_no_enc;
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
                      <td class="font-weight-bold">Status</td>
                      <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                      <td>
                      <?php if(@$value['status_inspection'] == "0"): ?>
                        <span class="badge badge-pill badge-primary">Ready to Submit RFI</span>
                      <?php elseif(@$value['status_inspection'] == 1): ?>
                        <span class="badge badge-pill badge-info">SMOE QC RFI - Pending Approval</span>
                      <?php elseif(@$value['status_inspection'] == 2): ?>
                        <span class="badge badge-pill badge-danger">SMOE QC RFI - Rejected</span>
                      <?php elseif(@$value['status_inspection'] == 3): ?>
                        <span class="badge badge-pill badge-success">SMOE QC RFI - Approved</span>
                      <?php elseif(@$value['status_inspection'] == 4): ?>
                        <span class="badge badge-pill badge-secondary">SMOE QC RFI - Pending</span>
                      <?php elseif(@$value['status_inspection'] == 5): ?>
                        <span class="badge badge-pill bg-purple text-white">Client RFI - Pending Approval</span>
                      <?php elseif(@$value['status_inspection'] == 6): ?>
                        <span class="badge badge-pill badge-danger">Client RFI - Rejected</span>
                      <?php elseif(@$value['status_inspection'] == 7): ?>
                        <span class="badge badge-pill bg-teal text-white">Client RFI - Approved</span>
                      <?php elseif(@$value['status_inspection'] == 8): ?>
                        <span class="badge badge-pill badge-warning">Request for Update</span>
                      <?php elseif(@$value['status_inspection'] == 9): ?>
                        <span class="badge badge-pill bg-orange text-white">Client RFI - Accepted with Comment</span>
                      <?php elseif(@$value['status_inspection'] == 10): ?>
                        <span class="badge badge-pill bg-orange text-white">Client RFI - Postponed</span>
                      <?php elseif(@$value['status_inspection'] == 11): ?>
                        <span class="badge badge-pill bg-orange text-white">Client RFI - Re-Offer</span>
                      <?php elseif(@$value['status_inspection'] == 12): ?>
                        <span class="badge badge-pill badge-dark">Void</span>
                      <?php else: ?>
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
              <div class="tab-pane fade" id="pills-bondstrand" role="tabpanel" aria-labelledby="pills-bondstrand-tab">
                <?php foreach ($joint_list as $joint): ?>
                  <?php 
                    foreach ($bondstrand_list[$joint['id']] as $value): 
                      $report_number_fi_enc = strtr($this->encryption->encrypt($value['report_number']), '+=/', '.-~');
                      $project_enc = strtr($this->encryption->encrypt($value['project_code']), '+=/', '.-~');
                      $discipline_enc = strtr($this->encryption->encrypt($value['discipline']), '+=/', '.-~');
                      $type_of_module_enc = strtr($this->encryption->encrypt($value['type_of_module']), '+=/', '.-~');
                      $module_enc = strtr($this->encryption->encrypt($value['module']), '+=/', '.-~');
                      $company_id_enc = strtr($this->encryption->encrypt($company_workpack_list[$value['id_workpack']]), '+=/', '.-~');
                      if(@$value['report_number'] ==  '' && @$value['submission_id'] ==  ''){
                        $link_more = base_url().'bondstrand/joint_list';
                      }
                      elseif($value['report_number'] == ''){
                        $link_more = base_url('bondstrand/detail_inspection_list/').strtr($this->encryption->encrypt($value['submission_id']), '+=/', '.-~')."/".strtr($this->encryption->encrypt("submission"), '+=/', '.-~')."/submission/".strtr($this->encryption->encrypt($value['revision_status_inspection']), '+=/', '.-~');
                      }
                      else{
                        $link_more = base_url('bondstrand/detail_summary_list/').$value['report_number'];
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
                        <?php if(@$value['status_inspection'] == "0"): ?>
                          <span class="badge badge-pill badge-primary">Ready to Submit RFI</span>
                        <?php elseif(@$value['status_inspection'] == 1): ?>
                          <span class="badge badge-pill badge-info">SMOE QC RFI - Pending Approval</span>
                        <?php elseif(@$value['status_inspection'] == 2): ?>
                          <span class="badge badge-pill badge-danger">SMOE QC RFI - Rejected</span>
                        <?php elseif(@$value['status_inspection'] == 3): ?>
                          <span class="badge badge-pill badge-success">SMOE QC RFI - Approved</span>
                        <?php elseif(@$value['status_inspection'] == 4): ?>
                          <span class="badge badge-pill badge-secondary">SMOE QC RFI - Pending</span>
                        <?php elseif(@$value['status_inspection'] == 5): ?>
                          <span class="badge badge-pill bg-purple text-white">Client RFI - Pending Approval</span>
                        <?php elseif(@$value['status_inspection'] == 6): ?>
                          <span class="badge badge-pill badge-danger">Client RFI - Rejected</span>
                        <?php elseif(@$value['status_inspection'] == 7): ?>
                          <span class="badge badge-pill bg-teal text-white">Client RFI - Approved</span>
                        <?php elseif(@$value['status_inspection'] == 8): ?>
                          <span class="badge badge-pill badge-warning">Request for Update</span>
                        <?php elseif(@$value['status_inspection'] == 9): ?>
                          <span class="badge badge-pill bg-orange text-white">Client RFI - Accepted with Comment</span>
                        <?php elseif(@$value['status_inspection'] == 10): ?>
                          <span class="badge badge-pill bg-orange text-white">Client RFI - Postponed</span>
                        <?php elseif(@$value['status_inspection'] == 11): ?>
                          <span class="badge badge-pill bg-orange text-white">Client RFI - Re-Offer</span>
                        <?php elseif(@$value['status_inspection'] == 12): ?>
                          <span class="badge badge-pill badge-dark">Void</span>
                        <?php else: ?>
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
                <?php endforeach; ?>
              </div>
              <div class="tab-pane fade" id="pills-irn" role="tabpanel" aria-labelledby="pills-irn-tab">
                <?php 
                  foreach ($irn_list as $value): 
                    $link_more = base_url().'irn/show_irn_detail_material/'.strtr($this->encryption->encrypt($value['submission_id']),'+=/', '.-~').'/'.strtr($this->encryption->encrypt($value['report_number']),'+=/', '.-~');
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
                      <?php if(@$value['status_inspection'] == "0"): ?>
                        <span class="badge badge-pill badge-primary">Draft</span>
                      <?php elseif(@$value['status_inspection'] == 1): ?>
                        <span class="badge badge-pill badge-info">SMOE QC RFI - Pending Approval</span>
                      <?php elseif(@$value['status_inspection'] == 2): ?>
                        <span class="badge badge-pill badge-danger">SMOE QC RFI - Rejected</span>
                      <?php elseif(@$value['status_inspection'] == 3): ?>
                        <span class="badge badge-pill badge-success">SMOE QC RFI - Approved</span>
                      <?php elseif(@$value['status_inspection'] == 4): ?>
                        <span class="badge badge-pill badge-secondary">SMOE QC RFI - Pending</span>
                      <?php elseif(@$value['status_inspection'] == 5): ?>
                        <span class="badge badge-pill bg-purple text-white">Client RFI - Pending Approval</span>
                      <?php elseif(@$value['status_inspection'] == 6): ?>
                        <span class="badge badge-pill badge-danger">Client RFI - Rejected</span>
                      <?php elseif(@$value['status_inspection'] == 7): ?>
                        <span class="badge badge-pill bg-teal text-white">Client RFI - Approved</span>
                      <?php elseif(@$value['status_inspection'] == 8): ?>
                        <span class="badge badge-pill badge-warning">Request for Update</span>
                      <?php elseif(@$value['status_inspection'] == 9): ?>
                        <span class="badge badge-pill bg-orange text-white">Client RFI - Accepted with Comment</span>
                      <?php elseif(@$value['status_inspection'] == 10): ?>
                        <span class="badge badge-pill bg-orange text-white">Client RFI - Postponed</span>
                      <?php elseif(@$value['status_inspection'] == 11): ?>
                        <span class="badge badge-pill bg-orange text-white">Client RFI - Re-Offer</span>
                      <?php elseif(@$value['status_inspection'] == 12): ?>
                        <span class="badge badge-pill badge-dark">Void</span>
                      <?php else: ?>
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
      <?php elseif(@$get['part_id'] != ''): ?>
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0">Results</h6>
          </div>
          <div class="card-body bg-white overflow-auto">
            Piecemark Not Found
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
        <h5 class="modal-title" >History Log</h5>
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
    $('.autopiecemark').autocomplete({
      source: function(request, response) {
        $.post('<?php echo base_url(); ?>engineering/display_piecemark', {
          term: request.term
        }, response, 'json');
      },
      autoFocus: true,
      classes: {
        "ui-autocomplete": "highlight",
        "z-index": 100
      }
    });
  }

  function search_piecemark(input) {
    if($(input).val() != ''){
      $(input).closest('form').submit();
    }
  }

  function open_history_log(id) {
    $('#history_log').modal('show');
    $('#history_log .modal-body').html('<div class="text-center"><div class="spinner-border text-success" role="status"><span class="sr-only">Loading...</span></div></div>');
    $.ajax( {
      url: "<?php echo base_url() ?>engineering/get_table_history_log",
      type: "POST",
      data: {
        id_template: id,
        module: 1,
      },
      success: function(data) {
        $('#history_log .modal-body').html(data);
      }
    });
  }
</script>