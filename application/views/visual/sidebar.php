<!-- <div class="row">
  <div class="col-md-2">
    <ul class="list-group sidebar-group">
      <li class="list-group-item" style="background-color: #e3e3e3;"><b>Production RFI</b> <i class="fas fa-caret-down"></i></li>

      <li class="list-group-item"><i class="d-none fas fa-caret-right"></i> 
        <a style="color: black" href="<?php echo base_url(); ?>visual/visual_list/NULL/1">
          <i class="fas fa-caret-right"></i>  &nbsp; Internal RFI
        </a>
      </li>
      <li class="list-group-item"><i class="d-none fas fa-caret-right"></i> 
        <a style="color: black" href="<?php echo base_url(); ?>visual/visual_list/index">
          <i class="fas fa-caret-right"></i>  &nbsp; External RFI
        </a>
      </li>
    </ul>
  </div>
  <div class="col-md-2">
    <ul class="list-group sidebar-group">
      <li class="list-group-item" style="background-color: #e3e3e3;"><b>Inspection RFI</b> <i class="fas fa-caret-down"></i></li>

      <li class="list-group-item">
        <a style="color: black" href="<?php echo base_url(); ?>visual/inspection_rfi_serverside/">
          <i class="fas fa-caret-right"></i>  &nbsp; Inspection List
        </a>
      </li>
      <li class="list-group-item">
        <a style="color: black" href="<?php echo base_url(); ?>visual/inspection_rfi_serverside/0/1">
          <i class="fas fa-caret-right"></i>  &nbsp; Internal List
        </a>
      </li>
      <li class="list-group-item">
        <a style="color: black" href="<?php echo base_url(); ?>visual/inspection_rfi_serverside/revision/">
          <i class="fas fa-caret-right"></i>  &nbsp; Revision List
        </a>
      </li>

    </ul>
  </div>
  <div class="col-md-2">
    <ul class="list-group sidebar-group">
      <li class="list-group-item" style="background-color: #e3e3e3;"><b>Transmittal RFI</b> <i class="fas fa-caret-down"></i></li>

      <li class="list-group-item">
        <a style="color: black" href="<?php echo base_url(); ?>visual/transmittal_list/ready_to_transmittal">
          <i class="fas fa-caret-right"></i>  &nbsp; Ready to Transmittal
        </a>
      </li>
      <li class="list-group-item">
        <a style="color: black" href="<?php echo base_url(); ?>visual/transmittal_list/ready_to_transmittal_postponereoffer">
          <i class="fas fa-caret-right"></i>  &nbsp; Re-Transmit List
        </a>
      </li>
    </ul>
  </div>
  <div class="col-md-2">
    <ul class="list-group sidebar-group">
      <li class="list-group-item" style="background-color: #e3e3e3;"><b>Client RFI</b> <i class="fas fa-caret-down"></i></li>

      <li class="list-group-item">
        <a style="color: black" href="<?php echo base_url(); ?>visual/client_rfi_serverside">
          <i class="fas fa-caret-right"></i>  &nbsp; RFI List
        </a>
      </li>
      <li class="list-group-item">
        <a style="color: black" href="<?php echo base_url(); ?>visual/summary_report">
          <i class="fas fa-caret-right"></i>  &nbsp; Summary RFI
        </a>
      </li>
    </ul>
  </div>
  <div class="col-md-2">
    <ul class="list-group sidebar-group">
      <li class="list-group-item" style="background-color: #e3e3e3;"><b>NDT - Reject</b> <i class="fas fa-caret-down"></i></li>

      <li class="list-group-item">
        <a style="color: black" href="<?php echo base_url(); ?>visual/export_excel/">
          <i class="fas fa-caret-right"></i>  &nbsp;&nbsp; Export Visual Testing
        </a>
      </li>
      <li class="list-group-item">
        <a style="color: black" href="<?php echo base_url(); ?>visual/update_ecodoc/">
          <i class="fas fa-caret-right"></i>  &nbsp;&nbsp; Import Ecodoc No.
        </a>
      </li>
    </ul>
  </div>
  <div class="col-md-2">
    <ul class="list-group sidebar-group">
      <li class="list-group-item" style="background-color: #e3e3e3;"><b>Request for Update</b> <i class="fas fa-caret-down"></i></li>

      <li class="list-group-item">
        <a style="color: black" href="<?= base_url(); ?>visual/revise_history_list/submited/"><i class="fas fa-caret-right"></i> &nbsp; Approval (Inspector)</a>
      </li>
      <li class="list-group-item">
        <a style="color: black" href="<?= base_url(); ?>visual/revise_history_list/approved/"><i class="fas fa-caret-right"></i> &nbsp; Approved for Update</a>
      </li>
      <li class="list-group-item">
        <a style="color: black" href="<?= base_url(); ?>visual/revise_history_list/reapproval/"><i class="fas fa-caret-right"></i> &nbsp; Re-Approval Inspector</a>
      </li>
      <li class="list-group-item">
        <a style="color: black" href="<?= base_url(); ?>visual/revise_history_list/closed/"><i class="fas fa-caret-right"></i> &nbsp; Closed</a>
      </li>
    </ul>
  </div>
