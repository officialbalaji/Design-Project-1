<?php
// Insert data into Aadhaar table
function insertAadhaar($conn, $aadhaar_number, $name, $state, $district) {

    $stmt = $conn->prepare("INSERT INTO aadhaar (aadhaar_number, name, state, district) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $aadhaar_number, $name, $state, $district);

    if ($stmt->execute()) {
        echo "<script>alert('Aadhaar data inserted successfully!');</script>";
    } 
    $stmt->close();
}

// Insert data into PAN table
function insertPan($conn, $pan_number, $name,$state, $district) {

    $stmt = $conn->prepare("INSERT INTO pan (pan_number, name, state, district) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $pan_number, $name, $state, $district);

    if ($stmt->execute()) {
        echo "<script>alert('Pan data inserted successfully!');</script>";
    } 
    $stmt->close();
}

// Insert data into Voter table
function insertVoter($conn, $voter_id, $name, $state, $district) {

    $stmt = $conn->prepare("INSERT INTO voter (voter_id, name, state, district) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $voter_id, $name, $state, $district);

    if ($stmt->execute()) {
        echo "<script>alert('Voter data inserted successfully!');</script>";
    } 
    $stmt->close();
}
?>
