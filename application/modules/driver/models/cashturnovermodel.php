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
        '10' => 'cashier',
        '11' => 'location'
	);
	
	public function select_where($key = '', $select = '', $where = array()) {
        $this->db->select($select);
        $this->db->from($this->tables[$key]);
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }
    public function active_trip($select = '', $where = array()) {
        $this->db->select($select);
        $this->db->from($this->tables[8]);
        $this->db->join($this->tables[7], 'dsp_sched_no = sched_no_fk');
        $this->db->join($this->tables[1], 'driver_no = driver_no_fk');
        $this->db->join($this->tables[6], 'shift_code = shift_code_fk');
        $this->db->join($this->tables[4], 'rte_no = rte_no_fk');
        $this->db->join($this->tables[5], 'unt_no = unit_no_fk');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }
    public function turnover_location($select = '', $where = array()) {
        $this->db->select($select);
        // $this->db->distinct();
        $this->db->from($this->tables[8]);
        $this->db->join($this->tables[7], 'dsp_sched_no = sched_no_fk');
        $this->db->join($this->tables[1]. ' AS d', 'driver_no = driver_no_fk');
        $this->db->join($this->tables[11]. ' AS l', 'd.coo_no_fk = l.coo_no_fk');
        $this->db->where($where);

        $query = $this->db->get();
        return $query->result();
        
    }
	public function insert($key = '', $data = array()){
        $this->db->insert($this->tables[$key], $data); 
    }


}