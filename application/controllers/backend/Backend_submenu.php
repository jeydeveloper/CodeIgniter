<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backend_submenu extends CI_Controller {
	public function index()
	{
		$data['api_url'] = base_url('api/submenu');
		$data['page_title'] = 'List submenu';
		$data['column_list'] = $this->get_show_column();
		$this->load->view('backend/header');
		$this->load->view('backend/content', ['page_content' => $this->load->view('backend/submenu/list', $data, true)]);
	}
	public function add()
	{
		$this->load->view('backend/header');
		$this->load->view('backend/content');
	}
	public function edit($id = '')
	{
		$this->load->view('backend/header');
		$this->load->view('backend/content', $data);
	}
	private function get_show_column() {
		$column_list = array(
			array(
				'title_header_column' 	=> 'No.',
				'no_order'				=> 0,
			),
			array(
				'title_header_column' 	=> 'Nama',
				'no_order'				=> 1,
			),
			array(
				'title_header_column' 	=> 'ID Menu',
		        'no_order'				=> 2,
			),
			array(
				'title_header_column' 	=> 'Style Menu',
		        'no_order'				=> 3,
			),
			array(
				'title_header_column' 	=> 'Position',
			    'no_order'				=> 4,
			),
			array(
				'title_header_column' 	=> 'Group',
			    'no_order'				=> 5,
			),
			array(
				'title_header_column' 	=> 'Link',
			    'no_order'				=> 6,
			),
		);

		return $column_list;
	}
}
