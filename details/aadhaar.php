<?php
require 'functions.php';
require_once '../includes/dbh.inc.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aadhaar_number = $_POST['aadhaar_number'];
    $name = $_POST['name'];
    $state = $_POST['state'];
    $district = $_POST['district'];
    
    insertAadhaar($conn,$aadhaar_number, $name,$state, $district);
    $_SERVER['REQUEST_METHOD']="";
} else {
    echo "Invalid request method.";
}
?>

<html>
<head>
    <title>Aadhaar Input</title>
</head>
<body>
    <h1>Enter Aadhaar Details</h1>
    <form method="POST" action="aadhaar.php">
        <label for="aadhaar_number">Aadhaar Number:</label>
        <input type="text" name="aadhaar_number" required><br><br>
          
        <label for="decryptionKey">Name:</label>
        <input type="text" name="name" required><br><br>

        <label for="state">State:</label>
        <input type="text" name="state" required><br><br>
        
        <label for="district">District:</label>
        <input type="text" name="district" required><br><br>
        
        <input type="submit" value="Submit">
    </form>
    <button href="main.php">Back</button>
</body>
</html>
