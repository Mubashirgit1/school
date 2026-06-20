<?php
include("../conn.php");
$flag['code']=0;

//$name['namee']="";
?>
<?php

//$teacher_cnic=$_POST['teacher_cnic'];

 $result = array();


$info=mysqli_query($conn,"SELECT leaves.`id` AS leave_id, leaves.`user_id` AS leave_user_id, leaves.`leave_date_added`, leaves.`student_leave_for_date`, leaves.`leave_reason`, leaves.`leave_day`, leaves.`role` , teachers.`id`, teachers.`name`, teachers.`email`, teachers.`password`, teachers.`address`, teachers.`dob`, teachers.`designation`, teachers.`sex`, teachers.`phone`, teachers.`image`, teachers.`is_active`, teachers.`teacher_type_id` FROM `leaves` INNER JOIN teachers ON 
  teachers.`id`=leaves.`user_id` and leaves.`role`='teacher'");


while($show=mysqli_fetch_array($info)){
	// $teacher_name=$show['name'];

	$name=$show['name'];
	
	$phone=$show['phone'];
	
	$image=$show['image'];

	$leave_id=$show['leave_id'];

	$leave_user_id=$show['leave_user_id'];

	$leave_date_added=$show['leave_date_added'];

	$leave_reason=$show['leave_reason'];

	$leave_days=$show['leave_day'];

	 array_push($result,array(
 "name"=>$name,
 "phone"=>$phone,
 "image"=>$image,
 "leave_id"=>$leave_id,
 "leave_user_id"=>$leave_user_id,
 "leave_date_added"=>$leave_date_added,
"leave_reason"=>$leave_reason,
"leave_days"=>$leave_days
 )
 );


}



echo json_encode(array("teacher_leave_request"=>$result));	
?>
