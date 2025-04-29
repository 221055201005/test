<?php 
$img_base64_encoded = $data_project[0]['client_logo'];
$imageContent       = file_get_contents($img_base64_encoded);
$path               = tempnam(sys_get_temp_dir(), 'prefix');
file_put_contents ($path, $imageContent);

?>
<!DOCTYPE html>
<html>

<head>
  <title>WTR</title>
  <style type="text/css">
  .wtr {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 5pt;
    border-collapse: collapse;
    width: 100%;
  }
  
  .wtr td,
  .wtr th {
    border: 0.10px solid #000000;
    word-wrap: break-word;
  }

  .wtr_title {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
    font-size: 9px !important;

  }

  .wtr_title td,
  .wtr_title th {
    word-wrap: break-word;

  }

  .wtrthe {
    font-family: Arial, Helvetica, sans-serif;
    font-weight: bold;
    vertical-align: middle !important;
    text-align: center;
    border: 0.10px solid #000000;
  }

  .table {
    word-wrap: break-word;
    border: 0.10px solid #000000;
    vertical-align: middle !important;
    text-align: center;
  }

  .table td,
  th {
    border: 0.08px solid #000000;
    /* vertical-align: middle !important; */
    
    text-align: center;

  }

  body {
    margin-top: 3cm;
    margin-left: 1cm;
    margin-right: 1cm;
    margin-bottom: 3cm;
    font-family: "helvetica";
    font-size: 38% !important;
  }
  </style>
</head>

