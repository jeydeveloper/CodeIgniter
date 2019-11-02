<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Menu extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();

        $this->load->model('menu_model');
    }

    function index_get() { //get data menu
        $id = $this->get('id');
        $search = $this->get('search');
        $columns = $this->get('columns');
        $start = !empty($this->get('start')) ? $this->get('start') : 0;
        $length = !empty($this->get('length')) ? $this->get('length') : 10;
        $arr = [
        	'no',
        	'nama_menu',
        	'style_menu',
        	'position_menu',
        	'action',
        ];
        if (!empty($id)) {
        	$this->menu_model->where('id_menu = "'.$id.'"');
            $menu = $this->menu_model->get_row();
        } elseif (!empty($search['value'])) {
        	$all = $this->menu_model->get_all();
        	foreach ($columns as $key => $value) {
        		if($value['searchable'] == 'true') {
        			$this->menu_model->or_like($arr[$key], $search['value']);
        		}
        	}
        	$this->menu_model->set_limit($length, $start);
            $menu = $this->menu_model->get_all();
            $menu = $this->getRowDatatable($menu);
            $menu = formatDatatable($menu, $all);
        } else {
            $all = $this->menu_model->get_all();
        	$this->menu_model->set_limit($length, $start);
            $menu = $this->menu_model->get_all();
            $menu = $this->getRowDatatable($menu);
            $menu = formatDatatable($menu, $all);
        }
        $this->response($menu, 200);
    }

    function index_post() { // post data menu
       	$data = array(
		   'nama_menu' => $this->post('nama_menu'),
		   'style_menu' => $this->post('style_menu'),
		   'position_menu' => $this->post('position_menu'),
		);
		$insert = $this->menu_model->insert($data);
		if ($insert) {
		   $this->response(array('status' => 'success'), 200);
		} else {
		   $this->response(array('status' => 'fail', 502));
		}
   	}

   	function index_put() { // update data menu
		$id = $this->put('id');
		$data = array(
			'nama_menu' => $this->put('nama_menu'),
		   	'style_menu' => $this->put('style_menu'),
		   	'position_menu' => $this->put('position_menu'),
		);
		$this->menu_model->where('id_menu = "'.$id.'"');
		$update = $this->menu_model->update($data);
		if ($update) {
			$this->response(array('status' => 'success'), 200);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
 	}

	function index_delete() { // delete data menu
		$id = $this->delete('id');
		$this->menu_model->where('id_menu = "'.$id.'"');
		$delete = $this->menu_model->delete();
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
				$value->nama_menu,
				$value->style_menu,
				$value->position_menu,
				'<a onclick="doFormEdit('.$value->id_menu.');return false;" href="#" class="btn btn-xs btn-success">EDIT <i class="glyph-icon icon-pencil-square-o"></i></a> <a onclick="showModalBoxDelete('.$value->id_menu.');return false;" href="#" class="btn btn-xs btn-danger">DELETE <i class="glyph-icon icon-close"></i></a>',
			];
		}
		return $ret;
	}

}

?>
