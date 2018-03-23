<?php 
   include "db.php";
   if($_GET['blog_id']){
         if(delBlogById($_GET['blog_id'])){
         	 return 1;
         }else{
         	 return 0;
         }    
   }
?>