<?php
  // Bước 1: kết nối PHP với MySQL
  $conn = mysqli_connect('localhost','root','','mobileshop');

  // Bước 2: Khai báo ngôn ngữ sử dụng trong CSDL cho PHP 
  mysqli_query($conn,"SET NAMES 'utf8'");

?>