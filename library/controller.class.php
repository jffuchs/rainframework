<?php

/**
 *  Rain Framework > Controller class
 *	---------------------------------
 * 
 *	@author Federico Ulfo
 *	@copyright developed and mantained by the Rain Team: http://www.raintm.com
 *	@license Licensed under the MIT license: http://www.opensource.org/licenses/mit-license.php
 *	@link http://www.rainframework.com
 *	@package RainFramework
 */



/**
 * Controller class
 */
class Controller{

	static $loaded_controller, $loaded_model;
	
	private $controllers_dir = CONTROLLERS_DIR,
			$models_dir = MODELS_DIR;
	
	function load_controller( $controller, $object_name = null ){

		#--------------------------------
		# Hooks
		hooks('load_controller');
		#--------------------------------


		// include the file
		$file = $this->controllers_dir . $controller . ".controller.class.php";
		if( file_exists($file) )
			require_once $file;
		else{
			trigger_error( "CONTROLLER: FILE <b>{$file}</b> NOT FOUND ", E_USER_WARNING );
			return false;
		}

		if(!$object_name)
			$object_name = $controller;

		$class=$controller . "_Controller";
		if( class_exists($class) )
			$this->$object_name = new $class;			
		else{
			trigger_error( "CONTROLLER: CLASS <b>{$controller}</b> NOT FOUND ", E_USER_WARNING );
			return false;
		}
		return true;
		
	}

	function load_model($model,$object_name=null){

		// include the file
		$file = $this->models_dir . $model . ".model.class.php";
		if( file_exists($file) )
			require_once $file;
		else{
			trigger_error( "MODEL: FILE <b>{$file}</b> NOT FOUND ", E_USER_WARNING );
			return false;
		}

		if(!$object_name)
			$object_name = $model;

		$class=$model . "_Model";
		if( class_exists($class) )
			$this->$object_name = new $class;			
		else{
			trigger_error( "MODEL: CLASS <b>{$model}</b> NOT FOUND", E_USER_WARNING );
			return false;
		}
		return true;
	}
	
	function set_controllers_dir( $directory ){
		$this->controllers_dir = $directory;
	}

	function set_models_dir( $models ){
		$this->models_dir = $models;
	}
	
}



?>