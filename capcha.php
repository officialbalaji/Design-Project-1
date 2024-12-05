<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complex CAPTCHA</title>
    <style>
        canvas {
            border: 1px solid #ccc;
            display: block;
            margin: 10px 0;
        }
        .captcha-container {
            text-align: center;
        }
        .captcha-hint {
            color: #888;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="captcha-container">
        <form onsubmit="validateCaptcha(event)">
            <h2>CAPTCHA Validation</h2>
            <canvas id="captchaCanvas" width="200" height="70"></canvas>
            <div class="captcha-hint">Enter the characters as shown above:</div>
            <input type="text" id="captchaInput" placeholder="Enter CAPTCHA" required>
            <input type="hidden" id="captchaValue">
            <button type="button" onclick="generateCaptcha()">Regenerate CAPTCHA</button>
            <br><br>
            <button type="submit">Submit</button>
        </form>
    </div>

    <script>
        // Generate a random CAPTCHA string (mix of upper and lowercase letters and numbers)
        function generateCaptcha() {
            const canvas = document.getElementById("captchaCanvas");
            const ctx = canvas.getContext("2d");
            const chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            const captchaLength = 6;
            let captcha = "";

            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            // Set CAPTCHA styles
            ctx.font = "30px Arial";
            ctx.textBaseline = "middle";

            // Add some noise (background)
            for (let i = 0; i < 50; i++) {
                ctx.fillStyle = `rgba(${Math.random() * 255}, ${Math.random() * 255}, ${Math.random() * 255}, 0.2)`;
                ctx.beginPath();
                ctx.arc(Math.random() * canvas.width, Math.random() * canvas.height, Math.random() * 10, 0, 2 * Math.PI);
                ctx.fill();
            }

            // Generate CAPTCHA text with slight rotations and variable opacity
            for (let i = 0; i < captchaLength; i++) {
                const char = chars.charAt(Math.floor(Math.random() * chars.length));
                captcha += char;

                ctx.save();
                ctx.translate(30 + i * 30, canvas.height / 2);
                ctx.rotate((Math.random() - 0.5) * 0.5); // Slight rotation
                ctx.fillStyle = `rgba(0, 0, 0, ${0.7 + Math.random() * 0.3})`; // Random opacity
                ctx.fillText(char, 0, 0);
                ctx.restore();
            }

            // Save the CAPTCHA value for validation
            document.getElementById("captchaValue").value = captcha;
        }

        // Validate the CAPTCHA
        function validateCaptcha(event) {
            const enteredCaptcha = document.getElementById("captchaInput").value.trim();
            const actualCaptcha = document.getElementById("captchaValue").value;

            if (enteredCaptcha !== actualCaptcha) {
                alert("Invalid CAPTCHA. Please try again.");
                event.preventDefault(); // Prevent form submission
                generateCaptcha(); // Regenerate CAPTCHA
            } else {
                alert("CAPTCHA validated successfully!");
            }
        }

        // Initialize the CAPTCHA on page load
        document.addEventListener("DOMContentLoaded", generateCaptcha);
    </script>
</body>
</html>
