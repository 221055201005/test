  
<div id="content" class="container-fluid"> 

    <div class="row">
        <div class="col">
            <div class="card shadow my-3 rounded-0">
                <div class="card-header"> 
                    <h6 class="m-0"><?= $meta_title ?></h6> 
                </div>
                <div class="card-body bg-white overflow-auto">
                <form action="" method="POST" id='form-filter'>

            <div class="row"> 

               <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label text-muted ">Project ID</label>
                  <div class="col-xl">
                    <select class="form-control" name="project" required  >
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
                  <label class="col-md-4 col-lg-3 col-form-label text-muted ">Discipline</label>
                  <div class="col-xl">
                    <select class="form-control" name="discipline" >
                      <option value="">---</option>
                      <?php foreach ($discipline_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo (@$post['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

            </div> 

            <div class="row">

            <div class="col-6">
                <div class="form-group row">
                <label class="col-md-4 col-lg-3 col-form-label text-muted ">Module</label>
                  <div class="col-xl">
                    <select class="form-control" name="module" >
                      <option value="">---</option>
                      <?php foreach ($module_list as $key => $value) : ?>
                      <option value="<?php echo $value['mod_id'] ?>" data-chained="<?php echo $value['project_id'] ?>" <?php echo (@$post['module'] == $value['mod_id'] ? 'selected' : '') ?>><?php echo $value['mod_desc'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
 
              <div class="col-6">
                <div class="form-group row">
                <label class="col-md-4 col-lg-3 col-form-label text-muted ">Type Of Module</label>
                  <div class="col-xl">
                    <select class="form-control" name="type_of_module" >
                      <option value="">---</option>
                      <?php foreach ($type_of_module_list as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo (@$post['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code']." - ".$value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div> 

              

            </div>  
                           

            <div class="row">


              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label text-muted ">Deck Elevation / Service Line</label>
                  <div class="col-xl">
                    <select type="text" class="form-control select2" name="deck_elevation" >
                        <option value=''>~ Choose ~</option>
                        <?php foreach($deck_elevation_list as $key => $value){ ?> 
                        <option value='<?php echo $value["id"] ?>' <?= ($post["deck_elevation"] == $value["id"] ? "selected" : null) ?>><?php echo $value["name"] ?></option>
                        <?php } ?>
                    <select> 
                  </div>
                </div>
              </div> 

              <div class="col-6">
                <div class="form-group row">
                <label class="col-md-4 col-lg-3 col-form-label text-muted ">Company </label>
                  <div class="col-xl">
                    <select class="form-control select2" name="company_id"   onchange='autofilter(this);'>
                      <option value=''>~ Choose ~</option>
                      <?php foreach($company_list as $key => $value){ ?>
												<?php if($this->user_cookie[11] == 1 || in_array($value['id_company'], $this->user_cookie[14])){ ?>
													<option value='<?= $value['id_company'] ?>' <?= ($value['id_company'] == @$post['company_id'] ? "selected" : ($value['id_company'] == $this->user_cookie[11] ? "selected" : "")) ?>><?= $value['company_name'] ?></option>
                      	<?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>

            </div>

            <div class="row">

              <div class="col-6">
                <div class="form-group row">
                <label class="col-md-4 col-lg-3 col-form-label text-muted ">Status Inspection</label>
                  <div class="col-xl">
                      <select name='status_inspection' class='form-control'>
                         <option value=''>~ Choose ~</option>
                         <option value='1' <?= (1 == @$post['status_inspection'] ? "selected"  : '') ?>>Pending Approval</option>
                         <option value='3' <?= (3 == @$post['status_inspection'] ? "selected"  : '') ?>>Approved</option>
                         <option value='2' <?= (2 == @$post['status_inspection'] ? "selected"  : 'selected') ?>>Rejected</option>
                      </select>
                  </div>
                </div>
              </div> 

              <div class="col-6">
                <div class="form-group row">
                <label class="col-md-4 col-lg-3 col-form-label text-muted "> </label>
                  <div class="col-xl">
                    
                  </div>
                </div>
              </div> 

            </div>
            
            <div class="row">
              <div class="col-12 text-right">
                <hr>
                  <?php //if(!isset($post) OR empty($post)){ ?>
                    <button id='button_search' class="mt-2 btn btn-sm btn-flat btn-info"><i class="fas fa-search"></i> Search</button>
                  <?php //} ?>
                  <!-- <button type="button" class="mt-2 btn btn-sm btn-flat btn-warning" onclick="reset_pages();"><i class="fas fa-sync-alt"></i> Reset</button> -->
              </div>            
            </div>
          </form>
                </div>
            </div>
        </div>
    </div> 
 

      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0"><?php echo $meta_title ?></h6>
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
          <div class="container-fluid">
            <table class="table table-hover text-center dataTable" width="100%">
              <thead class="bg-green-smoe text-white">
                <tr>  
                  <th>Project</th>
                  <th>Workpack No.</th>                            
                  <th>Submisison No.</th>
                  <th>Drawing No.</th>
                  <th>Discipline</th>
                  <th>Module</th>
                  <th>Type of Module</th>
                  <th>Deck Elevation / Service Line</th>
                  <th>Company</th>
                  <th>Surveyor Submission</th>
                  <th>Inspection Status</th>
                  <th style="min-width: 150px;">Action</th>
                </tr>
              </thead>   
              <tbody>
                <?php 
                  foreach ($itr_submission as $key => $value) { 

                    $where_status['submission_id'] = $value['submission_id']; 
                    $data_material = $this->planning_mod->itr_submission_list_detail($where_status);
                    unset($where_status); 

                    $total_data       = sizeof($data_material);
                    $total_data_all   = array_column($data_material,"status_inspection");
                    $counts           = array_count_values($total_data_all);
                    $total_pass_arr     = @$counts[3];
                    $total_reject_arr   = @$counts[2];
                    $total_pending_arr  = @$counts[1];  

                    if(isset($total_pending_arr)){
                      $status_inspection = "<span class='badge badge-warning'>Pending Approval</span>"; 
                    } else if(isset($total_reject_arr)){
                      $status_inspection = "<span class='badge badge-danger'>Rejected</span>";  
                    } else {
                      $status_inspection = "<span class='badge badge-success'>Approved</span>";  
                    } 
                   
                ?>
                <tr>
                  <td><?php echo $project_list_show[$value['project']]["project_name"]; ?></td> 
                  <td><?php echo $value['workpack_no']; ?></td>                           
                  <td><?php echo $value['submission_id']; ?></td>
                  <td><?php echo $value['drawing_ga']; ?></td>
                  <td><?php echo $discipline_list[$value['discipline']]['discipline_name']; ?></td>
                  <td><?php echo $module_list[$value['module']]['mod_desc']; ?></td>
                  <td><?php echo $type_of_module_list[$value['type_of_module']]['name']; ?></td>
                  <td><?php echo $deck_elevation_list[$value['deck_elevation']]['name']; ?></td>
                  <td><?php echo $company_name[$value['company_id']]; ?></td>
                  <td>
                        <table class="table table-borderless table-sm" style="font-size: 11px;">
                          <tbody> 
                            <tr>
                              <td class="text-nowrap"><strong><i>Action By</i></strong></td>
                              <td class="text-nowrap">:</td>
                              <td class="text-nowrap"><?= (isset($value['surveyor_creator']) ? $user_list[$value['surveyor_creator']] : null ) ?></td>
                            </tr>
                            <tr>
                              <td class="text-nowrap"><strong><i>Action Date</i></strong></td>
                              <td class="text-nowrap">:</td>
                              <td class="text-nowrap"><?= (isset($value['surveyor_creator']) ? $value['surveyor_created_date'] : null ) ?></td>
                            </tr>
                          </tbody>
                        </table>  
                  </td>  
                  <td>  
                        <table class="table table-borderless table-sm" style="font-size: 11px;">
                          <tbody>
                          <tr>
                              <td class="text-nowrap"><strong><i>Inspection Result</i></strong></td>
                              <td class="text-nowrap">:</td>
                              <td class="text-nowrap"><?= $status_inspection ?></td>
                            </tr>
                            <tr>
                              <td class="text-nowrap"><strong><i>Last Inspection By</i></strong></td>
                              <td class="text-nowrap">:</td>
                              <td class="text-nowrap"><?= (isset($value['inspection_by']) ? $user_list[$value['inspection_by']] : null ) ?></td>
                            </tr>
                            <tr>
                              <td class="text-nowrap"><strong><i>Last Inspection Date</i></strong></td>
                              <td class="text-nowrap">:</td>
                              <td class="text-nowrap"><?= (isset($value['inspection_by']) ? $value['inspection_datetime'] : null ) ?></td>
                            </tr>
                          </tbody>
                        </table> 
                  </td>               
                  <td>
                    <div class="btn-group">
                      <a href='<?php echo base_url(); ?>planning/submited_detail_itr/<?php echo strtr($this->encryption->encrypt($value['submission_id']),'+=/', '.-~') ; ?>' class='btn btn-primary'>
                        <i class='fas fa-list'></i> Detail
                      </a> 
                    </div>
                  </td>
                </tr>
            <?php } ?>
              </tbody>           
            </table>
          </div>
        </div>
      </div>
    

</div>
</div>
 
<script type="text/javascript"> 
  $(document).ready(function(){ 
    $('.dataTable').DataTable({
      order: [],
    }) 
    
    $("select[name=module]").chained("select[name=project]");
  }); 
</script>