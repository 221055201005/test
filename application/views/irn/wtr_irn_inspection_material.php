<?php //test_var($show_pcms_irn[0]["is_itr"]);  
?>

<style type="text/css">
  .bg-selected {
    background-color: #949494;
  }

  .titleHead {
    border: 1px #000 solid;
    border-collapse: collapse;
    text-align: center;
    vertical-align: middle;
    font-size: 100%;
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
    font-size: 100%;
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
    font-size: 100%;
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
    font-size: 100%;
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
    font-size: 16px;
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

  #example1 {
    border-radius: 25px;
    border: 1px solid;
    padding: 10px;
    box-shadow: 5px 10px;
    width: 80%;
  }

  #example2 {
    border-radius: 25px;
    border: 1px solid;
    padding: 10px;
    box-shadow: 5px 10px;
    width: 100%;
  }
</style>
<div id="content" class="container-fluid bg-white overflow-auto">
  <div class="row">
    <div class="col-md-12">
      <br />


      <center>

        <div id='example1'>

          <table border="1px" style="border-collapse: collapse !important;padding:10px;" width="100%">
            <tr>
              <td rowspan='3' valign="middle" style="padding: 5px;width: 260px !important;vertical-align: middle !important;">
                <center>
                  <img src="<?= base_url() ?>img/seatrium_logo_bg_white.png" style="width: 120px;">
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
              <td style="padding: 5px;vertical-align: middle !important;">
                <?php if ($show_pcms_irn[0]['project'] == 21) { ?>
                  <b><?= (isset($show_pcms_irn[0]['report_number']) ?
                        ($master_report_number[$show_pcms_irn[0]['project']][$show_pcms_irn[0]['company_id']][$show_pcms_irn[0]['discipline']][$show_pcms_irn[0]['type_of_module']][$show_pcms_irn[0]['deck_elevation']][$show_pcms_irn[0]['irn_type']]['irn_rfi'] . $show_pcms_irn[0]['report_number']) : "Draft-" . $show_pcms_irn[0]['submission_id']) ?></b>
                <?php  } else {  ?>
                  <b><?= (isset($show_pcms_irn[0]['report_number']) ?
                        ($master_report_number[$show_pcms_irn[0]['project']][$show_pcms_irn[0]['company_id']][$show_pcms_irn[0]['discipline']][$show_pcms_irn[0]['type_of_module']][$show_pcms_irn[0]['irn_type']]["irn_rfi"] . $show_pcms_irn[0]['report_number']) : "Draft-" . $show_pcms_irn[0]['submission_id']) ?></b>
                <?php  } ?>
              </td>
            </tr>
            <tr>
              <td style="padding: 5px;vertical-align: middle !important;" style="padding: 10px;">PROJECT TITLE</td>
              <td style="padding: 5px;vertical-align: middle !important;">SUBMITED DATE</td>
            </tr>
            <tr>
              <td rowspan='3' valign="middle" style="padding: 5px;vertical-align: middle !important;">
                <center>
                  <img src="<?php echo $client_logo[$show_pcms_irn[0]['project']]; ?>" style="width: 120px;">
                </center>
              </td>
              <td style="padding: 5px;vertical-align: middle !important;"><b><?php echo strtoupper($project_name[$show_pcms_irn[0]['project']]['description']) ?></b></td>
              <td style="padding: 5px;vertical-align: middle !important;"><b><?php echo date("F d, Y", strtotime($show_pcms_irn_description[0]['rfi_date'])) ?></b></td>
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
          <br>
          <table border="1px" style="border-collapse: collapse !important;padding:20px !important;" width="100%">
            <?php
            $inspection_date = date('d', strtotime($show_pcms_irn_description[0]['rfi_date']));
            $inspection_month = date('m', strtotime($show_pcms_irn_description[0]['rfi_date']));
            ?>

            <tr>
              <td colspan="22" style="text-align:center; padding-bottom: 4px; "><b>RFI - INSPECTION NOTIFICATION</b></td>
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
              <td colspan="22" style="text-align:left; padding:20px !important; ">
                <b> Document Ref : </b>
                <!-- <br />• 07555701 (B) - E.80 Fabrication and Construction
                <br />• 08307791 - Inspection Test Procedure - <?= $discipline_name[$show_pcms_irn[0]['discipline']] ?>
                <br />• 08308559 - In-process Inspection procedure -->
                <?= $master_acceptance[$show_pcms_irn[0]['project_id']][$show_pcms_irn[0]['company_id']][$show_pcms_irn[0]['discipline']][$show_pcms_irn[0]['module']][$show_pcms_irn[0]['type_of_module']]['irn']['procedure']; ?>

              </td>
            </tr>
            <tr>
              <td colspan="22" style="text-align:left; padding:10px !important;"><b>Discipline :</b> &nbsp;&nbsp;
                <?php if ($show_pcms_irn[0]['discipline'] == '2') { ?><input type="checkbox" name="optiona" id="opta" checked /><?php } else { ?><input type="checkbox" name="optiona" id="opta" /><?php } ?><span class="checkboxtext"> &nbsp;&nbsp;STRUCTURAL&nbsp;&nbsp;&nbsp;&nbsp;</span>

                <input type="checkbox" name="optiona" id="opta" /><span class="checkboxtext"> &nbsp;&nbsp;E & I&nbsp;&nbsp;&nbsp;&nbsp;</span>
                <input type="checkbox" name="optiona" id="opta" /><span class="checkboxtext"> &nbsp;&nbsp;MECHANICAL&nbsp;&nbsp;&nbsp;&nbsp;</span>
                <?php if ($show_pcms_irn[0]['discipline'] == '1') { ?>
                  <input type="checkbox" name="optiona" id="opta" checked="" />
                <?php } else { ?>
                  <input type="checkbox" name="optiona" id="opta" />
                <?php } ?>
                <span class="checkboxtext"> &nbsp;&nbsp;PIPING&nbsp;&nbsp;&nbsp;&nbsp;</span>
                <input type="checkbox" name="optiona" id="opta" />
                <span class="checkboxtext">&nbsp;&nbsp;HVAC&nbsp;&nbsp;&nbsp;&nbsp;</span>
              </td>
            </tr>
            <tr>
              <td colspan="22" style="font-weight:bold; text-align:left; padding:10px !important; ">TYPE OF INSPECTION :</td>
            </tr>
            <tr>
              <td colspan="22" style="text-align:left; padding:20px !important; ">
                <!-- <table width="100%">
                    <tr>
                      <td style="text-align:left; padding-bottom: 4px;">
                      <input  type="checkbox" name="optiona" id="opta"  />
                      <span class="checkboxtext">&nbsp;&nbsp;Material / Equipment Inspection&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      </td>
                      <td style="text-align:left; padding-bottom: 4px;">
                        <input  type="checkbox" name="optiona" id="opta"  />
                      <span class="checkboxtext">&nbsp;&nbsp;Dimensional&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      </td>
                      <td style="text-align:left; padding-bottom: 4px; ">
                        <input  type="checkbox" name="optiona" id="opta"  />
                      <span class="checkboxtext"> &nbsp;&nbsp;Witness Pressure Test&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      </td>
                      <td style="text-align:left; padding-bottom: 4px; ">
                        <input  type="checkbox" name="optiona" id="opta"  />
                      <span class="checkboxtext"> &nbsp;&nbsp;Mechanical Completion&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:left; padding-bottom: 4px;">
                        <input  type="checkbox" name="optiona" id="opta"  />
                      <span class="checkboxtext"> &nbsp;&nbsp;Welder Qualification&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      </td>
                      <td style="text-align:left; padding-bottom: 4px;">
                      <input  type="checkbox" name="optiona" id="opta" />
                      <span class="checkboxtext">  &nbsp;&nbsp;Fit-up Inspection&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      </td>
                      <td style="text-align:left; padding-bottom: 4px; ">
                        <input  type="checkbox" name="optiona" id="opta" checked  />
                      <span class="checkboxtext"> &nbsp;&nbsp;Final Inspection&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      </td>
                      <td style="text-align:left; padding-bottom: 4px; ">
                        <input  type="checkbox" name="optiona" id="opta"  />
                      <span class="checkboxtext"> &nbsp;&nbsp;Pre-Commisioning / Commisioning&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:left; padding-bottom: 4px;">
                        <input  type="checkbox" name="optiona" id="opta"  />
                      <span class="checkboxtext"> &nbsp;&nbsp;Procedure Qualification&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      </td>
                      <td style="text-align:left; padding-bottom: 4px;">
                      <input  type="checkbox" name="optiona" id="opta"  />
                      <span class="checkboxtext">  &nbsp;&nbsp;Visual Inspection&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      </td>
                      <td style="text-align:left; padding-bottom: 4px; ">
                        <input  type="checkbox" name="optiona" id="opta" checked  />
                      <span class="checkboxtext"> &nbsp;&nbsp;Blasting / Painting / Coating&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      </td>
                      <td style="text-align:left; padding-bottom: 4px; ">
                        <input  type="checkbox" name="optiona" id="opta" checked  />
                      <span class="checkboxtext"> &nbsp;&nbsp;Document Review&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:left; padding-bottom: 4px;">
                      <input  type="checkbox" name="optiona" id="opta"  />
                      <span class="checkboxtext">  &nbsp;&nbsp;Production Test Coupon Welding&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      </td>
                      <td style="text-align:left; padding-bottom: 4px;">
                        <input  type="checkbox" name="optiona" id="opta"  />
                      <span class="checkboxtext"> &nbsp;&nbsp;Witness NDT&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      </td>
                      <td style="text-align:left; padding-bottom: 4px; ">
                        <input  type="checkbox" name="optiona" id="opta"  />
                      <span class="checkboxtext"> &nbsp;&nbsp;E & I Inspection&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      </td>
                      <td style="text-align:left; padding-bottom: 4px; ">
                        <input  type="checkbox" name="optiona" id="opta"  />
                      <span class="checkboxtext"> &nbsp;&nbsp;Other&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      </td>
                    </tr>
                  </table> -->
                <table width="100%">
                  <tr>
                    <td style="text-align:left; padding-bottom: 4px;">
                      <input type="checkbox" name="type_of_inspection[]" value="1" onclick="setTypeofInspection(this, 1)" <?= in_array(1, explode(';', $show_pcms_irn[0]['type_of_inspection'])) ? 'checked' : '' ?> id="opta" />
                      <span class="checkboxtext">&nbsp;&nbsp;Material / Equipment Inspection&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    </td>
                    <td style="text-align:left; padding-bottom: 4px;">
                      <input type="checkbox" name="type_of_inspection[]" value="2" onclick="setTypeofInspection(this, 2)" <?= in_array(2, explode(';', $show_pcms_irn[0]['type_of_inspection'])) ? 'checked' : '' ?> id="opta" />
                      <span class="checkboxtext">&nbsp;&nbsp;Dimensional&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    </td>
                    <td style="text-align:left; padding-bottom: 4px; ">
                      <input type="checkbox" name="type_of_inspection[]" value="3" onclick="setTypeofInspection(this, 3)" <?= in_array(3, explode(';', $show_pcms_irn[0]['type_of_inspection'])) ? 'checked' : '' ?> id="opta" />
                      <span class="checkboxtext"> &nbsp;&nbsp;Witness Pressure Test&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    </td>
                    <td style="text-align:left; padding-bottom: 4px; ">
                      <input type="checkbox" name="type_of_inspection[]" value="4" onclick="setTypeofInspection(this, 4)" <?= in_array(4, explode(';', $show_pcms_irn[0]['type_of_inspection'])) ? 'checked' : '' ?> id="opta" />
                      <span class="checkboxtext"> &nbsp;&nbsp;Mechanical Completion&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    </td>
                  </tr>
                  <tr>
                    <td style="text-align:left; padding-bottom: 4px;">
                      <input type="checkbox" name="type_of_inspection[]" value="5" onclick="setTypeofInspection(this, 5)" <?= in_array(5, explode(';', $show_pcms_irn[0]['type_of_inspection'])) ? 'checked' : '' ?> id="opta" />
                      <span class="checkboxtext"> &nbsp;&nbsp;Welder Qualification&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    </td>
                    <td style="text-align:left; padding-bottom: 4px;">
                      <input type="checkbox" name="type_of_inspection[]" value="6" onclick="setTypeofInspection(this, 6)" <?= in_array(6, explode(';', $show_pcms_irn[0]['type_of_inspection'])) ? 'checked' : '' ?> id="opta" />
                      <span class="checkboxtext"> &nbsp;&nbsp;Fit-up Inspection&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    </td>
                    <td style="text-align:left; padding-bottom: 4px; ">
                      <input type="checkbox" name="type_of_inspection[]" value="7" onclick="setTypeofInspection(this, 7)" <?= in_array(7, explode(';', $show_pcms_irn[0]['type_of_inspection'])) ? 'checked' : '' ?> id="opta" />
                      <span class="checkboxtext"> &nbsp;&nbsp;Final Inspection&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    </td>
                    <td style="text-align:left; padding-bottom: 4px; ">
                      <input type="checkbox" name="type_of_inspection[]" value="8" onclick="setTypeofInspection(this, 8)" <?= in_array(8, explode(';', $show_pcms_irn[0]['type_of_inspection'])) ? 'checked' : '' ?> id="opta" />
                      <span class="checkboxtext"> &nbsp;&nbsp;Pre-Commisioning / Commisioning&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    </td>
                  </tr>
                  <tr>
                    <td style="text-align:left; padding-bottom: 4px;">
                      <input type="checkbox" name="type_of_inspection[]" value="9" onclick="setTypeofInspection(this, 9)" <?= in_array(9, explode(';', $show_pcms_irn[0]['type_of_inspection'])) ? 'checked' : '' ?> id="opta" />
                      <span class="checkboxtext"> &nbsp;&nbsp;Procedure Qualification&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    </td>
                    <td style="text-align:left; padding-bottom: 4px;">
                      <input type="checkbox" name="type_of_inspection[]" value="10" onclick="setTypeofInspection(this, 10)" <?= in_array(10, explode(';', $show_pcms_irn[0]['type_of_inspection'])) ? 'checked' : '' ?> id="opta" />
                      <span class="checkboxtext"> &nbsp;&nbsp;Visual Inspection&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    </td>
                    <td style="text-align:left; padding-bottom: 4px; ">
                      <input type="checkbox" name="type_of_inspection[]" value="11" onclick="setTypeofInspection(this, 11)" <?= in_array(11, explode(';', $show_pcms_irn[0]['type_of_inspection'])) ? 'checked' : '' ?> id="opta" />
                      <span class="checkboxtext"> &nbsp;&nbsp;Blasting / Painting / Coating&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    </td>
                    <td style="text-align:left; padding-bottom: 4px; ">
                      <input type="checkbox" name="type_of_inspection[]" value="12" onclick="setTypeofInspection(this, 12)" <?= in_array(12, explode(';', $show_pcms_irn[0]['type_of_inspection'])) ? 'checked' : '' ?> id="opta" />
                      <span class="checkboxtext"> &nbsp;&nbsp;Document Review&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    </td>
                  </tr>
                  <tr>
                    <td style="text-align:left; padding-bottom: 4px;">
                      <input type="checkbox" name="type_of_inspection[]" value="13" onclick="setTypeofInspection(this, 13)" <?= in_array(13, explode(';', $show_pcms_irn[0]['type_of_inspection'])) ? 'checked' : '' ?> id="opta" />
                      <span class="checkboxtext"> &nbsp;&nbsp;Production Test Coupon Welding&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    </td>
                    <td style="text-align:left; padding-bottom: 4px;">
                      <input type="checkbox" name="type_of_inspection[]" value="14" onclick="setTypeofInspection(this, 14)" <?= in_array(14, explode(';', $show_pcms_irn[0]['type_of_inspection'])) ? 'checked' : '' ?> id="opta" />
                      <span class="checkboxtext"> &nbsp;&nbsp;Witness NDT&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    </td>
                    <td style="text-align:left; padding-bottom: 4px; ">
                      <input type="checkbox" name="type_of_inspection[]" value="15" onclick="setTypeofInspection(this, 15)" <?= in_array(15, explode(';', $show_pcms_irn[0]['type_of_inspection'])) ? 'checked' : '' ?> id="opta" />
                      <span class="checkboxtext"> &nbsp;&nbsp;E & I Inspection&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    </td>
                    <td style="text-align:left; padding-bottom: 4px; ">
                      <input type="checkbox" name="type_of_inspection[]" value="16" onclick="setTypeofInspection(this, 16)" <?= in_array(16, explode(';', $show_pcms_irn[0]['type_of_inspection'])) ? 'checked' : '' ?> id="opta" />
                      <span class="checkboxtext"> &nbsp;&nbsp;Other&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    </td>
                  </tr>
                </table>
                <script type="text/javascript">
                  function setTypeofInspection(ini, angka) {
                    var check = $(ini)[0].checked
                    if (check == true) {
                      var status = 1
                    } else {
                      var status = 0
                    }
                    console.log(check)
                    $.ajax({
                      url: "<?php echo base_url() ?>irn/setTypeofInspection",
                      data: {
                        check: status,
                        angka: angka,
                        submission_id: "<?php echo $show_pcms_irn[0]['submission_id']; ?>",
                      },
                      type: 'post',
                      success: function(data) {
                        if (data.includes('Error') == true) {
                          sweetalert("error", data);
                        }
                      }
                    })
                  }
                </script>
              </td>
            </tr>
            <tr>
              <td colspan="1" style="font-weight: bold;padding:20px !important;">
                <center>No.</center>
              </td>
              <td colspan="6" style="font-weight: bold;padding:20px !important;">
                <center>ITEM / TAG NUMBER</center>
              </td>
              <td colspan="7" style="font-weight: bold;padding:20px !important;">
                <center>ITEM / DESCRIPTION</center>
              </td>
              <td colspan="3" style="font-weight: bold;padding:20px !important;">
                <center>AREA / LOCATION</center>
              </td>
              <td colspan="5" style="font-weight: bold;padding:20px !important;">
                <center>EXPECTED TIME</center>
              </td>
            </tr>

            <?php $nox = 1;
            foreach ($show_pcms_irn_description as $key => $value) { ?>
              <tr>
                <td colspan="1" style="padding:10px !important; text-align:center;"><?= $nox ?></td>
                <td colspan="6" style="padding:10px !important; text-align:center;"><?= $value['item_tag_no'] ?></td>
                <td colspan="7" style="padding:10px !important; text-align:center;"><?= $value['item_tag_description'] ?></td>
                <td colspan="3" style="padding:10px !important; text-align:center;"><?= @$area_name_arr_v2[$show_pcms_irn[0]['area_v2']] . ", " . @$location_name_arr_v2[$show_pcms_irn[0]['location_v2']]; ?></td>
                <td colspan="5" style="padding:10px !important; text-align:center;"><?= $value['expected_time'] ?></td>
              </tr>
            <?php $nox++;
            } ?>
            <tr>
              <td colspan="1" style="padding:10px !important;font-weight: bold;"> <br /></td>
              <td colspan="6" style="padding:10px !important;font-weight: bold;"></td>
              <td colspan="7" style="padding:10px !important;font-weight: bold;"></td>
              <td colspan="3" style="padding:10px !important;font-weight: bold;"></td>
              <td colspan="5" style="padding:10px !important;font-weight: bold;"></td>
            </tr>

          </table>
          <table border="1px" style="border-collapse: collapse !important;" width="100%">
            <tr>
              <td style="text-align:center; padding:10px !important;padding:20px;font-size: 20px !important;"><b>LEGEND : INSPECTION AUTHORITY AS PER ITP</b></td>
            </tr>
            <tr>
              <td style="padding:10px !important; font-size: 20px !important;font-size: 20px !important;padding:20px;">
                <center>
                  <table width="70%">
                    <tr>
                    <td><input type="checkbox" <?php echo ($value['project_id'] == 17) ? 'checked' : '' ?> /> Hold Point</td>
                      <td><input type="checkbox" <?php echo ($value['project_id'] == 19 || $value['project_id'] == 21) ? 'checked' : '' ?>/> Witness</td>
                      <td><input type="checkbox" /> Monitoring</td>
                      <td><input type="checkbox" <?php echo ($value['project_id'] == 17 || $value['project_id'] == 19 || $value['project_id'] == 21) ? 'checked' : '' ?> /> Review</td>
                    </tr>
                  </table>
                  <center>
              </td>
            </tr>
          </table>
          <table border="1px" style="border-collapse: collapse !important;" width="100%">
            <tr>
              <td style="text-align:center; padding-bottom: 4px;padding:20px;font-size: 20px !important;"><b>LEGEND : INSPECTION EXCECUTION RESULT</b></td>
            </tr>
            <tr>
              <td colspan="3" valign="middle" style="padding: 5px;width: 100% !important;font-size: 20px !important;vertical-align: middle !important;padding:20px;">
                <center>
                  <table width="100%">
                    <tr>
                      <?php if ($show_pcms_irn[0]['project_id'] == 20) { ?>
                        <td style="width: 15% !important;">
                          <center><label><input type="radio" name='inspection_result' value="13" <?php if ($show_pcms_irn[0]['status_inspection'] == '13') {
                                                                                                    echo "checked";
                                                                                                  } ?> <?php if ($this->user_cookie[7] == 8) { ?>required<?php } ?>> Accepted</label></center>
                        </td>
                      <?php } else { ?>
                        <td style="width: 15% !important;">
                          <center><label><input type="radio" name='inspection_result' value="7" <?php if ($show_pcms_irn[0]['status_inspection'] == '7') {
                                                                                                  echo "checked";
                                                                                                } ?> <?php if ($this->user_cookie[7] == 8) { ?>required<?php } ?>> Accepted</label></center>
                        </td>
                      <?php } ?>
                      <td style="width: 30% !important;">
                        <center><label><input type="radio" name='inspection_result' value="9" <?php if ($show_pcms_irn[0]['status_inspection'] == '9') {
                                                                                                echo "checked";
                                                                                              } ?> <?php if ($this->user_cookie[7] == 8) { ?>required<?php } ?>> Accepted & Released With Comment</label></center>
                      </td>
                      <td style="width: 15% !important;">
                        <center><label><input type="radio" name='inspection_result' value="6" <?php if ($show_pcms_irn[0]['status_inspection'] == '6') {
                                                                                                echo "checked";
                                                                                              } ?> <?php if ($this->user_cookie[7] == 8) { ?>required<?php } ?>> Rejected</label></center>
                      </td>
                      <td style="width: 20% !important;">
                        <center><label><input type="radio" name='inspection_result' value="10" <?php if ($show_pcms_irn[0]['status_inspection'] == '10') {
                                                                                                  echo "checked";
                                                                                                } ?> <?php if ($this->user_cookie[7] == 8) { ?>required<?php } ?>> Postpone</label></center>
                      </td>
                      <td style="width: 20% !important;">
                        <center><label><input type="radio" name='inspection_result' value="11" <?php if ($show_pcms_irn[0]['status_inspection'] == '11') {
                                                                                                  echo "checked";
                                                                                                } ?> <?php if ($this->user_cookie[7] == 8) { ?>required<?php } ?>> Re-Offer</label></center>
                      </td>
                    </tr>
                  </table>
                </center>
              </td>
            </tr>
            <tr>
              <td style="text-align:left; padding-bottom: 4px; ">
                <b>Contractor Remarks :</b><br />
                <textarea name='remarks_smoe' class="form-control"><?php echo @$show_pcms_irn_detail[0]['remarks'] ?></textarea>
                <b>Employer Remarks :</b><br />
                <textarea name='remarks_client' class="form-control"><?= isset($show_pcms_irn[0]['client_remarks']) ? $show_pcms_irn[0]['client_remarks'] : '-' ?></textarea>
              </td>
            </tr>
            <tr>
              <td style="text-align:center; padding-bottom: 4px;  "><b>SIGNATURE FOR INSPECTION EXECUTED</b></td>
            </tr>
          </table>

          <?php if ($show_pcms_irn[0]['project_id'] == 20) { ?>

            <table width="100%" border="1px" style="border-collapse: collapse;">

              <tr>
                <!-- <td style="text-align:center; padding-bottom: 4px; text-align: center;font-weight: bold;">SUPLIER</td> -->
                <td style="text-align:center; padding-bottom: 4px; text-align: center;font-weight: bold; width:25%;">CONTRACTOR</td>
                <td style="text-align:center; padding-bottom: 4px; text-align: center;font-weight: bold; width:25%;">GE</td>
                <?php if ($show_pcms_irn[0]['project_id'] == 19 || $show_pcms_irn[0]['project_id'] == 21) { ?>
                  <td style="text-align:center; padding-bottom: 4px; text-align: center;font-weight: bold; width:25%;">COMPANY</td>
                <?php } ?>
                <?php if ($show_pcms_irn[0]['project_id'] == 17) { ?>
                  <td style="text-align:center; padding-bottom: 4px; text-align: center;font-weight: bold; width:25%;">EMPLOYER</td>
                <?php } ?>
                <td style="text-align:center; padding-bottom: 4px; text-align: center;font-weight: bold; width:25%;">THIRD PARTY</td>
              </tr>


              <tr>
                <td style="padding-bottom: 4px; ">NAME <b><?php if (isset($user[$show_pcms_irn[0]['smoe_approval_by']]['full_name'])) {
                                                            echo $user[$show_pcms_irn[0]['smoe_approval_by']]['full_name'];
                                                          } ?></b></td>
                <td style="padding-bottom: 4px; ">NAME <b><?php if (isset($user[$show_pcms_irn[0]['client_approval_by']]['full_name'])) {
                                                            echo  $user[$show_pcms_irn[0]['client_approval_by']]['full_name'];
                                                          } ?></b></td>
                <td style="padding-bottom: 4px; ">NAME <b><?php if (isset($user[$show_pcms_irn[0]['client_2nd_inspection_by']]['full_name'])) {
                                                            echo  $user[$show_pcms_irn[0]['client_2nd_inspection_by']]['full_name'];
                                                          } ?></b></td>
                <td style="padding-bottom: 4px; ">NAME</td>
              </tr>
              <tr>
                <td style="padding-bottom: 4px; ">SIGNATURE<br />
                  <?php if (isset($user[$show_pcms_irn[0]['smoe_approval_by']]['sign_approval'])) { ?>
                    <center>
                      <img src="data:image/png;base64,<?= $user[$show_pcms_irn[0]['smoe_approval_by']]['sign_approval'] ?>" style="width: 100px !important;">
                    </center>
                  <?php } ?>

                </td>

                <td style="padding-bottom: 4px; ">SIGNATURE<br />
                  <?php if (isset($user[$show_pcms_irn[0]['client_approval_by']]['sign_approval'])) { ?>
                    <center>
                      <img src="data:image/png;base64,<?= $user[$show_pcms_irn[0]['client_approval_by']]['sign_approval'] ?>" style="width: 100px !important;">
                    </center>
                  <?php } ?>
                </td>

                <td style="padding-bottom: 4px; ">SIGNATURE<br />
                  <?php if (isset($user[$show_pcms_irn[0]['client_2nd_inspection_by']]['sign_approval'])) { ?>
                    <center>
                      <img src="data:image/png;base64,<?= $user[$show_pcms_irn[0]['client_2nd_inspection_by']]['sign_approval'] ?>" style="width: 100px !important;">
                    </center>
                  <?php } ?>


                </td>

                <td style="padding-bottom: 4px; ">SIGNATURE<br /><br /><br /><br /><br /><br /><br />
                </td>
              </tr>
              <tr>
                <td style="padding-bottom: 4px; ">Date
                  <?php if (isset($user[$show_pcms_irn[0]['smoe_approval_by']]['sign_approval'])) { ?>
                    <b><?php echo date("Y-m-d", strtotime($show_pcms_irn[0]['smoe_approval_date'])); ?></b>
                  <?php } ?>
                </td>
                <td style="padding-bottom: 4px; ">Date
                  <?php if (isset($user[$show_pcms_irn[0]['client_approval_by']]['sign_approval'])) { ?>
                    <b><?php echo date("Y-m-d", strtotime($show_pcms_irn[0]['client_approval_date'])); ?></b>
                  <?php } ?>
                </td>
                <td style="padding-bottom: 4px; ">Date
                  <?php if (isset($user[$show_pcms_irn[0]['client_2nd_inspection_by']]['sign_approval'])) { ?>
                    <b><?php echo date("Y-m-d", strtotime($show_pcms_irn[0]['client_2nd_inspection_date'])); ?></b>
                  <?php } ?>
                </td>
                <td style="padding-bottom: 4px; ">Date</td>
              </tr>
            </table>


          <?php } else { ?>

            <table width="100%" border="1px" style="border-collapse: collapse;">
              <tr>
                <?php if ($show_pcms_irn[0]['company_id'] == 5) { ?>
                  <td style="text-align:center; padding-bottom: 4px; text-align: center;font-weight: bold; width:25%;">DSAW</td>
                <?php } ?>
                <td style="text-align:center; padding-bottom: 4px; text-align: center;font-weight: bold; width:25%;">CONTRACTOR</td>
                <?php if ($show_pcms_irn[0]['project_id'] == 19 || $show_pcms_irn[0]['project_id'] == 21) { ?>
                  <td style="text-align:center; padding-bottom: 4px; text-align: center;font-weight: bold; width:25%;">COMPANY</td>
                <?php } ?>
                <?php if ($show_pcms_irn[0]['project_id'] == 17) { ?>
                  <td style="text-align:center; padding-bottom: 4px; text-align: center;font-weight: bold; width:25%;">EMPLOYER</td>
                <?php } ?> <td style="text-align:center; padding-bottom: 4px; text-align: center;font-weight: bold; width:25%;">THIRD PARTY</td>
              </tr>
              <tr>
                <?php if ($show_pcms_irn[0]['company_id'] == 5) { ?>
                  <td style="padding-bottom: 4px; ">NAME : <b><?php if (isset($user[$show_pcms_irn[0]['create_by']]['full_name'])) {
                                                                echo $user[$show_pcms_irn[0]['create_by']]['full_name'];
                                                              } ?></b></td>
                <?php } ?>
                <td style="padding-bottom: 4px; ">NAME : <b><?php if (isset($user[$show_pcms_irn[0]['smoe_approval_by']]['full_name'])) {
                                                              echo $user[$show_pcms_irn[0]['smoe_approval_by']]['full_name'];
                                                            } ?></b></td>
                <td style="padding-bottom: 4px; ">NAME : <b><?php if (isset($user[$show_pcms_irn[0]['client_approval_by']]['full_name'])) {
                                                              echo  $user[$show_pcms_irn[0]['client_approval_by']]['full_name'];
                                                            } ?></b></td>
                <td style="padding-bottom: 4px; ">NAME : <b><?php if (isset($user[$show_pcms_irn[0]['third_party_approval_by']]['full_name'])) {
                                                              echo  $user[$show_pcms_irn[0]['third_party_approval_by']]['full_name'];
                                                            } ?></b< /td> </tr> <tr>
                    <?php if ($show_pcms_irn[0]['company_id'] == 5) { ?>
                <td style="padding-bottom: 4px; ">SIGNATURE<br />
                  <?php if (isset($user[$show_pcms_irn[0]['create_by']]['sign_approval'])) { ?>
                    <center>
                      <img src="data:image/png;base64,<?= $user[$show_pcms_irn[0]['create_by']]['sign_approval'] ?>" style="width: 200px !important; height: 150px !important">
                    </center>
                  <?php } ?>
                </td>
              <?php } ?>

              <td style="padding-bottom: 4px; ">SIGNATURE<br />
                <?php if (isset($user[$show_pcms_irn[0]['smoe_approval_by']]['sign_approval'])) { ?>
                  <center>
                    <img src="data:image/png;base64,<?= $user[$show_pcms_irn[0]['smoe_approval_by']]['sign_approval'] ?>" style="width: 200px !important; height: 150px !important">
                  </center>
                <?php } ?>
              </td>

              <td style="padding-bottom: 4px; ">SIGNATURE<br />
                <?php // if(isset($user[$show_pcms_irn[0]['client_approval_by']]['sign_approval'])){ 
                ?>
                <center>
                  <!-- <img src="data:image/png;base64,<?= $user[$show_pcms_irn[0]['client_approval_by']]['sign_approval'] ?>"  style="width: 200px !important; height: 150px !important"> -->
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
                          <img src="<?= base_url('img/orsted_stamp.png') ?>" style="width:35px">
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
                          <img src="data:image/png;base64, <?= $user[$show_pcms_irn[0]['client_approval_by']]['sign_approval'] ?>" style='width: 2cm !important; height: 1.8cm !important; position: absolute !important; margin-left: -80px !important; margin-top: -87px !important;' />
                        <?php } else { ?>
                          <?php if ($this->permission_cookie[70] == 1 && !isset($user[$show_pcms_irn[0]['client_approval_by']]['full_name']) && (($this->user_cookie[7] == 8 || $this->user_cookie[7] == 1) || $this->user_cookie[0] == 1)) { ?>
                            <?php if ($show_pcms_irn[0]['status_inspection'] == 5) { ?>
                              <input type="hidden" name='submission_id' value="<?php echo $show_pcms_irn[0]['submission_id']; ?>">
                              <input type="hidden" name='irn_no' value="<?php echo $show_pcms_irn[0]['report_number']; ?>">
                              <input type="hidden" name='sign_status' value="client">
                              <!-- <br/><br/> -->
                              <center>
                                <button type="submit" class="button button2" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&#10004; Digital Sign</span>
                                </button>
                              </center>
                            <?php } ?>
                            <!-- <br/><br/> -->
                          <?php } ?>
                        <?php } ?>
                      </div>
                    <?php else : ?>
                      <?php if (isset($user[$show_pcms_irn[0]['client_approval_by']]['sign_approval'])) { ?>
                        <img src="data:image/png;base64,<?= $user[$show_pcms_irn[0]['client_approval_by']]['sign_approval'] ?>" style="width: 200px !important; height: 150px !important">
                      <?php } ?>
                    <?php endif; ?>
                  </div>
                </center>
                <?php // } 
                ?>
              </td>

              <td style="padding-bottom: 4px; ">SIGNATURE<br /><br /><br />
                <?php if ($show_pcms_irn[0]['third_party_approval_status'] == 0 && $show_pcms_irn[0]['status_inspection'] == 7) { ?>
                  <div class="row">
                    <div class="col-md-12 text-center">
                      <h6>-- Click the button below --</h6>
                      <button type="button" onclick="sign_third_party(this)" class="btn btn-info"><i class="fas fa-exchange-alt"></i> Sign Document </button>
                    </div>
                  </div>
                <?php } else { ?>
                  <?php if ($user[$show_pcms_irn[0]['third_party_approval_by']]['sign_approval']) : ?>
                    <div class="row">
                      <div class="col-md-12 text-center">
                        <img src="data:image/png;base64,<?= $user[$show_pcms_irn[0]['third_party_approval_by']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' />
                      </div>
                    </div>
                  <?php endif; ?>
                <?php  } ?>
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

                <td style="padding-bottom: 4px; ">Date
                  <?php if (isset($user[$show_pcms_irn[0]['smoe_approval_by']]['sign_approval'])) { ?>
                    <b><?php echo date("Y-m-d", strtotime($show_pcms_irn[0]['smoe_approval_date'])); ?></b>
                  <?php } ?>
                </td>

                <td style="padding-bottom: 4px; ">Date
                  <?php if (isset($user[$show_pcms_irn[0]['client_approval_by']]['sign_approval'])) { ?>
                    <b><?php echo date("Y-m-d", strtotime($show_pcms_irn[0]['client_approval_date'])); ?></b>
                  <?php } ?>
                </td>
                <td style="padding-bottom: 4px; ">Date
                  <?php if (isset($user[$show_pcms_irn[0]['third_party_approval_by']]['sign_approval'])) { ?>
                    <b><?php echo date("Y-m-d", strtotime($show_pcms_irn[0]['third_party_approval_date'])); ?></b>
                  <?php } ?>
                </td>
              </tr>
            </table>

          <?php } ?>


        </div>

        <br />
        <br />

        <div id="example1">

          <form method="POST" action="<?php echo base_url(); ?>irn/irn_process_approval" enctype="multipart/form-data">

            <?php if ($show_pcms_irn[0]['project_id'] == 20) { ?>
              <input type="hidden" name="approval_code_log" value="IRN/GE/<?= $project_data_portal[0]["project_name"] ?>/<?= $show_pcms_irn[0]['report_number'] ?>/">
            <?php } else { ?>
              <input type="hidden" name="approval_code_log" value="IRN/<?= $project_data_portal[0]["project_name"] ?>/<?= $show_pcms_irn[0]['report_number'] ?>/">
            <?php }  ?>

            <table border="1px" style="border-collapse: collapse !important;" width="98%">
              <tr>
                <td rowspan='6' valign="middle" style="padding: 5px;width: 20% !important;vertical-align: middle !important;">
                  <center>
                    <img src="<?php echo $project_name[$show_pcms_irn[0]['project']]['project_logo']; ?>" style="width: 450px;">
                  </center>
                </td>
                <td rowspan='6' valign="middle" style="font-size: 100%;padding: 5px;width: 60% !important;vertical-align: middle !important;font-weight: bold;font-size: 35px;">
                  <center><?php echo strtoupper($project_desc[$show_pcms_irn[0]['project']]) ?><br />INSPECTION RELEASE NOTE </center>
                </td>
                <td style="padding: 5px;vertical-align: middle !important;width: 20% !important;">DOC NO :</td>
              </tr>

              <tr>
                <td style="padding: 5px;vertical-align: middle !important;">
                  <b>
                    <?php if ($show_pcms_irn[0]['project'] == 21) { ?>
                    <b><?= (isset($show_pcms_irn[0]['report_number']) ?
                          ($master_report_number[$show_pcms_irn[0]['project']][$show_pcms_irn[0]['company_id']][$show_pcms_irn[0]['discipline']][$show_pcms_irn[0]['type_of_module']][$show_pcms_irn[0]['deck_elevation']][$show_pcms_irn[0]['irn_type']]['irn_rfi'] . $show_pcms_irn[0]['report_number']) : "Draft-" . $show_pcms_irn[0]['submission_id']) ?></b>
                  <?php  } else {  ?>
                    <b><?= (isset($show_pcms_irn[0]['report_number']) ?
                          ($master_report_number[$show_pcms_irn[0]['project']][$show_pcms_irn[0]['company_id']][$show_pcms_irn[0]['discipline']][$show_pcms_irn[0]['type_of_module']][$show_pcms_irn[0]['irn_type']]["irn_rfi"] . $show_pcms_irn[0]['report_number']) : "Draft-" . $show_pcms_irn[0]['submission_id']) ?></b>
                  <?php  } ?>
                  </b>
                </td>
              </tr>
              <tr>
                <td style="padding: 5px;vertical-align: middle !important;">REV</td>
              </tr>
              <tr>
                <td style="padding: 5px;vertical-align: middle !important;"><b><?= (isset($show_pcms_irn[0]['irn_revision']) ?  $show_pcms_irn[0]['irn_revision'] :  "00") ?></b></td>
              </tr>
              <tr>
                <td style="padding: 5px;vertical-align: middle !important;">PAGE </td>
              </tr>
              <tr>
                <td style="padding: 5px;vertical-align: middle !important;"><b>1 Of 2</b></td>
              </tr>
            </table>

            <br />

            <table border="1px" style="border-collapse: collapse !important;" width="98%">
              <tr>
                <td colspan="2" valign="middle" style="padding: 5px;width: 80% !important;vertical-align: middle !important;">
                  <b>Document Reference No : </b>
                  <!-- <br />• 07555701 (B) - E.80 Fabrication and Construction
                  <br />• 08307791 - Inspection Test Procedure - <?= $discipline_name[$show_pcms_irn[0]['discipline']] ?>
                  <br />• 08308559 - In-process Inspection procedure -->
                  <?= $master_acceptance[$show_pcms_irn[0]['project_id']][$show_pcms_irn[0]['company_id']][$show_pcms_irn[0]['discipline']][$show_pcms_irn[0]['module']][$show_pcms_irn[0]['type_of_module']]['irn']['procedure']; ?>

                </td>
                <td style="padding: 5px;vertical-align: middle !important;width: 20% !important;">
                  <b>DATE :</b>
                  <br /><?php echo date("F d, Y", strtotime($show_pcms_irn_description[0]['rfi_date'])) ?>
                </td>
              </tr>
            </table>

            <table border="1px" style="border-collapse: collapse !important;" width="98%">
              <tr>
                <td colspan="3" valign="middle" style="padding: 5px;width: 100% !important;vertical-align: middle !important;">
                  Location of Origin : <?= @$area_name_arr_v2[$show_pcms_irn[0]['area_v2']] . ", " . @$location_name_arr_v2[$show_pcms_irn[0]['location_v2']]; ?>
                </td>
              </tr>
            </table>

            <table border="1px" style="border-collapse: collapse !important;" width="98%">
              <tr>
                <td colspan="3" valign="middle" style="font-weight:bold;padding: 5px;width: 100% !important;vertical-align: middle !important;">Description :</td>
              </tr>
              <?php foreach ($show_pcms_irn_description as $value) { ?><tr>
                  <td colspan="3" valign="middle" style="padding: 5px;width: 100% !important;vertical-align: middle !important;">
                    <?php echo $value["item_tag_description"];  ?>
                  </td>
                <?php } ?>
                </tr>
            </table>
            <table border="1px" style="border-collapse: collapse !important;" width="98%">
              <tr>
                <td colspan="3" valign="middle" style="padding: 5px;width: 100% !important;vertical-align: middle !important;">
                  <center><b>Item described below requested to be release for next further handling (
                      <span style="<?= $show_pcms_irn[0]['irn_type'] == 1 ? '' : 'text-decoration: line-through;' ?>">Installation</span>/
                      <span style="<?= $show_pcms_irn[0]['irn_type'] == 2 ? '' : 'text-decoration: line-through;' ?>">Blasting & Painting</span>/
                      <span style="<?= $show_pcms_irn[0]['irn_type'] == 3 ? '' : 'text-decoration: line-through;' ?>">Galvanized</span>/
                      <span style="<?= $show_pcms_irn[0]['irn_type'] == 4 ? '' : 'text-decoration: line-through;' ?>">Erection</span>
                      )</b></center>
                </td>
              </tr>
            </table>

            <!-- item for releases -->

            <table border="1px" style="border-collapse: collapse !important;" width="98%">
              <tr>
                <td colspan="8" valign="middle" style="font-weight:bold;padding: 5px;width: 100% !important;vertical-align: middle !important;">Item Number :</td>
              </tr>
              <?php $no_data = 1;
              foreach ($show_pcms_irn_description as $value_pc) { ?>
                <tr>
                  <td valign="middle" style="padding: 5px;width: 1% !important;vertical-align: middle !important;">
                    <?php echo $no_data; ?>
                  </td>
                  <td colspan="2" valign="middle" style="padding: 5px;width: 99% !important;vertical-align: middle !important;">
                    <?php echo $value_pc["item_tag_no"];  ?>
                  </td>
                </tr>
              <?php $no_data++;
              } ?>
            </table>

            <table border="1px" style="border-collapse: collapse !important;" width="98%">
              <tr>
                <td colspan="3" valign="middle" style="padding: 5px;width: 100% !important;vertical-align: middle !important;"><b>Total : <?php echo $no_data - 1; ?> ea </b></td>
              </tr>
            </table>

            <!-- item for releases -->
            <table border="1px" style="border-collapse: collapse !important;" width="98%">
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

                    <?php
                    $index = ($i + ($c * $row)) - 1;
                    ?>
                    <td valign="middle" style="padding: 5px;width: 2% !important;vertical-align: middle !important;text-align: center;">
                      <?php if (isset($master_irn_detail[$index]['id_irn_detail'])) { ?>
                        <input type="hidden" value='<?php echo $master_irn_detail[$index]['id_irn_detail'] ?>' name="id_master_irn_detail[<?php echo $index; ?>]">
                        <input type="hidden" name="id_pcms_irn_detail[<?php echo $index; ?>]" value='<?php echo @$irn_pcms_detail[$master_irn_detail[$index]['id_irn_detail']]['id_pcms_irn_detail']; ?>'>
                      <?php } ?>
                      <?= isset($master_irn_detail[$index]) ? $master_irn_detail[$index]['id_irn_detail'] : '' ?>
                    </td>
                    <td valign="middle" style="padding: 5px;width: 20% !important;vertical-align: middle !important;"><?= isset($master_irn_detail[$index]) ? $master_irn_detail[$index]['inspection_desc'] : '' ?></td>
                    <td valign="middle" style="padding: 5px;width: 15% !important;vertical-align: middle !important;text-align: center;">
                      <?php if (isset($master_irn_detail[$index])) { ?>
                        <span style="display: inline-block !important;width: 70px !important;">
                          <label><input type="radio" name="result[<?php echo $index; ?>]" value='YES' <?php if (@$irn_pcms_detail[$master_irn_detail[$index]['id_irn_detail']]['irn_inspection_result'] == 'YES') {
                                                                                                        echo "checked";
                                                                                                      } ?> <?php if ($this->user_cookie[7] == 8) {
                                                                                                              echo "disable";
                                                                                                            } ?> required>&nbsp;&nbsp;&nbsp;YES</label>
                        </span>
                        <span style="display: inline-block !important;width: 70px !important;">
                          <label><input type="radio" name="result[<?php echo $index; ?>]" value='NO' <?php if (@$irn_pcms_detail[$master_irn_detail[$index]['id_irn_detail']]['irn_inspection_result'] == 'NO') {
                                                                                                        echo "checked";
                                                                                                      } ?> <?php if ($this->user_cookie[7] == 8) {
                                                                                                              echo "disable";
                                                                                                            } ?> required>&nbsp;&nbsp;&nbsp;NO</label>
                        </span>
                        <span style="display: inline-block !important;width: 70px !important;">
                          <label><input type="radio" name="result[<?php echo $index; ?>]" value='N/A' <?php if (@$irn_pcms_detail[$master_irn_detail[$index]['id_irn_detail']]['irn_inspection_result'] == 'N/A') {
                                                                                                        echo "checked";
                                                                                                      } ?> <?php if ($this->user_cookie[7] == 8) {
                                                                                                              echo "disable";
                                                                                                            } ?> required>&nbsp;&nbsp;&nbsp;N/A</label>
                        </span>
                      <?php } else {
                        echo "&nbsp;";
                      } ?>
                    </td>
                  <?php endfor; ?>
                </tr>
              <?php endfor; ?>
            </table>
            <table border="1px" style="border-collapse: collapse !important;" width="98%">
              <tr>
                <td colspan="3" valign="middle" style="padding: 5px;width: 100% !important;vertical-align: middle !important;">
                  <center>Notes on checklist : if any item hasbeen checked / verified / inspected prior to release this release note, the item shall be ticked as “ YES”, and if the item has not been checked/verified/inspected prior to release this release note, the item shall be ticked as “NO”, and if does not relevant on one of them, it should be ticked as ” N/A ”</center>
                </td>
              </tr>
            </table>

            <table border="1px" style="border-collapse: collapse !important;" width="98%">
              <tr>
                <td colspan="3" valign="middle" style="padding: 5px;width: 100% !important;font-size: 20px !important;vertical-align: middle !important;">
                  <center>
                    <b>INSPECTION EXECUTION RESULT</b>
                  </center>
                </td>
              </tr>
              <tr>
                <td colspan="3" valign="middle" style="padding: 5px;width: 100% !important;font-size: 20px !important;vertical-align: middle !important;">
                  <center>
                    <table width="100%">
                      <tr>

                        <?php if ($show_pcms_irn[0]['project_id'] == 20) { ?>
                          <td style="width: 15% !important;">
                            <center><label><input type="radio" name='inspection_result' value="13" <?php if ($show_pcms_irn[0]['status_inspection'] == '13') {
                                                                                                      echo "checked";
                                                                                                    } ?> <?php if ($this->user_cookie[7] == 8) { ?>required<?php } ?>> Accepted</label></center>
                          </td>
                        <?php } else { ?>
                          <td style="width: 15% !important;">
                            <center><label><input type="radio" name='inspection_result' value="7" <?php if ($show_pcms_irn[0]['status_inspection'] == '7') {
                                                                                                    echo "checked";
                                                                                                  } ?> <?php if ($this->user_cookie[7] == 8) { ?>required<?php } ?>> Accepted</label></center>
                          </td>
                        <?php } ?>

                        <td style="width: 30% !important;">
                          <center><label><input type="radio" name='inspection_result' value="9" <?php if ($show_pcms_irn[0]['status_inspection'] == '9') {
                                                                                                  echo "checked";
                                                                                                } ?> <?php if ($this->user_cookie[7] == 8) { ?>required<?php } ?>> Accepted & Released With Comment</label></center>
                        </td>
                        <td style="width: 15% !important;">
                          <center><label><input type="radio" name='inspection_result' value="6" <?php if ($show_pcms_irn[0]['status_inspection'] == '6') {
                                                                                                  echo "checked";
                                                                                                } ?> <?php if ($this->user_cookie[7] == 8) { ?>required<?php } ?>> Rejected</label></center>
                        </td>
                        <td style="width: 20% !important;">
                          <center><label><input type="radio" name='inspection_result' value="10" <?php if ($show_pcms_irn[0]['status_inspection'] == '10') {
                                                                                                    echo "checked";
                                                                                                  } ?> <?php if ($this->user_cookie[7] == 8) { ?>required<?php } ?>> Postpone</label></center>
                        </td>
                        <td style="width: 20% !important;">
                          <center><label><input type="radio" name='inspection_result' value="11" <?php if ($show_pcms_irn[0]['status_inspection'] == '11') {
                                                                                                    echo "checked";
                                                                                                  } ?> <?php if ($this->user_cookie[7] == 8) { ?>required<?php } ?>> Re-Offer</label></center>
                        </td>
                      </tr>
                    </table>
                  </center>
                </td>
              </tr>
            </table>

            <?php if (sizeof($show_pcms_irn_punchlist) > 0) { ?>
              <table border="1px" style="border-collapse: collapse !important;" width="98%">
                <tr>
                  <td style="text-align:left; padding-bottom: 4px; ">
                    <b>Additional Attachment :</b><br />
                    <?php
                    foreach ($show_pcms_irn_punchlist as $key => $value) {
                      $enc_redline = strtr($this->encryption->encrypt($value['pnc_attachment']), '+=/', '.-~');
                      $enc_path    = strtr($this->encryption->encrypt('/PCMS/pcms_v2/irn_punchlist'), '+=/', '.-~');
                      echo "* <a target='_blank' href='" . site_url('irn/open_file_irn/' . $enc_redline . '/' . $enc_path . "/download/" . encrypt($value['pnc_desc'])) . "'>" . $value['pnc_desc'] . "</a> ";
                    } ?>
                  </td>
                </tr>
              </table>
            <?php } ?>
            <?php // test_var($show_pcms_irn_detail) 
            ?>
            <table border="1px" style="border-collapse: collapse !important;" width="98%">
              <tr>
                <td style="text-align:left; padding-bottom: 4px; ">
                  <b>Contractor Remarks :</b><br />
                  <textarea name='remarks_smoe' class="form-control"><?php echo @$show_pcms_irn_detail[0]['remarks'] ?></textarea>
                  <b>Employer Remarks :</b><br />
                  <textarea name='remarks_client' class="form-control"><?= isset($show_pcms_irn[0]['client_remarks']) ? $show_pcms_irn[0]['client_remarks'] : '-' ?></textarea>
                </td>
              </tr>
            </table>

            <?php if ($show_pcms_irn[0]['project_id'] == 20) { ?>

              <table width="98%" border="1px" style="border-collapse: collapse;">

                <tr>
                  <!-- <td style="text-align:center; padding-bottom: 4px; text-align: center;font-weight: bold;">SUPLIER</td> -->
                  <td style="text-align:center; padding-bottom: 4px; text-align: center;font-weight: bold; width:25%;">CONTRACTOR</td>
                  <td style="text-align:center; padding-bottom: 4px; text-align: center;font-weight: bold; width:25%;">GE</td>
                  <?php if ($show_pcms_irn[0]['project_id'] == 19 || $show_pcms_irn[0]['project_id'] == 21) { ?>
                    <td style="text-align:center; padding-bottom: 4px; text-align: center;font-weight: bold; width:25%;">COMPANY</td>
                  <?php } ?>
                  <?php if ($show_pcms_irn[0]['project_id'] == 17) { ?>
                    <td style="text-align:center; padding-bottom: 4px; text-align: center;font-weight: bold; width:25%;">EMPLOYER</td>
                  <?php } ?> <td style="text-align:center; padding-bottom: 4px; text-align: center;font-weight: bold; width:25%;">THIRD PARTY</td>
                </tr>


                <tr>
                  <td style="padding-bottom: 4px; ">NAME <b><?php if (isset($user[$show_pcms_irn[0]['smoe_approval_by']]['full_name'])) {
                                                              echo $user[$show_pcms_irn[0]['smoe_approval_by']]['full_name'];
                                                            } ?></b></td>
                  <td style="padding-bottom: 4px; ">NAME <b><?php if (isset($user[$show_pcms_irn[0]['client_approval_by']]['full_name'])) {
                                                              echo  $user[$show_pcms_irn[0]['client_approval_by']]['full_name'];
                                                            } ?></b></td>
                  <td style="padding-bottom: 4px; ">NAME <b><?php if (isset($user[$show_pcms_irn[0]['client_2nd_inspection_by']]['full_name'])) {
                                                              echo  $user[$show_pcms_irn[0]['client_2nd_inspection_by']]['full_name'];
                                                            } ?></b></td>
                  <td style="padding-bottom: 4px; ">NAME</td>
                </tr>
                <tr>
                  <td style="padding-bottom: 4px; ">SIGNATURE<br />
                    <?php if (isset($user[$show_pcms_irn[0]['smoe_approval_by']]['sign_approval'])) { ?>

                      <center>
                        <img src="data:image/png;base64,<?= $user[$show_pcms_irn[0]['smoe_approval_by']]['sign_approval'] ?>" style="width: 100px !important;">
                      </center>

                    <?php } else { ?>

                      <?php if ($this->permission_cookie[70] == 1 && $show_pcms_irn[0]['status_inspection'] == 1) { ?>
                        <input type="hidden" name='submission_id' value="<?php echo $show_pcms_irn[0]['submission_id']; ?>">
                        <input type="hidden" name='irn_no' value="<?php echo $show_pcms_irn[0]['report_number']; ?>">
                        <input type="hidden" name='sign_status' value="smoe">
                        <br /><br />
                        <center>
                          <button type="submit" class="button button2" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&#10004; Digital Sign</span>
                          </button>
                        </center>
                      <?php } ?>
                      <br /><br />

                    <?php } ?>
                  </td>

                  <td style="padding-bottom: 4px; ">SIGNATURE<br />
                    <?php if (isset($user[$show_pcms_irn[0]['client_approval_by']]['sign_approval'])) { ?>

                      <center>
                        <img src="data:image/png;base64,<?= $user[$show_pcms_irn[0]['client_approval_by']]['sign_approval'] ?>" style="width: 100px !important;">
                      </center>

                    <?php } else { ?>

                      <?php if (!isset($user[$show_pcms_irn[0]['client_approval_by']]['full_name']) and ($this->user_cookie[7] == 8 or $this->permission_cookie[0] == 1)) { ?>
                        <?php if ($this->permission_cookie[70] == 1 && $show_pcms_irn[0]['status_inspection'] == 5) { ?>
                          <input type="hidden" name='submission_id' value="<?php echo $show_pcms_irn[0]['submission_id']; ?>">
                          <input type="hidden" name='irn_no' value="<?php echo $show_pcms_irn[0]['report_number']; ?>">
                          <input type="hidden" name='sign_status' value="client">
                          <br /><br />
                          <center>
                            <button type="submit" class="button button2" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&#10004; Digital Sign</span>
                            </button>
                          </center>
                        <?php } ?>
                        <br /><br />
                      <?php } ?>
                    <?php } ?>
                  </td>

                  <td style="padding-bottom: 4px; ">SIGNATURE<br />
                    <?php if (isset($user[$show_pcms_irn[0]['client_2nd_inspection_by']]['sign_approval'])) { ?>

                      <center>
                        <img src="data:image/png;base64,<?= $user[$show_pcms_irn[0]['client_2nd_inspection_by']]['sign_approval'] ?>" style="width: 100px !important;">
                      </center>

                    <?php } else { ?>

                      <?php if (!isset($user[$show_pcms_irn[0]['client_2nd_inspection_by']]['full_name']) and ($this->user_cookie[7] == 8 or $this->permission_cookie[0] == 1)) { ?>
                        <?php if ($this->permission_cookie[70] == 1 && $show_pcms_irn[0]['status_inspection'] == 7) { ?>
                          <input type="hidden" name='submission_id' value="<?php echo $show_pcms_irn[0]['submission_id']; ?>">
                          <input type="hidden" name='irn_no' value="<?php echo $show_pcms_irn[0]['report_number']; ?>">
                          <input type="hidden" name='sign_status' value="review_client">
                          <br /><br />
                          <center>
                            <button type="submit" class="button button2" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&#10004; Digital Sign</span>
                            </button>
                          </center>
                        <?php } ?>
                        <br /><br />
                      <?php } ?>
                    <?php } ?>
                  </td>

                  <td style="padding-bottom: 4px; ">SIGNATURE<br /><br /><br /><br /><br />
                  </td>
                </tr>
                <tr>
                  <td style="padding-bottom: 4px; ">Date
                    <?php if (isset($user[$show_pcms_irn[0]['smoe_approval_by']]['sign_approval'])) { ?>
                      <b><?php echo date("Y-m-d", strtotime($show_pcms_irn[0]['smoe_approval_date'])); ?></b>
                    <?php } ?>
                  </td>
                  <td style="padding-bottom: 4px; ">Date
                    <?php if (isset($user[$show_pcms_irn[0]['client_approval_by']]['sign_approval'])) { ?>
                      <b><?php echo date("Y-m-d", strtotime($show_pcms_irn[0]['client_approval_date'])); ?></b>
                    <?php } ?>
                  </td>
                  <td style="padding-bottom: 4px; ">Date
                    <?php if (isset($user[$show_pcms_irn[0]['client_2nd_inspection_by']]['sign_approval'])) { ?>
                      <b><?php echo date("Y-m-d", strtotime($show_pcms_irn[0]['client_2nd_inspection_date'])); ?></b>
                    <?php } ?>
                  </td>
                  <td style="padding-bottom: 4px; ">Date</td>
                </tr>
              </table>

            <?php } else { ?>

              <table width="98%" border="1px" style="border-collapse: collapse;">

                <tr>
                  <!-- <td style="text-align:center; padding-bottom: 4px; text-align: center;font-weight: bold;">SUPLIER</td> -->
                  <?php if ($show_pcms_irn[0]['company_id'] == 5) { ?>
                    <td style="text-align:center; padding-bottom: 4px; text-align: center;font-weight: bold; width:25%;">DSAW</td>
                  <?php } ?>
                  <td style="text-align:center; padding-bottom: 4px; text-align: center;font-weight: bold; width:25%;">CONTRACTOR</td>
                  <?php if ($show_pcms_irn[0]['project_id'] == 19 || $show_pcms_irn[0]['project_id'] == 21) { ?>
                    <td style="text-align:center; padding-bottom: 4px; text-align: center;font-weight: bold; width:25%;">COMPANY</td>
                  <?php } ?>
                  <?php if ($show_pcms_irn[0]['project_id'] == 17) { ?>
                    <td style="text-align:center; padding-bottom: 4px; text-align: center;font-weight: bold; width:25%;">EMPLOYER</td>
                  <?php } ?> <td style="text-align:center; padding-bottom: 4px; text-align: center;font-weight: bold; width:25%;">THIRD PARTY</td>
                </tr>


                <tr>
                  <?php if ($show_pcms_irn[0]['company_id'] == 5) { ?>
                    <td style="padding-bottom: 4px; ">NAME : <b><?php if (isset($user[$show_pcms_irn[0]['create_by']]['full_name'])) {
                                                                  echo $user[$show_pcms_irn[0]['create_by']]['full_name'];
                                                                } ?></b></td>
                  <?php } ?>
                  <td style="padding-bottom: 4px; ">NAME <b><?php if (isset($user[$show_pcms_irn[0]['smoe_approval_by']]['full_name'])) {
                                                              echo $user[$show_pcms_irn[0]['smoe_approval_by']]['full_name'];
                                                            } ?></b></td>
                  <td style="padding-bottom: 4px; ">NAME <b><?php if (isset($user[$show_pcms_irn[0]['client_approval_by']]['full_name'])) {
                                                              echo  $user[$show_pcms_irn[0]['client_approval_by']]['full_name'];
                                                            } ?></b></td>
                  <td style="padding-bottom: 4px; ">NAME <b><?php if (isset($user[$show_pcms_irn[0]['third_party_approval_by']]['full_name'])) {
                                                              echo  $user[$show_pcms_irn[0]['third_party_approval_by']]['full_name'];
                                                            } ?></b< /td> </tr> <tr>
                      <?php if ($show_pcms_irn[0]['company_id'] == 5) { ?>
                  <td style="padding-bottom: 4px; ">SIGNATURE<br />
                    <?php if (isset($user[$show_pcms_irn[0]['create_by']]['sign_approval'])) { ?>
                      <center>
                        <img src="data:image/png;base64,<?= $user[$show_pcms_irn[0]['create_by']]['sign_approval'] ?>" style="width: 200px !important; height: 150px !important">
                      </center>
                    <?php } ?>
                  </td>
                <?php } ?>

                <td style="padding-bottom: 4px; ">SIGNATURE<br />
                  <?php if (isset($user[$show_pcms_irn[0]['smoe_approval_by']]['sign_approval'])) { ?>

                    <center>
                      <img src="data:image/png;base64,<?= $user[$show_pcms_irn[0]['smoe_approval_by']]['sign_approval'] ?>" style="width: 200px !important; height: 150px !important">
                    </center>

                  <?php } else { ?>

                    <?php if ($this->permission_cookie[70] == 1 && $show_pcms_irn[0]['status_inspection'] == 1) { ?>
                      <input type="hidden" name='submission_id' value="<?php echo $show_pcms_irn[0]['submission_id']; ?>">
                      <input type="hidden" name='irn_no' value="<?php echo $show_pcms_irn[0]['report_number']; ?>">
                      <input type="hidden" name='sign_status' value="smoe">
                      <br /><br />
                      <center>
                        <button type="submit" class="button button2" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&#10004; Digital Sign</span>
                        </button>
                      </center>
                    <?php } ?>
                    <br /><br />

                  <?php } ?>
                </td>

                <td style="padding-bottom: 4px; ">SIGNATURE<br />
                  <?php // if(isset($user[$show_pcms_irn[0]['client_approval_by']]['sign_approval'])){ 
                  ?>
                  <center>
                    <!-- <img src="data:image/png;base64,<?= $user[$show_pcms_irn[0]['client_approval_by']]['sign_approval'] ?>"  style="width: 200px !important; height: 150px !important"> -->
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
                            <img src="<?= base_url('img/orsted_stamp.png') ?>" style="width:35px">
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
                            <img src="data:image/png;base64, <?= $user[$show_pcms_irn[0]['client_approval_by']]['sign_approval'] ?>" style='width: 2cm !important; height: 1.8cm !important; position: absolute !important; margin-left: -80px !important; margin-top: -87px !important;' />
                          <?php } else { ?>
                            <?php if ($this->permission_cookie[70] == 1 && !isset($user[$show_pcms_irn[0]['client_approval_by']]['full_name']) && (($this->user_cookie[7] == 8 || $this->user_cookie[7] == 1) || $this->user_cookie[0] == 1)) { ?>
                              <?php if ($show_pcms_irn[0]['status_inspection'] == 5) { ?>
                                <input type="hidden" name='submission_id' value="<?php echo $show_pcms_irn[0]['submission_id']; ?>">
                                <input type="hidden" name='irn_no' value="<?php echo $show_pcms_irn[0]['report_number']; ?>">
                                <input type="hidden" name='sign_status' value="client">
                                <!-- <br/><br/> -->
                                <center>
                                  <button type="submit" class="button button2" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&#10004; Digital Sign</span>
                                  </button>
                                </center>
                              <?php } ?>
                              <!-- <br/><br/> -->
                            <?php } ?>
                          <?php } ?>
                        </div>
                      <?php else : ?>
                        <?php if (isset($user[$show_pcms_irn[0]['client_approval_by']]['sign_approval'])) { ?>
                          <img src="data:image/png;base64,<?= $user[$show_pcms_irn[0]['client_approval_by']]['sign_approval'] ?>" style="width: 200px !important; height: 150px !important">
                        <?php } ?>
                      <?php endif; ?>
                    </div>
                  </center>
                  <?php // } 
                  ?>
                </td>

                <td style="padding-bottom: 4px; ">SIGNATURE<br /><br /><br />

                  <?php if ($show_pcms_irn[0]['third_party_approval_status'] == 0 && $show_pcms_irn[0]['status_inspection'] == 7) { ?>
                    <div class="row">
                      <div class="col-md-12 text-center">
                        <h6>-- Click the button below --</h6>
                        <button type="button" onclick="sign_third_party(this)" class="btn btn-info"><i class="fas fa-exchange-alt"></i> Sign Document </button>
                      </div>
                    </div>
                  <?php } else { ?>
                    <?php if ($user[$show_pcms_irn[0]['third_party_approval_by']]['sign_approval']) : ?>
                      <div class="row">
                        <div class="col-md-12 text-center">
                          <img src="data:image/png;base64,<?= $user[$show_pcms_irn[0]['third_party_approval_by']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' />
                        </div>
                      </div>
                    <?php endif; ?>
                  <?php  } ?>
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

                  <td style="padding-bottom: 4px; ">Date
                    <?php if (isset($user[$show_pcms_irn[0]['smoe_approval_by']]['sign_approval'])) { ?>
                      <b><?php echo date("Y-m-d", strtotime($show_pcms_irn[0]['smoe_approval_date'])); ?></b>
                    <?php } ?>
                  </td>
                  <td style="padding-bottom: 4px; ">Date
                    <?php if (isset($user[$show_pcms_irn[0]['client_approval_by']]['sign_approval'])) { ?>
                      <b><?php echo date("Y-m-d", strtotime($show_pcms_irn[0]['client_approval_date'])); ?></b>
                    <?php } ?>
                  </td>
                  <td style="padding-bottom: 4px; ">Date
                    <?php if (isset($user[$show_pcms_irn[0]['third_party_approval_by']]['sign_approval'])) { ?>
                      <b><?php echo date("Y-m-d", strtotime($show_pcms_irn[0]['third_party_approval_date'])); ?></b>
                    <?php } ?>
                  </td>
                </tr>
              </table>

            <?php } ?>


            <?php if (isset($user[$show_pcms_irn[0]['smoe_approval_by']]['full_name']) and $this->user_cookie[7] != 8 and $this->permission_cookie[129] == 1 and 1 == 2) { ?>
              <br />
              <?php if (isset($irn_pcms_detail[1]['update_by'])) { ?>
                <b><i>Latest Update By : <?php echo $user[$irn_pcms_detail[1]['update_by']]['full_name']; ?> - on : <?php echo $irn_pcms_detail[1]['update_by_date']; ?></i></b>
              <?php } ?>
              <br />
              <br />
              <input type="hidden" name='submission_id' value="<?php echo $show_pcms_irn[0]['submission_id']; ?>">
              <input type="hidden" name='irn_no' value="<?php echo $show_pcms_irn[0]['report_number']; ?>">
              <input type="hidden" name='process_status' value="update">
              <button type="submit" class="button button3" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&#10004; Update Data</span>
              </button>
              <br />
              <br />
            <?php } ?>

          </form>

        </div>

        <br />
        <br />

        <div id="example2">

          <table border="1px" style="border-collapse: collapse !important;" width="98%">
            <tr>
              <td rowspan='3' valign="middle" style="padding: 5px;width: 70% !important;vertical-align: middle !important;">
                <center>
                  <img src="<?php echo $project_name[$show_pcms_irn[0]['project']]['project_logo']; ?>" style="width: 450px;">
                </center>
              </td>
              <td style="padding: 5px;vertical-align: middle !important;width: 10% !important;">DOC NO</td>
              <td style="padding: 5px;vertical-align: middle !important;width: 2% !important;">:</td>
              <td style="padding: 5px;vertical-align: middle !important;"><b><?php if ($show_pcms_irn[0]['project'] == 21) { ?>
                  <b><?= (isset($show_pcms_irn[0]['report_number']) ?
                        ($master_report_number[$show_pcms_irn[0]['project']][$show_pcms_irn[0]['company_id']][$show_pcms_irn[0]['discipline']][$show_pcms_irn[0]['type_of_module']][$show_pcms_irn[0]['deck_elevation']][$show_pcms_irn[0]['irn_type']]['irn_rfi'] . $show_pcms_irn[0]['report_number']) : "Draft-" . $show_pcms_irn[0]['submission_id']) ?></b>
                <?php  } else {  ?>
                  <b><?= (isset($show_pcms_irn[0]['report_number']) ?
                        ($master_report_number[$show_pcms_irn[0]['project']][$show_pcms_irn[0]['company_id']][$show_pcms_irn[0]['discipline']][$show_pcms_irn[0]['type_of_module']][$show_pcms_irn[0]['irn_type']]["irn_rfi"] . $show_pcms_irn[0]['report_number']) : "Draft-" . $show_pcms_irn[0]['submission_id']) ?></b>
                <?php  } ?></b></td>
            </tr>
            <tr>
              <td style="padding: 5px;vertical-align: middle !important;width: 10% !important;">Date</td>
              <td style="padding: 5px;vertical-align: middle !important;width: 2% !important;">:</td>
              <td style="padding: 5px;vertical-align: middle !important;"><b><?php echo date("F d, Y", strtotime($show_pcms_irn_description[0]['rfi_date'])) ?></b></td>
            </tr>
            <tr>
              <td style="padding: 5px;vertical-align: middle !important;width: 10% !important;">Rev</td>
              <td style="padding: 5px;vertical-align: middle !important;width: 2% !important;">:</td>
              <td style="padding: 5px;vertical-align: middle !important;"><b><?= (isset($show_pcms_irn[0]['irn_revision']) ?  $show_pcms_irn[0]['irn_revision'] :  "00") ?></b></td>
            </tr>
            <tr>
              <td rowspan='3' valign="middle" style="padding: 5px;width: 70% !important;vertical-align: middle !important;">
                <center>
                  <h2>INSPECTION RELEASE NOTE</h2>
                </center>
              </td>
              <td style="padding: 5px;vertical-align: middle !important;width: 10% !important;">Page No</td>
              <td style="padding: 5px;vertical-align: middle !important;width: 2% !important;">:</td>
              <td style="padding: 5px;vertical-align: middle !important;"><b>2 Of 2</b></td>
            </tr>
          </table>

          <br />

          <table border="1px" style="border-collapse: collapse !important;text-align:center;" width="98%">
            <thead>
              <tr>
                <th rowspan='2'>Drawing<br />Number</th>
                <th rowspan='2'>Tag<br />Number</th>
                <th rowspan='2'>Weld Map<br />Drawing No.</th>
                <th rowspan='2'>Item /<br />Joint No</th>
                <th colspan='8' style='text-align:center;'>Material Traceability</th>
                <th rowspan='2' style='text-align:center;'>MRIR Attachment</th>
              </tr>
              <tr>
                <th>Piecemark<br />No.</th>
                <th>Unique<br />No.</th>
                <th>Profile</th>
                <th>Size / Dia</th>
                <th>Length</th>
                <th>Area<br />m2</th>
                <th>THK</th>
                <th>Material<br />Status</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($show_data_irn_list as $key => $value) { ?>

                <?php

                if (isset($value['drawing_as']) && !empty($value['drawing_as'])) {
                  $weldmap_material = substr($value['drawing_as'], -13);
                } else {
                  $weldmap_material = substr($value['drawing_ga'], -20);
                }

                if (isset($warehouse_mis_mrir[$status_piecemark[$value['part_id']]['id_mis']]['unique_ident_no'])) {
                  $uniq_no_p1 = $warehouse_mis_mrir[$status_piecemark[$value['part_id']]['id_mis']]['unique_ident_no'];
                } else {
                  $uniq_no_p1 = "-";
                }

                $certificate_name     = '';
                $certificate_link     = '';

                if ($uniq_no_p1 != "-") {
                  if (isset($list_unique_data[$uniq_no_p1])) {

                    $unique_ident_no    = $list_unique_data[$uniq_no_p1][0];
                    $certificate_exist  = false;

                    if ($unique_ident_no['category'] == "CS") {
                      $certificate_name   = $unique_ident_no['mill_cert_no'];
                      $receiving_id       = $rec_detail_cs[$unique_ident_no['receiving_detail_id']]['receiving_id'];

                      if (isset($certificate_attachment_cs[$receiving_id][$certificate_name])) {
                        $certificate_name = $certificate_attachment_cs[$receiving_id][$certificate_name];
                        $certificate_exist  = true;
                      }
                    }

                    if ($unique_ident_no['category'] == "SS") {
                      $certificate_name   = $unique_ident_no['mill_cert_no'];
                      $receiving_id       = $rec_detail_ss[$unique_ident_no['receiving_detail_id']]['receiving_id'];

                      if (isset($certificate_attachment_ss[$receiving_id][$certificate_name])) {
                        $certificate_name = $certificate_attachment_ss[$receiving_id][$certificate_name];
                        $certificate_exist  = true;
                      }
                    }

                    if ($certificate_exist) {
                      $encrypt_certif       = strtr($this->encryption->encrypt($certificate_name), '+=/', '.-~');
                      $encrypt_remote_loc   = strtr($this->encryption->encrypt('/PCMS/warehouse/receiving'), '+=/', '.-~');
                      $download_certif      = site_url('irn/open_file/' . $encrypt_certif . '/' . $encrypt_remote_loc . '/download');

                      $certificate_link     = '<a target="_blank" href="' . $download_certif . '">' . $unique_ident_no['mill_cert_no'] . '</a>';
                    } else {
                      $certificate_link     = $unique_ident_no['mill_cert_no'];
                    }

                    $list_of_attachment = array();
                    foreach ($list_unique_data[$uniq_no_p1] as $k => $vx) {


                      $encrypt_filename     = strtr($this->encryption->encrypt($vx["document_file"]), '+=/', '.-~');
                      $encrypt_remote_loc   = strtr($this->encryption->encrypt('/PCMS/warehouse/mrir'), '+=/', '.-~');
                      $download_attach      = site_url('irn/open_file/' . $encrypt_filename . '/' . $encrypt_remote_loc . '/download');


                      $list_of_attachment[] = "<a target='_blank' href='" . $download_attach . "'  style='display: inline-block !important;'>" . $vx["document_name"] . "</a>";
                    }
                    $show_attachment = implode("<br/><br/>", $list_of_attachment);
                  } else {
                    $show_attachment = "-";
                  }
                } else {
                  $show_attachment = "-";
                }

                if (isset($status_piecemark[$value['part_id']]['profile'])) {
                  $profile_p1 = $status_piecemark[$value['part_id']]['profile'];
                } else {
                  $profile_p1 = "-";
                }

                if (isset($status_piecemark[$value['part_id']]['diameter'])) {
                  $diameter_p1 = $status_piecemark[$value['part_id']]['diameter'];
                } else {
                  $diameter_p1 = "-";
                }

                if (isset($status_piecemark[$value['part_id']]['length'])) {
                  $length_p1 = $status_piecemark[$value['part_id']]['length'];
                } else {
                  $length_p1 = "-";
                }

                if (isset($status_piecemark[$value['part_id']]['area'])) {
                  $area_p1 = $status_piecemark[$value['part_id']]['area'];
                } else {
                  $area_p1 = "-";
                }

                if (isset($status_piecemark[$value['part_id']]['can_number'])) {
                  $can_number = $status_piecemark[$value['part_id']]['can_number'];
                } else {
                  $can_number = "-";
                }

                if (isset($status_piecemark[$value['part_id']]['thickness'])) {
                  $thickness_p1 = $status_piecemark[$value['part_id']]['thickness'];
                } else {
                  $thickness_p1 = "-";
                }

                $project_id               = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['project_code']), '+=/', '.-~');
                $discipline               = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['discipline']), '+=/', '.-~');
                $type_of_module           = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['type_of_module']), '+=/', '.-~');
                $module                   = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['module']), '+=/', '.-~');
                $report_no                = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['report_number']), '+=/', '.-~');
                $report_no_rev            = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['report_no_rev']), '+=/', '.-~');
                $submission_id            = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['submission_id']), '+=/', '.-~');

                if ($show_pcms_irn[0]['is_itr'] == 1) {

                  if (isset($status_piecemark[$value['part_id']]['status_inspection'])) {
                    if ($status_piecemark[$value['part_id']]['status_inspection'] >= 3) {
                      if (isset($status_piecemark[$value['part_id']]['report_number'])) {
                        $status_inspection_p1 = '<a target="_blank" href="' . base_url() . 'itr/itr_pdf/report/' . $report_no . '/' . $report_no_rev . '/' . $project_id . '/' . $discipline . '/' . $type_of_module . '/' . $module . '">COMPLETED</a>';
                      } else {
                        $status_inspection_p1 = '<a target="_blank" href="' . base_url() . 'itr_pdf/submission/' . $submission_id . '">COMPLETED</a>';
                      }
                    } else {
                      $status_inspection_p1 = '<a target="_blank" href="' . base_url() . 'itr_pdf/submission/' . $submission_id . '">COMPLETED</a>';
                    }
                  } else {
                    $status_inspection_p1 = "-";
                  }
                } else {

                  if (isset($status_piecemark[$value['part_id']]['status_inspection'])) {
                    if ($status_piecemark[$value['part_id']]['status_inspection'] >= 3) {
                      if (isset($status_piecemark[$value['part_id']]['report_number'])) {
                        $status_inspection_p1 = '<a target="_blank" href="' . base_url() . 'material_verification/material_verification_pdf_client/' . $project_id . '/' . $discipline . '/' . $type_of_module . '/' . $module . '/' . $report_no . '/' . $report_no_rev . '">COMPLETED</a>';
                      } else {
                        $status_inspection_p1 = '<a target="_blank" href="' . base_url() . 'material_verification/material_verification_pdf/' . $submission_id . '">COMPLETED</a>';
                      }
                    } else {
                      $status_inspection_p1 = '<a target="_blank" href="' . base_url() . 'material_verification/material_verification_pdf/' . $submission_id . '">COMPLETED</a>';
                    }
                  } else {
                    $status_inspection_p1 = "-";
                  }
                }

                $status_fitup = "-";
                $status_visual = "-";
                $status_MT_show = "-";
                $status_PT_show = "-";
                $status_UT_show = "-";
                $status_RT_show = "-";
                ?>
                <tr>
                  <td><?= $value['drawing_ga'] ?></td>
                  <td><?= $can_number ?></td>
                  <td><?= $value['drawing_as'] ?></td>
                  <td><?= $weldmap_material ?></td>
                  <td><?= $value['part_id'] ?></td>
                  <td><?= $uniq_no_p1 ?> </td>
                  <td><?= $profile_p1 ?> </td>
                  <td><?= $diameter_p1 ?> </td>
                  <td><?= $length_p1 ?> </td>
                  <td><?= $area_p1 ?> </td>
                  <td><?= $thickness_p1 ?> </td>
                  <td><?= $status_inspection_p1 ?> </td>
                  <td>
                    <?= $certificate_link ?>
                    <br>
                    <br>
                    <?= $show_attachment ?>
                  </td>

                </tr>
              <?php } ?>
            </tbody>
          </table>

          <br />
          <br />

        </div>



      </center>
      <br />
      <br />


      <span style='text-align:left !important;'>
        <a href='<?= base_url(); ?>irn/show_irn_detail_material/<?= strtr($this->encryption->encrypt($show_pcms_irn[0]["submission_id"]), '+=/', '.-~'); ?>'><span class='btn btn-danger'><i class="fas fa-file-pdf"></i> Export PDF</span></a>
      </span>

    </div>
  </div>
</div>
</div>

<script>
  function sign_third_party(btn) {
    Swal.fire({
      type: "warning",
      title: "A Sign Document",
      text: "Are you sure to sign this document ?",
      showCancelButton: true
    }).then((res) => {

      if (res.value) {
        Swal.fire({
          title: 'Processing...',
          allowOutsideClick: false,
          onBeforeOpen: () => {
            Swal.showLoading()
          },
        })

        $.ajax({
          url: "<?= site_url('irn/proccess_sign_third_party') ?>",
          type: "POST",
          data: {
            // subs: "<?= $show_pcms_irn[0]['submission_id'] ?>",
            subs: "<?= encrypt($show_pcms_irn[0]['submission_id']) ?>",
            // method: "ut"
          },
          dataType: "JSON",
          success: (data) => {
            if (data.success) {
              Swal.fire({
                type: "success",
                title: "Successfully sign This Document !!",
                timer: 1000
              })

              setTimeout(() => {
                location.reload()
              }, 1000);
            }
          },
          error: (data) => {
            Swal.fire({
              type: "error",
              title: "Something Went Wrong !!",
              timer: 1000
            })
          }
        })
      }
    })
  }
</script>