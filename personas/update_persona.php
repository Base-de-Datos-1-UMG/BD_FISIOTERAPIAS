<?php

	error_reporting(E_ALL);
	ini_set('display_errors', '1');

	//Incluir el archivo de conexion
	include_once("../includes/connection.php");

	//Obtenemos el contenido de cada input en el formulario
	$nombre = $_POST['nombre'];
	$segnombre = $_POST['segnombre'];
    $ternombre = $_POST['ternombre'];
	$apellido = $_POST['apellido'];
	$segapellido = $_POST['segapellido'];
    $apecasada = $_POST['apecasada'];
    $birthday = $_POST['birthday'];
    $id_persona = $_GET['ID_PERSONA'];

	//concatenamos cada variable en el update
    $sql = "UPDATE BD1_PERSONA 
            SET NOMBRE1='$nombre', NOMBRE2='$segnombre', NOMBRE3='$ternombre', 
                APELLIDO1='$apellido', APELLIDO2='$segapellido', APELLIDO_CASADA='$apecasada', FECHA_NACIMIENTO=TO_DATE('$birthday', 'YYYY-MM-DD')
            WHERE ID_PERSONA=$id_persona";
	//se realiza commit
	$sql2 = "COMMIT";

	//creamos objetos sql
	$stid = oci_parse($conn, $sql);
	$stid2 = oci_parse($conn, $sql2);

	//ejecutamos los 2 codigos sql
	oci_execute($stid);
	oci_execute($stid2);

	//cerramos conexiones
	oci_free_statement($stid);
	oci_free_statement($stid2);
	oci_close($conn);

	echo $sql;

	//regresar al archivo de ingresar usuario
	header('Location: ./ver_personas.php');

?>