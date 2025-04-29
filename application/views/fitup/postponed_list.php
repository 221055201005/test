<style>
[data-tooltip] {
  position: relative;
  z-index: 2;
  cursor: pointer;
}

/* Hide the tooltip content by default */
[data-tooltip]:before,
[data-tooltip]:after {
  visibility: hidden;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: progid: DXImageTransform.Microsoft.Alpha(Opacity=0);
  opacity: 0;
  pointer-events: none;
}

/* Position tooltip above the element */
[data-tooltip]:before {
  position: absolute;
  bottom: 150%;
  left: 50%;
  margin-bottom: 5px;
  margin-left: -80px;
  padding: 7px;
  width: 160px;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  background-color: #000;
  background-color: hsla(0, 0%, 20%, 0.9);
  color: #fff;
  content: attr(data-tooltip);
  text-align: center;
  font-size: 14px;
  line-height: 1.2;
}

/* Triangle hack to make tooltip look like a speech bubble */
[data-tooltip]:after {
  position: absolute;
  bottom: 150%;
  left: 50%;
  margin-left: -5px;
  width: 0;
  border-top: 5px solid #000;
  border-top: 5px solid hsla(0, 0%, 20%, 0.9);
  border-right: 5px solid transparent;
  border-left: 5px solid transparent;
  content: " ";
  font-size: 0;
  line-height: 0;
}

