<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Sistema IPS Alma Vida</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
overflow:hidden;
}

.sidebar{
height:100vh;
background:#0d6efd;
color:white;
}

.sidebar a{
color:white;
text-decoration:none;
display:block;
padding:15px;
font-size:18px;
}

.sidebar a:hover{
background:#084298;
}

iframe{
width:100%;
height:100vh;
border:none;
}

</style>

</head>

<body>

<!-- NAVBAR -->

<nav class="navbar navbar-dark bg-primary">

<div class="container-fluid">

<button class="btn btn-light d-md-none" data-bs-toggle="offcanvas" data-bs-target="#menu">
☰
</button>

<span class="navbar-brand">IPS Alma Vida</span>

</div>

</nav>

<div class="container-fluid">

<div class="row">

<!-- SIDEBAR PC -->

<div class="col-md-2 sidebar d-none d-md-block">

<h4 class="text-center mt-3">Menú</h4>

<a href="app/views/pacientes/listar.php" target="contenido">
👤 Pacientes
</a>

<a href="app/views/citas/listar.php" target="contenido">
📅 Citas
</a>

</div>

<!-- CONTENIDO -->

<div class="col-md-10 p-0">

<iframe name="contenido"></iframe>

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