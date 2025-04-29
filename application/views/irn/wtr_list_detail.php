<style>
.wtr {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

.wtr td, .wtr th {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: center;
  vertical-align: super;
}

.wtr tr:nth-child(even){background-color: #f2f2f2;}

.wtr tr:hover {background-color: #ddd;}

.wtr th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #008060;
  color: white;
}
</style>



<?php 
  
  if($module == '41' OR $module == '42'){
    $code_module = "JK";
  } else {
    $code_module = "TS";
  }

  if($discipline =='1'){
    $code_discipline = "PIP";
  } else {
    $code_discipline = "STR";
  }

?>

<div id="content" class="container-fluid">
  <div class="row">
    <?php 
    if($discipline != '1'){

      $d_link = "structural";

    } else {
      $d_link = "piping";
    }
    ?>

    <div class="col-md-12">
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0"><?php echo $meta_title ?></h6>
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
          <div class="container-fluid">
            <a href='<?php echo base_url(); ?>wtr/wtr_list/<?php echo $d_link; ?>' class='btn btn-warning'><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
            <a href='<?php echo  base_url(); ?>wtr/wtr_list_detail/<?php echo strtr($this->encryption->encrypt($project),'+=/', '.-~') ; ?>/<?php echo strtr($this->encryption->encrypt($drawing_no),'+=/', '.-~') ; ?>/<?php echo strtr($this->encryption->encrypt($drawing_type),'+=/', '.-~') ; ?>/<?php echo strtr($this->encryption->encrypt($discipline),'+=/', '.-~') ; ?>/<?php echo strtr($this->encryption->encrypt($module),'+=/', '.-~') ; ?>/<?php echo strtr($this->encryption->encrypt($type_of_module),'+=/', '.-~') ; ?>/<?php echo strtr($this->encryption->encrypt("excel"),'+=/', '.-~') ; ?>' class='btn btn-success'><i class="far fa-file-excel"></i> Excel </a>
            <a href='<?php echo  base_url(); ?>wtr/wtr_list_detail/<?php echo strtr($this->encryption->encrypt($project),'+=/', '.-~') ; ?>/<?php echo strtr($this->encryption->encrypt($drawing_no),'+=/', '.-~') ; ?>/<?php echo strtr($this->encryption->encrypt($drawing_type),'+=/', '.-~') ; ?>/<?php echo strtr($this->encryption->encrypt($discipline),'+=/', '.-~') ; ?>/<?php echo strtr($this->encryption->encrypt($module),'+=/', '.-~') ; ?>/<?php echo strtr($this->encryption->encrypt($type_of_module),'+=/', '.-~') ; ?>/<?php echo strtr($this->encryption->encrypt("pdf"),'+=/', '.-~') ; ?>' class='btn btn-danger'><i class="fas fa-file-pdf"></i> PDF </a>
            <br/>
            <br/>
            <table class="dataTable wtr" width='100%'>
              <thead>
                
                <tr>
                  <th style="text-align: left;">PROJECT NAME</th>
                  <th>:</th>                 
                  <th colspan="50" style="text-align: left;"><?= strtoupper($project_name[$project]); ?></th>                 
                </tr>
                <tr>
                  <th style="text-align: left;">CLIENT</th>
                  <th>:</th>                 
                  <th colspan="50" style="text-align: left;"><?= strtoupper($project_client[$project]); ?></th>                 
                </tr>
                <tr>
                  <th style="text-align: left;">DRAWING NO</th>
                  <th>:</th>                 
                  <th colspan="50" style="text-align: left;"><?php echo $drawing_no; ?></th>                 
                </tr>
                <tr>
                  <th style="text-align: left;">MODULE / JACKET ID</th>
                  <th>:</th>                 
                  <th colspan="50" style="text-align: left;"><?php echo $module_code[$module]; ?></th>                 
                </tr>
                <tr>
                  <th style="text-align: left;">REV</th>
                  <th>:</th>                 
                  <th colspan="50" style="text-align: left;"><?= @$drawing_detail[$wtr_list[0]['project']][$wtr_list[0]['drawing_no']][$wtr_list[0]['drawing_type']][$wtr_list[0]['discipline']][$wtr_list[0]['module']]['revision_no'] ?></th>        
                </tr>
                <tr>
                  <th style="text-align: left;">DESCRIPTION</th>
                  <th>:</th>                 
                  <th colspan="50" style="text-align: left;"><?= @$drawing_detail[$wtr_list[0]['project']][$wtr_list[0]['drawing_no']][$wtr_list[0]['drawing_type']][$wtr_list[0]['discipline']][$wtr_list[0]['module']]['title'] ?></th>                
                </tr>                
                <tr>
                  <th rowspan="3">Drawing/Weld Map No</th>
                  <th rowspan="3">Rev No</th>
                  <th rowspan="3">Joint No</th>
                  <th rowspan="3">Type Of Weld</th>
                  <th rowspan="3">Class</th>
                  <th rowspan="3">Dia</th>
                  <th rowspan="3">Thk</th>
                  <th rowspan="3">Sch</th>
                  <th colspan="12">Material Traceability</th>
                  <th colspan="3" rowspan="2">Fitup</th>
                  <th rowspan="3">Fitter Code</th>
                  <th rowspan="3">Tack Weld ID</th>
                  <th rowspan="3">WPS No</th>
                  <th rowspan="3">Consumable / Lot no</th>
                  <th rowspan="3">Welded Date</th>
                  <th colspan="2" rowspan="2">Weld Process</th>
                  <th colspan="2" rowspan="2">Welder ID</th>
                  <th colspan="3" rowspan="2">Visual</th>
                  <th colspan="16">Non Destructive Examination</th>
                  <th rowspan="3">Remarks</th>                  
                </tr>
                <tr>
                  <th colspan="6">Part #1</th>
                  <th colspan="6">Part #2</th>
                  <th colspan="4">MPI</th>
                  <th colspan="4">PT</th>
                  <th colspan="4">UT</th>
                  <th colspan="4">RT</th>
                </tr>
                <tr>
                  <th>Piecemark</th>
                  <th>Mtr No.</th>
                  <th>Grade /Spec</th>
                  <th>Unique No</th>
                  <th>Heat No</th>
                  <th>Thk (MM)</th>

                  <th>Piecemark</th>
                  <th>Mtr No.</th>
                  <th>Grade /Spec</th>
                  <th>Unique No</th>
                  <th>Heat No</th>
                  <th>Thk (MM)</th>

                  <th>Report</th>
                  <th>Date</th>
                  <th>Result</th>

                  <th>R/H</th>
                  <th>F/C</th>

                  <th>R/H</th>
                  <th>F/C</th>
                  
                  <th>Report</th>
                  <th>Date</th>
                  <th>Result</th>

                  <th>Req (%)</th>
                  <th>Report</th>
                  <th>Date</th>
                  <th>Result</th>

                  <th>Req (%)</th>
                  <th>Report</th>
                  <th>Date</th>
                  <th>Result</th>

                  <th>Req (%)</th>
                  <th>Report</th>
                  <th>Date</th>
                  <th>Result</th>

                  <th>Req (%)</th>
                  <th>Report</th>
                  <th>Date</th>
                  <th>Result</th>         
                  
                </tr>

              </thead>
              <tbody>
                <?php 

                  foreach ($wtr_list as $key => $value) {
                 ?>
                    <tr>
                        <td><?php echo $value['drawing_wm']; ?></td>
                        <td><?php echo $value['rev_wm']; ?></td>
                        <td><?php echo $value['joint_no'].$value['revision_category'].$value['revision']; ?></td>
                        <td><?php echo @$master_weld_type[$value['weld_type']]["weld_type"]; ?></td>
                        <td><?php echo $value['class']; ?></td>
                        <td><?php echo $value['diameter']; ?></td>
                        <td><?php echo $value['thickness']; ?></td>
                        <td><?php echo $value['sch']; ?></td>

                        <td>
                          <?php 
                            if(isset($status_piecemark[$value['pos_1']]['id_mis'])){ 
                              echo $value['pos_1']; 
                            } 
                          ?>
                        </td>

                        <td>
                          <?php 
                            if(isset($status_piecemark[$value['pos_1']]['id_mis'])){ 
                              echo $status_piecemark[$value['pos_1']]['report_number']; 
                            }  
                          ?>
                        </td>

                        <td>
                          <?php 
                            if(isset($status_piecemark[$value['pos_1']]['id_mis'])){
                              echo $material_grade[$status_piecemark[$value['pos_1']]['grade']]['material_grade'];
                            } 
                          ?>
                        </td>

                        <td>
                          <?php 
                            if(isset($status_piecemark[$value['pos_1']]['id_mis'])){ 
                              echo $warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['unique_ident_no']; 
                            } 
                          ?>
                        </td>

                        <td>
                          <?php 
                            if(isset($status_piecemark[$value['pos_1']]['id_mis'])){ 
                              echo $warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['heat_or_series_no'];
                            }
                          ?>                      
                        </td>

                        <td>
                          <?php 
                            if(isset($status_piecemark[$value['pos_1']]['id_mis'])){
                              echo $status_piecemark[$value['pos_1']]['thickness'];
                            } 
                          ?>
                        </td>

                        <td>
                          <?php 
                            if(isset($status_piecemark[$value['pos_2']]['id_mis'])){ 
                              echo $value['pos_2']; 
                            } 
                          ?>
                        </td>    

                        <td>
                          <?php 
                            if(isset($status_piecemark[$value['pos_2']]['report_number'])){ 
                              echo $status_piecemark[$value['pos_1']]['report_number']; 
                            } 
                          ?>
                        </td>

                        <td>
                          <?php 
                            if(isset($status_piecemark[$value['pos_2']]['id_mis'])){
                              echo $material_grade[$status_piecemark[$value['pos_2']]['grade']]['material_grade'];
                            } 
                          ?>
                        </td>

                        <td>
                          <?php 
                            if(isset($status_piecemark[$value['pos_2']]['id_mis'])){
                              echo $warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['unique_ident_no']; 
                            } 
                          ?>
                        </td>

                        <td>
                          <?php 
                            if(isset($status_piecemark[$value['pos_2']]['id_mis'])){ 
                              echo $warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['heat_or_series_no'];
                            }
                          ?>                      
                        </td>

                        <td>
                          <?php 
                            if(isset($status_piecemark[$value['pos_2']]['id_mis'])){
                              echo $status_piecemark[$value['pos_2']]['thickness'];
                            } 
                          ?>
                        </td>

                        <td><?php if($value['fitup_status_inspection'] == 7){ echo $value['fitup_report_no']; } ?></td>
                        <td><?php if($value['fitup_status_inspection'] == 7){ echo $value['fitup_inspection_datetime']; } ?></td>
                        <td><?php if($value['fitup_status_inspection'] == 7){ echo "ACC"; } ?></td>

                        <td>
                          <?php 
                          if($value['fitup_status_inspection'] == 7){
                            $fitter_id = explode(";", $value['fitter_id']);                          
                            if(sizeof($fitter_id) > 0){ 
                              foreach ($fitter_id as $key => $fitter_id_name) {
                                if(isset($master_fitter[$fitter_id_name]["fit_up_badge"])){ echo $master_fitter[$fitter_id_name]["fit_up_badge"]."<br/>"; }
                              }
                            }
                          }   
                          ?>
                        </td>

                        <td>
                          <?php 
                          if($value['fitup_status_inspection'] == 7){
                            $tack_weld_id = explode(";", $value['tack_weld_id']);                          
                            if(sizeof($tack_weld_id) > 0){ 
                              foreach ($tack_weld_id as $key => $tack_weld_id_name) {
                                if(isset($master_welder[$tack_weld_id_name]["wel_code"])){ echo $master_welder[$tack_weld_id_name]["wel_code"]."<br/>"; }
                              }
                            } 
                          } 
                          ?>
                        </td>

                        <td>
                          <?php 
                            $wps_rh = explode(";", $value['wps_no_rh']);
                            $wps_fc = explode(";", $value['wps_no_fc']);
                            $wps_show = array_unique(array_merge($wps_rh, $wps_fc));
                            if(sizeof($wps_show) > 0){ 
                              foreach ($wps_show as $key => $wps_id) {
                                if(isset($wps_code_arr[$wps_id])){ echo $wps_code_arr[$wps_id]; }
                              }
                            } 
                          ?>
                        </td>

                        <td><?php echo $value['cons_lot_no']; ?></td>

                        <td><?php echo $value['weld_datetime']; ?></td>

                        <td>
                          <?php  
                            if($value["process_gtaw_rh"] > 0){ echo "GTAW <br/>"; }
                            if($value["process_gmaw_rh"] > 0){ echo "GMAW <br/>"; }
                            if($value["process_smaw_rh"] > 0){ echo "SMAW <br/>"; }
                            if($value["process_fcaw_rh"] > 0){ echo "FCAW <br/>"; }
                            if($value["process_saw_rh"]  > 0){ echo "SAW <br/>"; }
                          ?>
                        </td>

                        <td>
                          <?php  
                            if($value["process_gtaw_fc"] > 0){ echo "GTAW <br/>"; }
                            if($value["process_gmaw_fc"] > 0){ echo "GMAW <br/>"; }
                            if($value["process_smaw_fc"] > 0){ echo "SMAW <br/>"; }
                            if($value["process_fcaw_fc"] > 0){ echo "FCAW <br/>"; }
                            if($value["process_saw_fc"]  > 0){ echo "SAW <br/>"; }
                          ?>
                        </td>

                        <td>
                          <?php 
                            $welder_rh = explode(";", $value['welder_ref_rh']);                          
                            if(sizeof($welder_rh) > 0){ 
                              foreach ($welder_rh as $key => $welder_id_rh) {
                                if(isset($master_welder[$welder_id_rh]["wel_code"])){ 
                                  echo $master_welder[$welder_id_rh]["wel_code"]."<br/>";
                                }
                              }
                            } 
                          ?>
                        </td>

                         <td>
                          <?php 
                            $welder_fc = explode(";", $value['welder_ref_fc']);                          
                            if(sizeof($welder_fc) > 0){ 
                              foreach ($welder_fc as $key => $welder_id_fc) {
                                if(isset($master_welder[$welder_id_fc]["wel_code"])){ 
                                  echo $master_welder[$welder_id_fc]["wel_code"]."<br/>";
                                }
                              }
                            } 
                          ?>
                        </td>

                        <td><?php if($value['visual_status_inspection'] == 7){ echo $value['visual_report_no']; } ?></td>

                        <td><?php if($value['visual_status_inspection'] == 7){ echo $value['visual_inspection_datetime']; } ?></td>

                        <td><?php if($value['visual_status_inspection'] == 7){ echo "ACC"; } ?></td>

                        <td><?php if(isset($ndt[$value['id_visual']][2]['report_number'])){ echo $value["mt_percent_req"]."%"; } else { echo "-"; }  ?></td>
                        <td><?= @$ndt[$value['id_visual']][2]['report_number'] ?></td>
                        <td><?= @$ndt[$value['id_visual']][2]['date_of_inspection']>0 ? DATE('d F, Y', strtotime($ndt[$value['id_visual']][2]['date_of_inspection'])) : '' ?></td>
                        <td><?= @$ndt[$value['id_visual']][2]['result']==3 ? 'ACC' : (@$ndt[$value['id_visual']][2]['result']==2 ? 'REJECT' : '') ?></td>

                        <td><?php if(isset($ndt[$value['id_visual']][7]['report_number'])){  echo $value["pt_percent_req"]."%"; } else { echo "-"; } ?></td>
                        <td><?= @$ndt[$value['id_visual']][7]['report_number'] ?></td>
                        <td><?= @$ndt[$value['id_visual']][7]['date_of_inspection']>0 ? DATE('d F, Y', strtotime($ndt[$value['id_visual']][7]['date_of_inspection'])) : '' ?></td>
                        <td><?= @$ndt[$value['id_visual']][7]['result']==3 ? 'ACC' : (@$ndt[$value['id_visual']][7]['result']==2 ? 'REJECT' : '') ?></td>

                        <td><?php if(isset($ndt[$value['id_visual']][3]['report_number'])){  echo $value["ut_percent_req"]."%"; } else { echo "-"; }  ?></td>
                        <td><?= @$ndt[$value['id_visual']][3]['report_number'] ?></td>
                        <td><?= @$ndt[$value['id_visual']][3]['date_of_inspection']>0 ? DATE('d F, Y', strtotime($ndt[$value['id_visual']][3]['date_of_inspection'])) : '' ?></td>
                        <td><?= @$ndt[$value['id_visual']][3]['result']==3 ? 'ACC' : (@$ndt[$value['id_visual']][3]['result']==2 ? 'REJECT' : '') ?></td>

                        <td><?php if(isset($ndt[$value['id_visual']][1]['report_number'])){ echo $value["rt_percent_req"]."%"; } else { echo "-"; } ?></td>
                        <td><?= @$ndt[$value['id_visual']][1]['report_number'] ?></td>
                        <td><?= @$ndt[$value['id_visual']][1]['date_of_inspection']>0 ? DATE('d F, Y', strtotime($ndt[$value['id_visual']][1]['date_of_inspection'])) : '' ?></td>
                        <td><?= @$ndt[$value['id_visual']][1]['result']==3 ? 'ACC' : (@$ndt[$value['id_visual']][1]['result']==2 ? 'REJECT' : '') ?></td>

                        <td><?php if(isset($status_piecemark[$value['pos_1']]['id_mis'])){ echo $value["remarks"]; } ?></td>
                    </tr>
                <?php } ?>                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div><!-- ini div dari sidebar yang class wrapper -->

<script type="text/javascript">

  $('.dataTable').DataTable({
    "scrollY":        700,
    "scrollX":        true,
    "scrollCollapse": true,
    "fixedColumns":   {
            leftColumns: 3
        },
    //"order": [[2, 'asc']]    

  });

  </script>