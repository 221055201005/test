<div id="content" class="container-fluid">
  <div class="row">
    <?php error_reporting(0) ?>
    <div class="col-md-12">
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0">Filter Drawing</h6>
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
          <div class="container-fluid">
            <form id="form_filter" method="POST">

              <div class="row">
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label">Project :</label>
                    <div class="col-xl">
                      <select class="form-control" name="project" id="projectx">
                        <option value="">---</option>
                         <?php if($this->permission_cookie[0] == 1){ ?>                          
                            <?php foreach ($project_list as $key => $value) : ?>
                            <option onclick="save_project()" value="<?php echo $value['id'] ?>" <?php echo (@$user_cookie[10] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                            <?php endforeach; ?>
                          <?php } else { ?>
                            <?php foreach ($project_list as $key => $value) : ?>
                              <?php if($this->user_cookie[10] == $value['id']){ ?>
                                <option onclick="save_project()" value="<?php echo $value['id'] ?>" <?php echo (@$user_cookie[10] == $value['id'] ? 'selected' : '') ?>><?php echo $value['project_name'] ?></option>
                              <?php } ?>
                            <?php endforeach; ?>
                          <?php } ?>
                          <!-- <?php foreach($projects as $project){ ?>
                            <option onclick="save_project()" value="<?php echo $project['id'] ?>" <?php echo (@$get['project'] == $project['id'] ? 'selected' : '') ?>><?php echo $project['project_name'] ?></option>
                          <?php } ?> -->
                      </select>  
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group row">
                    <label class="col-xl-2 col-form-label">Module :</label>
                    <div class="col-xl">
                      <select class="form-control" name="module" id="modulex">
                        <option value="">---</option>
                        <?php foreach($modules as $module){ ?>
                          <option onclick="save_module()" value="<?php echo $module['mod_id'] ?>" data-chained="<?php echo $module['project_id'] ?>" <?php echo (@$get['module'] == $module['mod_id'] ? 'selected' : '') ?>><?php echo $module['mod_desc'] ?></option>
                        <?php } ?>
                      </select> 
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group row">
                    <div class="col-xl">
                    </div>
                  </div>
                </div> 
                <div class="col-md">
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group row m-0">
                    <div class="col-xl text-right">
                      <button type="submit" name='submit' value='filter' class="btn btn-primary" title="Update"><i class="fa fa-search"></i> Filter</button>
                    </div>
                  </div>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-12">
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0"><?php echo $meta_title ?></h6>
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
          <div class="container-fluid">
            <?php  echo $this->session->flashdata('message');?>
            <table class="table table-hover text-center" id='drawing_list_dt'>
              <thead class="bg-green-smoe text-white">
                <tr>
                  <th>Drawing No</th>
                  <th>Project</th>
                  <th>Module</th>
                  <th>Discipline</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($list as $key => $value) {?>
                <tr>
                  <td><?= $value['drawing_no'] ?></td>
                  <td><?= $project_list[$value['project']]['project_name'] ?></td>
                  <td><?= $module_list[$value['module']]['mod_desc'] ?></td>
                  <td><?= $discipline_list[$value['discipline']]['discipline_name'] ?></td>

                  <td>
                    <a class="btn btn-primary" href="<?= base_url('wtr/wtr_piping_list_detail/').$value['drawing_no'].'/'.$value['module'].'/'.$value['discipline'] ?>">
                      <i class="fas fa-list"></i>
                      Detail
                    </a>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div><!-- ini div dari sidebar yang class wrapper -->
<script type="text/javascript">
     
          $('#drawing_list_dt').DataTable({

          });

</script>
<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.chained.min.js"></script>
<script>
    $("select[name=module]").chained("select[name=project]");
</script>