<?php
		include ('..\REGISTER\server.php'); 
	//sistem vizualizari in zona de categorii
	function viewstot($val){
	$CD = mysqli_connect('localhost', 'root', '', 'projectv2','3307'); 
	$suma=0;
	$rezultat = mysqli_query($CD, "Select valoare from views,topics where ($val = views.ct_id) and (topics.category_id = views.ct_id) and (topics.topic_id = views.tp_id) and (topics.cond=1)");
	while($view = mysqli_fetch_assoc($rezultat)){$suma = $suma + $view['valoare'];}//aduna doar acele valori care fac parte din category_id-ul respectiv
		echo $suma;}
	//sfarsit sistem
?>
<?php 
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
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" rel="stylesheet" href="..\CSS\categories.css">
	<link href="..\CSS2\categories.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="cutie">
	<?php if (isset($_SESSION['username'])) : ?>
		<?php
			$username = strtolower($_SESSION['username']);
			$select = mysqli_query($db, "SELECT * FROM users where (username='$username')");
			$groupAdmin = mysqli_fetch_array($select);
			if ($groupAdmin['groupadmin']=='1') : ?>
				<a href="newcateg.php" class="link-to-portfolio" target="opener"></a>
				<div align="center" class = "text" ><h1 data-heading="<?= _WELCAD; ?>"><?= _WELCAD; ?></h1></div>
		<?php else : ?>
				<div align="center" class = "text" ><h1 data-heading="<?= _WELCUS; ?>"><?= _WELCUS; ?></h1></div><!-- imaginea cu Welcome Stranger(daca esti deconectat) -->
		<?php endif; 
		else : ?>
			<div align="center" class = "text" ><h1 data-heading="<?= _WELCST; ?>"><?= _WELCST; ?></h1></div><!-- imaginea cu Welcome Stranger(daca esti deconectat) -->
		<?php endif; ?>
		<!-- Buton Categorie Noua,pentru Administratori-->
		<!-- Sfarsit buton Categorie Noua -->
		<div class="mainbody">
			<table class="clasacategorie">
				<tr class="bordura">
				</tr>
				<?php 
				$selectare = mysqli_query($db, "SELECT * FROM categories ORDER BY dataa DESC"); //selectarea se face descrescator dupa data crearii categoriei,adica cele mai noi categorii apar primele
				while ($row = mysqli_fetch_assoc($selectare))  :?>
					<tr>
						<td class="categorie cat"><div align = "left" class = "aligned" ><img width="20" height="20" style = "position:relative;top:2px;right:3px;" src="..\IMG\dosar.png" >
							<a class = "titlu" style="font-size:28px;" href="pagecat.php?idcat=<?php echo $row['cat_id'];?>" target="opener" ><?php echo $row['category_title'];?></a></br></div> <!--titlul categoriei cu legatura la zona de subcategorie din categoria respectiva -->
							<p class="descriere" style="margin-top:4px;margin-left:3px;font-size:22px;"><?php echo $row['descriere'] ?> <!-- descrierea categoriei -->
						</td>
						<?php 
							$nrscat = mysqli_query($db, "SELECT subcat_id FROM subcategories WHERE (subcategories.parent_id=$row[cat_id])");
							$nrsucat = mysqli_num_rows($nrscat); // numarul de subcategorii din zona categoria respectiva
							$nrtop = mysqli_query($db, "SELECT topic_id FROM topics WHERE (topics.category_id=$row[cat_id]) and topics.cond=1");
							$nrtopics = mysqli_num_rows($nrtop); //numarul de topicuri din categoria respectiva
							$datanoua = $row['dataa'];
							$newDate = date("d-m-Y", strtotime($datanoua)); //data crearii categoriei respective pe format DD-MM-YYYY
						?>
						<td class="categorie cat mobile"><div align = "right" title="<?= _SUBCAT; ?>" data-placement="bottom" style= "font-size:17px;position:absolute;cursor:pointer;color:#007bff;right:8.2em;margin-top:-2.55em;"><img width="17" height="18" style = "position:relative;top:4px;right:2.5px;" src="..\IMG\subcat.png" ><b><?php echo $nrsucat; ?></b></div></td>
						<td class="categorie cat mobile"><div align = "right" title="<?= _TOPICS; ?>" data-placement="bottom" style= "font-size:17px;position:absolute;cursor:pointer;color:#007bff;right:5.3em;margin-top:-2.43em;"><img style = "position:relative;top:4px;right:3px;" width="18" height="16" src="..\IMG\topics.png" ><b><?php echo $nrtopics; ?></b></div></td>
						<td class="categorie cat mobile"><div align = "right" title="<?= _VIEWS; ?>" data-placement="bottom" style= "font-size:17px;position:absolute;cursor:pointer;color:#007bff;right:2em;margin-top:-2.58em;"><img style = "position:relative;top:3px;right:2.5px;" width="18" height="18" src="..\IMG\view.png" ><b><?php viewstot($row['cat_id']);?></b></div></td>
						<td class="categorie cat mobile"><div align = "right" style= "font-size:14px;position:absolute;color:#007bff;right:2.5em;margin-top:0.1em;cursor:default;"><?= _DATE; ?> <?php echo $newDate;?></div></td>
						<td class="util mobile"><div align = "right" style= "font-size:14px;position:absolute;color:#007bff;right:2.5em;margin-top:1.5em;cursor:default;"><?= _USR; ?> <a style = "text-decoration:none;color:rgb(134,107,176);"href="panel.php?idnume=<?php echo $row['numeuser']; ?>&amp;code=0"><b><?php echo ucfirst($row['numeuser']); ?></b></a></div></td>
					</tr>
				<?php endwhile ?>	
			</table>
		</div>
	</div>
</body>

</html>