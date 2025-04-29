<div id="content" class="container-fluid">
  <?php error_reporting(0); 
    // test_var($reapproval);
  ?>
  <style type="text/css">
    .disabled-effect {
      pointer-events: none;
      opacity:0.5;
    }
  </style>
  <?php if($reapproval=='reapproval' AND $revision_detail['status_revise']==1){ ?>
        <form method="POST" action="<?= base_url('visual/reapproval_inspection') ?>" autocomplete="off">
        <script type="text/javascript">
          $(document).ready(function(){
            $('.revise').removeAttr('disabled');
          })
          $(document).ready(function(){
            $('.custom-control-input').addClass('disabled-effect');
            $('.custom-checkbox').addClass('disabled-effect');
            $('.custom-control-label').addClass('disabled-effect');
          })
        </script>
      <?php } else {?>
        <form method="POST" action="<?= base_url('visual/approval_inspection') ?>" autocomplete="off"> 
      <?php } ?>
    <div class="row">
      <?php error_reporting(0);?>

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
                    <label>Submission</label>
                    <input type="text" class="form-control" name="batch_no_only_view" value="<?= $inspection_detail[0]['submission_id'] ?>" readonly required="">
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
                  <div class="form-group">
                    <label>Area</label>
                    <select class="form-control" name="area_main" onchange="changeArea(this)" <?= $user_permission[40]==1 ? '' : 'disabled' ?> disabled>
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
              </div>

            </div>
          <div class="fl-scrolls fl-scrolls-hidden" data-orientation="horizontal" style="width: 1564px; left: 286px;"><div style="width: 1564px;"></div></div></div>
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
                    <input type="date" class="form-control revise" name="weld_date[<?= $key ?>]" required="" value="<?= DATE('Y-m-d', strtotime($value['weld_datetime'])) ?>" disabled>
                  </div>
                  <div class="form-group">
                    <label>Consumable / Lot No</label>
                    <input type="text" class="form-control revise" title="1" name="cons_lot_no[<?= $key ?>]" placeholder="Consumable / Lot Number" value="<?= $value['cons_lot_no'] ?>" disabled>
                  </div>   
                </div>
              </div>

              <div class="row">                
                <div class="col-md">
                  <div class="form-group">
                    <label>Length of Weld (MM)</label>
                    <input type="text" class="form-control length_of_weld_1 revise" name="length_of_weld[<?= $key ?>]" value="<?= number_format($value['length_of_weld'], 2) ?>" required="" disabled>
                    <input type="hidden" name="id_revise" value="<?= number_format($value['length_of_weld'], 2) ?>" required="" disabled>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>Length (MM)</label>
                    <input type="text" class="form-control" name="lenght[1]" value="<?= number_format($joint_list[$value['id_joint']]['length'], 2) ?>" disabled="">
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>Location</label>
                    <?php if($value['location_v2']!=''){ ?>
                        <select name="location_v2[<?= $key ?>]" class="form-control disabled-effect revise" >
                          <option value="">---</option>
                        <?php foreach ($master_location_v2 as $keys => $valuel) { ?>
                          <option value="<?= $valuel['id'] ?>" <?= $value['location_v2']==$valuel['id'] ? 'selected' : '' ?>><?= $valuel['name'] ?></option>
                        <?php } ?>
                      <?php } else { ?>
                        <select name="location[<?= $key ?>]" class="form-control disabled-effect revise" >
                          <option value="">---</option>
                      <?php foreach ($location_list as $keys => $valuel) { ?>
                        <option value="<?= $valuel['id'] ?>" <?= $value['location']==$valuel['id'] ? 'selected' : '' ?>><?= $valuel['location_name'] ?></option>
                      <?php }} ?>
                    </select>
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
                    <textarea value="" class="form-control" name="remarks[<?= $key ?>]" readonly <?= $enable_modify=='client' ? 'disabled' : '' ?>><?= $value['remarks'] ?></textarea>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>NDT Requirement</label>
                    <div class="row mx-0">
                      <div class="form-check col-md-4 custom-control custom-checkbox <?= $enable_modify=='client' ? 'disabled-effect' : '' ?>">
                        <input type="checkbox" value="1" name="ndt_mt[<?= $key ?>]" class="custom-control-input" id="customControlAutosizing_mt<?= $key ?>" <?= $value['ndt_mt']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_mt<?= $key ?>">MT</label>
                      </div>
                      <div class="form-check col-md-4 custom-control custom-checkbox <?= $enable_modify=='client' ? 'disabled-effect' : '' ?>">
                        <input type="checkbox" value="1" name="ndt_rt[<?= $key ?>]" class="custom-control-input" id="customControlAutosizing_rt<?= $key ?>" <?= $value['ndt_rt']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_rt<?= $key ?>">RT</label>
                      </div>
                      <div class="form-check col-md-4 custom-control custom-checkbox <?= $enable_modify=='client' ? 'disabled-effect' : '' ?>">
                        <input type="checkbox" value="1" name="ndt_pt[<?= $key ?>]" class="custom-control-input" id="customControlAutosizing_pt<?= $key ?>" <?= $value['ndt_pt']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_pt<?= $key ?>">PT</label>
                      </div>

                      <div class="form-check col-md-4 custom-control custom-checkbox <?= $enable_modify=='client' ? 'disabled-effect' : '' ?>">
                        <input type="checkbox" value="1" name="ndt_ut[<?= $key ?>]" class="custom-control-input" id="customControlAutosizing_ut<?= $key ?>" <?= $value['ndt_ut']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_ut<?= $key ?>">UT</label>
                      </div>
                      <div class="form-check col-md-4 custom-control custom-checkbox <?= $enable_modify=='client' ? 'disabled-effect' : '' ?>">
                        <input type="checkbox" value="1" name="ndt_pa_ut[<?= $key ?>]" class="custom-control-input" <?= $value['ndt_pa_ut']==1 ? 'checked' : '' ?> id="customControlAutosizing_pa_ut<?= $key ?>">
                        <label class="custom-control-label" for="customControlAutosizing_pa_ut<?= $key ?>">PA-UT</label>
                      </div>
                      <div class="form-check col-md-4 custom-control custom-checkbox <?= $enable_modify=='client' ? 'disabled-effect' : '' ?>">
                        <input type="checkbox" value="1" name="ndt_ht[<?= $key ?>]" class="custom-control-input" id="customControlAutosizing_ht<?= $key ?>" <?= $value['ndt_ht']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_ht<?= $key ?>">HT</label>
                      </div>

                      <div class="form-check col-md-4 custom-control custom-checkbox <?= $enable_modify=='client' ? 'disabled-effect' : '' ?>">
                        <input type="checkbox" value="1" name="ndt_ft[<?= $key ?>]" class="custom-control-input" id="customControlAutosizing_ft<?= $key ?>" <?= $value['ndt_ft']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_ft<?= $key ?>">FT</label>
                      </div>
                      <div class="form-check col-md-4 custom-control custom-checkbox <?= $enable_modify=='client' ? 'disabled-effect' : '' ?>">
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
                        <input disabled type="checkbox" value="1" name="process_1_rh[<?= $key ?>]" class="custom-control-input disabled-effect revise" id="customControlAutosizing_rh_gtaw<?= $key ?>" <?= $value['process_gtaw_rh']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_rh_gtaw<?= $key ?>">GTAW</label>
                      </div>
                      <div class="form-check col-md-12 custom-control custom-checkbox">
                        <input disabled type="checkbox" value="1" name="process_2_rh[<?= $key ?>]" class="custom-control-input disabled-effect revise" id="customControlAutosizing_rh_gmaw<?= $key ?>" <?= $value['process_gmaw_rh']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_rh_gmaw<?= $key ?>">GMAW</label>
                      </div>
                      <div class="form-check col-md-12 custom-control custom-checkbox">
                        <input disabled type="checkbox" value="1" name="process_3_rh[<?= $key ?>]" class="custom-control-input disabled-effect revise" id="customControlAutosizing_rh_smaw<?= $key ?>" <?= $value['process_smaw_rh']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_rh_smaw<?= $key ?>">SMAW</label>
                      </div>
                      <div class="form-check col-md-12 custom-control custom-checkbox">
                        <input disabled type="checkbox" value="1" name="process_4_rh[<?= $key ?>]" class="custom-control-input disabled-effect revise" id="customControlAutosizing_rh_fcaw<?= $key ?>" <?= $value['process_fcaw_rh']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_rh_fcaw<?= $key ?>">FCAW</label>
                      </div>
                      <div class="form-check col-md-12 custom-control custom-checkbox">
                        <input disabled type="checkbox" value="1" name="process_5_rh[<?= $key ?>]" class="custom-control-input disabled-effect revise" id="customControlAutosizing_rh_saw<?= $key ?>" <?= $value['process_saw_rh']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_rh_saw<?= $key ?>">SAW</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-sm">
                    <label>Process FC</label>
                    <div class="row mx-0">
                      <div class="form-check col-md-12 custom-control custom-checkbox">
                        <input disabled type="checkbox" value="1" name="process_1_fc[<?= $key ?>]" class="custom-control-input disabled-effect revise" id="customControlAutosizing_fc_gtaw<?= $key ?>" <?= $value['process_gtaw_fc']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_fc_gtaw<?= $key ?>">GTAW</label>
                      </div>
                      <div class="form-check col-md-12 custom-control custom-checkbox">
                        <input disabled type="checkbox" value="1" name="process_2_fc[<?= $key ?>]" class="custom-control-input disabled-effect revise" id="customControlAutosizing_fc_gmaw<?= $key ?>" <?= $value['process_gmaw_fc']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_fc_gmaw<?= $key ?>">GMAW</label>
                      </div>
                      <div class="form-check col-md-12 custom-control custom-checkbox">
                        <input disabled type="checkbox" value="1" name="process_3_fc[<?= $key ?>]" class="custom-control-input disabled-effect revise" id="customControlAutosizing_fc_smaw<?= $key ?>" <?= $value['process_smaw_fc']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_fc_smaw<?= $key ?>">SMAW</label>
                      </div>
                      <div class="form-check col-md-12 custom-control custom-checkbox">
                        <input disabled type="checkbox" value="1" name="process_4_fc[<?= $key ?>]" class="custom-control-input disabled-effect revise" id="customControlAutosizing_fc_fcaw<?= $key ?>" <?= $value['process_fcaw_fc']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_fc_fcaw<?= $key ?>">FCAW</label>
                      </div>
                      <div class="form-check col-md-12 custom-control custom-checkbox">
                        <input disabled type="checkbox" value="1" name="process_5_fc[<?= $key ?>]" class="custom-control-input disabled-effect revise" id="customControlAutosizing_fc_saw<?= $key ?>" <?= $value['process_saw_fc']==1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="customControlAutosizing_fc_saw<?= $key ?>">SAW</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>Welder Ref. RH</label>
                    <?php $arr_welder_rh[$key] = explode(';', $value['welder_ref_rh']); ?>
                    <select name="welder_ref_rh[<?= $key ?>][]" disabled class="select2 will_enable revise" multiple>
                      <?php foreach ($welders as $value_welder) {?>
                        <option <?= in_array($value_welder['id_welder'], $arr_welder_rh[$key]) ? 'selected' : '' ?> value="<?= $value_welder['id_welder'] ?>"><?= $value_welder['welder_code'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Welder Ref. FC</label>
                    <?php $arr_welder_fc[$key] = explode(';', $value['welder_ref_fc']); ?>
                    <select name="welder_ref_fc[<?= $key ?>][]" disabled class="select2 will_enable revise" multiple>
                      <?php foreach ($welders as $value_welder) {?>
                        <option <?= in_array($value_welder['id_welder'], $arr_welder_fc[$key]) ? 'selected' : '' ?> value="<?= $value_welder['id_welder'] ?>"><?= $value_welder['welder_code'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>WPS No. RH</label>
                    <?php $arr_wps_rh[$key] = explode(';', $value['wps_no_rh']); ?>
                    <select name="wps_no_rh[<?= $key ?>][]" disabled class="select2 will_enable revise" multiple>
                      <?php foreach ($wpss as $value_wps) {?>
                        <option <?= in_array($value_wps['id_wps'], $arr_wps_rh[$key]) ? 'selected' : '' ?>><?= $value_wps['wps_no'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>WPS No. FC</label>
                    <?php $arr_wps_fc[$key] = explode(';', $value['wps_no_fc']); ?>
                    <select name="wps_no_fc[<?= $key ?>][]" disabled class="select2 will_enable revise" multiple>
                      <?php foreach ($wpss as $value_wps) {?>
                        <option <?= in_array($value_wps['id_wps'], $arr_wps_fc[$key]) ? 'selected' : '' ?>><?= $value_wps['wps_no'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md">
                    <div class="form-group">
                      <label>Reject/Pending Remark</label>
                      <textarea value="" class="all_remarks form-control reject_pending_remarks<?= $key ?>" name="reject_pending_remarks[<?= $key ?>]" disabled>
                        <?= $value['rejected_remarks'] ?>
                        <?php htmlentities('<br>') ?>
                        <?= $value['pending_qc_remarks'] ?>
                      </textarea>
                    </div>
                  </div>

                  <?php if($enable_modify=='client'){ ?>
                  <input type="hidden" name="status_access" value="client">
                  <div class="col-md">
                    <div class="form-group">
                      <label>Client Remark</label>
                      <textarea value="" class="form-control client_remarks<?= $key ?>" name="client_remarks[<?= $key ?>]" disabled>
                        <?= $value['client_remarks'] ?>
                      </textarea>
                    </div>
                  </div>
                  <?php } else {?>
                    <input type="hidden" name="status_access" value="qc">
                  <?php } ?>

                </div>
              </div>
            </div>
          </div>
          <!-- <br> -->
        <!-- </div>
        <div class="row" id="add_drawing_container"> -->
          <?php if($enable_modify!='client'){ ?>
            <div class="col-md-12" style="margin-top: 0">
              <div class="my-3 p-3 bg-white rounded shadow-sm" style="margin-top: 0">
                <div class="overflow-auto media text-muted" style="margin-top: 0">
                  <div class="container-fluid text-right p-0" style="margin-top: 0">
                    <?php if($value['status_inspection']==2){ ?>
                      <center><span class="badge badge-danger" style="margin-top: 0cm"><h6 style="margin-top: 0cm !important"><b>Rejected</b></h6></span></center>
                    <?php } elseif($value['status_inspection']==3 OR $value['status_inspection']==5){ ?>
                      <center><span class="badge badge-success " style="margin-top: 0cm"><h6 style="margin-top: 0cm !important"><b>Approved</b></h6></span></center>
                    <?php } elseif($value['status_inspection']==4){ ?>
                      <center><span class="badge badge-primary" style="margin-top: 0cm"><h6 style="margin-top: 0cm !important"><b>Pending By QC</b></h6></span></center>
                    <?php } elseif($value['status_inspection']==5){ ?>
                      <center><span class="badge badge-primary" style="margin-top: 0cm"><h6 style="margin-top: 0cm !important"><b>Transmitt to Client</b></h6></span></center>
                    <?php } elseif($value['status_inspection']==6){ ?>
                      <center><span class="badge badge-danger" style="margin-top: 0cm"><h6 style="margin-top: 0cm !important"><b>Reject by Client</b></h6></span></center>
                    <?php } elseif($value['status_inspection']==7){ ?>
                      <center><span class="badge badge-success" style="margin-top: 0cm"><h6 style="margin-top: 0cm !important"><b>Approved by Client</b></h6></span></center>
                    <?php } elseif($value['status_inspection']==1){ ?>
                      <div class="row float-left" style="width: 600px !important;">
                        <div class="col-md-4">
                          <input class="form-check-input app" type="radio" name="approve[<?= $key ?>]" value="3" style="width: 17px; height: 17px" onclick="required_remarks(<?= $key ?>, this, 3)">
                          <label class="form-check-label font-weight-bold text-success">&nbsp;&nbsp;Approve</label>
                        </div>
                        <div class="col-md-4" style="width: 10px !important">
                          <input class="form-check-input rej" type="radio" name="approve[<?= $key ?>]" value="2" style="width: 17px; height: 17px" onclick="required_remarks(<?= $key ?>, this, 2)">
                          <label class="form-check-label font-weight-bold text-danger">&nbsp;&nbsp;Reject</label>
                        </div>
                        <div class="col-md-4" style="width: 10px !important">
                          <input class="form-check-input pen" type="radio" name="approve[<?= $key ?>]" value="4" style="width: 17px; height: 17px" onclick="required_remarks(<?= $key ?>, this, 4)">
                          <label class="form-check-label font-weight-bold text-primary">&nbsp;&nbsp;Pending By QC</label>
                        </div>
                      </div>
                    <?php } ?>
                  </div>

                  <div class="fl-scrolls fl-scrolls-hidden" data-orientation="horizontal" style="width: 1564px; left: 286px;"><div style="width: 1564px;">
                  </div></div></div>
              </div>
            </div>
          <?php } ?>
          <?php if($enable_modify=='client' AND $value['status_inspection']==5){ ?>
            <div class="col-md-12" style="margin-top: 0">
              <div class="my-3 p-3 bg-white rounded shadow-sm" style="margin-top: 0">
                <div class="overflow-auto media text-muted" style="margin-top: 0">
                  <div class="container-fluid text-right p-0" style="margin-top: 0">
                    <div class="row float-left" style="width: 600px !important;">
                      <div class="col-md-4">
                        <input class="form-check-input app" type="radio" name="approve[<?= $key ?>]" value="7" style="width: 17px; height: 17px" onclick="required_remarks(<?= $key ?>, this, 7)">
                        <label class="form-check-label font-weight-bold text-success">&nbsp;&nbsp;Approve</label>
                      </div>
                      <div class="col-md-4" style="width: 10px !important">
                        <input class="form-check-input rej" type="radio" name="approve[<?= $key ?>]" value="6" style="width: 17px; height: 17px" onclick="required_remarks(<?= $key ?>, this, 6)">
                        <label class="form-check-label font-weight-bold text-danger">&nbsp;&nbsp;Reject</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php } elseif($enable_modify=='client' AND $value['status_inspection']==6){ ?>
            <br>
            <center><span class="badge badge-danger" style="margin-top: 0cm"><h6 style="margin-top: 0cm !important"><b>Rejected</b></h6></span></center>
            <br>
          <?php } elseif($enable_modify=='client' AND $value['status_inspection']==7){?>
            <br>
            <center><span class="badge badge-success" style="margin-top: 0cm"><h6 style="margin-top: 0cm !important"><b>Approved</b></h6></span></center>
            <br>
          <?php } ?>
        </div>
        <?php } ?>
        <?php if($enable_modify!='client'){ ?>
          <div class="row" id="add_drawing_container">
            <div class="col-md-12">
              <div class="my-3 p-3 bg-white rounded shadow-sm">
                <div class="overflow-auto media text-muted">
                  <div class="container-fluid text-right p-0">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <?php if($reapproval=='reapproval'){ ?>
                          <?php if($revision_detail['status_revise']==2){ ?>
                          <badge name="submit_visual" class="btn btn-warning" onclick="approve_request('<?= $inspection_detail[0]['submission_id'] ?>', 3, '<?= $revision_detail['id'] ?>')"><i class="fa fa-check"></i> Close</badge>
                        <?php } ?>
                          <script type="text/javascript">
                            function approve_request(submission_id, aksi, id_rev_h){
                              console.log(id_rev_h)
                              Swal.fire({
                                title: 'Are you sure to Reapproval this Update!',
                                text: "This submission will reset to status pending approval!",
                                type: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, Close it!'
                              }).then((result) => {

                                if (result.value) {
                                  $.ajax({
                                    url: "<?= base_url('visual/close_revise/') ?>",
                                    type: "post",
                                    data: {
                                      'submission_id': submission_id,
                                      'status_revise': aksi,
                                      'id_revise': id_rev_h,
                                    },
                                    success: function(data){
                                      Swal.fire(
                                        'Data Has Been Updated !',
                                        '',
                                        'success'
                                      ).then(function() {  
                                          window.location.replace("<?= base_url('visual/revise_history_list/closed') ?>")
                                      });
                                    }
                                  });
                                }
                              })
                            }
                          </script>
                        <?php } ?>
                          <?php if($revision_detail['status_revise']==1){ ?>
                          <button type="submit" name="submit_visual" class="btn btn-primary btn-lg" onsubmit="relod()"><i class="fa fa-save"></i> Save</button>
                          <?php } ?>
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
        <?php }?>
      </form>
    </div>  
  </div> 
</div> 
</div>
</div></div> 

  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="<?php echo base_url('visual/request_for_update') ?>">
            <div class="form-group">
              <label for="inspector_before">Last Inspector By</label>
              <input type="text" class="form-control" id="inspector_before" value="<?= $user_list[$inspection_detail[0]['inspection_by']]['full_name'] ?>" readonly>
              <input name="inspector_before" type="hidden" value="<?= $inspection_detail[0]['inspection_by'] ?>" readonly>
            </div>
            <div class="form-group">
              <label for="requestor">Request By</label>
              <input type="text" class="form-control" id="requestor" placeholder="" value="<?= $user_list[$user_cookie[0]]['full_name'] ?>" readonly>
              <input name="requestor" type="hidden" value="<?= $user_cookie[0] ?>" readonly>
              <input name="submission_id" type="hidden" value="<?= $inspection_detail[0]['submission_id'] ?>" readonly>
            </div>
            <div class="form-group">
              <label for="reason">Reason</label>
              <textarea class="form-control" id="reason" placeholder="Reasons for update" name="reason"></textarea>
            </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    function required_remarks(no, thiss, con){
      if(con!=7){
        $('.client_remarks'+no).prop('required', true);
        $('.client_remarks'+no).removeAttr('disabled');
      } else {
        $('.client_remarks'+no).removeAttr('required');
        $('.client_remarks'+no).prop('disabled', true);
      } 
    }
  </script> 