<?php

require_once "../../models/Cita.php";

$c=new Cita();

$citas=$c->listar();

?>

<!DOCTYPE html>
<html>
<head>

<title>Citas</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="container mt-4">

<h2>Citas</h2>

<a href="crear.php" class="btn btn-primary mb-3">Nueva Cita</a>

<table class="table table-bordered">

<tr>
<th>ID</th>
<th>Paciente</th>
<th>Examen</th>
<th>Empresa</th>
<th>Fecha</th>
<th>Acciones</th>
</tr>

<?php foreach($citas as $c){ ?>

<tr>

<td><?= $c['id'] ?></td>
<td><?= $c['nombre_completo'] ?></td>
<td><?= $c['tipo_examen'] ?></td>
<td><?= $c['empresa'] ?></td>
<td><?= $c['fecha_cita'] ?></td>

<td>

<a href="editar.php?id=<?= $c['id'] ?>" class="btn btn-warning">Editar</a>

<a href="../../controllers/CitaController.php?accion=eliminar&id=<?= $c['id'] ?>" class="btn btn-danger">Eliminar</a>

</td>

</tr>

<?php } ?>

</table>

</body>
</html>