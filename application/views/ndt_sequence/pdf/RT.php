<!DOCTYPE html>
<html>
<head>
  <title><?= $project[$list_detail[0]['project_code']]['project_ref'].'-OCP-SMO-'.strtoupper($type_of_module_list[$list_detail[0]['type_of_module']]['code']).'-'.strtoupper($discipline_list[$list_detail[0]['discipline']]['initial']).'-NDT-'.$initial.'-'.str_pad($list_detail[0]['report_number'],4,0, STR_PAD_LEFT) ?></title>
  <style type="text/css">
    <?php error_reporting(0) ?>
    <?php 
      $main_data      = $list_detail[0];
      
      if($main_data['discipline']==1){
        $standard_code  = 'ASME B31.3';
      } else {
        $standard_code  = 'DNVGL-CG-0051 / BS EN ISO 17636-1';  
      }
    ?>
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
      margin-bottom: 6cm;

      font-family: "helvetica";
      font-size: 50% !important;
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

    footer {
      position: fixed;
      top: 23.15cm;
      left: 0cm;
      right: 0cm;
      height: 10cm;

      margin-top: 1cm;
      margin-left: 1cm;
      margin-right: 1cm;
      margin-bottom: 1cm;
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

    .text-center {
      text-align: center;
      vertical-align: middle;
    }

    .text-left {
      text-align: left;
      vertical-align: middle;
    }

    .text-right {
      text-align: right;
      vertical-align: middle;
    }

    .align-middle {
      vertical-align: middle;
    }

  </style>
  
</head>
<body>
  <header>
    <table border="1" style="border-collapse: collapse;" width="100%">
    <tr>
      <th colspan="16" class="text-center">
        <img src="img/header_report.png" style="width: 460px">
      </th>
    </tr>
    <tr>
      <th colspan="16" class="text-center valign-middle">
        <span style="font-size: 18px;"><strong>RADIOGRAPHIC TEST REPORT</strong></span>
      </th>

    </tr>
    <tr>
      <th class="valign-middle text-left" colspan="3"><strong>CLIENT</strong></th>
      <th class="valign-middle text-center" colspan="1"><strong>:</strong></th>
      <th class="valign-middle text-left" colspan="6">
        <?= $project[$main_data['project_code']]['client'] ?>
      </th>
      <th class="valign-middle text-left" colspan="3"><strong>REPORT NO.</strong></th>
      <th class="valign-middle text-center" colspan="1"><strong>:</strong></th>
      <th class="valign-middle text-left" colspan="2"><strong>
        <?= $project[$list_detail[0]['project_code']]['project_ref'].'-OCP-SMO-'.strtoupper($type_of_module_list[$list_detail[0]['type_of_module']]['code']).'-'.strtoupper($discipline_list[$list_detail[0]['discipline']]['initial']).'-NDT-'.$initial.'-'.str_pad($list_detail[0]['report_number'],4,0, STR_PAD_LEFT) ?>
      </th>
    </tr>

    <tr>
      <th class="valign-middle text-left" colspan="3"><strong>Project Name</strong></th>
      <th class="valign-middle text-center" colspan="1"><strong>:</strong></th>
      <th class="valign-middle text-left" colspan="6">
        <?= $project[$main_data['project_code']]['project_name'] ?>
      </th>
      <th class="valign-middle text-left" colspan="3"><strong>RFI NO.</strong></th>
      <th class="valign-middle text-center" colspan="1"><strong>:</strong></th>
      <th class="valign-middle text-left" colspan="2">
        <?= $project[$list_detail[0]['project_code']]['project_ref'].'-OCP-SMO-'.strtoupper($type_of_module_list[$list_detail[0]['type_of_module']]['code']).'-'.strtoupper($discipline_list[$list_detail[0]['discipline']]['initial']).'-NDT-RFI-'.$initial.'-'.str_pad($list_detail[0]['ndt_rfi'],4,0, STR_PAD_LEFT) ?>
      </th>
    </tr>

    <tr>
      <th class="valign-middle text-left" colspan="3"><strong>Standard / Code</strong></th>
      <th class="valign-middle text-center" colspan="1"><strong>:</strong></th>
      <th class="valign-middle text-left" colspan="6">
        <?= $standard_code ?>
      </th>
      <th class="valign-middle text-left" colspan="3"><strong>Date Of Inspection</strong></th>
      <th class="valign-middle text-center" colspan="1"><strong>:</strong></th>
      <th class="valign-middle text-left" colspan="2">
        <?= DATE('d F Y', strtotime($list[0]['date_of_inspection'])); ?>
      </th>
    </tr>

    <tr>
      <th class="valign-middle text-left" colspan="3" rowspan="2"><strong>Acceptance Criteria</strong></th>
      <th class="valign-middle text-center" colspan="1" rowspan="2"><strong>:</strong></th>
      <th class="valign-middle text-left" colspan="6">
        <?php if($list[0]['discipline']==1){ ?>
          ASME B31.3 Table 344.4.2
        <?php } else { ?>
          <?= $list_detail[0]['class']==1 ? 'ISO 5817 LEVEL B' : 'ISO 5817 LEVEL C' ?>
        <?php } ?>
      </th>
      <th class="valign-middle text-left" colspan="3" rowspan="2"><strong>Testing Location</strong></th>
      <th class="valign-middle text-center" colspan="1" rowspan="2"><strong>:</strong></th>
      <th class="valign-middle text-left" colspan="2" rowspan="2">
        <?= $report_detail['testing_location'] ?>
      </th>
    </tr>

    <tr>
      <th class="valign-middle text-left" colspan="6">
        <?php if($list[0]['discipline']==1){ ?>
          ASME B31.3 Table 344.4.2
        <?php } else { ?>
          <?= $list_detail[0]['class']==1 ? 'ISO 10675-1 ACCEPTANCE LEVEL 1' : 'ISO 10675-1 ACCEPTANCE LEVEL 2' ?>
        <?php  } ?>
      </th>
    </tr>

    <tr>
      <th class="valign-middle text-left" colspan="3"><strong>Procedure No.</strong></th>
      <th class="valign-middle text-center" colspan="1"><strong>:</strong></th>
      <th class="valign-middle text-left" colspan="6">
        SCM-SOF-SMOE-23-PR-0009
      </th>
      <th class="valign-middle text-left" colspan="3"><strong>Job No.</strong></th>
      <th class="valign-middle text-center" colspan="1"><strong>:</strong></th>
      <th class="valign-middle text-left" colspan="2">
        <?= @$report_detail['job_no'] ?>
      </th>
    </tr>

    <tr>
      <th class="valign-middle text-left" colspan="3"><strong>GA/ASSY/ISOMETRIC Drawing No.</strong></th>
      <th class="valign-middle text-center" colspan="1"><strong>:</strong></th>
      <th class="valign-middle text-left" colspan="4">
        <?= $list[0]['drawing_no'] ?>
      </th>
      <th class="valign-middle text-left"><strong>Rev.</strong></th>
      <th class="valign-middle" colspan="1">Belum</th>
      </th>
      <th class="valign-middle text-left" colspan="3"><strong>Grade Material</strong></th>
      <th class="valign-middle text-center" colspan="1"><strong>:</strong></th>
      <th class="valign-middle text-left" colspan="2">
        <?= @$report_detail['grade_material'] ?>
      </th>
    </tr>

    <tr>
      <th class="valign-middle text-left" rowspan="2" colspan="3">
        <strong>Job Description</strong>
      </th>
      <th class="valign-middle text-center" rowspan="2" colspan="1"><strong>:</strong></th>

      <th class="valign-middle text-left" rowspan="2" colspan="6">
        <?= @$report_detail['job_description'] ?>
      </th>
      <th class="valign-middle text-left" colspan="3"><strong>Delivery Condition</strong></th>
      <th class="valign-middle text-center" colspan="1"><strong>:</strong></th>
      <th class="valign-middle text-left" colspan="2">
        <?= @$report_detail['delivery_condition'] ?>
      </th>
    </tr>
    <tr>
      <th class="valign-middle text-left" colspan="3"><strong>PWHT Status</strong></th>
      <th class="valign-middle text-center" colspan="1"><strong>:</strong></th>
      <th class="valign-middle text-left" colspan="2">
        <?= @$report_detail['pwht_status'] ?>
      </th>
    </tr>
  </table>
  <br>
  <table border="1" style="border-collapse: collapse;" width="100%">
    <tr>
      <td class="text-center" colspan="6" style="background-color: yellow;">
        
      </td>

      <td class="text-center" colspan="5"><strong>RADIATION SOURCE</strong></td>
      <td class="text-center" colspan="6"><strong>EXPOSURE TECHNIQUE SKETCH</strong></td>
    </tr>
    <tr class="align-middle">
      <?php  
        $isotop_op = explode(';', $report_detail['isotope']);
        //test_var($isotop_op);
      ?>
      <td colspan="6" rowspan="4" style="background-color: white;"></td>
      <td style="width: 50px" class="align-middle"><strong>Isotope</strong></td>
      <td class="text-center align-middle" style="width: 10px">:</td>
      <td class="align-middle">Ir-192 <input type="checkbox" name="isotope_1" value="Ir-192" <?= in_array('Ir-192', $isotop_op) ? 'checked' : ''; ?>></td>
      <td colspan="2" class="align-middle">Co-60 <input type="checkbox" name="isotope_2" value="Co-60" <?= in_array('Co-60', $isotop_op) ? 'checked' : ''; ?>></td>

      <td rowspan="6" colspan="3" style="width: 100px;">
        <img style="width: 100px" src="img/Panoramic - SWSV.jpg">
        <br>
        Panoramic / SWSV<input type="checkbox" name="image_radio[]" value='IMAGE_1' <?= in_array('IMAGE_1',explode(';', $report_detail['image_radio'])) ? 'checked' : '' ?>></td>

      <td rowspan="6" colspan="3" style="width: 100px;">
        <img style="width: 100px" src="img/SWSV-2.jpg">
        <br>
        SWSV <input type="checkbox" name="image_radio[]" value='IMAGE_2' <?= in_array('IMAGE_2',explode(';', $report_detail['image_radio'])) ? 'checked' : '' ?>></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td class="align-middle">Other <input type="checkbox" name="isotope_3" value="Other" <?= in_array('Other', $isotop_op) ? 'checked' : ''; ?>></td>
      <td class="align-middle" colspan="2" style="text-decoration: underline;">
        <?= @$report_detail['isotope_other'] ?>
      </td>
    </tr>
    <tr>
      <td class="align-middle"><strong>Activity</strong></td>
      <td class="text-center align-middle">:</td>
      <td class="align-middle">Ci <input type="checkbox" name="ci" value="ci" <?= @$report_detail['ci']=='ci' ? 'checked' : '' ?>></td>
      <td colspan="2" class="align-middle">
        <label for="" class="col-xl-2 col-form-label"> Kv : <?= @$report_detail['kv'] ?></label>
          
      </td>
    </tr>
    <tr>
      <td class="align-middle"><strong>Current A</strong></td>
      <td class="text-center align-middle">:</td>
      <td colspan="3" class="align-middle">
        <?= @$report_detail['current_a'] ?>
      </td>
    </tr>
    <tr>
      <td class="text-center align-middle" colspan="6" rowspan="2"><strong>PART</strong></td>
      <td class="align-middle"><strong>Size / Focal Spot</strong></td>
      <td class="text-center align-middle">:</td>
      <td colspan="3" class="align-middle">
        <?= @$report_detail['size_focal_spot'] ?><b> mm</b>
      </td>
    </tr>
    <tr>
      <td class="text-center" colspan="5" rowspan="2"><strong>TECHNIQUE</strong></td>
    </tr>
    <tr>
      <td class="align-middle" colspan="2" style="width: 55px"><strong>Name</strong></td>
      <td class="text-center align-middle" style="width: 10px">:</td>
      <td class="align-middle" colspan="2">
        <?= @$report_detail['part_name'] ?>
      </td>
      <td></td>
      <td rowspan="7" colspan="3">
        <img style="width: 100px" src="img/SWSV.jpg">
        <br>
        SWSV <input type="checkbox" name="image_radio[]" value='IMAGE_3' <?= in_array('IMAGE_3',explode(';', $report_detail['image_radio'])) ? 'checked' : '' ?>></td>
      <td rowspan="7" colspan="3">
        <img style="width: 100px" src="img/DWSV-1.jpg">
        <br>
        DWSV <input type="checkbox" name="image_radio[]" value='IMAGE_4' <?= in_array('IMAGE_4',explode(';', $report_detail['image_radio'])) ? 'checked' : '' ?>></td>
    </tr>

    <tr>
      <td colspan="6"></td>
      <?php  
        $rt_kelas = explode(';', $report_detail['rt_class']);
      ?>
      <td class="text-nowrap" colspan="5" class="align-middle">
        <strong>RT CLASS A</strong> <input type="checkbox" name="rt_class_a" value="A" <?= in_array('A',$rt_kelas) ? 'checked' : '' ?>>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <strong>RT CLASS B</strong> <input type="checkbox" name="rt_class_b" value="B" <?= in_array('B',$rt_kelas) ? 'checked' : '' ?>>
      </td>

    </tr>

    <tr>
      <td colspan="2" class="align-middle"><strong>Size / ID / OD</strong></td>
      <td class="text-center align-middle">:</td>
      <td colspan="2" class="align-middle">
        <?= @$report_detail['part_size'] ?>  
      </td>
      <td class="align-middle"><strong>mm/inch</strong></td>
      <td class="align-middle"><strong>Geometric Unsharpness</strong></td>
      <td class="text-center align-middle">:</td>
      <td colspan="3" class="align-middle">
        <?= @$report_detail['geometric_unsharpness'] ?>  
      </td>
    </tr>

    <tr>
      <td colspan="11"></td>
      
    </tr>

    <tr>
      <td colspan="2" class="align-middle"><strong>Sch</strong></td>
      <td class="text-center align-middle">:</td>
      <td colspan="3" class="align-middle">
        <?= @$report_detail['part_sch'] ?>
      </td>

      <td class="align-middle"><strong>SFD</strong></td>
      <td class="text-center align-middle">:</td>
      <td colspan="3" class="align-middle">
        <?= @$report_detail['sfd'] ?>
      </td>
    </tr>

    <tr>
      <td colspan="11"></td>
    </tr>

    <tr>
      <td colspan="2" class="align-middle"><strong>Mat'l Type</strong></td>
      <td class="text-center align-middle">:</td>
      <td colspan="2" class="align-middle">
        <?= @$report_detail['part_mat_type'] ?>
      </td>
      <td></td>
      <td class="align-middle"><strong>Exposure</strong></td>
      <td class="text-center align-middle">:</td>
      <td colspan="3" class="align-middle">
        <?php $exposures = explode(';', $report_detail['exposure']) ?>
        <strong>Single Wall</strong> <input type="checkbox" name="exposure_1" value="Single Wall" <?= in_array('Single Wall', $exposures) ? 'checked' : '' ?>>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <strong>Double Wall</strong> <input type="checkbox" name="exposure_2" value="Double Wall" <?= in_array('Double Wall', $exposures) ? 'checked' : '' ?>>
      </td>
    </tr>

    <tr>
      <td colspan="6"></td>
      <td colspan="5"></td>
      <td rowspan="6" colspan="3">
        <img style="width: 100px" src="img/DWSV.jpg">
        <br>
        DWSV <input type="checkbox" name="image_radio[]" value='IMAGE_5' <?= in_array('IMAGE_5',explode(';', $report_detail['image_radio'])) ? 'checked' : '' ?>></td>
      <td rowspan="6" colspan="3">
        <img style="width: 100px" src="img/DWDV.jpg">
        <br>
        DWDV <input type="checkbox" name="image_radio[]" value='IMAGE_6' <?= in_array('IMAGE_6',explode(';', $report_detail['image_radio'])) ? 'checked' : '' ?>></td>
    </tr>

    <tr>
      <td colspan="2" class="align-middle"><strong>Mat'l Thk</strong></td>
      <td class="text-center align-middle">:</td>
      <td colspan="2" class="align-middle">
        <?= @$report_detail['part_mat_thk'] ?>
      </td>
      <td class="text-nowrap align-middle">
        <strong>In</strong> <input type="checkbox" name="part_mat_thk_uom" value="In" <?= $report_detail['part_mat_thk_uom']=='In' ? 'checked' : '' ?>>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <strong>mm</strong> <input type="checkbox" name="part_mat_thk_uom" value="mm" <?= $report_detail['part_mat_thk_uom']=='mm' ? 'checked' : '' ?>>
      </td>

      <td class="align-middle"><strong>Viewing</strong></td>
      <td class="text-center align-middle">:</td>
      <td colspan="3" class="align-middle">
        <?php //test_var($report_detail['viewing_condition'], 1) ?>
        <strong>Single Wall</strong> <input type="checkbox" name="viewing_condition[]" value="Single" <?= in_array('Single',explode(';', $report_detail['viewing_condition'])) ? 'checked' : '' ?>>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <strong>Double Wall</strong> <input type="checkbox" name="viewing_condition[]" value="Double" <?= in_array('Double',explode(';', $report_detail['viewing_condition'])) ? 'checked' : '' ?>>
      </td>
    </tr>

    <tr>
      <td colspan="6"></td>
      <td colspan="5"></td>

    </tr>

    <tr>
      <td colspan="2" class="align-middle"><strong>Weld Thk</strong></td>
      <td class="text-center align-middle">:</td>
      <td colspan="2" class="align-middle">
        <?= @$report_detail['part_weld_thk'] ?>
      </td>
      <td class="text-nowrap align-middle">
        <strong>In</strong> <input type="checkbox" name="part_weld_thk_uom" value="In" <?= $report_detail['part_weld_thk_uom']=='In' ? 'checked' : '' ?>>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <strong>mm</strong> <input type="checkbox" name="part_weld_thk_uom" value="mm" <?= $report_detail['part_weld_thk_uom']=='mm' ? 'checked' : '' ?>>
      </td>

      <td class="align-middle"><strong>Exposure Time</strong></td>
      <td class="text-cente align-middle">:</td>
      <td colspan="3" class="align-middle">
        <?= @$report_detail['exposure_time'] ?> <b>Mnt</b>
      </td>


    </tr>

    <tr>
      <td colspan="6"></td>
      <td colspan="5"></td>

    </tr>

    <tr>
      <td colspan="2" class="align-middle"><strong>Reinforc Thk</strong></td>
      <td class="text-center align-middle">:</td>
      <td colspan="2" class="align-middle">
        <?= @$report_detail['part_reinforce_thk'] ?>
      </td>
      <td class="text-nowrap align-middle">
        <strong>In</strong> <input type="checkbox" name="part_reinforce_thk_uom" value="In" <?= $report_detail['part_reinforce_thk_uom']=='In' ? 'checked' : '' ?>>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <strong>mm</strong> <input type="checkbox" name="part_reinforce_thk_uom" value="mm" <?= $report_detail['part_reinforce_thk_uom']=='mm' ? 'checked' : '' ?>>
      </td>

      <td class="align-middle"><strong>Min. SOD*</strong></td>
      <td class="text-center align-middle">:</td>
      <td colspan="1" class="align-middle">
        <?= @$report_detail['min_sod'] ?>
      </td>
      <td style="width: 50px" class="align-middle"><strong>Min. DDSOF** : </strong></td>
      <td colspan="1" class="align-middle">
        <?= @$report_detail['min_ddsof'] ?><b> mm</b>
      </td>
    </tr>
    <tr>
      <td colspan="6"></td>
      <td colspan="5"></td>
      <td rowspan="6" colspan="3">
        <img style="width: 100px" src="img/Superimpose.png">
        <br>
        DWDV <input type="checkbox" name="image_radio[]" value='IMAGE_7' <?= in_array('IMAGE_7',explode(';', $report_detail['image_radio'])) ? 'checked' : '' ?>></td>
      <td rowspan="6" colspan="3">
        <br><br><br><br><br><br><br><br>
        Others 
        <input type="checkbox" name="image_radio[]" value='IMAGE_8' <?= in_array('IMAGE_8',explode(';', $report_detail['image_radio'])) ? 'checked' : '' ?>></td>
    </tr>

    <tr>
      <td colspan="2"><strong>Backing Ring</strong></td>
      <td class="text-center">:</td>
      <td colspan="2">
      <td class="text-nowrap">
        <strong>Yes</strong> <input type="checkbox" name="backing_ring" value="Yes" <?= $report_detail['backing_ring']=='Yes' ? 'checked' : '' ?>>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <strong>No</strong> <input type="checkbox" name="backing_ring" value="No" <?= $report_detail['backing_ring']=='No' ? 'checked' : '' ?>>
      </td>

      <td><strong>No of Film in Holder</strong></td>
      <td class="text-center">:</td>
      <td colspan="3">

        <strong>Single </strong> <input type="checkbox" name="film_in_holder[]" value="Single" <?= in_array('Single',explode(';', $report_detail['film_in_holder'])) ? 'checked' : '' ?>>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <strong>Multiple </strong> <input type="checkbox" name="film_in_holder[]" value="Multiple" <?= in_array('Multiple',explode(';', $report_detail['film_in_holder'])) ? 'checked' : '' ?>>
      </td>
    </tr>
    <tr>
      <td class="text-center" colspan="6"><strong>FILM</strong></td>

      <td class="text-center" colspan="5"><strong>IMAGE QUALITY INDICATOR ( IQI )</strong>
      </td>
    </tr>

    <tr>
      <td colspan="2"><strong>Manufacture's</strong></td>
      <td>:</td>
      <td colspan="2">
        <?= @$report_detail['film_manufacture'] ?>
      </td>
      <td></td>
      <td colspan="5"><strong>Type of Penetrameter</strong></td>
    </tr>

    <tr>
      <td colspan="2"><strong>Type of Film</strong></td>
      <td>:</td>
      <td colspan="2">
        <?= @$report_detail['film_type'] ?>
      </td>
      <td></td>
      <td colspan="1">
        <strong>ASTM </strong> <input type="checkbox" name="penetrant[]" value="ASTM" <?= in_array('ASTM',explode(';', $report_detail['penetrant'])) ? 'checked' : '' ?>>
      </td>
      <td colspan="4">
        <strong>EN / DIN </strong> <input type="checkbox" name="penetrant[]" value="EN / DIN" <?= in_array('EN / DIN',explode(';', $report_detail['penetrant'])) ? 'checked' : '' ?>>
      </td>
    </tr>

    <tr>
      <td colspan="2"><strong>Dimension</strong></td>
      <td>:</td>
      <td colspan="3">
        <?= @$report_detail['film_dimension_1'] ?>
      <b>X</b>
        <?= @$report_detail['film_dimension_2'] ?>
      </td>
      <td colspan="1">
        <strong>Wire </strong> <input type="checkbox" name="wire_no[]" value="0" <?= in_array('0',explode(';', $report_detail['wire_no'])) ? 'checked' : '' ?>>
      </td>
      <td colspan="4">
        <strong>No : </strong>
        <strong>1</strong> <input type="checkbox" name="wire_no[]" value="1" <?= in_array('1',explode(';', $report_detail['wire_no'])) ? 'checked' : '' ?>>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <strong>2</strong> <input type="checkbox" name="wire_no[]" value="2" <?= in_array('2',explode(';', $report_detail['wire_no'])) ? 'checked' : '' ?>>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <strong>3</strong> <input type="checkbox" name="wire_no[]" value="3" <?= in_array('3',explode(';', $report_detail['wire_no'])) ? 'checked' : '' ?>>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <strong>4</strong> <input type="checkbox" name="wire_no[]" value="4" <?= in_array('4',explode(';', $report_detail['wire_no'])) ? 'checked' : '' ?>>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <strong>5</strong> <input type="checkbox" name="wire_no[]" value="5" <?= in_array('5',explode(';', $report_detail['wire_no'])) ? 'checked' : '' ?>>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <strong>6</strong> <input type="checkbox" name="wire_no[]" value="6" <?= in_array('6',explode(';', $report_detail['wire_no'])) ? 'checked' : '' ?>>
      </td>


    <tr>
      <td colspan="2"><strong>Type of Film</strong></td>
      <td>:</td>
      <td colspan="2">
        <?= @$report_detail['film_type_2'] ?>
      </td>
      <td></td>
      <td colspan="5">
      </td>
      <td colspan="6">
      </td>

    </tr>

    <tr>
      <td colspan="2"><strong>Total of Film</strong></td>
      <td>:</td>
      <td colspan="2">
        <?= @$report_detail['film_total'] ?>
      </td>
      <td><strong>Sheet(s)</strong></td>
      <td colspan="5">
      </td>
      <td colspan="6" class="text-center">
        <strong>Notes For Sketch :</strong>
      </td>

    </tr>

    <tr>
      <td class="text-center" colspan="6" rowspan="2"><strong>SCREEN</strong></td>
      <td><strong>Placement</strong></td>
      <td class="text-center">:</td>
      <td colspan="3">

        <strong>Source Side</strong> <input type="checkbox" name="placement[]" value="Source Side" <?= in_array('Source Side',explode(';', $report_detail['placement'])) ? 'checked' : '' ?>>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <strong>Film Side</strong> <input type="checkbox" name="placement[]" value="Film Side" <?= in_array('Film Side',explode(';', $report_detail['placement'])) ? 'checked' : '' ?>>
      </td>
      <td>1)</td>
      <td class="text-nowrap"><strong>SWSV =</strong></td>
      <td colspan="4"><strong></strong> Single Wall Single Viewing</td>

    </tr>

    <tr>
      <td><strong>Block Thickness</strong></td>
      <td class="text-center">:</td>
      <td colspan="3">
        <?= @$report_detail['block_thickness'] ?><b> mm</b>
      </td>

      <td>2)</td>
      <td class="text-nowrap"><strong>DWSV =</strong></td>
      <td colspan="4"><strong></strong> Double Wall Single Viewing</td>
    </tr>

    <tr>
      <td colspan="2"><strong>Lead</strong></td>
      <td colspan="2">
        <strong>Front</strong> <input type="checkbox" name="screen_lead" value="Front" <?= $report_detail['screen_lead']=='Front' ? 'checked' : '' ?>>
      </td>
      <td colspan="2">
        <strong>Back</strong> <input type="checkbox" name="screen_lead" value="Back" <?= $report_detail['screen_lead']=='Back' ? 'checked' : '' ?>>
      </td>
      <td class="text-center" colspan="5" rowspan="2">
        <b>MARKER PLACEMENT</b>
      </td>
      <td>3)</td>
      <td class="text-nowrap"><strong>DWDV =</strong></td>
      <td colspan="4"><strong></strong> Double Wall Double Viewing</td>
    </tr>

    <tr>
      <td colspan="6"></td>

      <td>4)</td>
      <td class="text-nowrap"><strong>Other =</strong></td>
      <td colspan="4"><strong></strong> Other than listed ( Please Sketch )</td>
    </tr>

    <tr>
      <td colspan="2"><strong>Thickness</strong></td>
      <td colspan="2">
        <strong>In</strong> <input type="checkbox" name="screen_thickness" value="In" <?= $report_detail['screen_thickness']=='In' ? 'checked' : '' ?>>
      </td>
      <td colspan="2">
        <strong>mm</strong> <input type="checkbox" name="screen_thickness" value="mm" <?= $report_detail['screen_thickness']=='mm' ? 'checked' : '' ?>>
      </td>
      <td colspan="1">
      </td>
      <td colspan="2">
        <strong>Source Side</strong>
        <input type="checkbox" name="marker_side[]" value="Source Side" <?= in_array('Source Side',explode(';', $report_detail['marker_side'])) ? 'checked' : '' ?>>
      </td>
      <td colspan="2">
        <strong>Film Side</strong>
        <input type="checkbox" name="marker_side[]" value="Film Side" <?= in_array('Film Side',explode(';', $report_detail['marker_side'])) ? 'checked' : '' ?>>
      </td>

      <td></td>
      <td class="text-nowrap"><strong style="float: right"> =</strong></td>
      <td colspan="4"><strong></strong> </td>

    </tr>

    <tr>
      <td colspan="6"></td>
      <td><strong>Use back scatter</strong></td>
      <td colspan="2">
        <strong>Yes</strong>
        <input type="checkbox" name="use_back_scatter" value="Yes" <?= $report_detail['use_back_scatter']=='Yes' ? 'checked' : '' ?>>
      </td>
      <td colspan="2">
        <strong>No</strong>
        <input type="checkbox" name="use_back_scatter" value="No" <?= $report_detail['use_back_scatter']=='No' ? 'checked' : '' ?>>
      </td>
      <td colspan="6"></td>
    </tr>
  </table>

  </header>
  
  <footer>
    <table border="1" style="border-collapse: collapse;" width="100%">
      <tr>
        <td height="50px"> Note:
          <br>&nbsp;&nbsp;&nbsp;
          <?= '- '.$report_detail['note'] ?>
        </td>

      </tr>
    </table>
    <br>
    <table border="1" style="border-collapse: collapse;" width="100%">
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

  <br>
  <?php if(1==3){ ?>
  <table border="1" style="border-collapse: collapse;" width="100%">
    <tr>
      <th class="text-center align-middle" rowspan="2"><strong>S/N</strong></th>
      <th class="text-center align-middle" rowspan="2"><strong>Weld Map Dwg / Line & Spool No.</strong></th>
      <th class="text-center align-middle" rowspan="2"><strong>Joint No.</strong></th>
      <th class="text-center align-middle" rowspan="2"><strong>Inspection Category</strong></th>
      <th class="text-center align-middle" rowspan="2"><strong>Total Length (mm)</strong></th>
      <th class="text-center align-middle" rowspan="2"><strong>Tested Length (mm)</strong></th>
      <th class="text-center align-middle" rowspan="2"><strong>Welding Process</strong></th>
      <th class="text-center align-middle" rowspan="2"><strong>Welder ID</strong></th>
      <th class="text-center align-middle" colspan="2"><strong>Result</strong></th>
      <th class="text-center align-middle" colspan="3"><strong>Density</strong></th>
      <th class="text-center align-middle" rowspan="2"><strong>Sensitivity</strong></th>
      <th class="text-center align-middle" rowspan="2"><strong>Discontinuities Type</strong></th>
      <th class="text-center align-middle" rowspan="2"><strong>Remark</strong></th>
    </tr>
    <tr>
      <th class="text-center align-middle">ACC</th>
      <th class="text-center align-middle">REJECT</th>
      <th class="text-center align-middle">IQI</th>
      <th class="text-center align-middle">MAX</th>
      <th class="text-center align-middle">MIN</th>
    </tr>
    <tbody>
    <?php $no=0;foreach ($joint_list as $key => $value) { ?>
      <?php //test_var($joint_list); ?>
      <tr>
        <td class="text-center align-middle"><?= $no+1 ?></td>
        <td class="text-center align-middle"><?= $value[0]['drawing_wm'] ?></td>
        <td class="text-center align-middle">
          <?= $value[0]['joint_no'].($value[0]['revision']>0 ? '('.$value[0]['revision_category'].$value[0]['revision'].')' : '') ?>
        </td>
        <td class="text-center align-middle"><?= $class[$value[0]['class']] ?></td>
        <td class="text-center align-middle"><?= number_format($value[0]['total_length'], 2) ?></td>
        <td class="text-center align-middle"><?= number_format($value[0]['tested_length'], 2) ?></td>
        <td rowspan="<?= count($value) ?>"class="align-middle text-center">
        <?php 
          $value[0]['gtaw'] == 1 ? print_r(strtoupper("gtaw").', ') : '';
          $value[0]['gmaw'] == 1 ? print_r(strtoupper("gmaw").', ') : '';
          $value[0]['smaw'] == 1 ? print_r(strtoupper("smaw").', ') : '';
          $value[0]['fcaw'] == 1 ? print_r(strtoupper("fcaw").', ') : '';
          $value[0]['saw'] == 1 ? print_r(strtoupper("saw").', ') : '';
        ?>    
        </td>
        <td rowspan="<?= count($value) ?>"class="align-middle text-center">
          <?php  
            $welder = explode(';', $value[0]['welder']);
            foreach ($welder as $key => $value_welder) {
              print_r($welder_id[$value_welder].', ');
            }
          ?>
        </td>
        <td rowspan="<?= count($value) ?>" class="align-middle text-center">
          <?= $value[0]['result']==3 ? 'Approved' : '-' ?>
        </td>
        <td rowspan="<?= count($value) ?>" class="align-middle text-center">
          <?= $value[0]['result']==2 ? 'Rejected' : '-' ?>
        </td>

        <td class="text-center align-middle">
          <?= $value[0]['density_iqi'] ?>
        </td>
        
        <td class="text-center align-middle">
          <?= $value[0]['density_max'] ?>
        </td>
        
        <td class="text-center align-middle">
          <?= $value[0]['density_min'] ?>
        </td>
        
        <td class="text-center align-middle">
          <?= $value[0]['sensitivity'] ?>
        </td>
        
        <td class="text-center align-middle">
          <?= $value[0]['discontinue_type'] ?>  
        </td>

        <td>
          <?= $value[0]['remarks'] ?>    
        </td>

      </tr>
    <?php } ?>
      <tr>
        <td colspan="16">
          <?= @$report_detail['note'] ?>
        </td>
      </tr>
    </tbody>
  </table>
  <br>
  <?php } ?>
</body>

</html>