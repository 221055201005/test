<style>
  #content{
    /* font-size: 0.7rem; */
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
    font-size: 0.7rem;
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

  .nav-pills.min-width-100 .nav-link {
    min-width: 100px;
  }

  .container_surveyor{
    height: 150px;
    width: 150px;
    border: 15px solid #000;
    border-radius: 50%;
  }
</style>
<div id="content" class="container-fluid">
  <div class="bg-white p-3 shadow-sm">
    <h4 class="text-center font-weight-bold">Production & Quality Dashboard</h4>
    <?= $tabmenu ?>
  </div>
  <br/>

  <div class="row">
    <div class="col-md-12">
      <div class="card my-2 border-0 shadow-sm">
        <div class="card-body bg-white text-center p-2">
          <form>
            <div class="row">
              <div class="col-md-3">
                <input name="date_from" class="form-control" type="date" value="<?= (@$get['date_from'] != "" ? @$get['date_from'] : date("Y-m-d")) ?>" required>
              </div>
              <div class="col-md-auto">
                <span style="font-size: 1rem;">To</span>
              </div>
              <div class="col-md-3">
                <input name="date_to" class="form-control" type="date" value="<?= (@$get['date_to'] != "" ? @$get['date_to'] : date("Y-m-d")) ?>" required>
              </div>
              <input name="category" type="hidden" value="<?= @$get['category'] ?>">
              <div class="col-md text-left">
                <button class="btn btn-info btn-sm btn-flat">Search</button>
              </div>
              <div class="col-md text-right">
                <a target="_blank" href="<?= base_url() ?>home/kpi_user_pcms/<?= $get['date_from'] ?>/<?= $get['date_to'] ?>" class="btn btn-success btn-sm btn-flat">Download Excel</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-6 col-md-6">
      <div class="card my-3 border-0 shadow-sm" style="height: calc(100% - 2rem)">
        <div class="card-body bg-white text-center p-3">
          <ul class="nav nav-pills min-width-100 justify-content-center font-weight-bold" id="myTab" role="tablist"> 
            <li class="nav-item">
              <a class="nav-link active" data-toggle="pill" href="#pills-overall" role="tab" aria-controls="pills-overall">Overall</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="pill" href="#pills-user" role="tab" aria-controls="pills-user">KPI Input Data</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="pill" href="#pills-user_revise" role="tab" aria-controls="pills-user_revise">KPI Revise Data</a>
            </li>
          </ul>
          <br>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-overall" role="tabpanel" aria-labelledby="pills-overall-tab">
              <div class="row">
                <div class="col-md">
                  <h6 class="text-center">Total Inputed Template</h6>
                  <div class="chart-wrapper mx-auto">
                    <div id="container_template" style="height: 100%">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <h6 class="text-center">Total Revise Template</h6>
                  <div class="chart-wrapper mx-auto">
                    <div id="container_template_r" style="height: 100%">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="pills-user" role="tabpanel" aria-labelledby="pills-user-tab">
              <div class="row">
                <div class="col-md">
                  <h6 class="text-center">Total Inputed Piecemark</h6>
                  <div class="chart-wrapper mx-auto">
                    <div id="container_piecemark_user">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <h6 class="text-center">Total Inputed Joint</h6>
                  <div class="chart-wrapper mx-auto">
                    <div id="container_joint_user">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="pills-user_revise" role="tabpanel" aria-labelledby="pills-user_revise-tab">
              <div class="row">
                <div class="col-md">
                  <h6 class="text-center">Total Inputed Piecemark</h6>
                  <div class="chart-wrapper mx-auto">
                    <div id="container_piecemark_r_user">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <h6 class="text-center">Total Inputed Joint</h6>
                  <div class="chart-wrapper mx-auto">
                    <div id="container_joint_r_user">
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
    <div class="col-lg-6 col-md-6">
      <div class="card my-3 border-0 shadow-sm" style="height: calc(100% - 2rem)">
        <div class="card-header bg-white">
          <h6 class="m-0 text-center">KPI PCMS TEAM</h6>
        </div>
        <div class="card-body bg-white text-center p-3">
          <div class="table-responsive overflow-auto">
            <table class="table table-hover text-center datatables">
              <thead class="bg-green-smoe text-white">
                <tr>
                  <th>Name</th>
                  <th>Total Input Piecemark</th>
                  <th>Total Revise Piecemark</th>
                  <th>Total Input Joint</th>
                  <th>Total Revise Joint</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  foreach ($template_data as $key => $value): 
                    @$chart_piecemark_user[] = [
                      "name" => @$user_list[$key],
                      "y" => @$value['piecemark']+0,
                    ];
                    @$chart_joint_user[] = [
                      "name" => @$user_list[$key],
                      "y" => @$value['joint']+0,
                    ];
                    @$chart_piecemark_r_user[] = [
                      "name" => @$user_list[$key],
                      "y" => @$value['piecemark_r']+0,
                    ];
                    @$chart_joint_r_user[] = [
                      "name" => @$user_list[$key],
                      "y" => @$value['joint_r']+0,
                    ];
                ?>
                  <tr>
                    <td><?= @$user_list[$key] ?></td>
                    <td><?= @$value['piecemark']+0 ?></td>
                    <td><?= @$value['piecemark_r']+0 ?></td>
                    <td><?= @$value['joint']+0 ?></td>
                    <td><?= @$value['joint_r']+0 ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-12 col-md-6">
      <div class="card my-3 border-0 shadow-sm" style="height: calc(100% - 2rem)">
        <div class="card-body bg-white text-center p-3">
          <ul class="nav nav-pills min-width-100 justify-content-center font-weight-bold" id="myTab" role="tablist"> 
            <li class="nav-item">
              <a class="nav-link active" data-toggle="pill" href="#pills-surveyor-overall" role="tab" aria-controls="pills-surveyor-overall">Overall</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="pill" href="#pills-surveyor-web" role="tab" aria-controls="pills-surveyor-web">KPI Web</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="pill" href="#pills-surveyor-mobile" role="tab" aria-controls="pills-surveyor-mobile">KPI Mobile</a>
            </li>
          </ul>
          <br>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-surveyor-overall" role="tabpanel" aria-labelledby="pills-surveyor-overall-tab">
              <div class="row">
                <div class="col-md">
                  <h6 class="text-center">Total Input Progress Material</h6>
                  <div class="chart-wrapper mx-auto">
                    <div id="container_surveyor_mv" style="height: 200px;">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <h6 class="text-center">Total Input Progress Fitup</h6>
                  <div class="chart-wrapper mx-auto">
                    <div id="container_surveyor_fu" style="height: 200px;">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <h6 class="text-center">Total Input Progress Visual</h6>
                  <div class="chart-wrapper mx-auto">
                    <div id="container_surveyor_vt" style="height: 200px;">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <h6 class="text-center">Total Input Progress ITR</h6>
                  <div class="chart-wrapper mx-auto">
                    <div id="container_surveyor_itr" style="height: 200px;">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="pills-surveyor-web" role="tabpanel" aria-labelledby="pills-surveyor-web-tab">
              <div class="row">
                <div class="col-md">
                  <h6 class="text-center">Total Input Progress Material</h6>
                  <div class="chart-wrapper mx-auto" style="height: 200px; position: relative;">
                    <div id="container_surveyor_mv_web" style="height: 100%; width: 100%;">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <h6 class="text-center">Total Input Progress Fitup</h6>
                  <div class="chart-wrapper mx-auto" style="height: 200px; position: relative;">
                    <div id="container_surveyor_fu_web" style="height: 100%; width: 100%;">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <h6 class="text-center">Total Input Progress Visual</h6>
                  <div class="chart-wrapper mx-auto" style="height: 200px; position: relative;">
                    <div id="container_surveyor_vt_web" style="height: 100%; width: 100%;">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <h6 class="text-center">Total Input Progress ITR</h6>
                  <div class="chart-wrapper mx-auto" style="height: 200px; position: relative;">
                    <div id="container_surveyor_itr_web" style="height: 100%; width: 100%;">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="pills-surveyor-mobile" role="tabpanel" aria-labelledby="pills-surveyor-mobile-tab">
              <div class="row">
                <div class="col-md">
                  <h6 class="text-center">Total Input Progress Material</h6>
                  <div class="chart-wrapper mx-auto" style="height: 200px; position: relative;">
                    <div id="container_surveyor_mv_mobile" style="height: 100%; width: 100%;">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <h6 class="text-center">Total Input Progress Fitup</h6>
                  <div class="chart-wrapper mx-auto" style="height: 200px; position: relative;">
                    <div id="container_surveyor_fu_mobile" style="height: 100%; width: 100%;">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <h6 class="text-center">Total Input Progress Visual</h6>
                  <div class="chart-wrapper mx-auto" style="height: 200px; position: relative;">
                    <div id="container_surveyor_vt_mobile" style="height: 100%; width: 100%;">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <h6 class="text-center">Total Input Progress ITR</h6>
                  <div class="chart-wrapper mx-auto" style="height: 200px; position: relative;">
                    <div id="container_surveyor_itr_mobile" style="height: 100%; width: 100%;">
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
    <div class="col-lg-12 col-md-6">
      <div class="card my-3 border-0 shadow-sm" style="height: calc(100% - 2rem)">
        <div class="card-header bg-white">
          <h6 class="m-0 text-center">KPI SURVEYOR</h6>
        </div>
        <div class="card-body bg-white text-center p-3">
          <div class="table-responsive overflow-auto">
            <table class="table table-hover text-center datatables">
              <thead class="bg-green-smoe text-white">
                <tr>
                  <th>Name</th>
                  <th>Total Progress Material (Web)</th>
                  <th>Total Progress Material (Mobile)</th>
                  <th>Total Progress Fitup (Web)</th>
                  <th>Total Progress Fitup (Mobile)</th>
                  <th>Total Progress Visual (Web)</th>
                  <th>Total Progress Visual (Mobile)</th>
                  <th>Total Progress ITR (Web)</th>
                  <th>Total Progress ITR (Mobile)</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  foreach ($surveyor_data as $key => $value): 
                    @$chart_surveyor_user_web['mv'][] = [
                      "name" => @$user_list[$key],
                      "y" => @$value['mv1']+0,
                    ];
                    @$chart_surveyor_user_web['fu'][] = [
                      "name" => @$user_list[$key],
                      "y" => @$value['fu1']+0,
                    ];
                    @$chart_surveyor_user_web['vt'][] = [
                      "name" => @$user_list[$key],
                      "y" => @$value['vt1']+0,
                    ];
                    @$chart_surveyor_user_web['itr'][] = [
                      "name" => @$user_list[$key],
                      "y" => @$value['itr1']+0,
                    ];
                    @$chart_surveyor_user_mobile['mv'][] = [
                      "name" => @$user_list[$key],
                      "y" => @$value['mv2']+0,
                    ];
                    @$chart_surveyor_user_mobile['fu'][] = [
                      "name" => @$user_list[$key],
                      "y" => @$value['fu2']+0,
                    ];
                    @$chart_surveyor_user_mobile['vt'][] = [
                      "name" => @$user_list[$key],
                      "y" => @$value['vt2']+0,
                    ];
                    @$chart_surveyor_user_mobile['itr'][] = [
                      "name" => @$user_list[$key],
                      "y" => @$value['itr2']+0,
                    ];
                ?>
                  <tr>
                    <td><?= @$user_list[$key] ?></td>
                    <td><?= @$value['mv1']+0 ?></td>
                    <td><?= @$value['mv2']+0 ?></td>
                    <td><?= @$value['fu1']+0 ?></td>
                    <td><?= @$value['fu2']+0 ?></td>
                    <td><?= @$value['vt1']+0 ?></td>
                    <td><?= @$value['vt2']+0 ?></td>
                    <td><?= @$value['itr1']+0 ?></td>
                    <td><?= @$value['itr2']+0 ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-md-6">
      <div class="card my-3 border-0 shadow-sm" style="height: calc(100% - 2rem)">
        <div class="card-body bg-white text-center p-3">
          <ul class="nav nav-pills min-width-100 justify-content-center font-weight-bold" id="myTab" role="tablist"> 
            <li class="nav-item">
              <a class="nav-link active" data-toggle="pill" href="#pills-overall-workpack" role="tab" aria-controls="pills-overall-workpack">Overall</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="pill" href="#pills-workpack-create" role="tab" aria-controls="pills-workpack-create">KPI Create Workpack</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="pill" href="#pills-workpack-revise" role="tab" aria-controls="pills-workpack-revise">KPI Revise Workpack</a>
            </li>
          </ul>
          <br>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-overall-workpack" role="tabpanel" aria-labelledby="pills-overall-workpack-tab">
              <div class="row">
                <div class="col-md">
                  <h6 class="text-center">Total Inputed Workpack</h6>
                  <div class="chart-wrapper mx-auto">
                    <div id="container_workpack" style="height: 200px;">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="pills-workpack-create" role="tabpanel" aria-labelledby="pills-workpack-create-tab">
              <div class="row">
                <div class="col-md">
                  <h6 class="text-center">Total Create Workpack</h6>
                  <div class="chart-wrapper mx-auto">
                    <div id="container_workpack_create" style="height: 200px;">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="pills-workpack-revise" role="tabpanel" aria-labelledby="pills-workpack-revise-tab">
              <div class="row">
                <div class="col-md">
                  <h6 class="text-center">Total Revise Workpack</h6>
                  <div class="chart-wrapper mx-auto">
                    <div id="container_workpack_revise" style="height: 200px;">
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
    <div class="col-lg-6 col-md-6">
      <div class="card my-3 border-0 shadow-sm" style="height: calc(100% - 2rem)">
        <div class="card-header bg-white">
          <h6 class="m-0 text-center">KPI PLANNING</h6>
        </div>
        <div class="card-body bg-white text-center p-3">
          <div class="table-responsive overflow-auto">
            <table class="table table-hover text-center datatables">
              <thead class="bg-green-smoe text-white">
                <tr>
                  <th>Name</th>
                  <th>Total Create Workpack</th>
                  <th>Total Revise Workpack</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  foreach (@$workpack_data as $key => $value): 
                    @$chart_create_workpack_user[] = [
                      "name" => @$user_list[$key],
                      "y" => @$value['create']+0,
                    ];
                    @$chart_revise_workpack_user[] = [
                      "name" => @$user_list[$key],
                      "y" => @$value['revise']+0,
                    ];
                ?>
                  <tr>
                    <td><?= @$user_list[$key] ?></td>
                    <td><?= @$value['create']+0 ?></td>
                    <td><?= @$value['revise']+0 ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6">
      <div class="card my-3 border-0 shadow-sm" style="height: calc(100% - 2rem)">
        <div class="card-body bg-white text-center p-3">
          <ul class="nav nav-pills min-width-100 justify-content-center font-weight-bold" id="myTab" role="tablist"> 
            <li class="nav-item">
              <a class="nav-link active" data-toggle="pill" href="#pills-pmt-overall" role="tab" aria-controls="pills-pmt-overall">Overall</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="pill" href="#pills-pmt-submit" role="tab" aria-controls="pills-pmt-submit">KPI Submit RFI</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="pill" href="#pills-pmt-revise" role="tab" aria-controls="pills-pmt-revise">KPI Revise RFI</a>
            </li>
          </ul>
          <br>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-pmt-overall" role="tabpanel" aria-labelledby="pills-pmt-overall-tab">
              <div class="row">
                <div class="col-md">
                  <h6 class="text-center">Total Submit & Revise RFI Material</h6>
                  <div class="chart-wrapper mx-auto">
                    <div id="container_pmt_mv" style="height: 200px;">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md">
                  <h6 class="text-center">Total Submit & Revise RFI Fitup</h6>
                  <div class="chart-wrapper mx-auto">
                    <div id="container_pmt_fu" style="height: 200px;">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md">
                  <h6 class="text-center">Total Submit & Revise RFI Visual</h6>
                  <div class="chart-wrapper mx-auto">
                    <div id="container_pmt_vt" style="height: 200px;">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="pills-pmt-submit" role="tabpanel" aria-labelledby="pills-pmt-submit-tab">
              <div class="row">
                <div class="col-md">
                  <h6 class="text-center">Total Submit RFI Material</h6>
                  <div class="chart-wrapper mx-auto" style="height: 200px; position: relative;">
                    <div id="container_pmt_mv_submit" style="height: 100%; width: 100%;">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md">
                  <h6 class="text-center">Total Submit RFI Fitup</h6>
                  <div class="chart-wrapper mx-auto" style="height: 200px; position: relative;">
                    <div id="container_pmt_fu_submit" style="height: 100%; width: 100%;">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md">
                  <h6 class="text-center">Total Submit RFI Visual</h6>
                  <div class="chart-wrapper mx-auto" style="height: 200px; position: relative;">
                    <div id="container_pmt_vt_submit" style="height: 100%; width: 100%;">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="pills-pmt-revise" role="tabpanel" aria-labelledby="pills-pmt-revise-tab">
              <div class="row">
                <div class="col-md">
                  <h6 class="text-center">Total Revise RFI Material</h6>
                  <div class="chart-wrapper mx-auto" style="height: 200px; position: relative;">
                    <div id="container_pmt_mv_revise" style="height: 100%; width: 100%;">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md">
                  <h6 class="text-center">Total Revise RFI Fitup</h6>
                  <div class="chart-wrapper mx-auto" style="height: 200px; position: relative;">
                    <div id="container_pmt_fu_revise" style="height: 100%; width: 100%;">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md">
                  <h6 class="text-center">Total Revise RFI Visual</h6>
                  <div class="chart-wrapper mx-auto" style="height: 200px; position: relative;">
                    <div id="container_pmt_vt_revise" style="height: 100%; width: 100%;">
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
    <div class="col-lg-8 col-md-6">
      <div class="card my-3 border-0 shadow-sm" style="height: calc(100% - 2rem)">
        <div class="card-header bg-white">
          <h6 class="m-0 text-center">KPI PMT DOCUMENT CONTROL</h6>
        </div>
        <div class="card-body bg-white text-center p-3">
          <div class="table-responsive overflow-auto">
            <table class="table table-hover text-center datatables">
              <thead class="bg-green-smoe text-white">
                <tr>
                  <th>Name</th>
                  <th>Total Submit RFI Material</th>
                  <th>Total Revise RFI Material</th>
                  <th>Total Submit RFI Fitup</th>
                  <th>Total Revise RFI Fitup</th>
                  <th>Total Submit RFI Visual</th>
                  <th>Total Revise RFI Visual</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  foreach ($pmt_data as $key => $value): 
                    @$chart_pmt_submit_user['mv'][] = [
                      "name" => @$user_list[$key],
                      "y" => @$value['mv']['submit']+0,
                    ];
                    @$chart_pmt_revise_user['mv'][] = [
                      "name" => @$user_list[$key],
                      "y" => @$value['mv']['revise']+0,
                    ];
                    @$chart_pmt_submit_user['fu'][] = [
                      "name" => @$user_list[$key],
                      "y" => @$value['fu']['submit']+0,
                    ];
                    @$chart_pmt_revise_user['fu'][] = [
                      "name" => @$user_list[$key],
                      "y" => @$value['fu']['revise']+0,
                    ];
                    @$chart_pmt_submit_user['vt'][] = [
                      "name" => @$user_list[$key],
                      "y" => @$value['vt']['submit']+0,
                    ];
                    @$chart_pmt_revise_user['vt'][] = [
                      "name" => @$user_list[$key],
                      "y" => @$value['vt']['revise']+0,
                    ];
                ?>
                  <tr>
                    <td><?= @$user_list[$key] ?></td>
                    <td><?= @$value['mv']['submit']+0 ?></td>
                    <td><?= @$value['mv']['revise']+0 ?></td>
                    <td><?= @$value['fu']['submit']+0 ?></td>
                    <td><?= @$value['fu']['revise']+0 ?></td>
                    <td><?= @$value['vt']['submit']+0 ?></td>
                    <td><?= @$value['vt']['revise']+0 ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6">
      <div class="card my-3 border-0 shadow-sm" style="height: calc(100% - 2rem)">
        <div class="card-body bg-white text-center p-3">
          <ul class="nav nav-pills min-width-100 justify-content-center font-weight-bold" id="myTab" role="tablist"> 
            <li class="nav-item">
              <a class="nav-link active" data-toggle="pill" href="#pills-qc-overall" role="tab" aria-controls="pills-qc-overall">Overall</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="pill" href="#pills-qc-inspect" role="tab" aria-controls="pills-qc-inspect">KPI Inspect RFI</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="pill" href="#pills-qc-transmit" role="tab" aria-controls="pills-qc-transmit">KPI Transmit RFI</a>
            </li>
          </ul>
          <br>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-qc-overall" role="tabpanel" aria-labelledby="pills-qc-overall-tab">
              <div class="row">
                <div class="col-md">
                  <h6 class="text-center">Total Inspect & Transmit RFI Material</h6>
                  <div class="chart-wrapper mx-auto">
                    <div id="container_qc_mv" style="height: 200px;">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md">
                  <h6 class="text-center">Total Inspect & Transmit RFI Fitup</h6>
                  <div class="chart-wrapper mx-auto">
                    <div id="container_qc_fu" style="height: 200px;">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md">
                  <h6 class="text-center">Total Inspect & Transmit RFI Visual</h6>
                  <div class="chart-wrapper mx-auto">
                    <div id="container_qc_vt" style="height: 200px;">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="pills-qc-inspect" role="tabpanel" aria-labelledby="pills-qc-inspect-tab">
              <div class="row">
                <div class="col-md">
                  <h6 class="text-center">Total Inspect RFI Material</h6>
                  <div class="chart-wrapper mx-auto" style="height: 200px; position: relative;">
                    <div id="container_qc_mv_inspect" style="height: 100%; width: 100%;">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md">
                  <h6 class="text-center">Total Inspect RFI Fitup</h6>
                  <div class="chart-wrapper mx-auto" style="height: 200px; position: relative;">
                    <div id="container_qc_fu_inspect" style="height: 100%; width: 100%;">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md">
                  <h6 class="text-center">Total Inspect RFI Visual</h6>
                  <div class="chart-wrapper mx-auto" style="height: 200px; position: relative;">
                    <div id="container_qc_vt_inspect" style="height: 100%; width: 100%;">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="pills-qc-transmit" role="tabpanel" aria-labelledby="pills-qc-transmit-tab">
              <div class="row">
                <div class="col-md">
                  <h6 class="text-center">Total Transmit RFI Material</h6>
                  <div class="chart-wrapper mx-auto" style="height: 200px; position: relative;">
                    <div id="container_qc_mv_transmit" style="height: 100%; width: 100%;">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md">
                  <h6 class="text-center">Total Transmit RFI Fitup</h6>
                  <div class="chart-wrapper mx-auto" style="height: 200px; position: relative;">
                    <div id="container_qc_fu_transmit" style="height: 100%; width: 100%;">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md">
                  <h6 class="text-center">Total Transmit RFI Visual</h6>
                  <div class="chart-wrapper mx-auto" style="height: 200px; position: relative;">
                    <div id="container_qc_vt_transmit" style="height: 100%; width: 100%;">
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
    <div class="col-lg-8 col-md-6">
      <div class="card my-3 border-0 shadow-sm" style="height: calc(100% - 2rem)">
        <div class="card-header bg-white">
          <h6 class="m-0 text-center">KPI QC DOCUMENT CONTROL & QC INSPECTOR</h6>
        </div>
        <div class="card-body bg-white text-center p-3">
          <div class="table-responsive overflow-auto">
            <table class="table table-hover text-center datatables">
              <thead class="bg-green-smoe text-white">
                <tr>
                  <th>Name</th>
                  <th>Total Inspect RFI Material</th>
                  <th>Total Transmit RFI Material</th>
                  <th>Total Inspect RFI Fitup</th>
                  <th>Total Transmit RFI Fitup</th>
                  <th>Total Inspect RFI Visual</th>
                  <th>Total Transmit RFI Visual</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  foreach ($qc_data as $key => $value): 
                    @$chart_qc_inspect_user['mv'][] = [
                      "name" => @$user_list[$key],
                      "y" => @$value['mv']['inspect']+0,
                    ];
                    @$chart_qc_transmit_user['mv'][] = [
                      "name" => @$user_list[$key],
                      "y" => @$value['mv']['transmit']+0,
                    ];
                    @$chart_qc_inspect_user['fu'][] = [
                      "name" => @$user_list[$key],
                      "y" => @$value['fu']['inspect']+0,
                    ];
                    @$chart_qc_transmit_user['fu'][] = [
                      "name" => @$user_list[$key],
                      "y" => @$value['fu']['transmit']+0,
                    ];
                    @$chart_qc_inspect_user['vt'][] = [
                      "name" => @$user_list[$key],
                      "y" => @$value['vt']['inspect']+0,
                    ];
                    @$chart_qc_transmit_user['vt'][] = [
                      "name" => @$user_list[$key],
                      "y" => @$value['vt']['transmit']+0,
                    ];
                ?>
                  <tr>
                    <td><?= @$user_list[$key] ?></td>
                    <td><?= @$value['mv']['inspect']+0 ?></td>
                    <td><?= @$value['mv']['transmit']+0 ?></td>
                    <td><?= @$value['fu']['inspect']+0 ?></td>
                    <td><?= @$value['fu']['transmit']+0 ?></td>
                    <td><?= @$value['vt']['inspect']+0 ?></td>
                    <td><?= @$value['vt']['transmit']+0 ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-md-6">
      <div class="card my-3 border-0 shadow-sm" style="height: calc(100% - 2rem)">
        <div class="card-body bg-white text-center p-3">
          <ul class="nav nav-pills min-width-100 justify-content-center font-weight-bold" id="myTab" role="tablist"> 
            <li class="nav-item">
              <a class="nav-link active" data-toggle="pill" href="#pills-overall-mechanical" role="tab" aria-controls="pills-overall-mechanical">Overall</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="pill" href="#pills-mechanical-data" role="tab" aria-controls="pills-mechanical-data">Mechanical Data</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="pill" href="#pills-mechanical-attachment" role="tab" aria-controls="pills-mechanical-attachment">Mechanical Attachment</a>
            </li>
          </ul>
          <br>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-overall-mechanical" role="tabpanel" aria-labelledby="pills-overall-mechanical-tab">
              <div class="row">
                <div class="col-md">
                  <h6 class="text-center">Total Mechanical Data</h6>
                  <div class="chart-wrapper mx-auto">
                    <div id="container_mechanical" style="height: 200px;">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="pills-mechanical-data" role="tabpanel" aria-labelledby="pills-mechanical-data-tab">
              <div class="row">
                <div class="col-md">
                  <h6 class="text-center">Total Create Workpack</h6>
                  <div class="chart-wrapper mx-auto">
                    <div id="container_mechanical_data" style="height: 200px;">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="pills-mechanical-attachment" role="tabpanel" aria-labelledby="pills-mechanical-attachment-tab">
              <div class="row">
                <div class="col-md">
                  <h6 class="text-center">Total Revise Workpack</h6>
                  <div class="chart-wrapper mx-auto">
                    <div id="container_mechanical_attachment" style="height: 200px;">
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
    <div class="col-lg-6 col-md-6">
      <div class="card my-3 border-0 shadow-sm" style="height: calc(100% - 2rem)">
        <div class="card-header bg-white">
          <h6 class="m-0 text-center">KPI MECHANICAL COMPLETION</h6>
        </div>
        <div class="card-body bg-white text-center p-3">
          <div class="table-responsive overflow-auto">
            <table class="table table-hover text-center datatables">
              <thead class="bg-green-smoe text-white">
                <tr>
                  <th>Name</th>
                  <th>Total Mechanical Data</th>
                  <th>Total Mechanical Attachment</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  foreach (@$mc_data as $key => $value): 
                    @$chart_data_mc_user[] = [
                      "name" => @$user_list[$key],
                      "y" => @$value['data']+0,
                    ];
                    @$chart_attachment_mc_user[] = [
                      "name" => @$user_list[$key],
                      "y" => @$value['attachment']+0,
                    ];
                ?>
                  <tr>
                    <td><?= @$user_list[$key] ?></td>
                    <td><?= @$value['data']+0 ?></td>
                    <td><?= @$value['attachment']+0 ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  
