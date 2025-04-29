<style>
  th,  td {
    vertical-align: middle !important;
  }
</style>

<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card rounded-0 shadow">
          <div class="card-header">
            <div class="row">
              <div class="col-6 mt-2">
                <h6 class="card-title">Consumable Lot No. Register</h6>
              </div>
              <div class="col-6 text-right">
                <a href="<?= site_url('master/consumable/create_new_consumable') ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Create New</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive overflow-auto">
                  <table class="table table-hover text-center" id="table_list">
                    <thead class="bg-green-smoe text-white">
                      <th>Project</th>
                      <th> Batch Lot. No</th>
                      <th> Batch Brand Trade Name & Classification</th>
                      <th> Manufacturer</th>
                      <th> Diameter Size (mm)</th>
                      <th> WPS Used</th>
                      <th> Created By</th>
                      <th> Created Date</th>
                      <th> Action</th>
                    </thead>
                    <tbody>
                      <?php foreach ($list as $key => $value) : ?>
                        <tr>
                          <td><?= $project[$value['project_id']]['project_name'] ?></td>
                          <td><?= $value['lot_no'] ?></td>
                          <td><?= $value['brand_trade_name'] ?></td>
                          <td><?= $value['manufacturer'] ?></td>
                          <td><?= $value['diameter'] ?></td>
                          <td class="text-left">
                            <?php if (isset($detail[$value['id']])): ?> 
                             <?php 

                                $wps_list  = [];
                                foreach($detail[$value['id']] as $v) {
                                  $wps_list[]  = $wps[$v['id_wps']]['wps_no'];
                                }
                              
                              ?>

                              <?= implode(',<br>', $wps_list) ?>
                             <?php endif; ?>
                          </td>
                          <td><?= $user[$value['created_by']]['full_name'] ?></td>
                          <td><?= $value['created_date'] ?></td>
                          <td>
                            <a href="" class="btn btn-warning"><i class="fas fa-edit"></i> Update</a>
                          </td>
                        </tr>
                      <?php endforeach; ?>
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
    order: []
  })
</script>