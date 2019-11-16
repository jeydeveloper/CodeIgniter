<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Slide extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();

        $this->load->model('slide_model');
    }

    function index_get() { //get data menu
        $id = $this->get('id');
        $search = $this->get('search');
        $columns = $this->get('columns');
        $start = !empty($this->get('start')) ? $this->get('start') : 0;
        $length = !empty($this->get('length')) ? $this->get('length') : 10;
        $arr = [
        	'no',
        	'nama_slide',
        	'url_slide',
        	'mulai_slide',
        	'akhir_slide',
        	'isactive_slide',
        	'action',
        ];
        if (!empty($id)) {
        	$this->slide_model->where('id_slide = "'.$id.'"');
            $menu = $this->slide_model->get_row();
        } elseif (!empty($search['value'])) {
        	$all = $this->slide_model->get_all();
        	foreach ($columns as $key => $value) {
        		if($value['searchable'] == 'true') {
        			$this->slide_model->or_like($arr[$key], $search['value']);
        		}
        	}
        	$filtered = $this->slide_model->get_all();
        	foreach ($columns as $key => $value) {
        		if($value['searchable'] == 'true') {
        			$this->slide_model->or_like($arr[$key], $search['value']);
        		}
        	}
        	$this->slide_model->set_limit($length, $start);
            $menu = $this->slide_model->get_all();
            $menu = $this->getRowDatatable($menu);
            $menu = formatDatatable($menu, $all, $filtered);
        } else {
            $all = $this->slide_model->get_all();
        	$this->slide_model->set_limit($length, $start);
            $menu = $this->slide_model->get_all();
            $menu = $this->getRowDatatable($menu);
            $menu = formatDatatable($menu, $all, $all);
        }
        $this->response($menu, 200);
    }

    function index_post() { // post data menu
       	$data = array(
		   'nama_slide' => $this->post('nama_slide'),
		   'url_slide' => $this->post('url_slide'),
		   'mulai_slide' => $this->post('mulai_slide'),
		   'akhir_slide' => $this->post('akhir_slide'),
		   'isactive_slide' => $this->post('isactive_slide'),
		);
		$insert = $this->slide_model->insert($data);
		if ($insert) {
		   $this->response(array('status' => 'success'), 200);
		} else {
		   $this->response(array('status' => 'fail', 502));
		}
   	}

   	function index_put() { // update data menu
		$id = $this->put('id');
		$data = array(
			'nama_slide' => $this->put('nama_slide'),
		   	'url_slide' => $this->put('url_slide'),
		   	'mulai_slide' => $this->put('mulai_slide'),
		   	'akhir_slide' => $this->put('akhir_slide'),
		   	'isactive_slide' => $this->put('isactive_slide'),
		);
		$this->slide_model->where('id_slide = "'.$id.'"');
		$update = $this->slide_model->update($data);
		if ($update) {
			$this->response(array('status' => 'success'), 200);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
 	}

	function index_delete() { // delete data menu
		$id = $this->delete('id');
		$this->slide_model->where('id_slide = "'.$id.'"');
		$delete = $this->slide_model->delete();
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
				$value->nama_slide,
				$value->url_slide,
				$value->mulai_slide,
				$value->akhir_slide,
				$value->isactive_slide,
				'<a onclick="doFormEdit('.$value->id_slide.');return false;" href="#" class="btn btn-xs btn-success">EDIT <i class="glyph-icon icon-pencil-square-o"></i></a> <a onclick="showModalBoxDelete('.$value->id_slide.');return false;" href="#" class="btn btn-xs btn-danger">DELETE <i class="glyph-icon icon-close"></i></a>',
			];
		}
		return $ret;
	}

}

?>
