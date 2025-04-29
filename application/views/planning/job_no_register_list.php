<div id="content" class="container-fluid">

  <div class="card shadow my-3 rounded-0">
    <div class="card-header">
      <h6 class="m-0"><?php echo $meta_title ?></h6>
    </div>
    
    <div class="card-body bg-white">
      <div class="overflow-auto">
        <table class="table table-hover text-center dataTable">
          <thead class="bg-green-smoe text-white">
            <tr>
              <th>Discipline</th>
              <th>Deck Elevation / Service Line</th>
              <th>Phase</th>
              <th>Job Number</th>
              <th>Description</th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($job_no_register_list as $key => $value): ?>
              <tr>
                <td><?php echo @$discipline_list[$value["discipline"]]['discipline_name'] ?></td>
                <td><?php echo @$deck_elevation_list[$value["deck_elevation"]]['name'] ?></td>
                <td><?php echo $value["phase"] ?></td>
                <td><?php echo $value["job_no"] ?></td>
                <td><?php echo $value["description"] ?></td>
                <td>
                  <?php if($value["status_delete"] == 1): ?>
                    <span class="badge badge-success">Active</span>
                  <?php else: ?>
                    <span class="badge badge-danger">Disabled</span>
                  <?php endif; ?>
                </td>
                <td>
                  <?php if($this->permission_cookie[124] == 1): ?>
                    <a href="<?php echo base_url() ?>planning/job_no_register_update/<?php echo strtr($this->encryption->encrypt($value["id"]), '+=/', '.-~') ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Update</a>
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
  $('.dataTable').DataTable({"order" : []});
</script>