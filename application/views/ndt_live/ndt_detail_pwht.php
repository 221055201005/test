<?php
	$irn_revision = (isset($show_pcms_irn[0]["irn_revision"]) ? $show_pcms_irn[0]["irn_revision"] : 0);
	$irn_revision_show = str_pad(substr($irn_revision,-2), 2, '0', STR_PAD_LEFT);  
	// test_var($detail);
?>

<style type="text/css">

  .bg-selected {
      background-color: #949494;
  }

  .titleHead {
    border:1px #000 solid;
    border-collapse: collapse;
    text-align: center;
    vertical-align: middle;
    font-size: 100%;
    background-color: #a6ffa6;
    font-weight: bold;
   
  }

  .titleHeadMain {
    text-align: center;
    border-collapse: collapse;
    text-align: center;
    vertical-align: middle;
    font-size: 25px;
    font-weight: bold;
  }

  /*table.table td {
    font-size: 100%;
    border:1px #000 solid;
    font-weight: bold;
    max-width: 150px;
    word-wrap: break-word;
  }*/

  /*table>thead>tr>td,table>tbody>tr>td{
    vertical-align: top;
  }*/

  .br_break{
    line-height: 15px;
  }

  .br_break_no_bold{
    line-height: 18px;
  }

  .br{
    border-right: 1px #000 solid !important;
  }
  .bl{
    border-left: 1px #000 solid;
  }
  .bt{
    border-top: 1px #000 solid;
  }
  .bb{
    border-bottom:  1px #000 solid;
  }
  .bx{
    border-left: 1px #000 solid;
    border-right: 1px #000 solid;
  }

  .by{
    border-top: 1px #000 solid;
    border-bottom: 1px #000 solid;
  }

  .ball{
    border-top: 1px #000 solid;
    border-bottom: 1px #000 solid;
    border-left: 1px #000 solid;
    border-right: 1px #000 solid;
  }
  .tab{
    display: inline-block; 
    width: 130px;
  }
  .tab2{
    display: inline-block; 
    width: 130px;
  }
  .text-nowrap{
    white-space: nowrap;
  }
  .valign-middle{
    vertical-align: middle;
  }
  label {
    display: block;
    padding-left: 2px;
    padding-bottom: 5px;
    padding-top: 1px;
    text-indent: 1px;
    font-size: 100%;
  }

  input {
    width: 16px;
    height: 16px;
    padding: 0;
    margin:0;
    vertical-align: bottom;
    position: relative;
    top: -1px;
    *overflow: hidden;
  }

  input[type=checkbox]
  {
    /* Double-sized Checkboxes */
    -ms-transform: scale(0.8); /* IE */
    -moz-transform: scale(0.8); /* FF */
    -webkit-transform: scale(0.8); /* Safari and Chrome */
    -o-transform: scale(0.8); /* Opera */
    transform: scale(0.8);
    /*padding: 1px;*/
  }

  /* Might want to wrap a span around your checkbox text */
  .checkboxtext
  {
    /* Checkbox text */
    font-size: 100%;
    display: inline;
  }

  textarea {
    width: 95%;
    height: 250px !important;
  }

  .button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 10px 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    transition-duration: 0.4s;
    cursor: pointer;
    border-radius: 10px;
  }

  .button2 {
    background-color: #00b52a; 
    color: white;
    border: 2px solid #00b52a;
  }

  .button2:hover {
    background-color: #017d1e;
    color: white;
  }

  .button3 {
    background-color: #d4ad00; 
    color: white;
    border: 2px solid #d4ad00;
  }

  .button3:hover {
    background-color: #e6bb00;
    color: white;
  }

  .button4 {
    background-color: #d42626; 
    color: white;
    border: 2px solid #d42626;
  }

  .button4:hover {
    background-color: #cc0000;
    color: white;
  }

  #example1 {
/*      border-radius: 25px;*/
    border: 1px solid;
    padding: 10px;
    box-shadow: 5px 10px;
    width:100%;
  }

  #example2 {
/*      border-radius: 25px;*/
    border: 1px solid;
    padding: 10px;
    box-shadow: 5px 10px;
    width:100%;
  }

