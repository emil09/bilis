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
        '12'=> 'location',
        '13'=> 'collected_sacks'
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

    public function uncollected_list($select = '', $where = array()){
        $this->db->select($select);
        $this->db->from($this->tables[11]);
        $this->db->join($this->tables[9]. ' AS t', 'trp_id_fk = trp_id');
        $this->db->join($this->tables[12]. ' AS l', 't.loc_no = l.loc_no');
        $this->db->where($where);
        $this->db->group_by('ct_date, ct_sack, loc_name, ct_batch_fk');
        $query = $this->db->get();
        return $query->result();
    }

    public function collected_list($select = '', $where = array()){
        $this->db->select($select);
        $this->db->from($this->tables[13]);
        $this->db->join($this->tables[11], 'ct_id = ct_fk');
        $this->db->join($this->tables[9]. ' AS t', 'trp_id_fk = trp_id');
        $this->db->join($this->tables[12]. ' AS l', 't.loc_no = l.loc_no');
        $this->db->where($where);
        $this->db->group_by('ct_date, ct_sack, loc_name, ct_batch_fk');
        $query = $this->db->get();
        return $query->result();
    }

    // public function uncollected_list2($select = '', $where = array()){
    //     $this->db->select($select);
    //     $this->db->from($this->tables[11]);
    //     $this->db->join($this->tables[9]. ' AS t', 'trp_id_fk = trp_id');
    //     $this->db->join($this->tables[12]. ' AS l', 't.loc_no = l.loc_no');
    //     $this->db->where($where);
    //     $this->db->group_by('ct_date, ct_bag, ct_sack, loc_name, ct_batch_fk');
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    public function insert($key = '', $data = array()){
        $this->db->insert($this->tables[$key], $data);
    }
    public function update($key = '', $data = array(), $where = array()){
        $this->db->update($this->tables[$key], $data, $where); 
    }

}