<?php


    //Incluir el archivo de conexion
    include_once("../includes/connection.php");
    include_once("../includes/execute_db.php");

    $idcliente = $_POST['ID_CLIENTE'];
    $idhorario = $_POST['ID_HORARIO'];
    $idservicio = $_POST['ID_SERVICIO'];

   

    $sql = "INSERT INTO BD1_CITA (ID_CITA,ID_HORARIO,ID_SERVICIO,ID_ESTADO,ID_CLIENTE,FECHA) 
            VALUES (ID_CITA.NEXTVAL, ".$idhorario.", ".$idservicio.", 1 , ".$idcliente.",SYSDATE)";

    $sql2 = "COMMIT";

    //creamos objetos sql
	$stid = oci_parse($conn, $sql);
	$stid2 = oci_parse($conn, $sql2);

	//ejecutamos los 2 codigos sql
	$insercion_exitosa = oci_execute($stid); // Intenta ejecutar la primera consulta

	if ($insercion_exitosa) {
    	$insercion_exitosa = oci_execute($stid2); // Intenta ejecutar la segunda consulta si la primera fue exitosa
	}

	if ($insercion_exitosa) {
    	echo 'Los datos fueron ingresados con éxito.';
	} else {
    	echo 'Hubo un error al ingresar los datos.';
	}

	oci_free_statement($stid);
	oci_free_statement($stid2);
	oci_close($conn);

	echo $sql;

	//regresar al archivo de ingresar usuario
	header('Location: ./ingresar_cita.php');