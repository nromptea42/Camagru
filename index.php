
<html>
	<body>
	<?php
		include("header.php");
	?>
	<?php 
		foreach ($pdo->query('SELECT * FROM users') as $user)
		{
			echo $user['login'];
		}
	?>
	<?php
		include("footer.php");
	?>
	</body>
</html>