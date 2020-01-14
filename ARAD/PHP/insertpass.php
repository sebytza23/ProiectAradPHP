<html>
<head>
	
</head>
<?php
include ('..\REGISTER\server.php');
	
	$numele = $_GET['nume'];//numele utilizatorului
	
	$password_principala = $_POST['pprin'];
	
	$password_1 = $_POST['p1'];
	
	$password_2 = $_POST['p2'];
	
	$cod = $_GET['code'];
	
	$user_password_gasire = mysqli_query($db,"SELECT password FROM users WHERE username='$numele'");
	
	$user_password = mysqli_fetch_assoc($user_password_gasire)['password'];//parola din cont actuala
	
	if (md5($password_principala) == $user_password)//daca parola principala corespunde cu parola din baza de date
	{
		if($password_1 == $password_2)//daca ambele parole noi corespund
		{
			$parolanoua = md5($password_1);
			$sql= "UPDATE `users` SET `password`='$parolanoua' where '$numele' = users.username";
			if(mysqli_query($db, $sql)){
				$cod=7;
				header("location: panel.php?idnume=".$numele."&code=".$cod);}
				else
					echo "Ceva a mers gresit!";
		}
		else
		{
			$cod = 6;
			header("location: panel.php?idnume=".$numele."&code=".$cod);
		}
	}
	else 
	{	
		$cod = 5;
		header("location: panel.php?idnume=".$numele."&code=".$cod);
	}
	?>
</html>