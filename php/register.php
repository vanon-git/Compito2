<!DOCTYPE html>
<?php
  ini_set('display_errors', 1);
  error_reporting(E_ALL);
  require_once("./connessione1.php");
    if(isset($_POST['invio'])) {
    //Validazione campi
      if(($_POST['nome']) && ($_POST['cognome']) && ($_POST['username']) && ($_POST['password']) ) {
        //verifica se utente già registrato
        $sql = "SELECT *
        FROM $utenti
        WHERE username = \"{$_POST['username']}\"
        ";
            
        // il risultato della query va in $resultQ
        if (!$resultQ = mysqli_query($mysqliConnection, $sql)) {
          printf("Errore nel controllo dei dati.\n");
          exit();
          }

            $row = mysqli_fetch_array($resultQ);

            if($row){
                printf("<em> Se sei già registarto, <a href='login.php'>accedi qui</a>.\n");
            }else{
                $sql = "INSERT INTO $utenti
                (nome, cognome, username, password, sommeSpese)
                VALUES
                ('{$_POST['nome']}', '{$_POST['cognome']}','{$_POST['username']}','{$_POST['password']}', \"0\")
                ";

                //controllo query
                if(!($resultQ = mysqli_query($mysqliConnection, $sql))) {
                    printf("Si è verificato un errore. Impossibile registrarsi.\n");
                    exit();
                }else{
                    printf("<p>Registrazione completata con successo! 
                                <br /><a href='login.php'>Clicca qui per effettuare il login</a></p>");
                }
            }
        }else{
            printf("<em>Tutti i campi sono obbligatori.</em>");
        }
    }
        //chiudiamo la connessione
    $mysqliConnection->close();

?>
<html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<head>
  <link rel="stylesheet" href="../css/style3.css" type="text/css">
  <title>Pagina Registrazione</title>
</head>

<body>
  <div><h3>Form per la Registrazione</h3>
<form action="<?php $_SERVER['PHP_SELF']?>" method="post">
  <p>username: <input type="text" name="username" size="30" /></p>
  <p>password: <input type="text" name="password" size="30" /></p>

<input type="submit" name="invio" value="Registrati" >
<input type="reset" name="reset" value="reset" >
</form>
</div>

<hr />
</body>
</html>