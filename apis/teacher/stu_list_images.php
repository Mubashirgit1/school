<?php
include("../conn.php");
$result = array();
?>
<?php
//////Real Code is here,......

$incharge_id=$_GET['id'];

$get_class_info=mysqli_query($conn,"SELECT `id`, `class_id`, `section_id`, `is_active`, `class_incharge_teacher_id`, `created_at`, `updated_at` FROM `class_sections` WHERE class_incharge_teacher_id='$incharge_id'");

while($show=mysqli_fetch_array($get_class_info)){
	$class_id=$show['class_id'];
	$section_id=$show['section_id'];
}

$sho=mysqli_query($conn,"SELECT `student_session`.`id`, `student_session`.`session_id`, `student_session`.`student_id`, `student_session`.`class_id`, `student_session`.`section_id`, `student_session`.`route_id`, `student_session`.`vehroute_id`, `student_session`.`transport_fees`, `student_session`.`fees_discount`, `student_session`.`is_active`, `student_session`.`created_at`, `student_session`.`updated_at`,`students`.`id` AS student_id, `students`.`admission_no`, `students`.`roll_no`,`students`.`image`, `students`.`admission_date`, `students`.`firstname` FROM `student_session` INNER JOIN `students` ON `students`.`id`=`student_session`.`student_id` and `student_session`.`class_id`='$class_id' and `student_session`.`section_id`='$section_id'");

if(!$sho){}
//else{
$flag['code']=1;	   
$num=mysqli_num_rows($sho);
 
 while($dis=mysqli_fetch_array($sho)){
 $image="http://plugedin.net/".$dis['image'];
 
 array_push($result,array(
 "student_id"=>$dis['student_id'],
 "name"=>$dis['firstname'],
 "roll_no"=>$dis['roll_no'],
 "image"=>$image
 )
 );
  }

echo json_encode($result);




////End real code 


// $list=mysqli_query($conn,"SELECT `id`, `admission_no`, `roll_no`, `admission_date`, `firstname`, `lastname`, `rte`, `image`, `mobileno`, `email`, `state`, `city`, `pincode`, `religion`, `cast`, `dob`, `gender`, `current_address`, `permanent_address`, `category_id`, `adhar_no`, `samagra_id`, `bank_account_no`, `bank_name`, `ifsc_code`, `guardian_is`, `father_name`, `father_phone`, `father_occupation`, `father_cnic`, `mother_name`, `mother_phone`, `mother_occupation`, `guardian_name`, `guardian_relation`, `guardian_phone`, `guardian_occupation`, `guardian_address`, `is_active`, `fee_arrears`, `fee_update_date`, `discount`, `previous_school`, `struck_off`, `created_at`, `updated_at` FROM `students`");

// while($sh=mysqli_fetch_array($list)){
// $image="http://plugedin.net/".$sh['image'];
// $name=$sh['firstname'];
// $roll_no=$sh['roll_no'];
// 	///Add values to array...

//  array_push($result,array(
//  "name"=>$name,
//  "rool_no"=>$roll_no,
//  "image"=>$image
//  )
//  );

// ////Edn values to array////

// }


// echo json_encode($result);


?>