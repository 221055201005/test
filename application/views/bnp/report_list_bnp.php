<div id="content" class="container-fluid">
 
   
  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white"> 
            <div class="overflow-auto"> 

                  <table class="table table-hover text-center" id="table_list" style="width:100%">
                    <thead class="bg-gray-table">
                      <tr>
                        <th rowspan='2'>No</th>
                        <th rowspan='2'>PAINTING RFI STATUS</th>
                        <?php foreach($arr_day as $key => $value){ ?>
                            <th colspan=2><?= $value ?></th>
                        <?php } ?> 
                      </tr>
                      <tr>
                       
                          <?php foreach($arr_day as $key => $value){ ?> 
                            <th><?= $sum_data[$value] ?></th>
                            <th>%</th>
                          <?php } ?> 
                      </tr>
                    </thead>
                    <tbody>
                        <tr> 
                          <td>1</td>
                          <td>Pending Submit To Client</td>
                            <?php foreach($arr_day as $key => $value){ ?>
                                <td><?= ($sum_data_outstanding[$value] > 0 ? $sum_data_outstanding[$value] : null) ?></td>
                                <td><?= ($sum_data[$value] > 0 && $sum_data_outstanding[$value] > 0 ? round(( $sum_data_outstanding[$value] /  $sum_data[$value]) * 100, 2) : null) ?></td>
                            <?php } ?> 
                        </tr>
                        <tr> 
                          <td>2</td>
                          <td>Submit To Client</td>
                            <?php foreach($arr_day as $key => $value){ ?>
                               
                                <td><?= ($sum_data_submited[$value] > 0 ? $sum_data_submited[$value] : null) ?></td>
                                <td><?= ($sum_data[$value] > 0 && $sum_data_submited[$value] > 0 ? round(( $sum_data_submited[$value] /  $sum_data[$value]) * 100, 2) : null) ?></td>
                            <?php } ?> 
                        </tr>
                        <tr> 
                          <td>3</td>
                          <td>Attachment Uploaded</td>
                            <?php foreach($arr_day as $key => $value){ ?>
                                <td><?= ($sum_data_completed[$value] > 0 ? $sum_data_completed[$value] : null) ?></td>
                                <td><?= ($sum_data[$value] > 0 && $sum_data_completed[$value] > 0 ? round(( $sum_data_completed[$value] /  $sum_data[$value]) * 100, 2) : null) ?></td>
                            <?php } ?> 
                        </tr>
                        
                    </tbody>
                  </table>  
              
            </div> 
        </div>
      </div>
    </div>
  </div> 

</div>
</div> 

<script>
  $("#table_list").DataTable({
    order: []
  })
</script>