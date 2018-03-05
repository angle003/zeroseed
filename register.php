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
</head>

<body>
    <!-- Fixed navbar -->
    <?php  include "top.php"; ?>

    <div class="container theme-showcase" role="main">

        <!-- Main jumbotron for a primary marketing message or call to action -->
        <hr>
        <hr>

        <div class="row">

            <div class="col-sm-8  well">
                <form class="form-horizontal " action="addUser.php"   method="post">
                      <div  id="user-success" class="form-group has-feedback">
                            <label for="inputUsername" class="col-sm-2 control-label">用户名</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputUsername" placeholder="用户名"  autofocus  data-container="body" data-toggle="popover" data-placement="auto" data-content="try again later!" name="username">
                                <span  id="user-icon" class="form-control-feedback glyphicon" aria-hidden="true"></span>
                            </div>
                      </div>
                      <div id="pass1-success" class="form-group has-feedback">
                            <label for="inputPassword1" class="col-sm-2 control-label">密码</label>
                            <div class="col-sm-10">
                                 <input type="password" class="form-control" id="inputPassword1" placeholder="6位以上的密码" name="password1" data-container="body" data-toggle="popover" data-placement="auto right" data-content="try again later!">
                                 <span  id="pass1-icon" class="form-control-feedback glyphicon" aria-hidden="true"></span>
                            </div>
                      </div>
                       <div id="pass2-success"  class="form-group has-feedback">
                            <label for="inputPassword2" class="col-sm-2 control-label">确认密码</label>
                            <div class="col-sm-10">
                                 <input type="password" class="form-control" id="inputPassword2" placeholder="确认密码" name="password2" data-container="body" data-toggle="popover" data-placement="auto right" data-content="try again later!">
                                 <span  id="pass2-icon" class="form-control-feedback glyphicon" aria-hidden="true"></span>
                            </div>
                      </div>
                      <div id="email-success"  class="form-group has-feedback">
                            <label for="inputEmail" class="col-sm-2 control-label">邮箱</label>
                            <div class="col-sm-10">
                                 <input type="email" class="form-control" id="inputEmail" placeholder="邮箱" name="email" data-container="body" data-toggle="popover" data-placement="auto right" data-content="try again later!">
                                 <span  id="email-icon" class="form-control-feedback glyphicon" aria-hidden="true"></span>
                            </div>
                      </div>
                      <div class="form-group">
                            <label for="inputAge" class="col-sm-2 control-label">性别</label>
                            <div class="col-sm-10">
                                <div class="btn-group" data-toggle="buttons">
                                       <label  class="btn btn-default active">
                                       <input  type="radio" name="sex" value="1" checked="true"><img src="images/man.png" style="width: 15px;height: 15px;">
                                       </label>
                                       <label  class="btn btn-default">
                                       <input  type="radio" name="sex" value="0"><img src="images/women.png" style="width: 10px;height: 15px;margin-left:2px;margin-right: 3px;">
                                       </label>
                                </div>
                            </div>
                      </div>
                      <div class="form-group">
                         <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                 <label> <input type="checkbox" checked="true">记住我</label>
                            </div>
                         </div>
                      </div>                     
              </form>
              <div class="col-sm-offset-2 col-sm-10">
                                 <button  id="submit" class="btn btn-default">注册</button>
              </div>
           </div>
             <!-- /well -->

               <?php include "right.html"; ?>

     </div>
     <!-- row -->
</div>
<!-- container  -->

<!-- Placed at the end of the document so the pages load faster -->

<script type="text/javascript" src="js/jquery.min.js"></script>
<script> 
  $(function(){ 
    var  flag1=flag2=flag3=flag4=false;
    $("#inputUsername").blur(function(){
          if($(this).val() == ""){
                $(this).popover('destroy');
                $(this).popover({title:'用户名不能为空'});      
                $(this).popover('show');
                flag1=false;
                return;
          }
       var cont=$(this).serialize();
       $.ajax({
          url:'ajax.php',
          type:'post',
          data:cont,
          success:function(data){
                 if(data == 0){
                        $("#user-success").removeClass("has-error").addClass("has-success");
                        $("#user-icon").removeClass("glyphicon-remove").addClass("glyphicon-ok");
                        $("#inputUsername").popover('destroy');
                        flag1=true;
                 }else{
                        $("#user-success").removeClass("has-success").addClass("has-error");
                        $("#user-icon").removeClass("glyphicon-ok").addClass("glyphicon-remove"); 
                        $("#inputUsername").popover('destroy');
                        $("#inputUsername").popover({title:'已有该用户名'});      
                        $("#inputUsername").popover('show');    
                        flag1=false;
                 }
            }
        });
    });
    $("#inputPassword1").blur(function(){
          if($(this).val()==""){
                $(this).popover('destroy');
                $(this).popover({title:'密码不能为空'});      
                $(this).popover('show');
                flag2=false;
          }else if(checkPass($(this).val())){
                $("#pass1-success").removeClass("has-error").addClass("has-success");
                $("#pass1-icon").removeClass("glyphicon-remove").addClass("glyphicon-ok");
                $(this).popover('destroy');
                flag2=true;
          }else{
                $("#pass1-success").removeClass("has-success").addClass("has-error");
                $("#pass1-icon").removeClass("glyphicon-ok").addClass("glyphicon-remove"); 
                $(this).popover('destroy');
                $(this).popover({title:'不合理的密码'});      
                $(this).popover('show');
                flag2=false;
          }
    });
    $("#inputPassword2").blur(function(){
          if($(this).val() == ""){
                $(this).popover('destroy');
                $(this).popover({title:'密码不能为空'});      
                $(this).popover('show');
                flag3=false;
          }else if($("#inputPassword1").val() === $(this).val()){
                $("#pass2-success").removeClass("has-error").addClass("has-success");
                $("#pass2-icon").removeClass("glyphicon-remove").addClass("glyphicon-ok");
                $(this).popover('destroy');
                flag3=true;
          }else{
                $("#pass2-success").removeClass("has-success").addClass("has-error");
                $("#pass2-icon").removeClass("glyphicon-ok").addClass("glyphicon-remove"); 
                $(this).popover('destroy');
                $(this).popover({title:'两次密码不一致'});      
                $(this).popover('show');
                flag3=false;
          }
    });
    $("#inputEmail").blur(function(){
         if($(this).val()==""){
                $(this).popover('destroy');
                $(this).popover({title:'邮箱不能为空'});      
                $(this).popover('show');
                flag4=false;
          }else if(checkEmail($(this).val())){
                $("#email-success").removeClass("has-error").addClass("has-success");
                $("#email-icon").removeClass("glyphicon-remove").addClass("glyphicon-ok");
                $(this).popover('destroy');
                flag4=true;
          }else{
                $("#email-success").removeClass("has-success").addClass("has-error");
                $("#email-icon").removeClass("glyphicon-ok").addClass("glyphicon-remove"); 
                $(this).popover('destroy');
                $(this).popover({title:'邮箱不正确'});      
                $(this).popover('show');
                flag4=false;
          }
    });
    $("#submit").click(function(){
         if(flag1&&flag2&&flag3&&flag4){
                $(".form-horizontal").submit();
         }else{
             alert("fail");
         }
    });
   
   
 });
</script>
<script src="js/bootstrap.min.js"></script>
<script src="js/docs.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>