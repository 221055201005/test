<div class="wrapper" style="min-height: 79vh">
  <nav id="sidebar" class="<?php echo (($this->input->cookie('sidebarCollapse') !== NULL && $this->input->cookie('sidebarCollapse') == 1) ? 'active' : '') ?>">
    <ul class="list-unstyled components">

      <?php if ($this->user_cookie[7] != 8 && $this->user_cookie[11] == 1) : ?>
        <li>
          <a href="#inspection" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <i class="fas fa-list"></i> <b>&nbsp; Inspection RFI</b>
          </a>
          <ul class="list-unstyled" id="inspection">
            <li>
              <a href="<?= site_url('bondstrand/inspection_list/' . strtr($this->encryption->encrypt('0'), '+=/', '.-~')) ?>"><i class="fas fa-caret-right"></i> &nbsp; Inspection List</a>
            </li>

            <li>
              <a href="<?= site_url('bondstrand/inspection_list/' . strtr($this->encryption->encrypt('1'), '+=/', '.-~')) ?>"><i class="fas fa-caret-right"></i> &nbsp; Revision List</a>
            </li>

          </ul>
        </li>

        <li>
          <a href="<?= site_url('bondstrand/transmittal_rfi') ?>">
            <i class="fas fa-paper-plane"></i> &nbsp;&nbsp; Transmittal RFI
          </a>
        </li>
      <?php endif; ?>


      <?php if ($this->user_cookie[7] != 8 && $this->user_cookie[11] == 1) : ?>
        <!-- <li>
          <a href="<?= site_url('bondstrand/export_itr') ?>">
            <i class="fas fa-file-excel"></i> &nbsp;&nbsp; Export Bondstrand
          </a>
        </li> -->



        <li>
          <a href="#mis_ss" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <i class="fas fa-edit"></i> <b>&nbsp; Request for Update</b>
          </a>
          <ul class="list-unstyled" id="mis_ss">
            <li>
              <a href="<?= site_url('bondstrand/request_for_update_list/' . strtr($this->encryption->encrypt('waiting_approval'), '+=/', '.-~')); ?>"><i class="fas fa-caret-right"></i> &nbsp; Approval (Inspector)</a>
            </li>
            <li>
              <a href="<?= site_url('bondstrand/request_for_update_list/' . strtr($this->encryption->encrypt('approved_for_update'), '+=/', '.-~')); ?>"><i class="fas fa-caret-right"></i> &nbsp; Approved
                for Update</a>
            </li>
            <li>
              <a href="<?= site_url('bondstrand/request_for_update_list/' . strtr($this->encryption->encrypt('re_approval'), '+=/', '.-~')); ?>"><i class="fas fa-caret-right"></i> &nbsp;
                Re-Approval Inspector</a>
            </li>
            <li>
              <a href="<?= site_url('bondstrand/request_for_update_list/' . strtr($this->encryption->encrypt('closed'), '+=/', '.-~')); ?>"><i class="fas fa-caret-right"></i> &nbsp;
                Closed</a>
            </li>
          </ul>
        </li>
      <?php endif; ?>

			<?php if ($this->user_cookie[11] == 1 || $this->user_cookie[7] == 8) : ?>
      <li>
        <a href="<?= site_url('bondstrand/bondstrand_summary') ?>">
          <i class="fas fa-list"></i> &nbsp;&nbsp; Bondstrand Summary
        </a>
      </li>
			<?php endif; ?>

			<?php if ($this->permission_cookie[158] == 1) : ?>
			<li>
				<a href="<?= site_url('bondstrand/third_party_list') ?>">
					<i class="fas fa-list"></i> &nbsp;&nbsp; Bondstrand Third Party
				</a>
			</li>
			<?php endif; ?>

    </ul>
  </nav>