 <div id="content" class="container-fluid">
   <div class="row">
     <div class="col-md-12">

       <!-- START FILTER -->
       <?php if ($this->permission_cookie[131]) { ?>
         <div class="my-3 p-3 bg-white rounded shadow-sm">
           <h6 class="pb-2 mb-0">Filter Drawing</h6>
           <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
             <div class="container-fluid">
               <form id="form_filter" method="POST" action="">
                 <div class="row">
                   <div class="col-md">
                     <div class="form-group row">
                       <label class="col-xl-2 col-form-label">Project :</label>
                       <div class="col-xl">
                         <select class="form-control" name="project" required>
                           <?php foreach ($project_list as $key => $value) : ?>
                             <?php if (in_array($value['id'], $this->user_cookie[13])) : ?>
                               <option value="<?php echo $value['id'] ?>" <?php echo (@$post['project'] == $value['id'] ? 'selected' : ($this->user_cookie[10] == $value['id'] ? 'selected' : '')) ?>><?php echo $value['project_name'] ?></option>
                             <?php endif; ?>
                           <?php endforeach; ?>
                         </select>
                       </div>
                     </div>
                   </div>
                   <div class="col-md">
                     <div class="form-group row">
                       <label class="col-xl-2 col-form-label">Discipline :</label>
                       <div class="col-xl">
                         <select class="custom-select" name="discipline">
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
                   <div class="col-md">
                     <div class="form-group row">
                       <label class="col-xl-2 col-form-label">Module :</label>
                       <div class="col-xl">
                         <select class="form-control" name="module">
                           <option value="">---</option>
                           <?php foreach ($module_list as $key => $value) : ?>
                             <option value="<?php echo $value['mod_id'] ?>" data-chained="<?php echo $value['project_id'] ?>" <?php echo (@$post['module'] == $value['mod_id'] ? 'selected' : '') ?>><?php echo $value['mod_desc'] ?></option>
                           <?php endforeach; ?>
                         </select>
                       </div>
                     </div>
                   </div>
                   <div class="col-md">
                     <div class="form-group row">


                       <label class="col-xl-2 col-form-label">Type Of Module :</label>
                       <div class="col-xl">
                         <select class="form-control" name="type_of_module">
                           <option value="">---</option>
                           <?php foreach ($type_of_module_list as $key => $value) : ?>
                             <option value="<?php echo $value['id'] ?>" <?php echo (@$post['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['name'] ?></option>
                           <?php endforeach; ?>
                         </select>
                       </div>

                     </div>
                   </div>
                 </div>
                 <div class="row">
                   <div class="col-md">
                     <div class="form-group row">

                       <label class="col-xl-2 col-form-label">Deck Elevation / Service Line :</label>
                       <div class="col-xl">
                         <select name="deck_elevation" class="select2" style="width:100%">
                           <option value="">---</option>
                           <?php foreach ($deck_list as $key => $value) : ?>
                             <option value="<?= $value['id'] ?>" <?= $value['id'] == @$post['deck_elevation'] ? 'selected' : '' ?>>
                               <?= $value['name'] ?></option>
                           <?php endforeach; ?>
                         </select>
                       </div>
                     </div>
                   </div>
                   <div class="col-md">
                     <div class="form-group row">

                     </div>
                   </div>
                 </div>
                 <div class="row">
                   <div class="col-md">
                     <div class="form-group row m-0">
                       <div class="col-xl text-right">
                         <button type="submit" name='submit' value='filter' class="btn btn-primary" title="Update"><i class="fa fa-search"></i> Filter</button>
                         <?php if ($this->user_cookie[7] != 8 && $this->permission_cookie[131]) { ?>
                           <button type="submit" name='submit' value='export_excel' class="btn btn-success" title="Update"><i class="fas fa-download"></i> Download</button>
                         <?php } ?>
                       </div>
                     </div>
                   </div>
                 </div>
               </form>
             </div>
           </div>
         </div>
       <?php } ?>
       <!-- END FILTER -->
       <?php if ($this->permission_cookie[131]) { ?>
         <div class="my-3 p-3 bg-white rounded shadow-sm">
           <h6 class="pb-2 mb-0"><?php echo $meta_title ?></h6>
           <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
             <div class="container-fluid">
               <table class="table table-hover datatables bg-gray-table">
                 <thead>
                   <tr style="text-align: center;">
                     <th>RFI Number</th>
                     <th>Report Number</th>
                     <th>Drawing Number</th>
                     <th>Discipline</th>
                     <th>Module</th>
                     <th>Type Of Module</th>
                     <th>Deck Elevation / Service Line</th>
                     <th>Submit By</th>
                     <th>Submit Date</th>
                     <th>Attachement File</th>
                     <?php if ($this->user_cookie[7] != 8) { ?>
                       <th>Action</th>
                     <?php } ?>
                   </tr>
                 </thead>
                 <tbody>
                   <?php foreach ($data_additional_report as $dc_list) { ?>
                     <tr>
                       <td><?= $dc_list['rfi_number'] ?></td>
                       <td><?= $dc_list['report_number'] ?></td>
                       <td><?= $dc_list['drawing_no'] ?></td>
                       <td><?php echo (isset($discipline_name[$dc_list['discipline']]) ? $discipline_name[$dc_list['discipline']] : '-') ?></td>
                       <td><?php echo (isset($module_code[$dc_list['module']]) ? $module_code[$dc_list['module']] : '-') ?></td>
                       <td><?php echo (isset($type_of_module_name[$dc_list['type_of_module']]) ? $type_of_module_name[$dc_list['type_of_module']] : '-') ?></td>
                       <td><?php echo (isset($deck_elevation_show[$dc_list['deck_elevation']]) ? $deck_elevation_show[$dc_list['deck_elevation']] : '-') ?></td>
                       <td><?php echo (isset($user_list[$dc_list['create_by']]) ? $user_list[$dc_list['create_by']] : '-') ?></td>
                       <td><?= date('Y-m-d', strtotime($dc_list['created_date'])) ?></td>
                       <td>
                         <center>
                           <a target="_blank" href="<?= base_url() ?>additional/open_atc/<?= $dc_list['attachment_file'] ?>"> <img width="20" height="20" src="<?= base_url() ?>img/pdf.svg"></a>
                         </center>
                       </td>
                       <?php if ($this->user_cookie[7] != 8) { ?>
                         <td>
                           <a target="_blank" href="<?= base_url() ?>additional/rfi_other_pdf/<?= strtr($this->encryption->encrypt($dc_list['type_of_report']), '+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt($dc_list['submission_id']), '+=/', '.-~') ?>" title='RFI PDF' class='btn btn-sm btn-dark'><i class="fa fa-file-pdf"></i></a>
                           <a target="_blank" href="<?= base_url() ?>additional/rfi_other_detail/<?= strtr($this->encryption->encrypt($dc_list['type_of_report']), '+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt($dc_list['submission_id']), '+=/', '.-~') ?>" title='Detail RFI' class='btn btn-sm btn-primary'><i class="fa fa-bars"></i></a>
                           <!-- <center>   
                      <a target="_blank" href="<?= base_url() ?>additional/detail_additional/<?= strtr($this->encryption->encrypt($dc_list['type_of_report']), '+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt($dc_list['submission_id']), '+=/', '.-~') ?>" class='btn btn-secondary'><i class="fas fa-list"></i></a>               
                    </center> -->
                           <?php if ($this->permission_cookie[132] == 1) { ?>
                             <a target="_blank" href="<?= base_url() ?>dimension/delete_submission_additional_report/<?= strtr($this->encryption->encrypt($dc_list['submission_id']), '+=/', '.-~') ?>" title='Delete' class='btn btn-sm btn-danger' onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-danger&#34;>&nbsp;Delete&nbsp;</b> this?', this, event)"><i class="fa fa-trash"></i></a>
                           <?php } ?>
                         </td>
                       <?php } ?>
                     </tr>
                   <?php } ?>
                 </tbody>
               </table>

             </div>
           </div>
         </div>
       <?php } ?>
     </div>
   </div>
 </div>
 </div><!-- ini div dari sidebar yang class wrapper -->

 <script type="text/javascript">
   $('.datepicker').datepicker({
     format: 'dd/mm/yyyy',
     orientation: "bottom auto",
     autoclose: true,
     todayHighlight: true
   });

   $(document).ready(function() {
     $('.datatables').DataTable({
       "order": []
     });
   });
 </script>


 <script>
   $("select[name=module]").chained("select[name=project]");
 </script>