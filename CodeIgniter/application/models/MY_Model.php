<?php
if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );
 
class MY_Model extends CI_Model {
	
	protected $_error;
	
	protected function _set_error( $desc, $data = null ) {
		$this->_error           = new stdClass();
		$this->_error->status   = 'error';
		$this->_error->desc     = $desc;
		if ( isset( $data ) ) {
			$this->_error->data = $data;
		}
	}
	
	public function get_error() {
		return $this->_error;
	}
	
	
}