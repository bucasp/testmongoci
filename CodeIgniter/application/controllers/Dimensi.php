<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dimensi extends CI_Controller{
    //put your code here
    public function index() {
        
        
		$this->load->library('mongo_db',array('activate' => 'default'), 'mongo_db');
		$this->load->helper('url');
		
		$ops = array(
			
			array(
				'$group' => array(
					"_id" => array("nodeid" => '$nodeid'),
					
				),
			),
		);
		
		$ops2 = array(
			
			array(
				'$group' => array(
					"_id" => array("kategori" => '$kategori'),
					
				),
			),
		);
		
		$period = new DatePeriod(
			 new DateTime('2016-11-04'),
			 new DateInterval('P1M'),
			 new DateTime('2017-06-01')
		);
		
		$data['datebaru'] = array();
		
		foreach($period as $date2){
			//echo $date->format("Ymd") . "<br>";
			array_push($data['datebaru'],$date2->format("m-Y"));
		}

		
		
		
		
		
		$data['dimensinode'] = array();
		$data['dimensikategori'] = array();
		
		
		$wew = $this->mongo_db->aggregate('wsn',  $ops);
		$wew2 = $this->mongo_db->aggregate('wsn',  $ops2);
			
			
		foreach ($wew['result'] as $row)
		{
			array_push($data['dimensinode'],$row);				
		}
		
		foreach ($wew2['result'] as $row2)
		{
			array_push($data['dimensikategori'],$row2);				
		}
		
		
		echo "<pre>";
		//print_r($data['dimensinode']);
		echo '<br>';
		//print_r($data['dimensikategori']);
		
		$this->load->view('dimensi', $data);
		
		
		
		
        
    }
	
	
	
}