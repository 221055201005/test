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
      /*      border-radius: 25px;*/
      border: 1px solid;
      padding: 10px;
      box-shadow: 5px 10px;
      width: 100%;
    }

    #example2 {
      /*      border-radius: 25px;*/
      border: 1px solid;
      padding: 10px;
      box-shadow: 5px 10px;
      width: 100%;
    }
  </style>
  <div id="content" class="container-fluid overflow-auto">

    <!-- TAB -->
    <div class="row">
      <div class="col-md-12">
        <div class="card rounded-0 shadow">
          <div class="card-header">
            <h6 class="card-title m-0"> NDT List - <strong><?= $method ?></strong></h6>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#joint_detail">Report</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu1">Deffect</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu2">Attachment</a>
                  </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">

                  <div id="joint_detail" class="container tab-pane  col-md-12 active"><br>
                    <div class="row">
                      <div class="col-md-12">
                        <br />
                        <center>
                          <div id='example1'>
                            <form action="<?= base_url("ndt_live/update_ndt_pt") ?>" method="POST">
                              <input type="hidden" name="uniq_id_report" value="<?= $main['uniq_id_report'] ?>">

                              <table border="0px" style="border-collapse: collapse !important;padding:10px;" width="100%">
                                <tr colspan="17">
                                  <td style="text-align: left; padding: 5px;width: 20% !important;vertical-align: middle !important;">
                                    <img src="<?= base_url() ?>img/seatrium-logo.png" style="width: 170px; zoom: 2;">
                                  </td>
                                  <td style="text-align: center; padding: 5px;width: 60% !important;vertical-align: middle !important;">
                                    <h3><?= $project['description'] ?></h3>
                                  </td>
                                  <td style="text-align: right; padding: 5px;width: 20% !important;vertical-align: middle !important;">
                                    <img src="<?= $project['client_logo'] ?>" style="width: 120px;">
                                  </td>
                                </tr>
                              </table>

                              <table border="1px" style="border-collapse: collapse !important;padding:20px !important;" width="100%">
                                <tr>
                                  <td colspan="10" rowspan="3" width="350px">
                                    <h3>DYE PENETRANT INSPECTION<br>REPORT</h3>
                                  </td>

                                  <td colspan="2" style="border-left: none; border-right: none; text-align: left !important;">Report No.</td>
                                  <td colspan="1" style="border-left: none; border-right: none; ">:</td>
                                  <td colspan="4" style="border-left: none; border-right: none; text-align: left !important;"><input class="form-control" type="text" value="<?= $main["rfi_no"] ?>" name="rfi_no"></td>
                                </tr>

                                <tr>
                                  <td colspan="2" style="border-left: none; border-right: none; ">Page No</td>
                                  <td colspan="1" style="border-left: none; border-right: none; ">:</td>
                                  <td colspan="4" style="border-left: none; border-right: none; ">1 OF 1</td>
                                </tr>

                                <tr>
                                  <td colspan="2" style="border-left: none; border-right: none; ">RFI No.</td>
                                  <td colspan="1" style="border-left: none; border-right: none; ">:</td>
                                  <td colspan="4" style="border-left: none; border-right: none; "><input class="form-control" type="text" value="<?= $main["rfi_no"] ?>" name="rfi_no"></td>
                                </tr>

                                <tr>
                                  <td colspan="3" style="border-left: none; border-right: none; ">Client</td>
                                  <td colspan="1" style="border-left: none; border-right: none; ">:</td>
                                  <td colspan="6" style="border-left: none; "><?= $project['client'] ?></td>

                                  <td colspan="2" style="border-right: none; ">Date of Inspection</td>
                                  <td colspan="1" style="border-left: none; border-right: none; ">:</td>
                                  <td colspan="4" style="border-left: none; border-right: none; "><input class="form-control" type="date" value="<?= DATE("Y-m-d", strtotime($main["date_of_inspection"])) ?>" name="date_of_inspection"></td>
                                </tr>

                                <tr>
                                  <td colspan="3" style="border-left: none; border-right: none; ">Project</td>
                                  <td colspan="1" style="border-left: none; border-right: none; ">:</td>
                                  <td colspan="6" style="border-left: none; "><?= $project['project_name'] ?></td>

                                  <td colspan="2" style="border-right: none; ">Testing Location</td>
                                  <td colspan="1" style="border-left: none; border-right: none; ">:</td>
                                  <td colspan="4" style="border-left: none; border-right: none; "><input class="form-control" type="text" value="<?= $main["rfi_no"] ?>" name="rfi_no"></td>
                                </tr>

                                <tr>
                                  <td colspan="3" style="border-left: none; border-right: none; ">Standard / Code</td>
                                  <td colspan="1" style="border-left: none; border-right: none; ">:</td>
                                  <td colspan="6" style="border-left: none; "><?= $acceptance_criteria_form[$main['id_project']][$joint[$main['id_joint']]['company_id']][$main['discipline']][$main['module']][$main['type_of_module']][$joint[$main['id_joint']]['class']]['ndt']['pt']['standard_code'] ?></td>

                                  <td colspan="2" style="border-right: none; ">Job No.</td>
                                  <td colspan="1" style="border-left: none; border-right: none; ">:</td>
                                  <td colspan="4" style="border-left: none; border-right: none; "><input class="form-control" type="text" value="<?= $main["job_no"] ?>" name="job_no"></td>
                                </tr>

                                <tr>
                                  <td colspan="3" style="border-left: none; border-right: none; ">Acceptance Criteria</td>
                                  <td colspan="1" style="border-left: none; border-right: none; ">:</td>
                                  <td colspan="6" style="border-left: none; "><?= $acceptance_criteria_form[$main['id_project']][$joint[$main['id_joint']]['company_id']][$main['discipline']][$main['module']][$main['type_of_module']][$joint[$main['id_joint']]['class']]['ndt']['pt']['acceptance_criteria'] ?></td>

                                  <td colspan="2" style="border-right: none; ">Item Tested</td>
                                  <td colspan="1" style="border-left: none; border-right: none; ">:</td>
                                  <td colspan="4" style="border-left: none; border-right: none; "><input class="form-control" type="text" value="<?= $main["item_tested"] ?>" name="item_tested"></td>
                                </tr>

                                <tr>
                                  <td colspan="3" style="border-left: none; border-right: none; ">Procedure No.</td>
                                  <td colspan="1" style="border-left: none; border-right: none; ">:</td>
                                  <td colspan="6" style="border-left: none; "><?= $acceptance_criteria_form[$main['id_project']][$joint[$main['id_joint']]['company_id']][$main['discipline']][$main['module']][$main['type_of_module']][$joint[$main['id_joint']]['class']]['ndt']['pt']['procedure'] ?></td>

                                  <td colspan="2" style="border-right: none; ">Grade Material</td>
                                  <td colspan="1" style="border-left: none; border-right: none; ">:</td>
                                  <td colspan="4" style="border-left: none; border-right: none; "><input class="form-control" type="text" value="<?= $main["grade_material"] ?>" name="grade_material"></td>
                                </tr>

                                <tr>
                                  <td colspan="3" style="border-left: none; border-right: none; ">GA/ASSY/ISO Drawing No.</td>
                                  <td colspan="1" style="border-left: none; border-right: none; ">:</td>
                                  <td colspan="6" style="border-left: none; "><?= $master_joint[0]['drawing_no'] . ' Rev. ' . intval($master_joint[0]['transmit_gaas_rev']) ?></td>

                                  <td colspan="2" style="border-right: none; ">Delivery Condition</td>
                                  <td colspan="1" style="border-left: none; border-right: none; ">:</td>
                                  <td colspan="4" style="border-left: none; border-right: none; "><input class="form-control" type="text" value="<?= $main["delivery_condition"] ?>" name="delivery_condition"></td>
                                </tr>

                                <tr>
                                  <td colspan="3" rowspan="2" style="border-left: none; border-right: none; ">Job Description</td>
                                  <td colspan="1" rowspan="2" style="border-left: none; border-right: none; ">:</td>
                                  <td colspan="6" rowspan="2" style="border-left: none; "><input class="form-control" type="text" value="<?= $main["job_description"] ?>" name="job_description"></td>
                                  <td colspan="2" style="border-right: none; ">Technician</td>
                                  <td colspan="1" style="border-left: none; border-right: none; ">:</td>
                                  <td colspan="4" style="border-left: none; border-right: none; "><input class="form-control" type="text" value="<?= $main["technichian"] ?>" name="technichian"></td>
                                </tr>

                                <tr>
                                  <td colspan="2" style="border-right: none; ">Certificate No.</td>
                                  <td colspan="1" style="border-left: none; border-right: none; ">:</td>
                                  <td colspan="4" style="border-left: none; border-right: none; "><input class="form-control" type="text" value="<?= $main["certificate_no"] ?>" name="certificate_no"></td>
                                </tr>

                                <!--  -->

                                <tr>
                                  <td colspan="3" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">Penetrant System</td>
                                  <td colspan="1" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">:</td>
                                  <td colspan="5" style="border-left: none; border-right: none; border-bottom: none; border-top: none;"><input type="radio" value="1" name="penetrant_system" <?= $main["penetrant_system"] == 1 ? 'checked' : '' ?>>Coloured</td>
                                  <td colspan="8" style="border-left: none; border-right: none; border-bottom: none; border-top: none;"><input type="radio" value="2" name="penetrant_system" <?= $main["penetrant_system"] == 2 ? 'checked' : '' ?>>Fluorescent</td>
                                </tr>

                                <tr>
                                  <td colspan="3" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">Penetrant Type / Method</td>
                                  <td colspan="1" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">:</td>
                                  <td colspan="5" style="border-left: none; border-right: none; border-bottom: none; border-top: none;"><input type="checkbox" value="1" name="penetrant_type[]" <?= in_array(1, explode(";", $main["penetrant_type"])) ? 'checked' : '' ?>>Visible</td>
                                  <td colspan="3" style="border-left: none; border-right: none; border-bottom: none; border-top: none;"><input type="checkbox" value="2" name="penetrant_type[]" <?= in_array(2, explode(";", $main["penetrant_type"])) ? 'checked' : '' ?>>Solvent Removable</td>
                                  <td colspan="5" style="border-left: none; border-right: none; border-bottom: none; border-top: none;"><input type="checkbox" value="3" name="penetrant_type[]" <?= in_array(3, explode(";", $main["penetrant_type"])) ? 'checked' : '' ?>>Other <input class="form-control" type="text" name="penetrand_type_other" value="<?= $main['penetrand_type_other'] ?>" style="width: 82% !important"></td>
                                </tr>

                                <tr>
                                  <td colspan="3" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">Brand's Name / Type</td>
                                  <td colspan="1" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">:</td>
                                  <td colspan="4" style="border-left: none; border-right: none; border-bottom: none; border-top: none;"><input class="form-control" type="text" name="brand_name" value="<?= $main["brand_name"] ?>" style="width: 90% !important"></td>
                                  <td colspan="1" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">Penetrant</td>
                                  <td colspan="2" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">: <input class="form-control" type="text" name="penetran" value="<?= $main["penetran"] ?>" style="width: 90% !important"></td>
                                  <td colspan="1" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">Cleaner</td>
                                  <td colspan="2" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">: <input class="form-control" type="text" name="cleaner" value="<?= $main["cleaner"] ?>" style="width: 90% !important"></td>
                                  <td colspan="1" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">Developer</td>
                                  <td colspan="2" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">: <input class="form-control" type="text" name="developer" value="<?= $main["developer"] ?>" style="width: 90% !important"></td>
                                </tr>

                                <tr>
                                  <td colspan="3" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">Batch Number</td>
                                  <td colspan="1" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">:</td>
                                  <td colspan="14" style="border-left: none; border-right: none; border-bottom: none; border-top: none;"><input class="form-control" type="text" name="batch_number" value="<?= $main['batch_number'] ?>" style="width: 99% !important"></td>
                                </tr>

                                <tr>
                                  <td colspan="3" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">Method's Pre-Cleaning</td>
                                  <td colspan="1" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">:</td>
                                  <td colspan="14" style="border-left: none; border-right: none; border-bottom: none; border-top: none;"><input type="radio" name="method_precleaning" <?= $main['method_precleaning'] == 1 ? 'checked' : '' ?>></td>
                                </tr>

                                <tr>
                                  <td colspan="3" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">Penetrant Applicable</td>
                                  <td colspan="1" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">:</td>
                                  <td colspan="5" style="border-left: none; border-right: none; border-bottom: none; border-top: none;"><input type="radio" value="1" name="penetran_applicable" <?= $main['penetran_applicable'] == 1 ? 'checked' : '' ?>>Brush</td>
                                  <td colspan="8" style="border-left: none; border-right: none; border-bottom: none; border-top: none;"><input type="radio" value="2" name="penetran_applicable" <?= $main['penetran_applicable'] == 2 ? 'checked' : '' ?>>Spry</td>
                                </tr>

                                <tr>
                                  <td colspan="3" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">Light Intensity</td>
                                  <td colspan="1" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">:</td>
                                  <td colspan="4" style="border-left: none; border-right: none; border-bottom: none; border-top: none;"><input class="form-control" name="light_intensity" value="<?= $main['light_intensity'] ?>" style="width: 80% !important">Lux</td>
                                  <td colspan="1" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">Light Sourch</td>
                                  <td colspan="2" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">: <input class="form-control" name="light_source" value="<?= $main['light_source'] ?>" style="width: 80% !important"></td>
                                  <td colspan="1" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">Dwell Time</td>
                                  <td colspan="2" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">: <input class="form-control" name="dwell_time" value="<?= $main['dwell_time'] ?>" style="width: 80% !important"></td>
                                  <td colspan="1" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">Surface Temperature</td>
                                  <td colspan="2" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">: <input class="form-control" name="surface_temp" value="<?= $main['surface_temp'] ?>" style="width: 80% !important"></td>
                                </tr>

                                <tr>
                                  <td colspan="3" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">Methode Removing Excess Penetrant</td>
                                  <td colspan="1" style="border-left: none; border-right: none; border-bottom: none; border-top: none;"></td>
                                  <td colspan="14" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">:<input class="form-control" name="method_remove_excess_penetran" value="<?= $main['method_remove_excess_penetran'] ?>" style="width: 95% !important"></td>
                                </tr>

                                <tr>
                                  <td colspan="3" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">Drying After Remove Excess Penetrant</td>
                                  <td colspan="1" style="border-left: none; border-right: none; border-bottom: none; border-top: none;"></td>
                                  <td colspan="4" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">:</td>
                                  <td colspan="1" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">Developer App</td>
                                  <td colspan="3" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">: <input type="radio" name="developer_app" <?= $main['developer_app'] == 1 ? 'checked' : '' ?> value="1">Spray</td>
                                  <td colspan="1" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">Developing Time</td>
                                  <td colspan="4" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">: <input class="form-control" name="developing_time" value="<?= $main['developing_time'] ?>" style="width: 80% !important"></td>
                                </tr>

                                <tr>
                                  <td colspan="3" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">Batch No. Of</td>
                                  <td colspan="1" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">Penetrant</td>
                                  <td colspan="4" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">: <input class="form-control" name="batch_no_of_penetrant" value="<?= $main['batch_no_of_penetrant'] ?>" style="width: 80% !important"></td>
                                  <td colspan="1" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">Cleaner</td>
                                  <td colspan="3" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">: <input class="form-control" name="batch_no_of_cleaner" value="<?= $main['batch_no_of_cleaner'] ?>" style="width: 80% !important"></td>
                                  <td colspan="1" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">Developer</td>
                                  <td colspan="4" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">: <input class="form-control" name="batch_no_of_developer" value="<?= $main['batch_no_of_developer'] ?>" style="width: 80% !important"></td>
                                </tr>

                                <!-- ========================================== -->

                                <tr>
                                  <td colspan="3" style="border-left: none; border-right: none; border-bottom: none;">Surface Preparation / Cleaning</td>
                                  <td colspan="1" style="border-left: none; border-right: none; border-bottom: none;">:</td>
                                  <td colspan="3" style="border-left: none; border-right: none; border-bottom: none;">&nbsp;&nbsp;
                                    <input type="checkbox" name="surface_preparation[]" value="1" <?= in_array(1, explode(";", $main['surface_preparation'])) ? 'checked' : '' ?>>&nbsp;&nbsp;As Welded
                                  </td>

                                  <td colspan="3" style="border-left: none; border-right: none; border-bottom: none;">&nbsp;&nbsp;
                                    <input type="checkbox" name="surface_preparation[]" value="2" <?= in_array(2, explode(";", $main['surface_preparation'])) ? 'checked' : '' ?>>&nbsp;&nbsp;Machining
                                  </td>
                                  <td colspan="3" style="border-left: none; border-right: none; border-bottom: none;">&nbsp;&nbsp;
                                    <input type="checkbox" name="surface_preparation[]" value="3" <?= in_array(3, explode(";", $main['surface_preparation'])) ? 'checked' : '' ?>>&nbsp;&nbsp;Grinding
                                  </td>
                                  <td colspan="4" style="border-left: none; border-right: none; border-bottom: none;"></td>
                                </tr>

                                <tr>
                                  <td colspan="3" style="border-left: none; border-right: none; border-top: none; border-bottom: none;">Time of Examination</td>
                                  <td colspan="1" style="border-left: none; border-right: none; border-top: none; border-bottom: none;">:</td>
                                  <td colspan="3" style="border-left: none; border-right: none; border-top: none; border-bottom: none;">&nbsp;&nbsp;
                                    <input type="radio" name="time_of_examination" value="1" <?= $main['time_of_examination'] == '1' ? 'checked' : '' ?>>&nbsp;&nbsp;After Welding
                                  </td>

                                  <td colspan="3" style="border-left: none; border-right: none; border-top: none; border-bottom: none;">&nbsp;&nbsp;
                                    <input type="radio" name="time_of_examination" value="2" <?= $main['time_of_examination'] == '2' ? 'checked' : '' ?>>&nbsp;&nbsp;After Hydro-Test
                                  </td>
                                  <td colspan="3" style="border-left: none; border-right: none; border-top: none; border-bottom: none;">&nbsp;&nbsp;
                                    <input type="radio" name="time_of_examination" value="3" <?= $main['time_of_examination'] == '3' ? 'checked' : '' ?>>&nbsp;&nbsp;After PWHT
                                  </td>
                                  <td colspan="4" style="border-left: none; border-right: none; border-top: none; border-bottom: none;">&nbsp;&nbsp;
                                    <input type="radio" name="time_of_examination" value="4" <?= $main['time_of_examination'] == '4' ? 'checked' : '' ?>>&nbsp;&nbsp;Others&nbsp;&nbsp;
                                  </td>
                                </tr>

                                <tr>
                                  <td colspan="3" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">Scope Examination</td>
                                  <td colspan="1" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">:</td>
                                  <td colspan="3" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">&nbsp;&nbsp;
                                    <input type="radio" name="scope_examination" <?= $main['scope_examination'] == '1' ? 'checked' : '' ?> value="1">&nbsp;&nbsp;Base Metal
                                  </td>

                                  <td colspan="3" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">&nbsp;&nbsp;
                                    <input type="radio" name="scope_examination" <?= $main['scope_examination'] == '2' ? 'checked' : '' ?> value="2">&nbsp;&nbsp;Edge Prep
                                  </td>
                                  <td colspan="3" style="border-left: none; border-right: none; border-bottom: none; border-top: none;">&nbsp;&nbsp;
                                    <input type="radio" name="scope_examination" <?= $main['scope_examination'] == '3' ? 'checked' : '' ?> value="3">&nbsp;&nbsp;Back Chipping
                                  </td>
                                  <td colspan="4" style="border-left: none; border-right: none; border-bottom: none; border-top: none;"></td>
                                </tr>

                                <tr>
                                  <td colspan="4" style="border-left: none; border-right: none; border-top: none;"></td>
                                  <td colspan="3" style="border-left: none; border-right: none; border-top: none;">&nbsp;&nbsp;
                                    <input type="radio" name="scope_examination" <?= $main['scope_examination'] == '4' ? 'checked' : '' ?> value="4">&nbsp;&nbsp;Weld Part
                                  </td>
                                  <td colspan="3" style="border-left: none; border-right: none; border-top: none;">&nbsp;&nbsp;
                                    <input type="radio" name="scope_examination" <?= $main['scope_examination'] == '5' ? 'checked' : '' ?> value="5">&nbsp;&nbsp;Repair Weld
                                  </td>

                                  <td colspan="7" style="border-left: none; border-right: none; border-top: none;">&nbsp;&nbsp;
                                    <input type="radio" name="scope_examination" <?= $main['scope_examination'] == '6' ? 'checked' : '' ?> value="6">&nbsp;&nbsp;Others&nbsp;&nbsp;
                                  </td>
                                </tr>

                                <tr>
                                  <td rowspan="2" style="text-align:center;">S/N</td>
                                  <td rowspan="2" style="text-align:center;">Weld Map Dwg / Line & Spool No</td>
                                  <td rowspan="2" style="text-align:center;">Joint No</td>
                                  <td rowspan="2" style="text-align:center;">Joint Type</td>

                                  <td rowspan="2" style="text-align:center;">Size/Dia</td>

                                  <td rowspan="2" style="text-align:center;">Sch</td>
                                  <td rowspan="2" style="text-align:center;">Thk (mm)</td>
                                  <td rowspan="2" style="text-align:center;">Total Length (mm)</td>
                                  <td rowspan="2" style="text-align:center;">Tested Length (mm)</td>
                                  <td rowspan="2" style="text-align:center;">Welding Process</td>
                                  <td rowspan="2" style="text-align:center;">Welder ID</td>
                                  <td rowspan="2" style="text-align:center;">Result</td>
                                  <td colspan="3" style="text-align:center;" rowspan="1">Type of Discontinuites</td>
                                  <td rowspan="2" style="text-align:center;">Inspection Category</td>
                                  <td rowspan="2" style="text-align:center;">Remarks</td>
                                </tr>

                                <tr>
                                  <td rowspan="1" style="text-align:center;">Deffect Length (mm)</td>
                                  <td rowspan="1" style="text-align:center;">Deffect Type</td>
                                  <td rowspan="1" style="text-align:center;">Distance from Datum (mm)</td>
                                </tr>

                                <?php
                                $cek = [];
                                foreach ($detail as $key => $value) {
                                ?>
                                  <?php
                                  if (in_array($value['id_joint'], $cek)) {
                                    continue;
                                  }
                                  $cek[] = $value['id_joint'];
                                  ?>
                                  <tr style="text-align: center; vertical-align: middle;">
                                    <td><?= $key + 1 ?></td>
                                    <input type="hidden" name="id_joint[<?= $key ?>]" value="<?= $value['id_joint'] ?>">
                                    <td><?= $joint[$value['id_joint']]['drawing_wm'] ?></td>
                                    <td><?= $joint[$value['id_joint']]['joint_no'] ?></td>
                                    <td><?= $mas_weld_type[$joint[$value['id_joint']]['weld_type']] ?> </td>
                                    <td><?= $joint[$value['id_joint']]['diameter'] ?></td>
                                    <td><?= $joint[$value['id_joint']]['sch'] ?></td>
                                    <td><?= $joint[$value['id_joint']]['thickness'] ?></td>
                                    <td><?= $joint[$value['id_joint']]['weld_length'] ?></td>
                                    <td><input class="form-control" required type="text" name="tested_length[<?= $key ?>]" value=<?= $value['tested_length'] ?>></td>
                                    <td>
                                      <?php
                                      $wp_rh    = explode(";", $joint[$value["id_joint"]]["weld_process_rh"]);
                                      $wp_fc    = explode(";", $joint[$value["id_joint"]]["weld_process_fc"]);
                                      $wprocess = array_unique(array_merge($wp_rh, $wp_fc));
                                      ?>
                                      <?= implode("<br>", $wprocess) ?>
                                    </td>
                                    <td>
                                      <?php
                                      $list_welder  = [];
                                      if (isset($welder_joint[$value['id_joint']])) : ?>
                                        <?php foreach ($welder_joint[$value['id_joint']] as $v) : ?>
                                          <?php $list_welder[] = $welder[$v]['welder_code']; ?>
                                        <?php endforeach; ?>
                                      <?php endif; ?>
                                      <?= implode(", ", $list_welder) ?>
                                    <?php 
                                      $drawing_wm = $joint[$value['id_joint']]['drawing_wm'];
                                      $report_no = $main['report_no'];
                                      $joint_no = $joint[$value['id_joint']]['joint_no'];
                                      echo ch_button_shortcut_search_joint_welder($method, $drawing_wm, $report_no, $joint_no);
                                    ?>
                                    </td>
                                    <td style="vertical-align: middle;">
                                      ACC <input type="radio" <?= $value['result'] == 1 ? 'checked' : '' ?> name="result[<?= $key ?>]" value="1">
                                      REJ <input type="radio" <?= $value['result'] == 2 ? 'checked' : '' ?> name="result[<?= $key ?>]" value="2">
                                    </td>

                                    <td>
                                      <?php if ($value['result'] == 2) { ?>
                                        <input class="form-control" type="number" name="deffect_length[<?= $key ?>]" value=<?= $value['deffect_length'] ?>>
                                      <?php } ?>
                                    </td>
                                    <td>
                                      <?php if ($value['result'] == 2) { ?>
                                        <select name="deffect_type[<?= $key ?>]" required>
                                          <?php foreach ($deffect as $key_deffect => $value_deffect) { ?>
                                            <option value="<?= $value_deffect["id"] ?>" <?= $value_deffect["id"] == $value['deffect_type'] ? "selected" : '' ?>>
                                              <?= $value_deffect["ctq_description"] ?>
                                            </option>
                                          <?php } ?>
                                        </select>
                                      <?php } ?>
                                    </td>
                                    <td>
                                      <?php if ($value['result'] == 2) { ?>
                                        <input class="form-control" type="number" name="datum[<?= $key ?>]" value=<?= $value['datum'] ?>>
                                      <?php } ?>
                                    </td>

                                    <td>
                                      <!-- <textarea rows="1" name="inspection_cat[<?= $value['id_pt'] ?>]"><?= $value['inspection_cat'] ?></textarea> -->
                                      <input class="form-control" type="text" name="inspection_cat[<?= $key ?>]" value=<?= $value['inspection_cat'] ?>>
                                    </td>
                                    <td>
                                      <input class="form-control" type="text" name="remarks[<?= $key ?>]" value=<?= $value['remarks'] ?>>
                                      <!-- <textarea rows="1" name="remarks[<?= $key ?>]"><?= $value['remarks'] ?></textarea> -->
                                    </td>
                                  </tr>
                                <?php } ?>
                                <tr>
                                  <td colspan="17">
                                    Note:
                                  </td>
                                </tr>
                                <tr>
                                  <td colspan="1" style="text-align:center ;border-left: 0px; border-right: 0px"></td>

                                  <td colspan="3" style="text-align:center ;border-left: 0px; border-right: 0px">Tested by <br> NDT Level II</td>
                                  <td colspan="4" style="text-align:center ;border-left: 0px; border-right: 0px">QC Inspector</td>
                                  <td colspan="5" style="text-align:center ;border-left: 0px; border-right: 0px">Client Inspector</td>
                                  <td colspan="4" style="text-align:center ;border-left: 0px; border-right: 0px">3rd party</td>
                                </tr>
                                <tr>
                                  <td colspan="1" style="text-align:center ;border-left: 0px; border-right: 0px"></td>
                                  <td colspan="3" style="text-align:center ;border-left: 0px; border-right: 0px">
                                    <?php if ($main["tested_by"]) { ?>
                                      <img src="data:image/png;base64,<?= $user[$main['tested_by']]['sign_approval'] ?>" style='width: 4.5cm;vertical-align: text-bottom !important;' />
                                    <?php } else { ?>
																			<?php if ($this->user_cookie[7] != 8) : ?>
                                        <?php if ($main['status_inspection'] == 0) { ?>
                                          <span class="btn btn-success" onclick="approve_request('<?= $main['uniq_id_report'] ?>', 0)">
                                            <i class="fas fa-signature"></i>
                                            Approve NDT Level II
                                          </span>
                                        <?php } ?>
                                      <?php endif; ?>
                                    <?php } ?>
                                  </td>
                                  <td colspan="4" style="text-align:center ;border-left: 0px; border-right: 0px">
                                    <?php if ($main["status_inspection"] >= 3) { ?>
                                      <img src="data:image/png;base64,<?= $user[$main['qc_by']]['sign_approval'] ?>" style='width: 4.5cm;vertical-align: text-bottom !important;' />
                                    <?php } ?>

																		<?php if ($this->user_cookie[7] != 8) : ?>
                                      <?php if ($main['status_inspection'] == 1) { ?>
                                        <span class="btn btn-success" onclick="approve_request('<?= $main['uniq_id_report'] ?>', 3)">
                                          <i class="fas fa-signature"></i>
                                          Approve QC
                                        </span>
                                      <?php } ?>
                                    <?php endif; ?>
                                  </td>
                                  <td colspan="5" style="text-align:center ;border-left: 0px; border-right: 0px">
                                    <?php if ($main["status_inspection"] >= 7) { ?>
                                      <img src="data:image/png;base64,<?= $user[$main['client_by']]['sign_approval'] ?>" style='width: 4.5cm;vertical-align: text-bottom !important;' />
                                    <?php } ?>
                                    <?php if ($main['status_inspection'] == 5) { ?>
                                      <span class="btn btn-success" onclick="approve_request('<?= $main['uniq_id_report'] ?>', 7)">
                                        <i class="fas fa-signature"></i>
                                        Approve Client
                                      </span>
                                    <?php } ?>
                                  </td>
                                  <td colspan="4" style="text-align:center ;border-left: 0px; border-right: 0px">
                                    <div style='height:3cm;'>
                                      <?php if ($main['third_party_approval_status'] == 0 && $main['status_inspection'] == 7 && $this->user_cookie[7] != 8) { ?>
                                        <h6>-- Click the button below --</h6>
                                        <button type="button" onclick="sign_third_party(this)" class="btn btn-info"><i class="fas fa-exchange-alt"></i> Sign Document </button>
                                      <?php } else { ?>
                                        <?php if ($main['third_party_approval_by']) : ?>
                                          <img src="data:image/png;base64,<?= $user[$main['third_party_approval_by']]['sign_approval'] ?>" style='width: 4.5cm; height:3cm;vertical-align: text-bottom !important;' />
                                        <?php endif; ?>
                                      <?php  } ?>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td colspan="1" style="text-align:center ;border-left: 0px; border-right: 0px"></td>

                                  <td colspan="3" style="text-align:center ;border-left: 0px; border-right: 0px">
                                    <?php if ($main["status_inspection"] >= 1) { ?>
                                      <strong><?= $user[$main['tested_by']]['full_name'] ?></strong><br>
                                    <?php } ?>
                                    Name / Signature
                                    <br>
                                    Date:
                                    <?php if ($main["status_inspection"] >= 1) { ?>
                                      <strong><?= DATE("Y-m-d", strtotime($main['tested_date'])) ?></strong>
                                    <?php } ?>
                                  </td>
                                  <td colspan="4" style="text-align:center ;border-left: 0px; border-right: 0px">
                                    <?php if ($main["status_inspection"] >= 3) { ?>
                                      <strong><?= $user[$main['qc_by']]['full_name'] ?></strong><br>
                                    <?php } ?>
                                    Name / Signature
                                    <br>
                                    Date:
                                    <?php if ($main["status_inspection"] >= 3) { ?>
                                      <strong><?= DATE("Y-m-d", strtotime($main['qc_date'])) ?></strong>
                                    <?php } ?>
                                  </td>
                                  <td colspan="5" style="text-align:center ;border-left: 0px; border-right: 0px">
                                    <?php if ($main["status_inspection"] >= 7) { ?>
                                      <strong><?= $user[$main['client_by']]['full_name'] ?></strong><br>
                                    <?php } ?>
                                    Name / Signature
                                    <br>
                                    Date:
                                    <?php if ($main["status_inspection"] >= 7) { ?>
                                      <strong><?= DATE("Y-m-d", strtotime($main['client_date'])) ?></strong>
                                    <?php } ?>
                                  </td>
                                  <td colspan="4" style="text-align:center ;border-left: 0px; border-right: 0px">
                                    <?php if (!empty($main['third_party_approval_by'])) : ?>
                                      <strong><?= $user[$main['third_party_approval_by']]['full_name'] ?></strong>
                                    <?php else : ?>
                                      Nama / Signature
                                    <?php endif; ?>
                                    <br>
                                    Date:
                                    <strong><?= $main['third_party_approval_date'] ? date('d-M-Y', strtotime($main['third_party_approval_date'])) : "" ?></strong>
                                  </td>
                                </tr>
                                <!-- <tr> -->
                                <!-- <td colspan="17" style="font-weight: bold; text-align:left;border-left: 0px; border-right: 0px"> -->

                                <tr style="border: none !important;">
                                  <td colspan="17" style="border: none !important; font-weight: bold;">Legend:</td>
                                </tr>
                                <tr style="border: none !important;">
                                  <td colspan="2" style="border: none !important; font-weight: bold;">LI</td>
                                  <td colspan="6" style="border: none !important;">: Linear - Lack of Penetration/Lack of Fusion/Crack</td>
                                  <td colspan="2" style="border: none !important;"></td>
                                  <td colspan="1" style="border: none !important; font-weight: bold;">Acc</td>
                                  <td colspan="6" style="border: none !important;">: Accept</td>
                                </tr>
                                <tr style="border: none !important;">
                                  <td colspan="2" style="border: none !important; font-weight: bold;">R</td>
                                  <td colspan="6" style="border: none !important;">: Rounded - Slag of Inclusion/Porosity</td>
                                  <td colspan="2" style="border: none !important;"></td>
                                  <td colspan="1" style="border: none !important; font-weight: bold;">Rej</td>
                                  <td colspan="6" style="border: none !important;">: Reject</td>
                                </tr>
                                <tr style="border: none !important;">
                                  <td colspan="2" style="border: none !important;"></td>
                                  <td colspan="6" style="border: none !important;"></td>
                                  <td colspan="2" style="border: none !important;"></td>
                                  <td colspan="1" style="border: none !important; font-weight: bold;">NAD</td>
                                  <td colspan="6" style="border: none !important;">: Not Appearance Discontinuity</td>
                                </tr>
                              </table>
                              <br />
                              <?php if ($main["status_inspection"] == 0) { ?>
                                <button type="submit" class="btn btn-warning" name="status_inspection" value="0"><i class="fas fa-save"></i> Update</button>
                                <span type="button" onclick="approve_request('<?= $main['uniq_id_report'] ?>', 1)" class="btn btn-info"><i class="fas fa-exchange-alt"></i> Submit to QC</span>
                              <?php } elseif ($main["status_inspection"] == 3) { ?>
                                <span type="button" onclick="approve_request('<?= $main['uniq_id_report'] ?>', 5)" class="btn btn-info"><i class="fas fa-exchange-alt"></i> Submit to Client</span>
                              <?php } ?>
                              <br />

                            </form>
                          </div>

                          <br />
                          <br />
                        </center>

                        <button class="btn btn-primary d-none" data-toggle="modal" data-target="#rerequestModal">
                          <i class="fas fa-plus"></i>
                          Re-Request Joint
                        </button>

                      </div>
                    </div>
                  </div>

                  <div id="menu1" class="container tab-pane col-md-12 fade"><br>
                    <div class="col-md-12">
                      <form action="<?= base_url('ndt_live/add_deffect') ?>" method="POST">
                        <table class="table table-bordered table-hover tr_ctq">
                          <thead class="bg-gray-table">
                            <th>Joint No. / Welder</th>
                            <th>Deffect Type</th>
                            <th>Deffect Length</th>
                            <th>Distance from Datum</th>
                            <th>Deffect Depth</th>
                            <th>Planarity</th>
                            <th>Type</th>
                            <th><span class="btn btn-info" onclick="addCTQ()"><i class="fas fa-plus"></i></span></th>
                          </thead>
                          <tbody>
                            <?php foreach ($ctq as $key => $value) { ?>
                              <tr class="row_<?= $value['id'] ?>">
                                <td><?= $welder[$value['welder']]['welder_code'] . ' (Joint No. ' . $joint[$array_detail[$value['ndt_id']]['id_joint']]['joint_no'] . ')' ?></td>
                                <td><?= $deffect[$value['ctq_id']]['ctq_description'] ?></td>
                                <td><?= $value['length'] ?></td>
                                <td><?= $value['datum'] ?></td>
                                <td><?= $value['depth'] ?></td>
                                <td><?= $value['planarity'] == 0 ? 'Non-Planar' : 'Planar' ?></td>
                                <td><?= $value['type'] == 0 ? 'R/H' : 'F/C' ?></td>
                                <td><span class="btn btn-danger" onclick="removeCTQ(<?= $value['id'] ?>)"><i class="fas fa-trash"></i></span></td>
                              <tr>
                              <?php } ?>
                          </tbody>
                        </table>
                        <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Save</button>
                      </form>
                      <script type="text/javascript">
                        var no = 0

                        function addCTQ() {
                          no++;

                          var html = '<tr id="row_' + no + '">';

                          html += '<input name="ndt_type" type="hidden" value="7">';

                          html += '<td>'
                          html += '  <select class="form-control" name="ndt_id[' + no + ']" required> '
                          html += '   <option value="">-----</option>'
                          <?php foreach ($detail as $key_1 => $value_1) {  ?>
                            <?php if ($value_1['result'] == 2) { ?>
                              html += ' <option value="<?php echo $value_1['id_pt']; ?>"><?php echo $welder[$value_1["welder_id"]]['welder_code']; ?> ( <?php echo 'Joint No.' . $joint[$value_1["id_joint"]]['joint_no']; ?> )</option>'
                            <?php } ?>
                          <?php } ?>
                          html += '  <select> '
                          html += '</td>';

                          html += '<td>'
                          html += '  <select class="form-control" name="ctq_id[' + no + ']" required> '
                          html += '   <option value="">-----</option>'
                          <?php foreach ($master_data_ctq as $key_2 => $value_2) {  ?>
                            html += ' <option value="<?php echo $value_2['id']; ?>"><?php echo $value_2["ctq_description"]; ?> ( <?php echo $value_2["ctq_initial"]; ?> )</option>'
                          <?php } ?>
                          html += '  <select> '
                          html += '</td>';

                          html += '<td><input name="length[' + no + ']" type="number" step="any" class="form-control" placeholder="Length" required></td>';
                          html += '<td><input name="datum[' + no + ']" type="text" step="any" class="form-control" placeholder="Datum" required></td>';
                          html += '<td><input name="depth[' + no + ']" type="text" step="any" class="form-control" placeholder="Depth" required></td>';

                          html += '<td>'
                          html += '  <select class="form-control" name="planarity[' + no + ']" required> '
                          html += '   <option value="">---</option>'
                          html += '   <option value="0">Non-Planar</option>'
                          html += '   <option value="1">Planar</option>'
                          html += '  <select> '
                          html += '</td>';

                          html += '<td>'
                          html += '  <select class="form-control" name="type[' + no + ']" required> '
                          html += '   <option value="">---</option>'
                          html += '   <option value="0">R/H</option>'
                          html += '   <option value="1">F/C</option>'
                          html += '  <select> '
                          html += '</td>';

                          html += '<td><span class="btn btn-danger" onclick="removeCTQ_row(' + no + ')"><i class="fas fa-trash"></i></span></td>';

                          html += '</tr>';

                          $('.tr_ctq').append(html)
                        }

                        function removeCTQ_row(no) {
                          $('#row_' + no).remove()
                        }

                        function removeCTQ(id) {
                          Swal.fire({
                            type: 'warning',
                            title: 'Are You Sure to Remove this Data?',
                            // input: 'tel',
                            showDenyButton: true,
                            showCancelButton: true,
                            confirmButtonText: 'Yes',
                          }).then((result) => {
                            console.log(result)
                            /* Read more about isConfirmed, isDenied below */
                            if (result.value == true) {
                              $.ajax({
                                url: "<?= base_url() ?>ndt_live/removeCTQ",
                                type: "POST",
                                data: {
                                  'id': id,
                                },
                              })
                              Swal.fire('Success!', '', 'success')
                              // location.reload()
                              $('.row_' + id).remove()
                            } else {
                              Swal.fire('Changes are not saved', '', 'info')
                            }
                          })
                        }
                      </script>
                    </div>
                  </div>

                  <div id="menu2" class="container tab-pane col-md-12 fade"><br>
                    <div class="col-md-12">
                      <div class="col-md-6">
                        <form action="<?php echo base_url('ndt_live/upload_new_attachment/7'); ?>" method="post" enctype="multipart/form-data">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Remarks Data :</label>
                                <textarea name='remarks' class='form-control' required="" style="height: 100px !important"></textarea>
                                <input type="hidden" class="form-control" name="submission_id" id="uniq_data" value="<?= $main['uniq_id_report'] ?>" autocomplete="off" readonly>
                                <input type="hidden" class="form-control" name="report_number" id="uniq_data" value="<?= $main['report_no'] ?>" autocomplete="off" readonly>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Revision No :</label>
                                <input class="form-control" type="number" name="revision">
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Select File to upload :</label>
                                <input type="file" class="form-control" name="file_attachment" id="file_attachment" required="">
                              </div>
                            </div>
                          </div>
                          <button type="submit" class="btn btn-secondary"> Upload</button>
                        </form>
                      </div>
                      <div class="col-md-12">
                        <br>
                        <table class="table table-borderless table-hover text-muted" style="border: none">
                          <thead class="bg-gray-table">
                            <tr>
                              <th>ATTACHMENT</th>
                              <th>REVISION</th>
                              <th>UPLOAD BY</th>
                              <th>UPLOAD DATE</th>
                              <th>REMARKS</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php foreach ($data_attachment as  $value) { ?>
                              <tr>
                                <td>
                                  <a target="_blank" href="<?= base_url('ndt/open_atc/') . $value["filename"] . '/' . $value["filename"] ?>"><?php echo $value["filename"] ?></a>
                                </td>
                                <td><?= $value['revision'] ? $value['revision'] : '-' ?></td>
                                <td><?php echo $user_list[$value["created_by"]]['full_name'] ?></td>
                                <td><?php echo $value["created_date"] ?></td>
                                <td><?php echo $value["remarks"] ?></td>
                                <td><button class="btn btn-danger" type="button" onclick="delete_attachment_on_update('<?= $value["id"]; ?>','<?= $value["uniq_data"]; ?>')"><i class="fa fa-trash"></i></button></td>
                              </tr>
                            <?php } ?>
                            <script type="text/javascript">
                              function delete_attachment_on_update(id, uniq_data) {
                                Swal.fire({
                                  title: 'Are you sure to <b class="text-warning">&nbsp;Delete&nbsp;</b> this?',
                                  text: "This Attachment will permanent deleted!",
                                  type: 'warning',
                                  showCancelButton: true,
                                  confirmButtonColor: '#3085d6',
                                  cancelButtonColor: '#d33',
                                  confirmButtonText: 'Yes, Delete it!'
                                }).then((result) => {
                                  if (result.value) {
                                    $.ajax({
                                      url: "<?php echo base_url(); ?>ndt_live/delete_attachment_with_status",
                                      type: "post",
                                      data: {
                                        ndt: '<?= $initial ?>',
                                        id: id,
                                        uniq_data: uniq_data,
                                      },
                                      success: function(data) {
                                        if (data.includes("Error")) {
                                          Swal.fire(
                                            'Ops..',
                                            data,
                                            'error'
                                          );
                                        } else {
                                          Swal.fire(
                                            'Success',
                                            'Your data has been Updated!',
                                            'success'
                                          );
                                          location.reload();
                                        }
                                      }
                                    });
                                  }
                                })
                              }
                            </script>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>

                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END TAB -->
  </div>
  </div>

  <div class="modal fade" id="rerequestModal" tabindex="-1" role="dialog" aria-labelledby="rerequestModalLabel" aria-hidden="true">
    <form action="<?= base_url('ndt_live/copy_new_data') ?>" method="POST">
      <input type="hidden" name="ndt_report_number" class="form-control" value="<?= $main['report_no'] ?>" required>
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="rerequestModalLabel">Re-Request List</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <div class="row">
              <div class="col-md-12 mt-2">
                <div class="form-group row">
                  <label for="" class="col-xl-3 col-form-label text-muted">Vendor</label>
                  <div class="col-xl">
                    <select name="vendor" class="select2" style="width: 100%" required>
                      <option value="">---</option>
                      <?php foreach ($vendor as $value_vendor) { ?>
                        <option value="<?= $value_vendor['id_company'] ?>"><?= $value_vendor['company_name'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-12"></div>
              <div class="col-md-12 mt-2">
                <div class="form-group row">
                  <label for="" class="col-xl-3 col-form-label text-muted">Inspector Name</label>
                  <div class="col-xl">
                    <select name="inspector_id" class="select2" style="width: 100%" required>
                      <option value="">---</option>
                      <?php foreach ($user_list as $key => $value) : ?>
                        <option value="<?= $value['id_user'] ?>"><?= $value['full_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-12"></div>
              <div class="col-md-12">
                <div class="form-group row">
                  <label for="" class="col-xl-3 col-form-label text-muted">Inspect Date</label>
                  <div class="col-xl">
                    <input type="date" name="inspect_date" class="form-control" value="<?= date('Y-m-d') ?>" required>
                  </div>
                </div>
              </div>
              <div class="col-md-12"></div>
              <div class="col-md-12">
                <div class="form-group row">
                  <label for="" class="col-xl-3 col-form-label text-muted">Inspect Time</label>
                  <div class="col-xl">
                    <input type="time" name="inspect_time" class="form-control" value="<?= date('H:i:s') ?>" required>
                  </div>
                </div>
              </div>
              <div class="col-md-12"></div>
              <div class="col-md-12">
                <div class="form-group row">
                  <label for="" class="col-xl-3 col-form-label text-muted">Notes</label>
                  <div class="col-xl">
                    <textarea class="form-control" name="note" style="height:50px !important"></textarea>
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <?php //test_var($joint[332474]); 
            ?>
            <table class="table table_modal">
              <thead class="bg-gray-table">
                <tr>
                  <th>Joint No.</th>
                  <th>Welder ID.</th>
                  <th>Request Tested Length</th>
                  <th>Drawing No.</th>
                  <th>Drawing Weld Map</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($detail as $key_rere => $value_rere) { ?>
                  <?php //test_var($value_rere); 
                  ?>
                  <tr class="text-center">
                    <td class="font-weight-bold">
                      <?= $joint[$value_rere['id_joint']]['joint_no'] . ($value_rere['revision'] > 0 ? '(' . $value_rere['revision_category'] . $value_rere['revision'] . ')' : '') ?>
                    </td>
                    <td><?= $welder[$value_rere['welder_id']]['welder_code'] ?></td>

                    <td>
                      <input type="number" class="form-control" name="transmittal_request_tested_length[<?= $key_rere ?>]" value='<?= $value_rere['length_of_weld'] - $value_rere['transmittal_request_tested_length'] ?>' max='<?= $value_rere['length_of_weld'] - $value_rere['transmittal_request_tested_length'] ?>'>
                    </td>

                    <td><?= $value_rere['drawing_no'] ?></td>
                    <td><?= $joint[$value_rere['id_joint']]['drawing_wm'] ?></td>

                    <td>
                      <input style="height: 30px !important;width: 30px !important;" type="checkbox" name="choosen[<?= $key_rere ?>]" class="form-control" value="1">
                      <input type="hidden" name="id[<?= $key_rere ?>]" value="<?= $value_rere['id_pt'] ?>">

                      <input type="hidden" name="ndt_type" class="form-control" value="7">
                      <input type="hidden" name="ndt_code" class="form-control" value="pt">
                      <input type="hidden" name="discipline" class="form-control" value="<?= $value_rere['discipline'] ?>">
                      <input type="hidden" name="module" class="form-control" value="<?= $value_rere['module'] ?>">
                      <input type="hidden" name="type_of_module" class="form-control" value="<?= $value_rere['type_of_module'] ?>">
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </form>
  </div>

  <script type="text/javascript">
    function approve_request(uniq_id_report, status_inspection) {
      console.log(uniq_id_report, status_inspection)
      Swal.fire({
        type: 'success',
        title: 'Are You Sure to ' + (status_inspection == 1 || status_inspection == 5 ? 'Submit' : 'Sign') + ' this Report?',
        // input: 'tel',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Yes',
      }).then((result) => {
        console.log(result)
        /* Read more about isConfirmed, isDenied below */
        if (result.value == true) {
          $.ajax({
            url: "<?= base_url() ?>ndt_live/approval_ndt_pt",
            type: "POST",
            data: {
              'uniq_id_report': uniq_id_report,
              'status_inspection': status_inspection,
            },
            success: (data) => {

              if (data) {
                Swal.fire({
                  type: "success",
                  title: "Successfully Sign This Document !!",
                  timer: 1000
                })

                setTimeout(() => {
                  location.reload()
                }, 1000);
              }
            },
          })
        } else {
          Swal.fire('Changes are not saved', '', 'info')
        }
      })
    }

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
            url: "<?= site_url('ndt_live/proccess_sign_third_party') ?>",
            type: "POST",
            data: {
              uniq_id_report: "<?= encrypt($main['uniq_id_report']) ?>",
              method: "pt"
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