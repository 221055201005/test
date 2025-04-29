<div class="wrapper" style="min-height: 79vh">
  <nav id="sidebar" class="<?php echo (($this->input->cookie('sidebarCollapse') !== NULL && $this->input->cookie('sidebarCollapse') == 1) ? 'active' : '') ?>">
    <ul class="list-unstyled components">

      <?php if($this->permission_cookie[39] == 1 AND $this->user_cookie[7]!=8){ ?>
        <li>
          <a href="#production_rfi" data-parent="#sidebar" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
            <i class="fas fa-list"></i> &nbsp; <b>Production RFI</b>
          </a>
          <ul class=" list-unstyled" id="production_rfi">
            <li>
              <a href="<?php echo base_url();?>visual/visual_list/NULL/1">
                <i class="fas fa-caret-right"></i>  &nbsp; Internal RFI
              </a>
            </li>
            <li>
              <a href="<?php echo base_url();?>visual/index">
                <i class="fas fa-caret-right"></i>  &nbsp; External RFI
              </a>
            </li>
            <!-- <li>
              <a href="<?php echo base_url();?>visual/visual_list/remarks">
                <i class="fas fa-caret-right"></i>  &nbsp; Update Remarks
              </a>
            </li> -->
          </ul>
        </li>
      <?php } ?>

      <?php if($this->permission_cookie[43] == 1 AND $this->user_cookie[7]!=8){ ?>
        <li>
          <a href="#inspection_rfi" data-parent="#sidebar" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
            <i class="fas fa-list"></i> &nbsp; <b>Inspection RFI</b>
          </a>
          <ul class=" list-unstyled" id="inspection_rfi">
            <li>
              <a href="<?php echo base_url();?>visual/inspection_rfi_serverside/">
                <i class="fas fa-caret-right"></i>  &nbsp; Inspection List
              </a>
            </li>
            <li>
              <a href="<?php echo base_url();?>visual/inspection_rfi_serverside/0/1">
                <i class="fas fa-caret-right"></i>  &nbsp; Internal List
              </a>
            </li>
            <li>
              <a href="<?php echo base_url();?>visual/inspection_rfi_serverside/revision/">
                <i class="fas fa-caret-right"></i>  &nbsp; Revision List
              </a>
            </li>
            <!-- <li>
              <a href="<?php echo base_url();?>visual/visual_list/remarks">
                <i class="fas fa-caret-right"></i>  &nbsp; Update Remarks
              </a>
            </li> -->
          </ul>
        </li>
      <?php } ?>

      <?php if($this->permission_cookie[39] == 1 && $this->user_cookie[11] == 1 && $this->user_cookie[7]!=8){ ?>
        <li>
          <a href="#transmittal_rfi" data-parent="#sidebar" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
            <i class="fas fa-edit"></i> &nbsp; <b>Transmittal RFI</b>
          </a>
          <ul class=" list-unstyled" id="transmittal_rfi">
            <li>
              <a href="<?php echo base_url();?>visual/transmittal_list/ready_to_transmittal">
                <i class="fas fa-caret-right"></i>  &nbsp; Ready to Transmittal
              </a>
            </li>
            <li>
              <a href="<?php echo base_url();?>visual/transmittal_list/ready_to_transmittal_postponereoffer">
                <i class="fas fa-caret-right"></i>  &nbsp; Re-Transmit List
              </a>
            </li>
          </ul>
        </li>
      <?php } ?>

      <?php if($this->permission_cookie[44] == 1){ ?>
        <li>
          <a href="#client_rfi" data-parent="#sidebar" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
            <i class="fas fa-list"></i> &nbsp; <b>Client RFI</b>
          </a>
          <ul class=" list-unstyled" id="client_rfi">
            <li>
              <a href="<?php echo base_url();?>visual/client_rfi_serverside">
                <i class="fas fa-caret-right"></i>  &nbsp; RFI List
              </a>
            </li>
            <li>
              <a href="<?php echo base_url();?>visual/summary_report">
                <i class="fas fa-caret-right"></i>  &nbsp; Summary RFI
              </a>
            </li>
          </ul>
        </li>
      <?php } ?>

      <?php if($this->permission_cookie[39] == 1  && $this->user_cookie[11] == 1 && $this->user_cookie[7]!=8){ ?>
        <li>
          <a href="<?php echo base_url();?>visual/ndt_reject">
            <i class="fas fa-list"></i>  &nbsp; NDT - Reject
          </a>
        </li>
      <?php } ?>

      <?php if($this->permission_cookie[45] == 1){ ?>
        <li>
          <a href="<?php echo base_url();?>visual/export_excel/">
            <i class="far fa-file-excel"></i>  &nbsp;&nbsp; Export Visual Testing
          </a>
        </li>
        <li>
          <a href="<?php echo base_url();?>visual/update_ecodoc/">
            <i class="far fa-file-excel"></i>  &nbsp;&nbsp; Import Ecodoc No.
          </a>
        </li>
      <?php } ?>

      <?php if($this->permission_cookie[41] == 1 && $this->user_cookie[7]!=8){ ?>
        <li>
          <a href="#revise_list" data-parent="#sidebar" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
            <i class="fas fa-edit"></i> &nbsp; <b>Request for Update</b>
          </a>
          <ul class=" list-unstyled" id="revise_list">
            <li>
              <a href="<?= base_url();?>visual/revise_history_list/submited/"><i class="fas fa-caret-right"></i> &nbsp; Approval (Inspector)</a>
            </li>
            <li>
              <a href="<?= base_url();?>visual/revise_history_list/approved/"><i class="fas fa-caret-right"></i> &nbsp; Approved for Update</a>
            </li>
            <li>
              <a href="<?= base_url();?>visual/revise_history_list/reapproval/"><i class="fas fa-caret-right"></i> &nbsp; Re-Approval Inspector</a>
            </li>
            <li>
              <a href="<?= base_url();?>visual/revise_history_list/closed/"><i class="fas fa-caret-right"></i> &nbsp; Closed</a>
            </li>
          </ul>
        </li>
      <?php } ?>

      <?php if($this->permission_cookie[0] == 1 && $this->user_cookie[7]!=8){ ?>
        <li>
          <a href="#drawing_un_official" data-parent="#sidebar" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
            <i class="fas fa-warning"></i> &nbsp; <b>Drawing Un-Official</b>
          </a>
          <ul class=" list-unstyled" id="drawing_un_official">
            <li>
              <a href="<?= base_url();?>visual/cehck_drawing_unofficial/submission/"><i class="fas fa-caret-right"></i> &nbsp; Submission ID (QC)</a>
            </li>
            <li>
              <a href="<?= base_url();?>visual/cehck_drawing_unofficial/report/"><i class="fas fa-caret-right"></i> &nbsp; Report No. (Client)</a>
            </li>
          </ul>
        </li>
      <?php } ?>

    </ul>
  </nav>