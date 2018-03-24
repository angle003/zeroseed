<?php
    include "db.php";
    session_start();
    if(isset($_SESSION['user_info'])){
          $user=$_SESSION['user_info'];
     }else{
          $user=null;
          echo "<script> alert('请先登录!');  window.location.href='index.php';</script>";
     } 
     $uid=htmlspecialchars($user['uid']);
     $title=htmlspecialchars($_POST['title']);
     $content=htmlspecialchars($_POST['content']);
     if($title != "" && $content != ""  &&  $title != " " && $content != " "){
          if(addBlog($uid,$title,$content)){
              echo "<script> window.location.href='myblog.php'; </script>";
          }else{
              echo "<script> alert('添加失败');  window.location.href='blog.php';</script>";
          }
     }
         
     echo "<script> alert('标题或内容不能为空');  window.location.href='blog.php';</script>";
     

?>
