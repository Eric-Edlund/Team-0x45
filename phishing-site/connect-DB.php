<!--connect-DB.php run start-->
<?php
$databaseName = 'ASCHAEF1_Hackathon';
$dsn = 'mysql:host=webdb.uvm.edu;dbname=' . $databaseName;
$username = 'aschaef1_writer';
$password = 'Yg,7mn,C/zK1O9+fj{P7';

$pdo = new PDO($dsn, $username, $password);
?>
<!-- connection-DB.php run end-->