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
            <h6 class="card-title">Preview Update Mechanical Completion Ecodoc</h6>
            <hr>
            <form action="<?= site_url('mechanical_completion/update_ecodoc_process') ?>" method="post">
              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive overflow-auto">
                    <table class="table table-hover text-center">
                      <thead class="bg-green-smoe text-white">
                        <th>Event ID No</th>
                        <th>Project</th>
                        <th>Discipline</th>
                        <th>Module</th>
                        <th>Type of Module</th>
                        <th>Ecodoc Number</th>
                        <th>Status</th>
                      </thead>
                      <tbody>
                        <?php foreach ($sheet as $key => $value) : ?>
                          <?php if ($key > 1) : ?>
                            <?php
															$error_list   = [];
															$disabled     = false;

															if ($value['A'] == '') {
																$error_list[] = "Missing Event ID No";
																$disabled     = true;
															}
                            ?>
                            <tr class="<?= $disabled ? 'alert-warning' : '' ?>">
                              <td>
																<input type="hidden" name="event_id_no[<?= $key ?>]" value='<?= $value['A'] ?>' <?= $disabled ? 'disabled' : 'required' ?>>
																<?= $value['A'] ?>
															</td>
                              <td><?= $value['B'] ?></td>
                              <td><?= $value['C'] ?></td>
                              <td><?= $value['D'] ?></td>
                              <td><?= $value['E'] ?></td>
                              <td>
                                <input type="text" name="ecodoc_no[<?= $key ?>]" id="" class="form-control" value="<?= $value['F'] ?>"  <?= $disabled ? 'disabled' : '' ?>>
                              </td>
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
