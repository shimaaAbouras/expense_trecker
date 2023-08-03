
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-U-compatible" content="IE=edge">
   <meta name="viewport"content="width=device-width ,initial-scale=1.0">
   <link rel="stylesheet" href="Add_exp.css">
   <link rel='stylesheet' href="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" >
    <title>Expense Tracker</title>
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
           <font color="white"> <h2>&emsp;&emsp;  Username: <?php echo $_SESSION['Username']; ?></h2></font> 
            <?php } else{header("Location:hombage.php");  
             exit();  }
              ?> 
               <li><a href="signup.php">Sign Up</a></li>  |
            <li><a href="login.php">Log In</a></li>  |                                         
            <li><a href="category.php">categories</a></li>   |
            <li><a href="exp.php">expenses</a></li>     |
            <li><a href="http://localhost/as5/hombage.php">Home Bage</a></li>     |
            <li><a href="logout.php">Log Out</a></li>
         </ul>      
       </nav>
     </div>
   
    <a href="Add_category.php" class="btn border-secondary">Add category</a>
  
        <table class="table">
       <thead>
           <tr>
                <th scope="col">.N</th>
              <th scope="col">Type</th>
              <th scope="col">Category</th>
               <th scope="col">Amount</th>
               <th scope="col" >Action</th>
          </tr>
      </thead>
      <tbody>
         <?php  
    $id = $_SESSION['id'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "expensetrecker";
$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT id_category, Type, name_category, Amount ,id FROM category WHERE  id=$id  ";

$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    $id_category=$row["id_category"];
    $Type = $row["Type"];
    $name_category = $row["name_category"];
    $Amount = $row["Amount"];
   
    echo '<tr>
    <td>'.$id_category.'</td>
<td>'.$Type.'</td>
<td>'.$name_category.'</td>
<td>'.$Amount.'</td>
<td >  
<a href="exp.php?category='.$row['id_category'].'"class="btn border-danger">Expenses</a>
</td>
</tr>';
}


} else
 {
  echo "<tr><td colspan='3'>لا توجد بيانات</td></tr>";
}



mysqli_close($conn);
?>
        </tbody>
       </table>
      
       <a href="hombage.php"class="btn border-secondary">logout</a>
    </div>
</body>
</html>