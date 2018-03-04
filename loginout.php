<?php
    session_start();
    session_destroy('user_info');
    session_unset('user_info');
    echo "<script> window.location.href='index.php' </script>";
?>