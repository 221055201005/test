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

    <div class="col-md-6">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">Detail Of - Latest #4 Weeks</h6>
        </div>
        <div class="card-body bg-white">
          <div class="overflow-auto">
            <figure class="highcharts-figure">
                <div id="chart_4_week"></div>         
            </figure>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">Summary Data of - Latest #4 Weeks</h6>
        </div>
        <div class="card-body bg-white">
          <div class="overflow-auto">
              <table class="wtr" width='100%'>
                <thead>
                  <tr>
                    <th>Welding Process</th>
                    <th><span id='table_title_1'>1</span></th>
                    <th><span id='table_title_2'>2</span></th>
                    <th><span id='table_title_3'>3</span></th>
                    <th><span id='table_title_4'>4</span></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><span style='text-align: left !important;'>Automatic Welding (SAW)</span></td>
                    <td><span id='chart_rate_1_aw'>0%</span></td>
                    <td><span id='chart_rate_2_aw'>0%</span></td>
                    <td><span id='chart_rate_3_aw'>0%</span></td>
                    <td><span id='chart_rate_4_aw'>0%</span></td>               
                  </tr>
                  <tr>
                    <td><span style='text-align: left !important;'>Manual Welding (GTAW & SMAW)</span></td>
                    <td><span id='chart_rate_1_mw'>0%</span></td>
                    <td><span id='chart_rate_2_mw'>0%</span></td>
                    <td><span id='chart_rate_3_mw'>0%</span></td>
                    <td><span id='chart_rate_4_mw'>0%</span></td>               
                  </tr>
                  <tr>
                    <td><span style='text-align: left !important;'>Semi Automatic Welding (FCAW & GMAW)</span></td>
                    <td><span id='chart_rate_1_saw'>0%</span></td>
                    <td><span id='chart_rate_2_saw'>0%</span></td>
                    <td><span id='chart_rate_3_saw'>0%</span></td>
                    <td><span id='chart_rate_4_saw'>0%</span></td>               
                  </tr>
                  <tr>
                    <td><span style='text-align: left !important;'>Comulative</span></td>
                    <td><span id='overall_cumulative_1'>0%</span></td>
                    <td><span id='overall_cumulative_2'>0%</span></td>
                    <td><span id='overall_cumulative_3'>0%</span></td>
                    <td><span id='overall_cumulative_4'>0%</span></td>               
                  </tr>
                </tbody>
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

     
</div>

  <div class="card shadow my-3 rounded-0">
    <div class="card-header">
      <h6 class="m-0">Data Table - <?= $title_menu ?></h6>
    </div>

    

    <div class="card-body bg-white">
           
        <div class="overflow-auto">
        
        <table class="wtr" width='100%'>
          <thead>
              <tr>
                <th rowspan='2'>WEEKLY</th>
                <th rowspan='2' width='300px'>WELDING PROCESS</th>
                <th colspan='3'>OVERALL WEEKLY UT</th>
                <th colspan='3'>OVERALL WEEKLY RT</th>
                <th colspan='3'>OVERALL CMLTV WEEKLY UT+RT</th>
                <th colspan='3'>OVERALL CUMULATIVE REJECTION RECORD</th>
                <th rowspan='2'>TARGET</th>                
                <th colspan='4'>OVERALL</th>
              </tr>
              <tr>
                
                <th>Total Length Tested<br/>(mm)</th>
                <th>Total Length Rejected<br/>(mm)</th>
                <th>Rejection Rate</th>

                <th>Total Length Tested<br/>(mm)</th>
                <th>Total Length Rejected<br/>(mm)</th>
                <th>Rejection Rate</th>

                <th>Total Length Tested<br/>(mm)</th>
                <th>Total Length Rejected<br/>(mm)</th>
                <th>Rejection Rate</th>

                <th>Total Length Tested<br/>(mm)</th>
                <th>Total Length Rejected<br/>(mm)</th>
                <th>Rejection Rate</th>

                <th>Total Length Tested (mm)</th>
                <th>Total Rejected Tested (mm)</th>
                <th>Rejection Rate</th>
                <th>Data Audit</th>
              </tr>
            </thead>  
            <tbody>
                   
                    <?php  $no = 0; foreach($looping_week as $key => $value){ ?>                      
                      <?php for($x=1;$x<=3;$x++){  ?>
                      <tr>
                        <td><?= $key ?></td>                        
                        
                        <td><?= ($x==1 ? "Automatic Welding<br/>(SAW)" : ($x==2 ? "Manual Welding<br/>( GTAW & SMAW )" : ($x==3 ? "Semi Automatic Welding<br/>( FCAW & GMAW )" :  "-" ) ) ) ?></td> 
                        
                        <td>
                            <?php 
                              if($x==1){
                                if(isset($rejection_rate_ut[$key]["UT"]["total_tested_automatic_welding_ut"])){
                                   echo $rejection_rate_ut[$key]["UT"]["total_tested_automatic_welding_ut"];
                                   $rate_ut_total_tested_automatic_welding_ut = $rejection_rate_ut[$key]["UT"]["total_tested_automatic_welding_ut"];
                                } else {
                                   echo "0";
                                   $rate_ut_total_tested_automatic_welding_ut = 0;
                                }
                              } elseif($x==2){
                                if(isset($rejection_rate_ut[$key]["UT"]["total_tested_manual_welding_ut"])){
                                  echo $rejection_rate_ut[$key]["UT"]["total_tested_manual_welding_ut"];
                                  $rate_ut_total_tested_manual_welding_ut = $rejection_rate_ut[$key]["UT"]["total_tested_manual_welding_ut"];
                                } else {
                                  echo "0";
                                  $rate_ut_total_tested_manual_welding_ut = 0;
                                }
                              } else {
                                if(isset($rejection_rate_ut[$key]["UT"]["total_tested_semi_automatic_welding_ut"])){
                                  echo $rejection_rate_ut[$key]["UT"]["total_tested_semi_automatic_welding_ut"];
                                  $rate_ut_total_tested_semi_automatic_welding_ut = $rejection_rate_ut[$key]["UT"]["total_tested_semi_automatic_welding_ut"];
                                } else {
                                  echo "0";
                                  $rate_ut_total_tested_semi_automatic_welding_ut = 0;
                                }
                              }
                            ?>
                        </td>

                        <td>
                            <?php 
                              if($x==1){
                                if(isset($rejection_rate_ut[$key]["UT"]["total_reject_automatic_welding_ut"])){
                                   echo $rejection_rate_ut[$key]["UT"]["total_reject_automatic_welding_ut"];
                                   $rate_ut_total_reject_automatic_welding_ut = $rejection_rate_ut[$key]["UT"]["total_reject_automatic_welding_ut"];
                                } else {
                                   echo "0";
                                   $rate_ut_total_reject_automatic_welding_ut = 0;
                                }
                              } elseif($x==2){
                                if(isset($rejection_rate_ut[$key]["UT"]["total_reject_manual_welding_ut"])){
                                  echo $rejection_rate_ut[$key]["UT"]["total_reject_manual_welding_ut"];
                                  $rate_ut_total_reject_manual_welding_ut = $rejection_rate_ut[$key]["UT"]["total_reject_manual_welding_ut"];
                                } else {
                                  echo "0";
                                  $rate_ut_total_reject_manual_welding_ut = 0;
                                }
                              } else {
                                if(isset($rejection_rate_ut[$key]["UT"]["total_reject_semi_automatic_welding_ut"])){
                                  echo $rejection_rate_ut[$key]["UT"]["total_reject_semi_automatic_welding_ut"];
                                  $rate_ut_total_reject_semi_automatic_welding_ut = $rejection_rate_ut[$key]["UT"]["total_reject_semi_automatic_welding_ut"];
                                } else {
                                  echo "0";
                                  $rate_ut_total_reject_semi_automatic_welding_ut = 0;
                                }
                              }
                            ?>
                        </td>

                        <td>
                            <?php 
                              if($x==1){
                                if(isset($rejection_rate_ut[$key]["UT"]["total_tested_automatic_welding_ut"])){
                                   echo ( $rejection_rate_ut[$key]["UT"]["total_tested_automatic_welding_ut"] > 0 ? round( (( (isset($rejection_rate_ut[$key]["UT"]["total_reject_automatic_welding_ut"]) ? $rejection_rate_ut[$key]["UT"]["total_reject_automatic_welding_ut"] : 0) / $rejection_rate_ut[$key]["UT"]["total_tested_automatic_welding_ut"] ) * 100 ),2) : "0")."%";
                                } else {
                                   echo "0%";
                                }
                              } elseif($x==2){
                                if(isset($rejection_rate_ut[$key]["UT"]["total_tested_manual_welding_ut"])){
                                  echo ( $rejection_rate_ut[$key]["UT"]["total_tested_manual_welding_ut"] > 0 ? round( (( (isset($rejection_rate_ut[$key]["UT"]["total_reject_manual_welding_ut"]) ? $rejection_rate_ut[$key]["UT"]["total_reject_manual_welding_ut"] : 0) / $rejection_rate_ut[$key]["UT"]["total_tested_manual_welding_ut"] ) * 100 ),2) : "0")."%";
                                } else {
                                  echo "0%";
                                }
                              } else {
                                if(isset($rejection_rate_ut[$key]["UT"]["total_tested_semi_automatic_welding_ut"])){
                                  echo ( $rejection_rate_ut[$key]["UT"]["total_tested_semi_automatic_welding_ut"] > 0 ?  round( (( (isset($rejection_rate_ut[$key]["UT"]["total_reject_semi_automatic_welding_ut"]) ? $rejection_rate_ut[$key]["UT"]["total_reject_semi_automatic_welding_ut"] : 0) / $rejection_rate_ut[$key]["UT"]["total_tested_semi_automatic_welding_ut"] ) * 100 ),2) : "0")."%";
                                } else {
                                  echo "0%";
                                }
                              }
                            ?>
                        </td>
                         
                        <td>
                            <?php 
                              if($x==1){
                                if(isset($rejection_rate_rt[$key]["RT"]["total_tested_automatic_welding_rt"])){
                                   echo $rejection_rate_rt[$key]["RT"]["total_tested_automatic_welding_rt"];
                                   $rate_rt_total_tested_automatic_welding_rt = $rejection_rate_rt[$key]["RT"]["total_tested_automatic_welding_rt"];
                                } else {
                                   echo "0";
                                   $rate_rt_total_tested_automatic_welding_rt = 0;
                                }
                              } elseif($x==2){
                                if(isset($rejection_rate_rt[$key]["RT"]["total_tested_manual_welding_rt"])){
                                  echo $rejection_rate_rt[$key]["RT"]["total_tested_manual_welding_rt"];
                                  $rate_rt_total_tested_manual_welding_rt = $rejection_rate_rt[$key]["RT"]["total_tested_manual_welding_rt"];
                                } else {
                                  echo "0";
                                  $rate_rt_total_tested_manual_welding_rt = 0;
                                }
                              } else {
                                if(isset($rejection_rate_rt[$key]["RT"]["total_tested_semi_automatic_welding_rt"])){
                                  echo $rejection_rate_rt[$key]["RT"]["total_tested_semi_automatic_welding_rt"];
                                  $rate_rt_total_tested_semi_automatic_welding_rt = $rejection_rate_rt[$key]["RT"]["total_tested_semi_automatic_welding_rt"];
                                } else {
                                  echo "0";
                                  $rate_rt_total_tested_semi_automatic_welding_rt = 0;
                                }
                              }
                            ?>
                        </td>

                        <td>
                            <?php 
                              if($x==1){
                                if(isset($rejection_rate_rt[$key]["RT"]["total_reject_automatic_welding_rt"])){
                                   echo $rejection_rate_rt[$key]["RT"]["total_reject_automatic_welding_rt"];
                                   $rate_rt_total_reject_automatic_welding_rt = $rejection_rate_rt[$key]["RT"]["total_reject_automatic_welding_rt"];
                                } else {
                                   echo "0";
                                   $rate_rt_total_reject_automatic_welding_rt = 0;
                                }
                              } elseif($x==2){
                                if(isset($rejection_rate_rt[$key]["RT"]["total_reject_manual_welding_rt"])){
                                  echo $rejection_rate_rt[$key]["RT"]["total_reject_manual_welding_rt"];
                                  $rate_rt_total_reject_manual_welding_rt = $rejection_rate_rt[$key]["RT"]["total_reject_manual_welding_rt"];
                                } else {
                                  echo "0";
                                  $rate_rt_total_reject_manual_welding_rt = 0;
                                }
                              } else {
                                if(isset($rejection_rate_rt[$key]["RT"]["total_reject_semi_automatic_welding_rt"])){
                                  echo $rejection_rate_rt[$key]["RT"]["total_reject_semi_automatic_welding_rt"];
                                  $rate_rt_total_reject_manual_welding_rt = $rejection_rate_rt[$key]["RT"]["total_reject_semi_automatic_welding_rt"];
                                } else {
                                  echo "0";
                                  $rate_rt_total_reject_manual_welding_rt = 0;
                                }
                              }
                            ?>
                        </td>

                        <td>
                            <?php 
                              if($x==1){
                                if(isset($rejection_rate_rt[$key]["RT"]["total_tested_automatic_welding_rt"])){
                                   echo ( $rejection_rate_rt[$key]["RT"]["total_tested_automatic_welding_rt"] > 0 ? round( (( (isset($rejection_rate_rt[$key]["RT"]["total_reject_automatic_welding_rt"]) ? $rejection_rate_rt[$key]["RT"]["total_reject_automatic_welding_rt"] : 0) / $rejection_rate_rt[$key]["RT"]["total_tested_automatic_welding_rt"] ) * 100 ),2) : "0")."%";
                                } else {
                                   echo "0%";
                                }
                              } elseif($x==2){
                                if(isset($rejection_rate_rt[$key]["RT"]["total_tested_manual_welding_rt"])){
                                  echo ( $rejection_rate_rt[$key]["RT"]["total_tested_manual_welding_rt"] > 0 ? round( (( (isset($rejection_rate_rt[$key]["RT"]["total_reject_manual_welding_rt"]) ? $rejection_rate_rt[$key]["RT"]["total_reject_manual_welding_rt"] : 0) / $rejection_rate_rt[$key]["RT"]["total_tested_manual_welding_rt"] ) * 100 ),2) : "0")."%";
                                } else {
                                  echo "0%";
                                }
                              } else {
                                if(isset($rejection_rate_rt[$key]["RT"]["total_tested_semi_automatic_welding_rt"])){
                                  echo ( $rejection_rate_rt[$key]["RT"]["total_tested_semi_automatic_welding_rt"] > 0 ?  round( (( (isset($rejection_rate_rt[$key]["RT"]["total_reject_semi_automatic_welding_rt"]) ? $rejection_rate_rt[$key]["RT"]["total_reject_semi_automatic_welding_rt"] : 0) / $rejection_rate_rt[$key]["RT"]["total_tested_semi_automatic_welding_rt"] ) * 100 ),2) : "0")."%";
                                } else {
                                  echo "0%";
                                }
                              }
                            ?>
                        </td>

                         
                        <td>
                            <?php                             
                              if($x==1){
                                if(($rate_ut_total_tested_automatic_welding_ut + $rate_rt_total_tested_automatic_welding_rt) > 0){
                                   echo  ($rate_ut_total_tested_automatic_welding_ut + $rate_rt_total_tested_automatic_welding_rt);
                                   $total_tested_ut_rt_automatic_welding = ($rate_ut_total_tested_automatic_welding_ut + $rate_rt_total_tested_automatic_welding_rt);
                                   $over_cum_tested_automatic_welding[$no] = ($rate_ut_total_tested_automatic_welding_ut + $rate_rt_total_tested_automatic_welding_rt);
                                } else {
                                   echo "0";
                                   $total_tested_ut_rt_automatic_welding = 0;
                                   $over_cum_tested_automatic_welding[$no] = 0;
                                }
                              } elseif($x==2){
                                if(($rate_ut_total_tested_manual_welding_ut + $rate_rt_total_tested_manual_welding_rt) > 0){
                                  echo ($rate_ut_total_tested_manual_welding_ut + $rate_rt_total_tested_manual_welding_rt);
                                  $total_tested_ut_rt_manual_welding = ($rate_ut_total_tested_manual_welding_ut + $rate_rt_total_tested_manual_welding_rt);
                                  $over_cum_tested_manual_welding[$no] = ($rate_ut_total_tested_manual_welding_ut + $rate_rt_total_tested_manual_welding_rt);
                                } else {
                                  echo "0";
                                  $total_tested_ut_rt_manual_welding = 0;
                                  $over_cum_tested_manual_welding[$no] = 0;
                                }
                              } else {                                
                                if(($rate_ut_total_tested_semi_automatic_welding_ut + $rate_rt_total_tested_semi_automatic_welding_rt) > 0){
                                  echo ($rate_ut_total_tested_semi_automatic_welding_ut + $rate_rt_total_tested_semi_automatic_welding_rt);
                                  $total_tested_ut_rt_semi_automatic_welding   = ($rate_ut_total_tested_semi_automatic_welding_ut + $rate_rt_total_tested_semi_automatic_welding_rt);
                                  $over_cum_tested_semi_automatic_welding[$no] = ($rate_ut_total_tested_semi_automatic_welding_ut + $rate_rt_total_tested_semi_automatic_welding_rt);
                                } else {
                                  echo "0";
                                  $total_tested_ut_rt_semi_automatic_welding   = 0;
                                  $over_cum_tested_semi_automatic_welding[$no] = 0;
                                }
                              }
                            ?>
                        </td>

                        <td>
                            <?php 
                              if($x==1){
                                if(($rate_ut_total_reject_automatic_welding_ut + $rate_rt_total_reject_automatic_welding_rt) > 0){
                                   echo  ($rate_ut_total_reject_automatic_welding_ut + $rate_rt_total_reject_automatic_welding_rt);
                                   $total_reject_ut_rt_automatic_welding = ($rate_ut_total_reject_automatic_welding_ut + $rate_rt_total_reject_automatic_welding_rt);
                                   $over_cum_reject_automatic_welding[$no] = ($rate_ut_total_reject_automatic_welding_ut + $rate_rt_total_reject_automatic_welding_rt);
                                } else {
                                   echo "0";
                                   $total_reject_ut_rt_automatic_welding = 0;
                                   $over_cum_reject_automatic_welding[$no] = 0;
                                }
                              } elseif($x==2){
                                if(($rate_ut_total_reject_manual_welding_ut + $rate_rt_total_reject_manual_welding_rt) > 0){
                                  echo ($rate_ut_total_reject_manual_welding_ut + $rate_rt_total_reject_manual_welding_rt);
                                  $total_reject_ut_rt_manual_welding = ($rate_ut_total_reject_manual_welding_ut + $rate_rt_total_reject_manual_welding_rt);
                                  $over_cum_reject_manual_welding[$no] = ($rate_ut_total_reject_manual_welding_ut + $rate_rt_total_reject_manual_welding_rt);
                                } else {
                                  echo "0";
                                  $total_reject_ut_rt_manual_welding = 0;
                                  $over_cum_reject_manual_welding[$no] = 0;
                                }
                              } else {                                
                                if(($rate_ut_total_reject_semi_automatic_welding_ut + $rate_rt_total_reject_semi_automatic_welding_rt) > 0){
                                  echo ($rate_ut_total_reject_semi_automatic_welding_ut + $rate_rt_total_reject_semi_automatic_welding_rt);
                                  $total_reject_ut_rt_semi_automatic_welding = ($rate_ut_total_reject_semi_automatic_welding_ut + $rate_rt_total_reject_semi_automatic_welding_rt);
                                  $over_cum_reject_semi_automatic_welding[$no] = ($rate_ut_total_reject_semi_automatic_welding_ut + $rate_rt_total_reject_semi_automatic_welding_rt);
                                } else {
                                  echo "0";
                                  $total_reject_ut_rt_semi_automatic_welding = 0;
                                  $over_cum_reject_semi_automatic_welding[$no] = 0;
                                }
                              }
                            ?>
                        </td>

                        <td>
                          <?php if($x==1){ ?>
                            <?= ($total_tested_ut_rt_automatic_welding > 0 ? round((($total_reject_ut_rt_automatic_welding/$total_tested_ut_rt_automatic_welding)*100),2)."%" : "0%" )  ?>
                          <?php } elseif($x==2){ ?>
                            <?= ($total_tested_ut_rt_manual_welding > 0 ? round((($total_reject_ut_rt_manual_welding/$total_tested_ut_rt_manual_welding)*100),2)."%" : "0%" )  ?>
                          <?php } else { ?>  
                            <?= ($total_tested_ut_rt_semi_automatic_welding > 0 ? round((($total_reject_ut_rt_semi_automatic_welding/$total_tested_ut_rt_semi_automatic_welding)*100),2)."%" : "0%" )  ?>
                          <?php } ?> 
                          <?php $get_data_source = $total_tested_ut_rt_automatic_welding + $total_tested_ut_rt_manual_welding + $total_tested_ut_rt_semi_automatic_welding; ?> 
                        </td>

                        <td>               
                          <?php if($no == 0){ ?>
                            <?php                              
                              if($x==1){
                                 $count_over_tested_aw[$no] = $over_cum_tested_automatic_welding[$no];
                                 echo $count_over_tested_aw[$no];
                                 $overall_tested_aw[$no] = $count_over_tested_aw[$no];
                              } elseif($x==2){
                                 $count_over_tested_mw[$no] = $over_cum_tested_manual_welding[$no];
                                 echo $count_over_tested_mw[$no];
                                 $overall_tested_mw[$no] = $count_over_tested_mw[$no];
                              } else {    
                                 $count_over_tested_saw[$no] = $over_cum_tested_semi_automatic_welding[$no];                            
                                 echo $count_over_tested_saw[$no];
                                 $overall_tested_saw[$no] = $count_over_tested_saw[$no];
                              }
                            ?>                            
                          <?php } else { ?>
                            <?php 
                              $new_no = $no - 1;                              
                              if($x==1){                                
                                $count_over_tested_aw[$no] = ( $over_cum_tested_automatic_welding[$no] + $count_over_tested_aw[$new_no] );
                                echo $count_over_tested_aw[$no];
                                $overall_tested_aw[$no] = $count_over_tested_aw[$no];
                              } elseif($x==2){
                                $count_over_tested_mw[$no] = ( $over_cum_tested_manual_welding[$no] + $count_over_tested_mw[$new_no] );
                                echo $count_over_tested_mw[$no];
                                $overall_tested_mw[$no] = $count_over_tested_mw[$no];
                              } else {                                
                                $count_over_tested_saw[$no] = ( $over_cum_tested_semi_automatic_welding[$no] + $count_over_tested_saw[$new_no] );
                                echo $count_over_tested_saw[$no];
                                $overall_tested_saw[$no] = $count_over_tested_saw[$no];
                              }
                            ?> 
                          <?php } ?>                         
                        </td>

                        <td>
                          <?php if($no == 0){ ?>
                            <?php                              
                              if($x==1){
                                 $count_over_reject_aw[$no] = $over_cum_reject_automatic_welding[$no];
                                 echo $count_over_reject_aw[$no];  
                                 $overall_reject_aw[$no] = $count_over_reject_aw[$no];                               
                              } elseif($x==2){
                                 $count_over_reject_mw[$no] = $over_cum_reject_manual_welding[$no];
                                 echo $count_over_reject_mw[$no]; 
                                 $overall_reject_mw[$no] = $count_over_reject_mw[$no];
                              } else {    
                                 $count_over_reject_saw[$no] = $over_cum_reject_semi_automatic_welding[$no];                            
                                 echo $count_over_reject_saw[$no];
                                 $overall_reject_saw[$no] = $count_over_reject_saw[$no];
                              }
                            ?>                            
                          <?php } else { ?>
                            <?php 
                              $new_no = $no - 1;                              
                              if($x==1){                                
                                $count_over_reject_aw[$no] = ( $over_cum_reject_automatic_welding[$no] + $count_over_reject_aw[$new_no] );
                                echo $count_over_reject_aw[$no];
                                $overall_reject_aw[$no] = $count_over_reject_aw[$no];
                              } elseif($x==2){
                                $count_over_reject_mw[$no] = ( $over_cum_reject_manual_welding[$no] + $count_over_reject_mw[$new_no] );
                                echo $count_over_reject_mw[$no];
                                $overall_reject_mw[$no] = $count_over_reject_mw[$no];
                              } else {                                
                                $count_over_reject_saw[$no] = ( $over_cum_reject_semi_automatic_welding[$no] + $count_over_reject_saw[$new_no] );
                                echo $count_over_reject_saw[$no];
                                $overall_reject_saw[$no] = $count_over_reject_saw[$no];
                              }
                            ?> 
                          <?php } ?>
                        </td>

                        <td>
                          <?php                              
                              if($x==1){
                                 if($count_over_tested_aw[$no] > 0){
                                  $count_over_rate_aw[$no] = round((( $count_over_reject_aw[$no] / $count_over_tested_aw[$no]) *100),2);
                                  echo $count_over_rate_aw[$no]."%";
                                 } else {
                                  echo "0%";
                                 }
                              } elseif($x==2){
                                if($count_over_tested_mw[$no] > 0){
                                  $count_over_rate_mw[$no] = round((( $count_over_reject_mw[$no] / $count_over_tested_mw[$no]) *100),2);
                                  echo $count_over_rate_mw[$no]."%";
                                } else {
                                  echo "0%";
                                }
                              } else {    
                                if($count_over_tested_saw[$no] > 0){
                                  $count_over_rate_saw[$no] = round((( $count_over_reject_saw[$no] / $count_over_tested_saw[$no]) *100),2);
                                  echo $count_over_rate_saw[$no]."%";
                                } else {
                                  echo "0%";
                                }
                               
                              }
                            ?>
                        </td>

                        <td> 
                          <?php if($x==1){ ?>
                            2%
                          <?php } elseif($x==2){ ?>
                            5%
                          <?php } else { ?>  
                            5%
                          <?php } ?>                            
                        </td>                            
                        
                        <td >  
                          <?php if($x == 3){ ?>                       
                            <?php $show_total_tested =  $overall_tested_aw[$no] + $overall_tested_mw[$no] +  $overall_tested_saw[$no];  ?>
                            <?= $show_total_tested  ?>
                          <?php } ?>     
                        </td>                      
                    
                        <td >  
                          <?php if($x == 3){ ?>                       
                            <?php $show_total_reject =  $overall_reject_aw[$no] + $overall_reject_mw[$no] +  $overall_reject_saw[$no];  ?>
                            <?= $show_total_reject  ?>
                          <?php } ?>     
                        </td>
                      
                        <td >
                          <?php if($x == 3){ ?>                       
                            <?php $show_total_rate = ($show_total_tested > 0 ? round((( $show_total_reject / $show_total_tested ) * 100),2) : 0 ) ; ?>
                            <?= $show_total_rate."%" ?>
                          <?php } ?>   
                        </td>
                        
                        <td>
                          <?php if($x == 3){ ?>

                            <?php if($get_data_source > 0){ ?>
                              <a href='<?= base_url(); ?>rejection_rate/audit/<?= strtr($this->encryption->encrypt($key), '+=/', '.-~'); ?>/<?= strtr($this->encryption->encrypt($type_link), '+=/', '.-~'); ?>/<?= strtr($this->encryption->encrypt($type_of_module_link), '+=/', '.-~'); ?>/<?= strtr($this->encryption->encrypt($discipline_link), '+=/', '.-~'); ?>'>Source</a>
                            <?php }  ?>

                          <?php } ?> 
                        </td>
                        
                      </tr>
                      <?php } ?>

                    <?php $no++;} ?>
            </tbody>
            </table>

        </div>
      
    </div>
  </div>



