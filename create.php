<?php
	include("head.php");
	include("header.php");

	if ($_POST[submit] == "Inscription")
	{
		$error = [];
		if (!$_POST[name] || !$_POST[email] || !$_POST[passwd] || !$_POST[passwd2])
			array_push($error, "Tout les champs sont obligatoires");
		else if (checkUser($mysqli, $_POST[email]))
			array_push($error, "Email déjà utilisé");
		else
		{
			if ($_POST[passwd] != $_POST[passwd2])
				array_push($error, "Les mots ne passes ne sont pas identiques");
		}
		if (!$error)
		{
			if (preg_match("/[A-z0-9]+@student.42.fr/", $_POST[email]))
				$group = admin;
			else {
				$group = user;
			}
			if ($_POST[Avatar] == 'Abeille')
				$link = "http://s.tf1.fr/mmdia/i/56/7/maya-l-abeille-10724567bahrj_1713.jpg?v=1";
			else if ($_POST[Avatar] == 'Poney')
				$link = "http://www.poney-academy.com/data2/poney/cache/fast.a-1.b-0.c-2.d-1.e-1.c1-F4E3D7.c2-804040.png";
			else if ($_POST[Avatar] == 'Dragon')
				$link = "http://www.game-of-thrones.fr/wp-content/uploads/2014/04/dragon-adulte-gameofthrones.jpg";
			else if ($_POST[Avatar] == 'Taureau')
				$link = "http://femininisrael.com/wp-content/uploads/2015/05/signe-du-taureau.png";
			else
				$link = "https://forum.pcastuces.com/img/efa5cf51c0711fafc61e73f90e05bc12.png";
			$query = mysqli_query($mysqli, "INSERT INTO `users` (`name`, `email`, `passwd`, `group`, `img`)
				VALUES ('".$_POST[name]."','".$_POST[email]."', '".hash('whirlpool', $_POST[passwd])."','".$group."', '".$link."')");
			echo 'ok';
		}
	}
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