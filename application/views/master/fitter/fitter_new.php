<div id="content" class="container-fluid">

  <div class="card shadow my-3 rounded-0">
    <div class="card-header">
      <h6 class="m-0"><?php echo $meta_title ?></h6>
    </div>

    <div class="card-body bg-white overflow-auto">

      <a href='<?= base_url(); ?>master/fitter/fitter_list' class='btn btn-warning'><i class="fas fa-arrow-left"></i> Back</a>

      <?php if($this->permission_cookie[118] == '1'){ ?>

      <form action="<?php echo base_url() ?>master/fitter/fitter_save_process" enctype="multipart/form-data" method="POST">
        
        <div class="overflow-auto media text-muted py-3 border-bottom border-gray">
            <div class="container-fluid">
              <table class="table" id='form-submit'>
                <thead>
                  <tr class="table-success">
                    <th><center>Company</center></th>
                    <th><center>Project</center></th>
                    <th><center>Type Of Module</center></th>
                    <th><center>Fitter Badge</center></th>
                    <th><center>Fitter Fullname</center></th>
                    <th><center>Validation Start Date</center></th>
                    <th><center>Validation End Date</center></th>
                    <th><center>Fitter Status</center></th>
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
            <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Submit</button>
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
    selectRefresh();
  });

  function selectRefresh() {
    $(".select2_multiple_position").select2({
        tags: true,
        allowClear: true,
        tokenSeparators: [', ', ' '],
    })
  }

var count_data_row = 0;

  function addrow() {

  var html = `
    <tr id="remove${count_data_row}">

      <td class="align-middle">
          <select class="form-control" name="company[${count_data_row}]" required> 
            <option value="">---</option>
            <?php foreach($company_list as $key => $value){ ?>
              <option value="<?= $value['id_company'] ?>"><?= $value['company_name'] ?></option>
            <?php } ?>
          </select> 
      </td>

      <td class="align-middle">
          <select class="form-control" name="project[${count_data_row}]" required> 
            <option value="">---</option>
            <?php foreach($project_list as $key => $value){ ?>
							<?php if(in_array($value['id'], $this->user_cookie[13])): ?>
              	<option value="<?= $value['id'] ?>"><?= $value['project_name'] ?></option>
							<?php endif; ?>
            <?php } ?>
          </select> 
      </td>

      <td class="align-middle">
          <select class="form-control" name="type_of_module[${count_data_row}]" required> 
            <option value="">---</option>
            <?php foreach($type_of_module_list as $key => $value){ ?>
              <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
            <?php } ?>
          </select> 
      </td>

      <td class="align-middle">
        <input type="text" class="form-control" name="fit_up_badge[${count_data_row}]" placeholder="Input Fitter Code" required>
      </td>

      <td class="align-middle">
        <input type="text" class="form-control" name="fitup_name[${count_data_row}]" placeholder="Input Fitter Code" required>
      </td>

      <td class="align-middle">
        <input type="date" class="form-control" name="vsd[${count_data_row}]" placeholder="Input Fitter Code" required>
      </td>

      <td class="align-middle">
        <input type="date" class="form-control" name="ved[${count_data_row}]" placeholder="Input Fitter Code" required>
      </td>    
  
      <td class="align-middle">
        <select class="form-control" name="status[${count_data_row}]"> 
          <option value="">---</option>
          <option value="1">Actived</option> 
          <option value="0">Non-Actived</option> 
        </select> 
      </td>
   
      <td class="align-middle"><button type="button" class="btn btn-danger" title="Delete Row" onclick="deleterow(this,${count_data_row});"><i class="fa fa-trash"></i></button></td>

   </tr>`;
    

    $("#table_list").append(html);
   
    count_data_row++;
  }

function change_label(input) {
  var value = $(input).val()
  var label = $(input).closest('.custom-file').find('label')
  var split = value.split('\\')

  label.text(split[split.length - 1])
}
  
 
function delete_attachment_row_2(input, index) {
  $(input).closest('tr').remove()
}

function deleterow(btn,no) {
  $(btn).closest('tr').remove();
  $('table#form-submit tr#remove'+no).remove();
}

</script>