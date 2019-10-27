<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Submenu extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    function index_get() { //get data sub_menu
        $id = $this->get('id_sub_menu');
        if ($id == '') {
            $kontak = $this->db->get('sub_menu')->result();
        } else {
            $this->db->where('id_sub_menu', $id);
            $kontak = $this->db->get('sub_menu')->result();
        }
        $this->response($kontak, 200);
    }

    function index_post() { // post data sub_menu
       	$data = array(
		   'id_sub_menu' => $this->post('id_sub_menu'),
		   'nama_sub_menu' => $this->post('nama_sub_menu'),
		   'id_menu' => $this->post('id_menu'),
		   'style_sub_menu' => $this->post('style_sub_menu'),
		   'position_sub_menu' => $this->post('position_sub_menu'),
		   'grup_sub_menu' => $this->post('grup_sub_menu'),
		   'link' => $this->post('link'),
		);
		$insert = $this->db->insert('sub_menu', $data);
		if ($insert) {
		   $this->response($data, 200);
		} else {
		   $this->response(array('status' => 'fail', 502));
		}
   	}

   	function index_put() { // update data kontak
		$id = $this->put('id_sub_menu');
		$data = array(
			'id_sub_menu' => $this->put('id_sub_menu'),
			'nama_sub_menu' => $this->put('nama_sub_menu'),
		   	'id_menu' => $this->put('id_menu'),
		   	'style_sub_menu' => $this->put('style_sub_menu'),
		   	'position_sub_menu' => $this->put('position_sub_menu'),
		   	'grup_sub_menu' => $this->put('grup_sub_menu'),
		   	'link' => $this->put('link'),
		);
		$this->db->where('id_sub_menu', $id);
		$update = $this->db->update('sub_menu', $data);
		if ($update) {
			$this->response($data, 200);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
 	}

	function index_delete() { // delete data sub_menu
		$id = $this->delete('id_sub_menu');
		$this->db->where('id_sub_menu', $id);
		$delete = $this->db->delete('sub_menu');
		if ($delete) {
		    $this->response(array('status' => 'success'), 201);
		} else {
		    $this->response(array('status' => 'fail', 502));
		}
	}

}

?>
