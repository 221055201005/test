<div class="wrapper" style="min-height: 79vh">
<nav id="sidebar" class="<?php echo (($this->input->cookie('sidebarCollapse') !== NULL && $this->input->cookie('sidebarCollapse') == 1) ? 'active' : '') ?>">
  <ul class="list-unstyled components">
    <li>
      <a href="<?php echo base_url();?>rfi/rfi_client_pending_list">
        <i class="far fa-check-square"></i>  &nbsp; Pending Approval
      </a>
    </li>
    <li>
      <a href="<?php echo base_url();?>rfi/export_rfi">
        <i class="far fa-file-excel"></i>  &nbsp; Export RFI Excel
      </a>
    </li>
  </ul>
</nav>