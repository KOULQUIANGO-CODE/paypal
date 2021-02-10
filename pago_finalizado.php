<?php include_once 'includes/templates/header.php'; ?>

<body>
    <div class="formulario">
        <h2>Pagos con Paypal</h2>
        <?php 
        $resultado = $_GET['exito'];
        $paymentId = $_GET['paymentId'];
        if($resultado === 'true'){
            echo 'El pago se realizo correctamente';
            echo 'el ID es {$paymentId}';
        }else{
            echo 'el pago se cancelo';
        }
        ?>
    </div>
    
<?php include_once 'includes/templates/footer.php'; ?>
