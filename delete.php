<?php
session_start();

if(!isset($_SESSION['id']) || !isset($_SESSION['Username'])){
  header("Location:hombage.php");
  exit();
}

$id = $_GET['id'];

$conn = new mysqli('localhost', 'root', '', 'expensetrecker');
if($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$query = "DELETE FROM expenses WHERE id_exp = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id);
$stmt->execute();

header("Location: exp.php"); // تحويل المستخدم إلى صفحة الفئات بعد الحذف
exit();
?>