<div id="content" class="container-fluid">

  <div class="card shadow my-3 rounded-0">
    <div class="card-header">
      <h6 class="m-0"><?php echo $meta_title ?></h6>
    </div>

    <div class="card-body bg-white overflow-auto">
      <a href="<?php echo base_url() ?>master/ndter/personnel_list" class="btn btn-sm btn-warning"><i class="fas fa-arrow-left"></i> Back</a><br/><br/>

      <form action="<?php echo base_url() ?>master/ndter/personnel_<?php echo $module ?>_process" method="POST" enctype="multipart/form-data">
        
      <input type="hidden" name="id" value="<?php echo @$personnel['id'] ?>">

        <div class="row">

          <div class="col-12">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Project ID</label>
              <div class="col-md">
                 <select name='project_id' class='select2 form-control' required>
                   <option value=''>~ Choose ~</option>
                   <?php foreach($show_project as $key => $value){ ?>
											<?php if(in_array($value['id'], $this->user_cookie[13])): ?>
                        <option value="<?= $value["id"] ?>" <?= ($value["id"] == @$personnel["project_id"] || $this->user_cookie[10] == $value["id"] ? "selected" : null) ?>><?= $value["project_name"] ?></option>
											<?php endif; ?>
                   <?php } ?>
                 </select>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Personel Name</label>
              <div class="col-md">
                <input type="text" class="form-control" name="personel_name" value="<?php echo @$personnel['personel_name'] ?>" placeholder='Type NDT Tech Personnel Name' required>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Designation</label>
              <div class="col-md">
                 <select name='designation' class='select2 form-control' required>
                 <option value=''>~ Choose ~</option>
                   <?php foreach($show_list_designation as $key => $value){ ?>
                        <option value="<?= $value["id_designation"] ?>" <?= ($value["id_designation"] == @$personnel["designation"] ? "selected" : null) ?>><?= $value["designation_name"] ?></option>
                   <?php } ?>
                 </select>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Qualification</label>
              <div class="col-md">
                 <select name='qualification' class='select2 form-control' required>
                 <option value=''>~ Choose ~</option>
                   <?php foreach($show_list_qualitifcation as $key => $value){ ?>
                        <option value="<?= $value["id_qualification"] ?>" <?= ($value["id_qualification"] == @$personnel["qualification"] ? "selected" : null) ?>><?= $value["qualification_name"] ?></option>
                   <?php } ?>
                 </select>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Certificate Number</label>
              <div class="col-md">
              <input type="text" class="form-control" name="certificate_number" value="<?php echo @$personnel['certificate_number'] ?>" placeholder='Type NDT Certificate Number' required>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Upload File</label>
              <div class="col-md">
                <div class="custom-file mb-1">
                  <input type="file" name="file" class="custom-file-input">
                  <label class="custom-file-label">Choose file</label>
                </div>
                <?php if(@$personnel["attachment"] != ''): ?>
                <!-- <a href="<?php echo base_url_ftp(); ?>upload/ndt_personnel/<?php echo $personnel["attachment"] ?>" class="btn btn-sm btn-flat btn-dark"><i class="fas fa-file-download"></i></a> -->
                      <?php  
                            $enc_redline = strtr($this->encryption->encrypt($personnel["attachment"]), '+=/', '.-~');
                            $enc_path   = strtr($this->encryption->encrypt('/PCMS/pcms_v2/ndt_personnel/'), '+=/', '.-~'); 
                          ?>
                          <a target='_blank' href='<?= site_url('irn/open_file/'.$enc_redline.'/'.$enc_path) ?>'><span class='btn btn-primary'><i class="fas fa-images"></i></span></a>
                          <br/>
                <?php endif; ?>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">PCN Number</label>
              <div class="col-md">
              <input type="text" class="form-control" name="pcn_number" value="<?php echo @$personnel['pcn_number'] ?>" placeholder='Type NDT PCN Number' required>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">ISO Number</label>
              <div class="col-md">
              <input type="text" class="form-control" name="iso_number" value="<?php echo @$personnel['iso_number'] ?>" placeholder='Type NDT ISO Number'>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Certificate Date Of Issued</label>
              <div class="col-md">
              <input type="date" class="form-control" name="date_of_issue" value="<?php echo @$personnel['date_of_issue'] ?>" placeholder='Type NDT Certificate Date Of Issued' required>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Certificate Date Of Expired</label>
              <div class="col-md">
              <input type="date" class="form-control" name="date_of_expired" value="<?php echo @$personnel['date_of_expired'] ?>" placeholder='Type NDT Certificate Date Of Expired' required>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Mockup Test Result</label>
              <div class="col-md">
                    <table>
                    <tr>
                      <?php 
                          $list_of_result = array("PLATE","PIPE","TJOINT","NOZZLE","NODE");
                          $mockup = explode(";",@$personnel['mock_up_test_result']);
                          for($i=0;$i<5;$i++){ 
                      ?> 
                           <td><?= $list_of_result[$i] ?></td>
                           <td style='width:100px !important;padding:10px;'>
                              <select class="form-control" name="mtr[<?= $i ?>]" required>
                                <option value=''>~ Choose ~</option>
                                <option value="1" <?php echo (@$mockup[$i] == "1" ? "selected" : "") ?>>Pass</option>
                                <option value="2" <?php echo (@$mockup[$i] == "2" ? "selected" : "") ?>>Fail</option>
                                <option value="3" <?php echo (@$mockup[$i] == "3" ? "selected" : "") ?>>N/A</option>
                              </select> 
                           </td> 
                        
                      <?php } ?>
                      </tr>

                    </table>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">SIP Number</label>
              <div class="col-md">
                <input type="number" class="form-control" name="sip_no" value="<?php echo @$personnel['sip_no'] ?>" placeholder='Type SIP Number' >
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Company</label>
              <div class="col-md">
                <select name='company' class='select2 form-control' required>
                 <option value=''>~ Choose ~</option>
                   <?php foreach($show_list_company as $key => $value){ ?>
                        <option value="<?= $value["id_company"] ?>" <?= ($value["id_company"] == @$personnel["company"] ? "selected" : null) ?>><?= $value["company_name"] ?></option>
                   <?php } ?>
                 </select>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Issued Date</label>
              <div class="col-md">
              <input type="date" class="form-control active-user" name="issue_date" value="<?php echo @$personnel['issue_date'] ?>" placeholder='Issued Date' required>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Expired Date</label>
              <div class="col-md">
              <input type="date" class="form-control active-user" name="expired_date" value="<?php echo @$personnel['expired_date'] ?>" placeholder='Expired Date' required>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Remarks</label>
              <div class="col-md">
              <input type="text" class="form-control" name="remarks" value="<?php echo @$personnel['remarks'] ?>" placeholder='Remarks'>
              </div>
            </div>
          </div>
          
          <div class="col-12">
            <div class="form-group row">
              <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Status</label>
              <div class="col-md">
                <select class="form-control" name="status" onchange="change_status(this)">
                  <option value="0" <?php echo (@$personnel["status"] == "0" ? "selected" : "") ?>>Active</option>
                  <option value="1" <?php echo (@$personnel["status"] == "1" ? "selected" : "") ?>>Non-Active</option>
                </select> 
              </div>
            </div>
          </div>

        </div>

        <div class="row">
          <div class="col-12 text-right">
            <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>

</div>
</div>

<script type="text/javascript">
  function change_status(select){
    var val = $(select).val();

    console.log(val);

    if(val == 1){
      $('.active-user').prop('required',false);
    } else {
      $('.active-user').prop('required',true);
    }

  }
</script>