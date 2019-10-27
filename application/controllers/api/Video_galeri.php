<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Video_galeri extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    function index_get() { //get data video_galeri
        $id = $this->get('id_video_galeri');
        if ($id == '') {
            $kontak = $this->db->get('video_galeri')->result();
        } else {
            $this->db->where('id_video_galeri', $id);
            $kontak = $this->db->get('video_galeri')->result();
        }
        $this->response($kontak, 200);
    }

    function index_post() { // post data video_galeri
       	$data = array(
		   'id_video_galeri' => $this->post('id_video_galeri'),
		   'nama_video_galeri' => $this->post('nama_video_galeri'),
		   'url_video_galeri' => $this->post('url_video_galeri'),
		   'keterangan_video_galeri' => $this->post('keterangan_video_galeri'),
		);
		$insert = $this->db->insert('video_galeri', $data);
		if ($insert) {
		   $this->response($data, 200);
		} else {
		   $this->response(array('status' => 'fail', 502));
		}
   	}

   	function index_put() { // update data kontak
		$id = $this->put('id_video_galeri');
		$data = array(
			'id_video_galeri' => $this->put('id_video_galeri'),
			'nama_video_galeri' => $this->put('nama_video_galeri'),
		   	'url_video_galeri' => $this->put('url_video_galeri'),
		   	'keterangan_video_galeri' => $this->put('keterangan_video_galeri'),
		);
		$this->db->where('id_video_galeri', $id);
		$update = $this->db->update('video_galeri', $data);
		if ($update) {
			$this->response($data, 200);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
 	}

	function index_delete() { // delete data video_galeri
		$id = $this->delete('id_video_galeri');
		$this->db->where('id_video_galeri', $id);
		$delete = $this->db->delete('video_galeri');
		if ($delete) {
		    $this->response(array('status' => 'success'), 201);
		} else {
		    $this->response(array('status' => 'fail', 502));
		}
	}

}

?>
