<div id="content" class="container-fluid">



  <div class="row">
  <?php foreach($paint_system_list as $key => $value){ ?>
    <div class="col-md-4">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">Paint System - <?= $value ?></h6>
        </div>
        <div class="card-body bg-white overflow-auto">



                <table id="tbl_rfi_detail" class="table table-hover text-center" style="font-size:12px !important;">
                  <thead class="bg-info text-white">
                    <tr> 
                      <th rowspan="2">Code</th>
                      <th rowspan="2">Description Activity  - <?= $value ?></th>
                      <th rowspan="2">PMT %</th> 
                      <th colspan='2'>QC %</th> 
                    </tr>
                    <tr>
                      <th>RFI<br/>Issued</th>
                      <th>Attachment<br/>Completed</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php  foreach ($matrix_list as $key => $val_c) : ?>
                        <?php if($val_c["code"] == $value){ ?>
                        <tr> 
                            <td><?= $val_c["code_activity"] ?></td>
                            <td><?= $val_c["description_of_activity"] ?></td>
                            <td>
                                <?php 
                                    $total_all_wp = (isset($total_data_pmt_all[$val_c["id"]][$val_c["id_activity"]]) ? sizeof($total_data_pmt_all[$val_c["id"]][$val_c["id_activity"]]) : 0);
                                    $total_submited = (isset($total_data_pmt_submited[$val_c["id"]][$val_c["id_activity"]][1]) ? sizeof($total_data_pmt_submited[$val_c["id"]][$val_c["id_activity"]][1]) : 0);
                                    $total_unsubmited = (isset($total_data_pmt_submited[$val_c["id"]][$val_c["id_activity"]][0]) ? sizeof($total_data_pmt_submited[$val_c["id"]][$val_c["id_activity"]][0]) : 0);

                                    if($total_all_wp > 0){
                                        $percentage_pmt = round(( $total_submited / $total_all_wp ) * 100,2);
                                        echo "<a href='".base_url()."planning_bnp/home_detail/".strtr($this->encryption->encrypt($val_c["id"]), '+=/', '.-~')."/".strtr($this->encryption->encrypt($val_c["id_activity"]), '+=/', '.-~')."/".strtr($this->encryption->encrypt(1), '+=/', '.-~')."' target='_blank'>".$percentage_pmt."%</a>";
                                    } else {
                                        echo "-";
                                    } 
                               ?>
                            </td> 
                            <td> 
                                <?php
                                    if($total_all_wp > 0){
                                        $total_pmt_submited = $total_submited;
                                        $total_RFI_issued   = (isset($total_data_rfi_issued[$val_c["id"]][$val_c["id_activity"]][1]) ? sizeof($total_data_rfi_issued[$val_c["id"]][$val_c["id_activity"]][1]) : 0);

                                        if($total_pmt_submited > 0){
                                            $percentage_issued_rfi = round(( $total_RFI_issued / $total_all_wp ) * 100,2);
                                            // echo "<a href='".base_url()."planning_bnp/home_detail/".strtr($this->encryption->encrypt($val_c["id"]), '+=/', '.-~')."/".strtr($this->encryption->encrypt($val_c["id_activity"]), '+=/', '.-~')."/".strtr($this->encryption->encrypt(2), '+=/', '.-~')."' target='_blank'>".$percentage_issued_rfi."%</a>";
                                            echo  $percentage_issued_rfi."%";
                                        } else {
                                            echo "-";
                                        } 
                                    } else {
                                        $total_RFI_issued = 0;
                                        echo "-";
                                    }   
                                ?>

                            </td> 

                            <td> 
                                <?php
                                    if($total_all_wp > 0){
                                        $total_RFI_issued = $total_RFI_issued;
                                        $total_attchment_completed   = (isset($total_data_attachment_issued[$val_c["id"]][$val_c["id_activity"]][1]) ? sizeof($total_data_attachment_issued[$val_c["id"]][$val_c["id_activity"]][1]) : 0);
                                        if($total_pmt_submited > 0){
                                            $percentage_attchment_completed = round(( $total_attchment_completed / $total_all_wp ) * 100,2);
                                            echo $percentage_attchment_completed."%";
                                        } else {
                                            echo "-";
                                        } 
                                    } else {
                                        echo "-";
                                    }   
                                ?>

                            </td> 

                        </tr>
                        <?php } ?>
                    <?php   endforeach; ?>
                  </tbody>
                </table>

           
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
 

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

</script>