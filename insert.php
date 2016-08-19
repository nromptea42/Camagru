<?php
  include('head.php');

  $ext = array('jpg','gif','png','jpeg');
  $uploads_dir = 'images/filter';
  if ($_POST[submit] == "Publier")
  {
    $error = [];
    if ($_FILES[fichier][size] > $_POST[MAX_FILE_SIZE])
      array_push($error, "fichier trop gros");
    if (!empty($_FILES[fichier][name]))
    {
      $link = "images/filter".$_FILES[fichier][name];
      if(in_array(strtolower(pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION)),$ext))
      {
        $my_ext = strtolower(pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION));
        $name = $_FILES[fichier][name];
        if(!move_uploaded_file($_FILES[fichier][tmp_name], "$uploads_dir/$name")) {
          array_push($error, "Erreur Upload Image");
        }
      }
    }
    else {
        array_push($error, "fichier vide");
    }
    if (!$error) {
      $photo = "images/filter/$name";
      $query = $pdo->prepare("INSERT INTO `docs` (`src`, `id_log`, `ext`)
        VALUES ('".$photo."', '$pdo->quote$_POST[id_log]', '".$my_ext."')");
        $query->execute();
    }
    header('location: /index.php');
  }
  header('location: /index.php');
?>