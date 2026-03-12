<?php
require_once "../../middleware/auth.php";
require_once "../../models/Empresa.php";

$e = new Empresa();
$empresas = $e->listar();
?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">

<title>Empresas</title>

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

.toolbar{
display:flex;
align-items:center;
gap:10px;
flex-wrap:wrap;
margin-bottom:15px;
}

.titulo{
font-size:22px;
font-weight:bold;
margin-right:auto;
}

.buscador{
max-width:250px;
}

</style>

</head>

<body class="container-fluid mt-4">

<div class="card shadow p-3">

<div class="toolbar">

<div class="titulo">
🏢 Empresas
</div>

<input
type="text"
id="buscador"
class="form-control form-control-sm buscador"
placeholder="Buscar empresa o NIT..."
>

<a href="crear.php" class="btn btn-primary btn-sm">
➕ Nueva Empresa
</a>

</div>



<div class="table-responsive">

<table class="table table-striped table-hover align-middle" id="tablaEmpresas">

<thead class="table-dark">

<tr>
<th>Nombre</th>
<th>NIT</th>
<th>Dirección</th>
<th>Teléfono</th>
<th class="text-center">Acciones</th>
</tr>

</thead>

<tbody>

<?php foreach($empresas as $empresa){ ?>

<tr>

<td><?= htmlspecialchars($empresa['nombre']) ?></td>

<td><?= htmlspecialchars($empresa['nit']) ?></td>

<td><?= htmlspecialchars($empresa['direccion']) ?></td>

<td><?= htmlspecialchars($empresa['telefono']) ?></td>

<td class="text-center">

<a
href="editar.php?id=<?= $empresa['id'] ?>"
class="btn btn-warning btn-sm"
>
✏ Editar
</a>

<a
href="../../controllers/EmpresaController.php?accion=eliminar&id=<?= $empresa['id'] ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('¿Eliminar empresa?')"
>
🗑 Eliminar
</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>



<script>

const buscador = document.getElementById("buscador");
const filas = document.querySelectorAll("#tablaEmpresas tbody tr");

buscador.addEventListener("keyup",function(){

const texto = this.value.toLowerCase();

filas.forEach(fila=>{

const nombre = fila.cells[0].textContent.toLowerCase();
const nit = fila.cells[1].textContent.toLowerCase();

fila.style.display =
(nombre.includes(texto) || nit.includes(texto))
? ""
: "none";

});

});

</script>

</body>
</html>