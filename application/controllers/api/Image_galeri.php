<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Image_galeri extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    function index_get() { //get data image_galeri
        $id = $this->get('id_image_galeri');
        if ($id == '') {
            $kontak = $this->db->get('image_galeri')->result();
        } else {
            $this->db->where('id_image_galeri', $id);
            $kontak = $this->db->get('image_galeri')->result();
        }
        $this->response($kontak, 200);
    }

    function index_post() { // post data image_galeri
       	$data = array(
		   'id_image_galeri' => $this->post('id_image_galeri'),
		   'nama_image_galeri' => $this->post('nama_image_galeri'),
		   'url_image_galeri' => $this->post('url_image_galeri'),
		   'keterangan_image_galeri' => $this->post('keterangan_image_galeri'),
		);
		$insert = $this->db->insert('image_galeri', $data);
		if ($insert) {
		   $this->response($data, 200);
		} else {
		   $this->response(array('status' => 'fail', 502));
		}
   	}

   	function index_put() { // update data kontak
		$id = $this->put('id_image_galeri');
		$data = array(
			'id_image_galeri' => $this->put('id_image_galeri'),
			'nama_image_galeri' => $this->put('nama_image_galeri'),
		   	'url_image_galeri' => $this->put('url_image_galeri'),
		   	'keterangan_image_galeri' => $this->put('keterangan_image_galeri'),
		);
		$this->db->where('id_image_galeri', $id);
		$update = $this->db->update('image_galeri', $data);
		if ($update) {
			$this->response($data, 200);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
 	}

	function index_delete() { // delete data image_galeri
		$id = $this->delete('id_image_galeri');
		$this->db->where('id_image_galeri', $id);
		$delete = $this->db->delete('image_galeri');
		if ($delete) {
		    $this->response(array('status' => 'success'), 201);
		} else {
		    $this->response(array('status' => 'fail', 502));
		}
	}

}

?>
