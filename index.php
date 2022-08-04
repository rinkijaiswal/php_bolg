<?php
session_start();
include("db.php");
include("head.php");

$email = $_SESSION['user'];
$isLoggedIn = $_SESSION['isLoggedIn'];

if ($isLoggedIn != 'true') {
	header('Location: login.php');
}

$query = "SELECT * FROM user WHERE email='$email'";
$data = mysqli_query($conn, $query);
if ($data) {
	$user = mysqli_fetch_array($data);
} else {
	echo "error";
}

if (isset($_POST['like'])) {
	$post_id = $_POST['blog_id'];
	$user_id = $_POST['user_id'];
	$like = "INSERT INTO is_liked VALUES('','$user_id','$post_id','true')";
	$q = mysqli_query($conn, $like);
	if($q){
		header('Location: user.php');
	}else{
		echo "error occurred";
	}
}

?>

<body>
	<div class="container mt-5">
		<div class="row">
			<div class="col-7">
				<?php
				$query = "SELECT * FROM blog WHERE email !='$email'";
				$data = mysqli_query($conn, $query);
				$total = mysqli_num_rows($data);
				if ($total != 0) {
					while ($result = mysqli_fetch_array($data)) {
						$button = "like";
				?>
						<div class="row px-2 py-2">
							<div class="card" style="width:18rem">
								<div class="card-header">
									<img class="rounded-circle" src="./<?= $user['profile'] ?>" height="50px" width="50px" />&nbsp;&nbsp;<?= $result['name'] ?>
								</div>
								<img class="mt-2 card-img-top" src="./blog/<?= $result['blog_image'] ?>" />
								<div class="card-body" style="padding: 0;">
									<span style="font-size: 1.2em;"><?= $result['title'] ?></span>
									<form class="mt-2" style="float: right;" method="POST" action="">
										<input type="hidden" name="blog_id" value="<?= $result['blog_id'] ?>"/>
										<input type="hidden" name="user_id" value="<?= $user['user_id'] ?>"/>
										<input type="submit" id="like" name="like" value="<?= $button ?>" class="btn btn-primary" />
									</form>
									<p class="text-muted mt-4 card-text"><?= $result['description'] ?></p>
									<p style="font-size: 1em;" class="lead"><?= $result['created'] ?></p>

									<!-- yha comments show honge -->

									<hr />
									<div class="row">
										<form method="POST" action="">
											<input type="hidden" name="blog_id" value="<?= $result['blog_id'] ?>" />
											<input placeholder="Add Comment ..." style="max-width:12rem;display:inline-block;border:none;" name="comment" type="text" class="form-control" />
											<button class="btn" type="submit">post</button>
										</form>
									</div>
								</div>
							</div>
						</div>
						<hr />
				<?php
					}
				} else {
					echo "No records found";
				}
				?>
			</div>
			<di class="col-5">
				<?php
				$id = $user['user_id'];
				$query = "SELECT * FROM user WHERE user_id!='$id'";
				$data = mysqli_query($conn, $query);
				$total = mysqli_num_rows($data);
				if ($total != 0) {
					while ($result = mysqli_fetch_array($data)) {
						$button1="follow";
						if (isset($_POST['follow'])){
							$button1='unfollow';
						}
				?>
					<div class="row py-2">
								<div class="card px-5 py-5">
									<div style="height: 20rem;" class="mb-2">
										<img height="100%" width="100%" class="mt-2 card-img-top" src="./<?= $result['profile'] ?>" />
									</div>
									<div class="card-body" style="padding:0;">
										<span style="font-size: 1.2em;"><?= $result['name'] ?></span>
										<form class="mt-2" style="float:right;" method="POST" action="">
											<input type="submit" id="follow" name="follow" value="<?= $button1 ?>" class="btn btn-primary" />
										</form>
										<p class="text-muted mt-4 card-text"><?= $result['description'] ?></p>
										<p style="font-size: 1em;" class="lead"><?= $result['created'] ?></p>
									</div>
								</div>
					</div>
						<?php
						}
					} else {
						echo "No records found";
					}
						?>
							</div>



					</div>
		</div>
	</div>
</body>