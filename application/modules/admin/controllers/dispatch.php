<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Dispatch extends MY_Controller {
	public function __construct() {
		parent::__construct();

		$this->load->model('DispatchModel','',TRUE);
		$this->check_session_admin();
	}

	public function index() {
		$data['module'] = 'admin';
		$data['view_file'] = 'dashboard_view';

		echo Modules::run('templates/bilis_template', $data);
	}

	public function driver() {
		$data['css'] = $this->add_css(array(DataTablesCSS, DataTablesJSCSS, DataTableToolsCSS, Bootstrap3DateCSS, Sweetalert2CSS));
    	$data['js'] = $this->add_js(array(DataTablesJS, DataTablesBSJS, DataTableToolsJS, Bootstrap3DateJS, Sweetalert2, DispatchByDriverJS));
    
		$data['module'] = 'admin';
		$data['view_file'] = 'dispatch_driver';	
    	$data['sidebar'] = 'admin/admin_sidebar';

    	$allcooperatives = $this->DispatchModel->all_coops('coo_no, coo_name');
		$data['cooperatives'] = $allcooperatives;
		echo Modules::run('templates/bilis_template', $data);	
	}

	public function get_dispatch_list() {
		
		// $_POST['shift'] = 'D';
		for ($c =0 , $i=-6; $i <= 0; $i++, $c++) { 
			$results['date'][$c] =  date("Y-m-d", strtotime($i . ' days'));
		}
		if(!empty($_POST['coop'])){
			$this->db->where('coo_no_fk', $_POST['coop']);
		}
		$select = 'rte_no, rte_nam';
		$where = array(
			'rte_sta'	=> 'A',

		);
		$results['routes'] = $this->DispatchModel->route_list($select, $where);

		for ($i=0; $i < count($results['routes']); $i++) {
			for ($j=0; $j < count($results['date']) ; $j++) { 

				if($_POST['shift'] == 'D'){
					$day =  date('N',strtotime($results['date'][$j]));
					$select = 'unt_lic, RIGHT(unt_lic,1) AS unit';
					
					switch ($day) {
						case '1':
							$c1 = 1; 
							$c2 = 2;
							break;
						case '2':
							$c1 = 3; 
							$c2 = 4;
							break;
						case '3':
							$c1 = 5; 
							$c2 = 6;
							break;
						case '4':
							$c1 = 7; 
							$c2 = 8;
							break;
						case '5':
							$c1 = 9; 
							$c2 = 0;
							break;
						
						default:
							$c1 = ' '; 
							$c2 = ' ';
							break;
					}

					$where = array('rte_no' =>  $results['routes'][$i]->rte_no);
			
					$this->db->having('unit', $c2);
					$this->db->or_having('unit', $c2);
					
					$unt_res = $this->DispatchModel->select_where(5, $select ,$where);
					$coding_unt = count($unt_res);
				}else{
					$coding_unt = 0;
				}

				$where = array('start_dt'=>$results['date'][$j], 'rte_no_fk'=> $results['routes'][$i]->rte_no, 'shift_code_fk'=>$_POST['shift']);
				$this->db->join('dispatch_sched', 'sched_no_fk = dsp_sched_no', 'left');
				$dsp_total = $this->DispatchModel->select_where(8, 'dsp_unit_no', $where);
				$results['routes'][$i]->dispatched[$j] = array('date' => $results['date'][$j], 'total'=>count($dsp_total));

				$where = array('rte_no'=> $results['routes'][$i]->rte_no);
				$tot_unit = $this->DispatchModel->select_where(5, 'unt_no', $where);
				$udsp_total =  count($tot_unit) - count($dsp_total);
				$results['routes'][$i]->not_dispatched[$j] = array('date' => $results['date'][$j], 'total'=> $udsp_total, 'coding_unt' => $coding_unt, 'available' =>  count($tot_unit) - $coding_unt);
			}
		}
		// for($day = 6; $day >= 0; $day--) {
		// 	$select = 'r.rte_no, rte_nam, count(dsp_unit_no) as dsp_unit, (select count(unt_no) from vehicle v where v.rte_no = r.rte_no) - count(dsp_unit_no) as udsp_unit, start_dt';
		// 	$where = array(
		// 		'start_dt' => date('Y-m-d',strtotime(-$day." days"))
		// 	);
		// 	$ctr+=1;
		// 	$results['dispatch_list_result'][$ctr] = $this->DispatchModel->dispatch_list($select, $where);
		// }
		
		// if($_POST['coo_no'] == '' && $_POST['rte_no'] == '') {
		// 	$where = array(
		// 		'start_dt' => date('Y-m-d')
		// 	);
		// } else {
		// 	$where = array(
		// 		// 'coo_no_fk'	=> $_POST['coo_no'],
		// 		'start_dt' 	=> date('Y-m-d')
		// 	);
		// }
		

		
		
		header('Content-Type: application/json');
		echo json_encode($results);
	}
}