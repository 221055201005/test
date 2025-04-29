<?php

error_reporting(0);
if ($main_material['discipline'] == 1) {
  $report_type  = "PIPING";
} else {
  $report_type  = "STRUCTURAL";
}


$is_ticked = 0;

foreach ($detail_material as $value) {
  if ($value['ticked_report_date'] == 1) {
    $is_ticked  = 1;
  }
}
if ($report_no) {
  $report_no_pref = $report_no_format[$main_material['project_code']][$main_material['discipline']][$main_material['module']][$main_material['type_of_module']]['mv_no'] . '-' . $report_no;

  if ($main_material['company_id'] == 13) {
    $report_no_pref = $report_no_format[$main_material['project_code']][$main_material['discipline']][$main_material['module']][$main_material['type_of_module']]['mv_no_smop'] . '-' . $report_no;
  }
} else {
  $report_no_pref = $main_material['submission_id'];
}


?>
<!DOCTYPE html>
<html>

<head>
  <style type="text/css">
    @page {
      margin: 0cm 0cm;
    }

    body {
      top: 0cm;
      left: 0cm;
      right: 0cm;
      margin-top: 5.2cm;
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
      padding-top: 1.4cm;
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
      word-wrap: break-word !important
    }

    .fs-10 {
      font-size: 8px !important;
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
        <td class="fs-10 bt bl">
          <b>CLIENT</b>
        </td>
        <td class="fs-10 bt" width="5px"><b>:</b></td>
        <td class="fs-10 bt" colspan="5"><?= $data_project['project_name'] ?></td>

        <td class="fs-10 bt bl" width="70px"><b>PROJECT CODE</b></td>
        <td class="fs-10 bt" width="5px"><b>:</b></td>
        <td class="bt br" colspan="5"><?= $data_project['project_code'] ?></td>
      </tr>
      <tr>
        <td class="fs-10  bl"><b>PROJECT</b></td>
        <td width="5px"><b>:</b></td>
        <td colspan="5"><?= strtoupper($data_project['description']) ?></td>

        <td class="fs-10  bl"><b>REPORT NO.</b></td>
        <td width="5px"><b>:</b></td>
        <td class="br" colspan="5">
          <?php
          $report_no_rev = '';

          if ($main_material['report_no_rev'] > 0) {
            $report_no_rev = 'Rev. ' . $main_material['report_no_rev'];
          }
          ?>

          <?php if ($report_no) : ?>

            <?php

            $report_no_pref = $report_no_format[$main_material['project_code']][$main_material['discipline']][$main_material['module']][$main_material['type_of_module']]['mv_no'] . '-' . $report_no;

            if ($main_material['company_id'] == 13) {
              $report_no_pref = $report_no_format[$main_material['project_code']][$main_material['discipline']][$main_material['module']][$main_material['type_of_module']]['mv_no_smop'] . '-' . $report_no;
            }

            ?>
            <?= $report_no_pref ?> <?= $report_no_rev ?>
          <?php else : ?>
            <?= $main_material['submission_id'] ?>
          <?php endif; ?>
        </td>
      </tr>
      <tr>
        <td class="fs-10 bl" style="width: 60px !important;"><b>DRAWING NO.</b></td>
        <td width="5px"><b>:</b></td>

        <?php

        // $drawing_ga_rev = "";

        // if($is_client) {
        // if($main_material['ga_rev_no'] != '') {
        //   $drawing_ga_rev = "<br/>Rev. ".$main_material['ga_rev_no'];
        // } else {
        //   $drawing_ga_rev = "<br/>Rev. ".$drawing_rev[$main_material['drawing_no']];
        // }
        // }

        if ($main_material['ga_rev_no'] != '') {
          $drawing_ga_rev = 'Rev. ' . $main_material['ga_rev_no'];
        } else {
          $drawing_ga_rev = 'Rev. ' . $main_material['rev_ga'];
        }

        if ($is_client) {
          if (isset($client_doc_no[$main_material['drawing_no']]) && !empty($client_doc_no[$main_material['drawing_no']])) {
            $clien_doc_no = " ( " . $client_doc_no[$main_material['drawing_no']] . " )";
          }
        }

        ?>

        <td colspan="5"><?= $main_material['drawing_no'] ?> <?= $drawing_ga_rev ?> <?= $clien_doc_no ?></td>

        <td class="fs-10  bl"><b>AREA</b></td>
        <td width="5px"><b>:</b></td>
        <td class="br" colspan="5">
          <?php if ($main_material['area_v2']) : ?>
            <?= $area_v2[$main_material['area_v2']]['name'] ?>

            <?php if (isset($location_v2[$main_material['location_v2']])) : ?>
              , <?= $location_v2[$main_material['location_v2']]['name'] ?>

              <?php if (isset($point_v2[$main_material['point_v2']])) : ?>
                , <?= $point_v2[$main_material['point_v2']]['name'] ?>

              <?php endif; ?>

            <?php endif; ?>
          <?php else : ?>
            <?= $area_name[$main_material['area']] ?>
          <?php endif; ?>

        </td>
      </tr>

      <?php if ($main_material['drawing_as']) : ?>
        <tr>
          <td class="fs-10 bl" style="width: 60px !important;"></td>
          <td width="5px"><b>:</b></td>
          <td colspan="5">
            <?php

            $drawing_as_rev = "";

            if ($main_material['as_rev_no'] != '') {
              $drawing_as_rev = "<br/>Rev. " . $main_material['as_rev_no'];
            } else {
              $drawing_as_rev = "<br/>Rev. " . $main_material['rev_as'];
            }

            // if($is_client) {
            // if($main_material['as_rev_no'] != '') {
            //   $drawing_as_rev = "<br/>Rev. ".$main_material['as_rev_no'];
            // } else {
            //   $drawing_as_rev = "<br/>Rev. ".$drawing_rev[$main_material['drawing_as']];
            // }
            // }



            if ($is_client) {
              if (isset($client_doc_no[$main_material['drawing_as']]) && !empty($client_doc_no[$main_material['drawing_as']])) {
                $clien_doc_no_as = " ( " . $client_doc_no[$main_material['drawing_as']] . " )";
              }
            }

            ?>
            <?= $main_material['drawing_as'] ?> <?= $drawing_as_rev ?> <?= $clien_doc_no_as ?></td>

          <td class="fs-10  bl"></td>
          <td width="5px"></td>
          <td class="br" colspan="5"></td>

        </tr>
      <?php endif; ?>


      <?php foreach (range(1, 8) as $key => $value) : ?>
        <tr>

          <td class=" bl"><b></b></td>
          <td width="5px"><b></b></td>
          <td class=" br" colspan="5"></td>

          <td class=" bl"><b></b></td>
          <td width="5px"><b></b></td>
          <td class=" br" colspan="5"></td>
        </tr>
      <?php endforeach; ?>

      <tr>
        <td class="ball text-center fs-10" colspan="2" style="vertical-align: middle;">
          <b>PIECE MARK / SPOOL NO.</b>
        </td>
        <td class="ball text-center fs-10" style="width: 60px; vertical-align: middle;">
          <b>MATERIAL DESCRIPTION</b>
        </td>
        <td class="ball text-center fs-10" style="width: 40px; vertical-align: middle;">
          <b>SIZE / DIA</b>
        </td>
        <td class="ball text-center fs-10" style="width: 40px; vertical-align: middle;">
          <b>LENGTH <br> (MM)</b>
        </td>
        <td class="ball text-center fs-10" style="width: 40px; vertical-align: middle;">
          <b>SCH</b>
        </td>
        <td class="ball text-center fs-10" style="width: 40px; vertical-align: middle;">
          <b>THK <br> (MM)</b>
        </td>

        <td class="ball text-center fs-10" colspan="2" style="vertical-align: middle;">
          <b>UNIQUE NO.</b>
        </td>
        <td class="ball text-center fs-10" style=" vertical-align: middle;">
          <b>HEAT NO.</b>
        </td>
        <td class="ball text-center fs-10" style="vertical-align: middle; width:48px">
          <b>MATERIAL SPEC</b>
        </td>
        <td class="ball text-center fs-10" style="vertical-align: middle; width:60px">
          <b>MRIR NO.</b>
        </td>
        <td class="ball text-center fs-10" style="vertical-align: middle;">
          <b>MILL CERTIFICATE NO.</b>
        </td>
        <td class="ball text-center fs-10" style="vertical-align: middle;">
          <b>REMARKS</b>
        </td>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($detail_material as $key => $value) : ?>
        <?php
        $uniq_pip_list   = [];
        $heat_pip_list   = [];
        $mrir_pip_list   = [];
        $mill_pip_list   = [];
        ?>
        <tr>
          <td class="ball text-center fs-10 valign-middle" colspan="2"><?= $value['part_id'] ?></td>
          <td class="ball text-center fs-10 valign-middle" style=" word-wrap: break-word;"><?= $value['profile'] ?></td>
          <td class="ball text-center fs-10 valign-middle"><?= $value['diameter'] ?></td>
          <td class="ball text-center fs-10 valign-middle"><?= $value['length'] ?></td>
          <td class="ball text-center fs-10 valign-middle"><?= $value['sch'] ?></td>
          <td class="ball text-center fs-10 valign-middle"><?= $value['thickness'] ?></td>
          <td class="ball text-center fs-10 valign-middle" colspan="2">
            <?php if ($value['piping_testing_category'] == 1) : ?>
              <?php
              foreach (explode(";", $value['id_mis_piping']) as $v) {
                $uniq_pip_list[] = $detail_mis[$v]['unique_no'];
              }
              ?>
              <?= implode(",<br>", $uniq_pip_list) ?>

            <?php else : ?>
              <?= $detail_mis[$value['id_mis']]['unique_no'] ?>
            <?php endif; ?>
          </td>
          <td class="ball text-center fs-10 valign-middle">
            <?php if ($value['piping_testing_category'] == 1) : ?>
              <?php
              foreach (explode(";", $value['id_mis_piping']) as $v) {
                $heat_pip_list[] = $detail_mis[$v]['heat_or_series_no'];
              }
              ?>
              <?= implode(",<br>", $heat_pip_list) ?>
            <?php else : ?>
              <?= $detail_mis[$value['id_mis']]['heat_or_series_no'] ?>
            <?php endif; ?>
          </td>
          <td class="ball text-center fs-10 valign-middle">
            <?= $material_grade[$value['grade']] ?>
          </td>

          <td class="ball text-center fs-10 valign-middle">
            <?php if ($value['piping_testing_category'] == 1) : ?>
              <?php
              foreach (explode(";", $value['id_mis_piping']) as $v) {
                $mrir_no =  $detail_mis[$v]['report_no'];
                $partial_report_no = "";

                if ($detail_mis[$v]['partial_report_no'] > 0) {
                  $partial_report_no  = '-' . $detail_mis[$v]['partial_report_no'];
                }

                $mrir_no = explode("/", $mrir_no)[1] . $partial_report_no;

                $mrir_pip_list[] = $mrir_no;
              }
              ?>
              <?= implode(",<br>", $mrir_pip_list) ?>
            <?php else : ?>
              <?php
              $mrir_no =  $detail_mis[$value['id_mis']]['report_no'];

              $partial_report_no = "";

              if ($detail_mis[$value['id_mis']]['partial_report_no'] > 0) {
                $partial_report_no  = '-' . $detail_mis[$value['id_mis']]['partial_report_no'];
              }

              $mrir_no = explode("/", $mrir_no)[1] . $partial_report_no;
              ?>

              <?= $mrir_no ?>
            <?php endif; ?>
          </td>


          <td class="ball text-center fs-10 valign-middle">
            <?php if ($value['piping_testing_category'] == 1) : ?>
              <?php
              foreach (explode(";", $value['id_mis_piping']) as $v) {
                $mill_pip_list[] = $detail_mis[$v]['mill_cert_no'];
              }
              ?>
              <?= implode(",<br>", $mill_pip_list) ?>
            <?php else : ?>
              <?= $detail_mis[$value['id_mis']]['mill_cert_no'] ?>
            <?php endif; ?>
          </td>
          <td class="ball text-center fs-10 valign-middle"><?= $value['drawing_sp'] ?>
            <?php if ($value['remarks']) : ?>
              <!-- <br>
             <?= $value['remarks'] ?> -->
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <?php if ($main_material['project_code'] == 14) { ?>
    <br><br>
    <div style="page-break-inside: avoid;">
      <table border="1" cellpadding="5" style="border-collapse: collapse; width:100%">
        <tr>
          <td style="min-height: 70px !important">
            <b>Note/Remarks:</b>
            <br>
            <br>
            <?= $main_material['accepted_remarks'] ?>
          </td>
        </tr>
      </table>
    </div>
  <?php } ?>


  <br><br>
  <div style="page-break-inside: avoid;">
    <table class="table-body" width="100%" style="text-align: left;border-collapse: collapse !important; padding-top: -0.8px;">
      <tbody>
        <tr>
          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none;"></td>
        </tr>
        <tr style="vertical-align: text-bottom !important;">
          <td style="width: 25%; border: none; vertical-align: text-bottom !important;">

            <?php if ($sign_contractor) : ?>
              <img src="data:image/png;base64,<?= $user[$main_material['inspection_by']]['sign_approval'] ?>" style='width: 3.5cm;vertical-align: text-bottom !important;' />
            <?php endif; ?>

          </td>
          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none; vertical-align: text-bottom !important;">
            <?php if ($is_client) : ?>
              <?php if ($sign_client) : ?>
                <img src="data:image/png;base64,<?= $user[$main_material['inspection_client_by']]['sign_approval'] ?>" style='width: 3.5cm;vertical-align: text-bottom !important;' />
              <?php endif; ?>
            <?php endif; ?>
          </td>
          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none;"></td>
        </tr>
        <tr>
          <td style="width: 25%; border: none;">
            <?php if ($sign_contractor) : ?>
              <?= $user[$main_material['inspection_by']]['full_name'] ?>
            <?php endif; ?>
            <br>
            <b>_______________________</b>
          </td>
          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none;">
            <?php if ($is_client) : ?>
              <?php if ($sign_contractor) : ?>
                <?= $user[$main_material['inspection_client_by']]['full_name'] ?>
              <?php endif; ?>
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
          <td style="width: 25%; border: none; padding-top: 10px;"><b>THIRD PARTY <strong><i><span style="font-size: 6px; !important"> (if any)</span></i></strong></b></td>
        </tr>
        <tr>
          <td style="width: 25%; border: none;">DATE :

            <?php if ($sign_contractor) : ?>
              <?php if ($is_ticked) : ?>
                <?= date('Y-m-d', strtotime($main_material['document_approval_date'])) ?>
              <?php else : ?>
                <?= date('Y-m-d', strtotime($main_material['inspection_datetime'])) ?>
              <?php endif; ?>
            <?php else : ?>
              <?= $main_material['date_request'] ?>
            <?php endif; ?>

          </td>
          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none;">DATE :
            <?php if ($is_client) : ?>
              <?= $sign_client ? date('Y-m-d', strtotime($main_material['inspection_client_datetime'])) : '' ?>
            <?php endif; ?>
          </td>
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
  </div>

  <footer>
    <?php if ($main_material['discipline'] == 2) : ?>
      SOF-QCF-MTR-001
    <?php elseif ($main_material['discipline'] == 1) : ?>
      SOF-QCF-MTR-002
    <?php endif; ?>
  </footer>
</body>

</html>