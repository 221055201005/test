<style>
	td.width_200{
		min-width: 200px;
	}
	#content{
		overflow-x: hidden;
	}
</style>
<div id="content" class="container-fluid">

  <div class="card shadow my-3 rounded-0">
    <div class="card-header">
      <h6 class="m-0"><?php echo $meta_title ?></h6>
    </div>

    <div class="card-body bg-white overflow-auto">

      <a href='<?= base_url(); ?>master/wps/wps_list' class='btn btn-warning'><i class="fas fa-arrow-left"></i> Back</a>

      <?php if($this->permission_cookie[113] == '1'){ ?>

      <form action="<?php echo base_url() ?>master/wps/wps_save_process" enctype="multipart/form-data" method="POST">
        
        <div class="overflow-auto media text-muted py-3 border-bottom border-gray">
            <div class="container-fluid">
              <table class="table" id='form-submit'>
                <thead>
                  <tr class="table-success">
                    <th><center>WPS No</center></th>
                    <th><center>Client Doc No</center></th>
                    <th><center>PQR No</center></th>
                    <th><center>WPS Company</center></th>
                    <th><center>WPS Project</center></th>
                    <th><center>WPS Revision</center></th>
                    <th><center>Discipline</center></th>                   
                    <th><center>Requirement</center></th>  
										<th><center>Position /  Welding progression</center></th>  
										<th><center>CTOD Requirement</center></th>  
										<th><center>Consumable Brand</center></th>  
										<th><center>Consumble classification</center></th>  
										<th><center>Document PWPS / WPS</center></th>  
                    <th><center>Remarks</center></th>
                    <th><center>Attachment</center></th>
                    <th><center>WPS Status</center></th>
                    <th><center><button type="button" class="btn btn-primary" title="Add Row" onclick="addrow();"><i class="fa fa-plus"></i></button></center></th>
                  </tr>
                </thead>
                <tbody id="table_list">
                  
                </tbody>
              </table>
            </div>
          </div>

        <br/>
        <div class="row">
          <div class="col-12 text-right">
            <button type="submit" class="btn btn-success" id='submitBtn' disabled><i class="fas fa-check"></i> Submit</button>
          </div>
        </div>
      </form>

      <?php } ?>
      
    </div>
  </div>

</div>
</div>

      

<script type="text/javascript">
  $(document).ready(function(){
    addrow();
  });

