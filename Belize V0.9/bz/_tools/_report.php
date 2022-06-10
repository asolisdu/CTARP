<?php
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Content-Type: application/json');

$id = $_GET['id'];


$servername = "localhost";
$username = "tarp_admin";
$password = "tarp_pass";
$dbname = "tarp_db";

// $servername = "localhost";
// $username = "root";
// $password = "mysql";
// $dbname = "tarp_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$data = array(); //el registro maestro

//assessment ====
$query="select * from assessments where id='".$id."' limit 1";
//echo $q_solicitud;
$result = $conn->query($query);
//Loop through all our records a$emparray[] = $row;nd add them to our array
while($row =mysqli_fetch_assoc($result)) {
    $data['assessment'][] = array_map('utf8_encode',$row);     
}

//loan_section =====
$query="select * from loan_section where id=".$data['assessment'][0]['loan_section'];
$result = $conn->query($query);
while($row =mysqli_fetch_assoc($result)) {
    $data['loan_section'][] = array_map('utf8_encode',$row);     
}

//loan_purpose =====
$query="select * from loan_purposes where id=".$data['assessment'][0]['loan_purpose'];
$result = $conn->query($query);
while($row =mysqli_fetch_assoc($result)) {
    $data['loan_purpose'][] = array_map('utf8_encode',$row);     
}

//user =====
$query="select id,first_names,last_names, email from users  where id=".$data['assessment'][0]['user_id'];
$result = $conn->query($query);
while($row =mysqli_fetch_assoc($result)) {
    $data['user'][] = array_map('utf8_encode',$row);     
}

//answers =====
$sum_score = 0;
$sum_q=0;
$sum_max =0; $max1 = 0; $max2=0; $max3=0;
$sum_min =0; $min1 = 0; $min2=0; $min3=0;
$query="select answers.*,
questions.title,
questions.related,
questions.type as question_type,
questions.placeholder,
questions.questions,
questions.scores,
questions.recommendation_by_score,
questions.recommendation_score,
questions.group
from answers,questions where assessment_id=".$data['assessment'][0]['id'] ." and question_id=questions.id
  and (score>0  or questions.type=9) order by section_id,question_id";
//echo $query.'<hr>';
$result = $conn->query($query);
while($row =mysqli_fetch_assoc($result)) {
    $sum_q=$sum_q+1;
    $datos=explode('|',$row['scores']);
    $floats = array_map('floatval', $datos);
    $sum_max=$sum_max + max($floats);  $sum_min=$sum_min + min($floats); 
    $sum_score = $sum_score + $row['score'];
    if($row['section_id']==1) {$max1=$max1 + max($floats); $min1=$min1 + min($floats); } 
    if($row['section_id']==2) {$max2=$max2 + max($floats); $min2=$min2 + min($floats); } 
    if($row['section_id']==3) {$max3=$max3 + max($floats); $min3=$min3 + min($floats); } 
    $data['answers'][] = array_map('utf8_encode',$row);   
}

//remarks =====
$query="select answers.*,
questions.title,
questions.placeholder,
questions.questions,
questions.scores
from answers,questions where assessment_id=".$data['assessment'][0]['id'] ." and question_id=questions.id 
and recommendations != '' ";
$result = $conn->query($query);
while($row =mysqli_fetch_assoc($result)) {
    $data['remarks'][] = array_map('utf8_encode',$row);     
}

//recommendations =====
$query="select answers.*,
questions.title,
questions.placeholder,
questions.questions,
questions.scores,
questions.recommendation_by_score,
questions.recommendation_score
from answers,questions where assessment_id=".$data['assessment'][0]['id'] ." and question_id=questions.id 
and score >= recommendation_score ";
$result = $conn->query($query);
while($row =mysqli_fetch_assoc($result)) {
    $data['recommendations_by_score'][] = array_map('utf8_encode',$row);     
}

//results =====
$query="select * from results where assessment_id=".$data['assessment'][0]['id']." order by id desc limit 1";
$result = $conn->query($query);
while($row =mysqli_fetch_assoc($result)) {
    $data['last_results'][] = array_map('utf8_encode',$row);     
}


//section_scores =====
$query="select sections.*,sum(score) as section_score from answers,sections
where section_id=sections.id and assessment_id=".$data['assessment'][0]['id']." group by section_id" ;
$result = $conn->query($query);
while($row =mysqli_fetch_assoc($result)) {
    $data['section_scores'][] = array_map('utf8_encode',$row);     
}


$data['scores']['total_questions']=$sum_q;
$data['scores']['score_max']=round($sum_max,1); $data['scores']['max1'] = round($max1,1); $data['scores']['max2'] = round($max2,1); 
$data['scores']['max3'] = round($max3,1);
$data['scores']['score_min']=round($sum_min,1); $data['scores']['min1'] = round($min1,1); $data['scores']['min2'] = round($min2,1); 
$data['scores']['min3'] = round($min3,1);
$data['scores']['assessment_id']=$data['assessment'][0]['id'];
$data['scores']['assessment_score']=round($sum_score,1);
$jsonString = json_encode($data);
echo $jsonString;


//=============================

?>