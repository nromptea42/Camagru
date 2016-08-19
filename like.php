<?php
  include("head.php");
  if ($_GET[id] && $_GET[id_log])
  {
    $ok = $_GET[id];
    $query = $pdo->prepare("SELECT * FROM `like` WHERE id_photo='".intval($ok)."'");
    $query->execute();
    $likes = $query->fetchAll();
    $err = [];
    foreach ($likes as $data)
    {
      if ($data[id_log] == $_GET[id_log])
      {
         if ($data[dislike] == 1) {
            $query = $pdo->prepare("UPDATE `like` SET `dislike` = '0' WHERE id_log='".intval($_GET[id_log])."'");
            $query->execute();
            $query = $pdo->prepare("UPDATE `like` SET `like` = '1' WHERE id_log='".intval($_GET[id_log])."'");
            $query->execute();
         }
         array_push($err, "nop");
      }
    }
    if (!$err)
    {
      $query = $pdo->prepare("INSERT INTO `like` (`id_photo`, `id_log`, `like`, `dislike`)
            VALUES ('".intval($_GET[id])."', '".intval($_GET[id_log])."', '1', '0')");
      $query->execute();
    }
    header('location: /photo.php/?id=' . $_GET[id]);
  }
  else
    header('location: /index.php');
?>