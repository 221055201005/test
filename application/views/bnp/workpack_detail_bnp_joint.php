<?php
$workpack = $workpack_list;
$total_weight = 0;
$num_piecemark = 0;
if ($workpack['phase'] == "PF") {
  $piecemark_list = $template_list;
}
foreach ($piecemark_list as $key => $value) {
  $num_piecemark++;
  $total_weight += $value['weight'];
}
?>
<div id="content" class="container-fluid"> 

   <form id="form_create_workpack" method="POST" action="<?php echo base_url() ?>planning/update_process_workpack_bnp">

   <div class="row">
       <div class="col-md-12">
           <div id="con_work_date" class="card shadow my-3 rounded-0">
             <div class="card-header">
               <h6 class="m-0">Workpack Blasting & Painting</h6>
             </div>
             <div class="card-body bg-white overflow-auto">

             <div class="row">
                 <div class="col-md-6">
                   <div class="form-group row">
                     <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Workpack No.</label>
                     <div class="col-md">
                       <input type="hidden" class="form-control" name="id_workpack" value="<?php echo @$id_workpack ?>" readonly>
                       <input type="text" class="form-control" name="workpack_no" value="<?php echo @$workpack_detail[0]['workpack_no'] ?>" readonly>
                     </div>
                   </div>
                 </div>
                 <div class="col-md-6">
                     <div class="form-group row">
                     <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Project</label>
                     <div class="col-md">
                       <select class="form-control" name="project" required>
                         <option value="">---</option>
                         <?php foreach ($project_list as $key => $value) : ?>
                         <option value="<?php echo $value['id'] ?>" <?php echo (@$this->user_cookie[10] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                         <?php endforeach; ?>
                       </select>
                     </div>
                     </div>
                   </div>
               </div> 
               <div class="row">
                 <div class="col-md-6">
                   <div class="form-group row">
                     <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Module</label>
                     <div class="col-md">
                       <select class="form-control" name="module" required>
                         <option value="">---</option>
                         <?php foreach ($module_list as $key => $value) : ?>
                           <option value="<?php echo $value['mod_id'] ?>" data-chained="<?php echo $value['project_id'] ?>" <?php echo (@$workpack_detail[0]['module'] == $value['mod_id'] ? 'selected' : '') ?>><?php echo $value['mod_desc'] ?></option>
                         <?php endforeach; ?>
                       </select>
                     </div>
                   </div>
                 </div>
                 <div class="col-md-6">
                   <div class="form-group row">
                     <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Type Of Module</label>
                     <div class="col-md">
                       <select class="form-control" name="type_of_module" required>
                         <option value="">---</option>
                         <?php foreach ($type_of_module_list as $key => $value) : ?>
                           <option value="<?php echo $value['id'] ?>" <?php echo (@$workpack_detail[0]['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code'] . " - " . $value['name'] ?></option>
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
                       <select class="form-control" name="deck_elevation" required>
                         <option value="">---</option>
                         <?php foreach ($deck_elevation_list as $key => $value) : ?>
                           <option value="<?php echo $value['id'] ?>" <?php echo (@$workpack_detail[0]['deck_elevation'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code'] . " - " . $value['name'] ?></option>
                         <?php endforeach; ?>
                       </select>
                     </div>
                   </div>
                 </div>
                 <div class="col-md-6">
                   <div class="form-group row">
                     <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Discipline</label>
                     <div class="col-md">
                       <select class="form-control" name="discipline" required>
                         <option value="">---</option>
                         <?php foreach ($discipline_list as $key => $value) : ?>
                           <option value="<?php echo $value['id'] ?>" <?php echo (@$workpack_detail[0]['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
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
                       <select class="form-control" name="phase" required> 
                         <option value="B&P" <?php echo (@$workpack_detail[0]['phase'] == "B&P" ? 'selected' : '') ?>>B&P</option> 
                       </select>
                     </div>
                   </div>
                 </div>
                 <div class="col-md-6">
                   <div class="form-group row">
                     <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Description Assy Code</label>
                     <div class="col-md-8 col-lg-9">
                       <select class="form-control select2" name="desc_assy" required>
                         <option value="">---</option>
                         <?php foreach ($desc_assy_list as $key => $value) : ?>
                           <option value="<?php echo $value['id'] ?>" <?php echo (@$workpack_detail[0]['desc_assy'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code'] . " - " . $value['name'] ?></option>
                         <?php endforeach; ?>
                       </select>
                     </div>
                   </div>
                 </div>
               </div>
               <div class="row">
                 <div class="col-md-6">
                   <div class="form-group row">
                     <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Company</label>
                     <div class="col-md">
                       <select class="form-control select2" name="company_id" required>
                         <option value="">---</option>
                         <?php foreach ($company_list as $key => $value) : ?>
                           <option value="<?php echo $value['id_company'] ?>" <?php echo (@$workpack_detail[0]['company_id'] == $value['id_company'] ? 'selected' : '') ?>><?php echo $value['company_name'] ?></option>
                         <?php endforeach; ?>
                       </select>
                     </div>
                   </div>
                 </div>
                 <div class="col-md-6">
                   <div class="form-group row">
                     <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Description</label>
                     <div class="col-md">
                       <input type="text" class="form-control" name="description" value="<?php echo @$workpack_detail[0]['description'] ?>" required>
                     </div>
                   </div>
                 </div>
               </div>
               <div class="row">
                 
                   <div class="col-md-6">
                     <div class="form-group row">
                     <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Job No.</label>
                       <div class="col-md"> 
                         <select class="form-control select2-multiple" name="job_no[]" multiple required>
                           <?php foreach ($job_register_list as $value) : ?>
                             <option value='<?php echo $value['job_no'] ?>' <?php echo (strpos(" " . @$workpack_detail[0]['job_no'] . " ", $value['job_no']) !== false ? 'selected' : '') ?>><?php echo $value['job_no'] ?></option>
                           <?php endforeach; ?>
                         </select>
                       </div>
                     </div>
                   </div>
                
                 <div class="col-md-6">
                   <div class="form-group row">
                     <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Remarks</label>
                     <div class="col-md">
                       <textarea class="form-control" name="remarks"><?php echo @$workpack_detail[0]['remarks'] ?></textarea>
                     </div>
                   </div>
                 </div>
               </div>
               <?php
                 $job_description = explode(";", @$workpack_detail[0]['job_description']);
                 ?>
                 <div class="row">
                   <div class="col-md-12">
                     <div class="form-group row">
                       <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Job Description</label>
                     </div>
                   </div>
                   <?php foreach ($job_description_list as $key => $value) : ?>
                     <div class="col-md-3">
                       <label>
                         <input type="checkbox" class="checkbox-big" name="job_description[]" value="<?php echo $value ?>" <?php echo (in_array($value, $job_description) ? "checked" : "") ?>>
                         <span class="ml-2 font-weight-bold text-dark"> <?php echo $value ?></span>
                       </label>
                     </div>
                   <?php endforeach; ?>
                 </div>
             </div>

               
             

           </div>
       </div>     
   </div>    

     <div class="row">
         <div class="col-md-6">
           <div id="con_work_date" class="card shadow my-3 rounded-0">
             <div class="card-header">
               <h6 class="m-0">Work Date</h6>
             </div>
             <div class="card-body bg-white overflow-auto">
               <div class="form-group row">
                 <label class="col-md-4 col-xl-4 col-form-label font-weight-bold text-nowrap">Plan Start Date</label>
                 <div class="col-md">
                   <input type="date" class="form-control" max="9999-12-31" name="plan_start_date" value="<?= $workpack_detail[0]["plan_start_date"] ?>" required>
                 </div>
               </div>
               <div class="form-group row">
                 <label class="col-md-4 col-xl-4 col-form-label font-weight-bold text-nowrap">Plan Finish Date</label>
                 <div class="col-md">
                   <input type="date" class="form-control" max="9999-12-31" name="plan_finish_date" value="<?= $workpack_detail[0]["plan_finish_date"] ?>" required>
                 </div>
               </div> 
             </div>
           </div>
         </div> 
         <div class="col-md-6">
           <div id="con_work_date" class="card shadow my-3 rounded-0">
             <div class="card-header">
               <h6 class="m-0">Activity</h6>
             </div>
             <div class="card-body bg-white overflow-auto"> 
               <!-- <div class="form-group row">
                 <label class="col-md-4 col-xl-4 col-form-label font-weight-bold text-nowrap">Description Activity</label>
                 <div class="col-md">
                   <?php $array_activity_of_workpack = explode(";",$workpack_detail[0]["id_activity_bnp"]); ?>    
                   <select name='activity_of_workpack[]' class='form-control select2_multiple_activity' placeholder='Choose' multiple required>
                     <?php foreach($get_master_bnp_activity as $key => $value){ ?>
                       <option value='<?= $value['id_activity'] ?>' <?= (in_array($value['id_activity'],$array_activity_of_workpack,true) ? "selected" : null) ?>><?= $value['description_of_activity'] ?></option>
                     <?php } ?>
                   </select>
                 </div>
               </div>  -->
               <div class="form-group row">
                 <label class="col-md-4 col-xl-4 col-form-label font-weight-bold text-nowrap">IRN No.</label>
                 <div class="col-md"> 
                   <input type="text" class="form-control" name="drawing_no" value="<?php echo "SOF-OCP-SMO-TS-STR-RFI-IRN-B&P-".$workpack_detail[0]['irn_report_no'] ?>" readonly>
                   <!-- <input type="text" class="form-control" name="irn_report_no" value="<?php echo $workpack_detail[0]['irn_report_no'] ?>"> -->
                 </div>
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

               <input type="hidden" name="irn_report_no" value="<?php echo @$workpack_detail[0]["irn_report_no"] ?>">  
               <input type="hidden" name="template_id"> 

               <div class="overflow-auto">                   
                     
                    <table id="tbl_detail" class="table table-hover text-center">
                        <thead class="bg-green-smoe text-white">
                          <tr>
                            <th>No.</th>
                            <th>Drawing WM</th>
                            <th>Rev WM</th>
                            <th>Joint No.</th>
                            <th>Piecemark#1</th>
                            <th>Piecemark#2</th>
                            <th>Weld Type Code</th>
                            <th>Thickness</th>
                            <th>Diameter</th>
                            <th>Schedule</th>
                            <th>Length</th>
                            <th>Weld Length</th>
                            <th>Remarks</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($detail_list as $key => $value) : ?>
                            <tr>
                              <input type="hidden" name="id_detail[]" class="form-control" value="<?php echo $value['id'] ?>">
                              <input type="hidden" name="id_template[]" class="form-control" value="<?php echo $value['id_template'] ?>">
                              <td><?php echo ($key + 1) ?></td>
                              <td><?php echo $template_list[$value['id_template']]['drawing_wm'] ?></td>
                              <td><?php echo $template_list[$value['id_template']]['rev_wm'] ?></td>
                              <td><input type="text" class="form-control autocomplete_detail" value="<?php echo $template_list[$value['id_template']]['joint_no'] ?>" readonly required></td>
                              <td><?php echo $template_list[$value['id_template']]['pos_1'] ?></td>
                              <td><?php echo $template_list[$value['id_template']]['pos_2'] ?></td>
                              <td><?php echo @$weld_type[$template_list[$value['id_template']]['weld_type']]['weld_type_code'] ?></td>
                              <td><?php echo $template_list[$value['id_template']]['thickness'] ?></td>
                              <td><?php echo $template_list[$value['id_template']]['diameter'] ?></td>
                              <td><?php echo $template_list[$value['id_template']]['sch'] ?></td>
                              <td><?php echo $template_list[$value['id_template']]['length'] ?></td>
                              <td><?php echo $template_list[$value['id_template']]['weld_length'] ?></td>
                              <td><?php echo $value['remarks'] ?></td>
                              <td>
                                <?php if ($value['status'] == 1) : ?>
                                  <span class="badge badge-warning">Pending Approval Return by QC</span>
                                <?php elseif ($value['status'] == 3) : ?>
                                  <span class="badge badge-danger">Returned</span>
                                <?php else : ?>
                                  <?php if ($value['progress_fu'] == 0 && $value['progress_vt'] == 0 && (($workpack['status'] == 0 && in_array($workpack['status_approval'], [0, 2])))) : ?>
                                    <button class='btn btn-sm btn-flat btn-danger' type='button' onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-danger&#34;>&nbsp;Delete&nbsp;</b> this?', this, event, 'delete_detail_wp_db')" data-id="<?php echo $value['id'] ?>"><i class='fas fa-times'></i></button>
                                  <?php endif; ?>
                                <?php endif; ?>
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
              <h6 class="m-0">Workpack on Material Details</h6>
            </div>
            <div class="card-body bg-white"> 

                <input type="hidden" name="irn_report_no" value="<?php echo @$workpack_detail[0]["irn_report_no"] ?>"> 

                <input type="hidden" name="template_id"> 

                <div class="overflow-auto">  

                        <table class="table table-hover text-center">
                            <thead>
                            <tr>
                                <th rowspan='2'>Drawing<br/>Number</th>
                                <th rowspan='2'>Tag<br/>Number</th>
                                <th rowspan='2'>Drawing Assembly</th>
                                <th colspan='9' style='text-align:center;'>Material Traceability</th> 
                            </tr>
                            <tr>
                                <th>Piecemark<br/>No.</th>
                                <th>Paint System</th>
                                <th>Unique<br/>No.</th> 
                                <th>Profile</th> 
                                <th>Size / Dia</th> 
                                <th>Length</th> 
                                <th>Area<br/>m2</th> 
                                <th>THK</th> 
                                <th>Material<br/>Status</th> 
                            </tr>
                            </thead>
                            <tbody>
                            <?php $no=0; foreach($show_data_irn_list as $key => $value){ ?>    
                            
                            <?php  

                                    if(isset($value['drawing_as']) && !empty($value['drawing_as'])){
                                        $weldmap_material = substr($value['drawing_as'],-13);
                                    } else {
                                        $weldmap_material = substr($value['drawing_ga'],-20);
                                    }  
                            
                                    if(isset($warehouse_mis_mrir[$status_piecemark[$value['part_id']]['id_mis']]['unique_ident_no'])){
                                        $uniq_no_p1 = $warehouse_mis_mrir[$status_piecemark[$value['part_id']]['id_mis']]['unique_ident_no'];
                                    } else {
                                        $uniq_no_p1 = "-";
                                    } 

                                    if($uniq_no_p1 != "-"){ 
                                        if(isset($list_unique_data[$uniq_no_p1])){
                                            $list_of_attachment = array(); 
                                            foreach($list_unique_data[$uniq_no_p1] as $key => $vx){ 
                                            $list_of_attachment[] = "<a target='_blank' href='https://www.smoebatam.com/warehouse_ori/file/mrir/cm/".$vx["document_file"]."'  style='display: inline-block !important;'>".$vx["document_name"]."</a>";
                                            }
                                            $show_attachment = implode("<br/><br/>",$list_of_attachment);
                                        } else {
                                            $show_attachment = "-";
                                        }
                                    } else {
                                    $show_attachment = "-";
                                    } 

                                    if(isset($status_piecemark[$value['part_id']]['profile'])){
                                        $profile_p1 = $status_piecemark[$value['part_id']]['profile'];
                                    } else {
                                        $profile_p1 = "-";
                                    } 

                                    if(isset($status_piecemark[$value['part_id']]['diameter'])){
                                        $diameter_p1 = $status_piecemark[$value['part_id']]['diameter'];
                                    } else {
                                        $diameter_p1 = "-";
                                    }

                                    if(isset($status_piecemark[$value['part_id']]['length'])){
                                        $length_p1 = $status_piecemark[$value['part_id']]['length'];
                                    } else {
                                        $length_p1 = "-";
                                    } 

                                    if(isset($status_piecemark[$value['part_id']]['area'])){
                                        $area_p1 = $status_piecemark[$value['part_id']]['area'];
                                    } else {
                                        $area_p1 = "-";
                                    }

                                    if(isset($status_piecemark[$value['part_id']]['can_number'])){
                                    $can_number = $status_piecemark[$value['part_id']]['can_number'];
                                    } else {
                                    $can_number = "-";
                                    }

                                    if(isset($status_piecemark[$value['part_id']]['thickness'])){
                                        $thickness_p1 = $status_piecemark[$value['part_id']]['thickness'];
                                    } else {
                                        $thickness_p1 = "-";
                                    } 

                                    $project_id               = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['project_code']),'+=/', '.-~');
                                    $discipline               = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['discipline']),'+=/', '.-~');
                                    $type_of_module           = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['type_of_module']),'+=/', '.-~');
                                    $module                   = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['module']),'+=/', '.-~');
                                    $report_no                = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['report_number']),'+=/', '.-~');
                                    $report_no_rev            = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['report_no_rev']),'+=/', '.-~');
                                    $submission_id            = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['submission_id']),'+=/', '.-~');

                                    if(isset($status_piecemark[$value['part_id']]['status_inspection'])){
                                        if($status_piecemark[$value['part_id']]['status_inspection'] >= 3){
                                            if(isset($status_piecemark[$value['part_id']]['report_number'])){
                                            $status_inspection_p1 = '<a target="_blank" href="'.base_url().'material_verification/material_verification_pdf_client/'.$project_id.'/'.$discipline.'/'.$type_of_module.'/'.$module.'/'.$report_no.'/'.$report_no_rev.'">COMPLETED</a>';
                                            } else {
                                            $status_inspection_p1 = '<a target="_blank" href="'.base_url().'material_verification/material_verification_pdf/'.$submission_id.'">COMPLETED</a>';
                                            }                                               
                                        } else {
                                        $status_inspection_p1 ='OS';	
                                        }
                                        
                                    } else {
                                        $status_inspection_p1 = "-";
                                    }
                    
                                    $status_fitup = "-"; 
                                    $status_visual ="-";
                                    $status_MT_show = "-";
                                    $status_PT_show = "-";
                                    $status_UT_show = "-";
                                    $status_RT_show = "-";
                            ?>
                                <tr>
                                    <td><?= $value['drawing_ga'] ?></td>
                                    <td><?= $can_number ?></td>
                                    <td><?= $value['drawing_as'] ?></td>
                                    <td><?= $value['part_id'] ?></td>
                                    <td> 
                                      <input type='hidden' name='categories_wp[<?= $no ?>]' value='0'>
                                      <input type='hidden' name='wp_id[<?= $no ?>]' value='<?= $detail_list[0]["id_workpack"] ?>'>
                                      <input type='hidden' name='wp_detail_id[<?= $no ?>]' value='<?= $detail_list[0]["id"] ?>'>
                                      <input type='hidden' name='id_template[<?= $no ?>]' value='<?= $value["id"] ?>'>
                                      <select  name='paint_system[<?= $value["id"] ?>][]' class='form-control select2_multiple_paint_system' multiple required>
                                        <?php foreach($get_paint_system as $keyx => $valx){ ?>
                                          <option value='<?= $valx['id'] ?>' <?= ( isset($paint_system_capture_joint[$detail_list[0]["id_workpack"]][$valx['id']][$value['id']]["id_workpack"]) ? "selected" : null) ?>><?= $valx['code'] ?></option>
                                        <?php } ?>
                                      </select>
                                    </td>
                                    <td><?= $uniq_no_p1 ?> </td>
                                    <td><?= $profile_p1 ?> </td>
                                    <td><?= $diameter_p1 ?> </td>
                                    <td><?= $length_p1 ?> </td>
                                    <td><?= $value['area'] ?> </td>
                                    <td><?= $thickness_p1 ?> </td>
                                    <td><?= $status_inspection_p1 ?> </td>  
                                    
                                </tr>          
                            <?php $no++; } ?>                     
                            </tbody>
                        </table>   
                </div>  
              
            </div>
          </div>
        </div>
      </div> 

      <?php foreach($unique_paint_system as $klp => $vlp){ ?>

<?php $total_column_activity = sizeof($show_data_activity_paint_system[$vlp]); ?> 

<div class="row">
<div class="col">
 <div class="card shadow my-3 rounded-0">
   <div class="card-header">
     <h6 class="m-0">Report Status For Paint System - <?= $show_paint_system_name[$vlp]["name"] ?></h6>
   </div>
   <div class="card-body bg-white"> 

       <input type="hidden" name="irn_report_no" value="<?php echo @$workpack_detail[0]["irn_report_no"] ?>"> 

       <input type="hidden" name="template_id"> 

       <div class="overflow-auto">  

       <?php //test_var($show_data_activity_paint_system[$vlp]); ?>

               <table class="table table-hover text-center dataTable">
                   <thead>
                   <tr>
                       <th rowspan='2'>Drawing<br/>Number</th>
                       <th rowspan='2'>Tag<br/>Number</th>
                       <th rowspan='2'>Drawing Assembly</th>
                       <th colspan='2' style='text-align:center;'>Material Traceability</th> 
                       <th colspan='<?= $total_column_activity ?>'>Paint System - Activity Code</th> 
                   </tr>
                   <tr>
                       <th>Piecemark<br/>No.</th> 
                       <th>Unique<br/>No.</th> 
                       <?php foreach($show_data_activity_paint_system[$vlp] as $vals){ ?>
                        <th><span title='<?= $show_paint_system_name[$vlp]["name"]."-".$vals["description_of_activity"] ?>'><?= $show_paint_system_name[$vlp]["name"]."-".$vals["code_activity"] ?></span></th>
                       <?php } ?>
                   </tr>
                   </thead>
                   <tbody>
                   <?php $no=0; foreach($show_data_irn_list as $key => $value){ ?>    

                    <?php if(isset($validation_id_template[$id_workpack][$vlp][$value["id"]])){ ?>
                   
                   <?php  

                           if(isset($value['drawing_as']) && !empty($value['drawing_as'])){
                               $weldmap_material = substr($value['drawing_as'],-13);
                           } else {
                               $weldmap_material = substr($value['drawing_ga'],-20);
                           }  
                   
                           if(isset($warehouse_mis_mrir[$status_piecemark[$value['part_id']]['id_mis']]['unique_ident_no'])){
                               $uniq_no_p1 = $warehouse_mis_mrir[$status_piecemark[$value['part_id']]['id_mis']]['unique_ident_no'];
                           } else {
                               $uniq_no_p1 = "-";
                           } 

                           if($uniq_no_p1 != "-"){ 
                               if(isset($list_unique_data[$uniq_no_p1])){
                                   $list_of_attachment = array(); 
                                   foreach($list_unique_data[$uniq_no_p1] as $key => $vx){ 
                                   $list_of_attachment[] = "<a target='_blank' href='https://www.smoebatam.com/warehouse_ori/file/mrir/cm/".$vx["document_file"]."'  style='display: inline-block !important;'>".$vx["document_name"]."</a>";
                                   }
                                   $show_attachment = implode("<br/><br/>",$list_of_attachment);
                               } else {
                                   $show_attachment = "-";
                               }
                           } else {
                           $show_attachment = "-";
                           } 

                           if(isset($status_piecemark[$value['part_id']]['profile'])){
                               $profile_p1 = $status_piecemark[$value['part_id']]['profile'];
                           } else {
                               $profile_p1 = "-";
                           } 

                           if(isset($status_piecemark[$value['part_id']]['diameter'])){
                               $diameter_p1 = $status_piecemark[$value['part_id']]['diameter'];
                           } else {
                               $diameter_p1 = "-";
                           }

                           if(isset($status_piecemark[$value['part_id']]['length'])){
                               $length_p1 = $status_piecemark[$value['part_id']]['length'];
                           } else {
                               $length_p1 = "-";
                           } 

                           if(isset($status_piecemark[$value['part_id']]['area'])){
                               $area_p1 = $status_piecemark[$value['part_id']]['area'];
                           } else {
                               $area_p1 = "-";
                           }

                           if(isset($status_piecemark[$value['part_id']]['can_number'])){
                           $can_number = $status_piecemark[$value['part_id']]['can_number'];
                           } else {
                           $can_number = "-";
                           }

                           if(isset($status_piecemark[$value['part_id']]['thickness'])){
                               $thickness_p1 = $status_piecemark[$value['part_id']]['thickness'];
                           } else {
                               $thickness_p1 = "-";
                           } 

                           $project_id               = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['project_code']),'+=/', '.-~');
                           $discipline               = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['discipline']),'+=/', '.-~');
                           $type_of_module           = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['type_of_module']),'+=/', '.-~');
                           $module                   = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['module']),'+=/', '.-~');
                           $report_no                = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['report_number']),'+=/', '.-~');
                           $report_no_rev            = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['report_no_rev']),'+=/', '.-~');
                           $submission_id            = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['submission_id']),'+=/', '.-~');

                           if(isset($status_piecemark[$value['part_id']]['status_inspection'])){
                               if($status_piecemark[$value['part_id']]['status_inspection'] >= 3){
                                   if(isset($status_piecemark[$value['part_id']]['report_number'])){
                                   $status_inspection_p1 = '<a target="_blank" href="'.base_url().'material_verification/material_verification_pdf_client/'.$project_id.'/'.$discipline.'/'.$type_of_module.'/'.$module.'/'.$report_no.'/'.$report_no_rev.'">COMPLETED</a>';
                                   } else {
                                   $status_inspection_p1 = '<a target="_blank" href="'.base_url().'material_verification/material_verification_pdf/'.$submission_id.'">COMPLETED</a>';
                                   }                                               
                               } else {
                               $status_inspection_p1 ='OS';	
                               }
                               
                           } else {
                               $status_inspection_p1 = "-";
                           }
           
                           $status_fitup = "-"; 
                           $status_visual ="-";
                           $status_MT_show = "-";
                           $status_PT_show = "-";
                           $status_UT_show = "-";
                           $status_RT_show = "-";
                   ?>
                       <tr>
                           <td><?= $value['drawing_ga'] ?></td>
                           <td><?= $can_number ?></td>
                           <td><?= $value['drawing_as'] ?></td>
                           <td><?= $value['part_id'] ?></td> 
                           <td><?= $uniq_no_p1 ?> </td> 
                           <?php foreach($show_data_activity_paint_system[$vlp] as $valx){ ?>
                            <td><?= (isset($completion_status[$id_workpack][$vlp][$valx["id_activity"]][$value['id']]) && $completion_status[$id_workpack][$vlp][$valx["id_activity"]][$value['id']] == 1 ? "<span class='btn btn-success' title='Attachment Completed'><i class='fas fa-check-circle'></i></span>" : "<span class='btn btn-danger'  title='On Progress!'><i class='fas fa-times-circle'></i></span>" ) ?></td>
                           <?php } ?>
                       </tr>          
                   <?php $no++; } } ?>                     
                   </tbody>
               </table>   
       </div>  
     
   </div>
 </div>
