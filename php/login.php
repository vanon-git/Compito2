<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    session_start();

    /* Se l'utente loggato ripassa per Accedi/Registrati viene fatto l'unset, altrimenti carrello uguale per un utente con doppio account o per due utenti diversi */
    if (isset($_SESSION['accessoPermesso'])){
        unset($_SESSION);
        session_destroy();
    }

    /*dati sui nomi delle tabelle e del database, nonche' sulle modalita' di 
    connessione e di selezione del database sono messi in un file a parte */
    require_once("./connessione1.php");

    // una volta che siamo nel db, verichiamo cosa e' stato passato come username
    // e pwd e facciamo una quesry per controllare
    if (isset($_POST['invio'])){          // abbiamo appena inviato dati attraverso la form di login
        if (empty($_POST['username']) || empty($_POST['password'])){
            echo "<p>Non hai inserito i dati,Riprova</p>";
        }else {
            //verifichiamo se i dati inseriti corrispondono a un account esistente
            $sql = "SELECT *
                    FROM $utenti
                    WHERE username = \"{$_POST['username']}\" AND password =\"{$_POST['password']}\"
                    ";

            // il risultato della query va in $resultQ
            if (!$resultQ = mysqli_query($mysqliConnection, $sql)) {
                printf("Errore, la query non ha risultato\n");
                exit();
            }
            
            //se l'account esiste
            $row = mysqli_fetch_array($resultQ);

            if($row) {  
                session_start();
                $_SESSION['nome']=$row['nome'];
                $_SESSION['cognome']=$row['cognome'];
                $_SESSION['username']=$_POST['username'];
                $_SESSION['totaleAcquisti']=$row['totaleAcquisti'];
                $_SESSION['dataLogin']=time();
                $_SESSION['accessoPermesso']=1000;
                header('Location: shop.php');    // accesso alla pagina iniziale
                exit();
            }else 
                echo "<p>Utente non trovato, riprova oppure se non sei registrato torna alla home e clicca su registrati</p>";
        }
    }

    //chiudiamo la connessione
    $mysqliConnection->close();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
  <link rel="stylesheet" href="../css/style3.css" type="text/css">
  <title>Pagina Login</title>
</head>

<body>
  <div><h3>Login Form</h3>
<form action="<?php $_SERVER['PHP_SELF']?>" method="post">
  <p>username: <input type="text" name="username" size="30" /></p>
  <p>password: <input type="text" name="password" size="30" /></p>

<input type="submit" name="invio" value="accedi" >
<input type="reset" name="reset" value="reset" >
<input type="reset" name="registrati" value="registrati" href=../index.html>
</form>
</div>

<hr />
</body>
</html>


