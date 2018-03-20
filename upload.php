<?php
echo $_FILES["file"]["size"] ;

$type=$_FILES["file"]["type"];

if ((($type== "image/gif")
|| ($type== "image/jpeg")
|| ($type == "image/png")
|| ($type == "image/pjpeg"))
&& ($_FILES["file"]["size"] < 20000))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
    $src="images/img".time().".jpg";
    move_uploaded_file($_FILES["file"]["tmp_name"],$src);

    $targ_w = $targ_h = 150;
    $jpeg_quality = 90;

    $img_r = imagecreatefromjpeg($src);
    $dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

    imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
    $targ_w,$targ_h,$_POST['w'],$_POST['h']);

    move_uploaded_file(imagejpeg($dst_r,null,$jpeg_quality),"images/150x150.jpg");

    }
  }
else
  {
  echo "格式不对或太大";
  }



?>