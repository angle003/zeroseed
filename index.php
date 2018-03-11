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
    <link href="css/animate.css" rel="stylesheet">
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
      </style>
</head>

<body>
    <!-- Fixed navbar -->
    <?php  include "top.php"; ?>

    <div class="container theme-showcase" role="main">

        <!-- Main jumbotron for a primary marketing message or call to action -->
        
        <hr>
        <hr>

        <div class="blog-header">
            <h1 class="blog-title">最新动态</h1>
            <p class="lead blog-description">展示最近的博文</p>
           
        </div>

        <div class="row">

            <div class="col-sm-8 blog-main">
<?php
    $result=getBlogs();
    while ($row=mysql_fetch_array($result)) {
       $user_id=$row['blog_user_id'];
       $blog_id=$row['blog_id'];
       $user_info=getUserinfoById($user_id);
       $comnum=getCommentsByBlogId($blog_id);
       $content=$row['blog_content'];
       if(strlen($content) >= 460){
            $content = substr($content,0,460)."..."; 
       }
?>
   <div class="blog-post">
                    <p class="blog-post-title" style=" position: relative;">
                    <?php echo "<img src='".$user_info['user_image_url']."' />"; ?>      
                        <a href="#" style="font-size: 2em;"><?php  echo $user_info['user_info_nickname']; ?></a><br>
                        <span class="blog-post-meta " style="position: absolute;top:30px;left:45px;"><?php echo $row['blog_cretime']; ?> </span>
                    </p>
                    <p><?php echo $content; ?></p>
                    <ul class="glyphicons-list">
                        <li>
                            <a href="javascript:volid(0);" onclick="<?php echo "showResult1(".$blog_id.")"; ?>"> <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
                                <span id="<?php echo "blog_likes_".$blog_id; ?>" class="glyphicon-class"><?php echo $row['blog_likes']; ?> like</span>
                            </a>
                        </li>
                        <li>     
                            <?php $url="comment.php?blog_id=".$blog_id."&random=".rand();?>                  
                            <a href="<?php echo $url; ?>" > <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                                <span class="glyphicon-class"><?php echo $comnum; ?> comment</span>
                            </a>
                        </li>
                    </ul>
    </div>
<?php 
    } 
?><!-- blog-post  -->  
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
</body>

</html>