</div> -->

<div class="wrapper" style="min-height: 79vh">
  <nav id="sidebar" class="<?php echo (($this->input->cookie('sidebarCollapse') !== NULL && $this->input->cookie('sidebarCollapse') == 1) ? 'active' : '') ?>">
    <ul class="list-unstyled components">

      <?php if ($this->permission_cookie[39] == 1 and $this->user_cookie[7] != 8) { ?>
        <li>
          <a href="#production_rfi" data-parent="#sidebar" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
            <i class="fas fa-list"></i> &nbsp; <b>Production RFI</b>
          </a>
          <ul class=" list-unstyled" id="production_rfi">
            <!-- <li>
              <a href="<?php echo base_url(); ?>visual/visual_list/NULL/1">
                <i class="fas fa-caret-right"></i> &nbsp; Internal RFI
              </a>
            </li> -->
            <li>
              <a href="<?php echo base_url(); ?>visual/index">
                <i class="fas fa-caret-right"></i> &nbsp; External RFI
              </a>
            </li>
            <!-- <li>
              <a href="<?php echo base_url(); ?>visual/visual_list/remarks">
                <i class="fas fa-caret-right"></i> &nbsp; Update Remarks
              </a>
            </li> -->
          </ul>
        </li>
      <?php } ?>

      <?php if ($this->permission_cookie[43] == 1 and $this->user_cookie[7] != 8) { ?>
        <li>
          <a href="#inspection_rfi" data-parent="#sidebar" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
            <i class="fas fa-list"></i> &nbsp; <b>Inspection RFI</b>
          </a>
          <ul class=" list-unstyled" id="inspection_rfi">
            <li>
              <a href="<?php echo base_url(); ?>visual/inspection_rfi_serverside/">
                <i class="fas fa-caret-right"></i> &nbsp; Inspection List
              </a>
            </li>
            <!-- <li>
              <a href="<?php echo base_url(); ?>visual/inspection_rfi_serverside/0/1">
                <i class="fas fa-caret-right"></i> &nbsp; Internal List
              </a>
            </li> -->
            <li>
              <a href="<?php echo base_url(); ?>visual/inspection_rfi_serverside/revision/">
                <i class="fas fa-caret-right"></i> &nbsp; Revision List
              </a>
            </li>
            <!-- <li>
              <a href="<?php echo base_url(); ?>visual/visual_list/remarks">
                <i class="fas fa-caret-right"></i> &nbsp; Update Remarks
              </a>
            </li> -->
          </ul>
        </li>
      <?php } ?>

      <?php if ($this->permission_cookie[39] == 1 && 1 == 1 && $this->user_cookie[7] != 8 && in_array($this->user_cookie[11], [1, 2217])) { ?>
        <li>
          <a href="#transmittal_rfi" data-parent="#sidebar" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
            <i class="fas fa-edit"></i> &nbsp; <b>Transmittal RFI</b>
          </a>
          <ul class=" list-unstyled" id="transmittal_rfi">
            <li>
              <a href="<?php echo base_url(); ?>visual/transmittal_list/ready_to_transmittal">
                <i class="fas fa-caret-right"></i> &nbsp; Ready to Transmittal
              </a>
            </li>
            <li>
              <a href="<?php echo base_url(); ?>visual/transmittal_list/ready_to_transmittal_postponereoffer">
                <i class="fas fa-caret-right"></i> &nbsp; Re-Transmit List
              </a>
            </li>
          </ul>
        </li>
      <?php } ?>

      <?php if ($this->permission_cookie[44] == 1) { ?>
        <li>
          <a href="#client_rfi" data-parent="#sidebar" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
            <i class="fas fa-list"></i> &nbsp; <b>Client RFI</b>
          </a>
          <ul class=" list-unstyled" id="client_rfi">
            <li>
              <a href="<?php echo base_url(); ?>visual/client_rfi">
                <i class="fas fa-caret-right"></i> &nbsp; RFI List
              </a>
            </li>
            <li>
              <a href="<?php echo base_url(); ?>visual/client_rfi/summary">
                <i class="fas fa-caret-right"></i> &nbsp; Summary RFI
              </a>
            </li>
          </ul>
        </li>
      <?php } ?>

      <?php if ($this->permission_cookie[192] == 1) : ?>
        <li>
          <a href="<?php echo base_url(); ?>visual/third_party_list">
            <i class="fas fa-list"></i> &nbsp; Third Party List
          </a>
        </li>
      <?php endif; ?>


      <?php if ($this->permission_cookie[39] == 1 && $this->user_cookie[7] != 8) { ?>
        <li>
          <a href="<?php echo base_url(); ?>visual/ndt_reject">
            <i class="fas fa-reply-all"></i> &nbsp; NDT - Reject
          </a>
        </li>
      <?php } ?>

      <?php if ($this->permission_cookie[243] == 1 && $this->user_cookie[7] != 8) { ?>
        <li>
          <a href="<?php echo base_url(); ?>visual/void_visual_revision">
            <i class="fas fa-eraser"></i> &nbsp; Void Visual Revision
          </a>
        </li>
      <?php } ?>

      <?php if ($this->permission_cookie[45] == 1) { ?>
        <li>
          <a href="<?php echo base_url(); ?>visual/export_excel/">
            <i class="far fa-file-excel"></i> &nbsp;&nbsp; Export Visual Inspection
          </a>
        </li>
        <!-- <li class="<?= (in_array(21, $this->user_cookie[13]) OR in_array(19, $this->user_cookie[13])) AND (in_array(5, $this->user_cookie[14]) OR in_array(2472, $this->user_cookie[14])) ? '' : 'd-none' ?>">
          <a href="<?php echo base_url(); ?>visual/import_visual">
            <i class="fas fa-file-upload"></i> &nbsp;&nbsp; Import Visual Inspection
          </a>
        </li> -->
        <li class="d-none">
          <a href="<?php echo base_url(); ?>visual/update_ecodoc/">
            <i class="far fa-file-excel"></i> &nbsp;&nbsp; Import Ecodoc No.
          </a>
        </li>
      <?php } ?>

      <!-- <?php if ($this->permission_cookie[41] == 1) { ?>
        <li>
          <a href="#revise_list" data-parent="#sidebar" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
            <i class="fas fa-edit"></i> &nbsp; <b>Request for Update (QC)</b>
          </a>
          <ul class=" list-unstyled" id="revise_list">
            <li>
              <a href="<?= base_url(); ?>visual/revise_history_list/submited/"><i class="fas fa-caret-right"></i> &nbsp; Approval (Inspector)</a>
            </li>
            <li>
              <a href="<?= base_url(); ?>visual/revise_history_list/approved/"><i class="fas fa-caret-right"></i> &nbsp; Approved for Update</a>
            </li>
            <li>
              <a href="<?= base_url(); ?>visual/revise_history_list/reapproval/"><i class="fas fa-caret-right"></i> &nbsp; Re-Approval Inspector</a>
            </li>
            <li>
              <a href="<?= base_url(); ?>visual/revise_history_list/closed/"><i class="fas fa-caret-right"></i> &nbsp; Closed</a>
            </li>
          </ul>
        </li>
      <?php } ?> -->

      <!-- <?php if ($this->permission_cookie[181] == 1) { ?>
        <li>
          <a href="#rfu_clien" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <i class="fas fa-edit"></i> <b>&nbsp; Request for Update (Report)</b>
          </a>
          <ul class="list-unstyled" id="rfu_clien">
            <li>
              <a href="<?= base_url(); ?>visual/revise_history_list/submited/2"><i class="fas fa-caret-right"></i> &nbsp; Approval (Client)</a>
            </li>
            <li>
              <a href="<?= base_url(); ?>visual/revise_history_list/approved/2"><i class="fas fa-caret-right"></i> &nbsp; Approved for Update</a>
            </li>
            <li>
              <a href="<?= base_url(); ?>visual/revise_history_list/closed/2"><i class="fas fa-caret-right"></i> &nbsp; Closed</a>
            </li>
          </ul>
        </li>
      <?php } ?> -->

      <?php if ($this->permission_cookie[0] == 1 && $this->user_cookie[7] != 8) { ?>
        <li>
          <a href="#drawing_un_official" data-parent="#sidebar" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
            <i class="fas fa-warning"></i> &nbsp; <b>Drawing Un-Official</b>
          </a>
          <ul class=" list-unstyled" id="drawing_un_official">
            <li>
              <a href="<?= base_url(); ?>visual/cehck_drawing_unofficial/submission/"><i class="fas fa-caret-right"></i> &nbsp; Submission ID (QC)</a>
            </li>
            <li>
              <a href="<?= base_url(); ?>visual/cehck_drawing_unofficial/report/"><i class="fas fa-caret-right"></i> &nbsp; Report No. (Client)</a>
            </li>
          </ul>
        </li>
      <?php } ?>

      <?php if ($this->permission_cookie[211] == 1 && $this->user_cookie[7] != 8) { ?>
        <li>
          <a href="<?php echo base_url(); ?>visual/import_visual_ndt">
            <i class="fas fa-list"></i> &nbsp; Import Visual & NDT Data
          </a>
        </li>
      <?php } ?>

    </ul>
  </nav>