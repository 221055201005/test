<!DOCTYPE html>
<html>
<head>
  <title><?= $project[$list_detail[0]['project_code']]['project_ref'].'-OCP-SMO-'.strtoupper($type_of_module_list[$list_detail[0]['type_of_module']]['code']).'-'.strtoupper($discipline_list[$list_detail[0]['discipline']]['initial']).'-NDT-'.$initial.'-'.str_pad($list_detail[0]['report_number'],4,0, STR_PAD_LEFT) ?></title>
  <style type="text/css">
   <?php error_reporting(0) ?>
   @page {
      margin: 0cm 0cm 0cm 0cm;
    }

    body {
      top: 12.6cm;
      left: 1cm;
      right: 1cm;
      bottom: 6cm;

      margin-top: 13cm;
      margin-left: 1cm;
      margin-right: 1cm;
      margin-bottom: 7.3cm;

      font-family: "helvetica";
      font-size: 50% !important;
    }

    footer {
      position: fixed;
      top: 22cm;
      left: 0cm;
      right: 0cm;
      bottom: 20cm;

      margin-top: 1cm;
      margin-left: 1cm;
      margin-right: 1cm;
      margin-bottom: 1cm;
    }

    header {
      position: fixed;
      bottom: 1cm;
      top: 0cm;
      left: 0cm;
      right: 0cm;

      margin-top: 1cm;
      margin-left: 1cm;
      margin-right: 1cm;
      margin-bottom: 1cm;

      font-family: "helvetica";
      font-size: 50% !important;  
    }

    .titleHead {
      border:1px #000 solid;
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
      border-right: 1px #000 solid;
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
      word-wrap: break-word;
    }   
    .tab{
      display: inline-block; 
      width: 60px;
    }
    .tab2{
      display: inline-block; 
      width: 120px;
    }

    hr {
      border-top: 0px !important;
    }

    label {
      display: block;
      padding-left: 2;
      text-indent: -1;
    }

    input {
      width: 5px;
      height: 5px;
      padding: 0;
      margin:0;
      vertical-align: bottom;
      position: relative;
      top: 0px;
      *overflow: hidden;
    }

    .checkmark {
      width: 100px !important;
    }

  </style>
</head>

