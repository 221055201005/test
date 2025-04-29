 <style>
   th,
   td {
     vertical-align: middle !important;
   }
 </style>
 <style>
   a[aria-expanded=true] .fa-angle-double-down {
     display: none;
   }

   a[aria-expanded=false] .fa-angle-double-up {
     display: none;
   }
 </style>
 <div id="content">
   <div class="container-fluid">
     <div class="row">
       <div class="col-md-12">
         <div class="card shadow my-3 rounded-0">

           <div class="card-header">
             <a class="btn btn-primary" data-toggle="collapse" href="#collapseButton" role="button" aria-expanded="false" aria-controls="collapseButton">Filter &nbsp; <i class="fas fa-angle-double-down"></i><i class="fas fa-angle-double-up"></i></a>
           </div>
           <div class="collapse <?= $this->input->post() ? 'show' : '' ?>" id="collapseButton">
             <div class="card-body">
               <form action="<?= site_url('fitup/client_rfi/') . $type ?>" method="post">
                 <div class="row">
                   <div class="col-md-6">
                     <div class="form-group row">
                       <label for="" class="col-xl-3 col-form-label "> Project ID</label>
                       <div class="col-xl">
                         <select name="project_id" class="custom-select" onchange="find_module_by_project(this)">
                           <option value="">---</option>
                           <?php foreach ($project_list as $key => $value) : ?>
                             <?php if ($this->is_admin == 1) { ?>
                               <option value="<?php echo $value['id'] ?>" <?php echo (@$post['project_id'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                             <?php } else { ?>
                               <?php if (in_array($value['id'], $this->user_cookie[13])) { ?>
                                 <option value="<?php echo $value['id'] ?>" <?= @$post['project_id'] == $value['id'] ? 'selected' : '' ?>><?php echo $value['project_name'] ?></option>
                               <?php } ?>
                             <?php } ?>
                           <?php endforeach; ?>

                         </select>
                       </div>
                     </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-group row">
                       <label for="" class="col-xl-3 col-form-label "> Discipline</label>
                       <div class="col-xl">
                         <select name="discipline" class="custom-select">
                           <option value="">---</option>
                           <?php foreach ($discipline_list as $key => $value) : ?>
                             <option value="<?= $value['id'] ?>" <?= $value['id'] == $discipline ? 'selected' : '' ?>>
                               <?= $value['discipline_name'] ?></option>
                           <?php endforeach; ?>
                         </select>
                       </div>
                     </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-group row">
                       <label for="" class="col-xl-3 col-form-label "> Module</label>
                       <div class="col-xl">
                         <select name="module" class="custom-select module" <?= $project_id ? '' : 'disabled' ?>>
                           <option value="">---</option>
                           <?php if ($project_id) : ?>
                             <?php foreach ($module_list as $key => $value) : ?>
                               <option value="<?= $value['mod_id'] ?>" <?= $value['mod_id'] == $module ? 'selected' : '' ?>>
                                 <?= $value['mod_desc'] ?></option>
                             <?php endforeach; ?>
                           <?php endif; ?>
                         </select>
                       </div>
                     </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-group row">
                       <label for="" class="col-xl-3 col-form-label ">Module Type</label>
                       <div class="col-xl">
                         <select name="type_of_module" class="custom-select">
                           <option value="">---</option>
                           <?php foreach ($type_of_module_list as $key => $value) : ?>
                             <option value="<?= $value['id'] ?>" <?= $value['id'] == $type_of_module ? 'selected' : '' ?>>
                               <?= $value['name'] ?></option>
                           <?php endforeach; ?>
                         </select>
                       </div>
                     </div>
                   </div>

                   <div class="col-md-6">
                     <div class="form-group row">
                       <label for="" class="col-xl-3 col-form-label ">Deck Elevation / Service Line</label>
                       <div class="col-xl">
                         <select name="deck_elevation" class="select2" style="width:100%">
                           <option value="">---</option>
                           <?php foreach ($deck_list as $key => $value) : ?>
                             <option value="<?= $value['id'] ?>" <?= $value['id'] == $deck_elevation ? 'selected' : '' ?>>
                               <?= $value['name'] ?></option>
                           <?php endforeach; ?>
                         </select>
                       </div>
                     </div>
                   </div>

                   <?php if ($type == "summary") { ?>
                     <div class="col-md-6">
                       <div class="form-group row">
                         <label for="" class="col-xl-3 col-form-label "> Status Inspection</label>
                         <div class="col-xl">
                           <select name="status_inspection" class="custom-select">
                             <?php if ($type == "summary") { ?>
                               <option value="">---</option>
                             <?php } ?>
                             <?php if (in_array($this->user_cookie[10], array(19, 21))) { ?>
                               <option value="5" <?= $this->input->post('status_inspection') == 5 ? 'selected' : '' ?>>Waiting Witness/Review</option>
                             <?php } else { ?>
                               <option value="5" <?= $this->input->post('status_inspection') == 5 ? 'selected' : '' ?>>Pending
                                 Approval</option>
                             <?php }  ?>

                             <?php if ($type == "summary") { ?>
                               <option value="6" <?= $this->input->post('status_inspection') == 6 ? 'selected' : '' ?>>Rejected</option>

                               <option value="7" <?= $this->input->post('status_inspection') == 7 ? 'selected' : '' ?>>Approved</option>
                               <?php if (in_array($this->user_cookie[10], array(19, 21))) { ?>
                                 <option value="witnessed" <?= $this->input->post('status_inspection') == 'witnessed' ? 'selected' : '' ?>>Witnessed</option>
                                 <option value="reviewed" <?= $this->input->post('status_inspection') == 'reviewed' ? 'selected' : '' ?>>Reviewed</option>
                               <?php } ?>

                               <option value="9" <?= $this->input->post('status_inspection') == 9 ? 'selected' : '' ?>>Accepted
                                 & Release With Comment</option>
                               <option value="10" <?= $this->input->post('status_inspection') == 10 ? 'selected' : '' ?>>
                                 Postponed</option>
                               <option value="11" <?= $this->input->post('status_inspection') == 11 ? 'selected' : '' ?>>
                                 Re-Offered</option>
                               <option value="12" <?= $this->input->post('status_inspection') == 12 ? 'selected' : '' ?>>Void
                               </option>
                             <?php } ?>
                           </select>
                         </div>
                       </div>
                     </div>
                   <?php } ?>

                   <div class="col-md-6">
                     <div class="form-group row">
                       <label for="" class="col-xl-3 col-form-label">Inspection Authority</label>
                       <div class="col-xl">
                         <select name="inspection_authority[]" class="select2" style="width:100%" multiple>
                           <option value="0" <?= $arr_inspection_auth[0] == 1 ? 'selected' : '' ?>>Hold Point</option>
                           <option value="1" <?= $arr_inspection_auth[1] == 1 ? 'selected' : '' ?>>Witness</option>
                           <option value="2" <?= $arr_inspection_auth[2] == 1 ? 'selected' : '' ?>>Monitoring</option>
                           <option value="3" <?= $arr_inspection_auth[3] == 1 ? 'selected' : '' ?>>Review</option>
                         </select>
                       </div>
                     </div>
                   </div>

                   <div class="col-6">
                     <div class="form-group row">
                       <label for="" class="col-xl-3 col-form-label">Company</label>
                       <div class="col-xl">
                         <select class="form-control select2" name="company_id">
                           <option value=''>~ Choose ~</option>
                           <?php foreach ($company_list as $key => $value) { ?>
                             <?php if (in_array($value['id_company'], $this->user_cookie[14])) { ?>
                               <option value='<?= $value['id_company'] ?>' <?= ($value['id_company'] == @$post['company_id'] ? "selected" : "") ?>><?= $value['company_name'] ?></option>
                             <?php } ?>
                           <?php } ?>
                         </select>
                       </div>
                     </div>
                   </div>

                   <div class="col-6">
                     <div class="form-group row">
                       <label class="col-xl-3 col-form-label">Inspection Client Date From</label>
                       <div class="col-md">
                         <input type="date" class="form-control" name="date_from" value="<?= $post['date_from']?>">
                       </div>
                     </div>
                   </div>
                   <div class="col-6">
                     <div class="form-group row">
                       <label class="col-xl-3 col-form-label">Inspection Client Date To</label>
                       <div class="col-md">
                         <input type="date" class="form-control" name="date_to" value="<?= $post['date_to'] ?>">
                       </div>
                     </div>
                   </div>


                   <div class="col-md-12">
                     <div class="float-right">
                       <button class="mt-2 btn btn-sm btn-flat btn-info"><i class="fas fa-search"></i> Search</button>
                     </div>
                   </div>
                 </div>
               </form>
             </div>
           </div>
         </div>
       </div>
     </div>
     <div class="row mt-3">
       <div class="col-md-12">
         <div class="card shadow my-3 rounded-0">
           <div class="card-header">
             <h6 class="m-0">Client Document List</h6>
           </div>
           <div class="card-body">
             <div class="row">
               <div class="col-md-12">
                 <div class="table-responsive overflow-auto">
                   <table id="table_material" class="table table-hover text-center" style="width:100%">
                     <thead class="bg-gray-table">
                       <th>Project</th>
                       <th>Report Number</th>
                       <th>Drawing Number</th>
                       <th>Discipline</th>
                       <th>Module</th>
                       <th>Module Type</th>
                       <th>Deck Elevation / Service Line</th>
                       <th>Rev No.</th>
                       <th>Inspection By</th>
                       <th>Inspection Date</th>
                       <th>Status Inspection</th>
                       <th>Status Invitation</th>
                       <th style="min-width: 210px;">Action</th>
                     </thead>
                   </table>
                 </div>
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>

   <div class="modal fade" id="modalReoffer" role="dialog">
     <div class="modal-dialog">

       <!-- Modal content-->
       <div class="modal-content">
         <form action="<?php echo base_url(); ?>fitup/process_postpone_reapproval" method="POST">
           <div class="modal-header">
             <h4 class="modal-title">Re-Offer RFI</h4>
           </div>
           <div class="modal-body">


             <b><i>Re-Offer Remarks :</i></b> <br />
             <input type="hidden" name="status_inspection" value="11">
             <input type="hidden" name="drawing_no">
             <input type="hidden" name="discipline">
             <input type="hidden" name="module">
             <input type="hidden" name="type_of_module">
             <input type="hidden" name="report_number">
             <textarea name='reoffer_remarks' placeholder="---" class='form-control' required></textarea>


           </div>
           <div class="modal-footer">
             <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
             <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i>Close</button>
           </div>
         </form>
       </div>

     </div>
   </div>
 </div>
 </div>
 <script>
   function requestForUpdate(ini, enc_project_code, enc_discipline, enc_module, enc_type_of_module, enc_report_number, enc_company_id, status_inspection) {
     Swal.fire({
       title: "Reason Request for Update",
       input: "text",
       type: "warning",
       inputAttributes: {
         autocapitalize: "off"
       },
       showCancelButton: true,
       confirmButtonText: "Request",
       showLoaderOnConfirm: true,
     }).then((result) => {

       var remarks = result.value
       $.ajax({
         url: "<?php echo base_url() ?>fitup/proceed_request_for_update_report",
         type: "POST",
         data: {
           enc_project_code: enc_project_code,
           enc_discipline: enc_discipline,
           enc_module: enc_module,
           enc_type_of_module: enc_type_of_module,
           enc_report_number: enc_report_number,
           enc_company_id: enc_company_id,
           remarks: remarks,
           status_inspection: status_inspection,
         },
         success: function(data) {
           console.log(data);
           Swal.fire({
             type: "success",
             title: "SUCCESS",
             text: "Successfully Request Update",
             timer: 1000
           })

           setTimeout(() => {
             location.reload()
           }, 1000);
         }
       });
     });
   }

   $(document).ready(function() {
     $("#table_material").DataTable({
       processing: true,
       serverSide: true,
       order: [1, "asc"],
       ajax: {
         url: "<?= site_url($serverside) ?>",
         type: "POST",
         data: {
           project_id: "<?= $this->input->post('project_id') ?>",
           discipline: "<?= $discipline ?>",
           module: "<?= $module ?>",
           type_of_module: "<?= $type_of_module ?>",
           legend_inspection_auth: '<?= implode(";", $arr_inspection_auth) ?>',
           type: "<?= $type ?>",
           company_id: "<?= $this->input->post('company_id') ?>",
           //company_id              : "<?= ($this->user_cookie[11] == 13 ? 13 : $company_id) ?>",
           status_inspection: "<?= $this->input->post('status_inspection') ?>",
           deck_elevation: "<?= $this->input->post('deck_elevation') ?>",
           date_from: "<?= $this->input->post('date_from') ?>",
           date_to: "<?= $this->input->post('date_to') ?>",
         }
       }
     })
   })

   function find_module_by_project(select, mod_id = null) {
     var project_id = $(select).val()
     if (project_id) {
       $('.module').removeAttr('disabled')
       $.ajax({
         url: "<?= site_url('fitup/find_module_by_project') ?>",
         type: "POST",
         data: {
           project_id: project_id
         },
         dataType: "JSON",
         success: function(data) {
           var html = []
           html.push(`<option value="">---</option>`)
           data.map(function(v, i) {
             html.push(
               `<option value="${v.mod_id}" ${mod_id && mod_id == v.mod_id ? 'selected' : ''}>${v.mod_desc}</option>`
             )
           })
           $('.module').html(html)
         }
       })
     } else {
       $('.module').val('')
       $('.module').attr('disabled', true)
     }
   }
 </script>
<script>
  function handleReoffer(drawing_no, discipline, module, type_of_module, report_number) {
    $("input[name='drawing_no']").val(drawing_no);
    $("input[name='discipline']").val(discipline);
    $("input[name='module']").val(module);
    $("input[name='type_of_module']").val(type_of_module);
    $("input[name='report_number']").val(report_number);

    $("#modalReoffer").modal();
  }
</script>