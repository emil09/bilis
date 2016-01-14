<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


/* End of file constants.php */
/* Location: ./application/config/constants.php */


/*
|--------------------------------------------------------------------------
| Asset Libraries
|--------------------------------------------------------------------------
|
| These are libraries of javascript and stylesheet used in the project
|
*/

//JQuery
define('JQuery', 'assets/libs/jQuery/jQuery-2.1.4.min.js');
define('JQueryMigrate', 'assets/libs/jQuery/jquery-migrate-1.2.1.min.js');

// Bootstrap
define('BootstrapCSS', 'assets/libs/bootstrap/css/bootstrap.min.css');
define('BootstrapJS', 'assets/libs/bootstrap/js/bootstrap.min.js');

// SlimScroll
define('SlimScroll', 'assets/libs/slimScroll/jquery.slimscroll.min.js');


// Font-Awesome
define('FontAwesome', 'assets/libs/font-awesome-4.5.0/css/font-awesome.min.css');

// DataTables
define('DataTablesCSS', 'assets/libs/dataTables/css/dataTables.bootstrap.min.css');
define('DataTablesResCSS', 'assets/libs/dataTables/css/responsive.dataTables.min.css');
define('DataTablesJSCSS', 'assets/libs/dataTables/css/jquery.dataTables.min.css');
define('DataTableToolsCSS', 'assets/libs/dataTables/css/dataTables.tableTools.min.css');
define('DataTablesJS', 'assets/libs/dataTables/js/jquery.dataTables.min.js');
define('DataTablesBSJS', 'assets/libs/dataTables/js/dataTables.bootstrap.min.js');
define('DataTablesResJS', 'assets/libs/dataTables/js/dataTables.responsive.min.js');
define('DataTableToolsJS', 'assets/libs/dataTables/js/dataTables.tableTools.min.js');

// Select2
define('Select2CSS', 'assets/libs/select2/css/select2.min.css');
define('Select2JS', 'assets/libs/select2/js/select2.full.min.js');
// AdminLTE
define('AdminLTE', 'assets/libs/theme/css/AdminLTE.min.css');

// Skins
define('Skins', 'assets/libs/theme/css/skins/_all-skins.min.css');

// DatePicker3
define('DatePicker3', 'assets/libs/datepicker/datepicker3.css');

// FastClick 
define('FastClick', 'assets/libs/fastclick/fastclick.min.js');

// Sweet Alert2
define('Sweetalert2CSS', 'assets/libs/sweetalert2/sweetalert2.css');
define('Sweetalert2', 'assets/libs/sweetalert2/sweetalert2.min.js');

// Bootstrap DatePicker
define('BootstrapDate', 'assets/libs/datepicker/bootstrap-datepicker.js');

// Bootstrap 3 DatePicker
define('Bootstrap3DateCSS', 'assets/libs/bootstrap-datepicker/css/bootstrap-datetimepicker.min.css');
define('MomentJS', 'assets/libs/bootstrap-datepicker/js/moment.js');
define('Bootstrap3DateJS', 'assets/libs/bootstrap-datepicker/js/bootstrap-datetimepicker.min.js');


/*
|--------------------------------------------------------------------------
| Custom Constants
|--------------------------------------------------------------------------
|
| These are libraries of javascript and stylesheet used in the project
|
*/

// CSS
define('Main', 'assets/css/main.css');

// JS
define('Demo', 'assets/libs/theme/js/demo.js');
define('App', 'assets/libs/theme/js/app.min.js');
define('RegisterJS', 'assets/js/admin/register.js');


/*
|--------------------------------------------------------------------------
| Dispatcher
|--------------------------------------------------------------------------
*/
define('AvailableJS', 'assets/js/dispatcher/available.js');
define('ActiveTripsJS', 'assets/js/dispatcher/activetrips.js');
define('ScheduleNextJS', 'assets/js/dispatcher/schedulenext.js');

/*
|--------------------------------------------------------------------------
| Driver
|--------------------------------------------------------------------------
*/
define('TurnoverJS', 'assets/js/driver/turnover.js');

/*
|--------------------------------------------------------------------------
| Cashier
|--------------------------------------------------------------------------
*/
define('CashTurnoverJS', 'assets/js/cashier/cashturnover.js');
define('TurnoverReportJS', 'assets/js/cashier/turnoverreport.js');
define('ActiveTripsReportJS', 'assets/js/cashier/activetripsreport.js');