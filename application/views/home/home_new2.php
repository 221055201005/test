<style>
  #content{
    font-size: 0.7rem;
  }
  .font-7{
    font-size: 0.7rem;
  }
  button.font-7{
    padding: 0.1rem 0.2rem;
  }
  h1.num_fabrication_high{
    text-align: center;
    font-size: 3rem;
    color: #535c68;
    font-weight: bold;
    white-space: nowrap;
  }
  .num_fabrication_subtitle{
    width: 100%;
    text-align: center;
    color: #535c68;
    font-size: 9px;
  }
  .table td, .table th{
    padding: 0.25rem;
  }
  .table thead{
    position: sticky;
    top: 0;
  }
  .bg-success-dashboard{
    background-color: #20bf6b;
  }
  .num_fabrication_witness{
    background-color: #2bcbba;
    color: white;
    font-weight: bold;
    padding: 2px;
  }
  .num_fabrication_activity{
    background-color: #4b7bec;
    color: white;
    font-weight: bold;
    padding: 2px;
  }
  .num_fabrication_ndt{
    font-weight: bold;
    padding: 2px;
    border: 1px solid #778ca3;
  }
  
  .nav-pills .nav-link {
    color: #000;
    border-bottom: 2px solid #007bff;
    border-radius: 0px;
    min-width: 200px;
    text-align: center;
    box-shadow: inset 0 0 0 0 #007bff;
    -webkit-transition: ease-out 0.2s;
    -moz-transition: ease-out 0.2s;
    transition: ease-out 0.2s;
  }
  .nav-pills .nav-link:hover {
    color: #fff;
    box-shadow: inset 0 -100px 0 0 #007bff;
  }
  .nav-pills .nav-link.active,
  .nav-pills .show>.nav-link {
    color: #fff;
    background: #007bff;
    border-bottom: 2px solid #007bff;
    border-radius: 0px;
  }

  .my-row{
    margin-top: 15px !important;
    margin-bottom: 15px !important;
  }
