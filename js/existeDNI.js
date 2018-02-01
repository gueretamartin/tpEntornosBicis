// Recomiendo leer este archivo de abajo hacia arriba para comprenderlo mejor.

$(function(){

    $(document).on("keypress", "form", function(event) {
      return event.keyCode != 13;
    });


    $("#mensajeDisponibilidad").show();
    function siRespuesta(r){
        console.log(r.res);
        resp = r.res;
          // Mostrar la respuesta del servidor en el div con el id "respuesta"
        // 0 disponible, 1 no disponible
          if(resp === 1){
          $("#mensajeDisponibilidad").show(); 
          mensaje = "El D.N.I. ya se encuentra registrado";
          $("#enviaform").hide();
          $("#mensajeDisponibilidad").css("color","red");
          $('#mensajeDisponibilidad').html(mensaje);
        } else {
          $("#enviaform").show();
          $('#mensajeDisponibilidad').hide();
        }
          
    }

    function siError(e){
        alert('Ocurrió un error al realizar la petición: '+e.statusText);
    }

    function peticion(e){

        // Obtener valores de los campos de texto
        var parametros = {
            dni: $('#inputDNI').val()
        };

        // Realizar la petición
    	$.post(
                            "existeDNI.php",    // Script que se ejecuta en el servidor
    	                      parametros,
    	                      siRespuesta,    // Función que se ejecuta cuando el servidor responde
                            'json'
                              );

        /* Registrar evento de la petición (hay mas)
           (no es obligatorio implementarlo, pero es muy recomendable para detectar errores) */

     	//post.error(siError);         // Si ocurrió un error al ejecutar la petición se ejecuta "siError"
    }

    $('#inputDNI').focusout(peticion); // Registrar evento al boton "Calcular" con la funcion "peticion"
});