/* Show tooltip content on hover */
[data-tooltip]:hover:before,
[data-tooltip]:hover:after {
  visibility: visible;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
  filter: progid: DXImageTransform.Microsoft.Alpha(Opacity=100);
  opacity: 1;
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
<div id="content" class="container-fluid">
  <div class="row">
    <div class="col-md-12">

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
	                  <label class="col-md-4 col-lg-3 col-form-label ">Project ID </label>
	                  <div class="col-xl">
	                    <select class="form-control" name="project" required>
	                    <?php // if($this->is_admin == 1){ ?>
	                        <option value="">---</option>
	                      <?php // } ?>
	                      <?php foreach ($project_list as $key => $value) : ?>
	                        <?php // if($this->is_admin == 1){ ?>
	                         <option value="<?php echo $value['id'] ?>" <?php echo (@$post['project'] == $value['id'] ? 'selected' : $this->user_cookie[10]) ?>><?php echo $value['project_name'] ?></option>
	                        <?php // } else { ?>
	                          <?php // if($this->user_cookie[10] == $value['id']){ ?>
	                            <!-- <option value="<?php echo $value['id'] ?>" selected><?php echo $value['project_name'] ?></option> -->
	                          <?php // } ?>
	                        <?php // } ?> 
	                      <?php endforeach; ?>
	                      
	                    </select>
	                  </div>
	                </div>
	              </div>
	            
	              <div class="col-6">
	                <div class="form-group row">
	                  <label class="col-md-4 col-lg-3 col-form-label ">Drawing Type</label>
	                  <div class="col-xl">
	                    <select class="form-control" name="drawing_type" >
	                      <option value="">---</option>
	                      <option value="1" <?php echo (@$post['drawing_type'] == '1' ? 'selected' : '') ?>>GA</option>
	                      <option value="2" <?php echo (@$post['drawing_type'] == '2' ? 'selected' : '') ?>>Assembly</option> 
	                      <option value="13" <?php echo (@$post['drawing_type'] == '13' ? 'selected' : '') ?>>Isometric</option>
	                      <option value="9" <?php echo (@$post['drawing_type'] == '9' ? 'selected' : '') ?>>WM GA</option>
	                      <option value="14" <?php echo (@$post['drawing_type'] == '14' ? 'selected' : '') ?>>WM AS</option>
	                      <option value="12" <?php echo (@$post['drawing_type'] == '12' ? 'selected' : '') ?>>Pipe Support</option>
	                    </select>
	                  </div>
	                </div>
	              </div>
	            </div>
	            
	            <div class="row">

	              <div class="col-6">
	                <div class="form-group row">
	                  <label class="col-md-4 col-lg-3 col-form-label ">Module</label>
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
	                  <label class="col-md-4 col-lg-3 col-form-label ">Type Of Module</label>
	                  <div class="col-xl">
	                   <select class="form-control" name="type_of_module" >
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
	              <div class="col-6">
	                <div class="form-group row">
	                  <label class="col-md-4 col-lg-3 col-form-label ">Discipline</label>
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
	              <div class="col-6">
	                <div class="form-group row">
	                  <label class="col-md-4 col-lg-3 col-form-label ">Drawing Number</label>
	                  <div class="col-xl">
	                    <input type="text" class="form-control autocomplete_doc" name="drawing_no" value="<?php echo @$post['drawing_no'] ?>"  >
	                    <input type="hidden" class="form-control autocomplete_doc" name="drawing_wm" required >
	                  </div>
	                </div>
	              </div>
	            </div>

	            <div class="row">
	              <div class="col-6">
	                <div class="form-group row">
	                  <label class="col-md-4 col-lg-3 col-form-label ">Status Inspection</label>
	                  <div class="col-xl">
	                    <select class="form-control" name="status_inspection" >
	                      <option value="">---</option>
	                      <!-- <?php //if(isset($status_rejected)){ ?> -->
	                        <option value="9" <?php echo (@$post['status_inspection'] == "9" ? 'selected' : '') ?>>Approved & Released With Comment</option>
	                        <option value="6" <?php echo (@$post['status_inspection'] == "6" ? 'selected' : '') ?>>Rejected</option>                        
	                        <option value="11" <?php echo (@$post['status_inspection'] == "11" ? 'selected' : '') ?>>Re-Offer</option>                        
	                      <!-- <?php //} else { ?> -->
	                        <option value="10" <?php echo (@$post['status_inspection'] == "10" ? 'selected' : '') ?>>Postponed</option>
	                      <!-- <?php //} ?>                       -->
	                    </select>
	                  </div>
	                </div>
	              </div>
	              <div class="col-6">
	                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Deck Elevation / Service Line</label>
	                  <div class="col-xl">
	                    <select class="form-control" name="deck_elevation" >
	                      <option value="">---</option>
	                      <?php foreach ($deck_list as $key => $value) : ?>
	                        <option value="<?php echo $value['id'] ?>" <?php echo (@$post['deck_elevation'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['name'] ?></option>
	                      <?php endforeach; ?>
	                    </select>
	                  </div>  
	                </div>
	              </div>
	            </div>

	            <div class="row">
	                <div class="col-6">
	                <div class="form-group row">
	                 
	                </div>
	              </div>
	             
	              <div class="col-6">
	                <div class="form-group row">
	                  
	                </div>
	              </div>
	            </div>

	            <div class="row">
	              <div class="col-12 text-right">
	                <button class="mt-2 btn btn-sm btn-flat btn-info"><i class="fas fa-search"></i> Search</button>
	              </div>
	            </div>
	          </form>
	        </div>
	      </div>
      </div>
    </div>
  </div>
      <?php //if(sizeof($post) > 0){ ?>
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0"><?php echo $meta_title ?></h6>
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
          <div class="container-fluid">
            <table class="table table-hover text-center dataTable" width="100%">
              <thead class="bg-gray-table ">
                <tr>                              
                  <th>RFI Number</th>
                  <th>Report Number</th>
                  <th>Drawing No</th>
                  <th>Discipline</th>
                  <th>Module</th>
                  <th>Type Of Module</th>
                  <th>Deck Elevation</th>
                  <th>Client Inspection</th> 
                  <th>Invitation type</th>
                  <th>Status Inspection</th>
                  <th style="width:300px;word-wrap:break-word; table-layout: fixed;">Client Remarks</th>
                  <th width="300px;">Action</th>
                </tr>
              </thead>   
              <tbody>
                
                <?php 
   
                  foreach ($client_list as $key => $value) { 

                    // test_var($client_list);
                    $where_status['report_number']  = $value['report_number'];
                    $where_status['pcms_fitup.discipline']     = $value['discipline'];
                    $where_status['pcms_fitup.module']         = $value['module'];
                    $where_status['pcms_fitup.type_of_module'] = $value['type_of_module'];
                    $where_status['pcms_joint.company_id']     = $value['company_wp'];
                    $where_status['deck_elevation']     = $value['deck_elevation'];
                    $where_status["status_retransmitted"]  = 0;
                    $where_status["status_resubmit <> 1"]  = null; 
                    $data_material = $this->fitup_mod->fitup_list_v2($where_status);
                    unset($where_status);

                    $total_data         = sizeof($data_material);
                    $total_data_all     = array_column($data_material,"status_inspection");
                    $counts             = array_count_values($total_data_all);
                    $total_pending_qc    = (isset($counts[1]) ? $counts[1] : null);
                    $total_reoffer_arr   = (isset($counts[11]) ? $counts[11] : null); 
                    $total_rejected_arr  = (isset($counts[6]) ? $counts[6] : null);
                    $total_postponed_arr = (isset($counts[10]) ? $counts[10] : null);
                    $total_approve_comment_arr = (isset($counts[9]) ? $counts[9] : null);

                    if(isset($total_rejected_arr)){

                      $status_inspection = "<span class='btn btn-danger font-weight-bold'>Rejected</span>";
                      $status_dsp = "6";

                    } else if(isset($total_postponed_arr)){
                      $status_inspection = "<span class='btn btn-info font-weight-bold'>Postponed</span>";
                      $status_dsp = "10";
                    } else if(isset($total_approve_comment_arr)){
                      $status_inspection = "<span class='btn btn-primary font-weight-bold'>Approved And Relased With Comment</span>";
                      $status_dsp = "9";  
                    } else {
                      $status_inspection = "<span class='btn btn-warning font-weight-bold'>Re-Offer</span>";
                      $status_dsp = "11";
                    }
                   
                    // ECHO $balance;

                    if($value['status_invitation'] == 1){
                        $status_inv = "<span class='badge badge-info'>Notification Activity</span>";
                    } else if($value['status_invitation'] == 0){
                        $status_inv = "<span class='badge badge-primary'>Invitation Witness</span>";
                    }

                    $legend_output = explode(";",$value['legend_inspection_auth']);

                    $arr_inspection_auth      = array();
      
                    if($legend_output[0] == 1) {
                      $arr_inspection_auth[0] = "Hold Point";
                    }

                    if($legend_output[1] == 1) {
                      $arr_inspection_auth[1] = "Witness";
                    }

                    if($legend_output[2] == 1) {
                      $arr_inspection_auth[2] = "Monitoring";
                    }

                     if($legend_output[3] == 1) {
                      $arr_inspection_auth[3] = "Review";
                    }

                    $list_arr_inspection_authx = implode(", ", $arr_inspection_auth);

                  ?>
                 <tr>                              
                  <td>
                    <?php if($value["project_code"] == 21){ ?>
                      <?php echo $master_report_number_deck[$value['project_code']][$value['discipline']][$value['type_of_module']][$value["company_wp"]][$value["deck_elevation"]]['fitup_rfi'].$value['report_number']; ?>
                    <?php } else { ?>
                      <?php echo $master_report_number[$value['project_code']][$value['discipline']][$value['type_of_module']][$value["company_wp"]]['fitup_rfi'].$value['report_number']; ?>
                    <?php } ?>
                  </td>
                  <td>
                    <?php if($value["project_code"] == 21){ ?>
                      <?php echo $master_report_number_deck[$value['project_code']][$value['discipline']][$value['type_of_module']][$value["company_wp"]][$value["deck_elevation"]]['fitup_report'].$value['report_number']; ?> Rev. <?= str_pad($value['postpone_reoffer_no'],2,0, STR_PAD_LEFT) ?>
                    <?php } else { ?>
                      <?php echo$master_report_number[$value['project_code']][$value['discipline']][$value['type_of_module']][$value["company_wp"]]['fitup_report'].$value['report_number']; ?> Rev. <?= str_pad($value['postpone_reoffer_no'],2,0, STR_PAD_LEFT) ?>
                    <?php } ?>
                  </td>
                  <td><?php echo $value['drawing_no']; ?></td>
                  <td><?php echo $discipline_name[$value['discipline']]; ?></td>
                  <td><?php echo $module_code[$value['module']]; ?></td>
                  <td><?php echo $type_of_module_name[$value['type_of_module']]; ?></td>
                  <td><?php echo $deck_elevation_name[$value['deck_elevation']]; ?></td>
                  <td><?php echo $user_list[$value['client_inspection_by']]; ?><br/><?php echo date("Y-m-d H:i:s",strtotime($value['client_inspection_date'])); ?></td>
                   <td><?php echo $status_inv."<br/><span style='font-size:12px;'><b><i>".$list_arr_inspection_authx."</i></b>"; ?></td>              
                  <td><?php echo $status_inspection; ?></td>                 
                  <td>
                     
                      <?php if($status_dsp == '11'){ ?>
                          <?php echo $value['reoffer_remarks']; ?>
                      <?php } else if($status_dsp == '10'){ ?>
                        <?php echo $value['postpone_remarks']; ?>
                      <?php } else if($status_dsp == '9'){ ?>
                          <?php echo $value['approve_comment']; ?>    
                      <?php } else { ?>
                          <?php echo $value['client_remarks']; ?>                          
                      <?php } ?>                     
                  
                  </td>                 
                                   
                  <td class="text-center align-middle">
                    <div class="btn-group"> 
                      <a href='<?php echo  base_url(); ?>fitup/client_inspection/<?php echo strtr($this->encryption->encrypt($value['project_code']),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($value['discipline']),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($value['module']),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($value['type_of_module']),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($value['report_number']),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($value['company_wp']),'+=/', '.-~'); ?>/NULL/<?php echo strtr($this->encryption->encrypt($value['deck_elevation']),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($value['postpone_reoffer_no']),'+=/', '.-~'); ?>' class='text-nowrap'><button class='btn btn-secondary'><i class="fas fa-tasks"></i> Details</button></a> 
                      <?php if($total_pending_qc <= 0){ ?>
                          <?php if(isset($status_rejected)){ ?>
                            <form action="<?php echo base_url(); ?>fitup/joint_list/transmittal/rejected" method="post">
                              <input type="hidden" name='project' value="<?php echo $value['project_code'] ?>">
                              <input type="hidden" name='drawing_type' value="<?php echo $value['drawing_type'] ?>">
                              <input type="hidden" name='module' value="<?php echo $value['module'] ?>">
                              <input type="hidden" name='type_of_module' value="<?php echo $value['type_of_module'] ?>">
                              <input type="hidden" name='discipline' value="<?php echo $value['discipline'] ?>">
                              <input type="hidden" name='drawing_no' value="<?php echo $value['drawing_no'] ?>">
                              <input type="hidden" name='status_inspection' value="<?php echo $value['status_inspection'] ?>">
                              <input type="hidden" name='drawing_wm' value="<?php echo $detail_template_joint[$value["id_joint"]]["drawing_wm"]; ?>">
                              <input type="hidden" name='report_number' value="<?php echo $value['report_number']; ?>">
                              <input type="hidden" name='postpone_reoffer_no' value="<?php echo $value['postpone_reoffer_no']; ?>">
                              <input type="hidden" name='company_id' value="<?php echo $value['company_wp']; ?>">
                              <button type="submit" class="btn btn-danger text-nowrap"><i class="fa-thin fa-shield-exclamation"></i> Re-transmittal</button>
                            </form>
                          <?php } else { ?>
                            <!-- <a href="#" class="btn btn-danger text-nowrap btnRetransmitted" data-id="<?= $value['drawing_no'] ?>|<?= $value['discipline'] ?>|<?= $value['module'] ?>|<?= $value['type_of_module'] ?>|<?= $value['report_number'] ?>|<?= $value['postpone_reoffer_no'] ?>|<?= $value['status_retransmitted'] ?>|<?= $value['status_invitation'] ?>|<?= $value['legend_inspection_auth'] ?>|<?= $detail_template_joint[$value['id_joint']]['drawing_wm'] ?>"> <i class="fas fa-retweet"></i> Re-transmittal</a> -->

                            <?php if($value["company_wp"] == 13){ ?>
                              <?php $renox = $master_report_number[$value['project_code']][$value['discipline']][$value['type_of_module']]['fitup_report_scm'].$value['report_number'].' Rev.'.str_pad($value['postpone_reoffer_no'],2,0, STR_PAD_LEFT); ?> 
                            <?php } else { ?>
                            <?php $renox = $master_report_number[$value['project_code']][$value['discipline']][$value['type_of_module']]['fitup_report'].$value['report_number'].' Rev.'.str_pad($value['postpone_reoffer_no'],2,0, STR_PAD_LEFT); ?> 
                            <?php } ?>             

                            <button type="button" onclick="re_transmit_data(this,'<?= $value['report_number'] ?>', <?= $value['discipline'] ?>,<?= $value['module'] ?>,<?= $value['type_of_module'] ?>,<?= $value['project_code'] ?>,<?= $value['postpone_reoffer_no'] ?>,'<?= $renox ?>',<?= $value['company_wp'] ?>, '<?= $value['drawing_no'].'_'. $value['discipline'].'_'.$value['module'].'_'.$value['type_of_module'].'_'.$value['report_number'].'_'.$value['status_inspection'].'_'.$value['postpone_reoffer_no'].'_'.$value['company_wp'] ?>',<?= $value['deck_elevation'] ?>)" class="btn btn-danger" ><i class="fas fa-retweet"></i> Re-transmittal</button>

                          <?php } ?>
                      <?php } else { ?>
                        <a href="#" class="btn btn-warning text-nowrap"> <i class="fa fa-info-circle" aria-hidden="true"></i> On Revise Progress</a>
                      <?php } ?>
                    </div>
                  </td>
                </tr>
              <?php } ?>             
              </tbody>           
            </table>
          </div>
        </div>
      </div>
    <?php //} ?>
    </div>
  </div>
</div>
</div>
 
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

  $(document).ready(function(){

    $(".btnRetransmitted").click(function(){
      var varData = $(this).data('id');
      var myArr = varData.split("|");

      console.log(myArr);

        $("input[name=drawing_no_modal]").val(myArr[0]);
        $("input[name=drawing_wm_modal]").val(myArr[9]);
        $("input[name=discipline_modal]").val(myArr[1]);
        $("input[name=module_modal]").val(myArr[2]);
        $("input[name=type_of_module_modal]").val(myArr[3]);
        $("input[name=report_number_modal]").val(myArr[4]);
        $("input[name=postpone_reoffer_no_modal]").val(myArr[5]);
        $("input[name=status_retransmitted_modal]").val(myArr[6]);
        $("select[name='status_invitation_modal']").val(myArr[7]).trigger('change');
       

        var varDataLegend = myArr[8];
        var myArrLegend = varDataLegend.split(";");

        var arrValL = [];
        for (var i = 0; i <= myArrLegend.length; i++) {
            if(myArrLegend[i] == 1){
             arrValL.push(i);
           }
        }
         
        $("select[name='legend_inspection_auth_modal[]']").val(arrValL).trigger('change');
     
        $(".modalRetransmitted").modal();
    }); 

  });

  $('.dataTable').DataTable({
    "paging":   false,
    "ordering": false,
    "info":     false,
  })

  $("select[name=module]").chained("select[name=project]");

  $(".autocomplete_doc, .autocomplete_wm").autocomplete({
    source: function( request, response ) {

      var project         = $("select[name='project']").find('option:selected').val();  
      var drawing_type    = $("select[name='drawing_type']").find('option:selected').val(); 
      var discipline      = $("select[name='discipline']").find('option:selected').val(); 
      var module          = $("select[name='module']").find('option:selected').val(); 
      var type_of_module  = $("select[name='type_of_module']").find('option:selected').val(); 
      var drawing_wm      = $("input[name='drawing_wm']").val(); 
      var type_of_module  = $("select[name='type_of_module']").find('option:selected').val();  

      $.ajax( {
        url: "<?php echo base_url() ?>fitup/autocomplete_drawing_joint",
        type: "post",
        dataType: "json",
        data: {
          term: request.term,
          project: project,
          drawing_type: drawing_type,
          discipline: discipline,
          module: module,
          type_of_module: type_of_module,
          drawing_wm: drawing_wm,
        },
        success: function( data ) {
          response( data );
        }
      });
    },
    select: function (event, ui) {
      var value = ui.item.value;
      if(value == 'No Data.'){
        ui.item.value = "";
      }
      else{
        get_data_drawing(ui.item.value);
      }
    }
  });

  function get_data_drawing(document_no) {
    var module = $("select[name=module]").val();
 
     $.ajax( {
      url: "<?php echo base_url() ?>fitup/get_data_drawing",
      dataType: "json",
      data: {
        document_no: document_no,
        module: module,
      },
      success: function(data) {
        console.log(data);
        if(data.drawing_type == 1 || data.drawing_type == 2){
          $("select[name=project]").val(data.project).trigger('change');
          $("select[name=discipline]").val(data.discipline);
          $("select[name=drawing_type]").val(data.drawing_type);
          if(module == ""){
            $("select[name=module]").val(data.module);            
          }
          $("select[name=type_of_module]").val(data.type_of_module);
          $("select[name=status_inspection]").val(5);
        }
      }
    });
  }

  function re_transmit_data(event, report_no, discipline, module, type_of_module, project, status_inspection, report_number_actual,company_wp, identifier, deck_elevation) {
    let url = "<?= site_url('fitup/re_transmit_data/') ?>"+report_no+'/'+discipline+'/'+module+'/'+type_of_module+'/'+project+'/'+status_inspection+'/'+identifier+'/'+company_wp+'/'+deck_elevation
    
    $("#modal").modal({
      show : true,
      keyboard : false,
      backdrop : "static"
    }).find('.modal-body').load(url)
    $('.modal-title').html(`<strong>${report_number_actual} - </strong> Re - Transmit Data`)
    $('.modal-dialog').addClass('modal-lg')
  }

  function append_drawing_links(rev,drawing_type) {
      var rev_oke = $(rev).val();
      if(drawing_type == 0){ 
        $(".add_drawing_ga_as").text(""); 
        var links = "<?= base_url_ftp_eng() ?>public_smoe/open_atc/2/<?= (isset($get['drawing_no']) ? strtr($this->encryption->encrypt($activity_eng[$get['drawing_no']]['id']), '+=/', '.-~') : "" ) ?>/"+ rev_oke;
        $(".add_drawing_ga_as").append('<a target="_blank" href="'+links+'"><?= @$get['drawing_no'] ?> (Rev. '+ rev_oke +')</a>');
      } else if(drawing_type == 1){ 
        $(".add_drawing_ga_wm").text(""); 
        var links = "<?= base_url_ftp_eng() ?>public_smoe/open_atc/2/<?= (isset($get['drawing_wm']) ? strtr($this->encryption->encrypt($activity_eng[$get['drawing_wm']]['id']), '+=/', '.-~') : "" )  ?>/"+ rev_oke;
        $(".add_drawing_ga_wm").append('<a target="_blank" href="'+links+'"><?= @$get['drawing_wm'] ?> (Rev. '+ rev_oke +')</a>');
      }
  }


  


</script>
