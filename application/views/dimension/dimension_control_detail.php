<?php  
  foreach($data_dc as $dc_list){
    $id = $dc_list['id'];
    $submission_id = $dc_list['submission_id'];
    $drawing_no = $dc_list['drawing_no'];
    $requestor = $dc_list['requestor'];
    $requestor_company = $dc_list['requestor_company'];
    $module = $dc_list['module'];
    $id_discipline = $dc_list['discipline'];
    $name_discipline = isset($discipline_list[$dc_list['discipline']]) ? $discipline_list[$dc_list['discipline']] : '-';
    $id_module = $dc_list['module'];
    $name_module = isset($module_list[$dc_list['module']]) ? $module_list[$dc_list['module']] : '-';
    $option_date = $dc_list['option_date'];
    $remarks = $dc_list['remarks'];

    $result = $dc_list['result'];


    //UNTUK FORM ACTION ===================
    $str_action = "dc_update";

    if($read_cookies[7] == '9'){
      $str_action = "dc_approval_proccess";
    }
    //=====================================
  }

?>
  <div id="content" class="container-fluid">
    <!-- <form method="POST" action="<?= base_url() ?>dimension/<?= $str_action ?>" enctype="multipart/form-data"> -->
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
                        <input type="text" class="form-control" name="draw_no" id="drawing_no" autocomplete="off" value="<?= $drawing_no ?>" required readonly>
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
                        <input type="text" class="form-control" name="requestor" placeholder="Requestor" value="<?= $this->user_cookie[1] ?>" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="form-group col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Requestor Company</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="requestor_company" value="<?= $requestor_company ?>" readonly>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Module</label>
                      <div class="col-sm-9">
                        <input type="hidden" name="module" value="<?= $id_module ?>">
                        <input type="text" class="form-control" value="<?= $name_module ?>" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="form-group col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Discipline</label>
                      <div class="col-sm-10">
                        <input type="hidden" name="discipline" value="<?= $id_discipline ?>">
                        <input type="text" class="form-control" value="<?= $name_discipline ?>" readonly>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Option Date</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="option_date" value="<?= $option_date ?>" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="form-group col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Remarks</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" name="remarks" readonly><?= $remarks ?></textarea>
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

                    <!-- ADD FORM UPLOAD BY AGUNG 25 AUG 2020 -->

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                      <li class="nav-item">
                        <a class="nav-link bg-info" data-toggle="tab"style="color:white;" >Attachment</a>
                      </li>
                    </ul>

                    <form action="<?php echo base_url();?>additional/upload_new_attachment" method="post" enctype="multipart/form-data">
                          <div class="row">
                            <div class="col-md">
                              <div class="form-group"><br/>
                                <label>Report Number</label>                               
                                <input type="text" name="report_number" class="form-control" autocomplete="off" required placeholder='Filling Up - DC Report Number'>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md">
                              <div class="form-group">
                                <label>DC Status :</label>
                                <select name='dc_status' class='form-control' required>
                                  <option value=''>~ Choice ~</option>
                                  <option value='1'>Before Welding</option>
                                  <option value='2'>After Welding</option>
                                  <option value='3'>Final Inspection</option>
                                </select>
                              </div>
                            </div>
                           </div>
                          <div class="row">
                            <div class="col-md">
                              <div class="form-group">
                                <label>Remarks Data :</label>
                                <textarea name='remarks' class='form-control' required=""></textarea>
                                <input type="hidden" class="form-control" name="submission_id" value="<?= $dc_list['submission_id']; ?>" autocomplete="off" readonly>
                              </div>
                            </div>
                           </div>
                           <div class="row"> 
                            <div class="col-md">
                              <div class="form-group">
                                <label>Select File to upload :</label>
                                <input type="file" name="file_attachment" required="">
                              </div>
                            </div>
                          </div>
                          <input type="submit" value="Upload File" name="submite" class='btn btn-secondary'>
                      </form>
                      
                        <br>
                        <br>

                    <!-- END ADD FORM UPLOAD BY AGUNG 25 AUG 2020 -->

                    <table class="table" id="table_dimension_add">
                      <thead>
                        <tr class="table table-success">
                          <th>Report Number</th>
                          <th>DC Status</th>
                          <th>Attachment</th> 
                          <th>Remarks</th>
                          <th>Uploaded By</th>
                          <th>Uploaded On</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($data_dc_attch as $dc_attch_list){ ?>
                        <tr class="table table-borderless">
                        <td><?= $dc_attch_list['report_number'] ?></td>
                        <td><?= ($dc_attch_list['dc_status'] == 1 ? "Before Welding" : ($dc_attch_list['dc_status'] == 2 ? "After Welding" : "Final Inspection")) ?></td>
                          <td>
                            <img width="20" height="20" src="<?= base_url() ?>img/pdf.svg">
                            <a target="_blank" href="https://www.smoebatam.com/pcms_v2_photo/dimension_control/<?= $dc_attch_list['attachment'] ?>"><?= $dc_attch_list['attachment'] ?></a>
                          </td>
                          <td><?= $dc_attch_list['remarks'] ?></td>
                          <td><?php echo (isset($user_list[$dc_attch_list['uploaded_by']]) ? $user_list[$dc_attch_list['uploaded_by']] : '-') ?></td>
                          <td><?= date('d M Y', strtotime($dc_attch_list['upload_on'])) ?></td>
                          <td>
                            <?php if($result == 0){ ?>
                                <?php if($read_permission[56] == 1){ ?>
                                  <button class="btn btn-danger" type="button" onclick="delete_attch(<?= $dc_attch_list['id'] ?>)"><i class="fa fa-trash"></i></button>
                                <?php } ?>
                            <?php } ?>
                            <a onclick="deleteConfirm('<?php echo site_url('additional/attachment_delete/'.$dc_attch_list['id'].'/'.$dc_attch_list['attachment'] .'/'.$dc_list['submission_id']) ?>')"
                                  href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i> Delete</a>
                          </td>
                        </tr>
                        <?php } ?>

                        <?php if($result == 0){ ?>
                        <tr class="table table-borderless">
                          <td>
                            <div class="custom-file">
                              <input type="hidden" name="id_file_attch[]" value="1">
                              <input type="file" class="custom-file-input" name="file_attch_1" onchange="get_name_file(this)">
                              <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                          </td>
                          <td><textarea class="form-control" name="remarks_file[]"></textarea></td>
                          <td><input type="text" name="uploaded_by" class="form-control" autocomplete="off" required readonly value="<?= $this->user_cookie[1] ?>"></td>
                          <td><input type="text" name="uploaded_on" class="form-control" autocomplete="off" required readonly value="<?= date('d M Y') ?>"></td>
                          <td>
                            <button class="btn btn-primary" type="button" onclick="add_new_row()"><i class="fa fa-plus"></i></button>
                          </td>
                        </tr>
                        <?php } ?>

                      </tbody>
                    </table>
                  </div>
                </div>

              </div>
            </div>

            <?php if($result == 0){ ?>

              <?php if($read_permission[54] == 1){ ?>
                <div class="text-right mt-3">
                    <button type="submit" name='submit' value="0" class="btn btn-primary" title="Save as Draft"><i class="fa fa-file"></i> Save</button>
                    <button type="submit" name='submit' value='1' class="btn btn-success" title="Submit"><i class="fa fa-plus"></i> Submit</button>
                    <button class="btn btn-secondary" type="button" onclick="window.history.back();"><i class="fa fa-times"></i> Close</button>
                </div>
              <?php } ?>

            <?php } else if($result == 3){ ?>
            <div class="text-right mt-3">
              <!-- <a href="#"><button class="btn btn-danger" type="button"><i class="fa fa-file-pdf"></i> Export to PDF</button></a> -->
              <button class="btn btn-secondary" type="button" onclick="window.history.back();"><i class="fa fa-times"></i> Close</button>
            </div>
            <?php } else if($result == 2 AND $read_cookies[7] != '9'){ ?>
            <div class="text-right mt-3">
              <!-- <a href="#"><button class="btn btn-success" type="button"><i class="fa fa-check"></i> Re-Submit</button></a> -->
              <button class="btn btn-secondary" type="button" onclick="window.history.back();"><i class="fa fa-times"></i> Close</button>
            </div>
            <?php } else if($result == 1 AND $read_cookies[7] == '9'){ ?>
             <input type="hidden" name="module" value="dimension_control_approval">
             <input type="hidden" name="user_id" value="<?php echo $read_cookies['0'] ?>">
             <input type="hidden" name="report_no" value="<?= $dc_list['submission_id'] ?>">
             <input type="hidden" name="id_dc" value="<?= $dc_list['id'] ?>">

            <div class="text-right mt-3">
              <!-- <button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Submit</button> -->
              <button class="btn btn-secondary" type="button" onclick="window.history.back();"><i class="fa fa-times"></i> Close</button>
            </div>
            <?php } else { ?>
            <div class="text-right mt-3">
              <button class="btn btn-secondary" type="button" onclick="window.history.back();"><i class="fa fa-times"></i> Close</button>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
    <!-- </form> -->
                    
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
            //
            '<td>' +
            '<div class="custom-file">' + 
            '<input type="hidden" name="id_file_attch[]" value="' + count + '">' +
            '<input type="file" class="custom-file-input" name="file_attch_' + count + '" onchange="get_name_file(this)" required>' +
            '<label class="custom-file-label" for="customFile[]">Choose file</label>' +
            '</div>' +
            '</td>' +
            //

            '<td><textarea class="form-control" name="remarks_file[]" required></textarea></td>' +
            '<td><input type="text" name="uploaded_by" class="form-control" autocomplete="off" required readonly value="<?= $this->user_cookie[1] ?>"></td>' +
            '<td><input type="text" name="uploaded_on" class="form-control" autocomplete="off" required readonly value="<?= date('d M Y') ?>"></td>' +
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

  function delete_attch(id_file_attch){
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.value) {
        delete_attch_action(id_file_attch);
      }
    })
  }

  function delete_attch_action(id_file_attch){
    $.ajax({
      url: "<?= base_url() ?>additional/delete_file_attch_process",
      type: "post",
      data: {
        'id_file' : id_file_attch,
      },
      success: function(data){
        Swal.fire(
          'Deleted!',
          'Your file has been deleted.',
          'success'
        ).then(function() {
          // Redirect the user
          location.reload();
        });
      },
      error: function(jqXHR, textStatus, errorThrown) {
         console.log(textStatus, errorThrown);
      }
    });
  }

  $('input[type=radio][name=status_approval]').change(function() {
    if (this.value == 2) {
      $('#div_remark_reject').show();
      $('#remarks_reject').attr("required","true");
    }
    else if (this.value == 3) {
      $('#div_remark_reject').hide();
      $('#remarks_reject').removeAttr("required");
    }
  });

</script>

<script>
function deleteConfirm(url){
  $('#btn-delete').attr('href', url);
  $('#deleteModal').modal();
}
</script>