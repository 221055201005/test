<div id="content" class="container-fluid">

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white">
          <h6 class="font-weight-bold text-info"><i class="fas fa-info-circle"></i> Drag the header to expand column.</h6>
          <form method="POST" action="<?php echo base_url() ?>engineering/import_activity_id_process">
            <div class="overflow-auto">
              <table class="table table-hover text-center dataTable">
                <thead class="bg-green-smoe text-white text-nowrap">
                  <tr>
                    <th>Part ID As</th>
                    <th>Activity ID</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  foreach ($data_template as $key => $value) : 
                    if($key > 1 && $value['part_id'] != ""):
                      $status = "";
                  ?>
                  <tr style="background: <?php echo ($status != "" ? "#f8d7da" : "") ?>">
                    <td><input type="text" class="form-control" value="<?php echo $value['part_id'] ?>" <?php echo ($status != "" ? "disabled" : "readonly" ) ?> name="part_id[]"></td>
                    <td><input type="text" class="form-control" value="<?php echo $value['activity_id'] ?>" <?php echo ($status != "" ? "disabled" : "readonly" ) ?> name="activity_id[]"></td>
                    <td class="font-weight-bold"><?php echo $status ?></td>
                  </tr>
                  <?php 
                    endif;
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