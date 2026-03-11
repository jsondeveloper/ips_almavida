<!DOCTYPE html>
<html>
<head>

<title>Nuevo Paciente</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="container mt-4">

<h2>Registrar Paciente</h2>

<form action="../../controllers/PacienteController.php?accion=guardar" method="POST">

<input name="nombre" class="form-control mb-2" placeholder="Nombre completo">

<input name="tipo_documento" class="form-control mb-2" placeholder="Tipo documento">

<input name="documento" class="form-control mb-2" placeholder="Numero documento">

<input name="direccion" class="form-control mb-2" placeholder="Direccion">

<input name="telefono" class="form-control mb-2" placeholder="Telefono">

<input name="celular" class="form-control mb-2" placeholder="Celular">

<input type="date" name="fecha" class="form-control mb-2">

<input name="edad" class="form-control mb-2" placeholder="Edad">

<input name="eps" class="form-control mb-2" placeholder="EPS">

<input name="contacto" class="form-control mb-2" placeholder="Contacto emergencia">

<input name="parentesco" class="form-control mb-2" placeholder="Parentesco">

<button class="btn btn-success">Guardar</button>

</form>

</body>
</html>