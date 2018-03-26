 $(".guanzhu").on('click',function(){
              $(this).removeClass("btn-primary").addClass("btn-default");
              $(this).html("已关注")
              $(this).attr("disabled", true); 
              var value=$(this).val();
              $.ajax({
                   url:'addFollow.php',
                   type:'post',
                   data:{fid:value},
                   success:function(data){
                        console.log(data);
                   }
               });
          });