<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class User extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();

        $this->load->model('user_model');
    }

    function index_get() { //get data user
        $id = $this->get('id');
        $search = $this->get('search');
        $columns = $this->get('columns');
        $start = !empty($this->get('start')) ? $this->get('start') : 0;
        $length = !empty($this->get('length')) ? $this->get('length') : 10;
        $arr = [
        	'no',
        	'nama',
        	'email',
        	'action',
        ];
        if (!empty($id)) {
        	$this->user_model->where('id = "'.$id.'"');
            $user = $this->user_model->get_row();
        } elseif (!empty($search['value'])) {
        	$all = $this->user_model->get_all();
        	foreach ($columns as $key => $value) {
        		if($value['searchable'] == 'true') {
        			$this->user_model->or_like($arr[$key], $search['value']);
        		}
        	}
        	$this->user_model->set_limit($length, $start);
            $user = $this->user_model->get_all();
            $user = $this->getRowDatatable($user);
            $user = formatDatatable($user, $all);
        } else {
            $all = $this->user_model->get_all();
        	$this->user_model->set_limit($length, $start);
            $user = $this->user_model->get_all();
            $user = $this->getRowDatatable($user);
            $user = formatDatatable($user, $all);
        }
        $this->response($user, 200);
    }

    function index_post() { // post data user
       	$data = array(
		   'nama' => $this->post('nama'),
		   'email' => $this->post('email'),
		   'password' => md5($this->post('password')),
		);
		$insert = $this->user_model->insert($data);
		if ($insert) {
		   $this->response(array('status' => 'success'), 200);
		} else {
		   $this->response(array('status' => 'fail', 502));
		}
   	}

   	function index_put() { // update data user
		$id = $this->put('id');
		$data = array(
			'nama' => $this->put('nama'),
			'email' => $this->put('email'),
			'password' => md5($this->put('password')),
		);
		$this->user_model->where('id = "'.$id.'"');
		$update = $this->user_model->update($data);
		if ($update) {
			$this->response(array('status' => 'success'), 200);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
 	}

	function index_delete() { // delete data user
		$id = $this->delete('id');
		$this->user_model->where('id = "'.$id.'"');
		$delete = $this->user_model->delete();
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
				$value->nama,
				$value->email,
				'<a onclick="doFormEdit('.$value->id.');return false;" href="#" class="btn btn-xs btn-success">EDIT <i class="glyph-icon icon-pencil-square-o"></i></a> <a onclick="showModalBoxDelete('.$value->id.');return false;" href="#" class="btn btn-xs btn-danger">DELETE <i class="glyph-icon icon-close"></i></a>',
			];
		}
		return $ret;
	}

}

?>
