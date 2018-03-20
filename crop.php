<?php

/**
 * Jcrop image cropping plugin for jQuery
 * Example cropping script
 * @copyright 2008-2009 Kelly Hallman
 * More info: http://deepliquid.com/content/Jcrop_Implementation_Theory.html
 */


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

	$targ_w = $targ_h = 150;
	$jpeg_quality = 90;

	$src = 'images/img2.jpg';
	$img_r = imagecreatefromjpeg($src);
	$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

	imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
	$targ_w,$targ_h,$_POST['w'],$_POST['h']);

	header('Content-type: image/jpeg');
	imagejpeg($dst_r,null,$jpeg_quality);

	exit;
}

// If not a POST request, display page below:

?><!DOCTYPE html>
<html lang="en">
<head>
  <title>Live Cropping Demo</title>
  <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
  <script src="js/jquery.min.js"></script>
  <script src="js/jquery.Jcrop.min.js"></script>
  <link rel="stylesheet" href="css/Jcrop-main.css" type="text/css" />
  <link rel="stylesheet" href="css/Jcrop-demos.css" type="text/css" />
  <link rel="stylesheet" href="css/jquery.Jcrop.min.css" type="text/css" />

<script type="text/javascript">

   function getFileUrl(sourceId) {   
        var url;   
        if (navigator.userAgent.indexOf("MSIE")>=1) { // IE   
        url = document.getElementById(sourceId).value;   
    }   
        else if(navigator.userAgent.indexOf("Firefox")>0) { // Firefox   
        url = window.URL.createObjectURL(document.getElementById(sourceId).files.item(0));   
    }   
        else if(navigator.userAgent.indexOf("Chrome")>0) { // Chrome   
        url = window.URL.createObjectURL(document.getElementById(sourceId).files.item(0));   
    }   
        return url;   
    }  
   

  function  start(){
      // Create variables (in this scope) to hold the API and image size
            var jcrop_api,
                boundx,
                boundy,

                // Grab some information about the preview pane
                $preview = $('#preview-pane'),
                $pcnt = $('#preview-pane .preview-container'),
                $pimg = $('#preview-pane .preview-container img'),

                xsize = $pcnt.width(),
                ysize = $pcnt.height();

    $('#cropbox').Jcrop({
                onChange: updatePreview,
                onSelect: updateCoords,
                aspectRatio: xsize / ysize
            }, function() {
                // Use the API to get the real image size
                var bounds = this.getBounds();
                boundx = bounds[0];
                boundy = bounds[1];
                // Store the API in the jcrop_api variable
                jcrop_api = this;

                // Move the preview into the jcrop container for css positioning
                $preview.appendTo(jcrop_api.ui.holder);
    });
     function updatePreview(c) {
                if (parseInt(c.w) > 0) {
                    var rx = xsize / c.w;
                    var ry = ysize / c.h;

                    $pimg.css({
                        width: Math.round(rx * boundx) + 'px',
                        height: Math.round(ry * boundy) + 'px',
                        marginLeft: '-' + Math.round(rx * c.x) + 'px',
                        marginTop: '-' + Math.round(ry * c.y) + 'px'
                    });
                }
            };

function updateCoords(c)
  {
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
  };
  }

  

  function checkCoords()
  {
    if (parseInt($('#w').val())) return true;
    alert('Please select a crop region then press submit.');
    return false;
  };
 

 function preImg(sourceId, targetId) {   
      var url = getFileUrl(sourceId);   
      var span=document.getElementById("span");
      span.innerHTML="<img src='"+url+"'  id='cropbox' width='536px' height='536px' />";
      $("#pre").attr('src',url);
      start();
    }   

</script>
<style type="text/css">
  #target {
    background-color: #ccc;
    width: 500px;
    height: 330px;
    font-size: 24px;
    display: block;
  }
 .jcrop-holder #preview-pane {        
    display: block;        
    position: absolute;
    z-index: 2000;
    top: 10px;
    right: -280px;
    padding: 6px;
    border: 1px rgba(0, 0, 0, .4) solid;
    background-color: white;
    -webkit-border-radius: 6px;
    -moz-border-radius: 6px;
    border-radius: 6px;
    -webkit-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
    -moz-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
    box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);       
 }
        /* The Javascript code will set the aspect ratio of the crop
   area based on the size of the thumbnail preview,
   specified here */
 #preview-pane .preview-container {
    width: 150px;
    height: 150px;
    overflow: hidden;
 }

</style>

</head>
<body>

<div class="container">
<div class="row">
<div class="span12">
<div  class="jc-demo-box">
		<!-- This is the image we're attaching Jcrop to -->
    <!-- <input type="file" name="imgOne" id="imgOne1" onchange="preImg(this.id,'imgPre');" />    -->

<form action="upload.php" method="post" enctype="multipart/form-data" onsubmit="return checkCoords();">
          <label for="file">Filename:</label>
          <input type="file" name="file" id="imgOne1" onchange="preImg(this.id,'imgPre');" />
    <div id="span">
       
      </div>
		<!-- <img src="images/img2.jpg"  id="cropbox" /> -->
     <div id="preview-pane">
           <div class="preview-container">
                <img  id="pre"  src=""  class="jcrop-preview" alt="Preview" />
           </div>
     </div>

		<!-- This is the form that our event handler fills -->
		<!-- <form action="crop.php" method="post" onsubmit="return checkCoords();">
			  <input type="hidden" id="x" name="x" />
			  <input type="hidden" id="y" name="y" />
			  <input type="hidden" id="w" name="w" />
			  <input type="hidden" id="h" name="h" />
			  <input type="submit" value="Crop Image" class="btn btn-large btn-inverse" />
		</form> -->

          <br />
          <input type="hidden" id="x" name="x" />
          <input type="hidden" id="y" name="y" />
          <input type="hidden" id="w" name="w" />
          <input type="hidden" id="h" name="h" />
          <input type="submit" name="submit" value="Submit"  class="btn btn-large btn-inverse"/>
    </form>
   <!-- <p><input type="button" id="upJQuery" value="用jQuery上传"></p> -->
	</div>
	</div>
	</div>
	</div>
	</body>
<script type="text/javascript">
  $('#upJQuery').on('click', function() {
    var fd = new FormData();
    fd.append("upload", 1);
    fd.append("upfile", $("#imgOne1").get(0).files[0]);
    $.ajax({
      url: "upload.php",
      type: "POST",
      processData: false,
      contentType: false,
      data: fd,
      success: function(d) {
         alert(d);
      }
    });
  });
</script>
</html>
