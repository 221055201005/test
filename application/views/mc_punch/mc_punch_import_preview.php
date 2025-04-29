<div id="content" class="container-fluid">

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white">
          <h6 class="font-weight-bold text-info"><i class="fas fa-info-circle"></i> Drag the header to expand column.</h6>
          <form method="POST" action="<?php echo base_url() ?>mc_punch/mc_punch_import_process">
            <div class="overflow-auto">
              <table class="table table-hover text-center dataTable">
                <thead class="bg-green-smoe text-white text-nowrap">
                  <tr>
                    <th>Project</th>
                    <th>Module </th>
                    <th>Type Of Module</th>
                    <th>Discipline </th>
                    <th>Punch ID No</th>
                    <th>Event ID No</th>
                    <th>System</th>
                    <th>SubSystem</th>
                    <th>Checklist</th>
                    <th>Tag No</th>
                    <th>Description</th>
                    <th>Cat</th>
                    <th>Action by</th>
                    <th>Phase</th>
                    <th>Raised By</th>
                    <th>Raised Date</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  foreach ($sheet as $key => $value) : 
                    if($key > 1 && $value['A'] != ""):
                      $status = "";

                      if(!isset($project_list[$value['A']])){
                        $status = "Project Not Found!";
                      }
                      elseif(!isset($module_list[$project_list[$value['A']]['id']][$value['B']])){
                        $status = "Module Not Found!";
                      }
                      elseif(!isset($type_of_module_list[$value['C']])){
                        $status = "Type of Module Not Found!";
                      }
                      elseif(!isset($discipline_list[$value['D']])){
                        $status = "Discipline Not Found!";
                      }
                      elseif(in_array($value['E'], $document_duplicate)){
                        $status = "Duplicate Data";
                      }
                      elseif($value['E'] == ''){
                        $status = "Punch ID No is Blank!";
                      }
                      elseif($value['F'] != '' && !in_array($value['F'], $event_id_list)){
                        $status = "Event ID No Not Found!";
                      }

                      if(!in_array($value['E'], $document_duplicate)){
                        $document_duplicate[] = $value['E'];
                      }
                  ?>
                  <tr style="background: <?php echo ($status != "" ? "#f8d7da" : "") ?>">
                    <td>
                      <input type="text" class="form-control" value="<?php echo $value['A'] ?>" <?php echo ($status != "" ? "disabled" : "readonly" ) ?>>
                      <input type="hidden" class="form-control" value="<?php echo @$project_list[$value['A']]['id'] ?>" <?php echo ($status != "" ? "disabled" : "readonly" ) ?> name="project[]">
                    </td>
                    <td>
                      <input type="text" class="form-control" value="<?php echo $value['B'] ?>" <?php echo ($status != "" ? "disabled" : "readonly" ) ?>>
                      <input type="hidden" class="form-control" value="<?php echo @$module_list[$project_list[$value['A']]['id']][$value['B']]['mod_id'] ?>" <?php echo ($status != "" ? "disabled" : "readonly" ) ?> name="module[]">
                    </td>
                    <td>
                      <input type="text" class="form-control" value="<?php echo $value['C'] ?>" <?php echo ($status != "" ? "disabled" : "readonly" ) ?>>
                      <input type="hidden" class="form-control" value="<?php echo @$type_of_module_list[$value['C']]['id'] ?>" <?php echo ($status != "" ? "disabled" : "readonly" ) ?> name="type_of_module[]">
                    </td>
                    <td>
                      <input type="text" class="form-control" value="<?php echo $value['D'] ?>" <?php echo ($status != "" ? "disabled" : "readonly" ) ?>>
                      <input type="hidden" class="form-control" value="<?php echo @$discipline_list[$value['D']]['id'] ?>" <?php echo ($status != "" ? "disabled" : "readonly" ) ?> name="discipline[]">
                    </td>

                    <td><input type="text" class="form-control" value="<?php echo $value['E'] ?>" <?php echo ($status != "" ? "disabled" : "readonly" ) ?> name="punch_id_no[]"></td>
                    <td><input type="text" class="form-control" value="<?php echo $value['F'] ?>" <?php echo ($status != "" ? "disabled" : "readonly" ) ?> name="event_id_no[]"></td>
                    <td><input type="text" class="form-control" value="<?php echo $value['G'] ?>" <?php echo ($status != "" ? "disabled" : "readonly" ) ?> name="system[]"></td>
                    <td><input type="text" class="form-control" value="<?php echo $value['H'] ?>" <?php echo ($status != "" ? "disabled" : "readonly" ) ?> name="subsystem[]"></td>
                    <td><input type="text" class="form-control" value="<?php echo $value['I'] ?>" <?php echo ($status != "" ? "disabled" : "readonly" ) ?> name="checklist[]"></td>
                    <td><input type="text" class="form-control" value="<?php echo $value['J'] ?>" <?php echo ($status != "" ? "disabled" : "readonly" ) ?> name="tag_no[]"></td>
                    <td><input type="text" class="form-control" value="<?php echo $value['K'] ?>" <?php echo ($status != "" ? "disabled" : "readonly" ) ?> name="description[]"></td>
                    <td><input type="text" class="form-control" value="<?php echo $value['L'] ?>" <?php echo ($status != "" ? "disabled" : "readonly" ) ?> name="cat[]"></td>
                    <td><input type="text" class="form-control" value="<?php echo $value['M'] ?>" <?php echo ($status != "" ? "disabled" : "readonly" ) ?> name="action_by[]"></td>
                    <td><input type="text" class="form-control" value="<?php echo $value['N'] ?>" <?php echo ($status != "" ? "disabled" : "readonly" ) ?> name="phase[]"></td>
                    <td><input type="text" class="form-control" value="<?php echo $value['O'] ?>" <?php echo ($status != "" ? "disabled" : "readonly" ) ?> name="raised_by[]"></td>
                    <td><input type="date" class="form-control" value="<?php echo $value['P'] ?>" <?php echo ($status != "" ? "disabled" : "readonly" ) ?> name="raised_date[]"></td>
                    
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