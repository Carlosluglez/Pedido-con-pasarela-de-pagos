<?php
    session_start();
    include "includes/common.php";
    redirigirSesionFalse();
     if (isset($_POST['salir'])){
        cerrarSesion();
        header("Location:pe_login.php");
    }
   
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
    <h1>INDICE</h1>

    <form method="POST" name="indice" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

        <label for="">ELIGE LA ACCIÓN</label>
        <h3>gestion general</h3>
        <ul>
            <li><a href="pe_altaped.php"> Generar Pedido </a></li>
            <li><a href="pe_consped.php">Consulta Detalles Pedido Por Número de CLiente </a></li>
            <li><a href="pe_consprodstock.php">Consulta Disponibilidad de Stock </a></li>
            <li><a href="pe_constock.php">Consulta Disponibilidad de Stock Familia </a></li>
            <li><a href="pe_topprod.php">Productos vendidos entre dos fechas</a></li>
            <li><a href="pe_conspago.php">Relación de pagos realizados entre dos fechas</a></li>
        </ul>
        <input type="submit" name="salir" value="salir">
    </form>

</body>
</html>

