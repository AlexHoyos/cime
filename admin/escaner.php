<?php

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
        <video id="camaraContainer"></video>
        <div id="botonesContainer">
            <input type="text" id="codigoManual" class="form-control" placeholder="Ingrese el código manualmente">
            <button onclick="leerCodigoManual()" class="btn btn-primary">Leer código manual</button>
        </div>
    </div>

    <script>
    // Función para leer el código manualmente
    function leerCodigoManual() {
        var codigoManual = document.getElementById("codigoManual").value;
        if (codigoManual !== "") {
            alert("Código ingresado manualmente: " + codigoManual);
        }
    }
    </script>

    <script type="module">
        import QrScanner from "../assets/js/qrscanner.js";
       // Scanner Object
       const scanner = new QrScanner(
            document.getElementById("camaraContainer"), 
            function(result){
                //document.getElementById("scanresult").value = result;
                alert(result)
            } 
        );
       
       //document.getElementById("start").onclick = e => scanner.start();
       //document.getElementById("stop").onclick = e => scanner.stop();


        // Iniciar el escaneo al cargar la página
        window.onload = e => scanner.start();
    </script>
</html>
    <?php
    include '../app/Includes/Admin/Footer.php';
    ?>
    </body>
</html>

