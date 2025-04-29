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

<div id="content" class="container-fluid">
  <div class="row">
    <?php 
      $d_link = "piping";
      $code_discipline = "PP";
   ?>

    <div class="col-md-12">
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0"><?php echo $meta_title ?></h6>
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
          <div class="container-fluid">
            <a href='<?php echo base_url(); ?>wtr/wtr_list/<?php echo $d_link; ?>' class='btn btn-warning'><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
            <a href='<?php echo base_url(); ?>wtr/wtr_piping_list_detail/<?= $drawing_no; ?>/<?= $module; ?>/<?= $discipline; ?>/xcl' class='btn btn-success'><i class="far fa-file-excel"></i> Excel</a>
            <a href='<?php echo base_url(); ?>wtr/wtr_piping_list_detail/<?= $drawing_no; ?>/<?= $module; ?>/<?= $discipline; ?>/pdf' target='_blank' class='btn btn-danger'><i class="fas fa-file-pdf"></i> PDF</a>
            <br/>
            <br/>
            <table class="dataTable wtr" width='100%'>
              <thead>
                <tr>
                  <th style="text-align: left;">PROJECT NAME</th>
                  <th>:</th>                 
                  <th colspan="68" style="text-align: left;"><?= $project_list[$list[0]['project']]['project_name'] ?></th>                 
                </tr>
                <tr>
                  <th style="text-align: left;">CLIENT</th>
                  <th>:</th>                 
                  <th colspan="68" style="text-align: left;"><?= strtoupper($project_list[$list[0]['project']]['client']) ?></th>                 
                </tr>
                <tr>
                  <th style="text-align: left;">MODULE</th>
                  <th>:</th>                 
                  <th colspan="68" style="text-align: left;"><?= $module_list[$module]['mod_desc'] ?></th>                 
                </tr>
                <tr>
                  <th style="text-align: left;">DRAWING NO</th>
                  <th>:</th>                 
                  <th colspan="68" style="text-align: left;"><?php echo $drawing_no; ?></th>                 
                </tr>
                <tr>
                  <th style="text-align: left;">REV</th>
                  <th>:</th>                 
                  <th colspan="68" style="text-align: left;">
                    <?= str_pad($drawing_detail['revision'],2,0,STR_PAD_LEFT) ?>
                  </th>         
                </tr>
                <tr>
                  <th style="text-align: left;">DESCRIPTION</th>
                  <th>:</th>                 
                  <th colspan="68" style="text-align: left; font-size: 13.5px;">
                    <?= strtoupper($drawing_detail['title']) ?>
                  </th>                
                </tr>
                
                <tr>
                  <!-- Engineering Data Status -->
             
                  <th rowspan="3">Drawing/Weld Map No</th>
                  <th rowspan="3">Rev No</th>
                  <th rowspan="3">Joint No</th>
                  <th rowspan="3">Type Of Weld</th>
                  <th rowspan="3">Spool No</th>
                  <th rowspan="3">Size</th>
                  <th rowspan="3">Thk (MM)</th>
                  <!-- <th rowspan="3">Class</th> -->
                  <th colspan="14">Material Traceability</th>
                  <th colspan="3" rowspan="2">Fitup</th>
                  <th rowspan="3">Fitter Code</th>
                  <th rowspan="3">Tack Weld ID</th>
                  <th rowspan="3">WPS No</th>
                  <th rowspan="3">Consumable / Lot no</th>
                  <th rowspan="3">Welded Date</th>
                  <th colspan="2" rowspan="2">Weld Process</th>
                  <th colspan="2" rowspan="2">Welder ID</th>
                  <th colspan="3">Non</th>
                  <th colspan="29">Non Destructive Examination</th>
                  <th colspan="3">Destructive Test</th>
                  <!-- <th colspan="3" rowspan="2">IRN to B&P</th> -->
                  <th rowspan="3">Remarks</th>
                  <th rowspan="3">Test Pack Number</th>
                  
                </tr>
                <tr>
                  <th colspan="7">Part 1</th>
                  <th colspan="7">Part 2</th>
                  
                  
                  <th colspan="3">Visual</th>
                  <th colspan="3">MPI</th>
                  <th colspan="3">PT</th>
                  <th colspan="3">UT</th>
                  <th colspan="3">RT</th>
                  <th colspan="3">PMI</th>
                  <th colspan="14">PWHT</th>
                  <th colspan="3">HER</th>
                </tr>
                <tr>
                  <th>Piece Mark</th>
                  <th>Item Code</th> <!-- NEW 7 DES -->
                  <th>Mtr No</th>
                  <th>Grade /Spec</th>
                  <th>Unique No</th>
                  <th>Heat No</th>
                  <th>SCH</th>

                  <th>Piece Mark</th>
                  <th>Item Code</th> <!-- NEW 7 DES -->
                  <th>Mtr No</th>
                  <th>Grade /Spec</th>
                  <th>Unique No</th>
                  <th>Heat No</th>
                  <th>SCH</th>

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

                  <!-- <th>Req (%)</th> -->
                  <th>Report</th>
                  <th>Date</th>
                  <th>Result</th>

                  <!-- <th>Req (%)</th> -->
                  <th>Report</th>
                  <th>Date</th>
                  <th>Result</th>

                  <!-- <th>Req (%)</th> -->
                  <th>Report</th>
                  <th>Date</th>
                  <th>Result</th>

                  <!-- <th>Req (%)</th> -->
                  <th>Report</th>
                  <th>Date</th>
                  <th>Result</th>

                  <th>Report</th>
                  <th>Date</th>
                  <th>Result</th>

                  <th>YES</th>
                  <th>NO</th>
                  <th>PWHT</th>
                  <th>Date</th>
                  <th>Result</th>
                  <th>MT APWHT</th>
                  <th>Date</th>
                  <th>Result</th>
                  <th>RT APWHT</th>
                  <th>Date</th>
                  <th>Result</th>
                  <th>UT APWHT</th>
                  <th>Date</th>
                  <th>Result</th>

                  <th>Report</th>
                  <th>Date</th>
                  <th>Result</th>
                  

                  <!-- <th>Report</th>
                  <th>Date</th>
                  <th>Result</th> -->
                  
                </tr>

              </thead>
              <tbody>
                <?php foreach ($list as $value) { ?>
                
                <tr>
                  <td><?php echo $value['drawing_wm']; ?></td>
                  <td><?php echo $value['rev_wm']; ?></td>
                  <td><?php echo $value['joint_no']; ?></td>
                  <td><?= $weld_type_desc[$value['weld_type']] ?></td>
                  <td><?= $value['spool_no'] ?></td>
                  <td><?= $value['diameter'] ?></td>

                  <td><?= $value['thickness'] ?></td>

                  <!-- PART 1 -->
                  <td><?= isset($verif[$pmark[$value['pos_1']]['id']]['report_number']) ? $value['pos_1'] : '-'?></td>
                  <td><?= isset($verif[$pmark[$value['pos_1']]['id']]['report_number']) ? $material_pp[$material[$mis[$verif[$pmark[$value['pos_1']]['id']]['id_mis']]['unique_no']]['catalog_id']]['code_material'] : '-'?></td>
                  <td><?= isset($verif[$pmark[$value['pos_1']]['id']]['report_number']) ? $verif[$pmark[$value['pos_1']]['id']]['report_number'] : '-'?></td>
                  <td><?= isset($verif[$pmark[$value['pos_1']]['id']]['report_number']) ? $material_grade[$material_pp[$material[$mis[$verif[$pmark[$value['pos_1']]['id']]['id_mis']]['unique_no']]['catalog_id']]['material_grade']]['material_grade'] : '-'?></td>
                  <td><?= isset($verif[$pmark[$value['pos_1']]['id']]['report_number']) ? $mis[$verif[$pmark[$value['pos_1']]['id']]['id_mis']]['unique_no'] : '-'?></td>
                  <td><?= isset($verif[$pmark[$value['pos_1']]['id']]['report_number']) ? $material[$mis[$verif[$pmark[$value['pos_1']]['id']]['id_mis']]['unique_no']]['heat_or_series_no'] : '-'?></td>
                  <td><?= isset($verif[$pmark[$value['pos_1']]['id']]['report_number']) ? $pmark[$value['pos_1']]['thickness'] : '-'?></td>

                  <!-- PART 2 -->
                  <td><?= isset($verif[$pmark[$value['pos_2']]['id']]['report_number']) ? $value['pos_2'] : '-'?></td>
                  <td><?= isset($verif[$pmark[$value['pos_2']]['id']]['report_number']) ? $material_pp[$material[$mis[$verif[$pmark[$value['pos_2']]['id']]['id_mis']]['unique_no']]['catalog_id']]['code_material'] : '-'?></td>
                  <td><?= isset($verif[$pmark[$value['pos_2']]['id']]['report_number']) ? $verif[$pmark[$value['pos_2']]['id']]['report_number'] : '-'?></td>
                  <td><?= isset($verif[$pmark[$value['pos_2']]['id']]['report_number']) ? $material_grade[$material_pp[$material[$mis[$verif[$pmark[$value['pos_2']]['id']]['id_mis']]['unique_no']]['catalog_id']]['material_grade']]['material_grade'] : '-'?></td>
                  <td><?= isset($verif[$pmark[$value['pos_2']]['id']]['report_number']) ? $mis[$verif[$pmark[$value['pos_2']]['id']]['id_mis']]['unique_no'] : '-'?></td>
                  <td><?= isset($verif[$pmark[$value['pos_2']]['id']]['report_number']) ? $material[$mis[$verif[$pmark[$value['pos_2']]['id']]['id_mis']]['unique_no']]['heat_or_series_no'] : '-'?></td>
                  <td><?= isset($verif[$pmark[$value['pos_2']]['id']]['report_number']) ? $pmark[$value['pos_2']]['thickness'] : '-'?></td>

                  <td><?= isset($fitup[$value['id']]['report_number']) ? $fitup[$value['id']]['report_number'] : '-' ?></td>
                  <td><?= isset($fitup[$value['id']]['report_number']) ? $fitup[$value['id']]['date_request'] : '-' ?></td>
                  <td><?= $fitup[$value['id']]['status_inspection']==2 ? 'REJECT' : (in_array($fitup[$value['id']]['status_inspection'], [3,4,5,6,7,8]) ? 'ACC' : '-') ?></td>

                  <td>
                    <?php 
                      $ftr = explode(';', $fitup[$value['id']]['fitter_id']);
                      if(isset($fitup[$value['id']]['report_number'])){
                        foreach ($ftr as $ftr) {
                           echo $fitter[$ftr]['fit_up_badge'].'<br>';
                         } 
                      } else {
                        echo "-";
                      }
                    ?>
                  </td>

                  <td>
                    <?php 
                      if(isset($fitup[$value['id']]['report_number'])){
                        $tack_weld_id = explode(';', $fitup[$value['id']]['tack_weld_id']);
                        foreach ($tack_weld_id as $tack_weld_id) {
                           echo $welder[$tack_weld_id]['wel_code'].'<br>';
                         } 
                      } else {
                        echo "-";
                      }
                    ?>
                  </td>
                  
                  <td>
                    <?php 
                    if(isset($fitup[$value['id']]['report_number'])){
                      $wps_no = explode(';', $fitup[$value['id']]['wps_no']);
                      foreach ($wps_no as $wps_no) {
                        echo $wps[$wps_no]['wps_code'].'<br>';
                      } 
                    } else {
                      echo "-";
                    }
                    ?>
                  </td>

                  <td><?= isset($visual[$value['id']]['cons_lot_no']) ? $visual[$value['id']]['cons_lot_no'] : '-' ?></td>

                  <td><?= $visual[$value['id']]['weld_datetime']>0 ? DATE('d F, Y H:i:s', strtotime($visual[$value['id']]['weld_datetime'])) : '-' ?></td>

                  <td>
                      <?= $visual[$value['id']]['process_gtaw_rh'] == 1 ? 'GTAW<br>' : ''; ?>
                      <?= $visual[$value['id']]['process_gmaw_rh'] == 1 ? 'GMAW<br>' : ''; ?>
                      <?= $visual[$value['id']]['process_smaw_rh'] == 1 ? 'SMAW<br>' : ''; ?>
                      <?= $visual[$value['id']]['process_fcaw_rh'] == 1 ? 'FCAW<br>' : ''; ?>
                      <?= $visual[$value['id']]['process_saw_rh'] == 1 ? 'SAW<br>' : ''; ?>
                  </td>

                  <td>
                    <?= $visual[$value['id']]['process_gtaw_fc'] == 1 ? 'GTAW<br>' : ''; ?>
                    <?= $visual[$value['id']]['process_gmaw_fc'] == 1 ? 'GMAW<br>' : ''; ?>
                    <?= $visual[$value['id']]['process_smaw_fc'] == 1 ? 'SMAW<br>' : ''; ?>
                    <?= $visual[$value['id']]['process_fcaw_fc'] == 1 ? 'FCAW<br>' : ''; ?>
                    <?= $visual[$value['id']]['process_saw_fc'] == 1 ? 'SAW<br>' : ''; ?>
                  </td>

                  <td>
                    <?php
                      if(isset($fitup[$value['id']]['report_number'])){
                        $welder_ref_rh = explode(';', $visual[$value['id']]['welder_ref_rh']);
                        foreach ($welder_ref_rh as $welder_ref_rh) {
                          echo $welder[$welder_ref_rh]['wel_code'].'<br>';
                        } 
                      } else {
                        echo "-";
                      }
                    ?>
                  </td>

                  <td>
                    <?php
                      if(isset($fitup[$value['id']]['report_number'])){
                        $welder_ref_fc = explode(';', $visual[$value['id']]['welder_ref_fc']);
                        foreach ($welder_ref_fc as $welder_ref_fc) {
                          echo $welder[$welder_ref_fc]['wel_code'].'<br>';
                        }
                      } else {
                        echo "-";
                      } 
                    ?>
                  </td>

                  <td><?= isset($visual[$value['id']]['report_number']) ? $visual[$value['id']]['report_number'] : '-' ?></td>
                  <td><?= isset($visual[$value['id']]['report_number']) ? $visual[$value['id']]['date_request'] : '-'?></td>
                  <td><?= $visual[$value['id']]['status_inspection']==2 ? 'REJECT' : (in_array($visual[$value['id']]['status_inspection'], [3,4,5,6,7,8]) ? 'ACC' : '-') ?></td>

                  <!-- MT -->
                  <td><?= $ndt[$visual[$value['id']]['id_visual']][2]['report_number'] ?></td>
                  <td><?= $ndt[$visual[$value['id']]['id_visual']][2]['date_of_inspection']>0 ? DATE('d F, Y', strtotime($ndt[$visual[$value['id']]['id_visual']][2]['date_of_inspection'])) : '' ?></td>
                  <td><?= $ndt[$visual[$value['id']]['id_visual']][2]['result']==3 ? 'ACC' : ($ndt[$visual[$value['id']]['id_visual']][2]['result']==2 ? 'REJECT' : '-') ?></td>

                  <!-- PT -->
                  <td><?= $ndt[$visual[$value['id']]['id_visual']][7]['report_number'] ?></td>
                  <td><?= $ndt[$visual[$value['id']]['id_visual']][7]['date_of_inspection']>0 ? DATE('d F, Y', strtotime($ndt[$visual[$value['id']]['id_visual']][7]['date_of_inspection'])) : '' ?></td>
                  <td><?= $ndt[$visual[$value['id']]['id_visual']][7]['result']==3 ? 'ACC' : ($ndt[$visual[$value['id']]['id_visual']][7]['result']==2 ? 'REJECT' : '-') ?></td>

                  <!-- RT -->
                  <td><?= $ndt[$visual[$value['id']]['id_visual']][1]['report_number'] ?></td>
                  <td><?= $ndt[$visual[$value['id']]['id_visual']][1]['date_of_inspection']>0 ? DATE('d F, Y', strtotime($ndt[$visual[$value['id']]['id_visual']][1]['date_of_inspection'])) : '' ?></td>
                  <td><?= $ndt[$visual[$value['id']]['id_visual']][1]['result']==3 ? 'ACC' : ($ndt[$visual[$value['id']]['id_visual']][1]['result']==2 ? 'REJECT' : '-') ?></td>

                  <!-- UT -->
                  <td><?= $ndt[$visual[$value['id']]['id_visual']][3]['report_number'] ?></td>
                  <td><?= $ndt[$visual[$value['id']]['id_visual']][3]['date_of_inspection']>0 ? DATE('d F, Y', strtotime($ndt[$visual[$value['id']]['id_visual']][3]['date_of_inspection'])) : '' ?></td>
                  <td><?= $ndt[$visual[$value['id']]['id_visual']][3]['result']==3 ? 'ACC' : ($ndt[$visual[$value['id']]['id_visual']][3]['result']==2 ? 'REJECT' : '-') ?></td>

                  <!-- PMI -->
                  <td><?= $ndt[$visual[$value['id']]['id_visual']][8]['report_number'] ?></td>
                  <td><?= $ndt[$visual[$value['id']]['id_visual']][8]['date_of_inspection']>0 ? DATE('d F, Y', strtotime($ndt[$visual[$value['id']]['id_visual']][8]['date_of_inspection'])) : '' ?></td>
                  <td><?= $ndt[$visual[$value['id']]['id_visual']][8]['result']==3 ? 'ACC' : ($ndt[$visual[$value['id']]['id_visual']][8]['result']==2 ? 'REJECT' : '-') ?></td>

                  <td><?= $visual[$value['id']]['ndt_pwht']>0 ? 'YES' : '' ?></td>
                  <td><?= (isset($visual[$value['id']]['ndt_pwht']) AND isset($visual[$value['id']]['ndt_pwht'])) ? 'NO' : '' ?></td>

                  <td><?= $ndt[$visual[$value['id']]['id_visual']][9]['report_number'] ?></td>
                  <td><?= $ndt[$visual[$value['id']]['id_visual']][9]['date_of_inspection']>0 ? DATE('d F, Y', strtotime($ndt[$visual[$value['id']]['id_visual']][9]['date_of_inspection'])) : '' ?></td>
                  <td><?= $ndt[$visual[$value['id']]['id_visual']][9]['result']==3 ? 'ACC' : ($ndt[$visual[$value['id']]['id_visual']][9]['result']==2 ? 'REJECT' : '-') ?></td>

                  <!-- MT APWHT -->
                  <td><?= $ndt_apwht[$visual[$value['id']]['id_visual']][2]['report_number'] ?></td>
                  <td><?= $ndt_apwht[$visual[$value['id']]['id_visual']][2]['date_of_inspection']>0 ? DATE('d F, Y', strtotime($ndt_apwht[$visual[$value['id']]['id_visual']][2]['date_of_inspection'])) : '' ?></td>
                  <td><?= $ndt_apwht[$visual[$value['id']]['id_visual']][2]['result']==3 ? 'ACC' : ($ndt_apwht[$visual[$value['id']]['id_visual']][2]['result']==2 ? 'REJECT' : '-') ?></td>

                  <!-- RT APWHT -->
                  <td><?= $ndt_apwht[$visual[$value['id']]['id_visual']][1]['report_number'] ?></td>
                  <td><?= $ndt_apwht[$visual[$value['id']]['id_visual']][1]['date_of_inspection']>0 ? DATE('d F, Y', strtotime($ndt_apwht[$visual[$value['id']]['id_visual']][1]['date_of_inspection'])) : '' ?></td>
                  <td><?= $ndt_apwht[$visual[$value['id']]['id_visual']][1]['result']==3 ? 'ACC' : ($ndt_apwht[$visual[$value['id']]['id_visual']][1]['result']==2 ? 'REJECT' : '-') ?></td>

                  <!-- UT APWHT -->
                  <td><?= $ndt_apwht[$visual[$value['id']]['id_visual']][3]['report_number'] ?></td>
                  <td><?= $ndt_apwht[$visual[$value['id']]['id_visual']][3]['date_of_inspection']>0 ? DATE('d F, Y', strtotime($ndt_apwht[$visual[$value['id']]['id_visual']][3]['date_of_inspection'])) : '' ?></td>
                  <td><?= $ndt_apwht[$visual[$value['id']]['id_visual']][3]['result']==3 ? 'ACC' : ($ndt_apwht[$visual[$value['id']]['id_visual']][3]['result']==2 ? 'REJECT' : '-') ?></td>

                  <!-- HT -->
                  <td><?= $ndt[$visual[$value['id']]['id_visual']][5]['report_number'] ?></td>
                  <td><?= $ndt[$visual[$value['id']]['id_visual']][5]['date_of_inspection']>0 ? DATE('d F, Y', strtotime($ndt[$visual[$value['id']]['id_visual']][5]['date_of_inspection'])) : '' ?></td>
                  <td><?= $ndt[$visual[$value['id']]['id_visual']][5]['result']==3 ? 'ACC' : ($ndt[$visual[$value['id']]['id_visual']][5]['result']==2 ? 'REJECT' : '-') ?></td>

                  <td></td>
                  <td><?php echo $value['test_pack_no']; ?></td>

                </tr>
              <?php } ?>

              <?php foreach ($list_reject as $value_reject) { ?>
                
                <tr>
                  <td><?php echo $value_reject['drawing_wm']; ?></td>
                  <td><?php echo $value_reject['rev_wm']; ?></td>
                  <td><?php echo $value_reject['joint_no'].'('.$value_reject['revision_category'].$value_reject['revision'].')'; ?></td>
                  <td><?= $weld_type_desc[$value_reject['weld_type']] ?></td>
                  <td><?= $value_reject['spool_no'] ?></td>
                  <td><?= $value_reject['diameter'] ?></td>

                  <td><?= $value_reject['thickness'] ?></td>

                  <!-- PART 1 -->
                  <td><?= isset($verif[$pmark[$value_reject['pos_1']]['id']]['report_number']) ? $value_reject['pos_1'] : '-'?></td>
                  <td><?= isset($verif[$pmark[$value_reject['pos_1']]['id']]['report_number']) ? $material_pp[$material[$mis[$verif[$pmark[$value_reject['pos_1']]['id']]['id_mis']]['unique_no']]['catalog_id']]['code_material'] : '-'?></td>
                  <td><?= isset($verif[$pmark[$value_reject['pos_1']]['id']]['report_number']) ? $verif[$pmark[$value_reject['pos_1']]['id']]['report_number'] : '-'?></td>
                  <td><?= isset($verif[$pmark[$value_reject['pos_1']]['id']]['report_number']) ? $material_grade[$material_pp[$material[$mis[$verif[$pmark[$value_reject['pos_1']]['id']]['id_mis']]['unique_no']]['catalog_id']]['material_grade']]['material_grade'] : '-'?></td>
                  <td><?= isset($verif[$pmark[$value_reject['pos_1']]['id']]['report_number']) ? $mis[$verif[$pmark[$value_reject['pos_1']]['id']]['id_mis']]['unique_no'] : '-'?></td>
                  <td><?= isset($verif[$pmark[$value_reject['pos_1']]['id']]['report_number']) ? $material[$mis[$verif[$pmark[$value_reject['pos_1']]['id']]['id_mis']]['unique_no']]['heat_or_series_no'] : '-'?></td>
                  <td><?= isset($verif[$pmark[$value_reject['pos_1']]['id']]['report_number']) ? $pmark[$value_reject['pos_1']]['thickness'] : '-'?></td>

                  <!-- PART 2 -->
                  <td><?= isset($verif[$pmark[$value_reject['pos_2']]['id']]['report_number']) ? $value_reject['pos_2'] : '-'?></td>
                  <td><?= isset($verif[$pmark[$value_reject['pos_2']]['id']]['report_number']) ? $material_pp[$material[$mis[$verif[$pmark[$value_reject['pos_2']]['id']]['id_mis']]['unique_no']]['catalog_id']]['code_material'] : '-'?></td>
                  <td><?= isset($verif[$pmark[$value_reject['pos_2']]['id']]['report_number']) ? $verif[$pmark[$value_reject['pos_2']]['id']]['report_number'] : '-'?></td>
                  <td><?= isset($verif[$pmark[$value_reject['pos_2']]['id']]['report_number']) ? $material_grade[$material_pp[$material[$mis[$verif[$pmark[$value_reject['pos_2']]['id']]['id_mis']]['unique_no']]['catalog_id']]['material_grade']]['material_grade'] : '-'?></td>
                  <td><?= isset($verif[$pmark[$value_reject['pos_2']]['id']]['report_number']) ? $mis[$verif[$pmark[$value_reject['pos_2']]['id']]['id_mis']]['unique_no'] : '-'?></td>
                  <td><?= isset($verif[$pmark[$value_reject['pos_2']]['id']]['report_number']) ? $material[$mis[$verif[$pmark[$value_reject['pos_2']]['id']]['id_mis']]['unique_no']]['heat_or_series_no'] : '-'?></td>
                  <td><?= isset($verif[$pmark[$value_reject['pos_2']]['id']]['report_number']) ? $pmark[$value_reject['pos_2']]['thickness'] : '-'?></td>

                  <td><?= isset($fitup[$value_reject['id']]['report_number']) ? $fitup[$value_reject['id']]['report_number'] : '-' ?></td>
                  <td><?= isset($fitup[$value_reject['id']]['report_number']) ? $fitup[$value_reject['id']]['date_request'] : '-' ?></td>
                  <td><?= $fitup[$value_reject['id']]['status_inspection']==2 ? 'REJECT' : (in_array($fitup[$value_reject['id']]['status_inspection'], [3,4,5,6,7,8]) ? 'ACC' : '-') ?></td>

                  <td>
                    <?php 
                      $ftr = explode(';', $fitup[$value_reject['id']]['fitter_id']);
                      if(isset($fitup[$value_reject['id']]['report_number'])){
                        foreach ($ftr as $ftr) {
                           echo $fitter[$ftr]['fit_up_badge'].'<br>';
                         } 
                      } else {
                        echo "-";
                      }
                    ?>
                  </td>

                  <td>
                    <?php 
                      if(isset($fitup[$value_reject['id']]['report_number'])){
                        $tack_weld_id = explode(';', $fitup[$value_reject['id']]['tack_weld_id']);
                        foreach ($tack_weld_id as $tack_weld_id) {
                           echo $welder[$tack_weld_id]['wel_code'].'<br>';
                         } 
                      } else {
                        echo "-";
                      }
                    ?>
                  </td>
                  
                  <td>
                    <?php 
                    if(isset($fitup[$value_reject['id']]['report_number'])){
                      $wps_no = explode(';', $fitup[$value_reject['id']]['wps_no']);
                      foreach ($wps_no as $wps_no) {
                        echo $wps[$wps_no]['wps_code'].'<br>';
                      } 
                    } else {
                      echo "-";
                    }
                    ?>
                  </td>

                  <td><?= isset($visual[$value_reject['id']]['cons_lot_no']) ? $visual[$value_reject['id']]['cons_lot_no'] : '-' ?></td>

                  <td><?= $visual[$value_reject['id']]['weld_datetime']>0 ? DATE('d F, Y H:i:s', strtotime($visual[$value_reject['id']]['weld_datetime'])) : '-' ?></td>

                  <td>
                      <?= $visual[$value_reject['id']]['process_gtaw_rh'] == 1 ? 'GTAW<br>' : ''; ?>
                      <?= $visual[$value_reject['id']]['process_gmaw_rh'] == 1 ? 'GMAW<br>' : ''; ?>
                      <?= $visual[$value_reject['id']]['process_smaw_rh'] == 1 ? 'SMAW<br>' : ''; ?>
                      <?= $visual[$value_reject['id']]['process_fcaw_rh'] == 1 ? 'FCAW<br>' : ''; ?>
                      <?= $visual[$value_reject['id']]['process_saw_rh'] == 1 ? 'SAW<br>' : ''; ?>
                  </td>

                  <td>
                    <?= $visual[$value_reject['id']]['process_gtaw_fc'] == 1 ? 'GTAW<br>' : ''; ?>
                    <?= $visual[$value_reject['id']]['process_gmaw_fc'] == 1 ? 'GMAW<br>' : ''; ?>
                    <?= $visual[$value_reject['id']]['process_smaw_fc'] == 1 ? 'SMAW<br>' : ''; ?>
                    <?= $visual[$value_reject['id']]['process_fcaw_fc'] == 1 ? 'FCAW<br>' : ''; ?>
                    <?= $visual[$value_reject['id']]['process_saw_fc'] == 1 ? 'SAW<br>' : ''; ?>
                  </td>

                  <td>
                    <?php
                      if(isset($fitup[$value_reject['id']]['report_number'])){
                        $welder_ref_rh = explode(';', $visual[$value_reject['id']]['welder_ref_rh']);
                        foreach ($welder_ref_rh as $welder_ref_rh) {
                          echo $welder[$welder_ref_rh]['wel_code'].'<br>';
                        } 
                      } else {
                        echo "-";
                      }
                    ?>
                  </td>

                  <td>
                    <?php
                      if(isset($fitup[$value_reject['id']]['report_number'])){
                        $welder_ref_fc = explode(';', $visual[$value_reject['id']]['welder_ref_fc']);
                        foreach ($welder_ref_fc as $welder_ref_fc) {
                          echo $welder[$welder_ref_fc]['wel_code'].'<br>';
                        }
                      } else {
                        echo "-";
                      } 
                    ?>
                  </td>

                  <td><?= isset($visual[$value_reject['id']]['report_number']) ? $visual[$value_reject['id']]['report_number'] : '-' ?></td>
                  <td><?= isset($visual[$value_reject['id']]['report_number']) ? $visual[$value_reject['id']]['date_request'] : '-'?></td>
                  <td><?= $visual[$value_reject['id']]['status_inspection']==2 ? 'REJECT' : (in_array($visual[$value_reject['id']]['status_inspection'], [3,4,5,6,7,8]) ? 'ACC' : '-') ?></td>

                  <!-- MT -->
                  <td><?= $ndt[$visual[$value_reject['id']]['id_visual']][2]['report_number'] ?></td>
                  <td><?= $ndt[$visual[$value_reject['id']]['id_visual']][2]['date_of_inspection']>0 ? DATE('d F, Y', strtotime($ndt[$visual[$value_reject['id']]['id_visual']][2]['date_of_inspection'])) : '' ?></td>
                  <td><?= $ndt[$visual[$value_reject['id']]['id_visual']][2]['result']==3 ? 'ACC' : ($ndt[$visual[$value_reject['id']]['id_visual']][2]['result']==2 ? 'REJECT' : '-') ?></td>

                  <!-- PT -->
                  <td><?= $ndt[$visual[$value_reject['id']]['id_visual']][7]['report_number'] ?></td>
                  <td><?= $ndt[$visual[$value_reject['id']]['id_visual']][7]['date_of_inspection']>0 ? DATE('d F, Y', strtotime($ndt[$visual[$value_reject['id']]['id_visual']][7]['date_of_inspection'])) : '' ?></td>
                  <td><?= $ndt[$visual[$value_reject['id']]['id_visual']][7]['result']==3 ? 'ACC' : ($ndt[$visual[$value_reject['id']]['id_visual']][7]['result']==2 ? 'REJECT' : '-') ?></td>

                  <!-- RT -->
                  <td><?= $ndt[$visual[$value_reject['id']]['id_visual']][1]['report_number'] ?></td>
                  <td><?= $ndt[$visual[$value_reject['id']]['id_visual']][1]['date_of_inspection']>0 ? DATE('d F, Y', strtotime($ndt[$visual[$value_reject['id']]['id_visual']][1]['date_of_inspection'])) : '' ?></td>
                  <td><?= $ndt[$visual[$value_reject['id']]['id_visual']][1]['result']==3 ? 'ACC' : ($ndt[$visual[$value_reject['id']]['id_visual']][1]['result']==2 ? 'REJECT' : '-') ?></td>

                  <!-- UT -->
                  <td><?= $ndt[$visual[$value_reject['id']]['id_visual']][3]['report_number'] ?></td>
                  <td><?= $ndt[$visual[$value_reject['id']]['id_visual']][3]['date_of_inspection']>0 ? DATE('d F, Y', strtotime($ndt[$visual[$value_reject['id']]['id_visual']][3]['date_of_inspection'])) : '' ?></td>
                  <td><?= $ndt[$visual[$value_reject['id']]['id_visual']][3]['result']==3 ? 'ACC' : ($ndt[$visual[$value_reject['id']]['id_visual']][3]['result']==2 ? 'REJECT' : '-') ?></td>

                  <!-- PMI -->
                  <td><?= $ndt[$visual[$value_reject['id']]['id_visual']][8]['report_number'] ?></td>
                  <td><?= $ndt[$visual[$value_reject['id']]['id_visual']][8]['date_of_inspection']>0 ? DATE('d F, Y', strtotime($ndt[$visual[$value_reject['id']]['id_visual']][8]['date_of_inspection'])) : '' ?></td>
                  <td><?= $ndt[$visual[$value_reject['id']]['id_visual']][8]['result']==3 ? 'ACC' : ($ndt[$visual[$value_reject['id']]['id_visual']][8]['result']==2 ? 'REJECT' : '-') ?></td>

                  <td><?= $visual[$value_reject['id']]['ndt_pwht']>0 ? 'YES' : '' ?></td>
                  <td><?= (isset($visual[$value_reject['id']]['ndt_pwht']) AND isset($visual[$value_reject['id']]['ndt_pwht'])) ? 'NO' : '' ?></td>

                  <td><?= $ndt[$visual[$value_reject['id']]['id_visual']][9]['report_number'] ?></td>
                  <td><?= $ndt[$visual[$value_reject['id']]['id_visual']][9]['date_of_inspection']>0 ? DATE('d F, Y', strtotime($ndt[$visual[$value_reject['id']]['id_visual']][9]['date_of_inspection'])) : '' ?></td>
                  <td><?= $ndt[$visual[$value_reject['id']]['id_visual']][9]['result']==3 ? 'ACC' : ($ndt[$visual[$value_reject['id']]['id_visual']][9]['result']==2 ? 'REJECT' : '-') ?></td>

                  <!-- MT APWHT -->
                  <td><?= $ndt_apwht[$visual[$value_reject['id']]['id_visual']][2]['report_number'] ?></td>
                  <td><?= $ndt_apwht[$visual[$value_reject['id']]['id_visual']][2]['date_of_inspection']>0 ? DATE('d F, Y', strtotime($ndt_apwht[$visual[$value_reject['id']]['id_visual']][2]['date_of_inspection'])) : '' ?></td>
                  <td><?= $ndt_apwht[$visual[$value_reject['id']]['id_visual']][2]['result']==3 ? 'ACC' : ($ndt_apwht[$visual[$value_reject['id']]['id_visual']][2]['result']==2 ? 'REJECT' : '-') ?></td>

                  <!-- RT APWHT -->
                  <td><?= $ndt_apwht[$visual[$value_reject['id']]['id_visual']][1]['report_number'] ?></td>
                  <td><?= $ndt_apwht[$visual[$value_reject['id']]['id_visual']][1]['date_of_inspection']>0 ? DATE('d F, Y', strtotime($ndt_apwht[$visual[$value_reject['id']]['id_visual']][1]['date_of_inspection'])) : '' ?></td>
                  <td><?= $ndt_apwht[$visual[$value_reject['id']]['id_visual']][1]['result']==3 ? 'ACC' : ($ndt_apwht[$visual[$value_reject['id']]['id_visual']][1]['result']==2 ? 'REJECT' : '-') ?></td>

                  <!-- UT APWHT -->
                  <td><?= $ndt_apwht[$visual[$value_reject['id']]['id_visual']][3]['report_number'] ?></td>
                  <td><?= $ndt_apwht[$visual[$value_reject['id']]['id_visual']][3]['date_of_inspection']>0 ? DATE('d F, Y', strtotime($ndt_apwht[$visual[$value_reject['id']]['id_visual']][3]['date_of_inspection'])) : '' ?></td>
                  <td><?= $ndt_apwht[$visual[$value_reject['id']]['id_visual']][3]['result']==3 ? 'ACC' : ($ndt_apwht[$visual[$value_reject['id']]['id_visual']][3]['result']==2 ? 'REJECT' : '-') ?></td>

                  <!-- HT -->
                  <td><?= $ndt[$visual[$value_reject['id']]['id_visual']][5]['report_number'] ?></td>
                  <td><?= $ndt[$visual[$value_reject['id']]['id_visual']][5]['date_of_inspection']>0 ? DATE('d F, Y', strtotime($ndt[$visual[$value_reject['id']]['id_visual']][5]['date_of_inspection'])) : '' ?></td>
                  <td><?= $ndt[$visual[$value_reject['id']]['id_visual']][5]['result']==3 ? 'ACC' : ($ndt[$visual[$value_reject['id']]['id_visual']][5]['result']==2 ? 'REJECT' : '-') ?></td>

                  <td></td>
                  <td><?php echo $value_reject['test_pack_no']; ?></td>

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
            leftColumns: 7
        },
    "order": [[2, 'asc']]

  });

  </script>