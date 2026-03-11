<!DOCTYPE html>
<html>
<head>

<title>Login</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container">

<div class="row justify-content-center mt-5">

<div class="col-md-4">

<div class="card shadow">

<div class="card-body">

<h4 class="text-center mb-3">IPS Alma Vida</h4>

<form action="../controllers/AuthController.php?accion=login" method="POST">

<input type="email" name="email" class="form-control mb-3" placeholder="Email">

<input type="password" name="password" class="form-control mb-3" placeholder="Contraseña">

<button class="btn btn-primary w-100">
Ingresar
</button>

</form>

<hr>

<a href="register.php" class="btn btn-success w-100">
Crear cuenta
</a>

</div>

</div>

</div>

</div>

</div>

</body>
</html>