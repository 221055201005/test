<div id="content" class="container-fluid">

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white">
          <h6 class="font-weight-bold text-info"><i class="fas fa-info-circle"></i> Drag the header to expand column.</h6>
          <form method="POST" action="<?php echo base_url() ?>engineering/request_rename_piecemark_process">
            <div class="overflow-auto">
              <table class="table table-hover text-center dataTable">
                <thead class="bg-green-smoe text-white text-nowrap">
                  <tr>
                    <th>Drawing GA</th>
                    <th>Drawing AS </th>
                    <th>Old Drawing SP</th>
                    <th>Drawing SP</th>
                    <th>Old Part ID </th>
                    <th>New Part ID</th>
                    <th>Reason</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    foreach ($piecemark_list as $key => $value) : 
                  ?>
                  <tr>
                    <input type="hidden" value="<?= $value['id'] ?>" name="id[]" required>
                    <td><?= $value['drawing_ga'] ?></td>
                    <td><?= $value['drawing_as'] ?></td>
                    <td><?= $value['drawing_sp'] ?></td>
                    <td><input type="text" class="form-control" value="<?= $value['drawing_sp'] ?>" name="drawing_sp[]" required></td>
                    <td><?= $value['part_id'] ?></td>
                    <td><input type="text" class="form-control" value="" name="part_id[]" required></td>
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