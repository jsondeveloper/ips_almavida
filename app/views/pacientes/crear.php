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

</style>

</head>

<body class="container-fluid mt-4">

<div class="card shadow">

<div class="card-body">

<h3 class="mb-4">➕ Registrar Paciente</h3>

<form action="../../controllers/PacienteController.php?accion=guardar" method="POST">

<div class="row">

<div class="col-md-6 mb-3">
<label class="form-label">Nombre completo</label>
<input name="nombre" class="form-control" placeholder="Nombre completo">
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Tipo de documento</label>
<input name="tipo_documento" class="form-control" placeholder="CC / TI / CE">
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Número de documento</label>
<input name="documento" class="form-control" placeholder="Número documento">
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Dirección</label>
<input name="direccion" class="form-control" placeholder="Dirección">
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Teléfono</label>
<input name="telefono" class="form-control" placeholder="Teléfono">
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Celular</label>
<input name="celular" class="form-control" placeholder="Celular">
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Fecha de nacimiento</label>
<input type="date" name="fecha" class="form-control">
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Edad</label>
<input name="edad" class="form-control" placeholder="Edad">
</div>

<div class="col-md-6 mb-3">
<label class="form-label">EPS</label>
<input name="eps" class="form-control" placeholder="EPS">
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Contacto de emergencia</label>
<input name="contacto" class="form-control" placeholder="Contacto emergencia">
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Parentesco</label>
<input name="parentesco" class="form-control" placeholder="Parentesco">
</div>

</div>

<button class="btn btn-success">
💾 Guardar Paciente
</button>

<a href="listar.php" class="btn btn-secondary">
⬅ Volver
</a>

</form>

</div>

</div>

</body>
</html>