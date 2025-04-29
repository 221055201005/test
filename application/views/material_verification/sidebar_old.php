<div class="wrapper" style="min-height: 79vh">
  <nav id="sidebar"
    class="<?php echo (($this->input->cookie('sidebarCollapse') !== NULL && $this->input->cookie('sidebarCollapse') == 1) ? 'active' : '') ?>">
    <ul class="list-unstyled components">

      <?php if($this->permission_cookie[21] == 1){ ?>

      <li>
        <a href="#production" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
          <i class="fas fa-list"></i> <b>&nbsp; Production RFI</b>
        </a>
        <ul class="list-unstyled" id="production">

        <li>
            <a
              href="<?= site_url('material_verification/production_rfi/'.strtr($this->encryption->encrypt('1'), '+=/', '.-~')) ?>"><i
                class="fas fa-caret-right"></i> &nbsp; Internal RFI</a>
          </li>

          <li>
            <a
              href="<?= site_url('material_verification/production_rfi/'.strtr($this->encryption->encrypt('0'), '+=/', '.-~')) ?>"><i
                class="fas fa-caret-right"></i> &nbsp; External RFI </a>
          </li>
          
          
        </ul>
      </li>

      <?php } ?>

      <?php if($this->permission_cookie[25] == 1){ ?>
      <li>
        <a href="#inspection" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
          <i class="fas fa-list"></i> <b>&nbsp; Inspection RFI</b>
        </a>
        <ul class="list-unstyled" id="inspection">
          <li>
            <a
              href="<?= site_url('material_verification/inspection_rfi/'.strtr($this->encryption->encrypt('0'), '+=/', '.-~')) ?>"><i
                class="fas fa-caret-right"></i> &nbsp; Inspection List</a>
          </li>

          <li>
            <a
              href="<?= site_url('material_verification/inspection_rfi/'.strtr($this->encryption->encrypt('internal'), '+=/', '.-~')) ?>"><i
                class="fas fa-caret-right"></i> &nbsp; Internal List</a>
          </li>

          <li>
            <a
              href="<?= site_url('material_verification/inspection_rfi/'.strtr($this->encryption->encrypt('1'), '+=/', '.-~')) ?>"><i
                class="fas fa-caret-right"></i> &nbsp; Revision List</a>
          </li>
          
          
        </ul>
      </li>

      <?php } ?>

      <?php if($this->permission_cookie[21] == 1  && $this->user_cookie[11] == 1){ ?>
        <li>
        <a href="#transmittal_rfi" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
          <i class="fas fa-edit"></i> <b>&nbsp; Transmittal RFI</b>
        </a>
        <ul class="list-unstyled" id="transmittal_rfi">
          <li>
            <a
              href="<?= site_url('material_verification/transmittal_rfi') ?>"><i
                class="fas fa-caret-right"></i> &nbsp; Ready to Transmittal</a>
          </li>
          <li>
            <a
              href="<?= site_url('material_verification/transmittal_rfi_pr') ?>"><i
                class="fas fa-caret-right"></i> &nbsp; Re-Transmit List</a>
          </li>
          
          
        </ul>
      </li>
      <?php } ?>

      <?php if($this->permission_cookie[26] == 1){ ?>

        <li>
        <a href="#client_rfi" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
          <i class="fas fa-list"></i> <b>&nbsp; Client RFI</b>
        </a>
        <ul class="list-unstyled" id="client_rfi">
          <li>
            <a
              href="<?= site_url('material_verification/client_rfi') ?>"><i
                class="fas fa-caret-right"></i> &nbsp; RFI List</a>
          </li>
          <li>
            <a
              href="<?= site_url('material_verification/client_rfi/summary') ?>"><i
                class="fas fa-caret-right"></i> &nbsp; Summary RFI</a>
          </li>
          
          
        </ul>
      </li>

      <!-- <li>
        <a href="<?= site_url('material_verification/client_rfi') ?>">
          <i class="fas fa-caret-right"></i> &nbsp; Client RFI
        </a>
      </li> -->
      <?php } ?>

      <li class="invisible">
        <a href="<?php echo base_url();?>visual/ndt_reject">
          <i class="fas fa-list"></i>  &nbsp; NDT - Reject
        </a>
      </li>

      <?php if($this->permission_cookie[27] == 1){ ?>
      <li>
        <a href="<?= site_url('material_verification/export_material_verification') ?>">
          <i class="far fa-file-excel"></i> &nbsp;&nbsp; Export Material Verification
        </a>
      </li>
      <?php } ?>
      <?php if($this->permission_cookie[23] == 1){ ?>
      <li>
        <a href="#mis_ss" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
          <i class="fas fa-edit"></i> <b>&nbsp; Request for Update</b>
        </a>
        <ul class="list-unstyled" id="mis_ss">
          <li>
            <a
              href="<?= site_url('material_verification/request_for_update_list/'.strtr($this->encryption->encrypt('waiting_approval'), '+=/', '.-~'));?>"><i
                class="fas fa-caret-right"></i> &nbsp; Approval (Inspector)</a>
          </li>
          <li>
            <a href="<?= site_url('material_verification/request_for_update_list/'.strtr($this->encryption->encrypt('approved_for_update'), '+=/', '.-~'));?>"><i class="fas fa-caret-right"></i> &nbsp; Approved
              for Update</a>
          </li>
          <li>
            <a href="<?= site_url('material_verification/request_for_update_list/'.strtr($this->encryption->encrypt('re_approval'), '+=/', '.-~'));?>"><i class="fas fa-caret-right"></i> &nbsp;
              Re-Approval Inspector</a>
          </li>
          <li>
            <a href="<?= site_url('material_verification/request_for_update_list/'.strtr($this->encryption->encrypt('closed'), '+=/', '.-~'));?>"><i class="fas fa-caret-right"></i> &nbsp;
              Closed</a>
          </li>
        </ul>
      </li>
      <?php } ?>

      <?php if($this->permission_cookie[0] == 1 && $this->user_cookie[7] != 8){ ?>
      <li>
        <a href="#drawing_un_official" data-parent="#sidebar" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
          <i class="fas fa-info-circle"></i> &nbsp; <b>Drawing Un-Official</b>
        </a>
        <ul class=" list-unstyled" id="drawing_un_official">
          <li>
            <a href="<?= base_url();?>material_verification/drawing_status_submission/"><i class="fas fa-caret-right"></i> &nbsp; Submission ID (QC)</a>
          </li>
          <li>
            <a href="<?= base_url();?>material_verification/drawing_status_report/"><i class="fas fa-caret-right"></i> &nbsp; Report No. (Client)</a>
          </li>
        </ul>
      </li>
      <?php } ?>

      <?php if($this->permission_cookie[0] == 1){ ?>
      <li>
        <a href="<?= site_url('material_verification/update_ecodoc') ?>">
          <i class="far fa-edit"></i> &nbsp;&nbsp; Update Ecodoc No
        </a>
      </li>
      <?php } ?>

    </ul>
  </nav>