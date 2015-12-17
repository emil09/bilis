<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Loginmodel extends CI_Model {

	protected $tables = array(
		'0'=> 'employee'
	);
	
	public function select_where($key = '', $select = '', $where = array()) {
        $this->db->select($select);
        $this->db->from($this->tables[$key]);
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();;
    }
}

