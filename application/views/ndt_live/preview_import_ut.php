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
            <form action="<?= site_url('ndt_live/submit_preview_ut') ?>" method="post">
              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive overflow-auto">
                    <table class="table table-hover text-center">
                      <thead class="bg-green-smoe text-white">
                        <tr>
                          <th rowspan="2">VENDOR</th>
                          <th rowspan="2">PROJECT</th>
                          <th rowspan="2">RFI NO.</th>
                          <th rowspan="2">DRAWING NO.</th>
                          <th rowspan="2">DRAWING REV.</th>
                          <th rowspan="2">DISCIPLINE</th>
                          <th rowspan="2">MODULE</th>
                          <th rowspan="2">TYPE OF MODULE</th>
                          <th rowspan="2">WELD MAP / LINE &amp; SPOOL NO</th>
                          <th rowspan="2">JOINT NO.</th>
                          <th rowspan="2">JOINT TYPE</th>
                          <th rowspan="2">SIZE / DIA</th>
                          <th rowspan="2">SCH</th>
                          <th rowspan="2">THK</th>
                          <th class="bg-success" rowspan="2">STANDARD / CODE</th>
                          <th class="bg-success" rowspan="2">REPORT NO.</th>
                          <th class="bg-success" rowspan="2">DATE TESTED</th>
                          <th class="bg-success" rowspan="2">TESTING LOCATION</th>
                          <th class="bg-success" rowspan="2">JOB NO.</th>
                          <th class="bg-success" rowspan="2">PROCEDURE NO.</th>
                          <th class="bg-success" rowspan="2">ITEM TESTED</th>
                          <th class="bg-success" rowspan="2">PWHT STATUS</th>
                          <th class="bg-success" rowspan="2">JOB DESCRIPTION</th>
                          <th class="bg-success" rowspan="2">TESTING PERSONNEL</th>
                          <th class="bg-success" rowspan="2">CERTIFICATE NO</th>
                          <th class="bg-secondary" colspan="5">SPECIMENT DATA</th>
                          <th class="bg-success" colspan="8">PROBES 0</th>
                          <th class="bg-success" colspan="8">PROBES 45</th>
                          <th class="bg-success" colspan="8">PROBES 60</th>
                          <th class="bg-success" colspan="8">PROBES 70</th>

                          <th class="bg-success" rowspan="2">COUPLANT</th>
                          <th class="bg-success" rowspan="2">BRAND</th>
                          <th class="bg-success" rowspan="2">CALIBRATION BLOCK</th>
                          <th class="bg-success" rowspan="2">MODEL</th>
                          <th class="bg-success" rowspan="2">REFERENCE BLOCK S/N</th>
                          <th class="bg-success" rowspan="2">SERIAL NO.</th>
                          <th class="bg-success" rowspan="2">CALIBRATION BLOCK THICKNESS</th>
                          <th class="bg-success" rowspan="2">SENSITIVITY</th>
                          <th class="bg-success" rowspan="2">EVALUATION LEVEL</th>
                          <th class="bg-success" rowspan="2">RECORDING LEVEL</th>
                          <th class="bg-success" rowspan="2">SCANNING TECHNIQUE</th>
                          <th class="bg-success" rowspan="2">TOTAL LENGTH</th>
                          <th class="bg-success" rowspan="2">TESTED LENGTH</th>
                          <th class="bg-success" rowspan="2">WELDER ID</th>
                          <th class="bg-success" rowspan="2">WELDING PROCESS</th>
                          <th class="bg-success" rowspan="2">DEFECT LENGTH</th>
                          <th class="bg-success" rowspan="2">DEFECT DEPTH</th>
                          <th class="bg-success" rowspan="2">DEFECT TYPE</th>
                          <th class="bg-success" rowspan="2">RESULT (1 : ACC, 2 : REJ)</th>
                          <th class="bg-success" rowspan="2">INSPECTION CATEGORY</th>
                          <th class="bg-success" rowspan="2">REMARKS</th>
                          <th class="bg-warning text-dark" rowspan="2">STATUS</th>
                        </tr>
                        <tr>
                          <th class="bg-secondary">GRADE MATERIAL</th>
                          <th class="bg-secondary">DELIVERY CONDITION</th>
                          <th class="bg-secondary">SURFACE PROTECTION</th>
                          <th class="bg-secondary">TEMPERATURE</th>
                          <th class="bg-secondary">HOLDING TIME</th>
                          <th class="bg-success">SERIAL NO.</th>
                          <th class="bg-success">TYPE</th>
                          <th class="bg-success">SIZE (MM)</th>
                          <th class="bg-success">FREQUENCY</th>
                          <th class="bg-success">REFERENCE (DB)</th>
                          <th class="bg-success">TR LOSS</th>
                          <th class="bg-success">SCAN</th>
                          <th class="bg-success">RANGE / F.S.L</th>
                          <th class="bg-success">SERIAL NO.</th>
                          <th class="bg-success">TYPE</th>
                          <th class="bg-success">SIZE (MM)</th>
                          <th class="bg-success">FREQUENCY</th>
                          <th class="bg-success">REFERENCE (DB)</th>
                          <th class="bg-success">TR LOSS</th>
                          <th class="bg-success">SCAN</th>
                          <th class="bg-success">RANGE / F.S.L</th>
                          <th class="bg-success">SERIAL NO.</th>
                          <th class="bg-success">TYPE</th>
                          <th class="bg-success">SIZE (MM)</th>
                          <th class="bg-success">FREQUENCY</th>
                          <th class="bg-success">REFERENCE (DB)</th>
                          <th class="bg-success">TR LOSS</th>
                          <th class="bg-success">SCAN</th>
                          <th class="bg-success">RANGE / F.S.L</th>
                          <th class="bg-success">SERIAL NO.</th>
                          <th class="bg-success">TYPE</th>
                          <th class="bg-success">SIZE (MM)</th>
                          <th class="bg-success">FREQUENCY</th>
                          <th class="bg-success">REFERENCE (DB)</th>
                          <th class="bg-success">TR LOSS</th>
                          <th class="bg-success">SCAN</th>
                          <th class="bg-success">RANGE / F.S.L</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $disabled_all = false; foreach ($sheet as $key => $value) : ?>
                          <?php if ($value['A'] != "" && $key > 2) : ?>
                            <?php 
                              
                              $disabled   = false;
                              $error_list = [];

                              if(!isset($welder[$value['BY']])) {
                                $disabled = true;
                                $error_list[] = "Welder Not Found in Register !!";
                              }

                              if($disabled) {
                                $disabled_all = true;
                              }

                              
                            ?>
                            <tr class="<?= $disabled ? 'alert-warning' : '' ?>">
                              <td><?= $value['B'] ?></td>
                              <td><?= $value['C'] ?></td>
                              <td><?= $value['D'] ?></td>
                              <td><?= $value['E'] ?></td>
                              <td><?= $value['F'] ?></td>
                              <td><?= $value['G'] ?></td>
                              <td><?= $value['H'] ?></td>
                              <td><?= $value['I'] ?></td>
                              <td><?= $value['J'] ?></td>
                              <td><?= $value['K'] ?></td>
                              <td><?= $value['L'] ?></td>
                              <td><?= $value['M'] ?></td>
                              <td><?= $value['N'] ?></td>
                              <td><?= $value['O'] ?></td>
                              <td>
                                <input type="hidden" name="id_ut[<?= $key ?>]" value="<?= $value['A'] ?>">
                                <input type="text" name="standart_code[<?= $key ?>]" class="form-control input_width" value="<?= $value['P'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="report_no[<?= $key ?>]" class="form-control input_width" value="<?= $value['Q'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="date" name="tested_date[<?= $key ?>]" class="form-control input_width" value="<?= $value['R'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="testing_location[<?= $key ?>]" class="form-control input_width" value="<?= $value['S'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="job_no[<?= $key ?>]" class="form-control input_width" value="<?= $value['T'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="procedure_no[<?= $key ?>]" class="form-control input_width" value="<?= $value['U'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="item_tested[<?= $key ?>]" class="form-control input_width" value="<?= $value['V'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="pwht_status[<?= $key ?>]" class="form-control input_width" value="<?= $value['W'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="job_desc[<?= $key ?>]" class="form-control input_width" value="<?= $value['X'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="testing_personnel[<?= $key ?>]" class="form-control input_width" value="<?= $value['Y'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="certificate_no[<?= $key ?>]" class="form-control input_width" value="<?= $value['Z'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="grade_material[<?= $key ?>]" class="form-control input_width" value="<?= $value['AA'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="delivery_condition[<?= $key ?>]" class="form-control input_width" value="<?= $value['AB'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="surface_protection[<?= $key ?>]" class="form-control input_width" value="<?= $value['AC'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="temperature[<?= $key ?>]" class="form-control input_width" value="<?= $value['AD'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="holding_time[<?= $key ?>]" class="form-control input_width" value="<?= $value['AE'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="serial_no_0[<?= $key ?>]" class="form-control input_width" value="<?= $value['AF'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="type_0[<?= $key ?>]" class="form-control input_width" value="<?= $value['AG'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="size_0[<?= $key ?>]" class="form-control input_width" value="<?= $value['AH'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="frequency_0[<?= $key ?>]" class="form-control input_width" value="<?= $value['AI'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="reference_0[<?= $key ?>]" class="form-control input_width" value="<?= $value['AJ'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="tr_loss_0[<?= $key ?>]" class="form-control input_width" value="<?= $value['AK'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="scan_0[<?= $key ?>]" class="form-control input_width" value="<?= $value['AL'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>


                              <td>
                                <input type="text" name="range_fsl_0[<?= $key ?>]" class="form-control input_width" value="<?= $value['AM'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>


                              <!--  45 -->
                              <td>
                                <input type="text" name="serial_no_45[<?= $key ?>]" class="form-control input_width" value="<?= $value['AN'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="type_45[<?= $key ?>]" class="form-control input_width" value="<?= $value['AO'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="size_45[<?= $key ?>]" class="form-control input_width" value="<?= $value['AP'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="frequency_45[<?= $key ?>]" class="form-control input_width" value="<?= $value['AQ'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="reference_45[<?= $key ?>]" class="form-control input_width" value="<?= $value['AR'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="tr_loss_45[<?= $key ?>]" class="form-control input_width" value="<?= $value['AS'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="scan_45[<?= $key ?>]" class="form-control input_width" value="<?= $value['AT'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="range_fsl_45[<?= $key ?>]" class="form-control input_width" value="<?= $value['AU'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <!--  60 -->
                              <td>
                                <input type="text" name="serial_no_60[<?= $key ?>]" class="form-control input_width" value="<?= $value['AV'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="type_60[<?= $key ?>]" class="form-control input_width" value="<?= $value['AW'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="size_60[<?= $key ?>]" class="form-control input_width" value="<?= $value['AX'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="frequency_60[<?= $key ?>]" class="form-control input_width" value="<?= $value['AY'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="reference_60[<?= $key ?>]" class="form-control input_width" value="<?= $value['AZ'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="tr_loss_60[<?= $key ?>]" class="form-control input_width" value="<?= $value['BA'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="scan_60[<?= $key ?>]" class="form-control input_width" value="<?= $value['BB'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="range_fsl_60[<?= $key ?>]" class="form-control input_width" value="<?= $value['BC'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>



                              <!--  70 -->
                              <td>
                                <input type="text" name="serial_no_70[<?= $key ?>]" class="form-control input_width" value="<?= $value['BD'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="type_70[<?= $key ?>]" class="form-control input_width" value="<?= $value['BE'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="size_70[<?= $key ?>]" class="form-control input_width" value="<?= $value['BF'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="frequency_70[<?= $key ?>]" class="form-control input_width" value="<?= $value['BG'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="reference_70[<?= $key ?>]" class="form-control input_width" value="<?= $value['BH'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="tr_loss_70[<?= $key ?>]" class="form-control input_width" value="<?= $value['BI'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="scan_70[<?= $key ?>]" class="form-control input_width" value="<?= $value['BJ'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="range_fsl_70[<?= $key ?>]" class="form-control input_width" value="<?= $value['BK'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="couplant[<?= $key ?>]" class="form-control input_width" value="<?= $value['BL'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="brand[<?= $key ?>]" class="form-control input_width" value="<?= $value['BM'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="calibration_block[<?= $key ?>]" class="form-control input_width" value="<?= $value['BN'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="model[<?= $key ?>]" class="form-control input_width" value="<?= $value['BO'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="reference_block[<?= $key ?>]" class="form-control input_width" value="<?= $value['BP'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="calibration_serial_no[<?= $key ?>]" class="form-control input_width" value="<?= $value['BQ'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="calibration_block_thickness[<?= $key ?>]" class="form-control input_width" value="<?= $value['BR'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="sensitivity[<?= $key ?>]" class="form-control input_width" value="<?= $value['BS'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="evaluation_level[<?= $key ?>]" class="form-control input_width" value="<?= $value['BT'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="recording_level[<?= $key ?>]" class="form-control input_width" value="<?= $value['BU'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="scanning_technique[<?= $key ?>]" class="form-control input_width" value="<?= $value['BV'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="total_length[<?= $key ?>]" class="form-control input_width" value="<?= $value['BW'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="text" name="tested_length[<?= $key ?>]" class="form-control input_width" value="<?= $value['BX'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="hidden" name="id_welder[<?= $key ?>]" value="<?= $welder[$value['BY']]['id_welder'] ?>">
                                <?= $value['BY'] ?>
                              </td>

                              <td>
                                <input type="text" name="welding_process[<?= $key ?>]" class="form-control input_width" value="<?= $value['BZ'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <input type="number" step="any" name="defect_length[<?= $key ?>]" class="form-control input_width" value="<?= $value['CA'] ?>" <?= $disabled ? 'disabled' : '' ?>>
                              </td>

                              <td>
                                <input type="number" step="any" name="defect_depth[<?= $key ?>]" class="form-control input_width" value="<?= $value['CB'] ?>" <?= $disabled ? 'disabled' : '' ?>>
                              </td>

                              <td>
                                <select name="defect_type[<?= $key ?>]" class="custom-select input_width" <?= $disabled ? 'disabled' : '' ?>>
                                  <option value="">---</option>
                                  <?php foreach ($deffect_list as $v) : ?>
                                    <option value="<?= $v['id'] ?>" <?= $v['id'] == intval($value['CC']) ? 'selected' : ''  ?>><?= $v['ctq_description'] ?></option>

                                  <?php endforeach; ?>
                                </select>
                              </td>

                              <td>
                                <select name="result[<?= $key ?>]" class="custom-select input_width" <?= $disabled ? 'disabled' : 'required' ?>>
                                  <option value="">---</option>
                                  <option value="1" <?= intval($value['CD']) == "1" ? 'selected' : '' ?>>ACC</option>
                                  <option value="2" <?= intval($value['CD']) == "2" ? 'selected' : '' ?>>REJ</option>

                                </select>
                              </td>
                              <td>
                                <input type="text" name="inspection_cat[<?= $key ?>]" class="form-control input_width" value="<?= $value['CE'] ?>" <?= $disabled ? 'disabled' : 'required' ?>>
                              </td>

                              <td>
                                <textarea name="remarks[<?= $key ?>]" class="form-control input_width" <?= $disabled ? 'disabled' : '' ?>><?= $value['CF'] ?></textarea>
                              </td>
                              <td class="text-nowrap">
                                <ul>
                                  <?php foreach ($error_list as $v): ?> 
                                   <li class="text-danger font-weight-bold"> <?= $v ?></li>
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
                  <a href="<?= site_url('ndt_live/import_ndt/'.encrypt("UT")) ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                  <?php if ($disabled_all): ?> 
                   <span class="btn btn-danger"><i class="fas fa-times-circle"></i> Cannot Submit. Please Check Status Column !</span>
                    <?php else: ?>
                      <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Submit</button>
                   <?php endif; ?>
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