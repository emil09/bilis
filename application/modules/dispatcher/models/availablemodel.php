<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class AvailableModel extends CI_Model {

	protected $tables = array(
		'0' => 'employee',
        '1' => 'driver',
        '2' => 'dispatcher',
        '3' => 'cooperative',
        '4' => 'route',
        '5' => 'vehicle',
        '6' => 'shift',
        '7' => 'dispatch_sched'
	);
	
	public function select_where($key = '', $select = '', $where = array()) {
        $this->db->select($select);
        $this->db->from($this->tables[$key]);
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();;
    }
    public function select($key = '', $select = '') {
        $this->db->select($select);
        $this->db->from($this->tables[$key]);
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
        $this->db->join($this->tables[3], 'coo_no = coo_no_fk', 'left');
        $this->db->join($this->tables[7], 'driver_no_fk = driver_no', 'left');
        $this->db->join($this->tables[5], 'unt_no = unit_no_fk', 'left');
        $this->db->join($this->tables[6], 'shift_code = shift_code_fk', 'left');
        $this->db->where($where);
        $this->db->order_by('emp_lname');
        $query = $this->db->get();
        return $query->result();
    }

    public function dispatcher_detail($select = '', $where = array()){
        $this->db->select($select);
        $this->db->from($this->tables[0]);
        $this->db->join($this->tables[2], 'emp_no_fk = emp_no', 'left');
        $this->db->join($this->tables[3], 'coo_no = coo_no_fk', 'left');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }


}

