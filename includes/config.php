<?php

session_start();
date_default_timezone_set('America/Los_Angeles');
$config = simplexml_load_file("./includes/config.xml");
$con = new mysqli($config->host, $config->username, $config->password, $config->database);

if($con->connect_errno){
	require_once "./includes/classes/Install.php";
	new Install();
}