<?php
include("head.php");

if ($_POST[submit] == "Sign in")
{
	if ($_POST[login] && $_POST[pwd])
	{
		$query = $pdo->prepare("SELECT * FROM users WHERE login = '".$_POST[login]."'");
        $query->execute();
        $user = $query->fetchAll();
        if ($user[0][pwd] == hash('sha256', $_POST[pwd]))
        {
            $_SESSION[id] = $user[0][id];
            $_SESSION[login] = $user[0][login];
            $_SESSION[email] = $user[0][email];
        }
    }
}
?>
<script type="text/javascript">
    window.location = "index.php";
</script>