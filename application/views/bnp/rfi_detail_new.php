<div id="content" class="container-fluid"> 
<?php 
  error_reporting(0);
  $inspection_month   = DATE('m' ,strtotime($main[0]['inspection_date']));
  $inspection_month_to= DATE('m' ,strtotime($main[0]['inspection_date_to']));

  $inspection_date    = DATE('d' ,strtotime($main[0]['inspection_date']));
  $inspection_date_to = DATE('d' ,strtotime($main[0]['inspection_date_to']));

  $inspection_date_arr = array();

  $start = new DateTime (DATE('Y-m-d' ,strtotime($main[0]['inspection_date']))); 
  $end = new DateTime (DATE('Y-m-d' ,strtotime($main[0]['inspection_date_to']))); 

  $interval = new DateInterval ("P1D"); 
  $range = new DatePeriod ($start, $interval, $end);
  foreach ($range as $key => $value) {
    if($value->format('l')=='Sunday'){
      $blank[] = $value->format('d');
    }
  }

  if($inspection_date_to<$inspection_date){
    foreach (range($inspection_date, 31) as $keyc => $valuec) {
      $inspection_date_arr[] = $valuec;
    }
    foreach (range(1, $inspection_date_to) as $keyc => $valuec) {
      $inspection_date_arr[] = $valuec;
    }
  } else {
    foreach (range($inspection_date, $inspection_date_to) as $keyc => $valuec) {
      $inspection_date_arr[] = $valuec;
    }
  }

  $inspection_month_arr = array();
  foreach (range($inspection_month, $inspection_month_to) as $keyc => $valuec) {
    $inspection_month_arr[] = $valuec;
  }
  if($main[0]['status_invitation']==1){
    $disabled = 'disabled';
  }
