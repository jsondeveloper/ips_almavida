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
<link rel="icon" href="img/icon.png" type="image/png">
<script>
document.addEventListener("contextmenu", function(e){
e.preventDefault();
});
</script>
<style>

html,body{
height:100%;
margin:0;
background:#F7FAFC;
font-family:system-ui,-apple-system,Segoe UI,Roboto,Ubuntu;
user-select:none;
-webkit-user-select:none;
-moz-user-select:none;
-ms-user-select:none;
}

/* FOOTER */

footer{
background:linear-gradient(90deg,#7ED957 0%,#2FBF71 25%,#1FA89A 50%,#1E6FB8 75%,#0F4C81 100%);
height:5px;
position:fixed;
bottom:0;
width:100%;
}

/* NAVBAR */

.navbar1{
background:linear-gradient(90deg,#1E6FB8,#0F4C81,#1FA89A,#2FBF71,#7ED957);
height:5px !important;
}

/* SIDEBAR */

.sidebar{
height:calc(100vh - 10px);
background:#FFFFFF;
border-right:1px solid #E6E6E6;
display:flex;
flex-direction:column;

animation:sidebarEntrada .5s ease;
}

@keyframes sidebarEntrada{
from{
opacity:0;
transform:translateX(-40px);
}
to{
opacity:1;
transform:translateX(0);
}
}

/* LOGO */

.logo{
margin-bottom:1rem;
opacity:0;
transform:scale(.9);
animation:logoAnim .6s ease forwards;
}

@keyframes logoAnim{
to{
opacity:1;
transform:scale(1);
}
}

/* MENU */

.sidebar a{
color:#333;
text-decoration:none;
display:block;
padding:14px 18px;
font-size:15px;
transition:0.25s;
border-left:3px solid transparent;

opacity:0;
transform:translateX(-15px);
}

/* MENU ESCALONADO */

.sidebar a:nth-child(1){animation:itemMenu .4s .2s forwards;}
.sidebar a:nth-child(2){animation:itemMenu .4s .3s forwards;}
.sidebar a:nth-child(3){animation:itemMenu .4s .4s forwards;}
.sidebar a:nth-child(4){animation:itemMenu .4s .5s forwards;}
.sidebar a:nth-child(5){animation:itemMenu .4s .6s forwards;}

@keyframes itemMenu{
to{
opacity:1;
transform:translateX(0);
}
}

.sidebar a i{
color:#1E6FB8;
margin-right:8px;
}

.sidebar a:hover{
background:#F4F8FB;
transform:translateX(3px);
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

/* IFRAME ANIMADO */

iframe{
width:100%;
height:calc(100vh - 14px);
border:none;
background:white;

opacity:0;
transition:opacity 1s ease, transform 1s ease;
}

iframe.loaded{
opacity:1;
}

iframe.salida{
opacity:0;
}

</style>
</head>

<body>

<nav class="navbar1">

<button class="btn btn-light d-md-none me-3"
data-bs-toggle="offcanvas"
data-bs-target="#menu">

<i class="bi bi-list"></i>

</button>

</nav>

<div class="container-fluid">
<div class="row">

<div class="col-md-2 sidebar d-none d-md-flex">

<img class="logo" src="img/logo1.png">

<div class="menu-links">

<a href="app/views/dashboard/index.php" target="contenido">
<i class="bi bi-speedometer2"></i> Dashboard
</a>

<a href="app/views/empresas/listar.php" target="contenido">
<i class="bi bi-building"></i> Empresas
</a>

<a href="app/views/pacientes/listar.php" target="contenido">
<i class="bi bi-person"></i> Pacientes
</a>

<a href="app/views/citas/listar.php" target="contenido">
<i class="bi bi-clock-history"></i> Citas
</a>

<a href="app/views/dashboard/calendario.php" target="contenido">
<i class="bi bi-calendar3"></i> Calendario
</a>

</div>

<div class="usuario-box">

<div class="mb-2">
<i class="bi bi-person-circle"></i>
<b><?= htmlspecialchars($_SESSION['usuario']) ?></b>
</div>

<a href="app/auth/logout.php" class="logout-link">
<i class="bi bi-box-arrow-right"></i> Cerrar sesión
</a>

</div>

</div>

<div class="col-md-10 p-0">

<iframe
name="contenido"
src="app/views/dashboard/index.php">
</iframe>

</div>

</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>

const links=document.querySelectorAll('.menu-links a');
const iframe=document.querySelector('iframe[name="contenido"]');

/* CUANDO CARGA UNA PAGINA */

iframe.addEventListener('load',()=>{

iframe.classList.remove("salida");
iframe.classList.add("loaded");

const src=iframe.contentWindow.location.pathname;

links.forEach(link=>link.classList.remove('active'));

links.forEach(link=>{

if(src.endsWith(link.getAttribute('href').replace(/^.*\/app\//,''))){
link.classList.add('active');
}

});

});

/* CUANDO DAN CLICK */

links.forEach(link=>{

link.addEventListener("click",()=>{

iframe.classList.remove("loaded");
iframe.classList.add("salida");

});

});

</script>

<footer></footer>

</body>
</html>
