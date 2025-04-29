<div id="content" class="container-fluid">

  <div class="card shadow my-3 rounded-0">
    <div class="card-header">
      <h6 class="m-0"><?php echo $meta_title ?></h6>
    </div>
    
    <div class="card-body bg-white">
      <?php if($this->permission_cookie[0] == 1): ?>
        <a href="<?php echo base_url() ?>master/module/module_new" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Add New</a>
        <br>
        <br>
      <?php endif; ?>
      <div class="overflow-auto">
        <table class="table table-hover text-center dataTable">
          <thead class="bg-green-smoe text-white">
            <tr>
              <th>Project</th>
              <th>Name</th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($module_list as $key => $value): ?>
              <?php if (isset($project_list[$value['project_id']])): ?>
                <tr>
                  <td><?php echo @$project_list[$value["project_id"]]['project_name'] ?></td>
                  <td><?php echo $value["mod_desc"] ?></td>
                  <td>
                    <?php if($value["status_delete"] == 1): ?>
                      <span class="badge badge-success">Active</span>
                    <?php else: ?>
                      <span class="badge badge-danger">Disabled</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php if($this->permission_cookie[0] == 1): ?>
                      <a href="<?php echo base_url() ?>master/module/module_new/<?php echo strtr($this->encryption->encrypt($value["mod_id"]), '+=/', '.-~') ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Update</a>
                    <?php endif; ?>
                  <td>
                </tr>
              <?php endif; ?>
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