<?php 
//vizualizarile care se regasesc in fiecare subcategorie 
function viewscat($p_id,$c_id){
	$parent_id = $_GET['idcat'];
	$CD = mysqli_connect('localhost', 'root', '', 'projectv2','3307');
	$suma=0;
	$rezultat = mysqli_query($CD, "Select valoare from views, topics where ($p_id = views.ct_id) and (views.sct_id = $c_id) and (views.tp_id = topics.topic_id) and topics.cond = 1");
	while($view = mysqli_fetch_assoc($rezultat)){
			$suma = $suma + $view['valoare'];
	}
	echo $suma;}
//sfarsit de vizualizari(sistem)
?>
<?php 
	include ('..\REGISTER\server.php');
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

<!Doctype HTML>
<html>
<head>
	<link rel="stylesheet" rel="stylesheet" href="..\CSS\categories.css">
	<link href="..\CSS2\categories.css" rel="stylesheet" type="text/css">
	<script src="..\JS\functii.js"></script>
	
	
</head>
<body>
<?php
	
	$parent_id = $_GET['idcat'];
	//selectarea se face in funtie de category_id,si se ordoneaza descrescator dupa data crearii!
	$selectare = mysqli_query($db, "SELECT cat_id, subcat_id, subcategory_title, subcategory_desc,numeuser,dataa2 FROM categories, subcategories WHERE ($parent_id = subcategories.parent_id) and ($parent_id = categories.cat_id) ORDER BY dataa2 DESC" ); ?> 
	<div align="center" class = "text" ><h1 data-heading="<?= _SBCT; ?>"><?= _SBCT; ?></h1></div>
	
	<!-- Buton Subcategorie Noua,pentru Admini-->
	
	<?php if (isset($_SESSION['username'])) : ?>
		<?php
			$username = strtolower($_SESSION['username']);
			$select = mysqli_query($db, "SELECT * FROM users where (username='$username')");
			$groupAdmin = mysqli_fetch_array($select);
			if ($groupAdmin['groupadmin']=='1') : ?>
				 <a href="newsubcat.php?idcat=<?php echo $parent_id; ?>" class="link-to-portfolio" target="opener"></a> 
			<?php endif;
		endif; ?>

	<!--Sfarsit Buton Subcategorie Noua -->
	
	<div class="mainbody">
		<table class="clasacategorie">
		
		<?php while ($row = mysqli_fetch_assoc($selectare))  :?>
			<tr>
				<?php //de aici aproape asemanator cu ce se intampla in main.php
					$nrtopics = mysqli_query($db, "SELECT topic_id FROM topics WHERE ($parent_id = topics.category_id) and ($row[subcat_id]=topics.subcategory_id) and topics.cond=1");
					$nrtop = mysqli_num_rows($nrtopics);
					$datanoua = $row['dataa2'];
					$newDate = date("d-m-Y", strtotime($datanoua));
				?>
				<td class="categorie cat"><div align = "left" class = "aligned" ><img width="20" height="20" style = "position:relative;top:3px;right:3px;" src="..\IMG\dosar2.png" >
							<a style= "padding-left:5px;font-size:28px;"class = "titlu" href="subcategories.php?idcat=<?php echo $row['cat_id'];?>&amp;idsubcat=<?php echo $row['subcat_id'];?>" target="opener"><?php echo $row['subcategory_title']; ?></a></br></div> <!--titlul categoriei cu legatura la zona de subcategorie din categoria respectiva -->
							<p class="descriere" style="margin-top:4px;margin-left:5px;font-size:22px;" ><?php echo $row['subcategory_desc'] ?> <!-- descrierea categoriei -->
				</td>
				<td class="categorie cat mobile"><div align = "right" title="<?= _TOPICS; ?> " data-placement="bottom" style= "font-size:16px;position:absolute;cursor:pointer;color:#007bff;right:5.8em;margin-top:-2.4em;"><img style = "position:relative;top:3.5px;right:5px;" width="18" height="16" src="..\IMG\topics.png" ><b><?php echo $nrtop; ?></b></div></td>
				<td class="util mobile"><div align = "right" title="<?= _VIEWS; ?> " data-placement="bottom" style= "font-size:16px;position:absolute;cursor:pointer;color:#007bff;right:2.5em;margin-top:-2.55em;"><img style = "position:relative;top:2px;right:3px;" width="18" height="18" src="..\IMG\view.png" ><b><?php viewscat($row['cat_id'],$row['subcat_id']); ?></b></div></td>
				<td class="util mobile"><div align = "right" style= "font-size:14px;position:absolute;color:#007bff;right:2.5em;margin-top:0.1em;cursor:default;"><?= _DATE; ?> <?php echo $newDate;?></div></td>
				<td class="util mobile"><div align = "right" style= "font-size:14px;position:absolute;color:#007bff;right:2.5em;margin-top:1.5em;cursor:default;"><?= _USR; ?> <a style = "text-decoration:none;color:rgb(134,107,176);"href="panel.php?idnume=<?php echo $row['numeuser']; ?>&amp;code=0"><b><?php echo ucfirst($row['numeuser']); ?></b></a></div></td>
					</tr>
		<?php endwhile ?>	
	</table>
	</div>
</body>
</html>
