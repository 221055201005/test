  <style type="text/css">
    .wtr {
      font-family: Arial, Helvetica, sans-serif;
      font-size: 5pt;
      border-collapse: collapse;
      width: 100%;
    }

    .wtr td, .wtr th {
      border: 0.10px solid #000000;
      word-wrap: break-word;
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

    .body {
      margin-top: 3cm;
      margin-left: 1cm;
      margin-right: 1cm;
      margin-bottom: 3cm;
      font-family: "helvetica";
      font-size: 38% !important;
    }
  </style>

<div class="body">
    <table width='100%' border="">
    <?php 
      $img_base64_encoded = $project_list[$list[0]['project']]['client_logo'];
      $imageContent       = file_get_contents($img_base64_encoded);
      $path               = tempnam(sys_get_temp_dir(), 'prefix');
      file_put_contents ($path, $imageContent);
    ?>
    <tr>
      <td rowspan="2" style="text-align: left;">
        <img src="<?php echo $path; ?>" style="width: 80px !important"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </td>
      <td style="text-align: center; font-weight: bold; font-size: 12pt; margin-bottom: 100pt"><?= strtoupper($project_list[$list[0]['project']]['description']) ?></td>
      <td rowspan="2" style="text-align: right;">
        <img src="<?php echo base_url('img/sembcorp-logo.png'); ?>" style="width: 80px !important"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </td>
    </tr>
    <tr>
      <td style="text-align: center; font-weight: bold; font-size: 11pt">MATERIAL & WELDING TRACEABILITY RECORD - PIPING</td>
    </tr>
    <tr style="font-size: 7px">
      <td style="width: 100px"><b>PROJECT NAME</b></td>
      <td style="width: 10px"><b>:</b></td>
      <td><b><?= $project_list[$list[0]['project']]['project_name'] ?></b></td>
    </tr>
    <tr style="font-size: 7px">
      <td><b>CLIENT</b></td>
      <td><b>:</b></td>
      <td><b><?= strtoupper($project_list[$list[0]['project']]['client']) ?></b></td>
    </tr>
    <tr style="font-size: 7px">
      <td><b>MODULE</b></td>
      <td><b>:</b></td>
      <td><b><?= $module_list[$list[0]['module']]['mod_desc'] ?></b></td>
    </tr>
    <tr style="font-size: 7px">
      <td><b>DRAWING NO</b></td>
      <td><b>:</b></td>
      <td><b><?= $list[0]['drawing_no'] ?></b></td>
    </tr>
    <tr style="font-size: 7px">
      <td><b>REV</b></td>
      <td><b>:</b></td>
      <td><b><?= str_pad($drawing_detail['revision'],2,0,STR_PAD_LEFT) ?></b></td>
    </tr>
    <tr style="font-size: 7px">
      <td><b>DESCRIPTION</b></td>
      <td><b>:</b></td>
      <td><b><?= strtoupper($drawing_detail['title']) ?></b></td>
    </tr>
   </table>
  <table width='100%' cellspacing="0" cellpadding="1" class="table" style="width: 1135px">
    <thead>
      <tr class="wtrthe">
        <th rowspan="3" style="width: 37pt;">Drawing/Weld Map No</th>
        <th rowspan="3" style="width: 15pt">Rev No</th>
        <th rowspan="3" style="width: 20pt">Joint No</th>
        <th rowspan="3" style="width: 18pt">Type Of Weld</th>
        <th rowspan="3" style="width: 25pt">Spool No</th>
        <th rowspan="3">Size</th>
        <th rowspan="3">Thk (MM)</th>
        <th colspan="6">Material Traceability</th>
        <th colspan="2" rowspan="2">Fitup</th>
        <th rowspan="3">WPS No</th>
        <th colspan="2" rowspan="2">Welder ID</th>
        <th colspan="3">Non</th>
        <th colspan="29">Non Destructive Examination</th>
        <th colspan="3">Destructive Test</th>
        <th rowspan="3">Remarks</th>
        <th rowspan="3">Test Pack Number</th>
      </tr>
      <tr class="wtrthe">
        <th colspan="3">Part 1</th>
        <th colspan="3">Part 2</th>
        <th colspan="3">Visual</th>
        <th colspan="3">MPI</th>
        <th colspan="3">PT</th>
        <th colspan="3">UT</th>
        <th colspan="3">RT</th>
        <th colspan="3">PMI</th>
        <th colspan="14">PWHT</th>
        <th colspan="3">HER</th>
      </tr>
      <tr class="wtrthe">
        <th>Mtr No</th>
        <th>Grade /Spec</th>
        <th>Unique No</th>
        <th>Mtr No</th>
        <th>Grade /Spec</th>
        <th>Unique No</th>
        <th>Report</th>
        <th>Result</th>
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
      </tr>
    </thead>
    <tbody>
      <?php foreach ($list as $key => $value) {?>
      <tr nobr="true" style="text-align: center">
        <td style="width: 37pt"><?php echo $value['drawing_wm']; ?></td>
        <td style="width: 15pt"><?php echo $value['rev_wm']; ?></td>
        <td style="width: 20pt"><?php echo $value['joint_no']; ?></td>
        <td style="width: 18pt"><?= $weld_type_desc[$value['weld_type']] ?></td>
        <td style="width: 25pt"><?= $value['spool_no'] ?></td>
        <td><?= $value['diameter'] ?></td>
        <td><?= $value['thickness'] ?></td>

        <td><?= isset($verif[$pmark[$value['pos_1']]['id']]['report_number']) ? $verif[$pmark[$value['pos_1']]['id']]['report_number'] : '-'?></td>
        <td><?= isset($verif[$pmark[$value['pos_1']]['id']]['report_number']) ? $material_grade[$material_pp[$material[$mis[$verif[$pmark[$value['pos_1']]['id']]['id_mis']]['unique_no']]['catalog_id']]['material_grade']]['material_grade'] : '-'?></td>
        <td><?= isset($verif[$pmark[$value['pos_1']]['id']]['report_number']) ? $mis[$verif[$pmark[$value['pos_1']]['id']]['id_mis']]['unique_no'] : '-'?></td>

        <td><?= isset($verif[$pmark[$value['pos_2']]['id']]['report_number']) ? $verif[$pmark[$value['pos_2']]['id']]['report_number'] : '-'?></td>
        <td><?= isset($verif[$pmark[$value['pos_2']]['id']]['report_number']) ? $material_grade[$material_pp[$material[$mis[$verif[$pmark[$value['pos_2']]['id']]['id_mis']]['unique_no']]['catalog_id']]['material_grade']]['material_grade'] : '-'?></td>
        <td><?= isset($verif[$pmark[$value['pos_2']]['id']]['report_number']) ? $mis[$verif[$pmark[$value['pos_2']]['id']]['id_mis']]['unique_no'] : '-'?></td>

        <td><?= $fitup[$value['id']]['report_number'] ?></td>
        <td><?= $fitup[$value['id']]['status_inspection']==2 ? 'REJECT' : (in_array($fitup[$value['id']]['status_inspection'], [3,4,5,6,7,8]) ? 'ACC' : '-') ?></td>
        <td>
          <?php 
            $wps_no = explode(';', $fitup[$value['id']]['wps_no']);
            foreach ($wps_no as $wps_no) {
               echo $wps[$wps_no]['wps_code'].',';
             } 
          ?>
        </td>
        <td>
          <?php 
            $welder_ref_rh = explode(';', $visual[$value['id']]['welder_ref_rh']);
            foreach ($welder_ref_rh as $welder_ref_rh) {
              echo $welder[$welder_ref_rh]['wel_code'].',';
            } 
          ?>
        </td>
        <td>
          <?php 
            $welder_ref_fc = explode(';', $visual[$value['id']]['welder_ref_fc']);
            foreach ($welder_ref_fc as $welder_ref_fc) {
              echo $welder[$welder_ref_fc]['wel_code'].',';
            } 
          ?>
        </td>
        <td><?= isset($visual[$value['id']]['report_number']) ? $visual[$value['id']]['report_number'] : '-'?></td>
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
        <td><?= $visual[$value['id']]['ndt_pwht']<1 AND isset($visual[$value['id']]['ndt_pwht']) ? 'NO' : '' ?></td>
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

      <!-- Looping Rejec -->
      <?php foreach ($list_reject as $key => $value_reject) {?>
      <tr nobr="true" style="text-align: center">
        <td style="width: 37pt"><?php echo $value_reject['drawing_wm']; ?></td>
        <td style="width: 15pt"><?php echo $value_reject['rev_wm']; ?></td>
        <td style="width: 20pt"><?php echo $value_reject['joint_no'].'('.$value_reject['revision_category'].$value_reject['revision'].')'; ?></td>
        <td style="width: 18pt"><?= $weld_type_desc[$value_reject['weld_type']] ?></td>
        <td style="width: 25pt"><?= $value_reject['spool_no'] ?></td>
        <td><?= $value_reject['diameter'] ?></td>
        <td><?= $value_reject['thickness'] ?></td>

        <td><?= isset($verif[$pmark[$value_reject['pos_1']]['id']]['report_number']) ? $verif[$pmark[$value_reject['pos_1']]['id']]['report_number'] : '-'?></td>
        <td><?= isset($verif[$pmark[$value_reject['pos_1']]['id']]['report_number']) ? $material_grade[$material_pp[$material[$mis[$verif[$pmark[$value_reject['pos_1']]['id']]['id_mis']]['unique_no']]['catalog_id']]['material_grade']]['material_grade'] : '-'?></td>
        <td><?= isset($verif[$pmark[$value_reject['pos_1']]['id']]['report_number']) ? $mis[$verif[$pmark[$value_reject['pos_1']]['id']]['id_mis']]['unique_no'] : '-'?></td>

        <td><?= isset($verif[$pmark[$value_reject['pos_2']]['id']]['report_number']) ? $verif[$pmark[$value_reject['pos_2']]['id']]['report_number'] : '-'?></td>
        <td><?= isset($verif[$pmark[$value_reject['pos_2']]['id']]['report_number']) ? $material_grade[$material_pp[$material[$mis[$verif[$pmark[$value_reject['pos_2']]['id']]['id_mis']]['unique_no']]['catalog_id']]['material_grade']]['material_grade'] : '-'?></td>
        <td><?= isset($verif[$pmark[$value_reject['pos_2']]['id']]['report_number']) ? $mis[$verif[$pmark[$value_reject['pos_2']]['id']]['id_mis']]['unique_no'] : '-'?></td>

        <td><?= $fitup[$value_reject['id']]['report_number'] ?></td>
        <td><?= $fitup[$value_reject['id']]['status_inspection']==2 ? 'REJECT' : (in_array($fitup[$value_reject['id']]['status_inspection'], [3,4,5,6,7,8]) ? 'ACC' : '-') ?></td>
        <td>
          <?php 
            $wps_no = explode(';', $fitup[$value_reject['id']]['wps_no']);
            foreach ($wps_no as $wps_no) {
               echo $wps[$wps_no]['wps_code'].',';
             } 
          ?>
        </td>
        <td>
          <?php 
            $welder_ref_rh = explode(';', $visual[$value_reject['id']]['welder_ref_rh']);
            foreach ($welder_ref_rh as $welder_ref_rh) {
              echo $welder[$welder_ref_rh]['wel_code'].',';
            } 
          ?>
        </td>
        <td>
          <?php 
            $welder_ref_fc = explode(';', $visual[$value_reject['id']]['welder_ref_fc']);
            foreach ($welder_ref_fc as $welder_ref_fc) {
              echo $welder[$welder_ref_fc]['wel_code'].',';
            } 
          ?>
        </td>
        <td><?= isset($visual[$value_reject['id']]['report_number']) ? $visual[$value_reject['id']]['report_number'] : '-'?></td>
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
        <td><?= $visual[$value_reject['id']]['ndt_pwht']<1 AND isset($visual[$value_reject['id']]['ndt_pwht']) ? 'NO' : '' ?></td>
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