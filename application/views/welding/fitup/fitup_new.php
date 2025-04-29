
<div id="content" class="container-fluid">
   <a href="<?php echo base_url(); ?>welding_rfi/rfi_detail/<?php echo strtr($this->encryption->encrypt($rfi_id_list), '+=/', '.-~') ?>" class='btn btn-warning'><i class="fas fa-arrow-left"></i> Back</a>
   
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
                    <select class="form-control project" name="employer_title" required>
                      <option value="">---</option>
                      <?php foreach ($project_list as $key => $value) : ?>
                        <?php if($value['project_code'] != "yard"){ ?>
                           <option value="<?php echo $value['client'] ?>"><?php echo $value['client'] ?></option>
                        <?php } ?>
                      <?php endforeach; ?>
                    </select>
                    <!-- <input type="text" class="form-control" name="employer_title" placeholder="ex : RWE" required > -->
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>Report No</label>
                    <input type="text" class="form-control" name="report_no" placeholder='ex : FIT-SO-STR-PQR-100' required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>Project</label>
                    <select class="form-control project" name="project_title" required>
                      <option value="">---</option>
                      <?php foreach ($project_list as $key => $value) : ?>
                        <?php if($value['project_code'] != "yard"){ ?>
                          <option value="<?php echo $value['project_name'] ?>"><?php echo $value['project_name'] ?></option>
                        <?php } ?>
                      <?php endforeach; ?>
                    </select><!-- 
                    <input type="text" class="form-control" name="project_title" placeholder='ex : SOFIA' required> -->
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>Date</label>
                    <input type="text" class="form-control" name="date_title" value='<?php echo date('Y-m-d H:i:s'); ?>' required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>Module</label>
                    <input type="text" class="form-control" name='module' placeholder="ex :  SMOE PQR 110">
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>Drawing no</label>
                    <input type="text" class="form-control" name='drawing_no' placeholder="ex : SMOE PQR 117B">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>Contractor</label>
                    <input type="text" class="form-control"  name="contractor" placeholder="ex : Sembcorp Marine "  required>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>Description</label>
                    <input type="text" class="form-control"  name="description" placeholder="ex : SMAW + SCAW" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label>Discipline</label>
                    <select class="form-control" name="discipline" required>
                      <option value="">---</option>
                      <?php foreach ($discipline_list as $key => $value) : ?>
                      <option value="<?php echo $value['discipline_name'] ?>"><?php echo $value['discipline_name'] ?></option>
                      <?php endforeach; ?>
                    </select> 
                    <!-- <input type="text" class="form-control"  name="discipline" value="Structural" placeholder="ex : Structural"  required> -->
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label>Requested By</label>
                    <input type="text" class="form-control"  name="request_by" placeholder="...."  required>
                  </div>
                </div>
              </div>


              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Document Reference No</label>
                    <input type="text" class="form-control"  name="referer_document" placeholder="...."  required>
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
                    <th><center>Tack Weld ID</center></th>
                    <th><center>WPS</center></th>
                    <th><center>Inspection Result</center></th>
                    <th><center>Remarks</center></th>
                    <th><button type="button" class="btn btn-primary" title="Add Row" onclick="addrow();"><i class="fa fa-plus"></i></button></th>
                  </tr>
                </thead>
                <tbody>
                  
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
    addrow();

      // $(".select2_multiple_wps").select2({
      //   tags: true,
      //   tokenSeparators: [',', ' '],
      //   ajax: {
      //         url: "<?php echo base_url();?>we_dept/get_wps_ajax",
      //         type: "post",
      //         dataType: 'json',
      //         data: function (params) {
      //           var query = {
      //             search: params.term
      //           }
      //           return query;
      //         },
      //         processResults: function (data) {
      //           return {
      //             results: data
      //           }
      //         }
      //       }
      // })

  });

  $('.datepicker').datepicker({
    format: 'dd-mm-yyyy',
    orientation: "bottom auto",
    autoclose: true,
    todayHighlight: true
  });

  var delayTimer;
 

