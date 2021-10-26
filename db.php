<?php define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('PASSWORD', '');
define('DB_NAME', 'phpclass');

if (!$db_connect = mysqli_connect(DB_SERVER, DB_USERNAME, PASSWORD, DB_NAME)) {
    echo "Unable to connect";
}
?>