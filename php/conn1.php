<?php
    //dati relativi al db e alle tabelle da usare negli script che includono questo file
    $db_name = "Compito2";
    $utenti = "utenti";
    $nft = "NFT";
    $immagini_nft = "immagini_nft";
    // inizializzazione della connessione al database
    $mysqliConnection = new mysqli("127.0.0.1", "root", "", $db_name);

    // controllo della connessione
    if (mysqli_connect_errno()) {
        printf("Ci sono problemi con la creazione del Database%s\n", mysqli_connect_error());
    //  exit();
    }
?>