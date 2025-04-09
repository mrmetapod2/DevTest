<?php
require_once "conexion.inc.php";
//sql select of all data in the tickets table
$sql = "
    SELECT 
        t.idTickets,
        t.TicketName,
        t.TicketType,
        t.Status,
        mt.ModesOfTransportName,
        co.CountriesName AS CountryOriginName,
        cd.CountriesName AS CountryDestinationName,
        u.UserName,
        u.UserEmail,
        ts.TicketStatusName,
        t.Document
    FROM tickets t
    JOIN modes_of_transport mt ON t.ModeOfTransport = mt.idModesOfTransport
    JOIN countries co ON t.CountryOrigin = co.idCountries
    JOIN countries cd ON t.CountryDestination = cd.idCountries
    JOIN user u ON t.User_UserID = u.UserID
    JOIN ticket_status ts ON t.Status = ts.idTicketStatus
";

$result = $linkConexion->query($sql);

if (!$result) {
    die("Query failed: " . $linkConexion->error);
}
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
            <th>ID</th>
            <th>Name</th>
            <th>Type</th>
            <th>Transport</th>
            <th>Origin</th>
            <th>Destination</th>
            <th>User</th>
            <th>Status</th>
            <th>Document</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): //inserting all the data into a table ?>
            <tr>
                <td><?= $row['idTickets'] ?></td>
                <td><?= htmlspecialchars($row['TicketName']) ?></td>
                <td><?= htmlspecialchars($row['TicketType']) ?></td>
                <td><?= htmlspecialchars($row['ModesOfTransportName']) ?></td>
                <td><?= htmlspecialchars($row['CountryOriginName']) ?></td>
                <td><?= htmlspecialchars($row['CountryDestinationName']) ?></td>
                <td><?= htmlspecialchars($row['UserName']) ?></td>
                <td><?= htmlspecialchars($row['TicketStatusName']) ?></td>
                <td>
                    <?php if ($row['Document']): ?>
                        <a href="<?= htmlspecialchars($row['Document']) ?>" target="_blank">View</a>
                    <?php else: ?>
                        No File
                    <?php endif; ?>
                </td>
                <td class="actions">
                    <?php if($row['Status']==1 ){?>
                        <form method="post" action="change.php" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $row['idTickets'] ?>">
                            <input type="hidden" name="email" value="<?= htmlspecialchars($row['UserEmail']) ?>">
                            <input type="hidden" name="status" value="2">
                           
                            <button type="submit">Accept</button>
                        </form>
                    <?php  } ?>
                    <?php if($row['Status']!=3){?>
                    <form method="post" action="docRequest.php" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $row['idTickets'] ?>">
                        <input type="hidden" name="email" value="<?= htmlspecialchars($row['UserEmail']) ?>">
                        <input type="hidden" name="name" value="<?= htmlspecialchars($row['TicketName']) ?>">
                        <button type="submit">Request documents</button>
                    </form>
                    
                        <form method="post" action="change.php" style="display:inline;" >
                            <input type="hidden" name="id" value="<?= $row['idTickets'] ?>">
                            <input type="hidden" name="email" value="<?= htmlspecialchars($row['UserEmail']) ?>">
                            <input type="hidden" name="status" value="3">
                           
                            <button type="submit">Complete</button>
                        </form>
                    <?php  } ?>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>