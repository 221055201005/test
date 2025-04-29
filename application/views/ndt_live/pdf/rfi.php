<!DOCTYPE html>
<html>

<head>
  <?php error_reporting(0); ?>
  <?php $pending = "<label><input type='checkbox' style='margin-top: 0 cm; margin-bottom: 0 cm;'> PASS</label> <BR/> <label><input type='checkbox' style='margin-top: 0 cm; margin-bottom: 0 cm;'> REJECT</label>"; ?>
  <?php
  $reno = $renox;

  $document_approval_date = MAX(array_column($visual_report, 'document_approval_date'));

  foreach ($visual_report as $keyg => $valueg) {
    if ($valueg['inspection_datetime'] != '') {
      $inspection_datetime_arr[] = $valueg['inspection_datetime'];
    }
  }

  $inspection_date = MIN($inspection_datetime_arr);

  $ticked_report_date = MAX(array_column($visual_report, 'ticked_report_date'));

  if ($ticked_report_date == 1) {
    $show_date = $document_approval_date;
  } else {
    $show_date = $inspection_date;
  }

  $legend_inspection          = explode(";", $visual_report[0]['legend_inspection_auth']);
  // test_var($legend_inspection);
  if ((in_array(1, $legend_inspection)) == 1) {
    $checked_type             = "hold";
  } elseif ((in_array(2, $legend_inspection)) == 1) {
    $checked_type             = "witness";
  } elseif ((in_array(3, $legend_inspection)) == 1 || (in_array(4, $legend_inspection)) == 1) {
    $checked_type             = "review";
  }
  // test_var($checked_type);

  ?>
  <title><?= $access == 'client' ? $reno : $visual_report[0]['submission_id'] ?></title>
  <style type="text/css">
    <?php error_reporting(0) ?>f @page {
      margin: 0cm 0cm;
    }

    body {
      top: 0cm;
      left: 0cm;
      right: 0cm;
      margin-top: 6.1cm;
      margin-left: 0.25cm;
      margin-right: 0.25cm;
      margin-bottom: 1cm;
      font-family: "helvetica";
      font-size: 50% !important;
    }

    header {
      position: fixed;
      /*top: 2cm;*/
      left: 0cm;
      right: 0cm;
      height: 5cm;
      padding-top: 9.5px;
      padding-bottom: 15px !important;
      margin-top: 0.5cm;
      margin-left: 0.25cm;
      margin-right: 0.25cm;

    }

    footer {
      position: fixed;
      top: 18cm;
      left: 0cm;
      right: 0cm;
      height: 5cm;
      padding-top: 15px;
      /*padding-left: 1.4cm;
      padding-right: 1.5cm;*/
      margin-left: 0.5cm;
      margin-right: 0.5cm;

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
      word-wrap: break-word;
    }

    .tab {
      display: inline-block;
      width: 60px;
    }

    .tab2 {
      display: inline-block;
      width: 120px;
    }

    hr {
      border-top: 0px !important;
    }

    label {
      display: block;
      padding-left: 2;
      text-indent: -1;
    }

    input {
      width: 5px;
      height: 5px;
      padding: 0;
      margin: 0;
      vertical-align: bottom;
      position: relative;
      top: 0px;
      *overflow: hidden;
    }
  </style>
</head>

