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
if (isset($_POST['anadir'])) { //al pulsar boton añadir
    //se recupera el carrito de compras para el usuario de la sesión actual.
    $carrito = $_SESSION["carrito" . $_SESSION['customerNumber']];
    $producto = $_POST['productos']; //se recuperan los campos del formulario
    $cantidad = $_POST['cantidad'];

    if (empty($carrito)) { //si el carrito esta vacio, se le asigna un array vacio
        $carrito = array();
    }
    if ($cantidad <= 0) { //se comprueba que la cantidad no es menor que 0
        echo "no puedes añadir menos de 1 producto";
    } else {
        if (array_key_exists($producto, $carrito)) { //si existe el producto en el carro en el momento de añadirle, se suma a la cantidad que ya había
            // echo "...".$producto;
            $carrito[$producto] += intval($cantidad);
        } else {
            $carrito[$producto] = intval($cantidad); //si no existe se introduce junto con su cantidad
        }

        //se guarda el carrito en la sesion del usuario
        $_SESSION["carrito" . $_SESSION['customerNumber']] = $carrito;
        // var_dump($carrito);
    }
} else if ((isset($_POST['comprar']) || isset($_POST['bizum'])) && !empty($_SESSION["carrito" . $_SESSION['customerNumber']])) {

    $_SESSION["carrito" . $_SESSION['customerNumber']];
    $carrito = $_SESSION["carrito" . $_SESSION['customerNumber']];
    $carrito = $carrito;
    $grabarCompra = true;

    foreach ($carrito as $key => $valor) {
        $cantidad = $valor;
        $id = $key;
        if (!comprobarDisponibilidad($conn, $id, $cantidad)) { //comprobamos que hay cantidad suficiente en los almacenes de cada producto, por eso lo metemos en el bucle
            $grabarCompra = false;
            echo "no hay cantidad de " . $id;
        }
    }
    if ($grabarCompra) {
       if(isset($_POST['comprar'])){
        crearOrdenPedidoYdetalles($conn,"tarjeta");
       }else{
        crearOrdenPedidoYdetalles($conn,"bizum");
       }
        // echo $link;
        //  cerrarSesion();            
    }
} else if (isset($_POST['vaciar'])) {
    // Código para vaciar el carrito
    unset($_SESSION["carrito" . $_SESSION['customerNumber']]);
    $_SESSION["carrito" . $_SESSION['customerNumber']] = array();
} else if (isset($_POST['salir'])) {
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
    <script src="https://sis-t.redsys.es:25443/sis/NC/sandbox/redsysV2.js"></script>
    <!-- <script type="text/javascript" src="js/players_fieldText.js"></script> -->
</head>

<body>
    <h1>Generar pedido</h1>

    <form method="POST" name="pedido" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

        <?php

        $conn = create_conn();
        $nombre_productos = crearSelect($conn, "SELECT productName,productCode FROM products WHERE quantityInStock > 0");
        crearSelectProdu($nombre_productos);

        ?>
        </br></br>
        <input type="number" name="cantidad" value="" placeholder="introduce unidades" />
        </br></br>

        <input class="b" type="submit" name="anadir" value="añadir a la cesta"><br>
        <input class="b" type="submit" name="comprar" value="comprar con tarjeta">
        <input class="b" type="submit" name="bizum" value="bizum"><br>
        <input class="b" type="submit" name="vaciar" value="vaciar"><br>
        <input class="b" type="submit" name="salir" value="salir">
        </br></br>
        <a href="pe_inicio.php">volver al menú</a>
    </form>

</body>