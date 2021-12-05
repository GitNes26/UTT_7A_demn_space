$(document).ready (() => {
   $('#contenedor_registro').hide();
})
const
contenedor_login = $('#contenedor_login'),
contenedor_registro = $('#contenedor_registro'),
formulario_login = $("#formulario_login"),
usuario = $("#usuario"),
contrasenia = $("#contrasenia"),
btn_enviar = $("#btn_enviar"),
btn_switch = $("#btn_switch"),
formulario_registro = $("#formulario_registro"),
inputR_usuario = $("#inputR_usuario"),
inputR_correo = $("#inputR_correo"),
inputR_contrasenia = $("#inputR_contrasenia"),
inputR_confirmar_contrasenia = $("#inputR_confirmar_contrasenia"),
btnR_enviar = $("#btnR_enviar"),
btnR_switch = $("#btnR_switch"),
badge_confirmacion_contrasenia = $("#badge_confirmacion_contrasenia")
;

formulario_login.on("submit", (e) => {
   e.preventDefault();
   validar_campo = validarInput(usuario,"Nombre de usuario");
   if (!validar_campo) return;
   validar_campo = validarInput(contrasenia,"Contraseña");
   if (!validar_campo) return;
   datos = formulario_login.serializeArray();

   peticionAjax("Models/Usuario/App.php",datos,"login");
});
formulario_registro.on("submit", (e) => {
   e.preventDefault();
   validar_campo = validarInput(inputR_usuario,"Nombre de usuario");
   if (!validar_campo) return;
   validar_campo = validarInput(inputR_correo,"Correo electronico");
   if (!validar_campo) return;
   validar_campo = validarInput(inputR_contrasenia,"Contraseña");
   if (!validar_campo) return;
   validar_campo = validarInput(inputR_confirmar_contrasenia,"Confirmar contraseña");
   if (!validar_campo) return;
   datos = formulario_registro.serializeArray();

   peticionAjax("Models/Usuario/App.php",datos,"registro");
});

function peticionAjax(url,datos,accion) {
   $.ajax({
      url,
      type: "POST",
      data: datos,
      dataType: "json",
      success: (respuesta) => {
         if (respuesta.Resultado == "correcto") {
            Swal.fire({
               icon: respuesta.Icono_alerta,
               title: respuesta.Titulo_alerta,
               text: `${respuesta.Mensaje_alerta}`,
               showConfirmButton: false,
               timer: 2000
            }).then(() => {
               if (accion == "login"){
                  $("#formulario_login")[0].reset();
                  window.location.href = "bienvenido.php"
               } else if ( accion == "registro" ) {
                  $("#formulario_registro")[0].reset();
                  cambiarLoginSingin("registro")
               }
            });
         } else {
            Swal.fire({
               icon: respuesta.Icono_alerta,
               title: respuesta.Titulo_alerta,
               text: `${respuesta.Mensaje_alerta}`,
               showConfirmButton: true,
               confirmButtonColor: '#494E53'
            })                        
         }
      },
      error: () => {
         Swal.fire({
            icon: "error",
            title: "Opss!",
            text: `Algo salio mal, revisa tus datos`,
            showConfirmButton: true,
            confirmButtonColor: '#494E53'
         }) 
      }
   })
}

function validarInput(input, nombre_campo) {
   if (input.val() == "") {
       mostrarToast('error', `Campo ${nombre_campo} vacio.`);
       input.focus();
       return false;
   }
   return true;
}
function mostrarToast(icono, mensaje, posicion) {
   if (posicion == null) {posicion = 'top-end'}
   const Toast = Swal.mixin({
      toast: true,
      position: posicion,
      showConfirmButton: false,
      timer: 2000,
      timerProgressBar: true,
      didOpen: (toast) => {
         toast.addEventListener('mouseenter', Swal.stopTimer)
         toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
   })

   Toast.fire({icon: icono, title: mensaje})
}

//SWICHEAR FORMULARIOS
btn_switch.on("click",() => {
   contenedor_registro.prop("hidden",false)
   cambiarLoginSingin("login")
});
btnR_switch.on("click",() => {
   cambiarLoginSingin("registro")
});
function cambiarLoginSingin(texto) {
   if (texto == "login") {
      contenedor_login.slideUp(500);
      setTimeout(() => {
         contenedor_registro.slideDown(500);
      }, 500);
      setTimeout(() => {usuario.focus();},600)
   } else {
      contenedor_registro.slideUp(500);
      setTimeout(() => {
         contenedor_login.slideDown(500);
      }, 500);
      setTimeout(() => {inputR_usuario.focus();},600)
   }
}

// CONFIRMAR CONTRASEÑA
inputR_confirmar_contrasenia.on('input',function() {
   var contrasena1 = inputR_contrasenia.val();
   var contrasena2 = inputR_confirmar_contrasenia.val();
   
   if (contrasena1 === contrasena2) {
       $("#respuestaContrasena").addClass('bg-success').text('Contraseñas correctas').removeClass('bg-danger');
       inputR_contrasenia.addClass('is-valid').removeClass('is-invalid');
       inputR_confirmar_contrasenia.addClass('is-valid').removeClass('is-invalid');
       badge_confirmacion_contrasenia.text("Contraseñas correctas.")
       btnR_enviar.prop('disabled',false);
   } else {
       $("#respuestaContrasena").addClass('bg-danger').text('No coínciden las contraseñas').removeClass('bg-success');
       inputR_contrasenia.addClass('is-invalid').removeClass('is-valid');
       inputR_confirmar_contrasenia.addClass('is-invalid').removeClass('is-valid');
       badge_confirmacion_contrasenia.text("Las contraseñas no coinciden.")
       btnR_enviar.prop('disabled',true);
   }
});