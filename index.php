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

<style>

html,body{
height:100%;
margin:0;
}

.sidebar{
height:calc(100vh - 50px);
background:#0d6efd;
color:white;
display:flex;
flex-direction:column;
}

.sidebar a{
color:white;
text-decoration:none;
display:block;
padding:14px 18px;
font-size:17px;
transition:0.2s;
}

.sidebar a:hover{
background:#084298;
}

.menu-links{
flex:1;
}

.usuario-box{
border-top:2px solid rgba(255,255,255,0.25);
padding:15px 0 15px 0;
}
.usuario-box .mb-2{
color:white;
text-decoration:none;
display:block;
padding:0 18px;
font-size:17px;
transition:0.2s;
}

.usuario-box b{
font-size:15px;
}

iframe{
width:100%;
height:calc(100vh - 50px);
border:none;
}

.logout-link{
display:block;
color:white;
text-decoration:none;
font-size:15px;
padding:8px 12px;
transition:0.2s;
}

.logout-link:hover{
background:#084298;
color:white;
}

#fecha{
font-size:14px;
opacity:0.9;
}

#hora{
font-size:16px;
letter-spacing:1px;
}

.reloj-icono{
display:inline-block;
animation:rotarReloj 2s linear infinite;
}

@keyframes rotarReloj{
0%{ transform:rotate(0deg); }
100%{ transform:rotate(360deg); }
}

</style>

</head>
<script>

function actualizarReloj(){

const ahora = new Date();

const opcionesFecha = {
weekday:'short',
year:'numeric',
month:'short',
day:'numeric'
};

let fecha = ahora.toLocaleDateString('es-ES',opcionesFecha);

let hora = ahora.toLocaleTimeString('es-ES',{
hour:'2-digit',
minute:'2-digit',
second:'2-digit'
});

document.getElementById("fecha").innerHTML = "📅 " + fecha;

document.getElementById("hora").innerHTML = hora;

}

setInterval(actualizarReloj,1000);

actualizarReloj();

</script>
<body>

<!-- NAVBAR -->

<nav class="navbar navbar-dark bg-primary">

<div class="container-fluid">

<div class="d-flex align-items-center">

<button class="btn btn-light d-md-none me-3" data-bs-toggle="offcanvas" data-bs-target="#menu">
☰
</button>

<span class="navbar-brand mb-0 h1">IPS Alma Vida</span>

</div>

<div class="d-flex align-items-center text-white gap-3">

<div id="fecha" class="fw-semibold"></div>

<div class="d-flex align-items-center gap-2">

<span class="reloj-icono">🕒</span>

<div id="hora" class="fw-bold"></div>

</div>

</div>

</div>

</nav>

<!-- LAYOUT PRINCIPAL -->

<div class="container-fluid">
<div class="row">

<!-- SIDEBAR PC -->

<div class="col-md-2 sidebar d-none d-md-flex">

<div class="menu-links">

<a href="app/views/dashboard/index.php" target="contenido">
📊 Dashboard
</a>

<a href="app/views/pacientes/listar.php" target="contenido">
👤 Pacientes
</a>

<a href="app/views/citas/listar.php" target="contenido">
📅 Citas
</a>

</div>

<div class="usuario-box">

<div class="mb-2">
👤 <b><?= htmlspecialchars($_SESSION['usuario']) ?></b>
</div>

<a href="app/auth/logout.php" class="logout-link">
🔓 Cerrar sesión
</a>

</div>

</div>

<!-- CONTENIDO -->

<div class="col-md-10 p-0">

<iframe name="contenido" src="app/views/dashboard/index.php"></iframe>

</div>

</div>
</div>

<!-- MENU MOVIL -->

<div class="offcanvas offcanvas-start sidebar" tabindex="-1" id="menu">

<div class="offcanvas-header">

<h5>Menú</h5>

<button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>

</div>

<div class="offcanvas-body">

<a class="d-block p-3 text-white"
href="app/views/dashboard/index.php"
target="contenido"
onclick="cerrarMenu()">
📊 Dashboard
</a>

<a class="d-block p-3 text-white"
href="app/views/pacientes/listar.php"
target="contenido"
onclick="cerrarMenu()">
👤 Pacientes
</a>

<a class="d-block p-3 text-white"
href="app/views/citas/listar.php"
target="contenido"
onclick="cerrarMenu()">
📅 Citas
</a>

<hr>

<div class="text-center">

<div class="mb-2">
👤 <b><?= htmlspecialchars($_SESSION['usuario']) ?></b>
</div>

<a class="logout-link"
href="app/auth/logout.php"
onclick="cerrarMenu()">
🔓 Cerrar sesión
</a>

</div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>

function cerrarMenu(){

var menu = document.getElementById('menu');

var offcanvas = bootstrap.Offcanvas.getInstance(menu);

if(offcanvas){
offcanvas.hide();
}

}

</script>



</body>
</html>