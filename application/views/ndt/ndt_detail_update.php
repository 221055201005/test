<style type="text/css">
  input[type="checkbox"][readonly] {
    pointer-events: none;
    opacity:0.3;
  }
</style>
<div id="content" class="container-fluid">
    <div class="row">

      <div class="col-md-12">
        <div class="my-3 p-3 bg-white rounded shadow-sm">
          <h6 class="pb-2 mb-0"><?php echo $meta_title ?></h6>
          <div class="overflow-auto media text-muted pt-3 mt-1 border-top border-gray">
            <div class="container-fluid">

              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>Drawing Number</label>
                    <input type="text" class="form-control" name="drawing_no" id="drawing_no" value="<?= $list[0]['drawing_no'] ?>" autocomplete="off" readonly>
                    <span id="text_alert"></span>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>Discipline</label>
                    <input type="text" class="form-control" name="discipline_name" readonly required value="<?= $discipline_list[$list[0]['discipline']]['discipline_name'] ?>">
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>Module</label>
                    <input type="text" class="form-control" name="module_name" readonly required value="<?= $module_list[$list[0]['module']]['mod_desc'] ?>">
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>Date of Inspection</label>
                    <input type="text" name="technique" class="form-control" value="<?= DATE('Y-m-d', strtotime($list[0]['date_of_inspection'])); ?>" readonly>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>NDT Report No</label>
                    <input type="text" name="ndt_report_number" class="form-control" value="<?= $list[0]['report_number'] ?>" required>
                  </div>
                </div>
              </div>

              <div class="row <?= $this->user_cookie[7]==8 ? 'd-none' : '' ?>" style="margin-bottom: 0cm !important">
                <div class="col-md">
                  <div class="form-group">
                    <div class="form-row">
                      <div class="form-group col-md-12">
                        <table width="500px">
                        <tr>
                          <td style="padding:10px;">Change Date of Inspection</td>
                          <td style="padding:10px;">:</td>
                          <td style="padding:10px;"><input type='date' name='approval_date' class="form-control" required="" value='<?= $date_of_inspection ?>' onchange="update_inspectiondate('<?= $list[0]['report_number'] ?>', '<?= $list[0]['drawing_no'] ?>')"></td>
                          <script type="text/javascript">
                            function update_inspectiondate(report_number,drawing_no){

                              var new_doi = $('input[name=approval_date]').val();

                              Swal.fire({
                                title: 'Are you sure want to change date of inspection ?',
                                text: "",
                                type: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, Update this date!'
                              }).then((result) => {

                                if (result.value) {
                                  $.ajax({
                                    url: "<?= base_url('ndt/change_date_of_inspection/').$initial ?>",
                                    type: "post",
                                    data: {
                                      'report_no': report_number,
                                      'drawing_no': drawing_no,
                                      'date_of_inspection': new_doi,
                                    },
                                    success: function(data){
                                      Swal.fire(
                                        'Approval Date Has Been Updated !',
                                        '',
                                        'success'
                                      ).then(function() {
                                          
                                          location.reload();
                                          return false;
                                      });
                                    }
                                  });
                                }
                              })

                            }
                          </script>
                        </tr>
                        <?php if($list[0]['pwht_status']==1){ ?>
                          <tr>
                            <td>
                              <b style="padding:10px;">APWHT:</b>
                              <i class="fas fa-check-square text-success fa-lg"></i>
                            </td>
                          </tr>
                        <?php } ?>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <button class="btn btn-warning font-weight-bold" onclick="update_report_number('<?= $list[0]['report_number'] ?>', '<?= $list[0]['drawing_no'] ?>')">Change Report Number</button>
                    <script type="text/javascript">
                      function update_report_number(last_rn, drawing_no){
                        var new_report_no = $('input[name=ndt_report_number]').val();
                        Swal.fire({
                          title: 'Are you sure want to resubmit ?',
                          text: "",
                          type: 'warning',
                          showCancelButton: true,
                          confirmButtonColor: '#3085d6',
                          cancelButtonColor: '#d33',
                          confirmButtonText: 'Yes, Update this Report No!'
                        }).then((result) => {

                          if(result.value) {

                            $.ajax({
                              url: "<?= base_url('ndt/change_report_number/').$initial ?>",
                              type: "post",
                              data: {
                                'new_report_no': new_report_no,
                                'old_report_no': last_rn,
                                'drawing_no': drawing_no,
                                'submission_id': '<?= $list[0]['submission_id'] ?>'
                              },
                              success: function(data){
                                Swal.fire(
                                  'Report Number Has Been Updated !',
                                  '',
                                  'success'
                                ).then(function(){                
                                    location.reload();
                                    return false;
                                });
                              }
                            });

                          }

                        })

                      }
                    </script>
                  </div>
                </div>
              </div>
              
              <?php if($data_radiographic_joint[0]['pwht']==1){ ?>
              <div class="row" style="margin-top: 0cm !important">
                <div class="col-md-4 pl-3">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="" value="1" class="custom-control-input pwht_check" id="customCheck1" <?= $data_radiographic_joint[0]['pwht']==1 ? 'checked' : ''; ?>>
                    <label class="custom-control-label">PWHT</label>
                  </div>
                </div>
              </div>
              <?php } ?>

              <div class="container col-md-12">
 
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#joint_detail">Joint Details</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu1">Attachment</a>
                  </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                  <div id="joint_detail" class="container tab-pane  col-md-12 active"><br>
                    <div class="row" name="<?php echo $drawing_no ?>">
                      <div class="col-md-12">
                        <!-- <h6 class="mt-3 px-3 py-3 mb-0 bg-success text-white">
                        <button class="btn attachment_minimize text-white" type="button"><i class="fa fa-minus"></i></button>
                          Drawing Number : <span><?= $drawing_no ?></span>
                        </h6> -->
                      <div class="col-md-12 table-responsive">
                        
 
                        <div class="<?= $this->user_cookie[7]==8 ? 'd-none' : '' ?>">
                          <br>
                          <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            <i class="fas fa-plus"></i>
                             Add Joint
                          </button>
                          <br>
                          <br>
                        </div>

                        <table class="table table-hover" style="width: 100% !important">
                          <thead>
                            <tr>
                              <th class="bg-green-smoe text-white text-center align-middle">Weld Map</th>                  
                              <th class="bg-green-smoe text-white text-center align-middle">Joint No.</th>
                              <th class="bg-green-smoe text-white text-center align-middle">Length of Weld</th>
                              <th class="bg-green-smoe text-white text-center align-middle" style="min-width: 150px !important">Tested Length</th>
                              <th class="bg-green-smoe text-white text-center align-middle">Result</th>
                              <th class="bg-green-smoe text-white text-center align-middle" style="min-width: 150px !important">Reject Length (R/H)</th>
                              <th class="bg-green-smoe text-white text-center align-middle" style="min-width: 150px !important">Reject Length (F/C)</th>
                              <th class="bg-green-smoe text-white text-center align-middle" style="<?= $list[0]['result']==2 ? 'min-width: 1030px !important' : ''; ?>">Deffect Detail</th>
                              <th class="bg-green-smoe text-white text-center align-middle">Remarks</th>
                              <th class="bg-green-smoe"></th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($list as $key => $value) {?>
                              <?php //test_var($value); ?>
                            <tr class="tr_<?= $value['id'] ?>">
                              <td><?= $value['drawing_wm'] ?></td>
                              <td class="text-center"><?= $value['joint_no'].($value['revision']>0 ? '('.$value['revision_category'].$value['revision'].')' : '') ?></td>
                              <td class="text-center">
                                <?php if($value['revision']>0){
                                  echo $value['length_of_weld'];
                                } else {
                                  echo $value['total_length'];
                                } ?>
                              </td>
                              <td>
                                <?php //test_var($value); ?>
                                <div class="input-group-prepend">
                                  <input type="number" name='tested_length' class="form-control tested_length_<?= $key ?> tested_length_id_<?= $value['id'] ?>" value="<?= $value['tested_length'] ?>" max="<?= $value['length_of_weld'] ?>" onkeyup="checkTotalLength(this, '<?= $value['ndt_type'] ?>', '<?= $value['id_visual'] ?>', '<?= $value['tested_length'] ?>')">

                                  <input type="hidden" name='id_ndt' class="form-control id_ndt_<?= $key ?>" value="<?= $value['id'] ?>">
                                  <span class="btn btn-warning <?= $this->user_cookie[7]==8 ? 'd-none' : '' ?>" onclick="saveTestedLength('<?= $key ?>')" ><i class="fas fa-save"></i></span>
                                  <script type="text/javascript">
                                    function saveTestedLength(kunci){
                                      var length = $('.tested_length_'+kunci).val()
                                      var id     = $('.id_ndt_'+kunci).val()

                                      $.ajax({
                                        url: "<?php echo base_url();?>ndt/update_tested_length",
                                        type: "post",
                                        data: {
                                          tested_length: length,
                                          id: id,
                                        },
                                        success: function(data) { 
                                          Swal.fire(
                                            'Success',
                                            'Your data has been Updated!',
                                            'success'
                                          );
                                          location.reload();                  
                                        }
                                      });
                                    }
                                  </script>
                                </div>
                              </td>

                              <td>
                                <?php 
                                  if($value['result']==2){
                                    echo '<span class="badge badge-danger">Rejected</span>';
                                  } elseif($value['result']==3){
                                    echo '<span class="badge badge-success">Approved</span>';
                                  }
                                ?> 
                              </td>

                              <td>
                                <?php if($value['result']!=2){
                                  echo "-";
                                } else { ?>
                                  <div class="input-group-prepend">
                                    <input type="number" name='reject_length_rh' class="form-control reject_length_rh_<?= $key ?> reject_length_rh_id_<?= $value['id'] ?>" value="<?= $value['reject_length_rh'] ?>">
                                    <input type="hidden" name='id_ndt' class="form-control id_ndt_<?= $key ?>" value="<?= $value['id'] ?>">
                                    <span class="btn btn-warning <?= $this->user_cookie[7]==8 ? 'd-none' : '' ?>" onclick="saveRejectLengthRH('<?= $key ?>')"><i class="fas fa-save"></i></span>
                                    <script type="text/javascript">
                                      function saveRejectLengthRH(kunci){
                                        var r_length_rh = $('.reject_length_rh_'+kunci).val()
                                        var id     = $('.id_ndt_'+kunci).val()

                                        $.ajax({
                                          url: "<?php echo base_url();?>ndt/update_reject_length",
                                          type: "post",
                                          data: {
                                            reject_length: r_length_rh,
                                            id: id,
                                            type: 'rh'
                                          },
                                          success: function(data) { 
                                            Swal.fire(
                                              'Success',
                                              'Your data has been Updated!',
                                              'success'
                                            );
                                            location.reload();                  
                                          }
                                        });
                                      }
                                    </script>
                                  </div>
                                <?php } ?>
                              </td>

                              <td>
                                <?php if($value['result']!=2){
                                  echo "-";
                                } else { ?>
                                  <div class="input-group-prepend">
                                    <input type="number" name='reject_length_fc' class="form-control reject_length_fc_<?= $key ?> reject_length_fc_id_<?= $value['id'] ?>" value="<?= $value['reject_length_fc'] ?>">
                                    <input type="hidden" name='id_ndt' class="form-control id_ndt_<?= $key ?>" value="<?= $value['id'] ?>">
                                    <span class="btn btn-warning <?= $this->user_cookie[7]==8 ? 'd-none' : '' ?>" onclick="saveRejectLengthFC('<?= $key ?>')"><i class="fas fa-save"></i></span>
                                    <script type="text/javascript">
                                      function saveRejectLengthFC(kunci){
                                        var r_length_fc = $('.reject_length_fc_'+kunci).val()
                                        var id     = $('.id_ndt_'+kunci).val()

                                        $.ajax({
                                          url: "<?php echo base_url();?>ndt/update_reject_length",
                                          type: "post",
                                          data: {
                                            reject_length: r_length_fc,
                                            id: id,
                                            type: 'fc'
                                          },
                                          success: function(data) { 
                                            Swal.fire(
                                              'Success',
                                              'Your data has been Updated!',
                                              'success'
                                            );
                                            location.reload();                  
                                          }
                                        });
                                      }
                                    </script>
                                  </div>
                                <?php } ?>
                              </td>

                              <td>
                              <?php if($value['result']==2){ ?>
                                  <div class="row">   
                                    <div class="col">
                                      <u>Deffect Type</u><br><br>  
                                      <select id='ctq_id_<?= $value["id"]; ?>' class="form-control">
                                        <option value="">-----</option>                                          
                                        <?php foreach ($master_data_ctq as $valuex) { ?>                                           
                                          <option value="<?php echo $valuex['id']; ?>"><?php echo $valuex["ctq_description"]; ?> ( <?php echo $valuex["ctq_initial"]; ?> )</option>                                            
                                        <?php } ?>                     
                                      </select>
                                    </div>
                                    <div class="col">
                                      <u>Deffect Length</u><br><br> 
                                      <input type='number' step='any'  class='form-control ctq_rejected' id='ctq_length_<?= $value["id"]; ?>' placeholder='Length' onkeyup="check_length(<?= $value['id'] ?>)">
                                    </div>
                                    <div class="col">
                                      <u>Distance from Datum</u><br><br> 
                                      <input type='text' step='any'  class='form-control ctq_rejected' id='ctq_datum_<?= $value["id"]; ?>' placeholder='Datum'>
                                    </div>
                                    <div class="col">
                                      <u>Deffect Depth</u><br><br> 
                                      <input type='text' step='any'  class='form-control ctq_rejected' id='ctq_depth_<?= $value["id"]; ?>' placeholder='Depth'>
                                    </div>
                                    <div class="col">
                                      <u>Affected Welder</u><br><br> 
                                      <?php 
                                        $summary_welder_rh = explode(';', $value['welder_ref_rh']);
                                        $summary_welder_fc = explode(';', $value['welder_ref_fc']); 
                                        $welders           = array_unique(array_merge($summary_welder_rh, $summary_welder_fc));
                                      ?>
                                      <select class='form-control welder_<?= $key ?> select2s' name="welder[]" id='welder_<?= $value["id"]; ?>' multiplex>
                                        <option>---</option>
                                        <?php foreach ($welder_list as $key_welder_list => $value_welder_list) { ?>
                                          <?php if(in_array($value_welder_list['id_welder'], $welders)){ ?>
                                            <option value="<?= $value_welder_list['id_welder'] ?>"><?= $value_welder_list['welder_code'].' / '.$value_welder_list['rwe_code'] ?></option>
                                          <?php } ?>
                                        <?php } unset($welders) ?>
                                      </select>
                                    </div>
                                    <div class="col">
                                      <u>Planarity</u><br><br> 
                                      <select id='planarity_<?= $value["id"]; ?>' class="form-control planarity_<?= $value["id"]; ?>">
                                        <option value="0">Non-Planar</option>
                                        <option value="1">Planar</option>
                                      </select>
                                    </div>
                                    <div class="input-group-prepend">
                                      <button type="button" class='btn btn-warning btn_<?= $value["id"] ?> <?= $this->user_cookie[7]==8 ? 'd-none' : '' ?>' onclick="add_ctq_in_process('<?= $value["id"] ?>')"><i class="fas fa-save"></i></button>
                                      <script type="text/javascript">
                                        function add_ctq_in_process(id_detail){

                                          var val_ctq_id_detail     = "ctq_id_"+id_detail;
                                          var val_ctq_length_detail = "ctq_length_"+id_detail;
                                          var val_ctq_datum_detail = "ctq_datum_"+id_detail;
                                          var val_ctq_depth_detail = "ctq_depth_"+id_detail;
                                          var val_ctq_wel = "welder_"+id_detail;
                                          var val_ctq_planar = "planarity_"+id_detail;

                                          var val_id_detail      = id_detail;
                                          var val_ctq_id         = $('#'+val_ctq_id_detail).val();
                                          var val_ndt_type       = '<?= $initial; ?>'; 
                                          var val_repair_length  = $('input[id='+val_ctq_length_detail+']').val();
                                          var val_repair_datum  = $('input[id='+val_ctq_datum_detail+']').val();
                                          var val_repair_depth  = $('input[id='+val_ctq_depth_detail+']').val();

                                          var val_welder         = $('#'+val_ctq_wel).val();
                                          var val_planar         = $('.'+val_ctq_planar).val();

                                          console.log(val_ctq_planar);
                                          console.log(val_ctq_wel);
                                          console.log(val_planar);
                                          console.log(val_welder);

                                          if(val_repair_length > 0 && val_ctq_id > 0){

                                            $.ajax({
                                                url: "<?php echo base_url();?>ndt/add_ctq_process",
                                                type: "post",
                                                data: {
                                                  ndt_type: val_ndt_type,
                                                  id_detail: val_id_detail,
                                                  ctq_id: val_ctq_id,
                                                  welder: val_welder,
                                                  repair_length: val_repair_length,
                                                  datum: val_repair_datum,
                                                  depth: val_repair_depth,
                                                  planarity_status : val_planar,
                                                  submission_id : '<?= $list[0]['submission_id'] ?>',
                                                  report_number: '<?= $list[0]['report_number'] ?>'
                                                },
                                                success: function(data) { 
                                                    Swal.fire(
                                                        'Success',
                                                        'Your data has been Updated!',
                                                        'success'
                                                    );
                                                    location.reload();                  
                                                }
                                            });

                                          } else {
                                            Swal.fire(
                                                'Warning',
                                                'Please Choice CTQ & Fill Up Rejected Length',
                                                'warning'
                                            );
                                          }
                                             
                                        }
                                      </script>
                                    </div>
                                  </div>
                                <?php                            
                                  if(sizeof($data_ctq_db) > 0){
                                    echo "<hr><table width='100%' class='table-bordered'>
                                        <thead>
                                          <th class='bg-info text-white'>Deffect Type</th>
                                          <th class='bg-info text-white'>Deffect Length</th>
                                          <th class='bg-info text-white'>Distance from Datum</th>
                                          <th class='bg-info text-white'>Deffect Depth</th>
                                          <th class='bg-info text-white'>Affected Welder</th>
                                          <th class='bg-info text-white'>Planarity</th>
                                          <th class='bg-info text-white'> </th>
                                        </thead>
                                        <tbody>";
                                    foreach ($data_ctq_db as $data_ctq) {
                                      if($data_ctq['ndt_id']==$value['id'])
                                      {
                                        $tested_length_arr[$value['id']][] = $data_ctq['length'];

                                        $welders = explode(';', $data_ctq['welder']);
                                        foreach ($welders as $key_welders => $value_welders) {
                                          $arr_welders[] = $weld_name[$value_welders];
                                        }
                                       echo "
                                          <tr>
                                            <td>".$ctq_description[$data_ctq['ctq_id']]."( ".$ctq_initial[$data_ctq['ctq_id']]." )</td>
                                            <td>".$data_ctq['length']." MM</td>
                                            <td>".$data_ctq['datum']." MM</td>
                                            <td>".$data_ctq['depth']." MM</td>
                                            <td>".(isset($data_ctq['welder']) ?  implode(', ', $arr_welders) :  "-").'</td>
                                            <td>'.($data_ctq['planarity']==1 ? 'Planar' : 'Non-Planar')."</td><td>"
                                            ;?>
                                            <button class="btn btn-danger" type="button" onclick='delete_ctq_data("<?= $data_ctq['id'] ?>")'><i class="fa fa-trash"></i></button><?php echo "</td>
                                          </tr>";
                                      }
                                      unset($welders);
                                      unset($arr_welders);
                                    } 

                                    echo "<tbody></table>";                                  
                                  }
                                ?>  
                                <input type="hidden" name="anu_<?= $value['id'] ?>" class="anu_<?= $value['id'] ?>" value="<?= array_sum($tested_length_arr[$value['id']]) ?>">
                                <style type="text/css">
                                  .bg-warning-alert {
                                    background-color: #fff3cd !important;
                                  }
                                </style>
                                <script type="text/javascript">
                                  function check_length(kunci){
                                    var length = Number($('#ctq_length_'+kunci).val())
                                    var length_bef = Number($('.anu_'+kunci).val())
                                    var tested_length = Number($('.tested_length_id_'+kunci).val())
                                    length_total = length + length_bef
                                    if(length_total>tested_length){
                                      // $('.tr_'+kunci).addClass('bg-warning-alert')
                                      // $('.btn_'+kunci).addClass('d-none')
                                    } else {
                                      // $('.tr_'+kunci).removeClass('bg-warning-alert')
                                      // $('.btn_'+kunci).removeClass('d-none')
                                    }
                                  }

                                  $(document).ready(
                                    function (){
                                      $('.select2').select2({
                                        theme: 'bootstrap'
                                      });
                                    }
                                  )
                                  function welder_autocomplete(no){
                                    $('.welder_'+no).autocomplete({
                                      source: function(request,response){
                                        $.post('<?php echo base_url(); ?>ndt/welder_autocomplete',{term: request.term}, response, 'json');
                                      },
                                      autoFocus: true,
                                      classes: {
                                        "ui-autocomplete": "highlight"
                                      }
                                    });
                                  }

                                  function delete_ctq_data(id){
                                    Swal.fire({
                                        title: 'Are you sure to <b class="text-warning">&nbsp;Delete&nbsp;</b> this?',
                                        text: "This item will permanent deleted!",
                                        type: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Yes, Delete it!'
                                      }).then((result) => {
                                        if (result.value) {
                                          $.ajax({
                                            url: "<?php echo base_url();?>ndt/delete_ctq_data",
                                            type: "post",
                                            data: {
                                              id: id,
                                            },
                                            success: function(data) {
                                            
                                                Swal.fire(
                                                  'Success',
                                                  'Your data has been Updated!',
                                                  'success'
                                                );                
                                                location.reload();
                                            }
                                          });
                                        }
                                      })

                                  }
                                </script> 
                              <?php } else { ?>   
                                -
                              <?php } ?>                      
                              </td>

                              <td>
                                <div class="input-group-prepend">
                                  <textarea class="form-control remarks_<?= $key ?>" name="remarks"><?= $value['remarks'] ?></textarea>
                                  <span class="btn btn-warning <?= $this->user_cookie[7]==8 ? 'd-none' : '' ?>" style="width: 40px !important;height: 40px !important" onclick="saveRemarks('<?= $key ?>')"><i class="fas fa-save"></i></span>
                                  <script type="text/javascript">
                                    function saveRemarks(kunci){
                                      var remarks = $('.remarks_'+kunci).val()
                                      var id     = $('.id_ndt_'+kunci).val()

                                      $.ajax({
                                        url: "<?php echo base_url();?>ndt/update_remarks",
                                        type: "post",
                                        data: {
                                          remarks: remarks,
                                          id: id,
                                        },
                                        success: function(data) { 
                                          Swal.fire(
                                            'Success',
                                            'Your data has been Updated!',
                                            'success'
                                          );
                                          // location.reload();                  
                                        }
                                      });
                                    }
                                  </script>
                                </div>   
                              </td>
                              <td>
                                <?php if($value['result']==3){ ?>
                                  <button class="btn btn-danger <?= $this->user_cookie[7]==8 ? 'd-none' : '' ?>" onclick="delete_joint_on_dtail('<?= $value["id"] ?>','<?= $value["submission_id"] ?>')">
                                    <i class="fas fa-trash "></i>
                                     Joint
                                  </button>
                                <?php } ?>
                              </td>
                              <script type="text/javascript">
                                function delete_joint_on_dtail(id,uniq_data){
                                  console.log(id)
                                  console.log(uniq_data)
                                  Swal.fire({
                                      title: 'Are you sure to <b class="text-warning">&nbsp;Delete&nbsp;</b> this?',
                                      text: "This Attachment will permanent deleted!",
                                      type: 'warning',
                                      showCancelButton: true,
                                      confirmButtonColor: '#3085d6',
                                      cancelButtonColor: '#d33',
                                      confirmButtonText: 'Yes, Delete it!'
                                    }).then((result) => {
                                      if (result.value) {
                                        $.ajax({
                                          url: "<?php echo base_url();?>ndt/remove_joint_from_report",
                                          type: "post",
                                          data: {
                                            id: id,
                                            submission_id: uniq_data,
                                          },
                                          success: function(data) {
                                          if(data.includes("Error")){
                                             Swal.fire(
                                                'Ops..',
                                                data,
                                                'error'
                                              );
                                          } else {
                                              Swal.fire(
                                                'Success',
                                                'Your data has been Updated!',
                                                'success'
                                              );
                                              location.reload();
                                            }
                                          }
                                        });
                                      }
                                    })
                                }
                              </script>
                            </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      </div>

                      <div class="text-right <?= $this->permission_cookie[128]==1 ? '' : 'd-none' ?>">
                        <br>

                        <badge name="submit_visual" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal2"><i class="fas fa-check"></i> Closing Update</badge>

                        <button class="btn btn-primary" data-toggle="modal" data-target="#rerequestModal">
                          <i class="fas fa-plus"></i>
                           Re-Request Joint
                        </button>
                      </div>

                    </div>
                  </div>
                  </div>

                  <div id="menu1" class="container tab-pane col-md-12 fade"><br>
                  <div class="col-md-12">

                        <form action="<?php echo base_url('ndt/upload_new_attachment/').$ndt_code;?>" method="post" enctype="multipart/form-data">
                          <div class="row">
                            <div class="col-md">
                              <div class="form-group">
                                <label>Remarks Data :</label>
                                <textarea name='remarks' class='form-control' required=""></textarea>
                                <input type="hidden" class="form-control" name="submission_id" id="uniq_data" value="<?= $list[0]['submission_id'] ?>" autocomplete="off" readonly>
                                <input type="hidden" class="form-control" name="report_number" id="uniq_data" value="<?= $list[0]['report_number'] ?>" autocomplete="off" readonly>
                              </div>
                            </div>
                           </div>
                           <div class="row"> 
                          <div class="col-md">
                            <div class="form-group">
                              <label>Select File to upload :</label>
                              <input type="file" name="file_attachment" id="file_attachment" required="">
                            </div>                    
                          </div>
                          </div>
                          <input type="submit" value="Upload File" name="submit" class='btn btn-secondary'>
                        </form>

                        <h6 class="mt-3 px-3 py-3 mb-0 bg-success text-white">
                        <button class="btn attachment_minimize text-white" type="button"><i class="fa fa-minus"></i></button>
                          Drawing Number : <span><?= $drawing_no ?></span>
                        </h6>
                      <div class="col-md-12">
                        <table class="table text-muted">
                          <thead>
                            <tr>
                              <th>ATTACHMENT</th>
                              <th>UPLOAD BY</th>
                              <th>UPLOAD DATE</th>
                              <th>REMARKS</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>

                              <?php foreach ($data_attachment as  $value){ ?>
                                <tr>  
                                <td>
                                  <!-- <a href='http://<?= $ftpsrc[0]["destination_source"] ?>/upload/ndt/<?= $name_process ?>/<?php echo $value["attachment_filename"] ?>'><?php echo $value["attachment_filename"] ?></a> -->
                                  <a href="<?= base_url('upload/ndt/').$value["filename"] ?>"><?php echo $value["filename"] ?></a>
                                </td>
                                <td><?php echo $user_list[$value["created_by"]]['full_name'] ?></td>
                                <td><?php echo $value["created_date"] ?></td>
                                <td><?php echo $value["remarks"] ?></td>
                                <td><button class="btn btn-danger" type="button" onclick="delete_attachment_on_update('<?= $value["id"] ; ?>','<?= $value["uniq_data"]; ?>')"><i class="fa fa-trash"></i></button></td>
                                </tr>
                              <?php } ?>
                              <script type="text/javascript">
                                function delete_attachment_on_update(id,uniq_data){
                                  Swal.fire({
                                      title: 'Are you sure to <b class="text-warning">&nbsp;Delete&nbsp;</b> this?',
                                      text: "This Attachment will permanent deleted!",
                                      type: 'warning',
                                      showCancelButton: true,
                                      confirmButtonColor: '#3085d6',
                                      cancelButtonColor: '#d33',
                                      confirmButtonText: 'Yes, Delete it!'
                                    }).then((result) => {
                                      if (result.value) {
                                        $.ajax({
                                          url: "<?php echo base_url();?>ndt/delete_attachment",
                                          type: "post",
                                          data: {
                                            ndt : '<?= $initial ?>',
                                            id: id,
                                            uniq_data: uniq_data,
                                          },
                                          success: function(data) {
                                          if(data.includes("Error")){
                                             Swal.fire(
                                                'Ops..',
                                                data,
                                                'error'
                                              );
                                          } else {
                                              Swal.fire(
                                                'Success',
                                                'Your data has been Updated!',
                                                'success'
                                              );
                                              location.reload();
                                            }
                                          }
                                        });
                                      }
                                    })
                                }
                              </script>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <br>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div><!-- ini div dari sidebar yang class wrapper -->

<!-- Button trigger modal -->

<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModal2Label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModal2Label">Closing - Request for Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" action="<?php echo base_url('ndt/closing_request_for_update') ?>">
        <input type="hidden" name="submission_id" value="<?= $revision['submission_id'] ?>">
        <input type="hidden" name="id" value="<?= $revision['id'] ?>">
        <input type="hidden" name="status_revise" value="3">
        <h4 class="text-center">
          Proceed to Closing Request
        </h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="rerequestModal" tabindex="-1" role="dialog" aria-labelledby="rerequestModalLabel" aria-hidden="true">
  <form action="<?= base_url('ndt/copy_new_data') ?>" method="POST">
    <input type="hidden" name="ndt_report_number" class="form-control" value="<?= $list[0]['report_number'] ?>" required>
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="rerequestModalLabel">Re-Request List</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="row"> 
            <div class="col-md-12 mt-2">
              <div class="form-group row">
                <label for="" class="col-xl-3 col-form-label text-muted">Vendor</label>
                <div class="col-xl">
                  <select name="vendor" class="select2" style="width: 100%" required>
                    <option value="">---</option>
                    <?php foreach ($vendor as $value_vendor) {?>
                      <option value="<?= $value_vendor['id_company'] ?>"><?= $value_vendor['company_name'] ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-12"></div>
            <div class="col-md-12 mt-2">
              <div class="form-group row">
                <label for="" class="col-xl-3 col-form-label text-muted">Inspector Name</label>
                <div class="col-xl">
                  <select name="inspector_id" class="select2" style="width: 100%" required>
                    <option value="">---</option>
                    <?php foreach ($user_list as $key => $value): ?>
                    <option value="<?= $value['id_user'] ?>"><?= $value['full_name'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-12"></div>
            <div class="col-md-12">
              <div class="form-group row">
                <label for="" class="col-xl-3 col-form-label text-muted">Inspect Date</label>
                <div class="col-xl">
                  <input type="date" name="inspect_date" class="form-control" value="<?= date('Y-m-d') ?>" required>
                </div>
              </div>
            </div>
            <div class="col-md-12"></div>
            <div class="col-md-12">
              <div class="form-group row">
                <label for="" class="col-xl-3 col-form-label text-muted">Inspect Time</label>
                <div class="col-xl">
                  <input type="time" name="inspect_time" class="form-control" value="<?= date('H:i:s') ?>" required>
                </div>
              </div>
            </div>
            <div class="col-md-12"></div>
              <div class="col-md-12">
                <div class="form-group row">
                  <label for="" class="col-xl-3 col-form-label text-muted">Notes</label>
                  <div class="col-xl">
                    <textarea class="form-control" name="note"></textarea>
                  </div>
                </div>
              </div>
          </div>
          <hr>
          <table class="table table_modal">
            <thead class="bg-green-smoe text-white">
              <tr>
                <th>Joint No.</th>
                <th>Drawing No.</th>
                <th>Drawing Weld Map</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($list as $key_rere => $value_rere) {?>
                <tr class="text-center">
                  <td class="font-weight-bold">
                    <?= $value_rere['joint_no'].($value_rere['revision']>0 ? '('.$value_rere['revision_category'].$value_rere['revision'].')' : '') ?>    
                  </td>
                  <td><?= $value_rere['drawing_no'] ?></td>
                  <td><?= $value_rere['drawing_wm'] ?></td>
                  
                  <td>
                    <input type="checkbox" name="choosen[<?= $key_rere ?>]" class="form-control" value="1">
                    <input type="hidden" name="id[<?= $key_rere ?>]" value="<?= $value_rere['id'] ?>">

                    <input type="hidden" name="ndt_type" class="form-control" value="<?= $value_rere['ndt_type'] ?>">
                    <input type="hidden" name="discipline" class="form-control" value="<?= $value_rere['discipline'] ?>">
                    <input type="hidden" name="module" class="form-control" value="<?= $value_rere['module'] ?>">
                    <input type="hidden" name="type_of_module" class="form-control" value="<?= $value_rere['type_of_module'] ?>">
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </form>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form action="<?= base_url('ndt/add_detail') ?>" method="POST">
    <input type="hidden" name="ndt_report_number" class="form-control" value="<?= $list[0]['report_number'] ?>" required>
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Joint List</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="table table_modal">
            <thead class="bg-green-smoe text-white">
              <tr>
                <th>Drawing No.</th>
                <th>Drawing Weld Map</th>
                <th>Joint No.</th>
                <th>Result</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($ready_list as $key => $valueh) {?>
                <tr>
                  <td><?= $valueh['drawing_no'] ?></td>
                  <td><?= $valueh['drawing_wm'] ?></td>
                  <td>
                    <?= $valueh['joint_no'].($valueh['revision']>0 ? '('.$valueh['revision_category'].$valueh['revision'].')' : '') ?>    
                  </td>
                  <td>
                    <div class="form-check form-check-inline">
                      <label class="form-check-label text-success font-weight-bold">
                        <input class="form-check-input approve" type="radio" title="Approve" name="result[<?= $key ?>]" value="3" style="width: 17px; height: 17px"  onclick="repair_length('disable',<?= $key ?>)"> Approved</label>
                    </div>
                    <br>
                    <div class="form-check form-check-inline">
                      <label class="form-check-label text-danger font-weight-bold"><input class="form-check-input reject" type="radio" title="Reject" name="result[<?= $key ?>]" value="2" style="width: 17px; height: 17px"  onclick="repair_length('enable',<?= $key ?>)"> Rejected</label>
                    </div>
                  </td>
                  <td>
                    <input type="checkbox" name="choosen[<?= $key ?>]" class="form-control" value="1">
                    <input type="hidden" name="id[<?= $key ?>]" value="<?= $valueh['id'] ?>">

                    <input type="hidden" name="initial" class="form-control" value="<?= $initial ?>">
                    <input type="hidden" name="drawing_no" class="form-control" value="<?= $valueh['drawing_no'] ?>">
                    <input type="hidden" name="pwht_status" value="<?= $list[0]['pwht_status'] ?>">
                    <input type="hidden" name="date_of_inspection" value="<?= $list[0]['date_of_inspection'] ?>">
                    <input type="hidden" name="submission_id" value="<?= $list[0]['submission_id'] ?>">
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </form>
</div>

<script type="text/javascript">
  function checkTotalLength(thiss, ndt_type, id_visual, now_length){
    console.log(now_length)
    $.ajax({
      url: "<?php echo base_url() ?>ndt/checkTotalLength",
      type: "post",
      dataType: "json",
      data: {
        ndt_type: ndt_type,
        id_visual: id_visual,
      },
      success: function(data) {
        console.log(data.tested_length_inserted)
        $(thiss).attr({
          "max" : parseInt(data.tested_length_inserted)+parseInt(now_length),        // substitute your own
          // "min" : 1          // values (or variables) here
        });
      }
    });
  }
  $('.table_modal').DataTable({

  });
</script>