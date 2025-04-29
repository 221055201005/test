<div id="content">
  <div class="container-fluid">
    <div class="card border-0 shadow-sm">
      <div class="card-body">
        <h6 class="card-title"><?= $meta_title ?></h6>
        <hr>
        <form action="<?= site_url('additional_attachment/proceed_upload') ?>" enctype="multipart/form-data" method="post">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group row">
                <label for="" class="col-xl-3 col-form-label text-muted"> Category</label>
                <div class="col-xl">
                  <select name="id_type" class="select2" style="width:100%" required>
                    <option value="">---</option>
                    <?php foreach ($master_attachment as $key => $value) : ?>
                      <option value="<?= $value['id'] ?>"><?= $value['categories_desc'] ?> (<?= $value['sub_section'] ?>)</option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group row">
                <label for="" class="col-xl-3 col-form-label text-muted"> Deck Elevation / Service Line</label>
                <div class="col-xl">
                  <select name="deck_elevation" class="select2" style="width:100%">
                    <option value="">---</option>
                    <?php foreach ($deck_list as $key => $value) : ?>
                      <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group row">
                <label for="" class="col-xl-3 col-form-label text-muted"> Ecodoc No.</label>
                <div class="col-xl">
                  <input type="text" name="ecodoc_no" class="form-control" required>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group row">
                <label for="" class="col-xl-3 col-form-label text-muted"> Book / Volume</label>
                <div class="col-xl">
                  <input type="text" name="book_volume" class="form-control" required>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group row">
                <label for="" class="col-xl-3 col-form-label text-muted"> File Attachment
                  <br>
                  <span class="font-weight-bold" style="font-size: 11px"><i><span class="text-danger">*</span> (Multiple Allowed)</i></span>
                </label>
                <div class="col-xl">
                  <input type="file" name="attachment[]" multiple required>
                </div>
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

<script>
  $('form').on('submit', function() {
    $('button[type="submit"]').attr('disabled', true);
  })
  $(document).ready(function() {
    $("#table_client").DataTable({
      processing: true,
      serverSide: true,
      orderable: true,
      ajax: {
        url: "<?= site_url($serverside) ?>",
        type: "POST",
        data: {
          project_id: "<?= $project_id ?>",
          discipline: "<?= $discipline ?>",
          module: "<?= $module ?>",
          module_type: "<?= $module_type ?>",
          status_inspection: "<?= $status_inspection ?>",
          deck_elevation: "<?= $deck_elevation ?>",
          inspection_authority: "<?= implode(';', $inspection_authority) ?>",
          company: "<?= $company ?>",
        }
      }
    })
  })
</script>