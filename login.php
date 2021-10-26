<?php
session_start();
require "db.php";
$errors = [];
if (isset($_POST['submit'])) {
    if (empty($_POST['email'])) {
        $errors['email'] = "Your Fullname is required";
    } else {
        $email = $_POST['email'];
    }
    if (empty($_POST['password'])) {
        $errors['password'] = "Your password is required";
    } else {

        $password = md5($_POST['password']);
    }
    if (!$errors) {
        if ($select = mysqli_query($db_connect, "SELECT email, password from reg  WHERE email='$email' AND password='$password'")) {
            if (mysqli_num_rows($select) > 0) {
                $_SESSION['email'] = $email;
                header('location:dashboard.php');
            } else {
                $errors['login_error'] = "Invalid details";
            }
            // $result = mysqli_fetch_array($select);

            // if ($password == $result['password'] && $email == $result['email']) {
            //     echo "correct login";
            // } else {
            //     $errors['login'] = "Invalid details";
            // }
        } else {
            echo "results not selected" . mysqli_error($db_connect);
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>User Login</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <?php
                if (isset($_POST['submit'])) {
                    if (!$errors) {
                        echo  "<div class='alert aler-success'>
                          Login in....
                    </div>";
                    } else { ?>
                        <div class='alert alert-danger'>
                            <strong> Something went wrong</strong> <br />
                    <?php
                        foreach ($errors as $error) {
                            echo "$error <br/>";
                        }
                        echo "</div>";
                    }
                }
                    ?>

                    <form action="login.php" method="post" enctype="multipart/form-data">
                   
                        <div class="mb-3 mt-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="pwd" class="form-label">Password:</label>
                            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
                        </div>
                        <div class="form-check mb-3">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="remember"> Remember me
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Login</button>
                    </form>
                        </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>