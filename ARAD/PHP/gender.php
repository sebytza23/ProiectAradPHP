<form action = "insertgen.php?nume=<?php echo $row['username'];?>&amp;code=2" method="post" >
	<select name="genul" required>
		<option value="">-- <?= _SELECT; ?> --</option>
		<option value="MASCULIN"><?= _MALE; ?></option>
		<option value="NEUTRU"><?= _NEUTRAL; ?></option>
		<option value="FEMININ"><?= _FEMALE; ?></option>
	</select>
	<div align="right" style="margin-top:-20px;">
			<button type="submit" class="btn btn-primary" ><?= _UPDATE3; ?></button>
	</div>
</form>