<?php
error_reporting(0);

$path = 'img/orsted_stamp.png';
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents($path);
$orsted_stamp = 'data:image/' . $type . ';base64,' . base64_encode($data);

$seatrium_logo = "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";



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $meta_title; ?></title>
    <style type="text/css">
        .bg-selected {
            background-color: #949494;
        }

        body {
            font-family: "helvetica";
            font-size: 50% !important;
        }

        .titleHead {
            border: 1px #000 solid;
            border-collapse: collapse;
            text-align: center;
            vertical-align: middle;

            background-color: #a6ffa6;
            font-weight: bold;

        }

        .titleHeadMain {
            text-align: center;
            border-collapse: collapse;
            text-align: center;
            vertical-align: middle;
            font-weight: bold;
        }

        table.table td {
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
            display: inline;
        }

        textarea {
            width: 95%;
            height: 250px !important;
        }

        .button {
            background-color: #4CAF50;
            /* Green */
            border: none;
            color: white;
            padding: 10px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
            border-radius: 10px;
        }

        .button2 {
            background-color: #00b52a;
            color: white;
            border: 2px solid #00b52a;
        }

        .button2:hover {
            background-color: #017d1e;
            color: white;
        }

        .button3 {
            background-color: #d4ad00;
            color: white;
            border: 2px solid #d4ad00;
        }

        .button3:hover {
            background-color: #e6bb00;
            color: white;
        }

        .button4 {
            background-color: #d42626;
            color: white;
            border: 2px solid #d42626;
        }

        .button4:hover {
            background-color: #cc0000;
            color: white;
        }

        .page_break {
            page-break-before: always;
        }


        div#page3 {
            -webkit-transform: rotate(90deg);
            -webkit-transform-origin: left top;
            -moz-transform: rotate(90deg);
            -moz-transform-origin: left top;
            -ms-transform: rotate(90deg);
            -ms-transform-origin: left top;
            -o-transform: rotate(90deg);
            -o-transform-origin: left top;
            transform: rotate(90deg);
            transform-origin: left top;
            position: absolute;
            top: 0;
            left: 100%;
            white-space: nowrap;
        }
    </style>
</head>

