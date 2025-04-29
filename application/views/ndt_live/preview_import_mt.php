<style>
  th,
  td {
    vertical-align: middle !important;
  }

  .input_width {
    width: 200px;
  }
</style>

<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card rounded-0 shadow">
          <div class="card-header">
            <h6 class="m-0"><?= $meta_title ?></h6>
          </div>
          <div class="card-body">
            <form action="<?= site_url('ndt_live/submit_preview_mt') ?>" method="post">
              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive overflow-auto">
                    <table class="table table-hover text-center">
                      <thead class="bg-green-smoe text-white">
                        <tr>
                          <th>VENDOR</th>
                          <th>PROJECT</th>
                          <th>RFI NO.</th>
                          <th>DRAWING NO.</th>
                          <th>DRAWING REV.</th>
                          <th>DISCIPLINE</th>
                          <th>MODULE</th>
                          <th>TYPE OF MODULE</th>
                          <th>WELD MAP / LINE &amp; SPOOL NO</th>
                          <th>JOINT NO.</th>
                          <th>JOINT TYPE</th>
                          <th>SIZE / DIA</th>
                          <th>SCH</th>
                          <th>THK</th>

                          <th class="bg-success">standard code</th>
                          <th class="bg-success">procedure no</th>
                          <th class="bg-success">job desc</th>
                          <th class="bg-success">brand</th>
                          <th class="bg-success">model</th>
                          <th class="bg-success">serial no</th>
                          <th class="bg-success">sensivity</th>
                          <th class="bg-success">delivery condition</th>
                          <th class="bg-success">grade material</th>
                          <th class="bg-success">testing personel</th>
                          <th class="bg-success">certificate no</th>
                          <th class="bg-success">report no</th>
                          <th class="bg-success">date of inspection</th>
                          <th class="bg-success">testing location</th>
                          <th class="bg-success">pwht</th>
                          <th class="bg-success">job no</th>
                          <th class="bg-success">item tested</th>
                          <th class="bg-success">viewing condition</th>
                          <th class="bg-success">surface condition</th>
                          <th class="bg-success">surface temperature</th>
                          <th class="bg-success">applying current</th>
                          <th class="bg-success">magnetic current</th>
                          <th class="bg-success">consumable brand</th>
                          <th class="bg-success">batch number</th>
                          <th class="bg-success">medium</th>
                          <th class="bg-success">background</th>
                          <th class="bg-success">demagnetization</th>
                          <th class="bg-success">applicable particle</th>
                          <th class="bg-success">yoke expired calibration date</th>
                          <th class="bg-success">acceptance to spec</th>
                          <th class="bg-success">tested length</th>
                          <th class="bg-success">id welder</th>
                          <th class="bg-success">result</th>
                          <th class="bg-success">deffect length</th>
                          <th class="bg-success">deffect type</th>
                          <th class="bg-success">datum</th>
                          <th class="bg-success">inspection cat</th>
                          <th class="bg-success">remarks</th>
                          <th class="bg-warning">Error Message<br>(if any)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $error = 0; ?>
                        <?php foreach ($sheet as $key => $value) : ?>
                          <?php if ($value['A'] != "" && $key > 1) : ?>
                            <?php
                              $message = '';
                              if(!$welder[$value['AU']]['id_welder']){
                                $error = 1;
                                $message = 'Welder Not Registered!';
                              }
                            ?>
                            <tr class="<?= $message!='' ? 'alert-danger' : '' ?>">
                              <td class="font-weight-bold"><?= $value['B'] ?></td>
                              <td class="font-weight-bold"><?= $value['C'] ?></td>
                              <td class="font-weight-bold"><?= $value['D'] ?></td>
                              <td class="font-weight-bold"><?= $value['E'] ?></td>
                              <td class="font-weight-bold"><?= $value['F'] ?></td>
                              <td class="font-weight-bold"><?= $value['G'] ?></td>
                              <td class="font-weight-bold"><?= $value['H'] ?></td>
                              <td class="font-weight-bold"><?= $value['I'] ?></td>
                              <td class="font-weight-bold"><?= $value['J'] ?></td>
                              <td class="font-weight-bold"><?= $value['K'] ?></td>
                              <td class="font-weight-bold"><?= $value['L'] ?></td>
                              <td class="font-weight-bold"><?= $value['M'] ?></td>
                              <td class="font-weight-bold"><?= $value['N'] ?></td>
                              <td class="font-weight-bold"><?= $value['O'] ?></td>
                              <td>
                                <input type="hidden" name="id_mt[<?= $key ?>]" value="<?= $value['A'] ?>">

                                <input type="text" name="standard_code[<?= $key ?>]" class="form-control input_width" value="<?= $value['P'] ?>" >
                              </td>

                              <td>
                                <input type="text" name="procedure_no[<?= $key ?>]" class="form-control input_width" value="<?= $value['Q'] ?>" >
                              </td>

                              <td>
                                <input type="text" name="job_desc[<?= $key ?>]" class="form-control input_width" value="<?= $value['R'] ?>" >
                              </td>

                              <td>
                                <input type="text" name="brand[<?= $key ?>]" class="form-control input_width" value="<?= $value['S'] ?>" required><p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <input type="text" name="model[<?= $key ?>]" class="form-control input_width" value="<?= $value['T'] ?>" required><p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <input type="text" name="serial_no[<?= $key ?>]" class="form-control input_width" value="<?= $value['U'] ?>" required><p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <input type="text" name="sensivity[<?= $key ?>]" class="form-control input_width" value="<?= $value['V'] ?>" required><p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <input type="text" name="delivery_condition[<?= $key ?>]" class="form-control input_width" value="<?= $value['W'] ?>" >
                              </td>

                              <td>
                                <input type="text" name="grade_material[<?= $key ?>]" class="form-control input_width" value="<?= $value['X'] ?>" >
                              </td>

                              <td>
                                <input type="text" name="testing_personel[<?= $key ?>]" class="form-control input_width" value="<?= $value['Y'] ?>" >
                              </td>

                              <td>
                                <input type="text" name="certificate_no[<?= $key ?>]" class="form-control input_width" value="<?= $value['Z'] ?>" >
                              </td>

                              <td>
                                <input type="text" name="report_no[<?= $key ?>]" class="form-control input_width" value="<?= $value['AA'] ?>" required><p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <input type="date" name="date_of_inspection[<?= $key ?>]" class="form-control input_width" value="<?= $value['AB'] ?>" >
                              </td>

                              <td>
                                <input type="text" name="testing_location[<?= $key ?>]" class="form-control input_width" value="<?= $value['AC'] ?>" >
                              </td>

                              <td>
                                <input type="text" name="pwht[<?= $key ?>]" class="form-control input_width" value="<?= $value['AD'] ?>" required><p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <input type="text" name="job_no[<?= $key ?>]" class="form-control input_width" value="<?= $value['AE'] ?>" required><p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <input type="text" name="item_tested[<?= $key ?>]" class="form-control input_width" value="<?= $value['AF'] ?>" required><p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <input type="text" name="viewing_condition[<?= $key ?>]" class="form-control input_width" value="<?= $value['AG'] ?>" required><p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <input type="text" name="surface_condition[<?= $key ?>]" class="form-control input_width" value="<?= $value['AH'] ?>" required><p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <input type="text" name="surface_temperature[<?= $key ?>]" class="form-control input_width" value="<?= $value['AI'] ?>" required><p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <select name="applying_current[<?= $key ?>]" class="custom-select input_width" required>
                                  <option value="">---</option>
                                  <option value="1" <?= intval($value['AJ']) == "1" ? 'selected' : '' ?>>Continious</option>
                                  <option value="2" <?= intval($value['AJ']) == "2" ? 'selected' : '' ?>>Residual</option>
                                </select>
                                <p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <select name="magnetic_current[<?= $key ?>]" class="custom-select input_width" required>
                                  <option value="">---</option>
                                  <option value="1" <?= intval($value['AK']) == "1" ? 'selected' : '' ?>>AC</option>
                                  <option value="2" <?= intval($value['AK']) == "2" ? 'selected' : '' ?>>DC</option>
                                </select>
                                <p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <input type="text" name="consumable_brand[<?= $key ?>]" class="form-control input_width" value="<?= $value['AL'] ?>" required><p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>


                              <td>
                                <input type="text" name="batch_number[<?= $key ?>]" class="form-control input_width" value="<?= $value['AM'] ?>" required><p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>


                              <!--  45 -->
                              <td>
                                <input type="text" name="medium[<?= $key ?>]" class="form-control input_width" value="<?= $value['AN'] ?>" required><p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <input type="text" name="background[<?= $key ?>]" class="form-control input_width" value="<?= $value['AO'] ?>" required><p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <select name="demagnetization[<?= $key ?>]" class="custom-select input_width" required>
                                  <option value="">---</option>
                                  <option value="1" <?= intval($value['AP']) == "1" ? 'selected' : '' ?>>Yes</option>
                                  <option value="2" <?= intval($value['AP']) == "2" ? 'selected' : '' ?>>No</option>
                                </select>
                                <p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <select name="applicable_particle[<?= $key ?>]" class="custom-select input_width" required>
                                  <option value="">---</option>
                                  <option value="1" <?= intval($value['AQ']) == "1" ? 'selected' : '' ?>>Wet</option>
                                  <option value="2" <?= intval($value['AQ']) == "2" ? 'selected' : '' ?>>Dry</option>
                                </select>
                                <p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <input type="date" name="yoke_expired_calibration_date[<?= $key ?>]" class="form-control input_width" value="<?= $value['AR'] ?>" required><p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <input type="text" name="acceptance_to_spec[<?= $key ?>]" class="form-control input_width" value="<?= $value['AS'] ?>" required><p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <input type="number" name="tested_length[<?= $key ?>]" class="form-control input_width" value="<?= $value['AT'] ?>" required><p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <input type="hidden" name="id_welder[<?= $key ?>]" class="form-control input_width" 
                                  value="<?= $welder[$value['AU']]['id_welder'] ?>"
                                required>
                                <b><?= $value['AU'] ?></b>
                              </td>

                              <td>
                                <select name="result[<?= $key ?>]" class="custom-select input_width" required>
                                  <option value="">---</option>
                                  <option value="1" <?= intval($value['AV']) == "1" ? 'selected' : '' ?>>ACC</option>
                                  <option value="2" <?= intval($value['AV']) == "2" ? 'selected' : '' ?>>REJ</option>
                                </select>
                                <p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <input type="text" name="deffect_length[<?= $key ?>]" class="form-control input_width" value="<?= $value['AW'] ?>">
                              </td>

                              <td>
                                <select name="deffect_type[<?= $key ?>]" class="custom-select input_width">
                                  <option value="">---</option>
                                  <?php foreach ($deffect_list as $v) : ?>
                                    <option value="<?= $v['id'] ?>" <?= $v['id'] == intval($value['CC']) ? 'selected' : ''  ?>><?= $v['ctq_description'] ?></option>
                                  <?php endforeach; ?>
                                </select>
                              </td>

                              <td>
                                <input type="text" name="datum[<?= $key ?>]" class="form-control input_width" value="<?= $value['AY'] ?>">
                              </td>

                              <td>
                                <input type="text" name="inspection_cat[<?= $key ?>]" class="form-control input_width" value="<?= $value['AZ'] ?>" >
                              </td>

                              <td>
                                <textarea name="remarks[<?= $key ?>]" class="form-control input_width"><?= $value['BA'] ?></textarea>

                              </td>

                              <td>
                                <?= $message ?>
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
                  <?php if($error==0){ ?>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Submit</button>
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

<script>
  $('form').on('submit', function() {
    $('button[type="submit"]').attr('disabled', true)
  })
</script>