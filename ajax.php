<?php
    include "db.php";
    session_start();
    if(isset($_SESSION['user_info'])){
          $user=$_SESSION['user_info'];
     }else{
          $user=null;
     } 

     if($_POST['username']){
          $username=htmlspecialchars($_POST['username']);
          if (strlen($username) > 20) {
             echo 1;
             return;
          }
          $result=searchUserByName($username);
          echo $result;
          return;
      }
     if($_GET['message_uid']){
          $id=$_GET['message_uid'];
          updeteMessageById($id);
          echo $id;
          return;
      }

     if($user){
           if($_GET['blog_id']){
              $blog_id=$_GET['blog_id'];
              $result=addLikesByBlogId($blog_id,$user['uid']);
              $result=$result."  like";
              echo $result;
          }
          if($_GET['comment_id']){
              $comment_id=$_GET['comment_id'];
              $result=addLikesByCommentId($comment_id);
              $result=$result."  like";
              echo $result;
          }  
         
     }else{
         echo "404";
         return;
     }
    
     
    
?>