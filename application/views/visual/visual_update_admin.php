<div id="content" class="container-fluid">
  <style type="text/css">
    .disabled-effect {
      pointer-events: none;
      opacity:0.5;
    }
  </style>
  <form method="POST" action="<?= base_url('visual/update_inspection') ?>" autocomplete="off"> 
    <div class="row">
      <?php 
        error_reporting(0);

        $sufix = $this->master_report_no[$inspection_detail[0]['discipline']][$inspection_detail[0]['module']][$inspection_detail[0]['type_of_module']]['visual_report'.($inspection_detail[0]['company_id']==13 ? '_13' : '')];

        $reno = $sufix.$inspection_detail[0]['report_number'];

        $document_approval_date = MAX(array_column($inspection_detail, 'document_approval_date'));
        foreach ($inspection_detail as $keyg => $valueg) {
          if($valueg['inspection_datetime']!=''){
            $inspection_datetime_arr[] = $valueg['inspection_datetime'];
          }
        }
        $inspection_date = MIN($inspection_datetime_arr);
        $ticked_report_date = MAX(array_column($inspection_detail, 'ticked_report_date'));

        if($ticked_report_date==1){
          $show_date = $document_approval_date;
        } else {
          $show_date = $inspection_date;
        }
      ?>

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

                    <input type="hidden" class="form-control" name="id_revise" value="<?= $id_revise ?>" >

                  </div>
                </div>
                 <div class="col-md">
                  <div class="form-group">
                    <label>Report Number</label>
                    <?php if($inspection_detail[0]['discipline']==1 OR $this->user_cookie[0]==1000226){ ?>
                      <div class="row">
                        <div class="col text-right">
                          <b>
                          <?= $sufix; ?>
                          </b>
                        </div>
                        <div class="col">
                          <div class="input-group mb-3">
                            <input type="text" class="form-control report_number_new" name="report_number" value="<?= $inspection_detail[0]['report_number'] ?>" required="">
                            <div class="input-group-prepend">
                              <button class="btn btn-warning" onclick="changeReport()"><i class="fas fa-edit"></i></button>
                            </div>
                          </div>
                          <script type="text/javascript">
                            function changeReport(){
                              const report_number = $('.report_number_new').val();
                              <?php if($enable_modify=='client'){ ?>
                                const identifier = 'report_number';
                                const where = '<?= $inspection_detail[0]['report_number'] ?>';
                              <?php } else { ?>
                                const identifier = 'submission_id';
                                const where = '<?= $inspection_detail[0]['submission_id'] ?>';
                              <?php } ?>

                              $.ajax({
                                url: "<?= base_url('visual/change_report_number/') ?>",
                                type: "post",
                                data: {
                                  report_number : report_number,
                                  discipline    : "<?= $inspection_detail[0]['discipline'] ?>",
                                  id_visual     : "<?= implode(', ', array_column($inspection_detail, 'id_visual')) ?>",
                                  company_id    : "<?= $inspection_detail[0]['company_id'] ?>",
                                  identifier    : identifier,
                                  where         : where,
                                },
                                success: function(data){
                                  console.log(data)
                                  if(data=='Error'){
                                    Swal.fire(
                                      'Duplicate Report Number!',
                                      '',
                                      'error'
                                    )
                                  } else {
                                    Swal.fire(
                                      'Data has been Updated!',
                                      '',
                                      'success'
                                    ).then(function() {
                                      window.location = document.referrer;
                                      return false;
                                    });
                                  }
                                }
                              });
                            }
                          </script>
                        </div>
                      </div>
                    <?php } else { ?>
                      <input type="text" class="form-control" name="batch_no_only_view" value="<?= $reno ?>" readonly required="">
                    <?php } ?>
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
                    <input type="text" class="form-control" name="mod_id_name" value="EH" disabled="" required="">
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
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Date Inspection SMOE</label>
                    <input type="date" name="inspection_date_smoe" value="<?= explode(' ', $show_date)[0] ?>" class="form-control inspection_date_smoe">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Time Inspection SMOE</label>
                    <input type="time" name="inspection_time_smoe" value="<?= explode(' ', $show_date)[1] ?>" class="form-control inspection_time_smoe">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Internal Update Remarks</label>
                    <textarea class="form-control last_update_remarks" name="last_update_remarks" required></textarea>
                  </div>
                </div>
                <div class="col-md-12" style="text-align: right !important; vertical-align: text-bottom !important;">
                  <span class="btn btn-warning" style="vertical-align: bottom !important;" onclick="changeDate()">
                    <i class="fas fa-edit"></i> Update Date
                  </span>
                </div>
                <script type="text/javascript">
                  function changeDate(){
                    const inspection_date_smoe = $('.inspection_date_smoe').val();
                    const inspection_time_smoe = $('.inspection_time_smoe').val();
                    const last_update_remarks  = $('.last_update_remarks').val();
                    <?php if($enable_modify=='client'){ ?>
                      const identifier = 'report_number';
                      const where = '<?= $inspection_detail[0]['report_number'] ?>';
                    <?php } else { ?>
                      const identifier = 'submission_id';
                      const where = '<?= $inspection_detail[0]['submission_id'] ?>';
                    <?php } ?>

                    $.ajax({
                      url: "<?= base_url('visual/change_date_approval/') ?>",
                      type: "post",
                      data: {
                        inspection_date_smoe  : inspection_date_smoe,
                        inspection_time_smoe  : inspection_time_smoe,
                        last_update_remarks   : last_update_remarks,
                        identifier            : identifier,
                        where                 : where,
                        discipline            : "<?= $inspection_detail[0]['discipline'] ?>",
                        id_visual             : "<?= implode(', ', array_column($inspection_detail, 'id_visual')) ?>",
                      },
                      success: function(data){
                        if(data=='Error'){
                          Swal.fire(
                            'Try Again!',
                            '',
                            'error'
                          ).then(function() {
                            return false;
                          });
                        } else {
                          Swal.fire(
                            'Data Has Been Updated!',
                            '',
                            'success'
                          ).then(function() {
                            return false;
                          });
                        }
                      }
                    });
                  }
                </script>
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
                        discipline  : "<?= $inspection_detail[0]['discipline'] ?>",
                        id_visual   : "<?= implode(', ', array_column($inspection_detail, 'id_visual')) ?>",
                      },
                      success: function(data){
                        if(data=='Error'){
                          Swal.fire(
                            'Try Again!',
                            '',
                            'error'
                          ).then(function() {
                            return false;
                          });
                        } else {
                          Swal.fire(
                            'Data Has Been Updated!',
                            '',
                            'success'
                          ).then(function() {
                            return false;
                          });
                        }
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


    <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">Drawing Rev Update List</h6>
        </div>
        <div class="card-body bg-white overflow-auto">

          <div class="col-md-12"></div>
          <div class="col-md-8">
            <div class="form-group row">
              <label for="" class="col-xl-3 col-form-label text-muted">Drawing GA/AS - Rev No : </label>
              <div class="col-xl">
                <select name="drawing_rev_no_new" class="select2 drawing_rev_no_new" style="width:100%" onchange='append_drawing_links(this,0)'> 
                    <option value="">~ Choice ~</option>
                    <?php foreach($revision_gaas as $key => $value){ ?> 
                      <option value='<?= $value ?>' <?= ($inspection_detail[0]["transmit_gaas_rev"] == $value ? "selected" : null) ?>><?= $value ?></option>
                    <?php } ?> 
                </select>
              </div>
            </div>
          </div>
          
          <div class="col-md-12"></div>
          <div class="col-md-8">
            <div class="form-group row">
              <label for="" class="col-xl-3 col-form-label text-muted"></label>
              <div class="col-xl">
              <span class='add_drawing_ga_as'>-</span>
              </div>
            </div>
          </div>

          <div class="col-md-12"></div>
          <div class="col-md-8">
            <div class="form-group row">
              <label for="" class="col-xl-3 col-form-label text-muted">Drawing Weld Map - Rev No : </label>
              <div class="col-xl">
                  <select name="drawing_wm_rev_approved_new" class="select2 drawing_wm_rev_approved_new" style="width:100%" onchange='append_drawing_links(this,1)'>
                    <option value="">~ Choice ~</option> 
                    <?php foreach($revision_weldmap as $key => $value){ ?> 
                      <option value='<?= $value ?>' <?= ($inspection_detail[0]["transmit_wm_rev"] == $value ? "selected" : null) ?>><?= $value ?></option>
                    <?php } ?>
                  </select>
              </div>
            </div>
          </div> 

          <div class="col-md-12"></div>
          <div class="col-md-8">
            <div class="form-group row">
              <label for="" class="col-xl-3 col-form-label text-muted"></label>
              <div class="col-xl">
              <span class='add_drawing_ga_wm'>-</span>
              </div>
            </div>
          </div>

          <script type="text/javascript">
            function append_drawing_links(rev,drawing_type) {

              var rev_oke = $(rev).val();

              if(drawing_type == 0){ 
                $(".add_drawing_ga_as").text(""); 
                var links = "<?= base_url_ftp_eng() ?>public_smoe/open_atc/2/<?= strtr($this->encryption->encrypt($link_revision_gaas[0]['id_activity']), '+=/', '.-~') ?>/"+ rev_oke;
                $(".add_drawing_ga_as").append('<a target="_blank" href="'+links+'"><?= @$inspection_detail[0]['drawing_no'] ?> (Rev. '+ rev_oke +')</a>');
              } else if(drawing_type == 1){ 
                $(".add_drawing_ga_wm").text(""); 
                var links = "<?= base_url_ftp_eng() ?>public_smoe/open_atc/2/<?= strtr($this->encryption->encrypt($link_revision_weldmap[0]['id_activity']), '+=/', '.-~') ?>/"+ rev_oke;
                $(".add_drawing_ga_wm").append('<a target="_blank" href="'+links+'"><?= @$inspection_detail[0]['drawing_wm'] ?> (Rev. '+ rev_oke +')</a>');
              }
            }

            function changeRevision(){
              const drawing_rev_no = $('.drawing_rev_no_new').val();
              const drawing_wm_rev = $('.drawing_wm_rev_approved_new').val()
              const identifier = 'report_number';
              const where = '<?= $inspection_detail[0]['report_number'] ?>';
              console.log(drawing_rev_no, drawing_wm_rev)
              $.ajax({
                url: "<?= base_url('visual/change_revisiondrawing/') ?>",
                type: "post",
                data: {
                  drawing_rev_no  : drawing_rev_no,
                  drawing_wm_rev  : drawing_wm_rev,
                  where           : where,
                  identifier      : identifier,
                  discipline      : "<?= $inspection_detail[0]['discipline'] ?>",
                  id_visual   : "<?= implode(', ', array_column($inspection_detail, 'id_visual')) ?>",
                },
                success: function(data){
                  if(data=='Error'){
                    Swal.fire(
                      'Try Again!',
                      '',
                      'error'
                    ).then(function() {
                      return false;
                    });
                  } else {
                    Swal.fire(
                      'Data Has Been Updated!',
                      '',
                      'success'
                    ).then(function() {
                      return false;
                    });
                  }
                }
              });
            }
          </script>

          <div class="col-md" style="text-align: right !important; vertical-align: text-bottom !important;">
            <span class="btn btn-warning" style="vertical-align: bottom !important;" onclick="changeRevision()">
              <i class="fas fa-edit"></i> Update Revision
            </span>
          </div>            

        </div>
      </div>
    </div>
  </div>

    <!-- DISINI STAR FOREACH -->
    <?php foreach ($inspection_detail as $key => $value) {?>
    <div class="row" name="">
      <div class="col-md-12">
        <div class="bg-white rounded shadow-sm">
          <a data-toggle="collapse" href="#collapseExample<?= $key ?>" role="button" aria-expanded="false" aria-controls="collapseExample">
            <h6 class="mt-3 px-3 py-3 mb-0 bg-success text-white">Drawing WM : <b><?= $joint_list[$value['id_joint']]['drawing_wm'].' ('.$joint_list[$value['id_joint']]['joint_no'].')' ?></b></h6>
          </a>
          <?php //test_var($value); ?>
          <input type="hidden" name="id[]" value="<?= $value['id_visual'] ?>">
          <div class="overflow-auto media text-muted pt-3 mx-3 border-top border-bottom border-gray" id="collapseExample<?= $key ?>" style="margin-bottom: 0cm">
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
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>PWHT</label>
                    <div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="pwht[<?= $key ?>]" value="1" style="width: 17px; height: 17px" <?= $value['ndt_pwht']==1 ? 'checked' : '' ?> <?= $enable_modify=='client' ? 'disabled' : '' ?>>
                        <label class="form-check-label">Yes</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="pwht[<?= $key ?>]" value="0" style="width: 17px; height: 17px" <?= $value['ndt_pwht']!=1 ? 'checked' : '' ?> <?= $enable_modify=='client' ? 'disabled' : '' ?>>
                        <label class="form-check-label">No</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>Weld Date Time</label>
                    <input type="date" class="form-control revise" name="weld_date[<?= $key ?>]" required="" value="<?= DATE('Y-m-d', strtotime($value['weld_datetime'])) ?>">
                    <input type="time" class="form-control revise" name="weld_time[<?= $key ?>]" required="" value="<?= DATE('H:i:s', strtotime($value['weld_datetime'])) ?>">
                  </div>
                  <div class="form-group">
                    <label>Consumable / Lot No</label>
                    <input type="text" class="form-control revise" title="1" name="cons_lot_no[<?= $key ?>]" placeholder="Consumable / Lot Number" value="<?= $value['cons_lot_no'] ?>">
                  </div>   
                </div>
              </div>

              <div class="row">                
                <div class="col-md">
                  <div class="form-group">
                    <label>Length of Weld (MM)</label>
                    <input type="number" class="form-control length_of_weld_1 revise" name="length_of_weld[<?= $key ?>]" value="<?= $value['length_of_weld'] ?>" required="" <?= $value['revision']>0 ? '' : 'readonly' ?>>
                    <input type="hidden" name="id_revise" value="<?= $value['length_of_weld'] ?>" required="" disabled>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>Length (MM)</label>
                    <input type="text" class="form-control" name="lenght[1]" value="<?= $joint_list[$value['id_joint']]['length'] ?>" disabled="">
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                  </div>
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
                    <textarea value="" class="form-control" name="remarks[<?= $key ?>]"><?= $value['remarks'] ?></textarea>
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
                        <input  type="checkbox" value="1" name="process_1_rh[<?= $key ?>]" class="custom-control-input  revise" id="customControlAutosizing_rh_gtaw<?= $key ?>" <?= $value['process_gtaw_rh']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_rh_gtaw<?= $key ?>">GTAW</label>
                      </div>
                      <div class="form-check col-md-12 custom-control custom-checkbox">
                        <input  type="checkbox" value="1" name="process_2_rh[<?= $key ?>]" class="custom-control-input  revise" id="customControlAutosizing_rh_gmaw<?= $key ?>" <?= $value['process_gmaw_rh']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_rh_gmaw<?= $key ?>">GMAW</label>
                      </div>
                      <div class="form-check col-md-12 custom-control custom-checkbox">
                        <input  type="checkbox" value="1" name="process_3_rh[<?= $key ?>]" class="custom-control-input  revise" id="customControlAutosizing_rh_smaw<?= $key ?>" <?= $value['process_smaw_rh']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_rh_smaw<?= $key ?>">SMAW</label>
                      </div>
                      <div class="form-check col-md-12 custom-control custom-checkbox">
                        <input  type="checkbox" value="1" name="process_4_rh[<?= $key ?>]" class="custom-control-input  revise" id="customControlAutosizing_rh_fcaw<?= $key ?>" <?= $value['process_fcaw_rh']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_rh_fcaw<?= $key ?>">FCAW</label>
                      </div>
                      <div class="form-check col-md-12 custom-control custom-checkbox">
                        <input  type="checkbox" value="1" name="process_5_rh[<?= $key ?>]" class="custom-control-input  revise" id="customControlAutosizing_rh_saw<?= $key ?>" <?= $value['process_saw_rh']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_rh_saw<?= $key ?>">SAW</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-sm">
                    <label>Process FC</label>
                    <div class="row mx-0">
                      <div class="form-check col-md-12 custom-control custom-checkbox">
                        <input  type="checkbox" value="1" name="process_1_fc[<?= $key ?>]" class="custom-control-input  revise" id="customControlAutosizing_fc_gtaw<?= $key ?>" <?= $value['process_gtaw_fc']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_fc_gtaw<?= $key ?>">GTAW</label>
                      </div>
                      <div class="form-check col-md-12 custom-control custom-checkbox">
                        <input  type="checkbox" value="1" name="process_2_fc[<?= $key ?>]" class="custom-control-input  revise" id="customControlAutosizing_fc_gmaw<?= $key ?>" <?= $value['process_gmaw_fc']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_fc_gmaw<?= $key ?>">GMAW</label>
                      </div>
                      <div class="form-check col-md-12 custom-control custom-checkbox">
                        <input  type="checkbox" value="1" name="process_3_fc[<?= $key ?>]" class="custom-control-input  revise" id="customControlAutosizing_fc_smaw<?= $key ?>" <?= $value['process_smaw_fc']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_fc_smaw<?= $key ?>">SMAW</label>
                      </div>
                      <div class="form-check col-md-12 custom-control custom-checkbox">
                        <input  type="checkbox" value="1" name="process_4_fc[<?= $key ?>]" class="custom-control-input  revise" id="customControlAutosizing_fc_fcaw<?= $key ?>" <?= $value['process_fcaw_fc']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_fc_fcaw<?= $key ?>">FCAW</label>
                      </div>
                      <div class="form-check col-md-12 custom-control custom-checkbox">
                        <input  type="checkbox" value="1" name="process_5_fc[<?= $key ?>]" class="custom-control-input  revise" id="customControlAutosizing_fc_saw<?= $key ?>" <?= $value['process_saw_fc']==1 ? 'checked' : '' ?>>
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
                        <option <?= in_array($value_welder['id_welder'], $arr_welder_rh[$key]) ? 'selected' : '' ?> value="<?= $value_welder['id_welder'] ?>"><?= $value_welder['welder_code'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Welder Ref. FC</label>
                    <?php $arr_welder_fc[$key] = explode(';', $value['welder_ref_fc']); ?>
                    <select name="welder_ref_fc[<?= $key ?>][]"  class="select2 will_enable revise" multiple>
                      <?php foreach ($welders as $value_welder) {?>
                        <option <?= in_array($value_welder['id_welder'], $arr_welder_fc[$key]) ? 'selected' : '' ?> value="<?= $value_welder['id_welder'] ?>"><?= $value_welder['welder_code'] ?></option>
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

                </div>

              </div>
            </div>
          </div>
        </div>
        <?php } ?>
        <div class="row" id="add_drawing_container">

          <div class="col-md-12">
            <div class="my-3 p-3 bg-white rounded shadow-sm">
              <div class="overflow-auto media text-muted">
                <div class="container-fluid text-right p-0 row">

                  <div class="form-group col-6 text-right">
                  </div>

                  <div class="form-group col-6 text-right">
                    <!-- <label class="form-label">Internal Update Remarks</label>
                    <textarea class="form-control" name="last_update_remarks" required=""></textarea>
                    <br> -->

                    <button type="submit" name="submit_visual" class="btn btn-primary btn-lg" onsubmit="relod()"><i class="fa fa-save"></i> Save</button>
                    <script type="text/javascript">
                      function relod(){
                        location.reload()
                      }
                    </script>
                  </div>

                </div>
                <div class="fl-scrolls fl-scrolls-hidden" data-orientation="horizontal" style="width: 1564px; left: 286px;"><div style="width: 1564px;">
                </div></div></div>
            </div>
          </div>
        </div>
      </form>
    </div>  
  </div> 
</div> 
</div>
</div>
</div>