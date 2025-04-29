<?php
$list_table = ['mv', 'ft', 'vs'];

$tab1 = strtr($this->encryption->encrypt('mv'), '+=/', '.-~');
$tab2 = strtr($this->encryption->encrypt('ft'), '+=/', '.-~');
$tab3 = strtr($this->encryption->encrypt('vs'), '+=/', '.-~');

?>

<style>
  .nav-link {
    color: #000;
  }

  .nav-pills .nav-link.active,
  .nav-pills .show>.nav-link {
    color: #007bff;
    background: #fff;
    border-bottom: 2px solid #007bff;
    border-radius: 0px;
  }

  th, td {
    vertical-align: middle !important;
  }
</style>

<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card shadow my-3 rounded-0">
          <div class="card-body">

            <div class="row">
              <div class="col-md-12">
                <ul class="nav nav-pills border-bottom border-gray" id="myTab" role="tablist">

                  <li class="nav-item">
                    <a class="nav-link <?= $category == "mv" ? 'active' : '' ?>" id="mv-tab" href="<?= site_url('rfi/rfi_client_pending_list/' . $tab1) ?>" role="tab" aria-controls="mv">Material Verification</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link <?= $category == "ft" ? 'active' : '' ?>" id="ft-tab" href="<?= site_url('rfi/rfi_client_pending_list/' . $tab2) ?>" role="tab" aria-controls="ft">Fitup</a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link <?= $category == "vs" ? 'active' : '' ?>" id="vs-tab" href="<?= site_url('rfi/rfi_client_pending_list/' . $tab3) ?>" role="tab" aria-controls="vs">Visual</a>
                  </li>

                </ul>
              </div>

              <div class="col-md-12">
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade <?= $category == "mv" ? 'show active' : '' ?> " id="mv" role="tabpanel" aria-labelledby="mv-tab">
                    <div class="row mt-3">
                      <div class="col-md-12">
                        <h6 class="card-title"><strong><i>Material Verification Pending List</i></strong></h6>
                      </div>

                      <div class="col-md-12">
                        <div class="table-responsive overflow-auto">
                          <table style="width:100%" class="table table-hover text-center" id="table_mv">
                            <thead class="bg-green-smoe text-white">
                              <th>Project</th>
                              <th>RFI No</th>
                              <th>Process</th>
                              <th>Drawing No</th>
                              <th>Transmit Time</th>
                              <th>Total Item</th>
                              <th></th>
                            </thead>
                            <tbody>

                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade <?= $category == "ft" ? 'show active' : '' ?> " id="ft" role="tabpanel" aria-labelledby="ft-tab">
                    <div class="row mt-3">

                      <div class="col-md-12">
                        <h6 class="card-title"><strong><i>Fitup Pending List</i></strong></h6>
                      </div>

                      <div class="col-md-12">
                        <div class="table-responsive overflow-auto">
                          <table style="width:100%" class="table table-hover text-center" id="table_ft">
                            <thead class="bg-green-smoe text-white">
                              <th>Project</th>
                              <th>RFI No</th>
                              <th>Process</th>
                              <th>Drawing No</th>
                              <th>Transmit Time</th>
                              <th>Total Item</th>
                              <th></th>
                            </thead>
                            <tbody>

                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade <?= $category == "vs" ? 'show active' : '' ?> " id="vs" role="tabpanel" aria-labelledby="vs-tab">
                    <div class="row mt-3">

                    <div class="col-md-12">
                        <h6 class="card-title"><strong><i>Visual Pending List</i></strong></h6>
                      </div>

                      <div class="col-md-12">
                        <div class="table-responsive overflow-auto">
                          <table style="width:100%" class="table table-hover text-center" id="table_vs">
                            <thead class="bg-green-smoe text-white">
                              <th>Project</th>
                              <th>RFI No</th>
                              <th>Process</th>
                              <th>Drawing No</th>
                              <th>Transmit Time</th>
                              <th>Total Item</th>
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
    </div>
  </div>
</div>
</div>

<script>
  $(`#table_<?= $category ?>`).DataTable({
      order: [],
      processing : true,
      serverSide : true,
      ajax : {
        url   : "<?= site_url('rfi/serverside_rfi_'. $category) ?>",
        type  : "POST"
      }
    })
</script>