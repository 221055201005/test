<style>
  th { position: sticky; top: 0; z-index: 10;}
</style>
<div id="content" class="container-fluid">

  <form method="POST" action="<?php echo base_url() ?>engineering/piecemark_<?php echo ($module == 'New' ? 'new' : 'update') ?>_process" id="piecemark_form_data">
    <div class="row">
      <div class="col">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0"><?php echo $meta_title ?></h6>
          </div>
          <div class="card-body bg-white overflow-auto">
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Drawing GA</label>
                  <div class="col-xl">
                    <input type="text" class="form-control autocomplete_ga" name="drawing_ga_search" value="<?php echo @$get['drawing_ga'] ?>" required>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Project</label>
                  <div class="col-xl">
                    <select class="form-control" name="project" required>
                      <option value="">---</option>
                      <?php foreach ($project_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo (@$get['project'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Discipline</label>
                  <div class="col-xl">
                    <select class="form-control" name="discipline" required>
                      <option value="">---</option>
                      <?php foreach ($discipline_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo (@$get['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Module</label>
                  <div class="col-xl">
                    <select class="form-control" name="module" required>
                      <option value="">---</option>
                      <?php foreach ($module_list as $key => $value) : ?>
                      <option value="<?php echo $value['mod_id'] ?>" data-chained="<?php echo $value['project_id'] ?>" <?php echo (@$get['module'] == $value['mod_id'] ? 'selected' : '') ?>><?php echo $value['mod_desc'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Type of Module</label>
                  <div class="col-xl">
                    <select class="form-control" name="type_of_module" required>
                      <option value="">---</option>
                      <?php foreach ($type_of_module_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$get['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code']." - ".$value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Drawing AS</label>
                  <div class="col-xl">
                    <input type="text" class="form-control autocomplete_as" name="drawing_as_search" value="<?php echo @$get['drawing_as'] ?>">
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Deck Elevation / Service Line</label>
                  <div class="col-xl">
                    <select class="form-control" name="deck_elevation">
                      <option value="">---</option>
                      <?php foreach ($deck_elevation_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$get['deck_elevation'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code']." - ".$value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Desc Assy</label>
                  <div class="col-xl">
                    <select class="form-control" name="description_assy" required>
                      <option value="">---</option>
                      <?php foreach ($desc_assy_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo (@$get['description_assy'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code'].' - '.$value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Status Internal</label>
                  <div class="col-xl">
                    <select class="form-control" name="status_internal">
                      <option value="0" <?php echo @$get['status_internal'] == "0" ? "selected" : "" ?>>External</option>
                      <option value="1" <?php echo @$get['status_internal'] == "1" ? "selected" : "" ?>>Internal</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Is ITR</label>
                  <div class="col-xl">
                    <select class="form-control" name="is_itr">
                      <option value="0" <?php echo @$get['is_itr'] == "0" ? "selected" : "" ?>>No</option>
                      <option value="1" <?php echo @$get['is_itr'] == "1" ? "selected" : "" ?>>Yes</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0"><?php echo $meta_title ?></h6>
          </div>
          <div class="card-body bg-white">
            <input type="hidden" name="method" value="<?php echo $method ?>">
            
            <h6 class="font-weight-bold text-info"><i class="fas fa-info-circle"></i> Drag the header to expand column.</h6>
            <div class="overflow-auto" style="max-height: 70vh; overflow-y: auto;">
              <table id="tbl_piecemark" class="table table-hover text-center dataTable">
                <thead class="bg-green-smoe text-white">
                  <tr>
                    <th class="text-nowrap bg-green-smoe"></th>
                    <th class="text-nowrap bg-green-smoe">Drawing GA</th>
                    <th class="text-nowrap bg-green-smoe">Rev GA</th>
                    <th class="text-nowrap bg-green-smoe">Drawing AS</th>
                    <th class="text-nowrap bg-green-smoe">Rev AS</th>
                    <th class="text-nowrap bg-green-smoe">Drawing SP</th>
                    <th class="text-nowrap bg-green-smoe">Rev SP</th>
                    <th class="text-nowrap bg-green-smoe">Part ID As</th>
                    <th class="text-nowrap bg-green-smoe">Reference POS</th>
                    <th class="text-nowrap bg-green-smoe">Cutting Plan</th>
                    <th class="text-nowrap bg-green-smoe">Rev CP</th>
                    <th class="text-nowrap bg-green-smoe">Cutting List</th>
                    <th class="text-nowrap bg-green-smoe">Rev CL</th>
                    <th class="text-nowrap bg-green-smoe">Profile</th>
                    <th class="text-nowrap bg-green-smoe">Material</th>
                    <th class="text-nowrap bg-green-smoe">Grade</th>
                    <th class="text-nowrap bg-green-smoe">Diameter</th>
                    <th class="text-nowrap bg-green-smoe">Thickness</th>
                    <th class="text-nowrap bg-green-smoe">Schedule</th>
                    <th class="text-nowrap bg-green-smoe">Length (mm)</th>
                    <th class="text-nowrap bg-green-smoe">Height</th>
                    <th class="text-nowrap bg-green-smoe">Width</th>
                    <th class="text-nowrap bg-green-smoe">Weight (kg)</th>
                    <th class="text-nowrap bg-green-smoe">Area (m<sup>2</sup>)</th>
                    <th class="text-nowrap bg-green-smoe">Can Number</th>
                    <th class="text-nowrap bg-green-smoe">Test Pack Number</th>
                    <th class="text-nowrap bg-green-smoe">Remarks</th>
                    <th class="text-nowrap bg-green-smoe">Item Code (Piping Material)</th>
                    <th class="text-nowrap bg-green-smoe">Spool No</th>
                    <th class="text-nowrap bg-green-smoe">Beam/Channel (Thk)</th>
                    <th class="text-nowrap bg-green-smoe">Strain Age Test (D/T)</th>
                    <th class="text-nowrap bg-green-smoe">Strain Age Test (Yes/No)</th>
                    <th class="text-nowrap bg-green-smoe">Through Thickness</th>
                    <th class="text-nowrap bg-green-smoe">Piping Testing Category</th>
                  </tr>
                </thead>
                <tbody style="max-height: 90vh; overflow-y: auto;">
                  <?php if($module == 'Update'): ?>
                    <?php foreach ($piecemark_list as $key => $piecemark): ?>
                  <tr>
                    <td>
                      <button type="button" class="btn btn-secondary btn-sm" onclick="open_history_log(<?php echo $piecemark['id'] ?>)"><i class="fas fa-history"></i></button>
                    </td>
                    <td>
                      <input type="text" name="drawing_ga[]" value="<?php echo $piecemark['drawing_ga'] ?>" class="form-control text-center" readonly>
                      <input type="hidden" name="id[]" value="<?php echo $piecemark['id'] ?>">
                    </td>
                    <td><input type="text" name="rev_ga[]" value="<?php echo $piecemark['rev_ga'] ?>" class="form-control text-center"></td>
                    <td><input type="text" name="drawing_as[]" value="<?php echo $piecemark['drawing_as'] ?>" class="form-control text-center"></td>
                    <td><input type="text" name="rev_as[]" value="<?php echo $piecemark['rev_as'] ?>" class="form-control text-center"></td>
                    <td><input type="text" name="drawing_sp[]" value="<?php echo $piecemark['drawing_sp'] ?>" class="form-control text-center"></td>
                    <td><input type="text" name="rev_sp[]" value="<?php echo $piecemark['rev_sp'] ?>" class="form-control text-center"></td>
                    <td><input type="text" name="part_id[]" value="<?php echo $piecemark['part_id'] ?>" class="form-control text-center" readonly></td>
                    <!-- <td><input type="text" name="ref_pos_1[]" value="<?php echo $piecemark["ref_pos_1"] ?>" class="form-control text-center"></td> -->
                    <td>
                      <?php
                        $piecemark_refrence = explode(", ", $piecemark['ref_pos_1']);
                      ?>
                      <select class="form-control select2-multiple" name="ref_pos_1[<?= $key ?>][]" multiple>
                        <?php foreach ($piecemark_refrence_list as $id_pos => $value) : ?>
                          <option value='<?php echo $id_pos ?>' <?php echo (in_array($id_pos, $piecemark_refrence) ? 'selected' : '') ?>><?php echo $value ?></option>
                        <?php endforeach; ?>
                      </select>
                    </td>
                    <td><input type="text" name="drawing_cp[]" value="<?php echo $piecemark["drawing_cp"] ?>" class="form-control text-center" <?= ($method == 'revise' ? '' : '') ?>></td>
                    <td><input type="text" name="rev_cp[]" value="<?php echo $piecemark["rev_cp"] ?>" class="form-control text-center"></td>
                    <td><input type="text" name="drawing_cl[]" value="<?php echo $piecemark["drawing_cl"] ?>" class="form-control text-center" <?= ($method == 'revise' ? 'readonly' : '') ?>></td>
                    <td><input type="text" name="rev_cl[]" value="<?php echo $piecemark["rev_cl"] ?>" class="form-control text-center"></td>
                    <td><input type="text" name="profile[]" value="<?php echo $piecemark["profile"] ?>" class="form-control text-center"></td>
                    <td><input type="text" name="material[]" value="<?php echo $piecemark["material"] ?>" class="form-control text-center"></td>

                    <td>
                      <select class="form-control select2" name="grade[]">
                        <option value="">---</option>
                        <?php foreach ($material_grade_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo ($piecemark['grade'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['material_grade'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </td>
                    
                    <td><input type="text" name="diameter[]" value="<?php echo $piecemark["diameter"] ?>" class="form-control text-center"></td>
                    <td><input type="text" name="thickness[]" value="<?php echo $piecemark["thickness"] ?>" class="form-control text-center"></td>
                    <td><input type="text" name="sch[]" value="<?php echo $piecemark["sch"] ?>" class="form-control text-center"></td>
                    <td><input type="number" step="any" name="length[]" value="<?php echo $piecemark["length"] ?>" class="form-control text-center"></td>
                    <td><input type="text" name="height[]" value="<?php echo $piecemark["height"] ?>" class="form-control text-center"></td>
                    <td><input type="text" name="width[]" value="<?php echo $piecemark["width"] ?>" class="form-control text-center"></td>
                    <td><input type="number" step="any" name="weight[]" value="<?php echo $piecemark["weight"] ?>" class="form-control text-center"></td>
                    <td><input type="number" step="any" name="area[]" value="<?php echo $piecemark["area"] ?>" class="form-control text-center"></td>
                    <td><input type="text" name="can_number[]" value="<?php echo $piecemark["can_number"] ?>" class="form-control text-center"></td>
                    <td><input type="text" name="test_pack_no[]" value="<?php echo $piecemark["test_pack_no"] ?>" class="form-control text-center"></td>
                    <td><input type="text" name="remarks[]" value="<?php echo $piecemark["remarks"] ?>" class="form-control text-center"></td>
                    <td><input type="text" name="item_code[]" value="<?php echo $piecemark["item_code"] ?>" class="form-control text-center"></td>
                    <td><input type="text" name="spool_no[]" value="<?php echo $piecemark["spool_no"] ?>" class="form-control text-center"></td>
                    <td><input type="text" name="beam_chnl_thk[]" value="<?php echo $piecemark["beam_chnl_thk"] ?>" class="form-control text-center"></td>
                    <td><input type="text" name="strain_age_test_dt[]" value="<?php echo $piecemark["strain_age_test_dt"] ?>" class="form-control text-center"></td>
                    <td><input type="text" name="strain_age_test_yn[]" value="<?php echo $piecemark["strain_age_test_yn"] ?>" class="form-control text-center"></td>
                    <td><input type="text" name="through_thickness[]" value="<?php echo $piecemark["through_thickness"] ?>" class="form-control text-center"></td>
                    <td>
                      <select class="form-control" name="piping_testing_category[]" required>
                        <option value="">---</option>
                        <?php foreach ($piping_testing_category_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$piecemark['piping_testing_category'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </td>
                  </tr>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
            <div class="row">
              <div class="col-12 text-right">
              <?php if($method == ''): ?>
                <button class="mt-2 btn btn-sm btn-flat btn-success" name="submit" value="add"><i class="fas fa-check"></i> Submit</button>
                <?php if($module == 'New'): ?>
                <button class="mt-2 btn btn-sm btn-flat btn-info" type="button" onclick="addrow()"><i class="fas fa-plus"></i> Add row</button>
                <?php endif; ?>
              <?php elseif($method == 'revise'): ?>
                <?php if($request_list['fabrication_type'] == '4'): ?>
                  <button class="mt-2 btn btn-sm btn-flat btn-success" name="submit" value="add"><i class="fas fa-check"></i> Complete</button>
                <?php elseif($request_list['fabrication_type'] == '14'): ?>
                  <button class="mt-2 btn btn-sm btn-flat btn-success" type="button" onclick="submit_form_request_approval_client()" value="add"><i class="fas fa-check"></i> Save</button>
                <?php endif; ?>
              <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>

</div>
</div><!-- ini div dari sidebar yang class wrapper -->
<div class="modal fade" id="history_log" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >History Log</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function(){
    <?php if($module == 'New'): ?>
      var i;
      for (i = 0; i < 10; i++) {
        addrow();
      }
    <?php elseif($module == 'Update'): ?>
      $("input[name=drawing_as_search], input[name=drawing_ga_search], select[name=project], select[name=discipline], select[name=type_of_module], select[name=module]").attr("readonly", true);
    <?php endif; ?>

    generate_tabindex("#tbl_piecemark input:not([type=hidden]), #tbl_piecemark select:not(.select2)", 33)
  });

  $("select[name=module]").chained("select[name=project]");

  $(".autocomplete_doc, .autocomplete_wm").autocomplete({
    source: function( request, response ) {
      var drawing_type;
      if($(this.element).hasClass("autocomplete_doc")){
        drawing_type = 1;//ga or as
      }
      else if($(this.element).hasClass("autocomplete_wm")){
        drawing_type = 2;
      }
      $.ajax( {
        url: "<?php echo base_url() ?>engineering/autocomplete_drawing",
        dataType: "json",
        data: {
          term: request.term,
          drawing_type: drawing_type,
        },
        success: function( data ) {
          response( data );
        }
      });
    },
    select: function (event, ui) {
      var value = ui.item.value;
      if(value == 'No Data.'){
        ui.item.value = "";
      }
      else{
        get_data_drawing(ui.item.value);
      }
    }
  });

  function get_data_drawing(document_no) {
    // var module = $("select[name=module]").val();
    $.ajax( {
      url: "<?php echo base_url() ?>engineering/get_data_drawing",
      dataType: "json",
      data: {
        document_no: document_no,
        // module: module,
      },
      success: function(data) {
        console.log(data);
        $("select[name=project]").val(data.project).trigger('change');
        $("select[name=discipline]").val(data.discipline);
        if(data.drawing_type == 1 || data.drawing_type == 2){
          $("select[name=drawing_type]").val(data.drawing_type);
        }
        $("select[name=module]").val(data.module);
        $("select[name=type_of_module]").val(data.type_of_module);
      }
    });
  }

  function addrow() {
    var html = $("#tbl_piecemark tbody tr:last").html();
    $("#tbl_piecemark tbody").append("<tr>"+html+"</tr>");
    var delete_btn = '<button class="mt-2 btn btn-sm btn-flat btn-danger" type="button" onclick="deleterow(this)"><i class="fas fa-times"></i></button>';
    html = $("#tbl_piecemark tbody tr:last td:last").html(delete_btn);
  }

  function deleterow(btn) {
    $(btn).closest("tr").remove();
  }

  function fill_joint_check(input) {
    if ($(input).val() != '') {
      $(input).closest("tr").find("input[name='pos_1[]']").prop("required", true);
      $(input).closest("tr").find("input[name='pos_2[]']").prop("required", true);
    }
    else{
      $(input).closest("tr").find("input[name='pos_1[]']").prop("required", false);
      $(input).closest("tr").find("input[name='pos_2[]']").prop("required", false);
    }
  }

  function open_history_log(id) {
    $('#history_log').modal('show');
    $('#history_log .modal-body').html('<div class="text-center"><div class="spinner-border text-success" role="status"><span class="sr-only">Loading...</span></div></div>');
    $.ajax( {
      url: "<?php echo base_url() ?>engineering/get_table_history_log",
      type: "POST",
      data: {
        id_template: id,
        module: 1,
      },
      success: function(data) {
        $('#history_log .modal-body').html(data);
      }
    });
  }

  function submit_form_request_approval_client() {
    $('#piecemark_form_data').attr('action', '<?= base_url() ?>engineering/request_approval_client_process/<?= @$request_list['id'] ?>');
    $("#piecemark_form_data")[0].submit();
  }
</script>