<?php
$status_internal_list = [
  "Internal" => 1,
  "External" => 0,
];
$is_itr_list = [
  "Yes" => 1,
  "No" => 0,
];
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
          <form method="POST" action="<?php echo base_url() ?>engineering/import_piecemark_process">
            <div class="overflow-auto">
              <table class="table table-hover text-center dataTable">
                <thead class="bg-green-smoe text-white text-nowrap">
                  <tr>
                    <th>Project</th>
                    <th>Module </th>
                    <th>Type Of Module</th>
                    <th>Discipline </th>
                    <th>Deck Elevation / Service Line</th>

                    <th>Desc. Assembly</th>

                    <th>Drawing GA</th>
                    <th>Rev GA</th>
                    <th>Drawing AS</th>
                    <th>Rev AS</th>
                    <th>Drawing SP</th>
                    <th>Rev SP</th>
                    <th>Part ID As</th>
                    <th>Reference POS</th>
                    <th>Cutting Plan</th>
                    <th>Rev CP</th>
                    <th>Cutting List</th>
                    <th>Rev CL</th>
                    <th>Profile</th>
                    <th>Material</th>
                    <th>Grade</th>
                    <th>Diameter</th>
                    <th>Thickness</th>
                    <th>Schedule</th>
                    <th>Length (mm)</th>
                    <th>Height</th>
                    <th>Width</th>
                    <th>Weight (kg)</th>
                    <th>Area (m<sup>2</sup>)</th>
                    <th>Can Number</th>
                    <th>Test Pack Number</th>
                    <th>Remarks</th>
                    <th>Item Code (Piping Material)</th>
                    <th>Spool No</th>
                    <th>Beam/Channel (Thk)</th>
                    <th>Strain Age Test (D/T)</th>
                    <th>Strain Age Test (Yes/No)</th>
                    <th>Through Thickness</th>
                    <th>Status Internal</th>
                    <th>Is ITR</th>
                    <th>Piping Testing Category</th>
                    <th>Company</th>
                    <th>MV Request Date</th>
                    <th>Unique No Material</th>
                    <th>Inspect By</th>
                    <th>Inspection Date</th>
                    <th>Service Line</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $is_disabled = 0;
                  foreach ($sheet as $key => $value) :
                    
                    if ($key > 1 && $value['A'] != "") :
                      $value['AT'] = decrypt($value['AT']);
                      $value['F'] = decrypt($value['F']);
                      $value['AP'] = decrypt($value['AP']);
                      $status = "";
                      if (!isset($project_list[$value['A']])) {
                        $status = "Project Not Found!";
                      } elseif (!isset($module_list[$project_list[$value['A']]['id']][$value['B']])) {
                        $status = "Module Not Found!";
                      } elseif (!isset($type_of_module_list[$value['C']])) {
                        $status = "Type of Module Not Found!";
                      } elseif (!isset($discipline_list[$value['D']])) {
                        $status = "Discipline Not Found!";
                      } elseif (!isset($deck_elevation_list[$value['E']])) {
                        $status = "Deck Elevation / Service Line Not Found!";
                      } elseif (!isset($material_grade_list[$value['V']])) {
                        $status = "Material Grade Not Found!";
                      } elseif (!isset($status_internal_list[$value['AN']])) {
                        $status = "Status Internal Not Found!";
                      } elseif (!isset($is_itr_list[$value['AO']])) {
                        $status = "Is ITR Not Found!";
                      } elseif (!isset($company_list[$value['AQ']])) {
                        $status = "Company Not Found!";
                      } elseif (!isset($piping_testing_category_list[$value['AP']])) {
                        $status = "Is Piping Testing Category Not Found!";
                      } elseif (in_array($value['M'], $document_duplicate)) {
                        $status = "Duplicate Piecemark / Part ID!";
                      } elseif ($value['G'] == '' || ($value['G'] != '' && !in_array($value['G'], $existing_drawing))) {
                        $status = "Drawing GA not found!";
                      } elseif ($value['I'] != '' && !in_array($value['I'], $existing_drawing)) {
                        $status = "Drawing AS not found!";
                      } elseif ($value['K'] != '' && !in_array($value['K'], $existing_drawing)) {
                        $status = "Drawing SP not found!";
                      } elseif ($value['P'] != '' && !in_array($value['P'], $existing_drawing)) {
                        $status = "Drawing CP not found!";
                      } elseif ($value['R'] != '' && !in_array($value['R'], $existing_drawing)) {
                        $status = "Drawing CL not found!";
                      } elseif ($value['AT'] != '' && $value['AU'] == '') {
                        $status = "Inspection Date Cannot Be Empty!";
                      } elseif ($value['AU'] != '' && $value['AT'] == '') {
                        $status = "Inspection By Cannot Be Empty!";
                      } elseif ($value['AS'] != '' && $value['AR'] == '') {
                        $status = "Request Date Cannot Be Empty!";
                      } elseif ($value['AT'] != '' && $value['AS'] == '') {
                        $status = "Unique No Cannot Be Empty!";
                      } elseif (!isset($id_mis_det[$project_list[$value['A']]['id']][$value['AS']]) && $value['AT'] != '') {
                        $status = "Unique No Not Registered!";
                      } elseif (!isset($id_mis_det[$project_list[$value['A']]['id']][$value['AS']]) && $value['AS'] != '') {
                        $status = "Unique No Not Registered!";
                      } 
                      // elseif($value['AR'] == ''){
                      //   $status = "Request Date Cannot Be Empty!";
                      // }
                      $pos_list = explode(", ", $value['N']);
                      $id_pos_list = [];
                      if (count($pos_list) > 0 && $pos_list[0] != '') {
                        foreach ($pos_list as $pos) {
                          if (isset($piecemark_refrence_list[$pos])) {
                            $id_pos_list[] = $piecemark_refrence_list[$pos];
                          } else {
                            $status = $pos . " not found!";
                          }
                        }
                      }

                      if (!in_array($value['M'], $document_duplicate)) {
                        $document_duplicate[] = $value['M'];
                      }

                      if ($status != "") {
                        $is_disabled = 1;
                      }
                  ?>
                      <tr style="background: <?php echo ($status != "" ? "#f8d7da" : "") ?>">
                        <td>
                          <input type="text" class="form-control" value="<?php echo $value['A'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                          <input type="hidden" class="form-control" value="<?php echo @$project_list[$value['A']]['id'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="project[]">
                          <input type="hidden" class="form-control" value="<?php echo @$project_list[$value['A']]['project_code'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="project_code[]">
                        </td>
                        <td>
                          <input type="text" class="form-control" value="<?php echo $value['B'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                          <input type="hidden" class="form-control" value="<?php echo @$module_list[$project_list[$value['A']]['id']][$value['B']]['mod_id'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="module[]">
                        </td>
                        <td>
                          <input type="text" class="form-control" value="<?php echo $value['C'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                          <input type="hidden" class="form-control" value="<?php echo @$type_of_module_list[$value['C']]['id'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="type_of_module[]">
                        </td>
                        <td>
                          <input type="text" class="form-control" value="<?php echo $value['D'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                          <input type="hidden" class="form-control" value="<?php echo @$discipline_list[$value['D']]['id'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="discipline[]">
                        </td>
                        <td>
                          <input type="text" class="form-control" value="<?php echo $value['E'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                          <input type="hidden" class="form-control" value="<?php echo @$deck_elevation_list[$value['E']]['id'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="deck_elevation[]">
                        </td>

                        <td>
                          <input type="hidden" class="form-control" value="<?php echo $value['F'] + 0 ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="desc_assy[]">
                          <input type="text" class="form-control" value="<?php echo @$desc_assy_list[$value['F']]['code'] . ' - ' . @$desc_assy_list[$value['F']]['name'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                        </td>

                        <td><input type="text" class="form-control" value="<?php echo $value['G'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="drawing_ga[]"></td>
                        <td><input type="text" class="form-control" value="<?php echo $value['H'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="rev_ga[]"></td>
                        <td><input type="text" class="form-control" value="<?php echo $value['I'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="drawing_as[]"></td>
                        <td><input type="text" class="form-control" value="<?php echo $value['J'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="rev_as[]"></td>
                        <td><input type="text" class="form-control" value="<?php echo $value['K'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="drawing_sp[]"></td>
                        <td><input type="text" class="form-control" value="<?php echo $value['L'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="rev_sp[]"></td>
                        <td><input type="text" class="form-control" value="<?php echo $value['M'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="part_id[]"></td>
                        <td>
                          <input type="text" class="form-control" value="<?php echo $value['N'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                          <input type="hidden" class="form-control" value="<?php echo join(", ", $id_pos_list) ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="ref_pos_1[]">
                        </td>
                        <td><input type="text" class="form-control" value="<?php echo $value['P'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="drawing_cp[]"></td>
                        <td><input type="text" class="form-control" value="<?php echo $value['Q'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="rev_cp[]"></td>
                        <td><input type="text" class="form-control" value="<?php echo $value['R'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="drawing_cl[]"></td>
                        <td><input type="text" class="form-control" value="<?php echo $value['S'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="rev_cl[]"></td>
                        <td><input type="text" class="form-control" value="<?php echo $value['T'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="profile[]"></td>
                        <td><input type="text" class="form-control" value="<?php echo $value['U'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="material[]"></td>
                        <td>
                          <input type="text" class="form-control" value="<?php echo $value['V'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                          <input type="hidden" class="form-control" value="<?php echo @$material_grade_list[$value['V']]['id'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="grade[]">
                        </td>
                        <td><input type="text" class="form-control" value="<?php echo $value['W'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="diameter[]"></td>
                        <td><input type="text" class="form-control" value="<?php echo $value['X'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="thickness[]"></td>
                        <td><input type="text" class="form-control" value="<?php echo $value['Y'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="sch[]"></td>
                        <td><input type="text" class="form-control" value="<?php echo $value['Z'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="length[]"></td>
                        <td><input type="text" class="form-control" value="<?php echo $value['AA'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="height[]"></td>
                        <td><input type="text" class="form-control" value="<?php echo $value['AB'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="width[]"></td>
                        <td><input type="number" class="form-control" value="<?php echo number_format((float)$value['AC'], 2, ".", "") ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="weight[]"></td>
                        <td><input type="number" class="form-control" value="<?php echo number_format((float)$value['AD'], 2, ".", "") ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="area[]"></td>
                        <td><input type="text" class="form-control" value="<?php echo $value['AE'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="can_number[]"></td>
                        <td><input type="text" class="form-control" value="<?php echo $value['AF'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="test_pack_no[]"></td>
                        <td><input type="text" class="form-control" value="<?php echo $value['AG'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="remarks[]"></td>
                        <td><input type="text" class="form-control" value="<?php echo $value['AH'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="item_code[]"></td>
                        <td><input type="text" class="form-control" value="<?php echo $value['AI'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="spool_no[]"></td>
                        <td><input type="text" class="form-control" value="<?php echo $value['AJ'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="beam_chnl_thk[]"></td>
                        <td><input type="text" class="form-control" value="<?php echo $value['AK'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="strain_age_test_dt[]"></td>
                        <td><input type="text" class="form-control" value="<?php echo $value['AL'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="strain_age_test_yn[]"></td>
                        <td><input type="text" class="form-control" value="<?php echo $value['AM'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="through_thickness[]"></td>
                        <td>
                          <input type="text" class="form-control" value="<?php echo $value['AN'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                          <input type="hidden" class="form-control" value="<?php echo @$status_internal_list[$value['AN']] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="status_internal[]">
                        </td>
                        <td>
                          <input type="text" class="form-control" value="<?php echo $value['AO'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                          <input type="hidden" class="form-control" value="<?php echo @$is_itr_list[$value['AO']] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="is_itr[]">
                        </td>
                        <td>
                          <input type="text" class="form-control" value="<?php echo @$piping_testing_category_list[$value['AP']]['name'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                          <input type="hidden" class="form-control" value="<?php echo $value['AP'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="piping_testing_category[]">
                        </td>
                        <td>
                          <input type="text" class="form-control" value="<?php echo @$company_list[$value['AQ']]['company_name'] ?> " <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                          <input type="hidden" class="form-control" value="<?php echo $company_list[$value['AQ']]['id_company'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="company_id[]">
                        </td>
                        <td>
                          <input type="text" class="form-control" value="<?php echo $value['AR'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                          <input type="hidden" class="form-control" value="<?php echo $value['AR'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="request_date[]">
                        </td>
                        <td>
                          <input type="text" class="form-control" value="<?php echo $value['AS'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                          <input type="hidden" class="form-control" value="<?php echo $value['AS'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="unique_no[]">
                          <input type="hidden" class="form-control" value="<?php echo $id_mis_det[$project_list[$value['A']]['id']][$value['AS']] ?>" name="id_mis[]">

                        </td>
                        <td>
                          <input type="text" class="form-control" value="<?php echo $user_list[$value['AT']]['full_name'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                          <input type="hidden" class="form-control" value="<?php echo $value['AT'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="inspect_by[]">
                        </td>
                        <td>
                          <input type="text" class="form-control" value="<?php echo $value['AU'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
                          <input type="hidden" class="form-control" value="<?php echo $value['AU'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="inspection_date[]">
                        </td>
                        <td>
                          <input type="hidden" class="form-control" value="<?php echo $value['AV'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?> name="service_line[]">
                          <input type="text" class="form-control" value="<?php echo $value['AV'] ?>" <?php echo ($status != "" ? "disabled" : "readonly") ?>>
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
                <?php if (!$is_disabled) : ?>
                  <button class="mt-2 btn btn-sm btn-flat btn-success"><i class="fas fa-check"></i> Submit</button>
                <?php else : ?>
                  <span class="btn btn-warning"><i class="fas fa-info-circle"></i> Cannot Submit : Please Check Column Status</span>
                <?php endif; ?>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>
</div><!-- ini div dari sidebar yang class wrapper -->