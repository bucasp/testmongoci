<?php
if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );
 
class MY_Controller extends CI_Controller {
 
 
	 public function _remap( $param ) {
		$request = $_SERVER['REQUEST_METHOD'];
		
		if ( preg_match( "/^(?=.*[a-zA-Z])(?=.*[0-9])/", $param ) ) {
			$id = $param;
		} else {
			$id = null;
		}
		
		switch( strtoupper( $request ) ) {
			case 'GET':
				$method = 'read';
				break;
			case 'POST':
				$method = 'save';
				break;
			case 'PUT':
				$method = 'update';
				break;
			case 'DELETE':
				$method = 'remove';
				break;
			case 'OPTIONS':
				$method = '_options';
				break;
		}
	 
		$this->$method( $id );
	}
	
	private function _options() 
	{
		$this->output->set_header( 'Access-Control-Allow-Origin: *' );
		$this->output->set_header( "Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS" );
		$this->output->set_header( 'Access-Control-Allow-Headers: content-type' );
		$this->output->set_content_type( 'application/json' );
		$this->output->set_output( "*" );
	}
	
	protected function _format_output( $output = null ) {
		$this->output->set_header( 'Access-Control-Allow-Origin: *' );
	 
		if( isset( $output->status ) && $output->status == 'error' ) {
			$this->output->set_status_header( 409, $output->desc );
		}
		$this->_parse_data( $output );
	 
		$this->output->set_content_type( 'application/json' );
		$this->output->set_output( json_encode( $output ) );
	}
	
	private function _parse_data( &$data ) {
		if ( ! is_array( $data ) && ! is_object( $data ) )
			return $data;
	 
		foreach ( $data as $key => $value ) {
			if ( is_object( $value ) || is_array( $value ) ) {
				if( is_object( $data ) ) {
					$data->{$key} = $this->_parse_data( $value );
				} else {
					$data[ $key ] = $this->_parse_data( $value );
				}
			}
	 
			if ( isset( $value->sec ) ) {
				if( is_object( $data ) ) {
					$data->{$key} = date( 'd.m.Y', $value->sec );
				} else {
					$data[ $key ] = date( 'd.m.Y', $value->sec );
				}
			}
	 
			if ( is_object( $value ) && isset( $value->{'$id'} ) ) {
				if( is_object( $data ) ) {
					$data->{$key} = $value->__toString();
				} else {
					$data[ $key ] = $value->__toString();
				}
			}
		}
	 
		return $data;
	}
	
	
}