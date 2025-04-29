<div id="content" class="container-fluid">

  <div class="card shadow my-3 rounded-0">
    <div class="card-header">
      <h6 class="m-0"><?php echo $meta_title ?></h6>
    </div>
    
    <div class="card-body bg-white">
      <?php if($this->permission_cookie[118] == '1'){ ?>
      <a href="<?php echo base_url() ?>master/fitter/fitter_new" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Add New</a>
      <?php } ?>
      <?php if($this->permission_cookie[121] == '1'){ ?>
      <a href="<?php echo base_url() ?>master/fitter/fitter_list/excel" class="btn btn-sm btn-success"><i class="far fa-file-excel"></i> Excel</a>
      <?php } ?>
      

      <?php if($this->permission_cookie[117] == '1'){ ?>
      <br>
      <br>
      <div class="overflow-auto">
        <table class="table table-hover text-center dataTable">
          <thead class="bg-gray-table">
            <tr>
              <th>No</th>
              <th>Company</th>
              <th>Project</th>
              <th>Type Of Module</th>
              <th>Fitter Badge</th>
              <th>Fitter Fullname</th>
              <th>Validation Start Date</th>
              <th>Validation End Date</th>
              <th>Fitter Status</th> 
              <th>Latest Update</th> 
              <?php if($this->permission_cookie[119] == '1'){ ?>
              <th>#</th>
              <?php } ?>
            </tr>
          </thead>
          <tbody>
            <?php $no=1; foreach ($fitter_list as $key => $value): ?>

              <tr>
                <td><?php echo $no ?></td>
                <td><?= (isset($value["company"]) ? @$company_name[$value["company"]] : "-") ?></td>
                <td><?= (isset($value["project"]) ? @$project_code[$value["project"]] : "-") ?></td>
                <td><?= (isset($value["module"]) ? @$type_of_module_code[$value["module"]] : "-") ?></td>
                <td><?php echo $value["fit_up_badge"] ?></td>
                <td><?php echo $value["fitup_name"] ?></td>
                <td><?php echo $value["vsd"] ?></td>
                <td><?php echo $value["ved"] ?></td>
                <td>
                  <?php if($value["status"] == 1): ?>
                    <span class="badge badge-success">Actived</span>
                  <?php else: ?>
                    <span class="badge badge-danger">Non-Actived</span>
                  <?php endif; ?>
                </td>
                <td>
                  <?php if(isset($value['update_by'])){ ?>
                    <?= @$user_list[$value['update_by']] ?><br/><?= $value['update_date'] ?>
                  <?php } else { ?>
                    <?= "-" ?>
                  <?php } ?>
                </td>
                <?php if($this->permission_cookie[119] == '1'){ ?>
                <td><a href="<?php echo base_url() ?>master/fitter/fitter_update_pages/<?php echo strtr($this->encryption->encrypt($value["id_fitter"]), '+=/', '.-~') ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Update</a></td>
                <?php } ?>
                
              </tr>

            <?php $no++;  endforeach; ?>

          </tbody>
        </table>
      </div>

      <?php } ?>

    </div>
  </div>

</div>
</div>
<script>
  $('.dataTable').DataTable({
    "order": []
  });
</script>