<div class="wrapper" style="min-height: 79vh">
  <nav id="sidebar" class="<?php echo (($this->input->cookie('sidebarCollapse') !== NULL && $this->input->cookie('sidebarCollapse') == 1) ? 'active' : '') ?>">
    <ul class="list-unstyled components">
      <li>
        <a href="#sidebar_ndt" data-parent="#sidebar" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
          <i class="fas fa-list"></i> &nbsp; <b>NDT <?= $other ? $other : $method ?></b>
        </a>
        <ul class=" list-unstyled" id="sidebar_ndt">

          <li class="<?= $this->user_cookie[7] != 14 && $this->user_cookie[7] != 8  ? '' : 'd-none' ?>">
            <a href="<?php echo base_url('ndt_live/rfi_list/' . encrypt(($other ? $other :$method))) ?>">
              <i class="fas fa-caret-right"></i> &nbsp; RFI List
            </a>
          </li>

          <li class="d-none">
            <a href="<?php echo base_url('ndt_live/pending_rfi_list/' . encrypt(($other ? $other :$method))) ?>">
              <i class="fas fa-caret-right"></i> &nbsp; Pending RFI List
            </a>
          </li>

          <li class="<?= $this->user_cookie[7] != 14 && $this->user_cookie[7] != 8 ? '' : 'd-none' ?>">
            <a href="<?php echo base_url('ndt_live/joint_list/' . encrypt(($other ? $other :$method))) ?>">
              <i class="fas fa-caret-right"></i> &nbsp; NDT <?= $other ? $other : $method ?> - Joint List
            </a>
          </li>

          <li class="<?= $this->user_cookie[7] != 14 ? '' : 'd-none' ?>">
            <a href="<?php echo base_url('ndt_live/ndt_list/' . encrypt(($other ? $other :$method))) ?>">
              <i class="fas fa-caret-right"></i> &nbsp; NDT <?= $other ? $other : $method ?> - Submitted List
            </a>
          </li>

          <li class="<?= !in_array($method, ['MT', 'RT', 'PT', 'UT', 'PA-UT']) ? 'd-none' : '' ?>">
            <a href="<?php echo base_url('ndt_live/ndt_export/') . encrypt(($other ? $other : $method)); ?>">
              <i class="fas fa-caret-right"></i> &nbsp; Export NDT <?= $other ? $other : $method ?>
            </a>
          </li>

          <li class="<?= in_array($method, ['MT', 'RT', 'PT', 'UT', 'PA-UT']) ? 'd-none' : '' ?>">
            <a href="<?php echo base_url('ndt_live/ndt_export_cc/'). encrypt(($other ? $other : $method));?>">
              <i class="fas fa-caret-right"></i>  &nbsp; Export NDT <?= $other ? $other : $method ?>
            </a>
          </li>

          <?php if($this->permission_cookie[210]==1 AND in_array($method, ['MT', 'RT', 'PT', 'UT'])){ ?>
            <li class="">
              <a href="<?php echo base_url('ndt_live/search_joint_welder/'). encrypt($method);?>">
                <i class="fas fa-caret-right"></i>  &nbsp; Search Joint NDT
              </a>
            </li>
          <?php } ?>

          <?php if($this->permission_cookie[210]==1 AND !in_array($method, ['MT', 'RT', 'PT', 'UT'])){ ?>
            <!-- <li class="">
              <a href="<?php echo base_url('ndt_live/search_joint_welder/').encrypt('ATC').'/'.encrypt($method);?>">
                <i class="fas fa-caret-right"></i>  &nbsp; Search Joint NDT
              </a>
            </li> -->
          <?php } ?>

          <?php if ($this->permission_cookie[192] == 1 && $this->user_cookie[7] != 8 and in_array(17, $this->user_cookie[13])) : ?>
            <li>
              <a href="<?php echo base_url('ndt_live/third_party_list/' . encrypt($method)) ?>">
                <i class="fas fa-caret-right"></i> &nbsp; NDT <?= $other ? $other : $method ?> - Third Party List
              </a>
            </li>
          <?php endif; ?>
        </ul>
      </li>
    </ul>
  </nav>