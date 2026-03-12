<?php
require_once "../../middleware/auth.php";
require_once "../../models/Empresa.php";

$empresaModel = new Empresa();
$empresas = $empresaModel->listar();
?>

<!DOCTYPE html>
<html>
<head>

<title>Registrar Paciente</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#f5f7fa;
}

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

</style>

</head>

<body class="container-fluid mt-4">

<div class="card shadow">

<div class="card-body">

<h3 class="mb-4">➕ Registrar Paciente</h3>

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

<select name="empresa_id" class="form-control">

<option value="">-- Sin empresa --</option>

<?php foreach($empresas as $emp){ ?>

<option value="<?= $emp['id'] ?>">
<?= htmlspecialchars($emp['nombre']) ?>
</option>

<?php } ?>

</select>

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

<button type="submit" class="btn btn-success">
💾 Guardar Paciente
</button>

<a href="listar.php" class="btn btn-secondary">
⬅ Volver
</a>

</form>

</div>

</div>

<script>

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

document.getElementById('edadPaciente').value =
calcularEdad(this.value);

});

document.getElementById('formPaciente').addEventListener('submit',function(e){

const form = e.target;
let valido = true;

form.querySelectorAll('input,select').forEach(input=>{

if(!input.checkValidity()){

input.classList.add('is-invalid');
input.classList.remove('is-valid');

if(input.nextElementSibling)
input.nextElementSibling.style.display='block';

valido=false;

}else{

input.classList.remove('is-invalid');
input.classList.add('is-valid');

if(input.nextElementSibling)
input.nextElementSibling.style.display='none';

}

});

if(!valido) e.preventDefault();

});

</script>

</body>
</html>