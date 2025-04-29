<!-- <div class="row">
  <div class="col-md-2">
    <ul class="list-group sidebar-group">

      <?php if ($this->permission_cookie[73] == '1') : ?>
        <li class="list-group-item"><i class="d-none fas fa-caret-right"></i>
          <a style="color: black" href="<?php echo base_url(); ?>welding_rfi/rfi_new">
            <i class="fas fa-caret-right"></i> &nbsp; Create RFI
          </a>
        </li>
      <?php endif; ?>

      <?php if ($this->permission_cookie[72] == '1') : ?>
        <?php if ($this->user_cookie[7] != 8) : ?>
          <li class="list-group-item"><i class="d-none fas fa-caret-right"></i>
            <a style="color: black" href="<?php echo base_url(); ?>welding_rfi/rfi_list">
              <i class="fas fa-caret-right"></i> &nbsp; RFI List
            </a>
          </li>
        <?php endif; ?>
      <?php endif; ?>

      <?php if ($this->permission_cookie[80] == '1') : ?>
        <li class="list-group-item"><i class="d-none fas fa-caret-right"></i>
          <a style="color: black" href="<?php echo base_url(); ?>welding_rfi/pqr_tracking">
            <i class="fas fa-caret-right"></i> &nbsp;PQR WPQT Tracking
          </a>
        </li>
      <?php endif; ?>

      <li class="list-group-item"><i class="d-none fas fa-caret-right"></i>
        <a style="color: black" href="<?php echo base_url(); ?>welding_rfi/export_excel">
          <i class="fas fa-caret-right"></i> &nbsp; Export Excel
        </a>
      </li>
    </ul>
  </div>

</div> -->

<div class="wrapper" style="min-height: 79vh">
<nav id="sidebar" class="<?php echo (($this->input->cookie('sidebarCollapse') !== NULL && $this->input->cookie('sidebarCollapse') == 1) ? 'active' : '') ?>">
  <ul class="list-unstyled components">
    <?php if ($this->permission_cookie[73] == '1') { ?>
    <li>
      <a href="<?php echo base_url(); ?>welding_rfi/rfi_new">
        <i class="fas fa-plus"></i>  &nbsp; Create RFI
      </a>
    </li>
    <?php } ?>

    <?php if ($this->permission_cookie[72] == '1') { ?>
      <?php if ($this->user_cookie[7] != 8) { ?>
        <li>
          <a href="<?php echo base_url(); ?>welding_rfi/rfi_list">
            <i class="fas fa-list"></i>  &nbsp; RFI List
          </a>
        </li>
      <?php } ?>
    <?php } ?>

    <?php if ($this->permission_cookie[78] == '1') { ?>
      <?php if ($this->user_cookie[7] != 8) { ?>
      <li>
        <a href="<?php echo base_url(); ?>welding_rfi/transmittal_list">
          <i class="fas fa-list"></i>  &nbsp; Transmittal RFI
        </a>
      </li>
      <?php } ?>
    <?php } ?>
    <?php if ($this->permission_cookie[80] == '1') { ?>
    <li>
      <a href="<?php echo base_url(); ?>welding_rfi/rfi_client_list">
        <i class="fas fa-list"></i>  &nbsp; Client RFI
      </a>
    </li>
    <?php } ?>  
    <li>
      <a href="<?php echo base_url(); ?>welding_rfi/export_excel">
      <i class="fas fa-file-excel"></i>  &nbsp; Export Excel
      </a>
    </li>
  </ul>
</nav>