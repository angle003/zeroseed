<?
   include "db.php";
    session_start();
    if(isset($_SESSION['user_info'])){
          $user=$_SESSION['user_info'];
     }else{
          $user=null;
          echo "<script> alert('请先登录!');  window.location.href='index.php';</script>";
     } 
 $fid=htmlspecialchars($_POST['fid']);
 $uid=$user['uid'];
 if(addFollowById($uid,$fid)){
 	echo  1;
 	return;
 }else{
 	echo  0;
 	return;
 }
 
?>

