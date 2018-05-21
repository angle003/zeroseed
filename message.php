<?php
    session_start();
    if(isset($_SESSION['user_info'])){
        $user=$_SESSION['user_info'];
    }else{
    	   $user=null;
    	   echo "<script> alert('请先登录!');  window.location.href='index.php';</script>";
    }
    echo "uid:".$_GET['uid'] ;
    

?>