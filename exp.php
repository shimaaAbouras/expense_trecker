<?php
session_start();

if(!isset($_SESSION['id']) || !isset($_SESSION['Username'])){
  header("Location:hombage.php");
  exit();
}

$id = $_SESSION['id'];

$conn = new mysqli('localhost', 'root', '', 'expensetrecker');
if($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM expenses WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="Add_exp.css">
  <link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel='stylesheet'>
  <title>User Expenses</title>
</head>
<body>
  <div class="container my-5">
    <div class="container">
      <div class="topbar">
         <img id="logo" src="img/Finance app-amico.png" alt="logo" style="vertical-align:middle;">
         <nav>
            <h1 class="logo">Tracking Expenses</h1>
            <ul> 
              <font color="white"> <h2>&emsp;&emsp;  Username: <?php echo $_SESSION['Username']; ?></h2></font> 
              <li><a href="http://localhost/as5/signup.php">Sign Up</a></li>  |
              <li><a href="http://localhost/as5/login.php">Log In</a></li>  |                                         
              <li><a href="category.php">categories</a></li>   |
              <li><a href="http://localhost/as5/exp.php">expenses</a></li>     |
              <li><a href="http://localhost/as5/hombage.php">Home Bage</a></li>     |
              <li><a href="logout.php">Log Out</a></li>
           </ul>      
         </nav>
       </div>
       <a href="Add_exp.php" class="btn border-secondary">ADD Expenses</a>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Category</th>
            <th scope="col">Price</th>
            <th scope="col">Date</th>
            <th scope="col">Payment</th>
            <th scope="col">Comment</th>
            <th scope="col" >Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
            while($row = $result->fetch_assoc())
             {
              echo "<tr>";
              echo "<td>" . $row['id_category'] . "</td>";
              echo "<td>" . $row['price'] . "</td>";
              echo "<td>" . $row['Date'] . "</td>";
              echo "<td>" . $row['payment'] . "</td>";
              echo "<td>" . $row['comment'] . "</td>";
              echo "<td><a href='delete.php?id=" . $row['id_exp'] . "' class='btn btn-danger'>Delete</a></td>";
              echo "<td><a href='update.php?id=" . $row['id_exp'] . "' class='btn btn-danger'>update</a></td>";
              echo "</tr>";
            }
          ?>
        </tbody>
      </table>
      
    </div>
  </div>
</body>
</html>