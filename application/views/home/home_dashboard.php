<style>
  #content {
    font-size: 0.7rem;
  }

  .font-7 {
    font-size: 0.7rem;
  }

  button.font-7 {
    padding: 0.1rem 0.2rem;
  }

  h1.num_fabrication_high {
    text-align: center;
    font-size: 2.5rem;
    color: #535c68;
    font-weight: bold;
    white-space: nowrap;
  }

  .num_fabrication_subtitle {
    width: 100%;
    text-align: center;
    color: #535c68;
    font-size: 9px;
  }

  .table td,
  .table th {
    padding: 0.25rem;
  }

  .table thead {
    position: sticky;
    top: 0;
  }

  .bg-success-dashboard {
    background-color: #20bf6b;
  }

  .num_fabrication_witness {
    background-color: #2bcbba;
    color: white;
    font-weight: bold;
    padding: 2px;
  }

  .num_fabrication_activity {
    background-color: #4b7bec;
    color: white;
    font-weight: bold;
    padding: 2px;
  }

  .num_fabrication_ndt {
    font-weight: bold;
    padding: 2px;
    border: 1px solid #778ca3;
  }

  .bg-turquoise {
    background-color: #2bcbba;
  }

  .bg-crayola {
    background-color: #4b7bec;
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

  .my-row {
    margin-bottom: 1rem !important;
  }

  /* .height-card{
    height: unset;
  } */
  .height-card {
    max-height: 18rem;
  }

  .chart-wrapper.height-card {
    height: 8rem;
  }

  .chart-wrapper-2.height-card {
    height: 15rem;
  }

  @media (min-width: 768px) {
    .height-card {
      height: 18rem;
    }

    .chart-wrapper.height-card {
      height: 8rem;
    }

    .chart-wrapper-2.height-card {
      height: 15rem;
    }
  }

  .header-percentage {
    background-color: #519ec4;
    color: white
  }

  .header-percentage-footer {
    background-color: #89b3c7;
    color: white;
  }
</style>

<?php ob_start(); ?>
<div class="py-2 h-100">
  <div class="card border-0 shadow-sm h-100">
    <div class="card-body text-white text-center p-0">
      <div class="align-items-center d-flex justify-content-center h-50 bg-turquoise">
        <div>
          <h6 class="text-center">Total Piecemark</h6>
          <h2 class="font-weight-bold text-center" id="total_piecemark">0</h2>
        </div>
      </div>
      <div class="align-items-center d-flex justify-content-center h-50 bg-crayola">
        <div>
          <h6 class="text-center">Weight (Ton)</h6>
          <h2 class="font-weight-bold text-center" id="weight_piecemark">0</h2>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $container_piecemark = ob_get_clean(); ?>

<?php ob_start(); ?>
<div class="py-2 h-100">
  <div class="card border-0 shadow-sm h-100">
    <div class="card-body text-white text-center p-0">
      <div class="align-items-center d-flex justify-content-center h-50 bg-turquoise">
        <div>
          <h6 class="text-center">Total Joint</h6>
          <h2 class="font-weight-bold text-center" id="total_joint">0</h2>
        </div>
      </div>
      <div class="align-items-center d-flex justify-content-center h-50 bg-crayola">
        <div>
          <h6 class="text-center">Weld Length (m)</h6>
          <h2 class="font-weight-bold text-center" id="weld_length_joint">0</h2>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $container_joint = ob_get_clean(); ?>

<?php ob_start(); ?>
<div class="py-2 h-100">
  <div class="card border-0 shadow-sm h-100">
    <div class="card-body bg-white text-center p-2">
      <table class="table table-bordered mb-1">
        <tr class="bg-turquoise text-white">
          <th>Total By</th>
          <th>Template</th>
          <th>MV</th>
          <th>ITR</th>
        </tr>
        <tr>
          <td>Piecemark</td>
          <td id="total_piecemark">0</td>
          <td id="total_material">0</td>
          <td id="total_itr">0</td>
        </tr>
        <tr>
          <td>Weight (ton)</td>
          <td id="weight_piecemark">0</td>
          <td id="weight_material">0</td>
          <td id="weight_itr">0</td>
        </tr>
      </table>
      <table class="table table-bordered m-0">
        <tr class="bg-crayola text-white">
          <th>Total By</th>
          <th>Template</th>
          <th>Fitup</th>
          <th>Visual</th>
        </tr>
        <tr>
          <td>Joints</td>
          <td id="total_joint">0</td>
          <td id="total_fitup">0</td>
          <td id="total_visual">0</td>
        </tr>
        <tr>
          <td>Weld Length (M)</td>
          <td id="weld_length_joint">0</td>
          <td id="weld_length_fitup">0</td>
          <td id="weld_length_visual">0</td>
        </tr>
      </table>
    </div>
  </div>
</div>
<?php $container_template = ob_get_clean(); ?>

<?php ob_start(); ?>
<div class="card border-0 my-2 shadow-sm">
  <div class="card-body bg-white text-center p-2">
    <div class="row">
      <div class="col-md-4">
        <h6 class="text-center">Surveryor MV</h6>
        <div class="chart-wrapper mx-auto height-card" style="position:relative">
          <div id="container_surveyor_mv" style="height: 100%; width: 100%;">
            <div class="text-center loading mt-4">
              <div class="spinner-border" role="status"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <h6 class="text-center">Surveryor FU</h6>
        <div class="chart-wrapper mx-auto height-card" style="position:relative">
          <div id="container_surveyor_fu" style="height: 100%; width: 100%;">
            <div class="text-center loading mt-4">
              <div class="spinner-border" role="status"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <h6 class="text-center">Surveryor VT</h6>
        <div class="chart-wrapper mx-auto height-card" style="position:relative">
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
<?php $container_surveyor_mv = ob_get_clean(); ?>

<?php ob_start(); ?>
<div class="card border-0 my-2 shadow-sm">
  <div class="card-body bg-white text-center p-2">
    <h6 class="text-center">Material</h6>
    <div class="row align-items-center">
      <div class="col-md-8">
        <div class="chart-wrapper mx-auto height-card" style="position:relative">
          <div id="container_material" style="height: 100%; width: 100%;">
            <div class="text-center loading mt-4">
              <div class="spinner-border" role="status"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="overflow-auto">
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
<?php $container_material = ob_get_clean(); ?>

<?php ob_start(); ?>
<div class="card border-0 my-2 shadow-sm">
  <div class="card-body bg-white text-center p-2">
    <h6 class="text-center">Fitup by Joint</h6>
    <div class="row align-items-center">
      <div class="col-md-8">
        <div class="chart-wrapper mx-auto height-card" style="position:relative">
          <div id="container_fitup" style="height: 100%; width: 100%;">
            <div class="text-center loading mt-4">
              <div class="spinner-border" role="status"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="overflow-auto">
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
<?php $container_fitup = ob_get_clean(); ?>

<?php ob_start(); ?>
<div class="card border-0 my-2 shadow-sm">
  <div class="card-body bg-white text-center p-2">
    <h6 class="text-center">Visual by Joint</h6>
    <div class="row align-items-center">
      <div class="col-md-8">
        <div class="chart-wrapper mx-auto height-card" style="position:relative">
          <div id="container_visual" style="height: 100%; width: 100%;">
            <div class="text-center loading mt-4">
              <div class="spinner-border" role="status"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="overflow-auto">
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
<?php $container_visual = ob_get_clean(); ?>

<?php ob_start(); ?>
<div class="card border-0 my-2 shadow-sm">
  <div class="card-body bg-white text-center p-2">
    <h6 class="text-center">Fitup by Weld Length (M)</h6>
    <div class="row align-items-center">
      <div class="col-md-8">
        <div class="chart-wrapper mx-auto height-card" style="position:relative">
          <div id="container_fitup_length" style="height: 100%; width: 100%;">
            <div class="text-center loading mt-4">
              <div class="spinner-border" role="status"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="overflow-auto">
          <h1 class="num_fabrication_high m-0">0</h1>
          <div class="row m-0">
            <div class="col num_fabrication_witness" data-toggle="tooltip" data-placement="bottom" title="Witness">0</div>
            <div class="col num_fabrication_activity" data-toggle="tooltip" data-placement="bottom" title="Activity">0</div>
          </div>
          <span class="num_fabrication_subtitle">Approved Weld Length by Client</span>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $container_fitup_length = ob_get_clean(); ?>

<?php ob_start(); ?>
<div class="card border-0 my-2 shadow-sm">
  <div class="card-body bg-white text-center p-2">
    <h6 class="text-center">Visual by Weld Length (M)</h6>
    <div class="row align-items-center">
      <div class="col-md-8">
        <div class="chart-wrapper mx-auto height-card" style="position:relative">
          <div id="container_visual_length" style="height: 100%; width: 100%;">
            <div class="text-center loading mt-4">
              <div class="spinner-border" role="status"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="overflow-auto">
          <h1 class="num_fabrication_high m-0">0</h1>
          <div class="row m-0">
            <div class="col num_fabrication_witness" data-toggle="tooltip" data-placement="bottom" title="Witness">0</div>
            <div class="col num_fabrication_activity" data-toggle="tooltip" data-placement="bottom" title="Activity">0</div>
          </div>
          <span class="num_fabrication_subtitle">Approved Weld Length by Client</span>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $container_visual_length = ob_get_clean(); ?>

<?php ob_start(); ?>
<div class="card border-0 my-2 shadow-sm">
  <div class="card-body bg-white text-center p-2">
    <h6 class="text-center">Workpack Summary</h6>
    <div class="chart-wrapper-2 mx-auto height-card" style="position:relative">
      <div id="container_workpacksummary" style="height: 100%; width: 100%;">
        <div class="text-center loading mt-4">
          <div class="spinner-border" role="status"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $container_workpacksummary = ob_get_clean(); ?>

<?php ob_start(); ?>
<!-- <div class="card border-0 my-2 shadow-sm">
    <div class="card-body bg-white text-center p-2">
      <h6 class="text-center">NDT</h6>
      <div class="row align-items-center">
        <div class="col-12">
          <div class="chart-wrapper-2 mx-auto height-card" style="position:relative">
            <div id="container_ndt" style="height: 100%; width: 100%;">
                  <div class="text-center loading mt-4">
                <div class="spinner-border" role="status"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> -->
<?php $container_ndt = ob_get_clean(); ?>

<?php ob_start(); ?>
<div class="card border-0 my-2 shadow-sm">
  <div class="card-body bg-white text-center p-2">
    <h6 class="text-center">Workpack Manhours</h6>
    <div class="mx-auto overflow-auto height-card" style="position:relative" id="container_manhours">
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
<?php $container_manhours = ob_get_clean(); ?>

<?php ob_start(); ?>
<div class="card border-0 my-2 shadow-sm">
  <div class="card-body bg-white text-center p-2">
    <h6 class="text-center">Backlog NDT</h6>
    <div class="mx-auto overflow-auto height-card" style="position:relative" id="container_backlog">
      <table class="table table-bordered">
        <thead>
          <tr class="bg-success-dashboard text-white">
            <th>NDT Type</th>
            <th>Total Request</th>
            <th>Total Have Status</th>
            <th>Total Backlog NDT</th>
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
<?php $container_backlog = ob_get_clean(); ?>

<?php ob_start(); ?>
<div class="card border-0 my-2 shadow-sm">
  <div class="card-body bg-white text-center p-2">
    <h6 class="text-center">Status Surveyor Structural</h6>
    <div class="mx-auto overflow-auto height-card" style="position:relative" id="container_status_surveyor_2">
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
<?php $container_status_surveyor_2 = ob_get_clean(); ?>

<?php ob_start(); ?>
<div class="card border-0 my-2 shadow-sm">
  <div class="card-body bg-white text-center p-2">
    <h6 class="text-center">Status Surveyor Piping</h6>
    <div class="mx-auto overflow-auto height-card" style="position:relative" id="container_status_surveyor_1">
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
<?php $container_status_surveyor_1 = ob_get_clean(); ?>

<div id="content" class="container-fluid">
  <div class="bg-white p-3 shadow-sm my-2">
    <h4 class="text-center font-weight-bold mt-0 mb-3">Production & Quality Dashboard</h4>
    <?= $tabmenu ?>
  </div>

  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

      <div class="row">
        <div class="col-md-4">
          <?= $container_template ?>
        </div>
        <div class="col-md-4">
          <?= $container_fitup ?>
        </div>
        <div class="col-md-4">
          <?= $container_fitup_length ?>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4">
          <!-- <div class="row">
            <div class="col-md-12">
              <?= $container_surveyor_mv ?>
            </div>
          </div> -->
          <div class="row">
            <div class="col-md-12">
              <?= $container_material ?>
            </div>
          </div>
        </div>

        <div class="col-md-8">
          <div class="row">
            <div class="col-md-6">
              <?= $container_visual ?>
            </div>
            <div class="col-md-6">
              <?= $container_visual_length ?>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <?= $container_ndt ?>
            </div>
            <?php // if($this->input->get('project') != 21) : 
            ?>
            <!-- <div class="col-md-6">
							<?= $container_manhours ?>
            </div> -->
            <?php // endif; 
            ?>

            <!-- <div><?php // if($this->input->get('project') == 21) : 
                      ?>
            <div class="col-md-6">
            <?= $container_backlog ?>
            </div>
            <?php //  endif; 
            ?></div> -->

          </div>
        </div>

        <?php if ($this->user_cookie[11] == 1) : ?>
          <div class="col-md-4">
            <?php //echo $container_status_surveyor_2 
            ?>
          </div>
          <div class="col-md-4">
            <?php //echo $container_status_surveyor_1 
            ?>
          </div>
        <?php endif; ?>

      </div>

        <div class="row">
          <div class="col-md-12">
            <div id="accordion">
              <div class="card border-0 shadow">
                <div class="card-header m-0 font-weight-bold bg-seatrium-blue text-white">
                  <div class="row">
                    <div class="col-6  mt-2">INSPECTION PROGRESS PERCENTAGE</div>
                    <div class="col-6 text-right">
                      <button class="btn btn-light btn-sm collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="fas fa-caret-down"></i></button>

                    </div>
                  </div>
                </div>
                <div class="card-body collapse" id="collapseOne" aria-labelledby="headingOne" data-parent="#accordion">
                  <ul class="nav nav-pills font-weight-bold" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="mvr-percentage-tab" data-toggle="tab" href="#mvr-percentage" role="tab" aria-controls="mvr-percentage" aria-selected="true">MVR</a>
                    </li>

                    <li class="nav-item">
                      <a class="nav-link" id="fitup-percentage-tab" data-toggle="tab" href="#fitup-percentage" role="tab" aria-controls="fitup-percentage" aria-selected="true">Fit-Up</a>
                    </li>

                    <li class="nav-item">
                      <a class="nav-link" id="visual-percentage-tab" data-toggle="tab" href="#visual-percentage" role="tab" aria-controls="visual-percentage" aria-selected="true">Visual</a>
                    </li>

                  </ul>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="mvr-percentage" role="tabpanel" aria-labelledby="mvr-percentage-tab">
                          <div class="row mt-3">
                            <div class="col-md-12">
                              <div class="percentage_mvr spinner"></div>
                            </div>
                          </div>
                        </div>

                        <div class="tab-pane fade" id="fitup-percentage" role="tabpanel" aria-labelledby="fitup-percentage-tab">
                          <div class="row mt-3">
                            <div class="col-md-12">
                              <div class="percentage_ft spinner"></div>
                            </div>
                          </div>
                        </div>

                        <div class="tab-pane fade" id="visual-percentage" role="tabpanel" aria-labelledby="visual-percentage-tab">
                          <div class="row mt-3">
                            <div class="col-md-12">
                              <div class="percentage_vs spinner"></div>

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
  $(document).ready(function() {
    loading_dashboard();
  });

  function loading_dashboard() {
    section++;
    if (section == 0) {
      load_data_template();
    } else if (section == 1) {
      load_data_workpack_summary();
    }
    // else if(section == 2){
    //   load_data_surveyor();
    // }
    // else if(section == 2){
    //   <?php // if($this->input->get('project') != 21) : 
          ?>
    //   load_data_manhours();
    //   <?php // else: 
          ?>
    //   // load_data_backlog();
    //   <?php // endif; 
          ?>
    // }
    else if (section == 2) {
      load_data_fabrication('material');
    } else if (section == 3) {
      load_data_fabrication('fitup');
    } else if (section == 4) {
      load_data_fabrication('visual');
    } else if (section == 5) {
      load_data_ndt();
    } else if (section == 6) {
      <?php if ($this->user_cookie[11] == 1) : ?>
        // load_data_status_surveyor(2);
        loading_dashboard();
      <?php else : ?>
        loading_dashboard();
      <?php endif; ?>
      // loading_dashboard();
    } else if (section == 7) {
      <?php if ($this->user_cookie[11] == 1) : ?>
        // load_data_status_surveyor(1);
        loading_dashboard();
      <?php else : ?>
        loading_dashboard();
      <?php endif; ?>
      // loading_dashboard();
    }
    // else if(section == 10){
    // load_data_progressmeasurement();
    // }
    // else if(section == 11){
    //   load_data_chart_progress('weekly');
    // }
    // else if(section == 12){
    //   load_data_chart_progress('monthly');
    // }
  }

  function load_data_status_surveyor(discipline) {
    $.ajax({
      url: '<?php echo base_url() ?>home/load_data_status_surveyor/' + discipline,
      type: 'GET',
      async: true,
      // dataType: "json",
      success: function(data) {
        data = JSON.parse(data)
        console.log(data)
        $("#container_status_surveyor_" + discipline).find("tbody.fitup_data").html(data.fitup)
        $("#container_status_surveyor_" + discipline).find("tbody.visual_data").html(data.visual)
        loading_dashboard();
      }
    });
  }

  function load_data_workpack_summary() {
    // $.ajax({
    //   url: '<?php echo base_url() ?>home/load_data_workpack_summary',
    //   type: 'GET',
    // 	data:{
    // 		project: <?= ($this->input->get('project') ?? $this->user_cookie[10]) ?>
    // 	},
    //   async: true,
    //   dataType: "json",
    //   success: function (data) {
    //     generate_verticalbarchart("container_workpacksummary", data);
    //     loading_dashboard();
    //   }
    // });
    loading_dashboard();
  }

  function load_data_fabrication(process = 'material') {
    $.ajax({
      url: '<?php echo base_url() ?>home/load_data_fabrication_weld_length',
      data: {
        process: process,
        project: <?= ($this->input->get('project') ?? $this->user_cookie[10]) ?>,
        company: <?= ($this->input->get('company') ?? $this->user_cookie[11]) ?>
      },
      type: 'GET',
      async: true,
      dataType: "json",
      success: function(data) {
        generate_horizontalbarchart("container_" + process, data[process]);
        if (process != 'material') {
          generate_horizontalbarchart("container_" + process + "_length", data[process + "_length"]);
        }
        loading_dashboard();
      }
    });
  }

  function load_data_ndt() {
    $.ajax({
      url: '<?php echo base_url() ?>home/load_data_ndt',
      type: 'GET',
      data: {
        project: <?= ($this->input->get('project') ?? $this->user_cookie[10]) ?>
      },
      async: true,
      dataType: "json",
      success: function(data) {
        generate_chart_ndt("container_ndt", data.data, data.categories);
        loading_dashboard();
      }
    });
  }

  function load_data_surveyor() {
    $.ajax({
      url: '<?php echo base_url() ?>home/load_data_surveyor',
      type: 'GET',
      data: {
        project: <?= ($this->input->get('project') ?? $this->user_cookie[10]) ?>,
        company: <?= ($this->input->get('company') ?? $this->user_cookie[11]) ?>
      },
      async: true,
      dataType: "json",
      success: function(data) {
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
      type: 'get',
      async: true,
      data: {
        project: <?= ($this->input->get('project') ?? $this->user_cookie[10]) ?>,
        company: <?= ($this->input->get('company') ?? $this->user_cookie[11]) ?>
      },
      // dataType: "json",
      success: function(data) {
        $("#container_manhours").find("tbody").html(data);
        $("#container_manhours").find(".loading").addClass("d-none");
        loading_dashboard();
      }
    });
  }

  function load_data_backlog() {
    $.ajax({
      url: '<?php echo base_url() ?>home/load_data_backlog_ndt',
      type: 'get',
      async: true,
      data: {
        project: <?= ($this->input->get('project') ?? $this->user_cookie[10]) ?>
      },
      // dataType: "json",
      success: function(data) {
        $("#container_backlog").find("tbody").html(data);
        $("#container_backlog").find(".loading").addClass("d-none");
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
        level: 'level_' + level_progressmeasurement,
      },
      success: function(data) {
        $("#container_progressmeasurement_level_" + level_progressmeasurement).find("tbody").html(data);
        $("#container_progressmeasurement").find(".loading").addClass("d-none");
        loading_level_progressmeasurement = 0;
        loading_dashboard();
      }
    });
  }

  function change_level_progressmeasurement(direction) {
    var action = 0;
    if (direction == 'kurang' && loading_level_progressmeasurement == 0 && level_progressmeasurement > 2) {
      level_progressmeasurement--;
      action = 1;
    } else if (direction != 'kurang' && loading_level_progressmeasurement == 0 && level_progressmeasurement < 4) {
      level_progressmeasurement++;
      action = 1;
    }
    if (action == 1) {
      loading_level_progressmeasurement = 1;
      $('#text_level_progressmeasurement').html(level_progressmeasurement);
      $("#container_progressmeasurement").find(".loading").removeClass("d-none");

      $("#container_progressmeasurement_level_2").addClass("d-none");
      $("#container_progressmeasurement_level_3").addClass("d-none");
      $("#container_progressmeasurement_level_4").addClass("d-none");
      $("#container_progressmeasurement_level_" + level_progressmeasurement).removeClass("d-none");
      $("#container_progressmeasurement_level_" + level_progressmeasurement).find("tbody").html('');

      load_data_progressmeasurement();
    }
  }

  function load_data_template() {
    $.ajax({
      url: '<?php echo base_url() ?>home/load_data_template_new',
      type: 'GET',
      async: true,
      dataType: "json",
      data: {
        project: <?= ($this->input->get('project') ?? $this->user_cookie[10]) ?>,
        company: <?= ($this->input->get('company') ?? $this->user_cookie[11]) ?>
      },
      success: function(data) {
        $('#total_piecemark').text(data.total_piecemark);
        $('#weight_piecemark').text(data.weight_piecemark);
        $('#total_material').text(data.total_material);
        $('#weight_material').text(data.weight_material);
        $('#total_itr').text(data.total_itr);
        $('#weight_itr').text(data.weight_itr);
        $('#total_joint').text(data.total_joint);
        $('#weld_length_joint').text(data.weld_length_joint);
        $('#total_fitup').text(data.total_fitup);
        $('#weld_length_fitup').text(data.weld_length_fitup);
        $('#total_visual').text(data.total_visual);
        $('#weld_length_visual').text(data.weld_length_visual);
        // generate_piechart("container_piecemark", data.piecemark);
        // generate_piechart("container_joint", data.joint);
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
    if (element == "container_weekly_progress") {
      category = date_for_week_pm;
    } else if (element == "container_monthly_progress") {
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
        series: {
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
    $('#' + element).closest('.row').find('.num_fabrication_high').html(dataset.high_num);
    $('#' + element).closest('.row').find('.num_fabrication_witness').html(dataset.witness);
    $('#' + element).closest('.row').find('.num_fabrication_activity').html(dataset.activity);
    categorieset = ['Ready to Submit', 'Pending Approval QC', 'Pending Transmit to Client', 'Transmitted to Client'];
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
                if (s.index == 1) {
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

  const Loading = () => {
    return `<div class="text-center loading mt-4"><div class="spinner-border" role="status"></div></div>`
  }

    function load_inspection_progress() {
      $('.spinner').html(Loading)
      load_mv_inspection_progress()
      load_ft_inspection_progress()
      load_vs_inspection_progress()
    }

    function load_mv_inspection_progress() {
      $.ajax({
        url: "<?= site_url('home/load_mv_inspection_progress') ?>",
        type: "POST",
        data: {
          project: <?= ($this->input->get('project') ?? $this->user_cookie[10]) ?>,
          company: <?= ($this->input->get('company') ?? $this->user_cookie[11]) ?>
        },
        success: function(data) {
          $('.percentage_mvr').html(data)
        }
      })
    }

    function load_ft_inspection_progress() {
      $.ajax({
        url: "<?= site_url('home/load_ft_inspection_progress') ?>",
        type: "POST",
        data: {
          project: <?= ($this->input->get('project') ?? $this->user_cookie[10]) ?>,
          company: <?= ($this->input->get('company') ?? $this->user_cookie[11]) ?>
        },
        success: function(data) {
          $('.percentage_ft').html(data)
        }
      })
    }

    function load_vs_inspection_progress() {
      $.ajax({
        url: "<?= site_url('home/load_vs_inspection_progress') ?>",
        type: "POST",
        data: {
          project: <?= ($this->input->get('project') ?? $this->user_cookie[10]) ?>,
          company: <?= ($this->input->get('company') ?? $this->user_cookie[11]) ?>
        },
        success: function(data) {
          $('.percentage_vs').html(data)
        }
      })
    }

    load_inspection_progress()
  
</script>