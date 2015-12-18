<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class RegisterModel extends CI_Model {

	protected $tables = array(
		'0' => 'employee',
        '1' => 'driver'
	);
	
	public function select_where($key = '', $select = '', $where = array()) {
        $this->db->select($select);
        $this->db->from($this->tables[$key]);
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();;
    }

    public function insert($key = '', $data = array()){
        $this->db->insert($this->tables[$key], $data); 
    }
}

