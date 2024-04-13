<?php include "connect-DB.php";

 header("Access-Control-Allow-Origin: *");
 header("Access-Control-Allow-Headers: *");

$sql = 'SELECT fldPhishingContent FROM tblPhishingSurvey';

$statement = $pdo->prepare($sql);
$statement->execute();

$records = $statement->fetchAll();

$output = "[";
foreach($records as $record){
    $output .= '"' . $record . '",';
}
$output = rtrim($output, ',');
$output .= ']';

print $output;

?>