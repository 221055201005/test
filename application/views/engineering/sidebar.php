<div class="wrapper" style="min-height: 79vh">
	<nav id="sidebar" class="<?php echo (($this->input->cookie('sidebarCollapse') !== NULL && $this->input->cookie('sidebarCollapse') == 1) ? 'active' : '') ?>">
		<ul class="list-unstyled components">

			<?php if ($this->permission_cookie[8] == 1 && $this->permission_cookie[2] == 1) : ?>
				<li>
					<a href="<?php echo base_url(); ?>engineering/status_drawing_list">
						<i class="fas fa-caret-right"></i> &nbsp; Drawing List
					</a>
				</li>
			<?php endif; ?>

			<?php if ($this->permission_cookie[8] == 1) : ?>
				<li>
					<a href="<?php echo base_url(); ?>engineering/piecemark_list">
						<i class="fas fa-caret-right"></i> &nbsp; Piecemark List
					</a>
				</li>
			<?php endif; ?>

			<?php if ($this->permission_cookie[2] == 1) : ?>
				<li>
					<a href="<?php echo base_url(); ?>engineering/joint_list">
						<i class="fas fa-caret-right"></i> &nbsp; Joint List
					</a>
				</li>
			<?php endif; ?>

			<?php if ($this->permission_cookie[6] == 1 or $this->permission_cookie[12] == 1) : ?>
				<li>
					<a href="<?php echo base_url(); ?>engineering/import_template">
						<i class="fas fa-caret-right"></i> &nbsp; Import Template
					</a>
				</li>
			<?php endif; ?>

			<li>
				<a href="<?php echo base_url(); ?>engineering/search_piecemark">
					<i class="fas fa-caret-right"></i> &nbsp; Search Piecemark
				</a>
			</li>
			<li>
				<a href="<?php echo base_url(); ?>engineering/search_joint">
					<i class="fas fa-caret-right"></i> &nbsp; Search Joint
				</a>
			</li>

			<?php if ($this->permission_cookie[7] == 1 or $this->permission_cookie[13] == 1) : ?>
				<li>
					<a href="<?php echo base_url(); ?>engineering/export_excel">
						<i class="fas fa-caret-right"></i> &nbsp; Export Excel
					</a>
				</li>

				<li>
					<a href="<?php echo base_url(); ?>engineering/activity_id_import">
						<i class="fas fa-caret-right"></i> &nbsp; Activity ID
					</a>
				</li>
			<?php endif; ?>

			<?php if ($this->permission_cookie[4] == 1 or $this->permission_cookie[10] == 1) : ?>
				<li>
					<a href="<?php echo base_url(); ?>engineering/revise_history_list">
						<i class="fas fa-caret-right"></i> &nbsp; Request for Update
					</a>
				</li>
			<?php endif; ?>
		</ul>
	</nav>