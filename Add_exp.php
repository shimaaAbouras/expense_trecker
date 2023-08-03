<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category = $_POST['category'];
    $payment = $_POST['payment'];
    $price = $_POST['price'];
    $date = $_POST['date'];
    $comment = $_POST['comment'];

  if ($category && $payment && $price && $date && $comment) {

    $conn = new mysqli('localhost', 'root', '', 'expensetrecker');
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    session_start();
    $id = $_SESSION['id'];

    $query = "INSERT INTO expenses (id_category, id, price, Date, payment, comment) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iissss', $category, $id, $price, $date, $payment, $comment);
    
    // تنفيذ الاستعلام
    if ($stmt->execute()) {
      // تحديث قيمة العمود "Amount" في جدول "category"
      $query = "UPDATE category SET Amount = Amount - ? WHERE id_category = ? AND id = ?";
      $stmt = $conn->prepare($query);
      $stmt->bind_param('dii', $price, $category, $id);
      $stmt->execute();
      
      header("Location: exp.php");
      exit();
    } else {
      echo "Error while adding expense: " . $conn->error;
    }
    $stmt->close();

    $conn->close();
  } else {
    echo "Invalid input";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
  
    <title>Expense Tracker</title>
    <link rel="icon" href="img/h.icon.jpg">
    <link rel="stylesheet" href="homebage.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
 </head>  
<body>
    <div class ="ALL">
      <div class ="topbar">
       <img id="logo" src="img/Finance app-amico.png" alt="logo" style="vertical-align:middle;">
       <nav>
          <h1 class ="logo">Tracking Expenses</h1>
          <ul> 
            <?php
        
        if(isset($_SESSION['id'])&& isset($_SESSION['Username'])){?> 
           <font color="white"> <h3>&emsp;&emsp;  Users: <?php echo $_SESSION['Username']; ?></h3></font> 
            <?php } else{header("Location:hombage.php");  
             exit();  }
              ?> 
            <li><a href="http://localhost/as5/signup.php">Sign Up</a></li>  |
            <li><a href="http://localhost/as5/login.php">Log In</a></li>  |                                         
            <li><a href="category.php">categories</a></li>   |
            <li><a href="http://localhost/as5/exp.php">expenses</a></li>     |
            <li><a href="http://localhost/as5/hombage.php">Home Bage</a></li>   
            <li><a href="logout.php">Log Out</a></li>
              
         </ul>      
       </nav>
     </div>>
     <form  method="post" >
     <div class="form-group">
    <label>Category:</label>
    <select name="category">
      <?php
  
        $conn = new mysqli('localhost', 'root', '', 'expensetrecker');
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        session_start();
        $id = $_SESSION['id'];

    
        $query = "SELECT id_category, name_category FROM category WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

      
        while ($row = $result->fetch_assoc()) {
          echo "<option value=\"" . $row['id_category'] . "\">" . $row['name_category'] . "</option>";
        }

        $stmt->close();
        $conn->close();
      ?>
    </select><br>
    <div class="form-group">
    <label>Payment:</label>
    <select name="payment">
      <option value="1">Check</option>
      <option value="2">Card</option>
      <option value="3">Cash</option>
    </select><br>
    </div >
    <div class="form-group">
    <label>Price:</label>
    <input type="number" name="price"><br>
    </div >
    <div class="form-group">
    <label>Date:</label>
    <input type="date" name="date"><br>
    </div >
    <div class="form-group">
    <label>Comment:</label>
    <input type="text" name="comment"><br>
    </div >
    <button type="submit" class="btn border-secondary" name="submit"> ADD </button>
  </form>
    </div>
</body>
</html>