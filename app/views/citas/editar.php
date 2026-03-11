<?php

require_once __DIR__ . "/../../models/Cita.php";
require_once __DIR__ . "/../../models/Paciente.php";

$c = new Cita();
$p = new Paciente();

$id = $_GET['id'];

$cita = $c->obtener($id);

$pacientes = $p->listar();

?>

<!DOCTYPE html>
<html>
<head>

<title>Editar Cita</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="container mt-4">

<h2>Editar Cita</h2>

<form action="../../controllers/CitaController.php?accion=actualizar" method="POST">

<input type="hidden" name="id" value="<?= $cita['id'] ?>">

<select name="paciente" class="form-control mb-2">

<?php foreach($pacientes as $p){ ?>

<option value="<?= $p['id'] ?>" 
<?= $p['id']==$cita['paciente_id']?'selected':'' ?>>

<?= $p['nombre_completo'] ?>

</option>

<?php } ?>

</select>

<input name="examen" class="form-control mb-2" value="<?= $cita['tipo_examen'] ?>">

<input name="empresa" class="form-control mb-2" value="<?= $cita['empresa'] ?>">

<input type="datetime-local" name="fecha" class="form-control mb-2"
value="<?= date('Y-m-d\TH:i', strtotime($cita['fecha_cita'])) ?>">

<button class="btn btn-success">Actualizar</button>

<a href="listar.php" class="btn btn-secondary">Volver</a>

</form>

</body>
</html>