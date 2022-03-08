<?php
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header('Location:../View/login.php');
    }
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
                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">¿Necesitas ayuda?</h1>
                </div>
                <div class="container">
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="headinguno">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseuno" aria-expanded="true" aria-controls="collapseuno">
                                CONFIGURACIÓN
                                </button>
                            </h2>
                            </div>

                            <div id="collapseuno" class="collapse show" aria-labelledby="headinguno" data-parent="#accordionExample">
                            <div class="card-body">
                            Este módulo permite gestionar toda la información listada a la cuenta de los roles y permisos del aplicativo.<A HREF="https://www.youtube.com/"> Video de confifuracion</A> 
                            </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingdos">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapsedos" aria-expanded="false" aria-controls="collapsedos">
                                PRODUCTOS
                                </button>
                            </h2>
                            </div>
                            <div id="collapsedos" class="collapse" aria-labelledby="headingdos" data-parent="#accordionExample">
                            <div class="card-body">
                                Este módulo permite gestionar toda la información de los productos, categorías,  entradas, tallas y color. <A HREF="https://www.youtube.com/"> Video de productos</A>
                            </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingtres">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapsetres" aria-expanded="false" aria-controls="collapsetres">
                               USUARIOS
                                </button>
                            </h2>
                            </div>
                            <div id="collapsetres" class="collapse" aria-labelledby="headingtres" data-parent="#accordionExample">
                            <div class="card-body">
                                Este módulo permite gestionar toda la información listada a la cuenta de los usuarios y sus datos personales, además de  la seguridad del aplicativo. <A HREF="https://www.youtube.com/"> Video de usuarios</A>
                            </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingcuatro">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapsecuatro" aria-expanded="false" aria-controls="collapsecuatro">
                                VENTA
                                </button>
                            </h2>
                            </div>
                            <div id="collapsecuatro" class="collapse" aria-labelledby="headingcuatro" data-parent="#accordionExample">
                            <div class="card-body">
                                Este módulo permite gestionar toda la información listada a la cuenta de las ventas que realizan los clientes. <A HREF="https://www.youtube.com/"> Video de ventas</A>
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