<?php
include('db.php');
include('head.php');
$id = $_GET['id'];
$sql = "SELECT * FROM blog WHERE blog_id='$id'";
$query = mysqli_query($conn,$sql);
$result = mysqli_fetch_array($query);


if(isset($_POST['update'])){
	$blogId = $_POST['id'];
	$title = $_POST['title'];
	$description = $_POST['description'];


	$filename = $_FILES['blog_image']['name'];
    $tempname = $_FILES['blog_image']['tmp_name'];
    $folder = "blog/" . $filename;
    move_uploaded_file($tempname, $folder);

	if($filename == ''){
		$filename = $_POST['originalImage'];
	}


	$sql = "UPDATE blog SET blog_image='$filename', title='$title',description='$description' WHERE blog_id = '$blogId' ";
	$query = mysqli_query($conn,$sql);
	if($query){
		header('location:user.php');
	}else{
		echo "unsuccessfull";
	}
}
?>
<html>
<body>
	<div class="container mt-5">
		<form action="" method="post" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?= $result['blog_id'] ?>">
			<img src="./blog/<?= $result['blog_image'] ?>" height="50" width="50"/>
			<input type="hidden" name="originalImage" value="<?= $result['blog_image'] ?>" />
			<input class="form-control mt-2" type="file" name="blog_image"/>
			<input class="form-control mt-2" type="text" name="title"  value="<?= $result['title'];?>">
			<input class="form-control mt-2" type="text" name="description"  value="<?= $result['description'];?>">
			<button class="btn btn-primary mt-2" type="submit" name="update">update</button>
		</form>
	</div>
</body>
</html>