<?php require_once("header.php"); ?>
<?php
require_once ("../../config.php");


require_once ("functions.php");


if(isset($_SESSION["user_id"])){
		//redirect user to the restricted page
		header("Location: restrict.php");
		
	}


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
	

 if (isset($_POST["signup"])){
		//sign up
		echo "Signing up... ";
		
		//the fields are not empty
		if(!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["Full_Name"])  ){
			
			//save to db
			signup($_POST["username"], $_POST["password"], $_POST["Full_Name"]);
			
		}else{
			echo "Both fields are required! ";
			
		}
		
	}

if (isset($_GET["signup"])){//if there is "?location=" in the message
		if (empty($_GET["signup"])){//if it is empty
		echo "Need to enter credentials! <br>";//yes it is empty
		}else{
			echo "Location: ".$_GET["location"]."<br>";//no it is not empty
		}
	}
	
?>


<form class="form-horizontal" method="post">
  <div class="row">
  		
  		<div class="col-sm-7" >

  					  <div class="row">
  					  	<div class="col-sm-11 col-sm-offset-1" >
  					  		<h1> Log In </h1>
  					  	</div>
  					  </div>

					  <div class="form-group">
					    <label for="username" class="col-sm-2 col-sm-offset-1 control-label">Username</label>
					    <div class="col-sm-5">
					      <input type="text" class="form-control" id="username" placeholder="username" name="username">
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="password" class="col-sm-2 col-sm-offset-1 control-label">Password</label>
					    <div class="col-sm-5">
					      <input type="password" class="form-control" id="password" name="password" placeholder="password">
					    </div>
					  </div>
					  <div class="form-group">
					    <div class="col-sm-offset-2 col-sm-5">
					      <div class="checkbox">
					        <label>
					          <input type="checkbox"> Remember me
					        </label>
					      </div>
					    </div>
					  </div>
					  <div class="form-group">
					    <div class="col-sm-offset-2 col-sm-5">
					      <button type="submit" value="Login" name="login" class="btn btn-primary">Log In</button>
					    </div>
					  </div>

	  </div>


   </div>
</form>
	
< <div class="row">
  		
  		<div class="col-sm-7" >

			  					  <div class="row">
			  					  	<div class="col-sm-11 col-sm-offset-1" >
			  					  		<h1> Sign Up </h1>
			  					  	</div>
			  					  </div>
					<form method="post" class="form-horizontal">
			  	<div class="form-group">
			    <label for="username" class="col-sm-2 col-sm-offset-1 control-label">Username</label>
			    <div class="col-sm-5">
			      <input type="text" class="form-control" id="username" placeholder="username" name="username">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="password" class="col-sm-2 col-sm-offset-1 control-label">Password</label>
			    <div class="col-sm-5">
			      <input type="password" class="form-control" id="password" name="password" placeholder="password">
			    </div>
			  </div>
			<form class="form-horizontal">
				<div class="form-group">
					<label for="Full_Name" class="col-sm-2 col-sm-offset-1 control-label">Full Name</label>
					<div class="col-sm-5">
				<input type="text" placeholder="Full Name" name="Full_Name">
			      </div>
			    </div>
			      <div class="form-group">
    <div class="col-sm-offset-2 col-sm-5">
     <input type="submit" class="btn btn-success" value="Sign Up" name="signup">
    </div>
  </div>
  </div>

</form>
