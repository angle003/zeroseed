<?php 
    include "db.php";
    session_start();
    if(isset($_SESSION['user_info'])){
          $user=$_SESSION['user_info'];
     }else{
          $user=null;
          echo "<script> alert('请先登录!');  window.location.href='index.php'</script>";
     } 
   $blog_id=$_POST['blog_id'];
   $comment_id=$_POST['comment_id'];
   $commentComs=$_POST['commentComs'];
   $reUid=$_POST['reUid'];
   $uid=$user['uid'];
   if($commentComs != "" ){
        if(addCommentComs($uid,$comment_id,$commentComs,$reUid)){
        	  echo "<script>window.location.href='comment.php?blog_id=${blog_id}'</script>";
        }else{
        	  echo "<script> alert('评论失败!');  window.location.href='comment.php?blog_id=${blog_id}'</script>";
        }
   }else{
   	  echo "<script> alert('内容不能为空！');  window.location.href='comment.php?blog_id=${blog_id}'</script>";
   }
?>