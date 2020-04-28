<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css">

    <title>Login</title>
    </head>
  <body>
    <?php
      $conn = new mysqli("localhost", "root", "","DearDiary");
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
      if(isset($_POST["submit"])){
      $email = $_POST["email"];
      $password = $_POST["password"];
      if(empty($email)||empty($password)){
        echo '<p style="text-align: center;">Enter all elements</p>';
      }
      else{   
        $sql = "SELECT * FROM users where (email='$email')and(password='$password')";
        $result = $conn->query($sql);
        if ($result->num_rows <1) {
        echo '<p style="text-align: center;">Username or Password Incorrect!</p>';
        }
        else{
          echo '<p style="text-align: center;">Accepted</p>';
          session_start();
          $_SESSION['loggedin'] = TRUE;
          while($row = $result->fetch_assoc()) {
            $_SESSION['user_name'] = $row["user_name"];
            $_SESSION['user_id'] = $row["user_id"];
            $_SESSION['email'] = $row["email"];
          }   
          header('Location: profile.php');
        }
      } 
    } 
    ?>
    <div class="login-page">
      <div id="login-comment">Login</div>
      <form id="login-form" method="post">
        <input type="text" class ="login-item" placeholder="Email" name="email">
        <input type="text" class="login-item" placeholder="Password" name="password">
        <div id="login-action">
          <button id="login-btn" name="submit">Login</button>
        </div>
      </form>
    </div>
  </body>
  </html>
    