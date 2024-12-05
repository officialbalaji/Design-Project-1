<?php
    include_once 'import/header.php';
    if (isset($_SESSION["forms"])||($_SESSION["forms"])!=="") {
      $_SESSION["forms"]="";
    }
    if (isset($_SESSION["onetimepassword"])||($_SESSION["onetimepassword"])!=="") {
      $_SESSION['onetimepassword']="";
    }
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>

<?php
    include_once 'import/heading.php';
?>

    <!-- this section is hidden. only applied when user clicked sign up or login button -->
    <?php
    include_once 'login.php';
    ?>

<script>    
let slideIndex = 0;
showSlides();

function showSlides() {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  slides[slideIndex-1].style.display = "block";
  setTimeout(showSlides, 4000); // Change image every 2 seconds
}
</script>

</body>
</html> 


<?php
    include_once 'import/footer.php';
?>