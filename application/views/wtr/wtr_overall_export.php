<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 shadow-sm my-3">
          <div class="card-body">
            <h6 class="card-title">Export WTR Overall</h6>
            <hr>
            <form action="<?= site_url('wtr/wtr_export_api') ?>" target="_blank" method="post">
              <div class="row">

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-2 col-form-label text-muted"> Project</label>
                    <div class="col-xl">
                      <select name="project_code" class="custom-select select_req" onchange="get_module_list(this); find_deck_by_project(this);" required>
                        <?php if ($this->permission_cookie[0] == 1) { ?>
                          <option value="">---</option>
                          <?php foreach ($project_list as $key => $value) : ?>
                            <option value="<?php echo $value['id'] ?>" <?php echo ($this->user_cookie == $value['id'] ? 'selected' : ($this->user_cookie[10] == $value['id'] ? 'selected' : '')) ?>><?php echo $value['project_name'] ?></option>
                          <?php endforeach; ?>
                        <?php } else { ?>
                          <?php foreach ($project_list as $key => $value) : ?>
                            <?php if(in_array($value['id'], $this->user_cookie[13])){ ?>
                              <option value="<?php echo $value['id'] ?>" <?php echo ($this->user_cookie == $value['id'] ? 'selected' : ($this->user_cookie[10] == $value['id'] ? 'selected' : '')) ?>><?php echo $value['project_name'] ?></option>
                            <?php } ?>
                          <?php endforeach; ?>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-2 col-form-label text-muted"> Yard</label>
                    <div class="col-xl">
                      <select class="custom-select" name="company_yard">
                        <option value="999">---</option>
                        <?php foreach ($company_list as $key => $value) : ?>
                          <?php if(in_array($value['id_company'], $this->user_cookie[14])){ ?>
                            <option value="<?php echo $value['id_company'] ?>" <?= $company==$value['id_company'] ? 'selected' : '' ?>><?php echo $value['company_name'] ?></option>
                          <?php } ?>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-2 col-form-label text-muted"> Company</label>
                    <div class="col-xl">
                      <select class="custom-select select2" name="company_id">
                        <option value="999">---</option>
                        <?php foreach ($company_list as $key => $value) : ?>
                          <?php if(in_array($value['id_company'], $this->user_cookie[14])){ ?>
                            <option value="<?php echo $value['id_company'] ?>"><?php echo $value['company_name'] ?></option>
                          <?php } ?>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-2 col-form-label text-muted"> Drawing No.</label>
                    <div class="col-xl">
                      <input type="text" class="form-control autocomplete_doc" name="drawing_no">
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-2 col-form-label text-muted"> Discipline</label>
                    <div class="col-xl">
                      <select name="discipline" class="custom-select select_req" required>
                        <option value="">---</option>
                        <?php foreach ($discipline_list as $key => $value) : ?>
                          <option value="<?= $value['id'] ?>"><?= $value['discipline_name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-2 col-form-label text-muted" required> Module</label>
                    <div class="col-xl">
                      <select name="module" class="custom-select select_req">

                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-2 col-form-label text-muted" required> Type Of Module</label>
                    <div class="col-xl">
                      <select name="type_of_module" class="custom-select select_req">
                        <option value="">---</option>
                        <?php foreach ($type_of_module as $key => $value) : ?>
                          <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-2 col-form-label text-muted" required> Deck Elevation / Service Line</label>
                    <div class="col-xl">
                      <select class="select2 select_req" style="width:100%" name="deck_elevation" id="deck_change" required>
                        <option value="">---</option>
                        <?php foreach ($deck_elevation as $key => $value) : ?>
                          <option value="<?php echo $value['id'] ?>" <?php echo (@$get['deck_elevation'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="" class="col-xl-2 col-form-label text-muted" required> IRN Report No</label>
                    <div class="col-xl">
                      <select onchange="change_input(this)" class="select2" style="width:100%" name="report_number">
                        <option value="">---</option>
                        <?php foreach ($irn_report as $key => $value) : ?>
                          <option value="<?= $key ?>"><?= $value ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>



                <div class="col-md-12">
                  <hr>
                  <div class="float-right">
                    <button type="submit" name="submit" value="excel" class="btn btn-green-smoe text-white"><i class="fas fa-file-excel"></i> Export <b>- Excel</b></button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<script>
  $(document).ready(function() {
    var data_prjk = $("select[name=project_code]");
    get_module_list(data_prjk);
  });

  function get_module_list(select) {
    var project_id = $(select).val();
    console.log(select);
    $.ajax({
      url: "<?= site_url('wtr/module_list_by_project') ?>",
      type: "POST",
      data: {
        project_id: project_id
      },
      dataType: "JSON",
      success: function(data) {
        var html = []
        html.push(`<option value="">---</option>`)
        data.map(function(v, i) {
          if (v.status_delete == 1) {
            html.push(`<option value="${v.mod_id}">${v.mod_desc}</option>`)
          }
        })

        $('select[name=module]').html(html)
      }
    })
  }

  $(".autocomplete_doc").autocomplete({
    source: function(request, response) {
      var project_id = $("select[name=project_code]").val()
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
      if(value == 'No Data.'){
        ui.item.value = "";
      }
      else{
        get_data_drawing(ui.item.value);
      }
    }
  });

  function get_data_drawing(document_no, change_drawing_type) {
    console.log(document_no);
    $.ajax( {
      url: "<?php echo base_url() ?>engineering/get_data_drawing",
      dataType: "json",
      data: {
        document_no: document_no,
      },
      success: function(data) {
        $("select[name=project_code]").val(data.project).trigger('change');
        $("select[name=discipline]").val(data.discipline);
        
        setTimeout(() => {
          $("select[name=module]").val(data.module);
        }, 1000);

        $("select[name=type_of_module]").val(data.type_of_module);
        console.log(data)
      }
    });
  }

  function change_input(select) {
    if(select.value) {
      $('.select_req').removeAttr('required')
    } else {
      $('.select_req').attr('required', true)
    }
  }

  function find_deck_by_project(select) {
      var project_id = $(select).val()
      if(project_id != 21){
        $("#deck_change").removeAttr('required');
      } else {
        $("#deck_change").attr('required', true);
      }
    }
</script>