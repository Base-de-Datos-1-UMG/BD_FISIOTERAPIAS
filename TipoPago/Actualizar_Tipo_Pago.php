<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

// Incluir el archivo de conexión
include_once("../includes/connection.php");

// Obtener los datos del formulario
$id_tipo_pago = $_POST['ID_TIPO_PAGO'];
$Tipo_pago = $_POST['Tipo_pago'];
$id_estado = $_POST['ID_ESTADO'];



    //hacemos el sql de update para actualizar la persona
    $sql = "UPDATE BD1_TIPO_PAGO SET TIPO_PAGO = '".$Tipo_pago."', ESTATUS = ".$id_estado." WHERE ID_TIPO_PAGO = ".$id_tipo_pago;


    $sql2 = "COMMIT";//el commit para que se guarden los cambios

    //creamos objetos sql
	$stid = oci_parse($conn, $sql);
	$stid2 = oci_parse($conn, $sql2);

	//ejecutamos los 2 codigos sql
	oci_execute($stid);
	oci_execute($stid2);//el commit siempre debe ser el ultimo que se ejecute para guardar todo lo que hagamos

	//cerramos conexiones
	oci_free_statement($stid);
	oci_free_statement($stid2);
	oci_close($conn);

    //regresar al archivo de consultar personas
	header('Location: ./VerTipos.php');

?>
