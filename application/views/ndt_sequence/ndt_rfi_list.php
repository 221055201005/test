<div id="content" class="container-fluid">

  <style type="text/css">
    .disabled-effect {
      pointer-events: none;
      opacity:0.5;
    }
  </style>
  <?php error_reporting(0) ?>
  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <form action="" method="GET">
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Project ID</label>
                  <div class="col-xl">
                    <select class="form-control" name="project"  id="project_js">
                      <option value="">---</option>
                      <?php foreach ($project_list as $key => $value) : ?>
                      <option onclick="save_project()" value="<?php echo $value['id'] ?>" <?php echo (@$get['project'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                    <script type="text/javascript">
                      var project_js
                      function save_project(){
                        project_js = $('#project_js').val()
                        console.log(project_js)
                      }
                    </script>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <!-- <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Drawing Type</label>
                  <div class="col-xl">
                    <select class="form-control" name="drawing_type" id="drawing_type_js" >
                      <option value="">---</option>
                      <option value="1" <?php echo (@$get['drawing_type'] == '1' ? 'selected' : '') ?> onclick="save_drawing_type()">GA</option>
                      <option value="2" <?php echo (@$get['drawing_type'] == '2' ? 'selected' : '') ?> onclick="save_drawing_type()">Assembly</option>
                      <option value="3" <?php echo (@$get['drawing_type'] == '3' ? 'selected' : '') ?> onclick="save_drawing_type()">Weldmap</option>
                    </select>
                    <script type="text/javascript">
                      var drawing_type_js
                      function save_drawing_type(){
                        drawing_type_js = $('#drawing_type_js').val()
                        console.log(drawing_type_js)
                      }
                    </script>
                  </div>
                </div> -->
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Discipline</label>
                  <div class="col-xl">
                    <select class="form-control" name="discipline" id="discipline_js" >
                      <option value="">---</option>
                      <?php foreach ($discipline_list as $key => $value) : ?>
                      <option onclick="save_discipline()" value="<?php echo $value['id'] ?>" <?php echo (@$get['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                    <script type="text/javascript">
                      var discipline_js
                      function save_discipline(){
                        discipline_js = $('#discipline_js').val()
                        console.log(discipline_js)
                      }
                    </script>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <!-- <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Discipline</label>
                  <div class="col-xl">
                    <select class="form-control" name="discipline" id="discipline_js" >
                      <option value="">---</option>
                      <?php foreach ($discipline_list as $key => $value) : ?>
                      <option onclick="save_discipline()" value="<?php echo $value['id'] ?>" <?php echo (@$get['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                    <script type="text/javascript">
                      var discipline_js
                      function save_discipline(){
                        discipline_js = $('#discipline_js').val()
                        console.log(discipline_js)
                      }
                    </script>
                  </div>
                </div> -->
                <!-- <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Drawing Type</label>
                  <div class="col-xl">
                    <select class="form-control" name="drawing_type" id="drawing_type_js" >
                      <option value="">---</option>
                      <option value="1" <?php echo (@$get['drawing_type'] == '1' ? 'selected' : '') ?> onclick="save_drawing_type()">GA</option>
                      <option value="2" <?php echo (@$get['drawing_type'] == '2' ? 'selected' : '') ?> onclick="save_drawing_type()">Assembly</option>
                      <option value="3" <?php echo (@$get['drawing_type'] == '3' ? 'selected' : '') ?> onclick="save_drawing_type()">Weldmap</option>
                    </select>
                    <script type="text/javascript">
                      var drawing_type_js
                      function save_drawing_type(){
                        drawing_type_js = $('#drawing_type_js').val()
                        console.log(drawing_type_js)
                      }
                    </script>
                  </div>
                </div> -->
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Module</label>
                  <div class="col-xl">
                    <select class="form-control" name="module"  id="module_js">
                      <option value="">---</option>
                      <?php foreach ($module_list as $key => $value) : ?>
                      <option onclick="save_module()" value="<?php echo $value['mod_id'] ?>" data-chained="<?php echo $value['project_id'] ?>" <?php echo (@$get['module'] == $value['mod_id'] ? 'selected' : '') ?>><?php echo $value['mod_desc'] ?></option>
                      <?php endforeach; ?>
                    </select>
                    <script type="text/javascript">
                      var module_js
                      function save_module(){
                        module_js = $('#module_js').val()
                        console.log(module_js)
                      }
                    </script>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <!-- <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Module</label>
                  <div class="col-xl">
                    <select class="form-control" name="module"  id="module_js">
                      <option value="">---</option>
                      <?php foreach ($module_list as $key => $value) : ?>
                      <option onclick="save_module()" value="<?php echo $value['mod_id'] ?>" data-chained="<?php echo $value['project_id'] ?>" <?php echo (@$get['module'] == $value['mod_id'] ? 'selected' : '') ?>><?php echo $value['mod_desc'] ?></option>
                      <?php endforeach; ?>
                    </select>
                    <script type="text/javascript">
                      var module_js
                      function save_module(){
                        module_js = $('#module_js').val()
                        console.log(module_js)
                      }
                    </script>
                  </div>
                </div> -->
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Module Type</label>
                  <div class="col-xl">
                    <select class="form-control" name="type_of_module">
                      <option value="">---</option>
                      <?php foreach ($type_of_module_list as $key => $value) : ?>
                      <option onclick="save_type_module()" value="<?php echo $value['id'] ?>" <?php echo (@$get['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                    <script type="text/javascript">
                      var type_module_js
                      function save_type_module(){
                        type_module_js = $('#type_module_js').val()
                        console.log(type_module_js)
                      }
                    </script>
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Type Module</label>
                  <div class="col-xl">
                    <select class="form-control" name="type_of_module">
                      <option value="">---</option>
                      <?php foreach ($type_of_module_list as $key => $value) : ?>
                      <option onclick="save_type_module()" value="<?php echo $value['id'] ?>" <?php echo (@$get['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                    <script type="text/javascript">
                      var type_module_js
                      function save_type_module(){
                        type_module_js = $('#type_module_js').val()
                        console.log(type_module_js)
                      }
                    </script>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Document</label>
                  <div class="col-xl">
                    <input type="text" class="form-control autocomplete_doc" name="drawing_no" value="<?php echo @$get['drawing_no'] ?>" >
                  </div>
                </div>
              </div>
            </div> -->
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Deck Elevation / Service Line</label>
                  <div class="col-xl">
                    <select class="form-control" name="deck_elevation">
                      <option value="">---</option>
                      <?php foreach ($deck_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?= $get['deck_elevation'] == $value['id'] ? 'selected' : '' ?>><?php echo $value['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="form-group row">
                  <label for="" class="col-xl-3 col-form-label text-muted">Inspection Authority</label>
                  <div class="col-xl">
                    <select name="inspection_authority[]" class="form-control select2" style="width:100%" multiple="">
                      <option value="1" <?= in_array(1, $get['inspection_authority']) ? 'selected' : '' ?>>Hold Point</option>
                      <option value="2" <?= in_array(2, $get['inspection_authority']) ? 'selected' : '' ?>>Witness</option>
                      <option value="3" <?= in_array(3, $get['inspection_authority']) ? 'selected' : '' ?>>Monitoring</option>
                      <option value="4" <?= in_array(4, $get['inspection_authority']) ? 'selected' : '' ?>>Review</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">NDT Method</label>
                  <div class="col-xl">
                    <select class="form-control" name="ndt_method">
                      <option value="">---</option>
                      <?php foreach ($master_ndt as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo (@$get['ndt_method'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['ndt_initial'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <!-- <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label ">Weldmap</label>
                  <div class="col-xl">
                    <input type="text" class="form-control autocomplete_wm" name="drawing_wm" value="<?php echo @$get['drawing_wm'] ?>">
                  </div>
                </div> -->
              </div>
            </div>
            <div class="row">
              <div class="col-12 text-right">
                <button class="mt-2 btn btn-sm btn-flat btn-info" name="submit" value="search"><i class="fas fa-search"></i> Search</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  
  <?php //if(isset($get['submit'])): ?>
  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white">

          <div class="overflow-auto">
            <table class="table table-hover text-center dataTable" width="100%">
              <thead class="bg-green-smoe text-white">
                <tr>
                  <th style="min-width: 200px !important" class="text-nowrap">RFI No.</th>
                  <th class="text-nowrap">GA/ASSY Drawing No.</th>
                  <th class="text-nowrap">Weldmap Drawing No.</th>
                  <th class="text-nowrap">Discipline</th>
                  <th class="text-nowrap">Module</th>
                  <th class="text-nowrap">Module Type</th>
                  <th class="text-nowrap">Deck Elevation / Service Line</th>
                  <th class="text-nowrap">NDT</th>
                  <th>Vendor</th>
                  <th style="min-width: 400px !important">Transmittal Info.</th>
                  <th>Status Invitation</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($list as $key => $value): ?>
                <tr class="align-middle">
                  <td><?= 'SOF-OCP-SMO-'.strtoupper($type_of_module_list[$value['type_of_module']]['code']).'-'.strtoupper($discipline_list[$value['discipline']]['initial']).'-RFI-NDT-<strong>'.strtoupper($ndt[$value['ndt_type']]['ndt_initial']).'-'.str_pad($value['visual_transmittal_no'], 4, 0, STR_PAD_LEFT ).'</strong>' ?></td>
                  <td><?= $value['drawing_no']; ?></td>
                  <td>
                    <?php  
                      $links_atc_cross = base_url_ftp_eng()."production/open_atc_cross/2/".strtr($this->encryption->encrypt($value['drawing_wm']), '+=/', '.-~')."/".strtr($this->encryption->encrypt($activity_eng[$value['drawing_wm']]['id']), '+=/', '.-~');  
                    ?>
                    <a target='_blank' href='<?= $links_atc_cross ?>'>
                      <?= $value['drawing_wm'] ?>
                    </a>
                  </td>
                  
                  <td><?= $discipline_list[$value['discipline']]['discipline_name'] ?></td>
                  <td>OCP</td>
                  <td><?= $type_of_module_list[$value['type_of_module']]['name'] ?></td>
                  <td><?= $deck_desc[$value['deck_elevation']] ?></td>
                  <td><?= $ndt[$value['ndt_type']]['ndt_description'] ?></td>
                  <td><?= $vendor_desc[$value['id_vendor']] ?></td>
                  <td>
                    <table class="table table-hover table-bordered">
                      <tr>
                        <td style="text-align: left !important" class="alert-info"><strong>Transmitt By</strong></td>
                        <td style="text-align: left !important" class="alert-info"><strong>:</strong></td>
                        <td><?= $user_list[$value['ndt_transmittal_by']]['full_name'] ?></td>
                      </tr>
                      <tr>
                        <td style="text-align: left !important" class="alert-info"><strong>Transmitt Datetime</strong></td>
                        <td style="text-align: left !important" class="alert-info"><strong>:</strong></td>
                        <td><?= DATE('d F, Y H:i A',strtotime($value['ndt_transmittal_datetime'])) ?></td>
                      </tr>
                    </table>
                  </td>
                  <td>
                    <?php  
                      if($value['inspection_invitation_type']==1){
                        echo "<span class='badge badge-info'>Notification Activity</span>";
                      } elseif($value['inspection_invitation_type']==0 && isset($value['inspection_invitation_type'])){
                        echo "<span class='badge badge-primary'>Invitation Witness</span>";
                      } else {
                        echo "<strong>N/A</strong>";
                      }

                      $legen = explode(';', $value['inspection_authority']);    
                      if(in_array(1, $legen)) {
                        $inspection_authority[] = 'Hold Point ';
                      }
                      if(in_array(2, $legen)) {
                        $inspection_authority[] = 'Witness ';
                      }
                      if(in_array(3, $legen)) {
                        $inspection_authority[] = 'Monitoring ';
                      }
                      if(in_array(4, $legen)) {
                        $inspection_authority[] = 'Review ';
                      }
                      if(COUNT($legen)>0){
                        echo '<br><i style="font-size:12px !important;"><b>'.implode('/ ', $inspection_authority).'</b></i>';
                        unset($inspection_authority);
                        unset($legen);
                      }
                    ?>
                  </td>
                  <td>
                    <div class="btn-group">
                      <a class="btn btn-lg btn-danger" href="<?= base_url('ndt/ndt_rfi_report/').$value['ndt_type'].'/'.$value['visual_transmittal_no'] ?>">
                        <i class="fas fa-file-pdf"></i> Report
                      </a>
                      <?php if($this->permission_cookie[126]==1){ ?>
                      <!-- <button type="button" class="btn btn-lg btn-secondary" data-toggle="modal" data-target="#exampleModal<?= $value['ndt_type'].'_'.$value['visual_transmittal_no'] ?>"><i class="fas fa-eye-slash"></i> &nbsp;Void&nbsp;</button> -->

                      <button type="button"
                        onclick="resend_notif(this, '<?= $value['ndt_type'] ?>', '<?= $value['visual_transmittal_no'] ?>')" 
                        class="btn btn-lg btn-primary"><i class="fas fa-envelope"></i> &nbsp;Notify&nbsp;</button>

                      <button type="button"
                        onclick="request_void_data(this, '<?= $value['ndt_type'] ?>', '<?= $value['visual_transmittal_no'] ?>')" 
                        class="btn btn-lg btn-secondary"><i class="fas fa-eye-slash"></i> &nbsp;Void&nbsp;&nbsp;</button>

                      <?php } ?>
                    </div>
                    <!-- ================================== -->
                    <!-- <div class="modal fade" id="exampleModal<?= $value['ndt_type'].'_'.$value['visual_transmittal_no'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel<?= $value['ndt_type'].'_'.$value['visual_transmittal_no'] ?>" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel<?= $value['ndt_type'].'_'.$value['visual_transmittal_no'] ?>">
                              <?= 'SOF-OCP-SMO-'.strtoupper($type_of_module_list[$value['type_of_module']]['code']).'-'.strtoupper($discipline_list[$value['discipline']]['initial']).'-RFI-NDT-<strong>'.strtoupper($ndt[$value['ndt_type']]['ndt_initial']).'-'.str_pad($value['visual_transmittal_no'], 4, 0, STR_PAD_LEFT ).'</strong>' ?>    
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form method="POST" action="<?= base_url('ndt/request_to_void') ?>">
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-md-3">
                                <label class="label" style="text-align: left !important">Request By</label>
                              </div>
                              <div class="col">
                                <input type="text" name="name" class="form-control" value="<?= $this->user_cookie[1] ?>" readonly>
                                <input type="hidden" name="request_void_by" class="form-control" value="<?= $this->user_cookie[0] ?>">
                                <input type="hidden" name="ndt_type" class="form-control" value="<?= $value['ndt_type'] ?>">
                                <input type="hidden" name="visual_transmittal_no" class="form-control" value="<?= $value['visual_transmittal_no'] ?>">

                                <input type="hidden" name="discipline" class="form-control" value="<?= $value['discipline'] ?>">
                                <input type="hidden" name="module" class="form-control" value="<?= $value['module'] ?>">
                                <input type="hidden" name="type_of_module" class="form-control" value="<?= $value['type_of_module'] ?>">
                              </div>
                            </div> 
                            <hr>
                            <div class="row">
                              <div class="col-md-3">
                                <label class="label" style="text-align: left !important">Request Date</label>
                              </div>
                              <div class="col">
                                <input type="text" name="request_void_date" class="form-control" value="<?= DATE('Y-m-d H:i:s') ?>" readonly>
                              </div>
                            </div>  
                            <hr>
                            <label class="label" style="text-align: left !important">Reason</label>
                            <textarea class="form-control" name="request_void_reason" required=""></textarea>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div> -->
                    <!-- ================================== -->
                  </td>
                </tr>
                
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <br>
        </div>
      </div>
    </div>
  </div>
  <?php //endif; ?>

</div>
</div><!-- ini div dari sidebar yang class wrapper -->

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

<script>
  function resend_notif(event, ndt_type, visual_transmittal_no){
    Swal.fire({
      title: 'Are you sure to Re-Send Notification for this Report?',
      text: "",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Send!'
    }).then((result) => {

      if (result.value) {
        $.ajax({
          url: "<?= base_url('ndt/resend_notif/') ?>",
          type: "post",
          data: {
            'ndt_type': ndt_type,
            'visual_transmittal_no': visual_transmittal_no,
          },
          success: function(data){
            Swal.fire(
              'Data Has Been Updated !',
              '',
              'success'
            ).then(function() {
                
                location.reload();
                return false;
            });
          }
        });
      }
    })
  }

  function request_void_data(event, ndt_type, visual_transmittal_no) {
    let url   = "<?= site_url('ndt/request_void_data/') ?>"+ndt_type+'/'+visual_transmittal_no
    var table = $('.dataTableX').DataTable();
    table.destroy();

    $("#modal").modal({
      show : true,
      keyboard : false,
      backdrop : "static"
    }).find('.modal-body').load(url)
    $('.modal-title').html(`<strong>${visual_transmittal_no} - </strong> Re - Transmit Data`)
    $('.modal-dialog').addClass('modal-lg')

    $('.dataTableX').DataTable({
      order: [],
    })
  }

  $(document).ready(
    function() {
      $(".select_multiple_pic").select2({
        theme: 'bootstrap',
        ajax: {
          url: "<?php echo base_url();?>ndt/get_welder_ajax_select",
          type: "post",
          dataType: "json",
          data: function (params) {
            var query = {
              search: params.term,
              department: $('select[name=assigned_dept] option').filter(':selected').val(),
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
    }
  )

  function select_multiple_pic(noo){
    console.log('klik')
    $(".welder_"+noo).select2({
        theme: 'bootstrap',
        ajax: {
          url: "<?php echo base_url();?>ndt/get_welder_ajax_select",
          type: "post",
          dataType: "json",
          data: function (params) {
            var query = {
              search: params.term,
              department: $('select[name=assigned_dept] option').filter(':selected').val(),
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
  }
  

  $("select[name=module]").chained("select[name=project]");

  $('.dataTable').on( 'draw.dt', function () {
    $('.select2').select2({
        theme: 'bootstrap'
      });
  });

  $('.dataTable').DataTable({
    order: [],
  })

  $(".autocomplete_doc").autocomplete({
    source: function( request, response ) {
      console.log('ga as autc')
      $.ajax( {
        url: "<?php echo base_url() ?>visual/autocomplete_drawing",
        dataType: "json",
        data: {
          term: request.term,
          drawing_type: 1,

          project :project_js,
          discipline  :discipline_js,
          module  :module_js,
          type_of_module  :type_module_js,
        },
        success: function( data ) {
          response( data );
        }
      });
    },
  })

  $(".autocomplete_wm").autocomplete({
    source: function( request, response ) {
      console.log('wm autc')
      $.ajax( {
        url: "<?php echo base_url() ?>visual/autocomplete_drawing",
        dataType: "json",
        data: {
          term: request.term,
          drawing_type: 2,

          project :project_js,
          discipline  :discipline_js,
          module  :module_js,
          type_of_module  :type_module_js,
        },
        success: function( data ) {
          response( data );
        }
      });
    },
    select: function (event, ui) {
      var value = ui.item.value;
      if(value == 'No Data.'){
        ui.item.value = "";
      }
      else{
        get_data_drawing(ui.item.value);
      }
    }
  });

  function get_data_drawing(document_no) {
    var module = $("select[name=module]").val();
    console.log(document_no);
    console.log(module);
    $.ajax( {
      url: "<?php echo base_url() ?>engineering/get_data_drawing",
      dataType: "json",
      data: {
        document_no: document_no,
        module: module,
      },
      success: function(data) {
        console.log(data);
        if(data.drawing_type == 1 || data.drawing_type == 2){
          $("select[name=project]").val(data.project).trigger('change');
          $("select[name=discipline]").val(data.discipline);
          $("select[name=drawing_type]").val(data.drawing_type);
          if(module == ""){
            $("select[name=module]").val(data.module);
          }
        }
      }
    });
  }

  var what_ga_is_selected
  $('.dataTable').on( 'draw.dt', function () {
    
    if(typeof what_ga_is_selected !== "undefined"){
      lock_one_ga(what_ga_is_selected)
    }

    });

  function lock_one_ga(identic){
    var total = '<?= $juml ?>';
    var i;

    for(i=0; i<total; i++){
      if(!$('.cb'+i).hasClass(identic)){
        $('.cb'+i).prop("disabled", true);
        $('.div_'+i).attr('title', 'Different GA/AS');
      }
    }
  }

  var selecteds = 0
  
  function enable_edit(no, thiss, identic){
    what_ga_is_selected = identic
    if(thiss.checked==true){
      selecteds++
      console.log(selecteds)
      console.log('yes')

      var total = '<?= $juml ?>';
      var i;

      for(i=0; i<total; i++){
        if(!$('.cb'+i).hasClass(identic)){
          $('.cb'+i).prop("disabled", true);
          $('.div_'+i).attr('title', 'Different GA/AS');
        }
      }

      $('.will_enable'+no).removeClass('disabled-effect');

      $('.will_enable'+no).removeAttr('disabled');
      $('.will_enable'+no).prop('required', true);
      if(selecteds>=30){
        $('.checkbox-big').addClass('disabled-effect')
      }
    } else {
      var total = '<?= $juml ?>';
      var i;
      selecteds--
      console.log('not')
      console.log(selecteds)
      $('.will_enable'+no).prop('disabled', true);
      $('.will_enable'+no).removeAttr('required');

      $('.will_enable'+no).addClass('disabled-effect');

      if(selecteds==0){
        console.log('sampai')
        for(i=0; i<total; i++){
          console.log(i)
          $('.cb'+i).removeAttr('disabled');
          $('.div_'+i).attr('title', 'Different GA/AS');
        }
      }

    }
    $("#thicked b").text(' '+selecteds)

    

  }
</script>