<?php
include("../conn.php");
$flag['code']=0;
 $result = array();
//$name['namee']="";
?>
<?php

// $student_id=$_POST['student_id'];
$teacher_id=$_POST['teacher_id'];




// SELECT teacher_subjects.`id`, teacher_subjects.`session_id`, teacher_subjects.`class_section_id`,teacher_subjects.`subject_id`, teacher_subjects.`teacher_id`, teacher_subjects.`description`, teacher_subjects.`is_active`, teacher_subjects.`created_at`, teacher_subjects.`updated_at`,`classes`.class,`class_sections`.section_id,sections.section FROM `teacher_subjects` INNER JOIN class_sections ON 
// `teacher_subjects`.teacher_id='$teacher_id' INNER JOIN classes ON classes.id=class_sections.class_id
// INNER JOIN sections ON sections.id=class_sections`.section_id




$classes_list=mysqli_query($conn,"SELECT teacher_subjects.`id`, teacher_subjects.`session_id`, teacher_subjects.`class_section_id`,teacher_subjects.`subject_id`, teacher_subjects.`teacher_id`, teacher_subjects.`description`, teacher_subjects.`is_active`, teacher_subjects.`created_at`, teacher_subjects.`updated_at`,`classes`.class,`class_sections`.section_id,sections.section FROM `teacher_subjects` INNER JOIN class_sections ON 
`teacher_subjects`.teacher_id='$teacher_id' INNER JOIN classes ON classes.id=class_sections.class_id
INNER JOIN sections ON sections.id=class_sections.section_id");

while($ok=mysqli_fetch_array($classes_list)){

$class=$ok['class'];
$section=$ok['section'];
$id=$ok['id'];

 array_push($result,array(
"id"=>$ok['id'],
"class_name"=>$ok['class'],
"section"=>$ok['section'],
"section_id"=>$ok['section_id'],
"class_id"=>$ok['class_id']
 )
 );



}

echo json_encode(array("list_classes"=>$result));	
?>
