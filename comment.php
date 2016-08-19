<?php
include("head.php");

if ($_POST[submit] == "Comment")
{
   if ($_POST[comment])
   {
      $query = $pdo->prepare("INSERT INTO `comments` (`id_photo`, `comment`) 
         VALUES('".intval($_POST[id_photo])."','$pdo->quote$_POST[comment]')");
         $query->execute();
      $query = $pdo->prepare("SELECT `email` FROM `users`, `photos`, `comments` WHERE users.id = photos.id_log AND comments.id_photo = photos.id");
      $query->execute();
      $mail = $query->fetchAll();
      mail($mail[0][email], "Commentaire", "Quelqu'un a commenté votre photo !");
   }
   header('location: /photo.php/?id=' . $_POST[id_photo]);
}
else
   header('location: /index.php');
?>