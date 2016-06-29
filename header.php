<?php
	include("function.php");
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
	<a style="color: #D8CAA8" href="index.php"><div style="margin-left: 3em; display: inline-block;">Home</div></a>
	<a style="color: #D8CAA8" href="http://www.google.com"><div style="margin-left: 5em; display: inline-block;">Profil</div></a>
	<a style="color: #D8CAA8" href="http://www.google.com"><div style="margin-left: 5em; display: inline-block;">Galery</div></a>
</div>
<?php //} ?>
