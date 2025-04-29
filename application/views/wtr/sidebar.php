<!-- <div class="row">
  <?php if ($this->permission_cookie[64] == 1) : ?>
    <div class="col-md-2">
      <ul class="list-group sidebar-group">
      	<li class="list-group-item" style="background-color: #e3e3e3;"><b>MWTR - List</b> <i class="fas fa-caret-down"></i></li>
        <li class="list-group-item"><i class="d-none fas fa-caret-right"></i>
          <a style="color: black" href="<?php echo base_url(); ?>Wtr/wtr_list/<?php echo strtr($this->encryption->encrypt(2), '+=/', '.-~'); ?>">
            <i class="fas fa-caret-right"></i> &nbsp; MWTR List
          </a>
        </li>

      </ul>
    </div>
  <?php endif; ?>
  <div class="col-md-2">
    <ul class="list-group sidebar-group">
      <li class="list-group-item" style="background-color: #e3e3e3;"><b>MWTR - Approval</b> <i class="fas fa-caret-down"></i></li>

      <?php if ($this->permission_cookie[62] && $this->user_cookie[7] != 8) : ?>
        <li class="list-group-item">
          <a style="color: black" href="<?php echo base_url(); ?>wtr/import_joint">
            <i class="fas fa-caret-right"></i> &nbsp; MWTR - Import Joint
          </a>
        </li>

        <li class="list-group-item">
          <a style="color: black" href="<?php echo base_url();?>Wtr/mwtr_approval/<?= strtr($this->encryption->encrypt(0), '+=/', '.-~') ?>">
            <i class="fas fa-caret-right"></i> &nbsp; MWTR - Draft
          </a>
        </li>

      <?php endif; ?>
      <?php if ($this->permission_cookie[63] && $this->user_cookie[7] != 8) : ?>
        <li class="list-group-item">
          <a style="color: black" href="<?php echo base_url(); ?>Wtr/mwtr_approval/<?= strtr($this->encryption->encrypt(1), '+=/', '.-~') ?>">
            <i class="fas fa-caret-right"></i> &nbsp; MWTR - QC Inspection List
          </a>
        </li>
      <?php endif; ?>

      <?php if ($this->permission_cookie[62] && $this->user_cookie[7] != 8) : ?>
        <li class="list-group-item">
          <a style="color: black" href="<?php echo base_url(); ?>Wtr/mwtr_approval/<?= strtr($this->encryption->encrypt(3), '+=/', '.-~') ?>">
            <i class="fas fa-caret-right"></i> &nbsp; MWTR - Ready To Transmittal
          </a>
        </li>
      <?php endif; ?>

      <?php if ($this->permission_cookie[63] && $this->user_cookie[7] != 8) : ?>
        <li class="list-group-item">
          <a style="color: black" href="<?php echo base_url(); ?>Wtr/mwtr_approval/<?= strtr($this->encryption->encrypt(5), '+=/', '.-~') ?>">
            <i class="fas fa-caret-right"></i> &nbsp; MWTR - Client RFI List
          </a>
        </li>
      <?php endif; ?>

      <li class="list-group-item">
        <a style="color: black" href="<?php echo base_url(); ?>Wtr/mwtr_approval/<?= strtr($this->encryption->encrypt("summary_rfi"), '+=/', '.-~') ?>">
          <i class="fas fa-caret-right"></i> &nbsp; MWTR - Summary RFI
        </a>
      </li>

    </ul>
  </div>
  <div class="col-md-2">
  	<li class="list-group-item" style="background-color: #e3e3e3;"><b>MWTR - Others</b> <i class="fas fa-caret-down"></i></li>
    <ul class="list-group sidebar-group">

      <li class="list-group-item">
        <a style="color: black" href="<?php echo base_url(); ?>wtr/wtr_overall_export">
          <i class="fas fa-caret-right"></i> &nbsp; MWTR All - Export
        </a>
      </li>
      <?php if ($this->permission_cookie[0] == 1) : ?>
        <li class="list-group-item">
          <a style="color: black" href="<?php echo base_url(); ?>wtr/update_ecodoc">
            <i class="fas fa-caret-right"></i> &nbsp; Update Ecodoc No
          </a>
        </li>
      <?php endif; ?>
    </ul>
  </div>
  
