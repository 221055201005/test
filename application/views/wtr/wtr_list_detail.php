<?php if(isset($export_as)){ ?>
<?php
   $currendate= date("Y-m-d H:i:s");
   header("Content-type: application/vnd-ms-excel");
   header("Content-Disposition: attachment; filename=export_wtr_$currendate.xls");
?>
<?php } ?>

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
  background-color: #008060;
  color: white;
}
</style>

<?php if(!isset($display_status)){ ?>

  <?php 
    
    if($module == '41' OR $module == '42'){
      $code_module = "JK";
    } else {
      $code_module = "TS";
    }

    if($discipline =='1'){
      $code_discipline = "PIP";
    } else {
      $code_discipline = "STR";
    }

  ?>

   <?php } ?>

<div id="content" class="container-fluid">
  <div class="row">
    <?php 
    if($discipline != '1'){

      $d_link = "structural";

    } else {
      $d_link = "piping";
    }
    ?>

    <?php if(!isset($export_as)){ ?>
    <div class="col-md-12">
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0"><?php echo $meta_title ?></h6>
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
          <div class="container-fluid">
            <a href='<?php echo base_url(); ?>wtr/wtr_list/<?php echo $d_link; ?>' class='btn btn-warning'><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
            <a href='<?php echo  base_url(); ?>wtr/wtr_list_detail/<?php echo strtr($this->encryption->encrypt($project),'+=/', '.-~') ; ?>/<?php echo strtr($this->encryption->encrypt($drawing_no),'+=/', '.-~') ; ?>/<?php echo strtr($this->encryption->encrypt($drawing_type),'+=/', '.-~') ; ?>/<?php echo strtr($this->encryption->encrypt($discipline),'+=/', '.-~') ; ?>/<?php echo strtr($this->encryption->encrypt($module),'+=/', '.-~') ; ?>/<?php echo strtr($this->encryption->encrypt($type_of_module),'+=/', '.-~') ; ?>/<?php echo strtr($this->encryption->encrypt("excel"),'+=/', '.-~') ; ?>' class='btn btn-success'><i class="far fa-file-excel"></i> Excel </a>
            <a href='<?php echo  base_url(); ?>wtr/wtr_list_detail/<?php echo strtr($this->encryption->encrypt($project),'+=/', '.-~') ; ?>/<?php echo strtr($this->encryption->encrypt($drawing_no),'+=/', '.-~') ; ?>/<?php echo strtr($this->encryption->encrypt($drawing_type),'+=/', '.-~') ; ?>/<?php echo strtr($this->encryption->encrypt($discipline),'+=/', '.-~') ; ?>/<?php echo strtr($this->encryption->encrypt($module),'+=/', '.-~') ; ?>/<?php echo strtr($this->encryption->encrypt($type_of_module),'+=/', '.-~') ; ?>/<?php echo strtr($this->encryption->encrypt("pdf"),'+=/', '.-~') ; ?>' class='btn btn-danger'><i class="fas fa-file-pdf"></i> PDF </a>
            <br/>
            <br/>
    <?php } ?>
            <?php if(!isset($export_as)){ ?>
              <table class="dataTable wtr" width='100%'>
            <?php } else { ?>
              <table class="dataTable wtr" border="1px" width='100%'>
            <?php } ?>
              <thead>
                
                <tr>
                  <th style="text-align: left;">PROJECT NAME</th>
                  <th>:</th>                 
                  <th colspan="53" style="text-align: left;"><?= strtoupper($project_name[$project]); ?></th>                 
                </tr>
                <tr>
                  <th style="text-align: left;">CLIENT</th>
                  <th>:</th>                 
                  <th colspan="53" style="text-align: left;"><?= strtoupper($project_client[$project]); ?></th>                 
                </tr>
                <?php if(!isset($display_status)){ ?>
                <tr>
                  <th style="text-align: left;">DRAWING NO</th>
                  <th>:</th>                 
                  <th colspan="53" style="text-align: left;">
                    <?php echo $drawing_no; ?>

                      <?php if(isset($activity_eng[$drawing_no]['id'])){ ?> 
                        <?php  
                            $links_atc = base_url_ftp_eng()."public_smoe/open_atc/2/".strtr($this->encryption->encrypt($activity_eng[$drawing_no]['id']), '+=/', '.-~')."/".$drawing_detail[$project][$drawing_no]['last_revision_no'];   
                            $links_atc_cross = base_url_ftp_eng()."public_smoe/open_atc_cross/2/".strtr($this->encryption->encrypt($drawing_no), '+=/', '.-~')."/".strtr($this->encryption->encrypt($activity_eng[$drawing_no]['id']), '+=/', '.-~')."/".$drawing_detail[$project][$drawing_no]['last_revision_no'];   
                        ?> 
 
                      ( <a target='_blank' href='<?= $links_atc ?>'  title='Attachment' style='color:white'> <i class='fas fa-paperclip'></i> Open Drawing </a> 
                      &nbsp;&nbsp; 
                      <a target='_blank' href='<?= $links_atc_cross ?>' title='Attachment' download='<?= $drawing_no ?>.pdf' style='color:white'> 
                          <i class='fas fa-cloud-download-alt'></i> Download Drawing 
                      </a> )
                      <?php } ?> 

                  </th>                 
                </tr>
                
                <tr>
                  <th style="text-align: left;">MODULE / JACKET ID</th>
                  <th>:</th>                 
                  <th colspan="53" style="text-align: left;"><?php echo $module_code[$module]; ?></th>                 
                </tr>
                
                <tr>
                  <th style="text-align: left;">REV</th>
                  <th>:</th>                 
                  <th colspan="53" style="text-align: left;"><?= @$drawing_detail[$wtr_list[0]['project']][$wtr_list[0]['drawing_no']]['last_revision_no'] ?></th>        
                </tr>
                <tr>
                  <th style="text-align: left;">DESCRIPTION</th>
                  <th>:</th>                 
                  <th colspan="53" style="text-align: left;"><?= @$drawing_detail[$wtr_list[0]['project']][$wtr_list[0]['drawing_no']]['title'] ?></th>                
                </tr> 
                <?php } ?>               
                <tr>
                  <th rowspan="3">Drawing/Weld Map No</th>
                  <th rowspan="3">Rev No</th>
                  <th rowspan="3">Joint No</th>
                  <th rowspan="3">Type Of Weld</th>
                  <th rowspan="3">Class</th>
                  <th rowspan="3">Dia</th>
                  <th rowspan="3">Thk</th>
                  <th rowspan="3">Sch</th>
                  <th colspan="12">Material Traceability</th>
                  <th colspan="3" rowspan="2">Fitup</th>
                  <th rowspan="3">Fitter Code</th>
                  <th rowspan="3">Tack Weld ID</th>
                  <th rowspan="3">WPS No</th>
                  <th rowspan="3">Consumable / Lot no</th>
                  <th rowspan="3">Welded Date</th>
                  <th colspan="2" rowspan="2">Weld Process</th>
                  <th colspan="2" rowspan="2">Welder ID</th>
                  <th colspan="3" rowspan="2">Visual</th>
                  <th colspan="16">Non Destructive Examination</th>
                  <th rowspan="2" colspan="3">IRN to B&P</th>
                  <th rowspan="3">Remarks</th>                  
                </tr>
                <tr>
                  <th colspan="6">Part #1</th>
                  <th colspan="6">Part #2</th>
                  <th colspan="4">MPI</th>
                  <th colspan="4">PT</th>
                  <th colspan="4">UT</th>
                  <th colspan="4">RT</th>
                </tr>
                <tr>
                  <th>Piecemark</th>
                  <th>Mtr No.</th>
                  <th>Grade /Spec</th>
                  <th>Unique No</th>
                  <th>Heat No</th>
                  <th>Thk (MM)</th>

                  <th>Piecemark</th>
                  <th>Mtr No.</th>
                  <th>Grade /Spec</th>
                  <th>Unique No</th>
                  <th>Heat No</th>
                  <th>Thk (MM)</th>

                  <th>Report</th>
                  <th>Date</th>
                  <th>Result</th>

                  <th>R/H</th>
                  <th>F/C</th>

                  <th>R/H</th>
                  <th>F/C</th>
                  
                  <th>Report</th>
                  <th>Date</th>
                  <th>Result</th>

                  <th>Req (%)</th>
                  <th>Report</th>
                  <th>Date</th>
                  <th>Result</th>

                  <th>Req (%)</th>
                  <th>Report</th>
                  <th>Date</th>
                  <th>Result</th>

                  <th>Req (%)</th>
                  <th>Report</th>
                  <th>Date</th>
                  <th>Result</th>

                  <th>Req (%)</th>
                  <th>Report</th>
                  <th>Date</th>
                  <th>Result</th> 

                  <th>Report</th>
                  <th>Date</th>
                  <th>Result</th>        
                  
                </tr>

              </thead>
              <tbody>
                  <?php 
                    foreach ($wtr_list as $key => $value) {
                      
                      if($value['fitup_status_inspection'] != 2 AND $value['visual_status_inspection'] != 2){

                  ?>

                  <?php $app_code = array(5,6,7,9,10,11); ?>

                  <?php 
                    
                    $project_id_enc     = strtr($this->encryption->encrypt($value['project']), '+=/', '.-~');
                    $discipline_enc     = strtr($this->encryption->encrypt($value['discipline']), '+=/', '.-~');
                    $type_of_module_enc = strtr($this->encryption->encrypt($value['type_of_module']), '+=/', '.-~');
                    $module_enc         = strtr($this->encryption->encrypt($value['module']), '+=/', '.-~');

                    if(isset($status_piecemark[$value['pos_1']]['report_number'])){ 
                        $report_enc_mv_p1   = strtr($this->encryption->encrypt($status_piecemark[$value['pos_1']]['report_number']), '+=/', '.-~');                       
                        $report_no_rev_p1   = strtr($this->encryption->encrypt($status_piecemark[$value['pos_1']]['report_no_rev']), '+=/', '.-~');
                    } else {
                        $report_enc_mv_p1   = null;                       
                        $report_no_rev_p1   = null;
                    }

                    if(isset($status_piecemark[$value['pos_2']]['report_number'])){ 
                        $report_enc_mv_p2   = strtr($this->encryption->encrypt($status_piecemark[$value['pos_2']]['report_number']), '+=/', '.-~');                        
                        $report_no_rev_p2   = strtr($this->encryption->encrypt($status_piecemark[$value['pos_2']]['report_no_rev']), '+=/', '.-~');
                    } else {
                        $report_enc_mv_p2   = null;                       
                        $report_no_rev_p2   = null;
                    }

                    if(isset($value['fitup_report_no'])){
                      $report_fitup_enc   = strtr($this->encryption->encrypt($value['fitup_report_no']), '+=/', '.-~');
                    }

                    if(isset($value['visual_report_no'])){
                      $report_visual_enc   = strtr($this->encryption->encrypt($value['visual_report_no']), '+=/', '.-~');
                    }
                  
                  ?>


                    <tr>
                        <td>                         
                          <?php 
                            if(isset($activity_eng[$value['drawing_wm']]['id'])){  
                                  $links_atc = base_url_ftp_eng()."public_smoe/open_atc/2/".strtr($this->encryption->encrypt($activity_eng[$value['drawing_wm']]['id']), '+=/', '.-~')."/".$drawing_detail[$value['project']][$value['drawing_wm']]['last_revision_no'];                                   
                          ?>                              
                            <a target='_blank' href='<?= $links_atc ?>'  title='Attachment' > <?php echo $value['drawing_wm']; ?></a> 
                          <?php } else { ?> 
                            <?php echo $value['drawing_wm']; ?>
                          <?php } ?> 
                        </td>
                        <td><?= @$drawing_detail[$value['project']][$value['drawing_wm']]['last_revision_no'] ?></td>
                        <td><?php echo $value['joint_no'].$value['revision_category'].$value['revision']; ?></td>
                        <td><?php echo @$master_weld_type[$value['weld_type']]["weld_type"]; ?></td>
                        <td><?php echo $class_list[$value['class']]; ?></td>
                        <td><?php echo $value['diameter']; ?></td>
                        <td><?php echo $value['thickness']; ?></td>
                        <td><?php echo $value['sch']; ?></td>

                        <td>
                          <?php echo $value['pos_1'];  ?><br/>
                          <?php if(isset($status_piecemark_ref[$value['pos_1']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_1']]["ref_pos_1"])){ ?> 
                          <?php  
                              $data_multiple_piecemark_1 = explode(", ",$status_piecemark_ref[$value['pos_1']]["ref_pos_1"]);  
                              foreach($data_multiple_piecemark_1 as $vaxx){  
                                  echo  "<span class='badge'>".$status_piecemark_ref_1[$vaxx]["part_id"]."</span> <br/>"; 
                              } 
                          ?> 
                          <?php } ?>
                        </td>

                        <td>

                          <?php if(isset($status_piecemark_ref[$value['pos_1']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_1']]["ref_pos_1"])){ ?> 

                            <?php  
                                $data_multiple_piecemark_1 = explode(", ",$status_piecemark_ref[$value['pos_1']]["ref_pos_1"]);  
                                foreach($data_multiple_piecemark_1 as $vaxx){  
                                  if(isset($status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['report_number']) AND $status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['status_inspection'] == 7){
                                      echo "<a href='".base_url()."material_verification/material_verification_pdf_client/".$project_id_enc."/".$discipline_enc."/".$type_of_module_enc."/".$module_enc."/".strtr($this->encryption->encrypt($status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['report_number']), '+=/', '.-~')."/".strtr($this->encryption->encrypt($status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['report_no_rev']), '+=/', '.-~')."' target='_blank'>"."<span class='badge'>".$report_no_mv[$value['project']][$value['discipline']][$value['type_of_module']]['mv_no']."-".$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['report_number']."</span></a><br/>";
                                  } else {
                                    if(isset($status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['report_number'])){
                                      echo "<span class='badge'>".$report_no_mv[$value['project']][$value['discipline']][$value['type_of_module']]['mv_no']."-".$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['report_number']."</span><br/>";
                                    } else{
                                      echo "-";
                                    }
                                  }
                                } 
                            ?>

                          <?php } else { ?>
                            
                            <?php if(isset($status_piecemark[$value['pos_1']]['report_number']) AND $status_piecemark[$value['pos_1']]['status_inspection'] == 7){ ?>
                                <a href="<?php echo base_url(); ?>material_verification/material_verification_pdf_client/<?= $project_id_enc ?>/<?= $discipline_enc ?>/<?= $type_of_module_enc ?>/<?= $module_enc ?>/<?= $report_enc_mv_p1 ?>/<?= $report_no_rev_p1 ?>" target='_blank'><?php echo $report_no_mv[$value['project']][$value['discipline']][$value['type_of_module']]['mv_no']."-".$status_piecemark[$value['pos_1']]['report_number']; ?></a>
                            <?php } else { ?>
                                <?php if(isset($status_piecemark[$value['pos_1']]['report_number'])){ ?>
                                <?php echo $report_no_mv[$value['project']][$value['discipline']][$value['type_of_module']]['mv_no']."-".$status_piecemark[$value['pos_1']]['report_number']; ?>
                                <?php } else { ?>
                                  -
                                <?php } ?>
                            <?php } ?>
                            
                          <?php } ?>

                        </td>

                        <td>
                          <?php if(isset($status_piecemark_ref[$value['pos_1']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_1']]["ref_pos_1"])){ ?> 
                            <?php  
                                $data_multiple_piecemark_1 = explode(", ",$status_piecemark_ref[$value['pos_1']]["ref_pos_1"]);  
                                foreach($data_multiple_piecemark_1 as $vaxx){   
                                    echo  "<span class='badge'>".$material_grade[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['grade']]['material_grade']."</span> <br/>"; 
                                } 
                            ?> 
                          <?php } else { ?>
                            <?php 
                              if(isset($status_piecemark[$value['pos_1']]['id_mis'])){
                                echo $material_grade[$status_piecemark[$value['pos_1']]['grade']]['material_grade'];
                              } 
                            ?>
                          <?php }  ?>
                        </td>

                        <td>
                          <?php if(isset($status_piecemark_ref[$value['pos_1']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_1']]["ref_pos_1"])){ ?> 
                          <?php  
                              $data_multiple_piecemark_1 = explode(", ",$status_piecemark_ref[$value['pos_1']]["ref_pos_1"]);  
                              foreach($data_multiple_piecemark_1 as $vaxx){  
                                  //echo  "<span class='badge'>".$status_piecemark_ref_1[$vaxx]["part_id"]."</span> <br/>"; 
                                  echo "<a href='https://".$_SERVER['SERVER_ADDR']."/warehouse/mrir/export_mrir_cs/?id=".strtr($this->encryption->encrypt($warehouse_mis_mrir[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['id_mis']]['mrir_id']),'+=/', '.-~').'&action='.strtr($this->encryption->encrypt('update'),'+=/', '.-~').'&status='.strtr($this->encryption->encrypt($warehouse_mis_mrir[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['id_mis']]['status']),'+=/', '.-~').'&partial_report_no='.strtr($this->encryption->encrypt($warehouse_mis_mrir[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['id_mis']]['partial_report_no']),'+=/', '.-~')."'>"."<span class='badge'>".$warehouse_mis_mrir[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['id_mis']]['unique_ident_no']."</span></a>";
                              } 
                          ?> 
                          <?php } else { ?>
                          <?php 
                            if(isset($status_piecemark[$value['pos_1']]['id_mis'])){ 
                              echo "<a href='https://".$_SERVER['SERVER_ADDR']."/warehouse/mrir/export_mrir_cs/?id=".strtr($this->encryption->encrypt($warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['mrir_id']),'+=/', '.-~').'&action='.strtr($this->encryption->encrypt('update'),'+=/', '.-~').'&status='.strtr($this->encryption->encrypt($warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['status']),'+=/', '.-~').'&partial_report_no='.strtr($this->encryption->encrypt($warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['partial_report_no']),'+=/', '.-~')."'>".$warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['unique_ident_no']."</a>"; 
                            } 
                          ?>
                           <?php } ?>
                        </td>

                        <td>
                          <?php if(isset($status_piecemark_ref[$value['pos_1']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_1']]["ref_pos_1"])){ ?> 
                            <?php  
                                $data_multiple_piecemark_1 = explode(", ",$status_piecemark_ref[$value['pos_1']]["ref_pos_1"]);  
                                foreach($data_multiple_piecemark_1 as $vaxx){  
                                    echo  "<span class='badge'>".$warehouse_mis_mrir[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['id_mis']]['heat_or_series_no']."</span> <br/>"; 
                                } 
                            ?> 
                          <?php } else { ?>
                            <?php 
                              if(isset($status_piecemark[$value['pos_1']]['id_mis'])){ 
                                echo $warehouse_mis_mrir[$status_piecemark[$value['pos_1']]['id_mis']]['heat_or_series_no'];
                              }
                            ?> 
                          <?php } ?>                     
                        </td>

                        <td>
                          <?php if(isset($status_piecemark_ref[$value['pos_1']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_1']]["ref_pos_1"])){ ?> 
                          <?php  
                              $data_multiple_piecemark_1 = explode(", ",$status_piecemark_ref[$value['pos_1']]["ref_pos_1"]);  
                              foreach($data_multiple_piecemark_1 as $vaxx){   
                                  echo  "<span class='badge'>".$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['thickness']."</span> <br/>"; 
                              } 
                          ?> 
                          <?php } else { ?>
                          <?php 
                            if(isset($status_piecemark[$value['pos_1']]['id_mis'])){
                              echo $status_piecemark[$value['pos_1']]['thickness'];
                            } 
                          ?>
                          <?php }  ?>
                        </td>

                        <td>
                          <?php echo $value['pos_2']; ?><br/>
                          <?php if(isset($status_piecemark_ref[$value['pos_2']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_2']]["ref_pos_1"])){ ?> 
                          <?php  
                              $data_multiple_piecemark_1 = explode(", ",$status_piecemark_ref[$value['pos_2']]["ref_pos_1"]);  
                              foreach($data_multiple_piecemark_1 as $vaxx){  
                                    
                                  echo  "<span class='badge'>".$status_piecemark_ref_1[$vaxx]["part_id"]."</span> <br/>"; 
                              } 
                          ?> 
                          <?php } ?>
                        </td>    

                        <td>
                          <?php if(isset($status_piecemark_ref[$value['pos_2']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_2']]["ref_pos_1"])){ ?> 

                          <?php  
                              $data_multiple_piecemark_1 = explode(", ",$status_piecemark_ref[$value['pos_2']]["ref_pos_1"]);  
                              foreach($data_multiple_piecemark_1 as $vaxx){  
                                if(isset($status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['report_number']) AND $status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['status_inspection'] == 7){
                                  echo "<a href='".base_url()."material_verification/material_verification_pdf_client/".$project_id_enc."/".$discipline_enc."/".$type_of_module_enc."/".$module_enc."/".strtr($this->encryption->encrypt($status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['report_number']), '+=/', '.-~')."/".strtr($this->encryption->encrypt($status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['report_no_rev']), '+=/', '.-~')."' target='_blank'>"."<span class='badge'>".$report_no_mv[$value['project']][$value['discipline']][$value['type_of_module']]['mv_no']."-".$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['report_number']."</span></a><br/>";
                                } else {
                                  if(isset($status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['report_number'])){
                                    echo "<span class='badge'>".$report_no_mv[$value['project']][$value['discipline']][$value['type_of_module']]['mv_no']."-".$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['report_number']."</span><br/>";
                                  } else{
                                    echo "-";
                                  }
                                }
                              } 
                          ?>

                          <?php } else { ?>

                            <?php if(isset($status_piecemark[$value['pos_2']]['report_number']) AND $status_piecemark[$value['pos_2']]['status_inspection'] == 7){ ?>
                                <a href="<?php echo base_url(); ?>material_verification/material_verification_pdf_client/<?= $project_id_enc ?>/<?= $discipline_enc ?>/<?= $type_of_module_enc ?>/<?= $module_enc ?>/<?= $report_enc_mv_p2 ?>/<?= $report_no_rev_p2 ?>" target='_blank'><?php echo $report_no_mv[$value['project']][$value['discipline']][$value['type_of_module']]['mv_no']."-".$status_piecemark[$value['pos_2']]['report_number']; ?></a>
                            <?php } else { ?>
                                <?php if(isset($status_piecemark[$value['pos_2']]['report_number'])){ ?>
                                  <?php echo $report_no_mv[$value['project']][$value['discipline']][$value['type_of_module']]['mv_no']."-".$status_piecemark[$value['pos_2']]['report_number']; ?>
                                <?php } else { ?>
                                  -
                                <?php } ?>
                            <?php } ?>

                          <?php } ?>
                        </td>

                        <td>
                          <?php if(isset($status_piecemark_ref[$value['pos_2']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_2']]["ref_pos_1"])){ ?> 
                            <?php  
                                $data_multiple_piecemark_1 = explode(", ",$status_piecemark_ref[$value['pos_2']]["ref_pos_1"]);  
                                foreach($data_multiple_piecemark_1 as $vaxx){   
                                    echo  "<span class='badge'>".$material_grade[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['grade']]['material_grade']."</span> <br/>"; 
                                } 
                            ?> 
                          <?php } else { ?>
                            <?php 
                              if(isset($status_piecemark[$value['pos_2']]['id_mis'])){
                                echo $material_grade[$status_piecemark[$value['pos_2']]['grade']]['material_grade'];
                              } 
                            ?>
                          <?php } ?>
                        </td>

                        <td>
                          <?php if(isset($status_piecemark_ref[$value['pos_2']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_2']]["ref_pos_1"])){ ?> 
                            <?php  
                              $data_multiple_piecemark_1 = explode(", ",$status_piecemark_ref[$value['pos_2']]["ref_pos_1"]);  
                              foreach($data_multiple_piecemark_1 as $vaxx){  
                                  //echo  "<span class='badge'>".$status_piecemark_ref_1[$vaxx]["part_id"]."</span> <br/>"; 
                                  echo "<a href='https://".$_SERVER['SERVER_ADDR']."/warehouse/mrir/export_mrir_cs/?id=".strtr($this->encryption->encrypt($warehouse_mis_mrir[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['id_mis']]['mrir_id']),'+=/', '.-~').'&action='.strtr($this->encryption->encrypt('update'),'+=/', '.-~').'&status='.strtr($this->encryption->encrypt($warehouse_mis_mrir[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['id_mis']]['status']),'+=/', '.-~').'&partial_report_no='.strtr($this->encryption->encrypt($warehouse_mis_mrir[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['id_mis']]['partial_report_no']),'+=/', '.-~')."'>"."<span class='badge'>".$warehouse_mis_mrir[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['id_mis']]['unique_ident_no']."</span></a>";
                              } 
                            ?> 
                          <?php } else { ?>
                          <?php 
                            if(isset($status_piecemark[$value['pos_2']]['id_mis'])){ 
                              echo "<a href='https://".$_SERVER['SERVER_ADDR']."/warehouse/public_smoe/export_mrir_cs/?id=".strtr($this->encryption->encrypt($warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['mrir_id']),'+=/', '.-~').'&action='.strtr($this->encryption->encrypt('update'),'+=/', '.-~').'&status='.strtr($this->encryption->encrypt($warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['status']),'+=/', '.-~').'&partial_report_no='.strtr($this->encryption->encrypt($warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['partial_report_no']),'+=/', '.-~')."'>".$warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['unique_ident_no']."</a>"; 
                            } 
                          ?>
                          <?php } ?>
                        </td>

                        <td>
                          <?php if(isset($status_piecemark_ref[$value['pos_2']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_2']]["ref_pos_1"])){ ?> 
                          <?php  
                              $data_multiple_piecemark_1 = explode(", ",$status_piecemark_ref[$value['pos_2']]["ref_pos_1"]);  
                              foreach($data_multiple_piecemark_1 as $vaxx){  
                                  echo  "<span class='badge'>".$warehouse_mis_mrir[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['id_mis']]['heat_or_series_no']."</span> <br/>"; 
                              } 
                          ?> 
                          <?php } else { ?>
                          <?php 
                            if(isset($status_piecemark[$value['pos_2']]['id_mis'])){ 
                              echo $warehouse_mis_mrir[$status_piecemark[$value['pos_2']]['id_mis']]['heat_or_series_no'];
                            }
                          ?>   
                          <?php }  ?>                   
                        </td>

                        <td>
                          <?php if(isset($status_piecemark_ref[$value['pos_2']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_2']]["ref_pos_1"])){ ?> 
                          <?php  
                              $data_multiple_piecemark_1 = explode(", ",$status_piecemark_ref[$value['pos_2']]["ref_pos_1"]);  
                              foreach($data_multiple_piecemark_1 as $vaxx){   
                                  echo  "<span class='badge'>".$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['thickness']."</span> <br/>"; 
                              } 
                          ?> 
                          <?php } else { ?>
                          <?php 
                            if(isset($status_piecemark[$value['pos_2']]['id_mis'])){
                              echo $status_piecemark[$value['pos_2']]['thickness'];
                            } 
                          ?>
                          <?php }  ?>
                        </td>

                        <!-- Start - Fitup Inspection -->
                        <td>
                          <?php if(isset($value['fitup_report_no']) && $value['fitup_status_inspection'] == 7){ ?>
                            <a href="<?php echo base_url(); ?>fitup/pdf_files/<?= $project_id_enc ?>/<?= $discipline_enc ?>/<?= $module_enc ?>/<?= $type_of_module_enc ?>/<?= $report_fitup_enc ?>" target='_blank'><?php echo $report_no_fu[$value['project']][$value['discipline']][$value['type_of_module']]['fitup_report'].$value['fitup_report_no']; ?></a>
                          <?php } else { ?>
                            <?php if(isset($value['visual_report_no'])){ ?>
                            <?php echo $report_no_fu[$value['project']][$value['discipline']][$value['type_of_module']]['fitup_report'].$value['fitup_report_no']; ?>
                            <?php } else { ?>
                              -  
                            <?php } ?>
                          <?php } ?>
                        </td>
                        <td>
                          <?php if(isset($value['fitup_report_no']) && $value['fitup_status_inspection'] == 7){ ?>
                            <?php echo date("Y-m-d",strtotime($value['fitup_inspection_datetime'])); ?>
                          <?php } else { ?>
                              -
                          <?php } ?> 
                        </td>
                        <td>                          
                          <?php if(isset($value['fitup_report_no']) && $value['fitup_status_inspection'] == 7){ ?>
                              ACC
                          <?php } else { ?>
                              -
                          <?php } ?> 
                        </td>
                        <td>
                          <?php                         
                            $fitter_id = explode(";", $value['fitter_id']);                          
                            if(sizeof($fitter_id) > 0){ 
                              foreach ($fitter_id as $key => $fitter_id_name) {
                                if(isset($master_fitter[$fitter_id_name]["fit_up_badge"])){ echo $master_fitter[$fitter_id_name]["fit_up_badge"]."<br/>"; }
                              }
                            } 
                          ?>
                        </td>
                        <td>
                          <?php    
                            $tack_weld_id = explode(";", $value['tack_weld_id']);                          
                            if(sizeof($tack_weld_id) > 0){ 
                              foreach ($tack_weld_id as $key => $tack_weld_id_name) {
                                if(isset($master_welder[$tack_weld_id_name]["rwe_code"])){ echo $master_welder[$tack_weld_id_name]["rwe_code"]."<br/>"; }
                              }
                            } 
                          ?>
                        </td>
                        <!-- Finish - Fitup Inspection -->   
                        
                        <!-- Start - Visual Inspection -->  
                        <td>
                          <?php 
                            $wps_rh = explode(";", $value['wps_no_rh']);
                            $wps_fc = explode(";", $value['wps_no_fc']);
                            $wps_show = array_unique(array_merge($wps_rh, $wps_fc));
                            if(sizeof($wps_show) > 0){ 
                              foreach ($wps_show as $key => $wps_id) {
                                if(isset($wps_code_arr[$wps_id])){ echo $wps_code_arr[$wps_id]."<br/>"; }
                              }
                            } 
                          ?>
                        </td>
                        <td><?php echo $value['cons_lot_no']; ?></td>
                        <td><?php echo $value['weld_datetime']; ?></td>
                        <td>
                          <?php  
                            if($value["process_gtaw_rh"] > 0){ echo "GTAW <br/>"; }
                            if($value["process_gmaw_rh"] > 0){ echo "GMAW <br/>"; }
                            if($value["process_smaw_rh"] > 0){ echo "SMAW <br/>"; }
                            if($value["process_fcaw_rh"] > 0){ echo "FCAW <br/>"; }
                            if($value["process_saw_rh"]  > 0){ echo "SAW <br/>"; }
                          ?>
                        </td>

                        <td>
                          <?php  
                            if($value["process_gtaw_fc"] > 0){ echo "GTAW <br/>"; }
                            if($value["process_gmaw_fc"] > 0){ echo "GMAW <br/>"; }
                            if($value["process_smaw_fc"] > 0){ echo "SMAW <br/>"; }
                            if($value["process_fcaw_fc"] > 0){ echo "FCAW <br/>"; }
                            if($value["process_saw_fc"]  > 0){ echo "SAW <br/>"; }
                          ?>
                        </td>

                        <td>
                          <?php 
                            $welder_rh = explode(";", $value['welder_ref_rh']);                          
                            if(sizeof($welder_rh) > 0){ 
                              foreach ($welder_rh as $key => $welder_id_rh) {
                                if(isset($master_welder[$welder_id_rh]["rwe_code"])){ 
                                  echo $master_welder[$welder_id_rh]["rwe_code"]."<br/>";
                                }
                              }
                            } 
                          ?>
                        </td>
                        <td>
                          <?php 
                            $welder_fc = explode(";", $value['welder_ref_fc']);                          
                            if(sizeof($welder_fc) > 0){ 
                              foreach ($welder_fc as $key => $welder_id_fc) {
                                if(isset($master_welder[$welder_id_fc]["rwe_code"])){ 
                                  echo $master_welder[$welder_id_fc]["rwe_code"]."<br/>";
                                }
                              }
                            } 
                          ?>
                        </td>
                        <!-- Start - Visual Inspection -->  
                         <!-- Start - Visual Inspection -->      
                        <td>
                          <?php if(isset($value['visual_report_no']) AND $value['visual_status_inspection'] == 7){  ?>
                            <a href="<?php echo base_url(); ?>visual/visual_pdf/<?= $value['visual_report_no'] ?>/client/<?= $drawing_no ?>/<?= $value["rev_postpone_visual"] ?>" target='_blank'><?php echo $report_no_vs[$value['project']][$value['discipline']][$value['type_of_module']]['visual_report'].$value['visual_report_no']; ?></a>
                          <?php } else { ?>
                            <?php if(isset($value['visual_report_no'])){ ?>
                            <?php echo $report_no_vs[$value['project']][$value['discipline']][$value['type_of_module']]['visual_report'].$value['visual_report_no']; ?>
                            <?php } else { ?>
                              -  
                            <?php } ?>
                          <?php } ?>
                        </td>
                        <td>
                          <?php if(isset($value['visual_report_no']) AND $value['visual_status_inspection'] == 7){  ?>
                             <?php echo date("Y-m-d",strtotime($value['visual_inspection_datetime'])); ?>
                          <?php } else { ?>
                            -
                          <?php } ?> 
                        </td>
                        <td>
                          <?php if(isset($value['visual_report_no']) AND $value['visual_status_inspection'] == 7){  ?>
                             ACC
                          <?php } else { ?>
                            -
                          <?php } ?>  
                        </td>
                         <!-- Finish - Visual Inspection -->  

                        <td>     

                          <?php
                            if(isset($ndt_all[$value['id_joint_visual']][2][$value['revision_category']][$value['revision']])){
                              $total_arr[$key] = sizeof($ndt_all[$value['id_joint_visual']][2][$value['revision_category']][$value['revision']]);
                            } else{
                              $total_arr[$key] = 0;
                            }

                            if(isset($ndt_all[$value['id_joint_visual']][2][$value['revision_category']][$value['revision']])){                              
                              foreach($ndt_all[$value['id_joint_visual']][2][$value['revision_category']][$value['revision']] as $key01 => $val01){
                                echo $value["mt_percent_req"]."%"; 
                                if($total_arr[$key] > 1){ echo "<hr/>"; }
                              }
                            } else { echo "-"; } 
                          ?>
                        </td>
                        <td>
                          <?php
                            if(isset($ndt_all[$value['id_joint_visual']][2][$value['revision_category']][$value['revision']])){
                              foreach($ndt_all[$value['id_joint_visual']][2][$value['revision_category']][$value['revision']] as $key02 => $val02){
                          ?>       
                                <?php if(isset($val02['filename'])){  ?>
                                  <a href="<?= base_url() ?>/upload/ndt/<?= $val02['filename'] ?>" target='blank'><?= @$val02['report_number'] ?></a>
                                  <?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } else { ?> 
                                  <?= @$val02['report_number'] ?>
                                  <?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?> 
                                <?php } ?>
                          <?php        
                              }
                            } else { echo "-"; } 
                          ?> 
                        </td>
                        <td>
                          <?php
                            if(isset($ndt_all[$value['id_joint_visual']][2][$value['revision_category']][$value['revision']])){
                              foreach($ndt_all[$value['id_joint_visual']][2][$value['revision_category']][$value['revision']] as $key03 => $val03){
                          ?>       
                                <?php if(isset($val03['report_number'])){  ?>
                                    <?= DATE('d F, Y', strtotime($val03['date_of_inspection'])) ?> 
                                    <?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } else { ?> 
                                  - <?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } ?>
                          <?php        
                              }
                            } else { echo "-"; } 
                          ?> 
                        </td>
                        <td> 
                          <?php
                            if(isset($ndt_all[$value['id_joint_visual']][2][$value['revision_category']][$value['revision']])){
                              foreach($ndt_all[$value['id_joint_visual']][2][$value['revision_category']][$value['revision']] as $key04 => $val04){
                          ?>       
                                <?php if($val04['result']==3){  ?>
                                    <?= "ACC" ?><?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } else if($val04['result']==2){  ?>    
                                    <?= "REJECT" ?><?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } else { ?> 
                                  -<?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } ?> 
                          <?php        
                              }
                            } else { echo "-"; } 
                          ?>
 
                        </td>

                        <td>     

                          <?php
                          if(isset($ndt_all[$value['id_joint_visual']][7][$value['revision_category']][$value['revision']])){
                            $total_arr[$key] = sizeof($ndt_all[$value['id_joint_visual']][7][$value['revision_category']][$value['revision']]);
                          } else{
                            $total_arr[$key] = 0;
                          }

                            if(isset($ndt_all[$value['id_joint_visual']][7][$value['revision_category']][$value['revision']])){                              
                              foreach($ndt_all[$value['id_joint_visual']][7][$value['revision_category']][$value['revision']] as $key01 => $val01){
                                echo $value["mt_percent_req"]."%"; 
                                if($total_arr[$key] > 1){ echo "<hr/>"; }
                              }
                            } else { echo "-"; } 
                          ?>
                        </td>
                        <td>
                          <?php
                            if(isset($ndt_all[$value['id_joint_visual']][7][$value['revision_category']][$value['revision']])){
                              foreach($ndt_all[$value['id_joint_visual']][7][$value['revision_category']][$value['revision']] as $key02 => $val02){
                          ?>       
                                <?php if(isset($val02['filename'])){  ?>
                                  <a href="<?= base_url() ?>/upload/ndt/<?= $val02['filename'] ?>" target='blank'><?= @$val02['report_number'] ?></a>
                                  <?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } else { ?> 
                                  <?= @$val02['report_number'] ?>
                                  <?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?> 
                                <?php } ?>
                          <?php        
                              }
                            } else { echo "-"; } 
                          ?> 
                        </td>
                        <td>
                          <?php
                            if(isset($ndt_all[$value['id_joint_visual']][7][$value['revision_category']][$value['revision']])){
                              foreach($ndt_all[$value['id_joint_visual']][7][$value['revision_category']][$value['revision']] as $key03 => $val03){
                          ?>       
                                <?php if(isset($val03['report_number'])){  ?>
                                    <?= DATE('d F, Y', strtotime($val03['date_of_inspection'])) ?> 
                                    <?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } else { ?> 
                                  - <?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } ?>
                          <?php        
                              }
                            } else { echo "-"; } 
                          ?> 
                        </td>
                        <td> 
                          <?php
                            if(isset($ndt_all[$value['id_joint_visual']][7][$value['revision_category']][$value['revision']])){
                              foreach($ndt_all[$value['id_joint_visual']][7][$value['revision_category']][$value['revision']] as $key04 => $val04){
                          ?>       
                                <?php if($val04['result']==3){  ?>
                                    <?= "ACC" ?><?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } else if($val04['result']==2){  ?>    
                                    <?= "REJECT" ?><?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } else { ?> 
                                  -<?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } ?> 
                          <?php        
                              }
                            } else { echo "-"; } 
                          ?>
 
                        </td>

                        <td>     

                          <?php
                          if(isset($ndt_all[$value['id_joint_visual']][3][$value['revision_category']][$value['revision']])){
                            $total_arr[$key] = sizeof($ndt_all[$value['id_joint_visual']][3][$value['revision_category']][$value['revision']]);
                          } else{
                            $total_arr[$key] = 0;
                          }

                            if(isset($ndt_all[$value['id_joint_visual']][3][$value['revision_category']][$value['revision']])){                              
                              foreach($ndt_all[$value['id_joint_visual']][3][$value['revision_category']][$value['revision']] as $key01 => $val01){
                                echo $value["mt_percent_req"]."%"; 
                                if($total_arr[$key] > 1){ echo "<hr/>"; }
                              }
                            } else { echo "-"; } 
                          ?>
                        </td>
                        <td>
                          <?php
                            if(isset($ndt_all[$value['id_joint_visual']][3][$value['revision_category']][$value['revision']])){
                              foreach($ndt_all[$value['id_joint_visual']][3][$value['revision_category']][$value['revision']] as $key02 => $val02){
                          ?>       
                                <?php if(isset($val02['filename'])){  ?>
                                  <a href="<?= base_url() ?>/upload/ndt/<?= $val02['filename'] ?>" target='blank'><?= @$val02['report_number'] ?></a>
                                  <?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } else { ?> 
                                  <?= @$val02['report_number'] ?>
                                  <?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?> 
                                <?php } ?>
                          <?php        
                              }
                            } else { echo "-"; } 
                          ?> 
                        </td>
                        <td>
                          <?php
                            if(isset($ndt_all[$value['id_joint_visual']][3][$value['revision_category']][$value['revision']])){
                              foreach($ndt_all[$value['id_joint_visual']][3][$value['revision_category']][$value['revision']] as $key03 => $val03){
                          ?>       
                                <?php if(isset($val03['report_number'])){  ?>
                                    <?= DATE('d F, Y', strtotime($val03['date_of_inspection'])) ?> 
                                    <?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } else { ?> 
                                  - <?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } ?>
                          <?php        
                              }
                            } else { echo "-"; } 
                          ?> 
                        </td>
                        <td> 
                          <?php
                            if(isset($ndt_all[$value['id_joint_visual']][3][$value['revision_category']][$value['revision']])){
                              foreach($ndt_all[$value['id_joint_visual']][3][$value['revision_category']][$value['revision']] as $key04 => $val04){
                          ?>       
                                <?php if($val04['result']==3){  ?>
                                    <?= "ACC" ?><?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } else if($val04['result']==2){  ?>    
                                    <?= "REJECT" ?><?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } else { ?> 
                                  -<?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } ?> 
                          <?php        
                              }
                            } else { echo "-"; } 
                          ?>
 
                        </td>

                        <td>     

                          <?php
                          if(isset($ndt_all[$value['id_joint_visual']][1][$value['revision_category']][$value['revision']])){
                            $total_arr[$key] = sizeof($ndt_all[$value['id_joint_visual']][1][$value['revision_category']][$value['revision']]);
                          } else{
                            $total_arr[$key] = 0;
                          }

                            if(isset($ndt_all[$value['id_joint_visual']][1][$value['revision_category']][$value['revision']])){                              
                              foreach($ndt_all[$value['id_joint_visual']][1][$value['revision_category']][$value['revision']] as $key01 => $val01){
                                echo $value["mt_percent_req"]."%"; 
                                if($total_arr[$key] > 1){ echo "<hr/>"; }
                              }
                            } else { echo "-"; } 
                          ?>
                        </td>
                        <td>
                          <?php
                            if(isset($ndt_all[$value['id_joint_visual']][1][$value['revision_category']][$value['revision']])){
                              foreach($ndt_all[$value['id_joint_visual']][1][$value['revision_category']][$value['revision']] as $key02 => $val02){
                          ?>       
                                <?php if(isset($val02['filename'])){  ?>
                                  <a href="<?= base_url() ?>/upload/ndt/<?= $val02['filename'] ?>" target='blank'><?= @$val02['report_number'] ?></a>
                                  <?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } else { ?> 
                                  <?= @$val02['report_number'] ?>
                                  <?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?> 
                                <?php } ?>
                          <?php        
                              }
                            } else { echo "-"; } 
                          ?> 
                        </td>
                        <td>
                          <?php
                            if(isset($ndt_all[$value['id_joint_visual']][1][$value['revision_category']][$value['revision']])){
                              foreach($ndt_all[$value['id_joint_visual']][1][$value['revision_category']][$value['revision']] as $key03 => $val03){
                          ?>       
                                <?php if(isset($val03['report_number'])){  ?>
                                    <?= DATE('d F, Y', strtotime($val03['date_of_inspection'])) ?> 
                                    <?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } else { ?> 
                                  - <?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } ?>
                          <?php        
                              }
                            } else { echo "-"; } 
                          ?> 
                        </td>
                        <td> 
                          <?php
                            if(isset($ndt_all[$value['id_joint_visual']][1][$value['revision_category']][$value['revision']])){
                              foreach($ndt_all[$value['id_joint_visual']][1][$value['revision_category']][$value['revision']] as $key04 => $val04){
                          ?>       
                                <?php if($val04['result']==3){  ?>
                                    <?= "ACC" ?><?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } else if($val04['result']==2){  ?>    
                                    <?= "REJECT" ?><?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } else { ?> 
                                  -<?php if($total_arr[$key] > 1){ echo "<hr/>"; } ?>
                                <?php } ?> 
                          <?php        
                              }
                            } else { echo "-"; } 
                          ?>
 
                        </td>

                        <td><?= @$value['irn_transmitted_no'] ?></td>
                        <td><?= @isset($value['irn_approval_by_client']) ? date("Y-m-d",strtotime($value['irn_approval_by_datetime'])) : null  ?></td>
                        <td><?= @isset($value['irn_approval_by_client']) ? 'ACC' : null ?></td>

                        <td><?php if(isset($status_piecemark[$value['pos_1']]['id_mis'])){ echo str_replace("\n","<br/>",$value["visual_remarks"]); } ?></td>
                    </tr>
                <?php } } ?>                
              </tbody>
            </table>
            <?php if(!isset($export_as)){ ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div><!-- ini div dari sidebar yang class wrapper -->

<script type="text/javascript">

  $('.dataTable').DataTable({
    "scrollY":        700,
    "scrollX":        true,
    "scrollCollapse": true,
    "fixedColumns":   {
            leftColumns: 3
        },
    //"order": [[2, 'asc']]    

  });

  </script>

  <?php } ?>