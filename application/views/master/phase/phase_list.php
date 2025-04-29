<div id="content" class="container-fluid">

  <div class="card shadow my-3 rounded-0">
    <div class="card-header">
      <h6 class="m-0"><?php echo $meta_title ?></h6>
    </div>
    
    <div class="card-body bg-white">
      <?php if($this->permission_cookie[0] == 1): ?>
        <a href="<?php echo base_url() ?>master/phase/phase_new" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Add New</a>
        <br>
        <br>
      <?php endif; ?>
      <div class="overflow-auto">
        <table class="table table-hover text-center dataTable">
          <thead class="bg-green-smoe text-white">
            <tr>
              <th>Name</th>
              <th>Code</th>
              <th>Discipline</th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($phase_list as $key => $value): ?>
              <tr>
                <td><?php echo $value["phase_name"] ?></td>
                <td><?php echo $value["phase_code"] ?></td>
                <td><?php echo @$discipline_list[$value["discipline"]]["discipline_name"] ?></td>
                <td>
                  <?php if($value["status_delete"] == 1): ?>
                    <span class="badge badge-success">Active</span>
                  <?php else: ?>
                    <span class="badge badge-danger">Disabled</span>
                  <?php endif; ?>
                </td>
                <td>
                  <?php if($this->permission_cookie[0] == 1): ?>
                    <a href="<?php echo base_url() ?>master/phase/phase_new/<?php echo strtr($this->encryption->encrypt($value["id"]), '+=/', '.-~') ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Update</a>
                  <?php endif; ?>
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
<script>
  $('.dataTable').DataTable({
    "order": []
  });
</script>