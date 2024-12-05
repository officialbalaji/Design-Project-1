<?php
require_once 'dbh.inc.php';
require_once 'functions.inc.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    session_start();
    $keyResult = $conn->query("SELECT KeyGenerate() AS encryptionKey");
    if ($keyResult) {
        $keyRow = $keyResult->fetch_assoc();
        $encryptionKey = $keyRow['encryptionKey'];
    } else {
        die("Error generating encryption key: " . $conn->error);
    }

    function encryptData($conn,$data, $key) {
        $sql = "SELECT EncryptData('$data', '$key') AS encrypted_text";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['encrypted_text'];
        }
    }
    $_SESSION['form_data']["givenName"] = encryptData($conn, $_POST["given_name"], $encryptionKey);
    $_SESSION['form_data']["surname"] = encryptData($conn, $_POST["surname"], $encryptionKey);
    $_SESSION['form_data']["gender"] = encryptData($conn, $_POST["Gender"], $encryptionKey);
    $_SESSION['form_data']["dob"] = encryptData($conn, $_POST["dob"], $encryptionKey);
    $_SESSION['form_data']["birth_place"] = encryptData($conn, $_POST["birth_place"], $encryptionKey);
    $_SESSION['form_data']["marital_status"] = encryptData($conn, $_POST["marital_status"], $encryptionKey);
    $_SESSION['form_data']["Address_out_of_India"] = encryptData($conn, $_POST["Address_out_of_India"], $encryptionKey);
    $_SESSION['form_data']["state_text"] = encryptData($conn, $_POST["state_text"], $encryptionKey);
    $_SESSION['form_data']["district_text"] = encryptData($conn, $_POST["district_text"], $encryptionKey);
    $_SESSION['form_data']["house_street"] = encryptData($conn, $_POST["house_street"], $encryptionKey);
    $_SESSION['form_data']["village_town_city"] = encryptData($conn, $_POST["village_town_city"], $encryptionKey);
    $_SESSION['form_data']["police_station"] = encryptData($conn, $_POST["police_station"], $encryptionKey);
    $_SESSION['form_data']["pin_code"] = encryptData($conn, $_POST["pin_code"], $encryptionKey);
    $_SESSION['form_data']["mobile_number"] = encryptData($conn, $_POST["mobile_number"], $encryptionKey);
    $_SESSION['form_data']["telephone_number"] = encryptData($conn, $_POST["telephone_number"], $encryptionKey);
    $_SESSION['form_data']["userName"] = $_POST["userName"];
    $_SESSION['form_data']["aadhaar"] = encryptData($conn, $_POST["aadhaar"], $encryptionKey);
    $_SESSION['form_data']["voter"] = encryptData($conn, $_POST["voter"], $encryptionKey);
    $_SESSION['form_data']["pan"] = encryptData($conn, $_POST["pan"], $encryptionKey);
    $_SESSION['form_data']["email_id"] = $_POST["email_id"];
    $_SESSION['form_data']["encryptionKey"] = $encryptionKey;
    $_SESSION['form_data']["otp"] = sendOTP($_POST["email_id"]);
    $_SESSION['onetimepassword']="otp_form";
    echo '<script>window.location.href = "otpverified.php";</script>';
} else {
    echo '<script>alert("Message"); window.location.href = "../index.php";</script>';
}
?>