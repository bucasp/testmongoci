<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tampilan extends CI_Controller{
    //put your code here
	
	public function __construct() {
		parent::__construct();
		$this->load->helper('perhitungan');
		$this->load->helper(array('url','language'));
		$this->load->library('mongo_db',array('activate' => 'default'), 'mongo_db');
		$this->load->helper('url');

		
	}
	
    public function index() {
        
        $this->load->library('mongo_db',array('activate' => 'default'), 'mongo_db');
		$this->load->helper('url');

		$data['hasil3d'] = array();
			$dimensi3 = array(
		
				
				array(
							
					'$project' => array(
						"_id" => 0,
						//"formattedDate" => array('$dateToString' => array("format" => "%m/%d/%Y %H:%M", "date" => '$tanggal')),
						//"y"   => array('$dayOfYear' => '$tanggal'),
						//"createdAtmonth" => array('$month' => '$tanggal'),
						//"y" => array('$year'=> array( new MongoDate('$timestamp').getFullYear())					),
						'year' => array('$year' => '$isotanggal' ),
						'month' => array('$month' => '$isotanggal' ),
						'day' => array('$dayOfMonth' => '$isotanggal'),
						'hour' => array('$hour' => '$isotanggal' ),
						'minute' => array('$minute' => '$isotanggal'),					
						'tanggalan' => array('$dateToString' => array( 'format' => "%d-%m-%Y", 'date'=>'$isotanggal')),
						'nodeid' => '$nodeid',
						'nilai' => '$nilai',
						'kategori' => '$kategori'
					)
				),
				
				array(
					'$group' => array(
						//"_id" => '$kategori',
						"_id" =>  array('kategori' => '$kategori','nodeid' => '$nodeid','tanggalan' => '$tanggalan','year' => '$year', 'month' => '$month', 'day' => '$day', 'hour' => '$hour'),
						"average" => array('$avg' => '$nilai')
						
					),
				),
				
				array(
				  '$sort' => array(
					  '_id.year' => 1,
					  '_id.month' => 1,
					  '_id.day' => 1,
					  '_id.hour' => 1,
					  '_id.nodeid' => 1
				  ),
				),
			
			
			);
			$wew = $this->mongo_db->aggregate('wsn',  $dimensi3);
			
		
		
		foreach ($wew['result'] as $row)
		{
				//echo json_encode($row);
			array_push($data['hasil3d'],$row);
				//$i++;
		}
		//echo $row['_id']['kategori'];
		echo "<pre>";
		//print_r($data['hasil3d']);
		
		//print_r($wew);
		
		
		
		
		
		$this->load->view('facttable', $data);
        
    }
	
	public function pecahdata()
	{
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
			 new DateTime('2016-06-01'),
			 new DateInterval('P1Y'),
			 new DateTime('2018-06-01')
		);
		
		$period2 = new DatePeriod(
			 new DateTime('2016-1-01'),
			 new DateInterval('P1M'),
			 new DateTime('2017-1-01')
		);
		
		$data['datebaru'] = array();
		$data['monthbaru'] = array();
		
		foreach($period as $date){
			//echo $date->format("Ymd") . "<br>";
			array_push($data['datebaru'],$date->format("Y"));
		}
		
		foreach($period2 as $date2){
			//echo $date->format("Ymd") . "<br>";
			array_push($data['monthbaru'],$date2->format("m"));
		}
		echo json_encode($data['monthbaru']);
		
		
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
			
		$this->load->view('pecahdata', $data);
	}
	
}