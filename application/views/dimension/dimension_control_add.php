
  <div id="content" class="container-fluid">
    <form method="POST" action="<?= base_url() ?>additional/dc_add_attch">
      <div class="row">
        <div class="col-md-12">
          <div class="my-3 p-3 bg-white rounded shadow-sm">
            <h6 class="pb-2 mb-0"><?php echo $meta_title ?></h6>
            <div class="overflow-auto media text-muted py-3 mt-1 border-top border-gray">
              <div class="container-fluid">

                <div class="form-row">
                  <div class="form-group col-md-12">
                    <div class="form-group row">
                      <label class="col-sm-1 col-form-label">Drawing No.</label>
                      <div class="col-sm-11">
                        <input type="text" class="form-control" name="draw_no" id="drawing_no" autocomplete="off" onblur="check_draw()" value='<?php echo $drawing_no; ?>' required readonly>
                        <span id="alert_spool" class="text-danger"></span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-row">
                  <input type="hidden" name="project_id" value="<?= $this->user_cookie[10] ?>">
                  <div class="form-group col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Requestor</label>
                      <div class="col-sm-9">
                        <input type="hidden" class="form-control" name="id_requestor" required value="<?= $this->user_cookie[0] ?>">
                        <input type="hidden" class="form-control" name="project_id" required value="<?= $project_id ?>">
                        <input type="text" class="form-control" name="requestor" placeholder="Requestor" value="<?= $this->user_cookie[1] ?>" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="form-group col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Requestor Company</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="requestor_company" value="PT SMOE" required>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Module</label>
                      <div class="col-sm-9">
                        <input type="text" name="name_module" class="form-control" value='<?php echo $module_list[$module] ?>' readonly>
                        <input type="hidden" name="id_module" value='<?php echo $module; ?>'>
                      </div>
                    </div>
                  </div>

                  <div class="form-group col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Discipline</label>
                      <div class="col-sm-10">
                        <input type="text" name="name_discipline" class="form-control" value='<?php echo $discipline_list[$discipline] ?>' readonly>
                        <input type="hidden" name="id_discipline"  value='<?php echo $discipline; ?>'>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Option Date</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control datepicker" name="option_date" placeholder="dd-mm-yyyy"  value='<?php echo date("d-m-Y"); ?>' required autocomplete="off" value="">
                      </div>
                    </div>
                  </div>

                  <div class="form-group col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Remarks</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" name="remark" required></textarea>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-row">
                </div>

              </div>
            </div>

            <div class="text-right mt-3">
              <?php if($read_permission[54] == 1){ ?>
                    <button type="submit" name='submit' id='submitBtn' value='submit' class="btn btn-success " title="Submit"><i class="fa fa-plus"></i> Submit</button>
              <?php } ?>
              <button class="btn btn-secondary" type="button" onclick="window.history.back();"><i class="fa fa-close"></i> Cancel</button>
            </div>

          </div>
        </div>
      </div>
    </form>
  </div>
</div><!-- ini div dari sidebar yang class wrapper -->

<script type="text/javascript">

  $(function () {
    $('.selectpicker').selectpicker();
  });

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
            //
            '<td>' +
            '<div class="custom-file">' + 
            '<input type="file" class="custom-file-input" id="customFile">' +
            '<label class="custom-file-label" for="customFile">Choose file</label>' +
            '</div>' +
            '</td>' +
            //

            '<td><textarea class="form-control" name="remarks_file" required></textarea></td>' +
            '<td><input type="text" name="uploaded_by" class="form-control" autocomplete="off" required readonly value="<?= $this->user_cookie[1] ?>"></td>' +
            '<td><input type="text" name="uploaded_on[]" class="form-control" autocomplete="off" required readonly value="<?= date('d M Y') ?>"></td>' +
            '<td><button class="btn btn-danger" type="button" onclick="remove(' + count + ')"><i class="fa fa-trash"></i></button></td>';

    $('#table_dimension_add').append(html);
  }

  function remove(param){
    $('#tr_' + param).remove();
  }

  function check_draw(){
    var val_draw = $('input[name=draw_no]').val();
    var _err = "is-invalid";
    var _succ = "is-valid";

    if(val_draw == ""){
      $("input[name=draw_no]").addClass(_err);
      $("#submitBtn").attr("disabled", true);
      $('#alert_spool').text('');

      $('input[name="name_module"]').val('');
      $('input[name="id_module"]').val('');
      $('input[name="name_discipline"]').val('');
      $('input[name="id_discipline"]').val('');
      
    } else {
      $.ajax({
        url: "<?= base_url() ?>additional/check_draw_no_by_input/",
        type: "post",
        data : {
          'draw_no': val_draw
        },
        success: function(data){
          var hasil = JSON.parse(data);
          console.log(hasil);
          var _msg = hasil['msg'];
          $('input[name=joint_no]').val(hasil['joint_no']);
          
          if(hasil['nilai'] != 0){
            $("input[name=draw_no]").removeClass(_err);
            $("input[name=draw_no]").addClass(_succ);
            $('#alert_spool').text(_msg);
            $('#submitBtn').removeAttr("disabled");

            $('input[name="name_module"]').val(hasil.name_module);
            $('input[name="id_module"]').val(hasil.id_module);
            $('input[name="name_discipline"]').val(hasil.name_discipline);
            $('input[name="id_discipline"]').val(hasil.id_discipline);
          } else {
            $("input[name=draw_no]").removeClass(_succ);
            $("input[name=draw_no]").addClass(_err);
            $('#alert_spool').text(_msg);

            $('input[name="name_module"]').val('');
            $('input[name="id_module"]').val('');
            $('input[name="name_discipline"]').val('');
            $('input[name="id_discipline"]').val('');

            $("#submitBtn").attr("disabled", true);
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
      });
    }
  }

  $("#drawing_no").autocomplete({
     source: "<?php echo base_url(); ?>additional/dc_check_drawing",
     autoFocus: true,
     classes: {
         "ui-autocomplete": "highlight"
     }
  });

</script>