<?php
include("../conn.php");
$result = array();
?>
<?php
$class_id=$_POST['class_id'];
$section_id=$_POST['section_id'];

$in_charge=mysqli_query($conn,"SELECT `class_sections`.`id`, `class_sections`.`class_id`, `class_sections`.`section_id`, `class_sections`.`is_active`, `class_sections`.`class_incharge_teacher_id`, `teachers`.`name`, `teachers`.`image`, `teachers`.`id` AS teach_id FROM `class_sections` INNER JOIN `teachers` ON `class_sections`.`class_incharge_teacher_id`=`teachers`.`id` and `class_sections`.`class_id`='$class_id' and `class_sections`.`section_id`='$section_id'");


while($show=mysqli_fetch_array($in_charge)){
$in_name=$show['name'];
$in_id=$show['teach_id'];
$in_image=$show['image'];

///Add values to array...

 array_push($result,array(
 "in_name"=>$in_name,
 "in_id"=>$in_id,
 "in_image"=>$in_image
 )
 );

////Edn values to array////
}





echo json_encode(array("incharge_profile"=>$result));

?>