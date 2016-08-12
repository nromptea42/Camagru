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
				Login : <input type="text" name="login" value="">
				Password : <input type="password" name="pwd" value="">
				<input type="submit" name="submit" value="Sign in">
			</form><br />
			<div><a style="color: #D8CAA8" href="forgot.php">Forgot password ? </a></div><br />
			<div><a style="color: #D8CAA8" href="create.php">Sign Up </a></div>
		</div>
		<?php }
		else { ?>
			<video id="video"></video>
			<button id="startbutton">Prendre une photo</button>
			<canvas id="canvas"></canvas>
			<img src="First-photo.png" class="first_photo" id="photo" alt="photo">
			<script type="text/javascript">
			
			var my_data = "my_data";
//<![CDATA[

(function() {

  var streaming = false,
      video        = document.querySelector('#video'),
      cover        = document.querySelector('#cover'),
      canvas       = document.querySelector('#canvas'),
      photo        = document.querySelector('#photo'),
      startbutton  = document.querySelector('#startbutton'),
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
    xhr.send("raw_data=" + my_data + "&selected_filter=prout");
    
    function callback(res) {
      console.log(res);
      console.warn('Sucer un pote, ça n\'a rien d\'homosexuel.')
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
  
})();

//]]>
		</script>
		<?php
		$query = $pdo->prepare('SELECT * FROM photos ORDER BY id DESC LIMIT 3');
    $query->execute();
    $photos = $query->fetchAll();
    ?>
    <div class="photos_index">
         <?php
            foreach ($photos as $data)
            { 
               $img_src = str_replace(' ', '+', $data[src]); ?>
            <img class="photo" src="<?php echo $img_src?>">
         <?php }
         ?>
    </div>
    
		<?php }
		include("footer.php");
		?>
	</body>
</html>