<body>

    <?php //error_reporting(0);

    $irn_revision = (isset($show_pcms_irn[0]["irn_revision"]) ? $show_pcms_irn[0]["irn_revision"] : 0);
    $irn_revision_show = str_pad(substr($irn_revision, -2), 2, '0', STR_PAD_LEFT);


    ?>

    <table border="1px" style="border-collapse: collapse !important;width:100% !important;">
        <tr>
            <td rowspan='3' valign="middle" style="padding: 5px;width: 260px !important;vertical-align: middle !important;">
                <center>
                    <img src="data:image/png;base64,<?= $seatrium_logo ?>" style="width: 120px;">
                </center>
            </td>
            <?php if ($show_pcms_irn[0]['project_id'] == 19 || $show_pcms_irn[0]['project_id'] == 21) { ?>
                <td style="padding: 5px;vertical-align: middle !important;">COMPANY</td>
            <?php } ?>
            <?php if ($show_pcms_irn[0]['project_id'] == 17) { ?>
                <td style="padding: 5px;vertical-align: middle !important;">EMPLOYER</td>
            <?php } ?>
            <td style="padding: 5px;vertical-align: middle !important;">RFI NO :</td>
        </tr>
        <tr>
            <td style="padding: 5px;vertical-align: middle !important;"><b><?php echo strtoupper($project_name[$show_pcms_irn[0]['project']]['client']) ?></b></td>
            <td style="padding: 5px;vertical-align: middle !important;"><b>
                <?php if ($show_pcms_irn[0]['project'] == 21) { ?>
<?= (isset($show_pcms_irn[0]['report_number']) ? ($master_report_number[$show_pcms_irn[0]['project']][$show_pcms_irn[0]['company_id']][$show_pcms_irn[0]['discipline']][$show_pcms_irn[0]['type_of_module']][$show_pcms_irn[0]['deck_elevation']][$show_pcms_irn[0]['irn_type']]['irn_rfi'] . $show_pcms_irn[0]['report_number']) : "Draft-" . $show_pcms_irn[0]['submission_id']) ?>
<?php  } else {  ?>
<?= (isset($show_pcms_irn[0]['report_number']) ? ($master_report_number[$show_pcms_irn[0]['project']][$show_pcms_irn[0]['company_id']][$show_pcms_irn[0]['discipline']][$show_pcms_irn[0]['type_of_module']][$show_pcms_irn[0]['irn_type']]["irn_rfi"] . $show_pcms_irn[0]['report_number']) : "Draft-" . $show_pcms_irn[0]['submission_id']) ?></b>
<?php  } ?>
                </b></td>
        </tr>
        <tr>
            <td style="padding: 5px;vertical-align: middle !important;" style="padding: 10px;">PROJECT TITLE</td>
            <td style="padding: 5px;vertical-align: middle !important;">SUBMITED DATE</td>
        </tr>
        <tr>
            <td rowspan='3' valign="middle" style="padding: 5px;vertical-align: middle !important;">
                <center>
                    <img src="<?php echo $client_logo[$show_pcms_irn[0]['project']] ?>" style="width: 120px;">
                </center>
            </td>
            <td style="padding: 5px;vertical-align: middle !important;"><b><?php echo strtoupper($project_name[$show_pcms_irn[0]['project']]['description']) ?></b></td>
            <td style="padding: 5px;vertical-align: middle !important;"><b><?= (isset($show_pcms_irn_description[0]['rfi_date']) ? date("F d, Y", strtotime($show_pcms_irn_description[0]['rfi_date'])) : null) ?> </b></td>
        </tr>
        <tr>
            <td style="padding: 5px;vertical-align: middle !important;height: 15px !important;">CONTRACTOR</td>
            <td style="padding: 5px;vertical-align: middle !important;">SHEET</td>
        </tr>
        <tr>
            <td style="padding: 5px;vertical-align: middle !important;"><b>PT SMOE</b></td>
            <td style="padding: 5px;vertical-align: middle !important;"><b>1 Of 1</b></td>
        </tr>
    </table>

    <?php
    if (isset($show_pcms_irn_description[0]['rfi_date'])) {
        $inspection_date = date('d', strtotime($show_pcms_irn_description[0]['rfi_date']));
        $inspection_month = date('m', strtotime($show_pcms_irn_description[0]['rfi_date']));
    } else {
        $inspection_date = null;
        $inspection_month = null;
    }
    ?>
    <table border="1px" style="border-collapse: collapse !important;width: 703px !important;">
        <tr>
            <td colspan="22" style="text-align:center;width:100% !important;"><b>RFI - INSPECTION NOTIFICATION</b></td>
        </tr>
        <tr>
            <td colspan="6" style="text-align:center;"><b>MONTH</b></td>
            <td colspan="16" style="text-align:center;"><b>DAY</b></td>
        </tr>
        <tr>
            <td style="text-align:center;" class="<?= $inspection_month == 1 ? 'bg-selected' : '' ?>"><b>JAN</b></td>
            <td style="text-align:center;" class="<?= $inspection_month == 2 ? 'bg-selected' : '' ?>"><b>FEB</b></td>
            <td style="text-align:center;" class="<?= $inspection_month == 3 ? 'bg-selected' : '' ?>"><b>MAR</b></td>
            <td style="text-align:center;" class="<?= $inspection_month == 4 ? 'bg-selected' : '' ?>"><b>APR</b></td>
            <td style="text-align:center;" class="<?= $inspection_month == 5 ? 'bg-selected' : '' ?>"><b>MAY</b></td>
            <td style="text-align:center;" class="<?= $inspection_month == 6 ? 'bg-selected' : '' ?>"><b>JUN</b></td>
            <td rowspan='2' style="text-align:center; vertical-align: middle !important;  " class="<?= $inspection_date == 1 ? 'bg-selected' : '' ?>" width: 50px !important;><b>1</b></td>
            <td style="text-align:center;" class="<?= $inspection_date == 2 ? 'bg-selected' : '' ?>"><b>2</b></td>
            <td style="text-align:center;" class="<?= $inspection_date == 3 ? 'bg-selected' : '' ?>"><b>3</b></td>
            <td style="text-align:center;" class="<?= $inspection_date == 4 ? 'bg-selected' : '' ?>"><b>4</b></td>
            <td style="text-align:center;" class="<?= $inspection_date == 5 ? 'bg-selected' : '' ?>"><b>5</b></td>
            <td style="text-align:center;" class="<?= $inspection_date == 6 ? 'bg-selected' : '' ?>"><b>6</b></td>
            <td style="text-align:center;" class="<?= $inspection_date == 7 ? 'bg-selected' : '' ?>"><b>7</b></td>
            <td style="text-align:center;" class="<?= $inspection_date == 8 ? 'bg-selected' : '' ?>"><b>8</b></td>
            <td style="text-align:center;" class="<?= $inspection_date == 9 ? 'bg-selected' : '' ?>"><b>9</b></td>
            <td style="text-align:center;" class="<?= $inspection_date == 10 ? 'bg-selected' : '' ?>"><b>10</b></td>
            <td style="text-align:center;" class="<?= $inspection_date == 11 ? 'bg-selected' : '' ?>"><b>11</b></td>
            <td style="text-align:center;" class="<?= $inspection_date == 12 ? 'bg-selected' : '' ?>"><b>12</b></td>
            <td style="text-align:center;" class="<?= $inspection_date == 13 ? 'bg-selected' : '' ?>"><b>13</b></td>
            <td style="text-align:center;" class="<?= $inspection_date == 14 ? 'bg-selected' : '' ?>"><b>14</b></td>
            <td style="text-align:center;" class="<?= $inspection_date == 15 ? 'bg-selected' : '' ?>"><b>15</b></td>
            <td style="text-align:center;" class="<?= $inspection_date == 16 ? 'bg-selected' : '' ?>"><b>16</b> </td>
        </tr>
        <tr>
            <td style="text-align:center;" class="<?= $inspection_month == 7 ? 'bg-selected' : '' ?>"><b>JUL</b></td>
            <td style="text-align:center;" class="<?= $inspection_month == 8 ? 'bg-selected' : '' ?>"><b>AUG</b></td>
            <td style="text-align:center;" class="<?= $inspection_month == 9 ? 'bg-selected' : '' ?>"><b>SEP</b></td>
            <td style="text-align:center;" class="<?= $inspection_month == 10 ? 'bg-selected' : '' ?>"><b>OCT</b></td>
            <td style="text-align:center;" class="<?= $inspection_month == 11 ? 'bg-selected' : '' ?>"><b>NOV</b></td>
            <td style="text-align:center;" class="<?= $inspection_month == 12 ? 'bg-selected' : '' ?>"><b>DEC</b></td>
            <td style="text-align:center;" class="<?= $inspection_date == 17 ? 'bg-selected' : '' ?>"><b>17</b></td>
            <td style="text-align:center;" class="<?= $inspection_date == 18 ? 'bg-selected' : '' ?>"><b>18</b></td>
            <td style="text-align:center;" class="<?= $inspection_date == 19 ? 'bg-selected' : '' ?>"><b>19</b></td>
            <td style="text-align:center;" class="<?= $inspection_date == 20 ? 'bg-selected' : '' ?>"><b>20</b></td>
            <td style="text-align:center;" class="<?= $inspection_date == 21 ? 'bg-selected' : '' ?>"><b>21</b></td>
            <td style="text-align:center;" class="<?= $inspection_date == 22 ? 'bg-selected' : '' ?>"><b>22</b></td>
            <td style="text-align:center;" class="<?= $inspection_date == 23 ? 'bg-selected' : '' ?>"><b>23</b></td>
            <td style="text-align:center;" class="<?= $inspection_date == 24 ? 'bg-selected' : '' ?>"><b>24</b></td>
            <td style="text-align:center;" class="<?= $inspection_date == 25 ? 'bg-selected' : '' ?>"><b>25</b></td>
            <td style="text-align:center;" class="<?= $inspection_date == 26 ? 'bg-selected' : '' ?>"><b>26</b></td>
            <td style="text-align:center;" class="<?= $inspection_date == 27 ? 'bg-selected' : '' ?>"><b>27</b></td>
            <td style="text-align:center;" class="<?= $inspection_date == 28 ? 'bg-selected' : '' ?>"><b>28</b></td>
            <td style="text-align:center;" class="<?= $inspection_date == 29 ? 'bg-selected' : '' ?>"><b>29</b></td>
            <td style="text-align:center;" class="<?= $inspection_date == 30 ? 'bg-selected' : '' ?>"><b>30</b></td>
            <td style="text-align:center;" class="<?= $inspection_date == 31 ? 'bg-selected' : '' ?>"><b>31</b></td>
        </tr>
        <tr>
            <td colspan="22" style="text-align:left; padding:10px !important; ">
                <b> Document Ref : </b>
                <!-- <br />• 07555701 (B) - E.80 Fabrication and Construction
                <br />• 08307791 - Inspection Test Procedure - <?= $discipline_name[$show_pcms_irn[0]['discipline']] ?>
                <br />• 08308559 - In-process Inspection procedure -->
                <!-- <br/>● 002752254 - Part B Section 4 - Offshore Converter Platform
        <br/>● 003720389 - In - process Inspection procedure  -->
                <?= $master_acceptance[$show_pcms_irn[0]['project_id']][$show_pcms_irn[0]['company_id']][$show_pcms_irn[0]['discipline']][$show_pcms_irn[0]['module']][$show_pcms_irn[0]['type_of_module']]['irn']['procedure']; ?>

            </td>
        </tr>
        <tr>
            <td colspan="22" style="text-align:left; padding:10px !important;">
                <b>Discipline :</b> &nbsp;&nbsp;
                <?php if ($show_pcms_irn[0]['discipline'] == '2') { ?><input type="checkbox" name="optiona" id="opta" checked /><?php } else { ?><input type="checkbox" name="optiona" id="opta" /><?php } ?><span class="checkboxtext"> &nbsp;&nbsp;STRUCTURAL&nbsp;&nbsp;&nbsp;&nbsp;</span>

                <input type="checkbox" name="optiona" id="opta" /><span class="checkboxtext"> &nbsp;&nbsp;E & I&nbsp;&nbsp;&nbsp;&nbsp;</span>

                <input type="checkbox" name="optiona" id="opta" /><span class="checkboxtext"> &nbsp;&nbsp;MECHANICAL&nbsp;&nbsp;&nbsp;&nbsp;</span>

                <?php if ($show_pcms_irn[0]['discipline'] == '1') { ?>
                    <input type="checkbox" name="optiona" id="opta" checked="" /><span class="checkboxtext"> &nbsp;&nbsp;PIPING&nbsp;&nbsp;&nbsp;&nbsp;</span>
                <?php } else { ?>
                    <input type="checkbox" name="optiona" id="opta" /><span class="checkboxtext"> &nbsp;&nbsp;PIPING&nbsp;&nbsp;&nbsp;&nbsp;</span>
                <?php } ?>

                <input type="checkbox" name="optiona" id="opta" /><span class="checkboxtext">&nbsp;&nbsp;HVAC&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </td>
        </tr>
        <tr>
            <td colspan="22" style="font-weight:bold; text-align:left; padding:5px !important; ">TYPE OF INSPECTION :</td>
        </tr>
        <tr>
            <td colspan="22" style="text-align:left; padding:10px !important; ">
                <table class='table_content' width="100%" cellspacing="0" cellpadding="0" style=' border: none !important;'>
                    <tr>
                        <td style="text-align:left; padding: 5px;">
                            <input type="checkbox" name="type_of_inspection[]" value="1" onclick="setTypeofInspection(this, 1)" <?= in_array(1, explode(';', $show_pcms_irn[0]['type_of_inspection'])) ? 'checked' : '' ?> id="opta" />
                            <span class="checkboxtext">&nbsp;&nbsp;Material / Equipment Inspection&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        </td>
                        <td style="text-align:left; padding: 5px;">
                            <input type="checkbox" name="type_of_inspection[]" value="2" onclick="setTypeofInspection(this, 2)" <?= in_array(2, explode(';', $show_pcms_irn[0]['type_of_inspection'])) ? 'checked' : '' ?> id="opta" />
                            <span class="checkboxtext">&nbsp;&nbsp;Dimensional&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        </td>
                        <td style="text-align:left; padding: 5px; ">
                            <input type="checkbox" name="type_of_inspection[]" value="3" onclick="setTypeofInspection(this, 3)" <?= in_array(3, explode(';', $show_pcms_irn[0]['type_of_inspection'])) ? 'checked' : '' ?> id="opta" />
                            <span class="checkboxtext"> &nbsp;&nbsp;Witness Pressure Test&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        </td>
                        <td style="text-align:left; padding: 5px; ">
                            <input type="checkbox" name="type_of_inspection[]" value="4" onclick="setTypeofInspection(this, 4)" <?= in_array(4, explode(';', $show_pcms_irn[0]['type_of_inspection'])) ? 'checked' : '' ?> id="opta" />
                            <span class="checkboxtext"> &nbsp;&nbsp;Mechanical Completion&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:left; padding: 5px;">
                            <input type="checkbox" name="type_of_inspection[]" value="5" onclick="setTypeofInspection(this, 5)" <?= in_array(5, explode(';', $show_pcms_irn[0]['type_of_inspection'])) ? 'checked' : '' ?> id="opta" />
                            <span class="checkboxtext"> &nbsp;&nbsp;Welder Qualification&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        </td>
                        <td style="text-align:left; padding: 5px;">
                            <input type="checkbox" name="type_of_inspection[]" value="6" onclick="setTypeofInspection(this, 6)" <?= in_array(6, explode(';', $show_pcms_irn[0]['type_of_inspection'])) ? 'checked' : '' ?> id="opta" />
                            <span class="checkboxtext"> &nbsp;&nbsp;Fit-up Inspection&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        </td>
                        <td style="text-align:left; padding: 5px; ">
                            <input type="checkbox" name="type_of_inspection[]" value="7" onclick="setTypeofInspection(this, 7)" <?= in_array(7, explode(';', $show_pcms_irn[0]['type_of_inspection'])) ? 'checked' : '' ?> id="opta" />
                            <span class="checkboxtext"> &nbsp;&nbsp;Final Inspection&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        </td>
                        <td style="text-align:left; padding: 5px; ">
                            <input type="checkbox" name="type_of_inspection[]" value="8" onclick="setTypeofInspection(this, 8)" <?= in_array(8, explode(';', $show_pcms_irn[0]['type_of_inspection'])) ? 'checked' : '' ?> id="opta" />
                            <span class="checkboxtext"> &nbsp;&nbsp;Pre-Commisioning / Commisioning&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:left; padding: 5px;">
                            <input type="checkbox" name="type_of_inspection[]" value="9" onclick="setTypeofInspection(this, 9)" <?= in_array(9, explode(';', $show_pcms_irn[0]['type_of_inspection'])) ? 'checked' : '' ?> id="opta" />
                            <span class="checkboxtext"> &nbsp;&nbsp;Procedure Qualification&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        </td>
                        <td style="text-align:left; padding: 5px;">
                            <input type="checkbox" name="type_of_inspection[]" value="10" onclick="setTypeofInspection(this, 10)" <?= in_array(10, explode(';', $show_pcms_irn[0]['type_of_inspection'])) ? 'checked' : '' ?> id="opta" />
                            <span class="checkboxtext"> &nbsp;&nbsp;Visual Inspection&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        </td>
                        <td style="text-align:left; padding: 5px; ">
                            <input type="checkbox" name="type_of_inspection[]" value="11" onclick="setTypeofInspection(this, 11)" <?= in_array(11, explode(';', $show_pcms_irn[0]['type_of_inspection'])) ? 'checked' : '' ?> id="opta" />
                            <span class="checkboxtext"> &nbsp;&nbsp;Blasting / Painting / Coating&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        </td>
                        <td style="text-align:left; padding: 5px; ">
                            <input type="checkbox" name="type_of_inspection[]" value="12" onclick="setTypeofInspection(this, 12)" <?= in_array(12, explode(';', $show_pcms_irn[0]['type_of_inspection'])) ? 'checked' : '' ?> id="opta" />
                            <span class="checkboxtext"> &nbsp;&nbsp;Document Review&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:left; padding: 5px;">
                            <input type="checkbox" name="type_of_inspection[]" value="13" onclick="setTypeofInspection(this, 13)" <?= in_array(13, explode(';', $show_pcms_irn[0]['type_of_inspection'])) ? 'checked' : '' ?> id="opta" />
                            <span class="checkboxtext"> &nbsp;&nbsp;Production Test Coupon Welding&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        </td>
                        <td style="text-align:left; padding: 5px;">
                            <input type="checkbox" name="type_of_inspection[]" value="14" onclick="setTypeofInspection(this, 14)" <?= in_array(14, explode(';', $show_pcms_irn[0]['type_of_inspection'])) ? 'checked' : '' ?> id="opta" />
                            <span class="checkboxtext"> &nbsp;&nbsp;Witness NDT&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        </td>
                        <td style="text-align:left; padding: 5px; ">
                            <input type="checkbox" name="type_of_inspection[]" value="15" onclick="setTypeofInspection(this, 15)" <?= in_array(15, explode(';', $show_pcms_irn[0]['type_of_inspection'])) ? 'checked' : '' ?> id="opta" />
                            <span class="checkboxtext"> &nbsp;&nbsp;E & I Inspection&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        </td>
                        <td style="text-align:left; padding: 5px; ">
                            <input type="checkbox" name="type_of_inspection[]" value="16" onclick="setTypeofInspection(this, 16)" <?= in_array(16, explode(';', $show_pcms_irn[0]['type_of_inspection'])) ? 'checked' : '' ?> id="opta" />
                            <span class="checkboxtext"> &nbsp;&nbsp;Other&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="1" style="font-weight: bold;padding:5px !important;">
                <center>No.</center>
            </td>
            <td colspan="6" style="font-weight: bold;padding:5px !important;">
                <center>ITEM / TAG NUMBER</center>
            </td>
            <td colspan="7" style="font-weight: bold;padding:5px !important;">
                <center>ITEM / DESCRIPTION</center>
            </td>
            <td colspan="3" style="font-weight: bold;padding:5px !important;">
                <center>AREA / LOCATION</center>
            </td>
            <td colspan="5" style="font-weight: bold;padding:5px !important;">
                <center>EXPECTED TIME</center>
            </td>
        </tr>

        <?php $nox = 1;
        foreach ($show_pcms_irn_description as $key => $value) { ?>
            <tr>
                <td colspan="1" style="padding:5px !important; text-align:center;"><?= $nox ?></td>
                <td colspan="6" style="padding:5px !important; text-align:center;"><?= $value['item_tag_no'] ?></td>
                <td colspan="7" style="padding:5px !important; text-align:center;"><?= $value['item_tag_description'] ?></td>
                <td colspan="3" style="padding:5px !important; text-align:center;"><?= @$area_name_arr_v2[$show_pcms_irn[0]['area_v2']] . ", " . @$location_name_arr_v2[$show_pcms_irn[0]['location_v2']]; ?></td>
                <td colspan="5" style="padding:5px !important; text-align:center;"><?= $value['expected_time'] ?></td>
            </tr>
        <?php $nox++;
        } ?>
        <tr>
            <td colspan="1" style="padding:5px !important;font-weight: bold;"> <br /></td>
            <td colspan="6" style="padding:5px !important;font-weight: bold;"></td>
            <td colspan="7" style="padding:5px !important;font-weight: bold;"></td>
            <td colspan="3" style="padding:5px !important;font-weight: bold;"></td>
            <td colspan="5" style="padding:5px !important;font-weight: bold;"></td>
        </tr>
    </table>


    <table border="1px" style="border-collapse: collapse !important;" width="100%">
        <tr>
            <td style="text-align:center; padding:10px !important;padding:20px;"><b>LEGEND : INSPECTION AUTHORITY AS PER ITP</b></td>
        </tr>
        <tr>
            <td style="padding:10px !important; padding:5px;">
                <center>
                    <table class='table_content' width="100%" cellspacing="0" cellpadding="0" style=' border: none !important;'>
                        <tr>
                            <td style="text-align:left;padding:5px !important;   ">
                                <input type="checkbox" name="optiona" id="opta" <?php echo ($value['project_id'] == 17) ? 'checked' : '' ?> />
                                <span class="checkboxtext">&nbsp;&nbsp;Hold Point&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            </td>
                            <td style="text-align:left;padding:5px !important;  ">
                                <input type="checkbox" name="optiona" id="opta" <?php echo ($value['project_id'] == 19 || $value['project_id'] == 21) ? 'checked' : '' ?> />
                                <span class="checkboxtext">&nbsp;&nbsp;Witness&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            </td>
                            <td style="text-align:left;padding:5px !important;   ">
                                <input type="checkbox" name="optiona" id="opta" />
                                <span class="checkboxtext">&nbsp;&nbsp;Monitoring&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            </td>
                            <td style="text-align:left;padding:5px !important;   ">
                                <input type="checkbox" name="optiona" id="opta" <?php echo ($value['project_id'] == 17 || $value['project_id'] == 19 || $value['project_id'] == 21) ? 'checked' : '' ?> />
                                <span class="checkboxtext">&nbsp;&nbsp;Review&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            </td>
                        </tr>
                    </table>
                    <center>
            </td>
        </tr>
    </table>

    <table border="1px" style="border-collapse: collapse !important;" width="100%">
        <tr>
            <td style="text-align:center; padding:10px !important;padding:20px;"><b>LEGEND : INSPECTION EXCECUTION RESULT</b></td>
        </tr>
        <tr>
            <td style="padding:10px !important; padding:5px;">
                <center>
                    <table class='table_content' width="100%" cellspacing="0" cellpadding="0" style=' border: none !important;'>
                        <tr>
                            <td style="text-align:left;padding:5px !important;   ">
                                <input type="checkbox" name="optiona" id="opta" <?php if ($show_pcms_irn[0]['status_inspection'] == '7') {
                                                                                    echo "checked";
                                                                                } ?> />
                                <span class="checkboxtext">&nbsp;&nbsp;Accepted&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            </td>
                            <td style="text-align:left;padding:5px !important;   ">
                                <input type="checkbox" name="optiona" id="opta" <?php if ($show_pcms_irn[0]['status_inspection'] == '9') {
                                                                                    echo "checked";
                                                                                } ?> />
                                <span class="checkboxtext">&nbsp;&nbsp;Accepted & Released With Comment&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            </td>
                            <td style="text-align:left;padding:5px !important;   ">
                                <input type="checkbox" name="optiona" id="opta" <?php if ($show_pcms_irn[0]['status_inspection'] == '6') {
                                                                                    echo "checked";
                                                                                } ?> />
                                <span class="checkboxtext">&nbsp;&nbsp;Rejected&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            </td>
                            <td style="text-align:left;padding:5px !important;   ">
                                <input type="checkbox" name="optiona" id="opta" <?php if ($show_pcms_irn[0]['status_inspection'] == '10') {
                                                                                    echo "checked";
                                                                                } ?> />
                                <span class="checkboxtext">&nbsp;&nbsp;Postpone&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            </td>
                            <td style="text-align:left;padding:5px !important;   ">
                                <input type="checkbox" name="optiona" id="opta" <?php if ($show_pcms_irn[0]['status_inspection'] == '11') {
                                                                                    echo "checked";
                                                                                } ?> />
                                <span class="checkboxtext">&nbsp;&nbsp;Re-Offer&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            </td>
                        </tr>
                    </table>
                    <center>
            </td>
        </tr>
        <tr>
            <td style="text-align:left;padding-bottom:60px;">
                <b>Comment/Remarks :<br /><br />
                    <?= isset($show_pcms_irn[0]['client_remarks']) ? nl2br($show_pcms_irn[0]['client_remarks']) : '-' ?>
            </td>
        </tr>
        <tr>
            <td style="text-align:center;"><b>SIGNATURE FOR INSPECTION EXECUTED</b></td>
        </tr>
    </table>

    <?php if ($show_pcms_irn[0]['project_id'] == 20) { ?>

        <table width="100%" border="1px" style="border-collapse: collapse;">
            <tr>
                <td style="text-align:center;  text-align: center;font-weight: bold; width:25%;">CONTRACTOR</td>
                <td style="text-align:center;  text-align: center;font-weight: bold; width:25%;">GE</td>
                <?php if ($show_pcms_irn[0]['project_id'] == 19 || $show_pcms_irn[0]['project_id'] == 21) { ?>
                    <td style="text-align:center;  text-align: center;font-weight: bold; width:25%;">COMPANY</td>
                <?php } ?>
                <?php if ($show_pcms_irn[0]['project_id'] == 17) { ?>
                    <td style="text-align:center;  text-align: center;font-weight: bold; width:25%;">EMPLOYER</td>
                <?php } ?>
                <td style="text-align:center;  text-align: center;font-weight: bold; width:25%;">THIRD PARTY</td>
            </tr>
            <tr>
                <td>
                    NAME
                    <b><?php if (isset($user[$show_pcms_irn[0]['smoe_approval_by']]['full_name'])) {
                            echo $user[$show_pcms_irn[0]['smoe_approval_by']]['full_name'];
                        } ?></b>
                </td>
                <td>
                    NAME
                    <b><?php if (isset($user[$show_pcms_irn[0]['client_approval_by']]['full_name'])) {
                            echo  $user[$show_pcms_irn[0]['client_approval_by']]['full_name'];
                        } ?></b>
                </td>
                <td>
                    NAME
                    <b><?php if (isset($user[$show_pcms_irn[0]['client_2nd_inspection_by']]['full_name'])) {
                            echo  $user[$show_pcms_irn[0]['client_2nd_inspection_by']]['full_name'];
                        } ?></b>
                </td>
                <td>
                    NAME
                </td>
            </tr>
            <tr>
                <td>SIGNATURE<br />
                    <?php if (isset($user[$show_pcms_irn[0]['smoe_approval_by']]['sign_approval'])) { ?>
                        <center>
                            <img src="data:image/png;base64,<?= $user[$show_pcms_irn[0]['smoe_approval_by']]['sign_approval'] ?>" style="width: 120px !important; height: 90px !important">
                        </center>
                    <?php } ?>
                </td>

                <td style=" ">SIGNATURE<br />
                    <?php if (isset($user[$show_pcms_irn[0]['client_approval_by']]['sign_approval'])) { ?>
                        <center>
                            <img src="data:image/png;base64,<?= $user[$show_pcms_irn[0]['client_approval_by']]['sign_approval'] ?>" style="width: 120px !important; height: 90px !important">
                        </center>
                    <?php } ?>
                </td>
                <td style=" ">SIGNATURE<br />
                    <?php if (isset($user[$show_pcms_irn[0]['client_2nd_inspection_by']]['sign_approval'])) { ?>
                        <center>
                            <img src="data:image/png;base64,<?= $user[$show_pcms_irn[0]['client_2nd_inspection_by']]['sign_approval'] ?>" style="width: 120px !important; height: 90px !important">
                        </center>
                    <?php } ?>
                </td>
                <td>
                    SIGNATURE<br /><br /><br />
                </td>
            </tr>
            <tr>
                <td>Date
                    <?php if (isset($user[$show_pcms_irn[0]['smoe_approval_by']]['sign_approval'])) { ?>
                        <b><?php echo date("Y-m-d", strtotime($show_pcms_irn[0]['smoe_approval_date'])); ?></b>
                    <?php } ?>
                </td>
                <td>Date
                    <?php if (isset($user[$show_pcms_irn[0]['client_approval_by']]['sign_approval'])) { ?>
                        <b><?php echo date("Y-m-d", strtotime($show_pcms_irn[0]['client_approval_date'])); ?></b>
                    <?php } ?>
                </td>
                <td>Date
                    <?php if (isset($user[$show_pcms_irn[0]['client_2nd_inspection_by']]['sign_approval'])) { ?>
                        <b><?php echo date("Y-m-d", strtotime($show_pcms_irn[0]['client_2nd_inspection_date'])); ?></b>
                    <?php } ?>
                </td>
                <td>Date</td>
            </tr>
        </table>

    <?php } else { ?>

        <table width="100%" border="1px" style="border-collapse: collapse;">
            <tr>
                <?php if ($show_pcms_irn[0]['company_id'] == 5) { ?>
                    <td style="text-align:center;  text-align: center;font-weight: bold; width:25%;">DSAW</td>
                <?php } ?>
                <td style="text-align:center;  text-align: center;font-weight: bold; width:25%;">CONTRACTOR</td>
                <?php if ($show_pcms_irn[0]['project_id'] == 19 || $show_pcms_irn[0]['project_id'] == 21) { ?>
                    <td style="text-align:center;  text-align: center;font-weight: bold; width:25%;">COMPANY</td>
                <?php } ?>
                <?php if ($show_pcms_irn[0]['project_id'] == 17) { ?>
                    <td style="text-align:center;  text-align: center;font-weight: bold; width:25%;">EMPLOYER</td>
                <?php } ?>                <td style="text-align:center;  text-align: center;font-weight: bold; width:25%;">THIRD PARTY</td>
            </tr>
            <tr>
                <?php if ($show_pcms_irn[0]['company_id'] == 5) { ?>
                    <td>
                        NAME
                        <b><?php if (isset($user[$show_pcms_irn[0]['create_by']]['full_name'])) {
                                echo $user[$show_pcms_irn[0]['create_by']]['full_name'];
                            } ?></b>
                    </td>
                <?php } ?>
                <td>
                    NAME
                    <b><?php if (isset($user[$show_pcms_irn[0]['smoe_approval_by']]['full_name'])) {
                            echo $user[$show_pcms_irn[0]['smoe_approval_by']]['full_name'];
                        } ?></b>
                </td>
                <td>
                    NAME
                    <b><?php if (isset($user[$show_pcms_irn[0]['client_approval_by']]['full_name'])) {
                            echo  $user[$show_pcms_irn[0]['client_approval_by']]['full_name'];
                        } ?></b>
                </td>
                <td>
                    NAME
                    <b><?php if (isset($user[$show_pcms_irn[0]['third_party_approval_by']]['full_name'])) {
                            echo  $user[$show_pcms_irn[0]['third_party_approval_by']]['full_name'];
                        } ?></b>
                </td>
            </tr>
            <tr>
                <?php if ($show_pcms_irn[0]['company_id'] == 5) { ?>
                    <td>SIGNATURE<br />
                        <?php if (isset($user[$show_pcms_irn[0]['create_by']]['sign_approval'])) { ?>
                            <center>
                                <img src="data:image/png;base64,<?= $user[$show_pcms_irn[0]['create_by']]['sign_approval'] ?>" style="width: 120px !important; height: 90px !important">
                            </center>
                        <?php } ?>
                    </td>
                <?php } ?>

                <td>SIGNATURE<br />
                    <?php if (isset($user[$show_pcms_irn[0]['smoe_approval_by']]['sign_approval'])) { ?>
                        <center>
                            <img src="data:image/png;base64,<?= $user[$show_pcms_irn[0]['smoe_approval_by']]['sign_approval'] ?>" style="width: 120px !important; height: 90px !important">
                        </center>
                    <?php } ?>
                </td>

                <td style=" ">SIGNATURE<br />
                    <center>
                        <div style="page-break-inside: avoid;">
                            <?php if ($show_pcms_irn[0]['project_id'] == 17) : ?>
                                <style type="text/css">
                                    .color_stamp {
                                        color: rgba(63, 72, 204, 255) !important;
                                    }

                                    .valign_middle {
                                        vertical-align: middle !important;
                                    }

                                    .check_stamp {
                                        -ms-transform: scale(1.7) !important;
                                        -moz-transform: scale(1.7) !important;
                                        -webkit-transform: scale(1.7) !important;
                                        -o-transform: scale(1.7) !important;
                                        transform: scale(1.7) !important;
                                    }

                                    .border_stamp {
                                        border: 3px solid rgba(63, 72, 204, 255) !important;
                                    }

                                    .box_stamp {
                                        padding: 4px !important;
                                        font-weight: bold !important;
                                        z-index: 99 !important;
                                    }
                                </style>
                                <div class="box color_stamp border_stamp box_stamp">
                                    <center>
                                        <img src="<?= $orsted_stamp ?>" style="width:35px">
                                        <br>
                                        <strong>CHW 2204 OSS Project</strong>
                                    </center>
                                    <table cellpadding="0" border="0" style="width:100%; border-collapse: collapse !important; all: unset !important;">
                                        <tr>
                                            <td width="40%" class="valign_middle">Review</td>
                                            <td><input type="checkbox" style="margin-bottom: 8px !important" checked></td>
                                        </tr>
                                        <tr>
                                            <td width="40%" class="valign_middle">Witness</td>
                                            <td><input type="checkbox" style="margin-bottom: 8px !important" checked></td>
                                        </tr>
                                        <tr>
                                            <td width="40%" class="valign_middle">Inspect</td>
                                            <td><input type="checkbox" style="margin-bottom: 8px !important" checked></td>
                                        </tr>
                                    </table>
                                    <br>
                                    Date : <?= $show_pcms_irn[0]['client_approval_date'] ? date('Y-m-d', strtotime($show_pcms_irn[0]['client_approval_date'])) : space(15) ?>
                                    &nbsp;
                                    <span style="z-index: 99 !important;">Signature :</span>

                                </div>
                                <div class="text-right" style="padding-right: 5px !important; padding-bottom:3px !important;">
                                    <?php if (isset($user[$show_pcms_irn[0]['client_approval_by']]['sign_approval'])) { ?>
                                        <img src="data:image/png;base64, <?= $user[$show_pcms_irn[0]['client_approval_by']]['sign_approval'] ?>" style='width: 3cm !important; height: 2.8cm !important; position: absolute !important; margin-left: 150px !important; margin-top: -117px !important; z-index: -99 !important; ' />
                                    <?php } ?>
                                </div>
                            <?php else : ?>
                                <?php if (isset($user[$show_pcms_irn[0]['client_approval_by']]['sign_approval'])) { ?>
                                    <img src="data:image/png;base64,<?= $user[$show_pcms_irn[0]['client_approval_by']]['sign_approval'] ?>" style="width: 120px !important; height: 90px !important">
                                <?php } ?>
                            <?php endif; ?>
                        </div>
                    </center>
                </td>
                <td>
                    SIGNATURE <?php if (isset($user[$show_pcms_irn[0]['third_party_approval_by']]['sign_approval'])) { ?>
                        <center>
                            <img src="data:image/png;base64,<?= $user[$show_pcms_irn[0]['third_party_approval_by']]['sign_approval'] ?>" style="width: 120px !important; height: 90px !important">
                        </center>
                    <?php } ?><br /><br /><br />
                </td>
            </tr>
            <tr>
                <?php if ($show_pcms_irn[0]['company_id'] == 5) { ?>
                    <td>Date
                        <?php if (isset($user[$show_pcms_irn[0]['create_by']]['sign_approval'])) { ?>
                            <b><?php echo date("Y-m-d", strtotime($show_pcms_irn[0]['create_date'])); ?></b>
                        <?php } ?>
                    </td>
                <?php } ?>

                <td>Date
                    <?php if (isset($user[$show_pcms_irn[0]['smoe_approval_by']]['sign_approval'])) { ?>
                        <b><?php echo date("Y-m-d", strtotime($show_pcms_irn[0]['smoe_approval_date'])); ?></b>
                    <?php } ?>
                </td>
                <td>Date
                    <?php if (isset($user[$show_pcms_irn[0]['client_approval_by']]['sign_approval'])) { ?>
                        <b><?php echo date("Y-m-d", strtotime($show_pcms_irn[0]['client_approval_date'])); ?></b>
                    <?php } ?>
                </td>
                <td>Date
                    <?php if (isset($user[$show_pcms_irn[0]['third_party_approval_by']]['sign_approval'])) { ?>
                        <b><?php echo date("Y-m-d", strtotime($show_pcms_irn[0]['third_party_approval_date'])); ?></b>
                    <?php } ?>
                </td>
            </tr>
        </table>

    <?php } ?>


    <div class="page_break"></div>


    <table border="1px" style="border-collapse: collapse !important;width: 703px !important;">
        <tr>
            <td rowspan='6' valign="middle" style="padding: 5px;vertical-align: middle !important;width: 200px !important;">
                <center>
                    <img src="<?php echo $project_name[$show_pcms_irn[0]['project']]['project_logo']; ?>" style="width: 200px;">
                </center>
            </td>
            <td rowspan='6' valign="middle" style="padding: 5px;width: 280px !important;vertical-align: middle !important;font-weight: bold;">
                <center>
                    <h2>
                        <?php echo strtoupper($project_desc[$show_pcms_irn[0]['project']]) ?>
                        <br /> INSPECTION RELEASE NOTE
                    </h2>
                </center>
            </td>
            <td style="padding: 5px;vertical-align: middle !important;width: 20% !important;">DOC NO :</td>
        </tr>
        <tr>
            <td style="padding: 5px;vertical-align: middle !important;">
                <b>
                  <?php if ($show_pcms_irn[0]['project'] == 21) { ?>
<?= (isset($show_pcms_irn[0]['report_number']) ? ($master_report_number[$show_pcms_irn[0]['project']][$show_pcms_irn[0]['company_id']][$show_pcms_irn[0]['discipline']][$show_pcms_irn[0]['type_of_module']][$show_pcms_irn[0]['deck_elevation']][$show_pcms_irn[0]['irn_type']]['irn_rfi'] . $show_pcms_irn[0]['report_number']) : "Draft-" . $show_pcms_irn[0]['submission_id']) ?>
<?php  } else {  ?>
<?= (isset($show_pcms_irn[0]['report_number']) ? ($master_report_number[$show_pcms_irn[0]['project']][$show_pcms_irn[0]['company_id']][$show_pcms_irn[0]['discipline']][$show_pcms_irn[0]['type_of_module']][$show_pcms_irn[0]['irn_type']]["irn_rfi"] . $show_pcms_irn[0]['report_number']) : "Draft-" . $show_pcms_irn[0]['submission_id']) ?></b>
<?php  } ?>
                </b>
            </td>
        </tr>
        <tr>
            <td style="padding: 5px;vertical-align: middle !important;">REV</td>
        </tr>
        <tr>
            <td style="padding: 5px;vertical-align: middle !important;">
                <b><?= (isset($show_pcms_irn[0]['irn_revision']) ?  $show_pcms_irn[0]['irn_revision'] :  "00") ?></b>
            </td>
        </tr>
        <tr>
            <td style="padding: 5px;vertical-align: middle !important;">PAGE </td>
        </tr>
        <tr>
            <td style="padding: 5px;vertical-align: middle !important;"><b>1 Of 2</b></td>
        </tr>
    </table>

    <table border="1px" style="border-collapse: collapse !important;width: 703px !important;">
        <tr>
            <td colspan="2" valign="middle" style="padding: 5px;width: 80% !important;vertical-align: middle !important;">
                <b>Document Reference No : </b>
                <!-- <br />• 07555701 (B) - E.80 Fabrication and Construction
                <br />• 08307791 - Inspection Test Procedure - <?= $discipline_name[$show_pcms_irn[0]['discipline']] ?>
                <br />• 08308559 - In-process Inspection procedure -->
                <!-- <br/>● 002752254 - Part B Section 4 - Offshore Converter Platform
                <br/>● 003720389 - In-process Inspection procedure -->
                <?= $master_acceptance[$show_pcms_irn[0]['project_id']][$show_pcms_irn[0]['company_id']][$show_pcms_irn[0]['discipline']][$show_pcms_irn[0]['module']][$show_pcms_irn[0]['type_of_module']]['irn']['procedure']; ?>

            </td>
            <td style="padding: 5px;vertical-align: middle !important;width: 20% !important;">
                <b>DATE :</b>
                <br /><?= (isset($show_pcms_irn_description[0]['rfi_date']) ? date("F d, Y", strtotime($show_pcms_irn_description[0]['rfi_date'])) : null) ?>
            </td>
        </tr>
    </table>

    <table border="1px" style="border-collapse: collapse !important;width: 703px !important;">
        <tr>
            <td colspan="3" valign="middle" style="padding: 5px;width: 100% !important;vertical-align: middle !important;">
                Location of Origin : <?= @$area_name_arr_v2[$show_pcms_irn[0]['area_v2']] . ", " . @$location_name_arr_v2[$show_pcms_irn[0]['location_v2']]; ?>
            </td>
        </tr>
    </table>

    <table border="1px" style="border-collapse: collapse !important;width: 703px !important;">
        <tr>
            <td colspan="3" valign="middle" style="font-weight:bold;padding: 5px;width: 100% !important;vertical-align: middle !important;">Description :</td>
        </tr>
        <?php foreach ($show_pcms_irn_description as $value) { ?>
            <tr>
                <td colspan="3" valign="middle" style="padding: 5px;width: 100% !important;vertical-align: middle !important;">
                    <?php echo $value["item_tag_description"];  ?>
                </td>
            </tr>
        <?php } ?>
    </table>

    <table border="1px" style="border-collapse: collapse !important;width: 703px !important;">
        <tr>
            <td colspan="3" valign="middle" style="padding: 5px;width: 100% !important;vertical-align: middle !important;">
                <center>
                    <b>Item described below requested to be release for next further handling (<span style="<?= $show_pcms_irn[0]['irn_type'] == 1 ? '' : 'text-decoration: line-through;' ?>">Installation</span>/
                        <span style="<?= $show_pcms_irn[0]['irn_type'] == 2 ? '' : 'text-decoration: line-through;' ?>">Blasting & Painting</span>/
                        <span style="<?= $show_pcms_irn[0]['irn_type'] == 3 ? '' : 'text-decoration: line-through;' ?>">Galvanized</span>/
                        <span style="<?= $show_pcms_irn[0]['irn_type'] == 4 ? '' : 'text-decoration: line-through;' ?>">Erection</span>)</b>
                </center>
            </td>
        </tr>
    </table>

    <table border="1px" style="border-collapse: collapse !important;width: 703px !important;">
        <tr>
            <td colspan="2" style="font-weight:bold;padding: 5px;width: 100% !important;vertical-align: middle !important;">Item Number :</td>
        </tr>
        <?php $no_data = 1;
        foreach ($show_pcms_irn_description as $value_pc) { ?>
            <tr>
                <td style="padding: 5px;width: 1% !important;vertical-align: middle !important;">
                    <?php echo $no_data; ?>
                </td>
                <td style="padding: 5px;width: 99% !important;vertical-align: middle !important;">
                    <?php echo $value_pc["item_tag_no"];  ?>
                </td>
            </tr>
        <?php $no_data++;
        } ?>
        <tr>
            <td colspan="2" valign="middle" style="padding: 5px;width: 100% !important;vertical-align: middle !important;">
                <b>Total : <?php echo $no_data - 1; ?> ea </b>
            </td>
        </tr>
    </table>


    <!-- item for releases -->
    <table border="1px" style="border-collapse: collapse !important;width: 703px !important;">
        <tr>
            <td colspan="6" valign="middle" style="font-weight:bold;padding: 5px;width: 100% !important;vertical-align: middle !important;">Detail Checklist :</td>
        </tr>
        <tr>
            <td valign="middle" style="padding: 5px;width: 2% !important;vertical-align: middle !important;"></td>
            <td valign="middle" style="padding: 5px;width: 20% !important;vertical-align: middle !important;"></td>
            <td valign="middle" style="font-weight:bold;padding: 5px;width: 8% !important;vertical-align: middle !important;">
                <center>YES / NO / NA</center>
            </td>
            <td valign="middle" style="padding: 5px;width: 2% !important;vertical-align: middle !important;"></td>
            <td valign="middle" style="padding: 5px;width: 20% !important;vertical-align: middle !important;"></td>
            <td valign="middle" style="font-weight:bold;padding: 5px;width: 8% !important;vertical-align: middle !important;">
                <center>YES / NO / NA</center>
            </td>
        </tr>
        <?php $row = 5;
        $col = 2;
        for ($i = 1; $i < $row + 1; $i++) : ?>
            <tr>
                <?php for ($c = 0; $c < $col; $c++) : ?>
                    <?php $index = ($i + ($c * $row)) - 1; ?>
                    <td style="padding: 5px;width: 2% !important;vertical-align: middle !important;text-align: center;">
                        <?= isset($master_irn_detail[$index]) ? $master_irn_detail[$index]['id_irn_detail'] : '' ?>
                    </td>
                    <td valign="middle" style="padding: 5px;width: 20% !important;vertical-align: middle !important;">
                        <?= isset($master_irn_detail[$index]) ? $master_irn_detail[$index]['inspection_desc'] : '' ?>
                    </td>
                    <td valign="middle" style="padding: 5px;width: 15% !important;vertical-align: middle !important;text-align: center;">
                        <?php if (isset($master_irn_detail[$index])) { ?>
                            <span style="display: inline-block !important;width: 150px !important;">
                                <input type="checkbox" name="optiona" id="opta" value='YES' <?php if (@$irn_pcms_detail[$master_irn_detail[$index]['id_irn_detail']]['irn_inspection_result'] == 'YES') {
                                                                                                echo "checked";
                                                                                            } ?> <?php if ($this->user_cookie[7] == 8) {
                                                                                                        echo "disable";
                                                                                                    } ?> required>
                                <span class="checkboxtext">&nbsp;&nbsp;&nbsp;YES</span>
                                <input type="checkbox" nname="optiona" id="opta" value='NO' <?php if (@$irn_pcms_detail[$master_irn_detail[$index]['id_irn_detail']]['irn_inspection_result'] == 'NO') {
                                                                                                echo "checked";
                                                                                            } ?> <?php if ($this->user_cookie[7] == 8) {
                                                                                                        echo "disable";
                                                                                                    } ?> required>
                                <span class="checkboxtext">&nbsp;&nbsp;&nbsp;NO</span>
                                <input type="checkbox" name="optiona" id="opta" value='N/A' <?php if (@$irn_pcms_detail[$master_irn_detail[$index]['id_irn_detail']]['irn_inspection_result'] == 'N/A') {
                                                                                                echo "checked";
                                                                                            } ?> <?php if ($this->user_cookie[7] == 8) {
                                                                                                        echo "disable";
                                                                                                    } ?> required>
                                <span class="checkboxtext"> &nbsp;&nbsp;&nbsp;N/A</span>
                            </span>
                        <?php } else {
                            echo "&nbsp;";
                        } ?>
                    </td>
                <?php endfor; ?>
            </tr>
        <?php endfor; ?>
    </table>


    <table border="1px" style="border-collapse: collapse !important;width: 703px !important;">
        <tr>
            <td colspan="3" valign="middle" style="padding: 5px;width: 100% !important;vertical-align: middle !important;">
                <center>
                    Notes on checklist : if any item hasbeen checked / verified / inspected prior to release this release note, the item shall be ticked as “ YES”, and if the item has not been checked/verified/inspected prior to release this release note, the item shall be ticked as “NO”, and if does not relevant on one of them, it should be ticked as ” N/A ”
                </center>
            </td>
        </tr>
    </table>

    <table border="1px" style="border-collapse: collapse !important;width: 703px !important;">
        <tr>
            <td colspan="3" valign="middle" style="padding: 5px;width: 100% !important;vertical-align: middle !important;">
                <center>
                    <b>INSPECTION EXECUTION RESULT</b>
                </center>
            </td>
        </tr>
        <tr>
            <td colspan="3" valign="middle" style="padding: 5px;width: 100% !important;vertical-align: middle !important;">
                <center>
                    <table class='table_content' width="100%" cellspacing="0" cellpadding="0" style=' border: none !important;'>
                        <tr>
                            <td style="text-align:left;padding:5px !important;   ">
                                <input type="checkbox" name="optiona" id="opta" <?php if ($show_pcms_irn[0]['status_inspection'] == '7') {
                                                                                    echo "checked";
                                                                                } ?> />
                                <span class="checkboxtext">&nbsp;&nbsp;Accepted&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            </td>
                            <td style="text-align:left;padding:5px !important;   ">
                                <input type="checkbox" name="optiona" id="opta" <?php if ($show_pcms_irn[0]['status_inspection'] == '9') {
                                                                                    echo "checked";
                                                                                } ?> />
                                <span class="checkboxtext">&nbsp;&nbsp;Accepted & Released With Comment&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            </td>
                            <td style="text-align:left;padding:5px !important;   ">
                                <input type="checkbox" name="optiona" id="opta" <?php if ($show_pcms_irn[0]['status_inspection'] == '6') {
                                                                                    echo "checked";
                                                                                } ?> />
                                <span class="checkboxtext">&nbsp;&nbsp;Rejected&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            </td>
                            <td style="text-align:left;padding:5px !important;   ">
                                <input type="checkbox" name="optiona" id="opta" <?php if ($show_pcms_irn[0]['status_inspection'] == '10') {
                                                                                    echo "checked";
                                                                                } ?> />
                                <span class="checkboxtext">&nbsp;&nbsp;Postpone&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            </td>
                            <td style="text-align:left;padding:5px !important;   ">
                                <input type="checkbox" name="optiona" id="opta" <?php if ($show_pcms_irn[0]['status_inspection'] == '11') {
                                                                                    echo "checked";
                                                                                } ?> />
                                <span class="checkboxtext">&nbsp;&nbsp;Re-Offer&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            </td>
                        </tr>
                    </table>
                </center>
            </td>
        </tr>
    </table>

    <?php if (sizeof($show_pcms_irn_dc) > 0 || sizeof($show_pcms_irn_punchlist) > 0) { ?>
        <table border="1px" style="border-collapse: collapse !important;" width="98%">
            <tr>
                <td style="text-align:left; padding-bottom: 4px; ">
                    <b>Additional Attachment :</b><br />
                    <?php foreach ($show_pcms_irn_dc as $key => $value) {
                        echo "* <a target='_blank' href='https://www.smoebatam.com/pcms_v2_photo/dimension_control/" . $data_dc_show[$value['id_detail_dimension']]['attachment'] . "'>" . $data_dc_show[$value['id_detail_dimension']]['report_number'] . "</a>";
                    } ?>
                    <?php foreach ($show_pcms_irn_punchlist as $key => $value) {
                        $enc_redline = strtr($this->encryption->encrypt($value['pnc_attachment']), '+=/', '.-~');
                        $enc_path    = strtr($this->encryption->encrypt('/PCMS/pcms_v2/irn_punchlist'), '+=/', '.-~');
                        // echo "* <a target='_blank' href='" . site_url('irn/open_file/' . $enc_redline . '/' . $enc_path) . "'>" . $value['pnc_desc'] . "</a>";
                        echo "* <a target='_blank' href='" . site_url('irn/open_file_irn/' . $enc_redline . '/' . $enc_path . "/download/" . encrypt($value['pnc_desc'])) . "'>" . $value['pnc_desc'] . "</a> ";

                    } ?>
                </td>
            </tr>
        </table>
    <?php } ?>

    <!-- <table  border="1px" style="border-collapse: collapse !important;" width="98%"><tr>
              <td style="text-align:left; padding-bottom: 4px; ">
                <b>MWTR Attachment :</b><br/> 
                <?php foreach ($drawing_unique as $key => $value) {
                    echo "* <a target='_blank' href='" . base_url() . "irn/show_irn_detail_wtr/" . strtr($this->encryption->encrypt($show_pcms_irn[0]['submission_id']), '+=/', '.-~') . "/" . strtr($this->encryption->encrypt($value), '+=/', '.-~') . "'>" . $value . "</a><br/>";
                } ?> 
              </td>
            </tr></table> -->

    <table border="1px" style="border-collapse: collapse !important;width: 703px !important;">
        <tr>
            <td style="text-align:left;padding-bottom:60px;">
                <b>Comment/Remarks :<br /><br />
                    <?= isset($show_pcms_irn[0]['client_remarks']) ? nl2br($show_pcms_irn[0]['client_remarks']) : '-' ?>
            </td>
        </tr>
    </table>

    <?php if ($show_pcms_irn[0]['project_id'] == 20) { ?>
        <table width="100%" border="1px" style="border-collapse: collapse;">
            <tr>
                <td style="text-align:center;  text-align: center;font-weight: bold; width:25%;">CONTRACTOR</td>
                <td style="text-align:center;  text-align: center;font-weight: bold; width:25%;">GE</td>
                <?php if ($show_pcms_irn[0]['project_id'] == 19 || $show_pcms_irn[0]['project_id'] == 21) { ?>
                    <td style="text-align:center;  text-align: center;font-weight: bold; width:25%;">COMPANY</td>
                <?php } ?>
                <?php if ($show_pcms_irn[0]['project_id'] == 17) { ?>
                    <td style="text-align:center;  text-align: center;font-weight: bold; width:25%;">EMPLOYER</td>
                <?php } ?>                <td style="text-align:center;  text-align: center;font-weight: bold; width:25%;">THIRD PARTY</td>
            </tr>
            <tr>
                <td>
                    NAME
                    <b><?php if (isset($user[$show_pcms_irn[0]['smoe_approval_by']]['full_name'])) {
                            echo $user[$show_pcms_irn[0]['smoe_approval_by']]['full_name'];
                        } ?></b>
                </td>
                <td>
                    NAME
                    <b><?php if (isset($user[$show_pcms_irn[0]['client_approval_by']]['full_name'])) {
                            echo  $user[$show_pcms_irn[0]['client_approval_by']]['full_name'];
                        } ?></b>
                </td>
                <td>
                    NAME
                    <b><?php if (isset($user[$show_pcms_irn[0]['client_2nd_inspection_by']]['full_name'])) {
                            echo  $user[$show_pcms_irn[0]['client_2nd_inspection_by']]['full_name'];
                        } ?></b>
                </td>
                <td>
                    NAME
                </td>
            </tr>
            <tr>
                <td>SIGNATURE<br />
                    <?php if (isset($user[$show_pcms_irn[0]['smoe_approval_by']]['sign_approval'])) { ?>
                        <center>
                            <img src="data:image/png;base64,<?= $user[$show_pcms_irn[0]['smoe_approval_by']]['sign_approval'] ?>" style="width: 120px !important; height: 90px !important">
                        </center>
                    <?php } ?>
                </td>

                <td style=" ">SIGNATURE<br />
                    <?php if (isset($user[$show_pcms_irn[0]['client_approval_by']]['sign_approval'])) { ?>
                        <center>
                            <img src="data:image/png;base64,<?= $user[$show_pcms_irn[0]['client_approval_by']]['sign_approval'] ?>" style="width: 120px !important; height: 90px !important">
                        </center>
                    <?php } ?>
                </td>

                <td style=" ">SIGNATURE<br />
                    <?php if (isset($user[$show_pcms_irn[0]['client_2nd_inspection_by']]['sign_approval'])) { ?>
                        <center>
                            <img src="data:image/png;base64,<?= $user[$show_pcms_irn[0]['client_2nd_inspection_by']]['sign_approval'] ?>" style="width: 120px !important; height: 90px !important">
                        </center>
                    <?php } ?>
                </td>
                <td>
                    SIGNATURE<br /><br /><br />
                </td>
            </tr>
            <tr>
                <td>Date
                    <?php if (isset($user[$show_pcms_irn[0]['smoe_approval_by']]['sign_approval'])) { ?>
                        <b><?php echo date("Y-m-d", strtotime($show_pcms_irn[0]['smoe_approval_date'])); ?></b>
                    <?php } ?>
                </td>
                <td>Date
                    <?php if (isset($user[$show_pcms_irn[0]['client_approval_by']]['sign_approval'])) { ?>
                        <b><?php echo date("Y-m-d", strtotime($show_pcms_irn[0]['client_approval_date'])); ?></b>
                    <?php } ?>
                </td>
                <td>Date
                    <?php if (isset($user[$show_pcms_irn[0]['client_2nd_inspection_by']]['sign_approval'])) { ?>
                        <b><?php echo date("Y-m-d", strtotime($show_pcms_irn[0]['client_2nd_inspection_date'])); ?></b>
                    <?php } ?>
                </td>
                <td>Date</td>
            </tr>
        </table>
    <?php } else { ?>
        <table width="100%" border="1px" style="border-collapse: collapse;">
            <tr>
                <?php if ($show_pcms_irn[0]['company_id'] == 5) { ?>
                    <td style="text-align:center;  text-align: center;font-weight: bold; width:25%;">DSAW</td>
                <?php } ?>
                <td style="text-align:center;  text-align: center;font-weight: bold; width:25%;">CONTRACTOR</td>
                <?php if ($show_pcms_irn[0]['project_id'] == 19 || $show_pcms_irn[0]['project_id'] == 21) { ?>
                    <td style="text-align:center;  text-align: center;font-weight: bold; width:25%;">COMPANY</td>
                <?php } ?>
                <?php if ($show_pcms_irn[0]['project_id'] == 17) { ?>
                    <td style="text-align:center;  text-align: center;font-weight: bold; width:25%;">EMPLOYER</td>
                <?php } ?>                <td style="text-align:center;  text-align: center;font-weight: bold; width:25%;">THIRD PARTY</td>
            </tr>
            <tr>
                <?php if ($show_pcms_irn[0]['company_id'] == 5) { ?>
                    <td>
                        NAME
                        <b><?php if (isset($user[$show_pcms_irn[0]['create_by']]['full_name'])) {
                                echo $user[$show_pcms_irn[0]['create_by']]['full_name'];
                            } ?></b>
                    </td>
                <?php } ?>
                <td>
                    NAME
                    <b><?php if (isset($user[$show_pcms_irn[0]['smoe_approval_by']]['full_name'])) {
                            echo $user[$show_pcms_irn[0]['smoe_approval_by']]['full_name'];
                        } ?></b>
                </td>
                <td>
                    NAME
                    <b><?php if (isset($user[$show_pcms_irn[0]['client_approval_by']]['full_name'])) {
                            echo  $user[$show_pcms_irn[0]['client_approval_by']]['full_name'];
                        } ?></b>
                </td>
                <td>
                    NAME
                    <b><?php if (isset($user[$show_pcms_irn[0]['third_party_approval_by']]['full_name'])) {
                            echo  $user[$show_pcms_irn[0]['third_party_approval_by']]['full_name'];
                        } ?></b>
                </td>
            </tr>
            <tr>
                <?php if ($show_pcms_irn[0]['company_id'] == 5) { ?>
                    <td>SIGNATURE<br />
                        <?php if (isset($user[$show_pcms_irn[0]['create_by']]['sign_approval'])) { ?>
                            <center>
                                <img src="data:image/png;base64,<?= $user[$show_pcms_irn[0]['create_by']]['sign_approval'] ?>" style="width: 120px !important; height: 90px !important">
                            </center>
                        <?php } ?>
                    </td>
                <?php } ?>

                <td>SIGNATURE<br />
                    <?php if (isset($user[$show_pcms_irn[0]['smoe_approval_by']]['sign_approval'])) { ?>
                        <center>
                            <img src="data:image/png;base64,<?= $user[$show_pcms_irn[0]['smoe_approval_by']]['sign_approval'] ?>" style="width: 120px !important; height: 90px !important">
                        </center>
                    <?php } ?>
                </td>

                <td style=" ">SIGNATURE<br />
                    <center>
                        <div style="page-break-inside: avoid;">
                            <?php if ($show_pcms_irn[0]['project_id'] == 17) : ?>
                                <style type="text/css">
                                    .color_stamp {
                                        color: rgba(63, 72, 204, 255) !important;
                                    }

                                    .valign_middle {
                                        vertical-align: middle !important;
                                    }

                                    .check_stamp {
                                        -ms-transform: scale(1.7) !important;
                                        -moz-transform: scale(1.7) !important;
                                        -webkit-transform: scale(1.7) !important;
                                        -o-transform: scale(1.7) !important;
                                        transform: scale(1.7) !important;
                                    }

                                    .border_stamp {
                                        border: 3px solid rgba(63, 72, 204, 255) !important;
                                    }

                                    .box_stamp {
                                        padding: 4px !important;
                                        font-weight: bold !important;
                                        z-index: 99 !important;
                                    }
                                </style>
                                <div class="box color_stamp border_stamp box_stamp">
                                    <center>
                                        <img src="<?= $orsted_stamp ?>" style="width:35px">
                                        <br>
                                        <strong>CHW 2204 OSS Project</strong>
                                    </center>
                                    <table cellpadding="0" border="0" style="width:100%; border-collapse: collapse !important; all: unset !important;">
                                        <tr>
                                            <td width="40%" class="valign_middle">Review</td>
                                            <td><input type="checkbox" style="margin-bottom: 8px !important" checked></td>
                                        </tr>
                                        <tr>
                                            <td width="40%" class="valign_middle">Witness</td>
                                            <td><input type="checkbox" style="margin-bottom: 8px !important" checked></td>
                                        </tr>
                                        <tr>
                                            <td width="40%" class="valign_middle">Inspect</td>
                                            <td><input type="checkbox" style="margin-bottom: 8px !important" checked></td>
                                        </tr>
                                    </table>
                                    <br>
                                    Date : <?= $show_pcms_irn[0]['client_approval_date'] ? date('Y-m-d', strtotime($show_pcms_irn[0]['client_approval_date'])) : space(15) ?>
                                    &nbsp;
                                    <span style="z-index: 99 !important;">Signature :</span>

                                </div>
                                <div class="text-right" style="padding-right: 5px !important; padding-bottom:3px !important;">
                                    <?php if (isset($user[$show_pcms_irn[0]['client_approval_by']]['sign_approval'])) { ?>
                                        <img src="data:image/png;base64, <?= $user[$show_pcms_irn[0]['client_approval_by']]['sign_approval'] ?>" style='width: 3cm !important; height: 2.8cm !important; position: absolute !important; margin-left: 150px !important; margin-top: -117px !important; z-index: -99 !important; ' />
                                    <?php } ?>
                                </div>
                            <?php else : ?>
                                <?php if (isset($user[$show_pcms_irn[0]['client_approval_by']]['sign_approval'])) { ?>
                                    <img src="data:image/png;base64,<?= $user[$show_pcms_irn[0]['client_approval_by']]['sign_approval'] ?>" style="width: 120px !important; height: 90px !important">
                                <?php } ?>
                            <?php endif; ?>
                        </div>
                    </center>
                </td>
                <td>
                    SIGNATURE<br /> <?php if (isset($user[$show_pcms_irn[0]['third_party_approval_by']]['sign_approval'])) { ?>
                        <center>
                            <img src="data:image/png;base64,<?= $user[$show_pcms_irn[0]['third_party_approval_by']]['sign_approval'] ?>" style="width: 120px !important; height: 90px !important">
                        </center>
                    <?php } ?><br />
                </td>
            </tr>
            <tr>
                <?php if ($show_pcms_irn[0]['company_id'] == 5) { ?>
                    <td style="padding-bottom: 4px; ">Date
                        <?php if (isset($user[$show_pcms_irn[0]['create_by']]['sign_approval'])) { ?>
                            <b><?php echo date("Y-m-d", strtotime($show_pcms_irn[0]['create_date'])); ?></b>
                        <?php } ?>
                    </td>
                <?php } ?>

                <td>Date
                    <?php if (isset($user[$show_pcms_irn[0]['smoe_approval_by']]['sign_approval'])) { ?>
                        <b><?php echo date("Y-m-d", strtotime($show_pcms_irn[0]['smoe_approval_date'])); ?></b>
                    <?php } ?>
                </td>
                <td>Date
                    <?php if (isset($user[$show_pcms_irn[0]['client_approval_by']]['sign_approval'])) { ?>
                        <b><?php echo date("Y-m-d", strtotime($show_pcms_irn[0]['client_approval_date'])); ?></b>
                    <?php } ?>
                </td>
                <td>Date
                    <?php if (isset($user[$show_pcms_irn[0]['third_party_approval_by']]['sign_approval'])) { ?>
                        <b><?php echo date("Y-m-d", strtotime($show_pcms_irn[0]['third_party_approval_date'])); ?></b>
                    <?php } ?>
                </td>
            </tr>
        </table>
    <?php } ?>



    <div class="page_break"></div>

    <table border="1px" style="border-collapse: collapse !important;width: 703px !important;">
        <tr>
            <td rowspan='6' valign="middle" style="padding: 5px;vertical-align: middle !important;width: 200px !important;">
                <center>
                    <img src="<?php echo $project_name[$show_pcms_irn[0]['project']]['project_logo']; ?>" style="width: 200px;">
                </center>
            </td>
            <td rowspan='6' valign="middle" style="padding: 5px;width: 280px !important;vertical-align: middle !important;font-weight: bold;">
                <center>
                    <h2>
                        <?php echo strtoupper($project_desc[$show_pcms_irn[0]['project']]) ?>
                        <br /> INSPECTION RELEASE NOTE
                    </h2>
                </center>
            </td>
            <td style="padding: 5px;vertical-align: middle !important;width: 20% !important;">DOC NO :</td>
        </tr>
        <tr>
            <td style="padding: 5px;vertical-align: middle !important;">
                <b><?php if ($show_pcms_irn[0]['project'] == 21) { ?>
<?= (isset($show_pcms_irn[0]['report_number']) ? ($master_report_number[$show_pcms_irn[0]['project']][$show_pcms_irn[0]['company_id']][$show_pcms_irn[0]['discipline']][$show_pcms_irn[0]['type_of_module']][$show_pcms_irn[0]['deck_elevation']][$show_pcms_irn[0]['irn_type']]['irn_rfi'] . $show_pcms_irn[0]['report_number']) : "Draft-" . $show_pcms_irn[0]['submission_id']) ?>
<?php  } else {  ?>
<?= (isset($show_pcms_irn[0]['report_number']) ? ($master_report_number[$show_pcms_irn[0]['project']][$show_pcms_irn[0]['company_id']][$show_pcms_irn[0]['discipline']][$show_pcms_irn[0]['type_of_module']][$show_pcms_irn[0]['irn_type']]["irn_rfi"] . $show_pcms_irn[0]['report_number']) : "Draft-" . $show_pcms_irn[0]['submission_id']) ?></b>
<?php  } ?></b>
            </td>
        </tr>
        <tr>
            <td style="padding: 5px;vertical-align: middle !important;">REV</td>
        </tr>
        <tr>
            <td style="padding: 5px;vertical-align: middle !important;">
                <b><?= (isset($show_pcms_irn[0]['irn_revision']) ?  $show_pcms_irn[0]['irn_revision'] :  "00") ?></b>
            </td>
        </tr>
        <tr>
            <td style="padding: 5px;vertical-align: middle !important;">PAGE </td>
        </tr>
        <tr>
            <td style="padding: 5px;vertical-align: middle !important;"><b>2 Of 2</b></td>
        </tr>
    </table>

    <table border="1px" style="border-collapse: collapse !important;width: 703px !important;">
        <tr>
            <td style="padding: 5px;vertical-align: middle !important;"><b>Document Reference No. : WHP02-SMO1-ASYYY-23-182014-0001</b></td>
        </tr>
    </table>


    <br />

    <table border="1px" style="border-collapse: collapse !important;width: 703px !important;">
        <tr style='padding:10px;text-align:center;'>
            <th>S/N</th>
            <th>DRAWING REFERENCE</th>
            <th>DRAWING TITLE</th>
            <th>REMARKS</th>
            <th>VALIDATOR AUTHORITY</th>
        </tr>
        <?php $no = 1;
        foreach ($drawing_unique as $key => $value) { ?>
            <tr>
                <td style='padding:10px;text-align:center;width:10px;'><?= $no ?></td>
                <td style='padding:10px;text-align:center;width:100px;'>
                    <?= "<a target='_blank' href='" . base_url() . "wtr/show_irn_detail_wtr/" . strtr($this->encryption->encrypt($show_pcms_irn[0]['submission_id']), '+=/', '.-~') . "/" . strtr($this->encryption->encrypt($value), '+=/', '.-~') . ($show_pcms_irn[0]['discipline'] == 1 ? '/1' : '') . "'>" . $value . "</a><br/>";
                    ?>
                </td>
                <td style='padding:10px;text-align:center;width:200px;'><?= $activity_eng[$value]['title'] ?></td>
                <td style='padding:10px;text-align:center;width:200px;'><?= (isset($irn_drawing_status[$show_pcms_irn[0]["submission_id"]][$value]['remarks']) ? $irn_drawing_status[$show_pcms_irn[0]["submission_id"]][$value]['remarks'] : null) ?></td>
                <td style='padding:10px;text-align:left;'>
                    <input type="checkbox" name="optiona" id="opta" value='1' <?= (isset($irn_drawing_status[$show_pcms_irn[0]["submission_id"]][$value]['validator_auth']) ? ($irn_drawing_status[$show_pcms_irn[0]["submission_id"]][$value]['validator_auth'] == 1 ? "checked" : null) : null) ?> /><span class="checkboxtext"> Checked </span><br />
                    <input type="checkbox" name="optiona" id="opta" value='0' <?= (isset($irn_drawing_status[$show_pcms_irn[0]["submission_id"]][$value]['validator_auth']) ? ($irn_drawing_status[$show_pcms_irn[0]["submission_id"]][$value]['validator_auth'] == 0 ? "checked" : null) : "checked") ?> /><span class="checkboxtext"> Unchecked </span>
                    <br /><br />
                    <b><i><?= ((isset($irn_drawing_status[$show_pcms_irn[0]["submission_id"]][$value]['checked_by']) ? $user[$irn_drawing_status[$show_pcms_irn[0]["submission_id"]][$value]['checked_by']]['full_name'] : null)) ?><br />
                            <?= ((isset($irn_drawing_status[$show_pcms_irn[0]["submission_id"]][$value]['checked_by']) ? $irn_drawing_status[$show_pcms_irn[0]["submission_id"]][$value]['checked_date'] : null)) ?></i></b>
                </td>
            </tr>
        <?php $no++;
        } ?>
    </table>


</body>

</html>