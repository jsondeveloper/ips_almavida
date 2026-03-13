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

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

body{
background:#F7FAFC;
font-family:system-ui,-apple-system,Segoe UI,Roboto;
color:#333;
}

/* CARDS INDICADORES */

.card-counter{
background:white;
border:1px solid #E6E6E6;
border-radius:10px;
padding:20px;
display:flex;
align-items:center;
gap:15px;
box-shadow:0 2px 6px rgba(0,0,0,0.04);
}

.icon-box{
width:45px;
height:45px;
display:flex;
align-items:center;
justify-content:center;
border-radius:8px;
font-size:22px;
color:white;
}

.icon-pacientes{ background:#1E6FB8; }
.icon-citas{ background:#1FA89A; }
.icon-empresas{ background:#0F4C81; }
.icon-hoy{ background:#2FBF71; }

.counter-title{
font-size:14px;
color:#666;
margin-bottom:2px;
}

.counter-number{
font-size:22px;
font-weight:600;
color:#0F4C81;
}

/* GRÁFICOS */

.chart-box{
background:white;
padding:18px;
border-radius:10px;
border:1px solid #E6E6E6;
box-shadow:0 2px 6px rgba(0,0,0,0.04);
}

.chart-title{
font-weight:600;
margin-bottom:10px;
color:#0F4C81;
font-size:15px;
}
#chartHoras {
    height: 160px !important;
}
.timeline{
height:210px;
}

</style>

</head>

<body class="p-3">

<div class="row g-3">

<div class="col-md-3">
<div class="card-counter">
<div class="icon-box icon-pacientes">
<i class="bi bi-person"></i>
</div>
<div>
<div class="counter-title">Pacientes</div>
<div class="counter-number"><?= $totalPacientes ?></div>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card-counter">
<div class="icon-box icon-citas">
<i class="bi bi-clock-history"></i>
</div>
<div>
<div class="counter-title">Citas</div>
<div class="counter-number"><?= $totalCitas ?></div>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card-counter">
<div class="icon-box icon-empresas">
<i class="bi bi-building"></i>
</div>
<div>
<div class="counter-title">Empresas</div>
<div class="counter-number"><?= $totalEmpresas ?></div>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card-counter">
<div class="icon-box icon-hoy">
<i class="bi bi-calendar-check"></i>
</div>
<div>
<div class="counter-title">Citas Hoy</div>
<div class="counter-number"><?= $citasHoy ?></div>
</div>
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

const coloresMarca=[
"#1E6FB8",
"#2FBF71",
"#1FA89A",
"#0F4C81",
"#7ED957"
];

const ctxExamen=document.getElementById("chartExamen").getContext("2d");
const ctxEPS=document.getElementById("chartEPS").getContext("2d");
const ctxEdad=document.getElementById("chartEdad").getContext("2d");
const ctxHoras=document.getElementById("chartHoras").getContext("2d");


new Chart(ctxExamen,{
type:"pie",
data:{
labels:<?=json_encode(array_keys($tiposExamen))?>,
datasets:[{
data:<?=json_encode(array_values($tiposExamen))?>,
backgroundColor:coloresMarca
}]
}
});


new Chart(ctxEPS,{
type:"doughnut",
data:{
labels:<?=json_encode(array_keys($pacientesEPS))?>,
datasets:[{
data:<?=json_encode(array_values($pacientesEPS))?>,
backgroundColor:coloresMarca
}]
}
});


new Chart(ctxEdad,{
type:"pie",
data:{
labels:<?=json_encode(array_keys($pacientesEdad))?>,
datasets:[{
data:<?=json_encode(array_values($pacientesEdad))?>,
backgroundColor:coloresMarca
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
borderColor:"#1E6FB8",
backgroundColor:"rgba(30,111,184,0.15)",
fill:true,
tension:0.4
}]
},
options:{
maintainAspectRatio:false,
plugins:{legend:{display:false}},
scales:{y:{beginAtZero:true}}
}
});

</script>

</body>
</html>