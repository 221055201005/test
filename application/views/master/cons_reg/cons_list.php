<div id="content" class="container-fluid">

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">      
            <h6 class="m-0">Filter Data Welder</h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <form action="" method="POST">
            <div class="row">
               <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Project ID</label>
                  <div class="col-xl">
                    <select class="form-control select2" name="project_id">
                      <option value="">---</option>
                      <?php foreach ($project_list as $key => $value) : ?>
												<?php if(in_array($value['id'], $this->user_cookie[13])): ?>
                      		<option value="<?php echo $value['id'] ?>" <?php echo (@$post['project'] == $value['id'] ? 'selected' : ($this->user_cookie[10] == $value['id'] ? 'selected' : '')) ?>><?php echo $value['project_name'] ?></option>
												<?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold"></label>
                  <div class="col-xl">

                  </div>
                </div>
              </div>
            </div> 

            <div class="row">
              <div class="col-12 text-right">
                <button id='button_search' class="mt-2 btn btn-sm btn-flat btn-info" name='submit' type='submit' value='submit'><i class="fas fa-search"></i> Search</button>
                <button  class="mt-2 btn btn-sm btn-flat btn-success" name='submit' type='submit' value='download_excel'><i class="fas fa-file-excel"></i> Donwload</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <div class="card shadow my-3 rounded-0">
    <div class="card-header">
      <h6 class="m-0"><?php echo $meta_title ?></h6>
    </div>
    
    <div class="card-body bg-white">
      <a href="<?php echo base_url() ?>master/cons_reg/cons_new" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Add New</a>
      <br/><br/>
      <div class="overflow-auto">
        <table class="table table-hover text-center dataTable">
          <thead class="bg-green-smoe text-white">
            <tr>
              <th rowspan='2'>No</th>
              <th rowspan='2'>Project ID</th> 
              <th rowspan='2'>Welding Process</th>
              <th rowspan='2'>Brand Trade Name & Clasification</th>
              <th rowspan='2'>Manufacturer</th>
              <th rowspan='2'>Diameter Size (mm)</th>
              <th rowspan='2'>Batch Lot. No</th>  
              <th colspan='10'>WPS Used</th> 
              <th rowspan='2'>Action</th>   
            </tr> 
            <tr>
              <?php 
                for($i=1;$i<=10;$i++){
                  echo "<td style='width:100px !important;'>".$i."</td>";
                }
              ?>
            </tr>
          </thead>
          <tbody>
            <?php $no=1; foreach ($consumable_register as $key => $value): ?> 
              <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo @$project_name[$value["project_id"]] ?></td>
                <td><?php echo $value["welding_process"] ?></td>  
                <td><?php echo $value["brand_trade_name"] ?></td> 
                <td><?php echo $value["manufacture"] ?></td> 
                <td><?php echo $value["diameter_size"] ?></td> 
                <td><?php echo $value["batch_lot_number"] ?></td>

                <?php for($i=0;$i<=9;$i++){ ?>
                  <td><?php echo @$list_of_wps[$value['id_detail_register']][$i]; ?>  </td>  
                <?php } ?> 
                
                <td><a href="<?php echo base_url() ?>master/cons_reg/cons_new/<?php echo strtr($this->encryption->encrypt($value["id_register"]), '+=/', '.-~') ?>/<?php echo strtr($this->encryption->encrypt($value["id_detail_register"]), '+=/', '.-~') ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Update</a></td> 
              </tr>
            <?php $no++; endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
</div>
<script>
  $('.dataTable').DataTable({
    "order": []
  });
</script>