</style>
<div id="content" class="container-fluid">
  <div class="bg-white p-3 shadow-sm">
    <h4 class="text-center font-weight-bold mt-0 mb-3">Production & Quality Dashboard</h4>
    <?= $tabmenu ?>
  </div>

  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

      <div class="row">
        <div class="col-md-5">
          <div class="row my-row">
            <div class="col-md-6">
              <div class="card border-0 shadow-sm">
                <div class="card-body bg-white text-center p-2">
                  <h6 class="text-center">Piecemark</h6>
                  <div class="chart-wrapper mx-auto" style="height:14vh; position:relative">
                    <div id="container_piecemark" style="height: 100%; width: 100%;">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card border-0 shadow-sm">
                <div class="card-body bg-white text-center p-2">
                  <h6 class="text-center">Joint</h6>
                  <div class="chart-wrapper mx-auto" style="height:14vh; position:relative">
                    <div id="container_joint" style="height: 100%; width: 100%;">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row my-row">
            <div class="col-md-12">
              <div class="card border-0 shadow-sm">
                <div class="card-body bg-white text-center p-2">
                  <div class="row">
                    <div class="col-4">
                      <h6 class="text-center">Surveryor MV</h6>
                      <div class="chart-wrapper mx-auto" style="height:14vh; position:relative">
                        <div id="container_surveyor_mv" style="height: 100%; width: 100%;">
                          <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-4">
                      <h6 class="text-center">Surveryor FU</h6>
                      <div class="chart-wrapper mx-auto" style="height:14vh; position:relative">
                        <div id="container_surveyor_fu" style="height: 100%; width: 100%;">
                          <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-4">
                      <h6 class="text-center">Surveryor VT</h6>
                      <div class="chart-wrapper mx-auto" style="height:14vh; position:relative">
                        <div id="container_surveyor_vt" style="height: 100%; width: 100%;">
                          <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row my-row">
            <div class="col-md-12">
              <div class="card border-0 shadow-sm">
                <div class="card-body bg-white text-center p-2">
                  <h6 class="text-center">Material</h6>
                  <div class="row align-items-center">
                    <div class="col-8 pr-0">
                      <div class="chart-wrapper mx-auto" style="height:14vh; position:relative">
                        <div id="container_material" style="height: 100%; width: 100%;">
                          <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-4 pl-0">
                      <h1 class="num_fabrication_high m-0">0</h1>
                      <div class="row m-0">
                        <div class="col num_fabrication_witness" data-toggle="tooltip" data-placement="bottom" title="Witness">0</div>
                        <div class="col num_fabrication_activity" data-toggle="tooltip" data-placement="bottom" title="Activity">0</div>
                      </div>
                      <span class="num_fabrication_subtitle">Approved Piecemark by Client</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row my-row">
            <div class="col-md">
              <div class="card border-0 shadow-sm">
                <div class="card-body bg-white text-center p-2">
                  <h6 class="text-center">Fitup</h6>
                  <div class="row align-items-center">
                    <div class="col-8">
                      <div class="chart-wrapper mx-auto" style="height:14vh; position:relative">
                        <div id="container_fitup" style="height: 100%; width: 100%;">
                              <div class="text-center loading mt-4">
                            <div class="spinner-border" role="status"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-4 pl-0">
                      <h1 class="num_fabrication_high m-0">0</h1>
                      <div class="row m-0">
                        <div class="col num_fabrication_witness" data-toggle="tooltip" data-placement="bottom" title="Witness">0</div>
                        <div class="col num_fabrication_activity" data-toggle="tooltip" data-placement="bottom" title="Activity">0</div>
                      </div>
                      <span class="num_fabrication_subtitle">Approved Joint by Client</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row my-row">
            <div class="col-md">
              <div class="card border-0 shadow-sm">
                <div class="card-body bg-white text-center p-2">
                  <h6 class="text-center">Visual</h6>
                  <div class="row align-items-center">
                    <div class="col-8">
                      <div class="chart-wrapper mx-auto" style="height:14vh; position:relative">
                        <div id="container_visual" style="height: 100%; width: 100%;">
                              <div class="text-center loading mt-4">
                            <div class="spinner-border" role="status"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-4 pl-0">
                      <h1 class="num_fabrication_high m-0">0</h1>
                      <div class="row m-0">
                        <div class="col num_fabrication_witness" data-toggle="tooltip" data-placement="bottom" title="Witness">0</div>
                        <div class="col num_fabrication_activity" data-toggle="tooltip" data-placement="bottom" title="Activity">0</div>
                      </div>
                      <span class="num_fabrication_subtitle">Approved Joint by Client</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-7">
          <!-- <div class="row">
            <div class="col-md-6">
              <div class="card border-0 shadow-sm">
                <div class="card-body bg-white text-center p-2">
                  <h6 class="text-center"> Weekly Progress <span id="text_week_progressmeasurement" onclick="$('#modal_change_week_progressmeasurement').modal('show');"><?= date("Y-m-d") ?></span> </h6>
                  <div class="chart-wrapper mx-auto" style="height:21vh; position:relative">
                    <div id="container_weekly_progress" style="height: 100%; width: 100%;">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card border-0 shadow-sm">
                <div class="card-body bg-white text-center p-2">
                  <h6 class="text-center"><button class="btn btn-sm font-7" onclick="change_year_progressmeasurement('kurang')"><i class="fas fa-caret-left"></i></button> Monthly Progress <span id="text_year_progressmeasurement"></span> <button class="btn btn-sm font-7" onclick="change_year_progressmeasurement('tambah')"><i class="fas fa-caret-right"></i></button></h6>
                  <div class="chart-wrapper mx-auto" style="height:21vh; position:relative">
                    <div id="container_monthly_progress" style="height: 100%; width: 100%;">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> -->
          <!-- <div class="row">
            <div class="col-md-12">
              <div class="card border-0 shadow-sm">
                <div class="card-body bg-white text-center p-2">
                  <h6 class="text-center"><button class="btn btn-sm font-7" onclick="change_level_progressmeasurement('kurang')"><i class="fas fa-caret-left"></i></button> Progress Measurement Level <span id="text_level_progressmeasurement">4</span> <button class="btn btn-sm font-7" onclick="change_level_progressmeasurement('tambah')"><i class="fas fa-caret-right"></i></button></h6>
                  <div class="chart-wrapper mx-auto overflow-auto" style="height:calc(22vh + 1.5rem + 27px); position:relative" id="container_progressmeasurement">
                    <table class="table table-bordered d-none" id="container_progressmeasurement_level_2">
                      <thead>
                        <tr class="bg-success-dashboard text-white">
                          <th rowspan="2">Type of Module</th>
                          <th colspan="3">Last Period</th>
                          <th colspan="3">This Period</th>
                          <th colspan="3">Cum. Period</th>
                        </tr>
                        <tr class="bg-success-dashboard text-white">
                          <th>Plan</th>
                          <th>Actual</th>
                          <th>Variance</th>
                          <th>Plan</th>
                          <th>Actual</th>
                          <th>Variance</th>
                          <th>Plan</th>
                          <th>Actual</th>
                          <th>Variance</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                    <table class="table table-bordered d-none" id="container_progressmeasurement_level_3">
                      <thead>
                        <tr class="bg-success-dashboard text-white">
                          <th rowspan="2">Type of Module</th>
                          <th rowspan="2">Discipline</th>
                          <th colspan="3">Last Period</th>
                          <th colspan="3">This Period</th>
                          <th colspan="3">Cum. Period</th>
                        </tr>
                        <tr class="bg-success-dashboard text-white">
                          <th>Plan</th>
                          <th>Actual</th>
                          <th>Variance</th>
                          <th>Plan</th>
                          <th>Actual</th>
                          <th>Variance</th>
                          <th>Plan</th>
                          <th>Actual</th>
                          <th>Variance</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                    <table class="table table-bordered" id="container_progressmeasurement_level_4">
                      <thead>
                        <tr class="bg-success-dashboard text-white">
                          <th rowspan="2">Type of Module</th>
                          <th rowspan="2">Discipline</th>
                          <th rowspan="2">Phase</th>
                          <th colspan="3">Last Period</th>
                          <th colspan="3">This Period</th>
                          <th colspan="3">Cum. Period</th>
                        </tr>
                        <tr class="bg-success-dashboard text-white">
                          <th>Plan</th>
                          <th>Actual</th>
                          <th>Variance</th>
                          <th>Plan</th>
                          <th>Actual</th>
                          <th>Variance</th>
                          <th>Plan</th>
                          <th>Actual</th>
                          <th>Variance</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                    <div class="text-center loading mt-4">
                      <div class="spinner-border" role="status"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> -->
          <div class="row my-row">
            <div class="col-md-12">
              <div class="card border-0 shadow-sm">
                <div class="card-body bg-white text-center p-2">
                  <h6 class="text-center">Workpack Summary</h6>
                  <div class="chart-wrapper mx-auto" style="height:21vh; position:relative">
                    <div id="container_workpacksummary" style="height: 100%; width: 100%;">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row my-row">
            <div class="col-md">
              <div class="card border-0 shadow-sm">
                <div class="card-body bg-white text-center p-2">
                  <h6 class="text-center">Workpack Manhours</h6>
                  <div class="chart-wrapper mx-auto overflow-auto" style="height:calc(22vh + 1.5rem + 27px); position:relative" id="container_manhours">
                    <table class="table table-bordered">
                      <thead>
                        <tr class="bg-success-dashboard text-white">
                          <th>Location</th>
                          <th>PF</th>
                          <th>FB</th>
                          <th>AS</th>
                          <th>ER</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                    <div class="text-center loading mt-4">
                      <div class="spinner-border" role="status"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <?php if($this->user_cookie[11] == 1): ?>
          <div class="row my-row">
            <div class="col-md-6">
              <div class="card border-0 shadow-sm">
                <div class="card-body bg-white text-center p-2">
                  <h6 class="text-center">Status Surveyor Structural</h6>
                  <div class="chart-wrapper mx-auto overflow-auto" style="height:calc(22vh + 1.5rem + 27px); position:relative" id="container_status_surveyor_2">
                    <table class="table table-bordered">
                      <thead>
                        <tr class="bg-success-dashboard text-white">
                          <th>Status Surveyor</th>
                          <th>Fitup</th>
                        </tr>
                      </thead>
                      <tbody class="fitup_data">
                      </tbody>
                    </table>
                    <table class="table table-bordered">
                      <thead>
                        <tr class="bg-success-dashboard text-white">
                          <th>Status Surveyor</th>
                          <th>Visual</th>
                        </tr>
                      </thead>
                      <tbody class="visual_data">
                      </tbody>
                    </table>
                    <!-- <div class="text-center loading mt-4">
                      <div class="spinner-border" role="status"></div>
                    </div> -->
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card border-0 shadow-sm">
                <div class="card-body bg-white text-center p-2">
                  <h6 class="text-center">Status Surveyor Piping</h6>
                  <div class="chart-wrapper mx-auto overflow-auto" style="height:calc(22vh + 1.5rem + 27px); position:relative" id="container_status_surveyor_1">
                    <table class="table table-bordered">
                      <thead>
                        <tr class="bg-success-dashboard text-white">
                          <th>Status Surveyor</th>
                          <th>Fitup</th>
                        </tr>
                      </thead>
                      <tbody class="fitup_data">
                      </tbody>
                    </table>
                    <table class="table table-bordered">
                      <thead>
                        <tr class="bg-success-dashboard text-white">
                          <th>Status Surveyor</th>
                          <th>Visual</th>
                        </tr>
                      </thead>
                      <tbody class="visual_data">
                      </tbody>
                    </table>
                    <!-- <div class="text-center loading mt-4">
                      <div class="spinner-border" role="status"></div>
                    </div> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php endif; ?>
          
          <div class="row my-row">
            <div class="col-md">
              <div class="card border-0 shadow-sm">
                <div class="card-body bg-white text-center p-2">
                  <h6 class="text-center">NDT</h6>
                  <div class="row align-items-center">
                    <div class="col-12">
                      <div class="chart-wrapper mx-auto" style="height:calc(22vh + 1.5rem + 27px); position:relative">
                        <div id="container_ndt" style="height: 100%; width: 100%;">
                              <div class="text-center loading mt-4">
                            <div class="spinner-border" role="status"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modal_change_week_progressmeasurement" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Change Week</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="date" id="date_week_progressmeasurement" class="form-control" max="<?= date("Y-m-d", strtotime("next monday")) ?>">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="change_week_progressmeasurement()">Change</button>
      </div>
    </div>
  </div>
