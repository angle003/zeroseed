 <?php 


//link db
function conn(){
   $con=mysql_connect("localhost","root","123");
   if(!$con){
       die("error!".mysql_error($con));
   }
   mysql_select_db("zeroseed",$con);
   return $con;
}
   
function getBlogById($id){ 
  $con=conn();
  $res=mysql_query("select * from blog where blog_id='".$id."'");
  mysql_close($con);
  return $res;  
}

function getBlogs(){
  $con=conn();
  $res=mysql_query("select * from blog");	
  mysql_close($con);
  return $res;
}

function getUserinfoById($id){
  $con=conn();
  $res=mysql_query("select * from user_info where user_id='".$id."'");
  $user_info=mysql_fetch_array($res);
  mysql_close($con);
  return $user_info;
}

function getCommentsByBlogId($id){
  $con=conn();
  $res=mysql_query("select count(*) from blog_comment where blog_id='".$id."'");
  $nums=mysql_fetch_row($res);
  mysql_close($con);
  return $nums[0];
}

function getCommentByBlogId($id){
  $con=conn();
  $res=mysql_query("select * from blog_comment where blog_id='".$id."'");
  mysql_close($con);
  return $res;
}

function  addLikesByBlogId($id){
  $con=conn();
  $res=mysql_query("select blog_likes from blog where blog_id ='".$id."'");
  $nums=mysql_fetch_row($res);
  $nums[0]=$nums[0]+1;
  $res=mysql_query("update blog set blog_likes='".$nums[0]."' where blog_id ='".$id."'");
  mysql_close($con);
  return $nums[0];
}
function  addLikesByCommentId($id){
  $con=conn();
  $res=mysql_query("select blog_comment_likes from blog_comment where blog_comment_id ='".$id."'");
  $nums=mysql_fetch_row($res);
  $nums[0]=$nums[0]+1;
  $res=mysql_query("update blog_comment set blog_comment_likes='".$nums[0]."' where blog_comment_id ='".$id."'");
  mysql_close($con);
  return $nums[0];
}
function getCommentComs($id){
  $con=conn();
  $res=mysql_query("select * from  blog_comment where blog_comment_reply='".$id."'");
  mysql_close($con);
  return $res;
}
function getCommentComsCount($id){
  $con=conn();
  $res=mysql_query("select count(*) from  blog_comment where blog_comment_reply='".$id."'");
  $nums=mysql_fetch_row($res);
  mysql_close($con);
  return $nums[0];
}
?>
   