<?php
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Content-Type: application/json');

$origin = $_SERVER['REMOTE_ADDR'];
$metodo = $_SERVER['REQUEST_METHOD'];

if ($metodo !='POST') { echo 'Bad Request. Post Expected...UCG '.date('c'); die();}

//dbconnection
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "tarp_db";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection</h3>
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
////// db connection


$txt=file_get_contents("php://input");
$json = json_decode($txt);


$myfile = fopen("./posts/assessment_".$json->assessment_id.".json", "w") or die("Unable to open file!");

//$line='';
//foreach ($json->answers as $item) {
//    $line = $line . $item->question_id .'|'  . $item->response .'|'  . $item->score . chr(10) ;
// }

fwrite($myfile, $txt);
fclose($myfile);


//log de results
$query= "insert INTO `results` ( `assessment_id`, `answers`)  VALUES ( ".$json->assessment_id.",'".$txt."')";
$result = $conn->query($query);

//----------------- recorrer la data
$i = 0; $sum_score = 0; $valid_answers=0;
foreach ($json->answers as $item) {
  $m_score = $item->score;
  if (is_numeric($m_score)) $valid_answers = $valid_answers + 1;
  $v_score = (is_numeric($m_score) ? $m_score*1.00 : 0);
  $query= "REPLACE INTO `answers` ( `question_id`, `response`, `score`, `assessment_id`, `recommendations`, `weight`, `section_id`)  VALUES
    ( ".$item->question_id.",'".$item->value."',".$v_score .",".$json->assessment_id.",'".$item->recommendations."',"."0".",".$item->section_id.") ";
   //echo ($i+1).' ' . $query;
    $result = $conn->query($query);
    $sum_score = $sum_score + $v_score;
    $i++;  

 } //endfor



 //update assessment score
//$query= "update  `assessments` set total_score = ". round($sum_score,1) . " where assessment_id=".$json->assessment_id.")";
//$result = $conn->query($query);


//respuesta

$output = [];
//$output['url'] = $url;
$output['assessment_id'] = $json->assessment_id;
$output['answers'] = $i;
$output['valid_answers'] = $valid_answers;
$output['total_score'] = round($sum_score,1);
$output['origin'] = $origin;
$output['posted'] = date('c');
$output['method'] = $metodo;

$newJsonString = json_encode($output);
 echo $newJsonString;


?>