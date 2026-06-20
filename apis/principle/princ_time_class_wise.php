<?php
include("../conn.php");
$flag['code']=0;
 $result = array();
//$name['namee']="";
?>
<?php

function break_ok(){
    ///echo "<br>";
}


// $student_id=$_POST['student_id'];
$section_id=$_POST['section_idd'];
$class_id=$_POST['class_id'];

// $section_id=1;
// $class_id=1;


// SELECT class_sections.id, class_sections.class_id, class_sections.section_id
// FROM class_sections
// INNER JOIN teacher_subjects ON class_sections.class_id='$class_id' and class_sections.section_id='$section' and teacher_subjects.class_section_id=class_sections.id;

$class_section_id=mysqli_query($conn,"SELECT class_sections.id, class_sections.class_id, class_sections.section_id
FROM class_sections
INNER JOIN teacher_subjects ON class_sections.class_id='$class_id' and class_sections.section_id='$section_id' and teacher_subjects.class_section_id=class_sections.id");

while($class_section_ok=mysqli_fetch_array($class_section_id)){
$class_section_id_get=$class_section_ok['id'];
break_ok();
}


$teach_sub_id=mysqli_query($conn,"SELECT teacher_subjects.`id`, teacher_subjects.`session_id`, teacher_subjects.`class_section_id`, teacher_subjects.`subject_id`, teacher_subjects.`teacher_id`, teacher_subjects.`description`, teacher_subjects.`is_active`, subjects.`name`, subjects.`code` ,
subjects.`type`, `teachers`.name AS teacher_name  FROM `teacher_subjects`  
 INNER JOIN `subjects` ON teacher_subjects.class_section_id='$class_section_id_get' and teacher_subjects.`subject_id`=subjects.id INNER JOIN `teachers` ON 
 teacher_subjects.`teacher_id`= `teachers`.id");



while($get_teach_sub_id=mysqli_fetch_array($teach_sub_id)){
$id_for_tim_tab=$get_teach_sub_id['id'];
break_ok();
$subject_id=$get_teach_sub_id['subject_id'];
$sub_name=$get_teach_sub_id['name'];
$sub_code=$get_teach_sub_id['code'];
$teacher_name=$get_teach_sub_id['teacher_name'];



$tim_ok=mysqli_query($conn,"SELECT `id`, `teacher_subject_id`, `day_name`, `start_time`, `end_time`, `room_no`, `is_active`, `created_at`, `updated_at` FROM `timetables` WHERE teacher_subject_id='$id_for_tim_tab'");
$num=mysqli_num_rows($tim_ok);
while($ok=mysqli_fetch_array($tim_ok)){
$start_time=$ok['start_time'];
break_ok();
$room_no=$ok['room_no'];
break_ok();
$day=$ok['day_name'];

array_push($result,array(
"room_no"=>$room_no,
"start_time"=>$start_time,
"day"=>$day,
"sub_name"=>$sub_name,
"sub_code"=>$sub_code,
"teacher_name"=>$teacher_name
 ) 
);
    
    
    
    
}


}

// array_push($result,array(
// "id"=>$class_section_id_get
//  ) 
// );





// $teach_sub_id=mysqli_query($conn,"SELECT `id`, `session_id`, `class_section_id`, `subject_id`, `teacher_id`, `description`, `is_active`, `created_at`, `updated_at` FROM `teacher_subjects` WHERE 
//  class_section_id='$class_section_id_get'");

// while($sub_id_from_teacher=mysqli_fetch_array($teach_sub_id)){
// $teacher_sub_id=$sub_id_from_teacher['id'];
// $sub_id=$sub_id_from_teacher['subject_id'];
// }






// $classes_list=mysqli_query($conn,"SELECT *
// FROM classes
// JOIN class_sections ON (class_sections.class_id = classes.id)
// JOIN sections ON (sections.id = class_sections.section_id) ");

// while($ok=mysqli_fetch_array($classes_list)){

// $class=$ok['class'];
// $section=$ok['section'];
// $id=$ok['id'];



// }

echo json_encode(array("list_classes"=>$result));	
?>
