<?php
	include("head.php");
	include("header.php");
if ($_SESSION[id]) {
	if ($_POST[submit] == "Tu veux changer de mot de passe ?")
		$ok = 1;
	if ($_POST[submit] == "Change le !")
	{
		$ok = 1;
		$error = [];
		if (!$_POST[pwd] || !$_POST[newpwd] || !$_POST[newpwd2])
			array_push($error, "Tous les champs sont obligatoires");
		else if ($_POST[newpwd] != $_POST[newpwd2])
			array_push($error, "Les deux mots de passes ne sont pas identiques");
		else if (strlen($_POST[newpwd]) < 6)
				array_push($error, "Le mot de passe doit faire au moins 6 caractères et contenir un chiffre");
		else if (!(preg_match('/[A-Za-z]/', $_POST[newpwd]) && preg_match('/[0-9]/', $_POST[newpwd])))
				array_push($error, "Le mot de passe doit faire au moins 6 caractères et contenir un chiffre");
		if (!$error)
		{
			$query = $pdo->prepare("SELECT * FROM users WHERE login = '".$_SESSION[login]."'");
       		$query->execute();
     		$user = $query->fetchAll();
        	if ($user[0][pwd] == hash('sha256', $_POST[pwd]))
        	{
        		$hashed = hash('sha256', $_POST[newpwd]);
        		$query = $pdo->prepare("UPDATE users SET pwd = '$pdo->quote$hashed' WHERE login = '".$_SESSION[login]."'");
				$query->execute();
				$ok = 0;
        	}
        	else
        		array_push($error, "Le mot de passe est faux");
		}
	}
?>

<html>
	<body>
	<div class="profil">
	<br /><div>Ton login est : <?php echo $_SESSION[login]; ?></div><br />
	<div>Ton email est : <?php echo $_SESSION[email]; ?></div><br />
	<?php if ($ok != 1) { ?>
	<form action="profil.php" method="post">
		<input type="submit" name="submit" value="Tu veux changer de mot de passe ?" />
	</form>
	<?php } else {
		if ($error)
		{
			foreach ($error as $err)
				echo $err;
		} ?>
		<br /><br /><form action="profil.php" method="post">
			Password : <br /><input class="champs" type="password" name="pwd" value="" />
			<br />New password : <br /><input class="champs" type="password" name="newpwd" value="" />
			<br />Confirm the new password : <br /><input class="champs" type="password" name="newpwd2" value="" />
		<input type="submit" name="submit" value="Change le !" />
		</form>
	<?php } ?>
	</div>
	<?php
		include("footer.php");
	?>
	</body>
</html>

<?php } else
    header('location: /index.php');
?>