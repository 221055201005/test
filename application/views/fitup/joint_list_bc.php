<style type="text/css">
  
  .table {
    font-size: 100% !important;
    padding: 2px !important;
  }

  #MySelect {
    width: 100% !important;
  }

  input[type=checkbox]
  {
    -ms-transform: scale(1.5); /* IE */
    -moz-transform: scale(1.5); /* FF */
    -webkit-transform: scale(1.5); /* Safari and Chrome */
    -o-transform: scale(1.5); /* Opera */
    padding: 10px;
  }

	#detail_card {
	    font-size: 12px;
	}

	.card-box {
	    position: relative;
	    color: #fff;
	    padding: 1px 5px 2px;
	    margin: 10px 0px;
	    text-align: left;
	    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
	}

	.card-box:hover {
	    text-decoration: none;
	    color: #f1f1f1;
	    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
	}

	.card-box:hover .icon i {
	    font-size: 100px;
	    transition: 1s;
	    -webkit-transition: 1s;
	}

	.card-box .inner {
	    padding: 5px 10px 0 10px;
	}

	.card-box h3 {
	    font-size: 17px;
	    font-weight: bold;
	    margin: 0 0 1px 0;
	    white-space: nowrap;
	    padding: 0;
	    text-align: left;
	}

	.card-box p {
	    font-size: 11px;
	}

	.card-box .icon {
	    position: absolute;
	    top: auto;
	    bottom: 5px;
	    right: 5px;
	    z-index: 0;
	    font-size: 50px;
	    color: rgba(0, 0, 0, 0.15);
	}

	.card-box .card-box-footer {
	    position: absolute;
	    left: 0px;
	    bottom: 0px;
	    text-align: center;
	    padding: 3px 0;
	    color: rgba(255, 255, 255, 0.8);
	    background: rgba(0, 0, 0, 0.1);
	    width: 100%;
	    text-decoration: none;
	}

  .card-box:hover .card-box-footer {
      background: rgba(0, 0, 0, 0.3);
  }

  .bg-blue {
      background-color: #0031d1 !important;
  }

  .bg-green {
      background-color: #00a65a !important;
  }

  .bg-orange {
      background-color: #f39c12 !important;
  }

  .bg-red {
      background-color: #d9534f !important;
  }

   

  .bg-red-2 {
      background-color: #b80000 !important;
  }
  a[aria-expanded=true] .fa-angle-double-down {
   display: none;
  }

  a[aria-expanded=false] .fa-angle-double-up {
    display: none;
  }
</style>

<script type='text/javascript'>
  function show_image(btn, source, type) {
		if (type == "client") {
		  var url = "<?= $this->link_server ?>/pcms_v2_photo/fab_img/" + source
		} else {
		  var url = "<?= $this->link_server ?>/pcms_v2_photo/" + source
		}
		var image_content = `
		  <div class="row">
		    <div class="col-md-12">
		      <img src="${url}" style="width : 100%">
		    </div>
		    <div class="col-md-12">
		      <hr>
		      <div class="float-right">
		        <button class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
		      </div>
		    </div>
		  </div>
		`
		$("#modal").modal({
		  show: true,
		  keyboard: false,
		  backdrop: "static"
		}).find('.modal-body').html(image_content)
		$('.modal-title').text("Attachment")
		$('.modal-dialog').addClass('modal-lg')
	}
</script>

