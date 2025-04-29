<div id="content" class="container-fluid">
	<style>
	  a[aria-expanded=true] .fa-angle-double-down {
	   display: none;
	  }

	  a[aria-expanded=false] .fa-angle-double-up {
	    display: none;
	  }
	</style>
  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
           <a class="btn btn-primary" data-toggle="collapse" href="#collapseButton" role="button" aria-expanded="false" aria-controls="collapseButton">Filter &nbsp; <i class="fas fa-angle-double-down"></i><i class="fas fa-angle-double-up"></i></a>
        </div>
        <div class="collapse <?= $this->input->post() ? 'show' : '' ?>" id="collapseButton"> 
	        <div class="card-body bg-white overflow-auto">
	          <form action="" method="POST">
	            <div class="row">
	               <div class="col-6">
	                <div class="form-group row">
	                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Project ID<?= $this->input->post('project_id') ?></label>
	                  <div class="col-xl">
											<?php
												$project_search = $this->user_cookie[10];
												if($this->input->post('project_id') != ''){
													$project_search = $this->input->post('project_id');
												}
											?>
	                    <select class="form-control select2" name="project_id">
	                      <!-- <option value="">---</option> -->
	                      <?php foreach ($project_list as $key => $value) : ?>
													<?php if(in_array($value['id'], $this->user_cookie[13])): ?>
														<option value="<?php echo $value['id'] ?>" <?php echo ($value['id'] == $project_search ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
													<?php endif; ?>
	                      <?php endforeach; ?>
	                    </select>
	                  </div>
	                </div>
	              </div>
	            
	              <div class="col-6">
	                <div class="form-group row">
	                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Company</label>
	                  <div class="col-xl">

	                    <select class="form-control select2" name="company" >
	                      <option value="">---</option>
	                      <?php foreach ($company_list as $key => $value) : ?>
	                      <option value="<?php echo $value['id_company'] ?>" <?php echo (@$post['company'] == $value['id_company'] ? 'selected' : null) ?>><?php echo $value['company_name'] ?></option>
	                      <?php endforeach; ?>
	                    </select>
	                  </div>
	                </div>
	              </div>
	            </div>

	            <div class="row">
	               <div class="col-6">
	                <div class="form-group row">
	                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Designation</label>
	                  <div class="col-xl">
	                    <select class="form-control select2" name="designation">
	                      <option value="">---</option>
	                      <?php foreach ($designation_list as $key => $value) : ?>
	                      <option value="<?php echo $value['id_designation'] ?>" <?php echo (@$post['designation'] == $value['id_designation'] ? 'selected' : null) ?>><?php echo $value['designation_name'] ?></option>
	                      <?php endforeach; ?>
	                    </select>
	                  </div>
	                </div>
	              </div>
	            
	              <div class="col-6">
	                <div class="form-group row">
	                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Qualification</label>
	                  <div class="col-xl">
	                    <select class="form-control select2" name="qualification" >
	                      <option value="">---</option>
	                      <?php foreach ($qualification_list as $key => $value) : ?>
	                      <option value="<?php echo $value['id_qualification'] ?>" <?php echo (@$post['qualification'] == $value['id_qualification'] ? 'selected' : null) ?>><?php echo $value['qualification_name'] ?></option>
	                      <?php endforeach; ?>
	                    </select>
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
  </div>


  <div class="card shadow my-3 rounded-0">
    <div class="card-header">
      <h6 class="m-0"><?php echo $meta_title ?></h6>
    </div>
    
    <div class="card-body bg-white">
      <div class="row">
        <div class="col-md-8">
        <a href="<?php echo base_url() ?>master/ndter/personnel_new" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Add New</a>
        </div>
        <div class="col-md-4 text-right">
          <a href="<?= site_url('master/ndter/download_all_qr_code') ?>" class="btn btn-secondary"><i class="fas fa-qrcode"></i> Download All QR Code</a>
        </div>
      </div>
      <br>
      <br>
      <div class="overflow-auto">
        <table class="table table-hover text-center dataTable">
          <thead class="bg-gray-table">
            <tr>
              <th rowspan='2'>No</th>
              <th rowspan='2'>Project Name</th>
              <th rowspan='2'>Personel Name</th>
              <th rowspan='2'>Designation</th>
              <th rowspan='2'>Qualification</th>
              <th rowspan='2'>Certificate Number</th>
              <th rowspan='2'>PCN Number</th>
              <th rowspan='2'>ISO Number</th>
              <th rowspan='2'>Certificate<br/> Date Of Issued</th>
              <th rowspan='2'>Certificate<br/> Date Of Expired</th>
              <th rowspan='2'>Certificate File</th>
              <th colspan='5'>Mockup Test Result</th>
              <th rowspan='2'>Status</th>
              <th rowspan='2'>SIP No.</th>
              <th rowspan='2'>Company</th>
              <th rowspan='2'>Issued Date</th>
              <th rowspan='2'>Expired Date</th>
              <th rowspan='2'>Remarks</th>
              
              <th rowspan='2'>Total Joint Tested</th>
              <th colspan='4'>Result as Total Joint Tested</th>

              <th rowspan='2'>Total Length Tested</th>
              <th colspan='4'>Result as Total Length Tested</th>

              <th rowspan='2'>Status</th>
              <th rowspan='2'>Action</th>
              <th rowspan='2'>QR Code</th>
            </tr>
            <tr>
              <th>PLATE</th>
              <th>PIPE</th>
              <th>TJOINT</th>
              <th>NOZZLE</th>
              <th>NODE</th>     

              <th>Accepted</th>
              <th>%<br>Accepted</th>
              <th>Rejected</th>
              <th>%<br>Rejected</th>

              <th>Accepted</th>
              <th>%<br>Accepted</th>
              <th>Rejected</th>
              <th>%<br>Rejected</th>

            </tr>
          </thead>
          <tbody>
            <?php $no=1; foreach ($personnel_list as $key => $value): ?>

              <?php 
                if(isset($value['mock_up_test_result'])){
                  $mockup = explode(";",$value['mock_up_test_result']);
                  for($x=0;$x<5;$x++){ 
                    if($mockup[$x] == 1){
                      $show_mockup[$x] = "Pass";
                    } else if($mockup[$x] == 2){
                      $show_mockup[$x] = "Fail"; 
                    } else if($mockup[$x] == 3){
                      $show_mockup[$x] = "N/A"; 
                    } else {
                      $show_mockup[$x] = null;
                    }
                  } 
                }  

                $id_enc   = strtr($this->encryption->encrypt($value['id']), '+=/', '.-~')

              ?>

              <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo @$project_name[$value["project_id"]] ?></td>
                <td><?php echo $value["personel_name"] ?></td> 
                <td><?php echo @$designation_name[$value["designation"]]?></td> 
                <td><?php echo @$qualification_name[$value["qualification"]] ?></td> 
                <td><?php echo $value["certificate_number"] ?></td> 
                <td><?php echo $value["pcn_number"] ?></td> 
                <td><?php echo $value["iso_number"] ?></td> 
                <td><?php echo $value["date_of_issue"] ?></td> 
                <td><?php echo $value["date_of_expired"] ?></td> 
                <td>
                  <?php if(isset($value["attachment"]) && !empty($value["attachment"])){ ?>
                   <!-- <a href="<?php echo base_url_ftp(); ?>upload/ndt_personnel/<?php echo $value["attachment"] ?>" class="btn btn-sm btn-flat btn-dark"><i class="fas fa-file-download"></i></a> -->
                          <?php  
                            $enc_redline = strtr($this->encryption->encrypt($value["attachment"]), '+=/', '.-~');
                            $enc_path   = strtr($this->encryption->encrypt('/PCMS/pcms_v2/ndt_personnel/'), '+=/', '.-~'); 
                          ?>
                          <a target='_blank' href='<?= site_url('irn/open_file/'.$enc_redline.'/'.$enc_path) ?>'><span class='btn btn-primary'><i class="fas fa-images"></i></span></a>
                          <br/>
                   <?php } else { ?>
                    -
                  <?php } ?>
                </td> 
                <?php for($y=0;$y<5;$y++){ ?>
                <td><?php echo $show_mockup[$y] ?></td>
                <?php } ?> 
                <td><?php echo ($value["status"] == 0 ? "Active" : "Non-Active") ?></td> 
                <td><?php echo $value["sip_no"] ?></td> 
                <td><?php echo @$company_name[$value["company"]] ?></td> 
                <td><?php echo $value["issue_date"] ?></td> 
                <td><?php echo $value["expired_date"] ?></td> 
                <td><?php echo $value["remarks"] ?></td> 

                <!-- ============== KPI ============ -->
                <?php 
                	$performance = $kpi[$user[$value["sip_no"]]["id_user"]];
                	// test_var($performance, 1);
                ?>	
	                <td class="font-weight-bold"><u><?= $performance['total_joint']  + 0 ?></td> 
	                <td class="font-weight-bold"><u><?= $performance['accept']  + 0 ?></td> 
	                <td class="font-weight-bold"><u><?= ( !isset($performance) ? 0 : ($performance['accept']/($performance['accept']+$performance['reject']))*100)  + 0 ?></td> 
	                <td class="font-weight-bold"><u><?= $performance['reject']  + 0 ?></td> 
	                <td class="font-weight-bold"><u><?= ( !isset($performance) ? 0 : ($performance['reject']/($performance['accept']+$performance['reject']))*100)  + 0 ?></td>  

	                <td class="font-weight-bold"><u><?= $performance['total_length']  + 0 ?></td> 
	                <td class="font-weight-bold"><u><?= $performance['accept_length']  + 0 ?></td> 
	                <td class="font-weight-bold"><u><?= ( !isset($performance) ? 0 : ($performance['accept_length']/($performance['accept_length']+$performance['reject_length']))*100)  + 0 ?></td> 
	                <td class="font-weight-bold"><u><?= $performance['reject_length']  + 0 ?></td> 
	                <td class="font-weight-bold"><u><?= ( !isset($performance) ? 0 : ($performance['reject_length']/($performance['accept_length']+$performance['reject_length']))*100)  + 0 ?></td>
	              <?php 
                	unset($performance);
                ?>	
                <!-- ============== KPI ============ -->

                <td>
                  <span class="badge <?= $value['status'] == 0 ? 'badge-success' : 'badge-warning' ?>"><?= ($value["status"] == 0 ? 'Active' : 'Non-Active') ?></span>
                </td> 
                <td><a href="<?php echo base_url() ?>master/ndter/personnel_new/<?php echo strtr($this->encryption->encrypt($value["id"]), '+=/', '.-~') ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Update</a></td> 
                <td>
                  <a href="<?= site_url('master/ndter/export_personnel_qr/'.$id_enc) ?>" class="btn btn-secondary"><i class="fas fa-qrcode"></i></a>
                </td>
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