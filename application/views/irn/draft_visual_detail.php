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

    .badge-approved_comment {
      color: #ffffff;
      background-color: #2c7008;
    }

    .badge-pending_client {
      color: #ffffff;
      background-color: #b80762;
    }
</style>
<div id="content" class="container-fluid">

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">Filter Data For Inspection</h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <form action="" method="POST">

            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Drawing No.</label>
                  <div class="col-xl">
                    <select class="form-control select2" name="drawing_no">
                      <option value="">---</option>
                      <?php foreach (array_unique(array_column($filter, 'drawing_no')) as $key => $value) { ?>
                        <option value="<?= $value ?>" <?=  $post['drawing_no']==$value ? 'selected' : '' ?>><?= $value ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">WM Drawing No</label>
                  <div class="col-xl">
                    <select class="form-control select2" name="drawing_wm">
                      <option value="">---</option>
                      <?php foreach (array_unique(array_column($filter, 'drawing_wm')) as $key => $value) { ?>
                        <option value="<?= $value ?>" <?=  $post['drawing_wm']==$value ? 'selected' : '' ?>><?= $value ?></option>
                      <?php } ?>
                    </select>
                  </div>
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

  <div class="row">
    <div class="col-md-12">
      <form method="POST" action="<?= base_url("irn/detail_draft_visual_process/").$inspector ?>">
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0"><?php echo $meta_title ?></h6>
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
          <div class="container-fluid">

            <div class="row">
              <div class="col-2">
                <b>Approval By</b>
                <input type="datetime" name="date_aprroval" class="form-control" readonly value="<?= $this->user_cookie[1] ?>">
              </div>
            </div>
            <div class="row">
              <div class="col-2">
                <b>Approval Date</b>
                <input type="datetime" name="date_aprroval" class="form-control" readonly value="<?= DATE("Y-m-d H:i:s") ?>">
              </div>
            </div>
            
            <br>

            <table class="table table-hover text-center dataTables" width="100%">
              <thead class="bg-green-smoe text-white">
                <tr>
                  <th rowspan="2">
                    <input type="checkbox" name="cb_all" onclick="checkCheck(this)">
                  </th>
                  <th rowspan="2"><?= $inspector=='qc' ? 'Submission ID.' : 'Report No.' ?></th>
                  <th rowspan="2">Drawing No.</th>
                  <th rowspan="2">Weld Map Drawing No.</th>
                  <th rowspan="2">Item / Joint No.</th>

                  <th rowspan="2">Class</th>
                  <th rowspan="2">Type of Weld</th>
                  <th rowspan="2">WPS</th>

                  <th rowspan="1" colspan="2">Weld Process</th>
                  <th rowspan="1" colspan="2">Welder ID</th>

                  <th rowspan="2">SIZE / DIA</th>
                  <th rowspan="2">SCH</th>
                  <th rowspan="2">THK</th>
                  <th rowspan="2">Weld Length</th>
                  <th rowspan="2">Weld Completion Date</th>
                </tr>

                <tr>
                  <th rowspan="1">RH</th>
                  <th rowspan="1">FC</th>
                  <th rowspan="1">RH</th>
                  <th rowspan="1">FC</th>
                </tr>

              </thead>   
              <tbody>               
                <?php $no = 1; foreach ($list as $key => $value) { ?>
                <?php //test_var($value); ?>
                <tr> 
                  <td><input type="checkbox" name="id_visual[]" class="cb cb_<?= $key ?>" value="<?= $value['id_visual'] ?>"></td>
                  <td>
                    <?php if($inspector=='qc'){ ?>
                      <a href="<?= base_url('visual/visual_pdf/').$value['visual_submission_id'].'/qc/'.$value['drawing_no'] ?>" target="_blank">
                        <?= $value['visual_submission_id'] ?>
                      </a>
                    <?php } else { ?>
                      <a href="<?= base_url('visual/visual_pdf/').$value['visual_report_no'].'/client/'.$value['drawing_no'].'/'.$value['postpone_reoffer_no'] ?>" target="_blank">
                        <?= $value['visual_report_no'] ?>
                      </a>
                    <?php } ?>

                  </td>
                  <td><?= $value['drawing_no'] ?></td>
                  <td><?= $value['drawing_wm'] ?></td>
                  <td class="font-weight-bold"><?= $value['joint_no'].$value['revision_category'].$value['revision'] ?></td>

                  <td><?= $class_list[$value['class']] ?></td>
                  <td><?= $weld_type[$value['weld_type']] ?></td>
                  <td>
                    <?php 
                      $wps = array_unique(array_merge(explode(';', $value['wps_no_rh']), explode(';', $value['wps_no_fc'])));
                      foreach($wps AS $key_wps => $value_wps){
                        if($value_wps!=0 AND isset($value_wps)){
                          // test_var($master_wps);
                          $wps_name[] = $master_wps[$value_wps];
                        }
                      }
                      // test_var($wps_name);
                      print_r(implode(', ', $wps_name));
                      unset($wps, $wps_name);
                    ?>
                  </td>
                  
                  <td>
                    <?= $value['process_gtaw_rh']==1 ? 'GTAW<br>' : '' ?>
                    <?= $value['process_gmaw_rh']==1 ? 'GMAW<br>' : '' ?>
                    <?= $value['process_smaw_rh']==1 ? 'SMAW<br>' : '' ?>
                    <?= $value['process_fcaw_rh']==1 ? 'FCAW<br>' : '' ?>
                    <?= $value['process_saw_rh']==1 ? 'SAW<br>' : '' ?>
                  </td>
                  <td>
                    <?= $value['process_gtaw_fc']==1 ? 'GTAW<br>' : '' ?>
                    <?= $value['process_gmaw_fc']==1 ? 'GMAW<br>' : '' ?>
                    <?= $value['process_smaw_fc']==1 ? 'SMAW<br>' : '' ?>
                    <?= $value['process_fcaw_fc']==1 ? 'FCAW<br>' : '' ?>
                    <?= $value['process_saw_fc']==1 ? 'SAW<br>' : '' ?>
                  </td>

                  <td>
                    <?php 
                      $welder = array_unique(array_merge(explode(';', $value['welder_ref_rh']), explode(';', $value['welder_ref_rh'])));
                      foreach($welder AS $key_welder => $value_welder){
                        if($value_welder!=0 AND isset($value_welder)){
                          // test_var($master_welder);
                          $welder_name[] = $welder_code[$value_welder];
                        }
                      }
                      // test_var($wps_name);
                      print_r(implode(', ', $welder_name));
                      unset($welder, $welder_name);
                    ?>  
                  </td>
                  
                  <td>
                    <?php 
                      $welder = array_unique(array_merge(explode(';', $value['welder_ref_fc']), explode(';', $value['welder_ref_fc'])));
                      foreach($welder AS $key_welder => $value_welder){
                        if($value_welder!=0 AND isset($value_welder)){
                          // test_var($master_welder);
                          $welder_name[] = $welder_code[$value_welder];
                        }
                      }
                      // test_var($wps_name);
                      print_r(implode(', ', $welder_name));
                      unset($welder, $welder_name);
                    ?> 
                  </td>

                  <td><?= $value['diameter'] ?></td>
                  <td><?= $value['sch'] ?></td>
                  <td><?= $value['thickness'] ?></td>
                  <td><?= $value['weld_length'] ?></td>
                  <td><?= $value['weld_datetime'] ?></td>
                  
                </tr>
                <?php  $no++; } ?>            
              </tbody>           
            </table>
            <script type="text/javascript">
              function checkCheck(ini){
                var value = $(ini)
                console.log($(value)[0].checked);
                if($(value)[0].checked==true){
                  $('.cb').attr("checked", true)
                } else {
                  $('.cb').attr("checked", false)
                }
              }
            </script>
          </div>
        </div>
        <br>
        <button type="submit" class="btn btn-success">Approve</button>
      </div>
    </form>
  </div>
  </div>
</div>
</div>
<script type="text/javascript"> 
 
  $('.dataTable').DataTable({
    order: [1,"asc"], 
  })   

</script>

<script>

function return_to_draft(btn, remarks) { 
    console.log(btn); 
    $.ajax({
      url: "<?php echo base_url() ?>irn/reset_report_number",
      data: {
        report_number: $(btn).data("report_number"),
        project: $(btn).data("project"),
        discipline: $(btn).data("discipline"),
        submission_id: $(btn).data("submission_id"),
        remarks: remarks,
      },
      type: 'post',
      success: function(data) {
        if (data.includes('Error') == true) {
          sweetalert("error", data);
        } else {
          sweetalert("success", "Return Data Success!"); 
          location.reload();
        }
      }
    });
  }

  function return_to_qc(btn, remarks) { 
    console.log(btn); 
    $.ajax({
      url: "<?php echo base_url() ?>irn/reset_client_inspection",
      data: {
        report_number: $(btn).data("report_number"),
        project: $(btn).data("project"),
        discipline: $(btn).data("discipline"),
        submission_id: $(btn).data("submission_id"),
        remarks: remarks,
      },
      type: 'post',
      success: function(data) {
        if (data.includes('Error') == true) {
          sweetalert("error", data);
        } else {
          sweetalert("success", "Return Data Success!"); 
          location.reload();
        }
      }
    });
  }
</script>

<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.chained.min.js"></script>
<script>
    $("select[name=module]").chained("select[name=project]");  
</script>
