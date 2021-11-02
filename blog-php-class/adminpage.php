<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "php_blog";
$conn = new mysqli($server, $username, $password, $dbname);
// if ($conn->connect_error === true) {
//     die('Unable to connect');
// }
// $password = md5('admin');
// $sql = "INSERT INTO admin(name, email, password) 
// values('Toheeb', 'admin@blog.com', '$password')";
// if (!$conn->query($sql)) {
//     echo " Not successful" . mysqli_error($conn);
// }

$errors = [];
if (isset($_POST['submit'])) {
    if (empty($_POST['email'])) {
        $errors['email_error'] = 'Email is required';
    } else {
        $email = $_POST['email'];
    }
    if (empty($_POST['password'])) {
        $errors['password_error'] = 'password is required';
    } else {
        $email = $_POST['password'];
    }
    if (!$errors) {
        $result = $conn->query("SELECT email from admin WHERE email='$email' AND password='$password'");
        if (mysqli_num_rows($result) == 1) {
            $_SESSION['email'] = $email;
            header('location:admin.php');
        } else {
            $errors['result_error'] = "Ivalid details";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <?php
                if ($errors) {
                    echo "<div class='alert alert-danger'>";
                    foreach ($errors as $error) {
                        echo $error . "<br/>";
                    }
                    echo "</div>";
                }

                ?>
                <form action="adminpage.php" method="post">
                    <div class="form-group">
                        <label for="email">Email address:</label>
                        <input type="email" class="form-control" placeholder="Enter email" name="email">
                        <span style="color: red;">
                            <?php if (array_key_exists('email_error', $errors)) {
                                echo $errors['email_error'];
                            } ?>
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input type="password" class="form-control" placeholder="Enter password" name="password">
                        <span style="color: red;">
                            <?php if (array_key_exists('password_error', $errors)) {
                                echo $errors['password_error'];
                            } ?>
                        </span>
                    </div>
                    <button type="submit" class="btn btn-primary" name='submit'>Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>