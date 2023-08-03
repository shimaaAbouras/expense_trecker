<?php 
 session_start();//اتصال 
 include 'db_con.php'; 
  
if(isset($_POST['Username']) && isset($_POST['Password']))//شرط وجود اسم ورقم سري متطابق 
 { 
     function validate($data) 
     { 
        $data=trim( $data); 
        $data=stripslashes( $data); 
        $data= htmlspecialchars( $data); 
        return  $data; 
     } 
     // 
    $Username=validate($_POST['Username']) ; 
    $Password=validate ($_POST['Password']); 
    if(empty($Username))//في حالة عدم وجود الاسم يبقى في صفحة تسجيل الدخول 
    { 
       header("Location: login.php?error= Username error"); 
       exit(); 
    } 
    else if(empty($Password))//في حالة عدم وجود للرقم السري يبقى في الصفحة 
    { 
      header("Location: login.php?error= Password error");  
      exit(); 
    } 
    else 
    { 
      $conn = mysqli_connect('localhost','root' , '' ,'expensetrecker');//اتصال بقاعدة البيانات 
     // 
       $sql = "SELECT * FROM users WHERE Username='$Username' and Password='$Password'"; 
       $result = mysqli_query( $conn,$sql); 
          
       
        if(mysqli_num_rows($result) === 1) 
         { 
          $row= mysqli_fetch_assoc($result); 
          if( $row['Username']===$Username && $row['Password']===$Password) 
          { 
            $_SESSION['Username']=$row['Username']; 
            $_SESSION['id']=$row['id']; 
            echo"welcom"; 
           
            header("Location: hombage.php");  
             exit();      
          }  
          else{header("Location:login.php");  exit();}// 
        } 
        else{header("Location:login.php");  exit();}// 
 
      } 
    }       
    
   else{  header("Location:login.php");  exit(); }// 
    
?>