<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

if (!isset($_SESSION['accessoPermesso'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['ruolo']) || $_SESSION['ruolo'] != 'admin') {
    header("Location: shop.php");
    exit();
}

require_once("./connessione.php");

$sql = "SELECT username, nome, cognome, totaleAcquisti, ruolo
        FROM " . TBL_UTENTI . "
        ORDER BY totaleAcquisti DESC";

if (!$resultQ = mysqli_query($mysqliConnection, $sql)) {
    printf("Errore query admin.");
    exit();
}

$mysqliConnection->close();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="it">
<head>
    <title>Admin - Riepilogo Utenti</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <?php require_once("./stile_shop.php");
    echo $stile_shop;
 ?>
</head>
<body>
    <?php require_once("./menu_shop.php"); ?>

    <div class="container-principale">
        <div style="flex: 1; width: 100%;">
            <h1 style="font-size: 30px; font-weight: 900; letter-spacing: -0.5px; margin-bottom: 18px;">
                Riepilogo Utenti
            </h1>

            <div style="
                background: var(--surface);
                border: 1px solid var(--border);
                border-radius: 22px;
                padding: 14px;
                box-shadow: var(--shadow);
                overflow-x: auto;
            ">
                <table style="
                    width: 100%;
                    border-collapse: collapse;
                    background: transparent;
                ">
                    <thead>
                        <tr>
                            <th style="padding: 16px 14px; text-align: left; background: var(--primary); color: #ffffff; font-weight: 800;">
                                Username
                            </th>
                            <th style="padding: 16px 14px; text-align: left; background: var(--primary); color: #ffffff; font-weight: 800;">
                                Nome
                            </th>
                            <th style="padding: 16px 14px; text-align: left; background: var(--primary); color: #ffffff; font-weight: 800;">
                                Cognome
                            </th>
                            <th style="padding: 16px 14px; text-align: right; background: var(--primary); color: #ffffff; font-weight: 800;">
                                Totale €
                            </th>
                            <th style="padding: 16px 14px; text-align: center; background: var(--primary); color: #ffffff; font-weight: 800;">
                                Ruolo
                            </th>
                        </tr>
                    </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($resultQ)) { ?>
            <tr style="
                border-bottom: 1px dashed var(--border);
                <?php echo ($row['ruolo'] == 'admin') ? 'background: rgba(245, 158, 11, 0.12);' : ''; ?>
            ">
                <td style="padding: 16px 14px; font-weight: 700;">
                    <?php echo htmlspecialchars($row['username']); ?>
                </td>
                <td style="padding: 16px 14px;">
                    <?php echo htmlspecialchars($row['nome']); ?>
                </td>
                <td style="padding: 16px 14px;">
                    <?php echo htmlspecialchars($row['cognome']); ?>
                </td>
                <td style="
                    padding: 16px 14px;
                    text-align: right;
                    font-weight: 900;
                    color: <?php echo ($row['ruolo'] == 'admin') ? 'var(--warning)' : 'var(--primary)'; ?>;
                ">
                    <?php echo number_format($row['totaleAcquisti'], 2); ?> €
                </td>
                <td style="padding: 16px 14px; text-align: center;">
                    <span style="
                        background: <?php echo ($row['ruolo'] == 'admin') ? 'var(--warning)' : 'var(--success)'; ?>;
                        color: #ffffff;
                        padding: 6px 12px;
                        border-radius: 12px;
                        font-weight: 700;
                        font-size: 12px;
                        text-transform: uppercase;
                        display: inline-block;
                    ">
                        <?php echo htmlspecialchars($row['ruolo']); ?>
                    </span>
                </td>
            </tr>
            <?php } ?>
        </tbody>
                </table>
            </div>

            <div style="text-align: center; margin-top: 24px;">
                <a href="logout.php" class="bottone">Logout</a>
            </div>
        </div>
    </div>
</body>
</html>