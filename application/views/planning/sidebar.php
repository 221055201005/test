<div class="wrapper" style="min-height: 79vh">
<nav id="sidebar" class="<?php echo (($this->input->cookie('sidebarCollapse') !== NULL && $this->input->cookie('sidebarCollapse') == 1) ? 'active' : '') ?>">
  <ul class="list-unstyled components">
    <?php if($this->permission_cookie[14] == 1){ ?>
    <li>
      <a href="#sidemenu_workpack_list" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <i class="fas fa-briefcase"></i>  &nbsp; Workpack
      </a>
      <ul class="list-unstyled collapse show" id="sidemenu_workpack_list">
        <?php if($this->permission_cookie[15] == 1){ ?>
        <li>
          <a href="<?php echo base_url();?>planning/workpack_new">
            <i class="fas fa-plus"></i>  &nbsp; Create New Workpack
          </a>
        </li>
        <?php } ?>
        <?php if($this->permission_cookie[14] == 1){ ?>
        <li>
          <a href="<?php echo base_url();?>planning/workpack_list/1">
            <i class="fas fa-list"></i>  &nbsp; Workpack List
          </a>
        </li>
        <li>
          <a href="<?php echo base_url();?>planning/workpack_list_foreman/1">
            <i class="fas fa-list"></i>  &nbsp; Workpack Activity
          </a>
        </li>
        <li>
          <a href="<?php echo base_url();?>planning/workpack_transmit_pe_list">
            <i class="fas fa-list"></i>  &nbsp; Update Unique Workpack
          </a>
        </li>
        <?php } ?>
        <li>
          <a href="<?php echo base_url();?>planning/return_request_list">
            <i class="fas fa-undo-alt"></i>  &nbsp; Request for return workpack
          </a>
        </li>
        <?php if(@$this->permission_cookie[133] == 1){ ?>
        <li>
          <a href="<?php echo base_url();?>planning/update_employee_section">
            <i class="fas fa-user-edit"></i>  &nbsp; Update Employee Section
          </a>
        </li>
        <?php } ?>
        <?php 
        ?>
				<?php if(in_array(21, $this->user_cookie[13])): ?>
        <li>
          <a href="<?php echo base_url();?>planning/import_workpack">
            <i class="fas fa-upload"></i>  &nbsp; Import Workpack
          </a>
        </li>
				<?php endif; ?>
        <li>
          <a href="<?php echo base_url();?>planning/production_balance">
            <i class="fas fa-warehouse"></i>  &nbsp; Production Balance
          </a>
        </li>

      </ul>
    </li>
    <?php } ?> 

    <?php if($this->permission_cookie[14] == 1){ ?>
    <li>
      <a href="#sidemenu_wo_list" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <i class="fas fa-briefcase"></i>  &nbsp; Work Order
      </a>
      <ul class="list-unstyled collapse show" id="sidemenu_wo_list">
        <?php if($this->permission_cookie[15] == 1){ ?>
        <li>
          <a href="<?php echo base_url();?>planning/workpack_new/3">
            <i class="fas fa-plus"></i>  &nbsp; Create New Work Order
          </a>
        </li>
        <?php } ?>
        <?php if($this->permission_cookie[14] == 1){ ?>
        <li>
          <a href="<?php echo base_url();?>planning/workpack_list/3">
            <i class="fas fa-list"></i>  &nbsp; Work Order List
          </a>
        </li>
        <?php } ?>
      </ul>
    </li>
    <?php } ?>

     
    <li>
      <a href="#sidemenu_workpack_bnp_list" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <i class="fas fa-briefcase"></i>  &nbsp; Blasting & Painting
      </a>
      <ul class="list-unstyled collapse show" id="sidemenu_workpack_bnp_list">
         
        <li>
          <a href="<?php echo base_url();?>planning/workpack_new_bnp/material">
            <i class="fas fa-plus"></i>  &nbsp; Create New Workpack Material
          </a>
        </li>

        <li>
          <a href="<?php echo base_url();?>planning/workpack_list_bnp/<?= strtr($this->encryption->encrypt('1'), '+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt('3'), '+=/', '.-~') ?>">
            <i class="fas fa-list"></i>  &nbsp; Workpack Draft - Material 
          </a>
        </li> 

        <li>
          <a href="<?php echo base_url();?>planning/workpack_list_bnp/<?= strtr($this->encryption->encrypt('1'), '+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt('2'), '+=/', '.-~') ?>">
            <i class="fas fa-list"></i>  &nbsp; Workpack assignment - Material 
          </a>
        </li> 

        <li>
          <a href="<?php echo base_url();?>planning/workpack_list_bnp/<?= strtr($this->encryption->encrypt('1'), '+=/', '.-~') ?>">
            <i class="fas fa-list"></i>  &nbsp; Workpack List - Material
          </a>
        </li> 

        <li>
          <a href="<?php echo base_url();?>planning/workpack_new_bnp/joint">
            <i class="fas fa-plus"></i>  &nbsp; Create New Workpack Joint
          </a>
        </li>

        <li>
          <a href="<?php echo base_url();?>planning/workpack_list_bnp/<?= strtr($this->encryption->encrypt('0'), '+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt('3'), '+=/', '.-~') ?>">
            <i class="fas fa-list"></i>  &nbsp; Workpack Draft - Joint
          </a>
        </li> 

        <li>
          <a href="<?php echo base_url();?>planning/workpack_list_bnp/<?= strtr($this->encryption->encrypt('0'), '+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt('2'), '+=/', '.-~') ?>">
            <i class="fas fa-list"></i>  &nbsp; Workpack assignment - Joint
          </a>
        </li> 

        <li>
          <a href="<?php echo base_url();?>planning/workpack_list_bnp/<?= strtr($this->encryption->encrypt('0'), '+=/', '.-~') ?>">
            <i class="fas fa-list"></i>  &nbsp; Workpack List - Material Joint
          </a>
        </li> 
         
        <li>
          <a href="<?php echo base_url();?>planning/wo_bnp_new">
            <i class="fas fa-plus"></i>  &nbsp; Create New WO
          </a>
        </li>
        <li>
          <a href="<?php echo base_url();?>planning/wo_bnp_list">
            <i class="fas fa-list"></i>  &nbsp; WO List
          </a>
        </li>
        
      </ul>
    </li>

    
    <li>
      <a href="<?php echo base_url();?>planning/revise_history_list">
        <i class="fas fa-edit"></i>  &nbsp; Request for Update
      </a>
    </li>
    <li>
      <a href="<?php echo base_url();?>planning/summary_export">
        <i class="fas fa-file-excel"></i>  &nbsp; Export Summary
      </a>
    </li>
    <?php if($this->user_cookie[11] == 1){ ?>
    <li>
      <a href="#sidemenu_plan_target" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <i class="fas fa-edit"></i> Plan Target Measurement
      </a>
      <ul class="list-unstyled collapse show" id="sidemenu_plan_target">
        <!-- <li>
          <a href="<?php echo base_url();?>planning/plan_target_new">
            <i class="fas fa-plus"></i>  &nbsp; Create New Plan Target
          </a>
        </li> -->
        <li>
          <a href="<?php echo base_url();?>planning/plan_target_import">
            <i class="fas fa-cloud-upload-alt"></i>  &nbsp; Import Plan Target
          </a>
        </li>
        <li>
          <a href="<?php echo base_url();?>planning/plan_target_list">
            <i class="fas fa-list"></i>  &nbsp; Plan Target Measurement List
          </a>
        </li>
      </ul>
    </li>
    <?php } ?>
    <?php if($this->permission_cookie[122] == 1){ ?>
    <li>
      <a href="#sidemenu_job_no" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <i class="fas fa-briefcase"></i>  &nbsp; Job Number Register
      </a>
      <ul class="list-unstyled collapse show" id="sidemenu_job_no">
        <?php if($this->permission_cookie[123] == 1){ ?>
        <li>
          <a href="<?php echo base_url();?>planning/job_no_register_new">
            <i class="fas fa-plus"></i>  &nbsp; Create New Job Number
          </a>
        </li>
        <?php } ?>
        <li>
          <a href="<?php echo base_url();?>planning/job_no_register_list">
            <i class="fas fa-list"></i>  &nbsp; Job Number List
          </a>
        </li>
      </ul>
    </li>
    <?php } ?>

    <!-- Bank Data For Sub Contractor -->
    <?php if($this->permission_cookie[123] == 1){ ?>
    <li>
      <a href="<?php echo base_url();?>planning/download_subcont_data">
      <i class="fas fa-file-download"></i>  &nbsp; Download - Sub Contractor Data
      </a>
    </li>
    <?php } ?>  
        <!-- Bank Data For Sub Contractor -->

  </ul>
</nav>