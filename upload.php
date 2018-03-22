<?php
 include "db.php";
 session_start();
 if(isset($_SESSION['user_info'])){
      $user=$_SESSION['user_info'];
 }else{
      $user=null;
      echo "<script> alert('请先登录!');  window.location.href='index.php'</script>";
 } 



function image_resize($src,$type ,$dst,$x ,$y ,$w, $h){

  $width = 150; 
  $height = 150;

 
  switch($type){
    case "bmp": $img = imagecreatefromwbmp($src); break;
    case "gif": $img = imagecreatefromgif($src); break;
    case "jpg": $img = imagecreatefromjpeg($src); break;
    case "png": $img = imagecreatefrompng($src); break;
    default : return  $type."Unsupported picture type!";
  }


  $new = imagecreatetruecolor($width, $height);

  // preserve transparency
  if($type == "gif" or $type == "png"){
    imagecolortransparent($new, imagecolorallocatealpha($new, 0, 0, 0, 127));
    imagealphablending($new, false);
    imagesavealpha($new, true);
  }
  
  imagecopyresampled($new, $img, 0, 0, $x, $y, $width, $height, $w, $h);

  switch($type){
    case "bmp":  imagewbmp($new, $dst); break;
    case "gif":  imagegif($new, $dst); break;
    case "jpg":  imagejpeg($new, $dst); break;
    case "png":  imagepng($new, $dst); break;
  }
  return true;
}

$type = strtolower(substr(strrchr($_FILES["file"]["type"],"/"),1));
if ((($type == "gif")
|| ($type == "jpeg")
|| ($type == "jpg")
|| ($type == "png")
|| ($type == "bmp"))
&& ($_FILES["file"]["size"] < 2000000))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
    if($type == "jpeg") $type = "jpg";
    $dst="images/img".$user['uid'];
    switch($type){
       case "bmp": $dst=$dst.".bmp";  break;
       case "gif": $dst=$dst.".gif";  break;
       case "jpg": $dst=$dst.".jpg";  break;
       case "png": $dst=$dst.".png";  break;
    }
    // echo "<script> alert('".$dst."');</script>";
    unlink(getOldImageUrl($user['uid']));
    image_resize($_FILES["file"]["tmp_name"],$type,$dst,$_POST['x'],$_POST['y'] ,$_POST['w'], $_POST['h']);
    updateImageById($user['uid'],$dst);
    $user['user_image_url']=$dst;
    $_SESSION['user_info']=$user;
    echo "<script> alert('修改完成!');  window.location.href='index.php'</script>";
    }
  }
else
  {
  echo "格式不对或太大";
  }

?>