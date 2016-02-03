<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class UpdateModel extends CI_Model {

    protected $tables = array(
        '0' => 'employee',
        '1' => 'driver',
        '2' => 'dispatcher',
        '3' => 'cashier',
        '4' => 'cooperative',
        '5' => 'location',
        '6' => 'terminal',
        '7' => 'trm_mgr'
    );
    
    public function select_where($key = '', $select = '', $where = array()) {
        $this->db->select($select, FALSE);
        $this->db->from($this->tables[$key]);
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();;
    }

    public function insert($key = '', $data = array()){
        $this->db->insert($this->tables[$key], $data); 
    }
}

