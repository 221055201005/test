<!DOCTYPE html>
<html>
<head>
  <title>MWTR</title>
  <style type="text/css">

    @page {
      margin: 0cm 0cm;
    }

    body {
      top: 1cm !important;
      left: 0cm !important;
      right: 0cm !important;
      margin-left: 0.5cm !important;
      margin-right: 0.5cm !important;
      margin-bottom: 0cm !important;
      margin-top: 1cm !important;
      font-family: "helvetica";
      font-size: 8px !important;
    }

    .wtr {
      font-family: Arial, Helvetica, sans-serif;
      font-size: 9pt;
      border-collapse: collapse;
      width: 100%;
    }

    .wtr td {
      border: 0.10px solid #000000;
      word-wrap: break-word;
      text-align: center;
    }

    .wtr th {
      border: 0.10px solid #000000;
      word-wrap: break-word;
      font-weight: bold;
      vertical-align: middle !important;
      text-align: center;
    }

    .title_desc {
      font-family: Arial, Helvetica, sans-serif;
      font-size: 9pt;
      border-collapse: collapse;
      width: 100%;
      text-align: left;
    }

    .title_desc td {      
      word-wrap: break-word;
      text-align: left;
    }

    .title_desc th {
      word-wrap: break-word;
      font-weight: bold;
      vertical-align: middle !important;
      text-align: left;
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
    }

    a {
      color: black !important;      
      text-decoration: none !important;
    }

  </style>
