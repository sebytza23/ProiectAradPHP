<?php  if (count($errors) > 0) : ?>
  <div class="error">
  	<?php foreach ($errors as $error) : ?>
  	  <div class="alert">
	<span class="closebtn">&times;</span>
	 <p class='alert'> <?php echo $error ?></p></div>
  	<?php endforeach ?>
  </div>
<?php  endif ?>
<script>
			var close = document.getElementsByClassName("closebtn");
			var i;

			for (i = 0; i < close.length; i++) {
			  close[i].onclick = function(){
				var div = this.parentElement;
				var element = document.getElementById("element-id")
				div.style.opacity = "0";
				setTimeout(function(){ div.style.display = "none"; }, 600);
			  }
			}
			</script>