<?php
require_once "../../models/Paciente.php";
require_once "../../models/Cita.php";
require_once "../../models/Empresa.php";

$p = new Paciente();
$c = new Cita();
$e = new Empresa();

$pacientes = $p->listar();
$citas = $c->listar();
$empresas = $e->listar();

$totalPacientes = count($pacientes);
$totalCitas = count($citas);
$totalEmpresas = count($empresas);

date_default_timezone_set("America/Bogota");
$hoy = date("Y-m-d");

$citasHoy = 0;

$tiposExamen=[];
$pacientesEPS=[];
$pacientesEdad=[
"0-17"=>0,
"18-30"=>0,
"31-40"=>0,
"41-50"=>0,
"50+"=>0
];

$horasCitas=[];

for($h=8;$h<=17;$h++){
$hora=str_pad($h,2,"0",STR_PAD_LEFT).":00";
$horasCitas[$hora]=0;
}

foreach($citas as $cita){

$fecha=date("Y-m-d",strtotime($cita['fecha_cita']));

if($fecha==$hoy) $citasHoy++;

$tipo=$cita['tipo_examen'] ?? "No definido";
$tiposExamen[$tipo]=($tiposExamen[$tipo]??0)+1;

$hora=date("H:00",strtotime($cita['fecha_cita']));

if(isset($horasCitas[$hora])){
$horasCitas[$hora]++;
}

}

foreach($pacientes as $pac){

$eps=$pac['eps'] ?? "Sin EPS";
$pacientesEPS[$eps]=($pacientesEPS[$eps]??0)+1;

$edad=$pac['edad'] ?? 0;

if($edad<=17) $pacientesEdad["0-17"]++;
elseif($edad<=30) $pacientesEdad["18-30"]++;
elseif($edad<=40) $pacientesEdad["31-40"]++;
elseif($edad<=50) $pacientesEdad["41-50"]++;
else $pacientesEdad["50+"]++;

}
?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

body{
background:#f1f4f8;
}

.card-counter{
border-radius:15px;
color:white;
padding:20px;
text-align:center;
}

.bg1{background:#4e73df;}
.bg2{background:#1cc88a;}
.bg3{background:#f6c23e;}
.bg4{background:#e74a3b;}

.chart-box{
background:white;
padding:15px;
border-radius:10px;
}

.chart-title{
font-weight:bold;
margin-bottom:10px;
}

.timeline{
height:150px;
}

</style>

</head>

<body class="p-3">

<div class="row g-3">

<div class="col-md-3">
<div class="card-counter bg1">
<h4>Pacientes</h4>
<h2><?= $totalPacientes ?></h2>
</div>
</div>

<div class="col-md-3">
<div class="card-counter bg2">
<h4>Citas</h4>
<h2><?= $totalCitas ?></h2>
</div>
</div>

<div class="col-md-3">
<div class="card-counter bg3">
<h4>Empresas</h4>
<h2><?= $totalEmpresas ?></h2>
</div>
</div>

<div class="col-md-3">
<div class="card-counter bg4">
<h4>Citas Hoy</h4>
<h2><?= $citasHoy ?></h2>
</div>
</div>

</div>



<div class="row mt-4">

<div class="col-md-4">
<div class="chart-box">
<div class="chart-title">Citas por Tipo de Examen</div>
<canvas id="chartExamen"></canvas>
</div>
</div>

<div class="col-md-4">
<div class="chart-box">
<div class="chart-title">Pacientes por EPS</div>
<canvas id="chartEPS"></canvas>
</div>
</div>

<div class="col-md-4">
<div class="chart-box">
<div class="chart-title">Pacientes por Edad</div>
<canvas id="chartEdad"></canvas>
</div>
</div>

</div>



<div class="row mt-4">

<div class="col-md-12">

<div class="chart-box timeline">

<div class="chart-title">Horas con Más Citas</div>

<canvas id="chartHoras"></canvas>

</div>

</div>

</div>



<script>

const ctxExamen = document.getElementById("chartExamen").getContext("2d");
const ctxEPS = document.getElementById("chartEPS").getContext("2d");
const ctxEdad = document.getElementById("chartEdad").getContext("2d");
const ctxHoras = document.getElementById("chartHoras").getContext("2d");

new Chart(ctxExamen,{
type:"pie",
data:{
labels:<?=json_encode(array_keys($tiposExamen))?>,
datasets:[{
data:<?=json_encode(array_values($tiposExamen))?>,
backgroundColor:["#ff6384","#36a2eb","#ffce56","#4bc0c0","#9966ff"]
}]
}
});


new Chart(ctxEPS,{
type:"doughnut",
data:{
labels:<?=json_encode(array_keys($pacientesEPS))?>,
datasets:[{
data:<?=json_encode(array_values($pacientesEPS))?>,
backgroundColor:["#36a2eb","#ff6384","#4bc0c0","#ffce56","#9966ff"]
}]
}
});


new Chart(ctxEdad,{
type:"pie",
data:{
labels:<?=json_encode(array_keys($pacientesEdad))?>,
datasets:[{
data:<?=json_encode(array_values($pacientesEdad))?>,
backgroundColor:["#ff6384","#36a2eb","#ffce56","#4bc0c0","#9966ff"]
}]
}
});


new Chart(ctxHoras,{
type:"line",
data:{
labels:<?=json_encode(array_keys($horasCitas))?>,
datasets:[{
label:"Cantidad de Citas",
data:<?=json_encode(array_values($horasCitas))?>,
borderColor:"#4e73df",
backgroundColor:"rgba(78,115,223,0.2)",
fill:true,
tension:0.4
}]
},
options:{
maintainAspectRatio:false,
plugins:{
legend:{display:false}
},
scales:{
y:{
beginAtZero:true
}
}
}
});

</script>

</body>
</html>