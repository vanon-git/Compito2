<?php
    $db_name = "Compito2";
    //inizializzazione della connessione al database
    $mysqliConnection = new mysqli("127.0.0.1", "root", "");

    //controllo della connessione
    if (mysqli_connect_errno()) {
        printf("Ci sono problemi con la connessione al Database: %s\n", mysqli_connect_error());
        exit();
    }

    // creazione del database
    $queryCreazioneDatabase = "CREATE DATABASE $db_name";
    // il risultato della query va in $resultQ
    if ($resultQ = mysqli_query($mysqliConnection, $queryCreazioneDatabase)) {
        printf("il Database è stato creato...\n");
    }
    else {
        printf("Non è stato possibile creare il Database.\n");
    //  exit();
    }
    
    //chiudiamo la connessione
    $mysqliConnection->close();

    //e la riapriamo con il collegamento alla base di dati
    require_once("conn1.php")

?>