<body>
  <header>
    <table border="1" style="border-collapse: collapse;" width="100%">
      <tr>
        <th colspan="15"><img src="img/header_report.png" style="width: 460px"></th>
      </tr>

      <tr>
        <th colspan="9" rowspan="3" width="350px"><h3>DYE PENETRANT INSPECTION<br>REPORT</h3></th>
        <th colspan="2" style="text-align: left !important;">Report No.</th>
        <th colspan="1" >:</th>
        <th colspan="3" style="text-align: left !important;"><?= $project[$list_detail[0]['project_code']]['project_ref'].'-OCP-SMO-'.strtoupper($type_of_module_list[$list_detail[0]['type_of_module']]['code']).'-'.strtoupper($discipline_list[$list_detail[0]['discipline']]['initial']).'-NDT-'.$initial.'-'.str_pad($list_detail[0]['report_number'],4,0, STR_PAD_LEFT) ?></th>
      </tr>

      <tr>
        <th colspan="2" style="text-align: left !important">Page No</th>
        <th colspan="1" >:</th>
        <th colspan="3"></th>
      </tr>

      <tr>
        <th colspan="2" style="text-align: left !important">RFI No.</th>
        <th colspan="1" >:</th>
        <th colspan="3" style="text-align: left !important;"><?= $project[$list_detail[0]['project_code']]['project_ref'].'-OCP-SMO-'.strtoupper($type_of_module_list[$list_detail[0]['type_of_module']]['code']).'-'.strtoupper($discipline_list[$list_detail[0]['discipline']]['initial']).'-NDT-'.$initial.'-'.str_pad($list_detail[0]['ndt_rfi'],4,0, STR_PAD_LEFT) ?></th>
      </tr>

      <tr>
        <th colspan="3" style="text-align: left !important">Client</th>
        <th colspan="1" style="text-align: center !important; width: 1px">:</th>
        <th colspan="5" style="text-align: left !important;"><?= $project[$list_detail[0]['project_code']]['client'] ?></th>

        <th colspan="2" style="text-align: left !important">Date of Inspection</th>
        <th colspan="1" >:</th>
        <th colspan="3" style="text-align: left !important;"><?= DATE('Y-m-d', strtotime($list_detail[0]['date_of_inspection'])) ?></th>
      </tr>

      <tr>
        <th colspan="3" style="text-align: left !important">Project</th>
        <th colspan="1" >:</th>
        <th colspan="5" style="text-align: left !important;"><?= $project[$list_detail[0]['project_code']]['project_name'] ?></th>
        <th colspan="2" style="text-align: left !important">Testing Location</th>
        <th colspan="1" >:</th>
        <th colspan="3" style="text-align: left !important;">
          <?= $report_detail['testing_location'] ?>
        </th>
      </tr>

      <tr>
        <th colspan="3" style="text-align: left !important">Standard / Code</th>
        <th colspan="1" >:</th>
        <th colspan="5" style="text-align: left !important;">
          <?= $list[0]['discipline']==2 ? 'DNVGL-CG-0051 / BS EN ISO 17635' : 'ASME B31.3' ?>
        </th>
        <th colspan="2" style="text-align: left !important">Job No.</th>
        <th colspan="1" >:</th>
        <th colspan="3" style="text-align: left !important;"><?= @$report_detail['job_no'] ?></th>
      </tr>

      <tr>
        <th colspan="3" rowspan="2" style="text-align: left !important">Acceptance Criteria</th>
        <th colspan="1" rowspan="2" >:</th>
        <th colspan="5" style="text-align: left !important;">
          <?php if($list[0]['discipline']==1){ ?>
            ASME B31.3 Paragraph 344.4.2
          <?php } else { ?>
            <?= $list_detail[0]['class']==1 ? 'ISO 5817 LEVEL B' : 'ISO 5817 LEVEL C' ?>
          <?php } ?>
        </th>

        <th colspan="2" rowspan="2" style="text-align: left !important">Item Tested</th>
        <th colspan="1" rowspan="2" >:</th>
        <th colspan="3" rowspan="2" style="text-align: left !important;">
          <?= @$report_detail['item_tested'] ?>
        </th>
      </tr>

      <tr>
        <th colspan="5" style="text-align: left !important;">
          <?php if($list[0]['discipline']==1){ ?>
            ASME B31.3 Paragraph 344.4.2
          <?php } else { ?>
            <?= $list_detail[0]['class']==1 ? 'ISO 23277 ACCEPTANCE LEVEL 2X' : 'ISO 23277 ACCEPTANCE LEVEL 2X' ?>
          <?php } ?>
        </th>
      </tr>

      <tr>
        <th colspan="3" style="text-align: left !important">Procedure No.</th>
        <th colspan="1" >:</th>
        <th colspan="5" style="text-align: left !important;">
          <?= $list[0]['discipline']==2 ? 'SCM-SOF-SMOE-23-PR-0010': 'SCM-SOF-SMOE-23-PR-0013' ?>
        </th>

        <th colspan="2" style="text-align: left !important">Grade Material</th>
        <th colspan="1" >:</th>
        <th colspan="3" style="text-align: left !important;"><?= @$report_detail['grade_material'] ?></th>
      </tr>

      <tr>
        <th colspan="3" style="text-align: left !important">GA/ASSY/ISO Drawing No.</th>
        <th colspan="1" >:</th>
        <th colspan="5" style="text-align: left !important;"><?= $list[0]['drawing_no'] ?></th>
        <th colspan="2" style="text-align: left !important">Delivery Condition</th>
        <th colspan="1" >:</th>
        <th colspan="3" style="text-align: left !important;"><?= @$report_detail['delivery_condition'] ?></th>
      </tr>

      <tr>
        <th colspan="3" rowspan="2" style="text-align: left !important">Job Description</th>
        <th colspan="1" rowspan="2" >:</th>
        <th colspan="5" rowspan="2" style="text-align: left !important;">
          <?= @$report_detail['job_description'] ?>
        </th>
        <th colspan="2" style="text-align: left !important">Technician</th>
        <th colspan="1" >:</th>
        <th colspan="3" style="text-align: left !important;"><?= @$report_detail['testing_personnel'] ?></th>
      </tr>

      <tr>
        <th colspan="2" style="text-align: left !important">Certificate No.</th>
        <th colspan="1" >:</th>
        <th colspan="3" style="text-align: left !important;"><?= @$report_detail['certificate_no'] ?></th>
      </tr>

      <tr>
        <th colspan="3" style="text-align: left !important">Penetrant System</th>
        <th colspan="1" >:</th>
        <th colspan="6" style="text-align: left !important;">&nbsp;&nbsp;
          <input type="checkbox" name="penetrant_system" value="colored" <?= $report_detail['penetrant_system']=='colored' ? 'checked' : '' ?>>&nbsp;&nbsp;Colored
        </th>
        <th colspan="5" style="text-align: left !important;">&nbsp;&nbsp;
          <input type="checkbox" name="penetrant_system" value="fluorescent" <?= $report_detail['penetrant_system']=='fluorescent' ? 'checked' : '' ?>>&nbsp;&nbsp;Fluorescent
        </th>
      </tr>

      <tr>
        <th colspan="3" style="text-align: left !important">Penetrant Type / Method</th>
        <th colspan="1" >:</th>
        <th colspan="4" style="text-align: left !important;">&nbsp;&nbsp;
          <input type="checkbox" name="penetrant_type_method" value="visible" <?= $report_detail['penetrant_type_method']=='visible' ? 'checked' : '' ?>>&nbsp;&nbsp;Visible
        </th>
        <th colspan="3" style="text-align: left !important;">&nbsp;&nbsp;
          <input type="checkbox" name="penetrant_type_method" value="solvent" <?= $report_detail['penetrant_type_method']=='solvent' ? 'checked' : '' ?>>&nbsp;&nbsp;Solvent Removable
        </th>
        <th colspan="4" style="text-align: left !important;">&nbsp;&nbsp;
          <input type="checkbox" name="penetrant_type_method" value="other" <?= $report_detail['penetrant_type_method']=='other' ? 'checked' : '' ?>>&nbsp;&nbsp;Other&nbsp;&nbsp;
          <?= $report_detail['penetrant_type_method_other'] ?>
        </th>
      </tr>

      <tr>
        <th colspan="3" style="text-align: left !important">Brand's Name / Type</th>
        <th colspan="1">:</th>
        <th colspan="2" style="text-align: left !important;"><?= @$report_detail['brand'] ?></th>

        <th colspan="1" style="text-align: left !important">Penetrant</th>
        <th colspan="1" width="1px">:</th>
        <th colspan="1" style="text-align: left !important;"><?= @$report_detail['penetrant'] ?></th>

        <th colspan="1" style="text-align: left !important">Cleaner</th>
        <th colspan="1" >:</th>
        <th colspan="2" style="text-align: left !important;"><?= @$report_detail['cleaner'] ?></th>

        <th colspan="1" style="text-align: left !important">Developer :</th>
        <th colspan="1" style="text-align: left !important;"><?= @$report_detail['developer'] ?></th>
      </tr>

      <tr>
        <th colspan="3" style="text-align: left !important">Batch Number</th>
        <th colspan="1" >:</th>
        <th colspan="3" style="text-align: left !important;"><?= @$report_detail['batch_number'] ?></th>
        <th colspan="8"></th>
      </tr>

      <tr>
        <th colspan="3" style="text-align: left !important">Methods Pre-Cleaning</th>
        <th colspan="1" >:</th>
        <th colspan="3" style="text-align: left !important;"><?= @$report_detail['methods_pre_cleaning'] ?></th>
        <th colspan="8"></th>
      </tr>

       <tr>
        <th colspan="3" style="text-align: left !important">Penetrant Applicable</th>
        <th colspan="1" >:</th>
        <th colspan="3" style="text-align: left !important;">&nbsp;&nbsp;
          <input type="checkbox" name="penetrant_applicable" value="brush" <?= $report_detail['penetrant_applicable']=='brush' ? 'checked' : '' ?>>&nbsp;&nbsp;Brush
        </th>
        <th colspan="2" style="text-align: left !important;">&nbsp;&nbsp;
          <input type="checkbox" name="penetrant_applicable" value="spray" <?= $report_detail['penetrant_applicable']=='spray' ? 'checked' : '' ?>>&nbsp;&nbsp;Spray
        </th>
        <th colspan="6"></th>
      </tr>
    </table>
    <br> 
    <table border="1" style="border-collapse: collapse;" width="100%">
      <tr>
        <th colspan="3" width="150px" style="text-align: left !important">Light Insensity</th>
        <th colspan="1" width="10px">:</th>
        <th colspan="3" style="text-align: left !important;"><?= @$report_detail['light_intensity'] ?></th>

        <th colspan="1" style="text-align: left !important">Light Source :</th>
        <th colspan="2" style="text-align: left !important;"><?= @$report_detail['light_source'] ?></th>

        <th colspan="1" style="text-align: left !important">Dwell Time :</th>
        <th colspan="2" style="text-align: left !important;"><?= @$report_detail['dwell_time'] ?></th>

        <th colspan="1" width="70px" style="text-align: left !important">Surface Temperature :</th>
        <th colspan="3" style="text-align: left !important;"><?= @$report_detail['temperature'] ?></th>
      </tr>

      <tr>
        <th colspan="3" style="text-align: left !important">Methode Removing Excess Penetrant</th>
        <th colspan="1" >:</th>
        <th colspan="13" style="text-align: left !important;"><?= @$report_detail['method_removing_excess_penetrant'] ?></th>
      </tr>

      <tr>
        <th colspan="3" style="text-align: left !important">Drying After Remove Excess Penetrant</th>
        <th colspan="1" >:</th>
        <th colspan="13" style="text-align: left !important;"><?= @$report_detail['drying_after_remove'] ?></th>
      </tr>

      <tr>
        <th colspan="3" style="text-align: left !important">Surface Preparation / Cleaning</th>
        <th colspan="1" >:</th>
        <th colspan="3" style="text-align: left !important;">&nbsp;&nbsp;
          <input type="checkbox" name="surface_preparation_cleaning" value="as_welded" <?= $report_detail['surface_preparation_cleaning']=='as_welded' ? 'checked' : '' ?>>&nbsp;&nbsp;As Welded
        </th>
        <th colspan="3" style="text-align: left !important;">&nbsp;&nbsp;
          <input type="checkbox" name="surface_preparation_cleaning" value="machining" <?= $report_detail['surface_preparation_cleaning']=='machining' ? 'checked' : '' ?>>&nbsp;&nbsp;Machining
        </th>
        <th colspan="3" style="text-align: left !important;">&nbsp;&nbsp;
          <input type="checkbox" name="surface_preparation_cleaning" value="grinding" <?= $report_detail['surface_preparation_cleaning']=='grinding' ? 'checked' : '' ?>>&nbsp;&nbsp;Grinding
        </th>
        <th colspan="4"></th>
      </tr>

      <tr>
        <th colspan="3" style="text-align: left !important">Time of Examination</th>
        <th colspan="1" >:</th>
        <th colspan="3" style="text-align: left !important;">&nbsp;&nbsp;
          <input type="checkbox" name="time_of_examination" value="after_welding" <?= $report_detail['time_of_examination']=='after_welding' ? 'checked' : '' ?>>&nbsp;&nbsp;After Welding
        </th>
        <th colspan="3" style="text-align: left !important;">&nbsp;&nbsp;
          <input type="checkbox" name="time_of_examination" value="after_hydro" <?= $report_detail['time_of_examination']=='after_hydro' ? 'checked' : '' ?>>&nbsp;&nbsp;After Hydro-Test
        </th>
        <th colspan="3" style="text-align: left !important;">&nbsp;&nbsp;
          <input type="checkbox" name="time_of_examination" value="after_pwht" <?= $report_detail['time_of_examination']=='after_pwht' ? 'checked' : '' ?>>&nbsp;&nbsp;After PWHT
        </th>
        <th colspan="4" style="text-align: left !important;">&nbsp;&nbsp;
          <input type="checkbox" name="time_of_examination" value="others" <?= $report_detail['time_of_examination']=='others' ? 'checked' : '' ?>>&nbsp;&nbsp;Others&nbsp;&nbsp;
          <?= @$report_detail['time_of_examination_others'] ?>
        </th>
      </tr>

      <tr>
        <th colspan="3" style="text-align: left !important">Scope Examination</th>
        <th colspan="1" >:</th>
        <th colspan="3" style="text-align: left !important;">&nbsp;&nbsp;
          <input type="checkbox" name="scope_examintaion" <?= $report_detail['scope_examintaion']=='base_metal' ? 'checked' : '' ?> value="base_metal">&nbsp;&nbsp;Base Metal
        </th>
        <th colspan="3" style="text-align: left !important;">&nbsp;&nbsp;
          <input type="checkbox" name="scope_examintaion" <?= $report_detail['scope_examintaion']=='edge_prop' ? 'checked' : '' ?> value="edge_prop">&nbsp;&nbsp;Edge Prep
        </th>
        <th colspan="3" style="text-align: left !important;">&nbsp;&nbsp;
          <input type="checkbox" name="scope_examintaion" <?= $report_detail['scope_examintaion']=='back_chipping' ? 'checked' : '' ?> value="back_chipping">&nbsp;&nbsp;Back Chipping
        </th>
        <th colspan="4"></th>
      </tr>
      <tr>
        <th colspan="4"></th>
        <th colspan="3" style="text-align: left !important;">&nbsp;&nbsp;
          <input type="checkbox" name="scope_examintaion" <?= $report_detail['scope_examintaion']=='weld_part' ? 'checked' : '' ?> value="weld_part">&nbsp;&nbsp;Weld Part
        </th>
        <th colspan="3" style="text-align: left !important;">&nbsp;&nbsp;
          <input type="checkbox" name="scope_examintaion" <?= $report_detail['scope_examintaion']=='repair_weld' ? 'checked' : '' ?> value="repair_weld">&nbsp;&nbsp;Repair Weld
        </th>
        <th colspan="7" style="text-align: left !important;">&nbsp;&nbsp;
          <input type="checkbox" name="scope_examintaion" <?= $report_detail['scope_examintaion']=='others' ? 'checked' : '' ?> value="others">&nbsp;&nbsp;Others&nbsp;&nbsp;
          <?= @$report_detail['scope_examintaion_others'] ?>
        </th>
      </tr>
    </table>
    <br>
  </header>

  <footer>
  <table border="1px" style="border-collapse: collapse;" width="100%">
    <tr>
      <td height="50px"> Note:
      <br>&nbsp;&nbsp;&nbsp;
        <?= '- '.$report_detail['note'] ?>
      </td>
    </tr>
  </table>
  <br>
  <table border="1px" style="border-collapse: collapse;" width="100%">
    <tr>
      <th>Tested By <br>NDT Level II</th>
      <th>QC Inspector</th>
      <th>Client Inspector</th>
      <th>3rd Party</th>
    </tr>
    <tr>
      <td style="height: 60px; vertical-align: middle; text-align: center" width="25%">
        <img style="max-width: 3.5cm" src="data:image/png;base64, <?= $user_list[$list_detail[0]['created_by']]['sign_approval'] ?>">
      </td>
      <td style="height: 60px; vertical-align: middle; text-align: center" width="25%">
        <img style="max-width: 3.5cm" src="data:image/png;base64, <?= $user_list[$list_detail[0]['smoe_approval_by']]['sign_approval'] ?>">
      </td>
      <td style="height: 60px; vertical-align: middle; text-align: center" width="25%">
        <img style="max-width: 3.5cm" src="data:image/png;base64, <?= $user_list[$list_detail[0]['client_approval_by']]['sign_approval'] ?>">
      </td>
      <td style="height: 60px; vertical-align: middle; text-align: center" width="25%">-</td>
    </tr>
    <tr>
      <td> Name / Signature : <?= $user_list[$list_detail[0]['created_by']]['full_name'] ?>
        <br> Date: <?= DATE('d F, Y h:i A',strtotime($list_detail[0]['created_date'])) ?>
      </td>
      
      <td> Name / Signature : <?= $user_list[$list_detail[0]['smoe_approval_by']]['full_name'] ?>
        <br> Date: <?= DATE('d F, Y h:i A',strtotime($list_detail[0]['smoe_approval_date'])) ?>
      </td>
      
      <td> Name / Signature : <?= $user_list[$list_detail[0]['client_approval_by']]['full_name'] ?>
        <br> Date: <?= DATE('d F, Y h:i A',strtotime($list_detail[0]['client_approval_date'])) ?>
      </td>
      
      <td> Name / Signature : -
        <br> Date: -
      </td>
    </tr>
  </table>
