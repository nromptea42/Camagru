<?php
  include("head.php");
  if ($_GET[id] && $_GET[id_log])
  {
    if ($_SESSION[id] == $_GET[id_log]) {
       $query = $pdo->prepare("DELETE FROM photos WHERE id = '".intval($_GET[id])."'");
       $query->execute();
       $query = $pdo->prepare("DELETE FROM `like` WHERE id_photo = '".intval($_GET[id])."'");
       $query->execute();
       $query = $pdo->prepare("DELETE FROM `comments` WHERE id_photo = '".intval($_GET[id])."'");
       $query->execute();
       $path = 'images/' . $_GET[id] . '.png';
       if (file_exists($path)) {
         unlink('images/' . $_GET[id] . '.png');
    }
    }
    header('location: /galery.php');
  }
  else
      header('location: /index.php');
?>