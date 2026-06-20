<?php
include("../conn.php");
$flag['code']=0;

//$name['namee']="";
?>
<?php

$class_id=$_POST['class_id'];
$section_id=$_POST['section_id'];

 $result = array();


// SELECT `students`.`id`, `students`.`roll_no`, `admission_date`, `students`.`firstname` AS name, `lastname`, `rte`, `students`.`image`, `students`.`mobileno` AS phone FROM `students` 


$info=mysqli_query($conn,"SELECT leaves.`id` AS leave_id, leaves.`user_id` AS leave_user_id, leaves.`leave_date_added`, leaves.`student_leave_for_date`, leaves.`leave_reason`, leaves.`leave_day`, leaves.`role` , `students`.`id`, `students`.`roll_no`, `admission_date`, `students`.`firstname` AS name, `lastname`, `rte`, `students`.`image`, `students`.`mobileno` AS phone FROM `leaves` INNER JOIN `students` ON 
  `students`.`id`=leaves.`user_id` and leaves.`role`='parent' and leaves.`class_id`='$class_id' and leaves.`section_id`='$section_id'");


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



echo json_encode(array("student_leave_request"=>$result));	
?>
