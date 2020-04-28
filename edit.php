<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" type="text/css" href="css/profilestyle.css" >
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>Add Note!</title>
    </head>
  <body>
<?php
  $conn = new mysqli("localhost", "root", "","DearDiary");
  $id=$_GET['id'];
  $sql="SELECT * FROM user_diary where note_id='$id'";
  $res=$conn->query($sql);
  $row = $res->fetch_assoc();
  $note = $row['note'];
  $user_id=$row['user_id'];
  if(isset($_POST["submit"])){
    $sql="DELETE FROM user_diary where note_id='$id'";
    $result=$conn->query($sql) ;
    $new_note = $_POST['new_note'];
    date_default_timezone_set('Asia/Kolkata'); 
    $now = date("Y-m-d H:i:s");
    $sql="INSERT INTO user_diary (user_id,note,date_time) VALUES ('$user_id','$new_note','$now')";
    $result=$conn->query($sql) ;
    if($result){
      $conn -> close();
      header('Location: profile.php');
    }
    else {
      $conn -> close();
    echo "ERROR";
    }
  }
  ?>
<div id="form-section">
  	<form id="new_note" method="post">
  		<textarea type="text" name="new_note" id="new-note-input"><?echo $note?></textarea>
  		<button  id="form-submit" name="submit">Submit!</button>
  	</form>	
  </div>
</body>
<script type="text/javascript">
  $(document).ready(function(){
    $("#form-section").css("display","block");
  });
</script>
</html>
