<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type = "text/css" href="..\CSS\login.css">
<?php

// Include Language file

 
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
?>
<div class="container2">

	<?php 
	$cod = $_GET['cod'] ;
	if($cod == 1) {$user = $_GET['user'];}elseif ($cod == 0) {$user = 0;}elseif ($cod == 2) {$user = $_GET['user']; }?>
  <form action="forgot.php?cod=0&user=<?php echo $user; ?>" method="post">
    <div class="row">
      <h2 style="text-align:center;color:black;opacity:0.8;font-family: 'Times New Roman', Times , sans;"><?=  _RECC; ?></h2>
      <div class="vl">
        <span class="vl-innertext"><?= _OR; ?></span>
      </div>
	
      <div class="col">
        <a href="register.php" class="fb btn" align="center" target="opener" style="text-align:center;color:white;font-family: 'Times New Roman', Times , sans;font-weight:bold;">
          <i class="fa" align="center"></i> <?= _SIGNUP; ?>
         </a><?php
		 if($cod == 2) : ?>
		 <?php 
			array_push($errors, _ERRPASS );
		 ?><?php endif; ?>
		 <?php include ('errors.php'); ?>
		 
      </div>

      <div class="col">
        <div class="hide-md-lg">
          <h1> <?= _ORLOGIN; ?></h1>
        </div>
		<?php 
		if($cod==0) : ?>
        <input type="text" name="username" placeholder="<?= _USERNAME; ?>" required>
        <input type="password" name="reccode" placeholder="<?= _RECOVER; ?>" required>
        <input type="submit" value="<?= _REC; ?>" name="rec_pass1">
      </div>
	  <?php elseif($cod == 1) : ?>
		<?php $user = $_GET['user'];?>
		
		<input type="password" name="pass1" placeholder="<?= _PASSNEW; ?>" required>
        <input type="password" name="pass2" placeholder="<?= _PASSWORD2; ?>" required>
        <input type="submit" value="<?= _REC; ?>" name="rec_pass2">
      </div>
      <?php
		 elseif($cod == 2) : ?>
		<input type="password" name="pass1" placeholder="<?= _PASSNEW; ?>" required>
        <input type="password" name="pass2" placeholder="<?= _PASSWORD2; ?>" required>
        <input type="submit" value="<?= _REC; ?>" name="rec_pass2">
      </div>
		 
	 <?php endif; ?>
    </div>
  </form>
</div>

<div class="bottom-container">
  <div class="row">
    <div class="col" align ="center" style="width:100%;">
      <a href="#" style="color:rgba(255,0,0,0.8);font-weight:bold;font-family:'Times New Roman', Times , sans; " class="btn" align ="center" ><b><?= _FORGOT; ?></b></a>
    </div>
  </div>
</div>
