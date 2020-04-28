<!-- Deleting a record from diary-->
<?php
$conn = new mysqli("localhost", "root", "","DearDiary");
$id=$_GET['id'];
$sql="DELETE FROM user_diary WHERE note_id='$id'";
$result=$conn->query($sql) ;
if($result){
	$conn -> close();
	header('Location: profile.php');
}
else {
	$conn -> close();
echo "ERROR";
}
?>
