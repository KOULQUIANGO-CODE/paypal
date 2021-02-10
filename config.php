<?php 
// video 667

define('URL_SITIO','https://paypal-prueba.herokuapp.com/');
require 'paypal/autoload.php'; 
$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        
        'AYdC44aKhgt0rWF4BL2xvyQMk_GtSCFAptmjXjoxplyuD1Fl6WSIF7cPN5cxUcV48Mrbb0myIJiKSTln',// cliente DI
        'EB586gHC2-e9uYzIh4ui9TovACpcaY6-SnFlwzk-OfOJtgsZhmmaO2aNGZQfem3ZBdGWhhEePYjwiduA'// Secret
    )
);
?>