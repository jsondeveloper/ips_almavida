<?php

require_once "../../models/Cita.php";

$c = new Cita();

$citas = $c->listar();

?>

<!DOCTYPE html>
<html>
<head>

<title>Citas</title>

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

<div class="d-flex justify-content-between align-items-center flex-wrap mb-3">

<h3>📅 Citas</h3>

<a href="crear.php" class="btn btn-primary">
➕ Nueva Cita
</a>

</div>

<div class="table-responsive">

<table class="table table-striped table-hover align-middle">

<thead class="table-dark">

<tr>
<th>ID</th>
<th>Paciente</th>
<th>Examen</th>
<th>Empresa</th>
<th>Fecha</th>
<th class="text-center">Acciones</th>
</tr>

</thead>

<tbody>

<?php foreach($citas as $cita){ ?>

<tr>

<td><?= $cita['id'] ?></td>
<td><?= $cita['nombre_completo'] ?></td>
<td><?= $cita['tipo_examen'] ?></td>
<td><?= $cita['empresa'] ?></td>
<td><?= $cita['fecha_cita'] ?></td>

<td class="text-center">

<div class="d-flex justify-content-center flex-wrap gap-1">

<a href="editar.php?id=<?= $cita['id'] ?>" class="btn btn-warning btn-sm">
✏ Editar
</a>

<a href="../../controllers/CitaController.php?accion=eliminar&id=<?= $cita['id'] ?>" 
class="btn btn-danger btn-sm"
onclick="return confirm('¿Eliminar cita?')">
🗑 Eliminar
</a>

</div>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

</body>
</html>