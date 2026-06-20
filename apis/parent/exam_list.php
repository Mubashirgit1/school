
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

$stu_edu_info=mysqli_query($conn,"SELECT `id`, `name`, `sesion_id`, `note`, `is_active`, `created_at`, `updated_at` FROM `exams`");


while($ok=mysqli_fetch_array($stu_edu_info)){
$exam_id=$ok['id'];
$name=$ok['name'];
$note=$ok['note'];
$created_at=$ok['created_at'];

array_push($result,array(
"exam_id"=>$exam_id,
"note"=>$note,
"name"=>$name,
"created_at"=>$created_at
 )
 );


///End code to create json array////



}

////end class id and much more //.........

echo json_encode(array("exam_list"=>$result));	











?>