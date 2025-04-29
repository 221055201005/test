<?php

	error_reporting(0);
	$status_inspection = [
	  'Production RFI'              => 0,
	  	'Pending by QC'               => 1,
	  		'Approved by QC'              => 3,
	  			'Pending Approval Client'     => 5,
	  				'Approved by Client'          => 7,
	];

?>

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
            <h6 class="m-0"> Fitup Import Preview</h6>
          </div>
          <div class="card-body">
            <form action="<?= site_url('fitup/proceed_import_fitup') ?>" method="post" enctype="multipart/form-data">
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
                          <th>POS #1</th>
                          <th>POS #2</th>

                          <th>Report Number</th>

                          <th>WPS</th>
                          <th>Status Inspection</th>
                          <th>Inspection By</th>
                          <th>Inspection Date</th>
                          <th>Client Inspection By</th>
                          <th>Client Inspection Date</th>

                          <th>Request Date</th>
                          <th></th>

                        </tr>
                      </thead>
                      <tbody id="table_list">
                      <?php $key = 0; ?>
                      <?php $error = 0; ?>
                      <?php foreach ($sheet as $key_uniq => $value) { if($key>0){ ?>
                    	<?php 
                    		$id = $this->encryption->decrypt(strtr($value["A"], '.-~', '+=/'));

                    		$wps_1 = explode(";", $value["J"]);
                    		foreach ($wps_1 as $key_wps_1 => $value_wps_1) {
                    			$wps[] = $value_wps_1;
                    			// $wps[] = $this->encryption->decrypt(strtr($value_wps_1, '.-~', '+=/'));
                    		}
                    	?>
                    	<?php 
                    		$messages[] = "";
                    		$errow = 0;
                    		// test_var($joint[$id]);
                    		if(!$joint[$id]){
                    			$error++;
                    			$errow = 1;
                    			$messages[] = "Joint Doesn't exist on System!";
                    		} 
                    		if($exist[$id]){
                    			$error++;
                    			$errow = 1;
                    			$messages[] = "Joint exist on Fitup System!";
                    		}
                    		if(!$user[$this->encryption->decrypt(strtr($value["M"], '.-~', '+=/'))] 
                    			AND in_array($value["K"], ['ACC_QC', 'PENDING_CLIENT', 'ACC_CLIENT'])){
                    			$error++;
                    			$errow = 1;
                    			$messages[] = "User (Inspector) Doesn't exist on System!";
                    		}
                    		if(in_array($value["K"], ['ACC_CLIENT'])
                    			AND !$user[$this->encryption->decrypt(strtr($value["O"], '.-~', '+=/'))]){
                    			$error++;
                    			$errow = 1;
                    			$messages[] = "User (Client) Doesn't exist on System!";
                    		}

                    		$check[$value['L']][$joint[$id]["drawing_no"].$joint[$id]["drawing_wm"]] = $id;

                    		if(COUNT($check[$value['L']])>1 AND in_array($value["K"], ['ACC_QC', 'PENDING_CLIENT', 'ACC_CLIENT'])){
                    			$error++;
                    			$errow = 1;
                    			$messages[] = "Duplicate Report Number!";
                    		}

                    		if(!$value['L'] AND in_array($value["K"], ['ACC_QC', 'PENDING_CLIENT', 'ACC_CLIENT'])){
                    			$error++;
                    			$errow = 1;
                    			$messages[] = "Report Number Can't be Null!";
                    		}

                    		if(!$joint[$id]["workpack_id"]){
                    			$error++;
                    			$errow = 1;
                    			$messages[] = "Workpack Not Registered!";
                    		}

                    	?>
                    	<tr class="<?= $errow>0 ? "bg-alert-warning" : "" ?>">
										    <td class="align-middle">
										    	<input class="form-control" type="text" name="drawing_no[]" readonly value="<?= $joint[$id]["drawing_no"] ?>" required>		
										    	<input type="hidden" name="id_joint[]" value="<?= $id ?>">	
										    	<input type="hidden" name="discipline[]" value="<?= $joint[$id]["discipline"] ?>">	
										    	<input type="hidden" name="module[]" value="<?= $joint[$id]["module"] ?>">	
										    	<input type="hidden" name="type_of_module[]" value="<?= $joint[$id]["type_of_module"] ?>">	
										    	<input type="hidden" name="drawing_type[]" value="<?= $joint[$id]["drawing_type"] ?>">	
										    	<input type="hidden" name="rev_no[]" value="<?= $joint[$id]["rev_no"] ?>">	
										    	<input type="hidden" name="rev_wm[]" value="<?= $joint[$id]["rev_wm"] ?>">
										    	<input type="hidden" readonly name="id_workpack[]" value="<?= $joint[$id]["workpack_id"] ?>">
										    </td>
										    <td class="align-middle">
										    	<input class="form-control" type="text" name="drawing_wm[]" readonly value="<?= $joint[$id]["drawing_wm"] ?>" required>	
										    </td>
										    <td class="align-middle">
										    	<?= $discipline_list[$joint[$id]["discipline"]]['discipline_name'] ?>
										    </td>
										    <td class="align-middle"><?= $class_list[$joint[$id]["class"]] ?></td>
										    <td class="align-middle"><?= $show_weld_type[$joint[$id]["weld_type"]] ?></td>
										    <td class="align-middle font-weight-bold"><?= $value["G"] ?></td>
										    <td class="align-middle"><?= $value["H"] ?></td>
										    <td class="align-middle"><?= $value["I"] ?></td>

										    <td class="align-middle">
										    	<?= $master_report_number[$joint[$id]["project"]][$joint[$id]["discipline"]][$joint[$id]["type_of_module"]]['fitup_report'].str_pad(substr($value['L'],-6), 6, '0', STR_PAD_LEFT) ?>
										    	<input type="hidden" class="form-control" name="report_number[]" value="<?= str_pad(substr($value['L'],-6), 6, '0', STR_PAD_LEFT) ?>" required>
										    	<input type="hidden" class="form-control" name="submission_id[]" value="<?= $master_report_number[$joint[$id]["project"]][$joint[$id]["discipline"]][$joint[$id]["type_of_module"]]['fitup_report'].str_pad(substr($value['L'],-6), 6, '0', STR_PAD_LEFT) ?>">
										    </td>

										    <td class="align-middle">
										    	<!-- <input type="hidden" name="wps_no[]" value="<?= implode(";", $id) ?>"> -->
										    	<select class="form-control select2" multiple name="wps_no[][]" required>
										    	<?php foreach ($wps_list as $key_wps_list => $value_wps_list) { ?>
										    		<option value="<?= $value_wps_list["id_wps"] ?>"
										    			<?= in_array($value_wps_list["wps_no"], $wps) ? 'selected' : '' ?>
										    		>
										    			<?= $value_wps_list["wps_no"] ?>
										    		</option>
										    	<?php } ?>
										    	</select>
										    	<?php unset($wps); ?>
										    </td>

										    <td class="align-middle">
										    	<select class="form-control select2" name="status_inspection[]" required>
										    		<option value="0" <?= $value["K"]=="PRODUCTION_RFI" ? "selected" : "" ?>>Production RFI</option>
										    		<option value="1" <?= $value["K"]=="PENDING_QC" ? "selected" : "" ?>>Pending QC</option>
										    		<option value="3" <?= $value["K"]=="ACC_QC" ? "selected" : "" ?>>Approved QC</option>
										    		<option value="5" <?= $value["K"]=="PENDING_CLIENT" ? "selected" : "" ?>>Pending Client</option>
										    		<option value="7" <?= $value["K"]=="ACC_CLIENT" ? "selected" : "" ?>>Approved Client</option>
										    	</select>
										    	<?php unset($wps); ?>
										    </td>

										    <td class="align-middle">
										    	<?= $user[$this->encryption->decrypt(strtr($value["M"], '.-~', '+=/')) ]["full_name"] ?>
										    	<input type="hidden" name="inspection_by[]" value="<?= $this->encryption->decrypt(strtr($value["M"], '.-~', '+=/')) ?>"
										    		<?= in_array($value["K"], [3, 5, 7]) ? 'required' : '' ?>
										    	>	
										    </td>
										    <td class="align-middle">
										    	<input class="form-control" type="date" name="inspection_datetime[]" value="<?= $value["N"] ?>"
										    		<?= in_array($value["K"], [3, 5, 7]) ? 'required' : '' ?>
										    	>	
										    </td>

										    <td class="align-middle">
										    	<?= $user[$this->encryption->decrypt(strtr($value["O"], '.-~', '+=/')) ]["full_name"] ?>
										    	<input type="hidden" name="client_inspection_by[]" value="<?= $this->encryption->decrypt(strtr($value["M"], '.-~', '+=/')) ?>">	
										    </td>
										    <td class="align-middle">
										    	<input <?= $value["K"] == 7 ? 'required' : '' ?> class="form-control" type="date" name="client_inspection_date[]" value="<?= $value["P"] ?>">	
										    </td>

										    <td class="align-middle">
										    	<input <?= $value["K"] == 7 ? 'required' : '' ?> class="form-control" type="date" name="date_request[]" value="<?= $value["Q"] ? $value["Q"] : $value["N"] ?>">	
										    </td>
										    <td class="align-middle">
										    	<?= implode("<br>-", $messages) ?>
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

                  <a href="<?= site_url('fitup/import_fitup') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
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