<?php
require 'functions.php';
require_once '../includes/dbh.inc.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $voter_number = $_POST['voter_number'];
    $name = $_POST['name'];
    $state = $_POST['state'];
    $district = $_POST['district'];
    
    insertVoter($conn, $voter_number, $name, $state, $district);
    $_SERVER['REQUEST_METHOD']="";
} 
?>

<html>
<head>
    <title>Voter Input</title>
</head>
<body>
    <h1>Enter Voter Details</h1>
    <form method="POST" action="voter.php">
        <label for="aadhaar_number">Voter Number:</label>
        <input type="text" name="voter_number" required><br><br>
          
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
