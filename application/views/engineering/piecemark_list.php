<div id="content" class="container-fluid">

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <form action="<?php echo base_url() ?>engineering/piecemark_list" method="GET">
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Drawing GA</label>
                  <div class="col-xl">
                    <input type="text" class="form-control autocomplete_ga" name="drawing_ga" value="<?php echo @$get['drawing_ga'] ?>">
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Project</label>
                  <div class="col-xl">
                    <select class="form-control" name="project" id='project_id'>
                      <?php foreach ($project_list as $key => $value) : ?>
                        <?php if (in_array($value['id'], $this->user_cookie[13])) : ?>
                          <option value="<?php echo $value['id'] ?>" <?php echo (@$get['project'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Discipline</label>
                  <div class="col-xl">
                    <select class="form-control" name="discipline">
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
                    <select class="form-control" name="module">
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
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Type Of Module</label>
                  <div class="col-xl">
                    <select class="form-control" name="type_of_module">
                      <option value="">---</option>
                      <?php foreach ($type_of_module_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$get['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code'] . " - " . $value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Drawing AS</label>
                  <div class="col-xl">
                    <input type="text" class="form-control autocomplete_as" name="drawing_as" value="<?php echo @$get['drawing_as'] ?>">
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
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$get['deck_elevation'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code'] . " - " . $value['name'] ?></option>
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
                      <option value="" <?php echo @$get['status_internal'] == "" ? "selected" : "" ?>>---</option>
                      <option value="0" <?php echo @$get['status_internal'] == "0" ? "selected" : "" ?>>External</option>
                      <option value="1" <?php echo @$get['status_internal'] == "1" ? "selected" : "" ?>>Internal</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Description Assembly</label>
                  <div class="col-xl">
                    <select class="form-control" name="description_assy">
                      <option value="">---</option>
                      <?php foreach ($desc_assy_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$get['description_assy'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code'] . ' - ' . $value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Is ITR</label>
                  <div class="col-xl">
                    <select class="form-control" name="is_itr">
                      <option value="">---</option>
                      <option value="0" <?php echo @$get['is_itr'] == "0" ? "selected" : "" ?>>No</option>
                      <option value="1" <?php echo @$get['is_itr'] == "1" ? "selected" : "" ?>>Yes</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Status</label>
                  <div class="col-xl">
                    <select class="form-control" name="status">
                      <option value="outstanding" <?php echo @$get['status'] == "outstanding" ? "selected" : "" ?>>Piecemark OutStanding</option>
                      <option value="submitted" <?php echo @$get['status'] == "submitted" ? "selected" : "" ?>>Piecemark Submitted</option>
                      <!-- <option value="deleted" <?php echo @$get['status'] == "deleted" ? "selected" : "" ?>>Piecemark Deleted</option> -->
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Company</label>
                  <div class="col-xl">
                    <select class="form-control" name="company_id" id='project_id'>
                      <?php foreach ($company_list as $key => $value) : ?>
                        <?php if (in_array($value['id_company'], $this->user_cookie[14])) : ?>
                          <option value="<?php echo $value['id_company'] ?>" <?php echo (@$get['company_id'] == $value['id_company'] ? 'selected' : '') ?>><?php echo $value['company_name'] ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 text-right">
                <button class="mt-2 btn btn-sm btn-flat btn-info" name="submit" value="search"><i class="fas fa-search"></i> Search</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <?php if (isset($get['submit'])) : ?>
    <div class="row">
      <div class="col">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0"><?php echo $meta_title ?></h6>
          </div>
          <div class="card-body bg-white">

            <div class="overflow-auto">
              <table id="table_piecemark_list" class="table table-hover text-center dataTable">
                <thead class="bg-green-smoe text-white">
                  <tr>
                    <th><input type='checkbox' class='checkbox-big' name="check_all" onclick='checkall(this)'></th>
                    <th>Drawing GA</th>
                    <th>Rev GA</th>
                    <th>Drawing AS</th>
                    <th>Rev AS</th>
                    <th>Drawing SP</th>
                    <th>Rev SP</th>
                    <th>Part ID As</th>
                    <th>Reference POS</th>
                    <th>Desc Assy</th>
                    <th>Cutting Plan</th>
                    <th>Rev CP</th>
                    <th>Cutting List</th>
                    <th>Rev CL</th>
                    <th>Profile</th>
                    <th>Material</th>
                    <th>Grade</th>
                    <th>Diameter</th>
                    <th>Thickness</th>
                    <th>Schedule</th>
                    <th>Length (mm)</th>
                    <th>Height</th>
                    <th>Width</th>
                    <th>Weight (kg)</th>
                    <th>Area (m<sup>2</sup>)</th>
                    <th>Can Number</th>
                    <th>Test Pack Number</th>
                    <th>Remarks</th>
                    <th>Item Code (Piping Material)</th>
                    <th>Spool No</th>
                    <th>Beam/Channel (Thk)</th>
                    <th>Strain Age Test (D/T)</th>
                    <th>Strain Age Test (Yes/No)</th>
                    <th>Through Thickness</th>
                    <th>Piping Testing Category</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
            <br>
            <div class="row">
              <?php if (@$get['drawing_ga'] != "" || @$get['drawing_as'] != "") : ?>
                <?php if (@$get['status'] == "submitted") : ?>
                  <div class="col-md-auto">
                    <div class="font-weight-bold">
                      You tick <span class="text-warning num_ticker">0</span> piecemark to Update.<br>
                    </div>
                    <form method="POST" action="<?php echo base_url() ?>engineering/revise_history_new_process" onsubmit="save_id_checked(this)">
                      <input type="hidden" name="id">
                      <input type="hidden" name="submission_id" value="<?php echo (@$get['drawing_as'] != "" ? @$get['drawing_as'] : @$get['drawing_ga']) ?>">
                      <input type="hidden" name="fabrication_type" value="4">
                      <div class="form-group">
                        <textarea name="request_reason" rows="3" class="form-control" placeholder="Request Reason" required></textarea>
                      </div>
                      <div class="row mb-1">
                        <div class="col-md-12">
                          <button type="submit" name="submit" value="update_req" class="btn btn-warning"><i class='fas fa-check'></i> Request Update</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="col-md-auto">
                    <div class="font-weight-bold">
                      You tick <span class="text-info num_ticker">0</span> piecemark to Change Piecemark Name.<br>
                    </div>
                    <form method="POST" action="<?php echo base_url() ?>engineering/request_rename_piecemark_preview" onsubmit="save_id_checked(this)">
                      <input type="hidden" name="id">
                      <input type="hidden" name="submission_id" value="<?php echo (@$get['drawing_as'] != "" ? @$get['drawing_as'] : @$get['drawing_ga']) ?>">
                      <input type="hidden" name="fabrication_type" value="4">
                      <div class="form-group">
                        <textarea name="request_reason" rows="3" class="form-control" placeholder="Request Reason" required></textarea>
                      </div>
                      <div class="row mb-1">
                        <div class="col-md-12">
                          <button type="submit" name="submit" value="update_req" class="btn btn-info"><i class='fas fa-check'></i> Request Update</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <?php if ($user_permission[227] == 1) { ?>
                    <div class="col-md-auto">
                      <div class="font-weight-bold">
                        You tick <span class="text-dark num_ticker">0</span> joint to Void.<br>
                      </div>
                      <form method="POST" action="<?php echo base_url() ?>engineering/import_piecemark_preview_for_to_void/" onsubmit="save_id_checked(this)">
                        <input type="hidden" name="id">
                        <input type="hidden" name="submission_id" value="<?php echo (@$get['drawing_no'] != "" ? @$get['drawing_no'] : @$get['drawing_wm']) ?>">
                        <!-- <input type="hidden" name="fabrication_type" value="9"> -->
                        <input type="hidden" name="fabrication_type" value="pre_fab">
                        <!-- <div class="form-group">
                        <textarea name="request_reason" rows="3" class="form-control" placeholder="Request Reason" required></textarea>
                      </div> -->
                        <div class="row mb-1">
                          <div class="col-md-12">
                            <button type="submit" name="submit" value="update_req" class="btn btn-dark"><i class='fas fa-check'></i> Preview to Void</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  <?php } ?>
                <?php else : ?>
                  <div class="col-md-auto">
                    <div class="font-weight-bold">
                      You tick <span class="text-danger num_ticker">0</span> piecemark to Delete.<br>
                    </div>
                    <form method="POST" action="<?php echo base_url() ?>engineering/piecemark_update" onsubmit="save_id_checked(this)">
                      <input type="hidden" name="id">
                      <input type="hidden" name="action" value="delete">
                      <div class="row mb-1">
                        <div class="col-md-12">
                          <button type="submit" class="btn btn-danger" onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-danger&#34;>&nbsp;Delete&nbsp;</b> this?', this, event)"><i class='fas fa-trash'></i> Delete</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="col-md-auto">
                    <div class="font-weight-bold">
                      You tick <span class="text-warning num_ticker">0</span> piecemark to Edit.<br>
                    </div>
                    <form method="POST" action="<?php echo base_url() ?>engineering/piecemark_update" onsubmit="save_id_checked(this)">
                      <input type="hidden" name="id">
                      <input type="hidden" name="action" value="update">
                      <div class="row mb-1">
                        <div class="col-md-12">
                          <button type="submit" name="submit" value="edit" class="btn btn-warning"><i class='fas fa-edit'></i> Edit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="col-md-auto">
                    <div class="font-weight-bold">
                      You tick <span class="text-info num_ticker">0</span> piecemark to Change Piecemark Name.<br>
                    </div>
                    <form method="POST" action="<?php echo base_url() ?>engineering/request_rename_piecemark_preview" onsubmit="save_id_checked(this)">
                      <input type="hidden" name="id">
                      <input type="hidden" name="submission_id" value="<?php echo (@$get['drawing_as'] != "" ? @$get['drawing_as'] : @$get['drawing_ga']) ?>">
                      <input type="hidden" name="fabrication_type" value="4">
                      <div class="form-group">
                        <textarea name="request_reason" rows="3" class="form-control" placeholder="Request Reason" required></textarea>
                      </div>
                      <div class="row mb-1">
                        <div class="col-md-12">
                          <button type="submit" name="submit" value="update_req" class="btn btn-info"><i class='fas fa-check'></i> Request Update</button>
                        </div>
                      </div>
                    </form>
                  </div>
                <?php endif; ?>
              <?php else : ?>
                <div class="col-md-auto">
                  <div class="font-weight-bold text-info">
                    You should filter by GA or AS to request update piecemark.
                  </div>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>

</div>
</div><!-- ini div dari sidebar yang class wrapper -->
<div class="modal fade" id="history_log" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">History Log</h5>
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
  $("select[name=module]").chained("select[name=project]");

  $('.dataTable').DataTable({
    lengthMenu: [10, 25, 30, 50, 100],
    processing: true,
    serverSide: true,
    order: [],
    ajax: {
      url: "<?php echo base_url(); ?>engineering/piecemark_list_datatable",
      type: "POST",
      data: {
        page: 'list',
        <?php
        if (isset($get['submit'])) {
          foreach ($get as $key => $value) {
            if ($value !== "") {
              $where[$key] = $value;
              echo "$key : '$value', \n";
            }
          }
        }
        ?>
      },
    },
    columnDefs: [{
      "targets": 0,
      "orderable": false,
      "render": function(data, type, row, meta) {
        // console.log(row[0]);
        var status_template = row[0].split("|");
        var return_text = '';
        if (status_template[1] == 1) {
          return_text += '<i class="fas fa-flag" title="Already Requested"></i>';
        } else {
          if (jQuery.inArray(status_template[0], data_checkbox) != -1) {
            return_text += "<input type='checkbox' class='checkbox-big' value='" + status_template[0] + "' onclick='save_checkbox(this)' checked>";
          } else {
            return_text += "<input type='checkbox' class='checkbox-big' value='" + status_template[0] + "' onclick='save_checkbox(this)'>";
          }
        }

        if (status_template[2] == 1) {
          return_text += '<br><i class="fas fa-flag text-success" title="IRN Already Approved"></i>';
        }
        // return_text += '<br>'+row[0];
        return return_text;
      }
    }]
  })

  $(".autocomplete_ga, .autocomplete_as").autocomplete({
    source: function(request, response) {
      var project_id = $("#project_id option:selected").val();
      var drawing_type;
      if ($(this.element).hasClass("autocomplete_ga") || $(this.element).hasClass("autocomplete_as")) {
        drawing_type = 1; //ga or as
      }
      $.ajax({
        url: "<?php echo base_url() ?>engineering/autocomplete_drawing",
        dataType: "json",
        data: {
          term: request.term,
          drawing_type: drawing_type,
          project_id: project_id,
        },
        success: function(data) {
          response(data);
        }
      });
    },
    select: function(event, ui) {
      var value = ui.item.value;
      if (value == 'No Data.') {
        ui.item.value = "";
      } else {
        get_data_drawing(ui.item.value);
      }
    }
  });

  function get_data_drawing(document_no) {
    $.ajax({
      url: "<?php echo base_url() ?>engineering/get_data_drawing",
      dataType: "json",
      data: {
        document_no: document_no,
      },
      success: function(data) {
        console.log(data);
        if ([1, 2, 7, 12, 13, 9, 14].includes(parseInt(data.drawing_type))) {
          $("select[name=project]").val(data.project).trigger('change');
          $("select[name=discipline]").val(data.discipline);
          $("select[name=drawing_type]").val(data.drawing_type);
          $("select[name=module]").val(data.module);
          $("select[name=type_of_module]").val(data.type_of_module);
          $("select[name=deck_elevation]").val(data.deck_elevation);
        }
      }
    });
  }

  var data_checkbox = [];

  function save_checkbox(input) {
    //console.log(data_checkbox);
    if ($(input).prop("checked") == true && $.inArray($(input).val(), data_checkbox) == -1) {
      data_checkbox.push($(input).val());
    } else if ($(input).prop("checked") == false && $.inArray($(input).val(), data_checkbox) != -1) {
      data_checkbox.splice($.inArray($(input).val(), data_checkbox), 1);
    }
    $(".num_ticker").html(data_checkbox.length)
  }

  function checkall(input) {
    $('#table_piecemark_list tbody input[type=checkbox]').each(function(i, obj) {
      if ($(input).prop("checked") == true && $(obj).prop("checked") == false) {
        //console.log("all"+$(obj).val());
        $(obj).trigger("click");
      } else if ($(input).prop("checked") == false && $(obj).prop("checked") == true) {
        $(obj).trigger("click");
      }
    });
  }

  function save_id_checked(form) {
    $(form).find("input[name=id]").val(data_checkbox.join(", "));
  }

  function open_history_log(id) {
    $('#history_log').modal('show');
    $('#history_log .modal-body').html('<div class="text-center"><div class="spinner-border text-success" role="status"><span class="sr-only">Loading...</span></div></div>');
    $.ajax({
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
</script>