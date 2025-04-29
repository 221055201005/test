<div class="wrapper" style="min-height: 79vh">
  <nav id="sidebar" class="<?php echo (($this->input->cookie('sidebarCollapse') !== NULL && $this->input->cookie('sidebarCollapse') == 1) ? 'active' : '') ?>">
    <ul class="list-unstyled components">

      <li>
        <a href="<?php echo base_url();?>mdb">
          <i class="fas fa-caret-right"></i>  &nbsp; MDB List
        </a>
      </li>

			<?php if($this->permission_cookie[0] == 1): ?>
				<li>
					<a href="<?php echo base_url();?>mdb/master_mdb_ecodoc_list">
						<i class="fas fa-caret-right"></i>  &nbsp; MDB Ecodoc Master
					</a>
				</li>
				<?php endif; ?>
			<?php if($this->user_cookie[7] == 1): ?>
				<li>
					<a href="<?php echo base_url();?>mdb/mdb_offline">
						<i class="fas fa-caret-right"></i>  &nbsp; MDB Offline
					</a>
				</li>
			<?php endif; ?>

    </ul>
  </nav>