<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
	session_start();
	include("inculde/main.php");
	include('inculde/connect_db.php');
	
	if( isset($_SESSION['username']) ){
		$User_id=$_SESSION['user_id'];
		header("Location:members/account.php");
	}
	$error1 = 0;$error = $User = $pass = $row = $d ="";
	$aValid = array('-', '_');
	
	if (isset($_POST['submit'])) {

		// for Username
		if (strlen(trim($_POST["username"])) < 1){
			$error="Username mustn\'t be empty!";
			$error1= $error1 + 1;
		}else {
			$User = test_input($_POST["username"]);
		 // check if name only contains letters and whitespace
		if(!ctype_alnum(str_replace($aValid, '', $User))){
			
			$error1 = $error1 + 1;
		 } 
		}
		
		// for password
		if (strlen(trim($_POST["password"])) < 1) {
		 $error="Username/Password mustn't be empty!";
		 $error1 = $error1 + 1;
		}else{
			 $passs = mysql_real_escape_String($_POST["password"]);
			 $pass = md5($_POST["password"]);
		}
		 
	   
		if($error1 == 0){
					$user=md5($User);
					$U=("SELECT * FROM memeber WHERE username = '$user' AND password = '$pass'");
				
						$result = mysql_query($U)or die (mysql_error());
						
						while($row = mysql_fetch_row($result)){
						$user_id = mysql_real_escape_string($row['username']);
							$activation = md5(uniqid(rand(), true));
							//$uid=md5($user_id).'/'.$activation;
							header("Location:session.php?uid=".$pass.'/'.$activation.'/'.$activation."&key=".$user."");
						}
						$error="Username/Password is invalid!";
				
				
					
						
			
			/*if($row = mysqli_fetch_row($d)){
				$user_id = mysqli_real_escape_string($row['user_id']);
				$p=md5(uniqid(rand(), true));
				header("Location:account_id1.php?id=".$user_id."");
			}else{*/			
		}
	}
	
	function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}


?>
	



<html lang="en">
	<head>
		<title>Welcome To Wceeesa Forum</title>
		<link rel="stylesheet" href="css\index.css">
		<style type="text/css">
		body{
		background-image:url(background1.jpg);
		background-repeat:no-repeat;
		height:100%;
		}
		</style>
	

<!-- Script by hscripts.com -->
	</head>
	
<body>
	<div id="wrapper">
	
	<h1 id="title"> WCE-EESA Alumni forum </div></h1>
	<div class="login"><! login information>
		
		<form method="Post" >	
		
			 <h3>LogIn:</h3><b><font color="red"><br /><?php echo $error; echo $row;?></font></b><br />
				<font color="white">
				<b>Username: <input type="text" name="username" />
				<br /><br />
				Password: <input type="password" name="password" /></b>
				<br /><br /></font>
				<input type="Submit" value="Log In" name="submit" class="button"><br /><br />
				<b><a href="recovery.php">Forget Password</a> | <a href="register.php">Register<a></b>
		</form>
	</div>
	</div>
	<?php footer();
	?>
	
	
</body>
</html>
