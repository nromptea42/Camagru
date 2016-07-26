<?php
include("head.php");
include("header.php");

if ($_POST[submit] == "Recover")
{
		$error = [];
		if (!$_POST[login] || !$_POST[email])
			array_push($error, "Every field is needed");
		else if (checkLogin($pdo, $_POST[login]) == 0)
			array_push($error, "This login doesn't exist");
		else if (checkEmail($pdo, $_POST[email]) == 0)
			array_push($error, "This email doesn't exist");
		else
		{
			$query = $pdo->prepare("SELECT * FROM users WHERE login = '".$_POST[login]."'");
   			$query->execute();
 			$user = $query->fetchAll();
 			if ($user[0][email] != $_POST[email])
 				array_push($error, "The combination login/email is wrong");
		}
		if (!$error)
		{
			$rd = generateRandomString(6);
			$hashed = hash('sha256', $rd);
			$query = $pdo->prepare("UPDATE users SET pwd = '".$hashed."' WHERE login = '".$_POST[login]."'");
			$query->execute();
			mail($_POST[email], "Récupération de mot de passe", "Voici votre nouveau mot de passe " . $rd . ". Evitez de le perdre !");
		}
		else
			foreach ($error as $err)
				echo $err;
}
?>

<html>
	<body>
	<div class="first_time">
		<br /><br /><form action="" method="post">
			Login : <input type="text" name="login" value="">
			Email : <input type="text" name="email" value="">
			<input type="submit" name="submit" value="Recover">
		</form>
		Please enter your login and your email to recover your password
		</div>
	</body>
</html>