<?php
require_once "../../middleware/auth.php";
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

/* Estilos para validación */
.is-invalid { border-color: #dc3545; }
.is-valid { border-color: #28a745; }
.invalid-feedback { color:#dc3545; display:none; }

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
<input name="nombre" class="form-control" placeholder="Nombre completo" required>
<div class="invalid-feedback">El nombre es obligatorio.</div>
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Tipo de documento</label>
<input name="tipo_documento" class="form-control" placeholder="CC / TI / CE" required pattern="CC|TI|CE">
<div class="invalid-feedback">Ingrese un tipo válido: CC, TI o CE.</div>
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Número de documento</label>
<input name="documento" class="form-control" placeholder="Número documento" required pattern="\d+">
<div class="invalid-feedback">Debe ser un número válido.</div>
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Dirección</label>
<input name="direccion" class="form-control" placeholder="Dirección" required>
<div class="invalid-feedback">La dirección es obligatoria.</div>
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Teléfono</label>
<input name="telefono" class="form-control" placeholder="Teléfono" required pattern="\d{7,10}">
<div class="invalid-feedback">7 a 10 dígitos.</div>
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Celular</label>
<input name="celular" class="form-control" placeholder="Celular" required pattern="\d{10}">
<div class="invalid-feedback">10 dígitos.</div>
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Fecha de nacimiento</label>
<input type="date" name="fecha" class="form-control" required>
<div class="invalid-feedback">La fecha es obligatoria.</div>
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Edad</label>
<input name="edad" class="form-control" placeholder="Edad" type="number" min="0" max="120" required>
<div class="invalid-feedback">Ingrese una edad válida.</div>
</div>

<div class="col-md-6 mb-3">
<label class="form-label">EPS</label>
<input name="eps" class="form-control" placeholder="EPS" required>
<div class="invalid-feedback">La EPS es obligatoria.</div>
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Contacto de emergencia</label>
<input name="contacto" class="form-control" placeholder="Contacto emergencia" required>
<div class="invalid-feedback">Obligatorio.</div>
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Parentesco</label>
<input name="parentesco" class="form-control" placeholder="Parentesco" required>
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
// Validación de formulario
document.getElementById('formPaciente').addEventListener('submit', function(e){
    const form = e.target;
    let valido = true;

    form.querySelectorAll('input').forEach(input => {
        if(!input.checkValidity()){
            input.classList.add('is-invalid');
            input.classList.remove('is-valid');
            input.nextElementSibling.style.display = 'block';
            valido = false;
        } else {
            input.classList.remove('is-invalid');
            input.classList.add('is-valid');
            input.nextElementSibling.style.display = 'none';
        }
    });

    if(!valido){
        e.preventDefault(); // evita enviar si hay errores
    }
});
</script>

</body>
</html>