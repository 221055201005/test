<style>
.wtr {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

.wtr td, .wtr th {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: center;
  vertical-align: super;
}

.wtr tr:nth-child(even){background-color: #f2f2f2;}

.wtr tr:hover {background-color: #ddd;}

.wtr th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  vertical-align: middle;
  background-color: #008060;
  color: white;
}

.highcharts-figure,
.highcharts-data-table table {
    min-width: 310px;
    max-width: 100%;
    margin: 1em auto;
}

#container {
    height: 400px;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

 

</style>

 


<div id="content" class="container-fluid">

<div class="row">
  <div class="col-md-12">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">Detail Of - <?= $title_menu ?> </h6>
        </div>
        <div class="card-body bg-white">
          <div class="overflow-auto">
            <table style='width:50%;font-size:15px;font-weight:bold;'>
              <tr>
                <td style='width:200px'>Start Project Date</td>
                <td>:</td>
                <td><?= date("d F y",strtotime($start_cut_off)) ?></td>
              </tr>
              <tr>
                <td style='width:200px'>Cut Of Date</td>
                <td>:</td>
                <td><?= date("d F y",strtotime($end_cut_off)) ?></td>
              </tr>
              <tr>
                <td>Discipline</td>
                <td>:</td>
                <td>
                  <?php 
                    if($title_code == "cmltv"){
                      echo "All";
                    } else if($title_code == "ts"){
                      echo "Top Side";
                    } else if($title_code == "jkt"){
                      echo "Jacket";
                    } else if($title_code == "str"){
                      echo "Structural";
                    } else if($title_code == "pip"){
                      echo "Piping";
                    }
                  ?>  
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
     
    
    <div class="col-md-12">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">Detail Of - <?= $title_menu ?></h6>
        </div>
        <div class="card-body bg-white">
          <div class="overflow-auto">
            <figure class="highcharts-figure">
                <div id="chart_cumulative"></div>         
            </figure>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-12">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">Detail Of - Weekly Data - Rejection Rate</h6>
        </div>
        <div class="card-body bg-white">
          <div class="overflow-auto">
            <figure class="highcharts-figure">
                <div id="chart_cumulative_weekly"></div>         
            </figure>
          </div>
        </div>
      </div>
    </div>

     
</div>

  <div class="card shadow my-3 rounded-0">
    <div class="card-header">
      <h6 class="m-0">Data Table - Rejection Rate</h6>
    </div>
 
    <div class="card-body bg-white">
           
        <div class="overflow-auto">
        
        <table class="wtr" width='100%'>
          <thead>
              <tr>
                <th rowspan='2'>WEEKLY</th> 
                <th colspan='4'>OVERALL WEEKLY UT</th>
                <th colspan='4'>OVERALL WEEKLY RT</th>
                <th colspan='4'>OVERALL COMULATIVE WEEKLY UT+RT</th>  
                <th colspan='4'>OVERALL COMULATIVE</th>  
                <th rowspan='2'>AUDIT</th>
              </tr>
              <tr>                
                <th>Total<br/>Welded<br/>Length<br/>(mm)</th>
                <th>Total<br/>Tested<br/>Length<br/>(mm)</th>
                <th>Total<br/>Rejected<br/>Length<br/>(mm)</th>
                <th>Rejection<br/>Rate (%)</th>

                <th>Total<br/>Welded<br/>Length<br/>(mm)</th>
                <th>Total<br/>Tested<br/>Length<br/>(mm)</th>
                <th>Total<br/>Rejected<br/>Length<br/>(mm)</th>
                <th>Rejection<br/>Rate (%)</th>

                <th>Total<br/>Welded<br/>Length<br/>(mm)</th>
                <th>Total<br/>Tested<br/>Length<br/>(mm)</th>
                <th>Total<br/>Rejected<br/>Length<br/>(mm)</th>
                <th>Rejection<br/>Rate (%)</th>

                <th>Total<br/>Welded<br/>Length<br/>(mm)</th>
                <th>Total<br/>Tested<br/>Length<br/>(mm)</th>
                <th>Total<br/>Rejected<br/>Length<br/>(mm)</th>
                <th>Comulative<br/>Rejection<br/>Rate (%)</th>
                
              </tr>
            </thead>  
            <tbody>
                <?php  $no = 0; foreach($looping_week as $key => $value){ ?>   
                 <tr> 
                    <td>  <?php echo $key; ?> </td>  
                    <td>
                        <?php 
                            if(isset($rejection_rate_all_ut[$key]["UT"]["total_weld_of_length_all_ut"])){
                                echo $rejection_rate_all_ut[$key]["UT"]["total_weld_of_length_all_ut"]; 
                            } else {
                                echo "0"; 
                            }
                        ?>
                    </td>

                    <td>
                        <?php 
                            if(isset($rejection_rate_all_ut[$key]["UT"]["total_tested_length_all_ut"])){
                                echo $rejection_rate_all_ut[$key]["UT"]["total_tested_length_all_ut"]; 
                            } else {
                                echo "0"; 
                            }
                        ?>
                    </td>

                    <td>
                        <?php 
                            if(isset($rejection_rate_all_ut[$key]["UT"]["total_reject_all_ut"])){
                                echo $rejection_rate_all_ut[$key]["UT"]["total_reject_all_ut"]; 
                            } else {
                                echo "0"; 
                            }
                        ?>
                    </td>

                    <td>
                        <?php  
                         echo ( $rejection_rate_all_ut[$key]["UT"]["total_tested_length_all_ut"] > 0 ? round( (( (isset($rejection_rate_all_ut[$key]["UT"]["total_reject_all_ut"]) ? $rejection_rate_all_ut[$key]["UT"]["total_reject_all_ut"] : 0) / $rejection_rate_all_ut[$key]["UT"]["total_tested_length_all_ut"] ) * 100 ),2) : "0")."%";
                        ?>
                    </td>

                    <td>
                        <?php 
                            if(isset($rejection_rate_all_rt[$key]["RT"]["total_weld_of_length_all_rt"])){
                                echo $rejection_rate_all_rt[$key]["RT"]["total_weld_of_length_all_rt"]; 
                            } else {
                                echo "0"; 
                            }
                        ?>
                    </td>

                    <td>
                        <?php 
                            if(isset($rejection_rate_all_rt[$key]["RT"]["total_tested_length_all_rt"])){
                                echo $rejection_rate_all_rt[$key]["RT"]["total_tested_length_all_rt"]; 
                            } else {
                                echo "0"; 
                            }
                        ?>
                    </td>

                    <td>
                        <?php 
                            if(isset($rejection_rate_all_rt[$key]["RT"]["total_reject_all_rt"])){
                                echo $rejection_rate_all_rt[$key]["RT"]["total_reject_all_rt"]; 
                            } else {
                                echo "0"; 
                            }
                        ?>
                    </td>

                    <td>
                        <?php  
                         echo ( $rejection_rate_all_rt[$key]["RT"]["total_tested_length_all_rt"] > 0 ? round( (( (isset($rejection_rate_all_rt[$key]["RT"]["total_reject_all_rt"]) ? $rejection_rate_all_rt[$key]["RT"]["total_reject_all_rt"] : 0) / $rejection_rate_all_rt[$key]["RT"]["total_tested_length_all_rt"] ) * 100 ),2) : "0")."%";
                        ?>
                    </td>

                   <!-- A------------------------------------- -->
                     <td>
                        <?php 
                            if(isset($rejection_rate_all[$key]["total_weld_of_length_all"])){
                                echo $rejection_rate_all[$key]["total_weld_of_length_all"]; 
                            } else {
                                echo "0"; 
                            }
                        ?>
                    </td>

                    <td>
                        <?php 
                            if(isset($rejection_rate_all[$key]["total_tested_length_all"])){
                                echo $rejection_rate_all[$key]["total_tested_length_all"]; 
                            } else {
                                echo "0"; 
                            }
                        ?>
                    </td>

                    <td>
                        <?php 
                            if(isset($rejection_rate_all[$key]["total_reject_all"])){
                                echo $rejection_rate_all[$key]["total_reject_all"]; 
                            } else {
                                echo "0"; 
                            }
                        ?>
                    </td>

                    <td>
                        <?php  
                            if($rejection_rate_all[$key]["total_tested_length_all"] > 0){

                                $weekly_rate[$no] = round((( $rejection_rate_all[$key]["total_reject_all"] / $rejection_rate_all[$key]["total_tested_length_all"]) *100),2);
                                echo $weekly_rate[$no]."%";
                                
                            } else {

                                echo "0%"; 
                                $weekly_rate[$no] = "0";

                            }
                        ?>
                    </td>

                     <!-- A------------------------------------- -->

                    <td>
                        <?php 
                            if(isset($rejection_rate_all[$key]["total_weld_of_length_all"])){ 
                                $over_cum_weld_of_length_all[$no] = $rejection_rate_all[$key]["total_weld_of_length_all"];
                            } else { 
                                $over_cum_weld_of_length_all[$no] = 0;
                            } 

                            if(isset($rejection_rate_all[$key]["total_tested_length_all"])){ 
                                $over_cum_tested_all[$no] = $rejection_rate_all[$key]["total_tested_length_all"];
                            } else { 
                                $over_cum_tested_all[$no] = 0;
                            }
                        
                            if(isset($rejection_rate_all[$key]["total_reject_all"])){ 
                                $over_cum_reject_all[$no] = $rejection_rate_all[$key]["total_reject_all"];
                            } else { 
                                $over_cum_reject_all[$no] = 0;
                            }
                        ?>

                        <?php if($no == 0){ ?>
                            <?php 
                                 $count_over_length_of_weld[$no] = $over_cum_weld_of_length_all[$no];
                                 echo $count_over_length_of_weld[$no];
                                 $overall_length_of_weld[$no] = $count_over_length_of_weld[$no];  
                            ?>
                        <?php } else { ?> 
                            <?php 
                                $new_no = $no - 1;  
                                $count_over_length_of_weld[$no] = ( $over_cum_weld_of_length_all[$no] + $count_over_length_of_weld[$new_no] );
                                echo $count_over_length_of_weld[$no];
                                $overall_length_of_weld[$no] = $count_over_length_of_weld[$no]; 
                            ?>                            
                        <?php } ?>                            
                    </td>

                    <td>
                        <?php if($no == 0){ ?>
                            <?php 
                                 $count_over_tested[$no] = $over_cum_tested_all[$no];
                                 echo $count_over_tested[$no];
                                 $overall_tested[$no] = $count_over_tested[$no];  
                            ?>
                        <?php } else { ?> 
                            <?php 
                                $new_no = $no - 1;  
                                $count_over_tested[$no] = ( $over_cum_tested_all[$no] + $count_over_tested[$new_no] );
                                echo $count_over_tested[$no];
                                $overall_tested[$no] = $count_over_tested[$no]; 
                            ?>                            
                        <?php } ?>                        
                    </td>

                    <td>
                        <?php if($no == 0){ ?>
                            <?php 
                                 $count_over_reject[$no] = $over_cum_reject_all[$no];
                                 echo $count_over_reject[$no];
                                 $overall_reject[$no] = $count_over_reject[$no];  
                            ?>
                        <?php } else { ?> 
                            <?php 
                                $new_no = $no - 1;  
                                $count_over_reject[$no] = ( $over_cum_reject_all[$no] + $count_over_reject[$new_no] );
                                echo $count_over_reject[$no];
                                $overall_reject[$no] = $count_over_reject[$no]; 
                            ?>                            
                        <?php } ?>                        
                    </td>

                    <td>
                        <?php 
                            if($count_over_tested[$no] > 0){
                                $count_over_rate[$no] = round((( $count_over_reject[$no] / $count_over_tested[$no]) *100),2);
                                echo $count_over_rate[$no]."%";
                            } else {
                                $count_over_rate[$no] = "0";
                                echo "0%";
                            }
                    ?>                        
                    </td>
                    
                    <td>
                        <?php if($rejection_rate_all[$key]["total_tested_length_all"] > 0){ ?>
                        <a href='<?= base_url(); ?>rejection_rate/audit_weekly/<?= strtr($this->encryption->encrypt($key), '+=/', '.-~'); ?>/<?= strtr($this->encryption->encrypt($type_link), '+=/', '.-~'); ?>/<?= strtr($this->encryption->encrypt($type_of_module_link), '+=/', '.-~'); ?>/<?= strtr($this->encryption->encrypt($discipline_link), '+=/', '.-~'); ?>'>Source</a>
                        <?php } else { ?>
                            -
                        <?php } ?>
                    </td>

                </tr>    
                <?php $no++; } ?>         
            </tbody>
            </table>

        </div>
      
    </div>
  </div>



</div>
</div>


    <?php  
        $comulative = array();   
        $comulative_weekly = array();   
        $no = 0; 
        foreach($looping_week as $key => $value){    
            if($count_over_rate[$no] > 0){                         
                $comulative[] = $count_over_rate[$no];
            } else {
                $comulative[] = 0;
            }
            if($weekly_rate[$no] > 0){                         
                $comulative_weekly[] = $weekly_rate[$no];
            } else {
                $comulative_weekly[] = 0;
            }
           $no++;         
        }
   
        $show_comulative =  array_slice($comulative, -4, 4, true);   
        $last_4_array = array_slice($looping_week, -4, 4, true);    
    ?>
 
<script type="text/javascript">
  
  $('.dataTable').DataTable({
    "scrollY":        700,
    "scrollX":        true,
    "scrollCollapse": true,
    "fixedColumns":   {
            leftColumns: 7
        },
    "order": [[2, 'asc']]

  });


  Highcharts.chart('chart_cumulative', {
    chart: {
        backgroundColor: '#fffb8c', 
    },
    title: {
        text: 'Comulative Rejection Rate',
        y: 30,
        style: {
            color: '#000',
            font: 'bold 30px "Trebuchet MS", Verdana, sans-serif'
        }
    },
    subtitle: {
        text: 'Source: PCMS Version 2.0',
        style: {
            color: '#000',
            font: 'bold 15px "Trebuchet MS", Verdana, sans-serif'
        }
    },
    xAxis: {
        categories: [
          <?php foreach($looping_week as $key => $value){ ?> 
            'WK#<?= $key ?>', 
          <?php } ?>  
        ],
        labels: {
            style: {
                color: '#000'
            }
        },
        crosshair: true
    },
    yAxis: {
        gridLineWidth: 0,
                 
        min: 0,
        title: {
            text: 'Rejection Rate (%)',
            style: {
                color: '#000',
                font: 'bold 15px "Trebuchet MS", Verdana, sans-serif'
            }
        },
        labels: {
            style: {
                color: '#000'
            }
        },
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.2f} %</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            dataLabels: { 
                enabled: false,
                color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                style: {
                    textShadow: '0 0 3px black',
                    fontSize: '10px'
                },
                formatter: function() {
                    // numberFormat takes your label's value and the decimal places to show
                    return Highcharts.numberFormat(this.y, 2) + '%';
                },
            },   
            pointPadding: 0.2,
            borderWidth: 0
        },
        spline: {
              dataLabels: { 
                  enabled: true,
                  color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                  style: {
                      textShadow: '0 0 3px black',
                      fontSize: '15px'
                  },
                  formatter: function() {
                      // numberFormat takes your label's value and the decimal places to show
                      return Highcharts.numberFormat(this.y, 2) + '%';
                  },
              },   
              pointPadding: 0.2,
              borderWidth: 0
        }
    },
    series: [
      
      {
          type: 'column',
          color: '#022ebf',
          name: 'Rejection Rate',
          data: [                     
                      <?php  $no = 0; foreach($looping_week as $key => $value){ ?>  
                            <?php
                              
                                if($count_over_tested[$no] > 0){
                                 $count_over_rate[$no] = round((( $count_over_reject[$no] / $count_over_tested[$no]) *100),2);
                                 echo $count_over_rate[$no].",";
                                } else {
                                 echo "0,";
                                }
                            
                            ?> 
                      <?php $no++;} ?>
            ]

      } ,
      
      {
          type: 'spline',
          color: '#ff0004',
          name: 'Rejection Rate ( Trend )',
          data: [ 
                        <?php  $no = 0; foreach($looping_week as $key => $value){ ?>  
                            <?php
                              
                                if($count_over_tested[$no] > 0){
                                 $count_over_rate[$no] = round((( $count_over_reject[$no] / $count_over_tested[$no]) *100),2);
                                 echo $count_over_rate[$no].",";
                                } else {
                                 echo "0,";
                                }
                            
                            ?> 
                      <?php $no++;} ?>
          ]
      }

    ]
});


