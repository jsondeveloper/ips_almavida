<?php
require_once "../../middleware/auth.php";
require_once __DIR__ . "/../../models/Cita.php";
require_once __DIR__ . "/../../models/Paciente.php";

$c = new Cita();
$p = new Paciente();

$id = $_GET['id'];
$cita = $c->obtener($id);
$pacientes = $p->listar();
?>

<!DOCTYPE html>
<html>
<head>
<title>Editar Cita</title>
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
    <h3 class="mb-4">✏ Editar Cita</h3>

    <form id="formCita" action="../../controllers/CitaController.php?accion=actualizar" method="POST" novalidate>
      <input type="hidden" name="id" value="<?= $cita['id'] ?>">

      <div class="row">

        <div class="col-md-6 mb-3">
          <label class="form-label">Paciente</label>
          <select name="paciente" class="form-control" required>
            <option value="">-- Seleccione un paciente --</option>
            <?php foreach($pacientes as $pac){ ?>
              <option value="<?= $pac['id'] ?>" <?= $pac['id']==$cita['paciente_id']?'selected':'' ?>>
                <?= $pac['nombre_completo'] ?>
              </option>
            <?php } ?>
          </select>
          <div class="invalid-feedback">Debe seleccionar un paciente.</div>
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label">Tipo de examen</label>
          <input name="examen" class="form-control" value="<?= $cita['tipo_examen'] ?>" required>
          <div class="invalid-feedback">El tipo de examen es obligatorio.</div>
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label">Empresa</label>
          <input name="empresa" class="form-control" value="<?= $cita['empresa'] ?>" required>
          <div class="invalid-feedback">La empresa es obligatoria.</div>
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label">Fecha y hora</label>
          <input type="datetime-local" name="fecha" class="form-control" value="<?= date('Y-m-d\TH:i', strtotime($cita['fecha_cita'])) ?>" required>
          <div class="invalid-feedback">Debe seleccionar fecha y hora.</div>
        </div>

      </div>

      <button type="submit" class="btn btn-success">💾 Actualizar</button>
      <a href="listar.php" class="btn btn-secondary">⬅ Volver</a>

    </form>
  </div>
</div>

<script>
document.getElementById('formCita').addEventListener('submit', function(e){
    const form = e.target;
    let valido = true;

    form.querySelectorAll('input, select').forEach(input => {
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