</div>
</div>
<script>
  var colorset_all = <?= json_encode(['#26de81', '#45aaf2', '#fed330', '#2bcbba', '#fd9644', '#4b7bec', '#fc5c65', '#d1d8e0', '#a55eea', '#778ca3']) ?>;
  $(document).ready(function(){
    load_template("container_template", [{
      name: "Piecemark",
      y: <?= @$piecemark_sum+0 ?>,
    },{
      name: "Joint",
      y: <?= @$joint_sum+0 ?>,
    }],
    ['#45aaf2', '#26de81']);

    load_template("container_template_r", [{
      name: "Piecemark",
      y: <?= @$piecemark_r_sum+0 ?>,
    },{
      name: "Joint",
      y: <?= @$joint_r_sum+0 ?>,
    }],
    ['#45aaf2', '#26de81']);

    load_template("container_piecemark_user", <?= @json_encode($chart_piecemark_user) ?>, colorset_all);
    load_template("container_joint_user", <?= @json_encode($chart_joint_user) ?>, colorset_all);
    load_template("container_piecemark_r_user", <?= @json_encode($chart_piecemark_r_user) ?>, colorset_all);
    load_template("container_joint_r_user", <?= @json_encode($chart_joint_r_user) ?>, colorset_all);

    load_surveyor("container_surveyor_mv", [{
      name: "Web",
      y: <?= @$surveyor_data_sum['mv1']+0 ?>,
    },{
      name: "Mobile",
      y: <?= @$surveyor_data_sum['mv2']+0 ?>,
    }],
    ['#45aaf2', '#26de81']);

    load_surveyor("container_surveyor_fu", [{
      name: "Web",
      y: <?= @$surveyor_data_sum['fu1']+0 ?>,
    },{
      name: "Mobile",
      y: <?= @$surveyor_data_sum['fu2']+0 ?>,
    }],
    ['#45aaf2', '#26de81']);

    load_surveyor("container_surveyor_vt", [{
      name: "Web",
      y: <?= @$surveyor_data_sum['vt1']+0 ?>,
    },{
      name: "Mobile",
      y: <?= @$surveyor_data_sum['vt2']+0 ?>,
    }],
    ['#45aaf2', '#26de81']);

    load_surveyor("container_surveyor_itr", [{
      name: "Web",
      y: <?= @$surveyor_data_sum['itr1']+0 ?>,
    },{
      name: "Mobile",
      y: <?= @$surveyor_data_sum['itr2']+0 ?>,
    }],
    ['#45aaf2', '#26de81']);

    load_surveyor("container_surveyor_mv_web", <?= @json_encode($chart_surveyor_user_web['mv']) ?>, colorset_all);
    load_surveyor("container_surveyor_fu_web", <?= @json_encode($chart_surveyor_user_web['fu']) ?>, colorset_all);
    load_surveyor("container_surveyor_vt_web", <?= @json_encode($chart_surveyor_user_web['vt']) ?>, colorset_all);
    load_surveyor("container_surveyor_itr_web", <?= @json_encode($chart_surveyor_user_web['itr']) ?>, colorset_all);
    load_surveyor("container_surveyor_mv_mobile", <?= @json_encode($chart_surveyor_user_mobile['mv']) ?>, colorset_all);
    load_surveyor("container_surveyor_fu_mobile", <?= @json_encode($chart_surveyor_user_mobile['fu']) ?>, colorset_all);
    load_surveyor("container_surveyor_vt_mobile", <?= @json_encode($chart_surveyor_user_mobile['vt']) ?>, colorset_all);
    load_surveyor("container_surveyor_itr_mobile", <?= @json_encode($chart_surveyor_user_mobile['itr']) ?>, colorset_all);

    load_workpack("container_workpack", [{
      name: "Create Workpack",
      y: <?= @$workpack_data_sum['create']+0 ?>,
    },{
      name: "Revise Workpack",
      y: <?= @$workpack_data_sum['revise']+0 ?>,
    }],
    ['#45aaf2', '#26de81']);
    load_workpack("container_workpack_create", <?= @json_encode($chart_create_workpack_user) ?>, colorset_all);
    load_workpack("container_workpack_revise", <?= @json_encode($chart_revise_workpack_user) ?>, colorset_all);

    load_workpack("container_mechanical", [{
      name: "Mechanical Data",
      y: <?= @$mc_data_sum['data']+0 ?>,
    },{
      name: "Mechanical Attachment",
      y: <?= @$mc_data_sum['attachment']+0 ?>,
    }],
    ['#45aaf2', '#26de81']);
    load_workpack("container_mechanical_data", <?= @json_encode($chart_data_mc_user) ?>, colorset_all);
    load_workpack("container_mechanical_attachment", <?= @json_encode($chart_attachment_mc_user) ?>, colorset_all);

    load_surveyor("container_pmt_mv", [{
      name: "Submit RFI",
      y: <?= @$pmt_data_sum['mv']['submit']+0 ?>,
    },{
      name: "Revise RFI",
      y: <?= @$pmt_data_sum['mv']['revise']+0 ?>,
    }],
    ['#45aaf2', '#26de81']);

    load_surveyor("container_pmt_fu", [{
      name: "Submit RFI",
      y: <?= @$pmt_data_sum['fu']['submit']+0 ?>,
    },{
      name: "Revise RFI",
      y: <?= @$pmt_data_sum['fu']['revise']+0 ?>,
    }],
    ['#45aaf2', '#26de81']);

    load_surveyor("container_pmt_vt", [{
      name: "Submit RFI",
      y: <?= @$pmt_data_sum['vt']['submit']+0 ?>,
    },{
      name: "Revise RFI",
      y: <?= @$pmt_data_sum['vt']['revise']+0 ?>,
    }],
    ['#45aaf2', '#26de81']);
    load_surveyor("container_pmt_mv_submit", <?= @json_encode($chart_pmt_submit_user['mv']) ?>, colorset_all);
    load_surveyor("container_pmt_fu_submit", <?= @json_encode($chart_pmt_submit_user['fu']) ?>, colorset_all);
    load_surveyor("container_pmt_vt_submit", <?= @json_encode($chart_pmt_submit_user['vt']) ?>, colorset_all);
    load_surveyor("container_pmt_mv_revise", <?= @json_encode($chart_pmt_revise_user['mv']) ?>, colorset_all);
    load_surveyor("container_pmt_fu_revise", <?= @json_encode($chart_pmt_revise_user['fu']) ?>, colorset_all);
    load_surveyor("container_pmt_vt_revise", <?= @json_encode($chart_pmt_revise_user['vt']) ?>, colorset_all);

    load_surveyor("container_qc_mv", [{
      name: "Inspect RFI",
      y: <?= @$qc_data_sum['mv']['inspect']+0 ?>,
    },{
      name: "Transmit RFI",
      y: <?= @$qc_data_sum['mv']['transmit']+0 ?>,
    }],
    ['#45aaf2', '#26de81']);

    load_surveyor("container_qc_fu", [{
      name: "Inspect RFI",
      y: <?= @$qc_data_sum['fu']['inspect']+0 ?>,
    },{
      name: "Transmit RFI",
      y: <?= @$qc_data_sum['fu']['transmit']+0 ?>,
    }],
    ['#45aaf2', '#26de81']);

    load_surveyor("container_qc_vt", [{
      name: "Inspect RFI",
      y: <?= @$qc_data_sum['vt']['inspect']+0 ?>,
    },{
      name: "Transmit RFI",
      y: <?= @$qc_data_sum['vt']['transmit']+0 ?>,
    }],
    ['#45aaf2', '#26de81']);
    load_surveyor("container_qc_mv_inspect", <?= @json_encode($chart_qc_inspect_user['mv']) ?>, colorset_all);
    load_surveyor("container_qc_fu_inspect", <?= @json_encode($chart_qc_inspect_user['fu']) ?>, colorset_all);
    load_surveyor("container_qc_vt_inspect", <?= @json_encode($chart_qc_inspect_user['vt']) ?>, colorset_all);
    load_surveyor("container_qc_mv_transmit", <?= @json_encode($chart_qc_transmit_user['mv']) ?>, colorset_all);
    load_surveyor("container_qc_fu_transmit", <?= @json_encode($chart_qc_transmit_user['fu']) ?>, colorset_all);
    load_surveyor("container_qc_vt_transmit", <?= @json_encode($chart_qc_transmit_user['vt']) ?>, colorset_all);

    document.addEventListener('fullscreenchange', (event) => {
      // document.fullscreenElement will point to the element that
      // is in fullscreen mode if there is one. If not, the value
      // of the property is null.
      if (document.fullscreenElement) {
        console.log(`Element: ${document.fullscreenElement.id} entered fullscreen mode.`);
      } else {
        console.log('Leaving full-screen mode.');
      }

    });
    $(".datatables").DataTable({
      // "order": []
    });
  });
  
  function load_surveyor(element, dataset, color_set) {
    Highcharts.chart(element, {
      exporting: {
        enabled: true
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
      accessibility: {
        point: {
          valueSuffix: '%'
        }
      },
      plotOptions: {
        pie: {
          // size: 150,
          allowPointSelect: true,
          cursor: 'pointer',
          dataLabels: {
            connectorPadding: -3,
            distance: 2,
            enabled: true,
            crop: false,
            overflow: 'none',
            format: '{point.y:.0f}',
          },
          showInLegend: true
        },
        series:{
          colors: color_set,
        }
      },
      legend: {
        align: 'right',
        verticalAlign: 'top',
        layout: 'vertical',
        maxHeight: 200,
      },
      tooltip: {
        pointFormat: '{point.percentage:.1f} %<br>value: {point.y}'
      },
      series: [{
        name: 'Total Input Progress Material',
        innerSize: '60%',
        startAngle: 180,
        data: dataset,
      }],
    });
  }

  function load_workpack(element, dataset, color_set) {
    Highcharts.chart(element, {
      exporting: {
        enabled: true
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
      accessibility: {
        point: {
          valueSuffix: '%'
        }
      },
      plotOptions: {
        pie: {
          // size: 150,
          allowPointSelect: true,
          cursor: 'pointer',
          dataLabels: {
            connectorPadding: -3,
            distance: 2,
            enabled: true,
            crop: false,
            overflow: 'none',
            format: '{point.y:.0f}',
          },
          showInLegend: true
        },
        series:{
          colors: color_set,
        }
      },
      legend: {
        align: 'right',
        verticalAlign: 'top',
        layout: 'vertical',
        maxHeight: 200,
      },
      tooltip: {
        pointFormat: '{point.percentage:.1f} %<br>value: {point.y}'
      },
      series: [{
        name: 'Total Input Progress Material',
        // innerSize: '60%',
        startAngle: 180,
        data: dataset,
      }],
    });
  }

  function load_template(elemen, dataset, colorset) {
    Highcharts.chart(elemen, {
      chart: {
        type: 'pie',
      },
      title: {
        text: ''
      },
      tooltip: {
        pointFormat: '{point.percentage:.1f} %<br>value: {point.y}'
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
          },
          showInLegend: true
        },
        series: {
          colors: colorset
        }
      },
      credits: {
        enabled: false,
      },
      series: [{
        name: 'Total',
        startAngle: 180,
        data: dataset,
      }],
    });
  }
</script>