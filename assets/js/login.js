function login(e){

    e.preventDefault();
    $("#error").html("");
    $.ajax({
        url: 'app/Controllers/LoginUserController.php',
        method: 'POST',
        data: {
          correo: $("#correo").val(),
          contra: $("#contra").val()
        },
        success: function(response) {
          window.location.href = "/";
        },
        error: function(jqXHR, textStatus, errorThrown) {
          // Hubo un error en la petición
          $("#error").html(jqXHR.responseJSON.error);
        }
      });

    return false;
}