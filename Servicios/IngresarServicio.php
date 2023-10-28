<?php

    include_once('../includes/session.php');

    $sql2 = "SELECT * FROM BD1_SERVICIO";
    $result2 = db_select($sql2, $conn);

    $sql3 = "SELECT * FROM BD1_HORARIO";
    $result3 = db_select($sql3, $conn);

    $sql4 = "SELECT * FROM BD1_V_CLIENTE";
    $result4 = db_select($sql4, $conn);

   // session_start(); // Asegúrate de iniciar la sesión al comienzo de la página

   if (isset($_SESSION['success_message'])) {
    echo '<div id="success-message" class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
    unset($_SESSION['success_message']);
    echo '<script>
        setTimeout(function() {
            document.getElementById("success-message").style.display = "none";
        }, 3000); // El mensaje se ocultará después de 3 segundos (3000 milisegundos)
    </script>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Registrar Servicio</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</head>

<body class="container d-flex flex-column justify-content-center pt-4 pb-4">
    <main class="container">
        <div class="row g-3 form-control">
            <h1 class="mb-4"> Registro de Servicios</h1>
        </div>
        <form class="row g-3 form-control" action="./registrar_Servicio.php" method="post">
            <div class="col-auto">
                <label for="staticEmail2">Nombre del Servicio</label>
                <input type="text" class="form-control" id="nombre_servicio" name="nombre_servicio" placeholder="Ingresa el nombre del servicio" required>
            </div>
            <div class="col-auto">
                <label for="staticEmail2">Descripcion del Servicio</label>
                <input type="text" class="form-control" id="descripcion_servicio" name="descripcion_servicio" placeholder="Ingresa la descripcion del servicio" required>
            </div>
            <div class="col-auto">
            <label for="precio">Precio</label>
            <input type="number" step="0.01" min="0.01" class="form-control" id="precio" name="precio" placeholder="Ingresa el precio" required>
</div>
            <div class="col-auto w-100 d-flex justify-content-center" style="gap: 1rem;">
                <input class="btn btn-success mb-3" id="ingresar" type="submit" value="Registrar">
                <a href="../view-registers/menu.html" class="btn btn-primary mb-3">Regresar al menu</a>
                <a href="../Servicios/Servicios.php" class="btn btn-warning mb-3">Ver Servicios</a>
            </div>
           

        </form>
    </main>

    <script type="text/javascript" src="js/jquery-3.2.1.slim.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

</body>

</html>