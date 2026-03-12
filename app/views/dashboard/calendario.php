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

$color="#0d6efd";

switch($tipo){
case "Sangre": $color="#dc3545"; break;
case "Orina": $color="#ffc107"; break;
case "Rayos X": $color="#0dcaf0"; break;
case "Ultrasonido": $color="#198754"; break;
case "Electrocardiograma": $color="#6f42c1"; break;
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

<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

<style>

html,body{
height:100%;
margin:0;
background:#f1f4f8;
}

#calendar{
height:100%;
background:white;
padding:10px;
border-radius:10px;
}

.fc-toolbar-chunk select{
margin-left:8px;
padding:4px 6px;
border-radius:6px;
border:1px solid #ccc;
font-size:14px;
}
.fc-filtroTipo-button, .fc-filtroEmpresa-button{
    display:none !important;
}
a{
    color:#000 !important;
}

</style>

</head>

<body>

<div id="calendar"></div>


<!-- MODAL -->

<div class="modal fade" id="modalCita">

<div class="modal-dialog">

<div class="modal-content">

<div class="modal-header">
<h5 class="modal-title">Detalle de Cita</h5>
<button class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">

<p><b>Paciente:</b> <span id="mPaciente"></span></p>
<p><b>Examen:</b> <span id="mExamen"></span></p>
<p><b>Empresa:</b> <span id="mEmpresa"></span></p>
<p><b>Fecha:</b> <span id="mFecha"></span></p>

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