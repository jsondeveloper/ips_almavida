<?php

session_start();

require_once "../models/Usuario.php";

$accion=$_GET['accion'];

$usuario=new Usuario();

if($accion=="login"){

    $email=$_POST['email'];
    $password=$_POST['password'];

    $user=$usuario->buscarPorEmail($email);

    if($user && password_verify($password,$user['password'])){
        $_SESSION['usuario']=$user['nombre'];
        header("Location: ../../");
        exit;
    } else {
        // Redirigir al login con error
        header("Location: ../auth/login.php?error=1&email=".urlencode($email));
        exit;
    }

}

if($accion=="register"){

$nombre=$_POST['nombre'];
$email=$_POST['email'];
$password=$_POST['password'];

$existe=$usuario->buscarPorEmail($email);

if($existe){

header("Location: ../auth/register.php?error=email&correo=".urlencode($email));

}else{

$usuario->registrar($nombre,$email,$password);

header("Location: ../auth/login.php?success=1");

}

}