var count_data_row = 0;

  function addrow() {

  var html = `
    <tr id="remove${count_data_row}">

    <td class="align-middle width_200">
      <input type="text" class="form-control" name="wps_no[${count_data_row}]" placeholder="Input WPS No" id="wps_no[${count_data_row}]" onblur="check_wps(${count_data_row})"required>
      <span id="text_alert_wps${count_data_row}"></span>
    </td>

		<td class="align-middle width_200">
			<input type="text" class="form-control" name="client_doc_no[${count_data_row}]" placeholder="Input Client Doc No" required>
		</td>

		<td class="align-middle width_200">
			<input type="text" class="form-control" name="pqr_no[${count_data_row}]" placeholder="Input PQR No" required>
		</td>

    <td class="align-middle width_200">
      <select class="select2" style="width:100%" name="company_id[${count_data_row}]" required>
        <option value="">---</option>
        <?php foreach ($company_list as $key => $value): ?> 
         <option value="<?= $value['id_company'] ?>"><?= $value['company_name'] ?></option>
         
         <?php endforeach; ?>
      </select>
    </td>

    <td class="align-middle width_200">
      <select class="select2" style="width:100%" name="project_id[${count_data_row}]" required>
        <option value="">---</option>
        <?php foreach ($project_list as $key => $value): ?> 
					<?php if(in_array($value['id'], $this->user_cookie[13])): ?>
         		<option value="<?= $value['id'] ?>"><?= $value['project_name'] ?></option>
					<?php endif; ?>
        <?php endforeach; ?>
      </select>
    </td>

    <td class="align-middle width_200">
      <input type="text" class="form-control" name="wps_revision[${count_data_row}]" placeholder="Input WPS Revision" required>
    </td>

    <td class="align-middle width_200">
        <select id="discipline${count_data_row}" class="form-control discipline" name="discipline[${count_data_row}]" required>
        <option value="">---</option>
        <?php foreach ($discipline_list as $key => $value) : ?>
          <option value="<?php echo $value['id'] ?>"><?php echo $value['discipline_name'] ?></option>
        <?php endforeach; ?>       
        </select>
    </td>

    <td class="align-middle width_200">
        <table class="table table-borderless">
          <thead>
						<th><center>Process</center></th>
						<th><center>Material Grade</center></th>
						<th><center>Thickness Range (mm)</center></th>
						<th><center>Diameter Range (mm)</center></th>
						<th><center>Type Of Joint</center></th>
						<th><center>#</center></th>
          </thead>
           <tbody>
             <tr>

                <td class="width_200">
                <input type="hidden" name="id_req[${count_data_row}][]" value="new_row">
                  <select id="process${count_data_row}" class="form-control process" name="process[${count_data_row}][]" required>
                    <option value="">---</option>
                    <?php foreach ($master_weld_process as $key => $value) { ?>
                      <option value="<?= $value['id'] ?>"><?= $value['name_process'] ?></option>
                    <?php } ?>
                  </select>                                     
                </td>

               <td class="width_200">
                 <select id="material_grade${count_data_row}" class="form-control material_grade" name="material_grade[${count_data_row}][]" required>
                     <option value="">---</option>
                     <?php foreach ($material_grade_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>"><?php echo $value['material_grade'] ?></option>
                     <?php endforeach; ?>
                 </select>
               </td>

               <td class="width_200">
                 <input type="text" id="thickness${count_data_row}" class="form-control" name="thickness[${count_data_row}][]" required placeholder="Input Thickness Range (mm)">
               </td>

               <td class="width_200">
                 <input type="text" id="diameter${count_data_row}" class="form-control" name="diameter[${count_data_row}][]" required placeholder="Input Diameter Range (mm)">
               </td>

               <td class="width_200">
                 <select id="type_of_joint${count_data_row}" class="form-control type_of_joint" name="type_of_joint[${count_data_row}][]">
                   <option value="">---</option>
                    <?php foreach ($joint_type_list as $key => $value) : ?>
                    <option value="<?php echo $value['id'] ?>"><?php echo $value['joint_type_code'] ?></option>
                    <?php endforeach; ?>
                 </select>
               </td>

               <td>
                 <button type="button" class="btn btn-primary btn-sm" onclick="add_row_attachment_2(this, ${count_data_row})"><i class="fas fa-plus-circle"></i></button>
               </td>

             </tr>
           </tbody>
         </table>

    </td>

		<td class="align-middle width_200">
			<input type="text" class="form-control" name="position_welding_progression[${count_data_row}]" placeholder="Input Position /  Welding progression" required>
		</td>

		<td class="align-middle width_200">
      <select  id="ctod_requirement${count_data_row}" class="form-control" name="ctod_requirement[${count_data_row}]" required> 
        <option value="">---</option>
        <option>Yes</option> 
        <option>No</option>  
      </select>
		</td>

		<td class="align-middle width_200">
			<input type="text" class="form-control" name="consumable_brand[${count_data_row}]" placeholder="Input Consumable Brand" required>
		</td>

		<td class="align-middle width_200">
			<input type="text" class="form-control" name="consumable_classification[${count_data_row}]" placeholder="Input Consumble classification" required>
		</td>

		<td class="align-middle width_200">
      <select  id="document_pwps_wps${count_data_row}" class="form-control" name="document_pwps_wps[${count_data_row}]" required> 
        <option value="">---</option>
        <option>Existing</option> 
        <option>New Qualification</option>  
      </select>
		</td>

    <td class="align-middle width_200">
      <select  id="remarks${count_data_row}" class="form-control remarks" name="remarks[${count_data_row}]" > 
        <option value="">---</option>
        <option>CTOD</option> 
        <option>N/A</option>  
      </select>
    </td>

    <td class="align-middle width_200">
      
      <input type="file" name="attachment_1[${count_data_row}]">
    </td>
  
    <td class="align-middle width_200">
      <select id="status_wps${count_data_row}" class="form-control" name="status_wps[${count_data_row}]"> 
        <option value="">---</option>
        <option value="1">Actived</option> 
        <option value="0">Non-Actived</option> 
      </select> 
    </td>
   
    <td class="align-middle"><button type="button" class="btn btn-danger" title="Delete Row" onclick="deleterow(this,${count_data_row});"><i class="fa fa-trash"></i></button></td>

   </tr>`;
    

    $("#table_list").append(html);

    $('.select2').select2({
      theme : 'bootstrap'
    })
   
    count_data_row++;
  }