Highcharts.chart('chart_cumulative_weekly', {

    chart: {
        backgroundColor: '#0b8061', 
    },

    title: {
        text: 'Weekly Rejection Rate',
        y: 30,
        style: {
            color: '#FFF',
            font: 'bold 30px "Trebuchet MS", Verdana, sans-serif'
        }
    },  

    subtitle: {
        text: 'Source: PCMS Version 2.0',
        style: {
            color: '#FFF',
            font: 'bold 15px "Trebuchet MS", Verdana, sans-serif'
        }
    },

    xAxis: {
        categories: [
          <?php foreach($looping_week as $key => $value){ ?> 
            'WK#<?= $key ?>', 
          <?php } ?>  
        ],
        labels: {
            style: {
                color: '#FFF'
            }
        },
        crosshair: true
    },

    yAxis: {
        gridLineWidth: 0,
                 
        min: 0,
        title: {
            text: 'Rejection Rate (%)',
            style: {
                color: '#FFF',
                font: 'bold 15px "Trebuchet MS", Verdana, sans-serif'
            }
        },
        labels: {
            style: {
                color: '#FFF'
            }
        },
    },

    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.2f} %</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },

    plotOptions: {
        column: {
            dataLabels: { 
                enabled: false,
                color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                style: {
                    textShadow: '0 0 3px black',
                    fontSize: '10px'
                },
                formatter: function() {
                    // numberFormat takes your label's value and the decimal places to show
                    return Highcharts.numberFormat(this.y, 2) + '%';
                },
            },   
            pointPadding: 0.2,
            borderWidth: 0
        },
        spline: {
              dataLabels: { 
                  enabled: true,
                  color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                  style: {
                      textShadow: '0 0 3px black',
                      fontSize: '15px'
                  },
                  formatter: function() {
                      return Highcharts.numberFormat(this.y, 2) + '%';
                  },
              }, 
              marker: {
                fillColor: '#e80000',
                lineWidth: 1,
                lineColor: null // inherit from series
              },  
              pointPadding: 0.2,
              borderWidth: 0
        }
    },
    series: [
      
      {
          type: 'column',
          color: '#f2b602',
          name: 'Rejection Rate',
          data: [                     
                    <?php  $no = 0; foreach($looping_week as $key => $value){ ?>  
                        <?php                              
                            if($weekly_rate[$no] > 0){ 
                                echo $weekly_rate[$no].",";
                            } else {
                                echo "0,";
                            }                            
                        ?> 
                    <?php $no++;} ?>
            ]

      } ,
      
      {
          type: 'spline',
          color: '#0032e8',
          name: 'Rejection Rate ( Trend )',
          data: [ 
                        <?php  $no = 0; foreach($looping_week as $key => $value){ ?>  
                            <?php
                              
                              if($weekly_rate[$no] > 0){ 
                                echo $weekly_rate[$no].",";
                               } else {
                                echo "0,";
                               }
                            
                            ?> 
                      <?php $no++;} ?>
          ]
      }
      

    ],
    legend: {
        itemStyle: {
            color: '#FFF'
        }  
    }
});


    

  </script>