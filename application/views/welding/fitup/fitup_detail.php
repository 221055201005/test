
<div id="content" class="container-fluid">

  <a href="<?php echo base_url(); ?>welding_rfi/rfi_detail/<?php echo strtr($this->encryption->encrypt($rfi_id_list), '+=/', '.-~') ?>" class='btn btn-warning'><i class="fas fa-arrow-left"></i> Back</a>

  <form method="POST" action="<?php echo base_url();?>we_dept/fitup_update_process">

    <input type="hidden" class="form-control"  name="created_by" value="<?php echo $this->user_cookie[0]; ?>" required <?php if($process == 'details'){ echo "readonly"; } ?>>
    <input type="hidden" class="form-control"  name="created_date"  value="<?php echo date("Y-m-d H:i:s"); ?>" required <?php if($process == 'details'){ echo "readonly"; } ?>>

    <input type="hidden" class="form-control"  name="process"  value="<?php echo $process; ?>">
    <input type="hidden" class="form-control"  name="rfi_id_list"  value="<?php echo $rfi_id_list; ?>">

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
                    <input type="text" class="form-control" name="employer_title" value='<?php echo $data_list[0]['employer_title'] ?>' placeholder="ex : RWE" required <?php if($process == 'details'){ echo "readonly"; } ?> >
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>Report No</label>
                    <input type="text" class="form-control" name="report_no"  value='<?php echo $data_list[0]['report_no'] ?>' placeholder='ex : FIT-SO-STR-PQR-100' required <?php if($process == 'details'){ echo "readonly"; } ?>>

                     <input type="hidden" class="form-control" name="report_no_original"  value='<?php echo $data_list[0]['report_no'] ?>'>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>Project</label>
                    <input type="text" class="form-control" name="project_title" value='<?php echo $data_list[0]['project_title'] ?>' placeholder='ex : SOFIA' required <?php if($process == 'details'){ echo "readonly"; } ?>>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>Date</label>
                    <input type="text" class="form-control" name="date_title"  value='<?php echo $data_list[0]['date_title'] ?>' required <?php if($process == 'details'){ echo "readonly"; } ?>>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>Module</label>
                    <input type="text" class="form-control" name='module' value='<?php echo $data_list[0]['module'] ?>' placeholder="ex :  SMOE PQR 110" required <?php if($process == 'details'){ echo "readonly"; } ?>>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>Drawing no</label>
                    <input type="text" class="form-control" name='drawing_no' value='<?php echo $data_list[0]['drawing_no'] ?>' placeholder="ex : SMOE PQR 117B" required <?php if($process == 'details'){ echo "readonly"; } ?>>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>Contractor</label>
                    <input type="text" class="form-control"  name="contractor" value='<?php echo $data_list[0]['contractor'] ?>' placeholder="ex : Sembcorp Marine "  required <?php if($process == 'details'){ echo "readonly"; } ?>>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>Description</label>
                    <input type="text" class="form-control"  name="description" value='<?php echo $data_list[0]['description'] ?>' placeholder="ex : SMAW + SCAW" required <?php if($process == 'details'){ echo "readonly"; } ?>>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>Discipline</label>
                    <input type="text" class="form-control"  name="discipline" value='<?php echo $data_list[0]['discipline'] ?>' placeholder="ex : Structural"  required <?php if($process == 'details'){ echo "readonly"; } ?>>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>Requested By</label>
                    <input type="text" class="form-control"  name="request_by" value='<?php echo $data_list[0]['request_by'] ?>' placeholder="...."  required <?php if($process == 'details'){ echo "readonly"; } ?>>
                  </div>
                </div>
              </div>


              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Document Reference No</label>
                    <input type="text" class="form-control"  name="referer_document" value='<?php echo $data_list[0]['referer_document'] ?>' placeholder="...."  required <?php if($process == 'details'){ echo "readonly"; } ?>>
                  </div>
                </div>
              </div>

            </div>
          </div>
        
          <div class="overflow-auto media text-muted py-3 border-bottom border-gray">
            <div class="container-fluid">

                  <div class="radio-toolbar">

                    <div class="form-check form-check-inline text-success">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="approval" value="0" style="width: 17px; height: 17px">
                      <b>Approve All</b></label>
                    </div>
                    <div class="form-check form-check-inline text-danger">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="approval" value="1" style="width: 17px; height: 17px">
                      <b>Reject All</b></label>
                    </div>
                    <div class="form-check form-check-inline text-primary">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="approval" value="2" style="width: 17px; height: 17px">
                      <b>Pending All</b></label>
                    </div>
                     <div class="form-check form-check-inline text-secondary">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="approval" value="3" style="width: 17px; height: 17px">
                     <b>Uncheck All</b></label>
                    </div>

                  </div>
                  <br/>

              <table class="table" id='form-submit'>
                <thead>
                  <tr class="table-success">
                    <th><center>Drawing / Weld Map No</center></th>
                    <th><center>Item No / Joint No.</center></th>
                    <th><center>Type Of Weld</center></th>
                    <th><center>Desc</center></th>
                    <th><center>Piecemark</center></th>
                    <th><center>Grade/Spec</center></th>
                    <th><center>Unique No</center></th>
                    <th><center>Heat No</center></th>
                    <th><center>Thk</center></th>
                    <th><center>Length (mm)</center></th>
                    <th><center>Tack Weld ID (mm)</center></th>
                    <th><center>WPS</center></th>
                    <th><center>Inspection Result</center></th>
                    <th><center>Remarks</center></th>
                   <?php if($process != 'details'){ ?> <th>#</th> <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; foreach ($data_list as $key => $value) { ?>

                    <input type="hidden" name="id_fitup_we[<?php echo $no; ?>]" value='<?php echo $value['id_fitup_we'] ?>'>

                  <tr id="remove<?php echo $no; ?>">
                      <td rowspan="2" class="align-middle"><input type="text" id="drawing_weldmap<?php echo $no; ?>" class="form-control" name="drawing_weldmap[<?php echo $no; ?>]" placeholder="Drawing / Weldmap No" value='<?php echo $value['drawing_weldmap'] ?>' required <?php if($process == 'details'){ echo "readonly"; } ?>></td>

                      <td rowspan="2"  class="align-middle"><input type="text" id="item_joint_no<?php echo $no; ?>" class="form-control" name="item_joint_no[<?php echo $no; ?>]" placeholder="Item / Joint No" value='<?php echo $value['item_joint_no'] ?>' required <?php if($process == 'details'){ echo "readonly"; } ?>></td>

                      <td rowspan="2"  class="align-middle"><input type="text" id="type_of_weld<?php echo $no; ?>" class="form-control" name="type_of_weld[<?php echo $no; ?>]"  placeholder="Type Of Weld" value='<?php echo $value['type_of_weld'] ?>' required <?php if($process == 'details'){ echo "readonly"; } ?>></td>

                      <td class="align-middle"><input type="text" id="mtt_desc_1<?php echo $no; ?>" class="form-control" name="mtt_desc_1[<?php echo $no; ?>]"  placeholder="Material Description" value='<?php echo $value['mtt_desc_1'] ?>' required <?php if($process == 'details'){ echo "readonly"; } ?>></td>

                      <td class="align-middle"><input type="text" id="mtt_piecemark_1<?php echo $no; ?>" class="form-control" name="mtt_piecemark_1[<?php echo $no; ?>]" placeholder="Piece Mark No" value='<?php echo $value['mtt_piecemark_1'] ?>' required <?php if($process == 'details'){ echo "readonly"; } ?>></td>

                      <td class="align-middle"><input type="text" id="mtt_grade_1<?php echo $no; ?>" class="form-control" name="mtt_grade_1[<?php echo $no; ?>]" placeholder="Material Grade" value='<?php echo $value['mtt_grade_1'] ?>' required <?php if($process == 'details'){ echo "readonly"; } ?>></td>

                      <td class="align-middle"><input type="text" id="mtt_unique_1<?php echo $no; ?>" class="form-control" name="mtt_unique_1[<?php echo $no; ?>]" placeholder="Uniqe Identification No" value='<?php echo $value['mtt_unique_1'] ?>' required <?php if($process == 'details'){ echo "readonly"; } ?>></td>

                      <td class="align-middle">
                        <input type="text" id="mtt_heat_no_1<?php echo $no; ?>" class="form-control" name="mtt_heat_no_1[<?php echo $no; ?>]"  placeholder="Material Heat Number" value='<?php echo $value['mtt_heat_no_1'] ?>' required <?php if($process == 'details'){ echo "readonly"; } ?>  oninput="autocomplete_heat_number(this, <?= $no ?>,'1')" onblur="detail_heat_no(this, <?= $no ?>,'1')" onchange="detail_heat_no(this, <?= $no ?>,'1')">
                      </td>

                      <td class="align-middle"><input type="text" id="mtt_thk_1<?php echo $no; ?>" class="form-control" name="mtt_thk_1[<?php echo $no; ?>]"  placeholder="Material Thickness" value='<?php echo $value['mtt_thk_1'] ?>' required <?php if($process == 'details'){ echo "readonly"; } ?>></td>

                      <td rowspan="2"  class="align-middle"><input type="text" id="joint_length<?php echo $no; ?>" class="form-control" name="joint_length[<?php echo $no; ?>]" placeholder="Joint Length" value='<?php echo $value['joint_length'] ?>' required <?php if($process == 'details'){ echo "readonly"; } ?>></td>

                      <td rowspan="2"  class="align-middle"><input type="text" id="tack_weld_id<?php echo $no; ?>" class="form-control" name="tack_weld_id[<?php echo $no; ?>]" placeholder="Tack Weld ID" value='<?php echo $value['tack_weld_id'] ?>' required <?php if($process == 'details'){ echo "readonly"; } ?>></td>

                      <td rowspan="2"  class="align-middle"><input type="text" id="wps_no<?php echo $no; ?>" class="form-control" name="wps_no[<?php echo $no; ?>]" placeholder="WPS No required <?php if($process == 'details'){ echo "readonly"; } ?>" value='<?php echo $value['wps_no'] ?>' required <?php if($process == 'details'){ echo "readonly"; } ?>></td>

                      <!-- <td rowspan="2"  class="align-middle">
                        <select class='select2_multiple_wps' id="wps_no<?php echo $no; ?>" name='wps_no[<?php echo $no; ?>][]' multiple required <?php if($process == 'details'){ echo "disabled"; } ?>>
                          <?php
                              $wps_display = explode(";", $value['wps_no']);
                              foreach ($wps_display as $key => $wps_id) {
                                echo "<option value='".$wps_id."' selected>".$wps_code_arr[$wps_id]."</option>";                         
                              }
                          ?>
                        </select>     
                      </td> -->

                      <td rowspan="2"  class="align-middle">

                        <div class="form-check form-check-inline text-success">
                          <input class="form-check-input acc" type="radio" name="inspection_result[<?php echo $no ?>]" value="ACC" style="width: 17px; height: 17px" <?php if($process == 'details'){ echo "disabled"; } ?> <?php if($value['inspection_result'] == 'ACC'){ echo "checked"; } ?>>
                          <label class="form-check-label"><b>ACC</b></label>
                        </div></br>                      
                        <div class="form-check form-check-inline text-danger">
                          <input class="form-check-input reject" type="radio" name="inspection_result[<?php echo $no ?>]" value="REJECT" style="width: 17px; height: 17px" <?php if($process == 'details'){ echo "disabled"; } ?> <?php if($value['inspection_result'] == 'REJECT'){ echo "checked"; } ?>>
                          <label class="form-check-label"><b>REJECT</b></label>
                        </div></br>                      
                        <div class="form-check form-check-inline text-primary">
                          <input class="form-check-input pending" type="radio" name="inspection_result[<?php echo $no ?>]" value="PENDING" style="width: 17px; height: 17px" <?php if($process == 'details'){ echo "disabled"; } ?> <?php if($value['inspection_result'] == 'PENDING'){ echo "checked"; } ?>>
                          <label class="form-check-label"><b>PENDING</b></label>
                        </div><br/>
                      </td>

                      <td rowspan="2"  class="align-middle"><input type="text" id="remarks<?php echo $no; ?>" class="form-control" name="remarks[<?php echo $no; ?>]"  placeholder="Remarks" value='<?php echo $value['remarks'] ?>' required <?php if($process == 'details'){ echo "readonly"; } ?>></td>
                     
                      <?php if($process != 'details'){ ?><td rowspan="2" class="align-middle"><a href='<?php echo base_url(); ?>we_dept/fitup_delete_process/<?php echo $value['id_fitup_we']; ?>' class='btn btn-danger'><i class="fa fa-trash"></i></a></td><?php } ?>

                </tr>

                <tr id="remove<?php echo $no; ?>">

                      <td class="align-middle"><input type="text" id="mtt_desc_2<?php echo $no; ?>" class="form-control" name="mtt_desc_2[<?php echo $no; ?>]"  placeholder="Material Description" value='<?php echo $value['mtt_desc_2'] ?>' required <?php if($process == 'details'){ echo "readonly"; } ?>></td>

                      <td class="align-middle"><input type="text" id="mtt_piecemark_2<?php echo $no; ?>" class="form-control" name="mtt_piecemark_2[<?php echo $no; ?>]"  placeholder="Piecemark No" value='<?php echo $value['mtt_piecemark_2'] ?>' required <?php if($process == 'details'){ echo "readonly"; } ?>></td>

                      <td class="align-middle"><input type="text" id="mtt_grade_2<?php echo $no; ?>" class="form-control" name="mtt_grade_2[<?php echo $no; ?>]"   placeholder="Material Grade" value='<?php echo $value['mtt_grade_2'] ?>' required <?php if($process == 'details'){ echo "readonly"; } ?>></td>

                      <td class="align-middle"><input type="text" value='<?php echo $value['mtt_unique_2'] ?>' id="mtt_unique_2<?php echo $no; ?>" class="form-control" name="mtt_unique_2[<?php echo $no; ?>]"   placeholder="Unique Identification No" required <?php if($process == 'details'){ echo "readonly"; } ?>></td>

                      <td class="align-middle"><input type="text"  value='<?php echo $value['mtt_heat_no_2'] ?>'  placeholder="Heat Number" id="mtt_heat_no_2<?php echo $no; ?>" class="form-control" name="mtt_heat_no_2[<?php echo $no; ?>]" required <?php if($process == 'details'){ echo "readonly"; } ?> oninput="autocomplete_heat_number(this, <?= $no ?>,'2')" onblur="detail_heat_no(this, <?= $no ?>,'2')" onchange="detail_heat_no(this, <?= $no ?>,'2')"></td>

                      <td class="align-middle"><input type="text" value='<?php echo $value['mtt_thk_2'] ?>' id="mtt_thk_2<?php echo $no; ?>" class="form-control" name="mtt_thk_2[<?php echo $no; ?>]"   placeholder="Heat Number" required <?php if($process == 'details'){ echo "readonly"; } ?>></td>

                </tr>

                <?php $no++; } ?>

                </tbody>
              </table>
            </div>
          </div>
         
            <div class="text-right mt-3">
             
                <?php if($process != 'details'){ ?>
                  <button type="submit" name="submit" value="submit" class="btn btn-success " title="Submit">
                    <i class="fa fa-check"></i> Submit
                  </button>
                <?php } ?> 


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

      $('input[name="approval"]').click(function(){
          var approve_val = $(this).val();
          
          if(approve_val == 0){

            $('.pending').removeAttr('checked');
            $('.reject').removeAttr('checked');
            $('.acc').prop('checked', true);

          } else if(approve_val == 1){

            $('.pending').removeAttr('checked');
            $('.acc').removeAttr('checked');
            $('.reject').prop('checked', true);

          } else if(approve_val == 2){

            $('.reject').removeAttr('checked');
            $('.acc').removeAttr('checked');
            $('.pending').prop('checked', true);

          } else  if(approve_val == 3){

            console.log(approve_val);

            $('.reject').removeAttr('checked');
            $('.acc').removeAttr('checked');
            $('.pending').removeAttr('checked');

            $('.reject').prop('checked', false);
            $('.acc').prop('checked', false);
            $('.pending').prop('checked', false);
            
          }
        });

  });

  function autocomplete_heat_number(input, index, no) {
  $(input).autocomplete({
      source: "<?php echo base_url(); ?>welding_rfi/autocomplete_heat_no/",
      autoFocus: true,
      classes: {
        "ui-autocomplete": "highlight"
      }
    });
  }

function detail_heat_no(input, index, no) {
  var heat_or_series_no = $(input).val()
  var div_certification = $(input).closest('tr').find('.certificate_list')

  $.ajax({
    url: "<?= site_url('welding_rfi/detail_heat_no') ?>",
    type: "POST",
    data: {
      heat_or_series_no: heat_or_series_no
    },
    dataType: "JSON",
    success: function(data) {
      var certification_list = []
      if (data.success) {

        if(no == 1){
          $(input).closest('tr').find(`input[name="mtt_grade_1[${index}]"]`).val(data.material_grade)
          $(input).closest('tr').find(`input[name="mtt_thk_1[${index}]"]`).val(data.thk)
        } else {
           $(input).closest('tr').find(`input[name="mtt_grade_2[${index}]"]`).val(data.material_grade)
          $(input).closest('tr').find(`input[name="mtt_thk_2[${index}]"]`).val(data.thk)
        }

        data.certification_list.map((v, i) => {
          certification_list.push(`
          <a target="_blank" href="https://www.smoebatam.com/warehouse_ori/file/mrir/cm/${v.document_file}">Certificate</a>
          <br>
          `)
        })

        // div_certification.html(certification_list)

      } else {
        // div_certification.empty()
      }
    }
  })
}
</script>