<?php
  $fitup = $joint_list[0];
  //print_r($fitup);exit;
?>
<style type="text/css">
  .table {
    font-size: 100% !important;
    padding: 2px !important;
  }

  .select2-container {
    font-size: 70% !important;
    width: 100px !important;
    height: 20px !important;
  }
</style>
<div id="content" class="container-fluid">

<form method="POST" action="<?php echo base_url();?>fitup/proses_update_data_request">

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">Update Data - Inspection</h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          
            <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>Drawing No</label>                    
                    <input type="text" class="form-control" name="drawing_no" value="<?php echo $fitup['drawing_no'] ?>" readonly>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>Discipline</label>
                    <input type="text" class="form-control" name="discipline_view" value="<?php echo (isset($discipline_name[$fitup['discipline']]) ? $discipline_name[$fitup['discipline']] : '-') ?>" readonly>

                    <input type="hidden" class="form-control" name="discipline" value="<?php echo $fitup['discipline']; ?>" readonly>
                  </div>
                </div>
               
              </div>
            
              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>Module</label>
                    <input type="text" class="form-control" name="module_view" value="<?php echo (isset($module_code[$fitup['module']]) ? $module_code[$fitup['module']] : '-') ?>" readonly>
                    <input type="hidden" class="form-control" name="module" value="<?php echo $fitup['module']; ?>" readonly>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>Type Of Module</label>
                    <input type="text" class="form-control" name="type_of_module_view" value="<?php echo (isset($type_of_module_name[$fitup['type_of_module']]) ? $type_of_module_name[$fitup['type_of_module']] : '-') ?>" readonly>
                    <input type="hidden" class="form-control" name="type_of_module" value="<?php echo $fitup['type_of_module']; ?>" readonly>
                  </div>
                </div>                
              </div>

            <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>Requestor Company</label>
                    <input type="text" class="form-control" name="company" value="<?php echo $fitup['company'] ?>" >
                  </div>
                </div>
                 <div class="col-md">
                  <div class="form-group">
                    <label>Request Date</label>
                    <input type="text" class="form-control" name="date_request" value="<?php echo date('d-F-y H:i:s', strtotime($fitup['date_request'])) ?>" readonly>
                  </div>                  
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>Requestor Name</label>
                    <input type="text" class="form-control" name="requestor" value="<?php echo $user_list[$fitup['requestor']] ?>" readonly>
                  </div>
                </div>
                 <div class="col-md">
                  <div class="form-group">
                    <label>Area</label>
                   <select class="form-control" name="area" required>
                      <option value="">---</option>
                      <?php foreach ($area_name_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php if ($fitup['area'] == $value['id']){ echo "selected"; } ?>><?php echo $value['area_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>                  
                </div>
              </div>
        </div>
      </div>
    </div>
  </div>



  <input type="hidden" class="form-control" name="submission_id" value="<?php echo $joint_list[0]['submission_id'] ?>" required readonly>

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">Inspection Detail</h6>
        </div>
        <div class="card-body bg-white overflow-auto">  
                                         
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Inspector Name</label>
                  <div class="col-xl">
                   <input type="hidden" class="form-control" name="inspection_by" value="<?php echo $user_cookie['0'] ?>" required readonly>
                   <input type="text" class="form-control" name="inspector_name" value="<?php echo $user_cookie['1'] ?>" required readonly>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Approval Date & Time</label>
                  <div class="col-xl">
                   <input type="text" class="form-control" name="inspection_datetime" value="<?php echo  date("d F Y H:i:s",strtotime($joint_list[0]['inspection_datetime'])); ?>" required readonly>
                  </div>
                </div>
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
          <h6 class="m-0">Joint Number List</h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          
          <table class="table table-hover text-center overflow-auto dataTable">
              <thead class="bg-green-smoe text-white">
                <tr>
                  <th style="width: 100px !important;max-width: 100px !important;">Status Inspection</th>
                  <th style="width: 260px !important;">Weld Map Drawing Number</th>
                  <th style="width: 50px !important;">Joint No</th>
                  <th style="width: 155px !important;">Part ID</th>
                  <th style="width: 190px !important;">Unique ID Number</th>
                  <th style="width: 80px !important;">Heat Number</th>
                  <th style="width: 95px !important;">Material Grade</th>
                  <th style="width: 15px !important;">Thk<br/>(mm)</th>
                  <th style="width: 15px !important;">Dia<br/>(inch)</th>
                  <th style="width: 15px !important;">Weld<br/>Length<br/>(mm)</th>
                  <!-- <th style="width: 120px !important;">Fitter Code</th> -->

                  <th style="width: 200px !important;">Remarks</th>                 
                </tr>
              </thead>
              <tbody>
                 <?php $no=0; $no_pending=0; foreach ($joint_list as $key => $value): ?>
                    <?php 
                      if($value['status_inspection'] == '1'){
                        $no_pending++;
                      }

                      if($value['status_inspection'] == '5'){
                        $no_pending++;
                      }
                    ?>
                 
                 <tr>
                  <td style="text-align: left !important;">
                     <input type="hidden" name="id_fitup[<?php echo $no ?>]" value="<?php echo $value['id_fitup']; ?>">

                     <?php if($value['status_inspection'] == '5'){ ?>
                       <input type="hidden" name="param_inspection[<?php echo $no ?>]" value="client">
                     <?php } else { ?>
                       <input type="hidden" name="param_inspection[<?php echo $no ?>]" value="qc">
                     <?php } ?>

                    <?php if($value['status_inspection'] == '1' OR $value['status_inspection'] == '5'){ ?>

                      <?php if($value['status_inspection'] != '5'){ ?>
                      <div class="form-check form-check-inline text-success">
                        <input class="form-check-input approve" id='app_<?php echo $no; ?>' type="radio" name="approve[<?php echo $no ?>]" value="A <?= $value['id_fitup'] ?>" style="width: 17px; height: 17px" onclick="change_single_button('1', '<?= $no ?>')">
                        <label class="form-check-label"><b>Approve</b></label>
                      </div></br>                      
                      <div class="form-check form-check-inline text-danger">
                        <input class="form-check-input rejected" id="rjct_<?php echo $no; ?>" type="radio" name="approve[<?php echo $no ?>]" value="R <?= $value['id_fitup'] ?>" style="width: 17px; height: 17px" onclick="change_single_button('2', '<?= $no ?>')">
                        <label class="form-check-label"><b>Reject</b></label>
                      </div></br>                      
                      <div class="form-check form-check-inline text-primary">
                        <input class="form-check-input pending" id='pdg_<?php echo $no; ?>' type="radio" name="approve[<?php echo $no ?>]" value="P <?= $value['id_fitup'] ?>" style="width: 17px; height: 17px" onclick="change_single_button('3', '<?= $no ?>')">
                        <label class="form-check-label"><b>Pending</b></label>
                      </div> <br/>
                      <?php } else if($value['status_inspection'] == '5'){ ?>
                        <div class="form-check form-check-inline text-success">
                        <input class="form-check-input approve" id='app_clnt_<?php echo $no; ?>' type="radio" name="approve[<?php echo $no ?>]" value="A <?= $value['id_fitup'] ?>" style="width: 17px; height: 17px" onclick="change_single_button('7', '<?= $no ?>')">
                        <label class="form-check-label"><b>Approve</b></label>
                        </div></br>
                        <div class="form-check form-check-inline text-danger">
                        <input class="form-check-input rejected" id="rjct_clnt_<?php echo $no; ?>" type="radio" name="approve[<?php echo $no ?>]" value="R <?= $value['id_fitup'] ?>" style="width: 17px; height: 17px" onclick="change_single_button('6', '<?= $no ?>')">
                        <label class="form-check-label"><b>Reject</b></label>
                      </div></br>
                      <?php } ?>

                    <?php } else { 

                      if($value['status_inspection'] == '3' OR $value['status_inspection'] == '7'){
                         echo "<span class='badge badge-success'>Approved</span><br/>";
                      } else if($value['status_inspection'] == '2' OR $value['status_inspection'] == '6'){
                        echo "<span class='badge badge-danger'>Rejected</span><br/>";
                      } else if($value['status_inspection'] == '4'){
                        echo "<span class='badge badge-primary'>Pending By QC</span><br/>"; 
                      } else if($value['status_inspection'] == '5'){
                        echo "<span class='badge badge-primary'>Transmitted</span><br/>"; 
                      }

                      echo "<span class='badge'>".$user_list[$value['inspection_by']]."</span><br/>";  
                      echo "<span class='badge'>".date("d-F-y H:i:s",strtotime($value['inspection_datetime']))."</span><br/>";  

                      if($value['status_inspection'] == '2'){
                         echo "<br/><span style='font-size=5px !important;'><b>Inspector Remarks :</b><br/>".$value["rejected_remarks"]."</span>";
                      } else if($value['status_inspection'] == '4'){
                        echo "<br/><span style='font-size=5px !important;'><b>Inspector Remarks :</b><br/>".$value["pending_qc_remarks"]."</span>";
                      } else if($value['status_inspection'] == '6'){
                        echo "<br/><span style='font-size=5px !important;'><b>Inspector Remarks :</b><br/>".$value["client_remarks"]."</span>";
                      } 

                     } ?>
                    
                     <span class='reject_remarks' id='rjct_rmks_<?php echo $no; ?>' style='display: none;'> Rejected Remarks : 
                     <textarea name='rejected_remarks[<?php echo $no; ?>]' placeholder="---"></textarea>
                     </span>
                     <span class='pending_remarks' id="pdg_rmks_<?php echo $no; ?>" style='display: none;'>
                     Pending By QC Remarks : 
                     <textarea name='pending_qc_remarks[<?php echo $no; ?>]' placeholder="---"></textarea>
                     </span>
                     <span class='client_remarks' id="clnt_rmks_<?php echo $no; ?>" style='display: none;'>
                     Client Remarks : 
                     <textarea name='client_remarks[<?php echo $no; ?>]' placeholder="---"></textarea>
                     </span>
                  </td>
                  <td><?php echo $value['drawing_wm'] ?> Rev.<?php echo $value['rev_wm'] ?></td>
                  <td><?php echo $value['joint_no']
                  ?></td>
                  <td><span class='badge'><?php echo $value['pos_1'] ?></span><hr/><span class='badge'><?php echo $value['pos_2'] ?></span></td>
                  <td>
                    <?php                       
                        echo "<span class='badge badge-primary'>".$warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['unique_ident_no']."</span>";                      
                    ?>
                    <hr/>
                    <?php 
                        echo "<span class='badge badge-primary'>".$warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['unique_ident_no']."</span>";                      
                    ?>                   
                  </td>
                  <td>
                    <?php 
                      if(isset($status_piecemark[$value['pos_1']]['id_mis'])){ 
                        echo $warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['heat_or_series_no'];
                      } else {
                        echo "-";
                      }
                    ?>
                    <hr/>
                    <?php 
                      if(isset($status_piecemark[$value['pos_2']]['id_mis'])){ 
                        echo $warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['heat_or_series_no'];
                      } else {
                        echo "-";
                      }
                    ?>
                  </td>
                  <td>
                    <span class='badge'>
                    <?php 
                      if(isset($status_piecemark[$value['pos_1']]['id_mis'])){ 
                        echo $material_grade[$status_piecemark[$value['pos_1']]['grade']]['material_grade'];
                      } else {
                        echo "-";
                      }
                    ?>
                    </span>
                    <hr/>
                    <span class='badge'>
                     <?php 
                      if(isset($status_piecemark[$value['pos_2']]['id_mis'])){ 
                        echo $material_grade[$status_piecemark[$value['pos_2']]['grade']]['material_grade'];
                      } else {
                        echo "-";
                      }
                    ?>
                    </span>
                  </td>
                  <td><?php echo $value['thickness'] ?></td>
                  <td><?php echo $value['diameter'] ?></td>
                  <td><?php echo $value['weld_length'] ?></td>
                  <!-- <td> -->
                    <!-- <?php 
                      $fitter_id_display = explode(";", $value['fitter_id']);
                      foreach ($fitter_id_display as $key => $val_fitter) {
                        if(isset($fitter_code_arr[$val_fitter])){
                          echo $fitter_code_arr[$val_fitter]."<br/>";
                        }
                      }
                    ?> -->

                        <!-- <select  class='select2_multiple_fitter' name='fitter_id[<?php echo $no; ?>][]' multiple required >
                          <?php
                            $fitter_id_display = explode(";", $value['fitter_id']); 
                            foreach ($fitter_id_display as $key => $value_f) {
                              echo "<option value='".$value_f."' selected>".$fitter_code_arr[$value_f]."</option>";
                            } 
                          ?>
                        </select>
                  </td> -->
                  <td>
                    <textarea name='remarks[<?php echo $no; ?>]' placeholder="---"><?php echo $value["remarks"]; ?></textarea>
                    <?php
                      if(isset($value["pending_qc_remarks"]) AND $value['status_inspection'] == '4'){ 
                        echo "<br/><span style='font-size:12px !important;'><b>Inspector Remarks :</b><br/>".$value["pending_qc_remarks"]."</span>";
                      } 
                    ?>
                  </td>
                  
                </tr>
                 <?php $no++; endforeach; ?>
              </tbody>
            </table>

             <div class="text-right mt-3">
              
               <button type="submit" name="submit" class="btn btn-success" title="Submit">Submit</button>  
              
            </div>

           
            
        </div>
      </div>
    </div>
  </div>
</form>


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

</div>
</div>


<script type="text/javascript">


  $(document).ready(function() {

      $(".select2_multiple_fitter").select2({
        tags: true,
        tokenSeparators: [',', ' '],
        ajax: {
              url: "<?php echo base_url();?>fitup/get_fitter_ajax",
              type: "post",
              dataType       : 'json',
              data: function (params) {
                var query = {
                  search: params.term
                }
                return query;
              },
              processResults: function (data) {
                return {
                  results: data
                }
              }
            }
      })

      $(".select2_multiple_welder").select2({
        tags: true,
        tokenSeparators: [',', ' '],
        ajax: {
              url: "<?php echo base_url();?>fitup/get_welder_ajax_version2",
              type: "post",
              dataType       : 'json',
              data: function (params) {
                var query = {
                  search: params.term
                }
                return query;
              },
              processResults: function (data) {
                return {
                  results: data
                }
              }
            }
      })

      $(".select2_multiple_wps").select2({
        tags: true,
        tokenSeparators: [',', ' '],
        ajax: {
              url: "<?php echo base_url();?>fitup/get_wps_ajax_version2",
              type: "post",
              dataType       : 'json',
              data: function (params) {
                var query = {
                  search: params.term
                }
                return query;
              },
              processResults: function (data) {
                return {
                  results: data
                }
              }
            }
      })

    });

    $('.dataTable').DataTable({
        "paging":   false,
        "ordering": false,
  })

  $("select[name=module]").chained("select[name=project]");

  function change_all_button(mode){

    $(".approve").removeAttr("checked");
    $(".rejected").removeAttr("checked");
    $(".pending").removeAttr("checked");
    $('.reject_remarks').css('display','none');
    $('.pending_remarks').css('display','none');

    if(mode == '1'){

      console.log(mode);

      $(".approve").attr("checked", "checked");
      $(".rejected").removeAttr("checked");
      $(".pending").removeAttr("checked");

      $('.reject_remarks').css('display','none');
      $('.pending_remarks').css('display','none');  

    } else if(mode == '2'){
        console.log(mode);
      $(".rejected").attr("checked", "checked");
      $(".approve").removeAttr("checked");
      $(".pending").removeAttr("checked");

      $('.reject_remarks').show();
      $('.pending_remarks').css('display','none');

    } else if(mode == '3'){

      $(".pending").attr("checked", "checked");
      $(".approve").removeAttr("checked");
      $(".rejected").removeAttr("checked");

      $('.pending_remarks').show();
      $('.reject_remarks').css('display','none');

   } else if(mode == '6'){
        console.log(mode);
      $(".rejected").attr("checked", "checked");
      $(".approve").removeAttr("checked");
      $(".pending").removeAttr("checked");

      $('.client_remarks').show();

    } else if(mode == '7'){

      $(".approve").attr("checked", "checked");
      $(".rejected").removeAttr("checked");

      $('.client_remarks').css('display','none');  

    } else {    
      
      $(".approve").removeAttr("checked");
      $(".rejected").removeAttr("checked");
      $(".pending").removeAttr("checked");

      $('.reject_remarks').css('display','none');
      $('.pending_remarks').css('display','none');
       $('.client_remarks').css('display','none');  

    }

  }

  function change_single_button(mode,no){

    $("#app_"+no).removeAttr("checked");
    $("#rjct_"+no).removeAttr("checked");
    $("#pdg_"+no).removeAttr("checked");

    $('#rjct_rmks_'+no).css('display','none');
    $('#pdg_rmks_'+no).css('display','none');    

    if(mode == '1'){

      $("#app_"+no).attr("checked", "checked");
      $("#rjct_"+no).removeAttr("checked");
      $("#pdg_"+no).removeAttr("checked");

      $('#rjct_rmks_'+no).css('display','none');
      $('#pdg_rmks_'+no).css('display','none');    

    } else if(mode == '2'){

      $("#rjct_"+no).attr("checked", "checked");
      $("#app_"+no).removeAttr("checked");
      $("#pdg_"+no).removeAttr("checked");

      $('#rjct_rmks_'+no).show();
      $('#pdg_rmks_'+no).css('display','none');

    } else if(mode == '3'){

      $("#pdg_"+no).attr("checked", "checked");
      $("#rjct_"+no).removeAttr("checked");
      $("#app_"+no).removeAttr("checked");

      $('#pdg_rmks_'+no).show();
      $('#rjct_rmks_'+no).css('display','none');

    } else if(mode == '6'){
     
      $("#rjct_clnt_"+no).removeAttr("checked");
      $("#app_clnt_"+no).removeAttr("checked");

      $('#clnt_rmks_'+no).show();

    } else if(mode == '7'){
     
      $("#rjct_clnt_"+no).removeAttr("checked");
      $("#app_clnt_"+no).removeAttr("checked");

      $('#clnt_rmks_'+no).css('display','none');

    } 

  }


  function request_for_update(btn, submission_id) {
    var url = "<?= site_url('fitup/request_for_update/') ?>" + submission_id;
    $("#modal").modal({
      show: true,
      keyboard: false,
      backdrop: "static"
    }).find('.modal-body').load(url)
    $('.modal-title').text("Request For Update")
    $('.modal-dialog').addClass('modal-lg')
  }

</script>