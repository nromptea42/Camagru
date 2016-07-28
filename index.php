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
			<img src="http://placekitten.com/g/320/261" id="photo" alt="photo">
			<script type="text/javascript">
				(function() {
console.log("ok");
  var streaming = false,
      video        = document.querySelector('#video'),
      cover        = document.querySelector('#cover'),
      canvas       = document.querySelector('#canvas'),
      photo        = document.querySelector('#photo'),
      startbutton  = document.querySelector('#startbutton'),
      width = 320,
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
        video.src = vendorURL.createObjectURL(stream);
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
    canvas.width = width;
    canvas.height = height;
    canvas.getContext('2d').drawImage(video, 0, 0, width, height);
    var data = canvas.toDataURL('image/png');
    photo.setAttribute('src', data);
  }

  startbutton.addEventListener('click', function(ev){
      takepicture();
    ev.preventDefault();
  }, false);

})();
			</script>
		<?php }
		include("footer.php");
		?>
	</body>
</html>