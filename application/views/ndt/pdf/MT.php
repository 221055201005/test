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

  </style>
  
</head>
<body>
  <header>
    <table width="100%" border="0.01px" style="border-collapse: collapse;">
      <tr>
          <th style="text-align: center; vertical-align: middle;" colspan="17"><img src="img/header_report.png" style="width: 460px">
          </th>
        </tr>
        <tr>
          <th class="text-center align-middle" colspan="9" rowspan="2">
            <h3>MAGNETIC PARTICLE INSPECTION<br>REPORT</h3>
          </th>
          <th colspan="2" style="text-align: left">Report No.</th>
          <th colspan="1" >:</th>
          <th colspan="5" width="200px" style="text-align: left">
            <?= $project[$list_detail[0]['project_code']]['project_ref'].'-OCP-SMO-'.strtoupper($type_of_module_list[$list_detail[0]['type_of_module']]['code']).'-'.strtoupper($discipline_list[$list_detail[0]['discipline']]['initial']).'-NDT-'.$initial.'-'.str_pad($list_detail[0]['report_number'],4,0, STR_PAD_LEFT) ?>
          </th>
        </tr>
        <tr>
          <th colspan="2" style="text-align: left">Page No</th>
          <th colspan="1"  width="0.5%">:</th>
          <th colspan="5" style="text-align: left"></th>
        </tr>
        <tr>
          <th colspan="3" style="text-align: left">Client</th>
          <th colspan="1"  width="50px">:</th>
          <th colspan="5" style="text-align: left"><?= $project[$list_detail[0]['project_code']]['client'] ?></th>

          <th colspan="2" style="text-align: left">RFI No.</th>
          <th colspan="1" >:</th>
          <th colspan="5" style="text-align: left"><?= $project[$list_detail[0]['project_code']]['project_ref'].'-OCP-SMO-'.strtoupper($type_of_module_list[$list_detail[0]['type_of_module']]['code']).'-'.strtoupper($discipline_list[$list_detail[0]['discipline']]['initial']).'-NDT-RFI-'.$initial.'-'.str_pad($list_detail[0]['ndt_rfi'],4,0, STR_PAD_LEFT) ?></th>
        </tr>
        <tr>
          <th colspan="3" style="text-align: left">Project</th>
          <th colspan="1" >:</th>
          <th colspan="5" style="text-align: left"><?= $project[$list_detail[0]['project_code']]['project_name'] ?></th>

          <th colspan="2" style="text-align: left">Date of Inspection</th>
          <th colspan="1" >:</th>
          <th colspan="5" style="text-align: left"><?= DATE('Y-m-d', strtotime($list_detail[0]['date_of_inspection'])) ?></th>
        </tr>
        <tr>
          <th colspan="3" style="text-align: left">Standard / Code</th>
          <th colspan="1" >:</th>
          <th colspan="5" style="text-align: left">
            <?= $list[0]['discipline']==2 ? 'DNVGL-CG-0051 / BS EN ISO 17638' : 'ASME B31.3' ?>
          </th>

          <th colspan="2" style="text-align: left">Testing Location</th>
          <th colspan="1" >:</th>
          <th colspan="5" style="text-align: left">
            <?= $report_detail['testing_location'] ?>
          </th>
        </tr>

        <tr>
          <th colspan="3" rowspan="2" style="text-align: left">Acceptance Criteria</th>
          <th colspan="1" rowspan="2" >:</th>
          <th colspan="5" style="text-align: left">
            <?php if($list[0]['discipline']==1){ ?>
              ASME B31.3 Paragraph 344.4.2
            <?php } else { ?>
              <?= $list_detail[0]['class']==1 ? 'ISO 5817 LEVEL B' : 'ISO 5817 LEVEL C' ?>
            <?php } ?>
          </th>

          <th colspan="2" rowspan="2" style="text-align: left">PWHT</th>
          <th colspan="1" rowspan="2" >:</th>
          <th colspan="5" rowspan="2" style="text-align: left">
            <?= @$list[0]['pwht_status']==1 ? 'YES' : 'NO' ?>
          </th>
        </tr>
        <tr>
          <th colspan="5" style="text-align: left">
            <?php if($list[0]['discipline']==1){ ?>
              ASME B31.3 Paragraph 344.3.2
            <?php } else { ?>
              <?= $list_detail[0]['class']==1 ? 'ISO 23278 ACCEPTANCE LEVEL 2X' : 'ISO 23278 ACCEPTANCE LEVEL 2X' ?>
            <?php } ?>
          </th>
        </tr>
        <tr>
          <th colspan="3" style="text-align: left">Procedure No.</th>
          <th colspan="1" >:</th>
          <th colspan="5" style="text-align: left"><?= $list[0]['discipline']==2 ? 'SCM-SOF-SMOE-23-PR-0007': 'SCM-SOF-SMOE-23-PR-0011' ?></th>

          <th colspan="2" style="text-align: left">Job No.</th>
          <th colspan="1" >:</th>
          <th colspan="5" style="text-align: left"><?= @$report_detail['job_no'] ?></th>
        </tr>
        <tr>
          <th colspan="3" style="text-align: left">GA/ASSY/ISO<br>Drawing No.</th>
          <th colspan="1" >:</th>
          <th colspan="5" style="text-align: left"><?= $list[0]['drawing_no'] ?></th>

          <th colspan="2" style="text-align: left">Item Tested</th>
          <th colspan="1" >:</th>
          <th colspan="5" style="text-align: left"><?= @$report_detail['item_tested'] ?></th>
        </tr>
        <tr>
          <th colspan="3" rowspan="1" style="text-align: left">Job Description</th>
          <th colspan="1" rowspan="1" >:</th>
          <th colspan="5" rowspan="1" style="text-align: left">
            <?= @$report_detail['job_description'] ?>
          </th>

          <th colspan="2" rowspan="1" style="text-align: left">Viewing Condition</th>
          <th colspan="1" rowspan="1" >:</th>
          <th colspan="5" rowspan="1" style="text-align: left"><?= @$report_detail['viewing_condition'] ?></th>
        </tr>

        <tr>
          <th  colspan="3" rowspan="4">Type of Magnetization<br>Equipment User</th>
          <th rowspan="1" colspan="1" style="text-align: left">Brand :</th>
          <th colspan="5"><?= @$report_detail['brand'] ?></th>

          <th colspan="2" rowspan="1" style="text-align: left">Surface Condition</th>
          <th colspan="1" rowspan="1" >:</th>
          <th colspan="5" rowspan="1" style="text-align: left"><?= @$report_detail['surface_condition'] ?></th>
        </tr>

        <tr>
          <th rowspan="1" colspan="1" style="text-align: left">Model :</th>
          <th colspan="5"><?= @$report_detail['model'] ?></th>

          <th colspan="2" rowspan="1" style="text-align: left">Surface Temperature</th>
          <th colspan="1" rowspan="1" >:</th>
          <th colspan="5" rowspan="1" style="text-align: left"><?= @$report_detail['temperature'] ?></th>
        </tr>

        <tr>
          <th rowspan="1" colspan="1" style="text-align: left">Serial No :</th>
          <th colspan="5"><?= @$report_detail['serial_no'] ?></th>

          <th colspan="2" rowspan="1" style="text-align: left">Applying Current</th>
          <th colspan="1" rowspan="1" >:</th>
          <th colspan="2" rowspan="1" style="text-align: left; vertical-align: middle">
            &nbsp;&nbsp;&nbsp;
            <div style="display:inline-block;">
              <input id="con" class="checkmark" type="checkbox" name="applying_current" value="continuous" <?= $report_detail['applying_current']=='continuous' ? 'checked' : '' ?>>
              <label for="con">&nbsp;&nbsp;&nbsp;Continuous</label>
            </div>
            
          </th>
          <th colspan="2" rowspan="1"  style="text-align: left; vertical-align: middle">
            &nbsp;&nbsp;&nbsp;
            <div style="display:inline-block;">
              <input class="checkmark" type="checkbox" name="applying_current" value="residual" <?= $report_detail['applying_current']=='residual' ? 'checked' : '' ?>>
              <label>&nbsp;&nbsp;&nbsp;Residual</label>
            </div>
          </th>
          <th></th>
        </tr>

        <tr>
          <th rowspan="1" colspan="1" style="text-align: left">Sensitivity :</th>
          <th colspan="5"><?= @$report_detail['sensitivity'] ?></th>

          <th colspan="2" rowspan="1" style="text-align: left">Magnetic Current</th>
          <th colspan="1" rowspan="1" >:</th>
          <th colspan="2" rowspan="1" style="text-align: left; vertical-align: middle">
            &nbsp;&nbsp;&nbsp;
            <div style="display:inline-block;">
              <input class="checkmark" type="checkbox" name="magnetic_current" value="ac"
              <?= $report_detail['magnetic_current']=='ac' ? 'checked' : '' ?>> <label>&nbsp;&nbsp;&nbsp;AC</label>
            </div>
          </th>
          <th colspan="2" rowspan="1" style="text-align: left; vertical-align: middle">
            &nbsp;&nbsp;&nbsp;
            <div style="display:inline-block;">
              <input class="checkmark" type="checkbox" name="magnetic_current" value="dc"
              <?= $report_detail['magnetic_current']=='dc' ? 'checked' : '' ?>>
              <label>&nbsp;&nbsp;&nbsp;DC</label>
            </div>
          </th>
          <th></th>
        </tr>

        <tr>
          <th colspan="3" style="text-align: left">Delivery Condition</th>
          <th colspan="1" >:</th>
          <th colspan="5" style="text-align: left"><?= @$report_detail['delivery_condition'] ?></th>

          <th colspan="2" style="text-align: left">Consumable Brand</th>
          <th colspan="1" >:</th>
          <th colspan="5" style="text-align: left"><?= @$report_detail['cosumable_brand'] ?></th>
        </tr>

        <tr>
          <th colspan="3" style="text-align: left">Grade Material</th>
          <th colspan="1" >:</th>
          <th colspan="5" style="text-align: left"><?= @$report_detail['grade_material'] ?></th>

          <th colspan="2" style="text-align: left">Batch Number</th>
          <th colspan="1" >:</th>
          <th colspan="5" style="text-align: left"><?= @$report_detail['batch_number'] ?></th>
        </tr>

        <tr>
          <th colspan="3" style="text-align: left">Testing Personnel</th>
          <th colspan="1" >:</th>
          <th colspan="5" style="text-align: left"><?= @$report_detail['testing_personnel'] ?></th>

          <th colspan="2" style="text-align: left">Medium</th>
          <th colspan="1" >:</th>
          <th colspan="5" style="text-align: left"><?= @$report_detail['medium'] ?></th>
        </tr>

        <tr>
          <th colspan="3" style="text-align: left">Certificate No.</th>
          <th colspan="1" >:</th>
          <th colspan="5" style="text-align: left"><?= @$report_detail['certificate_no'] ?></th>

          <th colspan="2" style="text-align: left">Background</th>
          <th colspan="1" >:</th>
          <th colspan="5" style="text-align: left"><?= @$report_detail['background'] ?></th>
        </tr>

        <tr>
          <th colspan="9" rowspan="3" class="align-top">
            <?= @$report_detail['acceptable_to_pecification'] ?>
          </th>

          <th colspan="2" style="text-align: left">Demagnetization</th>
          <th colspan="1" >:</th>
          <th colspan="2" rowspan="1" style="text-align: left; vertical-align: middle">
            &nbsp;&nbsp;&nbsp;
            <div style="display:inline-block;">
              <input class="checkmark" type="checkbox" name="demagnetization" value="yes"
              <?= $report_detail['demagnetization']=='yes' ? 'checked' : '' ?>>
              <label>&nbsp;&nbsp;&nbsp;YES</label>
            </div>
          </th>
          <th colspan="2" rowspan="1" style="text-align: left; vertical-align: middle">
            &nbsp;&nbsp;&nbsp;
            <div style="display:inline-block;">
              <input class="checkmark" type="checkbox" name="demagnetization" value="no"
              <?= $report_detail['demagnetization']=='no' ? 'checked' : '' ?>> 
              <label>&nbsp;&nbsp;&nbsp;NO</label>
            </div>
          </th>
          <th></th>
        </tr>

        <tr>
          <th colspan="2" style="text-align: left">Applicable Partcicle</th>
          <th colspan="1" >:</th>
          <th colspan="2" rowspan="1" style="text-align: left">
            &nbsp;&nbsp;&nbsp;
            <div style="display:inline-block;">
              <input class="checkmark" type="checkbox" name="applicable_particle" value="wet"
                <?= $report_detail['applicable_particle']=='wet' ? 'checked' : '' ?>>
              <label>&nbsp;&nbsp;&nbsp;WET</label>
            </div>
          </th>
          <th colspan="2" rowspan="1" style="text-align: left">
            &nbsp;&nbsp;&nbsp;
            <div style="display:inline-block;">
              <input class="checkmark" type="checkbox" name="applicable_particle" value="dry"
              <?= $report_detail['applicable_particle']=='dry' ? 'checked' : '' ?>>
              <label>&nbsp;&nbsp;&nbsp;DRY</label>
            </div>
          </th>
          <th></th>
        </tr>

        <tr>
          <th colspan="2" style="text-align: left">Yoke Expire Calibration Date</th>
          <th colspan="1" >:</th>
          <th colspan="5" rowspan="1" style="text-align: left">
            <?= $report_detail['yoke_expire_calibration_date']>0 ? DATE('Y-m-d', strtotime($report_detail['yoke_expire_calibration_date'])) : '-' ?>
          </th>
        </tr>
    </table>
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
  <br>
  <table width="100%" border="1px" style="border-collapse: collapse !important;">
    <thead>

      <tr>
        <th rowspan="2" width="30px">S/N</th>
        <th rowspan="2">Weld Map Dwg / Line & Spool No</th>
        <th rowspan="2">Joint No</th>
        <th rowspan="2">Joint Type</th>

        <th rowspan="2">
        <?php if($list_detail[0]['discipline']==1){
          echo "Size<br>(mm)";
        } else {
          echo "Dia<br>(inch)";
        } ?>
        </th>

        <th rowspan="2">Sch</th>
        <th rowspan="2">Thk<br>(mm)</th>
        <th rowspan="2">Total Length<br>(mm)</th>
        <th rowspan="2">Tested Length<br>(mm)</th>
        <th rowspan="2">Welding Process</th>
        <th rowspan="2" width="50px">Welder ID</th>
        <th rowspan="2">Result</th>
        <th colspan="3" rowspan="1">Type of Discontinuites</th>
        <th rowspan="2">Inspection Category</th>
        <th rowspan="2">Remarks</th>
      </tr>

      <tr>
        <th rowspan="1">Deffect Length<br>(mm)</th>
        <th rowspan="1">Deffect Type</th>
        <th rowspan="1">Distance from Datum<br>(mm)</th>
      </tr>
    </thead>
    <tbody style="text-align: center !important; vertical-align: middle;">
      
      <?php $no = 1; foreach ($joint_list as $key => $value) {?>
      <tr >
        <td style="text-align: center !important; vertical-align: middle;" rowspan="<?= count($value) ?>">
          <?= $no++ ?>
        </td>

        <td style="text-align: center !important; vertical-align: middle;" rowspan="<?= count($value) ?>"><?= $value[0]['drawing_wm'] ?>
        </td>
        <td style="text-align: center !important; vertical-align: middle;" rowspan="<?= count($value) ?>">
          <?= $value[0]['joint_no'].$value[0]['revision_category'].$value[0]['revision'] ?></td>
        <td style="text-align: center !important; vertical-align: middle;" rowspan="<?= count($value) ?>">
          <?= $joint_type[$value[0]['joint_type']] ?></td>
        <td style="text-align: center !important; vertical-align: middle;" rowspan="<?= count($value) ?>"><?= $value[0]['diameter'] ?>
        </td>
        <td style="text-align: center !important; vertical-align: middle;" rowspan="<?= count($value) ?>"><?= $value[0]['sch'] ?></td>
        <td style="text-align: center !important; vertical-align: middle;" rowspan="<?= count($value) ?>"><?= (int)$value[0]['thk'] ?>
        </td>
        <td style="text-align: center !important; vertical-align: middle;" rowspan="<?= count($value) ?>"><?= $value[0]['total_length'] ?>
        </td>

        <td style="text-align: center !important; vertical-align: middle;" rowspan="<?= count($value) ?>">
          <?= $value[0]['tested_length'] ?></td>

        <td style="text-align: center !important; vertical-align: middle;" rowspan="<?= count($value) ?>">
          <?php 
          $value[0]['gtaw'] == 1 ? print_r(strtoupper("gtaw").', ') : '';
          $value[0]['gmaw'] == 1 ? print_r(strtoupper("gmaw").', ') : '';
          $value[0]['smaw'] == 1 ? print_r(strtoupper("smaw").', ') : '';
          $value[0]['fcaw'] == 1 ? print_r(strtoupper("fcaw").', ') : '';
          $value[0]['saw'] == 1 ? print_r(strtoupper("saw").', ') : '';
        ?>
        </td>

        <td style="text-align: center !important; vertical-align: middle;" rowspan="<?= count($value) ?>">
          <?php  
            $welder = explode(';', $value[0]['welder']);
            foreach ($welder as $key => $value_welder) {
              print_r($welder_id[$value_welder].', ');
            }
          ?>
        </td>

        <td style="text-align: center !important; vertical-align: middle;" rowspan="<?= count($value) ?>">
          <?= $value[0]['result']==3 ? 'Approved' : ( $value[0]['result']==2 ? 'Rejected' : '-') ?>
        </td>

        <?php foreach($value as $d): ?>
          <td style="text-align: center !important; vertical-align: middle;"><?= $d['deffect_length'] ?></td>
          <td style="text-align: center !important; vertical-align: middle;"><?= $ctq_initial[$d['id_deffect']] ?></td>
          <td style="text-align: center !important; vertical-align: middle;"><?= $d['datum'] ?></td>
          <td style="text-align: center !important; vertical-align: middle;"><?= $class[$d['class']] ?></td>
          <td style="text-align: center !important; vertical-align: middle;"></td>
        </tr>
        <?php endforeach; ?>
      </tr>
      <?php } ?>
    </tbody>
  </table>
  <br>
</body>

</html>