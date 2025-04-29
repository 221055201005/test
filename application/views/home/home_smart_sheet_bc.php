
<?php
$dummy_number = 983545;
?>
<style>
@media (max-width: 767.99px) {
  .row{
    margin-top: -15px;
    margin-bottom: -15px;
  }
  .row.mt-30{
    margin-top: 15px;
    /* margin-bottom: 15px; */
  }
  [class*="col-"]{
    padding-top: 15px;
    padding-bottom: 15px;
  }
}
@media (min-width: 768px) {
  .mt-30{
    margin-top: 30px;
  }
}
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
</style>
<div id="content" class="container-fluid">

<div class="bg-white p-3 shadow-sm">
  <h4 class="text-center font-weight-bold mt-0 mb-3">Production & Quality Dashboard</h4>
  <?= $tabmenu ?>
</div>
  <br/>

  <div class="tab-content" id="myTabContent">
      
    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab"> 
      <div class="row">
        <div class="col-md-12"> 

          <!-- <div class="row"> 
            <div class="col-md-3">
              <div class="card border-0 shadow-sm">
                <h6 class="card-header text-left bg-dark text-white rounded-0"  style='font-size:12px !important;'>Weld Length By Joint Visual per Deck</h6>
                <div class="card-body bg-white text-center p-2"> 
                  <div class="chart-wrapper mx-auto" style="height:40vh; position:relative">
                    <div id="container_pie_4" style="height: 100%; width: 100%;">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card border-0 shadow-sm">
                <h6 class="card-header text-left bg-dark text-white rounded-0"  style='font-size:12px !important;'>Weld Length By Joint Tested per Deck</h6>
                <div class="card-body bg-white text-center p-2"> 
                  <div class="chart-wrapper mx-auto" style="height:40vh; position:relative">
                    <div id="container_pie_1" style="height: 100%; width: 100%;">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card border-0 shadow-sm">
                <h6 class="card-header text-left bg-dark text-white rounded-0"  style='font-size:12px !important;'>Tested Length By Joint per Deck</h6>
                <div class="card-body bg-white text-center p-2"> 
                  <div class="chart-wrapper mx-auto" style="height:40vh; position:relative">
                    <div id="container_pie_2" style="height: 100%; width: 100%;">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card border-0 shadow-sm">
                <h6 class="card-header text-left bg-dark text-white rounded-0"  style='font-size:12px !important;'>%NDT of Welds By Joint to Date per Deck</h6>
                <div class="card-body bg-white text-center p-2"> 
                  <div class="chart-wrapper mx-auto" style="height:40vh; position:relative">
                    <div id="container_pie_3" style="height: 100%; width: 100%;">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> 
          </div> -->
          
          <div class="row mt-30">
            <div class="col-md-12">
              <div class="card border-0 shadow-sm">
                <div class="row bg-dark m-0">
                  <div class="col-md-auto p-0">
                    <h6 class="card-header text-left text-white rounded-0"  style='font-size:12px !important;'>Rejection Rate - All Series</h6>
                  </div>
                  <div class="col-md text-right py-2 px-3">
                    <select class="border-0 my-1 mx-2" onchange="change_week_base(this)">
                      <option value="0" <?= ($week_based == '0' ? 'selected' : '') ?>>by NDT Testing Date</option>
                      <option value="1" <?= ($week_based == '1' ? 'selected' : '') ?>>by Welding Date</option>
                    </select>
                  </div>
                </div>
                <div class="card-body bg-white text-center p-2"> 
                  <div class="chart-wrapper mx-auto" style="height:30vh; position:relative">
                    <div id="container_row_2_1" style="height: 100%; width: 100%;">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="card border-0 shadow-sm">
                <h6 class="card-header text-left bg-dark text-white rounded-0"  style='font-size:12px !important;'>Rejection Rate - Analysis per Deck</h6>
                <div class="card-body bg-white text-center p-2"> 
                  <div class="chart-wrapper mx-auto" style="height:30vh; position:relative">
                    <div id="container_row_2_2" style="height: 100%; width: 100%;">
                      <div class="text-center loading mt-4">
                        <div class="spinner-border" role="status"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row mt-30"> 
            <div class="col-md-2">
              <div class="card border-0 shadow-sm">
                <h6 class="card-header text-left bg-dark text-white rounded-0"  style='font-size:12px !important;'>All Deck - Cumulative to Date</h6>
                <div class="card-body bg-white text-center p-2"> 
                  <div class="chart-wrapper mx-auto" style="position:relative" id="container_alldeck_cum">
                    <table class="w-100 text-left table-striped">
                      <tr>
                        <td>Weld Length (mm)</td>
                        <td><b><?= array_sum($array_deck_length_sum)+0 ?><b></td>
                      </tr>
                      <tr>
                        <td>Length Tested (mm)</td>
                        <td><b><?= array_sum($array_deck_tested_length_sum)+0 ?><b></td>
                      </tr>
                      <tr>
                        <td>Weld Defect Length (mm)</td>
                        <td><b><?= array_sum($array_deck_defect_length_sum)+0 ?><b></td>
                      </tr>
                      <tr>
                        <td>Defect %</td>
                        <td><b><?= round(array_sum($array_deck_defect_length_sum)/array_sum($array_deck_tested_length_sum)*100, 2) ?><b></td>
                      </tr>
                      <tr>
                        <td>NDT % Completed</td>
                        <td><b><?= round(array_sum($array_deck_tested_length_sum)/array_sum($array_deck_length_sum)*100, 2) ?><b></td>
                      </tr>
                      <tr>
                        <td>No of Joint Made</td>
                        <td><b><?= array_sum($array_deck_total_joint_made)+0 ?><b></td>
                      </tr>
                      <tr>
                        <td>No of Joint Tested</td>
                        <td><b><?= array_sum($array_deck_total_joint_tested)+0 ?><b></td>
                      </tr>
                      <tr>
                        <td>% of Joint Tested</td>
                        <td><b><?= round(array_sum($array_deck_total_joint_tested)/array_sum($array_deck_total_joint_made)*100, 2) ?><b></td>
                      </tr>
                      <?php foreach($calculate_all_defect_by_deck as $key => $valuex){ ?>
                      <tr>
                        <td>No of <?= $key ?></td>
                        <td><b><?= array_sum($valuex)+0 ?><b></td>
                      </tr>
                      <?php } ?>
                      <tr>
                        <td>RFI Time Min</td>
                        <?php
                          $min_rfi = 1;
                          if(min($array_deck_total_days_rfi_min) > 0){
                            $min_rfi = min($array_deck_total_days_rfi_min);
                          }
                        ?>
                        <td><b><?= $min_rfi+0 ?><b></td>
                      </tr>
                      <tr>
                        <td>RFI Time Max</td>
                        <td><b><?= max($array_deck_total_days_rfi_max)+0 ?><b></td>
                      </tr>
                      <tr>
                        <td>RFI Time Avg</td>
                        <td><b><?= ceil(array_sum($rfi_average_time_deck)/count($rfi_average_time_deck))+0 ?><b></td>
                      </tr>
                      <tr>
                        <td>Weld to NDT Time Max</td>
                        <td><b><?= max($array_deck_total_days_ndt_max)+0 ?><b></td>
                      </tr>
                      <tr>
                        <td>Weld to NDT Time Avg</td>
                        <td><b><?= ceil(array_sum($ndt_average_time_deck)/count($ndt_average_time_deck))+0 ?><b></td>
                      </tr>
                      <tr>
                        <td><b><i>* Data Calculation By NDT Joint</i></b></td>
                        <td></td>
                      </tr>
                      
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-10"> 
              <div class="row">
                <div class="col-md-12">
                  <div class="card border-0 shadow-sm">
                    <div class="row bg-dark m-0">
                      <div class="col-md-auto p-0">
                        <h6 class="card-header text-left text-white rounded-0"  style='font-size:12px !important;'>Weekly UT Rejection Rate for All Deck</h6>
                      </div>
                      <div class="col-md text-right py-2 px-3">
                        <select class="border-0 my-1 mx-2" onchange="change_week_base(this)">
                          <option value="0" <?= ($week_based == '0' ? 'selected' : '') ?>>by NDT Testing Date</option>
                          <option value="1" <?= ($week_based == '1' ? 'selected' : '') ?>>by Welding Date</option>
                        </select>
                      </div>
                    </div>
                    <!-- <h6 class="card-header text-left bg-dark text-white rounded-0"  style='font-size:12px !important;'>Weekly UT Rejection Rate for all decks</h6> -->
                    <div class="card-body bg-white text-center p-2"> 
                      <div class="chart-wrapper mx-auto" style="height:30vh; position:relative">
                        <div id="container_weekly_reject_rate_all_deck" style="height: 100%; width: 100%;">
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

          <!-- <div class="row mt-30">
            <?php foreach ($id_deck_list as $id_deck): ?>
              <div class="col-md-2">
                <div class="card border-0 shadow-sm">
                  <h6 class="card-header text-left bg-dark text-white rounded-0"  style='font-size:12px !important;'><?= $deck_name[$id_deck] ?> - Cumulative to Date</h6>
                  <div class="card-body bg-white text-center p-2"> 
                    <div class="chart-wrapper mx-auto" style="position:relative">
                      <table class="w-100 text-left table-striped">
                        <tr>
                          <td>Weld Length (mm)</td>
                          <td><b><?= $array_deck_length_sum[$id_deck]+0 ?><b></td>
                        </tr>
                        <tr>
                          <td>Length Tested (mm)</td>
                          <td><b><?= $array_deck_tested_length_sum[$id_deck]+0 ?><b></td>
                        </tr>
                        <tr>
                          <td>Weld Defect Length (mm)</td>
                          <td><b><?= $array_deck_defect_length_sum[$id_deck]+0 ?><b></td>
                        </tr>
                        <tr>
                          <td>Defect %</td>
                          <td><b><?= (is_nan(round($array_deck_total_joint_tested[$id_deck]/$array_deck_total_joint_made[$id_deck]*100+0, 2)) ? 0 : ($percent_defect_deck[$id_deck] > 100 ? 100 : $percent_defect_deck[$id_deck])) ?><b></td>
                        </tr>
                        <tr>
                          <td>NDT % Completed</td>
                          <td><b><?= (is_nan(round($array_deck_total_joint_tested[$id_deck]/$array_deck_total_joint_made[$id_deck]*100+0, 2)) ? 0 : ($percent_ndt_completed_deck[$id_deck] > 100 ? 100 : $percent_ndt_completed_deck[$id_deck])) ?><b></td>
                        </tr>
                        <tr>
                          <td>No of Joint Made</td>
                          <td><b><?= $array_deck_total_joint_made[$id_deck]+0 ?><b></td>
                        </tr>
                        <tr>
                          <td>No of Joint Tested</td>
                          <td><b><?= $array_deck_total_joint_tested[$id_deck]+0 ?><b></td>
                        </tr>
                        <tr>
                          <td>% of Joint Tested</td>
                          <td><b><?= is_nan($array_deck_total_joint_tested[$id_deck]/$array_deck_total_joint_made[$id_deck]) ? 0 : round($array_deck_total_joint_tested[$id_deck]/$array_deck_total_joint_made[$id_deck]*100+0, 2) ?><b></td>
                        </tr>
                        <?php foreach($calculate_all_defect_by_deck as $key => $valuex){ ?>
                        <tr>
                          <td>No of <?= $key ?></td>
                          <td><b><?= $valuex[$id_deck]+0 ?><b></td>
                        </tr>
                        <?php } ?>
                        <tr>
                          <td>RFI Time Min</td>
                          <?php
                            $min_rfi = 1;
                            if($array_deck_total_days_rfi_min[$id_deck] > 0){
                              $min_rfi = $array_deck_total_days_rfi_min[$id_deck];
                            }
                            if($min_rfi > $array_deck_total_days_rfi_max[$id_deck]+0){
                              $min_rfi = $array_deck_total_days_rfi_max[$id_deck]+0;
                            }
                          ?>
                          <td><b><?= $min_rfi+0 ?><b></td>
                        </tr>
                        <tr>
                          <td>RFI Time Max</td>
                          <td><b><?= $array_deck_total_days_rfi_max[$id_deck]+0 ?><b></td>
                        </tr>
                        <tr>
                          <td>RFI Time Avg</td>
                          <td><b><?= $rfi_average_time_deck[$id_deck]+0 ?><b></td>
                        </tr>
                        <tr>
                          <td>Weld to NDT Time Max</td>
                          <td><b><?= $array_deck_total_days_ndt_max[$id_deck]+0 ?><b></td>
                        </tr>
                        <tr>
                          <td>Weld to NDT Time Avg</td>
                          <td><b><?= $ndt_average_time_deck[$id_deck]+0 ?><b></td>
                        </tr>
                        <tr>
                          <td><b><i>* Data Calculation By NDT Joint</i></b></td>
                          <td></td>
                          </tr>

                      </table>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach ?>
          </div> -->

        </div>
      </div> 
    </div>

  </div>

