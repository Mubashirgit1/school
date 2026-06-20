<?php
include("../conn.php");
$flag['code']=0;
 $result = array();
//$name['namee']="";
?>
<?php
$princ_id=$_POST['parent_id'];



////Getting student Profile...


$sho=mysqli_query($conn,"SELECT `id`, `username`, `name`, `email`, `CNIC`, `password` ,`phone`,`address` FROM `principal` WHERE id='$princ_id'");

if(!$sho){}
//else{
$flag['code']=1;	   
$num=mysqli_num_rows($sho);
 $result = array();
 while($dis=mysqli_fetch_array($sho)){
 $name=$dis['name'];
 $email=$dis['email'];
 $address=$dis['address'];
 $phone=$dis['phone'];
// $image=$dis['image'];
}

 array_push($result,array(
"name"=>$name,
"email"=>$email,
"address"=>$address,
"dob"=>$dob,
"phone"=>$phone
 )
 );

 
echo json_encode(array("student_detail"=>$result));	
?>
