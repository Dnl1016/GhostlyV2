<?php
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header('Location:../View/login.php');
    }
    require_once('../Controller/controladorVentas.php');
    $listarPersonas = $controladorVentas->listarPersonas();
    $listarProductos = $controladorVentas->listarProductos();
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
                                <h1>Crear venta</h1>
                                <a href="../Controller/controladorVentas.php?listarVentas" style="height: 50%;" class="btn btn-dark">Regresar</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="error"></div>
                            <form action="../Controller/controladorVentas.php" method="POST">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card border-dark mb-3">
                                            <div class="card-body">
                                               <div class="card">
                                                   <div class="card-header">
                                                       <h2 class="text-center">Encabezado venta</h2>
                                                       <hr>
                                                       <div class="row">
                                                           <div class="col-md-6">
                                                               <div class="form-group">
                                                                   <label for="idPersona">Persona: </label>
                                                                   <select class="form-control" name="idPersona" id="idPersona">
                                                                        <option value="">Seleccione la persona</option>
                                                                        <?php foreach($listarPersonas as $persona) { ?>
                                                                            <option value="<?php echo $persona['idPersona'] ?>"><?php echo $persona['nombre'] . ' ' . $persona['apellido'] . ' - ' . $persona['cedula'] . '.' ?></option>
                                                                        <?php } ?>
                                                                   </select>
                                                               </div>
                                                           </div>
                                                           <div class="col-md-6">
                                                               <div class="form-group">
                                                                   <label for="nombreVenta">Nombre venta: </label>
                                                                   <input type="text" id="nombreVenta" name="nombreVenta" class="form-control" placeholder="Nombre de la venta...">
                                                               </div>
                                                           </div>
                                                       </div>
                                                   </div>
                                               </div>
                                               <div class="card-body">
                                                   <div class="row">
                                                       <div class="col-md-12">
                                                           <div class="form-group">
                                                               <label for="idDetalleProducto">Producto:</label>
                                                               <select onchange="consultarPrecio(this.value)" class="form-control" name="idDetalleProducto" id="idDetalleProducto">
                                                                   <option value="">Seleccione el producto a vender</option>
                                                                   <?php foreach($listarProductos as $producto) { ?>
                                                                        <option value="<?php echo $producto['idDetalleProducto'] ?>"><?php echo $producto['nombre'] ?></option>
                                                                   <?php } ?>
                                                               </select>
                                                           </div>   
                                                       </div>
                                                       <div class="col-md-4">
                                                            <div class="form-group">
                                                               <label for="cantidad">Cantidad:</label>
                                                               <input type="text" name="cantidad" id="cantidad" class="form-control" placeholder="Ingrese la cantidad a comprar...">
                                                           </div> 
                                                       </div>
                                                       <div class="col-md-4">
                                                            <div class="form-group">
                                                               <label for="precioUnitario">Precio unitario:</label>
                                                               <input readonly type="text" id="precioUnitario" class="form-control">
                                                           </div> 
                                                       </div>
                                                       <div class="col-md-4">
                                                            <div class="form-group">
                                                               <label for="precioTotal">Precio total:</label>
                                                               <input readonly type="text" id="precioTotal" class="form-control">
                                                           </div> 
                                                       </div>
                                                   </div>
                                               </div>
                                            </div>
                                            <div class="card-footer">
                                                <button type="button" class="btn btn-dark col-md-12" id="agregarVenta"><i class="fas fa-plus"></i></button>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 style="text-align: center; margin-top: 2px;">Detalle venta</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-hovered display" style="width: 100%;" id="listarRegistros">
                                                        <thead>
                                                            <tr>
                                                                <th>Nombre producto</th>
                                                                <th>Cantidad</th>
                                                                <th>Precio unitario</th>
                                                                <th>Precio total</th>
                                                                <th>Opciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="cajaVentas"></tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th colspan="3"></th>
                                                                <th>Precio total: </th>
                                                                <th> 
                                                                    <input readonly type="text" id="precioTotalVenta" value="0" class="form-control">
                                                                </th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input name="registrarVenta" type="submit" class="btn btn-dark col-md-12" value="Guardar venta">
                                        <hr>
                                        <a href="../Controller/controladorVentas.php?listarVentas" class="btn btn-secondary col-md-12">Cancelar</a>
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

    <script src="js/funcionesVentas.js"></script>
</body>
</html>