</style>
<br/>
<div id="content" class="container-fluid overflow-auto">

  <!-- TAB -->
  <div class="row">
    <div class="col-md-12">
      <div class="card rounded-0 shadow">
        <div class="card-header">
          <h6 class="card-title m-0"> NDT List - <strong><?= $method ?></strong></h6>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">

              <!-- Nav tabs -->
              <ul class="nav nav-tabs">
                <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#joint_detail">Detail</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#menu2">Attachment</a>
                </li>
              </ul>

              <!-- Tab panes -->
              <div class="tab-content">

                <div id="joint_detail" class="container tab-pane  col-md-12 active"><br>
                  <div class="row">
                    <div class="col-md-12">
                      <br/>
                      <form action="<?= base_url("ndt_live/update_ndt_pwht") ?>" method="POST">
                        <input type="hidden" name="uniq_id_report" value="<?= $main['uniq_id_report'] ?>">
                        <?php //if($main["status_inspection"]==0){ ?>
	                        <div class="row">
	                        	<div class="col-2"><strong>Date of Inspection</strong></div>
	                        	<div class="col-2">
	                        		<input
			                        	class="form-control"
			                        	type="date" 
			                        	name="date_of_inspection" 
			                        	value="<?= DATE('Y-m-d', strtotime($main['date_of_inspection'])) ?>"
			                        	<?= $main["status_inspection"]==0 ? '' : 'disabled' ?>
			                        >
	                        	</div>
	                        	<div class="col-2">
	                        		<input
			                        	class="form-control"
			                        	type="time" 
			                        	name="time_of_inspection" 
			                        	value="<?= DATE('H:i:s', strtotime($main['date_of_inspection'])) ?>"
			                        	<?= $main["status_inspection"]==0 ? '' : 'disabled' ?>
			                        >
	                        	</div>
	                        </div>
	                      <?php //} ?>
                        <br>
                        <center>
                        <div id='example1'>
                          
                          <table  border="0px" style="border-collapse: collapse !important;padding:10px;" width="100%">
                            <tr colspan="17">
                              <td style="text-align: left; padding: 5px;width: 20% !important;vertical-align: middle !important;">
                                <img src="<?= base_url() ?>img/seatrium-logo.png" style="width: 170px; zoom: 2;">
                              </td>
                              <td style="text-align: center; padding: 5px;width: 60% !important;vertical-align: middle !important;">
                                <h3><?= $project['description'] ?></h3>
                              </td>
                              <td style="text-align: right; padding: 5px;width: 20% !important;vertical-align: middle !important;">
                                <img src="<?= $project['client_logo'] ?>" style="width: 120px;">
                              </td>
                            </tr>
                          </table>

                          <table border="1px" style="border-collapse: collapse !important;padding:20px !important;" width="100%">
                            <tr class="bg-gray-table">
                              <th style="text-align:center; vertical-align: middle;" >S/N</th>
                              <th style="text-align:center; vertical-align: middle;" >Weld Map Dwg / Line & Spool No</th>
                              <th style="text-align:center; vertical-align: middle;" >Joint No</th>
                              <th style="text-align:center; vertical-align: middle;" >Joint Type</th>
                              <th style="text-align:center; vertical-align: middle;" >Size/Dia</th>
                              <th style="text-align:center; vertical-align: middle;" >Sch</th>
                              <th style="text-align:center; vertical-align: middle;" >Thk (mm)</th>
                              <th style="text-align:center; vertical-align: middle;" >Total Length (mm)</th>
                              <th style="text-align:center; vertical-align: middle;" >Welding Process</th>
                              <th style="text-align:center; vertical-align: middle;" >Welder ID</th>
                              <th style="text-align:center; vertical-align: middle; width: 100px !important;" >Result</th>
                              <th style="text-align:center; vertical-align: middle;" >Remarks</th>
                            </tr>

                            <?php foreach ($detail as $key => $value) { ?>
                              <tr style="text-align: center; vertical-align: middle;">
                                <td><?= $key+1 ?></td>
                                <td><?= $joint[$value['id_joint']]['drawing_wm'] ?></td>
                                <td><?= $joint[$value['id_joint']]['joint_no'].($value['revision']>0 ? '('.$value['revision_category'].$value_rere['revision'].')' : '') ?></td>
                                <td><?= $joint[$value['id_joint']]['joint_type'] ?></td>
                                <td><?= $joint[$value['id_joint']]['diameter'] ?></td>                  
                                <td><?= $joint[$value['id_joint']]['sch'] ?></td>
                                <td><?= $joint[$value['id_joint']]['thickness'] ?></td>
                                <td><?= $joint[$value['id_joint']]['weld_length'] ?></td>
                                <td>
                                  <!-- weld_process -->
                                  <?php 
                                    if(explode(';', $joint[$value['id_joint']]['wps_no_rh'])){
                                      foreach (array_filter(explode(';', $joint[$value['id_joint']]['wps_no_rh'])) as $key_a => $value_a) {
                                        foreach ($wps_detail[$value_a] as $key_b => $value_b) {
                                          $wproccess[$key][] = $master_wp[$value_b['id_weld_process']];
                                        }
                                      }
                                    }
                                    if(explode(';', $joint[$value['id_joint']]['wps_no_fc'])){
                                      foreach (array_filter(explode(';', $joint[$value['id_joint']]['wps_no_rh'])) as $key_a => $value_a) {
                                        foreach ($wps_detail[$value_a] as $key_b => $value_b) {
                                          $wproccess[$key][] = $master_wp[$value_b['id_weld_process']];
                                        }
                                      }
                                    }
                                  ?>
                                  <?= implode(", ", array_unique(array_filter($wproccess[$key]))) ?>    
                                </td>
                                <td><?= $welder[$value['id_welder']]['welder_code'] ?></td>
                                <?php if($key==0){ ?>
                                  <td rowspan="<?= COUNT($detail) ?>" style="vertical-align: middle;">
                                    ACC <input type="radio" <?= $main['result']==1 ? 'checked' : '' ?> name="result" value="1">
                                    <br>
                                    REJ <input type="radio" <?= $main['result']==2 ? 'checked' : '' ?> name="result" value="2">   
                                  </td>  
                                <?php } ?>
                                <td>
                                  <input class="form-control" type="text" name="remarks[<?= $value['id_mt'] ?>]" value=<?= $value['remarks'] ?>>
                                </td>
                              </tr>
                            <?php } ?>

                          </table>

                          <br>

                          <table border="1px" style="border-collapse: collapse !important;padding:20px !important;" width="100%">
                            <tr>
                              <td colspan="1" style="text-align:center ;border-left: 0px; border-right: 0px"></td>

                              <td colspan="3" style="text-align:center ;border-left: 0px; border-right: 0px">Tested by <br> NDT Level II</td>
                              <td colspan="4" style="text-align:center ;border-left: 0px; border-right: 0px">QC Inspector</td>
                              <td colspan="5" style="text-align:center ;border-left: 0px; border-right: 0px">Client Inspector</td>
                              <td colspan="4" style="text-align:center ;border-left: 0px; border-right: 0px">3rd party</td>
                            </tr>

                            <tr>
                              <td colspan="1" style="text-align:center ;border-left: 0px; border-right: 0px"></td>
                              <td colspan="3" style="text-align:center ;border-left: 0px; border-right: 0px">
                                <?php if($main["status_inspection"]>=1 OR $main['tested_by']){ ?>
                                  <img src="data:image/png;base64,<?= $user[$main['tested_by']]['sign_approval'] ?>" style='width: 4.5cm;vertical-align: text-bottom !important;' />
                                <?php } ?>
																<?php if ($this->user_cookie[7] != 8) : ?>
                                  <?php if($main['status_inspection']==0 AND !$main['tested_by']){ ?>
                                    <span class="btn btn-success" onclick="approve_request('<?= $main['uniq_id_report'] ?>', 0)">
                                      <i class="fas fa-check"></i>
                                      Approve NDT Level II
                                    </span>
                                  <?php } ?>
                                <?php endif; ?>
                              </td>
                              <td colspan="4" style="text-align:center ;border-left: 0px; border-right: 0px">
                                <?php if($main["status_inspection"]>=3){ ?>
                                  <img src="data:image/png;base64,<?= $user[$main['qc_by']]['sign_approval'] ?>" style='width: 4.5cm;vertical-align: text-bottom !important;' />
                                <?php } ?>
																<?php if ($this->user_cookie[7] != 8) : ?>
                                  <?php if($main['status_inspection']==1){ ?>
                                    <span class="btn btn-success" onclick="approve_request('<?= $main['uniq_id_report'] ?>', 3)">
                                      <i class="fas fa-check"></i>
                                      Approve QC
                                    </span>
                                  <?php } ?>
                                <?php endif; ?>
                              </td>
                              <td colspan="5" style="text-align:center ;border-left: 0px; border-right: 0px">
                                <?php if($main["status_inspection"]>=7){ ?>
                                  <img src="data:image/png;base64,<?= $user[$main['client_by']]['sign_approval'] ?>" style='width: 4.5cm;vertical-align: text-bottom !important;' />
                                <?php } ?>
                                <?php if($main['status_inspection']==5){ ?>
                                  <span class="btn btn-success" onclick="approve_request('<?= $main['uniq_id_report'] ?>', 7)">
                                    <i class="fas fa-check"></i>
                                    Approve Client
                                  </span>
                                <?php } ?>
                              </td>
                              <td colspan="4" style="text-align:center ;border-left: 0px; border-right: 0px">
                                <!-- <img src="data:image/png;base64,<?= $user[$main['tested_by']]['sign_approval'] ?>" style='width: 4.5cm;vertical-align: text-bottom !important;' /> -->
                              </td>
                            </tr>
                            <tr>
                              <td colspan="1" style="text-align:center ;border-left: 0px; border-right: 0px"></td>

                              <td colspan="3" style="text-align:center ;border-left: 0px; border-right: 0px">
                                <?php if($main["status_inspection"]>=1){ ?>
                                  <strong><?= $user[$main['tested_by']]['full_name'] ?></strong><br>
                                <?php } ?>
                                Name / Signature
                                <br>
                                Date: 
                                <?php if($main["status_inspection"]>=1){ ?>
                                  <strong><?= DATE("Y-m-d", strtotime($main['tested_date'])) ?></strong>
                                <?php } ?>
                              </td>
                              <td colspan="4" style="text-align:center ;border-left: 0px; border-right: 0px">
                                <?php if($main["status_inspection"]>=3){ ?>
                                  <strong><?= $user[$main['qc_by']]['full_name'] ?></strong><br>
                                <?php } ?>
                                Name / Signature
                                <br>
                                Date: 
                                <?php if($main["status_inspection"]>=3){ ?>
                                  <strong><?= DATE("Y-m-d", strtotime($main['qc_date'])) ?></strong>
                                <?php } ?>
                              </td>
                              <td colspan="5" style="text-align:center ;border-left: 0px; border-right: 0px">
                                <?php if($main["status_inspection"]>=7){ ?>
                                  <strong><?= $user[$main['client_by']]['full_name'] ?></strong><br>
                                <?php } ?>
                                Name / Signature
                                <br>
                                Date: 
                                <?php if($main["status_inspection"]>=7){ ?>
                                  <strong><?= DATE("Y-m-d", strtotime($main['client_date'])) ?></strong>
                                <?php } ?>
                              </td>
                              <td colspan="4" style="text-align:center ;border-left: 0px; border-right: 0px">
                                Name / Signature
                                <br>
                                Date: 
                              </td>
                            </tr>
                            <!-- <tr> -->
                              <!-- <td colspan="17" style="font-weight: bold; text-align:left;border-left: 0px; border-right: 0px"> -->
                                
                            <tr style="border: none !important;">
                              <td colspan="17" style="border: none !important; font-weight: bold;">Legend:</td>
                            </tr>
                            <tr style="border: none !important;">
                              <td colspan="2" style="border: none !important; font-weight: bold;">LI</td>
                              <td colspan="6" style="border: none !important;">: Linear - Lack of Penetration/Lack of Fusion/Crack</td>
                              <td colspan="2" style="border: none !important;"></td>
                              <td colspan="1" style="border: none !important; font-weight: bold;">Acc</td>
                              <td colspan="6" style="border: none !important;">: Accept</td>
                            </tr>
                            <tr style="border: none !important;">
                              <td colspan="2" style="border: none !important; font-weight: bold;">R</td>
                              <td colspan="6" style="border: none !important;">: Rounded - Slag of Inclusion/Porosity</td>
                              <td colspan="2" style="border: none !important;"></td>
                              <td colspan="1" style="border: none !important; font-weight: bold;">Rej</td>
                              <td colspan="6" style="border: none !important;">: Reject</td>
                            </tr>
                            <tr style="border: none !important;">
                              <td colspan="2" style="border: none !important;"></td>
                              <td colspan="6" style="border: none !important;"></td>
                              <td colspan="2" style="border: none !important;"></td>
                              <td colspan="1" style="border: none !important; font-weight: bold;">NAD</td>
                              <td colspan="6" style="border: none !important;">: Not Appearance Discontinuity</td>
                            </tr>
                              <!-- </td> -->
                            <!-- </tr> -->
                          </table>
                          <br/>
                            <?php if($main["status_inspection"]==0){ ?>
                              <button type="submit" class="btn btn-warning" name="status_inspection" value="0"><i class="fas fa-save"></i> Update</button>
                              <button type="submit" class="btn btn-primary" name="status_inspection" value="1"><i class="fas fa-paper-plane"></i> Submit to QC</button>
                            <?php } elseif($main["status_inspection"]==3){ ?>
                              <button type="submit" class="btn btn-primary" name="status_inspection" value="5"><i class="fas fa-paper-plane"></i> Submit to Client</button>
                            <?php } ?>
                          <br/>
                        </div>
                      </form>
                    </center>
                    <br/>
                    </div>
                  </div>
                </div>

                <div id="menu2" class="container tab-pane col-md-12 fade"><br>
                  <div class="col-md-12">
                    <div class="col-md-6">
                      <form action="<?php echo base_url('ndt_live/upload_new_attachment/9');?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Remarks Data :</label>
                              <textarea name='remarks' class='form-control' required="" style="height: 100px !important"></textarea>
                              <input type="hidden" class="form-control" name="submission_id" id="uniq_data" value="<?= $main['uniq_id_report'] ?>" autocomplete="off" readonly>
                              <input type="hidden" class="form-control" name="report_number" id="uniq_data" value="<?= $main['report_no'] ?>" autocomplete="off" readonly>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Revision No :</label>
                              <input class="form-control" type="number" name="revision">
                            </div>
                          </div>
	                        <div class="col-md-12">
	                          <div class="form-group">
	                            <label>Select File to upload :</label>
	                            <input type="file" class="form-control" name="file_attachment" id="file_attachment" required="">
	                          </div>                    
	                        </div>
                        </div>
                        <button type="submit" class="btn btn-secondary"> Upload</button>
                      </form>
                    </div>
                    <div class="col-md-12">
                      <table class="table text-muted">
                        <thead class="bg-gray-table">
                          <tr>
                            <th>ATTACHMENT</th>
                            <th>REVISION</th>
                            <th>UPLOAD BY</th>
                            <th>UPLOAD DATE</th>
                            <th>REMARKS</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>

                          <?php foreach ($data_attachment as  $value){ ?>
                            <tr>  
                              <td>
                                <a target="_blank" href="<?= base_url('ndt/open_atc/').$value["filename"].'/'.$value["filename"] ?>"><?php echo $value["filename"] ?></a>
                              </td>
                              <td><?= $value['revision'] ? $value['revision'] : '-' ?></td>
                              <td><?php echo $user_list[$value["created_by"]]['full_name'] ?></td>
                              <td><?php echo $value["created_date"] ?></td>
                              <td><?php echo $value["remarks"] ?></td>
                              <td><button class="btn btn-danger" type="button" onclick="delete_attachment_on_update('<?= $value["id"] ; ?>','<?= $value["uniq_data"]; ?>')"><i class="fa fa-trash"></i></button></td>
                            </tr>
                          <?php } ?>
                          <script type="text/javascript">
                            function delete_attachment_on_update(id,uniq_data){
                              Swal.fire({
                                title: 'Are you sure to <b class="text-warning">&nbsp;Delete&nbsp;</b> this?',
                                text: "This Attachment will permanent deleted!",
                                type: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, Delete it!'
                              }).then((result) => {
                                if (result.value) {
                                  $.ajax({
                                    url: "<?php echo base_url();?>ndt_live/delete_attachment",
                                    type: "post",
                                    data: {
                                      ndt : '<?= $initial ?>',
                                      id: id,
                                      uniq_data: uniq_data,
                                    },
                                    success: function(data) {
                                    if(data.includes("Error")){
                                       Swal.fire(
                                          'Ops..',
                                          data,
                                          'error'
                                        );
                                    } else {
                                        Swal.fire(
                                          'Success',
                                          'Your data has been Updated!',
                                          'success'
                                        );
                                        location.reload();
                                      }
                                    }
                                  });
                                }
                              })
                            }
                          </script>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END TAB -->
</div>
</div>
  
<script type="text/javascript">
  $("#table_list").DataTable()
  function approve_request(uniq_id_report, status_inspection){
    console.log(uniq_id_report, status_inspection)
    Swal.fire({
      type: 'success',
      title: 'Are You Sure to Sign this  Report?',
      showDenyButton: true,
      showCancelButton: true,
      confirmButtonText: 'Yes',
    }).then((result) => {
      console.log(result)
      if (result.value==true) {
        $.ajax({
          url: "<?= base_url() ?>ndt_live/approval_ndt_pwht",
          type: "POST",
          data: {
            'uniq_id_report': uniq_id_report,
            'status_inspection': status_inspection,
          },
        })
        Swal.fire('Success!', '', 'success')
        location.reload()
      } else {
        Swal.fire('Changes are not saved', '', 'info')
      }
    })
  }
</script>