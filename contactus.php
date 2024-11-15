
<?php
    include_once 'import/header.php';
?>

<div class="contact-container">
        <h1>Contact Us</h1>
        <div class="contact-info">
            <div class="contact-item">
                <i class="fas fa-map-marker-alt"></i>
                <p>123 Main Street</p>
                <p>City, Country</p>
            </div>
            <div class="contact-item">
                <i class="fa fa-phone"></i>
                <p>Phone: +123 456 789</p>
            </div>
            <div class="contact-item">
                <i class="fa fa-envelope"></i>
                <p>Email: info@example.com</p>
            </div>
        </div>
        <form class="contact-form">
            <input type="text" placeholder="Your Name" required>
            <input type="email" placeholder="Your Email" required>
            <textarea placeholder="Your Message" rows="4" required></textarea>
            <button type="submit">Send Message</button>
        </form>
</div>

<div class="faq-container">
    <h1>National Call Centre/IVRS</h1>

    <div class="faq-item">
        <p>For any information and suggestions on Passport services, please call at 1800-258-1800 (Toll Free) or write to us through accessing the "Feedback" Box</p>
    </div>

    <div class="faq-item">
        <h2>National Call Centre Timings:</h2>
        <p>1. Citizen Service Executive Support: 8 AM to 10 PM<br>
        2. Automated Interactive Voice Response (IVRS) Support: 24 hours</p>
    </div>

    <div class="faq-item">
        <p><b>Note:</b>  We are temporarily facing connectivity issue at toll free number 1800-258-1800 in Jammu & Kashmir and North East States. Citizens are requested to dial 040-66720567(paid) for J&K and 040-66720581(paid) for NE states. Inconvenience caused is regretted.</p>
    </div>
</div>
    <?php
    include_once 'login.php';
    ?>

<?php
    include_once 'import/footer.php';
?>