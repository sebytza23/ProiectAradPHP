<?php
include ('..\REGISTER\server.php');
	
	$nascut = $_POST['nastere'];//data nasterii
	$cod = $_GET['code'];
	$user = $_GET['nume'];//numele utilizatorului
	
	$selectare = mysqli_query($db,"Select * from users where '$user' = users.username");
	
	while ($row = mysqli_fetch_assoc($selectare))
	{$sql= "UPDATE `users` SET `zinastere`='$nascut' where '$user' = users.username";}
	if(mysqli_query($db, $sql))
			header("location: panel.php?idnume=".$user."&code=".$cod);
		else
			echo "Ceva a mers gresit!";
?>