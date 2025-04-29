<?php
$irn_revision = (isset($show_pcms_irn[0]["irn_revision"]) ? $show_pcms_irn[0]["irn_revision"] : 0);
$irn_revision_show = str_pad(substr($irn_revision, -2), 2, '0', STR_PAD_LEFT);

$is_disabled 			= '';
$allow_update			= true;
$is_none					= '';

if ($this->user_cookie[7] == 8) {
	$is_disabled 	= "disabled";
	$allow_update = false;
	$is_none 			= 'hidden';
} else if (in_array($this->user_cookie[11], [1,2217]) || ($user_permission[218] == 1)) {
	if ($main['client_by']) {
		$is_disabled 	= "disabled";
		$allow_update = false;
	}
} else {
	if ($main['qc_by']) {
		$is_disabled 	= "disabled";
		$allow_update = false;
	}
}
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

  /*table.table td {
    font-size: 100%;
    border:1px #000 solid;
    font-weight: bold;
    max-width: 150px;
    word-wrap: break-word;
  }*/

  /*table>thead>tr>td,table>tbody>tr>td{
    vertical-align: top;
  }*/

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
<br />
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
                  <a class="nav-link active" data-toggle="tab" href="#joint_detail">Detail</a>
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
                      <form action="<?= base_url("ndt_live/update_ndt_atc") ?>" method="POST">
                        <input type="hidden" name="uniq_id_report" value="<?= $main['uniq_id_report'] ?>">
                        <?php //if($main["status_inspection"]==0){ 
                        ?>
                        <div class="row mb-2">
                          <div class="col-md-2"><strong>Report No.</strong></div>
                          <div class="col-md-4">
                            <input class="form-control" type="text" <?= $is_disabled ?> name="report_number" value="<?= $main['report_number'] ?>" <?= $is_disabled ?>>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-2"><strong>Date of Inspection</strong></div>
                          <div class="col-md-2">
                            <input class="form-control" type="date" <?= $is_disabled ?> name="date_of_inspection" value="<?= DATE('Y-m-d', strtotime($main['date_of_inspection'])) ?>" <?= $is_disabled ?>>
                          </div>
                          <div class="col-md-2">
                            <input class="form-control" type="time" <?= $is_disabled ?> name="time_of_inspection" value="<?= DATE('H:i:s', strtotime($main['date_of_inspection'])) ?>" <?= $is_disabled ?>>
                          </div>
                        </div>
                        <?php //} 
                        ?>
                        <br>
                        <center>
                          <div id='example1'>

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
                              <tr class="bg-gray-table">
                                <th style="text-align:center; vertical-align: middle;">S/N</th>
                                <th style="text-align:center; vertical-align: middle;">Weld Map Dwg / Line & Spool No</th>
                                <th style="text-align:center; vertical-align: middle;">Joint No</th>
                                <th style="text-align:center; vertical-align: middle;">Joint Type</th>
                                <th style="text-align:center; vertical-align: middle;">Size/Dia</th>
                                <th style="text-align:center; vertical-align: middle;">Sch</th>
                                <th style="text-align:center; vertical-align: middle;">Thk (mm)</th>
                                <th style="text-align:center; vertical-align: middle;">Total Length (mm)</th>
                                <th style="text-align:center; vertical-align: middle;">Tested Length (mm)</th>
                                <th style="text-align:center; vertical-align: middle;">Welding Process</th>
                                <th style="text-align:center; vertical-align: middle;">Welder ID</th>
                                <th style="text-align:center; vertical-align: middle; width: 100px !important;">Result</th>
                                <th style="text-align:center; vertical-align: middle;">Remarks</th>
                              </tr>

                              <?php foreach ($detail as $key => $value) { ?>
                                <?php
                                foreach ($visual_welder[$value["id_visual"]] as $key_vw => $value_vw) {
                                  $welders[] = $welder[$value_vw]["welder_code"];
                                }
                                ?>

                                <tr style="text-align: center; vertical-align: middle;">
                                  <td>
                                    <?= $key + 1 ?>
                                    <?php if ($user_permission[217] == 1) { ?>
                                      <button type="button" data-id="<?= $main['id'] ?>" data-submission_id="<?= $main['submission_id'] ?>" data-id_joint="<?= $value['id_joint'] ?>" data-ndt_type="<?= $ndt_method ?>" onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-danger&#34;>&nbsp;Return&nbsp;</b> this Joint?', this, event, 'return_joint')" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> </button>
                                    <?php } ?>
                                  </td>
                                  <td><?= $joint[$value['id_joint']]['drawing_wm'] ?></td>
                                  <td><?= $joint[$value['id_joint']]['joint_no'] . ($value['revision'] > 0 ? '(' . $value['revision_category'] . $value['revision'] . ')' : '') ?></td>
                                  <td><?= $weld_type_code[$joint[$value['id_joint']]['weld_type']] ?></td>
                                  <td><?= $joint[$value['id_joint']]['diameter'] ?></td>
                                  <td><?= $joint[$value['id_joint']]['sch'] ?></td>
                                  <td><?= $joint[$value['id_joint']]['thickness'] ?></td>
                                  <td><?= $joint[$value['id_joint']]['weld_length'] ?></td>
                                  <td>
                                    <input class="form-control" <?= $is_disabled ?> type="number" <?= $is_disabled ?> name="tested_length[<?= $value['id_atc'] ?>]" value=<?= $value['tested_length'] ?> max=<?= $joint[$value['id_joint']]['weld_length'] ?> required>
                                  </td>
                                  <td>
                                    <!-- weld_process -->
                                    <?php
                                    $wp_rh = explode(";", $joint[$value['id_joint']]['weld_process_rh']);
                                    $wp_fc = explode(";", $joint[$value['id_joint']]['weld_process_fc']);
                                    $wp = array_unique(array_merge($wp_rh, $wp_fc));
                                    ?>
                                    <?= implode(", ", array_unique(array_filter($wp))) ?>
                                  </td>
                                  <td>
                                    <?=
                                    implode("<br>", array_unique(array_filter($welders)));
                                    ?>
                                    <?php unset($welders); ?>
                                  </td>

                                  <td style="vertical-align: middle;">
                                    ACC <input <?= $is_disabled ?> type="radio" <?= $value['result'] == 1 ? 'checked' : '' ?> <?= $is_disabled ?> name="result[<?= $value['id_atc'] ?>]" value="1">
                                    <br>
                                    REJ <input <?= $is_disabled ?> type="radio" <?= $value['result'] == 2 ? 'checked' : '' ?> <?= $is_disabled ?> name="result[<?= $value['id_atc'] ?>]" value="2">
                                  </td>

                                  <td>
                                    <input class="form-control" <?= $is_disabled ?> type="text" <?= $is_disabled ?> name="remarks[<?= $value['id_atc'] ?>]" value=<?= $value['remarks'] ?>>
                                  </td>
                                </tr>
                              <?php } ?>

                            </table>

                            <br>

                            <?php if ($joint[$main['id_joint']]['company_id'] == 5) { ?>
                              <table border="1px" style="border-collapse: collapse !important;padding:20px !important;" width="100%">
                                <tr>
                                  <td colspan="1" style="text-align:center ;border-left: 0px; border-right: 0px"></td>
                                  <td colspan="3" style="text-align:center ;border-left: 0px; border-right: 0px">Tested by <br><?= in_array($method, ['UTCC', 'MTCC', 'RTCC', 'PTCC']) ? ' NDT Level III' : ' NDT Level II' ?></td>
                                  <td colspan="3" style="text-align:center ;border-left: 0px; border-right: 0px">QC Inspector(DSAW)</td>
                                  <td colspan="4" style="text-align:center ;border-left: 0px; border-right: 0px">QC Inspector(SEATRIUM)</td>
                                  <td colspan="5" style="text-align:center ;border-left: 0px; border-right: 0px">Client Inspector</td>
                                  <td colspan="4" style="text-align:center ;border-left: 0px; border-right: 0px">3rd party</td>
                                </tr>

                                <tr>
                                  <td colspan="1" style="text-align:center ;border-left: 0px; border-right: 0px"></td>
                                  <td colspan="3" style="text-align:center ;border-left: 0px; border-right: 0px">
                                    <?php if ($main["status_inspection"] >= 1 or $main['tested_by']) { ?>
                                      <img src="data:image/png;base64,<?= $user[$main['tested_by']]['sign_approval'] ?>" style='width: 4.5cm;vertical-align: text-bottom !important;' />
                                    <?php } ?>
                                    <?php if ($main['status_inspection'] == 0 and !$main['tested_by']) { ?>
                                      <span class="btn btn-success" onclick="approve_request('<?= $main['uniq_id_report'] ?>', 0)">
                                        <?php if ($method == 'UTCC') { ?>
                                          <i class="fas fa-check"></i>
                                          Approve NDT Level III
                                        <?php } else { ?>
                                          <i class="fas fa-check"></i>
                                          Approve NDT Level II
                                        <?php } ?>
                                      </span>
                                    <?php } ?>
                                  </td>
                                  <td colspan="3" style="text-align:center ;border-left: 0px; border-right: 0px">
                                    <?php if ($main["qc_subcont_by"]) { ?>
                                      <img src="data:image/png;base64,<?= $user[$main['qc_subcont_by']]['sign_approval'] ?>" style='width: 4.5cm;vertical-align: text-bottom !important;' />
                                    <?php } ?>
                                    <?php if ($main['status_inspection'] == 13) { ?>
                                      <span class="btn btn-success" onclick="approve_request('<?= $main['uniq_id_report'] ?>', 15)">
                                        <i class="fas fa-check"></i>
                                        Approve QC (DSAW)
                                      </span>
                                    <?php } ?>
                                  </td>
                                  <td colspan="4" style="text-align:center ;border-left: 0px; border-right: 0px">
                                    <?php if ($main["qc_by"]) { ?>
                                      <img src="data:image/png;base64,<?= $user[$main['qc_by']]['sign_approval'] ?>" style='width: 4.5cm;vertical-align: text-bottom !important;' />
                                    <?php } ?>
                                    <?php if ($main['status_inspection'] == 1 or $main['status_inspection'] == 15) { ?>
                                      <span class="btn btn-success" onclick="approve_request('<?= $main['uniq_id_report'] ?>', 3)">
                                        <i class="fas fa-check"></i>
                                        Approve QC (SEATRIUM)
                                      </span>
                                    <?php } ?>
                                  </td>
                                  <td colspan="5" style="text-align:center ;border-left: 0px; border-right: 0px">
                                    <?php if ($main["client_by"]) { ?>
                                      <img src="data:image/png;base64,<?= $user[$main['client_by']]['sign_approval'] ?>" style='width: 4.5cm;vertical-align: text-bottom !important;' />
                                    <?php } ?>
                                    <?php if ($main['status_inspection'] == 5) { ?>
                                      <span class="btn btn-success" onclick="approve_request('<?= $main['uniq_id_report'] ?>', 7)">
                                        <i class="fas fa-check"></i>
                                        Approve Client
                                      </span>
                                    <?php } ?>
                                  </td>
                                  <td colspan="4" style="text-align:center ;border-left: 0px; border-right: 0px">
                                  </td>
                                </tr>
                                <tr>
                                  <td colspan="1" style="text-align:center ;border-left: 0px; border-right: 0px"></td>

                                  <td colspan="3" style="text-align:center ;border-left: 0px; border-right: 0px">
                                    <?php if ($main["tested_by"]) { ?>
                                      <strong><?= $user[$main['tested_by']]['full_name'] ?></strong><br>
                                    <?php } ?>
                                    Name / Signature
                                    <br>
                                    Date:
                                    <?php if ($main["tested_date"]) { ?>
                                      <strong><?= DATE("Y-m-d", strtotime($main['tested_date'])) ?></strong>
                                    <?php } ?>
                                  </td>

                                  <td colspan="3" style="text-align:center ;border-left: 0px; border-right: 0px">
                                    <?php if ($main["qc_subcont_by"]) { ?>
                                      <strong><?= $user[$main['qc_subcont_by']]['full_name'] ?></strong><br>
                                    <?php } ?>
                                    Name / Signature
                                    <br>
                                    Date:
                                    <?php if ($main["tested_date"]) { ?>
                                      <strong><?= DATE("Y-m-d", strtotime($main['tested_date'])) ?></strong>
                                    <?php } ?>
                                  </td>

                                  <td colspan="4" style="text-align:center ;border-left: 0px; border-right: 0px">
                                    <?php if ($main["qc_by"]) { ?>
                                      <strong><?= $user[$main['qc_by']]['full_name'] ?></strong><br>
                                    <?php } ?>
                                    Name / Signature
                                    <br>
                                    Date:
                                    <?php if ($main["qc_date"]) { ?>
                                      <strong><?= DATE("Y-m-d", strtotime($main['qc_date'])) ?></strong>
                                    <?php } ?>
                                  </td>
                                  <td colspan="5" style="text-align:center ;border-left: 0px; border-right: 0px">
                                    <?php if ($main["client_by"]) { ?>
                                      <strong><?= $user[$main['client_by']]['full_name'] ?></strong><br>
                                    <?php } ?>
                                    Name / Signature
                                    <br>
                                    Date:
                                    <?php if ($main["client_date"]) { ?>
                                      <strong><?= DATE("Y-m-d", strtotime($main['client_date'])) ?></strong>
                                    <?php } ?>
                                  </td>
                                  <td colspan="4" style="text-align:center ;border-left: 0px; border-right: 0px">
                                    Name / Signature
                                    <br>
                                    Date:
                                  </td>
                                </tr>
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
                                <!-- </td> -->
                                <!-- </tr> -->
                              </table>

                            <?php } else { ?>
                              <table border="1px" style="border-collapse: collapse !important;padding:20px !important;" width="100%">
                                <tr>
                                  <td colspan="1" style="text-align:center ;border-left: 0px; border-right: 0px"></td>

                                  <td colspan="3" style="text-align:center ;border-left: 0px; border-right: 0px">Tested by <br><?= in_array($method, ['UTCC', 'MTCC', 'RTCC', 'PTCC']) ? ' NDT Level III' : ' NDT Level II' ?></td>
                                  <td colspan="4" style="text-align:center ;border-left: 0px; border-right: 0px">QC Inspector</td>
                                  <td colspan="5" style="text-align:center ;border-left: 0px; border-right: 0px">Client Inspector</td>
                                  <td colspan="4" style="text-align:center ;border-left: 0px; border-right: 0px">3rd party</td>
                                </tr>

                                <tr>
                                  <td colspan="1" style="text-align:center ;border-left: 0px; border-right: 0px"></td>
                                  <td colspan="3" style="text-align:center ;border-left: 0px; border-right: 0px">
                                    <?php if ($main["status_inspection"] >= 1 or $main['tested_by']) { ?>
                                      <img src="data:image/png;base64,<?= $user[$main['tested_by']]['sign_approval'] ?>" style='width: 4.5cm;vertical-align: text-bottom !important;' />
                                    <?php } ?>
                                    <?php if ($main['status_inspection'] == 0 and !$main['tested_by']) { ?>
                                      <span class="btn btn-success" onclick="approve_request('<?= $main['uniq_id_report'] ?>', 0)">
                                        <?php if ($method == 'UTCC') { ?>
                                          <i class="fas fa-check"></i>
                                          Approve NDT Level III
                                        <?php } else { ?>
                                          <i class="fas fa-check"></i>
                                          Approve NDT Level II
                                        <?php } ?>
                                      </span>
                                    <?php } ?>
                                  </td>
                                  <td colspan="4" style="text-align:center ;border-left: 0px; border-right: 0px">
                                    <?php if ($main["status_inspection"] >= 3) { ?>
                                      <img src="data:image/png;base64,<?= $user[$main['qc_by']]['sign_approval'] ?>" style='width: 4.5cm;vertical-align: text-bottom !important;' />
                                    <?php } ?>
                                    <?php if ($main['status_inspection'] == 1) { ?>
                                      <span class="btn btn-success" onclick="approve_request('<?= $main['uniq_id_report'] ?>', 3)">
                                        <i class="fas fa-check"></i>
                                        Approve QC
                                      </span>
                                    <?php } ?>
                                  </td>
                                  <td colspan="5" style="text-align:center ;border-left: 0px; border-right: 0px">
                                    <?php if ($main["status_inspection"] >= 7) { ?>
                                      <img src="data:image/png;base64,<?= $user[$main['client_by']]['sign_approval'] ?>" style='width: 4.5cm;vertical-align: text-bottom !important;' />
                                    <?php } ?>
                                    <?php if ($main['status_inspection'] == 5) { ?>
                                      <span class="btn btn-success" onclick="approve_request('<?= $main['uniq_id_report'] ?>', 7)">
                                        <i class="fas fa-check"></i>
                                        Approve Client
                                      </span>
                                      <button type="button" onclick="return_data(this, 6, 'atc')" class="btn btn-danger"><i class="fas fa-undo"></i>  Return Client</button>
                                    <?php } ?>
                                  </td>
                                  <td colspan="4" style="text-align:center ;border-left: 0px; border-right: 0px">
                                    <!-- <img src="data:image/png;base64,<?= $user[$main['tested_by']]['sign_approval'] ?>" style='width: 4.5cm;vertical-align: text-bottom !important;' /> -->
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
                                    Name / Signature
                                    <br>
                                    Date:
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
                                <!-- </td> -->
                                <!-- </tr> -->
                              </table>
                            <?php } ?>
                            <table border="1px" style="border-collapse: collapse !important;padding:20px !important; " width="100%">
                              <?php if ($main['status_inspection'] == 6) { ?>
                                <tr>
                                  <td>
                                    <span style="display: inline-block; width: 180px; font-weight: bold; color: red; text-align: left;">Client Returned By</span>: <?= @$user[$main['returned_client_by']]['full_name'] ?><br>
                                    <span style="display: inline-block; width: 180px; font-weight: bold; color: red;">Client Returned Date</span>: <?= date("d F Y H:i", strtotime($main['returned_client_date'])) ?><br>
                                    <span style="display: inline-block; width: 180px; font-weight: bold; color: red;">Client Returned Remarks</span>: <?= $main['client_reject_remarks'] ?>
                                  </td>
                                </tr>
                              <?php } ?>
                            </table>
                            


                            <br />
                            <?php if ($allow_update && $main['status_inspection'] != 12) { ?>
                              <button type="submit" class="btn btn-warning" name="status_inspection" value="<?= $main['status_inspection'] != 0 ? $main['status_inspection'] : 0 ?>"><i class="fas fa-save"></i> Update</button>
                            <?php } ?>

                            <?php if ($user_permission[208] == 1 && $main['status_inspection'] != 12) { ?>
                              <button type="button" data-id="<?= $main['id'] ?>" onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-danger&#34;>&nbsp;Void&nbsp;</b> this?', this, event, 'void_row_db')" class="btn btn-secondary"><i class="fa fa-exclamation-triangle"></i> Void</button>
                            <?php } ?>
                            
                            <?php if ($main['status_inspection'] == 6 && $this->user_cookie[7] != 8) { ?>
                              <button type="button" onclick="retransmit_to_client(this, 5, 'atc')" class="btn btn-primary"><i class="fa fa-arrow-right"></i></i></i> Transmit to Client</button>
                            <?php } ?>

                            <?php if (
                              $main["tested_by"]
                              and $main['status_inspection'] == 0
                              // 15 for ACC QC DSAW
                            ) { ?>
                              <!-- 13 for Pending QC DSAW -->
                              <span type="button" onclick="approve_request('<?= $main['uniq_id_report'] ?>', <?= $joint[$main["id_joint"]]["company_id"] == 5 ? 13 : 1 ?>)" class="btn btn-info"><i class="fas fa-exchange-alt"></i> Submit to QC <?= $joint[$main["id_joint"]]["company_id"] == 5 ? '(DSAW)' : '(SEATRIUM)' ?></span>
                            <?php } ?>
                            <?php if ($main["status_inspection"] == 3) { ?>
                              <span type="button" onclick="approve_request('<?= $main['uniq_id_report'] ?>', 5)" class="btn btn-info"><i class="fas fa-exchange-alt"></i> Submit to Client</span>
                            <?php } ?>
                            <br />
                          </div>
                      </form>
                      </center>
                      <br />
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
                          <th><span <?= $is_none ?> class="btn btn-info" onclick="addCTQ()"><i class="fas fa-plus"></i></span></th>
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
                              <td><span <?= $is_none ?> class="btn btn-danger" onclick="removeCTQ(<?= $value['id'] ?>)"><i class="fas fa-trash"></i></span></td>
                            <tr>
                            <?php } ?>
                        </tbody>
                      </table>
                      <button <?= $is_none ?> type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Save</button>
                    </form>
                    <script type="text/javascript">
                      var no = 0

                      function addCTQ() {
                        no++;

                        var html = '<tr id="row_' + no + '">';

                        html += '<input name="ndt_type" type="hidden" value="' + <?= $main["ndt_type"] ?> + '">';

                        html += '<td>'
                        html += '  <select class="form-control" name="ndt_id[' + no + ']" required> '
                        html += '   <option value="">-----</option>'
                        <?php foreach ($visual_welder_uniq as $key_1 => $value_1) {  ?>
                          html += ' <option value="<?= $ndt_by_visual[$value_1['id_visual']]["id_atc"] . "_" . $value_1["id_welder"] ?>"><?php echo $welder[$value_1["id_welder"]]['welder_code']; ?> ( <?php echo 'Joint No.' . $joint_visual[$value_1["id_visual"]]['joint_no']; ?> )</option>'
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
                          showDenyButton: true,
                          showCancelButton: true,
                          confirmButtonText: 'Yes',
                        }).then((result) => {
                          console.log(result)
                          if (result.value == true) {
                            $.ajax({
                              url: "<?= base_url() ?>ndt_live/removeCTQ",
                              type: "POST",
                              data: {
                                'id': id,
                              },
                            })
                            Swal.fire('Success!', '', 'success')
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
                      <form action="<?php echo base_url('ndt_live/upload_new_attachment/' . $main["ndt_type"]); ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Remarks Data :</label>
                              <textarea <?= $is_disabled ?> name='remarks' class='form-control' required="" style="height: 100px !important"></textarea>
                              <input type="hidden" class="form-control" name="submission_id" id="uniq_data" value="<?= $main['uniq_id_report'] ?>" autocomplete="off" readonly>
                              <input type="hidden" class="form-control" name="report_number" id="uniq_data" value="<?= $main['report_no'] ?>" autocomplete="off" readonly>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Revision No :</label>
                              <input <?= $is_disabled ?> class="form-control" type="number" name="revision">
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Select File to upload :</label>
                              <input <?= $is_disabled ?> type="file" class="form-control" name="file_attachment" id="file_attachment" required="">
                            </div>
                          </div>
                        </div>
                        <button <?= $is_none ?> type="submit" class="btn btn-secondary"> Upload</button>
                      </form>
                    </div>
                    <div class="col-md-12">
                      <table class="table text-muted">
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
                              <td><button <?= $is_none ?> class="btn btn-danger" type="button" onclick="delete_attachment_on_update('<?= $value["id"]; ?>','<?= $value["uniq_data"]; ?>')"><i class="fa fa-trash"></i></button></td>
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
                                    url: "<?php echo base_url(); ?>ndt_live/delete_attachment",
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

<script type="text/javascript">
  $("#table_list").DataTable()

  function approve_request(uniq_id_report, status_inspection) {
    console.log(uniq_id_report, status_inspection)
    Swal.fire({
      type: 'success',
      title: 'Are You Sure to Sign this  Report?',
      showDenyButton: true,
      showCancelButton: true,
      confirmButtonText: 'Yes',
    }).then((result) => {
      console.log(result)
      if (result.value == true) {
        $.ajax({
          url: "<?= base_url() ?>ndt_live/approval_ndt_atc",
          type: "POST",
          data: {
            'uniq_id_report': uniq_id_report,
            'status_inspection': status_inspection,
            'ndt_type': '<?= $main["ndt_type"] ?>',
          },
        })
        Swal.fire('Success!', '', 'success')
        location.reload()
      } else {
        Swal.fire('Changes are not saved', '', 'info')
      }
    })
  }
</script>

<script>
  function void_row_db(btn) {
    var id = $(btn).data("id");
    console.log("id:", id);

    $.ajax({
      url: "<?php echo base_url() ?>ndt_live/delete_void_atc_empire",
      data: {
        id: id,
      },
      type: 'post',
      success: function(data) {
        if (data.includes('Error')) {
          sweetalert("error", data);
        } else {
          sweetalert("success", "Void Data Success!");

          setTimeout(() => {
            location.reload()
          }, 1000);
        }
      },
      error: function(xhr, status, error) {
        sweetalert("error", "An error occurred: " + error);
      }
    });
  }
</script>

<script>
  function return_joint(btn) {
    var submission_id = $(btn).data("submission_id");
    var joint_no = $(btn).data("id_joint");
    var ndt_type = $(btn).data("ndt_type");
    var id_atc = $(btn).data("id");
    
    $.ajax({
      url: "<?php echo base_url() ?>ndt_live/return_joint_to_joint_list",
      data: {
        submission_id: submission_id,
        id_joint: joint_no,
        ndt_type: ndt_type,
        id: id_atc,
      },
      type: 'post',
      success: function(data) {
        if (data.includes('Error')) {
          sweetalert("error", data);
        } else {
          sweetalert("success", "Return joint is Succesfully!");

          setTimeout(() => {
            location.reload()
          }, 1000);
        }
      },
      error: function(xhr, status, error) {
        sweetalert("error", "An error occurred: " + error);
      }
    });
  }

  function return_data(btn, status, method) {
		Swal.fire({
			type: "warning",
			title: "Return Document",
			html: "<p>Are you sure to Return this document?</p><textarea id='return_remarks' class='swal2-textarea' placeholder='Return remarks ...'></textarea>",
			showCancelButton: true,
			preConfirm: () => {
				const remarks = document.getElementById('return_remarks').value;
				if (!remarks) {
					Swal.showValidationMessage('Remarks is required');
					return false;
				}
				return remarks;
			}
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
					url: "<?= site_url('ndt_live/return_client') ?>",
					type: "POST",
					data: {
						uniq_id_report: "<?= encrypt($main['uniq_id_report']) ?>",
						status: status,
						method: method,
						remarks: res.value
					},
					dataType: "JSON",
					success: (data) => {
						if (data.success) {
							Swal.fire({
								type: "success",
								title: "Successfully Retruned This Document !!",
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

  function retransmit_to_client(btn, status, method) {
		Swal.fire({
			type: "warning",
			title: "Transmit to Client",
			text: "Are you sure to transmit this document ?",
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
					url: "<?= site_url('ndt_live/retransmit_to_client') ?>",
					type: "POST",
					data: {
						uniq_id_report: "<?= encrypt($main['uniq_id_report']) ?>",
						status: status,
						method: method
					},
					dataType: "JSON",
					success: (data) => {
						if (data.success) {
							Swal.fire({
								type: "success",
								title: "Successfully Transmited This Document !!",
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