<html>
	<body>
	<?php
		session_start();
		include("header.php");
		include("config/database.php");
	?>
	<?php if ($_SESSION[id]) { ?>
	<div class="first_time">
	<div style="font-size: 1.5em;">Please sign in :</div><br />
	  <form action="" method="post">
      Id : <input type="text" name="id" value="">
      Pass : <input type="password" name="pwd" value="">
      <input type="submit" name="submit" value="Connexion">
    </form><br />
    <div>Forgot your password ? <a style="color: #D8CAA8" href="http://www.google.com">Click here !</a></div><br />
    <div>No account ? <a style="color: #D8CAA8" href="create.php">Create one !</a></div>
	</div>
	<?php }
		include("footer.php");
	?>
	</body>
</html>