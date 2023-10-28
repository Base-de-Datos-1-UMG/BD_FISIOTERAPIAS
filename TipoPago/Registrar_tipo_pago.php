<?php


    //Incluir el archivo de conexion
    include_once("../includes/connection.php");
    include_once("../includes/execute_db.php");

    $nombre = $_POST['nombre_pago'];
   
  
    $sql = "INSERT INTO BD1_TIPO_PAGO (ID_TIPO_PAGO,TIPO_PAGO,ESTATUS) 
            VALUES (ID_TIPO_PAGO.NEXTVAL, '".$nombre."',1)";

    $sql2 = "COMMIT";
    echo $sql;
    $_SESSION['success_message'] = "El tipo de pago se ha registrado con éxito.";
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
	header('Location: ./IngresoPago.php');