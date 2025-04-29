<?php


if (isset($post['start_date']) && !empty($post['start_date'])) {
  $start_date = $post['start_date'];
} else {
  $start_date = null;
}

if (isset($post['end_date']) && !empty($post['end_date'])) {
  $end_date = $post['end_date'];
} else {
  $end_date = null;
}

?>

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
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">
          <a class="btn btn-primary" data-toggle="collapse" href="#collapseButton" role="button" aria-expanded="false" aria-controls="collapseButton">Filter &nbsp; <i class="fas fa-angle-double-down"></i><i class="fas fa-angle-double-up"></i></a>
          </h6>
        </div>
        <div class="collapse <?= $this->input->post() ? 'show' : '' ?>" id="collapseButton">
        <div class="card-body bg-white overflow-auto">
          <form action="" method="POST">
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Project ID</label>
                  <div class="col-xl">
                    <select class="form-control select2" name="project">
                      <?php if ($this->is_admin == 1) { ?>
                        <option value="">---</option>
                      <?php } ?>
                      <?php foreach ($project_list as $key => $value) : ?>
												<?php if(in_array($value['id'], $this->user_cookie[13])): ?>
                        	<option value="<?= $value['id'] ?>" <?= $value['id'] == $this->input->post('project') ? 'selected' : '' ?>><?= $value['project_name'] ?></option>
												<?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Company</label>
                  <div class="col-xl">

                    <select class="form-control select2" name="company">
                      <?php if ($this->is_admin) : ?>
                        <option value="">---</option>
                      <?php endif; ?>
                      <?php foreach ($company_list as $key => $value) : ?>
                        <option value="<?php echo $value['id_company'] ?>" <?php echo ($this->input->post('company') == $value['id_company'] ? 'selected'  : '') ?>><?php echo $value['company_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Start Date</label>
                  <div class="col-xl">
                    <input type='date' class='form-control' placeholder='Start Date' name='start_date' value='<?= $post['start_date'] ?>'>
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">End Date</label>
                  <div class="col-xl">
                    <input type='date' class='form-control' placeholder='Start Date' name='end_date' value='<?= $post['end_date'] ?>'>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Choice Type Of Filter Date</label>
                  <div class="col-xl">
                    <select name='filter_date' class='form-control'>
                      <option value="1" <?= ($post['filter_date'] == '1' ? 'selected' : '') ?>>by Welding Date</option>
                      <option value="0" <?= ($post['filter_date'] == '0' ? 'selected' : '') ?>>by NDT Testing Date</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label "></label>
                  <div class="col-xl">
                  </div>
                </div>
              </div>
            </div>


            <div class="row">
              <div class="col-12 text-right">
                <button id='button_search' class="mt-2 btn btn-sm btn-flat btn-info"><i class="fas fa-search"></i> Search</button>
                <button class="mt-2 btn btn-sm btn-flat btn-success" name='button_excel' value='download_excel'><i class="fas fa-file-excel"></i> Download</button>
              </div>
            </div>
          </form>
        </div>
        </div>
      </div>
    </div>
  </div>



  <div class="card shadow my-3 rounded-0">
    <div class="card-header">
      <h6 class="m-0"><?php echo $meta_title ?></h6>
    </div>

    <div class="card-body bg-white">
      <!-- <?php if ($this->permission_cookie[108] == '1') { ?>
      <a href="<?php echo base_url() ?>master/welder/welder_new" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Add New</a>
      <?php } ?>
      <?php if ($this->permission_cookie[111] == '1') { ?>
        <?php

        if (isset($post['project']) && !empty($post['project'])) {
          $project_id = strtr($this->encryption->encrypt($post['project']), '+=/', '.-~');
        } else {
          $project_id = strtr($this->encryption->encrypt($this->user_cookie[10]), '+=/', '.-~');
        }

        if (isset($post['company']) && !empty($post['company'])) {
          $company = strtr($this->encryption->encrypt($post['company']), '+=/', '.-~');
        } else {
          $company = strtr($this->encryption->encrypt("1"), '+=/', '.-~');
        }

        ?>
      <a href="<?php echo base_url() ?>master/welder/welder_list/excel/<?= $project_id ?>/<?= $company ?>" class="btn btn-sm btn-success"><i class="far fa-file-excel"></i> Excel</a>
      <?php } ?> -->


      <?php if ($this->permission_cookie[107] == '1') { ?>


        <div class="overflow-auto">
          <table class="table table-hover text-center dataTable">
            <thead class="bg-gray-table">
              <tr>
                <th rowspan='2'>Welder Code</th>
                <!-- <th rowspan='2'>Client Code</th> -->
                <th rowspan='2'>Company</th>
                <th rowspan='2'>Project</th>
                <th rowspan='2'>Employee ID</th>
                <th rowspan='2'>Welder Name</th>
                <th colspan='3'>Welder Qualification</th>
                <th colspan='6'>Number Of Weld Status</th>
                <th rowspan='2'>Rate %</th>
                <th colspan="<?= sizeof($master_ctq) ?>">Breakdown Of Defects Rejected</th>
                <th rowspan='2'>SMOE STATUS</th>
                <th rowspan='2'>KPI STATUS</th>
                <th rowspan='2'>Data Audit</th>
              </tr>
              <tr>
                <th>Process</th>
                <th>F Number</th>
                <th>Position</th>
                <th>Joint Welded</th>
                <th>Joint Tested</th>
                <th>Joint Repaired</th>
                <th>Welded (mm)</th>
                <th>Tested (mm)</th>
                <th>Rejected (mm)</th>
                <?php foreach ($master_ctq as $key => $value) { ?>
                  <th><?= $value['ctq_initial'] ?></th>
                <?php } ?>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($welder_list as $key => $value) : ?>

                <?php
								@$total_joint_welded += @$visual_data_welder[$value["id_welder"]]['joint_welded'] + 0 ;
								@$total_length_welded += @$visual_data_welder[$value["id_welder"]]['length_welded'] + 0 ;

								@$total_joint_tested += @$ndt_data_welder[$value["id_welder"]]['joint_tested'] + 0 ;
								@$total_length_tested += @$ndt_data_welder[$value["id_welder"]]['length_tested'] + 0 ;

								@$total_joint_reject += @$no_weld_status[$value["id_welder"]]['joint_repaired'] + 0 ;
								@$total_length_rejected += @$no_weld_status[$value["id_welder"]]['length_rejected'] + 0 ;

                ?>

                <tr>

                  <td>
                  <?php echo $value["welder_code"] ?></td>
                  <!-- <td><?php echo $value["rwe_code"] ?></td> -->
                  <td><?php echo @$company_list[$value["company_id"]]['company_name']; ?></td>
                  <td><?php echo $project[$value["project_id"]]['project_name'] ?></td>
                  <td><?php echo $value["welder_badge"] ?></td>
                  <td><?php echo $value["welder_name"] ?></td>
                  <td><?php foreach ($welder_detail_list[$value["id_welder"]] as $welder_process) {
                        echo $welder_process_list[$welder_process['welder_process']]['name_process'] . "</br>";
                      } ?></td>
                  <td><?php foreach ($welder_detail_list[$value["id_welder"]] as $f_no) {
                        echo $f_no['f_no'] . "</br>";
                      } ?></td>
                  <td><?php foreach ($welder_detail_list[$value["id_welder"]] as $welder_position) {
                        echo $welder_position['welder_position'] . "</br>";
                      } ?></td>


                  <td><?= @$visual_data_welder[$value['id_welder']]['joint_welded']+0 ?></td>
                  <td><?= @$ndt_data_welder[$value['id_welder']]['joint_tested']+0 ?></td>
                  <td><?= @$no_weld_status[$value['id_welder']]['joint_repaired']+0 ?></td>
                  <td><?= @$visual_data_welder[$value['id_welder']]['length_welded']+0 ?></td>
                  <td><?= @$ndt_data_welder[$value['id_welder']]['length_tested']+0 ?></td>
                  <td><?= @$no_weld_status[$value['id_welder']]['length_rejected']+0 ?></td>

                  <td>
                    <?php
										$var_joint_tested = @$ndt_data_welder[$value['id_welder']]['length_tested']+0;
										$var_joint_reject_ndt = @$no_weld_status[$value['id_welder']]['length_rejected']+0;

                    if ($var_joint_reject_ndt > 0) {
                      $total_rate = round(($var_joint_reject_ndt / $var_joint_tested) * 100, 2);
                    ?>
                      <a target='_blank' href='<?= base_url(); ?>master/welder/welder_perform_audit/<?php echo strtr($this->encryption->encrypt($value["id_welder"]), '+=/', '.-~') ?>/<?php echo strtr($this->encryption->encrypt($start_date), '+=/', '.-~') ?>/<?php echo strtr($this->encryption->encrypt($end_date), '+=/', '.-~') ?>/<?php echo strtr($this->encryption->encrypt($post['filter_date']), '+=/', '.-~') ?>'> <?php echo $total_rate . "%"; ?></a>
                    <?php
                    } else {
                      $total_rate = 0;
                      echo "0%";
                    }
                    ?>
                  </td>

                  <?php foreach ($master_ctq as $keyx => $valuex) { ?>
                    <?php
											@$total_reject[$keyx] += @$breakdown_defect[$value["id_welder"]][$valuex['id']] + 0;
                    ?>
                    <td><?= round(@$breakdown_defect[$value["id_welder"]][$valuex['id']] + 0, 2) ?></td>
                  <?php } ?>

                  <td>
                    <?php if ($value["status_actived"] == 1) : ?>
                      <span class="badge badge-success">Active</span>
                    <?php else : ?>
                      <span class="badge badge-danger">Non-Active</span>
                      <?php
                      if (isset($value['remarks_auto_disabled'])) {
                        echo "<span style='font-size:10px !important;font-weight:bold;font-style: italic;'>" . $value['remarks_auto_disabled'] . "</span><br/><span style='font-size:10px !important;font-weight:bold;font-style: italic;'>" . $value['auto_expired_date'] . "</span>";
                      }
                      ?>
                    <?php endif; ?>
                  </td>

                  <td>
                    <?php if ($total_rate < 1) { ?>
                      GOOD
                    <?php } else if ($total_rate >= 1.8) { ?>
                      TRAINING
                    <?php } else if ($total_rate >= 1.5) { ?>
                      MONITORING
                    <?php } else if ($total_rate > 1) { ?>
                      BRIEF
                    <?php } ?>
                  </td>
                  <td>
                    <?php if (isset($visual_data_welder[$value['id_welder']]['joint_welded'])) {  ?>
                      <a target='_blank' href='<?= base_url(); ?>master/welder/welder_perform_audit/<?php echo strtr($this->encryption->encrypt($value["id_welder"]), '+=/', '.-~') ?>/<?php echo strtr($this->encryption->encrypt($start_date), '+=/', '.-~') ?>/<?php echo strtr($this->encryption->encrypt($end_date), '+=/', '.-~') ?>'>Audit</a>
                    <?php } else { ?>
                      -
                    <?php } ?>
                  </td>
                </tr>

              <?php $no++;
              endforeach; ?>

            </tbody>
            <tr>
              <td colspan='8'>Summary Of Calculation</td>
              <td><?= $total_joint_welded ?></td>
              <td><?= $total_joint_tested ?></td>
              <td><?= $total_joint_reject ?></td>
              <td><?= $total_length_welded ?></td>
              <td><?= $total_length_tested ?></td>
              <td><?= $total_length_rejected ?></td>
              <td><?= round(($total_length_rejected / $total_length_tested) * 100, 2) . "%"; ?></td>
              <?php foreach ($master_ctq as $keyx => $valuex) { ?>
                <td> <?= (isset($total_reject[$keyx]) ? $total_reject[$keyx] : 0) ?></td>
              <?php } ?>
            </tr>
          </table>
        </div>
      <?php } ?>
    </div>
  </div>

  <!-- <div class="card shadow my-3 rounded-0">
    <div class="card-header">
      <h6 class="m-0">KPI Welder</h6>
    </div>

    <div class="card-body bg-white">
      <div class="overflow-auto">
                  
            Content!

      </div>
    </div>
  </div> -->

  <!-- <div class="card shadow my-3 rounded-0">
    <div class="card-header">
      <h6 class="m-0">NDT Reject</h6>
    </div>

    <div class="card-body bg-white">
      <div class="overflow-auto">

      <figure class="highcharts-figure">
                    <div id="ndt_rejection"></div>
                </figure>
                  
      <table class="table">
        <tr>
            <?php foreach ($master_ctq as $key => $value) { ?>
                <th><?= $value['ctq_initial'] ?><br/>(mm)</th>
            <?php } ?> 
            <th>
              Total<br/>(mm)
            </th>
        </tr>
        <tr>
            <?php foreach ($master_ctq as $key => $value) { ?>
              <?php
              if (isset($total_reject[$key])) {
                @$total_sumx += $total_reject[$key];
              }
              ?>
              <td><?= (isset($total_reject[$key]) ? $total_reject[$key] : 0) ?></td>
            <?php } ?> 
            <td><?= $total_sumx ?></td>
        </tr>
      </table>       

      </div>
    </div>
  </div> -->

</div>
</div>
<script>
  $('.dataTable').DataTable({
    "order": [15, "desc"]
  });

  $(".select2").select2({
    allowClear: true,
    tokenSeparators: [', ', ' '],
  })
</script>

<script>
  Highcharts.chart('ndt_rejection', {
    chart: {
      type: 'column',
      height: 280,
    },
    title: {
      text: 'Defect Break Down'
    },
    xAxis: {
      categories: [
        <?php foreach ($master_ctq as $key => $value) { ?> "<?= $value['ctq_initial'] ?>",
        <?php } ?>
      ],
      crosshair: true
    },
    yAxis: {
      min: 0,
      title: {
        text: 'Defect Length (mm)'
      }
    },
    tooltip: {
      headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
      pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
        '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
      footerFormat: '</table>',
      shared: true,
      useHTML: true
    },
    plotOptions: {
      column: {
        pointPadding: 0.2,
        borderWidth: 0
      }
    },
    series: [{
      showInLegend: false,
      data: [
        <?php foreach ($master_ctq as $key => $value) { ?>
          <?= (isset($total_reject[$key]) ? $total_reject[$key] : 0) ?>,
        <?php } ?>
      ]
    }]
  });
</script>