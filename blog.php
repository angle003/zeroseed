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
      </style>
</head>
<body>
    <!-- Fixed navbar -->
    <?php  include "top.php"; ?>
    <div class="container theme-showcase" role="main">
        <!-- Main jumbotron for a primary marketing message or call to action -->
        <hr>
        <hr>
<?php 
    include "db.php";
    if(isset($_SESSION['user_info'])){
          $user=$_SESSION['user_info'];
     }else{
          $user=null;
     } 
?>
        <div class="blog-header">
            <h1 class="blog-title">-</h1>
        </div>
        <div class="row">
            <div class="col-sm-8 blog-main">
                  <form class="form-horizontal " action="addblog.php"   method="post">
                        <div  id="title" class="form-group">
                            <label for="title" class="col-sm-2 control-label">标题</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="title"  autofocus  name="title">
                            </div>
                        </div>
                        <div  id="content" class="form-group">
                            <label for="content" class="col-sm-2 control-label">内容</label>
                            <div class="col-sm-10">
                                <textarea  class="form-control" id="content" name="content" rows="20"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">发送</button>
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
</body>
</html>