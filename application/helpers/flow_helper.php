<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	function update_progress_wp($data) {
		$CI =& get_instance();
		$CI->load->model('planning_mod');

		// EXAMPLE PARAMETER
		// $data = [
		// 	'id_workpack' => 1,
		// 	'id_template' => [1, 2, 4, 5, 6],
		// 	'progress' => 'progress_mv',
		// 	'percent_val' => 100,
		// ];

		$where = [
			'id_workpack' => $data['id_workpack'],
			'id_template IN ('.join(', ', $data['id_template']).')' => NULL,
		];
		$form_data[$data['progress']] = $data['percent_val'];

		// $CI->planning_mod->update_workpack_detail($form_data, $where);
		$datadb = $CI->planning_mod->workpack_detail_list(["id_workpack" => $data['id_workpack'], "status_delete" => 1, "status !=" => 3]);

		$detail_complete = [];
		$detail_inprogress = [];
		$detail_total = [];
		foreach ($datadb as $key => $value) {
			$detail_total[] = $value['id'];
			if ($data['progress'] == 'progress_mv') {
				if ($value['progress_mv'] == 100) {
					$detail_complete[] = $value['id'];
				} else {
					$detail_inprogress[] = $value['id'];
				}
			} else if ($data['progress'] == 'progress_baa') {
				if ($value['progress_baa'] == 100) {
					$detail_complete[] = $value['id'];
				} else {
					$detail_inprogress[] = $value['id'];
				}
			} else {
				if ($value['progress_fu'] == 100 && $value['progress_vt'] == 100) {
					$detail_complete[] = $value['id'];
				} else {
					$detail_inprogress[] = $value['id'];
				}
			}
		}
		if (count($detail_total) == count($detail_complete)) {
			$form_data = [
				"actual_finish_date" => date("Y-m-d"),
				"status" => 2,
			];
			// $CI->planning_mod->workpack_update_process_db($form_data, ["id" => $data['id_workpack']]);
		} else {
			$form_data = [
				"actual_finish_date" => NULL,
				"status" => 1,
			];
			// $CI->planning_mod->workpack_update_process_db($form_data, ["id" => $data['id_workpack']]);
		}

	}
?>