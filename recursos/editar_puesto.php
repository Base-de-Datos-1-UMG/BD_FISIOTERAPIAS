<?php

    // $_POST;
    // $_GET;

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    //Incluir el archivo de conexion
    include_once("../includes/connection.php");
    include_once("../includes/execute_db.php");

    // los datos que pasemos por url, los obtenemos con GET
    $idpuesto = $_GET['ID_PUESTO'];

    //hacemos la consulta con where para traer solo los datos de la persona seleccionada
    $sql = "SELECT * FROM BD1_PUESTO WHERE ID_PUESTO = $idpuesto";

    //con db_fetch hacemos consultas donde solo necesitamos 1 fila
    $result = db_fetch($sql, $conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar puesto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>
<body class="container pb-3">
    <h1 class="mt-3 mb-3">Modificar puesto</h1>
    <!-- aca pasamos nuevamente por la url el id de la persona -->
    <form <?php echo"action='./update_puesto.php?ID_PUESTO=".$idpuesto."'"; ?> method="post">
        <div class="col-auto">
            <label for="staticEmail2">Puesto</label>
            <input type="text" class="form-control" id="puesto" name="puesto" placeholder="Ingresa puesto" <?php echo"value='".$result['PUESTO']."'"; ?> required>
        </div>
        <div class="col-auto">
            <label for="staticEmail2">Descripcion</label>
            <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Ingresa descripcion" <?php echo"value='".$result['DESCRIPCION_PUESTO']."'"; ?> required>
        </div>
            <!-- dentro de cada input con php imprimimos el value de ese input
                 para que al cargar la pagina el formulario aparezca lleno
                 con los datos de la persona que vamos a editar -->
        <div class="col-auto w-100 d-flex" style="justify-content: space-around;">
            <input class="btn btn-success mb-3 mt-3" id="entrar" type="submit" value="Modificar">
            <a href="./ver_puestos.php" class="btn btn-primary mb-3 mt-3">Volver a puestos</a>
        </div>
    </form>



</body>
</html>