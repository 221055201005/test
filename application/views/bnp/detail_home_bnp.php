<style>

  #detail_card {
      font-size: 12px;
      font-weight: bold;
  }

.card-box {
    position: relative;
    color: #fff;
    padding: 1px 5px 2px;
    margin: 10px 0px;
    text-align: left;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
}

.card-box:hover {
    text-decoration: none;
    color: #f1f1f1;
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

.card-box:hover .icon i {
    font-size: 100px;
    transition: 1s;
    -webkit-transition: 1s;
}

.card-box .inner {
    padding: 5px 10px 0 10px;
}

.card-box h3 {
    font-size: 17px;
    font-weight: bold;
    margin: 0 0 1px 0;
    white-space: nowrap;
    padding: 0;
    text-align: left;
}

.card-box p {
    font-size: 11px;
}

.card-box .icon {
    position: absolute;
    top: auto;
    bottom: 5px;
    right: 5px;
    z-index: 0;
    font-size: 50px;
    color: rgba(0, 0, 0, 0.15);
}

.card-box .card-box-footer {
    position: absolute;
    left: 0px;
    bottom: 0px;
    text-align: center;
    padding: 3px 0;
    color: rgba(255, 255, 255, 0.8);
    background: rgba(0, 0, 0, 0.1);
    width: 100%;
    text-decoration: none;
}

.card-box:hover .card-box-footer {
    background: rgba(0, 0, 0, 0.3);
}

.bg-blue {
    background-color: #0031d1 !important;
}
.bg-green {
    background-color: #00a65a !important;
}
.bg-orange {
    background-color: #f39c12 !important;
}
.bg-red {
    background-color: #d9534f !important;
}
.bg-red-2 {
    background-color: #b80000 !important;
}
</style>
 

<div id="content" class="container-fluid"> 

    <?php if($categories == 1){ ?>
        
        <?php //test_var($total_data_pmt_submited[$paint_system][$activity]); ?>

        


            <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow">
                    <div class="card-header">
                        <h6 class="card-title m-0">PMT - Submission List</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive overflow-auto"> 
 
                                    <div class="col-6">
                                        <div class="form-group row">                  
                                        <div class="col-xl">     
                                            <div class="container  text-right">
                                            <div class="row">                                                    
                                                    <div class="col-lg-12">
                                                        <div class="card-box bg-blue">
                                                        <div class="inner">
                                                            <h3><span id='title_1'>Paint System : </span></h3>
                                                            <span id='detail_card'><?php echo $matrix_list["code"] ; ?></span>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-lg-12">
                                                        <div class="card-box bg-blue">
                                                        <div class="inner">
                                                            <h3><span id='title_2'>Activity Description :</span></h3>
                                                            <span id='detail_card'><?php echo $matrix_list["description_of_activity"] ; ?></span>
                                                        </div>
                                                        </div>
                                                    </div>                                                                          
                                                </div>
                                                <div class="row">                                                    
                                                    <div class="col-lg-3">
                                                        <div class="card-box bg-green">
                                                        <div class="inner">
                                                            <h3><span id='total_approved'><?= (isset($total_data_pmt_submited[$paint_system][$activity][1]) ? sizeof($total_data_pmt_submited[$paint_system][$activity][1]) : 0) ?> Part ID</span></h3>
                                                            <span id='detail_card'>PMT Submited</span>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-lg-3">
                                                        <div class="card-box bg-red-2">
                                                        <div class="inner">
                                                            <h3><span id='total_outstanding'><?= (isset($total_data_pmt_submited[$paint_system][$activity][0]) ? sizeof($total_data_pmt_submited[$paint_system][$activity][0]) : 0) ?> Part ID</span></h3>
                                                            <span id='detail_card'>PMT Outstanding</span>
                                                        </div>
                                                        </div>
                                                    </div> 
                                                    <div class="col-lg-3">
                                                        <div class="card-box bg-orange">
                                                        <div class="inner">
                                                                <?php 
                                                                        $total_all_wp = (isset($total_data_pmt_all[$paint_system][$activity]) ? sizeof($total_data_pmt_all[$paint_system][$activity]) : 0);
                                                                        $total_submited = (isset($total_data_pmt_submited[$paint_system][$activity][1]) ? sizeof($total_data_pmt_submited[$paint_system][$activity][1]) : 0); 

                                                                        if($total_all_wp > 0){
                                                                            $percentage_pmt = round(( $total_submited / $total_all_wp ) * 100,2);
                                                                        } else {
                                                                            $percentage_pmt ="-";
                                                                        } 
                                                                ?>
                                                            <h3><span id='KPI_PErcent'><?= $percentage_pmt ?> %</span></h3>
                                                            <span id='detail_card'>Progress PMT In %</span>
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
                    </div>
                </div>
            </div>
        </div>
         <br/>  

        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow">
                    <div class="card-header">
                        <h6 class="card-title m-0">PMT - Submission List</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive overflow-auto"> 

                                    <table class="table table-hover text-center" id="table_list" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th rowspan='2'>Workpack No</th>
                                                <th rowspan='2'>IRN No</th>
                                                <th rowspan='2'>Project</th>
                                                <th rowspan='2'>Drawing GA</th>
                                                <th rowspan='2'>Drawing AS</th>
                                                <th rowspan='2'>Drawing SP</th>
                                                <th rowspan='2'>Paint System</th>
                                                <th rowspan='2'>Activity Description</th>
                                                <th rowspan='2'>Tag Number</th>
                                                <th colspan='9'>Material Traceability</th>
                                            </tr>
                                            <tr>
                                                <th>Piecemark No</th>
                                                <th>Uniue No</th>
                                                <th>Profile</th>
                                                <th>Size / Dia</th>
                                                <th>Length</th>
                                                <th>Area (M2)</th>
                                                <th>Thk</th>
                                                <th>Material Status</th>
                                                <th>Submition Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(isset($total_data_pmt_submited[$paint_system][$activity][1])){ ?>

                                                <?php foreach($total_data_pmt_submited[$paint_system][$activity][1] as $key => $value){ 
                                                    
                                                    $link_irn                 = "#";
                                                    $encrypt_irn_submission   = strtr($this->encryption->encrypt($irn[$workpack_detail[$value["id_workpack"]]["irn_report_no"]]['submission_id']), '+=/', '.-~');
                        
                                                    if ($workpack_detail[$value["id_workpack"]]['categories_irn'] == 1) {
                                                    $link_irn               = site_url('irn/show_irn_detail_material/' . $encrypt_irn_submission);
                                                    } else {
                                                    $link_irn               = site_url('irn/show_irn_detail/' . $encrypt_irn_submission);
                                                    }
                        
                                                    $project_id               = strtr($this->encryption->encrypt($piecemark_detail[$value['id_template']]['project_code']), '+=/', '.-~');
                                                    $discipline               = strtr($this->encryption->encrypt($piecemark_detail[$value['id_template']]['discipline']), '+=/', '.-~');
                                                    $type_of_module           = strtr($this->encryption->encrypt($piecemark_detail[$value['id_template']]['type_of_module']), '+=/', '.-~');
                                                    $module                   = strtr($this->encryption->encrypt($piecemark_detail[$value['id_template']]['module']), '+=/', '.-~');
                                                    $report_no                = strtr($this->encryption->encrypt($piecemark_detail[$value['id_template']]['report_number']), '+=/', '.-~');
                                                    $report_no_rev            = strtr($this->encryption->encrypt($piecemark_detail[$value['id_template']]['report_no_rev']), '+=/', '.-~');
                                                    $submission_id            = strtr($this->encryption->encrypt($piecemark_detail[$value['id_template']]['submission_id']), '+=/', '.-~');

                                                    if (isset($piecemark_detail[$value['id_template']]['status_inspection'])) {
                                                        if ($piecemark_detail[$value['id_template']]['status_inspection'] >= 3) {
                                                        if (isset($piecemark_detail[$value['id_template']]['report_number'])) {
                                                            $status_inspection_p1 = '<a target="_blank" href="' . base_url() . 'material_verification/material_verification_pdf_client/' . $project_id . '/' . $discipline . '/' . $type_of_module . '/' . $module . '/' . $report_no . '/' . $report_no_rev . '">COMPLETED</a>';
                                                        } else {
                                                            $status_inspection_p1 = '<a target="_blank" href="' . base_url() . 'material_verification/material_verification_pdf/' . $submission_id . '">COMPLETED</a>';
                                                        }
                                                        } else {
                                                        $status_inspection_p1 = 'OS';
                                                        }
                                                    } else {
                                                        $status_inspection_p1 = "-";
                                                    }

                                                    $unique_no              = $mis[$piecemark_detail[$value['id_template']]['id_mis']]['unique_no'];

                                                    $id_workpack_enc        = strtr($this->encryption->encrypt($value['id_workpack']), '+=/', '.-~');
                                                    $link_pdf_workpack      = site_url('planning/workpack_pdf_bnp/' . $id_workpack_enc);

                                                    if(isset($activity_eng[$piecemark_detail[$value["id_template"]]["drawing_ga"]]['id'])){
                                                        $links_atc_ga = base_url_ftp_eng()."production/open_atc/2/".strtr($this->encryption->encrypt($activity_eng[$piecemark_detail[$value["id_template"]]["drawing_ga"]]['id']), '+=/', '.-~');
                                                    } else {
                                                        $links_atc_ga = null;   
                                                    }
                                                    if(isset($activity_eng[$piecemark_detail[$value["id_template"]]["drawing_as"]]['id'])){
                                                        $links_atc_as = base_url_ftp_eng()."production/open_atc/2/".strtr($this->encryption->encrypt($activity_eng[$piecemark_detail[$value["id_template"]]["drawing_as"]]['id']), '+=/', '.-~');
                                                    } else {
                                                        $links_atc_as = null;   
                                                    }
                                                    if(isset($activity_eng[$piecemark_detail[$value["id_template"]]["drawing_sp"]]['id'])){
                                                        $links_atc_sp = base_url_ftp_eng()."production/open_atc/2/".strtr($this->encryption->encrypt($activity_eng[$piecemark_detail[$value["id_template"]]["drawing_sp"]]['id']), '+=/', '.-~');
                                                    } else {
                                                        $links_atc_sp = null;   
                                                    }
                                                    ?>     
                                                    <tr>
                                                        <td><a target="_blank" href="<?= $link_pdf_workpack ?>"><strong><i><?= $workpack_detail[$value["id_workpack"]]["workpack_no"] ?></i></strong></a></td>
                                                        <td><strong><i><a target="_blank" href="<?= $link_irn ?>">SOF-OCP-SMO-TS-STR-RFI-IRN-B&P-<?= $workpack_detail[$value["id_workpack"]]["irn_report_no"] ?></a></i></strong></td>
                                                        <td><?php echo $project_list[$workpack_detail[$value["id_workpack"]]["project"]]["project_name"]; ?></td>
                                                        <td><strong><i><a target="_blank" href="<?= $links_atc_ga ?>"><?php echo $piecemark_detail[$value["id_template"]]["drawing_ga"]; ?></a></i></strong></td>
                                                        <td><strong><i><a target="_blank" href="<?= $links_atc_as ?>"><?php echo $piecemark_detail[$value["id_template"]]["drawing_as"]; ?></a></i></strong></td>
                                                        <td><strong><i><a target="_blank" href="<?= $links_atc_sp ?>"><?php echo $piecemark_detail[$value["id_template"]]["drawing_sp"]; ?></a></i></strong></td>
                                                        <td><?php echo $matrix_list["code"] ; ?></td>
                                                        <td><?php echo $matrix_list["description_of_activity"] ; ?></td>
                                                        <td><?php echo $piecemark_detail[$value["id_template"]]["can_number"]; ?></td>
                                                        <td><?php echo $piecemark_detail[$value["id_template"]]["part_id"]; ?></td>
                                                        <td><?php echo $unique_no; ?></td>
                                                        <td><?php echo $piecemark_detail[$value["id_template"]]["profile"]; ?></td>
                                                        <td><?php echo $piecemark_detail[$value["id_template"]]["diameter"]; ?></td>
                                                        <td><?php echo $piecemark_detail[$value["id_template"]]["length"]; ?></td>
                                                        <td><?php echo $piecemark_detail[$value["id_template"]]["total_area"]; ?></td>
                                                        <td><?php echo $piecemark_detail[$value["id_template"]]["thickness"]; ?></td>
                                                        <td><strong><i><?php echo $status_inspection_p1; ?></i></strong></td>
                                                        <td>
                                                            <?php if($value["status_submited_bp"] == 1){ ?>
                                                            <span class="badge badge-success badge-pill">Submited</span>
                                                            <?php } else if($value["status_submited_bp"] == 0){ ?>
                                                            <span class="badge badge-danger badge-pill">OutStanding</span> 
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?> 
                                            <?php } else { ?> 
                                                <tr>
                                                    <td colspan='18'><i>Data not Available</i></td>
                                                </tr>
                                            <?php } ?>    
                                        <tbody>
                                    </table> 

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <br/>                                       
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow">
                    <div class="card-header">
                        <h6 class="card-title m-0">PMT - Outstanding List</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive overflow-auto"> 

                                    <table class="table table-hover text-center" id="table_list_outstanding" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th rowspan='2'>Workpack No</th>
                                                <th rowspan='2'>IRN No</th>
                                                <th rowspan='2'>Project</th>
                                                <th rowspan='2'>Drawing GA</th>
                                                <th rowspan='2'>Drawing AS</th>
                                                <th rowspan='2'>Drawing SP</th>
                                                <th rowspan='2'>Paint System</th>
                                                <th rowspan='2'>Activity Description</th>
                                                <th rowspan='2'>Tag Number</th>
                                                <th colspan='9'>Material Traceability</th>
                                            </tr>
                                            <tr>
                                                <th>Piecemark No</th>
                                                <th>Uniue No</th>
                                                <th>Profile</th>
                                                <th>Size / Dia</th>
                                                <th>Length</th>
                                                <th>Area (M2)</th>
                                                <th>Thk</th>
                                                <th>Material Status</th>
                                                <th>Submition Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(isset($total_data_pmt_submited[$paint_system][$activity][0])){ ?>

                                                <?php foreach($total_data_pmt_submited[$paint_system][$activity][0] as $key => $value){ 
                                                    
                                                    $link_irn                 = "#";
                                                    $encrypt_irn_submission   = strtr($this->encryption->encrypt($irn[$workpack_detail[$value["id_workpack"]]["irn_report_no"]]['submission_id']), '+=/', '.-~');
                        
                                                    if ($workpack_detail[$value["id_workpack"]]['categories_irn'] == 1) {
                                                    $link_irn               = site_url('irn/show_irn_detail_material/' . $encrypt_irn_submission);
                                                    } else {
                                                    $link_irn               = site_url('irn/show_irn_detail/' . $encrypt_irn_submission);
                                                    }
                        
                                                    $project_id               = strtr($this->encryption->encrypt($piecemark_detail[$value['id_template']]['project_code']), '+=/', '.-~');
                                                    $discipline               = strtr($this->encryption->encrypt($piecemark_detail[$value['id_template']]['discipline']), '+=/', '.-~');
                                                    $type_of_module           = strtr($this->encryption->encrypt($piecemark_detail[$value['id_template']]['type_of_module']), '+=/', '.-~');
                                                    $module                   = strtr($this->encryption->encrypt($piecemark_detail[$value['id_template']]['module']), '+=/', '.-~');
                                                    $report_no                = strtr($this->encryption->encrypt($piecemark_detail[$value['id_template']]['report_number']), '+=/', '.-~');
                                                    $report_no_rev            = strtr($this->encryption->encrypt($piecemark_detail[$value['id_template']]['report_no_rev']), '+=/', '.-~');
                                                    $submission_id            = strtr($this->encryption->encrypt($piecemark_detail[$value['id_template']]['submission_id']), '+=/', '.-~');

                                                    if (isset($piecemark_detail[$value['id_template']]['status_inspection'])) {
                                                        if ($piecemark_detail[$value['id_template']]['status_inspection'] >= 3) {
                                                        if (isset($piecemark_detail[$value['id_template']]['report_number'])) {
                                                            $status_inspection_p1 = '<a target="_blank" href="' . base_url() . 'material_verification/material_verification_pdf_client/' . $project_id . '/' . $discipline . '/' . $type_of_module . '/' . $module . '/' . $report_no . '/' . $report_no_rev . '">COMPLETED</a>';
                                                        } else {
                                                            $status_inspection_p1 = '<a target="_blank" href="' . base_url() . 'material_verification/material_verification_pdf/' . $submission_id . '">COMPLETED</a>';
                                                        }
                                                        } else {
                                                        $status_inspection_p1 = 'OS';
                                                        }
                                                    } else {
                                                        $status_inspection_p1 = "-";
                                                    }

                                                    $unique_no              = $mis[$piecemark_detail[$value['id_template']]['id_mis']]['unique_no'];

                                                    $id_workpack_enc        = strtr($this->encryption->encrypt($value['id_workpack']), '+=/', '.-~');
                                                    $link_pdf_workpack      = site_url('planning/workpack_pdf_bnp/' . $id_workpack_enc);

                                                    if(isset($activity_eng[$piecemark_detail[$value["id_template"]]["drawing_ga"]]['id'])){
                                                        $links_atc_ga = base_url_ftp_eng()."production/open_atc/2/".strtr($this->encryption->encrypt($activity_eng[$piecemark_detail[$value["id_template"]]["drawing_ga"]]['id']), '+=/', '.-~');
                                                    } else {
                                                        $links_atc_ga = null;   
                                                    }
                                                    if(isset($activity_eng[$piecemark_detail[$value["id_template"]]["drawing_as"]]['id'])){
                                                        $links_atc_as = base_url_ftp_eng()."production/open_atc/2/".strtr($this->encryption->encrypt($activity_eng[$piecemark_detail[$value["id_template"]]["drawing_as"]]['id']), '+=/', '.-~');
                                                    } else {
                                                        $links_atc_as = null;   
                                                    }
                                                    if(isset($activity_eng[$piecemark_detail[$value["id_template"]]["drawing_sp"]]['id'])){
                                                        $links_atc_sp = base_url_ftp_eng()."production/open_atc/2/".strtr($this->encryption->encrypt($activity_eng[$piecemark_detail[$value["id_template"]]["drawing_sp"]]['id']), '+=/', '.-~');
                                                    } else {
                                                        $links_atc_sp = null;   
                                                    }
                                                    ?>     
                                                    <tr>
                                                        <td><a target="_blank" href="<?= $link_pdf_workpack ?>"><strong><i><?= $workpack_detail[$value["id_workpack"]]["workpack_no"] ?></i></strong></a></td>
                                                        <td><strong><i><a target="_blank" href="<?= $link_irn ?>">SOF-OCP-SMO-TS-STR-RFI-IRN-B&P-<?= $workpack_detail[$value["id_workpack"]]["irn_report_no"] ?></a></i></strong></td>
                                                        <td><?php echo $project_list[$workpack_detail[$value["id_workpack"]]["project"]]["project_name"]; ?></td>
                                                        <td><strong><i><a target="_blank" href="<?= $links_atc_ga ?>"><?php echo $piecemark_detail[$value["id_template"]]["drawing_ga"]; ?></a></i></strong></td>
                                                        <td><strong><i><a target="_blank" href="<?= $links_atc_as ?>"><?php echo $piecemark_detail[$value["id_template"]]["drawing_as"]; ?></a></i></strong></td>
                                                        <td><strong><i><a target="_blank" href="<?= $links_atc_sp ?>"><?php echo $piecemark_detail[$value["id_template"]]["drawing_sp"]; ?></a></i></strong></td>
                                                        <td><?php echo $matrix_list["code"] ; ?></td>
                                                        <td><?php echo $matrix_list["description_of_activity"] ; ?></td>
                                                        <td><?php echo $piecemark_detail[$value["id_template"]]["can_number"]; ?></td>
                                                        <td><?php echo $piecemark_detail[$value["id_template"]]["part_id"]; ?></td>
                                                        <td><?php echo $unique_no; ?></td>
                                                        <td><?php echo $piecemark_detail[$value["id_template"]]["profile"]; ?></td>
                                                        <td><?php echo $piecemark_detail[$value["id_template"]]["diameter"]; ?></td>
                                                        <td><?php echo $piecemark_detail[$value["id_template"]]["length"]; ?></td>
                                                        <td><?php echo $piecemark_detail[$value["id_template"]]["total_area"]; ?></td>
                                                        <td><?php echo $piecemark_detail[$value["id_template"]]["thickness"]; ?></td>
                                                        <td><strong><i><?php echo $status_inspection_p1; ?></i></strong></td>
                                                        <td>
                                                            <?php if($value["status_submited_bp"] == 1){ ?>
                                                            <span class="badge badge-success badge-pill">Submited</span>
                                                            <?php } else if($value["status_submited_bp"] == 0){ ?>
                                                            <span class="badge badge-danger badge-pill">OutStanding</span> 
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?> 
                                            <?php } else { ?> 
                                                <tr>
                                                    <td colspan='18'><i>Data not Available</i></td>
                                                </tr>
                                            <?php } ?>    
                                        <tbody>
                                    </table> 

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>       
    </div> 
    <?php } else if($categories == 2){ ?>
         
    <?php } else  if($categories == 3){ ?>
        <div class="row">
        
        </div>
    <?php } ?>

</div>
</div> 

<script type='text/javascript'>
    
  $('.dataTable').DataTable({
    order: [],
    columnDefs: [{
      "targets": 0,
      "orderable": false,
    }]
  })

  $("#table_list").DataTable({
    order: []
  })

  $("#table_list_outstanding").DataTable({
    order: []
  })

</script>