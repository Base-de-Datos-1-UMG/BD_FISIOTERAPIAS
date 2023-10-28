<?php

    //Incluir el archivo de conexion
    include_once("../includes/session.php");

    //Consultamos la tabla que queremos mostrar en la vista
    $sql = "SELECT A.ID_CITA,F.NOMBRE1 || ' ' || F.NOMBRE2 || ' ' || F.NOMBRE3 || ' ' || F.APELLIDO1 || ' ' ||F.APELLIDO2 || ' ' || F.APELLIDO_CASADA AS NOMBRE,B.HORA_INICIO,B.HORA_FIN,C.NOMBRE_SERVICIO,D.TIPO_ESTADO FROM BD1_CITA A 
    INNER JOIN BD1_HORARIO B ON A.ID_HORARIO = B.ID_HORARIO
    INNER JOIN BD1_SERVICIO C ON A.ID_SERVICIO = C.ID_SERVICIO
    INNER JOIN BD1_ESTADO D ON A.ID_ESTADO = D.ID_ESTADO
    INNER JOIN BD1_CLIENTE E ON A.ID_CLIENTE = E.ID_CLIENTE
    INNER JOIN BD1_PERSONA F ON E.ID_PERSONA = F.ID_PERSONA
    ORDER BY A.ID_CITA ASC";

    //usamos db_select para traer multiples filas
    $result = db_select($sql, $conn);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas Programadas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
        body {
            font-weight: normal;
        }
    </style>
</head>

<body class="container">

    <div class="d-flex align-items-center justify-content-between mt-2 mb-3">
        <h1>Citas Programadas</h1>
        <a href="../view-registers/menu.html" class="btn btn-primary">Regresar al menu</a>
    </div>
    <table class="table table-striped table-hover">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nombre Cliente</th>
                <th>Hora Inicio</th>
                <th>Hora Fin</th>
                <th>Nombre Servicio</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($result as $row): ?>
            <tr>
                <td><?= $row['ID_CITA']; ?></td>
                <td><?= $row['NOMBRE']; ?></td>
                <td><?= $row['HORA_INICIO'] ?></td>
                <td><?= $row['HORA_FIN']; ?></td>
                <td><?= $row['NOMBRE_SERVICIO']; ?></td>
                <td><?= $row['TIPO_ESTADO'] ?></td>
                <td>
                    <a href="editar_cita.php?id=<?= $row['ID_CITA']; ?>" class="btn btn-primary">Modificar</a>
                    <a href="eliminar_cita.php?id=<?= $row['ID_CITA']; ?>" class="btn btn-danger">Anular</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- JavaScript al final para mejorar el rendimiento de carga -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-sEgR2VHzli2L66o67JdYX2PzyC86oqKxV86uSmxszxTpj8FCzmeZfPbFfQ7DabBq" crossorigin="anonymous"></script>

</body>

</html>
