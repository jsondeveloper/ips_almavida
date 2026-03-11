<?php

require_once "../../models/Paciente.php";
require_once "../../models/Cita.php";

$p = new Paciente();
$c = new Cita();

$totalPacientes = count($p->listar());
$totalCitas = count($c->listar());

date_default_timezone_set("America/Bogota");

$hoy = date("Y-m-d");

$citasHoy = 0;

foreach($c->listar() as $cita){

if(date("Y-m-d", strtotime($cita['fecha_cita'])) == $hoy){
$citasHoy++;
}

}

?>

<!DOCTYPE html>
<html>
<head>

<title>Dashboard</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#f5f7fa;
}

.card{
border:none;
border-radius:12px;
}

.numero{
font-size:32px;
font-weight:bold;
}

</style>

</head>

<body class="container-fluid mt-4">

<h3 class="mb-4">📊 Dashboard</h3>

<div class="row g-3">

<div class="col-md-4">

<div class="card shadow text-center p-4">

<h5>👤 Pacientes</h5>

<div class="numero text-primary">
<?= $totalPacientes ?>
</div>

</div>

</div>

<div class="col-md-4">

<div class="card shadow text-center p-4">

<h5>📅 Citas Totales</h5>

<div class="numero text-success">
<?= $totalCitas ?>
</div>

</div>

</div>

<div class="col-md-4">

<div class="card shadow text-center p-4">

<h5>🩺 Citas Hoy</h5>

<div class="numero text-danger">
<?= $citasHoy ?>
</div>

</div>

</div>

</div>

</body>
</html>