</div>
</div> 

<script>
  // Highcharts.chart('container_pie_1', {
  //     chart: {
  //         plotBackgroundColor: null,
  //         plotBorderWidth: null,
  //         plotShadow: false,
  //         type: 'pie'
  //     }, 
  //     colors: ['#26de81', '#45aaf2', '#778ca3', '#fed330', '#a55eea'],
  //     title: {
  //         text: ''
  //     },
  //     tooltip: {
  //       pointFormat: '{point.percentage:.1f} %<br>value: {point.y}'
  //     },
  //     accessibility: {
  //         point: {
  //             valueSuffix: '%'
  //         }
  //     },
  //     credits: {
  //       enabled: false,
  //     },
  //     plotOptions: {
  //             pie: {
  //                 allowPointSelect: true,
  //                 cursor: 'pointer',
  //                 depth: 35,
  //                 dataLabels: {
  //                   distance:-40,
  //                     enabled: true,
  //                     format: '{point.y}mm'
  //                 },
  //                 showInLegend: true
  //             }
  //     },
  //     legend: {
  //         layout: 'horizontal',
  //         align: 'center',
  //         verticalAlign: 'top', 
  //     },
  //     series: [{
  //         name: 'Deck Elevation / Service Line',
  //         colorByPoint: true,
  //         data: [
  //           <?php foreach($unique_deck as $key => $value){ ?>
  //               {
  //                   name: "<?= @$array_deck_name[$value['deck_elevation']] ?>",
  //                   y: <?= (isset($array_deck_length_sum[$value['deck_elevation']]) ? $array_deck_length_sum[$value['deck_elevation']] : 0 ) ?>, 
  //               }, 
  //           <?php } ?>    
  //       ]
  //     }] 
  // });

  // Highcharts.chart('container_pie_2', {
  //     chart: {
  //         plotBackgroundColor: null,
  //         plotBorderWidth: null,
  //         plotShadow: false,
  //         type: 'pie'
  //     }, 
  //     colors: ['#26de81', '#45aaf2', '#778ca3', '#fed330', '#a55eea'],
  //     title: {
  //         text: ''
  //     },
  //     tooltip: {
  //       pointFormat: '{point.percentage:.1f} %<br>value: {point.y}'
  //     },
  //     accessibility: {
  //         point: {
  //             valueSuffix: '%'
  //         }
  //     },
  //     credits: {
  //       enabled: false,
  //     },
  //     plotOptions: {
  //             pie: {
  //                 allowPointSelect: true,
  //                 cursor: 'pointer',
  //                 depth: 35,
  //                 dataLabels: {
  //                   distance:-40,
  //                     enabled: true,
  //                     format: '{point.y}mm'
  //                 },
  //                 showInLegend: true
  //             }
  //     },
  //     legend: {
  //         layout: 'horizontal',
  //         align: 'center',
  //         verticalAlign: 'top', 
  //     },
  //     series: [{
  //         name: 'Deck Elevation / Service Line',
  //         colorByPoint: true,
  //         data: [
  //           <?php foreach($unique_deck as $key => $value){ ?>
  //               {
  //                   name: "<?= @$array_deck_name[$value['deck_elevation']] ?>",
  //                   y: <?= (isset($array_deck_tested_length_sum[$value['deck_elevation']]) ? $array_deck_tested_length_sum[$value['deck_elevation']] : 0 ) ?>, 
  //               }, 
  //           <?php } ?>    
  //       ]
  //     }] 
  // });


  // Highcharts.chart('container_pie_3', {
  //     chart: {
  //         plotBackgroundColor: null,
  //         plotBorderWidth: null,
  //         plotShadow: false,
  //         type: 'pie'
  //     }, 
  //     colors: ['#26de81', '#45aaf2', '#778ca3', '#fed330', '#a55eea'],
  //     title: {
  //         text: ''
  //     },
  //     credits: {
  //       enabled: false,
  //     },
  //     tooltip: {
  //       pointFormat: ' value: {point.y}%'
  //     },
  //     accessibility: {
  //         point: {
  //             valueSuffix: '%'
  //         }
  //     },
  //     plotOptions: {
  //             pie: {
  //                 allowPointSelect: true,
  //                 cursor: 'pointer',
  //                 depth: 35,
  //                 dataLabels: {
  //                   distance:-40,
  //                     enabled: true,
  //                     format: '{point.y}%'
  //                 },
  //                 showInLegend: true
  //             }
  //     },
  //     legend: {
  //         layout: 'horizontal',
  //         align: 'center',
  //         verticalAlign: 'top', 
  //     },
  //     series: [{
  //         name: 'Deck Elevation / Service Line',
  //         colorByPoint: true,
  //         data: [
  //           <?php foreach($unique_deck as $key => $value){ ?>
  //               {
  //                   name: "<?= @$array_deck_name[$value['deck_elevation']] ?>",
  //                   y: <?= (isset($percent_deck[$value['deck_elevation']]) ? ($percent_deck[$value['deck_elevation']] > 100 ? 100 : $percent_deck[$value['deck_elevation']] ) : 0 ) ?>, 
  //               }, 
  //           <?php } ?>    
  //         ]
  //     }] 
  // });


  // Highcharts.chart('container_pie_4', {
  //     chart: {
  //         plotBackgroundColor: null,
  //         plotBorderWidth: null,
  //         plotShadow: false,
  //         type: 'pie'
  //     }, 
  //     colors: ['#26de81', '#45aaf2', '#778ca3', '#fed330', '#a55eea'],
  //     title: {
  //         text: ''
  //     },
  //     tooltip: {
  //       pointFormat: '{point.percentage:.1f} %<br>value: {point.y}'
  //     },
  //     accessibility: {
  //         point: {
  //             valueSuffix: '%'
  //         }
  //     },
  //     credits: {
  //       enabled: false,
  //     },
  //     plotOptions: {
  //             pie: {
  //                 allowPointSelect: true,
  //                 cursor: 'pointer',
  //                 depth: 35,
  //                 dataLabels: {
  //                   distance:-40,
  //                     enabled: true,
  //                     format: '{point.y}mm'
  //                 },
  //                 showInLegend: true
  //             }
  //     },
  //     legend: {
  //         layout: 'horizontal',
  //         align: 'center',
  //         verticalAlign: 'top', 
  //     },
  //     series: [{
  //         name: 'Deck Elevation / Service Line',
  //         colorByPoint: true,
  //         data: [
  //           <?php foreach($unique_deck as $key => $value){ ?>
  //               {
  //                   name: "<?= @$array_deck_name[$value['deck_elevation']] ?>",
  //                   y: <?= (isset($show_total_visual[$value['deck_elevation']]) ? $show_total_visual[$value['deck_elevation']] : 0 ) ?>, 
  //               }, 
  //           <?php } ?>    
  //       ]
  //     }] 
  // });


  Highcharts.chart('container_row_2_1', {
    chart:{
      scrollablePlotArea: {
        minWidth: <?= count($week_list)*75 ?>,
        scrollPositionX: 1,
      },
      // styledMode: true,
    },
    colors: ['#26de81', '#2bcbba', '#45aaf2', '#4b7bec', '#a55eea', '#d1d8e0', '#778ca3', '#fed330', '#fd9644', '#fc5c65', '#20bf6b', '#0fb9b1'],
    title: {
          text: ''
    },

    subtitle: {
      text: ''
    },

    credits: {
      enabled: false,
    },

    legend: {
          layout: 'horizontal',
          align: 'center',
          verticalAlign: 'top', 
    },

    
    // tooltip: {
    //   headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
    //   pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
    //     '<td style="padding:1"><b>{point.y} </b></td></tr>',
    //   footerFormat: '</table>',
    //   shared: true,
    //   useHTML: true
    // },
    
    plotOptions: {
        line: {
            marker: {
                enabled: false
            },
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '{point.y}'
            },
            showInLegend: true
        },
    },
     
    xAxis: {
        categories: [
          <?php foreach($week_list as $key => $value){ ?>
              "<?= $value ?>",
          <?php } ?>
        ], 
    },
    yAxis: { 
          title: {
            enabled: false
          },
    },

    series: [
            
                {  
                    name: "Length Welded (mm)", 
                    data: [
                      <?php foreach($week_list as $key => $value){ ?>
                        <?= (isset($array_week_length_sum[$value]) ? $array_week_length_sum[$value] : 0 ) ?>,
                      <?php } ?>
                    ], 
                },
                {  
                    name: "Length Tested (mm)", 
                    data: [
                      <?php foreach($week_list as $key => $value){ ?>
                        <?= (isset($array_week_tested_length_sum[$value]) ? $array_week_tested_length_sum[$value] : 0 ) ?>,
                      <?php } ?>
                    ], 
                }, 
                {  
                    name: "% Tested", 
                    data: [
                      <?php foreach($week_list as $key => $value){ ?>
                        <?= (isset($percent_week[$value]) ? $percent_week[$value] : 0 ) ?>,
                      <?php } ?>
                    ], 
                    dataLabels: {
                      enabled: true,
                      format: '{point.y}%'
                    },
                },
                {  
                    name: "Defect Length (mm)", 
                    data: [
                      <?php foreach($week_list as $key => $value){ ?>
                        <?= (isset($array_week_defect_length_sum[$value]) ? $array_week_defect_length_sum[$value] : 0 ) ?>,
                      <?php } ?>
                    ], 
                },
                {  
                    name: "% Weekly Rejection Rate", 
                    data: [
                      <?php foreach($week_list as $key => $value){ ?>
                        <?= (isset($percent_rate_week[$value]) && $percent_rate_week[$value] > 0 ? $percent_rate_week[$value] : 0 ) ?>,
                      <?php } ?>
                    ], 
                    dataLabels: {
                      enabled: true,
                      format: '{point.y}%'
                    },
                }, 
                {  
                    name: "Cumulative Length Welded (mm)", 
                    data: [
                      <?php foreach($week_list as $key => $value){ ?>
                        <?= (isset($array_week_com_length_sum[$value]) ? $array_week_com_length_sum[$value] : 0 ) ?>,
                      <?php } ?>
                    ], 
                },
                {  
                    name: "Cumulative Length Tested (mm)", 
                    data: [
                      <?php foreach($week_list as $key => $value){ ?>
                        <?= (isset($array_week_tested_com_length_sum[$value]) ? $array_week_tested_com_length_sum[$value] : 0 ) ?>,
                      <?php } ?>
                    ], 
                },
                {  
                    name: "Cumulative Defect Length (mm)", 
                    data: [
                      <?php foreach($week_list as $key => $value){ ?>
                        <?= (isset($array_week_defect_com_length_sum[$value]) ? $array_week_defect_com_length_sum[$value] : 0 ) ?>,
                      <?php } ?>
                    ], 
                },
                {  
                    name: "% Tested Cumulative", 
                    data: [
                      <?php foreach($week_list as $key => $value){ ?>
                        <?= (isset($percent_tested_comulative[$value]) ? $percent_tested_comulative[$value] : 0 ) ?>,
                      <?php } ?>
                    ], 
                    dataLabels: {
                      enabled: true,
                      format: '{point.y}%'
                    },
                },
                {  
                    name: "% Rejection Rate Cumulative", 
                    data: [
                      <?php foreach($week_list as $key => $value){ ?>
                        <?= (isset($percent_defect_comulative[$value]) && $percent_defect_comulative[$value] > 0 ? $percent_defect_comulative[$value] : 0 ) ?>,
                      <?php } ?>
                    ], 
                    dataLabels: {
                      enabled: true,
                      format: '{point.y}%'
                    },
                },
                {  
                    name: "NDT Average Time (Days)", 
                    data: [
                      <?php foreach($week_list as $key => $value){ ?>
                        <?= (isset($ndt_average_time[$value]) ? $ndt_average_time[$value] : 0 ) ?>,
                      <?php } ?>
                    ], 
                },
                {  
                    name: "Cumulative NDT Average Time (Days)", 
                    data: [
                      <?php foreach($week_list as $key => $value){ ?>
                        <?= (isset($ndt_average_time_all[$value]) ? $ndt_average_time_all[$value] : 0 ) ?>,
                      <?php } ?>
                    ], 
                },  
      ], 
  });

  Highcharts.chart('container_row_2_2', {
      chart:{
        // type: 'area',
      },
      colors: ['#26de81', '#2bcbba', '#45aaf2', '#4b7bec', '#a55eea', '#d1d8e0', '#778ca3', '#fed330', '#fd9644', '#fc5c65', '#20bf6b', '#0fb9b1'],
      title: {
            text: ''
      },

      subtitle: {
        text: ''
      },

      credits: {
        enabled: false,
      },

      legend: {
            layout: 'horizontal',
            align: 'center',
            verticalAlign: 'top', 
      },

      
      plotOptions: {
        series: {
          marker: {
            enabled: false
          },
          dataLabels: {
            enabled: true,
            // allowOverlap: true
          },
          events: {
            // mouseOver: function(event) {
            //   $.each(this.data, function(i, point) {
            //     point.dataLabel.show();
            //   });
            // },
            // mouseOut: function(event) {
            //   $.each(this.data, function(i, point) {
            //     point.dataLabel.hide();
            //   });
            // }
          }
        }
      },
      
      xAxis: {
          categories: [
            <?php foreach($unique_deck as $key => $value){ ?>
                "<?= @$array_deck_name[$value['deck_elevation']] ?>",
            <?php } ?>
          ],  
      },
      yAxis: { 
            title: {
              enabled: false
            }
      },

      // tooltip: {
      //   headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
      //   pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
      //     '<td style="padding:1"><b>{point.y} </b></td></tr>',
      //   footerFormat: '</table>',
      //   shared: true,
      //   useHTML: true
      // },

      series: [
              
              {  
                  name: "Length Welded (mm)", 
                  data: [
                    <?php foreach($unique_deck as $key => $value){ ?>
                      <?= (isset($array_deck_length_sum[$value['deck_elevation']]) ? $array_deck_length_sum[$value['deck_elevation']] : 0 ) ?>,
                    <?php } ?>
                  ], 
              }, 
              {  
                  name: "Length Tested (mm)", 
                  data: [
                    <?php foreach($unique_deck as $key => $value){ ?>
                      <?= (isset($array_deck_tested_length_sum[$value['deck_elevation']]) ? $array_deck_tested_length_sum[$value['deck_elevation']] : 0 ) ?>,
                    <?php } ?>
                  ], 
              }, 
              {  
                  name: "Weld Defect Length (mm)", 
                  data: [
                    <?php foreach($unique_deck as $key => $value){ ?>
                      <?= (isset($array_deck_defect_length_sum[$value['deck_elevation']]) ? $array_deck_defect_length_sum[$value['deck_elevation']] : 0 ) ?>,
                    <?php } ?>
                  ], 
              }, 
              {  
                  name: "Defect (%)", 
                  data: [
                    <?php foreach($unique_deck as $key => $value){ ?>
                      <?= (isset($percent_defect_deck[$value['deck_elevation']]) ? $percent_defect_deck[$value['deck_elevation']] : 0 ) ?>,
                    <?php } ?>
                  ], 
                  dataLabels: {
                    enabled: true,
                    format: '{point.y}%'
                  },
              }, 
              {  
                  name: "NDT (%) Completed", 
                  data: [
                    <?php foreach($unique_deck as $key => $value){ ?>
                      <?= (isset($percent_ndt_completed_deck[$value['deck_elevation']]) ? ($percent_ndt_completed_deck[$value['deck_elevation']] > 100 ? 100 : $percent_ndt_completed_deck[$value['deck_elevation']]) : 0 ) ?>,
                    <?php } ?>
                  ], 
                  dataLabels: {
                    enabled: true,
                    format: '{point.y}%'
                  },
              }, 
              {  
                  name: "No of Joints Made", 
                  data: [
                    <?php foreach($unique_deck as $key => $value){ ?>
                      <?= (isset($array_deck_total_joint_made[$value['deck_elevation']]) ? $array_deck_total_joint_made[$value['deck_elevation']] : 0 ) ?>,
                    <?php } ?>
                  ], 
              },
              {  
                  name: "No of Joints Tested", 
                  data: [
                    <?php foreach($unique_deck as $key => $value){ ?>
                      <?= (isset($array_deck_total_joint_tested[$value['deck_elevation']]) ? $array_deck_total_joint_tested[$value['deck_elevation']] : 0 ) ?>,
                    <?php } ?>
                  ], 
              },
              <?php foreach($calculate_all_defect_by_deck as $key => $valuex){ ?>
                {  
                  name: "No of "+"<?= $key ?>", 
                  data: [
                    <?php foreach($unique_deck as $key => $value){ ?>
                      <?= (isset($valuex[$value['deck_elevation']]) ? round($valuex[$value['deck_elevation']],2) : 0 ) ?>,
                    <?php } ?>
                  ], 
                },
              <?php } ?>
              {  
                  name: "Weld To NDT Time Avg ( Days )", 
                  data: [
                    <?php foreach($unique_deck as $key => $value){ ?>
                      <?= (isset($ndt_average_time_deck[$value['deck_elevation']]) ? $ndt_average_time_deck[$value['deck_elevation']] : 0 ) ?>,
                    <?php } ?>
                  ], 
              },
              {  
                  name: "Weld To NDT Time Avg ( All Deck / Days )", 
                  data: [
                    <?php foreach($unique_deck as $key => $value){ ?>
                      <?= (isset($ndt_average_time_all_deck[$value['deck_elevation']]) ? $ndt_average_time_all_deck[$value['deck_elevation']] : 0 ) ?>,
                    <?php } ?>
                  ], 
              },

      ],

  }, function(chart) {
    // $.each(chart.series, function(i, series) {
    //   $.each(series.data, function(i, point) {
    //     point.dataLabel.hide();
    //   });
    // });

    // $('.highcharts-legend-item').hover(function(e) {
    //   chart.series[$(this).index()].onMouseOver();
    // }, function() {
    //   chart.series[$(this).index()].onMouseOut();
    // });
  });


  $(document).ready(function(){
    $("#container_weekly_reject_rate_all_deck").closest(".chart-wrapper").css("height", $("#container_alldeck_cum").outerHeight()+"px")
    $("#container_row_2_1").closest(".chart-wrapper").css("height", $("#container_alldeck_cum").outerHeight()+"px")
    $("#container_row_2_2").closest(".chart-wrapper").css("height", $("#container_alldeck_cum").outerHeight()+"px")

    Highcharts.chart('container_weekly_reject_rate_all_deck', {
      chart:{
        // type: 'area',
        scrollablePlotArea: {
          minWidth: <?= count($week_list)*75 ?>,
          scrollPositionX: 1
        }
      },
      colors: ['#26de81', '#45aaf2', '#778ca3', '#fed330', '#a55eea'],
      title: {
        text: ''
      },
      subtitle: {
        text: ''
      },
      credits: {
        enabled: false,
      },
      legend: {
        layout: 'horizontal',
        align: 'center',
        verticalAlign: 'top', 
      },
      plotOptions: {
        series: {
          marker: {
            enabled: false
          },
          dataLabels: {
            enabled: true,
            // allowOverlap: true
          },
          // events: {
          //   mouseOver: function(event) {
          //     $.each(this.data, function(i, point) {
          //       point.dataLabel.show();
          //     });
          //   },
          //   mouseOut: function(event) {
          //     $.each(this.data, function(i, point) {
          //       point.dataLabel.hide();
          //     });
          //   }
          // }
        }
      },
      xAxis: {
        categories: [
          <?php foreach($week_list as $week): ?>
            "<?= $week ?>",
          <?php endforeach ?>
        ],  
      },
      yAxis: { 
        title: {
          enabled: false
        }
      },
      // tooltip: {
      //   headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
      //   pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
      //     '<td style="padding:1"><b>{point.y} </b></td></tr>',
      //   footerFormat: '</table>',
      //   shared: true,
      //   useHTML: true
      // },
      series: [
        {  
          name: "Length Welded (mm)", 
          data: [
            <?php foreach($week_list as $week): ?>
              <?= $data_cum_all_deck[$week]['weld_length']+0 ?>,
            <?php endforeach ?>
          ], 
        },
        {
          name: "Length Tested (mm)", 
          data: [
            <?php foreach($week_list as $week): ?>
              <?= $data_cum_all_deck[$week]['tested_length']+0 ?>,
            <?php endforeach ?>
          ],
        }, 
        {  
          name: "% Tested", 
          data: [
            <?php foreach($week_list as $week): ?>
              <?= (is_nan($data_cum_all_deck[$week]['tested_length']/$data_cum_all_deck[$week]['weld_length']) ? 0 : round($data_cum_all_deck[$week]['tested_length']/$data_cum_all_deck[$week]['weld_length']*100, 2)) ?>,
            <?php endforeach ?>
          ],
          dataLabels: {
            enabled: true,
            format: '{point.y}%'
          },
        },
        {  
          name: "Defect Length (mm)", 
          data: [
            <?php foreach($week_list as $week): ?>
              <?= $data_cum_all_deck[$week]['defect_length']+0 ?>,
            <?php endforeach ?>
          ], 
        },
        {  
          name: "% Weekly Rejection Rate", 
          data: [
            <?php foreach($week_list as $week): ?>
              <?= (is_nan($data_cum_all_deck[$week]['defect_length']/$data_cum_all_deck[$week]['tested_length']) ? 0: round($data_cum_all_deck[$week]['defect_length']/$data_cum_all_deck[$week]['tested_length']*100, 2)) ?>,
            <?php endforeach ?>
          ], 
          dataLabels: {
            enabled: true,
            format: '{point.y}%'
          },
        },
      ], 
    }, function(chart) {
      // $.each(chart.series, function(i, series) {
      //   $.each(series.data, function(i, point) {
      //     point.dataLabel.hide();
      //   });
      // });

      // $('.highcharts-legend-item').hover(function(e) {
      //   chart.series[$(this).index()].onMouseOver();
      // }, function() {
      //   chart.series[$(this).index()].onMouseOut();
      // });
    });
  });
  
  function change_week_base(input) {
    window.location = '<?= base_url() ?>home/home_dashboard_rate/'+$(input).val();
  }
</script>