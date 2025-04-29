<?php 

error_reporting(0);
if($main_material['discipline'] == 1) {
  $report_type  = "PIPING";
} else {
  $report_type  = "STRUCTURAL";
}


?>
<!DOCTYPE html>
<html>

<head>
  <title>
    <?= $report_no ? $report_no_format[$main_material['project_code']][$main_material['discipline']][$main_material['type_of_module']].'-'.$report_no : $main_material['submission_id'] ?>
  </title>
  <style type="text/css">
  @page {
    margin: 0cm 0cm;
  }

  body {
    top: 0cm;
    left: 0cm;
    right: 0cm;
    margin-top: 4.2cm;
    margin-left: 1.5cm;
    margin-right: 1.5cm;
    margin-bottom: 1cm;
    font-family: "helvetica";
    font-size: 60% !important;
  }

  header {
    position: fixed;
    top: 0cm;
    left: 0cm;
    right: 0cm;
    height: 2cm;
    padding-top: 15px;
    padding-left: 1.4cm;
    padding-right: 1.5cm;

  }

  footer {
    position: fixed;
    top: 28cm;
    left: 0cm;
    right: 0cm;
    height: 2cm;
    padding-top: 15px;
    padding-left: 1.4cm;
    padding-right: 1.5cm;

  }


  .titleHead {
    border: 1px #000 solid;
    border-collapse: collapse;
    text-align: center;
    vertical-align: middle;
    font-size: 25px;
    background-color: #a6ffa6;
    font-weight: bold;

  }

  .titleHeadMain {
    text-align: center;
    border-collapse: collapse;
    text-align: center;
    vertical-align: middle;
    font-size: 25px;
    font-weight: bold;
  }

  table.table td {
    font-size: 90%;
    border: 1px #000 solid;
    font-weight: bold;
    max-width: 150px;
    word-wrap: break-word;
    text-align: center;
  }


  table>thead>tr>td,
  table>tbody>tr>td {
    vertical-align: top;
  }

  .br_break {
    line-height: 15px;
  }

  .br_break_no_bold {
    line-height: 18px;
  }

  .br {
    border-right: 1px #000 solid;
  }

  .bl {
    border-left: 1px #000 solid;
  }

  .bt {
    border-top: 1px #000 solid;
  }

  .bb {
    border-bottom: 1px #000 solid;
  }

  .bx {
    border-left: 1px #000 solid;
    border-right: 1px #000 solid;
  }

  .by {
    border-top: 1px #000 solid;
    border-bottom: 1px #000 solid;
  }

  .ball {
    border-top: 1px #000 solid;
    border-bottom: 1px #000 solid;
    border-left: 1px #000 solid;
    border-right: 1px #000 solid;
  }



  label {
    display: block;
    padding-left: 3;
    text-indent: -1;
  }

  input {
    width: 15px;
    height: 15px;
    padding: 0;
    margin: 0;
    vertical-align: bottom;
    position: relative;
    top: 0px;
    *overflow: hidden;
  }

  .text-center {
    text-align: center;
  }

  .valign-middle {
    vertical-align: middle;
  }

  .fs-10 {
    font-size: 6px !important;
  }
  .fs-9 {
    font-size: 7px !important;
  }
  </style>
</head>

