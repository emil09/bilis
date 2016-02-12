<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class ActiveTripsReportModel extends CI_Model {

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
        '12'=> 'location'
	);
    
    public function get_active_trips_list($select = '', $where = array()) {
        $this->db->select($select);
        $this->db->from($this->tables[8]);
        $this->db->join($this->tables[9], 'dsp_no_fk = dsp_unit_no', 'left');
        $this->db->join($this->tables[7], 'dsp_sched_no = sched_no_fk', 'left');
        $this->db->join($this->tables[1], 'driver_no = driver_no_fk', 'left');
        $this->db->join($this->tables[3], 'coo_no = driver.coo_no_fk', 'left');
        $this->db->join($this->tables[5], 'unt_no = unit_no_fk', 'left');
        $this->db->join($this->tables[0], 'employee.emp_no = driver.emp_no_fk', 'left');
        $this->db->join($this->tables[6], 'shift_code = shift_code_fk', 'left');
        $this->db->join($this->tables[4], 'route.rte_no = dispatch_sched.rte_no_fk', 'left');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();;
    }
    public function cashier_detail($select = '', $where = array()){
        $this->db->select($select);
        $this->db->from($this->tables[0]);
        $this->db->join($this->tables[10], 'emp_no_fk = emp_no', 'left');
        $this->db->join($this->tables[12], 'loc_no = loc_no_fk', 'left');
        $this->db->join($this->tables[3], 'coo_no = location.coo_no_fk', 'left');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }
}

