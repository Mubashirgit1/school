<?php
include("../conn.php");
$flag['code']=0;
 $result = array();
//$name['namee']="";
?>
<?php
$teacher_id=$_POST['parent_id'];



////Getting student Profile...


$sho=mysqli_query($conn,"SELECT `id`, `name`, `email`, `password`, `address`, `dob`, `designation`, `sex`, `phone`, `image`, `is_active`, `teacher_type_id`, `created_at`, `updated_at` FROM `teachers` WHERE id='$teacher_id'");

if(!$sho){}
//else{
$flag['code']=1;	   
$num=mysqli_num_rows($sho);
 $result = array();
 while($dis=mysqli_fetch_array($sho)){
 $name=$dis['name'];
 $email=$dis['email'];
 $address=$dis['address'];
 $dob=$dis['dob'];
 $designation=$dis['designation'];
 $phone=$dis['phone'];
 $image=$dis['image'];
 $sex=$dis['sex'];
}

 array_push($result,array(
"name"=>$name,
"email"=>$email,
"address"=>$address,
"dob"=>$dob,
"designation"=>$designation,
"phone"=>$phone,
"image"=>$image,
"sex"=>$sex
 )
 );

 
echo json_encode(array("student_detail"=>$result));	
?>
