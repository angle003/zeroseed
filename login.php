<?php
include "db.php";
$username=$_POST['username'];
$password=$_POST['password'];
$result=login($username,$password);
if($row=mysql_fetch_array($result)){
      session_start();
      $user_info=getUserinfoById($row['user_id']);
      $user_info['uid']=$row['user_id'];
      $_SESSION['user_info']=$user_info;
      echo "<script> alert('login success!'); window.location.href='index.php' </script>";
}else{
      echo "<script> alert('login fail');  window.location.href='index.php'</script>";
}

?>
