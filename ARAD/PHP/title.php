
<?php
function titlu($utiliz,$variabila)
{
	$db = mysqli_connect('localhost', 'root' , '' , 'projectv2','3307');
	$selector = mysqli_query($db,"Select groupadmin from users where '$utiliz'=users.username");
	$row = mysqli_fetch_assoc($selector);
	if ($row['groupadmin'])
		echo "Administrator";
	elseif($variabila <= 10)
		echo _BEGIN;
	elseif ($variabila > 10 and $variabila <= 50)
		echo "Normal";
	elseif ($variabila > 50 and $variabila <= 150)
		echo _ADVANCED;
	elseif ($variabila > 150 and $variabila <= 500)
		echo _ACTIVE;
	elseif ($variabila > 500 and $variabila <= 1000)
		echo _HELPER;
	else 
		echo _EXPERT;
}
?>