<div class="navbar">
    <div class="contenuto-navbar">
        <a href="../index.php"> <h1>Sappy Seals Shop</h1> </a>
        <a class="link-navbar" href="../index.php">Torna alla Pagina Iniziale <i class="fas fa-store"></i></a>
        <a class="link-navbar" href="./shop.php">CATALOGO NFT <i class="fas fa-store"></i></a>
        <a class="link-navbar" href="./carrello.php">IL TUO CARRELLO <i class="fas fa-cart-shopping"></i></a>
        <a class="link-navbar" href="./riepilogo.php">VAI AL PAGAMENTO <i class="fas fa-credit-card"></i></a>
        <?php if (isset($_SESSION['ruolo']) && $_SESSION['ruolo'] == 'admin') { ?>
            <a class="link-navbar" href="admin.php">AREA ADMIN <i class="fas fa-table"></i></a>
        <?php } ?>
        <a class="link-navbar" href="./logout.php">LOGOUT <i class="fas fa-right-from-bracket"></i></a>
    </div>
</div>