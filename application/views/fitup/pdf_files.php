<?php     
    $error_level = error_reporting();
    error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
    // dompdf code
    error_reporting($error_level);

    $legend_inspection          = explode(";", $joint_list[0]['legend_inspection_auth']);
 ?>
<!DOCTYPE html>
<html><head>
  <title><?php if(isset($report_number)){ echo  $report_number; } else { echo  $submission_data_id; } ?></title>
  <style type="text/css">
 
   @page {
      margin: 0cm 0cm;
    }

    body {
      top: 0cm;
      left: 0cm;
      right: 0cm;
      margin-top: 6cm;
      margin-left: 0.29cm;
      margin-right: 0.29cm;
      margin-bottom: 0.5cm;
      
      font-family: "helvetica";
      font-size: 50% !important;
    }

    header {
      position: fixed;
      /*top: 2cm;*/
      left: 0cm;
      right: 0cm;
      height: 5cm;
      padding-top: 15px;
      /*padding-left: 1.4cm;
      padding-right: 1.5cm;*/
      margin-top: 0.2cm;
      margin-left: 0.25cm;
      margin-right: 0.25cm;
    
    }

    footer {
      position: fixed;
      top:20cm;
      left: 0cm;
      right: 0cm;
      height: 5cm;
      padding-top: 15px;
      /*padding-left: 1.4cm;
      padding-right: 1.5cm;*/
      margin-left: 0.25cm;
      margin-right: 0.25cm;
    
    }

    .titleHead {
      border:1px #000 solid;
      border-collapse: collapse;
      text-align: center;
      vertical-align: middle;
      font-size: 25px;
      background-color: #a6ffa6;
      font-weight: bold;
     
    }

    .titleHeadMain {
      text-align: center;
      border-collapse: collapse;
      text-align: center;
      vertical-align: middle;
      font-size: 25px;
      font-weight: bold;
    }

    table.table td {
      font-size: 90%;
      border:1px #000 solid;
      font-weight: bold;
      max-width: 150px;
      word-wrap: break-word;
    }

    table>thead>tr>td,table>tbody>tr>td{
      vertical-align: top;
    }

    .br_break{
      line-height: 15px;
    }

    .br_break_no_bold{
      line-height: 18px;
    }

    .br{
      border-right: 1px #000 solid;
    }
    .bl{
      border-left: 1px #000 solid;
    }
    .bt{
      border-top: 1px #000 solid;
    }
    .bb{
      border-bottom:  1px #000 solid;
    }
    .bx{
      border-left: 1px #000 solid;
      border-right: 1px #000 solid;
    }
    .by{
      border-top: 1px #000 solid;
      border-bottom: 1px #000 solid;
    }
    .ball{
      border-top: 1px #000 solid;
      border-bottom: 1px #000 solid;
      border-left: 1px #000 solid;
      border-right: 1px #000 solid;      
      word-wrap: break-word;
    }   
    .tab{
      display: inline-block; 
      width: 60px;
    }
    .tab2{
      display: inline-block; 
      width: 120px;
    }

    hr {
      border-top: 0px !important;
    }

    label {
      display: block;
      padding-left: 2;
      text-indent: -1;
    }

    input {
      width: 5px;
      height: 5px;
      padding: 0;
      margin:0;
      vertical-align: bottom;
      position: relative;
      top: 0px;
      *overflow: hidden;
    }

  </style>

