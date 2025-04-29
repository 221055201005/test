<?php
	$input_name = ['standart_code', 'procedure_no', 'job_desc', 'job_no', 'date_of_inspection', 'testing_location', 'grade_material', 'delivery_condition', 'status_pwht', 'part_name', 'size_part', 'sch', 'matl_type', 'matl_thk', 'unit_matl_thk', 'weld_thk', 'unit_weld_thk', 'reinforc_thk', 'unit_reinforc_thk', 'backing_ring', 'manufacture', 'type_of_film', 'dimension', 'total_of_film', 'lead', 'thickness', 'unit_thickness', 'isotope', 'isotope_other', 'activity', 'activity_kv', 'current_a', 'size_focal_spot', 'technique', 'geometric_unsharpness', 'sfd', 'exposure', 'viewing', 'exposure_time', 'exposure_time_ismnt', 'min_sod', 'min_dssof', 'no_film_holder', 'type_of_penetrameter', 'wire', 'wire_no', 'placement', 'block_thickness', 'marker_placement', 'use_back_scatter', 'technique_sketch', 'other_technique_sketch', 'inspection_category', 'total_length', 'tested_length', 'welding_process', 'welder_id', 'result', 'density_iqi', 'density_iqi_max', 'density_iqi_min', 'sensitivity', 'discontinuities_type', 'remarks'];
?>
<style>
  th,
  td {
    vertical-align: middle !important;
		white-space: nowrap;
  }
</style>

<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <h6 class="card-title"><?= $meta_title ?></h6>
            <hr>
            <form action="<?= site_url('ndt_live/ndt_rt_import_process') ?>" method="post">
              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive overflow-auto">
                    <table class="table table-hover text-center">
                      <thead class="bg-green-smoe text-white">
												<?php foreach ($column as $value): ?>
													<th><?= strtoupper($value) ?></th>
												<?php endforeach ?>
                        <th>Status</th>
                      </thead>
                      <tbody>
                        <?php foreach ($sheet as $key => $value) : ?>
                          <?php if ($key > 1 && $value['A'] != "") : ?>
                            <?php
															$error_list   = [];
															$disabled     = false;

															if(!$welder[$value['BO']]['id_welder']){
																$error_list[] = "Welder Not Registered";
																$disabled     = true;
                              }
                            ?>
                            <tr class="<?= $disabled ? 'alert-warning' : '' ?>">
															<input type="hidden" name="id_rt[<?= $key ?>]" value='<?= $value['A'] ?>' <?= $disabled ? 'disabled' : 'required' ?>>
                              <td><?= $value['B'] ?></td>
                              <td><?= $value['C'] ?></td>
                              <td><?= $value['D'] ?></td>
                              <td><?= $value['E'] ?></td>
                              <td><?= $value['F'] ?></td>
                              <td><?= $value['G'] ?></td>
                              <td><?= $value['H'] ?></td>
                              <td><?= $value['I'] ?></td>
                              <td>
                                <input type="text" name="report_no[<?= $key ?>]" id="" class="form-control" value="<?= $value['J'] ?>"  <?= $disabled ? 'disabled' : '' ?>>
                              </td>
															<?php 
																$start_col = 'J';
																foreach ($input_name as $input): 
																	$start_col++;
															?>
																<td>
																	<input type="text" name="<?= $input ?>[<?= $key ?>]" id="" class="form-control" value="<?= $value[$start_col] ?>"  <?= $disabled ? 'disabled' : '' ?> <?= $start_col=='BO' ? 'readonly' : '' ?>>
																</td>
															<?php endforeach ?>
                              <td>
                                <ul>
                                  <?php foreach ($error_list as $v): ?> 
                                   <li class="text-danger font-weight-bold"><?= $v ?></li>
                                   <?php endforeach; ?>
                                </ul>
                              </td>
                            </tr>
                          <?php endif; ?>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-md-12 text-right">
                  <hr>
                  <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Submit</button>
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
  $('form').on('submit', function() {
    $('button[type=submit]').attr('disabled', true)
  })
</script>
