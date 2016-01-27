<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class SalesModel extends CI_Model {

	protected $tables = array(
        '0' => 'employee',
        '1' => 'driver',
        '2' => 'dispatcher',
        '3' => 'cashier',
        '4' => 'cooperative',
        '5' => 'location'
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

