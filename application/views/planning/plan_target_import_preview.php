<div id="content" class="container-fluid">

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?> <b>(Level <?php echo $set_level ?>)</b></h6>
        </div>
        <div class="card-body bg-white">
          <h6 class="font-weight-bold text-info"><i class="fas fa-info-circle"></i> Drag the header to expand column.</h6>
          <form method="POST" action="<?php echo base_url() ?>planning/plan_target_import_process">
            <div class="overflow-auto">
              <table class="table table-hover text-center dataTable">
                <thead class="bg-green-smoe text-white text-nowrap">
                  <tr>
                    <th>Week No</th>
                    <th>Year</th>
                    <th>Project</th>
                    <th>Type Of Module</th>
                    <th>Discipline </th>
                    <th>Phase</th>
                    <th>Plan Target</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  foreach ($sheet as $key => $value) : 
                    if($key > 1 && $value['I'] != ""):
                      $status = "";
                      if(!isset($project_list[$value['E']])){
                        $status = "Project Not Found!";
                      }
                      elseif(!@isset($type_of_module_list[$value['F']]) && $set_level >= 2){
                        $status = "Type of Module Not Found!";
                      }
                      elseif(!@isset($discipline_list[$value['G']]) && $set_level >= 3){
                        $status = "Discipline Not Found!";
                      }
                      elseif(!@isset($phase_list[$discipline_list[$value['G']]['id']][$value['H']]) && $set_level >= 4){
                        $status = "Phase Not Found!";
                      }

                      if(@isset($phase_list[$discipline_list[$value['G']]['id']][$value['H']]) && $set_level < 4){
                        $status = "Level ".$set_level." no need input phase!";
                      }
                      elseif(@isset($discipline_list[$value['G']]) && $set_level < 3){
                        $status = "Level ".$set_level." no need input discipline!";
                      }
                      elseif(@isset($type_of_module_list[$value['F']]) && $set_level < 2){
                        $status = "Level ".$set_level." no need input type of module!";
                      }
                  ?>
                  <tr style="background: <?php echo ($status != "" ? "#f8d7da" : "") ?>">
                    <td><input type="number" class="form-control" value="<?php echo $value['A'] ?>" <?php echo ($status != "" ? "readonly" : "readonly" ) ?> name="week_no[]"></td>
                    <td><input type="number" class="form-control" value="<?php echo $value['B'] ?>" <?php echo ($status != "" ? "readonly" : "readonly" ) ?> name="year_week[]"></td>
                    <td>
                      <input type="text" class="form-control" value="<?php echo $value['E'] ?>" <?php echo ($status != "" ? "readonly" : "readonly" ) ?>>
                      <input type="hidden" class="form-control" value="<?php echo @$project_list[$value['E']]['id'] ?>" <?php echo ($status != "" ? "readonly" : "readonly" ) ?> name="project[]">
                    </td>
                    <td>
                      <input type="text" class="form-control" value="<?php echo $value['F'] ?>" <?php echo ($status != "" ? "readonly" : "readonly" ) ?>>
                      <input type="hidden" class="form-control" value="<?php echo @$type_of_module_list[$value['F']]['id'] ?>" <?php echo ($status != "" ? "readonly" : "readonly" ) ?> name="type_of_module[]">
                    </td>
                    <td>
                      <input type="text" class="form-control" value="<?php echo $value['G'] ?>" <?php echo ($status != "" ? "readonly" : "readonly" ) ?>>
                      <input type="hidden" class="form-control" value="<?php echo @$discipline_list[$value['G']]['id'] ?>" <?php echo ($status != "" ? "readonly" : "readonly" ) ?> name="discipline[]">
                    </td>
                    <td>
                      <input type="text" class="form-control" value="<?php echo $value['H'] ?>" <?php echo ($status != "" ? "readonly" : "readonly" ) ?>>
                      <input type="hidden" class="form-control" value="<?php echo @$phase_list[$discipline_list[$value['G']]['id']][$value['H']]['phase_code'] ?>" <?php echo ($status != "" ? "readonly" : "readonly" ) ?> name="phase[]">
                    </td>
                    <td><input type="number" class="form-control" value="<?php echo $value['I'] ?>" <?php echo ($status != "" ? "readonly" : "readonly" ) ?> name="plan_target[]"></td>
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