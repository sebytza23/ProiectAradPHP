<!-- this is the markup. you can change the details (your own name, your own avatar etc.) but don’t change the basic structure! -->
<link  rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Hind" />
<link  rel="stylesheet" type="text/css" href="../CSS/panel.css" />

<?php
		include ('..\REGISTER\server.php'); 
		include ('title.php');
		$user = strtolower($_GET['idnume']);
		$cod = $_GET['code'];
		$selectare = mysqli_query($db, "SELECT * FROM users WHERE '$user' = users.username");
		if (isset($_SESSION['username']))//pentru restul conditiilor in cazul in care userul conectat nu este acelasi cu cel din pagina
		{$user2 = strtolower($_SESSION['username']);}
		$msg = "";
		$nrtopic = mysqli_query($db, "SELECT topic_id FROM topics WHERE '$user' = topics.author");
		$nrtopics = mysqli_num_rows($nrtopic);//numar de topicuri date
		$nrreply = mysqli_query($db, "SELECT reply_id FROM replies WHERE '$user' = replies.author");
		$reply = mysqli_num_rows($nrreply);//numar de raspunsuri date
		if (isset($_POST['upload'])) {
			$file = $_FILES["image"]['tmp_name'];
			list($width, $height) = getimagesize($file);
			$selectare2 = mysqli_query($db,"Select * from images where '$user' = images.username");
			$select = mysqli_fetch_array($selectare2);
			$image = $_FILES['image']['name'];
			$target = "images/".basename($image);
			$rezultat = $width%$height;
			if(!$rezultat)
			{if($select)
			{	$sql = "UPDATE `images` SET `image`= '$image' where images.username= '$user'";
				mysqli_query($db, $sql);
			}
			elseif(!$rezultat)
			{
				$sql = "INSERT INTO images (image, username) VALUES ('$image', '$user')";
				mysqli_query($db, $sql);
			}}else {?> <Script language="Javascript">window.alert("<?= _RATIO; ?> ");</script> <?php
			}
		}
		$imagine = mysqli_query($db, "SELECT * FROM images where '$user' = images.username");
?>
<?php 
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
<aside class="profile-card">
	<?php 
	while ($row = mysqli_fetch_assoc($selectare))  :?>
	<header>
	<?php if(!$cod) { ?>
		<?php if ($rand2 = mysqli_fetch_assoc($imagine)){
			//inceput if cu sitemul de poza in cazul in care exista sau nu,poza se modifica in functie de gen
			echo "<a><img  width='120' height='120' src='images/".$rand2['image']."' ></a>"; ?>
		<?php }elseif($row['gen'] == 'NEUTRU') {
			 ?>
				<a><img  width='120' height='120' src='images/neutru.png' ></a>
			<?php }
			elseif($row['gen'] == 'MASCULIN'){?>
				<a><img  width='120' height='120' src='images/masculin.png' ></a>
			<?php }
			elseif($row['gen'] == 'FEMININ'){?>
				<a><img  width='120' height='120' src='images/feminin.png' ></a>
			<?php }
			
			$datanoua = $row['datacont'];
			$newDate = date("d-m-Y", strtotime($datanoua));
		?>
	<?php }	elseif($cod==2) {
		include("alert.php");
	 }elseif($cod == 4)
	 {include("alert2.php");}
	 elseif($cod == 7)
	 {include("alert5.php");}
	 elseif($cod == 5)
	 {include("alert3.php");}
	 elseif($cod == 6)
	 {include("alert4.php");}
	 ?>

		<!-- the username -->
		
		<h1><?php 
		if(!$cod){
		if($row['numreal']) { ?>
			 <?php echo $row['numreal'];?>
		<?php }	?></h1>
		<h1><?php echo ucfirst($row['username']); ?></h1>		
		<h2 style = "padding:0px;"><?php echo $row['email']; ?></h2>
		<h2 style = "padding:0px;font-weight:bold;margin-bottom:-14px;"><?php 
			if (isset($_SESSION['username']))
				if ($row['username'] == $user2)
				{
					$datanascut = $row['zinastere'];
					if (date("m-d") === date("m-d", strtotime($datanascut)))
					{
						echo _HAPPY.ucfirst($user2)."!"; 
					}
				} ?>
		</h2>
		<?php } ?>

	</header>

	<!-- bit of a bio; who are you? -->
	<div class="profile-bio">

		<?php 
			//sistem descriere personala
		if(!$cod) {
			if (isset($_SESSION['username']))
			{
				if ($row['username'] == $user2) //this part is to check if that is your profile page
				{
					 if($row['descpers'] == NULL and $user2 == $user)
					{ 
						 include("description.php"); //if you don't have any description, you will get an description form to complete.
					}
					else//if you have a description on your profile page, will display the content
					{ ?>
						</p><?php echo ucfirst($row['descpers']); ?> </p>
					<?php
					}
				}// That part is for other type of users who visit your profile
				elseif ($row['descpers'])
				{ ?>
					<p><?php echo ucfirst($row['descpers']);?></p>
				<?php }
				else
				{ ?>
					<p><?php echo _FILLED;?></p>
				<?php }
			}
			elseif($row['descpers'])  //main if, used for strangers that visit your profile
			{ ?>
				<p class = "scrisuri"><?php echo ucfirst($row['descpers']);?></p>
			<?php }
			else { ?>
				
				<p><?php echo _FILLED;?></p>
			
		<?php }	}
			//sfarsit sistem descriere personala
			?>
			<?php if (isset($_SESSION['username'])) :?>
				<?php if($row['username'] == strtolower($user2) AND !$cod) :?>
					<?php include ("button2.php"); ?>
				<?php endif; endif; ?>
			</div>
			<?php if (isset($_SESSION['username'])) :?>
			<?php if($row['username'] == strtolower($user2)) :?>
			<?php if($cod==1 OR $cod==2 OR $cod==4) {?>
			<form method="POST" action="panel.php?idnume=<?php echo $user2; ?>&amp;code=2" style="margin-top:-35px;" enctype="multipart/form-data">
					<input type="hidden" name="size" value="1000000">
					<input id="f02" style="width:0px;" placeholder = "ADD " type="file" name="image" required><!-- mutare adaugare poza si ascundere in zona unde se gaseste poza de profil --> 
					<label for="f02" class = "styles" required><?= _ADD; ?></label>
					<button type="submit" class="styles button" name="upload"><?= _UPLOAD; ?></button></div>
			</form>
			<?php 
				include("name.php");
				include("description2.php"); 
				include("gender.php");
				include("birthday.php");
				include("pass.php");
			?>
			<?php } elseif($cod==3 OR $cod == 5 OR $cod == 6 OR $cod == 7){
				include("password.php");}?>
		<?php endif;endif; ?>
	</div>
		<?php if(!$cod){ ?>
		<div align="center"><div align="center" style = "display:inline-block;" class = "colors title"><?php titlu($row['username'],$reply) ?></div></div>
		<?php }
		else { 
			include ("button.php");
		} endwhile;?>
</aside>
<script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<!-- that’s all folks! -->