</head><body>
 <header>
    <table width="100%" border="1px" style="border-collapse: collapse !important;">
      <tr>
        <td width="15%;" style="padding: 10px; border-right: 0px !important;">
        	<center>
        		<img src="img/seatrium_logo_bg_white.png" style='width: 160px; height: 50px;' />
        	</center>
        </td>
        <td style="padding: 10px; border-right: 0px !important; border-left: 0px !important;">
        	<center>
        		<b style="font-weight: bold; font-size: 20 !important; vertical-align: middle !important;">
        			<?php echo $project_data_portal[0]['description'] ?>
        		</b>
        	</center>
        </td>
        <td width="15%;" style="padding: 10px; border-left: 0px !important;">
        	<center>
        		<img src="<?php echo $project_data_portal[0]['client_logo']; ?>" style='width: 160px; height: 50px;' />
        	</center>
        </td>

      </tr>     
    </table> 
    
    <table width="100%" border="1px" style="border-collapse: collapse !important;">
      <head>
        <tr>
        <td ><b class="tab">EMPLOYER</b>: <?php echo strtoupper($project_data_portal[0]['client']); ?></td>
        <td>

          <?php 
              if($joint_list[0]['company_id'] == 13){
                $suffix_no = $master_report_number[$joint_list[0]['project_code']][$joint_list[0]['company_id']][$joint_list[0]['discipline']][$joint_list[0]['type_of_module']]['fitup_report_scm'];
              } else {
                $suffix_no = $master_report_number[$joint_list[0]['project_code']][$joint_list[0]['company_id']][$joint_list[0]['discipline']][$joint_list[0]['type_of_module']]['fitup_report'];
              }
           ?>

          <?php if(isset($report_number)){ ?><b class="tab2">REPORT NO.</b>: <?php echo $suffix_no.$report_number; } else { ?> <b class="tab2">SUBMISSION NO.</b>: <?php echo $submission_data_id; } ?> <?php if($joint_list[0]['postpone_reoffer_no'] > 0){ echo "Rev. ".$joint_list[0]['postpone_reoffer_no']; } ?>

        </td>
      </tr><tr>
        <td ><b class="tab">PROJECT</b>: <?php echo strtoupper($project_data_portal[0]['description']); ?></td>
        <td><b class="tab2">DATE</b>: 
        <?php 
        	// test_var($joint_list[0]);
          if($joint_list[0]['status_inspection'] <= 3){ 
            echo date("d F Y",strtotime($joint_list[0]['date_request'])); 
          } else { 
            echo 
            ( 
              $joint_list[0]['ticked_report_date'] == 1 ? 
              date("d F Y",strtotime($max_array_date_document_approval)) : 
              date("d F Y",strtotime($max_array_date_inspection))
            );
          } 
        ?></td>
      </tr><tr>
        <td ><b class="tab">MODULE.</b>: <?php echo $module_code[$joint_list[0]['module']]; ?></td>
        <!-- <td><b class="tab2">DRAWING NO.</b>: <?php echo $joint_list[0]['drawing_no']."&nbsp;".($master_drawing[$joint_list[0]['drawing_no']]['last_revision_no']>0 ? ' Rev. '.($joint_list[0]['status_inspection'] > 3 && isset($joint_list[0]['drawing_rev_no']) ? $joint_list[0]['drawing_rev_no']."---" : $master_drawing[$joint_list[0]['drawing_no']]['last_revision_no']."---") : '01'); ?> <?= (isset($client_doc_no[$joint_list[0]['drawing_no']]) ? "(".$client_doc_no[$joint_list[0]['drawing_no']].")" : "01") ?> </td> -->

        <td><b class="tab2">DRAWING NO.</b>: <?php echo $joint_list[0]['drawing_no']."&nbsp;Rev.".($joint_list[0]['status_inspection'] > 3 && isset($joint_list[0]['drawing_rev_no']) ? $joint_list[0]['drawing_rev_no'] : $master_drawing[$joint_list[0]['drawing_no']]['last_revision_no']) ?><?= (isset($client_doc_no[$joint_list[0]['drawing_no']]) ? " (".$client_doc_no[$joint_list[0]['drawing_no']].")" : null) ?></td>

      </tr><tr>
        <td ><b class="tab">CONTRACTOR</b>: <?php echo $joint_list[0]['company']; ?></td>
        <td><b class="tab2">DESCRIPTION</b>:  <?php if(isset($eng_detail[0]['title'])){ echo $eng_detail[0]['title']; } ?></td>
      </tr><tr>
        <td colspan="2" class="bb bx" width="100%"><center><b>FIT UP INSPECTION REPORT - 
          <?php if($joint_list[0]['discipline'] == 2){ echo "STRUCTURAL"; } else if($joint_list[0]['discipline'] == 1){ echo "PIPE"; } else if($joint_list[0]['discipline'] == 32){ echo "ARCHITECTURAL"; } else if($joint_list[0]['discipline'] == 74){ echo "HVAC"; } else if($joint_list[0]['discipline'] == 10){ echo "ELECTRICAL"; } else if($joint_list[0]['discipline'] == 75){ echo "MECHANICAL"; } ?></b></center></td>
      </tr><tr>
        <td colspan="2" class="bb bx" width="100%">    

         	<tr>
	          <td 
	          	colspan="1" 
	          	class="bb bx" 
	          	width="100%"
	          	style="border-right: 0px !important" 
	          ><left><b>DOCUMENT / SPECIFICATION / PROCEDURE No. / REFER to :
	          <?php 

              echo $master_acceptance[$joint_list[0]['project_code']][$joint_list[0]['company_id']][$joint_list[0]['discipline']][$joint_list[0]['module']][$joint_list[0]['type_of_module']][$joint_list[0]['class']]['fitup']['procedure'];

              // if($joint_list[0]['class']==1){
                // echo "
                //   </br>&nbsp;&nbsp;&nbsp;&nbsp;• 07555701 (B) - E.80 Fabrication and Construction
								// 	</br>&nbsp;&nbsp;&nbsp;&nbsp;• 08307791 - Inspection Test Procedure - ".($discipline_name[$joint_list[0]['discipline']])."
								// 	</br>&nbsp;&nbsp;&nbsp;&nbsp;• 08308559 - In-process Inspection procedure
                // ";
              // } else {
              //   echo "";
              // }
	          ?>

            
	          </b></left></td>
	          <td 
	          	colspan="1" 
	          	class="bb bx" 
	          	width="100%"
	          	style="border-left: 0px !important" 
	          ><left><b>Acceptance Criteria :
	          <?php 
	            // if($joint_list[0]['class']==1){
                // echo "
                //   </br>&nbsp;&nbsp;&nbsp;&nbsp;• Comply to approve WPS.
								// 	</br>&nbsp;&nbsp;&nbsp;&nbsp;• EN ISO 5817 – Level B category
								// 	</br>&nbsp;&nbsp;&nbsp;&nbsp;• DNVGL-OS-C401
								// 	</br>&nbsp;&nbsp;&nbsp;&nbsp;• NORSOK M101
                // ";

                echo $master_acceptance[$joint_list[0]['project_code']][$joint_list[0]['company_id']][$joint_list[0]['discipline']][$joint_list[0]['module']][$joint_list[0]['type_of_module']][$joint_list[0]['class']]['fitup']['acceptance_criteria'];
                
              // } else {
              //   echo "
              //   	</br>&nbsp;&nbsp;&nbsp;&nbsp;
							// 		</br>&nbsp;&nbsp;&nbsp;&nbsp;
							// 		</br>&nbsp;&nbsp;&nbsp;&nbsp;
							// 		</br>&nbsp;&nbsp;&nbsp;&nbsp;
              //   ";
              // }
	          ?>
	          </b></left></td>
	        </tr>
          
        </td>
      </tr>
      </head>
    </table>
  </header> 
  <table width="100%" border="0" style="text-align: left;border-collapse: collapse !important;">
    <thead><tr>
      <td rowspan="2" class="ball" style="vertical-align: middle; width: 15px !important;"><center><b>S/N</b></center></td>
      <td rowspan="2" class="ball" style="vertical-align: middle; width: 100px !important;"><center><b>Weld Map Drawing No. / Line & Spool No</b></center></td>
      <td rowspan="2" class="ball" style="vertical-align: middle; width: 30px !important;"><center><b>Item No./<br/>Joint No</b></center></td>
      <td rowspan="2" class="ball" style="vertical-align: middle; width: 50px !important;"><center><b>Type<br/>Of<br/>Weld</b></center></td>
      <td colspan="8" class="ball" style="vertical-align: middle;"><center><b>Material Traceability</b></center></td>
      <td rowspan="2" class="ball" style="vertical-align: middle; width: 40px !important;"><center><b>Weld Length<br/>(mm)</b></center></td>

      <td rowspan="2" class="ball" style="vertical-align: middle; width: 50px !important;"><center><b>Inspection<br/>Result</b></center></td>
      <td rowspan="2" class="ball" style="vertical-align: middle; width: 50px !important;"><center><b>Remarks</b></center></td>      
    </tr><tr>
      <td class="ball" style="vertical-align: middle; width: 60px !important;"><center><b>Desc</b></center></td>
      <td class="ball" style="vertical-align: middle; width: 100px !important;"><center><b>Piece Mark</b></center></td>
      <td class="ball" style="vertical-align: middle; width: 70px !important;"><center><b>Grade/Spec</b></center></td>
      <td class="ball" style="vertical-align: middle; width: 130px !important;"><center><b>Unique No.</b></center></td>
      <td class="ball" style="vertical-align: middle; width: 50px !important;"><center><b>Heat No.</b></center></td>     
      <td class="ball" style="vertical-align: middle; width: 40px !important;"><center><b>Dia/Size</b></center></td>     
      <td class="ball" style="vertical-align: middle; width: 40px !important;"><center><b>Sch</b></center></td>     
      <td class="ball" style="vertical-align: middle; width: 40px !important;"><center><b>Thk<br/>(mm)</b></center></td>     
    </tr>
  </thead>

  <tbody>
    <?php 
    $no=1;
    $count_client_approve = 0;
    $count_qc_approve = 0;
    $count_all_Data = 0;
    foreach ($joint_list as $value){  ?>

    <?php 

      if($value['status_inspection'] == 7){ $count_client_approve++; } 
      if($value['status_inspection'] >= 3){ $count_qc_approve++; } 
      $count_all_Data++; 

    ?>
      <tr>
        <td class="ball" style="vertical-align: middle;text-align: center;"><?php echo $no; ?></td>
        <td class="ball" style="vertical-align: middle;text-align: center;">
          <?php
            if($value['status_inspection'] >= '5' && isset($value['drawing_wm_approved'])){
              echo $value['drawing_wm_approved'].' Rev.'.$value['drawing_wm_rev_approved'].' ('.$client_doc_no[$value['drawing_wm_approved']].')';
            } else {
              $text = ($value['drawing_wm'])." Rev.".($value['rev_wm'])." ".($client_doc_no[$value['drawing_wm']]).")";
              echo $text;
            }
          ?>
          <!-- <?php
            $text = ($value['drawing_wm'])." Rev.".($value['rev_wm'])." (".($client_doc_no[$value['drawing_wm']]).")";
            echo $text; 
          ?> -->
        </td>
        <td class="ball" style="vertical-align: middle;text-align: center;"><?php echo $value['joint_no']
        ?></td>
        <td class="ball" style="vertical-align: middle;text-align: center;"><?php if(isset($weld_type_code[$value['weld_type']])){ echo $weld_type_code[$value['weld_type']]; } ?></td>
        <td class="ball" style="vertical-align: middle;text-align: center;">  
            <?php
                $pos_1  = explode(";",$value['pos_1']); 
                foreach($pos_1 as $pc1){ 
                    echo "<span class='badge'>".(isset($status_piecemark[$pc1]["profile"]) ? $status_piecemark[$pc1]["profile"] : "-")."</span><hr/>";
                }
                $pos_2  = explode(";",$value['pos_2']); 
                foreach($pos_2 as $pc2){
                    echo "<span class='badge'>".(isset($status_piecemark[$pc2]["profile"]) ? $status_piecemark[$pc2]["profile"] : "-")."</span><hr/>";
                }
            ?> 
        </td>
        <td class="ball" style="vertical-align: middle;text-align: center;">    
            <?php
                $pos_1  = explode(";",$value['pos_1']); 
                foreach($pos_1 as $pc1){  
                if (isset($activity_eng[$status_piecemark[$pc1]['drawing_sp']]['id'])) {
                    $drawing_sp_rev_p1 = $status_piecemark[$pc1]['rev_sp'];
                    $links_sp_p1 = base_url_ftp_eng() . "public_smoe/open_atc/2/" . strtr($this->encryption->encrypt($activity_eng[$status_piecemark[$pc1]['drawing_sp']]['id']), '+=/', '.-~') . '/' . $drawing_sp_rev_p1; 
                } else {
                    $links_sp_p1 = null;
                }   
                if (isset($links_sp_p1)) {
                ?>
                    <a href='<?= $links_sp_p1 ?>' target='_blank' style='color:black !important;'>
                    <span class='badge'><?php echo $pc1; ?></span>
                    </a>
                <?php 
                    } else {
                    echo "<span class='badge'>".$pc1."</span><hr/>"; 
                    } 
                }                      
                ?>  
            <?php
                $pos_2  = explode(";",$value['pos_2']); 
                foreach($pos_2 as $pc2){  
                if (isset($activity_eng[$status_piecemark[$pc2]['drawing_sp']]['id'])) {
                    $drawing_sp_rev_p2 = $status_piecemark[$pc2]['rev_sp'];
                    $links_sp_p2 = base_url_ftp_eng() . "public_smoe/open_atc/2/" . strtr($this->encryption->encrypt($activity_eng[$status_piecemark[$pc2]['drawing_sp']]['id']), '+=/', '.-~') . '/' . $drawing_sp_rev_p2; 
                } else {
                    $links_sp_p2 = null;
                } 

                if (isset($links_sp_p2)) {
                    ?>
                    <a href='<?= $links_sp_p2 ?>' target='_blank' style='color:black !important;'>
                    <span class='badge'><?php echo $pc2; ?></span>
                    </a>
                    <?php 
                    } else {
                        echo "<span class='badge'>".$pc2."</span><hr/>"; 
                    } 
                }                            
            ?>   
        </td>
        <td class="ball" style="vertical-align: middle;text-align: center;">          
            <?php
                $pos_1  = explode(";",$value['pos_1']); 
                foreach($pos_1 as $pc1){ 
                echo "<span class='badge'>".(isset($material_grade[$status_piecemark[$pc1]["grade"]]['material_grade']) ? $material_grade[$status_piecemark[$pc1]["grade"]]['material_grade'] : "-" )."</span><hr/>";
                }
                $pos_2  = explode(";",$value['pos_2']); 
                foreach($pos_2 as $pc2){
                echo "<span class='badge'>".(isset($material_grade[$status_piecemark[$pc2]["grade"]]['material_grade']) ? $material_grade[$status_piecemark[$pc2]["grade"]]['material_grade'] : "-" )."</span><hr/>";
                }
            ?> 
        </td>
        <td class="ball" style="vertical-align: middle;text-align: center;">
          <?php
            $pos_1  = explode(";",$value['pos_1']); 
            foreach($pos_1 as $pc1){ 
            echo "<span class='badge'>".(isset($warehouse_mis_mrir[$status_piecemark[$pc1]["id_mis"]]['unique_ident_no']) ? $warehouse_mis_mrir[$status_piecemark[$pc1]["id_mis"]]['unique_ident_no'] : "-")."</span><hr/>";
            }
            $pos_2  = explode(";",$value['pos_2']); 
            foreach($pos_2 as $pc2){
            echo "<span class='badge'>".(isset($warehouse_mis_mrir[$status_piecemark[$pc2]["id_mis"]]['unique_ident_no']) ? $warehouse_mis_mrir[$status_piecemark[$pc2]["id_mis"]]['unique_ident_no'] : "-")."</span><hr/>";
            }
          ?>
        </td>

        <td class="ball" style="vertical-align: middle;text-align: center;">
            <?php
                $pos_1  = explode(";",$value['pos_1']); 
                foreach($pos_1 as $pc1){ 
                echo "<span class='badge'>".(isset($warehouse_mis_mrir[$status_piecemark[$pc1]["id_mis"]]['unique_ident_no']) ? $warehouse_mis_mrir[$status_piecemark[$pc1]["id_mis"]]['heat_or_series_no'] : "-")."</span><hr/>";
                }
                $pos_2  = explode(";",$value['pos_2']); 
                foreach($pos_2 as $pc2){
                echo "<span class='badge'>".(isset($warehouse_mis_mrir[$status_piecemark[$pc2]["id_mis"]]['unique_ident_no']) ? $warehouse_mis_mrir[$status_piecemark[$pc2]["id_mis"]]['heat_or_series_no'] : "-")."</span><hr/>";
                }
              ?> 
        </td>

        <td class="ball" style="vertical-align: middle;text-align: center;">
            <?php
                $pos_1  = explode(";",$value['pos_1']); 
                foreach($pos_1 as $pc1){ 
                    echo "<span class='badge'>".(isset($status_piecemark[$pc1]["diameter"]) ? $status_piecemark[$pc1]["diameter"] : "-")."</span><hr/>";
                }
                $pos_2  = explode(";",$value['pos_2']); 
                foreach($pos_2 as $pc2){
                    echo "<span class='badge'>".(isset($status_piecemark[$pc2]["diameter"]) ? $status_piecemark[$pc2]["diameter"] : "-")."</span><hr/>";
                }
            ?>  
        </td>
        <td class="ball" style="vertical-align: middle;text-align: center;">
          <?php
              $pos_1  = explode(";",$value['pos_1']); 
              foreach($pos_1 as $pc1){ 
                echo "<span class='badge'>".(isset($status_piecemark[$pc1]["sch"]) ? $status_piecemark[$pc1]["sch"] : "-")."</span><hr/>";
              }
              $pos_2  = explode(";",$value['pos_2']); 
              foreach($pos_2 as $pc2){
                echo "<span class='badge'>".(isset($status_piecemark[$pc2]["sch"]) ? $status_piecemark[$pc2]["sch"] : "-")."</span><hr/>";
              }
          ?>       
        </td>
        <td class="ball" style="vertical-align: middle;text-align: center;">
        <?php
                         $pos_1  = explode(";",$value['pos_1']); 
                         foreach($pos_1 as $pc1){ 
                            echo "<span class='badge'>".(isset($status_piecemark[$pc1]["thickness"]) ? $status_piecemark[$pc1]["thickness"] : "-")."</span><hr/>";
                         }
                         $pos_2  = explode(";",$value['pos_2']); 
                         foreach($pos_2 as $pc2){
                            echo "<span class='badge'>".(isset($status_piecemark[$pc2]["thickness"]) ? $status_piecemark[$pc2]["thickness"] : "-")."</span><hr/>";
                         }
                      ?> 
        </td>
        <td  class="ball" style="vertical-align: middle;text-align: center;">
          <?php echo $value['weld_length']; ?>
        </td>
        
        <td  class="ball" style="vertical-align: middle;text-align: center;">
          <?php if($value['status_inspection'] == "6" OR $value['status_inspection'] == "2"){ echo "REJECT"; } else if($value['status_inspection'] >= 3){ echo "ACC"; } ?>
        </td>       
        <td  class="ball" style="vertical-align: middle;text-align: center;"><?php if($value['status_inspection'] != "2" AND $value['status_inspection'] != "6"){ ?><?php echo str_replace("\n","<br/>",$value['remarks']); ?><?PHP } else { ?><?php echo $value["rejected_remarks"]; ?><?php } ?></td>
      </tr> 
       
      <?php $no++; } ?>
    </tbody>
  </table>

  <?php if($joint_list[0]['project']==14){ ?>
    <br><br><br><br>
    <table border="1" style="border-collapse: collapse; width:300px !important">
      <tr>
        <td style="height: 70px !important">
          <b>Note/Remarks:</b>
          <br>
          <br>
          <?= $joint_list[0]['accepted_remarks'] ?>
        </td>
      </tr>
    </table>
  <?php } ?>

    <?php $sisa_pending_client = $count_all_Data - $count_client_approve;  ?>
    <?php $sisa_pending_qc = $count_all_Data - $count_qc_approve;  ?>
    <div style="page-break-inside: avoid;">
    <br/>
    <table width="100%">
      <tr>
        <td colspan="16">      
          <table class="table-body" width="100%" style="text-align: left; border-collapse: collapse !important;">
            <tr>
              <td style="width: 25%; border: none;"></td>
              <td style="width: 25%; border: none;"></td>
              <td style="width: 25%; border: none;"></td>
              <td style="width: 25%; border: none;"></td>
              <td style="width: 25%; border: none;"></td>
            </tr><tr>
              <td style="width: 25%; border: none;"> 
                  <?php if($sisa_pending_qc <= 0){ ?>
                    <img style="width:100px;" src="data:image/png;base64, <?=  ($joint_list[0]['ticked_report_date'] == 1 ?  (isset($sign_approval[$joint_list[0]['document_approval_by']]) ? $sign_approval[$joint_list[0]['document_approval_by']] : '') :  (isset($sign_approval[$joint_list[0]['inspection_by']]) ? $sign_approval[$joint_list[0]['inspection_by']] : '') )  ?>"> 
                  <?php } ?>                    
              </td>
              <td style="width: 25%; border: none;"></td>
              <td style="width: 25%; border: none;">
                  <?php // if($sisa_pending_client <= 0){ ?>
                    <!-- <img  style="width:100px;" src="data:image/png;base64, <?php if(isset($sign_approval[$joint_list[0]['client_inspection_by']])){ echo $sign_approval[$joint_list[0]['client_inspection_by']]; } ?>"> -->
                    <?php if ($joint_list[0]['project_code'] == 17) : ?>
		                	<style type="text/css">
		                		.color_stamp {
										      color: rgba(63, 72, 204, 255);
										    }
										    .check_stamp {
										      -ms-transform: scale(1.7) !important;
										      -moz-transform: scale(1.7) !important;
										      -webkit-transform: scale(1.7) !important;
										      -o-transform: scale(1.7) !important;
										      transform: scale(1.7) !important;
										    }
										    .border_stamp {
										      border: 3px solid rgba(63, 72, 204, 255);
										    }
										    .box_stamp {
										      padding: 4px;
										      font-weight: bold;
										      margin-left: -30px !important;
										      width: 140px;
										      z-index: 99 !important;
										    }
		                	</style>
		                  <div class="box color_stamp border_stamp box_stamp">
		                    <center>
		                      <img src="img/orsted_stamp.png" style="width:35px">
		                      <br>
		                      <strong>CHW 2204 OSS Project</strong>
		                    </center>
		                    <table cellpadding="0" style="width:100%;">
		                      <tr>
		                        <td width="40%" class="valign_middle">Review</td>
		                        <td><input type="checkbox" style="margin-bottom: 8px" <?= $legend_inspection[3] == 1 ? 'checked' : '' ?>></td>
		                      </tr>
		                      <tr>
		                        <td width="40%" class="valign_middle">Witness</td>
		                        <td><input type="checkbox" style="margin-bottom: 8px" <?= ($legend_inspection[0]==1 OR $legend_inspection[1]==1) ? 'checked' : '' ?>></td>
		                      </tr>
		                      <tr>
		                        <td width="40%" class="valign_middle">Inspect</td>
		                        <td><input type="checkbox" style="margin-bottom: 8px" <?= $legend_inspection[0]==1 ? 'checked' : '' ?>></td>
		                      </tr>
		                    </table>
		                    <br>
		                    Date : <?= $joint_list[0]['client_inspection_date'] ? date('Y-m-d', strtotime($joint_list[0]['client_inspection_date'])) : space(15) ?>
		                    &nbsp;
		                    <span style="z-index: 99 !important;">Signature :</span>

		                  </div>
		                  <div class="text-right" style="padding-right: 5px; padding-bottom:3px;">
		                  	<?php if($sisa_pending_client <= 0){ ?>
			                    <img src="data:image/png;base64, <?= $user[$joint_list[0]['client_inspection_by']]['sign_approval'] ?>" style='width: 80px !important; position: absolute !important; margin-left: 40px !important; margin-top: -58px !important; z-index: -99 !important;  
/*			                    	border: 5px solid #555;*/
			                    	' />
			                  <?php } ?>
		                  </div>
		                  <?php else: ?>
		                  	<?php if($sisa_pending_client <= 0){ ?>
		                    	<img src="data:image/png;base64,<?= $user[$joint_list[0]['client_inspection_by']]['sign_approval'] ?>" style='width: 3.5cm;vertical-align: text-bottom !important;' />
		                    <?php } ?>
		                <?php endif; ?>
                  <?php // } ?>
              </td>
              <td style="width: 25%; border: none;"></td>
              <td style="width: 25%; border: none;"></td>
            </tr><tr>
              <td style="width: 25%; border: none;"></td>
              <td style="width: 25%; border: none;"></td>
              <td style="width: 25%; border: none;"></td>
              <td style="width: 25%; border: none;"></td>
              <td style="width: 25%; border: none;"></td>
            </tr><tr>
              <td style="width: 25%; border: none;">
                <?php if($sisa_pending_qc <= 0){ ?>
                <?= ($joint_list[0]['ticked_report_date'] == 1 ? (isset($joint_list[0]['document_approval_by']) ? $user_list[$joint_list[0]['document_approval_by']] : '') : (isset($joint_list[0]['inspection_by']) ?  $user_list[$joint_list[0]['inspection_by']] : '') ) ?> 
                <?php } ?>
                <br>
                <b>______________</b>
              </td>
              <td style="width: 25%; border: none;"><b></b>
              </td>
              <td style="width: 25%; border: none;">
              <?php if($sisa_pending_client <= 0){ ?>
                <?= isset($user_list[$joint_list[0]['client_inspection_by']]) ? $user_list[$joint_list[0]['client_inspection_by']] : null ?>
                <?php } ?>
                <br>
                <b>______________</b>
              </td>
              <td style="width: 25%; border: none;"><b></b>
              </td>
              <td style="width: 25%; border: none;">
                <br>
                <b>______________</b>
              </td>
            </tr><tr>
              <td style="width: 25%; border: none; padding-top: 10px;"><b>CONTRACTOR</b></td>
              <td style="width: 25%; border: none; padding-top: 10px;"><b></b></td>
              <td style="width: 25%; border: none; padding-top: 10px;"><b>EMPLOYER</b></td>
              <td style="width: 25%; border: none; padding-top: 10px;"><b></b></td>
              <td style="width: 25%; border: none; padding-top: 10px;"><b>THIRD PARTY <i>( If Any )</i></b></td>
            </tr><tr>
              <td style="width: 25%; border: none;">
              <?php if($sisa_pending_qc <= 0){ ?>
                    DATE :                 
                    <?= 
                      ($joint_list[0]['ticked_report_date'] == 1 ? 
                      (isset($joint_list[0]['document_approval_by']) ? date("d M Y",strtotime($max_array_date_document_approval))
                      : '') : 
                      (isset($joint_list[0]['inspection_by']) ? date("d M Y",strtotime($max_array_date_inspection)) 
                      : '') ) 
                    ?>  
                <?php } ?>
              </td>
              <td style="width: 25%; border: none;"></td>
              <td style="width: 25%; border: none;">
                <?php if($sisa_pending_client <= 0){ ?>
                DATE : <?= isset($joint_list[0]['client_inspection_by']) ? date("d M Y",strtotime($joint_list[0]['client_inspection_date'])) : ''; ?>
                <?php } ?>
              </td>
              <td style="width: 25%; border: none;"></td>
              <td style="width: 25%; border: none;">DATE : </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </div>
  <footer>
   SEA-QCF-FIR-001
	</footer>
</body></html>