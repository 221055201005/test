<!-- <div class="row">
  <div class="col-md-2">
    <ul class="list-group sidebar-group">

      <li class="list-group-item"><i class="d-none fas fa-caret-right"></i>
        <a style="color: black" href="<?php echo base_url(); ?>btr/btr_list">
          <i class="fas fa-caret-right"></i> &nbsp; BTR List
        </a>
      </li>
    </ul>
  </div>

  <div class="col-md-2">
    <ul class="list-group sidebar-group">
      <li class="list-group-item" style="background-color: #e3e3e3;"><b>BTR Approval</b> <i class="fas fa-caret-down"></i></li>

      <li class="list-group-item">
        <a style="color: black" href="<?php echo base_url(); ?>btr/import_joint">
          <i class="fas fa-caret-right"></i> &nbsp; BTR - Import Joint
        </a>
      </li>
      <li class="list-group-item">
        <a style="color: black" href="<?= site_url('btr/btr_approval/' . encrypt(0)) ?>">
          <i class="fas fa-caret-right"></i> &nbsp; BTR - Draft
        </a>
      </li>

      <li class="list-group-item">
        <a style="color: black" href="<?= site_url('btr/btr_approval/' . encrypt(1)) ?>">
          <i class="fas fa-caret-right"></i> &nbsp; BTR - QC Inspection List
        </a>
      </li>

      <li class="list-group-item">
        <a style="color: black" href="<?= site_url('btr/btr_approval/' . encrypt('ready_transmit')) ?>">
          <i class="fas fa-caret-right"></i> &nbsp; BTR - Ready to Transmittal
        </a>
      </li>

      <li class="list-group-item">
        <a style="color: black" href="<?= site_url('btr/btr_approval/' . encrypt('summary_rfi')) ?>">
          <i class="fas fa-caret-right"></i> &nbsp; BTR - Summary RFI
        </a>
      </li>


    </ul>
  </div>
  <div class="col-md-2">
    <ul class="list-group sidebar-group">

      <li class="list-group-item">
        <a style="color: black" href="<?=site_url('btr/btr_export') ?>">
          <i class="fas fa-caret-right"></i> &nbsp;BTR Export
        </a>
      </li>
      
    </ul>
  </div>
 
</div> -->

<div class="wrapper" style="min-height: 79vh">
  <nav id="sidebar" class="<?php echo (($this->input->cookie('sidebarCollapse') !== NULL && $this->input->cookie('sidebarCollapse') == 1) ? 'active' : '') ?>">
    <ul class="list-unstyled components">

      <li>
        <a href="<?= site_url('btr/btr_list') ?>">
          <i class="fas fa-list"></i> &nbsp;&nbsp; BTR List
        </a>
      </li>

      <li>
        <a href="#mis_ss" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
          <i class="fas fa-edit"></i> <b>&nbsp; BTR Approval </b>
        </a>
        <ul class="list-unstyled" id="mis_ss">
          <li>
            <a href="<?= site_url('btr/import_joint') ?>"><i class="fas fa-caret-right"></i> &nbsp; BTR - Import Joint</a>
          </li>

          <li>
            <a href="<?= site_url('btr/btr_approval/' . encrypt(0)) ?>"><i class="fas fa-caret-right"></i> &nbsp; BTR - Draft</a>
          </li>

          <li>
            <a href="<?= site_url('btr/btr_approval/' . encrypt(1)) ?>"><i class="fas fa-caret-right"></i> &nbsp; BTR - QC Inspection List</a>
          </li>

          <li>
            <a href="<?= site_url('btr/btr_approval/' . encrypt("ready_transmit")) ?>"><i class="fas fa-caret-right"></i> &nbsp; BTR - Ready to Transmittal</a>
          </li>

          <li>
            <a href="<?= site_url('btr/btr_approval/' . encrypt("summary_rfi")) ?>"><i class="fas fa-caret-right"></i> &nbsp; BTR - Summary RFI</a>
          </li>


        </ul>
      </li>


      <li>
        <a href="<?= site_url('btr/btr_export') ?>">
          <i class="fas fa-list"></i> &nbsp;&nbsp; BTR Export
        </a>
      </li>


    </ul>
  </nav>