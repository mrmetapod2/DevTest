<?php
require_once "conexion.inc.php";

//saco la id del ticket del post
$ticketId = $_POST['id'] ?? '';

$sql= "SELECT  `documentLocation` FROM `documents` WHERE `idTicket`='{$ticketId}'";
$result = $linkConexion->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Tickets</title>
</head>
<body>
    <h2>All Tickets</h2>
        <table>
            <tr>
                <th>Document Location</th>
                <th>View</th>
               
            </tr>
            <?php while ($row = $result->fetch_assoc()):?>
            <tr>
                <td><?= $row['documentLocation'] ?></td>
                <td><a href="<?= htmlspecialchars($row['documentLocation']) ?>" target="_blank">View</a></td>
            </tr>
            <?php endwhile; ?>


</body>

