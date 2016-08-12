<body>
	<header>
		<div class="header">
			<a style="color: #D8CAA8" href="index.php"> <div class="title">Camagru</div><br /></a>
			<?php if ($_SESSION[id]) { ?>
			<div class="connect">
				Hello <?php echo $_SESSION[login] ?>
			</div>
				<a href="logout.php"><img class="logout" name="logout" src="imgsrc.png"></a>
			 <?php } ?>
		</div>
		<?php if ($_SESSION[id]) { ?>
		<div class="menu">
			<a style="color: #D8CAA8" href="index.php"><div style="margin-left: 3em; display: inline-block;">Home</div></a>
			<a style="color: #D8CAA8" href="profil.php"><div style="margin-left: 5em; display: inline-block;">Profil</div></a>
			<a style="color: #D8CAA8" href="galery.php"><div style="margin-left: 5em; display: inline-block;">Galery</div></a>
		<?php } ?>
		</div>
	</header>
</body>
