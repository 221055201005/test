 <?php //test_var($detail_list); ?>
 <div id="content" class="container-fluid">

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <form action="" method="GET"> 
            <div class="row">  
                <div class="col-md-6">
                  <div class="form-group row"> 
                  <div class="input-group">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">IRN Report Number</label>
                        <input class="form-control autocomplete_irn_approved" id="irn_report_no" name='irn_report_no' type="search" placeholder="Search" aria-label="Search" value="<?php echo @$get['irn_report_no'] ?>" required>
                         <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" name='submit'>Search</button>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label font-weight-bold"> </label>
                    <div class="col-md"> 
                    </div>
                  </div>
                </div> 
              </div> 
          </form>
        </div>
      </div>
    </div>
  </div>
 

  <?php if(isset($get['submit'])): ?>

    <?php if($categories_irn == 1){ ?>

    <form id="form_create_workpack" method="POST" action="<?php echo base_url() ?>planning/workpack_new_process_bnp">

        
             
      <div class="row">
        <div class="col">
          <div class="card shadow my-3 rounded-0">
            <div class="card-header">
              <h6 class="m-0"><?php echo $meta_title ?></h6>
            </div>
            <div class="card-body bg-white"> 
                <input type="hidden" name="irn_report_no" value="<?php echo $irn_report_number ?>"> 
                <input type="hidden" name="categories_irn" value="<?php echo $categories_irn ?>"> 

                <input type="hidden" name="project" value="<?php echo $detail_list[0]["project"] ?>"> 
                <input type="hidden" name="discipline" value="<?php echo $detail_list[0]["discipline"] ?>"> 
                <input type="hidden" name="module" value="<?php echo $detail_list[0]["module"] ?>"> 
                <input type="hidden" name="type_of_module" value="<?php echo $detail_list[0]["type_of_module"] ?>"> 
                <input type="hidden" name="desc_assy" value="<?php echo $detail_list[0]["description_assy"] ?>"> 
                <input type="hidden" name="deck_elevation" value="<?php echo $detail_list[0]["deck_elevation"] ?>"> 

                <input type="hidden" name="template_id"> 

                <div class="overflow-auto"> 
                  <table class="table table-hover text-center dataTable">
                    <thead class="bg-green-smoe text-white">
                      <tr>
                        <th rowspan='2'><input type='checkbox' class='checkbox-big' name="check_all" onclick='checkall(this)'></th>
                        <th rowspan='2'>Drawing<br/>Number</th>
                        <th rowspan='2'>Tag<br/>Number</th>
                        <th rowspan='2'>Drawing Assembly</th>
                        <th colspan='9' style='text-align:center;'>Material Traceability</th> 
                        <th rowspan='2' style='text-align:center;'>MRIR Attachment</th> 
                      </tr>
                      <tr>
                                <th>Piecemark<br/>No.</th>
                                <th>Paint System</th>
                                <th>Unique<br/>No.</th> 
                                <th>Profile</th> 
                                <th>Size / Dia</th> 
                                <th>Length</th> 
                                <th>Area<br/>m2</th> 
                                <th>THK</th> 
                                <th>Material<br/>Status</th> 
                            </tr>
                    </thead>
                    <tbody>
                      <?php $no= 0; foreach ($detail_list as $key => $value): ?>

                        <?php  

                                    if(isset($value['drawing_as']) && !empty($value['drawing_as'])){
                                        $weldmap_material = substr($value['drawing_as'],-13);
                                    } else {
                                        $weldmap_material = substr($value['drawing_ga'],-20);
                                    }  
                            
                                    if(isset($warehouse_mis_mrir[$status_piecemark[$value['part_id']]['id_mis']]['unique_ident_no'])){
                                        $uniq_no_p1 = $warehouse_mis_mrir[$status_piecemark[$value['part_id']]['id_mis']]['unique_ident_no'];
                                    } else {
                                        $uniq_no_p1 = "-";
                                    } 

                                    if($uniq_no_p1 != "-"){ 
                                        if(isset($list_unique_data[$uniq_no_p1])){
                                            $list_of_attachment = array(); 
                                            foreach($list_unique_data[$uniq_no_p1] as $key => $vx){ 
                                            $list_of_attachment[] = "<a target='_blank' href='https://www.smoebatam.com/warehouse_ori/file/mrir/cm/".$vx["document_file"]."'  style='display: inline-block !important;'>".$vx["document_name"]."</a>";
                                            }
                                            $show_attachment = implode("<br/><br/>",$list_of_attachment);
                                        } else {
                                            $show_attachment = "-";
                                        }
                                    } else {
                                    $show_attachment = "-";
                                    } 

                                    if(isset($status_piecemark[$value['part_id']]['profile'])){
                                        $profile_p1 = $status_piecemark[$value['part_id']]['profile'];
                                    } else {
                                        $profile_p1 = "-";
                                    } 

                                    if(isset($status_piecemark[$value['part_id']]['diameter'])){
                                        $diameter_p1 = $status_piecemark[$value['part_id']]['diameter'];
                                    } else {
                                        $diameter_p1 = "-";
                                    }

                                    if(isset($status_piecemark[$value['part_id']]['length'])){
                                        $length_p1 = $status_piecemark[$value['part_id']]['length'];
                                    } else {
                                        $length_p1 = "-";
                                    } 

                                    if(isset($status_piecemark[$value['part_id']]['area'])){
                                        $area_p1 = $status_piecemark[$value['part_id']]['area'];
                                    } else {
                                        $area_p1 = "-";
                                    }

                                    if(isset($status_piecemark[$value['part_id']]['can_number'])){
                                    $can_number = $status_piecemark[$value['part_id']]['can_number'];
                                    } else {
                                    $can_number = "-";
                                    }

                                    if(isset($status_piecemark[$value['part_id']]['thickness'])){
                                        $thickness_p1 = $status_piecemark[$value['part_id']]['thickness'];
                                    } else {
                                        $thickness_p1 = "-";
                                    } 

                                    $project_id               = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['project_code']),'+=/', '.-~');
                                    $discipline               = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['discipline']),'+=/', '.-~');
                                    $type_of_module           = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['type_of_module']),'+=/', '.-~');
                                    $module                   = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['module']),'+=/', '.-~');
                                    $report_no                = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['report_number']),'+=/', '.-~');
                                    $report_no_rev            = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['report_no_rev']),'+=/', '.-~');
                                    $submission_id            = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['submission_id']),'+=/', '.-~');

                                    if(isset($status_piecemark[$value['part_id']]['status_inspection'])){
                                        if($status_piecemark[$value['part_id']]['status_inspection'] >= 3){
                                            if(isset($status_piecemark[$value['part_id']]['report_number'])){
                                            $status_inspection_p1 = '<a target="_blank" href="'.base_url().'material_verification/material_verification_pdf_client/'.$project_id.'/'.$discipline.'/'.$type_of_module.'/'.$module.'/'.$report_no.'/'.$report_no_rev.'">COMPLETED</a>';
                                            } else {
                                            $status_inspection_p1 = '<a target="_blank" href="'.base_url().'material_verification/material_verification_pdf/'.$submission_id.'">COMPLETED</a>';
                                            }                                               
                                        } else {
                                        $status_inspection_p1 ='OS';	
                                        }
                                        
                                    } else {
                                        $status_inspection_p1 = "-";
                                    }
                    
                                    $status_fitup = "-"; 
                                    $status_visual ="-";
                                    $status_MT_show = "-";
                                    $status_PT_show = "-";
                                    $status_UT_show = "-";
                                    $status_RT_show = "-";
                            ?>

                      <tr>
                        <td>
                          <?php if(!isset($data_submited[$value['id']][1])){ ?>
                            <input type='checkbox' class='checkbox-big' value='<?php echo $value['id'] ?>' onclick='save_checkbox(this,"<?= $no ?>")'>
                          <?php } else { ?>
                             <span class='btn btn-success'><i class="fas fa-check-square"></i></span>
                          <?php } ?>
                        </td>
                        <td>
                            <?= $value['drawing_ga'] ?>
                        </td>
                        <td><?= $can_number ?></td>
                        <td><?= $value['drawing_as'] ?></td>
                        <td><?= $value['part_id'] ?></td>
                        <td> 
                          <?= (isset($data_submited[$value['id']][1]) ? "<span class='badge badge-primary'>".$data_submited[$value['id']][1]["workpack_no"]."</span>" : null ) ?>
                          <input type='hidden' name='filter_check[<?= $no ?>]' value='0'> 

                          <?php if(!isset($data_submited[$value['id']][1])){ ?>
                          
                          <select  name='paint_system[<?php echo $value['id'] ?>][]' class='form-control select2_multiple_paint_system' multiple>
                            <?php foreach($get_paint_system as $keyx => $valx){ ?>
                              <option value='<?= $valx['id'] ?>'><?= $valx['code'] ?></option>
                            <?php } ?>
                          </select>

                          <?php } ?>


                        </td>
                        <td><?= $uniq_no_p1 ?> </td>
                        <td><?= $profile_p1 ?> </td>
                        <td><?= $diameter_p1 ?> </td>
                        <td><?= $length_p1 ?> </td>
                        <td><?= $value["area"] ?> </td>
                        <td><?= $thickness_p1 ?> </td>
                        <td><?= $status_inspection_p1 ?> </td> 
                        <td><?= $show_attachment ?></td>
                      </tr>
                      <?php $no++; endforeach; ?>
                    </tbody>
                  </table>
                </div> 
                <br>
                <div class="col-md-4">
                  <div class="font-weight-bold">
                    You tick <span class="text-success num_ticker">0</span> piecemark to create workpack.<br>
                  </div>
                  <div class="row mb-1">
                    <div class="col-md-12">
                      <button type="button" class="btn btn-flat btn-success" onclick="create_workpack()"><i class='fas fa-check'></i> Create Workpack.</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div> 
     
      <?php } else { ?>

        <form id="form_create_workpack" method="POST" action="<?php echo base_url() ?>planning/workpack_new_process_bnp">

       

      <div class="row">
        <div class="col">
          <div class="card shadow my-3 rounded-0">
            <div class="card-header">
              <h6 class="m-0"><?php echo $meta_title ?></h6>
            </div>
            <div class="card-body bg-white">

                <input type="hidden" name="irn_report_no" value="<?php echo $irn_report_number ?>"> 
                <input type="hidden" name="categories_irn" value="<?php echo $categories_irn ?>"> 
                <input type="hidden" name="template_id"> 
                <input type="hidden" name="project" value="<?php echo (isset($detail_list[0]["project"]) ? $detail_list[0]["project"] : null ) ?>"> 
                <input type="hidden" name="discipline" value="<?php echo (isset($detail_list[0]["discipline"]) ? $detail_list[0]["discipline"] : null ) ?>"> 
                <input type="hidden" name="module" value="<?php echo (isset($detail_list[0]["module"]) ? $detail_list[0]["module"]: null ) ?>"> 
                <input type="hidden" name="type_of_module" value="<?php echo (isset($detail_list[0]["type_of_module"]) ? $detail_list[0]["type_of_module"]: null ) ?>"> 
                <input type="hidden" name="desc_assy" value="<?php echo (isset($detail_list[0]["description_assy"]) ? $detail_list[0]["description_assy"]: null ) ?>"> 
                <input type="hidden" name="deck_elevation" value="<?php echo (isset($detail_list[0]["deck_elevation"]) ? $detail_list[0]["deck_elevation"]: null ) ?>"> 

                  <table class="table table-hover text-center dataTable">
                    <thead class="bg-green-smoe text-white">
                      <tr>
                        <th><input type='checkbox' class='checkbox-big' name="check_all" onclick='checkall(this)'></th>
                        <th>No</th>
                        <th>Drawing WM</th>
                        <th>Rev WM</th>
                        <th>Joint No.</th>
                        <th>Piecemark#1</th>
                        <th>Piecemark#2</th>
                        <th>Weld Type Code</th>
                        <th>Thickness</th>
                        <th>Diameter</th>
                        <th>Schedule</th>
                        <th>Length</th>
                        <th>Weld Length</th>
                        <th>Joint Type Code</th>
                        <th>Class Code</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no= 1; foreach ($detail_list as $key => $value): ?>
                      <tr>
                        <td><input type='checkbox' class='checkbox-big' value='<?php echo $value['id'] ?>' onclick='save_checkbox(this,"<?= $no ?>")'></td>
                        <td><?php echo $no ?></td>
                        <td><?php echo $value['drawing_wm'] ?></td>
                        <td><?php echo $value['rev_wm'] ?></td>
                        <td><?php echo $value['joint_no'] ?></td>
                        <td><?php echo $value['pos_1'] ?></td>
                        <td><?php echo $value['pos_2'] ?></td> 
                        <td><?php echo @$weld_type[$value['weld_type']]['weld_type_code'] ?></td>
                        <td><?php echo $value['thickness'] ?></td>
                        <td><?php echo $value['diameter'] ?></td>
                        <td><?php echo $value['sch'] ?></td>
                        <td><?php echo $value['length'] ?></td>
                        <td><?php echo $value['weld_length'] ?></td>
                        <td><?php echo @$joint_type[$value['joint_type']]['joint_type_code'] ?></td>
                        <td><?php echo $class_list[$value['class']]?></td>
                      </tr>
                      <?php $no++; endforeach; ?>
                    </tbody>
                  </table>   
            </div>
            <br>
                <div class="col-md-4">
                  <div class="font-weight-bold">
                    You tick <span class="text-success num_ticker">0</span> joint to create workpack.<br>
                  </div>
                  <div class="row mb-1">
                    <div class="col-md-12">
                      <button type="button" class="btn btn-flat btn-success" onclick="create_workpack()"><i class='fas fa-check'></i> Create Workpack.</button>
                    </div>
                  </div>
                </div>
          </div>
        </div>
      </div>

      </form>

      <?php } ?>


  <?php endif; ?>

