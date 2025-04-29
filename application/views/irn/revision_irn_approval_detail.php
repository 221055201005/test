<div id="content" class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <div class="row">
            <div class="col-6">
              <div class="form-group row">
                <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Project</label>
                <div class="col-xl">
                  <select class="form-control" name="project" disabled>
                    <option value="">---</option>
                    <?php foreach ($project_list as $key => $value) : ?>
                    <option value="<?php echo $value['id'] ?>" <?php echo ($get['project'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group row">
                <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Discipline</label>
                <div class="col-xl">
                  <select class="form-control" name="discipline" disabled>
                    <option value="">---</option>
                    <?php foreach ($discipline_list as $key => $value) : ?>
                    <option value="<?php echo $value['id'] ?>" <?php echo ($get['discipline'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['discipline_name'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="form-group row">
                <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Type Of Module</label>
                <div class="col-xl">
                  <select class="form-control" name="type_of_module" disabled>
                    <option value="">---</option>
                    <?php foreach ($type_of_module_list as $key => $value) : ?>
                      <option value="<?php echo $value['id'] ?>" <?php echo (@$get['type_of_module'] == $value['id'] ? 'selected' : '') ?>><?php echo $value['code']." - ".$value['name'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group row">
                <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Module</label>
                <div class="col-xl">
                  <select class="form-control" name="module" disabled>
                    <option value="">---</option>
                    <?php foreach ($module_list as $key => $value) : ?>
                    <option value="<?php echo $value['mod_id'] ?>" data-chained="<?php echo $value['project_id'] ?>" <?php echo ($get['module'] == $value['mod_id'] ? 'selected' : '') ?>><?php echo $value['mod_desc'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="form-group row">
                <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Request Date</label>
                <div class="col-xl">
                  <input type="text" class="form-control" disabled value="<?= $request['update_date'] ?>">
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group row">
                <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Reason</label>
                <div class="col-xl">
                  <input type="text" class="form-control" disabled value="<?= $request['request_reason'] ?>">
                </div>
              </div>
            </div>
          </div>
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
            <table id="table_joint_list" class="table table-hover text-center dataTable">
              <thead class="bg-green-smoe text-white">
                <tr>
                  <?php if($request['fabrication_type'] == 14): ?>
                    <th>Drawing GA</th>
                    <th>Drawing AS</th>
                    <th>Drawing SP</th>
                    <th>Part ID</th>
                  <?php elseif($request['fabrication_type'] == 11): ?>
                    <th>Drawing No</th>
                    <th>Drawing WM</th>
                    <th>Joint No</th>
                  <?php endif; ?>
                  <th>Data</th>
                  <th>Before</th>
                  <th>After</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data_request_list as $key => $value): ?>
                  <tr>
                    <?php if($request['fabrication_type'] == 14): ?>
                      <td><?= $template_list[$value['id_template']]['drawing_ga'] ?></td>
                      <td><?= $template_list[$value['id_template']]['drawing_as'] ?></td>
                      <td><?= $template_list[$value['id_template']]['drawing_sp'] ?></td>
                      <td><?= $template_list[$value['id_template']]['part_id'] ?></td>
                    <?php elseif($request['fabrication_type'] == 11): ?>
                      <td><?= $template_list[$value['id_template']]['drawing_no'] ?></td>
                      <td><?= $template_list[$value['id_template']]['drawing_wm'] ?></td>
                      <td><?= $template_list[$value['id_template']]['joint_no'] ?></td>
                    <?php endif; ?>
                    <td><?= $value['name'] ?></td>
                    <td>
                      <?php
                        if(isset(${$value['column_name'].'_list'})){
                          echo ${$value['column_name'].'_list'}[$value['data_before']];
                        }
                        else{
                          echo $value['data_before'];
                        }
                      ?>
                    </td>
                    <td>
                      <?php
                        if(isset(${$value['column_name'].'_list'})){
                          echo ${$value['column_name'].'_list'}[$value['data_after']];
                        }
                        else{
                          echo $value['data_after'];
                        }
                      ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <br>
          <div class="row">
            <div class="col-auto">
              <a href="<?php echo base_url() ?>engineering/revision_approval_client_process/<?php echo strtr($this->encryption->encrypt($request['id']), '+=/', '.-~') ?>/<?php echo strtr($this->encryption->encrypt(2), '+=/', '.-~') ?>" onclick="sweetalert('confirm', 'Are you sure to Reject this?', this, event)" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Reject</a>      
            </div>
            <div class="col-auto">
              <a href="<?php echo base_url() ?>engineering/revision_approval_client_process/<?php echo strtr($this->encryption->encrypt($request['id']), '+=/', '.-~') ?>/<?php echo strtr($this->encryption->encrypt(3), '+=/', '.-~') ?>" onclick="sweetalert('confirm', 'Are you sure to Approve this?', this, event)" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Approve</a>          
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div><!-- ini div dari sidebar yang class wrapper -->
<div class="modal fade" id="history_log" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >History Log</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
  $('.dataTable').DataTable({
    order: [],
  })
</script>