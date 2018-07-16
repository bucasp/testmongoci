<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['mongodb']['host'] = 'localhost'; // your host url or ip address
$config['mongodb']['port'] = 27017; // MongoDB port. You can leave it blank for default port
$config['mongodb']['db'] = 'coba'; // The Database you want to connect to
//username for the DB authentication. Make sure DB user with sufficient authorization has been created. 
//Read https://docs.mongodb.com/manual/reference/command/createUser/#dbcmd.createUser
$config['mongodb']['username'] = ''; 
$config['mongodb']['password'] = ''; //password for the above user
$config['mongodb']['collection'] = 'product'; // collection you want to connect to.