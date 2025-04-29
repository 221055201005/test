<?php
error_reporting(0);

$allow_approval_date = false;

foreach ($joint_list as $value) {
    if ($value['status_inspection'] == 1) {
        $allow_approval_date = true;
    }
}

$fitup = $joint_list[0];

?>
<style type="text/css">
    .table {
        font-size: 100% !important;
        padding: 2px !important;
    }

    .select2-container {
        font-size: 70% !important;
        width: 100px !important;
        height: 20px !important;
    }

    .big-col {
        width: 600px !important;
    }

    .nav-link {
        color: #000;
    }

    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        color: #007bff;
        background: #fff;
        border-bottom: 2px solid #007bff;
        border-radius: 0px;
    }

    .select2 {
        width: 100% !important;
    }

    input[type=checkbox] {
        /* Double-sized Checkboxes */
        -ms-transform: scale(1.5);
        /* IE */
        -moz-transform: scale(1.5);
        /* FF */
        -webkit-transform: scale(1.5);
        /* Safari and Chrome */
        -o-transform: scale(1.5);
        /* Opera */
        transform: scale(1.5);
        padding: 10px;
    }
</style>


<div id="content" class="container-fluid">

    <?php

    if ($approval_type == 'client_qc') {
        $status_inspection = array_filter(array_column($joint_list, 'status_inspection'));
        $counting_process  = array_count_values($status_inspection);
        $total_pending_revise_smoe = $counting_process['1'];
    } else {
        $total_pending_revise_smoe = 0;
    }

    ?>


    <div class="row">
        <div class="col">
            <div class="card shadow my-3 rounded-0">
                <div class="card-header">
                    <h6 class="m-0">Inspection Data</h6>
                </div>
                <div class="card-body bg-white overflow-auto">

                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <label>Drawing No</label>
                                <?php if ($approval_type != 'client_qc') { ?>
                                    <input type="text" class="form-control" name="drawing_no" value="<?php echo $fitup['drawing_no'] ?> <?php echo "Rev." . $joint_list[0]['rev_no_drawing_asga_template']; ?>" readonly>
                                    <?php if (isset($activity_eng[$joint_list[0]['drawing_no']]['id'])) { ?>
                                        <?php
                                        $rev_link_ga_as = $joint_list[0]['rev_no_drawing_asga_template'];
                                        $links_atc = base_url_ftp_eng() . "public_smoe/open_atc/2/" . strtr($this->encryption->encrypt($activity_eng[$joint_list[0]['drawing_no']]['id']), '+=/', '.-~') . "/" . $rev_link_ga_as;
                                        $links_atc_cross = base_url_ftp_eng() . "public_smoe/open_atc_cross/2/" . strtr($this->encryption->encrypt($joint_list[0]['drawing_no']), '+=/', '.-~') . "/" . strtr($this->encryption->encrypt($activity_eng[$joint_list[0]['drawing_no']]['id']), '+=/', '.-~') . "/" . $rev_link_ga_as;
                                        ?>
                                        <a target='_blank' href='<?= $links_atc ?>' title='Attachment'> <i class='fas fa-paperclip'></i> Open Drawing </a>
                                        &nbsp;&nbsp;
                                        <a target='_blank' href='<?= $links_atc_cross ?>' title='Attachment' download='<?= $joint_list[0]['drawing_no'] ?>.pdf'>
                                            <i class='fas fa-cloud-download-alt'></i> Download Drawing
                                        </a>
                                    <?php } ?>
                                <?php } else { ?>
                                    <input type="text" class="form-control" name="drawing_no" value="<?php echo $fitup['drawing_no'] ?> <?php echo (isset($fitup['drawing_rev_no']) ? "Rev." . $fitup['drawing_rev_no'] : "Rev." . $joint_list[0]['rev_no_drawing_asga_template']); ?>" readonly>
                                    <?php if (isset($activity_eng[$joint_list[0]['drawing_no']]['id'])) { ?>
                                        <?php
                                        if (isset($fitup['drawing_rev_no'])) {
                                            $rev_link_ga_as = $fitup['drawing_rev_no'];
                                        } else {
                                            $rev_link_ga_as = $joint_list[0]['rev_no_drawing_asga_template'];
                                        }
                                        $links_atc = base_url_ftp_eng() . "public_smoe/open_atc/2/" . strtr($this->encryption->encrypt($activity_eng[$joint_list[0]['drawing_no']]['id']), '+=/', '.-~') . "/" . $rev_link_ga_as . "/" . strtr($this->encryption->encrypt(1), '+=/', '.-~');
                                        $links_atc_cross = base_url_ftp_eng() . "public_smoe/open_atc_cross/2/" . strtr($this->encryption->encrypt($joint_list[0]['drawing_no']), '+=/', '.-~') . "/" . strtr($this->encryption->encrypt($activity_eng[$joint_list[0]['drawing_no']]['id']), '+=/', '.-~') . "/" . $rev_link_ga_as . "/" . strtr($this->encryption->encrypt(1), '+=/', '.-~');
                                        ?>
                                        <a target='_blank' href='<?= $links_atc ?>' title='Attachment'> <i class='fas fa-paperclip'></i> Open Drawing </a>
                                        &nbsp;&nbsp;
                                        <a target='_blank' href='<?= $links_atc_cross ?>' title='Attachment' download='<?= $joint_list[0]['drawing_no'] ?>.pdf'>
                                            <i class='fas fa-cloud-download-alt'></i> Download Drawing
                                        </a>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                                <label>Discipline</label>
                                <input type="text" class="form-control" name="discipline" value="<?php echo (isset($discipline_name[$fitup['discipline']]) ? $discipline_name[$fitup['discipline']] : '-') ?>" disabled>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <label>Module</label>
                                <input type="text" class="form-control" name="module" value="<?php echo (isset($module_code[$fitup['module']]) ? $module_code[$fitup['module']] : '-') ?>" disabled>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                                <label>Type Of Module</label>
                                <input type="text" class="form-control" name="type_of_module" value="<?php echo (isset($type_of_module_name[$fitup['type_of_module']]) ? $type_of_module_name[$fitup['type_of_module']] : '-') ?>" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <label>Requestor Company</label>
                                <input type="text" class="form-control" name="company" value="<?php echo $fitup['company'] ?>" disabled>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                                <label>Request Date</label>
                                <input type="text" class="form-control" name="date_request" value="<?php echo date('d-F-y H:i:s', strtotime($fitup['date_request'])) ?>" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <label>Requestor Name</label>
                                <input type="text" class="form-control" name="requestor" value="<?php echo $user_list[$fitup['requestor']] ?>" disabled>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                                <label>Area</label>
                                <select class="select2 will_enable" name="area" id='area_v2'>
                                    <option value="">---</option>
                                    <?php foreach ($area_name_list_v2 as $value_area) { ?>
                                        <option value="<?= $value_area['id'] ?>" <?php if (isset($fitup['area_v2']) && $fitup['area_v2'] == $value_area['id']) {
                                                                                        echo "selected";
                                                                                    } ?>><?= $value_area['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <label>Location</label>
                                <select class="select2 will_enable" name="location" onchange="change_area(this)" id="location_v2">
                                    <option value="">---</option>
                                    <?php foreach ($location_name_list_v2 as $value_location) { ?>
                                        <option value="<?= $value_location['id'] ?>" data-chained="<?php echo $value_location['id_area'] ?>" <?php if (isset($fitup['location_v2']) && $fitup['location_v2'] == $value_location['id']) {
                                                                                                                                                    echo "selected";
                                                                                                                                                } ?>><?= $value_location['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                                <label>Point</label>
                                <select class="select2 will_enable" name="point" onchange="change_location(this)">
                                    <option value="">---</option>
                                    <?php foreach ($point_list as $value_point) { ?>
                                        <option value="<?= $value_point['id'] ?>" data-chained="<?php echo $value_point['id_location'] ?>" <?php if (isset($fitup['point_v2']) && $fitup['point_v2'] == $value_point['id']) {
                                                                                                                                                echo "selected";
                                                                                                                                            } ?>><?= $value_point['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>


    <form method="POST" action="<?php echo base_url(); ?>fitup/split_report_process" enctype="multipart/form-data">


        <input type="hidden" class="form-control" name="submission_id" value="<?php echo $joint_list[0]['submission_id'] ?>" required readonly>
        <input type="hidden" name="approval_code_log" value="FITUP/<?= $project_data_portal[0]["project_name"] ?>/<?= $report_number ?>/">

        <?php if ($approval_type == 'smoe_qc') { ?>
            <input type="hidden" name="param_inspection" value="qc">
        <?php } else { ?>
            <input type="hidden" name="param_inspection" value="client">
        <?php } ?>



        <div class="row">
            <div class="col">
                <div class="card shadow my-3 rounded-0">
                    <div class="card-header">
                        <h6 class="m-0">Inspection Detail -
                            <?php if ($approval_type == "smoe_qc") {
                                echo "Submission ID : " . $joint_list[0]['submission_id'];
                            } else if ($approval_type == "client_qc" && $joint_list[0]['project_code'] == 21) {
                                echo "Report Number : " . $master_report_number_deck[$joint_list[0]['project_code']][$joint_list[0]['discipline']][$joint_list[0]['type_of_module']][$joint_list[0]['deck_elevation']]["fitup_report"] . $joint_list[0]['report_number'];
                            } else {
                                echo "Report Number : " . $master_report_number[$joint_list[0]['project_code']][$joint_list[0]['discipline']][$joint_list[0]['type_of_module']]["fitup_report"] . $joint_list[0]['report_number'];
                            } ?>
                        </h6>
                    </div>
                    <div class="card-body bg-white overflow-auto">

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-lg-3 col-form-label ">Inspector Name</label>
                                    <div class="col-xl">
                                        <input type="hidden" class="form-control" name="inspection_by" value="<?php echo $user_cookie['0'] ?>" required readonly>
                                        <input type="text" class="form-control" name="inspector_name" value="<?php echo $user_cookie['1'] ?>" required readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <input type="hidden" class="form-control" name="wp_company" value="<?= $fitup["wp_company"] ?>" required>

                                    <?php if ($approval_type == 'smoe_qc' && $fitup['wp_company'] == '13' && $allow_approval_date) { ?>
                                        <label class="col-md-4 col-lg-3 col-form-label ">Approval Date</label>
                                        <div class="col-xl">
                                            <input type="date" class="form-control" name="inspection_datetime" required>
                                        </div>
                                    <?php } else if ($approval_type == 'client_qc' && $fitup['wp_company'] == '13' && $fitup['status_inspection'] == 5) { ?>
                                        <label class="col-md-4 col-lg-3 col-form-label ">Approval Date & Time</label>
                                        <div class="col-xl">
                                            <input type="date" class="form-control" name="inspection_datetime" required>
                                        </div>
                                    <?php } else { ?>
                                        <label class="col-md-4 col-lg-3 col-form-label ">Approval Date & Time</label>
                                        <div class="col-xl">
                                            <input type="text" class="form-control" name="inspection_datetime" value="<?php echo  date("d F Y H:i:s"); ?>" required readonly>
                                        </div>
                                    <?php } ?>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col">
                <div class="card shadow my-3 rounded-0">
                    <div class="card-header">
                        <h6 class="m-0">Fit-Up | Joint for Submission</h6>
                    </div>
                    <div class="card-body bg-white">

                        <!-- <input type="hidden" name="temporary_report_number" class="form-control" placeholder="Temporary Report Number" value='<?= (sizeof($missing_report_no) > 0 ? implode(",", $missing_report_no) : null)  ?>'> -->
                            <div class="row">

                                <?php if ($this->user_cookie[0] == '1') { ?>
                                    <div class="col-md-12">
                                        <!-- <strong><i>Insert Report No</i></strong> -->
                                    </div>
                                    <div class="col-md-8 mt-2">
                                        <div class="form-group row">
                                            <label for="" class="col-xl-3 col-form-label text-muted"></label>
                                            <div class="col-xl">

                                                <!-- <input type="hidden" name="temporary_report_number" class="form-control" placeholder="Temporary Report Number" value='<?= (sizeof($missing_report_no) > 0 ? implode(",", $missing_report_no) : null)  ?>'> -->
                                                <?php if (isset($missing_report_no)) { ?>
                                                    <br />
                                                    <div class='box red'>
                                                        Missing Report Number :
                                                    </div>
                                                    <div class='box red'>
                                                        <?php
                                                        $i = 1;
                                                        echo '<table>';
                                                        echo '<tr>';
                                                        foreach ($missing_report_no as $key => $value) {
                                                            $report_show = str_pad($value, 6, '0', STR_PAD_LEFT);
                                                            echo '<td style="padding:10px;font-weight:bold;">' . $report_show . '</td>';
                                                            if ($i % 10 == 0) {
                                                                echo '</tr><tr>';
                                                            }
                                                            $i++;
                                                        }
                                                        echo '</table>';
                                                        ?>
                                                    </div>
                                                <?php } ?>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12"></div>
                                <?php } ?>

                                <div class="col-md-12">
                                    <strong><i>Inspection Detail</i></strong>
                                </div>

                                <div class="col-md-8 mt-2">
                                    <div class="form-group row">
                                        <label for="" class="col-xl-3 col-form-label text-muted">Inspector Name</label>
                                        <div class="col-xl">
                                            <select name="inspector_id" class="select2" style="width: 100%" required>
                                                <option value="">---</option>
                                                <?php foreach ($user_list_inspector as $key => $value) : ?>
                                                    <option value="<?= $value['id_user'] ?>" <?= $value['id_user'] == $joint_list[0]['inspector_id'] ? 'selected' : '' ?>><?= $value['full_name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <!-- <input type="text" name="inspector_id" class="form-control" onfocus="autocomplete_inspector(this)"  required> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12"></div>
                                <div class="col-md-8">
                                    <div class="form-group row">
                                        <label for="" class="col-xl-3 col-form-label text-muted">Inspect Date</label>
                                        <div class="col-xl">
                                            <input type="date" name="inspect_date" class="form-control" value="<?php echo date('Y-m-d', strtotime($joint_list[0]['inspection_datetime'])) ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12"></div>
                                <div class="col-md-8">
                                    <div class="form-group row">
                                        <label for="" class="col-xl-3 col-form-label text-muted">Inspect Time</label>
                                        <div class="col-xl">
                                            <input type="time" name="inspect_time" class="form-control" value="<?php echo date('H:i', strtotime($joint_list[0]['time_inspect'])) ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12"></div>
                                <div class="col-md-8">
                                    <div class="form-group row">
                                        <label for="" class="col-xl-3 col-form-label text-muted">Client Notification</label>
                                        <div class="col-xl">
                                            <select name="status_invitation" class="form-control" style="width:100%" required>
                                                <option value="">~ Choice ~</option>
                                                <option value="0" <?= $joint_list[0]['status_invitation'] == 0 ? 'selected' : '' ?>>Notification - Client Invitation Witness</option>
                                                <option value="1" <?= $joint_list[0]['status_invitation'] == 1 ? 'selected' : '' ?>>Notification - SMOE Activity</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12"></div>
                                <div class="col-md-8">
                                    <div class="form-group row">
                                        <label for="" class="col-xl-3 col-form-label text-muted">Legend Inspection Authority AS PER ITP</label>
                                        <div class="col-xl">
                                            <?php $arr_inspection_auth = explode(";",$joint_list[0]['legend_inspection_auth']); ?>
                                            <select name="legend_inspection_auth[]" class="select2" style="width:100%" multiple="" required>
                                                <option value="">~ Choice ~</option>
                                                <option value="0" <?= $arr_inspection_auth[0] == 1 ? 'selected' : '' ?>>Hold Point</option>
                                                <option value="1" <?= $arr_inspection_auth[1] == 1 ? 'selected' : '' ?>>Witness</option>
                                                <option value="2" <?= $arr_inspection_auth[2] == 1 ? 'selected' : '' ?>>Monitoring</option>
                                                <option value="3" <?= $arr_inspection_auth[3] == 1 ? 'selected' : '' ?>>Review</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12"></div>
                                <div class="col-md-8">
                                    <div class="form-group row">
                                        <label for="" class="col-xl-3 col-form-label text-muted">Drawing GA/AS - Rev No : </label>
                                        <div class="col-xl">
                                            <select name="drawing_rev_no_new" class="select2" style="width:100%" required>
                                                <option value="">~ Choice ~</option>
                                                <?php foreach ($list_revision_ga_as as $key => $value) { ?>
                                                    <option value='<?= $value ?>' <?= $value == $joint_list[0]['drawing_rev_no'] ? 'selected' : '' ?>><?= $value ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12"></div>
                                <div class="col-md-8">
                                    <div class="form-group row">
                                        <label for="" class="col-xl-3 col-form-label text-muted"></label>
                                        <div class="col-xl">
                                            <span class='add_drawing_ga_as'>-</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12"></div>
                                <div class="col-md-8">
                                    <div class="form-group row">
                                        <label for="" class="col-xl-3 col-form-label text-muted">Drawing Weld Map - Rev No : </label>
                                        <div class="col-xl">
                                            <select name="drawing_wm_rev_approved_new" class="select2" style="width:100%" required>
                                                <option value="">~ Choice ~</option>
                                                <?php foreach ($list_revision_wm as $key => $value) { ?>
                                                    <option value='<?= $value ?>' <?= $value == $joint_list[0]['drawing_wm_rev_approved'] ? 'selected' : '' ?>><?= $value ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12"></div>
                                <div class="col-md-8">
                                    <div class="form-group row">
                                        <label for="" class="col-xl-3 col-form-label text-muted"></label>
                                        <div class="col-xl">
                                            <span class='add_drawing_ga_wm'>-</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12"></div>
                                <div class="col-md-8">
                                    <div class="form-group row">
                                        <label for="" class="col-xl-3 col-form-label text-muted">Remarks</label>
                                        <div class="col-xl">
                                            <textarea name="invitation_remarks" class="form-control"><?= $joint_list[0]['invitation_remarks'] ?></textarea>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <hr>
                        <?php // endif; ?>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card shadow my-3 rounded-0">
                    <div class="card-header">
                        <h6 class="m-0">Joint Number List</h6>
                    </div>
                    <div class="card-body bg-white overflow-auto">

                        <div class="col-md-12">
                            <br />
                            <ul class="nav nav-pills border-bottom border-gray" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Detail</a>
                                </li>
                            </ul>
                            <br />
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <div class="table-responsive overflow-auto">

                                                <?php if (isset($dt_client) && $dt_client != 'client') { ?>

                                                    <?php if (isset($joint_list[0]['inspection_datetime'])) {  ?>

                                                        <?php $status_inspection = array_column($joint_list, 'status_inspection'); ?>

                                                        <?php if (in_array(1, $status_inspection)) { ?>

                                                            <div class="form-check">
                                                                &nbsp;&nbsp;&nbsp;<input class="form-check-input" type="checkbox" name='ticked_report_date' value="1" id="flexCheckChecked">
                                                                <label class="form-check-label" for="flexCheckChecked"> <span style='font-weight:bold !important;'> Use Current Date as Approval Date? </span> </label>
                                                            </div>

                                                <?php }
                                                    }
                                                } ?>

                                                <table class="table table-hover text-center overflow-auto dataTable">
                                                    <thead class="bg-gray-table">
                                                        <tr>
                                                            <th class="big-col">#</th>
                                                            <th style="width: 260px !important;">Weld Map Drawing Number</th>
                                                            <th style="width: 50px !important;">Joint No</th>
                                                            <th style="width: 50px !important;">Inspection Date</th>
                                                            <th style="width: 50px !important;">Surveyor Images</th>
                                                            <?php if ($dt_client == 'clientxxx') { ?>
                                                                <th style="width: 300px !important;">Attachment</th>
                                                            <?php } ?>
                                                            <th style="width: 155px !important;">Part ID</th>
                                                            <th style="width: 190px !important;">Unique ID Number</th>
                                                            <th style="width: 80px !important;">Heat Number</th>
                                                            <th style="width: 95px !important;">Material Grade</th>

                                                            <th style="width: 95px !important;">Joint Class</th>
                                                            <th style="width: 15px !important;">Dia/Size</th>
                                                            <th style="width: 15px !important;">Sch</th>
                                                            <th style="width: 15px !important;">Thk<br />(mm)</th>

                                                            <th style="width: 15px !important;">Weld<br />Length<br />(mm)</th>

                                                            <!-- <th style="width: 120px !important;">Fitter Code</th> -->
                                                            <th style="width: 120px !important;">WPS Code</th>

                                                            <th style="width: 200px !important;">Remarks</th>
                                                            <?php if ($this->user_cookie[7] != 8) { ?>
                                                                <th style="width: 200px !important;">Rejected Remarks</th>

                                                            <?php } ?>
                                                            <th style="width: 200px !important;">Client Remarks</th>
                                                            <?php if ($this->user_cookie[7] != 8) { ?>
                                                                <th style="width: 200px !important;">Action Update</th>
                                                            <?php } ?>
                                                        </tr>
                                                    </thead>
                                                    <tbody>


                                                        <?php $no = 0;
                                                        $no_pending = 0;
                                                        $no_approved_client = 0;
                                                        foreach ($joint_list as $key => $value) : ?>

                                                            <?php

                                                            if (isset($approval_type) and $approval_type == "smoe_qc") {
                                                                if ($value['status_inspection'] == 1) {
                                                                    $no_pending++;
                                                                }
                                                            } else {
                                                                if ($value['status_inspection'] == 5) {
                                                                    $no_pending++;
                                                                } else if ($value['status_inspection'] == 7) {
                                                                    $no_approved_client++;
                                                                }
                                                            }

                                                            ?>

                                                            <tr>
                                                                <td class="text-nowrap">


                                                                    <input type="hidden" name="report_no_validated[<?= $no ?>]" value="<?= @$value['report_number'] ?>">
                                                                    <input type="hidden" name="status_data[<?= $no ?>]" value="<?= $value['status_inspection'] ?>">
                                                                    <input type="hidden" name="drawing_rev_no" value="<?= $drawing_rev_no ?>">
                                                                    <input type="hidden" name="id_fitup[<?php echo $no ?>]" value="<?php echo $value['id_fitup']; ?>">
                                                                    <input type="hidden" name="report_number[<?php echo $no ?>]" value="<?php echo $value['report_number']; ?>">
                                                                    <input type="hidden" name="project_code" value="<?php echo $value['project_code']; ?>">
                                                                    <input type="hidden" name="discipline" value="<?php echo $value['discipline']; ?>">
                                                                    <input type="hidden" name="module" value="<?php echo $value['module']; ?>">
                                                                    <input type="hidden" name="type_of_module" value="<?php echo $value['type_of_module']; ?>">
                                                                    <input type="hidden" name="company_id" value="<?php echo $value['company_id']; ?>">
                                                                    <input type="hidden" name="deck_elevation" value="<?php echo $value['deck_elevation']; ?>">
                                                                    <input type="hidden" name="id_joint[<?= $no ?>]" value="<?php echo $value['id_joint']; ?>">


                                                                    <input type='checkbox' class='checkbox-split' onclick="validateCheckbox()" name='submit_id[<?php echo $no; ?>]' value="<?php echo $value['id_fitup'] ?>">


                                                                </td>
                                                                <td class="text-nowrap">

                                                                    <input type='hidden' name='latest_inspection_status[<?= $no ?>]' value='<?php echo $value['latest_inspection_status'] ?>' />

                                                                    <?php if ($value['status_inspection'] >= 3 && isset($value['drawing_wm_approved'])) { ?>
                                                                        <!-- <?php echo $value['drawing_wm_approved'] ?> Rev.<?php echo $value['drawing_wm_rev_approved'] ?> -->

                                                                        <input type='hidden' name='save_wm[<?= $no ?>]' value='<?= $value['drawing_wm'] ?>' />
                                                                        <input type='hidden' name='save_wm_rev[<?= $no ?>]' value='<?= $value['rev_wm'] ?>' />

                                                                        <input type='hidden' name='status_keep_drawing[<?= $no ?>]' value='1' />

                                                                    <?php } else { ?>

                                                                        <!-- <?php echo $value['drawing_wm'] ?> Rev.<?php echo $value['rev_wm'] ?> -->

                                                                        <input type='hidden' name='save_wm' value='<?= $value['drawing_wm'] ?>' />
                                                                        <input type='hidden' name='save_wm_rev' value='<?= $value['rev_wm'] ?>' />

                                                                        <input type='hidden' name='status_keep_drawing[<?= $no ?>]' value='0' />

                                                                    <?php } ?>
                                                                    <?php if ($approval_type != 'client_qc') { ?>
                                                                        <?php echo $value['drawing_wm'] ?> Rev.<?php echo $value['rev_wm'] . '<br>' . (!empty($value['spool_no']) ? 'Spool No : ' . $value['spool_no'] : ''); ?>
                                                                    <?php } else { ?>
                                                                        <?php echo $value['drawing_wm'] ?> Rev.<?php echo (isset($value['drawing_wm_rev_approved']) ? $value['drawing_wm_rev_approved'] : $value['rev_wm']) . '<br>' . (!empty($value['spool_no']) ? '<br>' . 'Spool No : ' . $value['spool_no'] : '') ?>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $value['joint_no']
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo date('Y-m-d', strtotime($value['inspection_datetime'])) ?>
                                                                    <br>
                                                                    <?php echo date('H:i', strtotime($value['time_inspect'])) ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (isset($image_fu[$value['id_joint']])) { ?>
                                                                        <?php
                                                                        $enc_redline = strtr($this->encryption->encrypt($image_fu[$value['id_joint']]), '+=/', '.-~');
                                                                        $enc_path   = strtr($this->encryption->encrypt('/PCMS/mobile/pcms_v2_mobile/pcms_v2_photo/'), '+=/', '.-~');
                                                                        ?>
                                                                        <a target='_blank' href='<?= site_url('irn/open_file/' . $enc_redline . '/' . $enc_path) ?>'><span class='btn btn-primary'><i class="fas fa-images"></i></span></a>
                                                                        <!-- <img src="<?= $this->link_server ?>/pcms_v2_photo/<?= $image_fu[$value['id_joint']] ?>" style='width: 80px;' onclick="show_image(this, '<?= $image_fu[$value['id_joint']] ?>', 'surveyor')"/> -->
                                                                    <?php } else { ?>
                                                                        <img src="<?php echo base_url(); ?>/img/img_not_avai.png" style='width: 80px;'>
                                                                    <?php } ?>
                                                                    <span class='badge'><?= (isset($user_list[$value['surveyor_creator']]) ? $user_list[$value['surveyor_creator']] : $user_list[$value['requestor']]);  ?></span><br />
                                                                    <span class='badge'><?= (isset($value['surveyor_created_date']) ? $value['surveyor_created_date'] : $value['date_request']); ?></span>
                                                                </td>
                                                                <?php if ($dt_client == 'clientxxx') { ?>
                                                                    <td>


                                                                        <?php if (isset($attachment_history[$value['id_fitup']])) { ?>

                                                                            <div class="row mt-3">
                                                                                <div class="col-md-12">
                                                                                    <div class="table-responsive">
                                                                                        <table class="table table-bordered">
                                                                                            <thead class="alert-success ">
                                                                                                <th>No</th>
                                                                                                <th>Attachment</th>
                                                                                                <th>Uploaded By</th>
                                                                                                <th>Uploaded Date</th>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                <?php $no_attachment = 1;
                                                                                                foreach ($attachment_history[$value['id_fitup']] as $v) : ?>
                                                                                                    <tr>
                                                                                                        <td><?= $no_attachment++ ?></td>
                                                                                                        <td>

                                                                                                            <?php
                                                                                                            $enc_redline = strtr($this->encryption->encrypt($v['filename']), '+=/', '.-~');
                                                                                                            $enc_path   = strtr($this->encryption->encrypt('/PCMS/mobile/pcms_v2_mobile/pcms_v2_photo/fab_img/'), '+=/', '.-~');
                                                                                                            ?>
                                                                                                            <a target='_blank' href='<?= site_url('irn/open_file/' . $enc_redline . '/' . $enc_path) ?>'><span class='btn btn-primary'><i class="fas fa-images"></i></span></a>

                                                                                                            <!-- <img src="<?= $this->link_server ?>/pcms_v2_photo/fab_img/<?= $v['filename'] ?>" style='width: 80px;' onclick="show_image(this, '<?= $v['filename'] ?>', 'client')"/> -->

                                                                                                            <!-- <button type="button" class="btn btn-info"  onclick="show_image(this, '<?= $v['filename'] ?>', 'client')"><i  class="fas fa-image"></i></button> -->

                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <?= isset($uploader[$v['created_by']]) ? $uploader[$v['created_by']]['full_name'] : '-' ?>
                                                                                                        </td>
                                                                                                        <td><?= $v['created_date'] ?></td>
                                                                                                    </tr>
                                                                                                <?php endforeach; ?>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        <?php } else { ?>
                                                                            <img src="<?php echo base_url(); ?>/img/img_not_avai.png" style='width: 80px;'><br /><br />
                                                                        <?php } ?>
                                                                        <div class="form-check">
                                                                            <input type="file" name="attachment_client[<?php echo $no; ?>]">
                                                                        </div>
                                                                        <br />
                                                                    </td>
                                                                <?php } ?>
                                                                <td>
                                                                    <?php
                                                                    $pos_1  = explode(";", $value['pos_1']);
                                                                    foreach ($pos_1 as $pc1) {
                                                                        if (isset($activity_eng[$status_piecemark[$pc1]['drawing_sp']]['id'])) {
                                                                            $drawing_sp_rev_p1 = $status_piecemark[$pc1]['rev_sp'];
                                                                            $links_sp_p1 = base_url_ftp_eng() . "public_smoe/open_atc/2/" . strtr($this->encryption->encrypt($activity_eng[$status_piecemark[$pc1]['drawing_sp']]['id']), '+=/', '.-~') . '/' . $drawing_sp_rev_p1;
                                                                        } else {
                                                                            $links_sp_p1 = null;
                                                                        }
                                                                        if (isset($links_sp_p1)) {
                                                                    ?>
                                                                            <a href='<?= $links_sp_p1 ?>' target='_blank' style='color:black !important;'>
                                                                                <span class='badge'><?php echo $pc1; ?></span>
                                                                            </a>
                                                                    <?php
                                                                        } else {
                                                                            echo "<span class='badge'>" . $pc1 . "</span><hr/>";
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <?php
                                                                    $pos_2  = explode(";", $value['pos_2']);
                                                                    foreach ($pos_2 as $pc2) {
                                                                        if (isset($activity_eng[$status_piecemark[$pc2]['drawing_sp']]['id'])) {
                                                                            $drawing_sp_rev_p2 = $status_piecemark[$pc2]['rev_sp'];
                                                                            $links_sp_p2 = base_url_ftp_eng() . "public_smoe/open_atc/2/" . strtr($this->encryption->encrypt($activity_eng[$status_piecemark[$pc2]['drawing_sp']]['id']), '+=/', '.-~') . '/' . $drawing_sp_rev_p2;
                                                                        } else {
                                                                            $links_sp_p2 = null;
                                                                        }

                                                                        if (isset($links_sp_p2)) {
                                                                    ?>
                                                                            <a href='<?= $links_sp_p2 ?>' target='_blank' style='color:black !important;'>
                                                                                <span class='badge'><?php echo $pc2; ?></span>
                                                                            </a>
                                                                    <?php
                                                                        } else {
                                                                            echo "<span class='badge'>" . $pc2 . "</span><hr/>";
                                                                        }
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    $pos_1  = explode(";", $value['pos_1']);
                                                                    foreach ($pos_1 as $pc1) {
                                                                        echo "<span class='badge'>" . (isset($warehouse_mis_mrir[$status_piecemark[$pc1]["id_mis"]]['unique_ident_no']) ? $warehouse_mis_mrir[$status_piecemark[$pc1]["id_mis"]]['unique_ident_no'] : "-") . "</span><hr/>";
                                                                    }
                                                                    $pos_2  = explode(";", $value['pos_2']);
                                                                    foreach ($pos_2 as $pc2) {
                                                                        echo "<span class='badge'>" . (isset($warehouse_mis_mrir[$status_piecemark[$pc2]["id_mis"]]['unique_ident_no']) ? $warehouse_mis_mrir[$status_piecemark[$pc2]["id_mis"]]['unique_ident_no'] : "-") . "</span><hr/>";
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    $pos_1  = explode(";", $value['pos_1']);
                                                                    foreach ($pos_1 as $pc1) {
                                                                        echo "<span class='badge'>" . (isset($warehouse_mis_mrir[$status_piecemark[$pc1]["id_mis"]]['unique_ident_no']) ? $warehouse_mis_mrir[$status_piecemark[$pc1]["id_mis"]]['heat_or_series_no'] : "-") . "</span><hr/>";
                                                                    }
                                                                    $pos_2  = explode(";", $value['pos_2']);
                                                                    foreach ($pos_2 as $pc2) {
                                                                        echo "<span class='badge'>" . (isset($warehouse_mis_mrir[$status_piecemark[$pc2]["id_mis"]]['unique_ident_no']) ? $warehouse_mis_mrir[$status_piecemark[$pc2]["id_mis"]]['heat_or_series_no'] : "-") . "</span><hr/>";
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    $pos_1  = explode(";", $value['pos_1']);
                                                                    foreach ($pos_1 as $pc1) {
                                                                        echo "<span class='badge'>" . (isset($material_grade[$status_piecemark[$pc1]["grade"]]['material_grade']) ? $material_grade[$status_piecemark[$pc1]["grade"]]['material_grade'] : "-") . "</span><hr/>";
                                                                    }
                                                                    $pos_2  = explode(";", $value['pos_2']);
                                                                    foreach ($pos_2 as $pc2) {
                                                                        echo "<span class='badge'>" . (isset($material_grade[$status_piecemark[$pc2]["grade"]]['material_grade']) ? $material_grade[$status_piecemark[$pc2]["grade"]]['material_grade'] : "-") . "</span><hr/>";
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td class="ball" style="vertical-align: middle;text-align: center;">
                                                                    <?php echo @$class_list[$value["class"]] ?>
                                                                </td>

                                                                <td>
                                                                    <?php
                                                                    $pos_1  = explode(";", $value['pos_1']);
                                                                    foreach ($pos_1 as $pc1) {
                                                                        echo "<span class='badge'>" . (isset($status_piecemark[$pc1]["diameter"]) ? $status_piecemark[$pc1]["diameter"] : "-") . "</span><hr/>";
                                                                    }
                                                                    $pos_2  = explode(";", $value['pos_2']);
                                                                    foreach ($pos_2 as $pc2) {
                                                                        echo "<span class='badge'>" . (isset($status_piecemark[$pc2]["diameter"]) ? $status_piecemark[$pc2]["diameter"] : "-") . "</span><hr/>";
                                                                    }
                                                                    ?>
                                                                </td>

                                                                <td>
                                                                    <?php
                                                                    $pos_1  = explode(";", $value['pos_1']);
                                                                    foreach ($pos_1 as $pc1) {
                                                                        echo "<span class='badge'>" . (isset($status_piecemark[$pc1]["sch"]) ? $status_piecemark[$pc1]["sch"] : "-") . "</span><hr/>";
                                                                    }
                                                                    $pos_2  = explode(";", $value['pos_2']);
                                                                    foreach ($pos_2 as $pc2) {
                                                                        echo "<span class='badge'>" . (isset($status_piecemark[$pc2]["sch"]) ? $status_piecemark[$pc2]["sch"] : "-") . "</span><hr/>";
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    $pos_1  = explode(";", $value['pos_1']);
                                                                    foreach ($pos_1 as $pc1) {
                                                                        echo "<span class='badge'>" . (isset($status_piecemark[$pc1]["thickness"]) ? $status_piecemark[$pc1]["thickness"] : "-") . "</span><hr/>";
                                                                    }
                                                                    $pos_2  = explode(";", $value['pos_2']);
                                                                    foreach ($pos_2 as $pc2) {
                                                                        echo "<span class='badge'>" . (isset($status_piecemark[$pc2]["thickness"]) ? $status_piecemark[$pc2]["thickness"] : "-") . "</span><hr/>";
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td><?php echo $value['weld_length']; ?></td>

                                                                <!-- <td class="text-nowrap">
                                        <?php
                                                            $fitter_id_display = explode(";", $value['fitter_id']);
                                                            foreach ($fitter_id_display as $key => $val_fitter) {
                                                                if (isset($fitter_code_arr[$val_fitter])) {
                                                                    echo $fitter_code_arr[$val_fitter] . "<br/>";
                                                                }
                                                            }
                                        ?>
                                      </td> -->
                                                                <td>
                                                                    <?php
                                                                    $wps_no_display = explode(";", $value['wps_no']);
                                                                    foreach ($wps_no_display as $key => $val_wps) {
                                                                        if (isset($wps_no_arr[$val_wps])) {
                                                                            echo $wps_no_arr[$val_wps] . "<br/>";
                                                                        }
                                                                    }
                                                                    ?>
                                                                </td>

                                                                <td>
                                                                    <?php echo $value["remarks"]; ?>

                                                                    <?php
                                                                    if (isset($value["pending_qc_remarks"]) and $value['status_inspection'] == '4') {
                                                                        echo "<br/><span style='font-size:12px !important;'><b>Inspector Remarks :</b><br/>" . $value["pending_qc_remarks"] . "</span>";
                                                                    }
                                                                    ?>

                                                                    <?php
                                                                    if (isset($value["inspection_remarks"]) && !empty($value["inspection_remarks"])) {
                                                                        echo "<br/><span style='font-size:12px !important;'><b>Inspector Remarks :</b><br/>" . $value["inspection_remarks"] . "</span>";
                                                                    }
                                                                    ?>
                                                                </td>

                                                                <?php if ($this->user_cookie[7] != 8) { ?>

                                                                    <td>
                                                                        <?php echo $value["rejected_remarks"]; ?>
                                                                    </td>



                                                                <?php } ?>

                                                                <td>

                                                                    <?php
                                                                    if (!isset($value["reoffer_remarks"]) && empty($value["reoffer_remarks"]) && $value["reoffer_remarks"] != "-") {
                                                                        $where["id_joint"] = $value['id_joint'];
                                                                        $where["id_fitup <> " . $value['id_fitup']] = null;
                                                                        $re_offer_remarks = $this->fitup_mod->fitup_list_remarks($where);
                                                                        unset($where);

                                                                        echo (isset($re_offer_remarks[0]["reoffer_remarks"]) ? $re_offer_remarks[0]["reoffer_remarks"] : (isset($re_offer_remarks[0]["postpone_remarks"]) ? $re_offer_remarks[0]["postpone_remarks"] : "-"));
                                                                    } else {
                                                                    ?>

                                                                        <?php echo (isset($value["reoffer_remarks"]) ? $value["reoffer_remarks"] : (isset($value["postpone_remarks"]) ? $value["postpone_remarks"] : "-")); ?>
                                                                    <?php } ?>
                                                                </td>

                                                                <td>
                                                                    <?php if ($no_pending <= 0 && $no_approved_client <= 0) { ?>
                                                                        <?php if ($this->user_cookie[7] != 8) {  ?>
                                                                            <?php if (!in_array($value['status_inspection'], array(5, 6, 7, 12))) {  ?>
                                                                                <?php if ($value['requested_for_update'] == 1) : ?>
                                                                                    <span class="btn btn-secondary"><i class="fas fa-hourglass-half"></i> Requested For Update</span>
                                                                                <?php else : ?>
                                                                                    <button type="button" onclick="request_for_update(this, '<?= $value['submission_id'] ?>')" class="btn btn-warning"><i class="fas fa-edit"></i> Request For Update</button>
                                                                                <?php endif; ?>
                                                                            <?php } ?>
                                                                        <?php } ?>
                                                                    <?php } ?>
                                                                </td>

                                                            </tr>
                                                        <?php $no++;
                                                        endforeach; ?>
                                                    </tbody>
                                                </table>


                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                            <div class="float-right">


                                                <?php if ($this->user_cookie[7] == 8) { ?>
                                                    <a href="<?= site_url('fitup/client_list') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                                                <?php } else { ?>
                                                    <a href="<?= site_url('fitup/inspection_list') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                                                <?php } ?>

                                                <?php if (isset($joint_list[0]['report_number']) and !empty($joint_list[0]['report_number']) && $dt_client == "client") { ?>

                                                    <a href='<?php echo  base_url(); ?>fitup/pdf_files_client/<?php echo strtr($this->encryption->encrypt($joint_list[0]['project_code']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['discipline']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['module']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['type_of_module']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['report_number']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['company_id']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['deck_elevation']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['postpone_reoffer_no']), '+=/', '.-~'); ?>' target='_blank'><button class='btn btn-success' type="button"><i class="fas fa-file-pdf"></i> RFI</button></a>
                                                    <a href='<?php echo  base_url(); ?>fitup/pdf_files/<?php echo strtr($this->encryption->encrypt($joint_list[0]['project_code']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['discipline']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['module']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['type_of_module']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['report_number']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['company_id']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['company_id']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['company_id']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['deck_elevation']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['postpone_reoffer_no']), '+=/', '.-~'); ?>' target='_blank'><button class='btn btn-danger' type="button"><i class="fas fa-file-pdf"></i> Report</button></a>

                                                <?php } else { ?>

                                                    <a href='<?php echo  base_url(); ?>fitup/pdf_files/<?php echo strtr($this->encryption->encrypt($joint_list[0]['project_code']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['discipline']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['module']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['type_of_module']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt('marz'), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['submission_id']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['company_id']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['company_id']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['deck_elevation']), '+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($joint_list[0]['postpone_reoffer_no']), '+=/', '.-~'); ?>' target='_blank'>
                                                    <button type="button" class='btn btn-danger'><i class="fas fa-file-pdf"></i> SMOE Inspection Report</button></a>
                                                    
                                                <?php } ?>

                                                    <button type="submit" name="submit" id="split-btn" class="btn btn-primary" value="split" title="Submit"><i class="fas fa-save"></i> Split</button>
                                                    <button type="submit" name="submit" id="return-btn" class="btn btn-warning" value="return" title="Submit"><i class="fas fa-undo"></i> Return</button>

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
    </form>


    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>

</div>
</div>


<script type="text/javascript">
    $("#mySelect").select2();

    $('.dataTable').DataTable({
        "paging": false,
        "ordering": false,
    })

    $("select[name=module]").chained("select[name=project]");


    function show_image(btn, source, type) {

        if (type == "client") {
            var url = "<?= $this->link_server ?>/pcms_v2_photo/fab_img/" + source
        } else {
            var url = "<?= $this->link_server ?>/pcms_v2_photo/" + source

        }


        var image_content = `
    <div class="row">
      <div class="col-md-12">
        <img src="${url}" style="width : 100%">
      </div>
      <div class="col-md-12">
        <hr>
        <div class="float-right">
          <button class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
        </div>
      </div>
    </div>
  `

        $("#modal").modal({
            show: true,
            keyboard: false,
            backdrop: "static"
        }).find('.modal-body').html(image_content)
        $('.modal-title').text("Attachment")
        $('.modal-dialog').addClass('modal-lg')
    }

    function change_area(event) {
        let area = $('#area_v2').val();
        var location = event.value;

        if (location != null && location != "") {

            Swal.fire({
                type: "warning",
                title: "Update Area",
                text: "Are You Sure To Update This Area ? ",
                allowOutsideClick: false,
                showCancelButton: true
            }).then((res) => {
                if (res.value) {
                    $.ajax({
                        url: "<?= site_url('fitup/update_area') ?>",
                        type: "POST",
                        data: {
                            area: area,
                            location: location,
                            submission_id: "<?= $joint_list[0]['submission_id'] ?>"
                        },
                        dataType: "JSON",
                        success: function(data) {
                            if (data.success) {
                                Swal.fire({
                                    type: "success",
                                    title: "Success",
                                    text: "Success Update Area",
                                    timer: 1000
                                })
                                // location.reload();
                            }
                        }
                    })
                } else {}
            })

        }

    }

    function change_location(event) {
        let location = $('#location_v2').val();
        var point = event.value;

        if (point != null && point != "") {

            Swal.fire({
                type: "warning",
                title: "Update Point",
                text: "Are You Sure To Update This Point ? ",
                allowOutsideClick: false,
                showCancelButton: true
            }).then((res) => {
                if (res.value) {
                    $.ajax({
                        url: "<?= site_url('fitup/update_location') ?>",
                        type: "POST",
                        data: {
                            location: location,
                            point: point,
                            submission_id: "<?= $joint_list[0]['submission_id'] ?>"
                        },
                        dataType: "JSON",
                        success: function(data) {
                            if (data.success) {
                                Swal.fire({
                                    type: "success",
                                    title: "Success",
                                    text: "Success Update Point",
                                    timer: 1000
                                })
                                // location.reload();
                            }
                        }
                    })
                } else {}
            })

        }

    }
</script>

<script type="text/javascript">
    $("select[name=location]").chained("select[name=area]");
    $("select[name=point]").chained("select[name=location]");
</script>

<script type="text/javascript"> 

    $(document).ready(function() {
        
        let checkbox = $('.checkbox-split');
        let submitButton = $('#split-btn');
        let returnButton = $('#return-btn');
        
        if (checkbox.length === 1) {
                checkbox.hide();
                submitButton.hide();
                returnButton.hide();
        }

        $('form').on('submit', function() {
            Swal.fire({
                title: 'Processing...',
                allowOutsideClick: false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                },
            });
        })
    });

    function validateCheckbox() {

        let checkbox = $('.checkbox-split');
        let selectedCheckboxes = $('.checkbox-split:checked');
        let allCheckboxes = checkbox.length;


        if (selectedCheckboxes.length === allCheckboxes) {
            Swal.fire({
                type: "error",
                title:"Error !",
                text: "Sorry, Cannot checked all data ! ",
                confirmButtonText: 'OK'
            })
            event.target.checked = false;
        }
    }

</script>