</div>
<script>
  var section = -1;
  $(document).ready(function(){
    loading_dashboard();
  });
  
  function loading_dashboard() {
    section++;
    if(section == 0){
      <?php if($this->user_cookie[11] == 1): ?>
        load_data_status_surveyor(2);
      <?php else: ?>
        loading_dashboard();
      <?php endif; ?>
    }
    else if(section == 1){
      <?php if($this->user_cookie[11] == 1): ?>
        load_data_status_surveyor(1);
      <?php else: ?>
        loading_dashboard();
      <?php endif; ?>
    }
    else if(section == 2){
      load_data_template();
    }
    else if(section == 3){
      load_data_workpack_summary();
    }
    else if(section == 4){
      load_data_surveyor();
    }
    else if(section == 5){
      load_data_manhours();
    }
    else if(section == 6){
      load_data_fabrication('material');
    }
    else if(section == 7){
      load_data_fabrication('fitup');
    }
    else if(section == 8){
      load_data_fabrication('visual');
    }
    else if(section == 9){
      load_data_ndt();
    }
    else if(section == 10){
      load_data_progressmeasurement();
    }
    // else if(section == 11){
    //   load_data_chart_progress('weekly');
    // }
    // else if(section == 12){
    //   load_data_chart_progress('monthly');
    // }
  }

  function load_data_status_surveyor(discipline) {
    $.ajax({
      url: '<?php echo base_url() ?>home/load_data_status_surveyor/'+discipline,
      type: 'GET',
      async: true,
      // dataType: "json",
      success: function (data) {
        data = JSON.parse(data)
        console.log(data)
        $("#container_status_surveyor_"+discipline).find("tbody.fitup_data").html(data.fitup)
        $("#container_status_surveyor_"+discipline).find("tbody.visual_data").html(data.visual)
        loading_dashboard();
      }
    });
  }

  function load_data_workpack_summary() {
    $.ajax({
      url: '<?php echo base_url() ?>home/load_data_workpack_summary',
      type: 'GET',
      async: true,
      dataType: "json",
      success: function (data) {
        generate_verticalbarchart("container_workpacksummary", data);
        loading_dashboard();
      }
    });
  }

  function load_data_fabrication(process = 'material') {
    $.ajax({
      url: '<?php echo base_url() ?>home/load_data_fabrication',
      data: {
        process: process
      },
      type: 'POST',
      async: true,
      dataType: "json",
      success: function (data) {
        // generate_horizontalbarchart("container_material", data.mv);
        // generate_horizontalbarchart("container_fitup", data.fu);
        // generate_horizontalbarchart("container_visual", data.vt);

        if(process == 'ndt'){
          generate_horizontalbarchart_ndt("container_ndt", data.ndt);
        }
        else{
          generate_horizontalbarchart("container_"+process, data[process]);
        }
        loading_dashboard();
      }
    });
  }

  function load_data_ndt() {
    $.ajax({
      url: '<?php echo base_url() ?>home/load_data_ndt',
      type: 'POST',
      async: true,
      dataType: "json",
      success: function (data) {
        generate_chart_ndt("container_ndt", data.data, data.categories);
        loading_dashboard();
      }
    });
  }

  function load_data_surveyor() {
    $.ajax({
      url: '<?php echo base_url() ?>home/load_data_surveyor',
      type: 'GET',
      async: true,
      dataType: "json",
      success: function (data) {
        generate_donutchart("container_surveyor_mv", data.mv);
        generate_donutchart("container_surveyor_fu", data.fu);
        generate_donutchart("container_surveyor_vt", data.vt);
        loading_dashboard();
      }
    });
  }
  
  function load_data_manhours() {
    $.ajax({
      url: '<?php echo base_url() ?>home/load_data_workpack_manhours',
      type: 'POST',
      async: true,
      // dataType: "json",
      success: function (data) {
        $("#container_manhours").find("tbody").html(data);
        $("#container_manhours").find(".loading").addClass("d-none");
        loading_dashboard();
      }
    });
  }

  var level_progressmeasurement = 4;
  var loading_level_progressmeasurement = 1;
  function load_data_progressmeasurement() {
    $.ajax({
      url: '<?php echo base_url() ?>home/data_dashboard',
      type: 'POST',
      async: true,
      // dataType: "json",
      data: {
        level: 'level_'+level_progressmeasurement,
      },
      success: function (data) {
        $("#container_progressmeasurement_level_"+level_progressmeasurement).find("tbody").html(data);
        $("#container_progressmeasurement").find(".loading").addClass("d-none");
        loading_level_progressmeasurement = 0;
        loading_dashboard();
      }
    });
  }

  function change_level_progressmeasurement(direction) {
    var action = 0;
    if(direction == 'kurang' && loading_level_progressmeasurement == 0 && level_progressmeasurement > 2){
      level_progressmeasurement--;
      action = 1;
    }
    else if(direction != 'kurang' && loading_level_progressmeasurement == 0 && level_progressmeasurement < 4){
      level_progressmeasurement++;
      action = 1;
    }
    if(action == 1){
      loading_level_progressmeasurement = 1;
      $('#text_level_progressmeasurement').html(level_progressmeasurement);
      $("#container_progressmeasurement").find(".loading").removeClass("d-none");

      $("#container_progressmeasurement_level_2").addClass("d-none");
      $("#container_progressmeasurement_level_3").addClass("d-none");
      $("#container_progressmeasurement_level_4").addClass("d-none");
      $("#container_progressmeasurement_level_"+level_progressmeasurement).removeClass("d-none");
      $("#container_progressmeasurement_level_"+level_progressmeasurement).find("tbody").html('');

      load_data_progressmeasurement();
    }
  }

  function load_data_template() {
    $.ajax({
      url: '<?php echo base_url() ?>home/load_data_template',
      type: 'GET',
      async: true,
      dataType: "json",
      success: function (data) {
        generate_piechart("container_piecemark", data.piecemark);
        generate_piechart("container_joint", data.joint);
        loading_dashboard();
      }
    });
  }

  // var loading_year_progressmeasurement = 1;
  // var year_progressmeasurement = <?= date('Y') ?>;
  // var loading_week_progressmeasurement = 1;
  // var week_progressmeasurement = '<?= date("Y-m-d", strtotime("next monday")) ?>';
  // function load_data_chart_progress(process = 'weekly') {
  //   if(process == 'monthly'){
  //     $('#text_year_progressmeasurement').html(year_progressmeasurement);
  //     $('#container_monthly_progress').html('<div class="text-center loading mt-4"><div class="spinner-border" role="status"></div></div>');
  //   }
  //   if(process == 'weekly'){
  //     $('#text_week_progressmeasurement').html(week_progressmeasurement);
  //     $('#container_weekly_progress').html('<div class="text-center loading mt-4"><div class="spinner-border" role="status"></div></div>');
  //   }
  //   $.ajax({
  //     url: '<?php echo base_url() ?>home/load_data_chart_progress',
  //     type: 'POST',
  //     data: {
  //       year_selected: year_progressmeasurement,
  //       week_selected: week_progressmeasurement,
  //       process: process,
  //     },
  //     async: true,
  //     dataType: "json",
  //     success: function (data) {
  //       // if(process == 'monthly'){
  //         generate_linechart("container_weekly_progress", data.weekly_chart, data.date_for_week_pm);
  //         loading_week_progressmeasurement = 0;
  //       // }
  //       // if(process == 'weekly'){
  //         generate_linechart("container_monthly_progress", data.monthly_chart);
  //         loading_year_progressmeasurement = 0;
  //       // }
  //       loading_dashboard();
  //     }
  //   });
  // }

  // function change_week_progressmeasurement() {
  //   var action = 0;
  //   var date_week_progressmeasurement = $("#date_week_progressmeasurement").val();
  //   new Date(Date.parse(date_week_progressmeasurement)).getDay()
  //   if(new Date(Date.parse(date_week_progressmeasurement)).getDay() == 1){
  //     $('#modal_change_week_progressmeasurement').modal('hide');
  //     week_progressmeasurement = date_week_progressmeasurement;
  //     action = 1;
  //     loading_week_progressmeasurement = 1;
  //     load_data_chart_progress('weekly');
  //   }
  //   else{
  //     sweetalert('error', 'You can only pick mondays');
  //   }
  // }

  // function change_year_progressmeasurement(direction) {
  //   var action = 0;
  //   if(direction == 'kurang' && loading_year_progressmeasurement == 0 && year_progressmeasurement > 2021){
  //     year_progressmeasurement--;
  //     action = 1;
  //   }
  //   else if(direction != 'kurang' && loading_year_progressmeasurement == 0 && year_progressmeasurement < <?= date('Y') ?>){
  //     year_progressmeasurement++;
  //     action = 1;
  //   }
  //   if(action == 1){
  //     loading_year_progressmeasurement = 1;
  //     load_data_chart_progress('monthly');
  //   }
  // }

  function generate_piechart(element, dataset) {
    Highcharts.chart(element, {
      credits: {
        enabled: false,
      },
      chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
      },
      title: {
        text: '',
      },
      accessibility: {
        point: {
          valueSuffix: '%'
        }
      },
      plotOptions: {
        pie: {
          allowPointSelect: true,
          cursor: 'pointer',
          dataLabels: {
            connectorPadding: -3,
            distance: 2,
            enabled: true,
            format: '{point.y:.0f}',
            // style:{
            //   fontSize: '5rem'
            // }
          }
        },
        series: {
          colors: ['#45aaf2', '#26de81', '#d1d8e0']
        }
      },
      tooltip: {
        formatter: function() {
          return this.key + ': ' + this.y + ' Drawing';
        }
      },
      series: [{
        name: '',
        colorByPoint: true,
        // innerSize: '60%',
        data: dataset,
      }]
    });
  }

  function generate_linechart(element, dataset, date_for_week_pm) {
    var category = [];
    if(element == "container_weekly_progress"){
      category = date_for_week_pm;
    }
    else if(element == "container_monthly_progress"){
      category = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'];
    }
    Highcharts.chart(element, {
      exporting: {
        enabled: true
      },
      credits: {
        enabled: false,
      },
      title: {
        text: ''
      },

      yAxis: {
        title: {
          text: 'Persentage (%)'
        },
        visible: false,
      },

      xAxis: {
        categories: category
      },

      legend: {
        layout: 'horizontal',
        align: 'center',
        verticalAlign: 'bottom',
        enabled: false,
      },

      plotOptions: {
        series: {
          label: {
            connectorAllowed: false
          },
          dataLabels: {
            enabled: true,
            allowOverlap: false,
          },
          colors: ['#7ed6df', '#badc58']
          // pointStart: 2010
        }
      },
      // #3bc2d4, #ff706b, #acf39d, #f6ae2d, #33658a
      series: dataset,

      tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
          '<td style="padding:1"><b>{point.y:.2f}% </b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
      },

      responsive: {
        rules: [{
          condition: {
            maxWidth: 500
          },
        }]
      }

    });
  }

  function generate_verticalbarchart(element, dataset) {
    Highcharts.chart(element, {
      credits: {
        enabled: false,
      },
      chart: {
        type: 'column'
      },
      title: {
        text: ''
      },
      xAxis: {
        categories: [
          'PF',
          'FB',
          'AS',
          'ER'
        ],
        crosshair: true
      },
      legend: {
        enabled: false,
      },
      yAxis: {
        min: 0,
        title: {
          text: 'Rainfall (mm)'
        },
        visible: false,
      },
      tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
          '<td style="padding:1"><b>{point.y:.0f} </b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
      },
      plotOptions: {
        column: {
          pointPadding: 0.2,
          borderWidth: 0
        },
        series: {
          dataLabels: {
            enabled: true,
            crop: false,
            overflow: "none"
          }
        },
      },
      series: dataset
    });

  }

  function generate_donutchart(element, dataset) {
    var color_set = ['#d1d8e0', '#26de81'];
    Highcharts.chart(element, {
      exporting: {
        enabled: true
      },
      credits: {
        enabled: false,
      },
      credits: {
        enabled: false,
      },
      chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
      },
      title: {
        text: '',
      },
      tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
      },
      accessibility: {
        point: {
          valueSuffix: '%'
        }
      },
      plotOptions: {
        pie: {
          allowPointSelect: true,
          cursor: 'pointer',
          dataLabels: {
            connectorPadding: -3,
            distance: 2,
            enabled: true,
            crop: false,
            overflow: 'none',
            format: '{point.y:.0f}',
          }
        },
        series:{
          colors: color_set,
        }
      },
      tooltip: {
        formatter: function() {
          return this.key + ', ' + this.y;
        }
      },
      series: [{
        name: '',
        colorByPoint: true,
        innerSize: '60%',
        data: dataset,
      }]
    });
  }

  function generate_horizontalbarchart(element, dataset) {
    $('#'+element).closest('.row').find('.num_fabrication_high').html(dataset.high_num);
    $('#'+element).closest('.row').find('.num_fabrication_witness').html(dataset.witness);
    $('#'+element).closest('.row').find('.num_fabrication_activity').html(dataset.activity);
    categorieset = ['Ready to Submit', 'Pending Approval QC', 'Pending Transmit to Client', 'Pending Approval Client'];
    colorset = ['#d1d8e0', '#fed330', '#26de81', '#a55eea', '#45aaf2'];
    colorset_blur = {
      '#d1d8e0': '#E7EAEE',
      '#fed330': '#FEE99A',
      '#26de81': '#95EEC2',
      '#a55eea': '#CCA5F3',
      '#45aaf2': '#A0D3F8',
    };
    Highcharts.chart(element, {
      exporting: {
        enabled: true
      },
      credits: {
        enabled: false,
      },
      chart: {
        type: 'bar',
        events: {
          load() {
            let chart = this

            chart.series.forEach(s => {
              console.log(s);
              s.points.forEach(p => {
                if(s.index == 1){
                  console.log(p);
                  //get last points
                  p.update({
                    color: colorset_blur[p.color]
                  })
                }
              })
            })
          }
        },
      },
      title: {
        text: ''
      },
      xAxis: {
        categories: categorieset,
        title: {
          text: null
        },
        visible: false,
      },
      yAxis: {
        min: 0,
        title: {
          text: '',
          align: 'high'
        },
        labels: {
          enabled: false,
          overflow: 'justify'
        },
        gridLineWidth: 0,
        minorGridLineWidth: 0,
        // visible: false,
        stackLabels: {
          enabled: true,
          style: {
            fontWeight: 'bold',
            color: ( // theme
              Highcharts.defaultOptions.title.style &&
              Highcharts.defaultOptions.title.style.color
            ) || 'gray'
          }
        },
      },
      // tooltip: {
      //   valueSuffix: ' millions'
      // },
      tooltip: {
        // headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        // pointFormat: '<tr><td style="padding:0">{series.name}: </td>' +
        //   '<td style="padding:1"><b>{point.y:.0f} </b></td></tr>',
        // footerFormat: '</table>',
        shared: true,
      },
      plotOptions: {
        bar: {
          dataLabels: {
            enabled: false
          }
        },
        series: {
          groupPadding: 0.01,
          colorByPoint: true,
          colors: colorset,
          stacking: 'normal',
        }
      },
      legend: {
        enabled: false,
      },
      credits: {
        enabled: false
      },
      series: dataset.data

    });

  }

  function generate_chart_ndt(element, dataset, categories) {
    Highcharts.chart(element, {
      credits: {
        enabled: false,
      },
      chart: {
        type: 'column'
      },
      title: {
        text: ''
      },
      xAxis: {
        categories: categories,
        crosshair: true
      },
      legend: {
        enabled: false,
      },
      yAxis: {
        min: 0,
        title: {
          text: 'Rainfall (mm)'
        },
        visible: false,
      },
      tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
          '<td style="padding:1"><b>{point.y:.0f} </b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
      },
      plotOptions: {
        column: {
          pointPadding: 0.2,
          borderWidth: 0
        },
        series: {
          dataLabels: {
            enabled: true,
            crop: false,
            overflow: "none"
          }
        },
      },
      series: dataset
    });
  }
</script>