</head>
<body>
    <header>
          <table width="100%">             
              <tr>
                <td style="text-align: center;">
                  <center>
                    <img src="img/logo_top_sofia.png" style="width: 450px !important"/>
                  </center>
                </td>
              </tr>   
          </table>     
         
          <table width="100%">
            <tr>
              <td width="40%">

                <table class='title_desc' width="100%">
                  <thead>  
                    <tr>
                      <th>PROJECT NAME</th>
                      <th>:</th>                 
                      <th><?= strtoupper($project_name[$project]); ?></th>                 
                    </tr>
                    <tr>
                      <th>CLIENT</th>
                      <th>:</th>                 
                      <th><?= strtoupper($project_client[$project]); ?></th>                 
                    </tr>
                    <?php if(!isset($display_status)){ ?>
                    <tr>
                      <th>DRAWING NO</th>
                      <th>:</th>                 
                      <th><?php echo $drawing_no; ?></th>                 
                    </tr>
                    <tr>
                      <th>REV</th>
                      <th>:</th>                 
                      <th>
                        <?= @$drawing_detail[$wtr_list[0]['project']][$wtr_list[0]['drawing_no']]['revision_no'] ?>
                      </th>        
                    </tr>
                    <tr>
                      <th>DESCRIPTION</th>
                      <th>:</th>                 
                      <th>
                        <?= @$drawing_detail[$wtr_list[0]['project']][$wtr_list[0]['drawing_no']]['title'] ?>
                      </th>                
                    </tr>
                  <?php } ?>
                  </thead>
                </table>

              </td>
              <td width="60%">
                <table width="100%">             
                    <tr>
                      <td style="text-align: center;">
                        <center>
                          <span style="font-size: 15px !important;font-weight: bold;">
                            MATERIAL & WELDING TRACEABILITY RECORD - STRUCTURAL
                          </span>
                        </center>
                      </td>
                    </tr>   
                </table>  
              </td>
            </tr>
          </table>
    </header>
       <br/>
            <table class="table wtr">
              <thead>  
                <tr>
                  <th rowspan="3" style="width: 75px !important;"><br/><br/>Drawing/Weld Map No</th>
                  <th rowspan="3"><br/><br/>Rev No</th>
                  <th rowspan="3"><br/><br/>Joint No</th>
                  <th rowspan="3"><br/><br/>Class</th>
                  <th rowspan="3"><br/><br/>Weld Length</th>
                  <th rowspan="3"><br/><br/>Size / Dia</th>
                  <th rowspan="3"><br/><br/>Thk<br/>(mm)</th>
                  <th colspan="12">Material Traceability</th>
                  <th colspan="3" rowspan="2">Fitup</th>
                  <th rowspan="3">Tack Weld ID</th>
                  <th rowspan="3">WPS No</th>
                  <th rowspan="3">Consumable / Lot no</th>
                  <th rowspan="3">Welded Date</th>
                  <th colspan="2" rowspan="2">Weld Process</th>
                  <th colspan="2" rowspan="2">Welder ID</th>
                  <th colspan="3" rowspan="2">Visual</th>
                  <th colspan="12">Non Destructive Examination</th>
                  <th rowspan='2' colspan="3">IRN to B&P</th>
                  <th rowspan="3" style="width:50px !important">Remarks</th>                  
                </tr>
                <tr>
                  <th colspan="6">Part #1</th>
                  <th colspan="6">Part #2</th>
                  <th colspan="3">MPI</th>
                  <th colspan="3">PT</th>
                  <th colspan="3">UT</th>
                  <th colspan="3">RT</th>
                </tr>
                <tr>
                  <th>Piece<br/>Mark</th>
                  <th>Mtr No.</th>
                  <th>Grade /Spec</th>
                  <th>Unique No</th>
                  <th>Heat No</th>
                  <th>Thk / Sch</th>
                  <th>Piece<br/>Mark</th>
                  <th>Mtr No.</th>
                  <th>Grade /Spec</th>
                  <th>Unique No</th>
                  <th>Heat No</th>
                  <th>Thk / Sch</th>

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

                  <th>Report</th>
                  <th>Date</th>
                  <th>Result</th>

                  <th>Report</th>
                  <th>Date</th>
                  <th>Result</th>

                  <th>Report</th>
                  <th>Date</th>
                  <th>Result</th>

                  <th>Report</th>
                  <th>Date</th>
                  <th>Result</th>

                  <th>Report</th>
                  <th>Date</th>
                  <th>Result</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  foreach ($wtr_list as $key => $value) {
                     if($value['fitup_status_inspection'] != 2 AND $value['visual_status_inspection'] != 2){
                ?>

                  <?php 
                    
                    $project_id_enc     = strtr($this->encryption->encrypt($value['project']), '+=/', '.-~');
                    $discipline_enc     = strtr($this->encryption->encrypt($value['discipline']), '+=/', '.-~');
                    $type_of_module_enc = strtr($this->encryption->encrypt($value['type_of_module']), '+=/', '.-~');
                    $module_enc         = strtr($this->encryption->encrypt($value['module']), '+=/', '.-~');

                    if(isset($status_piecemark[$value['pos_1']]['report_number'])){ 
                        $report_enc_mv_p1   = strtr($this->encryption->encrypt($status_piecemark[$value['pos_1']]['report_number']), '+=/', '.-~');
                        $report_enc_mv_p2   = strtr($this->encryption->encrypt($status_piecemark[$value['pos_2']]['report_number']), '+=/', '.-~');
                        $report_no_rev_p1   = strtr($this->encryption->encrypt($status_piecemark[$value['pos_1']]['report_no_rev']), '+=/', '.-~');
                        $report_no_rev_p2   = strtr($this->encryption->encrypt($status_piecemark[$value['pos_2']]['report_no_rev']), '+=/', '.-~');
                    } 

                    if(isset($value['fitup_report_no'])){
                      $report_fitup_enc   = strtr($this->encryption->encrypt($value['fitup_report_no']), '+=/', '.-~');
                    }

                    if(isset($value['visual_report_no'])){
                      $report_visual_enc   = strtr($this->encryption->encrypt($value['visual_report_no']), '+=/', '.-~');
                    }
                  
                  ?>

                    <tr>
                        <td style="width: 75px !important;"><?php echo $value['drawing_wm']; ?></td>
                        <td><?php echo $value['rev_wm']; ?></td>
                        <td><?php echo $value['joint_no'].$value['revision_category'].$value['revision']; ?></td>
                        <td><?php echo $class_list[$value['class']]; ?></td>
                        <td><?php echo $value['weld_length']; ?></td>
                        <td><?php echo $value['diameter']; ?></td>
                        <td><?php echo $value['thickness']; ?></td>
                        <td>
                          <?php 
                            if(isset($status_piecemark[$value['pos_1']]['id_mis'])){ 
                              echo $value['pos_1']; 
                            } 
                          ?>
                        </td>
                        <td>
                        <?php if(isset($status_piecemark[$value['pos_1']]['report_number']) AND $status_piecemark[$value['pos_1']]['status_inspection'] == 7){ ?>
                              <a href="<?php echo base_url(); ?>material_verification/material_verification_pdf_client/<?= $project_id_enc ?>/<?= $discipline_enc ?>/<?= $type_of_module_enc ?>/<?= $module_enc ?>/<?= $report_enc_mv_p1 ?>/<?= $report_no_rev_p1 ?>" target='_blank'><?php echo $report_no_mv[$value['project']][$value['discipline']][$value['type_of_module']]['mv_no']."-".$status_piecemark[$value['pos_1']]['report_number']; ?></a>
                          <?php } else { ?>
                              <?php if(isset($status_piecemark[$value['pos_1']]['report_number'])){ ?>
                              <?php echo $report_no_mv[$value['project']][$value['discipline']][$value['type_of_module']]['mv_no']."-".$status_piecemark[$value['pos_1']]['report_number']; ?>
                              <?php } else { ?>
                                -
                              <?php } ?>
                          <?php } ?>
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
                        <?php if(isset($status_piecemark[$value['pos_2']]['report_number']) AND $status_piecemark[$value['pos_2']]['status_inspection'] == 7){ ?>
                              <a href="<?php echo base_url(); ?>material_verification/material_verification_pdf_client/<?= $project_id_enc ?>/<?= $discipline_enc ?>/<?= $type_of_module_enc ?>/<?= $module_enc ?>/<?= $report_enc_mv_p2 ?>/<?= $report_no_rev_p2 ?>" target='_blank'><?php echo $report_no_mv[$value['project']][$value['discipline']][$value['type_of_module']]['mv_no']."-".$status_piecemark[$value['pos_2']]['report_number']; ?></a>
                          <?php } else { ?>
                              <?php if(isset($status_piecemark[$value['pos_2']]['report_number'])){ ?>
                                <?php echo $report_no_mv[$value['project']][$value['discipline']][$value['type_of_module']]['mv_no']."-".$status_piecemark[$value['pos_2']]['report_number']; ?>
                              <?php } else { ?>
                                -
                              <?php } ?>
                          <?php } ?>
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
                        <td>
                          <?php if(isset($value['fitup_report_no']) && $value['fitup_status_inspection'] == 7){ ?>
                            <a href="<?php echo base_url(); ?>fitup/pdf_files/<?= $project_id_enc ?>/<?= $discipline_enc ?>/<?= $module_enc ?>/<?= $type_of_module_enc ?>/<?= $report_fitup_enc ?>" target='_blank'><?php echo $report_no_fu[$value['project']][$value['discipline']][$value['type_of_module']]['fitup_report'].$value['fitup_report_no']; ?></a>
                          <?php } else { ?>
                            <?php if(isset($value['visual_report_no'])){ ?>
                            <?php echo $report_no_fu[$value['project']][$value['discipline']][$value['type_of_module']]['fitup_report'].$value['fitup_report_no']; ?>
                            <?php } else { ?>
                              -  
                            <?php } ?>
                          <?php } ?>
                        </td>
                        <td>
                          <?php if(isset($value['fitup_report_no']) && $value['fitup_status_inspection'] == 7){ ?>
                            <?php echo date("Y-m-d",strtotime($value['fitup_inspection_datetime'])); ?>
                          <?php } else { ?>
                              -
                          <?php } ?> 
                        </td>
                        <td>                          
                          <?php if(isset($value['fitup_report_no']) && $value['fitup_status_inspection'] == 7){ ?>
                              ACC
                          <?php } else { ?>
                              -
                          <?php } ?> 
                        </td>
                        
                        <td>
                          <?php    
                            $tack_weld_id = explode(";", $value['tack_weld_id']);                          
                            if(sizeof($tack_weld_id) > 0){ 
                              foreach ($tack_weld_id as $key => $tack_weld_id_name) {
                                if(isset($master_welder[$tack_weld_id_name]["rwe_code"])){ echo $master_welder[$tack_weld_id_name]["rwe_code"]."<br/>"; }
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
                                if(isset($wps_code_arr[$wps_id])){ echo $wps_code_arr[$wps_id]."<br/>"; }
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
                                if(isset($master_welder[$welder_id_rh]["rwe_code"])){ 
                                  echo $master_welder[$welder_id_rh]["rwe_code"]."<br/>";
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
                                if(isset($master_welder[$welder_id_fc]["rwe_code"])){ 
                                  echo $master_welder[$welder_id_fc]["rwe_code"]."<br/>";
                                }
                              }
                            } 
                          ?>
                        </td>

                        <td>
                          <?php if(isset($value['visual_report_no']) AND $value['visual_status_inspection'] == 7){  ?>
                            <a href="<?php echo base_url(); ?>visual/visual_pdf/<?= $value['visual_report_no'] ?>/client/<?= $drawing_no ?>/<?= $value["rev_postpone_visual"] ?>" target='_blank'><?php echo $report_no_vs[$value['project']][$value['discipline']][$value['type_of_module']]['visual_report'].$value['visual_report_no']; ?></a>
                          <?php } else { ?>
                            <?php if(isset($value['visual_report_no'])){ ?>
                            <?php echo $report_no_vs[$value['project']][$value['discipline']][$value['type_of_module']]['visual_report'].$value['visual_report_no']; ?>
                            <?php } else { ?>
                              -  
                            <?php } ?>
                          <?php } ?>
                        </td>
                        <td>
                          <?php if(isset($value['visual_report_no']) AND $value['visual_status_inspection'] == 7){  ?>
                             <?php echo date("Y-m-d",strtotime($value['visual_inspection_datetime'])); ?>
                          <?php } else { ?>
                            -
                          <?php } ?> 
                        </td>
                        <td>
                          <?php if(isset($value['visual_report_no']) AND $value['visual_status_inspection'] == 7){  ?>
                             ACC
                          <?php } else { ?>
                            -
                          <?php } ?>  
                        </td>

                        <td>
                          <?php
                            if(isset($ndt_all[$value['id_joint_visual']][2][$value['id_visual']])){
                              $total_arr[$key] = sizeof($ndt_all[$value['id_joint_visual']][2][$value['id_visual']]);
                            } else{
                              $total_arr[$key] = 0;
                            }

                            if(isset($ndt_all[$value['id_joint_visual']][2][$value['id_visual']])){
                              foreach($ndt_all[$value['id_joint_visual']][2][$value['id_visual']] as $key02 => $val02){
                          ?>       
                                <?php if(isset($val02['filename'])){  ?>
                                  <a href="<?= base_url() ?>/upload/ndt/<?= $val02['filename'] ?>" target='blank'><?= @$val02['report_number'] ?></a>
                                  <?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } else { ?> 
                                  <?= @$val02['report_number'] ?>
                                  <?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?> 
                                <?php } ?>
                          <?php        
                              }
                            } else { echo "-"; } 
                          ?> 
                        </td>
                        <td>
                          <?php
                            if(isset($ndt_all[$value['id_joint_visual']][2][$value['id_visual']])){
                              foreach($ndt_all[$value['id_joint_visual']][2][$value['id_visual']] as $key03 => $val03){
                          ?>       
                                <?php if(isset($val03['report_number'])){  ?>
                                    <?= DATE('d F, Y', strtotime($val03['date_of_inspection'])) ?> 
                                    <?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } else { ?> 
                                  - <?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } ?>
                          <?php        
                              }
                            } else { echo "-"; } 
                          ?> 
                        </td>
                        <td> 
                          <?php
                            if(isset($ndt_all[$value['id_joint_visual']][2][$value['id_visual']])){
                              foreach($ndt_all[$value['id_joint_visual']][2][$value['id_visual']] as $key04 => $val04){
                          ?>       
                                <?php if($val04['result']==3){  ?>
                                    <?= "ACC" ?><?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } else if($val04['result']==2){  ?>    
                                    <?= "REJECT" ?><?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } else { ?> 
                                  -<?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } ?> 
                          <?php        
                              }
                            } else { echo "-"; } 
                          ?>
 
                        </td>

                        <td>
                          <?php

                            if(isset($ndt_all[$value['id_joint_visual']][2][$value['id_visual']])){
                              $total_arr[$key] = sizeof($ndt_all[$value['id_joint_visual']][2][$value['id_visual']]);
                            } else{
                              $total_arr[$key] = 0;
                            }

                            if(isset($ndt_all[$value['id_joint_visual']][7][$value['id_visual']])){
                              foreach($ndt_all[$value['id_joint_visual']][7][$value['id_visual']] as $key02 => $val02){
                          ?>       
                                <?php if(isset($val02['filename'])){  ?>
                                  <a href="<?= base_url() ?>/upload/ndt/<?= $val02['filename'] ?>" target='blank'><?= @$val02['report_number'] ?></a>
                                  <?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } else { ?> 
                                  <?= @$val02['report_number'] ?>
                                  <?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?> 
                                <?php } ?>
                          <?php        
                              }
                            } else { echo "-"; } 
                          ?> 
                        </td>
                        <td>
                          <?php
                            if(isset($ndt_all[$value['id_joint_visual']][7][$value['id_visual']])){
                              foreach($ndt_all[$value['id_joint_visual']][7][$value['id_visual']] as $key03 => $val03){
                          ?>       
                                <?php if(isset($val03['report_number'])){  ?>
                                    <?= DATE('d F, Y', strtotime($val03['date_of_inspection'])) ?> 
                                    <?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } else { ?> 
                                  - <?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } ?>
                          <?php        
                              }
                            } else { echo "-"; } 
                          ?> 
                        </td>
                        <td> 
                          <?php
                            if(isset($ndt_all[$value['id_joint_visual']][7][$value['id_visual']])){
                              foreach($ndt_all[$value['id_joint_visual']][7][$value['id_visual']] as $key04 => $val04){
                          ?>       
                                <?php if($val04['result']==3){  ?>
                                    <?= "ACC" ?><?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } else if($val04['result']==2){  ?>    
                                    <?= "REJECT" ?><?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } else { ?> 
                                  -<?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } ?> 
                          <?php        
                              }
                            } else { echo "-"; } 
                          ?>
 
                        </td>

                        <td>
                          <?php

                            if(isset($ndt_all[$value['id_joint_visual']][2][$value['id_visual']])){
                              $total_arr[$key] = sizeof($ndt_all[$value['id_joint_visual']][2][$value['id_visual']]);
                            } else{
                              $total_arr[$key] = 0;
                            }

                            if(isset($ndt_all[$value['id_joint_visual']][3][$value['id_visual']])){
                              foreach($ndt_all[$value['id_joint_visual']][3][$value['id_visual']] as $key02 => $val02){
                          ?>       
                                <?php if(isset($val02['filename'])){  ?>
                                  <a href="<?= base_url() ?>/upload/ndt/<?= $val02['filename'] ?>" target='blank'><?= @$val02['report_number'] ?></a>
                                  <?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } else { ?> 
                                  <?= @$val02['report_number'] ?>
                                  <?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?> 
                                <?php } ?>
                          <?php        
                              }
                            } else { echo "-"; } 
                          ?> 
                        </td>
                        <td>
                          <?php
                            if(isset($ndt_all[$value['id_joint_visual']][3][$value['id_visual']])){
                              foreach($ndt_all[$value['id_joint_visual']][3][$value['id_visual']] as $key03 => $val03){
                          ?>       
                                <?php if(isset($val03['report_number'])){  ?>
                                    <?= DATE('d F, Y', strtotime($val03['date_of_inspection'])) ?> 
                                    <?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } else { ?> 
                                  - <?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } ?>
                          <?php        
                              }
                            } else { echo "-"; } 
                          ?> 
                        </td>
                        <td> 
                          <?php
                            if(isset($ndt_all[$value['id_joint_visual']][3][$value['id_visual']])){
                              foreach($ndt_all[$value['id_joint_visual']][3][$value['id_visual']] as $key04 => $val04){
                          ?>       
                                <?php if($val04['result']==3){  ?>
                                    <?= "ACC" ?><?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } else if($val04['result']==2){  ?>    
                                    <?= "REJECT" ?><?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } else { ?> 
                                  -<?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } ?> 
                          <?php        
                              }
                            } else { echo "-"; } 
                          ?>
 
                        </td>


                        <td>
                          <?php
                            if(isset($ndt_all[$value['id_joint_visual']][1][$value['id_visual']])){
                              foreach($ndt_all[$value['id_joint_visual']][1][$value['id_visual']] as $key02 => $val02){
                          ?>       
                                <?php if(isset($val02['filename'])){  ?>
                                  <a href="<?= base_url() ?>/upload/ndt/<?= $val02['filename'] ?>" target='blank'><?= @$val02['report_number'] ?></a>
                                  <?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } else { ?> 
                                  <?= @$val02['report_number'] ?>
                                  <?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?> 
                                <?php } ?>
                          <?php        
                              }
                            } else { echo "-"; } 
                          ?> 
                        </td>
                        <td>
                          <?php
                            if(isset($ndt_all[$value['id_joint_visual']][1][$value['id_visual']])){
                              foreach($ndt_all[$value['id_joint_visual']][1][$value['id_visual']] as $key03 => $val03){
                          ?>       
                                <?php if(isset($val03['report_number'])){  ?>
                                    <?= DATE('d F, Y', strtotime($val03['date_of_inspection'])) ?> 
                                    <?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } else { ?> 
                                  - <?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } ?>
                          <?php        
                              }
                            } else { echo "-"; } 
                          ?> 
                        </td>
                        <td> 
                          <?php
                            if(isset($ndt_all[$value['id_joint_visual']][1][$value['id_visual']])){
                              foreach($ndt_all[$value['id_joint_visual']][1][$value['id_visual']] as $key04 => $val04){
                          ?>       
                                <?php if($val04['result']==3){  ?>
                                    <?= "ACC" ?><?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } else if($val04['result']==2){  ?>    
                                    <?= "REJECT" ?><?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } else { ?> 
                                  -<?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } ?> 
                          <?php        
                              }
                            } else { echo "-"; } 
                          ?>
 
                        </td>

                        <td><?= @$value['irn_transmitted_no'] ?></td>
                        <td><?= @isset($value['irn_approval_by_client']) ? date("Y-m-d",strtotime($value['irn_approval_by_datetime'])) : null  ?></td>
                        <td><?= @isset($value['irn_approval_by_client']) ? 'ACC' : null ?></td>

                        <td><?php if(isset($status_piecemark[$value['pos_1']]['id_mis'])){ echo str_replace("\n","<br/>",$value["visual_remarks"]); } ?></td>

                    </tr>
                <?php } } ?>                
              </tbody>
            </table>
            <?php if(!isset($display_status)){ ?>
            <div style="page-break-inside: avoid !important;">
              <center>
              <table width="100%">
              <tbody>
                  <tr>
                    <td>NOTE:</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr style="margin-top: 0cm !important">
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr><tr>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td><b>_________________________</b></td>
                    <td><b>_________________________</b></td>
                    <td><b>_________________________</b></td>
                  </tr><tr>
                    <td style="border: none; padding-top: 10px;"><b>CONTRACTOR</b></td>
                    <td style="border: none; padding-top: 10px;"><b>EMPLOYER</b></td>
                    <td style="border: none; padding-top: 10px;"><b>THIRD PARTY (if any)</b></td>
                  </tr><tr>
                    <td style="border: none;">DATE : </td>
                    <td style="border: none;">DATE : </td>
                    <td style="border: none;">DATE : </td>
                  </tr>
              </tbody>
              </table>
              </center>
            </div>
          <?php } ?>
</body>
</html>