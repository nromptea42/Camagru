<?php
include("head.php");

if ($_POST[submit] == "Sign in")
{
	if ($_POST[id] && $_POST[pwd])
	{
		$query = $pdo->prepare("SELECT * FROM users WHERE login = '".$_POST[id]."'");
    	$query->execute();
    	$user = $query->fetchAll();
    	if ($user[0][pwd] == $_POST[pwd])//hash('sha256', $_POST[passwd]))
    	{
    		$_SESSION[id] = $user[0][id];
    		$_SESSION[login] = $user[0][login];
     	}
        else
        {
            ?>
            <script type="text/javascript">
                window.location = "index.php";
            </script>
            <?php
        }
	}
}
include("header.php");
?>