<div id="content" class="container-fluid"> 

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
            <a class="btn btn-primary" data-toggle="collapse" href="#collapseButton" role="button" aria-expanded="false" aria-controls="collapseButton">Filter &nbsp; <i class="fas fa-angle-double-down"></i><i class="fas fa-angle-double-up"></i></a>
        </div>
        <div class="collapse <?= $this->input->post() ? 'show' : '' ?>" id="collapseButton"> 
        <div class="card-body bg-white overflow-auto">
          <form action="" method="POST" id='form-filter'>
            <div class="row">

              <div class="col-6 d-none">
                <div class="form-group row">
                 <label class="col-xl-3 col-form-label text-muted font-weight-bold">Workpack Number</label>
                  <div class="col-xl">
                    <select class="form-control" name="workpack_number">
                      <option value="">---</option>
                      <?php foreach($workpack_list as $value){ ?>
                        <option value="<?= $value['id'] ?>" <?php echo (@$get['workpack_number'] == $value['id'] ? 'selected' : '') ?>><?= $value['workpack_no'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-12"></div>

               <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label text-muted ">Project ID</label>
                  <div class="col-xl">
                    <select class="form-control" name="project" onchange="find_deck_by_project(this)" required>
                    <?php // if($this->is_admin == 1){ ?>
                        <option value="">---</option>
                      <?php // } ?>
                      <?php foreach ($project_list as $key => $value) : ?>
                        <?php if($this->is_admin == 1){ ?>
                         <option value="<?php echo $value['id'] ?>" <?php echo (@$get['project'] == $value['id'] ? 'selected' :  '') ?>><?php echo $value['project_name'] ?></option>
                        <?php } else { ?>
                          <?php if(in_array($value['id'], $this->user_cookie[13])){ ?>
                            <option value="<?php echo $value['id'] ?>" <?php echo (@$get['project'] == $value['id'] ? 'selected' :  '') ?>><?php echo $value['project_name'] ?></option>
                          <?php } ?>
                        <?php } ?> 
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label text-muted ">Discipline</label>
                  <div class="col-xl">
                    <select class="form-control" name="discipline" >
                      <option value="">---</option>
                      <?php foreach ($discipline_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo (@$get['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label text-muted ">Module</label>
                  <div class="col-xl">
                    <select class="form-control" name="module" >
                      <option value="">---</option>
                      <?php foreach ($module_list as $key => $value) : ?>
                      <option value="<?php echo $value['mod_id'] ?>" data-chained="<?php echo $value['project_id'] ?>" <?php echo (@$get['module'] == $value['mod_id'] ? 'selected' : '') ?>><?php echo $value['mod_desc'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label text-muted ">Type of Module</label>
                  <div class="col-xl">
                   <select class="form-control" name="type_of_module" disabled>
                      <option value="">---</option>
                      <?php foreach ($type_of_module_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo (@$get['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>             
            </div>

            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label text-muted ">Drawing Type</label>
                  <div class="col-xl">
                    <select class="form-control" name="drawing_type" disabled>
                      <option value="">---</option>
                      <option value="1" <?php echo (@$get['drawing_type'] == '1' ? 'selected' : '') ?>>GA</option>
                      <option value="2" <?php echo (@$get['drawing_type'] == '2' ? 'selected' : '') ?>>Assembly</option> 
                      <option value="13" <?php echo (@$get['drawing_type'] == '13' ? 'selected' : '') ?>>Isometric</option>
                      <option value="9" <?php echo (@$get['drawing_type'] == '9' ? 'selected' : '') ?>>WM GA</option>
                      <option value="14" <?php echo (@$get['drawing_type'] == '14' ? 'selected' : '') ?>>WM AS</option>
                      <option value="12" <?php echo (@$get['drawing_type'] == '12' ? 'selected' : '') ?>>Pipe Support</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label text-muted ">Drawing Number</label>
                  <div class="col-xl">
                    <input type="text" class="form-control autocomplete_doc" name="drawing_no" value="<?php echo @$get['drawing_no'] ?>"  <?php if(isset($status_client_rejected)){ ?> readonly <?php } ?>>
                    <span style="color:red;font-weight: bold;font-style: italic;">Please choice Drawing Number</span>
                  </div>
                </div>
              </div>
            </div>

            
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                <label class="col-md-4 col-lg-3 col-form-label text-muted ">Weld Map Number</label>
                  <div class="col-xl">
                    <input type="text" class="form-control autocomplete_wm" name="drawing_wm" value="<?php echo @$get['drawing_wm'] ?>"   <?= isset($status_client_rejected) ? 'readonly' : '' ?>>
                   
                    <span style="color:red;font-weight: bold;font-style: italic;">Please choice Weld Map Number</span> 
                  </div>
                </div>
              </div>
            <!-- </div>
            <div class="row"> -->
            <?php if(!isset($status_client_rejected)){ ?>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label text-muted ">Joint Class</label>
                  <div class="col-xl">
                    <select class="form-control" name="joint_class">
                      <option value="">---</option>
                      <?php foreach ($list_of_class as $key => $value) { ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$get['joint_class'] == $value['id'] ? 'selected' : '') ?>><?php echo $value["class_name"]; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
            <?php } ?>
            <?php if($mode != 'transmittal'){ ?>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label text-muted ">Submission Status</label>
                  <div class="col-xl">
                    <select class="form-control" name="status_inspection"   required>
                      <option value="-" <?php echo (@$get['status_inspection'] == "-" ? 'selected' : '') ?>>---</option>
                      <option value="0" <?php echo (@$get['status_inspection'] == "0" ? 'selected' : '') ?>>Ready</option>
                      <option value="2" <?php echo (@$get['status_inspection'] == "2" ? 'selected' : '') ?>>Rejected</option>
                      <option value="4" <?php echo (@$get['status_inspection'] == "4" ? 'selected' : '') ?>>Pending By QC</option>
                    </select>
                  </div>
                </div>
              </div>
              <?php } else { ?>
                <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label text-muted ">Status Inspection</label>
                  <div class="col-xl">
                    <select class="form-control" name="status_inspection"   required>
                      <?php if(!isset($status_client_rejected)){ ?>
                      <option value="3" selected="">Approved QC</option>
                      <?php } else { ?>
                        <?php if(@$get['status_inspection'] == '6'){ ?>
                          <option value="6" <?php echo (@$get['status_inspection'] == "6" ? 'selected' : '') ?>>Rejected Client</option>
                        <?php } else if(@$get['status_inspection'] == '9'){ ?>
                          <option value="9" <?php echo (@$get['status_inspection'] == "9" ? 'selected' : '') ?>>Approved & Released With Comment</option>  
                        <?php } else { ?>
                          <option value="11" <?php echo (@$get['status_inspection'] == "11" ? 'selected' : '') ?>>Re-Offer By Client</option>
                        <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              <?php } ?>
            <div class="col-6">
              <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label text-muted ">Company </label>
                <div class="col-xl">
                  <select class="form-control select2" name="company_id"   onchange='autofilter(this);'>
                    <option value=''>~ Choose ~</option>
                    <?php foreach($company_list as $key => $value){ ?>
                      <?php if(in_array($value['id_company'], $this->user_cookie[14])){ ?>

                        <option value='<?= $value['id_company'] ?>' <?= ($value['id_company'] == @$get['company_id'] ? "selected" : '') ?>><?= $value['company_name'] ?></option>
                      <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>

          </div>

          <div class="row">
            <div class="col-6">
              <div class="form-group row">
                <label class="col-md-4 col-lg-3 col-form-label text-muted ">Welding Type</label>
                <div class="col-xl">
                  <select class="form-control" name="weld_type"  onchange='autofilter(this);'>
                    <option value="">---</option>
                    <?php foreach($list_of_weld_type as $key => $value){ ?>
                      <option value="<?= $value['id']; ?>" <?= ($value['id'] == @$get['weld_type'] ? "selected" : "") ?>><?= $value['weld_type']; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-6 <?= $get['project'] == 21 ? null : 'd-none' ?>" id="div_deck">
              <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label text-muted ">Deck Elevation / Service Line</label>
                <div class="col-xl">
                  <select class="form-control" name="deck_elevation" id="deck_change" onchange='autofilter(this);'>
                    <option value="">---</option>
                    <?php foreach($deck_list as $key => $value){ ?>
                      <option value="<?= $value['id']; ?>" <?= ($value['id'] == @$get['deck_elevation'] ? "selected" : "") ?>><?= $value['name']; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <?php if ($mode != "transmittal"){ ?> 

          <div class="row">
            <!-- <div class="col-6">
              <div class="form-group row">
                <label class="col-md-4 col-lg-3 col-form-label text-muted ">Status Surveyor</label>
                <div class="col-xl">
                  <select name="status_surveyor" class="form-control select2"  onchange='autofilter(this);'>
                    <option value="">---</option>
                    <option value="not_update" <?= "not_update"==@$get['status_surveyor'] ? 'selected' : '' ?>>No Status Surveyor</option>
                    <?php foreach ($surveyor_status as $key => $value){?>
                      <option value="<?= $value['id'] ?>" <?= $value['id']==@$get['status_surveyor'] ? 'selected' : '' ?>><?= $value['description'] ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div> -->
            <div class="col-6">
              <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label text-muted "> </label>
                <div class="col-xl">
                  
                </div>
              </div>
            </div>
          </div>
          <?php } ?>

            <div class="row">
              
              <div class="col-6">
                <div class="form-group row">                  
                  <div class="col-xl">
                    <?php if($mode != 'transmittal'){ ?>
                      <div class="container  text-right">
                        <!-- <div class="row">                      
                          <div class="col-lg-3">
                              <div class="card-box bg-green">
                                  <div class="inner">
                                      <h3> <?= $total_ready ?> <?= ($total_ready > 0 ? "Joint's" : "Joint" ) ?></h3>
                                      <span id='detail_card'>Ready</span>
                                  </div>
                              </div>
                          </div>
                          <div class="col-lg-3">
                              <div class="card-box bg-blue">
                                  <div class="inner">
                                      <h3> <?= $total_pending ?> <?= ($total_pending > 0 ? "Joint's" : "Joint" ) ?></h3>
                                      <span id='detail_card'>Pending QC</span>
                                  </div>
                              </div>
                          </div>
                          <div class="col-lg-3">
                              <div class="card-box bg-red">
                                  <div class="inner">
                                  <h3> <?= $total_reject ?> <?= ($total_reject > 0 ? "Joint's" : "Joint" ) ?></h3>
                                  <span id='detail_card'>Rejected QC</span>
                                  </div>
                              </div>
                          </div>
                          <div class="col-lg-3">
                              <div class="card-box bg-secondary">
                                  <div class="inner">
                                  <h3> <?= $total_all_joint ?> <?= ($total_all_joint > 0 ? "Joint's" : "Joint" ) ?></h3>
                                  <span id='detail_card'>All Status (Except Ready)</span>
                                  </div>
                              </div>
                          </div>
                        </div> -->
                      </div>
                    <?php } ?>
                  </div>
                </div>
                
              </div> 
            </div>

            <div class="row">
              <div class="col-12 text-right">
                <hr>
                  <button id='button_search' class="mt-2 btn btn-sm btn-flat btn-info"><i class="fas fa-search"></i> Search</button>
                  <button type="button" class="mt-2 btn btn-sm btn-flat btn-warning" onclick="reset_pages();"><i class="fas fa-sync-alt"></i> Reset</button>
              </div>            
            </div>
          </form>
        </div>
      </div>
    </div>
    </div>
  </div>



  <?php if(isset($joint_list)){ ?>


<?php if($mode != 'transmittal'){ ?>

<form action="<?php echo base_url(); ?>fitup/insert_data_fitup" method='POST' id="form_submition">
	<?php // test_var($joint_list[0]) ?>
  <input type='hidden' name='company_for_submission_id' value='<?php echo $joint_list[0]["wp_company"] ?>'>
  <input type='hidden' name='deck_elevation_save' value='<?php echo $joint_list[0]["deck_elevation"] ?>'>

  <?php if(sizeof($joint_list) > 0 AND isset($get['project']) && isset($get['drawing_no']) && !empty($get['drawing_no']) && isset($get['drawing_wm']) && !empty($get['drawing_wm'])){ ?>

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">Additional Form Detail</h6>
        </div>
        <div class="card-body bg-white overflow-auto">                                
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Requestor</label>
                  <div class="col-xl">
                   <input type="text" class="form-control" name="requestor_name" value="<?php echo $user_cookie['1'] ?>" required readonly>
                  </div>
                </div>
              </div> 
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Area</label>
                  <div class="col-xl">
                      <select class="select2 will_enable" name="area" required>
                        <option value="">---</option>
                        <?php foreach ($area_name_list_v2 as $value_area) {?>
                          <option value="<?= $value_area['id'] ?>" <?php if($joint_list[0]['area_v2'] == $value_area['id']){ echo "selected"; } ?>><?= $value_area['name'] ?></option>
                        <?php } ?>
                      </select> 
                  </div>
                </div>
              </div> 
            </div>

            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Request Date</label>
                  <div class="col-xl">
                   <input type="text" class="form-control" name="request_date" value="<?php echo  date("d F Y H:i:s"); ?>" required readonly>
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Location</label>
                  <div class="col-xl">
                      <select class="select2 will_enable" name="location" required>
                        <option value="">---</option>
                        <?php foreach ($location_name_list_v2 as $value_location) {?>
                          <option value="<?= $value_location['id'] ?>" data-chained="<?php echo $value_location['id_area'] ?>" <?php if($joint_list[0]['location_v2'] == $value_location['id']){ echo "selected"; } ?>><?= $value_location['name'] ?></option>
                        <?php } ?>
                      </select>  
                  </div>
                </div>
              </div> 
            </div>

            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Requestor Company</label>
                  <div class="col-xl">
                   <input type="text" class="form-control" name="requestor_company" value="<?= $company_name[$joint_list[0]["wp_company"]] ?>" required readonly>
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Point</label>
                  <div class="col-xl">
                      <select class="select2 will_enable" name="point">
                        <option value="">---</option>
                        <?php foreach ($point_list as $value_point) {?>
                          <!-- <option value="<?= $value_location['id'] ?>" data-chained="<?php echo $value_location['id_area'] ?>" <?php if($joint_list[0]['location_v2'] == $value_location['id']){ echo "selected"; } ?>><?= $value_location['name'] ?></option> -->

                          <option value="<?= $value_point['id'] ?>" data-chained="<?php echo $value_point['id_location'] ?>" <?php if($joint_list[0]['point_v2'] == $value_point['id']){ echo "selected"; } ?>><?= $value_point['name'] ?></option>
                        <?php } ?>
                      </select>  
                  </div>
                </div>
              </div> 
            </div>

        </div>
      </div>
    </div>
  </div>

  <?php } ?>

  <?php } else { ?>

    <?php if((@$get['status_inspection'] != '6' AND @$get['status_inspection'] != '11' AND @$get['status_inspection'] != '9')){ ?>
      
      <form action="<?php echo base_url(); ?>fitup/update_data_fitup" method='POST' id="form_submition">

        <input type="hidden" name="project_rn" value="<?php echo @$get['project'] ?>">
        <input type="hidden" name="discipline_rn" value="<?php echo @$get['discipline'] ?>">
        <input type="hidden" name="module_rn" value="<?php echo @$get['module'] ?>">
        <input type="hidden" name="type_of_module_rn" value="<?php echo @$get['type_of_module'] ?>">
        <input type="hidden" name="report_number" value="<?php echo @$joint_list[0]['report_number'] ?>">
        <input type="hidden" name="area_v2" value="<?php echo @$joint_list[0]['area_v2'] ?>">
        <input type="hidden" name="area" value="<?php echo @$joint_list[0]['area'] ?>">
        <input type="hidden" name="location_v2" value="<?php echo @$joint_list[0]['location_v2'] ?>">
        <input type="hidden" name="company_id_rn" value="<?php echo @$joint_list[0]['wp_company'] ?>">
        <input type="hidden" name="deck_elevation_rn" value="<?php echo @$joint_list[0]['deck_elevation'] ?>">
        

    <?php } else if(@$get['status_inspection'] == '11' OR @$get['status_inspection'] == '9'){ ?>  
 
      <form action="<?php echo base_url(); ?>fitup/process_reoffer_retransmitted" method='POST' id="form_submition">

        <input type="hidden" name="project_rn"        value="<?php echo @$get['project'] ?>">
        <input type="hidden" name="drawing_no_rn"     value="<?php echo @$get['drawing_no'] ?>">        
        <input type="hidden" name="discipline_rn"     value="<?php echo @$get['discipline'] ?>">
        <input type="hidden" name="module_rn"         value="<?php echo @$get['module'] ?>">
        <input type="hidden" name="type_of_module_rn" value="<?php echo @$get['type_of_module'] ?>">
        <input type="hidden" name="report_number" value="<?php echo @$joint_list[0]['report_number'] ?>">
        <input type="hidden" name="status_retransmitted" value="<?php echo @$joint_list[0]['status_retransmitted'] ?>">
        <input type="hidden" name="postpone_reoffer_no" value="<?php echo @$joint_list[0]['postpone_reoffer_no'] ?>">
        <input type="hidden" name="area_v2" value="<?php echo @$joint_list[0]['area_v2'] ?>">
        <input type="hidden" name="area" value="<?php echo @$joint_list[0]['area'] ?>">
        <input type="hidden" name="location_v2" value="<?php echo @$joint_list[0]['location_v2'] ?>">

    <?php } else if(@$get['status_inspection'] == '6'){ ?> 

      <form action="<?php echo base_url(); ?>fitup/insert_data_fitup" method='POST' id="form_submition">

      <input type='hidden' name='company_for_submission_id' value='<?php echo $joint_list[0]["wp_company"] ?>'>

        <?php if(sizeof($joint_list) > 0){ ?>

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">Additional Form Detail</h6>
        </div>
        <div class="card-body bg-white overflow-auto">                                
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Request Date</label>
                  <div class="col-xl">
                   <input type="text" class="form-control" name="request_date" value="<?php echo  date("d F Y H:i:s"); ?>" required readonly>
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Requestor</label>
                  <div class="col-xl">
                   <input type="text" class="form-control" name="requestor_name" value="<?php echo $user_cookie['1'] ?>" required readonly>
                  </div>
                </div>
              </div> 
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Requestor Company</label>
                  <div class="col-xl">
                   <input readonly type="text" class="form-control" name="requestor_company" value="PT SMOE" required readonly>
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Area </label>
                  <div class="col-xl">
                      <select class="select2 will_enable" name="area" required>
                        <option value="">---</option>
                        <?php foreach ($area_name_list_v2 as $value_area) {?>
                          <option value="<?= $value_area['id'] ?>" <?php if($joint_list[0]['area_v2'] == $value_area['id']){ echo "selected"; } ?>><?= $value_area['name'] ?></option>
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
                  <label class="col-md-4 col-lg-3 col-form-label ">Location </label>
                  <div class="col-xl">
                      <select class="select2 will_enable" name="location" required>
                        <option value="">---</option>
                        <?php foreach ($location_name_list_v2 as $value_location) {?>
                          <option value="<?= $value_location['id'] ?>" data-chained="<?php echo $value_location['id_area'] ?>" <?php if($joint_list[0]['location_v2'] == $value_location['id']){ echo "selected"; } ?>><?= $value_location['name'] ?></option>
                        <?php } ?>
                      </select>
                  </div>
                </div>
              </div> 
            </div>

        </div>
      </div>
    </div>
  </div>
  <?php } ?>
    <?php } ?>  

<?php if(sizeof($joint_list) > 0 && ( isset($drawing_fltr) && !empty($drawing_fltr) )){ ?>
      <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">Additional Form Detail</h6>
        </div>
        <div class="card-body bg-white overflow-auto">                                
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Transmitted By</label>
                  <div class="col-xl">
                   <input type="hidden" class="form-control" name="transmitted_by" value="<?php echo $user_cookie['0'] ?>" required readonly>
                   <input type="text" class="form-control" name="transmitted_name" value="<?php echo $user_cookie['1'] ?>" required readonly>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Transmitted Date & Time</label>
                  <div class="col-xl">
                   <input type="text" class="form-control" name="transmitted_date" value="<?php echo date("d-F-y H:i:s"); ?>" required readonly>
                  </div>
                </div>
              </div> 
            </div>
            
        </div>
      </div>
    </div>
  </div>
  <?php } ?>
  <?php } ?>


  
    <input type="hidden" name="validated_double" value="<?php echo uniqid(); ?>">
    
    <input type="hidden" name="project_save" value="<?php echo @$get['project']; ?>">
    <input type="hidden" name="drawing_type_save" value="<?php echo @$get['drawing_type']; ?>">
    <input type="hidden" name="discipline_save" value="<?php echo @$get['discipline']; ?>">
    <input type="hidden" name="module_save" value="<?php echo @$get['module']; ?>">
    <input type="hidden" name="type_of_module_save" value="<?php echo @$get['type_of_module']; ?>">
    <input type="hidden" name="drawing_no_save" value="<?php echo @$get['drawing_no']; ?>">
    <input type="hidden" name="deck_elevation_save" value="<?php echo @$get['deck_elevation']; ?>">

    <input type="hidden" name="project_code" value="<?php echo @strtoupper($project_code[$get['project']]); ?>">
    <input type="hidden" name="discipline_code" value="<?php echo @strtoupper($discipline_code[$get['discipline']]); ?>">
    <input type="hidden" name="module_code" value="<?php echo @strtoupper($module_code[$get['module']]); ?>">
    <input type="hidden" name="type_of_module_code" value="<?php echo @strtoupper($type_of_module_code[$get['type_of_module']]); ?>">
    <input type="hidden" id='total_data_checked_val' name="total_data_checked_val" value='0'>

    <input type="hidden" class="form-control" name="wp_company" value="<?= @$joint_list[0]["wp_company"] ?>" required > 

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">Fit-Up | Joint for Submission</h6>
        </div>
        <div class="card-body bg-white">

        <input type="hidden" name="temporary_report_number" class="form-control" placeholder="Temporary Report Number" value='<?= (sizeof($missing_report_no) > 0 ? implode(",",$missing_report_no) : null )  ?>'>

              <?php if ($mode == "transmittal" && isset($drawing_fltr)): ?> 
              <div class="row">
              
              <?php if($this->user_cookie[0]=='1'){ ?>
                <div class="col-md-12">
                  <!-- <strong><i>Insert Report No</i></strong> -->
                </div>
                <div class="col-md-8 mt-2">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"></label>
                    <div class="col-xl">

                      <!-- <input type="hidden" name="temporary_report_number" class="form-control" placeholder="Temporary Report Number" value='<?= (sizeof($missing_report_no) > 0 ? implode(",",$missing_report_no) : null )  ?>'> -->
                      <?php if(isset($missing_report_no)){ ?> 
                        <br/> 
                        <div class='box red'>
                          Missing Report Number : 
                        </div> 
                        <div class='box red'>
                            <?php  
                              $i = 1;
                              echo '<table>'; 
                              echo '<tr>';
                              foreach($missing_report_no as $key => $value){
                                $report_show = str_pad($value, 6, '0', STR_PAD_LEFT);
                                echo '<td style="padding:10px;font-weight:bold;">'.$report_show.'</td>';
                                if($i % 10 == 0) {
                                  echo '</tr><tr>';
                                }
                                $i++;
                              }
                              echo '</table>';
                            ?> 
                        </div>
                      <?php } ?> 

                    </div>
                  </div>
                </div>
                
                <div class="col-md-12"></div>
                <?php } ?>   

                <div class="col-md-12">
                  <strong><i>Inspection Detail</i></strong>
                </div>
                            
                <?php $array_user_allowed = array(1,1000367,1000129,1001385,1000202,1000392,1000369,1001551); if(in_array($this->user_cookie[0],$array_user_allowed) && $get['discipline'] == 1){ ?>
                <div class="col-md-8 mt-2">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Manual Report Number</label>
                    <div class="col-xl"> 
                      <input type="number" name="manual_report_number" class="form-control" placeholder="Manual Report Number" >
                    </div>
                  </div>
                </div>
                <div class="col-md-12"></div>
                <?php } ?>

                <div class="col-md-8 mt-2">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Inspector Name</label>
                    <div class="col-xl">
                      <select name="inspector_id"  class="select2" style="width: 100%" required>
                        <option value="">---</option>
                        <?php foreach ($user_list_inspector as $key => $value): ?> 
                         <option value="<?= $value['id_user'] ?>"><?= $value['full_name'] ?></option>
                         <?php endforeach; ?>
                      </select>
                      <!-- <input type="text" name="inspector_id" class="form-control" onfocus="autocomplete_inspector(this)"  required> -->
                    </div>
                  </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-8">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Inspect Date</label>
                    <div class="col-xl">
                      <input type="date" name="inspect_date" class="form-control" value="<?= date('Y-m-d') ?>"
                        required>
                    </div>
                  </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-8">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Inspect Time</label>
                    <div class="col-xl">
                      <input type="time" name="inspect_time" class="form-control" value="<?= date('H:i:s') ?>"
                        required>
                    </div>
                  </div>
                </div>

                <!-- <div class="col-md-12"></div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Inspect Location</label>
                    <div class="col-xl">
                      <select name="inspect_location" class="select2" style="width:100%" required>
                        <?php foreach ($area_list as $key => $value): ?>
                        <option value="<?= $value['id'] ?>"><?= $value['area_name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div> -->
                
                <div class="col-md-12"></div>
                <div class="col-md-8">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Client Notification</label>
                    <div class="col-xl">
                      <select name="status_invitation" class="form-control" style="width:100%" required>
                          <option value="">~ Choice ~</option>
                          <option value="0">Notification - Client Invitation Witness</option>
                          <option value="1">Notification - SMOE Activity</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-8">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Legend Inspection Authority AS PER ITP</label>
                    <div class="col-xl">
                      <select name="legend_inspection_auth[]" class="select2" style="width:100%" multiple="" required>
                          <option value="">~ Choice ~</option>
                          <option value="0">Hold Point</option>
                          <option value="1">Witness</option>
                          <option value="2">Monitoring</option>
                          <option value="3">Review</option>
                      </select>
                    </div>
                  </div>
                </div>
                
                <div class="col-md-12"></div>
                <div class="col-md-8">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Drawing GA/AS - Rev No : </label>
                    <div class="col-xl">
                      <input type='hidden' name='drawing_wm_transmitted' value='<?= $get['drawing_wm'] ?>'>
                      <select name="drawing_rev_no_new" class="select2" style="width:100%" required onchange='append_drawing_links(this,0)'> 
                          <option value="">~ Choice ~</option>
                          <?php foreach($list_revision_ga_as as $key => $value){ ?> 
                            <option value='<?= $value ?>'><?= $value ?></option>
                          <?php } ?> 
                      </select>
                    </div>
                  </div>
                </div>
                
                <div class="col-md-12"></div>
                <div class="col-md-8">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"></label>
                    <div class="col-xl">
                    <span class='add_drawing_ga_as'>-</span>
                    </div>
                  </div>
                </div>

                <div class="col-md-12"></div>
                <div class="col-md-8">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Drawing Weld Map - Rev No : </label>
                    <div class="col-xl">
                        <select name="drawing_wm_rev_approved_new" class="select2" style="width:100%" required onchange='append_drawing_links(this,1)'>
                          <option value="">~ Choice ~</option> 
                          <?php foreach($list_revision_wm as $key => $value){ ?> 
                            <option value='<?= $value ?>'><?= $value ?></option>
                          <?php } ?>
                        </select>
                    </div>
                  </div>
                </div> 
                <div class="col-md-12"></div>
                <div class="col-md-8">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted"></label>
                    <div class="col-xl">
                    <span class='add_drawing_ga_wm'>-</span>
                    </div>
                  </div>
                </div>
                <div class="col-md-12"></div>
                <div class="col-md-8">
                  <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Remarks</label>
                    <div class="col-xl">
                      <textarea name="invitation_remarks" class="form-control"></textarea>
                    </div>
                  </div>
                </div>
         

              </div>
              <hr>
             <?php endif; ?>

          <?php if ($get['project'] || $get['drawing_no'] && $get['drawing_wm'] || $mode == 'transmittal'): ?> 
            <div class="overflow-auto">
            <?php if (isset($drawing_fltr)): ?> 
              <?php if (in_array(@$get['status_inspection'], array("-", "null", "2", "4"))){ ?>
              <b class="text-primary"><i class="fas fa-info-circle"></i> Checked <span id='total_data_checked'>0</span> Joint from maximum 50 Joint submission</b><br/><br/>
              <?php } ?>
              <?php if($mode == 'transmittal'){ ?>
                 <?php if(sizeof($joint_list) > 0){ ?>
                    <b class="text-primary"><i class="fas fa-info-circle"></i> Checked <span id='total_data_checked'>0</span> Joint from maximum 50 Joint submission</b><br/><br/>
                 <?php } ?>
              <?php } ?>

            <?php elseif (!isset($drawing_fltr)): ?>
                <?php if($mode == 'transmittal'){ ?>
                   <?php if(!isset($get['drawing_no']) OR !isset($get['drawing_wm'])){ ?>
                     <b class="text-primary"><i class="fas fa-info-circle"></i> You need to filter Drawing Number & Weld Map Number to start transmit RFI</b><br/><br/>
                  <?php } ?>
                <?php } else if($mode != 'transmittal'){ ?>
                  <?php if(!isset($get['drawing_no'])){ ?>
                     <b class="text-primary"><i class="fas fa-info-circle"></i> You need to filter drawing number to start submit RFI</b><br/><br/>
                  <?php } ?>
                <?php } ?>
            <?php endif; ?>

           
            <table class="table table-hover text-center dataTable">
              <thead class="bg-gray-table">
                <tr>
                  <?php if(isset($get['drawing_no']) && !empty($get['drawing_no']) && isset($get['drawing_wm']) && !empty($get['drawing_wm'])){ ?>
                  <th style="width: 10px !important;">#</th>
                  <?php } ?>
                  
                  <th style="width: 260px !important;">Project</th>

                  <th class="d-none" style="width: 260px !important;">Workpack No</th>
                  <?php if ($mode == "transmittal"){ ?> 
                  <th style="width: 260px !important;">Submission ID</th>
                  <?php } ?>
                  <th style="width: 260px !important;">Drawing Number</th>
                  <th style="width: 260px !important;">Weld Map Drawing Number</th>
                  <th style="width: 50px !important;">Joint No</th>
                  <th style="width: 155px !important;">Deck Elevation / Service Line</th>
                  <th style="width: 50px !important;">Weld Type</th>
                  <th style="width: 155px !important;">Part ID</th>
                  <th style="width: 190px !important;">Unique ID Number</th>
                  <th style="width: 80px !important;">Heat Number</th>
                  <th style="width: 95px !important;">Material Grade</th>
                  <th style="width: 95px !important;">Joint Class</th>
                  <th style="width: 15px !important;">Dia/Size</th>
                  <th style="width: 15px !important;">Sch</th>
                  <th style="width: 15px !important;">Thk<br/>(mm)</th>
                  
                  <th style="width: 15px !important;">Weld<br/>Length<br/>(mm)</th>
                  
                  <th class="d-none" style="width: 120px !important;">Fitter Code</th>

                  <th style="width: 120px !important;">WPS Code</th>

                  <th style="width: 200px !important;">Remarks</th> 
                  <th style="width: 200px !important;">Area</th> 
                  <th style="width: 260px !important;">Company</th>
                  <?php if(!isset($status_client_rejected)){ ?>
                    <th style="width: 200px !important;">Surveyor</th> 
                  <?php } else { ?>
                    <th style="width: 200px !important;">SMOE Inspection</th> 
                  <?php } ?>
                  <th>Status Submission</th>
                </tr>
              </thead>
              <tbody>
                <?php if(sizeof($joint_list) > 0){ ?>

                <?php $no_waiting_drawing = 0;  $no=0; $no_fltr=0;  $no_hidden=0; foreach ($joint_list as $key => $value): ?>

                <?php 

                    if(isset($value['status_inspection'])){
                      
                      if($value['status_inspection'] == 1){
                        $status_data = 0; //blue
                      } else if($value['status_inspection'] == 2 AND @$get['status_inspection'] == '2'){
                        if($value['status_resubmit'] == 1){
                           $status_data = 0; //blue
                        } else {
                          if(@$status_piecemark[$value['pos_1']]['status_inspection'] == '1' OR @$status_piecemark[$value['pos_2']]['status_inspection'] == '1'){
                            $status_data = 2; //red
                          } else if(@$status_piecemark_itr[$value['pos_1']]['status_inspection'] == '1' OR @$status_piecemark_itr[$value['pos_2']]['status_inspection'] == '1'){
                            $status_data = 2; //red
                          } else {
                           $status_data = 3; //green
                          }

                        }
                      } else if($value['status_inspection'] == 9 AND $get['status_inspection'] == '9'){
                        $status_data = 3; //green  
                      } else if($value['status_inspection'] == 11 AND $get['status_inspection'] == '11'){
                        $status_data = 3; //green
                      } else if($value['status_inspection'] == 6 AND $get['status_inspection'] == '6'){
                          $status_data = 3; //green
                      } else if($value['status_inspection'] == 4 AND @$get['status_inspection'] == '4'){
                        $status_data = 3; //green
                      } else if($value['status_inspection'] == 0){
                        $status_data = 3; //green
                      } else if($value['status_inspection'] == 3 OR $value['status_inspection'] == 5 OR $value['status_inspection'] == 7){
                        $status_data = 1; //green     
                      } else {
                         $status_data = 2; //red
                      }
                       
                    } else {

                      if(isset($status_piecemark[$value['pos_1']]['id_mis']) && isset($status_piecemark[$value['pos_1']]['id_mis'])){ 

                          if(@$status_piecemark[$value['pos_1']]['status_inspection'] == '0' OR @$status_piecemark[$value['pos_2']]['status_inspection'] == '0'){
                              $status_data = 2; //red
                          } else if(@$status_piecemark[$value['pos_1']]['status_inspection'] == '1' OR @$status_piecemark[$value['pos_2']]['status_inspection'] == '1'){
                              $status_data = 2; //red
                          } else if(@$status_piecemark[$value['pos_1']]['status_inspection'] == '2' OR @$status_piecemark[$value['pos_2']]['status_inspection'] == '2'){ 
                              $status_data = 3; //green
                          } else if(@$status_piecemark[$value['pos_1']]['status_inspection'] == '3' AND @$status_piecemark[$value['pos_2']]['status_inspection'] == '3'){ 
                              $status_data = 3; //green
                          } else if(@$status_piecemark[$value['pos_1']]['status_inspection'] == '4' OR @$status_piecemark[$value['pos_2']]['status_inspection'] == '4'){
                              $status_data = 0; //blue
                          } else if(@$status_piecemark[$value['pos_1']]['status_inspection'] == '7' AND @$status_piecemark[$value['pos_2']]['status_inspection'] == '7'){ 
                              $status_data = 3; //green 
                          } else if(@$status_piecemark[$value['pos_1']]['status_inspection'] == '9' AND @$status_piecemark[$value['pos_2']]['status_inspection'] == '9'){ 
                            $status_data = 3; //green  
                          } else if(@$status_piecemark[$value['pos_1']]['status_inspection'] == '10' AND @$status_piecemark[$value['pos_2']]['status_inspection'] == '10'){ 
                            $status_data = 3; //green 
                          } else if(@$status_piecemark[$value['pos_1']]['status_inspection'] == '11' AND @$status_piecemark[$value['pos_2']]['status_inspection'] == '11'){ 
                            $status_data = 3; //green          
                          } else {
                             $status_data = 2; //red
                          }

                      }  else if(isset($status_piecemark_itr[$value['pos_1']]['id_mis']) && isset($status_piecemark_itr[$value['pos_1']]['id_mis'])){ 
                        if(@$status_piecemark_itr[$value['pos_1']]['status_inspection'] == '0' OR @$status_piecemark_itr[$value['pos_2']]['status_inspection'] == '0'){
                          $status_data = 2; //red
                        } else if(@$status_piecemark_itr[$value['pos_1']]['status_inspection'] == '1' OR @$status_piecemark_itr[$value['pos_2']]['status_inspection'] == '1'){
                            $status_data = 2; //red
                        } else if(@$status_piecemark_itr[$value['pos_1']]['status_inspection'] == '2' OR @$status_piecemark_itr[$value['pos_2']]['status_inspection'] == '2'){ 
                            $status_data = 3; //green
                        } else if(@$status_piecemark_itr[$value['pos_1']]['status_inspection'] == '3' AND @$status_piecemark_itr[$value['pos_2']]['status_inspection'] == '3'){ 
                            $status_data = 3; //green
                        } else if(@$status_piecemark_itr[$value['pos_1']]['status_inspection'] == '4' OR @$status_piecemark_itr[$value['pos_2']]['status_inspection'] == '4'){
                            $status_data = 0; //blue
                        } else if(@$status_piecemark_itr[$value['pos_1']]['status_inspection'] == '7' AND @$status_piecemark_itr[$value['pos_2']]['status_inspection'] == '7'){ 
                            $status_data = 3; //green 
                        } else if(@$status_piecemark_itr[$value['pos_1']]['status_inspection'] == '9' AND @$status_piecemark_itr[$value['pos_2']]['status_inspection'] == '9'){ 
                          $status_data = 3; //green  
                        } else if(@$status_piecemark_itr[$value['pos_1']]['status_inspection'] == '10' AND @$status_piecemark_itr[$value['pos_2']]['status_inspection'] == '10'){ 
                          $status_data = 3; //green 
                        } else if(@$status_piecemark_itr[$value['pos_1']]['status_inspection'] == '11' AND @$status_piecemark_itr[$value['pos_2']]['status_inspection'] == '11'){ 
                          $status_data = 3; //green          
                        } else {
                          $status_data = 2; //red
                        }
                      }  else {
                         $status_data = 2; //red
                      }

                    }
                    ?>

                    <?php 
                      if(@$get['status_inspection'] == 'null' AND $status_data == '2'){ 
                        $no_fltr++;
                      } else if(@$get['status_inspection'] == 'x' AND $status_data == '3'){ 
                        $no_fltr++;
                      } 
                    ?>             
                <tr <?php if(@$get['status_inspection'] == 'null' AND $status_data == '2'){ ?>style="display: none;"<?php } else if(@$get['status_inspection'] == 'x' AND $status_data == '3'){ ?>style="display: none;"<?php } ?>>
                 <?php if(isset($get['drawing_no']) && !empty($get['drawing_no']) && isset($get['drawing_wm']) && !empty($get['drawing_wm'])){ ?>
                  <td>
                    <input type='hidden' name='id_workpack[<?php echo $no; ?>]' value='<?php echo $value['id_workpack']; ?>'>
                    <?php if($mode != 'transmittal' && (isset($get['drawing_wm']) && !empty($get['drawing_wm']))){ ?>
                        <?php
                          if($status_data == 0){
                            echo "<span style='font-weight:bold;font-size:25px;color:blue'>&#128504;</span>";
                          } else if($status_data == 2){
                            echo "<span style='font-weight:bold;font-size:15px;color:red'>&#10007;</span>";
                          } else if($status_data == 1){
                            echo "<span style='font-weight:bold;font-size:15px;color:green'>&#128504;</span>";
                          } else if($status_data == 3){
                        ?>
                        <?php 
                          if(isset($value["status_surveyor"])){  
                            
                            $statusx_su = explode(";",$value["status_surveyor"]);

                            if(in_array("3",$statusx_su)){
                              $status_show_data_submit = 1;
                            } else {
                              $status_show_data_submit = 0;
                            }

                          } else {  
                            $status_show_data_submit = 1;
                          } 
                          if(
                          	!in_array($status_piecemark[$value['pos_1']]['status_inspection'], [3,5,7,9,10,11]) 
                          	OR 
                          	!in_array($status_piecemark[$value['pos_2']]['status_inspection'], [3,5,7,9,10,11]) 
                          ){
                            $status_show_data_submit = 0;
                          }
                        ?>  

                        <?php if($status_show_data_submit == 1){ ?>
                          <input type='hidden' name='id_joint[<?php echo $no; ?>]' value='<?php echo $value['id']; ?>'>
                          <input type='checkbox' name='submit_id[<?php echo $no; ?>]' onclick='open_disabled_form(this,"<?php echo $no; ?>","<?php echo $get['status_inspection']; ?>")'>
                          <input type='hidden' name='filter_check[<?php echo $no; ?>]' value='0'>
                        <?php } ?>
                          
                        <?php
                          } 
                        ?>
                    <?php } else { ?>

                        <?php
                          if((isset($status_piecemark[$value['pos_1']]['status_inspection']) || isset($status_piecemark_itr[$value['pos_1']]['status_inspection'])) && (isset($status_piecemark[$value['pos_2']]['status_inspection']) || isset($status_piecemark_itr[$value['pos_2']]['status_inspection']))){
                            $status_ok = array(3,5,7,9,10,11);
                            if(( in_array($status_piecemark[$value['pos_1']]['status_inspection'], $status_ok) || in_array($status_piecemark_itr[$value['pos_1']]['status_inspection'], $status_ok) ) && (in_array($status_piecemark[$value['pos_2']]['status_inspection'], $status_ok) || in_array($status_piecemark_itr[$value['pos_2']]['status_inspection'], $status_ok) )){
                        ?>
                              <input type='hidden' name='id_joint[<?php echo $no; ?>]' value='<?php echo $value['id']; ?>'>
                              <input type='hidden' name='id_fitup[<?php echo $no; ?>]' value='<?php echo $value['id_fitup']; ?>'>                          
                              <input type='checkbox' class="cb_ro" name='submit_id[<?php echo $no; ?>]' onclick='open_disabled_form(this,"<?php echo $no; ?>","<?php echo $get['status_inspection']; ?>")'>
                              <input type='hidden' name='filter_check[<?php echo $no; ?>]' value='0'>
                        <?php
                            } else {                         
                              echo "<span style='font-weight:bold;font-size:15px;color:red'>&#10007;</span>";
                              ?>
                              <input type='hidden' name='id_joint[<?php echo $no; ?>]' value='<?php echo $value['id']; ?>'>
                                <input type='hidden' name='id_fitup[<?php echo $no; ?>]' value='<?php echo $value['id_fitup']; ?>'>  
                              <input type='hidden' name='filter_check[<?php echo $no; ?>]' value='0'>
                              <?php
                              //$no_hidden++;
                            }
                          } 
                        ?>    

                    <?php } ?>
                  </td>
                  <?php } ?>

                  <input type="hidden" name="revision_status_inspection" value="1">

                  <input type="hidden" name="inspection_datetime[<?php echo $no; ?>]" value="<?= (isset($value['inspection_datetime']) ? $value['inspection_datetime'] : null) ?>">
                  <input type="hidden" name="inspection_by[<?php echo $no; ?>]" value="<?= (isset($value['inspection_by']) ? $value['inspection_by'] : null) ?>">    
                  <input type="hidden" name="transmitted_date_new[<?php echo $no; ?>]" value="<?= (isset($value['transmitted_date']) ? $value['transmitted_date'] : null) ?>">
                  <input type="hidden" name="transmitted_by_new[<?php echo $no; ?>]" value="<?= (isset($value['transmitted_by']) ? $value['transmitted_by'] : null) ?>">
                  <input type="hidden" name="client_inspection_date[<?php echo $no; ?>]" value="<?= (isset($value['client_inspection_date']) ? $value['client_inspection_date'] : null) ?>">
                  <input type="hidden" name="client_inspection_by[<?php echo $no; ?>]" value="<?= (isset($value['client_inspection_by']) ? $value['client_inspection_by'] : null) ?>">
                  <input type="hidden" name="document_approval_date[<?php echo $no; ?>]" value="<?= (isset($value['document_approval_date']) ? $value['document_approval_date'] : null) ?>">
                  <input type="hidden" name="document_approval_by[<?php echo $no; ?>]" value="<?= (isset($value['document_approval_by']) ? $value['document_approval_by'] : null) ?>">
                  <input type="hidden" name="latest_inspection_status[<?php echo $no; ?>]" value="<?= (isset($value['latest_inspection_status']) ? $value['latest_inspection_status'] : null) ?>">
                  <input type="hidden" name="location_inspect_new[<?php echo $no; ?>]" value="<?= (isset($value['location_inspect']) ? $value['location_inspect'] : null) ?>">
                  <input type="hidden" name="inspector_id_new[<?php echo $no; ?>]" value="<?= (isset($value['inspector_id']) ? $value['inspector_id'] : null) ?>">
                  <input type="hidden" name="time_inspect_new[<?php echo $no; ?>]" value="<?= (isset($value['time_inspect']) ? $value['time_inspect'] : null) ?>">
                  <input type="hidden" name="status_invitation_new[<?php echo $no; ?>]" value="<?= (isset($value['status_invitation']) ? $value['status_invitation'] : null) ?>">
                  <input type="hidden" name="approve_comment[<?php echo $no; ?>]" value="<?= (isset($value['approve_comment']) ? $value['approve_comment'] : null) ?>">
                  <input type="hidden" name="postpone_remarks[<?php echo $no; ?>]" value="<?= (isset($value['postpone_remarks']) ? $value['postpone_remarks'] : null) ?>">
                  <input type="hidden" name="reoffer_remarks[<?php echo $no; ?>]" value="<?= (isset($value['reoffer_remarks']) ? $value['reoffer_remarks'] : null) ?>">
                  <input type="hidden" name="postpone_reoffer_no[<?php echo $no; ?>]" value="<?= (isset($value['postpone_reoffer_no']) ? $value['postpone_reoffer_no'] : null) ?>">
                  <input type="hidden" name="status_retransmitted[<?php echo $no; ?>]" value="<?= (isset($value['status_retransmitted']) ? $value['status_retransmitted'] : null) ?>">
                  <input type="hidden" name="drawing_rev_no[<?php echo $no; ?>]" value="<?= (isset($value['drawing_rev_no']) ? $value['drawing_rev_no'] : null) ?>">                 
                  <input type="hidden" name="surveyor_creator[<?php echo $no; ?>]" value="<?= (isset($value['surveyor_creator']) ? $value['surveyor_creator'] : null) ?>">
                  <input type="hidden" name="surveyor_created_date[<?php echo $no; ?>]" value="<?= (isset($value['surveyor_created_date']) ? $value['surveyor_created_date'] : null) ?>">
                  <input type="hidden" name="drawing_wm_approved[<?php echo $no; ?>]" value="<?= (isset($value['drawing_wm_approved']) ? $value['drawing_wm_approved'] : null) ?>">
                  <input type="hidden" name="drawing_wm_rev_approved[<?php echo $no; ?>]" value="<?= (isset($value['drawing_wm_rev_approved']) ? $value['drawing_wm_rev_approved'] : null) ?>">
                  <input type="hidden" name="latest_update_by[<?php echo $no; ?>]" value="<?= (isset($value['latest_update_by']) ? $value['latest_update_by'] : null) ?>">
                  <input type="hidden" name="latest_update_date[<?php echo $no; ?>]" value="<?= (isset($value['latest_update_date']) ? $value['latest_update_date'] : null) ?>">
                  <input type="hidden" name="id_workpack[<?php echo $no; ?>]" value="<?= (isset($value['id_workpack']) ? $value['id_workpack'] : null) ?>">
                  <input type="hidden" name="inspection_remarks[<?php echo $no; ?>]" value="<?= (isset($value['inspection_remarks']) ? $value['inspection_remarks'] : null) ?>">
                  <input type="hidden" name="ticked_report_date[<?php echo $no; ?>]" value="<?= (isset($value['ticked_report_date']) ? $value['ticked_report_date'] : null) ?>">
                  <input type="hidden" name="device_status[<?php echo $no; ?>]" value="<?= (isset($value['device_status']) ? $value['device_status'] : null) ?>">
                  <input type="hidden" name="legend_inspection_auth_new[<?php echo $no; ?>]" value="<?= (isset($value['legend_inspection_auth']) ? $value['legend_inspection_auth'] : null) ?>">
                  <input type="hidden" name="report_number_new[<?php echo $no; ?>]" value="<?= (isset($value['report_number']) ? $value['report_number'] : null) ?>">
                  <input type="hidden" name="remarks[<?php echo $no; ?>]" value="<?= (isset($value['remarks']) ? $value['remarks'] : null) ?>">
                  
                  
                  <td><?= $project_name[$value['project']] ?></td>

                  <td class="d-none"><?php echo $value['workpack_no'] ?></td>
                  <?php if ($mode == "transmittal"){ ?> 
                  <td><?php echo $value['submission_id'] ?></td>
                  <?php } ?> 
                  <td>
                    <?php echo $value['drawing_no'] ?> 
                    <?php if($mode != 'transmittal'){ ?>
                      <?php if(isset($value['rev_no'])){ ?><?php echo "Rev.".$value['rev_no'] ?><?php } ?>
                      <?php if(isset($activity_eng[$value['drawing_no']]['id'])){ ?>
                          <?php 
                              $links_atc = base_url_ftp_eng()."public_smoe/open_atc/2/".strtr($this->encryption->encrypt($activity_eng[$value['drawing_no']]['id']), '+=/', '.-~')."/".$value['rev_no']; 
                          ?>
                          <br/>
                          <a target='_blank' href='<?= $links_atc ?>'  title='Attachment'> <h6> <span class="badge badge-pill badge-primary"> <i class='fas fa-paperclip'></i>
                            Open</span> </h6> </a>

                      <?php } else { $no_waiting_drawing++; ?>
                        <div class="form-check form-check-inline text-danger">
                          <h6>
                            <span class="badge badge-pill badge-warning">
                              <i class="fas fa-hourglass"></i>
                              Waiting Drawing Release
                              </span>
                          </h6>
                        </div>
                      <?php } ?>
                    <?php } ?>
                  </td>
                  <td>
                    <?php echo $value['drawing_wm'] ?>
                    <?php if($mode != 'transmittal'){ ?>
                      Rev.<?php echo $value['rev_wm'] ?>
                      <?php if(isset($activity_eng[$value['drawing_wm']]['id'])){ ?>
                          <?php 
                              $links_atc = base_url_ftp_eng()."public_smoe/open_atc/2/".strtr($this->encryption->encrypt($activity_eng[$value['drawing_wm']]['id']), '+=/', '.-~')."/".$value['rev_wm']; 
                          ?>
                          <br/>
                          <a target='_blank' href='<?= $links_atc ?>'  title='Attachment'> <h6> <span class="badge badge-pill badge-primary"> <i class='fas fa-paperclip'></i>
                            Open</span> </h6> </a>

                      <?php } else { $no_waiting_drawing++; ?>
                        <div class="form-check form-check-inline text-danger">
                          <h6>
                            <span class="badge badge-pill badge-warning">
                              <i class="fas fa-hourglass"></i>
                              Waiting Drawing Release
                            </span>
                          </h6>
                        </div>
                      <?php } ?>
                    <?php } ?>
                  </td>
                  <td><?php echo $value['joint_no'] ?></td>
                  <td><?php echo @$show_deck_elevation[$value['deck_elevation']] ?></td>
                  <td><?php echo @$show_weld_type[$value['weld_type']] ?></td>
                  <td>
                    <span class='badge'>
                      <?php echo str_replace(";", "<hr/>",$value['pos_1']) ?>
                    </span>
                    <?php
                    if(isset($status_piecemark[$value['pos_1']]['status_inspection'])){ 
                      if(@$status_piecemark[$value['pos_1']]['status_inspection'] == '1'){                         
                          echo "<span class='badge badge-danger'>Pending Re-Approval</span>";                         
                      }
                    } else {
                      if(@$status_piecemark_itr[$value['pos_1']]['status_inspection'] == '1'){                         
                        echo "<span class='badge badge-danger'>Pending Re-Approval</span>";                         
                    }
                    }
                    ?>
                    <br/>
                      <?php if(isset($status_piecemark_ref[$value['pos_1']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_1']]["ref_pos_1"])){ ?>
                        <?php 
                            $data_multiple_piecemark_1 = explode(", ",$status_piecemark_ref[$value['pos_1']]["ref_pos_1"]); 
                            foreach($data_multiple_piecemark_1 as $vaxx){ 

                              if(isset($status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['drawing_sp'])){

                                if(isset($activity_eng[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['drawing_sp']]['id'])){
                                  $drawing_sp_rev_p1 = $status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['rev_sp'];
                                  $links_sp_p1 = base_url_ftp_eng()."public_smoe/open_atc/2/".strtr($this->encryption->encrypt($activity_eng[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['drawing_sp']]['id']), '+=/', '.-~').'/'.$drawing_sp_rev_p1;
                                } else {
                                  $links_sp_p1 = "#";
                                }  

                                echo "<a href='".$links_sp_p1."' target='_blank' style='color:black !important;'>"."<span class='badge'>".$status_piecemark_ref_1[$vaxx]["part_id"]."</span></a><br/>";

                              } else {

                                if(isset($activity_eng[$status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]['drawing_sp']]['id'])){
                                  $drawing_sp_rev_p1 = $status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]['rev_sp'];
                                  $links_sp_p1 = base_url_ftp_eng()."public_smoe/open_atc/2/".strtr($this->encryption->encrypt($activity_eng[$status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]['drawing_sp']]['id']), '+=/', '.-~').'/'.$drawing_sp_rev_p1;
                                } else {
                                  $links_sp_p1 = "#";
                                } 

                                echo "<a href='".$links_sp_p1."' target='_blank' style='color:black !important;'>"."<span class='badge'>".$status_piecemark_ref_1_itr[$vaxx]["part_id"]."</span></a><br/>";

                              }  

                               
                            }
                        ?>
                      <?php } ?>
                    <hr/>
                    <span class='badge'>
                    <?php echo str_replace(";", "<hr/>",$value['pos_2']) ?>
                    </span>
                    <?php
                     if(isset($status_piecemark[$value['pos_2']]['status_inspection'])){ 
                      if(@$status_piecemark[$value['pos_2']]['status_inspection'] == '1'){                         
                          echo "<span class='badge badge-danger'>Pending Re-Approval</span>";                         
                      }
                    } else {
                      if(@$status_piecemark_itr[$value['pos_2']]['status_inspection'] == '1'){                         
                        echo "<span class='badge badge-danger'>Pending Re-Approval</span>";                         
                      }
                    }
                    ?>
                      <?php if(isset($status_piecemark_ref[$value['pos_2']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_1']]["ref_pos_1"])){ ?>
                        <?php 
                            $data_multiple_piecemark_1 = explode(", ",$status_piecemark_ref[$value['pos_2']]["ref_pos_1"]); 
                            foreach($data_multiple_piecemark_1 as $vaxx){ 

                              if(isset($status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['drawing_sp'])){

                                if(isset($activity_eng[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['drawing_sp']]['id'])){
                                  $drawing_sp_rev_p1 = $status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['rev_sp'];
                                  $links_sp_p1 = base_url_ftp_eng()."public_smoe/open_atc/2/".strtr($this->encryption->encrypt($activity_eng[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['drawing_sp']]['id']), '+=/', '.-~').'/'.$drawing_sp_rev_p1;
                                } else {
                                  $links_sp_p1 = "#";
                                }  

                                echo "<a href='".$links_sp_p1."' target='_blank' style='color:black !important;'>"."<span class='badge'>".$status_piecemark_ref_1[$vaxx]["part_id"]."</span></a><br/>";

                              } else {

                                if(isset($activity_eng[$status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]['drawing_sp']]['id'])){
                                  $drawing_sp_rev_p1 = $status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]['rev_sp'];
                                  $links_sp_p1 = base_url_ftp_eng()."public_smoe/open_atc/2/".strtr($this->encryption->encrypt($activity_eng[$status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]['drawing_sp']]['id']), '+=/', '.-~').'/'.$drawing_sp_rev_p1;
                                } else {
                                  $links_sp_p1 = "#";
                                } 

                                echo "<a href='".$links_sp_p1."' target='_blank' style='color:black !important;'>"."<span class='badge'>".$status_piecemark_ref_1_itr[$vaxx]["part_id"]."</span></a><br/>";

                              }
                                
                            }
                        ?>
                      <?php } ?>
                  </td>                  
                  <td>
                      <!-- <?php if(isset($status_piecemark_ref[$value['pos_1']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_1']]["ref_pos_1"])){ ?>
                        <?php 
                            $data_multiple_piecemark_1 = explode(", ",$status_piecemark_ref[$value['pos_1']]["ref_pos_1"]); 
                            foreach($data_multiple_piecemark_1 as $vaxx){ 
                              if(isset($status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]])){
                                echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['id_mis']]['unique_ident_no']."</span><br/>";
                              } else {
                                echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]['id_mis']]['unique_ident_no']."</span><br/>";
                              }
                            }
                        ?>
                      <?php } else { ?>
                            <?php  
                              if(isset($status_piecemark[$value['pos_1']]['id_mis'])){ 
                                  if($status_piecemark[$value['pos_1']]['status_inspection'] == '0'){
                                    echo "<span class='badge badge-warning'>Not Ready in MTR Verification</span>";
                                  } else if($status_piecemark[$value['pos_1']]['status_inspection'] == '1'){
                                    if(!isset($status_piecemark[$value['pos_1']]['status_invitation'])){
                                      echo "<span class='badge badge-warning'>MTR Verification - Pending Approval</span>";
                                    } else {
                                      echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['unique_ident_no']."</span>";
                                    }
                                  } else if($status_piecemark[$value['pos_1']]['status_inspection'] == '2' && !isset($status_piecemark[$value['pos_1']]['status_invitation'])){ 
                                    if(!isset($status_piecemark[$value['pos_1']]['status_invitation'])){
                                      echo "<span class='badge badge-warning'>MTR Verification - Rejected</span>"; 
                                    } else {
                                      echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['unique_ident_no']."</span>";
                                    }
                                  } else if($status_piecemark[$value['pos_1']]['status_inspection'] == '3'){
                                    echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['unique_ident_no']."</span>";
                                  } else if($status_piecemark[$value['pos_1']]['status_inspection'] == '4'){
                                    echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['unique_ident_no']."</span>";
                                  } else if($status_piecemark[$value['pos_1']]['status_inspection'] == '5'){
                                    echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['unique_ident_no']."</span>"; 
                                  } else if($status_piecemark[$value['pos_1']]['status_inspection'] == '7'){
                                    echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['unique_ident_no']."</span>";
                                  } else if($status_piecemark[$value['pos_1']]['status_inspection'] == '9'){
                                    echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['unique_ident_no']."</span>";
                                  } else if($status_piecemark[$value['pos_1']]['status_inspection'] == '10'){
                                    echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['unique_ident_no']."</span>"; 
                                  } else if($status_piecemark[$value['pos_1']]['status_inspection'] == '11'){
                                    echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['unique_ident_no']."</span>";  
                                  }  
                              } else if(isset($status_piecemark_itr[$value['pos_1']]['id_mis'])){
                                if($status_piecemark_itr[$value['pos_1']]['status_inspection'] == '0'){
                                  echo "<span class='badge badge-warning'>Not Ready in ITR Verification</span>";
                                } else if($status_piecemark_itr[$value['pos_1']]['status_inspection'] == '1'){
                                  if(!isset($status_piecemark_itr[$value['pos_1']]['status_invitation'])){
                                    echo "<span class='badge badge-warning'>ITR Verification - Pending Approval</span>";
                                  } else {
                                    echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark_itr[$value['pos_1']]['id_mis']]['unique_ident_no']."</span>";
                                  }
                                } else if($status_piecemark_itr[$value['pos_1']]['status_inspection'] == '2' && !isset($status_piecemark_itr[$value['pos_1']]['status_invitation'])){ 
                                  if(!isset($status_piecemark_itr[$value['pos_1']]['status_invitation'])){
                                    echo "<span class='badge badge-warning'>ITR Verification - Rejected</span>"; 
                                  } else {
                                    echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark_itr[$value['pos_1']]['id_mis']]['unique_ident_no']."</span>";
                                  }
                                } else if($status_piecemark_itr[$value['pos_1']]['status_inspection'] == '3'){
                                  echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark_itr[$value['pos_1']]['id_mis']]['unique_ident_no']."</span>";
                                } else if($status_piecemark_itr[$value['pos_1']]['status_inspection'] == '4'){
                                  echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark_itr[$value['pos_1']]['id_mis']]['unique_ident_no']."</span>";
                                } else if($status_piecemark_itr[$value['pos_1']]['status_inspection'] == '5'){
                                  echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark_itr[$value['pos_1']]['id_mis']]['unique_ident_no']."</span>"; 
                                } else if($status_piecemark_itr[$value['pos_1']]['status_inspection'] == '7'){
                                  echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark_itr[$value['pos_1']]['id_mis']]['unique_ident_no']."</span>";
                                } else if($status_piecemark_itr[$value['pos_1']]['status_inspection'] == '9'){
                                  echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark_itr[$value['pos_2']]['id_mis']]['unique_ident_no']."</span>";
                                } else if($status_piecemark_itr[$value['pos_1']]['status_inspection'] == '10'){
                                  echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark_itr[$value['pos_2']]['id_mis']]['unique_ident_no']."</span>"; 
                                } else if($status_piecemark_itr[$value['pos_1']]['status_inspection'] == '11'){
                                  echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark_itr[$value['pos_2']]['id_mis']]['unique_ident_no']."</span>";  
                                }   
                              } else {  
                                  echo "<span class='badge badge-warning'>Material Not Ready</span>";
                              } 
                            ?> 
                    <?php } ?>
                    <hr/>
                    <?php if(isset($status_piecemark_ref[$value['pos_2']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_1']]["ref_pos_1"])){ ?>
                        <?php 
                            $data_multiple_piecemark_1 = explode(", ",$status_piecemark_ref[$value['pos_2']]["ref_pos_1"]); 
                            foreach($data_multiple_piecemark_1 as $vaxx){ 
                              if(isset($status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]])){
                                echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['id_mis']]['unique_ident_no']."</span><br/>";
                              } else {
                                echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]['id_mis']]['unique_ident_no']."</span><br/>";
                              }
                            }
                        ?>
                      <?php } else { ?>
                              <?php 
                                if(isset($status_piecemark[$value['pos_2']]['id_mis'])){ 

                                    if($status_piecemark[$value['pos_2']]['status_inspection'] == '0'){
                                      echo "<span class='badge badge-warning'>Not Ready in MTR Verification</span>";
                                    } else if($status_piecemark[$value['pos_2']]['status_inspection'] == '1'){
                                      if(!isset($status_piecemark[$value['pos_2']]['status_invitation'])){
                                        echo "<span class='badge badge-warning'>MTR Verification - Pending Approval</span>";
                                      } else {
                                        echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['unique_ident_no']."</span>";
                                      } 
                                    } else if($status_piecemark[$value['pos_2']]['status_inspection'] == '2'){ 
                                      if(!isset($status_piecemark[$value['pos_2']]['status_invitation'])){
                                        echo "<span class='badge badge-warning'>MTR Verification - Rejected</span>"; 
                                      } else {
                                        echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['unique_ident_no']."</span>";
                                      }                             
                                    } else if($status_piecemark[$value['pos_2']]['status_inspection'] == '3'){
                                      echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['unique_ident_no']."</span>";
                                    } else if($status_piecemark[$value['pos_2']]['status_inspection'] == '4'){
                                      echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['unique_ident_no']."</span>";
                                    } else if($status_piecemark[$value['pos_2']]['status_inspection'] == '5'){
                                      echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['unique_ident_no']."</span>";  
                                    } else if($status_piecemark[$value['pos_2']]['status_inspection'] == '7'){
                                      echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['unique_ident_no']."</span>"; 
                                    } else if($status_piecemark[$value['pos_2']]['status_inspection'] == '9'){
                                      echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['unique_ident_no']."</span>";
                                    } else if($status_piecemark[$value['pos_2']]['status_inspection'] == '10'){
                                      echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['unique_ident_no']."</span>"; 
                                    } else if($status_piecemark[$value['pos_2']]['status_inspection'] == '11'){
                                      echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['unique_ident_no']."</span>";        
                                    } 

                                } else if(isset($status_piecemark_itr[$value['pos_2']]['id_mis'])){

                                  if($status_piecemark_itr[$value['pos_2']]['status_inspection'] == '0'){
                                    echo "<span class='badge badge-warning'>Not Ready in MTR Verification</span>";
                                  } else if($status_piecemark_itr[$value['pos_2']]['status_inspection'] == '1'){
                                    if(!isset($status_piecemark_itr[$value['pos_2']]['status_invitation'])){
                                      echo "<span class='badge badge-warning'>MTR Verification - Pending Approval</span>";
                                    } else {
                                      echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark_itr[$value['pos_2']]['id_mis']]['unique_ident_no']."</span>";
                                    } 
                                  } else if($status_piecemark_itr[$value['pos_2']]['status_inspection'] == '2'){ 
                                    if(!isset($status_piecemark_itr[$value['pos_2']]['status_invitation'])){
                                      echo "<span class='badge badge-warning'>MTR Verification - Rejected</span>"; 
                                    } else {
                                      echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark_itr[$value['pos_2']]['id_mis']]['unique_ident_no']."</span>";
                                    }                             
                                  } else if($status_piecemark_itr[$value['pos_2']]['status_inspection'] == '3'){
                                    echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark_itr[$value['pos_2']]['id_mis']]['unique_ident_no']."</span>";
                                  } else if($status_piecemark_itr[$value['pos_2']]['status_inspection'] == '4'){
                                    echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark_itr[$value['pos_2']]['id_mis']]['unique_ident_no']."</span>";
                                  } else if($status_piecemark_itr[$value['pos_2']]['status_inspection'] == '5'){
                                    echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark_itr[$value['pos_2']]['id_mis']]['unique_ident_no']."</span>";  
                                  } else if($status_piecemark_itr[$value['pos_2']]['status_inspection'] == '7'){
                                    echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark_itr[$value['pos_2']]['id_mis']]['unique_ident_no']."</span>"; 
                                  } else if($status_piecemark_itr[$value['pos_2']]['status_inspection'] == '9'){
                                    echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark_itr[$value['pos_2']]['id_mis']]['unique_ident_no']."</span>";
                                  } else if($status_piecemark_itr[$value['pos_2']]['status_inspection'] == '10'){
                                    echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark_itr[$value['pos_2']]['id_mis']]['unique_ident_no']."</span>"; 
                                  } else if($status_piecemark_itr[$value['pos_2']]['status_inspection'] == '11'){
                                    echo "<span class='badge badge-success'>".$warehouse_mis_mrir[$status_piecemark_itr[$value['pos_2']]['id_mis']]['unique_ident_no']."</span>";        
                                  } 

                                } else {  
                                    echo "<span class='badge badge-warning'>Material Not Ready</span>";
                                } 
                              ?>
                        <?php } ?> -->
                  </td>
                  <td>
                    <?php if(isset($status_piecemark_ref[$value['pos_1']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_1']]["ref_pos_1"])){ ?>
                      <?php 
                          $data_multiple_piecemark_1 = explode(", ",$status_piecemark_ref[$value['pos_1']]["ref_pos_1"]); 
                          foreach($data_multiple_piecemark_1 as $vaxx){ 
                            if($status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]){
                              echo "<span class='badge'>".$warehouse_mis_mrir[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['id_mis']]['heat_or_series_no']."</span><br/>";
                            } else {
                              echo "<span class='badge'>".$warehouse_mis_mrir[$status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]['id_mis']]['heat_or_series_no']."</span><br/>";
                            }
                          }
                      ?>
                    <?php } else { ?>
                      <?php 
                        if(isset($status_piecemark[$value['pos_1']]['id_mis'])){ 
                          echo "<span class='badge'>".$warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['heat_or_series_no']."</span>";
                        } else if(isset($status_piecemark_itr[$value['pos_1']]['id_mis'])){
                          echo "<span class='badge'>".$warehouse_mis_mrir[$status_piecemark_itr[$value['pos_1']]['id_mis']]['heat_or_series_no']."</span>"; 
                        } else {
                          echo "-";
                        }
                      ?>
                    <?php } ?>  
                    <hr/>
                    <?php if(isset($status_piecemark_ref[$value['pos_2']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_1']]["ref_pos_1"])){ ?>
                      <?php 
                          $data_multiple_piecemark_1 = explode(", ",$status_piecemark_ref[$value['pos_2']]["ref_pos_1"]); 
                          foreach($data_multiple_piecemark_1 as $vaxx){ 
                            if($status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]){
                              echo "<span class='badge'>".$warehouse_mis_mrir[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['id_mis']]['heat_or_series_no']."</span><br/>";
                            } else {
                              echo "<span class='badge'>".$warehouse_mis_mrir[$status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]['id_mis']]['heat_or_series_no']."</span><br/>";
                            }
                          }
                      ?>
                    <?php } else { ?>
                      <?php 
                        if(isset($status_piecemark[$value['pos_2']]['id_mis'])){ 
                          echo "<span class='badge'>".$warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['heat_or_series_no']."</span>";
                        } else if(isset($status_piecemark_itr[$value['pos_2']]['id_mis'])){
                          echo "<span class='badge'>".$warehouse_mis_mrir[$status_piecemark_itr[$value['pos_2']]['id_mis']]['heat_or_series_no']."</span>"; 
                        } else {
                          echo "-";
                        }
                      ?>
                    <?php } ?>   
                  </td>
                  <td>
                    <?php if(isset($status_piecemark_ref[$value['pos_1']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_1']]["ref_pos_1"])){ ?>
                      <?php 
                          $data_multiple_piecemark_1 = explode(", ",$status_piecemark_ref[$value['pos_1']]["ref_pos_1"]); 
                          foreach($data_multiple_piecemark_1 as $vaxx){ 
                            if($status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]){
                              echo "<span class='badge'>".$material_grade[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['grade']]['material_grade']."</span><br/>";
                            } else  if($status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]){
                              echo "<span class='badge'>".$material_grade[$status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]['grade']]['material_grade']."</span><br/>";
                            }
                          }
                      ?>
                    <?php } else { ?>
                      <span class='badge'>
                      <?php 
                        if(isset($status_piecemark[$value['pos_1']]['id_mis'])){ 
                          echo  $material_grade[$status_piecemark[$value['pos_1']]['grade']]['material_grade'];
                        } else if(isset($status_piecemark_itr[$value['pos_1']]['id_mis'])){ 
                          echo  $material_grade[$status_piecemark_itr[$value['pos_1']]['grade']]['material_grade'];
                        } else {
                          echo "-";
                        }
                      ?>
                      </span>
                    <?php } ?>  
                    <hr/>
                    <?php if(isset($status_piecemark_ref[$value['pos_2']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_1']]["ref_pos_1"])){ ?>
                      <?php 
                          $data_multiple_piecemark_1 = explode(", ",$status_piecemark_ref[$value['pos_2']]["ref_pos_1"]); 
                          foreach($data_multiple_piecemark_1 as $vaxx){ 
                            if($status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]){
                              echo "<span class='badge'>".$material_grade[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['grade']]['material_grade']."</span><br/>";
                            } else  if($status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]){
                              echo "<span class='badge'>".$material_grade[$status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]['grade']]['material_grade']."</span><br/>";
                            }
                          }
                      ?>
                    <?php } else { ?>
                    <span class='badge'>
                     <?php 
                       if(isset($status_piecemark[$value['pos_2']]['id_mis'])){ 
                        echo  $material_grade[$status_piecemark[$value['pos_2']]['grade']]['material_grade'];
                      } else if(isset($status_piecemark_itr[$value['pos_2']]['id_mis'])){ 
                        echo  $material_grade[$status_piecemark_itr[$value['pos_2']]['grade']]['material_grade'];
                      } else {
                        echo "-";
                      }
                    ?>
                    </span>
                    <?php } ?>
                  </td>
                  <td class="ball" style="vertical-align: middle;text-align: center;">
                    <?php echo @$class_list[$value["class"]]?>
                  </td>
                  <td class="ball" style="vertical-align: middle;text-align: center;">
                    <?php if(isset($status_piecemark_ref[$value['pos_1']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_1']]["ref_pos_1"])){ ?>
                      <?php 
                        $data_multiple_piecemark_1 = explode(", ",$status_piecemark_ref[$value['pos_1']]["ref_pos_1"]); 
                        foreach($data_multiple_piecemark_1 as $vaxx2){ 
                          if(isset($status_piecemark_ref_1[$vaxx2]["diameter"])){
                            echo "<span class='badge'>".$status_piecemark_ref_1[$vaxx2]["diameter"]."</span><br/>";
                          } else if(isset($status_piecemark_ref_1_itr[$vaxx2]["diameter"])){
                            echo "<span class='badge'>".$status_piecemark_ref_1_itr[$vaxx2]["diameter"]."</span><br/>";
                          } else {
                            echo "-";
                          }
                        }
                      ?>
                    <?php } else { ?>
                      <?php 
                        if(isset($status_piecemark[$value['pos_1']]['diameter'])){
                          echo @$status_piecemark[$value['pos_1']]['diameter'];
                        } else if($status_piecemark_itr[$value['pos_1']]['diameter']){
                          echo @$status_piecemark_itr[$value['pos_1']]['diameter'];
                        } else {
                          echo "-";
                        }
                      ?> 
                    <?php } ?>
                    <hr/>
                    <?php if(isset($status_piecemark_ref[$value['pos_2']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_1']]["ref_pos_1"])){ ?>
                      <?php 
                        $data_multiple_piecemark_1 = explode(", ",$status_piecemark_ref[$value['pos_2']]["ref_pos_1"]); 
                        foreach($data_multiple_piecemark_1 as $vaxx2){ 
                          if(isset($status_piecemark_ref_1[$vaxx2]["diameter"])){
                            echo "<span class='badge'>".$status_piecemark_ref_1[$vaxx2]["diameter"]."</span><br/>";
                          } else if(isset($status_piecemark_ref_1_itr[$vaxx2]["diameter"])){
                            echo "<span class='badge'>".$status_piecemark_ref_1_itr[$vaxx2]["diameter"]."</span><br/>";
                          } else {
                            echo "-";
                          }
                        }
                      ?>
                    <?php } else { ?>
                    <?php 
                      if(isset($status_piecemark[$value['pos_2']]['diameter'])){
                        echo @$status_piecemark[$value['pos_2']]['diameter'];
                      } else if($status_piecemark_itr[$value['pos_2']]['diameter']){
                        echo @$status_piecemark_itr[$value['pos_2']]['diameter'];
                      } else {
                        echo "-";
                      }
                      ?>
                    <?php } ?>
                  </td>
                  <td class="ball" style="vertical-align: middle;text-align: center;">
                    <?php if(isset($status_piecemark_ref[$value['pos_1']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_1']]["ref_pos_1"])){ ?>
                      <?php 
                          $data_multiple_piecemark_1 = explode(", ",$status_piecemark_ref[$value['pos_1']]["ref_pos_1"]); 
                          foreach($data_multiple_piecemark_1 as $vaxx2){ 
                            if(isset($status_piecemark_ref_1[$vaxx2]["sch"])){
                              echo "<span class='badge'>".$status_piecemark_ref_1[$vaxx2]["sch"]."</span><br/>";
                            } else if(isset($status_piecemark_ref_1_itr[$vaxx2]["sch"])){
                              echo "<span class='badge'>".$status_piecemark_ref_1_itr[$vaxx2]["sch"]."</span><br/>";
                            } else {
                              echo "-";
                            }
                          }
                      ?>
                    <?php } else { ?>
                      <?php 
                        if(isset($status_piecemark[$value['pos_1']]['sch'])){
                          echo @$status_piecemark[$value['pos_1']]['sch'];
                        } else if($status_piecemark_itr[$value['pos_1']]['sch']){
                          echo @$status_piecemark_itr[$value['pos_1']]['sch'];
                        } else {
                          echo "-";
                        }
                      ?> 
                    <?php } ?>  
                     <hr/>
                    <?php if(isset($status_piecemark_ref[$value['pos_2']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_1']]["ref_pos_1"])){ ?>
                      <?php 
                          $data_multiple_piecemark_1 = explode(", ",$status_piecemark_ref[$value['pos_2']]["ref_pos_1"]); 
                          foreach($data_multiple_piecemark_1 as $vaxx2){ 
                            if(isset($status_piecemark_ref_1[$vaxx2]["sch"])){
                              echo "<span class='badge'>".$status_piecemark_ref_1[$vaxx2]["sch"]."</span><br/>";
                            } else if(isset($status_piecemark_ref_1_itr[$vaxx2]["sch"])){
                              echo "<span class='badge'>".$status_piecemark_ref_1_itr[$vaxx2]["sch"]."</span><br/>";
                            } else {
                              echo "-";
                            }
                          }
                      ?>
                    <?php } else { ?> 
                      <?php 
                        if(isset($status_piecemark[$value['pos_2']]['sch'])){
                          echo @$status_piecemark[$value['pos_2']]['sch'];
                        } else if($status_piecemark_itr[$value['pos_2']]['sch']){
                          echo @$status_piecemark_itr[$value['pos_2']]['sch'];
                        } else {
                          echo "-";
                        }
                      ?> 
                    <?php } ?>  
                  </td>
                  <td class="ball" style="vertical-align: middle;text-align: center;">
                    <?php if(isset($status_piecemark_ref[$value['pos_1']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_1']]["ref_pos_1"])){ ?>
                      <?php 
                          $data_multiple_piecemark_1 = explode(", ",$status_piecemark_ref[$value['pos_1']]["ref_pos_1"]); 
                          foreach($data_multiple_piecemark_1 as $vaxx2){ 
                            if(isset($status_piecemark_ref_1[$vaxx2]["thickness"])){
                              echo "<span class='badge'>".$status_piecemark_ref_1[$vaxx2]["thickness"]."</span><br/>";
                            } else if(isset($status_piecemark_ref_1_itr[$vaxx2]["thickness"])){
                              echo "<span class='badge'>".$status_piecemark_ref_1_itr[$vaxx2]["thickness"]."</span><br/>";
                            } else {
                              echo "-";
                            } 
                          }
                      ?>
                    <?php } else { ?>  
                      <?php 
                        if(isset($status_piecemark[$value['pos_1']]['thickness'])){
                          echo @$status_piecemark[$value['pos_1']]['thickness'];
                        } else if($status_piecemark_itr[$value['pos_1']]['thickness']){
                          echo @$status_piecemark_itr[$value['pos_1']]['thickness'];
                        } else {
                          echo "-";
                        }
                      ?> 
                    <?php } ?>  
                    <hr/>
                    <?php if(isset($status_piecemark_ref[$value['pos_2']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_1']]["ref_pos_1"])){ ?>
                      <?php 
                          $data_multiple_piecemark_1 = explode(", ",$status_piecemark_ref[$value['pos_2']]["ref_pos_1"]); 
                          foreach($data_multiple_piecemark_1 as $vaxx2){ 
                            if(isset($status_piecemark_ref_1[$vaxx2]["thickness"])){
                              echo "<span class='badge'>".$status_piecemark_ref_1[$vaxx2]["thickness"]."</span><br/>";
                            } else if(isset($status_piecemark_ref_1_itr[$vaxx2]["thickness"])){
                              echo "<span class='badge'>".$status_piecemark_ref_1_itr[$vaxx2]["thickness"]."</span><br/>";
                            } else {
                              echo "-";
                            } 
                          }
                      ?>
                    <?php } else { ?>
                      <?php 
                        if(isset($status_piecemark[$value['pos_2']]['thickness'])){
                          echo @$status_piecemark[$value['pos_2']]['thickness'];
                        } else if($status_piecemark_itr[$value['pos_2']]['thickness']){
                          echo @$status_piecemark_itr[$value['pos_2']]['thickness'];
                        } else {
                          echo "-";
                        }
                      ?> 
                    <?php } ?>
                  </td>
                  
                  <td><?php echo $value['weld_length'] ?></td>

                  
                  <td class="d-none">
                  	<?php if($value['status_inspection'] != 2 AND !isset($value['status_inspection'])){ ?>

                      <input type='hidden' name='id_fitup_reject[<?php echo $no; ?>]' value='x'> 
                      <input type='hidden' name='status_process[<?php echo $no; ?>]' value='new'>
                    <?php } else if($value['status_inspection'] == 2 OR $value['status_inspection'] == 4 OR $value['status_inspection'] == 6 OR $value['status_inspection'] == 11 OR $value['status_inspection'] == 9 OR $value['status_inspection'] == 0){ ?> 
                      <?php if($value['status_inspection'] == 2){ ?>
                        <input type='hidden' name='status_process[<?php echo $no; ?>]' value='reject'>
                      <?php } else if($value['status_inspection'] == 4){ ?>
                        <input type='hidden' name='status_process[<?php echo $no; ?>]' value='pending'>
                      <?php } else if($value['status_inspection'] == 6){ ?>
                        <input type='hidden' name='status_process[<?php echo $no; ?>]' value='reject_client'> 
                      <?php } else if($value['status_inspection'] == 11){ ?>
                        <input type='hidden' name='status_process[<?php echo $no; ?>]' value='reoffer_client'>  
                      <?php } else if($value['status_inspection'] == 0){ ?>
                        <input type='hidden' name='status_process[<?php echo $no; ?>]' value='draft'>   
                      <?php } ?>
                      <input type='hidden' name='id_fitup_reject[<?php echo $no; ?>]' value='<?php echo $value['id_fitup']; ?>'>
                    <?php } else if($value['status_inspection'] == 0){ ?>  
                      <input type='hidden' name='status_process[<?php echo $no; ?>]' value='draft'> 
                      <input type='hidden' name='id_fitup_reject[<?php echo $no; ?>]' value='<?php echo $value['id_fitup']; ?>'> 
                    <?php 
                      } 
                    ?>

                      <?php if($value['status_inspection'] != 2 AND !isset($value['status_inspection'])){ ?>

                      	<input type='text' name='id_fitup_reject[<?php echo $no; ?>]' value='x'> 
                      	<input type='text' name='status_process[<?php echo $no; ?>]' value='new'>

                        <select  class='select2_multiple_fitter' name='fitter_id[<?php echo $no; ?>][]' multiple disabled></select>
                      <?php } else if($value['status_inspection'] == 2 OR $value['status_inspection'] == 4 OR $value['status_inspection'] == 6 OR $value['status_inspection'] == 11 OR $value['status_inspection'] == 9 OR $value['status_inspection'] == 0){ ?>
                        <select  class='select2_multiple_fitter' name='fitter_id[<?php echo $no; ?>][]' multiple disabled>
                          <?php
                            $fitter_id_display = explode(";", $value['fitter_id']); 
                            foreach ($fitter_id_display as $key => $value_f) {
                              echo "<option value='".$value_f."' selected>".$fitter_code_arr[$value_f]."</option>";
                            } 
                          ?>
                        </select>
                 
                      <?php  
                        } else {
                          $fitter_id_display = explode(";", $value['fitter_id']);
                          foreach ($fitter_id_display as $key => $val_fitter) {
                            if(isset($fitter_code_arr[$val_fitter])){
                              echo $fitter_code_arr[$val_fitter]."<br/>";
                            }
                          }
                        } 
                      ?>
                  </td>

                  <?php if($joint_list[0]['project'] != 17 ){ ?> 
                  <td>
                    <?php 
                    $wps_no_display = explode(";", $value['wps_no']);
                    // test_var($value);
                    ?>
                    
                    <select name="wps_no[<?php echo $no; ?>][]" class="select2" style="width:100%" multiple <?= in_array($value['company_id'], [19, 21]) ? 'required' : '' ?>  <?=    $value['status_inspection'] == 3 ? 'disabled' : '' ?>>
                      <option value="">---</option>
                      <?php foreach ($wps_list[$value['project']][$value['discipline']][$value['company_id'] == 2472 ? '2217' : $value['company_id']] as $keywps => $valuewps) { ?>
                        <option <?= in_array( $valuewps['id_wps'], $wps_no_display) ? 'selected' : '' ?> value="<?= $valuewps['id_wps'] ?>"><?= $valuewps['wps_no'] ?></option>
                      <?php } ?>
                    </select>

                  </td>
                  <?php } ?>
                  
                  <td>
                    <?php if($value['status_inspection'] != 2 AND !isset($value['status_inspection'])){ ?>
                      <textarea name='remarks[<?php echo $no; ?>]' placeholder="---" disabled></textarea>
                    <?php } else if($value['status_inspection'] == 2 OR $value['status_inspection'] == 4 OR $value['status_inspection'] == 6 OR $value['status_inspection'] == 11 OR $value['status_inspection'] == 9 OR $value['status_inspection'] == 0){ ?>  
                      <textarea name='remarks[<?php echo $no; ?>]' placeholder="---" disabled><?php echo $value["remarks"]; ?></textarea>
                    <?php } else { ?>  
                      <?php echo $value["remarks"]; ?>                                         
                    <?php } ?> 
                  </td>

                  <td> 
                      <?php if(isset($value["area_v2"])){  ?>                  
                         <?= $area_name_arr_v2[$value["area_v2"]].",".$location_name_arr_v2[$value["location_v2"]] ?>
                      <?php }  else { ?>
                        <?php echo @$area_name_arr[$value["area"]]; ?>  
                      <?php } ?>
                  </td>

                  <td>
                      <?php echo $company_name[$value['company_id']] ?>
                  </td>

                  <td>
                      <?php if(!isset($status_client_rejected)){ ?>

                        <?php if(isset($image_fu[$value['id_joint']])){ ?>
                          <!-- <span class='btn btn-primary' onclick="show_image(this, '<?= $image_fu[$value['id_joint']] ?>', 'surveyor')"><i class="fas fa-image"></i></span> -->
                          <?php  
                            $enc_redline = strtr($this->encryption->encrypt($image_fu[$value['id_joint']]), '+=/', '.-~');
                            $enc_path   = strtr($this->encryption->encrypt('/PCMS/mobile/pcms_v2_mobile/pcms_v2_photo/'), '+=/', '.-~'); 
                          ?>
                          <a target='_blank' href='<?= site_url('irn/open_file/'.$enc_redline.'/'.$enc_path) ?>'><span class='btn btn-primary'><i class="fas fa-images"></i></span></a>
                          <br/>
                        <?php } else { ?>
                            <img src="<?php echo base_url(); ?>/img/img_not_avai.png" style='width: 30px;'>
                        <?php } ?> 
                        <span class='badge'><?= (isset($user_list[$value['surveyor_creator']]) ? $user_list[$value['surveyor_creator']] : $user_list[$value['requestor']] );  ?></span><br/>
                        <span class='badge'><?= (isset($value['surveyor_created_date']) ? $value['surveyor_created_date'] : $value['date_request']); ?></span><br/><br/>

                          <?php 
                            if(isset($value['status_surveyor'])){
                              $exlode_status_surveyor = explode(";",$value['status_surveyor']);
                              foreach($exlode_status_surveyor as $valx){
                                if(isset($surveyor_status_show[$valx])){
                                  echo "<span class='badge'>".$surveyor_status_show[$valx]["description"]."</span><br/>";
                                }
                              } 
                            }  
                          ?>

                        <span class='badge'><?= (isset($value['status_surveyor']) ? "Update By : " .   (isset($user_list[$value['last_surveyor_update_by']]) ? $user_list[$value['last_surveyor_update_by']] : "-")  : "-"); ?></span><br/>
                        <span class='badge'><?= (isset($value['status_surveyor']) ? "Update date : " . (isset($user_list[$value['last_surveyor_update_by']]) ? $value['last_surveyor_update_date'] : "-") :  "-"); ?></span> 
                      
                      <?php } else { ?>

                        <?php
                          echo "<span class='badge badge-success'>Approved</span>"; 
                          echo "<span class='badge'>".$user_list[$value['inspection_by']]."</span><br/>";  
                          echo "<span class='badge'>".date("d-F-y H:i:s",strtotime($value['inspection_datetime']))."</span><br/>";   
                        ?>

                      <?php } ?>
                  </td>
                  <td  style="text-align: left !important;">
                    <?php 
                      if(!isset($value['status_inspection'])){ 
                          if(isset($status_piecemark[$value['pos_1']]['id_mis']) && isset($status_piecemark[$value['pos_2']]['id_mis'])){ 
                            echo "<span class='badge badge-success'>Ready</span><br/>"; 
                          } else {
                            echo "<span class='badge badge-warning'>Not Ready</span><br/>"; 
                          }
                      } else if(isset($value['status_inspection']) AND $value['status_inspection'] == '0'){ 
                        echo "<center><span class='badge badge-success'>Ready</span></center><br/>"; 
                      } else if(isset($value['status_inspection']) AND $value['status_inspection'] == '1'){ 
                        echo "<span class='badge badge-info'>Pending Approval</span><br/>";
                      } else if(isset($value['status_inspection']) AND $value['status_inspection'] == '2'){ 
                        echo "<span class='badge badge-danger'>Rejected</span><br/>"; 
                        echo "<span class='badge'>".$user_list[$value['inspection_by']]."</span><br/>";  
                        echo "<span class='badge'>".date("d-F-y H:i:s",strtotime($value['inspection_datetime']))."</span><br/>";
                        echo "<span style='font-size:12px !important;'><b>Inspector Remarks :</b><br/>".$value["rejected_remarks"]."</span>";
                      } else if(isset($value['status_inspection']) AND $value['status_inspection'] == '3'){ 
                        echo "<span class='badge badge-success'>Approved</span><br/>"; 
                        echo "<span class='badge'>".$user_list[$value['inspection_by']]."</span><br/>";  
                        echo "<span class='badge'>".date("d-F-y H:i:s",strtotime($value['inspection_datetime']))."</span><br/><br/>"; 
                        if(strlen($value["inspection_remarks"]) > 0){
                        echo "<span style='font-size:10px !important;'><b>Inspector Remarks :</b><br/>".(isset($value["inspection_remarks"]) && !empty($value["inspection_remarks"]) ? $value["inspection_remarks"] : "-" )."</span>"; 
                        }
                      } else if(isset($value['status_inspection']) AND $value['status_inspection'] == '4'){ 
                        echo "<span class='badge badge-primary'>Pending By QC</span><br/>";
                        echo "<span class='badge'>".$user_list[$value['inspection_by']]."</span><br/>";  
                        echo "<span class='badge'>".date("d-F-y H:i:s",strtotime($value['inspection_datetime']))."</span><br/>";
                        echo "<span style='font-size:12px !important;'><b>Inspector Remarks :</b><br/>".$value["pending_qc_remarks"]."</span>";
                      } else if(isset($value['status_inspection']) AND $value['status_inspection'] == '5'){ 
                        echo "<span class='badge badge-success'>Transmitted</span><br/>";   
                      } else if(isset($value['status_inspection']) AND $value['status_inspection'] == '9'){ 
                        echo "<span class='badge badge-primary'>Approved & Released with comment</span><br/>";      
                      } else if(isset($value['status_inspection']) AND $value['status_inspection'] == '11'){       
                        echo "<span class='badge badge-danger'>Re-Offer By Client</span><br/>"; 
                        echo "<span class='badge'>".$user_list[$value['client_inspection_by']]."</span><br/>";  
                        echo "<span class='badge'>".date("d-F-y H:i:s",strtotime($value['client_inspection_date']))."</span><br/>";
                        echo "<span style='font-size:12px !important;'><b>Client Remarks :</b><br/>".$value["reoffer_remarks"]."</span>";
                      } else if(isset($value['status_inspection']) AND $value['status_inspection'] == '6'){       
                        echo "<span class='badge badge-danger'>Rejected</span><br/>"; 
                        echo "<span class='badge'>".$user_list[$value['client_inspection_by']]."</span><br/>";  
                        echo "<span class='badge'>".date("d-F-y H:i:s",strtotime($value['client_inspection_date']))."</span><br/>";
                        echo "<span style='font-size:12px !important;'><b>Client Remarks :</b><br/>".$value["client_remarks"]."</span>";
                      }
                    ?>

                    <input type='hidden' name='id_joint_template[<?php echo $no; ?>]' value='<?php echo $value['id']; ?>'>
                  </td>
                </tr>
                <?php $no++; endforeach; ?>
              <?php } ?>
                
              </tbody>
            </table>          
          </div>
          <?php if(isset($get['drawing_wm']) && !empty($get['drawing_wm']) && @$get['status_inspection'] == '0' OR (@$get['status_inspection'] == 'null' OR @$get['status_inspection'] == '2' OR @$get['status_inspection'] == '4')){ ?>
          <div class="text-right mt-3">
               <button type="submit" id="btn_submit" name="submit" class="btn btn-success" title="Submit" disabled>Submit</button>           
          </div>
          <?php } ?>
          <?php else: ?>
            <div class="col-md-12">
                <b class="text-danger"><i class="fas fa-info-circle"></i> Please Filter by Project First !</b>
            </div>
           <?php endif; ?>

          
          <?php if($mode == 'transmittal' && isset($drawing_fltr)){ ?>
            <?php if(sizeof($joint_list) > 0){ ?>
              <?php //echo "1"; ?>
              <?php if($no_hidden <= 0){ ?> 
                <?php //echo "2"; ?>
                <?php if($no_waiting_drawing <= 0){ ?> 
                  <?php //echo "3"; ?> 
                  <div class="text-right mt-3">
                    <button type="submit" id="btn_submit" name="submit" class="btn btn-success" title="Submit" disabled>Submit </button>           
                  </div>
                <?php } ?>
              <?php } ?>
            <?php } ?>
          <?php } ?>


        </div>
      </div>
    </div>
  </div>
  
</form>

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

<?php } ?>

  <script>

    $("select[name=module]").chained("select[name=project]");

    

<?php   if( (isset($get['drawing_no']) && !empty($get['drawing_no']))){ ?>
    $('.dataTable').DataTable({
         "paging":   false,
         "ordering": false, 
    })
    <?php   } else { ?>
      $('.dataTable').DataTable({
        order: [],
        columnDefs: [{
          "targets": 0,
          "orderable": false,
        }]
      })
    <?php  } ?>
    
    function open_disabled_form(val,no,status_inspection) {
 

      var $checkboxes = $('#form_submition td input[type="checkbox"]');          
      $checkboxes.change(function(){
          var countCheckedCheckboxes = $checkboxes.filter(':checked').length;
          $('#total_data_checked').text(countCheckedCheckboxes);            
          $('#total_data_checked_val').val(countCheckedCheckboxes);

          if (countCheckedCheckboxes > 0) {
            $("#btn_submit").removeAttr('disabled');
          } else {
            $("#btn_submit").attr('disabled', true);
          }

          if(countCheckedCheckboxes <= 50){

            if($(val).prop("checked") == true){
               $('select[name="fitter_id['+no+'][]"]').prop("disabled", false);
               $('textarea[name="remarks['+no+']"]').prop("disabled", false);
               $('input[name="filter_check['+no+']"]').val(1);

            } else {     
               $('textarea[name="remarks['+no+']"]').prop("disabled", true);

               if(status_inspection != 2 && status_inspection != 4 && status_inspection != 6 && status_inspection != 0){

                 $('select[name="fitter_id['+no+'][]"]').find('option:selected').remove();

               }

               $('input[name="filter_check['+no+']"]').val(0);
            }

          } else {

             alert("Sorry, Data checked has been maximum..");
             $('select[name="fitter_id['+no+'][]"]').prop("disabled", true);
             $('textarea[name="remarks['+no+']"]').prop("disabled", true);

             if(status_inspection != 2 && status_inspection != 4 && status_inspection != 6 && status_inspection != 0){

               $('select[name="fitter_id['+no+'][]"]').find('option:selected').remove();

             }

             $('input[name="filter_check['+no+']"]').val(0);

          }
      });

        

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

      
  

  $(".autocomplete_doc, .autocomplete_wm").autocomplete({
    source: function( request, response ) {

      var project         = $("select[name='project']").find('option:selected').val();  
      var drawing_type    = $("select[name='drawing_type']").find('option:selected').val(); 
      var discipline      = $("select[name='discipline']").find('option:selected').val(); 
      var module          = $("select[name='module']").find('option:selected').val(); 
      var type_of_module  = $("select[name='type_of_module']").find('option:selected').val(); 
      var drawing_wm      = $("input[name='drawing_wm']").val(); 
      var type_of_module  = $("select[name='type_of_module']").find('option:selected').val();  

      $.ajax( {
        url: "<?php echo base_url() ?>fitup/autocomplete_drawing_joint",
        type: "post",
        dataType: "json",
        data: {
          term: request.term,
          project: project,
          drawing_type: drawing_type,
          discipline: discipline,
          module: module,
          type_of_module: type_of_module,
          drawing_wm: drawing_wm,
        },
        success: function( data ) {
          response( data );
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
      url: "<?php echo base_url() ?>fitup/get_data_drawing",
      dataType: "json",
      data: {
        document_no: document_no,
        module: module,
      },
      success: function(data) {
        //console.log(data);
        if(data.drawing_type == 1 || data.drawing_type == 2  || data.drawing_type == 13 || data.drawing_type == 9 || data.drawing_type == 14 || data.drawing_type == 12 ){
          $("select[name=project]").val(data.project).trigger('change');
          $("select[name=discipline]").val(data.discipline);
          $("select[name=drawing_type]").val(data.drawing_type);
          if(module == ""){
            $("select[name=module]").val(data.module);            
          }
          $("select[name=type_of_module]").val(data.type_of_module);
          <?php if($mode == 'transmittal'){ ?>
             $("select[name=status_inspection]").change().val(3);
          <?php } else { ?>
             $("select[name=status_inspection]").change().val(0);  
          <?php } ?>


          $("select[name=project]").prop("disabled", false);
          $("select[name=discipline]").prop("disabled", false);
          $("select[name=drawing_type]").prop("disabled", false);
          $("select[name=module]").prop("disabled", false);
          $("select[name=type_of_module]").prop("disabled", false);

          $("#button_search").prop("disabled", false);

         }
      }
    });
  }

  function get_fitter_code(no) {
    console.log(no);
      $.ajax({
        url: "<?php echo base_url();?>fitup/get_fitter_ajax",
        type: "post",
        success: function(data) {
              if(data.includes("Error")){
                $('.fitter_'+no).find('option').remove().end();
                Swal.fire(
                  'Warning',
                  'Sorry, No Fitter ID Available',
                  'warning'
                );
              } else {
                 $('.fitter_'+no).find('option').remove().end();
                  $.each(JSON.parse(data), function(i, obj){
                       $('.fitter_'+no).append($('<option>').text(obj.text).attr('value', obj.val));
                  });
              }
        }
      });  
  }
  
</script>

<script type="text/javascript">
  

  $(document).ready(function() {

    $("#mySelect").select2();

     
      if($("input[name=drawing_no]").val() != ""){
          $("select[name=project]").prop("disabled", false);
          $("select[name=discipline]").prop("disabled", false);
          $("select[name=drawing_type]").prop("disabled", false);
          $("select[name=module]").prop("disabled", false);
          $("select[name=type_of_module]").prop("disabled", false);
           $("#button_search").prop("disabled", false);
      }

      $(".select2_multiple_fitter").select2({
        // tags: true,
        tokenSeparators: [',', ' '],
        ajax: {
              url: "<?php echo base_url();?>fitup/get_fitter_ajax",
              type: "post",
              dataType       : 'json',
              data: function (params) {
                var query = {
                  search: params.term
                }
                return query;
              },
              processResults: function (data) {
                return {
                  results: data
                }
              }
            }
      })
  });

  function show_image(btn, source, type) {

      if (type == "client") {
        var url = "<?= $this->link_server ?>/pcms_v2_photo/fab_img/" + source
      } else {
        var url = "<?= $this->link_server ?>/pcms_v2_photo/" + source

      }


      var image_content = `
        <div class="row">
          <div class="col-md-12">
            <img src="${url}" style="width : 100%">
          </div>
          <div class="col-md-12">
            <hr>
            <div class="float-right">
              <button class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
            </div>
          </div>
        </div>
      `

      $("#modal").modal({
        show: true,
        keyboard: false,
        backdrop: "static"
      }).find('.modal-body').html(image_content)
      $('.modal-title').text("Attachment")
      $('.modal-dialog').addClass('modal-lg')
  }

      function reset_pages(){
        var link = "<?= base_url(); ?>fitup/joint_list/<?= $mode ?>";
        window.location.replace(link);
      }

      function autofilter(){
        $('#form-filter').submit();
      }

      function append_drawing_links(rev,drawing_type) {

        var rev_oke = $(rev).val();

        if(drawing_type == 0){ 
          $(".add_drawing_ga_as").text(""); 
          var links = "<?= base_url_ftp_eng() ?>public_smoe/open_atc/2/<?= strtr($this->encryption->encrypt(@$activity_eng[@$get['drawing_no']]['id']), '+=/', '.-~') ?>/"+ rev_oke;
          $(".add_drawing_ga_as").append('<a target="_blank" href="'+links+'"><?= @$get['drawing_no'] ?> (Rev. '+ rev_oke +')</a>');
        } else { 
          $(".add_drawing_ga_wm").text(""); 
          var links = "<?= base_url_ftp_eng() ?>public_smoe/open_atc/2/<?= strtr($this->encryption->encrypt(@$activity_eng[@$get['drawing_wm']]['id']), '+=/', '.-~') ?>/"+ rev_oke;
          $(".add_drawing_ga_wm").append('<a target="_blank" href="'+links+'"><?= @$get['drawing_wm'] ?> (Rev. '+ rev_oke +')</a>');
        }

        
      }

    function find_deck_by_project(select) {
      var project_id = $(select).val()
      if(project_id != 21){
        $("#deck_change").removeAttr('required');
        $("#div_deck").addClass('d-none');
      } else {
        $("#div_deck").removeClass('d-none');
        $("#deck_change").attr('required', true);
      }
    }


</script>

</div>
</div><!-- ini div dari sidebar yang class wrapper -->
<script type="text/javascript">
  $("select[name=location]").chained("select[name=area]");

  $("select[name=point]").chained("select[name=location]");
</script>