<?php $transmittal = $rfi_client[0];
$comment_list      = [];

$checked_type               = "";

$legend_inspection          = explode(";", $transmittal['legend_inspection_auth']);
if ($legend_inspection[0] == 1) {
  $checked_type             = "hold";
} elseif ($legend_inspection[1] == 1) {
  $checked_type             = "witness";
} elseif ($legend_inspection[2] == 1 || $legend_inspection[3] == 1) {
  $checked_type             = "review";
}

// test_var($transmittal);

$rfi_no_format = $master_report_number[$rfi_client[0]['project_code']][$rfi_client[0]['discipline']][$rfi_client[0]['type_of_module']]['fitup_rfi'] . '' . $transmittal['report_number'];


if ($transmittal['company_id'] == 13) {
  $rfi_no_format = $master_report_number[$rfi_client[0]['project_code']][$rfi_client[0]['discipline']][$rfi_client[0]['type_of_module']]['fitup_rfi_scm'] . '' . $transmittal['report_number'];
}

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
  <title><?php echo $rfi_no_format ?>.pdf</title>
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
        <td style="padding: 5px;vertical-align: middle !important;"><b><?= $rfi_no_format ?>
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
            <img src="<?php echo $project_name[$rfi_client[0]['project']]['client_logo']; ?>" style="width: 120px;">
          </center>
        </td>
        <td style="padding: 5px;vertical-align: middle !important;">
          <b><?php echo strtoupper($project_name[$rfi_client[0]['project']]['description']) ?></b>
        </td>
        <td style="padding: 5px;vertical-align: middle !important;">
          <b><?php 
	          if($rfi_client[0]['status_inspection'] <= 3){ 
	            echo date("d F Y",strtotime($rfi_client[0]['date_request'])); 
	          } else { 
	            echo 
	            ( 
	              $rfi_client[0]['ticked_report_date'] == 1 ? 
	              date("d F Y",strtotime($max_array_date_document_approval)) : 
	              date("d F Y",strtotime($max_array_date_inspection))
	            );
	          } 
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
          :
          <table width="100%">
              <!-- <tr>
                <td>
                  <left>
                  <table>
                    <tr>                       
                      <td><left>• 07555701 (B) - E.80 Fabrication and Construction</left></td>
                    </tr>
                    <tr>                  
                      <td><left>• 08307791 - Inspection Test Procedure - <?= $discipline_name[$rfi_client[0]['discipline']] ?></left></td>
                    </tr>
                    <tr>                  
                      <td><left>• 08308559 - In-process Inspection procedure</left></td>
                    </tr>
                  </table>
                  </left>
                </td>
              </tr> -->
                <?php echo $master_acceptance[$rfi_client[0]['project_code']][$rfi_client[0]['company_id']][$rfi_client[0]['discipline']][$rfi_client[0]['module']][$rfi_client[0]['type_of_module']][$rfi_client[0]['class']]['fitup']['procedure']; ?>

            </table>
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
              <input type="checkbox" name="optiona" id="opta" checked />
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

    $no = 1;
    foreach ($rfi_client as $key => $value) : ?>
      <?php

      if ($value['rejected_client_remarks'] != '') {
        $comment_list[] = $value['rejected_client_remarks'];
      }

      ?>
      <tr>
        <td colspan="1" style="text-align: center; padding-bottom: 4px; font-size: 10px !important; border-top: none; border-bottom: none;">
          <?= $no++ ?></td>
        <td colspan="6" style="text-align: center; padding-bottom: 4px; font-size: 10px !important; border-top: none; border-bottom: none;">
          Joint# : <?php echo $value['joint_no']; ?></td>
        <td colspan="7" style="text-align: center; padding-bottom: 4px; font-size: 10px !important; border-top: none; border-bottom: none;"><?php echo $value['drawing_wm']; ?></td>
        <td colspan="3" style="text-align: center; padding-bottom: 4px; font-size: 10px !important; border-top: none; border-bottom: none;">
        	<?= (isset($value['area_v2']) && isset($value['location_v2']) ?  $area_name_arr_v2[$value['area_v2']].",".$location_name_arr_v2[$value['location_v2']] : (isset($area_name_arr[$value['area']]) ? $area_name_arr[$value['area']] : null)) ?>
        </td>
        <td colspan="5" style="text-align: center; padding-bottom: 4px; font-size: 10px !important; border-top: none; border-bottom: none;">
          <?= $value['time_inspect'] ?></td>
      </tr>
    <?php endforeach; ?>

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
    <table border="1px" style="border-collapse: collapse !important;" width="100%">
      <tr>
        <td colspan="3" style="text-align:center; padding-bottom: 4px; font-size: 12px !important;"><b>LEGEND :
            INSPECTION AUTHORITY AS PER ITP</b></td>
      </tr>

      <tr>
        <?php

        $inspection_auth = $transmittal['legend_inspection_auth'];
        $inspection_auth = explode(";", $inspection_auth);
        ?>
        <td colspan="3" style="text-align:left; padding-bottom: 4px; font-size: 13px !important;font-weight: bold;">
          <input type="checkbox" name="optiona" id="opta" style="font-size: 15pt !important; padding-bottom: 4px;" <?= $inspection_auth[0] == 1 ? 'checked' : '' ?> /><span class="checkboxtext"> &nbsp;Hold
            Point&nbsp; </span>
          &nbsp;
          &nbsp;
          &nbsp;
          &nbsp;
          &nbsp;
          &nbsp;
          &nbsp;
          &nbsp;
          &nbsp;
          &nbsp;
          &nbsp;
          &nbsp;
          <input type="checkbox" name="optiona" id="opta" style="font-size: 15pt !important; padding-bottom: 4px;" <?= $inspection_auth[1] == 1 ? 'checked' : '' ?> /><span class="checkboxtext"> &nbsp;Witness&nbsp;
          </span>
          &nbsp;
          &nbsp;
          &nbsp;
          &nbsp;
          &nbsp;
          &nbsp;
          &nbsp;
          &nbsp;
          &nbsp;
          &nbsp;
          &nbsp;
          &nbsp;
          <input type="checkbox" name="optiona" id="opta" style="font-size: 15pt !important; padding-bottom: 4px;" <?= $inspection_auth[2] == 1 ? 'checked' : '' ?> /><span class="checkboxtext">
            &nbsp;Monitoring&nbsp; </span>
          &nbsp;
          &nbsp;
          &nbsp;
          &nbsp;
          &nbsp;
          &nbsp;
          &nbsp;
          &nbsp;
          &nbsp;
          &nbsp;
          &nbsp;
          &nbsp;
          <input type="checkbox" name="optiona" id="opta" style="font-size: 15pt !important; padding-bottom: 4px;" <?= $inspection_auth[3] == 1 ? 'checked' : '' ?> /><span class="checkboxtext"> &nbsp;Review&nbsp;
          </span>
          &nbsp;


        </td>
      </tr>


      <tr>
        <td colspan="3" style="text-align:center; padding-bottom: 4px; font-size: 12px !important;"><b>INSPECTION
            EXECUTION
            RESULT</b></td>
      </tr>
      <tr>
        <td colspan="3" style="text-align:left; padding-bottom: 4px; font-size: 13px !important;font-weight: bold;text-align: center;">
          <input type="checkbox" name="optiona" id="opta" style="font-size: 15pt !important; padding-bottom: 4px;" <?= $transmittal['status_inspection'] == 7 ? 'checked' : '' ?> /><span class="checkboxtext">
            &nbsp;Accepted:&nbsp;
          </span>
          <input type="checkbox" name="optiona" id="opta" style="font-size: 15pt !important; padding-bottom: 4px;" <?= $transmittal['status_inspection'] == 9 ? 'checked' : '' ?> /><span class="checkboxtext"> &nbsp;Accepted
            &
            Release With
            Comments : &nbsp; </span>
          <input type="checkbox" name="optiona" id="opta" style="font-size: 15pt !important; padding-bottom: 4px;" <?= $transmittal['status_inspection'] == 6 ? 'checked' : '' ?> /><span class="checkboxtext"> &nbsp;Rejected
            :&nbsp; </span>
          <input type="checkbox" name="optiona" id="opta" style="font-size: 15pt !important; padding-bottom: 4px;" <?= $transmittal['status_inspection'] == 10 ? 'checked' : '' ?> /><span class="checkboxtext">
            &nbsp;Postponed
            :&nbsp; </span>
          <input type="checkbox" name="optiona" id="opta" style="font-size: 15pt !important; padding-bottom: 4px;" <?= $transmittal['status_inspection'] == 11 ? 'checked' : '' ?> /><span class="checkboxtext"> &nbsp;Re-Offer
            :&nbsp; </span>
        </td>
      </tr>
      <tr>
        <td colspan="3" style="text-align:center; padding-bottom: 4px; font-size: 12px !important;"><b>INSPECTION
            EXECUTION
            RESULT</b></td>
      </tr>
      <tr>
        <td colspan="3" style="text-align:left; padding-bottom: 4px; font-size: 12px !important;"><b>Comment/Remarks
            :<br />

            <?php if (count($comment_list) > 0) : ?>
              <ul>
                <?php foreach ($comment_list as $key => $value) : ?>
                  <li><?= $value ?></li>
                <?php endforeach; ?>
              </ul>
            <?php else : ?>
              <br /><br />
            <?php endif; ?>
          </b></td>
      </tr>
      <!-- <tr>
        <td style="text-align:left; padding-bottom: 4px; font-size: 10px !important;">
          <table width="100%"  style="border-collapse: collapse;text-align: center;">
            <tr>
              <td rowspan="2">INSPECTION AUTHORITY</td>
              <td colspan="4">SUPLIER</td>
              <td colspan="4">CONTRACTOR</td>
              <td colspan="4">EMPLOYER</td>
              <td colspan="4">THIRD PARTY</td>
            </tr>
            <tr>
              <td><input  type="checkbox" name="optiona" id="opta" /><span class="checkboxtext">H</span></td>
              <td><input  type="checkbox" name="optiona" id="opta" /><span class="checkboxtext">W</span></td>
              <td><input  type="checkbox" name="optiona" id="opta" /><span class="checkboxtext">M</span></td>
              <td><input  type="checkbox" name="optiona" id="opta" /><span class="checkboxtext">R</span></td>

              <td><input  type="checkbox" name="optiona" id="opta" /><span class="checkboxtext">H</span></td>
              <td><input  type="checkbox" name="optiona" id="opta" /><span class="checkboxtext">W</span></td>
              <td><input  type="checkbox" name="optiona" id="opta" /><span class="checkboxtext">M</span></td>
              <td><input  type="checkbox" name="optiona" id="opta" /><span class="checkboxtext">R</span></td>

              <td><input  type="checkbox" name="optiona" id="opta" /><span class="checkboxtext">H</span></td>
              <td><input  type="checkbox" name="optiona" id="opta" /><span class="checkboxtext">W</span></td>
              <td><input  type="checkbox" name="optiona" id="opta" /><span class="checkboxtext">M</span></td>
              <td><input  type="checkbox" name="optiona" id="opta" /><span class="checkboxtext">R</span></td>

              <td><input  type="checkbox" name="optiona" id="opta" /><span class="checkboxtext">H</span></td>
              <td><input  type="checkbox" name="optiona" id="opta" /><span class="checkboxtext">W</span></td>
              <td><input  type="checkbox" name="optiona" id="opta" /><span class="checkboxtext">M</span></td>
              <td><input  type="checkbox" name="optiona" id="opta" /><span class="checkboxtext">R</span></td>
            </tr>
          </table>
        </td>
      </tr> -->
      <tr>
        <td colspan="3" style="text-align:center; padding-bottom: 4px; font-size: 10px !important;"><b>SIGNATURE FOR
            INSPECTION
            EXECUTED</b></td>
      </tr>

      <tr>
        <!-- <td style="text-align:center; padding-bottom: 4px; font-size: 12px !important;text-align: center;font-weight: bold;">SUPLIER</td> -->
        <td style="text-align:center; padding-bottom: 4px; font-size: 12px !important;text-align: center;font-weight: bold; width:33.33%;">
          CONTRACTOR</td>
        <td style="text-align:center; padding-bottom: 4px; font-size: 12px !important;text-align: center;font-weight: bold; width:33.33%;">
          EMPLOYER</td>
        <td style="text-align:center; padding-bottom: 4px; font-size: 12px !important;text-align: center;font-weight: bold; width:33.33%;">
          THIRD PARTY</td>
      </tr>
      <tr>
        <!-- <td style="padding-bottom: 4px; font-size: 10px !important;">NAME</td> -->
        <td style="padding-bottom: 4px; font-size: 10px !important;">NAME <b>
            <?php $arr_sign_contra = [3, 5, 6, 7, 8] ?>
            <?php if(in_array($rfi_client[0]['status_inspection'], $arr_sign_contra)){ ?>
            <?= ($rfi_client[0]['ticked_report_date'] == 1 ? (isset($rfi_client[0]['document_approval_by']) ? $user[$rfi_client[0]['document_approval_by']]['full_name'] : '') : (isset($rfi_client[0]['inspection_by']) ?  $user[$rfi_client[0]['inspection_by']]['full_name'] : '') ) ?>   
            <?php } ?>  
        </b></td>
        <td style="padding-bottom: 4px; font-size: 10px !important;">NAME <b>
          <?php if($rfi_client[0]['status_inspection']==7){ ?>
            <?= $user[$rfi_client[0]['client_inspection_by']]['full_name'] ?>
          <?php } ?>  
        </b></td>
        <td style="padding-bottom: 4px; font-size: 10px !important;">NAME</td>
      </tr>
       <tr>
        <!-- <td style="padding-bottom: 4px; font-size: 10px !important;">SIGNATURE<br/></td> -->
        <td style="padding-bottom: 4px; font-size: 10px !important;">SIGNATURE<br/>
            <?php $arr_sign_contra = [3, 5, 6, 7, 8] ?>
            <?php if(in_array($rfi_client[0]['status_inspection'], $arr_sign_contra)){ ?>
              <img style="width:80px;height:80px;max-height:150px;text-align:center;" src="data:image/png;base64,<?= ($rfi_client[0]['ticked_report_date'] == 1 ? (isset($rfi_client[0]['document_approval_by']) ? $user[$rfi_client[0]['document_approval_by']]['sign_approval'] : '') : (isset($rfi_client[0]['inspection_by']) ?  $user[$rfi_client[0]['inspection_by']]['sign_approval'] : '') ) ?>">
            <?php } ?>
        </td>

        <td style="padding-bottom: 4px; font-size: 10px !important;">SIGNATURE<br/>
            <?php //if($rfi_client[0]['status_inspection']==7){ ?>
              <?php //if(isset($rfi_client[0]['client_inspection_by'])){ ?>
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
                        <td><input type="checkbox" style="margin-bottom: 8px" <?= $inspection_auth[3] == 1 ? 'checked' : '' ?>></td>
                      </tr>
                      <tr>
                        <td width="40%" class="valign_middle">Witness</td>
                        <td><input type="checkbox" style="margin-bottom: 8px" <?= $inspection_auth[0]==1 OR $inspection_auth[1]==1 ? 'checked' : '' ?>></td>
                      </tr>
                      <tr>
                        <td width="40%" class="valign_middle">Inspect</td>
                        <td><input type="checkbox" style="margin-bottom: 8px" <?= $inspection_auth[0]==1 ? 'checked' : '' ?>></td>
                      </tr>
                    </table>
                    <br>
                    Date : <?= $rfi_client[0]['client_inspection_date'] ? date('Y-m-d', strtotime($rfi_client[0]['client_inspection_date'])) : space(15) ?>
                    &nbsp;
                    <span style="z-index: 99 !important;">Signature :</span>

                  </div>
                  <div class="text-right" style="padding-right: 5px; padding-bottom:3px;">
                  	<?php if(isset($rfi_client[0]['client_inspection_by'])){ ?>
                    	<img src="data:image/png;base64, <?= $user[$rfi_client[0]['client_inspection_by']]['sign_approval'] ?>" style='width: 3cm !important; height: 2.8cm !important; position: absolute !important; margin-left: 100px !important; margin-top: -117px !important; z-index: -99 !important; 
/*                    		border: 5px solid #555;*/
                    		' />
                    <?php } ?>
                  </div>
                  <?php else: ?>
                  	<?php if(isset($rfi_client[0]['client_inspection_by'])){ ?>
                    	<img src="data:image/png;base64,<?= $user[$rfi_client[0]['client_inspection_by']]['sign_approval'] ?>" style='width: 3.5cm;vertical-align: text-bottom !important;' />
                    <?php } ?>
                <?php endif; ?>
              <?php //} ?>
            <?php //} ?>
        </td>

        <td style="padding-bottom: 4px; font-size: 10px !important;">SIGNATURE<br/>
        </td>
      </tr>
       <tr>
        <td style="padding-bottom: 4px; font-size: 10px !important;">Date  
            <?php $arr_sign_contra = [3, 5, 6, 7, 8] ?>
            <?php if(in_array($rfi_client[0]['status_inspection'], $arr_sign_contra)){ ?>  
                DATE :                 
                <?= 
                  ($rfi_client[0]['ticked_report_date'] == 1 ? 
                  (isset($rfi_client[0]['document_approval_by']) ? "<b>".date("d M Y",strtotime($max_array_date_document_approval))."</b>"
                  : '') : 
                  (isset($rfi_client[0]['inspection_by']) ? "<b>".date("d M Y",strtotime($max_array_date_inspection))."</b>"
                  : '') ) 
                ?>  
            <?php } ?>   
        </td>
        <td style="padding-bottom: 4px; font-size: 10px !important;">Date 
          <?php if($rfi_client[0]['status_inspection']==7){ ?>
            <?php if(isset($rfi_client[0]['client_inspection_date'])){ ?>
            <b><?php echo @date("d M Y",strtotime($rfi_client[0]['client_inspection_date'])); ?></b>
            <?php } ?>
          <?php } ?>
        </td>
        <td style="padding-bottom: 4px; font-size: 10px !important;">Date</td>
      </tr>
    </table>
    <!-- <table width="100%" border="1px" style="border-collapse: collapse;">
      
    </table> -->
  </div>
  <!-- </footer> -->

</body>

</html>