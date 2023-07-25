<?php
session_name("SessioneUtente");
session_start();
if (!isset($_SESSION['accessoPermesso'])) {
       header('Location: ../php/login.php');    
}
else{?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">
    
       <head>
            <title>Homework1-2/3</title>
            <link rel="stylesheet" href="../css/Style.css" type="text/css" />
       </head>

       <body>
              <h3>Grande Bro</h3>
       </body>
</html>
<?php
}
?>