<?php
if(!isset($_POST['producto'],$_POST['precio'])){
    exit('HUBO UN ERROR');
}
use PayPal\Api\Payer;
use PayPal\Api\ItemList;
use PayPal\Api\Item;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;


// echo '<pre>';
// var_dump($_POST);
// echo '</pre>';

require 'config.php';

$producto = htmlspecialchars($_POST['producto']);
$precio = htmlspecialchars($_POST['precio']);
$precio = (int)$precio; 
$envio = 0;
$total = $precio + $envio;
$compra = new Payer();
// set agregar un valor get obtener un valor
$compra->setPaymentMethod('paypal'); 
// echo $compra->getPaymentMethod(); 
//Productos
$articulo = new Item();
$articulo->setName($producto)
        ->setcurrency('USD') //tipo de moneda del articulo
        ->setQuantity(1) // cantida de artitulos
        ->setPrice($precio); //  Cantidad de articulos que voy a vender 
// en caso de tener mas artulos repetimos el codigo ej:
// $articulo2 = new Item();
// $articulo2->setName($producto)
//         ->setcurrency('USD') 
//         ->setQuantity(1) 
//         ->setPrice($precio);

// lista de artuculos 
$listaArticulos = new ItemList();
// $listaArticulos->setItems(array($articulo,$articulos,....)) para mas articulos
$listaArticulos->setItems(array($articulo));

// detalles del articulo
$detalles = new Details();
$detalles->setShipping($envio)
        ->setSubtotal($precio);
// cantidad a pagar
$cantidad = new Amount();
$cantidad->setcurrency('USD')
        ->setTotal($precio)
        ->setDetails($detalles);

// Transaccion
$transaccion = new Transaction();
$transaccion->setAmount($cantidad) //cantidad que va ser cobrada setAmount
            ->setItemList($listaArticulos)
            ->setDescription('Pago')
            ->setInvoiceNumber(uniqid());//identificador de pagado uniqid()solo es para probar, aqui debe ir la base de datos ej el id de la tabla de la base de datos

// redireccionar
$redireccionar =new RedirectUrls();
$redireccionar->setReturnUrl(URL_SITIO."pago_finalizado.php?exito=true")
            ->setCancelUrl(URL_SITIO."pago_finalizado.php?exito=false");
//pago
$pago = new Payment();
$pago->setIntent('sale')
    ->setPayer($compra)
    ->setRedirectUrls($redireccionar)
    ->setTransactions(array($transaccion));
try {
    $pago->create($apiContext);
} catch (PayPal\Exception\PayPalConnectionException $pce) {
    echo '<pre>';
    print_r(json_decode($pce->getData()));
    exit;
    echo '</pre>';
}
$aprobado = $pago->getApprovalLink();
header("Location: {$aprobado}");
?>