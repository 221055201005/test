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
        <div class="card rounded-0 shadow">
          <div class="card-header">
            <h6 class="m-0"> Pending RFI List - <strong><?= $method ?></strong></h6>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive overflow-auto">
                  <table class="table table-hover text-center" style="width:100%" id="table_list">
                    <thead class="bg-gray-table">
                      <th>Project</th>
                      <th>Vendor</th>
                      <th>RFI No.</th>
                      <th>Drawing No.</th>
                      <th>Discipline</th>
                      <th>Module</th>
                      <th>Type of Module</th>
                      <th>Transmitted By</th>
                      <th>Transmitted Date</th>
                      <th></th>
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
    </div>
  </div>
</div>
</div>

<script>
  $("#table_list").DataTable({
    order : [],
    processing : true,
    serverSide : true,
    ajax : {
      url : "<?= site_url($serverside) ?>",
      type : "POST",
      data : {
        method : "<?= $method ?>"
      }
    }
  })
</script>