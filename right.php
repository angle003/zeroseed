<?php 
    $res=getHotBlogs();
?>
  <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
                <div class="sidebar-module sidebar-module-inset">
                    <h4>About</h4>
                    <p>这是一个私人的博客网站，zeroseed是这个网站的名字，站长呢就是zero，希望大家能在这个网站记录自己的日常，或者技术经验~</p>
                </div>
                <div class="sidebar-module">
                    <h4>站内热文TOP 10</h4>
                    <ol class="list-unstyled">
                        <?php 
                             while($row=mysql_fetch_array($res)){
                                $url="comment.php?blog_id=".$row['blog_id']."&random=".rand();
                                echo  "<li><a href='".$url."'>".$row['blog_title']."</a></li>";
                            }
                        ?>        
                    </ol>
                </div>
                <div class="sidebar-module">
                    <h4>Elsewhere</h4>
                    <ol class="list-unstyled">
                        <li><a href="https://github.com/angle003">GitHub</a></li>
                    </ol>
                </div>
            </div>
            <!-- /.blog-sidebar -->