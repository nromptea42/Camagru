<?php
include("head.php");
include("header.php");
?>

<html>
	<body>
	<?php if (!$_SESSION[id]) { ?>
		<div class="first_time">
			<div style="font-size: 1.5em;">Please sign in :</div><br />
			<form action="login.php" method="post">
				Login : <input type="text" name="login" value="">
				Password : <input type="password" name="pwd" value="">
				<input type="submit" name="submit" value="Sign in">
			</form><br />
			<div><a style="color: #D8CAA8" href="http://www.google.com">Forgot password ? </a></div><br />
			<div><a style="color: #D8CAA8" href="create.php">Sign Up </a></div>
		</div>
		<?php }
		include("footer.php");
		?>
	</body>
</html>