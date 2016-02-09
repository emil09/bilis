<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class DispatchModel extends CI_Model {

	protected $tables = array(
        '3' => 'cooperative',
        '4' => 'route',
        '5' => 'vehicle',
        '7' => 'dispatch_sched',
        '8' => 'dispatch_unit'
    );

    public function all_coops($select = ''){
        $this->db->select($select);
        $this->db->from($this->tables[3]);
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

    public function dispatch_list($select = '', $where = array()){
    	$this->db->select($select);
    	$this->db->from($this->tables[4].' AS r');
    	$this->db->join($this->tables[5].' AS v', 'r.rte_no = v.rte_no');
    	$this->db->join($this->tables[7], 'unt_no = unit_no_fk');
    	$this->db->join($this->tables[8], 'dsp_sched_no = dsp_unit_no');
    	$this->db->where($where);
    	$this->db->group_by("rte_nam");
        $query = $this->db->get();
        return $query->result();
    }

    public function select_where($key = '', $select = '', $where = array()) {
        $this->db->select($select, FALSE);
        $this->db->from($this->tables[$key]);
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();;
    }
	
}

