<?php
$conn = new mysqli("localhost", "root", "","DearDiary");
session_destroy();
$conn -> close();
header('Location: index.html');
?>
