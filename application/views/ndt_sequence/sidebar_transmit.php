<div class="wrapper" style="min-height: 79vh">
  <nav id="sidebar" class="<?php echo (($this->input->cookie('sidebarCollapse') !== NULL && $this->input->cookie('sidebarCollapse') == 1) ? 'active' : '') ?>">
    <ul class="list-unstyled components">
      <?php if($this->user_cookie[11] == 1){ ?>
        <li>
          <a href="<?php echo base_url('Ndt/bucket_list');?>">
            <i class="fas fa-list"></i>  &nbsp;Joint Ready NDT
          </a>
        </li>
        <li>
          <a href="<?php echo base_url('Ndt/bucket_list/submitted');?>">
            <i class="fas fa-list"></i>  &nbsp;Joint Submitted NDT
          </a>
        </li>
      <?php } ?>
      <li>
        <a href="<?php echo base_url('Ndt/bucket_list/rfi');?>">
          <i class="fas fa-list"></i>  &nbsp;RFI NDT
        </a>
      </li>
      <?php if($this->permission_cookie[127]==1 || $this->permission_cookie[126]==1){ ?>
      <li>
        <a href="<?php echo base_url('Ndt/void_lists/');?>">
          <i class="fas fa-eye-slash"></i>  &nbsp;NDT Void 
        </a>
      </li>
      <?php } ?>
      <li>
        <a href="<?php echo base_url('Ndt/ndt_export_rfi/');?>">
          <i class="fas fa-file-excel"></i>  &nbsp; Export RFI NDT
        </a>
      </li>
    </ul>
  </nav>