</div>
</div>
<script>
  $("select[name=module]").chained("select[name=project]");
  
  $(document).ready(function(){ 
    selectRefresh();    
  });

  function selectRefresh() {     
    $(".select2_multiple_activity").select2({ 
        allowClear: true,
        tokenSeparators: [', ', ' '],
    }) 
    $(".select2_multiple_paint_system").select2({ 
        tokenSeparators: [', ', ' '],
    }) 
  }
  

  $('.dataTable').DataTable({
    lengthMenu: [[-1], ['All']],
    order: [],
    columnDefs: [{
      "targets": 0,
      "orderable": false,
    }]
  })

  var data_checkbox = [];
  function save_checkbox(input,no) {

    if($('input[name="filter_check['+no+']"]').val() == 0){
      $('input[name="filter_check['+no+']"]').val(1);
    } else {
      $('input[name="filter_check['+no+']"]').val(0);
    }

    
    if($(input).prop("checked") == true && $.inArray($(input).val(), data_checkbox) == -1){
      data_checkbox.push($(input).val());

			$(input).closest('tr').find('select').prop('required', true);
    }
    else if($(input).prop("checked") == false && $.inArray($(input).val(), data_checkbox) != -1){
      data_checkbox.splice( $.inArray($(input).val(), data_checkbox), 1 );
			$(input).closest('tr').find('select').prop('required', false);
    }
    $(".num_ticker").html(data_checkbox.length)
  }

  function checkall(input) {
    $('#form_create_workpack input[type=checkbox]').each(function(i, obj) {
      if($(input).prop("checked") == true && $(obj).prop("checked") == false){
        $(obj).trigger("click");
        console.log("all"+$(obj).val());
      }
      else if($(input).prop("checked") == false && $(obj).prop("checked") == true){
        $(obj).trigger("click");
      }
    });
  }

  function create_workpack() {
     
      if(data_checkbox.length > 0){
				if (document.getElementById("form_create_workpack").checkValidity()) {
					sweetalert("loading", "Please wait...!");
					$("#form_create_workpack input[name=template_id]").val(data_checkbox.join(", "));
					document.getElementById("form_create_workpack").submit();
				} else {
					document.getElementById("form_create_workpack").reportValidity();
				}
      }
      else{
        sweetalert("error", "No item selected!");
      } 

  }

  $(".autocomplete_irn_approved").autocomplete({
    source: function( request, response ) {  
      $.ajax( {
        url: "<?php echo base_url() ?>planning/autocomplete_irn_approved/<?= $type ?>",
        dataType: "json",
        data: {
          term: request.term, 
        },
        success: function( data ) { 
          response( data );
        }
      });
    },
    // select: function (event, ui) {
    //   var value = ui.item.value;
    //   console.log(value);
    //   if(value == 'No Data.'){
    //     ui.item.value = "";
    //   } else {
        
    //   }
    // }
  });

   
</script>