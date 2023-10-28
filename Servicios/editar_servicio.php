<?php
    include_once('../includes/session.php');
    include_once("../includes/connection.php");

    // Obtener el ID de la cita de la URL
    $id_servicio = $_GET['id'];

    // Verificar si se proporcionó un ID de cita válido
    if (!$id_servicio || !is_numeric($id_servicio)) {
        echo "ID de cita inválido.";
        exit;
    }

    // Consultar la base de datos para obtener los detalles de la cita
    $sql = "SELECT * FROM BD1_SERVICIO WHERE ID_SERVICIO = $id_servicio";
    $result = db_select($sql, $conn);

    // Verificar si se encontró la cita
    if (!$result) {
        echo "Servicio no encontrado";
        exit;
    }

    $id_servicio = $result[0];

    // Obtener opciones para los selects
    $sql_clientes = "SELECT * FROM BD1_V_CLIENTE";
    $result_clientes = db_select($sql_clientes, $conn);

    $sql_servicios = "SELECT * FROM BD1_SERVICIO";
    $result_servicios = db_select($sql_servicios, $conn);

    $sql_horarios = "SELECT * FROM BD1_HORARIO";
    $result_horarios = db_select($sql_horarios, $conn);

    $sql_estados = "SELECT * FROM BD1_ESTADO";
    $result_estados = db_select($sql_estados, $conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body class="container">

    <h1>Editar Servicio</h1>

    <form action="./actualizar_servicio.php" method="post">
        <input type="hidden" name="ID_SERVICIO" value="<?= $id_servicio['ID_SERVICIO'] ?>">
        

        <!-- Campo de Servicio -->
        <div class="mb-3">
    <label for="nombre_servicio" class="form-label">Nombre del Servicio</label>
    <input type="text" class="form-control" id="nombre_servicio" name="nombre_servicio" value="<?= $id_servicio['NOMBRE_SERVICIO'] ?>">
    </div>
   <!-- Descripcion del Servicio -->
   <div class="mb-3">
    <label for="descripcion_servicio" class="form-label">Descripción del Servicio</label>
    <input type="text" class="form-control" id="descripcion_servicio" name="descripcion_servicio" value="<?= $id_servicio['DESCRIPCION_SERVICIO'] ?>">
    </div>

        <!-- campo del precio -->
        <div class="mb-3">
    <label for="precio" class="form-label">Precio del Servicio</label>
    <input type="text" class="form-control" id="precio" name="precio" value="<?= $id_servicio['PRECIO'] ?>">
                </div>


       
        <!-- Campo de Estado -->
        <div class="mb-3">
            <label for="estado" class="form-label">Estados</label>
            <select class="form-control" id="estado" name="ID_ESTADO">
                <?php foreach ($result_estados as $estado): ?>
                    <option value="<?= $estado['ID_ESTADO'] ?>" <?= ($estado['ID_ESTADO'] == $id_servicio['ESTATUS']) ? 'selected' : '' ?>>
                        <?= $estado['TIPO_ESTADO']?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-auto w-100 d-flex justify-content-center" style="gap: 1rem;">
                <input class="btn btn-warning mb-3" id="ingresar" type="submit" value="Guardar Cambios">
                <a href="../Servicios/Servicios.php" class="btn btn-primary mb-3">Regresar a la lista</a>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-sEgR2VHzli2L66o67JdYX2PzyC86oqKxV86uSmxszxTpj8FCzmeZfPbFfQ7DabBq" crossorigin="anonymous"></script>
</body>

</html>
