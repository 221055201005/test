<?php $main_data = $itr_submission[0]; ?>
<?php
    if($main_data['ga_rev_no'] != '') {
        $drawing_ga_rev     = $main_data['ga_rev_no'];
    } else {
         $drawing_ga_rev = $main_data['rev_ga'];
    }
 
    $latest_ga_rev = $drawing_ga_rev; 
    $show_attachment_drawing = false;

    if (isset($drawing_eng[$main_data['drawing_ga']])) {
    $show_attachment_drawing = true;
    $links_atc        = base_url_ftp_eng() . "public_smoe/open_atc/2/" . strtr($this->encryption->encrypt($drawing_eng[$main_data['drawing_ga']]['id']), '+=/', '.-~') . '/' . $drawing_ga_rev . '/' . strtr($this->encryption->encrypt(1), '+=/', '.-~');
    $links_atc_cross  = base_url_ftp_eng() . "public_smoe/open_atc_cross/2/" . strtr($this->encryption->encrypt($drawing_eng[$main_data['drawing_ga']]['document_no']), '+=/', '.-~') . "/" . strtr($this->encryption->encrypt($drawing_eng[$main_data['drawing_ga']]['id']), '+=/', '.-~') . '/' . $drawing_ga_rev . '/' . strtr($this->encryption->encrypt(1), '+=/', '.-~');
    }
?>

<div id="content" class="container-fluid"> 

<script type="text/javascript">
var _formConfirm_submitted = false;
</script>

<form action="<?= site_url('planning/process_resubmit_itr') ?>" method="post" onsubmit="if( _formConfirm_submitted == false ){ _formConfirm_submitted = true;return true }else{ alert('Please Wait, Server still busy, wait till process done, Thanks!'); return false;  }" enctype="multipart/form-data" >

