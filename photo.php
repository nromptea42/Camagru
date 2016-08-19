<?php
include("head.php");
include("header.php");

if (file_exists("images/" . $_GET['id'] . ".png")) {
$query = $pdo->prepare('SELECT * FROM photos WHERE id = ' . intval($_GET['id']));
$query->execute();
$photos = $query->fetch();
$query = $pdo->prepare("SELECT * FROM `like` WHERE id_photo='".intval($_GET[id])."'");
$query->execute();
$data = $query->fetchAll();
$int = '0';
foreach ($data as $likes)
{
   if ($likes[like] == '1')
      $int++;
   if ($likes[dislike] == '1')
      $int--;
}
$query = $pdo->prepare("SELECT * FROM `comments` WHERE id_photo='".intval($_GET[id])."' ORDER BY date DESC");
$query->execute();
$data2 = $query->fetchAll();
?>
<html>
   <body>
      <div class="content">
         <img class="presentation" src="<?php echo $photos[src]?>">
         <div class="things">
         <?php if ($_SESSION[id] == $photos[id_log]) { ?>
         <a href="/del_photo.php/?id=<?php echo $_GET['id'] ?>&id_log=<?php echo $photos[id_log]?>">
            <button class="del_photo" type="button">Supprimer la photo</button></a>
         <?php } ?>
         <a href="/like.php/?id=<?php echo $_GET['id']?>&id_log=<?php echo $_SESSION[id]?>">
            <button class="like" type="button">J'aime</button></a>
         <a href="/dislike.php/?id=<?php echo $_GET['id']?>&id_log=<?php echo $_SESSION[id]?>">
            <button class="dislike" type="button">J'aime pas</button></a>
         <br /><br /><div class="score"><?php echo "Score : ". $int ?></div>
         <br /><form action="/comment.php" method="post">
			   <input type="text" placeholder="Commentaire" name="comment" value="" required autofocus>
				<input type="submit" name="submit" value="Comment">
            <input type="hidden" name="id_photo" value="<?php echo $_GET[id] ?>">
         </form>
         <?php foreach ($data2 as $comments) {
                echo $comments[comment];
                ?> <br /> <?php
         } ?>
         </div>
      </div>
   </body>
</html>
<?php
include("footer.php"); }
  else
    header('location: /index.php');
?>