
<?php
	$db = mysqli_connect('localhost','root','','projectv2','3307');
	
	$desc = $_POST['description'];//descriere
	
	$user = $_GET['nume'];//nume utilizator
	
	$selectare = mysqli_query($db,"Select * from users where '$user' = users.username");
	
	while ($row = mysqli_fetch_assoc($selectare))//doar schimba descrierea(initial NULL)
		{$sql= "UPDATE `users` SET `descpers`='$desc' where '$user' = users.username";}
	if(mysqli_query($db, $sql))
			header("location: panel.php?idnume=".$user);
		else
			echo "Ceva a mers gresit!";
?>