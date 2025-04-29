<div id="content" class="container-fluid">

  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <form action="<?php echo base_url() ?>planning/return_request_list" method="GET">
            <div class="row">
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Data</label>
                  <div class="col-md">
                    <select class="form-control" name="fabrication_type" required>
                      <option value="7" selected>Workpack</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Status</label>
                  <div class="col-md">
                    <select class="form-control" name="status_revise" required>
                      <option value="1" <?php echo @$get['status_revise'] == "1" ? "selected" : "" ?>>Pending Planning</option>
                      <!-- <option value="2" <?php echo @$get['status_revise'] == "2" ? "selected" : "" ?>>Rejected</option> -->
                      <option value="3" <?php echo @$get['status_revise'] == "3" ? "selected" : "" ?>>Pending QC</option>
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
  
  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white">

          <div class="overflow-auto">
            <table id="table_piecemark_list" class="table table-hover text-center dataTable">
              <thead class="bg-green-smoe text-white">
                <tr>
                  <th>Piecemark</th>
                  <th>Request Date</th>
                  <th>Request Reason</th>
                  <th>Request By</th>
                  <th>Request Status</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($request_list as $key => $value): ?>
                <tr>
                  <td class="text-nowrap"><?php echo @$template_list[$workpack_detail_list[$value['id_data']]['id_template']]['part_id'] ?></td>
                  <td><?php echo date("Y-m-d H:i:s", strtotime($value['request_date'])) ?></td>
                  <td><?php echo $value['request_reason'] ?></td>
                  <td><?php echo @$user_list[$value['request_by']] ?></td>
                  <td>
                  <?php 
                    if($value['status_revise'] == 1){
                      echo "<span class='badge badge-info'>Pending Planning</span>";
                    }
                    elseif($value['status_revise'] == 2){
                      echo "<span class='badge badge-danger'>Rejected</span>";
                    }
                    elseif($value['status_revise'] == 3){
                      echo "<span class='badge badge-warning'>Pending QC</span>";
                    }
                    elseif($value['status_revise'] == 4){
                      echo "<span class='badge badge-success'>Complete</span>";
                    }
                  ?>
                  </td>
                  <td>
                    <a target="_blank" href="<?php echo base_url() ?>engineering/search_piecemark?part_id=<?= @$template_list[$workpack_detail_list[$value['id_data']]['id_template']]['part_id'] ?>" class="btn btn-secondary btn-sm"><i class="fa fa-search"></i> Search</a>
                    <?php if($value['status_revise'] == 1 && ($this->permission_cookie[188] == 1)): ?>
                      <a href="<?php echo base_url() ?>planning/return_request_approval_process/<?php echo strtr($this->encryption->encrypt($value['id']), '+=/', '.-~') ?>/<?php echo strtr($this->encryption->encrypt('3'), '+=/', '.-~') ?>" onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-success&#34;>&nbsp;Approve&nbsp;</b> this?', this, event)" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Approve</a>
                      <a href="<?php echo base_url() ?>planning/return_request_approval_process/<?php echo strtr($this->encryption->encrypt($value['id']), '+=/', '.-~') ?>/<?php echo strtr($this->encryption->encrypt('2'), '+=/', '.-~') ?>" onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-danger&#34;>&nbsp;Reject&nbsp;</b> this?', this, event)" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Reject</a>
                    <?php elseif($value['status_revise'] == 3 && ($this->permission_cookie[189] == 1)): ?>
                      <a href="<?php echo base_url() ?>planning/return_request_approval_process/<?php echo strtr($this->encryption->encrypt($value['id']), '+=/', '.-~') ?>/<?php echo strtr($this->encryption->encrypt('4'), '+=/', '.-~') ?>" onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-success&#34;>&nbsp;Approve&nbsp;</b> this?', this, event)" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Approve</a>
                      <a href="<?php echo base_url() ?>planning/return_request_approval_process/<?php echo strtr($this->encryption->encrypt($value['id']), '+=/', '.-~') ?>/<?php echo strtr($this->encryption->encrypt('2'), '+=/', '.-~') ?>" onclick="sweetalert('confirm', 'Are you sure to <b class=&#34;text-danger&#34;>&nbsp;Reject&nbsp;</b> this?', this, event)" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Reject</a>
                    <?php endif; ?>
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
  <form id="form_piecemark_edit" method="POST" action="<?php echo base_url() ?>engineering/piecemark_update/revise">
    <input type="hidden" name="id">
  </form>
  <form id="form_joint_edit" method="POST" action="<?php echo base_url() ?>engineering/joint_update/revise">
    <input type="hidden" name="id">
  </form>

</div>
</div><!-- ini div dari sidebar yang class wrapper -->
<script>
  $("select[name=module]").chained("select[name=project]");

  $('.dataTable').DataTable({
    order: [],
    columnDefs: [{
      "targets": 0,
      "orderable": false,
    }]
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
          if(category == 4){
            $("#form_piecemark_edit input[name=id]").val(data);
            $("#form_piecemark_edit")[0].submit();
          }
          else if(category == 5){
            $("#form_joint_edit input[name=id]").val(data);
            $("#form_joint_edit")[0].submit();
          }
        }
      }
    });
  }
</script>