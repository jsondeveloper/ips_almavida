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
"title"=>$cita['nombre_completo'],
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

#calendar{
height:100%;
background:white;
padding:15px;
border-radius:10px;
border:1px solid #E6E6E6;
box-shadow:0 2px 6px rgba(0,0,0,0.04);
}

.fc-toolbar-title{
color:#0F4C81;
font-weight:600;
}

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

/* punto de color */

.punto{
width:8px;
height:8px;
border-radius:50%;
display:inline-block;
margin-right:5px;
}

.modal-header{
background:#1E6FB8;
color:white;
}

/* EVENTOS */

.fc-event{
border:none;
font-size:12px;

cursor:pointer;

/* separación entre citas */
margin-bottom:2px;



/* animación suave */
transition:all .15s ease;
}

.fc-event:hover{
transform:scale(1.03);
}

/* arreglar altura en week y day */

.fc-timegrid-event{
min-height:55px;
padding:4px 6px !important;
}

.fc-timegrid-event .fc-event-main{
white-space:normal;
line-height:1.2;
}

.fc-timegrid-event-harness{
margin-bottom:3px;
}

</style>

</head>

<body>

<div id="calendar"></div>

<!-- MODAL -->

<div class="modal fade" id="modalCita">

<div class="modal-dialog modal-dialog-centered">

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
firstDay:1,
initialView:"dayGridMonth",

height:"100%",

headerToolbar:{
left:"prev,next today",
center:"title",
right:"filtroTipo filtroEmpresa dayGridMonth,timeGridWeek,timeGridDay"
},

events:eventos,

eventContent:function(arg){

var fecha = arg.event.start;

var hora = fecha.toLocaleTimeString('es-CO',{
hour:'numeric',
minute:'2-digit',
hour12:true
});

var paciente = arg.event.extendedProps.paciente;
var tipo = arg.event.extendedProps.tipo;
var color = arg.event.backgroundColor;

var vista = arg.view.type;

var contenedor = document.createElement("div");

contenedor.style.background = color;
contenedor.style.color = "white";
contenedor.style.padding = "4px 6px";
contenedor.style.borderRadius = "6px";
contenedor.style.width = "100%";

if(vista === "dayGridMonth"){

contenedor.innerHTML = `
<b>${hora}</b> ${paciente}
<br>
<span style="font-size:11px;opacity:.9">${tipo}</span>
`;

}else{
contenedor.style.padding = "1px";
contenedor.innerHTML = `
<b>${hora}</b> ${paciente}
<br>
<span style="font-size:11px;opacity:.9">${tipo}</span>
`;

}

return { domNodes:[contenedor] };

},

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