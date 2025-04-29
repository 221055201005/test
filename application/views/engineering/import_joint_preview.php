<?php
$status_internal_list = [
  "Internal" => 1,
  "External" => 0,
];
$is_itr_list = [
  "Yes" => 1,
  "No" => 0,
];
?>
<div id="content" class="container-fluid">

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white">
          <h6 class="font-weight-bold text-info"><i class="fas fa-info-circle"></i> Drag the header to expand column.</h6>
          <form method="POST" action="<?php echo base_url() ?>engineering/import_joint_process_ext">
            <div class="overflow-auto">
              <table class="table table-hover text-center dataTable">
                <thead class="bg-green-smoe text-white text-nowrap">
                	<tr>
                		<th colspan="43" class="bg-secondary">GENERAL</th>
                		<th colspan="4" class="bg-green">FITUP</th>
                		<th colspan="12" class="bg-primary">VISUAL</th>
                	</tr>
                  <tr>
                    <th>No</th>
                    <th>Status</th>

                    <th>Project</th>
                    <th>Module</th>
                    <th>Type Of Module</th>
                    <th>Discipline</th>
                    <th>Deck Elevation / Service Line</th>
                    <th>Desc. Assy</th>
                    <th>Drawing Type</th>
                    <th>Drawing No</th>
                    <th>Rev Drawing</th>
                    <th>Drawing WM</th>
                    <th>Rev. WM Dwg</th>
                    <th>Joint No</th>
                    <th>GA/AS Ref#1</th>
                    <th>Piecemark#1</th>
                    <th>GA/AS Ref#1</th>
                    <th>Piecemark#2</th>
                    <th>Weld Type</th>
                    <th>Phase</th>
                    <th>Thickness</th>
                    <th>Diameter</th>
                    <th>Schedule</th>
                    <th>Length</th>
                    <th>Weld Length</th>
                    <th>Joint Type</th>
                    <th>Test Pack Number</th>
                    <th>Service Line</th>
                    <th>P&ID Drawing</th>
                    <th>Class</th>
                    <th>Row</th>
                    <th>Column</th>
                    <th>MT Req</th>
                    <th>PT Req</th>
                    <th>UT Req</th>
                    <th>RT Req</th>
                    <th>PMI Req</th>
                    <th>PWHT Req</th>
                    <th>WPS</th>
                    <th>Remarks</th>
                    <th>Status Internal (Internal / External)</th>
                    <th>Is Bondstrand (Yes/No)</th>
                    <th>Company</th>

                    <th>Date Req.</th>
                    <th>WPS</th>
                    <th>Inspection By</th>
                    <th>Inspection Date</th>

										<th>date request</th>
										<th>weld datetime</th>
										<th>length of weld </th>
										<th>cons lot no	</th>
										<th>WPS R/H </th>
										<th>WPS F/C </th>
										<th>Welder R/H </th>
										<th>Welder F/C </th>
										<th>INSPECT BY </th>
										<th>inspection datetime</th>
										<th>Weld Process (R/H) </th>
										<th>Weld Process (F/C) </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $cek_joint = [];
                  $no_arr = 0;
                  foreach ($sheet as $key => $value) :
                    $status = "";
                    if ($key > 2 && $value['A'] != "") :

                      $value['AB']  = decrypt($value['AB']);
                      $value['F']   = decrypt($value['F']);
                      $value['Q']   = decrypt($value['Q']);

                      $status_message = [];
                      if (!isset($project_list[$value['A']])) {
                        $status = "error";
                        $status_message[] = "&#x2022;Project Not Found!";
                      } 
                      if (!isset($module_list[$project_list[$value['A']]['id']][$value['B']])) {
                        $status = "error";
                        $status_message[] = "&#x2022;Module Not Found!";
                      } 
                      if (!isset($type_of_module_list[$value['C']])) {
                        $status = "error";
                        $status_message[] = "&#x2022;Type of Module Not Found!";
                      } 
                      if (!isset($discipline_list[$value['D']])) {
                        $status = "error";
                        $status_message[] = "&#x2022;Discipline Not Found!";
                      } 
                      if (!isset($deck_elevation_list[$value['E']])) {
                        $status = "error";
                        $status_message[] = "&#x2022;Deck Elevation / Service Line Not Found!";
                      } 
                      if (!isset($type_of_weld_list[$value['Q']])) {
                        $status = "error";
                        $status_message[] = "&#x2022;Weld Type Not Found!";
                      } 
                      if (!isset($desc_assy_list[$value['F']])) {
                        $status = "error";
                        $status_message[] = "&#x2022;Desc Assy Not Found!";
                      } 
                      if (!isset($joint_type_list[$value['X']])) {
                        $status = "error";
                        $status_message[] = "&#x2022;Joint Type Not Found!";
                      } 
                      if (!isset($company_list[$value['AM']])) {
                        $status = "error";
                        $status_message[] = "&#x2022;Company Not Found!";
                      } 
                      if ($value['H'] == '' || ($value['H'] != '' && !in_array($value['H'], $existing_drawing))) {
                        $status = "error";
                        $status_message[] = "&#x2022;Drawing GA/AS not found!";
                      } 
                      if ($value['J'] == '' || ($value['J'] != '' && !in_array($value['J'], $existing_drawing))) {
                        $status = "error";
                        $status_message[] = "&#x2022;Drawing WM not found!";
                      } 
                      if (($value['L'] != '' && in_array($value['J'] . ';' . $value['L'], $existing_joint))) {
                        $status = "error";
                        $status_message[] = "&#x2022;Duplicate Joint No";
                      } 

                      $piecemark_arr = $value['N'];
                      $piecemark_arr = explode(";", $piecemark_arr);
                      foreach ($piecemark_arr as $piecemark) {
                        if (($piecemark == '' || !in_array($piecemark, $existing_pos1))) {
                          $status = "error";
                          $status_message[] = "&#x2022;Piecemark#1 (".$piecemark.") Not Found";
                        } 
                      }

                      $piecemark_arr = $value['P'];
                      $piecemark_arr = explode(";", $piecemark_arr);
                      foreach ($piecemark_arr as $piecemark) {
                        if (($piecemark == '' || !in_array($piecemark, $existing_pos2))) {
                          $status = "error";
                          $status_message[] = "&#x2022;Piecemark#2 (".$piecemark.") Not Found";
                        } 
                      }

                      if (($value['AB'] == '' || !isset($data_class[$value['AB']]))) {
                        $status = "error";
                        $status_message[] = "&#x2022;Class Not Found";
                      } 
                      if (in_array($value['L'] . ';' . $value['J'], $cek_joint)) {
                        $status = "error";
                        $status_message[] = "&#x2022;Duplicate Insert Joint No";
                      }
                      if($value["AP"]){
                      	if(!isset($value["AN"], $value["AO"], $value["AQ"])){
	                        $status = "error";
	                        $status_message[] = "&#x2022;Some Required Columns for Fitup is Blank";
	                      }
                        foreach (explode(";", $value["AO"]) as $key_ao => $value_ao) {
                        	if(!$wps_list[$value_ao]){
                        		$status = "error";
                        		$status_message[] = "&#x2022;WPS (column 'AO') not Registered Yet on System";
                        	}
                        }
                        if(!$master_user[decrypt($value['AP'])]){
                        	$status = "error";
                        	$status_message[] = "&#x2022;Inspector (column 'AP') not Registered Yet on System";
                        }
                        if(!$mv_valid[$value['N']]){
                        	$status = "error";
                        	$status_message[] = "&#x2022;MV for POS#1 not Valid!";
                        }
                        if(!$mv_valid[$value['P']]){
                        	$status = "error";
                        	$status_message[] = "&#x2022;MV for POS#2 not Valid!";
                        }
                      }
                      if($value["AZ"]){
                      	if(!isset($value["AN"], $value["AO"], $value["AP"], $value["AQ"], $value["AR"], $value["AS"], $value["AT"], 
                      		// $value["AU"], 
                      		// $value["AV"], 
                          $value["AW"], 
                          // $value["AX"], 
                          $value["AY"], 
                          $value["AZ"], 
                          $value["BA"], 
                          $value["BC"]
                          // $value["BB"]
                        )){
                        	$status = "error";
                        	$status_message[] = "&#x2022;Some Required Columns for Visual is Blank";
                        }
                        foreach (explode(";", $value["AO"]) as $key_ao => $value_ao) {
                        	if(!$wps_list[$value_ao]){
                        		$status = "error";
                        		$status_message[] = "&#x2022;WPS (column 'AO') not Registered Yet on System";
                        	}
                        }
                        foreach (explode(";", $value["AV"]) as $key_ao => $value_ao) {
                        	if(!$wps_list[$value_ao]){
                        		$status = "error";
                        		$status_message[] = "&#x2022;WPS (column 'AV') not Registered Yet on System";
                        	}
                        }
                        foreach (explode(";", $value["AW"]) as $key_ao => $value_ao) {
                        	if(!$wps_list[$value_ao]){
                        		$status = "error";
                        		$status_message[] = "&#x2022;WPS (column 'AW') not Registered Yet on System";
                        	}
                        }
                        foreach (array_filter(explode(";", $value["AX"])) as $key_ao => $value_ao) {
                        	if(!$valid_welder[$value_ao]){
                        		$status = "error";
                        		$status_message[] = "&#x2022;Welder (column 'AX') not Registered Yet on System";
                        	}
                          foreach (array_filter(explode(";", $value["AV"])) as $key_av => $value_av) {
                            if(!in_array($value_av, $welder_wps_array_cek[$value_ao])){
                              $status = "error";
                              $status_message[] = "&#x2022;Welder $value_ao (column 'AX') Not Match with WPS $value_av";
                            }
                          }
                        }
                        foreach (array_filter(explode(";", $value["AY"])) as $key_ao => $value_ao) {
                        	if(!$valid_welder[$value_ao]){
                        		$status = "error";
                        		$status_message[] = "&#x2022;Welder (column 'AY') not Registered Yet on System";
                        	}
                          foreach (array_filter(explode(";", $value["AW"])) as $key_aw => $value_aw) {
                            if(!in_array($value_aw, $welder_wps_array_cek[$value_ao])){
                              $status = "error";
                              $status_message[] = "&#x2022;Welder $value_ao (column 'AY') Not Match with WPS $value_aw";
                            }
                          }
                        }
                        if(!$master_user[decrypt($value['AP'])]){
                        	$status = "error";
                        	$status_message[] = "&#x2022;Inspector (column 'AP') not Registered Yet on System";
                        }
                        if(!$master_user[decrypt($value['AZ'])]){
                        	$status = "error";
                        	$status_message[] = "&#x2022;Inspector (column 'AZ') not Registered Yet on System";
                        }
                        if(!$mv_valid[$value['N']]){
                        	$status = "error";
                        	$status_message[] = "&#x2022;MV for POS#1 not Valid!";
                        }
                        if(!$mv_valid[$value['P']]){
                        	$status = "error";
                        	$status_message[] = "&#x2022;MV for POS#2 not Valid!";
                        }
                      }

                      $cek_joint[] = $value['L'] . ';' . $value['J'];
                   

                  ?>

                      <tr style="background: <?php echo ($status != "" ? "#f8d7da" : "") ?>">
                      	<td class="font-weight-bold text-left text-nowrap">
                      		<?php echo $key ?>
                      	</td>
                      	<td class="font-weight-bold text-left text-nowrap">
                      		<?php // echo $status ?>
                      		<?= implode("<br>", array_unique($status_message)); ?>
                      		<?php unset($status_message); ?>
                      	</td>

                        <td>
                          <input type="text" class="form-control" value="<?php echo $value['A'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                          <input type="hidden" class="form-control" value="<?php echo @$project_list[$value['A']]['id'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="project[]">
                        </td>
                        <td>
                          <input type="text" class="form-control" value="<?php echo $value['B'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                          <input type="hidden" class="form-control" value="<?php echo @$module_list[$project_list[$value['A']]['id']][$value['B']]['mod_id'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="module[]">
                        </td>
                        <td>
                          <input type="text" class="form-control" value="<?php echo $value['C'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                          <input type="hidden" class="form-control" value="<?php echo @$type_of_module_list[$value['C']]['id'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="type_of_module[]">
                        </td>
                        <td>
                          <input type="text" class="form-control" value="<?php echo $value['D'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                          <input type="hidden" class="form-control" value="<?php echo @$discipline_list[$value['D']]['id'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="discipline[]">
                        </td>
                        <td>
                          <input type="text" class="form-control" value="<?php echo $value['E'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                          <input type="hidden" class="form-control" value="<?php echo @$deck_elevation_list[$value['E']]['id'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="deck_elevation[]">
                        </td>

                        <td>
                          <input type="hidden" class="form-control" value="<?php echo $value['F'] + 0 ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="desc_assy[]">
                          <input type="text" class="form-control" value="<?php echo @$desc_assy_list[$value['F']]['code'] . ' - ' . @$desc_assy_list[$value['F']]['name'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                        </td>
                        <td>
                          <input type="hidden" class="form-control" value="<?php echo $drawing_type_list[$value['G']]['id'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="drawing_type[]">
                          <input type="text" class="form-control" value="<?php echo @$drawing_type_list[$value['G']]['description'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                        </td>
                        <td>
                          <input type="hidden" class="form-control" value="<?php echo $value['H'] ?>" name="drawing_no[]" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                          <input type="text" class="form-control" value="<?php echo $value['H'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                        </td>
                        <td>
                          <input type="hidden" class="form-control" value="<?php echo $value['I'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="rev_no[]">
                          <input type="text" class="form-control" value="<?php echo $value['I'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                        </td>
                        <td>
                          <input type="hidden" class="form-control" value="<?php echo $value['J'] ?>" name="drawing_wm[]" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                          <input type="text" class="form-control" value="<?php echo $value['J'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                        </td>
                        <td>
                          <input type="hidden" class="form-control" value="<?php echo $value['K'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="rev_wm[]">
                          <input type="text" class="form-control" value="<?php echo $value['K'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                        </td>
                        <td>
                          <input type="hidden" class="form-control" value="<?php echo $value['L'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="joint_no[]">
                          <input type="text" class="form-control" value="<?php echo $value['L'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                        </td>
                        <td>
                          <input type="hidden" class="form-control" value="<?php echo $value['M'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="ref_1[]">
                          <input type="text" class="form-control" value="<?php echo $value['M'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                        </td>
                        <td>
                          <input type="hidden" class="form-control" value="<?php echo $value['N'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="pos_1[]">
                          <input type="text" class="form-control" value="<?php echo $value['N'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                        </td>
                        <td>
                          <input type="hidden" class="form-control" value="<?php echo $value['O'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="ref_2[]">
                          <input type="text" class="form-control" value="<?php echo $value['O'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                        </td>
                        <td>
                          <input type="hidden" class="form-control" value="<?php echo $value['P'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="pos_2[]">
                          <input type="text" class="form-control" value="<?php echo $value['P'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                        </td>
                        <td>
                          <input type="hidden" class="form-control" value="<?php echo $type_of_weld_list[$value['Q']]['id'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="weld_type[]">
                          <input type="text" class="form-control" value="<?php echo $type_of_weld_list[$value['Q']]['weld_type'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                        </td>
                        <td>
                          <input type="hidden" class="form-control" value="<?php echo $value['R'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="phase[]">
                          <input type="text" class="form-control" value="<?php echo $value['R'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                        </td>
                        <td>
                          <input type="hidden" class="form-control" value="<?php echo $value['S'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="thickness[]">
                          <input type="text" class="form-control" value="<?php echo $value['S'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                        </td>
                        <td>
                          <input type="hidden" class="form-control" value="<?php echo $value['T'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="diameter[]">
                          <input type="text" class="form-control" value="<?php echo $value['T'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                        </td>
                        <td>
                          <input type="hidden" class="form-control" value="<?php echo $value['U'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="schedule[]">
                          <input type="text" class="form-control" value="<?php echo $value['U'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                        </td>
                        <td>
                          <input type="hidden" class="form-control" value="<?php echo $value['V'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="length[]">
                          <input type="text" class="form-control" value="<?php echo $value['V'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                        </td>
                        <td>
                          <input type="hidden" class="form-control" value="<?php echo $value['W'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="weld_length[]">
                          <input type="text" class="form-control" value="<?php echo $value['W'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                        </td>
                        <td>
                          <input type="hidden" class="form-control" value="<?php echo $joint_type[$value['X']]['id'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="joint_type[]">
                          <input type="text" class="form-control" value="<?php echo $value['X'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                        </td>
                        <td>
                          <input type="hidden" class="form-control" value="<?php echo $value['Y'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="test_pack_no[]">
                          <input type="text" class="form-control" value="<?php echo $value['Y'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                        </td>
                        <td>
                          <input type="hidden" class="form-control" value="<?php echo $value['Z'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="service_line[]">
                          <input type="text" class="form-control" value="<?php echo $value['Z'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                        </td>
                        <td>
                          <input type="hidden" class="form-control" value="<?php echo $value['AA'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="pid_drawing[]">
                          <input type="text" class="form-control" value="<?php echo $value['AA'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                        </td>
                        <td>
                          <input type="hidden" class="form-control" value="<?php echo $data_class[$value['AB']]['id'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="class[]">
                          <input type="text" class="form-control" value="<?php echo $value['AB'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                        </td>
                        <td>
                          <input type="hidden" class="form-control" value="<?php echo $value['AC'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="grid_row[]">
                          <input type="text" class="form-control" value="<?php echo $value['AC'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                        </td>
                        <td>
                          <input type="hidden" class="form-control" value="<?php echo $value['AD'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="grid_column[]">
                          <input type="text" class="form-control" value="<?php echo $value['AD'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                        </td>
                        <td>
                          <input type="hidden" class="form-control" value="<?php echo $value['AE'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="mt_percent_req[]">
                          <input type="text" class="form-control" value="<?php echo $value['AE'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                        </td>
                        <td>
                          <input type="hidden" class="form-control" value="<?php echo $value['AF'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="pt_percent_req[]">
                          <input type="text" class="form-control" value="<?php echo $value['AF'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                        </td>
                        <td>
                          <input type="hidden" class="form-control" value="<?php echo $value['AG'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="ut_percent_req[]">
                          <input type="text" class="form-control" value="<?php echo $value['AG'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                        </td>
                        <td>
                          <input type="hidden" class="form-control" value="<?php echo $value['BD'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="rt_percent_req[]">
                          <input type="text" class="form-control" value="<?php echo $value['BD'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                        </td>
                        <td>
                          <input type="hidden" class="form-control" value="<?php echo $value['BE'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="pmi_percent_req[]">
                          <input type="text" class="form-control" value="<?php echo $value['BE'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                        </td>
                        <td>
                          <input type="hidden" class="form-control" value="<?php echo $value['AH'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="pwht_percent_req[]">
                          <input type="text" class="form-control" value="<?php echo $value['AH'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                        </td>

                        <td>
                          <select class="custom-select input_width" name="wps[<?= $no_arr ?>][]" <?php echo ($status != "" ? "disabled" : "readonly") ?> multiple>
                            <?php foreach ($wps_list as $keys => $value_wps) : ?>
                              <?php if(in_array($value_wps['wps_no'], explode(";", $value["AI"]))): ?>
                                <option selected value="<?= $value_wps['id_wps'] ?>"><?= $value_wps['wps_no'] ?></option>
                              <?php endif; ?>
                            <?php endforeach; ?>
                          </select>
                        </td>
                        <td>
                          <input type="hidden" class="form-control" value="<?php echo $value['AJ'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="remarks[]">
                          <input type="text" class="form-control" value="<?php echo $value['AJ'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                        </td>
                        <td>
                          <input type="hidden" class="form-control" value="<?php echo $value['AK'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="status_internal[]">
                          <input type="text" class="form-control" value="<?php echo $value['AK'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                        </td>
                        <td>
                          <input type="hidden" class="form-control" value="<?php echo $value['AL'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="is_bondstrand[]">
                          <input type="text" class="form-control" value="<?php echo $value['AL'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                        </td>
                        <td>
                          <input type="text" class="form-control" value="<?php echo @$company_list[$value['AM']]['company_name'] ?> " <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                          <input type="hidden" class="form-control" value="<?php echo $company_list[$value['AM']]['id_company'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="company_id[]">
                        </td>
                        
                        <!-- FOR FITUP -->
                        <td>
                        	<input class="form-control" type="date" name="fitup_date_request[]" value="<?= isset($value['AN']) ? DATE("Y-m-d", strtotime($value['AN'])) : NULL ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                        </td>
                        <td>
                        	<select class="custom-select input_width" name="fitup_wps[<?= $no_arr ?>][]" <?php echo ($status != "" ? "disabled" : "readonly") ?> multiple>
                            <?php foreach ($wps_list as $keys => $value_wps) : ?>
                              <?php if(in_array($value_wps['wps_no'], explode(";", $value["AO"]))): ?>
                              <option selected value="<?= $value_wps['id_wps'] ?>"><?= $value_wps['wps_no'] ?></option>
                              <?php endif; ?>
                            <?php endforeach; ?>
                          </select>
                        </td>
                        <td>
                        	<?= @$master_user[decrypt($value['AP'])] ? $master_user[decrypt($value['AP'])] : '-' ?>
                          <input type="hidden" class="form-control" value="<?php echo decrypt($value['AP']) ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="fitup_inspection_by[]">
                        </td>
                        <td>
                        	<input class="form-control" type="date" name="fitup_inspection_datetime[]" value="<?= isset($value['AQ']) ? DATE("Y-m-d", strtotime($value['AQ'])) : NULL ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                        </td>

                        <!-- FOR VISUAL -->
                        <td>
                        	<input class="form-control" type="date" name="visual_date_request[]" value="<?= isset($value['AR']) && !empty($value['AR']) ? DATE("Y-m-d", strtotime($value['AR'])) : NULL ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                        </td>
                        <td>
                        	<input class="form-control" type="date" name="visual_weld_datetime[]" value="<?= isset($value['AS']) && !empty($value['AS']) ? DATE("Y-m-d", strtotime($value['AS'])) : NULL ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                        </td>
                        <td>
                        	<input class="form-control" type="number" step="any" name="visual_length_of_weld[]" value="<?= isset($value['AT']) ? $value['AT'] : $value['W'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                        </td>
                        <td>
                        	<input class="form-control" type="text" step="any" name="visual_cons_lot_no[]" value="<?= isset($value['AU']) ? $value['AU'] : NULL ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                        </td>
                        <td>
                        	<select class="custom-select input_width" name="visual_wps_rh[<?= $no_arr ?>][]" <?php echo ($status != "" ? "disabled" : "readonly") ?> multiple>
                            <?php foreach ($wps_list as $keys => $value_wps) : ?>
                              <?php if(in_array($value_wps['wps_no'], explode(";", $value["AV"]))): ?>
                                <option selected value="<?= $value_wps['id_wps'] ?>"><?= $value_wps['wps_no'] ?></option>
                              <?php endif; ?>
                            <?php endforeach; ?>
                          </select>
                        </td>
                        <td>
                        	<select class="custom-select input_width" name="visual_wps_fc[<?= $no_arr ?>][]" <?php echo ($status != "" ? "disabled" : "readonly") ?> multiple>
                            <?php foreach ($wps_list as $keys => $value_wps) : ?>
                              <?php if(in_array($value_wps['wps_no'], explode(";", $value["AW"]))): ?>
                                <option selected value="<?= $value_wps['id_wps'] ?>"><?= $value_wps['wps_no'] ?></option>
                              <?php endif; ?>
                            <?php endforeach; ?>
                          </select>
                        </td>
                        <td>
                        	<select class="custom-select input_width" name="visual_welder_rh[<?= $no_arr ?>][]" <?php echo ($status != "" ? "disabled" : "readonly") ?> multiple>
                            <?php foreach ($welder[$project_list[$value['A']]['id']] as $keys => $value_welder) : ?>
                              <?php if(in_array($value_welder['welder_code'], explode(";", $value["AX"]))): ?>
                                <option selected value="<?= $value_welder['id_welder'] ?>"><?= $value_welder['welder_code'] ?></option>
                              <?php endif; ?>
                            <?php endforeach; ?>
                          </select>
                        </td>
                        <td>
                        	<select class="custom-select input_width" name="visual_welder_fc[<?= $no_arr ?>][]" <?php echo ($status != "" ? "disabled" : "readonly") ?> multiple>
                            <?php foreach ($welder[$project_list[$value['A']]['id']] as $keys => $value_welder) : ?>
                              <?php if(in_array($value_welder['welder_code'], explode(";", $value["AY"]))): ?>
                                <option selected value="<?= $value_welder['id_welder'] ?>"><?= $value_welder['welder_code'] ?></option>
                              <?php endif; ?>
                            <?php endforeach; ?>
                          </select>
                        </td>
                        <td>
                        	<?= @$master_user[decrypt($value['AZ'])] ? $master_user[decrypt($value['AZ'])] : '-' ?>
                          <input type="hidden" class="form-control" value="<?php echo decrypt($value['AZ']) ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="visual_inspection_by[]">
                        </td>
                        <td>
                        	<input class="form-control" type="date" name="visual_inspection_datetime[]" value="<?= isset($value['BA']) ? DATE("Y-m-d", strtotime($value['BA'])) : NULL ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                        </td>
                        <td>
                        	<select class="custom-select input_width" name="visual_weld_process_rh[<?= $no_arr ?>][]" <?php echo ($status != "" ? "disabled" : "readonly") ?> multiple>
                            <option <?= in_array('GTAW', explode(";", $value["BB"])) ? 'selected' : '' ?> value="GTAW"><?= 'GTAW' ?></option>
                            <option <?= in_array('SMAW', explode(";", $value["BB"])) ? 'selected' : '' ?> value="SMAW"><?= 'SMAW' ?></option>
                            <option <?= in_array('FCAW', explode(";", $value["BB"])) ? 'selected' : '' ?> value="FCAW"><?= 'FCAW' ?></option>
                            <option <?= in_array('SAW', explode(";", $value["BB"])) ? 'selected' : '' ?> value="SAW"><?= 'SAW' ?></option>
                            <option <?= in_array('GMAW', explode(";", $value["BB"])) ? 'selected' : '' ?> value="GMAW"><?= 'GMAW' ?></option>
                          </select>
                        </td>
                        <td>
                        	<select class="custom-select input_width" name="visual_weld_process_fc[<?= $no_arr ?>][]" <?php echo ($status != "" ? "disabled" : "readonly") ?> multiple>
                            <option <?= in_array('GTAW', explode(";", $value["BC"])) ? 'selected' : '' ?> value="GTAW"><?= 'GTAW' ?></option>
                            <option <?= in_array('SMAW', explode(";", $value["BC"])) ? 'selected' : '' ?> value="SMAW"><?= 'SMAW' ?></option>
                            <option <?= in_array('FCAW', explode(";", $value["BC"])) ? 'selected' : '' ?> value="FCAW"><?= 'FCAW' ?></option>
                            <option <?= in_array('SAW', explode(";", $value["BC"])) ? 'selected' : '' ?> value="SAW"><?= 'SAW' ?></option>
                            <option <?= in_array('GMAW', explode(";", $value["BC"])) ? 'selected' : '' ?> value="GMAW"><?= 'GMAW' ?></option>
                          </select>
                        </td>
                      </tr>
                  <?php
                  	$no_arr++;
                    endif;
                  endforeach;
                  ?>
                </tbody>
              </table>
            </div>
            <br>
            <div class="row <?= $status=='' ? '' : 'd-none' ?>">
              <div class="col-12 text-right">
                <button class="mt-2 btn btn-sm btn-flat btn-success"><i class="fas fa-check"></i> Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>
</div><!-- ini div dari sidebar yang class wrapper -->


<script type="text/javascript">
  $(document).ready(function() {
    // addrow();
    selectRefresh();
  });

  function selectRefresh() {
    $(".select2_multiple_wps").select2({
      allowClear: true,
      tokenSeparators: [', ', ' '],
    })


  }
</script>