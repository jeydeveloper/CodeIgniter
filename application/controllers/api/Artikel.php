<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Artikel extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();

        $this->load->model('artikel_model');
    }

    function index_get() { //get data menu
        $id = $this->get('id');
        $search = $this->get('search');
        $columns = $this->get('columns');
        $start = !empty($this->get('start')) ? $this->get('start') : 0;
        $length = !empty($this->get('length')) ? $this->get('length') : 10;
        $arr = [
        	'no',
        	'artikel_name',
        	'artikel_content',
        	'artikel_image',
        	'artikel_publish',
        	'artikel_author',
        	'artikel_isactive',
        	'id_sub_menu',
        	'action',
        ];
        if (!empty($id)) {
        	$this->artikel_model->where('artikel_id = "'.$id.'"');
            $artikel = $this->artikel_model->get_row();
        } elseif (!empty($search['value'])) {
        	$all = $this->artikel_model->get_all();
        	foreach ($columns as $key => $value) {
        		if($value['searchable'] == 'true') {
        			$this->artikel_model->or_like($arr[$key], $search['value']);
        		}
        	}
        	$filtered = $this->artikel_model->get_all();
        	foreach ($columns as $key => $value) {
        		if($value['searchable'] == 'true') {
        			$this->artikel_model->or_like($arr[$key], $search['value']);
        		}
        	}
        	$this->artikel_model->set_limit($length, $start);
            $artikel = $this->artikel_model->get_all();
            $artikel = $this->getRowDatatable($artikel);
            $artikel = formatDatatable($artikel, $all, $filtered);
        } else {
            $all = $this->artikel_model->get_all();
        	$this->artikel_model->set_limit($length, $start);
            $artikel = $this->artikel_model->get_all();
            $artikel = $this->getRowDatatable($artikel);
            $artikel = formatDatatable($artikel, $all, $all);
        }
        $this->response($artikel, 200);
    }

    function index_post() { // post data menu
       	$data = array(
		   'artikel_name' => $this->post('artikel_name'),
		   'artikel_content' => $this->post('artikel_content'),
		   'artikel_image' => $this->post('artikel_image'),
		   'artikel_publish' => $this->post('artikel_publish'),
		   'artikel_author' => $this->post('artikel_author'),
		   'artikel_isactive' => $this->post('artikel_isactive'),
		   'id_sub_menu' => $this->post('id_sub_menu'),
		);
		$insert = $this->artikel_model->insert($data);
		if ($insert) {
		   $this->response(array('status' => 'success'), 200);
		} else {
		   $this->response(array('status' => 'fail', 502));
		}
   	}

   	function index_put() { // update data menu
		$id = $this->put('id');
		$data = array(
			'artikel_name' => $this->put('artikel_name'),
		   	'artikel_content' => $this->put('artikel_content'),
		   	'artikel_image' => $this->put('artikel_image'),
		   	'artikel_publish' => $this->put('artikel_publish'),
		    'artikel_author' => $this->put('artikel_author'),
		    'artikel_isactive' => $this->put('artikel_isactive'),
		    'id_sub_menu' => $this->put('id_sub_menu'),
		);
		$this->artikel_model->where('artikel_id = "'.$id.'"');
		$update = $this->artikel_model->update($data);
		if ($update) {
			$this->response(array('status' => 'success'), 200);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
 	}

	function index_delete() { // delete data menu
		$id = $this->delete('id');
		$this->artikel_model->where('artikel_id = "'.$id.'"');
		$delete = $this->artikel_model->delete();
		if ($delete) {
		    $this->response(array('status' => 'success'), 201);
		} else {
		    $this->response(array('status' => 'fail', 502));
		}
	}

	private function getRowDatatable($data = null) {
		$ret = [];
		$start = $this->get('start');
		foreach ($data as $key => $value) {
			$start += 1;
			$ret[$key] = [
				$start,
				$value->artikel_name,
				$value->artikel_content,
				$value->artikel_image,
				$value->artikel_publish,
				$value->artikel_author,
				$value->artikel_isactive,
				$value->id_sub_menu,
				'<a onclick="doFormEdit('.$value->artikel_id.');return false;" href="#" class="btn btn-xs btn-success">EDIT <i class="glyph-icon icon-pencil-square-o"></i></a> <a onclick="showModalBoxDelete('.$value->artikel_id.');return false;" href="#" class="btn btn-xs btn-danger">DELETE <i class="glyph-icon icon-close"></i></a>',
			];
		}
		return $ret;
	}

}

?>
