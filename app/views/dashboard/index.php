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

$horas=[];
for($h=8;$h<=17;$h++){
$hora=str_pad($h,2,"0",STR_PAD_LEFT).":00";
$horas[]=$hora;
}

$citasPorTipoHora=[];

foreach($citas as $cita){

$fecha=date("Y-m-d",strtotime($cita['fecha_cita']));
if($fecha==$hoy) $citasHoy++;

$tipo=$cita['tipo_examen'] ?? "No definido";
$tiposExamen[$tipo]=($tiposExamen[$tipo]??0)+1;

$hora=date("H:00",strtotime($cita['fecha_cita']));

if(!isset($citasPorTipoHora[$tipo])){
foreach($horas as $h){
$citasPorTipoHora[$tipo][$h]=0;
}
}

if(isset($citasPorTipoHora[$tipo][$hora])){
$citasPorTipoHora[$tipo][$hora]++;
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

$datasets=[];
$colores=["#1E6FB8","#2FBF71","#1FA89A","#0F4C81","#7ED957"];

$i=0;

foreach($citasPorTipoHora as $tipo=>$datos){

$color=$colores[$i % count($colores)];

$datasets[]=[
"label"=>$tipo,
"data"=>array_values($datos),
"borderColor"=>$color,
"backgroundColor"=>$color,
"fill"=>false,
"tension"=>0.4
];

$i++;

}

?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1"></script>

<style>

body{
background:#F7FAFC;
font-family:system-ui;
}

/* CARDS */

/* CARDS */

.card-counter{
background:white;
border:1px solid #E6E6E6;
border-radius:10px;
padding:20px;
display:flex;
align-items:center;
gap:15px;
box-shadow:0 2px 6px rgba(0,0,0,0.04);

opacity:0;
transform:translateY(20px) scale(.96);
animation:cardEntrada .5s ease forwards;
}

.delay-1{animation-delay:.05s;}
.delay-2{animation-delay:.15s;}
.delay-3{animation-delay:.25s;}
.delay-4{animation-delay:.35s;}

@keyframes cardEntrada{
to{
opacity:1;
transform:translateY(0) scale(1);
}
}

/* GRAFICOS */

.chart-box{
background:white;
padding:18px;
border-radius:10px;
border:1px solid #E6E6E6;
margin-bottom:20px;
opacity:0;
}

/* GRAFICOS MEDIOS */

.chart-left{
transform:translateX(-30px);
animation:fadeLeft .6s ease forwards;
}

.chart-delay-1{animation-delay:.15s;}
.chart-delay-2{animation-delay:.25s;}
.chart-delay-3{animation-delay:.35s;}

@keyframes fadeLeft{
to{
opacity:1;
transform:translateX(0);
}
}

/* GRAFICO INFERIOR */

.chart-bottom{
transform:translateY(50px);
animation:fadeUp .6s ease forwards;
animation-delay:.25s;
}

@keyframes fadeUp{
to{
opacity:1;
transform:translateY(0);
}
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

.icon-pacientes{background:#1E6FB8;}
.icon-citas{background:#1FA89A;}
.icon-empresas{background:#0F4C81;}
.icon-hoy{background:#2FBF71;}

.counter-number{
font-size:24px;
font-weight:600;
color:#0F4C81;
}

.timeline{
height:230px;
}

#chartHoras{
height:180px!important;
}

</style>

</head>

<body class="p-3">

<div class="row g-3">

<div class="col-md-3">
<div class="card-counter delay-1">
<div class="icon-box icon-pacientes"><i class="bi bi-person"></i></div>
<div>Pacientes<div class="counter-number" data-target="<?= $totalPacientes ?>">0</div></div>
</div>
</div>

<div class="col-md-3">
<div class="card-counter delay-2">
<div class="icon-box icon-citas"><i class="bi bi-clock-history"></i></div>
<div>Citas<div class="counter-number" data-target="<?= $totalCitas ?>">0</div></div>
</div>
</div>

<div class="col-md-3">
<div class="card-counter delay-3">
<div class="icon-box icon-empresas"><i class="bi bi-building"></i></div>
<div>Empresas<div class="counter-number" data-target="<?= $totalEmpresas ?>">0</div></div>
</div>
</div>

<div class="col-md-3">
<div class="card-counter delay-4">
<div class="icon-box icon-hoy"><i class="bi bi-calendar-check"></i></div>
<div>Citas Hoy<div class="counter-number" data-target="<?= $citasHoy ?>">0</div></div>
</div>
</div>

</div>

<div class="row mt-4">

<div class="col-md-4">
<div class="chart-box chart-left chart-delay-1">
Citas por Tipo de Examen
<canvas id="chartExamen"></canvas>
</div>
</div>

<div class="col-md-4">
<div class="chart-box chart-left chart-delay-2">
Pacientes por EPS
<canvas id="chartEPS"></canvas>
</div>
</div>

<div class="col-md-4">
<div class="chart-box chart-left chart-delay-3">
Pacientes por Edad
<canvas id="chartEdad"></canvas>
</div>
</div>





</div>

<div class="row">

<div class="col-md-12">

<div class="chart-box chart-bottom timeline">

Horas con Más Citas por Tipo de Examen

<canvas id="chartHoras"></canvas>

</div>

</div>

</div>
<canvas></canvas>
<script>

document.addEventListener("DOMContentLoaded", function(){

/* CONTADORES */

const counters=document.querySelectorAll(".counter-number");

counters.forEach(counter=>{

const target=parseInt(counter.dataset.target);
const duration=1200;
let startTime=null;

function animate(timestamp){

if(!startTime) startTime=timestamp;

const progress=timestamp-startTime;
const value=Math.min(Math.floor((progress/duration)*target),target);

counter.textContent=value;

if(progress<duration){
requestAnimationFrame(animate);
}

}

requestAnimationFrame(animate);

});

/* COLORES */

const colores=[
"#1E6FB8",
"#2FBF71",
"#1FA89A",
"#0F4C81",
"#7ED957"
];

/* GRAFICOS */

new Chart(document.getElementById("chartExamen"),{
type:"pie",
data:{
labels:<?=json_encode(array_keys($tiposExamen))?>,
datasets:[{
data:<?=json_encode(array_values($tiposExamen))?>,
backgroundColor:colores
}]
},
options:{
animation:{
animateRotate:true,
animateScale:true,
duration:1500
},
plugins:{legend:{position:"bottom"}}
}
});

new Chart(document.getElementById("chartEPS"),{
type:"doughnut",
data:{
labels:<?=json_encode(array_keys($pacientesEPS))?>,
datasets:[{
data:<?=json_encode(array_values($pacientesEPS))?>,
backgroundColor:colores
}]
},
options:{
animation:{
animateRotate:true,
animateScale:true,
duration:1750
},
plugins:{legend:{position:"bottom"}}
}
});

new Chart(document.getElementById("chartEdad"),{
type:"pie",
data:{
labels:<?=json_encode(array_keys($pacientesEdad))?>,
datasets:[{
data:<?=json_encode(array_values($pacientesEdad))?>,
backgroundColor:colores
}]
},
options:{
animation:{
animateRotate:true,
animateScale:true,
duration:2000
},
plugins:{legend:{position:"bottom"}}
}
});

new Chart(document.getElementById("chartHoras"),{
type:"line",
data:{
labels:<?=json_encode($horas)?>,
datasets:<?=json_encode($datasets)?>
},
options:{
maintainAspectRatio:false,
plugins:{legend:{position:"top"}},
scales:{y:{beginAtZero:true}}
}
});

});

</script>

</body>
</html>