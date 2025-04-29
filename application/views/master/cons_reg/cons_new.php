<style type="text/css">
 .select2_multiple_wps{
    width: 150px !important;
  } 
</style>

<div id="content" class="container-fluid">

  <div class="card shadow my-3 rounded-0">
    <div class="card-header">
      <h6 class="m-0"><?php echo $meta_title ?></h6>
    </div>

    <div class="card-body bg-white overflow-auto">
      <a href="<?php echo base_url() ?>master/cons_reg/consumable_list" class="btn btn-sm btn-warning"><i class="fas fa-arrow-left"></i> Back</a><br/><br/>

      <form action="<?php echo base_url() ?>master/cons_reg/cons_<?php echo $module ?>_process" method="POST" enctype="multipart/form-data">
        
      <input type="hidden" name="id" value="<?php echo @$cons_list['id_register'] ?>">

        <div class="row">

          <div class="col-12">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Project ID</label>
              <div class="col-md">
                 <select name='project_id' class='select2 form-control' required>
                   <option value=''>~ Choose ~</option>
                   <?php foreach($show_project as $key => $value){ ?>
                        <option value="<?= $value["id"] ?>" <?= ($value["id"] == @$cons_list["project_id"] || $this->user_cookie[10] == $value["id"] ? "selected" : null) ?>><?= $value["project_name"] ?></option>
                   <?php } ?>
                 </select>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Welding Process</label>
              <div class="col-md">
                <textarea type='text' class='form-control' name='welding_process' placeholder='Type Welding Process' required><?php echo @$cons_list['welding_process']; ?></textarea>
              </div>
            </div>
          </div> 

          <div class="col-12">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Brand Trade Name & Classification</label>
              <div class="col-md">
              <textarea type='text' class='form-control' name='brand_trade_name' placeholder='Type Brand Trade Name' required><?php echo @$cons_list['brand_trade_name']; ?></textarea>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Manufacture</label>
              <div class="col-md">
              <textarea type='text' class='form-control' name='manufacture' placeholder='Type Manufacture' required><?php echo @$cons_list['manufacture']; ?></textarea>
              </div>
            </div>
          </div> 

          <div class="col-12">
            <div class="form-group row">

              <table class="table" id='form-submit' width="100%">
                <thead>
                  <tr class="table-success">
                    <th><center>Diameter Size</center></th>
                    <th><center>Batch Lot No</center></th> 
                    <th><center>WPS No</center></th> 
                    <th>
                      <center>
                      <?php if($module != "update"){ ?>  
                        <button type="button" class="btn btn-primary" title="Add Row" onclick="addrow();"><i class="fa fa-plus"></i></button>
                        <?php } else { ?>
                          #
                        <?php } ?>
                      </center>
                    </th>
                  </tr>
                </thead>
                <tbody id="table_list">    
                   <?php if($module == "update"){ ?>              
                   <?php $no=0; foreach($detail_consumable_list as $key => $value){ ?>

                    <tr id="remove<?= $no ?>">
                    
                      <input type="hidden" class="form-control" name="id_detail_register[<?= $no ?>]" value='<?= $value["id_detail_register"] ?>' required>

                      <td class="align-middle">
                        <input type="text" class="form-control" name="diameter_size[<?= $no ?>]" placeholder="Type Diameter Size (mm)" value='<?= $value["diameter_size"] ?>' required>
                      </td>
                      <td class="align-middle"> 
                        <input type="text" class="form-control" name="batch_lot_number[<?= $no ?>]" placeholder="Type Batch Lot No" value='<?= $value["batch_lot_number"] ?>' required> 
                      </td> 
                      <td>
                          <select class="form-control select2_multiple_wps" name="id_wps[<?= $no ?>][]" required multiple>
                              <option value="">---</option> 
                              <?php foreach($wps_register_list as $key => $value){ ?>                                
                                <option value='<?= $value['id_wps'] ?>' <?php if(in_array($value['id_wps'],$detail_wps)){ echo "selected"; } ?>><?= $value['wps_no'] ?></option>          
                              <?php } ?>          
                          </select>
                      </td>
                      <td class="align-middle">
                        <center>
                          <button type="button" class="btn btn-danger" title="Delete Row" onclick="deleterow(this,<?= $no ?>);"><i class="fa fa-trash"></i></button>
                        </center>
                      </td>
                    </tr>

                   <?php $no++; } ?>                  
                   <?php } ?>                  
                </tbody>
              </table>
               
            </div>
          </div>


        </div>

        <div class="row">
          <div class="col-12 text-right">
            <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>

</div>
</div>

<script type='text/javascript'>

  $(document).ready(function(){
    <?php if($module != "update"){ ?>
      addrow(); 
    <?php } ?>
    selectRefresh();
  });

  function selectRefresh() {
    $(".select2_multiple_wps").select2({ 
        allowClear: true,
        tokenSeparators: [', ', ' '],
    }) 
  }
  var count_data_row = 0;
  function addrow() {
  
    var html = `
      <tr id="remove${count_data_row}">
        <td class="align-middle">
          <input type="text" class="form-control" name="diameter_size[${count_data_row}]" placeholder="Type Diameter Size (mm)" required>
        </td>
        <td class="align-middle"> 
          <input type="text" class="form-control" name="batch_lot_number[${count_data_row}]" placeholder="Type Batch Lot No" required> 
        </td> 
        <td>
            <select class="form-control select2_multiple_wps" name="id_wps[${count_data_row}][]" placeholder='~Choose~' required multiple>
                <option value="">---</option> 
                <?php foreach($wps_register_list as $key => $value){ ?>
                  <option value='<?= $value['id_wps'] ?>'><?= $value['wps_no'] ?></option>          
                <?php } ?>          
            </select>
        </td>
        <td class="align-middle"><center>
          <button type="button" class="btn btn-danger" title="Delete Row" onclick="deleterow(this,${count_data_row});"><i class="fa fa-trash"></i></button>
        </center></td>
      </tr>`;

    $("#table_list").append(html);
    count_data_row++;
    selectRefresh();
    
  }

  function deleterow(btn,no) {
    $(btn).closest('tr').remove();
    $('table#form-submit tr#remove'+no).remove();
  }

</script>