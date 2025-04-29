<!-- <div class="row">
  <div class="col-md-2">
    <ul class="list-group sidebar-group">
      <li class="list-group-item" style="background-color: #e3e3e3;"><b>Welder Register</b> <i class="fas fa-caret-down"></i></li>

      <li class="list-group-item"><i class="d-none fas fa-caret-right"></i>
        <a style="color: black" href="<?php echo base_url(); ?>master/welder/welder_list">
          <i class="fas fa-caret-right"></i> &nbsp; Welder List
        </a>
      </li>
      <li class="list-group-item"><i class="d-none fas fa-caret-right"></i>
        <a style="color: black" href="<?php echo base_url(); ?>master/welder/welder_new">
          <i class="fas fa-caret-right"></i> &nbsp; Create New
        </a>
      </li>
      <li class="list-group-item"><i class="d-none fas fa-caret-right"></i>
        <a style="color: black" href="<?php echo base_url(); ?>master/welder/welder_performance">
          <i class="fas fa-caret-right"></i> &nbsp; Welder Performance
        </a>
      </li>
    </ul>
  </div>
  <div class="col-md-2">
    <ul class="list-group sidebar-group">
      <li class="list-group-item" style="background-color: #e3e3e3;"><b>Master Data</b> <i class="fas fa-caret-down"></i></li>

      <?php foreach ($this->master_data_cat as $key => $value) : ?>
        <li class="list-group-item">
          <a style="color: black" href="<?= site_url('master/welder/master_data_list/' . encrypt($value['id'])) ?>">
            <i class="fas fa-caret-right"></i> &nbsp; <?= $value['name'] ?>
          </a>
        </li>
      <?php endforeach; ?>

    </ul>
  </div>
  
</div> -->

<div class="wrapper" style="min-height: 79vh">
  <nav id="sidebar" class="<?php echo (($this->input->cookie('sidebarCollapse') !== NULL && $this->input->cookie('sidebarCollapse') == 1) ? 'active' : '') ?>">
    <ul class="list-unstyled components">


      <li>
        <a href="#attachment" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
          <i class="fas fa-list"></i> <b>&nbsp; Welder Register</b>
        </a>
        <ul class="list-unstyled" id="attachment">
          <li>
            <a href="<?= site_url('master/welder/welder_list') ?>"><i class="fas fa-caret-right"></i> &nbsp; Welder List</a>
          </li>

					<?php if($this->permission_cookie[108] == 1): ?>
          <li>
            <a href="<?= site_url('master/welder/welder_new') ?>"><i class="fas fa-caret-right"></i> &nbsp; Create New</a>
          </li>
					<?php endif; ?>

					<?php if($this->permission_cookie[108] == 1): ?>
          <li>
            <a href="<?= site_url('master/welder/welder_import') ?>"><i class="fas fa-caret-right"></i> &nbsp; Import Welder</a>
          </li>
					<?php endif; ?>

          <li>
            <a href="<?= site_url('master/welder/welder_performance') ?>"><i class="fas fa-caret-right"></i> &nbsp; Welder Performance</a>
          </li>

        </ul>
      </li>

			<?php if($this->permission_cookie[0] == 1): ?>
      <li>
        <a href="#master_data" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
          <i class="fas fa-database"></i> <b>&nbsp; Master Data</b>
        </a>
        <ul class="list-unstyled" id="master_data">
          <?php foreach ($this->master_data_cat as $key => $value) : ?>
            <li>
              <a href="<?= site_url('master/welder/master_data_list/' . encrypt($value['id'])) ?>"><i class="fas fa-caret-right"></i> &nbsp; <?= $value['name'] ?></a>
            </li>
          <?php endforeach; ?>

        </ul>
      </li>
			<?php endif; ?>

    </ul>
  </nav>