<?php
include("head.php");
include("header.php");
?>

<html>
	<body>
	<?php if (!$_SESSION[id]) { ?>
		<div class="index">
			<div style="font-size: 1.5em;">Please sign in :</div><br />
			<form action="login.php" method="post">
				Login : <input autofocus required type="text" name="login" value="">
				Password : <input required type="password" name="pwd" value="">
				<input type="submit" name="submit" value="Sign in">
			</form><br />
			<div><a style="color: #D8CAA8" href="forgot.php">Forgot password ? </a></div><br />
			<div><a style="color: #D8CAA8" href="create.php">Sign Up </a></div>
		</div>
		<?php }
		else { ?>
			<video id="video"></video>
			<div class="button">
			  <button id="startbutton">Prendre une photo</button>
			  <select name="filter" id="filter">
          <option value="none"></option>
          <option value="beer">Beer</option>
          <option value="mario">Mario</option>
          <option value="puzzle">Puzzle</option>
          <option value="scratches">Scratches</option>
        </select>
			  <canvas id="canvas"></canvas>
			  <img src="First-photo.png" class="first_photo" id="photo" alt="photo">
			  <br /> <br /> <br />
			  <form class="" action="insert.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
          <input name="fichier" type="file" value=""/>
          <input type="submit" name="submit" value="Publier">
          <input type="hidden" name="id_log" value="<?php echo $_SESSION[id] ?>">
        </form>
        <button id="publishbutton">Monter l'image publiée</button>
		  </div>
			<script type="text/javascript">
			
			var my_data = "my_data";
//<![CDATA[

(function() {

function getSelectedText(elementId) {
    var elt = document.getElementById(elementId);

    if (elt.selectedIndex == -1)
        return null;

    return elt.options[elt.selectedIndex].value;
}

  var streaming = false,
      video        = document.querySelector('#video'),
      cover        = document.querySelector('#cover'),
      canvas       = document.querySelector('#canvas'),
      photo        = document.querySelector('#photo'),
      startbutton  = document.querySelector('#startbutton'),
      publishbutton = document.querySelector('#publishbutton'),
      width = 300,
      height = 0;

  navigator.getMedia = ( navigator.getUserMedia || 
                         navigator.webkitGetUserMedia ||
                         navigator.mozGetUserMedia ||
                         navigator.msGetUserMedia);

  navigator.getMedia(
    { 
      video: true, 
      audio: false 
    },
    function(stream) {
      if (navigator.mozGetUserMedia) { 
        video.mozSrcObject = stream;
      } else {
        var vendorURL = window.URL || window.webkitURL;
        video.src = vendorURL ? vendorURL.createObjectURL(stream) : stream;
      }
      video.play();
    },
    function(err) {
      console.log("An error occured! " + err);
    }
  );

  video.addEventListener('canplay', function(ev){
    if (!streaming) {
      height = video.videoHeight / (video.videoWidth/width);
      video.setAttribute('width', width);
      video.setAttribute('height', height);
      canvas.setAttribute('width', width);
      canvas.setAttribute('height', height);
      streaming = true;
    }
  }, false);

  function takepicture() {
    var filter = getSelectedText("filter");
    if (filter == "none")
      return;
  	var context = canvas.getContext('2d');
    canvas.width = width;
    canvas.height = height;
   context.drawImage(video, 0, 0, width, height);
    var data = canvas.toDataURL('image/png');
    photo.setAttribute('src', data);
    my_data = data;
    
    /*******************/
    
    function getXMLHttpRequest() {
    	var xhr = null;
    	
    	if (window.XMLHttpRequest || window.ActiveXObject) {
    		if (window.ActiveXObject) {
    			try {
    				xhr = new ActiveXObject("Msxml2.XMLHTTP");
    			} catch(e) {
    				xhr = new ActiveXObject("Microsoft.XMLHTTP");
    			}
    		} else {
    			xhr = new XMLHttpRequest(); 
    		}
    	} else {
    		alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
    		return null;
    	}
    	
    	return xhr;
    }
    
    var xhr = getXMLHttpRequest();
    console.log(xhr);
    
    xhr.open("post", "actions/upload_action.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("raw_data=" + my_data + "&selected_filter=" + filter);
    
    function callback(res) {
      console.log(res);
      window.location = "index.php";
    }
    
    xhr.onreadystatechange = function() {
    	if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
    		// alert("OK"); // C'est bon \o/
    		callback(xhr.responseText);
    	}
    };
    
    /******************/
  }

  function mountpicture() {
    var filter = getSelectedText("filter");
    if (filter == "none")
      return;
    console.warn("Sucez un pote ca n'a rien d'homosexuel.");
    
    /*******************/
    
    function getXMLHttpRequest() {
    	var xhr = null;
    	
    	if (window.XMLHttpRequest || window.ActiveXObject) {
    		if (window.ActiveXObject) {
    			try {
    				xhr = new ActiveXObject("Msxml2.XMLHTTP");
    			} catch(e) {
    				xhr = new ActiveXObject("Microsoft.XMLHTTP");
    			}
    		} else {
    			xhr = new XMLHttpRequest(); 
    		}
    	} else {
    		alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
    		return null;
    	}
    	
    	return xhr;
    }
    
    var xhr = getXMLHttpRequest();
    console.log(xhr);
    
    xhr.open("post", "actions/mount_action.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("selected_filter=" + filter);
    
    function callback(res) {
      console.log(res);
      window.location = "index.php";
    }
    
    xhr.onreadystatechange = function() {
    	if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
    		// alert("OK"); // C'est bon \o/
    		callback(xhr.responseText);
    	}
    };
    
    /******************/
  }

  startbutton.addEventListener('click', function(ev){
      takepicture();
    ev.preventDefault();
  }, false);
  publishbutton.addEventListener('click', function(ev){
      mountpicture();
    ev.preventDefault();
  }, false);
})();

//]]>
		</script>
		<?php
		$query = $pdo->prepare('SELECT * FROM photos WHERE id_log='.$_SESSION[id].' ORDER BY id DESC LIMIT 3');
    $query->execute();
    $photos = $query->fetchAll();
    ?>
    <table class="photos_index">
         <?php
            foreach ($photos as $data)
            {
               $img_src = $data[src];
               $id = $data[id];?>
            <tr> <td> <a href="photo.php/?id=<?php echo $id ?>">
               <img  class="sidebar" src="<?php echo $img_src?>">
            </a> </td> </tr>
         <?php }
         ?>
    </table>
		<?php }
		include("footer.php");
		?>
	</body>
</html>