<?php
require_once "../../models/Paciente.php";
$p=new Paciente();
$pacientes=$p->listar();
?>

<!DOCTYPE html>
<html>
<head>

<title>Pacientes</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="container mt-4">

<h2>Pacientes</h2>

<a href="crear.php" class="btn btn-primary mb-3">Nuevo Paciente</a>

<table class="table table-bordered">

<tr>
<th>ID</th>
<th>Nombre</th>
<th>Documento</th>
<th>Celular</th>
<th>EPS</th>
<th>Acciones</th>
</tr>

<?php foreach($pacientes as $p){ ?>

<tr>

<td><?= $p['id'] ?></td>
<td><?= $p['nombre_completo'] ?></td>
<td><?= $p['numero_documento'] ?></td>
<td><?= $p['celular'] ?></td>
<td><?= $p['eps'] ?></td>

<td>

<a href="editar.php?id=<?= $p['id'] ?>" class="btn btn-warning">Editar</a>

<a href="../../controllers/PacienteController.php?accion=eliminar&id=<?= $p['id'] ?>" class="btn btn-danger">Eliminar</a>

</td>

</tr>

<?php } ?>

</table>

</body>
</html>