<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<title>Sistema IPS Alma Vida</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<nav class="navbar navbar-dark bg-primary">
<div class="container">
<span class="navbar-brand mb-0 h1">IPS ALMA VIDA</span>
</div>
</nav>

<div class="container mt-5">

<h2 class="mb-4">Dashboard</h2>

<div class="row">

<!-- MODULO PACIENTES -->

<div class="col-md-4">

<div class="card shadow">

<div class="card-body text-center">

<h4>Pacientes</h4>

<p>Gestión de pacientes registrados</p>

<a href="app/views/pacientes/listar.php" class="btn btn-primary">
Gestionar Pacientes
</a>

</div>

</div>

</div>

<!-- MODULO CITAS -->

<div class="col-md-4">

<div class="card shadow">

<div class="card-body text-center">

<h4>Citas</h4>

<p>Gestión de citas médicas</p>

<a href="app/views/citas/listar.php" class="btn btn-success">
Gestionar Citas
</a>

</div>

</div>

</div>

</div>

</div>

</body>
</html>