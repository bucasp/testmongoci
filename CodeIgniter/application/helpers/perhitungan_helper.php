<?php // test_helper.php
if(!defined('BASEPATH')) exit('No direct script access allowed');



function ambilnilai($tanggal,$kategori,$tahun)
{
	
    $CI =& get_instance();
	$CI->load->library('mongo_db',array('activate' => 'default'), 'mongo_db');
	
	$ops = array(
			
			array(
				'$group' => array(
					"_id" => array("nodeid" => '$nodeid'),
					
				),
			),
		);
	
	$CI->mongo_db->where(array('tahun' => 2017,'bulan' =>1));
	$wew =$CI->mongo_db->get('wsn');
    //echo json_encode($wew);
	
    return 0;
}



?>