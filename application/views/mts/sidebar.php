<div class="wrapper" style="min-height: 79vh">
  <nav id="sidebar" class="<?php echo (($this->input->cookie('sidebarCollapse') !== NULL && $this->input->cookie('sidebarCollapse') == 1) ? 'active' : '') ?>">
    <ul class="list-unstyled components">

      <li>
        <a href="<?= site_url('mts/mts_list') ?>">
          <i class="fas fa-list"></i> &nbsp;&nbsp; MTS List
        </a>
      </li>

      <li>
        <a href="#mis_ss" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
          <i class="fas fa-edit"></i> <b>&nbsp; MTS Approval </b>
        </a>
        <ul class="list-unstyled" id="mis_ss">
          <li>
            <a href="<?= site_url('mts/import_piecemark') ?>"><i class="fas fa-caret-right"></i> &nbsp; MTS - Import Piecemark</a>
          </li>

          <li>
            <a href="<?= site_url('mts/mts_approval/' . encrypt(0)) ?>"><i class="fas fa-caret-right"></i> &nbsp; MTS - Draft</a>
          </li>

          <li>
            <a href="<?= site_url('mts/mts_approval/' . encrypt(1)) ?>"><i class="fas fa-caret-right"></i> &nbsp; MTS - QC Inspection List</a>
          </li>

          <li>
            <a href="<?= site_url('mts/mts_approval/' . encrypt("ready_transmit")) ?>"><i class="fas fa-caret-right"></i> &nbsp; MTS - Ready to Transmittal</a>
          </li>

          <li>
            <a href="<?= site_url('mts/mts_approval/' . encrypt("summary_rfi")) ?>"><i class="fas fa-caret-right"></i> &nbsp; MTS - Summary RFI</a>
          </li>


        </ul>
      </li>


      <li>
        <a href="<?= site_url('mts/mts_export') ?>">
          <i class="fas fa-list"></i> &nbsp;&nbsp; MTS Export
        </a>
      </li>


    </ul>
  </nav>