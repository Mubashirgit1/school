<?php
include("conn.php");
$flag['code']=0;

//$name['namee']="";
?>
<?php
$ag_num=$_POST['ag_num'];
$user_id=$_POST['user_id'];

$sho=mysqli_query($conn,"SELECT `id`, `admission_no`, `roll_no`, `admission_date`, `firstname`, `lastname`, `rte`, `image`, `mobileno`, `email`, `state`, `city`, `pincode`, `religion`, `cast`, `dob`, `gender`, `current_address`, `permanent_address`, `category_id`, `adhar_no`, `samagra_id`, `bank_account_no`, `bank_name`, `ifsc_code`, `guardian_is`, `father_name`, `father_phone`, `father_occupation`, `mother_name`, `mother_phone`, `mother_occupation`, `guardian_name`, `guardian_relation`, `guardian_phone`, `guardian_occupation`, `guardian_address`, `is_active`, `previous_school`, `created_at`, `updated_at` FROM `students` WHERE id='$user_id'");

if(!$sho){}
//else{
$flag['code']=1;	   
$num=mysqli_num_rows($sho);
 $result = array();
 while($dis=mysqli_fetch_array($sho)){
 
 array_push($result,array(
 "admission_no"=>$dis['admission_no'],
 "roll_no"=>$dis['roll_no'],
 "admission_date"=>$dis['admission_date'],
 "firstname"=>$dis['firstname'],
 "lastname"=>$dis['lastname'],
 "rte"=>$dis['rte'],
 "image"=>$dis['image'],
 "cnic"=>$dis['cnic'],
 "mobileno"=>$dis['mobileno'],
 "email"=>$dis['email'],
 "city"=>$dis['city'],
 "dob"=>$dis['dob'],
 "permanent_address"=>$dis['permanent_address'],
 "father_name"=>$dis['father_name'],
 "father_phone"=>$dis['father_phone'],
"father_occupation"=>$dis['father_occupation'],
"category_id"=>$dis['category_id']
 )
 );
  }
	//}

echo json_encode(array("student_profile"=>$result));	
?>