var count_data_row = 0;

  function addrow() {

    var html = "";
    html += '<tr id="remove'+count_data_row+'">';

    html += '<td rowspan="2" class="align-middle"><input type="text" id="drawing_weldmap'+count_data_row+'" class="form-control" name="drawing_weldmap['+count_data_row+']" placeholder="Drawing / Weldmap No" required></td>';

    html += '<td rowspan="2"  class="align-middle"><input type="text" id="item_joint_no'+count_data_row+'" class="form-control" name="item_joint_no['+count_data_row+']" placeholder="Item / Joint No" required></td>';

    html += '<td rowspan="2"  class="align-middle"><input type="text" id="type_of_weld'+count_data_row+'" class="form-control" name="type_of_weld['+count_data_row+']"  placeholder="Type Of Weld" required></td>';

    html += '<td class="align-middle"><input type="text" id="mtt_desc_1'+count_data_row+'" class="form-control" name="mtt_desc_1['+count_data_row+']"  placeholder="Material Description" required></td>';

    html += '<td class="align-middle"><input type="text" id="mtt_piecemark_1'+count_data_row+'" class="form-control" name="mtt_piecemark_1['+count_data_row+']" placeholder="Piece Mark No" required></td>';

    html += '<td class="align-middle"><input type="text" id="mtt_grade_1'+count_data_row+'" class="form-control" name="mtt_grade_1['+count_data_row+']" placeholder="Material Grade" required></td>';

    html += '<td class="align-middle"><input type="text" id="mtt_unique_1'+count_data_row+'" class="form-control" name="mtt_unique_1['+count_data_row+']" placeholder="Uniqe Identification No" required></td>';

    html += '<td class="align-middle"><input type="text" id="mtt_heat_no_1'+count_data_row+'" class="form-control" name="mtt_heat_no_1['+count_data_row+']"  placeholder="Material Heat Number" required oninput="autocomplete_heat_number(this,'+count_data_row+',1)" onblur="detail_heat_no(this,'+count_data_row+',1)" onchange="detail_heat_no(this,'+count_data_row+',1)"></td>';

    html += '<td class="align-middle"><input type="text" id="mtt_thk_1'+count_data_row+'" class="form-control" name="mtt_thk_1['+count_data_row+']"  placeholder="Material Thickness" required></td>';

    html += '<td rowspan="2"  class="align-middle"><input type="text" id="joint_length'+count_data_row+'" class="form-control" name="joint_length['+count_data_row+']" placeholder="Joint Length" required></td>';
  
    html += '<td rowspan="2"  class="align-middle"><input type="text" id="tack_weld_id'+count_data_row+'" class="form-control" name="tack_weld_id['+count_data_row+']" placeholder="Tack Weld ID" required></td>';

    html += '<td rowspan="2"  class="align-middle"><input type="text" id="wps_no'+count_data_row+'" class="form-control" name="wps_no['+count_data_row+']" placeholder="WPS No required"></td>';

    // html += '<td rowspan="2"  class="align-middle"><select id="wps_no'+count_data_row+'" class="select2_multiple_wps" name="wps_no['+count_data_row+'][]" multiple required></select></td>';

    html += '<td rowspan="2" class="align-middle"><div class="form-check form-check-inline text-success"><input class="form-check-input" type="radio" name="inspection_result['+count_data_row+']" value="ACC" style="width: 17px; height: 17px"><label class="form-check-label"><b>ACC</b></label></div></br><div class="form-check form-check-inline text-danger"><input class="form-check-input" type="radio" name="inspection_result['+count_data_row+']" value="REJECT" style="width: 17px; height: 17px"><label class="form-check-label"><b>REJECT</b></label></div></br><div class="form-check form-check-inline text-primary"><input class="form-check-input" type="radio" name="inspection_result['+count_data_row+']" value="PENDING" style="width: 17px; height: 17px"><label class="form-check-label"><b>PENDING</b></label></div><br/></td>';

    html += '<td rowspan="2"  class="align-middle"><input type="text" id="remarks'+count_data_row+'" class="form-control" name="remarks['+count_data_row+']"  placeholder="Remarks" required></td>';
   
    html += '<td rowspan="2"  class="align-middle"><button type="button" class="btn btn-danger" title="Delete Row" onclick="deleterow(this,'+count_data_row+');"><i class="fa fa-trash"></i></button></td>';

    html += "</tr>";

    html += '<tr id="remove'+count_data_row+'">';

    html += '<td class="align-middle"><input type="text" id="mtt_desc_2'+count_data_row+'" class="form-control" name="mtt_desc_2['+count_data_row+']"  placeholder="Material Description" required></td>';

    html += '<td class="align-middle"><input type="text" id="mtt_piecemark_2'+count_data_row+'" class="form-control" name="mtt_piecemark_2['+count_data_row+']"  placeholder="Piecemark No" required></td>';

    html += '<td class="align-middle"><input type="text" id="mtt_grade_2'+count_data_row+'" class="form-control" name="mtt_grade_2['+count_data_row+']"   placeholder="Material Grade" required></td>';

    html += '<td class="align-middle"><input type="text" id="mtt_unique_2'+count_data_row+'" class="form-control" name="mtt_unique_2['+count_data_row+']"   placeholder="Unique Identification No" required></td>';

    html += '<td class="align-middle"><input type="text"   placeholder="Heat Number" id="mtt_heat_no_2'+count_data_row+'" class="form-control" name="mtt_heat_no_2['+count_data_row+']" required oninput="autocomplete_heat_number(this,'+count_data_row+',2)" onblur="detail_heat_no(this,'+count_data_row+',2)" onchange="detail_heat_no(this,'+count_data_row+',2)"></td>';

    html += '<td class="align-middle"><input type="text" id="mtt_thk_2'+count_data_row+'" class="form-control" name="mtt_thk_2['+count_data_row+']"   placeholder="Heat Number" required></td>';

    html += "</tr>";

    $('table').append(html);
   
    count_data_row++;
  }

  function deleterow(btn,no) {
    $(btn).closest('tr').remove();
    $('table#form-submit tr#remove'+no).remove();
  }

</script>

<script type="text/javascript">
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

  console.log(no);

  var heat_or_series_no = $(input).val();
  var div_certification = $(input).closest('tr').find('.certificate_list');

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

          console.log(input);
          console.log(index);
          console.log(no);

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
