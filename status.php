<?php
include_once 'import/header.php';
if (!isset($_SESSION['fname'])) {
    echo '<script>window.alert("Please log in to check in"); window.location.href = "redirect.login.php";</script>';
    exit;
}
?>
<div class="manage-account-container">
    <h2>Passport Status</h2>
    <form class="account-form" id="check-status" action="process_status.php" method="post">
        <div class="form-group">
            <label for="referrence">Enter Reference Number</label>
            <input type="text" id="referrence" name="referrence" required>
        </div>
        <div class="form-group">
            <label for="password">Enter Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group captcha-container">
            <canvas id="captchaCanvas" width="200" height="70"></canvas>
            <label >Enter the characters as shown above:</label>
            <input type="text" id="captchaInput" name="captchaInput" placeholder="Enter CAPTCHA" required>
            <input type="hidden" id="captchaValue" name="captchaValue">
            <button type="button" onclick="generateCaptcha()">♻ Regenerate</button>
        </div>
        <br>
        <input type="hidden" name="email_id" value='<?php echo $_SESSION["email"]; ?>' > <!--Hidden Email*ID-->
        <input type="hidden" name="userName"  value='<?php echo $_SESSION["username"]; ?>' > <!--Hidden User*Name-->
        <button type="submit">Submit</button>
    </form>
</div>
<style>
    canvas {
        border: 1px solid #ccc;
        display: block;
        margin: 10px 0;
    }
</style>
<script>
    function generateCaptcha() {
        const canvas = document.getElementById("captchaCanvas");
        const ctx = canvas.getContext("2d");
        const chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        const captchaLength = 6;
        let captcha = "";
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        for (let i = 0; i < 50; i++) {
            ctx.strokeStyle = `rgba(${Math.random() * 255}, ${Math.random() * 255}, ${Math.random() * 255}, 0.3)`;
            ctx.beginPath();
            ctx.moveTo(Math.random() * canvas.width, Math.random() * canvas.height);
            ctx.lineTo(Math.random() * canvas.width, Math.random() * canvas.height);
            ctx.stroke();
        }
        for (let i = 0; i < 20; i++) {
            ctx.fillStyle = `rgba(${Math.random() * 255}, ${Math.random() * 255}, ${Math.random() * 255}, 0.2)`;
            ctx.beginPath();
            ctx.arc(Math.random() * canvas.width, Math.random() * canvas.height, Math.random() * 10, 0, 2 * Math.PI);
            ctx.fill();
        }
        ctx.font = "30px Arial";
        ctx.textBaseline = "middle";
        for (let i = 0; i < captchaLength; i++) {
            const char = chars.charAt(Math.floor(Math.random() * chars.length));
            captcha += char;
            ctx.save();
            ctx.translate(30 + i * 30, canvas.height / 2);
            ctx.rotate((Math.random() - 0.5) * 0.5);
            ctx.fillStyle = `rgba(0, 0, 0, ${0.7 + Math.random() * 0.3})`;
            ctx.fillText(char, 0, 0);
            ctx.restore();
        }
        document.getElementById("captchaValue").value = captcha;
    }
    document.getElementById("check-status").addEventListener("submit", function (event) {
        const enteredCaptcha = document.getElementById("captchaInput").value.trim();
        const actualCaptcha = document.getElementById("captchaValue").value;

        if (enteredCaptcha !== actualCaptcha) {
            alert("Invalid CAPTCHA. Please try again.");
            document.getElementById("captchaInput").value="";
            event.preventDefault(); 
            generateCaptcha();
        } 
    });
    document.addEventListener("DOMContentLoaded", generateCaptcha);
</script>
<?php
include_once 'import/footer.php';
?>
