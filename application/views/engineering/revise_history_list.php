<div id="content" class="container-fluid">

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <form action="<?php echo base_url() ?>engineering/revise_history_list" method="GET">
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Data</label>
                  <div class="col-md">
                    <select class="form-control" name="fabrication_type" required>
                      <option value="">----</option>
                      <option value="4" <?php echo @$get['fabrication_type'] == "4" ? "selected" : "" ?>>Update Piecemark</option>
                      <option value="5" <?php echo @$get['fabrication_type'] == "5" ? "selected" : "" ?>>Update Joint</option>
                      <option value="8" <?php echo @$get['fabrication_type'] == "8" ? "selected" : "" ?>>Change Piecemark Name</option>
                      <option value="16" <?php echo @$get['fabrication_type'] == "16" ? "selected" : "" ?>>Change Joint No</option>
                      <option value="9" <?php echo @$get['fabrication_type'] == "9" ? "selected" : "" ?>>Joint Void</option>
                      <option value="14" <?php echo @$get['fabrication_type'] == "14" ? "selected" : "" ?>>Update Piecemark that already has checked IRN</option>
                      <option value="11" <?php echo @$get['fabrication_type'] == "11" ? "selected" : "" ?>>Update Joint that already has checked IRN</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Status</label>
                  <div class="col-md">
                    <select class="form-control" name="status_revise" required>
                      <option value="">----</option>
                      <option value="1" <?php echo @$get['status_revise'] == "1" ? "selected" : "" ?>>Submitted</option>
                      <!-- <option value="2" <?php echo @$get['status_revise'] == "2" ? "selected" : "" ?>>Rejected</option> -->
                      <option value="3" <?php echo @$get['status_revise'] == "3" ? "selected" : "" ?>>Approved</option>
                      <option value="4" <?php echo @$get['status_revise'] == "4" ? "selected" : "" ?>>Completed</option>
                    </select>
                  </div>
                </div>
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
  
  <?php if(isset($get['submit'])): ?>
  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white">
          <div class="overflow-auto">
            <?php if(in_array(@$get['fabrication_type'], [4, 5])): ?>
              <table id="table_piecemark_list" class="table table-hover text-center dataTable">
                <thead class="bg-green-smoe text-white">
                  <tr>
                    <th>Drawing No</th>
                    <th>Request Date</th>
                    <th>Request Reason</th>
                    <th>Request By</th>
                    <th>Status</th>
                    <?php if(@$get['status_revise'] == 4): ?>
                    <th>Updated By</th>
                    <th>Updated Date</th>
                    <?php endif; ?>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($request_list as $key => $value): ?>
                  <tr>
                    <td><?php echo $value['submission_id'] ?></td>
                    <td><?php echo $value['request_date'] ?></td>
                    <td><?php echo $value['request_reason'] ?></td>
                    <td><?php echo @$user_list[$value['request_by']] ?></td>
                    <td>
                    <?php 
                      if($value['status_revise'] == 1){
                        echo "<span class='badge badge-info'>Submitted</span>";
                      }
                      elseif($value['status_revise'] == 2){
                        echo "<span class='badge badge-danger'>Rejected</span>";
                      }
                      elseif($value['status_revise'] == 3){
                        echo "<span class='badge badge-success'>Approved</span>";
                      }
                      elseif($value['status_revise'] == 4){
                        echo "<span class='badge badge-info'>Completed</span>";
                      }
                    ?>
                    </td>
                    <?php if(@$get['status_revise'] == 4): ?>
                    <td><?php echo @$user_list[$value['update_by']] ?></td>
                    <td><?php echo $value['update_date'] ?></td>
                    <?php endif; ?>
                    <td>
                      <?php if($value['status_revise'] == 1 && @$this->permission_cookie[134] == 1): ?>
                        <a href="<?php echo base_url() ?>engineering/revise_history_approve_process/<?php echo strtr($this->encryption->encrypt($value['id']), '+=/', '.-~') ?>/<?php echo strtr($this->encryption->encrypt(2), '+=/', '.-~') ?>" onclick="sweetalert('confirm', 'Are you sure to Reject this?', this, event)" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Reject</a>
                        <a href="<?php echo base_url() ?>engineering/revise_history_approve_process/<?php echo strtr($this->encryption->encrypt($value['id']), '+=/', '.-~') ?>/<?php echo strtr($this->encryption->encrypt(3), '+=/', '.-~') ?>" onclick="sweetalert('confirm', 'Are you sure to Approve this?', this, event)" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Approve</a>
                      <?php elseif($value['status_revise'] == 3): ?>
                        <button class="btn btn-warning btn-sm" onclick="update_data(<?php echo $value['id'] ?>, <?php echo $value['fabrication_type'] ?>)"><i class="fa fa-edit"></i> Update</button>
                      <?php endif; ?>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            <?php elseif(in_array(@$get['fabrication_type'], [8])): ?>
              <table id="table_piecemark_list" class="table table-hover text-center dataTable">
                <thead class="bg-green-smoe text-white">
                  <tr>
                    <th>Old Drawing SP</th>
                    <th>New Drawing SP</th>
                    <th>Old PartID</th>
                    <th>New PartID</th>
                    <th>Request Date</th>
                    <th>Request Reason</th>
                    <th>Request By</th>
                    <th>Status</th>
                    <?php if(@$get['status_revise'] == 4): ?>
                    <th>Approve By</th>
                    <th>Approve Date</th>
                    <?php endif; ?>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    foreach ($request_list as $key => $value): 
                      $data_new = explode("|", $value['submission_id']);
                  ?>
                  <tr>
                    <td>
                      <?php 
                        // 
                        if(@$data_new[1] != ""){
                          if(@$get['status_revise'] == 4 && isset($history_list[$value['id']]['drawing_sp']['data_before'])){
                            echo $history_list[$value['id']]['drawing_sp']['data_before'];
                          }
                          else{
                            echo $piecemark_list[$value['id_data']]['drawing_sp'];
                          }
                        }
                      ?>
                    </td>
                    <td><?php echo @$data_new[1] ?></td>
                    <td>
                      <?php 
                        if(@$get['status_revise'] == 4){
                          echo $history_list[$value['id']]['part_id']['data_before'];
                        }
                        else{
                          echo $piecemark_list[$value['id_data']]['part_id'];
                        }
                      ?>
                    </td>
                    <td><?php echo $data_new[0] ?></td>
                    <td><?php echo $value['request_date'] ?></td>
                    <td><?php echo $value['request_reason'] ?></td>
                    <td><?php echo @$user_list[$value['request_by']] ?></td>
                    <td>
                    <?php 
                      if($value['status_revise'] == 1){
                        echo "<span class='badge badge-info'>Submitted</span>";
                      }
                      elseif($value['status_revise'] == 2){
                        echo "<span class='badge badge-danger'>Rejected</span>";
                      }
                      elseif($value['status_revise'] == 3){
                        echo "<span class='badge badge-success'>Approved</span>";
                      }
                      elseif($value['status_revise'] == 4){
                        echo "<span class='badge badge-info'>Completed</span>";
                      }
                    ?>
                    </td>
                    <?php if(@$get['status_revise'] == 4): ?>
                    <td><?php echo @$user_list[$value['approve_by']] ?></td>
                    <td><?php echo $value['approve_date'] ?></td>
                    <?php endif; ?>
                    <td>
                      <?php if($value['status_revise'] == 1 && @$this->permission_cookie[135] == 1): ?>
                        <a href="<?php echo base_url() ?>engineering/revise_history_approve_process/<?php echo strtr($this->encryption->encrypt($value['id']), '+=/', '.-~') ?>/<?php echo strtr($this->encryption->encrypt(2), '+=/', '.-~') ?>" onclick="sweetalert('confirm', 'Are you sure to Reject this?', this, event)" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Reject</a>
                        <a href="<?php echo base_url() ?>engineering/rename_piecemark_process/<?php echo strtr($this->encryption->encrypt($value['id']), '+=/', '.-~') ?>/<?php echo strtr($this->encryption->encrypt(3), '+=/', '.-~') ?>" onclick="sweetalert('confirm', 'Are you sure to Approve this?', this, event)" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Approve</a>
                      <?php elseif($value['status_revise'] == 3): ?>
                        <button class="btn btn-warning btn-sm" onclick="update_data(<?php echo $value['id'] ?>, <?php echo $value['fabrication_type'] ?>)"><i class="fa fa-edit"></i> Update</button>
                      <?php endif; ?>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            <?php elseif(in_array(@$get['fabrication_type'], [16])): ?>
              <table id="table_piecemark_list" class="table table-hover text-center dataTable">
                <thead class="bg-green-smoe text-white">
                  <tr>
                    <th>Drawing WM</th>
                    <th>Old Joint No</th>
                    <th>New Joint No</th>
                    <th>Request Date</th>
                    <th>Request Reason</th>
                    <th>Request By</th>
                    <th>Status</th>
                    <?php if(@$get['status_revise'] == 4): ?>
                    <th>Approve By</th>
                    <th>Approve Date</th>
                    <?php endif; ?>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    foreach ($request_list as $key => $value): 
                      $data_new = explode("|", $value['submission_id']);
                  ?>
                  <tr>
                    <td><?php echo @$data_new[1] ?></td>
                    <td>
                      <?php 
                        if(@$get['status_revise'] == 4){
                          echo $history_list[$value['id']]['joint_no']['data_before'];
                        }
                        else{
                          echo $joint_list[$value['id_data']]['joint_no'];
                        }
                      ?>
                    </td>
                    <td><?php echo $data_new[0] ?></td>
                    <td><?php echo $value['request_date'] ?></td>
                    <td><?php echo $value['request_reason'] ?></td>
                    <td><?php echo @$user_list[$value['request_by']] ?></td>
                    <td>
                    <?php 
                      if($value['status_revise'] == 1){
                        echo "<span class='badge badge-info'>Submitted</span>";
                      }
                      elseif($value['status_revise'] == 2){
                        echo "<span class='badge badge-danger'>Rejected</span>";
                      }
                      elseif($value['status_revise'] == 3){
                        echo "<span class='badge badge-success'>Approved</span>";
                      }
                      elseif($value['status_revise'] == 4){
                        echo "<span class='badge badge-info'>Completed</span>";
                      }
                    ?>
                    </td>
                    <?php if(@$get['status_revise'] == 4): ?>
                    <td><?php echo @$user_list[$value['approve_by']] ?></td>
                    <td><?php echo $value['approve_date'] ?></td>
                    <?php endif; ?>
                    <td>
                      <?php if($value['status_revise'] == 1 && @$this->permission_cookie[135] == 1): ?>
                        <a href="<?php echo base_url() ?>engineering/revise_history_approve_process/<?php echo strtr($this->encryption->encrypt($value['id']), '+=/', '.-~') ?>/<?php echo strtr($this->encryption->encrypt(2), '+=/', '.-~') ?>" onclick="sweetalert('confirm', 'Are you sure to Reject this?', this, event)" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Reject</a>
                        <a href="<?php echo base_url() ?>engineering/rename_joint_process/<?php echo strtr($this->encryption->encrypt($value['id']), '+=/', '.-~') ?>/<?php echo strtr($this->encryption->encrypt(3), '+=/', '.-~') ?>" onclick="sweetalert('confirm', 'Are you sure to Approve this?', this, event)" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Approve</a>
                      <?php elseif($value['status_revise'] == 3): ?>
                        <button class="btn btn-warning btn-sm" onclick="update_data(<?php echo $value['id'] ?>, <?php echo $value['fabrication_type'] ?>)"><i class="fa fa-edit"></i> Update</button>
                      <?php endif; ?>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            <?php elseif(in_array(@$get['fabrication_type'], [9])): ?>
              <table id="table_piecemark_list" class="table table-hover text-center dataTable">
                <thead class="bg-green-smoe text-white">
                  <tr>
                    <th>Drawing WM</th>
                    <th>Joint No</th>
                    <th>Request Date</th>
                    <th>Request Reason</th>
                    <th>Request By</th>
                    <th>Status</th>
                    <?php if(@$get['status_revise'] == 4): ?>
                    <th>Approve By</th>
                    <th>Approve Date</th>
                    <?php endif; ?>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($request_list as $key => $value): ?>
                  <tr>
                    <td><?php echo @$joint_list[$value['id_data']]['drawing_wm'] ?></td>
                    <td><?php echo $value['submission_id'] ?></td>
                    <td><?php echo $value['request_date'] ?></td>
                    <td><?php echo $value['request_reason'] ?></td>
                    <td><?php echo @$user_list[$value['request_by']] ?></td>
                    <td>
                    <?php 
                      if($value['status_revise'] == 1){
                        echo "<span class='badge badge-info'>Submitted</span>";
                      }
                      elseif($value['status_revise'] == 2){
                        echo "<span class='badge badge-danger'>Rejected</span>";
                      }
                      elseif($value['status_revise'] == 3){
                        echo "<span class='badge badge-success'>Approved</span>";
                      }
                      elseif($value['status_revise'] == 4){
                        echo "<span class='badge badge-info'>Completed</span>";
                      }
                    ?>
                    </td>
                    <?php if(@$get['status_revise'] == 4): ?>
                    <td><?php echo @$user_list[$value['approve_by']] ?></td>
                    <td><?php echo $value['approve_date'] ?></td>
                    <?php endif; ?>
                    <td>
                      <?php if($value['status_revise'] == 1): ?>
                        <a href="<?= base_url() ?>engineering/search_joint?drawing_wm=<?= @$joint_list[$value['id_data']]['drawing_wm'] ?>&joint_no=<?= $value['submission_id'] ?>" class="btn btn-sm btn-info" target="_blank"><i class="fas fa-search"></i> Detail</a>
                        <?php if(@$this->permission_cookie[136] == 1): ?>
                          <a href="<?php echo base_url() ?>engineering/revise_history_approve_process/<?php echo strtr($this->encryption->encrypt($value['id']), '+=/', '.-~') ?>/<?php echo strtr($this->encryption->encrypt(2), '+=/', '.-~') ?>" onclick="sweetalert('confirm', 'Are you sure to Reject this?', this, event)" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Reject</a>
                          <a href="<?php echo base_url() ?>engineering/joint_void_process/<?php echo strtr($this->encryption->encrypt($value['id']), '+=/', '.-~') ?>" onclick="sweetalert('confirm', 'Are you sure to Approve this?', this, event)" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Approve</a>
                        <?php endif; ?>
                      <?php endif; ?>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            <?php elseif(in_array(@$get['fabrication_type'], [14, 11])): ?>
              <table id="table_piecemark_list" class="table table-hover text-center dataTable">
                <thead class="bg-green-smoe text-white">
                  <tr>
                    <th>Drawing No</th>
                    <th>Request Date</th>
                    <th>Request Reason</th>
                    <th>Request By</th>
                    <th>Status</th>
                    <?php if(@$get['status_revise'] == 4): ?>
                    <th>Updated By</th>
                    <th>Updated Date</th>
                    <?php endif; ?>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($request_list as $key => $value): ?>
                  <tr>
                    <td><?php echo $value['submission_id'] ?></td>
                    <td><?php echo $value['request_date'] ?></td>
                    <td><?php echo $value['request_reason'] ?></td>
                    <td><?php echo @$user_list[$value['request_by']] ?></td>
                    <td>
                    <?php 
                      if($value['status_revise'] == 1){
                        echo "<span class='badge badge-info'>Submitted</span>";
                      }
                      elseif($value['status_revise'] == 2){
                        echo "<span class='badge badge-danger'>Rejected</span>";
                      }
                      elseif($value['status_revise'] == 3){
                        echo "<span class='badge badge-success'>Approved</span>";
                      }
                      elseif($value['status_revise'] == 4){
                        echo "<span class='badge badge-info'>Completed</span>";
                      }
                    ?>
                    </td>
                    <?php if(@$get['status_revise'] == 4): ?>
                    <td><?php echo @$user_list[$value['update_by']] ?></td>
                    <td><?php echo $value['update_date'] ?></td>
                    <?php endif; ?>
                    <td>
                      <?php if($value['status_revise'] == 1 && @$this->permission_cookie[134] == 1): ?>
                        <a href="<?php echo base_url() ?>engineering/revise_history_approve_process/<?php echo strtr($this->encryption->encrypt($value['id']), '+=/', '.-~') ?>/<?php echo strtr($this->encryption->encrypt(2), '+=/', '.-~') ?>" onclick="sweetalert('confirm', 'Are you sure to Reject this?', this, event)" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Reject</a>
                        <a href="<?php echo base_url() ?>engineering/revise_history_approve_process/<?php echo strtr($this->encryption->encrypt($value['id']), '+=/', '.-~') ?>/<?php echo strtr($this->encryption->encrypt(3), '+=/', '.-~') ?>" onclick="sweetalert('confirm', 'Are you sure to Approve this?', this, event)" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Approve</a>
                      <?php elseif($value['status_revise'] == 3): ?>
                        <button class="btn btn-warning btn-sm" onclick="update_data(<?php echo $value['id'] ?>, <?php echo $value['fabrication_type'] ?>)"><i class="fa fa-edit"></i> Update</button>
                      <?php endif; ?>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>
  <form id="form_piecemark_edit" method="POST" action="<?php echo base_url() ?>engineering/piecemark_update/revise">
    <input type="hidden" name="id">
    <input type="hidden" name="revise_id">
  </form>
  <form id="form_joint_edit" method="POST" action="<?php echo base_url() ?>engineering/joint_update/revise">
    <input type="hidden" name="id">
    <input type="hidden" name="revise_id">
  </form>

</div>
</div><!-- ini div dari sidebar yang class wrapper -->
<script>
  $("select[name=module]").chained("select[name=project]");

  $('.dataTable').DataTable({
    order: [],
    // columnDefs: [{
    //   "targets": 0,
    //   "orderable": false,
    // }]
  })
  
  function update_data(id, category) {
    sweetalert('loading', 'Please Wait...!');
    $.ajax({
      url: "<?php echo base_url();?>engineering/revise_history_get_data_process/",
      type: "post",
      data: {
        'id': id,
        'category': category,
      },
      success: function(data) {
        if(data.includes('Error') == true){
          sweetalert("error", data);
        }
        else{
          if(category == 4 || category == 14){
            $("#form_piecemark_edit input[name=id]").val(data);
            $("#form_piecemark_edit input[name=revise_id]").val(id);
            $("#form_piecemark_edit")[0].submit();
          }
          else if(category == 5 || category == 11){
            $("#form_joint_edit input[name=id]").val(data);
            $("#form_joint_edit input[name=revise_id]").val(id);
            $("#form_joint_edit")[0].submit();
          }
        }
      }
    });
  }
</script>