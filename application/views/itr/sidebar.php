<!-- <div class="row">

<?php if ($this->user_cookie[7] != 8) : ?>

  <div class="col-md-2">
    <ul class="list-group sidebar-group">
      <li class="list-group-item" style="background-color: #e3e3e3;"><b>Inspection RFI</b> <i class="fas fa-caret-down"></i></li>

      <li class="list-group-item"><i class="d-none fas fa-caret-right"></i> 
        <a style="color: black" href="<?= site_url('itr/inspection_list/' . strtr($this->encryption->encrypt('0'), '+=/', '.-~')) ?>">
          <i class="fas fa-caret-right"></i>  &nbsp; Inspection List RFI
        </a>
      </li>
      <li class="list-group-item"><i class="d-none fas fa-caret-right"></i> 
        <a style="color: black" href="<?= site_url('itr/inspection_list/' . strtr($this->encryption->encrypt('1'), '+=/', '.-~')) ?>">
          <i class="fas fa-caret-right"></i>  &nbsp; Revision List
        </a>
      </li>
    </ul>
  </div> 

  <div class="col-md-2">
    <ul class="list-group sidebar-group">
      <li class="list-group-item" style="background-color: #e3e3e3;"><b>Transmittal</b> <i class="fas fa-caret-down"></i></li>

      <li class="list-group-item">
        <a style="color: black" href="<?= site_url('itr/transmittal_rfi') ?>">
          <i class="fas fa-caret-right"></i>  &nbsp; Transmital List
        </a>
      </li> 

    </ul>
  </div>

  <?php endif; ?>

 

  <div class="col-md-2">
    <ul class="list-group sidebar-group">
      <li class="list-group-item" style="background-color: #e3e3e3;"><b>Summary Data</b> <i class="fas fa-caret-down"></i></li>

      <li class="list-group-item">
        <a style="color: black" href="<?= site_url('itr/itr_summary') ?>">
          <i class="fas fa-caret-right"></i>  &nbsp; Summary RFI
        </a>
      </li>

      <?php if ($this->user_cookie[7] != 8) : ?>
      <li class="list-group-item">
        <a style="color: black" href="<?= site_url('itr/export_itr') ?>">
          <i class="fas fa-caret-right"></i>  &nbsp; Export ITR
        </a>
      </li>
      <?php endif; ?>

    </ul>
  </div>

 
  <?php if ($this->user_cookie[7] != 8) : ?>
<div class="col-md-2">
  <ul class="list-group sidebar-group">
    <li class="list-group-item" style="background-color: #e3e3e3;"><b>NDT ITR</b> <i class="fas fa-caret-down"></i></li>

    <li class="list-group-item">
      <a style="color: black" href="<?= site_url('itr/itr_summary/' . strtr($this->encryption->encrypt('ndt_transmittal'), '+=/', '.-~')); ?>">
        <i class="fas fa-caret-right"></i>  &nbsp;  NDT Transmittal
      </a>
    </li>
 
    <li class="list-group-item">
      <a style="color: black" href="<?= site_url('itr/ndt_rfi_list'); ?>">
        <i class="fas fa-caret-right"></i>  &nbsp; NDT RFI
      </a>
    </li> 

  </ul>
</div>

<div class="col-md-2">
  <ul class="list-group sidebar-group">
    <li class="list-group-item" style="background-color: #e3e3e3;"><b>Request For Update</b> <i class="fas fa-caret-down"></i></li>

    <li class="list-group-item">
      <a style="color: black" href="<?= site_url('itr/request_for_update_list/' . strtr($this->encryption->encrypt('waiting_approval'), '+=/', '.-~')); ?>">
        <i class="fas fa-caret-right"></i>  &nbsp;  Approval (Inspector)
      </a>
    </li>

     
    <li class="list-group-item">
      <a style="color: black" href="<?= site_url('itr/request_for_update_list/' . strtr($this->encryption->encrypt('approved_for_update'), '+=/', '.-~')); ?>">
        <i class="fas fa-caret-right"></i>  &nbsp; Approved for Update
      </a>
    </li> 

    <li class="list-group-item">
      <a style="color: black" href="<?= site_url('itr/request_for_update_list/' . strtr($this->encryption->encrypt('re_approval'), '+=/', '.-~')); ?>">
        <i class="fas fa-caret-right"></i>  &nbsp; Re-Approval Inspector
      </a>
    </li> 

    <li class="list-group-item">
      <a style="color: black" href="<?= site_url('itr/request_for_update_list/' . strtr($this->encryption->encrypt('closed'), '+=/', '.-~')); ?>">
        <i class="fas fa-caret-right"></i>  &nbsp; Closed
      </a>
    </li> 

    <?php if($this->permission_cookie[127]==1 || $this->permission_cookie[126]==1){ ?>
    <li class="list-group-item">
      <a style="color: black" href="<?php echo base_url('itr/void_lists/');?>">
        <i class="fas fa-caret-right"></i>  &nbsp; NDT Void 
      </a>
    </li> 
    <?php } ?>


  </ul>
