<div id="content" class="container-fluid">

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <form action="<?php echo base_url() ?>engineering/joint_list" method="GET">
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Project</label>
                  <div class="col-xl">
                    <select class="form-control" name="project" id='project_id' required>
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
                    <select class="form-control" name="discipline" required>
                      <option value="">---</option>
                      <?php foreach ($discipline_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$get['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Drawing No</label>
                  <div class="col-xl">
                    <input type="text" class="form-control autocomplete_doc" name="drawing_no" value="<?php echo @$get['drawing_no'] ?>" required>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Drawing Type</label>
                  <div class="col-xl">
                    <select class="form-control" name="drawing_type" required>
                      <option value="">---</option>
                      <option value="1" <?php echo (@$get['drawing_type'] == '1' ? 'selected' : '') ?>>GA</option>
                      <option value="2" <?php echo (@$get['drawing_type'] == '2' ? 'selected' : '') ?>>Assembly</option>
                      <option value="13" <?php echo (@$get['drawing_type'] == '13' ? 'selected' : '') ?>>Isometric</option>
                      <option value="9" <?php echo (@$get['drawing_type'] == '9' ? 'selected' : '') ?>>Weldmap GA</option>
                      <option value="14" <?php echo (@$get['drawing_type'] == '14' ? 'selected' : '') ?>>Weldmap AS</option>
                      <option value="12" <?php echo (@$get['drawing_type'] == '12' ? 'selected' : '') ?>>Pipe Support</option>
                      <option value="7" <?php echo (@$get['drawing_type'] == '7' ? 'selected' : '') ?>>Method Statement</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
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
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Deck Elevation / Service Line</label>
                  <div class="col-xl">
                    <select class="form-control" name="deck_elevation" required>
                      <option value="">---</option>
                      <?php foreach ($deck_elevation_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$get['deck_elevation'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code'] . " - " . $value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
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
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Desc Assy</label>
                  <div class="col-xl">
                    <select class="form-control" name="description_assy" required>
                      <option value="">---</option>
                      <?php foreach ($desc_assy_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$get['description_assy'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code'] . ' - ' . $value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Weldmap</label>
                  <div class="col-xl">
                    <input type="text" class="form-control autocomplete_wm" name="drawing_wm" value="<?php echo @$get['drawing_wm'] ?>" required>
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
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Is Bondstrand</label>
                  <div class="col-xl">
                    <select class="form-control" name="is_bondstrand">
                      <option value="" <?php echo @$get['is_bondstrand'] == "" ? "selected" : "" ?>>---</option>
                      <option value="0" <?php echo @$get['is_bondstrand'] == "0" ? "selected" : "" ?>>No</option>
                      <option value="1" <?php echo @$get['is_bondstrand'] == "1" ? "selected" : "" ?>>Yes</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Status</label>
                  <div class="col-xl">
                    <select class="form-control" name="status">
                      <option value="draft" <?php echo @$get['status'] == "draft" ? "selected" : "" ?>>Joint Draft</option>
                      <option value="outstanding" <?php echo @$get['status'] == "outstanding" ? "selected" : "" ?>>Joint OutStanding</option>
                      <option value="submitted" <?php echo @$get['status'] == "submitted" ? "selected" : "" ?>>Joint Submitted</option>
                      <!-- <option value="deleted" <?php echo @$get['status'] == "deleted" ? "selected" : "" ?>>Joint Deleted</option> -->
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
                <button class="mt-2 btn btn-sm btn-flat btn-info" name="submit" value="search" onclick="$(this).closest('form').find('input, select').prop('required', false)"><i class="fas fa-search"></i> Search</button>
                <button class="mt-2 btn btn-sm btn-flat btn-success" name="submit" value="add" onclick="$(this).closest('form').find('input, select').prop('required', true)"><i class="fas fa-plus"></i> Add Joint</button>
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
              <table id="table_joint_list" class="table table-hover text-center dataTable">
                <thead class="bg-green-smoe text-white">
                  <tr>
                    <th><input type='checkbox' class='checkbox-big' name="check_all" onclick='checkall(this)'></th>
                    <th>Drawing GA/AS</th>
                    <th>Rev GA/AS</th>
                    <th>Drawing WM</th>
                    <th>Rev WM</th>
                    <th>Joint No.</th>
                    <th>Piecemark#1</th>
                    <th>Piecemark#2</th>
                    <th>Weld Type Code</th>
                    <th>Desc Assy</th>
                    <th>Phase</th>
                    <th>Thickness</th>
                    <th>Diameter</th>
                    <th>Schedule</th>
                    <th>Length</th>
                    <th>Weld Length</th>
                    <th>Joint Type Code</th>
                    <th>Test Pack Number</th>
                    <th>Spool Number</th>
                    <th>Service Line</th>
                    <th>P&ID Drawing</th>
                    <th>Class Code</th>
                    <th>Row</th>
                    <th>Column</th>
                    <th>MT Req (%)</th>
                    <th>PT Req (%)</th>
                    <th>UT Req (%)</th>
                    <th>RT Req (%)</th>
                    <th>PWHT Req (%)</th>
                    <th>PMI Req (%)</th>
                    <th>Remarks</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
            <br>

            <?php if (@$get['status'] == "submitted") : ?>
              <div class="row">
                <?php if (@$get['drawing_no'] != "" && @$get['drawing_wm'] != "") : ?>
                  <div class="col-md-auto">
                    <div class="font-weight-bold">
                      You tick <span class="text-warning num_ticker">0</span> joint to Request Update.<br>
                    </div>
                    <form method="POST" action="<?php echo base_url() ?>engineering/revise_history_new_process/" onsubmit="save_id_checked(this)">
                      <input type="hidden" name="id">
                      <input type="hidden" name="submission_id" value="<?php echo (@$get['drawing_no'] != "" ? @$get['drawing_no'] : @$get['drawing_wm']) ?>">
                      <input type="hidden" name="fabrication_type" value="5">
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
                      You tick <span class="text-info num_ticker">0</span> joint to Change Join No.<br>
                    </div>
                    <form method="POST" action="<?php echo base_url() ?>engineering/request_rename_joint_preview/" onsubmit="save_id_checked(this)">
                      <input type="hidden" name="id">
                      <input type="hidden" name="submission_id" value="<?php echo $get['drawing_wm'] ?>">
                      <input type="hidden" name="fabrication_type" value="9">
                      <div class="form-group">
                        <textarea name="request_reason" rows="3" class="form-control" placeholder="Request Reason" required></textarea>
                      </div>
                      <div class="row mb-1">
                        <div class="col-md-12">
                          <button type="submit" name="submit" value="update_req" class="btn btn-info"><i class='fas fa-check'></i> Change Join No</button>
                        </div>
                      </div>
                    </form>
                  </div>

                  <?php if ($user_permission[227] == 1) { ?>
                    <div class="col-md-auto">
                      <div class="font-weight-bold">
                        You tick <span class="text-dark num_ticker">0</span> joint to Request Void.<br>
                      </div>
                      <form method="POST" action="<?php echo base_url() ?>engineering/import_joint_preview_for_to_void/" onsubmit="save_id_checked(this)">
                        <input type="hidden" name="id">
                        <input type="hidden" name="submission_id" value="<?php echo (@$get['drawing_no'] != "" ? @$get['drawing_no'] : @$get['drawing_wm']) ?>">
                        <input type="hidden" name="fabrication_type" value="fab">
                        <!-- <input type="hidden" name="fabrication_type" value="9"> -->
                        <!-- <div class="form-group">
                        <textarea name="request_reason" rows="3" class="form-control" placeholder="Request Reason" required></textarea>
                      </div> -->
                        <div class="row mb-1">
                          <div class="col-md-12">
                            <button type="submit" name="submit" value="update_req" class="btn btn-dark"><i class='fas fa-check'></i> Request Void</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  <?php } ?>

                <?php else : ?>
                  <div class="col-md-auto">
                    <div class="font-weight-bold text-info">
                      You should filter by Drawing No & Drawing WM to request update or void joint.
                    </div>
                  </div>
                <?php endif; ?>
              </div>
            <?php else : ?>
              <div class="row">
                <?php if (@$get['drawing_no'] != "" && @$get['drawing_wm'] != "") : ?>
                  <div class="col-md-auto">
                    <div class="font-weight-bold">
                      You tick <span class="text-danger num_ticker">0</span> joint to Delete.<br>
                    </div>
                    <form method="POST" action="<?php echo base_url() ?>engineering/joint_update" onsubmit="save_id_checked(this)">
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
                      You tick <span class="text-warning num_ticker">0</span> joint to Edit.<br>
                    </div>
                    <form method="POST" action="<?php echo base_url() ?>engineering/joint_update" onsubmit="save_id_checked(this)">
                      <input type="hidden" name="id">
                      <div class="row mb-1">
                        <div class="col-md-12">
                          <button type="submit" name="submit" value="edit" class="btn btn-warning"><i class='fas fa-edit'></i> Edit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                <?php else : ?>
                  <div class="col-md-auto font-weight-bold text-info">
                    You should filter by Drawing No & Drawing WM to delete or update joint.
                  </div>
                <?php endif; ?>
              </div>
            <?php endif; ?>

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
      url: "<?php echo base_url(); ?>engineering/joint_list_datatable",
      type: "POST",
      data: {
        page: 'list',
        <?php
        if (isset($get['submit'])) {
          foreach ($get as $key => $value) {
            if ($value != "") {
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
          return_text += '<br><i class="fas fa-flag text-success" title="IRN Already Checked"></i>';
        }
        // return_text += '<br>'+row[0];
        return return_text;
      }
    }]
  })

  $(".autocomplete_doc").autocomplete({
    source: function(request, response) {
      var project_id = $("#project_id option:selected").val();
      var drawing_type = 1;
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
        get_data_drawing(ui.item.value, 1);
      }
    }
  });

  $(".autocomplete_wm").autocomplete({
    source: function(request, response) {
      var project_id = $("#project_id option:selected").val();
      var drawing_type = 2;
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
    }
  });

  function get_data_drawing(document_no, change_drawing_type) {
    console.log(document_no);
    $.ajax({
      url: "<?php echo base_url() ?>engineering/get_data_drawing",
      dataType: "json",
      data: {
        document_no: document_no,
      },
      success: function(data) {
        $("select[name=project]").val(data.project).trigger('change');
        $("select[name=discipline]").val(data.discipline);
        $("select[name=module]").val(data.module);
        $("select[name=type_of_module]").val(data.type_of_module);
        $("select[name=deck_elevation]").val(data.deck_elevation);
        if (change_drawing_type == 1) {
          $("select[name=drawing_type]").val(data.drawing_type);
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
    $('#table_joint_list tbody input[type=checkbox]').each(function(i, obj) {
      if ($(input).prop("checked") == true && $(obj).prop("checked") == false) {
        $(obj).trigger("click");
        // console.log("all"+$(obj).val());
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
        module: 2,
      },
      success: function(data) {
        $('#history_log .modal-body').html(data);
      }
    });
  }
</script>