<?php
include("../conn.php");
$flag['code']=0;
 $result = array();
?>
<?php

// $student_id=$_POST['student_id'];
$student_id=$_POST['student_id'];
////Code to retrive section id etc.

$info=mysqli_query($conn,"SELECT `id`, `session_id`, `student_id`, `class_id`, `section_id`, `route_id`, `vehroute_id`, `transport_fees`, `fees_discount`, `is_active`, `created_at`, `updated_at` FROM `student_session` where student_id='$student_id'");

while($info_get=mysqli_fetch_array($info)){
 $session_id=$info_get['session_id'];
$class_id=$info_get['class_id'];
 $section_id=$info_get['section_id'];
}



/////end code to retrive section ID..


$about_time=mysqli_query($conn,"SELECT teacher_subjects.*,teachers.name as `teacher_name`, subjects.name,subjects.type FROM `teacher_subjects` INNER JOIN subjects ON teacher_subjects.subject_id = subjects.id INNER JOIN class_sections ON teacher_subjects.class_section_id = class_sections.id INNER JOIN teachers ON teachers.id = teacher_subjects.teacher_id  WHERE class_sections.class_id ='$class_id' and class_sections.section_id='$section_id' and teacher_subjects.session_id='$session_id'");



while($tim=mysqli_fetch_array($about_time)){
 $sub_primary_id=$tim['id'];
 $teacher_name=$tim['teacher_name'];
$sub_type=$tim['type'];
 $sub_name=$tim['name'];


$tim_table_ok=mysqli_query($conn,"SELECT `id`, `teacher_subject_id`, `day_name`, `start_time`, `end_time`, `room_no`, `is_active`, `created_at`, `updated_at` FROM `timetables` WHERE `teacher_subject_id` = '$sub_primary_id'");


while($tim_ok_get=mysqli_fetch_array($tim_table_ok)){
    $day_name=$tim_ok_get['day_name'];
 $start_time=$tim_ok_get['start_time'];
$end_time=$tim_ok_get['end_time'];
$room_no=$tim_ok_get['room_no'];
$is_active=$tim_ok_get['is_active'];
$created_at=$tim_ok_get['created_at'];
$updated_at=$tim_ok_get['updated_at'];

 array_push($result,array(
"teacher_name"=>$teacher_name,
"sub_type"=>$sub_type,
"day_name"=>$day_name,
"start_time"=>$start_time,
"end_time"=>$end_time,
"room_no"=>$room_no,
"is_active"=>$is_active,
"created_at"=>$created_at,
"updated_at"=>$updated_at,
"sub_name"=>$sub_name
 )
 );
  

}




}




echo json_encode(array("parent_time_table"=>$result));	






?>
