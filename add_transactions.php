<?php
require_once 'dbConn.php';
session_start();
$id = $_SESSION['id'];
// استيراد ملف الاتصال بقاعدة البيانات
require_once 'dbConn.php';

// تحديد الفئات
$category_from = 'category1';
$category_to = 'category2';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// استلام البيانات المدخلة من المستخدم
	$amount = $_POST["amount"];
    $comments = $_POST["comments"];
    $date = $_POST["date"];
    $category_from = $_POST["category_from"];
    $category_to = $_POST["category_to"];
	try {
	    // بدء عملية النقل
	    $mysqli->begin_transaction();

	    // خصم المبلغ من الفئة المحولة منها
	    $query ="UPDATE category SET Amount=Amount-$amount WHERE name_category='$category_from'";
	    $stmt = $mysqli->query($query);

	    // إضافة المبلغ إلى الفئة المحولة إليها
	    $query ="UPDATE category SET Amount=Amount+$amount WHERE name_category='$category_to'";
	    $stmt = $mysqli->query($query);

	    // استلام معرف المستخدم
	    $id = $_SESSION['id'];

	    // تسجيل التفاصيل في جدول المعاملات
	    $date = date("Y-m-d H:i:s");
	    $sql = "INSERT INTO transactions (date, amount, category_from, category_to, id, comments)
	            VALUES ('$date', '$amount', '$category_from', '$category_to', '$id', '$comments')";
	    if ($mysqli->query($sql) === TRUE) {
			header("Location: transactions.php");
	    } else {
	        echo "خطأ: " . $sql . "<br>" . $mysqli->error;
	    }

	    $mysqli->commit();

	} catch (mysqli_sql_exception $exception) {
	    // في حال حدوث خطأ، إلغاء عملية النقل وطباعة رسالة الخطأ
	    $mysqli->rollback();
	    echo 'حدث خطأ أثناء نقل الأموال';

	    if($mysqli!=null)
	        $mysqli -> close();
	    $mysqli=null;
	    echo'<br>';
	    echo $exception->getMessage();
	}
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-U-compatible" content="IE=edge">
   <meta name="viewport"content="width=device-width ,initial-scale=1.0">
   <link rel="stylesheet" href="Add_trans.css">
   <link rel='stylesheet' href="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" >
   
</head> 
<body>

    <div class="container">
    <div class ="topbar">
       <img id="logo" src="img/Finance app-amico.png" alt="logo" style="vertical-align:middle;">
       <nav>
          <h1 class ="logo">نظام تحويل الاموال</h1>
          <ul> 
            <?php
         
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
	<form method="post" >
    <label>Amount :</label>
		<input type="number" name="amount"><br>
        <label>previous Category  :</label>
		<input type="text" name="category_from"><br>
        <label>Next Category :</label>
		<input type="text" name="category_to"><br>
		<label>Date :</label>
		<input type="date" name="date"><br>
		<label> Reasons For The Transfer :</label>
		<textarea name="comments"></textarea><br>
		<button type="submit" class="btn border-secondary" name="submit"> ADD </button>
	</form>
</body>
</html>