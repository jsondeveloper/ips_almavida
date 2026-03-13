<?php
require_once "../../middleware/auth.php";
require_once "../../models/Empresa.php";

$empresaModel = new Empresa();
$empresas = $empresaModel->listar();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Registrar Paciente</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<script>
document.addEventListener("contextmenu", function(e){
e.preventDefault();
});
</script>
<style>
body {
    background: #f5f7fa;
    font-family: 'Segoe UI', sans-serif;
    user-select:none;
-webkit-user-select:none;
-moz-user-select:none;
-ms-user-select:none;
}

.card {
    border:none;
    border-radius:12px;
    box-shadow:0 2px 6px rgba(0,0,0,0.08);
}

/* Inputs */
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
@media (max-width:767px){
    .row > [class*='col-'] { margin-bottom: 1rem; }
}
</style>

</head>

<body class="container-fluid mt-4">

<div class="card shadow">
<div class="card-body">

<h3 class="mb-4"><i class="bi bi-person-plus"></i> Registrar Paciente</h3>

<form id="formPaciente" action="../../controllers/PacienteController.php?accion=guardar" method="POST" novalidate>

<div class="row">

<div class="col-md-6 mb-3">
<label class="form-label">Nombre completo</label>
<input name="nombre" class="form-control" required>
<div class="invalid-feedback">El nombre es obligatorio.</div>
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Tipo de documento</label>
<select name="tipo_documento" class="form-control" required>
<option value="">-- Seleccione --</option>
<option value="CC">CC</option>
<option value="TI">TI</option>
<option value="CE">CE</option>
</select>
<div class="invalid-feedback">Seleccione un tipo válido.</div>
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Número de documento</label>
<input name="documento" class="form-control" required pattern="\d+">
<div class="invalid-feedback">Debe ser un número válido.</div>
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Empresa</label>
<select name="empresa_id" class="form-control" required>
<option value="">-- Seleccione --</option>
<?php foreach($empresas as $emp): ?>
<option value="<?= $emp['id'] ?>"><?= htmlspecialchars($emp['nombre']) ?></option>
<?php endforeach; ?>
</select>
<div class="invalid-feedback">La Empresa es obligatoria.</div>
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Dirección</label>
<input name="direccion" class="form-control" required>
<div class="invalid-feedback">La dirección es obligatoria.</div>
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Teléfono</label>
<input name="telefono" class="form-control" required pattern="\d{7,10}">
<div class="invalid-feedback">7 a 10 dígitos.</div>
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Celular</label>
<input name="celular" id="celular" class="form-control" required pattern="\d{10}">
<div class="invalid-feedback">10 dígitos.</div>
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Fecha de nacimiento</label>
<input type="date" name="fecha" id="fechaNacimiento" class="form-control" required>
<div class="invalid-feedback">La fecha es obligatoria.</div>
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Edad</label>
<input name="edad" id="edadPaciente" class="form-control" type="number" readonly>
<div class="invalid-feedback">Edad inválida.</div>
</div>

<div class="col-md-6 mb-3">
<label class="form-label">EPS</label>
<input name="eps" class="form-control" required>
<div class="invalid-feedback">La EPS es obligatoria.</div>
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Contacto de emergencia</label>
<input name="contacto" class="form-control" placeholder="Número celular contacto emergencia" required>
<div class="invalid-feedback">Obligatorio.</div>
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Parentesco</label>
<input name="parentesco" class="form-control" required>
<div class="invalid-feedback">Obligatorio.</div>
</div>

</div>

<div class="mt-3">
    <button type="submit" class="btn btn-guardar me-2">
        <i class="bi bi-save"></i> Guardar 
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