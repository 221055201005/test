<?php 

// test_var($ndt);
// test_var($project);


error_reporting(0);
    $inspection_month   = DATE('m' ,strtotime($ndt[0]['rfi_inspect_date_from']));
    $inspection_month_to= DATE('m' ,strtotime($ndt[0]['rfi_inspect_date_to']));

    $inspection_date    = DATE('d' ,strtotime($ndt[0]['rfi_inspect_date_from']));
    $inspection_date_to = DATE('d' ,strtotime($ndt[0]['rfi_inspect_date_to']));

    $inspection_date_arr = array();

    $start = new DateTime (DATE('Y-m-d' ,strtotime($ndt[0]['rfi_inspect_date_from']))); 
    $end = new DateTime (DATE('Y-m-d' ,strtotime($ndt[0]['rfi_inspect_date_to']))); 

    $interval = new DateInterval ("P1D"); 
    $range = new DatePeriod ($start, $interval, $end);
    foreach ($range as $key => $value) {
      if($value->format('l')=='Sunday'){
        $blank[] = $value->format('d');
        $inspection_month_arr_v2[] = $value->format('m');
      } else {
        $date_arr[] = $value->format('d');
      }
    }
    $date_arr[] = DATE('d' ,strtotime($ndt[0]['rfi_inspect_date_to']));

    $interval = new DateInterval ("P1M"); 
    $range = new DatePeriod ($start, $interval, $end);
    $inspection_month_arr_v2[] = $inspection_month;
    $inspection_month_arr_v2[] = $inspection_month_to;
    foreach ($range as $key => $value) {
      $inspection_month_arr_v2[] = intval($value->format('m'));
    }

    if($inspection_date_to<$inspection_date){
      foreach (range($inspection_date, 31) as $keyc => $valuec) {
        $inspection_date_arr[] = $valuec;
      }
      foreach (range(1, $inspection_date_to) as $keyc => $valuec) {
        $inspection_date_arr[] = $valuec;
      }
    } else {
      foreach (range($inspection_date, $inspection_date_to) as $keyc => $valuec) {
        $inspection_date_arr[] = $valuec;
      }
    }

    $inspection_month_arr = array();
    foreach (range($inspection_month, $inspection_month_to) as $keyc => $valuec) {
      $inspection_month_arr[] = $valuec;
    }
    
    $inspection_date_arr = $date_arr;

?>
<!DOCTYPE html>
<html>

