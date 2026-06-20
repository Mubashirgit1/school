<?php
include("../conn.php");
$flag['code']=0;
 $result = array();
//$name['namee']="";
?>
<?php

// $student_id=$_POST['student_id'];
$student_id=$_POST['student_id'];

$exam_result=mysqli_query($conn,"SELECT `id`, `attendence`, `exam_schedule_id`, `student_id`, `get_marks`, `note`, `is_active`, `created_at`, `updated_at` FROM `exam_results` WHERE student_id='$student_id'");

while($result_get=mysqli_fetch_array($exam_result)){
	$id=$result_get['id'];
	$exam_schedule_id=$result_get['exam_schedule_id'];

	$get_marks=$result_get['get_marks'];

	$note=$result_get['note'];

 array_push($result,array(
"id"=>$id,
"exam_schedule_id"=>$exam_schedule_id,
"get_marks"=>$get_marks,
"note"=>$note
 )
 );




}








echo json_encode(array("student_result"=>$result));	
?>

