<?php
require 'functions.php';
require_once '../includes/dbh.inc.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pan_number = $_POST['pan_number'];
    $name = $_POST['name'];
    $state = $_POST['state'];
    $district = $_POST['district'];
    
    insertPan($conn,$pan_number, $name, $state, $district);
    $_SERVER['REQUEST_METHOD']="";
}
?>

<html>
<head>
    <title>Pan Input</title>
</head>
<body>
    <h1>Enter Pan Details</h1>
    <form method="POST" action="pan.php">
        <label for="aadhaar_number">Pan Number:</label>
        <input type="text" name="pan_number" required><br><br>
          
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
