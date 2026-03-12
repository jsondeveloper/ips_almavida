<?php
require_once "../../middleware/auth.php";
require_once "../../models/Cita.php";
require_once "../../models/Paciente.php";

$c = new Cita();
$p = new Paciente();

$id = $_GET['id'];

$cita = $c->obtener($id);
$pacientes = $p->listar();

$examenes = [
"Sangre",
"Orina",
"Rayos X",
"Ultrasonido",
"Electrocardiograma"
];
?>

<!DOCTYPE html>
<html>
<head>

<title>Editar Cita</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{ background:#f5f7fa; }

.card{
border:none;
border-radius:10px;
}

.is-invalid{ border-color:#dc3545; }
.is-valid{ border-color:#28a745; }

.invalid-feedback{
color:#dc3545;
display:none;
}

.hora-disponible{
color:#198754;
font-weight:600;
}

.hora-ocupada{
color:#dc3545;
font-weight:600;
}

</style>

</head>

<body class="container-fluid mt-4">

<div class="card shadow">

<div class="card-body">

<h3 class="mb-4">✏ Editar Cita</h3>

<form id="formCita" action="../../controllers/CitaController.php?accion=actualizar" method="POST" novalidate>

<input type="hidden" name="id" value="<?= $cita['id'] ?>">

<div class="row">

<div class="col-md-6 mb-3">

<label class="form-label">Paciente</label>

<select name="paciente" id="paciente" class="form-control" required>

<option value="">-- Seleccione un paciente --</option>

<?php foreach($pacientes as $pac){ ?>

<option
value="<?= $pac['id'] ?>"
data-empresa="<?= htmlspecialchars($pac['empresa'] ?? '') ?>"
<?= $pac['id']==$cita['paciente_id']?'selected':'' ?>>

<?= $pac['nombre_completo'] ?>

</option>

<?php } ?>

</select>

<div class="invalid-feedback">
Debe seleccionar un paciente.
</div>

</div>


<div class="col-md-6 mb-3">

<label class="form-label">Empresa</label>

<input
name="empresa"
id="empresa"
class="form-control"
value="<?= htmlspecialchars($cita['empresa'] ?? '') ?>"
readonly
required>

<div class="invalid-feedback">
Empresa obligatoria.
</div>

</div>


<div class="col-md-6 mb-3">

<label class="form-label">Tipo de examen</label>

<select name="examen" id="examen" class="form-control" required>

<option value="">-- Seleccione un examen --</option>

<?php foreach($examenes as $exam){ ?>

<option
value="<?= $exam ?>"
<?= $exam==$cita['tipo_examen']?'selected':'' ?>>

<?= $exam ?>

</option>

<?php } ?>

</select>

<div class="invalid-feedback">
Debe seleccionar un tipo de examen.
</div>

</div>


<div class="col-md-6 mb-3">

<label class="form-label">Fecha</label>

<input
type="date"
name="fecha_dia"
id="fecha"
class="form-control"
value="<?= date('Y-m-d', strtotime($cita['fecha_cita'])) ?>"
required>

<div class="invalid-feedback">
Debe seleccionar una fecha.
</div>

</div>


<div class="col-md-6 mb-3">

<label class="form-label">Hora</label>

<select name="fecha" id="hora" class="form-control" required>

<option value="">-- Seleccione una hora --</option>

</select>

<div class="invalid-feedback">
Debe seleccionar una hora disponible.
</div>

</div>

</div>

<button type="submit" class="btn btn-success">
💾 Actualizar
</button>

<a href="listar.php" class="btn btn-secondary">
⬅ Volver
</a>

</form>

</div>

</div>


<script>

// AUTOCOMPLETAR EMPRESA

const pacienteSelect = document.getElementById('paciente');
const empresaInput = document.getElementById('empresa');

pacienteSelect.addEventListener('change',function(){

const empresa =
this.options[this.selectedIndex].dataset.empresa || '';

empresaInput.value = empresa;

});


// FORMATO 12 HORAS

function formato12h(hora){

let h = parseInt(hora.split(':')[0]);

let ampm = h >= 12 ? 'PM' : 'AM';

h = h % 12;

if(h === 0) h = 12;

return h + ':00 ' + ampm;

}


// HORAS DISPONIBLES

const fechaInput = document.getElementById('fecha');
const examenInput = document.getElementById('examen');
const horaSelect = document.getElementById('hora');

const horaActual =
"<?= date('H:i', strtotime($cita['fecha_cita'])) ?>";


function cargarHorasDisponibles(){

const fecha = fechaInput.value;
const examen = examenInput.value;

if(!fecha || !examen) return;

fetch(`../../controllers/CitaController.php?accion=horas_ocupadas&fecha=${fecha}&examen=${examen}`)

.then(res=>res.json())

.then(ocupadas=>{

horaSelect.innerHTML =
'<option value="">-- Seleccione una hora --</option>';

for(let h=8;h<=17;h++){

let hora24 = h.toString().padStart(2,'0') + ':00';

let horaMostrar = formato12h(hora24);

let ocupada = ocupadas.includes(hora24);

let disabled =
ocupada && hora24 != horaActual
? 'disabled'
: '';

let selected =
hora24 == horaActual
? 'selected'
: '';

horaSelect.innerHTML += `
<option
value="${fecha}T${hora24}"
${disabled}
${selected}
class="${ocupada ? 'hora-ocupada' : 'hora-disponible'}"
>

${horaMostrar} ${ocupada ? '(Ocupada)' : '(Disponible)'}

</option>
`;

}

});

}

cargarHorasDisponibles();

fechaInput.addEventListener('change',cargarHorasDisponibles);
examenInput.addEventListener('change',cargarHorasDisponibles);


// VALIDACIÓN

document.getElementById('formCita').addEventListener('submit',function(e){

const form = e.target;
let valido = true;

form.querySelectorAll('input,select').forEach(input=>{

if(!input.checkValidity()){

input.classList.add('is-invalid');
input.classList.remove('is-valid');

const feedback = input.nextElementSibling;

if(feedback && feedback.classList.contains('invalid-feedback')){
feedback.style.display='block';
}

valido=false;

}else{

input.classList.remove('is-invalid');
input.classList.add('is-valid');

const feedback = input.nextElementSibling;

if(feedback && feedback.classList.contains('invalid-feedback')){
feedback.style.display='none';
}

}

});

if(!valido) e.preventDefault();

});

</script>

</body>
</html>