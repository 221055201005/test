<?php
$server_warehouse = ($this->user_cookie[12] == getenv('IP_FIREWALL_GATEWAY') ? getenv('LINK_WAREHOUSE_OUTSIDE') : getenv('LINK_WAREHOUSE'));
error_reporting(0);
?>
<?php //$this->load->view('_partial/header');
?>
<style>
    .buttonxx {
        background-color: #4CAF50;
        /* Green */
        border: none;
        color: white;
        padding: 10px 12px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        transition-duration: 0.4s;
        cursor: pointer;
    }

    .button3xx {
        background-color: white;
        color: black;
        border: 2px solid #f44336;
    }

    .button3xx:hover {
        background-color: #f44336;
        color: white;
    }

    .button4xx {
        background-color: white;
        color: black;
        border: 2px solid #001aff;
    }

    .button4xx:hover {
        background-color: #001aff;
        color: white;
    }

    .button5xx {
        background-color: white;
        color: black;
        border: 2px solid #0f8c31;
    }

    .button5xx:hover {
        background-color: #0f8c31;
        color: white;
    }
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>img/favicon_seatrium.png" />
    <title><?= $meta_title; ?></title>
    <style type="text/css">
        .bg-selected {
            background-color: #949494;
        }

        body {
            top: 1cm !important;
            left: 0cm !important;
            right: 0cm !important;
            margin-left: 0.5cm !important;
            margin-right: 0.5cm !important;
            margin-bottom: 0cm !important;
            margin-top: 0cm !important;
            font-family: "helvetica";
            font-size: 7px !important;
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
            /*width: 16px;
            height: 16px;
            padding: 0;
            margin:0;
            vertical-align: bottom;
            position: relative;
            top: -1px;
            *overflow: hidden;*/
        }

        input[type=checkbox] {

            width: 16px;
            height: 16px;
            padding: 0;
            margin: 0;
            vertical-align: bottom;
            position: relative;
            top: -1px;
            *overflow: hidden;

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

        .table {
            word-wrap: break-word;
        }

        .wtr {
            border-collapse: collapse;
            width: 100%;
        }

        .wtr td {
            border: 0.10px solid #000000;
            word-wrap: break-word;
            text-align: center;
        }

        .wtr th {
            border: 0.10px solid #000000;
            word-wrap: break-word;
            font-weight: bold;
            vertical-align: middle !important;
            text-align: center;
        }

        .color_pending_client {
            color: #ff0000;
        }

        .color_pending_QC {
            background-color: #6bff93;
        }


        .color_date {
            background-color: #ffff00;
        }

        .size-textarea {
            width: 300px;
            height: 25px !important;
            font-size: 16px;
        }
    </style>
</head>

<body>

    <?php $no_max = sizeof($show_data_irn_list_filter);
    $no = 1;
    foreach ($show_data_irn_list_filter as $key => $loop_val) { ?>

        <?php if ($wtr_list[0]['mwtr_signed_status_inspection'] == "0") { ?>
            <a href='<?= base_url() ?>Wtr/import_joint/<?= $wtr_list[0]['mwtr_signed_uniq_id'] ?>/<?= $loop_val["drawing_no"] ?>' class='buttonxx button4xx'>
                Add New Joint
            </a>
        <?php } ?>

        <table width="100%">
            <tr>
                <td width="15%;" style="padding: 10px; border-right: 0px !important;">
                    <center>
                        <img src="<?= base_url('img/seatrium_logo_bg_white.png') ?>" style='width: 160px; height: 50px;' />
                    </center>
                </td>
                <td style="padding: 10px; border-right: 0px !important; border-left: 0px !important;">
                    <center>
                        <b style="font-weight: bold; font-size: 20 !important; vertical-align: middle !important;">
                            <?php echo $project_client_description[$loop_val["project"]] ?>
                        </b>
                    </center>
                </td>
                <td width="15%;" style="padding: 10px; border-left: 0px !important;">
                    <center>
                        <img src="<?php echo $client_logo[$loop_val["project"]]; ?>" style='width: 160px; height: 50px;' />
                    </center>
                </td>

            </tr>
        </table>

        <table width="100%">
            <tr>
                <td width="40%">
                    <table class='title_desc' width="100%">
                        <thead>
                            <tr>
                                <th style='text-align:left !important;'>PROJECT NAME</th>
                                <th>:</th>
                                <th style='text-align:left !important;'><?= strtoupper($project_name[$joint_list[0]["project"]]); ?></th>
                            </tr>
                            <tr>
                                <th style='text-align:left !important;'>JOB NO</th>
                                <th>:</th>
                                <th style='text-align:left !important;'>
                                    <textarea name="job_no" onblur="saveJobNumber(this)" class="size-textarea"><?= $wtr_list[0]['job_no'] ?></textarea>
                                </th>
                            </tr>
                            <script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery/jquery-3.4.1.min.js"></script>
                            <script src="<?php echo base_url('assets/sweetalert2/sweetalert2.all.min.js') ?>"></script>

                            <script type="text/javascript">
                                function saveJobNumber(ini) {

                                    var jobNumber = $(ini).val();

                                    Swal.fire({
                                        type: "warning",
                                        title: "Do you want add Job Number ?",
                                        showCancelButton: true
                                    }).then((res) => {
                                        if (res.value) {

                                            Swal.fire({
                                                title: 'Processing...',
                                                allowOutsideClick: false,
                                                onBeforeOpen: () => {
                                                    Swal.showLoading()
                                                },
                                            });

                                            console.log("Job Number:", jobNumber);

                                            $.ajax({
                                                url: "<?php echo base_url(); ?>wtr/add_job_number",
                                                type: "POST",
                                                data: {
                                                    job_no: jobNumber,
                                                    drawing_no: "<?= $wtr_list[0]['drawing_no'] ?>",
                                                },
                                                dataType: "JSON",
                                                success: function(data) {
                                                    if (data.success) {
                                                        Swal.fire({
                                                                type: "success",
                                                                title: "Success",
                                                                text: "Your Data Has Been Submitted !!",
                                                                timer: 1000
                                                            }),

                                                            setTimeout(() => {
                                                                location.reload()
                                                            }, 1000);
                                                    } else {
                                                        Swal.fire({
                                                            type: "error",
                                                            title: "Something Wrong",
                                                            timer: 1000
                                                        })
                                                    }
                                                },
                                                error: (err) => {
                                                    Swal.fire({
                                                        type: "error",
                                                        title: "Something Wrong",
                                                        timer: 1000
                                                    })
                                                }
                                            });
                                        }
                                    })
                                }
                            </script>
                            <tr>
                                <th style='text-align:left !important;'>CLIENT</th>
                                <th>:</th>
                                <th style='text-align:left !important;'><?= strtoupper($project_client[$joint_list[0]["project"]]); ?></th>
                            </tr>
                            <tr>
                                <th style='text-align:left !important;'>DRAWING NO</th>
                                <th>:</th>
                                <th style='text-align:left !important;'>
                                    <?php echo $joint_list[0]["drawing_no"]; ?>
                                    <?php if (isset($activity_eng[$joint_list[0]["drawing_no"]]['id'])) { ?>
                                        <?php
                                        $links_atc = base_url_ftp_eng() . "public_smoe/open_atc/2/" . strtr($this->encryption->encrypt($activity_eng[$joint_list[0]["drawing_no"]]['id']), '+=/', '.-~') . "/" . $drawing_detail[$joint_list[0]["project"]][$joint_list[0]['drawing_no']]['last_revision_no'];
                                        ?>
                                        <a target='_blank' href='<?= $links_atc ?>' class='btn btn-primary' title='Attachment'> <i class='fas fa-paperclip'></i> ( File Drawing )</a>
                                    <?php } ?>
                                </th>
                            </tr>
                            <tr>
                                <th style='text-align:left !important;'>REV</th>
                                <th>:</th>
                                <th style='text-align:left !important;'>
                                    <?= @$drawing_detail[$joint_list[0]["project"]][$joint_list[0]['drawing_no']]['last_revision_no'] ?>
                                </th>
                            </tr>
                            <tr>
                                <th style='text-align:left !important;'>DESCRIPTION</th>
                                <th>:</th>
                                <th style='text-align:left !important;'>
                                    <?= @$drawing_detail[$joint_list[0]['project']][$joint_list[0]['drawing_no']]['title'] ?>
                                </th>
                            </tr>
                            <?php if ($show_att == 1) { ?>
                                <tr>
                                    <th style='text-align:left !important;'>ATTACHMENT</th>
                                    <th>:</th>
                                    <th style='text-align:left !important;'>
                                        <?php if ($this->permission_cookie[0] == 1) {
                                            $uniq_id = strtr($this->encryption->encrypt($wtr_list[0]["mwtr_signed_uniq_id"]), '+=/', '.-~')
                                        ?>
                                            <form method="POST" action="<?= base_url() ?>wtr/upload_attachment_mwtr/" enctype="multipart/form-data">
                                                <input type="hidden" name="uniq_id" value="<?= $uniq_id ?>">

                                                <!-- <input type="file" name="file_name">
                                            <br>
                                            <button type="submit" >Upload</button> -->
                                                <div class="row">
                                                    <div class="col-6">
                                                        <input type="file" name="file_name">
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="text" name="file_name_custom" placeholder="Filename Displayed">
                                                    </div>
                                                    <div class="col-6">
                                                        <button type="submit">Upload</button>
                                                    </div>
                                                </div>
                                            </form>
                                        <?php } ?>
                                        <table>
                                            <tbody>
                                                <?php foreach ($attachment as $key_att => $value_att) { ?>
                                                    <?php $file = strtr($this->encryption->encrypt($value_att['filename']), '+=/', '.-~') ?>
                                                    <tr>
                                                        <td>
                                                            <a target="_blank" href="<?= base_url("wtr/open_atc/") . $file . '/' . $file ?>">
                                                                <?= $value_att['remarks'] ? $value_att['remarks'] : $value_att['filename'] ?>
                                                            </a>
                                                        </td>
                                                        <?php if ($this->permission_cookie[0] == 1) { ?>
                                                            <td>
                                                                |
                                                                <a href="<?= base_url("wtr/delete_atc/") . $uniq_id . '/' . $file ?>">Delete</a>
                                                            </td>
                                                        <?php } ?>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </th>
                                </tr>
                            <?php } ?>
                        </thead>
                    </table>
                </td>
                <td width="60%">
                    <table width="100%">
                        <tr>
                            <td style="text-align: center;">
                                <center>
                                    <span style="font-size: 15px !important;font-weight: bold;">
                                        MATERIAL & WELDING TRACEABILITY RECORD - <?= strtoupper($discipline_name[$wtr_list[0]['discipline']]) ?>
                                    </span>
                                </center>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <table class="wtr">
            <thead>
                <tr>
                    <th rowspan="3" style="width: 75px !important;"><br /><br />Drawing/Weld Map No</th>
                    <th rowspan="3" style="padding:2px !important;"><br /><br />Rev No</th>
                    <th rowspan="3" style="padding:2px !important;"><br /><br />Joint No</th>
                    <th rowspan="3" style="padding:2px !important;"><br /><br />Class</th>
                    <th rowspan="3" style="padding:2px !important;"><br /><br />Type Of Weld</th>
                    <th rowspan="3" style="padding:2px !important;"><br /><br />Spool No</th>
                    <th rowspan="3" style="padding:2px !important;"><br /><br />Weld Length</th>
                    <th rowspan="3" style="padding:2px !important;"><br /><br />Size / Dia</th>
                    <th rowspan="3" style="padding:2px !important;"><br /><br />Thk<br />(mm)</th>
                    <th colspan="12" style="padding:2px !important;">Material Traceability</th>

                    <!-- BUTTERING FOR EQUINOX ONLY -->
                    <?php if ($show_data_irn_list[0]['project'] == 19) { ?>
                        <th colspan="1" rowspan="2">Buttering</th>
                    <?php } ?>
                    <!-- BUTTERING FOR EQUINOX ONLY -->

                    <th colspan="3" rowspan="2">Fitup</th>
                    <!-- <th rowspan="3" style="padding:2px !important;">Tack Weld ID</th> -->
                    <th rowspan="3" style="padding:2px !important;">WPS No</th>
                    <th rowspan="3" style="padding:2px !important;">Consumable / Lot no</th>
                    <th rowspan="3" style="padding:2px !important;">Welded Date</th>
                    <th colspan="2" rowspan="2" style="padding:2px !important;">Weld Process</th>
                    <th colspan="2" rowspan="2" style="padding:2px !important;">Welder ID</th>
                    <th colspan="3" rowspan="2" style="padding:2px !important;">Visual</th>
                    <th colspan="44" style="padding:2px !important;">Non Destructive Examination</th>
                    <th rowspan='2' colspan="3" style="padding:2px !important;">IRN to B&P</th>
                    <th rowspan="3" style="width:50px !important" style="padding:2px !important;">Remarks</th>
                    <th rowspan="3" style="width:50px !important" style="padding:2px !important;">Test Pack Number</th>
                    <?php if (isset($for_mwtr_signed)) { ?>
                        <?php if ($wtr_list[0]['mwtr_signed_status_inspection'] == "0") { ?>
                            <th rowspan="3" style="width:50px !important" style="padding:2px !important;">Action</th>
                        <?php } ?>
                    <?php } ?>
                </tr>
                <tr>
                    <th colspan="6" style="padding:2px !important;">Part #1</th>
                    <th colspan="6" style="padding:2px !important;">Part #2</th>


                    <th colspan="3" style="padding:2px !important;">MPI</th>
                    <th colspan="3" style="padding:2px !important;">PT</th>
                    <th colspan="3" style="padding:2px !important;">UT</th>
                    <th colspan="3" style="padding:2px !important;">PAUT</th>
                    <th colspan="3" style="padding:2px !important;">RT</th>
                    <th colspan="3" style="padding:2px !important;">RI</th>
                    <th colspan="3" style="padding:2px !important;">MTCC</th>
                    <th colspan="3" style="padding:2px !important;">PTCC</th>
                    <th colspan="3" style="padding:2px !important;">UTCC</th>
                    <th colspan="3" style="padding:2px !important;">PAUTCC</th>
                    <th colspan="3" style="padding:2px !important;">RTCC</th>
                    <th colspan="5" style="padding:2px !important;">PWHT</th>
                    <th colspan="3" style="padding:2px !important;">PMI</th>
                    <th colspan="3" style="padding:2px !important;">HER</th>
                </tr>
                <tr>
                    <th style="padding:2px !important;">Piece<br />Mark</th>
                    <th style="padding:2px !important;">Mtr No.</th>
                    <th style="padding:2px !important;">Grade /Spec</th>
                    <th style="padding:2px !important;">Unique No</th>
                    <th style="padding:2px !important;">Heat No</th>
                    <th style="padding:2px !important;">Thk / Sch</th>
                    <th style="padding:2px !important;">Piece<br />Mark</th>
                    <th style="padding:2px !important;">Mtr No.</th>
                    <th style="padding:2px !important;">Grade /Spec</th>
                    <th style="padding:2px !important;">Unique No</th>
                    <th style="padding:2px !important;">Heat No</th>
                    <th style="padding:2px !important;">Thk / Sch</th>

                    <!-- BUTTERING FOR EQUINOX ONLY -->
                    <?php if ($show_data_irn_list[0]['project'] == 19) { ?>
                        <th style="padding:2px !important;">Report</th>
                    <?php } ?>
                    <!-- BUTTERING FOR EQUINOX ONLY -->

                    <th style="padding:2px !important;">Report</th>
                    <th style="padding:2px !important;">Date</th>
                    <th style="padding:2px !important;">Result</th>

                    <th style="padding:2px !important;">R/H</th>
                    <th style="padding:2px !important;">F/C</th>
                    <th style="padding:2px !important;">R/H</th>
                    <th style="padding:2px !important;">F/C</th>

                    <th style="padding:2px !important;">Report</th>
                    <th style="padding:2px !important;">Date</th>
                    <th style="padding:2px !important;">Result</th>

                    <th style="padding:2px !important;">Report</th>
                    <th style="padding:2px !important;">Date</th>
                    <th style="padding:2px !important;">Result</th>

                    <th style="padding:2px !important;">Report</th>
                    <th style="padding:2px !important;">Date</th>
                    <th style="padding:2px !important;">Result</th>

                    <th style="padding:2px !important;">Report</th>
                    <th style="padding:2px !important;">Date</th>
                    <th style="padding:2px !important;">Result</th>

                    <th style="padding:2px !important;">Report</th>
                    <th style="padding:2px !important;">Date</th>
                    <th style="padding:2px !important;">Result</th>

                    <th style="padding:2px !important;">Report</th>
                    <th style="padding:2px !important;">Date</th>
                    <th style="padding:2px !important;">Result</th>

                    <th style="padding:2px !important;">Report</th>
                    <th style="padding:2px !important;">Date</th>
                    <th style="padding:2px !important;">Result</th>

                    <th style="padding:2px !important;">Report</th>
                    <th style="padding:2px !important;">Date</th>
                    <th style="padding:2px !important;">Result</th>

                    <th style="padding:2px !important;">Report</th>
                    <th style="padding:2px !important;">Date</th>
                    <th style="padding:2px !important;">Result</th>

                    <th style="padding:2px !important;">Report</th>
                    <th style="padding:2px !important;">Date</th>
                    <th style="padding:2px !important;">Result</th>

                    <th style="padding:2px !important;">Report</th>
                    <th style="padding:2px !important;">Date</th>
                    <th style="padding:2px !important;">Result</th>

                    <th style="padding:2px !important;">Report</th>
                    <th style="padding:2px !important;">Date</th>
                    <th style="padding:2px !important;">Result</th>

                    <th style="padding:2px !important;">YES</th>
                    <th style="padding:2px !important;">NO</th>
                    <th style="padding:2px !important;">Report</th>
                    <th style="padding:2px !important;">Date</th>
                    <th style="padding:2px !important;">Result</th>

                    <th style="padding:2px !important;">Report</th>
                    <th style="padding:2px !important;">Date</th>
                    <th style="padding:2px !important;">Result</th>

                    <th style="padding:2px !important;">Report</th>
                    <th style="padding:2px !important;">Date</th>
                    <th style="padding:2px !important;">Result</th>

                    <th style="padding:2px !important;">Report</th>
                    <th style="padding:2px !important;">Date</th>
                    <th style="padding:2px !important;">Result</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $array_qc_approval = array(0, 1, 2, 4, 6, 8, 9, 10, 11);

                foreach ($wtr_list as $key => $value) {
                    //if($value['fitup_status_inspection'] != 2 AND $value['visual_status_inspection'] != 2){

                    $pc_pos_1                   = @$status_piecemark[$value['pos_1']];
                    $pc_pos_2                   = @$status_piecemark[$value['pos_2']];

                    $itr_pos_1    = false;
                    $itr_pos_2    = false;

                    if (isset($status_piecemark_itr[$value['pos_1']])) {
                        $pc_pos_1     = $status_piecemark_itr[$value['pos_1']];
                        $itr_pos_1    = true;
                    }

                    if (isset($status_piecemark_itr[$value['pos_2']])) {
                        $pc_pos_2     = $status_piecemark_itr[$value['pos_2']];
                        $itr_pos_2    = true;
                    }


                ?>

                    <?php

                    $project_id_enc     = strtr($this->encryption->encrypt($value['project']), '+=/', '.-~');
                    $discipline_enc     = strtr($this->encryption->encrypt($value['discipline']), '+=/', '.-~');
                    $discipline_enc_material_1     = strtr($this->encryption->encrypt($pc_pos_1['discipline']), '+=/', '.-~');
                    $discipline_enc_material_2     = strtr($this->encryption->encrypt($pc_pos_2['discipline']), '+=/', '.-~');
                    $type_of_module_enc = strtr($this->encryption->encrypt($value['type_of_module']), '+=/', '.-~');
                    $module_enc         = strtr($this->encryption->encrypt($value['module']), '+=/', '.-~');
                    $company_enc         = strtr($this->encryption->encrypt($value['company_id']), '+=/', '.-~');

                    $report_enc_mv_p1   = null;
                    $report_no_rev_p1   = null;

                    if (isset($pc_pos_1['report_number'])) {
                        $report_enc_mv_p1   = strtr($this->encryption->encrypt($pc_pos_1['report_number']), '+=/', '.-~');
                        $report_no_rev_p1   = strtr($this->encryption->encrypt($pc_pos_1['report_no_rev']), '+=/', '.-~');
                    }

                    $report_enc_mv_p2   = null;
                    $report_no_rev_p2   = null;

                    if (isset($pc_pos_2['report_number'])) {
                        $report_enc_mv_p2   = strtr($this->encryption->encrypt($pc_pos_2['report_number']), '+=/', '.-~');
                        $report_no_rev_p2   = strtr($this->encryption->encrypt($pc_pos_2['report_no_rev']), '+=/', '.-~');
                    }

                    $report_fitup_enc  = null;

                    if (isset($value['fitup_report_no'])) {
                        $report_fitup_enc   = strtr($this->encryption->encrypt($value['fitup_report_no']), '+=/', '.-~');
                    }

                    $report_visual_enc  = null;

                    if (isset($value['visual_report_no'])) {
                        $report_visual_enc   = strtr($this->encryption->encrypt($value['visual_report_no']), '+=/', '.-~');
                    }

                    ?>

                    <tr>
                        <td style="padding:2px !important;">
                            <?php echo $value['drawing_wm']; ?><br />
                            <?php if (isset($activity_eng[$value['drawing_wm']]['id'])) { ?>
                                <?php
                                $links_atc = base_url_ftp_eng() . "public_smoe/open_atc/2/" . strtr($this->encryption->encrypt($activity_eng[$value['drawing_wm']]['id']), '+=/', '.-~') . "/" . $drawing_detail[$loop_val["project"]][$value['drawing_wm']]['last_revision_no'];
                                ?>
                                <a target='_blank' href='<?= $links_atc ?>' class='btn btn-primary' title='Attachment'> <i class='fas fa-paperclip'></i>(File Drawing)</a>
                            <?php } ?>
                        </td>
                        <td style="padding:2px !important;"><?php echo $drawing_detail[$loop_val["project"]][$value['drawing_wm']]['last_revision_no']; ?></td>
                        <td style="padding:2px !important;"><?php echo $value['joint_no'] . $value['revision_category'] . $value['revision']; ?></td>
                        <td style="padding:2px !important;"><?php echo (isset($class_list[$value['class']]) ? $class_list[$value['class']] : "-"); ?></td>
                        <td style="padding:2px !important;"><?php echo $master_weld_type[$value['weld_type']]["weld_type_code"]; ?></td>
                        <td style="padding:2px !important;"><?php echo $value['spool_no']; ?></td>
                        <td style="padding:2px !important;"><?php echo $value['weld_length']; ?></td>
                        <td style="padding:2px !important;"><?php echo $value['diameter']; ?></td>
                        <td style="padding:2px !important;"><?php echo $value['thickness']; ?></td>
                        <td style="padding:2px !important;">
                            <?php echo $value['pos_1']; ?>
                            <?php if (isset($status_piecemark_ref[$value['pos_1']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_1']]["ref_pos_1"])) { ?>
                                <br /><br />
                                <?php
                                $data_multiple_piecemark_1 = explode(", ", $status_piecemark_ref[$value['pos_1']]["ref_pos_1"]);


                                foreach ($data_multiple_piecemark_1 as $vaxx) {
                                    if (isset($status_piecemark_ref_1[$vaxx])) {

                                        echo  $status_piecemark_ref_1[$vaxx]["part_id"] . "<br/><br/> ";
                                    } elseif (isset($status_piecemark_ref_1_itr[$vaxx])) {

                                        echo  $status_piecemark_ref_1_itr[$vaxx]["part_id"] . "<br/><br/> ";
                                    }
                                }
                                ?>
                            <?php } ?>
                        </td>

                        <td style="padding:2px !important;" <?= (in_array($pc_pos_1['status_inspection'], $array_qc_approval) && isset($pc_pos_1['status_inspection']) ? "class='color_pending_QC'" : null) ?>>

                        <?php if (isset($pc_pos_1['report_number']) and $pc_pos_1['status_inspection'] >= 3) { ?>

                            <?php

                            $drawing_mv_enc = strtr($this->encryption->encrypt($pc_pos_1['drawing_no']), '+=/', '.-~');

                            $link_report_1    = base_url() . "material_verification/detail_client_rfi/$project_id_enc/$discipline_enc_material_1/$type_of_module_enc/$module_enc/$report_enc_mv_p1/$report_no_rev_p1/detail/$drawing_mv_enc";

                            $report_number_1  = @$report_no_mv[$value['project']][$pc_pos_1['discipline']][$value['type_of_module']]['mv_no' . ($status_piecemark[$value["pos_1"]]["company_id"] == 13 ? '_smop' : '')] . "-" . $pc_pos_1['report_number'];

                            if ($pc_pos_1['status_inspection'] != 5) {

                                $link_report_1    = base_url() . "material_verification/material_verification_pdf_client/$project_id_enc/$discipline_enc_material_1/$type_of_module_enc/$module_enc/$report_enc_mv_p1/$report_no_rev_p1/$drawing_mv_enc";
                            }

                            ?>

                            <a <?= ($pc_pos_1['status_inspection'] == 5 ? "class='color_pending_client'" : null) ?> href="<?= $link_report_1 ?>" target='_blank'><?= $report_number_1 . '' ?></a>

                            <?php } else { ?>
                            <?php

                            $report_number_1    = "-";
                            if ($pc_pos_1['report_number']) {
                                $report_number_1  = @$report_no_mv[$value['project']][$pc_pos_1['discipline']][$value['type_of_module']]['mv_no' . ($status_piecemark[$value["pos_1"]]["company_id"] == 13 ? '_smop' : '')] . "-" . $pc_pos_1['report_number'];

                            }

                            $link_report_1        = base_url() . "material_verification/material_verification_pdf/" . encrypt($pc_pos_1['submission_id']);

                            ?>

                            <?php if ($pc_pos_1['status_inspection'] == 1) { ?>
                                <a href="<?= $link_report_1 ?>" target='_blank'><?= $pc_pos_1['submission_id'] ?></a>

                            <?php } else { ?>

                                <?= $report_number_1 ?>

                            <?php } ?>

                            <?php } ?>

                        </td>

                        <td style="padding:2px !important;">
                            <?php if (isset($status_piecemark_ref[$value['pos_1']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_1']]["ref_pos_1"])) { ?>
                                <?php
                                $data_multiple_piecemark_1 = explode(", ", $status_piecemark_ref[$value['pos_1']]["ref_pos_1"]);

                                array_unshift($data_multiple_piecemark_1, $status_piecemark_ref[$value['pos_1']]['id']);

                                foreach ($data_multiple_piecemark_1 as $vaxx) {
                                    if (isset($status_piecemark_ref_1[$vaxx])) {

                                        echo  "<span class='badge'>" . $material_grade[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['grade']]['material_grade'] . "</span> <br/><br/>";
                                    } elseif (isset($status_piecemark_ref_1_itr[$vaxx])) {

                                        echo  "<span class='badge'>" . $material_grade[$status_piecemark[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]['grade']]['material_grade'] . "</span> <br/><br/>";
                                    }
                                }
                                ?>
                            <?php } else { ?>
                                <?php
                                if (isset($pc_pos_1['id_mis'])) {
                                    echo $material_grade[$pc_pos_1['grade']]['material_grade'];
                                }
                                ?>
                            <?php } ?>
                        </td>
                        <td style="padding:2px !important;">
                            <?php if (isset($status_piecemark_ref[$value['pos_1']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_1']]["ref_pos_1"])) { ?>
                                <?php
                                $data_multiple_piecemark_1 = explode(", ", $status_piecemark_ref[$value['pos_1']]["ref_pos_1"]);

                                array_unshift($data_multiple_piecemark_1, $status_piecemark_ref[$value['pos_1']]['id']);

                                foreach ($data_multiple_piecemark_1 as $vaxx) {
                                    //echo  "<span class='badge'>".$status_piecemark_ref_1[$vaxx]["part_id"]."</span> <br/>";  
                                    if (isset($status_piecemark_ref_1[$vaxx])) {
                                        echo "<a target='_blank' href='" . wh_base_url() . "mrir/export_mrir_cs/?id=" . strtr($this->encryption->encrypt($warehouse_mis_mrir[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['id_mis']]['mrir_id']), '+=/', '.-~') . '&action=' . strtr($this->encryption->encrypt('update'), '+=/', '.-~') . '&status=' . strtr($this->encryption->encrypt($warehouse_mis_mrir[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['id_mis']]['status']), '+=/', '.-~') . '&partial_report_no=' . strtr($this->encryption->encrypt($warehouse_mis_mrir[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['id_mis']]['partial_report_no']), '+=/', '.-~') . "'>" . "<span class='badge'>" . $warehouse_mis_mrir[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['id_mis']]['unique_ident_no'] . "</span></a><br/><br/>";
                                    } elseif (isset($status_piecemark_ref_1_itr[$vaxx])) {

                                        echo "<a target='_blank' href='" . wh_base_url() . "mrir/export_mrir_cs/?id=" . strtr($this->encryption->encrypt($warehouse_mis_mrir[$status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]['id_mis']]['mrir_id']), '+=/', '.-~') . '&action=' . strtr($this->encryption->encrypt('update'), '+=/', '.-~') . '&status=' . strtr($this->encryption->encrypt($warehouse_mis_mrir[$status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]['id_mis']]['status']), '+=/', '.-~') . '&partial_report_no=' . strtr($this->encryption->encrypt($warehouse_mis_mrir[$status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]['id_mis']]['partial_report_no']), '+=/', '.-~') . "'>" . "<span class='badge'>" . $warehouse_mis_mrir[$status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]['id_mis']]['unique_ident_no'] . "</span></a><br/><br/>";
                                    }
                                }
                                ?>
                            <?php } else { ?>
                                <?php
                                if (isset($pc_pos_1['id_mis'])) {
                                    echo "<a target='_blank' href='" . $server_warehouse . "/mrir/export_mrir_cs/?id=" . strtr($this->encryption->encrypt($warehouse_mis_mrir[$pc_pos_1['id_mis']]['mrir_id']), '+=/', '.-~') . '&action=' . strtr($this->encryption->encrypt('update'), '+=/', '.-~') . '&status=' . strtr($this->encryption->encrypt($warehouse_mis_mrir[$pc_pos_1['id_mis']]['status']), '+=/', '.-~') . '&partial_report_no=' . strtr($this->encryption->encrypt($warehouse_mis_mrir[$pc_pos_1['id_mis']]['partial_report_no']), '+=/', '.-~') . "'>" . "<span class='badge'>" . $warehouse_mis_mrir[$pc_pos_1['id_mis']]['unique_ident_no'] . "</span></a><br/><br/>";
                                    // echo $warehouse_mis_mrir[$pc_pos_1['id_mis']]['unique_ident_no']; 
                                }
                                ?>
                            <?php } ?>
                        </td>
                        <td style="padding:2px !important;">
                            <?php if (isset($status_piecemark_ref[$value['pos_1']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_1']]["ref_pos_1"])) { ?>
                                <?php
                                $data_multiple_piecemark_1 = explode(", ", $status_piecemark_ref[$value['pos_1']]["ref_pos_1"]);

                                array_unshift($data_multiple_piecemark_1, $status_piecemark_ref[$value['pos_1']]['id']);

                                foreach ($data_multiple_piecemark_1 as $vaxx) {
                                    if (isset($status_piecemark_ref_1[$vaxx])) {
                                        echo  "<span class='badge'>" . $warehouse_mis_mrir[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['id_mis']]['heat_or_series_no'] . "</span> <br/><br/>";
                                    } elseif (isset($status_piecemark_ref_1_itr[$vaxx])) {
                                        echo  "<span class='badge'>" . $warehouse_mis_mrir[$status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]['id_mis']]['heat_or_series_no'] . "</span> <br/><br/>";
                                    }
                                }
                                ?>
                            <?php } else { ?>
                                <?php
                                if (isset($pc_pos_1['id_mis'])) {
                                    echo $warehouse_mis_mrir[$pc_pos_1['id_mis']]['heat_or_series_no'];
                                }
                                ?>
                            <?php } ?>
                        </td>
                        <td style="padding:2px !important;">
                            <?php if (isset($status_piecemark_ref[$value['pos_1']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_1']]["ref_pos_1"])) { ?>
                                <?php
                                $data_multiple_piecemark_1 = explode(", ", $status_piecemark_ref[$value['pos_1']]["ref_pos_1"]);

                                array_unshift($data_multiple_piecemark_1, $status_piecemark_ref[$value['pos_1']]['id']);

                                foreach ($data_multiple_piecemark_1 as $vaxx) {
                                    if (isset($status_piecemark_ref_1[$vaxx])) {
                                        echo  "<span class='badge'>" . $status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['thickness'] . "</span> <br/><br/>";
                                    } elseif (isset($status_piecemark_ref_1_itr[$vaxx])) {
                                        echo  "<span class='badge'>" . $status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]['thickness'] . "</span> <br/><br/>";
                                    }
                                }
                                ?>
                            <?php } else { ?>
                                <?php
                                if (isset($pc_pos_1['id_mis'])) {
                                    echo $pc_pos_1['thickness'];
                                }
                                ?>
                            <?php } ?>
                        </td>
                        <td style="padding:2px !important;">
                            <?php echo $value['pos_2']; ?>
                            <?php if (isset($status_piecemark_ref[$value['pos_2']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_2']]["ref_pos_1"])) { ?>
                                <br /><br />
                                <?php
                                $data_multiple_piecemark_1 = explode(", ", $status_piecemark_ref[$value['pos_2']]["ref_pos_1"]);
                                foreach ($data_multiple_piecemark_1 as $vaxx) {
                                    if (isset($status_piecemark_ref_1[$vaxx])) {
                                        echo  $status_piecemark_ref_1[$vaxx]["part_id"] . "<br/><br/>";
                                    } elseif (isset($status_piecemark_ref_1_itr[$vaxx])) {
                                        echo  $status_piecemark_ref_1_itr[$vaxx]["part_id"] . "<br/><br/>";
                                    }
                                }
                                ?>
                            <?php } ?>
                        </td>
                        <td style="padding:2px !important;" <?= (in_array($pc_pos_2['status_inspection'], $array_qc_approval) && isset($pc_pos_2['status_inspection']) ? "class='color_pending_QC'" : null) ?>>


                            <?php if (isset($status_piecemark_ref[$value['pos_2']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_2']]["ref_pos_1"])) { ?>

                                <?php
                                $data_multiple_piecemark_1 = explode(", ", $status_piecemark_ref[$value['pos_2']]["ref_pos_1"]);

                                array_unshift($data_multiple_piecemark_1, $status_piecemark_ref[$value['pos_2']]['id']);

                                foreach ($data_multiple_piecemark_1 as $vaxx) {
                                    if (isset($status_piecemark_ref_1[$vaxx])) {

                                        if (isset($status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['report_number']) and $status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['status_inspection'] == 7) {
                                            echo "<a href='" . base_url() . "material_verification/material_verification_pdf_client/" . $project_id_enc . "/" . $discipline_enc_material_1 . "/" . $type_of_module_enc . "/" . $module_enc . "/" . strtr($this->encryption->encrypt($status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['report_number']), '+=/', '.-~') . "/" . strtr($this->encryption->encrypt($status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['report_no_rev']), '+=/', '.-~') . "' target='_blank'>" . "<span class='badge'>" . $report_no_mv[$value['project']][$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['discipline']][$value['type_of_module']]['mv_no' . ($status_piecemark[$value["pos_2"]]["company_id"] == 13 ? '_smop' : '')] . "-" . $status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['report_number'] . "</span></a><br/><br/>";
                                        } else {
                                            if (isset($status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['report_number'])) {
                                                echo "<span class='badge'>" . $report_no_mv[$value['project']][$pc_pos_2['discipline']][$value['type_of_module']]['mv_no' . ($status_piecemark[$value["pos_2"]]["company_id"] == 13 ? '_smop' : '')] . "-" . $status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['report_number'] . "</span><br/><br/>";
                                            } else {
                                                echo "-";
                                            }
                                        }
                                    } elseif (isset($status_piecemark_ref_1_itr[$vaxx])) {

                                        $report_number = "-";

                                        if ($status_piecemark_ref_1_itr[$vaxx]['report_number']) {
                                            $report_number  = $status_piecemark_ref_1_itr[$vaxx]['report_number'];
                                            $report_number  = $report_no_itr[$value['project']][$pc_pos_2['discipline']][$value['type_of_module']]['itr_no' . ($status_piecemark[$value["pos_2"]]["company_id"] == 13 ? '_scm' : '')] . '-' . $report_number;
                                        }

                                        if ($status_piecemark_ref_1_itr[$vaxx]['transmittal_uniqid']) {

                                            $report_number_link  = base_url() . "itr/itr_pdf/report/" . encrypt($status_piecemark_ref_1_itr[$vaxx]['report_number']) . "/" . encrypt($status_piecemark_ref_1_itr[$vaxx]['report_no_rev']) . "/" . encrypt($status_piecemark_ref_1_itr[$vaxx]['project_code']) . "/" . encrypt($status_piecemark_ref_1_itr[$vaxx]['discipline']) . "/" . encrypt($status_piecemark_ref_1_itr[$vaxx]['type_of_module']) . "/" . encrypt($status_piecemark_ref_1_itr[$vaxx]['module']);

                                            $report_number   = '<a target="_blank" href="' . $report_number_link . '">' . $report_number . '</a>';
                                        }

                                        echo $report_number;
                                        echo '<br><br>';
                                    }
                                }
                                ?>

                            <?php } else { ?>


                                <?php if (isset($pc_pos_2['report_number']) and $pc_pos_2['status_inspection'] >= 3) { ?>

                                    <?php

                                    $drawing_mv_enc = strtr($this->encryption->encrypt($pc_pos_2['drawing_no']), '+=/', '.-~');

                                    $link_report_2    = base_url() . "material_verification/detail_client_rfi/$project_id_enc/$discipline_enc_material_2/$type_of_module_enc/$module_enc/$report_enc_mv_p2/$report_no_rev_p2/detail/$drawing_mv_enc";

                                    $report_number_2  = @$report_no_mv[$value['project']][$pc_pos_2['discipline']][$value['type_of_module']]['mv_no' . ($status_piecemark[$value["pos_2"]]["company_id"] == 13 ? '_smop' : '')] . "-" . $pc_pos_2['report_number'];

                                    if ($pc_pos_2['status_inspection'] != 5) {

                                        $link_report_2    = base_url() . "material_verification/material_verification_pdf_client/$project_id_enc/$discipline_enc_material_2/$type_of_module_enc/$module_enc/$report_enc_mv_p2/$report_no_rev_p2/$drawing_mv_enc";
                                    }

                                    if ($itr_pos_2) {
                                        $report_number_2  = @$report_no_itr[$value['project']][$pc_pos_2['discipline']][$value['type_of_module']]['itr_no' . ($status_piecemark[$value["pos_2"]]["company_id"] == 13 ? '_scm' : '')] . "-" . $pc_pos_2['report_number'];

                                        $link_report_2    = base_url() . "itr/itr_pdf/report/$report_enc_mv_p2/$report_no_rev_p2/$project_id_enc/$discipline_enc_material_2/$type_of_module_enc/$module_enc";
                                    }

                                    ?>

                                    <a <?= ($pc_pos_2['status_inspection'] == 5 ? "class='color_pending_client'" : null) ?> href="<?= $link_report_2 ?>" target='_blank'><?= $report_number_2 ?></a>

                                <?php } else { ?>

                                    <?php

                                    $report_number_2    = "-";
                                    if ($pc_pos_2['report_number']) {
                                        $report_number_2  = @$report_no_mv[$value['project']][$pc_pos_2['discipline']][$value['type_of_module']]['mv_no' . ($status_piecemark[$value["pos_2"]]["company_id"] == 13 ? '_smop' : '')] . "-" . $pc_pos_2['report_number'];

                                        if ($itr_pos_2) {
                                            $report_number_2  = @$report_no_itr[$value['project']][$pc_pos_2['discipline']][$value['type_of_module']]['itr_no' . ($status_piecemark[$value["pos_2"]]["company_id"] == 13 ? '_scm' : '')] . "-" . $pc_pos_2['report_number'];
                                        }
                                    }

                                    $link_report_2        = base_url() . "material_verification/material_verification_pdf/" . encrypt($pc_pos_2['submission_id']);

                                    if ($itr_pos_2) {
                                        $link_report_2        = base_url() . "itr/itr_pdf/submission/" . encrypt($pc_pos_2['submission_id']);
                                    }

                                    ?>

                                    <?php if ($pc_pos_2['status_inspection'] == 1) { ?>
                                        <a href="<?= $link_report_2 ?>" target='_blank'><?= $pc_pos_2['submission_id'] ?></a>

                                    <?php } else { ?>

                                        <?= $report_number_1 ?>

                                    <?php } ?>

                                <?php } ?>
                            <?php } ?>
                        </td>
                        <td style="padding:2px !important;">
                            <?php if (isset($status_piecemark_ref[$value['pos_2']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_2']]["ref_pos_1"])) { ?>
                                <?php
                                $data_multiple_piecemark_1 = explode(", ", $status_piecemark_ref[$value['pos_2']]["ref_pos_1"]);

                                array_unshift($data_multiple_piecemark_1, $status_piecemark_ref[$value['pos_2']]['id']);

                                foreach ($data_multiple_piecemark_1 as $vaxx) {
                                    if (isset($status_piecemark_ref_1[$vaxx])) {
                                        echo  "<span class='badge'>" . $material_grade[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['grade']]['material_grade'] . "</span> <br/><br/>";
                                    } elseif (isset($status_piecemark_ref_1_itr[$vaxx])) {
                                        echo  "<span class='badge'>" . $material_grade[$status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]['grade']]['material_grade'] . "</span> <br/><br/>";
                                    }
                                }
                                ?>
                            <?php } else { ?>
                                <?php
                                if (isset($pc_pos_2['id_mis'])) {
                                    echo $material_grade[$pc_pos_2['grade']]['material_grade'];
                                }
                                ?>
                            <?php } ?>
                        </td>
                        <td style="padding:2px !important;">
                            <?php if (isset($status_piecemark_ref[$value['pos_2']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_2']]["ref_pos_1"])) { ?>
                                <?php
                                $data_multiple_piecemark_1 = explode(", ", $status_piecemark_ref[$value['pos_2']]["ref_pos_1"]);

                                array_unshift($data_multiple_piecemark_1, $status_piecemark_ref[$value['pos_2']]['id']);

                                foreach ($data_multiple_piecemark_1 as $vaxx) {
                                    if (isset($status_piecemark_ref_1[$vaxx])) {
                                        echo "<a target='_blank' href='" . wh_base_url() . "mrir/export_mrir_cs/?id=" . strtr($this->encryption->encrypt($warehouse_mis_mrir[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['id_mis']]['mrir_id']), '+=/', '.-~') . '&action=' . strtr($this->encryption->encrypt('update'), '+=/', '.-~') . '&status=' . strtr($this->encryption->encrypt($warehouse_mis_mrir[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['id_mis']]['status']), '+=/', '.-~') . '&partial_report_no=' . strtr($this->encryption->encrypt($warehouse_mis_mrir[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['id_mis']]['partial_report_no']), '+=/', '.-~') . "'>" . "<span class='badge'>" . $warehouse_mis_mrir[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['id_mis']]['unique_ident_no'] . "</span></a><br/><br/>";
                                    } elseif (isset($status_piecemark_ref_1_itr[$vaxx])) {

                                        echo "<a target='_blank' href='" . wh_base_url() . "mrir/export_mrir_cs/?id=" . strtr($this->encryption->encrypt($warehouse_mis_mrir[$status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]['id_mis']]['mrir_id']), '+=/', '.-~') . '&action=' . strtr($this->encryption->encrypt('update'), '+=/', '.-~') . '&status=' . strtr($this->encryption->encrypt($warehouse_mis_mrir[$status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]['id_mis']]['status']), '+=/', '.-~') . '&partial_report_no=' . strtr($this->encryption->encrypt($warehouse_mis_mrir[$status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]['id_mis']]['partial_report_no']), '+=/', '.-~') . "'>" . "<span class='badge'>" . $warehouse_mis_mrir[$status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]['id_mis']]['unique_ident_no'] . "</span></a><br/><br/>";
                                    }
                                }
                                ?>
                            <?php } else { ?>
                                <?php
                                if (isset($pc_pos_2['id_mis'])) {
                                    echo "<a target='_blank' href='" . $server_warehouse . "/mrir/export_mrir_cs/?id=" . strtr($this->encryption->encrypt($warehouse_mis_mrir[$pc_pos_2['id_mis']]['mrir_id']), '+=/', '.-~') . '&action=' . strtr($this->encryption->encrypt('update'), '+=/', '.-~') . '&status=' . strtr($this->encryption->encrypt($warehouse_mis_mrir[$pc_pos_2['id_mis']]['status']), '+=/', '.-~') . '&partial_report_no=' . strtr($this->encryption->encrypt($warehouse_mis_mrir[$pc_pos_2['id_mis']]['partial_report_no']), '+=/', '.-~') . "'>" . "<span class='badge'>" . $warehouse_mis_mrir[$pc_pos_2['id_mis']]['unique_ident_no'] . "</span></a><br/><br/>";
                                    //echo $warehouse_mis_mrir[$pc_pos_2['id_mis']]['unique_ident_no']; 
                                }
                                ?>
                            <?php } ?>
                        </td>
                        <td style="padding:2px !important;">
                            <?php if (isset($status_piecemark_ref[$value['pos_2']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_2']]["ref_pos_1"])) { ?>
                                <?php
                                $data_multiple_piecemark_1 = explode(", ", $status_piecemark_ref[$value['pos_2']]["ref_pos_1"]);

                                array_unshift($data_multiple_piecemark_1, $status_piecemark_ref[$value['pos_2']]['id']);

                                foreach ($data_multiple_piecemark_1 as $vaxx) {
                                    if (isset($status_piecemark_ref_1[$vaxx])) {

                                        echo  "<span class='badge'>" . $warehouse_mis_mrir[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['id_mis']]['heat_or_series_no'] . "</span> <br/><br/>";
                                    } elseif ($status_piecemark_ref_1_itr[$vaxx]) {

                                        echo  "<span class='badge'>" . $warehouse_mis_mrir[$status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]['id_mis']]['heat_or_series_no'] . "</span> <br/><br/>";
                                    }
                                }
                                ?>
                            <?php } else { ?>
                                <?php
                                if (isset($pc_pos_2['id_mis'])) {
                                    echo $warehouse_mis_mrir[$pc_pos_2['id_mis']]['heat_or_series_no'];
                                }
                                ?>
                            <?php }  ?>
                        </td>
                        <td style="padding:2px !important;">
                            <?php if (isset($status_piecemark_ref[$value['pos_2']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_2']]["ref_pos_1"])) { ?>
                                <?php
                                $data_multiple_piecemark_1 = explode(", ", $status_piecemark_ref[$value['pos_2']]["ref_pos_1"]);
                                foreach ($data_multiple_piecemark_1 as $vaxx) {
                                    if (isset($status_piecemark_ref_1[$vaxx])) {
                                        echo  "<span class='badge'>" . $status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['thickness'] . "</span> <br/><br/>";
                                    } elseif (isset($status_piecemark_ref_1_itr[$vaxx])) {
                                        echo  "<span class='badge'>" . $status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]['thickness'] . "</span> <br/><br/>";
                                    }
                                }
                                ?>
                            <?php } else { ?>
                                <?php
                                if (isset($pc_pos_2['id_mis'])) {
                                    echo $pc_pos_2['thickness'];
                                }
                                ?>
                            <?php } ?>
                        </td>

                        <!-- BUTTERING FOR EQUINOX ONLY -->
                        <?php if ($show_data_irn_list[0]['project'] == 19) { ?>
                            <td style="padding:2px !important;">
                                <?= $buttering[$value["id_joint"]]["report_number"] ?>
                            </td>
                        <?php } ?>
                        <!-- BUTTERING FOR EQUINOX ONLY -->

                        <td style="padding:2px !important;" <?= (in_array($value['fitup_status_inspection'], $array_qc_approval) && !empty($value['fitup_status_inspection'])  ? "class='color_pending_QC'" : null) ?>>

                            <?php if (!isset($value['revision_category']) && !isset($value['revision'])) { ?>

                                <?php if (isset($value['fitup_report_no']) && $value['fitup_status_inspection'] >= 3) { ?>
                                    <?php if ($value['fitup_status_inspection'] != 5) { ?>
                                        <a <?= ($value['fitup_status_inspection'] == 5 ? "class='color_pending_client'" : null) ?> href="<?php echo base_url(); ?>fitup/pdf_files/<?= $project_id_enc ?>/<?= $discipline_enc ?>/<?= $module_enc ?>/<?= $type_of_module_enc ?>/<?= $report_fitup_enc ?>/<?= $company_enc ?>/<?= $company_enc ?>/<?= $company_enc ?>" target='_blank'><?php echo $report_no_fu[$value['project']][$value['discipline']][$value['type_of_module']]['fitup_report' . ($value['company_id'] == 13 ? '_scm' : '')] . $value['fitup_report_no']; ?></a>
                                    <?php } else { ?>
                                        <a <?= ($value['fitup_status_inspection'] == 5 ? "class='color_pending_client'" : null) ?> href="<?php echo  base_url(); ?>fitup/client_inspection/<?= $project_id_enc ?>/<?= $discipline_enc ?>/<?= $module_enc ?>/<?= $type_of_module_enc ?>/<?= $report_fitup_enc ?>/<?= $company_enc ?>" target='_blank'><?php echo $report_no_fu[$value['project']][$value['discipline']][$value['type_of_module']]['fitup_report' . ($value['company_id'] == 13 ? '_scm' : '')] . $value['fitup_report_no']; ?></a>
                                    <?php } ?>
                                <?php } else { ?>
                                    <?php if (in_array($value['fitup_status_inspection'], array(1, 3))) { ?>
                                        <a href="<?php echo base_url(); ?>fitup/pdf_files/<?= $project_id_enc ?>/<?= $discipline_enc ?>/<?= $module_enc ?>/<?= $type_of_module_enc ?>/<?= strtr($this->encryption->encrypt('marz'), '+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt($value['fitup_submission_id']), '+=/', '.-~') ?>/<?= $company_enc ?>/<?= $company_enc ?>" target='_blank'><?php echo $value['fitup_submission_id']; ?></a>
                                    <?php } else { ?>
                                        <?php if (isset($value['fitup_report_no'])) { ?>
                                            <?php echo $report_no_fu[$value['project']][$value['discipline']][$value['type_of_module']]['fitup_report' . ($value['company_id'] == 13 ? '_scm' : '')] . $value['fitup_report_no']; ?>
                                        <?php } else { ?>
                                            -
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>

                            <?php } ?>

                        </td>
                        <td style='padding:2px !important;' <?= ($this->permission_cookie[0] == 1 || $this->permission_cookie[156] == 1 ? (date("Y-m-d", strtotime($value['weld_datetime'])) < $value['fitup_inspection_datetime'] && isset($value['fitup_report_no']) && isset($value['weld_datetime']) && !isset($value['revision_category']) && !isset($value['revision']) ? "class='color_date'" : null) : null) ?>>
                            <?php if (!isset($value['revision_category']) && !isset($value['revision'])) { ?>
                                <?php if (isset($value['fitup_report_no']) && $value['fitup_status_inspection'] >= 3) { ?>
                                    <?php echo date("Y-m-d", strtotime($value['fitup_inspection_datetime'])); ?>
                                <?php } else { ?>
                                    -
                                <?php } ?>
                            <?php } ?>
                        </td>
                        <td style="padding:2px !important;">
                            <?php if (!isset($value['revision_category']) && !isset($value['revision'])) { ?>
                                <?php if (isset($value['fitup_report_no']) && $value['fitup_status_inspection'] >= 3) { ?>
                                    ACC
                                <?php } else { ?>
                                    -
                                <?php } ?>
                            <?php } ?>
                        </td>

                        <td style="padding:2px !important;">
                            <?php
                            $wps_rh = explode(";", $value['wps_no_rh']);
                            $wps_fc = explode(";", $value['wps_no_fc']);
                            $wps_show = array_unique(array_merge($wps_rh, $wps_fc));
                            if (sizeof($wps_show) > 0) {
                                foreach ($wps_show as $key => $wps_id) {
                                    if (isset($wps_code_arr[$wps_id])) {
                                        echo $wps_code_arr[$wps_id] . "<br/>";
                                    }
                                }
                            }
                            ?>
                        </td>

                        <td style="padding:2px !important;"><?php echo $value['cons_lot_no']; ?></td>

                        <td style="padding:2px !important;" <?= ($this->permission_cookie[0] == 1 || $this->permission_cookie[156] == 1 ? (date("Y-m-d", strtotime($value['visual_inspection_datetime'])) < date("Y-m-d", strtotime($value['weld_datetime'])) && isset($value['visual_inspection_datetime']) ? "class='color_date'" : null) : null) ?>><?php echo $value['weld_datetime']; ?></td>

                        <td style="padding:2px !important;">
                            <?php
                            // // test_var($wps_detail);
                            // $wps_no_rh = array_filter(array_unique(explode(';', $value['wps_no_rh'])));
                            // foreach ($wps_no_rh as $key_wps_no_rh => $value_wps_no_rh) {
                            //   foreach ($wps_detail[$value_wps_no_rh] as $key_rh => $value_rh) {
                            //     // test_var($value_rh);
                            //     echo $weld_process[$value_rh['id_weld_process']].'<br>';
                            //   }
                            // }
                            print_r(str_replace(";", "<br>", $value["weld_process_rh"]));
                            ?>
                        </td>

                        <td style="padding:2px !important;">
                            <?php
                            // $wps_no_fc = array_filter(array_unique(explode(';', $value['wps_no_fc'])));
                            // foreach ($wps_no_fc as $key_wps_no_fc => $value_wps_no_fc) {
                            //   foreach ($wps_detail[$value_wps_no_fc] as $key_fc => $value_fc) {
                            //     echo $weld_process[$value_fc['id_weld_process']].'<br>';
                            //   }
                            // }
                            print_r(str_replace(";", "<br>", $value["weld_process_fc"]));
                            ?>
                        </td>

                        <td style="padding:2px !important;">
                            <?php
                            $welder_rh = array_filter(array_unique(array_column($visual_detail[$value['id_visual']][0], 'id_welder')));
                            $welder_fc = array_filter(array_unique(array_column($visual_detail[$value['id_visual']][1], 'id_welder')));

                            foreach ($welder_rh as $values_weld_rh) {
                                // if ($master_welder[$values_weld_rh]) {
                                //     test_var($master_welder);
                                //     $welder_rh_merge[] = $master_welder[$values_weld_rh]['rwe_code'];
                                // }
                                print_r($data_welder[$values_weld_rh]);

                            }
                            // print_r(implode(',<br>', $welder_rh_merge));
                            // unset($welder_rh_merge);
                            ?>
                        </td>

                        <td style="padding:2px !important;">
                            <?php
                            foreach ($welder_fc as $values_weld_fc) {
                                // if ($master_welder[$values_weld_fc]) {
                                //     $welder_fc_merge[] = $master_welder[$values_weld_fc]['rwe_code'];
                                // }

                                print_r($data_welder[$values_weld_fc]);

                            }
                            // print_r(implode(',<br>', $welder_rh_merge));
                            // unset($welder_rh_merge);

                            // $welder_fc = explode(";", $value['welder_ref_fc']);                          
                            // if(sizeof($welder_fc) > 0){ 
                            //   foreach ($welder_fc as $key => $welder_id_fc) {
                            //     if(isset($master_welder[$welder_id_fc]["rwe_code"])){ 
                            //       echo $master_welder[$welder_id_fc]["rwe_code"]."<br/>";
                            //     }
                            //   }
                            // } 
                            ?>
                        </td>

                        <td style="padding:2px !important;" <?= (in_array($value['visual_status_inspection'], $array_qc_approval) && !empty($value['visual_status_inspection']) ? "class='color_pending_QC'" : null) ?>>

                            <?php if (isset($value['visual_report_no']) and $value['visual_status_inspection'] >= 3) {  ?>

                                <?php if ($value['visual_status_inspection'] != 5) { ?>

                                    <a <?= ($value['visual_status_inspection'] == 5 ? "class='color_pending_client'" : null) ?> href="<?php echo base_url(); ?>visual/visual_pdf/<?= $value['visual_report_no'] ?>/client/<?= $value['drawing_no'] ?>/<?= $value["rev_postpone_visual"] ?>" target='_blank'><?php echo $report_no_vs[$value['project']][$value['discipline']][$value['type_of_module']]['visual_report' . ($value['company_id'] == 13 ? '_13' : '')] . $value['visual_report_no']; ?></a>

                                <?php } else { ?>

                                    <a <?= ($value['visual_status_inspection'] == 5 ? "class='color_pending_client'" : null) ?> href="<?php echo base_url(); ?>visual/detail_inspection/<?= $value['visual_report_no'] ?>/client/<?= $value['drawing_no'] ?>/NULL/<?= $value["rev_postpone_visual"] ?>" target='_blank'><?php echo $report_no_vs[$value['project']][$value['discipline']][$value['type_of_module']]['visual_report' . ($value['company_id'] == 13 ? '_13' : '')] . $value['visual_report_no']; ?></a>

                                <?php } ?>

                            <?php } else { ?>


                                <?php if (in_Array($value['visual_status_inspection'], array(1, 3))) { ?>

                                    <a <?= ($value['visual_status_inspection'] == 1 ? "class='color_pending_client'" : null) ?> href="<?php echo base_url(); ?>visual/visual_pdf/<?= $value['visual_submission_id'] ?>/qc/<?= $value['drawing_no'] ?>" target='_blank'><?php echo $value['visual_submission_id']; ?></a>

                                <?php } else { ?>

                                    <?php if (isset($value['visual_report_no'])) { ?>
                                        <?php echo $report_no_vs[$value['project']][$value['discipline']][$value['type_of_module']]['visual_report' . ($value['company_id'] == 13 ? '_13' : '')] . $value['visual_report_no']; ?>
                                    <?php } else { ?>
                                        -
                                    <?php } ?>

                                <?php } ?>

                            <?php } ?>

                            <?php
                            if (isset($ndt_all_2[$value['id_joint_visual']][3][$value['revision_category']][$value['revision']])) {
                                $total_doble = array();
                                foreach ($ndt_all_2[$value['id_joint_visual']][3][$value['revision_category']][$value['revision']] as $key03 => $val03) {
                                    $total_doble[] = ($val03['date_of_inspection'] < date("Y-m-d", strtotime($value['visual_inspection_datetime'])) ? 1 : 0);
                                }
                                $total_ut = array_sum($total_doble);
                            } else {
                                $total_ut = 0;
                            }

                            if (isset($ndt_all_2[$value['id_joint_visual']][2][$value['revision_category']][$value['revision']])) {
                                $total_doble_MT = array();
                                foreach ($ndt_all_2[$value['id_joint_visual']][2][$value['revision_category']][$value['revision']] as $key02 => $val02) {
                                    $total_doble_MT[] = ($val02['date_of_inspection'] < date("Y-m-d", strtotime($value['visual_inspection_datetime'])) ? 1 : 0);
                                }
                                $total_mt = array_sum($total_doble_MT);
                            } else {
                                $total_mt = 0;
                            }

                            $validate = $total_ut + $total_mt;
                            ?>
                        </td>
                        <td style="padding:2px !important;" <?= ($this->permission_cookie[0] == 1 || $this->permission_cookie[156] == 1 ? ($validate > 0 ? "class='color_date'" : null) : null) ?>>
                            <?php if (isset($value['visual_report_no']) and $value['visual_status_inspection'] >= 3) {  ?>
                                <?php echo date("Y-m-d", strtotime($value['visual_inspection_datetime'])); ?>
                            <?php } else { ?>
                                -
                            <?php } ?>
                        </td>
                        <td style="padding:2px !important;">
                            <?php if (isset($value['visual_report_no']) and $value['visual_status_inspection'] >= 3) {  ?>
                                ACC
                            <?php } else { ?>
                                -
                            <?php } ?>
                        </td>

                        <td style="padding:2px !important;">

                            <?php
                            if (isset($ndt_all_2[$value['id_joint_visual']][2][$value['revision_category']][$value['revision']])) {
                                $total_arr[$key] = sizeof($ndt_all_2[$value['id_joint_visual']][2][$value['revision_category']][$value['revision']]);
                            } else {
                                $total_arr[$key] = 0;
                            }

                            if (isset($ndt_all_2[$value['id_joint_visual']][2][$value['revision_category']][$value['revision']])) {
                                foreach ($ndt_all_2[$value['id_joint_visual']][2][$value['revision_category']][$value['revision']] as $key02 => $val02) {
                            ?>
                                    <?php if (isset($val02['filename'])) {  ?>
                                        <a href="<?= base_url('ndt/open_atc/') . $val02["filename"] . '/' . $val02["filename"] ?>"><?= @$val02['report_number'] . ($val02["attachment_revision"] ? '-' . $val02["attachment_revision"] : '') ?></a>
                                        <!-- <a href="<?= base_url() ?>/upload/ndt/<?= $val02['filename'] ?>" target='blank'><?= @$val02['report_number'] ?></a> -->
                                        <?php if ($total_arr[$key] > 1) {
                                            echo "<hr/>";
                                        } ?>
                                    <?php } else { ?>
                                        <?= @$val02['report_number'] ?>
                                        <?php if ($total_arr[$key] > 1) {
                                            echo "<hr/>";
                                        } ?>
                                    <?php } ?>
                            <?php
                                }
                            } else {
                                echo "-";
                            }
                            ?>
                        </td>
                        <td style="padding:2px !important;">
                            <?php
                            if (isset($ndt_all_2[$value['id_joint_visual']][2][$value['revision_category']][$value['revision']])) {
                                foreach ($ndt_all_2[$value['id_joint_visual']][2][$value['revision_category']][$value['revision']] as $key03 => $val03) {
                            ?>
                                    <?php if (isset($val03['report_number'])) {  ?>
                                        <?= DATE('Y-m-d', strtotime($val03['date_of_inspection'])) ?>
                                        <?php if ($total_arr[$key] > 1) {
                                            echo "<hr/>";
                                        } ?>
                                    <?php } else { ?>
                                        - <?php if ($total_arr[$key] > 1) {
                                                echo "<hr/>";
                                            } ?>
                                    <?php } ?>
                            <?php
                                }
                            } else {
                                echo "-";
                            }
                            ?>
                        </td>
                        <td style="padding:2px !important;">

                            <?php
                            if (isset($ndt_all_2[$value['id_joint_visual']][2][$value['revision_category']][$value['revision']])) {
                                foreach ($ndt_all_2[$value['id_joint_visual']][2][$value['revision_category']][$value['revision']] as $key04 => $val04) {

                            ?>
                                    <?php if ($val04['result'] == 0 and isset($val04['result'])) {  ?>
                                        <a href='<?= base_url(); ?>ndt/ndt_rfi_report/<?= "2" ?>/<?= $val04['visual_transmittal_no'] ?>/<?= $value['discipline'] ?>/<?= $value['type_of_module'] ?>' target='_blank'><span class='color_pending_QC' style='padding:2px;'><b>OS</b></span></a>
                                    <?php } else if ($val04['result'] == 1) {  ?>
                                        <?= "ACC" ?><?php if ($total_arr[$key] > 1) {
                                                        echo "<hr/>";
                                                    } ?>
                                    <?php } else if ($val04['result'] == 2) {  ?>
                                        <?= "REJECT" ?><?php if ($total_arr[$key] > 1) {
                                                            echo "<hr/>";
                                                        } ?>
                                    <?php } else { ?>
                                        -<?php if ($total_arr[$key] > 1) {
                                                echo "<hr/>";
                                            } ?>
                                    <?php } ?>
                            <?php
                                }
                            } else {
                                echo "-";
                            }
                            ?>

                        </td>

                        <td style="padding:2px !important;">
                            <?php

                            if (isset($ndt_all_2[$value['id_joint_visual']][7][$value['revision_category']][$value['revision']])) {
                                $total_arr[$key] = sizeof($ndt_all_2[$value['id_joint_visual']][7][$value['revision_category']][$value['revision']]);
                            } else {
                                $total_arr[$key] = 0;
                            }

                            if (isset($ndt_all_2[$value['id_joint_visual']][7][$value['revision_category']][$value['revision']])) {
                                foreach ($ndt_all_2[$value['id_joint_visual']][7][$value['revision_category']][$value['revision']] as $key02 => $val02) {
                            ?>
                                    <?php if (isset($val02['filename'])) {  ?>
                                        <a href="<?= base_url('ndt/open_atc/') . $val02["filename"] . '/' . $val02["filename"] ?>"><?= @$val02['report_number'] . ($val02["attachment_revision"] ? '-' . $val02["attachment_revision"] : '') ?></a>
                                        <!-- <a href="<?= base_url() ?>/upload/ndt/<?= $val02['filename'] ?>" target='blank'><?= @$val02['report_number'] ?></a> -->
                                        <?php if ($total_arr[$key] > 1) {
                                            echo "<hr/>";
                                        } ?>
                                    <?php } else { ?>
                                        <?= @$val02['report_number'] ?>
                                        <?php if ($total_arr[$key] > 1) {
                                            echo "<hr/>";
                                        } ?>
                                    <?php } ?>
                            <?php
                                }
                            } else {
                                echo "-";
                            }
                            ?>
                        </td>
                        <td style="padding:2px !important;">
                            <?php
                            if (isset($ndt_all_2[$value['id_joint_visual']][7][$value['revision_category']][$value['revision']])) {
                                foreach ($ndt_all_2[$value['id_joint_visual']][7][$value['revision_category']][$value['revision']] as $key03 => $val03) {
                            ?>
                                    <?php if (isset($val03['report_number'])) {  ?>
                                        <?= DATE('Y-m-d', strtotime($val03['date_of_inspection'])) ?>
                                        <?php if ($total_arr[$key] > 1) {
                                            echo "<hr/>";
                                        } ?>
                                    <?php } else { ?>
                                        - <?php if ($total_arr[$key] > 1) {
                                                echo "<hr/>";
                                            } ?>
                                    <?php } ?>
                            <?php
                                }
                            } else {
                                echo "-";
                            }
                            ?>
                        </td>
                        <td style="padding:2px !important;">
                            <?php
                            if (isset($ndt_all_2[$value['id_joint_visual']][7][$value['revision_category']][$value['revision']])) {
                                foreach ($ndt_all_2[$value['id_joint_visual']][7][$value['revision_category']][$value['revision']] as $key04 => $val04) {
                            ?>
                                    <?php if ($val04['result'] == 0 and isset($val04['result'])) {  ?>
                                        <a href='<?= base_url(); ?>ndt/ndt_rfi_report/<?= "7" ?>/<?= $val04['visual_transmittal_no'] ?>/<?= $value['discipline'] ?>/<?= $value['type_of_module'] ?>' target='_blank'><span class='color_pending_QC' style='padding:2px;'><b>OS</b></span></a>
                                    <?php } else if ($val04['result'] == 1) {  ?>
                                        <?= "ACC" ?><?php if ($total_arr[$key] > 1) {
                                                        echo "<hr/>";
                                                    } ?>
                                    <?php } else if ($val04['result'] == 2) {  ?>
                                        <?= "REJECT" ?><?php if ($total_arr[$key] > 1) {
                                                            echo "<hr/>";
                                                        } ?>
                                    <?php } else { ?>
                                        -<?php if ($total_arr[$key] > 1) {
                                                echo "<hr/>";
                                            } ?>
                                    <?php } ?>
                            <?php
                                }
                            } else {
                                echo "-";
                            }
                            ?>

                        </td>

                        <td style="padding:2px !important;">
                            <?php

                            if (isset($ndt_all_2[$value['id_joint_visual']][3][$value['revision_category']][$value['revision']])) {
                                $total_arr[$key] = sizeof($ndt_all_2[$value['id_joint_visual']][3][$value['revision_category']][$value['revision']]);
                            } else {
                                $total_arr[$key] = 0;
                            }

                            if (isset($ndt_all_2[$value['id_joint_visual']][3][$value['revision_category']][$value['revision']])) {
                                foreach ($ndt_all_2[$value['id_joint_visual']][3][$value['revision_category']][$value['revision']] as $key02 => $val02) {
                            ?>
                                    <?php if (isset($val02['filename'])) {  ?>
                                        <a href="<?= base_url('ndt/open_atc/') . $val02["filename"] . '/' . $val02["filename"] ?>"><?= @$val02['report_number'] . ($val02["attachment_revision"] ? '-' . $val02["attachment_revision"] : '') ?></a>
                                        <!-- <a href="<?= base_url() ?>/upload/ndt/<?= $val02['filename'] ?>" target='blank'><?= @$val02['report_number'] ?></a> -->
                                        <?php if ($total_arr[$key] > 1) {
                                            echo "<hr/>";
                                        } ?>
                                    <?php } else { ?>
                                        <?= @$val02['report_number'] ?>
                                        <?php if ($total_arr[$key] > 1) {
                                            echo "<hr/>";
                                        } ?>
                                    <?php } ?>
                            <?php
                                }
                            } else {
                                echo "-";
                            }
                            ?>
                        </td>
                        <td style="padding:2px !important;">
                            <?php
                            if (isset($ndt_all_2[$value['id_joint_visual']][3][$value['revision_category']][$value['revision']])) {
                                foreach ($ndt_all_2[$value['id_joint_visual']][3][$value['revision_category']][$value['revision']] as $key03 => $val03) {
                            ?>
                                    <?php if (isset($val03['report_number'])) {  ?>
                                        <?= DATE('Y-m-d', strtotime($val03['date_of_inspection'])) ?>
                                        <?php if ($total_arr[$key] > 1) {
                                            echo "<hr/>";
                                        } ?>
                                    <?php } else { ?>
                                        - <?php if ($total_arr[$key] > 1) {
                                                echo "<hr/>";
                                            } ?>
                                    <?php } ?>
                            <?php
                                }
                            } else {
                                echo "-";
                            }
                            ?>
                        </td>
                        <td style="padding:2px !important;">
                            <?php
                            if (isset($ndt_all_2[$value['id_joint_visual']][3][$value['revision_category']][$value['revision']])) {
                                foreach ($ndt_all_2[$value['id_joint_visual']][3][$value['revision_category']][$value['revision']] as $key04 => $val04) {
                            ?>
                                    <?php if ($val04['result'] == 0 and isset($val04['result'])) {  ?>
                                        <a href='<?= base_url(); ?>ndt/ndt_rfi_report/<?= "3" ?>/<?= $val04['visual_transmittal_no'] ?>/<?= $value['discipline'] ?>/<?= $value['type_of_module'] ?>' target='_blank'><span class='color_pending_QC' style='padding:2px;'><b>OS</b></span></a>
                                    <?php } else if ($val04['result'] == 1) {  ?>
                                        <?= "ACC" ?><?php if ($total_arr[$key] > 1) {
                                                        echo "<hr/>";
                                                    } ?>
                                    <?php } else if ($val04['result'] == 2) {  ?>
                                        <?= "REJECT" ?><?php if ($total_arr[$key] > 1) {
                                                            echo "<hr/>";
                                                        } ?>
                                    <?php } else { ?>
                                        -<?php if ($total_arr[$key] > 1) {
                                                echo "<hr/>";
                                            } ?>
                                    <?php } ?>
                            <?php
                                }
                            } else {
                                echo "-";
                            }
                            ?>

                        </td>

                        <td style="padding:2px !important;">
                            <?php if (isset($ndt_wtr_empire[$value["id_joint"]][4]["report_number"])) {
                                echo $ndt_wtr_empire[$value["id_joint"]][4]["report_number"];
                            } else {
                                echo "-";
                            }
                            ?>
                        </td>

                        <td style="padding:2px !important;">
                            <?php if (isset($ndt_wtr_empire[$value["id_joint"]][4]["report_number"])) {
                                echo DATE('Y-m-d', strtotime($ndt_wtr_empire['date_of_inspection']));
                            } else {
                                echo "-";
                            }
                            ?>
                        </td>

                        <td style="padding:2px !important;">
                            <?php if (isset($ndt_wtr_empire[$value["id_joint"]][4]["report_number"])) : ?>
                                <?php if ($ndt_wtr_empire[$value["id_joint"]][4]["result"] == 0) : ?>
                                    <?= "O/S" ?>
                                <?php elseif ($ndt_wtr_empire[$value["id_joint"]][4]["result"] == 1) : ?>
                                    <?= "ACC" ?>
                                <?php elseif ($ndt_wtr_empire[$value["id_joint"]][4]["result"] == 2) : ?>
                                    <?= "REJECT" ?>
                                <?php endif; ?>
                            <?php else : ?>
                                <?php echo "-"; ?>
                            <?php endif; ?>
                        </td>

                        <td style="padding:2px !important;">
                            <?php
                            if (isset($ndt_all_2[$value['id_joint_visual']][1][$value['revision_category']][$value['revision']])) {
                                $total_arr[$key] = sizeof($ndt_all_2[$value['id_joint_visual']][1][$value['revision_category']][$value['revision']]);
                            } else {
                                $total_arr[$key] = 0;
                            }
                            ?>
                            <?php
                            if (isset($ndt_all_2[$value['id_joint_visual']][1][$value['revision_category']][$value['revision']])) {
                                foreach ($ndt_all_2[$value['id_joint_visual']][1][$value['revision_category']][$value['revision']] as $key02 => $val02) {
                            ?>
                                    <?php if (isset($val02['filename'])) {  ?>
                                        <a href="<?= base_url('ndt/open_atc/') . $val02["filename"] . '/' . $val02["filename"] ?>"><?= @$val02['report_number'] . ($val02["attachment_revision"] ? '-' . $val02["attachment_revision"] : '') ?></a>
                                        <!-- <a href="<?= base_url() ?>/upload/ndt/<?= $val02['filename'] ?>" target='blank'><?= @$val02['report_number'] ?></a> -->
                                        <?php if ($total_arr[$key] > 1) {
                                            echo "<hr/>";
                                        } ?>
                                    <?php } else { ?>
                                        <?= @$val02['report_number'] ?>
                                        <?php if ($total_arr[$key] > 1) {
                                            echo "<hr/>";
                                        } ?>
                                    <?php } ?>
                            <?php
                                }
                            } else {
                                echo "-";
                            }
                            ?>
                        </td>
                        <td style="padding:2px !important;">
                            <?php
                            if (isset($ndt_all_2[$value['id_joint_visual']][1][$value['revision_category']][$value['revision']])) {
                                foreach ($ndt_all_2[$value['id_joint_visual']][1][$value['revision_category']][$value['revision']] as $key03 => $val03) {
                            ?>
                                    <?php if (isset($val03['report_number'])) {  ?>
                                        <?= DATE('Y-m-d', strtotime($val03['date_of_inspection'])) ?>
                                        <?php if ($total_arr[$key] > 1) {
                                            echo "<hr/>";
                                        } ?>
                                    <?php } else { ?>
                                        - <?php if ($total_arr[$key] > 1) {
                                                echo "<hr/>";
                                            } ?>
                                    <?php } ?>
                            <?php
                                }
                            } else {
                                echo "-";
                            }
                            ?>
                        </td>
                        <td style="padding:2px !important;">
                            <?php
                            if (isset($ndt_all_2[$value['id_joint_visual']][1][$value['revision_category']][$value['revision']])) {
                                foreach ($ndt_all_2[$value['id_joint_visual']][1][$value['revision_category']][$value['revision']] as $key04 => $val04) {
                            ?>
                                    <?php if ($val04['result'] == 0 and isset($val04['result'])) {  ?>
                                        <a href='<?= base_url(); ?>ndt/ndt_rfi_report/<?= "1" ?>/<?= $val04['visual_transmittal_no'] ?>/<?= $value['discipline'] ?>/<?= $value['type_of_module'] ?>' target='_blank'><span class='color_pending_QC' style='padding:2px;'><b>OS</b></span></a>
                                    <?php } else if ($val04['result'] == 1) {  ?>
                                        <?= "ACC" ?><?php if ($total_arr[$key] > 1) {
                                                        echo "<hr/>";
                                                    } ?>
                                    <?php } else if ($val04['result'] == 2) {  ?>
                                        <?= "REJECT" ?><?php if ($total_arr[$key] > 1) {
                                                            echo "<hr/>";
                                                        } ?>
                                    <?php } else { ?>
                                        -<?php if ($total_arr[$key] > 1) {
                                                echo "<hr/>";
                                            } ?>
                                    <?php } ?>
                            <?php
                                }
                            } else {
                                echo "-";
                            }
                            ?>
                        </td>

                        <td style="padding:2px !important;">
                            <?php if (isset($ndt_wtr_empire[$value["id_joint"]][10]["report_number"])) {
                                echo $ndt_wtr_empire[$value["id_joint"]][10]["report_number"];
                            } else {
                                echo "-";
                            }
                            ?>
                        </td>

                        <td style="padding:2px !important;">
                            <?php if (isset($ndt_wtr_empire[$value["id_joint"]][10]["report_number"])) {
                                echo DATE('Y-m-d', strtotime($ndt_wtr_empire['date_of_inspection']));
                            } else {
                                echo "-";
                            }
                            ?>
                        </td>

                        <td style="padding:2px !important;">
                            <?php if (isset($ndt_wtr_empire[$value["id_joint"]][10]["report_number"])) : ?>
                                <?php if ($ndt_wtr_empire[$value["id_joint"]][10]["result"] == 0) : ?>
                                    <?= "O/S" ?>
                                <?php elseif ($ndt_wtr_empire[$value["id_joint"]][10]["result"] == 1) : ?>
                                    <?= "ACC" ?>
                                <?php elseif ($ndt_wtr_empire[$value["id_joint"]][10]["result"] == 2) : ?>
                                    <?= "REJECT" ?>
                                <?php endif; ?>
                            <?php else : ?>
                                <?php echo "-"; ?>
                            <?php endif; ?>
                        </td>

                        <td style="padding:2px !important;">
                            <?php if (isset($ndt_wtr_empire[$value["id_joint"]][11]["report_number"])) {
                                echo $ndt_wtr_empire[$value["id_joint"]][11]["report_number"];
                            } else {
                                echo "-";
                            }
                            ?>
                        </td>

                        <td style="padding:2px !important;">
                            <?php if (isset($ndt_wtr_empire[$value["id_joint"]][11]["report_number"])) {
                                echo DATE('Y-m-d', strtotime($ndt_wtr_empire['date_of_inspection']));
                            } else {
                                echo "-";
                            }
                            ?>
                        </td>

                        <td style="padding:2px !important;">
                            <?php if (isset($ndt_wtr_empire[$value["id_joint"]][11]["report_number"])) : ?>
                                <?php if ($ndt_wtr_empire[$value["id_joint"]][11]["result"] == 0) : ?>
                                    <?= "O/S" ?>
                                <?php elseif ($ndt_wtr_empire[$value["id_joint"]][11]["result"] == 1) : ?>
                                    <?= "ACC" ?>
                                <?php elseif ($ndt_wtr_empire[$value["id_joint"]][11]["result"] == 2) : ?>
                                    <?= "REJECT" ?>
                                <?php endif; ?>
                            <?php else : ?>
                                <?php echo "-"; ?>
                            <?php endif; ?>
                        </td>

                        <td style="padding:2px !important;">
                            <?php if (isset($ndt_wtr_empire[$value["id_joint"]][12]["report_number"])) {
                                echo $ndt_wtr_empire[$value["id_joint"]][12]["report_number"];
                            } else {
                                echo "-";
                            }
                            ?>
                        </td>

                        <td style="padding:2px !important;">
                            <?php if (isset($ndt_wtr_empire[$value["id_joint"]][12]["report_number"])) {
                                echo DATE('Y-m-d', strtotime($ndt_wtr_empire['date_of_inspection']));
                            } else {
                                echo "-";
                            }
                            ?>
                        </td>

                        <td style="padding:2px !important;">
                            <?php if (isset($ndt_wtr_empire[$value["id_joint"]][12]["report_number"])) : ?>
                                <?php if ($ndt_wtr_empire[$value["id_joint"]][12]["result"] == 0) : ?>
                                    <?= "O/S" ?>
                                <?php elseif ($ndt_wtr_empire[$value["id_joint"]][12]["result"] == 1) : ?>
                                    <?= "ACC" ?>
                                <?php elseif ($ndt_wtr_empire[$value["id_joint"]][12]["result"] == 2) : ?>
                                    <?= "REJECT" ?>
                                <?php endif; ?>
                            <?php else : ?>
                                <?php echo "-"; ?>
                            <?php endif; ?>
                        </td>

                        <td style="padding:2px !important;">
                            <?php if (isset($ndt_wtr_empire[$value["id_joint"]][13]["report_number"])) {
                                echo $ndt_wtr_empire[$value["id_joint"]][13]["report_number"];
                            } else {
                                echo "-";
                            }
                            ?>
                        </td>

                        <td style="padding:2px !important;">
                            <?php if (isset($ndt_wtr_empire[$value["id_joint"]][13]["report_number"])) {
                                echo DATE('Y-m-d', strtotime($ndt_wtr_empire['date_of_inspection']));
                            } else {
                                echo "-";
                            }
                            ?>
                        </td>

                        <td style="padding:2px !important;">
                            <?php if (isset($ndt_wtr_empire[$value["id_joint"]][13]["report_number"])) : ?>
                                <?php if ($ndt_wtr_empire[$value["id_joint"]][13]["result"] == 0) : ?>
                                    <?= "O/S" ?>
                                <?php elseif ($ndt_wtr_empire[$value["id_joint"]][13]["result"] == 1) : ?>
                                    <?= "ACC" ?>
                                <?php elseif ($ndt_wtr_empire[$value["id_joint"]][13]["result"] == 2) : ?>
                                    <?= "REJECT" ?>
                                <?php endif; ?>
                            <?php else : ?>
                                <?php echo "-"; ?>
                            <?php endif; ?>
                        </td>

                        <td style="padding:2px !important;">
                            <?php if (isset($ndt_wtr_empire[$value["id_joint"]][14]["report_number"])) {
                                echo $ndt_wtr_empire[$value["id_joint"]][14]["report_number"];
                            } else {
                                echo "-";
                            }
                            ?>
                        </td>

                        <td style="padding:2px !important;">
                            <?php if (isset($ndt_wtr_empire[$value["id_joint"]][14]["report_number"])) {
                                echo DATE('Y-m-d', strtotime($ndt_wtr_empire['date_of_inspection']));
                            } else {
                                echo "-";
                            }
                            ?>
                        </td>

                        <td style="padding:2px !important;">
                            <?php if (isset($ndt_wtr_empire[$value["id_joint"]][14]["report_number"])) : ?>
                                <?php if ($ndt_wtr_empire[$value["id_joint"]][14]["result"] == 0) : ?>
                                    <?= "O/S" ?>
                                <?php elseif ($ndt_wtr_empire[$value["id_joint"]][14]["result"] == 1) : ?>
                                    <?= "ACC" ?>
                                <?php elseif ($ndt_wtr_empire[$value["id_joint"]][14]["result"] == 2) : ?>
                                    <?= "REJECT" ?>
                                <?php endif; ?>
                            <?php else : ?>
                                <?php echo "-"; ?>
                            <?php endif; ?>
                        </td>

                        <td style="padding:2px !important;">
                            <?php if (isset($ndt_wtr_empire[$value["id_joint"]][15]["report_number"])) {
                                echo $ndt_wtr_empire[$value["id_joint"]][15]["report_number"];
                            } else {
                                echo "-";
                            }
                            ?>
                        </td>

                        <td style="padding:2px !important;">
                            <?php if (isset($ndt_wtr_empire[$value["id_joint"]][15]["report_number"])) {
                                echo DATE('Y-m-d', strtotime($ndt_wtr_empire['date_of_inspection']));
                            } else {
                                echo "-";
                            }
                            ?>
                        </td>

                        <td style="padding:2px !important;">
                            <?php if (isset($ndt_wtr_empire[$value["id_joint"]][15]["report_number"])) : ?>
                                <?php if ($ndt_wtr_empire[$value["id_joint"]][15]["result"] == 0) : ?>
                                    <?= "O/S" ?>
                                <?php elseif ($ndt_wtr_empire[$value["id_joint"]][15]["result"] == 1) : ?>
                                    <?= "ACC" ?>
                                <?php elseif ($ndt_wtr_empire[$value["id_joint"]][15]["result"] == 2) : ?>
                                    <?= "REJECT" ?>
                                <?php endif; ?>
                            <?php else : ?>
                                <?php echo "-"; ?>
                            <?php endif; ?>
                        </td>


                        <td><?php if ($value['visual_ndt_pwht'] == 1) {
                                echo "YES";
                            } else {
                                echo "-";
                            } ?></td>
                        <td><?php if ($value['visual_ndt_pwht'] == 0) {
                                echo "NO";
                            } else {
                                echo "-";
                            } ?></td>
                        <td style="padding:2px !important;">
                            <?php
                            if (isset($ndt_all_2[$value['id_joint_visual']][9][$value['revision_category']][$value['revision']])) {
                                $total_arr[$key] = sizeof($ndt_all_2[$value['id_joint_visual']][9][$value['revision_category']][$value['revision']]);
                            } else {
                                $total_arr[$key] = 0;
                            }

                            if (isset($ndt_all_2[$value['id_joint_visual']][9][$value['revision_category']][$value['revision']])) {
                                foreach ($ndt_all_2[$value['id_joint_visual']][9][$value['revision_category']][$value['revision']] as $key02 => $val02) {
                            ?>
                                    <?php if (isset($val02['filename'])) {  ?>
                                        <a href="<?= base_url('ndt/open_atc/') . $val02["filename"] . '/' . $val02["filename"] ?>"><?= @$val02['report_number'] . ($val02["attachment_revision"] ? '-' . $val02["attachment_revision"] : '') ?></a>
                                        <!-- <a href="<?= base_url() ?>/upload/ndt/<?= $val02['filename'] ?>" target='blank'><?= @$val02['report_number'] ?></a> -->
                                        <?php if ($total_arr[$key] > 1) {
                                            echo "<hr/>";
                                        } ?>
                                    <?php } else { ?>
                                        <?= @$val02['report_number'] ?>
                                        <?php if ($total_arr[$key] > 1) {
                                            echo "<hr/>";
                                        } ?>
                                    <?php } ?>
                            <?php
                                }
                            } else {
                                echo "-";
                            }
                            ?>
                        </td>
                        <td style="padding:2px !important;">
                            <?php
                            if (isset($ndt_all_2[$value['id_joint_visual']][9][$value['revision_category']][$value['revision']])) {
                                foreach ($ndt_all_2[$value['id_joint_visual']][9][$value['revision_category']][$value['revision']] as $key03 => $val03) {
                            ?>
                                    <?php if (isset($val03['report_number'])) {  ?>
                                        <?= DATE('Y-m-d', strtotime($val03['date_of_inspection'])) ?>
                                        <?php if ($total_arr[$key] > 1) {
                                            echo "<hr/>";
                                        } ?>
                                    <?php } else { ?>
                                        - <?php if ($total_arr[$key] > 1) {
                                                echo "<hr/>";
                                            } ?>
                                    <?php } ?>
                            <?php
                                }
                            } else {
                                echo "-";
                            }
                            ?>
                        </td>
                        <td style="padding:2px !important;">
                            <?php
                            if (isset($ndt_all_2[$value['id_joint_visual']][9][$value['revision_category']][$value['revision']])) {
                                foreach ($ndt_all_2[$value['id_joint_visual']][9][$value['revision_category']][$value['revision']] as $key04 => $val04) {

                            ?>
                                    <?php if ($val04['result'] == 0 and isset($val04['result'])) {  ?>
                                        <a href='<?= base_url(); ?>ndt/ndt_rfi_report/<?= "9" ?>/<?= $val04['visual_transmittal_no'] ?>/<?= $value['discipline'] ?>/<?= $value['type_of_module'] ?>' target='_blank'><span class='color_pending_QC' style='padding:2px;'><b>OS</b></span></a>
                                    <?php } else if ($val04['result'] == 1) {  ?>
                                        <?= "ACC" ?><?php if ($total_arr[$key] > 1) {
                                                        echo "<hr/>";
                                                    } ?>
                                    <?php } else if ($val04['result'] == 2) {  ?>
                                        <?= "REJECT" ?><?php if ($total_arr[$key] > 1) {
                                                            echo "<hr/>";
                                                        } ?>
                                    <?php } else { ?>
                                        -<?php if ($total_arr[$key] > 1) {
                                                echo "<hr/>";
                                            } ?>
                                    <?php } ?>
                            <?php
                                }
                            } else {
                                echo "-";
                            }
                            ?>
                        </td>

                        <td style="padding:2px !important;">
                            <?php
                            if (isset($ndt_all_2[$value['id_joint_visual']][8][$value['revision_category']][$value['revision']])) {
                                $total_arr[$key] = sizeof($ndt_all_2[$value['id_joint_visual']][8][$value['revision_category']][$value['revision']]);
                            } else {
                                $total_arr[$key] = 0;
                            }
                            ?>
                            <?php
                            if (isset($ndt_all_2[$value['id_joint_visual']][8][$value['revision_category']][$value['revision']])) {
                                foreach ($ndt_all_2[$value['id_joint_visual']][8][$value['revision_category']][$value['revision']] as $key02 => $val02) {
                            ?>
                                    <?php if (isset($val02['filename'])) {  ?>
                                        <a href="<?= base_url('ndt/open_atc/') . $val02["filename"] . '/' . $val02["filename"] ?>"><?= @$val02['report_number'] . ($val02["attachment_revision"] ? '-' . $val02["attachment_revision"] : '') ?></a>
                                        <!-- <a href="<?= base_url() ?>/upload/ndt/<?= $val02['filename'] ?>" target='blank'><?= @$val02['report_number'] ?></a> -->
                                        <?php if ($total_arr[$key] > 1) {
                                            echo "<hr/>";
                                        } ?>
                                    <?php } else { ?>
                                        <?= @$val02['report_number'] ?>
                                        <?php if ($total_arr[$key] > 1) {
                                            echo "<hr/>";
                                        } ?>
                                    <?php } ?>
                            <?php
                                }
                            } else {
                                echo "-";
                            }
                            ?>
                        </td>
                        <td style="padding:2px !important;">
                            <?php
                            if (isset($ndt_all_2[$value['id_joint_visual']][8][$value['revision_category']][$value['revision']])) {
                                foreach ($ndt_all_2[$value['id_joint_visual']][8][$value['revision_category']][$value['revision']] as $key03 => $val03) {
                            ?>
                                    <?php if (isset($val03['report_number'])) {  ?>
                                        <?= DATE('Y-m-d', strtotime($val03['date_of_inspection'])) ?>
                                        <?php if ($total_arr[$key] > 1) {
                                            echo "<hr/>";
                                        } ?>
                                    <?php } else { ?>
                                        - <?php if ($total_arr[$key] > 1) {
                                                echo "<hr/>";
                                            } ?>
                                    <?php } ?>
                            <?php
                                }
                            } else {
                                echo "-";
                            }
                            ?>
                        </td>
                        <td style="padding:2px !important;">
                            <?php
                            if (isset($ndt_all_2[$value['id_joint_visual']][8][$value['revision_category']][$value['revision']])) {
                                foreach ($ndt_all_2[$value['id_joint_visual']][8][$value['revision_category']][$value['revision']] as $key04 => $val04) {
                            ?>
                                    <?php if ($val04['result'] == 0 and isset($val04['result'])) {  ?>
                                        <a href='<?= base_url(); ?>ndt/ndt_rfi_report/<?= "8" ?>/<?= $val04['visual_transmittal_no'] ?>/<?= $value['discipline'] ?>/<?= $value['type_of_module'] ?>' target='_blank'><span class='color_pending_QC' style='padding:2px;'><b>OS</b></span></a>
                                    <?php } else if ($val04['result'] == 1) {  ?>
                                        <?= "ACC" ?><?php if ($total_arr[$key] > 1) {
                                                        echo "<hr/>";
                                                    } ?>
                                    <?php } else if ($val04['result'] == 2) {  ?>
                                        <?= "REJECT" ?><?php if ($total_arr[$key] > 1) {
                                                            echo "<hr/>";
                                                        } ?>
                                    <?php } else { ?>
                                        -<?php if ($total_arr[$key] > 1) {
                                                echo "<hr/>";
                                            } ?>
                                    <?php } ?>
                            <?php
                                }
                            } else {
                                echo "-";
                            }
                            ?>
                        </td>


                        <td style="padding:2px !important;">
                            <?php
                            if (isset($ndt_all_2[$value['id_joint_visual']][5][$value['revision_category']][$value['revision']])) {
                                $total_arr[$key] = sizeof($ndt_all_2[$value['id_joint_visual']][5][$value['revision_category']][$value['revision']]);
                            } else {
                                $total_arr[$key] = 0;
                            }
                            ?>
                            <?php
                            if (isset($ndt_all_2[$value['id_joint_visual']][5][$value['revision_category']][$value['revision']])) {
                                foreach ($ndt_all_2[$value['id_joint_visual']][5][$value['revision_category']][$value['revision']] as $key02 => $val02) {
                            ?>
                                    <?php if (isset($val02['filename'])) {  ?>
                                        <a href="<?= base_url('ndt/open_atc/') . $val02["filename"] . '/' . $val02["filename"] ?>"><?= @$val02['report_number'] . ($val02["attachment_revision"] ? '-' . $val02["attachment_revision"] : '') ?></a>
                                        <!-- <a href="<?= base_url() ?>/upload/ndt/<?= $val02['filename'] ?>" target='blank'><?= @$val02['report_number'] ?></a> -->
                                        <?php if ($total_arr[$key] > 1) {
                                            echo "<hr/>";
                                        } ?>
                                    <?php } else { ?>
                                        <?= @$val02['report_number'] ?>
                                        <?php if ($total_arr[$key] > 1) {
                                            echo "<hr/>";
                                        } ?>
                                    <?php } ?>
                            <?php
                                }
                            } else {
                                echo "-";
                            }
                            ?>
                        </td>
                        <td style="padding:2px !important;">
                            <?php
                            if (isset($ndt_all_2[$value['id_joint_visual']][5][$value['revision_category']][$value['revision']])) {
                                foreach ($ndt_all_2[$value['id_joint_visual']][5][$value['revision_category']][$value['revision']] as $key03 => $val03) {
                            ?>
                                    <?php if (isset($val03['report_number'])) {  ?>
                                        <?= DATE('Y-m-d', strtotime($val03['date_of_inspection'])) ?>
                                        <?php if ($total_arr[$key] > 1) {
                                            echo "<hr/>";
                                        } ?>
                                    <?php } else { ?>
                                        - <?php if ($total_arr[$key] > 1) {
                                                echo "<hr/>";
                                            } ?>
                                    <?php } ?>
                            <?php
                                }
                            } else {
                                echo "-";
                            }
                            ?>
                        </td>
                        <td style="padding:2px !important;">
                            <?php
                            if (isset($ndt_all_2[$value['id_joint_visual']][5][$value['revision_category']][$value['revision']])) {
                                foreach ($ndt_all_2[$value['id_joint_visual']][5][$value['revision_category']][$value['revision']] as $key04 => $val04) {
                            ?>
                                    <?php if ($val04['result'] == 0 and isset($val04['result'])) {  ?>
                                        <a href='<?= base_url(); ?>ndt/ndt_rfi_report/<?= "5" ?>/<?= $val04['visual_transmittal_no'] ?>/<?= $value['discipline'] ?>/<?= $value['type_of_module'] ?>' target='_blank'><span class='color_pending_QC' style='padding:2px;'><b>OS</b></span></a>
                                    <?php } else if ($val04['result'] == 1) {  ?>
                                        <?= "ACC" ?><?php if ($total_arr[$key] > 1) {
                                                        echo "<hr/>";
                                                    } ?>
                                    <?php } else if ($val04['result'] == 2) {  ?>
                                        <?= "REJECT" ?><?php if ($total_arr[$key] > 1) {
                                                            echo "<hr/>";
                                                        } ?>
                                    <?php } else { ?>
                                        -<?php if ($total_arr[$key] > 1) {
                                                echo "<hr/>";
                                            } ?>
                                    <?php } ?>
                            <?php
                                }
                            } else {
                                echo "-";
                            }
                            ?>
                        </td>

                        <td style="padding:2px !important;">
                            <?= (isset($value["irn_report_no"]) ? $report_no_irn[$value['project']][$value['discipline']][$value['type_of_module']]['irn_report' . ($value['company_id'] == 13 ? '_scm' : '')] . $value["irn_report_no"] : (isset($value["irn_submission_id"]) ? "Draft" : "-")) ?>
                        </td>
                        <td style="padding:2px !important;"><?= @isset($value['irn_status_inspection']) && $value['irn_status_inspection'] == 7 ? date("Y-m-d", strtotime($value['irn_client_approval_date'])) : "-"  ?></td>
                        <td style="padding:2px !important;"><?= @isset($value['irn_status_inspection']) && $value['irn_status_inspection'] == 7 ? 'ACC' : "-" ?></td>

                        <td style="padding:2px !important;">
                            <?php
                            if ($value["smoe_remarks"]) {
                                echo str_replace("\n", "<br/>", $value["smoe_remarks"]);
                            } elseif (isset($pc_pos_1['id_mis'])) {
                                echo str_replace("\n", "<br/>", $value["visual_remarks"]);
                            }
                            ?>
                        </td>
                        <td style="padding:2px !important;"><?php echo $value['test_pack_no']; ?></td>
                        <?php if (isset($for_mwtr_signed)) { ?>
                            <?php if ($value['mwtr_signed_status_inspection'] == "0") { ?>
                                <td style="padding:2px !important;">
                                    <a href="<?= base_url() ?>wtr/delete_mwtr_sign_data/<?= strtr($this->encryption->encrypt($value["mwtr_signed_uniq_id"]), '+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt($value["id_joint"]), '+=/', '.-~') ?>" class="buttonxx button3xx" onclick="confirm('Want to remove?')">Remove</a>
                                </td>
                            <?php } ?>
                        <?php } ?>
                    </tr>
                <?php

                }

                $array_approval = array(7, 9);

                ?>
            </tbody>
        </table>
        <br /><br />
        <table width="100%">
            <tr>
                <td colspan="16">
                    <?php if ($is_wtr != 'wtr') { ?>
                        <table class="table-body" width="100%" style="text-align: left; border-collapse: collapse !important;">
                            <tr>
                                <td style="width: 25%; border: none;"></td>
                                <td style="width: 25%; border: none;"></td>
                                <td style="width: 25%; border: none;"></td>
                                <td style="width: 25%; border: none;"></td>
                                <td style="width: 25%; border: none;"></td>
                            </tr>
                            <tr>
                                <td style="width: 25%; border: none;">
                                    <?php if (isset($for_mwtr_signed)) { ?>
                                        <?php if ($wtr_list[0]['mwtr_signed_status_inspection'] >= 3) { ?>
                                            <?php if (isset($wtr_list[0]["mwtr_signed_smoe_approval_by"])) { ?>
                                                <img style="width:100px;" src="data:image/png;base64, <?= (isset($wtr_list[0]["mwtr_signed_smoe_approval_by"]) ? $sign_approval[$wtr_list[0]["mwtr_signed_smoe_approval_by"]] : "-") ?>">
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <?php if (isset($show_pcms_irn[0]["smoe_approval_by"])) { ?>
                                            <img style="width:100px;" src="data:image/png;base64, <?= (isset($show_pcms_irn[0]["smoe_approval_by"]) ? $sign_approval[$show_pcms_irn[0]["smoe_approval_by"]] : "-") ?>">
                                        <?php } ?>
                                    <?php }  ?>
                                </td>
                                <td style="width: 25%; border: none;"></td>
                                <!-- <td style="width: 25%; border: none;">
                        <?php if (isset($for_mwtr_signed)) { ?>
                              <?php if ($wtr_list[0]['mwtr_signed_status_inspection'] >= 5) { ?>
                                <?php if (isset($wtr_list[0]["mwtr_signed_client_approval_by"])) { ?>
                                  <img style="width:100px;" src="data:image/png;base64, <?= (isset($wtr_list[0]["mwtr_signed_client_approval_by"]) ? $sign_approval[$wtr_list[0]["mwtr_signed_client_approval_by"]] : "-") ?>">  
                                <?php } ?>
                              <?php } ?>
                        <?php } else { ?>
                            <?php if (isset($show_pcms_irn[0]["client_approval_by"]) && in_array($show_pcms_irn[0]["status_inspection"], $array_approval)) { ?>
                              <img  style="width:100px;" src="data:image/png;base64, <?= (isset($show_pcms_irn[0]["client_approval_by"]) ? $sign_approval[$show_pcms_irn[0]["client_approval_by"]] : "-") ?>">
                            <?php } ?>
                        <?php } ?>
                      </td> -->
                                <td style="width: 25%; border: none;">
                                    <?php if ($is_wtr != 'wtr') { ?>
                                        <?php if (isset($for_mwtr_signed)) { ?>
                                            <?php if ($wtr_list[0]['mwtr_signed_status_inspection'] >= 5) { ?>
                                                <?php if (isset($wtr_list[0]["mwtr_signed_client_approval_by"])) { ?>

                                                    <!-- <img style="width:100px;" src="data:image/png;base64, <?= (isset($wtr_list[0]["mwtr_signed_client_approval_by"]) ? $sign_approval[$wtr_list[0]["mwtr_signed_client_approval_by"]] : "-") ?>">   -->

                                                    <?php
                                                    if (isset($for_mwtr_signed)) {
                                                        if ($wtr_list[0]['mwtr_signed_status_inspection'] >= 5) {
                                                            if (isset($wtr_list[0]["mwtr_signed_client_approval_by"])) {
                                                                $client_sign_by = $wtr_list[0]["mwtr_signed_client_approval_by"];
                                                            }
                                                        }
                                                    } else {
                                                        $client_sign_by = $show_pcms_irn[0]['client_approval_by'];
                                                    }
                                                    ?>
                                                    <?php if ($show_pcms_irn[0]['project'] == 17) : ?>
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
                                                                width: 250px !important;
                                                            }
                                                        </style>
                                                        <div style="text-align: left !important;">
                                                            <center>
                                                                <div style="page-break-inside: avoid;">
                                                                    <div class="box color_stamp border_stamp box_stamp">
                                                                        <center>
                                                                            <img src="<?= base_url('img/orsted_stamp.png') ?>" style="width:35px">
                                                                            <br>
                                                                            <strong>CHW 2204 OSS Project</strong>
                                                                        </center>
                                                                        <table cellpadding="0" border="0" style="width:100%; border-collapse: collapse !important; all: unset !important;">
                                                                            <tr>
                                                                                <td width="40%" class="valign_middle">Review</td>
                                                                                <td><input type="checkbox" style="margin-bottom: 8px !important"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="40%" class="valign_middle">Witness</td>
                                                                                <td><input type="checkbox" style="margin-bottom: 8px !important"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="40%" class="valign_middle">Inspect</td>
                                                                                <td><input type="checkbox" style="margin-bottom: 8px !important" checked></td>
                                                                            </tr>
                                                                        </table>
                                                                        <br>
                                                                        <?php if (isset($for_mwtr_signed)) { ?>
                                                                            <?php if ($wtr_list[0]['mwtr_signed_status_inspection'] >= 5) { ?>
                                                                                <?php if (isset($wtr_list[0]["mwtr_signed_client_approval_by"])) { ?>
                                                                                    <?php $client_sign_by = $wtr_list[0]["mwtr_signed_client_approval_by"]; ?>
                                                                                    Date : <?= (isset($wtr_list[0]['mwtr_signed_client_approval_by']) ? date("Y-m-d", strtotime($wtr_list[0]['mwtr_signed_client_approval_date'])) : '') ?>
                                                                                <?php } ?>
                                                                            <?php } ?>
                                                                        <?php } else { ?>
                                                                            <?php $client_sign_by = $show_pcms_irn[0]['client_approval_by']; ?>
                                                                            Date : <?= isset($show_pcms_irn[0]['client_approval_by']) && in_array($show_pcms_irn[0]["status_inspection"], $array_approval) ? date("Y-m-d", strtotime($show_pcms_irn[0]['client_approval_date'])) : ''; ?>
                                                                        <?php } ?>
                                                                        <!-- Date : <?= $show_pcms_irn[0]['client_approval_date'] ? date('Y-m-d', strtotime($show_pcms_irn[0]['client_approval_date'])) : space(15) ?> -->
                                                                        &nbsp;
                                                                        <span style="z-index: 99 !important;">Signature :</span>

                                                                    </div>
                                                                    <div class="text-right" style="padding-right: 5px !important; padding-bottom:3px !important;">
                                                                        <?php if (isset($user[$client_sign_by]['sign_approval'])) { ?>
                                                                            <img src="data:image/png;base64, <?= $user[$client_sign_by]['sign_approval'] ?>" style='width: 3cm !important; height: 2.8cm !important; position: absolute !important; margin-left: 20px !important; margin-top: -107px !important; z-index: -99 !important;' />
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                            </center>
                                                        </div>
                                                    <?php else : ?>
                                                        <?php if (isset($user[$client_sign_by]['sign_approval'])) { ?>
                                                            <img src="data:image/png;base64,<?= $user[$client_sign_by]['sign_approval'] ?>" style="width: 100px">
                                                        <?php } ?>
                                                    <?php endif; ?>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <?php if (isset($show_pcms_irn[0]["client_approval_by"]) && in_array($show_pcms_irn[0]["status_inspection"], $array_approval)) { ?>
                                                <!-- <img  style="width:100px;" src="data:image/png;base64, <?= (isset($show_pcms_irn[0]["client_approval_by"]) ? $sign_approval[$show_pcms_irn[0]["client_approval_by"]] : "-") ?>"> -->
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
                                                        width: 250px !important;
                                                    }
                                                </style>
                                                <div style="text-align: left !important;">
                                                    <center>
                                                        <div style="page-break-inside: avoid;">
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
                                                                <?php if (isset($for_mwtr_signed)) { ?>
                                                                    <?php if ($wtr_list[0]['mwtr_signed_status_inspection'] >= 5) { ?>
                                                                        <?php if (isset($wtr_list[0]["mwtr_signed_client_approval_by"])) { ?>
                                                                            <?php $client_sign_by = $wtr_list[0]["mwtr_signed_client_approval_by"]; ?>
                                                                            Date : <?= (isset($wtr_list[0]['mwtr_signed_client_approval_by']) ? date("Y-m-d", strtotime($wtr_list[0]['mwtr_signed_client_approval_date'])) : '') ?>
                                                                        <?php } ?>
                                                                    <?php } ?>
                                                                <?php } else { ?>
                                                                    <?php $client_sign_by = $show_pcms_irn[0]['client_approval_by']; ?>
                                                                    Date : <?= isset($show_pcms_irn[0]['client_approval_by']) && in_array($show_pcms_irn[0]["status_inspection"], $array_approval) ? date("Y-m-d", strtotime($show_pcms_irn[0]['client_approval_date'])) : ''; ?>
                                                                <?php } ?>
                                                                <!-- Date : <?= $show_pcms_irn[0]['client_approval_date'] ? date('Y-m-d', strtotime($show_pcms_irn[0]['client_approval_date'])) : space(15) ?> -->
                                                                &nbsp;
                                                                <span style="z-index: 99 !important;">Signature :</span>

                                                            </div>
                                                            <div class="text-right" style="padding-right: 5px !important; padding-bottom:3px !important;">
                                                                <?php if (isset($user[$client_sign_by]['sign_approval'])) { ?>
                                                                    <img src="data:image/png;base64, <?= $user[$client_sign_by]['sign_approval'] ?>" style='width: 3cm !important; height: 2.8cm !important; position: absolute !important; margin-left: 20px !important; margin-top: -107px !important; z-index: -99 !important;' />
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </center>
                                                </div>
                                            <?php } else { ?>
                                                <?php if (isset($user[$client_sign_by]['sign_approval'])) { ?>
                                                    <img src="data:image/png;base64,<?= $user[$client_sign_by]['sign_approval'] ?>" style="width: 100px">
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                </td>

                                <td style="width: 25%; border: none;"></td>
                                <td style="width: 25%; border: none;"></td>
                            </tr>
                            <tr>
                                <td style="width: 25%; border: none;"></td>
                                <td style="width: 25%; border: none;"></td>
                                <td style="width: 25%; border: none;"></td>
                                <td style="width: 25%; border: none;"></td>
                                <td style="width: 25%; border: none;"></td>
                            </tr>
                            <tr>
                                <td style="width: 25%; border: none;">
                                    <?php if (isset($for_mwtr_signed)) { ?>
                                        <?php if ($wtr_list[0]['mwtr_signed_status_inspection'] == "1") { ?>

                                            <?php if ($this->permission_cookie[63] == 1 || $this->permission_cookie[0] == 1) { ?>

                                                <a href="<?= base_url() ?>wtr/update_status_approval/<?= strtr($this->encryption->encrypt($value["mwtr_signed_uniq_id"]), '+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt($value["mwtr_signed_submission_id"]), '+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt(3), '+=/', '.-~') ?>" class="buttonxx button5xx" onclick="confirm('Are you sure?')">Digital Sign</a>

                                            <?php } ?>

                                        <?php } else if ($wtr_list[0]['mwtr_signed_status_inspection'] >= 3) { ?>
                                            <?= (isset($wtr_list[0]['mwtr_signed_smoe_approval_by']) ? $user_list[$wtr_list[0]['mwtr_signed_smoe_approval_by']] : '') ?>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <?php if (isset($show_pcms_irn[0]["smoe_approval_by"])) { ?>
                                            <?= (isset($show_pcms_irn[0]['smoe_approval_by']) ? $user_list[$show_pcms_irn[0]['smoe_approval_by']] : '') ?>
                                        <?php } ?>
                                    <?php } ?>
                                    <br>
                                    <b>______________</b>
                                </td>
                                <td style="width: 25%; border: none;"><b></b>
                                </td>
                                <td style="width: 25%; border: none;">
                                    <center>
                                        <?php if (isset($for_mwtr_signed)) { ?>
                                            <?php if ($wtr_list[0]['mwtr_signed_status_inspection'] == "5") { ?>

                                                <?php if ($this->user_cookie[7] == 8 || $this->permission_cookie[0] == 1) { ?>
                                                    <style type="text/css">
                                                        .disabled-style {
                                                            pointer-events: none;
                                                            cursor: default;
                                                            background-color: dimgrey;
                                                            color: linen;
                                                            opacity: 1;
                                                        }

                                                        .d-none {
                                                            display: none;
                                                        }
                                                    </style>
                                                    <?php
                                                    $acc = strtr($this->encryption->encrypt(7), '+=/', '.-~');
                                                    $acc_witch_comment = strtr($this->encryption->encrypt(9), '+=/', '.-~');
                                                    $reoffer = strtr($this->encryption->encrypt(11), '+=/', '.-~');

                                                    $uniq_id = strtr($this->encryption->encrypt($value["mwtr_signed_uniq_id"]), '+=/', '.-~');
                                                    $submission_id = strtr($this->encryption->encrypt($value["mwtr_signed_submission_id"]), '+=/', '.-~');
                                                    ?>
                                                    <form method="POST" action="<?= base_url() ?>wtr/update_status_approval_v2/">
                                                        <input type="hidden" name="uniq_id" value="<?= $uniq_id ?>">
                                                        <input type="hidden" name="submission_id" value="<?= $submission_id ?>">
                                                        <select name="status_inspection_client" onchange="changeLink(this)">
                                                            <option value="">---</option>
                                                            <option value="7">Accepted</option>
                                                            <option value="9">Accepted & Released with Comment</option>
                                                            <option value="11">Re-Offer</option>
                                                        </select>
                                                        <script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery/jquery-3.4.1.min.js"></script>
                                                        <script type="text/javascript">
                                                            function changeLink(ini) {
                                                                var status = $(ini).val()
                                                                if (status != '') {
                                                                    $('.submit').removeClass('d-none')
                                                                    if (status == 9 || status == 11) {
                                                                        $('.client_remarks').removeClass('d-none')
                                                                    } else {
                                                                        $('.client_remarks').addClass('d-none')
                                                                    }
                                                                } else {
                                                                    $('.submit').addClass('d-none')
                                                                }
                                                            }
                                                        </script>
                                                        <textarea name="client_remarks" class="client_remarks d-none" rows="4" cols="50"></textarea>
                                                        <button type="submit" class="buttonxx button5xx d-none submit" onclick="confirm('Are you sure?')">Digital Sign</button>
                                                    </form>

                                                <?php } ?>

                                            <?php } else if ($wtr_list[0]['mwtr_signed_status_inspection'] >= 5) { ?>
                                                <?= (isset($wtr_list[0]['mwtr_signed_client_approval_by']) ? $user_list[$wtr_list[0]['mwtr_signed_client_approval_by']] : '') ?>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <?php if (isset($show_pcms_irn[0]["client_approval_by"]) && in_array($show_pcms_irn[0]["status_inspection"], $array_approval)) { ?>
                                                <?= isset($user_list[$show_pcms_irn[0]['client_approval_by']]) ? $user_list[$show_pcms_irn[0]['client_approval_by']] : null ?>
                                            <?php } ?>
                                        <?php } ?>
                                        <br>
                                        <b>______________</b>
                                    </center>
                                </td>
                                <td style="width: 25%; border: none;"><b></b>
                                </td>
                                <td style="width: 25%; border: none;">
                                    <br>
                                    <b>______________</b>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%; border: none; padding-top: 10px;"><b>CONTRACTOR</b></td>
                                <td style="width: 25%; border: none; padding-top: 10px;"><b></b></td>
                                <td style="width: 25%; border: none; padding-top: 10px;">
                                    <center><b>EMPLOYER</b></center>
                                </td>
                                <td style="width: 25%; border: none; padding-top: 10px;"><b></b></td>
                                <td style="width: 25%; border: none; padding-top: 10px;"><b>THIRD PARTY <i>( If Any )</i></b></td>
                            </tr>
                            <tr>
                                <td style="width: 25%; border: none;">
                                    <?php if (isset($for_mwtr_signed)) { ?>
                                        <?php if ($wtr_list[0]['mwtr_signed_status_inspection'] >= 3) { ?>
                                            <?php if (isset($wtr_list[0]["mwtr_signed_smoe_approval_by"])) { ?>
                                                DATE : <?= (isset($wtr_list[0]['mwtr_signed_smoe_approval_by']) ? date("d M Y", strtotime($wtr_list[0]['mwtr_signed_smoe_approval_date'])) : '') ?>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } else { ?>
                                        DATE : <?= (isset($show_pcms_irn[0]['smoe_approval_date']) ? date("d M Y", strtotime($show_pcms_irn[0]['smoe_approval_date'])) : '') ?>
                                    <?php } ?>
                                </td>
                                <td style="width: 25%; border: none;"></td>
                                <td style="width: 25%; border: none;">
                                    <center>
                                        <?php if (isset($for_mwtr_signed)) { ?>
                                            <?php if ($wtr_list[0]['mwtr_signed_status_inspection'] >= 5) { ?>
                                                <?php if (isset($wtr_list[0]["mwtr_signed_client_approval_by"])) { ?>
                                                    DATE : <?= (isset($wtr_list[0]['mwtr_signed_client_approval_by']) ? date("d M Y", strtotime($wtr_list[0]['mwtr_signed_client_approval_date'])) : '') ?>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } else { ?>
                                            DATE : <?= isset($show_pcms_irn[0]['client_approval_by']) && in_array($show_pcms_irn[0]["status_inspection"], $array_approval) ? date("d M Y", strtotime($show_pcms_irn[0]['client_approval_date'])) : ''; ?>
                                        <?php } ?>
                                    </center>
                                </td>
                                <td style="width: 25%; border: none;"></td>
                                <td style="width: 25%; border: none;">DATE : </td>
                            </tr>
                        </table>
                    <?php } else { // is wtr 
                    ?>
                        <table class="table-body" width="100%" style="text-align: left; border-collapse: collapse !important;">
                            <tr>
                                <td style="width: 25%; border: none;"></td>
                                <td style="width: 25%; border: none;"></td>
                                <td style="width: 25%; border: none;"></td>
                                <td style="width: 25%; border: none;"></td>
                                <td style="width: 25%; border: none;"></td>
                            </tr>
                            <tr>
                                <td style="width: 25%; border: none;">
                                </td>
                                <td style="width: 25%; border: none;"></td>
                                <td style="width: 25%; border: none;">
                                </td>
                                <td style="width: 25%; border: none;"></td>
                                <td style="width: 25%; border: none;"></td>
                            </tr>
                            <tr>
                                <td style="width: 25%; border: none;"></td>
                                <td style="width: 25%; border: none;"></td>
                                <td style="width: 25%; border: none;"></td>
                                <td style="width: 25%; border: none;"></td>
                                <td style="width: 25%; border: none;"></td>
                            </tr>
                            <tr>
                                <td style="width: 25%; border: none;">
                                    <br>
                                    <b>______________</b>
                                </td>
                                <td style="width: 25%; border: none;"><b></b>
                                </td>
                                <td style="width: 25%; border: none;">
                                    <br>
                                    <b>______________</b>
                                </td>
                                <td style="width: 25%; border: none;"><b></b>
                                </td>
                                <td style="width: 25%; border: none;">
                                    <br>
                                    <b>______________</b>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%; border: none; padding-top: 10px;"><b>CONTRACTOR</b></td>
                                <td style="width: 25%; border: none; padding-top: 10px;"><b></b></td>
                                <td style="width: 25%; border: none; padding-top: 10px;"><b>EMPLOYER</b></td>
                                <td style="width: 25%; border: none; padding-top: 10px;"><b></b></td>
                                <td style="width: 25%; border: none; padding-top: 10px;"><b>THIRD PARTY <i>( If Any )</i></b></td>
                            </tr>
                            <tr>
                                <td style="width: 25%; border: none;">
                                    DATE :
                                </td>
                                <td style="width: 25%; border: none;"></td>
                                <td style="width: 25%; border: none;">
                                    DATE :
                                </td>
                                <td style="width: 25%; border: none;"></td>
                                <td style="width: 25%; border: none;">DATE : </td>
                            </tr>
                        </table>
                    <?php } ?>
                </td>
            </tr>
        </table>
        <?php if ($no != $no_max) { ?>
            <div class="page_break"></div>
        <?php } ?>

    <?php $no++;
    } ?>
</body>

</html>