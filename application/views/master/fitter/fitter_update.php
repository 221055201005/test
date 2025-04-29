<div id="content" class="container-fluid">

  <div class="card shadow my-3 rounded-0">
    <div class="card-header">
      <h6 class="m-0"><?php echo $meta_title ?></h6>
    </div>

<?php if($this->permission_cookie[119] == '1'){ ?>

    <form action="<?php echo base_url() ?>master/fitter/fitter_update_process" enctype="multipart/form-data" method="POST">

    <div class="card-body bg-white">

      <a href='<?= base_url(); ?>master/fitter/fitter_list' class='btn btn-warning'><i class="fas fa-arrow-left"></i> Back</a>
      <br/>
      <br/>
     
      <div class="overflow-auto">



        <table class="table table-hover text-center ">
          <thead class="bg-green-smoe">
              <tr class="table-success">
                  <th><center>No</center></th>
                  <th><center>Company</center></th>
                  <th><center>Project</center></th>
                  <th><center>Type Of Module</center></th>
                  <th><center>Fitter Badge</center></th>
                  <th><center>Fitter Fullname</center></th>
                  <th><center>Validation Start Date</center></th>
                  <th><center>Validation End Date</center></th>
                  <th><center>Fitter Status</center></th>
              </tr>
          </thead>
          <tbody id="table_list">
            <?php $no=1; foreach ($fitter_list as $key => $value): ?>

              <input type="hidden" name="id_fitter[<?php echo $no; ?>]" value="<?php echo $value['id_fitter']; ?>">

              <tr>

                <td class="align-middle"><?php echo $no ?></td>

                
                <td class="align-middle">
                  <select class="form-control" name="company[<?php echo $no; ?>]" required> 
                    <option value="">---</option>
                    <?php foreach($company_list as $key => $valuea){ ?>
                      <option value="<?= $valuea['id_company'] ?>" <?= ($valuea['id_company'] == $value['company'] ? "selected" : "") ?>><?= $valuea['company_name'] ?></option>
                    <?php } ?>
                  </select>
                </td>

                <td class="align-middle">
                  <select class="form-control" name="project[<?php echo $no; ?>]" required> 
                    <option value="">---</option>
                    <?php foreach($project_list as $key => $valueb){ ?>
											<?php if(in_array($valueb['id'], $this->user_cookie[13])): ?>
                      	<option value="<?= $valueb['id'] ?>" <?= ($valueb['id'] == $value['project'] ? "selected" : "") ?>><?= $valueb['project_name'] ?></option>
											<?php endif; ?>
                    <?php } ?>
                  </select> 
                </td>

                <td class="align-middle">
                  <select class="form-control" name="type_of_module[<?php echo $no; ?>]" required> 
                    <option value="">---</option>
                    <?php foreach($type_of_module_list as $key => $valuec){ ?>
                      <option value="<?= $valuec['id'] ?>" <?= ($valuec['id'] == $value['module'] ? "selected" : "") ?>><?= $valuec['name'] ?></option>
                    <?php } ?>
                  </select>
                </td>

                <td class="align-middle"><input type='text' name='fit_up_badge[<?php echo $no; ?>]' class="form-control" value='<?php echo $value["fit_up_badge"] ?>'></td>
                <td class="align-middle"><input type='text' name='fitup_name[<?php echo $no; ?>]' class="form-control" value='<?php echo $value["fitup_name"] ?>'></td>
                <td class="align-middle"><input type='date' name='vsd[<?php echo $no; ?>]' class="form-control" value='<?php echo $value["vsd"] ?>'></td>
                <td class="align-middle"><input type='date' name='ved[<?php echo $no; ?>]' class="form-control" value='<?php echo $value["ved"] ?>'></td>

                        
                <td class="align-middle">
                  <select id="status<?php echo $no; ?>}" class="form-control" name="status[<?php echo $no; ?>]"> 
                    <option value="">---</option>
                    <option value="1" <?php if($value["status"] == "1"){ ?> selected <?php } ?>>Actived</option> 
                    <option value="0" <?php if($value["status"] == "0"){ ?> selected <?php } ?>>Non-Actived</option> 
                  </select> 
                </td>
                
              </tr>

            <?php $no++; endforeach; ?>

          </tbody>
        </table>
      </div>
      <div class="row">
          <div class="col-12 text-right">
            <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Submit</button>
          </div>
        </div>
    </div>

  </div>

</form>

<?php } ?>

</div>
</div>


<script type="text/javascript">

  console.log(<?php echo $nod; ?>);

  $(document).ready(function(){
    selectRefresh();
  });

  function selectRefresh() {
    $(".select2_multiple_position").select2({
        tags: true,
        allowClear: true,
        tokenSeparators: [', ', ' '],
    })
  }

  
  function delete_detail_fitter(btn , id_fitter) {
    Swal.fire({
      type : "warning",
      title : `<span class="text-danger">DELETE</span>`,
      html : `<i>Are you sure..?</i>`,
      showCancelButton: true
    }).then((res) => {
      if(res.value) {
        $.ajax({
          url : "<?= site_url('master/fitter/delete_detail_fitter') ?>",
          type : "POST",
          data : {
            id_fitter : id_fitter
          },
          dataType : "JSON",
          success: function(data) {
            if(data.success) {
              Swal.fire({
                type : "success",
                title : "SUCCESS",
                text : "Success Delete Data",
                timer : 1000
              })

              $(btn).closest('tr').remove()

            }
          }
        })
      }
    })
  }

var nodata  = <?php echo $nod; ?>;
  function add_row(input, index) {
    var html  = `<tr>
                  <td>
                    <input type="hidden" name="id_req[${index}][]" value="new_row">
                      <select class="form-control fitter_process" name="fitter_process[${index}][]" required>
                        <option value="">---</option>
                        <option>GTAW</option>
                        <option>GMAW</option>
                        <option>SMAW</option>
                        <option>FCAW</option>
                        <option>SAW</option>
                      </select>                                     
                    </td>
                   <td>
                     <select class="form-control select2_multiple_position" name="fitter_position[${index}][${nodata}][]" required multiple>
                         <option value="">---</option>
                         <option>1G</option>
                         <option>2G</option>
                         <option>3G</option>
                         <option>4G</option>
                         <option>5G</option>
                         <option>6G</option>
                         <option>6GR</option>
                     </select>
                   </td>
                 <td>
                   <button type="button" class="btn btn-danger  btn-sm" onclick="delete_attachment_row_2(this, ${index})"><i class="fas fa-trash-alt"></i></button>
                 </td>
              </tr>`;
  $("#row_detail").append(html);
  selectRefresh();
  nodata++;
}

function delete_attachment_row_2(input, index) {
  $(input).closest('tr').remove()
}


</script>