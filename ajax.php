<?php
    include "db.php";
    if($_GET['blog_id']){
    	   $blog_id=$_GET['blog_id'];
        $result=addLikesByBlogId($blog_id);
        $result=$result."  like";
        echo $result;
    }
    if($_GET['comment_id']){
        $comment_id=$_GET['comment_id'];
        $result=addLikesByCommentId($comment_id);
        $result=$result."  like";
        echo $result;
    }  
    if($_POST['username']){
        include "db.php";
        $username=$_POST['username'];
        $result=searchUserByName($username);
        $json_arr = array("user"=>$result);
        $json_obj = json_encode($json_arr);
        echo $json_obj;
    }
?>