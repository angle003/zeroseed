<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ZeroSeed</title>
    <meta name="keywords" content="ZEROSEED,ZERO'S WEB SITE ">
    <meta name="description" content="Load successfully">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <link href="css/main.css" rel="stylesheet">
    <link href="css/comment.css" rel="stylesheet">

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
   
</head>

<body>
    <!-- Fixed navbar -->
    <?php include "top.html"; ?>

    <div class="container theme-showcase" role="main">

        <!-- Main jumbotron for a primary marketing message or call to action -->

        <hr>
        <hr>
<?php
    include "db.php"; 
    $blog_id=$_GET['blog_id'];
    $blogs=getBlogById($blog_id);
    $blog=mysql_fetch_array($blogs);
    $comnum=getCommentsByBlogId($blog_id);
    // $add=addLikesByBlogId($blog_id);
 ?>
        <div class="blog-header">
            <h1 class="blog-title text-center"><?php echo $blog['blog_title']; ?></h1>
            <p class="lead blog-description text-center"><?php echo $blog['blog_cretime']; ?></p>
        </div>

        <div class="row">

            <div class="col-sm-8 blog-main">

                <div class="blog-post">

                    <p><?php echo $blog['blog_content']; ?></p>
                    <p class="blog-post-title"><a href="#">by Jessica</a><br>
                        <span class="blog-post-meta ">January 1, 2017 </span>
                    </p>
                    <ul class="glyphicons-list">
                        <li>
                            <a href="javascript:void(0);" onclick="<?php echo "showResult1(".$blog_id.")"; ?>" ><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
                                <span id="<?php echo "blog_likes_".$blog_id; ?>" class="glyphicon-class"><?php echo $blog['blog_likes']; ?> like</span>
                            </a>
                        </li>
                        <li>
                            <a href="#"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                                <span class="glyphicon-class"><?php echo $comnum; ?> comment</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- /.blog-post -->
                <h2>comments</h2>
                <hr>


<?php  
     $res=getCommentByBlogId($blog_id);
     while ($row=mysql_fetch_array($res)) {
        $user_info=getUserinfoById($row['bolg_comment_uid']);
        $comment_id=$row['blog_comment_id'];
        $comments=getCommentComsCount($comment_id);
?>
                <div class="blog-post-comment">
                    <p class="blog-post-title" style=" position: relative;">
                        <?php echo "<img src='".$user_info['user_image_url']."' />"; ?>
                       
                                <a href="#" style="font-size: 2em;"><?php echo $user_info['user_info_nickname']; ?></a><br>
                        <span class="blog-post-meta " style="position: absolute;top:30px;left:45px;"><?php echo $row['blog_comment_cretime']; ?></span>
                    </p>
                    <p><?php echo $row['blog_comment_content']; ?></p>
                    <ul class="glyphicons-list-comment">
                        <li>
                            <a  href="javascript:void(0);" onclick="<?php echo "show(".$comment_id.")"; ?>" > <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
                                <span id="<?php echo "blog_comment_likes_".$comment_id; ?>" class="glyphicon-class"><?php echo $row['blog_comment_likes']; ?> like</span>
                            </a>
                        </li>
                        <li>
                            <a href="#"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                                        <span class="glyphicon-class"><?php echo $comments; ?> comment</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- /.blog-post-comment -->
<?php
    $comment_coms=getCommentComs($comment_id);
    while ($ro=mysql_fetch_array($comment_coms)) {
        $com_user_info=getUserinfoById($ro['bolg_comment_uid']);
        $com_comment_id=$ro['blog_comment_id'];
?>
 <div class="blog-post-comment"  >
                    <p class="blog-post-title" style="position: relative;margin-left: 20px;">
                        <?php echo "<img src='".$com_user_info['user_image_url']."' />"; ?>
                       
                                <a href="#" style="font-size: 2em;"><?php echo $com_user_info['user_info_nickname']; ?></a><br>
                        <span class="blog-post-meta " style="position: absolute;top:30px;left:45px;"><?php echo $ro['blog_comment_cretime']; ?></span>
                    </p>
                    <p style="margin-left: 20px;"><?php echo $row['blog_comment_content']; ?></p>
                    <ul class="glyphicons-list-comment" style="margin-right: 200px;" ontouch="showWindow()">
                        <li>
                            <a  href="javascript:void(0);" onclick="<?php echo "show(".$com_comment_id.")"; ?>"> <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
                                <span id="<?php echo "blog_comment_likes_".$com_comment_id; ?>" class="glyphicon-class"   ><?php echo $ro['blog_comment_likes']; ?> like</span>
                            </a>
                        </li>
                    </ul>
                </div>

<?php 
   } 
} ?>
         <a onclick="alert('ZeroSeed')">--</a>
            </div>
            <!-- /.blog-main -->
                
            <?php include "right.html"; ?>
            <!-- /.blog-sidebar -->
        </div>
        <!-- row -->
    </div>
    <!-- container  -->


    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script >
        window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>'); 
    </script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
</body>

</html>