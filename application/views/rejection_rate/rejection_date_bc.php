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
    max-width: 800px;
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
                <td style='width:100px'>Cut Of Date</td>
                <td>:</td>
                <td><?= date("d F y",strtotime($cut_off)) ?></td>
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

    <div class="col-md-6">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">Summary Data - <?= $title_menu ?></h6>
        </div>
        <div class="card-body bg-white">
          <div class="overflow-auto">
              <table class="wtr" width='100%'>
                <thead>
                  <tr>
                    <th>Welding Process</th>
                    <th>Week#1</th>
                    <th>Week#2</th>
                    <th>Week#3</th>
                    <th>Week#4</th>
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
                <th colspan='4'>OVERALL WEEKLY UT</th>
                <th colspan='4'>OVERALL WEEKLY RT</th>
                <th colspan='4'>OVERALL CMLTV WEEKLY UT+RT</th>
                <th colspan='4'>OVERALL CUMULATIVE REJECTION RECORD</th>
                <th rowspan='2'>TARGET</th>                
                <th colspan='3'>OVERALL</th>
              </tr>
              <tr>
                <th>Total Joints Tested</th>
                <th>Total Length Tested<br/>(mm)</th>
                <th>Total Length Rejected<br/>(mm)</th>
                <th>Rejection Rate</th>
                <th>Total Joints Tested</th>
                <th>Total Length Tested<br/>(mm)</th>
                <th>Total Length Rejected<br/>(mm)</th>
                <th>Rejection Rate</th>
                <th>Total Joints Tested</th>
                <th>Total Length Tested<br/>(mm)</th>
                <th>Total Length Rejected<br/>(mm)</th>
                <th>Rejection Rate</th>
                <th>Total Joints Tested</th>
                <th>Total Length Tested<br/>(mm)</th>
                <th>Total Length Rejected<br/>(mm)</th>
                <th>Rejection Rate</th>
                <th>Total Length Tested (mm)</th>
                <th>Total Rejected Tested (mm)</th>
                <th>Rejection Rate</th>
              </tr>
            </thead>  
            <tbody>
              
                <tr>
                  <td>1</td>
                  <td>Automatic Welding<br/>(SAW)</td>
                  <td>
                    <?php $ut_1_1_tjt = ( isset($rejection_rate_ut[0]["UT"]['total_joint_automatic_welding_ut']) ? $rejection_rate_ut[0]["UT"]['total_joint_automatic_welding_ut'] : 0 ); ?>
                    <?= ( isset($rejection_rate_ut[0]["UT"]['total_joint_automatic_welding_ut']) ? $rejection_rate_ut[0]["UT"]['total_joint_automatic_welding_ut'] : 0 ) ?>
                  </td>
                  <td>
                    <?php $ut_1_1_tlt = ( isset($rejection_rate_ut[0]["UT"]['total_tested_automatic_welding_ut']) ? $rejection_rate_ut[0]["UT"]['total_tested_automatic_welding_ut'] : 0 ); ?>
                    <?= ( isset($rejection_rate_ut[0]["UT"]['total_tested_automatic_welding_ut']) ? $rejection_rate_ut[0]["UT"]['total_tested_automatic_welding_ut'] : 0 ) ?>
                  </td>
                  <td>
                  <?php $ut_1_1_tlr = ( isset($rejection_rate_ut[0]["UT"]['total_reject_automatic_welding_ut']) ? $rejection_rate_ut[0]["UT"]['total_reject_automatic_welding_ut'] : 0 ); ?>
                    <?= ( isset($rejection_rate_ut[0]["UT"]['total_reject_automatic_welding_ut']) ? $rejection_rate_ut[0]["UT"]['total_reject_automatic_welding_ut'] : 0 ) ?>
                  </td>
                  <td>
                    <?php 
                      if($ut_1_1_tlt > 0){
                        echo round((($ut_1_1_tlr / $ut_1_1_tlt)*100),0)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>
                  <td>
                    <?php $rt_1_1_tjt = ( isset($rejection_rate_rt[0]["UT"]['total_joint_automatic_welding_rt']) ? $rejection_rate_rt[0]["UT"]['total_joint_automatic_welding_rt'] : 0 ); ?>
                    <?= ( isset($rejection_rate_rt[0]["UT"]['total_joint_automatic_welding_rt']) ? $rejection_rate_rt[0]["UT"]['total_joint_automatic_welding_rt'] : 0 ) ?>
                  </td>
                  <td>
                    <?php $rt_1_1_tlt = ( isset($rejection_rate_rt[0]["UT"]['total_tested_automatic_welding_rt']) ? $rejection_rate_rt[0]["UT"]['total_tested_automatic_welding_rt'] : 0 ); ?>
                    <?= ( isset($rejection_rate_rt[0]["UT"]['total_tested_automatic_welding_rt']) ? $rejection_rate_rt[0]["UT"]['total_tested_automatic_welding_rt'] : 0 ) ?>
                  </td>
                  <td>
                  <?php $rt_1_1_tlr = ( isset($rejection_rate_rt[0]["UT"]['total_reject_automatic_welding_rt']) ? $rejection_rate_rt[0]["UT"]['total_reject_automatic_welding_rt'] : 0 ); ?>
                    <?= ( isset($rejection_rate_rt[0]["UT"]['total_reject_automatic_welding_rt']) ? $rejection_rate_rt[0]["UT"]['total_reject_automatic_welding_rt'] : 0 ) ?>
                  </td>
                  <td>
                    <?php 
                      if($rt_1_1_tlt > 0){
                        echo round((($rt_1_1_tlr / $rt_1_1_tlt)*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>
                  <td><?= $ut_1_1_tjt + $rt_1_1_tjt ?></td>
                  <td><?= $ut_1_1_tlt + $rt_1_1_tlt ?></td>
                  <td><?= $ut_1_1_tlr + $rt_1_1_tlr ?></td>
                  <td>
                    <?php 
                      if(($ut_1_1_tlt + $rt_1_1_tlt) > 0){
                        echo round((( ($ut_1_1_tlr + $rt_1_1_tlr) / ($ut_1_1_tlt + $rt_1_1_tlt))*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>

                  <td><?= $ut_1_1_tjt + $rt_1_1_tjt ?></td>
                  <td><?= $ut_1_1_tlt + $rt_1_1_tlt ?></td>
                  <td><?= $ut_1_1_tlr + $rt_1_1_tlr ?></td>
                  <td>
                    <?php 
                      if(($ut_1_1_tlt + $rt_1_1_tlt) > 0){
                        echo round((( ($ut_1_1_tlr + $rt_1_1_tlr) / ($ut_1_1_tlt + $rt_1_1_tlt))*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>

                  <td>2%</td>
                  <td rowspan='3'>
                    <?php   
                      $final_1_tjt_aw_ut  = ( isset($rejection_rate_ut[0]["UT"]['total_tested_automatic_welding_ut']) ? $rejection_rate_ut[0]["UT"]['total_tested_automatic_welding_ut'] : 0 );
                      $final_1_tjt_mw_ut  = ( isset($rejection_rate_ut[0]["UT"]['total_tested_manual_welding_ut']) ? $rejection_rate_ut[0]["UT"]['total_tested_manual_welding_ut'] : 0 );
                      $final_1_tjt_saw_ut = ( isset($rejection_rate_ut[0]["UT"]['total_tested_semi_automatic_welding_ut']) ? $rejection_rate_ut[0]["UT"]['total_tested_semi_automatic_welding_ut'] : 0 );
                      
                      $final_1_tjt_aw_rt  = ( isset($rejection_rate_ut[0]["RT"]['total_tested_automatic_welding_rt']) ? $rejection_rate_ut[0]["RT"]['total_tested_automatic_welding_rt'] : 0 );
                      $final_1_tjt_mw_rt  = ( isset($rejection_rate_ut[0]["RT"]['total_tested_manual_welding_rt']) ? $rejection_rate_ut[0]["RT"]['total_tested_manual_welding_rt'] : 0 );
                      $final_1_tjt_saw_rt = ( isset($rejection_rate_ut[0]["RT"]['total_tested_semi_automatic_welding_rt']) ? $rejection_rate_ut[0]["RT"]['total_tested_semi_automatic_welding_rt'] : 0 );
                      
                      $overall_1_final_tjt = $final_1_tjt_aw_ut + $final_1_tjt_mw_ut + $final_1_tjt_saw_ut + $final_1_tjt_aw_rt + $final_1_tjt_mw_rt + $final_1_tjt_saw_rt;

                      echo $overall_1_final_tjt;                    
                    ?>
                  </td>
                  <td rowspan='3'>
                    <?php   
                      $final_1_tlr_aw_ut  = ( isset($rejection_rate_ut[0]["UT"]['total_reject_automatic_welding_ut']) ? $rejection_rate_ut[0]["UT"]['total_reject_automatic_welding_ut'] : 0 );
                      $final_1_tlr_mw_ut  = ( isset($rejection_rate_ut[0]["UT"]['total_reject_manual_welding_ut']) ? $rejection_rate_ut[0]["UT"]['total_reject_manual_welding_ut'] : 0 );
                      $final_1_tlr_saw_ut = ( isset($rejection_rate_ut[0]["UT"]['total_reject_semi_automatic_welding_ut']) ? $rejection_rate_ut[0]["UT"]['total_reject_semi_automatic_welding_ut'] : 0 );
                      
                      $final_1_tlr_aw_rt  = ( isset($rejection_rate_ut[0]["RT"]['total_reject_automatic_welding_rt']) ? $rejection_rate_ut[0]["RT"]['total_reject_automatic_welding_rt'] : 0 );
                      $final_1_tlr_mw_rt  = ( isset($rejection_rate_ut[0]["RT"]['total_reject_manual_welding_rt']) ? $rejection_rate_ut[0]["RT"]['total_reject_manual_welding_rt'] : 0 );
                      $final_1_tlr_saw_rt = ( isset($rejection_rate_ut[0]["RT"]['total_reject_semi_automatic_welding_rt']) ? $rejection_rate_ut[0]["RT"]['total_reject_semi_automatic_welding_rt'] : 0 );
                      
                      $overall_1_final_tlr = $final_1_tlr_aw_ut + $final_1_tlr_mw_ut + $final_1_tlr_saw_ut + $final_1_tlr_aw_rt + $final_1_tlr_mw_rt + $final_1_tlr_saw_rt;

                      echo $overall_1_final_tlr;                    
                    ?>
                  </td>
                  <td rowspan='3'>
                    <?php                         
                      if($overall_1_final_tjt > 0){
                        echo round((($overall_1_final_tlr/$overall_1_final_tjt)*100),2)."%";
                      } else {
                        echo "0%";
                      }                      
                    ?>
                  </td>
                </tr>

                <tr>
                  <td>1</td>
                  <td>Manual Welding<br/>( GTAW & SMAW )</td>
                  <td>
                    <?php $ut_1_2_tjt = ( isset($rejection_rate_ut[0]["UT"]['total_joint_manual_welding_ut']) ? $rejection_rate_ut[0]["UT"]['total_joint_manual_welding_ut'] : 0 ); ?>
                    <?= ( isset($rejection_rate_ut[0]["UT"]['total_joint_manual_welding_ut']) ? $rejection_rate_ut[0]["UT"]['total_joint_manual_welding_ut'] : 0 ) ?>
                  </td>
                  <td>
                    <?php $ut_1_2_tlt = ( isset($rejection_rate_ut[0]["UT"]['total_tested_manual_welding_ut']) ? $rejection_rate_ut[0]["UT"]['total_tested_manual_welding_ut'] : 0 ); ?>
                    <?= ( isset($rejection_rate_ut[0]["UT"]['total_tested_manual_welding_ut']) ? $rejection_rate_ut[0]["UT"]['total_tested_manual_welding_ut'] : 0 ) ?>
                  </td>
                  <td>
                  <?php $ut_1_2_tlr = ( isset($rejection_rate_ut[0]["UT"]['total_reject_manual_welding_ut']) ? $rejection_rate_ut[0]["UT"]['total_reject_manual_welding_ut'] : 0 ); ?>
                    <?= ( isset($rejection_rate_ut[0]["UT"]['total_reject_manual_welding_ut']) ? $rejection_rate_ut[0]["UT"]['total_reject_manual_welding_ut'] : 0 ) ?>
                  </td>
                  <td>
                    <?php 
                      if($ut_1_2_tlt > 0){
                        echo round((($ut_1_2_tlr / $ut_1_2_tlt)*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>
                  <td>
                    <?php $rt_1_2_tjt = ( isset($rejection_rate_rt[0]["UT"]['total_joint_manual_welding_rt']) ? $rejection_rate_rt[0]["UT"]['total_joint_manual_welding_rt'] : 0 ); ?>
                    <?= ( isset($rejection_rate_rt[0]["UT"]['total_joint_manual_welding_rt']) ? $rejection_rate_rt[0]["UT"]['total_joint_manual_welding_rt'] : 0 ) ?>
                  </td>
                  <td>
                    <?php $rt_1_2_tlt = ( isset($rejection_rate_rt[0]["UT"]['total_tested_manual_welding_rt']) ? $rejection_rate_rt[0]["UT"]['total_tested_manual_welding_rt'] : 0 ); ?>
                    <?= ( isset($rejection_rate_rt[0]["UT"]['total_tested_manual_welding_rt']) ? $rejection_rate_rt[0]["UT"]['total_tested_manual_welding_rt'] : 0 ) ?>
                  </td>
                  <td>
                  <?php $rt_1_2_tlr = ( isset($rejection_rate_rt[0]["UT"]['total_reject_manual_welding_rt']) ? $rejection_rate_rt[0]["UT"]['total_reject_manual_welding_rt'] : 0 ); ?>
                    <?= ( isset($rejection_rate_rt[0]["UT"]['total_reject_manual_welding_rt']) ? $rejection_rate_rt[0]["UT"]['total_reject_manual_welding_rt'] : 0 ) ?>
                  </td>
                  <td>
                    <?php 
                      if($rt_1_2_tlt > 0){
                        echo round((($rt_1_2_tlr / $rt_1_2_tlt)*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>

                  <td><?= $ut_1_2_tjt + $rt_1_2_tjt ?></td>
                  <td><?= $ut_1_2_tlt + $rt_1_2_tlt ?></td>
                  <td><?= $ut_1_2_tlr + $rt_1_2_tlr ?></td>
                  <td>
                    <?php 
                      if(($ut_1_2_tlt + $rt_1_2_tlt) > 0){
                        echo round((( ($ut_1_2_tlr + $rt_1_2_tlr) / ($ut_1_2_tlt + $rt_1_2_tlt))*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>

                  <td><?= $ut_1_2_tjt + $rt_1_2_tjt ?></td>
                  <td><?= $ut_1_2_tlt + $rt_1_2_tlt ?></td>
                  <td><?= $ut_1_2_tlr + $rt_1_2_tlr ?></td>
                  <td>
                    <?php 
                      if(($ut_1_2_tlt + $rt_1_2_tlt) > 0){
                        echo round((( ($ut_1_2_tlr + $rt_1_2_tlr) / ($ut_1_2_tlt + $rt_1_2_tlt))*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>
                  
                  <td>5%</td>
                  
                </tr>

                <tr>
                  <td>1</td>
                  <td>Semi Automatic Welding<br/>( FCAW & GMAW )</td>
                  <td>
                    <?php $ut_1_3_tjt = ( isset($rejection_rate_ut[0]["UT"]['total_joint_semi_automatic_welding_ut']) ? $rejection_rate_ut[0]["UT"]['total_joint_semi_automatic_welding_ut'] : 0 ); ?>
                    <?= ( isset($rejection_rate_ut[0]["UT"]['total_joint_semi_automatic_welding_ut']) ? $rejection_rate_ut[0]["UT"]['total_joint_semi_automatic_welding_ut'] : 0 ) ?>
                  </td>
                  <td>
                    <?php $ut_1_3_tlt = ( isset($rejection_rate_ut[0]["UT"]['total_tested_semi_automatic_welding_ut']) ? $rejection_rate_ut[0]["UT"]['total_tested_semi_automatic_welding_ut'] : 0 ); ?>
                    <?= ( isset($rejection_rate_ut[0]["UT"]['total_tested_semi_automatic_welding_ut']) ? $rejection_rate_ut[0]["UT"]['total_tested_semi_automatic_welding_ut'] : 0 ) ?>
                  </td>
                  <td>
                  <?php $ut_1_3_tlr = ( isset($rejection_rate_ut[0]["UT"]['total_reject_semi_automatic_welding_ut']) ? $rejection_rate_ut[0]["UT"]['total_reject_semi_automatic_welding_ut'] : 0 ); ?>
                    <?= ( isset($rejection_rate_ut[0]["UT"]['total_reject_semi_automatic_welding_ut']) ? $rejection_rate_ut[0]["UT"]['total_reject_semi_automatic_welding_ut'] : 0 ) ?>
                  </td>
                  <td>
                    <?php 
                      if($ut_1_3_tlt > 0){
                        echo round((($ut_1_3_tlr / $ut_1_3_tlt)*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>
                  <td>
                    <?php $rt_1_3_tjt = ( isset($rejection_rate_rt[0]["UT"]['total_joint_semi_automatic_welding_rt']) ? $rejection_rate_rt[0]["UT"]['total_joint_semi_automatic_welding_rt'] : 0 ); ?>
                    <?= ( isset($rejection_rate_rt[0]["UT"]['total_joint_semi_automatic_welding_rt']) ? $rejection_rate_rt[0]["UT"]['total_joint_semi_automatic_welding_rt'] : 0 ) ?>
                  </td>
                  <td>
                    <?php $rt_1_3_tlt = ( isset($rejection_rate_rt[0]["UT"]['total_tested_semi_automatic_welding_rt']) ? $rejection_rate_rt[0]["UT"]['total_tested_semi_automatic_welding_rt'] : 0 ); ?>
                    <?= ( isset($rejection_rate_rt[0]["UT"]['total_tested_semi_automatic_welding_rt']) ? $rejection_rate_rt[0]["UT"]['total_tested_semi_automatic_welding_rt'] : 0 ) ?>
                  </td>
                  <td>
                  <?php $rt_1_3_tlr = ( isset($rejection_rate_rt[0]["UT"]['total_reject_semi_automatic_welding_rt']) ? $rejection_rate_rt[0]["UT"]['total_reject_semi_automatic_welding_rt'] : 0 ); ?>
                    <?= ( isset($rejection_rate_rt[0]["UT"]['total_reject_semi_automatic_welding_rt']) ? $rejection_rate_rt[0]["UT"]['total_reject_semi_automatic_welding_rt'] : 0 ) ?>
                  </td>
                  <td>
                    <?php 
                      if($rt_1_3_tlt > 0){
                        echo round((($rt_1_3_tlr / $rt_1_3_tlt)*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>

                  <td><?= $ut_1_3_tjt + $rt_1_3_tjt ?></td>
                  <td><?= $ut_1_3_tlt + $rt_1_3_tlt ?></td>
                  <td><?= $ut_1_3_tlr + $rt_1_3_tlr ?></td>
                  <td>
                    <?php 
                      if(($ut_1_3_tlt + $rt_1_3_tlt) > 0){
                        echo round((( ($ut_1_3_tlr + $rt_1_3_tlr) / ($ut_1_3_tlt + $rt_1_3_tlt) )*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>

                  <td><?= $ut_1_3_tjt + $rt_1_3_tjt ?></td>
                  <td><?= $ut_1_3_tlt + $rt_1_3_tlt ?></td>
                  <td><?= $ut_1_3_tlr + $rt_1_3_tlr ?></td>
                  <td>
                    <?php 
                      if(($ut_1_3_tlt + $rt_1_3_tlt) > 0){
                        echo round((( ( $ut_1_3_tlr + $rt_1_3_tlr ) / ( $ut_1_3_tlt + $rt_1_3_tlt ))*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>
                  
                  <td>5%</td>
                  
                </tr>

                <!-- ------------- -->

                <tr>
                  <td>2</td>
                  <td>Automatic Welding<br/>(SAW)</td>
                  <td>
                    <?php $ut_2_1_tjt = ( isset($rejection_rate_ut[1]["UT"]['total_joint_automatic_welding_ut']) ? $rejection_rate_ut[1]["UT"]['total_joint_automatic_welding_ut'] : 0 ); ?>
                    <?= ( isset($rejection_rate_ut[1]["UT"]['total_joint_automatic_welding_ut']) ? $rejection_rate_ut[1]["UT"]['total_joint_automatic_welding_ut'] : 0 ) ?>
                  </td>
                  <td>
                    <?php $ut_2_1_tlt = ( isset($rejection_rate_ut[1]["UT"]['total_tested_automatic_welding_ut']) ? $rejection_rate_ut[1]["UT"]['total_tested_automatic_welding_ut'] : 0 ); ?>
                    <?= ( isset($rejection_rate_ut[1]["UT"]['total_tested_automatic_welding_ut']) ? $rejection_rate_ut[1]["UT"]['total_tested_automatic_welding_ut'] : 0 ) ?>
                  </td>
                  <td>
                  <?php $ut_2_1_tlr = ( isset($rejection_rate_ut[1]["UT"]['total_reject_automatic_welding_ut']) ? $rejection_rate_ut[1]["UT"]['total_reject_automatic_welding_ut'] : 0 ); ?>
                    <?= ( isset($rejection_rate_ut[1]["UT"]['total_reject_automatic_welding_ut']) ? $rejection_rate_ut[1]["UT"]['total_reject_automatic_welding_ut'] : 0 ) ?>
                  </td>
                  <td>
                    <?php 
                      if($ut_2_1_tlt > 0){
                        echo round((($ut_2_1_tlr / $ut_2_1_tlt)*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>
                  <td>
                    <?php $rt_2_1_tjt = ( isset($rejection_rate_rt[1]["UT"]['total_joint_automatic_welding_rt']) ? $rejection_rate_rt[1]["UT"]['total_joint_automatic_welding_rt'] : 0 ); ?>
                    <?= ( isset($rejection_rate_rt[1]["UT"]['total_joint_automatic_welding_rt']) ? $rejection_rate_rt[1]["UT"]['total_joint_automatic_welding_rt'] : 0 ) ?>
                  </td>
                  <td>
                    <?php $rt_2_1_tlt = ( isset($rejection_rate_rt[1]["UT"]['total_tested_automatic_welding_rt']) ? $rejection_rate_rt[1]["UT"]['total_tested_automatic_welding_rt'] : 0 ); ?>
                    <?= ( isset($rejection_rate_rt[1]["UT"]['total_tested_automatic_welding_rt']) ? $rejection_rate_rt[1]["UT"]['total_tested_automatic_welding_rt'] : 0 ) ?>
                  </td>
                  <td>
                  <?php $rt_2_1_tlr = ( isset($rejection_rate_rt[1]["UT"]['total_reject_automatic_welding_rt']) ? $rejection_rate_rt[1]["UT"]['total_reject_automatic_welding_rt'] : 0 ); ?>
                    <?= ( isset($rejection_rate_rt[1]["UT"]['total_reject_automatic_welding_rt']) ? $rejection_rate_rt[1]["UT"]['total_reject_automatic_welding_rt'] : 0 ) ?>
                  </td>
                  <td>
                    <?php 
                      if($rt_2_1_tlt > 0){
                        echo round((($rt_2_1_tlr / $rt_2_1_tlt)*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>
                  <td><?= $ut_2_1_tjt + $rt_2_1_tjt ?></td>
                  <td><?= $ut_2_1_tlt + $rt_2_1_tlt ?></td>
                  <td><?= $ut_2_1_tlr + $rt_2_1_tlr ?></td>
                  <td>
                    <?php 
                      if(($ut_2_1_tlt + $rt_2_1_tlt) > 0){
                        echo round((( ($ut_2_1_tlr + $rt_2_1_tlr) / ($ut_2_1_tlt + $rt_2_1_tlt))*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>
                  
                  <td><?= (($ut_1_1_tjt + $rt_1_1_tjt) + ($ut_2_1_tjt + $rt_2_1_tjt)) ?></td>
                  <td><?= (($ut_1_1_tlt + $rt_1_1_tlt) + ($ut_2_1_tlt + $rt_2_1_tlt)) ?></td>
                  <td><?= (($ut_1_1_tlr + $rt_1_1_tlr) + ($ut_2_1_tlr + $rt_2_1_tlr)) ?></td>
                  <td>
                    <?php 
                      if(((($ut_1_1_tlt + $rt_1_1_tlt) + ($ut_2_1_tlt + $rt_2_1_tlt))) > 0){
                        echo round((( ( (($ut_1_1_tlr + $rt_1_1_tlr) + ($ut_2_1_tlr + $rt_2_1_tlr)) ) / ( (($ut_1_1_tlt + $rt_1_1_tlt) + ($ut_2_1_tlt + $rt_2_1_tlt)) ))*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>
                  <td>2%</td>
                  
                  <td rowspan='3'>
                  <?php   
                      $final_2_tjt_aw_ut  = $final_1_tjt_aw_ut  + ( isset($rejection_rate_ut[1]["UT"]['total_tested_automatic_welding_ut']) ? $rejection_rate_ut[1]["UT"]['total_tested_automatic_welding_ut'] : 0 );
                      $final_2_tjt_mw_ut  = $final_1_tjt_mw_ut  + ( isset($rejection_rate_ut[1]["UT"]['total_tested_manual_welding_ut']) ? $rejection_rate_ut[1]["UT"]['total_tested_manual_welding_ut'] : 0 );
                      $final_2_tjt_saw_ut = $final_1_tjt_saw_ut + ( isset($rejection_rate_ut[1]["UT"]['total_tested_semi_automatic_welding_ut']) ? $rejection_rate_ut[1]["UT"]['total_tested_semi_automatic_welding_ut'] : 0 );
                      
                      $final_2_tjt_aw_rt  = $final_1_tjt_aw_rt + ( isset($rejection_rate_ut[1]["RT"]['total_tested_automatic_welding_rt']) ? $rejection_rate_ut[1]["RT"]['total_tested_automatic_welding_rt'] : 0 );
                      $final_2_tjt_mw_rt  = $final_1_tjt_mw_rt + ( isset($rejection_rate_ut[1]["RT"]['total_tested_manual_welding_rt']) ? $rejection_rate_ut[1]["RT"]['total_tested_manual_welding_rt'] : 0 );
                      $final_2_tjt_saw_rt = $final_1_tjt_saw_rt + ( isset($rejection_rate_ut[1]["RT"]['total_tested_semi_automatic_welding_rt']) ? $rejection_rate_ut[1]["RT"]['total_tested_semi_automatic_welding_rt'] : 0 );
                      
                      $overall_2_final_tjt =  $final_2_tjt_aw_ut + $final_2_tjt_mw_ut + $final_2_tjt_saw_ut + $final_2_tjt_aw_rt + $final_2_tjt_mw_rt + $final_2_tjt_saw_rt;

                      echo $overall_2_final_tjt;                    
                    ?>
                  </td>
                  <td rowspan='3'>
                  <?php   
                      $final_2_tlr_aw_ut  = $final_2_tlr_aw_ut  + ( isset($rejection_rate_ut[1]["UT"]['total_reject_automatic_welding_ut']) ? $rejection_rate_ut[1]["UT"]['total_reject_automatic_welding_ut'] : 0 );
                      $final_2_tlr_mw_ut  = $final_2_tlr_mw_ut  + ( isset($rejection_rate_ut[1]["UT"]['total_reject_manual_welding_ut']) ? $rejection_rate_ut[1]["UT"]['total_reject_manual_welding_ut'] : 0 );
                      $final_2_tlr_saw_ut = $final_2_tlr_saw_ut  + ( isset($rejection_rate_ut[1]["UT"]['total_reject_semi_automatic_welding_ut']) ? $rejection_rate_ut[1]["UT"]['total_reject_semi_automatic_welding_ut'] : 0 );
                      
                      $final_2_tlr_aw_rt  = $final_1_tlr_aw_rt  + ( isset($rejection_rate_ut[1]["RT"]['total_reject_automatic_welding_rt']) ? $rejection_rate_ut[1]["RT"]['total_reject_automatic_welding_rt'] : 0 );
                      $final_2_tlr_mw_rt  = $final_1_tlr_mw_rt  + ( isset($rejection_rate_ut[1]["RT"]['total_reject_manual_welding_rt']) ? $rejection_rate_ut[1]["RT"]['total_reject_manual_welding_rt'] : 0 );
                      $final_2_tlr_saw_rt = $final_1_tlr_saw_rt  + ( isset($rejection_rate_ut[1]["RT"]['total_reject_semi_automatic_welding_rt']) ? $rejection_rate_ut[1]["RT"]['total_reject_semi_automatic_welding_rt'] : 0 );
                      
                      $overall_2_final_tlr = $final_2_tlr_aw_ut + $final_2_tlr_mw_ut + $final_2_tlr_saw_ut + $final_2_tlr_aw_rt + $final_2_tlr_mw_rt + $final_2_tlr_saw_rt;

                      echo $overall_2_final_tlr;                    
                    ?>
                  </td>
                  <td rowspan='3'>
                    <?php                         
                      if($overall_2_final_tjt > 0){
                        echo round((($overall_2_final_tlr/$overall_2_final_tjt)*100),2)."%";
                      } else {
                        echo "0%";
                      }                      
                    ?>
                  </td>

                </tr>

                <tr>
                  <td>2</td>
                  <td>Manual Welding<br/>( GTAW & SMAW )</td>
                  <td>
                    <?php $ut_2_2_tjt = ( isset($rejection_rate_ut[1]["UT"]['total_joint_manual_welding_ut']) ? $rejection_rate_ut[1]["UT"]['total_joint_manual_welding_ut'] : 0 ); ?>
                    <?= ( isset($rejection_rate_ut[1]["UT"]['total_joint_manual_welding_ut']) ? $rejection_rate_ut[1]["UT"]['total_joint_manual_welding_ut'] : 0 ) ?>
                  </td>
                  <td>
                    <?php $ut_2_2_tlt = ( isset($rejection_rate_ut[1]["UT"]['total_tested_manual_welding_ut']) ? $rejection_rate_ut[1]["UT"]['total_tested_manual_welding_ut'] : 0 ); ?>
                    <?= ( isset($rejection_rate_ut[1]["UT"]['total_tested_manual_welding_ut']) ? $rejection_rate_ut[1]["UT"]['total_tested_manual_welding_ut'] : 0 ) ?>
                  </td>
                  <td>
                  <?php $ut_2_2_tlr = ( isset($rejection_rate_ut[1]["UT"]['total_reject_manual_welding_ut']) ? $rejection_rate_ut[1]["UT"]['total_reject_manual_welding_ut'] : 0 ); ?>
                    <?= ( isset($rejection_rate_ut[1]["UT"]['total_reject_manual_welding_ut']) ? $rejection_rate_ut[1]["UT"]['total_reject_manual_welding_ut'] : 0 ) ?>
                  </td>
                  <td>
                    <?php 
                      if($ut_2_2_tlt > 0){
                        echo round((($ut_2_2_tlr / $ut_2_2_tlt)*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>
                  <td>
                    <?php $rt_2_2_tjt = ( isset($rejection_rate_rt[1]["UT"]['total_joint_manual_welding_rt']) ? $rejection_rate_rt[1]["UT"]['total_joint_manual_welding_rt'] : 0 ); ?>
                    <?= ( isset($rejection_rate_rt[1]["UT"]['total_joint_manual_welding_rt']) ? $rejection_rate_rt[1]["UT"]['total_joint_manual_welding_rt'] : 0 ) ?>
                  </td>
                  <td>
                    <?php $rt_2_2_tlt = ( isset($rejection_rate_rt[1]["UT"]['total_tested_manual_welding_rt']) ? $rejection_rate_rt[1]["UT"]['total_tested_manual_welding_rt'] : 0 ); ?>
                    <?= ( isset($rejection_rate_rt[1]["UT"]['total_tested_manual_welding_rt']) ? $rejection_rate_rt[1]["UT"]['total_tested_manual_welding_rt'] : 0 ) ?>
                  </td>
                  <td>
                  <?php $rt_2_2_tlr = ( isset($rejection_rate_rt[1]["UT"]['total_reject_manual_welding_rt']) ? $rejection_rate_rt[1]["UT"]['total_reject_manual_welding_rt'] : 0 ); ?>
                    <?= ( isset($rejection_rate_rt[1]["UT"]['total_reject_manual_welding_rt']) ? $rejection_rate_rt[1]["UT"]['total_reject_manual_welding_rt'] : 0 ) ?>
                  </td>
                  <td>
                    <?php 
                      if($rt_2_2_tlt > 0){
                        echo round((($rt_2_2_tlr / $rt_2_2_tlt)*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>

                  <td><?= $ut_2_2_tjt + $rt_2_2_tjt ?></td>
                  <td><?= $ut_2_2_tlt + $rt_2_2_tlt ?></td>
                  <td><?= $ut_2_2_tlr + $rt_2_2_tlr ?></td>
                  <td>
                    <?php 
                      if(($ut_2_2_tlt + $rt_2_2_tlt) > 0){
                        echo round((( ($ut_2_2_tlr + $rt_2_2_tlr) / ($ut_2_2_tlt + $rt_2_2_tlt) )*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>

                  <td><?= (($ut_1_2_tjt + $rt_1_2_tjt) + ($ut_2_2_tjt + $rt_2_2_tjt)) ?></td>
                  <td><?= (($ut_1_2_tlt + $rt_1_2_tlt) + ($ut_2_2_tlt + $rt_2_2_tlt)) ?></td>
                  <td><?= (($ut_1_2_tlr + $rt_1_2_tlr) + ($ut_2_2_tlr + $rt_2_2_tlr)) ?></td>
                  <td>
                    <?php 
                      if(((($ut_1_2_tlt + $rt_1_2_tlt) + ($ut_2_2_tlt + $rt_2_2_tlt))) > 0){
                        echo round((( ( (($ut_1_2_tlr + $rt_1_2_tlr) + ($ut_2_2_tlr + $rt_2_2_tlr)) ) / ( (($ut_1_2_tlt + $rt_1_2_tlt) + ($ut_2_2_tlt + $rt_2_2_tlt)) ) )*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>
                  
                  <td>5%</td>
                </tr>

                <tr>
                  <td>2</td>
                  <td>Semi Automatic Welding<br/>( FCAW & GMAW )</td>
                  <td>
                    <?php $ut_2_3_tjt = ( isset($rejection_rate_ut[1]["UT"]['total_joint_semi_automatic_welding_ut']) ? $rejection_rate_ut[1]["UT"]['total_joint_semi_automatic_welding_ut'] : 0 ); ?>
                    <?= ( isset($rejection_rate_ut[1]["UT"]['total_joint_semi_automatic_welding_ut']) ? $rejection_rate_ut[1]["UT"]['total_joint_semi_automatic_welding_ut'] : 0 ) ?>
                  </td>
                  <td>
                    <?php $ut_2_3_tlt = ( isset($rejection_rate_ut[1]["UT"]['total_tested_semi_automatic_welding_ut']) ? $rejection_rate_ut[1]["UT"]['total_tested_semi_automatic_welding_ut'] : 0 ); ?>
                    <?= ( isset($rejection_rate_ut[1]["UT"]['total_tested_semi_automatic_welding_ut']) ? $rejection_rate_ut[1]["UT"]['total_tested_semi_automatic_welding_ut'] : 0 ) ?>
                  </td>
                  <td>
                  <?php $ut_2_3_tlr = ( isset($rejection_rate_ut[1]["UT"]['total_reject_semi_automatic_welding_ut']) ? $rejection_rate_ut[1]["UT"]['total_reject_semi_automatic_welding_ut'] : 0 ); ?>
                    <?= ( isset($rejection_rate_ut[1]["UT"]['total_reject_semi_automatic_welding_ut']) ? $rejection_rate_ut[1]["UT"]['total_reject_semi_automatic_welding_ut'] : 0 ) ?>
                  </td>
                  <td>
                    <?php 
                      if($ut_2_3_tlt > 0){
                        echo round((($ut_2_3_tlr / $ut_2_3_tlt)*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>
                  <td>
                    <?php $rt_2_3_tjt = ( isset($rejection_rate_rt[1]["UT"]['total_joint_semi_automatic_welding_rt']) ? $rejection_rate_rt[1]["UT"]['total_joint_semi_automatic_welding_rt'] : 0 ); ?>
                    <?= ( isset($rejection_rate_rt[1]["UT"]['total_joint_semi_automatic_welding_rt']) ? $rejection_rate_rt[1]["UT"]['total_joint_semi_automatic_welding_rt'] : 0 ) ?>
                  </td>
                  <td>
                    <?php $rt_2_3_tlt = ( isset($rejection_rate_rt[1]["UT"]['total_tested_semi_automatic_welding_rt']) ? $rejection_rate_rt[1]["UT"]['total_tested_semi_automatic_welding_rt'] : 0 ); ?>
                    <?= ( isset($rejection_rate_rt[1]["UT"]['total_tested_semi_automatic_welding_rt']) ? $rejection_rate_rt[1]["UT"]['total_tested_semi_automatic_welding_rt'] : 0 ) ?>
                  </td>
                  <td>
                  <?php $rt_2_3_tlr = ( isset($rejection_rate_rt[1]["UT"]['total_reject_semi_automatic_welding_rt']) ? $rejection_rate_rt[1]["UT"]['total_reject_semi_automatic_welding_rt'] : 0 ); ?>
                    <?= ( isset($rejection_rate_rt[1]["UT"]['total_reject_semi_automatic_welding_rt']) ? $rejection_rate_rt[1]["UT"]['total_reject_semi_automatic_welding_rt'] : 0 ) ?>
                  </td>
                  <td>
                    <?php 
                      if($rt_2_3_tlt > 0){
                        echo round((($rt_2_3_tlr / $rt_2_3_tlt)*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>

                  <td><?= $ut_2_3_tjt + $rt_2_3_tjt ?></td>
                  <td><?= $ut_2_3_tlt + $rt_2_3_tlt ?></td>
                  <td><?= $ut_2_3_tlr + $rt_2_3_tlr ?></td>
                  <td>
                    <?php 
                      if(($ut_2_3_tlt + $rt_2_3_tlt) > 0){
                        echo round((( ($ut_2_3_tlr + $rt_2_3_tlr) / ($ut_2_3_tlt + $rt_2_3_tlt) )*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>

                  <td><?= (($ut_1_3_tjt + $rt_1_3_tjt) + ($ut_2_3_tjt + $rt_2_3_tjt))  ?></td>
                  <td><?= (($ut_1_3_tlt + $rt_1_3_tlt) + ($ut_2_3_tlt + $rt_2_3_tlt))  ?></td>
                  <td><?= (($ut_1_3_tlr + $rt_1_3_tlr) + ($ut_2_3_tlr + $rt_2_3_tlr))  ?></td>
                  <td>
                    <?php 
                      if(( (($ut_1_3_tlt + $rt_1_3_tlt) + ($ut_2_3_tlt + $rt_2_3_tlt)) ) > 0){
                        echo round((( ( (($ut_1_3_tlr + $rt_1_3_tlr) + ($ut_2_3_tlr + $rt_2_3_tlr)) ) / ( (($ut_1_3_tlt + $rt_1_3_tlt) + ($ut_2_3_tlt + $rt_2_3_tlt)) ))*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>
                  
                  <td>5%</td>
                </tr>

                <!-- ------------- -->

                <tr>
                  <td>3</td>
                  <td>Automatic Welding<br/>(SAW)</td>
                  <td>
                    <?php $ut_3_1_tjt = ( isset($rejection_rate_ut[2]["UT"]['total_joint_automatic_welding_ut']) ? $rejection_rate_ut[2]["UT"]['total_joint_automatic_welding_ut'] : 0 ); ?>
                    <?= ( isset($rejection_rate_ut[2]["UT"]['total_joint_automatic_welding_ut']) ? $rejection_rate_ut[2]["UT"]['total_joint_automatic_welding_ut'] : 0 ) ?>
                  </td>
                  <td>
                    <?php $ut_3_1_tlt = ( isset($rejection_rate_ut[2]["UT"]['total_tested_automatic_welding_ut']) ? $rejection_rate_ut[2]["UT"]['total_tested_automatic_welding_ut'] : 0 ); ?>
                    <?= ( isset($rejection_rate_ut[2]["UT"]['total_tested_automatic_welding_ut']) ? $rejection_rate_ut[2]["UT"]['total_tested_automatic_welding_ut'] : 0 ) ?>
                  </td>
                  <td>
                  <?php $ut_3_1_tlr = ( isset($rejection_rate_ut[2]["UT"]['total_reject_automatic_welding_ut']) ? $rejection_rate_ut[2]["UT"]['total_reject_automatic_welding_ut'] : 0 ); ?>
                    <?= ( isset($rejection_rate_ut[2]["UT"]['total_reject_automatic_welding_ut']) ? $rejection_rate_ut[2]["UT"]['total_reject_automatic_welding_ut'] : 0 ) ?>
                  </td>
                  <td>
                    <?php 
                      if($ut_3_1_tlt > 0){
                        echo round((($ut_3_1_tlr / $ut_3_1_tlt)*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>
                  <td>
                    <?php $rt_3_1_tjt = ( isset($rejection_rate_rt[2]["UT"]['total_joint_automatic_welding_rt']) ? $rejection_rate_rt[2]["UT"]['total_joint_automatic_welding_rt'] : 0 ); ?>
                    <?= ( isset($rejection_rate_rt[2]["UT"]['total_joint_automatic_welding_rt']) ? $rejection_rate_rt[2]["UT"]['total_joint_automatic_welding_rt'] : 0 ) ?>
                  </td>
                  <td>
                    <?php $rt_3_1_tlt = ( isset($rejection_rate_rt[2]["UT"]['total_tested_automatic_welding_rt']) ? $rejection_rate_rt[2]["UT"]['total_tested_automatic_welding_rt'] : 0 ); ?>
                    <?= ( isset($rejection_rate_rt[2]["UT"]['total_tested_automatic_welding_rt']) ? $rejection_rate_rt[2]["UT"]['total_tested_automatic_welding_rt'] : 0 ) ?>
                  </td>
                  <td>
                  <?php $rt_3_1_tlr = ( isset($rejection_rate_rt[2]["UT"]['total_reject_automatic_welding_rt']) ? $rejection_rate_rt[2]["UT"]['total_reject_automatic_welding_rt'] : 0 ); ?>
                    <?= ( isset($rejection_rate_rt[2]["UT"]['total_reject_automatic_welding_rt']) ? $rejection_rate_rt[2]["UT"]['total_reject_automatic_welding_rt'] : 0 ) ?>
                  </td>
                  <td>
                    <?php 
                      if($rt_3_1_tlt > 0){
                        echo round((($rt_3_1_tlr / $rt_3_1_tlt)*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>
                  <td><?= $ut_3_1_tjt + $rt_3_1_tjt ?></td>
                  <td><?= $ut_3_1_tlt + $rt_3_1_tlt ?></td>
                  <td><?= $ut_3_1_tlr + $rt_3_1_tlr ?></td>
                  <td>
                    <?php 
                      if(($ut_3_1_tlt + $rt_3_1_tlt) > 0){
                        echo round((( ($ut_3_1_tlr + $rt_3_1_tlr) / ($ut_3_1_tlt + $rt_3_1_tlt))*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>
                  <td><?= (((($ut_1_1_tjt + $rt_1_1_tjt) + ($ut_2_1_tjt + $rt_2_1_tjt))) + ($ut_3_1_tjt + $rt_3_1_tjt)) ?></td>
                  <td><?= (((($ut_1_1_tlt + $rt_1_1_tlt) + ($ut_2_1_tlt + $rt_2_1_tlt))) + ($ut_3_1_tlt + $rt_3_1_tlt)) ?></td>
                  <td><?= (((($ut_1_1_tlr + $rt_1_1_tlr) + ($ut_2_1_tlr + $rt_2_1_tlr))) + ($ut_3_1_tlr + $rt_3_1_tlr)) ?></td>
                  <td>
                    <?php 
                      if(((((($ut_1_1_tlt + $rt_1_1_tlt) + ($ut_2_1_tlt + $rt_2_1_tlt))) + ($ut_3_1_tlt + $rt_3_1_tlt))) > 0){
                        echo round((( ( (((($ut_1_1_tlr + $rt_1_1_tlr) + ($ut_2_1_tlr + $rt_2_1_tlr))) + ($ut_3_1_tlr + $rt_3_1_tlr)) ) / ( (((($ut_1_1_tlt + $rt_1_1_tlt) + ($ut_2_1_tlt + $rt_2_1_tlt))) + ($ut_3_1_tlt + $rt_3_1_tlt)) ))*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>
                  <td>2%</td>

                  <td rowspan='3'>
                  <?php   
                      $final_3_tjt_aw_ut  = $final_2_tjt_aw_ut + ( isset($rejection_rate_ut[2]["UT"]['total_tested_automatic_welding_ut']) ? $rejection_rate_ut[2]["UT"]['total_tested_automatic_welding_ut'] : 0 );
                      $final_3_tjt_mw_ut  = $final_2_tjt_mw_ut + ( isset($rejection_rate_ut[2]["UT"]['total_tested_manual_welding_ut']) ? $rejection_rate_ut[2]["UT"]['total_tested_manual_welding_ut'] : 0 );
                      $final_3_tjt_saw_ut = $final_2_tjt_saw_ut + ( isset($rejection_rate_ut[2]["UT"]['total_tested_semi_automatic_welding_ut']) ? $rejection_rate_ut[2]["UT"]['total_tested_semi_automatic_welding_ut'] : 0 );
                      
                      $final_3_tjt_aw_rt  = $final_2_tjt_aw_rt + ( isset($rejection_rate_ut[2]["RT"]['total_tested_automatic_welding_rt']) ? $rejection_rate_ut[2]["RT"]['total_tested_automatic_welding_rt'] : 0 );
                      $final_3_tjt_mw_rt  = $final_2_tjt_mw_rt + ( isset($rejection_rate_ut[2]["RT"]['total_tested_manual_welding_rt']) ? $rejection_rate_ut[2]["RT"]['total_tested_manual_welding_rt'] : 0 );
                      $final_3_tjt_saw_rt = $final_2_tjt_saw_rt + ( isset($rejection_rate_ut[2]["RT"]['total_tested_semi_automatic_welding_rt']) ? $rejection_rate_ut[2]["RT"]['total_tested_semi_automatic_welding_rt'] : 0 );
                      
                      $overall_3_final_tjt = $final_3_tjt_aw_ut + $final_3_tjt_mw_ut + $final_3_tjt_saw_ut + $final_3_tjt_aw_rt + $final_3_tjt_mw_rt + $final_3_tjt_saw_rt;

                      echo $overall_3_final_tjt;                    
                    ?>
                  </td>
                  <td rowspan='3'>
                  <?php   
                      $final_3_tlr_aw_ut  = $final_2_tlr_aw_ut + ( isset($rejection_rate_ut[2]["UT"]['total_reject_automatic_welding_ut']) ? $rejection_rate_ut[2]["UT"]['total_reject_automatic_welding_ut'] : 0 );
                      $final_3_tlr_mw_ut  = $final_2_tlr_mw_ut + ( isset($rejection_rate_ut[2]["UT"]['total_reject_manual_welding_ut']) ? $rejection_rate_ut[2]["UT"]['total_reject_manual_welding_ut'] : 0 );
                      $final_3_tlr_saw_ut = $final_2_tlr_saw_ut + ( isset($rejection_rate_ut[2]["UT"]['total_reject_semi_automatic_welding_ut']) ? $rejection_rate_ut[2]["UT"]['total_reject_semi_automatic_welding_ut'] : 0 );
                      
                      $final_3_tlr_aw_rt  = $final_2_tlr_aw_rt + ( isset($rejection_rate_ut[2]["RT"]['total_reject_automatic_welding_rt']) ? $rejection_rate_ut[2]["RT"]['total_reject_automatic_welding_rt'] : 0 );
                      $final_3_tlr_mw_rt  = $final_2_tlr_mw_rt + ( isset($rejection_rate_ut[2]["RT"]['total_reject_manual_welding_rt']) ? $rejection_rate_ut[2]["RT"]['total_reject_manual_welding_rt'] : 0 );
                      $final_3_tlr_saw_rt = $final_2_tlr_saw_rt + ( isset($rejection_rate_ut[2]["RT"]['total_reject_semi_automatic_welding_rt']) ? $rejection_rate_ut[2]["RT"]['total_reject_semi_automatic_welding_rt'] : 0 );
                      
                      $overall_3_final_tlr = $final_3_tlr_aw_ut + $final_3_tlr_mw_ut + $final_3_tlr_saw_ut + $final_3_tlr_aw_rt + $final_3_tlr_mw_rt + $final_3_tlr_saw_rt;

                      echo $overall_3_final_tlr;                    
                    ?>
                  </td>
                  <td rowspan='3'>
                    <?php                         
                      if($overall_3_final_tjt > 0){
                        echo round((($overall_3_final_tlr/$overall_3_final_tjt)*100),2)."%";
                      } else {
                        echo "0%";
                      }                      
                    ?>
                  </td>
                </tr>

                <tr>
                  <td>3</td>
                  <td>Manual Welding<br/>( GTAW & SMAW )</td>
                  <td>
                    <?php $ut_3_2_tjt = ( isset($rejection_rate_ut[2]["UT"]['total_joint_manual_welding_ut']) ? $rejection_rate_ut[2]["UT"]['total_joint_manual_welding_ut'] : 0 ); ?>
                    <?= ( isset($rejection_rate_ut[2]["UT"]['total_joint_manual_welding_ut']) ? $rejection_rate_ut[2]["UT"]['total_joint_manual_welding_ut'] : 0 ) ?>
                  </td>
                  <td>
                    <?php $ut_3_2_tlt = ( isset($rejection_rate_ut[2]["UT"]['total_tested_manual_welding_ut']) ? $rejection_rate_ut[2]["UT"]['total_tested_manual_welding_ut'] : 0 ); ?>
                    <?= ( isset($rejection_rate_ut[2]["UT"]['total_tested_manual_welding_ut']) ? $rejection_rate_ut[2]["UT"]['total_tested_manual_welding_ut'] : 0 ) ?>
                  </td>
                  <td>
                  <?php $ut_3_2_tlr = ( isset($rejection_rate_ut[2]["UT"]['total_reject_manual_welding_ut']) ? $rejection_rate_ut[2]["UT"]['total_reject_manual_welding_ut'] : 0 ); ?>
                    <?= ( isset($rejection_rate_ut[2]["UT"]['total_reject_manual_welding_ut']) ? $rejection_rate_ut[2]["UT"]['total_reject_manual_welding_ut'] : 0 ) ?>
                  </td>
                  <td>
                    <?php 
                      if($ut_3_2_tlt > 0){
                        echo round((($ut_3_2_tlr / $ut_3_2_tlt)*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>
                  <td>
                    <?php $rt_3_2_tjt = ( isset($rejection_rate_rt[2]["UT"]['total_joint_manual_welding_rt']) ? $rejection_rate_rt[2]["UT"]['total_joint_manual_welding_rt'] : 0 ); ?>
                    <?= ( isset($rejection_rate_rt[2]["UT"]['total_joint_manual_welding_rt']) ? $rejection_rate_rt[2]["UT"]['total_joint_manual_welding_rt'] : 0 ) ?>
                  </td>
                  <td>
                    <?php $rt_3_2_tlt = ( isset($rejection_rate_rt[2]["UT"]['total_tested_manual_welding_rt']) ? $rejection_rate_rt[2]["UT"]['total_tested_manual_welding_rt'] : 0 ); ?>
                    <?= ( isset($rejection_rate_rt[2]["UT"]['total_tested_manual_welding_rt']) ? $rejection_rate_rt[2]["UT"]['total_tested_manual_welding_rt'] : 0 ) ?>
                  </td>
                  <td>
                  <?php $rt_3_2_tlr = ( isset($rejection_rate_rt[2]["UT"]['total_reject_manual_welding_rt']) ? $rejection_rate_rt[2]["UT"]['total_reject_manual_welding_rt'] : 0 ); ?>
                    <?= ( isset($rejection_rate_rt[2]["UT"]['total_reject_manual_welding_rt']) ? $rejection_rate_rt[2]["UT"]['total_reject_manual_welding_rt'] : 0 ) ?>
                  </td>
                  <td>
                    <?php 
                      if($rt_3_2_tlt > 0){
                        echo round((($rt_3_2_tlr / $rt_3_2_tlt)*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>

                  <td><?= $ut_3_2_tjt + $rt_3_2_tjt ?></td>
                  <td><?= $ut_3_2_tlt + $rt_3_2_tlt ?></td>
                  <td><?= $ut_3_2_tlr + $rt_3_2_tlr ?></td>
                  <td>
                    <?php 
                      if(($ut_3_2_tlt + $rt_3_2_tlt) > 0){
                        echo round((( ($ut_3_2_tlr + $rt_3_2_tlr) / ($ut_3_2_tlt + $rt_3_2_tlt) )*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>

                  <td><?= (((($ut_1_2_tjt + $rt_1_2_tjt) + ($ut_2_2_tjt + $rt_2_2_tjt))) + ($ut_3_2_tjt + $rt_3_2_tjt)) ?></td>
                  <td><?= (((($ut_1_2_tlt + $rt_1_2_tlt) + ($ut_2_2_tlt + $rt_2_2_tlt))) + ($ut_3_2_tlt + $rt_3_2_tlt)) ?></td>
                  <td><?= (((($ut_1_2_tlr + $rt_1_2_tlr) + ($ut_2_2_tlr + $rt_2_2_tlr))) + ($ut_3_2_tlr + $rt_3_2_tlr)) ?></td>
                  <td>
                    <?php 
                      if(((((($ut_1_2_tlt + $rt_1_2_tlt) + ($ut_2_2_tlt + $rt_2_2_tlt))) + ($ut_3_2_tlt + $rt_3_2_tlt))) > 0){
                        echo round((( ( (((($ut_1_2_tlr + $rt_1_2_tlr) + ($ut_2_2_tlr + $rt_2_2_tlr))) + ($ut_3_2_tlr + $rt_3_2_tlr)) ) / ( (((($ut_1_2_tlt + $rt_1_2_tlt) + ($ut_2_2_tlt + $rt_2_2_tlt))) + ($ut_3_2_tlt + $rt_3_2_tlt)) ) )*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>
                  
                  <td>5%</td>
                   
                </tr>

                <tr>
                  <td>3</td>
                  <td>Semi Automatic Welding<br/>( FCAW & GMAW )</td>
                  <td>
                    <?php $ut_3_3_tjt = ( isset($rejection_rate_ut[2]["UT"]['total_joint_semi_automatic_welding_ut']) ? $rejection_rate_ut[2]["UT"]['total_joint_semi_automatic_welding_ut'] : 0 ); ?>
                    <?= ( isset($rejection_rate_ut[2]["UT"]['total_joint_semi_automatic_welding_ut']) ? $rejection_rate_ut[2]["UT"]['total_joint_semi_automatic_welding_ut'] : 0 ) ?>
                  </td>
                  <td>
                    <?php $ut_3_3_tlt = ( isset($rejection_rate_ut[2]["UT"]['total_tested_semi_automatic_welding_ut']) ? $rejection_rate_ut[2]["UT"]['total_tested_semi_automatic_welding_ut'] : 0 ); ?>
                    <?= ( isset($rejection_rate_ut[2]["UT"]['total_tested_semi_automatic_welding_ut']) ? $rejection_rate_ut[2]["UT"]['total_tested_semi_automatic_welding_ut'] : 0 ) ?>
                  </td>
                  <td>
                  <?php $ut_3_3_tlr = ( isset($rejection_rate_ut[2]["UT"]['total_reject_semi_automatic_welding_ut']) ? $rejection_rate_ut[2]["UT"]['total_reject_semi_automatic_welding_ut'] : 0 ); ?>
                    <?= ( isset($rejection_rate_ut[2]["UT"]['total_reject_semi_automatic_welding_ut']) ? $rejection_rate_ut[2]["UT"]['total_reject_semi_automatic_welding_ut'] : 0 ) ?>
                  </td>
                  <td>
                    <?php 
                      if($ut_3_3_tlt > 0){
                        echo round((($ut_3_3_tlr / $ut_3_3_tlt)*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>
                  <td>
                    <?php $rt_3_3_tjt = ( isset($rejection_rate_rt[2]["UT"]['total_joint_semi_automatic_welding_rt']) ? $rejection_rate_rt[2]["UT"]['total_joint_semi_automatic_welding_rt'] : 0 ); ?>
                    <?= ( isset($rejection_rate_rt[2]["UT"]['total_joint_semi_automatic_welding_rt']) ? $rejection_rate_rt[2]["UT"]['total_joint_semi_automatic_welding_rt'] : 0 ) ?>
                  </td>
                  <td>
                    <?php $rt_3_3_tlt = ( isset($rejection_rate_rt[2]["UT"]['total_tested_semi_automatic_welding_rt']) ? $rejection_rate_rt[2]["UT"]['total_tested_semi_automatic_welding_rt'] : 0 ); ?>
                    <?= ( isset($rejection_rate_rt[2]["UT"]['total_tested_semi_automatic_welding_rt']) ? $rejection_rate_rt[2]["UT"]['total_tested_semi_automatic_welding_rt'] : 0 ) ?>
                  </td>
                  <td>
                  <?php $rt_3_3_tlr = ( isset($rejection_rate_rt[2]["UT"]['total_reject_semi_automatic_welding_rt']) ? $rejection_rate_rt[2]["UT"]['total_reject_semi_automatic_welding_rt'] : 0 ); ?>
                    <?= ( isset($rejection_rate_rt[2]["UT"]['total_reject_semi_automatic_welding_rt']) ? $rejection_rate_rt[2]["UT"]['total_reject_semi_automatic_welding_rt'] : 0 ) ?>
                  </td>
                  <td>
                    <?php 
                      if($rt_3_3_tlt > 0){
                        echo round((($rt_3_3_tlr / $rt_3_3_tlt)*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>

                  <td><?= $ut_3_3_tjt + $rt_3_3_tjt ?></td>
                  <td><?= $ut_3_3_tlt + $rt_3_3_tlt ?></td>
                  <td><?= $ut_3_3_tlr + $rt_3_3_tlr ?></td>
                  <td>
                    <?php 
                      if(($ut_3_3_tlt + $rt_3_3_tlt) > 0){
                        echo round((( ($ut_3_3_tlr + $rt_3_3_tlr) / ($ut_3_3_tlt + $rt_3_3_tlt))*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>

                  <td><?= (((($ut_1_3_tjt + $rt_1_3_tjt) + ($ut_2_3_tjt + $rt_2_3_tjt))) + ($ut_3_3_tjt + $rt_3_3_tjt))  ?></td>
                  <td><?= (((($ut_1_3_tlt + $rt_1_3_tlt) + ($ut_2_3_tlt + $rt_2_3_tlt))) + ($ut_3_3_tlt + $rt_3_3_tlt))  ?></td>
                  <td><?= (((($ut_1_3_tlr + $rt_1_3_tlr) + ($ut_2_3_tlr + $rt_2_3_tlr))) + ($ut_3_3_tlr + $rt_3_3_tlr))  ?></td>
                  <td>
                    <?php 
                      if(((((($ut_1_3_tlt + $rt_1_3_tlt) + ($ut_2_3_tlt + $rt_2_3_tlt))) + ($ut_3_3_tlt + $rt_3_3_tlt))) > 0){
                        echo round((( ( (((($ut_1_3_tlr + $rt_1_3_tlr) + ($ut_2_3_tlr + $rt_2_3_tlr))) + ($ut_3_3_tlr + $rt_3_3_tlr)) ) / ( (((($ut_1_3_tlt + $rt_1_3_tlt) + ($ut_2_3_tlt + $rt_2_3_tlt))) + ($ut_3_3_tlt + $rt_3_3_tlt)) ))*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>
                  
                  <td>5%</td>
                   
                </tr>

                <!-- ------------- -->

                <tr>
                  <td>4</td>
                  <td>Automatic Welding<br/>(SAW)</td>
                  <td>
                    <?php $ut_4_1_tjt = ( isset($rejection_rate_ut[3]["UT"]['total_joint_automatic_welding_ut']) ? $rejection_rate_ut[3]["UT"]['total_joint_automatic_welding_ut'] : 0 ); ?>
                    <?= ( isset($rejection_rate_ut[3]["UT"]['total_joint_automatic_welding_ut']) ? $rejection_rate_ut[3]["UT"]['total_joint_automatic_welding_ut'] : 0 ) ?>
                  </td>
                  <td>
                    <?php $ut_4_1_tlt = ( isset($rejection_rate_ut[3]["UT"]['total_tested_automatic_welding_ut']) ? $rejection_rate_ut[3]["UT"]['total_tested_automatic_welding_ut'] : 0 ); ?>
                    <?= ( isset($rejection_rate_ut[3]["UT"]['total_tested_automatic_welding_ut']) ? $rejection_rate_ut[3]["UT"]['total_tested_automatic_welding_ut'] : 0 ) ?>
                  </td>
                  <td>
                  <?php $ut_4_1_tlr = ( isset($rejection_rate_ut[3]["UT"]['total_reject_automatic_welding_ut']) ? $rejection_rate_ut[3]["UT"]['total_reject_automatic_welding_ut'] : 0 ); ?>
                    <?= ( isset($rejection_rate_ut[3]["UT"]['total_reject_automatic_welding_ut']) ? $rejection_rate_ut[3]["UT"]['total_reject_automatic_welding_ut'] : 0 ) ?>
                  </td>
                  <td>
                    <?php 
                      if($ut_4_1_tlt > 0){
                        echo round((($ut_4_1_tlr / $ut_4_1_tlt)*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>
                  <td>
                    <?php $rt_4_1_tjt = ( isset($rejection_rate_rt[3]["UT"]['total_joint_automatic_welding_rt']) ? $rejection_rate_rt[3]["UT"]['total_joint_automatic_welding_rt'] : 0 ); ?>
                    <?= ( isset($rejection_rate_rt[3]["UT"]['total_joint_automatic_welding_rt']) ? $rejection_rate_rt[3]["UT"]['total_joint_automatic_welding_rt'] : 0 ) ?>
                  </td>
                  <td>
                    <?php $rt_4_1_tlt = ( isset($rejection_rate_rt[3]["UT"]['total_tested_automatic_welding_rt']) ? $rejection_rate_rt[3]["UT"]['total_tested_automatic_welding_rt'] : 0 ); ?>
                    <?= ( isset($rejection_rate_rt[3]["UT"]['total_tested_automatic_welding_rt']) ? $rejection_rate_rt[3]["UT"]['total_tested_automatic_welding_rt'] : 0 ) ?>
                  </td>
                  <td>
                  <?php $rt_4_1_tlr = ( isset($rejection_rate_rt[3]["UT"]['total_reject_automatic_welding_rt']) ? $rejection_rate_rt[3]["UT"]['total_reject_automatic_welding_rt'] : 0 ); ?>
                    <?= ( isset($rejection_rate_rt[3]["UT"]['total_reject_automatic_welding_rt']) ? $rejection_rate_rt[3]["UT"]['total_reject_automatic_welding_rt'] : 0 ) ?>
                  </td>
                  <td>
                    <?php 
                      if($rt_4_1_tlt > 0){
                        echo round((($rt_4_1_tlr / $rt_4_1_tlt)*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>
                  <td><?= $ut_4_1_tjt + $rt_4_1_tjt ?></td>
                  <td><?= $ut_4_1_tlt + $rt_4_1_tlt ?></td>
                  <td><?= $ut_4_1_tlr + $rt_4_1_tlr ?></td>
                  <td>
                    <?php 
                      if(($ut_4_1_tlt + $rt_4_1_tlt) > 0){
                        echo round((( ($ut_4_1_tlr + $rt_4_1_tlr) / ($ut_4_1_tlt + $rt_4_1_tlt))*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>
                  <td><?= (((((($ut_1_1_tjt + $rt_1_1_tjt) + ($ut_2_1_tjt + $rt_2_1_tjt))) + ($ut_3_1_tjt + $rt_3_1_tjt))) + ($ut_4_1_tjt + $rt_4_1_tjt)) ?></td>
                  <td><?= (((((($ut_1_1_tlt + $rt_1_1_tlt) + ($ut_2_1_tlt + $rt_2_1_tlt))) + ($ut_3_1_tlt + $rt_3_1_tlt))) + ($ut_4_1_tlt + $rt_4_1_tlt)) ?></td>
                  <td><?= (((((($ut_1_1_tlr + $rt_1_1_tlr) + ($ut_2_1_tlr + $rt_2_1_tlr))) + ($ut_3_1_tlr + $rt_3_1_tlr))) + ($ut_4_1_tlr + $rt_4_1_tlr)) ?></td>
                  <td>
                    <?php 
                      if((((((($ut_1_1_tlt + $rt_1_1_tlt) + ($ut_2_1_tlt + $rt_2_1_tlt))) + ($ut_3_1_tlt + $rt_3_1_tlt))) + ($ut_4_1_tlt + $rt_4_1_tlt)) > 0){
                        echo round((( ( (((((($ut_1_1_tlr + $rt_1_1_tlr) + ($ut_2_1_tlr + $rt_2_1_tlr))) + ($ut_3_1_tlr + $rt_3_1_tlr))) + ($ut_4_1_tlr + $rt_4_1_tlr)) ) / ((((((($ut_1_1_tlt + $rt_1_1_tlt) + ($ut_2_1_tlt + $rt_2_1_tlt))) + ($ut_3_1_tlt + $rt_3_1_tlt))) + ($ut_4_1_tlt + $rt_4_1_tlt)) ))*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>
                  <td>2%</td>
                  <td rowspan='3'>
                  <?php   
                      $final_4_tjt_aw_ut  = $final_3_tjt_aw_ut + ( isset($rejection_rate_ut[3]["UT"]['total_tested_automatic_welding_ut']) ? $rejection_rate_ut[3]["UT"]['total_tested_automatic_welding_ut'] : 0 );
                      $final_4_tjt_mw_ut  = $final_3_tjt_mw_ut + ( isset($rejection_rate_ut[3]["UT"]['total_tested_manual_welding_ut']) ? $rejection_rate_ut[3]["UT"]['total_tested_manual_welding_ut'] : 0 );
                      $final_4_tjt_saw_ut = $final_3_tjt_saw_ut + ( isset($rejection_rate_ut[3]["UT"]['total_tested_semi_automatic_welding_ut']) ? $rejection_rate_ut[3]["UT"]['total_tested_semi_automatic_welding_ut'] : 0 );
                      
                      $final_4_tjt_aw_rt  = $final_3_tjt_aw_rt + ( isset($rejection_rate_ut[3]["RT"]['total_tested_automatic_welding_rt']) ? $rejection_rate_ut[3]["RT"]['total_tested_automatic_welding_rt'] : 0 );
                      $final_4_tjt_mw_rt  = $final_3_tjt_mw_rt + ( isset($rejection_rate_ut[3]["RT"]['total_tested_manual_welding_rt']) ? $rejection_rate_ut[3]["RT"]['total_tested_manual_welding_rt'] : 0 );
                      $final_4_tjt_saw_rt = $final_3_tjt_saw_rt + ( isset($rejection_rate_ut[3]["RT"]['total_tested_semi_automatic_welding_rt']) ? $rejection_rate_ut[3]["RT"]['total_tested_semi_automatic_welding_rt'] : 0 );
                      
                      $overall_4_final_tjt = $final_4_tjt_aw_ut + $final_4_tjt_mw_ut + $final_4_tjt_saw_ut + $final_4_tjt_aw_rt + $final_4_tjt_mw_rt + $final_4_tjt_saw_rt;

                      echo $overall_4_final_tjt;                    
                    ?>
                  </td>
                  <td rowspan='3'>
                  <?php   
                      $final_4_tlr_aw_ut  = $final_3_tlr_aw_ut + ( isset($rejection_rate_ut[3]["UT"]['total_reject_automatic_welding_ut']) ? $rejection_rate_ut[3]["UT"]['total_reject_automatic_welding_ut'] : 0 );
                      $final_4_tlr_mw_ut  = $final_3_tlr_aw_ut + ( isset($rejection_rate_ut[3]["UT"]['total_reject_manual_welding_ut']) ? $rejection_rate_ut[3]["UT"]['total_reject_manual_welding_ut'] : 0 );
                      $final_4_tlr_saw_ut = $final_3_tlr_aw_ut + ( isset($rejection_rate_ut[3]["UT"]['total_reject_semi_automatic_welding_ut']) ? $rejection_rate_ut[3]["UT"]['total_reject_semi_automatic_welding_ut'] : 0 );
                      
                      $final_4_tlr_aw_rt  = $final_3_tlr_aw_ut + ( isset($rejection_rate_ut[3]["RT"]['total_reject_automatic_welding_rt']) ? $rejection_rate_ut[3]["RT"]['total_reject_automatic_welding_rt'] : 0 );
                      $final_4_tlr_mw_rt  = $final_3_tlr_aw_ut + ( isset($rejection_rate_ut[3]["RT"]['total_reject_manual_welding_rt']) ? $rejection_rate_ut[3]["RT"]['total_reject_manual_welding_rt'] : 0 );
                      $final_4_tlr_saw_rt = $final_3_tlr_aw_ut + ( isset($rejection_rate_ut[3]["RT"]['total_reject_semi_automatic_welding_rt']) ? $rejection_rate_ut[3]["RT"]['total_reject_semi_automatic_welding_rt'] : 0 );
                      
                      $overall_4_final_tlr = $final_4_tlr_aw_ut + $final_4_tlr_mw_ut + $final_4_tlr_saw_ut + $final_4_tlr_aw_rt + $final_4_tlr_mw_rt + $final_4_tlr_saw_rt;

                      echo $overall_4_final_tlr;                    
                    ?>
                  </td>
                    <td rowspan='3'>
                    <?php                         
                        if($overall_4_final_tjt > 0){
                          echo round((($overall_4_final_tlr/$overall_4_final_tjt)*100),2)."%";
                        } else {
                          echo "0%";
                        }                      
                    ?>
                </td>
                </tr>

                <tr>
                  <td>4</td>
                  <td>Manual Welding<br/>( GTAW & SMAW )</td>
                  <td>
                    <?php $ut_4_2_tjt = ( isset($rejection_rate_ut[3]["UT"]['total_joint_manual_welding_ut']) ? $rejection_rate_ut[3]["UT"]['total_joint_manual_welding_ut'] : 0 ); ?>
                    <?= ( isset($rejection_rate_ut[3]["UT"]['total_joint_manual_welding_ut']) ? $rejection_rate_ut[3]["UT"]['total_joint_manual_welding_ut'] : 0 ) ?>
                  </td>
                  <td>
                    <?php $ut_4_2_tlt = ( isset($rejection_rate_ut[3]["UT"]['total_tested_manual_welding_ut']) ? $rejection_rate_ut[3]["UT"]['total_tested_manual_welding_ut'] : 0 ); ?>
                    <?= ( isset($rejection_rate_ut[3]["UT"]['total_tested_manual_welding_ut']) ? $rejection_rate_ut[3]["UT"]['total_tested_manual_welding_ut'] : 0 ) ?>
                  </td>
                  <td>
                  <?php $ut_4_2_tlr = ( isset($rejection_rate_ut[3]["UT"]['total_reject_manual_welding_ut']) ? $rejection_rate_ut[3]["UT"]['total_reject_manual_welding_ut'] : 0 ); ?>
                    <?= ( isset($rejection_rate_ut[3]["UT"]['total_reject_manual_welding_ut']) ? $rejection_rate_ut[3]["UT"]['total_reject_manual_welding_ut'] : 0 ) ?>
                  </td>
                  <td>
                    <?php 
                      if($ut_4_2_tlt > 0){
                        echo round((($ut_4_2_tlr / $ut_4_2_tlt)*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>
                  <td>
                    <?php $rt_4_2_tjt = ( isset($rejection_rate_rt[3]["UT"]['total_joint_manual_welding_rt']) ? $rejection_rate_rt[3]["UT"]['total_joint_manual_welding_rt'] : 0 ); ?>
                    <?= ( isset($rejection_rate_rt[3]["UT"]['total_joint_manual_welding_rt']) ? $rejection_rate_rt[3]["UT"]['total_joint_manual_welding_rt'] : 0 ) ?>
                  </td>
                  <td>
                    <?php $rt_4_2_tlt = ( isset($rejection_rate_rt[3]["UT"]['total_tested_manual_welding_rt']) ? $rejection_rate_rt[3]["UT"]['total_tested_manual_welding_rt'] : 0 ); ?>
                    <?= ( isset($rejection_rate_rt[3]["UT"]['total_tested_manual_welding_rt']) ? $rejection_rate_rt[3]["UT"]['total_tested_manual_welding_rt'] : 0 ) ?>
                  </td>
                  <td>
                  <?php $rt_4_2_tlr = ( isset($rejection_rate_rt[3]["UT"]['total_reject_manual_welding_rt']) ? $rejection_rate_rt[3]["UT"]['total_reject_manual_welding_rt'] : 0 ); ?>
                    <?= ( isset($rejection_rate_rt[3]["UT"]['total_reject_manual_welding_rt']) ? $rejection_rate_rt[3]["UT"]['total_reject_manual_welding_rt'] : 0 ) ?>
                  </td>
                  <td>
                    <?php 
                      if($rt_4_2_tlt > 0){
                        echo round((($rt_4_2_tlr / $rt_4_2_tlt)*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>

                  <td><?= $ut_4_2_tjt + $rt_4_2_tjt ?></td>
                  <td><?= $ut_4_2_tlt + $rt_4_2_tlt ?></td>
                  <td><?= $ut_4_2_tlr + $rt_4_2_tlr ?></td>
                  <td>
                    <?php 
                      if(($ut_4_2_tlt + $rt_4_2_tlt) > 0){
                        echo round((( ($ut_4_2_tlr + $rt_4_2_tlr) / ($ut_4_2_tlt + $rt_4_2_tlt) )*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>

                  <td><?= (((((($ut_1_2_tjt + $rt_1_2_tjt) + ($ut_2_2_tjt + $rt_2_2_tjt))) + ($ut_3_2_tjt + $rt_3_2_tjt))) + ($ut_4_2_tjt + $rt_4_2_tjt)) ?></td>
                  <td><?= (((((($ut_1_2_tlt + $rt_1_2_tlt) + ($ut_2_2_tlt + $rt_2_2_tlt))) + ($ut_3_2_tlt + $rt_3_2_tlt))) + ($ut_4_2_tlt + $rt_4_2_tlt)) ?></td>
                  <td><?= (((((($ut_1_2_tlr + $rt_1_2_tlr) + ($ut_2_2_tlr + $rt_2_2_tlr))) + ($ut_3_2_tlr + $rt_3_2_tlr))) + ($ut_4_2_tlr + $rt_4_2_tlr)) ?></td>
                  <td>
                    <?php 
                      if(((((((($ut_1_2_tlt + $rt_1_2_tlt) + ($ut_2_2_tlt + $rt_2_2_tlt))) + ($ut_3_2_tlt + $rt_3_2_tlt))) + ($ut_4_2_tlt + $rt_4_2_tlt))) > 0){
                        echo round((( ( (((((($ut_1_2_tlr + $rt_1_2_tlr) + ($ut_2_2_tlr + $rt_2_2_tlr))) + ($ut_3_2_tlr + $rt_3_2_tlr))) + ($ut_4_2_tlr + $rt_4_2_tlr)) ) / ( (((((($ut_1_2_tlt + $rt_1_2_tlt) + ($ut_2_2_tlt + $rt_2_2_tlt))) + ($ut_3_2_tlt + $rt_3_2_tlt))) + ($ut_4_2_tlt + $rt_4_2_tlt)) ) )*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>
                  
                  <td>5%</td>
                </tr>

                <tr>
                  <td>4</td>
                  <td>Semi Automatic Welding<br/>( FCAW & GMAW )</td>
                  <td>
                    <?php $ut_4_3_tjt = ( isset($rejection_rate_ut[3]["UT"]['total_joint_semi_automatic_welding_ut']) ? $rejection_rate_ut[3]["UT"]['total_joint_semi_automatic_welding_ut'] : 0 ); ?>
                    <?= ( isset($rejection_rate_ut[3]["UT"]['total_joint_semi_automatic_welding_ut']) ? $rejection_rate_ut[3]["UT"]['total_joint_semi_automatic_welding_ut'] : 0 ) ?>
                  </td>
                  <td>
                    <?php $ut_4_3_tlt = ( isset($rejection_rate_ut[3]["UT"]['total_tested_semi_automatic_welding_ut']) ? $rejection_rate_ut[3]["UT"]['total_tested_semi_automatic_welding_ut'] : 0 ); ?>
                    <?= ( isset($rejection_rate_ut[3]["UT"]['total_tested_semi_automatic_welding_ut']) ? $rejection_rate_ut[3]["UT"]['total_tested_semi_automatic_welding_ut'] : 0 ) ?>
                  </td>
                  <td>
                  <?php $ut_4_3_tlr = ( isset($rejection_rate_ut[3]["UT"]['total_reject_semi_automatic_welding_ut']) ? $rejection_rate_ut[3]["UT"]['total_reject_semi_automatic_welding_ut'] : 0 ); ?>
                    <?= ( isset($rejection_rate_ut[3]["UT"]['total_reject_semi_automatic_welding_ut']) ? $rejection_rate_ut[3]["UT"]['total_reject_semi_automatic_welding_ut'] : 0 ) ?>
                  </td>
                  <td>
                    <?php 
                      if($ut_4_3_tlt > 0){
                        echo round((($ut_4_3_tlr / $ut_4_3_tlt)*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>
                  <td>
                    <?php $rt_4_3_tjt = ( isset($rejection_rate_rt[3]["UT"]['total_joint_semi_automatic_welding_rt']) ? $rejection_rate_rt[3]["UT"]['total_joint_semi_automatic_welding_rt'] : 0 ); ?>
                    <?= ( isset($rejection_rate_rt[3]["UT"]['total_joint_semi_automatic_welding_rt']) ? $rejection_rate_rt[3]["UT"]['total_joint_semi_automatic_welding_rt'] : 0 ) ?>
                  </td>
                  <td>
                    <?php $rt_4_3_tlt = ( isset($rejection_rate_rt[3]["UT"]['total_tested_semi_automatic_welding_rt']) ? $rejection_rate_rt[3]["UT"]['total_tested_semi_automatic_welding_rt'] : 0 ); ?>
                    <?= ( isset($rejection_rate_rt[3]["UT"]['total_tested_semi_automatic_welding_rt']) ? $rejection_rate_rt[3]["UT"]['total_tested_semi_automatic_welding_rt'] : 0 ) ?>
                  </td>
                  <td>
                  <?php $rt_4_3_tlr = ( isset($rejection_rate_rt[3]["UT"]['total_reject_semi_automatic_welding_rt']) ? $rejection_rate_rt[3]["UT"]['total_reject_semi_automatic_welding_rt'] : 0 ); ?>
                    <?= ( isset($rejection_rate_rt[3]["UT"]['total_reject_semi_automatic_welding_rt']) ? $rejection_rate_rt[3]["UT"]['total_reject_semi_automatic_welding_rt'] : 0 ) ?>
                  </td>
                  <td>
                    <?php 
                      if($rt_4_3_tlt > 0){
                        echo round((($rt_4_3_tlr / $rt_4_3_tlt)*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>

                  <td><?= $ut_4_3_tjt + $rt_4_3_tjt ?></td>
                  <td><?= $ut_4_3_tlt + $rt_4_3_tlt ?></td>
                  <td><?= $ut_4_3_tlr + $rt_4_3_tlr ?></td>
                  <td>
                    <?php 
                      if(($ut_4_3_tlt + $rt_4_3_tlt) > 0){
                        echo round((( ($ut_4_3_tlr + $rt_4_3_tlr) / ($ut_4_3_tlt + $rt_4_3_tlt))*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>

                  <td><?= (((((($ut_1_3_tjt + $rt_1_3_tjt) + ($ut_2_3_tjt + $rt_2_3_tjt))) + ($ut_3_3_tjt + $rt_3_3_tjt))) + ($ut_4_3_tjt + $rt_4_3_tjt))  ?></td>
                  <td><?= (((((($ut_1_3_tlt + $rt_1_3_tlt) + ($ut_2_3_tlt + $rt_2_3_tlt))) + ($ut_3_3_tlt + $rt_3_3_tlt))) + ($ut_4_3_tlt + $rt_4_3_tlt))  ?></td>
                  <td><?= (((((($ut_1_3_tlr + $rt_1_3_tlr) + ($ut_2_3_tlr + $rt_2_3_tlr))) + ($ut_3_3_tlr + $rt_3_3_tlr))) + ($ut_4_3_tlr + $rt_4_3_tlr))  ?></td>
                  <td>
                    <?php 
                      if(((((((($ut_1_3_tlt + $rt_1_3_tlt) + ($ut_2_3_tlt + $rt_2_3_tlt))) + ($ut_3_3_tlt + $rt_3_3_tlt))) + ($ut_4_3_tlt + $rt_4_3_tlt))) > 0){
                        echo round((( ( (((((($ut_1_3_tlr + $rt_1_3_tlr) + ($ut_2_3_tlr + $rt_2_3_tlr))) + ($ut_3_3_tlr + $rt_3_3_tlr))) + ($ut_4_3_tlr + $rt_4_3_tlr)) ) / ( (((((($ut_1_3_tlt + $rt_1_3_tlt) + ($ut_2_3_tlt + $rt_2_3_tlt))) + ($ut_3_3_tlt + $rt_3_3_tlt))) + ($ut_4_3_tlt + $rt_4_3_tlt)) ))*100),2)."%";
                      } else {
                        echo "0%";
                      }
                    ?>
                  </td>
                  
                  <td>5%</td>
                </tr>

                <!-- ------------- -->

            </tbody>
            </table>

        </div>
      
    </div>
  </div>


  <?php 

    $chart_rate_1_aw = (($ut_1_1_tlt + $rt_1_1_tlt) > 0 ? round((( ($ut_1_1_tlr + $rt_1_1_tlr) / ($ut_1_1_tlt + $rt_1_1_tlt))*100),2) : 0 );
    $chart_rate_2_aw = (($ut_2_1_tlt + $rt_1_1_tlt) > 0 ? round((( ($ut_2_1_tlr + $rt_2_1_tlr) / ($ut_2_1_tlt + $rt_2_1_tlt))*100),2) : 0 );
    $chart_rate_3_aw = (($ut_3_1_tlt + $rt_1_1_tlt) > 0 ? round((( ($ut_3_1_tlr + $rt_3_1_tlr) / ($ut_3_1_tlt + $rt_3_1_tlt))*100),2) : 0 );
    $chart_rate_4_aw = (($ut_4_1_tlt + $rt_1_1_tlt) > 0 ? round((( ($ut_4_1_tlr + $rt_4_1_tlr) / ($ut_4_1_tlt + $rt_4_1_tlt))*100),2) : 0 );

    $chart_rate_1_mw = (($ut_1_2_tlt + $rt_1_2_tlt) > 0 ? round((( ($ut_1_2_tlr + $rt_1_2_tlr) / ($ut_1_2_tlt + $rt_1_2_tlt))*100),2) : 0 );
    $chart_rate_2_mw = (($ut_2_2_tlt + $rt_1_2_tlt) > 0 ? round((( ($ut_2_2_tlr + $rt_2_2_tlr) / ($ut_2_2_tlt + $rt_2_2_tlt))*100),2) : 0 );
    $chart_rate_3_mw = (($ut_3_2_tlt + $rt_1_2_tlt) > 0 ? round((( ($ut_3_2_tlr + $rt_3_2_tlr) / ($ut_3_2_tlt + $rt_3_2_tlt))*100),2) : 0 );
    $chart_rate_4_mw = (($ut_4_2_tlt + $rt_1_2_tlt) > 0 ? round((( ($ut_4_2_tlr + $rt_4_2_tlr) / ($ut_4_2_tlt + $rt_4_2_tlt))*100),2) : 0 );

    $chart_rate_1_saw = (($ut_1_3_tlt + $rt_1_3_tlt) > 0 ? round((( ($ut_1_3_tlr + $rt_1_3_tlr) / ($ut_1_3_tlt + $rt_1_3_tlt))*100),2) : 0 );
    $chart_rate_2_saw = (($ut_2_3_tlt + $rt_1_3_tlt) > 0 ? round((( ($ut_2_3_tlr + $rt_2_3_tlr) / ($ut_2_3_tlt + $rt_2_3_tlt))*100),2) : 0 );
    $chart_rate_3_saw = (($ut_3_3_tlt + $rt_1_3_tlt) > 0 ? round((( ($ut_3_3_tlr + $rt_3_3_tlr) / ($ut_3_3_tlt + $rt_3_3_tlt))*100),2) : 0 );
    $chart_rate_4_saw = (($ut_4_3_tlt + $rt_1_3_tlt) > 0 ? round((( ($ut_4_3_tlr + $rt_4_3_tlr) / ($ut_4_3_tlt + $rt_4_3_tlt))*100),2) : 0 );

    $overall_cumulative_1 =  ( $overall_1_final_tjt > 0 ? round((($overall_1_final_tlr/$overall_1_final_tjt)*100),2) : "0");
    $overall_cumulative_2 =  ( $overall_2_final_tjt > 0 ? round((($overall_2_final_tlr/$overall_2_final_tjt)*100),2) : "0");
    $overall_cumulative_3 =  ( $overall_3_final_tjt > 0 ? round((($overall_3_final_tlr/$overall_3_final_tjt)*100),2) : "0");
    $overall_cumulative_4 =  ( $overall_4_final_tjt > 0 ? round((($overall_4_final_tlr/$overall_4_final_tjt)*100),2) : "0");
  
  ?>


</div>
</div>

<script type="text/javascript">

$(document).ready(function() {

  $("#chart_rate_1_aw").text("<?= $chart_rate_1_aw."%" ?>");
  $("#chart_rate_2_aw").text("<?= $chart_rate_2_aw."%" ?>");
  $("#chart_rate_3_aw").text("<?= $chart_rate_3_aw."%" ?>");
  $("#chart_rate_4_aw").text("<?= $chart_rate_4_aw."%" ?>");

  $("#chart_rate_1_mw").text("<?= $chart_rate_1_mw."%" ?>");
  $("#chart_rate_2_mw").text("<?= $chart_rate_2_mw."%" ?>");
  $("#chart_rate_3_mw").text("<?= $chart_rate_3_mw."%" ?>");
  $("#chart_rate_4_mw").text("<?= $chart_rate_4_mw."%" ?>");

  $("#chart_rate_1_saw").text("<?= $chart_rate_1_saw."%" ?>");
  $("#chart_rate_2_saw").text("<?= $chart_rate_2_saw."%" ?>");
  $("#chart_rate_3_saw").text("<?= $chart_rate_3_saw."%" ?>");
  $("#chart_rate_4_saw").text("<?= $chart_rate_4_saw."%" ?>");

  $("#overall_cumulative_1").text("<?= $overall_cumulative_1."%" ?>");
  $("#overall_cumulative_2").text("<?= $overall_cumulative_2."%" ?>");
  $("#overall_cumulative_3").text("<?= $overall_cumulative_3."%" ?>");
  $("#overall_cumulative_4").text("<?= $overall_cumulative_4."%" ?>");

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
            'WEEK #1',
            'WEEK #2',
            'WEEK #3',
            'WEEK #4',
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
            '<td style="padding:0"><b>{point.y:.1f} %</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            dataLabels: { 
                enabled: true,
                color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                style: {
                    textShadow: '0 0 3px black',
                    fontSize: '12px'
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
                      fontSize: '12px'
                  },
                  formatter: function() {
                      // numberFormat takes your label's value and the decimal places to show
                      return Highcharts.numberFormat(this.y, 2) + '%';
                  },
              },   
              enableMouseTracking: false
        }
    },
    series: [{
       type: 'column',
        name: 'Automatic Welding ( SAW )',
        data: [<?= $chart_rate_1_aw ?>, <?= $chart_rate_2_aw ?>, <?= $chart_rate_2_aw ?>, <?= $chart_rate_3_aw ?>]

    }, {
        type: 'column',
        name: 'Manual Welding ( GTAW & SMAW )',
        data: [<?= $chart_rate_1_mw ?>, <?= $chart_rate_2_mw ?>, <?= $chart_rate_3_mw ?>, <?= $chart_rate_4_mw ?>]

    }, {
        type: 'column',
        name: 'Semi Automatic Welding ( FCAW & GMAW )',
        data: [<?= $chart_rate_1_saw ?>, <?= $chart_rate_2_saw ?>, <?= $chart_rate_3_saw ?>, <?= $chart_rate_4_saw ?>]

    }, {
        type: 'spline',
        color: '#ff0004',
        name: 'Cumulative',
        data: [<?= $overall_cumulative_1 ?>, <?= $overall_cumulative_2 ?>, <?= $overall_cumulative_3 ?>, <?= $overall_cumulative_4 ?>]
    }]
});

  </script>