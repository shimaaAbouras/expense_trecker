<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "expensetrecker";

// إنشاء اتصال بقاعدة البيانات
$con = mysqli_connect($host, $username, $password, $database);

// التحقق من نجاح الاتصال
if (!$con) {
    die("فشل الاتصال بقاعدة البيانات: " . mysqli_connect_error());
}
?>