<body>

  <header>


    <table width="100%" border="1px" style="border-collapse: collapse !important;">
      <tr>
        <td width="100%;" style="padding: 10px;">
          <!-- <center><img src="<?= $data_project['project_logo'] ?>" style='width: 160px; height: 50px;' /></center> -->
          <center><img src="img/header_report.png" style='width: 350px; height: 60px;'></center>
        </td>
        <!-- <td width="30%" style="padding: 10px; font-size: 120% !important;vertical-align: middle;">
          <center><?= $data_project['description'] ?></center>
        </td>
        <td width="15%" style="padding: 10px;">
          <center><img src="img/sembcorp-logo.png" style='width: 110px; height: 50px;' /></center>
        </td> -->
      </tr>
    </table>
    <br />
    <table>
      <tr>
        <td style="padding-bottom: 4px;"><b><u><?= $report_type ?> MATERIAL TRACEABILITY REPORT</u></b></td>
      </tr>
      <tr>
        <td><b>QUALITY CONTROL DEPARTMENT</b></td>
      </tr>
    </table>

  </header>


  <table border="0" style="text-align: left;border-collapse: collapse !important; width:100% !important;">
    <thead>
      <tr>
        <td class="fs-9 bt bl">
          <b>CLIENT</b>
        </td>
        <td class="bt fs-9" width="5px"><b>:</b></td>
        <td class="bt fs-9" colspan="7"><?= $data_project['project_name'] ?></td>

        <td class="fs-9 bt bl" width="60px"><b>PROJECT CODE</b></td>
        <td class="bt fs-9" style="width:2px !important"><b>:</b></td>
        <td class="bt br fs-9" colspan="6"><?= $data_project['project_code'] ?></td>
      </tr>
      <tr>
        <td class="fs-9  bl"><b>PROJECT</b></td>
        <td width="5px"  class="fs-9"><b>:</b></td>
        <td colspan="7" class="fs-9"><?= strtoupper($data_project['description']) ?></td>

        <td class="fs-9  bl"><b>REPORT NO.</b></td>
        <td width="5px" class="fs-9"><b>:</b></td>
        <td class="br fs-9" colspan="6">
          <?= $report_no ? $report_no_format[$main_material['project_code']][$main_material['discipline']][$main_material['type_of_module']].'-'.$report_no : $main_material['submission_id'] ?>
        </td>
      </tr>
      <tr>
        <td class="fs-9 bl" style="width: 60px !important;"><b>GA DRAWING NO.</b></td>
        <td width="5px"  class="fs-9"><b>:</b></td>
        <td colspan="7" class="fs-9"><?= $main_material['drawing_no'] ?></td>

        <td class="fs-9  bl"><b>AREA</b></td>
        <td width="5px" class="fs-9"><b>:</b></td>
        <td class="br fs-9" colspan="6"><?= $area_name[$main_material['area']] ?></td>
      </tr>
      <tr>
        <td class="fs-9 bl" style="width: 70px !important;"><b>ASSY DRAWING NO.</b></td>
        <td width="5px" class="fs-9"><b>:</b></td>
        <td colspan="7" class="fs-9"><?= $main_material['drawing_as'] ? $main_material['drawing_as'] : '-' ?></td>

        <td class="fs-9  bl"><b>DATE</b></td>
        <td width="5px" class="fs-9"><b>:</b></td>
        <td class="br fs-9" colspan="6"><?=  $main_material['date_request'] ?></td>
      </tr>

      <?php foreach (range(1, 8) as $key => $value): ?>
      <!-- <tr>

        <td class=" bl"><b></b></td>
        <td width="5px"><b></b></td>
        <td class=" br" colspan="7"></td>

        <td class=" bl"><b></b></td>
        <td width="5px"><b></b></td>
        <td class=" br" colspan="6"></td>
      </tr> -->
      <?php endforeach; ?>

      <tr>
        <td class="ball text-center fs-10" rowspan="2" colspan="2" style="vertical-align: middle;">
          <b>PIECE MARK / SPOOL NO.</b>
        </td>
        <td class="ball text-center fs-10" rowspan="2" style="width: 40px; vertical-align: middle;">
          <b>MATERIAL</b>
        </td>
        <td class="ball text-center fs-10" rowspan="2" style="width: 40px; vertical-align: middle;">
          <b>PROFILE</b>
        </td>
        <td class="ball text-center fs-10" rowspan="2" style="width: 40px; vertical-align: middle;">
          <b>SIZE / DIA</b>
        </td>
        <td class="ball text-center fs-10" colspan="6" style="vertical-align: middle;">
          <b>MATERIAL DESCRIPTION AS PER DRAWING</b>
        </td>


        <td class="ball text-center fs-10" rowspan="2" style="vertical-align: middle; width:40px;">
          <b>UNIQUE NO.</b>
        </td>
        <td class="ball text-center fs-10" rowspan="2" style="vertical-align: middle; width:30px">
          <b>HEAT NO.</b>
        </td>
        <td class="ball text-center fs-10" rowspan="2" style="vertical-align: middle;">
          <b>MATERIAL SPEC</b>
        </td>
        <td class="ball text-center fs-10" rowspan="2" style="vertical-align: middle;">
          <b>MRIR NO.</b>
        </td>
        <td class="ball text-center fs-10" rowspan="2" style="width: 40px; vertical-align: middle;">
          <b>MILL <br> CERTIFICATE <br> NO.</b>
        </td>
        <td class="ball text-center fs-10" rowspan="2" style="vertical-align: middle;">
          <b>REMARKS</b>
        </td>
      </tr>
      <tr>
        <td class="ball text-center fs-10" style="vertical-align: middle;">
          <b>LENGTH<br>(mm)</b>
        </td>
        <td class="ball text-center fs-10" style="vertical-align: middle;">
          <b>HEIGHT<br>(mm)</b>
        </td>
        <td class="ball text-center fs-10" style="vertical-align: middle;">
          <b>WIDTH<br>(mm)</b>
        </td>
        <td class="ball text-center fs-10" style="vertical-align: middle;">
          <b>SCH</b>
        </td>
        <td class="ball text-center fs-10" colspan="2" style="vertical-align: middle;">
          <b>THK<br>(mm)</b>
        </td>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($detail_material as $key => $value): ?>
        <tr>
        <td class="ball text-center fs-10 valign-middle" colspan="2"><?= $value['part_id'] ?></td>
        <td class="ball text-center fs-10 valign-middle"><?= $value['material'] ?></td>
        <td class="ball text-center fs-10 valign-middle"><?= $value['profile'] ?></td>
        <td class="ball text-center fs-10 valign-middle"><?= $value['diameter'] ?></td>
        <td class="ball text-center fs-10 valign-middle"><?= $value['length'] ?></td>
        <td class="ball text-center fs-10 valign-middle"><?= $value['length'] ?></td>
        <td class="ball text-center fs-10 valign-middle"><?= $value['width'] ?></td>
        <td class="ball text-center fs-10 valign-middle"><?= $value['sch'] ?></td>
        <td class="ball text-center fs-10 valign-middle" colspan="2"><?= $value['thickness'] ?></td>
        <td class="ball text-center fs-10 valign-middle"><?= $detail_mis[$value['id_mis']]['unique_no'] ?></td>
        <td class="ball text-center fs-10 valign-middle"><?= $detail_mis[$value['id_mis']]['heat_or_series_no'] ?></td>
        <td class="ball text-center fs-10 valign-middle"><?= $material_grade[$value['grade']] ?></td>
        <td class="ball text-center fs-10 valign-middle">
          <?php 
            $mrir_no =  $detail_mis[$value['id_mis']]['report_no'];
            $mrir_no = explode("/", $mrir_no)[1];
          ?>

          <?= $mrir_no ?>
        </td>
        <td class="ball text-center fs-10 valign-middle"><?= $detail_mis[$value['id_mis']]['mill_cert_no'] ?></td>
        <td class="ball text-center fs-10 valign-middle"></td>
        </tr>
      <!-- <tr>
        <td class="ball text-center fs-10 valign-middle" colspan="2"><?= $value['part_id'] ?></td>
        <td class="ball text-center fs-10 valign-middle">
     
          <?= $value['material'] ?>
        </td>
        <td class="ball text-center fs-10 valign-middle"><?= $value['diameter'] ?></td>
        <td class="ball text-center fs-10 valign-middle"><?= $value['sch'] ?></td>
        <td class="ball text-center fs-10 valign-middle"><?= $value['thickness'] ?></td>
        <td class="ball text-center fs-10 valign-middle"><?= $detail_mis[$value['id_mis']]['unique_no'] ?></td>
        <td class="ball text-center fs-10 valign-middle" colspan="2">
          <?= $detail_mis[$value['id_mis']]['heat_or_series_no'] ?>
        </td>
        <td class="ball text-center fs-10 valign-middle"><?= $material_grade[$value['grade']] ?></td>
        <td class="ball text-center fs-10 valign-middle">
          <?php 
            $mrir_no =  $detail_mis[$value['id_mis']]['report_no'];
            $mrir_no = explode("/", $mrir_no)[1];
          ?>

          <?= $mrir_no ?>
        </td>
        <td class="ball text-center fs-10 valign-middle"><?= $detail_mis[$value['id_mis']]['mill_cert_no'] ?></td>
        <td class="ball text-center fs-10 valign-middle"></td>
        <td class="ball text-center fs-10 valign-middle"></td>
        <td class="ball text-center fs-10 valign-middle"></td>
        <td class="ball text-center fs-10 valign-middle"></td>
        <td class="ball text-center fs-10 valign-middle"></td>
      </tr> -->
      <?php endforeach; ?>
    </tbody>
  </table>


  <br><br><br><br><br><br><br><br>
  <table class="table-body" width="100%"
    style="text-align: left;border-collapse: collapse !important; padding-top: -0.8px;">
    <tbody>
      <tr>
        <td style="width: 25%; border: none;"></td>
        <td style="width: 25%; border: none;"></td>
        <td style="width: 25%; border: none;"></td>
        <td style="width: 25%; border: none;"></td>
      </tr>
      <tr style="vertical-align: text-bottom !important;">
        <td style="width: 25%; border: none; vertical-align: text-bottom !important;">
          <?php if ($sign_contractor): ?>
          <img src="data:image/png;base64,<?= $user['sign_approval'] ?>"
            style='width: 3.5cm;vertical-align: text-bottom !important;' />
          <?php endif; ?>
        </td>
        <td style="width: 25%; border: none;"></td>
        <td style="width: 25%; border: none; vertical-align: text-bottom !important;">
          <?php if ($sign_client): ?>
          <img src="data:image/png;base64,<?= $user_client['sign_approval'] ?>"
            style='width: 3.5cm;vertical-align: text-bottom !important;' />
          <?php endif; ?>
        </td>
        <td style="width: 25%; border: none;"></td>
        <td style="width: 25%; border: none;"></td>
      </tr>
      <tr>
        <td style="width: 25%; border: none;">
          <?php if ($sign_contractor): ?>
          <?= $user['full_name'] ?>
          <?php endif; ?>
          <br>
          <b>_______________________</b>
        </td>
        <td style="width: 25%; border: none;"></td>
        <td style="width: 25%; border: none;">
          <?php if ($sign_contractor): ?>
          <?= $user_client['full_name'] ?>
          <?php endif; ?>
          <br>
          <b>_______________________</b>
        </td>
        <td style="width: 25%; border: none;"></td>
        <td style="width: 25%; border: none;"><b>_______________________</b></td>
      </tr>
      <tr>
        <td style="width: 25%; border: none; padding-top: 10px;"><b>CONTRACTOR</b></td>
        <td style="width: 25%; border: none;"></td>
        <td style="width: 25%; border: none; padding-top: 10px;"><b>EMPLOYER</b></td>
        <td style="width: 25%; border: none; padding-top: 10px;"><b></b></td>
        <td style="width: 25%; border: none; padding-top: 10px;"><b>THIRD PARTY <strong><i><span
                  style="font-size: 6px;"> (if any)</span></i></strong></b></td>
      </tr>
      <tr>
        <td style="width: 25%; border: none;">DATE :
          <?= $sign_contractor ? date('Y-m-d', strtotime($main_material['inspection_datetime'])) : '' ?>
        <td style="width: 25%; border: none;"></td>
        <td style="width: 25%; border: none;">DATE :
          <?= $sign_client ? date('Y-m-d', strtotime($main_material['inspection_client_datetime'])) : '' ?></td>
        <td style="width: 25%; border: none;"></td>
        <td style="width: 25%; border: none;">DATE :</td>
      </tr>
      <tr>
        <td style="width: 25%; border: none;"><br /></td>
        <td style="width: 25%; border: none;"></td>
        <td style="width: 25%; border: none;">
        </td>
        <td style="width: 25%; border: none;">
        </td>
        <td style="width: 25%; border: none;">
        </td>
      </tr>
      <tr>
        <td style="width: 25%; border: none;"></td>
        <td style="width: 25%; border: none;"></td>
        <td style="width: 25%; border: none;">
        </td>
        <td style="width: 25%; border: none;">
          <!-- IDATE : -->
        </td>
        <td style="width: 25%; border: none;">
          <!-- IDATE : -->
        </td>
      </tr>
      <tr>
        <td style="width: 25%; border: none;"></td>
        <td style="width: 25%; border: none;"></td>
        <td style="width: 25%; border: none;">
        </td>
        <td style="width: 25%; border: none;">
        </td>
        <td style="width: 25%; border: none;">
        </td>
      </tr>
    </tbody>
  </table>

  <footer>
    FOU-QCF-MTR-001
  </footer>
</body>

</html>