<form action = "insertbirth.php?nume=<?php echo $row['username'];?>&amp;code=2" method="post">
	<input type="date" name="nastere"  min="1950-01-01" max= "2012-01-01" required>
	<div align="right" style="margin-top:-23px;">
			<button type="submit" class="btn btn-primary" ><?= _UPDATE4; ?></button>
	</div>
</form>
