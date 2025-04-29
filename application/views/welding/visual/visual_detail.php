
<div id="content" class="container-fluid">

  <a href="<?php echo base_url(); ?>welding_rfi/rfi_detail/<?php echo strtr($this->encryption->encrypt($rfi_id_list), '+=/', '.-~') ?>" class='btn btn-warning'><i class="fas fa-arrow-left"></i> Back</a>

  <form method="POST" action="<?php echo base_url();?>we_dept/visual_update_process">

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
                    <label class="form-check-label"><input class="form-check-input" type="radio" name="approval" value="3" style="width: 17px; height: 17px">
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
                    <th><center>WPS</center></th>
                    <th><center>Cons / Lot No</center></th>
                    <th><center>Welding Process</center></th>
                    <th><center>Welder ID</center></th>
                    <th><center>THK</center></th>
                    <th><center>Length</center></th>
                    <th><center>Weld Completion Date</center></th>
                    <th><center>Inspection Result</center></th>
                    <th><center>NDE Requirement</center></th>
                    <th><center>Remarks</center></th>
                    <?php if($process != 'details'){ ?><th>#</th><?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; foreach ($data_list as $key => $value) { ?>

                    <input type="hidden" name="id_visual_we[<?php echo $no; ?>]" value='<?php echo $value['id_visual_we'] ?>'>

                  <tr id="remove<?php echo $no; ?>">
                    <td class="align-middle"><input type="text" id="drawing_weldmap<?php echo $no; ?>" class="form-control" name="drawing_weldmap[<?php echo $no; ?>]" placeholder="Drawing / Weldmap No" required value="<?php echo $value['drawing_weldmap']; ?>" <?php if($process == 'details'){ echo "readonly"; } ?>></td>

                    <td class="align-middle"><input type="text" id="item_joint_no<?php echo $no; ?>" class="form-control" name="item_joint_no[<?php echo $no; ?>]" placeholder="Item / Joint No" required value="<?php echo $value['item_joint_no']; ?>" <?php if($process == 'details'){ echo "readonly"; } ?>></td>

                    <td  class="align-middle"><input type="text" id="type_of_weld<?php echo $no; ?>" class="form-control" name="type_of_weld[<?php echo $no; ?>]"  placeholder="Type Of Weld" required value="<?php echo $value['type_of_weld']; ?>" <?php if($process == 'details'){ echo "readonly"; } ?>></td>

                    <!-- <td rowspan="2"  class="align-middle">
                        <select class='select2_multiple_wps' id="wps_no<?php echo $no; ?>" name='wps_no[<?php echo $no; ?>][]' multiple required <?php if($process == 'details'){ echo "disabled"; } ?>>
                          <?php
                              $wps_display = explode(";", $value['wps']);
                              foreach ($wps_display as $key => $wps_id) {
                                echo "<option value='".$wps_id."' selected>".$wps_code_arr[$wps_id]."</option>";                         
                              }
                          ?>
                        </select>     
                      </td> -->

                    <td class="align-middle"><input type="text" id="wps_no<?php echo $no; ?>" class="form-control" name="wps_no[<?php echo $no; ?>]"  placeholder="WPS Number" required value="<?php echo $value['wps']; ?>" <?php if($process == 'details'){ echo "readonly"; } ?>></td>

                    <td class="align-middle"><input type="text" id="cons_lot_no<?php echo $no; ?>" class="form-control" name="cons_lot_no[<?php echo $no; ?>]" placeholder="Consumable Lot no" required value="<?php echo $value['cons_lot_no']; ?>" <?php if($process == 'details'){ echo "readonly"; } ?>></td>

                    <td class="align-middle">
                      <table>
                        <tr>
                          <td>R/H</td>
                          <td><input type="text" id="weld_proces_rh<?php echo $no; ?>" class="form-control" name="weld_proces_rh[<?php echo $no; ?>]" placeholder="Process R/H" required value="<?php echo $value['weld_proces_rh']; ?>" <?php if($process == 'details'){ echo "readonly"; } ?>></td>
                        </tr>
                        <tr>
                          <td>F/C</td>
                          <td><input type="text" id="weld_proces_fc<?php echo $no; ?>" class="form-control" name="weld_proces_fc[<?php echo $no; ?>]" placeholder="Process F/C" required value="<?php echo $value['weld_proces_fc']; ?>" <?php if($process == 'details'){ echo "readonly"; } ?>></td>
                        </tr>
                      </table>
                    </td>

                    <td class="align-middle">
                      <table>
                        <tr>
                          <td>R/H</td>
                          <td><input type="text" id="welder_id_rh<?php echo $no; ?>" class="form-control" name="welder_id_rh[<?php echo $no; ?>]" placeholder="Welder R/H" required value="<?php echo $value['welder_id_rh']; ?>" <?php if($process == 'details'){ echo "readonly"; } ?>></td>
                        </tr>
                        <tr>
                          <td>F/C</td>
                          <td><input type="text" id="welder_id_fc<?php echo $no; ?>" class="form-control" name="welder_id_fc[<?php echo $no; ?>]" placeholder="Welder F/C" required value="<?php echo $value['welder_id_fc']; ?>" <?php if($process == 'details'){ echo "readonly"; } ?>></td>
                        </tr>
                      </table>
                    </td>

                    <td class="align-middle"><input type="text" id="thickness<?php echo $no; ?>" class="form-control" name="thickness[<?php echo $no; ?>]" placeholder="Thickness" required value="<?php echo $value['thickness']; ?>" <?php if($process == 'details'){ echo "readonly"; } ?>></td>

                    <td class="align-middle"><input type="text" id="length<?php echo $no; ?>" class="form-control" name="length[<?php echo $no; ?>]" placeholder="Length" required value="<?php echo $value['length']; ?>" <?php if($process == 'details'){ echo "readonly"; } ?>></td>

                    <td class="align-middle"><input type="text" id="weld_completion_date<?php echo $no; ?>" class="form-control" name="weld_completion_date[<?php echo $no; ?>]" placeholder="Welding Completed Date" required value="<?php echo $value['weld_completion_date']; ?>" <?php if($process == 'details'){ echo "readonly"; } ?>></td>

                    <td class="align-middle">
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
                        </div><br/><!-- 
                      <input type="text" id="inspection_result<?php echo $no; ?>" class="form-control" name="inspection_result[<?php echo $no; ?>]" placeholder="Inspection Result" required value="<?php echo $value['inspection_result']; ?>" <?php if($process == 'details'){ echo "readonly"; } ?>> -->
                    </td>

                    <td class="align-middle">
                      <table>
                        <tr>
                          <td>MT</td>
                          <td><input type="checkbox" id="nde_mt<?php echo $no; ?>"  name="nde_mt[<?php echo $no; ?>]" value="1" <?php if($value['nde_mt']){ echo "checked"; }?> <?php if($process == 'details'){ echo "disabled"; } ?>></td>
                          <td>PT</td>
                          <td><input type="checkbox" id="nde_pt<?php echo $no; ?>" name="nde_pt[<?php echo $no; ?>]" value="1" <?php if($value['nde_pt']){ echo "checked"; }?> <?php if($process == 'details'){ echo "disabled"; } ?>></td>
                        </tr>
                        <tr>
                          <td>UT</td>
                          <td><input type="checkbox" id="nde_ut<?php echo $no; ?>"  name="nde_ut[<?php echo $no; ?>]" value="1" <?php if($value['nde_ut']){ echo "checked"; }?> <?php if($process == 'details'){ echo "disabled"; } ?>></td>
                          <td>RT</td>
                          <td><input type="checkbox" id="nde_rt<?php echo $no; ?>"  name="nde_rt[<?php echo $no; ?>]" value="1" <?php if($value['nde_rt']){ echo "checked"; }?> <?php if($process == 'details'){ echo "disabled"; } ?>></td>
                        </tr>
                      </table>
                    </td>

                    <td class="align-middle"><input type="text" id="remarks<?php echo $no; ?>" class="form-control" name="remarks[<?php echo $no; ?>]" placeholder="Remarks" required value="<?php echo $value['remarks']; ?>" <?php if($process == 'details'){ echo "readonly"; } ?>></td>   

                     <?php if($process != 'details'){ ?><td class="align-middle"><a href='<?php echo base_url(); ?>we_dept/visual_delete_process/<?php echo $value['id_visual_we']; ?>' class='btn btn-danger'><i class="fa fa-trash"></i></a></td><?php } ?>
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

      $(".select2_multiple_wps").select2({
        tags: true,
        tokenSeparators: [',', ' '],
        ajax: {
              url: "<?php echo base_url();?>fitup/get_wps_ajax",
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

</script>