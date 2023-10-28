<?php

    include 'connection.php';
    include 'execute_db.php';

    $user = $_POST['User'];
    $pass = $_POST['Password'];

    $sql = "SELECT 
                P.ID_PERSONA,
                E.USUARIO, 
                E.PASSWORD,
                E.ID_ESTADO
            FROM BD1_EMPLEADO E 
            JOIN BD1_PERSONA P 
                ON (P.ID_PERSONA = E.ID_PERSONA) 
            JOIN BD1_ESTADO ES
                ON (ES.ID_ESTADO = E.ID_ESTADO)
            WHERE 
                E.USUARIO = '$user' 
            AND E.PASSWORD = '$pass'
            AND ES.ID_ESTADO = 1";

	$result = db_fetch($sql, $conn);  

    if($result){

        $_SESSION['idpersona'] = $result['ID_PERSONA'];
        $_SESSION['usuario'] = $result['USUARIO'];
        $_SESSION['password'] = $result['PASSWORD'];  

        $idpersona = $result['ID_PERSONA'];
        $usuario = $result['USUARIO'];
        $password = $result['PASSWORD'];
        $estado = $result['ID_ESTADO'];

        echo ($estado == 1 ? 'activo' : 'inactivo');

    } else{
        echo 'Usuario no encontrado';
        // echo $sql;
    }

    