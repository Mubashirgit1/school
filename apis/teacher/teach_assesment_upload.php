<?php
include("../conn.php");
$flag['code']=0;
$result = array();
//$name['namee']="";
?>
<?php

$class_id=$_POST['class_id'];

$section_id=$_POST['section_id'];

$date=$_POST['date'];

$student_id=$_POST['student_id'];

$string_weight=$_POST['string_weight'];

$string_social=$_POST['string_social'];

$string_obi=$_POST['string_obi'];

$students=mysqli_query($conn,"INSERT INTO `teach_assesment`( `student_id`, `class_id`, `section_id`, `date`, `string_weight`, `string_social`, `string_obi`) VALUES ('$student_id','$class_id','$section_id','$date','$string_weight','$string_social','$string_obi')");

if(!$students){
	$num=0;
}else{
	$num=1;
}


array_push($result,array(
 "num"=>$num
 )
 );

echo json_encode(array("report_ok"=>$result));	

?>
