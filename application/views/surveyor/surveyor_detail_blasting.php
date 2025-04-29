<?php

  $workpack       = $workpack_list;
  $total_weight   = 0;
  $num_piecemark  = 0;

?>

<script type="text/javascript">
  
  function validate_unique_no_after(input,no,desc) {

    var unique_no = input;

    var invalid_feedback = $('input[name="unique_no['+no+']"]').closest('tr').find('.invalid-feedback');

    if ($.trim(unique_no) == "") {
      $(input).addClass('is-invalid')
      invalid_feedback.text("Unique No Cannot Be Empty")
      return false;
    }

    $.ajax({
      url: "<?= site_url('planning/validate_unique_number_bnp') ?>",
      type: "POST",
      data: {
        unique_no: unique_no,
        desc: desc,
      },
      dataType: "JSON",
      success: function(data) {

        if(data.success) {

          var rowCount = $('#form_table tr').length;
          var sum = 0;
          for(var i=0;i<=rowCount;i++){
            if(i != no){
              var unique_no_rows = $('input[name="unique_no['+i+']"]').val();
              if(unique_no_rows == unique_no){
                sum += 1;
              }
            }
          }

            if(sum <= 0){

              $('input[name="unique_no['+no+']"]').addClass('is-valid');
              $('input[name="unique_no['+no+']"]').removeClass('is-invalid');
              $('input[name="grade['+no+']"]').val(data.result.grade);
              $('input[name="heat_number['+no+']"]').val(data.result.heat_no);
              $('input[name="length['+no+']"]').val(data.result.length);
              $('input[name="width_od['+no+']"]').val(data.result.width_od);
              $('input[name="thk['+no+']"]').val(data.result.thickness);
              $('input[name="uom['+no+']"]').val(data.result.uom);
              $('input[name="mrir_no['+no+']"]').val(data.result.mrir_no);
              $('input[name="approved_qty['+no+']"]').val(data.result.available_qty);

              $('input[name="qty['+no+']"]').removeAttr('disabled');

            } else {

              $('input[name="unique_no['+no+']"]').val('');
              $('input[name="unique_no['+no+']"]').addClass('is-invalid');
              invalid_feedback.text("Double Unique ID on the list..");

              $('input[name="qty['+no+']"]').attr('disabled', true);

            }
          
        } else {
        
          $('input[name="unique_no['+no+']"]').val('');
          $('input[name="unique_no['+no+']"]').addClass('is-invalid');
          invalid_feedback.text(data.text);

          $('input[name="qty['+no+']"]').attr('disabled', true)

        }

      }
    })
  }

  function validate_qty_input_after(input,no_baris,desc,req_qty) {

    var qty_input        = input;
    var approved_qty     = $('input[name="approved_qty['+no_baris+']"]').val();
    var invalid_feedback = $(input).closest('tr').find('.invalid-feedback')
    var rowCount = $('#form_table tr').length;

    var sum = 0;
    for(var i=0;i<=rowCount;i++){
       var desc_rows = $('input[name="desc['+i+']"]').val();
        if(desc_rows == desc){
          sum += Number($('input[name="qty['+i+']"]').val());
        }
    }

    var shortage = Number(sum) - Number(req_qty);
   
    if(Number(sum) < Number(req_qty)){

       $('input[name="qty['+no_baris+']"]').val();
       $('input[name="qty['+no_baris+']"]').addClass('is-invalid');

    } else {

      $('#invalid-feedback-qty').removeClass('is-invalid');
      $('input[name="qty['+no_baris+']"]').addClass('is-valid');
      $('input[name="qty['+no_baris+']"]').removeClass('is-invalid');

    }


  }

</script>


