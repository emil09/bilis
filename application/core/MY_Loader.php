<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX_Loader class */
require APPPATH . "third_party/MX/Loader.php";

class MY_Loader extends MX_Loader {

    protected $_module;

    function MY_Loader() {
        parent::__construct();
        $this->_module = CI::$APP->router->fetch_module();
    }

    function widgets($widgets) {
        foreach ($widgets as $_widget)
            $this->plugin($_widget);
    }

    function widget($widget='', $params = NULL, $object_name=NULL) {

        $class = strtolower(end(explode('/', $widget)));

        if (isset($this->_ci_classes[$class]) AND $_alias = $this->_ci_classes[$class])
            return CI::$APP->$_alias;

        ($_alias = $object_name) OR $_alias = $class;

        if ($widget == '') {
            return FALSE;
        }

        if (!is_null($params) AND !is_array($params)) {
            $params = NULL;
        }
        list($path, $_widget) = Modules::find($widget, $this->_module, 'widgets/');


        if ($path === FALSE) {
            $path = APPPATH . 'widgets/' . $widget . '/';
            Modules::load_file($widget, $path);
        } else {
            Modules::load_file($_widget, $path);
            $widget = ucfirst($_widget);
        }
        CI::$APP->$_alias = new $widget($params);
        $this->_ci_classes[$class] = $_alias;
    }

}