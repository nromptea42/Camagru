<?php

   include("../head.php");
   $query = $pdo->prepare("SELECT * FROM `docs` ORDER BY id DESC LIMIT 1");
   $query->execute();
   $docs = $query->fetchAll();
   pr($docs);

function merge_images($first_picture_name, $second_picture_name, $ext) {
    // Load the stamp and the photo to apply the watermark to
    if ($ext == "jpg" || $ext == "jpeg") {
      if (($first_picture = imagecreatefromjpeg("$first_picture_name")) == FALSE) {
       echo 'Error while opening first picture';
      }
    }
    else if ($ext == "png") {
       if (($first_picture = imagecreatefrompng("$first_picture_name")) == FALSE) {
         echo 'Error while opening first picture';
       }
    }
    else if ($ext == "gif") {
       if (($first_picture = imagecreatefromgif("$first_picture_name")) == FALSE) {
         echo 'Error while opening first picture';
       }
    }
    if (($second_picture = imagecreatefrompng("$second_picture_name")) == FALSE) {
       echo 'Error while opening second picture';
    }
    
   //  Get the height/width of the logo image
    $first_picture_x = imagesx($second_picture); 
    $first_picture_y = imagesy($second_picture);
    
    if (imagecopy($first_picture, $second_picture, 0, 0, 0, 0, $first_picture_x, $first_picture_y) != TRUE) {
       echo 'Error while merging images';
    }
    return $first_picture;
}

function get_file_name($pdo) {
   $query = $pdo->prepare("INSERT INTO `photos` (`src`, `id_log`) VALUES ('wesh', '1')");
   $query->execute();
    $statement = $pdo->prepare("SELECT MAX(id) FROM photos");
    $statement->execute();
    $row = $statement->fetch();
    echo $row[0] + 1; // Do not delete this, it's used for redirection.
    return $row[0];
}

function save_to_db($path, $pdo)
{
    $query = $pdo->prepare("UPDATE `photos` SET `src` = '".$path."', `id_log` = '".$_SESSION[id]."' WHERE `src`='wesh'");
		$query->execute();
}

function save_new_image($image_object, $pdo) {
    
    $filename = get_file_name($pdo);

    if (imagesavealpha($image_object, TRUE) != TRUE) {
       echo 'Error while saving Alpha channel.';
    }
    if (imagepng($image_object, '../images/'.$filename.'.png') != TRUE) {
       echo 'Error while saving new image.';
    }
    $path = '../images/'.$filename.'.png';
    save_to_db($path, $pdo);
}
   if (isset($_POST['selected_filter'])) {
      $path = '../images/filter/'.$_POST['selected_filter'].'.png';
      if ($docs[0][src]) {
         $new_image = merge_images("../" . $docs[0][src], $path, $docs[0][ext]);
         save_new_image($new_image, $pdo);
      }
      else {
      header('location: /index.php');
      }
   }
   else {
      header('location: /index.php');
   }

?>