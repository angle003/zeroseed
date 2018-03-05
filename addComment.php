<?php
    include "db.php";
    session_start();
    if(isset($_SESSION['user_info'])){
          $user=$_SESSION['user_info'];
     }else{
          $user=null;
          echo "<script> alert('请先登录!');  window.location.href='index.php'</script>";
     } 
     $uid=$user['uid'];
     $comment=$_POST['comment'];
     $blog_id=$_POST['blog_id'];
     if($comment != "" ){
          if(addBlogComment($uid,$comment,$blog_id)){
              echo  1;
          }else{
              echo 2;
          }
     }else{
         echo  0;
     }

?>
