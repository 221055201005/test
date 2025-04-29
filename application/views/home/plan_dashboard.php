<?php error_reporting(0) ?>
<div id="content" class="container-fluid">
		<div class="row">
	        <div class="col-md-12">
                <div class="my-3 p-3 bg-white rounded shadow-sm">
                  <h5>PCMS Version 2.0 </h5>
                  
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

                                            <select class="form-control" name="project">
                                              <option value="">---</option>
                                              <?php foreach ($project_list as $key => $value) : ?>
                                              <option value="<?php echo $value['id'] ?>" <?php echo (@$filter['project'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                                              <?php endforeach; ?>
                                            </select> 

                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-6">
                                        <div class="form-group row">
                                          <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Module</label>
                                          <div class="col-md">

                                              <select class="form-control" name="module" >
                                                  <option value="">---</option>
                                                  <?php foreach ($module_list as $key => $value) : ?>
                                                  <option value="<?php echo $value['mod_id'] ?>" data-chained="<?php echo $value['project_id'] ?>" <?php echo (@$filter['module'] == $value['mod_id'] ? 'selected' : '') ?>><?php echo $value['mod_desc'] ?></option>
                                                  <?php endforeach; ?>
                                              </select>

                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-6">
                                        <div class="form-group row">
                                          <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Type Of Module</label>
                                          <div class="col-md">

                                              <select class="form-control" name="type_of_module" >
                                                  <option value="">---</option>
                                                  <?php foreach ($type_of_module_list as $key => $value) : ?>
                                                    <option value="<?php echo $value['id'] ?>" <?php echo (@$filter['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code']." - ".$value['name'] ?></option>
                                                  <?php endforeach; ?>
                                              </select>

                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-6">
                                        <div class="form-group row">
                                          <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Discipline</label>
                                          <div class="col-md">

                                              <select class="form-control" name="discipline" >
                                                  <option value="">---</option>
                                                  <?php foreach ($discipline_list as $key => $value) : ?>
                                                  <option value="<?php echo $value['id'] ?>" <?php echo (@$filter['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
                                                  <?php endforeach; ?>
                                              </select>

                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-6">
                                        <div class="form-group row">
                                          <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Deck Elevation / Service Line</label>
                                          <div class="col-md">

                                              <select class="form-control" name="deck_elevation" >
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

                                          <!-- <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Phase - L#5</label>

                                          <div class="col-md">
                                            
                                              <select class="form-control" name="phase" >
                                                <option value="">---</option>
                                                <option value="FB" <?php echo (@$filter['phase'] == "FB" ? 'selected' : '') ?>>Fabrication</option>
                                                <option value="AS" <?php echo (@$filter['phase'] == "AS" ? 'selected' : '') ?>>Assembly</option>
                                                <option value="ER" <?php echo (@$filter['phase'] == "ER" ? 'selected' : '') ?>>Erection</option>
                                              </select>

                                          </div> -->

                                          <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Description Assy Code</label>
                                          <div class="col-md">

                                              <select class="form-control select2" name="desc_assy" >
                                                <option value="">---</option>
                                                <?php foreach ($desc_assy_list as $key => $value) : ?>
                                                  <option value="<?php echo $value['id'] ?>" <?php echo (@$filter['desc_assy'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code']." - ".$value['name'] ?></option>
                                                <?php endforeach; ?>
                                              </select>

                                          </div>

                                        </div>
                                      </div>
                                    </div>

                                    <div class="row">
                                      <div class="col-6">
                                        <div class="form-group row">
                                          <label class="col-md-4 col-lg-3 col-form-label font-weight-bold"><!-- Description Assy Code - L#6 --></label>
                                          <div class="col-md">

                                            <!--   <select class="form-control select2" name="desc_assy" >
                                                <option value="">---</option>
                                                <?php foreach ($desc_assy_list as $key => $value) : ?>
                                                  <option value="<?php echo $value['id'] ?>" <?php echo (@$filter['desc_assy'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code']." - ".$value['name'] ?></option>
                                                <?php endforeach; ?>
                                              </select> -->

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
                                       <?php if($filter["desc_assy"] == ""){ ?> Progress Measurement <?php } else { ?> Project Database <?php } ?>                                   
                                  </h6>
                                </div>
                                <div class="card-body bg-white overflow-auto">
                                  <table width="100%"  class="table table-hover table-bordered" cellpadding="10" style="text-align: center">
                                    <tr>
                                        <th rowspan="3">Project</th>

                                        <?php if($filter["project"] != ""){ ?> 
                                        <th rowspan="3">Module</th>
                                        <?php } ?>

                                        <?php if($filter["module"] != ""){ ?> 
                                        <th rowspan="3">Type of Module</th>
                                        <?php } ?>

                                        <?php if($filter["type_of_module"] != ""){ ?> 
                                        <th rowspan="3">Discipline</th>
                                        <?php } ?>

                                        <?php if($filter["discipline"] != ""){ ?> 
                                        <th rowspan="3">Deck Elevation / Service Line</th>
                                        <?php } ?>

                                        <?php if($filter["deck_elevation"] != ""){ ?> 
                                        <th rowspan="3">Description Assy Code</th>
                                        <?php } ?>

                                        <?php if($filter["desc_assy"] != ""){ ?>           
                                        <th rowspan="3">Part ID</th>                               
                                        <?php } ?> 

                                        <th <?php if($filter["discipline"] != "1"){ ?>colspan="13"<?php } else { ?>colspan="9"<?php } ?>><?php if($filter["desc_assy"] == ""){ ?> Progress Measurement <?php } else { ?> Project Database <?php } ?></th>
                                    </tr>
                                    <tr>
                                        <th colspan="5">Fabrication <?php if($filter["discipline"] == "2" && $filter["desc_assy"] == ""){ ?><hr/>60%<?php } else if($filter["desc_assy"] == ""){ ?><hr/>40%<?php } ?></th>
                                        <?php if($filter["discipline"] != "1"){ ?>
                                        <th colspan="4">Assembly <?php if($filter["discipline"] == "2" && $filter["desc_assy"] == ""){ ?><hr/>30%<?php } ?></th>
                                        <?php } ?>
                                        <th colspan="4">Erection <?php if($filter["discipline"] == "2" && $filter["desc_assy"] == ""){ ?><hr/>10%<?php } else if($filter["desc_assy"] == ""){ ?><hr/>30%<?php } ?></th>
                                    </tr>
                                    <tr>                                                                        
                                        <th>
                                          Mark / Cutting <?php if($filter["desc_assy"] == ""){ ?><hr/>15%<?php } ?>
                                        </th>
                                        <th>
                                          Fit-up <?php if($filter["desc_assy"] == ""){ ?><br/><br/><hr/>30%<?php } ?>   
                                        </th>
                                        <th>
                                          Weld Out <?php if($filter["desc_assy"] == ""){ ?><hr/>45%<?php } ?>
                                        </th>
                                        <th>
                                          NDE Acceptance <?php if($filter["desc_assy"] == ""){ ?><hr/>10%<?php } ?>
                                        </th>
                                        <th>Progress Sum Fabrication</th>

                                        <?php if($filter["discipline"] != "1"){ ?>
                                        <th>
                                          Fit-up <?php if($filter["desc_assy"] == ""){ ?><br/><br/><hr/>40%<?php } ?>          
                                        </th>
                                        <th>
                                          Weld Out <?php if($filter["desc_assy"] == ""){ ?><hr/>50%<?php } ?> 
                                        </th>
                                        <th>
                                          NDE Acceptance <?php if($filter["desc_assy"] == ""){ ?><hr/>10%<?php } ?>
                                        </th>
                                        <th>Progress Sum Assembly</th>
                                        <?php } ?>

                                        <th>
                                          Fit-up <?php if($filter["desc_assy"] == ""){ ?><br/><br/><hr/>40%<?php } ?>         
                                        </th>
                                        <th>
                                          Weld Out <?php if($filter["desc_assy"] == ""){ ?><hr/>50%<?php } ?>
                                        </th>
                                        <th>
                                          NDE Acceptance <?php if($filter["desc_assy"] == ""){ ?><hr/>10%<?php } ?>
                                        </th>
                                        <th>
                                          Progress Sum Erection
                                        </th>
                                    </tr>
                                   
                                    <?php foreach ($pcms_summary as $key => $value) { ?>
                                    <tr>
                                        <td <?php if($filter["desc_assy"] == ""){ echo "rowspan='2'"; } ?>><?php echo $project_list_data[$value['project']]['project_name']; ?></td>

                                        <?php if($filter["project"] != ""){ ?> 

                                        <td <?php if($filter["desc_assy"] == ""){ echo "rowspan='2'"; } ?>><?php echo $module_list[$value['module']]['mod_desc']; ?></td>

                                        <?php } ?> 

                                        <?php if($filter["module"] != ""){ ?> 

                                        <td <?php if($filter["desc_assy"] == ""){ echo "rowspan='2'"; } ?>><?php echo $type_of_module_list_data[$value['type_of_module']]['name']; ?></td>

                                        <?php } ?> 

                                        <?php if($filter["type_of_module"] != ""){ ?> 

                                        <td <?php if($filter["desc_assy"] == ""){ echo "rowspan='2'"; } ?>><?php echo $discipline_list_data[$value['discipline']]['discipline_name']; ?></td>

                                        <?php } ?> 

                                        <?php if($filter["discipline"] != ""){ ?> 

                                        <td <?php if($filter["desc_assy"] == ""){ echo "rowspan='2'"; } ?>><?php echo $deck_elevation_list_data[$value['deck_elevation']]['name']; ?></td>

                                        <?php } ?> 

                                        <?php if($filter["deck_elevation"] != ""){ ?> 

                                        <td <?php if($filter["desc_assy"] == ""){ echo "rowspan='2'"; } ?>><?php echo $desc_assy_list_data[$value['description_assy']]['name']; ?></td>

                                        <?php } ?> 

                                        <?php if($filter["desc_assy"] != ""){ ?> 

                                        <td><?php echo $value['part_id']; ?></td>

                                        <?php } ?>   
                                                       
                                          <?php 

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

                                          ?>

                                          <td 
                                          <?php 
                                          if($prefab_percent_f >= 100){ echo "style='background-color:#b0ffc5'"; } else 
                                          if($prefab_percent_f < 100 && $prefab_percent_f != 0){ echo "style='background-color:#ffe9b0'"; } else 
                                          { echo "style='background-color:#ffb0b0'"; } 
                                          ?>
                                          >
                                            <?php echo $prefab_percent_f."%"; ?>
                                          </td>

                                          <td
                                          <?php 
                                          if($fu_percent_f >= 100){ echo "style='background-color:#b0ffc5'"; } else 
                                          if($fu_percent_f < 100 && $fu_percent_f != 0){ echo "style='background-color:#ffe9b0'"; } else 
                                          { echo "style='background-color:#ffb0b0'"; } 
                                          ?>
                                          >
                                            <?php echo $fu_percent_f."%"; ?>
                                          </td>

                                          <td
                                          <?php 
                                          if($vs_percent_f >= 100){ echo "style='background-color:#b0ffc5'"; } else 
                                          if($vs_percent_f < 100 && $vs_percent_f != 0){ echo "style='background-color:#ffe9b0'"; } else 
                                          { echo "style='background-color:#ffb0b0'"; } 
                                          ?>
                                          ><?php echo $vs_percent_f."%"; ?>
                                          </td>

                                          <td
                                          <?php 
                                          if($ndt_percent_f >= 100){ echo "style='background-color:#b0ffc5'"; } else 
                                          if($ndt_percent_f < 100 && $ndt_percent_f != 0){ echo "style='background-color:#ffe9b0'"; } else 
                                          { echo "style='background-color:#ffb0b0'"; } 
                                          ?>
                                          >
                                            <?php echo $ndt_percent_f."%"; ?>
                                          </td>

                                          <td
                                          <?php 
                                          if(round($total_progress_f,2) >= 100){ echo "style='background-color:#b0ffc5'"; } else 
                                          if(round($total_progress_f,2) < 100 && round($total_progress_f,2) != 0){ echo "style='background-color:#ffe9b0'"; } else 
                                          { echo "style='background-color:#ffb0b0'"; } 
                                          ?>
                                          >
                                            <?php echo round($total_progress_f,2)."%"; ?> 
                                          
                                          </td>

                                          <?php 

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

                                          ?>
                                        
                                          <td
                                          <?php 
                                          if($fu_percent_as >= 100){ echo "style='background-color:#b0ffc5'"; } else 
                                          if($fu_percent_as < 100 && $fu_percent_as != 0){ echo "style='background-color:#ffe9b0'"; } else 
                                          { echo "style='background-color:#ffb0b0'"; } 
                                          ?>
                                          >
                                            <?php echo $fu_percent_as."%"; ?>
                                          </td>

                                          <td
                                          <?php 
                                          if($vs_percent_as >= 100){ echo "style='background-color:#b0ffc5'"; } else 
                                          if($vs_percent_as < 100 && $vs_percent_as != 0){ echo "style='background-color:#ffe9b0'"; } else 
                                          { echo "style='background-color:#ffb0b0'"; } 
                                          ?>
                                          ><?php echo $vs_percent_as."%"; ?>
                                          </td>

                                          <td
                                          <?php 
                                          if($ndt_percent_as >= 100){ echo "style='background-color:#b0ffc5'"; } else 
                                          if($ndt_percent_as < 100 && $ndt_percent_as != 0){ echo "style='background-color:#ffe9b0'"; } else 
                                          { echo "style='background-color:#ffb0b0'"; } 
                                          ?>
                                          >
                                            <?php echo $ndt_percent_as."%"; ?>
                                          </td>

                                          <td
                                          <?php 
                                          if(round($total_progress_as,2) >= 100){ echo "style='background-color:#b0ffc5'"; } else 
                                          if(round($total_progress_as,2) < 100 && round($total_progress_as,2) != 0){ echo "style='background-color:#ffe9b0'"; } else 
                                          { echo "style='background-color:#ffb0b0'"; } 
                                          ?>
                                          >
                                            <?php echo round($total_progress_as,2)."%"; ?>                                       
                                          </td>
                                    

                                          <?php 
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

                                          ?>
                                        
                                          <td
                                          <?php 
                                          if($fu_percent_er >= 100){ echo "style='background-color:#b0ffc5'"; } else 
                                          if($fu_percent_er < 100 && $fu_percent_er != 0){ echo "style='background-color:#ffe9b0'"; } else 
                                          { echo "style='background-color:#ffb0b0'"; } 
                                          ?>
                                          >
                                            <?php echo $fu_percent_er."%"; ?>
                                          </td>

                                          <td
                                          <?php 
                                          if($vs_percent_er >= 100){ echo "style='background-color:#b0ffc5'"; } else 
                                          if($vs_percent_er < 100 && $vs_percent_er != 0){ echo "style='background-color:#ffe9b0'"; } else 
                                          { echo "style='background-color:#ffb0b0'"; } 
                                          ?>
                                          ><?php echo $vs_percent_er."%"; ?>
                                          </td>

                                          <td
                                          <?php 
                                          if($ndt_percent_er >= 100){ echo "style='background-color:#b0ffc5'"; } else 
                                          if($ndt_percent_er < 100 && $ndt_percent_er != 0){ echo "style='background-color:#ffe9b0'"; } else 
                                          { echo "style='background-color:#ffb0b0'"; } 
                                          ?>
                                          >
                                            <?php echo $ndt_percent_er."%"; ?>
                                          </td>

                                          <td
                                          <?php 
                                          if(round($total_progress_f_er,2) >= 100){ echo "style='background-color:#b0ffc5'"; } else 
                                          if(round($total_progress_f_er,2) < 100 && round($total_progress_f_er,2) != 0){ echo "style='background-color:#ffe9b0'"; } else 
                                          { echo "style='background-color:#ffb0b0'"; } 
                                          ?>
                                          >
                                            <?php echo round($total_progress_f_er,2)."%"; ?>
                                          
                                          </td>
                                    </tr>
                                      <?php if($filter["desc_assy"] == ""){ ?> 


                                      <tr>
                                        <td
                                          <?php 
                                          if($pf_percent_2 >= $bobot_mv_fab){ echo "style='background-color:#1dd600'"; } else 
                                          if($pf_percent_2 < $bobot_mv_fab && $pf_percent_2 != 0){ echo "style='background-color:#ffcd57'"; } else 
                                          { echo "style='background-color:#ff706e'"; } 
                                          ?>
                                        ><?php if($filter["desc_assy"] == ""){ ?>(<?php echo $pf_percent_2."%"; ?>)<?php } ?></td>
                                        <td
                                          <?php 
                                          if($fu_percent_2 >= $bobot_fu_fab){ echo "style='background-color:#1dd600'"; } else 
                                          if($fu_percent_2 < $bobot_fu_fab && $fu_percent_2 != 0){ echo "style='background-color:#ffcd57'"; } else 
                                          { echo "style='background-color:#ff706e'"; } 
                                          ?>
                                        ><?php if($filter["desc_assy"] == ""){ ?>(<?php echo $fu_percent_2."%"; ?>)<?php } ?></td>
                                        <td
                                          <?php 
                                          if($vs_percent_2 >= $bobot_vs_fab){ echo "style='background-color:#1dd600'"; } else 
                                          if($vs_percent_2 < $bobot_vs_fab && $vs_percent_2 != 0){ echo "style='background-color:#ffcd57'"; } else 
                                          { echo "style='background-color:#ff706e'"; } 
                                          ?>
                                        ><?php if($filter["desc_assy"] == ""){ ?>(<?php echo $vs_percent_2."%"; ?>)<?php } ?></td>
                                        <td
                                          <?php 
                                          if($ndt_percent_2 >= $bobot_ndt_fab){ echo "style='background-color:#1dd600'"; } else 
                                          if($ndt_percent_2 < $bobot_ndt_fab && $ndt_percent_2 != 0){ echo "style='background-color:#ffcd57'"; } else 
                                          { echo "style='background-color:#ff706e'"; } 
                                          ?>
                                        ><?php if($filter["desc_assy"] == ""){ ?>(<?php echo $ndt_percent_2."%"; ?>)<?php } ?></td>
                                        <td
                                          <?php 
                                          if($total_progress_f_2 >= 100){ echo "style='background-color:#1dd600'"; } else 
                                          if($total_progress_f_2 < 100 && $total_progress_f_2 != 0){ echo "style='background-color:#ffcd57'"; } else 
                                          { echo "style='background-color:#ff706e'"; } 
                                          ?>
                                        ><?php if($filter["desc_assy"] == ""){ ?>(<?php echo $total_progress_f_2."%"; ?>)<?php } ?></td>

                                        <!-- ----- -->
                                        <td
                                          <?php 
                                          if($fu_percent_2_as >= $bobot_fu_as){ echo "style='background-color:#1dd600'"; } else 
                                          if($fu_percent_2_as < $bobot_fu_as && $fu_percent_2_as != 0){ echo "style='background-color:#ffcd57'"; } else 
                                          { echo "style='background-color:#ff706e'"; } 
                                          ?>
                                        ><?php if($filter["desc_assy"] == ""){ ?>(<?php echo $fu_percent_2_as."%"; ?>)<?php } ?></td>
                                        <td
                                          <?php 
                                          if($vs_percent_2_as >= $bobot_vs_as){ echo "style='background-color:#1dd600'"; } else 
                                          if($vs_percent_2_as < $bobot_vs_as && $vs_percent_2_as != 0){ echo "style='background-color:#ffcd57'"; } else 
                                          { echo "style='background-color:#ff706e'"; } 
                                          ?>
                                        ><?php if($filter["desc_assy"] == ""){ ?>(<?php echo $vs_percent_2_as."%"; ?>)<?php } ?></td>
                                        <td
                                          <?php 
                                          if($ndt_percent_2_as >= $bobot_ndt_as){ echo "style='background-color:#1dd600'"; } else 
                                          if($ndt_percent_2_as < $bobot_ndt_as && $ndt_percent_2_as != 0){ echo "style='background-color:#ffcd57'"; } else 
                                          { echo "style='background-color:#ff706e'"; } 
                                          ?>
                                        ><?php if($filter["desc_assy"] == ""){ ?>(<?php echo $ndt_percent_2_as."%"; ?>)<?php } ?></td>
                                        <td
                                          <?php 
                                          if($total_progress_f_2_as >= 100){ echo "style='background-color:#1dd600'"; } else 
                                          if($total_progress_f_2_as < 100 && $total_progress_f_2_as != 0){ echo "style='background-color:#ffcd57'"; } else 
                                          { echo "style='background-color:#ff706e'"; } 
                                          ?>
                                        ><?php if($filter["desc_assy"] == ""){ ?>(<?php echo $total_progress_f_2_as."%"; ?>)<?php } ?></td>

                                        <!-- ----- -->

                                        <td
                                          <?php 
                                          if($fu_percent_2_er >= $bobot_fu_er){ echo "style='background-color:#1dd600'"; } else 
                                          if($fu_percent_2_er < $bobot_fu_er && $fu_percent_2_er != 0){ echo "style='background-color:#ffcd57'"; } else 
                                          { echo "style='background-color:#ff706e'"; } 
                                          ?>
                                        ><?php if($filter["desc_assy"] == ""){ ?>(<?php echo $fu_percent_2_er."%"; ?>)<?php } ?></td>
                                        <td
                                          <?php 
                                          if($vs_percent_2_er >= $bobot_vs_er){ echo "style='background-color:#1dd600'"; } else 
                                          if($vs_percent_2_er < $bobot_vs_er && $vs_percent_2_er != 0){ echo "style='background-color:#ffcd57'"; } else 
                                          { echo "style='background-color:#ff706e'"; } 
                                          ?>
                                        ><?php if($filter["desc_assy"] == ""){ ?>(<?php echo $vs_percent_2_er."%"; ?>)<?php } ?></td>
                                        <td
                                          <?php 
                                          if($ndt_percent_2_er >= $bobot_ndt_er){ echo "style='background-color:#1dd600'"; } else 
                                          if($ndt_percent_2_er < $bobot_ndt_er && $ndt_percent_2_er != 0){ echo "style='background-color:#ffcd57'"; } else 
                                          { echo "style='background-color:#ff706e'"; } 
                                          ?>
                                        ><?php if($filter["desc_assy"] == ""){ ?>(<?php echo $ndt_percent_2_er."%"; ?>)<?php } ?></td>
                                        <td
                                          <?php 
                                          if($total_progress_f_2_er >= 100){ echo "style='background-color:#1dd600'"; } else 
                                          if($total_progress_f_2_er < 100 && $total_progress_f_2_er != 0){ echo "style='background-color:#ffcd57'"; } else 
                                          { echo "style='background-color:#ff706e'"; } 
                                          ?>
                                        ><?php if($filter["desc_assy"] == ""){ ?>(<?php echo $total_progress_f_2_er."%"; ?>)<?php } ?></td>
                                        
                                      </tr>
                                      <?php } ?>
                                    <?php } ?>
                                  </table>
                                </div>
                              </div>
                            </div>
                        </div>

                        <?php if($filter["desc_assy"] == ""){ ?>

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
  $("select[name=module]").chained("select[name=project]");
</script>