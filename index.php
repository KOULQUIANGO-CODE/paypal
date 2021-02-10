<?php include_once 'includes/templates/header.php'; ?>

<body>
    <div class="formulario">
        <h2>Pagos con Paypal</h2>
        <form action="pagar.php" method="post">
            <div class="campo">
                <label for="producto">Producto</label>
                <input id="producto" type="text" name="producto" placeholder="producto" required>
            </div>

            <div class="campo">
                <label for="precio">Precio</label>
                <input id="precio" type="number" name="precio" placeholder="precio" min="0" required>
            </div>

            <input type="submit" value="Pagar" name="submit" class="button">
        </form>
    </div>
    
<?php include_once 'includes/templates/footer.php'; ?>
