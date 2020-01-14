<?php
include ('..\REGISTER\server.php');
	
	$genpers = $_POST['genul'];//genul ales
	
	$user = $_GET['nume'];//numele utilizatorului
	$cod = $_GET['code'];

	$selectare = mysqli_query($db,"Select * from users where '$user' = users.username");
	
	while ($row = mysqli_fetch_assoc($selectare))
	{$sql= "UPDATE `users` SET `gen`='$genpers' where '$user' = users.username";}
	if(mysqli_query($db, $sql))
			header("location: panel.php?idnume=".$user."&code=".$cod);
		else
			echo "Ceva a mers gresit!";
?>