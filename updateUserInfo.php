<?php 
     include "db.php"; 
     $user_info['uid']=htmlspecialchars($_POST['uid']);
     $uid=htmlspecialchars()$_POST['uid'];
     $user_info['user_image_url']=htmlspecialchars($_POST['image']);
     $user_image_url=htmlspecialchars($_POST['image']);
     $nickname=htmlspecialchars($_POST['nickname']);
     $user_info['user_info_nickname']=$nickname;
     $email=htmlspecialchars($_POST['email']);
     $user_info['user_mail']=$email;
     $age=htmlspecialchars($_POST['age']);
     $user_info['user_age']=$age;
     $sex=htmlspecialchars($_POST['sex']);
     $user_info['user_sex']=$sex;
     $introduce=htmlspecialchars($_POST['introduce']);
     $user_info['user_introduce']=$introduce;
     if(updateUserInfo($uid,$nickname,$email,$age,$sex,$introduce)){
     	      session_start();
           session_unset('user_info');
           $_SESSION['user_info']=$user_info;
           echo "<script>  alert('修改成功!');window.location.href='my.php';  </script>";
     }else{
           echo "<script> alert('fail');  window.location.href='my.php';  </script>";
     }
    
?>