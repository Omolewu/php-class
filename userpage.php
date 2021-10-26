<?php
require_once "db.php";

$results = mysqli_query($db_connect, "SELECT * FROM reg");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Users</title>
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
                        while ($da_result = mysqli_fetch_array($results)) {
                            $names = $da_result['name'];
                            $phone = $da_result['phone'];
                            $date_created = $da_result['created_at'];
                            echo "<tr>
                                <td>$names </td>
                                <td> $phone </td>
                                <td>$date_created </td>
                                <td><button class='btn btn-danger'>Delete</button> </td>
                            </tr>";
                        } ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>