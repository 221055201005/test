<?php

error_reporting(0);

$main             = $list[0];
$report_no        = $main['report_number'];

$location_name    = $area[$main['area']]['name'];
if ($main['location']) {
  $location_name  .= ', ' . $location[$main['location']]['name'];
}

$isometric_no     = $joint[$main['id_joint']]['drawing_no'] . ' Rev.' . $joint[$main['id_joint']]['rev_no'];
$ecodoc_no = '';
if(@$data_drawing[$joint[$main['id_joint']]['drawing_no']]['client_doc_no'] != ''){
    $ecodoc_no = ' ('.$data_drawing[$joint[$main['id_joint']]['drawing_no']]['client_doc_no'].')';
}

$isometric_no     = $joint[$main['id_joint']]['drawing_no'] . ' Rev.' . $joint[$main['id_joint']]['rev_no'] . $ecodoc_no;

$allow_sign       = false;
$total_approved   = 0;

foreach ($list as $value) {
  if ($value['status_inspection'] >= 3) {
    $total_approved++;
  }
}

if ($total_approved == count($list)) {
  $allow_sign = true;
}

$view_report_num = $report_number_format[$main['project']][$main['discipline']][$main['module']][$main['type_of_module']]['bonstrand_report'];
// test_var($report_no_format);

if ($main['company_id'] == 13) {
  $view_report_num = $report_number_format[$main['project']][$main['discipline']][$main['module']][$main['type_of_module']]['bonstrand_rfi_report_scm'];
}

$view_report_num = $view_report_num . $main['report_number'];


?>
<!DOCTYPE html>
<html>

