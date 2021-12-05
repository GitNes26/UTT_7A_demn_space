<?php
if (isset($_COOKIE["sesion"])) {
   if ($_COOKIE["sesion"] != "activa") {
       header("location:./index.php");
       die();
   }
} else {
   header("location:./index.php");
   die();
}

include "Templates/header.php"
?>

<!-- <div class="fondo-opaco"></div> -->
<div class="container text-center text-light mt-5 contenedor-bienvenido">
   <h1 class="fw-bold letrota">BIENVENIDO <?php echo $_COOKIE["usuario"] ?></h1>
   <a href='#' id="btn_cerrar_sesion" class='btn btn-outline-dark btn-lg btn_cerrar_sesion' title='Cerrar sesión'><i class="fas fa-door-closed fa-2xl"></i></a>
</div>

<?php
include "Templates/footer.php"
?>   

<script>
// /* CERRAR SESION
const btn_cerrar_sesion = document.getElementById("btn_cerrar_sesion")
const i = btn_cerrar_sesion.querySelector("i")
$("#btn_cerrar_sesion").mouseover(function () {
   i.classList.remove("fa-door-closed");
   i.classList.add("fa-door-open");
})
$("#btn_cerrar_sesion").mouseleave(function () {
   i.classList.remove("fa-door-open");
   i.classList.add("fa-door-closed");
})

$("#btn_cerrar_sesion").click((e) => {
   e.preventDefault();
   let datos = {accion:"cerrar_sesion"};
   $.ajax({
      url: "Models/Usuario/App.php",
      type: "POST",
      data: datos,
      dataType: "json",
      success: (ajaxResponse) => {
         if (ajaxResponse.Resultado == "correcto")
            window.location.href = "index.php"
      }
   })
});
</script>