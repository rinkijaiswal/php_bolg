<?php
include('db.php');
include('head.php');
if (isset($_POST['submit'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$phone = $_POST['phone'];
	$date = $_POST['date'];
	$month = $_POST['month'];
	$year = $_POST['year'];
	$about = $_POST['about'];

	$filename = $_FILES['profile']['name'];
	$tempname = $_FILES['profile']['tmp_name'];
	$folder = "user/" . $filename;
	move_uploaded_file($tempname, $folder);


	$sql = "INSERT INTO user VALUES('','$name','$email','$password','$phone','$folder','$date','$month','$year','$about')";
	$query = mysqli_query($conn, $sql);
	if ($query) {
		header('Location: login.php');
	} else {
		echo "error occurred";
	}
}
?>
<html>
<div class="container mt-5">
	<h3>Signup Form</h3>
	<form action="" method="POST" class="mt-5" enctype="multipart/form-data">
		<input type="text" name="name" placeholder="Enter Name" class="form-control mt-2" />
		<input type="email" name="email" placeholder="Enter Email" class="form-control mt-2" />
		<input type="password" name="password" placeholder="Enter password" class="form-control mt-2" />
		<input type="text" name="phone" placeholder="Enter Phone" class="form-control mt-2" />
		<input type="file" name="profile" class="form-control mt-2" />
		<input type="text" name="date" placeholder="Enter date" class="form-control mt-2" />
		<input type="text" name="month" placeholder="Enter Month" class="form-control mt-2" />
		<input type="text" name="year" placeholder="Enter Year" class="form-control mt-2" />
		<input type="text" name="about" placeholder="Enter about Yourself" class="form-control mt-2" />
		<button type="submit" name="submit" class="btn btn-primary mt-2">Submit</button>
	</form>
</div>

</html>