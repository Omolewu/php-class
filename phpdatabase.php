<?php
$errors = [];
require_once "db.php";

function namevalidation($name)
{
    if (empty($name)) {
        return 'Your name is required';
    } else {
        return true;
    }
}
function phonevalidation($phone)
{
    if (empty($phone)) {
        echo 'Your phone  number is required';
    } elseif (strlen($phone) > 11 || strlen($phone) < 11) {
        echo   "Invalid phone number";
    } else {
        return true;
    }
}

if (isset($_POST['sub']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['name'])) {
        $errors['name_error'] = 'Your name is required';
    } else {
        $name = $_POST['name'];
    }
    if (empty($_POST['phone'])) {
        $errors['phone_error'] = 'Your phone  number is required';
    } elseif (strlen($_POST['phone']) > 11 || strlen($_POST['phone']) < 11) {
        $errors['phone_error'] = "Invalid phone number";
    } else {
        $phone = $_POST['phone'];
    }
    if (isset($_POST['sub']) && !$errors) {
        $insert = "INSERT INTO reg(name, phone) values('$name', '$phone')";
        if (mysqli_query($db_connect, $insert)) {
            $success = "Your details has successfully submitted";
        } else {
            $errors['db_error'] = "Something went wrong";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php Database</title>
</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <?php
                if (isset($_POST['sub']) && !$errors) { ?>
                    <div class="alert alert-success">
                        <?php echo $success; ?>
                    </div>
                <?php }
                if ($errors) { ?>
                    <div class="alert alert-danger">
                        <strong>Something went wrong</strong> <br />
                        <?php
                        foreach ($errors as $error) {
                            echo $error . "<br/>";
                        }
                        ?>
                    </div>
                <?php } ?>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="col-sm-2 col-form-label">Phone Number</label>
                        <input type="text" class="form-control" name="phone">
                    </div>
                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary float-right" value="Registration" name="sub">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>