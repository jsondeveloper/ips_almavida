<?php
require_once "../../middleware/auth.php";
require_once __DIR__ . "/../../models/Paciente.php";

$p = new Paciente();
$id = $_GET['id'];
$paciente = $p->obtener($id);
?>

<!DOCTYPE html>
<html>
<head>
<title>Editar Paciente</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{ background:#f5f7fa; }
.card{ border:none; border-radius:10px; }
/* Validaciones visuales */
.is-invalid { border-color: #dc3545; }
.is-valid { border-color: #28a745; }
.invalid-feedback { color:#dc3545; display:none; }
</style>
</head>
<body class="container-fluid mt-4">
<div class="card shadow">
  <div class="card-body">
    <h3 class="mb-4">✏ Editar Paciente</h3>

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
          <input name="tipo_documento" class="form-control" value="<?= $paciente['tipo_documento'] ?>" required pattern="CC|TI|CE">
          <div class="invalid-feedback">Ingrese un tipo válido: CC, TI o CE.</div>
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label">Número de documento</label>
          <input name="documento" class="form-control" value="<?= $paciente['numero_documento'] ?>" required pattern="\d+">
          <div class="invalid-feedback">Debe ser un número válido.</div>
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
          <input type="date" name="fecha" class="form-control" value="<?= $paciente['fecha_nacimiento'] ?>" required>
          <div class="invalid-feedback">La fecha es obligatoria.</div>
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label">Edad</label>
          <input name="edad" type="number" min="0" max="120" class="form-control" value="<?= $paciente['edad'] ?>" required>
          <div class="invalid-feedback">Ingrese una edad válida.</div>
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
        <button type="submit" class="btn btn-success">💾 Actualizar</button>
        <a href="listar.php" class="btn btn-secondary">⬅ Volver</a>
      </div>
    </form>
  </div>
</div>

<script>
// Mismo script de validación que funciona en crear.php
document.getElementById('formPaciente').addEventListener('submit', function(e){
    const form = e.target;
    let valido = true;

    form.querySelectorAll('input').forEach(input => {
        if(!input.checkValidity()){
            input.classList.add('is-invalid');
            input.classList.remove('is-valid');
            const feedback = input.nextElementSibling;
            if(feedback && feedback.classList.contains('invalid-feedback')){
                feedback.style.display = 'block';
            }
            valido = false;
        } else {
            input.classList.remove('is-invalid');
            input.classList.add('is-valid');
            const feedback = input.nextElementSibling;
            if(feedback && feedback.classList.contains('invalid-feedback')){
                feedback.style.display = 'none';
            }
        }
    });

    if(!valido){
        e.preventDefault();
    }
});
</script>

</body>
</html>