<div id="content" class="container-fluid">

  <style type="text/css">
    .disabled-effect {
      pointer-events: none;
      opacity:0.5;
    }
  </style>

  <?php error_reporting(0) ?>
  
  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white">
          <form method="POST" action="<?php echo base_url() ?>ndt_live/send_to_vendor" id="form_submition">

        	<!-- <div class=""> -->
        		<!-- <form method="POST" action="<?= base_url('planning_bnp/create_rfi_internal_proceed') ?>"> -->
		          <!-- <div class="col-12"> -->
		            <!-- <div class="card shadow my-3 rounded-0"> -->
		              <!-- <div class="card-header">
		                <h6 class="m-0">RFI - INSPECTION NOTIFICATION</h6>
		              </div> -->
		              <!-- <div class="card-body bg-white"> -->
		                <div class="col-12 <?= $class ?>">
		                  <div class="form-group">
		                    <div class="row">
		                      <div class="col-md-12">
		                        <strong><i>NDT RFI FORM</i></strong>
		                      </div>
		                      <div class="col-md-12"><br></div>
                    
                    			<div class="col-md-6">
				                    <div class="form-group row">
				                      <label for="" class="col-xl-3 col-form-label text-muted">Method</label>
				                      <div class="col-xl">
				                        <select class="select2 form-control" name="ndt_type[]" required="">
				                          <option value="">---</option>
				                          <?php foreach ($master_ndt as $key => $value) { ?>
				                            <option value="<?=  $value['id'] ?>"><?= $value['ndt_initial'].' ('.$value['ndt_description'].')' ?></option>
				                          <?php } ?>
				                        </select>
				                      </div>
				                    </div>
				                  </div>

				                  <div class="col-md-6">
				                    <div class="form-group row">
				                      <label for="" class="col-xl-3 col-form-label text-muted">Vendor NDT</label>
				                      <div class="col-xl">
				                        <select class="select2 form-control" name="vendor[]" required="">
				                          <option value="">---</option>
				                          <?php foreach ($vendor as $value_vendor) {?>
				                            <option value="<?= $value_vendor['id_company'] ?>"><?= $value_vendor['company_name'] ?></option>
				                          <?php } ?>
				                        </select>
				                      </div>
				                    </div>
				                  </div>

			                    <div class="col-md-6">
						                <div class="form-group row">
						                  <label for="" class="col-xl-3 col-form-label text-muted">Notes</label>
						                  <div class="col-xl">
						                    <textarea class="form-control" name="note"></textarea>
						                  </div>
						                </div>
						              </div>

		                      <div class="col-md-12"><hr></div>

		                      <div class="col-md-6 mt-2">
		                        <div class="form-group row">
		                          <label for="" class="col-xl-3 col-form-label text-muted">Inspector Name</label>
		                          <div class="col-xl">
		                            <select name="inspector_id" class="select2" style="width: 100%" disabledno required>
		                              <option value="">---</option>
		                              <?php foreach ($user_list as $key => $value) : ?>
		                                <option value="<?= $value['id_user'] ?>" <?= $value['id_user']==$main[0]['inspector_id'] ? 'selected' : '' ?>><?= $value['full_name'] ?></option>
		                              <?php endforeach; ?>
		                            </select>
		                          </div>
		                        </div>
		                      </div>

		                      <div class="col-md-6 mt-2">
		                        <div class="form-group row">
		                          <label for="" class="col-xl-3 col-form-label text-muted">Company Assigned</label>
		                          <div class="col-xl">
		                            <select name="rfi_company_assigned" class="select2" style="width: 100%" required disabledno>
		                              <option value="">---</option>
		                              <?php foreach ($company_list as $key => $value) : ?>
		                                <option value="<?= $value['id_company'] ?>" <?= $value['id_company']==$main[0]['id_vendor'] ? 'selected' : '' ?>><?= $value['company_name'] ?></option>
		                              <?php endforeach; ?>
		                            </select>
		                          </div>
		                        </div>
		                      </div>

		                      <div class="col-md-6">
		                        <div class="form-group row">
		                          <label for="" class="col-xl-3 col-form-label text-muted">Submitted Date</label>
		                          <div class="col-xl">
		                            <input type="date" name="submitted_date" class="form-control" disabledno required value="<?= $main[0]['submitted_date'] ? DATE('Y-m-d', strtotime($main[0]['submitted_date'])) : '' ?>">
		                          </div>
		                        </div>
		                      </div>
		                      
		                      <div class="col-md-6">
		                        <div class="form-group row">
		                          <label for="" class="col-xl-3 col-form-label text-muted">Inspect Date from</label>
		                          <div class="col-xl">
		                            <input type="date" name="inspection_date" class="form-control" required disabledno value="<?= $main[0]['inspection_date'] ? DATE('Y-m-d', strtotime($main[0]['inspection_date'])) : '' ?>">
		                          </div>
		                        </div>
		                      </div>

		                      <div class="col-md-6">
		                        <div class="form-group row">
		                          <label for="" class="col-xl-3 col-form-label text-muted">Inspect Date to</label>
		                          <div class="col-xl">
		                            <input type="date" name="inspection_date_to" class="form-control" required disabledno value="<?= $main[0]['inspection_date_to'] ? DATE('Y-m-d', strtotime($main[0]['inspection_date_to'])) : '' ?>">
		                          </div>
		                        </div>
		                      </div>

		                      <div class="col-md-6">
		                        <div class="form-group row">
		                          <label for="" class="col-xl-3 col-form-label text-muted">Inspect Area</label>
		                          <div class="col-xl">
						                    <select class="select2 will_enable" name="area" required>
						                      <option value="">---</option>
						                      <?php foreach ($area_v2 as $value_area) {?>
						                        <option value="<?= $value_area['id'] ?>"><?= $value_area['name'] ?></option>
						                      <?php } ?>
						                    </select>
						                  </div>
		                        </div>
		                      </div>

		                      <div class="col-md-6">
		                        <div class="form-group row">
		                          <label for="" class="col-xl-3 col-form-label text-muted">Inspect Location</label>
		                          <div class="col-xl">
						                    <select class="select2 will_enable" name="location" required>
						                      <option value="">---</option>
						                      <?php foreach ($location_v2 as $value_location) {?>
						                        <option value="<?= $value_location['id'] ?>" data-chained="<?php echo $value_location['id_area'] ?>"><?= $value_location['name'] ?></option>
						                      <?php } ?>
						                    </select>
						                  </div>
		                        </div>
		                      </div>
		                      <script type="text/javascript">
		                        $("select[name=location]").chained("select[name=area]");
		                      </script>
		                      
		                      <div class="col-md-6">
		                        <div class="form-group row">
		                          <label for="" class="col-xl-3 col-form-label text-muted">Inspect Qty</label>
		                          <div class="col-xl">
		                            <input type="number" name="qty" class="form-control" disabledno required value="<?= $main[0]['qty'] ?>">
		                          </div>
		                        </div>
		                      </div>

		                      <div class="col-md-12"><hr></div>
		                      <?php //test_var($irn_tag, 1) ?>
		                      <div class="col-md-6">
		                        <div class="form-group row">
		                          <label for="" class="col-xl-3 col-form-label text-muted">Expected Time</label>
		                          <div class="col-xl">
		                            <input type='text' class='form-control' name="expected_time" value="<?= $rfi_detail[0]['expected_time'] ?>" required>
		                          </div>
		                        </div>
		                      </div> 

		                      <div class="col-md-6">
						                <div class="form-group row">
						                  <label for="" class="col-xl-3 col-form-label text-muted">Invitation Type</label>
						                  <div class="col-xl">
						                    <select name="status_invitation" class="select2" style="width:100%" required>
						                      <option value="0">Invitation Witness</option>
						                      <option value="1">Notification Activity</option>
						                    </select>
						                  </div>
						                </div>
		                      </div>

		                      <div class="col-md-6">
		                        <div class="form-group row">
		                          <label for="" class="col-xl-3 col-form-label text-muted">ITP Intervention to Employer</label>
		                          <div class="col-xl">
		                            <select class="form-control select2" style="width:100%" name="legend_inspection_auth[]" multiple="" required>
		                              <option value="1" <?= in_array(1, explode(';', $rfi_detail[0]['legend_inspection_auth'])) ? 'selected' : '' ?>>Hold Point</option>
		                              <option value="2" <?= in_array(2, explode(';', $rfi_detail[0]['legend_inspection_auth'])) ? 'selected' : '' ?>>Witness</option>
		                              <option value="3" <?= in_array(3, explode(';', $rfi_detail[0]['legend_inspection_auth'])) ? 'selected' : '' ?>>Monitoring</option>
		                              <option value="4" <?= in_array(4, explode(';', $rfi_detail[0]['legend_inspection_auth'])) ? 'selected' : '' ?>>Review</option>
		                            </select>
		                          </div>
		                        </div>
		                      </div>

		                      <div class="col-md-6">
		                        <div class="form-group row">
		                          <label for="" class="col-xl-3 col-form-label text-muted">Result</label>
		                          <div class="col-xl">
		                            <input type='text' class='form-control' name="result" value="<?= $rfi_detail[0]['result'] ?>" required>
		                          </div>
		                        </div>
		                      </div> 

		                      <div class="col-md-6 ">
		                        <div class="form-group row">
		                          <label for="" class="col-xl-3 col-form-label text-muted">Tag Description</label>
		                          <div class="col-xl">
		                            <textarea class='form-control' name="tag_description_pickling"><?= $rfi_detail[0]['tag_description'] ?></textarea>
		                            <small class="text-danger"><i><strong>*Fill this Column for Item/Tag Description</strong></i></small>
		                          </div>
		                        </div>
		                      </div>

		                    </div>
		                  </div>
		                </div>
		                <hr>
		                <?php foreach ($main as $key => $value) { ?>
		                  <input type="hidden" name="id[]" value="<?= $value['id_bnp'] ?>">
		                <?php } ?>
		                <table class="table table-bordered table-hover" id="tbl_rfi_detail">
		                  <thead>
		                    <tr class="bg-gray-table">
		                      <th><center>ITEM / TAG NUMBER</center></th>
		                      <th><center>ITEM / TAG DESCRIPTION</center></th>
		                      <th>
		                        <button type='button' class="btn btn-sm btn-primary <?= $main[0]['status_invitation']==1 ? 'd-none' : '' ?>" onclick="add_row_rfi()"><i class="fas fa-plus"></i></button></th>
		                    </tr>
		                  </thead>

		                  <tbody>
		                    <?php if($rfi_detail){ ?>
		                      <?php foreach ($rfi_detail as $key => $value) : ?>
		                        <?php //test_var($value); ?>
		                        <tr>
		                          <td>
		                            <input type='text' class='form-control' disabled value='<?php echo $value["tag_no"] ?>'>
		                          </td>
		                          <td>
		                            <?php //if($main[0]['id_paint_system']!=11 AND 1==2){ ?>
		                              <input type='text' class='form-control' disabled value='<?php echo $value["tag_description"] ?>'>
		                            <?php //} ?>
		                          </td>
		                          <td>
		                            <?php if ($this->user_cookie[7] != 8) { ?>
		                              <button type='button' class='btn btn-danger <?= $main[0]['status_invitation']==1 ? 'd-none' : '' ?>' onclick='delete_data_rfi_detail(this, "<?php echo $value["id"] ?>")'>
		                                <i class='fas fa-trash-alt'></i>
		                              </button>
		                            <?php } ?>
		                          </td>
		                          
		                        </tr>
		                      <?php endforeach; ?>
		                    <?php } else { ?>
		                      <?php foreach ($irn_tag as $key => $value) : ?>
		                        <?php //test_var($value) ?>
		                        <tr>
		                          <td>
		                            <input type='text' class='form-control' required name='tag_no[<?= $key ?>]' value='<?php echo $value["item_tag_no"] ?>'>
		                          </td>
		                          <td>
		                            <input type='text' class='form-control' required name='tag_description[<?= $key ?>]' value='<?php echo $value["item_tag_description"] ?>'>
		                          </td>
		                          <td>
		                            <?php if ($this->user_cookie[7] != 8) { ?>
		                              <?php //if($key==0){ ?>
		                                <button type='button' class='btn btn-danger' onclick='delete_row_rfi_detail(this, "<?php echo $value["id"] ?>")'>
		                                  <i class='fas fa-trash-alt'></i>
		                                </button>
		                              <?php //} ?>
		                            <?php } ?>
		                          </td>
		                          
		                        </tr>
		                      <?php endforeach; ?>
		                    <?php } ?>
		                  </tbody>

		                </table>
		                <!-- <button type="submit" class="btn btn-primary <?= $main[0]['status_invitation']==1 ? 'd-none' : '' ?>"><i class="fas fa-save"></i> Save RFI</button> -->

		              <!-- </div> -->
		            <!-- </div> -->
		          <!-- </div> -->
		        <!-- </form> -->
        	<!-- </div> -->

          <!-- <form method="POST" action="<?php echo base_url() ?>ndt_live/send_to_vendor"> -->
            <?php if($submitted!='submitted'){ ?>
              <div class="row">
              <div class="col-6">

              <input type="hidden" name="status_internal" class="form-control" value="<?= $status_internal ?>" required>

              <!-- <div class="col-md-12"></div>
              <div class="col mt-2">
                <div class="form-group row">
                  <label for="" class="col-xl-3 col-form-label text-muted">Inspector Name</label>
                  <div class="col-xl">
                    <select name="inspector_id" class="select2" style="width: 100%" required>
                      <option value="">---</option>
                      <?php foreach ($user_list as $key => $value): ?>
                      <option value="<?= $value['id_user'] ?>"><?= $value['full_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-12"></div>
              <div class="col">
                <div class="form-group row">
                  <label for="" class="col-xl-3 col-form-label text-muted">Inspect Date</label>
                  <div class="col-xl">
                    <input type="date" name="inspect_date" class="form-control" value="<?= date('Y-m-d') ?>" required>
                  </div>
                </div>
              </div>
              <div class="col-md-12"></div>
              <div class="col">
                <div class="form-group row">
                  <label for="" class="col-xl-3 col-form-label text-muted">Inspect Time</label>
                  <div class="col-xl">
                    <input type="time" name="inspect_time" class="form-control" value="<?= date('H:i:s') ?>" required>
                  </div>
                </div>
              </div>

              <div class="col-md-12"></div>
              <div class="col">
                <div class="form-group row">
                  <label for="" class="col-xl-3 col-form-label text-muted">Inspect Area</label>
                  <div class="col-xl">
                    <select class="select2 will_enable" name="area">
                      <option value="">---</option>
                      <?php foreach ($area_v2 as $value_area) {?>
                        <option value="<?= $value_area['id'] ?>"><?= $value_area['name'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-12"></div>
              <div class="col">
                <div class="form-group row">
                  <label for="" class="col-xl-3 col-form-label text-muted">Inspect Location</label>
                  <div class="col-xl">
                    <select class="select2 will_enable" name="location">
                      <option value="">---</option>
                      <?php foreach ($location_v2 as $value_location) {?>
                        <option value="<?= $value_location['id'] ?>" data-chained="<?php echo $value_location['id_area'] ?>"><?= $value_location['name'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              <script type="text/javascript">
                $("select[name=location]").chained("select[name=area]");
              </script>

              <div class="col-md-12"></div>
              <div class="col">
                <div class="form-group row">
                  <label for="" class="col-xl-3 col-form-label text-muted">Invitation Type</label>
                  <div class="col-xl">
                    <select name="status_invitation" class="select2" style="width:100%" required>
                      <option value="0">Invitation Witness</option>
                      <option value="1">Notification Activity</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-md-12"></div>
              <div class="col">
                <div class="form-group row">
                  <label for="" class="col-xl-3 col-form-label text-muted">Legend Inspection Authority AS PER ITP</label>
                  <div class="col-xl">
                    <select name="legend_inspection_auth[]" class="form-control select2" style="width:100%" required multiple="">
                        <option value="1">Hold Point</option>
                        <option value="2">Witness</option>
                        <option value="3">Monitoring</option>
                        <option value="4">Review</option>
                    </select>
                  </div>
                </div>
              </div> -->

              <!-- <div class="col-md-12"></div>
              <div class="col">
                <div class="form-group row">
                  <label for="" class="col-xl-3 col-form-label text-muted">Notes</label>
                  <div class="col-xl">
                    <textarea class="form-control" name="note"></textarea>
                  </div>
                </div>
              </div> -->

            </div>

              <div class="col-6">
                <!-- <div class="row card"> -->
                  <!-- <div class="col"> -->
                    <!-- <span style="color:red;font-weight: bold;font-style: italic;">Please select NDT Methods</span>
                    <br> -->

                    <!-- <div class="form-group row">
                      <label for="" class="col-xl-3 col-form-label text-muted">Method</label>
                      <div class="col-xl">
                        <select class="select2 form-control" name="ndt_type[]" required="">
                          <option value="">---</option>
                          <?php foreach ($master_ndt as $key => $value) { ?>
                            <option value="<?=  $value['id'] ?>"><?= $value['ndt_initial'].' ('.$value['ndt_description'].')' ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div> -->

                    <!-- <div class="form-group row">
                      <label for="" class="col-xl-3 col-form-label text-muted">Vendor NDT</label>
                      <div class="col-xl">
                        <select class="select2 form-control" name="vendor[]" required="">
                          <option value="">---</option>
                          <?php foreach ($vendor as $value_vendor) {?>
                            <option value="<?= $value_vendor['id_company'] ?>"><?= $value_vendor['company_name'] ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div> -->

                  <!-- </div> -->
                <script type="text/javascript">
                  function validate(ini, id_me){

                    if($(ini).prop("checked") == true){
                      console.log('nge centang')
                      $('.vendor_'+id_me).prop('required', true)
                    } else {
                      console.log('nge un centang')
                      $('.vendor_'+id_me).prop('required', false)
                    }

                    $('.submit').removeClass('d-none')
                    if($('.ndt_check:checkbox:checked').length > 0){
                      console.log('ada')
                      $('.submit').prop("disabled", false)
                    } else {
                      console.log('gak ada')
                      $('.submit').prop("disabled", true)
                    }
                  }
                </script>
              </div>

            </div>

            <!-- <strong class="text-danger text-center">
              By Default Showing Joint Repair Only!
            </strong> -->

            <hr>
            <?php } ?>
            <style type="text/css">
              .blink_me {
                animation: blinker 2s linear infinite;
              }

              @keyframes blinker {
                50% {
                  opacity: 0;
                }
              }
            </style>
            <div class="overflow-auto">
              <table class="table table-hover text-center dataTable" width="100%">
                <thead class="bg-gray-table table-bordered">
                  <tr>
                    <th rowspan="2"></th>
                    <th rowspan="2">Visual Report Number</th>
                    <th rowspan="2">Drawing Weld Map</th>
                    <th rowspan="2">Joint No.</th>
                    <th rowspan="2">Weld Type Code</th>
                    <th rowspan="2">Joint Class</th>
                    <th rowspan="2">Weld Date</th>
                    
                    <th rowspan="2">Length</th>
                    <th rowspan="2">Welded Length</th>
                    <th rowspan="2">Request Tested Length</th>

                    <th rowspan="2">Material Grade #1</th>
                    <th rowspan="2">Material Grade #2</th>
                    <th rowspan="1" colspan="3">Visual Inspection</th>
                    <th rowspan="1" colspan="15">
                      RFI NDT
                      <!-- <br>
                      <span class="badge badge-warning">
                        <small class="">
                          <i><b>*Joints with requirement NDT marked with checklist</b></i>
                        </small>
                      </span> -->
                    </th>
                  </tr>
                  <tr class="table-bordered">
                    <th rowspan="1">By</th>
                    <th rowspan="1">Date</th>
                    <th rowspan="1">Location</th>

                    <th rowspan="1">MT</th>
                    <th rowspan="1">UT</th>
                    <th rowspan="1">RT</th>
                    <th rowspan="1">PT</th>
                    <th rowspan="1">UTT</th>
                    <th rowspan="1">HT</th>
                    <th rowspan="1">FT</th>
                    <th rowspan="1">PMI</th>
                    <th rowspan="1">PWHT</th>
                    <th rowspan="1">RI</th>
                    <th rowspan="1">MTCC</th>
                    <th rowspan="1">PTCC</th>
                    <th rowspan="1">UTCC</th>
                    <th rowspan="1">UTTCC</th>
                    <th rowspan="1">RTCC</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($list as $key => $value): ?>
                    <?php //test_var($value); ?>
                  <?php $juml = count($list) ?>
                  <tr <?= $submitted=='submitted' ? (strtotime(DATE('Y-m-d H:i:s'))-strtotime($value['ndt_transmittal_datetime'])>43200 ? 'class=""' : '') : '' ?> >

                    <td style="vertical-align: middle;">
                      <?php if(($value['validator_auth']!=1 AND ($value['irn_status_inspection']!=7 OR $value['irn_status_inspection']!=9)) OR in_array($this->user_cookie[0], $transmitter_wo_irn)){ ?>
                        <div class="custom-control custom-checkbox mr-sm-2 div_<?= $key ?>">
                          <input type="checkbox" class="custom-control-input cb<?= $key ?> <?= $value['drawing_no'] ?>" id="customControlAutosizing<?= $key ?>" name="id[<?= $key ?>]" value='<?php echo $value['id_visual'] ?>' onclick='enable_edit("<?= $key ?>", this,"<?= $value['drawing_no'] ?>")'>
                          <label class="custom-control-label" for="customControlAutosizing<?= $key ?>"></label>
                        </div>
                      <?php } else { ?>
                        <span class="badge badge-warning">
                          <i class="fas fa-times"></i>
                           IRN Approved
                        </span>
                      <?php } ?>
                    </td>

                    <td class="align-middle">
                      <?= $master_report_no[$value['discipline']][$value['module']][$value['type_of_module']].$value['report_number'].' <b>Rev. '.str_pad($value['postpone_reoffer_no'], 2, 0, STR_PAD_LEFT).'</b>' ?>
                      <?php if($value['postpone_reoffer_no']>0){ ?>
                        <span class="btn btn-warning btn-sm blink_me" title="Please Make Sure this Joint Not Transmitted Yet!">
                          <i class="fas fa-info-circle"></i>
                        </span>
                      <?php } ?>
                      <?php  
                        if($value['status_inspection']==0){
                          $status_c = 'Production RFI';
                        } elseif($value['status_inspection']==1){
                          $status_c = 'Pending Approval QC';
                          if($value['revision_status_inspection']==1){
                            $status_c = 'Pending Approval (Template Revise)';
                          }
                        } elseif($value['status_inspection']==2){
                          $status_c = 'Rejected';
                        } elseif($value['status_inspection']==4){
                          $status_c = 'Pending by QC';
                        } elseif($value['status_inspection']==8){
                          $status_c = 'Request for Update';
                        } elseif($value['status_inspection']==3){
                          $status_c = 'Approved QC';
                        } elseif($value['status_inspection']==5){
                          $status_c = 'Pending Approval Client';
                        } elseif($value['status_inspection']==6){
                          $status_c = 'Rejected Client';
                        } elseif($value['status_inspection']==7){
                          if($value['status_invitation']==1){
                            $status_c = 'Reviewed Client';
                          } else {
                            $status_c = 'Accepted Client';
                          }
                        } elseif($value['status_inspection']==8){
                          $status_c = 'Request for Update';
                        } elseif($value['status_inspection']==9){
                          $status_c = 'Accepted and Release with Comment';
                        } elseif($value['status_inspection']==10){
                          $status_c = 'Postponed';
                        } elseif($value['status_inspection']==11){
                          $status_c = 'Re-Offer';
                        }
                      ?>
                        <br>
                        <span class="badge badge-info"><?= $status_c ?></span>
                    </td>
                    <td class="align-middle"><?= $value['drawing_wm'].' (Rev. '.number_format($value['drawing_rev']).')' ?></td>
                    <td class="align-middle"><?= $value['joint_no'].($value['revision']>0 ? '('.$value['revision_category'].$value['revision'].')' : '') ?></td>
                    <td class="align-middle"><?= $weld_type_code[$value['weld_type']] ?></td>
                    <td class="align-middle"><?= $class[$value['class']] ?></td>
                    <td class="align-middle"><?= DATE('d F, Y', strtotime($value['weld_datetime'])) ?></td>

                    <td class="align-middle"><?= $value['length'] ?></td>
                    <td class="align-middle"><?= $value['length_of_weld'] ?></td>
                    <td class="align-middle">
                      <input 
                        type="number" 
                        class="form-control cb<?= $key ?> <?= $value['drawing_no'] ?>" 
                        name="transmittal_request_tested_length[<?= $key ?>]" 
                        value='<?= $value['length_of_weld'] ?>'
                        max='<?= $value['length_of_weld'] ?>'
                      >
                    </td>

                    <td class="align-middle"><?= $material_grade[$value['pos_1']] ?></td>
                    <td class="align-middle"><?= $material_grade[$value['pos_2']] ?></td>
                    <td class="align-middle"><?= $user_list[$value['visual_inspection_by']]['full_name'] ?></td>
                    <td class="align-middle"><?= $value['visual_inspection_date'] ?></td>
                    <td class="align-middle">
                      <?php if(isset($value["area_v2"])){ ?>
                        <?= $area_name_arr_v2[$value['area_v2']]?>,<?= $location_name_arr_v2[$value['location_v2']] ?>                        
                      <?php } else { ?>
                        <?= $location_list[$value['visual_location']]['location_name'] ?>
                      <?php } ?>
                    </td>
                      <style type="text/css">
                        .disabled-select {
                          background-color: #d5d5d5;
                          opacity: 0.5;
                          border-radius: 3px;
                          cursor: not-allowed;
                          position: absolute;
                          top: 0;
                          bottom: 0;
                          right: 0;
                          left: 0;
                        }
                        select[readonly].select2-hidden-accessible + .select2-container {
                          pointer-events: none;
                          touch-action: none;
                        }

                        select[readonly].select2-hidden-accessible + .select2-container .select2-selection {
                          background: #eee;
                          box-shadow: none;
                        }

                        select[readonly].select2-hidden-accessible + .select2-container .select2-selection__arrow,
                        select[readonly].select2-hidden-accessible + .select2-container .select2-selection__clear {
                          display: none;
                        }
                      </style>
                    <td class="align-middle">
                      <b>
                      <?php 
                          if($ndt_submit[2][$value['id_visual']]){
                            echo '<i class="fas fa-check"></i>';
                          } else {
                            echo "-";
                          }
                        ?>
                      </b>
                    </td>
                    <td class="align-middle">
                      <b>
                      <?php 
                          if($ndt_submit[3][$value['id_visual']]){
                            echo '<i class="fas fa-check"></i>';
                          } else {
                            echo "-";
                          }
                        ?>
                      </b>
                    </td>
                    <td class="align-middle">
                      <b>
                      <?php 
                          if($ndt_submit[1][$value['id_visual']]){
                            echo '<i class="fas fa-check"></i>';
                          } else {
                            echo "-";
                          }
                        ?>
                      </b>
                    </td>
                    <td class="align-middle">
                      <b>
                      <?php 
                          if($ndt_submit[7][$value['id_visual']]){
                            echo '<i class="fas fa-check"></i>';
                          } else {
                            echo "-";
                          }
                        ?>
                      </b>
                    </td>
                    <td class="align-middle">
                      <b>
                      <?php 
                          if($ndt_submit_cc[4][$value['id_visual']]){
                            echo '<i class="fas fa-check"></i>';
                          } else {
                            echo "-";
                          }
                        ?>
                      </b>
                    </td>
                    <td class="align-middle">
                      <b>
                      <?php 
                          if($ndt_submit_cc[5][$value['id_visual']]){
                            echo '<i class="fas fa-check"></i>';
                          } else {
                            echo "-";
                          }
                        ?>
                      </b>
                    </td>
                    <td class="align-middle">
                      <b>
                      <?php 
                          if($ndt_submit_cc[6][$value['id_visual']]){
                            echo '<i class="fas fa-check"></i>';
                          } else {
                            echo "-";
                          }
                        ?>
                      </b>
                    </td>
                    <td class="align-middle">
                      <b>
                      <?php 
                          if($ndt_submit_cc[8][$value['id_visual']]){
                            echo '<i class="fas fa-check"></i>';
                          } else {
                            echo "-";
                          }
                        ?>
                      </b>
                    </td>
                    <td class="align-middle">
                      <b>
                      <?php 
                          if($ndt_submit_cc[9][$value['id_visual']]){
                            echo '<i class="fas fa-check"></i>';
                          } else {
                            echo "-";
                          }
                        ?>
                      </b>
                    </td>
                    <td class="align-middle">
                      <b>
                      <?php 
                          if($ndt_submit_cc[10][$value['id_visual']]){
                            echo '<i class="fas fa-check"></i>';
                          } else {
                            echo "-";
                          }
                        ?>
                      </b>
                    </td>
                    <td class="align-middle">
                      <b>
                      <?php 
                          if($ndt_submit_cc[11][$value['id_visual']]){
                            echo '<i class="fas fa-check"></i>';
                          } else {
                            echo "-";
                          }
                        ?>
                      </b>
                    </td>
                    <td class="align-middle">
                      <b>
                      <?php 
                          if($ndt_submit_cc[12][$value['id_visual']]){
                            echo '<i class="fas fa-check"></i>';
                          } else {
                            echo "-";
                          }
                        ?>
                      </b>
                    </td>
                    <td class="align-middle">
                      <b>
                      <?php 
                          if($ndt_submit_cc[13][$value['id_visual']]){
                            echo '<i class="fas fa-check"></i>';
                          } else {
                            echo "-";
                          }
                        ?>
                      </b>
                    </td>
                    <td class="align-middle">
                      <b>
                      <?php 
                          if($ndt_submit_cc[14][$value['id_visual']]){
                            echo '<i class="fas fa-check"></i>';
                          } else {
                            echo "-";
                          }
                        ?>
                      </b>
                    </td>
                    <td class="align-middle">
                      <b>
                      <?php 
                          if($ndt_submit_cc[15][$value['id_visual']]){
                            echo '<i class="fas fa-check"></i>';
                          } else {
                            echo "-";
                          }
                        ?>
                      </b>
                    </td>

                  </tr>
                  
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <br>
            <div class="col-md-4">
              <div class="row mb-1">
                <div class="col-md-12">
                  <button type="submit" name="submit" value="draft" class="btn btn-primary submit"><i class='fas fa-paper-plane'></i> Send to Vendor</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php //endif; ?>

</div>
</div><!-- ini div dari sidebar yang class wrapper -->
<script>
  var what_ga_is_selected

  $("select[name=module]").chained("select[name=project]");

  $('.dataTable').on( 'draw.dt', function () {
    $('.select2').select2({
      theme: 'bootstrap'
    });
    console.log(what_ga_is_selected)
    if (typeof what_ga_is_selected !== "undefined") {
      lock_one_ga(what_ga_is_selected)
    }
  });

  $('.dataTable').DataTable({
    order: [],
    columnDefs: [{
      // "targets": 0,
      // "orderable": false,
    }]
  })

  $(".autocomplete_doc").autocomplete({
    source: function( request, response ) {
      $.ajax( {
        url: "<?php echo base_url() ?>visual/autocomplete_drawing",
        dataType: "json",
        data: {
          term: request.term,
          drawing_type: 1,

          project :project_js,
          discipline  :discipline_js,
          module  :module_js,
          type_of_module  :type_module_js,
        },
        success: function( data ) {
          response( data );
          get_data_drawing(ui.item.value);
        }
      });
    },
    select: function (event, ui) {
      var value = ui.item.value;
      if(value == 'No Data.'){
        ui.item.value = "";
      }
      else{
        get_data_drawing(ui.item.value);
      }
    }
  });

  $(".autocomplete_wm").autocomplete({
    source: function( request, response ) {
      console.log('wm autc')
      $.ajax( {
        url: "<?php echo base_url() ?>visual/autocomplete_drawing",
        dataType: "json",
        data: {
          term: request.term,
          drawing_type: 2,

          project :project_js,
          discipline  :discipline_js,
          module  :module_js,
          type_of_module  :type_module_js,
        },
        success: function( data ) {
          response( data );
          get_data_drawing(ui.item.value);
        }
      });
    },
    select: function (event, ui) {
      var value = ui.item.value;
      if(value == 'No Data.'){
        ui.item.value = "";
      }
      else{
        get_data_drawing(ui.item.value);
      }
    }
  });

  function get_data_drawing(document_no) {
    var module = $("select[name=module]").val();
    $.ajax( {
      url: "<?php echo base_url() ?>engineering/get_data_drawing",
      dataType: "json",
      data: {
        document_no: document_no,
        module: module,
      },
      success: function(data) {
        console.log(data);
        if(data.drawing_type == 1 || data.drawing_type == 2){
          $("select[name=project]").val(data.project).trigger('change');
          $("select[name=discipline]").val(data.discipline);
          $("select[name=drawing_type]").val(data.drawing_type);
          if(module == ""){
            $("select[name=module]").val(data.module);
          }
        }
      }
    });
  }

  var selecteds = 0
  var identic

  function lock_one_ga(dwg) {
    var total = '<?= $juml ?>';
    var i;
    for (i = 0; i < total; i++) {
      if (!$('.cb' + i).hasClass(dwg)) {
        $('.cb' + i).prop("disabled", true);
        $('.div_' + i).attr('title', 'Different GA/AS');
      }
    }
  }

  function add_row_rfi() {
    // var table;
    table = "<tr>" +
      "<td><input type='text' class='form-control' required name='tag_no[]'><input type='hidden' name='id_detail[]'></td>" +

      <?php if($main[0]['id_paint_system']!=11 AND 1==2){ ?>
        "<td><input type='text' class='form-control' required name='tag_description[]'></td>" +
      <?php } else { ?>
        "<td></td>" +
      <?php } ?>

      "<td><button type='button' class='btn btn-danger' onclick='delete_row_rfi_detail(this)'><i class='fas fa-trash-alt'></i></button></td>" +
      "<tr>";
    // angka++
    $("#tbl_rfi_detail tbody").append(table);
    $(".select2").select2()
  }

  function delete_row_rfi_detail(btn) {
    $(btn).closest("tr").remove();
  }

  $("#form_submition").on('submit', function() {
    Swal.fire({
      title: "PROCESSING ...",
      html: `Please Don't Close This Window`,
      onBeforeOpen() {
        Swal.showLoading()
      },
      allowOutsideClick: false
    })
  })

  function enable_edit(no, thiss, dwg){
    console.log(dwg)
    // if(thiss.checked==true){
    //   selecteds++

    //   what_ga_is_selected = dwg

    //   var total = '<?= $juml ?>';
    //   var i;

    //   for (i = 0; i < total; i++) {
    //     if (!$('.cb' + i).hasClass(dwg)) {
    //       $('.cb' + i).prop("disabled", true);
    //       $('.div_' + i).attr('title', 'Different GA/AS');
    //     }
    //   }
    // } else {
    //   selecteds--

    //   var total = '<?= $juml ?>';
    //   var i;

    //   if (selecteds == 0) {
    //     for (i = 0; i < total; i++) {
    //       $('.cb' + i).prop("disabled", false);
    //       $('.div_' + i).attr('title', '');
    //     }
    //   }
    // }
  }
</script>