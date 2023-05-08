<?php
use CIME\Filters\AccountRoleFilter;
use CIME\Filters\SessionFilter;

include '../app/main.php';
include '../app/Includes/Admin/Dashboard.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Escáner de código QR</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        #camaraContainer {
            display: flex;
            justify-content: left;
            align-items: left;
            width: 60%;
            height: 400px;
            margin-bottom: 10px;
        }

        #mainContainer {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        #botonesContainer {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        #botonesContainer button {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div id="mainContainer">
        <h1>Escáner de código QR</h1>
        <div id="camaraContainer"></div>
        <div id="botonesContainer">
            <input type="text" id="codigoManual" class="form-control" placeholder="Ingrese el código manualmente">
            <button onclick="leerCodigoManual()" class="btn btn-primary">Leer código manual</button>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
    <script>
        // Función para iniciar el escaneo del código QR
        function iniciarEscaneo() {
            Quagga.init({
                inputStream: {
                    name: "Live",
                    type: "LiveStream",
                    target: document.querySelector("#camaraContainer")
                },
                decoder: {
                    readers: ["code_128_reader", "ean_reader", "ean_8_reader", "code_39_reader", "code_39_vin_reader", "codabar_reader", "upc_reader", "upc_e_reader", "i2of5_reader"]
                }
            }, function(err) {
                if (err) {
                    console.error(err);
                    return;
                }
                Quagga.start();
            });

            Quagga.onDetected(function(result) {
                var codigo = result.codeResult.code;
                alert("Código QR detectado: " + codigo);
            });
        }

        // Función para leer el código manualmente
        function leerCodigoManual() {
            var codigoManual = document.getElementById("codigoManual").value;
            if (codigoManual !== "") {
                alert("Código ingresado manualmente: " + codigoManual);
            }
        }

        // Iniciar el escaneo al cargar la página
        window.onload = iniciarEscaneo;
    </script>
</body>
</html>
