<?php
session_start();
include('db.php');
include('head.php');
if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];

	$sql = "SELECT * FROM user WHERE email='$email' AND password='$password'";
	$query = mysqli_query($conn, $sql);
	$total = mysqli_num_rows($query);
	if ($total > 0) {
		$_SESSION['user'] = $email;
		$_SESSION['isLoggedIn'] = 'true';
		header('Location: user.php');
	} else {
		echo "<script>alert('email or password is wrong')</script>";
	}
}
?>
<html>
<div class="container mt-5 px-5">
	<h3>Login Form</h3>
	
	<form action="" method="POST" class="mt-5">
		<input type="email" name="email" placeholder="Enter Email" class="form-control mt-2" />
		<input type="password" name="password" placeholder="Enter password" class="form-control mt-2" />
		<button type="submit" name="submit" class="btn btn-primary mt-2">Submit</button>
	</form>
</div>

</html>