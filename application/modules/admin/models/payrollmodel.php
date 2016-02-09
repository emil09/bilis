<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class PayrollModel extends CI_Model {

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

    public function payroll_list($select = '', $where = array()) {
        $this->db->select($select);
        $this->db->from($this->tables[0]);
        $this->db->join($this->tables[1], 'emp_no = emp_no_fk');
        $this->db->join($this->tables[7], 'driver_no = driver_no_fk');
        $this->db->join($this->tables[5], 'unit_no_fk = unt_no');
        $this->db->join($this->tables[4].' AS r', 'rte_no_fk = r.rte_no');
        $this->db->join($this->tables[8].' AS du', 'dsp_sched_no = sched_no_fk');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }

    public function payroll_list_with_cash($select = '', $where = array()) {
        $this->db->select($select);
        $this->db->from($this->tables[0]);
        $this->db->join($this->tables[1], 'emp_no = emp_no_fk');
        $this->db->join($this->tables[7], 'driver_no = driver_no_fk');
        $this->db->join($this->tables[5], 'unit_no_fk = unt_no');
        $this->db->join($this->tables[4].' AS r', 'rte_no_fk = r.rte_no');
        $this->db->join($this->tables[8].' AS du', 'dsp_sched_no = sched_no_fk');
        $this->db->join($this->tables[9].' AS t', 'dsp_unit_no = dsp_no_fk');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }

    public function all_coops($select = ''){
        $this->db->select($select);
        $this->db->from($this->tables[3]);
        $query = $this->db->get();
        return $query->result();
    }
}

