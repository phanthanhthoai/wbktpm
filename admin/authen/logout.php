
 <!-- session_start();
 require_once('../../utils/utility.php');
 require_once('../../database/dbhelper.php');

session_start();
$token = getCookie('token');
setcookie   ('token', '', time() -100,'/');
session_destroy(); -->
<?php
session_start();
require_once('../../utils/utility.php');
require_once('../../database/dbhelper.php');

// Xóa session và cookie
session_destroy();
setcookie('token', '', time() - 100, '/');

// Chuyển hướng người dùng về trang đăng nhập
header("Location: login.php");
exit();
?>