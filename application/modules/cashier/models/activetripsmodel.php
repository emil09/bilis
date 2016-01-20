<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class ActiveTripsModel extends CI_Model {

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

    public function active_list($select = '', $where = array()) {
        $this->db->select($select);
        $this->db->distinct();
        // $this->db->from($this->tables[10].' AS c');
        $this->db->from($this->tables[9].' AS t');
        // $this->db->from($this->tables[9].' AS t', 'c.loc_no = t.loc_no');
        $this->db->join($this->tables[8], 'dsp_unit_no = dsp_no_fk');
        $this->db->join($this->tables[7], 'dsp_sched_no = sched_no_fk');
        $this->db->join($this->tables[1].' AS d', 'driver_no = driver_no_fk');
        $this->db->join($this->tables[0], 'emp_no = d.emp_no_fk');
        $this->db->join($this->tables[6], 'shift_code = shift_code_fk');
        $this->db->join($this->tables[4], 'rte_no = rte_no_fk');
        $this->db->join($this->tables[5], 'unt_no = unit_no_fk');
        $this->db->where($where);
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }

}