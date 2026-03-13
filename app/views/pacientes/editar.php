<?php
require_once "../../middleware/auth.php";
require_once __DIR__ . "/../../models/Paciente.php";
require_once __DIR__ . "/../../models/Empresa.php";

$p = new Paciente();
$e = new Empresa();

$id = $_GET['id'];
$paciente = $p->obtener($id);
$empresas = $e->listar();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Paciente</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
body {
    background:#f5f7fa;
    font-family: 'Segoe UI', sans-serif;
}

.card {
    border:none;
    border-radius:12px;
    box-shadow:0 2px 6px rgba(0,0,0,0.08);
}

.is-invalid { border-color:#dc3545; }
.is-valid { border-color:#28a745; }

.invalid-feedback {
    color:#dc3545;
    display:none;
}

.form-label {
    font-weight:500;
}

/* Botones */
.btn-success {
    background:#2FBF71;
    border-color:#2FBF71;
    color:white;
}
.btn-success:hover {
    background:#1FA89A;
    border-color:#1FA89A;
}

.btn-secondary {
    background:#E0E0E0;
    border-color:#E0E0E0;
    color:#000;
}
.btn-secondary:hover {
    background:#CFCFCF;
    border-color:#CFCFCF;
}
.btn-guardar {
    background: #2FBF71;
    border-color: #2FBF71;
    color: white;
    font-weight: 500;
}
.btn-guardar:hover {
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
</style>

</head>
<body class="container-fluid mt-4">

<div class="card shadow">
<div class="card-body">

<h3 class="mb-4"><i class="bi bi-pencil-square"></i> Editar Paciente</h3>

<form id="formPaciente" action="../../controllers/PacienteController.php?accion=actualizar" method="POST" novalidate>

<input type="hidden" name="id" value="<?= $paciente['id'] ?>">

<div class="row">

<div class="col-md-6 mb-3">
<label class="form-label">Nombre completo</label>
<input name="nombre" class="form-control" value="<?= $paciente['nombre_completo'] ?>" required>
<div class="invalid-feedback">El nombre es obligatorio.</div>
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Tipo de documento</label>
<select name="tipo_documento" class="form-control" required>
<option value="">-- Seleccione --</option>
<option value="CC" <?= $paciente['tipo_documento']=='CC'?'selected':'' ?>>CC</option>
<option value="TI" <?= $paciente['tipo_documento']=='TI'?'selected':'' ?>>TI</option>
<option value="CE" <?= $paciente['tipo_documento']=='CE'?'selected':'' ?>>CE</option>
</select>
<div class="invalid-feedback">Seleccione un tipo válido.</div>
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Número de documento</label>
<input name="documento" class="form-control" value="<?= $paciente['numero_documento'] ?>" required pattern="\d+">
<div class="invalid-feedback">Debe ser un número válido.</div>
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Empresa</label>
<select name="empresa_id" class="form-control">
<option value="">-- Sin empresa --</option>
<?php foreach($empresas as $emp): ?>
<option value="<?= $emp['id'] ?>" <?= $paciente['empresa_id']==$emp['id']?'selected':'' ?>>
<?= htmlspecialchars($emp['nombre']) ?>
</option>
<?php endforeach; ?>
</select>
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Dirección</label>
<input name="direccion" class="form-control" value="<?= $paciente['direccion'] ?>" required>
<div class="invalid-feedback">La dirección es obligatoria.</div>
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Teléfono</label>
<input name="telefono" class="form-control" value="<?= $paciente['telefono'] ?>" required pattern="\d{7,10}">
<div class="invalid-feedback">7 a 10 dígitos.</div>
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Celular</label>
<input name="celular" class="form-control" value="<?= $paciente['celular'] ?>" required pattern="\d{10}">
<div class="invalid-feedback">10 dígitos.</div>
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Fecha de nacimiento</label>
<input type="date" name="fecha" id="fechaNacimiento" class="form-control" value="<?= $paciente['fecha_nacimiento'] ?>" required>
<div class="invalid-feedback">La fecha es obligatoria.</div>
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Edad</label>
<input name="edad" id="edadPaciente" type="number" class="form-control" value="<?= $paciente['edad'] ?>" readonly>
<div class="invalid-feedback">Edad inválida.</div>
</div>

<div class="col-md-6 mb-3">
<label class="form-label">EPS</label>
<input name="eps" class="form-control" value="<?= $paciente['eps'] ?>" required>
<div class="invalid-feedback">La EPS es obligatoria.</div>
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Contacto de emergencia</label>
<input name="contacto" class="form-control" value="<?= $paciente['contacto_emergencia'] ?>" required>
<div class="invalid-feedback">Obligatorio.</div>
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Parentesco</label>
<input name="parentesco" class="form-control" value="<?= $paciente['parentesco'] ?>" required>
<div class="invalid-feedback">Obligatorio.</div>
</div>

</div>

<div class="mt-3">
    <button type="submit" class="btn btn-guardar me-2">
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
// Calcular edad automáticamente
function calcularEdad(fechaNacimiento){
if(!fechaNacimiento) return '';
const hoy = new Date();
const nacimiento = new Date(fechaNacimiento);
let edad = hoy.getFullYear() - nacimiento.getFullYear();
const m = hoy.getMonth() - nacimiento.getMonth();
if(m < 0 || (m === 0 && hoy.getDate() < nacimiento.getDate())){
    edad--;
}
return edad;
}

document.getElementById('fechaNacimiento').addEventListener('change',function(){
    document.getElementById('edadPaciente').value = calcularEdad(this.value);
});

// Validación de formulario
document.getElementById('formPaciente').addEventListener('submit',function(e){
const form = e.target;
let valido = true;
form.querySelectorAll('input,select').forEach(input=>{
    if(!input.checkValidity()){
        input.classList.add('is-invalid');
        input.classList.remove('is-valid');
        if(input.nextElementSibling) input.nextElementSibling.style.display='block';
        valido=false;
    } else {
        input.classList.remove('is-invalid');
        input.classList.add('is-valid');
        if(input.nextElementSibling) input.nextElementSibling.style.display='none';
    }
});
if(!valido) e.preventDefault();
});
</script>

</body>
</html>