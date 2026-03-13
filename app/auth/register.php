<!DOCTYPE html>
<html lang="es">
<head>
<title>Registro - IPS Alma Vida</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link rel="icon" href="../../img/icon.png" type="image/png">
<script>
document.addEventListener("contextmenu", function(e){
e.preventDefault();
});
</script>
<style>

body{
background:linear-gradient(135deg,#1FA89A,#2FBF71);
min-height:100vh;
display:flex;
align-items:center;
justify-content:center;
font-family:system-ui,-apple-system,Segoe UI,Roboto;
user-select:none;
-webkit-user-select:none;
-moz-user-select:none;
-ms-user-select:none;
}

.card{
border:none;
border-radius:14px;

background:rgba(255,255,255,0.9);
backdrop-filter:blur(10px);

box-shadow:0 15px 40px rgba(0,0,0,0.25);

animation:fadeIn .6s ease;
}

@keyframes fadeIn{
from{
opacity:0;
transform:translateY(20px);
}
to{
opacity:1;
transform:translateY(0);
}
}

.card-body{
padding:35px;
}

.logo{
width:100%;
display:block;
margin:auto;
margin-bottom:25px;
}

.input-group{
margin-bottom:18px;
}

.input-group-text{
background:#F7FAFC;
border:1px solid #E6E6E6;
border-right:none;
border-radius:8px 0 0 8px;
}

.form-control{
border-radius:0 8px 8px 0;
border:1px solid #E6E6E6;
padding:10px;
}

.form-control:focus{
border-color:#2FBF71;
box-shadow:0 0 0 0.2rem rgba(47,191,113,0.25);
}

.btn-register{
background:#2FBF71;
border:none;
border-radius:8px;
padding:10px;
font-weight:500;
transition:all .2s;
}

.btn-register:hover{
background:#1FA89A;
transform:translateY(-1px);
}

.btn-login{
background:#0F4C81;
border:none;
border-radius:8px;
padding:10px;
font-weight:500;
transition:all .2s;
}

.btn-login:hover{
background:#1E6FB8;
transform:translateY(-1px);
}

.is-invalid{border-color:#dc3545;}
.is-valid{border-color:#2FBF71;}

.invalid-feedback{
color:#dc3545;
display:none;
font-size:0.85rem;
}

</style>
</head>

<body>

<div class="col-md-4">

<div class="card">

<div class="card-body">

<img class="logo" src="../../img/logo2.png">

<form id="formRegister" action="../controllers/AuthController.php?accion=register" method="POST" novalidate>

<div class="input-group">
<span class="input-group-text">
<i class="bi bi-person"></i>
</span>
<input name="nombre" class="form-control" placeholder="Nombre completo" required>
</div>
<div class="invalid-feedback">El nombre es obligatorio.</div>

<div class="input-group">
<span class="input-group-text">
<i class="bi bi-envelope"></i>
</span>
<input type="email" name="email" class="form-control" placeholder="Correo electrónico" required>
</div>
<div class="invalid-feedback">El email es obligatorio y debe ser válido.</div>

<div class="input-group">
<span class="input-group-text">
<i class="bi bi-lock"></i>
</span>
<input type="password" name="password" class="form-control" placeholder="Contraseña (mínimo 6 caracteres)" required minlength="6">
</div>
<div class="invalid-feedback">La contraseña es obligatoria (mínimo 6 caracteres).</div>

<button class="btn btn-register text-white w-100 mt-2">
<i class="bi bi-person-check"></i> Registrar
</button>

</form>

<br>

<?php if(isset($_GET['error'])){ ?>
<div class="alert alert-danger">
<?php $correo = $_GET['correo'] ?? ''; ?>
El correo <b><?= htmlspecialchars($correo) ?></b> ya está registrado.
</div>
<?php } ?>

<a href="login.php" class="btn btn-login text-white w-100 mt-2">
<i class="bi bi-arrow-left"></i> Volver al login
</a>

</div>
</div>

</div>

<script>

document.getElementById('formRegister').addEventListener('submit', function(e){

const form = e.target;
let valido = true;

form.querySelectorAll('input').forEach(input=>{

if(!input.checkValidity()){

input.classList.add('is-invalid');
input.classList.remove('is-valid');

input.parentElement.nextElementSibling.style.display='block';

valido=false;

}else{

input.classList.remove('is-invalid');
input.classList.add('is-valid');

input.parentElement.nextElementSibling.style.display='none';

}

});

if(!valido) e.preventDefault();

});

</script>

</body>
</html>