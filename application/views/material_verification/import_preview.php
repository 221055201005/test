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

<style>
  .input_width {
    width: 200px !important
  }

  .input_width_half {
    width: 80px !important
  }

  .sub_bg {
    background-color: #e1f2f1;
  }

  th,
  td {
    vertical-align: middle !important;
  }
</style>


<div id="content" style="overflow-x: hidden;">
  <div class="container-fluid">
    <div class="row ">
      <div class="col-md-12">
        <div class="card border-0 shadow">
          <div class="card-header">
            <h6 class="card-title m-0"><strong>Preview Import Material Verification</strong>
            </h6>
          </div>
          <div class="card-body">
            <form action="<?= site_url('material_verification/proceed_import_mv') ?>" method="post">
              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive overflow-auto">
                    <table class="table table-hover text-center">
                      <thead class="bg-gray-table">
                        <tr>
                          <th>DRAWING NO</th>
                          <th>DRAWING AS</th>
                          <th>DRAWING SP</th>
                          <th>DISCIPLINE</th>
                          <th>MODULE</th>
                          <th>TYPE OF MODULE</th>
                          <th>WORKPACK NO</th>
                          <th>PART ID</th>
                          <th>PIECEMARK GRADE</th>
                          <th>UNIQUE NO (FROM MIS)</th>
                          <th>STATUS INSPECTION</th>
                          <th>REPORT NUMBER</th>
                          <th>INSPECT BY</th>
                          <th>Inspection Date</th>
                          <th>CLIENT INSPECT BY</th>
                          <th>Client Inspection Date</th>
                          <th>Request Date</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $dup_report   = [];
                        $temp_report  = [];
                        $is_disabled = 0;
                        foreach ($sheet as $key => $value) : ?>
                          <?php

                          $total_disabled             = 0;
                          $error_list                 = [];

                          $value['A'] = decrypt($value['A']);
                          $value['N'] = decrypt($value['N']);
                          $value['P'] = decrypt($value['P']);
                          // $value['K'] = trim(str_replace(" ", "", $value['K']));

                          if (!$value['A']){
                            $total_disabled++;
                            $error_list[]   = "Wrong Key in Template File !!";
                          }

                          if($status_inspection[$value['L']]>1){
	                          if (!isset($user[$value['N']])) {
	                            $total_disabled++;
	                            $error_list[]   = "QC Inspector ID Not Found !!";
	                          }

	                          if ($value['P']){
	                            if (!isset($user[$value['P']])) {
	                              $total_disabled++;
	                              $error_list[]   = "Client Inspector ID Not Found !!";
	                            }
	                          }
	                        }

                          $id_pc = $value['A'];
                          if (!isset($pc[$id_pc])){
                            $total_disabled++;
                            $error_list[]   = "Piecemark Doesn't exist on System!";
                          }

                          if (isset($exist[$id_pc])){
                            $total_disabled++;
                            $error_list[] = "Piecemark exist on MV System!";
                          }

                          $report_key = $value['M'].'_'.$pc[$id_pc]["drawing_ga"];
                          if(!in_array($report_key, $temp_report)) {
                            $dup_report[$report_key][] = $value['M'];
                          }
                          $temp_report[] = $report_key;

                          if (COUNT($dup_report[$report_key]) > 1){
                            $total_disabled++;
                            $error_list[] = "Duplicate Report Number!";
                          }
                          $material_grade = $grade[$pc[$id_pc]['grade']];

                          $id_mis         = 0;
                          if(!isset($mis[$pc[$id_pc]['workpack_id']][$value['K']][$material_grade])){
                            $total_disabled++;
                            $error_list[] = "Unique Not Matching With MIS This Workpack !";
                          } else {
                            $id_mis       = $mis[$pc[$id_pc]['workpack_id']][$value['K']][$material_grade];
                          }

                          if ($total_disabled > 0){
                            $is_disabled++;
                          }

                          ?>
                          <tr class="<?= $total_disabled > 0 ? 'alert-warning' : '' ?>">
                            <td>
                              <input type="hidden" name="id_piecemark[<?= $key ?>]" value="<?= $value['A'] ?>">
                              <input type="hidden" name="drawing_no[<?= $key ?>]" value="<?= $pc[$id_pc]['drawing_ga'] ?>">
                              <input type="hidden" name="discipline[<?= $key ?>]" value="<?= $pc[$id_pc]['discipline'] ?>">
                              <input type="hidden" name="module[<?= $key ?>]" value="<?= $pc[$id_pc]['module'] ?>">
                              <input type="hidden" name="type_of_module[<?= $key ?>]" value="<?= $pc[$id_pc]['type_of_module'] ?>">
                              <input type="hidden" name="project_code[<?= $key ?>]" value="<?= $pc[$id_pc]['project'] ?>">
                              <input type="hidden" name="id_workpack[<?= $key ?>]" value="<?= $pc[$id_pc]['workpack_id'] ?>">

                              <input type="hidden" name="rev_ga[<?= $key ?>]" value="<?= $pc[$id_pc]['rev_ga'] ?>">
                              <input type="hidden" name="rev_as[<?= $key ?>]" value="<?= $pc[$id_pc]['rev_as'] ?>">
                              <input type="hidden" name="rev_sp[<?= $key ?>]" value="<?= $pc[$id_pc]['rev_sp'] ?>">
                              <input type="hidden" name="id_mis[<?= $key ?>]" value="<?= $id_mis ?>">

                              <?= $value['B'] ?>
                            </td>
                            <td><?= $value['C'] ?></td>
                            <td><?= $value['D'] ?></td>
                            <td><?= $value['E'] ?></td>
                            <td><?= $value['F'] ?></td>
                            <td><?= $value['G'] ?></td>
                            <td><?= $value['H'] ?></td>
                            <td><?= $value['I'] ?></td>
                            <td><?= $value['J'] ?></td>
                            <td><?= $value['K'] ?></td>
                            <td>
                            <input type="hidden" name="status_inspection[<?= $key ?>]" value="<?= $status_inspection[$value['L']] ?>">
                            <?= $value['L'] ?></td>
                            <td>
                              <?= $master_report_number[$pc[$id_pc]["project"]][$pc[$id_pc]["discipline"]][$pc[$id_pc]["type_of_module"]]['mv_no'] . '-' . str_pad(substr($value['M'], -6), 6, '0', STR_PAD_LEFT) ?>

                              <input type="hidden" class="form-control" name="report_number[<?= $key ?>]" value="<?= str_pad(substr($value['M'], -6), 6, '0', STR_PAD_LEFT) ?>">

                              <input type="hidden" class="form-control" name="submission_id[<?= $key ?>]" value="<?= $master_report_number[$pc[$id_pc]["project"]][$pc[$id_pc]["discipline"]][$pc[$id_pc]["type_of_module"]]['mv_no'].'-' . str_pad(substr($value['M'], -6), 6, '0', STR_PAD_LEFT) ?>">
                            </td>
                            <td>
                              <input type="hidden" name="inspection_by[<?= $key ?>]" value="<?= $value['N'] ?>">

                              <?= $user[$value['N']]['full_name'] ?>
                            </td>
                            <td>
                              <input type="hidden" name="inspection_datetime[<?= $key ?>]" value="<?= $value['O'] ?>">
                              <?= $value['O'] ?>
                            </td>
                            <td>
                              <input type="hidden" name="inspection_client_by[<?= $key ?>]" value="<?= $value['P'] ?>">

                              <?= $user[$value['P']]['full_name'] ?>
                            </td>
                            <td>
                              <input type="hidden" name="inspection_client_datetime[<?= $key ?>]" value="<?= $value['Q'] ?>">

                              <?= $value['Q'] ?>
                            </td>
                            <td>
                              <input type="hidden" name="request_date[<?= $key ?>]" value="<?= $value['R'] ?>">
                              <?= $value['R'] ?>
                            </td>
                            <td>
                              <ul>
                                <?php foreach ($error_list as $v) : ?>
                                  <li class="text-danger font-weight-bold"><?= $v ?></li>
                                <?php endforeach; ?>
                              </ul>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>

                  </div>
                </div>
                <div class="col-md-12">
                  <hr>
                  <div class="float-right">
                    <a href="<?= base_url() . "material_verification/import_material_verification/" ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                    <?php if ($is_disabled > 0) : ?>
                      <span class="btn btn-danger"><i class="fas fa-times"></i> Cannot Submit Data. Please Check Column Status</span>
                    <?php else : ?>
                      <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Submit</button>
                    <?php endif; ?>
                  </div>
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

<script>
  $(document).ready(function() {
    $("form").on('submit', function() {
      $('button[type=submit]').attr('disabled', true)
    })
  })

  function autocomplete_grade(input) {
    $(input).autocomplete({
      source: "<?php echo base_url(); ?>receiving/grade_autocomplete",
      autoFocus: true,
      classes: {
        "ui-autocomplete": "highlight"
      }
    });
  }

  function quick_change(select, module) {
    var value = select.value

    $(`select[name="${module}[<?= $key ?>]"]`).val(value).trigger('change')
    // if (value) {
    //   var option = document.getElementsByName(`${module}[]`)
    //   for (let index = 0; index < option.length; index++) {
    //     option[index].value = value
    //   }
    // }
  }
</script>