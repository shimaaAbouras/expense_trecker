<?php
$Username = $_POST['Username'];
$Email = $_POST['Email'];
$Age = $_POST['Age'];
$phone = $_POST['phone'];
$Password = $_POST['Password'];
$CPassword = $_POST['CPassword'];

 if(strlen($Username)<10)
{
    die("The user should not be less than 10 characters");
}
else if(strlen($Username)>15)
{
    die("The username should not exceed 15 characters");
}
if(strlen($Password)<10)
{
    die("The password is requested to enter at least 10 characters");
}
elseif(strlen($Password)>15)
{
     die("The password should not exceed 15 characters");
}
elseif(!preg_match("/[a-z]/",$Password))
{
    die("It must consist of lowercase letters the password");
}
elseif(!preg_match("/[A-Z]/",$Password))
{
    die("It is necessary for the password to include uppercase letters");
}
else if(!preg_match("/[~!@#$%^&*()_+]/",$Password)){
    die("Password must contain romoz");
}
else if($Password!==$CPassword)
{
    die("Passwords do not match");
}

if (!isset($_POST['Username']) || !isset($_POST['Email']) 
     || !isset($_POST['Age']) || !isset($_POST['phone']) 
     || !isset($_POST['Password']) || !isset($_POST['CPassword'])) {
    echo "<p>You have not entered all the required details.<br />
         Please go back and try again.</p>";
    exit;
}

$Username = $_POST['Username'];
$Email = $_POST['Email'];
$Age = $_POST['Age'];
$phone = $_POST['phone'];
$Password = $_POST['Password'];
$CPassword = $_POST['CPassword'];
//
include 'db_conn.php';
if ($conn->connect_error) {
  echo "<p>Error: Could not connect to database.<br/>
  Please try again later.</p>";
    die($conn -> error);
}

$duplicate=mysqli_query($conn,"SELECT * FROM users WHERE Username = '$Username' OR Email = '$Email'");
if(mysqli_num_rows($duplicate) < 0){
    echo
     die("Username or Email no taken"); 
}
else{
    $query = "INSERT INTO users (Username,Email,Age,phone,Password )  VALUES 
    ('$Username', '$Email', '$Age',  '$phone','$Password' )" ;
       
    $result = $conn-> query($query);
    $sql="SELECT * FROM  `users`";
    $result=mysqli_query($conn,$sql);
    if($result)
    {
        $id = $conn->id;
        header("Location: http://localhost/as5/login.php");
        exit;
    }
    else
    {
        echo $conn->error;
        echo "<br/>The item was not added.";
        echo "<br/>$query";
    }
}


   //close connection
   $conn -> close();
?>