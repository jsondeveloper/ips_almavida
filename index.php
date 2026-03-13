<?php
require_once "app/middleware/auth.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Sistema IPS Alma Vida</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<style>

html,body{
height:100%;
margin:0;
background:#F7FAFC;
font-family:system-ui,-apple-system,Segoe UI,Roboto,Ubuntu;
}
footer{
       background: #7ED957;
background: linear-gradient(90deg, rgba(126, 217, 87, 1) 0%, rgba(47, 191, 113, 1) 25%, rgba(31, 168, 154, 1) 50%, rgba(30, 111, 184, 1) 75%, rgba(15, 76, 129, 1) 100%);
    height: 5px;
    position: fixed;
    bottom: 0px;
    width: 100%;
}
/* NAVBAR */

.navbar1{
background: #1E6FB8;
height: 5px !important;
background: linear-gradient(90deg, rgba(30, 111, 184, 1) 0%, rgba(15, 76, 129, 1) 25%, rgba(31, 168, 154, 1) 50%, rgba(47, 191, 113, 1) 75%, rgba(126, 217, 87, 1) 100%);
}

.navbar-brand{
font-weight:600;
}

/* SIDEBAR */

.sidebar{
height:calc(100vh - 16px);
background:#FFFFFF;
border-right:1px solid #E6E6E6;
display:flex;
flex-direction:column;
}

.sidebar a{
color:#333;
text-decoration:none;
display:block;
padding:14px 18px;
font-size:15px;
transition:0.2s;
border-left:3px solid transparent;
}

.sidebar a i{
color:#1E6FB8;
margin-right:8px;
}

.sidebar a:hover{
background:#F4F8FB;
}

.menu-links{
flex:1;
}

.menu-links a.active{
background:#F0F6FC;
border-left:3px solid #1E6FB8;
font-weight:600;
}

/* USUARIO */

.usuario-box{
border-top:1px solid #E6E6E6;
padding:15px 0;
}

.usuario-box .mb-2{
color:#333;
padding:0 18px;
font-size:14px;
}

.usuario-box b{
font-weight:600;
}

.logout-link{
display:block;
color:#555;
text-decoration:none;
font-size:14px;
padding:8px 18px;
transition:0.2s;
}

.logout-link:hover{
background:#F4F8FB;
color:#0F4C81;
}

/* CONTENIDO */

iframe{
width:100%;
height:calc(100vh - 22px);
border:none;
background:white;
}



/* OFFCANVAS */

.offcanvas.sidebar{
background:#FFFFFF;
}

.offcanvas a{
color:#333;
}

.offcanvas a i{
color:#1E6FB8;
margin-right:8px;
}

.logo{
    margin-bottom:1rem;
}

</style>
</head>



<body>

<!-- NAVBAR -->

<nav class="navbar1">


<button class="btn btn-light d-md-none me-3"
data-bs-toggle="offcanvas"
data-bs-target="#menu">

<i class="bi bi-list"></i>

</button>



</div>



</div>

</nav>

<!-- LAYOUT -->

<div class="container-fluid">

<div class="row">

<!-- SIDEBAR PC -->

<div class="col-md-2 sidebar d-none d-md-flex">
    <img class="logo" src="img/logo1.png">

<div class="menu-links">

<a href="app/views/dashboard/index.php" target="contenido">

<i class="bi bi-speedometer2"></i>
Dashboard

</a>

<a href="app/views/empresas/listar.php" target="contenido">

<i class="bi bi-building"></i>
Empresas

</a>

<a href="app/views/pacientes/listar.php" target="contenido">

<i class="bi bi-person"></i>
Pacientes

</a>

<a href="app/views/citas/listar.php" target="contenido">

<i class="bi bi-clock-history"></i>
Citas

</a>

<a href="app/views/dashboard/calendario.php" target="contenido">

<i class="bi bi-calendar3"></i>
Calendario

</a>

</div>


<div class="usuario-box">
<div class="mb-2">

<i class="bi bi-person-circle"></i>
<b><?= htmlspecialchars($_SESSION['usuario']) ?></b>

</div>

<a href="app/auth/logout.php" class="logout-link">

<i class="bi bi-box-arrow-right"></i>
Cerrar sesión

</a>

</div>

</div>

<!-- CONTENIDO -->

<div class="col-md-10 p-0">

<iframe
name="contenido"
src="app/views/dashboard/index.php">

</iframe>

</div>

</div>

</div>

<!-- MENU MOVIL -->

<div class="offcanvas offcanvas-start sidebar" tabindex="-1" id="menu">

<div class="offcanvas-header">

<h5 class="fw-semibold">Menú</h5>

<button
type="button"
class="btn-close"
data-bs-dismiss="offcanvas">

</button>

</div>

<div class="offcanvas-body">

<a class="d-block p-3"
href="app/views/dashboard/index.php"
target="contenido"
onclick="cerrarMenu()">

<i class="bi bi-speedometer2"></i>
Dashboard

</a>

<a class="d-block p-3"
href="app/views/empresas/listar.php"
target="contenido"
onclick="cerrarMenu()">

<i class="bi bi-building"></i>
Empresas

</a>

<a class="d-block p-3"
href="app/views/pacientes/listar.php"
target="contenido"
onclick="cerrarMenu()">

<i class="bi bi-person"></i>
Pacientes

</a>

<a class="d-block p-3"
href="app/views/citas/listar.php"
target="contenido"
onclick="cerrarMenu()">

<i class="bi bi-clock-history"></i>
Citas

</a>

<a class="d-block p-3"
href="app/views/dashboard/calendario.php"
target="contenido"
onclick="cerrarMenu()">

<i class="bi bi-calendar3"></i>
Calendario

</a>

<hr>

<div class="text-center">

<div class="mb-2">

<i class="bi bi-person-circle"></i>
<b><?= htmlspecialchars($_SESSION['usuario']) ?></b>

</div>

<a class="logout-link"
href="app/auth/logout.php"
onclick="cerrarMenu()">

<i class="bi bi-box-arrow-right"></i>
Cerrar sesión

</a>

</div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>

function cerrarMenu(){

var menu = document.getElementById('menu');

var offcanvas = bootstrap.Offcanvas.getInstance(menu);

if(offcanvas) offcanvas.hide();

}

const links = document.querySelectorAll('.menu-links a');

const iframe = document.querySelector('iframe[name="contenido"]');

iframe.addEventListener('load',()=>{

const src = iframe.contentWindow.location.pathname;

links.forEach(link=>link.classList.remove('active'));

links.forEach(link=>{

if(src.endsWith(link.getAttribute('href').replace(/^.*\/app\//,''))){
link.classList.add('active');
}

});

});

</script>
<footer></footer>
</body>
</html>