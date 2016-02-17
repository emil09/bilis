<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Sales extends MY_Controller {
	public function __construct() {
		parent::__construct();

		$this->load->model('SalesModel','',TRUE);
		$this->check_session_admin();
	}

	public function index() {
		$data['module'] = 'admin';
		$data['view_file'] = 'dashboard_view';

		echo Modules::run('templates/bilis_template', $data);
	}

	public function driver() {
		$data['css'] = $this->add_css(array(DataTablesCSS, DataTablesJSCSS, DataTableToolsCSS, Bootstrap3DateCSS, Sweetalert2CSS));
    	$data['js'] = $this->add_js(array(DataTablesJS, DataTablesBSJS, DataTableToolsJS, Bootstrap3DateJS, Sweetalert2, SalesByDriverJS));
    
		$data['module'] = 'admin';
		$data['view_file'] = 'sales_driver';	
    	$data['sidebar'] = 'admin/admin_sidebar';

    	$allcooperatives = $this->SalesModel->all_coops('coo_no, coo_name');
		$data['cooperatives'] = $allcooperatives;
		echo Modules::run('templates/bilis_template', $data);
		
	}
	public function unit() {
		$data['css'] = $this->add_css(array(DataTablesCSS, DataTablesJSCSS, DataTableToolsCSS, Bootstrap3DateCSS, Sweetalert2CSS));
    	$data['js'] = $this->add_js(array(DataTablesJS, DataTablesBSJS, DataTableToolsJS, Bootstrap3DateJS, Sweetalert2, SalesByUnitJS));
    
		$data['module'] = 'admin';
		$data['view_file'] = 'sales_unit';	
    	$data['sidebar'] = 'admin/admin_sidebar';

    	$allcooperatives = $this->SalesModel->all_coops('coo_no, coo_name');
		$data['cooperatives'] = $allcooperatives;
		echo Modules::run('templates/bilis_template', $data);
		
	}

	public function sales_by_driver_list(){

		header('Content-Type: application/json');
		$select = 'd.emp_no_fk, emp_lname, emp_fname, rte_nam, unt_lic, start_dt, start_time, d.coo_no_fk, dsp_stat_fk, end_dt, end_time';
		if($_POST['coo_no'] != '') {
			$this->db->where('d.coo_no_fk', $_POST['coo_no']);
		} 
		if($_POST['rte_no'] != ''){
			$this->db->where('rte_no_fk', $_POST['rte_no']);
		}

		if($_POST['shift_code'] != ''){
			$this->db->where('shift_code_fk', $_POST['shift_code']);
		}

		$where = array(
			'start_dt' 		=> date('Y-m-d'),
			'start_dt'	=> $_POST['start_dt']
		);

		$results['sales_list'] = $this->SalesModel->sales_by_driver_list($select, $where);

		$select = 'd.emp_no_fk, unit_no_fk, trips_ctr, rte_nam, amt_in, to_dt, to_time';

		// if($_POST['coo_no'] == '' || $_POST['rte_no'] == '' || $_POST['shift_code'] == '') {
		// 	$where = array(
		// 		'start_dt' 		=> date('Y-m-d'),
		// 		// 'shift_code_fk'	=> $_POST['shift_code'],
		// 		'start_dt'	=> $_POST['start_dt'],
		// 	);
		// } else {
		// 	$where = array(
		// 		'start_dt' 		=> date('Y-m-d'),
		// 		'rte_no_fk'		=> $_POST['rte_no'],
		// 		'shift_code_fk'	=> $_POST['shift_code'],
		// 		'start_dt'	=> $_POST['start_dt'],
		// 		'd.coo_no_fk'	=> $_POST['coo_no']
		// 	);
		// }

		if($_POST['coo_no'] != '') {
			$this->db->where('d.coo_no_fk', $_POST['coo_no']);
		} 
		if($_POST['rte_no'] != ''){
			$this->db->where('rte_no_fk', $_POST['rte_no']);
		}

		if($_POST['shift_code'] != ''){
			$this->db->where('shift_code_fk', $_POST['shift_code']);
		}

		$where = array(
			'start_dt' 		=> date('Y-m-d'),
			'start_dt'	=> $_POST['start_dt']
		);
		
		$results['sales_cash'] = $this->SalesModel->sales_by_driver_list($select, $where);

		echo json_encode($results);
	}

	public function my_route_list() {
		header('Content-Type: application/json');
		$select = 'rte_no, rte_nam';
		$where	= array(
			'coo_no_fk' => $_POST['coo_no']
		);
		$results['route_list'] = $this->SalesModel->route_list($select, $where);
		echo json_encode($results);
	}

	public function tp($var = ''){
		if($var == 'driver'){
			$this->tp_driver();
		}
		elseif ($var == 'unit') {
			$this->tp_unit();
		}else{
			show_404();
		}
		
	}

	private function tp_unit(){
		$data['module'] = 'admin';
    	$data['sidebar'] = 'admin/admin_sidebar';
		$data['view_file'] = 'tp_unit_view';
		$allcooperatives = $this->SalesModel->all_coops('coo_no, coo_name');
		$data['cooperatives'] = $allcooperatives;
		$this->db->order_by('rte_nam');
		$data['routes'] = $this->SalesModel->select_where(4, 'rte_no, rte_nam');
		$data['css'] = $this->add_css(array(DataTablesJSCSS,DataTablesFixedColumnCSS, Bootstrap3DateCSS));
    	$data['js'] = $this->add_js(array(DataTablesJS, DataTablesFixedColumnJS, Bootstrap3DateJS, TPUnitJS));

		echo Modules::run('templates/bilis_template', $data);
	}
	private function tp_driver(){
		$data['module'] = 'admin';
    	$data['sidebar'] = 'admin/admin_sidebar';
		$data['view_file'] = 'tp_driver_view';
		$allcooperatives = $this->SalesModel->all_coops('coo_no, coo_name');
		$data['cooperatives'] = $allcooperatives;
		$this->db->order_by('rte_nam');
		$data['routes'] = $this->SalesModel->select_where(4, 'rte_no, rte_nam');
		$data['css'] = $this->add_css(array(DataTablesJSCSS,DataTablesFixedColumnCSS, Bootstrap3DateCSS));
    	$data['js'] = $this->add_js(array(DataTablesJS, DataTablesFixedColumnJS, Bootstrap3DateJS, TPDriverJS));
		echo Modules::run('templates/bilis_template', $data);
	}

	public function get_driver_stp(){
		if(isset($_POST['filter_date'])){
			$date = $_POST['filter_date'];
		}else{
			$date = '2016-02-17';
		}
		
		$shift = 'A';
		$coo = 'A';
		$rte = 'A';


		if(isset($_POST['shift'])){
			$shift = $_POST['shift'];
		}

		if(isset($_POST['coo_select'])){
			$coo = $_POST['coo_select'];
		}
		if(isset($_POST['route'])){
			$rte = $_POST['route'];
		}



		if($shift!='A') {
			$this->db->where('shift_code_fk',$shift);
		}

		if($coo!='A') {
			$this->db->where('coo_no_fk',$coo);
		}
		if($rte!='A') {
			$this->db->where('rte_no_fk',$rte);
		}

		$this->db->where('start_dt',$date);
		$results['stp_driver'] = $this->SalesModel->get_driver_stp();

		for ($j=0; $j < count($results['stp_driver']); $j++) { 
			$time = strtotime('3:00');
	        $startTime = date("H:i", $time);

	        
		    for ($i=0; $i <48 ; $i++) { 

	            $endTime = date("H:i", strtotime('+30 minutes', $time));     
	            $this->db->where('driver_no_fk', $results['stp_driver'][$j]->driver_no_fk);
			    $this->db->where('dsp_unit_no', $results['stp_driver'][$j]->dsp_unit_no);
			    
				$this->db->where('start_dt',$date);
		        $this->db->group_by('driver_no_fk');
				$this->db->where('to_time >=', $startTime);
				$this->db->where('to_time <=', $endTime);
				$results['stp_driver'][$j]->s[$i] = $this->SalesModel->get_stp_amt();

				
		

				$time = strtotime($endTime);
	            $startTime = date("H:i", $time);
		    }

		    $this->db->where('dsp_unit_no', $results['stp_driver'][$j]->dsp_unit_no);
		    $this->db->group_by('driver_no_fk');
	    	$this->db->where('driver_no_fk', $results['stp_driver'][$j]->driver_no_fk);
	        $total_to = $this->SalesModel->total_to();
	        $results['stp_driver'][$j]->total_to = $total_to[0]->total_amt_in;

		}

		$time = strtotime('3:00');
        $startTime = date("g:i A", $time);
        for ($i=0; $i <48 ; $i++) { 
            $endTime = date("g:i A", strtotime('+30 minutes', $time));
            // echo '<th>' . $startTime .' - '. $endTime. '</th>';
            $results['tme_period'][$i] = array('startTime'=> $startTime, 'endTime'=> $endTime); 
            $time = strtotime($endTime);
            $startTime = date("g:i A", $time);
        }

    
	    $time = strtotime('3:00');
	    $startTime = date("H:i", $time);
	    for ($i=0; $i <48 ; $i++) { 

	        $endTime = date("H:i", strtotime('+30 minutes', $time));     
			$this->db->where('start_dt',$date); 
			$this->db->where('shift_code_fk', 'D');
	        $this->db->group_by('shift_code_fk');
			$this->db->where('to_time >=', $startTime);
			$this->db->where('to_time <=', $endTime);
			$results['total_tp_day'][$i] = $this->SalesModel->get_stp_amt();

			$this->db->where('start_dt',$date); 
			$this->db->where('shift_code_fk', 'N');
	        $this->db->group_by('shift_code_fk');
			$this->db->where('to_time >=', $startTime);
			$this->db->where('to_time <=', $endTime);
			$results['total_tp_night'][$i] = $this->SalesModel->get_stp_amt();

			$this->db->where('start_dt',$date); 
	        $this->db->group_by('start_dt');
			$this->db->where('to_time >=', $startTime);
			$this->db->where('to_time <=', $endTime);
			$results['total_tp_shift'][$i] = $this->SalesModel->get_stp_amt();



			$time = strtotime($endTime);
	        $startTime = date("H:i", $time);
	    }

	    if($coo!='A') {
			$this->db->where('coo_no_fk',$coo);
		}
		if($rte!='A') {
			$this->db->where('rte_no_fk',$rte);
		}
	    $this->db->where('start_dt',$date); 
		$this->db->where('shift_code_fk', 'D');
		$total_to = $this->SalesModel->total_to();
        $results['total_to_day'] = $total_to[0]->total_amt_in;

        if($coo!='A') {
			$this->db->where('coo_no_fk',$coo);
		}
		if($rte!='A') {
			$this->db->where('rte_no_fk',$rte);
		}
        $this->db->where('start_dt',$date); 
		$this->db->where('shift_code_fk', 'N');
		$total_to = $this->SalesModel->total_to();
        $results['total_to_night'] = $total_to[0]->total_amt_in;

        if($coo!='A') {
			$this->db->where('coo_no_fk',$coo);
		}
		if($rte!='A') {
			$this->db->where('rte_no_fk',$rte);
		}
		$this->db->where('start_dt',$date); 
		$total_to = $this->SalesModel->total_to();
        $results['total_to'] = $total_to[0]->total_amt_in;
        $results['test'] = $_POST;

		header('Content-Type: application/json');
		echo json_encode($results, JSON_PRETTY_PRINT);

	}

	public function get_stp_amt(){
        $time = strtotime('3:00');
		$startTime = date("H:i", $time);
	    

	    for ($i=0; $i < 48 ; $i++) { 
            $endTime = date("H:i", strtotime('+30 minutes', $time));         
            $this->db->where('driver_no_fk', 21);
	        $this->db->group_by('driver_no_fk');
			$this->db->where('to_time >=', $startTime);
			$this->db->where('to_time <=', $endTime);
			$results[$i] = $this->SalesModel->get_stp_amt();

			$time = strtotime($endTime);
            $startTime = date("H:i", $time);
	    }
	
		header('Content-Type: application/json');
		echo json_encode($results, JSON_PRETTY_PRINT);

	}


}