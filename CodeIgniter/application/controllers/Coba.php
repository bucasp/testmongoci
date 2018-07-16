<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coba extends CI_Controller{
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
					"_id" => array("tanggal" => '$tanggal'),
					
				),
			),
		);
		
		$ops3 = array(
		
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
					'humidity' => '$humidity'
				)
			),
			
			array(
				'$group' => array(
					"_id" =>  array('year' => '$year', 'month' => '$month', 'day' => '$day','tanggalan' => '$tanggalan'),
					"average" => array('$avg' => '$humidity')
					
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
		
		$ops4 = array(
		
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
					'humidity' => '$humidity'
				)
			),
			
			array(
				'$group' => array(
					"_id" =>  array('year' => '$year', 'month' => '$month', 'day' => '$day','tanggalan' => '$tanggalan'),
					"average" => array('$avg' => '$humidity')
					
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
		
		$ops5 = array(
		
			array(
				'$match' => array(
					"nodeid" =>  ('4105210D'),
					//"average" => array('$avg' => '$humidity')
					
				),
			),		
		
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
					'humidity' => '$humidity'
				)
			),
			
			array(
				'$group' => array(
					"_id" =>  array('year' => '$year', 'month' => '$month', 'day' => '$day','tanggalan' => '$tanggalan'),
					"average" => array('$avg' => '$humidity')
					
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
		
		//$res = $this->mongo_db->get_where('humidity',array('_id' => 200));
		$this->mongo_db->where(array('_id' => 200));
		$res = $this->mongo_db->get('humidity');
		
		//$this->mongo_db->set('id','isi');
		//$res = $this->mongo_db->get('humidity'); = $this->mongo_db->get('humidity');
		//$data = $res->result_array();
		//$res = $this->mongo_db->get('humidity');
		
		//$res = $this->mongo_db->count('humidity');
		
		//print_r($res);
		
		echo "<br>";
		
		$we = array('$group' => array("_id" => array("nodeid"=>'$nodeid')));
		//print_r($we);
		
		echo "<br>";
		
		//$res = $this->mongo_db->get('humidity');
		//echo "<pre>";
		//print_r($res);
		
		$wew = $this->mongo_db->aggregate('humidity',  $ops );
		
		$wew2 = array();	
		$wew3 = array();			
		$wew2 = $this->mongo_db->aggregate('humidity',  $ops5);
		//$this->mongo_db->get('humidity');
		
		//echo'coba';
		
		//
		//echo count($wew2['result']);
		$data['tanggalane'] = array();
		$data['nodeidne'] = array();
		echo "<pre>";
		
		//echo $jumlahnodeid;
		
		for ($i=0;$i<count($wew2['result']);$i++)
		{
			echo json_encode($wew2['result'][$i]['_id']['tanggalan']);
			array_push($data['tanggalane'],$wew2['result'][$i]['_id']['tanggalan']);
		}
		
		for ($i=0;$i<count($wew['result']);$i++)
		{
			echo json_encode($wew['result'][$i]['_id']['nodeid']);
			array_push($data['nodeidne'],$wew['result'][$i]['_id']['nodeid']);
		}
		
		$jumlahnodeid = count($data['nodeidne']);
		
		for ($i=0;$i<$jumlahnodeid;$i++)
		{
			$kodeid = $data['nodeidne'][$i];
			$data[$kodeid] = array();
			
					$ops6 = array(
				
							array(
								'$match' => array(
									"nodeid" =>  ("$kodeid"),
									//"average" => array('$avg' => '$humidity')
									
								),
							),		
						
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
									'humidity' => '$humidity'
								)
							),
							
							array(
								'$group' => array(
									"_id" =>  array('year' => '$year', 'month' => '$month', 'day' => '$day','tanggalan' => '$tanggalan'),
									"average" => array('$avg' => '$humidity')
									
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
			$wew3 = $this->mongo_db->aggregate('humidity',  $ops6);
			//print_r($wew3);
			//echo 'wew';
			
			for ($j=0;$j<count($wew3['result']);$j++)
			{
				echo json_encode($wew3['result'][$j]['_id']['tanggalan']);
				array_push($data[$kodeid],$wew3['result'][$j]['_id']['tanggalan']);
			}
			echo 'isinya :'; 
			echo json_encode($data[$kodeid]);
			//array_push($data[kodeid],$wew3['result'][$i]['_id']['nodeid']);
		}
		
		echo json_encode($data['tanggalane']);
		echo json_encode($data['nodeidne']);
		//echo json_encode($wew2['result'][0]);
		
		
		print_r($wew);
		
		//print_r($wew2['result']);
		echo "<br>";
		//echo $data;
		print_r($wew2);
		
		//echo $data['nodeidne'][0];
		
		 $this->load->view('tigadimensi', $data);
        
    }
}