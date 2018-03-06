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
<?php 
    include "top.php"; 
    if(isset($_SESSION['user_info'])){
        $user=$_SESSION['user_info'];
    }else{
        $user=null;
    } 
?>
    <div class="container theme-showcase" role="main">
        <!-- Main jumbotron for a primary marketing message or call to action -->
        <hr>
        <hr>
<?php
    include "db.php"; 
    $blog_id=$_GET['blog_id'];
    $blogs=getBlogById($blog_id);
    $blog=mysql_fetch_array($blogs);
    $user_info=getUserinfoById($blog['blog_user_id']);
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
                    <p class="blog-post-title"><a href="#">by  <?php echo $user_info['user_info_nickname']; ?></a>
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
                <form  id="blog_comment" class="form-horizontal" >
                        <div class="form-group comment">
                            <label for="content" class="col-sm-2 control-label">
                                    <img src="<?php if($user){ echo $user['user_image_url']; }else{ echo 'https://static.hdslb.com/images/akari.jpg';} ?>" >
                            </label>
                            <div class="col-sm-10">
                                <textarea  class="form-control" id="comment" name="comment" rows="4"></textarea>     
                                <input type="text" name="blog_id" value="<?php echo $blog_id; ?>" style="display: none;" >       
                            </div>
                        </div>
                </form> 
                 <div class="col-lg-offset-11  col-sm-offset-10  col-xs-offset-9  col-xs-3  col-sm-2  col-lg-1">
                         <button id="send"  class="btn btn-primary">发送</button>
                 </div>
<?php  
     $res=getCommentByBlogId($blog_id);
     while ($row=mysql_fetch_array($res)) {
        $reUid=$row['bolg_comment_uid'];
        $user_info_coms=getUserinfoById($reUid);
        $comment_id=$row['blog_comment_id'];
        $comments=getCommentComsCount($comment_id);
?>
                <div class="blog-post-comment">
                    <p class="blog-post-title" style=" position: relative;">
                        <?php echo "<img src='".$user_info_coms['user_image_url']."' />"; ?>     
                                <a href="#" style="font-size: 2em;"><?php echo $user_info_coms['user_info_nickname']; ?></a><br>
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
                            <a href="javascript:void(0);" onclick="<?php echo 'showDilog('.$comment_id.')'?>"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                                        <span class="glyphicon-class"><?php echo $comments; ?> 回复</span>
                            </a>
                        </li>                   
                    </ul>
                     <form  action="addCommentComs.php" method="post" id="<?php echo 'commentComs'.$comment_id;?>"  class="form-horizontal"  style="display: none;" onSubmit="<?php echo 'return confirm('.$comment_id.')';?>" >
                        <div class="form-group">                          
                            <div class="col-sm-12">
                                <textarea  class="form-control commentComs"  id="<?php echo 'commentCont'.$comment_id;?>"  name="commentComs" rows="4"></textarea>         
                                <input type="text" name="blog_id" value="<?php echo $blog_id; ?>" style="display: none;" >     
                                <input type="text" name="comment_id" value="<?php echo $comment_id; ?>" style="display: none;">          <input type="text" name="reUid" value="<?php echo $reUid; ?>" style="display: none;">
                            </div>
                        </div>
                         <div class="form-group">                          
                            <div class="col-sm-12">                    
                                <button id="sendComs"  class="btn btn-primary" style="float: right;">发送</button>                        
                            </div>
                        </div>
                      </form> 
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
                    <p style="margin-left: 20px;"><?php echo $ro['blog_comment_content']; ?></p>
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

         <a  onclick="alert('ZeroSeed')">^-^</a>
            
            <!-- /.blog-main -->
    </div>  

            <?php include "right.html"; ?>
            <!-- /.blog-sidebar -->
        </div>
        <!-- row -->
    </div>
    <!-- container  -->


    <!-- Placed at the end of the document so the pages load faster -->
   <script type="text/javascript" src="js/jquery.min.js"></script>
   <script type="text/javascript">
       function showDilog(id){
           $("#commentComs"+id).fadeToggle();  
       }
       function confirm(id){
           var cont=$("#commentCont"+id).val();
           if(cont == ""){
                 alert("内容不能为空！");
                 return false;
           }else{
                 return true;
           }
       }
       $(".commentComs").focus(function(){
              if(<?php if($user){echo "true";}else{echo "false";}; ?>){ 
                     $(this).css({"backgroundColor":"#F3F3F3"});
              }else{
                 alert("请先登录!");
                 $(this).blur();
              }
        });
       $("#comment").focus(function(){
            if(<?php if($user){echo "true";}else{echo "false";}; ?>){ 
                     $(this).css({"backgroundColor":"#F3F3F3"});
            }else{
                 alert("请先登录!");
                 $(this).blur();
            }
       });

       $("#comment").blur(function(){
            $(this).css({"backgroundColor":"white"});
       });
       $("#send").click(function(){
             var data= $("#blog_comment").serialize();      
             if(comment == ""){
                  alert("内容不能为空！");
             }else{
                     $.ajax({
                            url:'addComment.php',
                            type:'post',
                            data:data,
                            success:function(data){
                                if(data == 1){
                                    window.location.href='comment.php?blog_id=<?php echo $blog_id; ?>'; 
                                }else if(data == 2){
                                    alert("评论失败");
                                }else{
                                    alert("评论不能为空");
                                }
                                
                            }
                     });
            }
       });
   </script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
</body>

</html>