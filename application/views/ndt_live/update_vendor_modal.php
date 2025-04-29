<form action="<?= site_url('ndt_live/update_process_ndt_vendor') ?>" method="post">
    <div class="row">
        <div class="col-md-12">
            <input type="hidden" class="form-control" name="uniq_id_rfi" value="<?= $data_ndt['uniq_id_rfi'] ?>">
            <input type="hidden" class="form-control" name="method" value="<?= $method ?>">
            <div class="form-group row">
                <label for="" class="col-xl-4 col-form-label text-muted">RFI No</label>
                <div class="col-xl">
                    <input readonly type="text" class="form-control" name="rfi_no" value="<?= $rfi_no ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-xl-4 col-form-label text-muted">Project</label>
                <div class="col-xl">
                    <input readonly type="text" class="form-control" name="id_project" value="<?= $project[$data_ndt['id_project']]['project_name'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-xl-4 col-form-label text-muted">Drawing No</label>
                <div class="col-xl">
                    <input readonly type="text" class="form-control" name="drawing_no" value="<?= $data_ndt['drawing_no'] ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="" class="col-xl-4 col-form-label text-muted">NDT Vendor</label>
                <div class="col-xl">
                    <select class="select2 form-control" name="id_vendor" required="">
                        <option value="">---</option>
                        <?php foreach ($company_list as $value) { ?>
                            <option value="<?= $value['id_company'] ?>" <?= $data_ndt['id_vendor'] == $value['id_company'] ? "selected" : "" ?>><?= $value['company_name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <?php
            $date_transmittal_inspection = DATE('Y-m-d', strtotime($data_ndt['transmittal_inspection_datetime']));
            $time_transmittal_inspection = DATE('H:i', strtotime($data_ndt['transmittal_inspection_datetime']));
            ?>
            <div class="form-group row">
                <label for="" class="col-xl-4 col-form-label text-muted">NDT RFI Date</label>
                <div class="col-xl">
                    <input type="date" class="form-control" name="date_transmittal_inspection" value="<?= $date_transmittal_inspection ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-xl-4 col-form-label text-muted">NDT RFI Time</label>
                <div class="col-xl">
                    <input type="time" class="form-control" name="time_transmittal_inspection" value="<?= $time_transmittal_inspection ?>">
                </div>
            </div>
        </div>
        <div class="col-md-12"></div>
        <div class="col-md-12 text-right">
            <hr>
            <button class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
            <button type="submit" class="btn btn-warning"><i class="fas fa-paper-plane"></i> Save</button>
        </div>
    </div>
</form>

<script>
    $('.select2').select2({
        theme: 'bootstrap'
    })
    $(document).ready(function() {
        $('form').on('submit', function() {
            $('button[type=submit]').attr('disabled', true)
        })
    })
</script>