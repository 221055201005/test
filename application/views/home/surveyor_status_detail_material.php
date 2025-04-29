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
              <a href="<?= base_url() ?>home/load_data_status_surveyor_material_excel/<?= $discipline ?>" class="btn btn-sm btn-success btn-flat" target="_blank"><i class="fas fa-download"></i> Download</a>
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
                <th>Weld Length</th>
                <th>Status POS#1</th>
                <th>Status POS#2</th>
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
      url: "<?php echo base_url();?>home/surveyor_status_detail_material_datatable/<?= @$discipline ?>",
      type: "POST",
    },
  });
</script>