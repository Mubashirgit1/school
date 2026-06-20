<?php
include("../conn.php");
$flag['code']=0;
 $result = array();
//$name['namee']="";
?>
<?php
$student_id=$_POST['student_id'];
$date=$_POST['date'];
////Query to get class ID etc....

$stu_edu_info=mysqli_query($conn,"SELECT `id`, `session_id`, `student_id`, `class_id`, `section_id`, `route_id`, `vehroute_id`, `transport_fees`, `fees_discount`, `is_active`, `created_at`, `updated_at` FROM `student_session` WHERE student_id='$student_id'");


while($ok=mysqli_fetch_array($stu_edu_info)){
$class_id=$ok['class_id'];
$section_id=$ok['section_id'];
$session_id=$ok['session_id'];
}

////end class id and much more //.........



$exam=mysqli_query($conn,"SELECT * FROM exams INNER JOIN (SELECT exam_schedules.*,teacher_subjects.class_id,teacher_subjects.class_name,teacher_subjects.subject_id ,teacher_subjects.section_id,teacher_subjects.section_name FROM `exam_schedules` INNER JOIN (SELECT teacher_subjects.*,classes.id as `class_id`,classes.class as `class_name` ,sections.id as `section_id`,sections.section as `section_name` FROM `class_sections`  
INNER JOIN teacher_subjects on teacher_subjects.class_section_id=class_sections.id
INNER JOIN classes on classes.id=class_sections.class_id
INNER JOIN sections on sections.id=class_sections.section_id
WHERE class_sections.class_id ='$class_id' and class_sections.section_id='$section_id' and teacher_subjects.session_id='$session_id') as teacher_subjects on teacher_subjects.id=teacher_subject_id group by exam_schedules.exam_id) as exam_schedules on exams.id=exam_schedules.exam_id");



$exam_num=mysqli_num_rows($exam);

while($exam_detail=mysqli_fetch_array($exam)){
	$id=$exam_detail['id'];
	
	$note=$exam_detail['note'];

	$is_active=$exam_detail['is_active'];

	$date_of_exam=$exam_detail['date_of_exam'];

	$start_to=$exam_detail['start_to'];

	$end_from=$exam_detail['end_from'];

	$room_no=$exam_detail['room_no'];

	$full_marks=$exam_detail['full_marks'];

	$passing_marks=$exam_detail['passing_marks'];

	$class_name=$exam_detail['class_name'];
	
	$sub_id=$exam_detail['subject_id'];

$sub=mysqli_query($conn,"SELECT `id`, `name`, `code`, `type`, `is_active`, `created_at`, `updated_at` FROM `subjects` WHERE id='$sub_id'");

while($sub_info=mysqli_fetch_array($sub)){
	$sub_name=$sub_info['name'];
	$sub_code=$sub_info['code'];
	$sub_type=$sub_info['type'];
}


///code to create json Array.. 

array_push($result,array(
"id"=>$id,
"note"=>$note,
"is_active"=>$is_active,
"date_of_exam"=>$date_of_exam,
"start_to"=>$start_to,
"end_from"=>$end_from,
"room_no"=>$room_no,
"full_marks"=>$full_marks,
"passing_marks"=>$passing_marks,
"class_name"=>$class_name,
"exam_num"=>$exam_num,
"sub_id"=>$sub_id,
"sub_name"=>$sub_name,
"sub_type"=>$sub_type,
"sub_code"=>$sub_code
 )
 );


///End code to create json array////



}  ///End while loop

echo json_encode(array("exam_detail"=>$result));	











?>