<?php
   include "db.php";
   $username=htmlspecialchars($_POST['username']);
   $password1=htmlspecialchars($_POST['password1']);
   $password2=htmlspecialchars($_POST['password2']);
   $email=htmlspecialchars($_POST['email']);
   $sex=htmlspecialchars($_POST['sex']);
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