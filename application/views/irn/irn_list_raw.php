<style>
    [data-tooltip] {
      position: relative;
      z-index: 2;
      cursor: pointer;
    }

    /* Hide the tooltip content by default */
    [data-tooltip]:before,
    [data-tooltip]:after {
      visibility: hidden;
      -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
      filter: progid: DXImageTransform.Microsoft.Alpha(Opacity=0);
      opacity: 0;
      pointer-events: none;
    }

    /* Position tooltip above the element */
    [data-tooltip]:before {
      position: absolute;
      bottom: 150%;
      left: 50%;
      margin-bottom: 5px;
      margin-left: -80px;
      padding: 7px;
      width: 160px;
      -webkit-border-radius: 3px;
      -moz-border-radius: 3px;
      border-radius: 3px;
      background-color: #000;
      background-color: hsla(0, 0%, 20%, 0.9);
      color: #fff;
      content: attr(data-tooltip);
      text-align: center;
      font-size: 14px;
      line-height: 1.2;
    }

    /* Triangle hack to make tooltip look like a speech bubble */
    [data-tooltip]:after {
      position: absolute;
      bottom: 150%;
      left: 50%;
      margin-left: -5px;
      width: 0;
      border-top: 5px solid #000;
      border-top: 5px solid hsla(0, 0%, 20%, 0.9);
      border-right: 5px solid transparent;
      border-left: 5px solid transparent;
      content: " ";
      font-size: 0;
      line-height: 0;
    }

    /* Show tooltip content on hover */
    [data-tooltip]:hover:before,
    [data-tooltip]:hover:after {
      visibility: visible;
      -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
      filter: progid: DXImageTransform.Microsoft.Alpha(Opacity=100);
      opacity: 1;
    }
