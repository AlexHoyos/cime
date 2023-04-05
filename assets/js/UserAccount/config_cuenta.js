const ConfigCuentaControllerURL = 'app/Controllers/UserAccount/ConfigCuentaController.php';
function updatePersonalData(){
    const contra = $("#contra").val()
    const nombre = $("#nombre").val()
    const apellido = $("#apellido").val()

    $("#error").html("");
    $("#success").html("");
    $.ajax({
        url: ConfigCuentaControllerURL,
        method: 'POST',
        data: {
          contra: contra,
          nombre: nombre,
          apellido: apellido,
        },
        success: function(response) {
          $("#success").html(response.msg)
        },
        error: function(jqXHR, textStatus, errorThrown) {
          // Hubo un error en la petición
          $("#error").html(jqXHR.responseJSON.error);
        }
      });

}

function updatePassword(){

    const contra = $("#contra").val()
    const nueva_contra = $("#nueva_contra").val()
    const repetir_contra = $("#repetir_contra").val()

    $("#error").html("");
    $("#success").html("");
    $.ajax({
        url: ConfigCuentaControllerURL,
        method: 'POST',
        data: {
          contra: contra,
          nueva_contra: nueva_contra,
          repetir_contra: repetir_contra,
        },
        success: function(response) {
          $("#success").html(response.msg)
        },
        error: function(jqXHR, textStatus, errorThrown) {
          // Hubo un error en la petición
          $("#error").html(jqXHR.responseJSON.error);
        }
      });

}