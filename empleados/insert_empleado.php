<?php

    //Incluir el archivo de conexion
    include_once("../includes/connection.php");
    include_once("../includes/execute_db.php");

    $idpersona = $_POST['idpersona'];
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    var_dump($_POST);

    $sql = "INSERT INTO BD1_EMPLEADO (ID_EMPLEADO, ID_PERSONA, ID_ESTADO, ALTA_CLIENTE, USUARIO, PASSWORD)
    VALUES (secuencia_empleado.NEXTVAL, $idpersona, 1, SYSDATE, '$usuario', '$password')";

    $sql2 = "COMMIT";
    echo $sql;

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
	header('Location: ./create_empleado.php');



?>