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
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<div class="container2">

	<script>
				function submitUserForm() {
				var response = grecaptcha.getResponse();
				if(response.length == 0) {
					document.getElementById('wg').innerHTML = "";
						return false;
					}
					return true;
				}
			</script>
  <form action="register.php" onsubmit="return submitUserForm();" method="post" id="formular">
    <div id="warning" ><p id ="wg"></p></div>
    <div class="row">
      <h2 style="text-align:center;color:black;opacity:0.8;font-family: 'Times New Roman', Times , sans;"><?= _SIGNUP2; ?></h2>
	  <div style = "margin-left:2em;margin-right:2em;"><?php include('errors.php'); ?></div>
      <div class="vl"></div>
      <div class="col">
        <input type="text" name="username" maxlength="10" placeholder="<?= _USER; ?>" required>
        <input type="password" name="password_1" placeholder="<?= _PASSWORD1; ?>" required>
		<input type="password" name="password_2" placeholder="<?= _PASSWORD2; ?>" required>


      </div>
      <div class="col">
        <div class="hide-md-lg">
        </div>
		<input type="email" name="email" placeholder="<?= _EMAIL; ?>" required>
		<input type="password" name="recovercode" placeholder="<?= _RECOVER; ?>" required>
		<div class="g-recaptcha" data-sitekey="6LeftcIUAAAAAEc0cxCeWFGOnRoMgLvO66eh_oDg" data-callback="verifyCaptcha"></div>
      </div>
    </div>
  </form>
</div>

<div class="bottom-container">
  <div class="row">
    <div class="col" align ="center" style="width:100%;">
      <input type="submit" name="reg_user" value="<?= _SIGNUP; ?>" style="background-color:transparent;cursor:normal;border-radius:0px;color:rgba(255,0,0,0.8);outline:none;font-weight:bold;font-family:'Times New Roman', Times , sans; " form="formular" >
    </div>
  </div>
</div>
