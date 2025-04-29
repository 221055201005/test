<style type="text/css">
  .select2_multiple_fno {
    width: 150px !important;
  }

  .select2_company {
    width: 200px !important;
  }

  th,
  td {
    vertical-align: middle !important;
  }

  .input_width {
    width: 200px !important;
  }
</style>

<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card rounded-0 shadow">
          <div class="card-header">
            <h6 class="m-0"> Visual Import Preview</h6>
          </div>
          <div class="card-body">
            <form action="<?= site_url('visual/proceed_import_visual') ?>" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive overflow-auto">
                    <table class="table text-center" id='form-submit'>
                      <thead class="bg-info text-white">
                        <tr>
                          <th>Drawing No.</th>
                          <th>Drawing WM No.</th>
                          <th>Discipline</th>
                          <th>Class</th>
                          <th>Welding Type</th>
                          <th>Joint No.</th>

                          <th>Request Date</th>
                          <th>Weld Date</th>
                          <th>Weld Length</th>

                          <th>Cons. Lot No.</th>
                          <th>Report Number</th>
                          <th>Weld Process (R/H)</th>
                          <th>Weld Process (F/C)</th>
                          <th>WPS (R/H)</th>
                          <th>WPS (F/C)</th>

                          <th>WELDER (R/H)</th>
                          <th>WELDER (F/C)</th>

                          <th>Status Inspection</th>
                          <th>Inspection By</th>
                          <th>Inspection Date</th>
                          <th>Inspection Client By</th>
                          <th>Inspection Client Date</th>

                          <th></th>

                        </tr>
                      </thead>
                      <tbody id="table_list">
                      <?php $key = 0; ?>
                      <?php $error = 0; ?>
                      <?php foreach ($sheet as $key_uniq => $value) { if($key>0 AND $value["S"]!=2) { ?>
                    	<?php 
                    		$id = $this->encryption->decrypt(strtr($value["A"], '.-~', '+=/'));

                    		$wps_1 = explode(";", $value["M"]);
                    		foreach ($wps_1 as $key_wps_1 => $value_wps_1) {
                    			$wps_rh[] = $value_wps_1;
                    		}
                    		$wps_2 = explode(";", $value["N"]);
                    		foreach ($wps_2 as $key_wps_2 => $value_wps_2) {
                    			$wps_fc[] = $value_wps_2;
                    		}
                    	?>
                    	<?php 
                    		$messages = "";
                    		$errow = 0;
                    		// test_var($joint[$id]);
                    		if(!$joint[$id]){
                    			$error++;
                    			$errow = 1;
                    			$messages = "Joint Doesn't exist on System!";
                    		} 
                    		if($exist[$id]){
                    			$error++;
                    			$errow = 1;
                    			$messages = "Joint exist on Fitup System!";
                    		}
                    		if(!$user[$this->encryption->decrypt(strtr($value["T"], '.-~', '+=/'))] 
                    			AND in_array($value["S"], ['ACC_QC', 'PENDING_CLIENT', 'ACC_CLIENT'])){
                    			$error++;
                    			$errow = 1;
                    			$messages = "User (Inspector) Doesn't exist on System!";
                    		}
                    		if(in_array($value["S"], ['ACC_CLIENT'])
                    			AND !$user[$this->encryption->decrypt(strtr($value["V"], '.-~', '+=/'))]){
                    			$error++;
                    			$errow = 1;
                    			$messages = "User (Client) Doesn't exist on System!";
                    		}

                    		$check[$value['L']][$joint[$id]["drawing_no"].$joint[$id]["drawing_wm"]] = $id;

                    		if(COUNT($check[$value['L']])>1){
                    			$error++;
                    			$errow = 1;
                    			$messages = "Duplicate Report Number!";
                    		}

                    		if(!$value['L'] AND in_array($value["K"], ['ACC_QC', 'PENDING_CLIENT', 'ACC_CLIENT'])){
                    			$error++;
                    			$errow = 1;
                    			$messages = "Report Number Can't be Null!";
                    		}
							
                    		if(!$value['I'] OR DATE("Y-m-d", strtotime($value["I"]))=='1970-01-01' ){
                    			$error++;
                    			$errow = 1;
                    			$messages = "Weld Date Can't be Null!";
                    		}
                    		if(intval($value['J'])<1){
                    			$error++;
                    			$errow = 1;
                    			$messages = "Length of Weld Can't be Null!";
                    		}

                    	?>
                    	<tr class="<?= $errow>0 ? "bg-alert-warning" : "" ?>">
										    <td class="align-middle">
										    	<input class="form-control" type="text" name="drawing_no[<?= $key_uniq ?>]" readonly value="<?= $joint[$id]["drawing_no"] ?>"  >		
										    	<input type="hidden" name="id_joint[<?= $key_uniq ?>]" value="<?= $id ?>">	
										    	<input type="hidden" name="discipline[<?= $key_uniq ?>]" value="<?= $joint[$id]["discipline"] ?>">	
										    	<input type="hidden" name="module[<?= $key_uniq ?>]" value="<?= $joint[$id]["module"] ?>">	
										    	<input type="hidden" name="type_of_module[<?= $key_uniq ?>]" value="<?= $joint[$id]["type_of_module"] ?>">	
										    	<input type="hidden" name="drawing_type[<?= $key_uniq ?>]" value="<?= $joint[$id]["drawing_type"] ?>">	
										    	<input type="hidden" name="drawing_rev_no[<?= $key_uniq ?>]" value="<?= $joint[$id]["rev_no"] ?>">	
										    	<input type="hidden" name="drawing_wm_rev[<?= $key_uniq ?>]" value="<?= $joint[$id]["rev_wm"] ?>">
										    	<input type="hidden" name="id_workpack[<?= $key_uniq ?>]" value="<?= $joint[$id]["workpack_id"] ?>">
										    </td>
										    <td class="align-middle">
										    	<input class="form-control" type="text" name="drawing_wm[<?= $key_uniq ?>]" readonly value="<?= $joint[$id]["drawing_wm"] ?>"  >	
										    </td>
										    <td class="align-middle">
										    	<?= $discipline_list[$joint[$id]["discipline"]]['discipline_name'] ?>
										    </td>
										    <td class="align-middle"><?= $class_list[$joint[$id]["class"]] ?></td>
										    <td class="align-middle"><?= $show_weld_type[$joint[$id]["weld_type"]] ?></td>
										    <td class="align-middle font-weight-bold"><?= $value["G"] ?></td>
											
										    <td class="align-middle">
										    	<input class="form-control" type="date" name="date_request[<?= $key_uniq ?>]" value="<?= $value["H"] ?>">	
										    </td>
										    <td class="align-middle">
										    	<input class="form-control" type="date" name="weld_datetime[<?= $key_uniq ?>]" value="<?= $value["I"] ?>">	
										    </td>

										    <td class="align-middle">
										    	<input class="form-control" type="number" name="length_of_weld[<?= $key_uniq ?>]" value="<?= $value["J"] ?>">	
										    </td>
										    <td class="align-middle">
										    	<input class="form-control" type="text" name="cons_lot_no[<?= $key_uniq ?>]" value="<?= $value["K"] ?>">	
										    </td>

										    <td class="align-middle">
										    	<!-- <input type="text" class="form-control" name="report_number[<?= $key_uniq ?>]" value="<?= $value['L'] ?>"> -->

										    	<?= $master_report_number[21][$joint[$id]["discipline"]][$joint[$id]["type_of_module"]]['fitup_report'].str_pad(substr($value['L'],-6), 6, '0', STR_PAD_LEFT) ?>
										    	<input type="hidden" class="form-control" name="report_number[<?= $key_uniq ?>]" value="<?= str_pad(substr($value['L'],-6), 6, '0', STR_PAD_LEFT) ?>" required>
										    	<input type="hidden" class="form-control" name="submission_id[<?= $key_uniq ?>]" value="<?= $master_report_number[21][$joint[$id]["discipline"]][$joint[$id]["type_of_module"]]['fitup_report'].str_pad(substr($value['L'],-6), 6, '0', STR_PAD_LEFT) ?>">
										    </td>

										    <td class="align-middle">
										    	<select class="form-control select2" multiple name="weld_process_rh[<?= $key_uniq ?>][]" >
										    		<option value="">---</option>
										    		<option value="SMAW" <?= in_array("SMAW", explode(";", $value["X"])) ? 'selected' : '' ?>>SMAW</option>
														<option value="GTAW" <?= in_array("GTAW", explode(";", $value["X"])) ? 'selected' : '' ?>>GTAW</option>
														<option value="SAW"	 <?= in_array("SAW", explode(";", $value["X"])) ? 'selected' : '' ?>>SAW</option>
														<option value="FCAW" <?= in_array("FCAW", explode(";", $value["X"])) ? 'selected' : '' ?>>FCAW</option>
														<option value="GMAW" <?= in_array("GMAW", explode(";", $value["X"])) ? 'selected' : '' ?>>GMAW</option>
										    	</select>
										    </td>
										    <td class="align-middle">
										    	<select class="form-control select2" multiple name="weld_process_fc[<?= $key_uniq ?>][]" required>
										    		<option value="">---</option>
										    		<option value="SMAW" <?= in_array("SMAW", explode(";", $value["Y"])) ? 'selected' : '' ?>>SMAW</option>
														<option value="GTAW" <?= in_array("GTAW", explode(";", $value["Y"])) ? 'selected' : '' ?>>GTAW</option>
														<option value="SAW"	 <?= in_array("SAW", explode(";", $value["Y"])) ? 'selected' : '' ?>>SAW</option>
														<option value="FCAW" <?= in_array("FCAW", explode(";", $value["Y"])) ? 'selected' : '' ?>>FCAW</option>
														<option value="GMAW" <?= in_array("GMAW", explode(";", $value["Y"])) ? 'selected' : '' ?>>GMAW</option>
										    	</select>
										    </td>

										    <td class="align-middle">
										    	<select class="form-control select2" multiple name="wps_no_rh[<?= $key_uniq ?>][]"  >
										    	<?php foreach ($wps_list as $key_wps_list => $value_wps_list) { ?>
										    		<option value="<?= $value_wps_list["id_wps"] ?>"
										    			<?= in_array($value_wps_list["wps_no"], $wps_rh) ? 'selected' : '' ?>
										    		>
										    			<?= $value_wps_list["wps_no"] ?>
										    		</option>
										    	<?php } ?>
										    	</select>
										    	<?php unset($wps_rh); ?>
										    </td>

										    <td class="align-middle">
										    	<select class="form-control select2" multiple name="wps_no_fc[<?= $key_uniq ?>][]" >
										    	<?php foreach ($wps_list as $key_wps_list => $value_wps_list) { ?>
										    		<option value="<?= $value_wps_list["id_wps"] ?>"
										    			<?= in_array($value_wps_list["wps_no"], $wps_fc) ? 'selected' : '' ?>
										    		>
										    			<?= $value_wps_list["wps_no"] ?>
										    		</option>
										    	<?php } ?>
										    	</select>
										    	<?php unset($wps_fc); ?>
										    </td>

										    <td class="align-middle">
										    	<table>
										    		<tr>
										    			<th>Welder</th>
										    			<th>Length</th>
										    		</tr>
										    		<tbody>
										    		<?php 
										    			$welder_rh = array_filter(explode(";", $value["O"]));
										    			$welder_length_rh = explode(";", $value["Q"]);
										    			foreach ($welder_rh as $key_welder_rh => $value_welder_rh) { ?>
										    			<tr>
										    				<td>
										    					<input   type="text" class="form-control" disabled value="<?= $value_welder_rh ?>">
										    					<input type="hidden" class="form-control" name="id_welder_rh[<?= $key_uniq ?>][]" value="<?= $value_welder_rh ?>">
										    				</td>
										    				<td>
										    					<!-- <input   type="number" class="form-control" readonly name="length_welded_rh[<?= $key_uniq ?>][]" value="100"> -->
										    					<input   type="number" class="form-control" readonly name="length_welded_rh[<?= $key_uniq ?>][]" value="0">
										    				</td>
										    			</tr>
										    		<?php } unset($welder_rh, $welder_length_rh); ?>
										    		</tbody>
										    	</table>
										    </td>

										    <td class="align-middle">
										    	<table>
										    		<tr>
										    			<th>Welder</th>
										    			<th>Length</th>
										    		</tr>
										    		<tbody>
										    		<?php 
										    			$welder_fc = array_filter(explode(";", $value["P"]));
										    			$welder_length_fc = explode(";", $value["R"]);
										    			foreach ($welder_fc as $key_welder_fc => $value_welder_fc) { ?>
										    			<tr>
										    				<td>
										    					<input type="text" class="form-control" disabled value="<?= $value_welder_fc ?>">
										    					<input type="hidden" class="form-control" name="id_welder_fc[<?= $key_uniq ?>][]" value="<?= $value_welder_fc ?>">
										    				</td>
										    				<td>
										    					<!-- <input type="number" class="form-control" readonly name="length_welded_fc[<?= $key_uniq ?>][]" value="100"> -->
										    					<input type="number" class="form-control" readonly name="length_welded_fc[<?= $key_uniq ?>][]" value="0">
										    				</td>
										    			</tr>
										    		<?php } unset($welder_fc, $welder_length_fc); ?>
										    		</tbody>
										    	</table>
										    </td>

										    <td class="align-middle">
										    	<!-- <input type="number" class="form-control" readonly name="status_inspection[<?= $key_uniq ?>]" value="<?= $value["S"] ?>"> -->
										    	<select class="form-control select2" name="status_inspection[<?= $key_uniq ?>]"  >
										    		<option value="0" <?= $value["S"]=="PRODUCTION_RFI" ? "selected" : "" ?>>Production RFI</option>
										    		<option value="1" <?= $value["S"]=="PENDING_QC" ? "selected" : "" ?>>Pending QC</option>
										    		<!-- <option value="3" <?= $value["S"]==3 ? "selected" : "" ?>>Approved QC</option>
										    		<option value="5" <?= $value["S"]==4 ? "selected" : "" ?>>Pending Client</option>
										    		<option value="7" <?= $value["S"]==5 ? "selected" : "" ?>>Approved Client</option> -->
										    		<option value="3" <?= $value["S"]=="ACC_QC" ? "selected" : "" ?>>Approved QC</option>
										    		<option value="5" <?= $value["S"]=="PENDING_CLIENT" ? "selected" : "" ?>>Pending Client</option>
										    		<option value="7" <?= $value["S"]=="ACC_CLIENT" ? "selected" : "" ?>>Approved Client</option>
										    	</select>
										    	<?php unset($wps); ?>
										    </td>
										    <td class="align-middle">
										    	<?= 
										    		$user[decrypt($value["T"])]["full_name"] ?
										    		$user[decrypt($value["T"])]["full_name"] :
										    		"---";
										    	?>
										    	<input type="hidden" name="inspection_by[<?= $key_uniq ?>]" value="<?= $value["T"] ?>"
										    	>	
										    </td>
										    <td class="align-middle">
										    	<input class="form-control" type="text" name="inspection_datetime[<?= $key_uniq ?>]" value="<?= $value["U"] ?>"
										    		<?= in_array($value["S"], [3, 5, 7]) ? ' ' : '' ?>
										    	>	
										    </td>

										    <td class="align-middle">
										    	<?= 
										    		$user[decrypt($value["V"])]["full_name"] ?
										    		$user[decrypt($value["V"])]["full_name"] :
										    		"---";
										    	?>
										    	<input type="hidden" name="client_inspection_by[<?= $key_uniq ?>]" value="<?= $value["V"] ?>">	
										    </td>
										    <td class="align-middle">
										    	<input <?= $value["S"] == 7 ? ' ' : '' ?> class="form-control" type="text" name="client_inspection_date[<?= $key_uniq ?>]" value="<?= $value["W"] ?>">	
										    </td>

										    <td class="align-middle">
										    	<?= $messages ?>
										    </td>

										  </tr>
                      <?php }$key++;} ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <?php //test_var($check, 1); ?>
                <div class="col-md-12 text-right">
                  <hr>

                  <a href="<?= site_url('visual/import_visual') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                  <?php if($error==0){ ?>
                  	<button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Submit</button>
                  <?php } else { ?>
                  	<span class="btn btn-danger">
                  		<i class="fas fa-times"></i>
                  		 Please Check Error Messages!
                  	</span>
                  <?php } ?>
                </div>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    // addrow();
    selectRefresh();

    $('form').on('submit', function() {
      $('button[type=submit]').attr('disabled', true)
    })
  });

  
</script>