function change_label(input) {
  var value = $(input).val()
  var label = $(input).closest('.custom-file').find('label')
  var split = value.split('\\')

  label.text(split[split.length - 1])
}

  function add_row_attachment_2(input, index) {
    var table = $(input).closest('tbody');
    var html  = `<tr>
                  <td class="width_200">
                  <input type="hidden" name="id_req[${index}][]" value="new_row">
                    <select id="process${index}" class="form-control process" name="process[${index}][]" required>
                      <option value="">---</option>
                      <?php foreach ($master_weld_process as $key => $value) { ?>
                        <option value="<?= $value['id'] ?>"><?= $value['name_process'] ?></option>
                      <?php } ?>
                    </select>                                     
                  </td>
                 <td class="width_200">
                   <select id="material_grade${index}" class="form-control material_grade" name="material_grade[${index}][]" required>
                       <option value="">---</option>
                       <?php foreach ($material_grade_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>"><?php echo $value['material_grade'] ?></option>
                       <?php endforeach; ?>
                   </select>
                 </td>
                 <td class="width_200">
                   <input type="text" id="thickness${index}" class="form-control" name="thickness[${index}][]" required placeholder="Input Thickness Range (mm)">
                 </td>
                 <td class="width_200">
                   <input type="text" id="diameter${index}" class="form-control" name="diameter[${index}][]" required placeholder="Input Diameter Range (mm)">
                 </td>
                 <td class="width_200">
                   <select id="type_of_joint${index}" class="form-control type_of_joint" name="type_of_joint[${index}][]">
                      <option value="">---</option>
                      <?php foreach ($joint_type_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>"><?php echo $value['joint_type_code'] ?></option>
                      <?php endforeach; ?>
                   </select>
                 </td>
                 <td>
                   <button type="button" class="btn btn-danger  btn-sm" onclick="delete_attachment_row_2(this, ${index})"><i class="fas fa-trash-alt"></i></button>
                 </td>
              </tr>`;
  table.append(html);
}

function delete_attachment_row_2(input, index) {
  $(input).closest('tr').remove()
}

function deleterow(btn,no) {
  $(btn).closest('tr').remove();
  $('table#form-submit tr#remove'+no).remove();
}

</script>


<script type="text/javascript">
function check_wps(no) {
    $("#text_alert_wps"+no).removeAttr("hidden");
    var r_no = $("input[id='wps_no["+no+"]']").val();
    var wps_no_without_space = r_no.replace(/\s/g, "");

    if (wps_no_without_space == "") {
        $("input[id='wps_no["+no+"]']").val(wps_no_without_space);
        document.getElementById("text_alert_wps"+no).style.color = "red";
        $('#text_alert_wps'+no).text('Error: WPS No is Required');
        $("#submitBtn").attr("disabled", true);

    } else {

        $("input[id='wps_no["+no+"]']").val(wps_no_without_space);

        $.ajax({
            url: "<?= base_url() ?>master/wps/check_wps_register/" + r_no,
            type: "post",
            success: function(data) {
                if (data == 0) {
                    document.getElementById("text_alert_wps"+no).style.color = "green";
                    $('#text_alert_wps'+no).text('Success: WPS Code Available');
                    $('#submitBtn').removeAttr("disabled");
                } else {
                    document.getElementById("text_alert_wps"+no).style.color = "red";
                    $('#text_alert_wps'+no).text('Error: Double WPS No Code');
                    $("#submitBtn").attr("disabled", true);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
  }
}
</script>