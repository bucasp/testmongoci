<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coba3 extends CI_Controller{
    //put your code here
    public function index() {
        
        $this->load->library('mongo_db',array('activate' => 'default'), 'mongo_db');
		$this->load->helper('url');

		$period = new DatePeriod(
			 new DateTime('2017-01-01'),
			 new DateInterval('P1M'),
			 new DateTime('2017-05-18')
		);
		
		$datebaru = array();
		$lastdatebaru = array();
		$data['datebaru'] = array();
		$data['hasil3d'] = array();
		foreach($period as $date){
			//echo $date->format("Ymd") . "<br>";
			array_push($datebaru,$date);
		}
		
		//array_push($lastdatebaru,$date);
		//echo json_encode($lastdatebaru);
		//echo $date->format("Ymd") . "<br>";
		
		foreach($period as $date2){
			//echo $date->format("Ymd") . "<br>";
			array_push($data['datebaru'],$date2->format("d-m-Y"));
		}
		array_pop($data['datebaru']);
		
		$jumlahtanggal = count($datebaru);
		
		for($i=0;$i<$jumlahtanggal;$i++)
		{
			//echo $i+1;
			//echo $datebaru;
			if ($i+1 == $jumlahtanggal)
			{
				$datebaru[$i+1] = $date;
			}
			
		}
		
		$data['dimensinode'] = array();
		$ops = array(
			
			array(
				'$group' => array(
					"_id" => array("nodeid" => '$nodeid'),
					
				),
			),
		);		
		$getnodeid = $this->mongo_db->aggregate('wsn',  $ops);
		foreach ($getnodeid['result'] as $row)
		{
			array_push($data['dimensinode'],$row);				
		}
		
		$jumlahnode = count($data['dimensinode']);
		
		
		for ($i=0;$i<$jumlahnode;$i++)
		{
			$nodenya = $data['dimensinode'][$i];
			//echo json_encode($nodenya['_id']);
			$nodenya = $nodenya['_id']['nodeid'];
			
			$dimensi3 = array(
		
				array(
						'$match' => array(
										"nodeid" =>  "$nodenya",
										"kategori" => 'humidity'
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
						"_id" =>  array('kategori' => '$kategori','nodeid' => '$nodeid','year' => '$year', 'month' => '$month'),
						"average" => array('$avg' => '$nilai')
						
					),
				),
				
				array(
				  '$sort' => array(
					  '_id.year' => 1,
					  '_id.month' => 1
					  //'_id.day' => 1
				  ),
				),
			
			
			);
			$wew = $this->mongo_db->aggregate('wsn',  $dimensi3);
			
			
			//echo json_encode($wew['result']);
			$data['hasil3d'][$i] = array();
			foreach ($wew['result'] as $row)
			{
				//echo json_encode($row);
				array_push($data['hasil3d'][$i],$row);
				//$i++;
			}
			//$this->load->view('tampilan', $data);
		}
		
		for ($i=0;$i<$jumlahnode;$i++)
		{
			$nodenya = $data['dimensinode'][$i];
			//echo json_encode($nodenya['_id']);
			$nodenya = $nodenya['_id']['nodeid'];
			
			$dimensi3 = array(
		
				array(
						'$match' => array(
										"nodeid" =>  "$nodenya",
										"kategori" => 'temperature'
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
						"_id" =>  array('kategori' => '$kategori','nodeid' => '$nodeid','year' => '$year', 'month' => '$month'),
						"average" => array('$avg' => '$nilai')
						
					),
				),
				
				array(
				  '$sort' => array(
					  '_id.year' => 1,
					  '_id.month' => 1
					  //'_id.day' => 1
				  ),
				),
			
			
			);
			$wew2 = $this->mongo_db->aggregate('wsn',  $dimensi3);
			
			
			//echo json_encode($wew['result']);
			$data['hasil3d2'][$i] = array();
			foreach ($wew2['result'] as $row)
			{
				//echo json_encode($row);
				array_push($data['hasil3d2'][$i],$row);
				//$i++;
			}
			//$this->load->view('tampilan', $data);
		}
		
		/*
		$dimensi3 = array(
		
				array(
						'$match' => array(
										"nodeid" =>  '41051EF1'
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
						"_id" =>  array('kategori' => '$kategori','nodeid' => '$nodeid','year' => '$year', 'month' => '$month'),
						"average" => array('$avg' => '$nilai')
						
					),
				),
				
				array(
				  '$sort' => array(
					  '_id.year' => 1,
					  '_id.month' => 1
					  //'_id.day' => 1
				  ),
				),
			
			
			);
			$wew = $this->mongo_db->aggregate('wsn',  $dimensi3);
			
			
			echo json_encode($wew['result']);
			foreach ($wew['result'] as $row)
			{
				//echo json_encode($row);
				array_push($data['hasil3d'],$row);
				//$i++;
			}
		*/
		//echo json_encode($date);
		
		
		
		
		
		
		
		//$i=0;
		//$data['hasil3d'] = array();
		//echo json_encode($wew['result']['0']);
		
		//echo json_encode($row);
		//echo $row['_id']['kategori'];
		echo "<pre>";
		//print_r($data['hasil3d']);
		
		//print_r($wew);
		
		
		
		
		
		$this->load->view('tampilan', $data);
        
    }
	
	
	public function pertanggal()
	{
		$this->load->library('mongo_db',array('activate' => 'default'), 'mongo_db');
		$this->load->helper('url');

		$period = new DatePeriod(
			 new DateTime('2017-01-01'),
			 new DateInterval('P1D'),
			 new DateTime('2017-05-18')
		);
		
		$datebaru = array();
		$lastdatebaru = array();
		$data['datebaru'] = array();
		$data['hasil3d'] = array();
		foreach($period as $date){
			//echo $date->format("Ymd") . "<br>";
			array_push($datebaru,$date);
		}
		
		//array_push($lastdatebaru,$date);
		//echo json_encode($lastdatebaru);
		//echo $date->format("Ymd") . "<br>";
		
		foreach($period as $date2){
			//echo $date->format("Ymd") . "<br>";
			array_push($data['datebaru'],$date2->format("d-m-Y"));
		}
		array_pop($data['datebaru']);
		
		$jumlahtanggal = count($datebaru);
		
		for($i=0;$i<$jumlahtanggal;$i++)
		{
			//echo $i+1;
			//echo $datebaru;
			if ($i+1 == $jumlahtanggal)
			{
				$datebaru[$i+1] = $date;
			}
			
		}
		
		$data['dimensinode'] = array();
		$ops = array(
			
			array(
				'$group' => array(
					"_id" => array("nodeid" => '$nodeid'),
					
				),
			),
		);		
		$getnodeid = $this->mongo_db->aggregate('wsn',  $ops);
		foreach ($getnodeid['result'] as $row)
		{
			array_push($data['dimensinode'],$row);				
		}
		
		$jumlahnode = count($data['dimensinode']);
		
		
		for ($i=0;$i<$jumlahnode;$i++)
		{
			$nodenya = $data['dimensinode'][$i];
			//echo json_encode($nodenya['_id']);
			$nodenya = $nodenya['_id']['nodeid'];
			
			$dimensi3 = array(
		
				array(
						'$match' => array(
										"nodeid" =>  "$nodenya",
										"kategori" => 'humidity'
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
						"_id" =>  array('kategori' => '$kategori','nodeid' => '$nodeid','year' => '$year', 'month' => '$month', 'day' => '$day'),
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
			
			
			//echo json_encode($wew['result']);
			$data['hasil3d'][$i] = array();
			foreach ($wew['result'] as $row)
			{
				//echo json_encode($row);
				array_push($data['hasil3d'][$i],$row);
				//$i++;
			}
			//$this->load->view('tampilan', $data);
		}
		
		for ($i=0;$i<$jumlahnode;$i++)
		{
			$nodenya = $data['dimensinode'][$i];
			//echo json_encode($nodenya['_id']);
			$nodenya = $nodenya['_id']['nodeid'];
			
			$dimensi3 = array(
		
				array(
						'$match' => array(
										"nodeid" =>  "$nodenya",
										"kategori" => 'temperature'
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
						"_id" =>  array('kategori' => '$kategori','nodeid' => '$nodeid','year' => '$year', 'month' => '$month', 'day' => '$day'),
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
			$wew2 = $this->mongo_db->aggregate('wsn',  $dimensi3);
			
			
			//echo json_encode($wew['result']);
			$data['hasil3d2'][$i] = array();
			foreach ($wew2['result'] as $row2)
			{
				//echo json_encode($row);
				array_push($data['hasil3d2'][$i],$row2);
				
				//$i++;
			}
			
			//print_r($data['hasil3d2']);
			//$this->load->view('tampilan', $data);
		}
		
		/*
		$dimensi3 = array(
		
				array(
						'$match' => array(
										"nodeid" =>  '41051EF1'
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
						"_id" =>  array('kategori' => '$kategori','nodeid' => '$nodeid','year' => '$year', 'month' => '$month'),
						"average" => array('$avg' => '$nilai')
						
					),
				),
				
				array(
				  '$sort' => array(
					  '_id.year' => 1,
					  '_id.month' => 1
					  //'_id.day' => 1
				  ),
				),
			
			
			);
			$wew = $this->mongo_db->aggregate('wsn',  $dimensi3);
			
			
			echo json_encode($wew['result']);
			foreach ($wew['result'] as $row)
			{
				//echo json_encode($row);
				array_push($data['hasil3d'],$row);
				//$i++;
			}
		*/
		//echo json_encode($date);
		
		
		
		
		
		
		
		//$i=0;
		//$data['hasil3d'] = array();
		//echo json_encode($wew['result']['0']);
		
		//echo json_encode($row);
		//echo $row['_id']['kategori'];
		echo "<pre>";
		//print_r($data['hasil3d']);
		
		//print_r($wew);
		
		
		
		
		
		$this->load->view('tampilan', $data);
	}
	
}