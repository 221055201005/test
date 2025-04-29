<?php

error_reporting(0);
$itr = $itr_list[0];

$is_ticked = 0;

$total_detail           = count($itr_list);
$total_approved_qc      = 0;
$total_approve_client   = 0;

foreach ($itr_list as $value) {
  if ($value['ticked_report_date'] == 1) {
    $is_ticked  = 1;
  }

  if ($value['status_inspection'] >= 3) {
    $total_approved_qc++;
  }

}

foreach($irn_list as $value) {
  $total_approve_client++;
}


$sign_smoe  = false;
if ($total_detail == $total_approved_qc) {
  $sign_smoe  = true;
}

$sign_client  = false;
if ($total_detail == $total_approve_client) {
  $sign_client  = true;
}


$report_no_pref  = $itr['submission_id'];

if($category == "report") {
  $report_no_pref = $report_no_format[$itr['project_code']][$itr['discipline']][$itr['module']][$itr['type_of_module']]['itr_no'].'-'.$itr['report_number'];

  if($itr['report_no_rev'] > 0) {
    $report_no_pref = $report_no_pref.' Rev.'.$list['report_no_rev'];
  }
} elseif($category== 'ndt'){
  $report_no_pref  = $ndt_rfi_no;
}

  // test_var($itr);
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
      margin-top: 6.56cm;
      margin-left: 1.4cm;
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
      top: 19cm;
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

    table td {
      
      word-wrap: break-word !important;
    }

    #table_content tr td {
      vertical-align: middle !important;
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


    <table width="100%" style="border-collapse: collapse !important;">
      <tr>
        <td style="vertical-align: middle !important;" width="75%">
          <span style="font-size:20px !important"><?= strtoupper($project[$itr['project_code']]['description']) ?></span>
        </td>
        <td style="vertical-align: middle !important;" rowspan="2">
          <center><img src="img/header_report.png" style='width: 350px; height: 60px;'></center>
        </td>
      </tr>
      <tr>
        <td style="vertical-align: middle !important;">
          <span style="font-size:18px !important"><?= $discipline[$itr['discipline']]['discipline_name'] ?> Inspection & Test Record</span>
        </td>
      </tr>
    </table>
    <br />

    <table cellpadding="4" style="width:100%; border-collapse: collapse !important" border="1">
      <tr>
        <td width="15%">Report No.</td>
        <td colspan="7"><?= $report_no_pref ?></td>
      </tr>
      <tr>
        <td>Drawing No.</td>
        <td colspan="7"><?= $itr['drawing_no'] ?></td>
      </tr>
      <tr>
        <td>Description</td>
        <td colspan="7"><?= $drawing['title'] ?></td>
      </tr>
      <tr>
        <td colspan="4" width="33.75%">
          DOCUMENT / SPECIFICATION / PROCEDURE No. / REFER to :
          <br>
          • 002752254 Rev. 04 - Part B Section 4 - Offshore Converter Platform
          <br>
          • 003720380 Rev. 05 - EIT ITP : (15) Visual Inspection Primary & Secondary Electrical, Instrument & Telecom (EIT) ITP
        </td>
        <td colspan="4">

          Acceptance Criteria :
          <br>
          • DNVGL-OS-C401
          <br>
          • DNVGL-CG-0051 Sec. 1.5
          <br>
          • EN ISO 5817 - Level C category)
        </td>
      </tr>
    </table>

  </header>

  <body>
    <table border="1" id="table_content" cellpadding="4" style="width:100%; border-collapse: collapse !important; text-align: center !important;">
      <tr>
        <td width="15%">ITEM DESCRIPTION</td>
        <td width="15%">PIECEMARK / TAG NO.</td>
        <td width="20%">UNIQUE NO.</td>
        <td width="10%">HEAT NO.</td>
        <td width="15%">WPS</td>
        <!-- <td width="15%">CONSUMABLE LOT NO.</td> -->
        <td width="15%">WELDER ID</td>
        <td width="15%">INSPECTION RESULT</td>
        <td width="15%">REMARK</td>
      </tr>
      <?php foreach ($itr_list as $key => $value) : ?>
        <tr>
          <td><?= $piecemark[$value['id_piecemark']]['profile'] ?></td>
          <td><?= $piecemark[$value['id_piecemark']]['part_id'] ?></td>
          <td><?= $mis[$value['id_mis']]['unique_no'] ?></td>
          <td><?= $mis[$value['id_mis']]['heat_or_series_no'] ?></td>
          <td>
            <?php if ($value['wps_id']) : ?>

              <?php

              $list_wps = [];
              foreach (explode(";", $value['wps_id']) as $v) {
                $list_wps[] = $wps[$v]['wps_no'];
              }

              ?>

              <?= implode(',<br>', $list_wps) ?>
            <?php endif; ?>
          </td>
          <!-- <td><?= implode(",<br>", explode(";", $value['cons_lot_no'])) ?></td> -->
          <td>
            <?php if ($value['welder_id']) : ?>

              <?php

              $list_welder = [];
              foreach (explode(";", $value['welder_id']) as $v) {
                $list_welder[] = $welder[$v]['rwe_code'];
              }

              ?>

              <?= implode(',<br>', $list_welder) ?>
            <?php endif; ?>
          </td>
          <td>
            <?php

                if ($value['status_inspection'] == 1) {
                  echo "PENDING";
                } elseif ($value['status_inspection'] == 2) {
                  echo "REJ";
                } elseif ($value['status_inspection'] == 3) {
                  echo "ACC";
                } elseif ($value['status_inspection'] == 4) {
                  echo "PENDING";
                } elseif ($value['status_inspection'] >= 5) {
                  echo "ACC";
                } elseif ($value['status_inspection'] == 6) {
                  echo "REJ";
                } elseif ($value['status_inspection'] == 7) {
                  echo "ACC";
                }

            // if ($category == "report") {
            //   if ($value['status_inspection'] == 5) {
            //     echo "SMOE Approved";
            //   } elseif ($value['status_inspection'] == 6) {
            //     echo "REJ";
            //   } elseif ($value['status_inspection'] == 7) {
            //     echo "ACC";
            //   } elseif ($value['status_inspection'] == 9) {
            //     echo "ACC";
            //   } elseif ($value['status_inspection'] == 10) {
            //     echo "POSTPONE";
            //   } elseif ($value['status_inspection'] == 11) {
            //     echo "RE-OFFER";
            //   }
            // } else {
            //   if ($value['status_inspection'] == 1) {
            //     echo "PENDING";
            //   } elseif ($value['status_inspection'] == 2) {
            //     echo "REJ";
            //   } elseif ($value['status_inspection'] == 3) {
            //     echo "ACC";
            //   } elseif ($value['status_inspection'] == 4) {
            //     echo "PENDING";
            //   } elseif ($value['status_inspection'] >= 5) {
            //     echo "ACC";
            //   } elseif ($value['status_inspection'] == 6) {
            //     echo "REJ";
            //   } elseif ($value['status_inspection'] == 7) {
            //     echo "ACC";
            //   }
            // }
            ?>
          </td>
          <td></td>
        </tr>
      <?php endforeach; ?>
      <tr>
        <td style="text-align: left !important">TOTAL PIECEMARK :</td>
        <td colspan="7"><?= $total_detail ?></td>
      </tr>
      <tr>
        <td colspan="8" style="text-align: left !important; vertical-align: top !important;" height="10%">REMARKS : <?= $itr['inspection_remarks'] ?></td>
      </tr>
    </table>
  </body>

  <br><br>
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

            <?php if ($sign_smoe) : ?>
              <img src="data:image/png;base64,<?= $user[$itr['inspection_by']]['sign_approval'] ?>" style='width: 3.5cm;vertical-align: text-bottom !important;' />
            <?php endif; ?>

          </td>
          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none; vertical-align: text-bottom !important;">
            <?php if ($sign_client && $category == "report") : ?>
                <img src="data:image/png;base64,<?= $user[$irn_list[0]['client_approval_by']]['sign_approval'] ?>" style='width: 3.5cm;vertical-align: text-bottom !important;' />
            <?php endif; ?>
          </td>
          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none;"></td>
        </tr>
        <tr>
          <td style="width: 25%; border: none;">
            <?php if ($sign_smoe) : ?>
              <?= $user[$itr['inspection_by']]['full_name'] ?>
            <?php endif; ?>
            <br>
            <b>_______________________</b>
          </td>
          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none;">
            <?php if ($sign_client && $category == "report") : ?>
              <?= $user[$irn_list[0]['client_approval_by']]['full_name'] ?>
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

            <?php if ($itr['inspection_datetime']) : ?>
              <?= date('Y-m-d', strtotime($itr['inspection_datetime'])) ?>
            <?php else : ?>
              <?= $itr['date_request'] ?>
            <?php endif; ?>


          </td>
          <td style="width: 25%; border: none;"></td>
          <td style="width: 25%; border: none;">DATE :
            <?php if ($sign_client && $category == "report") : ?>
              <?= $irn_list[0]['client_approval_date'] ? date('Y-m-d', strtotime($irn_list[0]['client_approval_date'])) : '' ?>
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
    <?php if ($itr['discipline'] == 2) : ?>
      SOF-QCF-ITR-001
    <?php else : ?>
      SOF-QCF-ITR-002
    <?php endif; ?>
  </footer>
</body>

</html>