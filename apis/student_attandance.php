<?php
include("conn.php");
$flag['code']=0;
 $result = array();
//$name['namee']="";
?>
<?php
$student_id=$_POST['student_id'];
$date=$_POST['date'];
$stu_edu_info=mysqli_query($conn,"SELECT `id`, `session_id`, `student_id`, `class_id`, `section_id`, `route_id`, `vehroute_id`, `transport_fees`, `fees_discount`, `is_active`, `created_at`, `updated_at` FROM `student_session` WHERE student_id='$student_id'");


while($ok=mysqli_fetch_array($stu_edu_info)){
$session_id=$ok['session_id'];
}


//////Number of absent 

$num_absent=mysqli_query($conn,"SELECT attendence_type.type FROM `student_attendences` INNER JOIN attendence_type ON attendence_type.id='4' where  student_attendences.`student_session_id`='$session_id'");

$num_ab=mysqli_num_rows($num_absent);


////End of number of Absents

$atta=mysqli_query($conn,"SELECT attendence_type.type FROM `student_attendences` INNER JOIN attendence_type ON attendence_type.id=student_attendences.attendence_type_id where  student_attendences.`student_session_id`='$session_id' and student_attendences.date='$date'");






while($ty=mysqli_fetch_array($atta)){
	$type=$ty['type'];
}

$num=mysqli_num_rows($atta);


 array_push($result,array(
"type"=>$type,
"num"=>$num,
"num_absent"=>$num_ab
 )
 );

 
echo json_encode(array("attandance"=>$result));	
?>
