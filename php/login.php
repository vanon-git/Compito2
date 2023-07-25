<!DOCTYPE html>
<?php
  ini_set('display_errors', 1);
error_reporting(E_ALL);

// dati sul database e le tabelle (magari messi in un file a parte ...)
$db_name = "pluto";
$utenti= "utenti";
$nft = "nft";
$gadget = "gadget";

// effettuazione della connessione al database
// archer e' un utente che ha accesso alla base di dati; la sua password e' archer as well
$mysqliConnection = new mysqli("localhost", "root", "",$db_name);

// controllo della connessione (versione "procedurale,
// as opposed to the "object-oriented version" msqli->connect_errno...
//
if (mysqli_connect_errno()) {
    printf("Oops, abbiamo problemi con la connessione al db: %s\n", mysqli_connect_error());
    exit();
}

// una volta che siamo nel db, verichiamo cosa e' stato passato come username
// e pwd e facciamo una quesry per controllare
//
if (isset($_POST['invio']))          // abbiamo appena inviato dati attraverso la form di login
  if (empty($_POST['username']) || empty($_POST['password']))
    echo "<p>Non hai inserito i dati,Riprova</p>";
  else {                             
     // controllo dati
     // username e password ricevuti corrispondono a  quel che c'e' nella tabella STuser?
     // questa e' la query di controolo
    $sql = "SELECT utenti.username, utenti.password
            FROM $utenti
  WHERE username = \"{$_POST['username']}\" AND password =\"{$_POST['password']}\"";
    // il risultato ("result set") della query va in $resultQ
    if (!$resultQ = mysqli_query($mysqliConnection, $sql)) {
        printf("Oops, la query non ha risultato !!\n");
    exit();
    }

    // prendiamo una riga dal risultato (in questo caso il risultato ha una sola
    // riga perche' c'e' un solo utente, se c'e', corrsipondente ai dati, ma in
    // altre occasioni il risultato potrebbe essere un insieme di righe distinte
    // della tabella ...
    // la funzione restituisce un array (anche associativo per default)
    // con i valori della riga selezionata, oppure NULL - se non c'e' la riga
    $row = mysqli_fetch_array($resultQ);

    if ($row) {   // utente esiste valido
      session_name("SessioneUtente");
      session_start();
      $_SESSION['username']=$_POST['username'];
      $_SESSION['dataLogin']=time();
      $_SESSION['numeroUtente']=$row['userId'];
      $_SESSION['totaleAcquisti']=$row['totaleAcquisti'];
      $_SESSION['accessoPermesso']=1000;
      header('Location: ../File/tre.php');    // accesso alla pagina iniziale
      exit();
    
    }else{
    echo "<p>Non sei presente tra gli utenti, riprova oppure se non sei registrato clicca il tasto registrati</p>";
    
  }
}

  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
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


