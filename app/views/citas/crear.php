<?php

require_once "../../models/Paciente.php";

$p=new Paciente();

$pacientes=$p->listar();

?>

<!DOCTYPE html>
<html>
<head>

<title>Nueva Cita</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="container mt-4">

<h2>Registrar Cita</h2>

<form action="../../controllers/CitaController.php?accion=guardar" method="POST">

<select name="paciente" class="form-control mb-2">

<?php foreach($pacientes as $p){ ?>

<option value="<?= $p['id'] ?>">

<?= $p['nombre_completo'] ?>

</option>

<?php } ?>

</select>

<input name="examen" class="form-control mb-2" placeholder="Tipo examen">

<input name="empresa" class="form-control mb-2" placeholder="Empresa">

<input type="datetime-local" name="fecha" class="form-control mb-2">

<button class="btn btn-success">Guardar</button>

</form>

</body>
</html>