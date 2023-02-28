<?php 
    include "config-admin.php";
    session_start();
    session_unset();
    session_destroy();

    header("Location: /dang-nhap");
?>