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
          <div class="row">
            <div class="col-md">
              <h6 class="text-center">Total Inputed Template Overall</h6>
              <div class="chart-wrapper mx-auto">
                <div id="container_template" style="height: 100%">
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
    <div class="col-lg-6 col-md-6">
      <div class="card my-3 border-0 shadow-sm" style="height: calc(100% - 2rem)">
        <div class="card-body bg-white text-center p-3">
          <div class="table-responsive overflow-auto">
            <table class="table table-hover text-center datatables">
              <thead class="bg-green-smoe text-white">
                <tr>
                  <th>Name</th>
                  <th>Total Input Piecemark</th>
                  <th>Percentage Input Piecemark</th>
                  <th>Total Input Joint</th>
                  <th>Percentage Input Joint</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($template_data as $key => $value): ?>
                  <tr>
                    <td><?= @$user_list[$key] ?></td>
                    <td><?= @$value['piecemark']+0 ?></td>
                    <td><?= number_format(((@$value['piecemark']+0)/$piecemark_sum)*100, 1) ?>%</td>
                    <td><?= @$value['joint']+0 ?></td>
                    <td><?= number_format(((@$value['joint']+0)/$joint_sum)*100, 1) ?>%</td>
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
          <h6 class="text-center">Total Workpack</h6>
          <div class="chart-wrapper mx-auto">
            <div id="container_workpack" style="height: 100%">
              <div class="text-center loading mt-4">
                <div class="spinner-border" role="status"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6">
      <div class="card my-3 border-0 shadow-sm" style="height: calc(100% - 2rem)">
        <div class="card-body bg-white text-center pt-3">
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
          </div>
          <div class="row">
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
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6">
      <div class="card my-3 border-0 shadow-sm" style="height: calc(100% - 2rem)">
        <div class="card-body bg-white text-center pt-3">
          <div class="row">
            <div class="col-md">
              <h6 class="text-center">Total Transaction Material</h6>
              <div class="chart-wrapper mx-auto">
                <div id="container_fabrication_mv">
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
    <div class="col-lg-4 col-md-6">
      <div class="card my-3 border-0 shadow-sm" style="height: calc(100% - 2rem)">
        <div class="card-body bg-white text-center pt-3">
          <div class="row">
            <div class="col-md">
              <h6 class="text-center">Total Transaction Fitup</h6>
              <div class="chart-wrapper mx-auto">
                <div id="container_fabrication_fu">
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
    <div class="col-lg-4 col-md-6">
      <div class="card my-3 border-0 shadow-sm" style="height: calc(100% - 2rem)">
        <div class="card-body bg-white text-center pt-3">
          <div class="row">
            <div class="col-md">
              <h6 class="text-center">Total Transaction Visual</h6>
              <div class="chart-wrapper mx-auto">
                <div id="container_fabrication_vt">
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
    <div class="col-lg-4 col-md-6">
      <div class="card my-3 border-0 shadow-sm" style="height: calc(100% - 2rem)">
        <div class="card-body bg-white text-center pt-3">
          <div class="row">
            <div class="col-md">
              <h6 class="text-center">Total Transaction NDT</h6>
              <div class="chart-wrapper mx-auto">
                <div id="container_fabrication_ndt">
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
    <div class="col-lg-4 col-md-6">
      <div class="card my-3 border-0 shadow-sm" style="height: calc(100% - 2rem)">
        <div class="card-body bg-white text-center pt-3">
          <div class="row">
            <div class="col-md">
              <h6 class="text-center">Total Approval QC Material</h6>
              <div class="chart-wrapper mx-auto">
                <div id="container_approval_mv" style="height: 200px;">
                  <div class="text-center loading mt-4">
                    <div class="spinner-border" role="status"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md">
              <h6 class="text-center">Total Approval QC Fitup</h6>
              <div class="chart-wrapper mx-auto">
                <div id="container_approval_fu" style="height: 200px;">
                  <div class="text-center loading mt-4">
                    <div class="spinner-border" role="status"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md">
              <h6 class="text-center">Total Approval QC Visual</h6>
              <div class="chart-wrapper mx-auto">
                <div id="container_approval_vt" style="height: 200px;">
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
<script>
  $(document).ready(function(){
    load_template();
    load_workpack();
    load_surveyor("container_surveyor_mv", <?= $surveyor_mv ?>);
    load_surveyor("container_surveyor_fu", <?= $surveyor_fu ?>);
    load_surveyor("container_surveyor_vt", <?= $surveyor_vt ?>);
    load_fabrication("container_fabrication_mv", <?= $fabrication_mv ?>);
    load_fabrication("container_fabrication_fu", <?= $fabrication_fu ?>);
    load_fabrication("container_fabrication_vt", <?= $fabrication_vt ?>);
    load_ndt("container_fabrication_ndt", <?= $fabrication_ndt ?>);
    load_surveyor("container_approval_mv", <?= $approval_mv ?>);
    load_surveyor("container_approval_fu", <?= $approval_fu ?>);
    load_surveyor("container_approval_vt", <?= $approval_vt ?>);

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
      "order": []
    });
  });
  
  function load_template() {
    Highcharts.chart("container_template", {
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
          colors: ['#45aaf2', '#26de81']
        }
      },
      credits: {
        enabled: false,
      },
      series: [{
        name: 'Total',
        startAngle: 180,
        data:[{name: 'Piecemark', y: <?= $piecemark_sum ?>}, {name: 'Joint', y: <?= $joint_sum ?>}],
      }],
    });
  }

  function load_workpack() {
    Highcharts.chart("container_workpack", {
      chart: {
        type: 'bar'
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
      yAxis: {
        title: {
          text: 'Total Workpack'
        },
      },
      tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
          '<td style="padding:1"><b>{point.y:.0f} </b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
      },
      colors: ['#45aaf2', '#26de81'],
      plotOptions: {
        bar: {
          pointPadding: 0,
          borderWidth: 0
        },
        series: {
          dataLabels: {
            enabled: true,
            crop: false,
            overflow: "none"
          },
        },
      },
      legend: {
        enabled: true,
      },
      credits: {
        enabled: false,
      },
      series: [{
        name: 'Issued',
        data:[<?= @$workpack_sum['PF']['Issued']+0 ?>, <?= @$workpack_sum['FB']['Issued']+0 ?>, <?= @$workpack_sum['AS']['Issued']+0 ?>, <?= @$workpack_sum['ER']['Issued']+0 ?>],
      },{
        name: 'Complete',
        data:[<?= @$workpack_sum['PF']['Complete']+0 ?>, <?= @$workpack_sum['FB']['Complete']+0 ?>, <?= @$workpack_sum['AS']['Complete']+0 ?>, <?= @$workpack_sum['ER']['Complete']+0 ?>],
      },
      // {
      //   name: 'Cum. Overdue',
      //   data:[<?= @$workpack_sum['PF']['Overdue']+0 ?>, <?= @$workpack_sum['FB']['Overdue']+0 ?>, <?= @$workpack_sum['AS']['Overdue']+0 ?>, <?= @$workpack_sum['ER']['Overdue']+0 ?>],
      // }
    ],
    });
  }

  function load_surveyor(element, dataset) {
    var color_set = ['#45aaf2', '#26de81'];
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
          size: 150,
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
        legend: {
          reversed: true
        },
        series:{
          colors: color_set,
        }
      },
      tooltip: {
        pointFormat: '{point.percentage:.1f} %<br>value: {point.y}'
      },
      series: [{
        name: 'Total Input Progress Material',
        innerSize: '60%',
        startAngle: 180,
        data:[{name: 'Mobile', y: dataset[2]}, {name: 'Website', y: dataset[1]}],
      }],
    });
  }

  function load_fabrication(element, dataset) {
    categorieset = ['Submit RFI QC', 'Rejected By QC', 'Peding By QC', 'Approved By QC'];
    var yAxisTitle = "Total Joint";
    if(element == "container_fabrication_mv"){
      var yAxisTitle = "Total Piecemark";
    }
    Highcharts.chart(element, {
      chart: {
        type: 'column'
      },
      title: {
        text: ''
      },
      xAxis: {
        categories: ['Status'],
        crosshair: true
      },
      yAxis: {
        title: {
          text: yAxisTitle
        },
      },
      colors: ['#fd9644', '#fed330', '#26de81', '#2bcbba', '#45aaf2', '#4b7bec', '#a55eea', '#d1d8e0', '#778ca3'],
      plotOptions: {
        column: {
          pointPadding: 0.1,
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
      legend: {
        enabled: true,
      },
      credits: {
        enabled: false,
      },
      series: dataset,
    })

  }

  function load_ndt(element, dataset) {
    categorieset = ['NDT Transmit', 'NDT Approved', 'NDT Rejected'];
    colorset = ['#d1d8e0', '#fed330', '#26de81'];
    
    var color_set = ['#d1d8e0', '#26de81'];

    var yAxisTitle = "Total Joint";
    if(element == "container_fabrication_mv"){
      var yAxisTitle = "Total Piecemark";
    }
    Highcharts.chart(element, {
      chart: {
        type: 'column'
      },
      title: {
        text: ''
      },
      xAxis: {
        categories: <?= $fabrication_ndt_category ?>,
        crosshair: true
      },
      yAxis: {
        title: {
          text: yAxisTitle
        },
      },
      colors: ['#45aaf2', '#26de81', '#fd9644'],
      plotOptions: {
        column: {
          pointPadding: 0.1,
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
      legend: {
        enabled: true,
      },
      credits: {
        enabled: false,
      },
      series: dataset,
    })

  }

  function load_rejection(element) {
    Highcharts.chart(element, {
      chart: {
        type: 'area'
      },
      title: {
        text: ''
      },
      xAxis: {
        categories: <?= $fabrication_ndt_category ?>,
        crosshair: true
      },
      yAxis: {
        title: {
          text: "Total Length"
        },
      },
      colors: ['#45aaf2', '#26de81', '#fd9644'],
      plotOptions: {
        column: {
          pointPadding: 0.1,
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
      legend: {
        enabled: true,
      },
      credits: {
        enabled: false,
      },
      series: dataset,
    })

  }
</script>