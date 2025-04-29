<style>
    th,
    td {
        vertical-align: middle !important;
    }
</style>
<?= test_var($data_mis['unique_no'], 1); ?>
<div id="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title">Preview Update MV by Template</h6>
                        <hr>
                        <form action="<?= site_url('material_verification/proceed_update_by_template') ?>" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive overflow-auto">
                                        <table class="table table-hover text-center">
                                            <thead class="bg-gray-table">
                                                <th>Project</th>
                                                <th>Drawing GA</th>
                                                <th>Drawing AS</th>
                                                <th>Drawing SP</th>
                                                <th>Part ID</th>
                                                <th>Discipline</th>
                                                <th>Module</th>
                                                <th>Type of Module</th>
                                                <th>Deck Elevation / Service Line</th>
                                                <th>Unique No</th>
                                                <th>Status</th>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($sheet as $key => $value) : ?>
                                                    <?php if ($key > 1) : ?>

                                                        <?php

                                                        $error_list   = [];
                                                        $disabled     = false;
                                                        $key_data     = decrypt($value['A']);
                                                        if (!$key_data) {
                                                            $error_list[] = "Missing Key Data. Please Re Update Excel File";
                                                            $disabled     = true;
                                                        }
                                                        if ($value['K'] == "") {
                                                            $disabled     = false;
                                                        } else if (!isset($data_mis[$data_mv[$key_data]['project_code']][$value['K']])) {
                                                            $error_list[] = "Unique no isn't correct!";
                                                            $disabled     = true;
                                                        }
                                                        ?>
                                                        <tr class="<?= $disabled ? 'alert-warning' : '' ?>">
                                                            <td>
                                                                <input type="hidden" name="key_data[]" value='<?= $key_data ?>' <?= $disabled ? 'disabled' : 'required' ?>>
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
                                                            <td>
                                                                <input type="text" name="" id="" class="form-control" value="<?= $value['K'] ?>" disabled>
                                                                <input type="hidden" name="unique_material_no[]" id="" class="form-control" value="<?= $data_mis[$data_mv[$key_data]['project_code']][$value['K']]['id_mis_det'] ?>" <?= $disabled ? 'disabled' : 'readonly' ?>>
                                                            </td>

                                                            <td>
                                                                <ul>
                                                                    <?php foreach ($error_list as $v) : ?>
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