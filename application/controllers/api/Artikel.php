<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Artikel extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    function index_get() { //get data artikel
        $id = $this->get('artikel_id');
        if ($id == '') {
            $kontak = $this->db->get('artikel')->result();
        } else {
            $this->db->where('artikel_id', $id);
            $kontak = $this->db->get('artikel')->result();
        }
        $this->response($kontak, 200);
    }

    function index_post() { // post data artikel
       	$data = array(
		   'artikel_id' => $this->post('artikel_id'),
		   'artikel_name' => $this->post('artikel_name'),
		   'artikel_content' => $this->post('artikel_content'),
		   'artikel_image' => $this->post('artikel_image'),
		   'artikel_publish' => $this->post('artikel_publish'),
		   'artikel_author' => $this->post('artikel_author'),
		   'artikel_isactive' => $this->post('artikel_isactive'),
		   'id_sub_menu' => $this->post('id_sub_menu'),
		);
		$insert = $this->db->insert('artikel', $data);
		if ($insert) {
		   $this->response($data, 200);
		} else {
		   $this->response(array('status' => 'fail', 502));
		}
   	}

   	function index_put() { // update data kontak
		$id = $this->put('artikel_id');
		$data = array(
			'artikel_id' => $this->put('artikel_id'),
			'artikel_name' => $this->put('artikel_name'),
			'artikel_content' => $this->put('artikel_content'),
			'artikel_image' => $this->put('artikel_image'),
		   	'artikel_publish' => $this->put('artikel_publish'),
		   	'artikel_author' => $this->put('artikel_author'),
		   	'artikel_isactive' => $this->put('artikel_isactive'),
		   	'id_sub_menu' => $this->put('id_sub_menu'),
		);
		$this->db->where('artikel_id', $id);
		$update = $this->db->update('artikel', $data);
		if ($update) {
			$this->response($data, 200);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
 	}

	function index_delete() { // delete data artikel
		$id = $this->delete('artikel_id');
		$this->db->where('artikel_id', $id);
		$delete = $this->db->delete('artikel');
		if ($delete) {
		    $this->response(array('status' => 'success'), 201);
		} else {
		    $this->response(array('status' => 'fail', 502));
		}
	}

}

?>
