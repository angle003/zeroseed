<?php
     include "db.php";
     session_start();
      if(isset($_SESSION['user_info'])){
          $user=$_SESSION['user_info'];
     }else{
          $user=null;
     } 
?>
 <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                 <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                    <img style="margin-top:-20%;width: 40px;height: 40px;border-radius: 50%;" 
                    src="<?php  if($user){ echo $user['user_image_url']; }else{ echo 'https://static.hdslb.com/images/akari.jpg';} ?>" />
                </a>
                <a class="navbar-brand" href="#"  id="username">
                    <?php  if($user){ echo $user['user_info_nickname']; }else{  echo "游客"; } ?>         
                </a>
            </div>
         
            <div id="navbar" class="navbar-collapse collapse" >
                <ul class="nav navbar-nav"  style="position: relative;">
                    <li  class="active"  ><a href="index.php">Home</a></li>
                    <?php  if($user){  ?>
                    <li><a href="myblog.php">My Blog</a></li>
                    <li><a href="blog.php">Write Blog</a></li>
                    <li><a href="my.php">My</a></li>
                    <?php  }  ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">More <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#" data-toggle="modal" data-target="#exModal">login</a></li>
                            <li><a href="loginout.php"  >login out</a></li>
                            <li><a href="register.php">register</a></li>
                            <li role="separator" class="divider"></li>
                            <li class="dropdown-header">Nav header</li>
                            <li><a href="#">Separated link</a></li>
                            <li><a href="#">One more separated link</a></li>
                        </ul>
                    </li>
                    <?php if($user){   $messages=getMessagesCount($user['uid']);   ?>
                     <li>
                          <a href="#" id="atou" >动态</a>
                          <span id="tou" >
                             <button type="button" class="btn btn-danger btn-circle" ><?php echo $messages;?></button>
                             <span  class="animated fadeIn">
                                   <?php  
                                         $result=getMessageByUid($user['uid']);
                                         while ($row_m=mysql_fetch_array($result)) {
                                                $cont=$row_m['user_message_content'];
                                                $url=$row_m['user_message_url'];
                                                echo "<div class='information' ><a href='".$url."' onclick='changeState()' >".$cont."</a></div>";
                                         }
                                   ?>
                             </span> 
                          </span>
                     </li>
                    <?php  }  ?>
                </ul>
            </div>
            <!--/.nav-collapse -->
         
        </div>
    </nav>
    
<script type="text/javascript">
  var ds =document.getElementsByClassName("information");
  var oldColor;
      for(var i=0;i<ds.length;i++){
          if(i%2==0){
                 ds[i].style.backgroundColor='rgba('+0+','+0+','+ 0+','+0.1+')';
                 ds[i].onmouseover=function(){
                 oldColor=this.style.backgroundColor;
                 this.style.backgroundColor='rgba('+42+','+100+','+151+','+1+')';
                };
          }else{
                 ds[i].style.backgroundColor='rgba('+0+','+0+','+ 0+','+0.3+')';
                 ds[i].onmouseover=function(){
                 oldColor=this.style.backgroundColor;
                 this.style.backgroundColor='rgba('+42+','+100+','+151+','+1+')';};            
          }        
         ds[i].onmouseout=function(){
         this.style.backgroundColor=oldColor;
         };
      }
</script>

      <!--弹窗 -->
    <div class="modal fade" id="exModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">登录 zeroseed 博客</h4>
                </div>
                <form  action="login.php" method="post">
                <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">用户名:</label>
                            <input type="text" class="form-control" name="username" >
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">密码:</label>
                            <input type="password" class="form-control" name="password" >
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="submit" class="btn btn-primary">登录</button>
                </div>
              </form>
            </div>
        </div>
    </div>
    <!--弹窗 -->
    