<?php
error_reporting(0);


?>
<!DOCTYPE html>
<html>

<head>
  <title><?php echo $welding_rfi['rfi_no'] ?>.pdf</title>
  <style type="text/css">
    @page {
      margin: 0cm 0cm;
    }

    body {
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
      top: 18.25cm;
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
      vertical-align: middle !important;
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
  </style>
</head>

<body>

  <header>
    <table rules=none border="1px" style="border-collapse: collapse !important; margin-top: 10px !important;" width="100%">
      <tr>
        <td colspan="24" style="text-align:center; font-size: 12px !important;">

          <table width="100%" class="b_collapse">
            <tr>
              <td class="valign-middle" style="text-align: left !important" width="20%">
                <img src="img/seatrium_logo_bg_white.png" style="width: 140px;">
              </td>
              <td class="valign-middle" width="60%">
               <center> <h3 style="font-size: 20px !important;"><?= $project_list[$welding_rfi['project']]['description'] ?></h3></center>
              </td>
              <td class="valign-middle" style="text-align: right !important" width="20%">
                <img src="<?= $project_list[$welding_rfi['project']]['client_logo'] ?>" style="width: 110px;">

              </td>

            </tr>
          </table>

        </td>
      <tr>
        <td colspan="12" style="font-size: 10px !important;">
          EMPLOYER
          <br>
          <strong><?= strtoupper($project_list[$welding_rfi['project']]['client']) ?> </strong>
        </td>
        <td colspan="12" style="font-size: 10px !important;">
          RFI No:
          <br>
          <strong><?= $welding_rfi['rfi_no'] ?>
          </strong>
        </td>
      </tr>
      <tr>
        <td colspan="12" style="font-size: 10px !important;">
          PROJECT TITLE
          <br>
          <strong><?= strtoupper($project_list[$welding_rfi['project']]['description']) ?> </strong>
        </td>
        <td colspan="12" style="font-size: 10px !important;">
          Submited Date
          <br>
          <strong><?= date('d-M-Y', strtotime($welding_rfi['submit_date'])) ?> </strong>
        </td>
      </tr>
      <tr>
        <td colspan="12" style="font-size: 10px !important;">
          CONTRACTOR
          <br>
          <strong><?= strtoupper($welding_rfi['contractor']) ?></strong>
        </td>
        <td colspan="12" style="font-size: 10px !important;">
          Location Inspection
          <br>
          <strong><?= $welding_rfi['location'] ?> </strong>
        </td>
      </tr>
      <tr>
        <td colspan="24" style="text-align:center; padding-bottom: 4px; font-size: 11px !important;"><b>RFI - INSPECTION
            NOTIFICATION</b></td>
      </tr>
      <tr>
        <td colspan="6" style="text-align:center; padding-bottom: 4px;"><b>MONTH</b></td>
        <td colspan="18" style="text-align:center; padding-bottom: 4px;"><b>DAY</b></td>
      </tr>
      <tr>
        <?php

        $month  = intval(date('m', strtotime($welding_rfi['inspection_date'])));
        $day    = intval(date('d', strtotime($welding_rfi['inspection_date'])));

        ?>

        <td style="text-align:center; background-color: <?= $month == 1 ? '#5e615f;' : '#fffff;' ?> padding-bottom: 4px;">
          <b>JAN</b>
        </td>
        <td style="text-align:center; background-color: <?= $month == 2 ? '#5e615f;' : '#fffff;' ?> padding-bottom: 4px;">
          <b>FEB</b>
        </td>
        <td style="text-align:center; background-color: <?= $month == 3 ? '#5e615f;' : '#fffff;' ?> padding-bottom: 4px;">
          <b>MAR</b>
        </td>
        <td style="text-align:center; background-color: <?= $month == 4 ? '#5e615f;' : '#fffff;' ?> padding-bottom: 4px;">
          <b>APR</b>
        </td>
        <td style="text-align:center; background-color: <?= $month == 5 ? '#5e615f;' : '#fffff;' ?> padding-bottom: 4px;">
          <b>MAY</b>
        </td>
        <td style="text-align:center; background-color: <?= $month == 6 ? '#5e615f;' : '#fffff;' ?> padding-bottom: 4px;">
          <b>JUN</b>
        </td>
        <td rowspan='2' style="text-align:center; background-color: <?= $day == 1 ? '#5e615f;' : '#fffff;' ?> padding-bottom: 4px;vertical-align: middle !important;">
          <b>1</b>
        </td>
        <td style="text-align:center; background-color: <?= $day == 2 ? '#5e615f;' : '#fffff;' ?> padding-bottom: 4px;">
          <b>2</b>
        </td>
        <td style="text-align:center; background-color: <?= $day == 3 ? '#5e615f;' : '#fffff;' ?> padding-bottom: 4px;">
          <b>3</b>
        </td>
        <td style="text-align:center; background-color: <?= $day == 4 ? '#5e615f;' : '#fffff;' ?> padding-bottom: 4px;">
          <b>4</b>
        </td>
        <td style="text-align:center; background-color: <?= $day == 5 ? '#5e615f;' : '#fffff;' ?> padding-bottom: 4px;">
          <b>5</b>
        </td>
        <td style="text-align:center; background-color: <?= $day == 6 ? '#5e615f;' : '#fffff;' ?> padding-bottom: 4px;">
          <b>6</b>
        </td>
        <td style="text-align:center; background-color: <?= $day == 7 ? '#5e615f;' : '#fffff;' ?> padding-bottom: 4px;">
          <b>7</b>
        </td>
        <td style="text-align:center; background-color: <?= $day == 8 ? '#5e615f;' : '#fffff;' ?> padding-bottom: 4px;">
          <b>8</b>
        </td>
        <td style="text-align:center; background-color: <?= $day == 9 ? '#5e615f;' : '#fffff;' ?> padding-bottom: 4px;">
          <b>9</b>
        </td>
        <td style="text-align:center; background-color: <?= $day == 10 ? '#5e615f;' : '#fffff;' ?> padding-bottom: 4px;">
          <b>10</b>
        </td>
        <td style="text-align:center; background-color: <?= $day == 11 ? '#5e615f;' : '#fffff;' ?> padding-bottom: 4px;">
          <b>11</b>
        </td>
        <td style="text-align:center; background-color: <?= $day == 12 ? '#5e615f;' : '#fffff;' ?> padding-bottom: 4px;">
          <b>12</b>
        </td>
        <td style="text-align:center; background-color: <?= $day == 13 ? '#5e615f;' : '#fffff;' ?> padding-bottom: 4px;">
          <b>13</b>
        </td>
        <td style="text-align:center; background-color: <?= $day == 14 ? '#5e615f;' : '#fffff;' ?> padding-bottom: 4px;">
          <b>14</b>
        </td>
        <td style="text-align:center; background-color: <?= $day == 15 ? '#5e615f;' : '#fffff;' ?> padding-bottom: 4px;">
          <b>15</b>
        </td>
        <td style="text-align:center; background-color: <?= $day == 16 ? '#5e615f;' : '#fffff;' ?> padding-bottom: 4px;">
          <b>16</b>
        </td>
        <td style='border:none;'> </td>
        <td style='border:none;'> </td>
      </tr>
      <tr>

        <td style="text-align:center; background-color: <?= $month == 7 ? '#5e615f;' : '#fffff;' ?> padding-bottom: 4px;">
          <b>JUL</b>
        </td>
        <td style="text-align:center; background-color: <?= $month == 8 ? '#5e615f;' : '#fffff;' ?> padding-bottom: 4px;">
          <b>AUG</b>
        </td>
        <td style="text-align:center; background-color: <?= $month == 9 ? '#5e615f;' : '#fffff;' ?> padding-bottom: 4px;">
          <b>SEP</b>
        </td>
        <td style="text-align:center; background-color: <?= $month == 10 ? '#5e615f;' : '#fffff;' ?> padding-bottom: 4px;">
          <b>OCT</b>
        </td>
        <td style="text-align:center; background-color: <?= $month == 11 ? '#5e615f;' : '#fffff;' ?> padding-bottom: 4px;">
          <b>NOV</b>
        </td>
        <td style="text-align:center; background-color: <?= $month == 12 ? '#5e615f;' : '#fffff;' ?> padding-bottom: 4px;">
          <b>DEC</b>
        </td>

        <td style="text-align:center; background-color: <?= $day == 17 ? '#5e615f;' : '#fffff;' ?> padding-bottom: 4px;">
          <b>17</b>
        </td>
        <td style="text-align:center; background-color: <?= $day == 18 ? '#5e615f;' : '#fffff;' ?> padding-bottom: 4px;">
          <b>18</b>
        </td>
        <td style="text-align:center; background-color: <?= $day == 19 ? '#5e615f;' : '#fffff;' ?> padding-bottom: 4px;">
          <b>19</b>
        </td>
        <td style="text-align:center; background-color: <?= $day == 20 ? '#5e615f;' : '#fffff;' ?> padding-bottom: 4px;">
          <b>20</b>
        </td>
        <td style="text-align:center; background-color: <?= $day == 21 ? '#5e615f;' : '#fffff;' ?> padding-bottom: 4px;">
          <b>21</b>
        </td>
        <td style="text-align:center; background-color: <?= $day == 22 ? '#5e615f;' : '#fffff;' ?> padding-bottom: 4px;">
          <b>22</b>
        </td>
        <td style="text-align:center; background-color: <?= $day == 23 ? '#5e615f;' : '#fffff;' ?> padding-bottom: 4px;">
          <b>23</b>
        </td>
        <td style="text-align:center; background-color: <?= $day == 24 ? '#5e615f;' : '#fffff;' ?> padding-bottom: 4px;">
          <b>24</b>
        </td>
        <td style="text-align:center; background-color: <?= $day == 25 ? '#5e615f;' : '#fffff;' ?> padding-bottom: 4px;">
          <b>25</b>
        </td>
        <td style="text-align:center; background-color: <?= $day == 26 ? '#5e615f;' : '#fffff;' ?> padding-bottom: 4px;">
          <b>26</b>
        </td>
        <td style="text-align:center; background-color: <?= $day == 27 ? '#5e615f;' : '#fffff;' ?> padding-bottom: 4px;">
          <b>27</b>
        </td>
        <td style="text-align:center; background-color: <?= $day == 28 ? '#5e615f;' : '#fffff;' ?> padding-bottom: 4px;">
          <b>28</b>
        </td>
        <td style="text-align:center; background-color: <?= $day == 29 ? '#5e615f;' : '#fffff;' ?> padding-bottom: 4px;">
          <b>29</b>
        </td>
        <td style="text-align:center; background-color: <?= $day == 30 ? '#5e615f;' : '#fffff;' ?> padding-bottom: 4px;">
          <b>30</b>
        </td>
        <td style="text-align:center; background-color: <?= $day == 31 ? '#5e615f;' : '#fffff;' ?> padding-bottom: 4px;">
          <b>31</b>
        </td>
        <td style='border:none;'> </td>
        <td style='border:none;'> </td>
      </tr>
      <tr>
        <td colspan="24" style="text-align:left; padding: 5px; font-size: 11px !important;">Document Ref
          : <?= $welding_rfi['document_ref'] ?>
      </tr>
      <tr>
        <td colspan="24" style="text-align:left; padding-bottom: 4px; ">
          <span class="checkboxtext">DISCIPLINE : &nbsp;&nbsp;</span>
          <span class="checkboxtext"> STRUCTURE <input type="checkbox" name="optiona" id="opta" <?= $welding_rfi['discipline'] == 2 ? 'checked' : '' ?> />&nbsp;&nbsp;&nbsp;</span>

          <span class="checkboxtext">
            ELECTRICAL <input type="checkbox" name="optiona" id="opta" />&nbsp;&nbsp;&nbsp;</span>
          <span class="checkboxtext">
            INSTR/AUT <input type="checkbox" name="optiona" id="opta" />&nbsp;&nbsp;&nbsp;</span>
          <span class="checkboxtext">
            &nbsp;&nbsp;MECHANICAL <input type="checkbox" name="optiona" id="opta" <?= $welding_rfi['discipline'] == 9 ? 'checked' : '' ?> />&nbsp;&nbsp;&nbsp;</span>
          <span class="checkboxtext"> PIPING <input type="checkbox" name="optiona" id="opta" <?= $welding_rfi['discipline'] == 1 ? 'checked' : '' ?> />&nbsp;&nbsp;&nbsp;</span>
          <span class="checkboxtext"> HVAC<input type="checkbox" name="optiona" id="opta" <?= $welding_rfi['discipline'] == 4 ? 'checked' : '' ?> /><span class="checkboxtext">
              &nbsp;&nbsp;&nbsp;</span>
            <span class="checkboxtext"> TELECOM <input type="checkbox" name="optiona" id="opta" />&nbsp;&nbsp;&nbsp;</span>
            <span class="checkboxtext"> PACKAGE <input type="checkbox" name="optiona" id="opta" /></span>
        </td>
      </tr>
      <!-- <tr>
        <td colspan="24" style="text-align:left; padding-bottom: 4px; font-size: 12px !important;">TYPE OF INSPECTION :
        </td>
      </tr>
      <tr>
        <td colspan="24" style="text-align:left; padding-bottom: 4px; ">
          <table width="100%">
            <tr>
              <td style="text-align:left; padding-bottom: 4px;">
                <input type="checkbox" name="optiona" id="opta" checked />
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
                <input type="checkbox" name="optiona" id="opta" />
                <span class="checkboxtext"> &nbsp;&nbsp;Other&nbsp;&nbsp;&nbsp;&nbsp;</span>
              </td>
            </tr>
          </table>
        </td>
      </tr> -->
      <tr>
        <td colspan="1" style="vertical-align: middle !important; padding: 5px !important; font-weight: bold; padding-bottom: 4px; font-size: 9px !important;">
          <center>No.</center>
        </td>
        <td colspan="6" style="vertical-align: middle !important; padding: 5px !important; font-weight: bold; padding-bottom: 4px; font-size: 9px !important;">
          <center>ITEM / TAG NUMBER</center>
        </td>
        <td colspan="9" style="vertical-align: middle !important; padding: 5px !important; font-weight: bold; padding-bottom: 4px; font-size: 9px !important;">
          <center>ITEM /TAG DESCRIPTION</center>
        </td>
        <td colspan="3" style="vertical-align: middle !important; padding: 5px !important; font-weight: bold; padding-bottom: 4px; font-size: 9px !important;">
          <center>EXPECTED TIME</center>
        </td>
        <td colspan="2" style="vertical-align: middle !important; font-weight: bold; padding-bottom: 4px; font-size: 9px !important;">
          <center>ITP
            <br>
            Intervention
            <br>
            to Employer
          </center>
        </td>
        <td colspan="3" style="vertical-align: middle !important; font-weight: bold; padding-bottom: 4px; font-size: 9px !important;">
          <center>INSPECTION
            <br>
            EXECUTION
            <br>
            RESULT
          </center>
        </td>
        <!-- <td colspan="2" style="font-weight: bold; padding-bottom: 4px; font-size: 10px !important;"><center>PCMS</center></td> -->
      </tr>
      <tr>
        <td colspan="1" style="font-weight: bold; padding-bottom: 4px; font-size: 10px !important;">
          <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
        </td>
        <td colspan="6" style="font-weight: bold; padding-bottom: 4px; font-size: 10px !important;"></td>
        <td colspan="9" style="font-weight: bold; padding-bottom: 4px; font-size: 10px !important;"></td>
        <td colspan="3" style="font-weight: bold; padding-bottom: 4px; font-size: 10px !important;"></td>
        <td colspan="2" style="font-weight: bold; padding-bottom: 4px; font-size: 10px !important;"></td>
        <td colspan="3" style="font-weight: bold; padding-bottom: 4px; font-size: 10px !important;"></td>
        <!-- <td colspan="2" style="font-weight: bold; padding-bottom: 4px; font-size: 10px !important;"></td> -->
      </tr>


    </table>

    <!--  <table  border="1px" style="border-collapse: collapse !important;" width="100%">
      <tr>
        <td style="padding-bottom: 4px; font-size: 12px !important;"><b>STRUCTURAL MATERIAL TRACEABILITY REPORT</b></td>
      </tr>
      <tr>
       <td><b>QUALITY CONTROL DEPARTMENT</b></td>
      </tr>
    </table> -->

  </header>

  <footer>
    <table border="1px" style="border-collapse: collapse !important;" width="100%">
      <tr>
        <td style="text-align:center; padding-bottom: 4px; font-size: 12px !important;"><b>LEGEND : INSPECTION
            EXCECUTION
            RESULT</b></td>
      </tr>
      <tr>
        <td style="text-align:left; padding-bottom: 4px; font-size: 13px !important;font-weight: bold;text-align: center;">
          ACCEPTED ;&nbsp; </span>
          REJECTED ;&nbsp; </span>
          POSTPONED ;&nbsp; </span>
          CANCELED&nbsp; </span>
        </td>
      </tr>
      <tr>
        <td style="text-align:left; padding-bottom: 4px; font-size: 12px !important;">Comment/Remarks
          :<br /><br /><br /><br /><br /><br /><br /><br /></b></td>
      </tr>
      <!-- <tr>
        <td style="text-align:left; padding-bottom: 4px; font-size: 10px !important;">
          <table width="100%" style="border-collapse: collapse;text-align: center;">
            <tr>
              <td rowspan="2">INSPECTION AUTHORITY</td> -->
      <!-- <td colspan="4">SUPLIER</td> -->
      <!-- <td class="ball" colspan="4">CONTRACTOR</td>
              <td class="ball" colspan="4">EMPLOYER</td>
              <td class="ball" colspan="4">THIRD PARTY</td>
            </tr>
            <tr>
              <td class="ball"><input type="checkbox" name="optiona" style="margin-top: 15px !important;" id="opta" /><span class="checkboxtext">H</span></td>
              <td class="ball"><input type="checkbox" name="optiona" style="margin-top: 15px !important;" id="opta" /><span class="checkboxtext">W</span></td>
              <td class="ball"><input type="checkbox" name="optiona" style="margin-top: 15px !important;" id="opta" /><span class="checkboxtext">M</span></td>
              <td class="ball"><input type="checkbox" name="optiona" style="margin-top: 15px !important;" id="opta" /><span class="checkboxtext">R</span></td>

              <td class="ball"><input type="checkbox" name="optiona" style="margin-top: 15px !important;" id="opta" /><span class="checkboxtext">H</span></td>
              <td class="ball"><input type="checkbox" name="optiona" style="margin-top: 15px !important;" id="opta" /><span class="checkboxtext">W</span></td>
              <td class="ball"><input type="checkbox" name="optiona" style="margin-top: 15px !important;" id="opta" /><span class="checkboxtext">M</span></td>
              <td class="ball"><input type="checkbox" name="optiona" style="margin-top: 15px !important;" id="opta" /><span class="checkboxtext">R</span></td>

              <td class="ball"><input type="checkbox" name="optiona" style="margin-top: 15px !important;" id="opta" /><span class="checkboxtext">H</span></td>
              <td class="ball"><input type="checkbox" name="optiona" style="margin-top: 15px !important;" id="opta" /><span class="checkboxtext">W</span></td>
              <td class="ball"><input type="checkbox" name="optiona" style="margin-top: 15px !important;" id="opta" /><span class="checkboxtext">M</span></td>
              <td class="ball"><input type="checkbox" name="optiona" style="margin-top: 15px !important;" id="opta" /><span class="checkboxtext">R</span></td> -->

      <!-- <td><input type="checkbox" name="optiona" style="margin-top: 15px !important;" id="opta" /><span class="checkboxtext">H</span></td>
              <td><input type="checkbox" name="optiona" style="margin-top: 15px !important;" id="opta" /><span class="checkboxtext">W</span></td>
              <td><input type="checkbox" name="optiona" style="margin-top: 15px !important;" id="opta" /><span class="checkboxtext">M</span></td>
              <td><input type="checkbox" name="optiona" style="margin-top: 15px !important;" id="opta" /><span class="checkboxtext">R</span></td> -->
      <!-- </tr>
          </table>
        </td>
      </tr> -->
      <tr>
        <td style="padding-bottom: 4px; "><span style="text-align: left;">INSPECTION PRESENCE
            : </span>
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
          <span class="checkboxtext"> &nbsp;Contractor&nbsp; </span><input type="checkbox" name="optiona" id="opta" />
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
          <span class="checkboxtext"> &nbsp;Company&nbsp; </span><input type="checkbox" name="optiona" id="opta" />
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
          <span class="checkboxtext"> &nbsp;Third Party&nbsp; </span><input type="checkbox" name="optiona" id="opta" />
        </td>
      </tr>
      <tr>
        <td style="text-align:center; padding-bottom: 4px; font-size: 10px !important;"><b>SIGNATURE FOR INSPECTION
            EXECUTED</b></td>
      </tr>
    </table>
    <table width="100%" border="1px" style="border-collapse: collapse; margin-top : -2px;">
      <tr>
        <!-- <td
          style="text-align:center; padding-bottom: 4px; font-size: 12px !important;text-align: center;font-weight: bold;">
          SUPLIER</td> -->
        <td style="text-align:center; width: 33% !important; padding-bottom: 4px; font-size: 12px !important;text-align: center;font-weight: bold;">
          CONTRACTOR</td>
        <td style="text-align:center; width: 33% !important; padding-bottom: 4px; font-size: 12px !important;text-align: center;font-weight: bold;">
          EMPLOYER</td>
        <td style="text-align:center; width: 33% !important; padding-bottom: 4px; font-size: 12px !important;text-align: center;font-weight: bold;">
          THIRD PARTY</td>
      </tr>
      <tr>
        <!-- <td style="padding-bottom: 4px; font-size: 10px !important;">NAME</td> -->
        <td style="padding-bottom: 4px; font-size: 10px !important;">NAME
          <?php if ($user_list[$welding_rfi['approve_by']]) { ?>
            <b><?= $user_list[$welding_rfi['approve_by']]; ?></b>
          <?php } ?>

        </td>
        <td style="padding-bottom: 4px; font-size: 10px !important;">NAME
          <?php if ($user_list[$welding_rfi['client_by']]) { ?>
            <b><?= $user_list[$welding_rfi['client_by']]; ?></b>
          <?php } ?>
        </td>
        <td style="padding-bottom: 4px; font-size: 10px !important;">NAME
          <?php if ($user_list[$welding_rfi['third_party_by']]) { ?>
            <b><?= $user_list[$welding_rfi['third_party_by']]; ?></b>
          <?php } ?>
        </td>
      </tr>
      <tr>
        <!-- <td style="padding-bottom: 4px; font-size: 10px !important;">SIGNATURE<br /><br /><br /></td> -->
        <td style="padding-bottom: 4px; font-size: 10px !important;">SIGNATURE

          <?php if ($user_list[$welding_rfi['approve_by']]) { ?>
            <img src="data:image/png;base64, <?= $sign_approval[$welding_rfi['approve_by']]; ?>" width='100px' style="align-items: center !important;" />
          <?php } else { ?>
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
          <?php } ?>
        </td>
        <td style="padding-bottom: 4px; font-size: 10px !important;">SIGNATURE
          <center>
            <?php if ($user_list[$welding_rfi['client_by']]) { ?>
              <img src="data:image/png;base64, <?= $sign_approval[$welding_rfi['client_by']]; ?>" width='100px' style="align-items: center !important;" />
            <?php } ?>
          </center>
        </td>
        <td style="padding-bottom: 4px; font-size: 10px !important;">SIGNATURE
          <center>
            <?php if ($user_list[$welding_rfi['third_party_by']]) { ?>
              <img src="data:image/png;base64, <?= $sign_approval[$welding_rfi['third_party_by']]; ?>" width='100px' style="align-items: center !important;" />
            <?php } ?>
          </center>
        </td>
      </tr>
      <tr>
        <!-- <td style="padding-bottom: 4px; font-size: 10px !important;">Date</td> -->
        <td style="padding-bottom: 4px; font-size: 10px !important;">Date
          <strong><?php if (isset($welding_rfi['approve_date']) and $welding_rfi['approve_date'] != "0000-00-00 00:00:00" || $welding_rfi['approve_date'] != "0000-00-00") {
                    echo date("d F Y", strtotime($welding_rfi['approve_date']));
                  }; ?></strong>
        </td>
        <td style="padding-bottom: 4px; font-size: 10px !important;">Date
          <strong><?php if (isset($welding_rfi['client_date']) and $welding_rfi['client_date'] != "0000-00-00 00:00:00" || $welding_rfi['client_date'] != "0000-00-00") {
                    echo date("d F Y", strtotime($welding_rfi['client_date']));
                  }; ?></strong>
        </td>
        <td style="padding-bottom: 4px; font-size: 10px !important;">Date
          <strong><?php if (isset($welding_rfi['third_party_date']) and $welding_rfi['third_party_date'] != "0000-00-00 00:00:00" || $welding_rfi['third_party_date'] != "0000-00-00") {
                    echo date("d F Y", strtotime($welding_rfi['third_party_date']));
                  }; ?></strong>
        </td>
      </tr>
    </table>
  </footer>

  <table width="100%" cellspacing="0px" cellpadding="6" style="text-align: center; margin-top: -70px !important;">
    <!--  <thead><tr>
      <th class="ball text-nowrap"><b>No.</b></th>
      <th class="ball text-nowrap"><b>ITEM / TAG NUMBER</b></th>
      <th class="ball text-nowrap"><b>ITEM / DESCRIPTION</b></th>
      <th class="ball text-nowrap"><b>AREA / LOCATION</b></th>
      <th class="ball text-nowrap"><b>EXPECTED TIME</b></th>
      <th class="ball text-nowrap"><b>PCMS</b></th>
    </tr></thead> -->
    <tbody>
      <?php $no = 1;
      foreach ($detail_rfi as $key => $value) : ?>
        <tr>
          <td width='3%' class="valign-middle "><?= $no++ ?></td>
          <td width='26%' class="valign-middle">
            <?= $value['tag_no'] ?>
          </td>
          <td width="38%" class="valign-middle">
            <?= $value['tag_description'] ?> / <?= $value['pwps'] ?>
          </td>
          <td width="13%" class="valign-middle"> <?= $value['expected_time'] ?></td>
          <td width="9%" class="valign-middle"><?= $value['itp'] ?></td>
          <td width="12%" class="valign-middle"><?= $value['result'] ?></td>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>


</body>

</html>