<?php
include("../conn.php");
$flag['code']=0;
$result = array();
//$name['namee']="";
?>
<?php
$incharge_id=$_POST['incharge_id'];

$get_class_info=mysqli_query($conn,"SELECT `id`, `class_id`, `section_id`, `is_active`, `class_incharge_teacher_id`, `created_at`, `updated_at` FROM `class_sections` WHERE class_incharge_teacher_id='$incharge_id'");

while($show=mysqli_fetch_array($get_class_info)){
	$class_id=$show['class_id'];
	$section_id=$show['section_id'];
}

$sho=mysqli_query($conn,"SELECT `student_session`.`id`, `student_session`.`session_id`, `student_session`.`student_id`, `student_session`.`class_id`, `student_session`.`section_id`, `student_session`.`route_id`, `student_session`.`vehroute_id`, `student_session`.`transport_fees`, `student_session`.`fees_discount`, `student_session`.`is_active`, `student_session`.`created_at`, `student_session`.`updated_at`,`students`.`id` AS student_id, `students`.`admission_no`, `students`.`roll_no`, `students`.`admission_date`, `students`.`firstname` FROM `student_session` INNER JOIN `students` ON `students`.`id`=`student_session`.`student_id` and `student_session`.`class_id`='$class_id' and `student_session`.`section_id`='$section_id'");

if(!$sho){}
//else{
$flag['code']=1;	   
$num=mysqli_num_rows($sho);
 
 while($dis=mysqli_fetch_array($sho)){
 
 array_push($result,array(
 "student_id"=>$dis['student_id'],
 "name"=>$dis['firstname'],
 "roll_no"=>$dis['roll_no']
 )
 );
  }

echo json_encode(array("student_list"=>$result));
?>
