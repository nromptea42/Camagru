<?php
include("head.php");
include("header.php");
$query = $pdo->prepare('SELECT * FROM photos ORDER BY id DESC');
$query->execute();
$photos = $query->fetchAll();
?>
<html>
   <body>
      <div class="content">
         <?php
            foreach ($photos as $data)
            {
               $img_src = $data[src];
               $id = $data[id];?>
            <a href="photo.php/?id=<?php echo $id ?>">
               <img class="photo" src="<?php echo $img_src?>">
            </a>
         <?php }
         ?>
      </div>
   </body>
</html>
<?php
include("footer.php");
?>