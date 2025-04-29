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
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <h6 class="card-title"> BTR - Preview Import Joint</h6>
            <hr>
            <form action="<?= site_url('btr/proceed_import_joint') ?>" method="post">
              <input type="hidden" name="drawing_no_btr" value="<?= $drawing_no_btr ?>">
              <input type="hidden" name="uniq_id_btr" value="<?= $uniq_id_btr ?>">
              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive overflow-auto">
                    <table class="table table-hover text-center">
                      <thead class="bg-green-smoe text-white">
                        <th>Drawing No</th>
                        <th>Drawing WM</th>
                        <th>Joint No</th>
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

                            // if (!isset($irn[$value['A']][$value['B']][$value['C']])) {
                            //   $disabled       = true;
                            //   $error_list[]   = "IRN Still Not Created for this Joint !";
                            // }

                            $key_data         = $value['A'] . '_' . $value['B'] . '_' . $value['C'];

                            if (in_array($key_data, $temp_data)) {
                              $disabled       = true;
                              $error_list[]   = "Duplicate Data Found on Excel !";
                            }

                            if (!isset($wp[$value['A']][$value['B']][$value['C']])) {
                              $disabled       = true;
                              $error_list[]   = "Joint not listed on Registered Workpack";
                            }

                            if (isset($btr[$value['A']][$value['B']][$value['C']])) {
                              $disabled       = true;
                              $error_list[]   = "Joint Already Inserted to BTR Signed";
                            }

                            if($drawing_no_btr != "") {
                              if($drawing_no_btr != $value['A']) {
                                $disabled       = true;
                                $error_list[]   = "Drawing Number not match! Should be ".$drawing_no_btr;
                              }
                            }

                            $temp_data[]      = $key_data;

                            $dbdata           = @$wp[$value['A']][$value['B']][$value['C']];


                            ?>
                            <tr class="<?= $disabled ? 'alert-warning' : '' ?>">
                              <td><?= $value['A'] ?>

                                <input type="hidden" name="drawing_no[<?= $key ?>]" value="<?= $value['A'] ?>" <?= $disabled ? 'disabled' : '' ?>>

                                <input type="hidden" name="uniq_id[<?= $key ?>]" value="<?= $list_uniq_id[$value['A']] ?>" <?= $disabled ? 'disabled' : '' ?>>

                                <input type="hidden" name="drawing_wm[<?= $key ?>]" value="<?= $value['B'] ?>" <?= $disabled ? 'disabled' : '' ?>>
                                <input type="hidden" name="id_joint[<?= $key ?>]" value="<?= $dbdata['id'] ?>" <?= $disabled ? 'disabled' : '' ?>>
                                <input type="hidden" name="project[<?= $key ?>]" value="<?= $dbdata['project'] ?>" <?= $disabled ? 'disabled' : '' ?>>
                                <input type="hidden" name="discipline[<?= $key ?>]" value="<?= $dbdata['discipline'] ?>" <?= $disabled ? 'disabled' : '' ?>>
                                <input type="hidden" name="module[<?= $key ?>]" value="<?= $dbdata['module'] ?>" <?= $disabled ? 'disabled' : '' ?>>
                                <input type="hidden" name="type_of_module[<?= $key ?>]" value="<?= $dbdata['type_of_module'] ?>" <?= $disabled ? 'disabled' : '' ?>>
                                <input type="hidden" name="company_id[<?= $key ?>]" value="<?= $dbdata['company_id_wp'] ?>" <?= $disabled ? 'disabled' : '' ?>>

                              </td>
                              <td><?= $value['B'] ?></td>
                              <td><?= $value['C'] ?></td>
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
                  <a href="<?= site_url('btr/import_joint') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
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