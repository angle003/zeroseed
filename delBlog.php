<?php 
   include "db.php";
   session_start();
   if(isset($_SESSION['user_info'])){
          $user=$_SESSION['user_info'];
    }else{
          $user=null;
          echo "<script> alert('请先登录!');  window.location.href='index.php'</script>";
    } 
    $blog_id=htmlspecialchars($_GET['blog_id']);
    $uid=$user['uid'];
   if($blog_id){
         if(delBlogById($blog_id,$uid)){
         	 return 1;
         }else{
         	 return 500;
        }    
   }
?>