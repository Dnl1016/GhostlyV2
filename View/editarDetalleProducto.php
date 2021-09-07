<?php
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header('Location:../View/login.php');
    }
    require_once('../Controller/controladorTallas.php');
    require_once('../Controller/controladorColores.php');
    require_once('../Controller/controladorProductos.php');
    $listarTallas = $controladorTallas->listarTallas();
    $listarColores = $controladorColores->listarColores();
    $detalleProducto = $controladorProductos->buscarDetalleProducto($_GET['idDetalleProducto']);
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
                                <h1>Crear detalle productos</h1>
                                <a href="../Controller/controladorProductos.php?producto=<?php echo $detalleProducto['idProducto'] ?>" style="height: 50%;" class="btn btn-dark">Regresar</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="error"></div>
                            <form action="../Controller/controladorProductos.php" method="POST">
                                <input type="hidden" name="idDetalleProducto" value="<?php echo $detalleProducto['idDetalleProducto'] ?>">
                                <input type="hidden" name="idProducto" value="<?php echo $detalleProducto['idProducto'] ?>">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card border-dark mb-3">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="nombre">Nombre:</label>
                                                            <input name="nombre" required id="nombre" class="form-control" type="text" placeholder="Nombre..." value="<?php echo $detalleProducto['nombre'] ?>">
                                                        </div> 
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="idTalla">Talla:</label>
                                                            <select name="idTalla" required class="form-control" id="idTalla">
                                                                <option value="">Seleccione la talla</option>
                                                                <?php foreach($listarTallas as $talla){ ?>
                                                                    <option <?php echo $talla['idTalla'] == $detalleProducto['idTalla'] ? 'selected' : '' ?> value="<?php echo $talla['idTalla'] ?>"><?php echo $talla['nombre'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">  
                                                        <div class="form-group">
                                                            <label for="idColor">Color:</label>
                                                            <select name="idColor" required class="form-control" id="idColor">
                                                                <option value="">Seleccione el color</option>
                                                                <?php foreach($listarColores as $color){ ?>
                                                                    <option <?php echo $color['idColor'] == $detalleProducto['idColor'] ? 'selected' : '' ?> value="<?php echo $color['idColor'] ?>"><?php echo $color['nombre'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input name="editarDetalleProducto" type="submit" class="btn btn-dark col-md-12" value="Editar producto">
                                        <hr>
                                        <a href="../Controller/controladorProductos.php?producto=<?php echo $detalleProducto['idProducto'] ?>" class="btn btn-secondary col-md-12">Cancelar</a>
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