<head>
  <title>
    <?= $report_no ?>
  </title>
  <style type="text/css">
    @page {
      margin: 0cm 0cm;
    }


    body {
      top: 0cm;
      left: 0cm;
      right: 0cm;
      margin-top: 7.30cm;
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

    .text_nowrap {
      white-space: nowrap !important;
    }
  </style>
</head>

<body>

  <header>


    <table width="100%" border="1" style="border-collapse: collapse !important;">
      <tr>

        <td style="vertical-align: middle !important;">
          <center><img src="img/header_report.png" style='width: 350px; height: 60px;'></center>
        </td>
      </tr>
      <tr>
        <td style="vertical-align: middle !important; text-align: center; font-size: 13px !important;">BONDSTRAND ADHESIVE ASSEMBLY REPORT</td>
      </tr>

    </table>
    <br />
    <table cellpadding="4" style="width:100%; border-collapse: collapse !important" border="1">
      <tr>
        <td style="width:70%">
          <table style="width:100%">
            <tr>
              <td style="width:100px">Project</td>
              <td style="width:20px">:</td>
              <td><?= $project[$main['project']]['project_name'] ?></td>

              <td style="width:100px">Company</td>
              <td style="width:20px">:</td>
              <td><?= $company[$workpack[$main['id_workpack']]['company_id']]['company_name'] ?></td>
            </tr>

            <tr>
              <td>Product Series/Rating</td>
              <td>:</td>
              <td><?= $main['product_series_rating'] ?></td>

              <td>Location</td>
              <td>:</td>
              <td><?= $location_name ?></td>
            </tr>

            <tr>
              <td>Reference Procedure</td>
              <td>:</td>
              <td>ASTM D2563 Level I,II,III & QC-04 (004238917-01)</td>

              <td>Date</td>
              <td>:</td>
              <td><?= $main['adhesive_time_start'] ? date('Y-m-d', strtotime($main['adhesive_time_start'])) : '' ?></td>
            </tr>

            <tr>
              <td>Title</td>
              <td>:</td>
              <td><?= $data_drawing[$joint[$main['id_joint']]['drawing_no']]['title'] ?></td>

              <td>Report No.</td>
              <td>:</td>
              <td><?= $view_report_num ?></td>
            </tr>

            <tr>
              <td>Isometric No.</td>
              <td>:</td>
              <td><?= $isometric_no ?></td>

              <td></td>
              <td></td>
              <td></td>
            </tr>

          </table>
        </td>
        <td style="width:15%; vertical-align: middle !important;">
          <img src="img/baa1.png" style="width:140px">
        </td>
        <td style="width:15%; vertical-align: middle !important;">
          <img src="img/baa2.png" style="width:140px">
        </td>
      </tr>
    </table>


  </header>

  <body>
    <table border="1" id="table_content" cellpadding="4" style="width:100%; border-collapse: collapse !important; text-align: center !important;font-size : 8px !important">
      <thead>
        <tr>
          <td rowspan="3">NO</td>
          <td colspan="3">ISOMETRIC</td>
          <td rowspan="3">BONDER ID</td>
          <td colspan="3">FIT UP & JOINT PREPARATION</td>
          <td colspan="7">ADHESIVE BONDED JOINT</td>
          <td colspan="3">JOINT CURING</td>
          <td colspan="2">ENV</td>
          <td rowspan="3">INSPECTION RESULT</td>
          <td rowspan="3">REMARKS</td>
        </tr>
        <tr>
          <td rowspan="2">JOINT NO</td>
          <td rowspan="2">SPOOL NO</td>
          <td rowspan="2">OD (INCH)</td>
          <td rowspan="2">SANDING <br> (40-60 GRIT)</td>
          <td rowspan="2">CLEAN & DRY</td>
          <td rowspan="2">ALIGNMENT</td>
          <td colspan="2">BATCH NO OF ADHESIVE</td>
          <td rowspan="2">ADHESIVE TYPE</td>
          <td colspan="2">TIME</td>
          <td colspan="2">INSERTION <br> DEPTH</td>
          <td rowspan="2">TEMP <br> (DEG C)</td>
          <td colspan="2">TIME</td>
          <td rowspan="2">HUM <br> (%)</td>
          <td rowspan="2">TEMP <br> (DEG C)</td>
        </tr>
        <tr>
          <td>R</td>
          <td>H</td>
          <td>START</td>
          <td>FINISH</td>
          <td>SPEC (MM)</td>
          <td>ACTUAL (MM)</td>
          <td>START</td>
          <td>FINISH</td>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1;
        foreach ($list as $key => $value) : ?>
          <?php

          ?>
          <tr>
            <td>
              <?= $no++ ?>
            </td>
            <td><?= $joint[$value['id_joint']]['joint_no'] ?></td>
            <td class="text_nowrap">
              <?= $piecemark[$joint[$value['id_joint']]['pos_1']]['spool_no'] ?>
              <hr />
              <?= $piecemark[$joint[$value['id_joint']]['pos_2']]['spool_no'] ?>
            </td>
            <td><?= $joint[$value['id_joint']]['diameter'] ?></td>
            <td>
              <?php

              $bonders  = [];
              foreach (explode(";", $value['bonder_id']) as $v) {
                $bonders[] = $bonder[$v]['bonder_id'];
              }

              ?>

              <?= implode(',<br>', $bonders) ?>
            </td>
            <td><?= $value['sanding_40_60'] ?></td>
            <td><?= $value['clean_dry'] ?></td>
            <td class="text_nowrap">
              <?= $piecemark[$joint[$value['id_joint']]['pos_1']]['material'] ?>
              <hr />
              <?= $piecemark[$joint[$value['id_joint']]['pos_2']]['material'] ?>
            </td>
            <td>
              <?= $value['adhesive_r'] ?>
            </td>
            <td>
              <?= $value['adhesive_h'] ?>
            </td>

            <td>
              <?= $value['adhesive_type'] ?>
            </td>
            <td><?= date('h:i A', strtotime($value['adhesive_time_start'])) ?></td>
            <td><?= date('h:i A', strtotime($value['adhesive_time_stop'])) ?></td>

            <td>
              <?= $value['depth_spec'] ?>
            </td>
            <td>
              <?= $value['depth_actual'] ?>
            </td>

            <td>
              <?= $value['curing_temp'] ?>
            </td>

            <td>
              <?= date('h:i A', strtotime($value['curing_start'])) ?>
            </td>

            <td>

              <?= date('h:i A', strtotime($value['curing_finish'])) ?>
            </td>

            <td>

              <?= $value['env_hum'] ?>
            </td>
            <td>

              <?= $value['env_temp'] ?>
            </td>
            <td>
              <?php if ($value['status_inspection'] == 1) : ?>
                OS
              <?php elseif ($value['status_inspection'] == 2) : ?>
                REJ
              <?php elseif ($value['status_inspection'] == 3 || $value['status_inspection'] >= 5) : ?>
                ACC
              <?php endif; ?>
            </td>
            <td>
              <?= $value['inspection_remarks'] ?>
            </td>

          </tr>
        <?php endforeach; ?>
      </tbody>

    </table>

		<br>
		<table class="table-body" width="100%" style="text-align: left;border-collapse: collapse !important;">
			<tbody>
				<tr>
					<td style="width: 25%; border: none;"></td>
					<td style="width: 25%; border: none;"></td>
					<td style="width: 25%; border: none;"></td>
					<td style="width: 25%; border: none;"></td>
				</tr>
				<tr style="vertical-align: text-bottom !important;">
					<td style="width: 25%; border: none; vertical-align: text-bottom !important;">
					
						<?php if ($allow_sign) : ?>
							<img src="data:image/png;base64,<?= $user[$main['inspection_by']]['sign_approval'] ?>" style='width: 2.0cm;vertical-align: text-bottom !important;' /><br><br>
						<?php else : ?>
							<br>
							<br>
							<br>
							<br>
							<br>
						<?php endif; ?>


					</td>
					<td style="width: 25%; border: none;"></td>
					<td style="width: 25%; border: none; vertical-align: text-bottom !important;">
						<?php if (@$main['thirdparty_inspection_by']) : ?>
							<img src="data:image/png;base64,<?= $user[$main['thirdparty_inspection_by']]['sign_approval'] ?>" style='width: 2.0cm;vertical-align: text-bottom !important;' /><br><br>
						<?php endif; ?>
					</td>
					<td style="width: 25%; border: none;"></td>
					<td style="width: 25%; border: none; vertical-align: text-bottom !important;">
						<?php if (@$main['client_inspection_by']) : ?>
							<img src="data:image/png;base64,<?= $user[$main['client_inspection_by']]['sign_approval'] ?>" style='width: 2.0cm;vertical-align: text-bottom !important;' /><br><br>
						<?php endif; ?>
					</td>
				</tr>
				<tr>
					<td style="width: 25%; border: none;">
						<?php if ($main['inspection_by']) : ?>
							<?= $user[$main['inspection_by']]['full_name'] ?>
						<?php endif; ?>
						<br>
						<b>_______________________</b>
					</td>
					<td style="width: 25%; border: none;"></td>
					<td style="width: 25%; border: none;">
						<?php if ($main['thirdparty_inspection_by']) : ?>
							<?= $user[$main['thirdparty_inspection_by']]['full_name'] ?>
						<?php endif; ?>
						<br>
						<b>_______________________</b>
					</td>
					<td style="width: 25%; border: none;"></td>
					<td style="width: 25%; border: none;">
						<?php if ($main['client_inspection_by']) : ?>
							<?= $user[$main['client_inspection_by']]['full_name'] ?>
						<?php endif; ?>
						<br>
						<b>_______________________</b>
					</td>
				</tr>
				<tr>
					<td style="width: 25%; border: none; padding-top: 10px;"><b>CONTRACTOR</b></td>
					<td style="width: 25%; border: none;"></td>
					<td style="width: 25%; border: none; padding-top: 10px;"><b>VENDOR <strong><i><span style="font-size: 14px !important"></span></i></strong></b></td>
					<td style="width: 25%; border: none; padding-top: 10px;"><b></b></td>
					<td style="width: 25%; border: none; padding-top: 10px;"><b>EMPLOYER</b></td>
				</tr>
				<tr>
					<td style="width: 25%; border: none;">DATE :

						<?= $main['inspection_date'] ? date('Y-m-d', strtotime($main['inspection_date'])) : null ?>

					</td>
					<td style="width: 25%; border: none;"></td>
					<td style="width: 25%; border: none;">DATE :
						<?= $main['thirdparty_inspection_date'] ? date('Y-m-d', strtotime($main['thirdparty_inspection_date'])) : null ?>
					</td>
					<td style="width: 25%; border: none;"></td>
					<td style="width: 25%; border: none;">DATE :
						<?= $main['client_inspection_date'] ? date('Y-m-d', strtotime($main['client_inspection_date'])) : null ?>
					</td>
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
    <?php if ($itr['discipline'] == 2) : ?>
      SOF-QCF-BAA-001
    <?php else : ?>
      SOF-QCF-BAA-002
    <?php endif; ?>
  </footer>
</body>

</html>