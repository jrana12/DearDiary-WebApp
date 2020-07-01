<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  
    <link rel="stylesheet" type="text/css" href="css/profilestyle.css" >

    <title>My Diary!</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>
  <body>
  	<?php
  		$conn = new mysqli("localhost", "root", "","DearDiary");
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
		session_start();
		if (!isset($_SESSION['loggedin'])) {
			header('Location: index.html');
		exit;
		}
		$user_id = $_SESSION['user_id']
	?> 
	<div class="header">
  		<ul class = "header-ul">
  		<li class="header-li"><a href="#">Dear Diary</a></li>
  		<li class="header-li"><?php echo $_SESSION['user_name']?></a></li>
  		<li class="header-li"><?php echo $_SESSION['email']?></a></li>
        <li class="header-li" id="logout"><a href="logout.php">Logout</a></li>
       </ul>
  	</div>

  	<div class="addnote-btn">
  		<button id="add-note">"Add Note"</button>
  	</div>
  	<?php
  		if(isset($_POST["submit"])){
  			$note = $_POST['note'];
  			date_default_timezone_set('Asia/Kolkata'); 
    		$now = date("Y-m-d H:i:s");
  			$sql = "INSERT INTO user_diary (user_id,note,date_time) VALUES ('$user_id','$note','$now')";
          	$result=$conn->query($sql) ;
          	if($result){
          		
          }
          else{
          echo "no";
      }
  		}
  	?>
  	<div id="form-section">
  	<form id="new_note" method="post">
  		<textarea type="text" placeholder="Type here!" name="note" id="new-note-input"></textarea>
    </br>
  		<button  id="form-submit" name="submit">Submit!</button>
  	</form>	
  </div>
  	<div class="notes-section">
  	<?php
        $sql = "SELECT * FROM user_diary where user_id = '$user_id' ORDER BY note_id DESC";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
        $temp = $row['note_id'];
    ?>
        <div id="one-note">
        	<a href="delete.php?id=<? echo $temp; ?>">Delete</a>
        	<a href="edit.php?id=<? echo $temp;?>">Edit</a>
        	<div id="time"><?php echo $row['date_time']?></div>
        	<?php echo '</br><div style="font-size: 16px;">'.$row["note"].'</div>' ?>
        </div>
    <?php
      }
    ?>  
	</div>
  <script type="text/javascript">
    $("#add-note").click(function(){
      $("#form-section").css("display","block");
      $(".notes-section").css("display","none");
    });
    $("#form-submit").click(function(){
      $("#form-section").css("display","none");
      $(".notes-section").css("display","block");
    });
  </script>
  </body>
  </html>
