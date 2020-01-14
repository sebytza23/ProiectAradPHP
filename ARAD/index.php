
<?php
include "Files/REGISTER/server.php";

// Set Language variable
if(isset($_GET['lang']) && !empty($_GET['lang'])){
 $_SESSION['lang'] = $_GET['lang'];

 if(isset($_SESSION['lang']) && $_SESSION['lang'] != $_GET['lang']){
  echo "<script type='text/javascript'> location.reload(); </script>";
 }
}

// Include Language file
if(isset($_SESSION['lang'])){
 include "Files/PHP/".$_SESSION['lang'].".php";
}else{
 include "Files/PHP/english.php";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta content='text/html; charset=UTF-8' http-equiv='Content-Type'/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sharing Opinion Forum</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="Files/CSS/style.css">
	<link rel="stylesheet" href="Files/CSS/index.css">
	<link rel="stylesheet" href="Files/CSS/login.css">
</head>
<body class="hero-anime">   
<?php include 'Files/PARTS/navbar.html'; ?>
 <script>
 function changeLang(){
  document.getElementById('form_lang').submit();
 }
 </script>
<?php include 'Files/PARTS/footer.html'; ?>    
</div>	  
<script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src = "https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" ></script>
<script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" ></script>
<script type="text/javascript" src = "Files/JS/script.js"></script>
</body>
</html>