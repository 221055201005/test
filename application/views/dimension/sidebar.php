<div class="wrapper" style="min-height: 79vh">
	<nav id="sidebar" class="<?php echo (($this->input->cookie('sidebarCollapse') !== NULL && $this->input->cookie('sidebarCollapse') == 1) ? 'active' : '') ?>">
		<ul class="list-unstyled components">
			<li>
				<a href="#dimensioncontrol_menu" data-parent="#sidebar" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
					<i class="fas fa-cube"></i> &nbsp; Dimension Control
				</a>
				<ul class="list-unstyled" id="dimensioncontrol_menu">
					<li>
						<a href="<?= base_url() ?>dimension/draw_list/<?= strtr($this->encryption->encrypt(1), '+=/', '.-~') ?>"><i class="fas fa-plus"></i> &nbsp; Add New</a>
					</li>
					<li>
						<a href="<?= base_url() ?>dimension/dc_list/<?= strtr($this->encryption->encrypt(1), '+=/', '.-~') ?>"><i class="fas fa-caret-right"></i> &nbsp; List</a>
					</li>
				</ul>

				<?php if (1 == 0) : ?>
					<?php if ($this->user_cookie[7] != 8  && $this->permission_cookie[130]) { ?>

						<!-- <?php if (empty($type_of_report)) { ?>    
          <a href="<?= base_url() ?>dimension/draw_list/" data-parent="#sidebar">
            <i class="fas fa-plus"></i> &nbsp; Add New Additional Report
          </a>
          <?php } ?>  -->

						<?php if ($type_of_report == 1 && $meta_title != "Correction Of Distortion") { ?>
							<a href="<?= base_url() ?>dimension/draw_list/<?= strtr($this->encryption->encrypt(1), '+=/', '.-~') ?>" data-parent="#sidebar">
								<i class="fas fa-plus"></i> &nbsp; Add New Dimension Control
							</a>
						<?php $tor = 1;
						} ?>

						<?php if ($type_of_report == 1 && $meta_title == "Correction Of Distortion") { ?>
							<a href="<?= base_url() ?>dimension/add_additional/<?= strtr($this->encryption->encrypt(1), '+=/', '.-~') ?>" data-parent="#sidebar">
								<i class="fas fa-plus"></i> &nbsp; Add New Correction Of Distortion
							</a>
						<?php $tor = 2;
						} ?>

						<?php if ($type_of_report == 2 && $meta_title == "Excavation") { ?>
							<a href="<?= base_url() ?>dimension/add_additional/<?= strtr($this->encryption->encrypt(2), '+=/', '.-~') ?>" data-parent="#sidebar">
								<i class="fas fa-plus"></i> &nbsp; Add New Excavation
							</a>
						<?php $tor = 3;
						} ?>

						<?php if ($type_of_report == 3 && $meta_title == "Buttering") { ?>
							<a href="<?= base_url() ?>dimension/add_additional/<?= strtr($this->encryption->encrypt(3), '+=/', '.-~') ?>" data-parent="#sidebar">
								<i class="fas fa-plus"></i> &nbsp; Add New Buttering
							</a>
						<?php $tor = 4;
						} ?>

						<?php if ($type_of_report == 0 && $meta_title == "Hardness Testing") { ?>
							<a href="<?= base_url() ?>dimension/add_additional/<?= strtr($this->encryption->encrypt(0), '+=/', '.-~') ?>" data-parent="#sidebar">
								<i class="fas fa-plus"></i> &nbsp; Add New - Hardness Testing
							</a>
						<?php $tor = 5;
						} ?>

						<?php if ($type_of_report == 4 && $meta_title == "Borescope Survey Reports") { ?>
							<a href="<?= base_url() ?>dimension/add_additional/<?= strtr($this->encryption->encrypt(4), '+=/', '.-~') ?>" data-parent="#sidebar">
								<i class="fas fa-plus"></i> &nbsp; Add New - Borescope Reports
							</a>
						<?php $tor = 6;
						} ?>

						<?php if ($type_of_report == 5 && $meta_title == "Thickness Gauge Reports") { ?>
							<a href="<?= base_url() ?>dimension/add_additional/<?= strtr($this->encryption->encrypt(5), '+=/', '.-~') ?>" data-parent="#sidebar">
								<i class="fas fa-plus"></i> &nbsp; Add New - Thickness Gauge Reports
							</a>
						<?php } ?>

						<?php if ($tor == 1) { ?>
							<a href="<?php echo base_url(); ?>dimension/dc_update_ecodoc/<?= strtr($this->encryption->encrypt($tor), '+=/', '.-~') ?>">
								<i class="far fa-file-excel"></i> &nbsp;&nbsp; Import <?= $meta_title ?> Ecodoc No.
							</a>
						<?php } elseif ($tor == 5) { ?>
							<a href="<?php echo base_url(); ?>dimension/ht_update_ecodoc/<?= strtr($this->encryption->encrypt($tor), '+=/', '.-~') ?>">
								<i class="far fa-file-excel"></i> &nbsp;&nbsp; Import <?= $meta_title ?> Ecodoc No.
							</a>
						<?php } ?>

					<?php } ?>

					<?php if ($this->permission_cookie[131]) { ?>
						<a href="#homeSubmenu3" data-parent="#sidebar" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
							<i class="fas fa-cube"></i> &nbsp; Additional Report - List
						</a>

						<ul class="list-unstyled" id="homeSubmenu3">

							<li>
								<a href="<?= base_url() ?>dimension/dc_list/"><i class="fas fa-caret-right"></i> &nbsp; All</a>
							</li>

							<li>
								<a href="<?= base_url() ?>dimension/dc_list/<?= strtr($this->encryption->encrypt(1), '+=/', '.-~') ?>"><i class="fas fa-caret-right"></i> &nbsp; Dimension Control</a>
							</li>

							<li>
								<a href="<?= base_url() ?>dimension/additional_report/<?= strtr($this->encryption->encrypt(1), '+=/', '.-~') ?>"><i class="fas fa-caret-right"></i> &nbsp; Correction Of Distortion</a>
							</li>

							<li>
								<a href="<?= base_url() ?>dimension/additional_report/<?= strtr($this->encryption->encrypt(2), '+=/', '.-~') ?>"><i class="fas fa-caret-right"></i> &nbsp; Excavation</a>
							</li>

							<li>
								<a href="<?= base_url() ?>dimension/additional_report/<?= strtr($this->encryption->encrypt(3), '+=/', '.-~') ?>"><i class="fas fa-caret-right"></i> &nbsp; Buttering</a>
							</li>

							<li>
								<a href="<?= base_url() ?>dimension/additional_report/<?= strtr($this->encryption->encrypt(0), '+=/', '.-~') ?>"><i class="fas fa-caret-right"></i> &nbsp; Hardness Testing</a>
							</li>

							<li>
								<a href="<?= base_url() ?>dimension/additional_report/<?= strtr($this->encryption->encrypt(4), '+=/', '.-~') ?>"><i class="fas fa-caret-right"></i> &nbsp; Borescope Survey Reports</a>
							</li>

							<li>
								<a href="<?= base_url() ?>dimension/additional_report/<?= strtr($this->encryption->encrypt(5), '+=/', '.-~') ?>"><i class="fas fa-caret-right"></i> &nbsp; Thickness Gauge Reports</a>
							</li>

						</ul>
					<?php } ?>
				<?php endif; ?>
			</li>

			<?php
				$list_menu = [
					1 => "Correction Of Distortion",
					2 => "Excavation",
					3 => "Buttering",
					0 => "Hardness Testing",
					4 => "Borescope Reports",
					5 => "Thickness Gauge Reports",
				];
				foreach ($list_menu as $key => $value):
					$collapse = 'collapse';
					$collapsed = 'collapsed';
					if($type_of_report == $key){
						$collapse = '';
						$collapsed = '';
					}
			?>
			<li>
				<a href="#dimensioncontrol_menu_<?= $key ?>" data-parent="#sidebar" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle <?= $collapsed ?>">
					<i class="fas fa-cube"></i> &nbsp; <?= $value ?>
				</a>
				<ul class="list-unstyled <?= $collapse ?>" id="dimensioncontrol_menu_<?= $key ?>">
					<li>
						<a href="<?= base_url() ?>dimension/add_additional/<?= strtr($this->encryption->encrypt($key), '+=/', '.-~') ?>"><i class="fas fa-plus"></i> &nbsp; Add New</a>
					</li>
					<li>
						<a href="<?= base_url() ?>dimension/additional_report/<?= strtr($this->encryption->encrypt($key), '+=/', '.-~') ?>"><i class="fas fa-caret-right"></i> &nbsp; List</a>
					</li>
				</ul>
			</li>
			<?php endforeach; ?>
		</ul>
	</nav>