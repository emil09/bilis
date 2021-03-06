<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class CashturnoverModel extends CI_Model {

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
        '11'=> 'cash_turnover'
    );
    
    public function select_where($key = '', $select = '', $where = array()) {
        $this->db->select($select);
        $this->db->from($this->tables[$key]);
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }

    public function cashier_detail($select = '', $where = array()){
        $this->db->select($select);
        $this->db->from($this->tables[0]);
        $this->db->join($this->tables[10], 'emp_no_fk = emp_no', 'left');
        $this->db->join($this->tables[3], 'coo_no_fk = coo_no', 'left');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }

    public function available_turnover($select = '', $where = array()) {
        $this->db->select($select);
        $this->db->from($this->tables[9]);
        $this->db->join($this->tables[8], 'dsp_unit_no = dsp_no_fk', 'left');
        $this->db->join($this->tables[7], 'dsp_sched_no = sched_no_fk', 'left');
        $this->db->join($this->tables[4], 'rte_no = rte_no_fk', 'left');
        $this->db->join($this->tables[5], 'unt_no = unit_no_fk', 'left');
        $this->db->join($this->tables[1], 'driver_no = driver_no_fk', 'left');
        $this->db->join($this->tables[0], 'employee.emp_no = emp_no_fk', 'left');
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