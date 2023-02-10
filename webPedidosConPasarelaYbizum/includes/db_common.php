<?php
function create_conn()
{
    $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname = "pedidos";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Error: no se ha podido establecer la conexión " . $e->getMessage();
    }

    return $conn;
}

function close_conn($conn){
    $conn = null;
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


// function maxOrderNumber($conn)
// {
//     try {
//         $stmt1 = $conn->prepare("SELECT max(orderNumber) FROM orders");
//         $stmt1->execute();
//         $orderNumber = intval($stmt1->fetchColumn()) + 1;
//     } catch (PDOException $e) {
//         echo $e->getMessage();
//     }
//     return $orderNumber;
// }

// function calcularTotalPedido($conn){
  
//     $carrito = $_SESSION["carrito" . $_SESSION['customerNumber']];
//     $carrito = $carrito;
//     $precioTotalProducto = 0;
//     $precioTotalPedido = 0;

//     foreach ($carrito as $key => $valor){
//        $precio= consultaPrecio($conn,$key);
//         $precioTotalProducto = $precio * $valor;
//         $precioTotalPedido += $precioTotalProducto;
//     }
//     return $precioTotalPedido;
// }

?>