</footer>

  <table border="1" style="border-collapse: collapse;" width="100%">
    <thead>
      <tr>
        <th rowspan="2" width="20px">S/N</th>
        <th rowspan="2" >Weld Map Dwg / Line & Spool No</th>
        <th rowspan="2" >Joint <br>No</th>
        <th rowspan="2" width="25px">Joint Type</th>
        
        <th rowspan="2" width="25px">
        <?php if($list_detail[0]['discipline']==1){
          echo "Size<br>(mm)";
        } else {
          echo "Dia<br>(inch)";
        } ?>  
        </th>
        
        <th rowspan="2" width="25px">Sch</th>
        <th rowspan="2" width="30px">Thk<br>(mm)</th>
        <th rowspan="2" width="30px">Total Length<br>(mm)</th>
        <th rowspan="2" width="30px">Tested Length<br>(mm)</th>
        <th rowspan="2" width="30px"> Welding Process </th>
        <th rowspan="2" >Welder <br> ID</th>
        <th rowspan="2" >Result</th>
        <th colspan="3"  rowspan="1">Type of Discontinuites</th>
        <th rowspan="2" >Inspection Category</th>
        <th rowspan="2" >Remarks</th>
      </tr>

      <tr>
        <th rowspan="1" >Deffect Length<br>(mm)</th>
        <th rowspan="1" >Deffect Type</th>
        <th rowspan="1" >Distance from Datum<br>(mm)</th>
      </tr>
    </thead>
    <tbody style="text-align: center !important">
      <?php $no = 1; foreach ($joint_list as $key => $value) {?>
      <tr>
        <td rowspan="<?= count($value) ?>" >
          <?= $no++ ?>
        </td>

        <td rowspan="<?= count($value) ?>" ><?= $value[0]['drawing_wm'] ?></td>
        <td rowspan="<?= count($value) ?>" ><?= $value[0]['joint_no'].$value[0]['revision_category'].$value[0]['revision'] ?></td>
        <td rowspan="<?= count($value) ?>" ><?= $joint_type[$value[0]['joint_type']] ?></td>
        <td rowspan="<?= count($value) ?>" ><?= $value[0]['diameter'] ?></td>
        <td rowspan="<?= count($value) ?>" ><?= $value[0]['sch'] ?></td>
        <td rowspan="<?= count($value) ?>" ><?= (int)$value[0]['thk'] ?></td>
        <td rowspan="<?= count($value) ?>" ><?= $value[0]['total_length'] ?></td>

        <td rowspan="<?= count($value) ?>"><?= $value[0]['tested_length'] ?></td>

        <td rowspan="<?= count($value) ?>">
        <?php 
          $value[0]['gtaw'] == 1 ? print_r(strtoupper("gtaw").', ') : '';
          $value[0]['gmaw'] == 1 ? print_r(strtoupper("gmaw").', ') : '';
          $value[0]['smaw'] == 1 ? print_r(strtoupper("smaw").', ') : '';
          $value[0]['fcaw'] == 1 ? print_r(strtoupper("fcaw").', ') : '';
          $value[0]['saw'] == 1 ? print_r(strtoupper("saw").', ') : '';
        ?>    
        </td>

        <td rowspan="<?= count($value) ?>">
          <?php  
            $welder = explode(';', $value[0]['welder']);
            foreach ($welder as $key => $value_welder) {
              print_r($welder_id[$value_welder].', ');
            }
          ?>
        </td>

        <td rowspan="<?= count($value) ?>" >
          <?= $value[0]['result']==3 ? 'Approved' : ( $value[0]['result']==2 ? 'Rejected' : '-') ?>
        </td>

        <?php foreach($value as $d): ?>
          <td ><?= $d['deffect_length'] ?></td>
          <td ><?= $ctq_initial[$d['id_deffect']] ?></td>
          <td ><?= $d['datum'] ?></td>
          <td ><?= $class[$d['class']] ?></td>
          <td ></td>
        </tr>
      <?php endforeach; ?>

      </tr>
      <?php } ?>
    </tbody>
  </table>
</body>

</html>