<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function formatDatatable($data = null, $all = null) {
	$ci = & get_instance();
	$draw = $ci->get('draw');
	if(empty($draw)) return $data;
	$tmp = [];
	if(!empty($data)) {
		$start = $ci->get('start');
		foreach ($data as $key => $value) {
			$start += 1;
			$tmp[$key] = [
				$start,
				$value->nama,
				$value->email,
				'<a onclick="doFormEdit('.$value->id.');return false;" href="#" class="btn btn-xs btn-success">EDIT <i class="glyph-icon icon-pencil-square-o"></i></a> <a onclick="showModalBoxDelete('.$value->id.');return false;" href="#" class="btn btn-xs btn-danger">DELETE <i class="glyph-icon icon-close"></i></a>',
			];
		}
	}
	$ret = [
		'data' => $tmp,
		'recordsTotal' => count($all),
		'recordsFiltered' => count($data),
		'draw' => (int)$draw,
	];
	return $ret;
}

?>