<?php
    include "db.php";
    if($_GET['blog_id']){
    	$blog_id=$_GET['blog_id'];
        $result=addLikesByBlogId($blog_id);
    }
    if($_GET['comment_id']){
    	$comment_id=$_GET['comment_id'];
        $result=addLikesByCommentId($comment_id);
    }  
    $result=$result." "."like";
    echo $result;
?>