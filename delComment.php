<?php 
   include "db.php";
     session_start();
    if(isset($_SESSION['user_info'])){
          $user=$_SESSION['user_info'];
     }else{
          $user=null;
          echo "<script> alert('请先登录!');  window.location.href='index.php'</script>";
     } 
   $comment_id=htmlspecialchars($_GET['comment_id']);
   $uid=$user['uid'];
   if($comment_id){
         if(delCommentById($comment_id,$uid)){
         	 return 1;
         }else{
         	 return 500;
         }    
   }
?>