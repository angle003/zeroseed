<!DOCTYPE html>
<html lang="en">
<head>
  <title>ZeroSeed Live Cropping</title>
  <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
  <script src="js/jquery.min.js"></script>
  <script src="js/jquery.Jcrop.min.js"></script>
  <link rel="stylesheet" href="css/jquery.Jcrop.min.css" type="text/css" />
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/main.css" rel="stylesheet">
  <link href="css/animate.css" rel="stylesheet">
  <link href="css/bootstrap-theme.min.css" rel="stylesheet">
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
      $("#cropbox").attr('src',url);
      $("#pre").attr('src',url);
      start();
    }   

</script>
<style type="text/css">
    .main{
         margin:  0 auto;
         width: 1000px;
         padding: 0px;
         position: relative;
         background-color: white;
         height: 800px;
         -webkit-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
         -moz-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
         box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
     }
     .jcrop-holder #preview-pane {
         display: block;
         position: absolute;
         z-index: 2000;
         top: 5px;
         left: 780px;
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
        
     #preview-pane .preview-container {
         width: 150px;
         height: 150px;
         overflow: hidden;
     }
  
     .img-container{
         position:  absolute;
         top: 100px;
         left: 20px;
         width: 950px;
         height: 536px;
         overflow: hidden;
         z-index: 2000;
         background-color: white;
         border-radius: 6px;
         -webkit-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
         -moz-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
         box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
     }

     #sub{
        position: absolute;;
        top: 730px;
        left: 20px;
     }

     .a-upload {
        margin-top: 60px;
        margin-left: 20px;
        position: relative;
        display: inline-block;
        background: #2b2b2b;
        border: 1px solid #2b3b2b;
        border-radius: 4px;
        padding: 4px 12px;
        overflow: hidden;
        color: white;
        text-decoration: none;
        text-indent: 0;
        line-height: 20px;
     }
     .a-upload input {
        position: absolute;
        font-size: 100px;
        right: 0;
        top: 0;
        opacity: 0;
     }
     .a-upload:hover {
        background: white;
        border-color: #2b2b2b;
        color: black;
        text-decoration: none;
     }
</style>

</head>
<body>
	  <?php  include "top.php"; ?>
<div class="main">
    <form action="upload.php" method="post" enctype="multipart/form-data" onsubmit="return checkCoords();">
          <a href="javascript:;" class="a-upload"><input  type="file" name="file"  id="imgOne1" onchange="preImg(this.id,'pre');" />选择图片</a> 
          <div class="img-container">
              <div id="span" >  
                    <img src=""  id='cropbox'  style="border:3px solid white;" />
              </div>
          </div>
          <div id="preview-pane">
               <div class="preview-container">
                  <img  id="pre"  src=""  class="jcrop-preview"   />
               </div>
          </div>
          <br />
          <input type="hidden" id="x" name="x" />
          <input type="hidden" id="y" name="y" />
          <input type="hidden" id="w" name="w" />
          <input type="hidden" id="h" name="h" />
          <input id="sub" type="submit" name="submit" value="Submit"  class="btn btn-large btn-inverse"/>
    </form>
	</div>
	</body>
</html>
