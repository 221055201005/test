<?php $transmittal = $rfi_client[0];
$comment_list      = [];

$checked_type               = "";

$legend_inspection          = explode(";", $transmittal['legend_inspection_auth']);
// test_var($legend_inspection);
if (( in_array(1, $legend_inspection)) == 1) {
  $checked_type             = "hold";
} elseif (( in_array(2, $legend_inspection)) == 1) {
  $checked_type             = "witness";
} elseif (( in_array(3, $legend_inspection)) == 1 || ( in_array(4, $legend_inspection)) == 1) {
  $checked_type             = "review";
}

// test_var($checked_type);
$is_ticked = 0;

foreach ($transmittal_list as $value) {
  if ($value['ticked_report_date'] == 1) {
    $is_ticked = 1;
  }
}

?>
<!DOCTYPE html>
<html>

<head>
  <title><?php echo $client_report_number ?>.pdf</title>
  <style type="text/css">
    @page {
      margin: 0cm 0cm;
    }

    /* body {
      top: 0cm;
      left: 0cm;
      right: 0cm;
      margin-top: 12.4cm;
      margin-left: 1.6cm;
      margin-right: 1.6cm;
      margin-bottom: 8cm;
      font-family: "helvetica";
      font-size: 9px;
    }


    footer {
      position: fixed;
      top: 21.3cm;
      left: 0cm;
      right: 0cm;
      height: 5cm;
      padding-top: 3px;
      padding-left: 1.5cm;
      padding-right: 1.5cm;
      font-size: 9px;
    }

    header {
      position: fixed;
      top: 1cm;
      left: 0cm;
      right: 0cm;
      height: 5cm;
      padding-top: 3px;
      padding-left: 1.5cm;
      padding-right: 1.5cm;
      font-size: 9px;
    } */

    body {
      top: 1cm;
      left: 0cm;
      right: 0cm;
      margin-top: 5.34cm;
      margin-left: 1.5cm;
      margin-right: 1.5cm;
      margin-bottom: 1cm;
      font-family: "helvetica";
      font-size: 9px;
    }

    .bg-selected {
      background-color: #949494;
    }


    footer {
      /* position: fixed; */
      top: 21.3cm;
      left: 0cm;
      right: 0cm;
      height: 5cm;
      padding-top: 3px;
      padding-left: 1.5cm;
      padding-right: 1.5cm;
      font-size: 9px;
    }

    header {
      position: fixed;
      top: 1cm;
      left: 0cm;
      right: 0cm;
      height: 5cm;
      padding-top: 3px;
      padding-left: 1.5cm;
      padding-right: 1.5cm;
      font-size: 9px;
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
      border-right: 1px #000 solid !important;
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

    .tab {
      display: inline-block;
      width: 130px;
    }

    .tab2 {
      display: inline-block;
      width: 130px;
    }

    .text-nowrap {
      white-space: nowrap;
    }

    .valign-middle {
      vertical-align: middle;
    }

    label {
      display: block;
      padding-left: 2px;
      padding-bottom: 5px;
      padding-top: 1px;
      text-indent: 1px;
      font-size: 9px;
    }

    input {
      width: 16px;
      height: 16px;
      padding: 0;
      margin: 0;
      vertical-align: bottom;
      position: relative;
      top: -1px;
      *overflow: hidden;
    }

    input[type=checkbox] {
      /* Double-sized Checkboxes */
      -ms-transform: scale(0.8);
      /* IE */
      -moz-transform: scale(0.8);
      /* FF */
      -webkit-transform: scale(0.8);
      /* Safari and Chrome */
      -o-transform: scale(0.8);
      /* Opera */
      transform: scale(0.8);
      /*padding: 1px;*/
    }

    /* Might want to wrap a span around your checkbox text */
    .checkboxtext {
      /* Checkbox text */
      font-size: 9px;
      display: inline;
    }

    .check_stamp {
      -ms-transform: scale(1.7) !important;
      -moz-transform: scale(1.7) !important;
      -webkit-transform: scale(1.7) !important;
      -o-transform: scale(1.7) !important;
      transform: scale(1.7) !important;
    }


    /* Might want to wrap a span around your checkbox text */
    .checkboxtext {
      /* Checkbox text */
      font-size: 8px;
      display: inline;
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
      /* margin-left: -10px !important; */
      z-index: 99 !important;
    }

    .valign_middle {
      vertical-align: middle !important;
    }
  </style>
</head>

<body>

  <header>

    <table border="1px" style="border-collapse: collapse !important;" width="100%">
      <tr>
        <td rowspan='3' valign="middle" style="padding: 5px;width: 260px !important;vertical-align: middle !important;">
          <center>
            <img src="img/seatrium_logo_bg_white.png" style="width: 150px;">
          </center>
          <!-- <img src="img/logo.png" style="width: 120px;"> -->
        </td>
        <td style="padding: 5px;vertical-align: middle !important;">EMPLOYER</td>
        <td style="padding: 5px;vertical-align: middle !important;">RFI NO :</td>
      </tr>
      <tr>
        <td style="padding: 5px;vertical-align: middle !important;">
          <b><?php echo strtoupper($project_name[$rfi_client[0]['project']]['client']) ?></b>
        </td>
        <td style="padding: 5px;vertical-align: middle !important;"><b><?= $client_report_number ?>
            <br> Rev. <?= $transmittal['postpone_reoffer_no'] ?>
          </b></td>
      </tr>
      <tr>
        <td style="padding: 5px;vertical-align: middle !important;" style="padding: 10px;">PROJECT TITLE</td>
        <td style="padding: 5px;vertical-align: middle !important;">SUBMITED DATE</td>
      </tr>
      <tr>
        <td rowspan='3' valign="middle" style="padding: 5px;vertical-align: middle !important;">
          <center>
            <img src="<?php echo $project_name[$rfi_client[0]['project']]['project_logo']; ?>" style="width: 120px;">
          </center>
        </td>
        <td style="padding: 5px;vertical-align: middle !important;">
          <b><?php echo strtoupper($project_name[$rfi_client[0]['project']]['description']) ?></b>
        </td>
        <td style="padding: 5px;vertical-align: middle !important;">
          <b><?php 
	          echo date("F d, Y",strtotime($rfi_client[0]['transmittal_datetime'] ? $rfi_client[0]['transmittal_datetime'] : $rfi_client[0]['date_request']))
	        ?></b>
        </td>
      </tr>
      <tr>
        <td style="padding: 5px;vertical-align: middle !important;height: 15px !important;">CONTRACTOR</td>
        <td style="padding: 5px;vertical-align: middle !important;">SHEET</td>
      </tr>
      <tr>
        <td style="padding: 5px;vertical-align: middle !important;"><b>PT SMOE</b></td>
        <td style="padding: 5px;vertical-align: middle !important;"><b></b></td>
      </tr>
    </table>
  </header>
  <table border="1px" style="border-collapse: collapse !important;" width="100%">
    <?php

    $inspection_date = date('d', strtotime($transmittal['time_inspect']));
    $inspection_month = date('m', strtotime($transmittal['time_inspect']));

    ?>

    <tr>
      <td colspan="22" style="text-align:center; padding-bottom: 4px; font-size: 12px !important;"><b>RFI - INSPECTION
          NOTIFICATION</b></td>
    </tr>
    <tr>
      <td colspan="6" style="text-align:center; padding-bottom: 4px;"><b>MONTH</b></td>
      <td colspan="16" style="text-align:center; padding-bottom: 4px;"><b>DAY</b></td>
    </tr>
    <tr>
      <td style="text-align:center; padding-bottom: 4px;" class="<?= $inspection_month == 1 ? 'bg-selected' : '' ?>">
        <b>JAN</b>
      </td>
      <td style="text-align:center; padding-bottom: 4px;" class="<?= $inspection_month == 2 ? 'bg-selected' : '' ?>">
        <b>FEB</b>
      </td>
      <td style="text-align:center; padding-bottom: 4px;" class="<?= $inspection_month == 3 ? 'bg-selected' : '' ?>">
        <b>MAR</b>
      </td>
      <td style="text-align:center; padding-bottom: 4px;" class="<?= $inspection_month == 4 ? 'bg-selected' : '' ?>">
        <b>APR</b>
      </td>
      <td style="text-align:center; padding-bottom: 4px;" class="<?= $inspection_month == 5 ? 'bg-selected' : '' ?>">
        <b>MAY</b>
      </td>
      <td style="text-align:center; padding-bottom: 4px;" class="<?= $inspection_month == 6 ? 'bg-selected' : '' ?>">
        <b>JUN</b>
      </td>
      <td rowspan='2' style="text-align:center; padding-bottom: 4px;vertical-align: middle !important;" class="<?= $inspection_date == 1 ? 'bg-selected' : '' ?>"><b>1</b></td>
      <td style="text-align:center; padding-bottom: 4px;" class="<?= $inspection_date == 2 ? 'bg-selected' : '' ?>">
        <b>2</b>
      </td>
      <td style="text-align:center; padding-bottom: 4px;" class="<?= $inspection_date == 3 ? 'bg-selected' : '' ?>">
        <b>3</b>
      </td>
      <td style="text-align:center; padding-bottom: 4px;" class="<?= $inspection_date == 4 ? 'bg-selected' : '' ?>">
        <b>4</b>
      </td>
      <td style="text-align:center; padding-bottom: 4px;" class="<?= $inspection_date == 5 ? 'bg-selected' : '' ?>">
        <b>5</b>
      </td>
      <td style="text-align:center; padding-bottom: 4px;" class="<?= $inspection_date == 6 ? 'bg-selected' : '' ?>">
        <b>6</b>
      </td>
      <td style="text-align:center; padding-bottom: 4px;" class="<?= $inspection_date == 7 ? 'bg-selected' : '' ?>">
        <b>7</b>
      </td>
      <td style="text-align:center; padding-bottom: 4px;" class="<?= $inspection_date == 8 ? 'bg-selected' : '' ?>">
        <b>8</b>
      </td>
      <td style="text-align:center; padding-bottom: 4px;" class="<?= $inspection_date == 9 ? 'bg-selected' : '' ?>">
        <b>9</b>
      </td>
      <td style="text-align:center; padding-bottom: 4px;" class="<?= $inspection_date == 10 ? 'bg-selected' : '' ?>">
        <b>10</b>
      </td>
      <td style="text-align:center; padding-bottom: 4px;" class="<?= $inspection_date == 11 ? 'bg-selected' : '' ?>">
        <b>11</b>
      </td>
      <td style="text-align:center; padding-bottom: 4px;" class="<?= $inspection_date == 12 ? 'bg-selected' : '' ?>">
        <b>12</b>
      </td>
      <td style="text-align:center; padding-bottom: 4px;" class="<?= $inspection_date == 13 ? 'bg-selected' : '' ?>">
        <b>13</b>
      </td>
      <td style="text-align:center; padding-bottom: 4px;" class="<?= $inspection_date == 14 ? 'bg-selected' : '' ?>">
        <b>14</b>
      </td>
      <td style="text-align:center; padding-bottom: 4px;" class="<?= $inspection_date == 15 ? 'bg-selected' : '' ?>">
        <b>15</b>
      </td>
      <td style="text-align:center; padding-bottom: 4px;" class="<?= $inspection_date == 16 ? 'bg-selected' : '' ?>">
        <b>16</b>
      </td>
    </tr>
    <tr>
      <td style="text-align:center; padding-bottom: 4px;" class="<?= $inspection_month == 7 ? 'bg-selected' : '' ?>">
        <b>JUL</b>
      </td>
      <td style="text-align:center; padding-bottom: 4px;" class="<?= $inspection_month == 8 ? 'bg-selected' : '' ?>">
        <b>AUG</b>
      </td>
      <td style="text-align:center; padding-bottom: 4px;" class="<?= $inspection_month == 9 ? 'bg-selected' : '' ?>">
        <b>SEP</b>
      </td>
      <td style="text-align:center; padding-bottom: 4px;" class="<?= $inspection_month == 10 ? 'bg-selected' : '' ?>">
        <b>OCT</b>
      </td>
      <td style="text-align:center; padding-bottom: 4px;" class="<?= $inspection_month == 11 ? 'bg-selected' : '' ?>">
        <b>NOV</b>
      </td>
      <td style="text-align:center; padding-bottom: 4px;" class="<?= $inspection_month == 12 ? 'bg-selected' : '' ?>">
        <b>DEC</b>
      </td>

      <td style="text-align:center; padding-bottom: 4px;" class="<?= $inspection_date == 17 ? 'bg-selected' : '' ?>">
        <b>17</b>
      </td>
      <td style="text-align:center; padding-bottom: 4px;" class="<?= $inspection_date == 18 ? 'bg-selected' : '' ?>">
        <b>18</b>
      </td>
      <td style="text-align:center; padding-bottom: 4px;" class="<?= $inspection_date == 19 ? 'bg-selected' : '' ?>">
        <b>19</b>
      </td>
      <td style="text-align:center; padding-bottom: 4px;" class="<?= $inspection_date == 20 ? 'bg-selected' : '' ?>">
        <b>20</b>
      </td>
      <td style="text-align:center; padding-bottom: 4px;" class="<?= $inspection_date == 21 ? 'bg-selected' : '' ?>">
        <b>21</b>
      </td>
      <td style="text-align:center; padding-bottom: 4px;" class="<?= $inspection_date == 22 ? 'bg-selected' : '' ?>">
        <b>22</b>
      </td>
      <td style="text-align:center; padding-bottom: 4px;" class="<?= $inspection_date == 23 ? 'bg-selected' : '' ?>">
        <b>23</b>
      </td>
      <td style="text-align:center; padding-bottom: 4px;" class="<?= $inspection_date == 24 ? 'bg-selected' : '' ?>">
        <b>24</b>
      </td>
      <td style="text-align:center; padding-bottom: 4px;" class="<?= $inspection_date == 25 ? 'bg-selected' : '' ?>">
        <b>25</b>
      </td>
      <td style="text-align:center; padding-bottom: 4px;" class="<?= $inspection_date == 26 ? 'bg-selected' : '' ?>">
        <b>26</b>
      </td>
      <td style="text-align:center; padding-bottom: 4px;" class="<?= $inspection_date == 27 ? 'bg-selected' : '' ?>">
        <b>27</b>
      </td>
      <td style="text-align:center; padding-bottom: 4px;" class="<?= $inspection_date == 28 ? 'bg-selected' : '' ?>">
        <b>28</b>
      </td>
      <td style="text-align:center; padding-bottom: 4px;" class="<?= $inspection_date == 29 ? 'bg-selected' : '' ?>">
        <b>29</b>
      </td>
      <td style="text-align:center; padding-bottom: 4px;" class="<?= $inspection_date == 30 ? 'bg-selected' : '' ?>">
        <b>30</b>
      </td>
      <td style="text-align:center; padding-bottom: 4px;" class="<?= $inspection_date == 31 ? 'bg-selected' : '' ?>">
        <b>31</b>
      </td>
    </tr>
    <tr>
      <td colspan="22" style="text-align:left; padding-bottom: 4px; padding-left: 4px; font-size: 12px !important;">
        <b>Document Ref
          :<br>
        <?=
         $master_acceptance[$rfi_client[0]['project']][$rfi_client[0]['company_id']][$rfi_client[0]['discipline']][$rfi_client[0]['module']][$rfi_client[0]['type_of_module']][$rfi_client[0]['class']]['visual']['procedure'];  
        // in_array(1,explode(';', $rfi_client[0]['legend_inspection_auth'])) || in_array(2,explode(';', $rfi_client[0]['legend_inspection_auth'])) 
        	// ? "
        	// 	&nbsp;&nbsp;&nbsp;&nbsp;• 07555701 (B) - E.80 Fabrication and Construction
					// 	</br>&nbsp;&nbsp;&nbsp;&nbsp;• 08307791 - Inspection Test Procedure - ".($master_discipline[$rfi_client[0]['discipline']]['discipline_name'])."
					// 	</br>&nbsp;&nbsp;&nbsp;&nbsp;• 08308559 - In-process Inspection procedure
        	// "
          // : "
        	// 	&nbsp;&nbsp;&nbsp;&nbsp;• 07555701 (B) - E.80 Fabrication and Construction
					// 	</br>&nbsp;&nbsp;&nbsp;&nbsp;• 08307791 - Inspection Test Procedure - ".($master_discipline[$rfi_client[0]['discipline']]['discipline_name'])."
					// 	</br>&nbsp;&nbsp;&nbsp;&nbsp;• 08308559 - In-process Inspection procedure
        	// "
        ?>
      </td>
    </tr>
    <tr>
      <td colspan="22" style="text-align:left; padding-bottom: 4px; ">Discipline : &nbsp;&nbsp;
        <?php if ($rfi_client[0]['discipline'] == '2') { ?><input type="checkbox" name="optiona" id="opta" checked /><?php } else { ?><input type="checkbox" name="optiona" id="opta" /><?php } ?><span class="checkboxtext"> &nbsp;&nbsp;STRUCTURAL&nbsp;&nbsp;&nbsp;&nbsp;</span>

        <input type="checkbox" name="optiona" id="opta" /><span class="checkboxtext"> &nbsp;&nbsp;E &
          I&nbsp;&nbsp;&nbsp;&nbsp;</span>
        <input type="checkbox" name="optiona" id="opta" /><span class="checkboxtext">
          &nbsp;&nbsp;MECHANICAL&nbsp;&nbsp;&nbsp;&nbsp;</span>
        <?php if ($rfi_client[0]['discipline'] == '1') { ?><input type="checkbox" name="optiona" id="opta" checked="" /><?php } else { ?><input type="checkbox" name="optiona" id="opta" /><?php } ?><span class="checkboxtext"> &nbsp;&nbsp;PIPING&nbsp;&nbsp;&nbsp;&nbsp;</span>
        <span class="checkboxtext"><input type="checkbox" name="optiona" id="opta" />&nbsp;&nbsp;HVAC&nbsp;&nbsp;&nbsp;&nbsp;</span>
      </td>
    </tr>
    <tr>
      <td colspan="22" style="text-align:left; padding-bottom: 4px; font-size: 12px !important;">TYPE OF INSPECTION :
      </td>
    </tr>
    <tr>
      <td colspan="22" style="text-align:left; padding-bottom: 4px; ">
        <table width="100%">
          <tr>
            <td style="text-align:left; padding-bottom: 4px;">
              <input type="checkbox" name="optiona" id="opta" />
              <span class="checkboxtext">&nbsp;&nbsp;Material / Equipment Inspection&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </td>
            <td style="text-align:left; padding-bottom: 4px;">
              <input type="checkbox" name="optiona" id="opta" />
              <span class="checkboxtext">&nbsp;&nbsp;Dimensional&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </td>
            <td style="text-align:left; padding-bottom: 4px; ">
              <input type="checkbox" name="optiona" id="opta" />
              <span class="checkboxtext"> &nbsp;&nbsp;Witness Pressure Test&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </td>
            <td style="text-align:left; padding-bottom: 4px; ">
              <input type="checkbox" name="optiona" id="opta" />
              <span class="checkboxtext"> &nbsp;&nbsp;Mechanical Completion&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </td>
          </tr>
          <tr>
            <td style="text-align:left; padding-bottom: 4px;">
              <input type="checkbox" name="optiona" id="opta" />
              <span class="checkboxtext"> &nbsp;&nbsp;Welder Qualification&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </td>
            <td style="text-align:left; padding-bottom: 4px;">
              <input type="checkbox" name="optiona" id="opta" />
              <span class="checkboxtext"> &nbsp;&nbsp;Fit-up Inspection&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </td>
            <td style="text-align:left; padding-bottom: 4px; ">
              <input type="checkbox" name="optiona" id="opta" />
              <span class="checkboxtext"> &nbsp;&nbsp;Final Inspection&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </td>
            <td style="text-align:left; padding-bottom: 4px; ">
              <input type="checkbox" name="optiona" id="opta" />
              <span class="checkboxtext"> &nbsp;&nbsp;Pre-Commisioning / Commisioning&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </td>
          </tr>
          <tr>
            <td style="text-align:left; padding-bottom: 4px;">
              <input type="checkbox" name="optiona" id="opta" />
              <span class="checkboxtext"> &nbsp;&nbsp;Procedure Qualification&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </td>
            <td style="text-align:left; padding-bottom: 4px;">
              <input type="checkbox" name="optiona" id="opta" checked />
              <span class="checkboxtext"> &nbsp;&nbsp;Visual Inspection&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </td>
            <td style="text-align:left; padding-bottom: 4px; ">
              <input type="checkbox" name="optiona" id="opta" />
              <span class="checkboxtext"> &nbsp;&nbsp;Blasting / Painting / Coating&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </td>
            <td style="text-align:left; padding-bottom: 4px; ">
              <input type="checkbox" name="optiona" id="opta" />
              <span class="checkboxtext"> &nbsp;&nbsp;Document Review&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </td>
          </tr>
          <tr>
            <td style="text-align:left; padding-bottom: 4px;">
              <input type="checkbox" name="optiona" id="opta" />
              <span class="checkboxtext"> &nbsp;&nbsp;Production Test Coupon Welding&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </td>
            <td style="text-align:left; padding-bottom: 4px;">
              <input type="checkbox" name="optiona" id="opta" />
              <span class="checkboxtext"> &nbsp;&nbsp;Witness NDT&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </td>
            <td style="text-align:left; padding-bottom: 4px; ">
              <input type="checkbox" name="optiona" id="opta" />
              <span class="checkboxtext"> &nbsp;&nbsp;E & I Inspection&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </td>
            <td style="text-align:left; padding-bottom: 4px; ">
              <input type="checkbox" name="optiona" id="opta" />
              <span class="checkboxtext"> &nbsp;&nbsp;Other&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td colspan="1" style="font-weight: bold; padding-bottom: 4px; font-size: 10px !important;">
        <center>No.</center>
      </td>
      <td colspan="6" style="font-weight: bold; padding-bottom: 4px; font-size: 10px !important;">
        <center>ITEM / TAG NUMBER</center>
      </td>
      <td colspan="7" style="font-weight: bold; padding-bottom: 4px; font-size: 10px !important;">
        <center>ITEM / DESCRIPTION</center>
      </td>
      <td colspan="3" style="font-weight: bold; padding-bottom: 4px; font-size: 10px !important;">
        <center>AREA / LOCATION</center>
      </td>
      <td colspan="5" style="font-weight: bold; padding-bottom: 4px; font-size: 10px !important;">
        <center>EXPECTED TIME</center>
      </td>
    </tr>

    <?php

    $add_empty_row = false;
    $total_new_row = 0;

    if (count($transmittal_list) < 10) {
      $add_empty_row = true;
      $total_new_row = 10 - count($transmittal_list);
    }
    // test_var($transmittal_list);
    $no = 1;
    foreach ($rfi_client as $key => $value) : ?>
      <?php
	      if ($value['rejected_client_remarks'] != '') {
	        $comment_list[] = $value['rejected_client_remarks'];
	      }
      ?>
      <tr>
        <td colspan="1" style="text-align: center; padding-bottom: 4px; font-size: 10px !important; border-top: none; border-bottom: none;"><?php echo $no; ?></td>
        <td colspan="6" style="text-align: center; padding-bottom: 4px; font-size: 10px !important; border-top: none; border-bottom: none;">Joint# : <?php echo $value['joint_no'].($value['revision']>0 ? $value['revision_category'].$value['revision'] : ''); ?> </td>
        <td colspan="7" style="text-align: center; padding-bottom: 4px; font-size: 10px !important; border-top: none; border-bottom: none;"><?php echo $value['drawing_wm']; ?> </td>
        <td colspan="3" style="text-align: center; padding-bottom: 4px; font-size: 10px !important; border-top: none; border-bottom: none;">
          <?php  
            if($value['area_v2']!=''){
              echo $master_location_v2[$value['location_v2']]['name'];
            } else {
              echo $master_area[$value['location_inspect']]['area_name'];
            }
          ?>    
        </td>
        <td colspan="5" style="text-align: center; padding-bottom: 4px; font-size: 10px !important; border-top: none; border-bottom: none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $value['time_inspect'] ?></td>
      </tr>
    <?php $no++; endforeach; ?>

    <?php if ($add_empty_row) : ?>

      <?php foreach (range(1, $total_new_row) as $value) : ?>
        <tr>
          <td colspan="1" style="text-align: center; padding-bottom: 4px; font-size: 10px !important; border-top: none; border-bottom: none; ">
            <span style="color:white">new</span>
          </td>
          <td colspan="6" style="text-align: center; padding-bottom: 4px; font-size: 10px !important; border-top: none; border-bottom: none; ">
            <span style="color:white">new</span>
          </td>
          <td colspan="7" style="text-align: center; padding-bottom: 4px; font-size: 10px !important; border-top: none; border-bottom: none; ">
            <span style="color:white">new</span>
          </td>
          <td colspan="3" style="text-align: center; padding-bottom: 4px; font-size: 10px !important; border-top: none; border-bottom: none; ">
            <span style="color:white">new</span>
          </td>
          <td colspan="5" style="text-align: center; padding-bottom: 4px; font-size: 10px !important; border-top: none; border-bottom: none; ">
            <span style="color:white">new</span>
          </td>
        </tr>
      <?php endforeach; ?>

    <?php endif; ?>


  </table>

  <!--  <table  border="1px" style="border-collapse: collapse !important;" width="100%">
      <tr>
        <td style="padding-bottom: 4px; font-size: 12px !important;"><b>STRUCTURAL MATERIAL TRACEABILITY REPORT</b></td>
      </tr>
      <tr>
       <td><b>QUALITY CONTROL DEPARTMENT</b></td>
      </tr>
    </table> -->

  <!-- </header> -->

  <!-- <footer> -->
  <div style="page-break-inside: avoid;">
    <table  border="1px" style="border-collapse: collapse !important;" width="100%">
      <tr>
        <td colspan="3" style="text-align:center; padding-bottom: 4px; font-size: 12px !important;"><b>LEGEND : INSPECTION AUTHORITY AS PER ITP</b></td>
      </tr>          
      <tr>
        <td colspan="3" style="padding-bottom: 4px; font-size: 13px !important;font-weight: bold;">  
          <table width="100%">
              <tr>
                  <td><input type="checkbox" <?php if(in_array(1,explode(';', $rfi_client[0]['legend_inspection_auth']))){ echo "checked"; } ?>/> Hold Point</td>
                  <td><input type="checkbox" <?php if(in_array(2,explode(';', $rfi_client[0]['legend_inspection_auth']))){ echo "checked"; } ?>/> Witness</td>
                  <td><input type="checkbox" <?php if(in_array(3,explode(';', $rfi_client[0]['legend_inspection_auth']))){ echo "checked"; } ?>/> Monitoring</td>
                  <td><input type="checkbox" <?php if(in_array(4,explode(';', $rfi_client[0]['legend_inspection_auth']))){ echo "checked"; } ?>/> Review</td>
              </tr>
          </table>
        </td>
      </tr>      
    <!-- </table>
    <br>
    <table  border="1px" style="border-collapse: collapse !important;" width="100%"> -->
      <tr>
        <td colspan="3" style="text-align:center; padding-bottom: 4px; font-size: 12px !important;"><b>INSPECTION EXCECUTION RESULT</b></td>
      </tr>          
      <tr>
        <td colspan="3" style="text-align:left; padding-bottom: 4px; font-size: 13px !important;font-weight: bold;text-align: center;">          
          <input  type="checkbox" name="optiona" id="opta" / <?= $transmittal['status_inspection']==7 ? 'checked' : '' ?>><span class="checkboxtext"> &nbsp;Accepted:&nbsp; </span>
          <input  type="checkbox" name="optiona" id="opta" / <?= $transmittal['status_inspection']==9 ? 'checked' : '' ?>><span class="checkboxtext"> &nbsp;Accepted & Release With Comments : &nbsp; </span>        
          <input  type="checkbox" name="optiona" id="opta" / <?= $transmittal['status_inspection']==6 ? 'checked' : '' ?>><span class="checkboxtext"> &nbsp;Rejected :&nbsp; </span>
          <input  type="checkbox" name="optiona" id="opta" / <?= $transmittal['status_inspection']==10 ? 'checked' : '' ?>><span class="checkboxtext"> &nbsp;Postponed :&nbsp; </span>
          <input  type="checkbox" name="optiona" id="opta" / <?= $transmittal['status_inspection']==11 ? 'checked' : '' ?>><span class="checkboxtext"> &nbsp;Re-Offer :&nbsp; </span>
        </td>
      </tr>
      <tr>
        <td colspan="3" style="text-align:left; padding-bottom: 4px; font-size: 12px !important; min-height: 15px !important"><b>Comment/Remarks :<br/></b>
          &nbsp;&nbsp;&nbsp;&nbsp;<?= $transmittal['client_remarks'] ?>
        </td>
      </tr>
   
      <tr>
        <td colspan="3" style="text-align:center; padding-bottom: 4px; font-size: 10px !important;"><b>SIGNATURE FOR INSPECTION EXECUTED</b></td>
      </tr>
    <!-- </table>
    <br>
    <table width="100%" border="1px" style="border-collapse: collapse;"> -->
        <tr>
          <!-- <td style="text-align:center; padding-bottom: 4px; font-size: 12px !important;text-align: center;font-weight: bold;">SUPLIER</td> -->
          <td style="text-align:center; padding-bottom: 4px; font-size: 12px !important;text-align: center;font-weight: bold; width:33.33%;" >CONTRACTOR</td>
          <td style="text-align:center; padding-bottom: 4px; font-size: 12px !important;text-align: center;font-weight: bold; width:33.33%;">EMPLOYER</td>
          <td style="text-align:center; padding-bottom: 4px; font-size: 12px !important;text-align: center;font-weight: bold; width:33.33%;">THIRD PARTY</td>
        </tr>
        <tr>
          <!-- <td style="padding-bottom: 4px; font-size: 10px !important;">NAME</td> -->
          <td style="padding-bottom: 4px; font-size: 10px !important;">NAME <b><?= $user_sign['inspector']['full_name'] ?></b></td>
          <td style="padding-bottom: 4px; font-size: 10px !important;">NAME <b><?= $user_sign['client']['full_name'] ?></b></td>
          <td style="padding-bottom: 4px; font-size: 10px !important;">NAME <b><?= $user_sign['3rd']['full_name'] ?></b></td>
        </tr>
         <tr>
          <!-- <td style="padding-bottom: 4px; font-size: 10px !important;">SIGNATURE<br/></td> -->
          <td style="padding-bottom: 4px; font-size: 10px !important;">SIGNATURE<br/>
          	<?php if(isset($rfi_client[0]['inspection_by'])){ ?>
            	<img src="data:image/png;base64,<?= $user_sign['inspector']['sign_approval'] ?>" style="width:80px;height:80px;">
            <?php } ?>
          </td>

          <td style="padding-bottom: 4px; font-size: 10px !important;">SIGNATURE<br/>
            <?php // if(isset($rfi_client[0]['inspection_client_by'])){ ?>
            	<!-- <img src="data:image/png;base64,<?= $user_sign['client']['sign_approval'] ?>" style="width:80px;height:80px;"> -->
            	<div style="page-break-inside: avoid;">
	            	<?php if ($rfi_client[0]['project_code'] == 17) : ?>
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
	                      <td><input type="checkbox" style="margin-bottom: 8px" <?= $checked_type=='hold' OR $checked_type==1 ? 'witness' : '' ?>></td>
	                    </tr>
	                    <tr>
	                      <td width="40%" class="valign_middle">Inspect</td>
	                      <td><input type="checkbox" style="margin-bottom: 8px" <?= $checked_type=='hold' ? 'checked' : '' ?>></td>
	                    </tr>
	                  </table>
	                  <br>
	                  Date : <?= 
		                  ($rfi_client[0]['ticked_report_date'] == 1 ? 
		                  (isset($rfi_client[0]['document_approval_by']) ? "<b>".date("Y-m-d",strtotime($rfi_client[0]['document_approval_date']))."</b>"
		                  : '') : 
		                  (isset($rfi_client[0]['inspection_by']) ? "<b>".date("Y-m-d",strtotime($rfi_client[0]['inspection_datetime']))."</b>"
		                  : '') ) 
		                ?>
	                  &nbsp;
	                  <span style="z-index: 99 !important;">Signature :</span>

	                </div>
	                <div class="text-right" style="padding-right: 5px; padding-bottom:3px;">
            				<?php if(isset($rfi_client[0]['inspection_client_by'])){ ?>
	                  	<img src="data:image/png;base64, <?= $user_sign['client']['sign_approval'] ?>" style='width: 3cm !important; height: 2.8cm !important; position: absolute !important; margin-left: 100px !important; margin-top: -117px !important; z-index: -99 !important; 
/*	                  		border: 5px solid #555;*/
	                  		' />
            				<?php } ?>
	                </div>
	              <?php else: ?>
            			<?php if(isset($rfi_client[0]['inspection_client_by'])){ ?>
	                	<img src="data:image/png;base64,<?= $user_sign['client']['sign_approval'] ?>" style='width: 3.5cm;vertical-align: text-bottom !important;' />
            			<?php } ?>
	            	<?php endif; ?>
            	</div>
            <?php // } ?>
          </td>

          <td style="padding-bottom: 4px; font-size: 10px !important;">SIGNATURE<br/>
          <?php if(isset($rfi_client[0]['third_party_approval_by'])){ ?>
            	<img src="data:image/png;base64,<?= $user_sign['3rd']['sign_approval'] ?>" style="width:80px;height:80px;">
            <?php } ?>
          </td>
        </tr>
         <tr>
          <!-- <td style="padding-bottom: 4px; font-size: 10px !important;">Date</td> -->
          <td style="padding-bottom: 4px; font-size: 10px !important;">Date 
          	<?php if(isset($rfi_client[0]['inspection_by'])){ ?>
            	<b>
            		<?= 
                  ($rfi_client[0]['ticked_report_date'] == 1 ? 
                  (isset($rfi_client[0]['document_approval_by']) ? "<b>".date("Y-m-d",strtotime($rfi_client[0]['document_approval_date']))."</b>"
                  : '') : 
                  (isset($rfi_client[0]['inspection_by']) ? "<b>".date("Y-m-d",strtotime($rfi_client[0]['inspection_datetime']))."</b>"
                  : '') ) 
                ?>
            	</b>
            <?php } ?>
          </td>
          <td style="padding-bottom: 4px; font-size: 10px !important;">Date 
            <?php if(isset($rfi_client[0]['inspection_client_by'])){ ?>
            	<b><?php echo date("Y-m-d",strtotime($rfi_client[0]['inspection_client_datetime'])); ?></b>
            <?php } ?>
          </td>
          <td style="padding-bottom: 4px; font-size: 10px !important;">Date
        
          <?php if(isset($rfi_client[0]['third_party_approval_date'])){ ?>
            	<b><?php echo date("Y-m-d",strtotime($rfi_client[0]['third_party_approval_date'])); ?></b>
            <?php } ?>
        </td>
        </tr>
    </table>
    <!-- <table width="100%" border="1px" style="border-collapse: collapse;">
      
    </table> -->
  </div>
  <!-- </footer> -->

</body>

</html>