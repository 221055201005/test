<div id="content" class="container-fluid">
  
  <div class="row">
    <div class="col-md-6">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header bg-success text-white">
          <h6 class="m-0 text-center font-weight-bold">                                    
            WEEKLY PROGRESS
          </h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <div id="container_weekly_progress" style="height: 300px; width: 100%;"></div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header bg-success text-white">
          <h6 class="m-0 text-center font-weight-bold">                                    
            MONTHLY PROGRESS
          </h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <div id="container_monthly_progress" style="height: 300px; width: 100%;"></div>
        </div>
      </div>
    </div>
  </div>
  <?php
  $html_btn_level = ''.
  '<div class="container mb-4">'.
    '<div class="row">'.
      '<div class="col-md text-center">'.
        '<button id="btn_def_lvl" class="btn btn-dark btn-block" data-id="level_2" onclick="toogle_container(this)">Level 2</button>'.
      '</div>'.
      '<div class="col-md text-center">'.
        '<button class="btn btn-dark btn-block" data-id="level_3" onclick="toogle_container(this)">Level 3</button>'.
      '</div>'.
      '<div class="col-md text-center">'.
        '<button class="btn btn-dark btn-block" data-id="level_4" onclick="toogle_container(this)">Level 4</button>'.
      '</div>'.
    '</div>'.
  '</div>';
  ?>

  <div class="row">
    <div class="col-md-12" id="level_2">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">                                    
            Progress Measurement <b>Level 2</b>                         
          </h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <?php echo $html_btn_level ?>
          <table width="100%"  class="table table-hover table-bordered dataTable"  style="text-align: center">
            <thead>
              <tr class="text-white bg-info">
                <th rowspan="2">Type of Module</th>
                <!-- <th rowspan="2">Discipline</th> -->
                <!-- <th rowspan="2">Phase</th> -->

                <th rowspan="1" colspan="3"><b>Last Period</b></th>
                <th rowspan="1" colspan="3"><b>This Period</b></th>
                <th rowspan="1" colspan="3"><b>Cum. Period</b></th>

              </tr>
              <tr class="text-white bg-info">
                <th rowspan="1" colspan="1"><b>Plan</b></th>
                <th rowspan="1" colspan="1"><b>Actual</b></th>
                <th rowspan="1" colspan="1"><b>Variance</b></th>

                <th rowspan="1" colspan="1"><b>Plan</b></th>
                <th rowspan="1" colspan="1"><b>Actual</b></th>
                <th rowspan="1" colspan="1"><b>Variance</b></th>

                <th rowspan="1" colspan="1"><b>Plan</b></th>
                <th rowspan="1" colspan="1"><b>Actual</b></th>
                <th rowspan="1" colspan="1"><b>Variance</b></th>
              </tr>
            </thead>
            <tbody>
              
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-12" id="level_3">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">                                    
            Progress Measurement <b>Level 3</b>                         
          </h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <?php echo $html_btn_level ?>
          <table width="100%"  class="table table-hover table-bordered dataTable"  style="text-align: center">
            <thead>
              <tr class="text-white bg-success">
                <th rowspan="2">Type of Module</th>
                <th rowspan="2">Discipline</th>
                <!-- <th rowspan="2">Phase</th> -->

                <th rowspan="1" colspan="3"><b>Last Period</b></th>
                <th rowspan="1" colspan="3"><b>This Period</b></th>
                <th rowspan="1" colspan="3"><b>Cum. Period</b></th>

              </tr>
              <tr class="text-white bg-success">
                <th rowspan="1" colspan="1"><b>Plan</b></th>
                <th rowspan="1" colspan="1"><b>Actual</b></th>
                <th rowspan="1" colspan="1"><b>Variance</b></th>

                <th rowspan="1" colspan="1"><b>Plan</b></th>
                <th rowspan="1" colspan="1"><b>Actual</b></th>
                <th rowspan="1" colspan="1"><b>Variance</b></th>

                <th rowspan="1" colspan="1"><b>Plan</b></th>
                <th rowspan="1" colspan="1"><b>Actual</b></th>
                <th rowspan="1" colspan="1"><b>Variance</b></th>
              </tr>
            </thead>
            <tbody>
              
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-12" id="level_4">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">                                    
            Progress Measurement <b>Level 4</b>                         
          </h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <?php echo $html_btn_level ?>
          <table width="100%"  class="table table-hover table-bordered dataTable"  style="text-align: center">
            <thead>
              <tr class="text-white bg-primary">
                <th rowspan="2">Type of Module</th>
                <th rowspan="2">Discipline</th>
                <th rowspan="2">Phase</th>

                <th rowspan="1" colspan="3"><b>Last Period</b></th>
                <th rowspan="1" colspan="3"><b>This Period</b></th>
                <th rowspan="1" colspan="3"><b>Cum. Period</b></th>

              </tr>
              <tr class="text-white bg-primary">
                <th rowspan="1" colspan="1"><b>Plan</b></th>
                <th rowspan="1" colspan="1"><b>Actual</b></th>
                <th rowspan="1" colspan="1"><b>Variance</b></th>

                <th rowspan="1" colspan="1"><b>Plan</b></th>
                <th rowspan="1" colspan="1"><b>Actual</b></th>
                <th rowspan="1" colspan="1"><b>Variance</b></th>

                <th rowspan="1" colspan="1"><b>Plan</b></th>
                <th rowspan="1" colspan="1"><b>Actual</b></th>
                <th rowspan="1" colspan="1"><b>Variance</b></th>
              </tr>
            </thead>
            <tbody>
              
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <?php
    $workpack_summary = [
      "PF" => [],
      "FB" => [],
      "AS" => [],
      "ER" => [],
    ];
    foreach ($workpack_list as $key => $value) {
      @$workpack_summary[$value['phase']]["total"] += 1;
      if($value['status'] == 1 && $value['plan_finish_date'] >= date("Y-m-d")){
        @$workpack_summary[$value['phase']]["inprogress"] += 1;
      }
      elseif($value['status'] == 1 && $value['plan_finish_date'] < date("Y-m-d")){
        @$workpack_summary[$value['phase']]["overdue"] += 1;
      }
      elseif($value['status'] == 2){
        @$workpack_summary[$value['phase']]["complete"] += 1;
      }
      elseif($value['status_approval'] == 2){
        @$workpack_summary[$value['phase']]["rejected"] += 1;
      }
      elseif($value['status_approval'] == 1){
        @$workpack_summary[$value['phase']]["pending"] += 1;
      }
      elseif($value['status_approval'] == 0){
        @$workpack_summary[$value['phase']]["draft"] += 1;
      }
    }
  ?>
  <div class="row">
    <div class="col-md">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">                                    
            Workpack Summary
          </h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <table class="table table-hover table-bordered text-center">
            <tr class="bg-success text-white">
              <th class="align-middle">Type</th>
              <th class="align-middle">Draft</th>
              <th class="align-middle">Pending Approval</th>
              <th class="align-middle">Rejected</th>
              <th class="align-middle">In Progress</th>
              <th class="align-middle bg-warning">Overdue</th>
              <th class="align-middle">Complete</th>
              <th class="align-middle">Total</th>
            </tr>
            <?php foreach ($workpack_summary as $key => $value): ?>
              <tr>
                <th><?php echo $key ?></th>
                <td><?php echo @$workpack_summary[$key]["draft"]+0 ?></td>
                <td><?php echo @$workpack_summary[$key]["pending"]+0 ?></td>
                <td><?php echo @$workpack_summary[$key]["rejected"]+0 ?></td>
                <td><?php echo @$workpack_summary[$key]["inprogress"]+0 ?></td>
                <td class="bg-alert-warning"><?php echo @$workpack_summary[$key]["overdue"]+0 ?></td>
                <td><?php echo @$workpack_summary[$key]["complete"]+0 ?></td>
                <td><?php echo @$workpack_summary[$key]["total"]+0 ?></td>
              </tr>
            <?php endforeach; ?>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">                                    
            Workpack Manhours
          </h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <table width="100%" class="table table-hover table-bordered text-center" id="timesheet_dt">

            <tr class="bg-success text-white">
              <th class="align-middle">Location</th>
              <?php foreach ($phase_list as $key => $value) { ?>
                <th class="align-middle"><?= $value['phase_code'] ?></th>
              <?php } ?>
            </tr>

            <?php foreach ($location_list as $key => $value) { ?>
              <tr>                
                <?php 
                  $empty = 0;
                  foreach ($phase_list as $key => $phase) { 
                    if(@$location_by_phase[$value['id']][$phase['id']] == null || $location_by_phase[$value['id']][$phase['id']] == 0){
                      $empty++;
                    } 
                  } 
                ?>

                <?php if($empty != sizeof($phase_list)){ ?>
                  <td><?= $value['location_name'] ?></td>
                  <?php foreach ($phase_list as $key => $phase) { ?>
                    <td><?= @$location_by_phase[$value['id']][$phase['id']] == null ? 0 : $location_by_phase[$value['id']][$phase['id']] ?></td>
                  <?php } ?>
                <?php } ?>

              </tr>
            <?php } ?>

          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
  </div>
  
