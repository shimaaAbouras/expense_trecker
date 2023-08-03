<?php
session_start();
?>
<?php
// تحميل بيانات المستخدم المسجل

$id = $_SESSION['id'];

// الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "expensetrecker";
$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if(isset($_POST['submit'])) {
   
    $Type = $_POST['Type'];
    $Amount = $_POST['Amount'];
    $name_category = $_POST['name_category'];
    
    $check_query = "SELECT * FROM category WHERE name_category='$name_category' AND id='$id'";
     $check_result = mysqli_query($conn, $check_query);
    if(mysqli_num_rows($check_result) > 0)
     { echo "هذه الفئة موجودة بالفعل"; } 
     else {
      $sql = "INSERT INTO category (Type, name_category, Amount, id) VALUES ('$Type', '$name_category', '$Amount', '$id')"; 
      if (mysqli_query($conn, $sql)) {
      header("Location: category.php");
       exit();
       } 
      else { echo "حدث خطأ أثناء إضافة المصروف: " . mysqli_error($conn); 
      } 
      } 
      } // إغلاق الاتصال بقاعدة البيانات 
      mysqli_close($conn); ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-U-compatible" content="IE=edge">
   <meta name="viewport"content="width=device-width ,initial-scale=1.0">
   <link rel="stylesheet" href="Add_exp.css">
   <link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel='stylesheet'>
 </head>  
<body>
  <div class="container my-5">
  <div class="container">
    <div class ="topbar">
       <img id="logo" src="img/Finance app-amico.png" alt="logo" style="vertical-align:middle;">
       <nav>
          <h1 class ="logo">Tracking Expenses</h1>
          <ul> 
            <?php
         
        if(isset($_SESSION['id'])&& isset($_SESSION['Username'])){?> 
           <font color="white"> <h2>&emsp;&emsp;  Username: <?php echo $_SESSION['Username']; ?></h2></font> 
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
     </div>
       <form  method="post" >

       <div class="form-group">
       <label >TYPE :</label>
       <select name="Type"  class="form-control" >
                  <option value="Income">Income</option>
                  <option value="Expense">Expense</option>
               </select>
      </div>
     <div class="form-group">
     <label >Category :</label>
     <select name="name_category"  class="form-control" >
                  <option value="Food">Food</option>
                  <option value="Sports">Sports</option>
                  <option value="Shopping">Shopping</option>
                  <option value="Transport">Transport</option>
                  <option value="Bills">Bills</option>
               </select>
     </div>   
      
      <div class="form-group">
         <label >Amount</label>
         <input type="number" class="form-control"placeholder="Enter your Amount" name="Amount" autocomplete="off">
     </div> 
    
      <button type="submit" class="btn border-secondary" name="submit"> ADD </button>
     </from>
  </div>

      
     
</body>
</html>