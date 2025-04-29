<!DOCTYPE html>
<html>
<head>
  <title>WTR</title>
  <style type="text/css">
    .wtr {
      font-family: Arial, Helvetica, sans-serif;
      font-size: 5pt;
      border-collapse: collapse;
      width: 100%;
    }

    .wtr td {
      border: 0.10px solid #000000;
      word-wrap: break-word;
    }

    .wtr th {
      border: 0.10px solid #000000;
      word-wrap: break-word;
      font-weight: bold;
      vertical-align: middle !important;
      text-align: center;
    }

    .wtr_title {
      font-family: Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 100%;
      font-size: 9px !important;

    }

    .wtr_title td, .wtr_title th {
      word-wrap: break-word;

    }

    .wtrthe {
      font-family: Arial, Helvetica, sans-serif;
      font-weight: bold;
      vertical-align: middle !important;
      text-align: center;
      border: 0.10px solid #000000;
    }

    .table {
      word-wrap: break-word;
      border: 0.10px solid #000000;   
      vertical-align: middle !important;
      text-align: center; 
    }

    .table td, th {
      border: 0.08px solid #000000;
      vertical-align: middle !important;
      text-align: center;
    }

    body {
     
      font-size: 5px !important;
    }

  </style>
</head>
<body>
  <header>

          <table>
              <?php 
                $img_base64_encoded = $project_client_logo[$project];
                $imageContent       = file_get_contents($img_base64_encoded);
                $path               = tempnam(sys_get_temp_dir(), 'prefix');
                file_put_contents ($path, $imageContent);
              ?>
              <tr>
                <td rowspan="2" style="text-align: left;">
                  <img src="<?php echo $path; ?>" style="width: 80px !important"/>
                </td>
                <td style="text-align: center; font-weight: bold; font-size: 12pt; margin-bottom: 100pt"><?= strtoupper($project_client_description[$project]) ?></td>
                <td rowspan="2" style="text-align: right;">
                  <img src="<?php echo base_url('img/sembcorp-logo.png'); ?>" style="width: 80px !important"/>
                </td>
              </tr>
              <tr>                
                <td style="text-align: center; font-weight: bold; font-size: 11pt">MATERIAL & WELDING TRACEABILITY RECORD - STRUCTURAL</td>
              </tr>    
          </table>

          <br/><br/>

            <table class="table wtr">
              <thead>  
                <tr>
                  <th style="text-align: left;width: 75px !important;">PROJECT NAME</th>
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
                  <th rowspan="3" style="width: 75px !important;"><br/><br/>Drawing/Weld Map No</th>
                  <th rowspan="3"><br/><br/>Rev No</th>
                  <th rowspan="3"><br/><br/>Joint No</th>
                  <th rowspan="3"><br/>Type Of Weld</th>
                  <th rowspan="3"><br/><br/>Class</th>
                  <th rowspan="3"><br/><br/>Dia</th>
                  <th rowspan="3"><br/><br/>Thk</th>
                  <th rowspan="3"><br/><br/>Sch</th>
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
                        <td style="width: 75px !important;"><?php echo $value['drawing_wm']; ?></td>
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
                        <td><?php if(isset($ndt[$value['id_visual']][2]['report_number'])){ if($value["mt_percent_req"] > 0){ echo $value["mt_percent_req"]."%"; } else { echo "-"; } } ?></td>
                        <td><?= @$ndt[$value['id_visual']][2]['report_number'] ?></td>
                        <td><?= @$ndt[$value['id_visual']][2]['date_of_inspection']>0 ? DATE('d F, Y', strtotime($ndt[$value['id_visual']][2]['date_of_inspection'])) : '' ?></td>
                        <td><?= @$ndt[$value['id_visual']][2]['result']==3 ? 'ACC' : (@$ndt[$value['id_visual']][2]['result']==2 ? 'REJECT' : '') ?></td>
                        <td><?php if(isset($ndt[$value['id_visual']][7]['report_number'])){ if($value["pt_percent_req"] > 0){ echo $value["pt_percent_req"]."%"; } else { echo "-"; } } ?></td>
                        <td><?= @$ndt[$value['id_visual']][7]['report_number'] ?></td>
                        <td><?= @$ndt[$value['id_visual']][7]['date_of_inspection']>0 ? DATE('d F, Y', strtotime($ndt[$value['id_visual']][7]['date_of_inspection'])) : '' ?></td>
                        <td><?= @$ndt[$value['id_visual']][7]['result']==3 ? 'ACC' : (@$ndt[$value['id_visual']][7]['result']==2 ? 'REJECT' : '') ?></td>
                        <td><?php if(isset($ndt[$value['id_visual']][3]['report_number'])){ if($value["ut_percent_req"] > 0){ echo $value["ut_percent_req"]."%"; } else { echo "-"; } } ?></td>
                        <td><?= @$ndt[$value['id_visual']][3]['report_number'] ?></td>
                        <td><?= @$ndt[$value['id_visual']][3]['date_of_inspection']>0 ? DATE('d F, Y', strtotime($ndt[$value['id_visual']][3]['date_of_inspection'])) : '' ?></td>
                        <td><?= @$ndt[$value['id_visual']][3]['result']==3 ? 'ACC' : (@$ndt[$value['id_visual']][3]['result']==2 ? 'REJECT' : '') ?></td>
                        <td><?php if(isset($ndt[$value['id_visual']][1]['report_number'])){ if($value["rt_percent_req"] > 0){ echo $value["rt_percent_req"]."%"; } else { echo "-"; } } ?></td>
                        <td><?= @$ndt[$value['id_visual']][1]['report_number'] ?></td>
                        <td><?= @$ndt[$value['id_visual']][1]['date_of_inspection']>0 ? DATE('d F, Y', strtotime($ndt[$value['id_visual']][1]['date_of_inspection'])) : '' ?></td>
                        <td><?= @$ndt[$value['id_visual']][1]['result']==3 ? 'ACC' : (@$ndt[$value['id_visual']][1]['result']==2 ? 'REJECT' : '') ?></td>
                        <td><?php if(isset($status_piecemark[$value['pos_1']]['id_mis'])){ echo $value["remarks"]; } ?></td>
                    </tr>
                <?php } ?>                
              </tbody>
            </table>
</body>
</html>