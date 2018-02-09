<?php
    include "db.php";
    $id=$_GET['id'];
    $result=addLikesByBlogId($id);
    $result=$result." "."like";
    echo $result;
?>