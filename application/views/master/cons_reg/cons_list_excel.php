
<?php
   header("Content-type: application/vnd-ms-excel");
   header("Content-Disposition: attachment; filename=Welding_consumable_register.xls");
?>
        <table width='100%' border='1px'> 
        <tr>
              <th rowspan='2'>No</th>
              <th rowspan='2'>Project ID</th> 
              <th rowspan='2'>Welding Process</th>
              <th rowspan='2'>Brand Trade Name & Clasification</th>
              <th rowspan='2'>Manufacturer</th>
              <th rowspan='2'>Diameter Size (mm)</th>
              <th rowspan='2'>Batch Lot. No</th>  
              <th colspan='10'>WPS Used</th>  
            </tr> 
            <tr>
              <?php 
                for($i=1;$i<=10;$i++){
                  echo "<td style='width:100px !important;text-align:center !important;'>".$i."</td>";
                }
              ?>
            </tr> 
            <?php $no=1; foreach ($consumable_register as $key => $value): ?> 
              <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo @$project_name[$value["project_id"]] ?></td>
                <td><?php echo $value["welding_process"] ?></td>  
                <td><?php echo $value["brand_trade_name"] ?></td> 
                <td><?php echo $value["manufacture"] ?></td> 
                <td><?php echo $value["diameter_size"] ?></td> 
                <td><?php echo $value["batch_lot_number"] ?></td>

                <?php for($i=0;$i<=9;$i++){ ?>
                  <td style='width:100px !important;text-align:center !important;'><?php echo @$list_of_wps[$value['id_detail_register']][$i]; ?>  </td>  
                <?php } ?>  
              </tr>
            <?php $no++; endforeach; ?>
        </table> 
        
        <br/> 
        <br/>
        Download on Date : <?php echo date("Y-m-d H:i:s") ?>