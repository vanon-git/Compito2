<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head><title>Creazione e Popolamento Compito2</title></head>
        <body>
            <h3>Creazione e Popolazione Compito2</h3>
            <?php
                error_reporting(E_ALL);

                //Connessione al database e sua creazione
                require_once("conn2.php");

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
                
                //verifica creazione tabella Utenti
                if ($resultQ = mysqli_query($mysqliConnection, $sqlQuery))
                    printf("Tabella Utenti creata ...\n");
                else {
                    printf("Errore nella creazione della tabella Utenti.\n");
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
                // creazione tabella immagini_nft
                $sqlQuery = "CREATE TABLE if not exists $immagini_nft (";
                $sqlQuery.= "imgId int NOT NULL auto_increment, primary key (imgId), ";
                $sqlQuery.= "nftId int NOT NULL, "; // Chiave esterna
                $sqlQuery.= "percorso_file varchar (255) NOT NULL, ";
                $sqlQuery.= "FOREIGN KEY (nftId) REFERENCES $nft(nftId) ON DELETE CASCADE";
                $sqlQuery.= ");";

                echo "<P>$sqlQuery</P>";

                if ($resultQ = mysqli_query($mysqliConnection, $sqlQuery))
                    printf("Tabella immagini_nft creata ...<br>");
                else {
                    printf("Errore creazione tabella immagini_nft.<br>");
                    echo mysqli_error($mysqliConnection);
                    exit();
                }
                echo mysqli_errno($mysqliConnection);
                //popolamento tabelle
                //popolamento Utenti (NB: userId gestito automaticamente)
                $sql = "INSERT INTO $utenti
                    (nome, cognome, username, password, totaleAcquisti)
                    VALUES
                    (\"Mattia\", \"Vanon\", \"admin\", \"1234\", \"0\")
                    ";

                if ($resultQ = mysqli_query($mysqliConnection, $sql))
                    printf("Utente inserito correttamente <br />\n");
                else {
                    printf("Errore inserimento utente <br />\n");
                exit();
                }
                $sql = "INSERT INTO $nft (nome, costoNft) VALUES 
                    (\"SappySeals6589\", 247.00),
                    (\"SappySeals8569\", 245.99),
                    (\"SappySeals2546\", 458.50),
                    (\"SappySeals4598\", 1478.99),
                    (\"SappySeals1456\", 85.50),
                    (\"SappySeals4587\", 412.99)";

                if ($resultQ = mysqli_query($mysqliConnection, $sql)){
                printf("nft inserito correttamente <br />\n");}
                else {
                printf("Errore inserimento nft <br />\n");
                exit();
                }
                // --- POPOLAMENTO IMMAGINI ---
                // Immagini per l'NFT 1 (SappySeals)
                $sqlImg = "INSERT INTO $immagini_nft (nftId, percorso_file) VALUES 
                        (1, \"../imgdb/imgcostosa1.png\"),
                        (2, \"../imgdb/imgcostosa5.png\"), 
                        (3, \"../imgdb/imgcostosa9.png\"),
                        (4, \"../imgdb/imgrara3.jpg\"),
                        (5, \"../imgdb/imgrara7.jpg\"), 
                        (6, \"../imgdb/imgrara8.jpg\")"; 
                    // Una sola immagine per il secondo
                if (mysqli_query($mysqliConnection, $sqlImg)) {
                    printf("Immagini collegate correttamente agli NFT.<br>");
                } else {
                    printf("Errore inserimento immagini: " . mysqli_error($mysqliConnection) . "<br>");
                }
                //chiudiamo la connessione
                $mysqliConnection->close();

        ?>
    </body>
</html>