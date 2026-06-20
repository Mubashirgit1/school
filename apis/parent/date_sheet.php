
<?php
include("../conn.php");
$flag['code']=0;
 $result = array();
//$name['namee']="";
?>
<?php
// $student_id=$_POST['student_id'];
// $date=$_POST['date'];
////Query to get class ID etc....

$student_id=$_POST['student_id'];
$date=$_POST['date'];
$exam_id=$_POST['exam_id'];
////Query to get class ID etc....

$stu_edu_info=mysqli_query($conn,"SELECT `id`, `session_id`, `student_id`, `class_id`, `section_id`, `route_id`, `vehroute_id`, `transport_fees`, `fees_discount`, `is_active`, `created_at`, `updated_at` FROM `student_session` WHERE student_id='$student_id'");


while($ok=mysqli_fetch_array($stu_edu_info)){
$class_id=$ok['class_id'];
$section_id=$ok['section_id'];
$session_id=$ok['session_id'];
}




$date_sheet=mysqli_query($conn,"SELECT exam_schedules.*,subjects.name,subjects.type FROM exam_schedules,teacher_subjects,exams,class_sections,subjects WHERE exam_schedules.teacher_subject_id = teacher_subjects.id and exam_schedules.exam_id =exams.id and class_sections.id =teacher_subjects.class_section_id and teacher_subjects.subject_id=subjects.id and class_sections.class_id ='$class_id' and class_sections.section_id='$section_id' and exam_id ='$exam_id' and exam_schedules.session_id='$session_id'");

while($dis=mysqli_fetch_array($date_sheet)){
$teacher_subject_id=$dis['teacher_subject_id'];
$date_of_exam=$dis['date_of_exam`'];
$start_to=$dis['start_to'];
$end_from=$dis['end_from'];

$room_no=$dis['room_no'];
$full_marks=$dis['full_marks'];
$passing_marks=$dis['passing_marks'];

$sub_info=mysqli_query($conn,"SELECT `teacher_subjects`.`id` AS teacher_subject_id, `teacher_subjects`.`session_id`, `teacher_subjects`.`class_section_id`, `teacher_subjects`.`subject_id`, `teacher_subjects`.`teacher_id`, `teacher_subjects`.`description`, `teacher_subjects`.`is_active`, `teacher_subjects`.`created_at`, `teacher_subjects`.`updated_at`, `subjects`.`id` AS sub_id, `subjects`.`name` AS sub_name, `subjects`.`code` AS sub_code, `subjects`.`type` AS sub_type FROM `teacher_subjects` INNER JOIN `subjects` ON `subjects`.`id`=`teacher_subjects`.`subject_id` and `teacher_subjects`.`subject_id`='$teacher_subject_id'");


while($sub_ok=mysqli_fetch_array($sub_info)){
	$sub_name=$sub_ok['sub_name'];
	$sub_code=$sub_ok['sub_code'];
	$sub_type=$sub_ok['sub_type'];
	// $sub_name=$sub_ok['sub_name'];

/////Arrray

// $start_to=$dis['start_to'];
// $end_from=$dis['end_from'];

// $room_no=$dis['room_no'];
// $full_marks=$dis['full_marks'];
// $passing_marks=$dis['passing_marks'];




array_push($result,array(
"sub_name"=>$sub_name,
"sub_code"=>$sub_code,
"sub_type"=>$sub_type,
"date_of_exam"=>$date_of_exam,
"start_to"=>$start_to,
"end_from"=>$end_from,
"room_no"=>$room_no,
"full_marks"=>$full_marks,
"passing_marks"=>$passing_marks
 )
 );

/////End array................



}





///End code to create json array////



}

////end class id and much more //.........

echo json_encode(array("date_sheet"=>$result));	











?>