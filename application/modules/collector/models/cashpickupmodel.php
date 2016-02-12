<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class CashPickupModel extends CI_Model {

    protected $tables = array(
        '0' => 'employee',
        '1' => 'driver',
        '2' => 'dispatcher',
        '3' => 'cooperative',
        '4' => 'route',
        '5' => 'vehicle',
        '6' => 'shift',
        '7' => 'dispatch_sched',
        '8' => 'dispatch_unit',
        '9' => 'trip',
        '10'=> 'cashier',
        '11'=> 'cash_turnover',
        '12'=> 'location'
    );

    public function all_locs($select = ''){
        $this->db->select($select);
        $this->db->distinct();
        $this->db->from($this->tables[12]);
        $this->db->where(array('loc_sta' => 'A'));
        $query = $this->db->get();
        return $query->result();
    }
    
    public function select_where($key = '', $select = '', $where = array()) {
        $this->db->select($select);
        $this->db->from($this->tables[$key]);
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }

    public function insert($key = '', $data = array()){
        $this->db->insert($this->tables[$key], $data); 
    }
    public function update($key = '', $data = array(), $where = array()){
        $this->db->update($this->tables[$key], $data, $where); 
    }

}