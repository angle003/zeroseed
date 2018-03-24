<?php
     include "db.php";
     $title=htmlspecialchars($_POST['title']);
     $content=htmlspecialchars($_POST['content']);
     $blog_id=htmlspecialchars($_POST['blog_id']);

     if($title != "" && $content != ""  &&  $title != " " && $content != " "){
          if(alertBlog($blog_id,$title,$content)){
              echo "<script> window.location.href='myblog.php'; </script>";
          }else{
              echo "<script> alert('添加失败');  window.location.href='blog.php';</script>";
          }
     }
         
     echo "<script> alert('标题或内容不能为空');  window.location.href='blog.php';</script>";
     

?>
