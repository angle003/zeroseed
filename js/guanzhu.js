 $(".guanzhu").on('click',function(){
              $(this).removeClass("btn-primary").addClass("btn-default");
              $(this).removeClass("guanzhu").addClass("unfollow");
              $(this).html("已关注");                           
              var value=$(this).val();
              $.ajax({
                   url:'addFollow.php',
                   type:'post',
                   data:{fid:value},
                   success:function(data){
                        if(data == 1){
                             alert("已关注");
                             window.location.reload();
                        }else{
                             alert('请先登录!');
                        }
                   }
               });
});

$(".unfollow").hover(function(){
       $(this).html("取消关注");
},function(){
       $(this).html("已关注");
});

 $(".unfollow").on('click',function(){
              $(this).removeClass("btn-default").addClass("btn-primary");
              $(this).removeClass("unfollow").addClass("guanzhu");
              $(this).html("关注");
              var value=$(this).val();
              $.ajax({
                   url:'unFollow.php',
                   type:'post',
                   data:{fid:value},
                   success:function(data){
                        if(data == 1){
                              alert("已取消关注");
                              window.location.reload();
                        }else{
                             alert('请先登录!');
                        }
                   }
               });
});