<head>
  <title><?php echo $rfi_no ?>.pdf</title>
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
        <td style="padding: 5px;vertical-align: middle !important;">COMPANY</td>
        <td style="padding: 5px;vertical-align: middle !important;">RFI NO :</td>
      </tr>
      <tr>
        <td style="padding: 5px;vertical-align: middle !important;">
          <b><?php echo strtoupper($project['client'] ) ?></b>
        </td>
        <td style="padding: 5px;vertical-align: middle !important;"><b><?= $rfi_no ?>
            <br>  <?= $transmittal['postpone_reoffer_no'] ? 'Rev.' . $transmittal['postpone_reoffer_no'] : '' ?>
          </b></td>
      </tr>
      <tr>
        <td style="padding: 5px;vertical-align: middle !important;" style="padding: 10px;">PROJECT TITLE</td>
        <td style="padding: 5px;vertical-align: middle !important;">SUBMITED DATE</td>
      </tr>
      <tr>
        <td rowspan='3' valign="middle" style="padding: 5px;vertical-align: middle !important;">
          <center>
            <img src="<?php echo $project['client_logo']; ?>" style="width: 120px;">
          </center>
        </td>
        <td style="padding: 5px;vertical-align: middle !important;">
          <b><?php echo strtoupper($project['client'] ) ?></b>
        </td>
        <td style="padding: 5px;vertical-align: middle !important;">
          <b><?php 
	          echo date("F d, Y",strtotime($ndt[0]['rfi_submitted_date'] ?? $ndt[0]['transmittal_inspection_datetime']));
	        ?></b>
        </td>
      </tr>
      <tr>
        <td style="padding: 5px;vertical-align: middle !important;height: 15px !important;">CONTRACTOR</td>
        <td style="padding: 5px;vertical-align: middle !important;">SHEET</td>
      </tr>
      <tr>
        <?php
          if($ndt[0]['id_project'] == 21){
            $contractor = 'Seatrium';
          }else{
            $contractor = 'PT SMOE';
          }
        ?>
        <td style="padding: 5px;vertical-align: middle !important;"><b><?= $contractor ?></b></td>
        <td style="padding: 5px;vertical-align: middle !important;"><b></b></td>
      </tr>
    </table>
  </header>
  <table border="1px" style="border-collapse: collapse !important;" width="100%">
    <?php

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
          <td  style="text-align:center; padding-bottom: 4px;" class="<?= in_array(1, $inspection_month_arr_v2) ? 'bg-selected' : '' ?>">
            <b>JAN</b>
          </td>
          <td  style="text-align:center; padding-bottom: 4px;" class="<?= in_array(2, $inspection_month_arr_v2) ? 'bg-selected' : '' ?>">
            <b>FEB</b>
          </td>
          <td  style="text-align:center; padding-bottom: 4px;" class="<?= in_array(3, $inspection_month_arr_v2) ? 'bg-selected' : '' ?>">
            <b>MAR</b>
          </td>
          <td  style="text-align:center; padding-bottom: 4px;" class="<?= in_array(4, $inspection_month_arr_v2) ? 'bg-selected' : '' ?>">
            <b>APR</b>
          </td>
          <td  style="text-align:center; padding-bottom: 4px;" class="<?= in_array(5, $inspection_month_arr_v2) ? 'bg-selected' : '' ?>">
            <b>MAY</b>
          </td>
          <td  style="text-align:center; padding-bottom: 4px;" class="<?= in_array(6, $inspection_month_arr_v2) ? 'bg-selected' : '' ?>">
            <b>JUN</b>
          </td>
          <td rowspan='2' style="text-align:center; padding-bottom: 4px;vertical-align: middle !important;"
            class="<?= (in_array(1, $inspection_date_arr) AND !in_array(1, $blank)) ? 'bg-selected' : '' ?>"><b>1</b></td>
          <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(2, $inspection_date_arr) AND !in_array(2, $blank)) ? 'bg-selected' : '' ?>">
            <b>2</b>
          </td>
          <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(3, $inspection_date_arr) AND !in_array(3, $blank)) ? 'bg-selected' : '' ?>">
            <b>3</b>
          </td>
          <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(4, $inspection_date_arr) AND !in_array(4, $blank)) ? 'bg-selected' : '' ?>">
            <b>4</b>
          </td>
          <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(5, $inspection_date_arr) AND !in_array(5, $blank)) ? 'bg-selected' : '' ?>">
            <b>5</b>
          </td>
          <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(6, $inspection_date_arr) AND !in_array(6, $blank)) ? 'bg-selected' : '' ?>">
            <b>6</b>
          </td>
          <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(7, $inspection_date_arr) AND !in_array(7, $blank)) ? 'bg-selected' : '' ?>">
            <b>7</b>
          </td>
          <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(8, $inspection_date_arr) AND !in_array(8, $blank)) ? 'bg-selected' : '' ?>">
            <b>8</b>
          </td>
          <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(9, $inspection_date_arr) AND !in_array(9, $blank)) ? 'bg-selected' : '' ?>">
            <b>9</b>
          </td>
          <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(10, $inspection_date_arr) AND !in_array(10, $blank)) ? 'bg-selected' : '' ?>">
            <b>10</b>
          </td>
          <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(11, $inspection_date_arr) AND !in_array(11, $blank)) ? 'bg-selected' : '' ?>">
            <b>11</b>
          </td>
          <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(12, $inspection_date_arr) AND !in_array(12, $blank)) ? 'bg-selected' : '' ?>">
            <b>12</b>
          </td>
          <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(13, $inspection_date_arr) AND !in_array(13, $blank)) ? 'bg-selected' : '' ?>">
            <b>13</b>
          </td>
          <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(14, $inspection_date_arr) AND !in_array(14, $blank)) ? 'bg-selected' : '' ?>">
            <b>14</b>
          </td>
          <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(15, $inspection_date_arr) AND !in_array(15, $blank)) ? 'bg-selected' : '' ?>">
            <b>15</b>
          </td>
          <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(16, $inspection_date_arr) AND !in_array(16, $blank)) ? 'bg-selected' : '' ?>">
            <b>16</b>
          </td>
        </tr>
        <tr>
          <td style="text-align:center; padding-bottom: 4px;" class="<?= in_array(7, $inspection_month_arr_v2) ? 'bg-selected' : '' ?>">
            <b>JUL</b>
          </td>
          <td style="text-align:center; padding-bottom: 4px;" class="<?= in_array(8, $inspection_month_arr_v2) ? 'bg-selected' : '' ?>">
            <b>AUG</b>
          </td>
          <td style="text-align:center; padding-bottom: 4px;" class="<?= in_array(9, $inspection_month_arr_v2) ? 'bg-selected' : '' ?>">
            <b>SEP</b>
          </td>
          <td style="text-align:center; padding-bottom: 4px;" class="<?= in_array(10, $inspection_month_arr_v2) ? 'bg-selected' : '' ?>">
            <b>OCT</b>
          </td>
          <td style="text-align:center; padding-bottom: 4px;" class="<?= in_array(11, $inspection_month_arr_v2) ? 'bg-selected' : '' ?>">
            <b>NOV</b>
          </td>
          <td style="text-align:center; padding-bottom: 4px;" class="<?= in_array(12, $inspection_month_arr_v2) ? 'bg-selected' : '' ?>">
            <b>DEC</b>
          </td>

          <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(17, $inspection_date_arr) AND !in_array(17, $blank)) ? 'bg-selected' : '' ?>">
            <b>17</b>
          </td>
          <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(18, $inspection_date_arr) AND !in_array(18, $blank)) ? 'bg-selected' : '' ?>">
            <b>18</b>
          </td>
          <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(19, $inspection_date_arr) AND !in_array(19, $blank)) ? 'bg-selected' : '' ?>">
            <b>19</b>
          </td>
          <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(20, $inspection_date_arr) AND !in_array(20, $blank)) ? 'bg-selected' : '' ?>">
            <b>20</b>
          </td>
          <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(21, $inspection_date_arr) AND !in_array(21, $blank)) ? 'bg-selected' : '' ?>">
            <b>21</b>
          </td>
          <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(22, $inspection_date_arr) AND !in_array(22, $blank)) ? 'bg-selected' : '' ?>">
            <b>22</b>
          </td>
          <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(23, $inspection_date_arr) AND !in_array(23, $blank)) ? 'bg-selected' : '' ?>">
            <b>23</b>
          </td>
          <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(24, $inspection_date_arr) AND !in_array(24, $blank)) ? 'bg-selected' : '' ?>">
            <b>24</b>
          </td>
          <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(25, $inspection_date_arr) AND !in_array(25, $blank)) ? 'bg-selected' : '' ?>">
            <b>25</b>
          </td>
          <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(26, $inspection_date_arr) AND !in_array(26, $blank)) ? 'bg-selected' : '' ?>">
            <b>26</b>
          </td>
          <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(27, $inspection_date_arr) AND !in_array(27, $blank)) ? 'bg-selected' : '' ?>">
            <b>27</b>
          </td>
          <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(28, $inspection_date_arr) AND !in_array(28, $blank)) ? 'bg-selected' : '' ?>">
            <b>28</b>
          </td>
          <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(29, $inspection_date_arr) AND !in_array(29, $blank)) ? 'bg-selected' : '' ?>">
            <b>29</b>
          </td>
          <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(30, $inspection_date_arr) AND !in_array(30, $blank)) ? 'bg-selected' : '' ?>">
            <b>30</b>
          </td>
          <td style="text-align:center; padding-bottom: 4px;" class="<?= (in_array(31, $inspection_date_arr) AND !in_array(31, $blank)) ? 'bg-selected' : '' ?>">
            <b>31</b>
          </td>
        </tr> 
    <tr>
      <td colspan="22" style="text-align:left; padding-bottom: 4px; padding-left: 4px; font-size: 12px !important;">
        <b>Document Ref
          :<br>
          <?php if ($method == $ndt_master[1]) { ?>
              <?= $acceptance_criteria_form[$ndt[0]['id_project']][$ndt[0]['company_id']][$ndt[0]['discipline']][$ndt[0]['module']][$ndt[0]['type_of_module']][$ndt[0]['class']]['ndt']['rt']['procedure'] ?>

            <?php } else if($method == $ndt_master[2]) {  ?>
              <?= $acceptance_criteria_form[$ndt[0]['id_project']][$ndt[0]['company_id']][$ndt[0]['discipline']][$ndt[0]['module']][$ndt[0]['type_of_module']][$ndt[0]['class']]['ndt']['mt']['procedure'] ?>
              
            <?php } else if($method == $ndt_master[3]) {  ?>
              <?= $acceptance_criteria_form[$ndt[0]['id_project']][$ndt[0]['company_id']][$ndt[0]['discipline']][$ndt[0]['module']][$ndt[0]['type_of_module']][$ndt[0]['class']]['ndt']['ut']['procedure'] ?>
              
            <?php } else if($method == $ndt_master[7]) {  ?>
              <?= $acceptance_criteria_form[$ndt[0]['id_project']][$ndt[0]['company_id']][$ndt[0]['discipline']][$ndt[0]['module']][$ndt[0]['type_of_module']][$ndt[0]['class']]['ndt']['pt']['procedure'] ?>
              
            <?php } ?>
          <?php // test_var($acceptance_criteria_form) ?>
      </td>
    </tr>
    <tr>
      <td colspan="22" style="text-align:left; padding-bottom: 4px; ">Discipline : &nbsp;&nbsp;
        <?php if ($ndt[0]['discipline'] == '2') { ?><input type="checkbox" name="optiona" id="opta" checked /><?php } else { ?><input type="checkbox" name="optiona" id="opta" /><?php } ?><span class="checkboxtext"> &nbsp;&nbsp;STRUCTURAL&nbsp;&nbsp;&nbsp;&nbsp;</span>

        <input type="checkbox" name="optiona" id="opta" /><span class="checkboxtext"> &nbsp;&nbsp;E &
          I&nbsp;&nbsp;&nbsp;&nbsp;</span>
        <input type="checkbox" name="optiona" id="opta" /><span class="checkboxtext">
          &nbsp;&nbsp;MECHANICAL&nbsp;&nbsp;&nbsp;&nbsp;</span>
        <?php if ($ndt[0]['discipline'] == '1') { ?><input type="checkbox" name="optiona" id="opta" checked="" /><?php } else { ?><input type="checkbox" name="optiona" id="opta" /><?php } ?><span class="checkboxtext"> &nbsp;&nbsp;PIPING&nbsp;&nbsp;&nbsp;&nbsp;</span>
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
              <input type="checkbox" name="optiona" id="opta" />
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
              <input type="checkbox" name="optiona" id="opta" checked/>
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
    $joint_no_check = [];
    foreach ($ndt as $key => $value) : ?>
      <?php
	      if ($value['rejected_client_remarks'] != '') {
	        $comment_list[] = $value['rejected_client_remarks'];
	      }

        $check = $visual_list[$value['id_joint']]['joint_no'].($visual_list[$value['id_joint']]['revision']>0 ? $visual_list[$value['id_joint']]['revision_category'].$visual_list[$value['id_joint']]['revision'] : '' );
        if(in_array($check, $joint_no_check)){
          continue;
        }
        $joint_no_check[] = $check;
      ?>
      <tr>
        <td colspan="1" style="text-align: center; padding-bottom: 4px; font-size: 10px !important; border-top: none; border-bottom: none;"><?php echo $no; ?></td>
        <td colspan="6" style="text-align: center; padding-bottom: 4px; font-size: 10px !important; border-top: none; border-bottom: none;">Joint# : <?php echo $visual_list[$value['id_joint']]['joint_no'].($visual_list[$value['id_joint']]['revision']>0 ? $visual_list[$value['id_joint']]['revision_category'].$visual_list[$value['id_joint']]['revision'] : '' ); ?> </td>
        <td colspan="7" style="text-align: center; padding-bottom: 4px; font-size: 10px !important; border-top: none; border-bottom: none;"><?php echo $visual_list[$value['id_joint']]['drawing_wm']; ?> </td>
        <td colspan="3" style="text-align: center; padding-bottom: 4px; font-size: 10px !important; border-top: none; border-bottom: none;">
          <?php  
            echo $area_v2[$location_v2[$ndt[0]['transmittal_inspection_location']]["id_area"]] . ' - ' . $location_v2[$ndt[0]['transmittal_inspection_location']]["name"];
          ?>    
        </td>
        <td colspan="5" style="text-align: center; padding-bottom: 4px; font-size: 10px !important; border-top: none; border-bottom: none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $ndt[0]['rfi_expected_time'] ?></td>
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
  <?php
    $total_colspan = 4;
    if($visual[0]['company_id'] != 5){
      $total_colspan = 3;
    }
  ?>
  <div style="page-break-inside: avoid;">
    <table  border="1px" style="border-collapse: collapse !important;" width="100%">
      <tr>
        <td colspan="<?= $total_colspan ?>" style="text-align:center; padding-bottom: 4px; font-size: 12px !important;"><b>LEGEND : INSPECTION AUTHORITY AS PER ITP</b></td>
      </tr>          
      <tr>
        <td colspan="<?= $total_colspan ?>" style="padding-bottom: 4px; font-size: 13px !important;font-weight: bold;">  
          <table width="100%">
              <tr>
                  <td><input type="checkbox" <?php if(in_array(1,explode(';', $ndt[0]['transmittal_inspection_authority']))){ echo "checked"; } ?>/> Hold Point</td>
                  <td><input type="checkbox" <?php if(in_array(2,explode(';', $ndt[0]['transmittal_inspection_authority']))){ echo "checked"; } ?>/> Witness</td>
                  <td><input type="checkbox" <?php if(in_array(3,explode(';', $ndt[0]['transmittal_inspection_authority']))){ echo "checked"; } ?>/> Monitoring</td>
                  <td><input type="checkbox" <?php if(in_array(4,explode(';', $ndt[0]['transmittal_inspection_authority']))){ echo "checked"; } ?>/> Review</td>
              </tr>
          </table>
        </td>
      </tr>      
    <!-- </table>
    <br>
    <table  border="1px" style="border-collapse: collapse !important;" width="100%"> -->
      <tr>
        <td colspan="<?= $total_colspan ?>" style="text-align:center; padding-bottom: 4px; font-size: 12px !important;"><b>INSPECTION EXCECUTION RESULT</b></td>
      </tr>          
      <tr>
        <td colspan="<?= $total_colspan ?>" style="text-align:left; padding-bottom: 4px; font-size: 13px !important;font-weight: bold;text-align: center;">          
          <input  type="checkbox" name="optiona" id="opta" / <?= $ndt[0]['status_inspection']==7 ? 'checked' : '' ?>><span class="checkboxtext"> &nbsp;Accepted:&nbsp; </span>
          <input  type="checkbox" name="optiona" id="opta" / <?= $ndt[0]['status_inspection']==9 ? 'checked' : '' ?>><span class="checkboxtext"> &nbsp;Accepted & Release With Comments : &nbsp; </span>        
          <input  type="checkbox" name="optiona" id="opta" / <?= $ndt[0]['status_inspection']==6 ? 'checked' : '' ?>><span class="checkboxtext"> &nbsp;Rejected :&nbsp; </span>
          <input  type="checkbox" name="optiona" id="opta" / <?= $ndt[0]['status_inspection']==10 ? 'checked' : '' ?>><span class="checkboxtext"> &nbsp;Postponed :&nbsp; </span>
          <input  type="checkbox" name="optiona" id="opta" / <?= $ndt[0]['status_inspection']==11 ? 'checked' : '' ?>><span class="checkboxtext"> &nbsp;Re-Offer :&nbsp; </span>
        </td>
      </tr>
      <tr>
        <td colspan="<?= $total_colspan ?>" style="text-align:left; padding-bottom: 4px; font-size: 12px !important; min-height: 15px !important"><b>Comment/Remarks :<br/></b>
          &nbsp;&nbsp;&nbsp;&nbsp;<?= $transmittal['client_remarks'] ?>
        </td>
      </tr>
   
      <tr>
        <td colspan="<?= $total_colspan ?>" style="text-align:center; padding-bottom: 4px; font-size: 10px !important;"><b>SIGNATURE FOR INSPECTION EXECUTED</b></td>
      </tr>
    <!-- </table>
    <br>
    <table width="100%" border="1px" style="border-collapse: collapse;"> -->
        <tr>
          <!-- <td style="text-align:center; padding-bottom: 4px; font-size: 12px !important;text-align: center;font-weight: bold;">SUPLIER</td> -->
          <?php if($visual[0]['company_id'] == 5): ?>
          <td style="text-align:center; padding-bottom: 4px; font-size: 12px !important;text-align: center;font-weight: bold; width:33.33%;" >DSAW</td>
          <?php endif; ?>
          <td style="text-align:center; padding-bottom: 4px; font-size: 12px !important;text-align: center;font-weight: bold; width:33.33%;" >CONTRACTOR</td>
          <td style="text-align:center; padding-bottom: 4px; font-size: 12px !important;text-align: center;font-weight: bold; width:33.33%;">COMPANY</td>
          <td style="text-align:center; padding-bottom: 4px; font-size: 12px !important;text-align: center;font-weight: bold; width:33.33%;">THIRD PARTY</td>
        </tr>
        <tr>
          <!-- <td style="padding-bottom: 4px; font-size: 10px !important;">NAME</td> -->
          <?php if (isset($ndt[0]['transmit_by'])) : ?>
            <td style="padding-bottom: 4px; font-size: 10px !important;">NAME <b><?= $user[$ndt[0]["transmit_by"]]["full_name"] ?></b></td>
            <?php else : ?>
            <td style="padding-bottom: 4px; font-size: 10px !important;">NAME <b><?= $user[$ndt[0]["created_by"]]["full_name"] ?></b></td>
            <?php endif ?>
            
          <?php if($visual[0]['company_id'] == 5): ?>
          <td style="padding-bottom: 4px; font-size: 10px !important;">NAME <b><?= $user_sign['inspector']['full_name'] ?></b></td>
          <?php endif ?>
          <td style="padding-bottom: 4px; font-size: 10px !important;">NAME <b><?= $user_sign['client']['full_name'] ?></b></td>
          <td style="padding-bottom: 4px; font-size: 10px !important;">NAME <b><?= $user_sign['3rd']['full_name'] ?></b></td>
        </tr>
         <tr>
          <!-- <td style="padding-bottom: 4px; font-size: 10px !important;">SIGNATURE<br/></td> -->

            <?php if (isset($ndt[0]['transmit_by'])) : ?>
                <td style="padding-bottom: 4px; font-size: 10px !important;">SIGNATURE<br/>
                    <img src="data:image/png;base64,<?= $user[$ndt[0]["transmit_by"]]["sign_approval"] ?>" style="width:80px;height:80px;">
                </td>
            <?php else : ?>
                <td style="padding-bottom: 4px; font-size: 10px !important;">SIGNATURE<br/>
                    <img src="data:image/png;base64,<?= $user[$ndt[0]["created_by"]]["sign_approval"] ?>" style="width:80px;height:80px;">
                </td>            
            <?php endif ?>

          <?php if($visual[0]['company_id'] == 5): ?>
          <td style="padding-bottom: 4px; font-size: 10px !important;">SIGNATURE<br/>
          	<?php if(isset($ndt[0]['inspection_by'])){ ?>
            	<img src="data:image/png;base64,<?= $user_sign['inspector']['sign_approval'] ?>" style="width:80px;height:80px;">
            <?php } ?>
          </td>
          <?php endif ?>

          <td style="padding-bottom: 4px; font-size: 10px !important;">SIGNATURE<br/>
            <?php // if(isset($ndt[0]['inspection_client_by'])){ ?>
            	<!-- <img src="data:image/png;base64,<?= $user_sign['client']['sign_approval'] ?>" style="width:80px;height:80px;"> -->
            	<div style="page-break-inside: avoid;">
	            	<?php if ($ndt[0]['project_code'] == 17) : ?>
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
		                  ($ndt[0]['ticked_report_date'] == 1 ? 
		                  (isset($ndt[0]['document_approval_by']) ? "<b>".date("Y-m-d",strtotime($ndt[0]['document_approval_date']))."</b>"
		                  : '') : 
		                  (isset($ndt[0]['inspection_by']) ? "<b>".date("Y-m-d",strtotime($ndt[0]['inspection_datetime']))."</b>"
		                  : '') ) 
		                ?>
	                  &nbsp;
	                  <span style="z-index: 99 !important;">Signature :</span>

	                </div>
	                <div class="text-right" style="padding-right: 5px; padding-bottom:3px;">
            				<?php if(isset($ndt[0]['inspection_client_by'])){ ?>
	                  	<img src="data:image/png;base64, <?= $user_sign['client']['sign_approval'] ?>" style='width: 3cm !important; height: 2.8cm !important; position: absolute !important; margin-left: 100px !important; margin-top: -117px !important; z-index: -99 !important; 
/*	                  		border: 5px solid #555;*/
	                  		' />
            				<?php } ?>
	                </div>
	              <?php else: ?>
            			<?php if(isset($ndt[0]['inspection_client_by'])){ ?>
	                	<img src="data:image/png;base64,<?= $user_sign['client']['sign_approval'] ?>" style='width: 3.5cm;vertical-align: text-bottom !important;' />
            			<?php } ?>
	            	<?php endif; ?>
            	</div>
            <?php // } ?>
          </td>

          <td style="padding-bottom: 4px; font-size: 10px !important;">SIGNATURE<br/>
          <?php if(isset($ndt[0]['third_party_approval_by'])){ ?>
            	<img src="data:image/png;base64,<?= $user_sign['3rd']['sign_approval'] ?>" style="width:80px;height:80px;">
            <?php } ?>
          </td>
        </tr>
         <tr>
          <!-- <td style="padding-bottom: 4px; font-size: 10px !important;">Date</td> -->
          <td style="padding-bottom: 4px; font-size: 10px !important;">Date 
            	<b><?php echo DATE("d F Y", strtotime($ndt[0]["transmit_date"])) ?></b>
          </td>
          
          <?php if($visual[0]['company_id'] == 5): ?>
          <td style="padding-bottom: 4px; font-size: 10px !important;">Date 
          	<?php if(isset($ndt[0]['inspection_by'])){ ?>
            	<b>
            		<?= 
                  ($ndt[0]['ticked_report_date'] == 1 ? 
                  (isset($ndt[0]['document_approval_by']) ? "<b>".date("Y-m-d",strtotime($ndt[0]['document_approval_date']))."</b>"
                  : '') : 
                  (isset($ndt[0]['inspection_by']) ? "<b>".date("Y-m-d",strtotime($ndt[0]['inspection_datetime']))."</b>"
                  : '') ) 
                ?>
            	</b>
            <?php } ?>
          </td>
          <?php endif; ?>
          <td style="padding-bottom: 4px; font-size: 10px !important;">Date 
            <?php if(isset($ndt[0]['inspection_client_by'])){ ?>
            	<b><?php echo date("Y-m-d",strtotime($ndt[0]['inspection_client_datetime'])); ?></b>
            <?php } ?>
          </td>
          <td style="padding-bottom: 4px; font-size: 10px !important;">Date
        
          <?php if(isset($ndt[0]['third_party_approval_date'])){ ?>
            	<b><?php echo date("Y-m-d",strtotime($ndt[0]['third_party_approval_date'])); ?></b>
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