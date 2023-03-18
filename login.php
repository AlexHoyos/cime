<?php

    include './app/main.php';
    include './app/Includes/header.php';
?>

    <section class="row m-0 p-0" id="login">

        <div class="col-12" id="pageTitle">
            <h1>Iniciar Sesion</h1>
        </div>
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #F8F8F8;
        }
        .login-form {
            width: 340px;
            margin: 50px auto;
            font-size: 15px;
            border: 1px solid #DDD;
            border-radius: 5px;
            padding: 20px;
            background-color: #FFF;
        }
        .login-form h2 {
            margin-bottom: 25px;
            text-align: center;
            font-size: 24px;
        }
        .form-control, .btn {
            min-height: 38px;
            border-radius: 2px;
        }
        .btn {        
            font-size: 15px;
            font-weight: bold;
        }
        .forgot-password {
            text-decoration: underline;
        }
        .logo {
            display: block;
            margin: 0 auto;
            font-size: 48px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-form">
        <div class="logo">
            <i class="fa-solid fa-key"></i>
        </div>
        <h2>Iniciar Sesión</h2>
        <form action="login.php" method="post">
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Correo Electrónico" required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Contraseña" required="required">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
            </div>
            <div class="clearfix">
                <a href="#" class="forgot-password pull-right">¿Olvidaste tu Contraseña?</a>
            </div>        
        </form>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>


      

    </section>

<?php
    include './app/Includes/footer.php';
?>