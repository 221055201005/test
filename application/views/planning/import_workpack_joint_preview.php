<?php

?>
<div id="content" class="container-fluid">

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white">
          <h6 class="font-weight-bold text-info"><i class="fas fa-info-circle"></i> Drag the header to expand column.</h6>
          <form method="POST" action="<?php echo base_url() ?>planning/import_workpack_joint_process">
            <div class="overflow-auto">
              <table class="table table-hover text-center dataTable">
                <thead class="bg-green-smoe text-white text-nowrap">
                  <tr>
										<th>PROJECT</th>
										<th>DISCIPLINE</th>
										<th>MODULE</th>
										<th>TYPE OF MODULE</th>
										<th>Deck Elevation / Service Line</th>
										<th>DESC ASSY</th>
										<th>PHASE</th>
										<th>DRAWING GA / AS / CP / CL</th>
										<th>DRAWING WM</th>
										<th>JOINT NO</th>
										<th>POS#1</th>
										<th>POS#2</th>
										<th>ASSIGN COMPANY</th>
										<th>YARD COMPANY</th>
										<th>DESCRIPTION</th>
										<th>JOB NO</th>
										<th>JOB DESC</th>
										<th>PLAN START DATE</th>
										<th>PLAN FINISH DATE</th>
										<th>ACTUAL START DATE</th>
										<th>ACTUAL FINISH DATE</th>
										<th>AREA</th>
										<th>LOCATION</th>
										<th>REMARKS</th>
										<th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  foreach ($sheet as $key => $value) : 
										$status = "";
										if(!isset($company_list[$value['N']])){
											$status = "Assigned Company Not Found!";
										}
										elseif(!isset($company_list[$value['O']])){
											$status = "Yard Company Not Found!";
										}
										elseif(!isset($area_v2_list[$value['W']])){
											$status = "Area Not Found!";
										}
										elseif(!isset($location_v2_list[$value['W']][$value['X']])){
											$status = "Location Not Found!";
										}
                  ?>
                  <tr style="background: <?php echo ($status != "" ? "#f8d7da" : "") ?>">
                    <td><?php echo $value['B'] ?></td>
                    <td><?php echo $value['C'] ?></td>
                    <td><?php echo $value['D'] ?></td>
                    <td><?php echo $value['E'] ?></td>
                    <td><?php echo $value['F'] ?></td>
                    <td><?php echo $value['G'] ?></td>
                    <td><?php echo $value['H'] ?></td>
                    <td><?php echo $value['I'] ?></td>
                    <td><?php echo $value['J'] ?></td>
                    <td><?php echo $value['K'] ?></td>
                    <td><?php echo $value['L'] ?></td>
                    <td><?php echo $value['M'] ?></td>
                    <td>
											<input type="hidden" value="<?php echo $value['A'] ?>" <?php echo ($status != "" ? "disabled" : "readonly" ) ?> name="id[]">
											<input type="hidden" value="<?php echo $value['N'] ?>" <?php echo ($status != "" ? "disabled" : "readonly" ) ?> name="company_id[]">
											<input type="text" class="form-control" value="<?php echo $company_list[$value['N']] ?>" <?php echo ($status != "" ? "disabled" : "readonly" ) ?>>
										</td>
                    <td>
											<input type="hidden" value="<?php echo $value['O'] ?>" <?php echo ($status != "" ? "disabled" : "readonly" ) ?> name="company_yard[]">
											<input type="text" class="form-control" value="<?php echo $company_list[$value['O']] ?>" <?php echo ($status != "" ? "disabled" : "readonly" ) ?>>
										</td>
                    <td>
											<input type="text" class="form-control" value="<?php echo $value['P'] ?>" <?php echo ($status != "" ? "disabled" : "readonly" ) ?> name="description[]">
										</td>
                    <td>
											<input type="text" class="form-control" value="<?php echo $value['Q'] ?>" <?php echo ($status != "" ? "disabled" : "readonly" ) ?> name="job_no[]">
										</td>
                    <td>
											<input type="text" class="form-control" value="<?php echo $value['R'] ?>" <?php echo ($status != "" ? "disabled" : "readonly" ) ?> name="job_description[]">
										</td>
                    <td>
											<input type="date" class="form-control" value="<?php echo $value['S'] ?>" <?php echo ($status != "" ? "disabled" : "readonly" ) ?> name="plan_start_date[]">
										</td>
                    <td>
											<input type="date" class="form-control" value="<?php echo $value['T'] ?>" <?php echo ($status != "" ? "disabled" : "readonly" ) ?> name="plan_finish_date[]">
										</td>
                    <td>
											<input type="date" class="form-control" value="<?php echo $value['U'] ?>" <?php echo ($status != "" ? "disabled" : "readonly" ) ?> name="actual_start_date[]">
										</td>
                    <td>
											<input type="date" class="form-control" value="<?php echo $value['V'] ?>" <?php echo ($status != "" ? "disabled" : "readonly" ) ?> name="actual_finish_date[]">
										</td>
                    <td>
											<input type="hidden" value="<?php echo $value['W'] ?>" <?php echo ($status != "" ? "disabled" : "readonly" ) ?> name="area_v2[]">
											<input type="text" class="form-control" value="<?php echo $area_v2_list[$value['W']] ?>" <?php echo ($status != "" ? "disabled" : "readonly" ) ?>>
										</td>
                    <td>
											<input type="hidden" value="<?php echo $value['X'] ?>" <?php echo ($status != "" ? "disabled" : "readonly" ) ?> name="location_v2[]">
											<input type="text" class="form-control" value="<?php echo $location_v2_list[$value['W']][$value['X']] ?>" <?php echo ($status != "" ? "disabled" : "readonly" ) ?>>
										</td>
                    <td>
											<input type="text" class="form-control" value="<?php echo $value['Y'] ?>" <?php echo ($status != "" ? "disabled" : "readonly" ) ?> name="remarks[]">
										</td>
										<td class="font-weight-bold"><?php echo $status ?></td>
                  </tr>
                  <?php 
                  endforeach; 
                  ?>
                </tbody>
              </table>
            </div>
            <br>
            <div class="row">
              <div class="col-12 text-right">
                <button class="mt-2 btn btn-sm btn-flat btn-success"><i class="fas fa-check"></i> Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>
</div><!-- ini div dari sidebar yang class wrapper -->