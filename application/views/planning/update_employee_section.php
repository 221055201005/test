<div id="content" class="container-fluid">

  <div class="row">
    <div class="col-6">
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <form action="" method="GET">
            <div class="row">
              <div class="col">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Badge</label>
                  <div class="col-md">
                    <input class="form-control" name="badge" value="<?= @$this->input->get('badge') ?>" required>
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
    <div class="col-6">
      <?php if(@$this->input->get('badge') != '' && @$this->permission_cookie[133] == 1): ?>
      <div class="card shadow my-3 rounded-0">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <?php if(count($employee) > 0): ?>
          <form action="<?= base_url() ?>planning/update_employee_section_process" method="POST">
            <input type="hidden" name="badge" value="<?= $employee['badge'] ?>">
            <div class="row">
              <div class="col">
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Badge</label>
                  <div class="col-md">
                    <input class="form-control" value="<?= $employee['badge'] ?>" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Name</label>
                  <div class="col-md">
                    <input class="form-control" value="<?= $employee['name'] ?>" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-4 col-lg-3 col-form-label font-weight-bold">Section</label>
                  <div class="col-md">
                    <select class='form-control' name='section_workpack' required>
                      <option value=''>---</option>
                      <?php foreach ($workpack_section_list as $section): ?>
                      <option value='<?php echo $section['id'] ?>' <?php echo ($section['id'] == $employee['section_workpack'] ? "selected" : "") ?>><?php echo $section['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 text-right">
                <button class="mt-2 btn btn-sm btn-flat btn-warning" name="submit" value="search"><i class="fas fa-edit"></i> Update</button>
              </div>
            </div>
          </form>
          <?php else: ?>
            <p>Employee Not Found</p>
          <?php endif; ?>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </div>

</div>
</div>
<script>
  
</script>