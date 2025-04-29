<div id="content" class="container-fluid">

  <div class="card shadow my-3 rounded-0">
    <div class="card-header">
      <h6 class="m-0"><?php echo $meta_title ?></h6>
    </div>
    
    <div class="card-body bg-white">
      <?php if($this->user_cookie[7] == 1): ?>
        <a href="<?php echo base_url() ?>master/point/point_new" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Add New</a>
        <br>
        <br>
      <?php endif; ?>
      <div class="overflow-auto">
        <table class="table table-hover text-center dataTable">
          <thead class="bg-green-smoe text-white">
            <tr>
              <th>Area</th>
              <th>Location</th>
              <th>Point</th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($point_list as $key => $value): ?>
              <tr>
                <td><?php echo @$area_v2_list[$location_v2_list[$value["id_location"]]['id_area']]['name'] ?></td>
                <td><?php echo @$location_v2_list[$value["id_location"]]['name'] ?></td>
                <td><?php echo $value["name"] ?></td>
                <td>
                  <?php if($value["status_delete"] == 1): ?>
                    <span class="badge badge-success">Active</span>
                  <?php else: ?>
                    <span class="badge badge-danger">Disabled</span>
                  <?php endif; ?>
                </td>
                <td>
                  <?php if($this->user_cookie[7] == 1): ?>
                    <a href="<?php echo base_url() ?>master/point/point_new/<?php echo strtr($this->encryption->encrypt($value["id"]), '+=/', '.-~') ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Update</a>
                  <?php endif; ?>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
</div>
<script>
  $('.dataTable').DataTable({
    "order": []
  });
</script>