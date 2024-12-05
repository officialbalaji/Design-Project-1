<?php
session_start();
require_once 'includes/dbh.inc.php';

if (isset($_SESSION["status"])) {
        
        $sql = "SELECT * FROM reference WHERE reference_number = ? AND ref_password = ? AND email = ? AND username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $_SESSION["referrence"], $_SESSION["password"], $_SESSION["email_id"], $_SESSION["userName"]);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $progressStatuses = [
                'userCreated' => true,
                'basicDetails' => false,
                'docVerified' => false,
                'imageVerified' => false,
                'passcodeSet' => false,
                'passportIssued' => false,
            ];

            // Check completion statuses for each step
            $queries = [
                'basicDetails' => "SELECT * FROM forms WHERE email_id = ? AND userName = ?",
                //'docVerified' => "SELECT * FROM document WHERE email = ? AND username = ?",
                //'imageVerified' => "SELECT * FROM img WHERE email = ? AND username = ?",
                //'passcodeSet' => "SELECT * FROM passcode WHERE email = ? AND username = ?",
                //'passportIssued' => "SELECT * FROM passport WHERE email = ? AND username = ?",
            ];

            foreach ($queries as $key => $query) {
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ss", $_SESSION["email_id"], $_SESSION["userName"]);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $progressStatuses[$key] = true;
                }
            }

            // Pass statuses to the session
            $_SESSION['progressStatuses'] = $progressStatuses;
        } else {
            echo "<script>alert('Invalid reference or password. Please check your details.'); window.location.href = 'status.php';</script>";
            exit;
        }
    }
?><br><br> <h1 align="center">Complete All Categories Details</h1>
<br><br>
<div class="progress-tracker">
    <?php
    $progressStatuses = $_SESSION['progressStatuses'] ?? [
        'userCreated' => true,
        'basicDetails' => false,
        'docVerified' => false,
        'imageVerified' => false,
        'passcodeSet' => false,
        'passportIssued' => false,
    ];

    $steps = [
        'userCreated' => 'User Created',
        'basicDetails' => 'Basic Details',
        'docVerified' => 'Document Verified',
        'imageVerified' => 'Image & Video Verified',
        'passcodeSet' => 'Passcode Set',
        'passportIssued' => 'Passport Issued',
    ];

    foreach ($steps as $key => $label) {
        $completed = $progressStatuses[$key] ?? false;
        $class = $completed ? 'completed' : '';
        $buttonState = $completed ? 'disabled' : '';
        echo "
            <div class='step $class'>
                <div class='status-icon'>" . ($completed ? "✓" : "") . "</div>
                <p>$label</p>
                <button class='action-btn' $buttonState>" . ($completed ? "Completed" : "Complete") . "</button>
            </div>
        ";
    }
    ?>
</div>
 <style>
button:disabled {
    background-color: red;
    color: white;
    cursor: not-allowed;
    border: 1px solid darkred;
}

.progress-tracker {
    display: flex;
    justify-content: space-around;
    align-items: center;
    margin-top: 20px;
}

.step {
    text-align: center;
    position: relative;
    margin: 0 10px;
}

.status-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: gray;
    margin: 0 auto 10px;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    font-size: 18px;
    transition: all 0.3s ease;
    border: 2px solid #ddd;
}

.step.completed .status-icon {
    background: green;
    border: 2px solid darkgreen;
}

.action-btn {
    padding: 8px 12px;
    font-size: 14px;
    background: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.action-btn:disabled {
    background: red;
    border: 1px solid darkred;
    color: white;
}

</style>