</div>
</div>

<?php } ?>

               <div class="col-md">
               <div class="text-right"> 
               <a target="_blank" href="<?php echo base_url() ?>planning/workpack_pdf_bnp/<?php echo strtr($this->encryption->encrypt($workpack_detail[0]['id']), '+=/', '.-~') ?>" class="btn btn-sm btn-flat btn-danger"><i class="fas fa-file-pdf"></i> Workpack PDF</a>
                   <?php if($workpack_detail[0]["status_approval"] == 0){ ?>
                   <a href="<?php echo base_url() ?>planning/workpack_approval_process_bnp/<?php echo strtr($this->encryption->encrypt($id_workpack), '+=/', '.-~') ?>" class="btn btn-sm btn-flat btn-success" onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-success&#34;>&nbsp;Issued&nbsp;</b> this?', this, event)"><i class="fas fa-check"></i> Issued</a>
                   <button type="submit" class="btn btn-sm btn-flat btn-warning" name="status" value="0"><i class="fas fa-edit"></i> Update</button>
                   <?php } ?>
               </div>
               </div>

               </form>
     

</div>
</div>
<script>
 $("select[name=module]").chained("select[name=project]");
 
 $(document).ready(function(){ 
   selectRefresh();    
 });

 function selectRefresh() {     
   $(".select2_multiple_activity").select2({ 
       allowClear: true,
       tokenSeparators: [', ', ' '],
   }) 
   $(".select2_multiple_paint_system").select2({ 
       allowClear: true,
       tokenSeparators: [', ', ' '],
   }) 
 }
 

 $('.dataTable').DataTable({
   order: [],
   columnDefs: [{
     "targets": 0,
     "orderable": false,
   }]
 })

 var data_checkbox = [];
 function save_checkbox(input) {
   console.log(data_checkbox);
   if($(input).prop("checked") == true && $.inArray($(input).val(), data_checkbox) == -1){
     data_checkbox.push($(input).val());
   }
   else if($(input).prop("checked") == false && $.inArray($(input).val(), data_checkbox) != -1){
     data_checkbox.splice( $.inArray($(input).val(), data_checkbox), 1 );
   }
   $(".num_ticker").html(data_checkbox.length)
 }

 function checkall(input) {
   $('#form_create_workpack input[type=checkbox]').each(function(i, obj) {
     if($(input).prop("checked") == true && $(obj).prop("checked") == false){
       $(obj).trigger("click");
       console.log("all"+$(obj).val());
     }
     else if($(input).prop("checked") == false && $(obj).prop("checked") == true){
       $(obj).trigger("click");
     }
   });
 }

 function create_workpack() {
   if(data_checkbox.length > 0){
     sweetalert("loading", "Please wait...!");
     $("#form_create_workpack input[name=template_id]").val(data_checkbox.join(", "));
     document.getElementById("form_create_workpack").submit();
   }
   else{
     sweetalert("error", "No item selected!");
   }
 }

 $(".autocomplete_irn_approved").autocomplete({
   source: function( request, response ) {
     var project_id = $("#project_id option:selected").val();
     var drawing_type = 3;
     $.ajax( {
       url: "<?php echo base_url() ?>planning/autocomplete_irn_approved",
       dataType: "json",
       data: {
         term: request.term,
         drawing_type: drawing_type,
         project_id: project_id,
       },
       success: function( data ) {
         response( data );
       }
     });
   },
   // select: function (event, ui) {
   //   var value = ui.item.value;
   //   if(value == 'No Data.'){
   //     ui.item.value = "";
   //   }
   //   else{
   //     get_data_drawing(ui.item.value);
   //   }
   // }
 });

 function add_manhours() {
   var html = "<tr>" +
     "<td>" +
     "<select class='form-control' name='manhours_name[]' required>" +
     "<option value=''>---</option>" +
     <?php foreach ($workpack_section as $key => $value) : ?> "<option value='<?php echo $value['id'] ?>'><?php echo $value['name'] ?></option>" +
     <?php endforeach; ?> "</select>" +
     "</td>" +
     "<td><input type='number' class='form-control text-center' value='0' name='manhours_manpower[]' oninput='calc_manhours(this)' required></td>" +
     "<td><input type='number' class='form-control text-center' value='0' name='manhours_day[]' oninput='calc_manhours(this)' required></td>" +
     "<td><input type='number' class='form-control text-center' value='0' name='manhours_manhours[]' oninput='calc_manhours(this)' required></td>" +
     "<td><span name='total'>0</span></td>" +
     "<td><button class='btn btn-sm btn-flat btn-danger' type='button' onclick='delete_manhours(this)'><i class='fas fa-times'></i></td>" +
     "</tr>";
   $("#tbl_manhours").append(html);
 }

 function delete_manhours_db(btn, id) {
   Swal.fire({
     title: 'Are you sure to <b class="text-danger">&nbsp;Delete&nbsp;</b> this?',
     text: "You won't be able to revert this!",
     type: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#3085d6',
     cancelButtonColor: '#d33',
     confirmButtonText: 'Yes, Delete it!'
   }).then((result) => {
     if (result.value) {
       $.ajax({
         url: "<?php echo base_url() ?>planning/budget_manhours_delete_process",
         data: {
           id: id,
         },
         type: 'post',
         success: function(data) {
           sweetalert("success", "Delete Data Success!");
           $(btn).closest("tr").remove();
           calc_manhours_total();
         }
       });
     }
   })
 }

 function delete_manhours(btn) {
   $(btn).closest("tr").remove();
   calc_manhours_total();
 }

 function calc_manhours(input) {
   var manpower = $(input).closest("tr").find("input[type=number]:eq(0)").val();
   var days = $(input).closest("tr").find("input[type=number]:eq(1)").val();
   var manhours = $(input).closest("tr").find("input[type=number]:eq(2)").val();
   $(input).closest("tr").find("span[name=total]").text(manpower * days * manhours);
   calc_manhours_total();
 }

 function calc_manhours_total() {
   var total_all = 0;
   $("span[name=total]").each(function(index) {
     total_all = total_all + parseInt($(this).text());
   })
   $("input[name=budget_manhours]").val(total_all);
 }

 $("select[name=module]").chained("select[name=project]");
  
</script>