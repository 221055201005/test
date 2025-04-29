<!DOCTYPE html>
<html>

<head>
    <?php error_reporting(0); ?>
    <?php $pending = "<label><input type='checkbox' style='margin-top: 0 cm; margin-bottom: 0 cm;'> PASS</label> <BR/> <label><input type='checkbox' style='margin-top: 0 cm; margin-bottom: 0 cm;'> REJECT</label>"; ?>
    <?php
    $reno = $renox;

    $document_approval_date = MAX(array_column($visual_report, 'document_approval_date'));

    foreach ($visual_report as $keyg => $valueg) {
        if ($valueg['inspection_datetime'] != '') {
            $inspection_datetime_arr[] = $valueg['inspection_datetime'];
        }
    }

    $inspection_date = MIN($inspection_datetime_arr);

    $ticked_report_date = MAX(array_column($visual_report, 'ticked_report_date'));

    if ($ticked_report_date == 1) {
        $show_date = $document_approval_date;
    } else {
        $show_date = $inspection_date;
    }

    $legend_inspection          = explode(";", $visual_report[0]['legend_inspection_auth']);
    // test_var($legend_inspection);
    if ((in_array(1, $legend_inspection)) == 1) {
        $checked_type             = "hold";
    } elseif ((in_array(2, $legend_inspection)) == 1) {
        $checked_type             = "witness";
    } elseif ((in_array(3, $legend_inspection)) == 1 || (in_array(4, $legend_inspection)) == 1) {
        $checked_type             = "review";
    }
    // test_var($checked_type);

    ?>
    <title><?= $access == 'client' ? $reno : $visual_report[0]['submission_id'] ?></title>
    <style type="text/css">
        <?php error_reporting(0) ?>f @page {
            margin: 0cm 0cm;
        }

        body {
            top: 0cm;
            left: 0cm;
            right: 0cm;
            margin-top: 6.1cm;
            margin-left: 0.25cm;
            margin-right: 0.25cm;
            margin-bottom: 1cm;
            font-family: "helvetica";
            font-size: 50% !important;
        }

        header {
            position: fixed;
            /*top: 2cm;*/
            left: 0cm;
            right: 0cm;
            height: 5cm;
            padding-top: 9.5px;
            padding-bottom: 15px !important;
            margin-top: 0.5cm;
            margin-left: 0.25cm;
            margin-right: 0.25cm;

        }

        footer {
            position: fixed;
            top: 18cm;
            left: 0cm;
            right: 0cm;
            height: 5cm;
            padding-top: 15px;
            /*padding-left: 1.4cm;
      padding-right: 1.5cm;*/
            margin-left: 0.5cm;
            margin-right: 0.5cm;

        }

        .titleHead {
            border: 1px #000 solid;
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
            border-right: 1px #000 solid;
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
            word-wrap: break-word;
        }

        .tab {
            display: inline-block;
            width: 60px;
        }

        .tab2 {
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
            margin: 0;
            vertical-align: bottom;
            position: relative;
            top: 0px;
            *overflow: hidden;
        }
    </style>
</head>

