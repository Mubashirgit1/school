<?php
include("conn.php");
$flag['code']=0;

//$name['namee']="";
?>
<?php

//$teacher_cnic=$_POST['teacher_cnic'];


// $teacher_info=mysqli_query($conn,"SELECT `teacher_id`, `name`, `father_name`, `pic`, `gender`, `dob`, `cnic`, `street_address`, `colony`, `city` FROM `teachers` where cnic='$teacher_cnic'");

// while($show=mysqli_fetch_array($teacher_info)){
// 	$teacher_name=$show['name'];
// 	$pic=$show['pic'];
// 	$gender=$show['gender'];
// 	$city=$show['city'];
// 	$teacher_id=$show['teacher_id'];
// }


$sho=mysqli_query($conn,"SELECT `id`, `book_title`, `book_no`, `isbn_no`, `subject`, `rack_no`, `publish`, `author`, `qty`, `perunitcost`, `postdate`, `description`, `available`, `is_active`, `created_at`, `updated_at` FROM `books`");

if(!$sho){}
//else{
$flag['code']=1;	   
$num=mysqli_num_rows($sho);
 $result = array();
 while($dis=mysqli_fetch_array($sho)){
 array_push($result,array(
 "id"=>$dis['id'],
 "book_title"=>$dis['book_title'],
 "book_no"=>$dis['book_no'],

"isbn_no"=>$dis['isbn_no'],

"subject"=>$dis['subject'],

"author"=>$dis['author'],
"description"=>$dis['description']
 )
 );
  }


echo json_encode(array("book_list"=>$result));	
?>
