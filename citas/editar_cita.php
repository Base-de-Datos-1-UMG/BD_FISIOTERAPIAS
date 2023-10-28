<?php
    include_once('../includes/session.php');
    include_once("../includes/connection.php");

    // Obtener el ID de la cita de la URL
    $id_cita = $_GET['id'];

    // Verificar si se proporcionó un ID de cita válido
    if (!$id_cita || !is_numeric($id_cita)) {
        echo "ID de cita inválido.";
        exit;
    }

    // Consultar la base de datos para obtener los detalles de la cita
    $sql = "SELECT * FROM BD1_CITA WHERE ID_CITA = $id_cita";
    $result = db_select($sql, $conn);

    // Verificar si se encontró la cita
    if (!$result) {
        echo "Cita no encontrada.";
        exit;
    }

    $cita = $result[0];

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

    <h1>Editar Cita</h1>

    <form action="./actualizar_cita.php" method="post">
        <input type="hidden" name="ID_CITA" value="<?= $cita['ID_CITA'] ?>">
        
        <!-- Campo de Cliente -->
        <div class="mb-3">
            <label for="cliente" class="form-label">Cliente</label>
            <select class="form-control" id="cliente" name="ID_CLIENTE">
                <?php foreach ($result_clientes as $cliente): ?>
                    <option value="<?= $cliente['ID_CLIENTE'] ?>" <?= ($cliente['ID_CLIENTE'] == $cita['ID_CLIENTE']) ? 'selected' : '' ?>>
                        <?= $cliente['NOMBRE'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Campo de Servicio -->
        <div class="mb-3">
            <label for="servicio" class="form-label">Servicio</label>
            <select class="form-control" id="servicio" name="ID_SERVICIO">
                <?php foreach ($result_servicios as $servicio): ?>
                    <option value="<?= $servicio['ID_SERVICIO'] ?>" <?= ($servicio['ID_SERVICIO'] == $cita['ID_SERVICIO']) ? 'selected' : '' ?>>
                        <?= $servicio['NOMBRE_SERVICIO'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Campo de Horario -->
        <div class="mb-3">
            <label for="horario" class="form-label">Horario</label>
            <select class="form-control" id="horario" name="ID_HORARIO">
                <?php foreach ($result_horarios as $horario): ?>
                    <option value="<?= $horario['ID_HORARIO'] ?>" <?= ($horario['ID_HORARIO'] == $cita['ID_HORARIO']) ? 'selected' : '' ?>>
                        <?= $horario['HORA_INICIO'] . ' / ' . $horario['HORA_FIN'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Campo de Estado -->
        <div class="mb-3">
            <label for="estado" class="form-label">Estados</label>
            <select class="form-control" id="estado" name="ID_ESTADO">
                <?php foreach ($result_estados as $estado): ?>
                    <option value="<?= $estado['ID_ESTADO'] ?>" <?= ($estado['ID_ESTADO'] == $cita['ID_ESTADO']) ? 'selected' : '' ?>>
                        <?= $estado['TIPO_ESTADO']?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-auto w-100 d-flex justify-content-center" style="gap: 1rem;">
                <input class="btn btn-warning mb-3" id="ingresar" type="submit" value="Guardar Cambios">
                <a href="../citas/lista_cita.php" class="btn btn-primary mb-3">Regresar a la lista</a>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-sEgR2VHzli2L66o67JdYX2PzyC86oqKxV86uSmxszxTpj8FCzmeZfPbFfQ7DabBq" crossorigin="anonymous"></script>
</body>

</html>
