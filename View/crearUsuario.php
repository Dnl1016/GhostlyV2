<?php
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header('Location:../View/login.php');
    }
    require_once('../Controller/controladorUsuario.php');
    $listaRoles = $controladorUsuario->listarRoles();
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
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php include('../Layout/plantilla/sidebar.php') ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <?php include('../Layout/plantilla/header.php') ?>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h1>Crear usuario</h1>
                                <a href="../Controller/controladorUsuario.php?listarUsuarios" style="height: 50%;" class="btn btn-dark">Regresar</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="error"></div>
                            <form action="../Controller/controladorUsuario.php" method="POST">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre">Nombre:</label>
                                            <input required id="nombre" name="nombre" class="form-control" type="text" placeholder="Nombre...">
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="apellido">Apellido:</label>
                                            <input required id="apellido" name="apellido" class="form-control" type="text" placeholder="Apellido...">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="correo">Correo:</label>
                                            <input required id="correo" name="correo" class="form-control" type="email" placeholder="Correo...">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cedula">Cedula:</label>
                                            <input required id="cedula" name="cedula" class="form-control" type="text" placeholder="Cedula...">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="telefono">Telefono:</label>
                                            <input required id="telefono" name="telefono" class="form-control" type="text" placeholder="Telefono...">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="estado">Estado:</label>
                                            <select name="estado" id="estado" class="form-control">
                                                <option value="">Seleccione el estado</option>
                                                <option value="1">Activo</option>
                                                <option value="0">Inactivo</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="direccion">Direccion:</label>
                                            <input required id="direccion" name="direccion" class="form-control" type="text" placeholder="Dirección...">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="usuario">Usuario:</label>
                                            <input required id="usuario" name="usuario" class="form-control" type="text" placeholder="Usuario...">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="contrasena">Contraseña:</label>
                                            <input required id="contrasena" name="contrasena" class="form-control" type="password" placeholder="Contraseña...">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="confirmarContrasena">Confirmar contraseña:</label>
                                            <input required id="confirmarContrasena" name="confirmarContrasena" class="form-control" type="password" placeholder="Confirmar contraseña...">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="idRol">Rol:</label>
                                            <select name="idRol" id="idRol" class="form-control">
                                                <option value="">Seleccione el rol</option>
                                                <?php foreach($listaRoles as $rol){ ?>
                                                    <option value="<?php echo $rol['idRol'] ?>"><?php echo $rol['nombre'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input name="registrarUsuario" type="submit" class="btn btn-dark col-md-12" value="Registrar">
                                        <hr>
                                        <a href="../Controller/controladorUsuario.php?listarUsuarios" class="btn btn-secondary col-md-12">Cancelar</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <?php include('../Layout/plantilla/footer.php'); ?>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Bootstrap core JavaScript-->
    <script src="../Layout/vendor/jquery/jquery.min.js"></script>
    <script src="../Layout/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../Layout/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../Layout/js/sb-admin-2.min.js"></script>

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