<?php
	require_once ("header.php");
	require_once ("functions.php");
	require_once ("../../config.php");
	
	//******************************
	//******** SAVE TO DB **********
	//******************************
		
		
		//connection with username and password
		//access username from config
		//echo $db_username;
		
		//1 server name
		//2 username
		//3 password
		//4 database
		
		$mysql = new mysqli("localhost", $db_username, $db_password, "webpr2016_mertyarba");
		
		$stmt = $mysql->prepare("INSERT INTO todo (task, deadline, completion, deleted)VALUES (?, ?, ?, ?)");
		
		//We are replacing question marks with values
		//s - string, date or smth that is based on characters and numbers
		//i - integer, number
		//d - decimal, float
		
		//for each question mark its type with one letter
		$stmt->bind_param("ssss", $_GET["task"], $_GET["deadline"], $_GET["completion"], $_GET["deleted"]);
		
		//echo error
		echo $mysql->error;
		
		//save
		if ($stmt->execute()){
			echo "saved successfully";
		}else{
			echo $stmt->error;
		}
		
		if (isset($_GET["task"])){//if there is "?location=" in the message
		if (empty($_GET["task"])){//if it is empty
		echo "Define task! <br>";//yes it is empty
		}else{
			echo "Task: ".$_GET["task"]."<br>";//no it is not empty
		}
	}
	
	//check if there is variable in the URL
	if (isset ($_GET["deadline"])){
		
		//only if there is message in the URL
		//echo "there is message";
		
		// if it is empty
		if (empty ($_GET["deadline"])){
			//it is empty
			echo "What time is the task due? <br>";
		}else{
			//It is not empty
			echo "Deadline: ".$_GET["deadline"]."<br>";
		}
	}else{
		
	}
	
	
	if(!isset($_SESSION["user_id"])){
		//redirect not logged in user to the login page
		header("Location: login.php");
		
	}


	//?Logout is in the URL
	if(isset($_GET["logout"])){
		
		//delete the session
		session_destroy();
		
		header("Location: login.php");
	}
	

	

?>

<a href="?logout=1">Log out</a>
<br>
<br>
<br>

<nav class="navbar navbar-default">
	  <div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="#">Online ToDo List</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		
		  <ul class="nav navbar-nav">
			
			<li class="active">
				<a href="restrict.php">
				
					Make a list!
				</a>
			</li>
			
			
			<li>
				<a href="table.php">
					Your ToDos
				</a>
			</li>
			
		  </ul> 
		  
		</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>

	<div class="container">
	
	 <br><h1>Welcome <?php echo $_SESSION["name"];?> (<?=$_SESSION["user_id"];?>) </h1></br>	

		<br> <h1> Make a ToDo List! </h1> </br>
		
	<form>
		<div class="row">
			<div class="col-md-3 col-sm-6">
				<div class="form-group">
					<label for="task">Task: </label>
					<input name="task" id="task" type="text" class="form-control">
				</div>
			</div>
		</div>
		
		<div class="row">
		<div class="col-md-3 col-sm-6">
				<div class="form-group">
					<label for="deadline">Deadline: </label>
					<input name="deadline" id="deadline" type="text" class="form-control">
				</div>
			</div>
		
		</div>
		
		<div class="row">
			<div class="col-md-3 col-sm-6">
			<button class="btn btn-success hidden-xs btn-md-3" type="submit" value="create" name="create">Create</button>
			<button class="btn btn-success visible-xs-inline btn-block" type="submit" value="create"  name="create">Create</button>
		</div>
		
		

  
	</div>
  
  </body>
</html>