<div id="content" class="container-fluid">
  <?php error_reporting(0); 

  $overall_status = array_column($inspection_detail, 'status_inspection');
  $revision_status_inspection = array_column($inspection_detail, 'revision_status_inspection');
 
  ?>
  <?php             
    $url_image = "10.5.252.116";
    if($this->input->ip_address() == getenv('IP_FIREWALL_GATEWAY')) {
      $url_image = "www.smoebatam.com";
    } 
  ?>
  <div class="modal fade" id="modalRedline" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <form action="<?php echo base_url();?>visual/process_new_redline" method="POST"  enctype="multipart/form-data">
          <div class="modal-header">
            <h4 class="modal-title">Add Attachment Redline</h4>
          </div>
          <div class="modal-body">

            <b><i>Drawing No :</i></b><br/> 
            <input type="hidden" name="drawing_no" class='form-control' value="<?php echo $inspection_detail[0]['drawing_no']; ?>" readonly>
            <input type="text" name="drawing_noxxx" class='form-control' value="<?php echo $inspection_detail[0]['drawing_no'].($inspection_detail[0]['transmit_gaas_rev']!='' ? ' Rev. '.$inspection_detail[0]['transmit_gaas_rev'] : 'Rev. 01'); ?>" readonly>
            <br/>                    

            <b><i>Submission ID :</i></b><br/> 
            <input type="text" name="submission_id" class='form-control' value="<?php echo $inspection_detail[0]['submission_id']; ?>" readonly><br/>
            
            <b><i>Report No :</i></b><br/>
            <?php
              $sufix = $this->master_report_no[$inspection_detail[0]['discipline']][$inspection_detail[0]['module']][$inspection_detail[0]['type_of_module']]['visual_report'.($inspection_detail[0]['company_id']==13 ? '_13' : '')];
            ?>
            <input type="text" name="" class='form-control' value="<?php echo strtoupper($sufix.$inspection_detail[0]['report_number']); ?>" readonly><br/>
            <input type="hidden" name="report_no" class='form-control' value="<?php echo $inspection_detail[0]['report_number']; ?>" readonly>

            <b><i>Revision No :</i></b><br/> 
            <input type="text" name="postpone_reoffer_no" class='form-control' value="<?php echo $inspection_detail[0]['postpone_reoffer_no']; ?>" readonly><br/>

            <b><i>Red-Line File :</i></b><br/>
            <input type="file" name="attach_line[]" multiple required><br/><br/>
       
            <b><i>Attachment Description :</i></b><br/>
            <textarea name='description' class='form-control'></textarea><br/> <br/>         
            
            <input type="hidden" name="upload_by" value="<?php echo $this->user_cookie[0]; ?>">
            <input type="hidden" name="upload_date" value="<?php echo date("Y-m-d H:i:s"); ?>">
             
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
          </div>
        </form>
      </div>
      
    </div>
  </div>
  <style type="text/css">
    .disabled-effect {
      pointer-events: none;
      opacity:0.5;
    }
  </style>
  <form method="POST" action="<?= base_url('visual/approval_inspection_client') ?>" autocomplete="off" enctype="multipart/form-data"> 
    <input type="hidden" name="drawing_rev_no" value="<?= $inspection_detail[0]['rev_ga_template'] ?>">

    <div class="row">
    <input type="hidden" name="approval_code_log" value="VISUAL/<?= $project_data_portal[0]["project_name"] ?>/<?= $report_number ?>/">

      <div class="col-md-12">
        <div class="my-3 p-3 bg-white rounded shadow-sm">
          <h6 class="pb-2 mb-0"><?= $meta_title ?></h6>
          <div class="overflow-auto media text-muted pt-3 mt-1 border-top border-gray">
            <div class="container-fluid">

              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>Drawing Number</label>
                    <input type="hidden" class="form-control" name="drawing_no_for_view" value="<?= $inspection_detail[0]['drawing_no'] ?>" required="" oninput="checkdraw(this)" readonly>
                    <input type="text" name="drawing_noxxx" class='form-control' value="<?php echo $inspection_detail[0]['drawing_no'].($inspection_detail[0]['transmit_gaas_rev']!='' ? ' Rev. '.$inspection_detail[0]['transmit_gaas_rev'] : 'Rev. '.$inspection_detail[0]['rev_ga_template']); ?>" readonly>

                    <input type="hidden" class="form-control" name="report_number_view" value="<?= $inspection_detail[0]['report_number'] ?>" required="" oninput="checkdraw(this)" readonly>
                    <?php 
                      $gaat = MAX(array_column($inspection_detail, 'transmit_gaas_rev'));
                      if($gaat!=''){
                        $transmit_gaas_rev = $gaat;
                      } else {
                        $transmit_gaas_rev = MAX(array_merge(array_column($inspection_detail, 'transmit_gaas_rev'), array_column($inspection_detail, 'rev_ga_template')));
                      }
                    ?>
                    <?php 
                        $links_atc = base_url_ftp_eng()."public_smoe/open_atc/2/".strtr($this->encryption->encrypt($drawing_val_2[$inspection_detail[0]['drawing_no']]['id']), '+=/', '.-~').'/'.$transmit_gaas_rev.'/1e0e7b33a7be53e7c9957eb27914726c8df5a3127a78009723415681dce804ee076d678b2f809f42b8417bf8007fec6d58455b4beae15f6a17e384122be4fe71kbm4o296X67afS9s6puvP6qvwqy7y8TaO5sgWrvULiU-';  
                        $links_atc_cross = base_url_ftp_eng()."public_smoe/open_atc_cross/2/".strtr($this->encryption->encrypt($inspection_detail[0]['drawing_no']), '+=/', '.-~')."/".strtr($this->encryption->encrypt($drawing_val_2[$inspection_detail[0]['drawing_no']]['id']), '+=/', '.-~').'/'.$transmit_gaas_rev.'/1e0e7b33a7be53e7c9957eb27914726c8df5a3127a78009723415681dce804ee076d678b2f809f42b8417bf8007fec6d58455b4beae15f6a17e384122be4fe71kbm4o296X67afS9s6puvP6qvwqy7y8TaO5sgWrvULiU-';  
                    ?>

                    <a target='_blank' href='<?= $links_atc ?>'  title='Attachment'> <i class='fas fa-paperclip'></i> Open Drawing </a>
                    &nbsp;&nbsp;
                    <a target='_blank' href='<?= $links_atc_cross ?>' title='Attachment' download='<?= $inspection_detail[0]['drawing_no'] ?>.pdf'>
                        <i class='fas fa-cloud-download-alt'></i> Download Drawing
                    </a>
                  </div>
                </div>
                 <div class="col-md">
                  <div class="form-group">
                    <label>Report No.</label>
                    <input type="text" class="form-control" name="batch_no_only_view" value="<?= strtoupper($sufix.$inspection_detail[0]['report_number']).' Rev.'.str_pad($inspection_detail[0]['postpone_reoffer_no'], 2, 0, STR_PAD_LEFT) ?>" readonly required="">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>Requestor</label>
                    <input type="text" class="form-control" name="requestor" value="<?= $user_list[$inspection_detail[0]['requestor']]['full_name'] ?>" disabled="" required="">
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>Requestor Company</label>
                    <input type="text" class="form-control" name="requestor_company" value="<?= $inspection_detail[0]['company'] ?>" required="" disabled="">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>Discipline</label>
                    <input type="text" class="form-control" name="discipline_name" value="<?= $master_discipline[$inspection_detail[0]['discipline']]['discipline_name'] ?>" disabled="" required="">
                    <input type="hidden" class="form-control" name="discipline" disabled="" value="2" required="">
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>Module</label>
                    <input type="text" class="form-control" name="mod_id_name" value="<?= $master_module[$inspection_detail[0]['module']]['mod_desc'] ?>" disabled="" required="">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>Date of Offer</label>
                    <input type="date" class="form-control" name="date_of_offer" required="" value="<?= DATE('Y-m-d', strtotime($inspection_detail[0]['date_request'])) ?>" disabled>
                  </div>
                </div>
                <div class="col-md"></div>
              </div>

              <hr>

              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>Area</label>
                    <select disabled="" class="form-control select2 input_area" name="area_main" <?= $user_permission[40]==1 ? '' : 'disabled' ?>>
                    <?php if($inspection_detail[0]['area_v2']!=''){ ?>
                      <?php foreach ($master_area_v2 as $key => $value_area) { ?>
                        <option value="<?= $value_area['id'] ?>" <?= $inspection_detail[0]['area_v2']==$value_area['id'] ? 'selected' : '' ?>><?= $value_area['name'] ?></option>
                      <?php } ?>
                    <?php } else { ?>
                    <?php foreach ($master_area as $key => $value_area) { ?>
                      <option value="<?= $value_area['id'] ?>" <?= $inspection_detail[0]['area']==$value_area['id'] ? 'selected' : '' ?>><?= $value_area['area_name'] ?></option>
                    <?php }} ?>
                    </select>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>Location</label>
                    <select disabled="" class="form-control select2 input_location" name="location_main" <?= $user_permission[40]==1 ? '' : 'disabled' ?>>
                    <?php if($inspection_detail[0]['location_v2']!=''){ ?>
                      <?php foreach ($master_location_v2 as $key => $value_location) { ?>
                        <option value="<?= $value_location['id'] ?>" <?= $inspection_detail[0]['location_v2']==$value_location['id'] ? 'selected' : '' ?> data-chained="<?php echo $value_location['id_area'] ?>"><?= $value_location['name'] ?></option>
                      <?php } ?>
                    <?php } else { ?>
                    <?php foreach ($master_location as $key => $value_location) { ?>
                      <option value="<?= $value_location['id'] ?>" <?= $inspection_detail[0]['location']==$value_location['id'] ? 'selected' : '' ?>><?= $value_location['location_name'] ?></option>
                    <?php }} ?>
                    </select>

                    <input type="hidden" name="submission_id_data" value="<?= $inspection_detail[0]['submission_id'] ?>">
                    
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <label>Point</label>
                  <select disabled="" class="form-control select2 input_point" name="point_main" <?= $user_permission[40]==1 ? '' : 'disabled' ?>>
                    <?php foreach ($master_point_v2 as $key => $value_point) { ?>
                      <option value="<?= $value_point['id'] ?>" <?= $inspection_detail[0]['point_v2']==$value_point['id'] ? 'selected' : '' ?> data-chained="<?php echo $value_point['id_location'] ?>"><?= $value_point['name'] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col-md" style="text-align: right !important; vertical-align: text-bottom !important;">
                </div>
              </div>

            </div>
          <div class="fl-scrolls fl-scrolls-hidden" data-orientation="horizontal" style="width: 1564px; left: 286px;"><div style="width: 1564px;"></div></div></div>
        </div>

        <?php if(in_array(1, $revision_status_inspection)){ ?>
        <div class="my-3 p-3 bg-white rounded shadow-sm form-group">
          <h6 class="pb-2 mb-0">Inspection Date Option</h6>
          <hr>
          
          <div class="row">
            
            <div class="col align-middle">
              <div class="form-check form-check-inline col">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="1" name="ticked_report_date">
                <label class="form-check-label" for="inlineCheckbox1">
                  <b>Use Current Date as Approval Date?</b>
                </label>
              </div>
            </div>

            <div class="col align-middle d-none">
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Current Date</label>
                <div class="col-sm-10">
                  <input type="date" class="form-control" value="<?= DATE('Y-m-d') ?>" readonly>
                </div>
              </div>
            </div>

            <div class="col align-middle d-none">
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Last Date</label>
                <div class="col-sm-10">
                  <input type="date" class="form-control" value="<?= DATE('Y-m-d', strtotime($inspection_detail[0]['inspection_datetime'])) ?>" readonly>
                </div>
              </div>
            </div>
          </div>

        </div>
        <?php } ?>

        <!-- <br><br> -->
      </div>

    <div class="col-md-12">
      <div class="card">
        <ul class="nav nav-pills border-bottom border-gray" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="detail-tab" data-toggle="tab" href="#detail" role="tab" aria-controls="detail" aria-selected="true" onclick="hidenDetail(1)">Detail</a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" id="revise-tab" data-toggle="tab" href="#revise" role="tab" aria-controls="revise" aria-selected="false">Revise History Log</a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link" id="redline-tab" data-toggle="tab" href="#redline" role="tab" aria-controls="redline" aria-selected="false" onclick="hidenDetail(0)">Supporting Document</a>
          </li>
          <script type="text/javascript">
            function hidenDetail(angka){
              if(angka==0){
                $('.tab-detail').addClass('d-none')
              } else {
                $('.tab-detail').removeClass('d-none')
              }
            }
          </script>
        </ul>
      </div>
    </div>

    <div class="col tab-content" id="myTabContent">
      <div class="tab-pane active" id="detail" role="tabpanel" aria-labelledby="detail-tab"></div>

      <div class="tab-pane fade" id="redline" role="tabpanel" aria-labelledby="redline-tab">
        <div class="col-md-12 card">
          <div class="row mt-3">
            <div class="col-md-12">
              <div class="table-responsive overflow-auto">

                <button class="btn btn-info" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalRedline">
                  <i class="fas fa-plus-circle"></i> Add Red-Line
                </button>
                <br/><br/>

                <table class="table table-hover text-center">
                  <thead class="bg-gray-table">
                    <th>No</th>
                    <th>Drawing No</th>
                    <th>Submission ID</th>
                    <th>Report No</th>
                    <th>Revision No</th>
                    <th>Redline File</th>
                    <th>Redline Description</th>
                    <th>Upload By</th>
                    <th>Upload Date</th>
                    <th>Action</th>
                  </thead>
                  <tbody>
                    <?php if(sizeof($redline_attach) > 0){ ?>
                    <?php $no = 1;foreach ($redline_attach as $key => $value): ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?php echo $value["drawing_no"] ?></td>
                      <td><?php echo $value["submission_id"] ?> </td>
                      <td><?= $master_report_number[$joint_list[0]['project_code']][$joint_list[0]['discipline']][$joint_list[0]['type_of_module']]["fitup_report"].$value['report_no'] ?></td>
                      <td><?= $value['postpone_reoffer_no'] ?></td>
                      
                      <td>
                        <!-- <a target='_blank' href='https://<?= $url_image ?>/pcms_v2_photo/fab_img/redline/<?= $value['filename'] ?>'>Links</a> -->
                        <a href="<?= base_url('visual/open_atc/').$value["filename"].'/'.$value["filename"] ?>" target="_blank"> Links</a>
                      </td>

                      <td>
                        <?= $value['description'] ?>
                      </td>
                      
                      <td><?= $user_list[$value['upload_by']]['full_name'] ?></td>
                      <td><?= $value['upload_date'] ?></td>
                      <td>
                      	<?php if($user_permission[42]){ ?>
                      	<a href='<?= base_url() ?>fitup/delete_redline_data/<?php echo strtr($this->encryption->encrypt($value["id_redline"]),'+=/', '.-~'); ?>'><button type='button' class='btn btn-danger'><i class="fas fa-trash-alt"></i></button></a>
                      	<?php } ?>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php } else { ?>
                      <tr>
                        <td colspan='7'> No Data Available</td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <br><hr><br>
      </div>


    </div>
    </div>
    <div class="col-md-12">
      <div class="my-3 p-3 bg-white rounded shadow-sm radio-toolbar tab-detail text-center row">
        <br>
        <style type="text/css">
          .btn-muted {
            background-color: #d9dde0;
          }
        </style>
          <?php 
            $all_status_insp = array_column($inspection_detail, "status_inspection");
          ?>
          <?php if(($user_cookie[7]==8 OR $user_cookie[7]==1) AND $reoffer!='reoffer' AND in_array(5, $all_status_insp)){ ?>
            <div class="<?= (!in_array(1, $overall_status) AND !in_array(2, $overall_status) AND !in_array(8, $overall_status)) ? '' : 'd-none' ?> btn btn-muted btn-muted-acc col border form-check form-check-inline text-success">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="approval" value="3" style="width: 17px; height: 17px">
              <b>Accept All</b></label>
            </div>
            <div class="<?= (!in_array(1, $overall_status) AND !in_array(2, $overall_status) AND !in_array(8, $overall_status)) ? '' : 'd-none' ?> btn btn-muted btn-muted-rej col border form-check form-check-inline text-danger">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="approval" value="2" style="width: 17px; height: 17px">
              <b>Reject All</b></label>
            </div>
            <div class="<?= (!in_array(1, $overall_status) AND !in_array(2, $overall_status) AND !in_array(8, $overall_status)) ? '' : 'd-none' ?> btn btn-muted btn-muted-awc col border form-check form-check-inline text-primary">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="approval" value="9" style="width: 17px; height: 17px">
              <b>Accept All and Release with Comment</b></label>
            </div>
            <div class="<?= (!in_array(1, $overall_status) AND !in_array(2, $overall_status) AND !in_array(8, $overall_status)) ? '' : 'd-none' ?> btn btn-muted btn-muted-psp col border form-check form-check-inline text-info">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="approval" value="10" style="width: 17px; height: 17px">
              <b>Postpone All</b></label>
            </div>
            <div class="<?= (!in_array(1, $overall_status) AND !in_array(2, $overall_status) AND !in_array(8, $overall_status)) ? '' : 'd-none' ?> btn btn-muted btn-muted-reo col border form-check form-check-inline text-warning">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="approval" value="11" style="width: 17px; height: 17px">
              <b>Re-Offer All</b></label>
            </div>
          <?php } ?>
           <div class="btn btn-muted btn-muted-unc col border form-check form-check-inline text-secondary">
            <label class="form-check-label"><input class="form-check-input" type="radio" name="approval" value="999" style="width: 17px; height: 17px">
           <b>Uncheck All</b></label>
          </div>
        </div>

        <?php if ($main_data['company_id'] == 13): ?> 
        <div class="col-md-5">
          <div class="form-group row">
            <label for="" class="col-xl-3 col-form-label text-muted"> Approval Date</label>
            <div class="col-xl">
              <input type="date" name="manual_approval_date" class="form-control" required>
            </div>
          </div>
        </div>

        <div class="col-md-12"></div>
        <div class="col-md-5">
          <div class="form-group row">
            <label for="" class="col-xl-3 col-form-label text-muted"> Approval Time</label>
            <div class="col-xl">
              <input type="time" name="manual_approval_time" class="form-control" required>
            </div>
          </div>
        </div>
        <?php endif; ?>

      </div>

      <div class="col-md-12 alert_status d-none">
        <div class="my-3 p-3 bg-white rounded shadow-sm radio-toolbar tab-detail text-center row justify-content-center">
          <strong class="text-muted">
            This Document will be <u class="alert_status_text"></u>
          </strong>
        </div>
      </div>

        <script type="text/javascript">
            $(document).ready(function(){

            $('input[name="approval"]').click(function(){
              var approve_val = $(this).val();
              console.log(approve_val);

              $('.btn-muted-acc').addClass('btn-muted') // 3 
              $('.btn-muted-rej').addClass('btn-muted') // 2
              $('.btn-muted-awc').addClass('btn-muted') // 9
              $('.btn-muted-psp').addClass('btn-muted') // 10
              $('.btn-muted-reo').addClass('btn-muted') // 11
              $('.btn-muted-pen').addClass('btn-muted') // 4
              $('.btn-muted-unc').addClass('btn-muted') // 0

              $('.btn-muted-acc').removeClass('alert-warning')
              $('.btn-muted-rej').removeClass('alert-warning')
              $('.btn-muted-acc').removeClass('alert-warning')
              $('.btn-muted-awc').removeClass('alert-warning')
              $('.btn-muted-rej').removeClass('alert-warning')
              $('.btn-muted-psp').removeClass('alert-warning')
              $('.btn-muted-reo').removeClass('alert-warning')
              $('.btn-muted-pen').removeClass('alert-warning')
              $('.btn-muted-unc').removeClass('alert-warning')

              if(approve_val == 3){
                $('.accepted_remarks').removeClass('d-none')
                $('.accepted_remarks').removeAttr('disabled');
              } else {
                $('.accepted_remarks').addClass('d-none')
                $('.accepted_remarks').prop('disabled', true);
              }

              if(approve_val == 3){

                $('.btn-muted-acc').addClass('alert-warning')
                $('.btn-muted-acc').removeClass('btn-muted')

                $('.pen').removeAttr('checked');
                $('.rej').removeAttr('checked');
                $('.app').prop('checked', true);
                $('.all_remarks').attr('required', false);
                $('.all_remarks').prop('disabled', true);
                $('.client_remarks_all').attr('required', false);
                $('.client_remarks_all').prop('disabled', true);

              } else if(approve_val == 2){

                $('.btn-muted-rej').addClass('alert-warning')
                $('.btn-muted-rej').removeClass('btn-muted')

                $('.pen').removeAttr('checked');
                $('.app').removeAttr('checked');
                $('.rej').prop('checked', true);
                <?php if($enable_modify!='client'){ ?>
                  $('.all_remarks').attr('required', true);
                  $('.all_remarks').removeAttr('disabled');
                <?php } else { ?>
                  $('.client_remarks_all').prop('required', true);
                  $('.client_remarks_all').removeAttr('disabled');
                <?php } ?>

              } else if(approve_val == 4){

                $('.btn-muted-pen').addClass('alert-warning')
                $('.btn-muted-pen').removeClass('btn-muted')

                $('.rej').removeAttr('checked');
                $('.app').removeAttr('checked');
                $('.pen').prop('checked', true);
                $('.all_remarks').attr('required', true);
                $('.all_remarks').removeAttr('disabled');
                $('.client_remarks_all').attr('required', false);
                $('.client_remarks_all').prop('disabled', true);

              } else if(approve_val == 9){

                $('.alert_status').removeClass('d-none');
                $('.alert_status_text').text('Acc. with Comment')

                $('.app').prop('disabled', true).prop('title', 'Uncheck All, due to Postpone/Re-Offer/Acc. with Comment is Checked!');
                $('.rej').prop('disabled', true).prop('title', 'Uncheck All, due to Postpone/Re-Offer/Acc. with Comment is Checked!');


                $('.btn-muted-awc').addClass('alert-warning')
                $('.btn-muted-awc').removeClass('btn-muted')

                $('.app').prop('checked', false);
                $('.rej').prop('checked', false);
                $('.pen').prop('checked', false);
                $('.acc').prop('checked', true);
                $('.posp').prop('checked', false);
                $('.reof').prop('checked', false);

                $('.client_remarks_all').prop('required', true);
                $('.client_remarks_all').removeAttr('disabled');

              } else if(approve_val == 10){

                $('.alert_status').removeClass('d-none');
                $('.alert_status_text').text('Postponed')

                $('.app').prop('disabled', true).prop('title', 'Uncheck All, due to Postpone/Re-Offer/Acc. with Comment is Checked!');
                $('.rej').prop('disabled', true).prop('title', 'Uncheck All, due to Postpone/Re-Offer/Acc. with Comment is Checked!');


                $('.btn-muted-psp').addClass('alert-warning')
                $('.btn-muted-psp').removeClass('btn-muted')

                $('.app').prop('checked', false);
                $('.rej').prop('checked', false);
                $('.pen').prop('checked', false);
                $('.acc').prop('checked', false);
                $('.posp').prop('checked', true);
                $('.reof').prop('checked', false);

                $('.client_remarks_all').prop('required', true);
                $('.client_remarks_all').removeAttr('disabled');

              } else if(approve_val == 11){

                $('.alert_status').removeClass('d-none');
                $('.alert_status_text').text('Re-Offered')

                $('.app').prop('disabled', true).prop('title', 'Uncheck All, due to Postpone/Re-Offer/Acc. with Comment is Checked!');
                $('.rej').prop('disabled', true).prop('title', 'Uncheck All, due to Postpone/Re-Offer/Acc. with Comment is Checked!');


                $('.btn-muted-reo').addClass('alert-warning')
                $('.btn-muted-reo').removeClass('btn-muted')

                $('.app').prop('checked', false);
                $('.rej').prop('checked', false);
                $('.pen').prop('checked', false);
                $('.acc').prop('checked', false);
                $('.posp').prop('checked', false);
                $('.reof').prop('checked', true);

                $('.client_remarks_all').prop('required', true);
                $('.client_remarks_all').removeAttr('disabled');

              } else {

                $('.alert_status').addClass('d-none');

                $('.btn-muted-unc').addClass('alert-warning')
                $('.btn-muted-unc').removeClass('btn-muted')

                console.log(approve_val);
                $('.app').prop('disabled', false);
                $('.rej').prop('disabled', false);

                $('.app').prop('checked', false);
                $('.rej').prop('checked', false);
                $('.pen').prop('checked', false);
                $('.acc').prop('checked', false);
                $('.posp').prop('checked', false);
                $('.reof').prop('checked', false);
                $('.all_remarks').attr('required', false);
                $('.all_remarks').prop('disabled', true);
                $('.client_remarks_all').attr('required', false);
                $('.client_remarks_all').prop('disabled', true);
              }
            });
          });
        </script>

    <!-- DISINI STAR FOREACH -->
    <?php foreach ($inspection_detail as $key => $value) {?>
    <?php  
      $arr_stat_client[] = $value['status_inspection'];
      if(in_array(5, $arr_stat_client)){
        $button_save_client = '';
      } else {
        $button_save_client = 'd-none';
      }

      $arr_stat_qc[] = $value['status_inspection'];
      if(in_array(1, $arr_stat_qc)){
        $button_save_qc = '';
      } else {
        $button_save_qc = 'd-none';
      }
    ?>
    <div class="row" name="">
      <div class="col-md-12 tab-detail">
        <div class="bg-white rounded shadow-sm">
          <a data-toggle="collapse" href="#collapseExample<?= $key ?>" role="button" aria-expanded="false" aria-controls="collapseExample">
            <h6 class="mt-3 px-3 py-3 mb-0 bg-success text-white">Drawing WM : <b><?= $joint_list[$value['id_joint']]['drawing_wm'].' ('.$joint_list[$value['id_joint']]['joint_no'].')' ?></b></h6>
          </a>
          <?php if(($enable_modify=='client' AND $value['status_inspection']==5) OR $enable_modify!='client' OR $reoffer=='reoffer'){ ?> 
          <input type="hidden" name="id[<?= $key ?>]" value="<?= $value['id_visual'] ?>" <?= $status_fitup[$value['id_joint']]>=3 ? '' : 'disabled' ?>>
          <?php if($reoffer=='reoffer'){ ?>
            <input type="hidden" name="is_reoffer" value="1">
            <input type="hidden" name="isDetailReoffer" value="<?= $isDetailReoffer ?>">
          <?php } ?>
          <input type="hidden" name="revision_status_inspection[<?= $key ?>]" value="<?= $value['revision_status_inspection'] ?>">
          <?php } ?>
          <div class=" media text-muted pt-3 mx-3 border-top border-bottom border-gray" id="collapseExample<?= $key ?>" style="margin-bottom: 0cm">
            <div class="container-fluid card card-body">
              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>Weld Map Drawing No</label>
                    <input type="text" class="form-control" name="weldmap_no[1]" value="<?= $joint_list[$value['id_joint']]['drawing_wm'].($value['transmit_wm_rev']!='' ? ' Rev. '.$value['transmit_wm_rev'] : 'Rev. '.$value['rev_wm_template']) ?>" disabled>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>Joint No</label>
                    <?php //test_var($value); ?>
                    <input type="text" class="form-control" name="joint_no[1]" value="<?= $joint_list[$value['id_joint']]['joint_no'].($value['revision']>0 ? (' ('.$value['revision_category'].$value['revision'].')') : '') ?>" disabled>
                      <?php if(strlen($image_visual[$value['id_joint']])>1){ ?>
                        <span class="btn btn-info d-none" onclick="setSrc_surve('<?= $image_visual[$value['id_joint']] ?>')"><i class="fas fa-camera"></i></span>
                        <a class="btn btn-primary" target="_blank" href="<?= base_url('visual/open_atc_surveypr/').$image_visual[$value['id_joint']].'/'.($value['surveyor_attachment_revision'] ? $value['surveyor_attachment_revision'] : $image_visual[$value['id_joint']]) ?>"><i class="fas fa-camera"></i></a>

                        <br/>
                        <script type="text/javascript">
                          function setSrc_surve(src){
                            console.log(src)
                            $('.src').attr("src", "https://<?= $url_image ?>/pcms_v2_photo/"+src);
                            $('#preview_surv').modal('show'); 
                          }
                        </script>
                        <div class="modal fade" id="preview_surv" tabindex="-1" role="dialog" aria-labelledby="previewLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="previewLabel">Images Preview</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <img src="https://<?= $url_image ?>/pcms_v2_photo/fab_img/<?= $value_att_c['filename'] ?>" class="src" style="width: 100% !important">
                              </div>
                              <div class="modal-footer">
                                <span type="button" class="btn btn-secondary" data-dismiss="modal">Close</span>
                              </div>
                            </div>
                          </div>
                        </div>
                      <?php } ?>
                  </div>
                </div>
                <div class="col-md-1">
                  <div class="form-group">
                    <label>PWHT</label>
                    <div class="row">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="pwht[<?= $key ?>]" value="1" style="width: 17px; height: 17px" <?= $value['ndt_pwht']==1 ? 'checked' : '' ?> <?= $enable_modify=='client' ? 'disabled' : '' ?>>
                        <label class="form-check-label">Yes</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="pwht[<?= $key ?>]" value="0" style="width: 17px; height: 17px" <?= $value['ndt_pwht']!=1 ? 'checked' : '' ?> <?= $enable_modify=='client' ? 'disabled' : '' ?>>
                        <label class="form-check-label">No</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md row">
                  <div class="col-md-6">
                    <label>Weld Date Time</label>
                    <input type="date" class="form-control revise" name="weld_date[<?= $key ?>]" required="" value="<?= DATE('Y-m-d', strtotime($value['weld_datetime'])) ?>" disabled>
                  </div>
                  <div class="col-md-6">
                    <label>Consumable / Lot No</label>
                    <input type="text" class="form-control revise" title="1" name="cons_lot_no[<?= $key ?>]" placeholder="Consumable / Lot Number" value="<?= $value['cons_lot_no'] ?>" disabled>
                  </div>   
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>
                      <center>
                        <a class="btn btn-primary" data-toggle="collapse" href="#lastRevision_<?= $value['id_joint'] ?>" role="button" aria-expanded="false" aria-controls="lastRevision_<?= $value['id_joint'] ?>">
                          <strong>
                            <div class="fas fa-history"></div> Last Revision
                          </strong>
                        </a>
                      </center>
                    </label>
                    <div class="collapse" id="lastRevision_<?= $value['id_joint'] ?>">
                    <table class="table dataTable">
                      <thead class="bg-info">
                        <tr>
                          <th>Data</th>
                          <th>Before</th>
                          <th>After</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($template_history[$value['id_joint']] as $key_h => $value_h){?>
                        <tr>
                          <td><?= $value_h['name'] ?></td>
                          <td><?= $value_h['data_before'] ?></td>
                          <td><?= $value_h['data_after'] ?></td>
                          <td><?= 'By '.$user_list[$value_h['created_by']]['full_name'].' on '.DATE('d F, Y H:i a', strtotime($value_h['created_date'])) ?></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="row">                
                <div class="col-md">
                  <div class="form-group">
                    <label>Length of Weld (MM)</label>
                    <input type="text" class="form-control length_of_weld_1 revise" name="length_of_weld[<?= $key ?>]" value="<?= (int)$value['revision']>0 ? number_format($value['length_of_weld'], 2) : number_format($value['weld_length'], 2) ?>" required="" disabled>
                  </div>
                </div>

                <div class="col-md">
                  <div class="form-group">
                    <label>Length (MM)</label>
                    <input type="text" class="form-control" name="lenght[1]" value="<?= number_format($joint_list[$value['id_joint']]['length'], 2) ?>" disabled="">
                  </div>
                </div>
                <div class="col-md">
                  
                </div>
              </div>

              <div class="row">
                 <div class="col-md">
                  <div class="form-group">
                    <label>Thk</label>
                      <input type="text" class="form-control" name="thk[1]" value="<?= number_format($joint_list[$value['id_joint']]['thickness'], 2) ?>" required="" disabled="">
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>Dia (mm)</label>
                    <input type="text" class="form-control" name="dia[1]" value="<?= number_format($joint_list[$value['id_joint']]['diameter'], 2) ?>" required="" disabled="">
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>PMT Remark</label>
                    <textarea value="" class="form-control" name="remarks[<?= $key ?>]" disabled <?= $enable_modify=='client' ? 'disabled' : '' ?>><?= $value['remarks'] ?></textarea>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>NDT Requirement</label>

                    <div class="row mx-0">
                      <div class="form-check col-md-4 custom-control custom-checkbox <?= $enable_modify=='client' ? 'disabled-effect' : '' ?> <?= $value['status_inspection']>=5 ? 'disabled-effect' : '' ?>">
                        <input type="checkbox" value="1" name="ndt_mt[<?= $key ?>]" class="custom-control-input" id="customControlAutosizing_mt<?= $key ?>" <?= $value['ndt_mt']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_mt<?= $key ?>">MT</label>
                      </div>
                      <div class="form-check col-md-4 custom-control custom-checkbox <?= $enable_modify=='client' ? 'disabled-effect' : '' ?> <?= $value['status_inspection']>=5 ? 'disabled-effect' : '' ?>">
                        <input type="checkbox" value="1" name="ndt_rt[<?= $key ?>]" class="custom-control-input" id="customControlAutosizing_rt<?= $key ?>" <?= $value['ndt_rt']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_rt<?= $key ?>">RT</label>
                      </div>
                      <div class="form-check col-md-4 custom-control custom-checkbox <?= $enable_modify=='client' ? 'disabled-effect' : '' ?> <?= $value['status_inspection']>=5 ? 'disabled-effect' : '' ?>">
                        <input type="checkbox" value="1" name="ndt_pt[<?= $key ?>]" class="custom-control-input" id="customControlAutosizing_pt<?= $key ?>" <?= $value['ndt_pt']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_pt<?= $key ?>">PT</label>
                      </div>

                      <div class="form-check col-md-4 custom-control custom-checkbox <?= $enable_modify=='client' ? 'disabled-effect' : '' ?> <?= $value['status_inspection']>=5 ? 'disabled-effect' : '' ?>">
                        <input type="checkbox" value="1" name="ndt_ut[<?= $key ?>]" class="custom-control-input" id="customControlAutosizing_ut<?= $key ?>" <?= $value['ndt_ut']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_ut<?= $key ?>">UT</label>
                      </div>
                      <div class="form-check col-md-4 custom-control custom-checkbox <?= $enable_modify=='client' ? 'disabled-effect' : '' ?> <?= $value['status_inspection']>=5 ? 'disabled-effect' : '' ?>">
                        <input type="checkbox" value="1" name="ndt_pa_ut[<?= $key ?>]" class="custom-control-input" <?= $value['ndt_pa_ut']==1 ? 'checked' : '' ?> id="customControlAutosizing_pa_ut<?= $key ?>">
                        <label class="custom-control-label" for="customControlAutosizing_pa_ut<?= $key ?>">PA-UT</label>
                      </div>
                      <div class="form-check col-md-4 custom-control custom-checkbox <?= $enable_modify=='client' ? 'disabled-effect' : '' ?> <?= $value['status_inspection']>=5 ? 'disabled-effect' : '' ?>">
                        <input type="checkbox" value="1" name="ndt_ht[<?= $key ?>]" class="custom-control-input" id="customControlAutosizing_ht<?= $key ?>" <?= $value['ndt_ht']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_ht<?= $key ?>">HT</label>
                      </div>

                      <div class="form-check col-md-4 custom-control custom-checkbox <?= $enable_modify=='client' ? 'disabled-effect' : '' ?> <?= $value['status_inspection']>=5 ? 'disabled-effect' : '' ?>">
                        <input type="checkbox" value="1" name="ndt_ft[<?= $key ?>]" class="custom-control-input" id="customControlAutosizing_ft<?= $key ?>" <?= $value['ndt_ft']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_ft<?= $key ?>">FT</label>
                      </div>
                      <div class="form-check col-md-4 custom-control custom-checkbox <?= $enable_modify=='client' ? 'disabled-effect' : '' ?> <?= $value['status_inspection']>=5 ? 'disabled-effect' : '' ?>">
                        <input type="checkbox" value="1" name="ndt_pmi[<?= $key ?>]" class="custom-control-input" id="customControlAutosizing_pmi<?= $key ?>" <?= $value['ndt_pmi']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_pmi<?= $key ?>">PMI</label>
                      </div>
                    </div>                    
                  </div>
                </div>

                <div class="col-md row">
                  <div class="form-group col-sm">
                    <label>Process RH</label>
                    <div class="row mx-0">
                      <div class="form-check col-md-12 custom-control custom-checkbox">
                        <input disabled type="checkbox" value="1" name="process_1_rh[<?= $key ?>]" class="custom-control-input disabled-effect revise" id="customControlAutosizing_rh_gtaw<?= $key ?>" <?= $value['process_gtaw_rh']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_rh_gtaw<?= $key ?>">GTAW</label>
                      </div>
                      <div class="form-check col-md-12 custom-control custom-checkbox">
                        <input disabled type="checkbox" value="1" name="process_2_rh[<?= $key ?>]" class="custom-control-input disabled-effect revise" id="customControlAutosizing_rh_gmaw<?= $key ?>" <?= $value['process_gmaw_rh']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_rh_gmaw<?= $key ?>">GMAW</label>
                      </div>
                      <div class="form-check col-md-12 custom-control custom-checkbox">
                        <input disabled type="checkbox" value="1" name="process_3_rh[<?= $key ?>]" class="custom-control-input disabled-effect revise" id="customControlAutosizing_rh_smaw<?= $key ?>" <?= $value['process_smaw_rh']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_rh_smaw<?= $key ?>">SMAW</label>
                      </div>
                      <div class="form-check col-md-12 custom-control custom-checkbox">
                        <input disabled type="checkbox" value="1" name="process_4_rh[<?= $key ?>]" class="custom-control-input disabled-effect revise" id="customControlAutosizing_rh_fcaw<?= $key ?>" <?= $value['process_fcaw_rh']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_rh_fcaw<?= $key ?>">FCAW</label>
                      </div>
                      <div class="form-check col-md-12 custom-control custom-checkbox">
                        <input disabled type="checkbox" value="1" name="process_5_rh[<?= $key ?>]" class="custom-control-input disabled-effect revise" id="customControlAutosizing_rh_saw<?= $key ?>" <?= $value['process_saw_rh']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_rh_saw<?= $key ?>">SAW</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-sm">
                    <label>Process FC</label>
                    <div class="row mx-0">
                      <div class="form-check col-md-12 custom-control custom-checkbox">
                        <input disabled type="checkbox" value="1" name="process_1_fc[<?= $key ?>]" class="custom-control-input disabled-effect revise" id="customControlAutosizing_fc_gtaw<?= $key ?>" <?= $value['process_gtaw_fc']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_fc_gtaw<?= $key ?>">GTAW</label>
                      </div>
                      <div class="form-check col-md-12 custom-control custom-checkbox">
                        <input disabled type="checkbox" value="1" name="process_2_fc[<?= $key ?>]" class="custom-control-input disabled-effect revise" id="customControlAutosizing_fc_gmaw<?= $key ?>" <?= $value['process_gmaw_fc']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_fc_gmaw<?= $key ?>">GMAW</label>
                      </div>
                      <div class="form-check col-md-12 custom-control custom-checkbox">
                        <input disabled type="checkbox" value="1" name="process_3_fc[<?= $key ?>]" class="custom-control-input disabled-effect revise" id="customControlAutosizing_fc_smaw<?= $key ?>" <?= $value['process_smaw_fc']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_fc_smaw<?= $key ?>">SMAW</label>
                      </div>
                      <div class="form-check col-md-12 custom-control custom-checkbox">
                        <input disabled type="checkbox" value="1" name="process_4_fc[<?= $key ?>]" class="custom-control-input disabled-effect revise" id="customControlAutosizing_fc_fcaw<?= $key ?>" <?= $value['process_fcaw_fc']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_fc_fcaw<?= $key ?>">FCAW</label>
                      </div>
                      <div class="form-check col-md-12 custom-control custom-checkbox">
                        <input disabled type="checkbox" value="1" name="process_5_fc[<?= $key ?>]" class="custom-control-input disabled-effect revise" id="customControlAutosizing_fc_saw<?= $key ?>" <?= $value['process_saw_fc']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_fc_saw<?= $key ?>">SAW</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>Welder Ref. RH</label>
                    <?php $arr_welder_rh[$key] = explode(';', $value['welder_ref_rh']); ?>
                    <select name="welder_ref_rh[<?= $key ?>][]" disabled class="select2 will_enable revise" multiple>
                      <?php foreach ($welders as $value_welder) {?>
                        <option value="<?= $value_welder['welder_code'] ?>" <?= in_array($value_welder['id_welder'], $arr_welder_rh[$key]) ? 'selected' : '' ?>><?= $value_welder['welder_code'].' - '.$value_welder['rwe_code'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Welder Ref. FC</label>
                    <?php $arr_welder_fc[$key] = explode(';', $value['welder_ref_fc']); ?>
                    <select name="welder_ref_fc[<?= $key ?>][]" disabled class="select2 will_enable revise" multiple>
                      <?php foreach ($welders as $value_welder) {?>
                        <option value="<?= $value_welder['welder_code'] ?>" <?= in_array($value_welder['id_welder'], $arr_welder_fc[$key]) ? 'selected' : '' ?>><?= $value_welder['welder_code'].' - '.$value_welder['rwe_code'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>WPS No. RH</label>
                    <?php $arr_wps_rh[$key] = explode(';', $value['wps_no_rh']); ?>
                    <select name="wps_no_rh[<?= $key ?>][]" disabled class="select2 will_enable revise" multiple>
                      <?php foreach ($wpss as $value_wps) {?>
                        <option <?= in_array($value_wps['id_wps'], $arr_wps_rh[$key]) ? 'selected' : '' ?>><?= $value_wps['wps_no'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>WPS No. FC</label>
                    <?php $arr_wps_fc[$key] = explode(';', $value['wps_no_fc']); ?>
                    <select name="wps_no_fc[<?= $key ?>][]" disabled class="select2 will_enable revise" multiple>
                      <?php foreach ($wpss as $value_wps) {?>
                        <option <?= in_array($value_wps['id_wps'], $arr_wps_fc[$key]) ? 'selected' : '' ?>><?= $value_wps['wps_no'] ?></option>
                      <?php } ?>
                    </select>
                  </div>

                  <input type="hidden" name="status_access" value="client">
                  <div class="col-md">
                    <label>Remarks</label>
                    <textarea value="" class="form-control client_remarks<?= $key ?> client_remarks_all" name="client_remarks[<?= $key ?>]" disabled onkeyup="$('.client_remarks_all').attr('required', false)"><?= $value['client_remarks'] ?></textarea>
                  </div>

                </div>
              </div>
            </div>
          </div>
          <?php if($enable_modify!='client'){ ?>
            <?php //test_var($value); ?>
            <div class="col-md-12" style="margin-top: 0">
              <div class="my-3 p-3 bg-white rounded shadow-sm" style="margin-top: 0">
                <div class="overflow-auto media text-muted" style="margin-top: 0">
                  <div class="container-fluid text-right p-0" style="margin-top: 0">
                    <?php if($value['status_inspection']==2){ ?>
                      <center><span class="badge badge-danger" style="margin-top: 0cm"><h6 style="margin-top: 0cm !important"><b>Rejected</b></h6></span></center>
                      <div class="my-3 p-3 bg-white rounded shadow-sm text-left" style="margin-top: 0">
                        <div class="row">
                          <div class="col">
                            <strong>Inspected By</strong>
                            <strong> : </strong>
                            <strong><u><?= $user_list[$value['inspection_by']]['full_name'] ?></u></strong>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <strong>Inspected On</strong>
                            <strong> : </strong>
                            <strong><u><?= DATE('d F, Y H:i A', strtotime($value['inspection_datetime'])) ?></u></strong>
                          </div>
                        </div>
                      </div>
                    <?php } elseif($value['status_inspection']==3 OR $value['status_inspection']==5){ ?>
                      <center><span class="badge badge-success " style="margin-top: 0cm"><h6 style="margin-top: 0cm !important"><b>Accepted</b></h6></span></center>
                      <div class="my-3 p-3 bg-white rounded shadow-sm text-left" style="margin-top: 0">
                        <div class="row">
                          <div class="col">
                            <strong>Inspected By</strong>
                            <strong> : </strong>
                            <strong><u><?= $user_list[$value['inspection_by']]['full_name'] ?></u></strong>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <strong>Inspected On</strong>
                            <strong> : </strong>
                            <strong><u><?= DATE('d F, Y H:i A', strtotime($value['inspection_datetime'])) ?></u></strong>
                          </div>
                        </div>
                      </div>
                    <?php } elseif($value['status_inspection']==4){ ?>
                      <center><span class="badge badge-primary" style="margin-top: 0cm"><h6 style="margin-top: 0cm !important"><b>Pending By QC</b></h6></span></center>
                      <div class="my-3 p-3 bg-white rounded shadow-sm text-left" style="margin-top: 0">
                        <div class="row">
                          <div class="col">
                            <strong>Inspected By</strong>
                            <strong> : </strong>
                            <strong><u><?= $user_list[$value['inspection_by']]['full_name'] ?></u></strong>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <strong>Inspected On</strong>
                            <strong> : </strong>
                            <strong><u><?= DATE('d F, Y H:i A', strtotime($value['inspection_datetime'])) ?></u></strong>
                          </div>
                        </div>
                      </div>
                    <?php } elseif($value['status_inspection']==5){ ?>
                      <center><span class="badge badge-primary" style="margin-top: 0cm"><h6 style="margin-top: 0cm !important"><b>Transmitt to Client</b></h6></span></center>
                      <div class="my-3 p-3 bg-white rounded shadow-sm text-left" style="margin-top: 0">
                        <div class="row">
                          <div class="col">
                            <strong>Inspected By</strong>
                            <strong> : </strong>
                            <strong><u><?= $user_list[$value['inspection_by']]['full_name'] ?></u></strong>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <strong>Inspected On</strong>
                            <strong> : </strong>
                            <strong><u><?= DATE('d F, Y H:i A', strtotime($value['inspection_datetime'])) ?></u></strong>
                          </div>
                        </div>
                      </div>
                    <?php } elseif($value['status_inspection']==6){ ?>
                      <center><span class="badge badge-danger" style="margin-top: 0cm"><h6 style="margin-top: 0cm !important"><b>Reject by Client</b></h6></span></center>
                      <!-- ===========================  -->
                      <div class="my-3 p-3 bg-white rounded shadow-sm text-left" style="margin-top: 0">
                        <div class="row">
                          <div class="col">
                            <strong>Inspected By</strong>
                            <strong> : </strong>
                            <strong><u><?= $user_list[$value['inspection_by']]['full_name'] ?></u></strong>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <strong>Inspected On</strong>
                            <strong> : </strong>
                            <strong><u><?= DATE('d F, Y H:i A', strtotime($value['inspection_datetime'])) ?></u></strong>
                          </div>
                        </div>
                      </div>

                      <div class="my-3 p-3 bg-white rounded shadow-sm text-left" style="margin-top: 0">
                        <div class="row">
                          <div class="col">
                            <strong>Inspected Client By</strong>
                            <strong> : </strong>
                            <strong><u><?= $user_list[$value['inspection_client_by']]['full_name'] ?></u></strong>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <strong>Inspected Client On</strong>
                            <strong> : </strong>
                            <strong><u><?= DATE('d F, Y H:i A', strtotime($value['inspection_client_datetime'])) ?></u></strong>
                          </div>
                        </div>
                      </div>
                      <!-- ========================== -->
                    <?php } elseif($value['status_inspection']==7){ ?>
                      <center><span class="badge badge-success" style="margin-top: 0cm"><h6 style="margin-top: 0cm !important"><b>Accepted by Client</b></h6></span></center>
                      <!-- ===========================  -->
                      <div class="my-3 p-3 bg-white rounded shadow-sm text-left" style="margin-top: 0">
                        <div class="row">
                          <div class="col">
                            <strong>Inspected By</strong>
                            <strong> : </strong>
                            <strong><u><?= $user_list[$value['inspection_by']]['full_name'] ?></u></strong>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <strong>Inspected On</strong>
                            <strong> : </strong>
                            <strong><u><?= DATE('d F, Y H:i A', strtotime($value['inspection_datetime'])) ?></u></strong>
                          </div>
                        </div>
                      </div>

                      <div class="my-3 p-3 bg-white rounded shadow-sm text-left" style="margin-top: 0">
                        <div class="row">
                          <div class="col">
                            <strong>Inspected Client By</strong>
                            <strong> : </strong>
                            <strong><u><?= $user_list[$value['inspection_client_by']]['full_name'] ?></u></strong>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <strong>Inspected Client On</strong>
                            <strong> : </strong>
                            <strong><u><?= DATE('d F, Y H:i A', strtotime($value['inspection_client_datetime'])) ?></u></strong>
                          </div>
                        </div>
                      </div>
                      <!-- ========================== -->
                    <?php } elseif($value['status_inspection']==9){ ?>
                      <center><span class="badge badge-primary" style="margin-top: 0cm"><h6 style="margin-top: 0cm !important"><b>Accepted and Release with Comment by Client</b></h6></span></center>
                    <?php } elseif($value['status_inspection']==10){ ?>
                      <center><span class="badge badge-info" style="margin-top: 0cm"><h6 style="margin-top: 0cm !important"><b>Postponed by Client</b></h6></span></center>
                      <!-- ===========================  -->
                      <div class="my-3 p-3 bg-white rounded shadow-sm text-left" style="margin-top: 0">
                        <div class="row">
                          <div class="col">
                            <strong>Inspected By</strong>
                            <strong> : </strong>
                            <strong><u><?= $user_list[$value['inspection_by']]['full_name'] ?></u></strong>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <strong>Inspected On</strong>
                            <strong> : </strong>
                            <strong><u><?= DATE('d F, Y H:i A', strtotime($value['inspection_datetime'])) ?></u></strong>
                          </div>
                        </div>
                      </div>

                      <div class="my-3 p-3 bg-white rounded shadow-sm text-left" style="margin-top: 0">
                        <div class="row">
                          <div class="col">
                            <strong>Inspected Client By</strong>
                            <strong> : </strong>
                            <strong><u><?= $user_list[$value['inspection_client_by']]['full_name'] ?></u></strong>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <strong>Inspected Client On</strong>
                            <strong> : </strong>
                            <strong><u><?= DATE('d F, Y H:i A', strtotime($value['inspection_client_datetime'])) ?></u></strong>
                          </div>
                        </div>
                      </div>
                      <!-- ========================== -->
                    <?php } elseif($value['status_inspection']==11){ ?>
                      <center><span class="badge badge-warning" style="margin-top: 0cm"><h6 style="margin-top: 0cm !important"><b>Re-Offer by Client</b></h6></span></center>
                      <!-- ===========================  -->
                      <div class="my-3 p-3 bg-white rounded shadow-sm text-left" style="margin-top: 0">
                        <div class="row">
                          <div class="col">
                            <strong>Inspected By</strong>
                            <strong> : </strong>
                            <strong><u><?= $user_list[$value['inspection_by']]['full_name'] ?></u></strong>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <strong>Inspected On</strong>
                            <strong> : </strong>
                            <strong><u><?= DATE('d F, Y H:i A', strtotime($value['inspection_datetime'])) ?></u></strong>
                          </div>
                        </div>
                      </div>

                      <div class="my-3 p-3 bg-white rounded shadow-sm text-left" style="margin-top: 0">
                        <div class="row">
                          <div class="col">
                            <strong>Inspected Client By</strong>
                            <strong> : </strong>
                            <strong><u><?= $user_list[$value['inspection_client_by']]['full_name'] ?></u></strong>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <strong>Inspected Client On</strong>
                            <strong> : </strong>
                            <strong><u><?= DATE('d F, Y H:i A', strtotime($value['inspection_client_datetime'])) ?></u></strong>
                          </div>
                        </div>
                      </div>
                      <!-- ========================== -->
                    <?php } elseif($value['status_inspection']==1 AND $status_fitup[$value['id_joint']]>=3){ ?>
                      <?php if($user_permission[40]==1){ //for SMOE Approval ?>
                        <div class="row float-left" style="width: 600px !important;">
                          <?php if( !empty($drawing_val[$value['drawing_no']]['transmittal_no']) AND  
                              isset($drawing_val[$value['drawing_no']]['transmittal_no'])  AND  
                              $drawing_val[$value['drawing_no']]['transmittal_no'] !== ""  AND  
                              !empty($drawing_val[$value['drawing_wm']]['transmittal_no']) AND  
                              isset($drawing_val[$value['drawing_wm']]['transmittal_no'])  AND  
                              $drawing_val[$value['drawing_wm']]['transmittal_no'] !== ""
                          ){ ?>
                            <div class="col-md-3">
                              <input type="hidden" name="status_data[<?= $no ?>]" value="<?= $value['status_inspection'] ?>"> 
                              <input class="form-check-input app" type="radio" name="approve[<?= $key ?>]" value="3" style="width: 17px; height: 17px" onclick="required_remarks(<?= $key ?>, this, 3)">
                              <label class="form-check-label font-weight-bold text-success">&nbsp;&nbsp;Approve</label>
                            </div>
                          <?php } else { ?>
                            <div class="col-md-5 text-left">
                              <span class="btn btn-secondary">
                                <label class="form-check-label">
                                  <i class="fas fa-hourglass"></i>
                                  <b>Waiting Drawing Release</b>
                                </label>
                              </span>
                            </div>
                            <!-- <div class="col-md-12 text-left">
                              <p></p>
                            </div> -->
                          <?php } ?>
                          <?php //if($value['report_number']==''){ ?>
                            <div class="col-md-3">
                              <input class="form-check-input rej" type="radio" name="approve[<?= $key ?>]" value="2" style="width: 17px; height: 17px" onclick="required_remarks(<?= $key ?>, this, 2)">
                              <label class="form-check-label font-weight-bold text-danger">&nbsp;&nbsp;Reject</label>
                            </div>
                            <div class="col-md-3">
                              <input class="form-check-input pen" type="radio" name="approve[<?= $key ?>]" value="4" style="width: 17px; height: 17px" onclick="required_remarks(<?= $key ?>, this, 4)">
                              <label class="form-check-label font-weight-bold text-primary">&nbsp;&nbsp;Pending By QC</label>
                            </div>
                          <?php //} else { ?>
                            <!-- <span class="badge badge-secondary badge-lg d-none"><i class="fas fa-clock"></i> This joint already approved before!</span> -->
                          <?php //} ?>
                      </div>
                      <?php } ?>
                    <?php } else { ?>
                      <div class="row float-center" style="width: 600px !important;">
                        <div class="col-md-12">
                          <span class="btn btn-warning">
                            <i class="fas fa-clock"></i>
                              <strong>
                                 Waiting for Fit-Up Approval Proccess!
                              </strong>
                          </span>
                        </div>
                      </div>
                    <?php } ?>
                  </div>

                  <div class="fl-scrolls fl-scrolls-hidden" data-orientation="horizontal" style="width: 1564px; left: 286px;"><div style="width: 1564px;">
                  </div></div></div>
              </div>
            </div> 

          <?php } ?>
            <input type="hidden" name="drawing_wm[<?= $no ?>]" value="<?= $value['drawing_wm'] ?>">
            <input type="hidden" name="rev_wm[<?= $no ?>]" value="<?= $value['rev_wm'] ?>">
          <?php if($enable_modify=='client' AND $value['status_inspection']==5){ ?>
            <?php if($user_cookie[7]==8 OR $user_cookie[7]==1){ ?>
              <?php if(!in_array(1, $overall_status) AND !in_array(2, $overall_status) AND !in_array(8, $overall_status)){ ?>
                <div class="my-3 p-3 bg-white rounded shadow-sm" style="margin-top: 0">
                  <div class="row center">
                    <div class="col-md">
                      <div class="form-check form-check-inline">
                        <label class="form-check-label font-weight-bold text-success">
                        <input class="form-check-input app" type="radio" name="approve[<?= $key ?>]" value="7" onclick="required_remarks(<?= $key ?>, this, 7)">
                        &nbsp;&nbsp;Accept</label>
                      </div>
                      <?php if($key==0 AND $enable_modify=='client' AND $value['project']==14){ ?>
                        <div class="col">
                          <textarea 
                            disabled 
                            name="accepted_remarks" 
                            class="form-control d-none accepted_remarks" 
                            placeholder="Accepted Remarks"
                          ></textarea>
                        </div>
                      <?php } ?>
                    </div>
                    <div class="col-md d-none">
                      <div class="form-check form-check-inline">
                        <label class="form-check-label font-weight-bold text-primary">
                        <input class="form-check-input acc" type="radio" name="approve[<?= $key ?>]" value="9" onclick="required_remarks(<?= $key ?>, this, 9)">
                        &nbsp;&nbsp;Accept and Release with Comment</label>
                      </div>
                    </div>
                    <div class="col-md" style="width: 10px !important">
                      <div class="form-check form-check-inline">
                        <label class="form-check-label font-weight-bold text-danger">
                        <input class="form-check-input rej" type="radio" name="approve[<?= $key ?>]" value="6" onclick="required_remarks(<?= $key ?>, this, 6)">
                        &nbsp;&nbsp;Reject</label>
                      </div>
                    </div>
                    <div class="col-md d-none">
                      <div class="form-check form-check-inline">
                        <label class="form-check-label font-weight-bold text-info">
                        <input class="form-check-input posp" type="radio" name="approve[<?= $key ?>]" value="10" onclick="required_remarks(<?= $key ?>, this, 10)">
                        &nbsp;&nbsp;Postpone</label>
                      </div>
                    </div>
                    <div class="col-md d-none">
                      <div class="form-check form-check-inline">
                        <label class="form-check-label font-weight-bold text-warning">
                        <input class="form-check-input reof" type="radio" name="approve[<?= $key ?>]" value="11" onclick="required_remarks(<?= $key ?>, this, 11)">
                        &nbsp;&nbsp;Re-Offer</label>
                      </div>
                    </div>
                    <div class="col-md d-none" style="width: 10px !important">
                      <input type="file" name="reject_client_attachment[<?= $key ?>]" class="form-control">
                      <textarea class="form-control" name="reject_client_remarks[<?= $key ?>]" placeholder="Remarks of Image"></textarea>
                    </div>
                    <div class="col-12"></div>
                    <div class="col-md-6">
                      <?php if($revise_history_template[$value['id_joint']]){ ?>
                        <span class="btn btn-warning btn-xl">
                          <b>Re-Approval Due to Joint Updated "<?= $revise_history_template[$value['id_joint']]['request_reason'] ?>"</b>
                        </span>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              <?php } else { ?>
                <div class="my-3 p-3 bg-white rounded shadow-sm" style="margin-top: 0">
                  <?php if($value['status_inspection']==1){ ?>
                    <center>
                      <span class="badge badge-secondary" style="margin-top: 0cm"><h6 style="margin-top: 0cm !important"><b>Revise Completed</b></h6></span>
                      <br><span class="badge badge-secondary"><b>Pending Re-Approval SMOE Inspector</b></span>
                    </center>
                  <?php } else { ?>
                    <center><span class="badge badge-secondary" style="margin-top: 0cm"><h6 style="margin-top: 0cm !important"><b>On Revise Progress</b></h6></span></center>
                  <?php } ?>
                </div>
              <?php } ?>
            <?php } ?>
            <!-- ============================================= -->
            <div class="accordion <?= (!in_array(1, $overall_status) AND !in_array(2, $overall_status) AND !in_array(8, $overall_status)) ? '' : 'd-none' ?>" id="accordionExample<?= $value['id_joint'] ?>">
              <div class="card">
                <div class="card-header" id="headingOne<?= $value['id_joint'] ?>">
                  <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne_<?= $value['id_joint'] ?>" aria-expanded="true" aria-controls="collapseOne_<?= $value['id_joint'] ?>">
                      <center>
                        <h5>Attachment List <i class="fas fa-angle-double-down"></i></h5>
                      </center>
                    </button>
                  </h5>
                </div>
                <div class="modal fade" id="preview" tabindex="-1" role="dialog" aria-labelledby="previewLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="previewLabel">Images Preview</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <img src="https://<?= $url_image ?>/pcms_v2_photo/fab_img/<?= $value_att_c['filename'] ?>" class="src" style="width: 100% !important">
                      </div>
                      <div class="modal-footer">
                        <span type="button" class="btn btn-secondary" data-dismiss="modal">Close</span>
                      </div>
                    </div>
                  </div>
                </div>
                <script type="text/javascript">
                  function setSrc(src){
                    $('.src').attr("src", "https://<?= $url_image ?>/pcms_v2_photo/fab_img/"+src);
                    $('#preview').modal('show'); 
                  }
                </script>
                <div id="collapseOne_<?= $value['id_joint'] ?>" class="collapse fade" aria-labelledby="headingOne<?= $value['id_joint'] ?>" data-parent="#accordionExample<?= $value['id_joint'] ?>">
                  <div class="card-body">
                    <div class="col-md-6 table-responsive accordion" style="height: 300px !important">
                      <table class="table table-bordered dataTable">
                        <thead>
                          <tr class="bg-info text-white">
                            <th>NO</th>
                            <th>File</th>
                            <th>Remarks</th>
                          </tr>
                          <tbody>
                          <?php $no = 1; foreach ($attachment_client_data as $key => $value_att_c) { ?>
                            <?php if($value['id_visual']==$value_att_c['id_process']){ ?>
                          <tr>
                            <td><?= $no++; ?></td>

                            <td>
                              <?= $value_att_c['filename'] ?>
                              <span class="btn btn-secondary" onclick="setSrc('<?= $value_att_c["filename"] ?>')">
                                <i class="fas fa-camera"></i>
                              </span>
                            </td>

                            <td><?= $value_att_c['remarks'] ?></td>
                          </tr>
                          <?php } } ?>
                          </tbody>
                        </thead>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
          <?php } elseif($enable_modify=='client' AND $value['status_inspection']==6){ ?>
            <br>
                <center><span class="badge badge-danger" style="margin-top: 0cm"><h6 style="margin-top: 0cm !important"><b>Rejected</b></h6></span></center>
            <br>

            <!-- ===========================  -->
            <div class="my-3 p-3 bg-white rounded shadow-sm text-left" style="margin-top: 0">
              <div class="row">
                <div class="col">
                  <strong>Inspected Client By</strong>
                  <strong> : </strong>
                  <strong><u><?= $user_list[$value['inspection_client_by']]['full_name'] ?></u></strong>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <strong>Inspected Client On</strong>
                  <strong> : </strong>
                  <strong><u><?= DATE('d F, Y H:i A', strtotime($value['inspection_client_datetime'])) ?></u></strong>
                </div>
              </div>
            </div>
            <!-- ========================== -->
          <?php } elseif($enable_modify=='client' AND $value['status_inspection']==7){?>
            <br>
                <center><span class="badge badge-success" style="margin-top: 0cm"><h6 style="margin-top: 0cm !important"><b>Accepted</b></h6></span></center>
            <br>
            <!-- ===========================  -->
            <div class="my-3 p-3 bg-white rounded shadow-sm text-left" style="margin-top: 0">
              <div class="row">
                <div class="col">
                  <strong>Inspected Client By</strong>
                  <strong> : </strong>
                  <strong><u><?= $user_list[$value['inspection_client_by']]['full_name'] ?></u></strong>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <strong>Inspected Client On</strong>
                  <strong> : </strong>
                  <strong><u><?= DATE('d F, Y H:i A', strtotime($value['inspection_client_datetime'])) ?></u></strong>
                </div>
              </div>
            </div>
            <!-- ========================== -->
          <?php } elseif($enable_modify=='client' AND $value['status_inspection']==9){?>
            <br>
                <center><span class="badge badge-primary" style="margin-top: 0cm"><h6 style="margin-top: 0cm !important"><b>Accepted and Release with Comment</b></h6></span></center>
            <br>
            <!-- ===========================  -->
            <div class="my-3 p-3 bg-white rounded shadow-sm text-left" style="margin-top: 0">
              <div class="row">
                <div class="col">
                  <strong>Inspected Client By</strong>
                  <strong> : </strong>
                  <strong><u><?= $user_list[$value['inspection_client_by']]['full_name'] ?></u></strong>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <strong>Inspected Client On</strong>
                  <strong> : </strong>
                  <strong><u><?= DATE('d F, Y H:i A', strtotime($value['inspection_client_datetime'])) ?></u></strong>
                </div>
              </div>
            </div>
            <!-- ========================== -->
          <?php } elseif($enable_modify=='client' AND $value['status_inspection']==10){?>
            <br>
                <center><span class="badge badge-info" style="margin-top: 0cm"><h6 style="margin-top: 0cm !important"><b>Postponed</b></h6></span></center>
            <br>
            <!-- ===========================  -->
            <div class="my-3 p-3 bg-white rounded shadow-sm text-left" style="margin-top: 0">
              <div class="row">
                <div class="col">
                  <strong>Inspected Client By</strong>
                  <strong> : </strong>
                  <strong><u><?= $user_list[$value['inspection_client_by']]['full_name'] ?></u></strong>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <strong>Inspected Client On</strong>
                  <strong> : </strong>
                  <strong><u><?= DATE('d F, Y H:i A', strtotime($value['inspection_client_datetime'])) ?></u></strong>
                </div>
              </div>
            </div>
            <!-- ========================== -->
          <?php } elseif($enable_modify=='client' AND $value['status_inspection']==11){?>
            <br>
                <center><span class="badge badge-warning" style="margin-top: 0cm"><h6 style="margin-top: 0cm !important"><b>Re-Offer</b></h6></span></center>
            <br>
            <!-- ===========================  -->
            <div class="my-3 p-3 bg-white rounded shadow-sm text-left" style="margin-top: 0">
              <div class="row">
                <div class="col">
                  <strong>Inspected Client By</strong>
                  <strong> : </strong>
                  <strong><u><?= $user_list[$value['inspection_client_by']]['full_name'] ?></u></strong>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <strong>Inspected Client On</strong>
                  <strong> : </strong>
                  <strong><u><?= DATE('d F, Y H:i A', strtotime($value['inspection_client_datetime'])) ?></u></strong>
                </div>
              </div>
            </div>
            <!-- ========================== -->
          <?php } elseif($enable_modify=='client' AND $value['revision_status_inspection']==1){?>
            <br>
                <center><span class="badge badge-secondary" style="margin-top: 0cm"><h6 style="margin-top: 0cm !important"><b>Under Request For Update</b></h6></span></center>
            <br>
            <!-- ========================== -->
            <!-- ========================== -->
          <?php } elseif($enable_modify=='client' AND $value['status_inspection']==1){ ?>
            <br>
                <center><span class="badge badge-secondary" style="margin-top: 0cm"><h6 style="margin-top: 0cm !important"><b>On Revise Progress</b></h6></span></center>
            <br>
          <?php } ?>
        </div>

        <?php } ?>
        <?php if($enable_modify!='client'){ ?>
          <div class="row" id="add_drawing_container">
            <div class="col-md-12">
              <div class="my-3 p-3 bg-white rounded shadow-sm">
                <div class="overflow-auto media text-muted">
                  <div class="container-fluid text-right p-0">
                    <div class="btn-group_dele" role="group" aria-label="Basic example">
                      <?php
                        $wmt = MAX(array_column($inspection_detail, 'transmit_wm_rev'));
                        if($wmt!=''){
                          $transmit_wm_rev = $wmt;
                        } else {
                          $transmit_wm_rev = MAX(array_merge(array_column($inspection_detail, 'transmit_wm_rev'), array_column($inspection_detail, 'rev_wm_template')));
                        }
                      ?>
                      
                      <?php 
                          $links_atc = base_url_ftp_eng()."public_smoe/open_atc/2/".strtr($this->encryption->encrypt($drawing_val_2[$joint_list[$inspection_detail[0]['id_joint']]['drawing_wm']]['id']), '+=/', '.-~').'/'.$transmit_wm_rev.'/1e0e7b33a7be53e7c9957eb27914726c8df5a3127a78009723415681dce804ee076d678b2f809f42b8417bf8007fec6d58455b4beae15f6a17e384122be4fe71kbm4o296X67afS9s6puvP6qvwqy7y8TaO5sgWrvULiU-';  
                          $links_atc_cross = base_url_ftp_eng()."public_smoe/open_atc_cross/2/".strtr($this->encryption->encrypt($joint_list[$inspection_detail[0]['id_joint']]['drawing_wm']), '+=/', '.-~')."/".strtr($this->encryption->encrypt($drawing_val_2[$joint_list[$inspection_detail[0]['id_joint']]['drawing_wm']]['id']), '+=/', '.-~').'/'.$transmit_wm_rev.'/1e0e7b33a7be53e7c9957eb27914726c8df5a3127a78009723415681dce804ee076d678b2f809f42b8417bf8007fec6d58455b4beae15f6a17e384122be4fe71kbm4o296X67afS9s6puvP6qvwqy7y8TaO5sgWrvULiU-';  
                      ?>
                        <a target='_blank' href='<?= $links_atc ?>' class='btn btn-primary text-white' title='Attachment'><i class='fas fa-paperclip'></i> File Drawing</a>
                        <a target='_blank' href='<?= $links_atc_cross ?>' class='btn btn-success text-white' title='Attachment' download='<?= $joint_list[$inspection_detail[0]['id_joint']]['drawing_wm'] ?>.pdf'><i class='fas fa-cloud-download-alt'></i> Download Drawing </a>
                      <?php //} ?>

                      <?php if($allow_revise==1){ ?>
                        <?php if($user_permission[41]==1){ ?>
                          <badge name="submit_visual" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-edit"></i> Request for Update</badge>
                        <?php } ?>
                      <?php } else { ?>
                        <?php if($reapproval=='reapproval'){ ?>
                          <badge name="submit_visual" class="btn btn-warning" onclick="approve_request('<?= $inspection_detail[0]['submission_id'] ?>', 3)"><i class="fa fa-check"></i> Close</badge>
                          <script type="text/javascript">
                            function approve_request(submission_id, aksi){
                              Swal.fire({
                                title: 'Are you sure to Reapproval this Update!',
                                text: "This submission will reset to status pending approval!",
                                type: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, Update this date!'
                              }).then((result) => {

                                if (result.value) {
                                  $.ajax({
                                    url: "<?= base_url('visual/approve_request/') ?>",
                                    type: "post",
                                    data: {
                                      'submission_id': submission_id,
                                      'status_revise': aksi,
                                    },
                                    success: function(data){
                                      Swal.fire(
                                        'Data Has Been Updated !',
                                        '',
                                        'success'
                                      ).then(function() {
                                          
                                          location.reload();
                                          return false;
                                      });
                                    }
                                  });
                                }
                              })
                            }
                          </script>
                        <?php } ?>

                          <?php if($user_permission[40]==1){ //for SMOE Approval ?>
                            <button type="submit" name="submit_visual" class="btn btn-primary btn-lg <?= $button_save_qc ?>" onsubmit="relod()"><i class="fas fa-save"></i> Save</button>
                            <script type="text/javascript">
                              function relod(){
                                location.reload()
                              }
                            </script>
                          <?php } ?>

                      <?php } ?>
                        <a href="<?= base_url('visual/visual_pdf/').$inspection_detail[0]['submission_id'].'/qc/'.$inspection_detail[0]['drawing_no'] ?>" class="btn btn-danger btn-lg"> <i class="fas fa-file-pdf"></i> Report
                        </a>

                    </div>
                  </div>
                  <div class="fl-scrolls fl-scrolls-hidden" data-orientation="horizontal" style="width: 1564px; left: 286px;"><div style="width: 1564px;">
                  </div></div></div>
              </div>
            </div>
          </div>
        <?php } elseif($enable_modify=='client'){ ?>
          <div class="row" id="add_drawing_container">
            <div class="col-md-12">
              <div class="my-3 p-3 bg-white rounded shadow-sm">
                <div class="overflow-auto media text-muted">
                  <div class="container-fluid text-right p-0">
                    <div class="btn-groups" role="group" aria-label="Basic example">

                      <?php
                        $wmt = MAX(array_column($inspection_detail, 'transmit_wm_rev'));
                        if($wmt!=''){
                          $transmit_wm_rev = $wmt;
                        } else {
                          $transmit_wm_rev = MAX(array_merge(array_column($inspection_detail, 'transmit_wm_rev'), array_column($inspection_detail, 'rev_wm_template')));
                        }
                      ?>
                      
                      <?php 
                          $links_atc = base_url_ftp_eng()."public_smoe/open_atc/2/".strtr($this->encryption->encrypt($drawing_val_2[$joint_list[$inspection_detail[0]['id_joint']]['drawing_wm']]['id']), '+=/', '.-~').'/'.$transmit_wm_rev.'/1e0e7b33a7be53e7c9957eb27914726c8df5a3127a78009723415681dce804ee076d678b2f809f42b8417bf8007fec6d58455b4beae15f6a17e384122be4fe71kbm4o296X67afS9s6puvP6qvwqy7y8TaO5sgWrvULiU-';  
                          $links_atc_cross = base_url_ftp_eng()."public_smoe/open_atc_cross/2/".strtr($this->encryption->encrypt($joint_list[$inspection_detail[0]['id_joint']]['drawing_wm']), '+=/', '.-~')."/".strtr($this->encryption->encrypt($drawing_val_2[$joint_list[$inspection_detail[0]['id_joint']]['drawing_wm']]['id']), '+=/', '.-~').'/'.$transmit_wm_rev.'/1e0e7b33a7be53e7c9957eb27914726c8df5a3127a78009723415681dce804ee076d678b2f809f42b8417bf8007fec6d58455b4beae15f6a17e384122be4fe71kbm4o296X67afS9s6puvP6qvwqy7y8TaO5sgWrvULiU-';  
                      ?>
                        <a target='_blank' href='<?= $links_atc ?>' class='btn btn-primary text-white' title='Attachment'><i class='fas fa-paperclip'></i> File Drawing</a>
                        <a target='_blank' href='<?= $links_atc_cross ?>' class='btn btn-success text-white' title='Attachment' download='<?= $joint_list[$inspection_detail[0]['id_joint']]['drawing_wm'] ?>.pdf'><i class='fas fa-cloud-download-alt'></i> Download Drawing </a>
                      <?php //} ?>

                    <?php if($user_cookie[7]==8 OR $user_cookie[7]==1){ ?>
                      <button type="submit" name="submit_visual" class="btn btn-primary <?= $button_save_client ?>"
                        <?= (!in_array(1, $overall_status) AND !in_array(2, $overall_status) AND !in_array(8, $overall_status)) ? '' : 'disabled title="On Revise Progress"' ?>
                        ><i class="fa fa-save"></i> Save</button>
                    <?php } ?>

                      <?php //test_var($reapproval, 1) ?>
                    <?php if($reapproval=='reapproval'){ ?>
                      <button type="submit" name="submit_visual" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                    <?php } ?>

                      <a href="<?= base_url('visual/visual_pdf/').$inspection_detail[0]['report_number'].'/client/'.$inspection_detail[0]['drawing_no'].'/'.(int)$inspection_detail[0]['postpone_reoffer_no'] ?>" class="btn btn-danger"><i class="fas fa-file-pdf"></i> Report</a> 
                    </div>
                  </div>
                  <div class="fl-scrolls fl-scrolls-hidden" data-orientation="horizontal" style="width: 1564px; left: 286px;"><div style="width: 1564px;">
                  </div></div></div>
              </div>
            </div>
          </div>
        <?php } ?>
      </form>
    </div>  
  </div> 
</div> 
</div>
</div></div> 

  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Request for Update</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="<?php echo base_url('visual/request_for_update') ?>">
            <div class="form-group">
              <label for="inspector_before">Last Inspector By</label>
              <input type="text" class="form-control" id="inspector_before" value="<?= $user_list[$inspection_detail[0]['inspection_by']]['full_name'] ?>" readonly>
              <input name="inspector_before" type="hidden" value="<?= $inspection_detail[0]['inspection_by'] ?>" readonly>
            </div>
            <div class="form-group">
              <label for="requestor">Request By</label>
              <input type="text" class="form-control" id="requestor" placeholder="" value="<?= $user_list[$user_cookie[0]]['full_name'] ?>" readonly>
              <input name="requestor" type="hidden" value="<?= $user_cookie[0] ?>" readonly>
              <input name="submission_id" type="hidden" value="<?= $inspection_detail[0]['submission_id'] ?>" readonly>
            </div>
            <div class="form-group">
              <label for="reason">Reason</label>
              <textarea class="form-control" id="reason" placeholder="Reasons for update" name="reason"></textarea>
            </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>



  </div>

  <script type="text/javascript">
    function required_remarks(no, thiss, con){

      console.log(con, 'ini')
      if(con==7){
        $('.accepted_remarks').removeClass('d-none')
        $('.accepted_remarks').removeAttr('disabled');
      } else {
        $('.accepted_remarks').addClass('d-none')
        $('.accepted_remarks').prop('disabled', true);
      }

      if(con==6){
        console.log('1')
        $('.client_remarks'+no).prop('required', true);
        $('.client_remarks'+no).removeAttr('disabled');
      } else if(con==2 || con==4) {
        console.log('2')
        $('.reject_pending_remarks'+no).prop('required', true);
        $('.reject_pending_remarks'+no).prop('disabled', false);
      } else {
        console.log('3')
        $('.client_remarks'+no).removeAttr('required');
        $('.client_remarks'+no).prop('disabled', true);
      } 
    }
    $('.dataTable').DataTable({
      order: [],
      columnDefs: [{
        "targets": 0,
        "orderable": false,
      }]
    })
  </script> 