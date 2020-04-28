<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="css/style.css" type="text/css">

    <title>Sign-Up</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    </head>
  <body>
    <?php
      $conn = new mysqli("localhost", "root", "","DearDiary");
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
      if(isset($_POST["submit"])){
      $username = $_POST["username"];
      $email = $_POST["email"];
      $password = $_POST["password"];
      $confpassword = $_POST["confpassword"];
      if(empty($username)||empty($email)||empty($password)||empty($confpassword)){
        echo '<p style="text-align: center;">Enter all elements</p>';
      }
      elseif($password!==$confpassword){
        echo '<p style="text-align: center;">Passwords do not match</p>';
      }
      else{   
        $sql = "SELECT * FROM users where (user_name='$username')or(email='$email')";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        echo '<p style="text-align: center;">Username or Email already exists!</p>';
        }
        else{
          $sql = "INSERT INTO users (user_name,email,password) VALUES ('$username','$email','$password')";
          $conn->query($sql) ;
          echo '<script type="text/javascript">
          alert("Account Created!");
          </script>';
          header('Location: login.php');
        }
      } 
    } 
    ?>
    <!-- Sign-up form -->
    <div class="signup-page">
      <div class="signup-statement">
        <p>Sign up today for free!</p>
      </div>
      <form id="signup-form" method="post">
        <input type="text" class ="signup-item" placeholder="Username" name="username">
        <input type="text" class="signup-item" placeholder="Email Address" name="email">
        <input type="text" class="signup-item" placeholder="Password" name="password">
        <input type="text" class="signup-item" placeholder="Confirm Password" name="confpassword">
        <div id="signup-action">
          <button id="signup-btn" name="submit">Sign up</button>
        </div>
      </form>
    </div>
  </body>
  </html>
