<?php
require_once "../../models/Cita.php";

$c = new Cita();
$citas = $c->listar();

$eventos = [];
$tipos = [];
$empresas = [];

foreach($citas as $cita){

$tipo = $cita['tipo_examen'];
$empresa = $cita['empresa'] ?? "Sin empresa";

$tipos[$tipo] = $tipo;
$empresas[$empresa] = $empresa;

$color="#1E6FB8";

switch($tipo){
case "Sangre": $color="#1E6FB8"; break;
case "Orina": $color="#1FA89A"; break;
case "Rayos X": $color="#0F4C81"; break;
case "Ultrasonido": $color="#2FBF71"; break;
case "Electrocardiograma": $color="#7ED957"; break;
}

$eventos[] = [
"title"=>$tipo." - ".$cita['nombre_completo'],
"start"=>str_replace(" ","T",$cita['fecha_cita']),
"color"=>$color,
"tipo"=>$tipo,
"empresa"=>$empresa,
"paciente"=>$cita['nombre_completo']
];

}
?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

<style>

html,body{
height:100%;
margin:0;
background:#F7FAFC;
font-family:system-ui,-apple-system,Segoe UI,Roboto;
}

/* CONTENEDOR CALENDARIO */

#calendar{
height:100%;
background:white;
padding:15px;
border-radius:10px;
border:1px solid #E6E6E6;
box-shadow:0 2px 6px rgba(0,0,0,0.04);
}

/* HEADER */

.fc-toolbar-title{
color:#0F4C81;
font-weight:600;
}

/* BOTONES */

.fc-button{
background:#1E6FB8 !important;
border:none !important;
}

.fc-button:hover{
background:#0F4C81 !important;
}

.fc-button-primary:not(:disabled).fc-button-active{
background:#0F4C81 !important;
}

/* FILTROS */

.fc-toolbar-chunk select{
margin-left:8px;
padding:5px 8px;
border-radius:6px;
border:1px solid #E6E6E6;
font-size:13px;
background:white;
}

.fc-filtroTipo-button,
.fc-filtroEmpresa-button{
display:none !important;
}

/* EVENTOS */

.fc-event{
border:none;
border-radius:6px;
padding:2px 4px;
font-size:12px;
}

.fc-daygrid-event{
white-space:normal;
}

a{
color:#333 !important;
text-decoration:none;
}

/* MODAL */

.modal-header{
background:#1E6FB8;
color:white;
}

.modal-title{
font-weight:600;
}

</style>

</head>

<body>

<div id="calendar"></div>


<!-- MODAL DETALLE CITA -->

<div class="modal fade" id="modalCita">

<div class="modal-dialog">

<div class="modal-content">

<div class="modal-header">

<h5 class="modal-title">
<i class="bi bi-calendar-event"></i> Detalle de Cita
</h5>

<button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>

</div>

<div class="modal-body">

<p><b><i class="bi bi-person"></i> Paciente:</b> <span id="mPaciente"></span></p>

<p><b><i class="bi bi-clipboard2-pulse"></i> Examen:</b> <span id="mExamen"></span></p>

<p><b><i class="bi bi-building"></i> Empresa:</b> <span id="mEmpresa"></span></p>

<p><b><i class="bi bi-clock"></i> Fecha:</b> <span id="mFecha"></span></p>

</div>

</div>

</div>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>

var eventos = <?= json_encode($eventos) ?>;

var calendar;

document.addEventListener("DOMContentLoaded", function () {

var calendarEl = document.getElementById("calendar");

calendar = new FullCalendar.Calendar(calendarEl, {

locale:"es",

initialView:"dayGridMonth",

height:"100%",

headerToolbar:{
left:"prev,next today",
center:"title",
right:"filtroTipo filtroEmpresa dayGridMonth,timeGridWeek,timeGridDay"
},

events:eventos,

eventClick:function(info){

document.getElementById("mPaciente").innerText = info.event.extendedProps.paciente;
document.getElementById("mExamen").innerText = info.event.extendedProps.tipo;
document.getElementById("mEmpresa").innerText = info.event.extendedProps.empresa;
document.getElementById("mFecha").innerText = info.event.start.toLocaleString();

new bootstrap.Modal(document.getElementById("modalCita")).show();

},

datesSet:function(){

setTimeout(insertarFiltros,50);

}

});

calendar.render();

});


function insertarFiltros(){

if(document.getElementById("filtroTipo")) return;

var toolbar = document.querySelector(".fc-toolbar-chunk:last-child");

var selectTipo = document.createElement("select");
selectTipo.id="filtroTipo";

selectTipo.innerHTML = `
<option value="">Examen</option>
<?php foreach($tipos as $t){ ?>
<option value="<?= $t ?>"><?= $t ?></option>
<?php } ?>
`;

var selectEmpresa = document.createElement("select");
selectEmpresa.id="filtroEmpresa";

selectEmpresa.innerHTML = `
<option value="">Empresa</option>
<?php foreach($empresas as $e){ ?>
<option value="<?= $e ?>"><?= $e ?></option>
<?php } ?>
`;

toolbar.prepend(selectEmpresa);
toolbar.prepend(selectTipo);

selectTipo.addEventListener("change",filtrar);
selectEmpresa.addEventListener("change",filtrar);

}


function filtrar(){

var tipo = document.getElementById("filtroTipo").value;
var empresa = document.getElementById("filtroEmpresa").value;

var filtrados = eventos.filter(function(e){

var ok = true;

if(tipo && e.tipo !== tipo) ok=false;
if(empresa && e.empresa !== empresa) ok=false;

return ok;

});

calendar.removeAllEvents();
calendar.addEventSource(filtrados);

}

</script>

</body>

</html>