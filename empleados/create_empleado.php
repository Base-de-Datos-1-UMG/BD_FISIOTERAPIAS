<?php

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    //Incluir el archivo de conexion
    include_once("../includes/connection.php");
    include_once("../includes/execute_db.php");

    $sql = "SELECT * FROM BD1_PERSONA WHERE ID_PERSONA NOT IN (SELECT ID_PERSONA FROM BD1_EMPLEADO)";
    $sql2 = "SELECT * FROM BD1_PUESTO";

    $result = db_select($sql, $conn);
    $result2 = db_select($sql2, $conn);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fisioterapia UMG</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>

<body class="container d-flex flex-column justify-content-center" style="min-height: 100vh;">

    <h1 class="mb-4">Creacion de usuario</h1>
    <form class="row g-3 form-control" action="./insert_empleado.php" method="post">
        <div class="col-auto">
            <label for="inputPassword2">Seleccionar persona</label>
            <select class="form-select" aria-label="Default select example" name="idpersona">
                <?php foreach($result as $row): ?>
                    <option value=<?= '"'.$row['ID_PERSONA'].'"' ?>><?= $row['NOMBRE1']." ".$row['NOMBRE2']." ".$row['APELLIDO1']." ".$row['APELLIDO2'] ?></option>
                <?php endforeach; ?>
			</select>
        </div>
        <div class="col-auto">
            <label for="">Usuario</label>
            <input type="text" class="form-control" name="usuario" placeholder="Ingresa el usuario" required>
        </div>
        <div>
            <label for="">Contraseña</label>
            <input type="password" class="form-control" name="password" placeholder="Ingresa el password" maxlength="10" required>
        </div>
        <div class="col-auto w-100 d-flex" style="justify-content: space-around;">
            <input class="btn btn-success mb-3" id="entrar" type="submit" value="Registrar">
            <a href="../menu.html" class="btn btn-primary mb-3">Regresar al menu</a>
        </div>
    </form>
</body>

</html>