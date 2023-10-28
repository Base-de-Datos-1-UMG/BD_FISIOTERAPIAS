<?php

	error_reporting(E_ALL);
	ini_set('display_errors', '1');

	//Incluir el archivo de conexion
	include_once("../includes/connection.php");

	//Obtenemos el contenido de cada input en el formulario
	$idcliente = $_GET['ID_CLIENTE'];
    $tipo_estado = $_GET['TIPO_ESTADO'];

	//concatenamos cada variable en el update
    if($tipo_estado == 'Activo'){   
        $sql = "UPDATE BD1_CLIENTE SET ID_ESTADO = 2 WHERE ID_CLIENTE = $idcliente";
    } else {
        $sql = "UPDATE BD1_CLIENTE SET ID_ESTADO = 1 WHERE ID_CLIENTE = $idcliente";
    }
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
	header('Location: ./ver_clientes.php');

?>