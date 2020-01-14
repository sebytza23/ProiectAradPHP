<?php
include ('..\REGISTER\server.php');
	
	$numele = $_POST['numrl'];//numele real
	
	$user = $_GET['nume'];//numele utilizatorului
	$cod = $_GET['code'];
	$selectare = mysqli_query($db,"Select * from users where '$user' = users.username");
	
	if (strpos($numele, " ")){ //Nu ai dreptul sa pui un utilizator fara spatiu,pe langa asta,nu ai voie sa pui spatiu la inceput
		while ($row = mysqli_fetch_assoc($selectare))
		{$sql= "UPDATE `users` SET `numreal`='$numele' where '$user' = users.username";}
		if(mysqli_query($db, $sql))
				header("location: panel.php?idnume=".$user."&code=".$cod);
			else
				echo "Ceva a mers gresit!";
	}
	else
	{
		$cod = 4;
		 header("location: panel.php?idnume=".$user."&code=".$cod);
	}
?>