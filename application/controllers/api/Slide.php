<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Slide extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    function index_get() { //get data slide
        $id = $this->get('id_slide');
        if ($id == '') {
            $kontak = $this->db->get('slide')->result();
        } else {
            $this->db->where('id_slide', $id);
            $kontak = $this->db->get('slide')->result();
        }
        $this->response($kontak, 200);
    }

    function index_post() { // post data slide
       	$data = array(
		   'id_slide' => $this->post('id_slide'),
		   'nama_slide' => $this->post('nama_slide'),
		   'url_slide' => $this->post('url_slide'),
		   'mulai_slide' => $this->post('mulai_slide'),
		   'akhir_slide' => $this->post('akhir_slide'),
		   'isactive_slide' => $this->post('isactive_slide'),
		);
		$insert = $this->db->insert('slide', $data);
		if ($insert) {
		   $this->response($data, 200);
		} else {
		   $this->response(array('status' => 'fail', 502));
		}
   	}

   	function index_put() { // update data kontak
		$id = $this->put('id_slide');
		$data = array(
			'id_slide' => $this->put('id_slide'),
			'nama_slide' => $this->put('nama_slide'),
			'url_slide' => $this->put('url_slide'),
		   	'mulai_slide' => $this->put('mulai_slide'),
		   	'akhir_slide' => $this->put('akhir_slide'),
		   	'isactive_slide' => $this->put('isactive_slide'),
		);
		$this->db->where('id_slide', $id);
		$update = $this->db->update('slide', $data);
		if ($update) {
			$this->response($data, 200);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
 	}

	function index_delete() { // delete data slide
		$id = $this->delete('id_slide');
		$this->db->where('id_slide', $id);
		$delete = $this->db->delete('slide');
		if ($delete) {
		    $this->response(array('status' => 'success'), 201);
		} else {
		    $this->response(array('status' => 'fail', 502));
		}
	}

}

?>
