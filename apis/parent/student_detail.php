<?php
include("../conn.php");
$flag['code']=0;
 $result = array();
//$name['namee']="";
?>
<?php
$parent_id=$_POST['parent_id'];


$stu_edu_info=mysqli_query($conn,"SELECT `id`, `session_id`, `student_id`, `class_id`, `section_id`, `route_id`, `vehroute_id`, `transport_fees`, `fees_discount`, `is_active`, `created_at`, `updated_at` FROM `student_session` WHERE student_id='$parent_id'");


while($ok=mysqli_fetch_array($stu_edu_info)){
$class_id=$ok['class_id'];
$section_id=$ok['section_id'];
$session_id=$ok['session_id'];
}


////Getting student Profile...


$sho=mysqli_query($conn,"SELECT `id`, `admission_no`, `roll_no`, `admission_date`, `firstname`, `lastname`, `rte`, `image`, `mobileno`, `email`, `state`, `city`, `pincode`, `religion`, `cast`, `dob`, `gender`, `current_address`, `permanent_address`, `category_id`, `adhar_no`, `samagra_id`, `bank_account_no`, `bank_name`, `ifsc_code`, `guardian_is`, `father_name`, `father_phone`, `father_occupation`, `mother_name`, `mother_phone`, `mother_occupation`, `guardian_name`, `guardian_relation`, `guardian_phone`, `guardian_occupation`, `guardian_address`, `is_active`, `previous_school`, `created_at`, `updated_at`, 	`fee_arrears` FROM `students` WHERE id='$parent_id'");

if(!$sho){}
//else{
$flag['code']=1;	   
$num=mysqli_num_rows($sho);
 $result = array();
 while($dis=mysqli_fetch_array($sho)){
 $admission_no=$dis['admission_no'];
 $roll_no=$dis['roll_no'];
 $admission_date=$dis['admission_date'];
 $firstname=$dis['firstname'];
 $lastname=$dis['lastname'];
 $rte=$dis['rte'];
 $image=$dis['image'];
 $cnic=$dis['cnic'];
 $mobileno=$dis['mobileno'];
 $email=$dis['email'];
 $city=$dis['city'];
 $dob=$dis['dob'];
 $permanent_address=$dis['permanent_address'];
 $father_name=$dis['father_name'];
 $father_phone=$dis['father_phone'];
$father_occupation=$dis['father_occupation'];
$category_id=$dis['category_id'];
$fee_arrears=$dis['fee_arrears'];

}


////End student Profile......



$stu_edu_info=mysqli_query($conn,"SELECT `student_session`.`transport_fees`, `student_session`.`vehroute_id`, `student_session`.`id` as `student_session_id`, `student_session`.`fees_discount`, `classes`.`id` AS `class_id`, `classes`.`class`, `sections`.`id` AS `section_id`, `sections`.`section`, `students`.`id`, `students`.`admission_no`, `students`.`roll_no`, `students`.`admission_date`, `students`.`firstname`, `students`.`lastname`, `students`.`image`, `students`.`mobileno`, `students`.`email`, `students`.`state`, `students`.`city`, `students`.`pincode`, `students`.`religion`, `students`.`cast`, `students`.`dob`, `students`.`current_address`, `students`.`previous_school`, `students`.`guardian_is`, `students`.`permanent_address`, `students`.`category_id`, `students`.`adhar_no`, `students`.`samagra_id`, `students`.`bank_account_no`, `students`.`bank_name`, `students`.`ifsc_code`, `students`.`guardian_name`, `students`.`guardian_relation`, `students`.`guardian_phone`, `students`.`guardian_address`, `students`.`is_active`, `students`.`created_at`, `students`.`updated_at`, `students`.`father_name`, `students`.`father_phone`, `students`.`father_occupation`, `students`.`mother_name`, `students`.`mother_phone`, `students`.`mother_occupation`, `students`.`guardian_occupation`, `students`.`gender`, `students`.`guardian_is`, `students`.`rte`
FROM `students`
JOIN `student_session` ON `student_session`.`student_id` = `students`.`id`
JOIN `classes` ON `student_session`.`class_id` = `classes`.`id`
JOIN `sections` ON `sections`.`id` = `student_session`.`section_id`
WHERE `student_session`.`session_id` = '$session_id'
AND `students`.`id` = '$parent_id'");


while($ok=mysqli_fetch_array($stu_edu_info)){
$transport_fees=$ok['transport_fees'];
$vehroute_id=$ok['vehroute_id'];
$student_session_id=$ok['student_session_id'];
$fees_discount=$ok['fees_discount'];
$class_id=$ok['class_id'];
$class=$ok['class'];
$section_id=$ok['section_id'];
$section=$ok['section'];
$id=$ok['id'];
$admission_no=$ok['admission_no'];
$roll_no=$ok['roll_no'];
$admission_date=$ok['admission_date'];
$firstname=$ok['firstname'];

 array_push($result,array(
"transport_fees"=>$transport_fees,
"student_session_id"=>$student_session_id,
"fees_discount"=>$fees_discount,
"class_id"=>$class_id,
"class"=>$class,
"section_id"=>$section_id,
"section"=>$section,
"admission_no"=>$admission_no,
"roll_no"=>$roll_no,
"admission_date"=>$admission_date,
"firstname"=>$firstname,
"lastname"=>$lastname,
"rte"=>$rte,
"image"=>$image,
"cnic"=>$cnic,
"phone"=>$mobileno,
"permanent_address"=>$permanent_address,
"fee_arrears"=>$fee_arrears

 )
 );

}

 
echo json_encode(array("student_detail"=>$result));	
?>
