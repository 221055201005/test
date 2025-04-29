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
                    <input type="text" name="ndt_report_number" class="form-control" value="<?= $list[0]['report_number'] ?>" required readonly>
                  </div>
                </div>
              </div>

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
                      <!-- <div class="col-md-12"> -->
                      <div class="col-md-12 table-responsive">

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
                                  <input type="number" name='tested_length' class="form-control tested_length_<?= $key ?> tested_length_id_<?= $value['id'] ?>" value="<?= $value['tested_length'] ?>" max="<?= $value['length_of_weld'] ?>" onkeyup="checkTotalLength(this, '<?= $value['ndt_type'] ?>', '<?= $value['id_visual'] ?>', '<?= $value['tested_length'] ?>')" readonly>

                                  <input type="hidden" name='id_ndt' class="form-control id_ndt_<?= $key ?>" value="<?= $value['id'] ?>">
                                  <span class="btn btn-warning <?= $this->user_cookie[7]==8 ? 'd-none' : '' ?> d-none" onclick="saveTestedLength('<?= $key ?>')" ><i class="fas fa-save"></i></span>
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
                                    <input type="number" name='reject_length_rh' class="form-control reject_length_rh_<?= $key ?> reject_length_rh_id_<?= $value['id'] ?>" value="<?= $value['reject_length_rh'] ?>" readonly>
                                    <input type="hidden" name='id_ndt' class="form-control id_ndt_<?= $key ?>" value="<?= $value['id'] ?>">
                                    <span class="btn btn-warning <?= $this->user_cookie[7]==8 ? 'd-none' : '' ?> d-none" onclick="saveRejectLengthRH('<?= $key ?>')"><i class="fas fa-save"></i></span>
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
                                    <input type="number" name='reject_length_fc' class="form-control reject_length_fc_<?= $key ?> reject_length_fc_id_<?= $value['id'] ?>" value="<?= $value['reject_length_fc'] ?>" readonly>
                                    <input type="hidden" name='id_ndt' class="form-control id_ndt_<?= $key ?>" value="<?= $value['id'] ?>">
                                    <span class="btn btn-warning <?= $this->user_cookie[7]==8 ? 'd-none' : '' ?> d-none" onclick="saveRejectLengthFC('<?= $key ?>')"><i class="fas fa-save"></i></span>
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
                                <?php                            
                                  if(sizeof($data_ctq_db) > 0){
                                    echo "<table width='100%' class='table-bordered'>
                                        <thead>
                                          <th class='bg-info text-white'>Deffect Type</th>
                                          <th class='bg-info text-white'>Deffect Length</th>
                                          <th class='bg-info text-white'>Distance from Datum</th>
                                          <th class='bg-info text-white'>Deffect Depth</th>
                                          <th class='bg-info text-white'>Affected Welder</th>
                                          <th class='bg-info text-white'>Planarity</th>
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
                                            <td>'.($data_ctq['planarity']==1 ? 'Planar' : 'Non-Planar')."</td><td class='d-none'>"
                                            ;?>
                                            <button class="btn btn-danger d-none" type="button" onclick='delete_ctq_data("<?= $data_ctq['id'] ?>")'><i class="fa fa-trash"></i></button><?php echo "</td>
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
                              <?php } else { ?>   
                                -
                              <?php } ?>                      
                              </td>

                              <td>
                                <?= $value['remarks'] ?>  
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

                      <div class="<?= $revision['status_revise']==3 ? '' : 'd-none' ?>">
                        <br>
                        <badge class="btn btn-success" onclick="approve_request('<?= $revision['submission_id'] ?>', 'approve', '<?= $revision['id'] ?>')">
                          <i class="fas fa-check"></i> Approve
                        </badge>
                        <badge class="btn btn-danger" onclick="approve_request('<?= $revision['submission_id'] ?>', 'rejected', '<?= $revision['id'] ?>')">
                          <i class="fas fa-times"></i> Reject
                        </badge>
                      </div>

                    </div>
                    <!-- </div> -->
                  </div>

                  <div id="menu1" class="container tab-pane col-md-12 fade"><br>
                    <div class="col-md-12">
                      <div class="col-md-12">
                        <table class="table text-muted">
                          <thead>
                            <tr>
                              <th>ATTACHMENT</th>
                              <th>UPLOAD BY</th>
                              <th>UPLOAD DATE</th>
                              <th>REMARKS</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php foreach ($data_attachment as  $value){ ?>
                            <tr>  
                              <td>
                                <a href="<?= base_url('upload/ndt/').$value["filename"] ?>"><?php echo $value["filename"] ?></a>
                              </td>
                              <td><?php echo $user_list[$value["created_by"]]['full_name'] ?></td>
                              <td><?php echo $value["created_date"] ?></td>
                              <td><?php echo $value["remarks"] ?></td>
                            </tr>
                          <?php } ?>
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
</div>

<script type="text/javascript">

  function approve_request(submission_id, aksi, id){

    // 1 Approve, 2 Reject, 3 Reapproval/Closed

    if(aksi=='approve'){
      var kalimat = 'Are you sure to Approved this Update ?!'
      var status_revise = 4
    } else {
      var kalimat = 'Are you sure to Declined this Update ?!'
      var status_revise = 1
    }

    Swal.fire({
      title: kalimat,
      text: "This Data will Return to Approved for Update!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Update this data!'
    }).then((result) => {

      if (result.value) {
        $.ajax({
          url: "<?= base_url('ndt/approve_request/') ?>",
          type: "post",
          data: {
            'submission_id' : submission_id,
            'status_revise' : status_revise,
            'id'            : id,
          },
          success: function(data){
            Swal.fire(
              'Data Has Been Updated !',
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