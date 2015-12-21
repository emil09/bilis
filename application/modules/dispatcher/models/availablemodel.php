<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class AvailableModel extends CI_Model {

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

    public function get_driver($select = '', $where = array()){
        $this->db->select($select);
        $this->db->from($this->tables[0]);
        $this->db->join($this->tables[1], 'emp_no_fk = emp_no', 'left');
        $this->db->where($where);
        $this->db->order_by('emp_lname');
        $query = $this->db->get();
        return $query->result();
    }
}

