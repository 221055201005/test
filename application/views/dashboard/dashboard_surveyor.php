<?php
  //test_var($status_fitup_fb);
?>
<style type="text/css">
  th {
    border-top: 1px solid #dddddd !important;
    border-bottom: 1px solid #dddddd !important;
    border-right: 1px solid #dddddd !important;
  }
 
  th:first-child {
    border-left: 1px solid #dddddd !important;
  }
</style>

<div id="content" class="container-fluid">

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">Level #5 - Dashboard Status</h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <table width="100%" class="table table-hover cell-border text-center dataTable overflow-auto">
             <thead>
              <tr>
                <th rowspan="2" style="vertical-align: text-top;width: 200px !important;min-width: 200px !important;">Project ID</th>
                <th rowspan="2" style="vertical-align: text-top;width: 150px !important;min-width: 150px !important;">Module/Jacket ID</th>
                <th rowspan="2" style="vertical-align: text-top;width: 150px !important;min-width: 150px !important;">Type Of Module</th>
                <th rowspan="2" style="vertical-align: text-top;width: 150px !important;min-width: 150px !important;">Discipline</th>
                <th rowspan="2" style="vertical-align: text-top;width: 150px !important;min-width: 150px !important;">Deck Elevation / Service Line</th>
                <th style="vertical-align: text-top;width: 200px !important;min-width: 200px !important;">Progress<br/>Pre-Fab In (%)<br/>Target : 15%</th>
                <th style="vertical-align: text-top;width: 200px !important;min-width: 200px !important;" colspan="3">Progress<br/>Fab In (%)<br/>Target : 45%</th>
                <th style="vertical-align: text-top;width: 200px !important;min-width: 200px !important;" colspan="3">Progress<br/>Assembly In (%)<br/>Target : 30%</th>
                <th style="vertical-align: text-top;width: 200px !important;min-width: 200px !important;" colspan="3">Progress<br/>Erection In (%)<br/>Target : 10%</th>
              </tr>
              <tr>
                <th style="vertical-align: text-top;width: 100px !important;min-width: 100px !important;">Marking/Cut</th>

                <th style="vertical-align: text-top;width: 100px !important;min-width: 100px !important;">Fitup</br>Target: 50%</th>
                <th style="vertical-align: text-top;width: 100px !important;min-width: 100px !important;">Full Weld</br>Target: 50%</th>
                <th style="vertical-align: text-top;width: 100px !important;min-width: 100px !important;">Total (%)</th>

                <th style="vertical-align: text-top;width: 100px !important;min-width: 100px !important;">Fitup</br>Target: 50%</th>
                <th style="vertical-align: text-top;width: 100px !important;min-width: 100px !important;">Full Weld</br>Target: 50%</th>
                <th style="vertical-align: text-top;width: 100px !important;min-width: 100px !important;">Total (%)</th>

                <th style="vertical-align: text-top;width: 100px !important;min-width: 100px !important;">Fitup</br>Target: 50%</th>
                <th style="vertical-align: text-top;width: 100px !important;min-width: 100px !important;">Full Weld</br>Target: 50%</th>
                <th style="vertical-align: text-top;width: 100px !important;min-width: 100px !important;">Total (%)</th>
              </tr>
              <thead>
              <tbody>
              <?php 
                $target_pf = 15; 
                foreach ($module_by_project as $key => $value) { 
                  $percent_pf = round((($value['total_progress_mv']/$value['total_pc']) * $target_pf)/100);
                ?>
                <tr>
                  <td><?php echo $project_list[$value["pc_project"]]["project_name"]; ?></td>
                  <td><?php echo $module_list[$value["pc_module"]]['mod_desc']; ?></td>
                  <td><?php echo $type_of_module_list[$value["pc_type_of_module"]]['name']; ?></td>
                  <td><?php echo $discipline_list[$value["pc_discipline"]]['discipline_name']; ?></td>
                  <td><?php echo $desc_assy_list[$value["pc_deck_elevation"]]['name']; ?></td>

                  <td <?php if($percent_pf >= 15){ echo "style='background-color:#36c900;font-weight:bold;'"; } else { echo "style='background-color:#ffb4b0;font-weight:bold;'"; } ?>><?php echo $percent_pf."%"; ?></td>

                  <td><?php if(isset($status_fitup_fb[$value["pc_project"]][$value["pc_module"]][$value["pc_type_of_module"]][$value["pc_discipline"]][$value["pc_deck_elevation"]]["FB"])){ echo $status_fitup_fb[$value["pc_project"]][$value["pc_module"]][$value["pc_type_of_module"]][$value["pc_discipline"]][$value["pc_deck_elevation"]]["FB"]; } else { echo 0; } ?></td> 
                  <td><?php if(isset($status_visual_fb[$value["pc_project"]][$value["pc_module"]][$value["pc_type_of_module"]][$value["pc_discipline"]][$value["pc_deck_elevation"]]["FB"])){ echo $status_visual_fb[$value["pc_project"]][$value["pc_module"]][$value["pc_type_of_module"]][$value["pc_discipline"]][$value["pc_deck_elevation"]]["FB"]; } else { echo 0; } ?></td>                 
                  <td>
                        <?php

                         if(isset($status_visual_fb[$value["pc_project"]][$value["pc_module"]][$value["pc_type_of_module"]][$value["pc_discipline"]][$value["pc_deck_elevation"]]["FB"]) AND isset($status_fitup_fb[$value["pc_project"]][$value["pc_module"]][$value["pc_type_of_module"]][$value["pc_discipline"]][$value["pc_deck_elevation"]]["FB"])){ 

                            echo ((( $status_visual_fb[$value["pc_project"]][$value["pc_module"]][$value["pc_type_of_module"]][$value["pc_discipline"]][$value["pc_deck_elevation"]]["FB"] + $status_fitup_fb[$value["pc_project"]][$value["pc_module"]][$value["pc_type_of_module"]][$value["pc_discipline"]][$value["pc_deck_elevation"]]["FB"] ) * 45) / 100)."<br/>";

                            echo $status_fitup_fb[$value["pc_project"]][$value["pc_module"]][$value["pc_type_of_module"]][$value["pc_discipline"]][$value["pc_deck_elevation"]]["FB"]." - ".$status_fitup_fb[$value["pc_project"]][$value["pc_module"]][$value["pc_type_of_module"]][$value["pc_discipline"]][$value["pc_deck_elevation"]]["FB"]." - "."<br/>";

                         } else { 

                          echo 0; 

                         }

                        ?>
                  </td>                 
                  <td></td>                 
                  <td></td> 

                  <td></td>                 
                  <td></td>                 
                  <td></td>                 
                  <td></td>                 

                </tr>
              <?php } ?>
            </tbody>
          </table>
          
        </div>
      </div>
    </div>
  </div>
</div>

</div>

<script type="text/javascript">
  $('.dataTable').DataTable({
    "bPaginate": false,
    "bLengthChange": false,
    "bFilter": true,
    "bInfo": false,
    "bAutoWidth": false
  })
</script>
