
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
          session_start(); 
        if(isset($_SESSION['id'])&& isset($_SESSION['Username'])){?> 
           <font color="white"> <h3>&emsp;&emsp;  Users: <?php echo $_SESSION['Username']; ?></h3></font> 
            <?php } else{header("Location:hombage.php");  
             exit();  }
              ?> 
            <li><a href="http://localhost/as5/signup.php">Sign Up</a></li>  |
            <li><a href="http://localhost/as5/login.php">Log In</a></li>  |                                         
            <li><a href="category.php">categories</a></li>   |
            <li><a href="http://localhost/as5/exp.php">expenses</a></li>     |
            <li><a href="logout.php">Log Out</a></li>
              
         </ul>      
       </nav>
     </div>
     <div class="main">
       <div class="content">  <h2><em><span>ABout Us :</span></em> </h2>
         <h1><span>P</span>ersonal money <span>M</span>anagement <span>W</span>ebsite</h1>
         <h3>Money management is all operations that aim to balance savings,<br> income and periodic expenses<br>The existence of a personal financial income can lead in the end to falling <br>into the trouble of religion Some personal expenses can exceed monthly income limits.</h3>
         <a href="signup.php">Sign UP</a>
         <a href="login.php">Log IN</a><br>

         <a href="category.php">View Category</a>
         <a href="Add_category.php"> Add Category</a>
         <a href="exp.php">View Expenses</a>
         <a href="add_exp.php">Add Expenses</a><br>
         <a href="transactions.php">Transactions</a>
         <a href="rating.php">Rating.</a>
         <a href="search.php">Search</a>
       </div>
       <div class="icon">
          <div class="social-icon">
            <ul>
             <li><em>MY Account </em></li>
              <li><a href="https://www.facebook.com" class='bx bxl-facebook-circle bx-tada' ></a> </li>
             <li><a href="https://www.instagram.com" class='bx bxl-instagram-alt bx-tada' ></a></li>
             <li ><a href="https://www.gmail.com" class='bx bxl-gmail bx-tada' ></a></li>
             <li><a href="https://www.Twitter.com" class='bx bxl-twitter bx-tada' ></a></li>
           </ul> 
         </div>
       </div>
   </div> 
    <footer>Copyright © 2022-2023 UOT.
     All Rights are reserved</footer>    
 </div>
 </body>   
     
</head>
</html> 
  