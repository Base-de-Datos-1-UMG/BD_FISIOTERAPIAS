<?php


    //Incluir el archivo de conexion
    include_once("../includes/connection.php");
    include_once("../includes/execute_db.php");

    $nombre = $_POST['nombre_servicio'];
    $descripcion = $_POST['descripcion_servicio'];
	$precioservicio = floatval($_POST['precio']);
  
    $sql = "INSERT INTO BD1_SERVICIO (ID_SERVICIO,NOMBRE_SERVICIO,DESCRIPCION_SERVICIO,PRECIO,ESTATUS) 
            VALUES (id_servicio.NEXTVAL, '".$nombre."', '".$descripcion."','".$precioservicio."',1)";

    $sql2 = "COMMIT";
    echo $sql;
    $_SESSION['success_message'] = "El servicio se ha registrado con éxito.";
    //creamos objetos sql
	$stid = oci_parse($conn, $sql);
	$stid2 = oci_parse($conn, $sql2);

	//ejecutamos los 2 codigos sqll
	oci_execute($stid);
	oci_execute($stid2);

	//cerramos conexiones
	oci_free_statement($stid);
	oci_free_statement($stid2);
	oci_close($conn);

	echo $sql;

	//regresar al archivo de ingresar usuario
	header('Location: ./ingresarServicio.php');