<div class="row">
    <div class="col">
        <div class="card shadow my-3 rounded-0">
            <div class="card-header"> 
                <h6 class="m-0"><?= $meta_title ?></h6> 
            </div>
                <div class="card-body bg-white overflow-auto">  
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Drawing GA</label>
                    <div class="col-xl">
                        <input type="text" class="form-control" value="<?= $main_data['drawing_ga'] ?> Rev. <?= $main_data['rev_ga'] ?>" disabled>
                        <?php if ($show_attachment_drawing) : ?>
                        <div class="mt-2">
                            <a target="_blank" href="<?= $links_atc ?>"><i class="fas fa-paperclip"></i> Open Drawing</a>
                            <a target="_blank" href="<?= $links_atc_cross ?>"><i class="ml-3 fas fa-cloud-download-alt"></i>
                            Download Drawing</a>
                        </div>
                        <?php endif; ?>

                    </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Workpack Number</label>
                    <div class="col-xl">
                        <input type="text" class="form-control" value="<?= $main_data['workpack_no'] ?>" disabled>
                    </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Discipline</label>
                    <div class="col-xl">
                        <input type="text" class="form-control" value="<?= $discipline_list[$main_data['discipline']]['discipline_name'] ?>" disabled>
                    </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Project Name</label>
                    <div class="col-xl">
                        <input type="text" class="form-control" value="<?= $project_list_show[$main_data['project']]["project_name"] ?>" disabled>
                    </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Module</label>
                    <div class="col-xl">
                        <input type="text" class="form-control" value="<?= $module_list[$main_data['module']]['mod_desc'] ?>" disabled>
                    </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Company</label>
                    <div class="col-xl">
                        <input type="text" class="form-control" value="<?= $company_name[$main_data['company_id']] ?>" disabled>
                    </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Type Of Module</label>
                    <div class="col-xl">
                        <input type="text" class="form-control" value="<?= $type_of_module_list[$main_data['type_of_module']]['name'] ?>" disabled>
                    </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <hr>
                </div>

                <div class="col-md-6">
                    <div class="form-group row">
                    <label for="" class="col-xl-3 col-form-label text-muted">Area</label>
                    <div class="col-xl">

                        <?php if ($user_permission[22] == 1) : ?>
                        <select class="select2 select_area" name="area_v2" onchange="get_location_list(this)" style="width:100%" <?= $user_permission[22] == 1 ? '' : 'disabled' ?>>
                            <option value="">---</option>
                            <?php foreach ($area_v2 as $key => $value) : ?>
                            <option value="<?= $value['id'] ?>" <?= $value['id'] == $main_data['area_v2'] ? 'selected' : '' ?>>
                                <?= $value['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php else : ?>

                        <?php if ($main_data['area_v2']) : ?>
                            <select class="select2 select_area" style="width:100%" <?= $user_permission[22] == 1 ? 'disabled' : 'disabled' ?>>
                            <?php foreach ($area_v2 as $key => $value) : ?>
                                <option value="<?= $value['id'] ?>" <?= $value['id'] == $main_data['area_v2'] ? 'selected' : '' ?>>
                                <?= $value['name'] ?></option>
                            <?php endforeach; ?>
                            </select>

                        <?php else : ?>

                            <select class="select2 select_area" style="width:100%" <?= $user_permission[22] == 1 ? 'disabled' : 'disabled' ?>>
                            <?php foreach ($area_list as $key => $value) : ?>
                                <option value="<?= $value['id'] ?>" <?= $value['id'] == $main_data['area'] ? 'selected' : '' ?>>
                                <?= $value['area_name'] ?></option>
                            <?php endforeach; ?>
                            </select>
                        <?php endif; ?>

                        <?php endif; ?> 
                        
                    </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group row">
                    <label class="col-xl-3 col-form-label text-muted"> Location</label>
                    <div class="col-xl">
                        <select name="location_v2" onchange="get_point_list(this) " class="select2" style="width: 100%;" <?= $user_permission[22] == 1 ? '' : 'disabled' ?>>
                        <option value="">---</option>
                        <?php foreach ($location_v2 as $key => $value) : ?>
                            <option value="<?= $value['id'] ?>" <?= $value['id'] == $main_data['location_v2'] ? 'selected' : '' ?>><?= $value['name'] ?>
                            </option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group row">
                    <label class="col-xl-3 col-form-label text-muted"> Point</label>
                    <div class="col-xl">
                        <select name="point_v2" class="select2" style="width: 100%;" <?= $user_permission[22] == 1 ? '' : 'disabled' ?>>
                        <option value="0">---</option>
                        <?php foreach ($point_list as $key => $value) : ?>
                            <option value="<?= $value['id'] ?>" <?= $value['id'] == $main_data['point_v2'] ? 'selected' : '' ?>><?= $value['name'] ?>
                            </option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="float-right">
                    <button type="button" onclick="update_data(this)" class="btn btn-warning"><i class="fas fa-edit"></i>
                        Update Location</button>
                    </div>
                </div> 
            </div>
                </div>
        </div>
    </div>
</div> 
 


  <div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="pb-2 mb-0"><?php echo $meta_title ?></h6>
    <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
      <div class="container-fluid">
        <table class="table table-hover text-center dataTable" width="100%">
          <thead class="bg-green-smoe text-white">
            <tr>  
                <th>#</th>
                <th>Piece Mark / Tag No</th>
                <th>Unique No</th>
                <th>Heat No</th>
                <th>WPS</th>
                <th>Consumable Lot No.</th>
                <th>Welder ID</th>
                <th>Surveyor Submission</th>
                <th>Inspection Status</th> 
            </tr>
          </thead>   
          <tbody>
            <?php 
            $no_rejected = 0;
              foreach ($itr_submission as $key => $value) {   
            ?>
            <tr>
                <td>
                <?php if($value['status_inspection'] == 2 && $value['status_delete'] == 0){ $no_rejected++; ?> 
                    <input type="checkbox" class="checkbox-big check" name="id[<?= $key ?>]" value="<?= $value['id_itr'] ?>" style="zoom : 1.5;"> 
                    <input type="hidden" name="project" value="<?= $value['project'] ?>"> 
                    <input type="hidden" name="discipline" value="<?= $value['discipline'] ?>"> 
                    <input type="hidden" name="module" value="<?= $value['module'] ?>"> 
                    <input type="hidden" name="type_of_module" value="<?= $value['type_of_module'] ?>"> 
                    <input type="hidden" name="company_id" value="<?= $value['company_id'] ?>"> 
                    <input type="hidden" name="id_mis[<?= $key ?>]" class="id_mis" value='<?= ( isset($value['id_mis']) ? $value['id_mis'] : '') ?>'>  
                <?php } ?>
                </td>
                    <td>
                        <?= $value['part_id'] ?> <br/><br/>
                        <?php if ($piecemark_photo[$value['id_piecemark']]['evidence_itr'] != null) : ?>
                            <?php
                                $url_image = base_url();
                                $enc_img              = strtr($this->encryption->encrypt($piecemark_photo[$value['id_piecemark']]['evidence_itr']), '+=/', '.-~');
                                $enc_location         = strtr($this->encryption->encrypt('/PCMS/mobile/pcms_v2_mobile/pcms_v2_photo'), '+=/', '.-~');
                                $open_img             = site_url('irn/open_file/' . $enc_img . '/' . $enc_location . '/download');
                            ?> 
                            <a href="<?= $open_img ?>" target="_blank" class="btn btn-primary"><i class="fas fa-image"></i></a>
                        <?php else : ?> 
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($value['status_inspection'] == 2 && $value['status_delete'] == 0){ ?>
                            <input type="text" name="unique_no[<?= $key ?>]" class="form-control" 
                                onfocus="autocomplete_unique(this, '<?= $value['workpack_no'] ?>', '<?= $value['grade'] ?>', '<?= $value['id_workpack'] ?>')" 
                                placeholder="Unique Number" 
                                value="<?= isset($detail_mis[$value['id_mis']]['unique_no']) ? $detail_mis[$value['id_mis']]['unique_no'] : '' ?>" 
                                onblur="validate_unique_no(this, '<?= $value['workpack_no'] ?>', '<?= $value['grade'] ?>', '<?= $value['id_workpack'] ?>')" 
                                required
                            >
                            <div class="invalid-feedback"></div>  
                        <?php } else { ?>
                            <?= $detail_mis[$value['id_mis']]['unique_no'] ?>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if($value['status_inspection'] == 2 && $value['status_delete'] == 0){ ?>
                            <input type="text" class="form-control heat_no" placeholder="Heat Number"  value="<?= isset($detail_mis[$value['id_mis']]['heat_or_series_no']) ? $detail_mis[$value['id_mis']]['heat_or_series_no'] : '-' ?>" disabled>
                        <?php } else { ?>    
                            <?= $detail_mis[$value['id_mis']]['heat_or_series_no'] ?>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if($value['status_inspection'] == 2 && $value['status_delete'] == 0){ ?>
                            <select  class='select2_multiple_wps  editable' name='wps_id[<?php echo $key; ?>][]' multiple required>
                               <?php 
                                 foreach (explode(";", $value['wps_id']) as $v) {
                                     echo "<option value='".$v."' selected>".$wps[$v]['wps_no']."</option>";
                                 }
                               ?>
                            </select>
                        <?php } else { ?>       
                            <?php if ($value['wps_id']) : ?>
                                <?php
                                    $list_wps = [];
                                    foreach (explode(";", $value['wps_id']) as $v) {
                                        $list_wps[] = $wps[$v]['wps_no'];
                                    }
                                ?>
                                <?= implode(',<br>', $list_wps) ?>
                            <?php else : ?>
                                -
                            <?php endif; ?>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if($value['status_inspection'] == 2 && $value['status_delete'] == 0){ ?>
                            <select class="form-control select2-multiple-tags editable" name="cons_lot_no[<?php echo $key; ?>][]" multiple required>
                                <?php 
                                    foreach (explode(";", $value['cons_lot_no']) as $v) {
                                        echo "<option selected>".$v."</option>";
                                    }
                                ?>
                            </select>
                        <?php } else { ?>
                            <?php
                                $list_cons_lot_no = [];
                                foreach (explode(";", $value['cons_lot_no']) as $v) {
                                    $list_cons_lot_no[] = $v;
                                }
                            ?>
                            <?= implode(',<br>', $list_cons_lot_no) ?> 
                        <?php } ?>
                    </td>
                    <td>
                        <?php if($value['status_inspection'] == 2){ ?>
                            <select  class='select2_multiple_welder' name='welder_id[<?php echo $key; ?>][]' multiple required>
                                <?php 
                                 foreach (explode(";", $value['welder_id']) as $v) {
                                     echo "<option value='".$v."' selected>".$welder[$v]['welder_code']."</option>";
                                 }
                               ?>
                            </select>
                        <?php } else { ?>    
                            <?php if ($value['welder_id']) : ?>
                                <?php
                                    $list_welder = [];
                                    foreach (explode(";", $value['welder_id']) as $v) {
                                        $list_welder[] = $welder[$v]['rwe_code'];
                                    }
                                ?>
                                <?= implode(',<br>', $list_welder) ?>
                            <?php else : ?>
                                -
                            <?php endif; ?>
                        <?php } ?>
                    </td>
                    <td>
                        <table class="table table-borderless table-sm" style="font-size: 11px;">
                        <tbody> 
                            <tr>
                            <td class="text-nowrap"><strong><i>Action By</i></strong></td>
                            <td class="text-nowrap">:</td>
                            <td class="text-nowrap"><?= (isset($value['surveyor_creator']) ? $user_list[$value['surveyor_creator']] : null ) ?></td>
                            </tr>
                            <tr>
                            <td class="text-nowrap"><strong><i>Action Date</i></strong></td>
                            <td class="text-nowrap">:</td>
                            <td class="text-nowrap"><?= (isset($value['surveyor_creator']) ? $value['surveyor_created_date'] : null ) ?></td>
                            </tr>
                        </tbody>
                        </table>  
                    </td>  
                    <td>  
                        <table class="table table-borderless table-sm" style="font-size: 11px;">
                        <tbody>
                        <tr>
                            <td class="text-nowrap"><strong><i>Inspection Result</i></strong></td>
                            <td class="text-nowrap">:</td>
                            <td class="text-nowrap">
                                <?php if ($value['status_inspection'] == 3 || $value['status_inspection'] >= 5) : ?>
                                    <span class="badge badge-success badge badge-pill ml-4">Approved</span>
                                <?php elseif ($value['status_inspection'] == 2) : ?>
                                    <span class="badge badge-danger badge badge-pill ml-4">Rejected</span>
                                <?php elseif ($value['status_inspection'] == 4) : ?>
                                    <span class="badge badge-info badge badge-pill ml-4">Pending By QC</span> 
                                <?php endif; ?>
                            </td>
                            </tr>
                            <tr>
                            <td class="text-nowrap"><strong><i>Last Inspection By</i></strong></td>
                            <td class="text-nowrap">:</td>
                            <td class="text-nowrap"><?= (isset($value['inspection_by']) ? $user_list[$value['inspection_by']] : null ) ?></td>
                            </tr>
                            <tr>
                            <td class="text-nowrap"><strong><i>Last Inspection Date</i></strong></td>
                            <td class="text-nowrap">:</td>
                            <td class="text-nowrap"><?= (isset($value['inspection_by']) ? $value['inspection_datetime'] : null ) ?></td>
                            </tr>
                        </tbody>
                        </table> 
                    </td>               
              
            </tr>
        <?php } ?>
          </tbody>           
        </table>

        <br>
            <br>
            <div class="text-right">
              <?php if($no_rejected > 0){ ?>
              <button type="submit" id="btn_submit" class="btn btn-success" onclick="sweetalert('confirm', 'Are you sure?', this, event)"><i class="fas fa-check"></i> Submit</button>
              <?php } ?>
            </div>
        
      </div>
    </div>
  </div>

 </form>
    

</div>
</div>

<script type="text/javascript"> 
$(document).ready(function(){ 
    $('.dataTable').DataTable({
        lengthMenu: [ [ -1], [ "All"] ],
      // pageLength: 10,
      order: [],
      columnDefs: [{
        "targets": 0,
        "pageLength": 10
        //"orderable": false,
      }]
    }) 

    $("select[name=module]").chained("select[name=project]"); 
    
    $(".select2_multiple_wps").select2({ 
        tokenSeparators: [',', ' '],
        ajax: {
              url: "<?php echo base_url();?>fitup/get_wps_ajax_version2",
              type: "post",
              dataType       : 'json',
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

    $(".select2_multiple_welder").select2({ 
        tokenSeparators: [',', ' '],
        ajax: {
              url: "<?php echo base_url();?>fitup/get_welder_ajax_version2",
              type: "post",
              dataType       : 'json',
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

function change_area(event) {
    let original_area = "<?= $main_data['area'] ?>"
    let area = event.value

    Swal.fire({
      type: "warning",
      title: "Update Area",
      text: "Are You Sure To Update This Area ? ",
      allowOutsideClick: false,
      showCancelButton: true
    }).then((res) => {
      if (res.value) {
        $.ajax({
          url: "<?= site_url('material_verification/update_area') ?>",
          type: "POST",
          data: {
            area: area,
            submission_id: "<?= $main_data['submission_id'] ?>"
          },
          dataType: "JSON",
          success: function(data) {
            if (data.success) {
              Swal.fire({
                type: "success",
                title: "Success",
                text: "Success Update Area",
                timer: 1000
              })
            }
          }
        })
      } else {}
    })

  }

  function get_location_list(select) {
    $('select[name="location_v2"]').html(`<option value="">---</option>`)
    $('select[name="point_v2"]').html(`<option value="0">---</option>`)

    let area_id = select.value
    $.ajax({
      url: "<?= site_url('material_verification/location_list_ajax') ?>",
      type: "POST",
      data: {
        area_id: area_id
      },
      dataType: "JSON",
      success: function(data) {
        let html = []

        html.push(`<option value="">---</option>`)
        data.map(function(v) {
          html.push(`<option value="${v.id}">${v.name}</option>`)
        })

        $('select[name="location_v2"]').html(html)
      }
    })
  }

  function get_point_list(select) {
    $('select[name="point_v2"]').html(`<option value="0">---</option>`)

    let location_id = select.value
    $.ajax({
      url: "<?= site_url('material_verification/point_list_ajax') ?>",
      type: "POST",
      data: {
        location_id: location_id
      },
      dataType: "JSON",
      success: function(data) {
        let html = []

        html.push(`<option value="">---</option>`)
        data.map(function(v) {
          html.push(`<option value="${v.id}">${v.name}</option>`)
        })

        $('select[name="point_v2"]').html(html)
      }
    })
  }

  function update_data(btn) {
    let submission_id = "<?= $main_data['submission_id'] ?>"
    let area_v2 = $('select[name="area_v2"]').val()
    let location_v2 = $('select[name="location_v2"]').val()
    let point_v2 = $('select[name="point_v2"]').val()

    let msg

    if (!area_v2) {
      msg = "Area"
    } else if (!location_v2) {
      msg = "Location"
    }

    if (!area_v2 || !location_v2) {
      Swal.fire({
        type: "error",
        title: `${msg} Cannot Be Empty`,
        timer: 1000
      })

      return
    }

    $.ajax({
      url: "<?= site_url('itr/update_data_location') ?>",
      type: "POST",
      data: {
        submission_id: submission_id,
        area_v2: area_v2,
        location_v2: location_v2,
        point_v2: point_v2,
      },
      dataType: "JSON",
      success: function(data) {
        if (data.success) {
          Swal.fire({
            type: "success",
            title: "Data Has Been Updated",
            timer: 1000
          })

          setTimeout(() => {
            location.reload()
          }, 1000);
        }
      }
    })

  }

    function autocomplete_unique(input, workpack_no, grade, id_workpack){
        $(input).autocomplete({
            source: "<?php echo base_url(); ?>material_verification/autocomplete_unique_no/"+workpack_no+"/"+grade + '/' + id_workpack,
            autoFocus: true,
            classes: {
            "ui-autocomplete": "highlight"
            }
        });
    }

    function validate_unique_no(input, workpack_no, grade, id_workpack) {
        var unique_no = $(input).val()
        var invalid_feedback = $(input).closest('tr').find('.invalid-feedback')
        var mrir = $(input).closest('tr').find('.mrir')
        var heat_no = $(input).closest('tr').find('.heat_no')
        var material_description = $(input).closest('tr').find('.material_description')
        var id_mis = $(input).closest('tr').find('.id_mis')

        console.log(grade)

        $(input).removeClass('is-invalid')
        $(input).removeClass('is-valid')

        if ($.trim(unique_no) == "") {
            $(input).addClass('is-invalid')
            invalid_feedback.text("Unique No Cannot Be Empty")
            return false;
        }

        $.ajax({
            url: "<?= site_url('material_verification/validate_unique_number') ?>",
            type: "POST",
            data: {
            unique_no: unique_no,
            workpack_no: workpack_no,
            id_workpack: id_workpack,
            grade : grade
            },
            dataType: "JSON",
            success: function(data) {
            if (data.success) {
                $(input).addClass('is-valid')
                var report_no = data.result.report_no.split('/')
                mrir.val(report_no[1])
                id_mis.val(data.result.id_mis_det)
                heat_no.val(data.result.heat_or_series_no)
                material_description.val(data.result.catalog_category)
            } else {

                mrir.val('')
                id_mis.val('')
                heat_no.val('')
                material_description.val('')

                $(input).val('')
                $(input).addClass('is-invalid')
                invalid_feedback.text(data.text)
            }
            }
        })
    }

    $('.select2-multiple-tags').select2({
        tags: true,
        multiple: true,
        placeholder: 'Consumable Lot No.'
    })
</script>