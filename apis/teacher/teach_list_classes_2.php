

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

$teach_ok=mysqli_query($conn,"SELECT `id`, `session_id`, `class_section_id`, `subject_id`, `teacher_id`, `description`, `is_active`, `created_at`, `updated_at` FROM `teacher_subjects` WHERE 
	teacher_id='$teacher_id'");

while($ok_teacher=mysqli_fetch_array($teach_ok)){
    $class_section_id=$ok_teacher['class_section_id'];

$class_and_section=mysqli_query($conn,"SELECT `id`, `class_id`, `section_id`, `is_active`, `created_at`, `updated_at` FROM `class_sections` WHERE id='$class_section_id'");

while($get_class=mysqli_fetch_array($class_and_section)){
	$class_id=$get_class['class_id'];
	$section_id=$get_class['section_id'];

$hmm=mysqli_query($conn,"SELECT classes.`id`, classes.`class`, classes.`is_active`, classes.`created_at`, classes.`updated_at`, sections.section, sections.id AS sec_id FROM `classes` INNER JOIN class_sections ON classes.id=class_sections.class_id and class_sections.class_id='$class_id' INNER JOIN sections ON sections.id=class_sections.section_id and class_sections.section_id='$section_id'");

while($get=mysqli_fetch_array($hmm)){
	$class=$get['class'];
	$section=$get['section'];
	$section_id=$get['sec_id'];
	$class_id=$get['id'];

	 array_push($result,array(
"class_name"=>$class,
"section"=>$section,
"class_id"=>$class_id,
"section_id"=>$section_id
 )
 );




}



}



}






// while($ok=mysqli_fetch_array($classes_list)){

// $class=$ok['class'];
// $section=$ok['section'];
// $id=$ok['id'];



// }

echo json_encode(array("list_classes"=>$result));	
?>
