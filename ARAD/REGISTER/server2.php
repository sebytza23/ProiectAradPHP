<?php
session_start();
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
 include "../PHP/english.php";}
// Initializare variabile
$username = "";	//ID
$email    = "";	//Email
$errors = array(); //Erori

// conectare catre Baza de Date
$db = mysqli_connect('localhost', 'root', '', 'projectv2','3307');
mysqli_set_charset( $db, 'utf8');
// Partea de Inregistrare
if (isset($_POST['reg_user'])) {	
  // primeste toate valorile din formularul de Inregistrare
  $username = mysqli_real_escape_string($db, strtolower($_POST['username']));//ID cu litere mici
  $email = mysqli_real_escape_string($db, strtolower($_POST['email']));//Email cu litere mici
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);//Parola
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);//Parola confirmata
  $code = mysqli_real_escape_string($db, strtolower($_POST['recovercode']));

  // Verificare Inregistrare: Totul sa fie completat cum trebuie
  // Array_push() adauga in $errors, erorile!
  if (strstr($username, " ")){ array_push($errors, _USERSP); }
  if ($password_1 != $password_2) {
	array_push($errors, _ERRPASS);
  }



  // Verificare Baza de date 
  // Pentru a nu exista un ID/Email cu acelasi Email/ID
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1"; //verifica daca exista un ID sau Email asemanator
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // Daca s-a gasit un ID asemanator
	  if($username != NULL){
		if ($user['username'] === $username) {
		  array_push($errors,  _EXIST);
		}
	  }
	  if($email != NULL){
		if ($user['email'] === $email) {
		  array_push($errors, _EXIST2 );
		}
		  }
  }

  // Finalizare inregistrare fara erori
  if (count($errors) == 0) {
  	$password = md5($password_1);//cryptare parola

  	$query = "INSERT INTO users (username, email, password, groupadmin, datacont, gen, reccode)
  			  VALUES('$username', '$email', '$password', '0', NOW(), 'NEUTRU', '$code')";//email si id transformate in litere mici
  	mysqli_query($db, $query);
  	$_SESSION['username'] = ucfirst($username);//prima litera e maree
  	?>
		<script>	window.top.location.reload(); </script>
		<?php 
  }
}

if (isset($_POST['rec_pass1']))
{
	$user = mysqli_real_escape_string($db,strtolower($_POST['username']));
	$recco = mysqli_real_escape_string($db,strtolower($_POST['reccode']));
	$user_check = "SELECT * FROM users WHERE username='$user' OR email='$user' LIMIT 1";
	$result = mysqli_query($db, $user_check);
	$user2 = mysqli_fetch_assoc($result);
	if($user2)
	{
		if($user != NULL){
			if($user2['email'] === $user)
				$user = $user2['username'];
			if (($user2['username'] === $user) AND ($recco === $user2['reccode'])) {
				header("Location:forgot.php?user=$user&cod=1");
			}
			else
			{
				array_push($errors, _RECCODEERR );
			}
		  }
	}
	else
	{
		array_push($errors, _NOUSER );
	}
}
if (isset($_POST['rec_pass2']))
{
	$user = $_GET['user'];
	$password_1 = mysqli_real_escape_string($db, $_POST['pass1']);
	$password_2 = mysqli_real_escape_string($db, $_POST['pass2']);
	$result = mysqli_query($db, "SELECT username,email FROM users WHERE username='$user' OR email='$user' LIMIT 1");
	$user2 = mysqli_fetch_assoc($result)['username'];
	if($password_1 == $password_2)
	{
		if($user === $user2)
		{	$password = md5($password_1);
			$sql = "UPDATE `users` SET `password`='$password' where '$user' = users.username";
			if(mysqli_query($db, $sql))
			{
				$_SESSION['username'] = ucfirst($user2);
				?>
				<script>	
					window.top.location.reload("../../index.php"); 
				</script>
			  <?php
		}
			else
				echo "Ceva a mers gresit!";
		}		
				
	}
	else 
	{
		array_push($errors, _ERRPASS );
		header("location: forgot.php?cod=2&user=".$user);
	}
}



// Partea de conectare
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, strtolower($_POST['username']));//primire ID sau Email in Litere Mici
  $email = mysqli_real_escape_string($db, strtolower($_POST['username']));// email-ul este trecut ca username pentru ca e primit prin acea valoare
  $password = mysqli_real_escape_string($db, strtolower($_POST['password']));

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query1 = "SELECT * FROM users WHERE (username='$username') OR (email='$email')"; //verifica daca id-ul/email-ul corespunde cu cel din BAZA de DATE
  	$query2="SELECT * FROM users WHERE password='$password'"; 	//verifica daca parola corespunde cu cea din BAZA de DATE
  	$query3="SELECT * FROM users WHERE (username='$username' AND password='$password') OR (email='$email' AND password='$password')"; //verifica daca id-ul/email-ul si parola corespund cu cele din BAZA de DATE
  	//zona de rezultate,daca corespund sau nu informatiile
	$results1 = mysqli_query($db, $query1);
  	$results2 = mysqli_query($db, $query2);
  	$results3 = mysqli_query($db, $query3);
	//prima data verificam rezultatul 3,deoarece acesta contine informatiile despre id/email si parola
  	if (mysqli_num_rows($results3) == 1) {
		
  	  $result4=mysqli_query($db,"SELECT username FROM users WHERE (username='$username') OR (email='$email')");//retine ID-ul din Baza de Date(asta cand vrei sa te conectezi cu email-ul)
  	  $_SESSION['username'] = ucfirst(mysqli_fetch_array($result4)['username']);//toate astea doar ca sa faci vizibil ID-ul la logare...nu email-ul...cred ca am ars 2 circuite la creier
	  if(isset($_POST['login_user']))
	  {		?>
		<script>	
			window.top.location.reload("../../index.php"); 
		</script>
	  <?php }
  	}else {//daca rezultatul a fost negativ(id/parola gresita) se trece la verificarea id-ului sau parolei
  	    if((mysqli_num_rows($results1) == mysqli_num_rows($results2) && mysqli_num_rows($results1) == 0) || mysqli_num_rows($results2) != 0)
  		   { array_push($errors, _USERWRONG);}//Ideea de la final cu "||" merge pe principiul,poate a gresit id-ul,dar nu ii pot spune ca parola e corecta,asta pentru cei care sparg conturi  
  		if(mysqli_num_rows($results1) == 1 && mysqli_num_rows($results2) == 0)
  		    array_push($errors, _PASSWRONG);//si acum,in cazul in care parola este gresita dar id-ul este bun,primeste in final eroarea asta!!!!!
  		        
  		    
  	    
  		
  	}
  }
}
// Set Language variable
?>
