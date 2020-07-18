<?php
// TEST IN lib.php

session_start(); // khai báo thư viện session
// session phải dc khai báo trước các lệnh in ra như echo và trước các lệnh html => nên khai báo ở đầu file

$_SESSION['email'] = 'spt@gmail.com';
$_SESSION['pass'] = 'hihi123';

// echo $_SESSION['email'].'<br/>'.$_SESSION['pass'];

// session dc lưu ở cả server và broswer => khi vào trang web thì client gửi session về cho server và server sẽ check xem có trúng vs session lưu ở server ko
// xóa session
// unset($_SESSION['email']); // xóa 1 session nào đó
// session_destroy();// xóa tất cả các session nhưng ở phiên sau

?>


<?php

    // CONST
    define('PI',3.14);
    if(defined('PI')) // kiểm tra khai báo của hằng số => các biến thường thì dùng isset
        echo PI;


    header('location: lib.php'); // chuyển hướng trang web sang url /lib.php
    // => dùng để chuyển trang

?> 