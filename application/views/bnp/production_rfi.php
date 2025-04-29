<style>
  th,
  td {
    vertical-align: middle !important;
    white-space: nowrap !important;
  }

  /* 
  table thead {
    position: sticky;
    top: 0;
    z-index: 999;
  } */
</style>
<style>
  a[aria-expanded=true] .fa-angle-double-down {
   display: none;
  }

  a[aria-expanded=false] .fa-angle-double-up {
    display: none;
  }
</style>
<div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 shadow">
          <div class="card-header">
            <a class="btn btn-primary" data-toggle="collapse" href="#collapseButton" role="button" aria-expanded="false" aria-controls="collapseButton">Filter &nbsp; <i class="fas fa-angle-double-down"></i><i class="fas fa-angle-double-up"></i></a>
	        </div>
	        <div class="collapse <?= $this->input->get() ? 'show' : '' ?>" id="collapseButton"> 
	          <div class="card-body">

	            <form action="" method="get">
	              <div class="row">

	                <div class="col-md-6">
	                  <div class="form-group row">
	                    <label for="" class="col-xl-3 col-form-label text-muted"> Project</label>
	                    <div class="col-xl">
	                      <select name="project_id" class="select2" style="width:100%" required>

	                        <?php if($this->permission_cookie[0] == 1){ ?>  
	                          <option value="">---</option>                        
	                          <?php foreach ($project_list as $key => $value) : ?>
	                          <option value="<?php echo $value['id'] ?>" <?php echo (@$get['project_id'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
	                          <?php endforeach; ?>
	                        <?php } else { ?>
	                          <?php foreach ($project_list as $key => $value) : ?>
	                            <?php if(in_array($value['id'], $this->user_cookie[13])){ ?>
	                              <option value="<?php echo $value['id'] ?>" <?php echo ($get['project_id'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
	                            <?php } ?>
	                          <?php endforeach; ?>
	                        <?php } ?>

	                      </select>
	                    </div>
	                  </div>
	                </div>

	                <div class="col-md-6">
	                  <?php if($wp_type==2){ ?>
	                    <div class="form-group row">
	                      <label for="" class="col-xl-3 col-form-label text-muted"> WO No</label>
	                      <div class="col-xl">
	                        <select name="workpack_no[]" class="select2" style="width:100%" required multiple>
	                          <option value="">---</option>
	                          <?php foreach ($workpack_list as $key => $value) : ?>
	                            <option value="<?= $value['id'] ?>" <?= @in_array($value['id'], $this->input->get('workpack_no'))  ? 'selected' : '' ?>><?= $value['workpack_no'] ?></option>
	                          <?php endforeach; ?>
	                        </select>
	                      </div>
	                    </div>
	                  <?php } else { ?>
	                    <div class="form-group row">
	                      <label for="" class="col-xl-3 col-form-label text-muted"> Workpack No</label>
	                      <div class="col-xl">
	                        <select name="workpack_no[]" class="select2" style="width:100%" required multiple>
	                          <option value="">---</option>
	                          <?php foreach ($workpack_list as $key => $value) : ?>
	                            <option value="<?= $value['id'] ?>" <?= @in_array($value['id'], $this->input->get('workpack_no'))  ? 'selected' : '' ?>><?= $value['workpack_no'] ?></option>
	                          <?php endforeach; ?>
	                        </select>
	                      </div>
	                    </div>
	                  <?php } ?>
	                </div>

	                <div class="col-md-6">
	                  <div class="form-group row">
	                    <label for="" class="col-xl-3 col-form-label text-muted"> Paint System</label>
	                    <div class="col-xl">
	                      <select name="paint_system" class="select2" style="width:100%" onchange="get_list_activity(this)" required>
	                        <option value="">---</option>
	                        <?php foreach ($paint_system as $key => $value) : ?>
	                          <option value="<?= $value['id'] ?>" <?= $value['id'] == $this->input->get('paint_system') ? 'selected' : '' ?>><?= $value['name'] ?></option>
	                        <?php endforeach; ?>
	                      </select>
	                    </div>
	                  </div>
	                </div>

	                <!-- <div class="col-md-6">
	                  <div class="form-group row">
	                    <label for="" class="col-xl-3 col-form-label text-muted"> Description Activity</label>
	                    <div class="col-xl">
	                      <select name="activity" class="select2" style="width:100%" required>
	                        <option value="">---</option>
	                        <?php if ($this->input->get('paint_system')) : ?>
	                          <?php foreach ($activity_desc as $key => $value) : ?>
	                            <option value="<?= $value['id_activity'] ?>" <?= $value['id_activity'] == $this->input->get('activity') ? 'selected' : '' ?>><?= $value['description_of_activity'] ?></option>
	                          <?php endforeach; ?>
	                        <?php endif; ?>
	                      </select>
	                    </div>
	                  </div>
	                </div> -->



	                <div class="col-md-12 text-right">
	                  <hr>
	                  <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
	                </div>
	              </div>
	            </form>
	          </div>
	        </div>
        </div>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="card border-0 shadow">
          <div class="card-header">
            <h6 class="card-title m-0">Create New</h6>
          </div>
          <div class="card-body">
            <form action="<?= site_url('planning_bnp/submit_data_rfi') ?>" id="form_submit" enctype="multipart/form-data" method="post">
              <div class="row">
                <?php if ($this->input->get()) : ?>
                  <div class="col-md-4">
                    <div class="table-responsive overflow-auto">
                      <table class="table table-bordered table-sm text-center">
                        <thead>
                          <tr>
                            <th colspan="2">Activity in <?= $paint_system[$this->input->get('paint_system')]['name'] ?></th>
                          </tr>
                          <tr>
                            <th>No.</th>
                            <th>Activity</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $no = 1; foreach ($activity[$this->input->get('paint_system')] as $key => $value): ?> 
                           <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $value['description_of_activity'] ?></td>
                           </tr>
                           <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="col-md-12">

                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-xl-2 col-form-label text-muted" for="">Area</label>
                      <div class="col-xl">
                        <select name="area_v2" onchange="get_location_list(this)" class="custom-select select2" style="width:100%" required>
                          <option value="">---</option>
                          <?php foreach ($area_list as $value) : ?>
                            <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12"></div>

                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-xl-2 col-form-label text-muted" for="">Location</label>
                      <div class="col-xl">
                        <select name="location_v2" onchange="get_point_list(this)" class="select2" required>
                          <option value="">---</option>

                          <?php if (isset($location_list)) : ?>
                            <?php foreach ($location_list as $key => $value) : ?>
                              <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                            <?php endforeach; ?>
                          <?php endif; ?>

                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12"></div>

                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-xl-2 col-form-label text-muted" for="">Point <span style="font-size: 10px;"><strong><i>(Optional)</i></strong></span></label>
                      <div class="col-xl">
                        <select name="point_v2" class="select2">
                          <option value="0">---</option>

                          <?php if (isset($point_list)) : ?>
                            <?php foreach ($point_list as $key => $value) : ?>
                              <option value="<?= $value['id'] ?>" <?= $value['id'] == $data_piecemark[0]['point_v2'] ? 'selected' : '' ?>><?= $value['name'] ?></option>
                            <?php endforeach; ?>
                          <?php endif; ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12"></div>

                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-xl-2 col-form-label text-muted" for="">Request No</label>
                      <div class="col-xl">
                        <input type="text" name="request_no" class="form-control" required>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <hr>
                  </div>


                <?php else : ?>
                  <div class="col-md-12">
                    <span class="font-weight-bold text-info"><i class="fas fa-info-circle"></i> Filter Data First !</span>
                  </div>

                <?php endif; ?>
                <input type="hidden" name="project_id" value="<?= $this->input->get('project_id') ?>">
                <div class="col-md-12 mt-3">
                  <div class="table-responsive overflow-auto">
                    <table class="table table-hover text-center" id="table_list" style="width: 100%">
                      <thead class="bg-gray-table">
                        <?php if($wp_type!=2){ ?>
                          <tr>
                            <th rowspan="2">
                              <?php if ($this->input->get()) : ?>
                                <input type="checkbox" class="check_all" style="width:25px; height:25px">
                              <?php endif; ?>
                            </th>
                            <th rowspan="2">
                              <?= $wp_type==2 ? 'WO No' : 'Workpack No' ?>
                            </th>
                            <th rowspan="2">IRN No</th>
                            <th rowspan="2">Project</th>
                            <th rowspan="2">Drawing No</th>
                            <th rowspan="2">Drawing AS</th>
                            <th rowspan="2">Drawing SP</th>
                            <th rowspan="2">Paint System</th>
                            <!-- <th rowspan="2">Description Activity</th> -->
                            <th rowspan="2">Tag No</th>
                            <th colspan="8" >Material Traceability</th>
                            <th rowspan="2">Status</th>

                          </tr>
                          <tr>
                            <th >Piecemark No</th>
                            <th >Unique No</th>
                            <th >Profile</th>
                            <th >Size / Dia</th>
                            <th >Length</th>
                            <th >Area (m2)</th>
                            <th >Thk</th>
                            <th >Material Status</th>
                          </tr>
                        <?php } else { ?>
                          <tr>
                            <th rowspan="2">
                              <?php if ($this->input->get()) : ?>
                                <input type="checkbox" class="check_all" style="width:25px; height:25px">
                              <?php endif; ?>
                            </th>
                            <th rowspan="2">
                              <?= $wp_type==2 ? 'WO No' : 'Workpack No' ?>
                            </th>
                            <th rowspan="2">Project</th>
                            <th rowspan="2">Paint System</th>
                            <th colspan="4" >Material Traceability</th>
                            <th rowspan="2">Status</th>

                          </tr>
                          <tr>
                            <th >Unique No</th>
                            <th >Length</th>
                            <th >Area (m2)</th>
                            <th >Thk</th>
                          </tr>
                        <?php } ?>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
                <?php if ($this->input->get()) : ?>
                  <div class="col-md-12 text-right">
                    <hr>
                    <!-- <span class="text_status_total d-none"><strong><i class="fas fa-info-circle"></i> Not All Item Selected !</strong></span> -->
                    <button type="submit" id="button_submit" class="btn btn-primary" disabled><i class="fas fa-check"></i> Submit Data <span class="badge badge-light text_checked">0</span></button>
                  </div>
                <?php endif; ?>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<script>
  $("#form_submit").on('submit', function() {
    $('button[type=submit]').attr('disabled', true)

    Swal.fire({
      title: 'Processing...',
      allowOutsideClick: false,
      onBeforeOpen: () => {
        Swal.showLoading()
      },
    });

  })
  var checked_list = []
  var checked_key = []
  var filter = false;
  var total_data = <?= $total_data ?>

  <?php if ($this->input->get()) : ?>
    filter = true;
  <?php endif; ?>

  $("#table_list").DataTable({
    order: [],
    processing: true,
    serverSide: true,
    bFilter: filter ? false : true,
    lengthChange: filter ? false : true,
    paging: filter ? false : true,
    ordering: filter ? false : true,
    // paging     : false,
    ajax: {
      url: "<?= site_url($serverside) ?>",
      type: "POST",
      data: {
        project_id: "<?= $this->input->get('project_id') ?>",
        workpack_no: <?= json_encode($this->input->get('workpack_no')) ?>,
        paint_system: "<?= $this->input->get('paint_system') ?>",
        activity: "<?= $this->input->get('activity') ?>", 
        is_itr: "<?= isset($check_itr[0]['is_itr']) ? $check_itr[0]['is_itr'] : null ?>", 
      }
    },
    columnDefs: [{
      targets: 0,
      render: function(data, row) {




        id_check = data.split("_")

        if (filter) {

          let is_checked = ""

          if ($.inArray(id_check[0], checked_list) !== -1) {
            is_checked = "checked"
          }

          return `
          <input type="checkbox" name="checked_id[${id_check[1]}]" class="check" value="${id_check[0]}" style="width:25px; height:25px" ${is_checked}>`
        }

        return '-'
      }
    }]
  })

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

  $("#table_list").on('click', '.check_all', function() {

    checked_list = []
    if (this.checked) {
      $('.check').each(function() {
        this.checked = true
        checked_list.push(this.value)
      })
    } else {
      $('.check').each(function() {
        this.checked = false
        checked_list.splice($.inArray(this.value, checked_list), 1)
      })
    }

    if (checked_list.length > 0) {
      $("#button_submit").removeAttr('disabled')
      // if (checked_list.length == total_data) {
      //   $('.text_status_total').addClass('d-none')
       
      // } else {
      //   $('.text_status_total').removeClass('d-none')
      //   $("#button_submit").attr('disabled', true)
      // }

    } else {
      $("#button_submit").attr('disabled', true)
    }

    $('.text_checked').text(checked_list.length)


  })

  $('#table_list').on('click', '.check', function() {
    let wp_detail_id = this.value
    let paint_id = $(this).closest('tr').find('input[name="paint_system_id[]"]').val()
    let activity_id = $(this).closest('tr').find('input[name="activity_id[]"]').val()

    let key_data = paint_id + '_' + activity_id

    if (this.checked) {

      if (checked_key.length > 0) {
        if (key_data != checked_key[0]) {
          this.checked = false
          Swal.fire({
            type: "warning",
            title: "Different Paint System And Activity",
            text: "Cannot Submit Multiple Paint System And Activity"
          })

          return
        }

      }

      checked_list.push(wp_detail_id)
      checked_key.push(key_data)
    } else {
      checked_list.splice($.inArray(wp_detail_id, checked_list), 1)
      checked_key.splice($.inArray(key_data, checked_key), 1)
    }

    if (checked_list.length > 0) {
      $("#button_submit").removeAttr('disabled')
      // if (checked_list.length == total_data) {
      //   $('.text_status_total').addClass('d-none')
       
      // } else {
      //   $('.text_status_total').removeClass('d-none')
      //   $("#button_submit").attr('disabled', true)
      // }

    } else {
      $("#button_submit").attr('disabled', true)
    }
    $('.text_checked').text(checked_list.length)

  })

  var list_activity_id = <?= json_encode($activity) ?>;

  function get_list_activity(select) {
    let id_paint_system = select.value

    let html = []
    html.push(`<option value="">---</option>`)

    if (id_paint_system) {
      list_activity_id[id_paint_system].map(function(v, i) {
        html.push(`<option value="${v.id_activity}">${v.description_of_activity}</option>`)
      })
    }

    $('select[name="activity"]').html(html)

  }
</script>