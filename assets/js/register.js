function register(e){

    e.preventDefault();
    $("#error").html("");

    if($("#condiciones").is(":checked")){

      $.ajax({
        url: 'app/Controllers/RegisterUserController.php',
        method: 'POST',
        data: {
          nombre: $("#nombre").val(),
          apellido: $("#apellido").val(),
          correo: $("#correo").val(),
          telefono: $("#telefono").val(),
          nacimiento: $("#nacimiento").val(),
          contra: $("#contra").val(),
          repetir_contra: $("#repetir_contra").val(),
          captcha: $("#captcha").val()
        },
        success: function(response) {
          login(e)
          //window.location.href = "/";
        },
        error: function(jqXHR, textStatus, errorThrown) {
          // Hubo un error en la petición
          $("#error").html(jqXHR.responseJSON.error);
        }
      });

    } else {
      $("#error").html("Debe aceptar los terminos y condiciones!")
    }


    return false;
}