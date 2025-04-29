<?php
$status_internal_list = [
  "Internal" => 1,
  "External" => 0,
];
$is_itr_list = [
  "Yes" => 1,
  "No" => 0,
];
//   test_var($sheet);
?>
<div id="content" class="container-fluid">

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white">
          <h6 class="font-weight-bold text-info"><i class="fas fa-info-circle"></i> Drag the header to expand column.</h6>
          <form method="POST" action="<?php echo base_url() ?>master/wps/import_wps_register_process">
            <div class="overflow-auto">
              <table class="table table-hover text-center dataTable">
                <thead class="bg-green-smoe text-white text-nowrap">
                  <tr>
                    <th>WPS No </th>
                    <th>WPS Company </th>
                    <th>WPS Project </th>
                    <th>WPS Revision </th>
                    <th>Discipline </th>
                    <th>Process </th>
                    <th>Material Grade </th>
                    <th>Thickness Range (mm) </th>
                    <th>Diameter Range (mm) </th>
                    <th>Type of Joint </th>
                    <th>Remarks </th>
                    <th>WPS Status </th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($sheet as $key => $value) :
                    if ($key > 1 && $value['A'] != "") :
                      $status = "";
                      if(($value['A'] != '' && in_array($value['A'], $existing_wps))){
                        $status = "Duplicate WPS No";
                      }
                      if (!isset($company_list[$this->encryption->decrypt(strtr($value['B'], '.-~', '+=/'))])) {
                        $status = "Company Not Found!";
                      }
                      if (!isset($project_list[$value['C']])) {
                        $status = "Project Not Found!";
                      }
                      if (!isset($discipline_list[$value['E']])) {
                        $status = "Discipline Not Found!";
                      }
                      if (!isset($welder_process_list[$this->encryption->decrypt(strtr($value['F'], '.-~', '+=/'))])) {
                        $status = "Process Not Found!";
                      }
                      if (!isset($material_grade_list[$value['G']])) {
                        $status = "Material Grade Not Found!";
                      }
                      if (!isset($joint_type_list[$value['J']])) {
                        $status = "Type of Joint Not Found!";
                      }
                  ?>
                      <tr style="background: <?php echo ($status != "" ? "#f8d7da" : "") ?>">
                        <td>
                          <input type="text" class="form-control" value="<?php echo $value['A'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="wps_no[]">
                        </td>
                        <td>
                          <input type="text" class="form-control" value="<?php echo $this->encryption->decrypt(strtr($value['B'], '.-~', '+=/')) ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                          <input type="hidden" class="form-control" value="<?php echo @$company_list[$this->encryption->decrypt(strtr($value['B'], '.-~', '+=/'))]['id_company'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="company[]">
                        </td>
                        <td>
                          <input type="text" class="form-control" value="<?php echo $value['C'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                          <input type="hidden" class="form-control" value="<?php echo @$project_list[$value['C']]['id'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="project[]">
                        </td>
                        <td>
                          <input type="text" class="form-control" value="<?php echo $value['D'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="wps_revision[]">
                        </td>
                        <td>
                          <input type="text" class="form-control" value="<?php echo $value['E'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                          <input type="hidden" class="form-control" value="<?php echo @$discipline_list[$value['E']]['id'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="discipline[]">
                        </td>
                        <td>
                          <input type="text" class="form-control" value="<?php echo $this->encryption->decrypt(strtr($value['F'], '.-~', '+=/')) ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                          <input type="hidden" class="form-control" value="<?php echo @$welder_process_list[$this->encryption->decrypt(strtr($value['F'], '.-~', '+=/'))]['id'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="process[]">
                        </td>
                        <td>
                          <input type="text" class="form-control" value="<?php echo $value['G'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                          <input type="hidden" class="form-control" value="<?php echo @$material_grade_list[$value['G']]['id'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="material_grade[]">
                        </td>
                        <td><input type="text" class="form-control" value="<?php echo $value['H'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="thickness_range[]"></td>
                        <td><input type="text" class="form-control" value="<?php echo $value['I'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="diameter_range[]"></td>
                        <td>
                          <input type="text" class="form-control" value="<?php echo $value['J'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                          <input type="hidden" class="form-control" value="<?php echo @$joint_type_list[$value['J']]['id'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="type_of_joint[]">
                        </td>
                        <td><input type="text" class="form-control" value="<?php echo $value['K'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="remarks[]"></td>
                        <td>
                          <input type="text" class="form-control" value=
                          "<?php
                              if ($value['L'] == 1) {
                                  echo "Actived";
                              } else {
                                  echo "Non-Actived";
                              }
                          ?>" 
                          <?php echo ($status != "" ? "disabled" : "readonly") ?> name="wps_status[]">
                        </td>
                        </td>
                        <td class="font-weight-bold"><?php echo $status ?></td>
                      </tr>
                  <?php
                    endif;
                  endforeach;
                  ?>
                </tbody>
              </table>
            </div>
            <br>
            <div class="row">
              <div class="col-12 text-right">
                <button class="mt-2 btn btn-sm btn-flat btn-success"><i class="fas fa-check"></i> Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>