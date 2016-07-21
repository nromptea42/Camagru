<?php
include("header.php");
if ($_POST[submit] == "Sign in")
{
	if ($_POST[id] && $_POST[pwd])
	{
		$query = $pdo->prepare("SELECT * FROM users WHERE login = '".$_POST[id]."'");
    	$query->execute();
    	$user = $query->fetchAll();
    	if ($user[0][pwd] == "wesh")//hash('sha256', $_POST[passwd]))
    	{
    		$_SESSION[id] = $user[0][id];
    		$_SESSION[login] = $user[0][login];
     	}
	}
}
?>

<html>
<body>
	<?php if (!$_SESSION[id]) { ?>
		<div class="first_time">
			<div style="font-size: 1.5em;">Please sign in :</div><br />
			<form action="" method="post">
				Id : <input type="text" name="id" value="">
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