?>           
    <div class="row d-none">
      <div class="col-12">
        <div class="row">
          <div class="col-md-12">
            <ul class="nav nav-pills border-bottom border-gray" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Detail List</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Attachment</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

      <!-- <div class="row"> -->

    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="card shadow my-3 rounded-0">
          <div class="card-header">
            <h6 class="m-0">Attachment</h6>
          </div>
          <div class="card-body bg-white">

            <button class="btn btn-info" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalRedline">
              <i class="fas fa-plus-circle"></i> Add Attachment
            </button>
            <br/><br/>

            <table class="table table-hover text-center table_attachment">
              <thead class="bg-gray-table">
                  <th>No</th>
                  <th>Piecemark Name</th>
                  <th>Attachment Name</th>
                  <th>Uploaded By</th>
                  <th>Uploaded Date</th>
                  <th></th>
              </thead>
              <tbody>
                <?php $no = 1;foreach ($attachment_list as $key => $value): ?> 
                  <tr>
                    <td>
                      <?= $no++ ?>  
                    </td>
                    <td>
                      <?= $value['id_detail_wp_paint_system'] ?>
                    </td>
                    <td>
                      <a target="_blank" href="https://www.smoebatam.com/pcms_v2_photo/fab_img/<?= $value['filename'] ?>"> <?= $value['filename'] ?></a>
                    </td>
                    <td>
                      <?= $user[$value['upload_by']]['full_name'] ?> 
                    </td>
                    <td>
                      <?= $value['upload_datetime'] ?>    
                    </td>
                    <td>
                      <a href="" class="btn btn-dange"><i class="fas fa-trash"></i></a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

        <form method="POST" action="<?= base_url('planning_bnp/transmitt_to_client') ?>">
          <div class="col-12">
            <div class="card shadow my-3 rounded-0">
              <div class="card-header">
                <h6 class="m-0">RFI - INSPECTION NOTIFICATION</h6>
              </div>
              <div class="card-body bg-white">
                <div class="col-12 <?= $class ?>">
                  <div class="form-group">
                        <div class="row">
                          <div class="col-md-12">
                            <strong><i>Inspection Detail</i></strong>
                          </div>
                          <div class="col-md-12"><br></div>

                          <div class="col-md-6">
                            <div class="form-group row">
                              <label for="" class="col-xl-3 col-form-label text-muted"><b>Trace Code</b></label>
                              <div class="col-xl">
                                <input type="text" name="report_number" class="form-control" <?= $disabled ?> required value="<?= $main[0]['report_number'] ?>">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-12"><hr></div>

                          <div class="col-md-6 mt-2">
                            <div class="form-group row">
                              <label for="" class="col-xl-3 col-form-label text-muted">Inspector Name</label>
                              <div class="col-xl">
                                <select name="inspector_id" class="select2" style="width: 100%" required <?= $disabled ?>>
                                  <option value="">---</option>
                                  <?php foreach ($user_list as $key => $value) : ?>
                                    <option value="<?= $value['id_user'] ?>" <?= $value['id_user']==$main[0]['inspector_id'] ? 'selected' : '' ?>><?= $value['full_name'] ?></option>
                                  <?php endforeach; ?>
                                </select>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6 mt-2">
                            <div class="form-group row">
                              <label for="" class="col-xl-3 col-form-label text-muted">Company Assigned</label>
                              <div class="col-xl">
                                <select name="id_vendor" class="select2" style="width: 100%" required <?= $disabled ?>>
                                  <option value="">---</option>
                                  <?php foreach ($company_list as $key => $value) : ?>
                                    <option value="<?= $value['id_company'] ?>" <?= $value['id_company']==$main[0]['id_vendor'] ? 'selected' : '' ?>><?= $value['company_name'] ?></option>
                                  <?php endforeach; ?>
                                </select>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group row">
                              <label for="" class="col-xl-3 col-form-label text-muted">Submitted Date</label>
                              <div class="col-xl">
                                <input type="date" name="submitted_date" class="form-control" <?= $disabled ?> required value="<?= $main[0]['submitted_date'] ? DATE('Y-m-d', strtotime($main[0]['submitted_date'])) : '' ?>">
                              </div>
                            </div>
                          </div>
                          
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label for="" class="col-xl-3 col-form-label text-muted">Inspect Date from</label>
                              <div class="col-xl">
                                <input type="date" name="inspection_date" class="form-control" required <?= $disabled ?> value="<?= $main[0]['inspection_date'] ? DATE('Y-m-d', strtotime($main[0]['inspection_date'])) : '' ?>">
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group row">
                              <label for="" class="col-xl-3 col-form-label text-muted">Inspect Date to</label>
                              <div class="col-xl">
                                <input type="date" name="inspection_date_to" class="form-control" required <?= $disabled ?> value="<?= $main[0]['inspection_date_to'] ? DATE('Y-m-d', strtotime($main[0]['inspection_date_to'])) : '' ?>">
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group row">
                              <label for="" class="col-xl-3 col-form-label text-muted">Inspect Area</label>
                              <div class="col-xl">
                                <select class="select2 will_enable" name="area" <?= $disabled ?>>
                                  <option value="">---</option>
                                  <?php foreach ($area_v2 as $value_area) {?>
                                    <option value="<?= $value_area['id'] ?>" <?= $value_area['id']==$main[0]['area'] ? 'selected' : '' ?>><?= $value_area['name'] ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group row">
                              <label for="" class="col-xl-3 col-form-label text-muted">Inspect Location</label>
                              <div class="col-xl">
                                <select class="select2 will_enable" name="location[]" multiple="" <?= $disabled ?>>
                                  <option value="">---</option>
                                  <?php foreach ($location_v2 as $value_location) {?>
                                    <option value="<?= $value_location['id'] ?>" data-chained="<?php echo $value_location['id_area'] ?>" <?= in_array($value_location['id'], explode(';', $main[0]['location'])) ? 'selected' : '' ?>><?= $value_location['name'] ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                          </div>
                          <script type="text/javascript">
                            $("select[name=location]").chained("select[name=area]");
                          </script>
                          
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label for="" class="col-xl-3 col-form-label text-muted">Inspect Qty</label>
                              <div class="col-xl">
                                <input type="text" name="qty" class="form-control" <?= $disabled ?> required value="<?= $main[0]['qty'] ?>">
                              </div>
                            </div>
                          </div>

                          <div class="col-md-12"><hr></div>
                          <?php //test_var($irn_tag, 1) ?>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label for="" class="col-xl-3 col-form-label text-muted">Expected Time</label>
                              <div class="col-xl">
                                <input type='text' class='form-control' name="expected_time" value="<?= $rfi_detail[0]['expected_time'] ?>">
                              </div>
                            </div>
                          </div> 

                          <div class="col-md-6">
                            <div class="form-group row">
                              <label for="" class="col-xl-3 col-form-label text-muted">ITP Intervention to Employer</label>
                              <div class="col-xl">
                                <select class="form-control select2" style="width:100%" name="itp[]" multiple="">
                                  <option value="1" <?= in_array(1, explode(';', $rfi_detail[0]['itp'])) ? 'selected' : '' ?>>Hold Point</option>
                                  <option value="2" <?= in_array(2, explode(';', $rfi_detail[0]['itp'])) ? 'selected' : '' ?>>Witness</option>
                                  <option value="3" <?= in_array(3, explode(';', $rfi_detail[0]['itp'])) ? 'selected' : '' ?>>Monitoring</option>
                                  <option value="4" <?= in_array(4, explode(';', $rfi_detail[0]['itp'])) ? 'selected' : '' ?>>Review</option>
                                </select>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group row">
                              <label for="" class="col-xl-3 col-form-label text-muted">Result</label>
                              <div class="col-xl">
                                <input type='text' class='form-control' name="result" value="<?= $rfi_detail[0]['result'] ?>">
                              </div>
                            </div>
                          </div> 

                          <div class="col-md-6 ">
                            <div class="form-group row">
                              <label for="" class="col-xl-3 col-form-label text-muted">Tag Description</label>
                              <div class="col-xl">
                                <textarea class='form-control' name="tag_description_pickling"><?= $rfi_detail[0]['tag_description'] ?></textarea>
                                <small><i><strong>*Fill this Column for Item/Tag Description</strong></i></small>
                              </div>
                            </div>
                          </div>

                          <?php $paint_detail =$master_activity[$main[0]['id_paint_system']][$main[0]['id_activity']] ?>
                          <div class="col-md-6 ">
                            <div class="form-group row">
                              <label for="" class="col-xl-3 col-form-label text-muted">Paint Product</label>
                              <div class="col-xl">
                                <input type="text" class="form-control special" name="special_product" value="<?= $main[0]['special']==0 ? $paint_detail['paint_product'] : $main[0]['special_product'] ?>" <?= $main[0]['special']==0 ? 'disabled' : '' ?>>
                              </div>
                            </div>
                            <!-- <br> -->
                            <input type="checkbox" name="special" value="1" onclick="checkCheck(this)" <?= $main[0]['special']==0 ? '' : 'checked' ?>><small><i><strong>*Tick if Using Special Paint</strong></i></small>
                            <script type="text/javascript">
                              function checkCheck(ini){
                                var value = $(ini)
                                console.log($(value)[0].checked);
                                if($(value)[0].checked==true){
                                  $('.special').attr("disabled", false)
                                } else {
                                  $('.special').attr("disabled", true)
                                }
                              }
                            </script>
                          </div>

                          <div class="col-md-6 ">
                            <div class="form-group row">
                              <label for="" class="col-xl-3 col-form-label text-muted">Paint Color</label>
                              <div class="col-xl">
                                <input type="text" class="form-control special" name="special_color" value="<?= $main[0]['special']==0 ? $paint_detail['color'] : $main[0]['special_color'] ?>" <?= $main[0]['special']==0 ? 'disabled' : '' ?>>
                              </div>
                            </div>
                          </div>

                    </div>
                  </div>
                </div>
                <hr>
                <?php foreach ($main as $key => $value) { ?>
                  <input type="hidden" name="id[]" value="<?= $value['id_bnp'] ?>">
                <?php } ?>
                <table class="table table-bordered table-hover" id="tbl_rfi_detail">
                  <thead>
                    <tr class="bg-gray-table">
                      <th><center>ITEM / TAG NUMBER</center></th>
                      <th><center>ITEM / TAG DESCRIPTION</center></th>
                      <th>
                        <button type='button' class="btn btn-sm btn-primary <?= $main[0]['status_invitation']==1 ? 'd-none' : '' ?>" onclick="add_row_rfi()"><i class="fas fa-plus"></i></button></th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php if($rfi_detail){ ?>
                      <?php foreach ($rfi_detail as $key => $value) : ?>
                        <?php //test_var($value); ?>
                        <tr>
                          <td>
                            <input type='text' class='form-control' disabled value='<?php echo $value["tag_no"] ?>'>
                          </td>
                          <td>
                            <?php //if($main[0]['id_paint_system']!=11 AND 1==2){ ?>
                              <input type='text' class='form-control' disabled value='<?php echo $value["tag_description"] ?>'>
                            <?php //} ?>
                          </td>
                          <td>
                            <?php if ($this->user_cookie[7] != 8) { ?>
                              <button type='button' class='btn btn-danger <?= $main[0]['status_invitation']==1 ? 'd-none' : '' ?>' onclick='delete_data_rfi_detail(this, "<?php echo $value["id"] ?>")'>
                                <i class='fas fa-trash-alt'></i>
                              </button>
                            <?php } ?>
                          </td>
                          
                        </tr>
                      <?php endforeach; ?>
                    <?php } else { ?>
                      <?php foreach ($irn_tag as $key => $value) : ?>
                        <?php //test_var($value) ?>
                        <tr>
                          <td>
                            <input type='text' class='form-control' required name='tag_no[<?= $key ?>]' value='<?php echo $value["item_tag_no"] ?>'>
                          </td>
                          <td>
                            <input type='text' class='form-control' required name='tag_description[<?= $key ?>]' value='<?php echo $value["item_tag_description"] ?>'>
                          </td>
                          <td>
                            <?php if ($this->user_cookie[7] != 8) { ?>
                              <?php //if($key==0){ ?>
                                <button type='button' class='btn btn-danger' onclick='delete_row_rfi_detail(this, "<?php echo $value["id"] ?>")'>
                                  <i class='fas fa-trash-alt'></i>
                                </button>
                              <?php //} ?>
                            <?php } ?>
                          </td>
                          
                        </tr>
                      <?php endforeach; ?>
                    <?php } ?>
                  </tbody>

                </table>
                <button type="submit" class="btn btn-primary <?= $main[0]['status_invitation']==1 ? 'd-none' : '' ?>"><i class="fas fa-save"></i> Save RFI</button>

                <?php if($main[0]['wp_type']!=2){ ?>
                  <a class="btn btn-danger" href="<?= base_url('planning_bnp/pdf_rfi_landscape/').strtr($this->encryption->encrypt($main[0]['request_no']),'+=/', '.-~') ?>" target="_blank">
                    <i class="fas fa-file-pdf"></i> Inspection Notification PDF
                  </a>
                <?php } ?>

                <?php if($main[0]['report_number']){ ?>
                  <a class="btn btn-danger <?= $main[0]['wp_type']==2 ? 'd-none' : '' ?>" href="<?= base_url('planning_bnp/pdf_rfi_potrain/').$main[0]['transmittal_uniqid'] ?>" target="_blank">
                    <i class="fas fa-file-pdf"></i> PDF
                  </a>
                  |
                  <?php if($main[0]['status_invitation']==0){ ?>
                    <a class="btn btn-info btnotif" href="<?= base_url('planning_bnp/send_invitation/').$main[0]['transmittal_uniqid'] ?>">
                      <i class="fas fa-envelope"></i> Send RFI
                    </a>
                    <input onclick='setNotif("<?= $main[0]['transmittal_uniqid'] ?>", this)' type="checkbox" checked="" value="1" id="weekday-1" clas="form-control" style="transform: scale(2); margin: 5px !important; margin-left: 15px !important" />
                    <label for="weekday-1" style="display: inline"><b style="font-size: 12pt !important">With Notif</b></label>
                    <script type="text/javascript">
                      function setNotif(transmittal_uniqid, ini){
                        var check = $(ini)[0].checked
                        if(check==false){
                          $(".btnotif").attr("href", "<?= base_url('planning_bnp/send_invitation/').$main[0]['transmittal_uniqid'] ?>"+"/1")
                        } else {
                          $(".btnotif").attr("href", "<?= base_url('planning_bnp/send_invitation/').$main[0]['transmittal_uniqid'] ?>")
                        }
                      }
                    </script>
                  <?php } else { ?>
                    <a class="btn btn-secondary" onclick="confirmation(event)" href="<?= base_url('planning_bnp/return_invitation/').$main[0]['transmittal_uniqid'] ?>">
                      <i class="fas fa-reply"></i> Return Invitation
                    </a>
                    <script type="text/javascript">
                      function confirmation(here) {
                        here.preventDefault()
                        var urlToRedirect = here.currentTarget.getAttribute('href');

                        Swal.fire({
                          title: 'Are you sure to Return Invitation?',
                          text: "",
                          type: 'warning',
                          showCancelButton: true,
                          confirmButtonColor: '#3085d6',
                          cancelButtonColor: '#d33',
                          confirmButtonText: 'Yes, Return!'
                        }).then((result) => {

                          if (result.value) {
                            console.log('ke sini', urlToRedirect)
                            location.replace(urlToRedirect)
                            Swal.fire({
                              type: "success",
                              title: "SUCCESS",
                              text: "Data Has Been Returned!"
                            });
                          }
                        })
                      }
                    </script>
                  <?php } ?>
                <?php } ?>
              </div>
            </div>
          </div>
        </form>

        <div class="col-12">
          <div class="card shadow my-3 rounded-0">
            <div class="card-header">
              <h6 class="m-0">Attachment</h6>
            </div>
            <div class="card-body bg-white">
              <button class="btn btn-info <?= $main[0]['status_invitation']==0 ? 'd-none' : '' ?>" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalRedline">
                <i class="fas fa-plus-circle"></i> Add Attachment
              </button>
              <br/><br/>

              <table class="table table-hover text-center table_attachment">
                  <thead class="bg-gray-table">
                      <th>No</th>
                      <th>Attachment Name</th>
                      <th>for <?= $wp_type==2 ? 'Unique' : 'Piecemark' ?></th>
                      <th>Uploaded By</th>
                      <th>Uploaded Date</th>
                      <th></th>
                  </thead>
                  <tbody>
                    <?php $no = 1;foreach ($attachment_list as $key => $value): ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td>
                          <a target="_blank" href="<?= base_url() ?>planning_bnp/open_bnp_atc/<?= $value['filename'] ?>"> <?= $value['filename'] ?></a>
                        </td>
                        <td>
                          <?php if($value['id_detail_wp_paint_system']=='-1'){ ?>
                            <b>All <?= $wp_type==2 ? 'Unique' : 'Piecemark' ?> Under This Report</b>
                          <?php } else { ?>

                            <?= $wp_type==2 ? $unique_no[$piecemark_by_idwpps[$value['id_detail_wp_paint_system']]['id_template']]['unique_no'] : $piecemark_name[$piecemark_by_idwpps[$value['id_detail_wp_paint_system']]['id_template']]['part_id'] ?>
                          <?php } ?>
                        </td>
                        <td><?= $user[$value['upload_by']]['full_name'] ?></td>
                        <td><?= $value['upload_datetime'] ?></td>
                        <td>
                          <a href="<?= base_url('planning_bnp/removeAttachment/').strtr($this->encryption->encrypt($value['id']),'+=/', '.-~') ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
    </div>

        

      <!-- </div>  -->
    <!-- </form> -->

    <div class="modal fade" id="modalRedline" role="dialog">
      <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
          <form action="<?php echo base_url();?>planning_bnp/add_attachment" method="POST"  enctype="multipart/form-data">
            <div class="modal-header">
              <h4 class="modal-title">Add Attachment</h4>
            </div>
            <div class="modal-body">

              <b><i>Upload By :</i></b>
              <input type="text" name="upload_byx" class="form-control" required value="<?= $this->user_cookie[1] ?>" readonly>
              <input type="hidden" name="upload_by" required value="<?= $this->user_cookie[0] ?>">
              <input type="hidden" name="submission_id" required value="<?= $main[0]['transmittal_uniqid'] ?>"><br>
              
              <b><i>Upload Date :</i></b>
              <input type="text" name="upload_datetime" class="form-control" required value="<?= DATE('Y-m-d H:i:s') ?>" readonly><br>

              <b><i>Attachment File :</i></b><br>
              <input type="file" name="attachment[]" accept="application/pdf" multiple="" required>

              <br><br>
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="all_piecemark" style="width: 20px !important; height: 20px !important" value="1">
                <label class="form-check-label" for="exampleCheck1" ><b>All Piecemark</b></label>
              </div>

              <br>
              <table class="table table-hover text-center dataTable">
                <thead class="bg-gray-table text-white">
                <tr>
                    <th>NO</th>
                    <th><?= $wp_type==2 ? 'UNIQUE NO.' : 'PIECEMARK NO.' ?></th>
                    <th>DRAWING NUMBER</th>
                    <th>PAINT SYSTEM</th>
                </tr>
                </thead>
                <?php //test_var($workpack_list); ?>
                <?php if($wp_type==0){ ?>
                  <tbody>
                    <?php foreach ($workpack_list as $key => $value) { ?>
                      <tr>
                        <td style="vertical-align: middle !important;">
                          <input type="checkbox" name="id_detail_wp_paint_systemx[]" value="<?= $value['id_detail_wp_paint_system'] ?>" style="width: 20px !important; height: 20px !important" onclick="saveValue(this)">
                        </td>
                        <td><?= $piecemark_name[$value['id_template']]['part_id'] ?></td>
                        <td><?= $piecemark_name[$value['id_template']]['drawing_ga'] ?></td>
                        <td><?= $paint_system[$value['id_paint_system']]['name'] ?></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                <?php } elseif($wp_type==1) { ?>
                  <tbody>
                    <?php foreach($list as $key => $value){
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
                        <td style="vertical-align: middle !important;">
                          <input type="checkbox" name="id_detail_wp_paint_system[]" value="<?= $arr_wp[$value['id_piecemark']]['id_detail_wp_paint_system'] ?>" style="width: 20px !important; height: 20px !important">
                        </td>
                        <td><?= $value['part_id'] ?></td>
                        <td><?= $value['drawing_ga'] ?></td>
                        <td><?= $paint_system[$arr_bp[$arr_wp[$value['id_piecemark']]['id']]['id_paint_system']]['name'] ?></td>
                      </tr>          
                    <?php } ?>                     
                  </tbody>
                <?php } else { ?>
                  <tbody>
                    <?php foreach ($workpack_list as $key => $value) { ?>
                      <tr>
                        <td style="vertical-align: middle !important;">
                          <input type="checkbox" name="id_detail_wp_paint_systemx[]" value="<?= $value['id_detail_wp_paint_system'] ?>" style="width: 20px !important; height: 20px !important" onclick="saveValue(this)">
                        </td>
                        <td><?= $unique_no[$value['id_template']]['unique_no'] ?></td>
                        <td><?= $workpack_list[0]['drawing_no'] ?></td>
                        <td><?= $paint_system[$value['id_paint_system']]['name'] ?></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                <?php } ?>
              </table> 

            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
            </div>
          </form>
        </div>
        
      </div>
    </div>
      
</div>
</div>



<script>
  function add_row_rfi() {
    // var table;
    table = "<tr>" +
      "<td><input type='text' class='form-control' required name='tag_no[]'><input type='hidden' name='id_detail[]'></td>" +

      <?php if($main[0]['id_paint_system']!=11 AND 1==2){ ?>
        "<td><input type='text' class='form-control' required name='tag_description[]'></td>" +
      <?php } else { ?>
        "<td></td>" +
      <?php } ?>

      "<td><button type='button' class='btn btn-danger' onclick='delete_row_rfi_detail(this)'><i class='fas fa-trash-alt'></i></button></td>" +
      "<tr>";
    // angka++
    $("#tbl_rfi_detail tbody").append(table);
    $(".select2").select2()
  }

  function delete_row_rfi_detail(btn) {
    $(btn).closest("tr").remove();
  }

  var arrai = []
  function saveValue(ini){
    if($(ini)[0].checked == true){
      console.log('centang')
      arrai.push($(ini).val())
    } else {
      console.log('gak centang')
      arrai = $.grep(arrai, function(value) {
        return value != $(ini).val();
      });
    }
    console.log(arrai);
    $('.id_detail_wp_paint_system').val('')
    $('.id_detail_wp_paint_system').val(arrai)
  }

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
        allowClear: true,
        tokenSeparators: [', ', ' '],
    }) 
  }
  

  $('.dataTable').DataTable({
    order: [],
    columnDefs: [{
      "targets": 0,
      "orderable": false,
    }]
  })

  var data_checkbox = [];
  function save_checkbox(input) {
    console.log(data_checkbox);
    if($(input).prop("checked") == true && $.inArray($(input).val(), data_checkbox) == -1){
      data_checkbox.push($(input).val());
    }
    else if($(input).prop("checked") == false && $.inArray($(input).val(), data_checkbox) != -1){
      data_checkbox.splice( $.inArray($(input).val(), data_checkbox), 1 );
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
      sweetalert("loading", "Please wait...!");
      $("#form_create_workpack input[name=template_id]").val(data_checkbox.join(", "));
      document.getElementById("form_create_workpack").submit();
    }
    else{
      sweetalert("error", "No item selected!");
    }
  }

  $(".autocomplete_irn_approved").autocomplete({
    source: function( request, response ) {
      var project_id = $("#project_id option:selected").val();
      var drawing_type = 3;
      $.ajax( {
        url: "<?php echo base_url() ?>planning/autocomplete_irn_approved",
        dataType: "json",
        data: {
          term: request.term,
          drawing_type: drawing_type,
          project_id: project_id,
        },
        success: function( data ) {
          response( data );
        }
      });
    },
    // select: function (event, ui) {
    //   var value = ui.item.value;
    //   if(value == 'No Data.'){
    //     ui.item.value = "";
    //   }
    //   else{
    //     get_data_drawing(ui.item.value);
    //   }
    // }
  });

  function delete_data_rfi_detail(ini, id){
    Swal.fire({
      title: 'Are you sure to Delete this Row?',
      text: "",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Send!'
    }).then((result) => {

      if (result.value) {
        $.ajax({
          url: "<?php echo base_url() ?>planning_bnp/remove_detail_bnp",
          dataType: "json",
          data: {
            id: id,
          },
          success: function( data ) {
            Swal.fire({
              type: "success",
              title: "SUCCESS",
              text: "Data Has Been Removed!"
            });
            $(ini).closest("tr").remove();
            // location.reload(); 
          }
        });
      }
    })
  }

</script>