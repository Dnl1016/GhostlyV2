<?php
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header('Location:../View/login.php');
    }

    require_once('../Controller/controladorUsuario.php');
    $listaUsuarios = $controladorUsuario->listarUsuarios();
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
                                <h1>Lista de usuarios</h1>
                                <a href="../Controller/controladorUsuario.php?registrarUsuario" style="height: 50%;" class="btn btn-dark">Nuevo usuario</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Cedula</th>
                                            <th>Correo</th>
                                            <th>Telefono</th>
                                            <th>Usuario</th>
                                            <th>Rol</th>
                                            <th>Estado</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($listaUsuarios as $usuario){ ?>
                                            <tr>
                                                <td><?php echo $usuario['idUsuario']; ?></td>
                                                <td><?php echo $usuario['nombre']; ?></td>
                                                <td><?php echo $usuario['apellido']; ?></td>
                                                <td><?php echo $usuario['cedula']; ?></td>
                                                <td><?php echo $usuario['correo']; ?></td>
                                                <td><?php echo $usuario['telefono']; ?></td>
                                                <td><?php echo $usuario['usuario']; ?></td>
                                                <td><?php echo $usuario['nombreRol']; ?></td>
                                                <td><?php echo $usuario['estado'] == 1 ? 'Activo' : 'Inactivo'; ?></td>
                                                <td>
                                                    <a href="../Controller/controladorUsuario.php?editarUsuario=<?php echo $usuario['idUsuario'] ?>" class="btn btn-secondary">Editar</a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
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
</body>
</html>