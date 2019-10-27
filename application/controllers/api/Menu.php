<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Menu extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    function index_get() { //get data menu
        $id = $this->get('id_menu');
        if ($id == '') {
            $kontak = $this->db->get('menu')->result();
        } else {
            $this->db->where('id_menu', $id);
            $kontak = $this->db->get('menu')->result();
        }
        $this->response($kontak, 200);
    }

    function index_post() { // post data menu
       	$data = array(
		   'id_menu' => $this->post('id_menu'),
		   'nama_menu' => $this->post('nama_menu'),
		   'style_menu' => $this->post('style_menu'),
		   'position_menu' => $this->post('position_menu'),
		);
		$insert = $this->db->insert('menu', $data);
		if ($insert) {
		   $this->response($data, 200);
		} else {
		   $this->response(array('status' => 'fail', 502));
		}
   	}

   	function index_put() { // update data kontak
		$id = $this->put('id_menu');
		$data = array(
			'id_menu' => $this->put('id_menu'),
			'nama_menu' => $this->put('nama_menu'),
		   	'style_menu' => $this->put('style_menu'),
		   	'position_menu' => $this->put('position_menu'),
		);
		$this->db->where('id_menu', $id);
		$update = $this->db->update('menu', $data);
		if ($update) {
			$this->response($data, 200);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
 	}

	function index_delete() { // delete data menu
		$id = $this->delete('id_menu');
		$this->db->where('id_menu', $id);
		$delete = $this->db->delete('menu');
		if ($delete) {
		    $this->response(array('status' => 'success'), 201);
		} else {
		    $this->response(array('status' => 'fail', 502));
		}
	}

}

?>
