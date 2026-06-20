<?php
include("conn.php");
$flag['code']=0;

//$name['namee']="";
?>
<?php

// $student_id=$_POST['student_id'];
$student_id=$_POST['student_id'];

$stu_edu_info=mysqli_query($conn,"SELECT `student_session`.`id`, `student_session`.`session_id`, `student_session`.`student_id`, `student_session`.`class_id`, .`student_session`.`section_id`, `student_session`.`route_id`, `student_session`.`vehroute_id`, `student_session`.`transport_fees`, `student_session`.`fees_discount`, `student_session`.`is_active`, `teacher_subjects`.`session_id`,   `teacher_subjects`.`teacher_id`, `teacher_subjects`.`id`, `teacher_subjects`.`id`, `teacher_subjects`.`subject_id`, `teacher_subjects`.`subject_id`  FROM `student_session` 
	INNER JOIN `teacher_subjects` ON `student_session`.`student_id`='$student_id' 
	");



// SELECT `id`, `session_id`, `class_section_id`, `subject_id`, `teacher_id`, `description`, `is_active`, `created_at`, `updated_at` FROM `teacher_subjects` WHERE 1




while($ok=mysqli_fetch_array($stu_edu_info)){

$session_id=$ok['session_id']."<br>";
$class_id=$ok['class_id'];
$section_id=$ok['section_id'];
$teacher_id=$ok['teacher_id'];
$ok['subject_id'];
$sub_id=$ok['subject_id'];
}


$teacher_info=mysqli_query($conn,"SELECT `id`, `name`, `email`, `password`, `address`, `dob`, `designation`, `sex`, `phone`, `image`, `is_active`, `created_at`, `updated_at` FROM `teachers` WHERE id='$teacher_id'");


while($info=mysqli_fetch_array($teacher_info)){
	$teach_name=$info['name'];
}



$sub=mysqli_query($conn,"SELECT `id`, `name`, `code`, `type`, `is_active`, `created_at`, `updated_at` FROM `subjects`");

while($sub_info=mysqli_fetch_array($sub)){
	$sub_name=$sub_info['name'];
	$sub_code=$sub_info['code'];
	$sub_type=$sub_info['type'];
}



$time=mysqli_query($conn,"SELECT `id`, `teacher_subject_id`, `day_name`, `start_time`, `end_time`, `room_no`, `is_active`, `created_at`, `updated_at` FROM `timetables` WHERE teacher_subject_id='$sub_id'");

 $result = array();
 while($dis=mysqli_fetch_array($time)){
 array_push($result,array(
"id"=>$dis['id'],
"teacher_subject_id"=>$dis['teacher_subject_id'],
"day_name"=>$dis['day_name'],
"start_time"=>$dis['start_time'],
"end_time"=>$dis['end_time'],
"room_no"=>$dis['room_no'],
"is_active"=>$dis['is_active'],
"created_at"=>$dis['created_at'],
"updated_at"=>$dis['updated_at'],
"sub_name"=>$sub_name,
"sub_code"=>$sub_code,
"sub_type"=>$sub_type,
"teach_name"=>$teach_name
 )
 );
  }


echo json_encode(array("parent_time_table"=>$result));	
?>