<body>
    <header>
        <table width="100%" border="1px" style="border-collapse: collapse !important;">
            <tr>
                <td width="15%;" style="padding: 10px; border-right: 0px !important;">
                    <center>
                        <img src="img/seatrium_logo_bg_white.png" style='width: 160px; height: 50px;' />
                    </center>
                </td>
                <td style="padding: 10px; border-right: 0px !important; border-left: 0px !important;">
                    <center>
                        <b style="font-weight: bold; font-size: 20 !important; vertical-align: middle !important;">
                            <?php echo $master_project[$visual_report[0]['project']]['description'] ?>
                        </b>
                    </center>
                </td>
                <td width="15%;" style="padding: 10px; border-left: 0px !important;">
                    <center>
                        <img src="<?php echo $master_project[$visual_report[0]['project']]['client_logo']; ?>" style='width: 160px; height: 50px;' />
                    </center>
                </td>

            </tr>
        </table>
        </br>
        <table width="100%" border="1px" style="border-collapse: collapse !important;">

            <head>
                <tr>
                    <td><b class="tab">COMPANY</b>: <?= $master_project[$visual_report[0]['project']]['client'] ?></td>
                    <td><b class="tab2">
                            <?= $access == 'client' ? 'REPORT NO.' : 'SUBMISSION ID.' ?>
                        </b>: <?= $access == 'client' ? strtoupper($reno) . ($visual_report[0]['postpone_reoffer_no'] > 0 ? ' Rev. ' . str_pad($visual_report[0]['postpone_reoffer_no'], 1, 0, STR_PAD_LEFT) : '') : $visual_report[0]['submission_id'] ?></td>
                </tr>
                <tr>
                    <td><b class="tab">PROJECT</b>: <?= strtoupper($master_project[$visual_report[0]['project']]['description']) ?></td>
                    <td><b class="tab2">DATE OF INSPECTION</b>: <?php echo $inspection_date == '' || $inspection_date < '2020-01-01' ? '' : date("d F Y", strtotime($inspection_date)) ?></td>
                    <!-- <td><b class="tab2">DATE</b>: <?php if ($visual_report[0]['status_inspection'] <= 3) {
                                                            echo date("d F Y", strtotime($visual_report[0]['date_request']));
                                                        } else {
                                                            echo date("d F Y", strtotime($show_date));
                                                        }; ?></td> -->

                </tr>
                <tr>
                    <td><b class="tab">MODULE</b>: <?= $master_module[$visual_report[0]['module']]['mod_desc'] ?></td>
                    <td><b class="tab2">DRAWING NO.</b>: <?= $visual_report[0]['drawing_no'] . ' Rev. ' . ($visual_report[0]['transmit_gaas_rev'] != '' ? $visual_report[0]['transmit_gaas_rev'] : $visual_report[0]['rev_ga_template']) . ($master_drawing[$visual_report[0]['drawing_no']]['client_doc_no'] > 0 ? ' (' . $master_drawing[$visual_report[0]['drawing_no']]['client_doc_no'] . ')' : '') ?></td>
                </tr>
                <tr>
                    <td><b class="tab">CONTRACTOR</b>: <?= $visual_report[0]['project'] == 21 ? 'SEATRIUM' : 'PT.SMOE' ?></td>
                    <td><b class="tab2">DESCRIPTION</b>: <?= $master_drawing[$visual_report[0]['drawing_no']]['title'] ?></td>
                </tr>
                <tr>
                    <td colspan="2" class="bb bx" width="100%">
                        <center><b>VISUAL INSPECTION REPORT - <?= strtoupper($master_discipline[$visual_report[0]['discipline']]['discipline_name']) ?></b></center>
                    </td>
                </tr>
                <tr>
                    <td colspan="1" class="bb bx" width="100%" style="border-right: 0px !important">
                        <left><b>DOCUMENT / SPECIFICATION / PROCEDURE No. / REFER to :
                                <?php
                                //                 if (in_array(1, explode(';', $visual_report[0]['legend_inspection_auth'])) || in_array(2, explode(';', $visual_report[0]['legend_inspection_auth']))) {
                                //                     echo "
                                // </br>&nbsp;&nbsp;&nbsp;&nbsp;• 07555701 (B) - E.80 Fabrication and Construction
                                // 				</br>&nbsp;&nbsp;&nbsp;&nbsp;• 08307791 - Inspection Test Procedure - " . ($master_discipline[$visual_report[0]['discipline']]['discipline_name']) . "
                                // 				</br>&nbsp;&nbsp;&nbsp;&nbsp;• 08308559 - In-process Inspection procedure
                                // 			";
                                //                 } else {
                                //                     echo "
                                // </br>&nbsp;&nbsp;&nbsp;&nbsp;• 07555701 (B) - E.80 Fabrication and Construction
                                // 				</br>&nbsp;&nbsp;&nbsp;&nbsp;• 08307791 - Inspection Test Procedure - " . ($master_discipline[$visual_report[0]['discipline']]['discipline_name']) . "
                                // 				</br>&nbsp;&nbsp;&nbsp;&nbsp;• 08308559 - In-process Inspection procedure
                                // 			";
                                //                 }

                                echo $master_acceptance[$visual_report[0]['project']][$visual_report[0]['company_id']][$visual_report[0]['discipline']][$visual_report[0]['module']][$visual_report[0]['type_of_module']][$visual_report[0]['class']]['visual']['procedure'];

                                ?>
                            </b></left>
                    </td>
                    <td colspan="1" class="bb bx" width="100%" style="border-right: 0px !important">
                        <left><b>Acceptance Criteria :
                                <?php
                                //                 if (in_array(1, explode(';', $visual_report[0]['legend_inspection_auth'])) || in_array(2, explode(';', $visual_report[0]['legend_inspection_auth']))) {
                                //                     echo "
                                // </br>&nbsp;&nbsp;&nbsp;&nbsp;• DNVGL-OS-C401
                                // 				</br>&nbsp;&nbsp;&nbsp;&nbsp;• DNVGL-CG-0051 Sec. 1.5
                                // 				</br>&nbsp;&nbsp;&nbsp;&nbsp;• EN ISO 5817 Level B
                                // 			";
                                //                 } else {
                                //                     echo "
                                // </br>&nbsp;&nbsp;&nbsp;&nbsp;• DNVGL-OS-C401
                                // 				</br>&nbsp;&nbsp;&nbsp;&nbsp;• DNVGL-CG-0051 Sec. 1.5
                                // 				</br>&nbsp;&nbsp;&nbsp;&nbsp;• EN ISO 5817 Level B
                                // 			";
                                //                 }

                                echo $master_acceptance[$visual_report[0]['project']][$visual_report[0]['company_id']][$visual_report[0]['discipline']][$visual_report[0]['module']][$visual_report[0]['type_of_module']][$visual_report[0]['class']]['visual']['acceptance_criteria'];
                                ?>
                            </b></left>
                    </td>
                </tr>
            </head>
        </table>
    </header>
    <footer>
        SEA-QCF-VIR-001
    </footer>
    <!-- <br> -->
    <br>
    <table width="100%" border="0" style="text-align: left;border-collapse: collapse !important;">
        <thead>
            <tr>
                <td rowspan="2" class="ball" style="vertical-align: middle; width: 20px">
                    <center><b>S/N</b></center>
                </td>
                <td rowspan="2" class="ball" style="vertical-align: middle; width: 170px">
                    <center><b>Weld Map Drawing No. / Line & Spool No</b></center>
                </td>
                <td rowspan="2" class="ball" style="vertical-align: middle; width: 40px">
                    <center><b>Item No./<br />Joint No</b></center>
                </td>
                <td rowspan="2" class="ball" style="vertical-align: middle; width: 30px">
                    <center><b>Class</b></center>
                </td>
                <td rowspan="2" class="ball" style="vertical-align: middle; width: 30px">
                    <center><b>Type<br />Of<br />Weld</b></center>
                </td>
                <td rowspan="2" class="ball" style="vertical-align: middle;">
                    <center><b>WPS</b></center>
                </td>
                <td rowspan="2" class="ball" style="vertical-align: middle; width: 40px">
                    <center><b>Cons/Lot No.</b></center>
                </td>
                <td colspan="2" class="ball" style="vertical-align: middle;">
                    <center><b>Weld Process</b></center>
                </td>
                <td colspan="2" class="ball" style="vertical-align: middle;">
                    <center><b>Welder ID</b></center>
                </td>
                <td rowspan="2" class="ball" style="vertical-align: middle; width: 20px">
                    <center><b>SIZE / <br>DIA</b></center>
                </td>

                <td rowspan="2" class="ball" style="vertical-align: middle; width: 20px">
                    <center><b>SCH</b></center>
                </td>

                <td rowspan="2" class="ball" style="vertical-align: middle; width: 20px">
                    <center><b>THK<br />(mm)</b></center>
                </td>
                <td rowspan="2" class="ball" style="vertical-align: middle; width: 40px">
                    <center><b>Weld Length<br />(mm)</b></center>
                </td>
                <td rowspan="2" class="ball" style="vertical-align: middle;">
                    <center><b>Weld Completion Date</b></center>
                </td>
                <td rowspan="2" class="ball" style="vertical-align: middle;">
                    <center><b>Inspection Result</b></center>
                </td>
                <td colspan="4" class="ball" style="vertical-align: middle; width: 100px">
                    <center><b>NDE Requirement</b></center>
                </td>
                <td rowspan="2" class="ball" style="vertical-align: middle;">
                    <center><b>Remarks</b></center>
                </td>
            </tr>
            <tr>

                <td class="ball" style="vertical-align: middle;">
                    <center><b>R/H</b></center>
                </td>
                <td class="ball" style="vertical-align: middle;">
                    <center><b>F/C</b></center>
                </td>
                <td class="ball" style="vertical-align: middle;">
                    <center><b>R/H</b></center>
                </td>
                <td class="ball" style="vertical-align: middle;">
                    <center><b>F/C</b></center>
                </td>
                <td class="ball" style="vertical-align: middle;">
                    <center><b>MT</b></center>
                </td>
                <td class="ball" style="vertical-align: middle;">
                    <center><b>PT</b></center>
                </td>
                <td class="ball" style="vertical-align: middle;">
                    <center><b>UT</b></center>
                </td>
                <td class="ball" style="vertical-align: middle;">
                    <center><b>RT</b></center>
                </td>
            </tr>
        </thead>
        <br>
        <br>
        <tbody>
            <?php
            $no = 1;
            $count_client_approve = 0;
            $count_qc_approve = 0;
            $count_all_Data = 0;
            foreach ($visual_report as $key => $value) {
                // test_var($value);
            ?>

                <?php

                if ($value['status_inspection'] == 7) {
                    $count_client_approve++;
                }
                if ($value['status_inspection'] >= 3) {
                    $count_qc_approve++;
                }
                if ($value['status_inspection'] == 6) {
                    $count_client_reject++;
                }
                $count_all_Data++;

                ?>
                <tr>
                    <td class="ball" style="vertical-align: middle; text-align: center"><?= $no ?></td>
                    <td class="ball" style="vertical-align: middle; text-align: center"><?= $value['drawing_wm'] . ' Rev. ' . ($value['transmit_wm_rev'] != '' ? $value['transmit_wm_rev'] : $value['rev_wm_template']) . ($master_drawing_wm[$value['drawing_wm']]['client_doc_no'] > 0 ? ' (' . $master_drawing_wm[$value['drawing_wm']]['client_doc_no'] . ')' : '') . '<br>' . (!empty($value['spool_no']) ? 'Spool No : ' . $value['spool_no'] : '') ?></td>

                    <td class="ball" style="vertical-align: middle; text-align: center"><?= $value['joint_no'] . ($value['revision'] > 0 ? '(' . $value['revision_category'] . $value['revision'] . ')' : '') ?></td>

                    <td class="ball" style="vertical-align: middle; text-align: center"><?= $master_class[$value['class']]['class_code'] ? $master_class[$value['class']]['class_code'] : "-" ?></td>

                    <td class="ball" style="vertical-align: middle; text-align: center"><?= $master_weld_type[$value['weld_type']]['weld_type_code'] ? $master_weld_type[$value['weld_type']]['weld_type_code'] : "-" ?></td>

                    <?php
                    $wps_rh = explode(';', $value['wps_no_rh']);
                    $wps_fc = explode(';', $value['wps_no_fc']);
                    $wps = array_unique(array_merge($wps_rh, $wps_fc));
                    ?>
                    <td class="ball" style="vertical-align: middle; text-align: center">
                        <?php
                        foreach ($wps as $key => $valuec) {
                            if ($master_wps[$valuec]) {
                                $wps_merge[] = $master_wps[$valuec]['wps_no'];
                            }
                        }
                        echo $wps_merge ? implode(',<br>', $wps_merge) : "-";
                        unset($wps_merge);
                        ?>
                    </td>

                    <td class="ball" style="vertical-align: middle; text-align: center"><?= $value['cons_lot_no'] ? $value['cons_lot_no'] : -"-" ?></td>

                    <td class="ball" style="vertical-align: middle; text-align: center">
                        <?php if ($value['weld_type'] != 15) { ?>
                            <?php
                            // $wps_no_rh = array_filter(array_unique(explode(';', $value['wps_no_rh'])));
                            // foreach ($wps_no_rh as $key_wps_no_rh => $value_wps_no_rh) {
                            //   foreach ($wps_detail[$value_wps_no_rh] as $key_rh => $value_rh) {
                            //     $arr_weld_process_rh[] = $weld_process[$value_rh['id_weld_process']];
                            //   }
                            // }
                            // echo implode("<br>", array_unique($arr_weld_process_rh));
                            echo $value["weld_process_rh"] ? str_replace(";", "<br>", $value["weld_process_rh"]) : "-";
                            ?>
                        <?php } else {
                            echo "-";
                        } ?>
                    </td>

                    <td class="ball" style="vertical-align: middle; text-align: center">
                        <?php
                        // $wps_no_fc = array_filter(array_unique(explode(';', $value['wps_no_fc'])));
                        // foreach ($wps_no_fc as $key_wps_no_fc => $value_wps_no_fc) {
                        //   foreach ($wps_detail[$value_wps_no_fc] as $key_fc => $value_fc) {
                        //     $arr_weld_process_fc[] = $weld_process[$value_fc['id_weld_process']];
                        //   }
                        // }
                        // echo implode("<br>", array_unique($arr_weld_process_fc));
                        echo $value["weld_process_fc"] ? str_replace(";", "<br>", $value["weld_process_fc"]) : "-";
                        ?>
                    </td>

                    <?php
                    $welder_rh = array_filter(array_unique(array_column($visual_detail[$value['id_visual']][0], 'id_welder')));
                    $welder_fc = array_filter(array_unique(array_column($visual_detail[$value['id_visual']][1], 'id_welder')));

                    // test_var($welder_rh);
                    ?>
                    <td class="ball" style="vertical-align: middle; text-align: center">
                        <?php foreach ($welder_rh as $values) {
                            if ($master_welder[$values]) {
                                $welder_rh_merge[] = $master_welder[$values]['welder_code'];
                            }
                        }
                        echo $welder_rh_merge ? implode(',<br>', $welder_rh_merge) : "-";
                        unset($welder_rh_merge);
                        ?>
                    </td>

                    <td class="ball" style="vertical-align: middle; text-align: center">
                        <?php foreach ($welder_fc as $values) {
                            if ($master_welder[$values]) {
                                $welder_fc_merge[] = $master_welder[$values]['welder_code'];
                            }
                            // echo $master_welder[$values]['welder_code'].(count($welder_fc)>1 ? ',<br>' : '');
                        }
                        echo $welder_fc_merge ? implode(',<br>', $welder_fc_merge) : "-";
                        unset($welder_fc_merge);
                        ?>
                    </td>

                    <td class="ball" style="vertical-align: middle; text-align: center"><?= $value['diameter'] ? $value['diameter'] : "-" ?></td>
                    <td class="ball" style="vertical-align: middle; text-align: center"><?= $value['sch'] ? $value['sch'] : "-" ?></td>
                    <td class="ball" style="vertical-align: middle; text-align: center"><?= $value['thickness'] ? $value['thickness'] : "-" ?></td>

                    <td class="ball" style="vertical-align: middle; text-align: center">

                        <?php if ($value['revision'] > 0) {
                            echo  $value['length_of_weld'] ? number_format($value['length_of_weld'], 2) : "-";
                        } else {
                            echo $value['weld_length'] ? number_format( $value['weld_length'], 2) : "-";
                        } ?>
                    </td>

                    <td class="ball" style="vertical-align: middle; text-align: center"><?= $value['weld_datetime'] ? DATE('d F, Y', strtotime($value['weld_datetime'])) : "-" ?></td>

                    <td class="ball" style="vertical-align: middle; text-align: center">
                        <?php
                        // print_r($access);
                        if ($access == 'clients' || $access == 'client') {
                            if ($value['status_inspection'] == 5) {
                                echo "ACC";
                            } elseif ($value['status_inspection'] == 6) {
                                echo "REJ";
                            } elseif ($value['status_inspection'] == 7) {
                                echo "ACC";
                            } elseif ($value['status_inspection'] == 9) {
                                echo "ACC";
                            } elseif ($value['status_inspection'] == 10) {
                                echo "POSTPONE";
                            } elseif ($value['status_inspection'] == 11) {
                                echo "RE-OFFER";
                            }
                        } else {
                            if ($value['status_inspection'] == 1) {
                                echo $pending;
                            } elseif ($value['status_inspection'] == 2) {
                                echo "REJ";
                            } elseif ($value['status_inspection'] == 3) {
                                echo "ACC";
                            } elseif ($value['status_inspection'] == 4) {
                                echo $pending;
                            } elseif ($value['status_inspection'] >= 5) {
                                echo "ACC";
                            } elseif ($value['status_inspection'] == 6) {
                                echo "REJ";
                            } elseif ($value['status_inspection'] == 7) {
                                echo "ACC";
                            }
                        }
                        ?>
                    </td>

                    <td class="ball" style="vertical-align: middle;">
                        <center>
                            <?php if ($value['mt_percent_req'] > 0) { ?>
                                <img src="data:image/png;base64,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" style='width: 5px;' />
                            <?php } else {
                                echo '-';
                            } ?>
                        </center>
                    </td>

                    <td class="ball" style="vertical-align: middle;">
                        <center>
                            <?php if ($value['pt_percent_req'] > 0) { ?>
                                <img src="data:image/png;base64,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" style='width: 5px;' />
                            <?php } else {
                                echo '-';
                            } ?>
                        </center>
                    </td>

                    <td class="ball" style="vertical-align: middle;">
                        <center>
                            <?php if ($value['ut_percent_req'] > 0) { ?>
                                <img src="data:image/png;base64,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" style='width: 5px;' />
                            <?php } else {
                                echo '-';
                            } ?>
                        </center>
                    </td>

                    <td class="ball" style="vertical-align: middle;">
                        <center>
                            <?php if ($value['rt_percent_req'] > 0) { ?>
                                <img src="data:image/png;base64,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" style='width: 5px;' />
                            <?php } else {
                                echo '-';
                            } ?>
                        </center>
                    </td>

                    <td class="ball" style="vertical-align: middle;">
                        <center><?= $value['status_inspection'] == 6 ? str_replace("<", "'<'", $value['client_remarks'])  : "-" ?></center>
                    </td>

                </tr>
            <?php $no++;
            } ?>

        </tbody>
    </table>

    <?php if ($visual_report[0]['project'] == 14) { ?>
        <br><br><br><br>
        <table border="1" style="border-collapse: collapse; width:300px !important">
            <tr>
                <td style="height: 70px !important">
                    <b>Note/Remarks:</b>
                    <br>
                    <br>
                    <?= $visual_report[0]['accepted_remarks'] ?>
                </td>
            </tr>
        </table>
    <?php } ?>

    <br><br><br><br><br>
    <!-- <table width="100%">
    <tr>
      <td colspan="20"> -->

    <?php $sisa_pending_client = $count_all_Data - $count_client_approve;  ?>
    <?php $sisa_reject_client = $count_all_Data - $count_client_reject;  ?>
    <?php $sisa_pending_qc = $count_all_Data - $count_qc_approve;  ?>

    <div style="page-break-inside: avoid !important;">
        <table class="table-body" width="100%" style="border-collapse: collapse !important; padding-top: -0.8px;">
            <tbody>
                <tr>
                    <?php if (($visual_report[0]['company_id'] == 5)) { ?>
                        <td style="width: 25%; border: none;"></td>
                        <td style="width: 25%; border: none;"></td>
                    <?php } ?>
                    <td style="width: 25%; border: none;"></td>
                    <td style="width: 25%; border: none;"></td>
                    <td style="width: 25%; border: none;"></td>
                    <td style="width: 25%; border: none;">
                        <?php if (count($visual_report[0]) and $visual_report[0]['status_inspection'] == 6) {
                            echo "<b>Rejected By :</b>";
                        } elseif (count($visual_report[0]) and $visual_report[0]['status_inspection'] == 7) {
                            if ($visual_report[0]['add_comment'] == 1) {
                                echo "<b>Approved By :</b>";
                            } elseif ($visual_report[0]['add_comment'] == 2) {
                                echo "<b>Witnessed By :</b>";
                            } elseif ($visual_report[0]['add_comment'] == 3) {
                                echo "<b>Reviewed By :</b>";
                            }
                        } ?>
                    </td>
                </tr>
                <tr>
                    <?php if (($visual_report[0]['company_id'] == 5)) { ?>
                        <td style="width: 25%; border: none;text-align: left;">
                            <img style="width: 3.5cm" src="data:image/png;base64, <?= $user_sign['requestor']['sign_approval'] ?>">
                        </td>
                        <td style="width: 25%; border: none;"></td>
                    <?php } ?>

                    <?php $arr_sign_contra = [3, 5, 6, 7, 8, 9, 10, 11] ?>
                    <td style="width: 25%; border: none;text-align: left;">
                        <?php if (in_array($visual_report[0]['status_inspection'], $arr_sign_contra)) { ?>
                            <img style="width: 3.5cm" src="data:image/png;base64, <?= $user_sign['inspector']['sign_approval'] ?>">
                        <?php } ?>
                    </td>
                    <td style="width: 25%; border: none;"></td>

                    <td style="width: 25%; border: none;"></td>
                    <td style="width: 25%; border: none;">
                        <?php // if($visual_report[0]['status_inspection']==7 AND ($access=='clients' || $access=='client')){ 
                        ?>
                        <!-- <img style="width: 3.5cm" src="data:image/png;base64, <?= $user_sign['client']['sign_approval'] ?>">  -->
                        <div style="page-break-inside: avoid;">
                            <?php if ($visual_report[0]['project_code'] == 17) : ?>
                                <style type="text/css">
                                    .color_stamp {
                                        color: rgba(63, 72, 204, 255);
                                    }

                                    .check_stamp {
                                        -ms-transform: scale(1.7) !important;
                                        -moz-transform: scale(1.7) !important;
                                        -webkit-transform: scale(1.7) !important;
                                        -o-transform: scale(1.7) !important;
                                        transform: scale(1.7) !important;
                                    }

                                    .border_stamp {
                                        border: 3px solid rgba(63, 72, 204, 255);
                                    }

                                    .box_stamp {
                                        padding: 4px;
                                        font-weight: bold;
                                        z-index: 99 !important;
                                        width: 140px;
                                    }
                                </style>
                                <div class="box color_stamp border_stamp box_stamp">
                                    <center>
                                        <img src="img/orsted_stamp.png" style="width:35px">
                                        <br>
                                        <strong>CHW 2204 OSS Project</strong>
                                    </center>
                                    <table cellpadding="0" style="width:100%;">
                                        <tr>
                                            <td width="40%" class="valign_middle">Review</td>
                                            <td><input type="checkbox" style="margin-bottom: 8px" <?= $checked_type == 'review' ? 'checked' : '' ?>></td>
                                        </tr>
                                        <tr>
                                            <td width="40%" class="valign_middle">Witness</td>
                                            <td><input type="checkbox" style="margin-bottom: 8px" <?= ($checked_type == 'hold' or $checked_type == 'witness') ? 'checked' : '' ?>></td>
                                        </tr>
                                        <tr>
                                            <td width="40%" class="valign_middle">Inspect</td>
                                            <td><input type="checkbox" style="margin-bottom: 8px" <?= $checked_type == 'hold' ? 'checked' : '' ?>></td>
                                        </tr>
                                    </table>
                                    <br>
                                    Date : <?= $visual_report[0]['inspection_client_datetime'] ? date('Y-m-d', strtotime($visual_report[0]['inspection_client_datetime'])) : space(15) ?>
                                    &nbsp;
                                    <span style="z-index: 99 !important;">Signature :</span>

                                </div>
                                <div class="text-right" style="padding-right: 5px; padding-bottom:3px;">
                                    <?php if (($visual_report[0]['status_inspection'] >= 5) && isset($visual_report[0]['inspection_client_by']) && ($access == 'clients' || $access == 'client')) { ?>
                                        <img src="data:image/png;base64, <?= $user_sign['client']['sign_approval'] ?>" style='width: 70px !important; position: absolute !important; margin-left: 70px !important; margin-top: -70px !important; z-index: -99 !important; 
/*		                  		border: 5px solid #555;*/
		                  	' />
                                    <?php } ?>
                                </div>
                            <?php else : ?>
                                <?php if (($visual_report[0]['status_inspection'] >= 5) && isset($visual_report[0]['inspection_client_by']) && ($access == 'clients' || $access == 'client')) { ?>
                                    <img src="data:image/png;base64,<?= $user_sign['client']['sign_approval'] ?>" style='width: 3.5cm;vertical-align: text-bottom !important;' />
                                <?php } ?>
                            <?php endif; ?>
                        </div>
                        <?php // } 
                        ?>
                    </td>
                    <td style="width: 25%; border: none;"></td>
                    <td style="width: 25%; border: none;"></td>
                    <td style="width: 25%; border: none;">
                        <?php if ($visual_report[0]['status_inspection'] == 7 and ($access == 'clients' || $access == 'client')) { ?>
                            <?php if ($visual_report[0]['third_party_approval_status'] == 1) : ?>
                                <img style="width: 3.5cm" src="data:image/png;base64, <?= $user_sign['3rd']['sign_approval'] ?>">
                            <?php endif; ?>

                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 25%; border: none;"></td>
                    <td style="width: 25%; border: none;"></td>
                    <td style="width: 25%; border: none;"></td>
                    <td style="width: 25%; border: none;"></td>
                    <td style="width: 25%; border: none;"></td>
                    <td style="width: 25%; border: none;"></td>
                    <td style="width: 25%; border: none;">
                        <?php if ($visual_report[0]['status_inspection'] == 7 and ($access == 'clients' || $access == 'client')) { ?>
                            <?php if ($visual_report[0]['third_party_approval_status'] == 1) : ?>
                                <?= $user_sign['3rd']['full_name'] ?>
                            <?php endif; ?>

                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <?php if (($visual_report[0]['company_id'] == 5)) { ?>
                        <td style="width: 25%; border: none;">
                            <?= $user_sign['requestor']['full_name'] ?>
                            <br>
                            <b>__________________________</b>
                        </td>
                        <td style="width: 25%; border: none;"></td>
                    <?php } ?>

                    <td style="width: 25%; border: none;text-align: left;">
                        <?php if (in_array($visual_report[0]['status_inspection'], $arr_sign_contra) and ($access == 'clients' || $access == 'client')) { ?>
                            <?= $user_sign['inspector']['full_name'] ?>
                        <?php } ?>
                        <br>
                        <b>__________________________</b>
                    </td>
                    <td style="width: 25%; border: none;"></td>

                    <td style="width: 25%; border: none;"></td>
                    <td style="width: 25%; border: none;">
                        <?php if (($visual_report[0]['status_inspection'] >= 5) && isset($visual_report[0]['inspection_client_by']) && ($access == 'clients' || $access == 'client')) { ?>
                            <?= $user_sign['client']['full_name'] ?>
                        <?php } ?>
                        <br>
                        <b>__________________________</b>
                    </td>

                    <td style="width: 25%; border: none;"></td>
                    <td style="width: 25%; border: none;">
                        <br>
                        <b>__________________________</b>
                    </td>

                </tr>
                <tr>
                    <?php if (($visual_report[0]['company_id'] == 5)) { ?>
                        <td style="width: 25%; border: none; padding-top: 10px;">
                            <b>DSAW</b>
                        </td>
                        <td style="width: 25%; border: none; padding-top: 10px;">
                            <b></b>
                        </td>
                    <?php } ?>
                    <td style="width: 25%; border: none; padding-top: 10px;text-align: left;">
                        <b>CONTRACTOR</b>
                    </td>
                    <td style="width: 25%; border: none; padding-top: 10px;">
                        <b></b>
                    </td>
                    <td style="width: 25%; border: none; padding-top: 10px;">
                        <b></b>
                    </td>
                    <td style="width: 25%; border: none; padding-top: 10px;">
                        <b>COMPANY</b>
                    </td>
                    <td style="width: 25%; border: none; padding-top: 10px;">
                        <b></b>
                    </td>
                    <!-- <td style="width: 25%; border: none;"></td> -->
                    <td style="width: 25%; border: none; padding-top: 10px;">
                        <b>THIRD PARTY</b>
                    </td>

                </tr>
                <tr>
                    <?php if (($visual_report[0]['company_id'] == 5)) { ?>
                        <td style="width: 25%; border: none;">
                            DATE : <?= $visual_report[0]['status_inspection'] ? DATE('d F, Y', strtotime($visual_report[0]['date_request'])) : '' ?>
                        </td>
                        <td style="width: 25%; border: none;"></td>
                    <?php } ?>
                    <td style="width: 25%; border: none;">
                        DATE : <?= in_array($visual_report[0]['status_inspection'], $arr_sign_contra) ? DATE("d F Y", strtotime($show_date)) : '' ?>
                    </td>
                    <td style="width: 25%; border: none;">
                    </td>

                    <td style="width: 25%; border: none;">
                    </td>
                    <td style="width: 25%; border: none;">
                        DATE : <?= $visual_report[0]['status_inspection'] >= 5 && isset($visual_report[0]['inspection_client_datetime']) ? DATE('d F Y', strtotime($visual_report[0]['inspection_client_datetime'])) : '' ?>
                    </td>
                    <!-- <td style="width: 25%; border: none;"></td> -->
                    <td style="width: 25%; border: none;">
                    </td>
                    <td style="width: 25%; border: none;">
                        DATE : <?= $visual_report[0]['status_inspection'] == 7 && $visual_report[0]['third_party_approval_date'] ? DATE('d F, Y', strtotime($visual_report[0]['third_party_approval_date'])) : '' ?>
                    </td>


                </tr>
            </tbody>
        </table>
    </div>
    <!-- </td>
    </tr>
  </table> -->
</body>

</html>