<?php //test_var($sheet) ?>
<div id="content" class="container-fluid">
  <form method="POST" action="<?php echo base_url();?>we_dept/visual_new_process/<?php echo strtr($this->encryption->encrypt($rfi_id_list), '+=/', '.-~') ?>">
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
                    <th>#</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; foreach ($sheet as $key => $value) { ?>

                  <?php if($no >= 2){ ?>

                  <tr id="remove<?php echo $no; ?>">
                    <td class="align-middle"><input type="text" id="drawing_weldmap<?php echo $no; ?>" class="form-control" name="drawing_weldmap[<?php echo $no; ?>]" placeholder="Drawing / Weldmap No" required value="<?php echo $sheet[$key]['L']; ?>"></td>

                    <td class="align-middle"><input type="text" id="item_joint_no<?php echo $no; ?>" class="form-control" name="item_joint_no[<?php echo $no; ?>]" placeholder="Item / Joint No" required value="<?php echo $sheet[$key]['M']; ?>"></td>

                    <td  class="align-middle"><input type="text" id="type_of_weld<?php echo $no; ?>" class="form-control" name="type_of_weld[<?php echo $no; ?>]"  placeholder="Type Of Weld" required value="<?php echo $sheet[$key]['N']; ?>"></td>

                    <td class="align-middle"><input type="text" id="wps_no<?php echo $no; ?>" class="form-control" name="wps_no[<?php echo $no; ?>]"  placeholder="WPS Number" required value="<?php echo $sheet[$key]['O']; ?>"></td>

                    <td class="align-middle"><input type="text" id="cons_lot_no<?php echo $no; ?>" class="form-control" name="cons_lot_no[<?php echo $no; ?>]" placeholder="Consumable Lot no" required value="<?php echo $sheet[$key]['P']; ?>"></td>

                    <td class="align-middle">
                      <table>
                        <tr>
                          <td>R/H</td>
                          <td><input type="text" id="weld_proces_rh<?php echo $no; ?>" class="form-control" name="weld_proces_rh[<?php echo $no; ?>]" placeholder="Process R/H" required value="<?php echo $sheet[$key]['Q']; ?>"></td>
                        </tr>
                        <tr>
                          <td>F/C</td>
                          <td><input type="text" id="weld_proces_fc<?php echo $no; ?>" class="form-control" name="weld_proces_fc[<?php echo $no; ?>]" placeholder="Process F/C" required value="<?php echo $sheet[$key]['R']; ?>"></td>
                        </tr>
                      </table>
                    </td>

                    <td class="align-middle">
                      <table>
                        <tr>
                          <td>R/H</td>
                          <td><input type="text" id="welder_id_rh<?php echo $no; ?>" class="form-control" name="welder_id_rh[<?php echo $no; ?>]" placeholder="Welder R/H" required value="<?php echo $sheet[$key]['S']; ?>"></td>
                        </tr>
                        <tr>
                          <td>F/C</td>
                          <td><input type="text" id="welder_id_fc<?php echo $no; ?>" class="form-control" name="welder_id_fc[<?php echo $no; ?>]" placeholder="Welder F/C" required value="<?php echo $sheet[$key]['T']; ?>"></td>
                        </tr>
                      </table>
                    </td>

                    <td class="align-middle"><input type="text" id="thickness<?php echo $no; ?>" class="form-control" name="thickness[<?php echo $no; ?>]" placeholder="Thickness" required value="<?php echo $sheet[$key]['U']; ?>"></td>

                    <td class="align-middle"><input type="text" id="length<?php echo $no; ?>" class="form-control" name="length[<?php echo $no; ?>]" placeholder="Length" required value="<?php echo $sheet[$key]['V']; ?>"></td>

                    <td class="align-middle"><input type="text" id="weld_completion_date<?php echo $no; ?>" class="form-control" name="weld_completion_date[<?php echo $no; ?>]" placeholder="Welding Completed Date" required value="<?php echo $sheet[$key]['W']; ?>"></td>

                    <td class="align-middle"><input type="text" id="inspection_result<?php echo $no; ?>" class="form-control" name="inspection_result[<?php echo $no; ?>]" placeholder="Inspection Result" required value="<?php echo $sheet[$key]['X']; ?>"></td>

                    <td class="align-middle">
                      <table>
                        <tr>
                          <td>MT</td>
                          <td><input type="checkbox" id="nde_mt<?php echo $no; ?>"  name="nde_mt[<?php echo $no; ?>]" value="1" <?php if($sheet[$key]['Y']){ echo "checked"; }?>></td>
                          <td>PT</td>
                          <td><input type="checkbox" id="nde_pt<?php echo $no; ?>" name="nde_pt[<?php echo $no; ?>]" value="1" <?php if($sheet[$key]['Z']){ echo "checked"; }?>></td>
                        </tr>
                        <tr>
                          <td>UT</td>
                          <td><input type="checkbox" id="nde_ut<?php echo $no; ?>"  name="nde_ut[<?php echo $no; ?>]" value="1" <?php if($sheet[$key]['AA']){ echo "checked"; }?>></td>
                          <td>RT</td>
                          <td><input type="checkbox" id="nde_rt<?php echo $no; ?>"  name="nde_rt[<?php echo $no; ?>]" value="1" <?php if($sheet[$key]['AB']){ echo "checked"; }?>></td>
                        </tr>
                      </table>
                    </td>

                    <td class="align-middle"><input type="text" id="remarks<?php echo $no; ?>" class="form-control" name="remarks[<?php echo $no; ?>]" placeholder="Remarks" required value="<?php echo $sheet[$key]['AC']; ?>"></td>   

                    <td class="align-middle"><button type="button" class="btn btn-danger" title="Delete Row" onclick="deleterow(this,<?php echo $no; ?>);"><i class="fa fa-trash"></i></button></td>
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
            <!-- <a href="<?php echo base_url(); ?>visual/visual_list/" class="btn btn-secondary text-white" title="Detail"><i class="fas fa-times"></i> Cancel</a> -->
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
</div><!-- ini div dari sidebar yang class wrapper -->
<script type="text/javascript">
 

  function deleterow(btn,no) {
    $(btn).closest('tr').remove();
    $('table#form-submit tr#remove'+no).remove();
  }

</script>
