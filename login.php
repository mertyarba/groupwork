<?php

if (isset($_POST["login"])){
		
	
		//log in
		echo "Loggin in...";
		
		//the fields are not empty
		if(!empty($_POST["username"]) && !empty($_POST["password"])){
			
			//save to db
			login($_POST["username"], $_POST["password"]);
			
		}else{
			echo "Both fields are required! ";
			
		}
}

 else if (isset($_POST["signup"])){
		//sign up
		echo "Signing up... ";
		
		//the fields are not empty
		if(!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["First_Name"]) && !empty($_POST["Last_Name"])   ){
			
			//save to db
			signup($_POST["username"], $_POST["password"], $_POST["First_Name"], $_POST["Last_Name"]);
			
		}else{
			echo "Both fields are required! ";
			
		}
		
	}


?>
<h1> Log In </h1>
<form method="POST">

		<input type="text" placeholder="username" name="username"><br></br>
		<input type="password" placeholder="password" name="password"><br></br>
		
		<input type="submit" name="login" value="Log In">

</form>

<h1> Sign Up </h1>
<form method="POST">

		<input type="text" placeholder="username" name="username"><br></br>
		<input type="password" placeholder="password" name="password"><br></br>
		<input type="text" placeholder="Full Name" name="Full_Name"><br></br>
	
		<input type="submit" name="signup" value="Sign Up">

</form>