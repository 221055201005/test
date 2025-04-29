<div id="content" class="container-fluid">
  <div class="row">
    <div class="col-md">
      <div class="card my-2 border-0 shadow">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white p-2">
          <div class="row mb-1">
            <div class="col-md">
              <a href="<?= base_url() ?>home/load_data_status_surveyor_excel/<?= $process ?>/<?= $discipline ?>/<?= $id_surveyor_status ?>" class="btn btn-sm btn-success btn-flat" target="_blank"><i class="fas fa-download"></i> Download</a>
            </div>
          </div>
          <table id="table_piecemark_list" class="table table-hover text-center dataTable">
            <thead class="bg-green-smoe text-white">
              <tr>
                <th>Drawing GA/AS</th>
                <th>Drawing WM</th>
                <th>Joint No.</th>
                <th>Deck Elevation / Service Line</th>
                <th>Row</th>
                <th>Column</th>
                <?php if($process == 'fitup'): ?>
                  <th>Weld Length</th>
                <?php endif; ?>
                <?php if($column_date_name == ''): ?>
                  <?php if($process == 'fitup'): ?>
                    <th>Ready to Fitup Date</th>
                  <?php else: ?>
                    <th>Inspection Date Fit Up</th>
                  <?php endif; ?>
                <?php else: ?>
                  <th><?= $column_date_name ?></th>
                <?php endif; ?>
                <th>Outstanding Days</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<script>
  $('.dataTable').DataTable({
    order: [],
    processing: true,
    serverSide: true,
    ajax: {
      url: "<?php echo base_url();?>home/surveyor_status_detail_datatable/<?= $process ?>/<?= $discipline ?>/<?= $id_surveyor_status ?>",
      type: "POST",
    },
  });
</script>