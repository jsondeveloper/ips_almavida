<?php
require_once "../../middleware/auth.php";
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

<h3 class="mb-4">✏ Editar Cita</h3>

<form action="../../controllers/CitaController.php?accion=actualizar" method="POST">

<input type="hidden" name="id" value="<?= $cita['id'] ?>">

<div class="row">

<div class="col-md-6 mb-3">

<label class="form-label">Paciente</label>

<select name="paciente" class="form-control">

<?php foreach($pacientes as $pac){ ?>

<option value="<?= $pac['id'] ?>" 
<?= $pac['id']==$cita['paciente_id']?'selected':'' ?>>

<?= $pac['nombre_completo'] ?>

</option>

<?php } ?>

</select>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">Tipo de examen</label>

<input name="examen" class="form-control" value="<?= $cita['tipo_examen'] ?>">

</div>

<div class="col-md-6 mb-3">

<label class="form-label">Empresa</label>

<input name="empresa" class="form-control" value="<?= $cita['empresa'] ?>">

</div>

<div class="col-md-6 mb-3">

<label class="form-label">Fecha y hora</label>

<input type="datetime-local" name="fecha" class="form-control"
value="<?= date('Y-m-d\TH:i', strtotime($cita['fecha_cita'])) ?>">

</div>

</div>

<button class="btn btn-success">
💾 Actualizar
</button>

<a href="listar.php" class="btn btn-secondary">
⬅ Volver
</a>

</form>

</div>

</div>

</body>
</html>