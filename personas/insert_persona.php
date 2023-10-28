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

	//concatenamos cada variable en el insert
	$sql = "INSERT INTO BD1_PERSONA (ID_PERSONA, NOMBRE1, NOMBRE2, NOMBRE3, APELLIDO1, APELLIDO2, APELLIDO_CASADA, FECHA_NACIMIENTO)
            VALUES (SECUENCIA_PERSONA.NEXTVAL, '$nombre', '$segnombre', '$ternombre', '$apellido', '$segapellido', '$apecasada', TO_DATE('$birthday', 'YYYY-MM-DD'))";
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
	die();
	header('Location: ./insert_persona.html');

?>