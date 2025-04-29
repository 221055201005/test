<?php 
  error_reporting(0);
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=Export_RFI_Register_".date('YmdHis').".xls");
  header("Pragma: no-cache");
  header("Expires: 0");
?>

<table border="1" style="width: 100%; border-collapse: collapse;">
  <thead>
    <tr>
      <th style="background-color: #4c874f; color: white;">Project</th>
      <th style="background-color: #4c874f; color: white;">Category</th>
      <th style="background-color: #4c874f; color: white;">Discipline</th>
      <th style="background-color: #4c874f; color: white;">Document Ref</th>
      <th style="background-color: #4c874f; color: white;">RFI No.</th>
      <th style="background-color: #4c874f; color: white;">Type of Inspection</th>
      <th style="background-color: #4c874f; color: white;">Item/Tag Number</th>
      <th style="background-color: #4c874f; color: white;">Item/Tag Description</th>
      <th style="background-color: #4c874f; color: white;">Inspection Date</th>
      <th style="background-color: #4c874f; color: white;">Contractor</th>
      <th style="background-color: #4c874f; color: white;">Location</th>
      <th style="background-color: #4c874f; color: white;">Result</th>
      <th style="background-color: #4c874f; color: white;">Remarks</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($rfi_list as $key => $value): ?>
    <tr>
      <td style="text-align: center;"><?php echo @$project_list[$value["project"]]['project_name'] ?></td>
      <td style="text-align: center;"><?php echo $value["category"] ?></td>
      <td style="text-align: center;"><?php echo @$discipline_list[$value["discipline"]]['discipline_name'] ?></td>
      <td style="text-align: center;"><?php echo $value["document_ref"] ?></td>
      <td style="text-align: center;"><?php echo $value["rfi_no"] ?></td>
      <td style="text-align: center;"><?php echo $value["type_of_inspection"] ?></td>
      <td style="text-align: center;"><?php echo $value["tag_no"] ?></td>
      <td style="text-align: center;"><?php echo $value["tag_description"] ?></td>
      <td style="text-align: center;"><?php echo $value["inspection_date"] ?></td>
      <td style="text-align: center;"><?php echo $value["contractor"] ?></td>            
      <td style="text-align: center;"><?php echo $value["location"] ?></td> 
      <td style="text-align: center;"><?php echo $value["result"] ?></td>     
      <td><?php echo $value["remarks"] ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
 
</table>