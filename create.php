<?php
	include("head.php");
	include("header.php");
?>

<html>
	<body>
	<div class="inscription">
  <div style="text-align: center; font-size: 1.5em;">Sign up</div>
  <br />
	<form action="create.php" method="post">
		Login : <br /><input class="champs" type="text" name="name" value="" />
		<br /><br />Email : <br /><input class="champs" type="email" name="email" value="" />
		<br /><br />Password : <br /><input class="champs" type="password" name="passwd" value="" />
		<br /><br />Confirm the password : <br /><input class="champs" type="password" name="passwd2" value="" />
		<br /><br /><input type="submit" name="submit" value="Inscription" />
	</form>
</div>
	<?php
		include("footer.php");
	?>
	</body>
</html>