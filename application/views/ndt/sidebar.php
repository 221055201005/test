<div class="wrapper" style="min-height: 79vh">
  <nav id="sidebar" class="<?php echo (($this->input->cookie('sidebarCollapse') !== NULL && $this->input->cookie('sidebarCollapse') == 1) ? 'active' : '') ?>">
    <ul class="list-unstyled components">
      <?php if($this->permission_cookie[58] == 1){ ?>
      <li>
        <a href="<?php echo base_url('Ndt/ndt/').$initial;?>">
          <i class="fas fa-list"></i>  &nbsp; NDT <?= $initial ?> Joint
        </a>
      </li>
      <?php } ?>
      <?php if($this->permission_cookie[60] == 1 OR $this->permission_cookie[59] == 1){ ?>
      <!-- <li>
        <a href="<?php echo base_url('Ndt/ndt_submit/').$initial;?>">
          <i class="fas fa-list"></i>  &nbsp; NDT <?= $initial ?> Submitted
        </a>
      </li> -->
      <li>
        <a href="<?php echo base_url('Ndt/ndt_submit_serverside/').$initial;?>">
          <i class="fas fa-list"></i>  &nbsp; NDT <?= $initial ?> Submitted
        </a>
      </li>
      <li>
        <a href="<?php echo base_url('Ndt/ndt_export/').$initial;?>">
          <i class="fas fa-file-excel"></i>  &nbsp; Export NDT <?= $initial ?>
        </a>
      </li>

      <li>
        <a href="<?php echo base_url('Ndt/update_ecodoc/').$initial;?>">
          <i class="far fa-file-excel"></i>  &nbsp;&nbsp; Import Ecodoc No.
        </a>
      </li>
      <?php } ?>

      <?php //if($this->permission_cookie[41] == 1){ ?>
      <li>
        <a href="#revise_list" data-parent="#sidebar" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
          <i class="fas fa-edit"></i> &nbsp; <b>Request for Update</b>
        </a>
        <ul class=" list-unstyled" id="revise_list">
          <li class="<?= $this->user_cookie[11]==1 ? '' : 'd-none' ?>">
            <a href="<?= base_url();?>ndt/revise_history_list/submited/<?= $initial ?>"><i class="fas fa-caret-right"></i> &nbsp; Approval (QC)</a>
          </li>
          <li>
            <a href="<?= base_url();?>ndt/revise_history_list/approved/<?= $initial ?>"><i class="fas fa-caret-right"></i> &nbsp; Approved for Update</a>
          </li>
          <li class="<?= $this->user_cookie[11]==1 ? '' : 'd-none' ?>">
            <a href="<?= base_url();?>ndt/revise_history_list/reapproval/<?= $initial ?>"><i class="fas fa-caret-right"></i> &nbsp; Re-Approval QC</a>
          </li>
          <li>
            <a href="<?= base_url();?>ndt/revise_history_list/closed/<?= $initial ?>"><i class="fas fa-caret-right"></i> &nbsp; Closed</a>
          </li>
        </ul>
      </li>
      <?php //} ?>

    </ul>
  </nav>