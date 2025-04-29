<?php error_reporting(0) ?>
<?php //test_var($user_permission); ?>
<div id="content" class="container-fluid">
		<div class="row">
	        <div class="col-md-12">
                <div class="my-3 p-3 bg-white rounded shadow-sm">
                  <h5>PCMS Version 2.0 </h5>
                        <style type="text/css">
                          .avoid-clicks {
                            pointer-events: none;
                          }
                        </style>
                        <div class="row">
                            <div class="col">
                              <div class="card shadow my-3 rounded-0">
                                <div class="card-header">
                                  <h6 class="m-0"><?php echo $meta_title ?></h6>
                                </div>
                                <div class="card-body bg-white overflow-auto">
                                  <form action="" method="GET">
                                    <div class="row">
                                      <div class="col-6">
                                        <div class="form-group row">
                                          <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Project</label>
                                          <div class="col-md">

                                            <select class="form-control project <?= $user_permission[0]==1 ? '' : 'avoid-clicks' ?>" name="project" required="">
                                              <option value="">---</option>
                                              <?php foreach ($project_list as $key => $value) : ?>
                                              <option value="<?php echo $value['id'] ?>" <?php echo (@$filter['project'] == $value['id'] ? 'selected' : ($user_cookie[10]==$value['id'] ? 'selected' : '') ) ?>><?php echo $value['project_name'] ?></option>
                                              <?php endforeach; ?>
                                            </select> 

                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-6">
                                        <div class="form-group row">
                                          <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Type Of Module</label>
                                          <div class="col-md">

                                              <select class="form-control type_of_module" name="type_of_module">
                                                  <option value="">---</option>
                                                  <?php foreach ($type_of_module_list as $key => $value) : ?>
                                                    <option value="<?php echo $value['id'] ?>" <?php echo (@$filter['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code']." - ".$value['name'] ?></option>
                                                  <?php endforeach; ?>
                                              </select>

                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-6">
                                        <div class="form-group row">
                                          <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Discipline</label>
                                          <div class="col-md">

                                              <select class="form-control discipline" name="discipline" >
                                                  <option value="">---</option>
                                                  <?php foreach ($discipline_list as $key => $value) : ?>
                                                  <option value="<?php echo $value['id'] ?>" <?php echo (@$filter['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
                                                  <?php endforeach; ?>
                                              </select>

                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-6">
                                        <div class="form-group row">
                                          <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Phase</label>
                                          <div class="col-md">

                                              <select class="form-control phase" name="phase" >
                                                  <option value="">---</option>

                                                  <option value="FB" <?= $filter['phase']=='FB' ? 'selected' : '' ?>>FB</option>
                                                  <option value="AS" <?= $filter['phase']=='AS' ? 'selected' : '' ?>>AS</option>
                                                  <option value="ER" <?= $filter['phase']=='ER' ? 'selected' : '' ?>>ER</option>

                                              </select>

                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-6">
                                        <div class="form-group row">
                                          <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Elevation</label>
                                          <div class="col-md">

                                              <select class="form-control deck_elevation" name="deck_elevation" >
                                                <option value="">---</option>
                                                <?php foreach ($deck_elevation_list as $key => $value) : ?>
                                                  <option value="<?php echo $value['id'] ?>" <?php echo (@$filter['deck_elevation'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code']." - ".$value['name'] ?></option>
                                                <?php endforeach; ?>
                                              </select>

                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-6">
                                        <div class="form-group row">

                                          <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Drawing Assembly</label>
                                          <div class="col-md">

                                            <select class='select2_desc_assy text-center drawing_as' name='drawing_as'></select>
                                            <script>
                                              $(document).ready(function() {

                                                $(".select2_desc_assy").select2({
                                                  tags: true,
                                                  tokenSeparators: [',', ' '],
                                                  ajax: {
                                                        url: "<?php echo base_url();?>home/get_drawing_as_ajax",
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

                                                <?php if($filter['drawing_as']){ ?>
                                                  var isi = <?= "'".$filter['drawing_as']."'" ?>;

                                                  $(".select2_desc_assy").select2('data', {id:isi, text:isi})
                                                <?php } else { ?>

                                                <?php } ?>
                                                })
                                            </script>
                                          </div>

                                        </div>
                                      </div>
                                    </div>

                                    <div class="row">
                                      <div class="col-6">
                                        <div class="form-group row">
                                          <label class="col-md-4 col-lg-3 col-form-label font-weight-bold"> </label>
                                          <div class="col-md">

                                            

                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-6">
                                        <div class="form-group row">                                          
                                        </div>
                                      </div>
                                    </div>

                                    <div class="row">
                                      <div class="col-12 text-right">

                                        <button class="mt-2 btn btn-sm btn-flat btn-success" name="submit" value="search">
                                          <i class="fas fa-search"></i> Search
                                        </button>

                                      </div>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                        </div>

                        <div class="row">
                          <div class="col">
                            <div class="card shadow my-3 rounded-0">
                              <div class="card-header">
                                <h6 class="m-0">                                    
                                  Progress Measurement <b>Level <?= $level+1; ?></b>
                                  <?php if($level==6){ ?>
                                    <?php if($filter["phase"] == ""){ ?> 
                                      - Progress Measurement - Project Database 
                                    <?php } else if($filter["phase"] == "FB"){ ?> 
                                      - Progress Measurement - Fabrication - Target : 60% 
                                    <?php } else if($filter["phase"] == "AS"){ ?> 
                                      - Progress Measurement - Assembly - Target : 30% 
                                    <?php } else if($filter["phase"] == "ER"){ ?> 
                                      - Progress Measurement - Erection - Target : 10% 
                                    <?php } ?> 
                                  <?php } ?>                             
                                </h6>
                              </div>
                              <div class="card-body bg-white overflow-auto">
                                <?php if($level<10){ ?>
                                <table width="100%"  class="table table-hover table-bordered dataTable"  style="text-align: center">
                                  <thead>
                                    <tr>
                                      <th rowspan="2">Type of Module</th>


                                      <?php if($level>=2){ ?>
                                        <th rowspan="2">Discipline</th>
                                      <?php } ?>
                                      <?php if($level>=3){ ?>
                                        <th rowspan="2">Phase</th>
                                        
                                      <?php } ?>
                                      <?php if($level>=4){ ?>
                                        <th rowspan="2">Elevation</th>
                                        
                                      <?php } ?>
                                      <?php if($level>=5){ ?>
                                        <th rowspan="2">Drawing Assembly</th>
                                      <?php } ?>
                                      <?php if($level>=6){ ?>
                                        <th rowspan="2">Piece Mark</th>
                                      <?php } ?>

                                      <th rowspan="1" colspan="2"><b>Last Period</b></th>
                                      <th rowspan="1" colspan="2"><b>This Period</b></th>
                                      <th rowspan="1" colspan="2"><b>Cum. Period</b></th>

                                    </tr>
                                    <!-- <tr>
                                      <th rowspan="1" colspan="2"><b>Last Period</b></th>
                                      <th rowspan="1" colspan="2"><b>This Period</b></th>
                                      <th rowspan="1" colspan="2"><b>Cum. Period</b></th>
                                    </tr> -->
                                    <tr>
                                      <th rowspan="1" colspan="1"><b>Plan</b></th>
                                      <th rowspan="1" colspan="1"><b>Actual</b></th>

                                      <th rowspan="1" colspan="1"><b>Plan</b></th>
                                      <th rowspan="1" colspan="1"><b>Actual</b></th>

                                      <th rowspan="1" colspan="1"><b>Plan</b></th>
                                      <th rowspan="1" colspan="1"><b>Actual</b></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php foreach ($pcms_summary as $key => $value) { 
                                      // =================================================
                                      // test_var($value, 1);
                                      if($value['phase']=='FB'){
                                        if($filter["discipline"] == 1){
                                          $bobot_mv_fab  = 20;
                                          $bobot_fu_fab  = 25;
                                          $bobot_vs_fab  = 45;
                                          $bobot_ndt_fab = 10;
                                        } else {
                                          $bobot_mv_fab  = 15;
                                          $bobot_fu_fab  = 30;
                                          $bobot_vs_fab  = 45;
                                          $bobot_ndt_fab = 10;
                                        }
                                      }

                                      if($value['phase']=='AS'){
                                        $bobot_fu_as     = 40;
                                        $bobot_vs_as     = 50;
                                        $bobot_ndt_as    = 10;
                                      }
                                      
                                      if($value['phase']=='ER'){
                                        if($filter["discipline"] == 1){
                                          $bobot_fu_er     = 60;
                                          $bobot_vs_er     = 30;
                                          $bobot_ndt_er    = 10;
                                        } else {
                                          $bobot_fu_er     = 40;
                                          $bobot_vs_er     = 50;
                                          $bobot_ndt_er    = 10;
                                        }
                                      }                                      

                                      // ================================================
                                      // if($value['week']==DATE('W')){
                                        $fu_percent_as       = round($value['as_fu'] / $value['total_data'],2);
                                        $vs_percent_as       = round($value['as_vs'] / $value['total_data'],2);
                                        $ndt_percent_as      = round($value['as_ndt'] / $value['total_data'],2);
                                        $total_progress_as    = ($fu_percent_as + $vs_percent_as + $ndt_percent_as)/3;
                                    
                                        $fu_percent_2_as       = round(($fu_percent_as * $bobot_fu_as) / 100,2);
                                        $vs_percent_2_as       = round(($vs_percent_as * $bobot_vs_as) / 100,2);
                                        $ndt_percent_2_as      = round(($ndt_percent_as * $bobot_ndt_as) / 100,2);
                                        $total_progress_f_2_as = round($fu_percent_2_as + $vs_percent_2_as + $ndt_percent_2_as ,2);
                                        // ================================================
                                        $fu_percent_er        = round($value['er_fu'] / $value['total_data'],2);
                                        $vs_percent_er        = round($value['er_vs'] / $value['total_data'],2);
                                        $ndt_percent_er       = round($value['er_ndt'] / $value['total_data'],2);
                                        $total_progress_f_er  = ($fu_percent_er + $vs_percent_er + $ndt_percent_er)/3;
                                    
                                        $fu_percent_2_er        = round(($fu_percent_er * $bobot_fu_er) / 100,2);
                                        $vs_percent_2_er        = round(($vs_percent_er * $bobot_vs_er) / 100,2);
                                        $ndt_percent_2_er       = round(($ndt_percent_er * $bobot_ndt_er) / 100,2);
                                        $total_progress_f_2_er  = round($fu_percent_2_er + $vs_percent_2_er + $ndt_percent_2 ,2);
                                        // ================================================
                                        $prefab_percent_f    = round($value['pf_mv'] / $value['total_data'],2);
                                        $fu_percent_f        = round($value['f_fu'] / $value['total_data'],2);
                                        $vs_percent_f        = round($value['f_vs'] / $value['total_data'],2);
                                        $ndt_percent_f       = round($value['f_ndt'] / $value['total_data'],2);
                                        $total_progress_f    = ($prefab_percent_f + $fu_percent_f + $vs_percent_f + $ndt_percent_f)/4;

                                        $pf_percent_2        = round(($prefab_percent_f * $bobot_mv_fab) / 100,2);
                                        $fu_percent_2        = round(($fu_percent_f * $bobot_fu_fab) / 100,2);
                                        $vs_percent_2        = round(($vs_percent_f * $bobot_vs_fab) / 100,2);
                                        $ndt_percent_2       = round(($ndt_percent_f * $bobot_ndt_fab) / 100,2);
                                        $total_progress_f_2  = round($pf_percent_2 + $fu_percent_2 + $vs_percent_2 + $ndt_percent_2,2);

                                        if($level<2){
                                          $total = $pf_percent_2+$pf_percent_2_as+$pf_percent_2_ar+$fu_percent_2+$fu_percent_2_as+$fu_percent_2_ar+$vs_percent_2+$vs_percent_2_as+$vs_percent_2_ar+$ndt_percent_2+$ndt_percent_2_as+$ndt_percent_2_ar;
                                        } else {
                                          if($value['phase']=='FB'){
                                            $total = $pf_percent_2+$fu_percent_2+$vs_percent_2+$ndt_percent_2;
                                          } elseif($value['phase']=='AS'){
                                            $total = $pf_percent_2_as+$fu_percent_2_as+$vs_percent_2_as+$ndt_percent_2_as;
                                          } elseif($value['phase']=='ER'){
                                            $total = $pf_percent_2_er+$fu_percent_2_er+$vs_percent_2_er+$ndt_percent_2_er;
                                          }
                                        }
                                      // }
                                      // ================================================

                                      // FOR LAST PERIO
                                        if($level==6){
                                          $value_last = $pcms_summary_last[$value['project']][$value['type_of_module']][$value['discipline']][$value['phase']][$value['deck_elevation']][$value['drawing_as']][$value['part_id']];
                                        }
                                        if($level==5){
                                          $value_last = $pcms_summary_last[$value['project']][$value['type_of_module']][$value['discipline']][$value['phase']][$value['deck_elevation']][$value['drawing_as']];
                                        }
                                        if($level==4){
                                          $value_last = $pcms_summary_last[$value['project']][$value['type_of_module']][$value['discipline']][$value['phase']][$value['deck_elevation']];
                                        }
                                        if($level==3){
                                          $value_last = $pcms_summary_last[$value['project']][$value['type_of_module']][$value['discipline']][$value['phase']];
                                        }
                                        if($level==2){
                                          $value_last = $pcms_summary_last[$value['project']][$value['type_of_module']][$value['phase']];
                                        }
                                        if($level==1){
                                          $value_last = $pcms_summary_last[$value['project']][$value['type_of_module']];
                                        }

                                        $last_fu_percent_as       = $value_last['total_data']>0 ? round($value_last['as_fu'] / $value_last['total_data'],2) : 0;
                                        $last_vs_percent_as       = $value_last['total_data']>0 ? round($value_last['as_vs'] / $value_last['total_data'],2) : 0;
                                        $last_ndt_percent_as      = $value_last['total_data']>0 ? round($value_last['as_ndt'] / $value_last['total_data'],2) : 0;
                                        $last_total_progress_as    = ($last_fu_percent_as + $last_vs_percent_as + $last_ndt_percent_as)/3;
                                    
                                        $last_fu_percent_2_as       = round(($last_fu_percent_as * $bobot_fu_as) / 100,2);
                                        $last_vs_percent_2_as       = round(($last_vs_percent_as * $bobot_vs_as) / 100,2);
                                        $last_ndt_percent_2_as      = round(($last_ndt_percent_as * $bobot_ndt_as) / 100,2);
                                        $last_total_progress_f_2_as = round($last_fu_percent_2_as + $last_vs_percent_2_as + $last_ndt_percent_2_as ,2);
                                        // ================================================
                                        $last_fu_percent_er        = $value_last['total_data']>0 ? round($value_last['er_fu'] / $value_last['total_data'],2) : 0;
                                        $last_vs_percent_er        = $value_last['total_data']>0 ? round($value_last['er_vs'] / $value_last['total_data'],2) : 0;
                                        $last_ndt_percent_er       = $value_last['total_data']>0 ? round($value_last['er_ndt'] / $value_last['total_data'],2) : 0;
                                        $last_total_progress_f_er  = ($last_fu_percent_er + $last_vs_percent_er + $last_ndt_percent_er)/3;
                                    
                                        $last_fu_percent_2_er        = round(($last_fu_percent_er * $bobot_fu_er) / 100,2);
                                        $last_vs_percent_2_er        = round(($last_vs_percent_er * $bobot_vs_er) / 100,2);
                                        $last_ndt_percent_2_er       = round(($last_ndt_percent_er * $bobot_ndt_er) / 100,2);
                                        $last_total_progress_f_2_er  = round($last_fu_percent_2_er + $vs_percent_2_er + $last_ndt_percent_2 ,2);
                                        // ================================================
                                        $last_prefab_percent_f    = $value_last['total_data']>0 ? round($value_last['pf_mv'] / $value_last['total_data'],2) : 0;
                                        $last_fu_percent_f        = $value_last['total_data']>0 ? round($value_last['f_fu'] / $value_last['total_data'],2) : 0;
                                        $last_vs_percent_f        = $value_last['total_data']>0 ? round($value_last['f_vs'] / $value_last['total_data'],2) : 0;
                                        $last_ndt_percent_f       = $value_last['total_data']>0 ? round($value_last['f_ndt'] / $value_last['total_data'],2) : 0;
                                        $last_total_progress_f    = ($last_prefab_percent_f + $last_fu_percent_f + $last_vs_percent_f + $last_ndt_percent_f)/4;

                                        $last_pf_percent_2        = round(($last_prefab_percent_f * $bobot_mv_fab) / 100,2);
                                        $last_fu_percent_2        = round(($last_fu_percent_f * $bobot_fu_fab) / 100,2);
                                        $last_vs_percent_2        = round(($last_vs_percent_f * $bobot_vs_fab) / 100,2);
                                        $last_ndt_percent_2       = round(($last_ndt_percent_f * $bobot_ndt_fab) / 100,2);
                                        $last_total_progress_f_2  = round($last_pf_percent_2 + $last_fu_percent_2 + $last_vs_percent_2 + $last_ndt_percent_2,2);

                                        if($level<2){
                                          $last_total = $last_pf_percent_2+$last_pf_percent_2_as+$last_pf_percent_2_ar+$last_fu_percent_2+$last_fu_percent_2_as+$last_fu_percent_2_ar+$last_vs_percent_2+$last_vs_percent_2_as+$last_vs_percent_2_ar+$last_ndt_percent_2+$last_ndt_percent_2_as+$last_ndt_percent_2_ar;
                                        } else {
                                          if($value['phase']=='FB'){
                                            $last_total = $last_pf_percent_2+$last_fu_percent_2+$last_vs_percent_2+$last_ndt_percent_2;
                                          } elseif($value['phase']=='AS'){
                                            $last_total = $last_pf_percent_2_as+$last_fu_percent_2_as+$last_vs_percent_2_as+$last_ndt_percent_2_as;
                                          } elseif($value['phase']=='ER'){
                                            $last_total = $last_pf_percent_2_er+$last_fu_percent_2_er+$last_vs_percent_2_er+$last_ndt_percent_2_er;
                                          }
                                        }

                                      // FOR THIS PERIO
                                        if($level==6){
                                          $value_now = $pcms_summary_now[$value['project']][$value['type_of_module']][$value['discipline']][$value['phase']][$value['deck_elevation']][$value['drawing_as']][$value['part_id']];
                                        }
                                        if($level==5){
                                          $value_now = $pcms_summary_now[$value['project']][$value['type_of_module']][$value['discipline']][$value['phase']][$value['deck_elevation']][$value['drawing_as']];
                                        }
                                        if($level==4){
                                          $value_now = $pcms_summary_now[$value['project']][$value['type_of_module']][$value['discipline']][$value['phase']][$value['deck_elevation']];
                                        }
                                        if($level==3){
                                          $value_now = $pcms_summary_now[$value['project']][$value['type_of_module']][$value['discipline']][$value['phase']];
                                        }
                                        if($level==2){
                                          $value_now = $pcms_summary_now[$value['project']][$value['type_of_module']][$value['phase']];
                                        }
                                        if($level==1){
                                          $value_now = $pcms_summary_now[$value['project']][$value['type_of_module']];
                                        }

                                        $now_fu_percent_as       = $value_now['total_data']>0 ? round($value_now['as_fu'] / $value_now['total_data'],2) : 0;
                                        $now_vs_percent_as       = $value_now['total_data']>0 ? round($value_now['as_vs'] / $value_now['total_data'],2) : 0;
                                        $now_ndt_percent_as      = $value_now['total_data']>0 ? round($value_now['as_ndt'] / $value_now['total_data'],2) : 0;
                                        $now_total_progress_as    = ($now_fu_percent_as + $now_vs_percent_as + $now_ndt_percent_as)/3;
                                    
                                        $now_fu_percent_2_as       = round(($now_fu_percent_as * $bobot_fu_as) / 100,2);
                                        $now_vs_percent_2_as       = round(($now_vs_percent_as * $bobot_vs_as) / 100,2);
                                        $now_ndt_percent_2_as      = round(($now_ndt_percent_as * $bobot_ndt_as) / 100,2);
                                        $now_total_progress_f_2_as = round($now_fu_percent_2_as + $now_vs_percent_2_as + $now_ndt_percent_2_as ,2);
                                        // ================================================
                                        $now_fu_percent_er        = $value_now['total_data']>0 ? round($value_now['er_fu'] / $value_now['total_data'],2) : 0;
                                        $now_vs_percent_er        = $value_now['total_data']>0 ? round($value_now['er_vs'] / $value_now['total_data'],2) : 0;
                                        $now_ndt_percent_er       = $value_now['total_data']>0 ? round($value_now['er_ndt'] / $value_now['total_data'],2) : 0;
                                        $now_total_progress_f_er  = ($now_fu_percent_er + $now_vs_percent_er + $now_ndt_percent_er)/3;
                                    
                                        $now_fu_percent_2_er        = round(($now_fu_percent_er * $bobot_fu_er) / 100,2);
                                        $now_vs_percent_2_er        = round(($now_vs_percent_er * $bobot_vs_er) / 100,2);
                                        $now_ndt_percent_2_er       = round(($now_ndt_percent_er * $bobot_ndt_er) / 100,2);
                                        $now_total_progress_f_2_er  = round($now_fu_percent_2_er + $vs_percent_2_er + $now_ndt_percent_2 ,2);
                                        // ================================================
                                        $now_prefab_percent_f    = $value_now['total_data']>0 ? round($value_now['pf_mv'] / $value_now['total_data'],2) : 0;
                                        $now_fu_percent_f        = $value_now['total_data']>0 ? round($value_now['f_fu'] / $value_now['total_data'],2) : 0;
                                        $now_vs_percent_f        = $value_now['total_data']>0 ? round($value_now['f_vs'] / $value_now['total_data'],2) : 0;
                                        $now_ndt_percent_f       = $value_now['total_data']>0 ? round($value_now['f_ndt'] / $value_now['total_data'],2) : 0;
                                        $now_total_progress_f    = ($now_prefab_percent_f + $now_fu_percent_f + $now_vs_percent_f + $now_ndt_percent_f)/4;

                                        $now_pf_percent_2        = round(($now_prefab_percent_f * $bobot_mv_fab) / 100,2);
                                        $now_fu_percent_2        = round(($now_fu_percent_f * $bobot_fu_fab) / 100,2);
                                        $now_vs_percent_2        = round(($now_vs_percent_f * $bobot_vs_fab) / 100,2);
                                        $now_ndt_percent_2       = round(($now_ndt_percent_f * $bobot_ndt_fab) / 100,2);
                                        $now_total_progress_f_2  = round($now_pf_percent_2 + $now_fu_percent_2 + $now_vs_percent_2 + $now_ndt_percent_2,2);

                                        if($level<2){
                                          $now_total = $now_pf_percent_2+$now_pf_percent_2_as+$now_pf_percent_2_ar+$now_fu_percent_2+$now_fu_percent_2_as+$now_fu_percent_2_ar+$now_vs_percent_2+$now_vs_percent_2_as+$now_vs_percent_2_ar+$now_ndt_percent_2+$now_ndt_percent_2_as+$now_ndt_percent_2_ar;
                                        } else {
                                          if($value['phase']=='FB'){
                                            $now_total = $now_pf_percent_2+$now_fu_percent_2+$now_vs_percent_2+$now_ndt_percent_2;
                                          } elseif($value['phase']=='AS'){
                                            $now_total = $now_pf_percent_2_as+$now_fu_percent_2_as+$now_vs_percent_2_as+$now_ndt_percent_2_as;
                                          } elseif($value['phase']=='ER'){
                                            $now_total = $now_pf_percent_2_er+$now_fu_percent_2_er+$now_vs_percent_2_er+$now_ndt_percent_2_er;
                                          }
                                        }
                                    ?>
                                      <tr>
                                        <td><?= $type_of_module_list_data[$value['type_of_module']]['name'] ?></td>

                                        

                                        <?php if($level>=2){ ?>
                                          <td><?= $discipline_list_data[$value['discipline']]['discipline_name'] ?></td>
                                          
                                        <?php } if($level>=3){ ?>
                                          <td><?= $value['phase'] ?></td>
                                          
                                        <?php } if($level>=4){ ?>
                                          <td><?= $deck_elevation_list_data[$value['deck_elevation']]['code'] ?></td>
                                          
                                        <?php } if($level>=5){ ?>
                                          <td><?= $value['drawing_as'] ?></td>

                                        <?php } if($level>=6){ ?>
                                          <td><?= $value['part_id'] ?></td>
                                        <?php } ?>

                                        <td style="vertical-align: middle !important;" colspan="1"><b>
                                          <?= 0 ?> %
                                        </b></td>
                                        <td style="vertical-align: middle !important;" colspan="1"><b>
                                          <?= $last_total ?> %
                                        </b></td>

                                        <td style="vertical-align: middle !important;" colspan="1"><b>
                                          <?= 0 ?> %
                                        </b></td>
                                        <td style="vertical-align: middle !important;" colspan="1"><b>
                                          <?= $now_total ?> %
                                        </b></td>

                                        <td style="vertical-align: middle !important;" colspan="1"><b>
                                          <?= 0 ?> %
                                        </b></td>
                                        <td style="vertical-align: middle !important;" colspan="1"><b>
                                          <?= $total ?> %
                                        </b></td>
                                      </tr>
                                    <?php } ?>
                                  </tbody>
                                </table>
                                <?php } else { ?>
                                <!-- Table Level 7 -->        
                                <table width="100%"  class="table table-hover" cellpadding="10" style="text-align: center"> 
                                  <tr> 
                                      <th>Project</th> 
                                      <th>Module</th> 
                                      <th>Type of Module</th> 
                                      <th>Discipline</th> 
                                      <th>Deck Elevation / Service Line</th> 
                                      <!-- <th>Description Assy Code</th> -->   
                                      <th>Drawing Assembly</th>   
                                      <?php if($filter["phase"] == "" OR $filter["drawing_as"] != ""){ ?>            
                                      <th>Part ID</th>                                
                                      <?php } ?>                                    
                                      <?php if($filter["phase"] == "FB" OR $filter["phase"] == ""){ ?>                                         
                                      <th>Mark / Cutting <?php if($filter["phase"] == "FB"){ ?><hr/>15%<?php } ?></th> 
                                      <?php } ?> 
                                      <th> 
                                        Fit-up 
                                           <?php if($filter["phase"] == "FB"){ ?>  
                                            <hr/>30%             
                                           <?php } else if($filter["phase"] == "AS"){ ?>  
                                            <hr/>40%             
                                           <?php } else if($filter["phase"] == "ER"){ ?>   
                                            <hr/>40%            
                                           <?php } ?>              
                                      </th> 
                                      <th> 
                                        Weld Out 
                                           <?php if($filter["phase"] == "FB"){ ?>  
                                            <hr/>45%             
                                           <?php } else if($filter["phase"] == "AS"){ ?>  
                                            <hr/>50%             
                                           <?php } else if($filter["phase"] == "ER"){ ?>   
                                            <hr/>50%            
                                           <?php } ?> 
                                      </th> 
                                      <th>NDE Acceptance 
                                            <?php if($filter["phase"] == "FB"){ ?>  
                                            <hr/>10%             
                                           <?php } else if($filter["phase"] == "AS"){ ?>  
                                            <hr/>10%             
                                           <?php } else if($filter["phase"] == "ER"){ ?>   
                                            <hr/>10%            
                                           <?php } ?></th> 
                                      <th>Progress Sum</th> 
                                  </tr> 
                                  
                                  <?php foreach ($pcms_summary_level_7 as $key => $value) { ?> 
                                  <tr> 
                                      <td><?php echo $project_list_data[$value['project']]['project_name']; ?></td> 
                                      <td><?php echo $module_list[$value['module']]['mod_desc']; ?></td> 
                                      <td><?php echo $type_of_module_list_data[$value['type_of_module']]['name']; ?></td> 
                                      <td><?php echo $discipline_list_data[$value['discipline']]['discipline_name']; ?></td> 
                                      <td><?php echo $deck_elevation_list_data[$value['deck_elevation']]['name']; ?></td> 
                                      <!-- <td><?php echo $desc_assy_list_data[$value['description_assy']]['name']; ?></td>  -->
                                      <td><?= $value['drawing_as'] ?></td>
                                      <?php if($filter["phase"] == "" OR $filter["drawing_as"] != ""){ ?>       
                                      <td><?php echo $value['part_id']; ?></td> 
                                      <?php } ?>    

                                      <?php if($filter["phase"] == ""){ ?> 
                                       
                                        <td  
                                        <?php  
                                        if($value['pf_mv'] >= 100){ echo "style='background-color:#b0ffc5'"; } else  
                                        if($value['pf_mv'] < 100 && $value['pf_mv'] != 0){ echo "style='background-color:#ffe9b0'"; } else  
                                        { echo "style='background-color:#ffb0b0'"; }  
                                        ?> 
                                        > 
                                          <?php echo $value['pf_mv']."%"; ?> 
                                        </td> 

                                        <td 
                                        <?php  
                                        if($value['f_fu'] >= 100){ echo "style='background-color:#b0ffc5'"; } else  
                                        if($value['f_fu'] < 100 && $value['f_fu'] != 0){ echo "style='background-color:#ffe9b0'"; } else  
                                        { echo "style='background-color:#ffb0b0'"; }  
                                        ?> 
                                        > 
                                          <?php echo $value['f_fu']."%"; ?> 
                                        </td> 

                                        <td 
                                        <?php  
                                        if($value['f_vs'] >= 100){ echo "style='background-color:#b0ffc5'"; } else  
                                        if($value['f_vs'] < 100 && $value['f_vs'] != 0){ echo "style='background-color:#ffe9b0'"; } else  
                                        { echo "style='background-color:#ffb0b0'"; }  
                                        ?> 
                                        ><?php echo $value['f_vs']."%"; ?> 
                                        </td> 

                                        <td 
                                        <?php  
                                        if($value['f_ndt'] >= 100){ echo "style='background-color:#b0ffc5'"; } else  
                                        if($value['f_ndt'] < 100 && $value['f_ndt'] != 0){ echo "style='background-color:#ffe9b0'"; } else  
                                        { echo "style='background-color:#ffb0b0'"; }  
                                        ?> 
                                        > 
                                          <?php echo $value['f_ndt']."%"; ?> 
                                        </td> 

                                        <td 
                                        <?php  
                                        if(round(($value['pf_mv'] + $value['f_fu']+ $value['f_vs']+ $value['f_ndt'])/4,2) >= 100){ echo "style='background-color:#b0ffc5'"; } else  
                                        if(round(($value['pf_mv'] + $value['f_fu']+ $value['f_vs']+ $value['f_ndt'])/4,2) < 100 && round(($value['pf_mv'] + $value['f_fu']+ $value['f_vs']+ $value['f_ndt'])/4,2) != 0){ echo "style='background-color:#ffe9b0'"; } else  
                                        { echo "style='background-color:#ffb0b0'"; }  
                                        ?> 
                                        > 
                                          <?php echo round(($value['pf_mv'] + $value['f_fu']+ $value['f_vs']+ $value['f_ndt'])/4,2)."%"; ?> 
                                         
                                        </td> 

                                      <?php } else if($filter["phase"] == "FB" OR $filter["phase"] == ""){ ?> 

                                        <?php  
                                          $prefab_percent = round($value['pf_mv'] / $value['total_data'],2); 
                                          $fu_percent     = round($value['f_fu'] / $value['total_data'],2); 
                                          $vs_percent     = round($value['f_vs'] / $value['total_data'],2); 
                                          $ndt_percent    = round($value['f_ndt'] / $value['total_data'],2); 
                                          $total_progress_f    = ($prefab_percent + $fu_percent + $vs_percent + $ndt_percent)/4; 

                                          $pf_percent_2       = round(($prefab_percent * 15) / 100,2); 
                                          $fu_percent_2       = round(($fu_percent * 30) / 100,2); 
                                          $vs_percent_2       = round(($vs_percent * 45) / 100,2); 
                                          $ndt_percent_2      = round(($ndt_percent * 10) / 100,2); 
                                          $total_progress_f_2   = round($pf_percent_2 + $fu_percent_2 + $vs_percent_2 + $ndt_percent_2 ,2); 

                                        ?> 

                                        <td  
                                        <?php  
                                        if($prefab_percent >= 100){ echo "style='background-color:#b0ffc5'"; } else  
                                        if($prefab_percent < 100 && $prefab_percent != 0){ echo "style='background-color:#ffe9b0'"; } else  
                                        { echo "style='background-color:#ffb0b0'"; }  
                                        ?> 
                                        > 
                                          <?php echo $prefab_percent."%"; ?><?php if($filter["drawing_as"] == ""){ ?><hr/>( <?php echo $pf_percent_2."%"; ?> )<?php } ?> 
                                        </td> 

                                        <td 
                                        <?php  
                                        if($fu_percent >= 100){ echo "style='background-color:#b0ffc5'"; } else  
                                        if($fu_percent < 100 && $fu_percent != 0){ echo "style='background-color:#ffe9b0'"; } else  
                                        { echo "style='background-color:#ffb0b0'"; }  
                                        ?> 
                                        > 
                                          <?php echo $fu_percent."%"; ?><?php if($filter["drawing_as"] == ""){ ?><hr/>( <?php echo $fu_percent_2."%"; ?> ) <?php } ?> 
                                        </td> 

                                        <td 
                                        <?php  
                                        if($vs_percent >= 100){ echo "style='background-color:#b0ffc5'"; } else  
                                        if($vs_percent < 100 && $vs_percent != 0){ echo "style='background-color:#ffe9b0'"; } else  
                                        { echo "style='background-color:#ffb0b0'"; }  
                                        ?> 
                                        ><?php echo $vs_percent."%"; ?><?php if($filter["drawing_as"] == ""){ ?><hr/>( <?php echo $vs_percent_2."%"; ?> ) <?php } ?> 
                                        </td> 

                                        <td 
                                        <?php  
                                        if($ndt_percent >= 100){ echo "style='background-color:#b0ffc5'"; } else  
                                        if($ndt_percent < 100 && $ndt_percent != 0){ echo "style='background-color:#ffe9b0'"; } else  
                                        { echo "style='background-color:#ffb0b0'"; }  
                                        ?> 
                                        > 
                                          <?php echo $ndt_percent."%"; ?><?php if($filter["drawing_as"] == ""){ ?><hr/>( <?php echo $ndt_percent_2."%"; ?> ) <?php } ?> 
                                        </td> 

                                        <td 
                                        <?php  
                                        if(round($total_progress_f,2) >= 100){ echo "style='background-color:#b0ffc5'"; } else  
                                        if(round($total_progress_f,2) < 100 && round($total_progress_f,2) != 0){ echo "style='background-color:#ffe9b0'"; } else  
                                        { echo "style='background-color:#ffb0b0'"; }  
                                        ?> 
                                        > 
                                          <?php echo round($total_progress_f,2)."%"; ?><?php if($filter["drawing_as"] == ""){ ?><hr/>( <?php echo $total_progress_f_2."%"; ?> ) <?php } ?> 
                                         
                                        </td> 

                                      <?php } else if($filter["phase"] == "AS"){  ?>  

                                        <td><?php echo $value['as_fu']."%"; ?></td> 
                                        <td><?php echo $value['as_vs']."%"; ?></td> 
                                        <td><?php echo $value['as_ndt']."%"; ?></td> 
                                        <td><?php echo round(($value['as_fu'] + $value['as_vs']+ $value['as_ndt'])/3,2)."%"; ?></td> 

                                      <?php } else if($filter["phase"] == "ER"){  ?>  

                                        <td><?php echo $value['er_fu']."%"; ?></td> 
                                        <td><?php echo $value['er_vs']."%"; ?></td> 
                                        <td><?php echo $value['er_ndt']."%"; ?></td> 
                                        <td><?php echo round(($value['er_fu'] + $value['er_vs']+ $value['er_ndt'])/3,2)."%"; ?></td> 

                                      <?php } ?>                                        
                                      
                                  </tr> 
                                  <?php } ?> 
                                </table> 
                                <!-- End table level 7 -->
                                <?php } ?>
                              </div>
                            </div>
                          </div>

                        </div>

                        

                        <?php if($filter["drawing_as"] == "ABCDDISABLE"){ ?>

                          <div class="row">
                            <div class="col">
                              <div class="card shadow my-3 rounded-0">
                                <div class="card-header">
                                  <h6 class="m-0">                                    
                                      Progress Measurement on Graph                                  
                                  </h6>
                                </div>
                                <div class="card-body bg-white overflow-auto">
                                  <div class="row">
                                  <?php 
                                     $no = 0;
                                     foreach ($pcms_summary as $key => $value) {

                                      if(isset($filter["project"]) AND !empty($filter["project"])){ $val_grp_1 = $project_list_data[$value['project']]['project_name']; } else { $val_grp_1 = null; }

                                      if(isset($filter["module"]) AND !empty($filter["module"])){ $val_grp_2  = $module_list[$value['module']]['mod_desc']; } else { $val_grp_2 = null; }

                                      if(isset($filter["type_of_module"]) AND !empty($filter["type_of_module"])){ $val_grp_3 = $type_of_module_list_data[$value['type_of_module']]['name']; } else { $val_grp_3 = null; }

                                      if(isset($filter["discipline"]) AND !empty($filter["discipline"])){ $val_grp_4 = $discipline_list_data[$value['discipline']]['discipline_name']; } else { $val_grp_4 = null; }

                                      if(isset($filter["deck_elevation"]) AND !empty($filter["deck_elevation"])){ $val_grp_5 = $deck_elevation_list_data[$value['deck_elevation']]['name']; } else { $val_grp_5 = null; }

                                      if(isset($filter["desc_assy"]) AND !empty($filter["desc_assy"])){ $val_grp_6 = $desc_assy_list_data[$value['description_assy']]['name']; } else { $val_grp_6 = null; }

                                      

                                      $array_filter = array($val_grp_1,$val_grp_2,$val_grp_3,$val_grp_4,$val_grp_5,$val_grp_6);
                                      $array_group = array_filter($array_filter);

                                      if(isset($val_grp_1) && !isset($val_grp_2) && !isset($val_grp_3) && !isset($val_grp_4) && !isset($val_grp_5) && !isset($val_grp_6)){
                                        $level = "Level #0";
                                        array_push($array_group,$module_list[$value['module']]['mod_desc']);
                                      } else if(isset($val_grp_1) && isset($val_grp_2) && !isset($val_grp_3) && !isset($val_grp_4) && !isset($val_grp_5) && !isset($val_grp_6)){
                                        $level = "Level #1";
                                        array_push($array_group,$type_of_module_list_data[$value['type_of_module']]['name']);
                                      } else if(isset($val_grp_1) && isset($val_grp_2) && isset($val_grp_3) && !isset($val_grp_4) && !isset($val_grp_5) && !isset($val_grp_6)){
                                         $level = "Level #2";
                                         array_push($array_group,$discipline_list_data[$value['discipline']]['discipline_name']);
                                      } else if(isset($val_grp_1) && isset($val_grp_2) && isset($val_grp_3) && isset($val_grp_4) && !isset($val_grp_5) && !isset($val_grp_6)){
                                         $level = "Level #3";   
                                         array_push($array_group,$deck_elevation_list_data[$value['deck_elevation']]['name']);
                                      } else if(isset($val_grp_1) && isset($val_grp_2) && isset($val_grp_3) && isset($val_grp_4) && isset($val_grp_5) && !isset($val_grp_6)){
                                         $level = "Level #4";
                                         array_push($array_group,$desc_assy_list_data[$value['description_assy']]['name']);
                                      } else if(isset($val_grp_1) && isset($val_grp_2) && isset($val_grp_3) && isset($val_grp_4) && isset($val_grp_5) && !isset($val_grp_6)){
                                         $level = "Level #5"; 
                                         array_push($array_group,"part_id");
                                      } else if(isset($val_grp_1) && isset($val_grp_2) && isset($val_grp_3) && isset($val_grp_4) && isset($val_grp_5) && isset($val_grp_6)){
                                         $level = "Level #6"; 
                                         array_push($array_group,"part_id");
                                      }

                                      $display_title = implode(" / ", $array_group);


                                            if($filter["discipline"] == "1"){
                                              $bobot_mv_fab  = 20;
                                              $bobot_fu_fab  = 25;
                                              $bobot_vs_fab  = 45;
                                              $bobot_ndt_fab = 10;
                                            } else {
                                              $bobot_mv_fab  = 15;
                                              $bobot_fu_fab  = 30;
                                              $bobot_vs_fab  = 45;
                                              $bobot_ndt_fab = 10;
                                            }

                                            $prefab_percent_f    = round($value['pf_mv'] / $value['total_data'],2);
                                            $fu_percent_f        = round($value['f_fu'] / $value['total_data'],2);
                                            $vs_percent_f        = round($value['f_vs'] / $value['total_data'],2);
                                            $ndt_percent_f       = round($value['f_ndt'] / $value['total_data'],2);
                                            $total_progress_f    = ($prefab_percent_f + $fu_percent_f + $vs_percent_f + $ndt_percent_f)/4;

                                            $pf_percent_2        = round(($prefab_percent_f * $bobot_mv_fab) / 100,2);
                                            $fu_percent_2        = round(($fu_percent_f * $bobot_fu_fab) / 100,2);
                                            $vs_percent_2        = round(($vs_percent_f * $bobot_vs_fab) / 100,2);
                                            $ndt_percent_2       = round(($ndt_percent_f * $bobot_ndt_fab) / 100,2);
                                            $total_progress_f_2  = round($pf_percent_2 + $fu_percent_2 + $vs_percent_2 + $ndt_percent_2,2);

                                            $data_fabrication = array(
                                                                  "f_mv"  => $pf_percent_2,
                                                                  "f_fu"  => $fu_percent_2,
                                                                  "f_vs"  => $vs_percent_2,
                                                                  "f_ndt" => $ndt_percent_2,
                                                                  "f_in_progress" => (100-$total_progress_f_2),
                                                                );


                                            $bobot_fu_as     = 40;
                                            $bobot_vs_as     = 50;
                                            $bobot_ndt_as    = 10;
                                           
                                            $fu_percent_as       = round($value['as_fu'] / $value['total_data'],2);
                                            $vs_percent_as       = round($value['as_vs'] / $value['total_data'],2);
                                            $ndt_percent_as      = round($value['as_ndt'] / $value['total_data'],2);
                                            $total_progress_as    = ($fu_percent_as + $vs_percent_as + $ndt_percent_as)/3;
                                        
                                            $fu_percent_2_as       = round(($fu_percent_as * $bobot_fu_as) / 100,2);
                                            $vs_percent_2_as       = round(($vs_percent_as * $bobot_vs_as) / 100,2);
                                            $ndt_percent_2_as      = round(($ndt_percent_as * $bobot_ndt_as) / 100,2);
                                            $total_progress_f_2_as = round($fu_percent_2_as + $vs_percent_2_as + $ndt_percent_2_as ,2);

                                            $data_assembly = array(
                                                                  "as_fu"  => $fu_percent_2_as,
                                                                  "as_vs"  => $vs_percent_2_as,
                                                                  "as_ndt" => $ndt_percent_2_as,
                                                                  "as_in_progress" => (100-$total_progress_f_2_as),
                                                                  );


                                            if($filter["discipline"] == "1"){
                                              $bobot_fu_er     = 60;
                                              $bobot_vs_er     = 30;
                                              $bobot_ndt_er    = 10;
                                            } else {
                                              $bobot_fu_er     = 40;
                                              $bobot_vs_er     = 50;
                                              $bobot_ndt_er    = 10;
                                            }
                                           
                                            $fu_percent_er        = round($value['er_fu'] / $value['total_data'],2);
                                            $vs_percent_er        = round($value['er_vs'] / $value['total_data'],2);
                                            $ndt_percent_er       = round($value['er_ndt'] / $value['total_data'],2);
                                            $total_progress_f_er  = ($fu_percent_er + $vs_percent_er + $ndt_percent_er)/3;
                                        
                                            $fu_percent_2_er         = round(($fu_percent_er * $bobot_fu_er) / 100,2);
                                            $vs_percent_2_er         = round(($vs_percent_er * $bobot_vs_er) / 100,2);
                                            $ndt_percent_2_er        = round(($ndt_percent_er * $bobot_ndt_er) / 100,2);
                                            $total_progress_f_2_er   = round($fu_percent_2_er + $vs_percent_2_er + $ndt_percent_2 ,2);


                                            $data_erection = array(
                                                                  "er_fu"  => $fu_percent_2_er,
                                                                  "er_vs"  => $vs_percent_2_er,
                                                                  "er_ndt" => $ndt_percent_2_er,
                                                                  "er_in_progress" => (100-$total_progress_f_2_er),
                                                                  );

                                     
                                   ?>

                                  <div class="col-md-4 card">
                                    <div id="pie_chart_fab_<?php echo $no; ?>"></div>
                                    <script>
                                      Highcharts.chart('pie_chart_fab_<?php echo $no; ?>', {
                                        chart: {
                                          type: 'pie'
                                        },
                                        title: {
                                          text: '<span style="font-weight: bold">Fabrication</span><br/><span style="font-size:10px"><?php echo $display_title; ?></span><br/><span style="font-size:9px;font-weight: bold;">( <?php echo $level; ?> )</span>'
                                        },
                                        subtitle: {
                                          text: ''
                                        },
                                       
                                        colors: ['#c0d5fc', '#70ff8d', '#e5ff70', '#ffd270', '#ffa6a6'],
                                        xAxis: {
                                          categories: ['Mark/Cut', 'Fit-Up', 'Weld Out', 'NDT', 'In Progress'],
                                          crosshair: true
                                        },
                                        yAxis: {
                                          min: 0,
                                          title: {
                                            text: 'Progress (%)'
                                          }
                                        },
                                        tooltip: {
                                          headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                                          pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                            '<td style="padding:0"><b>{point.y:.1f} %</b></td></tr>',
                                          footerFormat: '</table>',
                                          shared: true,
                                          useHTML: true
                                        },
                                        plotOptions: {
                                          pie: {
                                            allowPointSelect: true,
                                            cursor: 'pointer',
                                            dataLabels: {
                                                enabled: true,
                                                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                                            }
                                          }
                                        },
                                        series: [{
                                            name: 'Progress Fabrication',
                                            colorByPoint: true,                                            
                                            shadow: true,
                                            data: [{
                                                name: 'Mark/Cut',                                 
                                                sliced: true,
                                                selected: true,
                                                y: <?= json_encode($data_fabrication["f_mv"]) ?>,
                                            }, {
                                                name: 'Fit-Up',                                 
                                                sliced: true,
                                                selected: true,
                                                y: <?= json_encode($data_fabrication["f_fu"]) ?>
                                            }, {
                                                name: 'Weld Out',                                 
                                                sliced: true,
                                                selected: true,
                                                y: <?= json_encode($data_fabrication["f_vs"]) ?>
                                            }, {
                                                name: 'NDT',                                 
                                                sliced: true,
                                                selected: true,
                                                y: <?= json_encode($data_fabrication["f_ndt"]) ?>
                                            }, {
                                                name: 'In Progress',                                 
                                                sliced: true,
                                                selected: true,
                                                y: <?= json_encode($data_fabrication["f_in_progress"]) ?>
                                            }]
                                        }]
                                      });
                                    </script>
                                  </div>

                                  <div class="col-md-4 card">
                                    <div id="pie_chart_as_<?php echo $no; ?>"></div>
                                    <script>
                                      Highcharts.chart('pie_chart_as_<?php echo $no; ?>', {
                                        chart: {
                                          type: 'pie'
                                        },
                                        title: {
                                          text: '<span style="font-weight: bold">Assembly</span><br/><span style="font-size:10px"><?php echo $display_title; ?></span><br/><span style="font-size:9px;font-weight: bold;">( <?php echo $level; ?> )</span>'
                                        },
                                        subtitle: {
                                          text: ''
                                        },
                                        colors: ['#70ff8d', '#e5ff70', '#ffd270', '#ffa6a6'],
                                        xAxis: {
                                          categories: ['Fit-Up', 'Weld Out', 'NDT', 'In Progress'],
                                          crosshair: true
                                        },
                                        yAxis: {
                                          min: 0,
                                          title: {
                                            text: 'Progress (%)'
                                          }
                                        },
                                        tooltip: {
                                          headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                                          pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                            '<td style="padding:0"><b>{point.y:.1f} %</b></td></tr>',
                                          footerFormat: '</table>',
                                          shared: true,
                                          useHTML: true
                                        },
                                        plotOptions: {
                                          pie: {
                                            allowPointSelect: true,
                                            cursor: 'pointer',
                                            dataLabels: {
                                                enabled: true,
                                                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                                            }
                                          }
                                        },
                                        series: [{
                                            name: 'Progress Measurement - Assembly',
                                            colorByPoint: true,                                            
                                            shadow: true,
                                            data: [{
                                                name: 'Fit-Up',                                 
                                                sliced: true,
                                                selected: true,
                                                y: <?= json_encode($data_assembly["as_fu"]) ?>
                                            }, {
                                                name: 'Weld Out',                                 
                                                sliced: true,
                                                selected: true,
                                                y: <?= json_encode($data_assembly["as_vs"]) ?>
                                            }, {
                                                name: 'NDT',                                 
                                                sliced: true,
                                                selected: true,
                                                y: <?= json_encode($data_assembly["as_ndt"]) ?>
                                            }, {
                                                name: 'In Progress',                                 
                                                sliced: true,
                                                selected: true,
                                                y: <?= json_encode($data_assembly["as_in_progress"]) ?>
                                            }]
                                        }]
                                      });
                                    </script>
                                  </div>

                                <div class="col-md-4 card">
                                    <div id="pie_chart_er_<?php echo $no; ?>"></div>
                                    <script>
                                      Highcharts.chart('pie_chart_er_<?php echo $no; ?>', {
                                        chart: {
                                          type: 'pie',

                                        },
                                        title: {
                                          text: '<span style="font-weight: bold">Erection</span><br/><span style="font-size:10px"><?php echo $display_title; ?></span><br/><span style="font-size:9px;font-weight: bold;">( <?php echo $level; ?> )</span>'
                                        },
                                        subtitle: {
                                          text: ''
                                        },
                                        colors: ['#70ff8d', '#e5ff70', '#ffd270', '#ffa6a6'],
                                        xAxis: {
                                          categories: ['Fit-Up', 'Weld Out', 'NDT', 'In Progress'],
                                          crosshair: true
                                        },
                                        yAxis: {
                                          min: 0,
                                          title: {
                                            text: 'Progress (%)'
                                          }
                                        },
                                        tooltip: {
                                          headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                                          pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                            '<td style="padding:0"><b>{point.y:.1f} %</b></td></tr>',
                                          footerFormat: '</table>',
                                          shared: true,
                                          useHTML: true
                                        },
                                        plotOptions: {
                                          pie: {
                                            allowPointSelect: true,
                                            cursor: 'pointer',
                                            dataLabels: {
                                                enabled: true,
                                                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                                            }
                                          }
                                        },
                                        series: [{
                                            name: 'Progress Measurement - Erection',
                                            colorByPoint: true,
                                            shadow: true,
                                            data: [{
                                                name: 'Fit-Up',                                                
                                                sliced: true,
                                                selected: true,
                                                y: <?= json_encode($data_erection["er_fu"]) ?>
                                            }, {
                                                name: 'Weld Out',                                 
                                                sliced: true,
                                                selected: true,
                                                y: <?= json_encode($data_erection["er_vs"]) ?>
                                            }, {
                                                name: 'NDT',                                 
                                                sliced: true,
                                                selected: true,
                                                y: <?= json_encode($data_erection["er_ndt"]) ?>
                                            }, {
                                                name: 'In Progress',                                 
                                                sliced: true,
                                                selected: true,
                                                y: <?= json_encode($data_erection["er_in_progress"]) ?>
                                            }]
                                        }]
                                      });
                                    </script>
                                  </div>  

                                <?php $no++;} ?>
                                </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        <?php } ?>


                </div>
              </div>
            </div>
</div>
</div><!-- ini div dari sidebar yang class wrapper -->
<script>
  $(document).ready(function() {
    $('.discipline').change(function(){
      if($('.discipline').val()!=undefined){
        $('.type_of_module').attr('required', true);
      } else {
        $('.type_of_module').removeAttr('required');
      }
    })

    $('.phase').change(function(){
      if($('.phase').val()!=undefined){
        $('.discipline').attr('required', true);
        $('.type_of_module').attr('required', true);
      } else {
        $('.discipline').removeAttr('required');
        $('.type_of_module').removeAttr('required');
      }
    })

    $('.deck_elevation').change(function(){
      if($('.deck_elevation').val()!=undefined){
        $('.discipline').attr('required', true);
        $('.type_of_module').attr('required', true);
        $('.phase').attr('required', true);
      } else {
        $('.discipline').removeAttr('required');
        $('.type_of_module').removeAttr('required');
        $('.phase').removeAttr('required');
      }
    })

  })
</script>

<script type="text/javascript">
  $('.dataTable').on( 'draw.dt', function () {
    $('.select2').select2({
        theme: 'bootstrap'
      });
  });

  $('.dataTable').DataTable({
    order: [],
    columnDefs: [{
      "targets": 0,
      "orderable": false,
    }]
  })
</script>