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
        <h6 class="m-0">Detail Of - Week#<?= $week_date ?></h6>
        </div>
        <div class="card-body bg-white">
          <div class="overflow-auto">
            <table style='width:50%;font-size:15px;font-weight:bold;'>
              <tr>
                <td style='width:200px'>Start Week Date</td>
                <td>:</td>
                <td><?= date("d F y",strtotime($start_cut_off)) ?></td>
              </tr>
              <tr>
                <td style='width:200px'>End Week Date</td>
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
          <h6 class="m-0">Summary Data of - Week#<?= $week_date ?></h6>
        </div>
        <div class="card-body bg-white">
          <div class="overflow-auto">
              
                <table class="table dataTable">
                    <thead>
                        <tr> 
                            <th>Visual Report Number</th>
                            <th>Drawing No</th>
                            <th>Discipline</th>
                            <th>Module</th>
                            <th>Type Of Module</th>
                            <th>Joint No</th>
                            <th>Revision No</th>
                            <th>Welder Ref RH<br/>(SMOE Code)</th>
                            <!-- <th>Welder Ref RH<br/>(Client Code)</th> -->
                            <th>Welder Ref FC<br/>(SMOE Code)</th>
                            <!-- <th>Welder Ref FC<br/>(Client Code)</th> -->

                            <th>Visual Weld Date</th>
                            <th>NDT Inspection Date</th>

                            <th>NDT Report Number</th>
                            <th>Weld Length</th>
                            <th>Total Tested Length </th>
                            <th>Rejected Length (RH)</th> 
                            <th>Rejected Length (FC)</th> 
                            <th>Total Rejected Length</th> 
                            <th>Rate % </th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php 
                         foreach($visual_data as $key => $value){ 
                      ?>
                        <tr style='vertical-align: middle; text-align: center; '> 
                            <td><?php echo $value["visual_report"]; ?></td>
                            <td><?php echo $value["drawing_no"]; ?></td>
                            <td><?php echo $discipline_list_data[$value["discipline"]]['discipline_name']; ?></td>
                            <td><?php echo $module_code[$value["module"]]; ?></td>
                            <td><?php echo $type_of_module_code[$value["type_of_module"]]; ?></td>
                            <td><?php echo $value["joint_no"]; ?></td>
                            <td><?php echo $value["postpone_reoffer_no"]; ?></td>
                            <td>
                                <?php  
                                    if(isset($welder_data[$value['id_visual']]['0'])){
                                        $weld_rh_exp =  $welder_data[$value['id_visual']]['0'];
                                        foreach($weld_rh_exp as $kx => $vx){
                                            echo @$master_welder[$vx]['welder_code']."<br/>";
                                        }
                                    } else {
                                        echo "-";
                                    }  
                                ?>  
                            </td>
                            <!-- <td>
                                <?php 
                                    if(isset($welder_data[$value['id_visual']]['0'])){
                                        $weld_rh_exp =  $welder_data[$value['id_visual']]['0'];
                                        foreach($weld_rh_exp as $kx => $vx){
                                            echo @$master_welder[$vx]['rwe_code']."<br/>";
                                        }
                                    } else {
                                        echo "-";
                                    }  
                                ?> 
                            </td> -->
                            <td>
                                <?php                   
                                    if(isset($welder_data[$value['id_visual']]['1'])){
                                        $weld_fc_exp =  $welder_data[$value['id_visual']]['1'];
                                        foreach($weld_fc_exp as $k => $v){
                                            echo @$master_welder[$v]['welder_code']."<br/>";
                                        }
                                    } else {
                                        echo "-";
                                    }  
                                ?>  
                            </td>
                            <!-- <td>
                                <?php 
                                    if(isset($welder_data[$value['id_visual']]['1'])){
                                        $weld_fc_exp = $welder_data[$value['id_visual']]['1'];
                                        foreach($weld_fc_exp as $kx => $vx){
                                            echo @$master_welder[$vx]['rwe_code']."<br/>";
                                        }
                                    } else {
                                        echo "-";
                                    }  
                                ?> 
                            </td> -->
                            <td><?php echo $value["weld_datetime"]; ?></td>
                            <td><?php echo $value["tested_date"]; ?></td>
                            <td><?php echo $value["report_no"]; ?></td>

                            <td>
                              <?= ( (isset($value["length_of_weld"]) && $value["length_of_weld"] > 0) ? $value["length_of_weld"] : 0) ?>
                              <?php $weld_length[] = ( (isset($value["length_of_weld"]) && $value["length_of_weld"] > 0) ? $value["length_of_weld"] : 0); ?>
                            </td>     

                            <td>
                              <?= ($value["tested_length"] > 0 ? $value["tested_length"] : 0) ?>
                              <?php $tested_length[] = ($value["tested_length"] > 0 ? $value["tested_length"] : 0); ?>
                            </td>

                            <td>
                              <?= (array_sum($find_length_of_defect_audit[$value['id_joint']][0]) > 0 ? array_sum($find_length_of_defect_audit[$value['id_joint']][0]) : 0) ?>
                              <?php $reject_length_rh[] = (array_sum($find_length_of_defect_audit[$value['id_joint']][0]) > 0 ? array_sum($find_length_of_defect_audit[$value['id_joint']][0]) : 0) ?>
                            </td>

                            <td>
                              <?= (array_sum($find_length_of_defect_audit[$value['id_joint']][1]) > 0 ? array_sum($find_length_of_defect_audit[$value['id_joint']][1]) : 0) ?>
                              <?php $reject_length_fc[] = (array_sum($find_length_of_defect_audit[$value['id_joint']][1]) > 0 ? array_sum($find_length_of_defect_audit[$value['id_joint']][1]) : 0) ?>
                            </td>

                            <td>
                              <?php 
                                $total_reject = array_sum($find_length_of_defect_audit[$value['id_joint']][0]) + array_sum($find_length_of_defect_audit[$value['id_joint']][1]); 
                                echo $total_reject; 
                              ?>
                              <?php 
                                $total_all_reject[] = ($total_reject > 0 ? $total_reject : 0) 
                              ?>
                            </td>

                            <td><?= ($value["tested_length"] > 0 ? round(($total_reject / $value["tested_length"])*100,2)."%" : "-") ?></td>

                        </tr>
                      <?php } ?>
                      </tbody>

                         <tr style='vertical-align: middle; text-align: center; '>
                            <td colspan='14'><h4>Summary Of Week#<?= $week_date ?></h4></td>
                            
                            <td><h5><?= (isset($weld_length) ? array_sum($weld_length) : 0); ?></h5></td>                            
                            <td><h5><?= (isset($tested_length) ? array_sum($tested_length) : 0); ?></h5></td>
                            <td><h5><?= (isset($reject_length_rh) ? array_sum($reject_length_rh) : 0); ?></h5></td>
                            <td><h5><?= (isset($reject_length_fc) ? array_sum($reject_length_fc) : 0); ?></h5></td>
                            <td><h5><?= (isset($total_all_reject) ? array_sum($total_all_reject) : 0); ?></h5></td>
                            <td><h5><?= ((isset($tested_length) && array_sum($tested_length) > 0) ? round((array_sum($total_all_reject) / array_sum($tested_length))*100,2)."%" : "-") ?></h5></td>
                        </tr> 
                                        
                </table>
    
          </div>
        </div>
      </div>
    </div> 
  
</div>
</div>

</div>

              

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


  </script>