</div>
<?php endif; ?>

    
   
</div> -->

<div class="wrapper" style="min-height: 79vh">
  <nav id="sidebar" class="<?php echo (($this->input->cookie('sidebarCollapse') !== NULL && $this->input->cookie('sidebarCollapse') == 1) ? 'active' : '') ?>">
    <ul class="list-unstyled components">

      <?php if ($this->user_cookie[7] != 8) : ?>
        <li>
          <a href="#inspection" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <i class="fas fa-list"></i> <b>&nbsp; Inspection RFI</b>
          </a>
          <ul class="list-unstyled" id="inspection">
            <li>
              <a href="<?= site_url('itr/inspection_list/' . strtr($this->encryption->encrypt('0'), '+=/', '.-~')) ?>"><i class="fas fa-caret-right"></i> &nbsp; Inspection List</a>
            </li>

            <li>
              <a href="<?= site_url('itr/inspection_list/' . strtr($this->encryption->encrypt('1'), '+=/', '.-~')) ?>"><i class="fas fa-caret-right"></i> &nbsp; Revision List</a>
            </li>

          </ul>
        </li>

        <li>
          <a href="<?= site_url('itr/transmittal_rfi') ?>">
            <i class="fas fa-paper-plane"></i> &nbsp;&nbsp; Transmittal RFI
          </a>
        </li>


      <?php endif; ?>

      <li>
        <a href="<?= site_url('itr/itr_summary') ?>">
          <i class="fas fa-list"></i> &nbsp;&nbsp; ITR Summary
        </a>
      </li>


      <?php if ($this->user_cookie[7] != 8) : ?>
        <li>
          <a href="<?= site_url('itr/export_itr') ?>">
            <i class="fas fa-file-excel"></i> &nbsp;&nbsp; Export ITR
          </a>
        </li>


        <li>
          <a href="#ndt_itr" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <i class="fas fa-thermometer-quarter"></i> <b>&nbsp; NDT ITR</b>
          </a>
          <ul class="list-unstyled" id="ndt_itr">
            <li>
              <a href="<?= site_url('itr/itr_summary/' . strtr($this->encryption->encrypt('ndt_transmittal'), '+=/', '.-~')); ?>"><i class="fas fa-caret-right"></i> &nbsp; NDT Transmittal</a>
            </li>
            <li>
              <a href="<?= site_url('itr/ndt_rfi_list'); ?>"><i class="fas fa-caret-right"></i> &nbsp; NDT RFI</a>
            </li>
          </ul>
        </li>

        <li>
          <a href="#mis_ss" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <i class="fas fa-edit"></i> <b>&nbsp; Request for Update</b>
          </a>
          <ul class="list-unstyled" id="mis_ss">
            <li>
              <a href="<?= site_url('itr/request_for_update_list/' . strtr($this->encryption->encrypt('waiting_approval'), '+=/', '.-~')); ?>"><i class="fas fa-caret-right"></i> &nbsp; Approval (Inspector)</a>
            </li>
            <li>
              <a href="<?= site_url('itr/request_for_update_list/' . strtr($this->encryption->encrypt('approved_for_update'), '+=/', '.-~')); ?>"><i class="fas fa-caret-right"></i> &nbsp; Approved
                for Update</a>
            </li>
            <li>
              <a href="<?= site_url('itr/request_for_update_list/' . strtr($this->encryption->encrypt('re_approval'), '+=/', '.-~')); ?>"><i class="fas fa-caret-right"></i> &nbsp;
                Re-Approval Inspector</a>
            </li>
            <li>
              <a href="<?= site_url('itr/request_for_update_list/' . strtr($this->encryption->encrypt('closed'), '+=/', '.-~')); ?>"><i class="fas fa-caret-right"></i> &nbsp;
                Closed</a>
            </li>
          </ul>
        </li>
      <?php endif; ?>
      <?php if($this->permission_cookie[127]==1 || $this->permission_cookie[126]==1){ ?>
      <li>
        <a href="<?php echo base_url('itr/void_lists/');?>">
          <i class="fas fa-eye-slash"></i>  &nbsp;NDT Void 
        </a>
      </li>
      <?php } ?>

    </ul>
  </nav>