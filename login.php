<?php 
	define("filepath", "data.txt");
	$userName = $password = "";
	$successfulMessage = $errorMessage = "";
$flag = false;
	$isValid = true;
	$userNameErr = $passwordErr = "";
	$uid = "";

	if(isset($_COOKIE['uid'])) {
		$uid = $_COOKIE['uid'];
	}

	if($_SERVER['REQUEST_METHOD'] === "POST") {
		$userName = $_POST['username'];
		$password = $_POST['password'];
		if(empty($userName)) {
			$userNameErr = "User name can not be empty!";
			$isValid = false;
		}
	}
		if(empty($password)) {
			$passwordErr = "Password can not be empty!";
			$isValid = false;
		}
		if(!$flag) {

            $userName = test_input($userName);
                  $PassWord = test_input($PassWord);
$data[] = array("username"=>$userName ,"password"=>$PassWord );

array_push($data, array("username"=>$userName ,"password"=>$PassWord ));
$data_encode = json_encode($data);

$result1 = write($data_encode);

if($result1) {
$successfulMessage = "Successfully saved.";
}
else {
$errorMessage = "Error while saving.";
}

}

			if($isValid) {
				if(isset($_POST['rememberme'])) {
					setcookie("uid", $userName, time() + 60*60*24*30);
				}
				session_start();
				$_SESSION['uid'] = $userName;

				header("Location: Welcome.php");


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

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login Form</title>
</head>
<body>

	<h1>Login Form</h1>


<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		<fieldset>
			<legend>Login Form:</legend>

				<label for="username"> UserName <span style="color: red;">* </span>: </label>
			<input type="text" name="username" id="username" value="<?php echo $uid; ?>">
			<span style="color:red"><?php echo $userNameErr; ?></span>

			<br><br>

			<label for="password"> Password <span style="color: red;">* </span>: </label>
			<input type="password" name="password" id="password">
			<span style="color:red"><?php echo $passwordErr; ?></span>

			<br><br>

			<input type="checkbox" name="rememberme" id="rememberme">
			<label for="rememberme">Remember Me:</label>

			<br><br>

			<input type="submit" name="submit" value="Login">
		</fieldset>
	</form>

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
	<br>

</body>
</html>