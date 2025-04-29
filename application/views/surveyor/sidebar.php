<?php
$array_user_allowed = array(1, 1000367, 1000129, 1001385, 1000202);
?>

<!-- <div class="row">
  <div class="col-md-2">
    <ul class="list-group sidebar-group">

      <li class="list-group-item"><i class="d-none fas fa-caret-right"></i>
        <a style="color: black" href="<?php echo base_url(); ?>planning/search_workpack">
          <i class="fas fa-caret-right"></i> &nbsp; Search Workpack
        </a>
      </li>

    </ul>
  </div>

  <div class="col-md-2">
    <ul class="list-group sidebar-group">

      <?php if (in_array($this->user_cookie[0], $array_user_allowed)) : ?>
        <li class="list-group-item">
          <a style="color: black" href="<?= site_url('planning/submited_list_pc/' . strtr($this->encryption->encrypt('mv'), '+=/', '.-~')) ?>">
            <i class="fas fa-caret-right"></i> &nbsp; MV RFI
          </a>
        </li>
      <?php endif; ?>

      <li class="list-group-item">
        <a style="color: black" href="<?= site_url('planning/submited_list/' . strtr($this->encryption->encrypt('fu'), '+=/', '.-~')) ?>">
          <i class="fas fa-caret-right"></i> &nbsp; Fitu-Up RFI
        </a>
      </li>
      <li class="list-group-item">
        <a style="color: black" href="<?= site_url('planning/submited_list/' . strtr($this->encryption->encrypt('vs'), '+=/', '.-~')) ?>">
          <i class="fas fa-caret-right"></i> &nbsp; Visual RFI
        </a>
      </li>

      <li class="list-group-item">
        <a style="color: black" href="<?= site_url('planning/submited_list_itr') ?>">
          <i class="fas fa-caret-right"></i> &nbsp; ITR RFI
        </a>
      </li>

      <li class="list-group-item">
        <a style="color: black" href="<?= site_url('planning/inspection_list_baa/' . strtr($this->encryption->encrypt('0'), '+=/', '.-~')) ?>">
          <i class="fas fa-caret-right"></i> &nbsp; Bonstrand RFI
        </a>
      </li>

    </ul>
  </div>

 
</div> -->
<div class="wrapper" style="min-height: 79vh">
<nav id="sidebar" class="<?php echo (($this->input->cookie('sidebarCollapse') !== NULL && $this->input->cookie('sidebarCollapse') == 1) ? 'active' : '') ?>">
  <ul class="list-unstyled components">
   
    <li>
      <a href="<?php echo base_url(); ?>planning/search_workpack/">
        <i class="fas fa-search"></i>  &nbsp; Search Workpack
      </a>
    </li> 
    <li>
        <a href="#mis_ssx" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
          <i class="fas fa-list"></i> &nbsp; <b>Submited List</b>
        </a>
        <ul class="list-unstyled" id="mis_ssx">
            <?php
            if (in_array($this->user_cookie[0], $array_user_allowed)) {
            ?>
          <li>
            <a href="<?= site_url('planning/submited_list_pc/' . strtr($this->encryption->encrypt('mv'), '+=/', '.-~')) ?>"><i
                class="fas fa-caret-right"></i> &nbsp; MV RFI</a> 
          </li>
           <?php } ?>
          <li>
            <a href="<?= site_url('planning/submited_list/' . strtr($this->encryption->encrypt('fu'), '+=/', '.-~')) ?>"><i
                class="fas fa-caret-right"></i> &nbsp; Fit-Up RFI</a> 
          </li>
          <li>
          <a href="<?= site_url('planning/submited_list/' . strtr($this->encryption->encrypt('vs'), '+=/', '.-~')) ?>"><i
                class="fas fa-caret-right"></i> &nbsp; Visual RFI</a> 
          </li>   
          <a href="<?= site_url('planning/submited_list_itr/') ?>"><i
                class="fas fa-caret-right"></i> &nbsp; ITR RFI</a> 
          </li>         
          </li>   
          <a href="<?= site_url('planning/inspection_list_baa/' . strtr($this->encryption->encrypt('0'), '+=/', '.-~')) ?>"><i class="fas fa-caret-right"></i> &nbsp; Bonstrand RFI</a>
          </li>         
        </ul>
      </li>
    
  </ul>
</nav>