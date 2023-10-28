<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');

	$user = 'system'; //usuario de oracle
	$pass = 'umg2'; //password del usuario
	$db = 'localhost/xe'; // nombre por defecto de oracle 19c
	$conn = oci_connect($user, $pass, $db);

//	 if($conn){
//	 	echo "<script>console.log('Conexion hacia ".$db.", exitosa!')</script>";
//	 } else {
//	 	echo "<script>console.log('Conexion hacia ".$db.", fallida')</script>";
//	 }
