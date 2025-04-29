<!-- <div class="row">
  <div class="col-md-2">
    <ul class="list-group sidebar-group">
      <li class="list-group-item" style="background-color: #e3e3e3;"><b>Home</b> <i class="fas fa-caret-down"></i></li>

      <li class="list-group-item"><i class="d-none fas fa-caret-right"></i>
        <a style="color: black" href="<?php echo base_url(); ?>planning_bnp/home_bnp">
          <i class="fas fa-caret-right"></i> &nbsp; Progress Summary
        </a>
      </li>
      <li class="list-group-item"><i class="d-none fas fa-caret-right"></i>
        <a style="color: black" href="<?php echo base_url(); ?>planning_bnp/workpack_list_bnp_status_detail">
          <i class="fas fa-caret-right"></i> &nbsp; BP Status WP Report
        </a>
      </li>
      <li class="list-group-item"><i class="d-none fas fa-caret-right"></i>
        <a style="color: black" href="<?php echo base_url(); ?>planning_bnp/bnp_status_report_daily">
          <i class="fas fa-caret-right"></i> &nbsp; B&P Daily Progress Report
        </a>
      </li>
    </ul>
  </div>

  <?php if ($this->user_cookie[7] != 8) : ?>
    <div class="col-md-2">
      <ul class="list-group sidebar-group">
        <li class="list-group-item" style="background-color: #e3e3e3;"><b>B&P PMT</b> <i class="fas fa-caret-down"></i></li>

        <li class="list-group-item">
          <a style="color: black" href="<?php echo base_url(); ?>planning_bnp/production_rfi">
            <i class="fas fa-caret-right"></i> &nbsp; Workpack
          </a>
        </li>
        <li class="list-group-item">
          <a style="color: black" href="<?php echo base_url(); ?>planning_bnp/production_rfi/2">
            <i class="fas fa-caret-right"></i> &nbsp; WO
          </a>
        </li>

      </ul>
    </div>


    <div class="col-md-2">
      <ul class="list-group sidebar-group">
        <li class="list-group-item" style="background-color: #e3e3e3;"><b>B&P RFI</b> <i class="fas fa-caret-down"></i></li>

        <li class="list-group-item">
          <a style="color: black" href="<?php echo site_url('planning_bnp/inspection_list/' . strtr($this->encryption->encrypt('2'), '+=/', '.-~')) . '/0' ?>">
            <i class="fas fa-caret-right"></i> &nbsp; Transmittal List
          </a>
        </li>
        <li class="list-group-item">
          <a style="color: black" href="<?php echo site_url('planning_bnp/inspection_list/' . strtr($this->encryption->encrypt('2'), '+=/', '.-~')) . '/1' ?>">
            <i class="fas fa-caret-right"></i> &nbsp; RFI List
          </a>
        </li>

        <li class="list-group-item">
          <a style="color: black" href="<?php echo site_url('planning_bnp/inspection_list/' . strtr($this->encryption->encrypt('3'), '+=/', '.-~')) . '/3' ?>">
            <i class="fas fa-caret-right"></i> &nbsp; Additional Activity
          </a>
        </li>


      </ul>
    </div>

  <?php endif; ?>

  <div class="col-md-2">
    <ul class="list-group sidebar-group">

      <li class="list-group-item">
        <a style="color: black" href="<?php echo base_url(); ?>planning_bnp/download_register_bnp">
          <i class="fas fa-caret-right"></i> &nbsp; Export Register
        </a>
      </li>
    </ul>
  </div>
</div> -->

<div class="wrapper" style="min-height: 79vh">
  <nav id="sidebar" class="<?php echo (($this->input->cookie('sidebarCollapse') !== NULL && $this->input->cookie('sidebarCollapse') == 1) ? 'active' : '') ?>">
    <ul class="list-unstyled components"> 
      
      <li>
        <a href="#bnp_home" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
          <i class="fas fa-home"></i> &nbsp; Home
        </a>
        <ul class="list-unstyled collapse show" id="bnp_home">
        
          <li>
            <a href="<?php echo site_url('planning_bnp/home_bnp'); ?>">
            <i class="fas fa-caret-right"></i> &nbsp; Progress Summary
            </a>
          </li>

          <li>
            <a href="<?php echo site_url('planning_bnp/workpack_list_bnp_status_detail/') ?>">
              <i class="fas fa-caret-right"></i> &nbsp; BP Status WP Report
            </a>
          </li>

          <li>
            <a href="<?php echo site_url('planning_bnp/bnp_status_report_daily'); ?>">
            <i class="fas fa-caret-right"></i> &nbsp; B&P Daily Progress Report
            </a>
          </li>
 
        </ul>
      </li>
      
      <?php if ($this->user_cookie[7] != 8) { ?>
      <li>
        <a href="#pmt_list" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
          <i class="fas fa-briefcase"></i> &nbsp; B&P PMT
        </a>
        <ul class="list-unstyled collapse show" id="pmt_list">
          <li>
            <a href="<?php echo site_url('planning_bnp/production_rfi'); ?>">
            <i class="fas fa-caret-right"></i> &nbsp; Workpack
            </a>
          </li>
          <li>
            <a href="<?php echo site_url('planning_bnp/production_rfi/2'); ?>">
            <i class="fas fa-caret-right"></i> &nbsp; WO
            </a>
          </li>
        </ul>
      </li>
      <?php } ?>

      <li>
        <a href="#bnp_list" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
          <i class="fas fa-briefcase"></i> &nbsp; B&P RFI
        </a>
        <ul class="list-unstyled collapse show" id="bnp_list">
        <?php if ($this->user_cookie[7] != 8) { ?>
          <li>
            <a href="<?php echo site_url('planning_bnp/inspection_list/' . strtr($this->encryption->encrypt('2'), '+=/', '.-~')) . '/0' ?>">
              <i class="fas fa-caret-right"></i> &nbsp; Transmittal List
            </a>
          </li>
        <?php } ?>
          <li>
            <a href="<?php echo site_url('planning_bnp/inspection_list/' . strtr($this->encryption->encrypt('2'), '+=/', '.-~')) . '/1' ?>">
              <i class="fas fa-caret-right"></i> &nbsp; RFI List
            </a>
          </li> 
          <li>
            <a href="<?php echo site_url('planning_bnp/inspection_list/' . strtr($this->encryption->encrypt('3'), '+=/', '.-~')) . '/3' ?>">
              <i class="fas fa-caret-right"></i> &nbsp; Additional Activity
            </a>
          </li> 

        </ul>
      </li>



      <li>
        <a href="<?php echo site_url('planning_bnp/download_register_bnp/') ?>">
          <i class="fas fa-cloud-download-alt"></i> &nbsp; Export Register
        </a>
      </li>




    </ul>
  </nav>