</div>
</div>
<script>
  $(document).ready(function(){
    $("#level_2").closest("div.row").find("div.col-md-12").hide();
    toogle_container($("#btn_def_lvl"));
    create_chart_for_prgress("container_weekly_progress")
    create_chart_for_prgress("container_monthly_progress")
  });
  
  function toogle_container(btn) {
    var id = $(btn).data("id");
    $("#"+id).closest("div.row").find("div.col-md-12").hide();
    $("#"+id).show()

    $.ajax( {
      url: "<?php echo base_url() ?>home/data_dashboard",
      type: "post",
      data: {
        level: id,
      },
      success: function( data ) {
        $("#"+id).find("tbody").html(data);
      }
    });

    // $.ajax( {
    //   url: "<?php echo base_url() ?>home/data_dashboard_grafix_progress",
    //   type: "post",
    //   data: {
    //     level: id,
    //   },
    //   success: function( data ) {
    //     console.log(data);
    //   }
    // }); 
  }

  function create_chart_for_prgress(container) {
    var category = [];
    var data_chart = [];
    if(container == "container_weekly_progress"){
      <?php 
		    $date_current_week = date("Y-m-d", strtotime("next monday"));
        for ($i=6; $i >= 0; $i--): 
      ?>
        category.push("<?php echo date("j M", strtotime($date_current_week." -".($i*7)." days")) ?>");
      <?php endfor ?>
      data_chart = JSON.parse('<?php echo json_encode($weekly_chart) ?>');
    }
    else if(container == "container_monthly_progress"){
      <?php //for ($i=1; $i <= date("t"); $i++): ?>
        // category.push("<?php echo date("j M", strtotime(date("Y-m-".$i))) ?>");
      <?php //endfor ?>
      category = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'];
      console.log(category);
      data_chart = JSON.parse('<?php echo json_encode($monthly_chart) ?>');
    }

    <?php
      $data_chart = [
        [
          "name" => "Plan Target",
          "data" => [35, 36, 37, 38, 39, 40, 41, 42],
          "color" => "#3bc2d4",
        ],
        [
          "name" => "Actual",
          "data" => [0, 39, 40, 41, 42, 43, 44, 45],
          "color" => "#ff706b",
        ]
      ];
    ?>

    Highcharts.chart(container, {
      title: {
        text: ''
      },
      // subtitle: {
      //   text: 'Source: thesolarfoundation.com'
      // },

      yAxis: {
        title: {
          text: 'Persentage (%)'
        }
      },

      xAxis: {
        categories: category
      },

      legend: {
        layout: 'horizontal',
        align: 'center',
        verticalAlign: 'bottom'
      },

      plotOptions: {
        series: {
          label: {
            connectorAllowed: false
          },
          // pointStart: 2010
        }
      },
      // #3bc2d4, #ff706b, #acf39d, #f6ae2d, #33658a
      series: data_chart,

      tooltip: {
        pointFormat: '{series.name}: <b>{point.y:.2f} %</b><br/>',
      },

      responsive: {
        rules: [{
          condition: {
            maxWidth: 500
          },
          chartOptions: {
            legend: {
              layout: 'horizontal',
              align: 'center',
              verticalAlign: 'bottom'
            }
          }
        }]
      }

    });
  }
  
</script>