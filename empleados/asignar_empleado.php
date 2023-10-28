<?php

	error_reporting(E_ALL);
	ini_set('display_errors', '1');

	//Incluir el archivo de conexion
	include_once("../includes/connection.php");

	//Obtenemos el contenido de cada input en el formulario
	$idpuesto = $_POST['idpuesto'];
    $inicio = $_POST['inicio'];
    $id_empleado = $_GET['ID_EMPLEADO'];

	//concatenamos cada variable en el update
    $sql = "INSERT INTO BD1_EMPLEADO_PUESTO (id_empleado, id_puesto, fecha_inicio)
            VALUES ($id_empleado, $idpuesto, TO_DATE('$inicio', 'YYYY-MM-DD'))";

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
	header('Location: ./ver_empleados.php');

?>