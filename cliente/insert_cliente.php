<?php

    //Incluir el archivo de conexion
    include_once("../includes/connection.php");
    include_once("../includes/execute_db.php");

    $idpersona = $_POST['idpersona'];

    var_dump($_POST);

    $sql = "INSERT INTO BD1_CLIENTE (ID_CLIENTE, ID_ESTADO, ID_PERSONA, ALTA_CLIENTE)
            VALUES (secuencia_cliente.NEXTVAL, 1,  $idpersona, SYSDATE)";

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
	die();
	header('Location: ./create_cliente.php');



?>