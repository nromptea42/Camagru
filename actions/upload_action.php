<?php
   
   include("../head.php");

   function save_picture($raw_picture, $pdo) {
     $query = $pdo->prepare("INSERT INTO `photos` (`src`, `id_log`)
				VALUES ('".$raw_picture."', '".$_SESSION[id]."')");
		$query->execute();
      echo 'ok';
   }
   
   function save_new_image() {
      
   }

   if (isset($_POST['raw_data']) && isset($_POST['selected_filter'])) {
      // $bite = serialize($_POST['raw_data']);
      save_picture($_POST['raw_data'], $pdo);
      //  $image_object = merge_images('../images/image.png', '../images/samples/'.$_POST['selected_filter'].'.png');
      //  save_new_image($image_object, $pdo);
   } else {
       echo 'lol, nope.';
   }

?>