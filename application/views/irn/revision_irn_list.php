<div id="content" class="container-fluid">
  
  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white">
          <div class="overflow-auto">
            <table id="table_piecemark_list" class="table table-hover text-center dataTable">
              <thead class="bg-gray-table">
                <tr>
                  <th>Drawing No</th>
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
                  <td><?php echo $value['submission_id'] ?></td>
                  <td><?php echo $value['update_date'] ?></td>
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
                  <td><?php echo @$user_list[$value['re_approval_by']] ?></td>
                  <td><?php echo $value['re_approval_date'] ?></td>
                  <?php endif; ?>
                  <td>
                    <a href="<?php echo base_url() ?>irn/revision_irn_approval_detail/<?php echo strtr($this->encryption->encrypt($value['id']), '+=/', '.-~') ?>" class="btn btn-secondary btn-sm" target="_blank"><i class="fas fa-bars"></i> Detail</a>
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
          if(category == 4){
            $("#form_piecemark_edit input[name=id]").val(data);
            $("#form_piecemark_edit input[name=revise_id]").val(id);
            $("#form_piecemark_edit")[0].submit();
          }
          else if(category == 5){
            $("#form_joint_edit input[name=id]").val(data);
            $("#form_joint_edit input[name=revise_id]").val(id);
            $("#form_joint_edit")[0].submit();
          }
        }
      }
    });
  }
</script>