<?php

$ticketId=$_GET["ticketId"];

?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Documents</title>
</head>
<body>
    <form action="submitDocumentation.php" method="post" enctype="multipart/form-data">
        <label for="Document">Upload Document (PDF, DOC, JPG):</label><br>
        <input type="file" id="Document" name="Document" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" required><br><br>
        <input type="hidden" name="ticketId" value="<?= $ticketId ?>">
        <input type="submit" value="Submit Document">
    </form>
</body>