<div id="content" class="container-fluid">

  <form action="<?= site_url('planning/save_data_irn_raw') ?>" method="post">

    <input type="hidden" name="module_save" value="<?= $workpack['module'] ?>">
    <input type="hidden" name="project_save" value="<?= $workpack['project'] ?>">
    <input type="hidden" name="discipline_save" value="<?= $workpack['discipline'] ?>">
    <input type="hidden" name="type_of_module_save" value="<?= $workpack['type_of_module'] ?>">
    <input type="hidden" name="irn_type" value="2">
    <input type="hidden" name="wp_id" value="<?php echo @$workpack['id'] ?>">

    <div class="row">
      <div class="col">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0"><?php echo $meta_title ?></h6>
          </div>
          <div class="card-body bg-white overflow-auto">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Workpack No.</label>
                  <div class="col-md">
                    <input type="text" class="form-control" name="workpack_no" value="<?php echo @$workpack['workpack_no'] ?>" readonly>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Drawing No.</label>
                  <div class="col-md">
                    <input type="text" class="form-control" name="drawing_no" value="<?php echo @$workpack['drawing_no'] ?>" readonly>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Module</label>
                  <div class="col-md">
                    <select class="form-control" name="module" disabled>
                      <option value="">---</option>
                      <?php foreach ($module_list as $key => $value) : ?>
                      <option value="<?php echo $value['mod_id'] ?>" data-chained="<?php echo $value['project_id'] ?>" <?php echo (@$workpack['module'] == $value['mod_id'] ? 'selected' : '') ?>><?php echo $value['mod_desc'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Type Of Module</label>
                  <div class="col-md">
                    <select class="form-control" name="type_of_module" disabled>
                      <option value="">---</option>
                      <?php foreach ($type_of_module_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$workpack['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code']." - ".$value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Deck Elevation / Service Line</label>
                  <div class="col-md">
                    <select class="form-control" name="deck_elevation" disabled>
                      <option value="">---</option>
                      <?php foreach ($deck_elevation_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$workpack['deck_elevation'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code']." - ".$value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Discipline</label>
                  <div class="col-md">
                    <select class="form-control" name="discipline" disabled>
                      <option value="">---</option>
                      <?php foreach ($discipline_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo (@$workpack['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Phase</label>
                  <div class="col-md">
                    <select class="form-control" name="phase" disabled>
                      <option value="PF" <?php echo (@$workpack['phase'] == "PF" ? 'selected' : '') ?>>Pre-Fabrication</option>
                      <option value="FB" <?php echo (@$workpack['phase'] == "FB" ? 'selected' : '') ?>>Fabrication</option>
                      <option value="AS" <?php echo (@$workpack['phase'] == "AS" ? 'selected' : '') ?>>Assembly</option>
                      <option value="ER" <?php echo (@$workpack['phase'] == "ER" ? 'selected' : '') ?>>Erection</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Description Assy Code</label>
                  <div class="col-md-8 col-lg-9">
                    <select class="form-control select2" name="desc_assy" disabled>
                      <option value="">---</option>
                      <?php foreach ($desc_assy_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$workpack['desc_assy'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code']." - ".$value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Description</label>
                  <div class="col-md">
                    <input type="text" class="form-control" name="description" value="<?php echo @$workpack['description'] ?>" disabled>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Job No.</label>
                  <div class="col-md">
                    <input type="text" class="form-control" name="job_no" value="<?php echo @$workpack['job_no'] ?>" disabled>
                  </div>
                </div>
              </div>
            </div>
            <?php
              $job_description = explode(";", $workpack['job_description']);
            ?>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Job Description</label>
                </div>
              </div>
              <?php foreach ($job_description_list as $key => $value): ?>
              <div class="col-md-3">
                <label class="">
                  <input type="checkbox" class="checkbox-big" name="job_description[]" value="<?php echo $value['description'] ?>" <?php echo (in_array($value['description'], $job_description) ? "checked" : "") ?> disabled> 
                  <span class="position-absolute ml-2 font-weight-bold text-dark"> <?php echo $value['description'] ?></span>
                </label>
              </div>
              <?php endforeach; ?>
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
            <div class="overflow-auto">

               <table class="table table-hover text-center dataTable">
                <thead class="bg-green-smoe text-white">
                  <tr>
                    <th>No.</th>
                    <th>Desc Material</th>
                    <th>Length</th>
                    <th>Qty</th>
                    <th>Area</th>
                    <th>Remarks</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($detail_list as $key => $value): ?>
                  <tr>
                    <td><?php echo ($key+1) ?></td>
                    <td>
                      <input type="text" name="material[]" class="form-control autocomplete_material" value="<?php echo @$material_catalog_list[$value['id_template']]['material'] ?>" readonly required>
                    </td>
                    <td>
                      <input type="text" name="length[]" class="form-control" value="<?php echo @$material_catalog_list[$value['id_template']]['length_m'] ?>" readonly required>
                    </td>
                    <td>
                      <?php echo $value['qty'] ?>
                    </td>
                    <td>
                      <?php echo $value['area'] ?>
                    </td>
                    <td>
                      <?php if(isset($value['remarks'])){ echo $value['remarks']; } else { echo "-"; } ?>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>

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
            <div class="overflow-auto">

               <div class="form-group col-md-3">
                 <label>Material Location :</label>
                 <select class="form-control" name="material_location" required="true">
                    <option value=""> ~ Select Location ~ </option>
                   <?php foreach ($location_list as $key => $value) { ?>
                      <option value="<?php echo $value["id"] ?>" <?php if($irn_detail_list[0]['material_location'] == $value["id"]){ echo "selected"; } ?>><?php echo $value["location_name"] ?></option>
                   <?php } ?>
                 </select>
               </div>

              <table class="table table-hover text-center dataTable" id='form_table'>
                <thead class="bg-green-smoe text-white">
                  <tr style="font-weight: bold;">
                    <td valign="middle" rowspan="2" class="font-weight-bold"><center>Description</center></td>
                    <td valign="middle" rowspan="2" class="font-weight-bold"><center>Spec/Grade</center></td>
                    <td valign="middle" rowspan="2" class="font-weight-bold"><center>Heat/Series No</center></td>
                    <td valign="middle" colspan="3" class="font-weight-bold"><center>Size ( In MM )</center></td>
                    <td valign="middle" rowspan="2" class="font-weight-bold"><center>Request Qty</center></td>
                    <td valign="middle" rowspan="2" class="font-weight-bold"><center>Approved Qty</center></td>
                    <td valign="middle" rowspan="2" class="font-weight-bold"><center>Issued Qty</center></td>
                    <td valign="middle" rowspan="2" class="font-weight-bold"><center>Shortage QTY</center></td>
                    <td valign="middle" rowspan="2" class="font-weight-bold"><center>UoM</center></td>
                    <td valign="middle" rowspan="2" class="font-weight-bold"><center>MRIR No.</center></td>
                    <td valign="middle" rowspan="2" class="font-weight-bold"><center>Unique Ident No.</center></td>
                    <td valign="middle" rowspan="2" class="font-weight-bold"><center>Remarks</center></td>
                    <td valign="middle" rowspan="2" class="font-weight-bold"><center>&nbsp;&nbsp;&nbsp;&nbsp;#&nbsp;&nbsp;&nbsp;&nbsp;</center></td>
                  </tr>
                  <tr>
                    <td valign="middle" class="font-weight-bold"><center>Length</center></td>
                    <td valign="middle" class="font-weight-bold"><center>Width/OD</center></td>
                    <td valign="middle" class="font-weight-bold"><center>Thk</center></td>                  
                  </tr>
                </thead>

                <tbody  id='table_data'>

                  <?php if($total_irn_data <= 0){ ?>


                      <?php 
                        $no = 0;
                        foreach ($detail_list as $key => $value): 
                          $description_of_material = @$material_catalog_list[$value['id_template']]['material'];
                      ?>
                      <tr id="remove<?php echo $no; ?>">
                        <td>
                          <input type="text" name="desc[<?php echo $no; ?>]" class="form-control" value="<?php echo @$material_catalog_list[$value['id_template']]['material'] ?>" readonly required>
                          <input type="hidden" name="no[<?php echo $no; ?>]" class="form-control" value="<?php echo $no; ?>" readonly required>
                          <input type="hidden" name="id_template[<?php echo $no; ?>]" class="form-control" value="<?php echo $value['id_template']; ?>" readonly required>
                          <input type="hidden" name="status_process[<?php echo $no; ?>]" class="form-control" value="add" readonly required>
                        </td>
                        <td>
                          <input type="text" name="grade[<?php echo $no; ?>]" class="form-control"  readonly >
                        </td>
                        <td>
                          <input type="text" name="heat_number[<?php echo $no; ?>]" class="form-control"  readonly >
                        </td>
                        <td>
                          <input type="text" name="length[<?php echo $no; ?>]" class="form-control" readonly >
                        </td>
                        <td>
                          <input type="text" name="width_od[<?php echo $no; ?>]" class="form-control" readonly >
                        </td>
                        <td>
                          <input type="text" name="thk[<?php echo $no; ?>]" class="form-control" readonly >
                        </td>
                        <td>
                          <input type="text" name="request_qty[<?php echo $no; ?>]" class="form-control" value='<?php echo $value['qty'] ?>' readonly >
                        </td>
                        <td>
                          <input type="text" name="approved_qty[<?php echo $no; ?>]" class="form-control" readonly >
                        </td>
                        <td>
                          <input type="text" name="qty[<?php echo $no; ?>]" class="form-control" placeholder='Input Available Qty' onkeyup="validate_qty_input(this,'<?php echo $no; ?>','<?= $description_of_material ?>','<?= $value['qty'] ?>')" onblur="validate_qty_input(this,'<?php echo $no; ?>','<?= $description_of_material ?>','<?= $value['qty'] ?>')"  disabled>
                          <div class="invalid-feedback" id="invalid-feedback-qty"></div>
                        </td>
                        <td>
                          <input type="text" name="shortage_qty[<?php echo $no; ?>]" class="form-control"  readonly >
                        </td>
                        <td>
                          <input type="text" name="uom[<?php echo $no; ?>]" class="form-control" readonly >
                        </td>
                        <td>
                          <input type="text" name="mrir_no[<?php echo $no; ?>]" class="form-control" readonly >
                        </td>
                        <td>
                          <input type="text" name="unique_no[<?php echo $no; ?>]" class="form-control" placeholder='Input Unique ID' onfocus="autocomplete_unique_bnp(this,'<?php echo $no; ?>','<?= $description_of_material ?>')" onblur="validate_unique_no(this,'<?php echo $no; ?>','<?= $description_of_material ?>')" onkeydown="validate_unique_no(this,'<?php echo $no; ?>','<?= $description_of_material ?>')" onkeyup="validate_unique_no(this,'<?php echo $no; ?>','<?= $description_of_material ?>')" >
                          <div class="invalid-feedback"></div>
                        </td>
                    
                        <td>
                          <input type="text" name="remarks[<?php echo $no; ?>]" class="form-control"  >
                        </td>
                        <td>
                          <button type="button" class="btn btn-primary" title="Add Row" onclick="addrow('<?php echo @$material_catalog_list[$value['id_template']]['material'] ?>','<?php echo $no; ?>','<?php echo $value['qty']; ?>','<?php echo $value['id_template']; ?>');"><i class="fa fa-plus"></i></button>
                        </td>
                       
                      </tr>
                      <?php $no++; endforeach; ?>

                <?php } else { ?>


                    <?php 
                        $no = 0;
                        foreach ($irn_detail_list as $key => $value): 
                          $description_of_material = @$material_catalog_list[$value['id_template']]['material'];
                      ?>
                      <tr id="remove<?php echo $no; ?>">
                        <td>
                          <input type="text" name="desc[<?php echo $no; ?>]" class="form-control" value="<?php echo @$material_catalog_list[$value['id_template']]['material'] ?>" readonly required>
                          <input type="hidden" name="no[<?php echo $no; ?>]" class="form-control" value="<?php echo $no; ?>" readonly >
                          <input type="hidden" name="id_template[<?php echo $no; ?>]" class="form-control" value="<?php echo $value['id_template']; ?>" readonly >
                          <input type="hidden" name="status_process[<?php echo $no; ?>]" class="form-control" value="update" readonly >
                          <input type="hidden" name="id_pcms_irn_detail[<?php echo $no; ?>]" class="form-control" value="<?php echo  $value['id_pcms_irn_detail'] ?>" readonly required>
                          <input type="hidden" name="id_irn_main[<?php echo $no; ?>]" class="form-control" value="<?php echo  $value['id_irn_main'] ?>" readonly >
                          <input type="hidden" name="irn_no[<?php echo $no; ?>]" class="form-control" value="<?php echo  $value['irn_no'] ?>" readonly required>
                          <input type="hidden" name="id_template[<?php echo $no; ?>]" class="form-control" value="<?php echo  $value['id_template'] ?>" readonly >
                        </td>
                        <td>
                          <input type="text" name="grade[<?php echo $no; ?>]" class="form-control"  readonly >
                        </td>
                        <td>
                          <input type="text" name="heat_number[<?php echo $no; ?>]" class="form-control"  readonly >
                        </td>
                        <td>
                          <input type="text" name="length[<?php echo $no; ?>]" class="form-control" readonly >
                        </td>
                        <td>
                          <input type="text" name="width_od[<?php echo $no; ?>]" class="form-control" readonly >
                        </td>
                        <td>
                          <input type="text" name="thk[<?php echo $no; ?>]" class="form-control" readonly >
                        </td>
                        <td>
                          <input type="text" name="request_qty[<?php echo $no; ?>]" class="form-control" value='<?php echo $value['qty_request'] ?>' readonly >
                        </td>
                        <td>
                          <input type="text" name="approved_qty[<?php echo $no; ?>]" class="form-control" readonly >
                        </td>
                        <td>
                          <input type="text" name="qty[<?php echo $no; ?>]" class="form-control" placeholder='Input Available Qty' onkeyup="validate_qty_input(this,'<?php echo $no; ?>','<?= $description_of_material ?>','<?= $value['qty_request'] ?>')" onblur="validate_qty_input(this,'<?php echo $no; ?>','<?= $description_of_material ?>','<?= $value['qty_request'] ?>')" required disabled value='<?php echo $value['qty_issued'] ?>'>
                          <div class="invalid-feedback" id="invalid-feedback-qty"></div>
                          <script type="text/javascript">validate_qty_input_after(<?= $value['qty_issued'] ?>,'<?php echo $no; ?>','<?= $description_of_material ?>','<?= $value['qty_request'] ?>')</script>
                        </td>
                        <td>
                          <input type="text" name="shortage_qty[<?php echo $no; ?>]" class="form-control" readonly >
                        </td>
                        <td>
                          <input type="text" name="uom[<?php echo $no; ?>]" class="form-control" readonly >
                        </td>
                        <td>
                          <input type="text" name="mrir_no[<?php echo $no; ?>]" class="form-control" readonly >
                        </td>
                        <td>
                          <input type="text" name="unique_no[<?php echo $no; ?>]" class="form-control" placeholder='Input Unique ID' onfocus="autocomplete_unique_bnp(this,'<?php echo $no; ?>','<?= $description_of_material ?>')" onblur="validate_unique_no(this,'<?php echo $no; ?>','<?= $description_of_material ?>')" onkeydown="validate_unique_no(this,'<?php echo $no; ?>','<?= $description_of_material ?>')" onkeyup="validate_unique_no(this,'<?php echo $no; ?>','<?= $description_of_material ?>')"   value='<?php echo $value['id_master_irn_detail'] ?>'>
                          <div class="invalid-feedback"></div>
                          <script type="text/javascript">validate_unique_no_after('<?php echo $value['id_master_irn_detail'] ?>','<?php echo $no; ?>','<?= $description_of_material ?>')</script>
                        </td>
                    
                        <td>
                          <input type="text" name="remarks[<?php echo $no; ?>]" class="form-control"  value='<?php echo $value['remarks'] ?>'>
                        </td>
                        <td>
                          <button type="button" class="btn btn-primary" title="Add Row" onclick="addrow('<?php echo @$material_catalog_list[$value['id_template']]['material'] ?>','<?php echo $no; ?>','<?php echo $value['qty_issued']; ?>','<?php echo $value['id_pcms_irn_detail'] ?>','<?php echo  $value['id_irn_main'] ?>','<?php echo  $value['irn_no'] ?>','<?php echo  $value['id_template'] ?>');"><i class="fa fa-plus"></i></button>
                        </td>
                       
                      </tr>
                      <?php $no++; endforeach; ?>


                <?php } ?>

                </tbody>
              </table>
                            
            </div>  
            
            <br>
            <br>
            <div class="text-right">
              <?php if($total_irn_data <= 0){ ?>
                <button type="submit" id="btn_submit" class="btn btn-success"><i class="fas fa-check"></i> Submit</button>
              <?php } else { ?>
                <button type="submit" id="btn_submit" class="btn btn-warning"><i class="far fa-edit"></i> Update</button>
              <?php } ?>
            </div>
                  
          </div>
        </div>
      </div>
    </div>

  </form>

</div>
</div>
<script>

  function validate_qty_input(input,no_baris,desc,req_qty) {

    var qty_input    = $(input).val();
    var approved_qty = $('input[name="approved_qty['+no_baris+']"]').val();

    var invalid_feedback = $(input).closest('tr').find('.invalid-feedback')

    var rowCount = $('#form_table tr').length;

    var sum = 0;
    for(var i=0;i<=rowCount;i++){
       var desc_rows = $('input[name="desc['+i+']"]').val();
        if(desc_rows == desc){
          sum += Number($('input[name="qty['+i+']"]').val());
        }
    }

    var shortage = Number(sum) - Number(req_qty);

    for(var i=0;i<=rowCount;i++){
       var desc_rows = $('input[name="desc['+i+']"]').val();
        if(desc_rows == desc){
         $('input[name="shortage_qty['+i+']"]').val(shortage);
        }
    }
    
    if(Number(qty_input) <= 0){

      $(input).val();
      $(input).addClass('is-invalid');
      invalid_feedback.text("Please type correct Qty..");

    } else if(Number(qty_input) > Number(approved_qty)){

      $(input).val();
      $(input).addClass('is-invalid');
      invalid_feedback.text("Qty Input More Thank Approved Qty..");

    } else if(Number(sum) > Number(req_qty)){

       $(input).val();
       $(input).addClass('is-invalid');
       invalid_feedback.text("Total "+ sum +" qty has been exceeded from request qty "+req_qty);

    } else if(Number(sum) < Number(req_qty)){

       $(input).val();
       $(input).addClass('is-invalid');
       invalid_feedback.text("total qty "+ sum +" still has a shortage from request qty "+req_qty);

    } else {

      $('#invalid-feedback-qty').removeClass('is-invalid');
       $(input).addClass('is-valid');
       $(input).removeClass('is-invalid');
       

    }


  }

  var count_data_row = <?php echo $no; ?>;

  <?php if($total_irn_data <= 0){ ?>


  function addrow(id_template,no_baris,req_qty,id_templatex) {
    
    var html = `
    <tr id="remove${count_data_row}">

        <td>
          <input type="text" name="desc[${count_data_row}]" class="form-control" value="${id_template}" readonly required>
          <input type="hidden" name="no[${count_data_row}]" class="form-control" value="${count_data_row}" readonly required>
          <input type="hidden" name="id_template[${count_data_row}]" class="form-control" value="${id_templatex}" readonly required>
        </td>

        <td>
          <input type="text" name="grade[${count_data_row}]" class="form-control"  readonly required>
        </td>

        <td>
          <input type="text" name="heat_number[${count_data_row}]" class="form-control"  readonly required>
        </td>

        <td>
          <input type="text" name="length[${count_data_row}]" class="form-control" readonly required>
        </td>

        <td>
          <input type="text" name="width_od[${count_data_row}]" class="form-control" readonly required>
        </td>

        <td>
          <input type="text" name="thk[${count_data_row}]" class="form-control" readonly required>
        </td>

        <td>
          <input type="text" name="request_qty[${count_data_row}]" class="form-control" value='${req_qty}' readonly required>
        </td>

        <td>
          <input type="text" name="approved_qty[${count_data_row}]" class="form-control" readonly required>
        </td>

        <td>
          <input type="text" name="qty[${count_data_row}]" class="form-control" placeholder='Input Available Qty'  onkeyup="validate_qty_input(this,'${count_data_row}','${id_template}','${req_qty}')" onblur="validate_qty_input(this,'${count_data_row}','${id_template}','${req_qty}')" required disabled>
          <div class="invalid-feedback" id="invalid-feedback-qty"></div>
        </td>

        <td>
          <input type="text" name="shortage_qty[${count_data_row}]" class="form-control" readonly required>
        </td>

        <td>
          <input type="text" name="uom[${count_data_row}]" class="form-control" readonly required>
        </td>

        <td>
          <input type="text" name="mrir_no[${count_data_row}]" class="form-control" readonly required>
        </td>
        
        <td>
          <input type="text" name="unique_no[${count_data_row}]" class="form-control" placeholder='Input Unique ID' onfocus="autocomplete_unique_bnp(this,'${count_data_row}','${id_template}')" onblur="validate_unique_no(this,'${count_data_row}','${id_template}')" onkeydown="validate_unique_no(this,'${count_data_row}','${id_template}')" onkeyup="validate_unique_no(this,'${count_data_row}','${id_template}')" required>
          <div class="invalid-feedback"></div>
        </td>
    
        <td>
          <input type="text" name="remarks[${count_data_row}]" class="form-control"  required>
        </td>
        <td>
          <button type="button" class="btn btn-danger" title="Delete Row" onclick="deleterow(this,${count_data_row});"><i class="fa fa-trash"></i></button>
        </td>

    </tr>`;
      

    $("#remove"+no_baris).after(html);
    count_data_row++;

  } 


  <?php } else { ?>

     function addrow(id_template,no_baris,req_qty,id_pcms_irn_detail,id_irn_main,irn_no,id_templatex) {

    var html = `
    <tr id="remove${count_data_row}">

        <td>
          <input type="text" name="desc[${count_data_row}]" class="form-control" value="${id_template}" readonly required>
          <input type="hidden" name="no[${count_data_row}]" class="form-control" value="${count_data_row}" readonly required>
          <input type="hidden" name="status_process[${count_data_row}]" class="form-control" value="update" readonly required>
          <input type="hidden" name="id_pcms_irn_detail[${count_data_row}]" class="form-control" value="new" readonly required>
          <input type="hidden" name="id_irn_main[${count_data_row}]" class="form-control" value="${id_irn_main}" readonly required>
          <input type="hidden" name="irn_no[${count_data_row}]" class="form-control" value="${irn_no}" readonly required>
          <input type="hidden" name="id_template[${count_data_row}]" class="form-control" value="${id_templatex}" readonly required>
        </td>

        <td>
          <input type="text" name="grade[${count_data_row}]" class="form-control"  readonly required>
        </td>

        <td>
          <input type="text" name="heat_number[${count_data_row}]" class="form-control"  readonly required>
        </td>

        <td>
          <input type="text" name="length[${count_data_row}]" class="form-control" readonly required>
        </td>

        <td>
          <input type="text" name="width_od[${count_data_row}]" class="form-control" readonly required>
        </td>

        <td>
          <input type="text" name="thk[${count_data_row}]" class="form-control" readonly required>
        </td>

        <td>
          <input type="text" name="request_qty[${count_data_row}]" class="form-control" value='${req_qty}' readonly required>
        </td>

        <td>
          <input type="text" name="approved_qty[${count_data_row}]" class="form-control" readonly required>
        </td>

        <td>
          <input type="text" name="qty[${count_data_row}]" class="form-control" placeholder='Input Available Qty'  onkeyup="validate_qty_input(this,'${count_data_row}','${id_template}','${req_qty}')" onblur="validate_qty_input(this,'${count_data_row}','${id_template}','${req_qty}')" required disabled>
          <div class="invalid-feedback" id="invalid-feedback-qty"></div>
        </td>

        <td>
          <input type="text" name="shortage_qty[${count_data_row}]" class="form-control" readonly required>
        </td>

        <td>
          <input type="text" name="uom[${count_data_row}]" class="form-control" readonly required>
        </td>

        <td>
          <input type="text" name="mrir_no[${count_data_row}]" class="form-control" readonly required>
        </td>
        
        <td>
          <input type="text" name="unique_no[${count_data_row}]" class="form-control" placeholder='Input Unique ID' onfocus="autocomplete_unique_bnp(this,'${count_data_row}','${id_template}')" onblur="validate_unique_no(this,'${count_data_row}','${id_template}')" onkeydown="validate_unique_no(this,'${count_data_row}','${id_template}')" onkeyup="validate_unique_no(this,'${count_data_row}','${id_template}')" required>
          <div class="invalid-feedback"></div>
        </td>
    
        <td>
          <input type="text" name="remarks[${count_data_row}]" class="form-control"  required>
        </td>
        <td>
          <button type="button" class="btn btn-danger" title="Delete Row" onclick="deleterow(this,${count_data_row});"><i class="fa fa-trash"></i></button>
        </td>

    </tr>`;

    $("#remove"+no_baris).after(html);
    count_data_row++;

  } 

  <?php } ?>

   function deleterow(btn,no) {
    $(btn).closest('tr').remove();
    $('table#form-submit tr#remove'+no).remove();
  }



  function autocomplete_unique_bnp(input,no,desc){
    $(input).autocomplete({
      source: "<?php echo base_url(); ?>planning/autocomplete_uniq_bnp/"+desc,
      autoFocus: true,
      classes: {
        "ui-autocomplete": "highlight"
      }
    });
  }


  function validate_unique_no(input,no,desc) {

    var unique_no = $(input).val()

    var invalid_feedback = $(input).closest('tr').find('.invalid-feedback');

    if ($.trim(unique_no) == "") {
      $(input).addClass('is-invalid')
      invalid_feedback.text("Unique No Cannot Be Empty")
      return false;
    }

    $.ajax({
      url: "<?= site_url('planning/validate_unique_number_bnp') ?>",
      type: "POST",
      data: {
        unique_no: unique_no,
        desc: desc,
      },
      dataType: "JSON",
      success: function(data) {

        if(data.success) {

          var rowCount = $('#form_table tr').length;
          var sum = 0;
          for(var i=0;i<=rowCount;i++){
            if(i != no){
              var unique_no_rows = $('input[name="unique_no['+i+']"]').val();
              if(unique_no_rows == unique_no){
                sum += 1;
              }
            }
          }

            if(sum <= 0){

              $(input).addClass('is-valid');
              $(input).removeClass('is-invalid');
              $('input[name="grade['+no+']"]').val(data.result.grade);
              $('input[name="heat_number['+no+']"]').val(data.result.heat_no);
              $('input[name="length['+no+']"]').val(data.result.length);
              $('input[name="width_od['+no+']"]').val(data.result.width_od);
              $('input[name="thk['+no+']"]').val(data.result.thickness);
              $('input[name="uom['+no+']"]').val(data.result.uom);
              $('input[name="mrir_no['+no+']"]').val(data.result.mrir_no);
              $('input[name="approved_qty['+no+']"]').val(data.result.available_qty);

              $('input[name="qty['+no+']"]').removeAttr('disabled');

            } else {

              $(input).val('');
              $(input).addClass('is-invalid');
              invalid_feedback.text("Double Unique ID on the list..");

              $('input[name="qty['+no+']"]').attr('disabled', true);

            }
          
        } else {
        
          $(input).val('');
          $(input).addClass('is-invalid');
          invalid_feedback.text(data.text);

          $('input[name="qty['+no+']"]').attr('disabled', true)

        }

      }
    })
  }

  $("select[name=module]").chained("select[name=project]");

  $('.dataTable').DataTable({
     lengthMenu: [ [10, 25, 50, 100, 200, 500, -1], [10, 25, 50, 100, 200, 500, "All"] ],
    pageLength: 200,
    order: [],
  })

 
  function update_percent_detail(input,wp_id, temp_id, progress, phase) {

    var percent_val = $(input).val();

    Swal.fire({
      title: 'Are you sure to <b class="text-danger">&nbsp;Update&nbsp;</b> this?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Update it!'
    }).then((result) => {
      if (result.value) {
        $.ajax( {
          url: "<?php echo base_url() ?>planning/save_update_to_percent",
          data: {
            wp_id: wp_id,
            temp_id: temp_id,
            percent_val: percent_val,
            progress: progress,
            phase: phase,
            pos_1: "N/A",
            pos_2: "N/A",
          },
          type: 'post',
          success: function(data) {
            sweetalert("success", "Update Data Success!");
            location.reload();
          }
        });
      }
    })

  }
</script>