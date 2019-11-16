<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Video_galeri extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();

        $this->load->model('videogaleri_model');
    }

    function index_get() { //get data menu
        $id = $this->get('id');
        $search = $this->get('search');
        $columns = $this->get('columns');
        $start = !empty($this->get('start')) ? $this->get('start') : 0;
        $length = !empty($this->get('length')) ? $this->get('length') : 10;
        $arr = [
        	'no',
        	'nama_video_galeri',
        	'url_video_galeri',
        	'keterangan_video_galeri',
        	'action',
        ];
        if (!empty($id)) {
        	$this->videogaleri_model->where('id_video_galeri = "'.$id.'"');
            $videogaleri = $this->videogaleri_model->get_row();
        } elseif (!empty($search['value'])) {
        	$all = $this->videogaleri_model->get_all();
        	foreach ($columns as $key => $value) {
        		if($value['searchable'] == 'true') {
        			$this->videogaleri_model->or_like($arr[$key], $search['value']);
        		}
        	}
        	$filtered = $this->videogaleri_model->get_all();
        	foreach ($columns as $key => $value) {
        		if($value['searchable'] == 'true') {
        			$this->videogaleri_model->or_like($arr[$key], $search['value']);
        		}
        	}
        	$this->videogaleri_model->set_limit($length, $start);
            $videogaleri = $this->videogaleri_model->get_all();
            $videogaleri = $this->getRowDatatable($videogaleri);
            $videogaleri = formatDatatable($videogaleri, $all, $filtered);
        } else {
            $all = $this->videogaleri_model->get_all();
        	$this->videogaleri_model->set_limit($length, $start);
            $videogaleri = $this->videogaleri_model->get_all();
            $videogaleri = $this->getRowDatatable($videogaleri);
            $videogaleri = formatDatatable($videogaleri, $all, $all);
        }
        $this->response($videogaleri, 200);
    }

    function index_post() { // post data menu
       	$data = array(
		   'nama_video_galeri' => $this->post('nama_video_galeri'),
		   'url_video_galeri' => $this->post('url_video_galeri'),
		   'keterangan_video_galeri' => $this->post('keterangan_video_galeri'),
		);
		$insert = $this->videogaleri_model->insert($data);
		if ($insert) {
		   $this->response(array('status' => 'success'), 200);
		} else {
		   $this->response(array('status' => 'fail', 502));
		}
   	}

   	function index_put() { // update data menu
		$id = $this->put('id');
		$data = array(
			'nama_video_galeri' => $this->put('nama_video_galeri'),
		   	'url_video_galeri' => $this->put('url_video_galeri'),
		   	'keterangan_video_galeri' => $this->put('keterangan_video_galeri'),
		);
		$this->videogaleri_model->where('id_video_galeri = "'.$id.'"');
		$update = $this->videogaleri_model->update($data);
		if ($update) {
			$this->response(array('status' => 'success'), 200);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
 	}

	function index_delete() { // delete data menu
		$id = $this->delete('id');
		$this->videogaleri_model->where('id_video_galeri = "'.$id.'"');
		$delete = $this->videogaleri_model->delete();
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
				$value->nama_video_galeri,
				$value->url_video_galeri,
				$value->keterangan_video_galeri,
				'<a onclick="doFormEdit('.$value->id_video_galeri.');return false;" href="#" class="btn btn-xs btn-success">EDIT <i class="glyph-icon icon-pencil-square-o"></i></a> <a onclick="showModalBoxDelete('.$value->id_video_galeri.');return false;" href="#" class="btn btn-xs btn-danger">DELETE <i class="glyph-icon icon-close"></i></a>',
			];
		}
		return $ret;
	}

}

?>
