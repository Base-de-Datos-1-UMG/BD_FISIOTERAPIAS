<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

// Incluir el archivo de conexión
include_once("../includes/connection.php");

// Obtener los datos del formulario
$id_cita = $_POST['ID_CITA'];
$id_cliente = $_POST['ID_CLIENTE'];
$id_horario = $_POST['ID_HORARIO'];
$id_servicio = $_POST['ID_SERVICIO'];
$id_estado = $_POST['ID_ESTADO'];



    //hacemos el sql de update para actualizar la persona
    $sql = "UPDATE BD1_CITA SET ID_CLIENTE = ".$id_cliente.", ID_HORARIO = ".$id_horario.", ID_SERVICIO = ".$id_servicio.", ID_ESTADO = ".$id_estado." WHERE ID_CITA = ".$id_cita;


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
	header('Location: ./lista_cita.php');

?>

