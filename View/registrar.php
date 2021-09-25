<?php
require_once('../Controller/controladorRegistro.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ghostly</title>

    <!-- Custom fonts for this template-->
    <link href="../Layout/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../Layout/css/fons.googleapis.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="../Layout/css/sb-admin-2.min.css" rel="stylesheet">
    <?php include('../Layout/plantilla/select2Css.html') ?>

</head>

<body class="bg-gradient-dark">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">¡Crear cuenta!</h1>
                            </div>
                            <div id="error"></div>
                            <form class="user" action="../Controller/controladorUsuario.php" method="POST">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input required id="nombre" name="nombre" type="text" class="form-control form-control-user" id="Nombre"
                                            placeholder="Nombre">
                                    </div>
                                    <div class="col-sm-6">
                                        <input required id="apellido" name="apellido" type="text" class="form-control form-control-user" id="apellido"
                                            placeholder="Apellido">
                                    </div>
                                </div>
                                <div class="form-group row"> 
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input required id="cedula" name="cedula" type="text" class="form-control form-control-user" id="cedula"
                                            placeholder="Documento">
                                    </div>
                                    <div class="col-sm-6">
                                        <input  required id="correo" name="correo" type="email" class="form-control form-control-user" id="correo"
                                            placeholder="Correo">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input required id="telefono" name="telefono" type="text" class="form-control form-control-user" id="telefono"
                                            placeholder="Teléfono">
                                    </div>
                                    <div class="col-sm-6">
                                        <input required id="dirección" name="direccion" type="text" class="form-control form-control-user" id="direccion"
                                            placeholder="Dirección">
                                    </div>
                                </div>
                                <div class="form-group">
                                        <input required id="usuario" name="usuario" type="text" class="form-control form-control-user" id="usuario"
                                            placeholder="Usuario">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input required id="contrasena" name="contrasena" type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Contraseña">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Repeatir contraseña">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input name="registrarUsuario" type="submit" class="btn btn-dark btn-user btn-block" value="Registrar cuenta">
                                    </div>
                                </div>
                        
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="olvidarContraseña.php">¿olvidaste contraseña?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.php">¡ya tengo una cuenta...Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

   <!-- Bootstrap core JavaScript-->
   <script src="../Layout/vendor/jquery/jquery.min.js"></script>
    <script src="../Layout/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../Layout/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../Layout/js/sb-admin-2.min.js"></script>

    <?php include('../Layout/plantilla/select2Js.html') ?>                                                
    
    <?php
        if(isset($_GET['error'])){
            $error = $_GET['error'];
            $error = implode(' ', explode('-', $error));
            ?> 
            <script>
                document.getElementById('error').innerHTML = `
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error; ?>
                    </div>
                `;
            </script>
            <?php
        }
    ?>

</body>

</html>