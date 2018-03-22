<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
    <title>ZeroSeed</title>
    <meta name="keywords" content="ZEROSEED,ZERO'S WEB SITE ">
    <meta name="description" content="personal blog web site.">
    <meta name="author" content="zero">
    <link rel="icon" href="favicon.ico">
    <link href="css/main.css" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>
    <script src="js/ajax.js"></script>
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
     <style type="text/css">
          .btn-circle {  
            width: 25px;  
            height: 25px;  
            text-align: center;  
            padding: 4px 0;  
            font-size: 12px;  
            line-height: 1.428571429;  
            border-radius: 15px;  
         }  
         .my-image{
            margin-left: 40%; 
            margin-bottom: 50px; 
            width: 150px; 
            height: 150px;
            color: white;
            font-size: 30px;
            position: relative;
            border-radius: 50%;
         }
         .my-image:hover span{
            display: block;
         }
         
         .my-image img{
            height: 150px;
            width: 150px;
            border-radius: 50%;
         }
         .my-image span{
            position: absolute;
            top: 0px;
            left: 0px;
            width: 150px;
            height: 150px;
            background-color: rgba(0,0,0,0.4);
            display: none;
            border-radius: 50%;
            line-height: 140px;
            padding-left: 15px;
         }
         .my-image  a:hover {
            color: white;
         }

        @media screen and (max-width: 450px) {
            .my-image{
                margin-left:30%; 
            }
        }
      </style>
</head>

<body>
    <!-- Fixed navbar -->
    <?php  
         include "top.php";
         if(isset($_SESSION['user_info'])){
               $user=$_SESSION['user_info'];
         }else{
               $user=null;
         }  
         if($user){
               $nickname=$user['user_info_nickname'];
               $email=$user['user_mail'];
               $age=$user['user_age'];
               $sex=$user['user_sex'];
               $user_image=$user['user_image_url'];
               $introduce=$user['user_introduce'];
         }else{
         ?>
               alert("请先登录");
               window.location.href="index.php";
         <?php
         }
    ?>

    <div class="container theme-showcase" role="main">
        <!-- Main jumbotron for a primary marketing message or call to action -->
        <hr>
        <hr>
        <div class="blog-header">
            <h1 class="blog-title"><?php echo $nickname;?> </h1>
            <p class="lead blog-description">个人中心</p>
        </div>
        <div class="row">
            <div class="col-sm-8 blog-main">
               <div class="my-image"> 
                       <a href="crop.php"><span>修改头像</span></a>
                       <img  src="<?php echo $user_image;?>" >
               </div>
               <form  class="form-horizontal"   action="updateUserInfo.php" method="post" >
                        <input type="text" name="image"  value="<?php echo $user_image; ?>"  style="display: none;">
                        <input type="text" name="uid"  value="<?php echo $user['uid']; ?>"  style="display: none;">
                        <div class="form-group">
                            <label for="nickname" class="col-sm-2 control-label">昵称:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nickname" name="nickname" value="<?php echo $nickname; ?>" >     
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">邮箱:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>" >     
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="age" class="col-sm-2 control-label">年龄:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="age" name="age" value="<?php echo $age; ?>" >     
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="sex" class="col-sm-2 control-label">性别:</label>
                            <div class="col-sm-10">
                                <div class="btn-group" data-toggle="buttons">
                                       <label id="sex_man" class="btn btn-info">
                                       <input  type="radio" name="sex" value="1" ><img src="images/man.png" style="width: 14.5px;height: 15px;">
                                       </label>
                                       <label id="sex_women" class="btn btn-info">
                                       <input  type="radio" name="sex" value="0"><img src="images/women.png" style="width: 10px;height: 15px;margin-left:2px;margin-right: 3px;">
                                       </label>
                                </div>    
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="introduce" class="col-sm-2 control-label">个人介绍:</label>
                            <div class="col-sm-10">
                                <textarea rows="10" type="text" class="form-control" id="introduce" name="introduce" ><?php echo $introduce; ?></textarea>    
                            </div>
                        </div>
                         <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button   class="btn btn-info" >修改</button>                        
                            </div>
                        </div>
             </form> 
            </div>
            <!-- /.blog-main -->

          <?php include "right.html"; ?>

        </div>
        <!-- row -->
    </div>
    <!-- container  -->

    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
    <script type="text/javascript">
        if('<?php echo $sex; ?>' == 1){
            $("#sex_man").addClass("active");
        }else{
            $("#sex_women").addClass("active");
        }
    </script>
</body>

</html>
