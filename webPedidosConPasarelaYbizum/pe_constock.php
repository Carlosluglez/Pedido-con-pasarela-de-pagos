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
   
    
     mostrarStockFamilia($conn);

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
    <h1>Consulta Stock Por Familia</h1>

    <form method="POST" name="stockProductosFamilia" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
       Familia
        <?php

        $productsLine = crearSelect($conn, "SELECT  productLine FROM productlines");    
        crearSelectProductLine($productsLine);
        
        ?>      
        </br></br>
        <input type="submit" name="mostrar" value="Mostrar stock"><br><br>
        <input type="submit" name="salir" value="salir">
        </br></br>
        <a href="pe_inicio.php">volver al menú</a>
    </form>

</body>
