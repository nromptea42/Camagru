<?php
	include("head.php");
	include("header.php");

	if ($_POST[submit] == "Sign up")
	{
		$error = [];
		if (!$_POST[login] || !$_POST[email] || !$_POST[pwd] || !$_POST[pwd2])
			array_push($error, "Tout les champs sont obligatoires");
		else if (checkEmail($pdo, $_POST[email]))
			array_push($error, "Email déjà utilisé");
		else if (checkLogin($pdo, $_POST[login]))
			array_push($error, "Login déjà utilisé");
		else if ($_POST[pwd] != $_POST[pwd2])
				array_push($error, "Les mots ne passes ne sont pas identiques");
		else if (strlen($_POST[pwd]) < 6)
				array_push($error, "Le mot de passe doit faire au moins 6 caractères et contenir un chiffre");
		else if (!(preg_match('/[A-Za-z]/', $_POST[pwd]) && preg_match('/[0-9]/', $_POST[pwd])))
				array_push($error, "Le mot de passe doit faire au moins 6 caractères et contenir un chiffre");
		if (!$error)
		{
			$query = $pdo->prepare("INSERT INTO `users` (`login`, `pwd`, `email`)
				VALUES ('".$_POST[login]."', '".hash('sha256', $_POST[pwd])."', '".$_POST[email]."')");
			$query->execute();
			mail($_POST[email], "Inscription validée", "Inscription validée sur le super site nromptea");
		}
		else
			foreach ($error as $err)
				echo $err;
	}
?>

<html>
	<body>
	<div class="inscription">
  <div style="text-align: center; font-size: 1.5em;">Sign up</div>
  <br />
	<form action="create.php" method="post">
		Login : <br /><input class="champs" type="text" name="login" value="" />
		<br /><br />Email : <br /><input class="champs" type="email" name="email" value="" />
		<br /><br />Password : <br /><input class="champs" type="password" name="pwd" value="" />
		<br /><br />Confirm the password : <br /><input class="champs" type="password" name="pwd2" value="" />
		<br /><br /><input type="submit" name="submit" value="Sign up" />
	</form>
</div>
	<?php
		include("footer.php");
	?>
	</body>
</html>