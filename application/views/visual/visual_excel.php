<?php 
	$no=1;
	error_reporting(0);
   	header("Content-type: application/vnd-ms-excel");
   	header("Content-Disposition: attachment; filename=Data_joint_visual_inspection.xls");
?>

<table width='100%' border='1px'>
	<tr>
		<th style="background: green; color: white"><b>S/N.</b></th>
		<th style="background: green; color: white"><b>Project</b></th>
		<th style="background: green; color: white"><b>Drawing No ( GA )</b></th>
		<th style="background: green; color: white"><b>Title</b></th>
		<th style="background: green; color: white"><b>Discipline</b></th>
		<th style="background: green; color: white"><b>Module</b></th>
		<!-- <th style="background: green; color: white"><b>Batch No</b></th> -->
		<th style="background: green; color: white"><b>Report No</b></th>
		<th style="background: green; color: white"><b>Joint Number</b></th>		
		<th style="background: green; color: white"><b>Weld Map Number</b></th>
		<th style="background: green; color: white"><b>Weld Map Revision</b></th>		
		<th style="background: green; color: white"><b>Weld Length</b></th>
		<th style="background: green; color: white"><b>Weld Type</b></th>
		<th style="background: green; color: white"><b>Joint Type</b></th>
		<th style="background: green; color: white"><b>WPS Group</b></th>
		<th style="background: green; color: white"><b>Cons/Lot No.</b></th>
		<th style="background: green; color: white"><b>Weld Process R/H</b></th>
		<th style="background: green; color: white"><b>Weld Process F/C</b></th>
		<th style="background: green; color: white"><b>Welder ID R/H</b></th>
		<th style="background: green; color: white"><b>Welder ID F/C</b></th>
		<th style="background: green; color: white"><b>Weld Date/Time</b></th>
		<th style="background: green; color: white"><b>Submited Date</b></th>
		<th style="background: green; color: white"><b>Status</b></th>		
		<th style="background: green; color: white"><b>Inspected By</b></th>
		<th style="background: green; color: white"><b>Inspected Date</b></th>
		<th style="background: green; color: white"><b>Remarks</b></th>
		<th style="background: green; color: white"><b>Area</b></th>
	</tr>
	<?php foreach ($export_visual as $value) { ?>
	<tr>
		<td><?= $no ?></td>
		<td><?= $master_project[$value['project']]['project_name'] ?></td>
		<td><?= $value['drawing_no'] ?></td>
		<td><?= $master_drawing[$value['drawing_no']]['title'] ?></td>
		<td><?= $master_discipline[$value['discipline']]['discipline_name'] ?></td>
		<td><?= $master_module[$value['module']]['mod_desc'].' ('.$master_type_of_module[$value['type_of_module']]['name'].')' ?></td>
		<td><?= $value['report_number'] ?></td>
		<td><?= $value['joint_no'].($value['revision']>0 ? '('.$value['revision_category'].$value['revision'].')' : '') ?></td>
		<td><?= $value['drawing_wm'] ?></td>
		<td><?= $value['rev_wm'] ?></td>
		<td><?= number_format($value['length_of_weld'], 2) ?></td>
		<td><?= $master_weld_type[$value['weld_type']]['weld_type'] ?></td>
		<td><?= $master_joint_type[$value['joint_type']]['joint_type'] ?></td>
		<td><?= $master_wps_group[$value['wps_group']]['wps_desc'] ?></td>
		<td><?= $value['cons_lot_no'] ?></td>

		<td>
			<?= isset($value['process_gtaw_rh']) ? 'GTAW<br>' : '' ?>
			<?= isset($value['process_gmaw_rh']) ? 'GMAW<br>' : '' ?>
			<?= isset($value['process_smaw_rh']) ? 'SMAW<br>' : '' ?>
			<?= isset($value['process_fcaw_rh']) ? 'FCAW<br>' : '' ?>
			<?= isset($value['process_saw_rh']) ? 'SAW<br>' : '' ?>
		</td>

		<td>
			<?= isset($value['process_gtaw_fc']) ? 'GTAW<br>' : '' ?>
			<?= isset($value['process_gmaw_fc']) ? 'GMAW<br>' : '' ?>
			<?= isset($value['process_smaw_fc']) ? 'SMAW<br>' : '' ?>
			<?= isset($value['process_fcaw_fc']) ? 'FCAW<br>' : '' ?>
			<?= isset($value['process_saw_fc']) ? 'SAW<br>' : '' ?>
		</td>

		<td>
			<?php 
				$welder_rh = explode(';', $value['welder_ref_rh']);
				foreach ($welder_rh as $key => $value_weld_rh) {
				 	echo $master_welder[$value_weld_rh]['wel_code'].'<br>';
				 } 
			?>
		</td>

		<td>
			<?php 
				$welder_fc = explode(';', $value['welder_ref_fc']);
				foreach ($welder_fc as $key => $value_weld_fc) {
				 	echo $master_welder[$value_weld_fc]['wel_code'].'<br>';
				 } 
			?>
		</td>

		<td><?= DATE('d F, Y', strtotime($value['weld_datetime'])) ?></td>
		<td><?= DATE('d F, Y', strtotime($value['date_request'])) ?></td>

		<td>
			<?php 
				if($value['status_inspection']==1){
					echo "Pending Approval";
				} elseif($value['status_inspection']==2){
					echo "Rejected";
				} elseif($value['status_inspection']==3){
					echo "Approved";
				} elseif($value['status_inspection']==4){
					echo "Pending by QC";
				} elseif($value['status_inspection']==5){
					echo "Transmitted";
				} 
			?>		
		</td>

		<td><?= $master_user[$value['inspection_by']]['full_name'] ?></td>
		<td><?= DATE('d F, Y', strtotime($value['inspection_datetime'])) ?></td>
		<td><?= $value['inspection_remarks'] ?></td>
		<td><?= $master_area[$value['area']]['area_name'] ?></td>
	</tr>
	<?php $no++;} ?>
</table>