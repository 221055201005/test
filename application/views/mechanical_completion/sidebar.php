<!-- <div class="row">
  <?php if ($this->permission_cookie[138] == 1) : ?>
    <div class="col-md-2">
      <ul class="list-group sidebar-group">
        <li class="list-group-item" style="background-color: #e3e3e3;"><b>Mechanical Completion</b> <i class="fas fa-caret-down"></i></li>

        <?php if ($this->permission_cookie[148] == 1) : ?>
          <li class="list-group-item"><i class="d-none fas fa-caret-right"></i>
            <a style="color: black" href="<?php echo base_url(); ?>mechanical_completion/mechanical_completion_dashboard">
              <i class="fas fa-caret-right"></i> &nbsp; Dashboard
            </a>
          </li>
        <?php endif; ?>
        <li class="list-group-item"><i class="d-none fas fa-caret-right"></i>
          <a style="color: black" href="<?php echo base_url(); ?>>mechanical_completion/mechanical_completion_list">
            <i class="fas fa-caret-right"></i> &nbsp; Mechanical Completion List
          </a>
        </li>
        <?php if ($this->permission_cookie[139] == 1) : ?>
          <li class="list-group-item"><i class="d-none fas fa-caret-right"></i>
            <a style="color: black" href="<?php echo base_url(); ?>>mechanical_completion/mechanical_completion_import">
              <i class="fas fa-caret-right"></i> &nbsp; Import Checklist
            </a>
          </li>
        <?php endif; ?>

        <?php if ($this->permission_cookie[149] == 1) : ?>
          <li class="list-group-item"><i class="d-none fas fa-caret-right"></i>
            <a style="color: black" href="<?php echo base_url(); ?>>mechanical_completion/mechanical_completion_export">
              <i class="fas fa-caret-right"></i> &nbsp; Export Excel
            </a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  <?php endif; ?>

  <?php if ($this->permission_cookie[138] == 1) : ?>
    <div class="col-md-2">
      <ul class="list-group sidebar-group">
        <li class="list-group-item" style="background-color: #e3e3e3;"><b>Punch</b> <i class="fas fa-caret-down"></i></li>

        <li class="list-group-item">
          <a style="color: black" href="<?php echo base_url(); ?>mc_punch/mc_punch_dashboard">
            <i class="fas fa-caret-right"></i> &nbsp; Dashboard
          </a>
        </li>
        <li class="list-group-item">
          <a style="color: black" href="<?php echo base_url(); ?>mc_punch/mc_punch_list">
            <i class="fas fa-caret-right"></i> &nbsp; Punch List
          </a>
        </li>
        <?php if ($this->permission_cookie[139] == 1) : ?>
          <li class="list-group-item">
            <a style="color: black" href="<?php echo base_url(); ?>mc_punch/mc_punch_import">
              <i class="fas fa-caret-right"></i> &nbsp; Import Punch Item
            </a>
          </li>
        <?php endif; ?>

        <?php if ($this->permission_cookie[149] == 1) : ?>
          <li class="list-group-item">
            <a style="color: black" href="<?php echo base_url(); ?>mc_punch/mc_punch_export">
              <i class="fas fa-caret-right"></i> &nbsp; Export Excel
            </a>
          </li>
        <?php endif; ?>

      </ul>
    </div>
  <?php endif; ?>
  <?php if ($this->permission_cookie[0] == 1) : ?>
    <div class="col-md-2">
      <ul class="list-group sidebar-group">
        <li class="list-group-item">
          <a style="color: black" href="<?php echo base_url(); ?>mechanical_completion/update_ecodoc">
            <i class="fas fa-caret-right"></i> &nbsp; Update Ecodoc No
          </a>
        </li>
      </ul>
    </div>
  <?php endif; ?>

  
</div> -->

<div class="wrapper" style="min-height: 79vh">
  <nav id="sidebar" class="<?php echo (($this->input->cookie('sidebarCollapse') !== NULL && $this->input->cookie('sidebarCollapse') == 1) ? 'active' : '') ?>">
    <ul class="list-unstyled components">

      <?php if ($this->permission_cookie[138] == 1) : ?>
        <li>
          <a href="#mechanical_checklist" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <i class="fas fa-paperclip"></i> <b>&nbsp; Mechanical Completion</b>
          </a>
          <ul class="list-unstyled" id="mechanical_checklist">
            <?php if ($this->permission_cookie[148] == 1) : ?>
              <li>
                <a href="<?php echo base_url(); ?>mechanical_completion/mechanical_completion_dashboard">
                  <i class="fas fa-home"></i> &nbsp; Dashboard</a>
              </li>
              <li>
              <?php endif; ?>
              <a href="<?php echo base_url(); ?>mechanical_completion/mechanical_completion_list">
                <i class="fas fa-list"></i> &nbsp; Mechanical Completion List
              </a>
              </li>
              <?php if ($this->permission_cookie[139] == 1) : ?>
                <li>
                  <a href="<?php echo base_url(); ?>mechanical_completion/mechanical_completion_import">
                    <i class="fas fa-upload"></i> &nbsp; Import Checklist
                  </a>
                </li>
              <?php endif; ?>
              <?php if ($this->permission_cookie[149] == 1) : ?>
                <li>
                  <a href="<?php echo base_url(); ?>mechanical_completion/mechanical_completion_export">
                    <i class="fas fa-file-excel"></i> &nbsp; Export Excel
                  </a>
                </li>
              <?php endif; ?>
          </ul>
        </li>
      <?php endif; ?>

      <?php if ($this->permission_cookie[138] == 1) : ?>
        <li>
          <a href="#punch_item" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <i class="fas fa-paperclip"></i> <b>&nbsp; Punch</b>
          </a>
          <ul class="list-unstyled" id="punch_item">
            <li>
              <a href="<?php echo base_url(); ?>mc_punch/mc_punch_dashboard">
                <i class="fas fa-home"></i> &nbsp; Dashboard</a>
            </li>
            <li>
              <a href="<?php echo base_url(); ?>mc_punch/mc_punch_list">
                <i class="fas fa-list"></i> &nbsp; Punch List
              </a>
            </li>
            <?php if ($this->permission_cookie[139] == 1) : ?>
              <li>
                <a href="<?php echo base_url(); ?>mc_punch/mc_punch_import">
                  <i class="fas fa-upload"></i> &nbsp; Import Punch Item
                </a>
              </li>
            <?php endif; ?>
            <?php if ($this->permission_cookie[149] == 1) : ?>
              <li>
                <a href="<?php echo base_url(); ?>mc_punch/mc_punch_export">
                  <i class="fas fa-file-excel"></i> &nbsp; Export Excel
                </a>
              </li>
            <?php endif; ?>
          </ul>
        </li>
      <?php endif; ?>

      <?php if ($this->permission_cookie[0] == 1) { ?>
        <li>
          <a href="<?= site_url('mechanical_completion/update_ecodoc') ?>">
            <i class="far fa-edit"></i> &nbsp;&nbsp; Update Ecodoc No
          </a>
        </li>
      <?php } ?>

    </ul>
  </nav>