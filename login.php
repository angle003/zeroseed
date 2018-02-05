<?php
$con=mysql_connect("localhost","root","123");
if($con){
  mysql_select_db("zeroseed",$con);
} else{
  die("connect mysql fail!");
}
$username=$_POST['username'];
$password=$_POST['password'];
$result=mysql_query("select * from user where user_name=${username} and user_password=${password}");
if($row=mysql_fetch_array($result)){
   echo $row['user_name']."-------".$row['user_password'];
   echo "++++++++++++++";
   echo "login  success";
}else{
   echo "login fail";
}

