<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function formatDatatable($data = null, $all = null, $filtered = null) {
	$ci = & get_instance();
	$draw = $ci->get('draw');
	if(empty($draw)) return $data;
	$ret = [
		'data' => $data,
		'recordsTotal' => count($all),
		'recordsFiltered' => count($filtered),
		'draw' => (int)$draw,
	];
	return $ret;
}

?>