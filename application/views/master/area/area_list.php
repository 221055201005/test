<?php if ($this->permission_cookie[166]) : ?>
  <div id="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card shadow my-3 rounded-0">
            <div class="card-header">
              <h6 class="card-title m-0">Area List</h6>
            </div>
            <div class="card-body bg-white">
              <div class="row">
                <?php if ($this->user_cookie[7] == 1) : ?>
                  <div class="col-md-12">
                    <a href="<?= site_url('master/area/add_area') ?>" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Add New</a>
                    <hr>
                  </div>
                <?php endif; ?>
                <div class="col-md-12">
                  <div class="table-responsive overflow-auto">
                    <table class="table table-hover text-center" id="table_list">
                      <thead class="bg-green-smoe text-white">
                        <th>No</th>
                        <th>Area Name</th>
                        <th>Status</th>
                        <th></th>
                      </thead>
                      <tbody>
                        <?php $no = 1;
                        foreach ($area_list as $key => $value) : ?>
                          <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $value['name'] ?></td>
                            <td>
                              <?php if ($value['status_delete'] == 1) : ?>
                                <span class="badge badge-pill badge-success">Active</span>
                              <?php else : ?>
                                <span class="badge badge-pill badge-danger">Disabled</span>
                              <?php endif; ?>
                            </td>
                            <td>
                              <?php if ($this->user_cookie[7] == 1) : ?>
                                <a href="<?= site_url('master/area/update_area/' . strtr($this->encryption->encrypt($value['id']), '+=/', '.-~')) ?>" class="btn btn-warning"><i class="fas fa-edit"></i> Update</a>
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
<?php endif; ?>