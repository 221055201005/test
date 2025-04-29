 

  <div id="content" class="container-fluid">
    <form method="POST" action="<?= base_url() ?>additional/dimension_control_add_process" enctype="multipart/form-data">
      <div class="row">
        <div class="col-md-12">
          <div class="my-3 p-3 bg-white rounded shadow-sm">
            <h6 class="pb-2 mb-0"><?php echo $meta_title ?></h6>
            <div class="overflow-auto media text-muted py-3 mt-1 border-top border-gray">
              <div class="container-fluid">
 
              <div class="form-row">

                  <input type="hidden" name="project" value="<?= $project ?>">
                  <input type="hidden" name="drawing_no" value="<?= $drawing_no ?>">
                  <input type="hidden" name="discipline" value="<?= $discipline ?>"> 
                  <input type="hidden" name="deck_elevation" value="<?= $deck_elevation ?>"> 
                  <input type="hidden" name="id_user" value="<?= $this->user_cookie[0] ?>"> 
                  <input type="hidden" name="type_of_report" value="<?= $type_of_report ?>"> 

                  <div class="form-group col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Drawing No</label>
                      <div class="col-sm-9"> 
                        <input type="text" class="form-control" name="drawing_no_show" placeholder="Drawing Number" value="<?= $drawing_no ?>" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="form-group col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Discipline</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="discipline_show" placeholder='Discipline' value="<?= $discipline_name[$discipline] ?>" readonly> 
                      </div>
                    </div>
                  </div>

                </div>

                <div class="form-row"> 
                  <div class="form-group col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Module</label>
                      <div class="col-sm-9"> 
                        <?php if(isset($drawing_detail["module"])){ ?>
                        <input type="text" class="form-control" name="module_show" placeholder="Module" value="<?= $module_code[$drawing_detail["module"]] ?>" readonly>
                        <input type="hidden" name="module" value="<?= $drawing_detail["module"] ?>">
                        <?php } else { ?>
                          <select class="form-control" name="project" required style='display:none;'>
                            <option value="">---</option>
                            <?php foreach ($project_list as $key => $value) : ?>
                            <option value="<?php echo $value['id'] ?>" <?php echo (@$post['project'] == $value['id'] ? 'selected' : ($this->user_cookie[10] == $value['id'] ? 'selected' : '')) ?>><?php echo $value['project_name'] ?></option>
                            <?php endforeach; ?>
                          </select>
                          <select class="form-control" name="module" required>
                                <option value="">---</option>
                                <?php foreach ($module_list as $key => $value) : ?>
                                  <option value="<?php echo $value['mod_id'] ?>" data-chained="<?php echo $value['project_id'] ?>" <?php echo (@$post['module'] == $value['mod_id'] ? 'selected' : '') ?>><?php echo $value['mod_desc'] ?></option>
                                <?php endforeach; ?>
                          </select>  
                        <?php } ?>
                  
                      </div>
                    </div>
                  </div>

                  <div class="form-group col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Type Of Module</label>
                      <div class="col-sm-10">
                      <?php if(isset($drawing_detail["module"])){ ?>
                      <input type="text" name='type_of_module_show' class="form-control" value="<?= $type_of_module_name[$drawing_detail["type_of_module"]] ?>" readonly>
                      <input type="hidden" name="type_of_module" value="<?= $drawing_detail["type_of_module"] ?>">
                      <?php } else { ?>
                        <select class="form-control" name="type_of_module" required>
                          <option value="">---</option>
                          <?php foreach ($type_of_module_list as $key => $value) : ?>
                          <option value="<?php echo $value['id'] ?>" <?php echo (@$post['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['name'] ?></option>
                          <?php endforeach; ?>
                        </select> 
                      <?php } ?>
                    </div>
                    </div>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Deck Elevation / Service Line</label>
                      <div class="col-sm-9"> 
                        <input type="text" name='deck_elevation_show' class="form-control" value="<?= $deck_elevation_show[$deck_elevation] ?>" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="form-group col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Type Of Additional Report</label>
                        <div class="col-sm-9"> 
                            <select name='type_of_report' class='form-control' <?= (!empty($type_of_report) && isset($type_of_report) ? "readonly" : "") ?> required>
                              <option value=''>---</option>
                              <option value='1' <?=  $type_of_report == 1 ? "selected" : "" ?>>Dimension Control</option>
                              <option value='2' <?=  $type_of_report == 2 ? "selected" : "" ?>>Correction Of Distortion</option>
                              <option value='3' <?=  $type_of_report == 3 ? "selected" : "" ?>>Excavation</option>
                              <option value='4' <?=  $type_of_report == 4 ? "selected" : "" ?>>Butterring</option>
                            </select>
                        </div>
                      </div>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Requestor Company</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="requestor_company" value="PT SMOE"> 
                      </div>
                    </div>
                  </div>

                  <div class="form-group col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Date</label>
                      <div class="col-sm-10"> 
                      <input type="date" class="form-control" name="submit_date" value="<?= date("Y-m-d") ?>" >
                      </div>
                    </div>
                  </div>
                </div>

                

              </div>
            </div>


            <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
              <div class="container-fluid">

                <div class="form-row">
                  <div class="form-group col-md-12">
                    <table class="table" id="table_dimension_add">
                      <thead>
                        <tr class="table table-success">
                          <th>RFI Number</th>
                          <th>Report Number</th>
                          <?php if($type_of_report == 1){ ?>
                          <th>Status Report</th>
                          <?php } ?>
                          <th>Attachment</th>                          
                          <th>Remarks</th>
                          <th>Uploaded By</th>
                          <th>Uploaded On</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr class="table table-borderless">
                          <td><input type="text" name="rfi_no[]" class="form-control" autocomplete="off" required placeholder='Filling Up - RFI Number'></td>
                          <td><input type="text" name="report_number[]" class="form-control" autocomplete="off" required placeholder='Filling Up - Report Number'></td>
                          <?php if($type_of_report == 1){ ?>
                          <td> 
                            <select name='dc_status[]' class='form-control' required>
                                <option value=''>~ Choice ~</option>
                                <option value='1'>Before Welding</option>
                                <option value='2'>After Welding</option>
                                <option value='3'>Final Inspection</option>
                            </select>
                          </td>
                          <?php } ?>
                          <td>
                            <div class="custom-file">
                              <input type="hidden" name="id_file_attch[]" value="1">
                              <input type="file" class="custom-file-input" name="attachment_client[]"  accept="application/pdf" onchange="get_name_file(this)" required>
                              <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                          </td>
                          <td><textarea class="form-control" name="remarks_file[]"  required></textarea></td>
                          <td><input type="text" name="uploaded_by" class="form-control" autocomplete="off" required readonly value="<?= $this->user_cookie[1] ?>"></td>
                          <td><input type="text" name="uploaded_on" class="form-control" autocomplete="off" required readonly value="<?= date('d M Y') ?>"></td>
                          <td>
                            <button class="btn btn-primary" type="button" onclick="add_new_row()"><i class="fa fa-plus"></i></button>
                          </td>
                        </tr>

                      </tbody>
                    </table>
                  </div>
                </div>

              </div>
            </div>

            <div class="text-right mt-3">
             <!--  <button type="submit" name='submit' value="0" class="btn btn-primary " title="Save as Draft"><i class="fa fa-file"></i> Save as Draft</button> -->
              <button type="submit" name='submit' value='1' class="btn btn-success " title="Submit"><i class="fa fa-plus"></i> Submit</button>
              <button class="btn btn-secondary" type="button" onclick="window.history.back();"><i class="fa fa-close"></i> Cancel</button>
            </div>

          </div>
        </div>
      </div>
    </form>
  </div>
</div><!-- ini div dari sidebar yang class wrapper -->

<script type="text/javascript">
  $('.datepicker').datepicker({
    format: 'dd-mm-yyyy',
    orientation: "bottom auto",
    autoclose: true,
    todayHighlight: true
  });

  var count = 1;

  function add_new_row(){
    count++;

    var html = "";

    html += '<tr class="table table-borderless" id="tr_' + count + '">' +
              '<td><input type="text" name="rfi_no[]" class="form-control" autocomplete="off" required placeholder="Filling Up - RFI Number"></td>' +
              '<td><input type="text" name="report_number[]" class="form-control" autocomplete="off" required placeholder="Filling Up - Report Number"></td>' +
              <?php if($type_of_report == 1){ ?>
              '<td><select name="dc_status[]" class="form-control" required>' +
                '<option value="">~ Choice ~</option>' +
                '<option value="1">Before Welding</option>' +
                '<option value="2">After Welding</option>' +
                '<option value="3">Final Inspection</option>' +
              '</select></td>' +
              <?php } ?>
            //
            '<td>' +
            '<div class="custom-file">' + 
            '<input type="hidden" name="id_file_attch[]" value="' + count + '">' +
            '<input type="file" class="custom-file-input" name="attachment_client[]" onchange="get_name_file(this)" required>' +
            '<label class="custom-file-label" for="customFile[]">Choose file</label>' +
            '</div>' +
            '</td>' +
            //

            '<td><textarea class="form-control" name="remarks_file[]" required></textarea></td>' +
            '<td><input type="text" name="uploaded_by" class="form-control" autocomplete="off" required readonly value="<?= $this->user_cookie[1] ?>"></td>' +
            '<td><input type="text" name="uploaded_on[]" class="form-control" autocomplete="off" required readonly value="<?= date('d M Y') ?>"></td>' +
            '<td><button class="btn btn-danger" type="button" onclick="remove(' + count + ')"><i class="fa fa-trash"></i></button></td>';

    $('#table_dimension_add').append(html);
  }

  function get_name_file(cell){
    var fileName = $(cell).val();
    $(cell).next('.custom-file-label').html(fileName);
  }


  function remove(param){
    $('#tr_' + param).remove();
  }

</script>

<script>
    $("select[name=module]").chained("select[name=project]");
</script>