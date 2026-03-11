<!DOCTYPE html>
<html>
<head>

<title>Registro</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container">

<div class="row justify-content-center mt-5">

<div class="col-md-4">

<div class="card shadow">

<div class="card-body">

<h4 class="text-center mb-3">Crear Usuario</h4>

<form action="../controllers/AuthController.php?accion=register" method="POST">

<input name="nombre" class="form-control mb-3" placeholder="Nombre">

<input type="email" name="email" class="form-control mb-3" placeholder="Email">

<input type="password" name="password" class="form-control mb-3" placeholder="Contraseña">

<button class="btn btn-success w-100">
Registrar
</button>

</form>
<br>
<?php if(isset($_GET['error'])){ ?>

<div class="alert alert-danger">

<?php
$correo = $_GET['correo'] ?? '';
?>

El correo <b><?= htmlspecialchars($correo) ?></b> ya está registrado.

</div>

<?php } ?>

<a href="login.php" class="btn btn-secondary w-100 mt-2">
Volver al login
</a>

</div>

</div>

</div>

</div>

</div>

</body>
</html>