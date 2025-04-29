<?php
	$allowed_dashboard = [];
	$project = $this->user_cookie[10];
	if(@$get['project'] != ''){
		$project = $get['project'];
		unset($get['project']);
	}
	$company = $this->user_cookie[11];
	if(@$get['company'] != ''){
		$company = $get['company'];
		unset($get['company']);
	}
	$get_link = "";
	foreach ($get as $key => $value) {
		$get_link .= "&".$key."=".$value;
	}
?>

<div class='float-right'>  
	<select class='form-control form-control-sm select2' id='company_dashboard' onchange='change_company_dashboard(this)'>
		<?php foreach ($company_list as $key => $value): ?>
			<option value="<?= $value['id_company'] ?>" <?= ($company == $value['id_company'] ? 'selected' : '') ?>><?= $value['company_name'] ?></option>
		<?php endforeach; ?>
	</select>
</div>
<div class='float-right'>
	<select class='form-control form-control-sm select2' id='project_dashboard' onchange='change_project_dashboard(this)'>
		<?php foreach ($project_list as $key => $value): ?>
			<option value="<?= $value['id'] ?>" <?= ($project == $value['id'] ? 'selected' : '') ?>><?= $value['project_name'] ?></option>
		<?php endforeach; ?>
	</select>
</div>
<script>
	function change_company_dashboard(input) {
		var get_project_data =  $('#project_dashboard').find(":selected").val();
		window.location = "<?= base_url($_SERVER['PATH_INFO']) ?>?project="+get_project_data+"&company="+$(input).val()+"<?= $get_link ?>";
	}
	function change_project_dashboard(input) {
		var get_company_data =  $('#company_dashboard').find(":selected").val();
		window.location = "<?= base_url($_SERVER['PATH_INFO']) ?>?company="+get_company_data+"&project="+$(input).val()+"<?= $get_link ?>";
	}
</script>

<style>
	.nav-pills .nav-link {
		color: #000;
		border-bottom: 2px solid #007bff;
		border-radius: 0px;
		min-width: 200px;
		text-align: center;
		box-shadow: inset 0 0 0 0 #007bff;
		-webkit-transition: ease-out 0.2s;
		-moz-transition: ease-out 0.2s;
		transition: ease-out 0.2s;
		font-size: 0.7rem;
	}
	.nav-pills .nav-link:hover {
		color: #fff;
		box-shadow: inset 0 -100px 0 0 #007bff;
	}
	.nav-pills .nav-link.active,
	.nav-pills .show>.nav-link {
		color: #fff;
		background: #007bff;
		border-bottom: 2px solid #007bff;
		border-radius: 0px;
	}

	.nav-pills.min-width-100 .nav-link {
		min-width: 100px;
	}
</style>
<ul class="nav nav-pills justify-content-center font-weight-bold" id="myTab" role="tablist">
	<?php if ($this->permission_cookie[161] == 1): ?>
		<?php
			$allowed_dashboard[] = 'home/home_dashboard';	
		?>
		<li class="nav-item">
			<a class="nav-link <?php ($active == 'menu1' ? 'active' : '') ?>"  href="<?= base_url() ?>home/home_dashboard?project=<?= $project ?>&company=<?= $company ?>">FABRICATION</a>
		</li>
	<?php endif; ?>
	<?php if ($this->permission_cookie[162] == 1): ?>
		<?php
			$allowed_dashboard[] = 'home/home_dashboard_rate';	
		?>
		<li class="nav-item">
			<a class="nav-link <?php ($active == 'menu2' ? 'active' : '') ?>"  href="<?= base_url() ?>home/home_dashboard_rate?project=<?= $project ?>&company=<?= $company ?>">WELDING & NDT</a>
		</li>
	<?php endif; ?>
	<?php if ($this->permission_cookie[163] == 1): ?>
		<?php
			// 	$allowed_dashboard[] = 'home/dashboard_sector_location';	
		?>
		<!-- <li class="nav-item">
			<a class="nav-link <?php ($active == 'menu3' ? 'active' : '') ?>"  href="<?= base_url() ?>home/dashboard_sector_location?project=<?= $project ?>">SECTOR & LOCATION</a>
		</li> -->
	<?php endif; ?>
	<?php if ($this->permission_cookie[186] == 1): ?>
		<?php
			$allowed_dashboard[] = 'home/dashboard_production';	
		?>
		<li class="nav-item">
			<a class="nav-link <?php ($active == 'menu4' ? 'active' : '') ?>"  href="<?= base_url() ?>home/dashboard_production?project=<?= $project ?>&company=<?= $company ?>">WORKPACK PRODUCTION</a>
		</li>
	<?php endif; ?>
	<?php if ($this->permission_cookie[164] == 1): ?>
		<?php
			$allowed_dashboard[] = 'home/dashboard_monitoring_data';	
		?>
		<li class="nav-item">
			<a class="nav-link <?php ($active == 'menu99' ? 'active' : '') ?>"  href="<?= base_url() ?>home/dashboard_monitoring_data?project=<?= $project ?>&company=<?= $company ?>">KPI</a>
		</li>
	<?php endif; ?>
</ul>
	<?php
	$current_link = $_SERVER['PATH_INFO'];
	$current_link = explode("/", $current_link);
	$current_link = $current_link[2];

	$is_inarray = false;
	foreach ($allowed_dashboard as $value) {
		$link = explode("/", '/'.$value);
		$link = $link[2];
		if($current_link == $link){
			$is_inarray = true;
		}
	}
	if (!$is_inarray) {
		if (count($allowed_dashboard) > 0) {
			redirect($allowed_dashboard[0]);
		} elseif ($_SERVER['PATH_INFO'] != '/' . 'home/home_dashboard_welcome') {
			// redirect('home/home_dashboard_welcome');
		}
	}
?>