<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head><title>creazione e popolamento Compito2</title></head>

<body>
<h3>creazione e popolazione Compito2</h3>

<?php
    error_reporting(E_ALL);

    //Connessione al database e sua creazione
    require_once("connessione2.php");

    //creazione tabelle
    //creazione tabella Utenti
    $sqlQuery = "CREATE TABLE if not exists $utenti (";
    $sqlQuery.= "userId int NOT NULL auto_increment, primary key (userId), ";
    $sqlQuery.= "nome varchar (50) NOT NULL, ";
    $sqlQuery.= "cognome varchar (50) NOT NULL, ";
    $sqlQuery.= "username varchar (50) NOT NULL UNIQUE, ";
    $sqlQuery.= "password varchar (32) NOT NULL, ";
    $sqlQuery.= "totaleAcquisti float";
    $sqlQuery.= ");";

    echo "<P>$sqlQuery</P>";
    //verifica creazione tabella utenti
    if ($resultQ = mysqli_query($mysqliConnection, $sqlQuery))
        printf("Tabella Utenti creata ...\n");
    else {
        printf("Errore nella creazione della tabella utenti.\n");
    exit();
    }
    //creazione tabella nft
    $sqlQuery = "CREATE TABLE if not exists $nft (";
    $sqlQuery.= "nftId int NOT NULL auto_increment, primary key (nftId), ";
    $sqlQuery.= "nome varchar (100) NOT NULL, ";
    $sqlQuery.= "costoNft float";
    $sqlQuery.= ");";

    echo "<P>$sqlQuery</P>";

    if ($resultQ = mysqli_query($mysqliConnection, $sqlQuery))
        printf("Tabella nft creatA ...\n");
    else {
        printf("Whoops! niente creazione Tabella movie! Che sara' successo??.\n");
    exit();
    }
    echo mysqli_errno($mysqliConnection);
    //popolamento tabelle
    //popolamento Utenti (NB: userId gestito automaticamente)
    $sql = "INSERT INTO $Utenti_table_name
        (nome, cognome, username, password, sommeSpese)
        VALUES
        (\"Mattia\", \"Vanon\", \"admin\", \"1234\", \"0\")
        ";

    if ($resultQ = mysqli_query($mysqliConnection, $sql))
        printf("Utente inserito correttamente <br />\n");
    else {
        printf("Errore inserimento utente <br />\n");
    exit();
    }
            //chiudiamo la connessione
            $mysqliConnection->close();

        ?>
    </body>
</html>