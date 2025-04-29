<!-- <div class="row">
  <div class="col-md-2">
    <ul class="list-group sidebar-group">

      <li class="list-group-item"><i class="d-none fas fa-caret-right"></i> 
        <a style="color: black" href="<?php echo base_url();?>welder_activity/dashboard">
          <i class="fas fa-caret-right"></i>  &nbsp; Dashboard
        </a>
      </li>
     
    </ul>
  </div>
  <div class="col-md-2">
    <ul class="list-group sidebar-group">
      <li class="list-group-item" style="background-color: #e3e3e3;"><b>Foreman Fighter</b> <i class="fas fa-caret-down"></i></li>

      <li class="list-group-item">
        <a style="color: black" href="<?= site_url('welder_activity/activity_list/') ?>">
          <i class="fas fa-caret-right"></i>  &nbsp; Activity List
        </a>
      </li>
      <li class="list-group-item">
        <a style="color: black" href="<?= site_url('welder_activity/transfer_welder_list/') ?>">
          <i class="fas fa-caret-right"></i>  &nbsp; ransfer Welder 
        </a>
      </li>
      

    </ul>
  </div>
  
</div> -->

<div class="wrapper" style="min-height: 79vh">
  <nav id="sidebar" class="<?php echo (($this->input->cookie('sidebarCollapse') !== NULL && $this->input->cookie('sidebarCollapse') == 1) ? 'active' : '') ?>">
    <ul class="list-unstyled components">

      <li>
        <a href="<?php echo base_url(); ?>welder_activity/dashboard">
          <i class="fas fa-home"></i> &nbsp; Dashboard</a>
      </li>

      <li>
        <a href="#attachment" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
          <i class="fas fa-list"></i> <b>&nbsp; Foreman Fighter</b>
        </a>
        <ul class="list-unstyled" id="attachment">
          <li>
            <a href="<?= site_url('welder_activity/activity_list/') ?>"><i class="fas fa-caret-right"></i> &nbsp; Activity List</a>
          </li>

          <li>
            <a href="<?= site_url('welder_activity/transfer_welder_list/') ?>"><i class="fas fa-caret-right"></i> &nbsp; Transfer Welder List</a>
          </li>

        </ul>
      </li>




      <?php if ($this->permission_cookie[145] == 1) : ?>

      <?php endif; ?>

    </ul>
  </nav>