<?php
	
// Include Language file
if(isset($_SESS['lang'])){
 include 'server.php';
}else{
 
 if(isset($_GET['lang']) && !empty($_GET['lang'])){
	$_SESSION['lang'] = $_GET['lang'];
	if(isset($_SESSION['lang']) && $_SESSION['lang'] != $_GET['lang']){
		echo "<script type='text/javascript'> location.reload(); </script>";
 }
}
// Include Language file
if(isset($_SESSION['lang'])){
 include "../PHP/".$_SESSION['lang'].".php";
}else{
include "server2.php";}

}

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type = "text/css" href="..\CSS\login.css">
<div class="container2">
  <form action="login.php" method="post">
    <div class="row">
      <h2 style="text-align:center;color:black;opacity:0.8;font-family: 'Times New Roman', Times , sans;"><?= _CONNECT2; ?></h2>
      <div class="vl">
        <span class="vl-innertext"><?= _OR; ?></span>
      </div>

      <div class="col">
        <a href="register.php" class="fb btn" align="center" target="opener" style="text-align:center;color:white;font-family: 'Times New Roman', Times , sans;font-weight:bold;">
          <i class="fa" align="center"></i> <?= _SIGNUP; ?>
         </a>
		 <?php include ('errors.php'); ?>
      </div>

      <div class="col">
        <div class="hide-md-lg">
          <h1> <?= _ORLOGIN; ?></h1>
        </div>

        <input type="text" name="username" placeholder="<?= _USERNAME;?>" required>
        <input type="password" name="password" placeholder="<?= _PASSWORD1;?>" required>
        <input type="submit" value="Login" name="login_user">
      </div>
      
    </div>
  </form>
</div>

<div class="bottom-container">
  <div class="row">
    <div class="col" align ="center" style="width:100%;">
      <a href="forgot.php?cod=0" style="color:rgba(255,0,0,0.8);font-weight:bold;font-family:'Times New Roman', Times , sans; " class="btn" align ="center" ><b><?= _FORGOT; ?></b></a>
    </div>
  </div>
</div>