</style>
<div id="content" class="container-fluid">
  <div class="row">
    <div class="col-md-12">

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0">Filter Data For Inspection</h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <form action="" method="POST">
            <div class="row">
               <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Project ID</label>
                  <div class="col-xl">
                    <select class="form-control" name="project" required>
                      <option value="">---</option>
                          <?php if($this->permission_cookie[0] == 1){ ?>                          
                            <?php foreach ($project_list as $key => $value) : ?>
                            <option onclick="save_project()" value="<?php echo $value['id'] ?>" <?php echo (@$user_cookie[10] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                            <?php endforeach; ?>
                          <?php } else { ?>
                            <?php foreach ($project_list as $key => $value) : ?>
                              <?php if($this->user_cookie[10] == $value['id']){ ?>
                                <option onclick="save_project()" value="<?php echo $value['id'] ?>" <?php echo (@$user_cookie[10] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                              <?php } ?>
                            <?php endforeach; ?>
                          <?php } ?>
                     <!--  <?php foreach ($project_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo ($user_cookie[10] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                      <?php endforeach; ?> -->
                    </select>
                  </div>
                </div>
              </div>
            
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Drawing Type</label>
                  <div class="col-xl">
                    <select class="form-control" name="drawing_type">
                      <option value="">---</option>
                      <option value="1" <?php echo (@$post['drawing_type'] == '1' ? 'selected' : '') ?>>GA</option>
                      <option value="2" <?php echo (@$post['drawing_type'] == '2' ? 'selected' : '') ?>>Assembly</option>
                      <option value="3" <?php echo (@$post['drawing_type'] == '3' ? 'selected' : '') ?>>Weldmap</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="row">

              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Module</label>
                  <div class="col-xl">
                    <select class="form-control" name="module">
                      <option value="">---</option>
                      <?php foreach ($module_list as $key => $value) : ?>
                      <option value="<?php echo $value['mod_id'] ?>" data-chained="<?php echo $value['project_id'] ?>" <?php echo (@$post['module'] == $value['mod_id'] ? 'selected' : '') ?>><?php echo $value['mod_desc'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Type Of Module</label>
                  <div class="col-xl">
                   <select class="form-control" name="type_of_module">
                      <option value="">---</option>
                      <?php foreach ($type_of_module_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo (@$post['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>  
            </div>

            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Discipline</label>
                  <div class="col-xl">
                    <select class="form-control" name="discipline">
                      <option value="">---</option>
                      <?php foreach ($discipline_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo (@$post['discipline'] == $value['id'] || $value['id'] == 2 ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Drawing No</label>
                  <div class="col-xl">
                    <input type="text" class="form-control autocomplete_doc" name="drawing_no" value="<?php echo @$post['drawing_no'] ?>"  >
                  </div>
                </div>
              </div>
            </div>


            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">IRN Status</label>
                  <div class="col-xl">
                    <select class="form-control" name="irn_inspection_result">
                      <option value="">---</option>
                      <option value="1">Accepted</option>
                      <option value="2">Accepted & Released With Comment</option>
                      <option value="3">Rejected</option>
                      <option value="4">Postpone</option>
                      <option value="5">Re-Offer</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">&nbsp;</label>
                  <div class="col-xl">
                    &nbsp;
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
                <div class="col-6">
                <div class="form-group row">
                 
                </div>
              </div>
             
              <div class="col-6">
                <div class="form-group row">
                  
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-12 text-right">
                <button class="mt-2 btn btn-sm btn-flat btn-info"><i class="fas fa-search"></i> Search</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0"><?php echo $meta_title ?></h6>
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
          <div class="container-fluid">

            <form action="<?php echo base_url(); ?>irn/irn_approval" method='POST' id="form_submition">

            <?php if($this->user_cookie[7] == 8){ ?>
            <input type="hidden" id='total_data_checked_val' name="total_data_checked_val" value='0'>

             <b class="text-primary"><i class="fas fa-info-circle"></i> Checked <span id='total_data_checked'>0</span> Drawing from maximum 10 Drawing per submission</b><br/><br/>

            <?php } ?>

            <table class="table table-hover text-center dataTable" width="100%">
              <thead class="bg-green-smoe text-white">
                <tr>                 
                  <th>IRN Transmittal No</th>
                  <th>Discipline</th>
                  <th>Module</th>
                  <th>Type Of Module</th>
                  <th>IRN Status</th>
                  <th width="150px;">Action</th>
                </tr>
              </thead>   
              <tbody>  

                <?php $no = 1; foreach ($irn_list as $key => $value) { ?>
                 <tr>               

                  <td><?php echo $value['irn_transmitted_no']; ?></td>
                  <td><?php echo $discipline_name[$value['irn_discipline']]; ?></td>
                  <td><?php echo $module_code[$value['irn_module']]; ?></td>
                  <td><?php if(isset($type_of_module_name[$value['irn_type_of_module']])){ echo $type_of_module_name[$value['irn_type_of_module']]; } else { echo "-"; } ?></td>
                  <td>
                     -
                  </td>                  
                  <td>
                    <?php if($this->permission_cookie[71] == 1){ ?>
                      <a href='<?php echo  base_url(); ?>irn/irn_raw_detail/<?php echo strtr($this->encryption->encrypt($value['id_irn']),'+=/', '.-~') ; ?>'>
                          <span class='btn btn-secondary'><i class="far fa-file-alt"></i></span>
                      </a>
                      &nbsp;
                      <a href='<?php echo  base_url(); ?>irn/wtr_irn/<?php echo strtr($this->encryption->encrypt($value['irn_transmitted_no']),'+=/', '.-~') ; ?>'>
                          <span class='btn btn-danger'><i class="fas fa-file-pdf"></i></span>
                      </a>
                    <?php } ?>
                  </td>

                 </tr>
                <?php  $no++; } ?>  

              </tbody>   

            </table>

          </form>

          </div>
        </div>
      </div>
  </div>
  </div>
</div>
</div>
<script type="text/javascript">

  function open_disabled_form(val,no) {

      console.log(no);

      var $checkboxes = $('#form_submition td input[type="checkbox"]');          
      $checkboxes.change(function(){
          var countCheckedCheckboxes = $checkboxes.filter(':checked').length;
          $('#total_data_checked').text(countCheckedCheckboxes);            
          $('#total_data_checked_val').val(countCheckedCheckboxes);

          if(countCheckedCheckboxes <= 10){
            if($(val).prop("checked") == true){               
               $('input[name="filter_check['+no+']"]').val(1);
            } else {         
               $('input[name="filter_check['+no+']"]').val(0);
            }
          } else {
             alert("Sorry, Data checked has been maximum..");            
             $('input[name="filter_check['+no+']"]').val(0);
          }

          // ============== FOR BUTTON ===================
          if(countCheckedCheckboxes <= 0){
            $('.btn-approval').attr('disabled', true);
          } else {
            $('.btn-approval').removeAttr('disabled');
          }
          // =============================================
      });      

  }

  $('.dataTable').DataTable({
    order: [],
    columnDefs: [{
      "targets": 0,
      "orderable": false,
    }]
  })  


   

</script>

<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.chained.min.js"></script>
<script>
    $("select[name=module]").chained("select[name=project]");
</script>
