<?php
include ('Usuario.php');
$Usuario = new Usuario();

if (isset($_POST['accion'])) { $accion = $_POST['accion']; }

//SECCION DE LOGIN
if (isset($_POST['usuario'])) { $usuario = $_POST['usuario']; }
if (isset($_POST['contrasenia'])) { $contrasenia = $_POST['contrasenia']; }
//FUNCIONES 
if ($accion == 'iniciar_sesion') { $Usuario->iniciarSesion($usuario,$contrasenia); }
if ($accion == 'cerrar_sesion') { $Usuario->CerrarSesion(); }
//SECCION DE LOGIN


if (isset($_POST['id'])) { $id = $_POST['id']; }
if (isset($_POST['inputR_usuario'])) { $usuario = $_POST['inputR_usuario']; }
if (isset($_POST['inputR_correo'])) { $correo = $_POST['inputR_correo']; }
if (isset($_POST['inputR_contrasenia'])) $contrasenia = $_POST['inputR_contrasenia'];

//PETICIONES
if ($accion == 'registrarme') {
   $Usuario->crearUsuario($usuario, $correo, $contrasenia);
}