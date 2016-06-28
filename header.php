<?php
	include("config/database.php");
?>
<head>
	<meta charset="UTF-8" />
	<title>Camagru</title>
	<link rel="stylesheet" type="text/css" href="layout.css">
</head>

<div class="header">
	<div class="title">Camagru</div><br />
	<?php //if ($_SESSION[id]) { ?>
	<div class="connect">
		Hello "TO CHANGE"
	</div>
		<a href="http://www.google.com"><img class="logout" name="logout" src="http://www.icone-png.com/png/22/22034.png"></a>
	 <?php //} ?>
</div>
<?php //if ($_SESSION[id]) { ?>
<div class="menu">
	<a style="color: #D8CAA8" href="http://www.google.com"><div style="margin-left: 3em; display: inline-block;">Home</div></a>
	<a style="color: #D8CAA8" href="http://www.google.com"><div style="margin-left: 5em; display: inline-block;">Profil</div></a>
	<a style="color: #D8CAA8" href="http://www.google.com"><div style="margin-left: 5em; display: inline-block;">Galery</div></a>
</div>
<?php //}
	//else { ?>
<!-- <div class="first_time">
	<div style="font-size: 1.5em;">Please sign in :</div><br />
	  <form action="" method="post">
      Id : <input type="text" name="id" value="">
      Pass : <input type="password" name="pwd" value="">
      <input type="submit" name="submit" value="Connexion">
    </form><br />
    <div>Forgot your password ? <a style="color: #D8CAA8" href="http://www.google.com">Click here !</a></div><br />
    <div>No account ? <a style="color: #D8CAA8" href="http://www.google.com">Create one !</a></div>
</div> -->
<?php //} ?>
