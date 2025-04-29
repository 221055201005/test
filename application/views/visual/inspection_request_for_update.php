<div id="content" class="container-fluid">
  <?php error_reporting(0); 
    // test_var($reapproval);
  ?>

  <form method="POST" action="<?= base_url('visual/reapproval_inspection_request_for_update') ?>" autocomplete="off" enctype="multipart/form-data">
    <div class="row">
      <style type="text/css">
        .disabled-effect {
          pointer-events: none;
          opacity:0.5;
        }
      </style>
      <input type="hidden" name="approval_code_log" value="VISUAL/<?= $project_data_portal[0]["project_name"] ?>/<?= $report_number ?>/">
      <div class="col-md-12">
        <div class="my-3 p-3 bg-white rounded shadow-sm">
          <h6 class="pb-2 mb-0"><?= $meta_title ?></h6>
          <div class="overflow-auto media text-muted pt-3 mt-1 border-top border-gray">
            <div class="container-fluid">

              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>Drawing Number</label>
                    <input type="text" class="form-control" name="drawing_no_for_view" value="<?= $inspection_detail[0]['drawing_no'] ?>" required="" oninput="checkdraw(this)" readonly>
                    <input type="hidden" class="form-control" name="report_number_view" value="<?= $inspection_detail[0]['report_number'] ?>" required="" oninput="checkdraw(this)" readonly>

                  </div>
                </div>
                 <div class="col-md">
                  <div class="form-group">
                    <label><?= $enable_modify=='client' ? 'Report No.' : 'Submission No.' ?></label>
                    <input type="text" class="form-control" name="batch_no_only_view" value="<?= $enable_modify=='client' ? strtoupper('SOF-OCP-SMO-'.$master_type_of_module[$inspection_detail[0]['type_of_module']]['code'].'-'.$master_discipline[$inspection_detail[0]['discipline']]['initial'].'-VIS-'.$inspection_detail[0]['report_number']) : $inspection_detail[0]['submission_id'] ?>" readonly required="">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>Requestor</label>
                    <input type="text" class="form-control" name="requestor" value="<?= $user_list[$inspection_detail[0]['requestor']]['full_name'] ?>" disabled="" required="">
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>Requestor Company</label>
                    <input type="text" class="form-control" name="requestor_company" value="<?= $inspection_detail[0]['company'] ?>" required="" disabled="">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>Discipline</label>
                    <input type="text" class="form-control" name="discipline_name" value="<?= $master_discipline[$inspection_detail[0]['discipline']]['discipline_name'] ?>" disabled="" required="">
                    <input type="hidden" class="form-control" name="discipline" disabled="" value="2" required="">
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>Module</label>
                    <input type="text" class="form-control" name="mod_id_name" value="<?= $master_module[$inspection_detail[0]['module']]['mod_desc'] ?>" disabled="" required="">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>Date of Offer</label>
                    <input type="date" class="form-control" name="date_of_offer" required="" value="<?= DATE('Y-m-d', strtotime($inspection_detail[0]['date_request'])) ?>" disabled>
                  </div>
                </div>
                <div class="col-md">
                </div>
              </div>

              <hr>

              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>Area</label>
                    <select class="form-control select2 input_area" name="area_main" <?= $user_permission[40]==1 ? '' : 'disabled' ?>>
                    <?php if($inspection_detail[0]['area_v2']!=''){ ?>
                      <?php foreach ($master_area_v2 as $key => $value_area) { ?>
                        <option value="<?= $value_area['id'] ?>" <?= $inspection_detail[0]['area_v2']==$value_area['id'] ? 'selected' : '' ?>><?= $value_area['name'] ?></option>
                      <?php } ?>
                    <?php } else { ?>
                    <?php foreach ($master_area as $key => $value_area) { ?>
                      <option value="<?= $value_area['id'] ?>" <?= $inspection_detail[0]['area']==$value_area['id'] ? 'selected' : '' ?>><?= $value_area['area_name'] ?></option>
                    <?php }} ?>
                    </select>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>Location</label>
                    <select class="form-control select2 input_location" name="location_main" <?= $user_permission[40]==1 ? '' : 'disabled' ?>>
                    <?php if($inspection_detail[0]['location_v2']!=''){ ?>
                      <?php foreach ($master_location_v2 as $key => $value_location) { ?>
                        <option value="<?= $value_location['id'] ?>" <?= $inspection_detail[0]['location_v2']==$value_location['id'] ? 'selected' : '' ?> data-chained="<?php echo $value_location['id_area'] ?>"><?= $value_location['name'] ?></option>
                      <?php } ?>
                    <?php } else { ?>
                    <?php foreach ($master_location as $key => $value_location) { ?>
                      <option value="<?= $value_location['id'] ?>" <?= $inspection_detail[0]['location']==$value_location['id'] ? 'selected' : '' ?>><?= $value_location['location_name'] ?></option>
                    <?php }} ?>
                    </select>

                    <input type="hidden" name="submission_id_data" value="<?= $inspection_detail[0]['submission_id'] ?>">
                    
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <label>Point</label>
                  <select class="form-control select2 input_point" name="point_main" <?= $user_permission[40]==1 ? '' : 'disabled' ?>>
                    <?php foreach ($master_point_v2 as $key => $value_point) { ?>
                      <option value="<?= $value_point['id'] ?>" <?= $inspection_detail[0]['point_v2']==$value_point['id'] ? 'selected' : '' ?> data-chained="<?php echo $value_point['id_location'] ?>"><?= $value_point['name'] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col-md" style="text-align: right !important; vertical-align: text-bottom !important;">
                  <span class="btn btn-warning" style="vertical-align: bottom !important;" onclick="changeLocation()">
                    <i class="fas fa-edit"></i> Update Location
                  </span>
                </div>
                <script type="text/javascript">
                  $("select[name=location_main]").chained("select[name=area_main]");
                  $("select[name=point_main]").chained("select[name=location_main]");
                  function changeLocation(){
                    const location = $('.input_location').val();
                    const area = $('.input_area').val()
                    const point = $('.input_point').val()
                    <?php if($enable_modify=='client'){ ?>
                      const identifier = 'report_number';
                      const where = '<?= $inspection_detail[0]['report_number'] ?>';
                    <?php } else { ?>
                      const identifier = 'submission_id';
                      const where = '<?= $inspection_detail[0]['submission_id'] ?>';
                    <?php } ?>

                    $.ajax({
                      url: "<?= base_url('visual/change_area_2/') ?>",
                      type: "post",
                      data: {
                        area        : area,
                        location    : location,
                        point       : point,
                        identifier  : identifier,
                        where       : where,
                      },
                      success: function(data){
                        Swal.fire(
                          'Data Has Been Updated !',
                          '',
                          'success'
                        ).then(function() {
                          return false;
                        });
                      }
                    });
                  }
                </script>
              </div>

            </div>
          <div class="fl-scrolls fl-scrolls-hidden" data-orientation="horizontal" style="width: 1564px; left: 286px;"><div style="width: 1564px;"></div></div></div>
        </div>
      </div>
    </div>

    <!-- DISINI STAR FOREACH -->
    <?php foreach ($inspection_detail as $key => $value) {?>
    <?php  
      $arr_stat_client[] = $value['status_inspection'];
      if(in_array(5, $arr_stat_client)){
        $button_save_client = '';
      } else {
        $button_save_client = 'd-none';
      }
      // if($value['status_inspection']==6 OR $value['status_inspection']==7){
      //   $button_save_client = 'd-none';
      // } else {
      //   $button_save_client = '';
      // }

      $arr_stat_qc[] = $value['status_inspection'];
      if(in_array(1, $arr_stat_qc)){
        $button_save_qc = '';
      } else {
        $button_save_qc = 'd-none';
      }
      // if($value['status_inspection']>1){
      //   $button_save_qc = 'd-none';
      // } else {
      //   $button_save_qc = '';
      // }
    ?>
    <div class="row" name="">
      <div class="col-md-12">
        <div class="bg-white rounded shadow-sm">
          <a data-toggle="collapse" href="#collapseExample<?= $key ?>" role="button" aria-expanded="false" aria-controls="collapseExample">
            <h6 class="mt-3 px-3 py-3 mb-0 bg-success text-white">Drawing WM : <b><?= $joint_list[$value['id_joint']]['drawing_wm'].' ('.$joint_list[$value['id_joint']]['joint_no'].')' ?></b></h6>
          </a>
          <?php if(($enable_modify=='client' AND $value['status_inspection']==5) OR $enable_modify!='client' OR $reoffer=='reoffer'){ ?>
          <input type="hidden" name="id[<?= $key ?>]" value="<?= $value['id_visual'] ?>">
          <?php if($reoffer=='reoffer'){ ?>
            <input type="hidden" name="is_reoffer" value="1">
            <input type="hidden" name="isDetailReoffer" value="<?= $isDetailReoffer ?>">
          <?php } ?>
          <input type="hidden" name="revision_status_inspection[<?= $key ?>]" value="<?= $value['revision_status_inspection'] ?>">
          <?php } ?>
          <div class=" media text-muted pt-3 mx-3 border-top border-bottom border-gray" id="collapseExample<?= $key ?>" style="margin-bottom: 0cm">
            <div class="container-fluid card card-body">
              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>Weld Map Drawing No</label>
                    <input type="text" class="form-control" name="weldmap_no[1]" value="<?= $joint_list[$value['id_joint']]['drawing_wm'] ?>" disabled>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>Joint No</label>
                    <input type="text" class="form-control" name="joint_no[1]" value="<?= $joint_list[$value['id_joint']]['joint_no'].($value['revision']>0 ? (' ('.$value['revision_category'].$value['revision'].')') : '') ?>" disabled>
                      <?php if(strlen($image_visual[$value['id_joint']])>1){ ?>
                        <span class="btn btn-info" onclick="setSrc_surve('<?= $image_visual[$value['id_joint']] ?>')"><i class="fas fa-camera"></i></span>
                        <br/>
                        <script type="text/javascript">
                          function setSrc_surve(src){
                            console.log(src)
                            $('.src').attr("src", "https://www.smoebatam.com/pcms_v2_photo/"+src);
                            $('#preview_surv').modal('show'); 
                          }
                        </script>
                        <div class="modal fade" id="preview_surv" tabindex="-1" role="dialog" aria-labelledby="previewLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="previewLabel">Images Preview</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <img src="https://www.smoebatam.com/pcms_v2_photo/fab_img/<?= $value_att_c['filename'] ?>" class="src" style="width: 100% !important">
                              </div>
                              <div class="modal-footer">
                                <span type="button" class="btn btn-secondary" data-dismiss="modal">Close</span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- <a href="https://10.5.252.116/pcms_v2_photo/<?= $image_visual[$value['id_joint']] ?>">Images</a> -->
                      <?php } ?>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>PWHT</label>
                    <div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="pwht[<?= $key ?>]" value="1" style="width: 17px; height: 17px" <?= $value['ndt_pwht']==1 ? 'checked' : '' ?> >
                        <label class="form-check-label">Yes</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="pwht[<?= $key ?>]" value="0" style="width: 17px; height: 17px" <?= $value['ndt_pwht']!=1 ? 'checked' : '' ?> >
                        <label class="form-check-label">No</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>Weld Date Time</label>
                    <input type="date" class="form-control revise" name="weld_date[<?= $key ?>]" required="" value="<?= DATE('Y-m-d', strtotime($value['weld_datetime'])) ?>" >
                  </div>
                  <div class="form-group">
                    <label>Consumable / Lot No</label>
                    <input type="text" class="form-control revise" title="1" name="cons_lot_no[<?= $key ?>]" placeholder="Consumable / Lot Number" value="<?= $value['cons_lot_no'] ?>" >
                  </div>   
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>
                      <center>
                        <a class="btn btn-primary" data-toggle="collapse" href="#lastRevision_<?= $value['id_joint'] ?>" role="button" aria-expanded="false" aria-controls="lastRevision_<?= $value['id_joint'] ?>">
                          <strong>
                            <div class="fas fa-history"></div> Last Revision
                          </strong>
                        </a>
                      </center>
                    </label>
                    <div class="collapse" id="lastRevision_<?= $value['id_joint'] ?>">
                    <table class="table dataTable">
                      <thead class="bg-info">
                        <tr>
                          <th>Data</th>
                          <th>Before</th>
                          <th>After</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($template_history[$value['id_joint']] as $key_h => $value_h){?>
                        <tr>
                          <td><?= $value_h['name'] ?></td>
                          <td><?= $value_h['data_before'] ?></td>
                          <td><?= $value_h['data_after'] ?></td>
                          <td><?= 'By '.$user_list[$value_h['created_by']]['full_name'].' on '.DATE('d F, Y H:i a', strtotime($value_h['created_date'])) ?></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">                
                <div class="col-md">
                  <div class="form-group">
                    <label>Length of Weld (MM)</label>
                    <input type="text" class="form-control length_of_weld_1 revise" name="length_of_weld[<?= $key ?>]" value="<?= $value['length_of_weld'] ?>" required="" <?= $value['revision']>0 ? '' : 'readonly' ?>>
                  </div>
                </div>

                <div class="col-md">
                  <div class="form-group">
                    <label>Length (MM)</label>
                    <input type="text" class="form-control" name="lenght[1]" value="<?= $joint_list[$value['id_joint']]['length'] ?>" disabled="">
                  </div>
                </div>
                <div class="col-md">
                </div>
              </div>

              <div class="row">
                 <div class="col-md">
                  <div class="form-group">
                    <label>Thk</label>
                      <input type="text" class="form-control" name="thk[1]" value="<?= number_format($joint_list[$value['id_joint']]['thk'], 2) ?>" required="" disabled="">
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>Dia (mm)</label>
                    <input type="text" class="form-control" name="dia[1]" value="<?= number_format($joint_list[$value['id_joint']]['diameter'], 2) ?>" required="" disabled="">
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>Remark</label>
                    <textarea value="" class="form-control" name="remarkspmt[<?= $key ?>]"><?= $value['remarks'] ?></textarea>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>NDT Requirement</label>

                    <div class="row mx-0">
                      <div class="form-check col-md-4 custom-control custom-checkbox">
                        <input type="checkbox" value="1" name="ndt_mt[<?= $key ?>]" class="custom-control-input" id="customControlAutosizing_mt<?= $key ?>" <?= $value['ndt_mt']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_mt<?= $key ?>">MT</label>
                      </div>
                      <div class="form-check col-md-4 custom-control custom-checkbox">
                        <input type="checkbox" value="1" name="ndt_rt[<?= $key ?>]" class="custom-control-input" id="customControlAutosizing_rt<?= $key ?>" <?= $value['ndt_rt']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_rt<?= $key ?>">RT</label>
                      </div>
                      <div class="form-check col-md-4 custom-control custom-checkbox">
                        <input type="checkbox" value="1" name="ndt_pt[<?= $key ?>]" class="custom-control-input" id="customControlAutosizing_pt<?= $key ?>" <?= $value['ndt_pt']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_pt<?= $key ?>">PT</label>
                      </div>

                      <div class="form-check col-md-4 custom-control custom-checkbox">
                        <input type="checkbox" value="1" name="ndt_ut[<?= $key ?>]" class="custom-control-input" id="customControlAutosizing_ut<?= $key ?>" <?= $value['ndt_ut']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_ut<?= $key ?>">UT</label>
                      </div>
                      <div class="form-check col-md-4 custom-control custom-checkbox">
                        <input type="checkbox" value="1" name="ndt_pa_ut[<?= $key ?>]" class="custom-control-input" <?= $value['ndt_pa_ut']==1 ? 'checked' : '' ?> id="customControlAutosizing_pa_ut<?= $key ?>">
                        <label class="custom-control-label" for="customControlAutosizing_pa_ut<?= $key ?>">PA-UT</label>
                      </div>
                      <div class="form-check col-md-4 custom-control custom-checkbox">
                        <input type="checkbox" value="1" name="ndt_ht[<?= $key ?>]" class="custom-control-input" id="customControlAutosizing_ht<?= $key ?>" <?= $value['ndt_ht']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_ht<?= $key ?>">HT</label>
                      </div>

                      <div class="form-check col-md-4 custom-control custom-checkbox">
                        <input type="checkbox" value="1" name="ndt_ft[<?= $key ?>]" class="custom-control-input" id="customControlAutosizing_ft<?= $key ?>" <?= $value['ndt_ft']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_ft<?= $key ?>">FT</label>
                      </div>
                      <div class="form-check col-md-4 custom-control custom-checkbox">
                        <input type="checkbox" value="1" name="ndt_pmi[<?= $key ?>]" class="custom-control-input" id="customControlAutosizing_pmi<?= $key ?>" <?= $value['ndt_pmi']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_pmi<?= $key ?>">PMI</label>
                      </div>
                    </div>                    
                  </div>
                </div>

                <div class="col-md row">
                  <div class="form-group col-sm">
                    <label>Process RH</label>
                    <div class="row mx-0">
                      <div class="form-check col-md-12 custom-control custom-checkbox">
                        <input type="checkbox" value="1" name="process_1_rh[<?= $key ?>]" class="custom-control-input revise" id="customControlAutosizing_rh_gtaw<?= $key ?>" <?= $value['process_gtaw_rh']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_rh_gtaw<?= $key ?>">GTAW</label>
                      </div>
                      <div class="form-check col-md-12 custom-control custom-checkbox">
                        <input type="checkbox" value="1" name="process_2_rh[<?= $key ?>]" class="custom-control-input revise" id="customControlAutosizing_rh_gmaw<?= $key ?>" <?= $value['process_gmaw_rh']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_rh_gmaw<?= $key ?>">GMAW</label>
                      </div>
                      <div class="form-check col-md-12 custom-control custom-checkbox">
                        <input type="checkbox" value="1" name="process_3_rh[<?= $key ?>]" class="custom-control-input revise" id="customControlAutosizing_rh_smaw<?= $key ?>" <?= $value['process_smaw_rh']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_rh_smaw<?= $key ?>">SMAW</label>
                      </div>
                      <div class="form-check col-md-12 custom-control custom-checkbox">
                        <input type="checkbox" value="1" name="process_4_rh[<?= $key ?>]" class="custom-control-input revise" id="customControlAutosizing_rh_fcaw<?= $key ?>" <?= $value['process_fcaw_rh']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_rh_fcaw<?= $key ?>">FCAW</label>
                      </div>
                      <div class="form-check col-md-12 custom-control custom-checkbox">
                        <input type="checkbox" value="1" name="process_5_rh[<?= $key ?>]" class="custom-control-input revise" id="customControlAutosizing_rh_saw<?= $key ?>" <?= $value['process_saw_rh']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_rh_saw<?= $key ?>">SAW</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-sm">
                    <label>Process FC</label>
                    <div class="row mx-0">
                      <div class="form-check col-md-12 custom-control custom-checkbox">
                        <input type="checkbox" value="1" name="process_1_fc[<?= $key ?>]" class="custom-control-input revise" id="customControlAutosizing_fc_gtaw<?= $key ?>" <?= $value['process_gtaw_fc']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_fc_gtaw<?= $key ?>">GTAW</label>
                      </div>
                      <div class="form-check col-md-12 custom-control custom-checkbox">
                        <input type="checkbox" value="1" name="process_2_fc[<?= $key ?>]" class="custom-control-input revise" id="customControlAutosizing_fc_gmaw<?= $key ?>" <?= $value['process_gmaw_fc']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_fc_gmaw<?= $key ?>">GMAW</label>
                      </div>
                      <div class="form-check col-md-12 custom-control custom-checkbox">
                        <input type="checkbox" value="1" name="process_3_fc[<?= $key ?>]" class="custom-control-input revise" id="customControlAutosizing_fc_smaw<?= $key ?>" <?= $value['process_smaw_fc']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_fc_smaw<?= $key ?>">SMAW</label>
                      </div>
                      <div class="form-check col-md-12 custom-control custom-checkbox">
                        <input type="checkbox" value="1" name="process_4_fc[<?= $key ?>]" class="custom-control-input revise" id="customControlAutosizing_fc_fcaw<?= $key ?>" <?= $value['process_fcaw_fc']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_fc_fcaw<?= $key ?>">FCAW</label>
                      </div>
                      <div class="form-check col-md-12 custom-control custom-checkbox">
                        <input type="checkbox" value="1" name="process_5_fc[<?= $key ?>]" class="custom-control-input revise" id="customControlAutosizing_fc_saw<?= $key ?>" <?= $value['process_saw_fc']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_fc_saw<?= $key ?>">SAW</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>Welder Ref. RH</label>
                    <?php $arr_welder_rh[$key] = explode(';', $value['welder_ref_rh']); ?>
                    <select name="welder_ref_rh[<?= $key ?>][]"  class="select2 will_enable revise" multiple>
                      <?php foreach ($welders as $value_welder) {?>
                        <option <?= in_array($value_welder['id_welder'], $arr_welder_rh[$key]) ? 'selected' : '' ?>><?= $value_welder['welder_code'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Welder Ref. FC</label>
                    <?php $arr_welder_fc[$key] = explode(';', $value['welder_ref_fc']); ?>
                    <select name="welder_ref_fc[<?= $key ?>][]"  class="select2 will_enable revise" multiple>
                      <?php foreach ($welders as $value_welder) {?>
                        <option <?= in_array($value_welder['id_welder'], $arr_welder_fc[$key]) ? 'selected' : '' ?>><?= $value_welder['welder_code'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>WPS No. RH</label>
                    <?php $arr_wps_rh[$key] = explode(';', $value['wps_no_rh']); ?>
                    <select name="wps_no_rh[<?= $key ?>][]"  class="select2 will_enable revise" multiple>
                      <?php foreach ($wpss as $value_wps) {?>
                        <option <?= in_array($value_wps['id_wps'], $arr_wps_rh[$key]) ? 'selected' : '' ?>><?= $value_wps['wps_no'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>WPS No. FC</label>
                    <?php $arr_wps_fc[$key] = explode(';', $value['wps_no_fc']); ?>
                    <select name="wps_no_fc[<?= $key ?>][]"  class="select2 will_enable revise" multiple>
                      <?php foreach ($wpss as $value_wps) {?>
                        <option <?= in_array($value_wps['id_wps'], $arr_wps_fc[$key]) ? 'selected' : '' ?>><?= $value_wps['wps_no'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md">
                    <div class="form-group">
                      <label>Reject/Pending Remark</label>
                      <textarea value="" class="all_remarks form-control reject_pending_remarks<?= $key ?>" name="reject_pending_remarks[<?= $key ?>]" disabled><?= $value['rejected_remarks'] ?><?php htmlentities('<br>') ?><?= $value['pending_qc_remarks'] ?>
                      </textarea>
                    </div>
                  </div>

                  <?php if($enable_modify=='client'){ ?>
                  <input type="hidden" name="status_access" value="client">
                  <div class="col-md">
                    <div class="form-group">
                      <label>Client Remark</label>
                      <textarea value="" class="form-control client_remarks<?= $key ?> client_remarks_all" name="client_remarks[<?= $key ?>]" disabled><?= $value['client_remarks'] ?></textarea>
                    </div>
                  </div>
                  <?php } else {?>
                    <input type="hidden" name="status_access" value="qc">
                  <?php } ?>

                </div>
              </div>
            </div>
          </div>
          

        <?php } ?>
        <?php if($enable_modify!='client'){ ?>
          <div class="row" id="add_drawing_container">
            <div class="col-md-12">
              <div class="my-3 p-3 bg-white rounded shadow-sm">
                <div class="overflow-auto media text-muted">
                  <div class="container-fluid text-right p-0">
                    <div class="btn-group_dele" role="group" aria-label="Basic example">

                      <?php if(isset($activity_eng[$joint_list[$inspection_detail[0]['id_joint']]['drawing_wm']]['id'])){ ?>
                      <?php 
                          $links_atc = base_url_ftp_eng()."production/open_atc/2/".strtr($this->encryption->encrypt($activity_eng[$joint_list[$inspection_detail[0]['id_joint']]['drawing_wm']]['id']), '+=/', '.-~');  
                          $links_atc_cross = base_url_ftp_eng()."production/open_atc_cross/2/".strtr($this->encryption->encrypt($joint_list[$inspection_detail[0]['id_joint']]['drawing_wm']), '+=/', '.-~')."/".strtr($this->encryption->encrypt($activity_eng[$joint_list[$inspection_detail[0]['id_joint']]['drawing_wm']]['id']), '+=/', '.-~');  
                      ?>
                        <a target='_blank' href='<?= $links_atc ?>' class='btn btn-primary text-white' title='Attachment'><i class='fas fa-paperclip'></i> File Drawing</a>
                        <a target='_blank' href='<?= $links_atc_cross ?>' class='btn btn-success text-white' title='Attachment' download='<?= $joint_list[$inspection_detail[0]['id_joint']]['drawing_wm'] ?>.pdf'><i class='fas fa-cloud-download-alt'></i> Download Drawing </a>
                      <?php } ?>

                      <?php if($allow_revise==1){ ?>
                        <?php if($user_permission[41]==1){ ?>
                          <badge name="submit_visual" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-edit"></i> Request for Update</badge>
                        <?php } ?>
                      <?php } else { ?>
                        <?php if($reapproval=='reapproval'){ ?>
                          <input type="hidden" name="revision_status_inspection" value="1">
                          <input type="hidden" name="status_inspection" value="1">

                          <button type="submit" name="submit_visual" class="btn btn-warning"><i class="fa fa-check"></i> Save & Close</button>
                          <script type="text/javascript">
                            function approve_request(submission_id, aksi){
                              Swal.fire({
                                title: 'Are you sure to Reapproval this Update!',
                                text: "This submission will reset to status pending approval!",
                                type: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, Update this data!'
                              }).then((result) => {

                                if (result.value) {
                                  $.ajax({
                                    url: "<?= base_url('visual/approve_request/') ?>",
                                    type: "post",
                                    data: {
                                      'submission_id': submission_id,
                                      'status_revise': aksi,
                                    },
                                    success: function(data){
                                      Swal.fire(
                                        'Data Has Been Updated !',
                                        '',
                                        'success'
                                      ).then(function() {
                                          $('#form_app').submit();
                                          // window.location.href = "<?= base_url('visual/inspection_rfi_serverside') ?>";
                                          // location.reload();
                                          // return false;
                                      });
                                    }
                                  });
                                }
                              })
                            }
                          </script>
                        <?php } ?>

                      <?php } ?>
                        <a href="<?= base_url('visual/visual_pdf/').$inspection_detail[0]['submission_id'].'/qc/'.$inspection_detail[0]['drawing_no'] ?>" class="btn btn-danger btn-lg"> <i class="fas fa-file-pdf"></i> Report
                        </a>

                    </div>
                  </div>
                  <div class="fl-scrolls fl-scrolls-hidden" data-orientation="horizontal" style="width: 1564px; left: 286px;"><div style="width: 1564px;">
                  </div></div></div>
              </div>
            </div>
          </div>
        <?php } elseif($enable_modify=='client'){ ?>
          <div class="row" id="add_drawing_container">
            <div class="col-md-12">
              <div class="my-3 p-3 bg-white rounded shadow-sm">
                <div class="overflow-auto media text-muted">
                  <div class="container-fluid text-right p-0">
                    <div class="btn-groups" role="group" aria-label="Basic example">

                      <?php if(isset($activity_eng[$joint_list[$inspection_detail[0]['id_joint']]['drawing_wm']]['id'])){ ?>
                      <?php 
                          $links_atc = base_url_ftp_eng()."production/open_atc/2/".strtr($this->encryption->encrypt($activity_eng[$joint_list[$inspection_detail[0]['id_joint']]['drawing_wm']]['id']), '+=/', '.-~');  
                          $links_atc_cross = base_url_ftp_eng()."production/open_atc_cross/2/".strtr($this->encryption->encrypt($joint_list[$inspection_detail[0]['id_joint']]['drawing_wm']), '+=/', '.-~')."/".strtr($this->encryption->encrypt($activity_eng[$joint_list[$inspection_detail[0]['id_joint']]['drawing_wm']]['id']), '+=/', '.-~');  
                      ?>
                        <a target='_blank' href='<?= $links_atc ?>' class='btn btn-primary text-white' title='Attachment'><i class='fas fa-paperclip'></i> File Drawing</a>
                        <a target='_blank' href='<?= $links_atc_cross ?>' class='btn btn-success text-white' title='Attachment' download='<?= $joint_list[$inspection_detail[0]['id_joint']]['drawing_wm'] ?>.pdf'><i class='fas fa-cloud-download-alt'></i> Download Drawing </a>
                      <?php } ?>
                      
                    <?php if($user_cookie[7]==8 OR $user_cookie[7]==1){ ?>
                      <button type="submit" name="submit_visual" class="btn btn-primary <?= $button_save_client ?>"><i class="fa fa-save"></i> Save</button>
                    <?php } ?>

                      <a href="<?= base_url('visual/visual_pdf/').$inspection_detail[0]['report_number'].'/client/'.$inspection_detail[0]['drawing_no'] ?>" class="btn btn-danger"><i class="fas fa-file-pdf"></i> Report</a>
                    </div>
                  </div>
                  <div class="fl-scrolls fl-scrolls-hidden" data-orientation="horizontal" style="width: 1564px; left: 286px;"><div style="width: 1564px;">
                  </div></div></div>
              </div>
            </div>
          </div>
        <?php } ?>
      </form>
    </div>  
  </div> 
</div> 
</div>
</div></div> 

  

  <script type="text/javascript">
    function required_remarks(no, thiss, con){
      if(con==6){
        console.log('1')
        $('.client_remarks'+no).prop('required', true);
        $('.client_remarks'+no).removeAttr('disabled');
      } else if(con==2 || con==4) {
        console.log('2')
        $('.reject_pending_remarks'+no).prop('required', true);
        $('.reject_pending_remarks'+no).prop('disabled', false);
      } else {
        console.log('3')
        $('.client_remarks'+no).removeAttr('required');
        $('.client_remarks'+no).prop('disabled', true);
      } 
    }
    $('.dataTable').DataTable({
      order: [],
      columnDefs: [{
        "targets": 0,
        "orderable": false,
      }]
    })
  </script> 