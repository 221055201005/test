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
            <h6 class="m-0">Preview Import NDT UT</h6>
          </div>
          <div class="card-body">
            <form action="<?= site_url('ndt_live/submit_preview_pt') ?>" method="post">
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
                          <th class="bg-success">acceptance criteria</th>
                          <th class="bg-success">procedure no</th>
                          <th class="bg-success">job description</th>
                          <th class="bg-success">report no</th>
                          <th class="bg-success">date of inspection</th>
                          <th class="bg-success">testing location</th>
                          <th class="bg-success">job no</th>
                          <th class="bg-success">item tested</th>
                          <th class="bg-success">grade material</th>
                          <th class="bg-success">delivery condition</th>
                          <th class="bg-success">technichian</th>
                          <th class="bg-success">certificate no</th>
                          <th class="bg-success">penetrant system</th>
                          <th class="bg-success">penetrant type</th>
                          <th class="bg-success">penetrand type other</th>
                          <th class="bg-success">brand name</th>
                          <th class="bg-success">penetran</th>
                          <th class="bg-success">cleaner</th>
                          <th class="bg-success">developer</th>
                          <th class="bg-success">batch number</th>
                          <th class="bg-success">method precleaning</th>
                          <th class="bg-success">penetran applicable</th>
                          <th class="bg-success">light intensity</th>
                          <th class="bg-success">light source</th>
                          <th class="bg-success">dwell time</th>
                          <th class="bg-success">surface temp</th>
                          <th class="bg-success">developer app</th>
                          <th class="bg-success">developing time</th>
                          <th class="bg-success">time of examination</th>
                          <th class="bg-success">method remove excess penetran</th>
                          <th class="bg-success">batch no of penetrant</th>
                          <th class="bg-success">batch no of cleaner</th>
                          <th class="bg-success">batch no of developer</th>
                          <th class="bg-success">surface preparation</th>
                          <th class="bg-success">scope examination</th>
                          <th class="bg-success">tested length</th>
                          <th class="bg-success">welder id</th>
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
                              if(!$welder[$value['BA']]['id_welder']){
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
                                <input type="hidden" name="id_pt[<?= $key ?>]" value="<?= $value['A'] ?>">

                                <input type="text" name="standard_code[<?= $key ?>]" class="form-control input_width" value="<?= $value['P'] ?>" >
                              </td>

                              <td>
                                <input type="text" name="acceptance_criteria[<?= $key ?>]" class="form-control input_width" value="<?= $value['Q'] ?>" >
                              </td>

                              <td>
                                <input type="text" name="procedure_no[<?= $key ?>]" class="form-control input_width" value="<?= $value['R'] ?>" >
                              </td>

                              <td>
                                <input type="text" name="job_description[<?= $key ?>]" class="form-control input_width" value="<?= $value['S'] ?>" >
                              </td>

                              <td>
                                <input type="text" name="report_no[<?= $key ?>]" class="form-control input_width" value="<?= $value['T'] ?>" required>
                                <p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <input type="date" name="date_of_inspection[<?= $key ?>]" class="form-control input_width" value="<?= $value['U'] ?>" >
                              </td>

                              <td>
                                <input type="text" name="testing_location[<?= $key ?>]" class="form-control input_width" value="<?= $value['V'] ?>" >
                              </td>

                              <td>
                                <input type="text" name="job_no[<?= $key ?>]" class="form-control input_width" value="<?= $value['W'] ?>" required>
                                <p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <input type="text" name="item_tested[<?= $key ?>]" class="form-control input_width" value="<?= $value['X'] ?>" required>
                                <p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <input type="text" name="grade_material[<?= $key ?>]" class="form-control input_width" value="<?= $value['Y'] ?>" >
                              </td>

                              <td>
                                <input type="text" name="delivery_condition[<?= $key ?>]" class="form-control input_width" value="<?= $value['Z'] ?>" >
                              </td>

                              <td>
                                <input type="text" name="technichian[<?= $key ?>]" class="form-control input_width" value="<?= $value['AA'] ?>" >
                              </td>

                              <td>
                                <?php //test_var($value) ?>
                                <input type="text" name="certificate_no[<?= $key ?>]" class="form-control input_width" value="<?= $value['AB'] ?>" >
                              </td>

                              <td>
                                <select name="penetrant_system[<?= $key ?>]" class="custom-select input_width" required>
                                  <option value="">---</option>
                                  <option value="1" <?= intval($value['AC']) == "1" ? 'selected' : '' ?>>Coloured</option>
                                  <option value="2" <?= intval($value['AC']) == "2" ? 'selected' : '' ?>>Fluorescent</option>
                                </select>
                                <p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <select name="penetrant_type[<?= $key ?>][]" class="form-control select2" multiple required>
                                  <option value="">---</option>
                                  <option value="1" <?= in_array('1', explode(';', $value['AD'])) ? 'selected' : '' ?>>Visible</option>
                                  <option value="2" <?= in_array('2', explode(';', $value['AD'])) ? 'selected' : '' ?>>Solvent Removeable</option>
                                  <option value="3" <?= in_array('3', explode(';', $value['AD'])) ? 'selected' : '' ?>>other</option>
                                </select>
                                <p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <input type="text" name="penetrand_type_other[<?= $key ?>]" class="form-control input_width" value="<?= $value['AE'] ?>" >
                              </td>

                              <td>
                                <input type="text" name="brand_name[<?= $key ?>]" class="form-control input_width" value="<?= $value['AF'] ?>" required>
                                <p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <input type="text" name="penetran[<?= $key ?>]" class="form-control input_width" value="<?= $value['AG'] ?>" required>
                                <p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <input type="text" name="cleaner[<?= $key ?>]" class="form-control input_width" value="<?= $value['AH'] ?>" required>
                                <p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <input type="text" name="developer[<?= $key ?>]" class="form-control input_width" value="<?= $value['AI'] ?>" required>
                                <p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <input type="text" name="batch_number[<?= $key ?>]" class="form-control input_width" value="<?= $value['AJ'] ?>" required>
                                <p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <select name="method_precleaning[<?= $key ?>]" class="custom-select input_width" required>
                                  <option value="">---</option>
                                  <option value="0" <?= intval($value['AK']) == "0" ? 'selected' : '' ?>>NO</option>
                                  <option value="1" <?= intval($value['AK']) == "1" ? 'selected' : '' ?>>YES</option>
                                </select>
                                <p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <select name="penetran_applicable[<?= $key ?>]" class="custom-select input_width" required>
                                  <option value="">---</option>
                                  <option value="1" <?= intval($value['AL']) == "1" ? 'selected' : '' ?>>Brush</option>
                                  <option value="2" <?= intval($value['AL']) == "2" ? 'selected' : '' ?>>Spray</option>
                                </select>
                                <p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <input type="text" name="light_intensity[<?= $key ?>]" class="form-control input_width" value="<?= $value['AM'] ?>" required>
                                <p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <input type="text" name="light_source[<?= $key ?>]" class="form-control input_width" value="<?= $value['AN'] ?>" required>
                                <p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <input type="text" name="dwell_time[<?= $key ?>]" class="form-control input_width" value="<?= $value['AO'] ?>" required>
                                <p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <input type="text" name="surface_temp[<?= $key ?>]" class="form-control input_width" value="<?= $value['AP'] ?>" required>
                                <p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <select name="developer_app[<?= $key ?>]" class="custom-select input_width" required>
                                  <option value="">---</option>
                                  <option value="0" <?= intval($value['AQ']) == "0" ? 'selected' : '' ?>>No</option>
                                  <option value="1" <?= intval($value['AQ']) == "1" ? 'selected' : '' ?>>Yes</option>
                                </select>
                                <p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <input type="text" name="developing_time[<?= $key ?>]" class="form-control input_width" value="<?= $value['AR'] ?>" required>
                                <p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <select name="time_of_examination[<?= $key ?>]" class="custom-select input_width" required>
                                  <option value="">---</option>
                                  <option value="1" <?= intval($value['AS']) == "1" ? 'selected' : '' ?>>After Welding</option>
                                  <option value="2" <?= intval($value['AS']) == "2" ? 'selected' : '' ?>>After Hydro-test</option>
                                  <option value="3" <?= intval($value['AS']) == "3" ? 'selected' : '' ?>>After PWHT</option>
                                  <option value="4" <?= intval($value['AS']) == "4" ? 'selected' : '' ?>>Others</option>
                                </select>
                                <p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <input type="text" name="method_remove_excess_penetran[<?= $key ?>]" class="form-control input_width" value="<?= $value['AT'] ?>" required>
                                <p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <input type="text" name="batch_no_of_penetrant[<?= $key ?>]" class="form-control input_width" value="<?= $value['AU'] ?>" required>
                                <p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <input type="text" name="batch_no_of_cleaner[<?= $key ?>]" class="form-control input_width" value="<?= $value['AV'] ?>" required>
                                <p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <input type="text" name="batch_no_of_developer[<?= $key ?>]" class="form-control input_width" value="<?= $value['AW'] ?>">
                              </td>

                              <td>
                                <select name="surface_preparation[<?= $key ?>][]" class="form-control select2" multiple required>
                                  <option value="">---</option>
                                  <option value="1" <?= in_array('1', explode(';', $value['AX'])) ? 'selected' : '' ?>>As Welded</option>
                                  <option value="2" <?= in_array('2', explode(';', $value['AX'])) ? 'selected' : '' ?>>Machining</option>
                                  <option value="3" <?= in_array('3', explode(';', $value['AX'])) ? 'selected' : '' ?>>Grinding</option>
                                </select>
                                <p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <select name="scope_examination[<?= $key ?>]" class="custom-select input_width" required>
                                  <option value="1" <?= intval($value['AY']) == "1" ? 'selected' : '' ?>>Base Metal</option>
                                  <option value="2" <?= intval($value['AY']) == "2" ? 'selected' : '' ?>>Edge Prep</option>
                                  <option value="3" <?= intval($value['AY']) == "3" ? 'selected' : '' ?>>Back Chipping</option>
                                  <option value="4" <?= intval($value['AY']) == "4" ? 'selected' : '' ?>>Weld Part</option>
                                  <option value="5" <?= intval($value['AY']) == "5" ? 'selected' : '' ?>>Repair Weld</option>
                                  <option value="6" <?= intval($value['AY']) == "6" ? 'selected' : '' ?>>Others</option>
                                </select>
                                <p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <input type="text" name="tested_length[<?= $key ?>]" class="form-control input_width" value="<?= $value['AZ'] ?>" required>
                                <p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <input type="hidden" name="welder_id[<?= $key ?>]" class="form-control input_width" 
                                  value="<?= $welder[$value['BA']]['id_welder'] ?>"
                                required>
                                <b><?= $value['BA'] ?></b>
                                <p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>

                              <td>
                                <select name="result[<?= $key ?>]" class="custom-select input_width" required>
                                  <option value="">---</option>
                                  <option value="1" <?= intval($value['BB']) == "1" ? 'selected' : '' ?>>ACC</option>
                                  <option value="2" <?= intval($value['BB']) == "2" ? 'selected' : '' ?>>REJ</option>
                                </select>
                                <p class="text-danger" style="font-style: italic; font-weight: bold;">*Required</p>
                              </td>
                              <td>
                                <input type="text" name="deffect_length[<?= $key ?>]" class="form-control input_width" value="<?= $value['BC'] ?>">
                              </td>
                              <td>
                                <select name="deffect_type[<?= $key ?>]" class="custom-select input_width">
                                  <option value="">---</option>
                                  <?php foreach ($deffect_list as $v) : ?>
                                    <option value="<?= $v['id'] ?>" <?= $v['id'] == intval($value['BD']) ? 'selected' : ''  ?>><?= $v['ctq_description'] ?></option>
                                  <?php endforeach; ?>
                                </select>
                              </td>
                              <td>
                                <input type="text" name="datum[<?= $key ?>]" class="form-control input_width" value="<?= $value['BE'] ?>">
                              </td>
                              <td>
                                <input type="text" name="inspection_cat[<?= $key ?>]" class="form-control input_width" value="<?= $value['BF'] ?>">
                              </td>
                              <td>
                                <input type="text" name="remarks[<?= $key ?>]" class="form-control input_width" value="<?= $value['BG'] ?>">
                              </td>
                              <td><?= $message ?></td>

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