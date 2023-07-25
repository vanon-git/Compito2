<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head><title>creazione e popolamento STdb</title></head>

<body>
<h3>creazione e popolazione STdb</h3>

<?php			//
error_reporting(E_ALL &~E_NOTICE);

$db_name = "pluto";
$utenti = "utenti";
$nft = "NFT";
$gadget = "gadget";

///////////////////////////////////////////////////////////////////////////////
// effettuazione della connessione al database
//
$mysqliConnection = new mysqli("127.0.0.1", "root", "");

// controllo della connessione (versione "procedurale,
// as opposed to the "object-oriented version" msqli->connect_errno...
if (mysqli_connect_errno()) {
    printf("Oops, abbiamo problemi con la connessione al db: %s\n", mysqli_connect_error());
//    exit();
}
// creazione del database
//
$queryCreazioneDatabase = "CREATE DATABASE $db_name";
// il risultato della query va in $resultQ
if ($resultQ = mysqli_query($mysqliConnection, $queryCreazioneDatabase)) {
    printf("Database creato ...\n");
}
else {
    printf("Whoops! niente creazione del db! Che sara successo??.\n");
//  exit();
}

// ok, adesso chiudiamo la connessione
$mysqliConnection->close();
///////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////
// e la riapriamo con il collegamento alla base di dati
$mysqliConnection = new mysqli("127.0.0.1", "root", "", $db_name);
// controllo della connessione (versione "procedurale,
if (mysqli_errno($mysqliConnection)) {
    printf("Oops, abbiamo problemi con la connessione al db: %s\n", mysqli_error($mysqliConnection));
    exit();
}

$sqlQuery = "CREATE TABLE if not exists $utenti (";
$sqlQuery.= "userId int NOT NULL auto_increment, primary key (userId), ";
$sqlQuery.= "username varchar (35) NOT NULL, ";
$sqlQuery.= "password varchar (12) NOT NULL, ";
$sqlQuery.= "totaleAcquisti float";
$sqlQuery.= ");";

echo "<P>$sqlQuery</P>";

if ($resultQ = mysqli_query($mysqliConnection, $sqlQuery))
    printf("Tabella Utenti creata ...\n");
else {
    printf("Whoops! niente creazione Tabella Utenti! Che sara' successo??.\n");
  exit();
}

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

$sqlQuery = "CREATE TABLE if not exists $gadget (";
$sqlQuery.= "gadgetId int NOT NULL auto_increment, primary key (gadgetId), ";
$sqlQuery.= "nome varchar (100) NOT NULL, ";
$sqlQuery.= "costoGadget float ";
$sqlQuery.= ");";

echo "<P>$sqlQuery</P>";

if ($resultQ = mysqli_query($mysqliConnection, $sqlQuery))
    printf("Tabella gadget creatA ...\n");
else {
    printf("Whoops! niente creazione Tabella gadget! Che sara' successo??.\n");
  exit();
}

echo mysqli_errno($mysqliConnection);
///////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////
// popolamento STuser (NB tre campi: userId gestito automaticamente
//
$sql = "INSERT INTO $utenti
	(username, password, totaleAcquisti)
	VALUES
	(\"tpol\", \"tpol\", \"0\")
	";

if ($resultQ = mysqli_query($mysqliConnection, $sql))
    printf("popolamento User eseguito ...\n");
else {
    printf("Whoops! Couldn't populate user table.\n");
  exit();
}

// altro modo di chiudere la connessione al db
mysqli_close($mysqliConnection);
?>
</body></html>