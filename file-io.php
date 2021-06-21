
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

	<title>File IO</title>
</head>
<body>

<h1>File IO</h1>

<?php 

define("filepath", "data.txt");

 $firstName = $lastName = $genDer = $DOb = $RelIgion = $EMail = $userName = $PassWord ="";
$firstNameErr = $lastNameErr = $genderErr = $dobErr = $RelIgionErr = $eMailErr = $userNameErr = $passWordErr = "";
$successfulMessage = $errorMessage = "";
$flag = false;

 if($_SERVER['REQUEST_METHOD'] === "POST") {
$firstName = $_POST['firstname'];
$lastName = $_POST['lastname'];
$genDer = $_POST['gender'];

$DOb = $_POST['dob'];
$RelIgion = $_POST['religion'];

$EMail= $_POST['email'];
$userName = $_POST['username'];
$PassWord = $_POST['password'];

 if(empty($firstName)) {
$firstNameErr = "First name can not be empty!";
$flag = true;
}
if(empty($lastName)) {
$lastNameErr = "Last name can not be empty!";
$flag = true;
}
if(empty($genDer)) {
$genderErr = "Gender can not be empty!";
$flag = true;
}
if(empty($DOb)) {
$dobErr = "Dob can not be empty!";
$flag = true;
}
if(empty($RelIgion)) {
$RelIgionErr = "Religion can not be empty!";
$flag = true;
}
if(empty($EMail)) {
$eMailErr = "EMail can not be empty!";
$flag = true;
}
if(empty($userName)) {
$userNameErr = "UserName can not be empty!";
$flag = true;
}
if(empty($PassWord)) {
$passWordErr = "Password can not be empty!";
$flag = true;
}
if(!$flag) {
$firstName = test_input($firstName);
$lastName = test_input($lastName);
$genDer = test_input($genDer);
$DOb = test_input($DOb);
$RelIgion = test_input($RelIgion);
$EMail = test_input($EMail);
$userName = test_input($userName);
$PassWord = test_input($PassWord);
$data[] = array("firstname"=>$firstName, "lastname"=>$lastName ,"gender"=>$genDer, "dob"=>$DOb , "religion"=>$RelIgion ,"email"=>$EMail ,"username"=>$userName ,"password"=>$PassWord );

array_push($data, array("firstname"=>"abc", "lastname"=>"cs" ,"gender"=>$genDer, "dob"=>$DOb, "religion"=>$RelIgion,"email"=>$EMail ,"username"=>$userName ,"password"=>$PassWord ));
$data_encode = json_encode($data);

$result1 = write($data_encode);



if($result1) {
$successfulMessage = "Successfully saved.";
}
else {
$errorMessage = "Error while saving.";
}

}
}

 function write($content) {
$resource = fopen(filepath, "a");
$fw = fwrite($resource, $content . "\n");
fclose($resource);
return $fw;
}

 function test_input($data) {
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}

 ?>

<fieldset>
	<legend> Basic Information: </legend>

 <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" >
<label for="firstname">First Name <span style="color: red;">*</span>: </label>
<input type="text" name="firstname" id="firstname">
<span style="color: red;"><?php echo $firstNameErr; ?></span>
<br><br>


<label for="lastname">Last Name <span style="color: red;">*</span>: </label>
<input type="text" name="lastname" id="lastname">
<span style="color: red;"><?php echo $lastNameErr; ?></span>
<br><br>

		<label for ="male"> Gender <span style="color: red;">*</span>: </label>
		<input type="radio" id="male" name="gender" value="male">
		<label for="male">Male</label>
		
		<input type="radio" id="female" name="gender" value="female">
		<label for="female">Female</label>

		<input type="radio" id="other" name="gender" value="other">
		<label for="other">Other</label>
		<span style="color: red;"><?php echo $genderErr; ?></span>
		<br><br>

        <label for="dob">DoB <span style="color: red;">*</span>: </label>
  <input type="date" id="dob" name="dob">
  <span style="color: red;"><?php echo $dobErr; ?></span>
  <br><br>


        <label for="religion">Religion <span style="color: red;">*</span>: </label>
		<select id="religion" name="religion">
			<option value="islam">Islam</option>
			<option value="hindu">Hindu</option>
			<option value="other">Other</option>
			

		</select>
		<span style="color: red;"><?php echo $RelIgionErr; ?></span>

		<br><br>

</fieldset>

<fieldset>
  <legend>Contact Information:</legend>
  <label for="pesent address">Pesent Address:</label>
<textarea id="pesent address" name="pesent address="4" cols="50">
  </textarea>
  <br><br>
  <label for="permanent address">Permanent Address:</label>
<textarea id="permanent address" name="pesent address="4" cols="50">
  </textarea>
  <br><br>
  <label for="phone"> Phone:</label>
  <input type="tel" id="phone" name="phone"><br><br>
 <label for="email">Email <span style="color: red;">*</span>: </label>
		<input type="email" id="email" name="email">
		<span style="color: red;"><?php echo $eMailErr; ?></span>
		<br><br>

  <label for="personal web link">Personal Web Link:</label>
  <p><a href="https://github.com/anannya789/">Please Go to this link </a></p>

   <br><br>
  </fieldset>

  <fieldset>
  	<legend>Account Information:</legend>
  	<label for="username"> UserName <span style="color: red;">* </span>: </label>
<input type="text" name="username" id="username">
<span style="color: red;"><?php echo $userNameErr; ?></span>
<br><br>

<label for="password"> Password <span style="color: red;">* </span>: </label>
<input type="password" name="password" id="password">
<span style="color: red;"><?php echo $passWordErr; ?></span>
<br><br>

  </fieldset>

<input type="submit" value="Submit">
</form>
<br><br>
 <span style="color: green;"><?php echo $successfulMessage; ?></span>
<span style="color: red;"><?php echo $errorMessage; ?></span>
 <span style="color: green;"><?php echo $RelIgion; ?></span>
  <span style="color: green;"><?php echo $genDer; ?></span>

 <?php



 function read() {
$resource = fopen(filepath, "r");
$fz = filesize(filepath);
$fr = "";
if($fz > 0) {
$fr = fread($resource, $fz);
}
fclose($resource);
return $fr;
}

?>
</body>
</html>