<body>
  <header>
    <table width="100%" border="1px" style="border-collapse: collapse !important;">
      <tr>
        <td width="15%;" style="padding: 10px; border-right: 0px !important;">
          <center>
            <img src="img/seatrium_logo_bg_white.png" style='width: 160px; height: 50px;' />
          </center>
        </td>
        <td style="padding: 10px; border-right: 0px !important; border-left: 0px !important;">
          <center>
            <b style="font-weight: bold; font-size: 20 !important; vertical-align: middle !important;">
              <?php echo $project['description'] ?>
            </b>
          </center>
        </td>
        <td width="15%;" style="padding: 10px; border-left: 0px !important;">
          <center>
            <img src="<?php echo $project['client_logo']; ?>" style='width: 160px; height: 50px;' />
          </center>
        </td>

      </tr>
    </table>
    </br>
    <table width="100%" border="1px" style="border-collapse: collapse !important;">

      <head>
        <tr>
          <td><b class="tab2">EMPLOYER</b>: <?= $project['client'] ?></td>
          <td><b class="tab2">RFI NO. </b>: <?= $rfi_no ?></td>
        </tr>

        <tr>
          <td><b class="tab2">PROJECT</b>: <?= strtoupper($project['description']) ?></td>
          <td><b class="tab2">DATE</b>: <?= date("d F Y", strtotime($ndt[0]['transmittal_inspection_datetime'] > 0 ? $ndt[0]['transmittal_inspection_datetime'] : $ndt[0]['transmit_date'])); ?></td>

        </tr>
        <tr>
          <td><b class="tab2">MODULE</b>: <?= $master_module[$ndt[0]['module']]['mod_desc'] ?></td>
          <td><b class="tab2">DRAWING NO.</b>: <?= $visual[0]['drawing_no'] . ' Rev. ' . ($visual[0]['status_inspection'] == 7 || $visual[0]['status_inspection'] == 9 ? $visual[0]['drawing_rev_no'] : $master_drawing[$visual[0]['drawing_no']]['last_revision_no']) . ($master_drawing[$visual[0]['drawing_no']]['client_doc_no'] != '' ? ' (' . $master_drawing[$visual[0]['drawing_no']]['client_doc_no'] . ')' : '') ?></td>
        </tr>
        <tr>
          <td><b class="tab2">CONTRACTOR</b>: PT. SMOE</td>
          <td rowspan="2"><b class="tab2">DESCRIPTION</b>: <?= $master_drawing[$visual[0]['drawing_no']]['title'] ?></td>
        </tr>
        <tr>
          <td><b class="tab2">AREA / LOCATION</b>:<?= $area_v2[$location_v2[$ndt[0]['transmittal_inspection_location']]["id_area"]] . ' - ' . $location_v2[$ndt[0]['transmittal_inspection_location']]["name"] ?></td>
        </tr>
        <tr>
          <td colspan="2" class="bb bx" width="100%">
            <center><b>RFI <?= $method . " " . strtoupper($master_discipline[$visual[0]['discipline']]['discipline_name']) ?></b></center>
          </td>
        </tr>
        <tr>
          <td colspan="1" class="bb bx" width="100%" style="background-color: rgb(176, 176, 176);">
            <left><b>DOCUMENT / SPECIFICATION / PROCEDURE No. / REFER to :
                <?php
                if ($visual[0]['discipline'] != 1) {
                  if ($method == 'MT') { // MT
                    $procedure = '003720373';
                  } elseif ($method == 'UT') { // UT
                    $procedure = '003720378';
                  } elseif ($method == 'PT') { // PT
                    $procedure = '003720396';
                  } elseif ($method == 'PT') { // PT
                    $procedure = '003720395';
                  }
                } else {
                  if ($method == 'MT') { // MT
                    $procedure = '003720397';
                  } elseif ($method == 'PT') { // PT
                    $procedure = '003720436';
                  } elseif ($method == 'PT') { // PT
                    $procedure = '003720398';
                  }
                }
                echo "
              </br>
              &nbsp;&nbsp;&nbsp;&nbsp;• 002752254; Part B Section 4 - Offshore Converter Platform</br>
              &nbsp;&nbsp;&nbsp;&nbsp;• " . $procedure . "; " . $method . " Procedure - " . $master_discipline[$visual[0]['discipline']]['discipline_name'] . "
                ";
                ?>
              </b></left>
          </td>
          <td colspan="1" class="bb bx" width="100%" style="background-color: rgb(176, 176, 176);">
            <left><b>Acceptance Criteria :
                <?php
                if ($visual[0]['discipline'] != 1) {
                  if ($method == $ndt_master[2]) {
                    echo "
                  </br>
                    &nbsp;&nbsp;&nbsp;&nbsp;• DNVGL-CG-0051 / BS EN ISO 17638</br>
                    &nbsp;&nbsp;&nbsp;&nbsp;• ISO 23278 ACCEPTANCE LEVEL 2X
                  ";
                    if ($visual[0]['class'] != 1) {
                      echo "
                  </br>
                    &nbsp;&nbsp;&nbsp;&nbsp;• EN ISO 5817 Level C
                  ";
                    } else {
                      echo "
                  </br>
                    &nbsp;&nbsp;&nbsp;&nbsp;• EN ISO 5817 Level B
                  ";
                    }
                  } elseif ($method == $ndt_master[3]) {
                    echo "
                  </br>
                    &nbsp;&nbsp;&nbsp;&nbsp;• DNVGL-CG-0051 / BS EN ISO 17640
                  ";
                    if ($visual[0]['class'] != 1) {
                      echo "
                  </br>
                    &nbsp;&nbsp;&nbsp;&nbsp;• ISO 11666 ACCEPTANCE LEVEL 3
                  </br>
                    &nbsp;&nbsp;&nbsp;&nbsp;• EN ISO 5817 Level C
                  ";
                    } else {
                      echo "
                  </br>
                    &nbsp;&nbsp;&nbsp;&nbsp;• ISO 11666 ACCEPTANCE LEVEL 2
                  </br>
                    &nbsp;&nbsp;&nbsp;&nbsp;• EN ISO 5817 Level B
                  ";
                    }
                  } elseif ($method == $ndt_master[7]) {
                    echo "
                  </br>
                    &nbsp;&nbsp;&nbsp;&nbsp;• DNVGL-CG-0051 / BS EN ISO 17635
                  </br>
                    &nbsp;&nbsp;&nbsp;&nbsp;• ISO 23277 ACCEPTANCE LEVEL 2X
                ";
                    if ($visual[0]['class'] != 1) {
                      echo "
                  </br>
                    &nbsp;&nbsp;&nbsp;&nbsp;• EN ISO 5817 Level C
                  ";
                    } else {
                      echo "
                  </br>
                    &nbsp;&nbsp;&nbsp;&nbsp;• EN ISO 5817 Level B
                  ";
                    }
                  } elseif ($method == $ndt_master[1]) {
                    echo "
                  </br>
                    &nbsp;&nbsp;&nbsp;&nbsp;• DNVGL-CG-0051 / BS EN ISO 17636-1
                ";
                    if ($visual[0]['class'] != 1) {
                      echo "
                  </br>
                    &nbsp;&nbsp;&nbsp;&nbsp;• ISO 10675-1 ACCEPTANCE LEVEL 2
                  </br>
                    &nbsp;&nbsp;&nbsp;&nbsp;• EN ISO 5817 Level C
                  ";
                    } else {
                      echo "
                  </br>
                    &nbsp;&nbsp;&nbsp;&nbsp;• ISO 10675-1 ACCEPTANCE LEVEL 1
                  </br>
                    &nbsp;&nbsp;&nbsp;&nbsp;• EN ISO 5817 Level B
                  ";
                    }
                  }
                } else {
                  if ($method == $ndt_master[1]) {
                    echo "
                  </br>
                    &nbsp;&nbsp;&nbsp;&nbsp;• ASME B31.3 Table 341.3.2
                ";
                    if ($visual[0]['class'] != 1) {
                      echo "
                  </br>
                    &nbsp;&nbsp;&nbsp;&nbsp;• EN ISO 5817 Level C
                  ";
                    } else {
                      echo "
                  </br>
                    &nbsp;&nbsp;&nbsp;&nbsp;• EN ISO 5817 Level B
                  ";
                    }
                  } elseif ($method == $ndt_master[7]) {
                    echo "
                  </br>
                    &nbsp;&nbsp;&nbsp;&nbsp;• ASME B31.3 Paragraph 344.4.2
                ";
                    if ($visual[0]['class'] != 1) {
                      echo "
                  </br>
                    &nbsp;&nbsp;&nbsp;&nbsp;• EN ISO 5817 Level C
                  ";
                    } else {
                      echo "
                  </br>
                    &nbsp;&nbsp;&nbsp;&nbsp;• EN ISO 5817 Level B
                  ";
                    }
                  } elseif ($method == $ndt_master[2]) {
                    echo "
                  </br>
                    &nbsp;&nbsp;&nbsp;&nbsp;• ASME B31.3 Paragraph 344.3.2
                ";
                    if ($visual[0]['class'] != 1) {
                      echo "
                  </br>
                    &nbsp;&nbsp;&nbsp;&nbsp;• EN ISO 5817 Level C
                  ";
                    } else {
                      echo "
                  </br>
                    &nbsp;&nbsp;&nbsp;&nbsp;• EN ISO 5817 Level B
                  ";
                    }
                  }
                }
                ?>
              </b></left>
          </td>
        </tr>
      </head>
    </table>
  </header>
  <footer>

  </footer>
  <!-- <br> -->
  <table width="100%" border="0" style="text-align: left;border-collapse: collapse !important;">
    <thead>
      <tr>
        <td rowspan="2" class="ball" style="vertical-align: middle; width: 20px">
          <center><b>S/N</b></center>
        </td>
        <td rowspan="2" class="ball" style="vertical-align: middle; width: 170px">
          <center><b>Weld Map Drawing No. / Line & Spool No</b></center>
        </td>
        <td rowspan="2" class="ball" style="vertical-align: middle; width: 40px">
          <center><b>Item No./<br />Joint No</b></center>
        </td>
        <td rowspan="2" class="ball" style="vertical-align: middle; width: 30px">
          <center><b>Class</b></center>
        </td>
        <td rowspan="2" class="ball" style="vertical-align: middle; width: 30px">
          <center><b>Type<br />Of<br />Weld</b></center>
        </td>
        <td rowspan="2" class="ball" style="vertical-align: middle;">
          <center><b>WPS</b></center>
        </td>
        <td rowspan="2" class="ball" style="vertical-align: middle; width: 40px">
          <center><b>Grade / Spec of Mtrl</b></center>
        </td>
        <td colspan="2" class="ball" style="vertical-align: middle;">
          <center><b>Weld Process</b></center>
        </td>
        <td colspan="2" class="ball" style="vertical-align: middle;">
          <center><b>Welder ID</b></center>
        </td>
        <td rowspan="2" class="ball" style="vertical-align: middle; width: 20px">
          <center><b>SIZE / <br>DIA</b></center>
        </td>

        <td rowspan="2" class="ball" style="vertical-align: middle; width: 20px">
          <center><b>SCH</b></center>
        </td>

        <td rowspan="2" class="ball" style="vertical-align: middle; width: 20px">
          <center><b>THK<br />(mm)</b></center>
        </td>
        <td rowspan="2" class="ball" style="vertical-align: middle; width: 40px">
          <center><b>Weld Length<br />(mm)</b></center>
        </td>
        <td rowspan="2" class="ball" style="vertical-align: middle;">
          <center><b>Weld Completion Date</b></center>
        </td>
        <td rowspan="2" class="ball" style="vertical-align: middle;">
          <center><b>Inspection Result</b></center>
        </td>
        <td colspan="4" class="ball" style="vertical-align: middle; width: 100px">
          <center><b>NDE Requirement</b></center>
        </td>
        <td rowspan="2" class="ball" style="vertical-align: middle;">
          <center><b>Remarks</b></center>
        </td>
      </tr>
      <tr>

        <td class="ball" style="vertical-align: middle;">
          <center><b>R/H</b></center>
        </td>
        <td class="ball" style="vertical-align: middle;">
          <center><b>F/C</b></center>
        </td>
        <td class="ball" style="vertical-align: middle;">
          <center><b>R/H</b></center>
        </td>
        <td class="ball" style="vertical-align: middle;">
          <center><b>F/C</b></center>
        </td>
        <td class="ball" style="vertical-align: middle;">
          <center><b>MT</b></center>
        </td>
        <td class="ball" style="vertical-align: middle;">
          <center><b>PT</b></center>
        </td>
        <td class="ball" style="vertical-align: middle;">
          <center><b>UT</b></center>
        </td>
        <td class="ball" style="vertical-align: middle;">
          <center><b>RT</b></center>
        </td>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      foreach ($visual as $key => $value) {
        // test_var($value);
      ?>
        <tr>
          <td class="ball" style="vertical-align: middle; text-align: center"><?= $no ?></td>

          <td class="ball" style="vertical-align: middle; text-align: center">
            <?=
            $value['drawing_wm'] . ' Rev.' . $value['visual_rev_wm'] . ($master_drawing[$value['drawing_wm']]['client_doc_no'] > 0 ? ' (' . $master_drawing[$value['drawing_wm']]['client_doc_no'] . ')' : '')
            ?>
          </td>

          <td class="ball" style="vertical-align: middle; text-align: center"><?= $value['joint_no'] . ($value['revision'] > 0 ? '(' . $value['revision_category'] . $value['revision'] . ')' : '') ?></td>

          <td class="ball" style="vertical-align: middle; text-align: center"><?= $master_class[$value['class']]['class_code'] ?></td>

          <td class="ball" style="vertical-align: middle; text-align: center"><?= $master_weld_type[$value['weld_type']]['weld_type_code'] ?></td>



          <?php
          $wps_rh = explode(';', $value['wps_no_rh']);
          $wps_fc = explode(';', $value['wps_no_fc']);
          ?>

          <td class="ball" style="vertical-align: middle; text-align: center">
            <?php
            $wpss = array_unique(array_merge($wps_rh, $wps_fc));
            foreach ($wpss as $key_wpss => $value_wpss) {
              print_r($master_wps[$value_wpss]["wps_no"]);
            }
            ?>
          </td>

          <?php
            $material_grade_show[] = $material_grade[$value['pos_1']];
            $material_grade_show[] = $material_grade[$value['pos_2']];

          ?>

          <td class="ball" style="vertical-align: middle; text-align: center">
         
            <?= implode(",", array_unique($material_grade_show)) ?>
            <?php unset($material_grade_show) ?>
          </td>

          <td class="ball" style="vertical-align: middle; text-align: center">
            <?= str_replace(";", "<br>", $value["weld_process_rh"]) ?>
          </td>

          <td class="ball" style="vertical-align: middle; text-align: center">
            <?= str_replace(";", "<br>", $value["weld_process_fc"]) ?>
          </td>

          <?php
          $welder_rh = array_filter(array_unique(array_column($detail[$value['id_visual']][0], 'id_welder')));
          $welder_fc = array_filter(array_unique(array_column($detail[$value['id_visual']][1], 'id_welder')));
          ?>
          <td class="ball" style="vertical-align: middle; text-align: center">
            <?php foreach ($welder_rh as $values) {
              if ($master_welder[$values]) {
                $welder_rh_merge[] = $master_welder[$values]['welder_code'];
              }
            }
            print_r(implode(',<br>', $welder_rh_merge));
            unset($welder_rh_merge);
            ?>
          </td>

          <td class="ball" style="vertical-align: middle; text-align: center">
            <?php foreach ($welder_fc as $values) {
              if ($master_welder[$values]) {
                $welder_fc_merge[] = $master_welder[$values]['welder_code'];
              }
            }
            print_r(implode(',<br>', $welder_fc_merge));
            unset($welder_fc_merge);
            ?>
          </td>

          <td class="ball" style="vertical-align: middle; text-align: center"><?= $value['discipline'] == 2 ? $value['diameter'] : '-' ?></td>

          <td class="ball" style="vertical-align: middle; text-align: center"><?= number_format($value['sch'], 2) ?></td>
          <td class="ball" style="vertical-align: middle; text-align: center"><?= number_format($value['thickness'], 2) ?></td>

          <td class="ball" style="vertical-align: middle; text-align: center">
            <?php
            if ($value['revision'] > 0) {
              print_r((int)$value['length_of_weld']);
            } else {
              print_r((int)$value['length']);
            }
            ?>
          </td>

          <td class="ball" style="vertical-align: middle; text-align: center"><?= DATE('d F, Y', strtotime($value['weld_datetime'])) ?></td>

          <td class="ball" style="vertical-align: middle; text-align: center">
            <?php
            // print_r($access);
            if ($access == 'clients' || $access == 'client') {
              if ($value['status_inspection'] == 5) {
                echo "SMOE Approved";
              } elseif ($value['status_inspection'] == 6) {
                echo "REJ";
              } elseif ($value['status_inspection'] == 7) {
                echo "ACC";
              } elseif ($value['status_inspection'] == 9) {
                echo "ACC";
              } elseif ($value['status_inspection'] == 10) {
                echo "POSTPONE";
              } elseif ($value['status_inspection'] == 11) {
                echo "RE-OFFER";
              }
            } else {
              if ($value['status_inspection'] == 1) {
                echo $pending;
              } elseif ($value['status_inspection'] == 2) {
                echo "REJ";
              } elseif ($value['status_inspection'] == 3) {
                echo "ACC";
              } elseif ($value['status_inspection'] == 4) {
                echo $pending;
              } elseif ($value['status_inspection'] >= 5) {
                echo "ACC";
              } elseif ($value['status_inspection'] == 6) {
                echo "REJ";
              } elseif ($value['status_inspection'] == 7) {
                echo "ACC";
              }
            }
            ?>
          </td>

          <td class="ball" style="vertical-align: middle;">
            <center>
              <?php if ($value['mt_percent_req'] > 0) { ?>
                <img src="data:image/png;base64,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" style='width: 5px;' />
              <?php } else {
                echo '-';
              } ?>
            </center>
          </td>

          <td class="ball" style="vertical-align: middle;">
            <center>
              <?php if ($value['pt_percent_req'] > 0) { ?>
                <img src="data:image/png;base64,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" style='width: 5px;' />
              <?php } else {
                echo '-';
              } ?>
            </center>
          </td>

          <td class="ball" style="vertical-align: middle;">
            <center>
              <?php if ($value['ut_percent_req'] > 0) { ?>
                <img src="data:image/png;base64,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" style='width: 5px;' />
              <?php } else {
                echo '-';
              } ?>
            </center>
          </td>

          <td class="ball" style="vertical-align: middle;">
            <center>
              <?php if ($value['rt_percent_req'] > 0) { ?>
                <img src="data:image/png;base64,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" style='width: 5px;' />
              <?php } else {
                echo '-';
              } ?>
            </center>
          </td>

          <td class="ball" style="vertical-align: middle;">

          </td>

        </tr>
      <?php $no++;
      } ?>

    </tbody>
  </table>

  <?php if ($visual_report[0]['project'] == 14) { ?>
    <br><br><br><br>
    <table border="1" style="border-collapse: collapse; width:300px !important">
      <tr>
        <td style="height: 70px !important">
          <b>Note/Remarks:</b>
          <br>
          <br>
          <?= $visual_report[0]['accepted_remarks'] ?>
        </td>
      </tr>
    </table>
  <?php } ?>

  <br><br><br><br><br>
  <!-- <table width="100%">
    <tr>
      <td colspan="20"> -->
  <div style="page-break-inside: avoid !important;">
    <table class="table-body" width="100%" style="border-collapse: collapse !important; padding-top: -0.8px;">
      <tbody>
        <tr>
          <?php $arr_sign_contra = [3, 5, 6, 7, 8, 9, 10, 11] ?>
          <td style="width: 25%; border: none;text-align: left;">
            <?php if (in_array($visual_report[0]['status_inspection'], $arr_sign_contra)) { ?>
              <img style="width: 3.5cm" src="data:image/png;base64, <?= $user_sign['inspector']['sign_approval'] ?>">
            <?php } ?>
          </td>
          <td style="width: 25%; border: none;"></td>

          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none;">
            <?php // if($visual_report[0]['status_inspection']==7 AND ($access=='clients' || $access=='client')){ 
            ?>
            <!-- <img style="width: 3.5cm" src="data:image/png;base64, <?= $user_sign['client']['sign_approval'] ?>">  -->
            <div style="page-break-inside: avoid;">
              <?php if ($visual_report[0]['project_code'] == 17) : ?>
                <style type="text/css">
                  .color_stamp {
                    color: rgba(63, 72, 204, 255);
                  }

                  .check_stamp {
                    -ms-transform: scale(1.7) !important;
                    -moz-transform: scale(1.7) !important;
                    -webkit-transform: scale(1.7) !important;
                    -o-transform: scale(1.7) !important;
                    transform: scale(1.7) !important;
                  }

                  .border_stamp {
                    border: 3px solid rgba(63, 72, 204, 255);
                  }

                  .box_stamp {
                    padding: 4px;
                    font-weight: bold;
                    z-index: 99 !important;
                    width: 140px;
                  }
                </style>
                <div class="box color_stamp border_stamp box_stamp">
                  <center>
                    <img src="img/orsted_stamp.png" style="width:35px">
                    <br>
                    <strong>CHW 2204 OSS Project</strong>
                  </center>
                  <table cellpadding="0" style="width:100%;">
                    <tr>
                      <td width="40%" class="valign_middle">Review</td>
                      <td><input type="checkbox" style="margin-bottom: 8px" <?= $checked_type == 'review' ? 'checked' : '' ?>></td>
                    </tr>
                    <tr>
                      <td width="40%" class="valign_middle">Witness</td>
                      <td><input type="checkbox" style="margin-bottom: 8px" <?= ($checked_type == 'hold' or $checked_type == 'witness') ? 'checked' : '' ?>></td>
                    </tr>
                    <tr>
                      <td width="40%" class="valign_middle">Inspect</td>
                      <td><input type="checkbox" style="margin-bottom: 8px" <?= $checked_type == 'hold' ? 'checked' : '' ?>></td>
                    </tr>
                  </table>
                  <br>
                  Date : <?= $visual_report[0]['inspection_client_datetime'] ? date('Y-m-d', strtotime($visual_report[0]['inspection_client_datetime'])) : space(15) ?>
                  &nbsp;
                  <span style="z-index: 99 !important;">Signature :</span>

                </div>
                <div class="text-right" style="padding-right: 5px; padding-bottom:3px;">
                  <?php if ($visual_report[0]['status_inspection'] == 7 and ($access == 'clients' || $access == 'client')) { ?>
                    <img src="data:image/png;base64, <?= $user_sign['client']['sign_approval'] ?>" style='width: 70px !important; position: absolute !important; margin-left: 70px !important; margin-top: -70px !important; z-index: -99 !important; 
/*		                  		border: 5px solid #555;*/
		                  	' />
                  <?php } ?>
                </div>
              <?php else : ?>
                <?php if ($visual_report[0]['status_inspection'] == 7 and ($access == 'clients' || $access == 'client')) { ?>
                  <img src="data:image/png;base64,<?= $user_sign['client']['sign_approval'] ?>" style='width: 3.5cm;vertical-align: text-bottom !important;' />
                <?php } ?>
              <?php endif; ?>
            </div>
            <?php // } 
            ?>
          </td>
          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none;"></td>
        </tr>
        <tr>
          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none;"></td>
        </tr>
        <tr>
          <td style="width: 25%; border: none;text-align: left;">
            <?php if (in_array($visual_report[0]['status_inspection'], $arr_sign_contra) and ($access == 'clients' || $access == 'client')) { ?>
              <?= $user_sign['inspector']['full_name'] ?>
            <?php } ?>
            <br>
            <b>__________________________</b>
          </td>
          <td style="width: 25%; border: none;"></td>

          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none;">
            <?php if ($visual_report[0]['status_inspection'] == 7 and ($access == 'clients' || $access == 'client')) { ?>
              <?= $user_sign['client']['full_name'] ?>
            <?php } ?>
            <br>
            <b>__________________________</b>
          </td>

          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none;">
            <b>__________________________</b>
          </td>

        </tr>
        <tr>
          <td style="width: 25%; border: none; padding-top: 10px;text-align: left;">
            <b>CONTRACTOR</b>
          </td>
          <td style="width: 25%; border: none; padding-top: 10px;">
            <b></b>
          </td>
          <td style="width: 25%; border: none; padding-top: 10px;">
            <b></b>
          </td>
          <td style="width: 25%; border: none; padding-top: 10px;">
            <b>EMPLOYER</b>
          </td>
          <td style="width: 25%; border: none; padding-top: 10px;">
            <b></b>
          </td>
          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none; padding-top: 10px;">
            <b>THIRD PARTY</b>
          </td>

        </tr>
        <tr>
          <td style="width: 25%; border: none;">
            DATE : <?= in_array($visual_report[0]['status_inspection'], $arr_sign_contra) ? DATE("d F Y", strtotime($show_date)) : '' ?>
          </td>
          <td style="width: 25%; border: none;">
          </td>

          <td style="width: 25%; border: none;">
          </td>
          <td style="width: 25%; border: none;">
            DATE : <?= $visual_report[0]['status_inspection'] == 7 ? DATE('d F, Y', strtotime($visual_report[0]['inspection_client_datetime'])) : '' ?>
          </td>
          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none;">
          </td>
          <td style="width: 25%; border: none;">
            DATE :
          </td>

        </tr>
      </tbody>
    </table>
  </div>
  <!-- </td>
    </tr>
  </table> -->
</body>

</html>