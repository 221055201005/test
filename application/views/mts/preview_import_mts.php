<style>
  th,
  td {
    vertical-align: middle !important;
  }
</style>
<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 shadow">
          <div class="card-header">
            <h6 class="card-title m-0 font-weight-bold">MTS - Preview Import Piecemark</h6>
          </div>
          <div class="card-body">
            <form action="<?= site_url('mts/proceed_import_mts') ?>" method="post">
              <input type="hidden" name="drawing_no_mts" value="<?= $drawing_no_mts ?>">
              <input type="hidden" name="uniq_id_mts" value="<?= $uniq_id_mts ?>">
              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive overflow-auto">
                    <table class="table table-hover text-center">
                      <thead class="bg-green-smoe text-white">
                        <th>Drawing No</th>
                        <th>Piecemark No</th>
                        <th>Deck Elevation / Service Line</th>
                        <th>Status</th>
                      </thead>
                      <tbody>
                        <?php
                        $temp_data = [];
                        foreach ($sheet as $key => $value) : ?>
                          <?php if ($key > 1 && $value['A'] != "") : ?>
                            <?php

                            $disabled    = false;
                            $error_list  = [];

                            $key_data         = $value['A'] . '_' . $value['B'];

                            if (in_array($key_data, $temp_data)) {
                              $disabled       = true;
                              $error_list[]   = "Duplicate Data Found on Excel !";
                            }

                            if (!isset($wp[$value['A']][$value['B']])) {
                              $disabled       = true;
                              $error_list[]   = "Piecemark not listed on Registered Workpack";
                            }

                            if (!isset($pc[$value['A']][$value['B']])) {
                              $disabled       = true;
                              $error_list[]   = "Piecemark Not Found for This Drawing";
                            }

                            if (isset($mts[$value['A']][$value['B']])) {
                              $disabled       = true;
                              $error_list[]   = "Piecemark Already Inserted to MTS Signed";
                            }

                            if($drawing_no_mts != "") {
                              if($drawing_no_mts != $value['A']) {
                                $disabled       = true;
                                $error_list[]   = "Drawing Number not match! Should be ".$drawing_no_mts;
                              }
                            }

                            $temp_data[]      = $key_data;

                            $dbdata           = @$wp[$value['A']][$value['B']];


                            ?>
                            <tr class="<?= $disabled ? 'alert-warning' : '' ?>">
                              <td><?= $value['A'] ?>

                                <input type="hidden" name="drawing_no[<?= $key ?>]" value="<?= $value['A'] ?>" <?= $disabled ? 'disabled' : '' ?>>

                                <input type="hidden" name="uniq_id[<?= $key ?>]" value="<?= $list_uniq_id[$value['A']] ?>" <?= $disabled ? 'disabled' : '' ?>>
                                <input type="hidden" name="deck_elevation[<?= $key ?>]" value="<?= $pc[$value['A']][$value['B']]['deck_elevation'] ?>" <?= $disabled ? 'disabled' : '' ?>>

                                <input type="hidden" name="id_piecemark[<?= $key ?>]" value="<?= $dbdata['id'] ?>" <?= $disabled ? 'disabled' : '' ?>>
                                <input type="hidden" name="project[<?= $key ?>]" value="<?= $dbdata['project'] ?>" <?= $disabled ? 'disabled' : '' ?>>
                                <input type="hidden" name="discipline[<?= $key ?>]" value="<?= $dbdata['discipline'] ?>" <?= $disabled ? 'disabled' : '' ?>>
                                <input type="hidden" name="module[<?= $key ?>]" value="<?= $dbdata['module'] ?>" <?= $disabled ? 'disabled' : '' ?>>
                                <input type="hidden" name="type_of_module[<?= $key ?>]" value="<?= $dbdata['type_of_module'] ?>" <?= $disabled ? 'disabled' : '' ?>>
                                <input type="hidden" name="company_id[<?= $key ?>]" value="<?= $dbdata['company_id_wp'] ?>" <?= $disabled ? 'disabled' : '' ?>>

                              </td>
                              <td><?= $value['B'] ?></td>
                              <td><?= $deck[$pc[$value['A']][$value['B']]['deck_elevation']]['name'] ?></td>
                              <td class="text-left">
                                <ul>
                                  <?php foreach ($error_list as $v) : ?>
                                    <li class="font-weight-bold"><?= $v ?></li>
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
                  <a href="<?= site_url('mts/import_piecemark') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
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