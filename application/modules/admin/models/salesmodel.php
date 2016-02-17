<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class SalesModel extends CI_Model {

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

    public function sales_by_driver_list($select = '', $where = array()) {
        $this->db->select($select);
        $this->db->distinct();
        $this->db->from($this->tables[9].' AS t');
        $this->db->join($this->tables[8], 'dsp_unit_no = dsp_no_fk');
        $this->db->join($this->tables[7], 'dsp_sched_no = sched_no_fk');
        $this->db->join($this->tables[1].' AS d', 'driver_no = driver_no_fk');
        $this->db->join($this->tables[0], 'emp_no = d.emp_no_fk');
        $this->db->join($this->tables[6], 'shift_code = shift_code_fk');
        $this->db->join($this->tables[4], 'rte_no = rte_no_fk');
        $this->db->join($this->tables[5], 'unt_no = unit_no_fk');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }

    public function route_list($select = '', $where = array()) {
        $this->db->select($select);
        $this->db->from($this->tables[4]);
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
	
	public function select_where($key = '', $select = '', $where = array()) {
        $this->db->select($select, FALSE);
        $this->db->from($this->tables[$key]);
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }

    public function insert($key = '', $data = array()){
        $this->db->insert($this->tables[$key], $data); 
    }

    public function get_driver_stp(){
        $this->db->distinct();
        $this->db->select('dsp_unit_no, unt_lic, start_dt, start_time, end_dt, end_time, sched_no_fk, driver_no_fk, shift_code_fk, CONCAT(emp_lname, ", ", emp_fname, " (", employee.emp_no,")") as emp_name, dsp_stat_fk, shift_name', FALSE);
        $this->db->from($this->tables[9]);
        $this->db->join($this->tables[8], 'dsp_unit_no = dsp_no_fk', 'left');
        $this->db->join($this->tables[7], 'dsp_sched_no = sched_no_fk', 'left');
        $this->db->join($this->tables[1], 'driver_no = driver_no_fk', 'left');
        $this->db->join($this->tables[0], 'employee.emp_no = emp_no_fk', 'left');
        $this->db->join($this->tables[5], 'unt_no = unit_no_fk', 'left');
        $this->db->join($this->tables[6], 'shift_code = shift_code_fk', 'left');
        $query = $this->db->get();
        return $query->result();;
    }

    public function get_stp_amt(){
        $this->db->select('trp_id, dsp_no_fk, SUM(amt_in) as total_amt_in, CONCAT(to_dt, " ",to_time) as to_date, start_dt, start_time, end_dt, end_time, sched_no_fk, driver_no_fk, shift_code_fk,  dsp_stat_fk', FALSE);
        $this->db->from($this->tables[9]);
        $this->db->join($this->tables[8], 'dsp_unit_no = dsp_no_fk', 'left');
        $this->db->join($this->tables[7], 'dsp_sched_no = sched_no_fk', 'left');
            
        $query = $this->db->get();
        return $query->result();;
    }

    public function total_to(){
        $this->db->select('trp_id, dsp_no_fk, SUM(amt_in) as total_amt_in, CONCAT(to_dt, " ",to_time) as to_date, start_dt, start_time, end_dt, end_time, sched_no_fk, driver_no_fk, shift_code_fk,  dsp_stat_fk', FALSE);
        $this->db->from($this->tables[9]);
        $this->db->join($this->tables[8], 'dsp_unit_no = dsp_no_fk', 'left');
        $this->db->join($this->tables[7], 'dsp_sched_no = sched_no_fk', 'left');
        $this->db->join($this->tables[1], 'driver_no = driver_no_fk', 'left');
            
        $query = $this->db->get();
        return $query->result();

    }

}

