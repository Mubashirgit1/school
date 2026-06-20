<?php
include("../conn.php");
$flag['code']=0;
 $result = array();
//$name['namee']="";
?>
<?php

// $student_id=$_POST['student_id'];
$student_id=$_POST['student_id'];


$classes_list=mysqli_query($conn,"SELECT *
FROM classes
JOIN class_sections ON (class_sections.class_id = classes.id)
JOIN sections ON (sections.id = class_sections.section_id) ");

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
