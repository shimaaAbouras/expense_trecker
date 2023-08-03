
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-U-compatible" content="IE=edge">
   <meta name="viewport"content="width=device-width ,initial-scale=1.0">
   <link rel="stylesheet" href="searchh.css">
   <link rel='stylesheet' href="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" >
   
</head> 
<body>

    <div class="container">
    <div class ="topbar">
       <img id="logo" src="img/Finance app-amico.png" alt="logo" style="vertical-align:middle;">
       <nav>
          <h1 class ="logo">Tracking Expenses</h1>
          <ul> 
            <?php
          session_start(); 
        if(isset($_SESSION['id'])&& isset($_SESSION['Username'])){?> 
           <font color="black"> <h2>&emsp;&emsp;  Username: <?php echo $_SESSION['Username']; ?></h2></font> 
            <?php } else{header("Location:hombage.php");  
             exit();  }
              ?> 
               <li><a href="hombage.php">Home Bage</a></li>  |
               <li><a href="signup.php">Sign Up</a></li>  |
            <li><a href="login.php">Log In</a></li>  |                                         
            <li><a href="category.php">categories</a></li>   |
            <li><a href="exp.php">expenses</a></li>     |
            <li><a href="http://localhost/as5/hombage.php">Home Bage</a></li>   
            <li><a href="logout.php">Log Out</a></li>
         </ul>      
       </nav>
     </div>
    
        <table class="table">
       <thead>
           <tr>
                <th scope="col">.N</th>
              <th scope="col">Category</th>
              <th scope="col">ID USER</th>
               <th scope="col">PRICE</th>
               <th scope="col" >DATE</th>
               <th scope="col">PAYMENT</th>
               <th scope="col">COMMENTS</th>
          </tr>
      </thead>
      <tbody>
        
  <h1 >Search Expenses</h1>
  <form method="post">
    <label>Start Date:</label>
    <input type="date" name="start_Date"><br>
    <label>End Date:</label>
    <input type="date" name="end_Date"><br>
    <button type="submit" name="submit">Search</button>
  </form>
</body>
</html>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $start_Date = $_POST['start_Date'];
  $end_Date = $_POST['end_Date'];

  if ($start_Date && $end_Date) {
    $conn = new mysqli('localhost', 'root', '', 'expensetrecker');
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    
    $id = $_SESSION['id'];

    $query = "SELECT id_exp, id_category, id, price, Date, payment, comment FROM expenses WHERE id = ? AND Date BETWEEN ? AND ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iss', $id, $start_Date, $end_Date);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $id_exp = $row["id_exp"];
        $id_category=$row["id_category"];
        $id = $row["id"];
        $price = $row["price"];
        $Date = $row["Date"];
        $payment = $row["payment"];
        $comment = $row["comment"];
      
        echo '<tr>
        <td>'.$id_exp.'</td>
        <td>'.$id_category.'</td>
        <td>'.$id.'</td>
    <td>'.$price.'</td>
    <td>'.$Date.'</td>
    <td>'.$payment.'</td>
    <td>'.$comment.'</td>
    </tr>';
    }
    
    $stmt->close();
    $conn->close();
  } else {
    echo "Invalid input";
  }
}
?>
