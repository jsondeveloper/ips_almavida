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
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Cita - IPS Alma Vida</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
body {
    background: #f5f7fa;
    font-family: 'Segoe UI', sans-serif;
}

.card {
    border: none;
    border-radius: 12px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.08);
}

h3 {
    color: #0F4C81;
    font-weight: 600;
}

.form-label {
    font-weight: 500;
    color: #0F4C81;
}

input, select {
    border-radius: 8px;
    border: 1px solid #E6E6E6;
    padding: 6px 10px;
}

.is-invalid { border-color: #dc3545; }
.is-valid { border-color: #2FBF71; }

.invalid-feedback {
    color: #dc3545;
    display: none;
    font-size: 0.85rem;
}

.hora-disponible {
    color: #2FBF71;
    font-weight: 600;
}

.hora-ocupada {
    color: #dc3545;
    font-weight: 600;
}

.btn-actualizar {
    background: #2FBF71;
    border-color: #2FBF71;
    color: white;
    font-weight: 500;
}
.btn-actualizar:hover {
    background: #1FA89A;
    border-color: #1FA89A;
}

.btn-volver {
    background: #0F4C81;
    border-color: #0F4C81;
    color: white;
    font-weight: 500;
}
.btn-volver:hover {
    background: #1E6FB8;
    border-color: #1E6FB8;
}

@media (max-width:767px){
    .row > [class*='col-'] { margin-bottom: 1rem; }
}
</style>

</head>

<body class="container-fluid mt-4">

<div class="card shadow">
<div class="card-body">

<h3 class="mb-4"><i class="bi bi-pencil-square"></i> Editar Cita</h3>

<form id="formCita" action="../../controllers/CitaController.php?accion=actualizar" method="POST" novalidate>

<input type="hidden" name="id" value="<?= $cita['id'] ?>">

<div class="row">

<!-- PACIENTE -->
<div class="col-md-6">
    <label class="form-label">Paciente</label>
    <select name="paciente" id="paciente" class="form-control" required>
        <option value="">-- Seleccione un paciente --</option>
        <?php foreach($pacientes as $pac): ?>
        <option 
            value="<?= $pac['id'] ?>" 
            data-empresa="<?= htmlspecialchars($pac['empresa'] ?? '') ?>"
            <?= $pac['id']==$cita['paciente_id']?'selected':'' ?>>
            <?= $pac['nombre_completo'] ?>
        </option>
        <?php endforeach; ?>
    </select>
    <div class="invalid-feedback">Debe seleccionar un paciente.</div>
</div>

<!-- EMPRESA -->
<div class="col-md-6">
    <label class="form-label">Empresa</label>
    <input name="empresa" id="empresa" class="form-control" value="<?= htmlspecialchars($cita['empresa'] ?? '') ?>" readonly required>
    <div class="invalid-feedback">Empresa obligatoria.</div>
</div>

<!-- EXAMEN -->
<div class="col-md-6">
    <label class="form-label">Tipo de examen</label>
    <select name="examen" id="examen" class="form-control" required>
        <option value="">-- Seleccione un examen --</option>
        <?php foreach($examenes as $exam): ?>
        <option value="<?= $exam ?>" <?= $exam==$cita['tipo_examen']?'selected':'' ?>>
            <?= $exam ?>
        </option>
        <?php endforeach; ?>
    </select>
    <div class="invalid-feedback">Debe seleccionar un tipo de examen.</div>
</div>

<!-- FECHA -->
<div class="col-md-6">
    <label class="form-label">Fecha</label>
    <input type="date" name="fecha_dia" id="fecha" class="form-control" value="<?= date('Y-m-d', strtotime($cita['fecha_cita'])) ?>" required>
    <div class="invalid-feedback">Debe seleccionar una fecha.</div>
</div>

<!-- HORA -->
<div class="col-md-6">
    <label class="form-label">Hora</label>
    <select name="fecha" id="hora" class="form-control" required
        data-hora-actual="<?= date('H:i', strtotime($cita['fecha_cita'])) ?>">
    <option value="">-- Seleccione una hora --</option>
</select>
    <div class="invalid-feedback">Debe seleccionar una hora disponible.</div>
</div>

</div>

<div class="mt-3">
    <button type="submit" class="btn btn-actualizar me-2">
        <i class="bi bi-save"></i> Actualizar
    </button>
    <a href="listar.php" class="btn btn-volver">
        <i class="bi bi-arrow-left"></i> Volver
    </a>
</div>

</form>
</div>
</div>

<script>
// AUTOCOMPLETAR EMPRESA
const pacienteSelect = document.getElementById('paciente');
const empresaInput = document.getElementById('empresa');

pacienteSelect.addEventListener('change', function(){
    const empresa = this.options[this.selectedIndex].dataset.empresa || '';
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
const horaActual = "<?= date('H:i', strtotime($cita['fecha_cita'])) ?>";

function cargarHorasDisponibles(){
    const fecha = fechaInput.value;
    const examen = examenInput.value;
    if(!fecha || !examen) return;

    fetch(`../../controllers/CitaController.php?accion=horas_ocupadas&fecha=${fecha}&examen=${examen}`)
    .then(res => res.json())
    .then(ocupadas => {
        horaSelect.innerHTML = '<option value="">-- Seleccione una hora --</option>';
        for(let h=8; h<=17; h++){
            let hora24 = h.toString().padStart(2,'0') + ':00';
            let horaMostrar = formato12h(hora24);
            let ocupada = ocupadas.includes(hora24);
            let disabled = ocupada && hora24 != horaActual ? 'disabled' : '';
            let selected = hora24 == horaActual ? 'selected' : '';
            horaSelect.innerHTML += `
                <option value="${fecha}T${hora24}" ${disabled} ${selected} class="${ocupada ? 'hora-ocupada' : 'hora-disponible'}">
                    ${horaMostrar} ${ocupada ? '(Ocupada)' : '(Disponible)'}
                </option>
            `;
        }
    });
}

cargarHorasDisponibles();

fechaInput.addEventListener('change', cargarHorasDisponibles);
examenInput.addEventListener('change', cargarHorasDisponibles);

// VALIDACIÓN
document.getElementById('formCita').addEventListener('submit', function(e){
    const form = e.target;
    let valido = true;

    form.querySelectorAll('input,select').forEach(input => {
        if(!input.checkValidity()){
            input.classList.add('is-invalid');
            input.classList.remove('is-valid');
            const feedback = input.nextElementSibling;
            if(feedback && feedback.classList.contains('invalid-feedback')) feedback.style.display='block';
            valido = false;
        } else {
            input.classList.remove('is-invalid');
            input.classList.add('is-valid');
            const feedback = input.nextElementSibling;
            if(feedback && feedback.classList.contains('invalid-feedback')) feedback.style.display='none';
        }
    });

    if(!valido) e.preventDefault();
});
</script>

</body>
</html>