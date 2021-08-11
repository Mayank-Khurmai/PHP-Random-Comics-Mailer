<?php

    session_start();
    $_SESSION['xkcd_admin'] = '';
    session_destroy();
    header('Location: http://localhost/php-Mayank-Khurmai/admin/');
    exit();

?>