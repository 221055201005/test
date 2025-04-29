<div class="wrapper" style="min-height: 79vh">
  <nav id="sidebar" class="<?php echo (($this->input->cookie('sidebarCollapse') !== NULL && $this->input->cookie('sidebarCollapse') == 1) ? 'active' : '') ?>">
    <ul class="list-unstyled components">
      <?php if($this->permission_cookie[58] == 1){ ?>
      <li>
        <a href="<?php echo base_url('Ndt/ndt/').$initial;?>">
          <i class="fas fa-list"></i>  &nbsp; NDT <?= $initial ?> Joint
        </a>
      </li>
      <?php } ?>
      <?php if($this->permission_cookie[60] == 1 OR $this->permission_cookie[59] == 1){ ?>
      <li>
        <a href="<?php echo base_url('Ndt/ndt_submit/').$initial;?>">
          <i class="fas fa-list"></i>  &nbsp; NDT <?= $initial ?> Submitted
        </a>
      </li>
      <li>
        <a href="<?php echo base_url('Ndt/ndt_export/').$initial;?>">
          <i class="fas fa-file-excel"></i>  &nbsp; Export NDT <?= $initial ?>
        </a>
      </li>
      <?php } ?>
    </ul>
  </nav>