<?php

require_once __DIR__ . "/../../models/Paciente.php";

$p = new Paciente();

$id = $_GET['id'];

$paciente = $p->obtener($id);

?>

<!DOCTYPE html>
<html>
<head>

<title>Editar Paciente</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="container mt-4">

<h2>Editar Paciente</h2>

<form action="../../controllers/PacienteController.php?accion=actualizar" method="POST">

<input type="hidden" name="id" value="<?= $paciente['id'] ?>">

<input name="nombre" class="form-control mb-2" value="<?= $paciente['nombre_completo'] ?>">

<input name="tipo_documento" class="form-control mb-2" value="<?= $paciente['tipo_documento'] ?>">

<input name="documento" class="form-control mb-2" value="<?= $paciente['numero_documento'] ?>">

<input name="direccion" class="form-control mb-2" value="<?= $paciente['direccion'] ?>">

<input name="telefono" class="form-control mb-2" value="<?= $paciente['telefono'] ?>">

<input name="celular" class="form-control mb-2" value="<?= $paciente['celular'] ?>">

<input type="date" name="fecha" class="form-control mb-2" value="<?= $paciente['fecha_nacimiento'] ?>">

<input name="edad" class="form-control mb-2" value="<?= $paciente['edad'] ?>">

<input name="eps" class="form-control mb-2" value="<?= $paciente['eps'] ?>">

<input name="contacto" class="form-control mb-2" value="<?= $paciente['contacto_emergencia'] ?>">

<input name="parentesco" class="form-control mb-2" value="<?= $paciente['parentesco'] ?>">

<button class="btn btn-success">Actualizar</button>

<a href="listar.php" class="btn btn-secondary">Volver</a>

</form>

</body>
</html>