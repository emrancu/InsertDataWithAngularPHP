<?php

$con=new mysqli("localhost","root","mysql","angular");


$errors = array();
$data = array();
// Getting posted data and decodeing json for decode
$_POST = json_decode(file_get_contents('php://input'), true);
$a=mysqli_real_escape_string($con,$_POST['sname']);
$b=mysqli_real_escape_string($con,$_POST['sdpt']);
$c=mysqli_real_escape_string($con,$_POST['sid']);

// check for NULL values.
if (empty($a))
  $errors['name'] = 'Name is required.';

if (empty($b))
  $errors['username'] = 'Department is required.';

if (empty($c))
  $errors['email'] = 'ID is required.';

if (!empty($errors)) {
  $data['errors']  = $errors;
} else {
	$check=mysqli_query($con,"select * from student where student_id='$c'");
	if(mysqli_num_rows($check)<1){
	$q=mysqli_query($con,"insert into student(name,department,student_id) values('$a','$b','$c')");
	if($q){ $data['message'] = 'Insert Successfully';}
	else{ $data['message'] = 'Sorry! Not insert';}
	}
	else{
	$data['message'] = 'Already Exist';	
	}
}
// response back.
echo json_encode($data);


?>