</div>
</div>


  <?php  
      $comulative = array(); 
      $data_aw    = array(); 
      $data_mw    = array(); 
      $data_saw   = array(); 
      $no = 0; 
      foreach($looping_week as $key => $value){ 
  ?>                      
        <?php for($x=1;$x<=3;$x++){  ?>

            <?php 
              if($x==1){
                if($count_over_tested_aw[$no] > 0){
                  $count_over_rate_aw[$no] = round((( $count_over_reject_aw[$no] / $count_over_tested_aw[$no]) *100),2);
                  $data_aw[] = $count_over_rate_aw[$no];
                } else {
                  $data_aw[] = 0;
                }
              }
            ?>

            <?php
              if($x==2){
                if($count_over_tested_mw[$no] > 0){
                  $count_over_rate_mw[$no] = round((( $count_over_reject_mw[$no] / $count_over_tested_mw[$no]) *100),2);
                  $data_mw[] = $count_over_rate_mw[$no];
                } else {
                  $data_mw[] = 0;
                }
              }
            ?>

            <?php
              if($x==3){
                if($count_over_tested_saw[$no] > 0){
                  $count_over_rate_saw[$no] = round((( $count_over_reject_saw[$no] / $count_over_tested_saw[$no]) *100),2);
                  $data_saw[] = $count_over_rate_saw[$no];
                } else {
                  $data_saw[] = 0;
                }
              }
            ?>

            <?php        
              if($x==3){
                $show_total_tested =  $overall_tested_aw[$no] + $overall_tested_mw[$no] +  $overall_tested_saw[$no];
                $show_total_reject =  $overall_reject_aw[$no] + $overall_reject_mw[$no] +  $overall_reject_saw[$no];
                if($show_total_tested > 0){
                  $show_total_rate = round((( $show_total_reject / $show_total_tested ) * 100),2);
                  $comulative[] = $show_total_rate;
                } else {
                  $comulative[] = 0;
                }
              }
            ?>
        <?php } ?>

  <?php $no++; } ?>

  <?php 
      $show_comulative =  array_slice($comulative, -4, 4, true);       
      $show_data_aw    =  array_slice($data_aw, -4, 4, true);       
      $show_data_mw    =  array_slice($data_mw, -4, 4, true);       
      $show_data_saw   =  array_slice($data_saw, -4, 4, true);

      $last_4_array = array_slice($looping_week, -4, 4, true);   
      
