<div class="wrapper" style="min-height: 79vh">
<nav id="sidebar" class="<?php echo (($this->input->cookie('sidebarCollapse') !== NULL && $this->input->cookie('sidebarCollapse') == 1) ? 'active' : '') ?>">
  <ul class="list-unstyled components">

    <?php if($this->permission_cookie[30] == 1){ ?>
    <!-- <li>
      <a href="<?php echo base_url();?>fitup">
        <i class="fas fa-list"></i>  &nbsp; Production RFI
      </a>
    </li> -->

    <li>
        <a href="#mis_ssx" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
          <i class="fas fa-list"></i> &nbsp; <b>Production RFI</b>
        </a>
        <ul class="list-unstyled" id="mis_ssx">
          <li>
            <a href="<?php echo base_url();?>fitup/joint_list/internal"><i
                class="fas fa-caret-right"></i> &nbsp; Internal RFI</a> 
          </li>
          <li>
          <a href="<?php echo base_url();?>fitup/joint_list/external"><i
                class="fas fa-caret-right"></i> &nbsp; External RFI</a> 
          </li>         
        </ul>
      </li>
    <?php } ?>


   

    <?php if($this->permission_cookie[32] == 1 OR $this->permission_cookie[31] == 1){ ?>
      <!-- <li>
        <a href="<?php //echo base_url();?>fitup/update_remarks_ns_fs">
        <i class="fas fa-edit"></i>  &nbsp; Update Remarks
        </a>
      </li> -->
      <?php } ?>

    <?php if($this->permission_cookie[34] == 1){ ?>

      <li>
        <a href="#mis_ssx" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
          <i class="fas fa-list"></i> &nbsp; <b>Inspection RFI</b>
        </a>
        <ul class="list-unstyled" id="mis_ssx">
        
          <li>
            <a href="<?= site_url('fitup/inspection_rfi/'.strtr($this->encryption->encrypt('0'), '+=/', '.-~').'/'.strtr($this->encryption->encrypt('external'), '+=/', '.-~')) ?>"><i
                class="fas fa-caret-right"></i> &nbsp; Inspection List</a>
            <!-- <a href="<?php echo base_url();?>fitup/inspection_list"><i class="fas fa-caret-right"></i> &nbsp; Inspection List</a> -->
          </li>
          <li>
            <a href="<?= site_url('fitup/inspection_rfi/'.strtr($this->encryption->encrypt('0'), '+=/', '.-~').'/'.strtr($this->encryption->encrypt('internal'), '+=/', '.-~')) ?>"><i
                class="fas fa-caret-right"></i> &nbsp; Internal List</a>
            <!-- <a href="<?php echo base_url();?>fitup/inspection_list"><i class="fas fa-caret-right"></i> &nbsp; Inspection List</a> -->
          </li>
          <li>
          <a href="<?= site_url('fitup/inspection_rfi/'.strtr($this->encryption->encrypt('1'), '+=/', '.-~').'/'.strtr($this->encryption->encrypt('external'), '+=/', '.-~')) ?>"><i
                class="fas fa-caret-right"></i> &nbsp; Revision List</a>
            <!-- <a href="<?php echo base_url();?>fitup/inspection_list/revision"><i class="fas fa-caret-right"></i> &nbsp; Revision List</a> -->
          </li>         
        </ul>
      </li>
    <?php } ?>

    <?php if($this->permission_cookie[30] == 1 && $this->user_cookie[11] == 1){ ?>
      <li>
        <a href="#mis_ss" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
          <i class="fas fa-edit"></i> <b>&nbsp; Transmittal RFI</b>
        </a>
        <ul class="list-unstyled" id="mis_ss">
          <li>
            <a href="<?php echo base_url();?>fitup/joint_list/transmittal"><i class="fas fa-caret-right"></i> &nbsp; Ready to Transmittal</a>
          </li>
          <!-- <li>
            <a href="<?php echo base_url();?>fitup/postponed_list"><i class="fas fa-caret-right"></i> &nbsp; Postponed RFI</a>
          </li>  --> 
          <li>
            <a href="<?php echo base_url();?>fitup/postponed_list"><i class="fas fa-caret-right"></i> &nbsp; Re-Transmit List</a>
          </li>                  
        </ul>
      </li>
    <?php } ?>

    <?php if($this->permission_cookie[35] == 1){ ?>
      <li>
        <a href="#mis_ss" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <i class="fas fa-list"></i> <b>&nbsp; Client RFI</b>
        </a>
        <ul class="list-unstyled" id="mis_ss">
          <li>
            <a href="<?php echo base_url();?>fitup/client_rfi/"><i class="fas fa-caret-right"></i> &nbsp; RFI List</a>
            <!-- <a href="<?php echo base_url();?>fitup/client_list"><i class="fas fa-caret-right"></i> &nbsp; RFI List</a> -->
          </li>
          <li>
            <a href="<?php echo base_url();?>fitup/client_rfi/summary"><i class="fas fa-caret-right"></i> &nbsp; Summary RFI</a>
            <!-- <a href="<?php echo base_url();?>fitup/summary_report_no"><i class="fas fa-caret-right"></i> &nbsp; Summary RFI</a> -->
          </li>                          
        </ul>
      </li>
    <?php } ?>
    
    <?php if($this->permission_cookie[36] == 1){ ?>
    <li>
      <a href="<?php echo base_url();?>fitup/export_fitup">
        <i class="far fa-file-excel"></i>  &nbsp;&nbsp; Export Fit-Up
      </a>
    </li>
    <?php } ?>

    <?php if($this->permission_cookie[32] == 1){ ?>
    <li>
        <a href="#mis_ss" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
          <i class="fas fa-edit"></i> <b>&nbsp; Request for Update</b>
        </a>
        <ul class="list-unstyled" id="mis_ss">
          <li>
            <a
              href="<?= site_url('fitup/request_for_update_list/'.strtr($this->encryption->encrypt('waiting_approval'), '+=/', '.-~'));?>"><i
                class="fas fa-caret-right"></i> &nbsp; Approval (Inspector)</a>
          </li>
          <li>
            <a href="<?= site_url('fitup/request_for_update_list/'.strtr($this->encryption->encrypt('approved_for_update'), '+=/', '.-~'));?>"><i class="fas fa-caret-right"></i> &nbsp; Approved
              for Update</a>
          </li>
          <li>
            <a href="<?= site_url('fitup/request_for_update_list/'.strtr($this->encryption->encrypt('re_approval'), '+=/', '.-~'));?>"><i class="fas fa-caret-right"></i> &nbsp;
              Re-Approval Inspector</a>
          </li>
          <li>
            <a href="<?= site_url('fitup/request_for_update_list/'.strtr($this->encryption->encrypt('closed'), '+=/', '.-~'));?>"><i class="fas fa-caret-right"></i> &nbsp;
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
            <a href="<?php echo base_url();?>fitup/inspection_list_drawing/excel"><i class="fas fa-caret-right"></i> &nbsp; Submission ID (QC)</a>
          </li>
          <li>
            <a href="<?php echo base_url();?>fitup/summary_report_no_drawing_no/excel"><i class="fas fa-caret-right"></i> &nbsp; Report No. (Client)</a>
          </li>
        </ul>
      </li>
      <?php } ?>

      <?php if($this->permission_cookie[0] == 1){ ?>
      <li>
        <a href="<?= site_url('fitup/update_ecodoc') ?>">
          <i class="far fa-edit"></i> &nbsp;&nbsp; Update Ecodoc No
        </a>
      </li>
      <?php } ?>
      

  </ul>
</nav>