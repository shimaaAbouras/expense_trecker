<?php
session_start();

require_once 'dbConn.php';

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $query = "SELECT rated FROM users WHERE id = '$id'";
    $result = $mysqli->query($query);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['rated'] == 1) {
            echo "لقد قيمت الموقع من قبل";
        } else {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $rating = $_POST["rating"];
                $comment = $_POST["comment"];

                try {
                    $mysqli->begin_transaction();

                    $sql = "INSERT INTO ratings (id, rating, comment) VALUES ('$id', '$rating', '$comment')";
                    if ($mysqli->query($sql) === TRUE) {
                        echo "تم تسجيل التقييم بنجاح";
                    } else {
                        echo "خطأ: " . $sql . "<br>" . $mysqli->error;
                    }

                    $query = "UPDATE users SET rated = 1 WHERE id = '$id'";
                    $mysqli->query($query);

                    $mysqli->commit();

                } catch (mysqli_sql_exception $exception) {
                    $mysqli->rollback();
                    echo 'حدث خطأ أثناء تسجيل التقييم';

                    if($mysqli!=null)
                        $mysqli -> close();
                    $mysqli=null;
                    echo'<br>';
                    echo $exception->getMessage();
                }
            }
        }
    } else {
        echo "يجب تسجيل الدخول لتقييم الموقع";
    }
} else {
    echo "يجب تسجيل الدخول لتقييم الموقع";
}
$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-U-compatible" content="IE=edge">
   <meta name="viewport"content="width=device-width ,initial-scale=1.0">
   <link rel="stylesheet" href="reting.css">
   <link rel='stylesheet' href="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" >
   
</head> 
<body>
    <div class="container">
        <div class="topbar">
            <img id="logo" src="img/Finance app-amico.png" alt="logo" style="vertical-align:middle;">
            <nav>
                <h1 class="logo">Tracking Expenses</h1>
                <ul> 
                    <?php
                    if(isset($_SESSION['id']) && isset($_SESSION['Username'])){?> 
                        <font color="black"> <h2>&emsp;&emsp;  Username: <?php echo $_SESSION['Username']; ?></h2></font> 
                    <?php } else{header("Location:hombage.php"); exit(); }
                    ?> 
                    <li><a href="hombage.php">Home Bage</a></li>  |
                    <li><a href="login.php">Log In</a></li>  |                                         
                    <li><a href="category.php">categories</a></li>   |
                    <li><a href="exp.php">expenses</a></li>     |
                    <li><a href="logout.php">Log Out</a></li>
                </ul>      
            </nav>
        </div>

        <div class="form-box">
            <form method="post">
                <h1>تقيم الموقع</h1>
                <div class="form-group">
                    <label for="rating">التقييم:</label>
                    <select id="rating" name="rating">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <br><br>
                <div class="form-group">
                    <label for="comment">تعليق:</label>
                    <textarea id="comment" name="comment"></textarea>
                </div>
                <br><br>
                <input type="submit" name="submit" value="تقييم">
            </form>
        </div>
    </div>
</body>
</html>