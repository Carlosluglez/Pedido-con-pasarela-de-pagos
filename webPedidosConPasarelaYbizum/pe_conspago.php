<?php
include "includes/common.php";
include "includes/db_common.php";
session_start();
if (!comprobarSession()) {
    header("Location:pe_login.php");
}
?>
<?php
    $conn = create_conn();
    if(isset($_POST['mostrar'])){
         $numeroCliente= $_POST['customerNumbers'];
        $fecha_inicio=$_POST['fecha_inicio'];
        $fecha_fin=$_POST['fecha_fin'];
       
        mostrarPagosProducto($conn,$fecha_inicio,$fecha_fin, $numeroCliente);
    }else if (isset($_POST['salir'])){
        cerrarSesion();
        header("Location:pe_login.php");
    }
    close_conn($conn);
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="author" content="width=device-width" />
    <link rel="stylesheet" href="css/BOOTSTRAP.MIN.CSS" crossorigin="anonymous">
    <script src="js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/players_fieldText.js"></script>
</head>

<body>
    <h1>CONSULTA DE PAGOS</h1>

    <form method="POST" name="consulta_productos" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      
        <label for="">Elige el cliente</label>

        <?php

        $conn = create_conn();
        $customerNumber= crearSelect($conn, "SELECT DISTINCT customerNumber  FROM payments");    
        crearSelectCustomerNumber($customerNumber);          


?>      
        </br></br>
        <input type="date" name="fecha_inicio" value="">
        </br></br>
        <input type="date" name="fecha_fin" value="">
        </br></br>
        <input type="submit" name="mostrar" value="mostrar"><br><br>
        <input type="submit" name="salir" value="salir">
        <a href="pe_inicio.php">volver al menú</a>
    </form>

</body>

