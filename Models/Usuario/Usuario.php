<?php
if (file_exists("../Models/DB_connection.php")) {
   require_once("../Models/DB_connection.php");
} else {
   if (file_exists("./Models/DB_connection.php")) {
      require_once("./Models/DB_connection.php");
   } else if (file_exists("../Models/DB_connection.php")) {
      require_once("../Models/DB_connection.php");
   } else if (file_exists("../../Models/DB_connection.php")) {
      require_once("../../Models/DB_connection.php");
   }
}

class Usuario extends DB_connection
{
   //SECCION DE LOGIN
   function iniciarSesion($usuario,$contrasenia) {
      try {
         $query = "SELECT u.id, u.usuario, u.correo, u.contrasenia FROM usuarios as u WHERE u.usuario='$usuario'";

         $respuesta = array(
            "Resultado" => 'incorrecto',
            "Icono_alerta" => 'error',
            "Titulo_alerta" => 'Opps...!',
            "Mensaje_alerta" => 'Usuario incorrecto.',
         );

         $consulta = $this->SelectOnlyOne($query);
         if (sizeof($consulta) > 0) {
            if (password_verify($contrasenia, $consulta["contrasenia"])) {
               setcookie("id_usuario",$consulta["id"], time() + (86400*30), "/");
               setcookie("usuario",$consulta["usuario"], time() + (86400*30), "/");
               setcookie("correo",$consulta["correo"], time() + (86400*30), "/");
               setcookie("sesion","activa", time() + (86400*30), "/");
               
               $respuesta = array(
                  "Resultado" => 'correcto',
                  "Icono_alerta" => 'success',
                  "Titulo_alerta" => 'Bienvenido!',
                  "Mensaje_alerta" => $consulta['usuario'],
               );
            } else {
               $respuesta = array(
                  "Resultado" => 'incorrecto',
                  "Icono_alerta" => 'error',
                  "Titulo_alerta" => 'Opps...!',
                  "Mensaje_alerta" => 'Contraseña incorrecta',
               );
            }
         }
      } catch (Exception $e) {
         echo "Error: ".$e->getMessage();
         $respuesta = array(
            "Resultado" => 'error',
            "Icono_alerta" => 'error',
            "Titulo_alerta" => 'Opps...!',
            "Mensaje_alerta" => 'Ha ocurrido un error, verifica tus datos.',
         );
      }
      die(json_encode($respuesta));
   }

   function cerrarSesion() {
      unset($_COOKIE["id_usuario"]);
      unset($_COOKIE["usuario"]);
      unset($_COOKIE["permisos"]);
      unset($_COOKIE["sesion"]);

      setcookie("id_usuario", null, -1, "/");
      setcookie("usuario", null, -1, "/");
      setcookie("permisos", null, -1,);
      setcookie("sesion", null, -1, "/");

      $respuesta = array(
         "Resultado" => 'correcto',
         "Icono_alerta" => 'success',
         "Titulo_alerta" => 'Cerrando Sesion',
         "Mensaje_alerta" => '',
      );
      die(json_encode($respuesta));
   }
   //SECCION DE LOGIN
   

   function crearUsuario($usuario,$correo,$contrasenia) {
      try {
         $respuesta = array(
            "Resultado" => 'incorrecto',
            "Icono_alerta" => 'error',
            "Titulo_alerta" => 'Opps...!',
            "Mensaje_alerta" => 'Datos incorrectos.',
         );

         $contrasenia_hash = password_hash($contrasenia,PASSWORD_DEFAULT);
         $query = "INSERT INTO usuarios (usuario,correo,contrasenia,creado,actualizado) VALUES (?,?,?,?,?)";
         $this->ExecuteQuery($query, array($usuario,$correo,$contrasenia_hash,date("YYY-MM-DD HH:mm:ss"),date("YYY-MM-DD HH:mm:ss")));
         $respuesta = array(
            "Resultado" => 'correcto',
            "Icono_alerta" => 'success',
            "Titulo_alerta" => 'EXITO!',
            "Mensaje_alerta" => 'Usuario registrado.',
         );

      } catch (Exception $e) {
         echo "Error: ".$e->getMessage();
         $respuesta = array(
            "Resultado" => 'error',
            "Icono_alerta" => 'error',
            "Titulo_alerta" => 'Opps...!',
            "Mensaje_alerta" => 'Ha ocurrido un erro, verifica tus datos.',
         );
      }
      die(json_encode($respuesta));
      
   }
}
