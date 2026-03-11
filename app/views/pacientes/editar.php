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

<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#f5f7fa;
}

.card{
border:none;
border-radius:10px;
}

</style>

</head>

<body class="container-fluid mt-4">

<div class="card shadow">

<div class="card-body">

<h3 class="mb-4">✏ Editar Paciente</h3>

<form action="../../controllers/PacienteController.php?accion=actualizar" method="POST">

<input type="hidden" name="id" value="<?= $paciente['id'] ?>">

<div class="row">

<div class="col-md-6 mb-3">
<label class="form-label">Nombre completo</label>
<input name="nombre" class="form-control" value="<?= $paciente['nombre_completo'] ?>">
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Tipo de documento</label>
<input name="tipo_documento" class="form-control" value="<?= $paciente['tipo_documento'] ?>">
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Número de documento</label>
<input name="documento" class="form-control" value="<?= $paciente['numero_documento'] ?>">
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Dirección</label>
<input name="direccion" class="form-control" value="<?= $paciente['direccion'] ?>">
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Teléfono</label>
<input name="telefono" class="form-control" value="<?= $paciente['telefono'] ?>">
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Celular</label>
<input name="celular" class="form-control" value="<?= $paciente['celular'] ?>">
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Fecha de nacimiento</label>
<input type="date" name="fecha" class="form-control" value="<?= $paciente['fecha_nacimiento'] ?>">
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Edad</label>
<input name="edad" class="form-control" value="<?= $paciente['edad'] ?>">
</div>

<div class="col-md-6 mb-3">
<label class="form-label">EPS</label>
<input name="eps" class="form-control" value="<?= $paciente['eps'] ?>">
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Contacto de emergencia</label>
<input name="contacto" class="form-control" value="<?= $paciente['contacto_emergencia'] ?>">
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Parentesco</label>
<input name="parentesco" class="form-control" value="<?= $paciente['parentesco'] ?>">
</div>

</div>

<div class="mt-3">

<button class="btn btn-success">
💾 Actualizar
</button>

<a href="listar.php" class="btn btn-secondary">
⬅ Volver
</a>

</div>

</form>

</div>

</div>

</body>
</html>