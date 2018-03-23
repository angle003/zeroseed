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

function login($username,$password){
    $con=conn();
    $res=mysql_query("select * from user where user_name='".$username."' and user_password='".$password."' ");
    mysql_close($con);
    return $res;
}

function getBlogById($id){ 
  $con=conn();
  $res=mysql_query("select * from blog where blog_id='".$id."'");
  mysql_close($con);
  return $res;  
}

function getOldImageUrl($id){
  $con=conn();
  $res=mysql_query("select user_image_url from user_info where user_id ='".$id."'");
  $url=mysql_fetch_row($res);
  mysql_close($con);
  return  $url[0];
}

function searchUserByName($username){
  $con=conn();
  $res=mysql_query("select count(*) from user where user_name='".$username."'");
  $nums=mysql_fetch_row($res);
  mysql_close($con);
  return $nums[0];
}

function getBlogs(){
  $con=conn();
  $res=mysql_query("select * from blog order by  blog.blog_cretime desc");	
  mysql_close($con);
  return $res;
}

function getHotBlogs(){
  $con=conn();
  $res=mysql_query("select * from blog  order by  blog.blog_likes desc limit 0 , 10 ");
  mysql_close($con);
  return $res;
}

function getBlogsByUid($id){
  $con=conn();
  $res=mysql_query("select * from blog where  blog_user_id='".$id."' order by  blog.blog_cretime desc"); 
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
  $res=mysql_query("select * from blog_comment where blog_id='".$id."' ORDER BY  blog_comment.blog_comment_cretime DESC ");
  mysql_close($con);
  return $res;
}

function getMessageByUidOld($id){
  $con=conn();
  $res=mysql_query("select * from  user_message where user_message_uid='".$id."' and user_message_state=1 order by  user_message.user_message_cretime desc ");
  mysql_close($con);
  return $res;
}

function getMessageByUidNew($id){
  $con=conn();
  $res=mysql_query("select * from  user_message where user_message_uid='".$id."' and user_message_state=0 order by  user_message.user_message_cretime desc ");
  mysql_close($con);
  return $res;
}

function getMessagesCount($id){
  $con=conn();
  $res=mysql_query("select count(*) from  user_message where user_message_uid='".$id."' and user_message_state=0");
  $num=mysql_fetch_row($res);
  mysql_close($con);
  return $num[0];
}

function getImageByUid($id){
  $con=conn();
  $res=mysql_query("select user_image_url from user_info where user_id ='".$id."' ");
  $num=mysql_fetch_row($res);
  mysql_close($con);
  return $num[0];
}

function addLikesByBlogId($id,$m_uid){
  $con=conn();
  $res=mysql_query("select * from blog where blog_id ='".$id."'");
  $blog=mysql_fetch_array($res);
  $likes=$blog['blog_likes']+1;
  $uid=$blog['blog_user_id'];
  $content="赞了你的博客";
  $url="comment.php?blog_id=".$id;
  $res=mysql_query("update blog set blog_likes='".$likes."' where blog_id ='".$id."'");
  mysql_query("insert into user_message(user_message_uid,user_message_content,user_message_url,messager_uid) values('".$uid."','".$content."','".$url."','".$m_uid."')");
  mysql_close($con);
  return $likes;
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

function addUser($username,$password,$email,$sex){
  $con=conn();
  mysql_query("insert into user(user_name,user_password) values ('".$username."','".$password."')");
  $res=mysql_query("select user_id from user where user_name='".$username."'");
  $user=mysql_fetch_array($res);
  $user_id=$user['user_id'];
  $res=mysql_query("insert into user_info(user_id,user_mail,user_info_nickname,user_sex) values('".$user_id."','".$email."','".$username."','".$sex."')");
  mysql_close($con);
  return   true;
}

function  addBlog($uid,$title,$content){
  $con=conn();
  $res=mysql_query("insert into blog(blog_user_id,blog_title,blog_content) values('".$uid."','".$title."','".$content."')");
  mysql_close($con);
  if($res > 0){
       return true;
  }else{
       return false;
  }
}

function alertBlog($blog_id,$title,$content){
  $con=conn();
  $res=mysql_query("update blog set blog_title='".$title."',blog_content='".$content."' where blog_id='".$blog_id."' ");
  mysql_close($con);
  if($res > 0){
      return true;
  }else{
      return false;
  }

}

function addBlogComment($uid,$comment,$blog_id){
  $con=conn();
  $res=mysql_query("insert into blog_comment(bolg_comment_uid,blog_comment_content,blog_id) values('".$uid."','".$comment."','".$blog_id."')");
  $res2=mysql_query("select blog_user_id from blog where blog_id='".$blog_id."'");
  $id=mysql_fetch_row($res2);
  $content="评论了你的博客";
  $url="comment.php?blog_id=".$blog_id;
  mysql_query("insert into user_message(user_message_uid,user_message_content,user_message_url,messager_uid) values('".$id[0]."','".$content."','".$url."','".$uid."')");
  mysql_close($con);
  if($res > 0){
       return true;
  }else{
       return false;
  }
}

function addCommentComs($uid,$comment_id,$commentComs,$reUid){
  $con=conn();
  $res=mysql_query("insert into blog_comment(bolg_comment_uid,blog_comment_content,blog_comment_reply,blog_comment_reUid) values('".$uid."','".$commentComs."','".$comment_id."','".$reUid."')");
  $res2=mysql_query("select blog_id from blog_comment where blog_comment_id='".$comment_id."'");
  $blog_id=mysql_fetch_row($res2);
  $content="回复了你";
  $url="comment.php?blog_id=".$blog_id[0];
   mysql_query("insert into user_message(user_message_uid,user_message_content,user_message_url,messager_uid) values('".$reUid."','".$content."','".$url."','".$uid."')");
  mysql_close($con);
  if($res>0){
      return true;
  }else{
      return false;
  }
}

function updateUserInfo($uid,$nickname,$email,$age,$sex,$introduce){
  $con=conn();
  $res=mysql_query("update user_info set user_info_nickname='".$nickname."',user_sex='".$sex."',user_age='".$age."',user_mail='".$email."',user_introduce='".$introduce."' where user_id='".$uid."'");
  mysql_close($con);
  if($res>0){
      return true;
  }else{
      return false;
  }
}

function updeteMessageById($id){
  $con=conn();
  mysql_query("update user_message set user_message_state=1 where user_message_uid='".$id."'");
  mysql_close($con);
  return true;
}

function updateImageById($id,$dst){
  $con=conn();
  mysql_query("update user_info set user_image_url='".$dst."' where user_id='".$id."' ");
  mysql_close($con);
  return true;
}

function delBlogById($id){
  $con=conn();
  mysql_query("delete from blog where  blog_id ='".$id."' ");
  mysql_close($con);
  return true; 
}

?>