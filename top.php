<?php
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
         
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li  class="active"  ><a href="index.php">Home</a></li>
                    <?php    if($user){  ?>
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
                </ul>
            </div>
            <!--/.nav-collapse -->
         
        </div>
    </nav>


</script>

      <!--弹窗 -->
    <div class="modal fade" id="exModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">login in</h4>
                </div>
                <form  action="login.php" method="post">
                <div class="modal-body">
                    
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">username:</label>
                            <input type="text" class="form-control" name="username" >
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">password:</label>
                            <input type="password" class="form-control" name="password" >
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">login</button>
                </div>
              </form>
            </div>
        </div>
    </div>
    <!--弹窗 -->
    