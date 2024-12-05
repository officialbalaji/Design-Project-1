<?php
  session_start();
  require_once 'dbh.inc.php';
  require_once 'functions.inc.php';
  if($_SESSION['onetimepassword']==="otp_createUser"){
  $fname = $_SESSION['user_data']['fn'];
  $lname = $_SESSION['user_data']['ln'];
  $email = $_SESSION['user_data']['email'];
  $username = $_SESSION['user_data']['u'];
  $psw = $_SESSION['user_data']['psw'];
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if($_SESSION['user_data']['otp']==$_POST["user_otp"]){
           
            if (createUser($conn, $fname, $lname, $email, $username, $psw)) {
              $_SESSION['user_data']['fn']="";
              $_SESSION['user_data']['ln']="";
              $_SESSION['user_data']['email']="";
              $_SESSION['user_data']['u']="";
              $_SESSION['user_data']['psw']="";
              $_SESSION["otp"]="";
              echo '<script>window.alert("You have successfully registered to the system. Now you can login to the system"); window.location.href = "../redirect.login.php";</script>';
                exit();
            } else {
                header("Location:../signup.php?error=stmtfailed");
                exit();
            }
        } else {
            echo '<script>window.alert("Wrong OTP!");</script>';
        }
    }
  } else if ($_SESSION['onetimepassword']==="otp_form"){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if($_SESSION['form_data']['otp']==$_POST["user_otp"]){
        $stmt = $conn->prepare("CALL InsertFormData(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, @reference_number, @generatePassword, @msg)");
        $stmt->bind_param(
          'sssssssssssssssssssss',
            $_SESSION['form_data']["email_id"],
            $_SESSION['form_data']["userName"],
            $_SESSION['form_data']["givenName"],
            $_SESSION['form_data']["surname"],
            $_SESSION['form_data']["gender"],
            $_SESSION['form_data']["dob"],
            $_SESSION['form_data']["birth_place"],
            $_SESSION['form_data']["marital_status"],
            $_SESSION['form_data']["Address_out_of_India"],
            $_SESSION['form_data']["house_street"],
            $_SESSION['form_data']["village_town_city"],
            $_SESSION['form_data']["state_text"],
            $_SESSION['form_data']["district_text"],
            $_SESSION['form_data']["police_station"],
            $_SESSION['form_data']["pin_code"],
            $_SESSION['form_data']["mobile_number"],
            $_SESSION['form_data']["telephone_number"],
            $_SESSION['form_data']["aadhaar"],
            $_SESSION['form_data']["voter"],
            $_SESSION['form_data']["pan"],
            $_SESSION['form_data']["encryptionKey"]
        );
        if ($stmt->execute()) {
          $result = $conn->query("SELECT @reference_number AS reference_number, @generatePassword AS generatePassword, @msg AS msg");
          if ($result) {
              $output = $result->fetch_assoc();
              if ($output['msg']==='yes') {
                sendEmail($_SESSION['form_data']["email_id"], "Form Submission Successful", "Your form has been submitted successfully.<br><br> Reference number is: <b>" .$output["reference_number"]."</b><br>Your Passsord is: <b>" .$output["generatePassword"]."</b>");
                echo "<script> alert('Form submission Successfully. Reference Number sent to " . $_SESSION['form_data']["email_id"] . "'); window.location.href='../closer.php'; </script>";
              } else {
                sendEmail($_SESSION['form_data']["email_id"], "Form Submission Error", "The details provided (Aadhaar, PAN, Voter ID) are incorrect. Please check and try again.");
                echo "<script> alert('Form submission failed. Error details sent to " . $_SESSION['form_data']["email_id"] . "'); window.location.href='../closer.php';</script>";
              }
          } else {
              echo "Error retrieving output variables.";
          }
        } else {
          echo "Error executing procedure: " . $stmt->error;
        }
        $stmt->close();
      } else {
        echo '<script>window.alert("Wrong OTP!");</script>';
      }
    }
  } else {
    echo "<script>window.location.href='../index.php';</script>";
  }
?>
<style>
  .closer{
            position: absolute;
            margin-top: 40px;
            margin-left: 365px;
            font-size: 30px;
            box-sizing: 10px;
            width: 40px;
            text-align: center;
            color:black;
            border: 3px solid red;
            border-radius: 10px;

        }
        .closer:hover{
            border: 3px solid black;
            color: red;
        }
.otp_containter{
	margin-top: 140px;
    margin-left:540px;
	background-color: #E5E4E2;
    border-radius: 10px;
    border: 1px solid black;
	box-sizing: border-box;
    height:350px;
	width: 450px;
}
h1{
  position: absolute;
  margin-top: 15px;
  margin-left:175px;
}
.txt{
    margin-top: 80px;   
    margin-left:30px;
    position: absolute;
    font-size:30px;
}
.inp{
    margin-top: 140px;
    margin-left:30px;
    width:300px;
    height:35px;
    font-size:20px;
    position: absolute;
}
.btn{
    border-radius: 10px;
    border: 1px solid white;
    margin-top: 210px;
    width:150px;
    height:40px; 
    margin-left:30px;
    font-size:18px;
    color:white;
    background-color:#46D670;
    position: absolute;
}
.btn:hover{
	background-color: #04AA6D;
}
.login-button {
    background-color: #04AA6D;
    color: white;
    padding: 14px 20px;
    border: none;
    cursor: pointer;
    width: 100%;
    border-radius: 9px;
  }
  
  .login-button:hover {
    opacity: 0.8;
    border-radius: 12px;
  }
  
  .cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
    cursor: pointer;
    border: 1px solid #f44336;
  }
  
  .cancelbtn:hover {
      opacity: 0.8;
  }
  
  .imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
    position: relative;
  }
  .avatar {
    height: auto;
    width: 20%;
    border-radius: 50%;
  }
  
  .container {
    padding: 16px;
  }
  
  span.psw {
    float: right;
    padding-top: 16px;
  }
  

  .modal {
    display: none; 
    position: fixed; 
    z-index: 1; 
    left: 0;
    top: 0;
    width: 100%; 
    height: 100%; 
    overflow: auto; 
    background-color: rgb(0,0,0); 
    background-color: rgba(0,0,0,0.4);
    padding-top: 60px;
  }
  
  
  .modal-content {
    background-color: #fefefe;
    margin: 5% auto 15% auto; 
    border: 1px solid #888;
    height: 60%;
    width: 30%; 
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  
  
  .close {
    position: absolute;
    right: 25px;
    top: 0;
    color: #000;
    font-size: 35px;
    font-weight: bold;
  }
  
  .close:hover,
  .close:focus {
    color: red;
    cursor: pointer;
  }
  
 
  .animate {
    -webkit-animation: animatezoom 0.6s;
    animation: animatezoom 0.6s
  }
</style>
<script>
        function closer(){
            if (confirm("Do you want to Close proceed?")) { 
              window.location.href="../closer.php";
            } 
        }
    </script>
    <link rel="stylesheet" href="../CSS/style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
  
<div class="otp_containter">

    <div class="otp_box">
      <h1>Sign UP</h1>
    <a onclick="closer()" class="closer"><b>&times;</b></a>
        <form method="post" action="otpverified.php">
                <label class="txt" for="otp">Enter OTP:</label>
                <input class="inp" type="text" name="user_otp" required />
                <button class="btn" type="submit" name="verify_otp">Verify OTP</button>
        </form>
    </div>
</div>
