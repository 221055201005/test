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

  #detail_card {
      font-size: 12px;
  }

.card-box {
    position: relative;
    color: #fff;
    padding: 1px 5px 2px;
    margin: 10px 0px;
    text-align: left;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
}

.card-box:hover {
    text-decoration: none;
    color: #f1f1f1;
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

.card-box:hover .icon i {
    font-size: 100px;
    transition: 1s;
    -webkit-transition: 1s;
}

.card-box .inner {
    padding: 5px 10px 0 10px;
}

.card-box h3 {
    font-size: 17px;
    font-weight: bold;
    margin: 0 0 1px 0;
    white-space: nowrap;
    padding: 0;
    text-align: left;
}

.card-box p {
    font-size: 11px;
}

.card-box .icon {
    position: absolute;
    top: auto;
    bottom: 5px;
    right: 5px;
    z-index: 0;
    font-size: 50px;
    color: rgba(0, 0, 0, 0.15);
}

.card-box .card-box-footer {
    position: absolute;
    left: 0px;
    bottom: 0px;
    text-align: center;
    padding: 3px 0;
    color: rgba(255, 255, 255, 0.8);
    background: rgba(0, 0, 0, 0.1);
    width: 100%;
    text-decoration: none;
}

.card-box:hover .card-box-footer {
    background: rgba(0, 0, 0, 0.3);
}

.bg-blue {
    background-color: #0031d1 !important;
}
.bg-green {
    background-color: #00a65a !important;
}
.bg-orange {
    background-color: #f39c12 !important;
}
.bg-red {
    background-color: #d9534f !important;
}
.bg-red-2 {
    background-color: #b80000 !important;
}
</style>

<div id="content" class="container-fluid">
  
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0"><?php echo $meta_title ?></h6>
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
          <div class="container-fluid">
              <a href='<?= base_url() ?>fitup/inspection_list_drawing/excel' class='btn btn-success'><i class="fas fa-file-excel"></i> Export Excel</a>
            <table class="table table-hover text-center dataTable" width="100%">
              <thead class="bg-green-smoe text-white">
                <tr>  
                  <th>Submisison No.</th>
                  <th>Project</th>
                  <th>Workpack No.</th>  
                  <th>Drawing No.</th>
                  <th>Drawing WM.</th>
                  <th>Discipline</th>
                  <th>Module</th>
                  <th>Type of Module</th>
                  <th>Company</th>
                  <th>Requestor</th>
                  <th>Request Date</th>
                  <th>Resubmit Status</th>
                  <th>Inspection Status</th>
                  <th style="min-width: 150px;">Action</th>
                </tr>
              </thead>   
              <tbody>
                <?php 
                  foreach ($inspection_list as $key => $value) { 

                    if(!isset($activity_eng[$value['drawing_no']]['id']) OR  !isset($activity_eng[$value['drawing_wm']]['id'])){

                    $where_status['submission_id'] = $value['submission_id'];
                    $where_status['status_retransmitted'] = 0;
                    if(isset($revise)){
                      $where_status['revision_status_inspection'] = 1;
                    } else {
                      $where_status['revision_status_inspection'] = 0;
                    }
                    $data_material = $this->fitup_mod->fitup_list($where_status);
                    unset($where_status);

                    $total_data       = sizeof($data_material);
                    $total_data_all   = array_column($data_material,"status_inspection");
                    $counts           = array_count_values($total_data_all);
                    $total_pass_arr     = $counts[3];
                    $total_reject_arr   = $counts[2];
                    $total_pending_arr  = $counts[1];

                    if(isset($total_pending_arr)){
                      $status_inspection = "<span class='badge badge-warning'>Pending Approval</span>";
                      $resubmit_show = 1;
                      $status_reject = 0;
                    } else if(isset($total_reject_arr)){
                      $status_inspection = "<span class='badge badge-danger'>Rejected</span>";
                      $resubmit_show = 0;
                      $status_reject = 1;
                    } else {
                      $status_inspection = "<span class='badge badge-success'>Approved</span>";
                      $resubmit_show = 0;
                      $status_reject = 0;
                    }
                 
                      if($value['status_resubmit'] == 2 && $resubmit_show == 1){
                        $status_submission = "<span class='btn btn-warning'><i><b>Re-submited</b></i></span>";
                      } else if($value['status_resubmit'] == 1){
                        $status_submission = "<span class='btn btn-info'><i><b>Has been Re-Submit</b></i></span>";
                      } else if($value['status_resubmit'] == 0 && $status_reject === 1){
                        $status_submission = "<span class='btn btn-danger'><i><b>Pending Re-submission</b></i></span>";
                      } else if($value['status_resubmit'] == 2 && $status_reject === 1){
                        $status_submission = "<span class='btn btn-danger'><i><b>Pending Re-submission</b></i></span>";    
                      } else {
                        $status_submission = "-";
                      }
                   
                    if($value['status_resubmit'] != 1){    

                ?>
                <tr>
                  <td><?php echo $value['submission_id']; ?></td>
                  <td><?php echo $project_name[$value['project_code']]; ?></td> 
                  <td><?php echo $value['workpack_no']; ?></td>  
                  <td>
                      <?php echo $value['drawing_no']; ?>
                      <?php if(isset($activity_eng[$value['drawing_no']]['id'])){ ?> 
                        <?php  
                            $links_atc = base_url_ftp_eng()."public_smoe/open_atc/2/".strtr($this->encryption->encrypt($activity_eng[$value['drawing_no']]['id']), '+=/', '.-~');   
                        ?>  
                      <br/><br/><a target='_blank' href='<?= $links_atc ?>'  title='Attachment'> <i class='fas fa-paperclip'></i> Open Drawing </a> 
                      <?php } else { ?> 
                         <br/><br/><b>Waiting Drawing Released</b>
                      <?php } ?> 
                  </td>
                  <td>
                      <?php echo $value['drawing_wm']; ?>
                      <?php if(isset($activity_eng[$value['drawing_wm']]['id'])){ ?> 
                        <?php  
                            $links_atc = base_url_ftp_eng()."public_smoe/open_atc/2/".strtr($this->encryption->encrypt($activity_eng[$value['drawing_wm']]['id']), '+=/', '.-~');   
                        ?>  
                      <br/><br/><a target='_blank' href='<?= $links_atc ?>'  title='Attachment'> <i class='fas fa-paperclip'></i> Open Drawing </a>                       
                      <?php } else { ?> 
                        <br/><br/> <b>Waiting Drawing Released</b>
                      <?php } ?> 
                  </td>
                  <td><?php echo $discipline_name[$value['discipline']]; ?></td>
                  <td><?php echo $module_code[$value['module']]; ?></td>
                  <td><?php echo $type_of_module_name[$value['type_of_module']]; ?></td>
                  <td><?php echo @$company_name[$value['wp_company']]; ?></td>
                  <td><?php echo $user_list[$value['requestor']]; ?></td>
                  <td><?php echo $value['date_request']; ?></td>
                  <td><?= $status_submission ?></td>                 
                  <td><?= $status_inspection ?></td>               
                  <td>
                    <div class="btn-group">
                      <a href='<?php echo  base_url(); ?>fitup/joint_inspection_list/<?php echo strtr($this->encryption->encrypt($value['submission_id']),'+=/', '.-~') ; ?>/<?php echo strtr($this->encryption->encrypt("1904199102102021010891"),'+=/', '.-~'); ?>/<?= $revise ?>' class='btn btn-primary'>
                        <i class='fas fa-list'></i> Detail
                      </a>
                      <a href='<?php echo  base_url(); ?>fitup/pdf_files/<?php echo strtr($this->encryption->encrypt($value['project_code']),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($value['discipline']),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($value['module']),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($value['type_of_module']),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt('marz'),'+=/', '.-~'); ?>/<?php echo strtr($this->encryption->encrypt($value['submission_id']),'+=/', '.-~'); ?>/<?= $revise ?>' target='_blank' class='btn btn-danger'>
                        <i class="fas fa-file-pdf"></i> Report
                      </a>
                    </div>
                  </td>
                </tr>
                <?php 
                    } 
                 } 
                }
                ?>
              </tbody>           
            </table>
          </div>
        </div>
      </div>
    
    </div>
  </div>
</div>
</div>
<script type="text/javascript">

$(document).ready(function(){

  $('.workpack_no').autocomplete({
    source: "<?php echo base_url(); ?>visual/autocomplete_workpack_no",
    autoFocus: true,
    classes: {
      "ui-autocomplete": "highlight"
    }
  });

      $('#total_pending').load('<?= base_url(); ?>fitup/load_status_submission/<?= strtr($this->encryption->encrypt((isset($get['project']) ? $get['project'] : $user_cookie[10])),'+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt("1"),'+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt($user->cookie[11]),'+=/', '.-~') ?>');
      $('#total_approved').load('<?= base_url(); ?>fitup/load_status_submission/<?= strtr($this->encryption->encrypt((isset($get['project']) ? $get['project'] : $user_cookie[10])),'+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt("3"),'+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt($user->cookie[11]),'+=/', '.-~') ?>');
      $('#total_rejected').load('<?= base_url(); ?>fitup/load_status_submission/<?= strtr($this->encryption->encrypt((isset($get['project']) ? $get['project'] : $user_cookie[10])),'+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt("2"),'+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt($user->cookie[11]),'+=/', '.-~') ?>');
      $('#total_reject_pending_resubmit').load('<?= base_url(); ?>fitup/load_status_submission/<?= strtr($this->encryption->encrypt((isset($get['project']) ? $get['project'] : $user_cookie[10])),'+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt("2"),'+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt($user->cookie[11]),'+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt("pending"),'+=/', '.-~') ?>');
      setInterval(function(){
        $('#total_pending').load('<?= base_url(); ?>fitup/load_status_submission/<?= strtr($this->encryption->encrypt((isset($get['project']) ? $get['project'] : $user_cookie[10])),'+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt("1"),'+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt($user->cookie[11]),'+=/', '.-~') ?>');
        $('#total_approved').load('<?= base_url(); ?>fitup/load_status_submission/<?= strtr($this->encryption->encrypt((isset($get['project']) ? $get['project'] : $user_cookie[10])),'+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt("3"),'+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt($user->cookie[11]),'+=/', '.-~') ?>');
        $('#total_rejected').load('<?= base_url(); ?>fitup/load_status_submission/<?= strtr($this->encryption->encrypt((isset($get['project']) ? $get['project'] : $user_cookie[10])),'+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt("2"),'+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt($user->cookie[11]),'+=/', '.-~') ?>');
        $('#total_reject_pending_resubmit').load('<?= base_url(); ?>fitup/load_status_submission/<?= strtr($this->encryption->encrypt((isset($get['project']) ? $get['project'] : $user_cookie[10])),'+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt("2"),'+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt($user->cookie[11]),'+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt("pending"),'+=/', '.-~') ?>');
      },600000); });

    $('.dataTable').DataTable({
        "paging":   false, 
        
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
        }
      }
    });
  }

  $('.search_submission_id').autocomplete({
    source: "<?php echo base_url(); ?>fitup/autocomplete_submission_id",
    autoFocus: true,
    classes: {
      "ui-autocomplete": "highlight"
    }
  });

</script>
