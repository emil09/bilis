<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class TemplateModel extends CI_Model {

	protected $tables = array(
		'0' => 'employee',
		'1' => 'employee_role'
	);
	
	public function select_where($key = '', $select = '', $where = array()) {
        $this->db->select($select);
        $this->db->from($this->tables[$key]);
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();;
    }


    public function emp_data($select = '', $where = array()) {
        $this->db->select($select);
        $this->db->from($this->tables[0]);
        $this->db->join($this->tables[1], 'emp_pos = role_id', 'left');
        $this->db->limit(1);
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();;
    }
}

