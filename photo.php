<?php
include("head.php");
include("header.php");


$query = $pdo->prepare('SELECT * FROM photos WHERE id = ' . $_GET['id']);
$query->execute();
$photos = $query->fetch();
?>
<html>
   <body>
      <div class="content">
         <img class="photo" src="<?php echo $photos[src]?>">
      </div>
   </body>
</html>
<?php
include("footer.php");
?>