?>


        

 
              

<script type="text/javascript">

$(document).ready(function() {

  <?php
    $no_aw = 1;foreach($show_data_aw as $key => $val_aw){
  ?>
    $("#chart_rate_<?=  $no_aw ?>_aw").text("<?= $val_aw."%" ?>");
  <?php
    $no_aw++; }
  ?>

  <?php
    $no_mw = 1;foreach($show_data_mw as $key => $val_mw){
  ?>
    $("#chart_rate_<?=  $no_aw ?>_mw").text("<?= $val_mw."%" ?>");
  <?php
    $no_mw++; }
  ?>
 
  <?php
    $no_saw = 1;foreach($show_data_saw as $key => $val_saw){
  ?>
    $("#chart_rate_<?=  $no_saw ?>_saw").text("<?= $val_saw."%" ?>");
  <?php
    $no_saw++; }
  ?>

  <?php
    $no_overall = 1;foreach($show_comulative as $key => $val_com){
  ?>
    $("#overall_cumulative_<?=  $no_overall ?>").text("<?= $val_com."%" ?>");
  <?php
    $no_overall++; }
  ?>

<?php
    $title_no = 1;foreach($last_4_array as $key => $val_title){
  ?>
    $("#table_title_<?=  $title_no ?>").text("WK#<?= $key ?>");
  <?php
    $title_no++; }
  ?>

})


 

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
    
    title: {
        text: 'Rejection Rate - <?= $chart_code ?> '
    },
    subtitle: {
        text: 'Source: PCMS Version 2.0'
    },
    xAxis: {
        categories: [
          <?php foreach($looping_week as $key => $value){ ?> 
            'WK#<?= $key ?>', 
          <?php } ?>  
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Rejection Rate (%)'
        }
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
          name: 'Automatic Welding ( SAW )',
          data: [                     
                      <?php  $no = 0; foreach($looping_week as $key => $value){ ?>                      
                        <?php for($x=1;$x<=3;$x++){  ?>
                            <?php
                              if($x==1){
                                if($count_over_tested_aw[$no] > 0){
                                 $count_over_rate_aw[$no] = round((( $count_over_reject_aw[$no] / $count_over_tested_aw[$no]) *100),2);
                                 echo $count_over_rate_aw[$no].",";
                                } else {
                                 echo "0,";
                                }
                             }
                            ?>
                        <?php } ?>
                      <?php $no++;} ?>
            ]

      }, {
          type: 'column',
          name: 'Manual Welding ( GTAW & SMAW )',
          data: [ 
                    <?php  $no = 0; foreach($looping_week as $key => $value){ ?>                      
                        <?php for($x=1;$x<=3;$x++){  ?>
                            <?php
                              if($x==2){
                                if($count_over_tested_mw[$no] > 0){
                                  $count_over_rate_mw[$no] = round((( $count_over_reject_mw[$no] / $count_over_tested_mw[$no]) *100),2);
                                  echo $count_over_rate_mw[$no].",";
                                } else {
                                  echo "0,";
                                }
                              }
                            ?>
                        <?php } ?>
                      <?php $no++;} ?>
          ]

      }, {
          type: 'column',
          name: 'Semi Automatic Welding ( FCAW & GMAW )',
          data: [                      
                    <?php  $no = 0; foreach($looping_week as $key => $value){ ?>                      
                        <?php for($x=1;$x<=3;$x++){  ?>
                            <?php
                              if($x==3){
                                if($count_over_tested_saw[$no] > 0){
                                  $count_over_rate_saw[$no] = round((( $count_over_reject_saw[$no] / $count_over_tested_saw[$no]) *100),2);
                                  echo $count_over_rate_saw[$no].",";
                                } else {
                                  echo "0,";
                                }
                              }
                            ?>
                        <?php } ?>
                      <?php $no++;} ?>
          ]    

      }, 


      
      {
          type: 'spline',
          color: '#ff0004',
          name: 'Cumulative',
          data: [ 
                      <?php  $no = 0; foreach($looping_week as $key => $value){ ?>                      
                        <?php for($x=1;$x<=3;$x++){  ?>
                            <?php
                              if($x==3){
                                $show_total_tested =  $overall_tested_aw[$no] + $overall_tested_mw[$no] +  $overall_tested_saw[$no];
                                $show_total_reject =  $overall_reject_aw[$no] + $overall_reject_mw[$no] +  $overall_reject_saw[$no];
                                if($show_total_tested > 0){
                                  $show_total_rate = round((( $show_total_reject / $show_total_tested ) * 100),2);
                                  echo $show_total_rate.",";
                                } else {
                                  echo "0,";
                                }
                              }
                            ?>
                        <?php } ?>
                      <?php $no++;} ?>
          ]
      }

    ]
});


          

