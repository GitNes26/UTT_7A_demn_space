<?php
if (isset($_COOKIE["sesion"])) {
   if ($_COOKIE["sesion"] == "activa") {
       header("location:./bienvenido.php");
       die();
   }
}
include "Templates/header.php"
?>

<div class="main">
   
   <!-- LOGIN -->
   <div class="container contenedor w-75 rounded-lg shadow-lg" id="contenedor_login">
      <div class="row aling-items-streatch">
         <!-- LADO IZQUIERDO -->
         <div class="col-md-6 col-12 p-5 rounded-lg rounded-start rounded-lg parte_1">
            <h1 class="fw-bold text-light text-center py-5">BIENVENIDO</h1>
            <p class="text-center text-light">Este es un proyecto de Seguridad Informatica de alumnos de 7A IDyGS | Ingenieria de Desarrollo y Gestión de Software</p>
            <div class="d-grid mt-4 col-12">
               <button type="button" id="btn_switch" class="btn btn-lg btn-outline-light fw-bold">SOY NUEVO</button>
            </div>
         </div>

         <!-- LADO DERECHO -->
         <div class="col-md-6 col-12 p-5 rounded-lg rounded-end parte_2">
            <div class="text-end mb-5">
               <img src="Images/favicon.png" width="100rem" alt="">
            </div>
            <!-- Formulario LOGIN-->
            <form id="formulario_login">
               <input type="hidden" name="accion" value="iniciar_sesion">
               <div class="form-floating mx-4 mb-4 col-12">
                  <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Nombre de usuario" autofocus>
                  <label for="usuario">Nombre de usuario</label>
               </div>
               <div class="form-floating mx-4 mb-4 col-12">
                  <input type="password" class="form-control" id="contrasenia" name="contrasenia" placeholder="Contraseña">
                  <label for="contrasenia">Contraseña</label>
               </div>
               <div class="d-grid mx-4 col-12">
                  <button type="submit" id="btn_enviar" class="btn btn-lg btn-outline-light fw-bold">INICIAR SESIÓN</button>
               </div>
            </form>
            <!-- Formulario LOGIN-->
         </div>
      </div>
   </div>

   <!-- CREAR USUARIO -->
   <div class="container contenedor w-75 rounded-lg shadow-lg" id="contenedor_registro" hidden>
      <div class="row aling-items-streatch">
         <!-- LADO IZQUIERDO -->
         <div class="col-md-6 col-12 p-5 rounded-lg rounded-end parte_2">
            <div class="text-end mb-5">
               <img src="Images/favicon.png" width="100rem" alt="">
            </div>
            <!-- Formulario CREAR USUARIO-->
            <form id="formulario_registro">
               <input type="hidden" name="accion" value="registrarme">
               <div class="form-floating mx-4 mb-4 col-12">
                  <input type="text" class="form-control" id="inputR_usuario" name="inputR_usuario" placeholder="Nombre de usuario" autofocus>
                  <label for="inputR_usuario">Nombre de usuario</label>
               </div>
               <div class="form-floating mx-4 mb-4 col-12">
                  <input type="email" class="form-control" id="inputR_correo" name="inputR_correo" placeholder="Nombre de usuario" autofocus>
                  <label for="inputR_correo">Correo electronico</label>
               </div>
               <div class="form-floating mx-4 mb-4 col-12">
                  <input type="password" class="form-control" id="inputR_contrasenia" name="inputR_contrasenia" placeholder="Contraseña">
                  <label for="inputR_contrasenia">Contraseña</label>
               </div>
               <div class="form-floating mx-4 mb-4 col-12">
                  <input type="password" class="form-control" id="inputR_confirmar_contrasenia" name="inputR_confirmar_contrasenia" placeholder="Confirmar contraseña">
                  <label for="inputR_confirmar_contrasenia">Confirmar contraseña</label>
                  <span class='badge' id='badge_confirmacion_contrasenia'></span>
               </div>
               <div class="d-grid mx-4 col-12">
                  <button type="submit" id="btnR_enviar" class="btn btn-lg btn-outline-light fw-bold">REGISTRARME</button>
               </div>
            </form>
            <!-- Formulario CREAR USUARIO-->
         </div>
         
         <!-- LADO DERECHO -->
         <div class="col-md-6 col-12 p-5 rounded-lg rounded-start rounded-lg parte_1">
            <h1 class="fw-bold text-light text-center py-5">REGISTRATE, ES GRÁTIS!!!</h1>
            <p class="text-center text-light">Ingresa tus datos para comenzar esta gran experiencia.</p>
            <div class="d-grid mt-4 col-12">
               <button type="button" id="btnR_switch" class="btn btn-lg btn-outline-light fw-bold">YA TENGO CUENTA</button>
            </div>
         </div>
         
      </div>
   </div>

</div>

<?php
include "Templates/footer.php"
?>    
<script src="Scripts/index.js"></script>