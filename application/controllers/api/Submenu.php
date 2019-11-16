<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Submenu extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();

        $this->load->model('submenu_model');
    }

    function index_get() { //get data menu
        $id = $this->get('id');
        $search = $this->get('search');
        $columns = $this->get('columns');
        $start = !empty($this->get('start')) ? $this->get('start') : 0;
        $length = !empty($this->get('length')) ? $this->get('length') : 10;
        $arr = [
        	'no',
        	'nama_sub_menu',
        	'id_menu',
        	'style_sub_menu',
        	'position_sub_menu',
        	'grup_sub_menu',
        	'link',
        	'action',
        ];
        if (!empty($id)) {
        	$this->submenu_model->where('id_sub_menu = "'.$id.'"');
            $menu = $this->submenu_model->get_row();
        } elseif (!empty($search['value'])) {
        	$all = $this->submenu_model->get_all();
        	foreach ($columns as $key => $value) {
        		if($value['searchable'] == 'true') {
        			$this->submenu_model->or_like($arr[$key], $search['value']);
        		}
        	}
        	$this->submenu_model->set_limit($length, $start);
            $menu = $this->submenu_model->get_all();
            $menu = $this->getRowDatatable($menu);
            $menu = formatDatatable($menu, $all);
        } else {
            $all = $this->submenu_model->get_all();
        	$this->submenu_model->set_limit($length, $start);
            $menu = $this->submenu_model->get_all();
            $menu = $this->getRowDatatable($menu);
            $menu = formatDatatable($menu, $all);
        }
        $this->response($menu, 200);
    }

    function index_post() { // post data menu
       	$data = array(
		   'nama_sub_menu' => $this->post('nama_sub_menu'),
		   'id_menu' => $this->post('id_menu'),
		   'style_sub_menu' => $this->post('style_sub_menu'),
		   'position_sub_menu' => $this->post('position_sub_menu'),
		   'grup_sub_menu' => $this->post('grup_sub_menu'),
		   'link' => $this->post('link'),
		);
		$insert = $this->submenu_model->insert($data);
		if ($insert) {
		   $this->response(array('status' => 'success'), 200);
		} else {
		   $this->response(array('status' => 'fail', 502));
		}
   	}

   	function index_put() { // update data menu
		$id = $this->put('id');
		$data = array(
			'nama_sub_menu' => $this->put('nama_sub_menu'),
		   	'id_menu' => $this->put('id_menu'),
		   	'style_sub_menu' => $this->put('style_sub_menu'),
		   	'position_sub_menu' => $this->put('position_sub_menu'),
		    'grup_sub_menu' => $this->put('grup_sub_menu'),
		    'link' => $this->put('link'),
		);
		$this->submenu_model->where('id_sub_menu = "'.$id.'"');
		$update = $this->submenu_model->update($data);
		if ($update) {
			$this->response(array('status' => 'success'), 200);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
 	}

	function index_delete() { // delete data menu
		$id = $this->delete('id');
		$this->submenu_model->where('id_sub_menu = "'.$id.'"');
		$delete = $this->submenu_model->delete();
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
				$value->nama_sub_menu,
				$value->id_menu,
				$value->style_sub_menu,
				$value->position_sub_menu,
				$value->grup_sub_menu,
				$value->link,
				'<a onclick="doFormEdit('.$value->id_sub_menu.');return false;" href="#" class="btn btn-xs btn-success">EDIT <i class="glyph-icon icon-pencil-square-o"></i></a> <a onclick="showModalBoxDelete('.$value->id_sub_menu.');return false;" href="#" class="btn btn-xs btn-danger">DELETE <i class="glyph-icon icon-close"></i></a>',
			];
		}
		return $ret;
	}

}

?>
