<?php
include "db_con.php";

session_start();
$id = $_SESSION['id'];

$sql = "SELECT * FROM expenses WHERE id='$id'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
  $id_category = $_POST['id_category'];
  $price = $_POST['price'];
  $date = $_POST['date'];
  $payment = $_POST['payment'];
  $comment = $_POST['comment'];


  $sql = "UPDATE expenses SET id_category='$id_category', price='$price', Date='$date', payment='$payment', comment='$comment' WHERE id='$id'";

  $result = mysqli_query($con, $sql);

  if ($result) {
    echo "تم تحديث البيانات بنجاح";
    header('location: exp.php');
    exit;
  } else {
    die(mysqli_error($con));
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-U-compatible" content="IE=edge">
  <meta name="viewport"content="width=device-width ,initial-scale=1.0">
  <link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel='stylesheet'>
  <title>Expense Tracker</title>
</head>
<body>
  <div class="container my-5">
    <form method="post">
      <div class="form-group">
        <label>Category ID</label>
        <input type="number" class="form-control" name="id_category" value="<?php echo $row['id_category']; ?>" autocomplete="off">
      </div>
      <div class="form-group">
        <label>Price</label>
        <input type="number" class="form-control" name="price" value="<?php echo $row['price']; ?>" autocomplete="off">
      </div>
      <div class="form-group">
        <label>Date</label>
        <input type="date" class="form-control" name="date" value="<?php echo $row['Date']; ?>" autocomplete="off">
      </div>
      <div class="form-group">
        <label>Payment</label>
        <input type="text" class="form-control" name="payment" value="<?php echo $row['payment']; ?>" autocomplete="off">
      </div>
      <div class="form-group">
        <label>Comment</label>
        <input type="text" class="form-control" name="comment" value="<?php echo $row['comment']; ?>" autocomplete="off">
      </div>
      <button type="submit" name="submit" class="btn btn-primary">تحديث</button>
</body>
</html>