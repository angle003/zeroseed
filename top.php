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
                    <li  class="active"  ><a href="index.php">首页</a></li>
                    <?php  if($user){  $messages=getMessagesCount($user['uid']); ?>
                    <li><a href="myblog.php">我的博客</a></li>
                    <li><a href="blog.php">发博文</a></li>
                    <li><a href="my.php">个人中心</a></li>   
                    <li>
                          <a href="#" id="atou" >动态</a>
                          <span id="tou" >
                             <?php if($messages!=0){?>
                             <button id="m" type="button" class="btn btn-danger btn-circle" ><p><?php echo $messages;?></p></button>
                             <? } ?>
                             <span  class="animated fadeIn topnav_box"  onmouseover="<?php echo 'changeState('.$user['uid'].')';?>" >
                                   <?php  
                                         $result=getMessageByUidNew($user['uid']);
                                         while ($row_m=mysql_fetch_array($result)) {
                                                $cont=$row_m['user_message_content'];
                                                $url=$row_m['user_message_url'];
                                                $image_url=getImageByUid($row_m['messager_uid']);
                                                echo "<div class='information' >";
                                                echo "<img src='".$image_url."' >";
                                                echo "<a href='".$url."' >".$cont."</a></div>";
                                         }
                                         echo "<div class='information' ><a href='#' >---------历史动态--------</a></div>";
                                         $result=getMessageByUidOld($user['uid']);
                                         while ($row_m=mysql_fetch_array($result)) {
                                                $cont=$row_m['user_message_content'];
                                                $url=$row_m['user_message_url'];
                                                $image_url=getImageByUid($row_m['messager_uid']);
                                                echo "<div class='information' >";
                                                echo "<img src='".$image_url."' >";
                                                echo "<a href='".$url."' >".$cont."</a></div>";
                                         }
                                   ?>
                             </span> 
                          </span>
                     </li>
                    <?php  }  ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#" data-toggle="modal" data-target="#exModal">登录</a></li>
                            <?php  if($user){ ?><li><a href="loginout.php"  >注销</a></li><?php }else{ ?>
                            <li><a href="register.php">注册</a></li> <?php }?>
                            <li role="separator" class="divider"></li>
                            <li class="dropdown-header">其他</li>
                            <li><a href="#">...</a></li>
                        </ul>
                    </li>
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
  var state=0;
  function changeState(id){
         if(state==0){
              state=1;
              document.getElementById("m").style.display="none";
              updeteMessage(id);
         }

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
    