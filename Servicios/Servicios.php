<?php

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    //Incluir el archivo de conexion
    include_once("../includes/session.php");

    //Consultamos la tabla que queremos mostrar en la vista
    $sql = "SELECT ID_SERVICIO,NOMBRE_SERVICIO,DESCRIPCION_SERVICIO,PRECIO FROM BD1_SERVICIO where estatus = 1";

    //usamos db_select para traer multiples filas
    $result = db_select($sql, $conn);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar medicamentos</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <style>
        * {
            font-weight: normal;
        }
    </style>
</head>

<body class="container">

    <div class="d-flex align-items-center" style="justify-content: space-between;">
        <h1 class="mt-2 mb-3">Consulta de servicios</h1>
        <a href="../view-registers/menu.html" class="btn btn-primary">Regresar al menu</a>
        <a href="../Servicios/IngresarServicio.php" class="btn btn-warning mb-3">Insertar Servicio</a>
    </div>
    <table class="table table-striped table-hover ">
        <thead>
            <tr>
                <th scope="col" style="font-weight: bold;">ID</th>
                <th scope="col" style="font-weight: bold;">Nombre del Servicio</th>
                <th scope="col" style="font-weight: bold;">Descripcion del Servicio</th>
                <th scope="col" style="font-weight: bold;">Precio del Servicio</th>
                
            </tr>
        </thead>
        <tbody>
            <!-- Dentro del body hacemos un foreach al arreglo
            e imprimimos cada valor de la consulta a la base de datos
            con los nombres de las columnas en la base de datos -->
            <?php foreach($result as $row): ?>
            <tr>
                <th scope="row"><?= $row['ID_SERVICIO']; ?></th>
                <th><?= $row['NOMBRE_SERVICIO']; ?></th>
                <th><?= $row['DESCRIPCION_SERVICIO'] ?></th>
                <th><?= $row['PRECIO'] ?></th>
                <td>
                    <a href="editar_servicio.php?id=<?= $row['ID_SERVICIO']; ?>" class="btn btn-primary">Modificar</a>
                    <a href="eliminar_servicio.php?id=<?= $row['ID_SERVICIO']; ?>" class="btn btn-danger">Anular</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>