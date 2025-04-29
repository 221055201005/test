<?php 
    $current_date = date("Y-m-d H:i:s");
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Fitter_$current_date.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    error_reporting(0);
?>
          <table border='1px'>          
            <tr>
              <th><b>No</b></th>
              <th><b>Company</b></th>
              <th><b>Project</b></th>
              <th><b>Type Of Module</b></th>
              <th><b>Fitter Badge</b></th>
              <th><b>Fitter Fullname</b></th>
              <th><b>Validation Start Date</b></th>
              <th><b>Validation End Date</b></th>
              <th><b>Fitter Status</b></th> 
              <th><b>Latest Update</b></th>
              <th><b>Latest Date</b></th>
            </tr>
            <?php $no=1; foreach ($fitter_list as $key => $value): ?>
              <tr>
                <td><?php echo $no ?></td>
                <td><?= (isset($value["company"]) ? @$company_name[$value["company"]] : "-") ?></td>
                <td><?= (isset($value["project"]) ? @$project_code[$value["project"]] : "-") ?></td>
                <td><?= (isset($value["module"]) ? @$type_of_module_code[$value["module"]] : "-") ?></td>
                <td><?php echo $value["fit_up_badge"] ?></td>
                <td><?php echo $value["fitup_name"] ?></td>
                <td><?php echo $value["vsd"] ?></td>
                <td><?php echo $value["ved"] ?></td>
                <td>
                  <?php if($value["status"] == 1): ?>
                    Actived
                  <?php else: ?>
                    Non-Actived
                  <?php endif; ?>
                </td>
                <td>
                  <?php if(isset($value['update_by'])){ ?>
                    <?= @$user_list[$value['update_by']] ?>
                  <?php } else { ?>
                    <?= "-" ?>
                  <?php } ?>
                </td>
                <td><?= $value['update_date'] ?></td>
              </tr>

            <?php $no++;  endforeach; ?>
        </table>
        <br/>
        <b>PCMS Fitter Register - Download Date : <?php echo date("d-F-Y H:i:s"); ?></b>