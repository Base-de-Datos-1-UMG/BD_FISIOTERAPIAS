<?php
    include_once('../includes/session.php');

    $sql2 = "SELECT * FROM BD1_SERVICIO";
    $result2 = db_select($sql2, $conn);

    $sql3 = "SELECT * FROM BD1_HORARIO";
    $result3 = db_select($sql3, $conn);

    $sql4 = "SELECT * FROM BD1_V_CLIENTE";
    $result4 = db_select($sql4, $conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Registrar Cita</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body class="container d-flex flex-column justify-content-center pt-4 pb-4">
    <main class="container">
        <div class="row g-3 form-control">
            <h1 class="mb-4"> Registrar Cita </h1>
        </div>

        <form class="row g-3 form-control" action="./registrar_cita.php" method="post">
            <div class="col-auto">
                <label for="staticEmail2">Nombre del cliente:</label>
                <select name="ID_CLIENTE" id="" class="form-control">
                    <?php foreach ($result4 as $key => $row): ?>
                        <option value=<?= "'".$row['ID_CLIENTE']."'" ?>><?= $row['NOMBRE'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-auto">
                <label for="staticEmail2">Servicio:</label>
                <select name="ID_SERVICIO" id="" class="form-control">
                    <?php foreach ($result2 as $key => $row): ?>
                        <option value=<?= "'".$row['ID_SERVICIO']."'" ?>><?= $row['NOMBRE_SERVICIO'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-auto">
                <label for="">Horario:</label>
                <select name="ID_HORARIO" id="" class="form-control">
                    <?php foreach ($result3 as $key => $row): ?>
                        <option value=<?= "'".$row['ID_HORARIO']."'" ?>><?= $row['HORA_INICIO']. " / " ?><?= $row['HORA_FIN'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-auto w-100 d-flex justify-content-center" style="gap: 1rem;">
                <input class="btn btn-success mb-3" id="ingresar" type="submit" value="Registrar">
                <a href="../view-registers/menu.html" class="btn btn-primary mb-3">Regresar al menu</a>
            </div>

        </form>             


    </main>



                          
    <script type="text/javascript" src="js/jquery-3.2.1.slim.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

</body>

</html>