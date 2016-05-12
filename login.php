<?php require_once("header.php"); ?>
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
<<<<<<< HEAD

<form class="form-horizontal">
  <div class="row">
  		
  		<div class="col-sm-7" >

  					  <div class="row">
  					  	<div class="col-sm-11 col-sm-offset-1" >
  					  		<h1> Log In </h1>
  					  	</div>
  					  </div>

					  <div class="form-group">
					    <label for="inputEmail3" class="col-sm-2 col-sm-offset-1 control-label">Username</label>
					    <div class="col-sm-5">
					      <input type="text" class="form-control" id="inputEmail3" placeholder="username">
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="inputPassword3" class="col-sm-2 col-sm-offset-1 control-label">Password</label>
					    <div class="col-sm-5">
					      <input type="password" class="form-control" id="inputPassword3" placeholder="password">
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
					      <button type="submit" class="btn btn-primary">Sign in</button>
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
					<form class="form-horizontal">
			  	<div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 col-sm-offset-1 control-label">Username</label>
			    <div class="col-sm-5">
			      <input type="text" class="form-control" id="inputEmail3" placeholder="username">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-2 col-sm-offset-1 control-label">Password</label>
			    <div class="col-sm-5">
			      <input type="password" class="form-control" id="inputPassword3" placeholder="password">
			    </div>
			  </div>
			<form class="form-horizontal">
				<div class="form-group">
					<label for="inputName" class="col-sm-2 col-sm-offset-1 control-label">Full Name</label>
					<div class="col-sm-5">
				<input type="text" placeholder="Full Name" name="Full_Name">
			      </div>
			    </div>
			      <div class="form-group">
    <div class="col-sm-offset-2 col-sm-5">
     <button type="submit" class="btn btn-success">Sign up</button>
    </div>
  </div>
  </div>

</form>
=======
<h1> Log In </h1>
<form class="form-horizontal">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">username</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputEmail3" placeholder="username">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="inputPassword3" placeholder="password">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox"> Remember me
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Sign in</button>
    </div>
  </div>
</form>

		
>>>>>>> dd01b2c4d11fdf60763f7aa4ccb6895090ba39f3
