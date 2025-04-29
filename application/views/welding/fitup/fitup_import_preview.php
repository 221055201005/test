<?php //test_var($sheet) ?>
<div id="content" class="container-fluid">
  <a href="<?php echo base_url(); ?>we_dept/fitup_import/<?php echo strtr($this->encryption->encrypt($rfi_id_list), '+=/', '.-~') ?>" class='btn btn-warning'><i class="fas fa-arrow-left"></i> Back</a>
  <form method="POST" action="<?php echo base_url();?>we_dept/fitup_new_process">

    <input type="hidden" class="form-control"  name="rfi_id_list" value="<?php echo $rfi_id_list; ?>" required>
    <input type="hidden" class="form-control"  name="created_by" value="<?php echo $this->user_cookie[0]; ?>" required>
    <input type="hidden" class="form-control"  name="created_date"  value="<?php echo date("Y-m-d H:i:s"); ?>" required>

    <div class="row">

      <div class="col-md-12">
        <div class="my-3 p-3 bg-white rounded shadow-sm">
          <h6 class="pb-2 mb-0"><?php echo $meta_title ?></h6>
          <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
            <div class="container-fluid">

              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>Employer </label>
                    <input type="text" class="form-control" name="employer_title" value='<?php echo $sheet[2]['A'] ?>' placeholder="ex : RWE" required >
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>Report No</label>
                    <input type="text" class="form-control" name="report_no"  value='<?php echo $sheet[2]['F'] ?>' placeholder='ex : FIT-SO-STR-PQR-100' required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>Project</label>
                    <input type="text" class="form-control" name="project_title" value='<?php echo $sheet[2]['B'] ?>' placeholder='ex : SOFIA' required>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>Date</label>
                    <input type="text" class="form-control" name="date_title"  value='<?php echo $sheet[2]['G'] ?>' required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>Module</label>
                    <input type="text" class="form-control" name='module' value='<?php echo $sheet[2]['C'] ?>' placeholder="ex :  SMOE PQR 110">
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>Drawing no</label>
                    <input type="text" class="form-control" name='drawing_no' value='<?php echo $sheet[2]['H'] ?>' placeholder="ex : SMOE PQR 117B">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>Contractor</label>
                    <input type="text" class="form-control"  name="contractor" value='<?php echo $sheet[2]['D'] ?>' placeholder="ex : Sembcorp Marine "  required>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>Description</label>
                    <input type="text" class="form-control"  name="description" value='<?php echo $sheet[2]['I'] ?>' placeholder="ex : SMAW + SCAW" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>Discipline</label>
                    <input type="text" class="form-control"  name="discipline" value='<?php echo $sheet[2]['E'] ?>' placeholder="ex : Structural"  required>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>Requested By</label>
                    <input type="text" class="form-control"  name="request_by" value='<?php echo $sheet[2]['J'] ?>' placeholder="...."  required>
                  </div>
                </div>
              </div>


              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Document Reference No</label>
                    <input type="text" class="form-control"  name="referer_document" value='<?php echo $sheet[2]['K'] ?>' placeholder="...."  required>
                  </div>
                </div>
              </div>

            </div>
          </div>
        
          <div class="overflow-auto media text-muted py-3 border-bottom border-gray">
            <div class="container-fluid">
              <table class="table" id='form-submit'>
                <thead>
                  <tr class="table-success">
                    <th><center>Drawing / Weld Map No</center></th>
                    <th><center>Item No / Joint No.</center></th>
                    <th><center>Type Of Weld</center></th>
                    <th><center>Desc</center></th>
                    <th><center>Piecemark</center></th>
                    <th><center>Grade/Spe</center></th>
                    <th><center>Unique No</center></th>
                    <th><center>Heat No</center></th>
                    <th><center>Thk</center></th>
                    <th><center>Length (mm)</center></th>
                    <th><center>Tack Weld ID (mm)</center></th>
                    <th><center>WPS</center></th>
                    <th><center>Inspection Result</center></th>
                    <th><center>Remarks</center></th>
                    <th>#</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; foreach ($sheet as $key => $value) { ?>

                  <?php if($no >= 2){ ?>

                  <tr id="remove<?php echo $no; ?>">
                      <td rowspan="2" class="align-middle"><input type="text" id="drawing_weldmap<?php echo $no; ?>" class="form-control" name="drawing_weldmap[<?php echo $no; ?>]" placeholder="Drawing / Weldmap No" value='<?php echo $sheet[$key]['L'] ?>' required></td>

                      <td rowspan="2"  class="align-middle"><input type="text" id="item_joint_no<?php echo $no; ?>" class="form-control" name="item_joint_no[<?php echo $no; ?>]" placeholder="Item / Joint No" value='<?php echo $sheet[$key]['M'] ?>' required></td>

                      <td rowspan="2"  class="align-middle"><input type="text" id="type_of_weld<?php echo $no; ?>" class="form-control" name="type_of_weld[<?php echo $no; ?>]"  placeholder="Type Of Weld" value='<?php echo $sheet[$key]['N'] ?>' required></td>

                      <td class="align-middle"><input type="text" id="mtt_desc_1<?php echo $no; ?>" class="form-control" name="mtt_desc_1[<?php echo $no; ?>]"  placeholder="Material Description" value='<?php echo $sheet[$key]['O'] ?>' required></td>

                      <td class="align-middle"><input type="text" id="mtt_piecemark_1<?php echo $no; ?>" class="form-control" name="mtt_piecemark_1[<?php echo $no; ?>]" placeholder="Piece Mark No" value='<?php echo $sheet[$key]['P'] ?>' required></td>

                      <td class="align-middle"><input type="text" id="mtt_grade_1<?php echo $no; ?>" class="form-control" name="mtt_grade_1[<?php echo $no; ?>]" placeholder="Material Grade" value='<?php echo $sheet[$key]['Q'] ?>' required></td>

                      <td class="align-middle"><input type="text" id="mtt_unique_1<?php echo $no; ?>" class="form-control" name="mtt_unique_1[<?php echo $no; ?>]" placeholder="Uniqe Identification No" value='<?php echo $sheet[$key]['R'] ?>' required></td>

                      <td class="align-middle"><input type="text" id="mtt_heat_no_1<?php echo $no; ?>" class="form-control" name="mtt_heat_no_1[<?php echo $no; ?>]"  placeholder="Material Heat Number" value='<?php echo $sheet[$key]['S'] ?>' required></td>

                      <td class="align-middle"><input type="text" id="mtt_thk_1<?php echo $no; ?>" class="form-control" name="mtt_thk_1[<?php echo $no; ?>]"  placeholder="Material Thickness" value='<?php echo $sheet[$key]['T'] ?>' required></td>

                      <td rowspan="2"  class="align-middle"><input type="text" id="joint_length<?php echo $no; ?>" class="form-control" name="joint_length[<?php echo $no; ?>]" placeholder="Joint Length" value='<?php echo $sheet[$key]['AA'] ?>' required></td>

                      <td rowspan="2"  class="align-middle"><input type="text" id="tack_weld_id<?php echo $no; ?>" class="form-control" name="tack_weld_id[<?php echo $no; ?>]" placeholder="Tack Weld ID" value='<?php echo $sheet[$key]['AB'] ?>' required></td>

                      <td rowspan="2"  class="align-middle"><input type="text" id="wps_no<?php echo $no; ?>" class="form-control" name="wps_no[<?php echo $no; ?>]" placeholder="WPS No" value='<?php echo $sheet[$key]['AC'] ?>' ></td>

                      <!-- <td rowspan="2"  class="align-middle">
                        <select class='select2_multiple_wps' id="wps_no<?php echo $no; ?>" name='wps_no[<?php echo $no; ?>][]' multiple required>
                          <?php
                              $wps_display = explode(", ", $sheet[$key]['AC']);
                              foreach ($wps_display as $data_wps_key1 => $wps_id) {
                                echo "<option value='".$wps_id_arr[$wps_id]."' selected>".$wps_id."</option>";                         
                              }
                          ?>
                        </select> 
                      
                       <?php
                        $list_welder= explode(", ", $sheet[$key]['AC']);
                        foreach ($list_welder as $data_wps_key => $data_wps) {
                          $where['wps_no'] = $data_wps;
                          $wps_code_db = $this->welding_mod->check_wps_code($where);
                          unset($where);
                          if(sizeof($wps_code_db) <= 0){
                             echo "<span style='color:red;'>WPS Code ". $data_wps ." Not found in our master database..</span>";
                          
                          } 
                        }
                        ?>
                      </td> -->

                      <td rowspan="2"  class="align-middle"><input type="text" id="inspection_result<?php echo $no; ?>" class="form-control" name="inspection_result[<?php echo $no; ?>]" placeholder="Inspection Result" value='<?php echo $sheet[$key]['AD'] ?>' required></td>

                      <td rowspan="2"  class="align-middle"><input type="text" id="remarks<?php echo $no; ?>" class="form-control" name="remarks[<?php echo $no; ?>]"  placeholder="Remarks" value='<?php echo $sheet[$key]['AE'] ?>' required></td>
                     
                      <td rowspan="2"  class="align-middle"><button type="button" class="btn btn-danger" title="Delete Row" onclick="deleterow(this,<?php echo $no; ?>);"><i class="fa fa-trash"></i></button></td>

                </tr>
                <tr id="remove<?php echo $no; ?>">

                      <td class="align-middle"><input type="text" id="mtt_desc_2<?php echo $no; ?>" class="form-control" name="mtt_desc_2[<?php echo $no; ?>]"  placeholder="Material Description" value='<?php echo $sheet[$key]['U'] ?>' required></td>

                      <td class="align-middle"><input type="text" id="mtt_piecemark_2<?php echo $no; ?>" class="form-control" name="mtt_piecemark_2[<?php echo $no; ?>]"  placeholder="Piecemark No" value='<?php echo $sheet[$key]['V'] ?>' required></td>

                      <td class="align-middle"><input type="text" id="mtt_grade_2<?php echo $no; ?>" class="form-control" name="mtt_grade_2[<?php echo $no; ?>]"   placeholder="Material Grade" value='<?php echo $sheet[$key]['W'] ?>' required></td>

                      <td class="align-middle"><input type="text" value='<?php echo $sheet[$key]['X'] ?>' id="mtt_unique_2<?php echo $no; ?>" class="form-control" name="mtt_unique_2[<?php echo $no; ?>]"   placeholder="Unique Identification No" required></td>

                      <td class="align-middle"><input type="text"  value='<?php echo $sheet[$key]['Y'] ?>'  placeholder="Heat Number" id="mtt_heat_no_2<?php echo $no; ?>" class="form-control" name="mtt_heat_no_2[<?php echo $no; ?>]" required></td>

                      <td class="align-middle"><input type="text" value='<?php echo $sheet[$key]['Z'] ?>' id="mtt_thk_2<?php echo $no; ?>" class="form-control" name="mtt_thk_2[<?php echo $no; ?>]"   placeholder="Heat Number" required></td>

                </tr>
                <?php } ?>
                <?php $no++; } ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="text-right mt-3">
                <button type="submit" name="submit" value="submit" class="btn btn-success " title="Submit">
                  <i class="fa fa-check"></i> Submit
                </button>
            <!-- <a href="<?php echo base_url(); ?>fitup/fitup_list/" class="btn btn-secondary text-white" title="Detail"><i class="fas fa-times"></i> Cancel</a> -->
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
</div><!-- ini div dari sidebar yang class wrapper -->

<script type="text/javascript">

    $(document).ready(function(){

      $(".select2_multiple_wps").select2({
        tags: true,
        tokenSeparators: [',', ' '],
        ajax: {
              url: "<?php echo base_url();?>we_dept/get_wps_ajax",
              type: "post",
              dataType: 'json',
              data: function (params) {
                var query = {
                  search: params.term
                }
                return query;
              },
              processResults: function (data) {
                return {
                  results: data
                }
              }
            }
      })

  });
 

  function deleterow(btn,no) {
    $(btn).closest('tr').remove();
    $('table#form-submit tr#remove'+no).remove();
  }

</script>
