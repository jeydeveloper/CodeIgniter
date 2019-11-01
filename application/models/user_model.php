<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {
	private $_table_name = 'user';

	function where($where = '') {
		if($where != '') $this->db->where($where);
		return $this;
	}
	
	function set_limit($limit, $start = 0) {
    	$this->db->limit($limit, $start);
        return $this;
    }
	
	function order_by($field, $direction = 'asc') {
		$this->db->order_by($field, $direction);
		return $this;
	}
	
	function like($field, $keyword, $pattern = 'both') {
		$this->db->like($field, $keyword, $pattern);
		return $this;
	}
	
	function or_like($field, $keyword = '', $pattern = 'both'){
		if($keyword != '') $this->db->or_like($field, $keyword, $pattern);
		else  $this->db->or_like($field);
		return $this;
	}
	
	function group_by($group_by = ''){
		$this->db->group_by($group_by);
		return $this;
	}
	
	function get_row(){
		return $this->db->get($this->_table_name)->row();
	}
	
	function get_all(){
		return $this->db->get($this->_table_name)->result();
	}

	function insert($data = null){
		return $this->db->insert($this->_table_name, $data);
	}

	function update($data = null){
		return $this->db->update($this->_table_name, $data);
	}

	function delete(){
		return $this->db->delete($this->_table_name);
	}
}

?>