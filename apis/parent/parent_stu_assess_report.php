<?php
include("../conn.php");
$flag['code']=0;
 $result = array();
//$name['namee']="";
?>
<?php

// $student_id=$_POST['student_id'];
$user_id=$_POST['user_id'];

$teach_ok=mysqli_query($conn,"SELECT `id`, `student_id`, `class_id`, `section_id`, `date`, `string_weight`, `string_social`, `string_obi` FROM `teach_assesment`  WHERE student_id='2'");

while($show=mysqli_fetch_array($teach_ok)){

array_push($result,array(
"string_weight"=>$show['string_weight'],
"string_social"=>$show['string_social'],
"string_obi"=>$show['string_obi'],
"date"=>$show['date']
 )
 );


}   ///end while Loop.....
echo json_encode(array("report"=>$result));	

?>