Highcharts.chart('chart_4_week', {
    
    title: {
        text: 'Rejection Rate - Latest #4 Weeks'
    },
    subtitle: {
        text: 'Source: PCMS Version 2.0'
    },
    xAxis: {
        categories: [
          <?php foreach($last_4_array as $key => $value){ ?> 
            'WK#<?= $key ?>', 
          <?php } ?>  
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Rejection Rate (%)'
        }
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
          name: 'Automatic Welding ( SAW )',
          data: [                     
                      <?php  $no = 0; foreach($looping_week as $key => $value){ ?>                      
                          <?php 
                            if(isset($show_data_aw[$no])){
                              echo $show_data_aw[$no].",";
                            } 
                          ?>
                      <?php $no++;} ?>
            ]

      }, {
          type: 'column',
          name: 'Manual Welding ( GTAW & SMAW )',
          data: [ 
                      <?php  $no = 0; foreach($looping_week as $key => $value){ ?>                      
                          <?php 
                            if(isset($show_data_mw[$no])){
                              echo $show_data_mw[$no].",";
                            } 
                          ?>
                      <?php $no++;} ?>
          ]

      }, {
          type: 'column',
          name: 'Semi Automatic Welding ( FCAW & GMAW )',
          data: [                      
                      <?php  $no = 0; foreach($looping_week as $key => $value){ ?>                      
                          <?php 
                            if(isset($show_data_saw[$no])){
                              echo $show_data_saw[$no].",";
                            } 
                          ?>
                      <?php $no++;} ?>
          ]    

      }, 


      
      {
          type: 'spline',
          color: '#ff0004',
          name: 'Cumulative',
          data: [ 
                      <?php  $no = 0; foreach($looping_week as $key => $value){ ?>                      
                          <?php 
                            if(isset($show_comulative[$no])){
                              echo $show_comulative[$no].",";
                            } 
                          ?>
                      <?php $no++;} ?>
          ]
      }

    ]
});

  </script>