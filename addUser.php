<?php
   include "db.php";
   $username=$_POST['username'];
   $password1=$_POST['password1'];
   $password2=$_POST['password2'];
   $email=$_POST['email'];
   $sex=$_POST['sex'];
   if($sex == 0 ){
        $sex="女";
   }else{
        $sex="男";
   }
   if($username != "" && $password1 != "" && $password1==$password2 && $email !="" ){
   	    if(addUser($username,$password1,$email,$sex)){
   	    	     echo "<script> alert('success') </script>";
   	    	     echo "<script> window.location.href='index.php' </script>";
   	    }else{
   	    	     echo "<script> alert('fail') </script>";
   	    	     echo "<script> window.location.href='register.php' </script>";
   	    }
   }else{
         echo "<script> window.location.href='register.php' </script>";	
   }
?>