<body>
    <table width='100%' border="">
      <tr>
        <td rowspan="2">
          <img src="<?php echo $path; ?>"  style="width: 70px !important;" />
        </td>
        <td style="text-align: center; font-weight: bold; font-size: 12pt; margin-bottom: 100pt">
          <?= strtoupper($data_project[0]['description']) ?></td>
        <td rowspan="2" style="text-align: right;">
          <img src="<?php echo base_url('img/sembcorp-logo.png'); ?>"
            style="width: 70px !important" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </td>
      </tr>
      <tr>
        <td style="text-align: center; font-weight: bold; font-size: 11pt">MATERIAL & WELDING TRACEABILITY RECORD -
          PIPING</td>
      </tr>
      <br>
      <br>
      <br>
      <tr style="font-size: 7px">
        <td style="width: 100px"><b>PROJECT NAME</b></td>
        <td style="width: 10px"><b>:</b></td>
        <td><b><?= $data_project[0]['project_name'] ?></b></td>
      </tr>
      <tr style="font-size: 7px">
        <td><b>CLIENT</b></td>
        <td><b>:</b></td>
        <td><b><?= strtoupper($data_project[0]['client']) ?></b></td>
      </tr>
    </table>

    <!-- EMPTY TABLE FOR SPACE -->
    <table>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
    </table>

    <table width='100%' cellspacing="0" cellpadding="1" class="table" style="width: 1135px">
    <thead>
      <tr class="wtrthe">
        <!-- Engineering Data Status -->
        <th rowspan="3" style="width: 37pt;">Drawing/Weld Map No</th>
        <th rowspan="3" style="width: 15pt">Rev No</th>
        <th rowspan="3" style="width: 20pt">Joint No</th>
        <th rowspan="3" style="width: 18pt">Type Of Weld</th>
        <th rowspan="3" style="width: 25pt">Spool No</th>
        <th rowspan="3">Size</th>
        <th rowspan="3">Thk (MM)</th>
        <!-- <th rowspan="3">Class</th> -->
        <th colspan="6">Material Traceability</th>
        <th colspan="2" rowspan="2">Fitup</th>
        <th rowspan="3">WPS No</th>
        <th colspan="2" rowspan="2">Welder ID</th>
        <th colspan="3" rowspan="2">Visual</th>

        <!-- <th colspan="3">Non</th> -->
        <th colspan="29">Non Destructive Examination</th>
        <th colspan="3">Destructive Test</th>
        <th rowspan="3">Remarks</th>
        <th rowspan="3">Test Pack Number</th>
      </tr>
      <tr class="wtrthe table">
        <th colspan="3">Part 1</th>
        <th colspan="3">Part 2</th>
        <th colspan="3">MPI</th>
        <th colspan="3">PT</th>
        <th colspan="3">UT</th>
        <th colspan="3">RT</th>
        <th colspan="3">PMI</th>
        <th colspan="14">PWHT</th>
        <th colspan="3">HER</th>
      </tr>
      <tr class="wtrthe">
        <th>Mtr No</th>
        <th>Grade /Spec</th>
        <th>Unique No</th>
        <th>Mtr No</th>
        <th>Grade /Spec</th>
        <th>Unique No</th>
        <th>Report</th>
        <th>Result</th>
        <th>R/H</th>
        <th>F/C</th>
        <th>Report</th>
        <th>Date</th>
        <th>Result</th>
        <th>Report</th>
        <th>Date</th>
        <th>Result</th>
        <th>Report</th>
        <th>Date</th>
        <th>Result</th>
        <th>Report</th>
        <th>Date</th>
        <th>Result</th>
        <th>Report</th>
        <th>Date</th>
        <th>Result</th>
        <th>Report</th>
        <th>Date</th>
        <th>Result</th>
        <th>YES</th>
        <th>NO</th>
        <th>PWHT</th>
        <th>Date</th>
        <th>Result</th>
        <th>MT APWHT</th>
        <th>Date</th>
        <th>Result</th>
        <th>RT APWHT</th>
        <th>Date</th>
        <th>Result</th>
        <th>UT APWHT</th>
        <th>Date</th>
        <th>Result</th>
        <th>Report</th>
        <th>Date</th>
        <th>Result</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($detail_wtr_data as $key => $value): ?> 
      <?php 
        if($value['status_inspection'] == 7) {
          $result_fitup							= "ACC";
        } elseif($value['status_inspection'] == 6) {
          $result_fitup							= "REJECT";
        } else {
          $result_fitup							= "N/A";
        }  

        $wps_fitup									= explode(';', $value['wps_no']);
				$wps_list_fitup							= [];
				foreach ($wps_fitup as $v) {
					$wps_list_fitup[]					= $wps[$v];
				}

        $welder_id_rh								= explode(';', $data_visual[$value['id_joint']]['welder_ref_rh']);
				$welder_id_rh_list					= [];
				foreach($welder_id_rh as $v) {
					$welder_id_rh_list[]		 	= $data_welder[$v];
				}

				$welder_id_fc								= explode(';', $data_visual[$value['id_joint']]['welder_ref_fc']);
				$welder_id_fc_list					= [];
				foreach($welder_id_fc as $v) {
					$welder_id_fc_list[]		 	= $data_welder[$v];
				}

        if($data_visual[$value['id_joint']]['inspection_datetime']) {
					$visual_date							= date('Y-m-d', strtotime($data_visual[$value['id_joint']]['inspection_datetime']));
				} else {
					$visual_date							= '';
				}

        if($data_visual[$value['id_joint']]['status_inspection'] == 7) {
					$result_visual						= "ACC";
				} elseif($$data_visual[$value['id_joint']]['status_inspection'] == 6) {
					$result_visual						= "REJECT";
				} else {
					$result_visual						= "N/A";
				}

        // RT NDT (PWHT OR NON PWHT)
				$report_rt_non_pwht	= $data_ndt['1'][$data_visual[$value['id_joint']]['id_visual']]['report_number'];
				$date_rt						=	$data_ndt['1'][$data_visual[$value['id_joint']]['id_visual']]['date_of_inspection'];

				if($date_rt) {
					$date_rt_non_pwht	= date('Y-m-d', strtotime($date_rt));
				} else {
					$date_rt_non_pwht	= '';
				}

				$result_rt_1				= $data_ndt['1'][$data_visual[$value['id_joint']]['id_visual']]['result'];
				if($result_rt_1 == 3) {
					$result_rt_non_pwht	= "ACC";
				} elseif($result_rt_1 == 2) {
					$result_rt_non_pwht	= "REJECT";
				} else {
					$result_rt_non_pwht	= "N/A";
				}

				if(isset($data_ndt_apwht['1'][$data_visual[$value['id_joint']]['id_visual']])) {
					$report_rt_pwht			= $data_ndt_apwht['1'][$data_visual[$value['id_joint']]['id_visual']]['report_number'];
					$date_rt						=	$data_ndt_apwht['1'][$data_visual[$value['id_joint']]['id_visual']]['date_of_inspection'];

					if($date_rt) {
						$date_rt_pwht	= date('Y-m-d', strtotime($date_rt));
					} else {
						$date_rt_pwht	= '';
					}

					$result_rt_2					= $data_ndt_apwht['1'][$data_visual[$value['id_joint']]['id_visual']]['result'];
					if($result_rt_2 == 3) {
						$result_rt_pwht	= "ACC";
					} elseif($result_rt_2 == 2) {
						$result_rt_pwht	= "REJECT";
					} else {
						$result_rt_pwht	= "N/A";
					}
				} else {
					$report_rt_pwht		= "";
					$date_rt_pwht			= "";
					$result_rt_pwht		= "";
				}


				// MAGNETIC PARTICLE NDT (PWHT OR NON PWHT)
					$report_magnetic_non_pwht	= $data_ndt['2'][$data_visual[$value['id_joint']]['id_visual']]['report_number'];
					$date_magnetic						=	$data_ndt['2'][$data_visual[$value['id_joint']]['id_visual']]['date_of_inspection'];

					if($date_magnetic) {
						$date_magnetic_non_pwht	= date('Y-m-d', strtotime($date_magnetic));
					} else {
						$date_magnetic_non_pwht	= '';
					}

					$result_magnetic_1				= $data_ndt['2'][$data_visual[$value['id_joint']]['id_visual']]['result'];
					if($result_magnetic_1 == 3) {
						$result_magnetic_non_pwht	= "ACC";
					} elseif($result_magnetic_1 == 2) {
						$result_magnetic_non_pwht	= "REJECT";
					} else {
						$result_magnetic_non_pwht	= "N/A";
					}

					if(isset($data_ndt_apwht['2'][$data_visual[$value['id_joint']]['id_visual']])) {
						$report_magnetic_pwht			= $data_ndt_apwht['2'][$data_visual[$value['id_joint']]['id_visual']]['report_number'];
						$date_magnetic						=	$data_ndt_apwht['2'][$data_visual[$value['id_joint']]['id_visual']]['date_of_inspection'];

						if($date_magnetic) {
							$date_magnetic_pwht	= date('Y-m-d', strtotime($date_magnetic));
						} else {
							$date_magnetic_pwht	= '';
						}

						$result_magnetic_2					= $data_ndt_apwht['2'][$data_visual[$value['id_joint']]['id_visual']]['result'];
						if($result_magnetic_2 == 3) {
							$result_magnetic_pwht	= "ACC";
						} elseif($result_magnetic_2 == 2) {
							$result_magnetic_pwht	= "REJECT";
						} else {
							$result_magnetic_pwht	= "N/A";
						}
					} else {
						$report_magnetic_pwht		= "";
						$date_magnetic_pwht			= "";
						$result_magnetic_pwht		= "";
					}

					// ULTRASONIC NDT (PWHT OR NON PWHT)
					$report_ut_non_pwht	= $data_ndt['3'][$data_visual[$value['id_joint']]['id_visual']]['report_number'];
					$date_ut						=	$data_ndt['3'][$data_visual[$value['id_joint']]['id_visual']]['date_of_inspection'];

					if($date_ut) {
						$date_ut_non_pwht	= date('Y-m-d', strtotime($date_ut));
					} else {
						$date_ut_non_pwht	= '';
					}

					$result_ut_1				= $data_ndt['3'][$data_visual[$value['id_joint']]['id_visual']]['result'];
					if($result_ut_1 == 3) {
						$result_ut_non_pwht	= "ACC";
					} elseif($result_ut_1 == 2) {
						$result_ut_non_pwht	= "REJECT";
					} else {
						$result_ut_non_pwht	= "N/A";
					}

					if(isset($data_ndt_apwht['3'][$data_visual[$value['id_joint']]['id_visual']])) {
						$report_ut_pwht			= $data_ndt_apwht['3'][$data_visual[$value['id_joint']]['id_visual']]['report_number'];
						$date_ut						=	$data_ndt_apwht['3'][$data_visual[$value['id_joint']]['id_visual']]['date_of_inspection'];

						if($date_ut) {
							$date_ut_pwht	= date('Y-m-d', strtotime($date_ut));
						} else {
							$date_ut_pwht	= '';
						}

						$result_ut_2					= $data_ndt_apwht['3'][$data_visual[$value['id_joint']]['id_visual']]['result'];
						if($result_ut_2 == 3) {
							$result_ut_pwht	= "ACC";
						} elseif($result_ut_2 == 2) {
							$result_ut_pwht	= "REJECT";
						} else {
							$result_ut_pwht	= "N/A";
						}
					} else {
						$report_ut_pwht		= "";
						$date_ut_pwht			= "";
						$result_ut_pwht		= "";
					}

					// HARDNESS NDT (PWHT OR NON PWHT)
					$report_hardness_non_pwht	= $data_ndt['5'][$data_visual[$value['id_joint']]['id_visual']]['report_number'];
					$date_hardness						=	$data_ndt['5'][$data_visual[$value['id_joint']]['id_visual']]['date_of_inspection'];

					if($date_hardness) {
						$date_hardness_non_pwht	= date('Y-m-d', strtotime($date_hardness));
					} else {
						$date_hardness_non_pwht	= '';
					}

					$result_hardness_1				= $data_ndt['5'][$data_visual[$value['id_joint']]['id_visual']]['result'];
					if($result_hardness_1 == 3) {
						$result_hardness_non_pwht	= "ACC";
					} elseif($result_hardness_1 == 2) {
						$result_hardness_non_pwht	= "REJECT";
					} else {
						$result_hardness_non_pwht	= "N/A";
					}


					// PENETRANT NDT (PWHT OR NON PWHT)
					$report_pt_non_pwht	= $data_ndt['7'][$data_visual[$value['id_joint']]['id_visual']]['report_number'];
					$date_pt						=	$data_ndt['7'][$data_visual[$value['id_joint']]['id_visual']]['date_of_inspection'];

					if($date_pt) {
						$date_pt_non_pwht	= date('Y-m-d', strtotime($date_pt));
					} else {
						$date_pt_non_pwht	= '';
					}

					$result_pt_1				= $data_ndt['7'][$data_visual[$value['id_joint']]['id_visual']]['result'];
					if($result_pt_1 == 3) {
						$result_pt_non_pwht	= "ACC";
					} elseif($result_pt_1 == 2) {
						$result_pt_non_pwht	= "REJECT";
					} else {
						$result_pt_non_pwht	= "N/A";
					}

					// PMI NDT (PWHT OR NON PWHT)
					$report_pmi_non_pwht	= $data_ndt['8'][$data_visual[$value['id_joint']]['id_visual']]['report_number'];
					$date_pmi						=	$data_ndt['8'][$data_visual[$value['id_joint']]['id_visual']]['date_of_inspection'];

					if($date_pmi) {
						$date_pmi_non_pwht	= date('Y-m-d', strtotime($date_pmi));
					} else {
						$date_pmi_non_pwht	= '';
					}

					$result_pmi_1				= $data_ndt['8'][$data_visual[$value['id_joint']]['id_visual']]['result'];
					if($result_pmi_1 == 3) {
						$result_pmi_non_pwht	= "ACC";
					} elseif($result_pmi_1 == 2) {
						$result_pmi_non_pwht	= "REJECT";
					} else {
						$result_pmi_non_pwht	= "N/A";
					}

					// PWHT NDT (PWHT OR NON PWHT)
					if(isset($data_ndt['9'][$data_visual[$value['id_joint']]['id_visual']])) {
						$status_pwht					= "YES";
						$report_pwht					= $data_ndt['9'][$data_visual[$value['id_joint']]['id_visual']]['report_number'];
						$date_pwht						=	$data_ndt['9'][$data_visual[$value['id_joint']]['id_visual']]['date_of_inspection'];

						if($date_pwht) {
							$date_pwht	= date('Y-m-d', strtotime($date_pwht));
						} else {
							$date_pwht	= '';
						}

						$result_pwht_1				= $data_ndt['9'][$data_visual[$value['id_joint']]['id_visual']]['result'];
						if($result_pwht_1 == 3) {
							$result_pwht	= "ACC";
						} elseif($result_pwht_1 == 2) {
							$result_pwht	= "REJECT";
						} else {
							$result_pwht	= "N/A";
						}
					} else {
						$status_pwht		= "NO";
						$report_pwht		= "";
						$date_pwht			= "";
						$result_pwht		= "";
					}


      ?>
       <tr nobr="true">
        <td style="width: 37pt;"><?= $data_template_joint[$value['id_joint']]['drawing_no'] ?></td>
        <td style="width: 15pt"><?php echo $data_template_joint[$value['id_joint']]['rev_wm']; ?></td>
        <td style="width: 20pt"><?php echo $data_template_joint[$value['id_joint']]['joint_no']; ?></td>
        <td style="width: 18pt"><?= $joint_type[$data_template_joint[$value['id_joint']]['joint_type']] ?></td>
        <td style="width: 25pt"><?= $data_template_joint[$value['id_joint']]['spool_no'] ?></td>
        <td><?= $data_template_joint[$value['id_joint']]['diameter'] ?></td>
        <td><?= $data_template_joint[$value['id_joint']]['thickness'] ?></td>
        <td><?= $material[$data_template_piecemark[$data_template_joint[$value['id_joint']]['pos_1']]['id']]['report_number'] ?></td>
        <td><?= $material_grade[$data_template_piecemark[$data_template_joint[$value['id_joint']]['pos_1']]['grade']] ?></td>
        <td><?= $qcs_material[$mis_detail[$material[$data_template_piecemark[$data_template_joint[$value['id_joint']]['pos_1']]['id']]['id_mis']]['unique_no']]['unique_ident_no'] ?></td>
        <td><?= $material[$data_template_piecemark[$data_template_joint[$value['id_joint']]['pos_2']]['id']]['report_number'] ?></td>
        <td><?= $material_grade[$data_template_piecemark[$data_template_joint[$value['id_joint']]['pos_2']]['grade']] ?></td>
        <td><?= $qcs_material[$mis_detail[$material[$data_template_piecemark[$data_template_joint[$value['id_joint']]['pos_2']]['id']]['id_mis']]['unique_no']]['unique_ident_no'] ?></td>
        <td><?= $value['report_number'] ?></td>
        <td><?= $result_fitup ?></td>
        <td><?= implode(", <br>", $wps_list_fitup) ?></td>
        <td><?= implode(", <br>", $welder_id_rh_list) ?></td>
        <td><?= implode(", <br>", $welder_id_fc_list) ?></td>
        <td><?= $data_visual[$value['id_joint']]['report_number'] ?></td>
        <td><?= $visual_date ?></td>
        <td><?= $result_visual ?></td>
          
        <td><?= $report_magnetic_non_pwht ?></td>
        <td><?= $date_magnetic_non_pwht ?></td>
        <td><?= $result_magnetic_non_pwht ?></td>
        
        <td><?= $report_pt_non_pwht ?></td>
        <td><?= $date_pt_non_pwht ?></td>
        <td><?= $result_pt_non_pwht ?></td>

        <td><?= $report_ut_non_pwht ?></td>
        <td><?= $date_ut_non_pwht ?></td>
        <td><?= $result_ut_non_pwht ?></td>

        <td><?= $report_rt_non_pwht ?></td>
        <td><?= $date_rt_non_pwht ?></td>
        <td><?= $result_rt_non_pwht ?></td>

        <td><?= $report_pmi_non_pwht ?></td>
        <td><?= $date_pmi_non_pwht ?></td>
        <td><?= $result_pmi_non_pwht ?></td>

        <td><?= $status_pwht == "YES" ? $status_pwht : "" ?></td>
        <td><?= $status_pwht == "NO" ? $status_pwht : "" ?></td>

        <td><?= $report_pwht ?></td>
        <td><?= $date_pwht ?></td>
        <td><?= $result_pwht ?></td>

        <td><?= $report_magnetic_pwht ?></td>
        <td><?= $date_magnetic_pwht ?></td>
        <td><?= $result_magnetic_pwht ?></td>
        
        <td><?= $report_rt_pwht ?></td>
        <td><?= $date_rt_pwht ?></td>
        <td><?= $result_rt_pwht ?></td>

        <td><?= $report_ut_pwht ?></td>
        <td><?= $date_ut_pwht ?></td>
        <td><?= $result_ut_pwht ?></td>

        <td><?= $report_hardness_non_pwht ?></td>
        <td><?= $date_hardness_non_pwht ?></td>
        <td><?= $result_hardness_non_pwht ?></td>
        <td></td>
        <td><?= $data_template_joint[$value['id_joint']]['test_pack_no'] ?></td>
        
      </tr>
       <?php endforeach; ?>
    </tbody>
  </table>
    </body>
    </html>
