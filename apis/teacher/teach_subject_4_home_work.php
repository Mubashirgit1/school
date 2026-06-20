<?php
include("../conn.php");
$flag['code']=0;

//$name['namee']="";
?>
<?php

$teacher_id=$_POST['class_id'];
$class_id=$_POST['class_id'];
$section_id=$_POST['section_id'];
// SELECT `id`, `class_id`, `section_id`, `is_active`, `created_at`, `updated_at` FROM `class_sections` WHERE 1

$sub=mysqli_query($conn,"
SELECT `teacher_subjects`.`id`, `teacher_subjects`.`session_id`, `teacher_subjects`.`class_section_id`, `teacher_subjects`.`subject_id`, `teacher_subjects`.`teacher_id`, `teacher_subjects`.`description`, `teacher_subjects`.`is_active`, `teacher_subjects`.`created_at`, `teacher_subjects`.`updated_at`
, `subjects`.`id`, `subjects`.`name`, `subjects`.`code`, `subjects`.`type`, `subjects`.`is_active`, `subjects`.`created_at`, `subjects`.`updated_at`, class_sections.id AS class_section_id
 FROM `teacher_subjects` INNER JOIN `subjects` ON `subjects`.`id`=`teacher_subjects`.`subject_id` and `teacher_subjects`.`teacher_id`='$teacher_id' INNER JOIN class_sections ON class_sections.`section_id`='$section_id' and class_sections.`class_id`='$class_id'");


 // `teacher_subjects`.`class_section_id` 


// SELECT `id`, `name`, `code`, `type`, `is_active`, `created_at`, `updated_at` FROM `subjects`


while($show=mysqli_fetch_array($sub)){

array_push($result,array(
 "sub_name"=>$show['name'],
 "sub_code"=>$show['code']
 )
 );
}

echo json_encode(array("teacher_subjects"=>$result));	
?>
