<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

// Incluir el archivo de conexión
include_once("../includes/connection.php");


if(isset($_GET['id'])) {
    $id_servicio = $_GET['id'];
    //hacemos el sql de update para actualizar la persona
    $sql = "UPDATE BD1_SERVICIO SET ESTATUS = 5 WHERE ID_SERVICIO = " .$id_servicio;
    //$sql = "DELETE FROM BD1_CITA WHERE ID_CITA = " . $id_cita;


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
	header('Location: ./Servicios.php');
} else {
    $id_servicio = $_POST['ID_SERVICIO'];
    echo "ID_SERVICIO no se ha proporcionado correctamente.".$id_servicio;
}





    

?>
