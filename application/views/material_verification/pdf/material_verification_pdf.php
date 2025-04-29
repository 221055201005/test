<?php

error_reporting(0);
if ($main_material['discipline'] == 1) {
  $report_type  = "PIPING";
} else {
  $report_type  = "STRUCTURAL";
}

$checked_type               = "";

$legend_inspection          = explode(";", $main_material['legend_inspection_auth']);
if ($legend_inspection[0] == 1) {
  $checked_type             = "hold";
} elseif ($legend_inspection[1] == 1) {
  $checked_type             = "witness";
} elseif ($legend_inspection[2] == 1 || $legend_inspection[3] == 1) {
  $checked_type             = "review";
}


$is_ticked = 0;

foreach ($detail_material as $value) {
  if ($value['ticked_report_date'] == 1) {
    $is_ticked  = 1;
  }
}
if ($report_no) {
  if (in_array($main_material['project_code'], project_by_deck())) {
    $report_no_pref = $report_no_format[$main_material['project_code']][$main_material['company_id']][$main_material['discipline']][$main_material['module']][$main_material['type_of_module']][$main_material['deck_elevation']]['mv_no'] . '-' . $report_no;
  } else {
    $report_no_pref = $report_no_format[$main_material['project_code']][$main_material['company_id']][$main_material['discipline']][$main_material['module']][$main_material['type_of_module']]['mv_no'] . '-' . $report_no;
  }

  if ($main_material['company_id'] == 13) {
    $report_no_pref = $report_no_format[$main_material['project_code']][$main_material['company_id']][$main_material['discipline']][$main_material['module']][$main_material['type_of_module']]['mv_no_smop'] . '-' . $report_no;
  }
} else {
  $report_no_pref = $main_material['submission_id'];
}


?>
<!DOCTYPE html>
<html>

<head>
  <title>
    <?= $report_no_pref ?>
  </title>
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

    .v_middle {
      vertical-align: middle !important;
    }

    .text-left {
      text-align: left;
    }

    .text-right {
      text-align: right;
    }

    .text-center {
      text-align: center;
    }

    input[type=checkbox] {
      -ms-transform: scale(1.7);
      -moz-transform: scale(1.7);
      -webkit-transform: scale(1.7);
      -o-transform: scale(1.7);
      transform: scale(1.7);
    }

    /* FOR STAMP */

    .color_stamp {
      color: rgba(63, 72, 204, 255);
    }

    .border_stamp {
      border: 3px solid rgba(63, 72, 204, 255);
    }

    .box_stamp {
      padding: 4px;
      font-weight: bold;
      margin-left: -30px !important;
      width: 190px;
      z-index: 99 !important;
    }

    .valign_middle {
      vertical-align: middle !important;
    }
  </style>
</head>

