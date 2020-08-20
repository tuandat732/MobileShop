<?php
    //time in php
    date_default_timezone_set('asia/bangkok');
    echo date("Y-m-d H:i:s");
?>

<?php
// // TEST IN lib.php

// session_start(); // khai báo thư viện session
// // session phải dc khai báo trước các lệnh in ra như echo và trước các lệnh html => nên khai báo ở đầu file

// $_SESSION['email'] = 'spt@gmail.com';
// $_SESSION['pass'] = 'hihi123';

// // echo $_SESSION['email'].'<br/>'.$_SESSION['pass'];

// // session dc lưu ở cả server và broswer => khi vào trang web thì client gửi session về cho server và server sẽ check xem có trúng vs session lưu ở server ko
// // xóa session
// // unset($_SESSION['email']); // xóa 1 session nào đó
// // session_destroy();// xóa tất cả các session nhưng ở phiên sau

?>


<?php

    // // CONST
    // define('PI',3.14);
    // if(defined('PI')) // kiểm tra khai báo của hằng số => các biến thường thì dùng isset
    //     echo PI;


    // header('location: lib.php'); // chuyển hướng trang web sang url /lib.php
    // // => dùng để chuyển trang

?> 


<?php 
    $hihi = 34;
    echo "hello $hihi";
    echo 'hello $hiihi';
    echo "TEST DB <br/>";

    // Bước 1: kết nối PHP với MySQL
    $conn = mysqli_connect('localhost','root','','hocmysql');

    // Bước 2: Khai báo ngôn ngữ sử dụng trong CSDL cho PHP 
    mysqli_query($conn,"SET NAMES 'utf8'");

    // Bước 3: Viết truy vấn SQL
    $sql = "SELECT * FROM thanhvien";

    // Bước 4: thực thi truy vấn
    $query = mysqli_query($conn, $sql);
    
    // convert to arr
    $data = mysqli_fetch_array($query); // fetch này chỉ lấy record đầu tiên trong db và lưu vào bộ đệm
    // => dùng while để lấy dc full record ra

    // hàm lấy length bản ghi
    $len = mysqli_num_rows($query);
    echo 'len: '.$len.'<br/>';
    
    while($data = mysqli_fetch_array($query)) {
        echo $data[1]."<br/>".$data['mat_khau'].'<br/>';
    }

?>