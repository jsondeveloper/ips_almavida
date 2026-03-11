<?php
require_once "../../models/Paciente.php";
$p = new Paciente();
$pacientes = $p->listar();
?>

<!DOCTYPE html>
<html>
<head>

<title>Pacientes</title>

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

.table th{
white-space:nowrap;
}

</style>

</head>

<body class="container-fluid mt-4">

<div class="card shadow">

<div class="card-body">

<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">

<h3 class="mb-2">👤 Pacientes</h3>

<a href="crear.php" class="btn btn-primary">
➕ Nuevo Paciente
</a>

</div>

<div class="table-responsive">

<table class="table table-striped table-hover align-middle">

<thead class="table-dark">

<tr>
<th>ID</th>
<th>Nombre</th>
<th>Documento</th>
<th>Celular</th>
<th>EPS</th>
<th class="text-center">Acciones</th>
</tr>

</thead>

<tbody>

<?php foreach($pacientes as $pac){ ?>

<tr>

<td><?= $pac['id'] ?></td>
<td><?= $pac['nombre_completo'] ?></td>
<td><?= $pac['numero_documento'] ?></td>
<td><?= $pac['celular'] ?></td>
<td><?= $pac['eps'] ?></td>

<td class="text-center">

<div class="d-flex justify-content-center flex-wrap gap-1">

<a href="editar.php?id=<?= $pac['id'] ?>" class="btn btn-warning btn-sm">
✏ Editar
</a>

<a href="../../controllers/PacienteController.php?accion=eliminar&id=<?= $pac['id'] ?>" 
class="btn btn-danger btn-sm"
onclick="return confirm('¿Eliminar paciente?')">
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