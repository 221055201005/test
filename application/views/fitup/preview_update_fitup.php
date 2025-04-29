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
            <h6 class="card-title">Preview Update Excel Fitup</h6>
            <hr>
            <form action="<?= site_url('fitup/proceed_update_fitup') ?>" method="post">
              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive overflow-auto">
                    <table class="table table-hover text-center">
                      <thead class="bg-green-smoe text-white">
                        <th>Project</th>
                        <th>Discipline</th>
                        <th>Module</th>
                        <th>Type of Module</th>
                        <th>Deck Elevation</th>
                        <th>Drawing Number</th>
                        <th>Drawing Weldmap</th>
                        <th>Joint No</th>
                        <th>WPS Number</th>
                        <th>Status</th>
                      </thead>
                      <tbody>
                      <tbody>

                        <?php
                        $error_list = [];

                        foreach ($sheet as $key => $value) : ?>
                          <?php if ($key > 1) :  ?>
                            <?php
                            $disabled = false;
                            $key_data = decrypt($value['A']);

                            if (!$key_data) {
                              $error_list[] = "Missing Key Data in row. Please Re Update Excel File";
                              $disabled = true;
                            }

                            $wps_check   = explode(";", $value['J']);
                            if (array_filter($wps_check)) {
                            foreach ($wps_check as $key_c => $value_c) {
                              if (!isset($data_wps[$value_c])) {
                                $error_list[] = "WPS Number isn't correct!";
                                $disabled     = true;
                                break;
                                }
                              }
                            }

                            $wps_check   = explode(";", $value['J']);
                            if (array_filter($wps_check)) {
                            foreach ($wps_check as $key_c => $value_c) {
                              if (($data_wps[$value_c]['discipline'] != $data_wps_discipline[$value['C']])) {
                                $error_list[] = "Discipline Drawing & WPS Not Match!";
                                $disabled     = true;
                                break;
                                }
                              }
                            }

                            ?>

                            <tr class="<?= $disabled ? 'alert-warning' : '' ?>">
                              <td>
                                <input type="hidden" name="key_data[<?= $key ?>]" value='<?= $key_data ?>' <?= $disabled ? 'disabled' : 'required' ?>>
                                <?= $value['B'] ?>
                              </td>
                              <td><?= $value['C'] ?></td>
                              <td><?= $value['D'] ?></td>
                              <td><?= $value['E'] ?></td>
                              <td><?= $value['F'] ?></td>
                              <td><?= $value['G'] ?></td>
                              <td><?= $value['H'] ?></td>
                              <td><?= $value['I'] ?></td>
                              <td>
                                <?php foreach ($wps_check as $key_check => $value_check): ?> 
                                  <input type="text" name="wps_no[<?= $key ?>][<?= $key_check ?>]" id="" class="form-control" value="<?= $value_check ?>" <?= $disabled ? 'disabled' : 'readonly' ?>>
                                 <?php endforeach; ?>
                              </td>
                              <td>
                                <ul>
                                  <?php if ($disabled) : ?>
                                    <?php foreach (array_unique($error_list) as $v) : ?>
                                      <li class="text-danger font-weight-bold"><?= $v ?></li>
                                    <?php endforeach; ?>
                                  <?php endif; ?>
                                </ul>
                              </td>
                            </tr>
                          <?php endif;  ?>
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