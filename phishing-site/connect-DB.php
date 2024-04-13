<!--connect-DB.php run start-->
<?php
$databaseName = 'ASCHAEF1_labs';
$dsn = 'mysql:host=webdb.uvm.edu;dbname=' . $databaseName;
$username = 'aschaef1_writer';
$password = '52uJqf6dp3Xn';

$pdo = new PDO($dsn, $username, $password);
?>
<!-- connection-DB.php run end-->