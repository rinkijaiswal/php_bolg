<?php
include('db.php');
$id = $_GET['id'];
$sql = "DELETE FROM blog WHERE blog_id='$id'";
$query = mysqli_query($conn,$sql);
if($query){
	header('location: user.php');
}else{
	echo "error";
}
?>