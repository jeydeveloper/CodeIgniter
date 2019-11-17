<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Image_galeri extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();

        $this->load->model('imagegaleri_model');
    }

    function index_get() { //get data menu
        $id = $this->get('id');
        $search = $this->get('search');
        $columns = $this->get('columns');
        $start = !empty($this->get('start')) ? $this->get('start') : 0;
        $length = !empty($this->get('length')) ? $this->get('length') : 10;
        $arr = [
        	'no',
        	'nama_image_galeri',
        	'url_image_galeri',
        	'keterangan_image_galeri',
        	'action',
        ];
        if (!empty($id)) {
        	$this->imagegaleri_model->where('id_image_galeri = "'.$id.'"');
            $imagegaleri = $this->imagegaleri_model->get_row();
        } elseif (!empty($search['value'])) {
        	$all = $this->imagegaleri_model->get_all();
        	foreach ($columns as $key => $value) {
        		if($value['searchable'] == 'true') {
        			$this->imagegaleri_model->or_like($arr[$key], $search['value']);
        		}
        	}
        	$filtered = $this->imagegaleri_model->get_all();
        	foreach ($columns as $key => $value) {
        		if($value['searchable'] == 'true') {
        			$this->imagegaleri_model->or_like($arr[$key], $search['value']);
        		}
        	}
        	$this->imagegaleri_model->set_limit($length, $start);
            $imagegaleri = $this->imagegaleri_model->get_all();
            $imagegaleri = $this->getRowDatatable($imagegaleri);
            $imagegaleri = formatDatatable($imagegaleri, $all, $filtered);
        } else {
            $all = $this->imagegaleri_model->get_all();
        	$this->imagegaleri_model->set_limit($length, $start);
            $imagegaleri = $this->imagegaleri_model->get_all();
            $imagegaleri = $this->getRowDatatable($imagegaleri);
            $imagegaleri = formatDatatable($imagegaleri, $all, $all);
        }
        $this->response($imagegaleri, 200);
    }

    function index_post() { // post data menu
       	$data = array(
		   'nama_image_galeri' => $this->post('nama_image_galeri'),
		   'keterangan_image_galeri' => $this->post('keterangan_image_galeri'),
		);

        $image = $this->post('filenames');
        if(!empty($image[0])) {
            $data['url_image_galeri'] = $image[0];
        }

		$insert = $this->imagegaleri_model->insert($data);
		if ($insert) {
		   $this->response(array('status' => 'success'), 200);
		} else {
		   $this->response(array('status' => 'fail', 502));
		}
   	}

   	function index_put() { // update data menu
		$id = $this->put('id');
		$data = array(
			'nama_image_galeri' => $this->put('nama_image_galeri'),
		   	'keterangan_image_galeri' => $this->put('keterangan_image_galeri'),
		);

        $image = $this->put('filenames');
        if(!empty($image[0])) {
            $data['url_image_galeri'] = $image[0];
        }

		$this->imagegaleri_model->where('id_image_galeri = "'.$id.'"');
		$update = $this->imagegaleri_model->update($data);
		if ($update) {
			$this->response(array('status' => 'success'), 200);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
 	}

	function index_delete() { // delete data menu
		$id = $this->delete('id');
		$this->imagegaleri_model->where('id_image_galeri = "'.$id.'"');
		$delete = $this->imagegaleri_model->delete();
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
            $url = '';
            if(!empty($value->url_image_galeri)) {
                $src = base_url(DIR_UPLOAD_IMAGE_GALLERY.$value->url_image_galeri);
                $url = '<a href="'.$src.'" target="_blank">'.$src.'</a>';
            }
			$ret[$key] = [
				$start,
				$value->nama_image_galeri,
				$url,
				$value->keterangan_image_galeri,
				'<a onclick="doFormEdit('.$value->id_image_galeri.');return false;" href="#" class="btn btn-xs btn-success">EDIT <i class="glyph-icon icon-pencil-square-o"></i></a> <a onclick="showModalBoxDelete('.$value->id_image_galeri.');return false;" href="#" class="btn btn-xs btn-danger">DELETE <i class="glyph-icon icon-close"></i></a>',
			];
		}
		return $ret;
	}

}

?>
