<?php
session_start();

require "db.php";
if ($_SESSION['email']) {
    $email = $_SESSION['email'];
    $select = mysqli_query($db_connect, "SELECT * FROM reg WHERE email='$email'");
} else {
    $_SESSION['login'];
    header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6 c offset-md-3">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>Date Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $results = mysqli_fetch_array($select);
                        $names = $results['name'];
                        $phone = $results['phone'];
                        $date_created = $results['created_at'];
                        echo "<tr>
                                <td>$names </td>
                                <td> $phone </td>
                                <td>$date_created </td>
                                <td> $email</td>
                            </tr>";
                        ?>
                    </tbody>   
                </table>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>