<?php
include("../conn.php");
$flag['code']=0;
$result = array();
//$name['namee']="";
?>
<?php
//$ag_num=$_POST['ag_num'];
$sho=mysqli_query($conn,"SELECT `id`, `name`, `email`, `password`, `address`, `dob`, `designation`, `sex`, `phone`, `image`, `is_active`, `teacher_type_id`, `created_at`, `updated_at` FROM `teachers`");

if(!$sho){}
//else{
$flag['code']=1;	   
$num=mysqli_num_rows($sho);
 
 while($dis=mysqli_fetch_array($sho)){
 
 array_push($result,array(
 "teacher_id"=>$dis['id'],
 "name"=>$dis['name'],
 "email"=>$dis['email'],
 "address"=>$dis['address'],
 "designation"=>$dis['designation'],
"dob"=>$dis['dob'],
"sex"=>$dis['sex'],
"image"=>$dis['image'],
"phone"=>$dis['phone']
 )
 );
  }

echo json_encode(array("teacher_list"=>$result));	
?>
