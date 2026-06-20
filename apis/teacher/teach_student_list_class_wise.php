<?php
include("../conn.php");
$flag['code']=0;

//$name['namee']="";
?>
<?php

$class_id=$_POST['class_id'];
$section_id=$_POST['section_id'];
// $reject=$_POST['reject'];

 $result = array();

$students=mysqli_query($conn,"SELECT student_session.`id`, student_session.`session_id`, student_session.`student_id`, student_session.`class_id`, student_session.`section_id`, student_session.`route_id`, student_session.`vehroute_id`, student_session.`transport_fees`, student_session.`fees_discount`,student_session.`is_active`, student_session.`created_at`, student_session.`updated_at`, 
students.roll_no , students.`firstname`, students.`image`, students.`gender` 
 FROM `student_session` INNER JOIN students ON  `students`.id=student_session.`student_id` and class_id='$class_id' and section_id='$section_id'");

while($show=mysqli_fetch_array($students)){

array_push($result,array(
 "firstname"=>$show['firstname'],
 "image"=>$show['image'],
 "gender"=>$show['gender'],
 "student_id"=>$show['student_id']

 )
 );


}


echo json_encode(array("student_lists"=>$result));	
?>
