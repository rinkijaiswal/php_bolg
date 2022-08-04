<?php
session_start();
include('db.php');
include('head.php');
$email = $_SESSION['user'];
$isLoggedIn = $_SESSION['isLoggedIn'];

if ($isLoggedIn == 'true') {
    $query = "SELECT * FROM user WHERE email='$email'";
    $data = mysqli_query($conn, $query);
    if ($data) {
        $user = mysqli_fetch_array($data);
    } else {
        echo "error";
    }
} else {
    header('Location: login.php');
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $created = $_POST['created'];


    $filename = $_FILES['blog_image']['name'];
    $tempname = $_FILES['blog_image']['tmp_name'];
    $folder = "blog/" . $filename;
    move_uploaded_file($tempname, $folder);


    $sql = "INSERT INTO blog VALUES('', '$name', '$email', '$filename', '$title', '$description', '$created')";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        header('Location: index.php');
    } else {
        echo "error occurred";
    }
}
?>
<body>
<div class="container mt-5">
    <h3>User details<h3>
            <div class="row">
                <div class="col-4">
                    <img src="./<?= $user['profile'] ?>" width="200px" height="200px" />
                    <h3>Name: <?= $user['name'] ?></h3>
                    <p>Phone-<?= $user['phone'] ?></p>
                    <p>DOB: <?= $user['date'] . '/' . $user['month'] . '/' . $user['year'] ?> </p>
                    <p>About-<?= $user['about'] ?></p>
                </div>
                <div class="col-8">
                    <div class="row mt-2">
                        <h3>Create New Post</h3>
                        <form action="" method="POST" class="mt-3" enctype="multipart/form-data">
                            <input class="form-control" type="file" name="blog_image" />
                            <input type="title" name="title" placeholder="Enter title" class="form-control mt-2" />
                            <input type="description" name="description" placeholder="Enter description" class="form-control mt-2" />
                            <input type="hidden" name="email" value="<?= $user['email'] ?>" />
                            <input type="hidden" name="created" value="<?= date('d/m/y') ?>" />
                            <input type="hidden" name="name" value="<?= $user['name'] ?>" />
                            <button type="submit" name="submit" class="btn btn-primary mt-2">Submit</button>
                        </form>
                    </div>
                    <div class="row mt-4">
                        <h3>Users Blog</h3>
                        <table>
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>CreatedAt</th>
                                <th colspan="2" >Action</th>
                            </tr>
                            <?php
                            $query = "SELECT * FROM blog WHERE email='$email'";
                            $data = mysqli_query($conn, $query);
                            $total = mysqli_num_rows($data);
                            if ($total != 0) {
                            while ($result = mysqli_fetch_array($data)) { 
                             ?>
                            <tr>
                                <td><img class="mt-2" src="./blog/<?= $result['blog_image'] ?>" height="100em" width="100em" /></td>
                                <td><p class="lead mt-2"><?= $result['title'] ?></p></td>
                                <td><p class="text-muted mt-2"><?= $result['description'] ?></p></td>
                                <td><p><?= $result['created'] ?></p></td>
                                <td><a class="btn btn-primary" href="update.php?id=<?= $result['blog_id'] ?>" >Update</a>
                                <a class="btn btn-danger" href="delete.php?id=<?= $result['blog_id'] ?>" >Delete</td>
                            <tr>
                            <?php 
                            }
                        } else {
                            echo "No records found";
                        }
                             ?>
                        </table>
                    </div>
                </div>
            </div>
</div>
</body>

