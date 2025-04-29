<div id="content" class="container-fluid">

  <style type="text/css">
    .disabled-effect {
      pointer-events: none;
      opacity:0.5;
    }
  </style>

  <style>
    .card-box {
        position: relative;
        color: #fff;
        padding: 10px 5px 10px;
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
        font-size: 27px;
        font-weight: bold;
        margin: 0 0 8px 0;
        white-space: nowrap;
        padding: 0;
        text-align: left;
    }

    .card-box p {
        font-size: 15px;
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
        background-color: #00c0ef !important;
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
  </style>

  <style> 
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
</style> 

  <?php 
    error_reporting(0);
    // print_r($get['status_inspection']);
    if($get['status_inspection']!=0 && $get['status_inspection']!=2 && $get['status_inspection']!=4){
      $submit_none = 'd-none';
    }
  ?>
  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">Visual Testing | Filter Joint for Submission</h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <form action="" method="GET">
            <div class="row">

              <div class="col-md-6">
                <div class="form-group row">
                  <label for="" class="col-xl-3 col-form-label text-muted text-muted"><strong>Workpack Number</strong></label>
                  <div class="col-xl">
                    <input type="text" name="workpack_no" class="form-control workpack_no" placeholder="Work Pack Number"
                      value="<?= $get['workpack_no'] ? $get['workpack_no'] : '' ?>">
                  </div>
                </div>
              </div>
              <div class="col-12"></div>

              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label text-muted ">Project ID</label>
                  <div class="col-xl">
                    <select class="form-control" name="project" id="project_js">
                      <?php if($this->permission_cookie[0] == 1){ ?>  
                        <option value="">---</option>                        
                        <?php foreach ($project_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$get['project'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                        <?php endforeach; ?>
                      <?php } else { ?>
                        <?php foreach ($project_list as $key => $value) : ?>
                          <?php if($this->user_cookie[10] == $value['id']){ ?>
                            <option value="<?php echo $value['id'] ?>" <?php echo ($this->user_cookie[10] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                          <?php } ?>
                        <?php endforeach; ?>
                      <?php } ?>
                    </select>
                    <script type="text/javascript">
                      var project_js
                      function save_project(){
                        project_js = $('#project_js').val()
                        console.log(project_js)
                      }
                    </script>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label text-muted ">Discipline</label>
                  <div class="col-xl">
                    <select class="form-control" name="discipline" id="discipline_js">
                      <option value="">---</option>
                      <?php foreach ($discipline_list as $key => $value) : ?>
                      <option onclick="save_discipline()" value="<?php echo $value['id'] ?>" <?php echo (@$get['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                    <script type="text/javascript">
                      var discipline_js
                      function save_discipline(){
                        discipline_js = $('#discipline_js').val()
                        console.log(discipline_js)
                      }
                    </script>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-6"><?php //test_var($module_list, 1) ?>
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label text-muted ">Module</label>
                  <div class="col-xl">
                    <select class="form-control" name="module" id="module_js">
                      <option value="">---</option>
                      <?php foreach ($module_list as $key => $value) : ?>

                      <option onclick="save_module()" value="<?php echo $value['mod_id'] ?>" data-chained="<?php echo $value['project_id'] ?>" <?php echo (@$get['module'] == $value['mod_id'] ? 'selected' : '') ?>><?php echo $value['mod_desc'] ?></option>
                      <?php endforeach; ?>
                    </select>
                    <script type="text/javascript">
                      var module_js
                      function save_module(){
                        module_js = $('#module_js').val()
                        console.log(module_js)
                      }
                    </script>
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label text-muted ">Type of Module</label>
                  <div class="col-xl">
                    <select class="form-control" name="type_of_module">
                      <option value="">---</option>
                      <?php foreach ($type_of_module_list as $key => $value) : ?>
                      <option onclick="save_type_module()" value="<?php echo $value['id'] ?>" <?php echo (@$get['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                    <script type="text/javascript">
                      var type_module_js
                      function save_type_module(){
                        type_module_js = $('#type_module_js').val()
                        console.log(type_module_js)
                      }
                    </script>
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label text-muted ">Deck Elevation / Service Line</label>
                  <div class="col-xl">
                    <select class="form-control" name="deck_elevation">
                      <option value="">---</option>
                      <?php foreach ($deck_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo (@$get['deck_elevation'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label text-muted ">Drawing Type</label>
                  <div class="col-xl">
                    <select class="form-control" name="drawing_type" id="drawing_type_js">
                      <option value="">---</option>
                      <option value="1" <?php echo (@$get['drawing_type'] == '1' ? 'selected' : '') ?> onclick="save_drawing_type()">GA</option>
                      <option value="2" <?php echo (@$get['drawing_type'] == '2' ? 'selected' : '') ?> onclick="save_drawing_type()">Assembly</option>
                      <option value="3" <?php echo (@$get['drawing_type'] == '3' ? 'selected' : '') ?> onclick="save_drawing_type()">Weldmap</option>
                    </select>
                    <script type="text/javascript">
                      var drawing_type_js
                      function save_drawing_type(){
                        drawing_type_js = $('#drawing_type_js').val()
                        console.log(drawing_type_js)
                      }
                    </script>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label text-muted ">Drawing Number</label>
                  <div class="col-xl">
                    <!-- <input type="text" class="form-control autocomplete_doc" name="drawing_no" value="<?php echo @$get['drawing_no'] ?>"> -->

                    <select class="form-control select2" name="drawing_no">
                      <option value="">---</option>
                      <?php foreach ($drawing_lis as $key => $value) { ?>
                        <option value="<?= $value['drawing_no'] ?>" <?= $get['drawing_no']==$value['drawing_no'] ? 'selected' : '' ?>><?= $value['drawing_no'] ?></option>
                      <?php } ?>
                    </select>

                    <span style="color:red;font-weight: bold;font-style: italic;">Please choice Drawing Number for Submit Data</span>
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label text-muted ">Weld Map Number</label>
                  <div class="col-xl">
                    <input type="text" class="form-control autocomplete_wm" name="drawing_wm" value="<?php echo @$get['drawing_wm'] ?>">
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label text-muted ">Joint Class</label>
                  <div class="col-xl">
                    <select class="form-control" name="class">
                      <option value="">---</option>
                      <?php foreach ($class_list as $key => $value){?>
                        <option value="<?= $value['id'] ?>" <?= $value['id']==$get['class'] ? 'selected' : '' ?>><?= $value['class_code'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label text-muted ">Submission Status</label>
                  <div class="col-xl">
                    <select class="form-control" name="status_inspection">
                      <option value="">---</option>
                      <option value="0" <?= $filter_status_inspection==0 ? 'selected' : '' ?>>Ready</option>
                      <option value="2" <?= $filter_status_inspection==2 ? 'selected' : '' ?>>Rejected</option>
                      <option value="4" <?= $filter_status_inspection==4 ? 'selected' : '' ?>>Pending By QC</option>
                    </select>
                  </div>
                </div>
              </div>
              
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label text-muted ">Status Surveyor</label>
                  <div class="col-xl">
                    <select name="status_surveyor" class="form-control select2" required="">
                      <option value="">---</option>
                      <?php foreach ($surveyor_status as $key => $value){?>
                        <option value="<?= $value['id'] ?>" <?= $value['id']==$get['status_surveyor'] ? 'selected' : '' ?>><?= $value['description'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label text-muted ">Company</label>
                  <div class="col-xl">
                    <select name="company[]" class="form-control select2" multiple="">
                      <option value="">---</option>
                      <?php foreach ($company_list as $key => $value){?>
                        <option value="<?= $value['id_company'] ?>" <?= in_array($value['id_company'], $get['company']) ? 'selected' : '' ?>><?= $value['company_name'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-8 d-none">
                <div class="form-group row">                  
                  <div class="col-xl">
                    <div class="container text-right">
                      <div class="row">                      
                        <div class="col-lg-3">
                          <div class="card-box bg-green">
                            <div class="inner">
                              <h3 class="kotak_1">Please Wait ...</h3>
                              <p> Ready </p>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="card-box bg-blue">
                            <div class="inner">
                              <h3 class="kotak_2">Please Wait ...</h3>
                              <p> Pending QC</p>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="card-box bg-red">
                            <div class="inner">
                              <h3 class="kotak_3">Please Wait ...</h3>
                              <p> Rejected QC</p>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="card-box bg-secondary">
                            <div class="inner">
                              <h3 class="kotak_4">Please Wait ...</h3>
                              <p> All Status (Except Ready)</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-8"> 
                <div class="form-group row">                   
                  <div class="col-xl"> 
                    <?php if($mode != 'transmittal'){ ?> 
                      <div class="container  text-right"> 
                        <div class="row">                       
                          <div class="col-lg-3"> 
                              <div class="card-box bg-green"> 
                                  <div class="inner"> 
                                      <h3 id="kotak_1">Please Wait ...</h3> 
                                      <span id='detail_card'>Ready</span> 
                                  </div> 
                              </div> 
                          </div> 
                          <div class="col-lg-3"> 
                              <div class="card-box bg-blue"> 
                                  <div class="inner"> 
                                      <h3 id="kotak_2">Please Wait ...</h3> 
                                      <span id='detail_card'>Pending QC</span> 
                                  </div> 
                              </div> 
                          </div> 
                          <div class="col-lg-3"> 
                              <div class="card-box bg-red"> 
                                  <div class="inner"> 
                                  <h3 id="kotak_3">Please Wait ...</h3> 
                                  <span id='detail_card'>Rejected QC</span> 
                                  </div> 
                              </div> 
                          </div>
                          <div class="col-lg-3"> 
                              <div class="card-box bg-secondary"> 
                                  <div class="inner"> 
                                  <h3 id="kotak_4">Please Wait ...</h3> 
                                  <span id='detail_card'>All Status (Except Ready)</span> 
                                  </div> 
                              </div> 
                          </div> 
                        </div> 
                      </div> 
                      <script type="text/javascript">
                        $( document ).ready(function loadloadajax() {
                          $.ajax({
                            url: "<?php echo base_url() ?>visual/production_rfi_count",
                            type: "post",
                            dataType: "json",
                            data: {
                            },
                            success: function( data ) {
                              console.log(data)

                              $('#kotak_1').text(data['pending']+' Joints')
                              $('#kotak_2').text(data['pending_qc']+' Joints')
                              $('#kotak_3').text(data['reject']+' Joints')
                              $('#kotak_4').text(data['all_without_readytoinspect']+' Joints')
                              setTimeout(function(){loadloadajax();}, 30000);
                            }
                          });
                        })
                      </script>
                    <?php } ?> 
                  </div> 
                </div> 
              </div>

              <div class="col-12 text-right">
                <hr>
                <button class="mt-2 btn btn-sm btn-flat btn-info" name="submit" value="search"><i class="fas fa-search"></i> Search</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  
  <?php if(isset($get['drawing_no'])): ?>
    <div class="row">
      <div class="col">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0">Visual Testing | Joint for Submission</h6>
          </div>
          <div class="card-body bg-white">
            <?php if($filter_status_inspection!=2){ ?>
              <form method="POST" action="<?php echo base_url() ?>visual/submit_to_draft" id="formsubmite">
            <?php } else { ?>
              <form method="POST" action="<?php echo base_url() ?>visual/submit_to_draft_reject" id="formsubmite">
            <?php } ?>
              <div class="row <?= $submit_none ?>" style="margin-bottom: 10px !important">
                <div class="col">
                  <label><b>Requestor Company</b></label>
                  <input type="text" name="company" class="form-control" value="<?= $company[$this->user_cookie[11]]['company_name'] ?>">
                </div>
                <div class="col">
                  <label><b>Area</b></label>
                  <select class="select3 form-control will_enable" name="area" required="">
                    <option value="">---</option>
                    <?php foreach ($area as $value_area) {?>
                      <option value="<?= $value_area['id'] ?>" <?= $data_area_v2 == $value_area['id'] ? 'selected' : '' ?>><?= $value_area['name'] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col">
                  <label><b>Location</b></label>
                  <select class="select3 form-control will_enable" name="location" required="">
                    <option value="">---</option>
                    <?php foreach ($location as $value_location) {?>
                      <option value="<?= $value_location['id'] ?>" <?= $data_location_v2 == $value_location['id'] ? 'selected' : '' ?> data-chained="<?php echo $value_location['id_area'] ?>"><?= $value_location['name'] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col">
                  <label><b>Point</b></label>
                  <select class="select3 form-control will_enable" name="point">
                    <option value="">---</option>
                    <?php foreach ($point as $value_point) {?>
                      <option value="<?= $value_point['id'] ?>" <?= $data_point_v2 == $value_point['id'] ? 'selected' : '' ?> data-chained="<?php echo $value_point['id_location'] ?>"><?= $value_point['name'] ?></option>
                    <?php } ?>
                  </select>

                  <div class="text-center">
                    <small class="text-danger"><b><i>Point not Required!</i></b></small>
                  </div>
                </div>
                <script type="text/javascript">
                  $("select[name=location]").chained("select[name=area]");
                  $("select[name=point]").chained("select[name=location]");
                </script>
              </div>

              <div class="row <?= $submit_none ?>">
                <div class="col">
                  <br>
                  <span class="btn btn-primary" id="thicked">
                    <i class="fas fa-clipboard-check"></i><b> 0</b> Item thicked
                  </span><i><b class="text-danger">&nbsp;&nbsp;*Max 30 Item Thicked Allowed</b></i>
                </div>
              </div>
              <br>
              <div class="overflow-auto">
                <table class="table table-hover text-center dataTable" width="100%" id="tablefix">
                  <thead class="bg-green-smoe text-white">
                    <tr>
                      <th style="vertical-align: middle;" rowspan="2"><b>#</b></th>

                      <th style="vertical-align: middle;" rowspan="2">Company</th>
                      <th style="vertical-align: middle;" rowspan="2">Workpack No.</th>
                      <th style="vertical-align: middle;" rowspan="2">Document No.</th>
                      <th style="vertical-align: middle;" rowspan="2">Drawing Weld Map</th>
                      <th style="vertical-align: middle;" rowspan="2">Joint No.</th>
                      <th style="vertical-align: middle;" rowspan="2">Deck Elevation / Service Line</th>
                      <th style="vertical-align: middle;" rowspan="2">Class</th>
                      <th style="vertical-align: middle;" rowspan="2">Weld Type</th> 
                      <th style="vertical-align: middle;" rowspan="2">Cons/Lot No.</th><!-- input -->
                      <th style="vertical-align: middle;" rowspan="1" colspan="2">Weld Process</th><!-- input -->
                      <th style="vertical-align: middle;" rowspan="1" colspan="2" style="min-width: 300px !important">Welder ID</th><!-- input -->
                      <th style="vertical-align: middle;" rowspan="1" colspan="2" style="min-width: 300px !important">WPS</th><!-- input -->
                      <th style="vertical-align: middle;" rowspan="2">NDT REQ.</th>
                      <th style="vertical-align: middle;" rowspan="2">DIA (INCH)</th>
                      <th style="vertical-align: middle;" rowspan="2">THK (MM)</th>

                      <th style="vertical-align: middle;" rowspan="2" style="min-width: 150px !important">Weld Length (MM)</th><!-- input -->
                      <th style="vertical-align: middle;" rowspan="2" style="min-width: 300px !important">Weld Date</th><!-- input -->

                      <th style="vertical-align: middle;" rowspan="2">Surveyor</th>

                      <th style="vertical-align: middle;" rowspan="2">Remarks</th>
                      <th style="vertical-align: middle;" rowspan="2">Status</th>
                    </tr>
                    <tr>
                      <th style="vertical-align: middle;" style="min-width: 150px !important">R/H</th>
                      <th style="vertical-align: middle;" style="min-width: 150px !important">F/C</th>

                      <th style="vertical-align: middle;">R/H</th>
                      <th style="vertical-align: middle;">F/C</th>

                      <th style="vertical-align: middle;">R/H</th>
                      <th style="vertical-align: middle;">F/C</th>
                    </tr>
                  </thead>
                  <tbody style="vertical-align: middle;">
                    <?php 
                    $juml = 0;
                    foreach ($joint_list as $key => $value):
                      // test_var($value);
                    ?>
                    <tr style="vertical-align: middle;">
                      <td style="vertical-align: middle;">
                        <?php if($value['status_inspection']==3 OR $value['status_inspection']==5 OR $value['status_inspection']==7){ ?>
                          <i class="fas fa-check-square" style="color: green"></i>
                        <?php } elseif($value['status_inspection']==1){ ?>
                          <i class="fas fa-edit" style="color: #17A2B8"></i>
                        <?php } elseif($value['status_inspection']==6){ ?>
                          <i class="fas fa-times" style="color: red"></i>
                        <?php } else { ?>
                          <?php 
                            if(
                              $fitup_data[$value['id_joint']]['inspection_datetime']!='' AND $fitup_data[$value['id_joint']]['status_invitation']!=''
                            ){
                              // echo "1x";
                              if($fitup_data[$value['id_joint']]['status_invitation']==0 AND $fitup_data[$value['id_joint']]['status_inspection']!=7){

                                $current_date           = new DateTime(date("Y-m-d H:i:s"));
                                $visual_time_inspec = new DateTime($fitup_data[$value['id_joint']]["time_inspect"]); 
                                $diff = $visual_time_inspec->diff($current_date);
                                $hours  = round($diff->s / 3600 + $diff->i / 60 + $diff->h + $diff->days * 24, 2);

                                if($hours>=24){
                                  $checkbox_status = '';
                                  $checkbox_title  = '';
                                } else {
                                  $checkbox_status = 'd-none';
                                  $checkbox_title  = "Can Not Process Until Fitup Status 'Acc.' due to Holdpoint/Withness";
                                }

                                // echo "2x";
                              } else {
                                $checkbox_status = '';
                                $checkbox_title  = '';
                                // echo "3x";
                              }
                            } else {
                              $checkbox_status = '';
                              $checkbox_title  = '';
                              // echo "4x";
                            }

                            if(!in_array('3', explode(';', $value['status_surveyor'])) AND $value['status_inspection']!=2){
                              $checkbox_status = 'd-none';
                              $checkbox_title  = "Can Not Process Until Status Ready to Inspect!";
                            }

                          ?>
                            <?php if($checkbox_status!='d-none'){ ?>
                              <div class="custom-control custom-checkbox mr-sm-2 div_<?= $key ?> <?= $user_permission[39]==1 ? '' : 'd-none' ?> <?= $status_submit ?> <?= $checkbox_status ?>">
                                <input type="checkbox" class="custom-control-input ini_checkbox cb<?= $key ?> id_<?= $value['drawing_no'] ?>_<?= $value['discipline'] ?>_<?= $value['module'] ?>" id="customControlAutosizing<?= $key ?>" name="id[<?= $key ?>]" value='<?php echo $value['id'] ?>' onclick='enable_edit("<?= $key ?>", this, "id_<?= $value['drawing_no'] ?>_<?= $value['discipline'] ?>_<?= $value['module'] ?>")' <?= ($value['status_inspection']==3 OR $value['status_inspection']==5) ? 'disabled' : '' ?>>
                                <input disabled class="form-control will_enable<?= $key ?>" type="hidden" name="id_visual[<?= $key ?>]" value="<?= $value['id_visual'] ?>">
                                <input disabled class="form-control will_enable<?= $key ?>" type="hidden" name="id_workpack[<?= $key ?>]" value="<?= $value['id_workpack'] ?>">
                                <input disabled class="form-control will_enable<?= $key ?>" type="hidden" name="surveyor_creator[<?= $key ?>]" value="<?= $value['surveyor_creator'] ?>">
                                <input disabled class="form-control will_enable<?= $key ?>" type="hidden" name="surveyor_created_date[<?= $key ?>]" value="<?= $value['surveyor_created_date'] ?>">
                                <label class="custom-control-label" for="customControlAutosizing<?= $key ?>"></label>
                              </div>
                            <?php } else { ?>
                              <div title="<?= $checkbox_title ?>">
                                <span class="badge badge-warning" style="min-width: 20px !important">
                                  <i class="fas fa-info"></i>
                                </span>
                              </div>
                            <?php } ?>
                        <?php } ?>
                      </td>

                      <td ><strong><?php echo $company[$value['company_id']]['company_name'] ?></strong></td>
                      <td ><?php echo $value['workpack_no'] ?></td>
                      <td ><?php echo $value['drawing_no']?></td>

                      <td ><?php echo $value['drawing_wm'].' (Rev. '.$value['rev_wm'].')' ?></td>

                      <td ><?php echo $value['joint_no'].($value['revision']>0 ? (' ('.$value['revision_category'].$value['revision'].')') : '') ?></td>

                      <td >
                        <?php echo $master_deck[$value['deck_elevation']] ?>
                        <br>
                        <?= $value['grid_row'].' / '.$value['grid_column'] ?>
                      </td>

                      <td ><?php echo $master_class[$value['class']] ?></td>

                      <td ><?php echo isset($weld_type[$value['weld_type']]['weld_type']) ? @$weld_type[$value['weld_type']]['weld_type'] : '-' ?></td>

                      <td ><input disabled class="form-control will_enable<?= $key ?>" type="text" name="cons_lot_no[<?= $key ?>]" value="<?= $value['cons_lot_no'] ?>"></td>

                      <td >
                        <div class="form-check text-left">
                          <input name="weld_process_rh[<?= $key ?>][]" <?= $value['process_gtaw_rh']==1 ? 'checked' : '' ?> type="checkbox" class="form-check-input  all weld_process_rh_<?= $key ?>" id="gtaw_rh<?= $key ?>" value='GTAW'>
                          <label class="form-check-label" for="gtaw_rh<?= $key ?>">GTAW</label>
                        </div>
                        <div class="form-check text-left">
                          <input name="weld_process_rh[<?= $key ?>][]" <?= $value['process_gmaw_rh']==1 ? 'checked' : '' ?> type="checkbox" class="form-check-input  all weld_process_rh_<?= $key ?>" id="gmaw_rh<?= $key ?>" value='GMAW'>
                          <label class="form-check-label" for="gmaw_rh<?= $key ?>">GMAW</label>
                        </div>
                        <div class="form-check text-left">
                          <input name="weld_process_rh[<?= $key ?>][]" <?= $value['process_smaw_rh']==1 ? 'checked' : '' ?> type="checkbox" class="form-check-input  all weld_process_rh_<?= $key ?>" id="smaw_rh<?= $key ?>" value='SMAW'>
                          <label class="form-check-label" for="smaw_rh<?= $key ?>">SMAW</label>
                        </div>
                        <div class="form-check text-left">
                          <input name="weld_process_rh[<?= $key ?>][]" <?= $value['process_fcaw_rh']==1 ? 'checked' : '' ?> type="checkbox" class="form-check-input  all weld_process_rh_<?= $key ?>" id="fcaw_rh<?= $key ?>" value='FCAW'>
                          <label class="form-check-label" for="fcaw_rh<?= $key ?>">FCAW</label>
                        </div>
                        <div class="form-check text-left">
                          <input name="weld_process_rh[<?= $key ?>][]" <?= $value['process_saw_rh']==1 ? 'checked' : '' ?> type="checkbox" class="form-check-input  all weld_process_rh_<?= $key ?>" id="saw_rh<?= $key ?>" value='SAW'>
                          <label class="form-check-label" for="saw_rh<?= $key ?>">SAW</label>
                        </div>
                      </td>
                      <td >
                        <div class="form-check text-left">
                          <input name="weld_process_fc[<?= $key ?>][]"<?= $value['process_gtaw_fc']==1 ? 'checked' : '' ?> type="checkbox" class="form-check-input  all weld_process_fc_<?= $key ?>" id="gtaw_fc<?= $key ?>" value='GTAW'>
                          <label class="form-check-label" for="gtaw_fc<?= $key ?>">GTAW</label>
                        </div>
                        <div class="form-check text-left">
                          <input name="weld_process_fc[<?= $key ?>][]"<?= $value['process_gmaw_fc']==1 ? 'checked' : '' ?> type="checkbox" class="form-check-input  all weld_process_fc_<?= $key ?>" id="gmaw_fc<?= $key ?>" value='GMAW'>
                          <label class="form-check-label" for="gmaw_fc<?= $key ?>">GMAW</label>
                        </div>
                        <div class="form-check text-left">
                          <input name="weld_process_fc[<?= $key ?>][]"<?= $value['process_smaw_fc']==1 ? 'checked' : '' ?> type="checkbox" class="form-check-input  all weld_process_fc_<?= $key ?>" id="smaw_fc<?= $key ?>" value='SMAW'>
                          <label class="form-check-label" for="smaw_fc<?= $key ?>">SMAW</label>
                        </div>
                        <div class="form-check text-left">
                          <input name="weld_process_fc[<?= $key ?>][]"<?= $value['process_fcaw_fc']==1 ? 'checked' : '' ?> type="checkbox" class="form-check-input  all weld_process_fc_<?= $key ?>" id="fcaw_fc<?= $key ?>" value='FCAW'>
                          <label class="form-check-label" for="fcaw_fc<?= $key ?>">FCAW</label>
                        </div>
                        <div class="form-check text-left">
                          <input name="weld_process_fc[<?= $key ?>][]"<?= $value['process_saw_fc']==1 ? 'checked' : '' ?> type="checkbox" class="form-check-input  all weld_process_fc_<?= $key ?>" id="saw_fc<?= $key ?>" value='SAW'>
                          <label class="form-check-label" for="saw_fc<?= $key ?>">SAW</label>
                        </div>
                      </td>

                      <td class="rh_welder" style="min-width: 150px !important">
                        <div id='table_rh<?= $key; ?>'>
                          <?php $arr_welder_rh[$key] = explode(';', $value['welder_ref_rh'])?>
                            <div class="input-group mb-3 form-check form-check-inline">
                              <input type="text" class="form-control will_enable<?= $key ?> auto_rh_999 fwrh rh_<?= $key_welder_rh ?>" onfocus="welder_autocomplete_rh('999', '<?= $key ?>')" name="welder_rh[<?= $key ?>][]" disabled>
                              <span class="btn btn-primary will_enable<?= $key ?> disabled-effect" onclick="add_rh('<?= $key ?>')" disabled>
                                <i class="fas fa-plus"></i>
                              </span>
                            </div>

                            <?php if($arr_welder_rh[$key][0]!=''){ foreach ($arr_welder_rh[$key] as $key_welder_rh => $value_welder_rh) {?> 
                              <?php if($value_welder_rh!=0){ ?>
                              <div class="input-group mb-3 form-check form-check-inline">
                                <input type="text" class="form-control will_enable<?= $key ?> auto_rh_999 fwrh rh_<?= $key_welder_rh.$value['id_visual'].$value['id_joint'] ?>" onfocus="welder_autocomplete_rh('999', '<?= $key ?>')" name="welder_rh[<?= $key ?>][]" value='<?= $welders[$value_welder_rh]["welder_code"] ?>' disabled readonly>
                                <span class="btn btn-danger will_enable<?= $key ?> disabled-effect" onclick="removeRH('<?= $key_welder_rh.$value['id_visual'].$value['id_joint'] ?>', this)" disabled>
                                  <i class="fas fa-trash"></i>
                                </span>
                              </div>
                              <?php } ?>
                            <?php }} ?>
                        </div>
                      </td>

                      <td style="min-width: 150px !important">
                        <div id='table_fc<?= $key; ?>'>
                          
                          <?php $arr_welder_fc[$key] = explode(';', $value['welder_ref_fc'])?>
                          <div class="input-group mb-3 form-check form-check-inline">
                            <input type="text" class="form-control will_enable<?= $key ?> auto_fc_999 fwrh fc_<?= $key_welder_fc ?>" onfocus="welder_autocomplete_fc('999', '<?= $key ?>')" name="welder_fc[<?= $key ?>][]" disabled>
                            <span class="btn btn-primary will_enable<?= $key ?> disabled-effect" onclick="add_fc('<?= $key ?>')" disabled>
                              <i class="fas fa-plus"></i>
                            </span>
                          </div>

                          <?php if($arr_welder_fc[$key][0]!=''){ foreach ($arr_welder_fc[$key] as $key_welder_fc => $value_welder_fc) {?>
                            <?php if($value_welder_fc!=0){ ?>
                            <div class="input-group mb-3 form-check form-check-inline">
                              <input type="text" class="form-control will_enable<?= $key ?> auto_fc_999 fwrh fc_<?= $key_welder_fc.$value['id_visual'].$value['id_joint'] ?>" onfocus="welder_autocomplete_fc('999', '<?= $key ?>')" name="welder_fc[<?= $key ?>][]" value='<?= $welders[$value_welder_fc]["welder_code"] ?>' disabled readonly>
                              <span class="btn btn-danger will_enable<?= $key ?> disabled-effect" onclick="removeFC('<?= $key_welder_fc.$value['id_visual'].$value['id_joint'] ?>', this)" disabled>
                                <i class="fas fa-trash"></i>
                              </span>
                            </div>
                            <?php } ?>
                          <?php }} ?>
                        </div>
                      </td>

                      <td style="min-width: 150px !important">
                        <div id='wps_rh<?= $key; ?>'>
                          <?php $arr_wps_rh[$key] = explode(';', $value['wps_no_rh'])?>

                          <div class="input-group mb-3 form-check form-check-inline">
                            <input type="text" class="fwrh form-control will_enable<?= $key ?> auto_wps_rh_999" onfocus="wps_autocomplete_rh('999', '<?= $key; ?>')" name="wps_rh[<?= $key ?>][]" value='' disabled>
                            <span class="btn btn-primary will_enable<?= $key ?> disabled-effect" onclick="add_wps_rh('<?= $key ?>')" disabled>
                              <i class="fas fa-plus"></i>
                            </span>
                          </div>

                          <?php if($arr_wps_rh[$key][0]!=''){ foreach ($arr_wps_rh[$key] as $key_wps_rh => $value_wps_rh) {?> 
                            <?php if($value_wps_rh!=0){ ?>
                              <div class="input-group mb-3 form-check form-check-inline">
                                <input type="text" class="fwrh form-control will_enable<?= $key ?> auto_wps_rh_999 wrh_<?= $key_wps_rh.$value['id_visual'].$value['id_joint'] ?>" onfocus="wps_autocomplete_rh('999', '<?= $key; ?>')" name="wps_rh[<?= $key ?>][]" value='<?= $wps_desc[$value_wps_rh]["wps_no"] ?>' disabled readonly>
                                <span class="btn btn-danger will_enable<?= $key ?> disabled-effect" onclick="removeWpsRh('<?= $key_wps_rh.$value['id_visual'].$value['id_joint'] ?>', this)" disabled>
                                    <i class="fas fa-trash"></i>
                                  </span>
                              </div>
                            <?php } ?>
                          <?php }} ?>
                        </div>
                      </td>

                      <td style="min-width: 150px !important">

                        <div id='wps_fc<?= $key; ?>'>
                          <?php $arr_wps_fc[$key] = explode(';', $value['wps_no_fc'])?>

                          <div class="input-group mb-3 form-check form-check-inline">
                            <input type="text" class="fwrh form-control will_enable<?= $key ?> auto_wps_fc_999" onfocus="wps_autocomplete_fc('999', '<?= $key; ?>')" name="wps_fc[<?= $key ?>][]" value='' disabled>
                            <span class="btn btn-primary will_enable<?= $key ?> disabled-effect" onclick="add_wps_fc('<?= $key ?>')" disabled>
                              <i class="fas fa-plus"></i>
                            </span>
                          </div>

                          <?php if($arr_wps_fc[$key][0]!=''){ foreach ($arr_wps_fc[$key] as $key_wps_fc => $value_wps_fc) {?> 
                            <?php if($value_wps_fc!=0){ ?>
                            <div class="input-group mb-3 form-check form-check-inline">
                              <input type="text" class="fwrh form-control will_enable<?= $key ?> auto_wps_fc_999 wfc_<?= $key_wps_fc.$value['id_visual'].$value['id_joint'] ?>" onfocus="wps_autocomplete_fc('999', '<?= $key; ?>')" name="wps_fc[<?= $key ?>][]" value='<?= $wps_desc[$value_wps_fc]["wps_no"] ?>' disabled readonly>
                              <span class="btn btn-danger will_enable<?= $key ?> disabled-effect" onclick="removeWpsfc('<?= $key_wps_fc.$value['id_visual'].$value['id_joint'] ?>', this)" disabled>
                                  <i class="fas fa-trash"></i>
                                </span>
                            </div>
                            <?php } ?>
                          <?php }} ?>
                        </div>
                      </td>

                      <td >
                        <?php 
                          $arr_ndt_req[$key] = array();
                          if($value['mt_percent_req']>0){                          
                            array_push($arr_ndt_req[$key], 'MT');                            
                          }
                          if($value['pt_percent_req']>0){                          
                            array_push($arr_ndt_req[$key], 'PT');                            
                          }
                          if($value['ut_percent_req']>0){                          
                            array_push($arr_ndt_req[$key], 'UT');                            
                          }
                          if($value['rt_percent_req']>0){                          
                            array_push($arr_ndt_req[$key], 'RT');                            
                          }
                          // test_var($value, 1);
                          // test_var($arr_ndt_req[$key], 1);
                        ?>

                        <table>
                          <tr>
                            <td>
                              <div class="form-check text-left">
                                <input name="ndt_req[<?= $key ?>][]" <?= $value['mt_percent_req']>0 ? 'checked' : '' ?> type="checkbox" class="form-check-input  all" id="ndt_mt<?= $key ?>" value='2'>
                                <label class="form-check-label" for="ndt_mt<?= $key ?>">MT</label>
                              </div>
                            </td>
                            <td>
                              <div class="form-check text-left">
                                <input name="ndt_req[<?= $key ?>][]" <?= $value['pt_percent_req']>0 ? 'checked' : '' ?> type="checkbox" class="form-check-input  all" id="ndt_pt<?= $key ?>" value='7'>
                                <label class="form-check-label" for="ndt_pt<?= $key ?>">PT</label>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <div class="form-check text-left">
                                <input name="ndt_req[<?= $key ?>][]" <?= $value['ut_percent_req']>0 ? 'checked' : '' ?> type="checkbox" class="form-check-input  all" id="ndt_ut<?= $key ?>" value='3'>
                                <label class="form-check-label" for="ndt_ut<?= $key ?>">UT</label>
                              </div>
                            </td>
                            <td>
                              <div class="form-check text-left">
                                <input name="ndt_req[<?= $key ?>][]" <?= $value['rt_percent_req']>0 ? 'checked' : '' ?> type="checkbox" class="form-check-input  all" id="ndt_rt<?= $key ?>" value='1'>
                                <label class="form-check-label" for="ndt_rt<?= $key ?>">RT</label>
                              </div>
                            </td>
                          </tr>
                        </table>
                      </td>

                      <td ><?= $value['diameter'] ?></td>
                      <td ><?= $value['thickness'] ? $value['thickness'] : $value['sch'] ?></td>              

                      <?php if($value['revision']>0){ ?>
                        <?php //test_var($value, 1) ?>
                        <td style="min-width: 100px !important"><input disabled class="form-control will_enable<?= $key ?>" type="number" name="weld_length[<?= $key ?>]" value="<?= $value['status_inspection']==2 ? $value['visual_weld_length'] : $value['weld_length'] ?>"></td>
                      <?php } else { ?>
                        <td style="min-width: 100px !important"><input readonly class="form-control " type="number" name="weld_length[<?= $key ?>]" value="<?= $value['status_inspection']==2 ? $value['visual_weld_length'] : $value['weld_length'] ?>"></td>
                      <?php } ?>

                      <td style="min-width: 320px !important">
                        <?php $weld_date_time = explode(' ', $value['weld_datetime']) ?>
                        <div class="row">
                          <div class="col-md-6">
                            <input disabled class="form-control will_enable<?= $key ?>" type="date" name="weld_date[<?= $key ?>]" value="<?= $weld_date_time[0] ?>" min="<?= $fitup_date[$value['id_joint']] ?>" onkeydown="return false">
                          </div>
                          <div class="col-md-6">
                            <input disabled class="form-control will_enable<?= $key ?>" type="time" name="weld_time[<?= $key ?>]" value="<?= $weld_date_time[1] ?>">
                          </div>
                        </div>
                      </td>

                      <!-- ==================================== -->
                      <td >
                        <?php if(isset($survey[$value['id_joint']]['evidence_vt'])){ ?>
                          <img src="https://www.smoebatam.com/pcms_v2_photo/<?= $survey[$value['id_joint']]['evidence_vt'] ?>" style='width: 60px; height: 60px' onclick="show_image(this, '<?= $survey[$value['id_joint']]['evidence_vt'] ?>', 'surveyor')"/>
                        <?php } else { ?>
                            <img src="<?php echo base_url(); ?>/img/img_not_avai.png" style='width: 60px; height: 60px'>
                        <?php } ?>
                        <br>
                        <?php if($value['surveyor_creator']){ ?>
                          <?= 'Action by <b>'.$user[$value['surveyor_creator']].($value['revision']>0 ? '' : '</b> on <b>'.DATE('d F, Y H:i:s', strtotime($value['surveyor_created_date']))).'</b>' ?>
                        <?php } else { ?>
                          <?= 'Action by <b>'.$user[$value['requestor']].($value['revision']>0 ? '' : '</b> on <b>'.DATE('d F, Y H:i:s', strtotime($value['date_request']))).'</b>' ?>
                        <?php } ?>
                        <br/><br/>

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

                          <span class='badge'><?= (isset($value['status_surveyor']) ? "Update By : " .   $user[$value['last_surveyor_update_by']] : "-"); ?></span><br/>
                          <span class='badge'><?= (isset($value['status_surveyor']) ? "Update date : " . $value['last_surveyor_update_date'] :  "-"); ?></span>
                      </td>
                      <!-- ==================================== -->

                      <td style="min-width: 120px !important">
                        <textarea disabled class="form-control will_enable<?= $key ?> fwrh" type="text" name="inspection_remarks[<?= $key ?>]"><?= $value['inspection_remarks'] ?></textarea>
                      </td>

                      <td style="min-width: 50px !important">
                        <?php  
                          if(!isset($value['status_inspection'])){
                            echo '<badge class="badge badge-sm badge-success">Ready</badge>';
                          } elseif($value['status_inspection']==0){
                            echo '<badge class="badge badge-sm badge-info">Ready</badge>';
                          } elseif($value['status_inspection']==1){
                            echo '<badge class="badge badge-sm badge-info">Inspection</badge>';
                              if(isset($value['replacing_visual_id'])){
                                echo '<br><a href="'.base_url('visual/detail_inspection/').$value['submission_id'].'/resubmit/'.$value['replacing_visual_id'].'" class="badge badge-sm badge-danger"><i class="fas fa-exchange-alt"></i></a>';
                              }
                          } elseif($value['status_inspection']==2){
                            echo '<badge class="badge badge-sm badge-danger">Rejected</badge>'; 
                            echo "<br>
                              <strong>
                              - Remarks : </strong>
                              ".$value['rejected_remarks']."
                              ";
                            ?>
                            <input disabled class="form-control will_enable<?= $key ?>" type="hidden" name="status_inspection[<?= $key ?>]" value="<?= $value['status_inspection'] ?>">
                        <?php
                          } elseif($value['status_inspection']==3){
                            echo '<badge class="badge badge-sm badge-success">Approved</badge>';
                          } elseif($value['status_inspection']==4){
                            echo '<badge class="badge badge-sm badge-warning">Comment By QC</badge>';
                             ?>
                            <input disabled class="form-control will_enable<?= $key ?>" type="hidden" name="status_inspection[<?= $key ?>]" value="<?= $value['status_inspection'] ?>">
                        <?php
                          } elseif($value['status_inspection']==5){
                            echo '<badge class="badge badge-sm badge-warning">Transmitted</badge>';
                          } elseif($value['status_inspection']==6){
                            echo '<badge class="badge badge-sm badge-danger">Client Rejected</badge>';
                          } elseif($value['status_inspection']==7){
                            echo '<badge class="badge badge-sm badge-success">Client Approved</badge>';
                          }
                        ?>
                      </td>
                        <input disabled class="form-control will_enable<?= $key ?>" type="hidden" name="revision[<?= $key ?>]" value="<?= $value['revision'] ?>">
                        <input disabled class="form-control will_enable<?= $key ?>" type="hidden" name="revision_category[<?= $key ?>]" value="<?= $value['revision_category'] ?>">
                    </tr>
                    <?php 
                      $juml++;
                    endforeach; ?>
                  </tbody>
                </table>
              </div>
              <br>
              <div class="col-md-12">
                <div class="row">
                  <?php if($user_permission[39]==1){ ?>
                  <div class="col <?= $status_submit ?>" style="max-width: 190px !important">
                    <button type="submit" name="submit" value="draft" class="btn btn-primary <?= $submit_none ?>" onclick="setBlank('0')"><i class='fas fa-paper-plane'></i> Submit Inspection</button>
                  </div>

                  <div class="col d-none">
                    <button type="submit" name="submit" value="preview" class="btn btn-danger <?= $submit_none ?>" onclick="setBlank('1')"><i class='fas fa-file-pdf'></i> Preview Inspection</button>
                  </div>
                  <?php } ?>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>

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
</div>
</div><!-- ini div dari sidebar yang class wrapper -->
<script type="text/javascript">
  var no = 0;
  function add_rh(key){
    no++;
    var html = '<div class="input-group mb-3 form-check form-check-inline ctq_row_rh_'+no+'">';
    html += '<input type="text" placeholder="Welder Tag" class="auto_rh_'+no+' form-control will_enable'+key+'" name="welder_rh['+key+'][]" value="" onfocus="welder_autocomplete_rh('+no+', '+key+')">'
    html += '<span class="btn btn-danger" onclick="delete_rh('+no+')"><i class="fas fa-times"></i></span>'
    html += '</div>'
    $('#table_rh'+key).append(html)
  }
  function removeRH(keythis, thiss){
  $('.rh_'+keythis).remove()
  $(thiss).remove()
}
  function delete_rh(key){
    $('.ctq_row_rh_'+key).remove()
  }
  function welder_autocomplete_rh(no, keyes){
    var link_welder_rh = []
    var inputs = $('.weld_process_rh_'+keyes)
    for(var i = 0; i < inputs.length; i++){
      if($(inputs[i])[0].checked==true){
        link_welder_rh.push($(inputs[i]).val())
      }
    }
    console.log(link_welder_rh)
    $('.auto_rh_'+no).autocomplete({
      source: function(request,response){
        $.post('<?php echo base_url(); ?>ndt/welder_autocomplete',{term: request.term, process: link_welder_rh}, response, 'json');
      },
      autoFocus: true,
      classes: {
        "ui-autocomplete": "highlight"
      }
    });
  }
</script>
<script type="text/javascript">
  var no_fc = 0;
  function removeFC(keythis, thiss){
    $('.fc_'+keythis).remove()
    $(thiss).remove()
  }
  function add_fc(key){
    no_fc++;
    var html = '<div class="input-group mb-3 form-check form-check-inline ctq_row_fc_'+no_fc+'">';
    html += '<input type="text" placeholder="Welder Tag" class="auto_fc_'+no_fc+' form-control will_enable'+key+'" name="welder_fc['+key+'][]" value="" onfocus="welder_autocomplete_fc('+no_fc+', '+key+')">'
    html += '<span class="btn btn-danger" onclick="delete_fc('+no_fc+')"><i class="fas fa-times"></i></span>'
    html += '</div>'
    $('#table_fc'+key).append(html)
  }
  function delete_fc(key){
    $('.ctq_row_fc_'+key).remove()
  }
  function welder_autocomplete_fc(no, keyes_rc){
    
    var link_welder_fc = []
    var inputs = $('.weld_process_fc_'+keyes_rc)
    for(var i = 0; i < inputs.length; i++){
      if($(inputs[i])[0].checked==true){
        link_welder_fc.push($(inputs[i]).val())
      }
    }
    console.log(link_welder_fc)

    $('.auto_fc_'+no).autocomplete({
      source: function(request,response){
        $.post('<?php echo base_url(); ?>ndt/welder_autocomplete',{term: request.term, process: link_welder_fc}, response, 'json');
      },
      autoFocus: true,
      classes: {
        "ui-autocomplete": "highlight"
      }
    });
  }
</script>
<script type="text/javascript">
  var no_rh = 0;

  function removeWpsRh(keythis, thiss){
    $('.wrh_'+keythis).remove()
    $(thiss).remove()
  }

  function add_wps_rh(key){
    no_rh++;
    var html = '<div class="input-group mb-3 form-check form-check-inline wps_row_rh_'+no_rh+'">';
    html += '<input type="text" placeholder="WPS RH" class="auto_wps_rh_'+no_rh+' fwrh form-control will_enable'+key+'" name="wps_rh['+key+'][]" value="" onfocus="wps_autocomplete_rh('+no_rh+', '+key+')">'
    html += '<span class="btn btn-danger" onclick="delete_wps_rh('+no_rh+')"><i class="fas fa-times"></i></span>'
    html += '</div>'
    $('#wps_rh'+key).append(html)
  }
  function delete_wps_rh(key){
    $('.wps_row_rh_'+key).remove()
  }
  

  function wps_autocomplete_rh(no, keyes){

    // var linkwps = $('.weld_process_rh_'+keyes).val()
    var linkwps = []
    var inputs = $('.weld_process_rh_'+keyes)
    for(var i = 0; i < inputs.length; i++){
      if($(inputs[i])[0].checked==true){
        linkwps.push($(inputs[i]).val())
      }
    }
    linkwps = linkwps.join('/')

    $('.auto_wps_rh_'+no).autocomplete({
      source: function(request,response){
        $.post('<?php echo base_url(); ?>visual/wps_autocomplete/',{term: request.term, linkwps: linkwps}, response, 'json');
      },
      autoFocus: true,
      classes: {
        "ui-autocomplete": "highlight"
      }
    });
  }
</script>
<script type="text/javascript">
  var no_fc = 0;

  function removeWpsfc(keythis, thiss){
    $('.wfc_'+keythis).remove()
    $(thiss).remove()
  }

  function add_wps_fc(key){
    no_fc++;
    var html = '<div class="input-group mb-3 form-check form-check-inline wps_row_fc_'+no_fc+'">';
    html += '<input type="text" placeholder="WPS FC" class="auto_wps_fc_'+no_fc+' fwrh form-control will_enable'+key+'" name="wps_fc['+key+'][]" value="" onfocus="wps_autocomplete_fc('+no_fc+', '+key+')">'
    html += '<span class="btn btn-danger" onclick="delete_wps_fc('+no_fc+')"><i class="fas fa-times"></i></span>'
    html += '</div>'
    $('#wps_fc'+key).append(html)
  }
  function delete_wps_fc(key){
    $('.wps_row_fc_'+key).remove()
  }
  

  function wps_autocomplete_fc(no, keyes){

    // var linkwps = $('.weld_process_fc_'+keyes).val()
    // console.log('linkwps')
    // console.log(linkwps)
    var linkwps = []
    var inputs = $('.weld_process_rh_'+keyes)
    for(var i = 0; i < inputs.length; i++){
      if($(inputs[i])[0].checked==true){
        linkwps.push($(inputs[i]).val())
      }
    }
    linkwps = linkwps.join('/')

    $('.auto_wps_fc_'+no).autocomplete({
      source: function(request,response){
        $.post('<?php echo base_url(); ?>visual/wps_autocomplete/',{term: request.term, linkwps: linkwps}, response, 'json');
      },
      autoFocus: true,
      classes: {
        "ui-autocomplete": "highlight"
      }
    });
  }
</script>
<script type="text/javascript">
  function setBlank(kondisi){
    if(kondisi==1){
      $("form").attr("target","_blank");
    } else {
      $("form").removeAttr("target");
    }
  }
</script>
<script type="text/javascript">
  $('.all').on('select2:unselecting', function (e) {
      setTimeout(function(){ 
          console.log($('.all').val())
          // $(this).closest('tr').find('.auto_rh_999').val('')
        }, 5000);
  });
</script>
<script>
  $( document ).ready(function() {
    $('#tablefix').DataTable({
      order: [],
      // paging: false,
      columnDefs: [{
        scrollY:        300,
        scrollX:        true,
        scrollCollapse: true,
        fixedColumns:   true
      }]
    })
  })

  $(".autocomplete_doc").autocomplete({
    source: function( request, response ) {
      $.ajax( {
        url: "<?php echo base_url() ?>visual/autocomplete_drawing",
        dataType: "json",
        data: {
          term: request.term,
          drawing_type: 1,

          project :$('#project_js').val(),
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

  $('.workpack_no').autocomplete({
    source: "<?php echo base_url(); ?>visual/autocomplete_workpack_no",
    autoFocus: true,
    classes: {
      "ui-autocomplete": "highlight"
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

          project :$('#project_js').val(),
          discipline  :discipline_js,
          module  :module_js,
          type_of_module  :type_module_js,
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

  $("select[name=module]").chained("select[name=project]");

  

  function get_data_drawing(document_no) {
    var module = $("select[name=module]").val();
    console.log(document_no);
    console.log(module);
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
  var what_ga_is_selected
  $('.dataTable').on( 'draw.dt', function () {
    
    if(typeof what_ga_is_selected !== "undefined"){
      lock_one_ga(what_ga_is_selected)
    }

    $('.select2').select2({
        theme: 'bootstrap'
      });
  });

  function lock_one_ga(identic){
    var total = '<?= $juml ?>';
    var i;

    for(i=0; i<total; i++){
      if(!$('.cb'+i).hasClass(identic)){
        $('.cb'+i).prop("disabled", true);
        $('.div_'+i).attr('title', 'Different GA/AS');
      }
    }
  }

  var selecteds = 0
  
  function enable_edit(no, thiss, identic){
    what_ga_is_selected = identic
    if(thiss.checked==true){
      selecteds++
      console.log(selecteds)
      console.log('yes')

      var total = '<?= $juml ?>';
      var i;

      for(i=0; i<total; i++){
        if(!$('.cb'+i).hasClass(identic)){
          $('.cb'+i).prop("disabled", true);
          $('.div_'+i).attr('title', 'Different GA/AS');
        }
      }

      $('.will_enable'+no).removeClass('disabled-effect');

      $('.will_enable'+no).removeAttr('disabled');
      $('.nowill_enable'+no).removeAttr('disabled');
        
      $('.will_enable'+no).prop('required', true);
      $('.fwrh').removeAttr('required')
      if(selecteds>=30){
        $('.checkbox-big').addClass('disabled-effect')
      }
    } else {
      var total = '<?= $juml ?>';
      var i;
      selecteds--
      console.log('not')
      console.log(selecteds)
      $('.will_enable'+no).prop('disabled', true);
      $('.nowill_enable'+no).prop('disabled', true);
      $('.will_enable'+no).removeAttr('required');
        // $('.fwrh').removeAttr('required')
      $('.will_enable'+no).addClass('disabled-effect');

      lock_one_ga_lef(identic)

      if(selecteds==0){
        console.log('sampai')
        for(i=0; i<total; i++){
          console.log(i)
          $('.cb'+i).removeAttr('disabled');
          $('.div_'+i).attr('title', '');
        }
      }

    }
    $("#thicked b").text(' '+selecteds)
  }

  function lock_one_ga_lef(identic){
    var total = '<?= $juml ?>';
    var i;

    for(i=0; i<total; i++){
      if($('.cb'+i).hasClass(identic) && $('.cb'+i).checked==true){
        console.log('benar')
        if(!$('.cb'+i).hasClass(identic)){
          $('.cb'+i).prop("disabled", true);
          $('.div_'+i).attr('title', 'Different GA/AS');
        }
      } else {
        console.log('salah')
        $('.cb'+i).removeAttr('disabled');
        $('.div_'+i).attr('title', '');
      }
    }
  }

  function show_image(btn, source, type) {

    if (type == "client") {
      var url = "https://www.smoebatam.com/pcms_v2_photo/fab_img/" + source
    } else {
      var url = "https://www.smoebatam.com/pcms_v2_photo/" + source

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