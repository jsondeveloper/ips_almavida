<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
.is-invalid { border-color: #dc3545; }
.is-valid { border-color: #28a745; }
.invalid-feedback { color:#dc3545; display:none; }
</style>
</head>
<body class="bg-light">

<div class="container">
<div class="row justify-content-center mt-5">
<div class="col-md-4">
<div class="card shadow">
<div class="card-body">
<h4 class="text-center mb-3">IPS Alma Vida</h4>
<?php if(isset($_GET['error'])): ?>
<div class="alert alert-danger">
    Credenciales incorrectas para el correo <b><?= htmlspecialchars($_GET['email'] ?? '') ?></b>.
</div>
<?php endif; ?>
<form id="formLogin" action="../controllers/AuthController.php?accion=login" method="POST" novalidate>

<input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
<div class="invalid-feedback">El email es obligatorio y debe ser válido.</div>

<input type="password" name="password" class="form-control mb-3" placeholder="Contraseña" required>
<div class="invalid-feedback">La contraseña es obligatoria.</div>

<button class="btn btn-primary w-100">Ingresar</button>

</form>

<hr>
<a href="register.php" class="btn btn-success w-100">Crear cuenta</a>

</div>
</div>
</div>
</div>
</div>

<script>
document.getElementById('formLogin').addEventListener('submit', function(e){
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
        e.preventDefault();
    }
});
</script>

</body>
</html>