<?php
//   error_reporting(0); 
?>
 

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>

<div id="content" class="container-fluid">
  

    <div class="row">
        <div class="col">
            <div class="card shadow my-3 rounded-0">
                <div class="card-header"> 
                    <h6 class="m-0">Material Verification | Filter Piecemark for Submission</h6> 
                </div>
                <div class="card-body bg-white overflow-auto">
                <form action="" method="POST" id='form-filter'>

            <div class="row"> 

               <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label text-muted ">Project ID</label>
                  <div class="col-xl">
                    <select class="form-control" name="project" required  >
                      <option value="">---</option>
                      <?php foreach ($project_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?= @$post["project"] == $value['id'] ? "selected" : null ?>><?php echo $value['project_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label text-muted ">Discipline</label>
                  <div class="col-xl">
                    <select class="form-control" name="discipline" >
                      <option value="">---</option>
                      <?php foreach ($discipline_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?= @$post["discipline"] == $value['id'] ? "selected" : null ?>><?php echo $value['discipline_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

            </div> 

            <div class="row">

            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Drawing Number</label>
                    <div class="col-md-8 col-lg-9">
                        <select type="text" class="form-control select2" name="drawing_no" >
                            <option value=''>~ Choose ~</option>
                            <?php foreach($drawing_no_view as $key => $value){ ?> 
                            <option value='<?php echo $value ?>'> <?= @$post["drawing_no"] == $value ? "selected" : null ?><?php echo $value ?></option>
                            <?php } ?>
                        <select> 
                    </div>
                </div>
            </div> 

              <div class="col-6">
                <div class="form-group row">
                <label class="col-md-4 col-lg-3 col-form-label text-muted ">Deck Elevation / Service Line</label>
                  <div class="col-xl">
                    <select type="text" class="form-control select2" name="deck_elevation" >
                        <option value=''>~ Choose ~</option>
                        <?php foreach($deck_list as $key => $value){ ?> 
                        <option value='<?php echo $value["id"] ?>'> <?= @$post["deck_elevation"] == $value['id'] ? "selected" : null ?><?php echo $value["name"] ?></option>
                        <?php } ?>
                    <select> 
                  </div>
                </div>
              </div>  

            </div>   
            
            <div class="row">
              <div class="col-12 text-right">
                <hr>
                  <?php //if(!isset($post) OR empty($post)){ ?>
                    <button id='button_search' class="mt-2 btn btn-sm btn-flat btn-info"><i class="fas fa-search"></i> Search</button>
                  <?php //} ?>
                  <button type="button" class="mt-2 btn btn-sm btn-flat btn-warning" onclick="reset_pages();"><i class="fas fa-sync-alt"></i> Reset</button>
              </div>            
            </div>
          </form>
                </div>
            </div>
        </div>
    </div> 
 

    <?php if(sizeof($post) > 0){ ?>

    <form action="<?= site_url('planning/reset_piecemark') ?>" method="post" onsubmit="if( _formConfirm_submitted == false ){ _formConfirm_submitted = true;return true }else{ alert('Please Wait, Server still busy, wait till process done, Thanks!'); return false;  }" enctype="multipart/form-data" >

    <div class="row">
      <div class="col">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0"><?php echo $meta_title ?></h6>
          </div>
          <div class="card-body bg-white">
            <div class="overflow-auto">
              <table class="table table-hover text-center dataTable" id='table_submission'>
                <thead class="bg-green-smoe text-white">
                  <tr>
                    <th>#</th>
                    <th>Drawing GA</th>
                    <th>Drawing AS</th>
                    <th>Rev AS</th>
                    <th>Piecemark</th>
                    <th>Unique Material Id</th>
                    <th>Heat No</th>
                    <th>Material</th>
                    <th>Profile</th>
                    <th>Grade</th>
                    <th>Thickness</th>
                    <th>Weight (kg)</th>  
                  </tr>
                </thead>
                <tbody>
                  <?php $no_submitted = 0; foreach ($piecemark_list as $key => $value):  if(!isset($value['id_piecemark'])){ $no_submitted++; }  if($value['report_resubmit_status'] == 0 OR !isset($value['report_resubmit_status'])){ ?>
                  <tr>
                    <td>   
                        <input type="hidden" name="id_material[<?= $key ?>]" value="<?= $value['id_material'] ?>">  
                        <input type="hidden" name="id_piecemark[<?= $key ?>]" value="<?= $value['id_pc_temp'] ?>">  
                        <input type="hidden" name="id_workpack[<?= $key ?>]" value="<?= $value['id_workpack'] ?>">  
                        <input type="hidden" name="id_workpack_detail[<?= $key ?>]" value="<?= $value['workpack_detail_id'] ?>">  
                        <input type="checkbox" class="checkbox-big check" name="id[<?= $key ?>]" value="<?= $value['id_pc_temp'] ?>" style="zoom : 1.5;"> 
                      
                    </td>
                    <td><?php echo @$value['drawing_ga'] ?></td>
                    <td><?php echo @$value['drawing_as'] ?></td>
                    <td><?php echo $value['rev_as'] ?></td>
                    <td><?= $value['part_id'] ?></td>
                    <td>      
                      <input type="text" name="unique_no[<?= $key ?>]" class="form-control editable" onfocus="autocomplete_unique(this, '<?= $value['workpack_no'] ?>', <?= $value['grade'] ?>,  <?= $value['id_workpack'] ?>)" placeholder="Unique Number" value="<?= isset($mis_detail[$value['id_mis']]) ? $mis_detail[$value['id_mis']]['unique_ident_no'] : '' ?>" onblur="validate_unique_no(this, '<?= $value['workpack_no'] ?>', <?= $value['grade'] ?>, <?= $value['id_workpack'] ?>)" onkeydown="validate_unique_no(this, '<?= $value['workpack_no'] ?>', <?= $value['grade'] ?>,  <?= $value['id_workpack'] ?>)" onmousedown="validate_unique_no(this, '<?= $value['workpack_no'] ?>', <?= $value['grade'] ?>, <?= $value['id_workpack'] ?>)" required disabled>
                      <div class="invalid-feedback"></div> 
                    </td>
                    <td>
                      <input type="text" class="form-control heat_no" placeholder="Heat Number"  value="<?= isset($mis_detail[$value['id_mis']]) ? $mis_detail[$value['id_mis']]['heat_or_series_no'] : '-' ?>"
                        disabled>
                      </td>
                    <td><?php echo $value["material"] ?></td>
                    <td><?php echo $value["profile"] ?></td>
                    <td><?php echo @$material_grade_list[$value["grade"]]['material_grade'] ?></td>
                    <td><?php echo $value["thickness"] ?></td>
                    <td><?php echo round($value["weight"],2); ?></td>                   
                     
                            
                  </tr>
                  <?php } endforeach; ?>
                </tbody>
              </table>
            </div>  
            
            <br>
            <br>
            <div class="text-right"> 
              <button type="submit" id="btn_submit" class="btn btn-success"><i class="fas fa-check"></i>  Reset Progress</button> 
            </div>

             
                  
          </div>
        </div>
      </div>
    </div>

    </form>

    <?php } ?>
 

</div>
</div>
<script>
    function autofilter(){
       $('#form-filter').submit();
    } 

    $("select[name=module]").chained("select[name=project]");

    $('.dataTable').DataTable({
        lengthMenu: [ [-1], ["All"] ],
        order: [],
        columnDefs: [{
            "targets": 0,
            "pageLength": 10
            //"orderable": false,
        }]
    })  

    $(document).ready(function() { 

        $(".select2_multiple_status_surveyor").select2({
            tokenSeparators: [',', ' '],
        }) 
          
    });
  
    $("select[name=location]").chained("select[name=area]");
</script>