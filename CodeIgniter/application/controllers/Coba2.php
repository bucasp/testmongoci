<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coba2 extends CI_Controller{
    //put your code here
    public function index() {
        
        $this->load->library('mongo_db',array('activate' => 'default'), 'mongo_db');
		$this->load->helper('url');
		
		$dimensi0 = array(
			
		
			array(
						
				'$project' => array(
					"_id" => 0,
					//"formattedDate" => array('$dateToString' => array("format" => "%m/%d/%Y %H:%M", "date" => '$tanggal')),
					//"y"   => array('$dayOfYear' => '$tanggal'),
					//"createdAtmonth" => array('$month' => '$tanggal'),
					//"y" => array('$year'=> array( new MongoDate('$timestamp').getFullYear())					),
					'year' => array('$year' => '$tanggal' ),
					'month' => array('$month' => '$tanggal' ),
					'day' => array('$dayOfMonth' => '$tanggal'),
					'tanggalan' => array('$dateToString' => array( 'format' => "%d-%m-%Y", 'date'=>'$tanggal')),
					//'nodeid' => '$nodeid',
					'nilai' => '$nilai'
				)
			),
			
			array(
				'$group' => array(
					"_id" => 1,
					//"_id" =>  array('year' => '$year', 'month' => '$month', 'day' => '$day','tanggalan' => '$tanggalan'),
					"average" => array('$avg' => '$nilai')
					
				),
			),
			
			 array(
			  '$sort' => array(
				  '_id.year' => 1,
				  '_id.month' => 1,
				  '_id.day' => 1
			  ),
			),
		);
		
		
		
		$dimensi3 = array(
			
			array(
						
				'$project' => array(
					"_id" => 0,
					//"formattedDate" => array('$dateToString' => array("format" => "%m/%d/%Y %H:%M", "date" => '$tanggal')),
					//"y"   => array('$dayOfYear' => '$tanggal'),
					//"createdAtmonth" => array('$month' => '$tanggal'),
					//"y" => array('$year'=> array( new MongoDate('$timestamp').getFullYear())					),
					'year' => array('$year' => '$tanggal' ),
					'month' => array('$month' => '$tanggal' ),
					'day' => array('$dayOfMonth' => '$tanggal'),
					'hour' => array('$hour' => '$tanggal' ),
					'minutes' => array('$minutes' => '$tanggal'),					
					'tanggalan' => array('$dateToString' => array( 'format' => "%d-%m-%Y", 'date'=>'$tanggal')),
					'nodeid' => '$nodeid',
					'nilai' => '$nilai',
					'kategori' => '$kategori'
				)
			),
			
			array(
				'$group' => array(
					//"_id" => '$kategori',
					"_id" =>  array('kategori' => '$kategori','nodeid' => '$nodeid','tanggalan' => '$tanggalan','year' => '$year', 'month' => '$month', 'day' => '$day'),
					"average" => array('$avg' => '$nilai')
					
				),
			),
			
			array(
			  '$sort' => array(
				  '_id.year' => 1,
				  '_id.month' => 1,
				  '_id.day' => 1
			  ),
			),
			
			
		);
		
		
		
		$wew = $this->mongo_db->aggregate('wsn',  $dimensi3);
		
		//$i=0;
		$data['hasil3d'] = array();
		//echo json_encode($wew['result']['0']);
		foreach ($wew['result'] as $row)
		{
			//echo json_encode($row);
			array_push($data['hasil3d'],$row);
			//$i++;
		}
		//echo json_encode($row);
		//echo $row['_id']['kategori'];
		//echo "<pre>";
		//print_r($data['hasil3d']);
		
		//print_r($wew);
		
		$period = new DatePeriod(
			 new DateTime('2016-11-15'),
			 new DateInterval('P1D'),
			 new DateTime('2017-04-30')
		);
		
		foreach($period as $date){
			//echo $date->format("Ymd") . "<br>";
		}
		
		//echo json_encode($period);
		
		$this->load->view('tampilan', $data);
        
    }
	
	public function duadimensi()
	{
		$dimensi2tanggalnodeid = array(
			
			array(
						
				'$project' => array(
					"_id" => 0,
					//"formattedDate" => array('$dateToString' => array("format" => "%m/%d/%Y %H:%M", "date" => '$tanggal')),
					//"y"   => array('$dayOfYear' => '$tanggal'),
					//"createdAtmonth" => array('$month' => '$tanggal'),
					//"y" => array('$year'=> array( new MongoDate('$timestamp').getFullYear())					),
					'year' => array('$year' => '$tanggal' ),
					'month' => array('$month' => '$tanggal' ),
					'day' => array('$dayOfMonth' => '$tanggal'),
					'tanggalan' => array('$dateToString' => array( 'format' => "%d-%m-%Y", 'date'=>'$tanggal')),
					'nodeid' => '$nodeid',
					'nilai' => '$nilai',
					'kategori' => '$kategori'
				)
			),
			
			array(
				'$group' => array(
					//"_id" => '$kategori',
					"_id" =>  array('tanggalan' => '$tanggalan','nodeid' => '$nodeid'),
					"average" => array('$avg' => '$nilai')
					
				),
			),
			
			 array(
			  '$sort' => array(
				  '_id.year' => 1,
				  '_id.month' => 1,
				  '_id.day' => 1
			  ),
			),
		);
		
		$dimensi2tanggalkategori = array(
			
			array(
						
				'$project' => array(
					"_id" => 0,
					//"formattedDate" => array('$dateToString' => array("format" => "%m/%d/%Y %H:%M", "date" => '$tanggal')),
					//"y"   => array('$dayOfYear' => '$tanggal'),
					//"createdAtmonth" => array('$month' => '$tanggal'),
					//"y" => array('$year'=> array( new MongoDate('$timestamp').getFullYear())					),
					'year' => array('$year' => '$tanggal' ),
					'month' => array('$month' => '$tanggal' ),
					'day' => array('$dayOfMonth' => '$tanggal'),
					'tanggalan' => array('$dateToString' => array( 'format' => "%d-%m-%Y", 'date'=>'$tanggal')),
					'nodeid' => '$nodeid',
					'nilai' => '$nilai',
					'kategori' => '$kategori'
				)
			),
			
			array(
				'$group' => array(
					//"_id" => '$kategori',
					"_id" =>  array('tanggalan' => '$tanggalan','kategori' => '$kategori'),
					"average" => array('$avg' => '$nilai')
					
				),
			),
			
			 array(
			  '$sort' => array(
				  '_id.year' => 1,
				  '_id.month' => 1,
				  '_id.day' => 1
			  ),
			),
		);
		
		$dimensi2kategorinodeid = array(
			
			array(
						
				'$project' => array(
					"_id" => 0,
					//"formattedDate" => array('$dateToString' => array("format" => "%m/%d/%Y %H:%M", "date" => '$tanggal')),
					//"y"   => array('$dayOfYear' => '$tanggal'),
					//"createdAtmonth" => array('$month' => '$tanggal'),
					//"y" => array('$year'=> array( new MongoDate('$timestamp').getFullYear())					),
					'year' => array('$year' => '$tanggal' ),
					'month' => array('$month' => '$tanggal' ),
					'day' => array('$dayOfMonth' => '$tanggal'),
					'tanggalan' => array('$dateToString' => array( 'format' => "%d-%m-%Y", 'date'=>'$tanggal')),
					'nodeid' => '$nodeid',
					'nilai' => '$nilai',
					'kategori' => '$kategori'
				)
			),
			
			array(
				'$group' => array(
					//"_id" => '$kategori',
					"_id" =>  array('kategori' => '$kategori','nodeid' => '$nodeid'),
					"average" => array('$avg' => '$nilai')
					
				),
			),
			
			 array(
			  '$sort' => array(
				  '_id.year' => 1,
				  '_id.month' => 1,
				  '_id.day' => 1
			  ),
			),
		);
		
		
	}
	
	public function satudimensi()
	{
		$dimensi1tanggal = array(
			
			array(
						
				'$project' => array(
					"_id" => 0,
					//"formattedDate" => array('$dateToString' => array("format" => "%m/%d/%Y %H:%M", "date" => '$tanggal')),
					//"y"   => array('$dayOfYear' => '$tanggal'),
					//"createdAtmonth" => array('$month' => '$tanggal'),
					//"y" => array('$year'=> array( new MongoDate('$timestamp').getFullYear())					),
					'year' => array('$year' => '$tanggal' ),
					'month' => array('$month' => '$tanggal' ),
					'day' => array('$dayOfMonth' => '$tanggal'),
					'tanggalan' => array('$dateToString' => array( 'format' => "%d-%m-%Y", 'date'=>'$tanggal')),
					//'nodeid' => '$nodeid',
					'nilai' => '$nilai'
				)
			),
			
			array(
				'$group' => array(
					"_id" => '$tanggalan',
					//"_id" =>  array('year' => '$year', 'month' => '$month', 'day' => '$day','tanggalan' => '$tanggalan'),
					"average" => array('$avg' => '$nilai')
					
				),
			),
			
			 array(
			  '$sort' => array(
				  '_id.year' => 1,
				  '_id.month' => 1,
				  '_id.day' => 1
			  ),
			),
		);
		
		$dimensi1nodeid = array(
			
			array(
						
				'$project' => array(
					"_id" => 0,
					//"formattedDate" => array('$dateToString' => array("format" => "%m/%d/%Y %H:%M", "date" => '$tanggal')),
					//"y"   => array('$dayOfYear' => '$tanggal'),
					//"createdAtmonth" => array('$month' => '$tanggal'),
					//"y" => array('$year'=> array( new MongoDate('$timestamp').getFullYear())					),
					'year' => array('$year' => '$tanggal' ),
					'month' => array('$month' => '$tanggal' ),
					'day' => array('$dayOfMonth' => '$tanggal'),
					'tanggalan' => array('$dateToString' => array( 'format' => "%d-%m-%Y", 'date'=>'$tanggal')),
					'nodeid' => '$nodeid',
					'nilai' => '$nilai'
				)
			),
			
			array(
				'$group' => array(
					"_id" => '$nodeid',
					//"_id" =>  array('year' => '$year', 'month' => '$month', 'day' => '$day','tanggalan' => '$tanggalan'),
					"average" => array('$avg' => '$nilai')
					
				),
			),
			
			 array(
			  '$sort' => array(
				  '_id.year' => 1,
				  '_id.month' => 1,
				  '_id.day' => 1
			  ),
			),
		);
		
		$dimensi1kategori = array(
			
			array(
						
				'$project' => array(
					"_id" => 0,
					//"formattedDate" => array('$dateToString' => array("format" => "%m/%d/%Y %H:%M", "date" => '$tanggal')),
					//"y"   => array('$dayOfYear' => '$tanggal'),
					//"createdAtmonth" => array('$month' => '$tanggal'),
					//"y" => array('$year'=> array( new MongoDate('$timestamp').getFullYear())					),
					'year' => array('$year' => '$tanggal' ),
					'month' => array('$month' => '$tanggal' ),
					'day' => array('$dayOfMonth' => '$tanggal'),
					'tanggalan' => array('$dateToString' => array( 'format' => "%d-%m-%Y", 'date'=>'$tanggal')),
					'nodeid' => '$nodeid',
					'nilai' => '$nilai',
					'kategori' => '$kategori'
				)
			),
			
			array(
				'$group' => array(
					"_id" => '$kategori',
					//"_id" =>  array('year' => '$year', 'month' => '$month', 'day' => '$day','tanggalan' => '$tanggalan'),
					"average" => array('$avg' => '$nilai')
					
				),
			),
			
			 array(
			  '$sort' => array(
				  '_id.year' => 1,
				  '_id.month' => 1,
				  '_id.day' => 1
			  ),
			),
		);
	}
}