<?php
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header('Location:../View/login.php');
    }
    require_once('../Controller/controladorProductos.php');
    $listaCategorias = $controladorProductos->listarCategorias();
    $producto = $controladorProductos->buscarProducto($_GET['idProducto']);
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
                                <h1>Crear producto</h1>
                                <a href="../Controller/controladorProductos.php?listarProductos" style="height: 50%;" class="btn btn-dark">Regresar</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="error"></div>
                            <form action="../Controller/controladorProductos.php" method="POST">
                                <input type="hidden" value="<?php echo $producto['idProducto'] ?>" name="idProducto">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="nombre">Nombre:</label>
                                            <input value="<?php echo $producto['nombre'] ?>" required id="nombre" name="nombre" class="form-control" type="text" placeholder="Nombre...">
                                        </div> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="estado">Estado:</label>
                                            <select required id="estado" name="estado" class="form-control">
                                                <option value="">Seleccione el estado</option>
                                                <option value="1" <?php echo $producto['estado'] == 1 ? 'selected' : '' ?>>Activo</option>
                                                <option value="0" <?php echo $producto['estado'] == 0 ? 'selected' : '' ?>>Inactivo</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="genero">Genero:</label>
                                            <select id="genero" name="genero" class="form-control">
                                                <option value="">Seleccione el genero</option>
                                                <option value="M" <?php echo $producto['genero'] == 'M' ? 'selected' : '' ?>>Masculino</option>
                                                <option value="F" <?php echo $producto['genero'] == 'F' ? 'selected' : '' ?>>Femenino</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="idCategoria">Categoria:</label>
                                            <select required class="form-control" name="idCategoria" id="idCategoria">
                                                <option value="">Seleccion la categoria</option>
                                                <?php foreach($listaCategorias as $categoria){ ?>
                                                    <option value="<?php echo $categoria['idCategoria'] ?>" <?php echo $producto['idCategoria'] == $categoria['idCategoria'] ? 'selected' : '' ?>><?php echo $categoria['nombre'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input name="editarProducto" type="submit" class="btn btn-dark col-md-12" value="Editar">
                                        <hr>
                                        <a href="../Controller/controladorProductos.php?listarProductos" class="btn btn-secondary col-md-12">Cancelar</a>
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