</div> -->


<div class="wrapper" style="min-height: 79vh">
<nav id="sidebar" class="<?php echo (($this->input->cookie('sidebarCollapse') !== NULL && $this->input->cookie('sidebarCollapse') == 1) ? 'active' : '') ?>">
  <ul class="list-unstyled components"> 
    <?php if ($this->permission_cookie[64] == 1) { ?>
    <li>
      <a href="<?php echo base_url(); ?>Wtr/wtr_list/<?php echo strtr($this->encryption->encrypt(2), '+=/', '.-~'); ?>">
        <i class="fas fa-file-export"></i>  &nbsp; MWTR List
      </a>
    </li> 

    <li>
        <a href="#mis_ssx" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
          <i class="fas fa-list"></i> &nbsp; <b>MWTR Approval</b>
        </a>
        <ul class="list-unstyled" id="mis_ssx">
          <?php if ($this->permission_cookie[62] && $this->user_cookie[7] != 8) { ?> 
            <li>
              <a href="<?php echo base_url(); ?>Wtr/import_joint"><i
                  class="fas fa-caret-right"></i> &nbsp; MWTR - Import Joint</a> 
            </li>
            <li>
              <a href="<?php echo base_url(); ?>Wtr/mwtr_approval/<?= strtr($this->encryption->encrypt(0), '+=/', '.-~') ?>"><i
                  class="fas fa-caret-right"></i> &nbsp; MWTR - Draft</a> 
            </li>
          <?php } ?>
          <?php if ($this->permission_cookie[63] && $this->user_cookie[7] != 8) { ?> 
          <li>
          <a href="<?php echo base_url(); ?>Wtr/mwtr_approval/<?= strtr($this->encryption->encrypt(1), '+=/', '.-~') ?>"><i
                class="fas fa-caret-right"></i> &nbsp; MWTR - QC Inspection List</a> 
          </li>
          <?php } ?>
          <?php if ($this->permission_cookie[62] && $this->user_cookie[7] != 8) { ?> 
          <li>
          <a href="<?php echo base_url(); ?>Wtr/mwtr_approval/<?= strtr($this->encryption->encrypt(3), '+=/', '.-~') ?>"><i
                class="fas fa-caret-right"></i> &nbsp; MWTR - Ready To Transmittal</a> 
          </li>
          <?php } ?>
          <?php if ($this->permission_cookie[63] && $this->user_cookie[7] == 8) { ?> 
          <li>
          <a href="<?php echo base_url(); ?>Wtr/mwtr_approval/<?= strtr($this->encryption->encrypt(5), '+=/', '.-~') ?>"><i
                class="fas fa-caret-right"></i> &nbsp; MWTR - Client RFI List</a> 
          </li> 
          <?php } ?>
          <li>
          <a href="<?php echo base_url(); ?>Wtr/mwtr_approval/<?= strtr($this->encryption->encrypt("summary_rfi"), '+=/', '.-~') ?>"><i
                class="fas fa-caret-right"></i> &nbsp; MWTR - Summary RFI</a> 
          </li>       
        </ul>
      </li>
      
    <li>
      <a href="<?php echo base_url(); ?>wtr/wtr_overall_export">
        <i class="fas fa-file-export"></i>  &nbsp; MWTR All - Export
      </a>
    </li>
    
    <?php } ?>

    <?php if ($this->permission_cookie[0] == 1) { ?>
      <li>
        <a href="<?= site_url('wtr/update_ecodoc') ?>">
          <i class="far fa-edit"></i> &nbsp;&nbsp; Update Ecodoc No
        </a>
      </li>
      <?php } ?>

   
  </ul>
</nav>