<?php
  function createspace($num = 0){
    for ($i=0; $i < $num; $i++) { 
      echo "&nbsp;";
    }
  }
  
  $total_weight = 0;
  $num_piecemark = 0;
  if($workpack['phase'] == "PF"){
    $piecemark_list = $template_list;
  }
  foreach ($piecemark_list as $key => $value){
    $num_piecemark++;
    $total_weight += $value['weight'];
  }

	$receiver_workpack = '';
	foreach ($workpack_pic_history_list ?? [] as $subactivity_list) {
		if(isset($subactivity_list[0]) && $receiver_workpack == ''){
			$receiver_workpack = $subactivity_list[0];
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $meta_title ?></title>
</head>
<style type="text/css">
  @page {
    margin: 2.87cm 0.75cm 0.75cm 0.75cm;
  }

  header {
    position: fixed;
    top: -1.87cm;
    left: 0px;
    right: 0px;
  }

  body {
    margin: 0px;
    font-size: 10px;
  }

  .page_break { 
    page-break-before: always;
  }
  .page_break_element { 
    page-break-inside: avoid;
  }

  table{
    width: 100%;
  }
  .table-bordered > tbody > tr > td{
    border: 1px solid #000;
  }
  .td-valign-top > tbody > tr > td {
    vertical-align: top;
  }
  .td-signature-pic{
    overflow: visible;
    height: 100px;
  }
  .width-25{
    width: 25%;
  }
  .width-10{
    width: 10%;
  }

  .valign-middle {
    vertical-align: middle !important;
  }

  .text-center {
    text-align: center;
  }
  .text-right {
    text-align: right;
  }
  .text-left {
    text-align: left;
  }
  .text-bold{
    font-weight: bold;
  }
  .auto-fit{
    width: 1% !important;
    white-space: nowrap;
  }

  .m-0{
    margin: 0px;
  }
  .p-0{
    padding: 0px;
  }
  .px-1{
    padding-right: .25rem;
    padding-left: .25rem;
  }
  .px-2{
    padding-right: .5rem;
    padding-left: .5rem;
  }
  .px-3{
    padding-right: 1rem;
    padding-left: 1rem;
  }
  .px-4{
    padding-right: 1.5rem;
    padding-left: 1.5rem;
  }
  .pr-1{
    padding-right: .25rem;
  }
  .pr-2{
    padding-right: .5rem;
  }
  .pr-3{
    padding-right: 1rem;
  }
  .pr-4{
    padding-right: 1.5rem;
  }
  .pl-1{
    padding-left: .25rem;
  }
  .pl-2{
    padding-left: .5rem;
  }
  .pl-3{
    padding-left: 1rem;
  }
  .pl-4{
    padding-left: 1.5rem;
  }

  .b{
    border: 1px solid #000;
  }
  .by{
    border-top: 1px solid #000;
    border-bottom: 1px solid #000;
  }
  .bx{
    border-left: 1px solid #000;
    border-right: 1px solid #000;
  }
  .bl{
    border-left: 1px solid #000;
  }
  .br{
    border-right: 1px solid #000;
  }
  .bt{
    border-top: 1px solid #000;
  }
  .bb{
    border-bottom: 1px solid #000;
  }
  .nb{
    border: none !important;
  }
  .nby{
    border-top: none !important;
    border-bottom: none !important;
  }
  .nbx{
    border-left: none !important;;
    border-right: none !important;;
  }
  .nbl{
    border-left: none !important;;
  }
  .nbr{
    border-right: none !important;;
  }
  .nbb{
    border-bottom: none !important;;
  }
  .nbt{
    border-top: none !important;;
  }

  .column{
    column-count: 2!important;
    column-gap: 10px!important;
  }

  h1, h2, h3, h4, h5, h6{
    margin: 0;
  }
  input{
    margin : 0px;
    padding: 0px;
  }
	.qrcode{
		vertical-align: middle !important;
		padding: 0.5px;
	}
	.qrcode-image{
		width: 2.7cm;
	}
</style>
<body>
  <header>
    <table width="100%" class="table-bordered text-center" cellspacing="0" cellpadding="10">
      <tr>
        <td width="15%;"><img src="<?= $project_list[$workpack['project']]['client_logo'] ?>" style='height: 50px;' /></td>
        <td><h1><?= $project_list[$workpack['project']]['description'] ?></h1></td>
        <td width="15%;"><img src="img/seatrium_logo_bg_white.png" style='height: 50px;' /></td>
      </tr>
    </table>
  </header>
  <table width="100%" class="table-bordered text-center td-valign-top" cellspacing="0" cellpadding="0">
    <tr>
      <td width="50%">
        <table width="100%" class="text-center td-valign-top" cellspacing="0" cellpadding="2">
          <tr>
            <td class='bb text-left text-bold' colspan="3">WORK DESCRIPTION</td>
          </tr>
          <tr>
            <td class="auto-fit text-left text-bold">Work Pack Number</td>
            <td class="auto-fit text-left px-2"> : </td>
            <td class="text-left"><?php echo $workpack['workpack_no'] ?></td>
          </tr>
          <tr>
            <td class="auto-fit text-left text-bold">Workpack Rev. No.</td>
            <td class="auto-fit text-left px-2"> : </td>
            <td class="text-left"><?php echo $workpack['workpack_rev_no'] ?></td>
          </tr>
          <tr>
            <td class="auto-fit text-bold text-left">Workpack Description</td>
            <td class="auto-fit text-left px-2"> : </td>
            <td class="text-left"><?php echo $workpack['description'] ?></td>
          </tr>
          <tr>
            <td class="auto-fit text-bold text-left">Job No.</td>
            <td class="auto-fit text-left px-2"> : </td>
            <td class="text-left"><?php echo $workpack['job_no'] ?></td>
          </tr>
          <tr>
            <td class="auto-fit text-bold text-left">Job Description</td>
            <td class="auto-fit text-left px-2"> : </td>
            <td class="text-left"><?php echo join(", ", explode(";", $workpack['job_description'])) ?></td>
          </tr>
          <?php if($workpack['discipline'] == 1): ?>
            <tr>
              <td class="auto-fit text-bold text-left">Test Pack No</td>
              <td class="auto-fit text-left px-2"> : </td>
              <td class="text-left"><?php echo $workpack['test_pack_no'] ?></td>
            </tr>
            <tr>
              <td class="auto-fit text-bold text-left">Piping Testing Category</td>
              <td class="auto-fit text-left px-2"> : </td>
              <td class="text-left"><?php echo @$piping_testing_category_list[$workpack['piping_testing_category']]['name'] ?></td>
            </tr>
          <?php endif ?>
        </table>
      </td>
      <td width="50%">
        <table width="100%" class="text-center td-valign-top" cellspacing="0" cellpadding="2">
          <tr>
            <td class='bb text-left text-bold' colspan="4">WORK DATE</td>
          </tr>
          <tr>
            <td class="auto-fit text-left text-bold">Plan Start Date</td>
            <td class="auto-fit text-left px-2"> : </td>
            <td class="text-left"><?php echo ($workpack['plan_start_date'] == "" ? "" : date("D, d M Y", strtotime($workpack['plan_start_date']))) ?></td>
            <td class="auto-fit qrcode" rowspan="6"><img class="qrcode-image" src="data:image/png;base64,<?= $qrcode ?>" /></td>
          </tr>
          <tr>
            <td class="auto-fit text-bold text-left">Plan Finish Date</td>
            <td class="auto-fit text-left px-2"> : </td>
            <td class="text-left"><?php echo ($workpack['plan_finish_date'] == "" ? "" : date("D, d M Y", strtotime($workpack['plan_finish_date']))) ?></td>
          </tr>
          <tr>
            <td class="auto-fit text-bold text-left">Duration</td>
            <td class="auto-fit text-left px-2"> : </td>
            <td class="text-left"><?php echo (date_diff(date_create($workpack['plan_start_date']), date_create($workpack['plan_finish_date']))->format("%a")) + 1; ?> Days</td>
          </tr>
          <tr>
            <td class="auto-fit text-bold text-left">Actual Start Date</td>
            <td class="auto-fit text-left px-2"> : </td>
            <td class="text-left">-</td>
          </tr>
          <tr>
            <td class="auto-fit text-bold text-left">Actual Finish Date</td>
            <td class="auto-fit text-left px-2"> : </td>
            <td class="text-left">-</td>
          </tr>
          <tr>
            <td class="auto-fit text-bold text-left">Issued Date</td>
            <td class="auto-fit text-left px-2"> : </td>
            <td class="text-left"><?php echo ($workpack['issued_date'] == "" ? "" : date("D, d M Y", strtotime($workpack['issued_date']))) ?></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <table width="100%" class="table-bordered text-center td-valign-top" cellspacing="0" cellpadding="0">
    <tr>
      <td>
        <table width="100%" class="text-center td-valign-top" cellspacing="0" cellpadding="2">
          <tr>
            <td class="bb text-left text-bold" colspan="3">WORK CAPACITY </td>
          </tr>
          <tr>
            <td class="auto-fit text-left text-bold">SITE / WORK SHOP</td>
            <td class="auto-fit text-left px-2"> : </td>
            <td class="text-left"><?php echo ($workpack['location_v2'] != 0 ? @$area_v2_list[$location_v2_list[$workpack['location_v2']]['id_area']]['name'].', '.@$location_v2_list[$workpack['location_v2']]['name'] : @$location_list[$workpack['location']]['location_name']) ?></td>
          </tr>
          <tr>
            <td class="auto-fit text-left text-bold">Module</td>
            <td class="auto-fit text-left px-2"> : </td>
            <td class="text-left"><?php echo @$module_list[$workpack['module']]['mod_desc'] ?></td>
          </tr>
          <tr>
            <td class="auto-fit text-left text-bold">Total Weight</td>
            <td class="auto-fit text-left px-2"> : </td>
            <td class="text-left"><?php echo $total_weight ?> KG</td>
          </tr>
          <tr>
            <td class="auto-fit text-left text-bold">Total Piecemark</td>
            <td class="auto-fit text-left px-2"> : </td>
            <td class="text-left"><?php echo $num_piecemark ?> PCS</td>
          </tr>
          <tr>
            <td class="auto-fit text-left text-bold">Budget manhours</td>
            <td class="auto-fit text-left px-2"> : </td>
            <td class="text-left"><?php echo $workpack['budget_manhours'] ?> MHRS</td>
          </tr>
        </table>
      </td>
      <td width="50%" rowspan="2">
        <table width="100%" class="table-bordered text-center td-valign-top" cellspacing="0" cellpadding="2">
          <tr>
            <td class="bb text-left text-bold" colspan="3">REFERENCE DOCUMENT </td>
          </tr>
					<tr>
            <td class="text-bold">No</td>
						<td class="text-bold">Drawing No</td>
            <td class="text-bold">Rev.</td>
          </tr>
          <?php foreach ($reference_doc as $key => $value): ?>
          <tr>
            <td><?php echo ($key+1) ?></td>
            <td><?php echo $value['document_no'] ?></td>
            <td><?php echo $value['rev_no'] ?></td>
          </tr>
          <?php endforeach; ?>
        </table>
      </td>
    </tr>
    <tr>
      <td>
        <table width="100%" class="table-bordered text-center td-valign-top" cellspacing="0" cellpadding="2">
          <tr>
            <td class="bb text-left text-bold" colspan="6">MANPOWER BUDGET  </td>
          </tr>
          <tr>
            <td class="text-bold">No</td>
            <td class="text-bold">Trade</td>
            <td class="text-bold">Total Manpower</td>
            <td class="text-bold">Days</td>
            <td class="text-bold">Man Hours</td>
            <td class="text-bold">Total Manhours</td>
          </tr>
          <?php 
						$total = 0;					
						foreach ($budget_manhours_list as $key => $value): 
							$total_manhours = ($value['manpower']*$value['day']*$value['manhours']);
							$total += $total_manhours;
					?>
          <tr>
            <td><?php echo $key+1 ?></td>
            <td><?php echo $workpack_section[$value['name']]['name'] ?></td>
            <td><?php echo $value['manpower'] ?></td>
            <td><?php echo $value['day'] ?></td>
            <td><?php echo $value['manhours'] ?></td>
            <td><?php echo $total_manhours ?></td>
          </tr>
          <?php endforeach; ?>
					<tr>
            <td colspan='5'><b>Total Manhours</b></td>
            <td><?php echo $total ?></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <br>
	<table width="100%" class="table-bordered text-center" cellspacing="0" cellpadding="2">
    <tr>
      <td class="auto-fit px-2 text-bold py-3">No</td>
      <td class="text-bold py-3">Name</td>
      <td class="text-bold py-3">Badge ID</td>
      <td class="text-bold py-3">Activity</td>
      <td class="auto-fit px-2 text-bold py-3">Days</td>
      <td class="auto-fit px-2 text-bold py-3">Manhours</td>
      <td class="auto-fit px-2 text-bold py-3">Total<br>Manhours</td>
      <td class="auto-fit px-2 text-bold py-3">No</td>
      <td class="text-bold py-3">Name</td>
      <td class="text-bold py-3">Badge ID</td>
      <td class="text-bold py-3">Activity</td>
      <td class="auto-fit px-2 text-bold py-3">Days</td>
      <td class="auto-fit px-2 text-bold py-3">Manhours</td>
      <td class="auto-fit px-2 text-bold py-3">Total<br>Manhours</td>
    </tr>
    <?php for ($i=0; $i < 10; $i++) : ?>
    <tr>
			<td><?= ($i+1) ?></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td><?= ($i+11) ?></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <?php endfor; ?>
  </table>
  <br>
  <table width="100%" class="table-bordered text-center td-valign-top" cellspacing="0" cellpadding="2">
    <tr>
      <td class="text-bold py-3">NO</td>
      <td class="text-bold py-3">DRAWING AS</td>
      <td class="text-bold py-3">UNIQUE NO</td>
      <td class="text-bold py-3">PIECE MARK</td>
      <td class="text-bold py-3">GRADE</td>
      <td class="text-bold py-3">PAINT SYSTEM</td>
      <td class="text-bold py-3">PROFILE</td>
      <td class="text-bold py-3">QTY</td>
      <td class="text-bold py-3">AREA (M2)</td>
      <td class="text-bold py-3">REMARKS</td>
    </tr>
		
		<?php
		$no = 0;
		foreach ($show_data_irn_list as $key => $value) { ?>

			<?php

			if (isset($value['drawing_as']) && !empty($value['drawing_as'])) {
				$weldmap_material = substr($value['drawing_as'], -13);
			} else {
				$weldmap_material = substr($value['drawing_ga'], -20);
			}

			if (isset($warehouse_mis_mrir[$status_piecemark[$value['part_id']]['id_mis']]['unique_ident_no'])) {
				$uniq_no_p1 = $warehouse_mis_mrir[$status_piecemark[$value['part_id']]['id_mis']]['unique_ident_no'];
			} else {
				$uniq_no_p1 = "-";
			}

			if ($uniq_no_p1 != "-") {
				if (isset($list_unique_data[$uniq_no_p1])) {
					$list_of_attachment = array();
					foreach ($list_unique_data[$uniq_no_p1] as $key => $vx) {
						$list_of_attachment[] = "<a target='_blank' href='https://www.smoebatam.com/warehouse_ori/file/mrir/cm/" . $vx["document_file"] . "'  style='display: inline-block !important;'>" . $vx["document_name"] . "</a>";
					}
					$show_attachment = implode("<br/><br/>", $list_of_attachment);
				} else {
					$show_attachment = "-";
				}
			} else {
				$show_attachment = "-";
			}

			if (isset($status_piecemark[$value['part_id']]['profile'])) {
				$profile_p1 = $status_piecemark[$value['part_id']]['profile'];
			} else {
				$profile_p1 = "-";
			}

			if (isset($status_piecemark[$value['part_id']]['diameter'])) {
				$diameter_p1 = $status_piecemark[$value['part_id']]['diameter'];
			} else {
				$diameter_p1 = "-";
			}

			if (isset($status_piecemark[$value['part_id']]['length'])) {
				$length_p1 = $status_piecemark[$value['part_id']]['length'];
			} else {
				$length_p1 = "-";
			}

			if (isset($status_piecemark[$value['part_id']]['area'])) {
				$area_p1 = $status_piecemark[$value['part_id']]['area'];
			} else {
				$area_p1 = "-";
			}

			if (isset($status_piecemark[$value['part_id']]['can_number'])) {
				$can_number = $status_piecemark[$value['part_id']]['can_number'];
			} else {
				$can_number = "-";
			}

			if (isset($status_piecemark[$value['part_id']]['thickness'])) {
				$thickness_p1 = $status_piecemark[$value['part_id']]['thickness'];
			} else {
				$thickness_p1 = "-";
			}

			$project_id               = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['project_code']), '+=/', '.-~');
			$discipline               = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['discipline']), '+=/', '.-~');
			$type_of_module           = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['type_of_module']), '+=/', '.-~');
			$module                   = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['module']), '+=/', '.-~');
			$report_no                = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['report_number']), '+=/', '.-~');
			$report_no_rev            = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['report_no_rev']), '+=/', '.-~');
			$submission_id            = strtr($this->encryption->encrypt($status_piecemark[$value['part_id']]['submission_id']), '+=/', '.-~');

			if (isset($status_piecemark[$value['part_id']]['status_inspection'])) {
				if ($status_piecemark[$value['part_id']]['status_inspection'] >= 3) {
					if (isset($status_piecemark[$value['part_id']]['report_number'])) {
						$status_inspection_p1 = '<a target="_blank" href="' . base_url() . 'material_verification/material_verification_pdf_client/' . $project_id . '/' . $discipline . '/' . $type_of_module . '/' . $module . '/' . $report_no . '/' . $report_no_rev . '">COMPLETED</a>';
					} else {
						$status_inspection_p1 = '<a target="_blank" href="' . base_url() . 'material_verification/material_verification_pdf/' . $submission_id . '">COMPLETED</a>';
					}
				} else {
					$status_inspection_p1 = 'OS';
				}
			} else {
				$status_inspection_p1 = "-";
			}

			$status_fitup = "-";
			$status_visual = "-";
			$status_MT_show = "-";
			$status_PT_show = "-";
			$status_UT_show = "-";
			$status_RT_show = "-";


			$paint_system_id = array();
			if ($workpack["categories_irn"] == 1) {
				foreach ($paint_system_capture[$value["wp_detail_id"]] as $keyc => $valxc) {
					$paint_system_id[] = $valxc;
					//echo $paint_system[$valxc]["code"]."<br/>";
				}
			} else if ($workpack["categories_irn"] == 0) {
				if (isset($paint_system_capture_joint[$workpack["id"]][$value["id"]])) {
					foreach ($paint_system_capture_joint[$workpack["id"]][$value["id"]] as $keyc => $valxc) {
						$paint_system_id[] = $valxc;
						//echo $paint_system[$valxc]["code"]."<br/>";
					}
				}
			}

			if (sizeof($paint_system_id) > 0) {
				$arra_uniquexx = array_unique($paint_system_id);
			}

			if (!in_array(9999, $arra_uniquexx)) {

			?>
				<tr>
					<td><?php echo $no + 1; ?></td>
					<td><?= $value['drawing_as'] ?></td>
					<td><?= $uniq_no_p1 ?> </td>
					<td><?= $value['part_id'] ?></td>
					<!-- <td><?= $value['can_number'] ?></td> -->
					<td><?= $material_grade_list[$value['grade']]['material_grade'] ?></td>
					<td>
						<?php
						if (sizeof($paint_system_id) > 0) {
							$arra_unique = array_unique($paint_system_id);
							foreach ($arra_unique as $valz) {
								echo $paint_system[$valz]["code"] . "<br/>";
							}
						}
						?>
					</td>
					<td><?= $profile_p1 ?></td>
					<td>1</td>
					<td><?= $value['area'] ?> </td>
					<td><?php echo (isset($data_paint_system[$workpack["id"]][$value["id"]]["remarks"]) ? $data_paint_system[$workpack["id"]][$value["id"]]["remarks"] : "--") ?></td>
				</tr>

		<?php $no++;
			}
		} ?>
  </table>

  <br>
	<table width="100%" class="table-bordered td-valign-top" cellspacing="0" cellpadding="2">
    <tr>
      <td class="auto-fit px-2 text-bold py-3">
				Remarks Status/Reason of Delay :
				<br>
				<br>
				<br>
				<br>
				<br>
			</td>
    </tr>
  </table>
  
  <div class="page_break_element">
    <br>
    <br>
		<?php if($workpack['type'] == 1): ?>
    <table width="100%" class="" cellspacing="0" cellpadding="2">
			<tr>
        <td colspan="7" class="text-bold">
					Workpack Issue
        </td>
      </tr>
      <tr>
        <td class="td-signature-pic width-25 text-center">
          <?php if($workpack['submitted_date']): ?>
            <img width='150px;' style="align-items: center !important;" src="data:image/png;base64, <?= $user_list[$workpack['submitted_by']]['sign_approval'] ?>">
          <?php endif; ?>
        </td>
        <td class="width-10"></td>
        <td class="td-signature-pic width-25 text-center">
          <?php if($workpack['approval_date']): ?>
            <img width='150px;' style="align-items: center !important;" src="data:image/png;base64, <?= $user_list[$workpack['approval_by']]['sign_approval'] ?>">
          <?php endif; ?>
				</td>
        <td class="width-10"></td>
        <td class="td-signature-pic width-25 text-center">
          <?php if($workpack['superintendent_date']): ?>
            <img width='150px;' style="align-items: center !important;" src="data:image/png;base64, <?= $user_list[$workpack['superintendent_by']]['sign_approval'] ?>">
          <?php endif; ?>
				</td>
        <td class="width-10"></td>
        <td class="td-signature-pic width-25 text-center">
          <?php if(@$receiver_workpack['start_date']): ?>
            <img width='150px;' style="align-items: center !important;" src="data:image/png;base64, <?= $user_list[$receiver_workpack['pic']]['sign_approval'] ?>">
          <?php endif; ?>
				</td>
      </tr>
      <tr>
        <td class="bb" style="font-size: 12px"><?= @$user_list[$workpack['submitted_by']]['full_name'] ?></td>
        <td></td>
        <td class="bb" style="font-size: 12px"><?= @$user_list[$workpack['approval_by']]['full_name'] ?></td>
        <td></td>
        <td class="bb" style="font-size: 12px"><?= @$user_list[$workpack['superintendent_by']]['full_name'] ?></td>
        <td></td>
        <td class="bb" style="font-size: 12px"><?= @$user_list[$receiver_workpack['pic']]['full_name'] ?></td>
      </tr>
      <tr>
        <td style="white-space: nowrap;"><b>WORKPACK COORDINATOR</b></td>
        <td></td>
        <td style="white-space: nowrap;"><b>PROJECT ENG./CONSTRUCTION ENG.</b></td>
        <td></td>
        <td style="white-space: nowrap;"><b>CONSTRUCTION SUPERINTENDENT</b></td>
        <td></td>
        <td style="white-space: nowrap;"><b>RECEIVER </b></td>
      </tr>
      <tr>
        <td>Date: <?= $workpack['submitted_date'] ? @date('d F Y', strtotime($workpack['submitted_date'])) : '' ?></td>
        <td></td>
        <td>Date: <?= $workpack['approval_date'] ? @date('d F Y', strtotime($workpack['approval_date'])) : '' ?></td>
        <td></td>
        <td>Date: <?= $workpack['superintendent_date'] ? @date('d F Y', strtotime($workpack['superintendent_date'])) : '' ?></td>
        <td></td>
        <td>Date: <?= @$receiver_workpack['start_date'] ? @date('d F Y', strtotime($receiver_workpack['start_date'])) : '' ?></td>
      </tr>
			<tr>
        <td colspan="7" class="text-bold">
					<br>
					<br>
					Workpack Return
        </td>
      </tr>
      <tr>
        <td class="td-signature-pic width-25 text-center">
          <?php if($workpack['return_coor_date']): ?>
            <img width='150px;' style="align-items: center !important;" src="data:image/png;base64, <?= @$user_list[$workpack['return_coor_by']]['sign_approval'] ?>">
          <?php endif; ?>
        </td>
        <td class="width-10"></td>
        <td class="td-signature-pic width-25 text-center">
          <?php if($workpack['return_cons_date']): ?>
            <img width='150px;' style="align-items: center !important;" src="data:image/png;base64, <?= @$user_list[$workpack['return_cons_by']]['sign_approval'] ?>">
          <?php endif; ?>
				</td>
        <td class="width-10"></td>
        <td class="td-signature-pic width-25 text-center">
          <?php if($workpack['return_superin_date']): ?>
            <img width='150px;' style="align-items: center !important;" src="data:image/png;base64, <?= @$user_list[$workpack['return_superin_by']]['sign_approval'] ?>">
          <?php endif; ?>
				</td>
        <td class="width-10"></td>
        <td class="td-signature-pic width-25 text-center">
				</td>
      </tr>
      <tr>
        <td class="bb" style="font-size: 12px"><?= @$user_list[$workpack['return_coor_by']]['full_name'] ?></td>
        <td></td>
        <td class="bb" style="font-size: 12px"><?= @$user_list[$workpack['return_cons_by']]['full_name'] ?></td>
        <td></td>
        <td class="bb" style="font-size: 12px"><?= @$user_list[$workpack['return_superin_by']]['full_name'] ?></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td style="white-space: nowrap;"><b>WORKPACK COORDINATOR</b></td>
        <td></td>
        <td style="white-space: nowrap;"><b>PROJECT ENG./CONSTRUCTION ENG.</b></td>
        <td></td>
        <td style="white-space: nowrap;"><b>CONSTRUCTION SUPERINTENDENT</b></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td>Date: <?= $workpack['return_coor_date'] ? @date('d F Y', strtotime($workpack['return_coor_date'])) : '' ?></td>
        <td></td>
        <td>Date: <?= $workpack['return_cons_date'] ? @date('d F Y', strtotime($workpack['return_cons_date'])) : '' ?></td>
        <td></td>
        <td>Date: <?= $workpack['return_superin_date'] ? @date('d F Y', strtotime($workpack['return_superin_date'])) : '' ?></td>
        <td></td>
        <td></td>
      </tr>
			
			<?php if(in_array($workpack['phase'], $this->phase_piecemark)): ?>
			<tr>
        <td colspan="7" class="text-bold">
					<br>
					<br>
					Workpack Handover From CNC
        </td>
      </tr>
      <tr>
        <td class="td-signature-pic width-25 text-center">
          <?php if($workpack['sender_cnc_date']): ?>
            <img width='150px;' style="align-items: center !important;" src="data:image/png;base64, <?= @$user_list[$workpack['sender_cnc_by']]['sign_approval'] ?>">
          <?php endif; ?>
        </td>
        <td class="width-10"></td>
        <td class="td-signature-pic width-25 text-center">
          <?php if($workpack['receiver_cnc_date']): ?>
            <img width='150px;' style="align-items: center !important;" src="data:image/png;base64, <?= @$user_list[$workpack['receiver_cnc_by']]['sign_approval'] ?>">
          <?php endif; ?>
				</td>
        <td class="width-10"></td>
        <td class="td-signature-pic width-25 text-center">
          <?php if($workpack['receiver_cnc_excess_date']): ?>
            <img width='150px;' style="align-items: center !important;" src="data:image/png;base64, <?= @$user_list[$workpack['receiver_cnc_excess_by']]['sign_approval'] ?>">
          <?php endif; ?>
				</td>
        <td class="width-10"></td>
        <td class="td-signature-pic width-25">
				</td>
      </tr>
      <tr>
        <td class="bb" style="font-size: 12px"><?= @$user_list[$workpack['sender_cnc_by']]['full_name'] ?></td>
        <td></td>
        <td class="bb" style="font-size: 12px"><?= @$user_list[$workpack['receiver_cnc_by']]['full_name'] ?></td>
        <td></td>
        <td class="bb" style="font-size: 12px"><?= @$user_list[$workpack['receiver_cnc_excess_by']]['full_name'] ?></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td style="white-space: nowrap;"><b>SENDER</b></td>
        <td></td>
        <td style="white-space: nowrap;"><b>RECEIVER PART ID</b></td>
        <td></td>
        <td style="white-space: nowrap;"><b>RECEIVER EXCESS MATERIAL</b></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td>Date: <?= $workpack['sender_cnc_date'] ? @date('d F Y', strtotime($workpack['sender_cnc_date'])) : '' ?></td>
        <td></td>
        <td>Date: <?= $workpack['receiver_cnc_date'] ? @date('d F Y', strtotime($workpack['receiver_cnc_date'])) : '' ?></td>
        <td></td>
        <td>Date: <?= $workpack['receiver_cnc_excess_date'] ? @date('d F Y', strtotime($workpack['receiver_cnc_excess_date'])) : '' ?></td>
        <td></td>
        <td></td>
      </tr>
			<?php endif; ?>

    </table>
		<?php elseif($workpack['type'] == 3): ?>
    <table width="100%" class="" cellspacing="0" cellpadding="2">
			<tr>
        <td colspan="7" class="text-bold">
					Work Order Issue
        </td>
      </tr>
      <tr>
        <td class="td-signature-pic width-25 text-center">
          <?php if($workpack['submitted_date']): ?>
            <img width='150px;' style="align-items: center !important;" src="data:image/png;base64, <?= $user_list[$workpack['submitted_by']]['sign_approval'] ?>">
          <?php endif; ?>
        </td>
        <td class="width-10"></td>
        <td class="td-signature-pic width-25 text-center">
          <?php if($workpack['approval_date']): ?>
            <img width='150px;' style="align-items: center !important;" src="data:image/png;base64, <?= $user_list[$workpack['approval_by']]['sign_approval'] ?>">
          <?php endif; ?>
				</td>
        <td class="width-10"></td>
        <td class="td-signature-pic width-25 text-center">
					<?php if(@$workpack['superintendent_assigned'] != ''): ?>
						<?php if($workpack['superintendent_date']): ?>
							<img width='150px;' style="align-items: center !important;" src="data:image/png;base64, <?= $user_list[$workpack['superintendent_by']]['sign_approval'] ?>">
						<?php endif; ?>
					<?php endif; ?>
				</td>
        <td class="width-10"></td>
        <td class="td-signature-pic width-25"></td>
      </tr>
      <tr>
        <td class="bb" style="font-size: 12px"><?= @$user_list[$workpack['submitted_by']]['full_name'] ?></td>
        <td></td>
        <td class="bb" style="font-size: 12px"><?= @$user_list[$workpack['approval_by']]['full_name'] ?></td>
        <td></td>
				<?php if(@$workpack['superintendent_assigned'] != ''): ?>
        	<td class="bb" style="font-size: 12px">
						<?= @$user_list[$workpack['superintendent_by']]['full_name'] ?>
					</td>
				<?php else: ?>
					<td></td>
				<?php endif; ?>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td style="white-space: nowrap;"><b>WORKPACK COORDINATOR</b></td>
        <td></td>
        <td style="white-space: nowrap;"><b>PROJECT ENG./CONSTRUCTION ENG.</b></td>
        <td></td>
        <td style="white-space: nowrap;">
					<?php if(@$workpack['superintendent_assigned'] != ''): ?>
						<b>CONSTRUCTION SUPERINTENDENT</b>
					<?php endif; ?>
				</td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td>Date: <?= $workpack['submitted_date'] ? @date('d F Y', strtotime($workpack['submitted_date'])) : '' ?></td>
        <td></td>
        <td>Date: <?= $workpack['approval_date'] ? @date('d F Y', strtotime($workpack['approval_date'])) : '' ?></td>
        <td></td>
        <td>
					<?php if(@$workpack['superintendent_assigned'] != ''): ?>
						Date: <?= $workpack['superintendent_date'] ? @date('d F Y', strtotime($workpack['superintendent_date'])) : '' ?>
					<?php endif; ?>
				</td>
        <td></td>
        <td></td>
      </tr>

    </table>
		<?php endif; ?>
  </div>
  
</body>
</html>