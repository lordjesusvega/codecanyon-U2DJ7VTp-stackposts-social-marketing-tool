<?php
class load extends MY_Controller {
	
	public $module_name;

	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');

		//
		$this->module_name = get_module_config( $this, 'name' );
		$this->module_icon = get_module_config( $this, 'icon' );
		//
	}

	public function index($type = "css"){
		$this->lastModificationTime(filemtime(__FILE__));
		$this->cacheHeaders($this->lastModificationTime());
		switch ($type) {
			case 'css':
				header("Content-type: text/css; charset: UTF-8");
				break;
			
			default:
				header("Content-type: text/javascript; charset: UTF-8");
				break;
		}

		ob_start ("ob_gzhandler");

		foreach (explode(",", post("load")) as $value) {
		    if (is_file( $value )) {
		        $real_path = mb_strtolower(realpath($value));
	            $this->lastModificationTime(filemtime($value));
	            include($value);echo "\n";
		    }
		}

	}

	// see http://web.archive.org/web/20071211140719/http://www.w3.org/2005/MWI/BPWG/techs/CachingWithPhp
	// $lastModifiedDate must be a GMT Unix Timestamp
	// You can use gmmktime(...) to get such a timestamp
	// getlastmod() also provides this kind of timestamp for the last
	// modification date of the PHP file itself
	public function cacheHeaders($lastModifiedDate) {
	    if ($lastModifiedDate) {
	        if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) >= $lastModifiedDate) {
	            if (php_sapi_name()=='CGI') {
	                Header("Status: 304 Not Modified");
	            } else {
	                Header("HTTP/1.0 304 Not Modified");
	            }
	            exit;
	        } else {
	            $gmtDate = gmdate("D, d M Y H:i:s \G\M\T",$lastModifiedDate);
	            header('Last-Modified: '.$gmtDate);
	        }
	    }
	}

	// This function uses a static variable to track the most recent
	// last modification time
	public function lastModificationTime($time=0) {
	    static $last_mod ;
	    if (!isset($last_mod) || $time > $last_mod) {
	        $last_mod = $time ;
	    }
	    return $last_mod ;
	}
}