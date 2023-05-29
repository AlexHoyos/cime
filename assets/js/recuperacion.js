function irAPaso2(e){
    e.preventDefault()
    const correo = $("#correo").val()

    $.ajax({
        url: 'app/Controllers/RecuperacionCuentaController.php?paso=1&correo='+correo,
        method: 'POST',
        data: {},
        beforeSend: function(){
          var button = document.getElementById("sendCodeBtn")
          loadingButton(button)
        },
        success: function(response) {
            window.location.href="/recuperacion.php?paso=2&correo="+correo
        },
        error: function(jqXHR, textStatus, errorThrown) {
          // Hubo un error en la petición
          console.log(jqXHR)
          $("#error").html(jqXHR.responseJSON.error);
        
        }
      });
    return false
}

function recuperacion(e){
    e.preventDefault()

    $("#error").html("");
    $("#success").html("");



    $.ajax({
        url: 'app/Controllers/RecuperacionCuentaController.php?paso=2&correo='+$("#correo").val(),
        method: 'POST',
        data: {
          codigo: $("#codigo").val(),
          contra: $("#contra").val(),
          repetir_contra: $("#repetir_contra").val()
        },
        success: function(response) {
            $("#success").html("Contraseña cambiada! Inicia sesión");
            setTimeout(function(){
                window.location.href = "/";
            }, 1500)
        },
        error: function(jqXHR, textStatus, errorThrown) {
          // Hubo un error en la petición
          $("#error").html(jqXHR.responseJSON.error);
        },
        complete: function (){
          loadingButton(button, true)
        }
      });

    return false
}