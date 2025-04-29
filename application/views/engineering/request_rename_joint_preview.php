<div id="content" class="container-fluid">

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white">
          <h6 class="font-weight-bold text-info"><i class="fas fa-info-circle"></i> Drag the header to expand column.</h6>
          <form method="POST" action="<?php echo base_url() ?>engineering/request_rename_joint_process">
            <div class="overflow-auto">
              <table class="table table-hover text-center dataTable">
                <thead class="bg-green-smoe text-white text-nowrap">
                  <tr>
                    <th>Drawing No</th>
                    <th>Drawing WM </th>
                    <th>Old Joint No </th>
                    <th>New Joint No</th>
                    <th>Reason</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    foreach ($joint_list as $key => $value) : 
                  ?>
                  <tr>
                    <input type="hidden" value="<?= $value['id'] ?>" name="id[]" required>
                    <input type="hidden" value="<?= $value['drawing_wm'] ?>" name="drawing_wm[]" required>
                    <td><?= $value['drawing_no'] ?></td>
                    <td><?= $value['drawing_wm'] ?></td>
                    <td><?= $value['joint_no'] ?></td>
                    <td><input type="text" class="form-control" value="" name="joint_no[]" required></td>
                    <td><textarea class="form-control" name="request_reason[]" required><?= $post['request_reason'] ?></textarea></td>
                  </tr>
                  <?php 
                    endforeach; 
                  ?>
                </tbody>
              </table>
            </div>
            <br>
            <div class="row">
              <div class="col-12 text-right">
                <button class="mt-2 btn btn-sm btn-flat btn-success"><i class="fas fa-check"></i> Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>
</div><!-- ini div dari sidebar yang class wrapper -->