
<?php 
$parent_id = $_GET['idcat'];
include ("../REGISTER/server.php");
// Set Language variable
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
 include "../PHP/english.php";
}
?>

<body>
			<?php if (isset($_SESSION['username'])) : ?>
					<form action='addsubcat.php?idcateg=<?php echo $parent_id; ?>' method='POST'>
						  <div  align = "center"style = "padding-bottom:20px;">
							<textarea class="form-control" name="content" rows="8" style="resize: none;" maxlength="50" required placeholder="<?= _SUBTITLE; ?>" cols="20"></textarea>
						</div>
						<div style = "padding-bottom:20px;" align = "center">
							<textarea class="form-control" name="descriere" rows="50" style="resize: none;" required placeholder="<?= _SUBDESC; ?>" cols="20"></textarea>
						</div>
						<div align="center">
							<button type="submit" class="btn btn-primary"style = "padding:9px;"><?= _ADDSUBCAT; ?></button>
						</div>
						  </form>
			<?php endif ?>
		<link rel="stylesheet" type = "text/css" href="../CSS/description.css">
</body>
</html>