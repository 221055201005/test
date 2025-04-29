<div id="content" class="container-fluid"> 
  <div class="row"> 
    <div class="col-md-6">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">IRN - JOINT STATUS</h6>
        </div>
        <div class="card-body bg-white overflow-auto"> 
                <table id="tbl_rfi_detail" class="table table-hover text-center" style="font-size:12px !important;">
                  <thead class="bg-info text-white">
                    <tr>
                        <th>Deck Elevation / Service Line</th>
                        <th>Approved By Client</th>
                        <th>Approved With Comment</th>
                        <th>Pending By Client</th>
                        <th>Approved By QC</th>
                        <th>Pending QC SMOE</th>
                        <th>Cancel Released</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($deck_list as $key => $value){ ?>
                        <tr>
                            <td><?php echo $value['name'] ?></td>
                            <td><?php echo (isset($show_data_joint[$value['id']]["approved_by_client_joint"]) ? $show_data_joint[$value['id']]["approved_by_client_joint"] : 0)  ?></td>
                            <td><?php echo (isset($show_data_joint[$value['id']]["approved_with_comment_joint"]) ? $show_data_joint[$value['id']]["approved_with_comment_joint"] : 0) ?></td>
                            <td><?php echo (isset($show_data_joint[$value['id']]["pending_by_client_joint"]) ? $show_data_joint[$value['id']]["pending_by_client_joint"] : 0) ?></td>
                            <td><?php echo (isset($show_data_joint[$value['id']]["approved_by_qc_joint"]) ? $show_data_joint[$value['id']]["approved_by_qc_joint"] : 0) ?></td>
                            <td><?php echo (isset($show_data_joint[$value['id']]["pending_qc_smoe_joint"]) ? $show_data_joint[$value['id']]["pending_qc_smoe_joint"] : 0) ?></td>
                            <td><?php echo "-" ?></td>
                        </tr>
                    <?php  } ?>
                  </tbody>                    
                </table> 
        </div>
      </div>
    </div> 
    <div class="col-md-6">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">IRN - MATERIAL STATUS</h6>
        </div>
        <div class="card-body bg-white overflow-auto"> 
                <table id="tbl_rfi_detail" class="table table-hover text-center" style="font-size:12px !important;">
                  <thead class="bg-info text-white">
                    <tr> 
                        <th>Approved By Client</th>
                        <th>Approved With Comment</th>
                        <th>Pending By Client</th>
                        <th>Approved By QC</th>
                        <th>Pending QC SMOE</th>
                        <th>Cancel Released</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($data_material as $key => $value){ ?>
                        <tr> 
                            <td><?php echo $value['approved_by_client_material'] ?></td>
                            <td><?php echo $value['approved_with_comment_material'] ?></td>
                            <td><?php echo $value['pending_by_client_material'] ?></td>
                            <td><?php echo $value['approved_by_qc_material'] ?></td>
                            <td><?php echo $value['pending_qc_smoe_material'] ?></td> 
                            <td><?php echo "-" ?></td>
                        </tr>
                    <?php  } ?>
                  </tbody>                    
                </table>  
        </div>
      </div>
    </div> 
  </div>

  <div class="row"> 
    <div class="col-md-6">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">IRN - JOINT STATUS</h6>
        </div>
        <div class="card-body bg-white overflow-auto"> 
            <div class="chart-wrapper mx-auto" style="height:30vh; position:relative">
                <div id="container_1" style="height: 100%; width: 100%;">
                <div class="text-center loading mt-4">
                    <div class="spinner-border" role="status"></div>
                </div>
                </div>
            </div>
        </div>
      </div>
    </div> 
    <div class="col-md-6">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">IRN - MATERIAL STATUS</h6>
        </div>
        <div class="card-body bg-white overflow-auto"> 
            <div class="chart-wrapper mx-auto" style="height:30vh; position:relative">
                <div id="container_2" style="height: 100%; width: 100%;">
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

<script type='text/javascript'>
    
  $('.dataTable').DataTable({
    order: [],
    columnDefs: [{
      "targets": 0,
      "orderable": false,
    }]
  })

  Highcharts.chart('container_1', {
    title: {
        text: 'IRN - Joint Status'
    },
    xAxis: {
        categories: [
             "Approved By Client","Approved With Comment","Pending By Client","Approved By QC","Pending QC SMOE", "Cancel Released"
        ]
    },
    plotOptions: {
        column: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [
        <?php foreach($deck_list as $key => $value){ ?>
        {
            type: 'column',
            name: '<?php echo $value['name']; ?>',
            data: [
                <?= (isset($show_data_joint[$value['id']]["approved_by_client_joint"]) ? $show_data_joint[$value['id']]["approved_by_client_joint"] : 0) ?>,
                <?= (isset($show_data_joint[$value['id']]["approved_with_comment_joint"]) ? $show_data_joint[$value['id']]["approved_with_comment_joint"] : 0) ?>,
                <?= (isset($show_data_joint[$value['id']]["pending_by_client_joint"]) ? $show_data_joint[$value['id']]["pending_by_client_joint"] : 0) ?>,
                <?= (isset($show_data_joint[$value['id']]["approved_by_qc_joint"]) ? $show_data_joint[$value['id']]["approved_by_qc_joint"] : 0) ?>,
                <?= (isset($show_data_joint[$value['id']]["pending_qc_smoe_joint"]) ? $show_data_joint[$value['id']]["pending_qc_smoe_joint"] : 0) ?>,
               0,
            ]
        }, 
        <?php } ?>
]
});


Highcharts.chart('container_2', {
    title: {
        text: 'IRN - Piecemark Status'
    },
    xAxis: {
        categories: [
             "Approved By Client","Approved With Comment","Pending By Client","Approved By QC","Pending QC SMOE", "Cancel Released"
        ]
    },
    plotOptions: {
        column: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
     
    series: [
        <?php foreach($data_material as $key => $value){ ?>
        {
        type: 'column',
        name: 'IRN Piecemark Status',
        data: [
            <?php echo $value['approved_by_client_material'] ?>, 
            <?php echo $value['approved_with_comment_material'] ?>, 
            <?php echo $value['pending_by_client_material'] ?>, 
            <?php echo $value['approved_by_qc_material'] ?>, 
            <?php echo $value['pending_qc_smoe_material'] ?>, 
            0, 
        ]
        } 
        <?php } ?>
    ]
});



</script>