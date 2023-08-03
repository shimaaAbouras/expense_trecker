
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="signup.css">
    <link rel="stylesheet" type="text/php" href="signup1.php">
    <title>signup</title>
</head>
<body>
  <div class="container">
     <div class ="ALL">
       <div class ="topbar">
       <img id="logo" src="img/Finance app-amico.png" alt="logo" style="vertical-align:middle;">
         <nav>
             <h1 class ="logo">Tracking Expenses</h1>
              <ul>   
                 <li><a href="hombage.PHP">Home Bage</a></li>   
                 <li><a href="signup.php">Sign Up</a></li>    
                 <li><a href="login.php">Log In</a></li>                                          
                 <li><a href="#">About Us</a></li>     
                 <li><a href="logout.php">Log Out</a></li>
               </ul>         
          </nav>
         </div>
          <div class="form-box">
          <form method="POST" action="signup1.php" method="post">
              <h2> Register</h2>
                <div class="input-box">
                <ion-icon name="mail-outline"></ion-icon>
                    <input type="text"  name="Username" placeholder="Username" required>
                </div>
                
                <div class="input-box">
                    <input type="email" name="Email" placeholder="Email" required>
                </div>
                <div class="input-box">
                    <input type="number" name="Age" placeholder="Age" required>
                </div>
                <div class="input-box">
                    <input type="number" name="phone" placeholder="phone" required>
                </div>
                <div class="input-box">
                    <input type="Password" name="Password" placeholder="Password" required>
                </div>
                <div class="input-box">
                    <input type="Password" name="CPassword" placeholder="Confirm Password" required>
                </div>
                <div class ="buttom" >
                   
                    <button type="submit"  class="btn" >YOUR LOGIN </button>
              </div>
          </form>
       </div>  
       <footer>Copyright © 2022-2023 UOT.
           All Rights are reserved
      
  </footer> 
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>  
</body>
</html>
