<?php
session_start();
require_once "conexion.inc.php";

// conseguir data dropdown
$modes = $linkConexion->query("SELECT * FROM modes_of_transport");
$countries = $linkConexion->query("SELECT * FROM countries");


// asegurarse que el usuario a iniciado session
$userID = $_SESSION['UserID'] ?? null;
if (!$userID) {
    die("You must be logged in to submit a ticket.");
}
//despues de esto se le añaden a los dropdowns la informacion de la BDD
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Ticket</title>
</head>
<body>
    <h2>Create Ticket</h2>

    <form action="submitTicket.php" method="post" enctype="multipart/form-data">
        <label for="TicketName">Ticket Name:</label><br>
        <input type="text" id="TicketName" name="TicketName" required><br><br>

        <label for="TicketType">Ticket Type:</label><br>
        <select id="TicketType" name="TicketType" required>
            
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            
        </select><br><br>

        <label for="ModeOfTransport">Mode of Transport:</label><br>
        <select id="ModeOfTransport" name="ModeOfTransport" required>
            <?php while ($row = $modes->fetch_assoc()): ?>
                <option value="<?= $row['idModesOfTransport'] ?>"><?= $row['ModesOfTransportName'] ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <label for="CountryOrigin">Country of Origin:</label><br>
        <select id="CountryOrigin" name="CountryOrigin" required>
            <?php while ($row = $countries->fetch_assoc()): ?>
                <option value="<?= $row['idCountries'] ?>"><?= $row['CountriesName'] ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <label for="CountryDestination">Country of Destination:</label><br>
        <select id="CountryDestination" name="CountryDestination" required>
            <?php
            $countries->data_seek(0); // ambos countries tienen que tener las mismas opciones
            while ($row = $countries->fetch_assoc()): ?>
                <option value="<?= $row['idCountries'] ?>"><?= $row['CountriesName'] ?></option>
            <?php endwhile; ?>
        </select><br><br>
                

        <label for="Document">Upload Document (PDF, DOC, JPG):</label><br>
        <input type="file" id="Document" name="Document" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" required><br><br>

        <input type="hidden" name="UserID" value="<?= $userID ?>">

        <input type="submit" value="Submit Ticket">
    </form>
    
</body>
</html>