<div class="wrapper" style="min-height: 79vh">
<nav id="sidebar" class="<?php echo (($this->input->cookie('sidebarCollapse') !== NULL && $this->input->cookie('sidebarCollapse') == 1) ? 'active' : '') ?>">
  <ul class="list-unstyled components">
    <li>

    <a href="<?= base_url() ?>irn/home_dashboard" data-parent="#sidebar">
        <i class="fas fa-home"></i> &nbsp; Home
    </a>

    <a href="#material" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <i class="fas fa-fill-drip"></i> &nbsp;&nbsp; IRN - Material
        </a>

        <ul class="list-unstyled" id="material">

          <?php if($this->permission_cookie[129] == 1 && $this->user_cookie[7] != 8){ ?>
          <li>
            <a href="<?php echo base_url();?>irn/create_new_irn_material">
                <i class="fas fa-plus-circle"></i>  &nbsp; Create IRN
            </a>
          </li> 
          <li>
            <a href="<?php echo base_url();?>irn/create_new_irn_material_itr">
                <i class="fas fa-plus-circle"></i>  &nbsp; Create IRN - ITR
            </a>
          </li> 
          <li>
            <a href="<?php echo base_url();?>irn/irn_list/<?= strtr($this->encryption->encrypt('draft'), '+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt('1'), '+=/', '.-~') ?>">
                <i class="fas fa-spray-can"></i>  &nbsp; IRN - Draft
            </a>
          </li> 
          <?php } ?>  
          <?php if(($this->permission_cookie[70] == 1 || $this->permission_cookie[69] == 1) && $this->user_cookie[7] != 8){ ?>
          <li>
            <a href="<?php echo base_url();?>irn/irn_list/<?= strtr($this->encryption->encrypt('qc_inspection'), '+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt('1'), '+=/', '.-~') ?>">
                <i class="fas fa-spray-can"></i> &nbsp; IRN - Inspection List
            </a>
          </li> 
          <li>
            <a href="<?php echo base_url();?>irn/irn_list/<?= strtr($this->encryption->encrypt('ready_to_transmit'), '+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt('1'), '+=/', '.-~') ?>">
                <i class="fas fa-spray-can"></i> &nbsp; IRN - Ready to Transmittal
            </a>
          </li>
          <?php } ?>

          <li>
            <a href="<?php echo base_url();?>irn/irn_list/<?= strtr($this->encryption->encrypt('rfi_list'), '+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt('1'), '+=/', '.-~') ?>">
                <i class="fas fa-spray-can"></i> &nbsp; IRN - RFI List
            </a>
          </li>

        </ul>

        <a href="#fab" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <i class="fas fa-fill-drip"></i> &nbsp;&nbsp; IRN - Fabrication
        </a>

        <ul class="list-unstyled" id="fab">

          <?php if($this->permission_cookie[129] == 1 && $this->user_cookie[7] != 8){ ?>
          <li>
            <a href="<?php echo base_url();?>irn/create_new_irn">
                <i class="fas fa-plus-circle"></i>  &nbsp; Create IRN
            </a>
          </li>
          <li>
            <a href="<?php echo base_url();?>irn/create_new_irn/bondstrand">
                <i class="fas fa-plus-circle"></i>  &nbsp; Create IRN - Bondstrand
            </a>
          </li> 
          <li>
            <a href="<?php echo base_url();?>irn/irn_list/<?= strtr($this->encryption->encrypt('draft'), '+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt('0'), '+=/', '.-~') ?>">
                <i class="fas fa-spray-can"></i>  &nbsp; IRN - Draft
            </a>
          </li> 
          <?php } ?>  
          <?php if(($this->permission_cookie[70] == 1 || $this->permission_cookie[69] == 1) && $this->user_cookie[7] != 8){ ?>
          <li>
            <a href="<?php echo base_url();?>irn/irn_list/<?= strtr($this->encryption->encrypt('qc_inspection'), '+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt('0'), '+=/', '.-~') ?>">
                <i class="fas fa-spray-can"></i> &nbsp; IRN - Inspection List
            </a>
          </li> 
          <li>
            <a href="<?php echo base_url();?>irn/irn_list/<?= strtr($this->encryption->encrypt('ready_to_transmit'), '+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt('0'), '+=/', '.-~') ?>">
                <i class="fas fa-spray-can"></i> &nbsp; IRN - Ready to Transmittal
            </a>
          </li>
          <li>
            <a href="<?php echo base_url();?>irn/irn_list/<?= strtr($this->encryption->encrypt('retransmit_data'), '+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt('0'), '+=/', '.-~') ?>">
                <i class="fas fa-spray-can"></i> &nbsp; IRN - Re-Transmit List
            </a>
          </li>
          <?php } ?>

          <li>
            <a href="<?php echo base_url();?>irn/irn_list/<?= strtr($this->encryption->encrypt('rfi_list'), '+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt('0'), '+=/', '.-~') ?>">
                <i class="fas fa-spray-can"></i> &nbsp; IRN - RFI List
            </a>
          </li>

        </ul>

        <a href="<?= base_url() ?>irn/form_export_excel" data-parent="#sidebar">
          <i class="fas fa-file-excel"></i> &nbsp; Export Excel
        </a>
        <li>
          <a href="<?php echo base_url();?>irn/update_ecodoc/">
            <i class="far fa-file-excel"></i>  &nbsp;&nbsp; Import Ecodoc No.
          </a>
        </li>

    </li>

    <?php if($this->permission_cookie[0] == 1){ ?>
      <li>
        <a href="#irn_mv" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-fill-drip"></i> &nbsp;&nbsp; IRN - Material Approval</a>
        <ul class="list-unstyled" id="irn_mv">
          <li>
            <a href="<?php echo base_url();?>irn_approval_mv/irn_list/<?= strtr($this->encryption->encrypt('1'), '+=/', '.-~') ?>">
              <i class="fas fa-edit"></i>  &nbsp; IRN - Material (QC) 
            </a>
          </li>
          <li>
            <a href="<?php echo base_url();?>irn_approval_mv/irn_list/<?= strtr($this->encryption->encrypt('5'), '+=/', '.-~') ?>">
              <i class="fas fa-edit"></i>  &nbsp; IRN - Material (Client)
            </a>
          </li>
        </ul>
      </li>

      <li>
        <a href="#irn_fabrication" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-fill-drip"></i> &nbsp;&nbsp; IRN Fabrication Approval</a>
        <ul class="list-unstyled" id="irn_fabrication">
          <li>
            <a href="<?php echo base_url();?>irn/fitup_qc_approval_list">
              <i class="fas fa-edit"></i>  &nbsp; QC Fitup Approval 
            </a>
          </li>
          <li>
            <a href="<?php echo base_url();?>irn/fitup_client_approval_list">
              <i class="fas fa-edit"></i>  &nbsp; Client Fitup Approval 
            </a>
          </li>
        </ul>
      </li>

      <li>
        <a href="#approval_revison" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-fill-drip"></i> &nbsp;&nbsp; IRN - Visual Approval</a>
        <ul class="list-unstyled" id="approval_revison">
          <li>
            <a href="<?php echo base_url();?>irn/draft_approval_list/qc">
              <i class="fas fa-edit"></i>  &nbsp; QC Approval
            </a>
          </li>
          <li>
            <a href="<?php echo base_url();?>irn/draft_approval_list/cl">
              <i class="fas fa-edit"></i>  &nbsp; Client Approval
            </a>
          </li>
        </ul>
      </li>
    <?php } ?>

    <?php if($this->permission_cookie[0] == 1 || $this->user_cookie[7] == 8): ?>
    <li>
      <a href="#approval_revison" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-fill-drip"></i> &nbsp;&nbsp; Request Revision List</a>
      <ul class="list-unstyled" id="approval_revison">
        <li>
          <a href="<?php echo base_url();?>irn/revision_irn_list/14">
            <i class="fas fa-edit"></i>  &nbsp; Revision Piecemark List
          </a>
        </li>
        <li>
          <a href="<?php echo base_url();?>irn/revision_irn_list/11">
            <i class="fas fa-edit"></i>  &nbsp; Revision Joint List
          </a>
        </li>
      </ul>
    </li>
    <?php endif; ?>

  </ul>

</nav>