<div class="toolbar-space">
    <div class="toolbar" id="border">
        <?php
        require_once 'C:\xampp\htdocs\DP\includes\dbh.inc.php';

        function checkPassport($userName,$conn){
            try{
            $sql = "SELECT * FROM forms WHERE userName = ?";
            $stmt = mysqli_stmt_init($conn);
        
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                return false; 
            }
        
            mysqli_stmt_bind_param($stmt, "s", $userName);
            mysqli_stmt_execute($stmt);
            $resultData = mysqli_stmt_get_result($stmt);
        
            if (mysqli_fetch_assoc($resultData)) {
                return false;
            } else {
                return true;
            }
        
            mysqli_stmt_close($stmt);
        } catch(Exception $e){}
        }

        if (isset($_SESSION['username'])) {
            if(checkPassport($_SESSION['username'],$conn)){
            if(isset($_SESSION['forms'])&& $_SESSION["forms"]!==""){
                echo '<a class="active" onclick="closeFormPage()" target="_blank"><i  class="fas fa-passport" ></i>Close Form</a><br><br>';
            } else {
                echo '<a class="active" onclick="openFormPage()" target="_blank"><i  class="fas fa-passport" ></i>New Passport</a><br><br>';
            }
        }
            echo '
                <a href="status.php" target="_blank"><i class="fa fa-fw fa-user"></i>Passport Status</a><br><br>
                <a href="office.php" target="_blank"><i class="fa fa-search"></i>Passport Office(IN)</a><br>';
     } else {
            echo '
                <a href="redirect.login.php" target="_blank"><i class="fas fa-passport"></i>New Passport</a><br><br>
                <a href="redirect.login.php"><i class="fa fa-fw fa-user"></i>Passport Status</a><br><br>
                <a href="redirect.login.php"><i class="fa fa-search"></i>Passport Office(IN)</a><br>';
               
        }
        ?>
        <br><br><br><br>
    </div>
</div>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<script>
    function openFormPage() {
        formPageWindow = window.location.href = 'form_gen.php';
    }
    function closeFormPage() {
        formPageWindow = window.location.href = 'closer.php';
    }
</script>