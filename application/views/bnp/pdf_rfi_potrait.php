<!DOCTYPE html>
<html>
<head>
  <title>RFI - INSPECTION NOTIFICATION</title>
  <?php 
    error_reporting(0);
    $inspection_month   = DATE('m' ,strtotime($main[0]['inspection_date']));
    $inspection_month_to= DATE('m' ,strtotime($main[0]['inspection_date_to']));

    $inspection_date    = DATE('d' ,strtotime($main[0]['inspection_date']));
    $inspection_date_to = DATE('d' ,strtotime($main[0]['inspection_date_to']));

    $inspection_date_arr = array();

    $start = new DateTime (DATE('Y-m-d' ,strtotime($main[0]['inspection_date']))); 
    $end = new DateTime (DATE('Y-m-d' ,strtotime($main[0]['inspection_date_to']))); 

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
    $date_arr[] = DATE('d' ,strtotime($main[0]['inspection_date_to']));

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
    // test_var($inspection_date_arr);

  ?>
  <style type="text/css"> 
    .bg-selected {
    background-color: #949494;
    }

    #opta {
      
    }
    .d-none {
      display: none;
    }
    body {
      font-family: "helvetica";
      font-size: 50% !important;
    }

    .titleHead {
        border:1px #000 solid;
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
        border:1px #000 solid;
        font-weight: bold;
        max-width: 150px;
        word-wrap: break-word;
    }

    table>thead>tr>td,table>tbody>tr>td{
        vertical-align: top;
    }

    .br_break{
        line-height: 15px;
    }

    .br_break_no_bold{
        line-height: 18px;
    }

    .br{
        border-right: 1px #000 solid !important;
    }
    .bl{
        border-left: 1px #000 solid;
    }
    .bt{
        border-top: 1px #000 solid;
    }
    .bb{
        border-bottom:  1px #000 solid;
    }
    .bx{
        border-left: 1px #000 solid;
        border-right: 1px #000 solid;
    }

    .by{
        border-top: 1px #000 solid;
        border-bottom: 1px #000 solid;
    }

    .ball{
        border-top: 1px #000 solid;
        border-bottom: 1px #000 solid;
        border-left: 1px #000 solid;
        border-right: 1px #000 solid;
    }
    .tab{
        display: inline-block; 
        width: 130px;
    }
    .tab2{
        display: inline-block; 
        width: 130px;
    }
    .text-nowrap{
        white-space: nowrap;
    }
    .valign-middle{
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
        margin:0;
        vertical-align: bottom;
        position: relative;
        top: -1px;
        *overflow: hidden;
    }

    input[type=checkbox]
    {
        /* Double-sized Checkboxes */
        -ms-transform: scale(0.8); /* IE */
        -moz-transform: scale(0.8); /* FF */
        -webkit-transform: scale(0.8); /* Safari and Chrome */
        -o-transform: scale(0.8); /* Opera */
        transform: scale(0.8);
        /*padding: 1px;*/
    }

    /* Might want to wrap a span around your checkbox text */
    .checkboxtext
    {
        /* Checkbox text */ 
        display: inline;
    }

    textarea {
        width: 95%;
        height: 250px !important;
    }

    .button {
        background-color: #4CAF50; /* Green */
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

    .page_break { page-break-before: always; } 

   
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

    /*header {
      position: fixed;
      left: 0cm;
      right: 0cm;
      height: 5cm;
    } */

    body {
      top: 0cm;
      left: 0cm;
      right: 0cm;
      /*margin-top: 7.4cm;*/
      /*margin-bottom: 6.8cm;*/
      font-family: "helvetica";
      font-size: 50% !important;
    }

    header {
      /*position: fixed;*/
      left: 0cm;
      right: 0cm;
      height: 5cm;
      /*padding-top: 15px;*/
      /*margin-top: 0.5cm;*/
    }

    footer {
      /*position: fixed;*/
      top:20cm;
      left: 0cm;
      right: 0cm;
      height: 5cm;
      padding-top: 15px;
    }
  </style>

</head>
<body>
  
  <center>
    <!-- <header> -->
      <table  border="1px" style="border-collapse: collapse !important;;" width="100%">
        <tr>       
          <td colspan="2" style="text-align: center !important">
            <img src="img/header_report.png"  style="width: 300px !important;">
          </td>
        </tr>
        <tr>       
          <td width="50%" style="padding: 5px;vertical-align: middle !important;" style="padding: 10px;">EMPLOYER <br><b>SOFIA OFFSHORE WINDFARM LTD</b> </td>
          <td width="50%" style="padding: 5px;vertical-align: middle !important;">RFI No: <br>
            <b>

              <?php $rfi_no = ($main[0]['id_paint_system']!=11 ? $report_format[$main[0]['project_id']][$main[0]['discipline']][$main[0]['module']][$main[0]['type_of_module']][NULL]['bnp_rfi'] : $report_format[$main[0]['project_id']][$main[0]['discipline']][$main[0]['module']][$main[0]['type_of_module']][NULL]['bnp_rfi_ppl']).strtoupper($main[0]['report_number']) ?>
              <?= $rfi_no ?>
              
            </b>
          </td>
        </tr>
        <tr>       
          <td style="padding: 5px;vertical-align: middle !important;height: 15px !important;">PROJECT TITLE <br><b>OFFSHORE CONVERTER PLATFORM</b> </td>
          <td style="padding: 5px;vertical-align: middle !important;">Submitted Date: <br><b><?= DATE('d-M-y', strtotime($main[0]['submitted_date'])) ?></b></td>
        </tr>
        <tr>
          <?php
            $locationk = explode(';', $main[0]['location']);
            foreach ($locationk as $keyk => $valuek) {
              $locationz[] = $location[$valuek];
            }
          ?>
          <td style="padding: 5px;vertical-align: middle !important;">CONTRACTOR <br><b>SEMBCORP MARINE</b></td>
          <td style="padding: 5px;vertical-align: middle !important;">Location Inspection: <br><b><?= @$area[$main[0]['area']].', '.(implode(', ', $locationz)).', '.@$point[$main[0]['point']] ?></b></td>
        </tr>
      </table>

      <table border="1px" style="border-collapse: collapse !important;" width="100%">
        <tr>
          <td colspan="22" style="text-align:center; padding-bottom: 4px; "><b>RFI - INSPECTION NOTIFICATION</b></td>
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
          <td colspan="22" style="text-align:left; padding:7px !important; font-size: 7pt !important">
            Document Ref.: SOF-OCP-000-SMO-004-0006-PP
          </td>
        </tr>
        <tr>
          <td colspan="22" style="text-align:justify !important; padding:10px !important;">DISCIPLINE : &nbsp;&nbsp;

            <input disabled  type="checkbox" name="optiona" id="opta" <?= ($main[0]['discipline'] == '2' AND $main[0]['id_paint_system'] != '11') ? 'checked' : '' ?> />
            <span class="checkboxtext"> &nbsp;&nbsp;STRUCTURAL&nbsp;&nbsp;&nbsp;&nbsp;</span>
            
            <input disabled  type="checkbox" name="optiona" id="opta" /><span class="checkboxtext"> &nbsp;&nbsp;ELECTRICAL&nbsp;&nbsp;&nbsp;&nbsp;</span>

            <input disabled  type="checkbox" name="optiona" id="opta" /><span class="checkboxtext"> &nbsp;&nbsp;MECHANICAL&nbsp;&nbsp;&nbsp;&nbsp;</span>

            <input disabled  type="checkbox" name="optiona" id="opta" /><span class="checkboxtext"> &nbsp;&nbsp;INSTR/AUT&nbsp;&nbsp;&nbsp;&nbsp;</span>
              <input disabled  type="checkbox" name="optiona" id="opta" <?= ($main[0]['discipline'] == '1' AND $main[0]['id_paint_system'] != '11') ? 'checked' : '' ?> />
            <span class="checkboxtext"> &nbsp;&nbsp;PIPING&nbsp;&nbsp;&nbsp;&nbsp;</span>
            
            <input disabled  type="checkbox" name="optiona" id="opta" />
            <span class="checkboxtext">&nbsp;&nbsp;HVAC&nbsp;&nbsp;&nbsp;&nbsp;</span>

            <input disabled  type="checkbox" name="optiona" id="opta" />
            <span class="checkboxtext">&nbsp;&nbsp;TELECOM&nbsp;&nbsp;&nbsp;&nbsp;</span>

            <input disabled  type="checkbox" name="optiona" id="opta" <?= $main[0]['id_paint_system'] == '11' ? 'checked' : '' ?> />
            <span class="checkboxtext">&nbsp;&nbsp;PICKLING&nbsp;&nbsp;&nbsp;&nbsp;</span>

          </td>
        </tr>
      </table>

    <!-- </header> -->

    

    <table  border="1px" style="border-collapse: collapse !important;" width="100%">
      <thead>
        <tr>
          <td colspan="1" style="text-align:center; vertical-align: middle; font-weight: bold; min-width: 20px !important" width="3%"><center>No.</center></td>
          <td colspan="6" style="text-align:center; vertical-align: middle; font-weight: bold;"><center>ITEM / TAG NUMBER</center></td>
          <td colspan="6" style="text-align:center; vertical-align: middle; font-weight: bold;"><center>ITEM / TAG DESCRIPTION</center></td>
          <td colspan="3" style="text-align:center; vertical-align: middle; font-weight: bold; max-width: 10px !important"><center>EXPECTED TIME</center></td>
          <td colspan="3" style="text-align:center; vertical-align: middle; font-weight: bold; max-width: 10px !important"><center>ITP <br>Intervention <br>to Employer</center></td> 
          <td colspan="3" style="text-align:center; vertical-align: middle; font-weight: bold; max-width: 10px !important"><center>INSPECTION EXECUTION RESULT</center></td> 
        </tr>
      </thead>
      <tbody>
        <?php $nox = 1; foreach($rfi_detail as $key => $value){ ?>
        <tr>
          <input type="hidden" name="id[]" value="<?= $value['id'] ?>">
          <td colspan="1" style=" text-align:center; vertical-align: middle;"><?= $nox ?></td>
          <td colspan="6" style=" text-align:center; vertical-align: middle;"><?= $value['tag_no'] ?></td>
          <td colspan="6" style=" text-align:center; vertical-align: middle;"><?= $value['tag_description'] ?></td>
          <?php //if($key==0){ ?>
            <td  colspan="3" style=" text-align:center; vertical-align: middle; max-width: 10px"><?= $value['expected_time'] ?></td>
            <td  colspan="3" style=" text-align:center; vertical-align: middle; max-width: 10px">
              <?php
                if($value['itp']){
                  $legend_inspection_auth = explode(';', $value['itp']);
                  $inspection_authority = [];
                  if(in_array(1, $post['itp']) OR in_array(1, $legend_inspection_auth)) {
                    $inspection_authority[] = 'Hold Point';
                  }

                  if(in_array(2, $post['itp']) OR in_array(2, $legend_inspection_auth)) {
                    $inspection_authority[] = 'Witness';
                  }

                  if(in_array(3, $post['itp']) OR in_array(3, $legend_inspection_auth)) {
                    $inspection_authority[] = 'Monitoring';
                  }

                  if(in_array(4, $post['itp']) OR in_array(4, $legend_inspection_auth)) {
                    $inspection_authority[] = 'Review';
                  } 
                } else {
                  $inspection_authority = '-';
                }
              ?>
              <?= implode(', ', $inspection_authority) ?>
            </td> 
            <td  colspan="3" style=" text-align:center; vertical-align: middle; max-width: 10px"><?= $value['result'] ?></td>
          <?php //} ?> 
        </tr>
        <?php $nox++; } ?> 
        <tr class="<?= $main[0]['id_paint_system']==11 ? 'd-none' : '' ?>">
          <td colspan="22" style="text-align: left !important">
              <table style='width: 100% !important;'>
                <tr>
                  <th>Paint System :</th>
                  <th>Activity Details :</th>
                  <th>Paint Product :</th>
                  <th>Colour :</th>
                </tr>
                <tr>
                  <th><?= (isset($master_paint_system_details[$id_paint_system]["code"]) ? $master_paint_system_details[$id_paint_system]["code"] : "-" ) ?></th>
                  <th><?= (isset($master_activity[$id_paint_system][$id_activity]) ? $master_activity[$id_paint_system][$id_activity]["description_of_activity"] : "-" ) ?></th>
                   <th>
                    <?php 
                      if($main[0]['special']==1){
                        echo $main[0]['special_product'];
                      } else {
                        echo (isset($master_activity[$id_paint_system][$id_activity]) ? $master_activity[$id_paint_system][$id_activity]["paint_product"] : "-");
                      }
                    ?> 
                   </th>
                  <th>
                    <?php  
                      if($main[0]['special']==1){
                        echo $main[0]['special_color'];
                      } else {
                        echo (isset($master_activity[$id_paint_system][$id_activity]) ? $master_activity[$id_paint_system][$id_activity]["color"] : "-" );
                      }
                    ?>
                  </th>
                </tr>
              </table>
          </td>
        </tr>
        <tr>
          <td colspan="22" style="text-align: center !important">
            <b>
              Trace Code:&nbsp;&nbsp;&nbsp;&nbsp;
              <?= $main[0]['report_number'] ?>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              Total:&nbsp;&nbsp;&nbsp;&nbsp;
              <?= $main[0]['qty'] ?>
            </b>
            <?php //test_var($main) ?>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- <footer> -->
      <table  border="1px" style="border-collapse: collapse !important;" width="100%">
        <tr>
          <td style="text-align:center; padding-bottom: 4px;padding-top: 4px; font-size: 10px !important;" colspan="5"><b>LEGEND : INSPECTION EXCECUTION RESULT</b></td>
        </tr>          
        <tr>
          <td  colspan="5" valign="middle" style="padding: 5px;width: 100% !important;font-size: 10px !important;vertical-align: middle !important;">
            <center>
              <table width="100%">
                <tr>
                  <td style="width: 15% !important;"><center><label><input type="radio" name='status_inspection' value="7" <?php if($rfi_detail[0]['status_inspection'] == '7'){ echo "checked"; } ?> required> Accepted</label></center></td>
                  <td style="width: 30% !important;"><center><label><input type="radio" name='status_inspection' value="9" <?php if($rfi_detail[0]['status_inspection'] == '9'){ echo "checked"; } ?> required> Accepted & Released With Comment</label></center></td>
                  <td style="width: 15% !important;"><center><label><input type="radio" name='status_inspection' value="6" <?php if($rfi_detail[0]['status_inspection'] == '6'){ echo "checked"; } ?> required> Rejected</label></center></td>
                  <td style="width: 20% !important;"><center><label><input type="radio" name='status_inspection' value="10" <?php if($rfi_detail[0]['status_inspection'] == '10'){ echo "checked"; } ?> required> Postpone</label></center></td>
                  <td style="width: 20% !important;"><center><label><input type="radio" name='status_inspection' value="11" <?php if($rfi_detail[0]['status_inspection'] == '11'){ echo "checked"; } ?> required> Re-Offer</label></center></td>
                </tr>
              </table>
            </center>
          </td>
        </tr>
        <tr>
          <td style="text-align:left; padding-bottom: 4px; " colspan="5"><b>Comment/Remarks :<br/><?php echo @$rfi_detail[0]['client_inspection_remarks'] ?></td>
        </tr>
        <tr>
          <td style="text-align:center; padding-bottom: 4px;  " colspan="5"><b>SIGNATURE FOR INSPECTION EXECUTED</b></td>
        </tr>
      </table> 
      <table width="100%" border="1px" style="border-collapse: collapse;">
        <tr>
          <td style="text-align:center; padding-bottom: 4px; text-align: center;font-weight: bold; <?= $main[0]['id_paint_system']==11 ? 'width: 50%' : 'width: 33%' ?>">CONTRACTOR</td>
          <?php if($main[0]['id_paint_system']!=11){ ?>
            <td style="text-align:center; padding-bottom: 4px; text-align: center;font-weight: bold; <?= $main[0]['id_paint_system']==11 ? 'width: 50%' : 'width: 33%' ?>">PPG PAINT REPRESENTATIVE</td>
          <?php } ?>
          <td style="text-align:center; padding-bottom: 4px; text-align: center;font-weight: bold; <?= $main[0]['id_paint_system']==11 ? 'width: 50%' : 'width: 33%' ?>">EMPLOYER</td>
        </tr>
        <tr>
          <td style="padding-bottom: 4px; ">NAME <b><?php if(isset($user[$main[0]['inspector_id']]['full_name'])){ echo $user[$main[0]['inspector_id']]['full_name']; } ?></b></td>
          <?php if($main[0]['id_paint_system']!=11){ ?>
            <td style="padding-bottom: 4px; ">NAME</td>
          <?php } ?>
          <td style="padding-bottom: 4px; ">NAME <b><?php if(isset($user[$rfi_detail[0]['client_inspection_by']]['full_name'])){ echo  $user[$rfi_detail[0]['client_inspection_by']]['full_name']; } ?></b></td>
        </tr>
        <tr>
            <td style="padding-bottom: 4px; ">SIGNATURE<br/>
              <?php if(isset($user[$main[0]['inspector_id']]['sign_approval'])){ ?>
                <center>
                  <img src="data:image/png;base64,<?= $user[$main[0]['inspector_id']]['sign_approval'] ?>"  style="width: 150px !important; height: 100px !important">
                </center>
              <?php } ?>
            </td>

            <?php if($main[0]['id_paint_system']!=11){ ?>
              <td style="padding-bottom: 4px; ">SIGNATURE<br/><br/><br/>
              </td>
            <?php } ?>

            <td style="padding-bottom: 4px; ">SIGNATURE<br/>
              <?php if(isset($user[$rfi_detail[0]['client_inspection_by']]['sign_approval'])){ ?>
                <center>
                  <img src="data:image/png;base64,<?= $user[$rfi_detail[0]['client_inspection_by']]['sign_approval'] ?>"  style="width: 150px !important; height: 100px !important">
                </center>
               <?php } ?> 
            </td>
        </tr>
        <tr>
            <td style="padding-bottom: 4px; ">Date
               <?php if(isset($user[$main[0]['inspector_id']]['sign_approval'])){ ?>
                <b><?php echo date("Y-m-d",strtotime($main[0]['transmittal_date'])); ?></b>
               <?php } ?>
            </td>
            <?php if($main[0]['id_paint_system']!=11){ ?>
              <td style="padding-bottom: 4px; ">Date</td>
            <?php } ?>
            <td style="padding-bottom: 4px; ">Date 
              <?php if(isset($user[$rfi_detail[0]['client_inspection_by']]['sign_approval'])){ ?>
              <b><?php echo date("Y-m-d",strtotime($rfi_detail[0]['client_inspection_datetime'])); ?></b>
                <?php } ?>
            </td>
            
        </tr>
      </table> 
    <!-- </footer> -->

  </center>
</body>
</html>