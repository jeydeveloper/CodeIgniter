<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backend_user extends CI_Controller {
	public function index()
	{
		$data['api_url'] = base_url('api/user');
		$data['page_title'] = 'List User';
		$data['column_list'] = $this->get_show_column();
		$this->load->view('backend/header');
		$this->load->view('backend/content', ['page_content' => $this->load->view('backend/user/list', $data, true)]);
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
				'title_header_column' 	=> 'Username',
				'no_order'				=> 1,
			),
			array(
				'title_header_column' 	=> 'Email',
		        'no_order'				=> 2,
			),
			array(
				'title_header_column' 	=> 'Action',
			    'no_order'				=> 3,
			),
		);

		return $column_list;
	}
}