<body>

  <header>


    <table width="100%" style="border-collapse: collapse !important; border: 1px solid black">
      <tr>

        <td class="v_middle text-left" width="20%">
          <img src="img/seatrium_logo_bg_white.png" style="width: 140px; padding-left: 10px !important;">
        </td>
        <td class="v_middle text-center" width="60%">
          <h3 style="font-size: 18px !important;"><?= $project_list[$main_material['project_code']]['description'] ?></h3>
        </td>
        <td class="v_middle text-right" width="20%">
          <img src="<?= $project_list[$main_material['project_code']]['client_logo'] ?>" style="width: 110px;padding-right: 10px !important;">

        </td>
      </tr>
    </table>
    <br />
    <table>
      <tr>
        <td style="padding-bottom: 4px;"><b><u><?= $report_type ?><?= ($main_material['project_code'] == 17 ? ' MATERIAL TRACEABILITY REPORT' : ' MATERIAL VERIFICATION REPORT'); ?>
            </u></b></td>
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
          <?php if ($main_material['project_code'] ==  19 || $main_material['project_code'] ==  21) { ?>
            <b>Company</b>
          <?php } elseif ($main_material['project_code'] == 17) { ?>
            <b>Client</b>
          <?php } ?>
        </td>
        <td class="fs-10 bt" width="5px"><b>:</b></td>
        <td class=" bt" colspan="5"><?= $project_list[$main_material['project_code']]['client'] ?></td>

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

            // $report_no_pref = $report_no_format[$main_material['project_code']][$main_material['company_id']][$main_material['discipline']][$main_material['module']][$main_material['type_of_module']]['mv_no'] . '-' . $report_no;

            // if ($main_material['company_id'] == 13) {
            //   $report_no_pref = $report_no_format[$main_material['project_code']][$main_material['company_id']][$main_material['discipline']][$main_material['module']][$main_material['type_of_module']]['mv_no_smop'] . '-' . $report_no;
            // }

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

        <td class="fs-10  bl"><b>DATE OF INSPECTION</b></td>
        <td width="5px"><b>:</b></td>
        <td class="br" colspan="5"><?= $main_material['inspection_datetime'] == '' ? '' : date('Y-m-d', strtotime($main_material['inspection_datetime'])) ?></td>
      </tr>

      <tr>
        <?php if ($main_material['drawing_as']) : ?>
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
            <?= $main_material['drawing_as'] ?> <?= $drawing_as_rev ?> <?= $clien_doc_no_as ?>
          </td>
        <?php else : ?>
          <td class="fs-10  bl"></td>
          <td width="5px"></td>
          <td class="br" colspan="5"></td>
        <?php endif; ?>
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

    
      <?php 
        $no = 1;
        $count_client_approve = 0;
        $count_client_reject  = 0;
        $count_all_Data       = 0;
        $count_client_pending = 0;
        foreach ($detail_material as $key => $value) : 
      ?>

      <?php

      if($value['status_inspection'] == 5) {
        $count_client_pending++;
      }
      if ($value['status_inspection'] == 7) {
        $count_client_approve++;
      }
      if ($value['status_inspection'] == 6) {
        $count_client_reject++;
      }
      $count_all_Data++;

      ?>
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
            <?php if ($value['remarks'] && $value['status_inspection'] != 6) : ?>
              <!-- <br>
             <?= $value['remarks'] ?> -->
             <?php elseif($value['status_inspection'] == 6 && $value['rejected_client_remarks']) : ?>
              <?= $value['rejected_client_remarks'] ?>
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

  <?php $sisa_pending_client  = $count_all_Data - $count_client_approve;  ?>
  <?php 
      // $sisa_reject_client   = $count_all_Data - $count_client_reject;
      $sisa_reject_client       = $count_client_pending <= 0 && $count_client_reject > 0 ? 0 : 999;
  ?>

  <div style="page-break-inside: avoid;">
    <table class="table-body" width="100%" style="text-align: left;border-collapse: collapse !important; padding-top: -0.8px;">
      <tbody>
        <tr>
          <?php if ($main_material['company_id'] == 5) : ?>
            <td style="width: 25%; border: none;"></td>
            <td style="width: 25%; border: none;"></td>
          <?php endif; ?>
          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none;">
              <?php
                  if ($sisa_pending_client <= 0 && $main_material['status_inspection'] >= 5 ) {
                      if ($main_material['add_comment'] == 1) {
                          echo "<b>Approved By :</b>";
                      } elseif ($main_material['add_comment'] == 2) {
                          echo "<b>Witnessed By :</b>";
                      } elseif ($main_material['add_comment'] == 3) {
                          echo "<b>Reviewed By :</b>";
                      }
                  } elseif ($sisa_reject_client <= 0 && $main_material['status_inspection'] >= 5 ) {
                      echo "<b>Rejected By :</b>";
                  }
              ?>
          </td>
          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none;"></td>
        </tr>

        <tr style="vertical-align: text-bottom !important;">
          <?php if ($main_material['company_id'] == 5) : ?>
            <td style="width: 25%; border: none; vertical-align: text-bottom !important;">
              <img src="data:image/png;base64,<?= $requestor['sign_approval'] ?>" style='width: 2cm;vertical-align: text-bottom !important;' />
            </td>
            <td style="width: 25%; border: none;"></td>
          <?php endif; ?>


          <td style="width: 25%; border: none; vertical-align: text-bottom !important;">
            <?php if ($sign_contractor) : ?>
              <img src="data:image/png;base64,<?= $user['sign_approval'] ?>" style='width: 2cm;vertical-align: text-bottom !important;' />
            <?php endif; ?>
          </td>

          <td style="width: 25%; border: none;"></td>

          <td style="width: 25%; border: none; vertical-align: text-bottom !important;">
            <?php if ($is_client) : ?>
              <?php if ($main_material['project_code'] == 17) : ?>
                <div class="box color_stamp border_stamp box_stamp">
                  <center>
                    <img src="img/orsted_stamp.png" style="width:35px">
                    <br>
                    <strong>CHW 2204 OSS Project</strong>
                  </center>
                  <table cellpadding="0" style="width:100%;">
                    <tr>
                      <td width="40%" class="valign_middle">Review</td>
                      <td><input type="checkbox" style="margin-bottom: 8px" <?= $checked_type == "review" ? 'checked' : '' ?>></td>
                    </tr>
                    <tr>
                      <td width="40%" class="valign_middle">Witness</td>
                      <td><input type="checkbox" style="margin-bottom: 8px" <?= in_array($checked_type, ["witness", "hold"]) ? 'checked' : '' ?>></td>
                    </tr>
                    <tr>
                      <td width="40%" class="valign_middle">Inspect</td>
                      <td><input type="checkbox" style="margin-bottom: 8px" <?= $checked_type == "hold" ? 'checked' : '' ?>></td>
                    </tr>
                  </table>
                  <br>
                  Date : <?= $sign_client ? date('Y-m-d', strtotime($main_material['inspection_client_datetime'])) : space(15) ?>
                  &nbsp;
                  <span style="z-index: 99 !important;">Signature :</span>

                </div>
                <div class="text-right" style="padding-right: 5px; padding-bottom:3px;">
                  <?php if ($sign_client) : ?>
                    <img src="data:image/png;base64, <?= $user_client['sign_approval'] ?>" style='width: 4.5cm; height: 2.8cm; position: absolute; margin-left: 40px !important; margin-top: -115px !important; z-index: -99 !important; ' />
                  <?php endif; ?>
                </div>
              <?php else : ?>
                <?php if ($sign_client) : ?>
                  <img src="data:image/png;base64,<?= $user_client['sign_approval'] ?>" style='width: 3.5cm;vertical-align: text-bottom !important;' />
                <?php elseif ($sign_client_reject) : ?>
                  <img src="data:image/png;base64,<?= $user_client_reject['sign_approval'] ?>" style='width: 3.5cm;vertical-align: text-bottom !important;' />
                <?php endif; ?>
              <?php endif; ?>
            <?php endif; ?>
          </td>

          <td style="width: 25%; border: none;"></td>

          <td style="width: 25%; border: none;"></td>
        </tr>
        <!-- =============================================================== -->
        <!-- =============================================================== -->
        <tr>
          <?php if ($main_material['company_id'] == 5) : ?>
            <br>
            <td style="width: 25%; border: none;">
              <?= $requestor['full_name'] ?>
              <br>
              <b>_______________________</b>
            </td>
            <td style="width: 25%; border: none;"></td>
          <?php endif; ?>


          <td style="width: 25%; border: none;">
            <br>
            <?php if ($sign_contractor) : ?>
              <?= $user['full_name'] ?>
            <?php endif; ?>
            <br>
            <b>_______________________</b>
          </td>

          <td style="width: 25%; border: none;"></td>

          <td style="width: 25%; border: none;">
            <?php if ($is_client) : ?>
              <?= $sign_client ? $user_client['full_name'] : ($sign_client_reject ? $user_client_reject['full_name'] : '') ?>
            <?php endif; ?>
            <br>
            <b>_______________________</b>
          </td>

          <td style="width: 25%; border: none;"></td>

          <td style="width: 25%; border: none;"><br><b>_______________________</b></td>
        </tr>
        <!-- =============================================================== -->
        <!-- =============================================================== -->
        <tr>
          <?php if ($main_material['company_id'] == 5) : ?>
            <td style="width: 25%; border: none; padding-top: 10px;"><b>DSAW</b></td>
            <td style="width: 25%; border: none; padding-top: 10px;"><b></b></td>
          <?php endif; ?>
          <td style="width: 25%; border: none; padding-top: 10px;"><b>CONTRACTOR</b></td>
          <td style="width: 25%; border: none; padding-top: 10px;"><b></b></td>

          <?php if ($main_material['project_code'] == 19 || $main_material['project_code'] == 21) { ?>
            <td style="width: 25%; border: none; padding-top: 10px;"><b>COMPANY</b></td>
          <?php  } ?>
          <?php if ($main_material['project_code'] == 17) { ?>
            <td style="width: 25%; border: none; padding-top: 10px;"><b>EMPLOYER</b></td>
          <?php  } ?>

          <td style="width: 25%; border: none; padding-top: 10px;"><b></b></td>
          <td style="width: 25%; border: none; padding-top: 10px;"><b>THIRD PARTY <strong><i><span style="font-size: 6px; !important"> (if any)</span></i></strong></b></td>
        </tr>
        <!-- =============================================================== -->
        <!-- =============================================================== -->
        <tr>
          <?php if ($main_material['company_id'] == 5) : ?>
            <td style="width: 25%; border: none;">DATE :
              <?= DATE('d F Y', strtotime($main_material['date_request'])) ?>
            </td>
            <td style="width: 25%; border: none;"></td>
          <?php endif; ?>


          <td style="width: 25%; border: none;">DATE :
            <?php if ($sign_contractor) : ?>
              <?php if ($is_ticked) : ?>
                <?= DATE('d F Y', strtotime($main_material['document_approval_date'])) ?>
              <?php else : ?>
                <?= DATE('d F Y', strtotime($main_material['inspection_datetime'])) ?>
              <?php endif; ?>
            <?php else : ?>
              <?= $main_material['date_request'] ?>
            <?php endif; ?>
          </td>

          <td style="width: 25%; border: none;"></td>

          <td style="width: 25%; border: none;">DATE :
          <?php if ($is_client && ($sign_client || $sign_client_reject)) : ?>
              <?= DATE('d F Y', strtotime($main_material['inspection_client_datetime'])) ?>
          <?php endif; ?>
          </td>

          <td style="width: 25%; border: none;"></td>

          <td style="width: 25%; border: none;">DATE :</td>
        </tr>
        <!-- =============================================================== -->
        <!-- =============================================================== -->
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