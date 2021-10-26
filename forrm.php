<?php
require_once "db.php";
function namevalidation($name)
{
  if (empty($name)) {
    return "Your Fullname is required";
  } else {
    return true;
  }
}
$phone = $fullname = $email
  = $uname = $password
  = $uname_error = $success
  = $confirmpassword = "";
$errors = [];
if (isset($_POST['submit']) && isset($_POST['fulname']) && $_SERVER["REQUEST_METHOD"] == "POST") {

  if (!namevalidation($_POST['fulname'])) {
    $fullname_err =  namevalidation($_POST['fulname']);
  } elseif (str_word_count($_POST['fulname']) < 2) {
    $errors['fullname_err'] = "Please enter your fullname";
  } else {
    $fullname = $_POST['fulname'];
  }
  if (empty($_POST['uname'])) {
    $errors['uname'] = "User name is required";
  } else {
    $uname = $_POST['uname'];
  }
  if (empty($_POST['password'])) {
    $errors['password'] = "Password is required";
  } else {
    $password = $_POST['password'];
  }
  if (empty($_POST['email'])) {
    $errors['email'] = "Email is required";
  } else {
    $select = mysqli_query($db_connect, "select email from reg where email='" . $_POST['email'] . "'");
    if (mysqli_num_rows($select) > 0) {
      $errors['email'] = "Email already exist";
    }
    $email = $_POST['email'];
  }
  if (empty($_POST['phone'])) {
    $errors['phone'] = "Phone is required";
  } else {
    $select = mysqli_query($db_connect, "select phone from reg where phone='" . $_POST['phone'] . "'");
    if (mysqli_num_rows($select) > 0) {
      $errors['phone'] = "Phone already exist";
    }
    $phone = $_POST['phone'];
  }
  if (empty($_POST['confirmpassword'])) {
    $errors['confirmpassword'] = "Please confirm your password";
  } else {
    $confirmpassword = $_POST['confirmpassword'];
  }
  if (strcmp($confirmpassword, $password) != 0) {
    $errors['passwordconfirm_err'] = "Your password doesn't matched";
  }
  if (!$errors) {
    $password = md5($password);
    if (mysqli_query($db_connect, "INSERT INTO reg(name, phone, email, password)
    values('$fullname', '$phone', '$email', '$password')")) {
      $success = "Your registration has been successfull";
    } else {
      $errors['dberror'] = "Something went wrong";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>PHP FORM</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <div class="container">

    <div class="row">
      <div class="col-md-6 offset-md-3">
        <?php
        if (isset($_POST['submit']) && !$errors && $success) {
          echo "<div class='alert alert-success'>
           $success;
          </div>";
        }

        if ($errors) {      ?>
          <div class="alert alert-danger">
            <strong>Something went wrong</strong> <br />
            <?php
            foreach ($errors as $error) {
              echo $error . "<br/>";
            }
            ?>
          </div>
        <?php } ?>
        <h2>PHP Form </h2>
        <form action="forrm.php" method="post" enctype="multipart/form-data">
          <div class="mb-3 mt-3">
            <label for="file" class="form-label">Upload Picture:</label>
            <input type="file" class="form-control" name="photo">
          </div>
          <div class="form-group"> <label for="name"> Full Name:</label>
            <input type="text" value="<?php echo $fullname ?>" class="form-control" placeholder="Enter Name" name="fulname" value="<?php echo $fullname ?>">
            <span style="color:red;"> <?php
                                      if (array_key_exists('fullname', $errors)) echo $errors['fullname']; ?> </span>
          </div>
          <div class="form-group">
            <label for="uname">uname:</label>
            <input value="<?php echo $uname ?>" type="text" class="form-control <?php if (array_key_exists('uname', $errors)) echo  "is-invalid"; ?> " id="uname" placeholder="Enter uname" name="uname" value="<?php echo $uname ?>">
            <span style="color:red;"> <?php echo $uname_error ?> </span>

          </div>
          <div class="form-group"> <label for="email">Email address:</label>
            <input type="text" class="form-control" placeholder="Enter email" name="email" value="<?php echo $email ?>">
          </div>
          <div class="form-group"> <label for="email">Phone:</label>
            <input type="tel" class="form-control" placeholder="Enter Phone" name="phone" value="<?php echo $phone ?>">
          </div>
          <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" placeholder="Enter password" name="password">
          </div>
          <div class="form-group">
            <label for="pwd"> Confirm Password:</label>
            <input type="password" class="form-control" placeholder="Confirm password" name="confirmpassword">
          </div>
          <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>


      </div>

    </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</body>

</html>